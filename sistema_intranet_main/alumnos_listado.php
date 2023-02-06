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
//Cargamos la ubicacion original
$original = "alumnos_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCurso']) && $_GET['idCurso']!=''){          $location .= "&idCurso=".$_GET['idCurso'];            $search .= "&idCurso=".$_GET['idCurso'];}
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){            $location .= "&Nombre=".$_GET['Nombre'];              $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['ApellidoPat']) && $_GET['ApellidoPat']!=''){  $location .= "&ApellidoPat=".$_GET['ApellidoPat'];    $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['ApellidoMat']) && $_GET['ApellidoMat']!=''){  $location .= "&ApellidoMat=".$_GET['ApellidoMat'];    $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Rut']) && $_GET['Rut']!=''){                  $location .= "&Rut=".$_GET['Rut'];                    $search .= "&Rut=".$_GET['Rut'];}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento']!=''){  $location .= "&fNacimiento=".$_GET['fNacimiento'];    $search .= "&fNacimiento=".$_GET['fNacimiento'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){        $location .= "&idCiudad=".$_GET['idCiudad'];          $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){        $location .= "&idComuna=".$_GET['idComuna'];          $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){      $location .= "&Direccion=".$_GET['Direccion'];        $search .= "&Direccion=".$_GET['Direccion'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_listado.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Alumno creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Alumno editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Alumno borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT  
alumnos_listado.email, 
alumnos_listado.Nombre,
alumnos_listado.ApellidoPat, 
alumnos_listado.ApellidoMat, 
alumnos_listado.Rut, 
alumnos_listado.fNacimiento, 
alumnos_listado.Direccion, 
alumnos_listado.Fono1, 
alumnos_listado.Fono2, 
alumnos_listado.Fax,
alumnos_listado.PersonaContacto,
alumnos_listado.PersonaContacto_Fono,
alumnos_listado.PersonaContacto_email,
alumnos_listado.Web,
alumnos_listado.Direccion_img,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
cursos_listado.Nombre AS Curso

FROM `alumnos_listado`
LEFT JOIN `core_estados`              ON core_estados.idEstado                    = alumnos_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`     ON core_ubicacion_ciudad.idCiudad           = alumnos_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`    ON core_ubicacion_comunas.idComuna          = alumnos_listado.idComuna
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema                  = alumnos_listado.idSistema
LEFT JOIN `cursos_listado`            ON cursos_listado.idCurso                   = alumnos_listado.idCurso
WHERE alumnos_listado.idAlumno = ".$_GET['id'];
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Alumno', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'], 'Resumen');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'alumnos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'alumnos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'alumnos_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'alumnos_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Persona Contacto</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_datos_foto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="tab-content">
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/usr.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h2 class="text-primary">Datos Basicos</h2>
						<p class="text-muted">
							<strong>Curso : </strong><?php echo $rowdata['Curso']; ?><br/>
							<strong>Nombre: </strong><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?><br/>
							<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
							<strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
							<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
							<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
							<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
						</p>

						<h2 class="text-primary">Datos de Contacto</h2>
						<p class="text-muted">
							<strong>Telefono Fijo : </strong><?php echo formatPhone($rowdata['Fono1']); ?><br/>
							<strong>Telefono Movil : </strong><?php echo formatPhone($rowdata['Fono2']); ?><br/>
							<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
							<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
							<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="https://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
						</p>

						<h2 class="text-primary">Persona de Contacto</h2>
						<p class="text-muted">
							<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
							<strong>Telefono : </strong><?php echo formatPhone($rowdata['PersonaContacto_Fono']); ?><br/>
							<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
						</p>

					</div>
					<div class="clearfix"></div>

				</div>
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
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//filtro para el curso
$z = "idEstado=1 AND idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Alumno</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idCurso)){          $x1  = $idCurso;           }else{$x1  = '';}
				if(isset($Nombre)){           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($ApellidoPat)){      $x3  = $ApellidoPat;       }else{$x3  = '';}
				if(isset($ApellidoMat)){      $x4  = $ApellidoMat;       }else{$x4  = '';}
				if(isset($Rut)){              $x5  = $Rut;               }else{$x5  = '';}
				if(isset($email)){            $x6  = $email;             }else{$x6  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_select_filter('Curso','idCurso', $x1, 2, 'idCurso', 'Nombre', 'cursos_listado', $z, '', $dbConn);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
				$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x3, 2);
				$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x4, 1);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x5, 2);
				$Form_Inputs->form_input_icon('Email', 'email', $x6, 2,'fa fa-envelope-o');

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('password', 1234, 2);
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
		case 'rut_asc':       $order_by = 'alumnos_listado.Rut ASC ';                                              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Rut Ascendente'; break;
		case 'rut_desc':      $order_by = 'alumnos_listado.Rut DESC ';                                             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Rut Descendente';break;
		case 'nombre_asc':    $order_by = 'alumnos_listado.ApellidoPat ASC, alumnos_listado.ApellidoMat ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':   $order_by = 'alumnos_listado.ApellidoPat DESC, alumnos_listado.ApellidoMat DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':    $order_by = 'alumnos_listado.idEstado ASC ';                                         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'alumnos_listado.idEstado DESC ';                                        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'curso_asc':     $order_by = 'cursos_listado.Nombre ASC ';                                            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Curso Ascendente';break;
		case 'curso_desc':    $order_by = 'cursos_listado.Nombre DESC ';                                           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Curso Descendente';break;

		default: $order_by = 'cursos_listado.Nombre ASC, alumnos_listado.ApellidoPat ASC, alumnos_listado.ApellidoMat ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'cursos_listado.Nombre ASC, alumnos_listado.ApellidoPat ASC, alumnos_listado.ApellidoMat ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "alumnos_listado.idAlumno!=0";
$SIS_where.= " AND alumnos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//verifico que sea un administrador

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCurso']) && $_GET['idCurso']!=''){           $SIS_where .= " AND alumnos_listado.idCurso=".$_GET['idCurso'];}
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){             $SIS_where .= " AND alumnos_listado.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['ApellidoPat']) && $_GET['ApellidoPat']!=''){   $SIS_where .= " AND alumnos_listado.ApellidoPat LIKE '%".EstandarizarInput($_GET['ApellidoPat'])."%'";}
if(isset($_GET['ApellidoMat']) && $_GET['ApellidoMat']!=''){   $SIS_where .= " AND alumnos_listado.ApellidoMat LIKE '%".EstandarizarInput($_GET['ApellidoMat'])."%'";}
if(isset($_GET['Rut']) && $_GET['Rut']!=''){                   $SIS_where .= " AND alumnos_listado.Rut LIKE '%".EstandarizarInput($_GET['Rut'])."%'";}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento']!=''){   $SIS_where .= " AND alumnos_listado.fNacimiento='".$_GET['fNacimiento']."'";}
if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){         $SIS_where .= " AND alumnos_listado.idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){         $SIS_where .= " AND alumnos_listado.idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){       $SIS_where .= " AND alumnos_listado.Direccion LIKE '%".EstandarizarInput($_GET['Direccion'])."%'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'alumnos_listado.idAlumno', 'alumnos_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
alumnos_listado.idAlumno,
alumnos_listado.Rut,
alumnos_listado.Nombre,
alumnos_listado.ApellidoPat,
alumnos_listado.ApellidoMat,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
cursos_listado.Nombre AS Curso,
alumnos_listado.idEstado';
$SIS_join  = '
LEFT JOIN `core_estados`    ON core_estados.idEstado       = alumnos_listado.idEstado
LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema     = alumnos_listado.idSistema
LEFT JOIN `cursos_listado`  ON cursos_listado.idCurso      = alumnos_listado.idCurso';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrUsers = array();
$arrUsers = db_select_array (false, $SIS_query, 'alumnos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUsers');

//filtro para el curso
$z = "idEstado=1 AND idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Alumno</a><?php }?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idCurso)){          $x1  = $idCurso;           }else{$x1  = '';}
				if(isset($Nombre)){           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($ApellidoPat)){      $x3  = $ApellidoPat;       }else{$x3  = '';}
				if(isset($ApellidoMat)){      $x4  = $ApellidoMat;       }else{$x4  = '';}
				if(isset($Rut)){              $x5  = $Rut;               }else{$x5  = '';}
				if(isset($fNacimiento)){      $x6  = $fNacimiento;       }else{$x6  = '';}
				if(isset($idCiudad)){         $x7  = $idCiudad;          }else{$x7  = '';}
				if(isset($idComuna)){         $x8  = $idComuna;          }else{$x8  = '';}
				if(isset($Direccion)){        $x9  = $Direccion;         }else{$x9  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Curso','idCurso', $x1, 1, 'idCurso', 'Nombre', 'cursos_listado', $z, '', $dbConn);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 1);
				$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x3, 1);
				$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x4, 1);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x5, 1);
				$Form_Inputs->form_date('Fecha Nacimiento','fNacimiento', $x6, 1);
				$Form_Inputs->form_select_depend1('Region','idCiudad', $x7, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x8, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
										 $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x9, 1,'fa fa-map');

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Alumnos</h5>
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
							<div class="pull-left">Rut</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=rut_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=rut_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Nombre del Alumno</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Curso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=curso_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=curso_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
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
					<?php foreach ($arrUsers as $usuarios){ ?>
					<tr class="odd">
						<td><?php echo $usuarios['Rut']; ?></td>
						<td><?php echo $usuarios['ApellidoPat'].' '.$usuarios['ApellidoMat'].', '.$usuarios['Nombre']; ?></td>
						<td><?php echo $usuarios['Curso']; ?></td>
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['estado']; ?></label></td>	
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_alumno.php?view='.simpleEncode($usuarios['idAlumno'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idAlumno']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($usuarios['idAlumno'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar al cliente '.$usuarios['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<?php widget_modal(40, 95); ?>
<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
