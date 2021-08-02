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
//solo los equipos que tengan el seguimiento activado
if(isset($_GET['seguimiento'])&&$_GET['seguimiento']!=''&&simpleDecode($_GET['seguimiento'], fecha_actual())!=0){
	$z .= " AND telemetria_listado.id_Geo = ".simpleDecode($_GET['seguimiento'], fecha_actual());
}
//Filtro el sistema al cual pertenece	
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&simpleDecode($_GET['idSistema'], fecha_actual())!=0){
	$z .= " AND telemetria_listado.idSistema = ".simpleDecode($_GET['idSistema'], fecha_actual());	
}

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresMedErrores_'.$i;
	$subquery .= ',SensoresErrorActual_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}	
//Listar los equipos
$arrEquipo = array();
$query = "SELECT idTelemetria, Nombre, 
LastUpdateFecha, LastUpdateHora,cantSensores,GeoLatitud, GeoLongitud,NDetenciones,TiempoFueraLinea
".$subquery."
	
FROM `telemetria_listado`
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
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
array_push( $arrEquipo,$row );
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
							<th>Nombre</th>
							<th>Fecha - Hora</th>
							<th width="120">Ver Alertas</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">			
						<?php 
						$extra_data  = '';
						$extra_data .= '&f_inicio='.fecha_actual();
						$extra_data .= '&f_termino='.fecha_actual();
						
						foreach ($arrEquipo as $data) { 
							
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
											if($xx<0){$ident = $data['idTelemetria'];}
										}
									}
									//imprimo
									if($ident!=0){
										echo '
										<tr class="odd">		
											<td>'.$data['Nombre'].'</td>
											<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_errores_'.simpleDecode($_GET['seguimiento'], fecha_actual()).'.php?submit_filter=Filtrar'.$extra_data.'&idTelemetria='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>						
												</div>
											</td>	
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
											<td>'.$data['Nombre'].'</td>
											<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_fuera_linea_'.simpleDecode($_GET['seguimiento'], fecha_actual()).'.php?submit_filter=Filtrar'.$extra_data.'&idTelemetria='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>						
												</div>
											</td>	
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
												<td>'.$data['Nombre'].'</td>
												<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
												<td></td>	
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
											<td>'.$data['Nombre'].'</td>
											<td>'.fecha_estandar($data['LastUpdateFecha']).' a las '.$data['LastUpdateHora'].' hrs</td>		
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="principal_gps_view_view.php?view='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>						
												</div>
											</td>	
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




