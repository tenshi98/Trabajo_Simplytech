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
$original = "informe_cross_weather_ejecutivo.php";
$location = $original;
//Se agregan ubicaciones
$search  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$location .= "?submit_filter=Filtrar";
if(isset($_GET['fecha_desde'])&&$_GET['fecha_desde']!=''&&isset($_GET['fecha_hasta'])&&$_GET['fecha_hasta']!=''){
	$search .="&fecha_desde=".$_GET['fecha_desde'];
	$search .="&fecha_hasta=".$_GET['fecha_hasta'];
}
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){ $search .="&idTelemetria=".$_GET['idTelemetria']; }
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
/**********************************************************/
//Seleccionar la tabla
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){ 
	$x_table = 'telemetria_listado_aux_equipo';
}else{
	$x_table = 'telemetria_listado_aux';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE ".$x_table.".idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['fecha_desde'])&&$_GET['fecha_desde']!=''&&isset($_GET['fecha_hasta'])&&$_GET['fecha_hasta']!=''){
	$z.=" AND ".$x_table.".Fecha BETWEEN '".$_GET['fecha_desde']."' AND '".$_GET['fecha_hasta']."'";
}
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){ 
	$z.=" AND ".$x_table.".idTelemetria='".$_GET['idTelemetria']."'";
}
/**********************************************************/
// Se trae un listado con todos los datos
$arrMediciones = array();
$query = "SELECT 
".$x_table.".Fecha,
".$x_table.".Hora,
".$x_table.".TimeStamp,
".$x_table.".Temperatura,
".$x_table.".PuntoRocio,
".$x_table.".PresionAtmos,
".$x_table.".HorasBajoGrados,
".$x_table.".Tiempo_Helada,
".$x_table.".Dias_acumulado,
".$x_table.".UnidadesFrio

FROM `".$x_table."`
".$z."
ORDER BY ".$x_table.".Fecha ASC";
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
array_push( $arrMediciones,$row );
}

//Variables
$arrMed             = array();
$counter            = 0;
$Var_Temperatura    = '';
$Var_Presion        = '';
$Var_UnidadDeFrio   = '';
$Var_DiasGradoAcum  = '';
				
//recorro los datos
foreach ($arrMediciones as $med) {
	//verifico que exista fecha
	if(isset($med['Fecha'])&&$med['Fecha']!='0000-00-00'){
		//Se obtiene la fecha
		$z_date  = "'".Fecha_estandar($med['Fecha'])." - ".Hora_estandar($med['Hora'])."'";
		//se arman las cadenas
		$Var_Temperatura    .= '['.$z_date.', '.$med['Temperatura'].', '.$med['PuntoRocio'].'],';
		$Var_Presion        .= '['.$z_date.', '.$med['PresionAtmos'].'],';
		$Var_UnidadDeFrio   .= '['.$z_date.', '.$med['UnidadesFrio'].'],';
		$Var_DiasGradoAcum  .= '['.$z_date.', '.$med['Dias_acumulado'].'],';
		
		//verifico cambio de dia
		if((isset($arrMed[$counter]['Fecha'])&&$arrMed[$counter]['Fecha']!=$med['Fecha']) OR $counter==0){
			$counter++;
		}
		
		//creo las variables si estas no existen
		if(!isset($arrMed[$counter]['Tiempo_Helada'])){  $arrMed[$counter]['Tiempo_Helada']  = 0;}
		if(!isset($arrMed[$counter]['Temp_Min'])){       $arrMed[$counter]['Temp_Min']       = 1000;}
		if(!isset($arrMed[$counter]['Temp_Max'])){       $arrMed[$counter]['Temp_Max']       = -1000;}
		
		//Guardo los datos
		$arrMed[$counter]['Fecha']        = $med['Fecha'];
		$arrMed[$counter]['UnidadesFrio'] = $med['UnidadesFrio'];
		$arrMed[$counter]['DiasAcum']     = $med['Dias_acumulado'];

		//verifico si hubo helada
		if(isset($med['Tiempo_Helada'])&&$med['Tiempo_Helada']!=''&&$med['Tiempo_Helada']!=0){
			//guardo el tiempo de helada
			$arrMed[$counter]['Tiempo_Helada'] = $arrMed[$counter]['Tiempo_Helada'] + $med['Tiempo_Helada']; 
		}
		//Guardo la temperatura Minima
		if(isset($med['Temperatura'])&&$med['Temperatura']<$arrMed[$counter]['Temp_Min']){
			$arrMed[$counter]['Temp_Min'] = $med['Temperatura'];
		}
		//Guardo la temperatura Maxima
		if(isset($med['Temperatura'])&&$med['Temperatura']>$arrMed[$counter]['Temp_Max']){
			$arrMed[$counter]['Temp_Max'] = $med['Temperatura'];
		}
	}
}
								
?>
<style>
#loading {display: block;position: absolute;top: 0;left: 0;z-index: 100;width: 100%;height: 100%;background-color: rgba(192, 192, 192, 0.5);background-image: url("<?php echo DB_SITE_REPO.'/LIB_assets/img/loader.gif';?>");background-repeat: no-repeat;background-position: center;}
</style>
<div id="loading"></div>
<script>
//oculto el loader
document.getElementById("loading").style.display = "none";
</script>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Informe Ejecutivo', $_SESSION['usuario']['basic_data']['RazonSocial'], 'De '.Fecha_completa($_GET['fecha_desde']).' a '.Fecha_completa($_GET['fecha_hasta']));?>
	<div class="col-md-6 col-sm-6 col-xs-12 clearfix">
		<a target="new" href="<?php echo 'informe_cross_weather_ejecutivo_to_excel.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	
		<?php if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>	
			<input class="btn btn-sm btn-metis-3 pull-right margin_width fa-input" type="button" onclick="Export()" value="&#xf1c1; Exportar a PDF"/>
		<?php }else{ ?>
			<a target="new" href="<?php echo 'informe_cross_weather_ejecutivo_to_pdf.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
		<?php } ?>
		
	</div>	
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Resumen</h5>
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Mes</th>
						<th>Dia</th>
						<th>Helada</th>
						<th>Temperatura<br/>Minima</th>
						<th>Temperatura<br/>Maxima</th>
						<th>Duracion<br/>Helada</th>
						<th>Unidades<br/>Frio</th>
						<th>Unidades Frio<br/>Acumuladas</th>
						<th>Dias<br/>Grado</th>
						<th>Dias Grado<br/>Acumuladas</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					$unifrio  = 0;
					$diasAcum = 0;
					foreach ($arrMed as $key => $med){ 
						//verifico helada
						if(isset($med['Tiempo_Helada'])&&$med['Tiempo_Helada']!=0){$helada = 'Si';}else{$helada = 'No';}
						if($unifrio==0){
							$unfrio  = $med['UnidadesFrio'];
							$unifrio = $med['UnidadesFrio'];
						}else{
							$unfrio  = $med['UnidadesFrio']-$unifrio;
							$unifrio = $med['UnidadesFrio'];
						}
						if($diasAcum==0){
							$diaAcum  = $med['DiasAcum'];
							$diasAcum = $med['DiasAcum'];
						}else{
							$diaAcum  = $med['DiasAcum']-$diasAcum;
							$diasAcum = $med['DiasAcum'];
						}
						
						?>
						<tr class="odd">		
							<td><?php echo numero_a_mes(fecha2NMes($med['Fecha'])); ?></td>	
							<td><?php echo fecha2NdiaMes($med['Fecha']); ?></td>		
							<td><?php echo $helada; ?></td>
							<td><?php echo $med['Temp_Min']; ?></td>		
							<td><?php echo $med['Temp_Max']; ?></td>		
							<td><?php echo minutos2horas($med['Tiempo_Helada']*60); ?></td>		
							<td><?php echo cantidades($unfrio, 0); ?></td>		
							<td><?php echo cantidades($med['UnidadesFrio'], 0); ?></td>		
							<td><?php echo cantidades($diaAcum, 0); ?></td>		
							<td><?php echo cantidades($med['DiasAcum'], 0); ?></td>		
							
						</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php 
//Se verifica si se pidieron los graficos
if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">google.charts.load('current', {'packages':['line','corechart']});</script>
	
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5> Graficos</h5>
			</header>
			<div class="table-responsive" id="grf">	
				<script>
					google.charts.setOnLoadCallback(drawTemperatura);
					google.charts.setOnLoadCallback(drawPresion);
					google.charts.setOnLoadCallback(drawUnidadDeFrio);
					google.charts.setOnLoadCallback(drawDiasGradoAcum);
					/*********************************************************/
					function drawTemperatura() {
						var data_1 = new google.visualization.DataTable();
						data_1.addColumn('string', 'Fecha');
						data_1.addColumn('number', 'Temperatura (°C)');
						data_1.addColumn('number', 'Punto de Rocio (°C)');
						data_1.addRows([<?php echo $Var_Temperatura; ?>]);
						
						var chart_1 = new google.charts.Line(document.getElementById('chart_Temperatura'));

						var options_1 = {
							chart: {
								title: 'Temperatura y Punto de Rocio'
							},
							series: {
								// Gives each series an axis name that matches the Y-axis below.
								0: {axis: 'Temperatura (°C)'},
								1: {axis: 'Punto de Rocio (°C)'}
							},
							axes: {
								// Adds labels to each axis; they don't have to match the axis names.
								y: {
									Temps: {label: 'Temperatura (°C)'},
									Temps: {label: 'Punto de Rocio (°C)'}
								}
							}
						};

						chart_1.draw(data_1, options_1);
					}
					/*********************************************************/
					function drawPresion() {
						var data_2 = new google.visualization.DataTable();
						data_2.addColumn('string', 'Fecha');
						data_2.addColumn('number', 'Presion Atmosferica (hPa)');
						data_2.addRows([<?php echo $Var_Presion; ?>]);
						
						var chart_2 = new google.charts.Line(document.getElementById('chart_Presion'));

						var options_2 = {
							chart: {
								title: 'Presion Atmosferica'
							},
							series: {
								// Gives each series an axis name that matches the Y-axis below.
								0: {axis: 'Presion Atmosferica (hPa)'}
							},
							axes: {
								// Adds labels to each axis; they don't have to match the axis names.
								y: {
									Temps: {label: 'Presion Atmosferica (hPa)'}
								}
							}
						};

						chart_2.draw(data_2, options_2);
					}
					/*********************************************************/
					function drawUnidadDeFrio() {
						var data_3 = new google.visualization.DataTable();
						data_3.addColumn('string', 'Fecha');
						data_3.addColumn('number', 'Unidades de Frio');
						data_3.addRows([<?php echo $Var_UnidadDeFrio; ?>]);
						
						var chart_3 = new google.charts.Line(document.getElementById('chart_UnidadDeFrio'));

						var options_3 = {
							chart: {
								title: 'Unidades de Frio'
							},
							series: {
								// Gives each series an axis name that matches the Y-axis below.
								0: {axis: 'Unidades de Frio'}
							},
							axes: {
								// Adds labels to each axis; they don't have to match the axis names.
								y: {
									Temps: {label: 'Unidades de Frio'}
								}
							}
						};

						chart_3.draw(data_3, options_3);
					}
					/*********************************************************/
					function drawDiasGradoAcum() {
						var data_4 = new google.visualization.DataTable();
						data_4.addColumn('string', 'Fecha');
						data_4.addColumn('number', 'Acumulado Dias Grado');
						data_4.addRows([<?php echo $Var_DiasGradoAcum; ?>]);
						
						var chart_4 = new google.charts.Line(document.getElementById('chart_DiasGradoAcum'));

						var options_4 = {
							chart: {
								title: 'Acumulado Dias Grado'
							},
							series: {
								// Gives each series an axis name that matches the Y-axis below.
								0: {axis: 'Acumulado Dias Grado'}
							},
							axes: {
								// Adds labels to each axis; they don't have to match the axis names.
								y: {
									Temps: {label: 'Acumulado Dias Grado'}
								}
							}
						};

						chart_4.draw(data_4, options_4);
					}
					
					


				</script> 
				<div id="chart_Temperatura"    style="width: 95%; height: 500px; margin-bottom:10px;"></div>
				<div id="chart_Presion"        style="width: 95%; height: 500px; margin-bottom:10px;"></div>
				<div id="chart_UnidadDeFrio"   style="width: 95%; height: 500px; margin-bottom:10px;"></div>
				<div id="chart_DiasGradoAcum"  style="width: 95%; height: 500px; margin-bottom:10px;"></div>
									
			</div>
		</div>
	</div>
			
			
	<div class="col-sm-12" style="display: none;">

		<form method="post" id="make_pdf" action="informe_cross_weather_ejecutivo_to_pdf.php">
			<input type="hidden" name="img_adj" id="img_adj" />
			
			<input type="hidden" name="idSistema"     id="idSistema"    value="<?php echo $_SESSION['usuario']['basic_data']['idSistema']; ?>" />
			<input type="hidden" name="fecha_desde"   id="fecha_desde"  value="<?php echo $_GET['fecha_desde']; ?>" />
			<input type="hidden" name="fecha_hasta"   id="fecha_hasta"  value="<?php echo $_GET['fecha_hasta']; ?>" />
			<?php if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){ ?>
				<input type="hidden" name="idTelemetria"   id="idTelemetria"  value="<?php echo $_GET['idTelemetria']; ?>" />
			<?php }?>
			
			<button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs">Hacer PDF</button>
		
		</form>

		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/dom-to-image.min.js"></script>		
		<script>
			var node = document.getElementById('grf');
					
			function sendDatatoSRV(img) {
				$('#img_adj').val(img);
				//$('#img_adj').val($('#img-out').html());
				$('#make_pdf').submit();
				//oculto el loader
				document.getElementById("loading").style.display = "none";
			}
			function Export() {
				//muestro el loader
				document.getElementById("loading").style.display = "block";
				//Exporto
				setTimeout(
					function(){
						domtoimage.toPng(node)
						.then(function (dataUrl) {
							var img = new Image();
							img.src = dataUrl;
							//document.getElementById('img-out').appendChild(img);
							//alert(img.src);
							sendDatatoSRV(img.src);
						})
						.catch(function (error) {
							console.error('oops, something went wrong!', error);
						});		
					}
				, 3000);
			}
		</script>	
	</div>	
<?php } ?>


<?php widget_modal(80, 95); ?>
  
<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  {
//Filtro de busqueda
$z  = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];   //Sistema
$z .= " AND telemetria_listado.id_Geo=2";                                                //Geolocalizacion inactiva
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=4";//CrossWeather			
}	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($fecha_desde)) {    $x1  = $fecha_desde;    }else{$x1  = '';}
				if(isset($fecha_hasta)) {    $x2  = $fecha_hasta;    }else{$x2  = '';}
				if(isset($idGrafico)) {      $x3  = $idGrafico;      }else{$x3  = '';}
				if(isset($idTelemetria)) {   $x4  = $idTelemetria;   }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Desde','fecha_desde', $x1, 2);
				$Form_Inputs->form_date('Fecha Hasta','fecha_hasta', $x2, 2);
				$Form_Inputs->form_select('Mostrar Graficos','idGrafico', $x3, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);		
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x4, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x4, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}		
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
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
