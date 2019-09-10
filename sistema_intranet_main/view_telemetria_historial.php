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
if(isset($_GET['fueraHorario'])&&$_GET['fueraHorario']!=''){
	$z = "WHERE telemetria_listado_historial_activaciones.idFueraHorario=1";
}else{
	$z = "WHERE telemetria_listado_historial_activaciones.idEstado=1";
}

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['view']) && $_GET['view'] != ''){  $z.=" AND telemetria_listado_historial_activaciones.idTelemetria =".$_GET['view'];}
if(isset($_GET['dia']) && $_GET['dia'] != ''){    $z.=" AND telemetria_listado_historial_activaciones.Fecha ='".$_GET['dia']."'";}

/**********************************************************/
//se consulta
$arrConsulta = array(); 
$query = "SELECT 
telemetria_listado.Nombre AS EquipoNombre,
telemetria_listado_historial_activaciones.Fecha AS EquipoFecha,
telemetria_listado_historial_activaciones.Hora AS EquipoHora,
telemetria_listado_historial_activaciones.SensorActivacionValor AS EquipoActivacionValor,
telemetria_listado_historial_activaciones.Valor AS EquipoValor

FROM `telemetria_listado_historial_activaciones`
LEFT JOIN `telemetria_listado`   ON telemetria_listado.idTelemetria  = telemetria_listado_historial_activaciones.idTelemetria
".$z."
ORDER BY telemetria_listado_historial_activaciones.Fecha ASC, telemetria_listado_historial_activaciones.Hora ASC
";
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
array_push( $arrConsulta,$row );
}


?>
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Actividad del equipo <?php echo $arrConsulta[0]['EquipoNombre']; ?></h5>
		</header>
		<div class="tab-content">
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Equipo</th>
							<th>Hora</th>
							<th>Estado</th>
						</tr>
					</thead>				  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrConsulta as $con) { ?>
							<tr class="odd">
								<td><?php echo fecha_estandar($con['EquipoFecha']); ?></td>
								<td><?php echo $con['EquipoHora']; ?></td>
								<td><?php if($con['EquipoValor']==$con['EquipoActivacionValor']){echo 'Encendido';}else{echo 'Apagado';} ; ?></td>
							</tr>
						<?php } ?>                    
					</tbody>
				</table>
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
