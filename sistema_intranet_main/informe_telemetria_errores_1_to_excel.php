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
$z="WHERE telemetria_listado_errores.idErrores>0"; 
$z.=" AND telemetria_listado_errores.idTipo!='999'";
$z.=" AND telemetria_listado_errores.Valor<'99900'";
$z.=" AND telemetria_listado.id_Geo='1'";
$z.=" AND telemetria_listado_errores.idSistema=".$_GET['idSistema'];
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=3";//CrossTrack			
}
//verifico si existen los parametros de fecha
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" AND telemetria_listado_errores.Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
//verifico si se selecciono un equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z.=" AND telemetria_listado_errores.idTelemetria='".$_GET['idTelemetria']."'";
}
//verifico el tipo de error
if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''){
	$z.=" AND telemetria_listado_errores.idTipo='".$_GET['idTipo']."'";
}
//Verifico el tipo de usuario que esta ingresando
if($_GET['idTipoUsuario']==1){
	$join = "";	
}else{
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado_errores.idTelemetria ";
	$z.=" AND usuarios_equipos_telemetria.idUsuario=".$_SESSION['usuario']['basic_data']['idUsuario'];
}

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresUniMed_'.$i;
}
// Se trae un listado con todos los elementos
$arrErrores = array();
$query = "SELECT 
telemetria_listado_errores.idErrores,
telemetria_listado_errores.Descripcion, 
telemetria_listado_errores.Fecha, 
telemetria_listado_errores.Hora,
telemetria_listado_errores.Sensor, 
telemetria_listado_errores.Valor,
telemetria_listado_errores.Valor_min,
telemetria_listado_errores.Valor_max,
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.id_Geo
".$subquery."

FROM `telemetria_listado_errores`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria
".$join." 
".$z."
ORDER BY idErrores DESC ";
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

//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUnimed');

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
            ->setCellValue('F1', 'Min')
            ->setCellValue('G1', 'Max')
            ->setCellValue('H1', 'Unidad Medida');       
                                
         
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
				->setCellValue('F'.$nn, $error['Valor_min'])
				->setCellValue('G'.$nn, $error['Valor_max'])
				->setCellValue('H'.$nn, $unimed);
	$nn++;           
   
} 
						

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Resumen de Alertas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Resumen de Alertas.xls"');
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
