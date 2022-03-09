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
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "view_alertas_personalizadas.php";
$location = $original;
$location .='?view='.$_GET['view'];
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Si el estado esta distinto de vacio
if ( !empty($_GET['estado']) ) {
	//Llamamos al formulario
	$form_trabajo= 'estado';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso.php';
}
//Si el estado esta distinto de vacio
if ( !empty($_GET['estadoAll']) ) {
	//Llamamos al formulario
	$form_trabajo= 'estadoAll';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
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
/**************************************************************/
// tomo los datos del equipo
$rowdata = db_select_data (false, 'Nombre', 'telemetria_listado', '', 'idTelemetria ='.$X_Puntero, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//listo las alertas
$SIS_query = '
telemetria_listado_alarmas_perso.idAlarma, 
telemetria_listado_alarmas_perso.Nombre,
telemetria_listado_alarmas_perso_tipos.Nombre AS Tipo,
core_estados.Nombre AS Estado,
telemetria_listado_alarmas_perso.idEstado';
$SIS_join  = '
LEFT JOIN `telemetria_listado_alarmas_perso_tipos` ON telemetria_listado_alarmas_perso_tipos.idTipo    = telemetria_listado_alarmas_perso.idTipo
LEFT JOIN `core_estados`                           ON core_estados.idEstado                            = telemetria_listado_alarmas_perso.idEstado';
$SIS_where = 'telemetria_listado_alarmas_perso.idTelemetria ='.$X_Puntero;
$SIS_order = 'telemetria_listado_alarmas_perso.idEstado ASC';
$arrAlarmas = array();
$arrAlarmas = db_select_array (false, $SIS_query, 'telemetria_listado_alarmas_perso', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrAlarmas');

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Alertas Personalizadas del equipo <?php echo $rowdata['Nombre']; ?></h5>	
		</header>
        <div id="div-3" class="tab-content">
			<div class="table-responsive">   
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Tipo</th>
							<th width="100">Estado</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<tr class="odd">
								<td colspan="3"><strong>Activar-Desactivar Todos</strong></td>
								<td>
									<div class="btn-group" style="width: 100px;" id="toggle_event_editing"> 
										<?php 
										$ubicacion_1 = $location.'&estadoAll='.simpleEncode(2, fecha_actual());
										$dialogo_1   = 'Al desactivar todas las alertas , el sistema dejará de detectar mediciones fuera de rango. ¿Estás seguro que deseas continuar?';
										$ubicacion_2 = $location.'&estadoAll='.simpleEncode(1, fecha_actual());
										$dialogo_2   = '¿Realmente deseas activar todas las alertas?';
										?>
										<a class="btn btn-sm btn-default unlocked_inactive" onClick="dialogBox('<?php echo $ubicacion_1 ?>', '<?php echo $dialogo_1 ?>')">OFF</a>
										<a class="btn btn-sm btn-default unlocked_inactive" onClick="dialogBox('<?php echo $ubicacion_2 ?>', '<?php echo $dialogo_2 ?>')">ON</a>
									</div> 
								</td>
							</tr>
							
						<?php foreach ($arrAlarmas as $alarm) { ?>
							<tr class="odd">
								<td><?php echo $alarm['Nombre']; ?></td>
								<td><?php echo $alarm['Tipo']; ?></td>	
								<td>
									<?php 
									//Si esta activada
									if(isset($alarm['idEstado'])&&$alarm['idEstado']==1){
										$label_color_1 = 'label-success';
									//si esta desactivada
									}else{
										$label_color_1 = 'label-danger';
									}
									echo '<label class="label '.$label_color_1.'">'.$alarm['Estado'].'</label>'; 
									
									?>
								</td>
								<td>
									<div class="btn-group" style="width: 100px;" id="toggle_event_editing"> 
										<?php if ( $alarm['idEstado']==1 ) {
											$ubicacion = $location.'&idAlarma='.simpleEncode($alarm['idAlarma'], fecha_actual()).'&estado='.simpleEncode(2, fecha_actual());
											$dialogo   = 'Al desactivar las alertas '.$alarm['Nombre'].', el sistema dejará de detectar mediciones fuera de rango. ¿Estás seguro que deseas continuar?';
											?>   
											<a class="btn btn-sm btn-default unlocked_inactive" onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')">OFF</a>
											<a class="btn btn-sm btn-info locked_active" href="#">ON</a>
										<?php } else {
											$ubicacion = $location.'&idAlarma='.simpleEncode($alarm['idAlarma'], fecha_actual()).'&estado='.simpleEncode(1, fecha_actual());
											$dialogo   = '¿Realmente deseas activar las alertas '.$alarm['Nombre'].'?';
											?>
											<a class="btn btn-sm btn-info locked_active" href="#">OFF</a>
											<a class="btn btn-sm btn-default unlocked_inactive" onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')">ON</a>
										<?php }?>
									</div> 
								</td>
							</tr>
						<?php } ?>                    
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
//cuadro mensajes
widget_avgrund();
?>
