<?php session_start();
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../LIBS_php/PHPExcel/PHPExcel.php';
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Excel.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//Variable de busqueda
$z = "WHERE usuarios_accesos.idAcceso>0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND usuarios_accesos.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Rango_Inicio']) && $_GET['Rango_Inicio'] != ''&&isset($_GET['Rango_Termino']) && $_GET['Rango_Termino'] != ''){  
	$z .= " AND usuarios_accesos.Fecha BETWEEN '{$_GET['Rango_Inicio']}' AND '{$_GET['Rango_Termino']}'" ;
}
/**********************************************************/
//consulta
$arrAccesos = array();
$query = "SELECT 
usuarios_accesos.Fecha,
usuarios_accesos.Hora,
usuarios_accesos.IP_Client,
usuarios_accesos.Agent_Transp,
usuarios_listado.Nombre AS Usuario
FROM `usuarios_accesos`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario   = usuarios_accesos.idUsuario 
".$z."
ORDER BY usuarios_accesos.Fecha DESC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrAccesos,$row );
} 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Office 2007")
							 ->setLastModifiedBy("Office 2007")
							 ->setTitle("Office 2007")
							 ->setSubject("Office 2007")
							 ->setDescription("Document for Office 2007")
							 ->setKeywords("office 2007")
							 ->setCategory("office 2007 result file");

			
         
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Usuario')
            ->setCellValue('B1', 'Fecha')
            ->setCellValue('C1', 'Hora')
            ->setCellValue('D1', 'IP Cliente')
            ->setCellValue('E1', 'Agent Transp');       					                              
         
$nn=2;
foreach ($arrAccesos as $acceso) { 
						
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, $acceso['Usuario'])
            ->setCellValue('B'.$nn, fecha_estandar($acceso['Fecha']))
            ->setCellValue('C'.$nn, $acceso['Hora'])
            ->setCellValue('D'.$nn, $acceso['IP_Client'])
            ->setCellValue('E'.$nn, $acceso['Agent_Transp']);
 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Informe Accesos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Accesos Usuarios.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
