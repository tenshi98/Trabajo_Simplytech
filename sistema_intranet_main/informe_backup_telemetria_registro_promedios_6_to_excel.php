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

/**********************************************************************/
/********************************************************************/
//se verifica si se ingreso la hora, es un dato optativo
$subf='';
//Datos opcionales
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$subf.=" AND (TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$subf.=" AND (FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}

/**********************************************************************/
//Funcion para escribir datos
function crear_data($cantsens, $filtro, $idTelemetria, $f_inicio, $f_termino, $desde, $hasta, $dbConn ) {
	
	$consql = '';
	$subfiltro = '';
	for ($i = 1; $i <= $cantsens; $i++) {
		//$subfiltro .= ' AND backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.' != 999';
		$consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
		//$consql .= ',telemetria_listado.SensoresNombre_'.$i.' AS SensorNombre_'.$i;
		$consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
		
		
		//desde y hasta activo
		if(isset($desde)&&$desde!=''&&isset($hasta)&&$hasta!=''){
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedDesStan_'.$i;
		//solo desde	
		}elseif(isset($desde)&&$desde!=''&&(!isset($hasta) OR $hasta=='')){
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedDesStan_'.$i;
		//solo hasta	
		}elseif(isset($hasta)&&$hasta!=''&&(!isset($desde) OR $desde=='')){
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedDesStan_'.$i;
		//ninguno
		}else{
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedDesStan_'.$i;
		}
	}

	/*******************************************************/
	//se consulta
	$SIS_query = 'backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.FechaSistema'.$consql;
	$SIS_join  = 'LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.idTelemetria';
	$SIS_where = 'idTabla!=0 '.$filtro.$subfiltro.' GROUP BY backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.FechaSistema';
	$SIS_order = 'backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.FechaSistema ASC LIMIT 10000';
	$arrRutas = array();
	$arrRutas = db_select_array (false, $SIS_query, 'backup_telemetria_listado_tablarelacionada_'.$idTelemetria, $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrRutas');
	
	return $arrRutas;
	
}
/*******************************************************/
//Consulta por la cantidad de sensores
$SIS_query = 'cantSensores, Nombre';
$SIS_where = 'idTelemetria='.$_GET['idTelemetria'];
$rowEquipo = db_select_data (false, $SIS_query, 'telemetria_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEquipo');

/*******************************************************/
//se consulta
//Variable temporal
$arrTemporal = array();	
//Llamo a la funcion
$arrTemporal = crear_data($rowEquipo['cantSensores'], $subf, $_GET['idTelemetria'], $_GET['f_inicio'], $_GET['f_termino'], $_GET['desde'], $_GET['hasta'] , $dbConn);
 
/*******************************************************************/
/*******************************************************************/
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


/***********************************************************/
//Titulo columnas
if(isset($_GET['idOpciones'])&&$_GET['idOpciones']!=''&&$_GET['idOpciones']!=0){ 
	switch ($_GET['idOpciones']) {
		case 1:
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'Equipo')
						->setCellValue('B1', 'Fecha')
						->setCellValue('C1', 'Temperatura (°C)');
			break;
		case 2:
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'Equipo')
						->setCellValue('B1', 'Fecha')
						->setCellValue('C1', 'Humedad (%)');
			break;
	}
}else{
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Equipo')
				->setCellValue('B1', 'Fecha')
				->setCellValue('C1', 'Temperatura (°C)')
				->setCellValue('D1', 'Humedad (%)');
}
						



$nn=2; 
foreach ($arrTemporal as $fac) {
	//numero sensores equipo
	$Temperatura    = 0;
	$Temperatura_N  = 0;
	$Humedad        = 0;
	$Humedad_N      = 0;
											
	for ($x = 1; $x <= $rowEquipo['cantSensores']; $x++) {
		if($fac['SensoresGrupo_'.$x]==$_GET['idGrupo']){
			//Que el valor medido sea distinto de 999
			if(isset($fac['MedProm_'.$x])&&$fac['MedProm_'.$x]<99900){
				//Si es humedad
				if($fac['SensoresUniMed_'.$x]==2){$Humedad = $Humedad + $fac['MedProm_'.$x];$Humedad_N++;}
				//Si es temperatura
				if($fac['SensoresUniMed_'.$x]==3){$Temperatura = $Temperatura + $fac['MedProm_'.$x];$Temperatura_N++;}
			}
		}
	}
											
	if($Temperatura_N!=0){  $New_Temperatura = $Temperatura/$Temperatura_N; }else{$New_Temperatura = 0;}
	if($Humedad_N!=0){      $New_Humedad     = $Humedad/$Humedad_N;         }else{$New_Humedad = 0;}
	
	//omite la linea mientras alguna de las variables contenga datos
	if($Temperatura_N!=0 OR $Humedad_N!=0){
		if(isset($_GET['idOpciones'])&&$_GET['idOpciones']!=''&&$_GET['idOpciones']!=0){ 
			switch ($_GET['idOpciones']) {
				case 1:
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$nn, $rowEquipo['Nombre'])
								->setCellValue('B'.$nn, $fac['FechaSistema'])
								->setCellValue('C'.$nn, $New_Temperatura); 
					break;
				case 2:
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$nn, $rowEquipo['Nombre'])
								->setCellValue('B'.$nn, $fac['FechaSistema'])
								->setCellValue('C'.$nn, $New_Humedad); 
					break;
			}
		}else{
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$nn, $rowEquipo['Nombre'])
						->setCellValue('B'.$nn, $fac['FechaSistema'])
						->setCellValue('C'.$nn, $New_Temperatura)
						->setCellValue('D'.$nn, $New_Humedad); 
		}					
							
		$nn++;
	}					
}
	
	/***********************************************************/
	// Rename worksheet
	$super_titulo = cortar($rowEquipo['Nombre'], 25);
	$objPHPExcel->getActiveSheet(0)->setTitle($super_titulo);
	


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Promedio Camara del equipo '.$rowEquipo['Nombre'].'.xls"');
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
