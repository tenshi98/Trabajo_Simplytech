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
	$z.="WHERE (TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.="WHERE (FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
//desde y hasta activo
if(isset($_GET['desde'])&&$_GET['desde']!=''&&isset($_GET['hasta'])&&$_GET['hasta']!=''){
	$subquery = "
	MIN(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedMin,
	MAX(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedMax,
	AVG(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedProm,
	STDDEV(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedDesStan,
	";
//solo desde	
}elseif(isset($_GET['desde'])&&$_GET['desde']!=''&&(!isset($_GET['hasta']) OR $_GET['hasta']=='')){
	$subquery = "
	MIN(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMin,
	MAX(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMax,
	AVG(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedProm,
	STDDEV(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedDesStan,
	";
//solo hasta	
}elseif(isset($_GET['hasta'])&&$_GET['hasta']!=''&&(!isset($_GET['desde']) OR $_GET['desde']=='')){
	$subquery = "
	MIN(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMin,
	MAX(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMax,
	AVG(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedProm,
	STDDEV(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedDesStan,
	";
//ninguno
}else{
	$subquery = "
	MIN(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedMin,
	MAX(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedMax,
	AVG(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedProm,
	STDDEV(NULLIF(IF(backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<99900,backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedDesStan,
	";
}	
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 

telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".$_GET['sensorn']." AS SensorNombre,


backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,

".$subquery."

telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".$_GET['sensorn']."

".$z."
GROUP BY backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema
ORDER BY backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC
LIMIT 10000
";
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
            ->setCellValue('A1', 'CONTROL Sensor N° '.$_GET['sensorn'].' '.$arrRutas[0]['SensorNombre'])
            ->setCellValue('A3', 'Nombre Equipo')
            ->setCellValue('B3', $arrRutas[0]['NombreEquipo'])
            ->setCellValue('A5', 'Nombre Sensor')
            ->setCellValue('B5', $arrRutas[0]['SensorNombre']);
//Si se ven detalles
if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B6', $arrRutas[0]['Unimed'].' Promedio')
            ->setCellValue('C6', $arrRutas[0]['Unimed'].' Minimo')
            ->setCellValue('D6', $arrRutas[0]['Unimed'].' Maximo')
            ->setCellValue('E6', 'Dev. Std.');					
//Si no se ven detalles	
}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B6', $arrRutas[0]['Unimed'].' Promedio');								
}
                 					                              

  
  
         
$nn=7;
foreach ($arrRutas as $rutas) {
	//Verifico si existen datos
	if(isset($rutas['MedMin'])&&$rutas['MedMin']!=0&&$rutas['MedMin']!=''&&isset($rutas['MedMax'])&&$rutas['MedMax']!=0&&$rutas['MedMax']!=''){
									
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, fecha_estandar($rutas['FechaSistema']));			
		//Si se ven detalles
		if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$nn, Cantidades($rutas['MedProm'], 2))
					->setCellValue('C'.$nn, Cantidades($rutas['MedMin'], 2))
					->setCellValue('D'.$nn, Cantidades($rutas['MedMax'], 2))
					->setCellValue('E'.$nn, Cantidades($rutas['MedDesStan'], 2));		
		//Si no se ven detalles	
		}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B'.$nn, Cantidades($rutas['MedProm'], 2));								
		} 

		$nn++;
	}           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Desviacion estandar');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Desviacion estandar.xls"');
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
