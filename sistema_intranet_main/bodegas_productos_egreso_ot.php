<?php session_start();
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
$original = "bodegas_productos_egreso_ot.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){
	$location .= "&Nombre=".$_GET['Nombre'];
	$search .= "&Nombre=".$_GET['Nombre'];  	
}
/********************************************************************/

//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'bodega_asc':   $order_by = 'bodegas_productos_listado.Nombre ASC ';                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Ascendente'; break;
		case 'bodega_desc':  $order_by = 'bodegas_productos_listado.Nombre DESC ';               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Bodega Descendente';break;
		case 'fecha_asc':    $order_by = 'bodegas_productos_facturacion.Creacion_fecha ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':   $order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'ot_asc':       $order_by = 'bodegas_productos_facturacion.idOT ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> OT Ascendente';break;
		case 'ot_desc':      $order_by = 'bodegas_productos_facturacion.idOT DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> OT Descendente';break;
		
		default: $order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable con la ubicacion
$SIS_where = "bodegas_productos_facturacion.idTipo=7 AND bodegas_productos_facturacion.idOT!=0";//Solo egresos por OT
$SIS_where.= " AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando	

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idFacturacion', 'bodegas_productos_facturacion', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
bodegas_productos_facturacion.idFacturacion,
bodegas_productos_facturacion.Creacion_fecha,
bodegas_productos_facturacion.N_Doc,
bodegas_productos_listado.Nombre AS Bodega,
core_sistemas.Nombre AS Sistema,
bodegas_productos_facturacion.idOT AS OrdenTrabajo';
$SIS_join  = '
LEFT JOIN `bodegas_productos_listado`   ON bodegas_productos_listado.idBodega    = bodegas_productos_facturacion.idBodegaOrigen
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema               = bodegas_productos_facturacion.idSistema';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrTipo = array();
$arrTipo = db_select_array (false, $SIS_query, 'bodegas_productos_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
	</ul>

</div>
<div class="clearfix"></div>
                                
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Egresos Generados por una OT</h5>
			<div class="toolbar">
				<?php
				//Se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Bodega</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=bodega_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=bodega_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha de Egreso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">OT</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=ot_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=ot_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Bodega']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo 'view_orden_trabajo.php?view='.simpleEncode($tipo['OrdenTrabajo'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
							</div>
							<?php echo n_doc($tipo['OrdenTrabajo'], 5); ?>
						</td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_mov_productos.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="pagrow">
			<?php
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>


         
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
