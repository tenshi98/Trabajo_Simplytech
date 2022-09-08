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
$original = "admin_usuarios_listado.php";
$location = $original;
$new_location = "admin_usuarios_listado_datos.php";
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
	require_once 'A1XRXS_sys/xrxs_form/usuarios_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$SIS_query = 'Nombre, Fono, email, Rut, fNacimiento, idCiudad, idComuna, Direccion, Direccion_img';
$SIS_join  = '';
$SIS_where = 'idUsuario ='.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'usuarios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Usuario', $rowdata['Nombre'], 'Editar Datos Personales');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'admin_usuarios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'admin_usuarios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_usuarios_listado_permisos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Permisos</a></li>
				<li class=""><a href="<?php echo 'admin_usuarios_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
				<li class=""><a href="<?php echo 'admin_usuarios_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($Nombre)) {         $x1  = $Nombre;         }else{$x1  = $rowdata['Nombre'];}
					if(isset($Fono)) {           $x2  = $Fono;           }else{$x2  = $rowdata['Fono'];}
					if(isset($email)) {          $x3  = $email;          }else{$x3  = $rowdata['email'];}
					if(isset($Rut)) {            $x4  = $Rut;            }else{$x4  = $rowdata['Rut'];}
					if(isset($fNacimiento)) {    $x5  = $fNacimiento;    }else{$x5  = $rowdata['fNacimiento'];}
					if(isset($idCiudad)) {       $x6  = $idCiudad;       }else{$x6  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {       $x7  = $idComuna;       }else{$x7  = $rowdata['idComuna'];}
					if(isset($Direccion)) {      $x8  = $Direccion;      }else{$x8  = $rowdata['Direccion'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
					$Form_Inputs->form_input_phone('Fono', 'Fono', $x2, 1);
					$Form_Inputs->form_input_icon('Email', 'email', $x3, 2,'fa fa-envelope-o');
					$Form_Inputs->form_input_rut('Rut', 'Rut', $x4, 1);
					$Form_Inputs->form_date('F Nacimiento','fNacimiento', $x5, 1);
					$Form_Inputs->form_select_depend1('Region','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										     'Comuna','idComuna', $x7, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										     $dbConn, 'form1');	
					$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x8, 1,'fa fa-map');
					
					
					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idUsuario', $_GET['id'], 2);
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
