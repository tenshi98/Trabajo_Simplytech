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
$original = "alumnos_cursos.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){  $location .= "&Nombre=".$_GET['Nombre'];         $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Semanas']) && $_GET['Semanas']!=''){$location .= "&Semanas=".$_GET['Semanas'];       $search .= "&Semanas=".$_GET['Semanas'];}
if(isset($_GET['F_inicio']) && $_GET['F_inicio']!=''){     $location .= "&F_inicio=".$_GET['F_inicio'];     $search .= "&F_inicio=".$_GET['F_inicio'];}
if(isset($_GET['F_termino']) && $_GET['F_termino']!=''){   $location .= "&F_termino=".$_GET['F_termino'];   $search .= "&F_termino=".$_GET['F_termino'];}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){     $location .= "&idEstado=".$_GET['idEstado'];     $search .= "&idEstado=".$_GET['idEstado'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/alumnos_cursos.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/alumnos_cursos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Asignatura Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Asignatura Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Asignatura borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT  
alumnos_cursos.Nombre AS CursoNombre,
alumnos_cursos.Semanas AS CursoSemanas,
alumnos_cursos.F_inicio AS CursoF_inicio,
alumnos_cursos.F_termino AS CursoF_termino,
core_estados.Nombre AS CursoEstado,
core_sistemas.Nombre AS CursoSistema

FROM `alumnos_cursos`
LEFT JOIN `core_sistemas`       ON core_sistemas.idSistema      = alumnos_cursos.idSistema
LEFT JOIN `core_estados`        ON core_estados.idEstado        = alumnos_cursos.idEstado
WHERE alumnos_cursos.idCurso = ".$_GET['id'];
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

//Listado con los elearning
$arrElearnng = array();
$query = "SELECT 
alumnos_elearning_listado.Nombre AS NombreElearning

FROM `alumnos_cursos_elearning`
LEFT JOIN `alumnos_elearning_listado`   ON alumnos_elearning_listado.idElearning     = alumnos_cursos_elearning.idElearning
WHERE alumnos_cursos_elearning.idCurso = ".$_GET['id']."
ORDER BY alumnos_elearning_listado.Nombre ASC  ";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrElearnng,$row );
}

// Se trae un listado con todos los elementos
$arrArchivos = array();
$query = "SELECT idDocumentacion, File, Semana
FROM `alumnos_cursos_documentacion`
WHERE idCurso = ".$_GET['id'];
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrArchivos,$row );
}
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Asignatura', $rowdata['CursoNombre'], 'Resumen');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'alumnos_cursos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'alumnos_cursos_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'alumnos_cursos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'alumnos_cursos_elearning.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Elearning Asignados</a></li>
						<li class=""><a href="<?php echo 'alumnos_cursos_documentacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Documentos Relacionados</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="tab-content">
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/training.jpg">
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h2 class="text-primary">Datos Basicos</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['CursoNombre']; ?><br/>
							<?php /*<strong>Semanas : </strong><?php echo $rowdata['CursoSemanas'].' semanas de duracion'; ?><br/>
							<strong>Fecha de Inicio : </strong><?php echo Fecha_completa($rowdata['CursoF_inicio']); ?><br/>
							<strong>Fecha de Termino : </strong><?php echo Fecha_completa($rowdata['CursoF_termino']); ?><br/>*/ ?>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['CursoSistema']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['CursoEstado']; ?>
						</p>

						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Elearnings  Relacionados</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php foreach ($arrElearnng as $permiso){ ?>
									<tr><td><?php echo $permiso['NombreElearning']; ?></td></tr> 
								<?php } ?>
							</tbody>
						</table>
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos Relacionados</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php foreach ($arrArchivos as $ciudad) { ?>
									<tr class="odd">
										<?php /*<td><?php echo 'Semana '.$ciudad['Semana']; ?></td>*/ ?>
										<td><?php echo $ciudad['File']; ?></td>
										<td>
											<div class="btn-group" style="width: 70px;" >
												<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($ciudad['File'], fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						
				
					</div>
					<div class="clearfix"></div>
			
				</div>
			</div>
		
        </div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 } elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Asignatura</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x2  = $Nombre;      }else{$x2  = '';}
				/*if(isset($Semanas)){     $x3  = $Semanas;     }else{$x3  = '';}
				if(isset($F_inicio)){    $x4  = $F_inicio;    }else{$x4  = '';}
				if(isset($F_termino)){   $x5  = $F_termino;   }else{$x5  = '';}*/
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
				/*$Form_Inputs->form_select_n_auto('Semanas de Duracion','Semanas', $x3, 2, 1, 50);
				$Form_Inputs->form_date('F. Inicio','F_inicio', $x4, 1);
				$Form_Inputs->form_date('F. Termino','F_termino', $x5, 1);*/
					
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);	
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
/**********************************************************/
//paginador de resultados
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'alumnos_cursos.Nombre ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'alumnos_cursos.Nombre DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'semana_asc':    $order_by = 'alumnos_cursos.Semanas ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Semanas Ascendente'; break;
		case 'semana_desc':   $order_by = 'alumnos_cursos.Semanas DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Semanas Descendente';break;
		case 'fini_asc':      $order_by = 'alumnos_cursos.F_inicio ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Inicio Ascendente'; break;
		case 'fini_desc':     $order_by = 'alumnos_cursos.F_inicio DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Inicio Descendente';break;
		case 'fter_asc':      $order_by = 'alumnos_cursos.F_termino ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Termino Ascendente'; break;
		case 'fter_desc':     $order_by = 'alumnos_cursos.F_termino DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Termino Descendente';break;
		case 'estado_asc':    $order_by = 'core_estados.Nombre ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente'; break;
		case 'estado_desc':   $order_by = 'core_estados.Nombre DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;

		default: $order_by = 'alumnos_cursos.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'alumnos_cursos.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "alumnos_cursos.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){ $SIS_where .= " AND alumnos_cursos.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['Semanas']) && $_GET['Semanas']!=''){      $SIS_where .= " AND alumnos_cursos.Semanas='".$_GET['Semanas']."'";}
if(isset($_GET['F_inicio']) && $_GET['F_inicio']!=''){    $SIS_where .= " AND alumnos_cursos.F_inicio='".$_GET['F_inicio']."'";}
if(isset($_GET['F_termino']) && $_GET['F_termino']!=''){  $SIS_where .= " AND alumnos_cursos.F_termino='".$_GET['F_termino']."'";}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){    $SIS_where .= " AND alumnos_cursos.idEstado='".$_GET['idEstado']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idCurso', 'alumnos_cursos', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
alumnos_cursos.idCurso, 
alumnos_cursos.Nombre,
alumnos_cursos.Semanas, 
alumnos_cursos.F_inicio, 
alumnos_cursos.F_termino,
alumnos_cursos.idEstado,
core_estados.Nombre AS Estado,
core_sistemas.Nombre AS sistema';
$SIS_join  = '
LEFT JOIN `core_estados`    ON core_estados.idEstado    = alumnos_cursos.idEstado
LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema  = alumnos_cursos.idSistema';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrCiudad = array();
$arrCiudad = db_select_array (false, $SIS_query, 'alumnos_cursos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrCiudad');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Asignatura</a><?php } ?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;     }else{$x1  = '';}
				/*if(isset($Semanas)){     $x2  = $Semanas;    }else{$x2  = '';}
				if(isset($F_inicio)){    $x3  = $F_inicio;   }else{$x3  = '';}
				if(isset($F_termino)){   $x4  = $F_termino;  }else{$x4  = '';}*/
				if(isset($idEstado)){    $x5  = $idEstado;   }else{$x5  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 1);
				/*$Form_Inputs->form_select_n_auto('Semanas de Duracion','Semanas', $x2, 1, 1, 56);
				$Form_Inputs->form_date('F. Inicio','F_inicio', $x3, 1);
				$Form_Inputs->form_date('F. Termino','F_termino', $x4, 1);*/
				$Form_Inputs->form_select('Estado','idEstado', $x5, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);

				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>

			</form>
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div>
                       
                                 
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Asignaturas</h5>
			<div class="toolbar">
				<?php
				//Se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Nombre Asignatura</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php /*
						<th>
							<div class="pull-left">Semanas de Duracion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=semana_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=semana_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha Inicio</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fini_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fini_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha Termino</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fter_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fter_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>*/?>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrCiudad as $ciudad) { ?>
					<tr class="odd">
						<td><?php echo $ciudad['Nombre']; ?></td>
						<?php /*<td><?php echo $ciudad['Semanas']; ?></td>
						<td><?php echo fecha_estandar($ciudad['F_inicio']); ?></td>
						<td><?php echo fecha_estandar($ciudad['F_termino']); ?></td>*/ ?>
						<td><label class="label <?php if(isset($ciudad['idEstado'])&&$ciudad['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $ciudad['Estado']; ?></label></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $ciudad['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_alumno_curso.php?view='.simpleEncode($ciudad['idCurso'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$ciudad['idCurso']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($ciudad['idCurso'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la Asignatura '.$ciudad['Nombre'].'?';?>
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

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
