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
$original = "principal_datos.php";
$location = $original;
$location .= '?d=d';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['edit_datos'])){
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
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Perfil creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Perfil editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Perfil borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'email, Nombre,Rut, fNacimiento, Direccion, Fono, idCiudad, idComuna';
$SIS_join  = '';
$SIS_where = 'idUsuario = '.$_SESSION['usuario']['basic_data']['idUsuario'];
$rowdata = db_select_data (false, $SIS_query, 'usuarios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

/*************************************************/
//permisos a las transacciones
$trans[1] = "pago_masivo_cliente.php";           //Pagos clientes
$trans[2] = "pago_masivo_proveedor.php";         //Pagos Proveedores
$trans[3] = "pago_masivo_cliente_reversa.php";   //Reversa Pagos clientes
$trans[4] = "pago_masivo_proveedor_reversa.php"; //Reversa Pagos Proveedores

//Genero los permisos
for ($i = 1; $i <= 4; $i++) {
	//Seteo la variable a 0
	$prm_x[$i] = 0;
	//recorro los permisos
	if(isset($_SESSION['usuario']['menu'])){
		foreach($_SESSION['usuario']['menu'] as $menu=>$productos) {
			foreach($productos as $producto) {
				//elimino los datos extras
				$str = str_replace("?pagina=1", "", $producto['TransaccionURL']);
				//le asigno el valor 1 en caso de que exista
				if($trans[$i]==$str){
					$prm_x[$i] = 1;
				}
			}
		}
	}
}
//verifico permisos
$Count_pagos = $prm_x[1] + $prm_x[2] + $prm_x[3] + $prm_x[4];

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Perfil', $_SESSION['usuario']['basic_data']['Nombre'], 'Editar Datos Personales'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'principal_datos.php'; ?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'principal_datos_datos.php'; ?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Personales</a></li>
				<li class=""><a href="<?php echo 'principal_datos_imagen.php'; ?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Cambiar Imagen</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'principal_datos_password.php'; ?>" ><i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña</a></li>
						<?php if($Count_pagos!=0){ ?>
							<li class=""><a href="<?php echo 'principal_datos_documentos_pago.php'?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Documentos Pago</a></li>
						<?php } ?>
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($Nombre)){        $x5  = $Nombre;       }else{$x5  = $rowdata['Nombre'];}
					if(isset($Fono)){          $x6  = $Fono;         }else{$x6  = $rowdata['Fono'];}
					if(isset($email)){         $x7  = $email;        }else{$x7  = $rowdata['email'];}
					if(isset($Rut)){           $x8  = $Rut;          }else{$x8  = $rowdata['Rut'];}
					if(isset($fNacimiento)){   $x9  = $fNacimiento;  }else{$x9  = $rowdata['fNacimiento'];}
					if(isset($Ciudad)){        $x10 = $Ciudad;       }else{$x10 = $rowdata['idCiudad'];}
					if(isset($Comuna)){        $x11 = $Comuna;       }else{$x11 = $rowdata['idComuna'];}
					if(isset($Direccion)){     $x12 = $Direccion;    }else{$x12 = $rowdata['Direccion'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x5, 2);
					$Form_Inputs->form_input_phone('Fono','Fono', $x6, 1);
					$Form_Inputs->form_input_icon('Email', 'email', $x7, 2,'fa fa-envelope-o');
					$Form_Inputs->form_input_rut('Rut', 'Rut', $x8, 2);
					$Form_Inputs->form_date('Fecha de Nacimiento','fNacimiento', $x9, 2);
					$Form_Inputs->form_select_depend1('Region','idCiudad', $x10, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											 'Comuna','idComuna', $x11, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
											 $dbConn, 'form1');
					$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x12, 1,'fa fa-map');
					$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
						
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="edit_datos">
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
