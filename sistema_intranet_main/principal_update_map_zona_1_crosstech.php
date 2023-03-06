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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
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
$N_Maximo_Sensores = 72;
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
telemetria_listado.id_Sensores

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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrEquipo,$row );
}
		
/*************************************************************/
//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnimed');

//Ordeno las unidades de medida
$arrFinalUnimed = array();
foreach ($arrUnimed as $data) {
	$arrFinalUnimed[$data['idUniMed']] = $data['Nombre'];
}

?>

<script>
	var HoraRefresco = '<?php echo hora_actual(); ?>';
	
	<?php
	$GPS = 'var new_locations = [ ';
			foreach ( $arrEquipo as $data ) {
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
							if(isset($arrFinalUnimed[$data['SensoresUniMed_'.$i]])){
								$unimed = ' '.$arrFinalUnimed[$data['SensoresUniMed_'.$i]];
							}else{
								$unimed = '';
							}
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
	?>
</script>

