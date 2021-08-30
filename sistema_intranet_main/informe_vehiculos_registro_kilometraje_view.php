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
vehiculos_listado.Nombre AS NombreEquipo,
vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".FechaSistema,
vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".HoraSistema,
vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".GeoLatitud,
vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".GeoLongitud,
vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".GeoVelocidad,
vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".GeoMovimiento

FROM `vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual())."`
LEFT JOIN `vehiculos_listado` ON vehiculos_listado.idVehiculo = vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".idVehiculo
 WHERE vehiculos_listado_tablarelacionada_".simpleDecode($_GET['idVehiculo'], fecha_actual()).".idTabla = ".simpleDecode($_GET['view'], fecha_actual())."
";
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
