<?php
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT 
bodegas_facturacion.idTipo,
bodegas_facturacion.idFacturacion,
bodegas_facturacion.Creacion_fecha,
bodegas_facturacion.N_Doc,
bodegas_facturacion.Observaciones,
bodegas_facturacion.idOT,
bodega1.Nombre AS BodegaDesde,
bodega2.Nombre AS BodegaHacia,
bodegas_facturacion_tipo.Nombre AS TipoDoc,
bodegas_documentos_mercantiles.Nombre AS Documento,
usuarios_listado.Nombre AS NombreUsuario,
bodegas_facturacion.ValorNeto,
bodegas_facturacion.Impuesto_01,
bodegas_facturacion.Impuesto_02,
bodegas_facturacion.Impuesto_03,
bodegas_facturacion.Impuesto_04,
bodegas_facturacion.Impuesto_05,
bodegas_facturacion.Impuesto_06,
bodegas_facturacion.Impuesto_07,
bodegas_facturacion.Impuesto_08,
bodegas_facturacion.Impuesto_09,
bodegas_facturacion.Impuesto_10,
bodegas_facturacion.ValorTotal,

sistema_origen.Nombre AS SistemaOrigen,
sistema_origen.Ciudad AS SistemaOrigenCiudad,
sistema_origen.Comuna AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Fono AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

sistema_destino.Nombre AS SistemaDestino,
sistema_destino.Rut AS SistemaDestinoRut,
sistema_destino.Ciudad AS SistemaDestinoCiudad,
sistema_destino.Comuna AS SistemaDestinoComuna,
sistema_destino.Direccion AS SistemaDestinoDireccion,
sistema_destino.Fono AS SistemaDestinoFono,
sistema_destino.Fax AS SistemaDestinoFax,
sistema_destino.email_principal AS SistemaDestinoEmail,

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

bodegas_facturacion_estado.Nombre AS Estado,
bodegas_facturacion.Pago_fecha,
bodegas_documentos_pago.Nombre AS DocPago,
bodegas_facturacion.N_DocPago,
bodegas_facturacion.F_Pago

FROM `bodegas_facturacion`
LEFT JOIN `bodegas_listado`       bodega1         ON bodega1.idBodega                             = bodegas_facturacion.idBodegaOrigen
LEFT JOIN `bodegas_listado`       bodega2         ON bodega2.idBodega                             = bodegas_facturacion.idBodegaDestino
LEFT JOIN `bodegas_facturacion_tipo`              ON bodegas_facturacion_tipo.idTipo              = bodegas_facturacion.idTipo
LEFT JOIN `bodegas_documentos_mercantiles`        ON bodegas_documentos_mercantiles.idDocumentos  = bodegas_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`                      ON usuarios_listado.idUsuario                   = bodegas_facturacion.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen        ON sistema_origen.idSistema                     = bodegas_facturacion.idSistema
LEFT JOIN `core_sistemas`   sistema_destino       ON sistema_destino.idSistema                    = bodegas_facturacion.idSistemaDestino
LEFT JOIN `proveedor_listado`                     ON proveedor_listado.idProveedor                = bodegas_facturacion.idProveedor
LEFT JOIN `clientes_listado`                      ON clientes_listado.idCliente                   = bodegas_facturacion.idCliente
LEFT JOIN `mnt_ubicacion_ciudad`    provciudad    ON provciudad.idCiudad                          = proveedor_listado.idCiudad
LEFT JOIN `mnt_ubicacion_comunas`   provcomuna    ON provcomuna.idComuna                          = proveedor_listado.idComuna
LEFT JOIN `mnt_ubicacion_ciudad`    clienciudad   ON clienciudad.idCiudad                         = clientes_listado.idCiudad
LEFT JOIN `mnt_ubicacion_comunas`   cliencomuna   ON cliencomuna.idComuna                         = clientes_listado.idComuna
LEFT JOIN `bodegas_facturacion_estado`            ON bodegas_facturacion_estado.idEstado          = bodegas_facturacion.idEstado
LEFT JOIN `bodegas_documentos_pago`               ON bodegas_documentos_pago.idDocPago            = bodegas_facturacion.idDocPago

WHERE idFacturacion = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$row_data = mysqli_fetch_assoc ($resultado);


				
// Se trae un listado con todos los productos utilizados
$arrProductos = array();
$query = "SELECT 
productos_listado.Nombre,
productos_uml.Nombre AS Unimed,
bodegas_facturacion_existencias.Cantidad_ing,
bodegas_facturacion_existencias.Cantidad_eg,
bodegas_facturacion_existencias.Valor,
bodegas_facturacion_existencias.ValorTotal,
productos_listado.ValorIngreso AS  ValorTraspaso,
bodegas_listado.Nombre AS NombreBodega
FROM `bodegas_facturacion_existencias` 
LEFT JOIN `productos_listado`  ON productos_listado.idProducto   = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`      ON productos_uml.idUml            = productos_listado.idUml
LEFT JOIN `bodegas_listado`    ON bodegas_listado.idBodega       = bodegas_facturacion_existencias.idBodega
WHERE idFacturacion = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}
// Se trae un listado con todos los impuestos existentes
$arrImpuestos = array();
$query = "SELECT Nombre
FROM `bodegas_impuestos`
ORDER BY Nombre ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrImpuestos,$row );
}

// Se trae un listado con todas las guias relacionadas al documento
$arrGuias = array();
$query = "SELECT  N_Doc, ValorNeto
FROM `bodegas_facturacion`
WHERE idDocumentos = 1 AND DocRel = {$_GET['view']}
ORDER BY N_Doc ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGuias,$row );
}

$html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Imprimir</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!-- Bootstrap -->
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/lib/font-awesome-animation/font-awesome-animation.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <link rel="stylesheet" href="assets/lib/fullcalendar/fullcalendar.css">
    <!-- Estilo definido por mi -->
    <link href="assets/css/my_style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/my_colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/my_corrections.css" rel="stylesheet" type="text/css">
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
			//Ingreso de Materiales a bodega
			case 1:
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>';
					
				if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
					$html .= '<b>Estado: </b>'.$row_data['Estado'].'<br>';
				}
				if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
					$html .= '<b>Pago programado para : </b>'.Fecha_estandar($row_data['Pago_fecha']).'<br>';
				}
				if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
					$html .= '<b>Dto de Pago : </b>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br>';
				}
				if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
					$html .= '<b>Fecha Pagado: </b>'.Fecha_estandar($row_data['F_Pago']).'<br>';
				}	
					
				$html .= '</div>';

				break;
			//Egreso de Materiales de bodega
			case 2:
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
				</div>';
				break;
			//Gasto de Materiales
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
					
				</div>
				
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'
				</div>';
				break;
			//Traspaso de Materiales entre bodegas
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'
				</div>';
				break;
			//Transformacion de Materiales
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'
				</div>';
				break;
			//traspaso maeriales a otra empresa
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega de destino:</b> '.$row_data['BodegaHacia'].'<br>
				</div>';
				break;
			//Consumo de materiales por una OT
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega utilizada:</b> '.$row_data['BodegaDesde'].'<br>
					<b>Orden de Trabajo N°:</b> '.N_doc($row_data['idOT'], 6).'<br>
				</div>';
				break;
			
		}
		
		
		
    
	$html .= '</div>
	
	
	<div class="row">
		<div class="col-xs-12 table-responsive">
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
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									$html .= '<td>'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prod['Unimed'].'</td>';
									$html .= '<td></td>';
								} 
								if(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									$html .= '<td></td>';
									$html .= '<td>'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prod['Unimed'].'</td>';
								}
								$html .= '<td>'.Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prod['Unimed'].'</td>';
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
				$html .= '</tbody>
			</table>

			<table class="table">
				<tbody>';	
					
					//Recorro y guard el nombre de los impuestos 
					$nn = 0;
					$impuestos = array();
					foreach ($arrImpuestos as $impto) { 
						$impuestos[$nn]['nimp'] = $impto['Nombre'];
						$nn++;
					}
					if(isset($row_data['ValorNeto'])&&$row_data['ValorNeto']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Subtotal</strong></td> 
							<td width="160" align="right">'.Valores($row_data['ValorNeto'], 0).'</td>
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
