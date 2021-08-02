<?php session_start();
//guardo el valor pagado
$_SESSION['pago_rrhh_liquidaciones'][$_GET['idFactTrab']]['ValorPagado'] = $_GET['pago'];

?>
