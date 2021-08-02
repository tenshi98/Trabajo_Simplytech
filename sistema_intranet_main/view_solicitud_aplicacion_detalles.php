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
cross_solicitud_aplicacion_listado.NSolicitud,
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

WHERE cross_solicitud_aplicacion_listado_tractores.idTractores = ".$X_Puntero;
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
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrMediciones,$row );
}

//Se traen las rutas
$arrPuntos = array();
$query = "SELECT idUbicaciones, Latitud, Longitud
FROM `cross_predios_listado_zonas_ubicaciones`
WHERE idZona = ".$row_data['idZona']."
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

<style>
#loading {display: block;position: absolute;top: 0;left: 0;z-index: 100;width: 100%;height: 100%;background-color: rgba(192, 192, 192, 0.5);background-image: url("<?php echo DB_SITE_REPO.'/LIB_assets/img/loader.gif';?>");background-repeat: no-repeat;background-position: center;}
</style>
<div id="loading"></div>
<script>
//oculto el loader
document.getElementById("loading").style.display = "none";
</script>


<div class="col-sm-12" style="margin-top:15px;">
	<input class="btn btn-sm btn-metis-3 pull-right margin_width fa-input" type="button" onclick="Export()" value="&#xf1c1; Exportar a PDF"/>	
</div>
<div class="clearfix"></div> 

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Detalles Solicitud de Aplicacion N°<?php echo n_doc($row_data['NSolicitud'], 7); ?>.
				<small class="pull-right">Fecha Termino: <?php echo Fecha_estandar($row_data['f_termino'])?></small>
			</h2>
		</div>   
	</div>

	<div class="row invoice-info">
		
		<?php echo '
				<div class="col-sm-4 invoice-col">
					<strong>Identificacion</strong>
					<address>
						Predio: '.$row_data['PredioNombre'].'<br/>
						Especie: '.$row_data['VariedadCat'].'<br/>
						Variedad: '.$row_data['VariedadNombre'].'<br/>
						Cuartel: '.$row_data['CuartelNombre'].'<br/>
						Tractor: '.$row_data['TractorNombre'].'<br/>
						Nebulizador: '.$row_data['NebNombre'].'<br/>
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<strong>Velocidad Tractores (Km/hr)</strong>
					<address>
						Minima: '.Cantidades($row_data['GeoVelocidadMin'], 2).'<br/>
						Maxima: '.Cantidades($row_data['GeoVelocidadMax'], 2).'<br/>
						Promedio: '.Cantidades($row_data['GeoVelocidadProm'], 2).'<br/>
						Programada: '.Cantidades($row_data['VelTractor'], 2).'<br/>
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<strong>Distancia Recorrida(KM)</strong>
					<address>
						Recorrida: '.Cantidades($row_data['GeoDistance'], 2).'<br/>
						Estimada: '.Cantidades(($row_data['CuartelDistanciaPlant']*$row_data['CuartelCantPlantas'])/1000, 2).'<br/>
						Faltante: '.Cantidades((($row_data['CuartelDistanciaPlant']*$row_data['CuartelCantPlantas'])/1000) - $row_data['GeoDistance'], 2).'<br/>
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
							title: "Grafico Caudal / Homogeneidad",
							hAxis: {title: "Hora"},
							vAxis: { title: "Litros * Minutos" },
							width: $(window).width()*0.95,
							height: 300,
							curveType: "function",
							colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
						};
						var chart1 = new google.visualization.LineChart(document.getElementById("chart_caudales"));
							chart1.draw(data_caud, options);
					}
				</script> ';
				
				/********************************************************************/
				//Nivel Estanque
				echo '
				<script>				
					google.charts.setOnLoadCallback(drawChart_niveles);

					function drawChart_niveles() {
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
							vAxis: { title: "% de llenado" },
							width: $(window).width()*0.95,
							height: 300,
							curveType: "function",
							colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
						};
						var chart1 = new google.visualization.LineChart(document.getElementById("chart_niveles"));
							chart1.draw(data_caud, options);
					}
				</script> ';
				
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
							vAxis: { title: "Km * hr" },
							width: $(window).width()*0.95,
							height: 300,
							curveType: "function",
							colors: ["#FFB347", "#8DB652","#f5b75f","#ec693c"]
						};
						var chart1 = new google.visualization.LineChart(document.getElementById("chart_velocidades"));
							chart1.draw(data_vel, options);
					}
				</script> 
				<div id="charts">
					<div id="chart_caudales"     style="height: 300px; width: 100%;"></div>
					<div id="chart_niveles"      style="height: 300px; width: 100%;"></div>
					<div id="chart_velocidades"  style="height: 300px; width: 100%;"></div>
				</div>
				';
				
				
			?>

		</div>
	</div>
	
	<div class="col-sm-12" style="margin-top:20px;">
		<?php
		$Alert_Text = '<a href="view_solicitud_aplicacion_finalizada_view_mapa.php?idTelemetria='.simpleEncode($row_data['idTelemetria'], fecha_actual()).'&idSolicitud='.simpleEncode($row_data['idSolicitud'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php").'" class="btn btn-primary fright margin_width"><i class="fa fa-map-o" aria-hidden="true"></i> Ver mapas</a>';
		alert_post_data(4,2,2, $Alert_Text);
		?>
	</div>

</section>


<div class="col-sm-12" style="display: none;">

	<form method="post" id="make_pdf" action="view_solicitud_aplicacion_detalles_to_pdf.php">
		<input type="hidden" name="img_adj" id="img_adj" />
			
		<input type="hidden" name="idSistema"  id="idSistema"  value="<?php echo simpleEncode($_SESSION['usuario']['basic_data']['idSistema'], fecha_actual()); ?>" />
		<input type="hidden" name="view"       id="view"       value="<?php echo $_GET['view']; ?>" />
			
		<button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs">Hacer PDF</button>
		
	</form>

	<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/dom-to-image.min.js"></script>		
	<script>
		var node = document.getElementById('charts');
					
		function sendDatatoSRV(img) {
			$('#img_adj').val(img);
			//$('#img_adj').val($('#img-out').html());
			$('#make_pdf').submit();
			//oculto el loader
			document.getElementById("loading").style.display = "none";
		}
		function Export() {
			//muestro el loader
			document.getElementById("loading").style.display = "block";
			//Exporto
			setTimeout(
				function(){
					domtoimage.toPng(node)
					.then(function (dataUrl) {
						var img = new Image();
						img.src = dataUrl;
						//document.getElementById('img-out').appendChild(img);
						//alert(img.src);
						sendDatatoSRV(img.src);
					})
					.catch(function (error) {
						console.error('oops, something went wrong!', error);
					});		
				}
			, 3000);
		}
	</script>	
</div>

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
