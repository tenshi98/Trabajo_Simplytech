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
$original = "informe_aguas_facturacion_02.php";
$location = $original;
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
if(!empty($_GET['submit_filter'])){
// Se trae un listado con todos los productos
$arrFacturaciones = array();
$query = "SELECT 
aguas_facturacion_listado_detalle.idFacturacionDetalle,
aguas_facturacion_listado_detalle.DetalleTotalAPagar, 
aguas_facturacion_listado_detalle.AguasInfFechaEmision,
aguas_facturacion_listado_detalle.idMes,
aguas_facturacion_listado_detalle.Ano,
aguas_facturacion_listado_detalle.fechaPago,
aguas_facturacion_listado_detalle.montoPago,
aguas_facturacion_listado_detalle.SII_NDoc,
aguas_clientes_facturable.Nombre AS Facturable,
aguas_facturacion_listado_detalle_estado.Nombre AS Estado,
aguas_clientes_listado.Nombre AS Cliente

FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `aguas_facturacion_listado_detalle_estado`  ON aguas_facturacion_listado_detalle_estado.idEstado   = aguas_facturacion_listado_detalle.idEstado
LEFT JOIN `aguas_clientes_facturable`                 ON aguas_clientes_facturable.idFacturable              = aguas_facturacion_listado_detalle.SII_idFacturable
LEFT JOIN `aguas_clientes_listado`                    ON aguas_clientes_listado.idCliente                    = aguas_facturacion_listado_detalle.idCliente

WHERE aguas_facturacion_listado_detalle.idCliente = '".$_GET['idCliente']."'
ORDER BY aguas_facturacion_listado_detalle.Ano DESC, aguas_facturacion_listado_detalle.idMes DESC";
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
array_push( $arrFacturaciones,$row );
} ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Facturaciones del Cliente <strong><?php echo $arrFacturaciones[0]['Cliente']; ?></strong></h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Fecha</th>
						<th>Valor</th>
						<th>Estado</th>
						<th>SII</th>
					</tr>
				</thead>

				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrFacturaciones as $fac) { ?>
						<tr class="odd">
							<td>
								<?php if ($rowlevel['level']>=1){ ?>
									<div class="btn-group" style="width: 35px;" >
										<a href="<?php echo 'view_aguas_facturacion.php?view='.simpleEncode($fac['idFacturacionDetalle'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
									</div>
								<?php } ?>
								<?php echo numero_a_mes($fac['idMes']).' '.$fac['Ano']; ?>
							</td>
							<td align="right"><?php echo  Valores($fac['DetalleTotalAPagar'], 0); ?></td>
							<td><?php echo $fac['Estado'].' ('.fecha_estandar($fac['fechaPago']).' -> '.Valores($fac['montoPago'], 0).')'; ?></td>
							<td><?php echo $fac['Facturable'].' '.$fac['SII_NDoc']; ?></td>
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
} else {
//Filtro dentro de la seleccion	
$z  = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$z .= ' AND idEstado=1'; 
	 
	 ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idCliente)){    $x1  = $idCliente;   }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);

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
