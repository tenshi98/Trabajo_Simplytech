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
	$z .= " AND usuarios_accesos.Fecha BETWEEN '".$_GET['Rango_Inicio']."' AND '".$_GET['Rango_Termino']."'" ;
}
/**********************************************************/
//consulta
$arrAccesos = array();
$query = "SELECT 
usuarios_accesos.Fecha,
usuarios_accesos.Hora,
usuarios_accesos.IP_Client,
usuarios_accesos.Agent_Transp,
usuarios_listado.Nombre AS Usuario,
core_sistemas.Nombre AS Sistema

FROM `usuarios_accesos`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario   = usuarios_accesos.idUsuario 
LEFT JOIN `core_sistemas`      ON core_sistemas.idSistema      = usuarios_accesos.idSistema 
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
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
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
            ->setCellValue('A1', 'Sistema')
            ->setCellValue('B1', 'Usuario')
            ->setCellValue('C1', 'Fecha')
            ->setCellValue('D1', 'Hora')
            ->setCellValue('E1', 'IP Cliente')
            ->setCellValue('F1', 'Agent Transp');       					                              
         
$nn=2;
foreach ($arrAccesos as $acceso) { 
						
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $acceso['Sistema'])
				->setCellValue('B'.$nn, $acceso['Usuario'])
				->setCellValue('C'.$nn, fecha_estandar($acceso['Fecha']))
				->setCellValue('D'.$nn, $acceso['Hora'])
				->setCellValue('E'.$nn, $acceso['IP_Client'])
				->setCellValue('F'.$nn, $acceso['Agent_Transp']);
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
