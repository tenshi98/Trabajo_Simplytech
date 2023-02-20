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
$original = "bodegas_insumos_simple_stock.php";
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
if(!empty($_GET['idBodega'])){ 

             
  

//se consulta
$arrProductos = array();
$query = "SELECT
insumos_listado.StockLimite,
insumos_listado.Nombre AS NombreProd,
sistema_productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_insumos_listado.Nombre AS NombreBodega

FROM `bodegas_insumos_facturacion_existencias`
LEFT JOIN `insumos_listado`          ON insumos_listado.idProducto         = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`    ON sistema_productos_uml.idUml        = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_listado`  ON bodegas_insumos_listado.idBodega   = bodegas_insumos_facturacion_existencias.idBodega

WHERE bodegas_insumos_facturacion_existencias.idBodega=".$_GET['idBodega']."
GROUP BY bodegas_insumos_facturacion_existencias.idProducto";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrProductos,$row );
}
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
	<?php
	$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&idBodega='.$_GET['idBodega'];
	?>		
	<a target="new" href="<?php echo 'bodegas_insumos_simple_stock_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'bodegas_insumos_simple_stock_to_pdf.php?bla=bla'.$zz ; ?>"   class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
	<a target="new" href="<?php echo 'bodegas_insumos_simple_stock_to_print.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-5 pull-right margin_width"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
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
					</tr>
				</thead>
							  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $productos) { 
					$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
					if ($stock_actual!=0&&$productos['NombreProd']!=''){?>
					<tr class="odd <?php if ($productos['StockLimite']>$stock_actual){echo 'danger';} ?>">
						<td><?php echo $productos['NombreProd']; ?></td>
						<td><?php echo Cantidades_decimales_justos($productos['StockLimite']); ?> <?php echo $productos['UnidadMedida'];?></td>
						<td><?php echo Cantidades_decimales_justos($stock_actual) ?> <?php echo $productos['UnidadMedida'];?></td>
					</tr>
				<?php } } ?>         
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
} else {
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
								<a href="<?php echo $location.'&order_by=bodega_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
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
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $location.'&idBodega='.$tipo['idBodega']; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
