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
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
//Cargamos la ubicacion 
$original = "view_crossenergy_estado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?view='.$X_Puntero;
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

/**************************************************************/
//variables
//Para el mes Habil
$Habil_FechaInicio    = restarDias(fecha_actual(),30);
$Habil_HoraInicio     = hora_actual();
$Habil_FechaTermino   = fecha_actual();
$Habil_HoraTermino    = hora_actual();

//Para el mes en curso
$Curso_FechaInicio    = ano_actual().'-'.mes_actual().'-01';
$Curso_HoraInicio     = hora_actual();
$Curso_FechaTermino   = fecha_actual();
$Curso_HoraTermino    = hora_actual();

//Para el grafico trifasico
$Grafico_FechaInicio    = fecha_actual();
$Grafico_HoraInicio     = restahoras('01:00:00', hora_actual());
$Grafico_FechaTermino   = fecha_actual();
$Grafico_HoraTermino    = hora_actual();

//Para redirigir a los informes
$Informes_FechaInicio    = fecha_actual();
$Informes_HoraInicio     = restahoras('03:00:00', hora_actual());
$Informes_FechaTermino   = fecha_actual();
$Informes_HoraTermino    = hora_actual();


//numero sensores equipo
$N_Maximo_Sensores = 50;
$subquery_1 = 'Nombre, cantSensores';
$subquery_2 = 'idTabla';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery_1 .= ',SensoresGrupo_'.$i;
	$subquery_1 .= ',SensoresMedActual_'.$i;
	$subquery_1 .= ',SensoresActivo_'.$i;
	$subquery_2 .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Med_'.$i;
}

//Obtengo los datos
$rowdata            = db_select_data (false, $subquery_1, 'telemetria_listado', '', 'idTelemetria ='.$X_Puntero, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');
$rowConsumoMesHabil = db_select_data (false, $subquery_2, 'telemetria_listado_crossenergy_dia', '', 'idTelemetria='.$X_Puntero.' AND (TimeStamp BETWEEN "'.$Habil_FechaInicio.' '.$Habil_HoraInicio .'" AND "'.$Habil_FechaTermino.' '.$Habil_HoraTermino.'")', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');
$rowConsumoMesCurso = db_select_data (false, $subquery_2, 'telemetria_listado_crossenergy_dia', '', 'idTelemetria='.$X_Puntero.' AND (TimeStamp BETWEEN "'.$Curso_FechaInicio.' '.$Curso_HoraInicio .'" AND "'.$Curso_FechaTermino.' '.$Curso_HoraTermino.'")', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');
$n_permisos         = db_select_data (false, 'idOpcionesGen_6', 'core_sistemas', '', 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'n_permisos');
$arrGraficos = array();
$arrGraficos = db_select_array (false, 'HoraSistema, Sensor_1, Sensor_2, Sensor_3', 'telemetria_listado_tablarelacionada_'.$X_Puntero, '', '(TimeStamp BETWEEN "'.$Grafico_FechaInicio.' '.$Grafico_HoraInicio .'" AND "'.$Grafico_FechaTermino.' '.$Grafico_HoraTermino.'")', 'HoraSistema ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGraficos');

//Grupo Sensores
$idGrupoVoltajeTrifasico = 87;
$idGrupoPotencia         = 99;
$idGrupoConsumoMesHabil  = 99;
$idGrupoConsumoMesCurso  = 99;

//Temporales
$TempValue_1 = 0;
$TempValue_2 = 0;
$TempValue_3 = 0;
$TempValue_4 = 0;
$TempCount_1 = 0;
$TempCount_2 = 0;
$TempCount_3 = 0;
$TempCount_4 = 0;

//recorro los sensores
for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
	//Si el sensor esta activo
	if(isset($rowdata['SensoresActivo_'.$i])&&$rowdata['SensoresActivo_'.$i]==1){
		//Si pertenece al grupo
		if($rowdata['SensoresGrupo_'.$i]==$idGrupoVoltajeTrifasico){
			$TempValue_1 = $TempValue_1 + $rowdata['SensoresMedActual_'.$i];
			$TempCount_1++;
		}
		if($rowdata['SensoresGrupo_'.$i]==$idGrupoPotencia){
			$TempValue_2 = $TempValue_2 + $rowdata['SensoresMedActual_'.$i];
			$TempCount_2++;
		}
		if($rowdata['SensoresGrupo_'.$i]==$idGrupoConsumoMesHabil){
			$TempValue_3 = $TempValue_3 + $rowConsumoMesHabil['Med_'.$i];
			$TempCount_3++;
		}
		if($rowdata['SensoresGrupo_'.$i]==$idGrupoConsumoMesCurso){
			$TempValue_4 = $TempValue_4 + $rowConsumoMesCurso['Med_'.$i];
			$TempCount_4++;
		}
		
	}
}


//Saco promedios
//if($TempCount_1!=0){$Voltaje         = $TempValue_1/$TempCount_1;}else{$Voltaje         = 0;}
//if($TempCount_2!=0){$Potencia        = $TempValue_2/$TempCount_2;}else{$Potencia        = 0;}
if($TempCount_3!=0){$ConsumoMesHabil = $TempValue_3/$TempCount_3;}else{$ConsumoMesHabil = 0;}
if($TempCount_4!=0){$ConsumoMesCurso = $TempValue_4/$TempCount_4;}else{$ConsumoMesCurso = 0;}
$Vmonofasico       = $rowdata['SensoresMedActual_4'];
$VTrifasico        = $rowdata['SensoresMedActual_5'];
$Potencia          = $rowdata['SensoresMedActual_6'];
					
if(isset($n_permisos['idOpcionesGen_6'])&&$n_permisos['idOpcionesGen_6']!=0){
	$x_seg = $n_permisos['idOpcionesGen_6'] * 1000;
}else{
	$x_seg = 300000;//5 minutos
}
$x_seg = 300000;//5 minutos
?>
<script>
	window.setTimeout(function () {
	  window.location.reload();
	}, <?php echo $x_seg; ?>);
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>google.charts.load('current', {'packages':['line','corechart']});</script>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Estado del Equipo <?php echo $rowdata['Nombre'].' (Hora Refresco: '.hora_actual().')'; ?></h5>
		</header>
        <div id="div-3" class="tab-content">
			<div class="col-sm-12">
				
				<div class="row">
					<div class="col-sm-12">
						<script>
							google.charts.setOnLoadCallback(drawChart);

							function drawChart() {
								
								var chartDiv = document.getElementById('curve_chart');

								var data = new google.visualization.DataTable();
								data.addColumn('string', 'Hora'); 
								data.addColumn('number', "Fase 1");
								data.addColumn('number', "Fase 2");
								data.addColumn('number', "Fase 3");

								data.addRows([
									<?php 
										foreach ($arrGraficos as $data) {
											
											$chain  = "'".Hora_estandar($data['HoraSistema'])."'";
											$chain .= ", ".$data['Sensor_1'].", ".$data['Sensor_2'].", ".$data['Sensor_3'];
											//se imprime dato
											echo '['.$chain.'],'; 
										}  
									?>
								]);

								var materialOptions = {
									chart: {
										title: 'Comportamiento Lineas Trifasicas (Ultima Hora)'
									}
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
				
				<div class="row">
					
					<div class="col-sm-4">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Voltaje Monofasico</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($Vmonofasico, 2).' V'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_18.php?f_inicio='.$Informes_FechaInicio.'&f_termino='.$Informes_FechaTermino.'&h_inicio='.$Informes_HoraInicio.'&h_termino='.$Informes_HoraTermino.'&idTelemetria='.$X_Puntero.'&sensorn=4&idGrafico=1&submit_filter=Filtrar'; ?>" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-4">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Voltaje Trifasico</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($VTrifasico, 2).' V'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_19.php?f_inicio='.$Informes_FechaInicio.'&f_termino='.$Informes_FechaTermino.'&h_inicio='.$Informes_HoraInicio.'&h_termino='.$Informes_HoraTermino.'&idTelemetria='.$X_Puntero.'&idGrupo='.$idGrupoVoltajeTrifasico.'&idGrafico=1&submit_filter=Filtrar'; ?>" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-4">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Potencia</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($Potencia, 2).' kW'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_18.php?f_inicio='.$Informes_FechaInicio.'&f_termino='.$Informes_FechaTermino.'&h_inicio='.$Informes_HoraInicio.'&h_termino='.$Informes_HoraTermino.'&idTelemetria='.$X_Puntero.'&sensorn=6&idGrafico=1&submit_filter=Filtrar'; ?>" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
				
				</div>
				
				<div class="row">
						
					<div class="col-sm-6">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Consumo Mes Habil</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($ConsumoMesHabil, 2).' kW/h'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_crossenergy_01.php?f_inicio='.$Habil_FechaInicio.'&f_termino='.$Habil_FechaTermino.'&h_inicio='.$Habil_HoraInicio.'&h_termino='.$Habil_HoraTermino.'&idTelemetria='.$X_Puntero.'&idGrupo='.$idGrupoConsumoMesHabil.'&idGrafico=1&submit_filter=Filtrar'; ?>" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-6">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Consumo Mes Actual</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($ConsumoMesCurso, 2).' kW/h'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_crossenergy_01.php?f_inicio='.$Curso_FechaInicio.'&f_termino='.$Curso_FechaTermino.'&h_inicio='.$Curso_HoraInicio.'&h_termino='.$Curso_HoraTermino.'&idTelemetria='.$X_Puntero.'&idGrupo='.$idGrupoConsumoMesCurso.'&idGrafico=1&submit_filter=Filtrar'; ?>" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
				</div>
			
				
			</div>	
			<div class="clearfix"></div>	
		</div>	
	</div>
</div>


<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
