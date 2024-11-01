<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
//Cargamos la ubicacion original
$original = "alumnos_cursos.php";
$location = $original;
$new_location = "alumnos_cursos_elearning.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Agregamos nuevas direcciones
	$location = $new_location;
	$location.= '&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'ele_add';
	require_once 'A1XRXS_sys/xrxs_form/alumnos_cursos.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Nueva ubicacion
	$location = $new_location;
	$location.= '&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'ele_del';
	require_once 'A1XRXS_sys/xrxs_form/alumnos_cursos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Elearning agregado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Elearning eliminado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//filtro para el Elearning
$z = "idEstado=1 AND idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Elearning</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idElearning)){     $x1  = $idElearning;    }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Elearning','idElearning', $x1, 2, 'idElearning', 'Nombre', 'alumnos_elearning_listado',$z, '', $dbConn);

				$Form_Inputs->form_input_hidden('idCurso', $_GET['id'], 2);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
/*******************************************************/
// consulto los datos
$SIS_query = 'Nombre';
$SIS_join  = '';
$SIS_where = 'idCurso = '.$_GET['id'];
$rowData = db_select_data (false, $SIS_query, 'alumnos_cursos', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowData');

/*******************************************************/
// consulto los datos
$SIS_query = '
alumnos_cursos_elearning.idRelacionados,
alumnos_elearning_listado.Nombre AS NombreElearning';
$SIS_join  = 'LEFT JOIN `alumnos_elearning_listado` ON alumnos_elearning_listado.idElearning = alumnos_cursos_elearning.idElearning';
$SIS_where = 'alumnos_cursos_elearning.idCurso = '.$_GET['id'];
$SIS_order = 'alumnos_elearning_listado.Nombre ASC';
$arrCursos = array();
$arrCursos = db_select_array (false, $SIS_query, 'alumnos_cursos_elearning', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrCursos');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Asignatura', $rowData['Nombre'], 'Editar Elearning Asignados'); ?>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8">
		<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Elearning</a><?php } ?>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'alumnos_cursos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'alumnos_cursos_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Básicos</a></li>
				<li class=""><a href="<?php echo 'alumnos_cursos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class="active"><a href="<?php echo 'alumnos_cursos_elearning.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Elearning Asignados</a></li>
						<li class=""><a href="<?php echo 'alumnos_cursos_documentacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Documentos Relacionados</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Elearning</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrCursos as $curso){ ?>
						<tr>
							<td><?php echo $curso['NombreElearning']; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.simpleEncode($curso['idRelacionados'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar el elearning '.$curso['NombreElearning'].'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									<?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
