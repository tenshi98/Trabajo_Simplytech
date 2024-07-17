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
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_obligatorios = 'idCliente,idTipo,Nombre,Direccion,idSistema';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Cliente creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Cliente editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Cliente borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi usuario
$query = "SELECT idTipo, Nombre , Rut, fNacimiento, idCiudad, idComuna, Direccion, idSistema, latitud, longitud
FROM `clientes_listado`
WHERE idCliente = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); ?>

<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Cliente : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div> 

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
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
					if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = $rowdata['idTipo'];}
					if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = $rowdata['Nombre'];}
					if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = $rowdata['Rut'];}
					if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = $rowdata['fNacimiento'];}
					if(isset($idCiudad)) {         $x5  = $idCiudad;          }else{$x5  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {         $x6  = $idComuna;          }else{$x6  = $rowdata['idComuna'];}
					if(isset($Direccion)) {        $x7  = $Direccion;         }else{$x7  = $rowdata['Direccion'];}
					if(isset($idSistema)) {        $x8  = $idSistema;         }else{$x8  = $rowdata['idSistema'];}
					if(isset($lat)) {              $x9  = $lat;               }else{$x9  = $rowdata['latitud'];}
					if(isset($long)) {             $x10 = $long;              }else{$x10 = $rowdata['longitud'];}
					

					//se dibujan los inputs
					echo '<h3>Datos Basicos</h3>';
					echo form_select('Tipo de Cliente','idTipo', $x1, 2, 'idTipo', 'Nombre', 'clientes_tipos', 0, $dbConn);
					echo form_input('text', 'Nombres', 'Nombre', $x2, 2);
					echo form_input_icon('text', 'Rut', 'Rut', $x3, 1,'fa fa-exclamation-triangle');
					echo form_date('F Ingreso Sistema','fNacimiento', $x4, 1);
					echo form_select_depend1('Ciudad','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
											'Comuna','idComuna', $x6, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
											 $dbConn, 'form1');
					echo form_input_icon('text', 'Direccion', 'Direccion', $x7, 2,'fa fa-map');	 
					if($arrUsuario['tipo']=='SuperAdmin'){
						echo form_select('Sistema','idSistema', $x8, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
					}else{
						echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
					}
					
					echo form_input('text', 'Latitud', 'lat', $x9, 1);
					echo form_input('text', 'Longitud', 'long', $x10, 1);
					
					
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
