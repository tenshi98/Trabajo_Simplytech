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
$original = "bodegas_insumos_stock.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){  $location .= "&Nombre=".$_GET['Nombre'];  $search .= "&Nombre=".$_GET['Nombre'];}
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
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Bodega Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Bodega Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Bodega Borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['view'])){
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	bodegas_insumos_facturacion_existencias.Creacion_fecha,
	bodegas_insumos_facturacion_existencias.Cantidad_ing,
	bodegas_insumos_facturacion_existencias.Cantidad_eg,
	bodegas_insumos_facturacion_existencias.idFacturacion,
	bodegas_insumos_facturacion_tipo.Nombre AS TipoMovimiento,
	insumos_listado.Nombre AS NombreProducto,
	sistema_productos_uml.Nombre AS UnidadMedida,
	bodegas_insumos_listado.Nombre AS NombreBodega';
	$SIS_join  = '
	LEFT JOIN `bodegas_insumos_facturacion_tipo`    ON bodegas_insumos_facturacion_tipo.idTipo   = bodegas_insumos_facturacion_existencias.idTipo
	LEFT JOIN `insumos_listado`                     ON insumos_listado.idProducto                = bodegas_insumos_facturacion_existencias.idProducto
	LEFT JOIN `sistema_productos_uml`               ON sistema_productos_uml.idUml               = insumos_listado.idUml
	LEFT JOIN `bodegas_insumos_listado`             ON bodegas_insumos_listado.idBodega          = bodegas_insumos_facturacion_existencias.idBodega';
	$SIS_where = 'bodegas_insumos_facturacion_existencias.idProducto='.$_GET['view'];
	$SIS_where.= ' AND bodegas_insumos_facturacion_existencias.idBodega='.$_GET['idBodega'];
	$SIS_order = 'bodegas_insumos_facturacion_existencias.Creacion_fecha DESC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion_existencias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrProductos');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
		<?php
		$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
		$zz .= '&view='.$_GET['view'];
		$zz .= '&idBodega='.$_GET['idBodega'];
		?>
		<a target="new" href="<?php echo 'bodegas_insumos_stock_view_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
		<a target="new" href="<?php echo 'bodegas_insumos_stock_view_to_pdf.php?bla=bla'.$zz ; ?>"   class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
		<a target="new" href="<?php echo 'bodegas_insumos_stock_view_to_print.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-5 pull-right margin_width"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5>Listado de Movimientos de <?php echo $arrProductos[0]['NombreProducto']; ?> de la bodega <?php echo $arrProductos[0]['NombreBodega']; ?></h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Movimiento</th>
							<th>Fecha</th>
							<th>Cant Ing</th>
							<th>Cant eg</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrProductos as $productos) { ?>
						<tr class="odd">
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_mov_insumos.php?view='.simpleEncode($productos['idFacturacion'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
								</div>
								<?php echo $productos['TipoMovimiento']; ?>
							</td>
							<td><?php echo Fecha_estandar($productos['Creacion_fecha']); ?></td>
							<td><?php echo Cantidades_decimales_justos($productos['Cantidad_ing']).' '.$productos['UnidadMedida']; ?></td>
							<td><?php echo Cantidades_decimales_justos($productos['Cantidad_eg']).' '.$productos['UnidadMedida']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
		<a href="<?php echo $location.'&idBodega='.$_GET['idBodega']; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['idBodega'])){
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	insumos_listado.idProducto,
	insumos_listado.StockLimite,
	insumos_listado.Nombre AS NombreProd,
	sistema_productos_uml.Nombre AS UnidadMedida,
	SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS stock_entrada,
	SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS stock_salida,
	bodegas_insumos_listado.Nombre AS NombreBodega';
	$SIS_join  = '
	LEFT JOIN `sistema_productos_uml`                     ON sistema_productos_uml.idUml                          = insumos_listado.idUml
	LEFT JOIN `bodegas_insumos_facturacion_existencias`   ON bodegas_insumos_facturacion_existencias.idProducto   = insumos_listado.idProducto
	LEFT JOIN `bodegas_insumos_listado`                   ON bodegas_insumos_listado.idBodega                     = bodegas_insumos_facturacion_existencias.idBodega';
	$SIS_where = 'bodegas_insumos_facturacion_existencias.idBodega = '.$_GET['idBodega'];
	$SIS_where.= ' GROUP BY insumos_listado.idProducto';
	$SIS_order = 'insumos_listado.Nombre ASC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, 'insumos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrProductos');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
		<?php
		$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
		$zz .= '&idBodega='.$_GET['idBodega'];
		?>
		<a target="new" href="<?php echo 'bodegas_insumos_stock_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
		<a target="new" href="<?php echo 'bodegas_insumos_stock_to_pdf.php?bla=bla'.$zz ; ?>"   class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
		<a target="new" href="<?php echo 'bodegas_insumos_stock_to_print.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-5 pull-right margin_width"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Insumos de la bodega <?php echo $arrProductos[0]['NombreBodega']; ?></h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Stock Min</th>
							<th>Stock Actual</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>

					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrProductos as $productos) { ?>
						<?php $stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; ?>
						<tr class="odd <?php if ($productos['StockLimite']>$stock_actual){echo 'danger';} ?>">
							<td><?php echo $productos['NombreProd']; ?></td>
							<td><?php echo Cantidades_decimales_justos($productos['StockLimite']).' '.$productos['UnidadMedida']; ?></td>
							<td><?php echo Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida']; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo $location.'&idBodega='.$_GET['idBodega'].'&view='.$productos['idProducto']; ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
		<a href="<?php echo $location; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
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
			case 'bodega_asc':    $order_by = 'bodegas_insumos_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Ascendente';break;
			case 'bodega_desc':   $order_by = 'bodegas_insumos_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Bodega Descendente';break;

			default: $order_by = 'bodegas_insumos_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Ascendente';
		}
	}else{
		$order_by = 'bodegas_insumos_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Ascendente';
	}
	/**********************************************************/
	//Variable con la ubicacion
	$SIS_where = "bodegas_insumos_listado.idBodega!=0";
	$SIS_where.= " AND bodegas_insumos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	$SIS_join  = "";
	//Verifico el tipo de usuario que esta ingresando
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
		$SIS_where.= " AND usuarios_bodegas_insumos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
		$SIS_join .= "INNER JOIN `usuarios_bodegas_insumos` ON usuarios_bodegas_insumos.idBodega = bodegas_insumos_listado.idBodega";
	}
	$SIS_where.= " GROUP BY bodegas_insumos_listado.idBodega";

	/**********************************************************/
	//Realizo una consulta para saber el total de elementos existentes
	$cuenta_registros = db_select_nrows (false, 'bodegas_insumos_listado.idBodega', 'bodegas_insumos_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
	//Realizo la operacion para saber la cantidad de paginas que hay
	$total_paginas = ceil($cuenta_registros / $cant_reg);
	// Se trae un listado con todos los elementos
	$SIS_query = '
	bodegas_insumos_listado.idBodega,
	bodegas_insumos_listado.Nombre,
	core_sistemas.Nombre AS RazonSocial';
	$SIS_join .= ' LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = bodegas_insumos_listado.idSistema';
	$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
	$arrTipo = array();
	$arrTipo = db_select_array (false, $SIS_query, 'bodegas_insumos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

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
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Bodegas</h5>
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
									<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Nombre']; ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['RazonSocial']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo $location.'&idBodega='.$tipo['idBodega']; ?>" title="Ver Información" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
