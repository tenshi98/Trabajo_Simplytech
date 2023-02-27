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
if(isset($_SESSION['pagos_boletas_empresas'][$_GET['idFacturacion']]['idFacturacion'])&&$_SESSION['pagos_boletas_empresas'][$_GET['idFacturacion']]['idFacturacion']!=''&&$_SESSION['pagos_boletas_empresas'][$_GET['idFacturacion']]['idFacturacion']==$_GET['idFacturacion']){
	unset($_SESSION['pagos_boletas_empresas'][$_GET['idFacturacion']]);
//Si no existe se crea	
}else{
	//consulto todos los documentos relacionados al Proveedor
	$query = "SELECT 
	boleta_honorarios_facturacion.idFacturacion,
	boleta_honorarios_facturacion.N_Doc,
	boleta_honorarios_facturacion.ValorTotal,
	boleta_honorarios_facturacion.idSistema,
	boleta_honorarios_facturacion.idProveedor,
	proveedor_listado.Nombre AS ProveedorNombre,
	(SELECT SUM(MontoPagado) FROM `pagos_boletas_empresas` WHERE idFacturacion= boleta_honorarios_facturacion.idFacturacion LIMIT 1) AS MontoPagado

	FROM `boleta_honorarios_facturacion`
	LEFT JOIN `proveedor_listado` ON proveedor_listado.idProveedor = boleta_honorarios_facturacion.idProveedor
		
	WHERE boleta_honorarios_facturacion.idFacturacion=".$_GET['idFacturacion'];
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
	$row_data = mysqli_fetch_assoc ($resultado);

	/******************************************************************/
	//Se traspasan los valores a variables de sesion
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['idFacturacion']      = $row_data['idFacturacion'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['N_Doc']              = $row_data['N_Doc'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['Proveedor']          = $row_data['ProveedorNombre'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['ValorTotal']         = $row_data['ValorTotal'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['MontoPagado']        = $row_data['MontoPagado'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['idSistema']          = $row_data['idSistema'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['idProveedor']        = $row_data['idProveedor'];
	$_SESSION['pagos_boletas_empresas'][$row_data['idFacturacion']]['ValorReal']          = '';

	
}
		

?>
