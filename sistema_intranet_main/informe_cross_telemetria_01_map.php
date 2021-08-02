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
//Variable de busqueda
$z = "WHERE telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){   $z .= " AND cross_predios_listado_zonas.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){       $z .= " AND telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idZona=".$_GET['idZona'];}
if(isset($_GET['fecha_desde'])&&$_GET['fecha_desde']!=''&&isset($_GET['fecha_hasta'])&&$_GET['fecha_hasta']!=''){
	$z.=" AND telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['fecha_desde']."' AND '".$_GET['fecha_hasta']."'";
}
/**********************************************************/
//Numero del sensor
$NSensor = 1;
/**********************************************************/
// Se trae un listado con todos los datos separados por tractores
$arrMediciones = array();
$query = "SELECT 
telemetria_listado.Nombre AS EquipoNombre,
cross_predios_listado.Nombre AS PredioNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLatitud,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLongitud,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$NSensor." AS CantidadMuestra					

FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `cross_predios_listado_zonas`   ON cross_predios_listado_zonas.idZona     = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idZona
LEFT JOIN `cross_predios_listado`         ON cross_predios_listado.idPredio         = cross_predios_listado_zonas.idPredio
LEFT JOIN `telemetria_listado`            ON telemetria_listado.idTelemetria        = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

".$z."

GROUP BY cross_predios_listado_zonas.idPredio, 
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idZona,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

ORDER BY cross_predios_listado_zonas.idPredio ASC, 
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idZona ASC,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria ASC

LIMIT 10000
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrMediciones,$row );
}

//Se traen las rutas
$arrPuntos = array();
$query = "SELECT idUbicaciones, Latitud, Longitud
FROM `cross_predios_listado_zonas_ubicaciones`
WHERE idZona = ".$_GET['idZona']."
ORDER BY idUbicaciones ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPuntos,$row );
}

?>

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Resumen Mediciones.
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		<?php echo '
			<div class="col-sm-4 invoice-col">
				<strong>Identificacion</strong>
				<address>
					Equipo: '.$arrMediciones[0]['EquipoNombre'].'<br/>
					Predio: '.$arrMediciones[0]['PredioNombre'].'<br/>
					Cuartel: '.$arrMediciones[0]['CuartelNombre'].'<br/>
				</address>
			</div>';
		?>					
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
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false&libraries=visualization"></script>
											
				<div id="map_canvas" style="width: 100%; height: 550px;"></div>
				
				<script>
					
					var myLatlng = new google.maps.LatLng(<?php echo $arrPuntos[0]['Latitud']; ?>, <?php echo $arrPuntos[0]['Longitud']; ?>);

					var myOptions = {
						zoom: 15,
						center: myLatlng,
						mapTypeId: 'satellite'
					};
					map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
							
					/* Data points defined as a mixture of WeightedLocation and LatLng objects */
					var heatMapData = [
						<?php
						//recorro los resultados
						foreach ($arrMediciones as $med) {
							$pres = $med['CantidadMuestra'];
							echo '{location: new google.maps.LatLng('.$med['GeoLatitud'].', '.$med['GeoLongitud'].'), weight: '.$pres.'},';
						}?>
					];

					var heatmap = new google.maps.visualization.HeatmapLayer({
					  data: heatMapData
					});
					heatmap.setMap(map);
					dibuja_zona();
					/* ************************************************************************** */
					function dibuja_zona() {
								
						var triangleCoords = [
							<?php 
							//Variables con la primera posicion
							$Latitud_x = '';
							$Longitud_x = '';
							//recorrer
							foreach ($arrPuntos as $puntos) {
								echo '{lat: '.$puntos['Latitud'].', lng: '.$puntos['Longitud'].'},
								';
								if(isset($puntos['Latitud'])&&$puntos['Latitud']!='0'){
									$Latitud_x = $puntos['Latitud'];
									$Longitud_x = $puntos['Longitud'];
								}
							}
							//se cierra la figura
							if(isset($Longitud_x)&&$Longitud_x!=''){
								echo '{lat: '.$Latitud_x.', lng: '.$Longitud_x.'}'; 
							}	
							?>
						];
							
								
								
									// Construct the polygon.
									var bermudaTriangle = new google.maps.Polygon({
										paths: triangleCoords,
										strokeColor: '#FF0000',
										strokeOpacity: 0.8,
										strokeWeight: 2,
										fillColor: '#FF0000',
										fillOpacity: 0
									});
									bermudaTriangle.setMap(map);

					}

				</script>
			<?php } ?>
		</div>
	</div>
      
</section>

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
 
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
