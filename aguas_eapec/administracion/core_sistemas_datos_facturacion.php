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
$rowlevel['nombre_categoria'] = '';
$original = "core_sistemas.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){ $location .= "&search=".$_GET['search'] ; }
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_obligatorios = 'idSistema';
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
			  <h3><i class="fa fa-dashboard"></i> Sistemas</h3>
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
// tomo los datos del usuario
$query = "SELECT Nombre, valorCargoFijo,valorAgua,valorRecoleccion,valorVisitaCorte,valorCorte1,valorCorte2,
	valorReposicion1,valorReposicion2, NdiasPago, Fac_nEmergencia, Fac_nConsultas
FROM `core_sistemas`
WHERE idSistema = {$_GET['id']}";
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
				<li class=""><a href="<?php echo 'core_sistemas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contrato</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class="active"><a href="<?php echo 'core_sistemas_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Facturacion</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Logo</a></li>
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post"  name="form1">		
			
					<?php 
				//Se verifican si existen los datos
				if(isset($valorCargoFijo)) {   $x1  = $valorCargoFijo;     }else{$x1  = $rowdata['valorCargoFijo'];}
				if(isset($valorAgua)) {        $x2  = $valorAgua;          }else{$x2  = $rowdata['valorAgua'];}
				if(isset($valorRecoleccion)) { $x3  = $valorRecoleccion;   }else{$x3  = $rowdata['valorRecoleccion'];}
				if(isset($valorVisitaCorte)) { $x4  = $valorVisitaCorte;   }else{$x4  = $rowdata['valorVisitaCorte'];}
				if(isset($valorCorte1)) {      $x5  = $valorCorte1;        }else{$x5  = $rowdata['valorCorte1'];}
				if(isset($valorCorte2)) {      $x6  = $valorCorte2;        }else{$x6  = $rowdata['valorCorte2'];}
				if(isset($valorReposicion1)) { $x7  = $valorReposicion1;   }else{$x7  = $rowdata['valorReposicion1'];}
				if(isset($valorReposicion2)) { $x8  = $valorReposicion2;   }else{$x8  = $rowdata['valorReposicion2'];}
				if(isset($NdiasPago)) {        $x9  = $NdiasPago;          }else{$x9  = $rowdata['NdiasPago'];}
				if(isset($Fac_nEmergencia)) {  $x10 = $Fac_nEmergencia;    }else{$x10 = $rowdata['Fac_nEmergencia'];}
				if(isset($Fac_nConsultas)) {   $x11 = $Fac_nConsultas;     }else{$x11 = $rowdata['Fac_nConsultas'];}
				
				//se dibujan los inputs
				echo '<h3>Facturacion</h3>';
				echo form_input_number('Cargo Fijo', 'valorCargoFijo', $x1, 1);	
				echo form_input_number('Metro Cubico Agua', 'valorAgua', $x2, 1);	
				echo form_input_number('Metro Cubico Recoleccion', 'valorRecoleccion', $x3, 1);
				echo form_input_number('Visita Corte', 'valorVisitaCorte', $x4, 1);
				echo form_input_number('Corte 1° Instancia', 'valorCorte1', $x5, 1);
				echo form_input_number('Corte 2° Instancia', 'valorCorte2', $x6, 1);
				echo form_input_number('Reposicion 1° Instancia', 'valorReposicion1', $x7, 1);
				echo form_input_number('Reposicion 2° Instancia', 'valorReposicion2', $x8, 1);	
				echo form_select_n_auto('Dias para Vencimiento','NdiasPago', $x9, 1, 1, 30);
				echo form_input('text', 'Fono Emergencias 24 hrs', 'Fac_nEmergencia', $x10, 1);
				echo form_input('text', 'Fono Consultas', 'Fac_nConsultas', $x11, 1);
				
				?>

					<div class="form-group">
						<input type="hidden" name="idSistema" value="<?php echo $_GET['id']; ?>" >			
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
