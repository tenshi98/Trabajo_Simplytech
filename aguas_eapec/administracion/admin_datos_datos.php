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
$original = "admin_datos.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';

/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&id='.$arrUsuario['idSistema'];
	$form_obligatorios = 'idSistema,Nombre,idRubro,Rut,Ciudad,Comuna,Direccion';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/core_sistemas.php';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, idRubro, Rut, Direccion,Ciudad, Comuna
FROM `core_sistemas`
WHERE idSistema = {$arrUsuario['idSistema']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);?>

<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Sistema : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div> 

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'admin_datos.php';?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'admin_datos_datos.php';?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_datos_datos_contacto.php';?>" >Datos Contacto</a></li>
				<li class=""><a href="<?php echo 'admin_datos_datos_contrato.php';?>" >Datos Contrato</a></li>
				<li class=""><a href="<?php echo 'admin_datos_datos_configuracion.php';?>" >Configuracion</a></li>
				<li class=""><a href="<?php echo 'admin_datos_datos_facturacion.php';?>" >Datos Facturacion</a></li>
				<li class=""><a href="<?php echo 'admin_datos_imagen.php';?>" >Logo</a></li>
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-lg-6 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post"  name="form1">		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($Nombre)) {           $x1  = $Nombre;           }else{$x1  = $rowdata['Nombre'];}
					if(isset($idRubro)) {          $x2  = $idRubro;          }else{$x2  = $rowdata['idRubro'];}
					if(isset($Rut)) {              $x3  = $Rut;              }else{$x3  = $rowdata['Rut'];}
					if(isset($Ciudad)) {           $x4  = $Ciudad;           }else{$x4  = $rowdata['Ciudad'];}
					if(isset($Comuna)) {           $x5  = $Comuna;           }else{$x5  = $rowdata['Comuna'];}
					if(isset($Direccion)) {        $x6  = $Direccion;        }else{$x6  = $rowdata['Direccion'];}
					
					//se dibujan los inputs
					echo '<h3>Datos Basicos</h3>';
					echo form_input('text', 'Nombres', 'Nombre', $x1, 2);
					echo form_select('Rubro','idRubro', $x2, 2, 'idRubro', 'Nombre', 'core_sistemas_rubro', 0, $dbConn);
					echo form_input_icon('text', 'Rut', 'Rut', $x3, 2,'fa fa-exclamation-triangle');
					echo form_input_icon('text', 'Ciudad', 'Ciudad', $x4, 2,'fa fa-map');	
					echo form_input_icon('text', 'Comuna', 'Comuna', $x5, 2,'fa fa-map');	
					echo form_input_icon('text', 'Direccion', 'Direccion', $x6, 2,'fa fa-map');            
	
					?>

					<div class="form-group">
						<input type="hidden" name="idSistema" value="<?php echo $arrUsuario['idSistema']; ?>" >			
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
