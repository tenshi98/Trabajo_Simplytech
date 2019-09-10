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
telemetria_listado_errores.Sensor, 
telemetria_listado_errores.Valor,
telemetria_listado_errores.Valor_min,
telemetria_listado_errores.Valor_max,
telemetria_listado_errores.GeoLatitud,
telemetria_listado_errores.GeoLongitud,
telemetria_listado.Nombre AS NombreEquipo,
SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50


FROM `telemetria_listado_errores`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria
WHERE telemetria_listado_errores.idErrores = {$_GET['view']}
AND telemetria_listado_errores.idTipo!='999'
AND telemetria_listado_errores.Valor!='999'
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


//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnimed,$row );
}
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
			//Guardo la unidad de medida
			$unimed = '';
			foreach ($arrUnimed as $sen) {
				if($rowdata['SensoresUniMed_'.$rowdata['Sensor']]==$sen['idUniMed']){
					$unimed = ' '.$sen['Nombre'];	
				}
			}
			$explanation  = '<strong>'.fecha_estandar($rowdata['Fecha']).' - '.$rowdata['Hora'].'</strong><br/>';
			$explanation .= $rowdata['Descripcion'].'<br/>';
			$explanation .= '<strong>Medida: </strong>'.Cantidades_decimales_justos($rowdata['Valor']).$unimed.'<br/>';
			$explanation .= '<strong>Min: </strong>'.Cantidades_decimales_justos($rowdata['Valor_min']).$unimed.'<br/>';
			$explanation .= '<strong>Max: </strong>'.Cantidades_decimales_justos($rowdata['Valor_max']).$unimed.'<br/>';
							
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
