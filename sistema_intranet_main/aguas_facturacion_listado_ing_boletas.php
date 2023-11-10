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
$original = "aguas_facturacion_listado_ing_boletas.php";
$location = $original;
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit_boleta'])){
	//Llamamos al formulario
	$form_trabajo= 'updt_boleta';
	require_once 'A1XRXS_sys/xrxs_form/aguas_facturacion_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Medicion Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Medicion Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Medicion Borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['submit_filter'])){

/*******************************************************/
// consulto los datos
$SIS_query = '
aguas_facturacion_listado_detalle.idFacturacionDetalle,
aguas_facturacion_listado_detalle.ClienteIdentificador,
aguas_facturacion_listado_detalle.ClienteNombre,
aguas_facturacion_listado_detalle.SII_NDoc,
aguas_facturacion_listado_detalle.Fecha,
aguas_clientes_facturable.Nombre AS DocFacturable';
$SIS_join  = 'LEFT JOIN `aguas_clientes_facturable` ON aguas_clientes_facturable.idFacturable = aguas_facturacion_listado_detalle.SII_idFacturable';
$SIS_where = 'aguas_facturacion_listado_detalle.idFacturacion = '.$_GET['idFacturacion'];
$SIS_order = 'aguas_facturacion_listado_detalle.ClienteIdentificador ASC';
$arrFacturacion = array();
$arrFacturacion = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrFacturacion');

//se dibujan los inputs
$Form_Inputs = new Inputs();

?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box dark">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Ingreso Numeros de Boletas de <?php echo fecha_estandar($arrFacturacion[0]['Fecha']) ?></h5>
			</header>
			<div class="body">

				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Identificador'); ?>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Cliente'); ?>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'Documento'); ?>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nopadding">
							<?php $Form_Inputs->form_tittle(6, 'N° Documento'); ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php
					$NClientes = 0;
					foreach ($arrFacturacion as $cli) {
						$NClientes++;
						?>
						<div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_disabled('text', 'Identificador', 'Identificador_'.$NClientes, $cli['ClienteIdentificador'], 1); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_disabled('text', 'Cliente', 'Cliente_'.$NClientes, $cli['ClienteNombre'], 1); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_disabled('text', 'Documento', 'Documento_'.$NClientes, $cli['DocFacturable'], 1); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nopadding">
								<div class="form-group">
									<?php $Form_Inputs->input_number('N° Doc','SII_NDoc_'.$NClientes, $cli['SII_NDoc'], 2); ?>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<?php
						$Form_Inputs->input_hidden('idFacturacionDetalle_'.$NClientes, $cli['idFacturacionDetalle'], 2);

					}
					$Form_Inputs->input_hidden('NClientes', $NClientes, 2);
					$Form_Inputs->input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);

					?>

					<div class="form-group" style="margin-top:10px;">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar" name="submit_boleta">
						<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//filtro por sistema
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Seleccionar Facturacion</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idFacturacion)){   $x1  = $idFacturacion;  }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Facturacion','idFacturacion', $x1, 2, 'idFacturacion', 'Fecha', 'aguas_facturacion_listado', $z, 'ORDER BY Fecha DESC', $dbConn);

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
