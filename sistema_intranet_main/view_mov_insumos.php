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
// Se traen todos los datos de mi usuario
$query = "SELECT 
bodegas_insumos_facturacion.idTipo,
bodegas_insumos_facturacion.idFacturacion,
bodegas_insumos_facturacion.Creacion_fecha,
bodegas_insumos_facturacion.N_Doc,
bodegas_insumos_facturacion.Observaciones,
bodegas_insumos_facturacion.idOcompra,
bodegas_insumos_facturacion.OC_Ventas,
bodegas_insumos_facturacion.idOT,
bodega1.Nombre AS BodegaDesde,
bodega2.Nombre AS BodegaHacia,
bodegas_insumos_facturacion_tipo.Nombre AS TipoDoc,
core_documentos_mercantiles.Nombre AS Documento,
usuarios_listado.Nombre AS NombreUsuario,
bodegas_insumos_facturacion.ValorNeto,
bodegas_insumos_facturacion.ValorNetoImp,
bodegas_insumos_facturacion.Impuesto_01,
bodegas_insumos_facturacion.Impuesto_02,
bodegas_insumos_facturacion.Impuesto_03,
bodegas_insumos_facturacion.Impuesto_04,
bodegas_insumos_facturacion.Impuesto_05,
bodegas_insumos_facturacion.Impuesto_06,
bodegas_insumos_facturacion.Impuesto_07,
bodegas_insumos_facturacion.Impuesto_08,
bodegas_insumos_facturacion.Impuesto_09,
bodegas_insumos_facturacion.Impuesto_10,
bodegas_insumos_facturacion.ValorTotal,


sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

sistema_destino.Nombre AS SistemaDestino,
sistema_destino.Rut AS SistemaDestinoRut,
sis_des_ciudad.Nombre AS SistemaDestinoCiudad,
sis_des_comuna.Nombre AS SistemaDestinoComuna,
sistema_destino.Direccion AS SistemaDestinoDireccion,
sistema_destino.Contacto_Fono1 AS SistemaDestinoFono,
sistema_destino.Contacto_Fax AS SistemaDestinoFax,
sistema_destino.email_principal AS SistemaDestinoEmail,

trabajadores_listado.Nombre AS Nombre_trab,
trabajadores_listado.ApellidoPat AS ApellidoPat_trab,
trabajadores_listado.ApellidoMat AS ApellidoMat_trab,
trabajadores_listado.Cargo AS Cargo_trab,
trabajadores_listado.Fono AS Fono_trab,
trabajadores_listado.Rut AS Rut_trab,
trabajadores_listado_tipos.Nombre AS Tipo_trab,

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

bodegas_insumos_facturacion.idEstado,
core_estado_facturacion.Nombre AS Estado,
bodegas_insumos_facturacion.Pago_fecha,
bodegas_insumos_facturacion.idDocPago,
sistema_documentos_pago.Nombre AS DocPago,
bodegas_insumos_facturacion.N_DocPago,
bodegas_insumos_facturacion.F_Pago,
bodegas_insumos_facturacion.MontoPagado,
usuario_pago.Nombre AS UsuarioPago,

centrocosto_listado.Nombre AS CentroCosto_Nombre,
centrocosto_listado_level_1.Nombre AS CentroCosto_Level_1,
centrocosto_listado_level_2.Nombre AS CentroCosto_Level_2,
centrocosto_listado_level_3.Nombre AS CentroCosto_Level_3,
centrocosto_listado_level_4.Nombre AS CentroCosto_Level_4,
centrocosto_listado_level_5.Nombre AS CentroCosto_Level_5

FROM `bodegas_insumos_facturacion`
LEFT JOIN `bodegas_insumos_listado`       bodega1   ON bodega1.idBodega                             = bodegas_insumos_facturacion.idBodegaOrigen
LEFT JOIN `bodegas_insumos_listado`       bodega2   ON bodega2.idBodega                             = bodegas_insumos_facturacion.idBodegaDestino
LEFT JOIN `bodegas_insumos_facturacion_tipo`        ON bodegas_insumos_facturacion_tipo.idTipo      = bodegas_insumos_facturacion.idTipo
LEFT JOIN `core_documentos_mercantiles`             ON core_documentos_mercantiles.idDocumentos     = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = bodegas_insumos_facturacion.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = bodegas_insumos_facturacion.idSistema
LEFT JOIN `core_sistemas`   sistema_destino         ON sistema_destino.idSistema                    = bodegas_insumos_facturacion.idSistemaDestino
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `core_ubicacion_ciudad`   sis_des_ciudad  ON sis_des_ciudad.idCiudad                      = sistema_destino.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_des_comuna  ON sis_des_comuna.idComuna                      = sistema_destino.idComuna
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador            = bodegas_insumos_facturacion.idTrabajador
LEFT JOIN `trabajadores_listado_tipos`              ON trabajadores_listado_tipos.idTipo            = trabajadores_listado.idTipo
LEFT JOIN `proveedor_listado`                       ON proveedor_listado.idProveedor                = bodegas_insumos_facturacion.idProveedor
LEFT JOIN `clientes_listado`                        ON clientes_listado.idCliente                   = bodegas_insumos_facturacion.idCliente
LEFT JOIN `core_ubicacion_ciudad`    provciudad     ON provciudad.idCiudad                          = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   provcomuna     ON provcomuna.idComuna                          = proveedor_listado.idComuna
LEFT JOIN `core_ubicacion_ciudad`    clienciudad    ON clienciudad.idCiudad                         = clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   cliencomuna    ON cliencomuna.idComuna                         = clientes_listado.idComuna
LEFT JOIN `core_estado_facturacion`                 ON core_estado_facturacion.idEstado             = bodegas_insumos_facturacion.idEstado
LEFT JOIN `sistema_documentos_pago`                 ON sistema_documentos_pago.idDocPago            = bodegas_insumos_facturacion.idDocPago
LEFT JOIN `usuarios_listado`     usuario_pago       ON usuario_pago.idUsuario                       = bodegas_insumos_facturacion.idUsuarioPago
LEFT JOIN `centrocosto_listado`                     ON centrocosto_listado.idCentroCosto            = bodegas_insumos_facturacion.idCentroCosto
LEFT JOIN `centrocosto_listado_level_1`             ON centrocosto_listado_level_1.idLevel_1        = bodegas_insumos_facturacion.idLevel_1
LEFT JOIN `centrocosto_listado_level_2`             ON centrocosto_listado_level_2.idLevel_2        = bodegas_insumos_facturacion.idLevel_2
LEFT JOIN `centrocosto_listado_level_3`             ON centrocosto_listado_level_3.idLevel_3        = bodegas_insumos_facturacion.idLevel_3
LEFT JOIN `centrocosto_listado_level_4`             ON centrocosto_listado_level_4.idLevel_4        = bodegas_insumos_facturacion.idLevel_4
LEFT JOIN `centrocosto_listado_level_5`             ON centrocosto_listado_level_5.idLevel_5        = bodegas_insumos_facturacion.idLevel_5

WHERE bodegas_insumos_facturacion.idFacturacion = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$row_data = mysqli_fetch_assoc ($resultado);

				
// Se trae un listado con todos los productos utilizados
$arrProductos = array();
$query = "SELECT 
insumos_listado.Nombre,
sistema_productos_uml.Nombre AS Unimed,
sistema_productos_uml.Abreviatura AS UnimedAbrev,
bodegas_insumos_facturacion_existencias.Cantidad_ing,
bodegas_insumos_facturacion_existencias.Cantidad_eg,
bodegas_insumos_facturacion_existencias.Valor,
bodegas_insumos_facturacion_existencias.ValorTotal,
insumos_listado.ValorIngreso AS  ValorTraspaso,
bodegas_insumos_listado.Nombre AS NombreBodega
FROM `bodegas_insumos_facturacion_existencias` 
LEFT JOIN `insumos_listado`            ON insumos_listado.idProducto             = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`      ON sistema_productos_uml.idUml            = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_listado`    ON bodegas_insumos_listado.idBodega       = bodegas_insumos_facturacion_existencias.idBodega
WHERE idFacturacion = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}

/*****************************************/		
// Se trae un listado con todos los otros
$arrOtros = array();
$query = "SELECT Nombre, vTotal
FROM `bodegas_insumos_facturacion_otros` 
WHERE idFacturacion = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrOtros,$row );
}

// Se trae un listado con todos los impuestos existentes
$arrDescuentos = array();
$query = "SELECT Nombre, vTotal
FROM `bodegas_insumos_facturacion_descuentos`
WHERE idFacturacion = {$_GET['view']} 
ORDER BY Nombre ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
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
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrImpuestos,$row );
}

// Se trae un listado con todas las guias relacionadas al documento
$arrGuias = array();
$query = "SELECT  N_Doc, ValorNeto
FROM `bodegas_insumos_facturacion`
WHERE idDocumentos = 1 AND DocRel = {$_GET['view']}
ORDER BY N_Doc ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
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
WHERE pagos_facturas_proveedores.idFacturacion = {$_GET['view']} AND idTipo=1
";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
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
WHERE pagos_facturas_clientes.idFacturacion = {$_GET['view']} AND idTipo=1
";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagosClien,$row );
}


/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `bodegas_insumos_facturacion_archivos` 
WHERE idFacturacion = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrArchivo,$row );
}

/*****************************************/		
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT 
bodegas_insumos_facturacion_historial.Creacion_fecha, 
bodegas_insumos_facturacion_historial.Observacion,
core_historial_tipos.Nombre,
core_historial_tipos.FonAwesome,
usuarios_listado.Nombre AS Usuario

FROM `bodegas_insumos_facturacion_historial` 
LEFT JOIN `core_historial_tipos`     ON core_historial_tipos.idTipo   = bodegas_insumos_facturacion_historial.idTipo
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario    = bodegas_insumos_facturacion_historial.idUsuario
WHERE bodegas_insumos_facturacion_historial.idFacturacion = {$_GET['view']} 
ORDER BY bodegas_insumos_facturacion_historial.idHistorial ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
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

FROM `bodegas_insumos_facturacion`
LEFT JOIN `ocompra_listado_documentos`  ON ocompra_listado_documentos.idOcompra   = bodegas_insumos_facturacion.idOcompra
LEFT JOIN `sistema_documentos_pago`     ON sistema_documentos_pago.idDocPago      = ocompra_listado_documentos.idDocPago
WHERE bodegas_insumos_facturacion.idFacturacion = {$_GET['view']} 
ORDER BY sistema_documentos_pago.Nombre ASC, ocompra_listado_documentos.Fpago ASC ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDocRel,$row );
}

// Se trae un listado con todos los usuarios
$arrNotasCredito = array();
$query = "SELECT 
core_documentos_mercantiles.Nombre AS Documento,
bodegas_insumos_facturacion.N_Doc,
bodegas_insumos_facturacion.Creacion_fecha,
bodegas_insumos_facturacion.ValorTotal,
usuarios_listado.Nombre AS Usuario
FROM `bodegas_insumos_facturacion`
LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos     = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`             ON usuarios_listado.idUsuario                   = bodegas_insumos_facturacion.idUsuario
WHERE bodegas_insumos_facturacion.idFacturacionRelacionado = {$_GET['view']}";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
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
										<td class="text-right" style="padding-right: 22px !important;"><?php echo Valores($pagos['MontoPagado'], 0); ?></td>
									</tr>
								<?php } ?> 
								<?php foreach ($arrPagosClien as $pagos) { ?>
									<tr class="odd">
										<td><?php echo $pagos['UsuarioPago']; ?></td>
										<td><?php echo $pagos['Nombre'];if(isset($pagos['N_DocPago'])&&$pagos['N_DocPago']!=''){echo ' Doc N° '.$pagos['N_DocPago'];}?></td>
										<td><?php echo fecha_estandar($pagos['F_Pago']); ?></td>
										<td class="text-right" style="padding-right: 22px !important;"><?php echo Valores($pagos['MontoPagado'], 0); ?></td>
									</tr>
								<?php } ?> 
								<?php foreach ($arrNotasCredito as $doc) { ?>
									<tr class="odd">
										<td><?php echo $doc['Usuario']; ?></td>
										<td><?php echo $doc['Documento'].' '.$doc['N_Doc']; ?></td>
										<td><?php echo Fecha_estandar($doc['Creacion_fecha']); ?></td>
										<td class="text-right" style="padding-right: 22px !important;"><?php echo Valores($doc['ValorTotal'], 0); ?></td>
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
										<td class="text-right"><?php echo Valores($row_data['MontoPagado'], 0) ?></td>
									</tr>
									<tr>
										<th>Monto Facturado:</th>
										<td class="text-right"><?php echo Valores($row_data['ValorTotal'], 0) ?></td>
									</tr>
									<tr>
										<th>Diferencia:</th>
										<?php 
										$diferencia = $row_data['MontoPagado'] - $row_data['ValorTotal'];
										if($diferencia<0){
											echo '<td class="text-right text-danger"><h6><i class="fa fa-arrow-down" aria-hidden="true"></i> '.Valores($diferencia, 0).'</h6></td>';
										}elseif($diferencia>0){
											echo '<td class="text-right text-info"><h6><i class="fa fa-arrow-up" aria-hidden="true"></i> '.Valores($diferencia, 0).'</h6></td>';
										}else{
											echo '<td class="text-right"><h6>Valores OK</h6></td>';
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
				<i class="fa fa-globe"></i> <?php echo $row_data['TipoDoc']?>.
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
						<strong>'.$row_data['NombreProveedor'].'</strong><br>
						'.$row_data['CiudadProveedor'].', '.$row_data['ComunaProveedor'].'<br>
						'.$row_data['DireccionProveedor'].'<br>
						Fono Fijo: '.$row_data['Fono1Proveedor'].'<br>
						Celular: '.$row_data['Fono2Proveedor'].'<br>
						Fax: '.$row_data['FaxProveedor'].'<br>
						Rut: '.$row_data['RutProveedor'].'<br>
						Email: '.$row_data['EmailProveedor'].'<br>
						Contacto: '.$row_data['PersonaContactoProveedor'].'<br>
						Giro de la Empresa: '.$row_data['GiroProveedor'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					<b>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</b><br>
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>';
					
					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
						echo '<b>Estado: </b>'.$row_data['Estado'].'<br>';
					}
					if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
						echo '<b>Vencimiento : </b>'.Fecha_estandar($row_data['Pago_fecha']).'<br>';
					}
					if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
						echo '<b>Dto de Pago : </b>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br>';
					}
					if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
						echo '<b>Fecha Pagado: </b>'.Fecha_estandar($row_data['F_Pago']).'<br>';
					}
					if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){ 
						echo '<b>OC Relacionada : </b>'.N_doc($row_data['idOcompra'], 5).'<br>';
					} 
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
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
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['NombreCliente'].'</strong><br>
						'.$row_data['CiudadCliente'].', '.$row_data['ComunaProveedor'].'<br>
						'.$row_data['DireccionCliente'].'<br>
						Fono Fijo: '.$row_data['Fono1Cliente'].'<br>
						Celular: '.$row_data['Fono2Cliente'].'<br>
						Fax: '.$row_data['FaxCliente'].'<br>
						Rut: '.$row_data['RutCliente'].'<br>
						Email: '.$row_data['EmailCliente'].'<br>
						Contacto: '.$row_data['PersonaContactoCliente'].'<br>
						Giro de la Empresa: '.$row_data['GiroCliente'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					<b>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</b><br>
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Vendedor: </b>'.$row_data['Nombre_trab'].' '.$row_data['ApellidoPat_trab'].'<br>';
					
					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
						echo '<b>Estado: </b>'.$row_data['Estado'].'<br>';
					}
					if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
						echo '<b>Vencimiento : </b>'.Fecha_estandar($row_data['Pago_fecha']).'<br>';
					}
					if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
						echo '<b>Dto de Pago : </b>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br>';
					}
					if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
						echo '<b>Fecha Pagado: </b>'.Fecha_estandar($row_data['F_Pago']).'<br>';
					}
					if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''){ 
						echo '<b>OC Relacionada N°: </b>'.$row_data['OC_Ventas'].'<br>';
					} 
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}	
					
				echo '
				</div>';
				break;
			//Gasto de Productos
			case 3:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					Datos del Trabajador
					<address>
						<strong>'.$row_data['Nombre_trab'].' '.$row_data['ApellidoPat_trab'].' '.$row_data['ApellidoMat_trab'].'</strong><br>
						Rut: '.$row_data['Rut_trab'].'<br>
						Fono: '.$row_data['Fono_trab'].'<br>
						Cargo: '.$row_data['Cargo_trab'].'<br>
						Tipo Cargo: '.$row_data['Tipo_trab'].'
					</address>
				</div>
			 
				<div class="col-sm-4 invoice-col">
					<b>Entrega de insumos a Personal</b><br>
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
				break;
			//Traspaso de Productos entre bodegas
			case 4:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					
				</div>
				
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
				break;
			//Transformacion de Productos
			case 5:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					
				</div>
				
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
				break;
			//Transpaso insumos a otra bodega
			case 6:
				echo '	
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['SistemaDestino'].'</strong><br>
						'.$row_data['SistemaDestinoCiudad'].' '.$row_data['SistemaDestinoComuna'].'<br>
						'.$row_data['SistemaDestinoDireccion'].'<br>
						Fono: '.$row_data['SistemaDestinoFono'].'<br>
						Fax: '.$row_data['SistemaDestinoFax'].'<br>
						Rut: '.$row_data['SistemaDestinoRut'].'<br>
						Email: '.$row_data['SistemaDestinoEmail'].'
					</address>
				</div>
			 
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega de destino:</b> '.$row_data['BodegaHacia'].'<br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
				break;
        
			//Gasto de Productos en una Orden de Trabajo	
			case 7:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					
				</div>
				
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega utilizada:</b> '.$row_data['BodegaDesde'].'<br>
					<b>Orden de Trabajo N°:</b> '.N_doc($row_data['idOT'], 5).'<br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
				break;
				
			//Traspaso Manual de Insumos a otra Empresa
			case 8:
				echo '	
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['SistemaDestino'].'</strong><br>
						'.$row_data['SistemaDestinoCiudad'].' '.$row_data['SistemaDestinoComuna'].'<br>
						'.$row_data['SistemaDestinoDireccion'].'<br>
						Fono: '.$row_data['SistemaDestinoFono'].'<br>
						Fax: '.$row_data['SistemaDestinoFax'].'<br>
						Rut: '.$row_data['SistemaDestinoRut'].'<br>
						Email: '.$row_data['SistemaDestinoEmail'].'
					</address>
				</div>
			 
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
				break;
				
			//Ingreso manual de insumos
			case 9:
				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['NombreProveedor'].'</strong><br>
						'.$row_data['CiudadProveedor'].', '.$row_data['ComunaProveedor'].'<br>
						'.$row_data['DireccionProveedor'].'<br>
						Fono Fijo: '.$row_data['Fono1Proveedor'].'<br>
						Celular: '.$row_data['Fono2Proveedor'].'<br>
						Fax: '.$row_data['FaxProveedor'].'<br>
						Rut: '.$row_data['RutProveedor'].'<br>
						Email: '.$row_data['EmailProveedor'].'<br>
						Contacto: '.$row_data['PersonaContactoProveedor'].'<br>
						Giro de la Empresa: '.$row_data['GiroProveedor'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){ 
						echo '<b>Centro de Costo : </b>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){echo ' - '.$row_data['CentroCosto_Level_1']; }
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){echo ' - '.$row_data['CentroCosto_Level_2']; }
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){echo ' - '.$row_data['CentroCosto_Level_3']; }
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){echo ' - '.$row_data['CentroCosto_Level_4']; }
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){echo ' - '.$row_data['CentroCosto_Level_5']; }
						echo '<br>';
					}
				echo '</div>';
	
				break;
		}?>
		
		
		
    
	</div>
	
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Detalle</th>
						<th>Ingreso</th>
						<th>Egreso</th>
						<th>Valor</th>
						<th align="right">Valor Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrProductos) { ?>
						<tr class="active"><td colspan="5"><strong>Productos</strong></td></tr>
						<?php foreach ($arrProductos as $prod) { ?>
							<tr>
								<td><?php echo '<strong>'.$prod['NombreBodega'].'</strong> - '.$prod['Nombre'];?></td>
								<?php
								//Verifico la existencia de la abreviatura de la unidad de medida
								if(isset($prod['UnimedAbrev'])&&$prod['UnimedAbrev']!=''){
									$prodUnimed = $prod['UnimedAbrev'];
								}else{
									$prodUnimed = $prod['Unimed'];
								} 
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									echo '<td align="right">'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prodUnimed.'</td>';
									echo '<td align="right"></td>';
								} 
								if(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									echo '<td align="right"></td>';
									echo '<td align="right">'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prodUnimed.'</td>';
								}?>
								<td align="right"><?php echo Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prodUnimed;?></td>
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
	//Gasto de Productos
	if($row_data['idTipo']==3){?>
		<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Emisor</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Trabajador</p></div> 
		</div>
	<?php } ?>
	
	<?php 
	//Traspaso de Productos a otra Empresa
	if($row_data['idTipo']==6){?>
		<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Transportista</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Receptor</p></div> 
		</div>
	<?php } ?>


<?php
	$zz  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&view='.$_GET['view'];
	?>
	<div class="row no-print">
		<div class="col-xs-12">
			<a target="new" href="view_mov_insumos_to_print.php<?php echo $zz ?>" class="btn btn-default">
				<i class="fa fa-print"></i> Imprimir
			</a>

			<a target="new" href="view_mov_insumos_to_pdf.php<?php echo $zz ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
				<i class="fa fa-file-pdf-o"></i> Exportar a PDF
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
								<a href="<?php echo 'view_doc_preview.php?return=true&path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<a href="1download.php?dir=upload&file=<?php echo $producto['Nombre']; ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
    <?php } ?>
    
</div>



<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
 
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
