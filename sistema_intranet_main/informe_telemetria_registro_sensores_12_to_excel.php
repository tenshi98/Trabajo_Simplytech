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
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
 
//numero sensores equipo
$N_Maximo_Sensores = 72;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
    $consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
    $consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
    $consql .= ',telemetria_listado.SensoresActivo_'.$i.' AS SensoresActivo_'.$i;
    $consql .= ',telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.Sensor_'.$i.' AS SensorValue_'.$i;
   
}
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.cantSensores AS cantSensores,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema
".$consql."
FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

".$z."
ORDER BY telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema ASC
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

//Se trae el dato del grupo
$rowGrupo = db_select_data (false, 'Nombre', 'telemetria_listado_grupos', '', 'idGrupo='.$_GET['idGrupo'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowGrupo');


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
            ->setCellValue('A1', 'Fecha')
            ->setCellValue('B1', 'Hora')
            ->setCellValue('C1', 'Temperatura')
            ->setCellValue('D1', 'Humedad');

 
$nn=2; 
foreach ($arrRutas as $fac) {
	//numero sensores equipo
	$N_Maximo_Sensores = $fac['cantSensores'];
	$Temperatura       = 0;
	$Temperatura_N     = 0;
	$Humedad           = 0;
	$Humedad_N         = 0;
											
	for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
		if($fac['SensoresGrupo_'.$x]==$_GET['idGrupo']){
			//Verifico si el sensor esta activo para guardar el dato
			if(isset($fac['SensoresActivo_'.$x])&&$fac['SensoresActivo_'.$x]==1){
				//Que el valor medido sea distinto de 999
				if(isset($fac['SensorValue_'.$x])&&$fac['SensorValue_'.$x]<99900){
					//Si es humedad
					if($fac['SensoresUniMed_'.$x]==2){$Humedad = $Humedad + $fac['SensorValue_'.$x];$Humedad_N++;}
					//Si es temperatura
					if($fac['SensoresUniMed_'.$x]==3){$Temperatura = $Temperatura + $fac['SensorValue_'.$x];$Temperatura_N++;}
				}
			}
		}
	}
											
	if($Temperatura_N!=0){  $New_Temperatura = $Temperatura/$Temperatura_N; }else{$New_Temperatura = 0;}
	if($Humedad_N!=0){      $New_Humedad     = $Humedad/$Humedad_N;         }else{$New_Humedad = 0;}
	
	//omite la linea mientras alguna de las variables contenga datos
	if($Temperatura_N!=0 OR $Humedad_N!=0){
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $fac['FechaSistema'])
				->setCellValue('B'.$nn, $fac['HoraSistema'])
				->setCellValue('C'.$nn, $New_Temperatura)
				->setCellValue('D'.$nn, $New_Humedad); 					
							
		$nn++;	
	}				
}




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Informe Sensores');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Trazabilidad del equipo '.$arrRutas[0]['NombreEquipo'].'.xls"');
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
