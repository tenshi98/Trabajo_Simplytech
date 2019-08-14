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
//Calculo del limit
$set_lim = (5000*$_GET['num'])-4999;
/*******************************************************************************/
//Variables
$xx = 1;
$arrData = array();
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
/*******************************************************************************/
// Se trae un listado con todas las unidades de medida
$arrUnidad = array();
$query = "SELECT idUniMed, Nombre
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
array_push( $arrUnidad,$row );
}
//Creo un arreglo con los datos
$arrUni = array();
foreach ($arrUnidad as $uni) {
	$arrUni[$uni['idUniMed']] = $uni['Nombre'];
}
/*******************************************************************************/
// Se trae un listado con todos los grupos
$arrGrupo = array();
$query = "SELECT idGrupo, Nombre
FROM `telemetria_listado_grupos`
ORDER BY idGrupo ASC";
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
//Creo un arreglo con los datos
$arrGru = array();
foreach ($arrGrupo as $uni) {
	$arrGru[$uni['idGrupo']] = $uni['Nombre'];
}
/*******************************************************************************/
//Funcion para escribir datos
function crear_data($limite, $idTelemetria, $f_inicio, $f_termino, $dbConn ) {
	//Se traen todos los registros
	$arrRutas = array();
	$query = "SELECT 
	telemetria_listado.Nombre AS NombreEquipo,
	telemetria_listado.cantSensores,
	telemetria_listado.SensoresNombre_1 AS SensorNombre_1,
	telemetria_listado.SensoresNombre_2 AS SensorNombre_2,
	telemetria_listado.SensoresNombre_3 AS SensorNombre_3,
	telemetria_listado.SensoresNombre_4 AS SensorNombre_4,
	telemetria_listado.SensoresNombre_5 AS SensorNombre_5,
	telemetria_listado.SensoresNombre_6 AS SensorNombre_6,
	telemetria_listado.SensoresNombre_7 AS SensorNombre_7,
	telemetria_listado.SensoresNombre_8 AS SensorNombre_8,
	telemetria_listado.SensoresNombre_9 AS SensorNombre_9,
	telemetria_listado.SensoresNombre_10 AS SensorNombre_10,
	telemetria_listado.SensoresNombre_11 AS SensorNombre_11,
	telemetria_listado.SensoresNombre_12 AS SensorNombre_12,
	telemetria_listado.SensoresNombre_13 AS SensorNombre_13,
	telemetria_listado.SensoresNombre_14 AS SensorNombre_14,
	telemetria_listado.SensoresNombre_15 AS SensorNombre_15,
	telemetria_listado.SensoresNombre_16 AS SensorNombre_16,
	telemetria_listado.SensoresNombre_17 AS SensorNombre_17,
	telemetria_listado.SensoresNombre_18 AS SensorNombre_18,
	telemetria_listado.SensoresNombre_19 AS SensorNombre_19,
	telemetria_listado.SensoresNombre_20 AS SensorNombre_20,
	telemetria_listado.SensoresNombre_21 AS SensorNombre_21,
	telemetria_listado.SensoresNombre_22 AS SensorNombre_22,
	telemetria_listado.SensoresNombre_23 AS SensorNombre_23,
	telemetria_listado.SensoresNombre_24 AS SensorNombre_24,
	telemetria_listado.SensoresNombre_25 AS SensorNombre_25,
	telemetria_listado.SensoresNombre_26 AS SensorNombre_26,
	telemetria_listado.SensoresNombre_27 AS SensorNombre_27,
	telemetria_listado.SensoresNombre_28 AS SensorNombre_28,
	telemetria_listado.SensoresNombre_29 AS SensorNombre_29,
	telemetria_listado.SensoresNombre_30 AS SensorNombre_30,
	telemetria_listado.SensoresNombre_31 AS SensorNombre_31,
	telemetria_listado.SensoresNombre_32 AS SensorNombre_32,
	telemetria_listado.SensoresNombre_33 AS SensorNombre_33,
	telemetria_listado.SensoresNombre_34 AS SensorNombre_34,
	telemetria_listado.SensoresNombre_35 AS SensorNombre_35,
	telemetria_listado.SensoresNombre_36 AS SensorNombre_36,
	telemetria_listado.SensoresNombre_37 AS SensorNombre_37,
	telemetria_listado.SensoresNombre_38 AS SensorNombre_38,
	telemetria_listado.SensoresNombre_39 AS SensorNombre_39,
	telemetria_listado.SensoresNombre_40 AS SensorNombre_40,
	telemetria_listado.SensoresNombre_41 AS SensorNombre_41,
	telemetria_listado.SensoresNombre_42 AS SensorNombre_42,
	telemetria_listado.SensoresNombre_43 AS SensorNombre_43,
	telemetria_listado.SensoresNombre_44 AS SensorNombre_44,
	telemetria_listado.SensoresNombre_45 AS SensorNombre_45,
	telemetria_listado.SensoresNombre_46 AS SensorNombre_46,
	telemetria_listado.SensoresNombre_47 AS SensorNombre_47,
	telemetria_listado.SensoresNombre_48 AS SensorNombre_48,
	telemetria_listado.SensoresNombre_49 AS SensorNombre_49,
	telemetria_listado.SensoresNombre_50 AS SensorNombre_50,

	telemetria_listado.SensoresUniMed_1 AS SensorUniMed_1,
	telemetria_listado.SensoresUniMed_2 AS SensorUniMed_2,
	telemetria_listado.SensoresUniMed_3 AS SensorUniMed_3,
	telemetria_listado.SensoresUniMed_4 AS SensorUniMed_4,
	telemetria_listado.SensoresUniMed_5 AS SensorUniMed_5,
	telemetria_listado.SensoresUniMed_6 AS SensorUniMed_6,
	telemetria_listado.SensoresUniMed_7 AS SensorUniMed_7,
	telemetria_listado.SensoresUniMed_8 AS SensorUniMed_8,
	telemetria_listado.SensoresUniMed_9 AS SensorUniMed_9,
	telemetria_listado.SensoresUniMed_10 AS SensorUniMed_10,
	telemetria_listado.SensoresUniMed_11 AS SensorUniMed_11,
	telemetria_listado.SensoresUniMed_12 AS SensorUniMed_12,
	telemetria_listado.SensoresUniMed_13 AS SensorUniMed_13,
	telemetria_listado.SensoresUniMed_14 AS SensorUniMed_14,
	telemetria_listado.SensoresUniMed_15 AS SensorUniMed_15,
	telemetria_listado.SensoresUniMed_16 AS SensorUniMed_16,
	telemetria_listado.SensoresUniMed_17 AS SensorUniMed_17,
	telemetria_listado.SensoresUniMed_18 AS SensorUniMed_18,
	telemetria_listado.SensoresUniMed_19 AS SensorUniMed_19,
	telemetria_listado.SensoresUniMed_20 AS SensorUniMed_20,
	telemetria_listado.SensoresUniMed_21 AS SensorUniMed_21,
	telemetria_listado.SensoresUniMed_22 AS SensorUniMed_22,
	telemetria_listado.SensoresUniMed_23 AS SensorUniMed_23,
	telemetria_listado.SensoresUniMed_24 AS SensorUniMed_24,
	telemetria_listado.SensoresUniMed_25 AS SensorUniMed_25,
	telemetria_listado.SensoresUniMed_26 AS SensorUniMed_26,
	telemetria_listado.SensoresUniMed_27 AS SensorUniMed_27,
	telemetria_listado.SensoresUniMed_28 AS SensorUniMed_28,
	telemetria_listado.SensoresUniMed_29 AS SensorUniMed_29,
	telemetria_listado.SensoresUniMed_30 AS SensorUniMed_30,
	telemetria_listado.SensoresUniMed_31 AS SensorUniMed_31,
	telemetria_listado.SensoresUniMed_32 AS SensorUniMed_32,
	telemetria_listado.SensoresUniMed_33 AS SensorUniMed_33,
	telemetria_listado.SensoresUniMed_34 AS SensorUniMed_34,
	telemetria_listado.SensoresUniMed_35 AS SensorUniMed_35,
	telemetria_listado.SensoresUniMed_36 AS SensorUniMed_36,
	telemetria_listado.SensoresUniMed_37 AS SensorUniMed_37,
	telemetria_listado.SensoresUniMed_38 AS SensorUniMed_38,
	telemetria_listado.SensoresUniMed_39 AS SensorUniMed_39,
	telemetria_listado.SensoresUniMed_40 AS SensorUniMed_40,
	telemetria_listado.SensoresUniMed_41 AS SensorUniMed_41,
	telemetria_listado.SensoresUniMed_42 AS SensorUniMed_42,
	telemetria_listado.SensoresUniMed_43 AS SensorUniMed_43,
	telemetria_listado.SensoresUniMed_44 AS SensorUniMed_44,
	telemetria_listado.SensoresUniMed_45 AS SensorUniMed_45,
	telemetria_listado.SensoresUniMed_46 AS SensorUniMed_46,
	telemetria_listado.SensoresUniMed_47 AS SensorUniMed_47,
	telemetria_listado.SensoresUniMed_48 AS SensorUniMed_48,
	telemetria_listado.SensoresUniMed_49 AS SensorUniMed_49,
	telemetria_listado.SensoresUniMed_50 AS SensorUniMed_50,

	telemetria_listado.SensoresGrupo_1 AS SensorGrupo_1,
	telemetria_listado.SensoresGrupo_2 AS SensorGrupo_2,
	telemetria_listado.SensoresGrupo_3 AS SensorGrupo_3,
	telemetria_listado.SensoresGrupo_4 AS SensorGrupo_4,
	telemetria_listado.SensoresGrupo_5 AS SensorGrupo_5,
	telemetria_listado.SensoresGrupo_6 AS SensorGrupo_6,
	telemetria_listado.SensoresGrupo_7 AS SensorGrupo_7,
	telemetria_listado.SensoresGrupo_8 AS SensorGrupo_8,
	telemetria_listado.SensoresGrupo_9 AS SensorGrupo_9,
	telemetria_listado.SensoresGrupo_10 AS SensorGrupo_10,
	telemetria_listado.SensoresGrupo_11 AS SensorGrupo_11,
	telemetria_listado.SensoresGrupo_12 AS SensorGrupo_12,
	telemetria_listado.SensoresGrupo_13 AS SensorGrupo_13,
	telemetria_listado.SensoresGrupo_14 AS SensorGrupo_14,
	telemetria_listado.SensoresGrupo_15 AS SensorGrupo_15,
	telemetria_listado.SensoresGrupo_16 AS SensorGrupo_16,
	telemetria_listado.SensoresGrupo_17 AS SensorGrupo_17,
	telemetria_listado.SensoresGrupo_18 AS SensorGrupo_18,
	telemetria_listado.SensoresGrupo_19 AS SensorGrupo_19,
	telemetria_listado.SensoresGrupo_20 AS SensorGrupo_20,
	telemetria_listado.SensoresGrupo_21 AS SensorGrupo_21,
	telemetria_listado.SensoresGrupo_22 AS SensorGrupo_22,
	telemetria_listado.SensoresGrupo_23 AS SensorGrupo_23,
	telemetria_listado.SensoresGrupo_24 AS SensorGrupo_24,
	telemetria_listado.SensoresGrupo_25 AS SensorGrupo_25,
	telemetria_listado.SensoresGrupo_26 AS SensorGrupo_26,
	telemetria_listado.SensoresGrupo_27 AS SensorGrupo_27,
	telemetria_listado.SensoresGrupo_28 AS SensorGrupo_28,
	telemetria_listado.SensoresGrupo_29 AS SensorGrupo_29,
	telemetria_listado.SensoresGrupo_30 AS SensorGrupo_30,
	telemetria_listado.SensoresGrupo_31 AS SensorGrupo_31,
	telemetria_listado.SensoresGrupo_32 AS SensorGrupo_32,
	telemetria_listado.SensoresGrupo_33 AS SensorGrupo_33,
	telemetria_listado.SensoresGrupo_34 AS SensorGrupo_34,
	telemetria_listado.SensoresGrupo_35 AS SensorGrupo_35,
	telemetria_listado.SensoresGrupo_36 AS SensorGrupo_36,
	telemetria_listado.SensoresGrupo_37 AS SensorGrupo_37,
	telemetria_listado.SensoresGrupo_38 AS SensorGrupo_38,
	telemetria_listado.SensoresGrupo_39 AS SensorGrupo_39,
	telemetria_listado.SensoresGrupo_40 AS SensorGrupo_40,
	telemetria_listado.SensoresGrupo_41 AS SensorGrupo_41,
	telemetria_listado.SensoresGrupo_42 AS SensorGrupo_42,
	telemetria_listado.SensoresGrupo_43 AS SensorGrupo_43,
	telemetria_listado.SensoresGrupo_44 AS SensorGrupo_44,
	telemetria_listado.SensoresGrupo_45 AS SensorGrupo_45,
	telemetria_listado.SensoresGrupo_46 AS SensorGrupo_46,
	telemetria_listado.SensoresGrupo_47 AS SensorGrupo_47,
	telemetria_listado.SensoresGrupo_48 AS SensorGrupo_48,
	telemetria_listado.SensoresGrupo_49 AS SensorGrupo_49,
	telemetria_listado.SensoresGrupo_50 AS SensorGrupo_50,

	telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema,
	telemetria_listado_tablarelacionada_".$idTelemetria.".HoraSistema,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_1 AS SensorValue_1,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_2 AS SensorValue_2,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_3 AS SensorValue_3,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_4 AS SensorValue_4,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_5 AS SensorValue_5,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_6 AS SensorValue_6,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_7 AS SensorValue_7,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_8 AS SensorValue_8,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_9 AS SensorValue_9,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_10 AS SensorValue_10,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_11 AS SensorValue_11,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_12 AS SensorValue_12,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_13 AS SensorValue_13,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_14 AS SensorValue_14,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_15 AS SensorValue_15,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_16 AS SensorValue_16,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_17 AS SensorValue_17,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_18 AS SensorValue_18,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_19 AS SensorValue_19,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_20 AS SensorValue_20,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_21 AS SensorValue_21,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_22 AS SensorValue_22,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_23 AS SensorValue_23,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_24 AS SensorValue_24,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_25 AS SensorValue_25,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_26 AS SensorValue_26,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_27 AS SensorValue_27,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_28 AS SensorValue_28,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_29 AS SensorValue_29,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_30 AS SensorValue_30,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_31 AS SensorValue_31,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_32 AS SensorValue_32,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_33 AS SensorValue_33,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_34 AS SensorValue_34,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_35 AS SensorValue_35,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_36 AS SensorValue_36,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_37 AS SensorValue_37,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_38 AS SensorValue_38,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_39 AS SensorValue_39,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_40 AS SensorValue_40,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_41 AS SensorValue_41,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_42 AS SensorValue_42,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_43 AS SensorValue_43,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_44 AS SensorValue_44,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_45 AS SensorValue_45,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_46 AS SensorValue_46,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_47 AS SensorValue_47,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_48 AS SensorValue_48,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_49 AS SensorValue_49,
	telemetria_listado_tablarelacionada_".$idTelemetria.".Sensor_50 AS SensorValue_50

	FROM `telemetria_listado_tablarelacionada_".$idTelemetria."`
	LEFT JOIN `telemetria_listado`     ON telemetria_listado.idTelemetria   = telemetria_listado_tablarelacionada_".$idTelemetria.".idTelemetria
	WHERE (FechaSistema BETWEEN '".$f_inicio."' AND '".$f_termino."') 
	LIMIT ".$limite.", 5000";
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
	//Variable temporal
	$arrTemporal = array();
	//Llamo a la funcion
	$arrTemporal = crear_data($set_lim, $_GET['idTelemetria'], $_GET['f_inicio'], $_GET['f_termino'] , $dbConn);
	
	/***********************************************************/
	//Grupos de los sensores
				for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($arrData[$i].'1', $arrGru[$arrTemporal[0]['SensorGrupo_'.$i]]);
				}  
	 
	/***********************************************************/
	//Titulo columnas
	$objPHPExcel->setActiveSheetIndex(0)

				->setCellValue('A2', 'Equipo')
				->setCellValue('B2', 'Fecha')
				->setCellValue('C2', 'Hora');
				
				for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($arrData[$i].'2', $arrTemporal[0]['SensorNombre_'.$i].' ('.$arrUni[$arrTemporal[0]['SensorUniMed_'.$i]].')');
				}   

	 
	/***********************************************************/
	//Datos        
	$nn=3;
	foreach ($arrTemporal as $rutas) {
							
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $rutas['NombreEquipo'])
				->setCellValue('B'.$nn, fecha_estandar($rutas['FechaSistema']))
				->setCellValue('C'.$nn, $rutas['HoraSistema']);
				
				for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
					if(isset($rutas['SensorValue_'.$i])&&$rutas['SensorValue_'.$i]!=999){$xdata=Cantidades_decimales_justos($rutas['SensorValue_'.$i]);}else{$xdata='Sin Datos';}
					if(isset($rutas['SensorValue_'.$i])&&$rutas['SensorValue_'.$i]==0&&isset($rutas['SensorUniMed_'.$i])&&$rutas['SensorUniMed_'.$i]==2){$xdata='Sin Datos';}
					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($arrData[$i].$nn, $xdata);
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
	telemetria_listado.Nombre
	FROM `telemetria_listado`
	".$join."  ".$z."
	ORDER BY idTelemetria ASC ";
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
		$arrTemporal = crear_data($set_lim, $equipo['idTelemetria'], $_GET['f_inicio'], $_GET['f_termino'] , $dbConn);
		
		
		/***********************************************************/
		//Grupos de los sensores
					for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
						$objPHPExcel->setActiveSheetIndex($sheet)
						->setCellValue($arrData[$i].'1', $arrGru[$arrTemporal[0]['SensorGrupo_'.$i]]);
					}  
		 
		/***********************************************************/
		//Titulo columnas
		$objPHPExcel->setActiveSheetIndex($sheet)

					->setCellValue('A2', 'Equipo')
					->setCellValue('B2', 'Fecha')
					->setCellValue('C2', 'Hora');
					
					for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
						$objPHPExcel->setActiveSheetIndex($sheet)
						->setCellValue($arrData[$i].'2', $arrTemporal[0]['SensorNombre_'.$i].' ('.$arrUni[$arrTemporal[0]['SensorUniMed_'.$i]].')');
					}   

		 
		/***********************************************************/
		//Datos        
		$nn=3;
		foreach ($arrTemporal as $rutas) {
								
		$objPHPExcel->setActiveSheetIndex($sheet)
					->setCellValue('A'.$nn, $rutas['NombreEquipo'])
					->setCellValue('B'.$nn, fecha_estandar($rutas['FechaSistema']))
					->setCellValue('C'.$nn, $rutas['HoraSistema']);
					
					for ($i = 1; $i <= $arrTemporal[0]['cantSensores']; $i++) {
						if(isset($rutas['SensorValue_'.$i])&&$rutas['SensorValue_'.$i]!=999){$xdata=Cantidades_decimales_justos($rutas['SensorValue_'.$i]);}else{$xdata='Sin Datos';}
						if(isset($rutas['SensorValue_'.$i])&&$rutas['SensorValue_'.$i]==0&&isset($rutas['SensorUniMed_'.$i])&&$rutas['SensorUniMed_'.$i]==2){$xdata='Sin Datos';}
						$objPHPExcel->setActiveSheetIndex($sheet)
						->setCellValue($arrData[$i].$nn, $xdata);
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
//header('Content-Disposition: attachment;filename="Informe Datos.xls"');
header('Content-Disposition: attachment;filename="Informe Datos archivo '.$_GET['num'].'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
