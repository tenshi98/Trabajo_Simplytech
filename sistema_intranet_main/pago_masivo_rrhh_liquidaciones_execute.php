<?php session_start();
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
if(isset($_SESSION['pago_rrhh_liquidaciones'][$_GET['idFactTrab']]['idFactTrab'])&&$_SESSION['pago_rrhh_liquidaciones'][$_GET['idFactTrab']]['idFactTrab']!=''&&$_SESSION['pago_rrhh_liquidaciones'][$_GET['idFactTrab']]['idFactTrab']==$_GET['idFactTrab']){
	unset($_SESSION['pago_rrhh_liquidaciones'][$_GET['idFactTrab']]);
//Si no existe se crea	
}else{
	//consulto todos los datos
	$SIS_query = 'idFactTrab AS ID,	idFactTrab, idTrabajador,TrabajadorNombre,TrabajadorRut,TotalHaberes,TotalDescuentos,TotalAPagar,	(SELECT SUM(MontoPagado) FROM `pagos_rrhh_liquidaciones` WHERE idFactTrab = ID LIMIT 1) AS MontoPagado';
	$row_data = db_select_data (false, $SIS_query, 'rrhh_sueldos_facturacion_trabajadores', '', 'idFactTrab ='.$_GET['idFactTrab'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');
			
	/******************************************************************/
	//Se traspasan los valores a variables de sesion
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['idFactTrab']        = $row_data['idFactTrab'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['idTrabajador']      = $row_data['idTrabajador'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['TrabajadorNombre']  = $row_data['TrabajadorNombre'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['TrabajadorRut']     = $row_data['TrabajadorRut'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['TotalHaberes']      = $row_data['TotalHaberes'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['TotalDescuentos']   = $row_data['TotalDescuentos'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['TotalAPagar']       = $row_data['TotalAPagar'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['MontoPagado']       = $row_data['MontoPagado'];
	$_SESSION['pago_rrhh_liquidaciones'][$row_data['idFactTrab']]['ValorPagado']       = 0;
	
			
}


?>
