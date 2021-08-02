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
$Curso_FechaInicio    = ano_actual().'-'.mes_actual.'-01';
$Curso_HoraInicio     = hora_actual();
$Curso_FechaTermino   = fecha_actual();
$Curso_HoraTermino    = hora_actual();

//numero sensores equipo
$N_Maximo_Sensores = 50;
$subquery_1 = 'Nombre, cantSensores';
$subquery_2 = '';
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

//Grupo Sensores
$idGrupoVoltaje         = 1;
$idGrupoPotencia        = 1;
$idGrupoConsumoMesHabil = 1;
$idGrupoConsumoMesCurso = 1;

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
		switch ($rowdata['SensoresGrupo_'.$i]) {
			case $idGrupoVoltaje:
				$TempValue_1 = $TempValue_1 + $rowdata['SensoresMedActual_'.$i];
				$TempCount_1++;
				break;
			case $idGrupoPotencia:
				$TempValue_2 = $TempValue_2 + $rowdata['SensoresMedActual_'.$i];
				$TempCount_2++;
				break;
			case $idGrupoConsumoMesHabil:
				$TempValue_3 = $TempValue_3 + $rowConsumoMesHabil['Med_'.$i];
				$TempCount_3++;
				break;
			case $idGrupoConsumoMesCurso:
				$TempValue_4 = $TempValue_4 + $rowConsumoMesCurso['Med_'.$i];
				$TempCount_4++;
				break;
		}
	}
}
//Saco promedios
if($TempCount_1!=0){$Voltaje         = $TempValue_1/$TempCount_1;}else{$Voltaje         = 0;}
if($TempCount_2!=0){$Potencia        = $TempValue_2/$TempCount_2;}else{$Potencia        = 0;}
if($TempCount_3!=0){$ConsumoMesHabil = $TempValue_3/$TempCount_3;}else{$ConsumoMesHabil = 0;}
if($TempCount_4!=0){$ConsumoMesCurso = $TempValue_4/$TempCount_4;}else{$ConsumoMesCurso = 0;}


					
if(isset($n_permisos['idOpcionesGen_6'])&&$n_permisos['idOpcionesGen_6']!=0){
	$x_seg = $n_permisos['idOpcionesGen_6'] * 1000;
}else{
	$x_seg = 300000;//5 minutos
}
?>
<script>
	window.setTimeout(function () {
	  window.location.reload();
	}, <?php echo $x_seg; ?>);
</script>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Estado del Equipo <?php echo $rowdata['Nombre'].' (Hora Refresco: '.hora_actual().')'; ?></h5>
		</header>
        <div id="div-3" class="tab-content">
			<div class="col-sm-12">
				<div class="row">
					
					<div class="col-sm-3">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Voltaje</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($Voltaje, 2).' V'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_errores_6.php" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-3">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Potencia</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($Potencia, 2).' KW'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_errores_6.php" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-3">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Consumo Mes Habil</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($ConsumoMesHabil, 2).' KW/H'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_errores_6.php" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-3">
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Consumo Mes Actual</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo Cantidades($ConsumoMesCurso, 2).' KW/H'; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_errores_6.php" class="btn btn-default width100" style="margin-bottom:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
				</div>
			</div>	
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
