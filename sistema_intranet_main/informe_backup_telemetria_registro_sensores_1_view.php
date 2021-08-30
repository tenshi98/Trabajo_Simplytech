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
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
// consulto los datos
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".simpleDecode($_GET['sensorn'], fecha_actual())." AS SensorNombre,
telemetria_listado.SensoresMedMin_".simpleDecode($_GET['sensorn'], fecha_actual())." AS SensorMinMed,
telemetria_listado.SensoresMedMax_".simpleDecode($_GET['sensorn'], fecha_actual())." AS SensorMaxMed,

backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".idTabla,
backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".FechaSistema,
backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".HoraSistema,
backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".GeoLatitud,
backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".GeoLongitud,
backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".Sensor_".simpleDecode($_GET['sensorn'], fecha_actual())." AS SensorValue,
telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual())."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".simpleDecode($_GET['sensorn'], fecha_actual())."

WHERE backup_telemetria_listado_tablarelacionada_".simpleDecode($_GET['idTelemetria'], fecha_actual()).".idTabla = ".simpleDecode($_GET['view'], fecha_actual());
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
$rowdata = mysqli_fetch_assoc ($resultado);


?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['NombreEquipo']; ?></h5>	
		</header>
        <div class="table-responsive">
			<?php 
			$explanation  = '<strong>'.fecha_estandar($rowdata['FechaSistema']).' - '.$rowdata['HoraSistema'].'</strong><br/>';
			$explanation .= '<strong>Equipo: </strong>'.$rowdata['NombreEquipo'].'<br/>';
			$explanation .= '<strong>Sensor: </strong>'.$rowdata['SensorNombre'].'<br/>';
			$explanation .= '<strong>Medicion: </strong>'.Cantidades_decimales_justos($rowdata['SensorValue']).' '.$rowdata['Unimed'].'<br/>';
			$explanation .= '<strong>Minimo: </strong>'.Cantidades_decimales_justos($rowdata['SensorMinMed']).' '.$rowdata['Unimed'].'<br/>';
			$explanation .= '<strong>Maximo: </strong>'.Cantidades_decimales_justos($rowdata['SensorMaxMed']).' '.$rowdata['Unimed'].'<br/>';
					
			echo mapa_from_gps($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Equipos', 'Datos', $explanation, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1)?>
			

        </div>	
	</div>
</div>




<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
