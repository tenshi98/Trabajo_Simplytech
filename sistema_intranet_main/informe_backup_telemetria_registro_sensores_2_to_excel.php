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
//se verifica si se ingreso la hora, es un dato optativo
$z='';
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" WHERE (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
	
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".$_GET['sensorn']." AS SensorNombre,
telemetria_listado.SensoresGrupo_".$_GET['sensorn']." AS SensorGrupo,
telemetria_listado.SensoresMedMin_".$_GET['sensorn']." AS SensorMinMed,
telemetria_listado.SensoresMedMax_".$_GET['sensorn']." AS SensorMaxMed,

backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']." AS SensorValue,
telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".$_GET['sensorn']."


".$z."
ORDER BY FechaSistema ASC, HoraSistema ASC
LIMIT 10000";
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
array_push( $arrRutas,$row );
}
/****************************************/
//Se trae grupo
$query = "SELECT Nombre
FROM `telemetria_listado_grupos`
WHERE idGrupo=".$arrRutas[0]['SensorGrupo'];
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
$rowGrupo = mysqli_fetch_assoc ($resultado);


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

     
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Informe Sensor '.$rowGrupo['Nombre'].' '.$arrRutas[0]['SensorNombre']);
            
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Fecha')
            ->setCellValue('B3', 'Hora');
            
//Si se ven detalles
if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){ 
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Medicion')
				->setCellValue('D3', 'Minimo')
				->setCellValue('E3', 'Maximo');          
//Si no se ven detalles	
}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('C3', 'Medicion'); 						
}                        


$x = 4;
foreach ($arrRutas as $rutas) { 
	if(isset($rutas['SensorValue'])&&$rutas['SensorValue']<99900){$xdata=Cantidades_decimales_justos($rutas['SensorValue']).' '.$rutas['Unimed'];}else{$xdata='Sin Datos';}
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$x, $rutas['FechaSistema'])
				->setCellValue('B'.$x, $rutas['HoraSistema']);
				
	//Si se ven detalles
	if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){ 
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$x, $xdata)
					->setCellValue('D'.$x, Cantidades_decimales_justos($rutas['SensorMinMed']).' '.$rutas['Unimed'])
					->setCellValue('E'.$x, Cantidades_decimales_justos($rutas['SensorMaxMed']).' '.$rutas['Unimed']);          
	//Si no se ven detalles	
	}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$x, $xdata); 						
	} 				
	//Sumo 1
	$x++;
}
				

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Registro Sensores');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Registro Sensores.xls"');
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
