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
//Cargamos la ubicacion 
$original = "informe_backup_telemetria_registro_ruta_2.php";
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
if ( ! empty($_GET['submit_filter']) ) { 
//se verifica si se ingreso la hora, es un dato optativo
$z='';
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" WHERE (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
//solo mostrar aplicaciones
if(isset($_GET['idOpciones'])&&$_GET['idOpciones']!=''&&$_GET['idOpciones']==1){
	$z.=" AND (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_1!=0 OR backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_2!=0)";
}

//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLatitud,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLongitud,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoVelocidad,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_1,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_2,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_3

FROM `backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

".$z."
ORDER BY backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema ASC
LIMIT 10000";
  
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
array_push( $arrRutas,$row );
}


?>	

<?php if($arrRutas){ 
/*****************************************/	
//Variable para almacenar los recorridos
$arrMedTractores = array();	
//recorro los resultados
foreach ($arrRutas as $med) {
	//Guardo los datos temporales
	$arrMedTractores['caudales']     .= '["'.$med['HoraSistema'].'",'.Cantidades_decimales_justos($med['Sensor_1']).','.Cantidades_decimales_justos($med['Sensor_2']).'],';
	$arrMedTractores['niveles']      .= '["'.$med['HoraSistema'].'",'.Cantidades_decimales_justos($med['Sensor_3']).',],';
	$arrMedTractores['velocidades']  .= '["'.$med['HoraSistema'].'", '.Cantidades_decimales_justos($med['GeoVelocidad']).'],';

}

					
?>
	
	
	
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Ruta</h5>	
			</header>
			<div class="table-responsive">
				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">google.charts.load('current', {'packages':['bar', 'corechart', 'table', 'gauge']});</script>	
		
				<div class="col-sm-12">
					<div class="row">
						<?php
						//Si no existe una ID se utiliza una por defecto
						if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
							$Alert_Text  = 'No ha ingresado Una API de Google Maps.';
							alert_post_data(4,2,2, $Alert_Text);
						}else{
							$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; 
							
							/********************************************************************/
							//solo mostrar aplicaciones
							if(isset($_GET['idOpciones'])&&$_GET['idOpciones']!=''&&$_GET['idOpciones']==1){
								/********************************************************************/
								//Caudales
								echo '
								<script>				
									google.charts.setOnLoadCallback(drawChart_caudales);

									function drawChart_caudales() {
										var data_caud = new google.visualization.DataTable();
										data_caud.addColumn("string", "Hora"); 
										data_caud.addColumn("number", "Caudal Derecho");
										data_caud.addColumn("number", "Caudal Izquierdo"); 
										
										data_caud.addRows(['.$arrMedTractores['caudales'].']);

										var options1 = {
											title: "Grafico Caudal / Homogeneidad de '.$arrRutas[0]['NombreEquipo'].'",
											hAxis: {title: "Hora"},
											vAxis: { title: "Litros * Minutos" },
											width: $(window).width()*0.95,
											height: 300,
											curveType: "function",
											colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
										};
										var chart1 = new google.visualization.LineChart(document.getElementById("chart_caudales"));
											chart1.draw(data_caud, options1);
									}
								</script> 
								<div id="chart_caudales" style="height: 300px; width: 100%;"></div>';
								
								/********************************************************************/
								//Nivel Estanque
								echo '
								<script>				
									google.charts.setOnLoadCallback(drawChart_niveles);

									function drawChart_niveles() {
										var data_niveles = new google.visualization.DataTable();
										data_niveles.addColumn("string", "Hora"); 
										data_niveles.addColumn("number", "Nivel Estanque");
										
										data_niveles.addRows(['.$arrMedTractores['niveles'].']);

										var options2 = {
											title: "Grafico Nivel Estanque de '.$arrRutas[0]['NombreEquipo'].'",
											hAxis: {title: "Hora"},
											vAxis: { title: "% de llenado" },
											width: $(window).width()*0.95,
											height: 300,
											curveType: "function",
											colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
										};
										var chart2 = new google.visualization.LineChart(document.getElementById("chart_niveles"));
											chart2.draw(data_niveles, options2);
									}
								</script> 
								<div id="chart_niveles" style="height: 300px; width: 100%;"></div>';
								
								/********************************************************************/
								//Velocidades
								echo '
								<script>				
									google.charts.setOnLoadCallback(drawChart_velocidades);

									function drawChart_velocidades() {
										var data_vel = new google.visualization.DataTable();
										data_vel.addColumn("string", "Hora"); 
										data_vel.addColumn("number", "Velocidad");
										
										data_vel.addRows(['.$arrMedTractores['velocidades'].']);

										var options3 = {
											title: "Grafico Velocidades de '.$arrRutas[0]['NombreEquipo'].'",
											hAxis: {title: "Hora"},
											vAxis: { title: "Km * hr" },
											width: $(window).width()*0.95,
											height: 300,
											curveType: "function",
											colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
										};
										var chart3 = new google.visualization.LineChart(document.getElementById("chart_velocidades"));
											chart3.draw(data_vel, options3);
									}
								</script> 
								<div id="chart_velocidades" style="height: 300px; width: 100%;"></div>';

							} ?>
							
							<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>
							
							<div id="map_canvas" style="width: 100%; height: 550px;"></div>
							
							<script>
								
								var map;
								var marker;
								var speed = 500; // km/h
								var delay = 100;
								
								var locations = [ 
									<?php foreach ( $arrRutas as $pos ) { 
										if($pos['GeoLatitud']<0&&$pos['GeoLongitud']<0){?>
										['<?php echo $pos['idTabla']; ?>', <?php echo $pos['GeoLatitud']; ?>, <?php echo $pos['GeoLongitud']; ?>], 					
									<?php } 
									}?>
									];


								/* ************************************************************************** */
								function initialize() {
									
									var myOptions = {
										zoom: 19,
										center: new google.maps.LatLng(locations[0][1], locations[0][2]),
										zoomControl: true,
										scaleControl: false,
										scrollwheel: false,
										disableDoubleClickZoom: true,
										mapTypeId: google.maps.MapTypeId.SATELLITE
									};
									map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
									
									//Se llama a la ruta
									RutasAlternativas();
									//Se llama al marcador y se anima
									marker = new google.maps.Marker({
										position	: new google.maps.LatLng(locations[0][1], locations[0][2]),
										map			: map,
										animation 	: google.maps.Animation.DROP,
										icon      	: "<?php echo DB_SITE_REPO ?>/LIB_assets/img/map-icons/1_series_orange.png"
									});
									
									google.maps.event.addListenerOnce(map, 'idle', function()
									{
										animateMarker(marker, [
											<?php foreach ( $arrRutas as $pos ) { ?>
												[<?php echo $pos['GeoLatitud']; ?>, <?php echo $pos['GeoLongitud']; ?>], 					
											<?php } ?>
										], speed);
									})
							
								}
								
								/* ************************************************************************** */
								function RutasAlternativas() {
									
									var route=[];
									var tmp;
									
									for(var i in locations){
										tmp=new google.maps.LatLng(locations[i][1], locations[i][2]);
										route.push(tmp);
									}
									
									var drawn = new google.maps.Polyline({
										map: map,
										path: route,
										strokeColor: 'blue',
										strokeOpacity: 1,
										strokeWeight: 5
									});
								}
								/* ************************************************************************** */
								function animateMarker(marker, coords, km_h){
									var target = 0;
									var targetx = 0;
									var km_h = km_h || 50;
									coords.push([locations[0][1], locations[0][2]]);
									goToPoint();
									
									function goToPoint(){
										var lat = marker.position.lat();
										var lng = marker.position.lng();
										var step = (km_h * 1000 * delay) / 3600000; // in meters
										
										var dest = new google.maps.LatLng(
										coords[target][0], coords[target][1]);
										
										var distance =
										google.maps.geometry.spherical.computeDistanceBetween(
										dest, marker.position); // in meters
										
										var numStep = distance / step;
										let i = 0;
										var deltaLat = (coords[target][0] - lat) / numStep;
										var deltaLng = (coords[target][1] - lng) / numStep;
										
										function moveMarker(){
											lat += deltaLat;
											lng += deltaLng;
											i += step;
											
											if (i < distance){
												marker.setPosition(new google.maps.LatLng(lat, lng));
												setTimeout(moveMarker, delay);
											}else{   
												if(targetx==0){
													marker.setPosition(dest);
													target++;
													if (target == coords.length){ target = 0; }
													setTimeout(goToPoint, delay);
													targetx=1;
												}
											}
											 
										}
										//centralizo el mapa en base al ultimo dato obtenido
										map.panTo(marker.getPosition());
										//muevo el marcador
										moveMarker();
										
									}
									
								}
								/* ************************************************************************** */
								google.maps.event.addDomListener(window, "load", initialize());
							</script>
				
						<?php } ?>
					</div>
				</div>
				
				
				
			</div>	
		</div>
	</div>
<?php }else{ 
	$Alert_Text  = 'No hay registros relacionados al equipo seleccionado entre las fechas ingresadas';
	alert_post_data(4,2,2, $Alert_Text);
} ?>





<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Filtro de busqueda
$z  = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];   //Sistema
$z .= " AND telemetria_listado.id_Geo=1";                                                //Geolocalizacion activa
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=1";//CrossChecking			
} 
//Se escribe el dato
$Alert_Text  = 'La busqueda esta limitada a 10.000 registros, en caso de necesitar mas registros favor comunicarse con el administrador';
alert_post_data(2,1,1, $Alert_Text);
?>	
		
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Filtro de busqueda</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
               
				<?php 
				//Se verifican si existen los datos
				if(isset($f_inicio)) {      $x1  = $f_inicio;     }else{$x1  = '';}
				if(isset($f_termino)) {     $x2  = $f_termino;    }else{$x2  = '';}
				if(isset($h_inicio)) {      $x3  = $h_inicio;     }else{$x3  = '';}
				if(isset($h_termino)) {     $x4  = $h_termino;    }else{$x4  = '';}
				if(isset($idTelemetria)) {  $x5  = $idTelemetria; }else{$x5  = '';}
				if(isset($idOpciones)) {    $x6  = $idOpciones;   }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Inicio','f_inicio', $x1, 2);
				$Form_Inputs->form_date('Fecha Termino','f_termino', $x2, 2);
				$Form_Inputs->form_time('Hora Inicio','h_inicio', $x3, 1, 1);
				$Form_Inputs->form_time('Hora Termino','h_termino', $x4, 1, 1);
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				$Form_Inputs->form_post_data(1, '<strong>Solo aplicaciones: </strong>Esta opcion se utiliza para mostrar solo las rutas realizadas mientras estaba haciendo una aplicacion (Opcion Si), o toda la ruta que realizo, incluyendo cuando solo se estaba movilizando (Opcion No)');
				$Form_Inputs->form_select('Solo aplicaciones','idOpciones', $x6, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				
				?>        
	   
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter">	
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
