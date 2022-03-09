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
$SIS_where = "backup_telemetria_listado_errores_999.idErrores>0"; 
$SIS_where.= " AND telemetria_listado.id_Geo='1'";
$SIS_where.= " AND backup_telemetria_listado_errores_999.idSistema=".$_GET['idSistema'];
//verifico si existen los parametros de fecha
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$SIS_where.= " AND backup_telemetria_listado_errores_999.Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
//verifico si se selecciono un equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$SIS_where.= " AND backup_telemetria_listado_errores_999.idTelemetria='".$_GET['idTelemetria']."'";
}
//Verifico el tipo de usuario que esta ingresando
$SIS_join  = 'LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = backup_telemetria_listado_errores_999.idTelemetria';
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$SIS_join .= " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = backup_telemetria_listado_errores_999.idTelemetria ";
	$SIS_where.= " AND usuarios_equipos_telemetria.idUsuario=".$_SESSION['usuario']['basic_data']['idUsuario'];
}
	

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresUniMed_'.$i;
}
// Se trae un listado con todos los elementos
$SIS_query = '
backup_telemetria_listado_errores_999.idErrores,
backup_telemetria_listado_errores_999.Descripcion, 
backup_telemetria_listado_errores_999.Fecha, 
backup_telemetria_listado_errores_999.Hora,
backup_telemetria_listado_errores_999.Sensor, 
backup_telemetria_listado_errores_999.Valor,
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.id_Geo'.$subquery;
$SIS_order = 'idErrores DESC';
$arrErrores = array();
$arrErrores = db_select_array (false, $SIS_query, 'backup_telemetria_listado_errores_999', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrErrores');
 
//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnimed');

$arrFinalUnimed = array();
foreach ($arrUnimed as $sen) {
	$arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];
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
            ->setCellValue('B1', 'Descripcion')
            ->setCellValue('C1', 'Fecha')
            ->setCellValue('D1', 'Hora')
            ->setCellValue('E1', 'Medicion Actual')
            ->setCellValue('F1', 'Unidad Medida');       
                                
         
$nn=2;
foreach ($arrErrores as $error) { 
	//Guardo la unidad de medida
	$unimed = ' '.$arrFinalUnimed[$error['SensoresUniMed_'.$error['Sensor']]];
				
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $error['NombreEquipo'])
				->setCellValue('B'.$nn, $error['Descripcion'])
				->setCellValue('C'.$nn, $error['Fecha'])
				->setCellValue('D'.$nn, $error['Hora'])
				->setCellValue('E'.$nn, $error['Valor'])
				->setCellValue('F'.$nn, $unimed);
	$nn++;           
   
} 
						

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Resumen de Alertas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe de Alertas 999xx.xls"');
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
