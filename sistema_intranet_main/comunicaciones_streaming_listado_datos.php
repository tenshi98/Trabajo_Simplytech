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
$original = "comunicaciones_streaming_listado.php";
$location = $original;
$new_location = "comunicaciones_streaming_listado_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/comunicaciones_streaming_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Streaming creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Streaming editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Streaming borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Se traen todos los datos del producto
$query = "SELECT Nombre,idEstado, idTipo, Fecha, HoraInicio, HoraTermino
FROM `comunicaciones_streaming_listado`
WHERE idStreaming = ".$_GET['id'];
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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Streaming', $rowdata['Nombre'], 'Editar Datos Basicos');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'comunicaciones_streaming_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'comunicaciones_streaming_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'comunicaciones_streaming_listado_usuarios.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Usuarios</a></li>         
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
					
					<?php 
					//Se verifican si existen los datos
					if(isset($idTipo)){        $x1  = $idTipo;        }else{$x1  = $rowdata['idTipo'];}
					if(isset($Nombre)){        $x2  = $Nombre;        }else{$x2  = $rowdata['Nombre'];}
					if(isset($Fecha)){         $x3  = $Fecha;         }else{$x3  = $rowdata['Fecha'];}
					if(isset($HoraInicio)){    $x4  = $HoraInicio;    }else{$x4  = $rowdata['HoraInicio'];}
					if(isset($HoraTermino)){   $x5  = $HoraTermino;   }else{$x5  = $rowdata['HoraTermino'];}
					if(isset($idEstado)){      $x6  = $idEstado;      }else{$x6  = $rowdata['idEstado'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select('Tipo','idTipo', $x1, 2, 'idTipo', 'Nombre', 'core_tipo_videoconferencia', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
					$Form_Inputs->form_date('Fecha','Fecha', $x3, 2);
					$Form_Inputs->form_time('Hora Inicio','HoraInicio', $x4, 2, 1);
					$Form_Inputs->form_time('Hora Termino','HoraTermino', $x5, 2, 1);
					$Form_Inputs->form_select('Estado','idEstado', $x6, 2, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
				
					
					$Form_Inputs->form_input_hidden('idStreaming', $_GET['id'], 2);
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
