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
	
	
	
// Se traen todos los datos de mi usuario
$query = "SELECT GeoLatitud, GeoLongitud, LastUpdateFecha, LastUpdateHora,Nombre,id_Geo
".$aa."
FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['view']}";
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

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['Nombre']; ?></h5>
				
		</header>
        <div class="table-responsive">
			<?php 
			$explanation  = '<strong>'.fecha_estandar($rowdata['LastUpdateFecha']).' - '.$rowdata['LastUpdateHora'].'</strong><br/>';
			for ($i = 1; $i <= $_GET['cantSensores']; $i++) { 
				//solo sensores activos
				if(isset($rowdata['SensoresActivo_'.$i])&&$rowdata['SensoresActivo_'.$i]==1){
					//se registra la medicion							
					if(isset($rowdata['SensoresMedActual_'.$i])&&$rowdata['SensoresMedActual_'.$i]!=999){$xdata=Cantidades_decimales_justos($rowdata['SensoresMedActual_'.$i]);}else{$xdata='Sin Datos';}
					$explanation .= '<strong>'.$rowdata['SensoresNombre_'.$i].': </strong>'.$xdata;
					foreach ($arrUnimed as $sen) {
						if($rowdata['SensoresUniMed_'.$i]==$sen['idUniMed']){
							$explanation .= ' '.$sen['Nombre'];	
						}
					}
					$explanation .= '<br/>';
				}
			}
								
			echo mapa1($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Equipos', 'Datos', $explanation, $_SESSION['usuario']['basic_data']['Config_IDGoogle'])
			?>
			

        </div>	
	</div>
</div>





<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

         
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
