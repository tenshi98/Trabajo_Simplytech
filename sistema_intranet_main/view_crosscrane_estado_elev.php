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
$original = "view_crosscrane_estado_elev.php";
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
$Fecha_inicio  = restarDias(fecha_actual(),1);
$Fecha_fin     = fecha_actual();
$N_sobreUso    = 0;
$margenError   = 30;

//numero sensores equipo
$N_Maximo_Sensores = 50;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresMedMin_'.$i;
	$subquery .= ',SensoresMedMax_'.$i;
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresUniMed_'.$i;
	$subquery .= ',SensoresMedActual_'.$i;
	$subquery .= ',SensoresUso_'.$i;
	$subquery .= ',SensoresAccionC_'.$i;
	$subquery .= ',SensoresAccionT_'.$i;
	$subquery .= ',SensoresAccionMedC_'.$i;
	$subquery .= ',SensoresAccionMedT_'.$i;
	$subquery .= ',SensoresAccionAlerta_'.$i;

}
						
$SIS_query = '
Nombre, cantSensores, CrossCrane_tiempo_revision, CrossCrane_grupo_amperaje, 
CrossCrane_grupo_motor_subida,CrossCrane_grupo_motor_bajada, CrossCrane_grupo_voltaje,
(SELECT COUNT(idErrores) FROM `telemetria_listado_errores` WHERE idTelemetria='.$X_Puntero.' AND idLeido=0 AND Fecha BETWEEN "'.$Fecha_inicio.'" AND "'.$Fecha_fin.'" AND idTipo!=999 AND Valor<99900 AND idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].') AS Alertas
'.$subquery;
$SIS_join  = '';
$SIS_where = 'idTelemetria ='.$X_Puntero;
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');


/********************************************************************************************/
$F_inicio  = fecha_actual();
$F_inicio2 = restarDias(fecha_actual(),1);
$H_inicio  = restahoras($rowdata['CrossCrane_tiempo_revision'], hora_actual());
$H_inicio2 = restahoras('03:00:00', hora_actual());
$H_inicio3 = restahoras('00:10:00', hora_actual());
$F_termino = fecha_actual();
$H_termino = hora_actual();
		
//Variable de busqueda
if($H_inicio>$H_termino){
	$SIS_where = "telemetria_listado_tablarelacionada_".$X_Puntero.".TimeStamp BETWEEN '".$F_inicio2." ".$H_inicio."' AND '".$F_termino." ".$H_termino."'";
}else{
	$SIS_where = "telemetria_listado_tablarelacionada_".$X_Puntero.".TimeStamp BETWEEN '".$F_inicio." ".$H_inicio."' AND '".$F_termino." ".$H_termino."'";
}

//numero sensores equipo
$N_Maximo_Sensores = $rowdata['cantSensores'];
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_amperaje']){
		$subquery .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_amperaje_'.$i.'_Prom';
	}
	if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_motor_subida']){
		$subquery .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_motor_subida_'.$i.'_Prom';
	}
	if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_motor_bajada']){
		$subquery .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_motor_bajada_'.$i.'_Prom';
	}
	if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_voltaje']){
		$subquery .= ',AVG(NULLIF(IF(Sensor_'.$i.'!=0,Sensor_'.$i.',0),0)) AS Sensor_voltaje_'.$i.'_Prom';
	}
}

/**********************************************************/
//se consulta
$SIS_query = 'Fecha, Hora'.$subquery;
$SIS_join  = '';
$rowResult = db_select_data (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.$X_Puntero, $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowResult');

/**********************************************************/
//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnimed');

$arrUnimedX = array();
foreach ($arrUnimed as $sen) {
	$arrUnimedX[$sen['idUniMed']]= ' '.$sen['Nombre'];	;
}

//consultas anidadas, se utiliza las variables anteriores para consultar cada permiso
$SIS_query = 'idOpcionesGen_6';
$SIS_join  = '';
$SIS_where = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$n_permisos = db_select_data (false, $SIS_query, 'core_sistemas', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'n_permisos');


/********************************************************************************************/			
if(isset($rowdata['CrossCrane_tiempo_revision'])&&$rowdata['CrossCrane_tiempo_revision']=='00:00:00'){
	echo '<div class="col-xs-12" style="margin-top:15px;">';
		$Alert_Text  = 'No se ha configurado el tiempo de revision';
		alert_post_data(4,2,2, $Alert_Text);
	echo '</div>';
}
if(isset($rowdata['CrossCrane_grupo_amperaje'])&&$rowdata['CrossCrane_grupo_amperaje']==0){
	echo '<div class="col-xs-12" >';
		$Alert_Text  = 'No se ha configurado el grupo de alimentacion';
		alert_post_data(4,2,2, $Alert_Text);
	echo '</div>';
}
if(isset($rowdata['CrossCrane_grupo_motor_subida'])&&$rowdata['CrossCrane_grupo_motor_subida']==0){
	echo '<div class="col-xs-12" >';
		$Alert_Text  = 'No se ha configurado el grupo de motor de subida';
		alert_post_data(4,2,2, $Alert_Text);
	echo '</div>';
}
if(isset($rowdata['CrossCrane_grupo_motor_bajada'])&&$rowdata['CrossCrane_grupo_motor_bajada']==0){
	echo '<div class="col-xs-12" >';
		$Alert_Text  = 'No se ha configurado el grupo de motor de bajada';
		alert_post_data(4,2,2, $Alert_Text);
	echo '</div>';
}
if(isset($rowdata['CrossCrane_grupo_voltaje'])&&$rowdata['CrossCrane_grupo_voltaje']==0){
	echo '<div class="col-xs-12" >';
		$Alert_Text  = 'No se ha configurado el grupo de voltaje';
		alert_post_data(4,2,2, $Alert_Text);
	echo '</div>';
}
if(isset($n_permisos['idOpcionesGen_6'])&&$n_permisos['idOpcionesGen_6']!=0){
	$x_seg = $n_permisos['idOpcionesGen_6'] * 1000;
}else{
	$x_seg = 300000;//5 minutos
}?>
<script>
	window.setTimeout(function () {
	  window.location.reload();
	}, <?php echo $x_seg; ?>);
</script>
<style>
.float_table table {margin-right: auto !important;margin-left: auto !important;float: none !important;}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">google.charts.load('current', {'packages':['bar', 'corechart', 'table', 'gauge']});</script>	

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Estado del Equipo <?php echo $rowdata['Nombre'].' (Hora Refresco: '.hora_actual().')'; ?></h5>
		</header>
        <div id="div-3" class="tab-content">
			<div class="col-sm-12">
				<?php
				//numero sensores equipo
				$N_Maximo_Sensores = $rowdata['cantSensores'];
				//variables
				$alimentacion_total            = 0;
				$alimentacion_min              = 9999;
				$alimentacion_max              = -9999;
				$alimentacion_min_total        = 0;
				$alimentacion_max_total        = 0;
				$alimentacion_cuenta           = 0;
				$alimentacion_promedio         = 0;
				$alimentacion_min_promedio     = 0;
				$alimentacion_max_promedio     = 0;
				
				$motor_subida_total            = 0;
				$motor_subida_min              = 9999;
				$motor_subida_max              = -9999;
				$motor_subida_min_total        = 0;
				$motor_subida_max_total        = 0;
				$motor_subida_cuenta           = 0;
				$motor_subida_promedio         = 0;
				$motor_subida_min_promedio     = 0;
				$motor_subida_max_promedio     = 0;
				
				$motor_bajada_total            = 0;
				$motor_bajada_min              = 9999;
				$motor_bajada_max              = -9999;
				$motor_bajada_min_total        = 0;
				$motor_bajada_max_total        = 0;
				$motor_bajada_cuenta           = 0;
				$motor_bajada_promedio         = 0;
				$motor_bajada_min_promedio     = 0;
				$motor_bajada_max_promedio     = 0;
				
				$voltaje_prom_total             = 0;
				$voltaje_prom_cuenta            = 0;
				$voltaje_actual_total           = 0;
				$voltaje_actual_cuenta          = 0;
				$voltaje_promedio_min           = 0;
				$voltaje_promedio_max           = 0;
				$voltaje_prom_promedio          = 0;
				$voltaje_actual_promedio        = 0;
				$voltaje_promedio_min_fin       = 0;
				$voltaje_promedio_max_fin       = 0;
				/*****************************************/
				//recorro
				for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
					
					if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_amperaje']){
						//suma totales
						$alimentacion_total     = $alimentacion_total + $rowResult['Sensor_amperaje_'.$i.'_Prom'];
						$alimentacion_min_total = $alimentacion_min_total + $rowdata['SensoresMedMin_'.$i];
						$alimentacion_max_total = $alimentacion_max_total + $rowdata['SensoresMedMax_'.$i];
						$alimentacion_cuenta++;
						//busco el valor minimo
						if($rowResult['Sensor_amperaje_'.$i.'_Prom']<$alimentacion_min){$alimentacion_min = $rowResult['Sensor_amperaje_'.$i.'_Prom'];}
						//busco el valor maximo
						if($rowResult['Sensor_amperaje_'.$i.'_Prom']>$alimentacion_max){$alimentacion_max = $rowResult['Sensor_amperaje_'.$i.'_Prom'];}
					}
					
					if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_motor_subida']){
						//suma totales
						$motor_subida_total     = $motor_subida_total + $rowResult['Sensor_motor_subida_'.$i.'_Prom'];
						$motor_subida_min_total = $motor_subida_min_total + $rowdata['SensoresMedMin_'.$i];
						$motor_subida_max_total = $motor_subida_max_total + $rowdata['SensoresMedMax_'.$i];
						$motor_subida_cuenta++;
						//busco el valor minimo
						if($rowResult['Sensor_motor_subida_'.$i.'_Prom']<$motor_subida_min){$motor_subida_min = $rowResult['Sensor_motor_subida_'.$i.'_Prom'];}
						//busco el valor maximo
						if($rowResult['Sensor_motor_subida_'.$i.'_Prom']>$motor_subida_max){$motor_subida_max = $rowResult['Sensor_motor_subida_'.$i.'_Prom'];}
					}
					
					if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_motor_bajada']){
						//suma totales
						$motor_bajada_total     = $motor_bajada_total + $rowResult['Sensor_motor_bajada_'.$i.'_Prom'];
						$motor_bajada_min_total = $motor_bajada_min_total + $rowdata['SensoresMedMin_'.$i];
						$motor_bajada_max_total = $motor_bajada_max_total + $rowdata['SensoresMedMax_'.$i];
						$motor_bajada_cuenta++;
						//busco el valor minimo
						if($rowResult['Sensor_motor_bajada_'.$i.'_Prom']<$motor_bajada_min){$motor_bajada_min = $rowResult['Sensor_motor_bajada_'.$i.'_Prom'];}
						//busco el valor maximo
						if($rowResult['Sensor_motor_bajada_'.$i.'_Prom']>$motor_bajada_max){$motor_bajada_max = $rowResult['Sensor_motor_bajada_'.$i.'_Prom'];}
					}
					
					if($rowdata['SensoresGrupo_'.$i]==$rowdata['CrossCrane_grupo_voltaje']){
						//promedio
						$voltaje_prom_total = $voltaje_prom_total + $rowResult['Sensor_voltaje_'.$i.'_Prom'];
						$voltaje_prom_cuenta++;
						//actual
						$voltaje_actual_total = $voltaje_actual_total + $rowdata['SensoresMedActual_'.$i];
						$voltaje_actual_cuenta++;
						//promedios minimos y maximos
						$voltaje_promedio_min = $voltaje_promedio_min + $rowdata['SensoresMedMin_'.$i];
						$voltaje_promedio_max = $voltaje_promedio_max + $rowdata['SensoresMedMax_'.$i];
					}
					
					//Se verifica si el sensor esta habilitado para la supervision
					if(isset($rowMed['SensoresUso_'.$i])&&$rowMed['SensoresUso_'.$i]==1){ 
						//si esta configurado el porcentaje de alerta
						if(isset($rowMed['SensoresAccionAlerta_'.$i])&&$rowMed['SensoresAccionAlerta_'.$i]!=0){
							/*****************************************/
							//Ciclos
							//si esta configurado
							if(isset($rowMed['SensoresAccionC_'.$i])&&$rowMed['SensoresAccionC_'.$i]!=0){
								$ciclo = $rowMed['SensoresAccionMedC_'.$i]/$rowMed['SensoresAccionC_'.$i];
								//si ya cumplio ciclos
								if($ciclo>$rowMed['SensoresAccionAlerta_'.$i]){
									$N_sobreUso++;
								}
							}
								
							/*****************************************/
							//Horas
							//si esta configurado
							if(isset($rowMed['SensoresAccionT_'.$i])&&$rowMed['SensoresAccionT_'.$i]!=0){
								$ciclo = $rowMed['SensoresAccionMedT_'.$i]/$rowMed['SensoresAccionT_'.$i];
								//si ya cumplio ciclos
								if($ciclo>$rowMed['SensoresAccionAlerta_'.$i]){
									$N_sobreUso++;
								}
							}
						}
					}
				}
				/*****************************************/
				//obtengo promedios
				//alimentacion
				if($alimentacion_cuenta!=0){
					$alimentacion_promedio     = cantidades($alimentacion_total/$alimentacion_cuenta, 0);
					$alimentacion_min_promedio = cantidades($alimentacion_min_total/$alimentacion_cuenta, 0);
					$alimentacion_max_promedio = cantidades($alimentacion_max_total/$alimentacion_cuenta, 0);
				}else{
					$alimentacion_promedio      = 0;
					$alimentacion_min_promedio  = 0;
					$alimentacion_max_promedio  = 0;
				}
				//motor subida
				if($motor_subida_cuenta!=0){
					$motor_subida_promedio     = cantidades($motor_subida_total/$motor_subida_cuenta, 0);
					$motor_subida_min_promedio = cantidades($motor_subida_min_total/$motor_subida_cuenta, 0);
					$motor_subida_max_promedio = cantidades($motor_subida_max_total/$motor_subida_cuenta, 0);
				}else{
					$motor_subida_promedio      = 0;
					$motor_subida_min_promedio  = 0;
					$motor_subida_max_promedio  = 0;
				}
				//motor bajada
				if($motor_bajada_cuenta!=0){
					$motor_bajada_promedio     = cantidades($motor_bajada_total/$motor_bajada_cuenta, 0);
					$motor_bajada_min_promedio = cantidades($motor_bajada_min_total/$motor_bajada_cuenta, 0);
					$motor_bajada_max_promedio = cantidades($motor_bajada_max_total/$motor_bajada_cuenta, 0);
				}else{
					$motor_bajada_promedio      = 0;
					$motor_bajada_min_promedio  = 0;
					$motor_bajada_max_promedio  = 0;
				}
				//voltaje
				if($voltaje_prom_cuenta!=0){
					$voltaje_prom_promedio = $voltaje_prom_total/$voltaje_prom_cuenta;
				}else{
					$voltaje_prom_promedio = 0;
				}
						
				if($voltaje_actual_cuenta!=0){
					$voltaje_actual_promedio  = $voltaje_actual_total/$voltaje_actual_cuenta;
					$voltaje_promedio_min_fin = $voltaje_promedio_min/$voltaje_actual_cuenta;
					$voltaje_promedio_max_fin = $voltaje_promedio_max/$voltaje_actual_cuenta;
				}else{
					$voltaje_actual_promedio  = 0;
					$voltaje_promedio_min_fin = 0;
					$voltaje_promedio_max_fin = 0;
				}
				/*****************************************/
				//obtengo margenes
				$margen_alimentacion  = 0;
				$margen_motor_subida  = 0;
				$margen_motor_bajada  = 0;
				
				if($alimentacion_min > 1&&$alimentacion_max > 1){  $margen_alimentacion  = cantidades(100-(($alimentacion_min*100)/$alimentacion_max), 0);}
				if($motor_subida_min > 1&&$motor_subida_max > 1){  $margen_motor_subida  = cantidades(100-(($motor_subida_min*100)/$motor_subida_max), 0);}
				if($motor_bajada_min > 1&&$motor_bajada_max > 1){  $margen_motor_bajada  = cantidades(100-(($motor_bajada_min*100)/$motor_bajada_max), 0);}
				
				/*****************************************/
				//genero los iconos de alertas
				//alimentacion
				if($margen_alimentacion>$margenError){
					$icon_alimentacion = '<span style="color:#da4932"><i class="fa fa-exclamation-triangle faa-bounce animated" aria-hidden="true"></i></span>';
				}else{
					$icon_alimentacion = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
				}
				//motor_subida
				if($margen_motor_subida>$margenError){
					$icon_motor_subida = '<span style="color:#da4932"><i class="fa fa-exclamation-triangle faa-bounce animated" aria-hidden="true"></i></span>';
				}else{
					$icon_motor_subida = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
				}
				//motor_bajada
				if($margen_motor_bajada>$margenError){
					$icon_motor_bajada = '<span style="color:#da4932"><i class="fa fa-exclamation-triangle faa-bounce animated" aria-hidden="true"></i></span>';
				}else{
					$icon_motor_bajada = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
				}
				//voltaje
				//si no estan configurados
				if($voltaje_promedio_min_fin==0&&$voltaje_promedio_max_fin==0){
					$icon_voltaje = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
				}else{
					//si es inferior a 1000
					if($voltaje_prom_promedio<1000){
						if(($voltaje_prom_promedio<$voltaje_promedio_min_fin) OR ($voltaje_prom_promedio>$voltaje_promedio_max_fin)){
							$icon_voltaje = '<span style="color:#da4932"><i class="fa fa-exclamation-triangle faa-bounce animated" aria-hidden="true"></i></span>';
						}else{
							$icon_voltaje = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
						}
					}else{
						$icon_voltaje = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
					}
				}
				
				//Alertas
				if(isset($rowdata['Alertas'])&&$rowdata['Alertas']!=0){
					$icon_Alertas = '<span style="color:#da4932"><i class="fa fa-exclamation-triangle faa-bounce animated" aria-hidden="true"></i></span>';
				}else{
					$icon_Alertas = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
				}
				//sobreuso
				if(isset($N_sobreUso)&&$N_sobreUso!=0){
					$icon_sobreuso = '<span style="color:#da4932"><i class="fa fa-exclamation-triangle faa-bounce animated" aria-hidden="true"></i></span>';
				}else{
					$icon_sobreuso = '<span style="color:#60c060"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
				}
				/*****************************************/
				//genero los enlaces
				//main
				$link  = 'informe_telemetria_registro_sensores_17.php';
				if($H_inicio3>$H_termino){
					$link .= '?f_inicio='.$F_inicio2;
					$link .= '&f_termino='.$F_termino;
					$link .= '&h_inicio='.$H_inicio3;
					$link .= '&h_termino='.$H_termino;
				}else{
					$link .= '?f_inicio='.$F_inicio;
					$link .= '&f_termino='.$F_termino;
					$link .= '&h_inicio='.$H_inicio3;
					$link .= '&h_termino='.$H_termino;
				}
				$link .= '&idTelemetria='.$X_Puntero;
				$link .= '&idGrafico=1&submit_filter=+Filtrar';
				//alimentacion
				$link_alimentacion  = $link;
				$link_alimentacion .= '&idGrupo='.$rowdata['CrossCrane_grupo_amperaje'];
				//elevacion
				$link_motor_subida  = $link;
				$link_motor_subida .= '&idGrupo='.$rowdata['CrossCrane_grupo_motor_subida'];
				//giro
				$link_motor_bajada  = $link;
				$link_motor_bajada .= '&idGrupo='.$rowdata['CrossCrane_grupo_motor_bajada'];
				//voltaje
				$link_voltaje  = 'informe_telemetria_registro_sensores_17.php';
				if($H_inicio2>$H_termino){
					$link_voltaje .= '?f_inicio='.$F_inicio2;
					$link_voltaje .= '&f_termino='.$F_termino;
					$link_voltaje .= '&h_inicio='.$H_inicio2;
					$link_voltaje .= '&h_termino='.$H_termino;
				}else{
					$link_voltaje .= '?f_inicio='.$F_inicio;
					$link_voltaje .= '&f_termino='.$F_termino;
					$link_voltaje .= '&h_inicio='.$H_inicio2;
					$link_voltaje .= '&h_termino='.$H_termino;
				}
				$link_voltaje .= '&idTelemetria='.$X_Puntero;
				$link_voltaje .= '&idGrafico=1&submit_filter=+Filtrar';
				$link_voltaje .= '&idGrupo='.$rowdata['CrossCrane_grupo_voltaje'];
				//Alertas
				$link_Alertas  = 'informe_telemetria_errores_6.php';
				$link_Alertas .= '?f_inicio='.$Fecha_inicio;
				$link_Alertas .= '&f_termino='.$Fecha_fin;
				$link_Alertas .= '&idTelemetria='.$X_Puntero;
				$link_Alertas .= '&idLeido=0';		
				$link_Alertas .= '&submit_filter=+Filtrar';		
				//Sobre uso
				$link_sobreuso  = 'informe_telemetria_uso_03.php';
				$link_sobreuso .= '?idTelemetria='.$X_Puntero;
				$link_sobreuso .= '&submit_filter=+Filtrar';
				?>

				<div class="row">
					
					<div class="col-sm-6">
						<h3 style="text-align: center;"><?php echo $icon_motor_subida.' M. Subida';?></h3>
						<div class="float_table" id="chart_gauge_m_subida" ></div> 
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo $link_motor_subida; ?>" class="btn btn-default width100" style="margin-bottom:10px;" ><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-6">
						<h3 style="text-align: center;"><?php echo $icon_motor_bajada.' M. Bajada';?></h3>
						<div class="float_table" id="chart_gauge_m_bajada" ></div> 
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo $link_motor_bajada; ?>" class="btn btn-default width100" style="margin-bottom:10px;" ><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<script>
						/* ************************************************************************** */
						//Variables globales
						var chart_gauge_1    = "";
						var chart_gauge_2    = "";
						
						var data_gauge_1     = "";
						var data_gauge_2     = "";
						
						var options_gauge_1  = "";
						var options_gauge_2  = "";
								
						//carga de los graficos
						google.charts.setOnLoadCallback(Chart_correccion_1);
						google.charts.setOnLoadCallback(Chart_correccion_2);
								
						/* ************************************************************************** */
						function Chart_correccion_1() {
							var data_correccion_rows_1 = <?php echo $margen_motor_subida; ?>;
							//se llama funcion de dibujo
							draw_correccion_1(data_correccion_rows_1);
						}
						function Chart_correccion_2() {
							var data_correccion_rows_2 = <?php echo $margen_motor_bajada; ?>;
							//se llama funcion de dibujo
							draw_correccion_2(data_correccion_rows_2);
						}
						/********************************************************************/
						function draw_correccion_1(data) {
							//datos
							chart_gauge_1 = new google.visualization.Gauge(document.getElementById("chart_gauge_m_subida"));
							data_gauge_1 = google.visualization.arrayToDataTable([
								["Label", "Valor"],
								["<?php echo $motor_subida_promedio; ?> A", data]
							]);
							//opciones
							options_gauge_1 = {
								min:0,
								max:100,
								width: 350, 
								height: 200,
								redFrom: <?php echo $margenError; ?>, redTo: 100,redColor:'#DC3912',
								majorTicks: ["0","10","20","30","40", "50", "60", "70", "80", "90", "100"],
								minorTicks: 5
							};
							//Formateo
							var format1 = new google.visualization.NumberFormat({
								suffix: '%',
								fractionDigits: 0
							});
							format1.format(data_gauge_1, 1);
							//dibujo
							chart_gauge_1.draw(data_gauge_1, options_gauge_1);
						}
						function draw_correccion_2(data) {
							//datos
							chart_gauge_2 = new google.visualization.Gauge(document.getElementById("chart_gauge_m_bajada"));
							data_gauge_2 = google.visualization.arrayToDataTable([
								["Label", "Valor"],
								["<?php echo $motor_bajada_promedio; ?> A", data]
							]);
							//opciones
							options_gauge_2 = {
								min:0,
								max:100,
								width: 350, 
								height: 200,
								redFrom: <?php echo $margenError; ?>, redTo: 100,redColor:'#DC3912',
								majorTicks: ["0","10","20","30","40", "50", "60", "70", "80", "90", "100"],
								minorTicks: 5
							};
							//Formateo
							var format2 = new google.visualization.NumberFormat({
								suffix: '%',
								fractionDigits: 0
							});
							format2.format(data_gauge_2, 1);
							//dibujo
							chart_gauge_2.draw(data_gauge_2, options_gauge_2);
						}
						
						/********************************************************************/
						function update_correccion_1(data) {
							//Formateo
							var format1 = new google.visualization.NumberFormat({
								suffix: '%',
								fractionDigits: 0
							});
							data_gauge_1.setValue(0, 1, data);
							format1.format(data_gauge_1, 1);
							chart_gauge_1.draw(data_gauge_1, options_gauge_1);
						}
						function update_correccion_2(data) {
							//Formateo
							var format2 = new google.visualization.NumberFormat({
								suffix: '%',
								fractionDigits: 0
							});
							data_gauge_2.setValue(0, 1, data);
							format2.format(data_gauge_2, 1);
							chart_gauge_2.draw(data_gauge_2, options_gauge_2);
						}
						
								
								
					</script>
				</div>
			
				<div class="row">
					
					<div class="col-sm-4">
						<h3 style="text-align: center;"><?php echo $icon_voltaje.' Voltaje';?></h3>
						
						<div  class="box box-blue box-solid tooltip">
							<div class="box-header with-border">
								<div class="col-sm-6 text-center">
									<h3 class="box-title">Actual</h3>
								</div>
								<div class="col-sm-6 text-center">
									<h3 class="box-title">Promedio</h3>
								</div>
								<div class="clearfix"></div>
							</div>
							<?php
							if($voltaje_actual_promedio<1000){
								$ndata_x1 = $voltaje_actual_promedio;
							}else{
								$ndata_x1 = 0;
							}
							if($voltaje_prom_promedio<1000){
								$ndata_x2 = $voltaje_prom_promedio;
							}else{
								$ndata_x2 = 0;
							}
							
							?>
							<div class="box-body">
								<div class="col-sm-6 value tipnoabs">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo cantidades($ndata_x1, 0);?></span>
								</div>
								<div class="col-sm-6 value tipnoabs">
									<span><i class="fa fa-bolt" aria-hidden="true"></i></span>
									<span><?php echo cantidades($ndata_x2, 0);?></span>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo $link_voltaje; ?>" class="btn btn-default width100" style="margin-bottom:10px;" ><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-4">
						<h3 style="text-align: center;"><?php echo $icon_Alertas.' Operacion';?></h3>
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Alertas (Ultimas 24 Horas)</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
									<span><?php echo $rowdata['Alertas']; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo $link_Alertas; ?>" class="btn btn-default width100" style="margin-bottom:10px;" ><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
					</div>
					
					<div class="col-sm-4">
						<h3 style="text-align: center;"><?php echo $icon_sobreuso.' Mantencion';?></h3>
						<div class="box box-blue box-solid">
							<div class="box-header with-border text-center">
								<h3 class="box-title">Mantención Requerida</h3>
							</div>
							<div class="box-body">
								<div class="value">
									<span><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
									<span><?php echo $N_sobreUso; ?></span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<a target="_blank" rel="noopener noreferrer" href="<?php echo $link_sobreuso; ?>" class="btn btn-default width100" style="margin-bottom:10px;" ><i class="fa fa-plus" aria-hidden="true"></i> Ver Mas</a>
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
