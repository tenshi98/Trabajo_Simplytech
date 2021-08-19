<?php
/*****************************************************************************************************************/
/*                                               Transacciones                                                   */
/*****************************************************************************************************************/
//Nueva conexcion a otra base de datos
//verifica la capa de desarrollo
$whitelist = array( 'localhost', '127.0.0.1', '::1' );
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de desarrollo
if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){
	$CON_Server    = 'localhost';
	$CON_Usuario   = 'root';
	$CON_Password  = '';
	$CON_Base      = 'power_engine_main';
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de produccion	
}else{
	$CON_Server    = 'localhost';
	$CON_Usuario   = 'crosstech_admin';
	$CON_Password  = '&-VSda,#rFvT';
	$CON_Base      = 'crosstech_pe_clientes';
}	
			
//Funcion para conectarse
function conectarDB ($servidor, $usuario, $password, $base_datos) {
	$db_con = mysqli_connect($servidor, $usuario, $password, $base_datos);
	$db_con->set_charset("utf8");
	return $db_con; 
}	
			
//verifico si existen datos
if($CON_Server!=''&&$CON_Usuario!=''&&$CON_Base!=''){
	//ejecuto conexion
	$dbConn_2 = conectarDB($CON_Server, $CON_Usuario, $CON_Password, $CON_Base);
}


//Tipo de usuario
$idTipoUsuario  = $_SESSION['usuario']['basic_data']['idTipoUsuario'];
$idSistema      = $_SESSION['usuario']['basic_data']['idSistema'];
$idUsuario      = $_SESSION['usuario']['basic_data']['idUsuario'];

//variable de numero de permiso
$x_nperm = 0;

//permisos a las transacciones
$x_nperm++; $trans[$x_nperm] = "telemetria_gestion_equipos.php";                  //01 - Acceso a la transaccion de administracion de gestion de equipos (todos los sensores)

//Genero los permisos
for ($i = 1; $i <= $x_nperm; $i++) {
	//Seteo la variable a 0
	$prm_x[$i] = 0;
	//recorro los permisos
	if(isset($_SESSION['usuario']['menu'])){
		foreach($_SESSION['usuario']['menu'] as $menu=>$productos) {
			foreach($productos as $producto) {
				//elimino los datos extras
				$str = str_replace("?pagina=1", "", $producto['TransaccionURL']);
				//le asigno el valor 1 en caso de que exista
				if($trans[$i]==$str){
					$prm_x[$i] = 1;
				}
			}
		}
	}
}
/*****************************************************************************************************************/
/*                                                Subconsultas                                                   */
/*****************************************************************************************************************/
//Variables
$subquery       = '';
//Filtro
$z  = " AND idSistema=".$idSistema;
//Ventas
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion  WHERE idEstado=1  AND (idTipo=2 OR idTipo=12) ".$z." LIMIT 1) AS CountFactArriendoVent";
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_insumos_facturacion    WHERE idEstado=1  AND (idTipo=2 OR idTipo=12) ".$z." LIMIT 1) AS CountFactInsumoVent";
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_productos_facturacion  WHERE idEstado=1  AND (idTipo=2 OR idTipo=12) ".$z." LIMIT 1) AS CountFactProductoVent";
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_servicios_facturacion  WHERE idEstado=1  AND (idTipo=2 OR idTipo=12) ".$z." LIMIT 1) AS CountFactServicioVent";
//Compras		
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion  WHERE idEstado=1  AND (idTipo=1 OR idTipo=10) ".$z." LIMIT 1) AS CountFactArriendo";
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_insumos_facturacion    WHERE idEstado=1  AND (idTipo=1 OR idTipo=10) ".$z." LIMIT 1) AS CountFactInsumo";
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_productos_facturacion  WHERE idEstado=1  AND (idTipo=1 OR idTipo=10) ".$z." LIMIT 1) AS CountFactProducto";
$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_servicios_facturacion  WHERE idEstado=1  AND (idTipo=1 OR idTipo=10) ".$z." LIMIT 1) AS CountFactServicio";
//Solicitudes
$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_productos  WHERE idOcompra=0 ".$z." LIMIT 1) AS CuentaSolProd";
$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_insumos    WHERE idOcompra=0 ".$z." LIMIT 1) AS CuentaSolIns";
$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_arriendos  WHERE idOcompra=0 ".$z." LIMIT 1) AS CuentaSolArr";
$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_servicios  WHERE idOcompra=0 ".$z." LIMIT 1) AS CuentaSolServ";
$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_otros      WHERE idOcompra=0 ".$z." LIMIT 1) AS CuentaSolOtro";
//OC sin aprobar
$subquery .= ",(SELECT COUNT(idOcompra) FROM ocompra_listado WHERE idEstado=1 ".$z." LIMIT 1) AS CuentaOC";
//Calendario Mes
$subquery .= ",(SELECT COUNT(idCalendario) FROM principal_calendario_listado WHERE Mes=".mes_actual()." AND Ano=".ano_actual()." ".$z." LIMIT 1) AS CuentaEventos";
//Notificacion
$subquery .= ",(SELECT COUNT(idNoti) FROM principal_notificaciones_ver WHERE idEstado='1' AND idUsuario=".$idUsuario." ".$z." LIMIT 1) AS Notificacion";
//Tickets Abiertos
$subquery .= ",(SELECT COUNT(idTicket) FROM crosstech_gestion_tickets WHERE idEstado='1' ".$z." LIMIT 1) AS TicketsAbiertos";


/************************************************************************************/
//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$subconsulta = db_select_data (false, 'idSistema '.$subquery, 'core_sistemas', '', 'idSistema='.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), '1include_principal_interfaz_7');

/*************************************************************************************************/
/*************************************************************************************************/
//Solo compras o ventas
$z1 = " (bodegas_arriendos_facturacion.idTipo=1   OR bodegas_arriendos_facturacion.idTipo=2   OR bodegas_arriendos_facturacion.idTipo=10   OR bodegas_arriendos_facturacion.idTipo=11   OR bodegas_arriendos_facturacion.idTipo=12   OR bodegas_arriendos_facturacion.idTipo=13)"; //solo compras o ventas
$z2 = " (bodegas_insumos_facturacion.idTipo=1     OR bodegas_insumos_facturacion.idTipo=2     OR bodegas_insumos_facturacion.idTipo=10     OR bodegas_insumos_facturacion.idTipo=11     OR bodegas_insumos_facturacion.idTipo=12     OR bodegas_insumos_facturacion.idTipo=13)";   //solo compras o ventas
$z3 = " (bodegas_productos_facturacion.idTipo=1   OR bodegas_productos_facturacion.idTipo=2   OR bodegas_productos_facturacion.idTipo=10   OR bodegas_productos_facturacion.idTipo=11   OR bodegas_productos_facturacion.idTipo=12   OR bodegas_productos_facturacion.idTipo=13)"; //solo compras o ventas
$z4 = " (bodegas_servicios_facturacion.idTipo=1   OR bodegas_servicios_facturacion.idTipo=2   OR bodegas_servicios_facturacion.idTipo=10   OR bodegas_servicios_facturacion.idTipo=11   OR bodegas_servicios_facturacion.idTipo=12   OR bodegas_servicios_facturacion.idTipo=13)"; //solo compras o ventas
$z5 = " (boleta_honorarios_facturacion.idFacturacion!=0)";      //siempre pasa
$z6 = " (rrhh_sueldos_facturacion_trabajadores.idFactTrab!=0)"; //siempre pasa

//se crean cadenas
$z1.=" AND bodegas_arriendos_facturacion.Creacion_ano='".ano_actual()."'";
$z2.=" AND bodegas_insumos_facturacion.Creacion_ano='".ano_actual()."'";
$z3.=" AND bodegas_productos_facturacion.Creacion_ano='".ano_actual()."'";
$z4.=" AND bodegas_servicios_facturacion.Creacion_ano='".ano_actual()."'";
$z5.=" AND boleta_honorarios_facturacion.Creacion_ano='".ano_actual()."'";
$z6.=" AND rrhh_sueldos_facturacion_trabajadores.Creacion_ano='".ano_actual()."'";

//se agrupan
$z1.=" GROUP BY idTipo, Creacion_mes";
$z2.=" GROUP BY idTipo, Creacion_mes";
$z3.=" GROUP BY idTipo, Creacion_mes";
$z4.=" GROUP BY idTipo, Creacion_mes";
$z5.=" GROUP BY idTipo, Creacion_mes";
$z6.=" GROUP BY Creacion_mes";
					
/*************************************************************************************************/
$SIS_query_1 = 'idTipo, Creacion_mes, SUM(ValorTotal) AS ValorTotal';
$SIS_query_2 = 'Creacion_mes, SUM(TotalAPagar) AS ValorTotal';
//Bodega de Arriendos
$arrTemporal_1 = array();
$arrTemporal_1 = db_select_array (false, $SIS_query_1, 'bodegas_arriendos_facturacion', '', $z1, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Insumos
$arrTemporal_2 = array();
$arrTemporal_2 = db_select_array (false, $SIS_query_1, 'bodegas_insumos_facturacion', '', $z2, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Productos
$arrTemporal_3 = array();
$arrTemporal_3 = db_select_array (false, $SIS_query_1, 'bodegas_productos_facturacion', '', $z3, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Servicios
$arrTemporal_4 = array();
$arrTemporal_4 = db_select_array (false, $SIS_query_1, 'bodegas_servicios_facturacion', '', $z4, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Boleta de honorarios
$arrTemporal_5 = array();
$arrTemporal_5 = db_select_array (false, $SIS_query_1, 'boleta_honorarios_facturacion', '', $z5, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Servicios
$arrTemporal_6 = array();
$arrTemporal_6 = db_select_array (false, $SIS_query_2, 'rrhh_sueldos_facturacion_trabajadores', '', $z6, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');

/***********************************************************/

/***********************************************************/
//Productos con bajo stock
$tabla_producto    = 'productos_listado';
$bodega_existencia = 'bodegas_productos_facturacion_existencias';

$SIS_query    = $tabla_producto.'.StockLimite,'.$tabla_producto.'.Nombre AS NombreProd,(SELECT SUM(Cantidad_ing) FROM '.$bodega_existencia.' WHERE idProducto = '.$tabla_producto.'.idProducto AND idSistema = '.$idSistema.' ) AS stock_entrada,(SELECT SUM(Cantidad_eg)  FROM '.$bodega_existencia.' WHERE idProducto = '.$tabla_producto.'.idProducto AND idSistema = '.$idSistema.' ) AS stock_salida';
$SIS_where    = $tabla_producto.'.StockLimite >0';
$SIS_orderby  = $tabla_producto.'.StockLimite DESC, '.$tabla_producto.'.Nombre ASC';
$arrProductos = array();
$arrProductos = db_select_array (false, $SIS_query, $tabla_producto, '', $SIS_where, $SIS_orderby, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

//Cantidad Clientes
$t_clientes = db_select_nrows (false, 'idCliente', 'clientes_listado', '', 'idEstado=1 AND idSistema='.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 't_clientes');
		
//Nuevos Clientes
$n_fecha    = restarDias(fecha_actual(),60);
$n_clientes = db_select_nrows (false, 'idCliente', 'clientes_listado', '', 'idEstado=1 AND idSistema='.$idSistema.' AND fNacimiento>="'.$n_fecha.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'n_clientes');

$Prospec_abierto = db_select_nrows (false, 'idProspecto', 'prospectos_listado', '', 'idEstado=1 AND idSistema='.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'Prospecto_abierto');
$Prospec_cerrado = db_select_nrows (false, 'idProspecto', 'prospectos_listado', '', 'idEstado=2 AND idSistema='.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'Prospecto_cerrado');

//Listado con los clientes
$arrClientes = array();
$arrClientes = db_select_array (false, 'Contrato_Valor_Mensual,idTab_1, idTab_2, idTab_3, idTab_4, idTab_5, idTab_6, idTab_7, idTab_8', 'clientes_listado', '', 'idEstado=1 AND idSistema='.$idSistema, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrClientes');

//Listado con los prospectos
$arrProspecto = array();
$arrProspecto = db_select_array (false, 'idTab_1, idTab_2, idTab_3, idTab_4, idTab_5, idTab_6, idTab_7, idTab_8', 'prospectos_listado', '', 'idEstado=1 AND idSistema='.$idSistema, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProspecto');

//Listado con los tabs
$arrTabs = array();
$arrTabs = db_select_array (false, 'idTab, Nombre', 'core_telemetria_tabs', '', '', 'idTab ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTabs');
		
//Solo compras o ventas
$z1 = " (bodegas_arriendos_facturacion.idTipo=2 OR bodegas_arriendos_facturacion.idTipo=12 OR bodegas_arriendos_facturacion.idTipo=13)"; //solo ventas
$z2 = " (bodegas_insumos_facturacion.idTipo=2   OR bodegas_insumos_facturacion.idTipo=12   OR bodegas_insumos_facturacion.idTipo=13)";   //solo ventas
$z3 = " (bodegas_productos_facturacion.idTipo=2 OR bodegas_productos_facturacion.idTipo=12 OR bodegas_productos_facturacion.idTipo=13)"; //solo ventas
$z4 = " (bodegas_servicios_facturacion.idTipo=2 OR bodegas_servicios_facturacion.idTipo=12 OR bodegas_servicios_facturacion.idTipo=13)"; //solo ventas

//se crean cadenas
$z1.=" AND bodegas_arriendos_facturacion.Creacion_ano='".ano_actual()."'";
$z2.=" AND bodegas_insumos_facturacion.Creacion_ano='".ano_actual()."'";
$z3.=" AND bodegas_productos_facturacion.Creacion_ano='".ano_actual()."'";
$z4.=" AND bodegas_servicios_facturacion.Creacion_ano='".ano_actual()."'";

//se agrupan
$z1.=" GROUP BY bodegas_arriendos_facturacion.idCliente";
$z2.=" GROUP BY bodegas_insumos_facturacion.idCliente";
$z3.=" GROUP BY bodegas_productos_facturacion.idCliente";
$z4.=" GROUP BY bodegas_servicios_facturacion.idCliente";
								
/*************************************************************************************************/
$SIS_query_1 = 'clientes_listado.idCliente AS ID, clientes_listado.Nombre AS Cliente, SUM(ValorTotal) AS Total';
//Bodega de Arriendos
$arrTemporal_b_1 = array();
$arrTemporal_b_1 = db_select_array (false, 'bodegas_arriendos_facturacion.idTipo, '.$SIS_query_1, 'bodegas_arriendos_facturacion', 'LEFT JOIN clientes_listado ON clientes_listado.idCliente = bodegas_arriendos_facturacion.idCliente', $z1, 'Total DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Insumos
$arrTemporal_b_2 = array();
$arrTemporal_b_2 = db_select_array (false, 'bodegas_insumos_facturacion.idTipo, '.$SIS_query_1, 'bodegas_insumos_facturacion', 'LEFT JOIN clientes_listado ON clientes_listado.idCliente = bodegas_insumos_facturacion.idCliente', $z2, 'Total DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Productos
$arrTemporal_b_3 = array();
$arrTemporal_b_3 = db_select_array (false, 'bodegas_productos_facturacion.idTipo, '.$SIS_query_1, 'bodegas_productos_facturacion', 'LEFT JOIN clientes_listado ON clientes_listado.idCliente = bodegas_productos_facturacion.idCliente', $z3, 'Total DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//Bodega de Servicios
$arrTemporal_b_4 = array();
$arrTemporal_b_4 = db_select_array (false, 'bodegas_servicios_facturacion.idTipo, '.$SIS_query_1, 'bodegas_servicios_facturacion', 'LEFT JOIN clientes_listado ON clientes_listado.idCliente = bodegas_servicios_facturacion.idCliente', $z4, 'Total DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
//etapas
$arrEtapa = array();
$arrEtapa = db_select_array (false, 'prospectos_etapa.Nombre AS Etapa,COUNT(prospectos_listado.idEtapa) AS Cuenta', 'prospectos_listado', 'LEFT JOIN prospectos_etapa ON prospectos_etapa.idEtapa = prospectos_listado.idEtapa', 'prospectos_listado.idProspecto!=0 GROUP BY prospectos_listado.idEtapa', 'Etapa ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTemporal');
														
/*****************************************************************************************************************/
/*                                                Modelado                                                       */
/*****************************************************************************************************************/
	
/***********************************************************/
//variable
$nprod_bajostock = 0;
//se recorre
foreach ($arrProductos as $productos) { 
	$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
	if ($productos['StockLimite']>$stock_actual){
		$nprod_bajostock++;
	} 
} 

/*************************************************************************************************/
//Variables
$arrIngresos = array();
$arrEgresos  = array();
$arrGastos   = array();
//reseteo
for ($i = 1; $i <= 12; $i++) {
    $arrIngresos[$i]  = 0;
    $arrEgresos[$i]   = 0;
    $arrGastos[$i]    = 0;
}
/********************************************/
//recorro los datos
foreach ($arrTemporal_1 as $trab) {
	$idTipo = $trab['idTipo'];
	$mes    = $trab['Creacion_mes'];
	$Valor  = $trab['ValorTotal'];
	switch ($idTipo) {
		case 1: $arrEgresos[$mes]   = $arrEgresos[$mes]  + $Valor; break;//Compra
		case 2: $arrIngresos[$mes]  = $arrIngresos[$mes] + $Valor; break;//Venta
		case 10: $arrEgresos[$mes]  = $arrEgresos[$mes]  + $Valor; break;//Nota Debito Proveedor
		case 11: $arrEgresos[$mes]  = $arrEgresos[$mes]  - $Valor; break;//Nota Credito Proveedor
		case 12: $arrIngresos[$mes] = $arrIngresos[$mes] + $Valor; break;//Nota Debito Cliente
		case 13: $arrIngresos[$mes] = $arrIngresos[$mes] - $Valor; break;//Nota Credito Cliente
	}
}
/********************************************/
//recorro los datos
foreach ($arrTemporal_2 as $trab) {
	$idTipo = $trab['idTipo'];
	$mes    = $trab['Creacion_mes'];
	$Valor  = $trab['ValorTotal'];
	switch ($idTipo) {
		case 1: $arrEgresos[$mes]   = $arrEgresos[$mes]  + $Valor; break;//Compra
		case 2: $arrIngresos[$mes]  = $arrIngresos[$mes] + $Valor; break;//Venta
		case 10: $arrEgresos[$mes]  = $arrEgresos[$mes]  + $Valor; break;//Nota Debito Proveedor
		case 11: $arrEgresos[$mes]  = $arrEgresos[$mes]  - $Valor; break;//Nota Credito Proveedor
		case 12: $arrIngresos[$mes] = $arrIngresos[$mes] + $Valor; break;//Nota Debito Cliente
		case 13: $arrIngresos[$mes] = $arrIngresos[$mes] - $Valor; break;//Nota Credito Cliente
	}
}
/********************************************/
//recorro los datos
foreach ($arrTemporal_3 as $trab) {
	$idTipo = $trab['idTipo'];
	$mes    = $trab['Creacion_mes'];
	$Valor  = $trab['ValorTotal'];
	switch ($idTipo) {
		case 1: $arrEgresos[$mes]   = $arrEgresos[$mes]  + $Valor; break;//Compra
		case 2: $arrIngresos[$mes]  = $arrIngresos[$mes] + $Valor; break;//Venta
		case 10: $arrEgresos[$mes]  = $arrEgresos[$mes]  + $Valor; break;//Nota Debito Proveedor
		case 11: $arrEgresos[$mes]  = $arrEgresos[$mes]  - $Valor; break;//Nota Credito Proveedor
		case 12: $arrIngresos[$mes] = $arrIngresos[$mes] + $Valor; break;//Nota Debito Cliente
		case 13: $arrIngresos[$mes] = $arrIngresos[$mes] - $Valor; break;//Nota Credito Cliente
	}
}
/********************************************/
//recorro los datos
foreach ($arrTemporal_4 as $trab) {
	$idTipo = $trab['idTipo'];
	$mes    = $trab['Creacion_mes'];
	$Valor  = $trab['ValorTotal'];
	switch ($idTipo) {
		case 1: $arrEgresos[$mes]   = $arrEgresos[$mes]  + $Valor; break;//Compra
		case 2: $arrIngresos[$mes]  = $arrIngresos[$mes] + $Valor; break;//Venta
		case 10: $arrEgresos[$mes]  = $arrEgresos[$mes]  + $Valor; break;//Nota Debito Proveedor
		case 11: $arrEgresos[$mes]  = $arrEgresos[$mes]  - $Valor; break;//Nota Credito Proveedor
		case 12: $arrIngresos[$mes] = $arrIngresos[$mes] + $Valor; break;//Nota Debito Cliente
		case 13: $arrIngresos[$mes] = $arrIngresos[$mes] - $Valor; break;//Nota Credito Cliente
	}
}
/********************************************/
//recorro los datos
foreach ($arrTemporal_5 as $trab) {
	$mes    = $trab['Creacion_mes'];
	$Valor  = $trab['ValorTotal'];
	$arrGastos[$mes]  = $arrGastos[$mes]  + $Valor;
}
/********************************************/
//recorro los datos
foreach ($arrTemporal_6 as $trab) {
	$mes    = $trab['Creacion_mes'];
	$Valor  = $trab['ValorTotal'];
	$arrGastos[$mes]  = $arrGastos[$mes]  + $Valor;
}
/********************************************/
//recorro
$arrTabsSorter = array();
foreach ($arrTabs as $tab) { 
	$arrTabsSorter[$tab['idTab']]['Nombre']          = $tab['Nombre'];
	$arrTabsSorter[$tab['idTab']]['CuentaCliente']   = 0;
	$arrTabsSorter[$tab['idTab']]['CuentaProspecto'] = 0;
}	

//variables
$total_tab_cliente   = 0;
$total_tab_prospecto = 0;
foreach ($arrClientes as $data) {
	if(isset($data['idTab_1'])&&$data['idTab_1']==2&&isset($arrTabsSorter[1]['Nombre'])){ $arrTabsSorter[1]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_2'])&&$data['idTab_2']==2&&isset($arrTabsSorter[2]['Nombre'])){ $arrTabsSorter[2]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_3'])&&$data['idTab_3']==2&&isset($arrTabsSorter[3]['Nombre'])){ $arrTabsSorter[3]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_4'])&&$data['idTab_4']==2&&isset($arrTabsSorter[4]['Nombre'])){ $arrTabsSorter[4]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_5'])&&$data['idTab_5']==2&&isset($arrTabsSorter[5]['Nombre'])){ $arrTabsSorter[5]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_6'])&&$data['idTab_6']==2&&isset($arrTabsSorter[6]['Nombre'])){ $arrTabsSorter[6]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_7'])&&$data['idTab_7']==2&&isset($arrTabsSorter[7]['Nombre'])){ $arrTabsSorter[7]['CuentaCliente']++; $total_tab_cliente++;}
	if(isset($data['idTab_8'])&&$data['idTab_8']==2&&isset($arrTabsSorter[8]['Nombre'])){ $arrTabsSorter[8]['CuentaCliente']++; $total_tab_cliente++;}
}
foreach ($arrProspecto as $data) {
	if(isset($data['idTab_1'])&&$data['idTab_1']==2&&isset($arrTabsSorter[1]['Nombre'])){ $arrTabsSorter[1]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_2'])&&$data['idTab_2']==2&&isset($arrTabsSorter[2]['Nombre'])){ $arrTabsSorter[2]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_3'])&&$data['idTab_3']==2&&isset($arrTabsSorter[3]['Nombre'])){ $arrTabsSorter[3]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_4'])&&$data['idTab_4']==2&&isset($arrTabsSorter[4]['Nombre'])){ $arrTabsSorter[4]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_5'])&&$data['idTab_5']==2&&isset($arrTabsSorter[5]['Nombre'])){ $arrTabsSorter[5]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_6'])&&$data['idTab_6']==2&&isset($arrTabsSorter[6]['Nombre'])){ $arrTabsSorter[6]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_7'])&&$data['idTab_7']==2&&isset($arrTabsSorter[7]['Nombre'])){ $arrTabsSorter[7]['CuentaProspecto']++; $total_tab_prospecto++;}
	if(isset($data['idTab_8'])&&$data['idTab_8']==2&&isset($arrTabsSorter[8]['Nombre'])){ $arrTabsSorter[8]['CuentaProspecto']++; $total_tab_prospecto++;}
}
		
		
//calculo de porcentajes clientes
if($total_tab_cliente!=0){
	if(isset($arrTabsSorter[1]['Nombre'])&&$arrTabsSorter[1]['Nombre']!=''){ $porc_clien_1 = Cantidades(($arrTabsSorter[1]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[2]['Nombre'])&&$arrTabsSorter[2]['Nombre']!=''){ $porc_clien_2 = Cantidades(($arrTabsSorter[2]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[3]['Nombre'])&&$arrTabsSorter[3]['Nombre']!=''){ $porc_clien_3 = Cantidades(($arrTabsSorter[3]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[4]['Nombre'])&&$arrTabsSorter[4]['Nombre']!=''){ $porc_clien_4 = Cantidades(($arrTabsSorter[4]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[5]['Nombre'])&&$arrTabsSorter[5]['Nombre']!=''){ $porc_clien_5 = Cantidades(($arrTabsSorter[5]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[6]['Nombre'])&&$arrTabsSorter[6]['Nombre']!=''){ $porc_clien_6 = Cantidades(($arrTabsSorter[6]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[7]['Nombre'])&&$arrTabsSorter[7]['Nombre']!=''){ $porc_clien_7 = Cantidades(($arrTabsSorter[7]['CuentaCliente']/$total_tab_cliente)*100, 0);}
	if(isset($arrTabsSorter[8]['Nombre'])&&$arrTabsSorter[8]['Nombre']!=''){ $porc_clien_8 = Cantidades(($arrTabsSorter[8]['CuentaCliente']/$total_tab_cliente)*100, 0);}
}else{
	$porc_clien_1 = 0;
	$porc_clien_2 = 0;
	$porc_clien_3 = 0;
	$porc_clien_4 = 0;
	$porc_clien_5 = 0;
	$porc_clien_6 = 0;
	$porc_clien_7 = 0;
	$porc_clien_8 = 0;
}
															
//calculo de porcentajes prospectos
if($total_tab_prospecto!=0){
	if(isset($arrTabsSorter[1]['Nombre'])&&$arrTabsSorter[1]['Nombre']!=''){ $porc_prosp_1 = Cantidades(($arrTabsSorter[1]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[2]['Nombre'])&&$arrTabsSorter[2]['Nombre']!=''){ $porc_prosp_2 = Cantidades(($arrTabsSorter[2]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[3]['Nombre'])&&$arrTabsSorter[3]['Nombre']!=''){ $porc_prosp_3 = Cantidades(($arrTabsSorter[3]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[4]['Nombre'])&&$arrTabsSorter[4]['Nombre']!=''){ $porc_prosp_4 = Cantidades(($arrTabsSorter[4]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[5]['Nombre'])&&$arrTabsSorter[5]['Nombre']!=''){ $porc_prosp_5 = Cantidades(($arrTabsSorter[5]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[6]['Nombre'])&&$arrTabsSorter[6]['Nombre']!=''){ $porc_prosp_6 = Cantidades(($arrTabsSorter[6]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[7]['Nombre'])&&$arrTabsSorter[7]['Nombre']!=''){ $porc_prosp_7 = Cantidades(($arrTabsSorter[7]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
	if(isset($arrTabsSorter[8]['Nombre'])&&$arrTabsSorter[8]['Nombre']!=''){ $porc_prosp_8 = Cantidades(($arrTabsSorter[8]['CuentaProspecto']/$total_tab_prospecto)*100, 0);}
}else{
	$porc_prosp_1 = 0;
	$porc_prosp_2 = 0;
	$porc_prosp_3 = 0;
	$porc_prosp_4 = 0;
	$porc_prosp_5 = 0;
	$porc_prosp_6 = 0;
	$porc_prosp_7 = 0;
	$porc_prosp_8 = 0;
}

//se recorre
$arrTemp = array();
foreach ($arrTemporal_b_1 as $trab) {
	$idTipo   = $trab['idTipo'];
	$ID       = $trab['ID'];
	$Valor    = $trab['Total'];
	$Cliente  = $trab['Cliente'];
	//si existe
	if(isset($arrTemp[$ID]['Total'])){
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] - $Valor;
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] + $Valor;
		}
	//si no existe se crea	
	}else{
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = ($Valor*-1);
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $Valor;
		}
	}
	//nombre cliente
	$arrTemp[$ID]['Nombre'] = $Cliente;
}
foreach ($arrTemporal_b_2 as $trab) {
	$idTipo   = $trab['idTipo'];
	$ID       = $trab['ID'];
	$Valor    = $trab['Total'];
	$Cliente  = $trab['Cliente'];
	//si existe
	if(isset($arrTemp[$ID]['Total'])){
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] - $Valor;
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] + $Valor;
		}
	//si no existe se crea	
	}else{
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = ($Valor*-1);
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $Valor;
		}
	}
	//nombre cliente
	$arrTemp[$ID]['Nombre'] = $Cliente;
}
foreach ($arrTemporal_b_3 as $trab) {
	$idTipo   = $trab['idTipo'];
	$ID       = $trab['ID'];
	$Valor    = $trab['Total'];
	$Cliente  = $trab['Cliente'];
	//si existe
	if(isset($arrTemp[$ID]['Total'])){
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] - $Valor;
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] + $Valor;
		}
	//si no existe se crea	
	}else{
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = ($Valor*-1);
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $Valor;
		}
	}
	//nombre cliente
	$arrTemp[$ID]['Nombre'] = $Cliente;
}
foreach ($arrTemporal_b_4 as $trab) {
	$idTipo   = $trab['idTipo'];
	$ID       = $trab['ID'];
	$Valor    = $trab['Total'];
	$Cliente  = $trab['Cliente'];
	//si existe
	if(isset($arrTemp[$ID]['Total'])){
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] - $Valor;
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $arrTemp[$ID]['Total'] + $Valor;
		}
	//si no existe se crea	
	}else{
		//si es nota de credito
		if($idTipo==13){
			$arrTemp[$ID]['Total'] = ($Valor*-1);
		//para venta y nota de debito	
		}else{
			$arrTemp[$ID]['Total'] = $Valor;
		}
	}
	//nombre cliente
	$arrTemp[$ID]['Nombre'] = $Cliente;
}		
/*****************************************************************************************************************/
/*                                               Resultados                                                       */
/*****************************************************************************************************************/
	
/******************************************/
//Operación
$totalCalendario       = $subconsulta['CuentaEventos'];					
$totalNotificaciones   = $subconsulta['Notificacion'];	
$totalTicketsAbiertos  = $subconsulta['TicketsAbiertos'];

/******************************************/
//VENTAS
$totalFactVenta       = $subconsulta['CountFactArriendoVent'] + $subconsulta['CountFactInsumoVent'] + $subconsulta['CountFactProductoVent'] + $subconsulta['CountFactServicioVent'];

/******************************************/		
//COMPRAS
$totalFactCompra       = $subconsulta['CountFactArriendo'] + $subconsulta['CountFactInsumo'] + $subconsulta['CountFactProducto'] + $subconsulta['CountFactServicio'];					
$totalStockMin         = $nprod_bajostock;					
$totalOCSinApro        = $subconsulta['CuentaOC'];					
$totalSolSinOC         = $subconsulta['CuentaSolProd'] + $subconsulta['CuentaSolIns'] + $subconsulta['CuentaSolArr'] + $subconsulta['CuentaSolServ'] + $subconsulta['CuentaSolOtro'];					
	
/******************************************/
//CRM
//Primera linea
if(isset($t_clientes)&&$t_clientes!=''){ $total_clientes  = $t_clientes; }else{$total_clientes  = 0;}
if(isset($n_clientes)&&$n_clientes!=''){ $nuevos_clientes = $n_clientes; }else{$nuevos_clientes = 0;}
if($total_clientes!=0){
	$porc_apertura = Cantidades(($nuevos_clientes / $total_clientes)*100, 0).'%';
}else{
	$porc_apertura = '0%';
}
//segunda linea
if(isset($Prospec_abierto)&&$Prospec_abierto!=''){ $Prospecto_abierto  = $Prospec_abierto; }else{$Prospecto_abierto  = 0;}
if(isset($Prospec_cerrado)&&$Prospec_cerrado!=''){ $Prospecto_cerrado  = $Prospec_cerrado; }else{$Prospecto_cerrado  = 0;}
$Prospecto_total = $Prospecto_abierto + $Prospecto_cerrado;
if($Prospecto_total!=0){
	$clientes_cerrados = Cantidades(($Prospecto_cerrado/$Prospecto_total)*100, 0).'%';
}else{
	$clientes_cerrados = '0%';
}



//se suma el ingreso
$ing_mens_contrato = 0;
foreach ($arrClientes as $trab) {
	$ing_mens_contrato = $ing_mens_contrato + $trab['Contrato_Valor_Mensual'];
}
$ing_mens_contrato = valores($ing_mens_contrato, 0);
		
/******************************************/		
		
			
											
?>

<div class="row">
	<div class="col-sm-12">
		<?php
		/***************************************************************/
		echo '
		<div class="panel-heading">
			<h3 class="supertittle text-primary">Operación</h3>
		</div>';
			
		echo '
		<div class="col-sm-12">';
			//verifico si existen datos
			if($CON_Server!=''&&$CON_Usuario!=''&&$CON_Base!=''){
				//Detalle por Equipos
				echo widget_Equipos_external($dbConn_2);
			}
			
			echo '<div class="row">';	
				echo widget_Ficha_1('bg-purple', 'fa-calendar', 100, 'Calendario Mes', $totalCalendario.' Pendientes', 'principal_calendario_alt.php?pagina=1', 'Ver Pendientes', 1,2);
				echo widget_Ficha_1('bg-black', 'fa-envelope-o', 100, 'Notificaciones', $totalNotificaciones.' Pendientes', 'principal_notificaciones_alt.php?pagina=1', 'Ver Pendientes', 1,2);
				echo widget_Ficha_1('bg-red', 'fa-handshake-o', 100, 'Tickets', $totalTicketsAbiertos.' Pendientes', 'crosstech_gestion_tickets_abiertos.php?pagina=1', 'Ver Pendientes', 1,2);
			echo '</div>';
		echo '</div>';
		
		echo '<div class="clearfix"></div>';

		/***************************************************************/
		echo '
		<div class="panel-heading">
			<h3 class="supertittle text-primary">VENTAS</h3>
		</div>';
		
		echo '<div class="row">';
			echo widget_Ficha_1('bg-aqua', 'fa-usd', 100, 'Cuentas por cobrar', $totalFactVenta.' Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
		echo '</div>';	

		echo '<div class="">'; ?>
		
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			  google.charts.load('current', {'packages':['corechart', 'bar']});
			  google.charts.setOnLoadCallback(drawVisualization);

			  function drawVisualization() {
				// Some raw data (not necessarily accurate)
				var data = google.visualization.arrayToDataTable([
				  ['Meses', 'Ingresos', 'Egresos'],
				  ['<?php echo ano_actual(); ?>/01',  <?php echo $arrIngresos[1]; ?>,   <?php echo ($arrEgresos[1]  + $arrGastos[1]); ?>],
				  ['<?php echo ano_actual(); ?>/02',  <?php echo $arrIngresos[2]; ?>,   <?php echo ($arrEgresos[2]  + $arrGastos[2]); ?>],
				  ['<?php echo ano_actual(); ?>/03',  <?php echo $arrIngresos[3]; ?>,   <?php echo ($arrEgresos[3]  + $arrGastos[3]); ?>],
				  ['<?php echo ano_actual(); ?>/04',  <?php echo $arrIngresos[4]; ?>,   <?php echo ($arrEgresos[4]  + $arrGastos[4]); ?>],
				  ['<?php echo ano_actual(); ?>/05',  <?php echo $arrIngresos[5]; ?>,   <?php echo ($arrEgresos[5]  + $arrGastos[5]); ?>],
				  ['<?php echo ano_actual(); ?>/06',  <?php echo $arrIngresos[6]; ?>,   <?php echo ($arrEgresos[6]  + $arrGastos[6]); ?>],
				  ['<?php echo ano_actual(); ?>/07',  <?php echo $arrIngresos[7]; ?>,   <?php echo ($arrEgresos[7]  + $arrGastos[7]); ?>],
				  ['<?php echo ano_actual(); ?>/08',  <?php echo $arrIngresos[8]; ?>,   <?php echo ($arrEgresos[8]  + $arrGastos[8]); ?>],
				  ['<?php echo ano_actual(); ?>/09',  <?php echo $arrIngresos[9]; ?>,   <?php echo ($arrEgresos[9]  + $arrGastos[9]); ?>],
				  ['<?php echo ano_actual(); ?>/10',  <?php echo $arrIngresos[10]; ?>,  <?php echo ($arrEgresos[10] + $arrGastos[10]); ?>],
				  ['<?php echo ano_actual(); ?>/11',  <?php echo $arrIngresos[11]; ?>,  <?php echo ($arrEgresos[11] + $arrGastos[11]); ?>],
				  ['<?php echo ano_actual(); ?>/12',  <?php echo $arrIngresos[12]; ?>,  <?php echo ($arrEgresos[12] + $arrGastos[12]); ?>]
				]);

				var options = {
				  title : 'Flujo Economico',
				  vAxis: {title: 'Pesos'},
				  hAxis: {title: 'Meses'},
				  seriesType: 'bars',
				  legend:'none'
				};

				var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			</script>

			<div id="chart_div" style="width: 100%; height: 500px;"></div>

		<?php echo '</div>';
		
		
		/***************************************************************/
		echo '
		<div class="panel-heading">
			<h3 class="supertittle text-primary">COMPRAS</h3>
		</div>';
		
		echo '<div class="row">';
			echo widget_Ficha_1('bg-aqua', 'fa-usd', 100, 'Cuentas por pagar', $totalFactCompra.' Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=1', 'Ver Pendientes', 1,2);
			echo widget_Ficha_1('bg-green', 'fa-dropbox', 100, 'Alerta Stock Minimo', $totalStockMin.' Criticos', 'informe_bodega_productos_03.php', 'Ver Stock', 1,2);
			echo widget_Ficha_1('bg-yellow', 'fa-list-alt', 100, 'OC Sin Aprobar', $totalOCSinApro.' Pendientes', 'ocompra_listado_sin_aprobar.php?pagina=1', 'Ver Pendientes', 2,1);
			echo widget_Ficha_1('bg-red', 'fa-list-alt', 100, 'Solicitudes Sin OC', $totalSolSinOC.' Pendientes', 'ocompra_generacion.php?idSistema=&submit=Filtrar', 'Ver Pendientes', 2,1);
		echo '</div>';																					
		
		/***************************************************************/
		echo '
		<div class="panel-heading">
			<h3 class="supertittle text-primary">CRM</h3>
		</div>';
		
		/***************************************************************/
		//clientes cerrados
		echo '<div class="row">';
			echo widget_Ficha_2('box-blue', '', $total_clientes, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);    
			echo widget_Ficha_2('box-blue', '', $nuevos_clientes, 4, 'Nuevos Clientes', '', '', '', '', 1, 2);    
			echo widget_Ficha_2('box-blue', '', $porc_apertura, 4, '% Apertura', '', '', '', '', 1, 2);    
			
			echo widget_Ficha_2('box-blue', '', $Prospecto_cerrado.'<span style="font-size: 15px;">Cerrado</span>/'.$Prospecto_total.'<span style="font-size: 15px;">Total</span>', 4, 'Prospectos', '', '', '', '', 1, 2);    
			echo widget_Ficha_2('box-blue', '', $clientes_cerrados, 4, 'Clientes Cerrados', '', '', '', '', 1, 2);    
			echo widget_Ficha_2('box-blue', '', $ing_mens_contrato, 4, 'Ingreso Mensual Contrato', '', '', '', '', 1, 2);    
		echo '</div>';
						
					
		/*******************************************/
												
		?>

		<div class="row">
			<script>
				google.charts.setOnLoadCallback(drawChart_cliente);
				google.charts.setOnLoadCallback(drawChart_prospecto);

				function drawChart_cliente() {
					var data = google.visualization.arrayToDataTable([
						['Unidad Negocio', 'Cantidad'],
						<?php 
						if(isset($porc_clien_1)&&$porc_clien_1!=0){echo '["'.$arrTabsSorter[1]['Nombre'].'", '.$porc_clien_1.'],';}
						if(isset($porc_clien_2)&&$porc_clien_2!=0){echo '["'.$arrTabsSorter[2]['Nombre'].'", '.$porc_clien_2.'],';}
						if(isset($porc_clien_3)&&$porc_clien_3!=0){echo '["'.$arrTabsSorter[3]['Nombre'].'", '.$porc_clien_3.'],';}
						if(isset($porc_clien_4)&&$porc_clien_4!=0){echo '["'.$arrTabsSorter[4]['Nombre'].'", '.$porc_clien_4.'],';}
						if(isset($porc_clien_5)&&$porc_clien_5!=0){echo '["'.$arrTabsSorter[5]['Nombre'].'", '.$porc_clien_5.'],';}
						if(isset($porc_clien_6)&&$porc_clien_6!=0){echo '["'.$arrTabsSorter[6]['Nombre'].'", '.$porc_clien_6.'],';}
						if(isset($porc_clien_7)&&$porc_clien_7!=0){echo '["'.$arrTabsSorter[7]['Nombre'].'", '.$porc_clien_7.'],';}
						if(isset($porc_clien_8)&&$porc_clien_8!=0){echo '["'.$arrTabsSorter[8]['Nombre'].'", '.$porc_clien_8.'],';}
						?>
					]);
					var options = {
						title: 'U.N. Clientes'
					};
					var chart = new google.visualization.PieChart(document.getElementById('piechart_clientes'));
					chart.draw(data, options);
				}
				
				function drawChart_prospecto() {
					var data = google.visualization.arrayToDataTable([
						['Unidad Negocio', 'Cantidad'],
						<?php 
						if(isset($porc_prosp_1)&&$porc_prosp_1!=0){echo '["'.$arrTabsSorter[1]['Nombre'].'", '.$porc_prosp_1.'],';}
						if(isset($porc_prosp_2)&&$porc_prosp_2!=0){echo '["'.$arrTabsSorter[2]['Nombre'].'", '.$porc_prosp_2.'],';}
						if(isset($porc_prosp_3)&&$porc_prosp_3!=0){echo '["'.$arrTabsSorter[3]['Nombre'].'", '.$porc_prosp_3.'],';}
						if(isset($porc_prosp_4)&&$porc_prosp_4!=0){echo '["'.$arrTabsSorter[4]['Nombre'].'", '.$porc_prosp_4.'],';}
						if(isset($porc_prosp_5)&&$porc_prosp_5!=0){echo '["'.$arrTabsSorter[5]['Nombre'].'", '.$porc_prosp_5.'],';}
						if(isset($porc_prosp_6)&&$porc_prosp_6!=0){echo '["'.$arrTabsSorter[6]['Nombre'].'", '.$porc_prosp_6.'],';}
						if(isset($porc_prosp_7)&&$porc_prosp_7!=0){echo '["'.$arrTabsSorter[7]['Nombre'].'", '.$porc_prosp_7.'],';}
						if(isset($porc_prosp_8)&&$porc_prosp_8!=0){echo '["'.$arrTabsSorter[8]['Nombre'].'", '.$porc_prosp_8.'],';}
						?>
					]);
					var options = {
						title: 'U.N. Prospectos'
					};
					var chart = new google.visualization.PieChart(document.getElementById('piechart_prospectos'));
					chart.draw(data, options);
				}
			</script>
			<div class="col-sm-6">
				<div id="piechart_clientes"   style="width: 100%; height: 500px;"></div>
			</div>
			<div class="col-sm-6">
				<div id="piechart_prospectos" style="width: 100%; height: 500px;"></div>
			</div>
			
			
			<script>
				google.charts.setOnLoadCallback(drawBasic_ingresos);
				function drawBasic_ingresos() {

					var data = google.visualization.arrayToDataTable([
						['Empresa', 'Valor', { role: 'annotation' },],
						<?php
						foreach ($arrTemp as $temp) {
							echo '["'.$temp['Nombre'].'", '.$temp['Total'].', "'.$temp['Nombre'].'"],';
						}
						?>
					]);
					var options = {
						title: 'Clientes/Ingresos (Anual)',
						chartArea: {width: '90%'},
						hAxis: {
							title: 'Ingresos',
							minValue: 0
						},
						vAxis: {
							title: 'Clientes'
						}
					};
					var chart = new google.visualization.BarChart(document.getElementById('piechart_ingresos'));
					chart.draw(data, options);
				}
			</script>
			
				
			<div class="col-sm-6">
				<div id="piechart_ingresos"   style="width: 100%; height: 500px;"></div>
			</div>
			

			<script>
				window.onload = function () {

					var chart = new CanvasJS.Chart("piechart_embudo", {
						animationEnabled: true,
						theme: "light1", //"light1", "light2", "dark1", "dark2"
						title:{
							text: "Embudo de Ventas"
						},
						data: [{
							type: "funnel",
							indexLabelPlacement: "inside",
							indexLabelFontColor: "white",
							toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
							indexLabel: "{label} ({percentage}%)",
							dataPoints: [
								<?php
								foreach ($arrEtapa as $temp) {
									echo '{ y: '.$temp['Cuenta'].', label: "'.$temp['Etapa'].'" },';
								}
								?>
							]
						}]
					});
					calculatePercentage();
					chart.render();

					function calculatePercentage() {
						var dataPoint = chart.options.data[0].dataPoints;
						var total = dataPoint[0].y;
						for(let i = 0; i < dataPoint.length; i++) {
							if(i == 0) {
								chart.options.data[0].dataPoints[i].percentage = 100;
							} else {
								chart.options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
							}
						}
					}

				}
			</script>

			<div class="col-sm-6">
				<div id="piechart_embudo" style="width: 100%; height: 500px;"></div>
				<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
			</div>
			
		</div>
		
		
	</div>
</div>
