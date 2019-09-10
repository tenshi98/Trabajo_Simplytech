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
$original = "admin_telemetria_listado.php";
$location = $original;
$new_location = "admin_telemetria_listado_trabajo.php";
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
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/ 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Equipo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Equipo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Equipo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// tomo los datos del usuario
$query = "SELECT Nombre,Jornada_inicio,Jornada_termino,Colacion_inicio,Colacion_termino,Microparada,
id_Geo, id_Sensores, idUsoContrato
FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['id']}";
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
			<span class="info-box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Equipo</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

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
				<li class=""><a href="<?php echo 'admin_telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'admin_telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_alerta_general.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Alarma General</a></li>
						<?php if($rowdata['id_Geo']==2){ ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Sensores</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Horario</a></li>
						<li class="active"><a href="<?php echo 'admin_telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Otros Datos</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php  
					//Se verifican si existen los datos
					if(isset($Jornada_inicio)) {    $x1 = $Jornada_inicio;      }else{$x1 = $rowdata['Jornada_inicio'];}
					if(isset($Jornada_termino)) {   $x2 = $Jornada_termino;     }else{$x2 = $rowdata['Jornada_termino'];}
					if(isset($Colacion_inicio)) {   $x3 = $Colacion_inicio;     }else{$x3 = $rowdata['Colacion_inicio'];}
					if(isset($Colacion_termino)) {  $x4 = $Colacion_termino;    }else{$x4 = $rowdata['Colacion_termino'];}
					if(isset($Microparada)) {       $x5 = $Microparada;         }else{$x5 = $rowdata['Microparada'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					echo '<h2>Horario Trabajo</h2>';
					$Form_Imputs->form_time('Hora Inicio','Jornada_inicio', $x1, 2, 2);
					$Form_Imputs->form_time('Hora Termino','Jornada_termino', $x2, 2, 2);
					
					echo '<h2>Horario Colacion</h2>';
					$Form_Imputs->form_time('Hora Inicio','Colacion_inicio', $x3, 2, 2);
					$Form_Imputs->form_time('Hora Termino','Colacion_termino', $x4, 2, 1);
					
					echo '<h2>Ignorar Microparadas</h2>';
					$Form_Imputs->form_time('Tiempo','Microparada', $x5, 2, 1);
					
					
					
					
					$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
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
