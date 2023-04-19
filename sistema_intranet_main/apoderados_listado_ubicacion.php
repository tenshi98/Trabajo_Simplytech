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
$original = "apoderados_listado.php";
$location = $original;
$new_location = "apoderados_listado_ubicacion.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit'])){
	//se agregan ubicaciones
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Ruta Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Ruta Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Ruta Borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'Nombre,ApellidoPat, ApellidoMat, Direccion, GeoLatitud, GeoLongitud , idOpciones_1,idOpciones_2';
$SIS_join  = '';
$SIS_where = 'idApoderado = '.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'apoderados_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Apoderado', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat'], 'Editar Ruta'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'apoderados_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'apoderados_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class="active"><a href="<?php echo 'apoderados_listado_ubicacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> Ubicacion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'apoderados_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
						<?php
						//Si se utiliza la APP
						if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>
							<li class=""><a href="<?php echo 'apoderados_listado_subcuentas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sitemap" aria-hidden="true"></i> Subcuentas</a></li>
						<?php } ?>
						<?php
						//Si se utiliza subcuentas
						if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
							<li class=""><a href="<?php echo 'apoderados_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'apoderados_listado_hijos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-child" aria-hidden="true"></i> Hijos</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contrato</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>

					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">

			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="row">
					<?php
					//Si no existe una ID se utiliza una por defecto
					if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
						$Alert_Text  = 'No ha ingresado Una API de Google Maps.';
						alert_post_data(4,2,2, $Alert_Text);
					}else{
						$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>

						<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>

						<div id="map_canvas" style="width: 100%; height: 550px;"></div>
						<script>

							var map;
							var marker;
							/* ************************************************************************** */
							function initialize() {
								<?php if(isset($rowdata['GeoLatitud'])&&$rowdata['GeoLatitud']!=0&&isset($rowdata['GeoLongitud'])&&$rowdata['GeoLongitud']!=0){ ?>
									var myLatlng = new google.maps.LatLng(<?php echo $rowdata['GeoLatitud']; ?>, <?php echo $rowdata['GeoLongitud']; ?>);
								<?php }else{ ?>
									var myLatlng = new google.maps.LatLng(-33.477271996598965, -70.65170304882815);
								<?php } ?>

								var myOptions = {
									zoom: 12,
									center: myLatlng,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								};
								map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

								marker = new google.maps.Marker({
									draggable	: true,
									position	: myLatlng,
									map			: map,
									title		: "Tu Ubicacion",
									animation 	:google.maps.Animation.DROP,
									icon      	:"<?php echo DB_SITE_REPO ?>/LIB_assets/img/map-icons/1_series_orange.png"
								});

								google.maps.event.addListener(marker, 'dragend', function (event) {

									document.getElementById("GeoLatitud").value = event.latLng.lat();
									document.getElementById("GeoLongitud").value = event.latLng.lng();

									document.getElementById("Latitud_fake").value = event.latLng.lat();
									document.getElementById("Longitud_fake").value = event.latLng.lng();

								});

							}

							/* ************************************************************************** */
							google.maps.event.addDomListener(window, "load", initialize());
						</script>
					<?php } ?>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div style="margin-top:20px;">
					<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

						<?php
						//Se dibujan los inputs
						$Form_Inputs = new Form_Inputs();
						$Form_Inputs->form_input_disabled( 'Latitud', 'Latitud_fake', $rowdata['GeoLatitud']);
						$Form_Inputs->form_input_disabled( 'Longitud', 'Longitud_fake', $rowdata['GeoLongitud']);

						$Form_Inputs->form_input_hidden('GeoLatitud', $rowdata['GeoLatitud'], 2);
						$Form_Inputs->form_input_hidden('GeoLongitud', $rowdata['GeoLongitud'], 2);
						$Form_Inputs->form_input_hidden('idApoderado', $_GET['id'], 2);
						?>

						<div class="form-group">
							<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Ubicacion" name="submit">
						</div>

					</form>
					<?php widget_validator(); ?>

				</div>
			</div>

		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
