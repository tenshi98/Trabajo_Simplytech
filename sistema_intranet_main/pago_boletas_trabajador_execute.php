<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Excel.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Si existe se elimina
if(isset($_SESSION['pagos_boletas_trabajadores'][$_GET['idFacturacion']]['idFacturacion'])&&$_SESSION['pagos_boletas_trabajadores'][$_GET['idFacturacion']]['idFacturacion']!=''&&$_SESSION['pagos_boletas_trabajadores'][$_GET['idFacturacion']]['idFacturacion']==$_GET['idFacturacion']){
	unset($_SESSION['pagos_boletas_trabajadores'][$_GET['idFacturacion']]);
//Si no existe se crea
}else{
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	boleta_honorarios_facturacion.idFacturacion,
	boleta_honorarios_facturacion.N_Doc,
	boleta_honorarios_facturacion.ValorTotal,
	boleta_honorarios_facturacion.idSistema,
	boleta_honorarios_facturacion.idTrabajador,
	trabajadores_listado.Nombre AS TrabajadorNombre,
	trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat,
	trabajadores_listado.ApellidoMat AS TrabajadorApellidoMat,
	(SELECT SUM(MontoPagado) FROM `pagos_boletas_trabajadores` WHERE idFacturacion= boleta_honorarios_facturacion.idFacturacion LIMIT 1) AS MontoPagado';
	$SIS_join  = 'LEFT JOIN `trabajadores_listado` ON trabajadores_listado.idTrabajador = boleta_honorarios_facturacion.idTrabajador';
	$SIS_where = 'boleta_honorarios_facturacion.idFacturacion='.$_GET['idFacturacion'];
	$row_data = db_select_data (false, $SIS_query, 'boleta_honorarios_facturacion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'row_data');

	/******************************************************************/
	//Se traspasan los valores a variables de sesion
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['idFacturacion']      = $row_data['idFacturacion'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['N_Doc']              = $row_data['N_Doc'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['Trabajador']         = $row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellidoPat'].' '.$row_data['TrabajadorApellidoMat'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['ValorTotal']         = $row_data['ValorTotal'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['MontoPagado']        = $row_data['MontoPagado'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['idSistema']          = $row_data['idSistema'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['idTrabajador']       = $row_data['idTrabajador'];
	$_SESSION['pagos_boletas_trabajadores'][$row_data['idFacturacion']]['ValorReal']          = '';

}

?>
