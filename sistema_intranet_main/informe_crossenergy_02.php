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
$original = "informe_crossenergy_02.php";
$location = $original;
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

//se verifica si se ingreso la hora, es un dato optativo
$z='';
$search  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$search .= '&idGrupo='.$_GET['idGrupo'].'&idTelemetria='.$_GET['idTelemetria'].'&f_inicio='.$_GET['f_inicio'].'&f_termino='.$_GET['f_termino'];
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" WHERE (telemetria_listado_crossenergy_hora.TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
	$search.="&h_inicio=".$_GET['h_inicio']."&h_termino=".$_GET['h_termino'];
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (telemetria_listado_crossenergy_hora.FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
$z.=" AND telemetria_listado_crossenergy_hora.idTelemetria=".$_GET['idTelemetria'];

//numero sensores equipo
$N_Maximo_Sensores = 72;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
    $consql .= ',telemetria_listado.SensoresNombre_'.$i.' AS SensoresNombre_'.$i;
    $consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
    $consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
    $consql .= ',telemetria_listado.SensoresActivo_'.$i.' AS SensoresActivo_'.$i;
    $consql .= ',telemetria_listado_crossenergy_hora.Sensor_'.$i.' AS SensorValue_'.$i;
   
}
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.cantSensores AS cantSensores,
telemetria_listado_crossenergy_hora.FechaSistema,
telemetria_listado_crossenergy_hora.HoraSistema
".$consql."
FROM `telemetria_listado_crossenergy_hora`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = telemetria_listado_crossenergy_hora.idTelemetria

".$z."
ORDER BY telemetria_listado_crossenergy_hora.FechaSistema ASC,
telemetria_listado_crossenergy_hora.HoraSistema ASC
LIMIT 10000";
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
array_push( $arrRutas,$row );
}

//Se trae el dato del grupo
$rowGrupo = db_select_data (false, 'Nombre', 'telemetria_listado_grupos', '', 'idGrupo='.$_GET['idGrupo'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowGrupo');
				
//Variables
$chain          = '';
$chain_title    = '';
$m_table        = '';
$m_table_title  = '';
$count          = 0;

//se arman datos
foreach ($arrRutas as $fac) {
								
	//numero sensores equipo
	$N_Maximo_Sensores = $fac['cantSensores'];
	$chain            .= "['".Fecha_estandar($fac['FechaSistema'])." - ".Hora_estandar($fac['HoraSistema'])."'";
	$m_table          .= '<tr class="odd"><td>'.fecha_estandar($fac['FechaSistema']).'</td><td>'.$fac['HoraSistema'].'</td>';
											
	for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
		if($fac['SensoresGrupo_'.$x]==$_GET['idGrupo']){
			//Verifico si el sensor esta activo para guardar el dato
			if(isset($fac['SensoresActivo_'.$x])&&$fac['SensoresActivo_'.$x]==1){
				//Que el valor medido sea distinto de 999
				if(isset($fac['SensorValue_'.$x])&&$fac['SensorValue_'.$x]<99900){
					//Graficos
					$chain   .= ", ".$fac['SensorValue_'.$x];
					$m_table .= '<td>'.cantidades($fac['SensorValue_'.$x], 2).'</td>';
					//si es el primer recorrido
					if($count==0){
						$chain_title    .= "data.addColumn('number', '".$fac['SensoresNombre_'.$x]."');";
						$m_table_title  .= '<th>'.$fac['SensoresNombre_'.$x].'</th>';	
					}
	
				}
			}
		}
	}
	$chain  .= "],";
	$m_table .= '</tr>';
										
	$count++;	
	
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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Resumen Hora', $_SESSION['usuario']['basic_data']['RazonSocial'], 'Informe grupo '.$rowGrupo['Nombre'].' del equipo '.$arrRutas[0]['NombreEquipo']);?>
	<div class="col-md-6 col-sm-6 col-xs-12 clearfix">
		<a target="new" href="<?php echo 'informe_crossenergy_02_to_excel.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	
		<?php if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>	
			<input class="btn btn-sm btn-metis-3 pull-right margin_width fa-input" type="button" onclick="Export()" value="&#xf1c1; Exportar a PDF"/>
		<?php }else{ ?>
			<a target="new" href="<?php echo 'informe_crossenergy_02_to_pdf.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
		<?php } ?>
		
	</div>	
</div>
<div class="clearfix"></div> 



 


<?php 
//Se verifica si se pidieron los graficos
if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>google.charts.load('current', {'packages':['line','corechart']});</script>

	
	
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5> Graficos Grupo <?php echo $rowGrupo['Nombre']; ?></h5>
			</header>
			<div class="table-responsive" id="grf">	
				<script>
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
								

						var chartDiv = document.getElementById('curve_chart');

						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Fecha'); 
						<?php echo $chain_title; ?>

						data.addRows([<?php echo $chain; ?>]);

						var materialOptions = {
							/*chart: {
								title: 'Informe Sensores'
							},*/
							/*series: {
								// Gives each series an axis name that matches the Y-axis below.
								0: {axis: 'Temperatura'},
								1: {axis: 'Humedad'}
							},
							axes: {
								// Adds labels to each axis; they don't have to match the axis names.
								y: {
									Temps: {label: 'Temperatura (Celsius)'},
									Daylight: {label: 'Humedad (Porcentaje)'}
								}
							}*/
						};

						function drawMaterialChart() {
							var materialChart = new google.charts.Line(chartDiv);
							materialChart.draw(data, materialOptions);
						}

						drawMaterialChart();

					}

				</script> 
				<div id="curve_chart" style="height: 500px"></div>
									
			</div>
		</div>
	</div>
			
			
	<div class="col-sm-12" style="display: none;">

		<form method="post" id="make_pdf" action="informe_crossenergy_02_to_pdf.php">
			<input type="hidden" name="img_adj" id="img_adj" />
			
			<input type="hidden" name="idSistema"     id="idSistema"    value="<?php echo $_SESSION['usuario']['basic_data']['idSistema']; ?>" />
			<input type="hidden" name="f_inicio"      id="f_inicio"     value="<?php echo $_GET['f_inicio']; ?>" />
			<input type="hidden" name="f_termino"     id="f_termino"    value="<?php echo $_GET['f_termino']; ?>" />
			<input type="hidden" name="idTelemetria"  id="idTelemetria" value="<?php echo $_GET['idTelemetria']; ?>" />
			<input type="hidden" name="idGrupo"       id="idGrupo"      value="<?php echo $_GET['idGrupo']; ?>" />
			
			<?php if(isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''){ ?>   <input type="hidden" name="h_inicio"   id="h_inicio"  value="<?php echo $_GET['h_inicio']; ?>" /><?php } ?>
			<?php if(isset($_GET['h_termino'])&&$_GET['h_termino']!=''){ ?> <input type="hidden" name="h_termino"  id="h_termino" value="<?php echo $_GET['h_termino']; ?>" /><?php } ?>
			
			
			<button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs">Hacer PDF</button>
		
		</form>

		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/dom-to-image.min.js"></script>		
		<script>
			var node = document.getElementById('curve_chart');
			
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

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Tabla de Datos Grupo <?php echo $rowGrupo['Nombre']; ?></h5>
			
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<tr class="odd">
						<th>Fecha</th>
						<th>Hora</th>
						<?php echo $m_table_title; ?>
					</tr>
					
					<?php echo $m_table; ?>				
				                    
				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
$z = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.id_Geo='2'";	 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=9";//CrossEnergy			
}
//Se escribe el dato
$Alert_Text  = 'La busqueda esta limitada a 10.000 registros, en caso de necesitar mas registros favor comunicarse con el administrador';
alert_post_data(2,1,1, $Alert_Text);
?>	
		
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Filtro de busqueda</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
               
               <?php 
				//Se verifican si existen los datos
				if(isset($f_inicio)) {      $x1  = $f_inicio;     }else{$x1  = '';}
				if(isset($f_termino)) {     $x2  = $f_termino;    }else{$x2  = '';}
				if(isset($h_inicio)) {      $x3  = $h_inicio;     }else{$x3  = '';}
				if(isset($h_termino)) {     $x4  = $h_termino;    }else{$x4  = '';}
				if(isset($idTelemetria)) {  $x5  = $idTelemetria; }else{$x5  = '';}
				if(isset($idGrafico)) {     $x8  = $idGrafico;    }else{$x8  = '';}
				//Si es redireccionado desde otra pagina con datos precargados
				if(isset($_GET['view'])&&$_GET['view']!='') { $x5  = $_GET['view']; }
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Inicio','f_inicio', $x1, 2);
				$Form_Inputs->form_date('Fecha Termino','f_termino', $x2, 2);
				$Form_Inputs->form_time('Hora Inicio','h_inicio', $x3, 1, 1);
				$Form_Inputs->form_time('Hora Termino','h_termino', $x4, 1, 1);
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				
				
				//numero sensores equipo
				$N_Maximo_Sensores = 72;
				$subquery = '';
				for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
					$subquery .= ',SensoresGrupo_'.$i;
					$subquery .= ',SensoresNombre_'.$i;
					$subquery .= ',SensoresActivo_'.$i;
				}
				// Se trae un listado de todos los registros
				$arrSelect = array();
				$query = "SELECT
				idTelemetria, cantSensores
				".$subquery."
				
				FROM `telemetria_listado`
				ORDER BY idTelemetria ASC";
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
				array_push( $arrSelect,$row );
				}

				//Se traen todos los grupos
				$arrGrupos = array();
				$query = "SELECT idGrupo,Nombre
				FROM `telemetria_listado_grupos`
				ORDER BY idGrupo ASC";
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
				array_push( $arrGrupos,$row );
				}
			
				
				$input = '<div class="form-group" id="div_sensorn" >
								<label for="text2" class="control-label col-sm-4">Grupos</label>
								<div class="col-sm-8 field">
									<select name="idGrupo" id="idGrupo" class="form-control" required="">
										<option value="" selected>Seleccione una Opcion</option>
									</select>
								</div>
							</div>';
					
				//script
				$input .= '<script>';
				
				$input .= 'document.getElementById("idTelemetria").onchange = function() {cambia_idTelemetria()};';
					
				foreach ($arrSelect as $select) {
					$input .= 'var id_data_'.$select['idTelemetria'].'=new Array(""';
					$valorx = 0;
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							//verifico que el grupo no este ingresado
							if($valorx != $select['SensoresGrupo_'.$i]){
								$valorx = $select['SensoresGrupo_'.$i];
								$input .= ',"'.$valorx.'"';
							}
						}
					}	
					$input .= ')
					';
				}
				foreach ($arrSelect as $select) {
							
					$input .= 'var data_'.$select['idTelemetria'].'=new Array("Seleccione una Opcion"';
					$valorx = 0;
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							//verifico que el grupo no este ingresado
							if($valorx != $select['SensoresGrupo_'.$i]){
								$grupo = '';
								foreach ($arrGrupos as $sen) { 
									if($select['SensoresGrupo_'.$i]==$sen['idGrupo']){
										$grupo = $sen['Nombre'];
									}
								}
								$input .= ',"'.$grupo.'"';
								$valorx = $select['SensoresGrupo_'.$i];
							}
						}
					}	
					$input .= ')
					';
				}	
					
				$input .= 'function cambia_idTelemetria(){
					var Componente
					Componente = document.form1.idTelemetria[document.form1.idTelemetria.selectedIndex].value
					try {
					if (Componente != "") {
						id_data=eval("id_data_" + Componente)
						data=eval("data_" + Componente)
						num_int = id_data.length
						document.form1.idGrupo.length = num_int
						for(i=0;i<num_int;i++){
						   document.form1.idGrupo.options[i].value=id_data[i]
						   document.form1.idGrupo.options[i].text=data[i]
						}
						document.getElementById("div_sensorn").style.display = "block";	
					}else{
						document.form1.idGrupo.length = 1
						document.form1.idGrupo.options[0].value = ""
						document.form1.idGrupo.options[0].text = "Seleccione una Opcion"
						document.getElementById("div_sensorn").style.display = "none";
					}
					} catch (e) {
					document.form1.idGrupo.length = 1
					document.form1.idGrupo.options[0].value = ""
					document.form1.idGrupo.options[0].text = "Seleccione una Opcion"
					document.getElementById("div_sensorn").style.display = "none";
					
				}
					document.form1.idGrupo.options[0].selected = true
				}
				</script>';					
				
				echo $input;	
				
				$Form_Inputs->form_select('Mostrar Graficos','idGrafico', $x8, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);		
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
