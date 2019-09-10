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
$original = "licitacion_listado.php";
$location = $original;
$new_location = "licitacion_listado_archivos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_archivo']) )  { 
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'new_archivo';
	require_once 'A1XRXS_sys/xrxs_form/licitacion_listado_archivos.php';
}
//se borra un dato
if ( !empty($_GET['del_archivo']) )     {
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_archivo';
	require_once 'A1XRXS_sys/xrxs_form/licitacion_listado_archivos.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario']  = 'sucess/Archivo subido correctamente';}
if (isset($_GET['deleted'])) {$error['usuario']  = 'sucess/Archivo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['new']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
					
				<?php 
				//Se verifican si existen los datos
				if(isset($Detalle)) {  $x1  = $Detalle;   }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','NombreArchivo', 1, '"doc","docx","pdf","jpg", "png", "gif", "jpeg"');
				$Form_Imputs->form_input_text('Detalle', 'Detalle', $x1, 2);
				
				$Form_Imputs->form_input_hidden('idLicitacion', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('Fecha_ingreso', fecha_actual(), 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf093; Subir Archivo" name="submit_archivo"> 
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
							  
			</form> 
			<?php widget_validator(); ?>  
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else{
// tomo los datos del usuario
$query = "SELECT  idLicitacion, Nombre, idOpcionItem
FROM `licitacion_listado`
WHERE idLicitacion = {$_GET['id']}";
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

$arrArchivos = array();
$query = "SELECT 
licitacion_listado_archivos.idArchivos, 
licitacion_listado_archivos.NombreArchivo, 
licitacion_listado_archivos.Fecha_ingreso, 
licitacion_listado_archivos.Detalle,
usuarios_listado.Nombre AS nombre_usuario

FROM `licitacion_listado_archivos`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario  = licitacion_listado_archivos.idUsuario
WHERE licitacion_listado_archivos.idLicitacion = {$_GET['id']}";
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
array_push( $arrArchivos,$row );
}


?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Contrato</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Archivos</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Subir Archivo</a><?php }?>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'licitacion_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'licitacion_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'licitacion_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if(isset($rowdata['idOpcionItem'])&&$rowdata['idOpcionItem']==1){ ?>
							<li class=""><a href="<?php echo 'licitacion_listado_itemizado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Itemizado</a></li>
						<?php } ?> 	
						<li class=""><a href="<?php echo 'licitacion_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
						<li class="active"><a href="<?php echo 'licitacion_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivos</a></li>
					</ul>
				</li>
                           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre Archivo</th>
						<th>Fecha Ingreso</th>
						<th>Detalle</th>
						<th>Usuario</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrArchivos as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['NombreArchivo']; ?></td>
						<td><?php echo fecha_estandar($tipo['Fecha_ingreso']); ?></td>
						<td><?php echo $tipo['Detalle']; ?></td>
						<td><?php echo $tipo['nombre_usuario']; ?></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$tipo['NombreArchivo']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								<a href="1download.php?dir=upload&file=<?php echo $tipo['NombreArchivo']; ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
								<?php 
								$ubicacion = $new_location.'&id='.$_GET['id'].'&del_archivo='.$tipo['idArchivos'];
								$dialogo   = '¿Realmente deseas eliminar el archivo '.$tipo['NombreArchivo'].'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
							</div>			
						</td>
					</tr>
				<?php } ?>                    
				</tbody>
			</table>
			<?php widget_modal(80, 95); ?>			
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
