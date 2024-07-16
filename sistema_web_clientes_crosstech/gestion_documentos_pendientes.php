<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "gestion_tickets.php";
$location = $original;
//Titulo ventana
$t_dashboard = '<i class="fa fa-usd" aria-hidden="true"></i> Mis Documentos Vencidos';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Variable de busqueda
$SIS_where1 = "bodegas_arriendos_facturacion.idEstado=1";
$SIS_where2 = "bodegas_insumos_facturacion.idEstado=1";
$SIS_where3 = "bodegas_productos_facturacion.idEstado=1";
$SIS_where4 = "bodegas_servicios_facturacion.idEstado=1";
//Verifico el tipo de usuario que esta ingresando
$SIS_where1.=" AND bodegas_arriendos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where2.=" AND bodegas_insumos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where3.=" AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where4.=" AND bodegas_servicios_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//Verifico que sean solo compras
$SIS_where1.=" AND (bodegas_arriendos_facturacion.idTipo=2 OR bodegas_arriendos_facturacion.idTipo=12)";
$SIS_where2.=" AND (bodegas_insumos_facturacion.idTipo=2 OR bodegas_insumos_facturacion.idTipo=12)";
$SIS_where3.=" AND (bodegas_productos_facturacion.idTipo=2 OR bodegas_productos_facturacion.idTipo=12)";
$SIS_where4.=" AND (bodegas_servicios_facturacion.idTipo=2 OR bodegas_servicios_facturacion.idTipo=12)";
//se filtra el cliente
$SIS_where1.=" AND bodegas_arriendos_facturacion.idCliente=".$_SESSION['usuario']['basic_data']['idCliente'];
$SIS_where2.=" AND bodegas_insumos_facturacion.idCliente=".$_SESSION['usuario']['basic_data']['idCliente'];
$SIS_where3.=" AND bodegas_productos_facturacion.idCliente=".$_SESSION['usuario']['basic_data']['idCliente'];
$SIS_where4.=" AND bodegas_servicios_facturacion.idCliente=".$_SESSION['usuario']['basic_data']['idCliente'];
//se filtra que este vencida
$SIS_where1.=" AND bodegas_arriendos_facturacion.Pago_fecha<='".fecha_actual()."'";
$SIS_where2.=" AND bodegas_insumos_facturacion.Pago_fecha<='".fecha_actual()."'";
$SIS_where3.=" AND bodegas_productos_facturacion.Pago_fecha<='".fecha_actual()."'";
$SIS_where4.=" AND bodegas_servicios_facturacion.Pago_fecha<='".fecha_actual()."'";

/*******************************************************/
// consulto los datos
$SIS_query = '
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.Pago_fecha,
bodegas_arriendos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
clientes_listado.Nombre AS Cliente,
bodegas_arriendos_facturacion.MontoPagado,
bodegas_arriendos_facturacion.ValorTotal';
$SIS_join  = '
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_arriendos_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos    = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                  = bodegas_arriendos_facturacion.idCliente';
$SIS_order = 0;
$arrTipo1 = array();
$arrTipo1 = db_select_array (false, $SIS_query, 'bodegas_arriendos_facturacion', $SIS_join, $SIS_where1, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo1');

/*******************************************************/
// consulto los datos
$SIS_query = '
bodegas_insumos_facturacion.idFacturacion,
bodegas_insumos_facturacion.Creacion_fecha,
bodegas_insumos_facturacion.Pago_fecha,
bodegas_insumos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
clientes_listado.Nombre AS Cliente,
bodegas_insumos_facturacion.MontoPagado,
bodegas_insumos_facturacion.ValorTotal';
$SIS_join  = '
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_insumos_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos    = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                  = bodegas_insumos_facturacion.idCliente';
$SIS_order = 0;
$arrTipo2 = array();
$arrTipo2 = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion', $SIS_join, $SIS_where2, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo2');


/*******************************************************/
// consulto los datos
$SIS_query = '
bodegas_productos_facturacion.idFacturacion,
bodegas_productos_facturacion.Creacion_fecha,
bodegas_productos_facturacion.Pago_fecha,
bodegas_productos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
clientes_listado.Nombre AS Cliente,
bodegas_productos_facturacion.MontoPagado,
bodegas_productos_facturacion.ValorTotal';
$SIS_join  = '
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_productos_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos    = bodegas_productos_facturacion.idDocumentos
LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                  = bodegas_productos_facturacion.idCliente';
$SIS_order = 0;
$arrTipo3 = array();
$arrTipo3 = db_select_array (false, $SIS_query, 'bodegas_productos_facturacion', $SIS_join, $SIS_where3, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo3');

/*******************************************************/
// consulto los datos
$SIS_query = '
bodegas_servicios_facturacion.idFacturacion,
bodegas_servicios_facturacion.Creacion_fecha,
bodegas_servicios_facturacion.Pago_fecha,
bodegas_servicios_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
clientes_listado.Nombre AS Cliente,
bodegas_servicios_facturacion.MontoPagado,
bodegas_servicios_facturacion.ValorTotal';
$SIS_join  = '
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_servicios_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos    = bodegas_servicios_facturacion.idDocumentos
LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                  = bodegas_servicios_facturacion.idCliente';
$SIS_order = 0;
$arrTipo4 = array();
$arrTipo4 = db_select_array (false, $SIS_query, 'bodegas_servicios_facturacion', $SIS_join, $SIS_where4, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo4');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Documentos</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Cliente</th>
						<th>Documento</th>
						<th>Fecha de Ingreso</th>
						<th>Fecha de Pago</th>
						<th>Valor Total</th>
						<th>Monto Pagado</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php if($arrTipo1){ ?>
						<tr class="odd"><td style="background-color:#DDD" colspan="7">Arriendos</td></tr>
						<?php foreach ($arrTipo1 as $tipo) { ?>
							<tr class="odd">
								<td><?php echo $tipo['Cliente']; ?></td>
								<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
								<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
								<td><?php echo Fecha_estandar($tipo['Pago_fecha']); ?></td>
								<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
								<td><?php echo Valores($tipo['MontoPagado'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if($arrTipo2){ ?>
						<tr class="odd"><td style="background-color:#DDD" colspan="7">Insumos</td></tr>
						<?php foreach ($arrTipo2 as $tipo) { ?>
							<tr class="odd">
								<td><?php echo $tipo['Cliente']; ?></td>
								<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
								<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
								<td><?php echo Fecha_estandar($tipo['Pago_fecha']); ?></td>
								<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
								<td><?php echo Valores($tipo['MontoPagado'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if($arrTipo3){ ?>
						<tr class="odd"><td style="background-color:#DDD" colspan="7">Productos</td></tr>
						<?php foreach ($arrTipo3 as $tipo) { ?>
							<tr class="odd">
								<td><?php echo $tipo['Cliente']; ?></td>
								<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
								<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
								<td><?php echo Fecha_estandar($tipo['Pago_fecha']); ?></td>
								<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
								<td><?php echo Valores($tipo['MontoPagado'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if($arrTipo4){ ?>
						<tr class="odd"><td style="background-color:#DDD" colspan="7">Servicios</td></tr>
						<?php foreach ($arrTipo4 as $tipo) { ?>
							<tr class="odd">
								<td><?php echo $tipo['Cliente']; ?></td>
								<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
								<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
								<td><?php echo Fecha_estandar($tipo['Pago_fecha']); ?></td>
								<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
								<td><?php echo Valores($tipo['MontoPagado'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
