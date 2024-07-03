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
$original = "informe_aguas_consumo_historico_01.php";
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
	/**********************************************************/
	//Variable de busqueda
	$search = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	//Se aplican los filtros
	if(isset($_GET['Ano']) && $_GET['Ano']!=''){        	 $search .= '&Ano='.$_GET['Ano'];}
	if(isset($_GET['idMes']) && $_GET['idMes']!=''){    	 $search .= '&idMes='.$_GET['idMes'];}
	if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){ $search .= '&idCliente='.$_GET['idCliente'];}
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	aguas_facturacion_listado_detalle.Ano,
	aguas_facturacion_listado_detalle.DetalleConsumoCantidad,
	aguas_facturacion_listado_detalle.DetalleRecoleccionCantidad,
	core_tiempo_meses.Nombre AS Mes,
	aguas_clientes_listado.Identificador AS ClienteIdentificador,
	aguas_clientes_listado.Nombre AS ClienteNombre';
	$SIS_join  = '
	LEFT JOIN `core_tiempo_meses`        ON core_tiempo_meses.idMes            = aguas_facturacion_listado_detalle.idMes
	LEFT JOIN `aguas_clientes_listado`   ON aguas_clientes_listado.idCliente   = aguas_facturacion_listado_detalle.idCliente';
	$SIS_where = 'aguas_facturacion_listado_detalle.idFacturacionDetalle!=0';
	if(isset($_GET['Ano']) && $_GET['Ano']!=''){              $SIS_where .= " AND aguas_facturacion_listado_detalle.Ano=".$_GET['Ano'];}
	if(isset($_GET['idMes']) && $_GET['idMes']!=''){          $SIS_where .= " AND aguas_facturacion_listado_detalle.idMes=".$_GET['idMes'];}
	if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){  $SIS_where .= " AND aguas_facturacion_listado_detalle.idCliente=".$_GET['idCliente'];}
	$SIS_order = 'aguas_clientes_listado.Identificador ASC, aguas_facturacion_listado_detalle.Ano ASC, aguas_facturacion_listado_detalle.idMes ASC';
	$arrConsumos = array();
	$arrConsumos = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrConsumos');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
		<a target="new" href="<?php echo 'informe_aguas_consumo_historico_01_to_excel.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5>Consumo Historico</h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Identificador</th>
							<th>Nombre</th>
							<th width="10">Año</th>
							<th width="10">Mes</th>
							<th width="10">Consumo</th>
							<th width="10">Recoleccion</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php
						foreach ($arrConsumos as $fact) {  ?>
							<tr class="odd">
								<td><?php echo $fact['ClienteIdentificador']; ?></td>
								<td><?php echo $fact['ClienteNombre']; ?></td>
								<td><?php echo $fact['Ano']; ?></td>
								<td><?php echo $fact['Mes']; ?></td>
								<td><?php echo cantidades($fact['DetalleConsumoCantidad'], 0); ?></td>
								<td><?php echo cantidades($fact['DetalleRecoleccionCantidad'], 0); ?></td>
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
	//Indico el sistema
	$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Filtro de Busqueda</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($Ano)){        $x1  = $Ano;        }else{$x1  = '';}
					if(isset($idMes)){      $x2  = $idMes;      }else{$x2  = '';}
					if(isset($idCliente)){  $x3  = $idCliente;  }else{$x3  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_n_auto('Año','Ano', $x1, 1, 2016, ano_actual());
					$Form_Inputs->form_select_filter('Mes','idMes', $x2, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
					$Form_Inputs->form_select_filter('Cliente','idCliente', $x2, 1, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'Identificador ASC', $dbConn);

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
