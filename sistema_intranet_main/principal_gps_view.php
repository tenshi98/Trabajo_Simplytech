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
if(isset($_GET['seguimiento'])&&$_GET['seguimiento']!=''&&$_GET['seguimiento']!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$_GET['seguimiento'];
}
//Filtro el sistema al cual pertenece	
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
	$z .= " AND telemetria_listado.idSistema = ".$_GET['idSistema'];	
}
	
//Listar los equipos
$arrEquipo = array();
$query = "SELECT idTelemetria, Nombre, 
LastUpdateFecha, LastUpdateHora,cantSensores,GeoLatitud, GeoLongitud,NDetenciones,TiempoFueraLinea,

SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,
	
SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50,
			
SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50
	
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
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Maqueta</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<style>
			body {
				background-color: #FFF;
			}
		</style>
	</head>

	<body>



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
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
							switch ($_GET['dataType']) {
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
											<td>'.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>		
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_errores_'.$_GET['seguimiento'].'.php?submit_filter=Filtrar'.$extra_data.'&idTelemetria='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>						
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
											<td>'.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>		
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="informe_telemetria_fuera_linea_'.$_GET['seguimiento'].'.php?submit_filter=Filtrar'.$extra_data.'&idTelemetria='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>						
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
												<td>'.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>		
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
											<td>'.fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs</td>		
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="principal_gps_view_view.php?view='.$data['idTelemetria'].'" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>						
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


<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

		
	</body>

</html>




