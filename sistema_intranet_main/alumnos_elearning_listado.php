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
$original = "alumnos_elearning_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){         $location .= "&Nombre=".$_GET['Nombre'];         $search .= "&Nombre=".$_GET['Nombre'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert_curso';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if ( !empty($_POST['edit_curso']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update_curso';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_curso']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_curso';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';	
}
/*************************************************/
//formulario para crear
if ( !empty($_POST['submit_unidad']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert_unidad';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if ( !empty($_POST['edit_unidad']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update_unidad';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_Unidad']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_unidad';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';	
}
/*************************************************/
//formulario para crear
if ( !empty($_POST['submit_contenido']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert_contenido';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//formulario para crear
if ( !empty($_POST['edit_contenido']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update_contenido';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_Contenido']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_contenido';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';	
}
/*************************************************/
//formulario para crear
if ( !empty($_POST['submit_file']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_file';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_elearning_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_file';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Elearning Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Elearning Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Elearning borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['modBase']) ) { 	
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, Resumen, Objetivos,Requisitos,Descripcion, idSistema

FROM `alumnos_elearning_listado`
WHERE idElearning = {$_GET['id_curso']}";
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

 <div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Datos Basicos</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;      }else{$x1  = $rowdata['Nombre'];}
				if(isset($Resumen)) {     $x2  = $Resumen;     }else{$x2  = $rowdata['Resumen'];}
				if(isset($Objetivos)) {   $x3  = $Objetivos;   }else{$x3  = $rowdata['Objetivos'];}
				if(isset($Requisitos)) {  $x4  = $Requisitos;  }else{$x4  = $rowdata['Requisitos'];}
				if(isset($Descripcion)) { $x5  = $Descripcion; }else{$x5  = $rowdata['Descripcion'];}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
					
				$Form_Imputs->form_ckeditor('Resumen','Resumen', $x2, 1, 2);
				$Form_Imputs->form_ckeditor('Objetivos','Objetivos', $x3, 1, 2);
				$Form_Imputs->form_ckeditor('Requisitos','Requisitos', $x4, 1, 2);
				$Form_Imputs->form_ckeditor('Descripcion','Descripcion', $x5, 1, 2);
				
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);	
				$Form_Imputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="edit_curso">	
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?> 
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addFile']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data">
			
				<?php           
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"');
					
				$Form_Imputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Imputs->form_input_hidden('idUnidad', $_GET['Unidad_ID'], 2);
				$Form_Imputs->form_input_hidden('idContenido', $_GET['Contenido_ID'], 2);
				
				?> 

				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file"> 
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>              
		</div>
	</div>
</div>	 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['addUnidad']) ) { ?>
	
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nueva Unidad</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($N_Unidad)) {   $x1  = $N_Unidad;   }else{$x1  = '';}
				if(isset($Nombre)) {     $x2  = $Nombre;     }else{$x2  = '';}
				if(isset($Duracion)) {   $x3  = $Duracion;   }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_n_auto('Numero de Unidad','N_Unidad', $x1, 2, 1, 50);
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
				$Form_Imputs->form_select_n_auto('Dias de Duracion','Duracion', $x3, 2, 1, 50);
				
				$Form_Imputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				?>	
								
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_unidad">	
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?> 
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['editUnidad']) ) { 
$query = "SELECT N_Unidad, Nombre, Duracion
FROM `alumnos_elearning_listado_unidades`
WHERE idUnidad = {$_GET['editUnidad']}";
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

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Pregunta</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($N_Unidad)) {   $x1  = $N_Unidad;   }else{$x1  = $rowdata['N_Unidad'];}
				if(isset($Nombre)) {     $x2  = $Nombre;     }else{$x2  = $rowdata['Nombre'];}
				if(isset($Duracion)) {   $x3  = $Duracion;   }else{$x3  = $rowdata['Duracion'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_n_auto('Unidad','N_Unidad', $x1, 2, 1, 50);
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
				$Form_Imputs->form_select_n_auto('Dias de Duracion','Duracion', $x3, 2, 1, 50);
				
				$Form_Imputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Imputs->form_input_hidden('idUnidad', $_GET['editUnidad'], 2);
				?>
								
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="edit_unidad">	
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?> 
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['addContenido']) ) { ?>
	
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nuevo Contenido</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idUnidad)) {   $x1  = $idUnidad;   }else{$x1  = '';}
				if(isset($Nombre)) {     $x2  = $Nombre;     }else{$x2  = '';}
				if(isset($Contenido)) {  $x3  = $Contenido;  }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('N° Unidad','idUnidad', $x1, 2, 'idUnidad', 'N_Unidad,Nombre', 'alumnos_elearning_listado_unidades', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
				$Form_Imputs->form_ckeditor('Contenido','Contenido', $x3, 2, 2);
				
				
				$Form_Imputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				?>	
								
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_contenido">	
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?> 
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['editContenido']) ) { 
$query = "SELECT idUnidad, Nombre, Contenido
FROM `alumnos_elearning_listado_unidades_contenido`
WHERE idContenido = {$_GET['editContenido']}";
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

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Pregunta</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idUnidad)) {   $x1  = $idUnidad;   }else{$x1  = $rowdata['idUnidad'];}
				if(isset($Nombre)) {     $x2  = $Nombre;     }else{$x2  = $rowdata['Nombre'];}
				if(isset($Contenido)) {  $x3  = $Contenido;  }else{$x3  = $rowdata['Contenido'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('N° Unidad','idUnidad', $x1, 2, 'idUnidad', 'N_Unidad,Nombre', 'alumnos_elearning_listado_unidades', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
				$Form_Imputs->form_ckeditor('Contenido','Contenido', $x3, 2, 2);
				
				$Form_Imputs->form_input_hidden('idElearning', $_GET['id_curso'], 2);
				$Form_Imputs->form_input_hidden('idContenido', $_GET['editContenido'], 2);
				?>
								
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="edit_contenido">	
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?> 
		</div>
	</div>
</div>		 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['id_curso']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
alumnos_elearning_listado.Nombre, 
alumnos_elearning_listado.Resumen, 
alumnos_elearning_listado.Imagen,
alumnos_elearning_listado.LastUpdate,
alumnos_elearning_listado.Objetivos,
alumnos_elearning_listado.Requisitos,
alumnos_elearning_listado.Descripcion

FROM `alumnos_elearning_listado`
WHERE alumnos_elearning_listado.idElearning = {$_GET['id_curso']}";
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

// Se trae un listado con todos los usuarios
$arrContenidos = array();
$query = "SELECT
alumnos_elearning_listado_unidades.idUnidad AS Unidad_ID, 
alumnos_elearning_listado_unidades.N_Unidad AS Unidad_Numero, 
alumnos_elearning_listado_unidades.Nombre AS Unidad_Nombre,
alumnos_elearning_listado_unidades.Duracion AS Unidad_Duracion,
alumnos_elearning_listado_unidades_contenido.idContenido AS Contenido_ID,
alumnos_elearning_listado_unidades_contenido.Nombre AS Contenido_Nombre

FROM `alumnos_elearning_listado_unidades`
LEFT JOIN `alumnos_elearning_listado_unidades_contenido` ON alumnos_elearning_listado_unidades_contenido.idUnidad = alumnos_elearning_listado_unidades.idUnidad
WHERE alumnos_elearning_listado_unidades.idElearning = {$_GET['id_curso']}
ORDER BY alumnos_elearning_listado_unidades.N_Unidad ASC ";
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
array_push( $arrContenidos,$row );
}

// Se trae un listado con todos los usuarios
$arrFiles = array();
$query = "SELECT idDocumentacion, idUnidad, idElearning, idContenido, File
FROM `alumnos_elearning_listado_unidades_documentacion`
WHERE idElearning = {$_GET['id_curso']}
ORDER BY File ASC ";
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
array_push( $arrFiles,$row );
}

$Dias_Duracion = 0;
filtrar($arrContenidos, 'Unidad_Numero');  
foreach($arrContenidos as $categoria=>$permisos){
	$Dias_Duracion = $Dias_Duracion + $permisos[0]['Unidad_Duracion'];
}

								
								
?>
 
<div class="row">
	<div class="col-sm-12">
		<div class="box">	
			<header>		
				<div class="icons"><i class="fa fa-table"></i></div><h5>Datos Basicos</h5>
				<div class="toolbar">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&modBase=true' ?>" class="btn btn-xs btn-primary">Modificar</a>
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
	<div class="col-sm-12">
		<div class="box">	
			<header>		
				<div class="icons"><i class="fa fa-table"></i></div><h5>Contenido</h5>
				<div class="toolbar">
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&addUnidad=true' ?>" class="btn btn-xs btn-primary">Agregar Nueva Unidad</a>
					<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&addContenido=true' ?>" class="btn btn-xs btn-primary">Agregar Nuevo Contenido</a>
				</div>
			</header>
			<div class="table-responsive">    
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						
						<?php 
						//filtrar($arrContenidos, 'Unidad_Numero');  
						foreach($arrContenidos as $categoria=>$permisos){?>
							<tr class="odd" >
								<td style="background-color:#DDD"><strong>Unidad <?php echo $categoria; ?></strong> - <?php echo $permisos[0]['Unidad_Nombre'].' ('.$permisos[0]['Unidad_Duracion'].' dias de duracion)'; ?></td>
								<td style="background-color:#DDD" width="10" >
									<div class="btn-group" style="width: 105px;" >
										<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&editUnidad='.$permisos[0]['Unidad_ID']; ?>" title="Editar Unidad" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
										<?php 
										$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_Unidad='.$permisos[0]['Unidad_ID'];
										$dialogo   = '¿Realmente deseas eliminar la unidad '.$categoria.'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Pregunta" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
									</div>
								</td>
							</tr>
							<?php foreach ($permisos as $preg) { 
								if(isset($preg['Contenido_Nombre'])&&$preg['Contenido_Nombre']!=''){?>
									<tr class="item-row linea_punteada">
										<td class="item-name">
											<span style="word-wrap: break-word;white-space: initial;"><?php echo $preg['Contenido_Nombre']; ?></span>	
											<hr>	
											<?php foreach ($arrFiles as $file) {
												//verifico que el archivo sea del contenido
												if(isset($preg['Unidad_ID'])&&$preg['Unidad_ID']==$file['idUnidad']&&isset($preg['Contenido_ID'])&&$preg['Contenido_ID']==$file['idContenido']){ ?>
													<div class="col-sm-12">
														<div class="col-sm-11">
															<?php 
															$f_file = str_replace('elearning_files_'.$file['idContenido'].'_','',$file['File']);
															echo $f_file; 
															?>
														</div>
														<div class="col-sm-1">
															<div class="btn-group" style="width: 70px;" >
																<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$file['File']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
																<?php 
																$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_file='.$file['idDocumentacion'];
																$dialogo   = '¿Realmente deseas eliminar '.str_replace('"','',$f_file).'?';?>
																<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Pregunta" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
															</div>
														</div>
													</div>
												<?php } ?>
											<?php } ?>
										
										</td>			
										<td width="10" >
											<div class="btn-group" style="width: 105px;" >
												<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&Unidad_ID='.$preg['Unidad_ID'].'&editContenido='.$preg['Contenido_ID']; ?>" title="Editar Contenido" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
												<a href="<?php echo $location.'&id_curso='.$_GET['id_curso'].'&Unidad_ID='.$preg['Unidad_ID'].'&Contenido_ID='.$preg['Contenido_ID'].'&addFile=true'; ?>" title="Agregar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-file-archive-o"></i></a>
												<?php 
												$ubicacion = $location.'&id_curso='.$_GET['id_curso'].'&del_Contenido='.$preg['Contenido_ID'];
												$dialogo   = '¿Realmente deseas eliminar '.str_replace('"','',$preg['Contenido_Nombre']).'?';?>
												<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Pregunta" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
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

<?php require_once '../LIBS_js/modal/modal.php';?> 
 
 
 
 
 


<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Elearning</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;      }else{$x1  = '';}
				if(isset($Unidades)) {    $x2  = $Unidades;    }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select_n_auto('Numero de Unidades','Unidades', $x2, 2, 1, 50);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'ORDER BY alumnos_elearning_listado.Nombre ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'ORDER BY alumnos_elearning_listado.Nombre DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		
		default: $order_by = 'ORDER BY alumnos_elearning_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY alumnos_elearning_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE alumnos_elearning_listado.idElearning!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){        $z .= " AND alumnos_elearning_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idElearning FROM `alumnos_elearning_listado` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrCurso = array();
$query = "SELECT 
alumnos_elearning_listado.idElearning,
alumnos_elearning_listado.Nombre
FROM `alumnos_elearning_listado`
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrCurso,$row );
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Elearning</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;     }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                       
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Elearnings</h5>
			<div class="toolbar">
				<?php 
				//se llama al paginador
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
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrCurso as $curso) { ?>
					<tr class="odd">
						<td><?php echo $curso['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_elearning.php?view='.$curso['idElearning']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id_curso='.$curso['idElearning']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del_curso='.$curso['idElearning'];
									$dialogo   = '¿Realmente deseas eliminar el elearning '.$curso['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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

<?php require_once '../LIBS_js/modal/modal.php';?>
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
