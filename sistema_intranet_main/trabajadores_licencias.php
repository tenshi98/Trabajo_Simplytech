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
$original = "trabajadores_licencias.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){      $location .= "&idTrabajador=".$_GET['idTrabajador'];       $search .= "&idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $location .= "&idUsuario=".$_GET['idUsuario'];             $search .= "&idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Fecha_inicio']) && $_GET['Fecha_inicio'] != ''){      $location .= "&Fecha_inicio=".$_GET['Fecha_inicio'];       $search .= "&Fecha_inicio=".$_GET['Fecha_inicio'];}
if(isset($_GET['Fecha_termino']) && $_GET['Fecha_termino'] != ''){    $location .= "&Fecha_termino=".$_GET['Fecha_termino'];     $search .= "&Fecha_termino=".$_GET['Fecha_termino'];}
if(isset($_GET['N_Dias']) && $_GET['N_Dias'] != ''){                  $location .= "&N_Dias=".$_GET['N_Dias'];                   $search .= "&N_Dias=".$_GET['N_Dias'];}
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
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_licencias.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_licencias.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_licencias.php';	
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Nueva ubicacion
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_file';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_licencias.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Licencia Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Licencia Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Licencia borrada correctamente';}
if (isset($_GET['delfile'])) {$error['usuario'] 	  = 'sucess/Archivo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
/************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT idTrabajador,Fecha_inicio, Fecha_termino, N_Dias,File_Licencia,Observacion, idSistema
FROM `trabajadores_licencias`
WHERE idLicencia = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion de la Licencia</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data">
			
				<?php
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {    $x1  = $idTrabajador;    }else{$x1  = $rowdata['idTrabajador'];}
				if(isset($Fecha_inicio)) {    $x2  = $Fecha_inicio;    }else{$x2  = $rowdata['Fecha_inicio'];}
				if(isset($Fecha_termino)) {   $x3  = $Fecha_termino;   }else{$x3  = $rowdata['Fecha_termino'];}
				if(isset($N_Dias)) {          $x4  = $N_Dias;          }else{$x4  = $rowdata['N_Dias'];}
				if(isset($Observacion)) {     $x5  = $Observacion;     }else{$x5  = $rowdata['Observacion'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Trabajador','idTrabajador', $x1, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Imputs->form_date('Fecha inicio','Fecha_inicio', $x2, 2);
				$Form_Imputs->form_date('Fecha termino','Fecha_termino', $x3, 2);
				$Form_Imputs->form_input_number('N° Dias', 'N_Dias', $x4, 2);
				$Form_Imputs->form_textarea('Observaciones','Observacion', $x5, 1, 160);
				
				if(isset($rowdata['File_Licencia'])&&$rowdata['File_Licencia']!=''){?>
        
					<div class="col-sm-10 fcenter">
						<h3>Archivo</h3>
						<?php echo preview_docs('upload', $rowdata['File_Licencia'], ''); ?>
					</div>
					<a href="<?php echo $location.'&id='.$_GET['id'].'&del_file='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" style="margin-top:10px;margin-bottom:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Archivo</a>
					<div class="clearfix"></div>
					
				<?php 
				}else{ 
					$Form_Imputs->form_multiple_upload('Seleccionar archivo','File_Licencia', 1, '"doc","docx","pdf","jpg", "png", "gif", "jpeg"');
							
				}
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idLicencia', $_GET['id'], 2);
				
				 
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
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Licencia</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data" >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {    $x1  = $idTrabajador;    }else{$x1  = '';}
				if(isset($Fecha_inicio)) {    $x2  = $Fecha_inicio;    }else{$x2  = '';}
				if(isset($Fecha_termino)) {   $x3  = $Fecha_termino;   }else{$x3  = '';}
				if(isset($N_Dias)) {          $x4  = $N_Dias;          }else{$x4  = '';}
				if(isset($Observacion)) {     $x5  = $Observacion;     }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Trabajador','idTrabajador', $x1, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Imputs->form_date('Fecha inicio','Fecha_inicio', $x2, 2);
				$Form_Imputs->form_date('Fecha termino','Fecha_termino', $x3, 2);
				$Form_Imputs->form_input_number('N° Dias', 'N_Dias', $x4, 2);
				$Form_Imputs->form_textarea('Observaciones','Observacion', $x5, 1, 160);
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','File_Licencia', 1, '"doc","docx","pdf","jpg", "png", "gif", "jpeg"');
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('Fecha_ingreso', fecha_actual(), 2);
				$Form_Imputs->form_input_hidden('idUso', 1, 2);
				
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
		case 'fecha_asc':        $order_by = 'ORDER BY trabajadores_licencias.Fecha_inicio ASC ';                                                                          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':       $order_by = 'ORDER BY trabajadores_licencias.Fecha_inicio DESC ';                                                                         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'ndias_asc':        $order_by = 'ORDER BY trabajadores_licencias.N_Dias ASC ';                                                                                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Dias Ascendente';break;
		case 'ndias_desc':       $order_by = 'ORDER BY trabajadores_licencias.N_Dias DESC ';                                                                               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Dias Descendente';break;
		case 'trabajador_asc':   $order_by = 'ORDER BY trabajadores_listado.ApellidoPat ASC, trabajadores_listado.ApellidoMat ASC, trabajadores_listado.Nombre ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Trabajador Ascendente'; break;
		case 'trabajador_desc':  $order_by = 'ORDER BY trabajadores_listado.ApellidoPat DESC, trabajadores_listado.ApellidoMat DESC, trabajadores_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Trabajador Descendente';break;
		case 'usuario_asc':      $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                                                                                      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Usuario Ascendente'; break;
		case 'usuario_desc':     $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                                                                                     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Usuario Descendente';break;
		
		default: $order_by = 'ORDER BY trabajadores_licencias.Fecha_inicio DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY trabajadores_licencias.Fecha_inicio DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE trabajadores_licencias.idLicencia!=0";
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){      $z .= " AND trabajadores_licencias.idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND trabajadores_licencias.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Fecha_inicio']) && $_GET['Fecha_inicio'] != ''){      $z .= " AND trabajadores_licencias.Fecha_inicio=".$_GET['Fecha_inicio'];}
if(isset($_GET['Fecha_termino']) && $_GET['Fecha_termino'] != ''){    $z .= " AND trabajadores_licencias.Fecha_termino=".$_GET['Fecha_termino'];}
if(isset($_GET['N_Dias']) && $_GET['N_Dias'] != ''){                  $z .= " AND trabajadores_licencias.N_Dias=".$_GET['N_Dias'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idLicencia FROM `trabajadores_licencias` 
LEFT JOIN `trabajadores_listado` ON trabajadores_listado.idTrabajador  = trabajadores_licencias.idTrabajador
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario         = trabajadores_licencias.idUsuario
LEFT JOIN `core_sistemas`        ON core_sistemas.idSistema            = trabajadores_licencias.idSistema
".$z;
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
$arrInasHoras = array();
$query = "SELECT 
trabajadores_licencias.idLicencia,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
trabajadores_listado.Nombre AS TrabNombre,
usuarios_listado.Nombre AS UserNombre,
trabajadores_licencias.Fecha_inicio,
trabajadores_licencias.Fecha_termino,
trabajadores_licencias.N_Dias,
core_sistemas.Nombre AS Sistema,
trabajadores_licencias.idUso

FROM `trabajadores_licencias`
LEFT JOIN `trabajadores_listado` ON trabajadores_listado.idTrabajador  = trabajadores_licencias.idTrabajador
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario         = trabajadores_licencias.idUsuario
LEFT JOIN `core_sistemas`        ON core_sistemas.idSistema            = trabajadores_licencias.idSistema
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
array_push( $arrInasHoras,$row );
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Licencia</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idTrabajador)) {    $x1  = $idTrabajador;    }else{$x1  = '';}
				if(isset($Fecha_inicio)) {    $x2  = $Fecha_inicio;    }else{$x2  = '';}
				if(isset($Fecha_termino)) {   $x3  = $Fecha_termino;   }else{$x3  = '';}
				if(isset($N_Dias)) {          $x4  = $N_Dias;          }else{$x4  = '';}
				if(isset($idUsuario)) {       $x5  = $idUsuario;       }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Trabajador','idTrabajador', $x1, 1, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $w, '', $dbConn);
				$Form_Imputs->form_date('Fecha inicio','Fecha_inicio', $x2, 1);
				$Form_Imputs->form_date('Fecha termino','Fecha_termino', $x3, 1);
				$Form_Imputs->form_input_number('N° Dias', 'N_Dias', $x4, 1);
				$Form_Imputs->form_select_join_filter('Usuario','idUsuario', $x5, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Licencias</h5>
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
						<th width="120">
							<div class="pull-left">Fechas</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">N° Dias</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=ndias_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=ndias_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Trabajador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=trabajador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=trabajador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Usuario</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=usuario_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=usuario_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrInasHoras as $plan) { ?>
					<tr class="odd">
						<td><?php echo fecha_estandar($plan['Fecha_inicio']).' al '.fecha_estandar($plan['Fecha_termino']); ?></td>
						<td><?php echo $plan['N_Dias']; ?></td>
						<td><?php echo $plan['TrabApellidoPat'].' '.$plan['TrabApellidoMat'].' '.$plan['TrabNombre']; ?></td>
						<td><?php echo $plan['UserNombre']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $plan['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_licencia.php?view='.$plan['idLicencia']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php 
								//mientras no haya sido utilizado se puede modificar y borrar el dato
								if(isset($plan['idUso'])&&$plan['idUso']==1){ ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$plan['idLicencia']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del='.$plan['idLicencia'];
										$dialogo   = '¿Realmente deseas eliminar la licencia del '.fecha_estandar($plan['Fecha_inicio']).'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
									<?php } ?>
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
