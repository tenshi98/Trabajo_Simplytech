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
$original = "telemetria_historial_mantencion.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){  $location .= "&idTelemetria=".$_GET['idTelemetria'];  $search .= "&idTelemetria=".$_GET['idTelemetria'];}
if(isset($_GET['Fecha']) && $_GET['Fecha'] != ''){                $location .= "&Fecha=".$_GET['Fecha'];                $search .= "&Fecha=".$_GET['Fecha'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_historial_mantencion.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_historial_mantencion.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_historial_mantencion.php';	
}
//se borra un dato
if ( !empty($_GET['del_img']) )     {
	//Se agregan ubicaciones
	$location .='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_img';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_historial_mantencion.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Mantencion Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Mantencion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Mantencion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) {
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "telemetria_listado.idSistema>=0";
}else{
	$z = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} ";		
}
// Se traen todos los datos de mi usuario
$query = "SELECT idTelemetria, Fecha, Duracion, Resumen, Resolucion
FROM `telemetria_historial_mantencion`
WHERE idMantencion = {$_GET['id']}";
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

//Se buscan todos los archivos relacionados
$arrArchivos = array();
$query = "SELECT idArchivo, Nombre
FROM `telemetria_historial_mantencion_archivos`
WHERE idMantencion = {$_GET['id']}";
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
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar Mantencion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {    $x1  = $idTelemetria;    }else{$x1  = $rowdata['idTelemetria'];}
				if(isset($Fecha)) {           $x2  = $Fecha;           }else{$x2  = $rowdata['Fecha'];}
				if(isset($Duracion)) {        $x3  = $Duracion;        }else{$x3  = $rowdata['Duracion'];}
				if(isset($Resumen)) {         $x4  = $Resumen;         }else{$x4  = $rowdata['Resumen'];}
				if(isset($Resolucion)) {      $x5  = $Resolucion;      }else{$x5  = $rowdata['Resolucion'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				$Form_Imputs->form_date('Fecha Mantencion','Fecha', $x2, 2);
				$Form_Imputs->form_time('Duracion (Horas)','Duracion', $x3, 2, 2);
				$Form_Imputs->form_ckeditor('Resumen','Resumen', $x4, 2, 2);
				$Form_Imputs->form_ckeditor('Resolucion','Resolucion', $x5, 1, 2);
				
				echo '
				<div class="file-input theme-explorer">
					<div class="file-preview">
						<div class="close fileinput-remove">×</div>
						<div class="file-drop-disabled">
							<table class="table table-bordered table-hover">
								<tbody class="file-preview-thumbnails">';
									
									foreach ($arrArchivos as $archivos) {
										echo '
										<tr class="file-preview-frame explorer-frame  kv-preview-thumb" id="preview-1501701925613-0" data-fileindex="0" data-template="image">
											<td class="kv-file-content">
												<img src="upload/'.$archivos['Nombre'].'" style="width:auto;height:60px;">
											</td>
											<td class="file-details-cell">
												<div class="explorer-caption">'.$archivos['Nombre'].'</div>  
											</td>
											<td class="file-actions-cell">
												<div class="file-upload-indicator" title="No subido todavía">
													
												</div> 
												<div class="file-actions">
													<div class="file-footer-buttons">
														<div class="btn-group" style="width: 35px;" >';
															if ($rowlevel['level']>=4){
																$ubicacion = $location.'&del_img='.$archivos['idArchivo'];
																$dialogo   = '¿Realmente deseas eliminar el archivo '.$archivos['Nombre'].'?';
																echo '<a onClick="dialogBox(\''.$ubicacion.'\', \''.$dialogo.'\')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>';
															} 								
															echo '
														</div>      
													</div>
												</div>
											</td>
										</tr>';
									}
									
									echo '
								</tbody>
							</table>
						</div>
					</div>
				</div>';
				
				$Form_Imputs->form_multiple_upload('Archivos Adjuntos','files_adj', 20, '"jpg","png","gif","jpeg"');
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				
				
				
				$Form_Imputs->form_input_hidden('idMantencion', $_GET['id'], 2);
				?>
			
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {  
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "telemetria_listado.idSistema>=0";
}else{
	$z = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} ";		
}
?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Mantencion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {    $x1  = $idTelemetria;    }else{$x1  = '';}
				if(isset($Fecha)) {           $x2  = $Fecha;           }else{$x2  = '';}
				if(isset($Duracion)) {        $x3  = $Duracion;        }else{$x3  = '';}
				if(isset($Resumen)) {         $x4  = $Resumen;         }else{$x4  = '';}
				if(isset($Resolucion)) {      $x5  = $Resolucion;      }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				$Form_Imputs->form_date('Fecha Mantencion','Fecha', $x2, 2);
				$Form_Imputs->form_time('Duracion (Horas)','Duracion', $x3, 2, 2);
				$Form_Imputs->form_ckeditor('Resumen','Resumen', $x4, 2, 2);
				$Form_Imputs->form_ckeditor('Resolucion','Resolucion', $x5, 1, 2);
				
				$Form_Imputs->form_multiple_upload('Archivos Adjuntos','files_adj', 20, '"doc","docx","pdf","jpg", "png", "gif", "jpeg"');
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'fecha_asc':     $order_by = 'ORDER BY telemetria_historial_mantencion.Fecha ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':    $order_by = 'ORDER BY telemetria_historial_mantencion.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'usuario_asc':   $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Usuario Ascendente';break;
		case 'usuario_desc':  $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Usuario Descendente';break;
		case 'equipo_asc':    $order_by = 'ORDER BY telemetria_listado.Nombre ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Equipo Ascendente'; break;
		case 'equipo_desc':   $order_by = 'ORDER BY telemetria_listado.Nombre DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Equipo Descendente';break;
		
		default: $order_by = 'ORDER BY telemetria_historial_mantencion.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY telemetria_historial_mantencion.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w = "telemetria_listado.idSistema>=0";
}else{
	$w = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} ";		
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_historial_mantencion.idMantencion!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){ $z .= " AND telemetria_historial_mantencion.idTelemetria=".$_GET['idTelemetria'];}
if(isset($_GET['Fecha']) && $_GET['Fecha'] != ''){               $z .= " AND telemetria_historial_mantencion.Fecha='".$_GET['Fecha']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idMantencion FROM `telemetria_historial_mantencion` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrMantenciones = array();
$query = "SELECT 
telemetria_historial_mantencion.idMantencion,
telemetria_historial_mantencion.Fecha,
usuarios_listado.Nombre AS Usuario,
telemetria_listado.Nombre AS Equipo

FROM `telemetria_historial_mantencion`
LEFT JOIN `telemetria_listado`   ON telemetria_listado.idTelemetria   = telemetria_historial_mantencion.idTelemetria
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario        = telemetria_historial_mantencion.idUsuario
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrMantenciones,$row );
}?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Mantencion</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {    $x1  = $idTelemetria;    }else{$x1  = '';}
				if(isset($Fecha)) {           $x2  = $Fecha;           }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x1, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x1, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				
				}
				$Form_Imputs->form_date('Fecha Mantencion','Fecha', $x2, 1);
				
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                      
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Mantenciones</h5>
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tecnico</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=usuario_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=usuario_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Equipo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=equipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=equipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrMantenciones as $mant) { ?>
					<tr class="odd">
						<td><?php echo $mant['Fecha']; ?></td>
						<td><?php echo $mant['Usuario']; ?></td>
						<td><?php echo $mant['Equipo']; ?></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_telemetria_mantencion.php?view='.$mant['idMantencion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$mant['idMantencion']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$mant['idMantencion'];
									$dialogo   = '¿Realmente deseas eliminar la mantencion del equipo '.$mant['Equipo'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
								<?php } ?>								
							</div>
						</td>
					</tr>
				<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>
<?php widget_modal(80, 95); ?>
<?php } ?>          
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
