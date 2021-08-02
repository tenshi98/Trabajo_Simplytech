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

//numero sensores equipo
$N_Maximo_Sensores = 72;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
    $consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
    $consql .= ',telemetria_listado.SensoresNombre_'.$i.' AS SensorNombre_'.$i;
    $consql .= ',telemetria_listado.SensoresMedMin_'.$i.' AS SensoresMedMin_'.$i;
    $consql .= ',telemetria_listado.SensoresMedMax_'.$i.' AS SensoresMedMax_'.$i;
    $consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
    $consql .= ',backup_telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.Sensor_'.$i.' AS SensorValue_'.$i;
   
}
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.cantSensores AS cantSensores,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema
".$consql."
FROM `backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

".$z."
ORDER BY backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema ASC
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

//Se traen todas las unidades de medida
$query = "SELECT Nombre
FROM `telemetria_listado_grupos`
WHERE idGrupo='".$_GET['idGrupo']."'";
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

			
$arrData = array();
$arrData[1] = "C";
$arrData[2] = "D";
$arrData[3] = "E";
$arrData[4] = "F";
$arrData[5] = "G";
$arrData[6] = "H";
$arrData[7] = "I";
$arrData[8] = "J";
$arrData[9] = "K";
$arrData[10] = "L";
$arrData[11] = "M";
$arrData[12] = "N";
$arrData[13] = "O";
$arrData[14] = "P";
$arrData[15] = "Q";
$arrData[16] = "R";
$arrData[17] = "S";
$arrData[18] = "T";
$arrData[19] = "U";
$arrData[20] = "V";
$arrData[21] = "W";
$arrData[22] = "X";
$arrData[23] = "Y";
$arrData[24] = "Z";
$arrData[25] = "AA";
$arrData[26] = "AB";
$arrData[27] = "AC";
$arrData[28] = "AD";
$arrData[29] = "AE";
$arrData[30] = "AF";
$arrData[31] = "AG";
$arrData[32] = "AH";
$arrData[33] = "AI";
$arrData[34] = "AJ";
$arrData[35] = "AK";
$arrData[36] = "AL";
$arrData[37] = "AM";
$arrData[38] = "AN";
$arrData[39] = "AO";
$arrData[40] = "AP";
$arrData[41] = "AQ";
$arrData[42] = "AR";
$arrData[43] = "AS";
$arrData[44] = "AT";
$arrData[45] = "AU";
$arrData[46] = "AV";
$arrData[47] = "AW";
$arrData[48] = "AX";
$arrData[49] = "AY";
$arrData[50] = "AZ";
$arrData[51] = "BA";
$arrData[52] = "BB";
$arrData[53] = "BC";
$arrData[54] = "BD";
$arrData[55] = "BE";
$arrData[56] = "BF";
$arrData[57] = "BG";
$arrData[58] = "BH";
$arrData[59] = "BI";
$arrData[60] = "BJ";
$arrData[61] = "BK";
$arrData[62] = "BL";
$arrData[63] = "BM";
$arrData[64] = "BN";
$arrData[65] = "BO";
$arrData[66] = "BP";
$arrData[67] = "BQ";
$arrData[68] = "BR";
$arrData[69] = "BS";
$arrData[70] = "BT";
$arrData[71] = "BU";
$arrData[72] = "BV";
$arrData[73] = "BW";
$arrData[74] = "BX";
$arrData[75] = "BY";
$arrData[76] = "BZ";
$arrData[77] = "CA";
$arrData[78] = "CB";
$arrData[79] = "CC";
$arrData[80] = "CD";
$arrData[81] = "CE";
$arrData[82] = "CF";
$arrData[83] = "CG";
$arrData[84] = "CH";
$arrData[85] = "CI";
$arrData[86] = "CJ";
$arrData[87] = "CK";
$arrData[88] = "CL";
$arrData[89] = "CM";
$arrData[90] = "CN";
$arrData[91] = "CO";
$arrData[92] = "CP";
$arrData[93] = "CQ";
$arrData[94] = "CR";
$arrData[95] = "CS";
$arrData[96] = "CT";
$arrData[97] = "CU";
$arrData[98] = "CV";
$arrData[99] = "CW";
$arrData[100] = "CX";
$arrData[101] = "CY";
$arrData[102] = "CZ";
$arrData[103] = "DA";
$arrData[104] = "DB";
$arrData[105] = "DC";
$arrData[106] = "DD";
$arrData[107] = "DE";
$arrData[108] = "DF";
$arrData[109] = "DG";
$arrData[110] = "DH";
$arrData[111] = "DI";
$arrData[112] = "DJ";
$arrData[113] = "DK";
$arrData[114] = "DL";
$arrData[115] = "DM";
$arrData[116] = "DN";
$arrData[117] = "DO";
$arrData[118] = "DP";
$arrData[119] = "DQ";
$arrData[120] = "DR";
$arrData[121] = "DS";
$arrData[122] = "DT";
$arrData[123] = "DU";
$arrData[124] = "DV";
$arrData[125] = "DW";
$arrData[126] = "DX";
$arrData[127] = "DY";
$arrData[128] = "DZ";


         
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '')
            ->setCellValue('B1', '');
$x = 1;            
for ($i = 1; $i <= $arrRutas[0]['cantSensores']; $i++) { 
	if($arrRutas[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){ 
		//Si se ven detalles
		if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($arrData[$x].'1', $arrRutas[0]['SensorNombre_'.$i]);
						$x++;
						$x++;
						$x++;						
		//Si no se ven detalles	
		}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($arrData[$x].'1', $arrRutas[0]['SensorNombre_'.$i]);
						$x++;						
		}
	}
}           

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Fecha')
            ->setCellValue('B2', 'Hora');                       
$x = 1;            
for ($i = 1; $i <= $arrRutas[0]['cantSensores']; $i++) { 
	if($arrRutas[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){ 
		$x1 = $x;
		$x2 = $x+1;
		$x3 = $x+2;
		
		//Si se ven detalles
		if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($arrData[$x1].'2', 'Medicion')
						->setCellValue($arrData[$x2].'2', 'Minimo')
						->setCellValue($arrData[$x3].'2', 'Maximo');
						$x++;
						$x++;
						$x++;						
		//Si no se ven detalles	
		}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($arrData[$x1].'2', 'Medicion');
						$x++;						
		}
	}
}
 
$nn=3; 

foreach ($arrRutas as $rutas) { 
	$x = 1;
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, $rutas['FechaSistema'])
            ->setCellValue('B'.$nn, $rutas['HoraSistema']); 
            
	for ($i = 1; $i <= $rutas['cantSensores']; $i++) { 
		if($rutas['SensoresGrupo_'.$i]==$_GET['idGrupo']){	
			if(isset($rutas['SensorValue_'.$i])&&$rutas['SensorValue_'.$i]<99900){
				$xdata=Cantidades_decimales_justos($rutas['SensorValue_'.$i]);
			}else{
				$xdata='Sin Datos';
			}
			$x1 = $x;
			$x2 = $x+1;
			$x3 = $x+2;
			
			//Si se ven detalles
			if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($arrData[$x1].$nn, $xdata)
							->setCellValue($arrData[$x2].$nn, Cantidades_decimales_justos($rutas['SensoresMedMin_'.$i]))
							->setCellValue($arrData[$x3].$nn, Cantidades_decimales_justos($rutas['SensoresMedMax_'.$i]));
							$x++;
							$x++;
							$x++;						
			//Si no se ven detalles	
			}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($arrData[$x1].$nn, $xdata);
							$x++;						
			}
		}
	} 
	$nn++;			
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
