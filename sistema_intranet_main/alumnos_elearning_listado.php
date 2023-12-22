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
$original = "alumnos_elearning_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){         $location .= "&Nombre=".$_GET['Nombre'];         $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){     $location .= "&idEstado=".$_GET['idEstado'];     $search .= "&idEstado=".$_GET['idEstado'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert_curso';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if (!empty($_POST['edit_curso'])){
	//Llamamos al formulario
	$form_trabajo= 'update_curso';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if (!empty($_GET['del_curso'])){
	//Llamamos al formulario
	$form_trabajo= 'del_curso';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
/*************************************************/
//formulario para crear
if (!empty($_POST['submit_unidad'])){
	//Llamamos al formulario
	$form_trabajo= 'insert_unidad';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if (!empty($_POST['edit_unidad'])){
	//Llamamos al formulario
	$form_trabajo= 'update_unidad';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if (!empty($_GET['del_Unidad'])){
	//Llamamos al formulario
	$form_trabajo= 'del_unidad';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
/*************************************************/
//formulario para crear
if (!empty($_POST['submit_contenido'])){
	//Llamamos al formulario
	$form_trabajo= 'insert_contenido';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if (!empty($_POST['edit_contenido'])){
	//Llamamos al formulario
	$form_trabajo= 'update_contenido';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if (!empty($_GET['del_Contenido'])){
	//Llamamos al formulario
	$form_trabajo= 'del_contenido';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
/*************************************************/
//formulario para crear
if (!empty($_POST['submit_file'])){
	//Llamamos al formulario
	$form_trabajo= 'new_file';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if (!empty($_GET['del_file'])){
	//Llamamos al formulario
	$form_trabajo= 'del_file';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
/*************************************************/
//formulario para crear
if (!empty($_POST['submit_quiz'])){
	//Llamamos al formulario
	$form_trabajo= 'insert_quiz';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if (!empty($_POST['edit_quiz'])){
	//Llamamos al formulario
	$form_trabajo= 'update_quiz';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if (!empty($_GET['del_quiz'])){
	//Llamamos al formulario
	$form_trabajo= 'del_quiz';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Elearning Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Elearning Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Elearning Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}

?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['editCuestionario'])){
// consulto los datos
$SIS_query = 'idQuiz';
$SIS_join  = '';
$SIS_where = 'idCuestionario ='.$_GET['editCuestionario'];
$rowdata = db_select_data (false, $SIS_query, 'alumnos_elearning_listado_unidades_cuestionarios', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Verifico el tipo de usuario que esta ingresando
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Cuestionario</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idQuiz)){      $x1  = $idQuiz;      }else{$x1  = $rowdata['idQuiz'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cuestionario','idQuiz', $x1, 2, 'idQuiz', 'Nombre', 'quiz_listado', $z, '', $dbConn);

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Inputs->form_input_hidden('idUnidad', $_GET['Unidad_ID'], 2);
				$Form_Inputs->form_input_hidden('idContenido', $_GET['Contenido_ID'], 2);
				$Form_Inputs->form_input_hidden('idCuestionario', $_GET['editCuestionario'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="edit_quiz">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['addCuestionario'])){
//Verifico el tipo de usuario que esta ingresando
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Cuestionario</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idQuiz)){      $x1  = $idQuiz;      }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cuestionario','idQuiz', $x1, 2, 'idQuiz', 'Nombre', 'quiz_listado', $z, '', $dbConn);

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Inputs->form_input_hidden('idUnidad', $_GET['Unidad_ID'], 2);
				$Form_Inputs->form_input_hidden('idContenido', $_GET['Contenido_ID'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_quiz">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['modBase'])){
// consulto los datos
$SIS_query = 'Nombre,Resumen, Objetivos,Requisitos,Descripcion, idSistema, idEstado';
$SIS_join  = '';
$SIS_where = 'idElearning ='.$_GET['id_curso'];
$rowdata = db_select_data (false, $SIS_query, 'alumnos_elearning_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Datos Básicos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;      }else{$x1  = $rowdata['Nombre'];}
				if(isset($Resumen)){     $x2  = $Resumen;     }else{$x2  = $rowdata['Resumen'];}
				if(isset($Objetivos)){   $x3  = $Objetivos;   }else{$x3  = $rowdata['Objetivos'];}
				if(isset($Requisitos)){  $x4  = $Requisitos;  }else{$x4  = $rowdata['Requisitos'];}
				if(isset($Descripcion)){ $x5  = $Descripcion; }else{$x5  = $rowdata['Descripcion'];}
				if(isset($idEstado)){    $x6  = $idEstado;    }else{$x6  = $rowdata['idEstado'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);

				$Form_Inputs->form_ckeditor('Resumen','Resumen', $x2, 1, 2);
				$Form_Inputs->form_ckeditor('Objetivos','Objetivos', $x3, 1, 2);
				$Form_Inputs->form_ckeditor('Requisitos','Requisitos', $x4, 1, 2);
				$Form_Inputs->form_ckeditor('Descripcion','Descripcion', $x5, 1, 2);
				$Form_Inputs->form_select('Estado','idEstado', $x6, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="edit_curso">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['addFile'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off" novalidate>

				<?php
				//Se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "mp3", "wav", "pdf", "txt", "rtf", "mp2", "mpeg", "mpg", "mov", "avi", "gz", "gzip", "7Z", "zip", "rar"');

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Inputs->form_input_hidden('idUnidad', $_GET['Unidad_ID'], 2);
				$Form_Inputs->form_input_hidden('idContenido', $_GET['Contenido_ID'], 2);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }elseif(!empty($_GET['addUnidad'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Nueva Unidad</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($N_Unidad)){   $x1  = $N_Unidad;   }else{$x1  = '';}
				if(isset($Nombre)){     $x2  = $Nombre;     }else{$x2  = '';}
				if(isset($Duracion)){   $x3  = $Duracion;   }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Numero de Unidad','N_Unidad', $x1, 2, 1, 50);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
				$Form_Inputs->form_select_n_auto('Dias de Duracion','Duracion', $x3, 2, 1, 50);

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_unidad">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }elseif(!empty($_GET['editUnidad'])){
//Se consulta
$SIS_query = 'N_Unidad, Nombre,Duracion';
$SIS_join  = '';
$SIS_where = 'idUnidad ='.$_GET['editUnidad'];
$rowdata = db_select_data (false, $SIS_query, 'alumnos_elearning_listado_unidades', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Pregunta</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($N_Unidad)){   $x1  = $N_Unidad;   }else{$x1  = $rowdata['N_Unidad'];}
				if(isset($Nombre)){     $x2  = $Nombre;     }else{$x2  = $rowdata['Nombre'];}
				if(isset($Duracion)){   $x3  = $Duracion;   }else{$x3  = $rowdata['Duracion'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Unidad','N_Unidad', $x1, 2, 1, 50);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
				$Form_Inputs->form_select_n_auto('Dias de Duracion','Duracion', $x3, 2, 1, 50);

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Inputs->form_input_hidden('idUnidad', $_GET['editUnidad'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="edit_unidad">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }elseif(!empty($_GET['addContenido'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Nuevo Contenido</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idUnidad)){   $x1  = $idUnidad;   }else{$x1  = '';}
				if(isset($Nombre)){     $x2  = $Nombre;     }else{$x2  = '';}
				if(isset($Contenido)){  $x3  = $Contenido;  }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('N° Unidad','idUnidad', $x1, 2, 'idUnidad', 'N_Unidad,Nombre', 'alumnos_elearning_listado_unidades', 'idElearning='.$_GET['id_curso'], '', $dbConn);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
				$Form_Inputs->form_ckeditor('Contenido','Contenido', $x3, 2, 2);

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_contenido">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }elseif(!empty($_GET['editContenido'])){
//se consulta
$SIS_query = 'idUnidad, Nombre,Contenido';
$SIS_join  = '';
$SIS_where = 'idContenido ='.$_GET['editContenido'];
$rowdata = db_select_data (false, $SIS_query, 'alumnos_elearning_listado_unidades_contenido', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Contenido</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idUnidad)){   $x1  = $idUnidad;   }else{$x1  = $rowdata['idUnidad'];}
				if(isset($Nombre)){     $x2  = $Nombre;     }else{$x2  = $rowdata['Nombre'];}
				if(isset($Contenido)){  $x3  = $Contenido;  }else{$x3  = $rowdata['Contenido'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('N° Unidad','idUnidad', $x1, 2, 'idUnidad', 'N_Unidad,Nombre', 'alumnos_elearning_listado_unidades', 'idElearning='.$_GET['id_curso'], '', $dbConn);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
				$Form_Inputs->form_ckeditor('Contenido','Contenido', $x3, 2, 2);

				$Form_Inputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Inputs->form_input_hidden('idContenido', $_GET['editContenido'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="edit_contenido">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }elseif(!empty($_GET['id_curso'])){
// consulto los datos
$SIS_query = '
alumnos_elearning_listado.Nombre,
alumnos_elearning_listado.Resumen,
alumnos_elearning_listado.Imagen,
alumnos_elearning_listado.LastUpdate,
alumnos_elearning_listado.Objetivos,
alumnos_elearning_listado.Requisitos,
alumnos_elearning_listado.Descripcion,
core_estados.Nombre AS Estado';
$SIS_join  = 'LEFT JOIN `core_estados` ON core_estados.idEstado = alumnos_elearning_listado.idEstado';
$SIS_where = 'alumnos_elearning_listado.idElearning ='.$_GET['id_curso'];
$rowdata = db_select_data (false, $SIS_query, 'alumnos_elearning_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

/*****************************************************/
// Se trae un listado con todos los elementos
$SIS_query = '
alumnos_elearning_listado_unidades.idUnidad AS Unidad_ID,
alumnos_elearning_listado_unidades.N_Unidad AS Unidad_Numero,
alumnos_elearning_listado_unidades.Nombre AS Unidad_Nombre,
alumnos_elearning_listado_unidades.Duracion AS Unidad_Duracion,
alumnos_elearning_listado_unidades_contenido.idContenido AS Contenido_ID,
alumnos_elearning_listado_unidades_contenido.Nombre AS Contenido_Nombre';
$SIS_join  = 'LEFT JOIN `alumnos_elearning_listado_unidades_contenido` ON alumnos_elearning_listado_unidades_contenido.idUnidad = alumnos_elearning_listado_unidades.idUnidad';
$SIS_where = 'alumnos_elearning_listado_unidades.idElearning ='.$_GET['id_curso'];
$SIS_order = 'alumnos_elearning_listado_unidades.N_Unidad ASC, alumnos_elearning_listado_unidades_contenido.Nombre ASC';
$arrContenidos = array();
$arrContenidos = db_select_array (false, $SIS_query, 'alumnos_elearning_listado_unidades', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrContenidos');

/*****************************************************/
// Se trae un listado con todos los elementos
$SIS_query = 'idDocumentacion, idUnidad, idElearning, idContenido, File';
$SIS_join  = '';
$SIS_where = 'idElearning ='.$_GET['id_curso'];
$SIS_order = 'File ASC';
$arrFiles = array();
$arrFiles = db_select_array (false, $SIS_query, 'alumnos_elearning_listado_unidades_documentacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrFiles');

/*****************************************************/
// Se trae un listado con todos los elementos
$SIS_query = '
alumnos_elearning_listado_unidades_cuestionarios.idCuestionario,
alumnos_elearning_listado_unidades_cuestionarios.idUnidad,
alumnos_elearning_listado_unidades_cuestionarios.idElearning,
alumnos_elearning_listado_unidades_cuestionarios.idContenido,
alumnos_elearning_listado_unidades_cuestionarios.idQuiz,
quiz_listado.Nombre AS Cuestionario';
$SIS_join  = 'LEFT JOIN `quiz_listado` ON quiz_listado.idQuiz = alumnos_elearning_listado_unidades_cuestionarios.idQuiz';
$SIS_where = 'alumnos_elearning_listado_unidades_cuestionarios.idElearning ='.$_GET['id_curso'];
$SIS_order = 'quiz_listado.Nombre ASC';
$arrCuestionarios = array();
$arrCuestionarios = db_select_array (false, $SIS_query, 'alumnos_elearning_listado_unidades_cuestionarios', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrCuestionarios');

/*****************************************************/
//calculo de los dias de duracion
$Dias_Duracion = 0;
filtrar($arrContenidos, 'Unidad_Numero');
foreach($arrContenidos as $categoria=>$permisos){
	$Dias_Duracion = $Dias_Duracion + $permisos[0]['Unidad_Duracion'];
}

?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Datos Básicos</h5>
				<div class="toolbar">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&modBase=true' ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a>
				</div>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<tr>
							<td class="meta-head">Nombre Elearning</td>
							<td><?php echo $rowdata['Nombre']; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Estado</td>
							<td><?php echo $rowdata['Estado']; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Dias de Duracion</td>
							<td><?php echo $Dias_Duracion.' dias'; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Resumen</td>
							<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Resumen']; ?></span></td>
						</tr>
						<tr>
							<td class="meta-head">Ultima Actualizacion</td>
							<td><?php echo fecha_estandar($rowdata['LastUpdate']); ?></td>
						</tr>
						<tr>
							<td class="meta-head">Objetivos</td>
							<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Objetivos']; ?></span></td>
						</tr>
						<tr>
							<td class="meta-head">Requisitos</td>
							<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Requisitos']; ?></span></td>
						</tr>
						<tr>
							<td class="meta-head">Descripcion</td>
							<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Descripcion']; ?></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Contenido</h5>
				<div class="toolbar">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&addUnidad=true' ?>" class="btn btn-xs btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Nueva Unidad</a>
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&addContenido=true' ?>" class="btn btn-xs btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo Contenido</a>
				</div>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<tbody role="alert" aria-live="polite" aria-relevant="all">

						<?php
						//filtrar($arrContenidos, 'Unidad_Numero');
						foreach($arrContenidos as $categoria=>$permisos){ ?>
							<tr class="odd" >
								<td style="background-color:#DDD"><strong>Unidad <?php echo $categoria; ?></strong> - <?php echo $permisos[0]['Unidad_Nombre'].' ('.$permisos[0]['Unidad_Duracion'].' dias de duracion)'; ?></td>
								<td style="background-color:#DDD" width="10" >
									<div class="btn-group" style="width: 105px;" >
										<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&editUnidad='.$permisos[0]['Unidad_ID']; ?>" title="Editar Unidad" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<?php
										$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_Unidad='.simpleEncode($permisos[0]['Unidad_ID'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar la unidad '.$categoria.'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Pregunta" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</div>
								</td>
							</tr>
							<?php foreach ($permisos as $preg) {
								if(isset($preg['Contenido_Nombre'])&&$preg['Contenido_Nombre']!=''){ ?>
									<tr class="item-row linea_punteada">
										<td class="item-name">
											<span style="word-wrap: break-word;white-space: initial;"><?php echo $preg['Contenido_Nombre']; ?></span>
											<?php if($arrFiles!=false && !empty($arrFiles) && $arrFiles!=''){
												//verifico que existan archivos en esta unidad
												$x_n_arch = 0;
												foreach ($arrFiles as $file) {
													if(isset($preg['Unidad_ID'])&&$preg['Unidad_ID']==$file['idUnidad']&&isset($preg['Contenido_ID'])&&$preg['Contenido_ID']==$file['idContenido']){
														$x_n_arch++;
													}
												}
												//si hay archivos se imprime
												if($x_n_arch!=0){
												?>
													<div class="clearfix"></div>
													<hr>
													<strong>Archivos adjuntos del contenido <?php echo $preg['Contenido_Nombre']; ?>:</strong><br/>
													<?php foreach ($arrFiles as $file) {
														//verifico que el archivo sea del contenido
														if(isset($preg['Unidad_ID'])&&$preg['Unidad_ID']==$file['idUnidad']&&isset($preg['Contenido_ID'])&&$preg['Contenido_ID']==$file['idContenido']){ ?>
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:2px;">
																<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
																	<?php
																	$f_file = str_replace('elearning_files_'.$file['idContenido'].'_','',$file['File']);
																	echo $f_file;
																	?>
																</div>
																<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
																	<div class="btn-group pull-right" style="width: 70px;" >
																		<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($file['File'], fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
																		<?php
																		$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_file='.simpleEncode($file['idDocumentacion'], fecha_actual());
																		$dialogo   = '¿Realmente deseas eliminar '.str_replace('"','',$f_file).'?'; ?>
																		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
																	</div>
																</div>
															</div>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
											<?php if($arrCuestionarios!=false && !empty($arrCuestionarios) && $arrCuestionarios!=''){
												//verifico que existan archivos en esta unidad
												$x_n_Cuest = 0;
												foreach ($arrCuestionarios as $file) {
													if(isset($preg['Unidad_ID'])&&$preg['Unidad_ID']==$file['idUnidad']&&isset($preg['Contenido_ID'])&&$preg['Contenido_ID']==$file['idContenido']){
														$x_n_Cuest++;
													}
												}
												//si hay archivos se imprime
												if($x_n_Cuest!=0){
												 ?>
													<div class="clearfix"></div>
													<hr>
													<strong>Cuestionarios adjuntos del contenido <?php echo $preg['Contenido_Nombre']; ?>:</strong><br/>
													<?php foreach ($arrCuestionarios as $file) {
														//verifico que el archivo sea del contenido
														if(isset($preg['Unidad_ID'])&&$preg['Unidad_ID']==$file['idUnidad']&&isset($preg['Contenido_ID'])&&$preg['Contenido_ID']==$file['idContenido']){ ?>
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:2px;">
																<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10"><?php echo $file['Cuestionario'];  ?></div>
																<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
																	<div class="btn-group pull-right" style="width: 105px;" >
																		<a href="<?php echo 'view_quiz.php?view='.simpleEncode($file['idQuiz'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
																		<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&Unidad_ID='.$preg['Unidad_ID'].'&Contenido_ID='.$preg['Contenido_ID'].'&editCuestionario='.$file['idCuestionario']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
																		<?php
																		$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_quiz='.simpleEncode($file['idCuestionario'], fecha_actual());
																		$dialogo   = '¿Realmente deseas eliminar el Cuestionario '.$file['Cuestionario'].'?'; ?>
																		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Cuestionario" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
																	</div>
																</div>
															</div>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>
										<td width="10" >
											<div class="btn-group" style="width: 140px;" >
												<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&Unidad_ID='.$preg['Unidad_ID'].'&editContenido='.$preg['Contenido_ID']; ?>" title="Editar Contenido" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
												<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&Unidad_ID='.$preg['Unidad_ID'].'&Contenido_ID='.$preg['Contenido_ID'].'&addFile=true'; ?>" title="Agregar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-file-archive-o" aria-hidden="true"></i></a>
												<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&Unidad_ID='.$preg['Unidad_ID'].'&Contenido_ID='.$preg['Contenido_ID'].'&addCuestionario=true'; ?>" title="Agregar Cuestionario" class="btn btn-primary btn-sm tooltip"><i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
												<?php
												$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_Contenido='.simpleEncode($preg['Contenido_ID'], fecha_actual());
												$dialogo   = '¿Realmente deseas eliminar '.str_replace('"','',$preg['Contenido_Nombre']).'?'; ?>
												<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Pregunta" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</div>
										</td>
									</tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Elearning</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;      }else{$x1  = '';}
				if(isset($Unidades)){    $x2  = $Unidades;    }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_select_n_auto('Numero de Unidades','Unidades', $x2, 2, 1, 50);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
/**********************************************************/
//paginador de resultados
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'alumnos_elearning_listado.Nombre ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'alumnos_elearning_listado.Nombre DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':    $order_by = 'core_estados.Nombre ASC ';                  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'core_estados.Nombre DESC ';                 $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;

		default: $order_by = 'alumnos_elearning_listado.idEstado ASC, alumnos_elearning_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'alumnos_elearning_listado.idEstado ASC, alumnos_elearning_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "alumnos_elearning_listado.idElearning!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){ $SIS_where .= " AND alumnos_elearning_listado.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){    $SIS_where .= " AND alumnos_elearning_listado.idEstado=".$_GET['idEstado'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idElearning', 'alumnos_elearning_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
alumnos_elearning_listado.idElearning,
alumnos_elearning_listado.Nombre,
core_sistemas.Nombre AS sistema,
core_estados.Nombre AS Estado,
alumnos_elearning_listado.idEstado';
$SIS_join  = '
LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema  = alumnos_elearning_listado.idSistema
LEFT JOIN `core_estados`    ON core_estados.idEstado    = alumnos_elearning_listado.idEstado';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrCurso = array();
$arrCurso = db_select_array (false, $SIS_query, 'alumnos_elearning_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrCurso');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Elearning</a><?php } ?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;     }else{$x1  = '';}
				if(isset($idEstado)){    $x2  = $idEstado;   }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 1);
				$Form_Inputs->form_select('Estado','idEstado', $x2, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);

				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>

			</form>
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Elearnings</h5>
			<div class="toolbar">
				<?php
				//Se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Nombre Elearning</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrCurso as $curso) { ?>
						<tr class="odd">
							<td><?php echo $curso['Nombre']; ?></td>
							<td><label class="label <?php if(isset($curso['idEstado'])&&$curso['idEstado']==1){echo 'label-success';}else{echo 'label-danger';} ?>"><?php echo $curso['Estado']; ?></label></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $curso['sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_elearning.php?view='.simpleEncode($curso['idElearning'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id_curso='.$curso['idElearning']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del_curso='.simpleEncode($curso['idElearning'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar el elearning '.$curso['Nombre'].'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									<?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="pagrow">
			<?php
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
