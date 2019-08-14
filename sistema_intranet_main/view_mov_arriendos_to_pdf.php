<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.PDF.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//Se buscan la imagen i el tipo de PDF
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
	//Consulta
	$query = "SELECT Config_imgLogo, idOpcionesGen_5	
	FROM `core_sistemas` 
	WHERE idSistema = '{$_GET['idSistema']}'  ";
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
	$rowEmpresa = mysqli_fetch_array ($resultado);
}
/********************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT 
bodegas_arriendos_facturacion.idTipo,
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
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

core_estado_facturacion.Nombre AS Estado,
bodegas_arriendos_facturacion.Pago_fecha,
sistema_documentos_pago.Nombre AS DocPago,
bodegas_arriendos_facturacion.N_DocPago,
bodegas_arriendos_facturacion.F_Pago,

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
bodegas_arriendos_facturacion.FechaDevolucionReal AS Devolucion_FechaReal

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
LEFT JOIN `core_estado_devolucion`                  ON core_estado_devolucion.idEstadoDevolucion    = bodegas_arriendos_facturacion.idEstadoDevolucion
LEFT JOIN `usuarios_listado`   usuario_devolucion   ON usuario_devolucion.idUsuario                 = bodegas_arriendos_facturacion.idUsuarioDevolucion

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
WHERE bodegas_arriendos_facturacion_existencias.idFacturacion = {$_GET['view']} ";
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
array_push( $arrArriendos,$row );
}

/*****************************************/		
// Se trae un listado con todos los otros
$arrOtros = array();
$query = "SELECT Nombre, vTotal
FROM `bodegas_arriendos_facturacion_otros` 
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
FROM `bodegas_arriendos_facturacion_descuentos`
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
FROM `bodegas_arriendos_facturacion`
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
/********************************************************************/
//Se define el contenido del PDF
$html = '
<style>
body {font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;}
table {border-collapse: collapse;border-spacing: 0;}
tr.oddrow td{display: line;border-bottom: 1px solid #EEE;}
.tableline td, .tableline th{border-bottom: 1px solid #EEE;line-height: 1.42857143;}
</style>';

$html .= '
<table style="border: 1px solid #f4f4f4;margin: 1%; width: 98%;"   cellpadding="10" cellspacing="0">
	<tbody>
		<tr>
			<td>
	
				<table style="text-align: left; width: 100%;"  cellpadding="0" cellspacing="0">
					<tbody>
						<tr class="oddrow">
							<td colspan="2" rowspan="1" style="vertical-align: top;">'.$row_data['TipoDoc'].'</td>
							<td style="vertical-align: top;">Fecha Creacion: '.Fecha_estandar($row_data['Creacion_fecha']).'</td>
						</tr>
						<tr>';
						
							//se verifica el tipo de movimiento
							switch ($row_data['idTipo']) {
								//Ingreso de Productos a bodega
								case 1:
								case 10:
								case 11:
									$html .= '
									<td style="vertical-align: top; width:33%;">
										Empresa Origen
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
									</td>
									
									<td style="vertical-align: top;width:33%;">
										Empresa Destino
											<strong>'.$row_data['SistemaOrigen'].'</strong><br>
											'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
											'.$row_data['SistemaOrigenDireccion'].'<br>
											Fono: '.$row_data['SistemaOrigenFono'].'<br>
											Rut: '.$row_data['SistemaOrigenRut'].'<br>
											Email: '.$row_data['SistemaOrigenEmail'].'
									</td>
								   
									<td style="vertical-align: top;width:33%;">
										<b>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</b><br>
										<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>';
					
										if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
											$html .= '<b>Estado: </b>'.$row_data['Estado'].'<br>';
										}
										if(isset($row_data['Devolucion_fecha'])&&$row_data['Devolucion_fecha']!=''&&$row_data['Devolucion_fecha']!='0000-00-00'){ 
											$html .= '<b>Fecha Devolucion : </b>'.Fecha_estandar($row_data['Devolucion_fecha']).'<br>';
										}
										if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
											$html .= '<b>Vencimiento : </b>'.Fecha_estandar($row_data['Pago_fecha']).'<br>';
										}
										if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
											$html .= '<b>Dto de Pago : </b>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br>';
										}
										if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
											$html .= '<b>Fecha Pagado: </b>'.Fecha_estandar($row_data['F_Pago']).'<br>';
										}
										if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){ 
											$html .= '<b>OC Relacionada: </b>'.N_doc($row_data['idOcompra'], 5).'<br>';
										}
										if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==1){ 
											$html .= '<b>Estado Devolucion : </b>'.$row_data['Devolucion_Estado'].'<br>';
										}
										if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==2){ 
											$html .= '<b>Estado Devolucion : </b>'.$row_data['Devolucion_Estado'].'<br>';
											$html .= '<b>Usuario Devolucion : </b>'.$row_data['Devolucion_Usuario'].'<br>';
											$html .= '<b>Fecha Real Devolucion : </b>'.Fecha_estandar($row_data['Devolucion_FechaReal']).'<br>';
										}	
											
										$html .= '</td>';

									break;
								//Egreso de Productos de bodega
								case 2:
								case 12:
								case 13:
									$html .= '
									<td style="vertical-align: top; width:33%;">
										Empresa Origen
										<strong>'.$row_data['SistemaOrigen'].'</strong><br>
										'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
										'.$row_data['SistemaOrigenDireccion'].'<br>
										Fono: '.$row_data['SistemaOrigenFono'].'<br>
										Rut: '.$row_data['SistemaOrigenRut'].'<br>
										Email: '.$row_data['SistemaOrigenEmail'].'
									</td>
									
									<td style="vertical-align: top;width:33%;">
										Empresa Destino
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
									</td>
									
									<td style="vertical-align: top;width:33%;">
										<b>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</b><br>
										<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
										<b>Vendedor: </b>'.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellido'].'<br>';
										if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
											$html .= '<b>Estado: </b>'.$row_data['Estado'].'<br>';
										}
										if(isset($row_data['Devolucion_fecha'])&&$row_data['Devolucion_fecha']!=''&&$row_data['Devolucion_fecha']!='0000-00-00'){ 
											$html .= '<b>Fecha Devolucion : </b>'.Fecha_estandar($row_data['Devolucion_fecha']).'<br>';
										}
										if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
											$html .= '<b>Vencimiento : </b>'.Fecha_estandar($row_data['Pago_fecha']).'<br>';
										}
										if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
											$html .= '<b>Dto de Pago : </b>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br>';
										}
										if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
											$html .= '<b>Fecha Pagado: </b>'.Fecha_estandar($row_data['F_Pago']).'<br>';
										}
										if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){ 
											$html .= '<b>OC Relacionada : </b>'.N_doc($row_data['idOcompra'], 5).'<br>';
										}
										if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==1){ 
											$html .= '<b>Estado Devolucion : </b>'.$row_data['Devolucion_Estado'].'<br>';
										}
										if(isset($row_data['idEstadoDevolucion'])&&$row_data['idEstadoDevolucion']==2){ 
											$html .= '<b>Estado Devolucion : </b>'.$row_data['Devolucion_Estado'].'<br>';
											$html .= '<b>Usuario Devolucion : </b>'.$row_data['Devolucion_Usuario'].'<br>';
											$html .= '<b>Fecha Real Devolucion : </b>'.Fecha_estandar($row_data['Devolucion_FechaReal']).'<br>';
										}
										if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''){ 
											$html .= '<b>OC Relacionada N°: </b>'.$row_data['OC_Ventas'].'<br>';
										}
									$html .= '</td>';
									break;
								
							}
						
						
						$html .= '</tr>
					</tbody>
				</table>
				
				<br/>
				<br/>

				<table class="zebra tableline" style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0" >
					<thead>
						<tr style="background-color: #f9f9f9;">
							<th colspan="4" style="vertical-align: top; width:89%;"><strong>Detalle</strong></th>
							<th style="vertical-align: top; width:11%;"><strong>Valor Total</strong></th>
						</tr>
					</thead>
					<tbody>';
					//si existen productos
					if ($arrArriendos) {
						$html .= '<tr style="background-color: #f9f9f9;"><td colspan="5"><strong>Productos</strong></td></tr>';
						foreach ($arrArriendos as $prod) {
							$html .= '<tr>
								<td colspan="2" style="vertical-align: top;">'.$prod['Nombre'].'</td>';
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									$html .= '<td align="right">'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prod['Frecuencia'].'</td>';
								}elseif(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									$html .= '<td align="right">'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prod['Frecuencia'].'</td>';
								}
								$html .= '
								<td align="right">'.Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prod['Frecuencia'].'</td>
								<td align="right">'.Valores(Cantidades_decimales_justos($prod['ValorTotal']), 0).'</td>
							</tr>';
						}
					}
					//si existen guias
					if ($arrGuias) {
						$html .= '<tr style="background-color: #f9f9f9;"><td colspan="5"><strong>Guias de Despacho</strong></td></tr>';
						foreach ($arrGuias as $guia) {
							$html .= '<tr>
								<td colspan="4" style="vertical-align: top;">Guia de Despacho N°'.$guia['N_Doc'].'</td>
								<td align="right">'.Valores($guia['ValorNeto'], 0).'</td>
							</tr>';
						} 
					}
					
					//si existen guias
					if ($arrOtros) {
						$html .= '<tr style="background-color: #f9f9f9;"><td colspan="5"><strong>Otros</strong></td></tr>';
						foreach ($arrOtros as $otro) {
							$html .= '<tr>
								<td colspan="4" style="vertical-align: top;">'.$otro['Nombre'].'</td>
								<td align="right">'.Valores($otro['vTotal'], 0).'</td>
							</tr>';
						} 
					}
					
					//Recorro y guard el nombre de los impuestos 
						$nn = 0;
						$impuestos = array();
						foreach ($arrImpuestos as $impto) { 
							$impuestos[$nn]['nimp'] = $impto['Nombre'].' ('.Cantidades_decimales_justos($impto['Porcentaje']).'%)';
							$nn++;
						}
						if(isset($row_data['ValorNeto'])&&$row_data['ValorNeto']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4" align="right"><strong>Subtotal</strong></td> 
								<td align="right">'.Valores($row_data['ValorNeto'], 0).'</td>
							</tr>';
						}
						foreach ($arrDescuentos as $descuentos) {
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4" align="right"><strong>Descuento: '.$descuentos['Nombre'].'</strong></td> 
								<td align="right">'.Valores($descuentos['vTotal'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['ValorNetoImp'])&&$row_data['ValorNetoImp']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4" align="right"><strong>Neto Imponible</strong></td> 
								<td align="right">'.Valores($row_data['ValorNetoImp'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_01'])&&$row_data['Impuesto_01']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[0]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_01'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_02'])&&$row_data['Impuesto_02']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[1]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_02'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_03'])&&$row_data['Impuesto_03']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[2]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_03'], 0).'</td>
							</tr>';
						} 
						if(isset($row_data['Impuesto_04'])&&$row_data['Impuesto_04']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[3]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_04'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_05'])&&$row_data['Impuesto_05']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[4]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_05'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_06'])&&$row_data['Impuesto_06']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[5]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_06'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_07'])&&$row_data['Impuesto_07']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[6]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_07'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_08'])&&$row_data['Impuesto_08']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[7]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_08'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_09'])&&$row_data['Impuesto_09']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[8]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_09'], 0).'</td>
							</tr>';
						}
						if(isset($row_data['Impuesto_10'])&&$row_data['Impuesto_10']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>'.$impuestos[9]['nimp'].'</strong></td> 
								<td align="right">'.Valores($row_data['Impuesto_10'], 0).'</td>
							</tr>';
						} 
						if(isset($row_data['ValorTotal'])&&$row_data['ValorTotal']!=0){
							$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4"  align="right"><strong>Total</strong></td> 
								<td align="right">'.Valores($row_data['ValorTotal'], 0).'</td>
							</tr>';
						} 
				$html .= '
					</tbody>
				</table>
				<br/>
				<br/>
				
				<table style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0">
					<tbody><tr><td style="vertical-align: top;">Observaciones:</td></tr></tbody>
				</table>
				<table style="text-align: left; width: 100%;margin-top:20px;" cellpadding="5" cellspacing="0">
					<tbody>
						<tr>
							<td style="vertical-align: top;text-align: left;background-color: #f9f9f9;border: 1px solid #EEE;">'.$row_data['Observaciones'].'</td>
						</tr>
					</tbody>
				</table>';
				
				if($row_data['idTipo']==6){
					$html .= '
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>

					
					<table style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td style="vertical-align: top;text-align:center;">Firma Transportista</td>
								<td style="vertical-align: top;text-align:center;">Firma Receptor</td>
							</tr>
						</tbody>
					</table>';
				}
				
				
				

			$html .= '</td>
		</tr>
	</tbody>
</table>';
 




/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = $row_data['TipoDoc'];
$pdf_subtitulo  = '';
$pdf_file       = $row_data['TipoDoc'].'.pdf';
$OpcDom         = "'A4', 'landscape'";
$OpcTcp         = "'L', 'A4'";
/********************************************************************************/
//Se verifica que este configurado el motor de pdf
if(isset($rowEmpresa['idOpcionesGen_5'])&&$rowEmpresa['idOpcionesGen_5']!=0){
	switch ($rowEmpresa['idOpcionesGen_5']) {
		/************************************************************************/
		//TCPDF
		case 1:
			
			require_once('../LIBS_php/tcpdf/tcpdf.php');

			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Victor Reyes');
			$pdf->SetTitle('');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
				if(isset($rowEmpresa['Config_imgLogo'])&&$rowEmpresa['Config_imgLogo']!=''){
					$logo = '../../../../'.DB_EMPRESA_PATH.'/upload/'.$rowEmpresa['Config_imgLogo'];
				}else{
					$logo = '../../../../LIB_assets/img/logo_empresa.jpg';
				}
			}else{
				$logo = '../../../../LIB_assets/img/logo_empresa.jpg';
			}
			$pdf->SetHeaderData($logo, 40, $pdf_titulo, $pdf_subtitulo);

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			//Se crea el archivo
			$pdf->SetFont('helvetica', '', 10);
			$pdf->AddPage($AddPageL, AddPageA);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->lastPage();
			$pdf->Output($pdf_file, 'I');
	
			break;
		/************************************************************************/
		//DomPDF (Solo compatible con PHP 5.x)
		case 2:
			require_once '../LIBS_php/dompdf/autoload.inc.php';
			// reference the Dompdf namespace
			//use Dompdf\Dompdf;
			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper($OpcDom);
			$dompdf->render();
			$dompdf->stream($pdf_file);
			break;

	}
}

?>
