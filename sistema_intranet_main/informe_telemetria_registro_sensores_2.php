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
$original = "informe_telemetria_registro_sensores_2.php";
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
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
	$search.="&f_inicio=".$_GET['f_inicio'];
	$search.="&f_termino=".$_GET['f_termino'];
	$search.="&h_inicio=".$_GET['h_inicio'];
	$search.="&h_termino=".$_GET['h_termino'];
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
	$search.="&f_inicio=".$_GET['f_inicio'];
	$search.="&f_termino=".$_GET['f_termino'];
}
$search.="&sensorn=".$_GET['sensorn'];
$search.="&idTelemetria=".$_GET['idTelemetria'];
$search.="&idDetalle=".$_GET['idDetalle'];
	
	
	
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".$_GET['sensorn']." AS SensorNombre,
telemetria_listado.SensoresGrupo_".$_GET['sensorn']." AS SensorGrupo,
telemetria_listado.SensoresMedMin_".$_GET['sensorn']." AS SensorMinMed,
telemetria_listado.SensoresMedMax_".$_GET['sensorn']." AS SensorMaxMed,

telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']." AS SensorValue,
telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".$_GET['sensorn']."


".$z."
ORDER BY FechaSistema ASC, HoraSistema ASC
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
/****************************************/
if(isset($arrRutas[0]['SensorGrupo'])&&$arrRutas[0]['SensorGrupo']!=''){
	//Se trae grupo
	$query = "SELECT Nombre
	FROM `telemetria_listado_grupos`
	WHERE idGrupo=".$arrRutas[0]['SensorGrupo'];
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
	$rowGrupo = mysqli_fetch_assoc ($resultado);
}else{
	$rowGrupo['Nombre'] = '';
}

//cuento la cantidad de registros obtenidos
$cant = 0;
foreach ($arrRutas as $fac) {
	$cant++;
}

?>	
<div class="col-sm-12 clearfix">		
	<a target="new" href="<?php echo 'informe_telemetria_registro_sensores_2_to_excel.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'informe_telemetria_registro_sensores_2_to_pdf.php?bla=bla'.$search ; ?>"   class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
</div>

<?php if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5> Graficos </h5>
				
			</header>
			<div class="table-responsive">
				
				
				<script>
					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Fecha'); 
						
						<?php $Colors  = "'#FFB347'"; ?>
						data.addColumn('number', 'Medicion');
						<?php //Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){ ?>
							<?php if(isset($cant)&&$cant<30){?>
							data.addColumn({type: 'string', role: 'annotation'});
							<?php } ?>
							<?php if(isset($arrRutas[0]['SensorMinMed'])&&$arrRutas[0]['SensorMinMed']!=0){
								$Colors .= ",'#779ECB'"; ?> 
								data.addColumn('number', 'Minimo Medicion'); 
							<?php } ?>
							<?php if(isset($arrRutas[0]['SensorMaxMed'])&&$arrRutas[0]['SensorMaxMed']!=0){
								$Colors .= ",'#C23B22'"; ?>
								data.addColumn('number', 'Maximo Medicion');
							<?php } ?>	
						<?php //Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){ ?>
							<?php if(isset($cant)&&$cant<30){?>
							data.addColumn({type: 'string', role: 'annotation'});
							<?php } ?>
						<?php } ?>
						  
						
						
						
						data.addRows([
						<?php foreach ($arrRutas as $fac) { 
							$chain  = "'".Fecha_estandar($fac['FechaSistema'])." - ".Hora_estandar($fac['HoraSistema'])."'";
							$chain .= ", ".$fac['SensorValue'];
							//Que el valor medido sea distinto de 999
							if(isset($fac['SensorValue'])&&$fac['SensorValue']<99900){
								//Si se ven detalles
								if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
									if(isset($cant)&&$cant<30){                               $chain .= ",'".Cantidades_decimales_justos($fac['SensorValue'])."'";}
									if(isset($fac['SensorMinMed'])&&$fac['SensorMinMed']!=0){ $chain .= ", ".$fac['SensorMinMed'];}
									if(isset($fac['SensorMaxMed'])&&$fac['SensorMaxMed']!=0){ $chain .= ", ".$fac['SensorMaxMed'];}
								//Si no se ven detalles	
								}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
									if(isset($cant)&&$cant<30){                               $chain .= ",'".Cantidades_decimales_justos($fac['SensorValue'])."'";}		
								}
							}	
						?>	
							[<?php echo $chain; ?>],
						<?php } ?>
						  
						]);

						var options = {
							title: 'Informe Sensor <?php echo $rowGrupo['Nombre'].' '.$arrRutas[0]['SensorNombre']; ?> ',
							hAxis: { 
								title: 'Fechas',
								<?php if(isset($cant)&&$cant>=30){?> 
									baselineColor: '#fff',
									gridlineColor: '#fff',
									textPosition: 'none'
								<?php } ?>
							},
							vAxis: { title: 'Medicion' },
							curveType: 'function',
							//puntos dentro de las curvas
							series: {
								0: {
									pointsVisible: true
								},
								 
							},
			
							annotations: {
										  alwaysOutside: true,
										  textStyle: {
											fontSize: 14,
											color: '#000',
											auraColor: 'none'
										  }
										},
							colors: [<?php echo $Colors; ?>]
						};

						var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

						chart.draw(data, options);
					}

				</script> 
				<div id="curve_chart1" style="height: 500px"></div>
							
			</div>
		</div>
	</div>
<?php } ?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Informe Sensor <?php echo $rowGrupo['Nombre'].' '.$arrRutas[0]['SensorNombre']; ?></h5>
			
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Fecha</th>
						<th>Hora</th>
						<?php
						//Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
							echo '<th>Medicion</th><th>Minimo</th><th>Maximo</th>';
						//Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
							echo '<th>Medicion</th>';
						}
						?>
						<th width="90">Ubicacion</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrRutas as $rutas) { 
					if(isset($rutas['SensorValue'])&&$rutas['SensorValue']<99900){$xdata=Cantidades_decimales_justos($rutas['SensorValue']).' '.$rutas['Unimed'];}else{$xdata='Sin Datos';}?>
					<tr class="odd">
						<td><?php echo $rutas['FechaSistema']; ?></td>
						<td><?php echo $rutas['HoraSistema']; ?></td>
						<?php //Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
							echo '<td>'.$xdata.'</td>';
							echo '<td>'.Cantidades_decimales_justos($rutas['SensorMinMed']).' '.$rutas['Unimed'].'</td>';
							echo '<td>'.Cantidades_decimales_justos($rutas['SensorMaxMed']).' '.$rutas['Unimed'].'</td>';
						//Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
							echo '<td>'.$xdata.'</td>';
						} ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo 'informe_telemetria_registro_sensores_2_view.php?idTelemetria='.simpleEncode($_GET['idTelemetria'], fecha_actual()).'&sensorn='.simpleEncode($_GET['sensorn'], fecha_actual()).'&view='.simpleEncode($rutas['idTabla'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>                     
				</tbody>
			</table>
		</div>
	</div>
</div>



<?php widget_modal(80, 95); ?>



<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
	$z .= " AND telemetria_listado.idTab=2";//CrossC			
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
				if(isset($sensorn)) {       $x6  = $sensorn;      }else{$x6  = '';}
				if(isset($idDetalle)) {     $x7  = $idDetalle;    }else{$x7  = '';}
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
				// Se trae un listado de todas las comunas
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

				//Se consultan datos
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
								<label for="text2" class="control-label col-sm-4">Sensor</label>
								<div class="col-sm-8 field">
									<select name="sensorn" id="sensorn" class="form-control" required="">
										<option value="" selected>Seleccione una Opcion</option>
									</select>
								</div>
							</div>';
					
					//script		
				$input .= '<script>';
				
				//Si es redireccionado desde otra pagina con datos precargados
				if(isset($_GET['view'])&&$_GET['view']!='') { 
					$input .= '$(document).ready(function(){
						
						cambia_idTelemetria();
					});';
					
				}

				$input .= 'document.getElementById("idTelemetria").onchange = function() {cambia_idTelemetria()};';
					
				foreach ($arrSelect as $select) {
					$input .= 'let id_data_'.$select['idTelemetria'].'=new Array(""';
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							$input .= ',"'.$i.'"';
						}
					}	
					$input .= ')
					';
				}
				foreach ($arrSelect as $select) {
					$input .= 'let data_'.$select['idTelemetria'].'=new Array("Seleccione una Opcion"';
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							//se verifica
							$grupo = '';
							foreach ($arrGrupos as $sen) { 
								if($select['SensoresGrupo_'.$i]==$sen['idGrupo']){
									$grupo = $sen['Nombre'];
								}
							}
							$input .= ',"'.$grupo.' - '.str_replace('"', '',$select['SensoresNombre_'.$i]).'"';
						}
					}	
					$input .= ')
					';
				}



	

	
	
					$input .= 'function cambia_idTelemetria(){
					
					let Componente = document.form1.idTelemetria[document.form1.idTelemetria.selectedIndex].value
					try {
					if (Componente != "") {
						id_data = eval("id_data_" + Componente);
						data    = eval("data_" + Componente);
						num_int = id_data.length;
						document.form1.sensorn.length = num_int;
						for(i=0;i<num_int;i++){
						   document.form1.sensorn.options[i].value=id_data[i];
						   document.form1.sensorn.options[i].text=data[i];
						}
						document.getElementById("div_sensorn").style.display = "block";	
					}else{
						document.form1.sensorn.length = 1;
						document.form1.sensorn.options[0].value = "";
						document.form1.sensorn.options[0].text = "Seleccione una Opcion";
						document.getElementById("div_sensorn").style.display = "none";
					}
					} catch (e) {
					document.form1.sensorn.length = 1;
					document.form1.sensorn.options[0].value = "";
					document.form1.sensorn.options[0].text = "Seleccione una Opcion";
					document.getElementById("div_sensorn").style.display = "none";
					
				}
					document.form1.sensorn.options[0].selected = true;
				}
				</script>';					
				
				
				echo $input;		
				
				
				$Form_Inputs->form_select('Ver Otros Datos','idDetalle', $x7, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);		
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
