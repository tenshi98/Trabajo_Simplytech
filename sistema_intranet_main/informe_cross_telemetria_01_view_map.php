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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Numero del sensor
$NSensor = 1;
/**********************************************************/
$query = "SELECT 
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLatitud,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLongitud,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$NSensor." AS CantidadMuestra,

telemetria_listado.Nombre AS EquipoNombre,
cross_predios_listado.Nombre AS PredioNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre

					

FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `cross_predios_listado_zonas`   ON cross_predios_listado_zonas.idZona     = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idZona
LEFT JOIN `cross_predios_listado`         ON cross_predios_listado.idPredio         = cross_predios_listado_zonas.idPredio
LEFT JOIN `telemetria_listado`            ON telemetria_listado.idTelemetria        = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

WHERE telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla=".$_GET['idTabla']."


";
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
$rowdata = mysqli_fetch_assoc ($resultado);





?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['EquipoNombre']; ?></h5>
						
		</header>
		<div class="table-responsive">
			<?php 
			//Si no existe una ID se utiliza una por defecto
			if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
				echo '<p>No ha ingresado Una API de Google Maps</p>';
			}else{
				$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>
				<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>
				<script type="text/javascript">
					function initialize() {
						var myLatlng = new google.maps.LatLng(<?php echo $rowdata['GeoLatitud'] ?>, <?php echo $rowdata['GeoLongitud'] ?>);
						var mapOptions = {
							zoom: 15,
							scrollwheel: false,
							center: myLatlng,
							mapTypeId: google.maps.MapTypeId.SATELLITE
						}
						var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
								
						// marker position
						var factory = new google.maps.LatLng(<?php echo $rowdata['GeoLatitud'] ?>, <?php echo $rowdata['GeoLongitud'] ?>);
								
						// InfoWindow content
						var content = '<div id="iw-container">' +
										'<div class="iw-title">Mediciones</div>' +
										'<div class="iw-content">'+
											'<img src="upload/tel_fot_<?php echo $_GET['idTelemetria'].'_'.$rowdata['idTabla'].'.jpg'; ?>" alt="foto"> '+
											'<p>'+
												'<strong>Equipo: </strong><?php echo $rowdata['EquipoNombre']; ?><br/>' +
												'<strong>Predio: </strong><?php echo $rowdata['PredioNombre']; ?><br/>' +
												'<strong>Cuartel: </strong><?php echo $rowdata['CuartelNombre']; ?><br/>' +
												'<strong>Fecha: </strong><?php echo fecha_estandar($rowdata['FechaSistema']).' - '.$rowdata['HoraSistema']; ?><br/>' +
												'<strong>Cantidad: </strong><?php echo $rowdata['CantidadMuestra']; ?><br/>' +
											'</p>' +
										'</div>' +
										'<div class="iw-bottom-gradient"></div>' +
										'</div>';
											

			
						// A new Info Window is created and set content
						var infowindow = new google.maps.InfoWindow({
							content: content,
							maxWidth: 350
						});	   
										
						// marker options
						var marker = new google.maps.Marker({
							position	: factory,
							map			: map,
							title		: "Direccion",
							animation 	: google.maps.Animation.DROP,
							icon      	: "<?php echo DB_SITE ?>/LIB_assets/img/map-icons/1_series_red.png"
						});
						
						// This event expects a click on a marker
						// When this event is fired the Info Window is opened.
						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map,marker);
						});
						
						// Event that closes the Info Window with a click on the map
						google.maps.event.addListener(map, 'click', function() {
							infowindow.close();
						});

						// *
						// START INFOWINDOW CUSTOMIZE.
						// The google.maps.event.addListener() event expects
						// the creation of the infowindow HTML structure 'domready'
						// and before the opening of the infowindow, defined styles are applied.
						// *
						google.maps.event.addListener(infowindow, 'domready', function() {

							// Reference to the DIV that wraps the bottom of infowindow
							var iwOuter = $('.gm-style-iw');

							/* Since this div is in a position prior to .gm-div style-iw.
							* We use jQuery and create a iwBackground variable,
							* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
							*/
							var iwBackground = iwOuter.prev();

							// Removes background shadow DIV
							iwBackground.children(':nth-child(2)').css({'display' : 'none'});

							// Removes white background DIV
							iwBackground.children(':nth-child(4)').css({'display' : 'none'});

							// Moves the infowindow 25px to the right.
							//iwOuter.parent().parent().css({left: '5px'});

							// Moves the shadow of the arrow 76px to the left margin.
							iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 6px !important;'});

							// Moves the arrow 76px to the left margin.
							iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 6px !important;'});

							// Changes the desired tail shadow color.
							iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

							// Reference to the div that groups the close button elements.
							var iwCloseBtn = iwOuter.next();

							// Apply the desired effect to the close button
							iwCloseBtn.css({width: '28px',height: '28px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

							// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
							if($('.iw-content').height() < 140){
								$('.iw-bottom-gradient').css({display: 'none'});
							}

							// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
							iwCloseBtn.mouseout(function(){
								$(this).css({opacity: '1'});
							});
						});
										
						//muestro la infowindow al inicio
						infowindow.open(map,marker);
								
						//centralizo el mapa en base al ultimo dato obtenido
						map.panTo(marker.getPosition());
								
										
					}  
				</script>
				<div id="map_canvas" style="width:100%; height:500px">
					<script type="text/javascript">initialize();</script>
				</div>
				  
			<?php } ?>
		</div>	
	</div>
</div>



<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
 
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
