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
$original = "laboratorio_listado.php";
$location = $original;
$new_location = "laboratorio_listado_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del Cliente sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/laboratorio_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Laboratorio creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Laboratorio editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Laboratorio borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Se traen todos los datos de mi Cliente
$query = "SELECT PersonaContacto, Fono1,Fono2, Fax, email, Web, Nombre 
FROM `laboratorio_listado`
WHERE idLaboratorio = ".$_GET['id'];
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

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Laboratorio', $rowdata['Nombre'], 'Editar Datos de contacto');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'laboratorio_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'laboratorio_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class="active"><a href="<?php echo 'laboratorio_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'laboratorio_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'laboratorio_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
					<?php 
					//Se verifican si existen los datos
					if(isset($PersonaContacto)){  $x11 = $PersonaContacto;   }else{$x11 = $rowdata['PersonaContacto'];}
					if(isset($Fono1)){            $x12 = $Fono1;             }else{$x12 = $rowdata['Fono1'];}
					if(isset($Fono2)){            $x13 = $Fono2;             }else{$x13 = $rowdata['Fono2'];}
					if(isset($Fax)){              $x14 = $Fax;               }else{$x14 = $rowdata['Fax'];}
					if(isset($email)){            $x15 = $email;             }else{$x15 = $rowdata['email'];}
					if(isset($Web)){              $x16 = $Web;               }else{$x16 = $rowdata['Web'];}
					

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_icon('Persona de Contacto', 'PersonaContacto', $x11, 1,'fa fa-user-secret');
					$Form_Inputs->form_input_phone('Telefono Fijo', 'Fono1', $x12, 1);
					$Form_Inputs->form_input_phone('Telefono Movil', 'Fono2', $x13, 1);
					$Form_Inputs->form_input_fax('Fax', 'Fax', $x14, 1);
					$Form_Inputs->form_input_icon('Email', 'email', $x15, 1,'fa fa-envelope-o');
					$Form_Inputs->form_input_icon('Web', 'Web', $x16, 1,'fa fa-internet-explorer');
					
					$Form_Inputs->form_input_hidden('idLaboratorio', $_GET['id'], 2);
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
