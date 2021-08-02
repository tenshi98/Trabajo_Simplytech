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
//Variable
$idTipoUsuario  = $_GET['idTipoUsuario'];
$idSistema      = $_GET['idSistema'];
$idUsuario      = $_GET['idUsuario'];
$idZona         = $_SESSION['usuario']['zona']['idZona'];
if(isset($_SESSION['usuario']['zona']['id_Geo'])&&$_SESSION['usuario']['zona']['id_Geo']!=''){
	$id_Geo = $_SESSION['usuario']['zona']['id_Geo'];
}else{
	$id_Geo = 1;//seguimiento activo
}
//variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
		
//datos temporales para los widgets
$Gen_Rocio         = 0;
$Gen_Temperatura   = 0;
$Gen_Humedad       = 0;
$Gen_Presion       = 0;
$Total_Rocio       = 0;
$Total_Temperatura = 0;
$Total_Humedad     = 0;
$Total_Presion     = 0;
$Count_Data        = 0;
		
		
//filtro
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
$z .= " AND telemetria_listado.id_Geo = ".$id_Geo;
//Filtro de los tab
$z .= " AND telemetria_listado.idTab = ".$_GET['idTab'];
//Filtro el sistema al cual pertenece	
if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	$z .= " AND telemetria_listado.idSistema = ".$idSistema;	
}
//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($idTipoUsuario)&&$idTipoUsuario!=1&&isset($idUsuario)&&$idUsuario!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$idUsuario;	
}
//filtro la zona
if(isset($idZona)&&$idZona!=''&&$idZona!=9999){
	$z .= " AND telemetria_listado.idZona = ".$idZona;
}

//numero sensores equipo
$N_Maximo_Sensores = 20;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresMedActual_'.$i;
	$subquery .= ',SensoresUniMed_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}		
//Listar los equipos
$arrEquipo = array();
$query = "SELECT 
telemetria_listado.Nombre, 
telemetria_listado.LastUpdateFecha,
telemetria_listado.LastUpdateHora, 
telemetria_listado.GeoLatitud, 
telemetria_listado.GeoLongitud,
telemetria_listado.cantSensores, 
telemetria_listado.GeoVelocidad, 
telemetria_listado.Patente, 
telemetria_listado.id_Sensores, 
telemetria_listado.TiempoFueraLinea

".$subquery."
FROM `telemetria_listado`
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
$resultado = mysqli_query($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEquipo,$row );
}
		
/*************************************************************/
//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
							
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnimed,$row );
}
//Ordeno las unidades de medida
$arrFinalUnimed = array();
foreach ($arrUnimed as $data) {
	$arrFinalUnimed[$data['idUniMed']]['Nombre'] = $data['Nombre'];
}

/*************************************************************/
//se traen todas las zonas
$query = "SELECT Helada, HorasBajoGrados, HorasSobreGrados, UnidadesFrio,
Dias_acumulado, Dias_anterior
FROM `telemetria_listado_aux` 
WHERE idSistema=".$idSistema." 
ORDER BY idAuxiliar DESC
LIMIT 1";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
							
}
$rowAux = mysqli_fetch_assoc ($resultado);

?>


<script>
	var HoraRefresco = '<?php echo hora_actual(); ?>';
	
	<?php
	$GPS = 'var new_locations = [ ';
			foreach ( $arrEquipo as $data ) {
				
				/**********************************************/
				//Se resetean
				$in_eq_fueralinea  = 0;
										
				/**********************************************/
				//Fuera de linea
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
					$in_eq_fueralinea++;
				}
										
				/*******************************************************/
				//Promedios de widgets
				//verifico que este midiendo
				if($in_eq_fueralinea==0){
					$Total_Temperatura = $Total_Temperatura + $data['SensoresMedActual_1'];
					$Total_Humedad     = $Total_Humedad + $data['SensoresMedActual_2'];
					$Total_Rocio       = $Total_Rocio + $data['SensoresMedActual_3'];
					$Total_Presion     = $Total_Presion + $data['SensoresMedActual_4'];
					$Count_Data++;
				}
										
				//burbuja
				if(isset($data['Patente'])&&$data['Patente']!=''){$pate_nte = ' ('.$data['Patente'].')';}else{$pate_nte = '';}
				$explanation  = '<div class="iw-subTitle">Vehiculo: '.$data['Nombre'].$pate_nte.'</div>';
				$explanation .= '<p>Velocidad: '.Cantidades($data['GeoVelocidad'], 0).'<br/>';
				$explanation .= 'Actualizado: '.fecha_estandar($data['LastUpdateFecha']).' - '.$data['LastUpdateHora'].'</p>';
				//verifico si tiene sensores configurados
				if(isset($data['id_Sensores'])&&$data['id_Sensores']==1){
					$explanation .= '<div class="iw-subTitle">Sensores: </div><p>';
					for ($i = 1; $i <= $data['cantSensores']; $i++) {
						//verifico que sensor este activo
						if(isset($data['SensoresActivo_'.$i])&&$data['SensoresActivo_'.$i]==1){
							//Unidad medida
							$unimed = ' '.$arrFinalUnimed[$data['SensoresUniMed_'.$i]]['Nombre'];
							//cadena
							if(isset($data['SensoresMedActual_'.$i])&&$data['SensoresMedActual_'.$i]<99900){$xdata=Cantidades($data['SensoresMedActual_'.$i], 2).$unimed;}else{$xdata='Sin Datos';}
							$explanation .= $data['SensoresNombre_'.$i].' : '.$xdata.'<br/>';
						}
					}
					$explanation .= '</p>';
				}
				//se arma dato
				$GPS .= "[";
					$GPS .= $data['GeoLatitud'];
					$GPS .= ", ".$data['GeoLongitud'];
					$GPS .= ", '".$explanation."'";
				$GPS .= "], ";					
			}
		$GPS .= '];';
		
		echo $GPS;
		/* ************************************************************************** */
		//Calculos
		if($Count_Data!=0){
			$Gen_Temperatura   = Cantidades(($Total_Temperatura / $Count_Data), 2);
			$Gen_Humedad       = Cantidades(($Total_Humedad / $Count_Data), 2);
			$Gen_Rocio         = Cantidades(($Total_Rocio / $Count_Data), 2);
			$Gen_Presion       = Cantidades(($Total_Presion / $Count_Data), 0);
		}
		/* ************************************************************************** */
		//calculos otros widgets
		$HoraBajo        = 0;
		$HoraSobre       = 0;
		$UnidadFrio      = 0;
		$Helada          = 0;
		$Dias_acumulado  = 0;
		$Dias_anterior   = 0;
		if(isset($rowAux['HorasBajoGrados'])&&$rowAux['HorasBajoGrados']!=''){    $HoraBajo = $rowAux['HorasBajoGrados'];}
		if(isset($rowAux['HorasSobreGrados'])&&$rowAux['HorasSobreGrados']!=''){  $HoraSobre = $rowAux['HorasSobreGrados'];}
		if(isset($rowAux['UnidadesFrio'])&&$rowAux['UnidadesFrio']!=''){          $UnidadFrio = $rowAux['UnidadesFrio'];}
		if(isset($rowAux['Helada'])&&$rowAux['Helada']!=''){                      $Helada = $rowAux['Helada'];}
		if(isset($rowAux['Dias_acumulado'])&&$rowAux['Dias_acumulado']!=''){      $Dias_acumulado = $rowAux['Dias_acumulado'];}
		if(isset($rowAux['Dias_anterior'])&&$rowAux['Dias_anterior']!=''){        $Dias_anterior = $rowAux['Dias_anterior'];}
					
				
	?>
	
	var Gen_Temperatura = '<?php echo str_replace(",", ".",$Gen_Temperatura); ?>';
	var Gen_Humedad = '<?php echo str_replace(",", ".",$Gen_Humedad); ?>';
	var Gen_Rocio = '<?php echo str_replace(",", ".",$Gen_Rocio); ?>';
	var Gen_Presion = '<?php echo str_replace(",", ".",$Gen_Presion); ?>';
	
	var Dat_Helada = '<?php echo str_replace(",", ".",Cantidades($Helada, 2)); ?>';
	var Dat_HoraBajo = '<?php echo str_replace(",", ".",Cantidades($HoraBajo, 2)); ?>';
	var Dat_HoraSobre = '<?php echo str_replace(",", ".",Cantidades($HoraSobre, 2)); ?>';
	var Dat_UnidadFrio = '<?php echo str_replace(",", ".",Cantidades($UnidadFrio, 0)); ?>';
	var Dat_Dias_acumulado = '<?php echo str_replace(",", ".",Cantidades($Dias_acumulado, 0)); ?>';
	var Dat_Dias_anterior = '<?php echo str_replace(",", ".",Cantidades($Dias_anterior, 0)); ?>';
	
	<?php if($Helada>3){ ?>
		var helIcon = '<span style="color:#00a65a;"><i class="fa fa-thermometer-full" aria-hidden="true"></i></span>';
	<?php }elseif($Helada<=2.9&&$Helada>=0.1){ ?>
		var helIcon = '<span style="color:#FFCB19;"><i class="fa fa-thermometer-half" aria-hidden="true"></i></span>';
	<?php }elseif($Helada<0.1){ ?>
		var helIcon = '<span style="color:#d9534f;"><i class="fa fa-thermometer-empty" aria-hidden="true"></i></span>';
	<?php } ?>
	
</script>

