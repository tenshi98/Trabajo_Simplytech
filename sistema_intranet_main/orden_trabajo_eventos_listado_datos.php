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
$original = "orden_trabajo_eventos_listado.php";
$location = $original;
$new_location = "orden_trabajo_eventos_listado_datos.php";
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
	require_once 'A1XRXS_sys/xrxs_form/orden_trabajo_eventos_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Proveedor creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Proveedor editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Proveedor borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
$y = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
$m = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idConfig_1=1 AND idEstado=1";		
// Se traen todos los datos del producto
$query = "SELECT 
orden_trabajo_eventos_listado.Fecha,
orden_trabajo_eventos_listado.Hora,
orden_trabajo_eventos_listado.Observacion,
orden_trabajo_eventos_listado.idTrabajador,
orden_trabajo_eventos_listado.idCliente,
orden_trabajo_eventos_listado.idMaquina

FROM `orden_trabajo_eventos_listado`
WHERE orden_trabajo_eventos_listado.idEvento = {$_GET['id']}";
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
				<span class="info-box-text">Evento</span>
				<span class="info-box-number"><?php echo fecha_estandar($rowdata['Fecha']).' - '.$rowdata['Hora'].' hrs'; ?></span>

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
				<li class=""><a href="<?php echo 'orden_trabajo_eventos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class="active"><a href="<?php echo 'orden_trabajo_eventos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'orden_trabajo_eventos_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivos Adjuntos</a></li>          
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
					
					<?php 
					//Se verifican si existen los datos
					if(isset($idTrabajador)) {  $x1  = $idTrabajador; }else{$x1  = $rowdata['idTrabajador'];}
					if(isset($idCliente)) {     $x2  = $idCliente;    }else{$x2  = $rowdata['idCliente'];}
					if(isset($idMaquina)) {     $x3  = $idMaquina;    }else{$x3  = $rowdata['idMaquina'];}
					if(isset($Fecha)) {         $x4  = $Fecha;        }else{$x4  = $rowdata['Fecha'];}
					if(isset($Hora)) {          $x5  = $Hora;         }else{$x5  = $rowdata['Hora'];}
					if(isset($Observacion)) {   $x6  = $Observacion;  }else{$x6  = $rowdata['Observacion'];}

					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_select_filter('Trabajador','idTrabajador', $x1, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
					//verifico el sistema
					if($_SESSION['usuario']['basic_data']['idSistema']==11){
						$Form_Imputs->form_select_depend1($x_column_cliente_sing,'idCliente', $x2, 2, 'idCliente', 'Nombre', 'clientes_listado', $y, 0,
												 $x_column_maquina_sing,'idMaquina', $x3, 2, 'idMaquina', 'Nombre', 'maquinas_listado', $m, 0, 
												  $dbConn, 'form1');
					}else{
						$Form_Imputs->form_select_filter($x_column_maquina_sing,'idMaquina', $x3, 2, 'idMaquina', 'Nombre', 'maquinas_listado', $m, '', $dbConn);
					}
					$Form_Imputs->form_date('Fecha','Fecha', $x4, 2);
					$Form_Imputs->form_time('Hora','Hora', $x5, 2, 2);
					$Form_Imputs->form_ckeditor('Observacion','Observacion', $x6, 2, 2);
					
					$Form_Imputs->form_input_hidden('idEvento', $_GET['id'], 2);
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
