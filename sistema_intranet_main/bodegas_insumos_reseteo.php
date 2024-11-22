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
$original = "bodegas_insumos_reseteo.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_GET['reseteo'])){
	//Llamamos al formulario
	$form_trabajo= 'reset';
	require_once 'A1XRXS_sys/xrxs_form/bodegas_insumos_reseteo.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['idBodega'])){
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	insumos_listado.StockLimite,
	insumos_listado.Nombre AS NombreProd,
	sistema_productos_uml.Nombre AS UnidadMedida,
	(SELECT SUM(Cantidad_ing) FROM bodegas_insumos_facturacion_existencias WHERE idProducto = insumos_listado.idProducto AND idBodega='.$_GET['idBodega'].'  LIMIT 1) AS stock_entrada,
	(SELECT SUM(Cantidad_eg)  FROM bodegas_insumos_facturacion_existencias WHERE idProducto = insumos_listado.idProducto AND idBodega='.$_GET['idBodega'].' LIMIT 1) AS stock_salida,
	(SELECT Nombre FROM bodegas_insumos_listado WHERE idBodega='.$_GET['idBodega'].' LIMIT 1) AS NombreBodega';
	$SIS_join  = 'LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml = insumos_listado.idUml';
	$SIS_where = '';
	$SIS_order = 'insumos_listado.Nombre ASC';
	$arrProductos = array();
	$arrProductos = db_select_array (false, $SIS_query, 'insumos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrProductos');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Insumos de la bodega <?php echo $arrProductos[0]['NombreBodega']; ?></h5>
				<div class="toolbar">
					<?php
					$zz  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
					$zz .= '&reseteo='.$_GET['idBodega'];
					?>
					<a target="new" href="<?php echo $location.$zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-refresh" aria-hidden="true"></i> Resetear</a>
				</div>
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
					<?php foreach ($arrProductos as $productos) { ?>
						<?php $stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
						if ($stock_actual>0){ ?>
							<tr class="odd">
								<td><?php echo $productos['NombreProd']; ?></td>
								<td><?php echo Cantidades_decimales_justos($productos['StockLimite']); ?> <?php echo $productos['UnidadMedida']; ?></td>
								<td><?php echo Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida']; ?></td>
							</tr>
						<?php } ?>
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
	$z="bodegas_insumos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']; 
	//Verifico el tipo de usuario que esta ingresando
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
		$z.=" AND usuarios_bodegas_insumos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	}

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Filtro de Búsqueda</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idBodega)){      $x1  = $idBodega;    }else{$x1  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_join_filter('Bodega','idBodega', $x1, 2, 'idBodega', 'Nombre', 'bodegas_insumos_listado', 'usuarios_bodegas_insumos', $z, $dbConn);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="submit_filter">
					</div>

				</form>
				<?php widget_validator(); ?>
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
