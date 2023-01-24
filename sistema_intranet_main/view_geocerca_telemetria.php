<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){
		$X_Puntero = $_GET['view'];
	} else {
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
// consulto los datos
$SIS_query = 'Nombre';
$SIS_join  = '';
$SIS_where = 'idZona ='.$X_Puntero;
$rowdata = db_select_data (false, $SIS_query, 'telemetria_geocercas', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');

//Se traen las rutas
$SIS_query = 'Latitud, Longitud';
$SIS_join  = '';
$SIS_where = 'idZona ='.$X_Puntero;
$SIS_order = 'idUbicaciones ASC';
$arrZonas = array();
$arrZonas = db_select_array (false, $SIS_query, 'telemetria_geocercas_ubicaciones', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrZonas');

?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Zonas de la geocerca <?php echo $rowdata['Nombre']; ?></h5>
		</header>
		<div class="tab-content">
			<div class="table-responsive">
			
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
							
							var myLatlng = new google.maps.LatLng(-33.4372, -70.6506);
							
							var myOptions = {
								zoom: 18,
								center: myLatlng,
								mapTypeId: google.maps.MapTypeId.SATELLITE
							};
							map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
							map.setTilt(0);
							
							dibuja_zona();

						}
						/* ************************************************************************** */
						function dibuja_zona() {
								<?php
								//Variables con la primera posicion
								$Latitud_x = '';
								$Longitud_x = '';
								?>
								
								var triangleCoords = [
									<?php //recorrer
									foreach ($arrZonas as $puntos) {
										echo '{lat: '.$puntos['Latitud'].', lng: '.$puntos['Longitud'].'},
										';
										if(isset($puntos['Latitud'])&&$puntos['Latitud']!='0'){
											$Latitud_x = $puntos['Latitud'];
											$Longitud_x = $puntos['Longitud'];
										}
									}
									if(isset($Longitud_x)&&$Longitud_x!=''){
										echo '{lat: '.$Latitud_x.', lng: '.$Longitud_x.'}'; 
									}?>
								];
							
								// Construct the polygon.
								var bermudaTriangle = new google.maps.Polygon({
									paths: triangleCoords,
									strokeColor: '#FF0000',
									strokeOpacity: 0.8,
									strokeWeight: 2,
									fillColor: '#FF0000',
									fillOpacity: 0.35
								});
								bermudaTriangle.setMap(map);
									
								<?php
								if(isset($Latitud_x)&&$Latitud_x!=''&&isset($Longitud_x)&&$Longitud_x!=''){
									echo 'marker.setPosition(new google.maps.LatLng('.$Latitud_x.', '.$Longitud_x.'));
										  map.panTo(marker.position);'; 
								}?>

							}
							
							
						/* ************************************************************************** */
						google.maps.event.addDomListener(window, "load", initialize());

					</script>

		
				<?php } ?>
			</div>
		</div>
 
	</div>
</div>


<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }
} ?>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
