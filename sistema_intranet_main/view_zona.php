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
// tomo los datos del usuario
$query = "SELECT Nombre
FROM `cross_predios_listado_zonas`
WHERE idZona = {$_GET['view']}";
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
$arrPuntos = array();
$query = "SELECT idUbicaciones, Latitud, Longitud
FROM `cross_predios_listado_zonas_ubicaciones`
WHERE idZona = {$_GET['view']}
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
array_push( $arrPuntos,$row );
}?>


<div class="col-sm-12">
	<div class="box">
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Puntos del Cuartel <?php echo $rowdata['Nombre']; ?></h5>
		</header>
		<div class="tab-content">
			<div class="table-responsive">
				<div class="col-sm-6">
					<div class="row">
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
									var myLatlng = new google.maps.LatLng(<?php echo $arrPuntos[0]['Latitud']; ?>, <?php echo $arrPuntos[0]['Longitud']; ?>);

									var myOptions = {
										zoom: 18,
										center: myLatlng,
										mapTypeId: google.maps.MapTypeId.SATELLITE
									};
									map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
									
								
									//RutasAlternativas();
									dibuja_zona();

								}
								/* ************************************************************************** */
								function dibuja_zona() {
									
									var triangleCoords = [
										<?php 
										//Variables con la primera posicion
										$Latitud_x       = '';
										$Longitud_x      = '';
										$Latitud_z       = 0;
										$Longitud_z      = 0;
										$Latitud_z_prom  = 0;
										$Longitud_z_prom = 0;
										$zcounter        = 0;
										//recorrer
										foreach ($arrPuntos as $puntos) {
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
										//Centralizado del mapa
										$Latitud_z_prom  = $Latitud_z/$zcounter;
										$Longitud_z_prom = $Longitud_z/$zcounter;
										?>
									];
								
									<?php
									if(isset($Latitud_z_prom)&&$Latitud_z_prom!=0&&isset($Longitud_z_prom)&&$Longitud_z_prom!=0){
										echo 'myLatlng = new google.maps.LatLng('.$Latitud_z_prom.', '.$Longitud_z_prom.');
											map.setCenter(myLatlng);'; 
									}?>
									
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

								}
								/* ************************************************************************** */
								google.maps.event.addDomListener(window, "load", initialize());

							</script>
						<?php } ?>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div style="margin-top:20px;">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
							<tr role="row">
								<th>Orden</th>
								<th>Ubicacion</th>
							</tr>
							</thead>
											  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php 
							$nx=1;
							foreach ($arrPuntos as $pos) { ?>
								<tr class="odd">
									<td><?php echo $nx; ?></td>
									<td><?php echo 'lat: '.$pos['Latitud'].'<br/>lng: '.$pos['Longitud']; ?></td>
								</tr>
							<?php 
							$nx++;
							} ?>                    
							</tbody>
						</table>
					</div>
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


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>