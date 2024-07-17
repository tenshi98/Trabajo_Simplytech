<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
//variable de ubicacion en el menu
$rowlevel['nombre_categoria'] = '';
?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><i class="fa fa-dashboard"></i> Ver Datos del movimiento</h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
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
?>


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
			//Ingreso de Materiales a bodega
			case 1:
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'<br>';
					
				if(isset($row_data['Estado'])&&$row_data['Estado']!=''){ 
					echo '<b>Estado: </b>'.$row_data['Estado'].'<br>';
				}
				if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){ 
					echo '<b>Pago programado para : </b>'.Fecha_estandar($row_data['Pago_fecha']).'<br>';
				}
				if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){ 
					echo '<b>Dto de Pago : </b>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br>';
				}
				if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){ 
					echo '<b>Fecha Pagado: </b>'.Fecha_estandar($row_data['F_Pago']).'<br>';
				}	
					
				echo '</div>';

				break;
			//Egreso de Materiales de bodega
			case 2:
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
				</div>';
				break;
			//Gasto de Materiales
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
					
				</div>
				
				<div class="col-sm-4 invoice-col">
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'
				</div>';
				break;
			//Traspaso de Materiales entre bodegas
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'
				</div>';
				break;
			//Transformacion de Materiales
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega Origen: </b>'.$row_data['BodegaDesde'].'<br>
					<b>Bodega Destino: </b>'.$row_data['BodegaHacia'].'
				</div>';
				break;
			//traspaso maeriales a otra empresa
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
					<b>Doc N°'.N_doc($row_data['idFacturacion'], 6).'</b><br>
					<b>Bodega de destino:</b> '.$row_data['BodegaHacia'].'<br>
				</div>';
				break;
			//Consumo de materiales por una OT
			case 7:
				echo '
				<div class="col-sm-4 invoice-col">
					Datos Basicos
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
			
		}?>
		
		
		
    
	</div>
	
	
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
				<tbody>
					<?php if ($arrProductos) { ?>
						<tr class="active"><td colspan="5"><strong>Productos</strong></td></tr>
						<?php foreach ($arrProductos as $prod) { ?>
							<tr>
								<td><?php echo '<strong>'.$prod['NombreBodega'].'</strong> - '.$prod['Nombre'];?></td>
								<?php 
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									echo '<td>'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prod['Unimed'].'</td>';
									echo '<td></td>';
								} 
								if(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									echo '<td></td>';
									echo '<td>'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prod['Unimed'].'</td>';
								}?>
								<td><?php echo Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prod['Unimed'];?></td>
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
				</tbody>
			</table>
			<table class="table">
				<tbody>	
					<?php
					//Recorro y guard el nombre de los impuestos 
					$nn = 0;
					$impuestos = array();
					foreach ($arrImpuestos as $impto) { 
						$impuestos[$nn]['nimp'] = $impto['Nombre'];
						$nn++;
					}?>
					<?php if(isset($row_data['ValorNeto'])&&$row_data['ValorNeto']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Subtotal</strong></td> 
							<td width="160" align="right"><?php echo Valores($row_data['ValorNeto'], 0); ?></td>
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
	//Traspaso de Materiales a otra Empresa
	if($row_data['idTipo']==6){?>
		
		<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Transportista</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Receptor</p></div> 
		</div>
		
	<?php } ?>
	

<?php
	$zz  = '?idSistema='.$arrUsuario['idSistema'];
	$zz .= '&view='.$_GET['view'];
	?>
	<div class="row no-print">
		<div class="col-xs-12">
			<a target="new" href="view_doc_to_print.php<?php echo $zz ?>" class="btn btn-default">
				<i class="fa fa-print"></i> Imprimir
			</a>

			<a target="new" href="view_doc_to_pdf.php<?php echo $zz ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
				<i class="fa fa-file-pdf-o"></i> Exportar a PDF
			</a>
		</div>
	</div>
      
</section>

 




<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
