<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT 
bodegas_arriendos_facturacion.idTipo,
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.Devolucion_fecha,
bodegas_arriendos_facturacion.N_Doc,
bodegas_arriendos_facturacion.Observaciones,
bodegas_arriendos_facturacion.idOcompra,
bodegas_arriendos_facturacion.OC_Ventas,
bodegas_arriendos_facturacion_tipo.Nombre AS TipoDoc,
core_documentos_mercantiles.Nombre AS Documento,
usuarios_listado.Nombre AS NombreUsuario,
bodegas_arriendos_facturacion.ValorNeto,
bodegas_arriendos_facturacion.ValorNetoImp,
bodegas_arriendos_facturacion.Impuesto_01,
bodegas_arriendos_facturacion.Impuesto_02,
bodegas_arriendos_facturacion.Impuesto_03,
bodegas_arriendos_facturacion.Impuesto_04,
bodegas_arriendos_facturacion.Impuesto_05,
bodegas_arriendos_facturacion.Impuesto_06,
bodegas_arriendos_facturacion.Impuesto_07,
bodegas_arriendos_facturacion.Impuesto_08,
bodegas_arriendos_facturacion.Impuesto_09,
bodegas_arriendos_facturacion.Impuesto_10,
bodegas_arriendos_facturacion.ValorTotal,
bodegas_arriendos_facturacion.fecha_fact_desde,
bodegas_arriendos_facturacion.fecha_fact_hasta,
bodegas_arriendos_facturacion.idUsoIVA,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

proveedor_listado.Nombre AS NombreProveedor,
proveedor_listado.email AS EmailProveedor,
proveedor_listado.Rut AS RutProveedor,
provciudad.Nombre AS CiudadProveedor,
provcomuna.Nombre AS ComunaProveedor,
proveedor_listado.Direccion AS DireccionProveedor,
proveedor_listado.Fono1 AS Fono1Proveedor,
proveedor_listado.Fono2 AS Fono2Proveedor,
proveedor_listado.Fax AS FaxProveedor,
proveedor_listado.PersonaContacto AS PersonaContactoProveedor,
proveedor_listado.Giro AS GiroProveedor,

bodegas_arriendos_facturacion.idEstado,
core_estado_facturacion.Nombre AS Estado,
bodegas_arriendos_facturacion.Pago_fecha,
bodegas_arriendos_facturacion.idDocPago,
sistema_documentos_pago.Nombre AS DocPago,
bodegas_arriendos_facturacion.N_DocPago,
bodegas_arriendos_facturacion.F_Pago,
bodegas_arriendos_facturacion.MontoPagado,
usuario_pago.Nombre AS UsuarioPago,

clientes_listado.Nombre AS NombreCliente,
clientes_listado.email AS EmailCliente,
clientes_listado.Rut AS RutCliente,
clienciudad.Nombre AS CiudadCliente,
cliencomuna.Nombre AS ComunaCliente,
clientes_listado.Direccion AS DireccionCliente,
clientes_listado.Fono1 AS Fono1Cliente,
clientes_listado.Fono2 AS Fono2Cliente,
clientes_listado.Fax AS FaxCliente,
clientes_listado.PersonaContacto AS PersonaContactoCliente,
clientes_listado.Giro AS GiroCliente,

trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellido,

bodegas_arriendos_facturacion.idEstadoDevolucion,
core_estado_devolucion.Nombre AS Devolucion_Estado,
usuario_devolucion.Nombre AS Devolucion_Usuario,
bodegas_arriendos_facturacion.FechaDevolucionReal AS Devolucion_FechaReal,

centrocosto_listado.Nombre AS CentroCosto_Nombre,
centrocosto_listado_level_1.Nombre AS CentroCosto_Level_1,
centrocosto_listado_level_2.Nombre AS CentroCosto_Level_2,
centrocosto_listado_level_3.Nombre AS CentroCosto_Level_3,
centrocosto_listado_level_4.Nombre AS CentroCosto_Level_4,
centrocosto_listado_level_5.Nombre AS CentroCosto_Level_5

FROM `bodegas_arriendos_facturacion`
LEFT JOIN `bodegas_arriendos_facturacion_tipo`      ON bodegas_arriendos_facturacion_tipo.idTipo    = bodegas_arriendos_facturacion.idTipo
LEFT JOIN `core_documentos_mercantiles`             ON core_documentos_mercantiles.idDocumentos     = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = bodegas_arriendos_facturacion.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = bodegas_arriendos_facturacion.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `proveedor_listado`                       ON proveedor_listado.idProveedor                = bodegas_arriendos_facturacion.idProveedor
LEFT JOIN `core_ubicacion_ciudad`    provciudad     ON provciudad.idCiudad                          = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   provcomuna     ON provcomuna.idComuna                          = proveedor_listado.idComuna
LEFT JOIN `core_estado_facturacion`                 ON core_estado_facturacion.idEstado             = bodegas_arriendos_facturacion.idEstado
LEFT JOIN `sistema_documentos_pago`                 ON sistema_documentos_pago.idDocPago            = bodegas_arriendos_facturacion.idDocPago
LEFT JOIN `clientes_listado`                        ON clientes_listado.idCliente                   = bodegas_arriendos_facturacion.idCliente
LEFT JOIN `core_ubicacion_ciudad`    clienciudad    ON clienciudad.idCiudad                         = clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   cliencomuna    ON cliencomuna.idComuna                         = clientes_listado.idComuna
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador            = bodegas_arriendos_facturacion.idTrabajador
LEFT JOIN `usuarios_listado`     usuario_pago       ON usuario_pago.idUsuario                       = bodegas_arriendos_facturacion.idUsuarioPago
LEFT JOIN `core_estado_devolucion`                  ON core_estado_devolucion.idEstadoDevolucion    = bodegas_arriendos_facturacion.idEstadoDevolucion
LEFT JOIN `usuarios_listado`   usuario_devolucion   ON usuario_devolucion.idUsuario                 = bodegas_arriendos_facturacion.idUsuarioDevolucion
LEFT JOIN `centrocosto_listado`                     ON centrocosto_listado.idCentroCosto            = bodegas_arriendos_facturacion.idCentroCosto
LEFT JOIN `centrocosto_listado_level_1`             ON centrocosto_listado_level_1.idLevel_1        = bodegas_arriendos_facturacion.idLevel_1
LEFT JOIN `centrocosto_listado_level_2`             ON centrocosto_listado_level_2.idLevel_2        = bodegas_arriendos_facturacion.idLevel_2
LEFT JOIN `centrocosto_listado_level_3`             ON centrocosto_listado_level_3.idLevel_3        = bodegas_arriendos_facturacion.idLevel_3
LEFT JOIN `centrocosto_listado_level_4`             ON centrocosto_listado_level_4.idLevel_4        = bodegas_arriendos_facturacion.idLevel_4
LEFT JOIN `centrocosto_listado_level_5`             ON centrocosto_listado_level_5.idLevel_5        = bodegas_arriendos_facturacion.idLevel_5

WHERE idFacturacion = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
	
}
$row_data = mysqli_fetch_assoc ($resultado);


				
// Se trae un listado con todos los productos utilizados
$arrArriendos = array();
$query = "SELECT 
equipos_arriendo_listado.Nombre,
bodegas_arriendos_facturacion_existencias.Cantidad_ing,
bodegas_arriendos_facturacion_existencias.Cantidad_eg,
bodegas_arriendos_facturacion_existencias.Valor,
bodegas_arriendos_facturacion_existencias.ValorTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `bodegas_arriendos_facturacion_existencias` 
LEFT JOIN `equipos_arriendo_listado`   ON equipos_arriendo_listado.idEquipo      = bodegas_arriendos_facturacion_existencias.idEquipo
LEFT JOIN `core_tiempo_frecuencia`     ON core_tiempo_frecuencia.idFrecuencia    = bodegas_arriendos_facturacion_existencias.idFrecuencia
WHERE bodegas_arriendos_facturacion_existencias.idFacturacion = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrArriendos,$row );
}

/*****************************************/		
// Se trae un listado con todos los otros
$arrOtros = array();
$query = "SELECT Nombre, vTotal
FROM `bodegas_arriendos_facturacion_otros` 
WHERE idFacturacion = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrOtros,$row );
}


// Se trae un listado con todos los impuestos existentes
$arrDescuentos = array();
$query = "SELECT Nombre, vTotal
FROM `bodegas_arriendos_facturacion_descuentos`
WHERE idFacturacion = ".$X_Puntero." 
ORDER BY Nombre ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDescuentos,$row );
}

// Se trae un listado con todos los impuestos existentes
$arrImpuestos = array();
$query = "SELECT Nombre, Porcentaje
FROM `sistema_impuestos`
ORDER BY idImpuesto ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrImpuestos,$row );
}

// Se trae un listado con todas las guias relacionadas al documento
$arrGuias = array();
$query = "SELECT  N_Doc, ValorNeto
FROM `bodegas_arriendos_facturacion`
WHERE idDocumentos = 1 AND DocRel = ".$X_Puntero."
ORDER BY N_Doc ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGuias,$row );
}



// Se trae un listado con todos los usuarios
$arrPagosProv = array();
$query = "SELECT 
sistema_documentos_pago.Nombre,
pagos_facturas_proveedores.N_DocPago,
pagos_facturas_proveedores.F_Pago,
pagos_facturas_proveedores.MontoPagado,
usuarios_listado.Nombre AS UsuarioPago

FROM `pagos_facturas_proveedores`
LEFT JOIN `sistema_documentos_pago`    ON sistema_documentos_pago.idDocPago    = pagos_facturas_proveedores.idDocPago
LEFT JOIN `usuarios_listado`           ON usuarios_listado.idUsuario           = pagos_facturas_proveedores.idUsuario
WHERE pagos_facturas_proveedores.idFacturacion = ".$X_Puntero." AND idTipo=4
";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagosProv,$row );
}

// Se trae un listado con todos los usuarios
$arrPagosClien = array();
$query = "SELECT 
sistema_documentos_pago.Nombre,
pagos_facturas_clientes.N_DocPago,
pagos_facturas_clientes.F_Pago,
pagos_facturas_clientes.MontoPagado,
usuarios_listado.Nombre AS UsuarioPago

FROM `pagos_facturas_clientes`
LEFT JOIN `sistema_documentos_pago`    ON sistema_documentos_pago.idDocPago    = pagos_facturas_clientes.idDocPago
LEFT JOIN `usuarios_listado`           ON usuarios_listado.idUsuario           = pagos_facturas_clientes.idUsuario
WHERE pagos_facturas_clientes.idFacturacion = ".$X_Puntero." AND idTipo=4
";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagosClien,$row );
}

/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `bodegas_arriendos_facturacion_archivos` 
WHERE idFacturacion = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrArchivo,$row );
}

/*****************************************/		
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT 
bodegas_arriendos_facturacion_historial.Creacion_fecha, 
bodegas_arriendos_facturacion_historial.Observacion,
core_historial_tipos.Nombre,
core_historial_tipos.FonAwesome,
usuarios_listado.Nombre AS Usuario

FROM `bodegas_arriendos_facturacion_historial` 
LEFT JOIN `core_historial_tipos`     ON core_historial_tipos.idTipo   = bodegas_arriendos_facturacion_historial.idTipo
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario    = bodegas_arriendos_facturacion_historial.idUsuario
WHERE bodegas_arriendos_facturacion_historial.idFacturacion = ".$X_Puntero." 
ORDER BY bodegas_arriendos_facturacion_historial.idHistorial ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrHistorial,$row );
}

// Se trae un listado con todos los documentos relacionados a una orden de compra
$arrDocRel = array();
$query = "SELECT 
ocompra_listado_documentos.NDocPago AS Documento_numero,
ocompra_listado_documentos.Fpago AS Documento_fechapago,
ocompra_listado_documentos.vTotal AS Documento_valor,
sistema_documentos_pago.Nombre AS Documento_pago

FROM `bodegas_arriendos_facturacion`
LEFT JOIN `ocompra_listado_documentos`  ON ocompra_listado_documentos.idOcompra   = bodegas_arriendos_facturacion.idOcompra
LEFT JOIN `sistema_documentos_pago`     ON sistema_documentos_pago.idDocPago      = ocompra_listado_documentos.idDocPago
WHERE bodegas_arriendos_facturacion.idFacturacion = ".$X_Puntero." 
ORDER BY sistema_documentos_pago.Nombre ASC, ocompra_listado_documentos.Fpago ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDocRel,$row );
}

// Se trae un listado con todos los usuarios
$arrNotasCredito = array();
$query = "SELECT 
core_documentos_mercantiles.Nombre AS Documento,
bodegas_arriendos_facturacion.N_Doc,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.ValorTotal,
usuarios_listado.Nombre AS Usuario
FROM `bodegas_arriendos_facturacion`
LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos     = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`             ON usuarios_listado.idUsuario                   = bodegas_arriendos_facturacion.idUsuario
WHERE bodegas_arriendos_facturacion.idFacturacionRelacionado = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrNotasCredito,$row );
}


					
//Si el documento esta pagado se muestran los datos relacionados al pago
if($row_data['MontoPagado']!=0){?>
	<div class="" style="margin-top:10px;">
		<div class="col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="fa fa-usd" aria-hidden="true"></i> Pagos Relacionados</h6>
				</div>
				<div class="panel-body">
					<div class="row invoice-payment">
						<table class="table">
							<thead>
								<tr role="row">
									<th>Encargado</th>
									<th>Documento</th>
									<th>Fecha Documento</th> 
									<th>Monto</th>
								</tr>
							</thead>			  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrPagosProv as $pagos) { ?>
									<tr class="odd">
										<td><?php echo $pagos['UsuarioPago']; ?></td>
										<td><?php echo $pagos['Nombre'];if(isset($pagos['N_DocPago'])&&$pagos['N_DocPago']!=''){echo ' Doc N° '.$pagos['N_DocPago'];}?></td>
										<td><?php echo fecha_estandar($pagos['F_Pago']); ?></td>
										<td align="right" style="padding-right: 22px !important;"><?php echo Valores($pagos['MontoPagado'], 0); ?></td>
									</tr>
								<?php } ?> 
								<?php foreach ($arrPagosClien as $pagos) { ?>
									<tr class="odd">
										<td><?php echo $pagos['UsuarioPago']; ?></td>
										<td><?php echo $pagos['Nombre']; if(isset($pagos['N_DocPago'])&&$pagos['N_DocPago']!=''){ echo ' Doc N° '.$pagos['N_DocPago']; }?></td>
										<td><?php echo fecha_estandar($pagos['F_Pago']); ?></td>
										<td align="right" style="padding-right: 22px !important;"><?php echo Valores($pagos['MontoPagado'], 0); ?></td>
									</tr>
								<?php } ?>  
								<?php foreach ($arrNotasCredito as $doc) { ?>
									<tr class="odd">
										<td><?php echo $doc['Usuario']; ?></td>
										<td><?php echo $doc['Documento'].' '.$doc['N_Doc']; ?></td>
										<td><?php echo Fecha_estandar($doc['Creacion_fecha']); ?></td>
										<td align="right" style="padding-right: 22px !important;"><?php echo Valores($doc['ValorTotal'], 0); ?></td>
									</tr>
								<?php } ?>                 
							</tbody>
						</table>
					</div>
						
					<div class="row invoice-payment">
						<div class="col-sm-8"></div>
						<div class="col-sm-4">
							<table class="table">
								<tbody>
									<tr>
										<th>Monto Abonado:</th>
										<td align="right"><?php echo Valores($row_data['MontoPagado'], 0) ?></td>
									</tr>
									<tr>
										<th>Monto Facturado:</th>
										<td align="right"><?php echo Valores($row_data['ValorTotal'], 0) ?></td>
									</tr>
									<tr>
										<th>Diferencia:</th>
										<?php 
										$diferencia = $row_data['MontoPagado'] - $row_data['ValorTotal'];
										if($diferencia<0){
											echo '<td align="right" class="text-danger"><h6><i class="fa fa-arrow-down" aria-hidden="true"></i> '.Valores($diferencia, 0).'</h6></td>';
										}elseif($diferencia>0){
											echo '<td align="right" class="text-info"><h6><i class="fa fa-arrow-up" aria-hidden="true"></i> '.Valores($diferencia, 0).'</h6></td>';
										}else{
											echo '<td align="right"><h6>Valores OK</h6></td>';
										}
										?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
						
				</div>
			</div>
		</div>
	</div>
<?php } ?>	
<?php if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=0){?>
	<div class="" style="margin-top:10px;">
		<div class="col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="fa fa-usd" aria-hidden="true"></i> Documentos de Pago relacionados a la OC N° <?php echo N_doc($row_data['idOcompra'], 5); ?></h6>
				</div>
				<div class="panel-body">
					<div class="row invoice-payment">
						<table class="table">
							<thead>
								<tr role="row">
									<th>Documento</th>
									<th width="120">Fecha</th>
									<th width="120">Valor</th>
								</tr>
							</thead>			  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrDocRel as $doc) { ?>
									<tr class="odd">
										<td><?php echo $doc['Documento_pago'].' '.$doc['Documento_numero']; ?></td>
										<td><?php echo Fecha_estandar($doc['Documento_fechapago']); ?></td>
										<td><?php echo Valores($doc['Documento_valor'], 0); ?></td>
									</tr>
								<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<div class="clearfix"></div>

<section class="invoice">


	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> <?php echo $row_data['TipoDoc']?>.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['Creacion_fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php
		//se verifica el tipo de movimiento
		switch ($row_data['idTipo']) {
			//Ingreso de Productos a bodega
			case 1:
			case 10:
			case 11:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['NombreProveedor'].'</strong><br/>
						'.$row_data['CiudadProveedor'].', '.$row_data['ComunaProveedor'].'<br/>
						'.$row_data['DireccionProveedor'].'<br/>
						Fono Fijo: '.$row_data['Fono1Proveedor'].'<br/>
						Celular: '.$row_data['Fono2Proveedor'].'<br/>
						Fax: '.$row_data['FaxProveedor'].'<br/>
						Rut: '.$row_data['RutProveedor'].'<br/>
						Email: '.$row_data['EmailProveedor'].'<br/>
						Contacto: '.$row_data['PersonaContactoProveedor'].'<br/>
						Giro de la Empresa: '.$row_data['GiroProveedor'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						'.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono: '.$row_data['SistemaOrigenFono'].'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					<strong>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</strong><br/>
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>';
					
					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
						echo '<strong>Estado: </strong>'.$row_data['Estado'].'<br/>';
					}
					if(isset($row_data['Devolucion_fecha'])&&$row_data['Devolucion_fecha']!=''&&$row_data['Devolucion_fecha']!='0000-00-00'){ 
						echo '<strong>Fecha Devolucion : </strong>'.Fecha_estandar($row_data['Devolucion_fecha']).'<br/>';
					}
					if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
						echo '<strong>Vencimiento : </strong>'.Fecha_estandar($row_data['Pago_fecha']).'<br/>';
					}
					/*if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
						echo '<strong>Dto de Pago : </strong>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br/>';
					}
					if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
						echo '<strong>Fecha Pagado: </strong>'.Fecha_estandar($row_data['F_Pago']).'<br/>';
					} */
					if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==1){ 
						echo '<strong>Estado Devolucion : </strong>'.$row_data['Devolucion_Estado'].'<br/>';
					}
					if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==2){ 
						echo '<strong>Estado Devolucion : </strong>'.$row_data['Devolucion_Estado'].'<br/>';
						echo '<strong>Usuario Devolucion : </strong>'.$row_data['Devolucion_Usuario'].'<br/>';
						echo '<strong>Fecha Real Devolucion : </strong>'.Fecha_estandar($row_data['Devolucion_FechaReal']).'<br/>';
					}
					if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){ 
						echo '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['idOcompra'], 5).'<br/>';
					}
					if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''&&$row_data['OC_Ventas']!=0){ 
						echo '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['OC_Ventas'], 5).'<br/>';
					} 
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br/>';
					}	
					if(isset($row_data['fecha_fact_desde'])&&$row_data['fecha_fact_desde']!=''&&$row_data['fecha_fact_desde']!='0000-00-00'){ 
						echo '<strong>Facturacion Desde : </strong>'.Fecha_estandar($row_data['fecha_fact_desde']).'<br/>';
					}
					if(isset($row_data['fecha_fact_hasta'])&&$row_data['fecha_fact_hasta']!=''&&$row_data['fecha_fact_hasta']!='0000-00-00'){ 
						echo '<strong>Facturacion Hasta : </strong>'.Fecha_estandar($row_data['fecha_fact_hasta']).'<br/>';
					}
					if(isset($row_data['idUsoIVA'])&&$row_data['idUsoIVA']!=''&&$row_data['idUsoIVA']==1){ 
						echo '<strong>Exento de IVA : </strong>Factura exenta de IVA<br/>';
					} 
					
				echo '</div>';

				break;
			//Egreso de Productos de bodega
			case 2:
			case 12:
			case 13:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						'.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono: '.$row_data['SistemaOrigenFono'].'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['NombreCliente'].'</strong><br/>
						'.$row_data['CiudadCliente'].', '.$row_data['ComunaProveedor'].'<br/>
						'.$row_data['DireccionCliente'].'<br/>
						Fono Fijo: '.$row_data['Fono1Cliente'].'<br/>
						Celular: '.$row_data['Fono2Cliente'].'<br/>
						Fax: '.$row_data['FaxCliente'].'<br/>
						Rut: '.$row_data['RutCliente'].'<br/>
						Email: '.$row_data['EmailCliente'].'<br/>
						Contacto: '.$row_data['PersonaContactoCliente'].'<br/>
						Giro de la Empresa: '.$row_data['GiroCliente'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					<strong>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</strong><br/>
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Vendedor: </strong>'.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellido'].'<br/>';
					
					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
						echo '<strong>Estado: </strong>'.$row_data['Estado'].'<br/>';
					}
					if(isset($row_data['Devolucion_fecha'])&&$row_data['Devolucion_fecha']!=''&&$row_data['Devolucion_fecha']!='0000-00-00'){ 
						echo '<strong>Fecha Devolucion : </strong>'.Fecha_estandar($row_data['Devolucion_fecha']).'<br/>';
					}
					if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
						echo '<strong>Vencimiento : </strong>'.Fecha_estandar($row_data['Pago_fecha']).'<br/>';
					}
					if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
						echo '<strong>Dto de Pago : </strong>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br/>';
					}
					if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
						echo '<strong>Fecha Pagado: </strong>'.Fecha_estandar($row_data['F_Pago']).'<br/>';
					} 
					if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==1){ 
						echo '<strong>Estado Devolucion : </strong>'.$row_data['Devolucion_Estado'].'<br/>';
					}
					if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==2){ 
						echo '<strong>Estado Devolucion : </strong>'.$row_data['Devolucion_Estado'].'<br/>';
						echo '<strong>Usuario Devolucion : </strong>'.$row_data['Devolucion_Usuario'].'<br/>';
						echo '<strong>Fecha Real Devolucion : </strong>'.Fecha_estandar($row_data['Devolucion_FechaReal']).'<br/>';
					}
					if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){ 	
						echo '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['idOcompra'], 5).'<br/>';
					} 
					if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''&&$row_data['OC_Ventas']!=0){ 
						echo '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['OC_Ventas'], 5).'<br/>';
					}
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br/>';
					}
					if(isset($row_data['fecha_fact_desde'])&&$row_data['fecha_fact_desde']!=''&&$row_data['fecha_fact_desde']!='0000-00-00'){ 
						echo '<strong>Facturacion Desde : </strong>'.Fecha_estandar($row_data['fecha_fact_desde']).'<br/>';
					}
					if(isset($row_data['fecha_fact_hasta'])&&$row_data['fecha_fact_hasta']!=''&&$row_data['fecha_fact_hasta']!='0000-00-00'){ 
						echo '<strong>Facturacion Hasta : </strong>'.Fecha_estandar($row_data['fecha_fact_hasta']).'<br/>';
					}
					if(isset($row_data['idUsoIVA'])&&$row_data['idUsoIVA']!=''&&$row_data['idUsoIVA']==1){ 
						echo '<strong>Exento de IVA : </strong>Factura exenta de IVA<br/>';
					} 	
						
					echo '
				</div>';
				
				break;
		}?>
		
		
		
    
	</div>
	
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">Detalle</th>
						<th width="160" align="right">Valor Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrArriendos) { ?>
						<tr class="active"><td colspan="5"><strong>Equipos</strong></td></tr>
						<?php foreach ($arrArriendos as $prod) { ?>
							<tr>
								<td colspan="2"><?php echo $prod['Nombre'];?></td>
								<?php if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){ ?>
									<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prod['Frecuencia'];?></td>
								<?php }elseif(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){ ?>
									<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prod['Frecuencia'];?></td>
								<?php } ?>
								<td align="right"><?php echo Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prod['Frecuencia'];?></td>
								<td align="right"><?php echo Valores(Cantidades_decimales_justos($prod['ValorTotal']), 0);?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrGuias) { ?>
						<tr class="active"><td colspan="5"><strong>Guias de Despacho</strong></td></tr>
						<?php foreach ($arrGuias as $guia) { ?>
							<tr>
								<td colspan="4"><?php echo 'Guia de Despacho N°'.$guia['N_Doc'];?></td>
								<td align="right"><?php echo Valores($guia['ValorNeto'], 0);?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrOtros) { ?>
						<tr class="active"><td colspan="5"><strong>Otros</strong></td></tr>
						<?php foreach ($arrOtros as $otro) { ?>
							<tr>
								<td colspan="4"><?php echo $otro['Nombre'];?></td>
								<td align="right"><?php echo Valores($otro['vTotal'], 0);?></td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			<table class="table">
				<tbody>	
					<?php
					//Recorro y guard el nombre de los impuestos 
					$nn = 0;
					$impuestos = array();
					foreach ($arrImpuestos as $impto) { 
						$impuestos[$nn]['nimp'] = $impto['Nombre'].' ('.Cantidades_decimales_justos($impto['Porcentaje']).'%)';
						$nn++;
					}?>
					<?php if(isset($row_data['ValorNeto'])&&$row_data['ValorNeto']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Subtotal</strong></td> 
							<td width="160" align="right"><?php echo Valores($row_data['ValorNeto'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php foreach ($arrDescuentos as $descuentos) { ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo 'Descuento: '.$descuentos['Nombre']?></strong></td> 
							<td width="160" align="right"><?php echo Valores($descuentos['vTotal'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['ValorNetoImp'])&&$row_data['ValorNetoImp']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Neto Imponible</strong></td> 
							<td width="160" align="right"><?php echo Valores($row_data['ValorNetoImp'], 0); ?></td>
						</tr>
					<?php } ?>
					
					<?php if(isset($row_data['Impuesto_01'])&&$row_data['Impuesto_01']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[0]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_01'], 0); ?></td>
						</tr>
					<?php } ?>
					
					<?php if(isset($row_data['Impuesto_02'])&&$row_data['Impuesto_02']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[1]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_02'], 0); ?></td>
						</tr>
					<?php } ?>
					
					<?php if(isset($row_data['Impuesto_03'])&&$row_data['Impuesto_03']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[2]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_03'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_04'])&&$row_data['Impuesto_04']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[3]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_04'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_05'])&&$row_data['Impuesto_05']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[4]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_05'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_06'])&&$row_data['Impuesto_06']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[5]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_06'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_07'])&&$row_data['Impuesto_07']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[6]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_07'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_08'])&&$row_data['Impuesto_08']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[7]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_08'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_09'])&&$row_data['Impuesto_09']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[8]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_09'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_10'])&&$row_data['Impuesto_10']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[9]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_10'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['ValorTotal'])&&$row_data['ValorTotal']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Total</strong></td> 
							<td align="right"><?php echo Valores($row_data['ValorTotal'], 0); ?></td>
						</tr>
					<?php } ?>
				
				</tbody>
			</table>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Observaciones'];?></p>
		</div>
	</div>
	
	<?php
	//Traspaso de Productos a otra Empresa
	if($row_data['idTipo']==6){?>
		
		<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Transportista</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Receptor</p></div> 
		</div>
		
	<?php } ?>
	

<?php
	$zz  = '?idSistema='.simpleEncode($_SESSION['usuario']['basic_data']['idSistema'], fecha_actual());
	$zz .= '&view='.$_GET['view'];
	?>
	<div class="row no-print">
		<div class="col-xs-12">
			<a target="new" href="view_mov_arriendos_to_print.php<?php echo $zz ?>" class="btn btn-default">
				<i class="fa fa-print" aria-hidden="true"></i> Imprimir
			</a>

			<a target="new" href="view_mov_arriendos_to_pdf.php<?php echo $zz ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
				<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF
			</a>
		</div>
	</div>
      
</section>

<div class="col-xs-12" style="margin-bottom:15px;">
	
	<?php if ($arrHistorial){ ?>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="3">Historial</th>
				</tr>
				<tr>
					<th width="160">Fecha</th>
					<th>Usuario</th>
					<th>Observacion</th>
				</tr>			  
				<?php foreach ($arrHistorial as $doc){?>
					<tr class="item-row">
						<td><?php echo fecha_estandar($doc['Creacion_fecha']); ?></td>
						<td><?php echo $doc['Usuario']; ?></td>
						<td><?php echo '<i class="'.$doc['FonAwesome'].'" aria-hidden="true"></i> '.$doc['Observacion']; ?></td>
					</tr> 
				 <?php } ?>
			</tbody>
		</table>
	<?php } ?>

	<?php if ($arrArchivo){ ?>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<tr>
					<th colspan="6">Archivos Adjuntos</th>
				</tr>		  
				<?php foreach ($arrArchivo as $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $producto['Nombre']; ?></td>
						<td width="160">
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Documento" class="btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="1download.php?dir=<?php echo simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()); ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
    <?php } ?>
    
</div>
 
<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
