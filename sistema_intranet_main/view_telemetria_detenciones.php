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
// Se traen todos los datos de la detencion
$query = "SELECT
telemetria_listado_error_detenciones.idTelemetria,
telemetria_listado_error_detenciones.Fecha, 
telemetria_listado_error_detenciones.Hora, 
telemetria_listado_error_detenciones.Tiempo,
telemetria_listado_error_detenciones.GeoLatitud, 
telemetria_listado_error_detenciones.GeoLongitud, 
telemetria_listado_error_detenciones.idTabla, 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.cantSensores

FROM `telemetria_listado_error_detenciones`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_error_detenciones.idTelemetria
WHERE idDetencion = {$_GET['view']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);

//Se crea cadena dependiendo de la cantidad de sensores existentes
$aa = '';
for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
	$aa .= ',Sensor_'.$i;
	$aa .= ',SensoresNombre_'.$i;
	$aa .= ',SensoresUniMed_'.$i;
}
// Se traen todos los datos de las mediciones
$query = "SELECT idTabla
".$aa."

FROM `telemetria_listado_tablarelacionada_".$rowdata['idTelemetria']."`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_tablarelacionada_".$rowdata['idTelemetria'].".idTelemetria
WHERE telemetria_listado_tablarelacionada_".$rowdata['idTelemetria'].".idTabla = '{$rowdata['idTabla']}'";
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
$rowMedicion = mysqli_fetch_assoc ($resultado);

//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
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
array_push( $arrUnimed,$row );
}

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['NombreEquipo']; ?></h5>	
		</header>
		<div class="tab-content">
			<div class="table-responsive">
				<?php 
				$explanation  = '<strong>'.fecha_estandar($rowdata['Fecha']).' - '.$rowdata['Hora'].'</strong><br/>';
				$explanation .= '<strong>Tiempo de detencion: </strong>'.$rowdata['Tiempo'].'<br/>';
				//Reviso si tiene sensores activos
				$ndata = 0;
				for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
					$ndata++;
				}
				//si hay datos se imprime
				if($ndata!=0){
					$explanation .= '<strong>Medicion Sensores: </strong><br/>';
					for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
						if(isset($rowMedicion['Sensor_'.$i])&&$rowMedicion['Sensor_'.$i]!=999){$xdata=Cantidades_decimales_justos($rowMedicion['Sensor_'.$i]);}else{$xdata='Sin Datos';}
						$explanation .= '<strong>'.$rowMedicion['SensoresNombre_'.$i].': </strong>';
						foreach ($arrUnimed as $sen) {
							if($rowMedicion['SensoresUniMed_'.$i]==$sen['idUniMed']){
								$explanation .= ' '.$sen['Nombre'];	
							}
						}
						$explanation .= '<br/>';
					}
				}		
				echo mapa1($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Equipos', 'Datos', $explanation, $_SESSION['usuario']['basic_data']['Config_IDGoogle'])?>
					
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
