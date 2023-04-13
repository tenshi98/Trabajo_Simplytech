<?php session_start();
if(isset($_GET['idFacturacion'])&&$_GET['idFacturacion']!=''){

	$_SESSION['pagos_boletas_empresas'][$_GET['idFacturacion']]['ValorReal']    = $_GET['pago'];

}

?>
