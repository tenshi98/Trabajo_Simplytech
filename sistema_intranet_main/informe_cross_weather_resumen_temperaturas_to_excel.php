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
/**********************************************************/
//Seleccionar la tabla
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){ 
	$x_table = 'telemetria_listado_aux_equipo';
}else{
	$x_table = 'telemetria_listado_aux';
}
//se verifica si se ingreso la hora, es un dato optativo
//Variable de busqueda
$z = "WHERE ".$x_table.".idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" AND (".$x_table.".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" AND (".$x_table.".Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){ 
	$z.=" AND ".$x_table.".idTelemetria='".$_GET['idTelemetria']."'";
}
/**********************************************************/
// Se trae un listado con todos los datos
$arrHistorial = array();
$query = "SELECT Fecha, Hora, HeladaDia, HeladaHora, Temperatura, Helada, CrossTech_TempMin ,
Fecha_Anterior, Hora_Anterior, Tiempo_Helada

FROM `".$x_table."`
".$z."
ORDER BY idAuxiliar ASC";
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
array_push( $arrHistorial,$row );
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

			
 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Fecha')
            ->setCellValue('B1', 'Hora')
            ->setCellValue('C1', 'Temperatura Real')
            ->setCellValue('D1', 'Temperatura Proyectada');

 


/****************************************************************************/
$arrTemp   = array();
foreach($arrHistorial as $hist2) {
	//verifico que exista fecha
	if(isset($hist2['Fecha'])&&$hist2['Fecha']!='0000-00-00'){
		//Se obtiene la fecha
		$y_dia = fecha2NdiaMes($hist2['Fecha']);
		$y_mes = fecha2NMes($hist2['Fecha']);
		//se obtiene la hora
		$y_time   = strtotime($hist2['Hora']);
		$y_hora   = date('H', $y_time);
		$y_minuto = date('i', $y_time);
		//se guardan los datos
		$arrTemp[$y_mes][$y_dia][$y_hora][$y_minuto] = $hist2['Temperatura'];
	}
}
/****************************************************************************/
//datos graficos
$nn     = 2; 
foreach($arrHistorial as $hist) { 
	//verifico que exista fecha
	if(isset($hist['HeladaDia'])&&$hist['HeladaDia']!='0000-00-00'){
		//variables
		$temp_predic = $hist['Helada'];
		
		//Se obtiene la fecha
		$x_dia = fecha2NdiaMes($hist['HeladaDia']);
		$x_mes = fecha2NMes($hist['HeladaDia']);
		$x_ano = fecha2Ano($hist['HeladaDia']);
		//se obtiene la hora
		$x_time     = strtotime($hist['HeladaHora']);
		$x_hora     = date('H', $x_time);
		$x_minuto   = date('i', $x_time);
		
		//Se crea el dato
		if(isset($arrTemp[$x_mes][$x_dia][$x_hora][$x_minuto])&&$arrTemp[$x_mes][$x_dia][$x_hora][$x_minuto]!=''){							
			$temp_real = $arrTemp[$x_mes][$x_dia][$x_hora][$x_minuto];
		}else{
			$temp_real = 0;
		}

		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, $x_dia.'-'.$x_mes.'-'.$x_ano)
					->setCellValue('B'.$nn, $x_hora.':'.$x_minuto)
					->setCellValue('C'.$nn, Cantidades($temp_real, 2))
					->setCellValue('D'.$nn, Cantidades($temp_predic, 2)); 					
								
		$nn++;	
	}
				
}





// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Informe Temperaturas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Temperaturas.xls"');
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
