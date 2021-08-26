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
/*                                                      Consulta                                                                  */
/**********************************************************************************************************************************/
//variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
$eq_alertas     = 0; 
$eq_fueralinea  = 0; 
$eq_fueraruta   = 0;
$eq_detenidos   = 0;
$eq_ok = '<a href="#" title="Sin Problemas" class="btn btn-success btn-sm tooltip"><i class="fa fa-check" aria-hidden="true"></i></a>';								

//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
$z .= " AND telemetria_listado.id_Geo = 2";//solo los equipos que tengan el seguimiento desactivado
//verifico que sea un administrador
$z .= " AND telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
if (isset($_GET['idCiudad'])&&$_GET['idCiudad']!=''){
	$z .= " AND telemetria_listado.idCiudad=".$_GET['idCiudad'];
}
if (isset($_GET['idComuna'])&&$_GET['idComuna']!=''){
	$z .= " AND telemetria_listado.idComuna=".$_GET['idComuna'];	
}
if (isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z .= " AND telemetria_listado.idTelemetria=".$_GET['idTelemetria'];
}

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresMedActual_'.$i;
	$subquery .= ',SensoresUniMed_'.$i;
	$subquery .= ',SensoresMedErrores_'.$i;
	$subquery .= ',SensoresErrorActual_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}				
//Listar los equipos
$arrUsers = array();
$query = "SELECT 
GeoLatitud, GeoLongitud,idTelemetria,Nombre,
LastUpdateHora,LastUpdateFecha, cantSensores,TiempoFueraLinea
".$subquery."

FROM `telemetria_listado`
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
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
array_push( $arrUsers,$row );
}

//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUnimed');

$arrFinalUnimed = array();
foreach ($arrUnimed as $sen) {
	$arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];
}
?>
<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
	<thead>
		<tr role="row">
			<th>Nombre</th>
			<th>Estado</th>
			<th width="160">Acciones</th>
		</tr>
	</thead>
	<tbody role="alert" aria-live="polite" aria-relevant="all">
		<?php foreach ($arrUsers as $data) { 
									
			//alertas
			$xx = 0;
			$xy = 0;
			$xz = 0;
			$dataex = '';
			$eq_ok = '<a href="#" title="Sin Problemas" class="btn btn-success btn-sm tooltip"><i class="fa fa-check" aria-hidden="true"></i></a>';
			for ($i = 1; $i <= $data['cantSensores']; $i++) {
				//solo sensores activos
				if(isset($data['SensoresActivo_'.$i])&&$data['SensoresActivo_'.$i]==1){ 
					$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
					if($xx<0){$xy = 1;$eq_ok = '';}
				}
			}
			$eq_alertas = $eq_alertas + $xy;
									
			//Fuera de linea
			//Verifico la resta de la hora de la ulima actualizacion contra  la hora actual
			$diaInicio   = $data['LastUpdateFecha'];
			$diaTermino  = $FechaSistema;
			$tiempo1     = $data['LastUpdateHora'];
			$tiempo2     = $HoraSistema;
			//calculo diferencia de dias
			$n_dias = dias_transcurridos($diaInicio,$diaTermino);
			//calculo del tiempo transcurrido
			$Tiempo = restahoras($tiempo1, $tiempo2);
			//Calculo del tiempo transcurrido
			if($n_dias!=0){
				if($n_dias>=2){
					$n_dias = $n_dias-1;
					$horas_trans2 = multHoras('24:00:00',$n_dias);
					$Tiempo = sumahoras($Tiempo,$horas_trans2);
				}
				if($n_dias==1&&$tiempo1<$tiempo2){
					$horas_trans2 = multHoras('24:00:00',$n_dias);
					$Tiempo = sumahoras($Tiempo,$horas_trans2);
				}
			}
			if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){
				$eq_fueralinea = $eq_fueralinea + 1;	
				$eq_ok = '';
			}
									
									
									
			//equipos ok
			if($eq_alertas>0){$xz = 1;$dataex .= '<a href="#" title="Con Alertas" class="btn btn-danger btn-sm tooltip"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>';}
			if($eq_fueralinea>0){$xz = 1;$dataex .= '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken" aria-hidden="true"></i></a>';}
									
			$eq_ok .= $dataex;
									
									
			?>
			<tr class="odd <?php if($xz!=0){echo 'danger';}?>">		
				<td><?php echo $data['Nombre']; ?></td>		
				<td><div class="btn-group" ><?php echo $eq_ok; ?></div></td>			
				<td>
					<div class="btn-group" style="width: 35px;" >
						<a href="<?php echo 'telemetria_gestion_sensores_view_equipo.php?view='.simpleEncode($data['idTelemetria'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>						
					</div>
				</td>
			</tr>
		<?php } ?>                    
	</tbody>
</table>

<script>
	var marcadores_ex = [
		<?php 
		$in=0;
		foreach ($arrUsers as $rowdata) { 
			$explanation = "<div class='iw-subTitle'>Equipo: ".$rowdata['Nombre']."</div>";
			$explanation .= '<p>'.fecha_estandar($rowdata['LastUpdateFecha']).' - '.$rowdata['LastUpdateHora'].'</p>';
			$explanation .= "<div class='iw-subTitle'>Sensores: </div><p>";
			for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
				//Unidad medida
				$unimed = ' '.$arrFinalUnimed[$rowdata['SensoresUniMed_'.$i]];
				//cadena
				if(isset($rowdata['SensoresMedActual_'.$i])&&$rowdata['SensoresMedActual_'.$i]<99900){$xdata=Cantidades_decimales_justos($rowdata['SensoresMedActual_'.$i]).$unimed;}else{$xdata='Sin Datos';}
				$explanation .= $rowdata['SensoresNombre_'.$i].' : '.$xdata.'<br/>';
			}
			$explanation .= '</p>';	
					
			if($in==0){$in=1;}else{echo ',';}?>
			{  
				contenido: 	"<div id='iw-container'>" +
							"<div class='iw-title'>Datos</div>" +
							"<div class='iw-content'>" +
							"<?php echo $explanation; ?>" +
							"</div>" +
							"<div class='iw-bottom-gradient'></div>" +
							"</div>"			 
			}
		<?php } ?>
	];
</script>

<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".iframe").colorbox({iframe:true, width:"80%", height:"95%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert('onOpen: colorbox is about to open'); },
			onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
			onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
			onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
			onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
		});

				
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
