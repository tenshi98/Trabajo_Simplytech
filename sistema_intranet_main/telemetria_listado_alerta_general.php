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
$original = "telemetria_listado.php";
$location = $original;
$new_location = "telemetria_listado_alerta_general.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Si el estado esta distinto de vacio
if ( !empty($_GET['alerta']) ) {
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'alerta';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Equipo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Equipo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Equipo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$SIS_query = '
telemetria_listado.Nombre,
telemetria_listado.id_Geo,
telemetria_listado.id_Sensores,
telemetria_listado.idAlarmaGeneral,
telemetria_listado_alarma_general.Nombre AS Estado, 
telemetria_listado.idUsoContrato,
telemetria_listado.idUsoGeocerca';
$SIS_join  = 'LEFT JOIN `telemetria_listado_alarma_general`   ON telemetria_listado_alarma_general.idAlarmaGeneral   = telemetria_listado.idAlarmaGeneral';
$SIS_where = 'telemetria_listado.idTelemetria ='.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');


//Verifico el tipo de usuario que esta ingresando
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Alerta General');?>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class="active"><a href="<?php echo 'telemetria_listado_alerta_general.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarma General</a></li>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarmas Personalizadas</a></li>
						<?php } ?>
						<?php if($rowdata['id_Geo']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_gps.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> Datos GPS</a></li>
							<?php if($rowdata['idUsoGeocerca']==1){ ?>
								<li class=""><a href="<?php echo 'telemetria_listado_geocercas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> GeoCercas</a></li>
							<?php } ?>
						<?php } elseif($rowdata['id_Geo']==2){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-signs" aria-hidden="true"></i> Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
							<li class=""><a href="<?php echo 'telemetria_listado_sensor_operaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Definicion Operacional</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Horario Envio Notificaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i> Otros Datos</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivos</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Estado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<tr class="odd">			
						<td><?php echo 'Alerta General se encuentra <strong>'.$rowdata['Estado'].'</strong>'; ?></td>		
						<td>
							<div class="btn-group" style="width: 100px;" id="toggle_event_editing"> 	 
								<?php if ($rowlevel['level']>=2){?>    				  
									<?php if ( $rowdata['idAlarmaGeneral']==1 ) {?>   
										<a class="btn btn-sm btn-default unlocked_inactive" href="<?php echo $new_location.'&id='.$_GET['id'].'&alerta=2' ; ?>">OFF</a>
										<a class="btn btn-sm btn-info locked_active" href="#">ON</a>
									<?php } else {?>
										<a class="btn btn-sm btn-info locked_active" href="#">OFF</a>
										<a class="btn btn-sm btn-default unlocked_inactive" href="<?php echo $new_location.'&id='.$_GET['id'].'&alerta=1' ; ?>">ON</a>
									<?php }?>    
								<?php }?>  
							</div>     
						</td>	
					</tr>                  
				</tbody>
			</table>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
