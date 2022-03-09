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
$SIS_where = '';
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$SIS_where.="(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$SIS_where.="(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}

//verifico el numero de datos antes de hacer la consulta
$ndata_1 = db_select_nrows (false, 'idTabla', 'telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'], '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'ndata_1');

//si el dato es superior a 10.000
if(isset($ndata_1)&&$ndata_1>=10001){
	alert_post_data(4,1,1, 'Estas tratando de seleccionar mas de 10.000 datos, trata con un rango inferior para poder mostrar resultados');
}else{			
	//obtengo la cantidad real de sensores
	$rowEquipo = db_select_data (false, 'Nombre AS NombreEquipo', 'telemetria_listado', '', 'idTelemetria='.$_GET['idTelemetria'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEquipo');
		
	/****************************************/
	//consulto
	$SIS_query = '
	telemetria_listado.SensoresNombre_'.$_GET['sensorn'].' AS SensorNombre,
	telemetria_listado.SensoresGrupo_'.$_GET['sensorn'].' AS SensorGrupo,

	telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.idTabla,
	telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.FechaSistema,
	telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.HoraSistema,
	telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.Sensor_'.$_GET['sensorn'].' AS SensorValue,
	telemetria_listado_unidad_medida.Nombre AS Unimed';
	$SIS_join  = '
	LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.idTelemetria
	LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_'.$_GET['sensorn'];
	$SIS_order = 'telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.FechaSistema ASC, telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.HoraSistema ASC LIMIT 10000';
	$arrEquipos = array();
	$arrEquipos = db_select_array (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'], $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrEquipos');

	/****************************************/
	//Se trae grupo
	$rowGrupo = db_select_data (false, 'Nombre', 'telemetria_listado_grupos', '', 'idGrupo='.$arrEquipos[0]['SensorGrupo'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowGrupo');
	
	/********************************************************************/
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
				->setCellValue('A1', 'Informe Sensor '.$rowGrupo['Nombre'].' '.$arrEquipos[0]['SensorNombre']);
				
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Fecha')
				->setCellValue('B3', 'Hora')
				->setCellValue('C3', 'Medicion'); 
				
	                       


	$x = 4;
	foreach ($arrEquipos as $rutas) { 
		if(isset($rutas['SensorValue'])&&$rutas['SensorValue']<99900){$xdata=Cantidades_decimales_justos($rutas['SensorValue']).' '.$rutas['Unimed'];}else{$xdata='Sin Datos';}
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$x, $rutas['FechaSistema'])
					->setCellValue('B'.$x, $rutas['HoraSistema'])
					->setCellValue('C'.$x, $xdata); 
					
		//Sumo 1
		$x++;
	}
					

	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Registro Sensores');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Registro Sensores del equipo '.$rowEquipo['NombreEquipo'].'.xls"');
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
}
