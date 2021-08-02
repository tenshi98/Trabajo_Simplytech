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
$original = "informe_telemetria_registro_velocidad.php";
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
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.LimiteVelocidad,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".GeoVelocidad

FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

".$z."
ORDER BY telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC
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

//cuento la cantidad de registros obtenidos
$cant = 0;
foreach ($arrRutas as $fac) {
	$cant++;
}
?>	

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
					<?php if(isset($cant)&&$cant<30){?>
					data.addColumn({type: 'string', role: 'annotation'});
					<?php } ?>
					<?php if(isset($arrRutas[0]['LimiteVelocidad'])&&$arrRutas[0]['LimiteVelocidad']!=0){
						$Colors .= ",'#C23B22'"; ?> 
						data.addColumn('number', 'Limite Velocidad'); 
					<?php } ?>
					
					  
					
					
					
					data.addRows([
					<?php foreach ($arrRutas as $fac) { 
						$chain  = "'".Fecha_estandar($fac['FechaSistema'])."'";
						$chain .= ", ".$fac['GeoVelocidad'];
						if(isset($cant)&&$cant<30){                                     $chain .= ",'".Cantidades_decimales_justos($fac['GeoVelocidad'])."'";}
						if(isset($fac['LimiteVelocidad'])&&$fac['LimiteVelocidad']!=0){ $chain .= ", ".$fac['LimiteVelocidad'];}
		
						
					?>	
						[<?php echo $chain; ?>],
					<?php } ?>
					  
					]);

					var options = {
						title: 'Informe Velocidades equipo <?php echo $arrRutas[0]['NombreEquipo']; ?> ',
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


<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Informe Velocidades equipo <?php echo $arrRutas[0]['NombreEquipo']; ?></h5>
			
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Fecha</th>
						<th>Hora</th>
						<th>Velocidad</th>
						<th>Limite Velocidad</th>
						<th width="90">Ubicacion</th> 
					</tr>
				</thead>
			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrRutas as $rutas) { ?>
					<tr class="odd">
						<td><?php echo $rutas['FechaSistema']; ?></td>
						<td><?php echo $rutas['HoraSistema'].' hrs'; ?></td>
						<td><?php echo Cantidades($rutas['GeoVelocidad'], 0).' KM/h'; ?></td>
						<td><?php echo Cantidades($rutas['LimiteVelocidad'], 0).' KM/h'; ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo 'informe_telemetria_registro_velocidad_view.php?idTelemetria='.simpleEncode($_GET['idTelemetria'], fecha_actual()).'&view='.simpleEncode($rutas['idTabla'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
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
$z = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.id_Geo=1";	 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=3";//CrossTrack			
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
