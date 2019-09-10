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
vehiculos_listado.Nombre AS NombreEquipo,
vehiculos_listado.LimiteVelocidad,
vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".FechaSistema,
vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".HoraSistema,
vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".GeoLatitud,
vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".GeoLongitud,
vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".GeoVelocidad

FROM `vehiculos_listado_tablarelacionada_".$_GET['idVehiculo']."`
LEFT JOIN `vehiculos_listado` ON vehiculos_listado.idVehiculo = vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".idVehiculo
 WHERE vehiculos_listado_tablarelacionada_".$_GET['idVehiculo'].".idTabla = {$_GET['view']}
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
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['NombreEquipo']; ?></h5>
		</header>
        <div class="table-responsive">
			<?php 
			$explanation  = '<strong>'.fecha_estandar($rowdata['FechaSistema']).' - '.$rowdata['HoraSistema'].'</strong><br/>';
			$explanation .= '<strong>Equipo: </strong>'.$rowdata['NombreEquipo'].'<br/>';
			$explanation .= '<strong>Velocidad: </strong>'.Cantidades($rowdata['GeoVelocidad'], 0).'/'.Cantidades($rowdata['LimiteVelocidad'], 0).' KM/h<br/>';
					
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