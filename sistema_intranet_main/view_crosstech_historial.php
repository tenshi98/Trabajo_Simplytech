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
$X_Type        = simpleDecode($_GET['Type'], fecha_actual());
$idTelemetria  = simpleDecode($_GET['idTelemetria'], fecha_actual());
/**************************************************************/
//Se definen las variables de tiempo
$HoraActual   = hora_actual();
$FechaActual  = fecha_actual();

$HoraAnterior   = $HoraActual;
$FechaAnterior  = restarDias($FechaActual,1); //Se obtienen los datos de 7 dias atras

/*****************************************/	
switch ($X_Type) {
    case 1: $selected = ', Temperatura AS Valor';   $Tittle = 'Temperatura'; break;
    case 2: $selected = ', Humedad AS Valor';       $Tittle = 'Humedad'; break;
    case 3: $selected = ', PuntoRocio AS Valor';    $Tittle = 'Punto Rocio'; break;
    case 4: $selected = ', PresionAtmos AS Valor';  $Tittle = 'Presion Atmos'; break;
    
}
	
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT Fecha, Hora, TimeStamp ".$selected."

FROM `telemetria_listado_aux_equipo` 
WHERE (TimeStamp BETWEEN '".$FechaAnterior." ".$HoraAnterior ."' AND '".$FechaActual." ".$HoraActual."')
AND idSistema = ".$_SESSION['usuario']['basic_data']['idSistema']."
AND idTelemetria = ".$idTelemetria ."
ORDER BY idAuxiliar ASC";
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
array_push( $arrHistorial,$row );
}



?>





<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Historico <?php echo $Tittle;?></h5>	
		</header>
		<div class="tab-content">
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">google.charts.load('current', {'packages':['line','corechart']});</script>
			
			<script type="text/javascript">
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Hora');
					data.addColumn('number', '<?php echo $Tittle;?>');
					data.addRows([
						<?php foreach($arrHistorial as $hist) { 
								$z_date  = "'".Fecha_estandar($hist['Fecha'])." - ".Hora_estandar($hist['Hora'])."'";
								echo '['.$z_date.','.$hist['Valor'].'],'; 
						} ?>  
							  
							]);

					var chart = new google.charts.Line(document.getElementById('chart_div'));

					var options = {
						chart: {
							title: 'Grafico'
						},
						series: {
							// Gives each series an axis name that matches the Y-axis below.
							0: {axis: '<?php echo $Tittle;?>'}
						},
						axes: {
							// Adds labels to each axis; they don't have to match the axis names.
							y: {
								Temps: {label: '<?php echo $Tittle;?>'}
							}
						}
					};

					chart.draw(data, options);
				}

			</script>
			<div id='chart_div' style='width: 95%; height: 500px;'></div>

		</div>
	</div>
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
