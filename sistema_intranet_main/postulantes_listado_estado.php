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
$original = "postulantes_listado.php";
$location = $original;
$new_location = "postulantes_listado_estado.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Si el estado esta distinto de vacio
if ( !empty($_GET['estado']) ) {
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'estado';
	require_once 'A1XRXS_sys/xrxs_form/postulantes_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Estado cambiado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$query = "SELECT 
postulantes_listado.idPostulante,
postulantes_listado.Nombre,
postulantes_listado.ApellidoPat,
postulantes_listado.ApellidoMat, 
core_estados.Nombre AS Estado

FROM `postulantes_listado`
LEFT JOIN `core_estados`           ON core_estados.idEstado         = postulantes_listado.idEstado
WHERE idPostulante = ".$_GET['id'];
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
$rowdata = mysqli_fetch_assoc ($resultado);



?>
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Postulante', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat'], 'Editar Estado');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'postulantes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'postulantes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'postulantes_listado_estudios.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-graduation-cap" aria-hidden="true"></i>  Estudios</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'postulantes_listado_cursos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-graduation-cap" aria-hidden="true"></i>  Cursos</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_experiencia.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-industry" aria-hidden="true"></i>  Experiencia</a></li>
						<li class="active"><a href="<?php echo 'postulantes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_curriculum.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i>  Curriculum</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_otros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i>  Otros</a></li>
						
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
						<td><?php echo 'Postulante '.$rowdata['Estado']; ?></td>		
						<td>
							<div class="btn-group" style="width: 100px;" id="toggle_event_editing">		 
								<?php if ($rowlevel['level']>=2){?>    				
									<?php if ( $rowdata['Estado']=='Activo' ) {?>   
										<a class="btn btn-sm btn-default unlocked_inactive" href="<?php echo $new_location.'&id='.$rowdata['idPostulante'].'&estado='.simpleEncode(2, fecha_actual()) ; ?>">OFF</a>
										<a class="btn btn-sm btn-info locked_active" href="#">ON</a>
									<?php } else {?>
										<a class="btn btn-sm btn-info locked_active" href="#">OFF</a>
										<a class="btn btn-sm btn-default unlocked_inactive" href="<?php echo $new_location.'&id='.$rowdata['idPostulante'].'&estado='.simpleEncode(1, fecha_actual()) ; ?>">ON</a>
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
