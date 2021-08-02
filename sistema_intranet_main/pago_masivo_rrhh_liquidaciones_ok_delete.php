<?php session_start();
//elimino el valor pagado
$_SESSION['pago_rrhh_liquidaciones'][$_GET['idFactTrab']]['ValorPagado'] = 0;



?>
