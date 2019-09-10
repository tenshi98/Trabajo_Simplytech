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
//Se traen todos los grupos
$arrGruposRev = array();
$query = "SELECT idGrupo, Valor, idSupervisado
FROM `telemetria_listado_grupos_uso`
WHERE idSupervisado=1
ORDER BY idGrupo ASC";
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
array_push( $arrGruposRev,$row );
}

/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_listado_tablarelacionada_".$_GET['view'].".idTabla!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['dia']) && $_GET['dia'] != ''){    $z.=" AND telemetria_listado_tablarelacionada_".$_GET['view'].".FechaSistema ='".$_GET['dia']."'";}

//Se arma la queri con los datos justos recibidos
$subquery = '';
for ($i = 1; $i <= $_GET['cantSensores']; $i++) {
	$subquery .= ',telemetria_listado.SensoresActivo_'.$i;
	$subquery .= ',telemetria_listado.SensoresRevision_'.$i;
	$subquery .= ',telemetria_listado.SensoresRevisionGrupo_'.$i;
	$subquery .= ',telemetria_listado.SensoresNombre_'.$i;
	$subquery .= ',telemetria_listado_tablarelacionada_'.$_GET['view'].'.Sensor_'.$i;
	
	/*
	$subquery .= ',telemetria_listado.SensoresGrupo_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedMin_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedMax_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedErrores_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedErrores_2_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedErrores_3_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedAlerta_'.$i;
	$subquery .= ',telemetria_listado.SensoresErrorActual_'.$i;
	$subquery .= ',telemetria_listado.SensoresMedActual_'.$i;
	$subquery .= ',telemetria_listado.SensoresUso_'.$i;
	$subquery .= ',telemetria_listado.SensoresAccionMedC_'.$i;
	$subquery .= ',telemetria_listado.SensoresAccionMedT_'.$i;
	$subquery .= ',telemetria_listado.SensoresTipo_'.$i;
	$subquery .= ',telemetria_listado.SensoresMant_'.$i;*/
	
}

//Se consulta en la bd y se traen sus datos
$arrConsulta = array(); 
$query = "SELECT 
telemetria_listado.Nombre AS EquipoNombre,
telemetria_listado_tablarelacionada_".$_GET['view'].".FechaSistema AS EquipoFecha,
telemetria_listado_tablarelacionada_".$_GET['view'].".HoraSistema AS EquipoHora
	
".$subquery."

FROM `telemetria_listado_tablarelacionada_".$_GET['view']."`
LEFT JOIN `telemetria_listado`   ON telemetria_listado.idTelemetria  = telemetria_listado_tablarelacionada_".$_GET['view'].".idTelemetria
".$z." 
ORDER BY telemetria_listado_tablarelacionada_".$_GET['view'].".FechaSistema ASC, telemetria_listado_tablarelacionada_".$_GET['view'].".HoraSistema ASC";
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
/*while ( $row = mysqli_fetch_assoc ($resultado) ) {
array_push( $arrConsulta,$row );

}*/





//Arreglo temporal
$arrTable = array(); 
$arrTable['inicio']['EquipoFecha']   = '';
$arrTable['termino']['EquipoFecha']  = '';
//recorro los datos
while ( $con = mysqli_fetch_assoc ($resultado) ) {

	//Reseteo Variable
	$rev_count = 0;
	$rev_sup   = 0;
			 
	foreach ($arrGruposRev as $sen) { 
		//Solo busco en los sensores que supervisan
		if(isset($sen['idSupervisado'])&&$sen['idSupervisado']==1){
			//recorro los sensores
			for ($i = 1; $i <= $_GET['cantSensores']; $i++) {
				//verifico que esten activos
				if(isset($con['SensoresActivo_'.$i])&&$con['SensoresActivo_'.$i]==1){
					//Reviso si el sensor esta siendo supervisado
					if(isset($con['SensoresRevision_'.$i])&&$con['SensoresRevision_'.$i]==1){
						//verifico que pertenezca al grupo actual
						if($con['SensoresRevisionGrupo_'.$i]==$sen['idGrupo']){
							
							//verifico que el valor sea igual o superior al establecido
							if(isset($_GET['Amp'])&&$_GET['Amp']!=''&&$_GET['Amp']!=0){$valor_amp=$_GET['Amp'];}else{$valor_amp=$sen['Valor'];}
							if($con['Sensor_'.$i]>=$valor_amp){
								
								//cuento los sensores dentro del grupo
								$rev_count++;
								//Valor Inicio
								if(isset($arrTable['inicio']['EquipoFecha'])&&$arrTable['inicio']['EquipoFecha']==''){
									$arrTable['inicio'][$i]['SensorNombre'] = $con['SensoresNombre_'.$i];
									$arrTable['inicio'][$i]['SensorValor']  = $con['Sensor_'.$i];
								}
								
								//Vacio las variables
								unset($arrTable['termino']);
							
								//Valor termino
								$arrTable['termino'][$i]['SensorNombre'] = $con['SensoresNombre_'.$i];
								$arrTable['termino'][$i]['SensorValor']  = $con['Sensor_'.$i];
								$arrTable['termino']['EquipoFecha']      = $con['EquipoFecha'];
								$arrTable['termino']['EquipoHora']       = $con['EquipoHora'];
								$arrTable['termino']['EquipoNombre']     = $con['EquipoNombre'];
								
						
								
							}						
						}
					}
				}
			}
			//cuento los sensores supervisados dentro del grupo
			$rev_sup++;
		}
	}
	//Si alguno de los sensores era superior al minimo establecido, se indica que estaba activo el grupo
	if($rev_count!=0&&$rev_sup!=0){
		//Valor Inicio
		if(isset($arrTable['inicio']['EquipoFecha'])&&$arrTable['inicio']['EquipoFecha']==''){
			$arrTable['inicio']['EquipoFecha']  = $con['EquipoFecha'];
			$arrTable['inicio']['EquipoHora']   = $con['EquipoHora'];
			$arrTable['inicio']['EquipoNombre'] = $con['EquipoNombre'];
		}
		
		
	}
}


?>
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Voltaje del equipo <?php echo $arrTable['termino']['EquipoNombre'].' el '.fecha_estandar($arrTable['termino']['EquipoFecha']); ?></h5>
		</header>
		<div class="tab-content">
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Inicio</th>
							<th>Termino</th>
						</tr>
					</thead>				  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<tr class="odd">
							<td><?php echo $arrTable['inicio']['EquipoHora']; ?></td>
							<td><?php echo $arrTable['termino']['EquipoHora']; ?></td>
						</tr>
						<tr class="odd">
							<td>
								<?php
								for ($i = 1; $i <= $_GET['cantSensores']; $i++) {
									if(isset($arrTable['inicio'][$i]['SensorValor'])){
										echo $arrTable['inicio'][$i]['SensorNombre'].': '.Cantidades_decimales_justos($arrTable['inicio'][$i]['SensorValor']).'<br/>';
									}
								}
								?>
							</td>
							<td>
								<?php
								for ($i = 1; $i <= $_GET['cantSensores']; $i++) {
									if(isset($arrTable['termino'][$i]['SensorValor'])&&$arrTable['termino'][$i]['SensorValor']!=0){
										echo $arrTable['termino'][$i]['SensorNombre'].': '.Cantidades_decimales_justos($arrTable['termino'][$i]['SensorValor']).'<br/>';
									}
								}
								?>
							</td>
						</tr>
										   
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
