<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Print.php';
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

core_estado_facturacion.Nombre AS Estado,
bodegas_insumos_facturacion.Pago_fecha,
sistema_documentos_pago.Nombre AS DocPago,
bodegas_insumos_facturacion.N_DocPago,
bodegas_insumos_facturacion.F_Pago

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

$html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Imprimir</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!-- Bootstrap -->
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="'.DB_SITE.'/Legacy/gestion_modular/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <link rel="stylesheet" href="'.DB_SITE.'/Legacy/gestion_modular/lib/fullcalendar/fullcalendar.css">
    <!-- Estilo definido por mi -->
    <link href="'.DB_SITE.'/Legacy/gestion_modular/css/my_style.css" rel="stylesheet" type="text/css">
    <link href="'.DB_SITE.'/LIB_assets/css/my_colors.css" rel="stylesheet" type="text/css">
    <link href="'.DB_SITE.'/Legacy/gestion_modular/css/my_corrections.css" rel="stylesheet" type="text/css">
    <style>
    body{background-color:#fff;}
    </style>
</head>

<body onload="window.print();">
<section class="invoice">';
 
$html .= '<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> '.$row_data['TipoDoc'].'
				<small class="pull-right">Fecha Creacion: '.Fecha_estandar($row_data['Creacion_fecha']).'</small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">';
		
		
		//se verifica el tipo de movimiento
		switch ($row_data['idTipo']) {
			//Ingreso de Productos a bodega
			case 1:
			case 10:
			case 11:
				$html .= '
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
					$html .= '<b>Estado: </b>'.$row_data['Estado'].'<br>';
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
					
				$html .= '</div>';

				break;
			//Egreso de Productos de bodega
			case 2:
			case 12:
			case 13:
				$html .= '
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
					<b>Vendedor: </b>'.$row_data['Nombre_trab'].' '.$row_data['ApellidoPat_trab'].'<br>';
					
					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
						$html .= '<b>Estado: </b>'.$row_data['Estado'].'<br>';
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
					if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''){ 
						$html .= '<b>OC Relacionada N°: </b>'.$row_data['OC_Ventas'].'<br>';
					}		
					
				$html .= '
				</div>';
				
		
				break;
			//Gasto de Productos
			case 3:
				$html .= '
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</b><br>
				</div>';
				break;
			//Traspaso de Productos entre bodegas
			case 4:
				$html .= '
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
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'
				</div>';
				break;
			//Transformacion de Productos
			case 5:
				$html .= '
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
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'
				</div>';
				break;
			//Transpaso de insumos otras empresas
			case 6:
				$html .= '
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
					<b>Bodega de destino:</b> '.$row_data['BodegaHacia'].'<br>
				</div>';
				break;
			//Gasto de Productos en una Orden de Trabajo	
			case 7:
				$html .= '
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
					<b>Orden de Trabajo N°:</b> '.N_doc($row_data['idOT'], 5).'<br>
				</div>';
				break;
			//Traspaso Manual de Insumos a otra Empresa
			case 8:
				$html .= '
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
				</div>';
				break;
			//Ingreso manual de insumos
			case 9:
				$html .= '
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
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>
				</div>';
				
				break;
		}
		
		
		
    
	$html .= '</div>
	
	
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
				<tbody>';
					//si existen productos
					if ($arrProductos) {
						$html .= '<tr class="active"><td colspan="5"><strong>Productos</strong></td></tr>';
						foreach ($arrProductos as $prod) { 
							$html .= '<tr>
								<td><strong>'.$prod['NombreBodega'].'</strong> - '.$prod['Nombre'].'</td>';
								//Verifico la existencia de la abreviatura de la unidad de medida
								if(isset($prod['UnimedAbrev'])&&$prod['UnimedAbrev']!=''){
									$prodUnimed = $prod['UnimedAbrev'];
								}else{
									$prodUnimed = $prod['Unimed'];
								} 
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									$html .= '<td>'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prodUnimed.'</td>';
									$html .= '<td></td>';
								} 
								if(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									$html .= '<td></td>';
									$html .= '<td>'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prodUnimed.'</td>';
								}
								$html .= '<td>'.Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prodUnimed.'</td>';
								$html .= '<td align="right">'.Valores(Cantidades_decimales_justos($prod['ValorTotal']), 0).'</td>
							
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
					
					
				$html .= '</tbody>
			</table>
			
			<table class="table">
				<tbody>';	
					
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
							<td width="160" align="right">'.Valores($row_data['ValorNeto'], 0).'</td>
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
							<td colspan="4" align="right"><strong>'.$impuestos[0]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_01'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_02'])&&$row_data['Impuesto_02']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[1]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_02'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_03'])&&$row_data['Impuesto_03']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[2]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_03'], 0).'</td>
						</tr>';
					} 
					if(isset($row_data['Impuesto_04'])&&$row_data['Impuesto_04']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[3]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_04'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_05'])&&$row_data['Impuesto_05']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[4]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_05'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_06'])&&$row_data['Impuesto_06']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[5]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_06'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_07'])&&$row_data['Impuesto_07']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[6]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_07'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_08'])&&$row_data['Impuesto_08']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[7]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_08'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_09'])&&$row_data['Impuesto_09']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[8]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_09'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_10'])&&$row_data['Impuesto_10']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[9]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_10'], 0).'</td>
						</tr>';
					} 
					if(isset($row_data['ValorTotal'])&&$row_data['ValorTotal']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Total</strong></td> 
							<td align="right">'.Valores($row_data['ValorTotal'], 0).'</td>
						</tr>';
					}
				
				$html .= '</tbody>
			</table>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" >'.$row_data['Observaciones'].'</p>
		</div>
	</div>';
	
	if($row_data['idTipo']==3){
		$html .= '<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Emisor</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Trabajador</p></div> 
		</div>';
	} 
	
	if($row_data['idTipo']==6){
		$html .= '<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Transportista</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Receptor</p></div> 
		</div>';
	}
 



$html .= '</section>


</body>
</html>';

echo $html;

?>
