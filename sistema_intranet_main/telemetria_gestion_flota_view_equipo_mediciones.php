<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

$aa = '';
for ($i = 1; $i <= $_GET['cantSensores']; $i++) {
	$aa .= ',SensoresNombre_'.$i;
	$aa .= ',SensoresUniMed_'.$i;
	$aa .= ',SensoresMedActual_'.$i;
	$aa .= ',SensoresActivo_'.$i;
}
	

// consulto los datos
$query = "SELECT GeoLatitud, GeoLongitud, GeoVelocidad, LastUpdateFecha, LastUpdateHora,Nombre,id_Geo

".$aa."
FROM `telemetria_listado`
WHERE idTelemetria = ".$_GET['view'];
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
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnimed');

$arrFinalUnimed = array();
foreach ($arrUnimed as $sen) {
	$arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];
}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['Nombre']; ?></h5>
		</header>
        <div class="table-responsive">
			<?php
			$explanation  = '<strong>'.fecha_estandar($rowdata['LastUpdateFecha']).' - '.$rowdata['LastUpdateHora'].'</strong><br/>';
			if(isset($rowdata['id_Geo'])&&$rowdata['id_Geo']!=''&&$rowdata['id_Geo']==1){
				$explanation .= '<strong>Velocidad: </strong>'.Cantidades($rowdata['GeoVelocidad'], 0).' KM/h<br/>';
			}
			for ($i = 1; $i <= $_GET['cantSensores']; $i++) {
				//solo sensores activos
				if(isset($rowdata['SensoresActivo_'.$i])&&$rowdata['SensoresActivo_'.$i]==1){
					if(isset($rowdata['SensoresMedActual_'.$i])&&$rowdata['SensoresMedActual_'.$i]<99900){$xdata=Cantidades_decimales_justos($rowdata['SensoresMedActual_'.$i]);}else{$xdata='Sin Datos';}
					$explanation .= '<strong>'.$rowdata['SensoresNombre_'.$i].': </strong>'.$xdata;
					$explanation .= ' '.$arrFinalUnimed[$rowdata['SensoresUniMed_'.$i]];
					$explanation .= '<br/>';
				}
			}
								
			echo mapa_from_gps($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Equipos', 'Datos', $explanation, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1)?>
		
        </div>
	</div>
</div>





<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

         
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
