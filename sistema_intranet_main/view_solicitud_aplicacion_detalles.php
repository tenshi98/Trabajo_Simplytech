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
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Maqueta</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<style>
			body {background-color: #FFF !important;}
		</style>
	</head>

	<body>
<?php 
//se recorre deacuerdo a la cantidad de sensores
$aa = '';
$Nsens = 6;
for ($i = 1; $i <= $Nsens; $i++) { 
	$aa .= ',cross_solicitud_aplicacion_listado_tractores.Sensor_'.$i.'_Prom';
	$aa .= ',cross_solicitud_aplicacion_listado_tractores.Sensor_'.$i.'_Min';
	$aa .= ',cross_solicitud_aplicacion_listado_tractores.Sensor_'.$i.'_Max';
	$aa .= ',telemetria_listado.SensoresNombre_'.$i.' AS Sensor_'.$i.'_Nombre';
}

// Se traen todos los datos de mi usuario
$query = "SELECT 
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado.f_termino,

cross_predios_listado.Nombre AS PredioNombre,
sistema_variedades_categorias.Nombre AS VariedadCat,
variedades_listado.Nombre AS VariedadNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,
cross_predios_listado_zonas.Plantas AS CuartelCantPlantas,

telemetria_listado.Nombre AS NebNombre,
vehiculos_listado.Nombre AS TractorNombre,
telemetria_listado.cantSensores,
cross_solicitud_aplicacion_listado_tractores.idTractores,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMin,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMax,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadProm,
cross_solicitud_aplicacion_listado_tractores.GeoDistance,
cross_solicitud_aplicacion_listado_tractores.idTelemetria,

cross_solicitud_aplicacion_listado_cuarteles.VelTractor,
cross_solicitud_aplicacion_listado_cuarteles.idZona,
cross_solicitud_aplicacion_listado.f_ejecucion

".$aa."


			
FROM `cross_solicitud_aplicacion_listado_tractores`
LEFT JOIN `cross_solicitud_aplicacion_listado`             ON cross_solicitud_aplicacion_listado.idSolicitud             = cross_solicitud_aplicacion_listado_tractores.idSolicitud
LEFT JOIN `cross_predios_listado`                          ON cross_predios_listado.idPredio                             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `sistema_variedades_categorias`                  ON sistema_variedades_categorias.idCategoria                  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                             ON variedades_listado.idProducto                              = cross_solicitud_aplicacion_listado.idProducto
LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`   ON cross_solicitud_aplicacion_listado_cuarteles.idCuarteles   = cross_solicitud_aplicacion_listado_tractores.idCuarteles
LEFT JOIN `cross_predios_listado_zonas`                    ON cross_predios_listado_zonas.idZona                         = cross_solicitud_aplicacion_listado_cuarteles.idZona
LEFT JOIN `telemetria_listado`                             ON telemetria_listado.idTelemetria                            = cross_solicitud_aplicacion_listado_tractores.idTelemetria
LEFT JOIN `vehiculos_listado`                              ON vehiculos_listado.idVehiculo                               = cross_solicitud_aplicacion_listado_tractores.idVehiculo

WHERE cross_solicitud_aplicacion_listado_tractores.idTractores = {$_GET['view']} ";
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
$row_data = mysqli_fetch_assoc ($resultado);


/***************************************/
$aa = '';
$aa .= ',FechaSistema';
$aa .= ',HoraSistema';
$aa .= ',GeoLatitud';
$aa .= ',GeoLongitud';
$aa .= ',GeoVelocidad';
//se recorre deacuerdo a la cantidad de sensores
for ($i = 1; $i <= $row_data['cantSensores']; $i++) { 
	$aa .= ',Sensor_'.$i;
}
					
/*****************************************/				
//Insumos
$arrMediciones = array();
$query = "SELECT idTabla
".$aa."
					
FROM `telemetria_listado_tablarelacionada_".$row_data['idTelemetria']."`
WHERE idZona = ".$row_data['idZona']." AND idSolicitud = ".$row_data['idSolicitud']." 
ORDER BY FechaSistema ASC, HoraSistema ASC ";
							
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
array_push( $arrMediciones,$row );
}

//Se traen las rutas
$arrPuntos = array();
$query = "SELECT idUbicaciones, Latitud, Longitud
FROM `cross_predios_listado_zonas_ubicaciones`
WHERE idZona = {$row_data['idZona']}
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
				<i class="fa fa-globe"></i> Detalles Solicitud de Aplicacion N°<?php echo n_doc($row_data['idSolicitud'], 7); ?>.
				<small class="pull-right">Fecha Termino: <?php echo Fecha_estandar($row_data['f_termino'])?></small>
			</h2>
		</div>   
	</div>
	
	






	<div class="row invoice-info">
		
		<?php echo '
				<div class="col-sm-4 invoice-col">
					<strong>Identificacion</strong>
					<address>
						Predio: '.$row_data['PredioNombre'].'<br>
						Especie: '.$row_data['VariedadCat'].'<br>
						Variedad: '.$row_data['VariedadNombre'].'<br>
						Cuartel: '.$row_data['CuartelNombre'].'<br>
						Tractor: '.$row_data['TractorNombre'].'<br>
						Nebulizador: '.$row_data['NebNombre'].'<br>
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<strong>Velocidad Tractores (Km/hr)</strong>
					<address>
						Minima: '.Cantidades($row_data['GeoVelocidadMin'], 2).'<br>
						Maxima: '.Cantidades($row_data['GeoVelocidadMax'], 2).'<br>
						Promedio: '.Cantidades($row_data['GeoVelocidadProm'], 2).'<br>
						Programada: '.Cantidades($row_data['VelTractor'], 2).'<br>
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<strong>Distancia Recorrida(KM)</strong>
					<address>
						Recorrida: '.Cantidades($row_data['GeoDistance'], 2).'<br>
						Estimada: '.Cantidades(($row_data['CuartelDistanciaPlant']*$row_data['CuartelCantPlantas'])/1000, 2).'<br>
						Faltante: '.Cantidades((($row_data['CuartelDistanciaPlant']*$row_data['CuartelCantPlantas'])/1000) - $row_data['GeoDistance'], 2).'<br>
				</div>';
		?>


							
	</div>
	
	
	<div class="row" style="margin-bottom:15px;">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Sensor</th>
						<th>Minimo</th>
						<th>Maximo</th>
						<th>Promedio</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i = 1; $i <= $row_data['cantSensores']; $i++) {  ?>
						<tr>
							<td><?php echo $row_data['Sensor_'.$i.'_Nombre'];?></td>
							<td><?php echo Cantidades($row_data['Sensor_'.$i.'_Min'], 1);?></td>
							<td><?php echo Cantidades($row_data['Sensor_'.$i.'_Max'], 1);?></td>
							<td><?php echo Cantidades($row_data['Sensor_'.$i.'_Prom'], 1);?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
				


	<div class="row" style="margin-bottom:15px;">
		<div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
		
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">google.charts.load('current', {'packages':['bar', 'corechart', 'table']});</script>	
			
			
			<?php
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
						
						data_caud.addRows([';
							//recorro los resultados
							foreach ($arrMediciones as $med) {
								echo '["'.$med['HoraSistema'].'", 
								'.Cantidades_decimales_justos($med['Sensor_1']).', 
								'.Cantidades_decimales_justos($med['Sensor_2']).'
								],';
							}
							echo '
						]);

						var options = {
							title: "Grafico Caudal / Homogeniedad",
							hAxis: {title: "Hora"},
							vAxis: { title: "Valor" },
							width: $(window).width()*0.95,
							height: 300,
							curveType: "function",
							colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
						};
						var chart1 = new google.visualization.LineChart(document.getElementById("chart_caudales"));
							chart1.draw(data_caud, options);
					}
				</script> 
				<div id="chart_caudales" style="height: 300px; width: 100%;"></div>';
				
				/********************************************************************/
				//Nivel Estanque
				echo '
				<script>				
					google.charts.setOnLoadCallback(drawChart_caudales);

					function drawChart_caudales() {
						var data_caud = new google.visualization.DataTable();
						data_caud.addColumn("string", "Hora"); 
						data_caud.addColumn("number", "Nivel Estanque");
						
						data_caud.addRows([';
							//recorro los resultados
							foreach ($arrMediciones as $med) {
								echo '["'.$med['HoraSistema'].'", 
								'.Cantidades_decimales_justos($med['Sensor_3']).', 
								],';
							}
							echo '
						]);

						var options = {
							title: "Grafico Nivel Estanque",
							hAxis: {title: "Hora"},
							vAxis: { title: "Valor" },
							width: $(window).width()*0.95,
							height: 300,
							curveType: "function",
							colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
						};
						var chart1 = new google.visualization.LineChart(document.getElementById("chart_niveles"));
							chart1.draw(data_caud, options);
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
						
						data_vel.addRows([';
							//recorro los resultados
							foreach ($arrMediciones as $med) {
								echo '["'.$med['HoraSistema'].'", 
								'.Cantidades_decimales_justos($med['GeoVelocidad']).'
								],';
							}
							echo '
						]);

						var options = {
							title: "Grafico Velocidades",
							hAxis: {title: "Hora"},
							vAxis: { title: "Valor" },
							width: $(window).width()*0.95,
							height: 300,
							curveType: "function",
							colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
						};
						var chart1 = new google.visualization.LineChart(document.getElementById("chart_velocidades"));
							chart1.draw(data_vel, options);
					}
				</script> 
				<div id="chart_velocidades" style="height: 300px; width: 100%;"></div>';
				
				
			?>

		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<?php
			//Si no existe una ID se utiliza una por defecto
			if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
				echo '<p>No ha ingresado Una API de Google Maps</p>';
			}else{
				$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>
				<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false&libraries=visualization"></script>
											
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
							$pres = $med['Sensor_1'] + $med['Sensor_2'];
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
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
 
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

	</body>
</html>
