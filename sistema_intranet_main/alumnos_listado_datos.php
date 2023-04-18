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
$new_location = "alumnos_listado_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'update';
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
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Alumno Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'idCurso, Nombre,ApellidoPat, fNacimiento, idCiudad, idComuna, Direccion, idSistema, Rut, ApellidoPat, ApellidoMat';
$SIS_join  = '';
$SIS_where = 'idAlumno = '.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'alumnos_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//filtro para el curso
$z = "idEstado=1 AND idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Alumno', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'], 'Editar Datos Basicos'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'alumnos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'alumnos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
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
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idCurso)){          $x1  = $idCurso;           }else{$x1  = $rowdata['idCurso'];}
					if(isset($Nombre)){           $x2  = $Nombre;            }else{$x2  = $rowdata['Nombre'];}
					if(isset($ApellidoPat)){      $x3  = $ApellidoPat;       }else{$x3  = $rowdata['ApellidoPat'];}
					if(isset($ApellidoMat)){      $x4  = $ApellidoMat;       }else{$x4  = $rowdata['ApellidoMat'];}
					if(isset($Rut)){              $x5  = $Rut;               }else{$x5  = $rowdata['Rut'];}
					if(isset($fNacimiento)){      $x6  = $fNacimiento;       }else{$x6  = $rowdata['fNacimiento'];}
					if(isset($idCiudad)){         $x7  = $idCiudad;          }else{$x7  = $rowdata['idCiudad'];}
					if(isset($idComuna)){         $x8  = $idComuna;          }else{$x8  = $rowdata['idComuna'];}
					if(isset($Direccion)){        $x9  = $Direccion;         }else{$x9  = $rowdata['Direccion'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_filter('Curso','idCurso', $x1, 2, 'idCurso', 'Nombre', 'cursos_listado', $z, '', $dbConn);
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
					$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x3, 2);
					$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x4, 1);
					$Form_Inputs->form_input_rut('Rut', 'Rut', $x5, 2);
					$Form_Inputs->form_date('Fecha Nacimiento','fNacimiento', $x6, 1);
					$Form_Inputs->form_select_depend1('Region','idCiudad', $x7, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x8, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
											 $dbConn, 'form1');
					$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x9, 1,'fa fa-map');

					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idAlumno', $_GET['id'], 2);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
