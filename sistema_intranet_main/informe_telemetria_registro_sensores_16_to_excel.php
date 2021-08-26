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
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrRutas,$row );
}

/*************************************************************************/
//Se traen todas las unidades de medida
if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
	$SIS_where = 'idGrupo='.$_GET['idGrupo'];
}else{
	//busco los grupos disponibles
	$arrSubgrupos = array();
	$SIS_where    = 'idGrupo=0';		
	foreach ($arrRutas as $fac) {
		$N_Maximo_Sensores  = $fac['cantSensores'];
		for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
			$arrSubgrupos[$fac['SensoresGrupo_'.$x]]['idGrupo'] = $fac['SensoresGrupo_'.$x];
		}
	}
	foreach($arrSubgrupos as $categoria=>$sub){
		$SIS_where .= ' OR idGrupo='.$sub['idGrupo'];	
	}
	
}

//consulto
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo, Nombre', 'telemetria_listado_grupos', '', $SIS_where, 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrGrupos');
$rowUnimed = db_select_data (false, 'idUniMed, Nombre', 'telemetria_listado_unidad_medida', '', 'idUniMed='.$_GET['idUniMed'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowUnimed');


//se arman datos
$arrTitulo  = array();
//se crean variables vacias
for ($i = 1; $i <= 20; $i++) {
    $arrTitulo[$i]['Nombre'] = '';
}
//se buscan datos
$n          = 1;
foreach ($arrGrupos as $gru) {
	$arrTitulo[$n]['Nombre'] = $gru['Nombre'];
	$n++;
}
$arrData    = array();
$n1         = 1;

foreach ($arrRutas as $fac) {
	//se crean variables vacias
	for ($i = 1; $i <= 20; $i++) {
		$arrData[$n1][$i]['Dato'] = '';
	}							
	//numero sensores equipo
	$N_Maximo_Sensores  = $fac['cantSensores'];
	$arrDato            = array();
	$Dato               = 0;
	$Dato_N             = 0;
	$n2                 = 1;
										
	for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
		//Que el valor medido sea distinto de 999
		if(isset($fac['SensorValue_'.$x])&&$fac['SensorValue_'.$x]<99900){
			//verifico si el grupo existe
			if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
				if($fac['SensoresUniMed_'.$x]==$_GET['idUniMed']&&$fac['SensoresGrupo_'.$x]==$_GET['idGrupo']){
					$Dato = $Dato + $fac['SensorValue_'.$x];
					$Dato_N++;
				}
			}else{
				if($fac['SensoresUniMed_'.$x]==$_GET['idUniMed']){
					$arrDato[$fac['SensoresGrupo_'.$x]]['Valor'] = $arrDato[$fac['SensoresGrupo_'.$x]]['Valor'] + $fac['SensorValue_'.$x];
					$arrDato[$fac['SensoresGrupo_'.$x]]['Cuenta']++;
				}
			}	
		}
	}
										
	//verifico si el grupo existe
	if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
		if($Dato_N!=0){  $New_Dato = $Dato/$Dato_N; }else{$New_Dato = 0;}
		
		$arrData[$n1]['FechaSistema']  = fecha_estandar($fac['FechaSistema']);
		$arrData[$n1]['HoraSistema']   = $fac['HoraSistema'];
		$arrData[$n1][$n2]['Dato']     = cantidades($New_Dato, 2);
		$n2++;
	
	}else{
		$arrData[$n1]['FechaSistema']  = fecha_estandar($fac['FechaSistema']);
		$arrData[$n1]['HoraSistema']   = $fac['HoraSistema'];
		foreach ($arrGrupos as $gru) {
			if(isset($arrDato[$gru['idGrupo']]['Cuenta'])&&$arrDato[$gru['idGrupo']]['Cuenta']!=0){
				$New_Dato = $arrDato[$gru['idGrupo']]['Valor']/$arrDato[$gru['idGrupo']]['Cuenta'];
				$arrData[$n1][$n2]['Dato']     = cantidades($New_Dato, 2);
			}else{
				$arrData[$n1][$n2]['Dato']     = 0;
			}
			$n2++;
		}
	}
	$n1++;
	
}

/*************************************************************************/


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
            ->setCellValue('C1', $arrTitulo[1]['Nombre'])
            ->setCellValue('D1', $arrTitulo[2]['Nombre'])
            ->setCellValue('E1', $arrTitulo[3]['Nombre'])
            ->setCellValue('F1', $arrTitulo[4]['Nombre'])
            ->setCellValue('G1', $arrTitulo[5]['Nombre'])
            ->setCellValue('H1', $arrTitulo[6]['Nombre'])
            ->setCellValue('I1', $arrTitulo[7]['Nombre'])
            ->setCellValue('J1', $arrTitulo[8]['Nombre'])
            ->setCellValue('K1', $arrTitulo[9]['Nombre'])
            ->setCellValue('L1', $arrTitulo[10]['Nombre'])
            ->setCellValue('M1', $arrTitulo[11]['Nombre'])
            ->setCellValue('N1', $arrTitulo[12]['Nombre'])
            ->setCellValue('O1', $arrTitulo[13]['Nombre'])
            ->setCellValue('P1', $arrTitulo[14]['Nombre'])
            ->setCellValue('Q1', $arrTitulo[15]['Nombre'])
            ->setCellValue('R1', $arrTitulo[16]['Nombre'])
            ->setCellValue('S1', $arrTitulo[17]['Nombre'])
            ->setCellValue('T1', $arrTitulo[18]['Nombre'])
            ->setCellValue('U1', $arrTitulo[19]['Nombre'])
            ->setCellValue('V1', $arrTitulo[20]['Nombre']);

 

 
$nn = 2; 
$nw = 1; 
foreach ($arrRutas as $fac) {

	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, $arrData[$nw]['FechaSistema'])
            ->setCellValue('B'.$nn, $arrData[$nw]['HoraSistema'])
            ->setCellValue('C'.$nn, $arrData[$nw][1]['Dato'])
            ->setCellValue('D'.$nn, $arrData[$nw][2]['Dato'])
            ->setCellValue('E'.$nn, $arrData[$nw][3]['Dato'])
            ->setCellValue('F'.$nn, $arrData[$nw][4]['Dato'])
            ->setCellValue('G'.$nn, $arrData[$nw][5]['Dato'])
            ->setCellValue('H'.$nn, $arrData[$nw][6]['Dato'])
            ->setCellValue('I'.$nn, $arrData[$nw][7]['Dato'])
            ->setCellValue('J'.$nn, $arrData[$nw][8]['Dato'])
            ->setCellValue('K'.$nn, $arrData[$nw][9]['Dato'])
            ->setCellValue('L'.$nn, $arrData[$nw][10]['Dato'])
            ->setCellValue('M'.$nn, $arrData[$nw][11]['Dato'])
            ->setCellValue('N'.$nn, $arrData[$nw][12]['Dato'])
            ->setCellValue('O'.$nn, $arrData[$nw][13]['Dato'])
            ->setCellValue('P'.$nn, $arrData[$nw][14]['Dato'])
            ->setCellValue('Q'.$nn, $arrData[$nw][15]['Dato'])
            ->setCellValue('R'.$nn, $arrData[$nw][16]['Dato'])
            ->setCellValue('S'.$nn, $arrData[$nw][17]['Dato'])
            ->setCellValue('T'.$nn, $arrData[$nw][18]['Dato'])
            ->setCellValue('U'.$nn, $arrData[$nw][19]['Dato'])
            ->setCellValue('V'.$nn, $arrData[$nw][20]['Dato']); 					
						
	$nn++;
	$nw++;					
}




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Comparacion Grupos Sensores');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Comparacion Grupos Sensores del equipo '.$arrRutas[0]['NombreEquipo'].'.xls"');
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
