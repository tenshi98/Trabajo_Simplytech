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
//variables
$xx = 1;
$arrData = array();
$arrData[$xx] = "C";$xx++;
$arrData[$xx] = "D";$xx++;
$arrData[$xx] = "E";$xx++;
$arrData[$xx] = "F";$xx++;
$arrData[$xx] = "G";$xx++;
$arrData[$xx] = "H";$xx++;
$arrData[$xx] = "I";$xx++;
$arrData[$xx] = "J";$xx++;
$arrData[$xx] = "K";$xx++;
$arrData[$xx] = "L";$xx++;
$arrData[$xx] = "M";$xx++;
$arrData[$xx] = "N";$xx++;
$arrData[$xx] = "O";$xx++;
$arrData[$xx] = "P";$xx++;
$arrData[$xx] = "Q";$xx++;
$arrData[$xx] = "R";$xx++;
$arrData[$xx] = "S";$xx++;
$arrData[$xx] = "T";$xx++;
$arrData[$xx] = "U";$xx++;
$arrData[$xx] = "V";$xx++;
$arrData[$xx] = "W";$xx++;
$arrData[$xx] = "X";$xx++;
$arrData[$xx] = "Y";$xx++;
$arrData[$xx] = "Z";$xx++;
$arrData[$xx] = "AA";$xx++;
$arrData[$xx] = "AB";$xx++;
$arrData[$xx] = "AC";$xx++;
$arrData[$xx] = "AD";$xx++;
$arrData[$xx] = "AE";$xx++;
$arrData[$xx] = "AF";$xx++;
$arrData[$xx] = "AG";$xx++;
$arrData[$xx] = "AH";$xx++;
$arrData[$xx] = "AI";$xx++;
$arrData[$xx] = "AJ";$xx++;
$arrData[$xx] = "AK";$xx++;
$arrData[$xx] = "AL";$xx++;
$arrData[$xx] = "AM";$xx++;
$arrData[$xx] = "AN";$xx++;
$arrData[$xx] = "AO";$xx++;
$arrData[$xx] = "AP";$xx++;
$arrData[$xx] = "AQ";$xx++;
$arrData[$xx] = "AR";$xx++;
$arrData[$xx] = "AS";$xx++;
$arrData[$xx] = "AT";$xx++;
$arrData[$xx] = "AU";$xx++;
$arrData[$xx] = "AV";$xx++;
$arrData[$xx] = "AW";$xx++;
$arrData[$xx] = "AX";$xx++;
$arrData[$xx] = "AY";$xx++;
$arrData[$xx] = "AZ";$xx++;
$arrData[$xx] = "BA";$xx++;
$arrData[$xx] = "BB";$xx++;
$arrData[$xx] = "BC";$xx++;
$arrData[$xx] = "BD";$xx++;
$arrData[$xx] = "BE";$xx++;
$arrData[$xx] = "BF";$xx++;
$arrData[$xx] = "BG";$xx++;
$arrData[$xx] = "BH";$xx++;
$arrData[$xx] = "BI";$xx++;
$arrData[$xx] = "BJ";$xx++;
$arrData[$xx] = "BK";$xx++;
$arrData[$xx] = "BL";$xx++;
$arrData[$xx] = "BM";$xx++;
$arrData[$xx] = "BN";$xx++;
$arrData[$xx] = "BO";$xx++;
$arrData[$xx] = "BP";$xx++;
$arrData[$xx] = "BQ";$xx++;
$arrData[$xx] = "BR";$xx++;
$arrData[$xx] = "BS";$xx++;
$arrData[$xx] = "BT";$xx++;
$arrData[$xx] = "BU";$xx++;
$arrData[$xx] = "BV";$xx++;
$arrData[$xx] = "BW";$xx++;
$arrData[$xx] = "BX";$xx++;
$arrData[$xx] = "BY";$xx++;
$arrData[$xx] = "BZ";$xx++;
$arrData[$xx] = "CA";$xx++;
$arrData[$xx] = "CB";$xx++;
$arrData[$xx] = "CC";$xx++;
$arrData[$xx] = "CD";$xx++;
$arrData[$xx] = "CE";$xx++;
$arrData[$xx] = "CF";$xx++;
$arrData[$xx] = "CG";$xx++;
$arrData[$xx] = "CH";$xx++;
$arrData[$xx] = "CI";$xx++;
$arrData[$xx] = "CJ";$xx++;
$arrData[$xx] = "CK";$xx++;
$arrData[$xx] = "CL";$xx++;
$arrData[$xx] = "CM";$xx++;
$arrData[$xx] = "CN";$xx++;
$arrData[$xx] = "CO";$xx++;
$arrData[$xx] = "CP";$xx++;
$arrData[$xx] = "CQ";$xx++;
$arrData[$xx] = "CR";$xx++;
$arrData[$xx] = "CS";$xx++;
$arrData[$xx] = "CT";$xx++;
$arrData[$xx] = "CU";$xx++;
$arrData[$xx] = "CV";$xx++;
$arrData[$xx] = "CW";$xx++;
$arrData[$xx] = "CX";$xx++;
/**********************************************************************/
//se verifica si se ingreso la hora, es un dato optativo
$subf='';
//Datos opcionales
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$subf.=" AND (TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$subf.=" AND (FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
/**********************************************************************/
//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnimed,$row );
}
/**********************************************************************/
//Se traen todos los grupos
$arrGrupo = array();
$query = "SELECT idGrupo, Nombre
FROM `telemetria_listado_grupos` ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGrupo,$row );
}

/**********************************************************************/
//Funcion para escribir datos
function crear_data($cantsens, $filtro, $idTelemetria, $f_inicio, $f_termino, $desde, $hasta, $dbConn ) {
	
	$consql = '';
	$subfiltro = '';
	for ($i = 1; $i <= $cantsens; $i++) {
		//$subfiltro .= ' AND telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.' != 999';
		$consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
		$consql .= ',telemetria_listado.SensoresNombre_'.$i.' AS SensorNombre_'.$i;
		$consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
		
		
		//desde y hasta activo
		if(isset($desde)&&$desde!=''&&isset($hasta)&&$hasta!=''){
			$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedMin_'.$i;
			$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedProm_'.$i;
			$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedDesStan_'.$i;
		//solo desde	
		}elseif(isset($desde)&&$desde!=''&&(!isset($hasta) OR $hasta=='')){
			$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMin_'.$i;
			$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedProm_'.$i;
			$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedDesStan_'.$i;
		//solo hasta	
		}elseif(isset($hasta)&&$hasta!=''&&(!isset($desde) OR $desde=='')){
			$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMin_'.$i;
			$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedProm_'.$i;
			$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedDesStan_'.$i;
		//ninguno
		}else{
			$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedMin_'.$i;
			$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedProm_'.$i;
			$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'!=999,telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedDesStan_'.$i;
		}
	}

	//Se traen todos los registros
	$arrRutas = array();
	$query = "SELECT 
	telemetria_listado.Nombre AS NombreEquipo,
	telemetria_listado.cantSensores AS cantSensores,
	telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema
	".$consql."
	FROM `telemetria_listado_tablarelacionada_".$idTelemetria."`
	LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = telemetria_listado_tablarelacionada_".$idTelemetria.".idTelemetria
	WHERE idTabla!=0
	".$filtro.$subfiltro." 
	GROUP BY telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema
	ORDER BY telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema ASC";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//variables
		$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Usuario: ". $NombreUsr, 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
						
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrRutas,$row );
	}
	return $arrRutas;
	
}

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


/*********************************************************************************/
//Verifico si se selecciono el equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	//Consulta por la cantidad de sensores
	$query = "SELECT cantSensores, Nombre
	FROM `telemetria_listado`
	WHERE idTelemetria=".$_GET['idTelemetria'];
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//variables
		$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Usuario: ". $NombreUsr, 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
						
	}
	$rowEquipo = mysqli_fetch_assoc ($resultado);
	//Variable temporal
	$arrTemporal = array();	
	//Llamo a la funcion
	$arrTemporal = crear_data($rowEquipo['cantSensores'], $subf, $_GET['idTelemetria'], $_GET['f_inicio'], $_GET['f_termino'], $_GET['desde'], $_GET['hasta'] , $dbConn);
	
	/***********************************************************/
	$yy = 1;
	//Grupos de los sensores
	for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) { 
		$grupo = '';
		foreach ($arrGrupo as $sen) { 
			if($arrTemporal[0]['SensoresGrupo_'.$i]==$sen['idGrupo']){
				$grupo = $sen['Nombre'];
			}
		}
		if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
			if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){
				//Si se ven detalles
				if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
								$yy++;
								$yy++;
								$yy++;
								$yy++;
				//Si no se ven detalles	
				}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
								$yy++;
				}
			}
		}else{
			//Si se ven detalles
			if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
							$yy++;
							$yy++;
							$yy++;
							$yy++;
			//Si no se ven detalles	
			}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
							$yy++;
			}
		}
							
	}
						
						

	 
	/***********************************************************/
	//Titulo columnas
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A2', 'Equipo')
				->setCellValue('B2', 'Fecha');
	
	$yy = 1;			
	for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
		if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
			if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){
				//Si se ven detalles
				if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
					$yy1 = $yy;
					$yy2 = $yy + 1;
					$yy3 = $yy + 2;
					$yy4 = $yy + 3;
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue($arrData[$yy1].'2', 'Promedio' )
								->setCellValue($arrData[$yy2].'2', 'Maximo' )
								->setCellValue($arrData[$yy3].'2', 'Minimo' )
								->setCellValue($arrData[$yy4].'2', 'Dev. Std.' );
								$yy++;
								$yy++;
								$yy++;
								$yy++;
				//Si no se ven detalles	
				}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue($arrData[$yy].'2', 'Promedio');
								$yy++;
				}
			}
		}else{
			//Si se ven detalles
			if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
				$yy1 = $yy;
				$yy2 = $yy + 1;
				$yy3 = $yy + 2;
				$yy4 = $yy + 3;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($arrData[$yy1].'2', 'Promedio' )
							->setCellValue($arrData[$yy2].'2', 'Maximo' )
							->setCellValue($arrData[$yy3].'2', 'Minimo' )
							->setCellValue($arrData[$yy4].'2', 'Dev. Std.' );
							$yy++;
							$yy++;
							$yy++;
							$yy++;
			//Si no se ven detalles	
			}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($arrData[$yy].'2', 'Promedio');
							$yy++;
			}
		}
	}
				
	 
	/***********************************************************/
	//Datos        
	$nn=3;
	foreach ($arrTemporal as $rutas) {
		//Verifico la existencia de datos
		$cuenta_xx = 0;
		for ($i = 1; $i <= $rutas['cantSensores']; $i++) {
			if(isset($rutas['MedMin_'.$i])&&$rutas['MedMin_'.$i]!=0&&$rutas['MedMin_'.$i]!=''&&isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=0&&$rutas['MedMax_'.$i]!=''){
				$cuenta_xx++;
			}	
		}			
		//Si existen datos imprimo
		if($cuenta_xx!=0){ 
												
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$nn, $rutas['NombreEquipo'])
						->setCellValue('B'.$nn, fecha_estandar($rutas['FechaSistema']));
			$yy = 1;
			for ($i = 1; $i <= $rutas['cantSensores']; $i++) {
				if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
					if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){
						$unimed = '';
						foreach ($arrUnimed as $sen) { 
							if($rutas['SensoresUniMed_'.$i]==$sen['idUniMed']){
								$unimed = ' '.$sen['Nombre'];
							}
						}
						//Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
							$yy1 = $yy;
							$yy2 = $yy + 1;
							$yy3 = $yy + 2;
							$yy4 = $yy + 3;
							if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_1 = Cantidades($rutas['MedProm_'.$i], 2);    }else{$mvar_1 = 'Sin Datos';}
							if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_2 = Cantidades($rutas['MedMax_'.$i], 2);     }else{$mvar_2 = 'Sin Datos';}
							if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_3 = Cantidades($rutas['MedMin_'.$i], 2);     }else{$mvar_3 = 'Sin Datos';}
							if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_4 = Cantidades($rutas['MedDesStan_'.$i], 2); }else{$mvar_4 = 'Sin Datos';}
							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue($arrData[$yy1].$nn, $mvar_1 )
										->setCellValue($arrData[$yy2].$nn, $mvar_2 )
										->setCellValue($arrData[$yy3].$nn, $mvar_3 )
										->setCellValue($arrData[$yy4].$nn, $mvar_4 );
										$yy++;
										$yy++;
										$yy++;
										$yy++;
									
						//Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
							if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_1 = Cantidades($rutas['MedProm_'.$i], 2);}else{$mvar_1 = 'Sin Datos';}
							$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue($arrData[$yy].$nn, $mvar_1);
										$yy++;
						}
					}
				}else{
					$unimed = '';
					foreach ($arrUnimed as $sen) { 
						if($rutas['SensoresUniMed_'.$i]==$sen['idUniMed']){
							$unimed = ' '.$sen['Nombre'];
						}
					}
					//Si se ven detalles
					if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
						$yy1 = $yy;
						$yy2 = $yy + 1;
						$yy3 = $yy + 2;
						$yy4 = $yy + 3;
						if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_1 = Cantidades($rutas['MedProm_'.$i], 2);     }else{$mvar_1 = 'Sin Datos';}
						if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_2 = Cantidades($rutas['MedMax_'.$i], 2);      }else{$mvar_2 = 'Sin Datos';}
						if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_3 = Cantidades($rutas['MedMin_'.$i], 2);      }else{$mvar_3 = 'Sin Datos';}
						if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_4 = Cantidades($rutas['MedDesStan_'.$i], 2);  }else{$mvar_4 = 'Sin Datos';}
						$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue($arrData[$yy1].$nn, $mvar_1 )
									->setCellValue($arrData[$yy2].$nn, $mvar_2 )
									->setCellValue($arrData[$yy3].$nn, $mvar_3 )
									->setCellValue($arrData[$yy4].$nn, $mvar_4 );
									$yy++;
									$yy++;
									$yy++;
									$yy++;
					//Si no se ven detalles	
					}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
						if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){$mvar_1 = Cantidades($rutas['MedProm_'.$i], 2);}else{$mvar_1 = 'Sin Datos';}
						$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue($arrData[$yy].$nn, $mvar_1);
									$yy++;
					}
				} 
												
			}
		}
	
			   
	 $nn++;           
	   
	} 
	/***********************************************************/
	// Rename worksheet
	$super_titulo = 'Hoja 1';
	if(isset($arrTemporal[0]['NombreEquipo'])&&$arrTemporal[0]['NombreEquipo']!=''){
		$super_titulo = cortar($arrTemporal[0]['NombreEquipo'], 25);
	}
	$objPHPExcel->getActiveSheet(0)->setTitle($super_titulo);
	
//Si no se slecciono se traen todos los equipos a los cuales tiene permiso	
}else{
	//Inicia variable
	$z="WHERE telemetria_listado.idTelemetria>0"; 
	$z.=" AND telemetria_listado.id_Geo='2'";

	//Verifico el tipo de usuario que esta ingresando
	if($_GET['idTipoUsuario']==1){
		$z.=" AND telemetria_listado.idSistema>=0";
		$join = "";	
	}else{
		$z.=" AND telemetria_listado.idSistema={$_GET['idSistema']}";
		$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";
		$z.=" AND usuarios_equipos_telemetria.idUsuario={$_GET['idUsuario']}";	
	}
	
	/*********************************************/
	// Se trae un listado con todos los usuarios
	$arrEquipos = array();
	$query = "SELECT 
	telemetria_listado.idTelemetria, 
	telemetria_listado.Nombre, 
	telemetria_listado.cantSensores
	FROM `telemetria_listado`
	".$join."  ".$z."
	ORDER BY telemetria_listado.idTelemetria ASC ";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//variables
		$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Usuario: ". $NombreUsr, 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
						
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrEquipos,$row );
	}

	/*********************************************/
	$sheet = 0;
	foreach ($arrEquipos as $equipo) {
		//Variable temporal
		$arrTemporal = array();
		//Se crea nueva hoja
		$objPHPExcel->createSheet();
		//Llamo a la funcion
		$arrTemporal = crear_data($equipo['cantSensores'], $subf, $equipo['idTelemetria'], $_GET['f_inicio'], $_GET['f_termino'], $_GET['desde'], $_GET['hasta'] , $dbConn);
	
		
		/***********************************************************/
		//Grupos de los sensores
		$yy = 1;
		for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) { 
			$grupo = '';
			foreach ($arrGrupo as $sen) { 
				if($arrTemporal[0]['SensoresGrupo_'.$i]==$sen['idGrupo']){
					$grupo = $sen['Nombre'];
				}
			}
			if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
				if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){
					//Si se ven detalles
					if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
						$objPHPExcel->setActiveSheetIndex($sheet)
									->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
									$yy++;
									$yy++;
									$yy++;
									$yy++;
					//Si no se ven detalles	
					}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
						$objPHPExcel->setActiveSheetIndex($sheet)
									->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
									$yy++;
					}
				}
			}else{
				//Si se ven detalles
				if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
					$objPHPExcel->setActiveSheetIndex($sheet)
								->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
								$yy++;
								$yy++;
								$yy++;
								$yy++;
				//Si no se ven detalles	
				}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
					$objPHPExcel->setActiveSheetIndex($sheet)
								->setCellValue($arrData[$yy].'1', $arrTemporal[0]['SensorNombre_'.$i].' ('.$grupo.')');
								$yy++;
				}
			}
								
		}
 
		 
		/***********************************************************/
		//Titulo columnas
		$objPHPExcel->setActiveSheetIndex($sheet)
					->setCellValue('A2', 'Equipo')
					->setCellValue('B2', 'Fecha');
	
		$yy = 1;			
		for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
			if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
				if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){
					//Si se ven detalles
					if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
						$yy1 = $yy;
						$yy2 = $yy + 1;
						$yy3 = $yy + 2;
						$yy4 = $yy + 3;
						$objPHPExcel->setActiveSheetIndex($sheet)
									->setCellValue($arrData[$yy1].'2', 'Promedio' )
									->setCellValue($arrData[$yy2].'2', 'Maximo' )
									->setCellValue($arrData[$yy3].'2', 'Minimo' )
									->setCellValue($arrData[$yy4].'2', 'Dev. Std.' );
									$yy++;
									$yy++;
									$yy++;
									$yy++;
					//Si no se ven detalles	
					}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
						$objPHPExcel->setActiveSheetIndex($sheet)
									->setCellValue($arrData[$yy].'2', 'Promedio');
									$yy++;
					}
				}
			}else{
				//Si se ven detalles
				if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
					$yy1 = $yy;
					$yy2 = $yy + 1;
					$yy3 = $yy + 2;
					$yy4 = $yy + 3;
					$objPHPExcel->setActiveSheetIndex($sheet)
								->setCellValue($arrData[$yy1].'2', 'Promedio' )
								->setCellValue($arrData[$yy2].'2', 'Maximo' )
								->setCellValue($arrData[$yy3].'2', 'Minimo' )
								->setCellValue($arrData[$yy4].'2', 'Dev. Std.' );
								$yy++;
								$yy++;
								$yy++;
								$yy++;
				//Si no se ven detalles	
				}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
					$objPHPExcel->setActiveSheetIndex($sheet)
								->setCellValue($arrData[$yy].'2', 'Promedio');
								$yy++;
				}
			}
		}
	


		 
		/***********************************************************/
		//Datos
		$nn=3;
		foreach ($arrTemporal as $rutas) {
			//Verifico la existencia de datos
			$cuenta_xx = 0;
			for ($i = 1; $i <= $rutas['cantSensores']; $i++) {
				if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
					if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){			
						if(isset($rutas['MedMax_'.$i])&&$rutas['MedMax_'.$i]!=999){
							//nada
						}else{
							$cuenta_xx++;
						}
					}
				}	
			}			
			//Si no existen datos imprimo
			if($cuenta_xx==0){
													
				$objPHPExcel->setActiveSheetIndex($sheet)
							->setCellValue('A'.$nn, $rutas['NombreEquipo'])
							->setCellValue('B'.$nn, fecha_estandar($rutas['FechaSistema']));
				$yy = 1;
				for ($i = 1; $i <= $rutas['cantSensores']; $i++) {
					if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
						if($arrTemporal[0]['SensoresGrupo_'.$i]==$_GET['idGrupo']){
							$unimed = '';
							foreach ($arrUnimed as $sen) { 
								if($rutas['SensoresUniMed_'.$i]==$sen['idUniMed']){
									$unimed = ' '.$sen['Nombre'];
								}
							}
							//Si se ven detalles
							if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
								$yy1 = $yy;
								$yy2 = $yy + 1;
								$yy3 = $yy + 2;
								$yy4 = $yy + 3;
								$objPHPExcel->setActiveSheetIndex($sheet)
											->setCellValue($arrData[$yy1].$nn, Cantidades($rutas['MedProm_'.$i], 2) )
											->setCellValue($arrData[$yy2].$nn, Cantidades($rutas['MedMax_'.$i], 2) )
											->setCellValue($arrData[$yy3].$nn, Cantidades($rutas['MedMin_'.$i], 2) )
											->setCellValue($arrData[$yy4].$nn, Cantidades($rutas['MedDesStan_'.$i], 2) );
											$yy++;
											$yy++;
											$yy++;
											$yy++;
										
							//Si no se ven detalles	
							}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
								$objPHPExcel->setActiveSheetIndex($sheet)
											->setCellValue($arrData[$yy].$nn, Cantidades($rutas['MedProm_'.$i], 2));
											$yy++;
							}
						}
					}else{
						$unimed = '';
						foreach ($arrUnimed as $sen) { 
							if($rutas['SensoresUniMed_'.$i]==$sen['idUniMed']){
								$unimed = ' '.$sen['Nombre'];
							}
						}
						//Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
							$yy1 = $yy;
							$yy2 = $yy + 1;
							$yy3 = $yy + 2;
							$yy4 = $yy + 3;
							$objPHPExcel->setActiveSheetIndex($sheet)
										->setCellValue($arrData[$yy1].$nn, Cantidades($rutas['MedProm_'.$i], 2) )
										->setCellValue($arrData[$yy2].$nn, Cantidades($rutas['MedMax_'.$i], 2) )
										->setCellValue($arrData[$yy3].$nn, Cantidades($rutas['MedMin_'.$i], 2) )
										->setCellValue($arrData[$yy4].$nn, Cantidades($rutas['MedDesStan_'.$i], 2) );
										$yy++;
										$yy++;
										$yy++;
										$yy++;
						//Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
							$objPHPExcel->setActiveSheetIndex($sheet)
										->setCellValue($arrData[$yy].$nn, Cantidades($rutas['MedProm_'.$i], 2));
										$yy++;
						}
					} 								
				}
			}
		
				   
		 $nn++;           
		   
		}

		/***********************************************************/
		// Rename worksheet
		$super_titulo = 'Hoja 1';
		if(isset($arrTemporal[0]['NombreEquipo'])&&$arrTemporal[0]['NombreEquipo']!=''){
			$super_titulo = cortar($arrTemporal[0]['NombreEquipo'], 25);
		}
		$objPHPExcel->getActiveSheet($sheet)->setTitle($super_titulo);
		
		$sheet++;
	}


}	

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
