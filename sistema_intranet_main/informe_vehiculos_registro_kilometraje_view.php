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
vehiculos_listado.Nombre AS NombreEquipo,
vehiculos_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.FechaSistema,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.HoraSistema,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.GeoLatitud,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.GeoLongitud,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.GeoVelocidad,
telemetria_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.GeoMovimiento';
$SIS_join  = 'LEFT JOIN `vehiculos_listado` ON vehiculos_listado.idVehiculo = vehiculos_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.idVehiculo';
$SIS_where = 'vehiculos_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()).'.idTabla = '.simpleDecode($_GET['view'], fecha_actual());
$rowdata = db_select_data (false, $SIS_query, 'vehiculos_listado_tablarelacionada_'.simpleDecode($_GET['idVehiculo'], fecha_actual()), $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');


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
