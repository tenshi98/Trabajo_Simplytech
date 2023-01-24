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
/*                                                Carga del documento HTML                                                        */
/**********************************************************************************************************************************/
/**********************************************************************************************************************************/
// consulto los datos
$SIS_query = '
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.FechaSistema,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.HoraSistema,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.GeoLatitud,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.GeoLongitud,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.GeoVelocidad,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.GeoMovimiento';
$SIS_join  = 'LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.idTelemetria';
$SIS_where = 'telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()).'.idTabla = '.simpleDecode($_GET['view'], fecha_actual());
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idTelemetria'], fecha_actual()), $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');


/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

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
			$explanation .= '<strong>Velocidad: </strong>'.Cantidades($rowdata['GeoVelocidad'], 4).' KM/h<br/>';
			$explanation .= '<strong>Kilometros Recorridos: </strong>'.Cantidades($rowdata['GeoMovimiento'], 4).' KM<br/>';
							
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
