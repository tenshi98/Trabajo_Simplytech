<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "clientes_listado.php";
$location = $original;
$new_location = "clientes_listado_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){ 
	$location .= "&search=".$_GET['search'] ; 	
	$new_location .= "&search=".$_GET['search'] ; 	
}
//Verifico los permisos del Cliente sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_obligatorios = 'idCliente,email';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_listado.php';
}
?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['Cliente'] 	  = 'sucess/Cliente creado correctamente';}
if (isset($_GET['edited']))  {$error['Cliente'] 	  = 'sucess/Cliente editado correctamente';}
if (isset($_GET['deleted'])) {$error['Cliente'] 	  = 'sucess/Cliente borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi Cliente
$query = "SELECT PersonaContacto, Fono1,Fono2, Fax, email, Web, Nombre 
FROM `clientes_listado`
WHERE idCliente = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);?>

<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Cliente : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div> 

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class="active"><a href="<?php echo 'clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Facturacion</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_medicion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Mediciones</a></li>
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-lg-6 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post"  name="form1">		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($PersonaContacto)) {  $x1 = $PersonaContacto;   }else{$x1 = $rowdata['PersonaContacto'];}
					if(isset($Fono1)) {            $x2 = $Fono1;             }else{$x2 = $rowdata['Fono1'];}
					if(isset($Fono2)) {            $x3 = $Fono2;             }else{$x3 = $rowdata['Fono2'];}
					if(isset($Fax)) {              $x4 = $Fax;               }else{$x4 = $rowdata['Fax'];}
					if(isset($email)) {            $x5 = $email;             }else{$x5 = $rowdata['email'];}
					if(isset($Web)) {              $x6 = $Web;               }else{$x6 = $rowdata['Web'];}
					

					//se dibujan los inputs
					echo '<h3>Datos de contacto</h3>';
					echo form_input_icon('text', 'Persona de Contacto', 'PersonaContacto', $x1, 1,'fa fa-user-secret');
					echo form_input_phone('Telefono Fijo', 'Fono1', $x2, 1);
					echo form_input_phone('Telefono Movil', 'Fono2', $x3, 1);
					echo form_input_fax('Fax', 'Fax', $x4, 1);
					echo form_input_icon('text', 'Email', 'email', $x5, 2,'fa fa-envelope-o');
					echo form_input_icon('text', 'Web', 'Web', $x6, 1,'fa fa-internet-explorer');
					
	
					
					?>

					<div class="form-group">
						<input type="hidden" name="idCliente" value="<?php echo $_GET['id']; ?>" >			
						<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 		
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>


<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
