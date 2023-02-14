<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "informe_analisis_maquina_02.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['submit_filter'])){

             
  

//filtros
$x = "WHERE maquinas_listado_matriz.idMatriz>=0";	
$y = "WHERE maquinas_listado.idMaquina>=0";
$z = "WHERE analisis_listado.idAnalisis>=0";
if(isset($_GET['idSistema']) && $_GET['idSistema'] != '')  {     
	$z .= " AND analisis_listado.idSistema = '".$_GET['idSistema']."'";
}
if(isset($_GET['idMaquina']) && $_GET['idMaquina'] != '')  {     
	$y .= " AND maquinas_listado.idMaquina = '".$_GET['idMaquina']."'";
	$z .= " AND analisis_listado.idMaquina = '".$_GET['idMaquina']."'";
}
if(isset($_GET['idMatriz']) && $_GET['idMatriz'] != '')  {       
	$x .= " AND idMatriz = '".$_GET['idMatriz']."'";
	$y .= " AND maquinas_listado_matriz.idMatriz = '".$_GET['idMaquina']."'";
	$z .= " AND analisis_listado.idMatriz = '".$_GET['idMatriz']."'";
}
if(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino']!=''){ 
	$z .= " AND analisis_listado.f_muestreo BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
/*********************************************************************/
//Preconsulta
$query = "SELECT cantPuntos
FROM `maquinas_listado_matriz`
".$x;
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
$rowpre = mysqli_fetch_assoc ($resultado);


/*********************************************/
//Consulta Maquina
$query = "SELECT 
maquinas_listado.Codigo AS MaquinaCodigo,
maquinas_listado.Nombre AS MaquinaNombre,
maquinas_listado.Modelo AS MaquinaModelo,
maquinas_listado.Serie AS MaquinaSerie,
maquinas_listado.Fabricante AS MaquinaFabricante,
ubicacion_listado.Nombre  AS MaquinaUbicacion,
ubicacion_listado_level_1.Nombre  AS MaquinaUbicacion_lvl_1,
ubicacion_listado_level_2.Nombre  AS MaquinaUbicacion_lvl_2,
ubicacion_listado_level_3.Nombre  AS MaquinaUbicacion_lvl_3,
ubicacion_listado_level_4.Nombre  AS MaquinaUbicacion_lvl_4,
ubicacion_listado_level_5.Nombre  AS MaquinaUbicacion_lvl_5,

core_sistemas.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
core_sistemas.Direccion AS SistemaOrigenDireccion,
core_sistemas.Contacto_Fono1 AS SistemaOrigenFono,
core_sistemas.email_principal AS SistemaOrigenEmail,
core_sistemas.Rut AS SistemaOrigenRut,

maquinas_listado_matriz.Nombre AS Analisis_Nombre,
maquinas_listado_matriz.PuntoNombre_1 AS PuntoNombre_1,
maquinas_listado_matriz.PuntoNombre_2 AS PuntoNombre_2,
maquinas_listado_matriz.PuntoNombre_3 AS PuntoNombre_3,
maquinas_listado_matriz.PuntoNombre_4 AS PuntoNombre_4,
maquinas_listado_matriz.PuntoNombre_5 AS PuntoNombre_5,
maquinas_listado_matriz.PuntoNombre_6 AS PuntoNombre_6,
maquinas_listado_matriz.PuntoNombre_7 AS PuntoNombre_7,
maquinas_listado_matriz.PuntoNombre_8 AS PuntoNombre_8,
maquinas_listado_matriz.PuntoNombre_9 AS PuntoNombre_9,
maquinas_listado_matriz.PuntoNombre_10 AS PuntoNombre_10,
maquinas_listado_matriz.PuntoNombre_11 AS PuntoNombre_11,
maquinas_listado_matriz.PuntoNombre_12 AS PuntoNombre_12,
maquinas_listado_matriz.PuntoNombre_13 AS PuntoNombre_13,
maquinas_listado_matriz.PuntoNombre_14 AS PuntoNombre_14,
maquinas_listado_matriz.PuntoNombre_15 AS PuntoNombre_15,
maquinas_listado_matriz.PuntoNombre_16 AS PuntoNombre_16,
maquinas_listado_matriz.PuntoNombre_17 AS PuntoNombre_17,
maquinas_listado_matriz.PuntoNombre_18 AS PuntoNombre_18,
maquinas_listado_matriz.PuntoNombre_19 AS PuntoNombre_19,
maquinas_listado_matriz.PuntoNombre_20 AS PuntoNombre_20,
maquinas_listado_matriz.PuntoNombre_21 AS PuntoNombre_21,
maquinas_listado_matriz.PuntoNombre_22 AS PuntoNombre_22,
maquinas_listado_matriz.PuntoNombre_23 AS PuntoNombre_23,
maquinas_listado_matriz.PuntoNombre_24 AS PuntoNombre_24,
maquinas_listado_matriz.PuntoNombre_25 AS PuntoNombre_25,
maquinas_listado_matriz.PuntoNombre_26 AS PuntoNombre_26,
maquinas_listado_matriz.PuntoNombre_27 AS PuntoNombre_27,
maquinas_listado_matriz.PuntoNombre_28 AS PuntoNombre_28,
maquinas_listado_matriz.PuntoNombre_29 AS PuntoNombre_29,
maquinas_listado_matriz.PuntoNombre_30 AS PuntoNombre_30,
maquinas_listado_matriz.PuntoNombre_31 AS PuntoNombre_31,
maquinas_listado_matriz.PuntoNombre_32 AS PuntoNombre_32,
maquinas_listado_matriz.PuntoNombre_33 AS PuntoNombre_33,
maquinas_listado_matriz.PuntoNombre_34 AS PuntoNombre_34,
maquinas_listado_matriz.PuntoNombre_35 AS PuntoNombre_35,
maquinas_listado_matriz.PuntoNombre_36 AS PuntoNombre_36,
maquinas_listado_matriz.PuntoNombre_37 AS PuntoNombre_37,
maquinas_listado_matriz.PuntoNombre_38 AS PuntoNombre_38,
maquinas_listado_matriz.PuntoNombre_39 AS PuntoNombre_39,
maquinas_listado_matriz.PuntoNombre_40 AS PuntoNombre_40,
maquinas_listado_matriz.PuntoNombre_41 AS PuntoNombre_41,
maquinas_listado_matriz.PuntoNombre_42 AS PuntoNombre_42,
maquinas_listado_matriz.PuntoNombre_43 AS PuntoNombre_43,
maquinas_listado_matriz.PuntoNombre_44 AS PuntoNombre_44,
maquinas_listado_matriz.PuntoNombre_45 AS PuntoNombre_45,
maquinas_listado_matriz.PuntoNombre_46 AS PuntoNombre_46,
maquinas_listado_matriz.PuntoNombre_47 AS PuntoNombre_47,
maquinas_listado_matriz.PuntoNombre_48 AS PuntoNombre_48,
maquinas_listado_matriz.PuntoNombre_49 AS PuntoNombre_49,
maquinas_listado_matriz.PuntoNombre_50 AS PuntoNombre_50,
maquinas_listado_matriz.PuntoMedAceptable_1 AS PuntoMedAceptable_1,
maquinas_listado_matriz.PuntoMedAceptable_2 AS PuntoMedAceptable_2,
maquinas_listado_matriz.PuntoMedAceptable_3 AS PuntoMedAceptable_3,
maquinas_listado_matriz.PuntoMedAceptable_4 AS PuntoMedAceptable_4,
maquinas_listado_matriz.PuntoMedAceptable_5 AS PuntoMedAceptable_5,
maquinas_listado_matriz.PuntoMedAceptable_6 AS PuntoMedAceptable_6,
maquinas_listado_matriz.PuntoMedAceptable_7 AS PuntoMedAceptable_7,
maquinas_listado_matriz.PuntoMedAceptable_8 AS PuntoMedAceptable_8,
maquinas_listado_matriz.PuntoMedAceptable_9 AS PuntoMedAceptable_9,
maquinas_listado_matriz.PuntoMedAceptable_10 AS PuntoMedAceptable_10,
maquinas_listado_matriz.PuntoMedAceptable_11 AS PuntoMedAceptable_11,
maquinas_listado_matriz.PuntoMedAceptable_12 AS PuntoMedAceptable_12,
maquinas_listado_matriz.PuntoMedAceptable_13 AS PuntoMedAceptable_13,
maquinas_listado_matriz.PuntoMedAceptable_14 AS PuntoMedAceptable_14,
maquinas_listado_matriz.PuntoMedAceptable_15 AS PuntoMedAceptable_15,
maquinas_listado_matriz.PuntoMedAceptable_16 AS PuntoMedAceptable_16,
maquinas_listado_matriz.PuntoMedAceptable_17 AS PuntoMedAceptable_17,
maquinas_listado_matriz.PuntoMedAceptable_18 AS PuntoMedAceptable_18,
maquinas_listado_matriz.PuntoMedAceptable_19 AS PuntoMedAceptable_19,
maquinas_listado_matriz.PuntoMedAceptable_20 AS PuntoMedAceptable_20,
maquinas_listado_matriz.PuntoMedAceptable_21 AS PuntoMedAceptable_21,
maquinas_listado_matriz.PuntoMedAceptable_22 AS PuntoMedAceptable_22,
maquinas_listado_matriz.PuntoMedAceptable_23 AS PuntoMedAceptable_23,
maquinas_listado_matriz.PuntoMedAceptable_24 AS PuntoMedAceptable_24,
maquinas_listado_matriz.PuntoMedAceptable_25 AS PuntoMedAceptable_25,
maquinas_listado_matriz.PuntoMedAceptable_26 AS PuntoMedAceptable_26,
maquinas_listado_matriz.PuntoMedAceptable_27 AS PuntoMedAceptable_27,
maquinas_listado_matriz.PuntoMedAceptable_28 AS PuntoMedAceptable_28,
maquinas_listado_matriz.PuntoMedAceptable_29 AS PuntoMedAceptable_29,
maquinas_listado_matriz.PuntoMedAceptable_30 AS PuntoMedAceptable_30,
maquinas_listado_matriz.PuntoMedAceptable_31 AS PuntoMedAceptable_31,
maquinas_listado_matriz.PuntoMedAceptable_32 AS PuntoMedAceptable_32,
maquinas_listado_matriz.PuntoMedAceptable_33 AS PuntoMedAceptable_33,
maquinas_listado_matriz.PuntoMedAceptable_34 AS PuntoMedAceptable_34,
maquinas_listado_matriz.PuntoMedAceptable_35 AS PuntoMedAceptable_35,
maquinas_listado_matriz.PuntoMedAceptable_36 AS PuntoMedAceptable_36,
maquinas_listado_matriz.PuntoMedAceptable_37 AS PuntoMedAceptable_37,
maquinas_listado_matriz.PuntoMedAceptable_38 AS PuntoMedAceptable_38,
maquinas_listado_matriz.PuntoMedAceptable_39 AS PuntoMedAceptable_39,
maquinas_listado_matriz.PuntoMedAceptable_40 AS PuntoMedAceptable_40,
maquinas_listado_matriz.PuntoMedAceptable_41 AS PuntoMedAceptable_41,
maquinas_listado_matriz.PuntoMedAceptable_42 AS PuntoMedAceptable_42,
maquinas_listado_matriz.PuntoMedAceptable_43 AS PuntoMedAceptable_43,
maquinas_listado_matriz.PuntoMedAceptable_44 AS PuntoMedAceptable_44,
maquinas_listado_matriz.PuntoMedAceptable_45 AS PuntoMedAceptable_45,
maquinas_listado_matriz.PuntoMedAceptable_46 AS PuntoMedAceptable_46,
maquinas_listado_matriz.PuntoMedAceptable_47 AS PuntoMedAceptable_47,
maquinas_listado_matriz.PuntoMedAceptable_48 AS PuntoMedAceptable_48,
maquinas_listado_matriz.PuntoMedAceptable_49 AS PuntoMedAceptable_49,
maquinas_listado_matriz.PuntoMedAceptable_50 AS PuntoMedAceptable_50,
maquinas_listado_matriz.PuntoMedAlerta_1 AS PuntoMedAlerta_1,
maquinas_listado_matriz.PuntoMedAlerta_2 AS PuntoMedAlerta_2,
maquinas_listado_matriz.PuntoMedAlerta_3 AS PuntoMedAlerta_3,
maquinas_listado_matriz.PuntoMedAlerta_4 AS PuntoMedAlerta_4,
maquinas_listado_matriz.PuntoMedAlerta_5 AS PuntoMedAlerta_5,
maquinas_listado_matriz.PuntoMedAlerta_6 AS PuntoMedAlerta_6,
maquinas_listado_matriz.PuntoMedAlerta_7 AS PuntoMedAlerta_7,
maquinas_listado_matriz.PuntoMedAlerta_8 AS PuntoMedAlerta_8,
maquinas_listado_matriz.PuntoMedAlerta_9 AS PuntoMedAlerta_9,
maquinas_listado_matriz.PuntoMedAlerta_10 AS PuntoMedAlerta_10,
maquinas_listado_matriz.PuntoMedAlerta_11 AS PuntoMedAlerta_11,
maquinas_listado_matriz.PuntoMedAlerta_12 AS PuntoMedAlerta_12,
maquinas_listado_matriz.PuntoMedAlerta_13 AS PuntoMedAlerta_13,
maquinas_listado_matriz.PuntoMedAlerta_14 AS PuntoMedAlerta_14,
maquinas_listado_matriz.PuntoMedAlerta_15 AS PuntoMedAlerta_15,
maquinas_listado_matriz.PuntoMedAlerta_16 AS PuntoMedAlerta_16,
maquinas_listado_matriz.PuntoMedAlerta_17 AS PuntoMedAlerta_17,
maquinas_listado_matriz.PuntoMedAlerta_18 AS PuntoMedAlerta_18,
maquinas_listado_matriz.PuntoMedAlerta_19 AS PuntoMedAlerta_19,
maquinas_listado_matriz.PuntoMedAlerta_20 AS PuntoMedAlerta_20,
maquinas_listado_matriz.PuntoMedAlerta_21 AS PuntoMedAlerta_21,
maquinas_listado_matriz.PuntoMedAlerta_22 AS PuntoMedAlerta_22,
maquinas_listado_matriz.PuntoMedAlerta_23 AS PuntoMedAlerta_23,
maquinas_listado_matriz.PuntoMedAlerta_24 AS PuntoMedAlerta_24,
maquinas_listado_matriz.PuntoMedAlerta_25 AS PuntoMedAlerta_25,
maquinas_listado_matriz.PuntoMedAlerta_26 AS PuntoMedAlerta_26,
maquinas_listado_matriz.PuntoMedAlerta_27 AS PuntoMedAlerta_27,
maquinas_listado_matriz.PuntoMedAlerta_28 AS PuntoMedAlerta_28,
maquinas_listado_matriz.PuntoMedAlerta_29 AS PuntoMedAlerta_29,
maquinas_listado_matriz.PuntoMedAlerta_30 AS PuntoMedAlerta_30,
maquinas_listado_matriz.PuntoMedAlerta_31 AS PuntoMedAlerta_31,
maquinas_listado_matriz.PuntoMedAlerta_32 AS PuntoMedAlerta_32,
maquinas_listado_matriz.PuntoMedAlerta_33 AS PuntoMedAlerta_33,
maquinas_listado_matriz.PuntoMedAlerta_34 AS PuntoMedAlerta_34,
maquinas_listado_matriz.PuntoMedAlerta_35 AS PuntoMedAlerta_35,
maquinas_listado_matriz.PuntoMedAlerta_36 AS PuntoMedAlerta_36,
maquinas_listado_matriz.PuntoMedAlerta_37 AS PuntoMedAlerta_37,
maquinas_listado_matriz.PuntoMedAlerta_38 AS PuntoMedAlerta_38,
maquinas_listado_matriz.PuntoMedAlerta_39 AS PuntoMedAlerta_39,
maquinas_listado_matriz.PuntoMedAlerta_40 AS PuntoMedAlerta_40,
maquinas_listado_matriz.PuntoMedAlerta_41 AS PuntoMedAlerta_41,
maquinas_listado_matriz.PuntoMedAlerta_42 AS PuntoMedAlerta_42,
maquinas_listado_matriz.PuntoMedAlerta_43 AS PuntoMedAlerta_43,
maquinas_listado_matriz.PuntoMedAlerta_44 AS PuntoMedAlerta_44,
maquinas_listado_matriz.PuntoMedAlerta_45 AS PuntoMedAlerta_45,
maquinas_listado_matriz.PuntoMedAlerta_46 AS PuntoMedAlerta_46,
maquinas_listado_matriz.PuntoMedAlerta_47 AS PuntoMedAlerta_47,
maquinas_listado_matriz.PuntoMedAlerta_48 AS PuntoMedAlerta_48,
maquinas_listado_matriz.PuntoMedAlerta_49 AS PuntoMedAlerta_49,
maquinas_listado_matriz.PuntoMedAlerta_50 AS PuntoMedAlerta_50,
maquinas_listado_matriz.PuntoMedCondenatorio_1 AS PuntoMedCondenatorio_1,
maquinas_listado_matriz.PuntoMedCondenatorio_2 AS PuntoMedCondenatorio_2,
maquinas_listado_matriz.PuntoMedCondenatorio_3 AS PuntoMedCondenatorio_3,
maquinas_listado_matriz.PuntoMedCondenatorio_4 AS PuntoMedCondenatorio_4,
maquinas_listado_matriz.PuntoMedCondenatorio_5 AS PuntoMedCondenatorio_5,
maquinas_listado_matriz.PuntoMedCondenatorio_6 AS PuntoMedCondenatorio_6,
maquinas_listado_matriz.PuntoMedCondenatorio_7 AS PuntoMedCondenatorio_7,
maquinas_listado_matriz.PuntoMedCondenatorio_8 AS PuntoMedCondenatorio_8,
maquinas_listado_matriz.PuntoMedCondenatorio_9 AS PuntoMedCondenatorio_9,
maquinas_listado_matriz.PuntoMedCondenatorio_10 AS PuntoMedCondenatorio_10,
maquinas_listado_matriz.PuntoMedCondenatorio_11 AS PuntoMedCondenatorio_11,
maquinas_listado_matriz.PuntoMedCondenatorio_12 AS PuntoMedCondenatorio_12,
maquinas_listado_matriz.PuntoMedCondenatorio_13 AS PuntoMedCondenatorio_13,
maquinas_listado_matriz.PuntoMedCondenatorio_14 AS PuntoMedCondenatorio_14,
maquinas_listado_matriz.PuntoMedCondenatorio_15 AS PuntoMedCondenatorio_15,
maquinas_listado_matriz.PuntoMedCondenatorio_16 AS PuntoMedCondenatorio_16,
maquinas_listado_matriz.PuntoMedCondenatorio_17 AS PuntoMedCondenatorio_17,
maquinas_listado_matriz.PuntoMedCondenatorio_18 AS PuntoMedCondenatorio_18,
maquinas_listado_matriz.PuntoMedCondenatorio_19 AS PuntoMedCondenatorio_19,
maquinas_listado_matriz.PuntoMedCondenatorio_20 AS PuntoMedCondenatorio_20,
maquinas_listado_matriz.PuntoMedCondenatorio_21 AS PuntoMedCondenatorio_21,
maquinas_listado_matriz.PuntoMedCondenatorio_22 AS PuntoMedCondenatorio_22,
maquinas_listado_matriz.PuntoMedCondenatorio_23 AS PuntoMedCondenatorio_23,
maquinas_listado_matriz.PuntoMedCondenatorio_24 AS PuntoMedCondenatorio_24,
maquinas_listado_matriz.PuntoMedCondenatorio_25 AS PuntoMedCondenatorio_25,
maquinas_listado_matriz.PuntoMedCondenatorio_26 AS PuntoMedCondenatorio_26,
maquinas_listado_matriz.PuntoMedCondenatorio_27 AS PuntoMedCondenatorio_27,
maquinas_listado_matriz.PuntoMedCondenatorio_28 AS PuntoMedCondenatorio_28,
maquinas_listado_matriz.PuntoMedCondenatorio_29 AS PuntoMedCondenatorio_29,
maquinas_listado_matriz.PuntoMedCondenatorio_30 AS PuntoMedCondenatorio_30,
maquinas_listado_matriz.PuntoMedCondenatorio_31 AS PuntoMedCondenatorio_31,
maquinas_listado_matriz.PuntoMedCondenatorio_32 AS PuntoMedCondenatorio_32,
maquinas_listado_matriz.PuntoMedCondenatorio_33 AS PuntoMedCondenatorio_33,
maquinas_listado_matriz.PuntoMedCondenatorio_34 AS PuntoMedCondenatorio_34,
maquinas_listado_matriz.PuntoMedCondenatorio_35 AS PuntoMedCondenatorio_35,
maquinas_listado_matriz.PuntoMedCondenatorio_36 AS PuntoMedCondenatorio_36,
maquinas_listado_matriz.PuntoMedCondenatorio_37 AS PuntoMedCondenatorio_37,
maquinas_listado_matriz.PuntoMedCondenatorio_38 AS PuntoMedCondenatorio_38,
maquinas_listado_matriz.PuntoMedCondenatorio_39 AS PuntoMedCondenatorio_39,
maquinas_listado_matriz.PuntoMedCondenatorio_40 AS PuntoMedCondenatorio_40,
maquinas_listado_matriz.PuntoMedCondenatorio_41 AS PuntoMedCondenatorio_41,
maquinas_listado_matriz.PuntoMedCondenatorio_42 AS PuntoMedCondenatorio_42,
maquinas_listado_matriz.PuntoMedCondenatorio_43 AS PuntoMedCondenatorio_43,
maquinas_listado_matriz.PuntoMedCondenatorio_44 AS PuntoMedCondenatorio_44,
maquinas_listado_matriz.PuntoMedCondenatorio_45 AS PuntoMedCondenatorio_45,
maquinas_listado_matriz.PuntoMedCondenatorio_46 AS PuntoMedCondenatorio_46,
maquinas_listado_matriz.PuntoMedCondenatorio_47 AS PuntoMedCondenatorio_47,
maquinas_listado_matriz.PuntoMedCondenatorio_48 AS PuntoMedCondenatorio_48,
maquinas_listado_matriz.PuntoMedCondenatorio_49 AS PuntoMedCondenatorio_49,
maquinas_listado_matriz.PuntoMedCondenatorio_50 AS PuntoMedCondenatorio_50,
maquinas_listado_matriz.PuntoUniMed_1 AS PuntoUniMed_1,
maquinas_listado_matriz.PuntoUniMed_2 AS PuntoUniMed_2,
maquinas_listado_matriz.PuntoUniMed_3 AS PuntoUniMed_3,
maquinas_listado_matriz.PuntoUniMed_4 AS PuntoUniMed_4,
maquinas_listado_matriz.PuntoUniMed_5 AS PuntoUniMed_5,
maquinas_listado_matriz.PuntoUniMed_6 AS PuntoUniMed_6,
maquinas_listado_matriz.PuntoUniMed_7 AS PuntoUniMed_7,
maquinas_listado_matriz.PuntoUniMed_8 AS PuntoUniMed_8,
maquinas_listado_matriz.PuntoUniMed_9 AS PuntoUniMed_9,
maquinas_listado_matriz.PuntoUniMed_10 AS PuntoUniMed_10,
maquinas_listado_matriz.PuntoUniMed_11 AS PuntoUniMed_11,
maquinas_listado_matriz.PuntoUniMed_12 AS PuntoUniMed_12,
maquinas_listado_matriz.PuntoUniMed_13 AS PuntoUniMed_13,
maquinas_listado_matriz.PuntoUniMed_14 AS PuntoUniMed_14,
maquinas_listado_matriz.PuntoUniMed_15 AS PuntoUniMed_15,
maquinas_listado_matriz.PuntoUniMed_16 AS PuntoUniMed_16,
maquinas_listado_matriz.PuntoUniMed_17 AS PuntoUniMed_17,
maquinas_listado_matriz.PuntoUniMed_18 AS PuntoUniMed_18,
maquinas_listado_matriz.PuntoUniMed_19 AS PuntoUniMed_19,
maquinas_listado_matriz.PuntoUniMed_20 AS PuntoUniMed_20,
maquinas_listado_matriz.PuntoUniMed_21 AS PuntoUniMed_21,
maquinas_listado_matriz.PuntoUniMed_22 AS PuntoUniMed_22,
maquinas_listado_matriz.PuntoUniMed_23 AS PuntoUniMed_23,
maquinas_listado_matriz.PuntoUniMed_24 AS PuntoUniMed_24,
maquinas_listado_matriz.PuntoUniMed_25 AS PuntoUniMed_25,
maquinas_listado_matriz.PuntoUniMed_26 AS PuntoUniMed_26,
maquinas_listado_matriz.PuntoUniMed_27 AS PuntoUniMed_27,
maquinas_listado_matriz.PuntoUniMed_28 AS PuntoUniMed_28,
maquinas_listado_matriz.PuntoUniMed_29 AS PuntoUniMed_29,
maquinas_listado_matriz.PuntoUniMed_30 AS PuntoUniMed_30,
maquinas_listado_matriz.PuntoUniMed_31 AS PuntoUniMed_31,
maquinas_listado_matriz.PuntoUniMed_32 AS PuntoUniMed_32,
maquinas_listado_matriz.PuntoUniMed_33 AS PuntoUniMed_33,
maquinas_listado_matriz.PuntoUniMed_34 AS PuntoUniMed_34,
maquinas_listado_matriz.PuntoUniMed_35 AS PuntoUniMed_35,
maquinas_listado_matriz.PuntoUniMed_36 AS PuntoUniMed_36,
maquinas_listado_matriz.PuntoUniMed_37 AS PuntoUniMed_37,
maquinas_listado_matriz.PuntoUniMed_38 AS PuntoUniMed_38,
maquinas_listado_matriz.PuntoUniMed_39 AS PuntoUniMed_39,
maquinas_listado_matriz.PuntoUniMed_40 AS PuntoUniMed_40,
maquinas_listado_matriz.PuntoUniMed_41 AS PuntoUniMed_41,
maquinas_listado_matriz.PuntoUniMed_42 AS PuntoUniMed_42,
maquinas_listado_matriz.PuntoUniMed_43 AS PuntoUniMed_43,
maquinas_listado_matriz.PuntoUniMed_44 AS PuntoUniMed_44,
maquinas_listado_matriz.PuntoUniMed_45 AS PuntoUniMed_45,
maquinas_listado_matriz.PuntoUniMed_46 AS PuntoUniMed_46,
maquinas_listado_matriz.PuntoUniMed_47 AS PuntoUniMed_47,
maquinas_listado_matriz.PuntoUniMed_48 AS PuntoUniMed_48,
maquinas_listado_matriz.PuntoUniMed_49 AS PuntoUniMed_49,
maquinas_listado_matriz.PuntoUniMed_50 AS PuntoUniMed_50,
maquinas_listado_matriz.PuntoidTipo_1 AS PuntoidTipo_1,
maquinas_listado_matriz.PuntoidTipo_2 AS PuntoidTipo_2,
maquinas_listado_matriz.PuntoidTipo_3 AS PuntoidTipo_3,
maquinas_listado_matriz.PuntoidTipo_4 AS PuntoidTipo_4,
maquinas_listado_matriz.PuntoidTipo_5 AS PuntoidTipo_5,
maquinas_listado_matriz.PuntoidTipo_6 AS PuntoidTipo_6,
maquinas_listado_matriz.PuntoidTipo_7 AS PuntoidTipo_7,
maquinas_listado_matriz.PuntoidTipo_8 AS PuntoidTipo_8,
maquinas_listado_matriz.PuntoidTipo_9 AS PuntoidTipo_9,
maquinas_listado_matriz.PuntoidTipo_10 AS PuntoidTipo_10,
maquinas_listado_matriz.PuntoidTipo_11 AS PuntoidTipo_11,
maquinas_listado_matriz.PuntoidTipo_12 AS PuntoidTipo_12,
maquinas_listado_matriz.PuntoidTipo_13 AS PuntoidTipo_13,
maquinas_listado_matriz.PuntoidTipo_14 AS PuntoidTipo_14,
maquinas_listado_matriz.PuntoidTipo_15 AS PuntoidTipo_15,
maquinas_listado_matriz.PuntoidTipo_16 AS PuntoidTipo_16,
maquinas_listado_matriz.PuntoidTipo_17 AS PuntoidTipo_17,
maquinas_listado_matriz.PuntoidTipo_18 AS PuntoidTipo_18,
maquinas_listado_matriz.PuntoidTipo_19 AS PuntoidTipo_19,
maquinas_listado_matriz.PuntoidTipo_20 AS PuntoidTipo_20,
maquinas_listado_matriz.PuntoidTipo_21 AS PuntoidTipo_21,
maquinas_listado_matriz.PuntoidTipo_22 AS PuntoidTipo_22,
maquinas_listado_matriz.PuntoidTipo_23 AS PuntoidTipo_23,
maquinas_listado_matriz.PuntoidTipo_24 AS PuntoidTipo_24,
maquinas_listado_matriz.PuntoidTipo_25 AS PuntoidTipo_25,
maquinas_listado_matriz.PuntoidTipo_26 AS PuntoidTipo_26,
maquinas_listado_matriz.PuntoidTipo_27 AS PuntoidTipo_27,
maquinas_listado_matriz.PuntoidTipo_28 AS PuntoidTipo_28,
maquinas_listado_matriz.PuntoidTipo_29 AS PuntoidTipo_29,
maquinas_listado_matriz.PuntoidTipo_30 AS PuntoidTipo_30,
maquinas_listado_matriz.PuntoidTipo_31 AS PuntoidTipo_31,
maquinas_listado_matriz.PuntoidTipo_32 AS PuntoidTipo_32,
maquinas_listado_matriz.PuntoidTipo_33 AS PuntoidTipo_33,
maquinas_listado_matriz.PuntoidTipo_34 AS PuntoidTipo_34,
maquinas_listado_matriz.PuntoidTipo_35 AS PuntoidTipo_35,
maquinas_listado_matriz.PuntoidTipo_36 AS PuntoidTipo_36,
maquinas_listado_matriz.PuntoidTipo_37 AS PuntoidTipo_37,
maquinas_listado_matriz.PuntoidTipo_38 AS PuntoidTipo_38,
maquinas_listado_matriz.PuntoidTipo_39 AS PuntoidTipo_39,
maquinas_listado_matriz.PuntoidTipo_40 AS PuntoidTipo_40,
maquinas_listado_matriz.PuntoidTipo_41 AS PuntoidTipo_41,
maquinas_listado_matriz.PuntoidTipo_42 AS PuntoidTipo_42,
maquinas_listado_matriz.PuntoidTipo_43 AS PuntoidTipo_43,
maquinas_listado_matriz.PuntoidTipo_44 AS PuntoidTipo_44,
maquinas_listado_matriz.PuntoidTipo_45 AS PuntoidTipo_45,
maquinas_listado_matriz.PuntoidTipo_46 AS PuntoidTipo_46,
maquinas_listado_matriz.PuntoidTipo_47 AS PuntoidTipo_47,
maquinas_listado_matriz.PuntoidTipo_48 AS PuntoidTipo_48,
maquinas_listado_matriz.PuntoidTipo_49 AS PuntoidTipo_49,
maquinas_listado_matriz.PuntoidTipo_50 AS PuntoidTipo_50,
maquinas_listado_matriz.PuntoidGrupo_1 AS PuntoidGrupo_1,
maquinas_listado_matriz.PuntoidGrupo_2 AS PuntoidGrupo_2,
maquinas_listado_matriz.PuntoidGrupo_3 AS PuntoidGrupo_3,
maquinas_listado_matriz.PuntoidGrupo_4 AS PuntoidGrupo_4,
maquinas_listado_matriz.PuntoidGrupo_5 AS PuntoidGrupo_5,
maquinas_listado_matriz.PuntoidGrupo_6 AS PuntoidGrupo_6,
maquinas_listado_matriz.PuntoidGrupo_7 AS PuntoidGrupo_7,
maquinas_listado_matriz.PuntoidGrupo_8 AS PuntoidGrupo_8,
maquinas_listado_matriz.PuntoidGrupo_9 AS PuntoidGrupo_9,
maquinas_listado_matriz.PuntoidGrupo_10 AS PuntoidGrupo_10,
maquinas_listado_matriz.PuntoidGrupo_11 AS PuntoidGrupo_11,
maquinas_listado_matriz.PuntoidGrupo_12 AS PuntoidGrupo_12,
maquinas_listado_matriz.PuntoidGrupo_13 AS PuntoidGrupo_13,
maquinas_listado_matriz.PuntoidGrupo_14 AS PuntoidGrupo_14,
maquinas_listado_matriz.PuntoidGrupo_15 AS PuntoidGrupo_15,
maquinas_listado_matriz.PuntoidGrupo_16 AS PuntoidGrupo_16,
maquinas_listado_matriz.PuntoidGrupo_17 AS PuntoidGrupo_17,
maquinas_listado_matriz.PuntoidGrupo_18 AS PuntoidGrupo_18,
maquinas_listado_matriz.PuntoidGrupo_19 AS PuntoidGrupo_19,
maquinas_listado_matriz.PuntoidGrupo_20 AS PuntoidGrupo_20,
maquinas_listado_matriz.PuntoidGrupo_21 AS PuntoidGrupo_21,
maquinas_listado_matriz.PuntoidGrupo_22 AS PuntoidGrupo_22,
maquinas_listado_matriz.PuntoidGrupo_23 AS PuntoidGrupo_23,
maquinas_listado_matriz.PuntoidGrupo_24 AS PuntoidGrupo_24,
maquinas_listado_matriz.PuntoidGrupo_25 AS PuntoidGrupo_25,
maquinas_listado_matriz.PuntoidGrupo_26 AS PuntoidGrupo_26,
maquinas_listado_matriz.PuntoidGrupo_27 AS PuntoidGrupo_27,
maquinas_listado_matriz.PuntoidGrupo_28 AS PuntoidGrupo_28,
maquinas_listado_matriz.PuntoidGrupo_29 AS PuntoidGrupo_29,
maquinas_listado_matriz.PuntoidGrupo_30 AS PuntoidGrupo_30,
maquinas_listado_matriz.PuntoidGrupo_31 AS PuntoidGrupo_31,
maquinas_listado_matriz.PuntoidGrupo_32 AS PuntoidGrupo_32,
maquinas_listado_matriz.PuntoidGrupo_33 AS PuntoidGrupo_33,
maquinas_listado_matriz.PuntoidGrupo_34 AS PuntoidGrupo_34,
maquinas_listado_matriz.PuntoidGrupo_35 AS PuntoidGrupo_35,
maquinas_listado_matriz.PuntoidGrupo_36 AS PuntoidGrupo_36,
maquinas_listado_matriz.PuntoidGrupo_37 AS PuntoidGrupo_37,
maquinas_listado_matriz.PuntoidGrupo_38 AS PuntoidGrupo_38,
maquinas_listado_matriz.PuntoidGrupo_39 AS PuntoidGrupo_39,
maquinas_listado_matriz.PuntoidGrupo_40 AS PuntoidGrupo_40,
maquinas_listado_matriz.PuntoidGrupo_41 AS PuntoidGrupo_41,
maquinas_listado_matriz.PuntoidGrupo_42 AS PuntoidGrupo_42,
maquinas_listado_matriz.PuntoidGrupo_43 AS PuntoidGrupo_43,
maquinas_listado_matriz.PuntoidGrupo_44 AS PuntoidGrupo_44,
maquinas_listado_matriz.PuntoidGrupo_45 AS PuntoidGrupo_45,
maquinas_listado_matriz.PuntoidGrupo_46 AS PuntoidGrupo_46,
maquinas_listado_matriz.PuntoidGrupo_47 AS PuntoidGrupo_47,
maquinas_listado_matriz.PuntoidGrupo_48 AS PuntoidGrupo_48,
maquinas_listado_matriz.PuntoidGrupo_49 AS PuntoidGrupo_49,
maquinas_listado_matriz.PuntoidGrupo_50 AS PuntoidGrupo_50

FROM `maquinas_listado`
LEFT JOIN `ubicacion_listado`                       ON ubicacion_listado.idUbicacion           = maquinas_listado.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`               ON ubicacion_listado_level_1.idLevel_1     = maquinas_listado.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`               ON ubicacion_listado_level_2.idLevel_2     = maquinas_listado.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`               ON ubicacion_listado_level_3.idLevel_3     = maquinas_listado.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`               ON ubicacion_listado_level_4.idLevel_4     = maquinas_listado.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`               ON ubicacion_listado_level_5.idLevel_5     = maquinas_listado.idUbicacion_lvl_5
LEFT JOIN `maquinas_listado_matriz`                 ON maquinas_listado_matriz.idMaquina       = maquinas_listado.idMaquina
LEFT JOIN `core_sistemas`                           ON core_sistemas.idSistema                 = maquinas_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                  = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                  = core_sistemas.idComuna
".$y."
LIMIT 1";
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
$rowMaquina = mysqli_fetch_assoc ($resultado);



/**********************************************************************/
//Se traen todas las unidades de medida
$consql = '';
for ($i = 1; $i <= $rowpre['cantPuntos']; $i++) {
	$consql .= ',analisis_listado.Medida_'.$i.' AS Analisis_Medida_'.$i;
}

// Se trae un listado con todos los productos
$arrResultados = array();
$query = "SELECT 
core_analisis_estado.Nombre AS AnalisisEstado,
analisis_listado.f_muestreo
".$consql."
FROM `analisis_listado`
LEFT JOIN `core_analisis_estado` ON core_analisis_estado.idEstado = analisis_listado.idEstado
".$z."
ORDER BY analisis_listado.f_muestreo ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrResultados,$row );
} 

/**********************************************************************/
//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUml,Nombre
FROM `sistema_analisis_uml`
ORDER BY idUml ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrUnimed,$row );
}
/**********************************************************************/
//Se consultan datos
$arrGrupo = array();
$query = "SELECT idGrupo, Nombre
FROM `maquinas_listado_matriz_grupos`
ORDER BY idGrupo ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrGrupo,$row );
}
/**********************************************************************/
//Se traen todos los productos
$arrProducto = array();
$query = "SELECT idProducto, Nombre
FROM `productos_listado`
ORDER BY Nombre ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrProducto,$row );
}
/**********************************************************************/
//Se traen todos los productos
$arrDispersancia = array();
$query = "SELECT idDispersancia, Nombre
FROM `core_analisis_dispersancia`
ORDER BY Nombre ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrDispersancia,$row );
}
/**********************************************************************/
//Se traen todos los productos
$arrFlashpoint = array();
$query = "SELECT idFlashPoint, Nombre
FROM `core_analisis_flashpoint`
ORDER BY Nombre ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrFlashpoint,$row );
}
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
	<?php
	$zz  = '';
	if(isset($_GET['idSistema']) && $_GET['idSistema'] != '')  {     $zz .= '&idSistema='.$_GET['idSistema'];}else{$zz .= '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];}
	if(isset($_GET['idMaquina']) && $_GET['idMaquina'] != '')  {     $zz .= '&idMaquina='.$_GET['idMaquina'];}
	if(isset($_GET['idMatriz']) && $_GET['idMatriz'] != '')  {       $zz .= '&idMatriz='.$_GET['idMatriz'];}
	if(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino']!=''){ 
		$zz .= '&f_inicio='.$_GET['f_inicio'];
		$zz .= '&f_termino='.$_GET['f_termino'];
	}
	?>		
	<a target="new" href="<?php echo 'informe_analisis_maquina_02_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
</div>
			

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5><?php echo $rowMaquina['Analisis_Nombre']?> <?php echo Fecha_estandar(fecha_actual())?></h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Maquina</th>
						<th>Empresa</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<tr class="odd"><td><?php echo $rowMaquina['MaquinaNombre']; ?></td>                     <td><?php echo $rowMaquina['SistemaOrigen']; ?></td></tr>
					<tr class="odd"><td><?php echo 'Codigo: '.$rowMaquina['MaquinaCodigo']; ?></td>          <td><?php echo $rowMaquina['SistemaOrigenCiudad'].', '.$rowMaquina['SistemaOrigenComuna']; ?></td></tr>
					<tr class="odd"><td><?php echo 'Modelo: '.$rowMaquina['MaquinaModelo']; ?></td>          <td><?php echo $rowMaquina['SistemaOrigenDireccion'] ?></td></tr>
					<tr class="odd"><td><?php echo 'Serie: '.$rowMaquina['MaquinaSerie']; ?></td>            <td><?php echo 'Fono : '.formatPhone($rowMaquina['SistemaOrigenFono']); ?></td></tr>
					<tr class="odd"><td><?php echo 'Fabricante: '.$rowMaquina['MaquinaFabricante']; ?></td>  <td><?php echo 'Rut: '.$rowMaquina['SistemaOrigenRut']; ?></td></tr>
					<tr class="odd">
						<td>
							<?php echo 'Ubicacion: '.$rowMaquina['MaquinaUbicacion'];
							if(isset($rowMaquina['MaquinaUbicacion_lvl_1'])&&$rowMaquina['MaquinaUbicacion_lvl_1']!=''){
								echo ' - '.$rowMaquina['MaquinaUbicacion_lvl_1'];
							}
							if(isset($rowMaquina['MaquinaUbicacion_lvl_2'])&&$rowMaquina['MaquinaUbicacion_lvl_2']!=''){
								echo ' - '.$rowMaquina['MaquinaUbicacion_lvl_2'];
							}
							if(isset($rowMaquina['MaquinaUbicacion_lvl_3'])&&$rowMaquina['MaquinaUbicacion_lvl_3']!=''){
								echo ' - '.$rowMaquina['MaquinaUbicacion_lvl_3'];
							}
							if(isset($rowMaquina['MaquinaUbicacion_lvl_4'])&&$rowMaquina['MaquinaUbicacion_lvl_4']!=''){
								echo ' - '.$rowMaquina['MaquinaUbicacion_lvl_4'];
							}
							if(isset($rowMaquina['MaquinaUbicacion_lvl_5'])&&$rowMaquina['MaquinaUbicacion_lvl_5']!=''){
								echo ' - '.$rowMaquina['MaquinaUbicacion_lvl_5'];
							} ?>
						</td>  
						<td><?php echo 'Email: '.$rowMaquina['SistemaOrigenEmail'] ?></td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

	
<div class="col-xs-12 table-responsive"  style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<?php 
			//variables
			$x_count = 1;
			//arreglo
			foreach ($arrGrupo as $grupo) { 
				//recorro los puntos
				for ($i = 1; $i <= $rowpre['cantPuntos']; $i++) {
					//verifico que pertenezcan al mismo grupo
					if($grupo['idGrupo']==$rowMaquina['PuntoidGrupo_'.$i]){
						//obtengo la unidad de medida
						$uniMed = '';
						foreach ($arrUnimed as $med) { 
							if($rowMaquina['PuntoUniMed_'.$i]==$med['idUml']){
								$uniMed = $med['Nombre'];
							}
						}
						//reviso el tipo de resultado
						switch ($rowMaquina['PuntoidTipo_'.$i]) {
							//Medidas
							case 1:
								//
								echo '
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="box">
										<header>
											<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Datos '.$rowMaquina['PuntoNombre_'.$i].'</h5>
										</header>
										<div class="table-responsive">
											<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
												<thead>
													<tr role="row">
														<th width="10">Fecha</th>
														<th>Valor</th>
														<th width="10">Aceptable</th>
														<th width="10">Alerta</th>
														<th width="10">Condenatorio</th>
													</tr>
												</thead>		  
												<tbody role="alert" aria-live="polite" aria-relevant="all">';
												
												

										//recorro los resultados
										foreach ($arrResultados as $result) {
											echo '
											<tr class="odd">
												<td>'.fecha_estandar($result['f_muestreo']).'</td>
												<td>'.Cantidades_decimales_justos($result['Analisis_Medida_'.$i]).' '.$uniMed.'</td>
												<td>'.Cantidades_decimales_justos($rowMaquina['PuntoMedAceptable_'.$i]).' '.$uniMed.'</td>
												<td>'.Cantidades_decimales_justos($rowMaquina['PuntoMedAlerta_'.$i]).' '.$uniMed.'</td>
												<td>'.Cantidades_decimales_justos($rowMaquina['PuntoMedCondenatorio_'.$i]).' '.$uniMed.'</td>
											</tr>';
										}
										
										echo '	</tbody>
											</table>
										</div>
									</div>
								</div>';

									
				
								//Suma de 1
								$x_count++;
							break;
							//Producto
							case 2:
							
								//Suma de 1
								$x_count++;
							break;
							//Dispersancia
							case 3:
								
								//Suma de 1
								$x_count++;
							break;
							//Flashpoint
							case 4:
								//Suma de 1
								$x_count++;
							break;
						}

					}
				}
			}
				
			
		?>
				

</div>



<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//Verifico el tipo de usuario que esta ingresando
$z="idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
 
 ?>
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idMaquina)){     $x1  = $idMaquina;   }else{$x1  = '';}
				if(isset($idMatriz)){      $x2  = $idMatriz;    }else{$x2  = '';}
				if(isset($f_inicio)){      $x3  = $f_inicio;    }else{$x3  = '';}
				if(isset($f_termino)){     $x4  = $f_termino;   }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_depend1('Maquina','idMaquina', $x1, 2, 'idMaquina', 'Nombre', 'maquinas_listado', $z, 0,
										 'Matriz de Analisis','idMatriz', $x2, 2, 'idMatriz', 'Nombre', 'maquinas_listado_matriz', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Inputs->form_date('Fecha Muestreo Inicio','f_inicio', $x3, 2);
				$Form_Inputs->form_date('Fecha Muestreo Termino','f_termino', $x4, 2);
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				
				?>
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="submit_filter">
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div> 
<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
