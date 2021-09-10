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
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                      Consulta                                                                  */
/**********************************************************************************************************************************/
//Obtengo datos configuracion

if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$idTelemetria  = $_GET['idTelemetria'];	
	$_SESSION['usuario']['widget_CrossC']['idTelemetria']  = $_GET['idTelemetria'];	
}else{
	$idTelemetria  = $_SESSION['usuario']['widget_CrossC']['idTelemetria'];	
}
if(isset($_GET['cantSensores'])&&$_GET['cantSensores']!=''){
	$cantSensores  = $_GET['cantSensores'];	
	$_SESSION['usuario']['widget_CrossC']['cantSensores']  = $_GET['cantSensores'];	
}else{
	$cantSensores  = $_SESSION['usuario']['widget_CrossC']['cantSensores'];
}
if(isset($_GET['idGrupoUso'])&&$_GET['idGrupoUso']!=''){
	$idGrupoUso  = $_GET['idGrupoUso'];	
}
if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){
	$idGrupo  = $_GET['idGrupo'];	
}
	
$timeBack      = $_SESSION['usuario']['widget_CrossC']['timeBack'];	
$seguimiento   = $_SESSION['usuario']['widget_CrossC']['seguimiento'];	
$idSistema     = $_SESSION['usuario']['widget_CrossC']['idSistema'];	
$idTipoUsuario = $_SESSION['usuario']['widget_CrossC']['idTipoUsuario'];	
$idUsuario     = $_SESSION['usuario']['widget_CrossC']['idUsuario'];	

//variables
$HoraInicio     = restahoras($timeBack,hora_actual());
$FechaInicio    = fecha_actual();
$HoraTermino    = hora_actual(); 
$FechaTermino   = fecha_actual();
if($HoraTermino<$timeBack){
	$FechaInicio = restarDias($FechaTermino,1);
}																
	
/*************************************************************/
//Se consulta
//numero sensores equipo
$N_Maximo_Sensores = $cantSensores;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$consql .= ',SensoresNombre_'.$i;
	$consql .= ',SensoresGrupo_'.$i;
	$consql .= ',SensoresRevisionGrupo_'.$i;
	$consql .= ',SensoresActivo_'.$i;
}
/*****************************/
$SIS_query = 'idTelemetria'.$consql;
$SIS_join  = '';
$SIS_where = 'idTelemetria='.$idTelemetria;
$rowEquipo = db_select_data (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $dbConn, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEquipo');
	
/*************************************************************/
//Se consulta
//numero sensores equipo
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$consql .= ',Sensor_'.$i.' AS SensorValue_'.$i;
}
/*****************************/
$SIS_query = 'FechaSistema,HoraSistema'.$consql;
$SIS_join  = '';
$SIS_where = '(TimeStamp BETWEEN "'.$FechaInicio.' '.$HoraInicio.'" AND "'.$FechaTermino.' '.$HoraTermino.'")';
$SIS_order = 'FechaSistema ASC,HoraSistema ASC LIMIT 10000';
$arrMediciones = array();
$arrMediciones = db_select_array (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.$idTelemetria, $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrMediciones');


/*************************************************************/
//Variables
$Temp_1        = '';
$arrData       = array();
	
//Se recorren las mediciones
foreach($arrMediciones as $cli) {
	
	//Guardo la fecha							
	$Temp_1 .= "'".Fecha_estandar($cli['FechaSistema'])." - ".$cli['HoraSistema']."',";
		
	//variables
	$arrDato = array();	
	//recorro los sensores
	for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
		//que pertenezca al grupo y grupo uso
		if($rowEquipo['SensoresRevisionGrupo_'.$i]==$idGrupoUso&&$rowEquipo['SensoresGrupo_'.$i]==$idGrupo){
			//Verifico si el sensor esta activo para guardar el dato
			if(isset($rowEquipo['SensoresActivo_'.$i])&&$rowEquipo['SensoresActivo_'.$i]==1){
				//Que el valor medido sea distinto de 999
				if(isset($cli['SensorValue_'.$i])&&$cli['SensorValue_'.$i]<99900){
					//verifico si existe
					if(isset($arrData[$i]['Value'])&&$arrData[$i]['Value']!=''){
						$arrData[$i]['Value'] .= ", ".$cli['SensorValue_'.$i];
					//si no lo crea
					}else{
						$arrData[$i]['Value'] = $cli['SensorValue_'.$i];
					}
					//titulo grafico
					$arrData[$i]['Name'] = "'".$rowEquipo['SensoresNombre_'.$i]."'";
				//si esta dando error
				}else{
					//verifico si existe
					if(isset($arrData[$i]['Value'])&&$arrData[$i]['Value']!=''){
						$arrData[$i]['Value'] .= ", 0";
					//si no lo crea
					}else{
						$arrData[$i]['Value'] = "0";
					}
					//titulo grafico
					$arrData[$i]['Name'] = "'".$rowEquipo['SensoresNombre_'.$i]."'";
				}
			}
		}	
	}
}
	
//variables
$Graphics_xData       = 'var xData = [';
$Graphics_yData       = 'var yData = [';
$Graphics_names       = 'var names = [';
$Graphics_types       = 'var types = [';
$Graphics_texts       = 'var texts = [';
$Graphics_lineColors  = 'var lineColors = [';
$Graphics_lineDash    = 'var lineDash = [';
$Graphics_lineWidth   = 'var lineWidth = [';
//Se crean los datos
for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
	if(isset($arrData[$x]['Name'])){
		//las fechas
		$Graphics_xData      .='['.$Temp_1.'],';
		//los valores
		$Graphics_yData      .='['.$arrData[$x]['Value'].'],';
		//los nombres
		$Graphics_names      .= $arrData[$x]['Name'].',';
		//los tipos
		$Graphics_types      .= "'',";
		//si lleva texto en las burbujas
		$Graphics_texts      .= "[],";
		//los colores de linea
		$Graphics_lineColors .= "'',";
		//los tipos de linea
		$Graphics_lineDash   .= "'',";
		//los anchos de la linea
		$Graphics_lineWidth  .= "'',";
	}
} 
$Graphics_xData      .= '];';
$Graphics_yData      .= '];';
$Graphics_names      .= '];';
$Graphics_types      .= '];';
$Graphics_texts      .= '];';
$Graphics_lineColors .= '];';
$Graphics_lineDash   .= '];';
$Graphics_lineWidth  .= '];';
	
$widget = '
<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/plotly_js/dist/plotly.min.js"></script>
<script type="text/javascript" src="'.DB_SITE_REPO.'/LIBS_js/plotly_js/dist/plotly-locale-es-ar.js"></script>
';			

$gr_tittle = 'Grafico (°C)';
$gr_unimed = '°C';
$widget .= GraphLinear_1('graphLinear_1', $gr_tittle, 'Fecha', $gr_unimed, $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_types, $Graphics_texts, $Graphics_lineColors, $Graphics_lineDash, $Graphics_lineWidth, 1);
		

echo $widget;
?>


