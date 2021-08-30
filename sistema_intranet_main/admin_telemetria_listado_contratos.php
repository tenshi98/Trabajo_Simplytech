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
$new_location = "admin_telemetria_listado_contratos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//se agregan ubicaciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado_contratos.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado_contratos.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//se agregan ubicaciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado_contratos.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/ 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Carga creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Carga editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Carga borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit']) ) { 
// consulto los datos
$query = "SELECT Codigo, F_Inicio, F_Termino
FROM `telemetria_listado_contratos`
WHERE idContrato = ".$_GET['edit'];
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

 ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Editar Carga</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php 
				//Se verifican si existen los datos
				if(isset($Codigo)) {      $x1  = $Codigo;       }else{$x1  = $rowdata['Codigo'];}
				if(isset($F_Inicio)) {    $x2  = $F_Inicio;     }else{$x2  = $rowdata['F_Inicio'];}
				if(isset($F_Termino)) {   $x3  = $F_Termino;    }else{$x3  = $rowdata['F_Termino'];}
						
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Codigo', 'Codigo', $x1, 2);
				$Form_Inputs->form_date('F Inicio','F_Inicio', $x2, 2);
				$Form_Inputs->form_date('F Termino','F_Termino', $x3, 2);
				
				$Form_Inputs->form_input_hidden('idContrato', $_GET['edit'], 2);
				?>
				
				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Crear Contrato</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
   
				<?php 
				//Se verifican si existen los datos
				if(isset($Codigo)) {      $x1  = $Codigo;       }else{$x1  = '';}
				if(isset($F_Inicio)) {    $x2  = $F_Inicio;     }else{$x2  = '';}
				if(isset($F_Termino)) {   $x3  = $F_Termino;    }else{$x3  = '';}
						
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Codigo', 'Codigo', $x1, 2);
				$Form_Inputs->form_date('F Inicio','F_Inicio', $x2, 2);
				$Form_Inputs->form_date('F Termino','F_Termino', $x3, 2);
					
					
				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				?>

				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}else{
// consulto los datos
$query = "SELECT Nombre,Identificador,id_Geo,id_Sensores, idUsoContrato
FROM `telemetria_listado`
WHERE idTelemetria = ".$_GET['id'];
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

// consulto los datos
$arrCargas = array();
$query = "SELECT idContrato, Codigo, F_Inicio, F_Termino
FROM `telemetria_listado_contratos`
WHERE idTelemetria = ".$_GET['id']."
ORDER BY idContrato DESC ";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrCargas,$row );
}



?>
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Contratos');?>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Contrato</a><?php }?>
	</div>
</div>
<div class="clearfix"></div> 


<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'admin_telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'admin_telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
						<li class="active"><a href="<?php echo 'admin_telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_alerta_general.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarma General</a></li>
						<?php if($rowdata['id_Geo']==2){ ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-signs" aria-hidden="true"></i> Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Horario Envio Notificaciones</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i> Otros Datos</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Codigo</th>
						<th width="120">Fecha Inicio</th>
						<th width="120">Fecha Termino</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrCargas as $carga) { ?>
					<tr class="odd">
						<td><?php echo $carga['Codigo']; ?></td>		
						<td><?php echo fecha_estandar($carga['F_Inicio']); ?></td>	
						<td><?php echo fecha_estandar($carga['F_Termino']); ?></td>	
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&edit='.$carga['idContrato']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.simpleEncode($carga['idContrato'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar el contrato '.$carga['Codigo'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								<?php } ?>								
							</div>
						</td>	
					</tr>
				<?php } ?>                   
				</tbody>
			</table>
		</div> 	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
