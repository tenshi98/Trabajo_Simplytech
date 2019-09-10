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
// Se traen todos los datos de mi usuario
$query = "SELECT 
cross_predios_listado.Nombre,
cross_predios_listado.Direccion,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna

FROM `cross_predios_listado`
LEFT JOIN `core_ubicacion_ciudad`                    ON core_ubicacion_ciudad.idCiudad                  = cross_predios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`                   ON core_ubicacion_comunas.idComuna                 = cross_predios_listado.idComuna
WHERE cross_predios_listado.idPredio = {$_GET['view']}";

//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$rowdata = mysqli_fetch_assoc ($resultado);

//Se traen las rutas
$arrZonas = array();
$query = "SELECT 
cross_predios_listado_zonas.idZona,
cross_predios_listado_zonas.Nombre,
cross_predios_listado_zonas_ubicaciones.Latitud,
cross_predios_listado_zonas_ubicaciones.Longitud,
cross_predios_listado.Direccion,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna

FROM `cross_predios_listado_zonas`
LEFT JOIN `cross_predios_listado_zonas_ubicaciones`  ON cross_predios_listado_zonas_ubicaciones.idZona  = cross_predios_listado_zonas.idZona
LEFT JOIN `cross_predios_listado`                    ON cross_predios_listado.idPredio                  = cross_predios_listado_zonas.idPredio
LEFT JOIN `core_ubicacion_ciudad`                    ON core_ubicacion_ciudad.idCiudad                  = cross_predios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`                   ON core_ubicacion_comunas.idComuna                 = cross_predios_listado.idComuna

WHERE cross_predios_listado_zonas.idPredio = {$_GET['view']}
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
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrZonas,$row );
}

//Se obtiene la ubicacion
$Ubicacion = "";
if(isset($arrZonas[0]['Direccion'])&&$arrZonas[0]['Direccion']!=''){ $Ubicacion.=' '.$arrZonas[0]['Direccion'];}
if(isset($arrZonas[0]['Comuna'])&&$arrZonas[0]['Comuna']!=''){       $Ubicacion.=', '.$arrZonas[0]['Comuna'];}
if(isset($arrZonas[0]['Ciudad'])&&$arrZonas[0]['Ciudad']!=''){       $Ubicacion.=', '.$arrZonas[0]['Ciudad'];}
//Si los puntos no existen
if(isset($Ubicacion)&&$Ubicacion==''){
	if(isset($rowdata['Direccion'])&&$rowdata['Direccion']!=''){ $Ubicacion.=' '.$rowdata['Direccion'];}
	if(isset($rowdata['Comuna'])&&$rowdata['Comuna']!=''){       $Ubicacion.=', '.$rowdata['Comuna'];}
	if(isset($rowdata['Ciudad'])&&$rowdata['Ciudad']!=''){       $Ubicacion.=', '.$rowdata['Ciudad'];}

}

//Se limpian los nombres
$Ubicacion = str_replace('Nº', '', $Ubicacion);
$Ubicacion = str_replace('nº', '', $Ubicacion);
$Ubicacion = str_replace(' n ', '', $Ubicacion);
	
$Ubicacion = str_replace("'", '', $Ubicacion);
	
$Ubicacion = str_replace("Av.", 'Avenida', $Ubicacion);
$Ubicacion = str_replace("av.", 'Avenida', $Ubicacion);


?>


<div class="col-sm-12">
	<div class="box">
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Zonas del Predio <?php echo $rowdata['Nombre']; ?></h5>
		</header>
		<div class="tab-content">
			<div class="table-responsive">
			
					<?php
					//Si no existe una ID se utiliza una por defecto
					if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
						echo '<p>No ha ingresado Una API de Google Maps</p>';
					}else{
						$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>
					<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>
					<div id="map_canvas" style="width: 100%; height: 550px;"></div>
					<script>
						
						var map;
						var marker;
						/* ************************************************************************** */
						function initialize() {
							
							var myLatlng = new google.maps.LatLng(-33.4372, -70.6506);
							
							var myOptions = {
								zoom: 15,
								center: myLatlng,
								mapTypeId: google.maps.MapTypeId.SATELLITE
							};
							map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
							map.setTilt(0); 
							
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
								
							//Se filtra por zona
							filtrar($arrZonas, 'idZona');
							//se recorre
							foreach ($arrZonas as $todaszonas=>$zonas) {
								
								echo 'var path'.$todaszonas.' = [';

								//Variables con la primera posicion
								$Latitud_x = '';
								$Longitud_x = '';
								
								foreach ($zonas as $puntos) {
									if(isset($puntos['Latitud'])&&$puntos['Latitud']!=''&&isset($puntos['Longitud'])&&$puntos['Longitud']!=''){
										echo '{lat: '.$puntos['Latitud'].', lng: '.$puntos['Longitud'].'},
										';
										if(isset($puntos['Latitud'])&&$puntos['Latitud']!='0'&&isset($puntos['Longitud'])&&$puntos['Longitud']!='0'){
											$Latitud_x = $puntos['Latitud'];
											$Longitud_x = $puntos['Longitud'];
											//Calculos para centrar mapa
											$Latitud_z  = $Latitud_z+$puntos['Latitud'];
											$Longitud_z = $Longitud_z+$puntos['Longitud'];
											$zcounter++;
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
								
								
									
							}
							
							//Centralizado del mapa
							$Latitud_z_prom  = $Latitud_z/$zcounter;
							$Longitud_z_prom = $Longitud_z/$zcounter;
								
							if(isset($Latitud_z_prom)&&$Latitud_z_prom!=0&&isset($Longitud_z_prom)&&$Longitud_z_prom!=0){
									echo 'myLatlng = new google.maps.LatLng('.$Latitud_z_prom.', '.$Longitud_z_prom.');
											map.setCenter(myLatlng);'; 
							}else{ 
								echo 'codeAddress();';
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
