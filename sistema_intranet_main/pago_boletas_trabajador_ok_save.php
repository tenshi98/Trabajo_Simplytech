<?php session_start();
if(isset($_GET['idFacturacion'])&&$_GET['idFacturacion']!=''){
	
	$_SESSION['pagos_boletas_trabajadores'][$_GET['idFacturacion']]['ValorReal']    = $_GET['pago'];
	
}
?>
