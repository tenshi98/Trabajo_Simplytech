<?php 
/*****************************************************************************************************************/
/*                                               Transacciones                                                   */
/*****************************************************************************************************************/
//variable de numero de permiso
$x_nperm = 0;

//permisos a las transacciones
$x_nperm++; $trans[$x_nperm] = "informe_gerencial_01.php";                        //01 - Informe del estado de la bodega de insumos
$x_nperm++; $trans[$x_nperm] = "informe_bodega_productos_04.php";                 //02 - Bodega de Productos
$x_nperm++; $trans[$x_nperm] = "informe_bodega_insumos_04.php";                   //03 - Bodega de Insumos
$x_nperm++; $trans[$x_nperm] = "informe_bodega_arriendos_04.php";                 //04 - Bodega de Arriendos
$x_nperm++; $trans[$x_nperm] = "informe_bodega_servicios_04.php";                 //05 - Bodega de Servicios

$x_nperm++; $trans[$x_nperm] = "analisis_listado.php";                            //06 - Ingreso analisis maquinas

$x_nperm++; $trans[$x_nperm] = "telemetria_gestion_flota.php";                    //07 - Acceso a la transaccion de administracion de gestion de flota (vehiculos
$x_nperm++; $trans[$x_nperm] = "telemetria_gestion_sensores.php";                 //08 - Acceso a la transaccion de administracion de gestion sensores (colegios)
$x_nperm++; $trans[$x_nperm] = "telemetria_gestion_equipos.php";                  //09 - Acceso a la transaccion de administracion de gestion de equipos (todos los sensores)
	
$x_nperm++; $trans[$x_nperm] = "orden_trabajo_crear.php";                         //10 - Creacion de OT
$x_nperm++; $trans[$x_nperm] = "orden_trabajo_terminar.php";                      //11 - Cierre de OT

$x_nperm++; $trans[$x_nperm] = "telemetria_carga_bam.php";                        //12 - Calendario con las cargas por vencer en la semana
$x_nperm++; $trans[$x_nperm] = "ocompra_generacion.php";                          //13 - Creacion de OC basadas en solicitudes
$x_nperm++; $trans[$x_nperm] = "ocompra_listado_sin_aprobar.php";                 //14 - Mostrar las OC sin aprobar

$x_nperm++; $trans[$x_nperm] = "bodegas_arriendos_ingreso.php";                   //15 - Mostrar las facturas (Compra) de arriendo por vencer
$x_nperm++; $trans[$x_nperm] = "bodegas_insumos_ingreso.php";                     //16 - Mostrar las facturas (Compra) de insumos por vencer
$x_nperm++; $trans[$x_nperm] = "bodegas_productos_ingreso.php";                   //17 - Mostrar las facturas (Compra) de productos por vencer
$x_nperm++; $trans[$x_nperm] = "bodegas_servicios_ingreso.php";                   //18 - Mostrar las facturas (Compra) de servicios por vencer

$x_nperm++; $trans[$x_nperm] = "bodegas_arriendos_egreso.php";                    //19 - Mostrar las facturas (Venta) de arriendo por vencer
$x_nperm++; $trans[$x_nperm] = "bodegas_productos_egreso.php";                    //20 - Mostrar las facturas (Venta) de productos por vencer
$x_nperm++; $trans[$x_nperm] = "bodegas_servicios_egreso.php";                    //21 - Mostrar las facturas (Venta) de servicios por vencer
$x_nperm++; $trans[$x_nperm] = "bodegas_insumos_ventas.php";                      //22 - Mostrar las facturas (Venta) de insumos por vencer

$x_nperm++; $trans[$x_nperm] = "informe_gerencial_04.php";                        //23 - Mostrar los cheques (Compra) por vencer general
$x_nperm++; $trans[$x_nperm] = "informe_gerencial_06.php";                        //24 - Mostrar los cheques (Compra) por vencer por semana

$x_nperm++; $trans[$x_nperm] = "informe_gerencial_07.php";                        //25 - Mostrar los cheques (Venta) por vencer general
$x_nperm++; $trans[$x_nperm] = "informe_gerencial_08.php";                        //26 - Mostrar los cheques (Venta) por vencer por semana

$x_nperm++; $trans[$x_nperm] = "caja_chica_listado.php";                          //27 - Creacion de nuevas cajas chicas
$x_nperm++; $trans[$x_nperm] = "caja_chica_ingreso.php";                          //28 - Ingreso de montos a las cajas chicas
$x_nperm++; $trans[$x_nperm] = "caja_chica_egreso.php";                           //29 - Egresos de montos de la caja chica
$x_nperm++; $trans[$x_nperm] = "caja_chica_rendicion.php";                        //30 - Ingreso de rendiciones de la caja chica
$x_nperm++; $trans[$x_nperm] = "caja_chica_rendida.php";                          //31 - Ingreso de cajas chicas ya rendidas

$x_nperm++; $trans[$x_nperm] = "cross_shipping_consolidacion.php";                //32 - Ingreso de consolidaciones de carga
$x_nperm++; $trans[$x_nperm] = "cross_shipping_consolidacion_anuladas.php";       //33 - Visualizacion de las consolidaciones anuladas
$x_nperm++; $trans[$x_nperm] = "cross_shipping_consolidacion_aprobadas.php";      //34 - Visualizacion de las consolidaciones aprobadas
$x_nperm++; $trans[$x_nperm] = "cross_shipping_consolidacion_aprobar.php";        //35 - Visualizacion de las consolidaciones en espera de aprobacion
$x_nperm++; $trans[$x_nperm] = "cross_shipping_consolidacion_aprobar_auto.php";   //36 - Visualizacion de las consolidaciones en espera de aprobacion
$x_nperm++; $trans[$x_nperm] = "cross_shipping_consolidacion_rechazadas.php";     //37 - Visualizacion de las consolidaciones rechazadas

$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_crear.php";            //38 - Ingreso de solicitudes de aplicacion
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_ejecucion.php";        //39 - ejecucion de solicitudes de aplicacion
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_ejecutar.php";         //40 - ejecutar de solicitudes de aplicacion
$x_nperm++; $trans[$x_nperm] = "cross_solicitud_aplicacion_terminar.php";         //41 - terminar de solicitudes de aplicacion


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
/*                                                Consultas                                                      */
/*****************************************************************************************************************/
//Se ven las mantenciones programadas
$query = "SELECT Fecha, Descripcion, Hora_ini, Hora_fin
FROM `core_mantenciones`
ORDER BY idMantencion
LIMIT 1 ";
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
$Mantenciones = mysqli_fetch_assoc ($resultado);
/************************************************************************************/
//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$query = "SELECT idOpcionesTel,idOpcionesGen_1, idOpcionesGen_2, idOpcionesGen_4, idOpcionesGen_6,
idOpcionesGen_7, idOpcionesGen_9

FROM core_sistemas
WHERE idSistema='".$_SESSION['usuario']['basic_data']['idSistema']."' "; 
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
$n_permisos = mysqli_fetch_assoc($resultado);
/*****************************************************************************************************************/
/*                                                Subconsultas                                                   */
/*****************************************************************************************************************/
//Variables
$subquery       = '';
$idTipoUsuario  = $_SESSION['usuario']['basic_data']['idTipoUsuario'];


//Verifico el tipo de usuario que esta ingresando
if($idTipoUsuario==1){
	$z =" WHERE idSistema>=0";	
	$z.=" AND idUsuario>=0";
	$w =" WHERE idSistema>=0";
	$x1 ="idSistema>=0";
	$x2 ="idUsuario>=0";		
}else{
	$z =" WHERE idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	$z.=" AND idUsuario=".$_SESSION['usuario']['basic_data']['idUsuario'];
	$w =" WHERE idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	$x1 ="idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
	$x2 ="idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
/****************************************/
//Visualizacion de los widgets Comunes, se verifica si esta activado o si es un superusuario
if($n_permisos['idOpcionesGen_1']=='1' or $idTipoUsuario==1) { 
	$subquery .= ",(SELECT COUNT(idNoti) FROM principal_notificaciones_ver ".$z." AND idEstado='1' LIMIT 1) AS Notificacion";
	$subquery .= ",(SELECT COUNT(idAgenda) FROM principal_agenda_telefonica ".$w." AND idUsuario = '{$_SESSION['usuario']['basic_data']['idUsuario']}' OR idUsuario=9999 LIMIT 1) AS CuentaContactos";
	$subquery .= ",(SELECT COUNT(idSoftware) FROM soporte_software_listado LIMIT 1) AS CuentaProgramas";
	$subquery .= ",(SELECT COUNT(idCalendario) FROM principal_calendario_listado ".$w." AND Mes=".mes_actual()." AND Ano=".ano_actual()." LIMIT 1) AS CuentaEventos";
}
/****************************************/
//Visualizacion de los widgets de las transacciones 
if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) { 
	
	/***************************************** PRIMERA COLUMNA *****************************************/
	/*** Cargas por Vencer ***/
	if($prm_x[12]=='1' or $idTipoUsuario==1) { $subquery .= ",(SELECT COUNT(idCarga) FROM telemetria_carga_bam ".$w." AND Semana=".semana_actual()." AND Ano=".ano_actual()." LIMIT 1) AS CuentaRecargas";}
	
	/*** Solicitudes sin OC ***/
	if($prm_x[13]=='1' or $idTipoUsuario==1) { 
		$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_productos ".$w." AND idOcompra=0 LIMIT 1) AS CuentaSolProd";
		$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_insumos ".$w." AND idOcompra=0 LIMIT 1) AS CuentaSolIns";
		$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_arriendos ".$w." AND idOcompra=0 LIMIT 1) AS CuentaSolArr";
		$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_servicios ".$w." AND idOcompra=0 LIMIT 1) AS CuentaSolServ";
		$subquery .= ",(SELECT COUNT(idExistencia) FROM solicitud_listado_existencias_otros ".$w." AND idOcompra=0 LIMIT 1) AS CuentaSolOtro";
	}
	
	/*** OC sin Aprobar ***/
	if($prm_x[14]=='1' or $idTipoUsuario==1) { $subquery .= ",(SELECT COUNT(idOcompra) FROM ocompra_listado ".$w." AND idEstado=1 LIMIT 1) AS CuentaOC";}

	/*** OT para la Semana ***/
	$OT_Semana = $prm_x[10] + $prm_x[11];					
	if($OT_Semana!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idOT) FROM orden_trabajo_listado WHERE  ".$x1." AND progSemana=".semana_actual()."   AND progAno=".ano_actual()." AND idEstado=1  LIMIT 1 ) AS CountOTSemana";
	}
	
	/*** OT no Cumplidas ***/
	$OT_Semana = $prm_x[10] + $prm_x[11];					
	if($OT_Semana!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idOT) FROM orden_trabajo_listado WHERE  ".$x1." AND progSemana<".semana_actual()."   AND progAno=".ano_actual()." AND idEstado=1  LIMIT 1 ) AS CountOTRetrasada";
	}
	
	/***************************************** SEGUNDA COLUMNA *****************************************/
	/*************** Compras ***************/
	/*** Facturas atrasadas ***/
	$PermFactComp = $prm_x[15] + $prm_x[16] + $prm_x[17] + $prm_x[18];					
	if($PermFactComp!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion    INNER JOIN usuarios_bodegas_arriendos ON usuarios_bodegas_arriendos.idBodega = bodegas_arriendos_facturacion.idBodega           WHERE bodegas_arriendos_facturacion.idEstado=1  AND bodegas_arriendos_facturacion.idTipo=1   AND bodegas_arriendos_facturacion.".$x1."   AND bodegas_arriendos_facturacion.Pago_Semana<".semana_actual()."   AND bodegas_arriendos_facturacion.Pago_ano=".ano_actual()."  AND usuarios_bodegas_arriendos.".$x2." LIMIT 1) AS CountFactArriendo_retr";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_insumos_facturacion      INNER JOIN usuarios_bodegas_insumos ON usuarios_bodegas_insumos.idBodega = bodegas_insumos_facturacion.idBodegaDestino          WHERE bodegas_insumos_facturacion.idEstado=1    AND bodegas_insumos_facturacion.idTipo=1     AND bodegas_insumos_facturacion.".$x1."     AND bodegas_insumos_facturacion.Pago_Semana<".semana_actual()."     AND bodegas_insumos_facturacion.Pago_ano=".ano_actual()."    AND usuarios_bodegas_insumos.".$x2." LIMIT 1) AS CountFactInsumo_retr";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_productos_facturacion    INNER JOIN usuarios_bodegas_productos ON usuarios_bodegas_productos.idBodega = bodegas_productos_facturacion.idBodegaDestino    WHERE bodegas_productos_facturacion.idEstado=1  AND bodegas_productos_facturacion.idTipo=1   AND bodegas_productos_facturacion.".$x1."   AND bodegas_productos_facturacion.Pago_Semana<".semana_actual()."   AND bodegas_productos_facturacion.Pago_ano=".ano_actual()."  AND usuarios_bodegas_productos.".$x2." LIMIT 1) AS CountFactProducto_retr";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_servicios_facturacion WHERE bodegas_servicios_facturacion.idEstado=1  AND bodegas_servicios_facturacion.idTipo=1   AND bodegas_servicios_facturacion.".$x1." AND bodegas_servicios_facturacion.Pago_Semana<".semana_actual()." AND bodegas_servicios_facturacion.Pago_ano=".ano_actual()." LIMIT 1) AS CountFactServicio_retr";
	}
	
	/*** Facturas x pagar ***/
	$PermFactComp = $prm_x[15] + $prm_x[16] + $prm_x[17] + $prm_x[18];					
	if($PermFactComp!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion    INNER JOIN usuarios_bodegas_arriendos ON usuarios_bodegas_arriendos.idBodega = bodegas_arriendos_facturacion.idBodega           WHERE bodegas_arriendos_facturacion.idEstado=1  AND bodegas_arriendos_facturacion.idTipo=1   AND bodegas_arriendos_facturacion.".$x1."   AND bodegas_arriendos_facturacion.Pago_Semana=".semana_actual()."   AND bodegas_arriendos_facturacion.Pago_ano=".ano_actual()."  AND usuarios_bodegas_arriendos.".$x2." LIMIT 1) AS CountFactArriendo";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_insumos_facturacion      INNER JOIN usuarios_bodegas_insumos ON usuarios_bodegas_insumos.idBodega = bodegas_insumos_facturacion.idBodegaDestino          WHERE bodegas_insumos_facturacion.idEstado=1    AND bodegas_insumos_facturacion.idTipo=1     AND bodegas_insumos_facturacion.".$x1."     AND bodegas_insumos_facturacion.Pago_Semana=".semana_actual()."     AND bodegas_insumos_facturacion.Pago_ano=".ano_actual()."    AND usuarios_bodegas_insumos.".$x2." LIMIT 1) AS CountFactInsumo";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_productos_facturacion    INNER JOIN usuarios_bodegas_productos ON usuarios_bodegas_productos.idBodega = bodegas_productos_facturacion.idBodegaDestino    WHERE bodegas_productos_facturacion.idEstado=1  AND bodegas_productos_facturacion.idTipo=1   AND bodegas_productos_facturacion.".$x1."   AND bodegas_productos_facturacion.Pago_Semana=".semana_actual()."   AND bodegas_productos_facturacion.Pago_ano=".ano_actual()."  AND usuarios_bodegas_productos.".$x2." LIMIT 1) AS CountFactProducto";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_servicios_facturacion WHERE bodegas_servicios_facturacion.idEstado=1  AND bodegas_servicios_facturacion.idTipo=1   AND bodegas_servicios_facturacion.".$x1." AND bodegas_servicios_facturacion.Pago_Semana=".semana_actual()." AND bodegas_servicios_facturacion.Pago_ano=".ano_actual()." LIMIT 1) AS CountFactServicio";
	}
	
	/*** Devolucion Arriendos ***/
	if($prm_x[15]=='1' or $idTipoUsuario==1) { $subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion    INNER JOIN usuarios_bodegas_arriendos ON usuarios_bodegas_arriendos.idBodega = bodegas_arriendos_facturacion.idBodega           WHERE bodegas_arriendos_facturacion.idTipo=1 AND bodegas_arriendos_facturacion.idEstadoDevolucion=1   AND bodegas_arriendos_facturacion.".$x1."   AND bodegas_arriendos_facturacion.Devolucion_Semana=".semana_actual()."   AND bodegas_arriendos_facturacion.Devolucion_ano=".ano_actual()."  AND usuarios_bodegas_arriendos.".$x2." LIMIT 1) AS CountArriendoIn";}
	
	/*** Documentos x Pagar ***/
	$PermChequesPagar = $prm_x[23] + $prm_x[24];					
	if($PermChequesPagar!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idPago) FROM pagos_facturas_proveedores    INNER JOIN usuarios_documentos_pago ON usuarios_documentos_pago.idDocPago = pagos_facturas_proveedores.idDocPago           WHERE  pagos_facturas_proveedores.".$x1."   AND pagos_facturas_proveedores.F_Pago_Semana=".semana_actual()."   AND pagos_facturas_proveedores.F_Pago_ano=".ano_actual()."  AND pagos_facturas_proveedores.".$x2." LIMIT 1) AS CountChequePago";
	}
	
	/*************** Ventas ***************/
	/*** Facturas x Cobrar ***/
	$PermFactComp = $prm_x[19] + $prm_x[20] + $prm_x[21] + $prm_x[22];					
	if($PermFactComp!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion    INNER JOIN usuarios_bodegas_arriendos ON usuarios_bodegas_arriendos.idBodega = bodegas_arriendos_facturacion.idBodega           WHERE bodegas_arriendos_facturacion.idEstado=1  AND bodegas_arriendos_facturacion.idTipo=2   AND bodegas_arriendos_facturacion.".$x1."   AND bodegas_arriendos_facturacion.Pago_Semana=".semana_actual()."   AND bodegas_arriendos_facturacion.Pago_ano=".ano_actual()."  AND usuarios_bodegas_arriendos.".$x2." LIMIT 1) AS CountFactArriendoVent";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_insumos_facturacion      INNER JOIN usuarios_bodegas_insumos   ON usuarios_bodegas_insumos.idBodega = bodegas_insumos_facturacion.idBodegaDestino        WHERE bodegas_insumos_facturacion.idEstado=1    AND bodegas_insumos_facturacion.idTipo=2     AND bodegas_insumos_facturacion.".$x1."     AND bodegas_insumos_facturacion.Pago_Semana=".semana_actual()."     AND bodegas_insumos_facturacion.Pago_ano=".ano_actual()."    AND usuarios_bodegas_insumos.".$x2." LIMIT 1) AS CountFactInsumoVent";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_productos_facturacion    INNER JOIN usuarios_bodegas_productos ON usuarios_bodegas_productos.idBodega = bodegas_productos_facturacion.idBodegaDestino    WHERE bodegas_productos_facturacion.idEstado=1  AND bodegas_productos_facturacion.idTipo=2   AND bodegas_productos_facturacion.".$x1."   AND bodegas_productos_facturacion.Pago_Semana=".semana_actual()."   AND bodegas_productos_facturacion.Pago_ano=".ano_actual()."  AND usuarios_bodegas_productos.".$x2." LIMIT 1) AS CountFactProductoVent";
		$subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_servicios_facturacion WHERE bodegas_servicios_facturacion.idEstado=1  AND bodegas_servicios_facturacion.idTipo=2   AND bodegas_servicios_facturacion.".$x1." AND bodegas_servicios_facturacion.Pago_Semana=".semana_actual()." AND bodegas_servicios_facturacion.Pago_ano=".ano_actual()." LIMIT 1) AS CountFactServicioVent";
		
	}
	
	/*** Devolucion Arriendos ***/
	if($prm_x[19]=='1' or $idTipoUsuario==1) { $subquery .= ",(SELECT COUNT(idFacturacion) FROM bodegas_arriendos_facturacion    INNER JOIN usuarios_bodegas_arriendos ON usuarios_bodegas_arriendos.idBodega = bodegas_arriendos_facturacion.idBodega           WHERE bodegas_arriendos_facturacion.idTipo=2 AND bodegas_arriendos_facturacion.idEstadoDevolucion=1   AND bodegas_arriendos_facturacion.".$x1."   AND bodegas_arriendos_facturacion.Devolucion_Semana=".semana_actual()."   AND bodegas_arriendos_facturacion.Devolucion_ano=".ano_actual()."  AND usuarios_bodegas_arriendos.".$x2." LIMIT 1) AS CountArriendoOut";}
	
	/*** Documentos x Cobrar ***/
	$PermChequesCobrar = $prm_x[25] + $prm_x[26];					
	if($PermChequesCobrar!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idPago) FROM pagos_facturas_clientes    INNER JOIN usuarios_documentos_pago ON usuarios_documentos_pago.idDocPago = pagos_facturas_clientes.idDocPago           WHERE  pagos_facturas_clientes.".$x1."   AND pagos_facturas_clientes.F_Pago_Semana=".semana_actual()."   AND pagos_facturas_clientes.F_Pago_ano=".ano_actual()."  AND pagos_facturas_clientes.".$x2." LIMIT 1) AS CountChequeCobro";
	}
	
	
	/***************************************** TERCERA COLUMNA *****************************************/
	/*** Analisis Maquinas ***/
	$PermAnalisis = $prm_x[6];
	if($PermAnalisis!=0 or $idTipoUsuario==1) {
		$subquery .= ",(SELECT COUNT(idAnalisisAlertas) FROM analisis_listado_alertas WHERE  nivel=1 AND Creacion_mes=".mes_actual()."   AND Creacion_ano=".ano_actual()."  LIMIT 1 ) AS CountAlertaNivel_1";
		$subquery .= ",(SELECT COUNT(idAnalisisAlertas) FROM analisis_listado_alertas WHERE  nivel=2 AND Creacion_mes=".mes_actual()."   AND Creacion_ano=".ano_actual()."  LIMIT 1 ) AS CountAlertaNivel_2";
		$subquery .= ",(SELECT COUNT(idAnalisisAlertas) FROM analisis_listado_alertas WHERE  nivel=3 AND Creacion_mes=".mes_actual()."   AND Creacion_ano=".ano_actual()."  LIMIT 1 ) AS CountAlertaNivel_3";
	}
	
	
	
	
	
}
 

				
/************************************************************************************/
//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$query = "SELECT
core_ubicacion_ciudad.Nombre AS Ciudad, 
core_ubicacion_comunas.Nombre AS Comuna, 
core_ubicacion_comunas.Wheater AS Wheater
".$subquery."

FROM core_sistemas
LEFT JOIN core_ubicacion_ciudad    ON core_ubicacion_ciudad.idCiudad    = core_sistemas.idCiudad
LEFT JOIN core_ubicacion_comunas   ON core_ubicacion_comunas.idComuna   = core_sistemas.idComuna

WHERE core_sistemas.idSistema='".$_SESSION['usuario']['basic_data']['idSistema']."' "; 
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
$subconsulta = mysqli_fetch_assoc($resultado);

/*****************************************************************************************************************/
/*                                         Se arma la interfaz                                                   */
/*****************************************************************************************************************/

//INTERFACES
switch ($n_permisos['idOpcionesGen_7']) {
    //Interfaz Nueva v1
    case 1:
        include '1include_principal_interfaz_1.php';
        break;
    //Interfaz Antigua
    case 2:
        include '1include_principal_interfaz_2.php';
        break;
    //Interfaz Nueva v2
    case 3:
        include '1include_principal_interfaz_3.php';
        break;
}



?>

