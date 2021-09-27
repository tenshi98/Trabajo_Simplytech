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

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresUniMed_'.$i;
}
//consulto
$SIS_query = '
telemetria_listado_error_geocerca.Descripcion, 
telemetria_listado_error_geocerca.Fecha, 
telemetria_listado_error_geocerca.Hora, 
telemetria_listado_error_geocerca.GeoLatitud,
telemetria_listado_error_geocerca.GeoLongitud,
telemetria_listado.Nombre AS NombreEquipo'.$subquery;
$SIS_join  = 'LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_error_geocerca.idTelemetria';
$SIS_where = 'telemetria_listado_error_geocerca.idErrores = '.simpleDecode($_GET['view'], fecha_actual());
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado_error_geocerca', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');


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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['NombreEquipo']; ?></h5>	
		</header>
		<div class="table-responsive">
			<?php 
			//Guardo la unidad de medida
			$explanation  = '<strong>'.fecha_estandar($rowdata['Fecha']).' - '.$rowdata['Hora'].'</strong><br/>';
			$explanation .= $rowdata['Descripcion'].'<br/>';
							
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
