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

// Se traen todos los datos de mi usuario
$arrTractores = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_tractores.idTelemetria,
telemetria_listado.cantSensores
		
FROM `cross_solicitud_aplicacion_listado_tractores`
LEFT JOIN `telemetria_listado`     ON telemetria_listado.idTelemetria    = cross_solicitud_aplicacion_listado_tractores.idTelemetria
WHERE cross_solicitud_aplicacion_listado_tractores.idSolicitud = {$_GET['view']} ";
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
	WHERE idSolicitud = ".$_GET['view']." 
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
	//recorro los resultados
	foreach ($arrMediciones as $med) {
		if(isset($med['GeoLatitud'])&&$med['GeoLatitud']!=0&&isset($med['GeoLongitud'])&&$med['GeoLongitud']!=0){
			$pres = $med['Sensor_1'] + $med['Sensor_2'];
			$rec_x .= '{location: new google.maps.LatLng('.$med['GeoLatitud'].', '.$med['GeoLongitud'].'), weight: '.$pres.'},';
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
WHERE cross_solicitud_aplicacion_listado.idSolicitud = {$_GET['view']}
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
				<i class="fa fa-globe"></i> Resumen Solicitud de Aplicacion.
			</h2>
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
								fillOpacity: 0
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
