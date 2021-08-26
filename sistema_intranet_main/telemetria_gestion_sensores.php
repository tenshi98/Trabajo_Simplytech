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
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "telemetria_gestion_sensores.php";
$location = $original;  
//Se agregan ubicaciones
$location .='?filtro=true';	  
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) {
//Variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
$eq_alertas     = 0; 
$eq_fueralinea  = 0; 
$eq_fueraruta   = 0;
$eq_detenidos   = 0;

//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
$z .= " AND telemetria_listado.id_Geo = 2";//solo los equipos que tengan el seguimiento desactivado
$enlace = "?dd=true";
//verifico que sea un administrador
$z .= " AND telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
$enlace .= "&idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

if (isset($_GET['idCiudad'])&&$_GET['idCiudad']!=''){
	$z .= " AND telemetria_listado.idCiudad=".$_GET['idCiudad'];
	$enlace .= "&idCiudad=".$_GET['idCiudad'];	
}
if (isset($_GET['idComuna'])&&$_GET['idComuna']!=''){
	$z .= " AND telemetria_listado.idComuna=".$_GET['idComuna'];
	$enlace .= "&idComuna=".$_GET['idComuna'];	
}
if (isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z .= " AND telemetria_listado.idTelemetria=".$_GET['idTelemetria'];
	$enlace .= "&idTelemetria=".$_GET['idTelemetria'];	
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

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Gestion de Sensores en Tiempo Real</h5>	
		</header>
        <div class="table-responsive">
			
			<div class="col-sm-4">
				<div class="row">
					<div id="consulta">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Nombre</th>
									<th>Estado</th>
									<th width="80">Acciones</th>
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
					</div>
				</div>
			</div>
			
			<div class="col-sm-8">
				<div class="row">	
					
					<?php
					//Si no existe una ID se utiliza una por defecto
					if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
						$Alert_Text  = 'No ha ingresado Una API de Google Maps.';
						alert_post_data(4,2,2, $Alert_Text);
					}else{
						$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>
						<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>
						
						<script type="text/javascript">
							
							var marker;	
							var infowindow = new google.maps.InfoWindow({  
								content: ''
							});
							var map;
										
							var marcadores = [
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
										position: {
											lat: <?php echo $rowdata['GeoLatitud']; ?>,
											lng: <?php echo $rowdata['GeoLongitud']; ?>
										},
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
													
													
							function initialize() {
								var myLatlng = new google.maps.LatLng(-33.4691, -70.642);
								var opciones = {  
									zoom: 12,
									center: myLatlng,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								};
								var div = document.getElementById('map_canvas');  
								map = new google.maps.Map(div, opciones);  
								

								for (let i = 0, j = marcadores.length; i < j; i++) {  
									var contenido = marcadores[i].contenido;
									marker = new google.maps.Marker({
										position	: new google.maps.LatLng(marcadores[i].position.lat, marcadores[i].position.lng),
										map			: map,
										animation 	: google.maps.Animation.DROP,
										icon      	: "<?php echo DB_SITE_REPO ?>/LIB_assets/img/map-icons/1_series_orange.png"
									});
									(function(marker, contenido) {
										google.maps.event.addListener(marker, 'click', function() {
											infowindow.setContent(contenido);
											infowindow.open(map, marker);
										});
										//Abrir por defecto
										infowindow.setContent(contenido);
										infowindow.open(map, marker);
									})(marker, contenido);
									//centralizo el mapa en base al ultimo dato obtenido
									map.panTo(marker.getPosition());
								}
													
								transMarker(10000);
								
								// *
								// START INFOWINDOW CUSTOMIZE.
								// The google.maps.event.addListener() event expects
								// the creation of the infowindow HTML structure 'domready'
								// and before the opening of the infowindow, defined styles are applied.
								// *
								google.maps.event.addListener(infowindow, 'domready', function() {

									// Reference to the DIV that wraps the bottom of infowindow
									var iwOuter = $('.gm-style-iw');

									/* Since this div is in a position prior to .gm-div style-iw.
									* We use jQuery and create a iwBackground variable,
									* and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
									*/
									var iwBackground = iwOuter.prev();

									// Removes background shadow DIV
									iwBackground.children(':nth-child(2)').css({'display' : 'none'});

									// Removes white background DIV
									iwBackground.children(':nth-child(4)').css({'display' : 'none'});

									// Moves the infowindow 25px to the right.
									//iwOuter.parent().parent().css({left: '5px'});

									// Moves the shadow of the arrow 76px to the left margin.
									iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 6px !important;'});

									// Moves the arrow 76px to the left margin.
									iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 6px !important;'});

									// Changes the desired tail shadow color.
									iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

									// Reference to the div that groups the close button elements.
									var iwCloseBtn = iwOuter.next();

									// Apply the desired effect to the close button
									iwCloseBtn.css({width: '28px',height: '28px', opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

									// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
									if($('.iw-content').height() < 140){
										$('.iw-bottom-gradient').css({display: 'none'});
									}

									// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
									iwCloseBtn.mouseout(function(){
										$(this).css({opacity: '1'});
									});
								});					
													
							} 
							/* ************************************************************************** */
							function transMarker(time) {
								setInterval(function(){myTimer2()},time);
							}
												
							var mapax = 0;	
							function myTimer2() {

								switch(mapax) {
									//Ejecutar formulario con el recorrido y la ruta
									case 1:
										$('#consulta').load('telemetria_gestion_sensores_update.php<?php echo $enlace; ?>');
										break;
									
									//se dibujan los iconos de los buses	
									case 2:
										//Los demas buses
										for (let i = 0, j = marcadores_ex.length; i < j; i++) {  
											var contenido = marcadores_ex[i].contenido;
											
											(function(marker, contenido) {
												google.maps.event.addListener(marker, 'click', function() {
													infowindow.setContent(contenido);
													infowindow.open(map, marker);
												});
												//Abrir por defecto
												infowindow.setContent(contenido);
												infowindow.open(map, marker);
											})(marker, contenido);
										}					

										break;		
								}

								mapax++;	
								if(mapax==3){mapax=1}
							} 
						</script>

						<div id="map_canvas" style="width: 100%; height: 550px;"><script type="text/javascript">initialize();</script></div>

					<?php } ?>
				</div>
			</div>
			
			
			
		</div>	
	</div>
</div>


<?php widget_modal(80, 95); ?>

  
<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND id_Geo=2";	
}else{
	//filtro
	$z = "idTelemetria=0";
	//Se revisan los permisos a los contratos
	$arrPermisos = array();
	$query = "SELECT idTelemetria
	FROM `usuarios_equipos_telemetria`
	WHERE idUsuario=".$_SESSION['usuario']['basic_data']['idUsuario'];
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
	array_push( $arrPermisos,$row );
	}
	foreach ($arrPermisos as $prod) {
		$z .= " OR (idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1 AND id_Geo=2 AND idTelemetria={$prod['idTelemetria']})";
	}	
}	 
?>


<div class="col-sm-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>	
		</header>
		
        <div id="div-3" class="tab-content body">
			
			
				<div class="wmd-panel">
					<form class="form-horizontal" action="<?php echo $original; ?>" id="form1" name="form2" novalidate>
						<?php
						//Se verifican si existen los datos
						if(isset($idTelemetria)) {   $x1  = $idTelemetria;    }else{$x1  = '';}
			
						//se dibujan los inputs
						$Form_Inputs = new Form_Inputs();
						$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);
						
						?>
						<div class="form-group">
							<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
						</div>
						<div class="clearfix"></div>
					</form>
				</div>
			
			<?php widget_validator(); ?>	
			
        </div>	
	</div>
</div>





<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
