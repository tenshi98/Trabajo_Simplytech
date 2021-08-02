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
// Se traen todos los datos de mi usuario
$arrTractores = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_tractores.idTelemetria,
telemetria_listado.cantSensores
		
FROM `cross_solicitud_aplicacion_listado_tractores`
LEFT JOIN `telemetria_listado`     ON telemetria_listado.idTelemetria    = cross_solicitud_aplicacion_listado_tractores.idTelemetria
WHERE cross_solicitud_aplicacion_listado_tractores.idSolicitud = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTractores,$row );
}



					
/*****************************************/	
//Variable para almacenar los recorridos
$rec_x = '';			
//Recorro las mediciones
foreach ($arrTractores as $trac) {
	/***************************************/
	$aa = '';
	$aa .= ',FechaSistema';
	$aa .= ',HoraSistema';
	$aa .= ',GeoLatitud';
	$aa .= ',GeoLongitud';
	$aa .= ',GeoMovimiento';
	$aa .= ',GeoVelocidad';
	//se recorre deacuerdo a la cantidad de sensores
	for ($i = 1; $i <= $trac['cantSensores']; $i++) { 
		$aa .= ',Sensor_'.$i;
	}
	$arrMediciones = array();
	$query = "SELECT idTabla
	".$aa."					
	FROM `telemetria_listado_tablarelacionada_".$trac['idTelemetria']."`
	WHERE idSolicitud = ".$X_Puntero." AND idZona!=0 
	ORDER BY FechaSistema ASC, HoraSistema ASC ";
								
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrMediciones,$row );
	}
	//recorro los resultados
	foreach ($arrMediciones as $med) {
		//if(isset($med['GeoLatitud'])&&$med['GeoLatitud']!=0&&isset($med['GeoLongitud'])&&$med['GeoLongitud']!=0&&($med['Sensor_1']>1 OR $med['Sensor_2']>1)){
		if(isset($med['GeoLatitud'])&&$med['GeoLatitud']!=0&&isset($med['GeoLongitud'])&&$med['GeoLongitud']!=0){
			$pres = $med['Sensor_1'] + $med['Sensor_2'];
			$rec_x .= '{location: new google.maps.LatLng('.$med['GeoLatitud'].', '.$med['GeoLongitud'].'), weight: '.$pres.'},
			';
		}
	}
	
	
}

				
//Se traen las rutas
$arrZonas = array();
$query = "SELECT 
cross_predios_listado_zonas.idZona,
cross_predios_listado_zonas.Nombre,
cross_predios_listado_zonas_ubicaciones.Latitud,
cross_predios_listado_zonas_ubicaciones.Longitud

FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `cross_predios_listado_zonas`               ON cross_predios_listado_zonas.idPredio             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `cross_predios_listado_zonas_ubicaciones`   ON cross_predios_listado_zonas_ubicaciones.idZona   = cross_predios_listado_zonas.idZona
WHERE cross_solicitud_aplicacion_listado.idSolicitud = ".$X_Puntero."
ORDER BY cross_predios_listado_zonas.idZona ASC, 
cross_predios_listado_zonas_ubicaciones.idUbicaciones ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrZonas,$row );
}

//Se obtiene la ubicacion
$Ubicacion = "";
if(isset($arrZonas[0]['Direccion'])&&$arrZonas[0]['Direccion']!=''){ $Ubicacion.=' '.$arrZonas[0]['Direccion'];}
if(isset($arrZonas[0]['Comuna'])&&$arrZonas[0]['Comuna']!=''){       $Ubicacion.=', '.$arrZonas[0]['Comuna'];}
if(isset($arrZonas[0]['Ciudad'])&&$arrZonas[0]['Ciudad']!=''){       $Ubicacion.=', '.$arrZonas[0]['Ciudad'];}


//Se limpian los nombres
$Ubicacion = str_replace('Nº', '', $Ubicacion);
$Ubicacion = str_replace('nº', '', $Ubicacion);
$Ubicacion = str_replace(' n ', '', $Ubicacion);
	
$Ubicacion = str_replace("'", '', $Ubicacion);
	
$Ubicacion = str_replace("Av.", 'Avenida', $Ubicacion);
$Ubicacion = str_replace("av.", 'Avenida', $Ubicacion);

?>

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Resumen Solicitud de Aplicacion N° <?php echo n_doc(simpleDecode($_GET['NSolicitud'], fecha_actual()), 5); ?>.
			</h2>
		</div>   
	</div>
	
	
	
	<div class="row">
		<div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<?php
			//Si no existe una ID se utiliza una por defecto
			if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
				$Alert_Text  = 'No ha ingresado Una API de Google Maps.';
				alert_post_data(4,2,2, $Alert_Text);
			}else{
				$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>
				<style>
					.my_marker {color: white;background-color: black;border: solid 1px black;font-weight: 900;padding: 4px;top: -8px;}
					.my_marker::after {content: "";position: absolute;top: 100%;left: 50%;transform: translate(-50%, 0%);border: solid 8px transparent;border-top-color: black;}
				</style>
			
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false&libraries=visualization"></script>
				<div id="map_canvas" style="width: 100%; height: 550px;"></div>
				<script>
					
					/* ************************************************************************** */
					/*class MyMarker extends google.maps.OverlayView {
						constructor(params) {
							super();
							this.position = params.position;

							const content = document.createElement('div');
							content.classList.add('my_marker');
							content.textContent = params.label;
							content.style.position = 'absolute';
							content.style.transform = 'translate(-50%, -100%)';

							const container = document.createElement('div');
							container.style.position = 'absolute';
							container.style.cursor = 'pointer';
							container.appendChild(content);

							this.container = container;
						}

						onAdd() {
							this.getPanes().floatPane.appendChild(this.container);
						}

						onRemove() {
							this.container.remove();
						}

						draw() {
							const pos = this.getProjection().fromLatLngToDivPixel(this.position);
							this.container.style.left = pos.x + 'px';
							this.container.style.top = pos.y + 'px';
						}
					}
  
					/* ************************************************************************** */
					var map;
					var marker;
					/* ************************************************************************** */
					function initialize() {
						var myLatlng = new google.maps.LatLng(<?php echo $arrZonas[0]['Latitud']; ?>, <?php echo $arrZonas[0]['Longitud']; ?>);

						var myOptions = {
							zoom: 15,
							center: myLatlng,
							mapTypeId: google.maps.MapTypeId.SATELLITE
						};
						map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
						
						//Se dibujan los puntos en base a los niveles de riego
						/* Data points defined as a mixture of WeightedLocation and LatLng objects */
						var heatMapData = [<?php echo $rec_x; ?>];

						var heatmap = new google.maps.visualization.HeatmapLayer({
							data: heatMapData,
							map: map
						});
						heatmap.setMap(map);
						dibuja_zona();
						

					}
					/* ************************************************************************** */
					function dibuja_zona() {
								
						var polygons = [];
						<?php 
						//variables
						$Latitud_z       = 0;
						$Longitud_z      = 0;
						$Latitud_z_prom  = 0;
						$Longitud_z_prom = 0;
						$zcounter        = 0;
						$zcounter2        = 0;
									
						//Se filtra por zona
						filtrar($arrZonas, 'idZona');
						//se recorre
						foreach ($arrZonas as $todaszonas=>$zonas) {
							
							$Latitud_z_2       = 0;
							$Longitud_z_2      = 0;
							$Latitud_z_prom_2  = 0;
							$Longitud_z_prom_2 = 0;
							$zcounter3         = 0;		
							echo 'var path'.$todaszonas.' = [';

							//Variables con la primera posicion
							$Latitud_x = '';
							$Longitud_x = '';
									
							foreach ($zonas as $puntos) {
								if(isset($puntos['Latitud'])&&$puntos['Latitud']!=''&&isset($puntos['Longitud'])&&$puntos['Longitud']!=''){
									echo '{lat: '.$puntos['Latitud'].', lng: '.$puntos['Longitud'].'},
									';
									if(isset($puntos['Latitud'])&&$puntos['Latitud']!='0'&&isset($puntos['Longitud'])&&$puntos['Longitud']!='0'){	
										$Latitud_x  = $puntos['Latitud'];
										$Longitud_x = $puntos['Longitud'];
										//Calculos para centrar mapa
										$Latitud_z    = $Latitud_z+$puntos['Latitud'];
										$Longitud_z   = $Longitud_z+$puntos['Longitud'];
										$Latitud_z_2  = $Latitud_z_2+$puntos['Latitud'];
										$Longitud_z_2 = $Longitud_z_2+$puntos['Longitud'];
										$zcounter++;
										$zcounter3++;
									}
								}
							}
									
							if(isset($Longitud_x)&&$Longitud_x!=''){
								echo '{lat: '.$Latitud_x.', lng: '.$Longitud_x.'}'; 
							}
									
							echo '];';
									
							echo '
							polygons.push(new google.maps.Polygon({
								paths: path'.$todaszonas.',
								strokeColor: \'#FF0000\',
								strokeOpacity: 0.8,
								strokeWeight: 2,
								fillColor: \'#FF0000\',
								fillOpacity: 0.35
							}));
							polygons[polygons.length-1].setMap(map);
							';	
							/*if($zcounter3!=0){
								$Latitud_z_prom_2  = $Latitud_z_2/$zcounter3;
								$Longitud_z_prom_2 = $Longitud_z_2/$zcounter3;
							}*/
							// The label that pops up when the mouse moves within each polygon.
							echo '
							/*myLatlng = new google.maps.LatLng('.$Latitud_z_prom_2.', '.$Longitud_z_prom_2.');
									
							var marker = new MyMarker({
								position: myLatlng,
								label: "'.$zonas[0]['Nombre'].'"
							});
							marker.setMap(map);*/
  
							// When the mouse moves within the polygon, display the label and change the BG color.
							google.maps.event.addListener(polygons['.$zcounter2.'], "mousemove", function(event) {
								polygons['.$zcounter2.'].setOptions({
									fillColor: "#00FF00"
								});
							});

							// WHen the mouse moves out of the polygon, hide the label and change the BG color.
							google.maps.event.addListener(polygons['.$zcounter2.'], "mouseout", function(event) {
								polygons['.$zcounter2.'].setOptions({
									fillColor: "#FF0000"
								});
							});
							';
									
							$zcounter2++;		
						}
								
						//Centralizado del mapa
						if($zcounter!=0){
							$Latitud_z_prom  = $Latitud_z/$zcounter;
							$Longitud_z_prom = $Longitud_z/$zcounter;
										
							if(isset($Latitud_z_prom)&&$Latitud_z_prom!=0&&isset($Longitud_z_prom)&&$Longitud_z_prom!=0){
									echo 'myLatlng = new google.maps.LatLng('.$Latitud_z_prom.', '.$Longitud_z_prom.');
											map.setCenter(myLatlng);'; 
							}else{ 
								echo 'codeAddress();';
							}
						}
						?>
						
						
					}
					/* ************************************************************************** */
					function codeAddress() {
						  
						geocoder.geocode( { address: '<?php echo $Ubicacion ?>'}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
										
								// marker position
								myLatlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
								
								map.setCenter(myLatlng);
								//marker.setPosition(myLatlng);  
														  
							} else {
								alert('Geocode was not successful for the following reason: ' + status);
							}
						});
					}
					/* ************************************************************************** */
					google.maps.event.addDomListener(window, "load", initialize());
				</script>
			<?php } ?>
		</div>
	</div>
      
</section>

<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
