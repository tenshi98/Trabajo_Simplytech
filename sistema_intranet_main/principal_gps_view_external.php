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
/*                                                Carga del documento HTML                                                        */
/**********************************************************************************************************************************/


//verifica la capa de desarrollo
$whitelist = array( 'localhost', '127.0.0.1', '::1' );
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de desarrollo
if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){
	$CON_Server    = 'localhost';
	$CON_Usuario   = 'root';
	$CON_Password  = '';
	$CON_Base      = 'power_engine_main';
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de produccion	
}else{
	$CON_Server    = 'localhost';
	$CON_Usuario   = 'crosstech_admin';
	$CON_Password  = '&-VSda,#rFvT';
	$CON_Base      = 'crosstech_pe_clientes';
}	
			
//Funcion para conectarse
function conectarDB ($servidor, $usuario, $password, $base_datos) {
	$db_con = mysqli_connect($servidor, $usuario, $password, $base_datos);
	$db_con->set_charset("utf8");
	return $db_con; 
}
//verifico si existen datos
if($CON_Server!=''&&$CON_Usuario!=''&&$CON_Base!=''){
	//ejecuto conexion
	$dbConn_2 = conectarDB($CON_Server, $CON_Usuario, $CON_Password, $CON_Base);
				
	//variables
	$HoraSistema    = hora_actual(); 
	$FechaSistema   = fecha_actual();
	$eq_alertas     = 0; 
	$eq_fueralinea  = 0; 
	$eq_fueraruta   = 0;
	$eq_detenidos   = 0;
	$eq_ok          = 0;
	
	//Variable
	$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
	//numero sensores equipo
	$N_Maximo_Sensores = 72;
	$subquery = '';
	for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
		$subquery .= ',telemetria_listado.SensoresMedErrores_'.$i;
		$subquery .= ',telemetria_listado.SensoresErrorActual_'.$i;
		$subquery .= ',telemetria_listado.SensoresActivo_'.$i;
	}	
	//Listar los equipos
	$arrEquipo = array();
	$query = "SELECT 
	telemetria_listado.idTelemetria, 
	telemetria_listado.Nombre, 
	telemetria_listado.LastUpdateFecha, 
	telemetria_listado.LastUpdateHora,
	telemetria_listado.cantSensores,
	telemetria_listado.NDetenciones,
	telemetria_listado.TiempoFueraLinea,
	core_sistemas.Nombre AS Sistema
	".$subquery."
		
	FROM `telemetria_listado`
	LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
	".$z."
	ORDER BY core_sistemas.Nombre ASC, telemetria_listado.Nombre ASC  ";
	//Consulta
	$resultado = mysqli_query ($dbConn_2, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');
						
		//Guardo el error en una variable temporal
		$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn_2);
		$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn_2);
		$_SESSION['ErrorListing'][$vardata]['query']        = $query;
						
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrEquipo,$row );
	}
	
				
}			
			

/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/

?>



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Equipo</h5>
				
		</header>
        <div id="div-3" class="tab-content">
			
			
			<div class="table-responsive"> 
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Sistema</th>
							<th>Nombre</th>
							<th>Fecha - Hora</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">			
						<?php foreach ($arrEquipo as $data) { 
							
							//Variables
							$xx = 0;
							$xy = 0;
							$xz = 0;
							$ident = 0;
									
							//dependiendo del tipo de datos que quiero mostrar ajusto los datos
							switch (simpleDecode($_GET['dataType'], fecha_actual())) {
								//En caso de que los sensores registren alguna alerta
								case 1:
									//recorro los sensores activos
									for ($i = 1; $i <= $data['cantSensores']; $i++) {
										//solo sensores activos
										if(isset($data['SensoresActivo_'.$i])&&$data['SensoresActivo_'.$i]==1){
											$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
											if($xx<0){$ident = 1;}
										}
									}
									//imprimo
									if($ident!=0){
										echo '
										<tr class="odd">		
											<td>'.$data['Sistema'].'</td>
											<td>'.$data['Nombre'].'</td>
											<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
										</tr>
										';
									}
									break;
								
								//En caso de que el equipo este fuera de linea
								case 2:
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
										//imprimo	
										echo '
										<tr class="odd">		
											<td>'.$data['Sistema'].'</td>
											<td>'.$data['Nombre'].'</td>
											<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
										</tr>
										';
									}
									break;
								
								//En caso de que este fuera de ruta	
								case 3:
									
									break;
								
								//Equipos en buen estado	
								case 4:
									//Calculo total de datos
										$eq_alertas = 0;
										$eq_detenidos = 0;
										$eq_fueralinea = 0;
										
										//alertas
										$xx = 0;
										$xy = 0;
										$xz = 0;
										for ($i = 1; $i <= $data['cantSensores']; $i++) {
											//solo sensores activos
											if(isset($data['SensoresActivo_'.$i])&&$data['SensoresActivo_'.$i]==1){
												$xx = $data['SensoresMedErrores_'.$i] - $data['SensoresErrorActual_'.$i];
												if($xx<0){$xy = 1;}
											}
										}
										$eq_alertas = $eq_alertas + $xy;
										
										//Fuera de linea
										$Tiempo = restahoras($data['LastUpdateHora'], $HoraSistema);
										if($Tiempo>$data['TiempoFueraLinea']&&$data['TiempoFueraLinea']!='00:00:00'){
											$eq_fueralinea++;	
										}
										
										//Equipos detenidos
										if($data['NDetenciones']>0){
											$eq_detenidos++;	
										}
										
										//equipos ok
										$errrno = $eq_alertas + $eq_fueralinea + $eq_detenidos;
										if($errrno>0){$xz = 1;}else{$xz = 0;}
										
										if($xz==0){
											//imprimo	
											echo '
											<tr class="odd">		
												<td>'.$data['Sistema'].'</td>
												<td>'.$data['Nombre'].'</td>
												<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
											</tr>
											';
										}
									
									break;
									
								//En caso de que este detenido	
								case 5:
									if($data['NDetenciones']!=0){
										//imprimo	
										echo '
										<tr class="odd">		
											<td>'.$data['Sistema'].'</td>
											<td>'.$data['Nombre'].'</td>
											<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
										</tr>
										';
									}
									break;
							}
							
							
						} ?>                    
					</tbody>
				</table>
			</div>
        </div>	
	</div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>




