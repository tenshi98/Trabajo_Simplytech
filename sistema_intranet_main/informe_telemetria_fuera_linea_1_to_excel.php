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
//Inicia variable
$z="WHERE telemetria_listado_error_fuera_linea.idFueraLinea>0"; 
$z.=" AND telemetria_listado.id_Geo='1'";
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=3";//CrossTrack			
}
//verifico si existen los parametros de fecha
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" AND telemetria_listado_error_fuera_linea.Fecha_inicio BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
//verifico si se selecciono un equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z.=" AND telemetria_listado_error_fuera_linea.idTelemetria='".$_GET['idTelemetria']."'";
}
//Verifico el tipo de usuario que esta ingresando
$z.=" AND telemetria_listado_error_fuera_linea.idSistema=".$_GET['idSistema'];	

// Se trae un listado con todos los elementos
$arrErrores = array();
$query = "SELECT 
telemetria_listado_error_fuera_linea.idFueraLinea,
telemetria_listado_error_fuera_linea.Fecha_inicio, 
telemetria_listado_error_fuera_linea.Hora_inicio, 
telemetria_listado_error_fuera_linea.Fecha_termino, 
telemetria_listado_error_fuera_linea.Hora_termino, 
telemetria_listado_error_fuera_linea.Tiempo,
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.id_Geo

FROM `telemetria_listado_error_fuera_linea`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_error_fuera_linea.idTelemetria
".$z."
ORDER BY idFueraLinea DESC ";
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
array_push( $arrErrores,$row );
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
            ->setCellValue('A1', 'Nombre Equipo')
            ->setCellValue('B1', 'Fecha Inicio')
            ->setCellValue('C1', 'Hora Inicio')
            ->setCellValue('D1', 'Fecha Termino')
            ->setCellValue('E1', 'Hora Termino')
            ->setCellValue('F1', 'Tiempo'); 
            
						      					                              
         
$nn=2;
foreach ($arrErrores as $error) { 
						
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, $error['NombreEquipo'])
            ->setCellValue('B'.$nn, fecha_estandar($error['Fecha_inicio']))
            ->setCellValue('C'.$nn, $error['Hora_inicio'])
            ->setCellValue('D'.$nn, fecha_estandar($error['Fecha_termino']))
            ->setCellValue('E'.$nn, $error['Hora_termino'])
            ->setCellValue('F'.$nn, $error['Tiempo']);
 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Resumen de Fuera de Linea');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Resumen de Fuera de Linea.xls"');
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
