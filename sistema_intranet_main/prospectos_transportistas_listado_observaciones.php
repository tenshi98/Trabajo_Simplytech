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
$original = "prospectos_transportistas_listado.php";
$location = $original;
$new_location = "prospectos_transportistas_listado_observaciones.php";
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
	//Agregamos nuevas direcciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/prospectos_transportistas_observaciones.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Agregamos nuevas direcciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/prospectos_transportistas_observaciones.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Agregamos nuevas direcciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/prospectos_transportistas_observaciones.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Observacion creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Observacion editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Observacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT Observacion
FROM `prospectos_transportistas_observaciones`
WHERE idObservacion = {$_GET['edit']}";
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
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = $rowdata['Observacion'];}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_textarea('Observaciones', 'Observacion', $x1, 2, 160);
				
				$Form_Imputs->form_input_hidden('idObservacion', $_GET['edit'], 2);
				?>
				
				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
   
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_textarea('Observaciones', 'Observacion', $x1, 2, 160);
				
				$Form_Imputs->form_input_hidden('idProspecto', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('Fecha', fecha_actual(), 2);
				?>

				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT 
prospectos_transportistas_listado.Nombre AS nombre_prospecto,
usuarios_listado.Nombre AS nombre_usuario,
prospectos_transportistas_observaciones.Fecha,
prospectos_transportistas_observaciones.Observacion
FROM `prospectos_transportistas_observaciones`
LEFT JOIN `prospectos_transportistas_listado`   ON prospectos_transportistas_listado.idProspecto     = prospectos_transportistas_observaciones.idProspecto
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = prospectos_transportistas_observaciones.idUsuario
WHERE prospectos_transportistas_observaciones.idObservacion = {$_GET['view']}
ORDER BY prospectos_transportistas_observaciones.idObservacion ASC ";
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
	<div class="box">	
		<header>		
			<h5>Ver Datos de la Observacion</h5>		
		</header>
        <div class="body">
            <h2 class="text-primary">Datos Basicos</h2>
            <p class="text-muted">
				<strong>Prospecto : </strong><?php echo $rowdata['nombre_prospecto']; ?><br/>
				<strong>Usuario : </strong><?php echo $rowdata['nombre_usuario']; ?><br/>
				<strong>Fecha : </strong><?php echo Fecha_completa_alt($rowdata['Fecha']); ?>
            </p>
                      
            <h2 class="text-primary">Observacion</h2>
            <p class="text-muted word_break " ><strong>Observacion : </strong><?php echo $rowdata['Observacion']; ?></p>
            
        	
        </div>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}else{
// tomo los datos del usuario
$query = "SELECT Nombre
FROM `prospectos_transportistas_listado`
WHERE idProspecto = {$_GET['id']}";
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

// Se trae un listado con todas las observaciones el Prospecto
$arrObservaciones = array();
$query = "SELECT 
prospectos_transportistas_observaciones.idObservacion,
prospectos_transportistas_listado.Nombre AS nombre_prospecto,
usuarios_listado.Nombre AS nombre_usuario,
prospectos_transportistas_observaciones.Fecha,
prospectos_transportistas_observaciones.Observacion
FROM `prospectos_transportistas_observaciones`
LEFT JOIN `prospectos_transportistas_listado`   ON prospectos_transportistas_listado.idProspecto     = prospectos_transportistas_observaciones.idProspecto
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = prospectos_transportistas_observaciones.idUsuario
WHERE prospectos_transportistas_observaciones.idProspecto = {$_GET['id']}
ORDER BY prospectos_transportistas_observaciones.idObservacion ASC ";
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
array_push( $arrObservaciones,$row );
}



?>
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Prospecto</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Observaciones</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Observacion</a><?php }?>
	</div>
</div>
<div class="clearfix"></div>   

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'prospectos_transportistas_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'prospectos_transportistas_listado_etapas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Etapa Fidelizacion</a></li>
				<li class=""><a href="<?php echo 'prospectos_transportistas_listado_fidelizacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado Fidelizacion</a></li>
				<li class="active"><a href="<?php echo 'prospectos_transportistas_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="120">Fecha</th>
						<th>Autor</th>
						<th>Observacion</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrObservaciones as $observaciones) { ?>
					<tr class="odd">		
						<td><?php echo fecha_estandar($observaciones['Fecha']); ?></td>		
						<td><?php echo $observaciones['nombre_usuario']; ?></td>
						<td><?php echo cortar($observaciones['Observacion'], 70); ?></td>		
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&view='.$observaciones['idObservacion']; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&edit='.$observaciones['idObservacion']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.$observaciones['idObservacion'];
									$dialogo   = '¿Realmente deseas eliminar la observacion del usuario '.$observaciones['nombre_usuario'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
