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
//defino variables
$idTipoUsuario  = $_SESSION['usuario']['zona']['idTipoUsuario'];
$idSistema      = $_SESSION['usuario']['zona']['idSistema'];
$idUsuario      = $_SESSION['usuario']['zona']['idUsuario'];
if(isset($_SESSION['usuario']['zona']['id_Geo'])&&$_SESSION['usuario']['zona']['id_Geo']!=''){
	$id_Geo = $_SESSION['usuario']['zona']['id_Geo'];
}else{
	$id_Geo = 1;//seguimiento activo
}
//variables
$FechaSistema   = fecha_actual();
$Fecha_inicio   = restarDias(fecha_actual(),1);
$Fecha_fin      = fecha_actual();
		
//condicionales
if(isset($_GET['idZona'])&&$_GET['idZona']!=''){
	//Variables
	$idZona  = $_GET['idZona'];
	//redefino la variable temporal de la zona 
	$_SESSION['usuario']['zona']['idZona'] = $idZona;	
}else{
	$idZona  = $_SESSION['usuario']['zona']['idZona'];
}


//se traen todas las zonas
$arrZonas = array();
$query = "SELECT idZona, Nombre
FROM `telemetria_zonas` ";
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
array_push( $arrZonas,$row );
}

/************************************************************************/		
//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
$z .= " AND telemetria_listado.id_Geo = ".$id_Geo;
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
//Solo para plataforma CrossTech
$z .= " AND telemetria_listado.idTab=9";//CrossEnergy
		
//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresMedErrores_'.$i;
	$subquery .= ',SensoresErrorActual_'.$i;
	$subquery .= ',SensoresMedActual_'.$i;
}	
//Listar los equipos
$arrEquipo = array();
$query = "SELECT 
telemetria_listado.idTelemetria, 
telemetria_listado.Nombre, 
telemetria_listado.Identificador, 
telemetria_listado.LastUpdateFecha,
telemetria_listado.LastUpdateHora,
telemetria_listado.cantSensores,
telemetria_listado.GeoLatitud, 
telemetria_listado.GeoLongitud, 
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NErrores,
telemetria_listado.NAlertas

".$subquery."
	
FROM `telemetria_listado`
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
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
array_push( $arrEquipo,$row );
}
/**************************************************************************/
//variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
$arrGruas       = array();
$nicon          = 0;

/**************************************************************************/								
foreach ($arrEquipo as $data) { 
			
	/**********************************************/
	//Se resetean
	$in_eq_alertas     = 0;
	$in_eq_fueralinea  = 0;
	$in_eq_ok          = 1;
																				
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
			$n_dias       = $n_dias-1;
			$horas_trans2 = multHoras('24:00:00',$n_dias);
			$Tiempo       = sumahoras($Tiempo,$horas_trans2);
		}
		if($n_dias==1&&$tiempo1<$tiempo2){
			$horas_trans2 = multHoras('24:00:00',$n_dias);
			$Tiempo       = sumahoras($Tiempo,$horas_trans2);
		}
	}	
	if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){	
		$in_eq_fueralinea++;
	}
				
	/**********************************************/
	//alertas
	$xx = 0;
	for ($i = 1; $i <= $data['cantSensores']; $i++) {
		$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
		if($xx<0){
			$in_eq_alertas++;
		}
	}

	/**********************************************/
	//Equipos Errores
	if($data['NErrores']>0){
		$in_eq_alertas++;	
	}
				
	/*******************************************************/
	//rearmo
	if($in_eq_alertas>0){    $in_eq_ok = 0;  $in_eq_alertas    = 1;    }
	if($in_eq_fueralinea>0){ $in_eq_ok = 0;  $in_eq_fueralinea = 1; $in_eq_alertas = 0;  }
				
	/*******************************************************/
	//se guardan estados
	$danger = '';
	$xdanger = 1;
	if($in_eq_alertas>0){    $danger = 'warning';  $xdanger = 2; $dataex = '<a href="#" title="Equipo con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>';}
	if($in_eq_fueralinea>0){ $danger = 'danger';   $xdanger = 3; $dataex = '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken" aria-hidden="true"></i></a>';}
																
	/*******************************************************/
	//traspasan los estados
	if($in_eq_ok==1){
		$eq_ok_icon = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check" aria-hidden="true"></i></a>';
	}else{
		$eq_ok_icon = $dataex;
	}
	
	
	/*************************************************************************/
	//Guardo todos los datos
	$arrGruas[$xdanger][$data['idTelemetria']]['tr_color']           = $danger;
	$arrGruas[$xdanger][$data['idTelemetria']]['eq_ok_icon']         = $eq_ok_icon;
	$arrGruas[$xdanger][$data['idTelemetria']]['Nombre']             = $data['Nombre'];
	$arrGruas[$xdanger][$data['idTelemetria']]['LastUpdate']         = fecha_estandar($data['LastUpdateFecha']).' '.$data['LastUpdateHora'];
	$arrGruas[$xdanger][$data['idTelemetria']]['crosscrane_estado']  = '<a href="view_crossenergy_estado.php?view='.simpleEncode($data['idTelemetria'], fecha_actual()).'" title="Estado Equipo" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-tasks" aria-hidden="true"></i></a>';
	$arrGruas[$xdanger][$data['idTelemetria']]['Vmonofasico']        = $data['SensoresMedActual_4'];
	$arrGruas[$xdanger][$data['idTelemetria']]['VTrifasico']         = $data['SensoresMedActual_5'];
	$arrGruas[$xdanger][$data['idTelemetria']]['Potencia']           = $data['SensoresMedActual_6'];
							
	/****************************************************/
	//el resto de los botones					
	$arrGruas[$xdanger][$data['idTelemetria']]['CenterMap']            = '<button onclick="fncCenterMap(\''.$data['GeoLatitud'].'\', \''.$data['GeoLongitud'].'\', \''.$nicon.'\')" title="Ver Ubicacion" class="btn btn-default btn-sm tooltip"><i class="fa fa-map-marker" aria-hidden="true"></i></button>';
	//boton de alertas pendientes de ver
	if(isset($data['NAlertas'])&&$data['NAlertas']!=''&&$data['NAlertas']!=0){
		//Alertas
		$link_Alertas  = 'informe_telemetria_errores_6.php';
		$link_Alertas .= '?f_inicio='.$Fecha_inicio;
		$link_Alertas .= '&f_termino='.$Fecha_fin;
		$link_Alertas .= '&idTelemetria='.$data['idTelemetria'];
		$link_Alertas .= '&idLeido=0';		
		$link_Alertas .= '&submit_filter=+Filtrar';	
		//boton
		$arrGruas[$xdanger][$data['idTelemetria']]['NAlertas']         = '<a target="_blank" rel="noopener noreferrer" href="'.$link_Alertas.'" title="Alertas Pendientes de ver" class="btn btn-danger btn-sm tooltip"><i class="fa fa-exclamation-triangle faa-horizontal animated" aria-hidden="true"></i></a>';
	}else{
		$arrGruas[$xdanger][$data['idTelemetria']]['NAlertas']         = '';
	}
				
	$nicon++;		
} 


//Cuento los totales		
$Count_Alerta      = 0;
$Count_Ok          = 0;
$Count_FueraLinea  = 0;
$Count_Total       = 0;
				
if(isset($arrGruas[2])){foreach ( $arrGruas[2] as $categoria=>$grua ) { $Count_Alerta++;$Count_Total++;}}
if(isset($arrGruas[1])){foreach ( $arrGruas[1] as $categoria=>$grua ) { $Count_Ok++;$Count_Total++;}}
if(isset($arrGruas[3])){foreach ( $arrGruas[3] as $categoria=>$grua ) { $Count_FueraLinea++;$Count_Total++;}}

?>

<script>
	//se actualizan los widgets superiores
	document.getElementById('updt_Count_Alerta').innerHTML=<?php echo $Count_Alerta; ?>;
	document.getElementById('updt_Count_FueraLinea').innerHTML=<?php echo $Count_FueraLinea; ?>;
	document.getElementById('updt_Count_Ok').innerHTML=<?php echo $Count_Ok; ?>;
	document.getElementById('updt_Count_Total').innerHTML=<?php echo $Count_Total; ?>;
</script>
					

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
	<thead>
		<tr role="row">
			<th colspan="6">
				<div class="field">
					<select name="selectZona" id="selectZona" class="form-control" onchange="chngZona()" >
						<option value="9999" <?php if($idZona==9999){ echo 'selected="selected"';} ?>>Todas las Zonas</option>
						<?php foreach ( $arrZonas as $select ) { 
							$w = '';
							if($idZona==$select['idZona']){
								$w .= 'selected="selected"';
							}
							?>
							<option value="<?php echo $select['idZona']?>" <?php echo $w; ?> ><?php echo $select['Nombre']?></option>
						<?php } ?> 
					</select>
				</div>
			</th>
		</tr>
		<?php echo widget_sherlock(1, 6); ?>
		<tr role="row">
			<th></th>
			<th>Equipo</th>
			<th>V. Trifasico</th>
			<th>V. Monofasico</th>
			<th>Potencia</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody role="alert" aria-live="polite" aria-relevant="all" id="TableFiltered">
		
		<?php 
		if(isset($arrGruas[2])){
			foreach ( $arrGruas[2] as $categoria=>$grua ) { ?>
			<tr class="odd <?php echo $grua['tr_color']; ?>">
				<td width="10">
					<div class="btn-group" style="width: 35px;" >
						<?php echo $grua['eq_ok_icon']; ?>
					</div> 
				</td>
				<td><?php echo $grua['Nombre'];?><br/><?php echo $grua['LastUpdate'];?></td>
				<td><?php echo cantidades($grua['VTrifasico'], 1).' V';?></td>
				<td><?php echo cantidades($grua['Vmonofasico'], 1).' V';?></td>
				<td><?php echo cantidades($grua['Potencia'], 1).' kW';?></td>
				<td width="10">
					<div class="btn-group" style="width: 105px;" >
						<?php
						echo $grua['NAlertas'];
						echo $grua['crosscrane_estado'];
						echo $grua['CenterMap'];					
						?>
					</div>
				</td>
			</tr>
		<?php }
		} ?> 
		
		<?php 
		if(isset($arrGruas[1])){
			foreach ( $arrGruas[1] as $categoria=>$grua ) { ?>
			<tr class="odd <?php echo $grua['tr_color']; ?>">
				<td width="10">
					<div class="btn-group" style="width: 35px;" >
						<?php echo $grua['eq_ok_icon']; ?>
					</div> 
				</td>
				<td><?php echo $grua['Nombre'];?><br/><?php echo $grua['LastUpdate'];?></td>
				<td><?php echo cantidades($grua['VTrifasico'], 1).' V';?></td>
				<td><?php echo cantidades($grua['Vmonofasico'], 1).' V';?></td>
				<td><?php echo cantidades($grua['Potencia'], 1).' kW';?></td>
				<td width="10">
					<div class="btn-group" style="width: 105px;" >
						<?php
						echo $grua['NAlertas'];
						echo $grua['crosscrane_estado'];
						echo $grua['CenterMap'];							
						?>
					</div>
				</td>
			</tr>
		<?php }
		} ?>
		
		<?php 
		if(isset($arrGruas[3])){
			foreach ( $arrGruas[3] as $categoria=>$grua ) { ?>
			<tr class="odd <?php echo $grua['tr_color']; ?>">
				<td width="10">
					<div class="btn-group" style="width: 35px;" >
						<?php echo $grua['eq_ok_icon']; ?>
					</div> 
				</td>
				<td><?php echo $grua['Nombre'];?><br/><?php echo $grua['LastUpdate'];?></td>
				<td><?php echo cantidades($grua['VTrifasico'], 1).' V';?></td>
				<td><?php echo cantidades($grua['Vmonofasico'], 1).' V';?></td>
				<td><?php echo cantidades($grua['Potencia'], 1).' kW';?></td>
				<td width="10">
					<div class="btn-group" style="width: 105px;" >
						<?php
						echo $grua['NAlertas'];
						echo $grua['crosscrane_estado'];
						echo $grua['CenterMap'];						
						?>
					</div>
				</td>
			</tr>
		<?php }
		} ?> 
		               
	</tbody>
</table>
<?php widget_modal(80, 95); ?>
<?php widget_tooltipster();?>
