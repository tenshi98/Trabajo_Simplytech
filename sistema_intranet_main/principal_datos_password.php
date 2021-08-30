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
$original = "principal_datos.php";
$location = $original;
$location .= '?d=d';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['edit_clave']) )  { 
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Perfil creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Perfil editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Perfil borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$query = "SELECT email, Nombre, Rut, fNacimiento, Direccion, Fono, idCiudad, idComuna
FROM `usuarios_listado`
WHERE idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
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
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Perfil', $_SESSION['usuario']['basic_data']['Nombre'], 'Cambiar Contraseña');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'principal_datos.php';?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'principal_datos_datos.php';?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Personales</a></li>
				<li class=""><a href="<?php echo 'principal_datos_imagen.php';?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Cambiar Imagen</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class="active"><a href="<?php echo 'principal_datos_password.php';?>" ><i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña</a></li>
						<?php if($Count_pagos!=0){ ?>
							<li class=""><a href="<?php echo 'principal_datos_documentos_pago.php'; ?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Documentos Pago</a></li>
						<?php } ?>
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
					<?php 
					//Se verifican si existen los datos
					if(isset($oldpassword)) {   $x1  = $oldpassword;  }else{$x1  = '';}
					if(isset($password)) {      $x2  = $password;     }else{$x2  = '';}
					if(isset($repassword)) {    $x3  = $repassword;   }else{$x3  = '';}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_password('Password Antigua', 'oldpassword', $x1, 2);
					$Form_Inputs->form_input_password('Nueva Password', 'password', $x2, 2);
					$Form_Inputs->form_input_password('Repetir Password', 'repassword', $x3, 2);
					
					$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
						?> 
							  
					<div class="form-group">
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Cambiar Password" name="edit_clave">
					</div>
						  
				</form> 
				<?php widget_validator(); ?> 
			</div>
			
			
			
			<div id="pswd_info">
				<h4>Requerimientos</h4>
				<ul>
					<li id="letter" class="invalid">Minimo una letra</li>
					<li id="capital" class="invalid">Una letra mayuscula</strong></li>
					<li id="number" class="invalid">Un numero</strong></li>
					<li id="length" class="invalid">8 Caracteres</strong></li>
					<li id="space" class="invalid">Usar Simbolos [@,#,*,-,.,;]</li>
				</ul>
			</div>
			

			<script>
			$(document).ready(function(){
		
				$('input[type=password]').keyup(function() {
					let pswd = $(this).val();
					
					//validate the length
					if ( pswd.length < 8 ) {
						$('#length').removeClass('valid').addClass('invalid');
					} else {
						$('#length').removeClass('invalid').addClass('valid');
					}
					
					//validate letter
					if ( pswd.match(/[A-z]/) ) {
						$('#letter').removeClass('invalid').addClass('valid');
					} else {
						$('#letter').removeClass('valid').addClass('invalid');
					}

					//validate capital letter
					if ( pswd.match(/[A-Z]/) ) {
						$('#capital').removeClass('invalid').addClass('valid');
					} else {
						$('#capital').removeClass('valid').addClass('invalid');
					}

					//validate number
					if ( pswd.match(/\d/) ) {
						$('#number').removeClass('invalid').addClass('valid');
					} else {
						$('#number').removeClass('valid').addClass('invalid');
					}
					
					//validate space
					if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
						$('#space').removeClass('invalid').addClass('valid');
					} else {
						$('#space').removeClass('valid').addClass('invalid');
					}
					
				}).focus(function() {
					$('#pswd_info').show();
				}).blur(function() {
					$('#pswd_info').hide();
				});
				
			});
			</script>
		
		</div>	
	</div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
