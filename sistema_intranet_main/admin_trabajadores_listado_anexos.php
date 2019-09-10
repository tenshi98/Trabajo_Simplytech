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
$original = "admin_trabajadores_listado.php";
$location = $original;
$new_location = "admin_trabajadores_listado_anexos.php";
$new_location .='?pagina='.$_GET['pagina'];
$new_location .='&id='.$_GET['id'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'submit_Documento';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_listado_anexos.php';
}
//se borra un dato
if ( !empty($_GET['del_Documento']) )     {
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_Documento';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_listado_anexos.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Trabajador creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Trabajador editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Trabajador borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['new']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Anexo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
					
				<?php 
				//Se verifican si existen los datos
				if(isset($Fecha_ingreso)) {  $x1  = $Fecha_ingreso;   }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','Documento', 1, '"doc","docx","pdf","jpg", "png", "gif", "jpeg"');
				$Form_Imputs->form_date('Fecha Anexo','Fecha_ingreso', $x1, 2);
				
				$Form_Imputs->form_input_hidden('idTrabajador', $_GET['id'], 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf093; Subir Archivo" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
							  
			</form> 
			<?php widget_validator(); ?>  
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else{
// tomo los datos del usuario
$query = "SELECT Nombre, ApellidoPat, ApellidoMat
FROM `trabajadores_listado`
WHERE idTrabajador = {$_GET['id']}";
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

// Se trae un listado con todas las observaciones el cliente
$arrAnexos = array();
$query = "SELECT  idAnexo,Documento, Fecha_ingreso
FROM `trabajadores_listado_anexos`
WHERE idTrabajador = {$_GET['id']}
ORDER BY Fecha_ingreso DESC ";
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
array_push( $arrAnexos,$row );
}
?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Trabajador</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Anexos Contratos</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Anexo</a><?php }?>
	</div>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'admin_trabajadores_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'admin_trabajadores_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_trabajadores_listado_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_laboral.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Informacion Laboral</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_previsional.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Descuentos Previsionales</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_descuentos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Otros Descuentos Previsionales</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_bonos_fijos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Bonos Fijos Asignados</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_cargas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Cargas Familiares</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Contrato</a></li>
						<li class="active"><a href="<?php echo 'admin_trabajadores_listado_anexos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Anexos Contrato</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_licencia.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Licencia Conducir</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Foto</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_curriculum.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Curriculum</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_antecedentes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Antecedentes</a></li>
						<li class=""><a href="<?php echo 'admin_trabajadores_listado_carnet.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Carnet</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="120">Fecha Ingreso</th>
						<th>Nombre Archivo</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
											 
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrAnexos as $tipo) { ?>
					<tr class="odd">
						<td><?php echo fecha_estandar($tipo['Fecha_ingreso']); ?></td>
						<td><?php echo $tipo['Documento']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$tipo['Documento']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								<?php 
								$ubicacion = $location.'&del_Documento='.$tipo['idAnexo'];
								$dialogo   = '¿Realmente deseas eliminar el documento '.$tipo['Documento'].'?';?>
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
