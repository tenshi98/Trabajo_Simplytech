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
if ( !empty($_POST['submit_edit']) )  { 
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Alumno creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Alumno editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Alumno borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi usuario
$query = "SELECT idCurso, Nombre, fNacimiento, idCiudad, idComuna, Direccion, idSistema, Rut, 
ApellidoPat, ApellidoMat
FROM `alumnos_listado`
WHERE idAlumno = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Alumno</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Datos Basicos</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'alumnos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'alumnos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'alumnos_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'alumnos_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Persona Contacto</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_datos_foto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Foto</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
						<li class=""><a href="<?php echo 'alumnos_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Password</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idCurso)) {          $x1  = $idCurso;           }else{$x1  = $rowdata['idCurso'];}
					if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = $rowdata['Nombre'];}
					if(isset($ApellidoPat)) {      $x3  = $ApellidoPat;       }else{$x3  = $rowdata['ApellidoPat'];}
					if(isset($ApellidoMat)) {      $x4  = $ApellidoMat;       }else{$x4  = $rowdata['ApellidoMat'];}
					if(isset($Rut)) {              $x5  = $Rut;               }else{$x5  = $rowdata['Rut'];}
					if(isset($fNacimiento)) {      $x6  = $fNacimiento;       }else{$x6  = $rowdata['fNacimiento'];}
					if(isset($idCiudad)) {         $x7  = $idCiudad;          }else{$x7  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {         $x8  = $idComuna;          }else{$x8  = $rowdata['idComuna'];}
					if(isset($Direccion)) {        $x9  = $Direccion;         }else{$x9  = $rowdata['Direccion'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_select('Grupo','idCurso', $x1, 2, 'idCurso', 'Nombre', 'alumnos_cursos', 'idEstado=1', '', $dbConn);
					$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x2, 2);
					$Form_Imputs->form_input_text( 'Apellido Paterno', 'ApellidoPat', $x3, 2);
					$Form_Imputs->form_input_text( 'Apellido Materno', 'ApellidoMat', $x4, 1);
					$Form_Imputs->form_input_rut('Rut', 'Rut', $x5, 2);
					$Form_Imputs->form_date('Fecha Nacimiento','fNacimiento', $x6, 1);
					$Form_Imputs->form_select_depend1('Ciudad','idCiudad', $x7, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x8, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
											 $dbConn, 'form1');
					$Form_Imputs->form_input_icon( 'Direccion', 'Direccion', $x9, 1,'fa fa-map');	 
					
					$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
					$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Imputs->form_input_hidden('idAlumno', $_GET['id'], 2);
					?>

					<div class="form-group">		
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 		
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
