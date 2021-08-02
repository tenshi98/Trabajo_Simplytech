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
$original = "informe_gerencial_17.php";
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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//Variables
$titulo_cuadro  = 'Ultimas Mediciones';
$seguimiento    = 2;
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();


//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
$z .= " AND telemetria_listado.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];


//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($_SESSION['usuario']['basic_data']['idTipoUsuario'])&&$_SESSION['usuario']['basic_data']['idTipoUsuario']!=1&&isset($_SESSION['usuario']['basic_data']['idUsuario'])&&$_SESSION['usuario']['basic_data']['idUsuario']!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];	
}


//numero sensores equipo
$N_Maximo_Sensores = 72;
$qry = '';
//Recorro la configuracion de los sensores
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$qry .= ', SensoresNombre_'.$i;
	$qry .= ', SensoresMedErrores_'.$i;
	$qry .= ', SensoresErrorActual_'.$i;
	$qry .= ', SensoresActivo_'.$i;
} 						
//Listar los equipos
$arrEquipo = array();
$query = "SELECT
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea
".$qry."

FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$join."
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



$GPS = '';
$GPS .= '<link rel="stylesheet" href="'.DB_SITE_REPO.'/LIBS_js/modal/colorbox.css" />';


	$GPS .= '
	<div class="row">
		<div class="col-sm-12 clearfix">
			<a target="new" href="informe_gerencial_17_to_excel.php" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
		</div>
	</div>
		
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>'.$titulo_cuadro.'</h5>	
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Noti</th>
								<th>Equipo</th>
								<th>Ultima Conexion</th>
								<th>Estado</th>
								<th width="10">Acciones</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">';
						
							foreach($arrEquipo as $equip) {	
								//Se resetean
								$eq_alertas     = 0; 
								$eq_fueralinea  = 0; 
								$eq_fueraruta   = 0;
								$eq_detenidos   = 0;
								$xx = 0;
								$xy = 0;
								$xz = 0;
								$xw = 0;
								$dataex = '';
											
								$eq_ok = ' Sin Problemas';
								for ($i = 1; $i <= $equip['cantSensores']; $i++) {
									//verifico si sensor esta activo
									if(isset($equip['SensoresActivo_'.$i])&&$equip['SensoresActivo_'.$i]==1){
										//verifico errores
										$xx = $equip['SensoresMedErrores_'.$i] - $equip['SensoresErrorActual_'.$i];
										if($xx<0){$xy = 1;$eq_ok = '';}
									}
								}
								$eq_alertas = $eq_alertas + $xy;
											
								//Fuera de linea
								$diaInicio   = $equip['LastUpdateFecha'];
								$diaTermino  = $FechaSistema;
								$tiempo1     = $equip['LastUpdateHora'];
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
								if($Tiempo>$equip['TiempoFueraLinea']&&$equip['TiempoFueraLinea']!='00:00:00'){
									$eq_fueralinea = $eq_fueralinea + 1;	
									$eq_ok = '';
								}
											
											
											
								//equipos ok
								if($eq_alertas>0){$eq_ok = '';$xw = 1;$dataex .= ' Con Alertas';}
								if($eq_fueralinea>0){$eq_ok = '';$xz = 1;$dataex .= ' Fuera de Linea';}
											
								$eq_ok .= $dataex;
								
								if($xz!=0){
									$danger = 'Peligro';
								}elseif($xw!=0){
									$danger = 'Alerta';
								}else{
									$danger = 'Normal';
								}	
								
								
										
								$GPS .= '	
								<tr class="odd">		
									<td>'.$danger.'</td>	
									<td>'.$equip['Nombre'].'</td>	
									<td>'.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>	
									<td><div class="btn-group" >'.$eq_ok.'</div></td>			
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="telemetria_gestion_equipos_view_equipo.php?view='.simpleEncode($equip['idTelemetria'], fecha_actual()).'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
										</div>
									</td>
								</tr>';
							}					
							$GPS .= '       
						</tbody>
					</table>
				</div>	
			</div>	
		</div>
	</div>';



$GPS .= '
<script src="'.DB_SITE_REPO.'/LIBS_js/modal/jquery.colorbox.js"></script>

<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
			onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
			onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
			onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
			onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
		});

				
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
	
	';
	
	echo $GPS;

									
?>





<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
