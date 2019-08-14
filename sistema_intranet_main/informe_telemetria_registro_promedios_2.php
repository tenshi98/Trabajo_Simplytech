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
$original = "informe_telemetria_registro_promedios_2.php";
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 

             
  

//se verifica si se ingreso la hora, es un dato optativo
$z='';
$search  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$search .='&sensorn='.$_GET['sensorn'].'&idTelemetria='.$_GET['idTelemetria'].'&f_inicio='.$_GET['f_inicio'].'&f_termino='.$_GET['f_termino'];
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.="WHERE (TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
	$search.="&h_inicio=".$_GET['h_inicio']."&h_termino=".$_GET['h_termino'];
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.="WHERE (FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}
$search.="&idDetalle=".$_GET['idDetalle'];
//desde y hasta activo
if(isset($_GET['desde'])&&$_GET['desde']!=''&&isset($_GET['hasta'])&&$_GET['hasta']!=''){
	$subquery = "
	MIN(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedMin,
	MAX(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedMax,
	AVG(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedProm,
	STDDEV(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0),0)) AS MedDesStan,
	";
	$search.="&desde=".$_GET['desde'];
	$search.="&hasta=".$_GET['hasta'];
//solo desde	
}elseif(isset($_GET['desde'])&&$_GET['desde']!=''&&(!isset($_GET['hasta']) OR $_GET['hasta']=='')){
	$subquery = "
	MIN(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMin,
	MAX(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMax,
	AVG(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedProm,
	STDDEV(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].">=".$_GET['desde'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedDesStan,
	";
	$search.="&desde=".$_GET['desde'];
//solo hasta	
}elseif(isset($_GET['hasta'])&&$_GET['hasta']!=''&&(!isset($_GET['desde']) OR $_GET['desde']=='')){
	$subquery = "
	MIN(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMin,
	MAX(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedMax,
	AVG(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedProm,
	STDDEV(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."<=".$_GET['hasta'].",IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0),0)) AS MedDesStan,
	";
	$search.="&hasta=".$_GET['hasta'];
//ninguno
}else{
	$subquery = "
	MIN(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedMin,
	MAX(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedMax,
	AVG(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedProm,
	STDDEV(NULLIF(IF(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']."!=999,telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn'].",0),0)) AS MedDesStan,
	";
}	
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 

telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".$_GET['sensorn']." AS SensorNombre,

telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,

".$subquery."

telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".$_GET['sensorn']."

".$z."
GROUP BY telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema
ORDER BY telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC

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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrRutas,$row );
}

//cuento la cantidad de registros obtenidos
$cant = 0;
foreach ($arrRutas as $fac) {
	$cant++;
}
?>	

<div class="col-sm-12">
	<a target="new" href="<?php echo 'informe_telemetria_registro_promedios_2_to_excel.php'.$search ; ?>" class="btn btn-sm btn-metis-2 fright margin_width"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'informe_telemetria_registro_promedios_2_to_pdf.php'.$search ; ?>" class="btn btn-sm btn-metis-3 fright margin_width"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a>
</div>
 

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Informe Sensor N° <?php echo $_GET['sensorn'].' '.$arrRutas[0]['SensorNombre'].' de '.$arrRutas[0]['NombreEquipo']; ?></h5>
			
		</header>
		<div class="table-responsive"> 
			<?php if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>
	
				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

				<script>
					google.charts.load('current', {'packages':['corechart', 'corechart', 'table']});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Fecha'); 
						
						<?php $Colors  = "'#FFB347'"; ?>
						data.addColumn('number', 'Promedio Medicion');
						<?php //Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
							//Cuento si hay mediciones minimas y maximas
							$xv_MedMin = 0;
							$xv_MedMax = 0;
							foreach ($arrRutas as $fac) {
								if(isset($fac['MedMin'])&&$fac['MedMin']!=0&&$fac['MedMin']!=''){$xv_MedMin++;}
								if(isset($fac['MedMax'])&&$fac['MedMax']!=0&&$fac['MedMax']!=''){$xv_MedMax++;}
							}
							?>
							<?php if(isset($cant)&&$cant<30){?>
							data.addColumn({type: 'string', role: 'annotation'});
							<?php } ?>
							<?php if($xv_MedMin!=0&&$xv_MedMax!=0){
								$Colors .= ",'#779ECB'";
								$Colors .= ",'#C23B22'"; ?> 
								data.addColumn('number', 'Minimo Medicion'); 
								data.addColumn('number', 'Maximo Medicion');
							<?php } ?>
							<?php /*if(isset($arrRutas[0]['MedDesStan'])&&$arrRutas[0]['MedDesStan']!=0){
								$Colors .= ",'#008000'"; ?>
								data.addColumn('number', 'Desviacion Estandar');
							<?php }*/ ?>	
						<?php //Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){ ?>
							<?php if(isset($cant)&&$cant<30){?>
							data.addColumn({type: 'string', role: 'annotation'});
							<?php } ?>
						<?php } ?>
						  
						
						
						
						data.addRows([
						<?php foreach ($arrRutas as $fac) { 
							if(isset($fac['MedMin'])&&$fac['MedMin']!=0&&$fac['MedMin']!=''&&isset($fac['MedMax'])&&$fac['MedMax']!=0&&$fac['MedMax']!=''){
								$chain  = "'".Fecha_estandar($fac['FechaSistema'])."'";
								$chain .= ", ".$fac['MedProm'];
								//Que el valor medido sea distinto de 999
								if(isset($fac['MedProm'])&&$fac['MedProm']!=999){
									//Si se ven detalles
									if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
										if(isset($cant)&&$cant<30){   $chain .= ",'".Cantidades($fac['MedProm'], 2)."'";}
										if($xv_MedMin!=0){            $chain .= ", ".$fac['MedMin'];}
										if($xv_MedMax!=0){            $chain .= ", ".$fac['MedMax'];}
										//if(isset($fac['MedDesStan'])&&$fac['MedDesStan']!=0){  $chain .= ", ".$fac['MedDesStan'];}
									//Si no se ven detalles	
									}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
										if(isset($cant)&&$cant<30){   $chain .= ",'".Cantidades($fac['MedProm'], 2)."'";}		
									}
								}
								echo '['.$chain.'],';
							}
						} ?>	 
						]);

						var options = {
							title: 'Informe Sensor N° <?php echo $_GET['sensorn'].' '.$arrRutas[0]['SensorNombre']; ?> ',
							hAxis: {title: 'Fechas'<?php if(isset($cant)&&$cant>=30){?>,baselineColor: '#fff',gridlineColor: '#fff',textPosition: 'none'<?php } ?>},
							vAxis: { title: 'Medicion' },
							width: $(window).width()*0.75,
							height: 500,
							curveType: "function",
							series: {0: {pointsVisible: true},},
							annotations: {alwaysOutside: true,textStyle: {fontSize: 14,color: "#000",auraColor: "none"}},
							colors: [<?php echo $Colors; ?>]
							
						};

						var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

						chart.draw(data, options);
					}

				</script> 
				<div id="curve_chart1" style="height: 500px"></div>

			<?php } ?>
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Fecha</th>
						<?php
						//Si se ven detalles
						if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
							echo '<th>Promedio</th><th>Minimo</th><th>Maximo</th><th>Dev. Std.</th>';
						//Si no se ven detalles	
						}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
							echo '<th>Promedio</th>';
						}
						?>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrRutas as $rutas) { 
					//Verifico si existen datos
					if(isset($rutas['MedMin'])&&$rutas['MedMin']!=0&&$rutas['MedMin']!=''&&isset($rutas['MedMax'])&&$rutas['MedMax']!=0&&$rutas['MedMax']!=''){ ?>
						<tr class="odd">
							<td><?php echo $rutas['FechaSistema']; ?></td>
							<?php //Si se ven detalles
							if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){
								echo '<td>'.Cantidades($rutas['MedProm'], 2).' '.$rutas['Unimed'].'</td>';
								echo '<td>'.Cantidades($rutas['MedMin'], 2).' '.$rutas['Unimed'].'</td>';
								echo '<td>'.Cantidades($rutas['MedMax'], 2).' '.$rutas['Unimed'].'</td>';
								echo '<td>'.Cantidades($rutas['MedDesStan'], 2).' '.$rutas['Unimed'].'</td>';
							//Si no se ven detalles	
							}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
								echo '<td>'.Cantidades($rutas['MedProm'], 2).' '.$rutas['Unimed'].'</td>';
							} ?>
						</tr>
					<?php } ?> 
				<?php } ?>                     
				</tbody>
			</table>
		</div>
	</div>
</div>






<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "telemetria_listado.idSistema>=0 AND telemetria_listado.id_Geo=2 AND telemetria_listado.id_Sensores=1";
}else{
	$z = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.id_Geo=2 AND telemetria_listado.id_Sensores=1";		
} ?>			
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
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
				if(isset($desde)) {         $x9  = $desde;        }else{$x9  = '';}
				if(isset($hasta)) {         $x10 = $hasta;        }else{$x10 = '';}
				
				//Si es redireccionado desde otra pagina con datos precargados
				if(isset($_GET['view'])&&$_GET['view']!='') { $x5  = $_GET['view']; }
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Inicio','f_inicio', $x1, 2);
				$Form_Imputs->form_date('Fecha Termino','f_termino', $x2, 2);
				$Form_Imputs->form_time('Hora Inicio','h_inicio', $x3, 1, 1);
				$Form_Imputs->form_time('Hora Termino','h_termino', $x4, 1, 1);
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				
				// Se trae un listado de todos los registros
				$arrSelect = array();
				$query = "SELECT
				idTelemetria, cantSensores, 
				
				SensoresGrupo_1, SensoresGrupo_2, SensoresGrupo_3, SensoresGrupo_4, SensoresGrupo_5, 
				SensoresGrupo_6, SensoresGrupo_7, SensoresGrupo_8, SensoresGrupo_9, SensoresGrupo_10, 
				SensoresGrupo_11, SensoresGrupo_12, SensoresGrupo_13, SensoresGrupo_14, SensoresGrupo_15, 
				SensoresGrupo_16, SensoresGrupo_17, SensoresGrupo_18, SensoresGrupo_19, SensoresGrupo_20, 
				SensoresGrupo_21, SensoresGrupo_22, SensoresGrupo_23, SensoresGrupo_24, SensoresGrupo_25, 
				SensoresGrupo_26, SensoresGrupo_27, SensoresGrupo_28, SensoresGrupo_29, SensoresGrupo_30, 
				SensoresGrupo_31, SensoresGrupo_32, SensoresGrupo_33, SensoresGrupo_34, SensoresGrupo_35, 
				SensoresGrupo_36, SensoresGrupo_37, SensoresGrupo_38, SensoresGrupo_39, SensoresGrupo_40, 
				SensoresGrupo_41, SensoresGrupo_42, SensoresGrupo_43, SensoresGrupo_44, SensoresGrupo_45, 
				SensoresGrupo_46, SensoresGrupo_47, SensoresGrupo_48, SensoresGrupo_49, SensoresGrupo_50,

				SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
				SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
				SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
				SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
				SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
				SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
				SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
				SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
				SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
				SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50,
				
				SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
				SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
				SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
				SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
				SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
				SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
				SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
				SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
				SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
				SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50
				
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
								<label for="text2" class="control-label col-sm-4">Sensor</label>
								<div class="col-sm-8">
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
					$input .= 'var id_data_'.$select['idTelemetria'].'=new Array(""';
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
							
					$input .= 'var data_'.$select['idTelemetria'].'=new Array("Seleccione una Opcion"';
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							//se verifica grupo
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
					var Componente
					Componente = document.form1.idTelemetria[document.form1.idTelemetria.selectedIndex].value
					try {
					if (Componente != "") {
						id_data=eval("id_data_" + Componente)
						data=eval("data_" + Componente)
						num_int = id_data.length
						document.form1.sensorn.length = num_int
						for(i=0;i<num_int;i++){
						   document.form1.sensorn.options[i].value=id_data[i]
						   document.form1.sensorn.options[i].text=data[i]
						}
						document.getElementById("div_sensorn").style.display = "block";	
					}else{
						document.form1.sensorn.length = 1
						document.form1.sensorn.options[0].value = ""
						document.form1.sensorn.options[0].text = "Seleccione una Opcion"
						document.getElementById("div_sensorn").style.display = "none";
					}
					} catch (e) {
					document.form1.sensorn.length = 1
					document.form1.sensorn.options[0].value = ""
					document.form1.sensorn.options[0].text = "Seleccione una Opcion"
					document.getElementById("div_sensorn").style.display = "none";
					
				}
					document.form1.sensorn.options[0].selected = true
				}
				</script>';					
				
				
				echo $input;		
				
				
				$Form_Imputs->form_select('Ver Otros Datos','idDetalle', $x7, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);		
				$Form_Imputs->form_select('Mostrar Graficos','idGrafico', $x8, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);		
				$Form_Imputs->form_input_number('Valores Desde','desde', $x9, 1);
				$Form_Imputs->form_input_number('Valores Hasta','hasta', $x10, 1);
					
				?>        
	   
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter">	
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?>
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
