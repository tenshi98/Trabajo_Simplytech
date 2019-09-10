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
// Se traen todos los datos de mi usuario
$query = "SELECT
telemetria_listado_errores.Descripcion, 
telemetria_listado_errores.Fecha, 
telemetria_listado_errores.Hora, 
telemetria_listado_errores.Valor,
telemetria_listado_errores.GeoLatitud,
telemetria_listado_errores.GeoLongitud,
telemetria_listado.Nombre AS NombreEquipo


FROM `telemetria_listado_errores`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria
WHERE telemetria_listado_errores.idErrores = {$_GET['view']}
AND telemetria_listado_errores.idTipo='999'
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
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

?>


<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['NombreEquipo']; ?></h5>
						
		</header>
		<div class="table-responsive">
					
			<?php 
			$explanation  = '<strong>'.fecha_estandar($rowdata['Fecha']).' - '.$rowdata['Hora'].'</strong><br/>';
			$explanation .= $rowdata['Descripcion'].'<br/>';
			$explanation .= '<strong>Valor: </strong>'.Cantidades_decimales_justos($rowdata['Valor']).'<br/>';
							
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
