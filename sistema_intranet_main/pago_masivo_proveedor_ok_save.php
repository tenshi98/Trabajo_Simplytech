<?php session_start();
if(isset($_GET['type'])&&$_GET['type']!=''){
	switch ($_GET['type']) {
		/*******************************************************************/
		//Insumos
		case 1:
			$_SESSION['pago_proveedor_insumos'][$_GET['idFacturacion']]['ValorPagado']      = $_GET['pago'];
					
			break;
		/*******************************************************************/
		//Productos
		case 2:
			$_SESSION['pago_proveedor_productos'][$_GET['idFacturacion']]['ValorPagado']    = $_GET['pago'];
				
			break;
		/*******************************************************************/
		//Arriendos
		case 3:
			$_SESSION['pago_proveedor_arriendo'][$_GET['idFacturacion']]['ValorPagado']    = $_GET['pago'];
				
			break;
		/*******************************************************************/
		//Servicios
		case 4:
			$_SESSION['pago_proveedor_servicio'][$_GET['idFacturacion']]['ValorPagado']    = $_GET['pago'];
				
			break;
	}
}


?>
