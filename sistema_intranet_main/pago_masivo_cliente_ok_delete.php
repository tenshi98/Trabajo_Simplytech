<?php session_start();
if(isset($_GET['type'])&&$_GET['type']!=''){
	switch ($_GET['type']) {
		/*******************************************************************/
		//Insumos
		case 1:
			$_SESSION['pago_clientes_insumos'][$_GET['idFacturacion']]['ValorReal']    = 0;
					
			break;
		/*******************************************************************/
		//Productos
		case 2:
			$_SESSION['pago_clientes_productos'][$_GET['idFacturacion']]['ValorReal']    = 0;
				
			break;
		/*******************************************************************/
		//Arriendos
		case 3:
			$_SESSION['pago_clientes_arriendo'][$_GET['idFacturacion']]['ValorReal']    = 0;
				
			break;
		/*******************************************************************/
		//Servicios
		case 4:
			$_SESSION['pago_clientes_servicio'][$_GET['idFacturacion']]['ValorReal']    = 0;
				
			break;
	}
}


?>
