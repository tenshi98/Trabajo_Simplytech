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
// Se traen todos los datos de mi usuario
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".$_GET['sensorn']." AS SensorNombre,
telemetria_listado.SensoresMedMin_".$_GET['sensorn']." AS SensorMinMed,
telemetria_listado.SensoresMedMax_".$_GET['sensorn']." AS SensorMaxMed,

telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLatitud,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoLongitud,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']." AS SensorValue,
telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".$_GET['sensorn']."

WHERE telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla = {$_GET['view']} ";
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
			<div class="icons"><i class="fa fa-table"></i></div>
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
					
			echo mapa1($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Equipos', 'Datos', $explanation, $_SESSION['usuario']['basic_data']['Config_IDGoogle'])?>
			

        </div>	
	</div>
</div>




<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
