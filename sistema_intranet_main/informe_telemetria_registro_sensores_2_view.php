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
$SIS_query = '
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.GeoLatitud,
telemetria_listado.GeoLongitud,
telemetria_listado_sensores_nombre.SensoresNombre_'.simpleDecode($_GET['sensorn'], fecha_actual()).' AS SensorNombre,

telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.idTabla,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.FechaSistema,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.HoraSistema,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.Sensor_'.simpleDecode($_GET['sensorn'], fecha_actual()).' AS SensorValue,
telemetria_listado_unidad_medida.Nombre AS Unimed,

core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
telemetria_listado.Direccion';
$SIS_join  = '
LEFT JOIN `telemetria_listado_sensores_nombre`  ON telemetria_listado_sensores_nombre.idTelemetria   = telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.idTelemetria
LEFT JOIN `telemetria_listado_sensores_unimed`  ON telemetria_listado_sensores_unimed.idTelemetria   = telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`    ON telemetria_listado_unidad_medida.idUniMed         = telemetria_listado_sensores_unimed.SensoresUniMed_'.simpleDecode($_GET['sensorn'], fecha_actual()).'
LEFT JOIN `core_ubicacion_ciudad`               ON core_ubicacion_ciudad.idCiudad                    = telemetria_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`              ON core_ubicacion_comunas.idComuna                   = telemetria_listado.idComuna';
$SIS_where = 'telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.idTabla = '.simpleDecode($_GET['view'], fecha_actual());
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()), $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
			$explanation .= '<strong>Medicion Actual: </strong>'.Cantidades_decimales_justos($rowdata['SensorValue']).' '.$rowdata['Unimed'].'<br/>';

			echo mapa_from_gps($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Equipos', 'Datos', $explanation, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1);
			?>
        </div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';

?>
