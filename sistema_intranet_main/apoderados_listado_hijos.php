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
$original = "apoderados_listado.php";
$location = $original;
$new_location = "apoderados_listado_hijos.php";
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
	//se agregan ubicaciones
	$location = $new_location;
	$location.= '&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado_hijos.php';
}
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//se agregan ubicaciones
	$location = $new_location;
	$location.= '&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado_hijos.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//se agregan ubicaciones
	$location = $new_location;
	$location.= '&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado_hijos.php';
}
//se borra un dato
if (!empty($_GET['del_img'])){
	//Nueva ubicacion
	$location = $new_location;
	$location.= '&id='.$_GET['id'];
	$location.= '&edit='.$_GET['edit'];
	//Llamamos al formulario
	$form_trabajo= 'del_img';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado_hijos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Hijo Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Hijo Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Hijo Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['edit'])){
	// consulto los datos
	$SIS_query = 'Nombre,ApellidoPat, ApellidoMat, idSexo, FNacimiento, Direccion_img, idPlan, idColegio';
	$SIS_join  = '';
	$SIS_where = 'idHijos = '.$_GET['edit'];
	$rowdata = db_select_data (false, $SIS_query, 'apoderados_listado_hijos', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Editar Hijo</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idPlan)){              $x1  = $idPlan;               }else{$x1  = $rowdata['idPlan'];}
					if(isset($Nombre)){              $x2  = $Nombre;               }else{$x2  = $rowdata['Nombre'];}
					if(isset($ApellidoPat)){         $x3  = $ApellidoPat;          }else{$x3  = $rowdata['ApellidoPat'];}
					if(isset($ApellidoMat)){         $x4  = $ApellidoMat;          }else{$x4  = $rowdata['ApellidoMat'];}
					if(isset($idSexo)){              $x5  = $idSexo;               }else{$x5  = $rowdata['idSexo'];}
					if(isset($FNacimiento)){         $x6  = $FNacimiento;          }else{$x6  = $rowdata['FNacimiento'];}
					if(isset($idColegio)){           $x7  = $idColegio;            }else{$x7  = $rowdata['idColegio'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select('Plan','idPlan', $x1, 2, 'idPlan', 'Nombre', 'sistema_planes', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
					$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x3, 2);
					$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x4, 1);
					$Form_Inputs->form_select('Sexo','idSexo', $x5, 1, 'idSexo', 'Nombre', 'core_sexo', 0, '', $dbConn);
					$Form_Inputs->form_date('FNacimiento','FNacimiento', $x6, 1);
					$Form_Inputs->form_select_filter('Colegio','idColegio', $x7, 2, 'idColegio', 'Nombre', 'colegios_listado', 'idEstado=1', '',$dbConn);

					if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){ ?>

						<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 fcenter">
						<img src="upload/<?php echo $rowdata['Direccion_img'] ?>" width="100%" >
						</div>
						<a href="<?php echo $new_location.'&id='.$_GET['id'].'&del_img='.$_GET['edit'].'&edit='.$_GET['edit']; ?>" class="btn btn-danger pull-right margin_form_btn" style="margin-top:10px;margin-bottom:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Imagen</a>
						<div class="clearfix"></div>

					<?php
					}else{
						$Form_Inputs->form_multiple_upload('Seleccionar foto','Direccion_img', 1, '"jpg", "png", "gif", "jpeg"');

					}

					$Form_Inputs->form_input_hidden('idHijos', $_GET['edit'], 2);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
						<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['new'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Crear Hijo</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idPlan)){              $x1  = $idPlan;               }else{$x1  = '';}
					if(isset($Nombre)){              $x2  = $Nombre;               }else{$x2  = '';}
					if(isset($ApellidoPat)){         $x3  = $ApellidoPat;          }else{$x3  = '';}
					if(isset($ApellidoMat)){         $x4  = $ApellidoMat;          }else{$x4  = '';}
					if(isset($idSexo)){              $x5  = $idSexo;               }else{$x5  = '';}
					if(isset($FNacimiento)){         $x6  = $FNacimiento;          }else{$x6  = '';}
					if(isset($idColegio)){           $x7  = $idColegio;            }else{$x7  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select('Plan','idPlan', $x1, 2, 'idPlan', 'Nombre', 'sistema_planes', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
					$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x3, 2);
					$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x4, 1);
					$Form_Inputs->form_select('Sexo','idSexo', $x5, 1, 'idSexo', 'Nombre', 'core_sexo', 0, '', $dbConn);
					$Form_Inputs->form_date('FNacimiento','FNacimiento', $x6, 1);
					$Form_Inputs->form_select_filter('Colegio','idColegio', $x7, 2, 'idColegio', 'Nombre', 'colegios_listado', 'idEstado=1', '',$dbConn);
					$Form_Inputs->form_multiple_upload('Seleccionar foto','Direccion_img', 1, '"jpg", "png", "gif", "jpeg"');

					$Form_Inputs->form_input_hidden('idApoderado', $_GET['id'], 2);
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
	// consulto los datos
	$SIS_query = 'Nombre,ApellidoPat, ApellidoMat, idOpciones_1,idOpciones_2';
	$SIS_join  = '';
	$SIS_where = 'idApoderado = '.$_GET['id'];
	$rowdata = db_select_data (false, $SIS_query, 'apoderados_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	apoderados_listado_hijos.idHijos,
	apoderados_listado_hijos.Nombre,
	apoderados_listado_hijos.ApellidoPat,
	apoderados_listado_hijos.ApellidoMat,
	apoderados_listado_hijos.FNacimiento,
	core_sexo.Nombre AS Sexo,
	sistema_planes.Nombre AS Plan_Nombre,
	sistema_planes.Valor AS Plan_Valor,
	colegios_listado.Nombre AS Colegio';
	$SIS_join  = '
	LEFT JOIN `core_sexo`          ON core_sexo.idSexo              = apoderados_listado_hijos.idSexo
	LEFT JOIN `sistema_planes`     ON sistema_planes.idPlan         = apoderados_listado_hijos.idPlan
	LEFT JOIN `colegios_listado`   ON colegios_listado.idColegio    = apoderados_listado_hijos.idColegio';
	$SIS_where = 'idApoderado = '.$_GET['id'];
	$SIS_order = 'idHijos ASC';
	$arrCargas = array();
	$arrCargas = db_select_array (false, $SIS_query, 'apoderados_listado_hijos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrCargas');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Apoderado', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat'], 'Hijos'); ?>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8">
			<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Hijo</a><?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<ul class="nav nav-tabs pull-right">
					<li class=""><a href="<?php echo 'apoderados_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
					<li class=""><a href="<?php echo 'apoderados_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Básicos</a></li>
					<li class=""><a href="<?php echo 'apoderados_listado_ubicacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> Ubicación</a></li>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li class=""><a href="<?php echo 'apoderados_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
							<?php
							//Si se utiliza la APP
							if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>
								<li class=""><a href="<?php echo 'apoderados_listado_subcuentas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sitemap" aria-hidden="true"></i> Subcuentas</a></li>
							<?php } ?>
							<?php
							//Si se utiliza subcuentas
							if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
								<li class=""><a href="<?php echo 'apoderados_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
							<?php } ?>
							<li class="active"><a href="<?php echo 'apoderados_listado_hijos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-child" aria-hidden="true"></i> Hijos</a></li>
							<li class=""><a href="<?php echo 'apoderados_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
							<li class=""><a href="<?php echo 'apoderados_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contrato</a></li>
							<li class=""><a href="<?php echo 'apoderados_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</a></li>
							<li class=""><a href="<?php echo 'apoderados_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>

						</ul>
					</li>
				</ul>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Plan</th>
							<th width="120">Valor</th>
							<th width="120">Colegio</th>
							<th width="120">Fecha Nacimiento</th>
							<th width="120">Sexo</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrCargas as $carga) { ?>
							<tr class="odd">
								<td><?php echo $carga['Nombre'].' '.$carga['ApellidoPat'].' '.$carga['ApellidoMat']; ?></td>
								<td><?php echo $carga['Plan_Nombre']; ?></td>
								<td align="right"><?php echo valores($carga['Plan_Valor'], 0); ?></td>
								<td><?php echo $carga['Colegio']; ?></td>
								<td><?php echo fecha_estandar($carga['FNacimiento']); ?></td>
								<td><?php echo $carga['Sexo']; ?></td>
								<td>
									<div class="btn-group" style="width: 70px;" >
										<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&edit='.$carga['idHijos']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
										<?php if ($rowlevel['level']>=4){
											$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.simpleEncode($carga['idHijos'], fecha_actual());
											$dialogo   = '¿Realmente deseas eliminar la carga '.$carga['Nombre'].' '.$carga['ApellidoPat'].'?'; ?>
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
