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
$original = "aguas_clientes_otros_cargos.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){            $location .= "&idCliente=".$_GET['idCliente'];              $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['FechaEjecucion']) && $_GET['FechaEjecucion'] != ''){  $location .= "&FechaEjecucion=".$_GET['FechaEjecucion'];    $search .= "&FechaEjecucion=".$_GET['FechaEjecucion'];}
if(isset($_GET['Fecha']) && $_GET['Fecha'] != ''){                    $location .= "&Fecha=".$_GET['Fecha'];                      $search .= "&Fecha=".$_GET['Fecha'];}
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
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_otros_cargos.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_otros_cargos.php';
}
//se borra un dato
if ( !empty($_GET['del_Archivo']) )     {
	//Nueva ubicacion
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_Archivo';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_otros_cargos.php';	
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_otros_cargos.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Cargo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Cargo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Cargo borrado correctamente';}
if (isset($_GET['del_arch'])) {$error['usuario'] 	  = 'sucess/Archivo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT idCliente, FechaEjecucion, Fecha, ValorCargo, Observacion, Archivo
FROM `aguas_clientes_otros_cargos`
WHERE idOtrosCargos = ".$_GET['id'];
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
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';	 
?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Modificar Cargo</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = $rowdata['idCliente'];}
				if(isset($FechaEjecucion)) {   $x2  = $FechaEjecucion;    }else{$x2  = $rowdata['FechaEjecucion'];}
				if(isset($Fecha)) {            $x3  = $Fecha;             }else{$x3  = $rowdata['Fecha'];}
				if(isset($ValorCargo)) {       $x4  = $ValorCargo;        }else{$x4  = cantidades_decimales_justos($rowdata['ValorCargo']);}
				if(isset($Observacion)) {      $x5  = $Observacion;       }else{$x5  = $rowdata['Observacion'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_date('Fecha Ejecucion','FechaEjecucion', $x2, 2);
				$Form_Inputs->form_date('Fecha Facturacion (9 del mes)','Fecha', $x3, 2);
				$Form_Inputs->form_values('Valor','ValorCargo', $x4, 2 );
				$Form_Inputs->form_textarea('Observaciones', 'Observacion', $x5, 1, 160);
				//si existe archivo se mustra previsualizador
				if(isset($rowdata['Archivo'])&&$rowdata['Archivo']!=''){?>
        
					<div class="col-sm-10 fcenter">
						<h3>Archivo</h3>
						<?php echo preview_docs('upload', $rowdata['Archivo'], '', '', ''); ?>
					</div>
					<a href="<?php echo $location.'&id='.$_GET['id'].'&del_Archivo='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" style="margin-top:10px;margin-bottom:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Archivo</a>
					<div class="clearfix"></div>
					
				<?php }else{
					$Form_Inputs->form_multiple_upload('Seleccionar Archivo','Archivo', 1, '"jpg", "png", "gif", "jpeg", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "rtf", "gz", "gzip", "7Z", "zip", "rar"');
				}
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idOtrosCargos', $_GET['id'], 2);
				?>
								
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php widget_validator(); ?>
			
			
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); 
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Crear Cargo</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = '';}
				if(isset($FechaEjecucion)) {   $x2  = $FechaEjecucion;    }else{$x2  = '';}
				if(isset($Fecha)) {            $x3  = $Fecha;             }else{$x3  = '';}
				if(isset($ValorCargo)) {       $x4  = $ValorCargo;        }else{$x4  = '';}
				if(isset($Observacion)) {      $x5  = $Observacion;       }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_date('Fecha Ejecucion','FechaEjecucion', $x2, 2);
				$Form_Inputs->form_date('Fecha Facturacion (9 del mes)','Fecha', $x3, 2);
				$Form_Inputs->form_values('Valor','ValorCargo', $x4, 2 );
				$Form_Inputs->form_textarea('Observaciones', 'Observacion', $x5, 1, 160);
				$Form_Inputs->form_multiple_upload('Seleccionar Archivo','Archivo', 1, '"jpg", "png", "gif", "jpeg", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "rtf", "gz", "gzip", "7Z", "zip", "rar"');
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				?>
								
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
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
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'numero_asc':          $order_by = 'ORDER BY aguas_clientes_otros_cargos.idOtrosCargos ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Numero Evento Ascendente'; break;
		case 'numero_desc':         $order_by = 'ORDER BY aguas_clientes_otros_cargos.idOtrosCargos DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Numero Evento Descendente';break;
		case 'fecha_asc':           $order_by = 'ORDER BY aguas_clientes_otros_cargos.Fecha ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':          $order_by = 'ORDER BY aguas_clientes_otros_cargos.Fecha DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'identificador_asc':   $order_by = 'ORDER BY aguas_clientes_listado.Identificador ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente'; break;
		case 'identificador_desc':  $order_by = 'ORDER BY aguas_clientes_listado.Identificador DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Identificador Descendente';break;
		case 'creador_asc':         $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Creador Ascendente';break;
		case 'creador_desc':        $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Creador Descendente';break;
							
		default: $order_by = 'ORDER BY aguas_clientes_otros_cargos.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY aguas_clientes_otros_cargos.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE aguas_clientes_otros_cargos.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){              $z .= " AND aguas_clientes_otros_cargos.idCliente='".$_GET['idCliente']."'";}
if(isset($_GET['FechaEjecucion']) && $_GET['FechaEjecucion'] != ''){    $z .= " AND aguas_clientes_otros_cargos.FechaEjecucion='".$_GET['FechaEjecucion']."'";}
if(isset($_GET['Fecha']) && $_GET['Fecha'] != ''){                      $z .= " AND aguas_clientes_otros_cargos.Fecha='".$_GET['Fecha']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT aguas_clientes_otros_cargos.idOtrosCargos FROM `aguas_clientes_otros_cargos` ".$z;
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
// Se trae un listado con todos los elementos
$arrUsers = array();
$query = "SELECT 
aguas_clientes_otros_cargos.idOtrosCargos,
aguas_clientes_otros_cargos.Fecha,
aguas_clientes_listado.Identificador,
usuarios_listado.Nombre AS Creador,
core_sistemas.Nombre AS sistema

FROM `aguas_clientes_otros_cargos`
LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema                = aguas_clientes_otros_cargos.idSistema
LEFT JOIN `aguas_clientes_listado`        ON aguas_clientes_listado.idCliente       = aguas_clientes_otros_cargos.idCliente
LEFT JOIN `usuarios_listado`              ON usuarios_listado.idUsuario             = aguas_clientes_otros_cargos.idUsuario
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
array_push( $arrUsers,$row );
}
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';	
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Cargo</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = '';}
				if(isset($FechaEjecucion)) {   $x3  = $FechaEjecucion;    }else{$x3  = '';}
				if(isset($Fecha)) {            $x4  = $Fecha;             }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 1, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_date('Fecha Ejecucion','FechaEjecucion', $x3, 1);
				$Form_Inputs->form_date('Fecha Facturacion (9 del mes)','Fecha', $x4, 1);
					
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Cargos</h5>	
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
							<div class="pull-left">N° Evento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=numero_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=numero_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Identificador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=identificador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=identificador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Creador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=creador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=creador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo n_doc($usuarios['idOtrosCargos'], 7); ?></td>		
						<td><?php echo fecha_estandar($usuarios['Fecha']); ?></td>		
						<td><?php echo $usuarios['Identificador']; ?></td>		
						<td><?php echo $usuarios['Creador']; ?></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_otros_cargos.php?view='.simpleEncode($usuarios['idOtrosCargos'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idOtrosCargos']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($usuarios['idOtrosCargos'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar el cargo del cliente '.$usuarios['Identificador'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
