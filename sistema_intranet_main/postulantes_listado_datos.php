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
$new_location = "postulantes_listado_datos.php";
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
	//se agregan ubicaciones
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Trabajador creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Trabajador editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Trabajador borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos del trabajador
$query = "SELECT Nombre,ApellidoPat,ApellidoMat,Fono1,Fono2,Rut,idCiudad,idComuna,Direccion,idSistema,idSexo,FNacimiento,idEstadoCivil,
idTipoLicencia, SueldoLiquido
FROM `postulantes_listado`
WHERE idPostulante = {$_GET['id']}";
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
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Postulante</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Datos Personales</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'postulantes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'postulantes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos</a></li>
				<li class=""><a href="<?php echo 'postulantes_listado_estudios.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estudios</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'postulantes_listado_cursos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Cursos</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_experiencia.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Experiencia</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_curriculum.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Curriculum</a></li>
						<li class=""><a href="<?php echo 'postulantes_listado_otros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Otros</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		

					<?php 
					//Se verifican si existen los datos
					if(isset($Nombre)) {              $x1  = $Nombre;               }else{$x1  = $rowdata['Nombre'];}
					if(isset($ApellidoPat)) {         $x2  = $ApellidoPat;          }else{$x2  = $rowdata['ApellidoPat'];}
					if(isset($ApellidoMat)) {         $x3  = $ApellidoMat;          }else{$x3  = $rowdata['ApellidoMat'];}
					if(isset($Rut)) {                 $x4  = $Rut;                  }else{$x4  = $rowdata['Rut'];}
					if(isset($idSexo)) {              $x5  = $idSexo;               }else{$x5  = $rowdata['idSexo'];}
					if(isset($FNacimiento)) {         $x6  = $FNacimiento;          }else{$x6  = $rowdata['FNacimiento'];}
					if(isset($Fono1)) {               $x7  = $Fono1;                }else{$x7  = $rowdata['Fono1'];}
					if(isset($Fono2)) {               $x8  = $Fono2;                }else{$x8  = $rowdata['Fono2'];}
					if(isset($idCiudad)) {            $x9  = $idCiudad;             }else{$x9  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {            $x10 = $idComuna;             }else{$x10 = $rowdata['idComuna'];}
					if(isset($Direccion)) {           $x11 = $Direccion;            }else{$x11 = $rowdata['Direccion'];}
					if(isset($idEstadoCivil)) {       $x12 = $idEstadoCivil;        }else{$x12 = $rowdata['idEstadoCivil'];}
					if(isset($idTipoLicencia)) {      $x13 = $idTipoLicencia;       }else{$x13 = $rowdata['idTipoLicencia'];}
					if(isset($SueldoLiquido)) {       $x14 = $SueldoLiquido;        }else{$x14 = $rowdata['SueldoLiquido'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
					$Form_Imputs->form_input_text( 'Apellido Paterno', 'ApellidoPat', $x2, 2);
					$Form_Imputs->form_input_text( 'Apellido Materno', 'ApellidoMat', $x3, 2);
					$Form_Imputs->form_input_rut('Rut', 'Rut', $x4, 2);
					$Form_Imputs->form_select('Sexo','idSexo', $x5, 2, 'idSexo', 'Nombre', 'core_sexo', 0, '', $dbConn);
					$Form_Imputs->form_date('FNacimiento','FNacimiento', $x6, 1);
					$Form_Imputs->form_input_phone('Fono1', 'Fono1', $x7, 1);
					$Form_Imputs->form_input_phone('Fono2', 'Fono2', $x8, 1);
					$Form_Imputs->form_select_depend1('Ciudad','idCiudad', $x9, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x10, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
											 $dbConn, 'form1');
					$Form_Imputs->form_input_icon( 'Direccion', 'Direccion', $x11, 1,'fa fa-map');
					$Form_Imputs->form_select('Estado Civil','idEstadoCivil', $x12, 1, 'idEstadoCivil', 'Nombre', 'core_estado_civil', 0, '', $dbConn);
					$Form_Imputs->form_select('Tipo Licencia','idTipoLicencia', $x13, 2, 'idTipoLicencia', 'Nombre', 'core_tipos_licencia_conducir', 0, '', $dbConn);
					$Form_Imputs->form_values('Pretenciones','SueldoLiquido', $x14, 1);
					
					$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
					$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Imputs->form_input_hidden('idPostulante', $_GET['id'], 2);
					?>

					<div class="form-group">		
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 		
					</div>
				</form>
				<?php require_once '../LIBS_js/validator/form_validator.php';?>
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
