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
$query = "SELECT Nombre, idRuta
FROM `vehiculos_ruta_alternativa`
WHERE idRutaAlt = {$_GET['view']}";
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
$arrRutas = array();
$query = "SELECT idUbicaciones, Latitud, Longitud, direccion
FROM `vehiculos_rutas_ubicaciones`
WHERE idRuta = {$rowdata['idRuta']}
ORDER BY idUbicaciones ASC";
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
array_push( $arrRutas,$row );
}

//Se traen las rutas
$arrRutasAlt = array();
$query = "SELECT idUbicaciones, Latitud, Longitud, direccion
FROM `vehiculos_ruta_alternativa_ubicaciones`
WHERE idRutaAlt = {$_GET['view']}
ORDER BY idUbicaciones ASC";
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
array_push( $arrRutasAlt,$row );
}
?>
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Ruta <?php echo $rowdata['Nombre']; ?></h5>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
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
								var myLatlng = new google.maps.LatLng(-33.477271996598965, -70.65170304882815);

								var myOptions = {
									zoom: 12,
									center: myLatlng,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								};
								map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
								RutasAlternativas();
							}
							
							/* ************************************************************************** */
							function RutasAlternativas() {
								
								var route1=[];
								var route2=[];
								var tmp;
								
								var locations1 = [ 
								<?php foreach ( $arrRutas as $pos ) { ?>
									['<?php echo $pos['idUbicaciones']; ?>', <?php echo $pos['Latitud']; ?>, <?php echo $pos['Longitud']; ?>], 					
								<?php } ?>
								];
								
								var locations2 = [ 
								<?php foreach ( $arrRutasAlt as $pos ) { ?>
									['<?php echo $pos['idUbicaciones']; ?>', <?php echo $pos['Latitud']; ?>, <?php echo $pos['Longitud']; ?>], 					
								<?php } ?>
								];

								for(var i in locations1){
									tmp=new google.maps.LatLng(locations1[i][1], locations1[i][2]);
									route1.push(tmp);
								}
								
								for(var i in locations2){
									tmp=new google.maps.LatLng(locations2[i][1], locations2[i][2]);
									route2.push(tmp);
								}
								
								var drawn = new google.maps.Polyline({
									map: map,
									path: route1,
									strokeColor: 'blue',
									strokeOpacity: 1,
									strokeWeight: 5
								});
								
								var drawn = new google.maps.Polyline({
									map: map,
									path: route2,
									strokeColor: 'red',
									strokeOpacity: 1,
									strokeWeight: 5
								});
								
								//llamo a los puntos
								Puntos();
							}
							/* ************************************************************************** */
							function Puntos() {
								var infowindow = new google.maps.InfoWindow({  
								  content: ''
								});
								var marcadores = [
								<?php 
								$in=0;
								foreach ($arrRutas as $pos) { 
										if($in==0){
											$in=1;
										}else{
											echo ',';
										}
									?>
								{  
								  position: {
									lat: <?php echo $pos['Latitud']; ?>,
									lng: <?php echo $pos['Longitud']; ?>
								  },
								  contenido: "<?php echo $pos['direccion']; ?>"
								}
								<?php } ?>
								<?php 
								$in=0;
								foreach ($arrRutasAlt as $pos) { 
										if($in==0){
											echo ',';
										}else{
											echo ',';
										}
									?>
								{  
								  position: {
									lat: <?php echo $pos['Latitud']; ?>,
									lng: <?php echo $pos['Longitud']; ?>
								  },
								  contenido: 	"<div id='iw-container'>" +
												"<div class='iw-title'>Direccion</div>" +
												"<div class='iw-content'>" +
												"<div class='iw-subTitle'>Calle</div>" +
												"<p><?php echo $pos['direccion']; ?></p>" +
												"</div>" +
												"<div class='iw-bottom-gradient'></div>" +
												"</div>"
								}
								<?php } ?>


								];
								for (var i = 0, j = marcadores.length; i < j; i++) {  
								  var contenido = marcadores[i].contenido;
								  var marker = new google.maps.Marker({
									position	: new google.maps.LatLng(marcadores[i].position.lat, marcadores[i].position.lng),
									map			: map,
									animation 	: google.maps.Animation.DROP,
									icon      	: "<?php echo DB_SITE ?>/LIB_assets/img/map-icons/1_series_orange.png"
								  });
								  (function(marker, contenido) {
									google.maps.event.addListener(marker, 'click', function() {
									  infowindow.setContent(contenido);
									  infowindow.open(map, marker);
									});
								  })(marker, contenido);
								}
								
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

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

	</body>
</html>
