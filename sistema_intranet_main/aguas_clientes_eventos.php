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
$original = "aguas_clientes_eventos.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){     $location .= "&idCliente=".$_GET['idCliente'];              $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){           $location .= "&idTipo=".$_GET['idTipo'];                    $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['FechaEjecucion']) && $_GET['FechaEjecucion']!=''){  $location .= "&FechaEjecucion=".$_GET['FechaEjecucion'];    $search .= "&FechaEjecucion=".$_GET['FechaEjecucion'];}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){             $location .= "&Fecha=".$_GET['Fecha'];                      $search .= "&Fecha=".$_GET['Fecha'];}
if(isset($_GET['NSello']) && $_GET['NSello']!=''){           $location .= "&NSello=".$_GET['NSello'];                    $search .= "&NSello=".$_GET['NSello'];}
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
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_eventos.php';
}
//formulario para crear
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_eventos.php';
}
//se borra un dato
if (!empty($_GET['del_Archivo'])){
	//Nueva ubicacion
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_Archivo';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_eventos.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_eventos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){  $error['created']  = 'sucess/Evento Creado correctamente';}
if (isset($_GET['edited'])){   $error['edited']   = 'sucess/Evento Modificado correctamente';}
if (isset($_GET['deleted'])){  $error['deleted']  = 'sucess/Evento Borrado correctamente';}
if (isset($_GET['del_arch'])){ $error['del_arch'] = 'sucess/Archivo Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);

/*******************************************************/
// consulto los datos
$SIS_query = 'idCliente, idTipo, FechaEjecucion, Fecha, NSello, Observacion, Archivo';
$SIS_join  = '';
$SIS_where = 'idEventos = '.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'aguas_clientes_eventos', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Indico el sistema
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND idEstado=1';

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar Evento</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idCliente)){        $x1  = $idCliente;         }else{$x1  = $rowdata['idCliente'];}
				if(isset($idTipo)){           $x2  = $idTipo;            }else{$x2  = $rowdata['idTipo'];}
				if(isset($FechaEjecucion)){   $x3  = $FechaEjecucion;    }else{$x3  = $rowdata['FechaEjecucion'];}
				if(isset($Fecha)){  $x4  = $Fecha;             }else{$x4  = $rowdata['Fecha'];}
				if(isset($NSello)){           $x5  = $NSello;            }else{$x5  = $rowdata['NSello'];}
				if(isset($Observacion)){      $x6  = $Observacion;       }else{$x6  = $rowdata['Observacion'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_select('Tipo de Evento','idTipo', $x2, 2, 'idTipo', 'Nombre', 'aguas_clientes_eventos_tipos', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Ejecucion','FechaEjecucion', $x3, 2);
				$Form_Inputs->form_date('Fecha Facturacion (9 del mes)','Fecha', $x4, 2);
				$Form_Inputs->form_input_icon('Numero de Sello', 'NSello', $x5, 1,'fa fa-barcode');
				$Form_Inputs->form_textarea('Observaciones', 'Observacion', $x6, 1);
				//si existe archivo se mustra previsualizador
				if(isset($rowdata['Archivo'])&&$rowdata['Archivo']!=''){ ?>

					<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 fcenter">
						<h3>Archivo</h3>
						<?php echo preview_docs(DB_SITE_REPO.DB_SITE_MAIN_PATH, 'upload/'.$rowdata['Archivo'], ''); ?>
					</div>
					<a href="<?php echo $location.'&id='.$_GET['id'].'&del_Archivo='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn" style="margin-top:10px;margin-bottom:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Archivo</a>
					<div class="clearfix"></div>

				<?php }else{
					$Form_Inputs->form_multiple_upload('Seleccionar Archivo','Archivo', 1, '"jpg", "png", "gif", "jpeg", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "rtf", "gz", "gzip", "7Z", "zip", "rar"');
				}

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idEventos', $_GET['id'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
			</form>
			<?php widget_validator(); ?>

		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//Indico el sistema
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Evento</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idCliente)){        $x1  = $idCliente;         }else{$x1  = '';}
				if(isset($idTipo)){           $x2  = $idTipo;            }else{$x2  = '';}
				if(isset($FechaEjecucion)){   $x3  = $FechaEjecucion;    }else{$x3  = '';}
				if(isset($Fecha)){  $x4  = $Fecha;             }else{$x4  = '';}
				if(isset($NSello)){           $x5  = $NSello;            }else{$x5  = '';}
				if(isset($Observacion)){      $x6  = $Observacion;       }else{$x6  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_select('Tipo de Evento','idTipo', $x2, 2, 'idTipo', 'Nombre', 'aguas_clientes_eventos_tipos', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Ejecucion','FechaEjecucion', $x3, 2);
				$Form_Inputs->form_date('Fecha Facturacion (9 del mes)','Fecha', $x4, 2);
				$Form_Inputs->form_input_icon('Numero de Sello', 'NSello', $x5, 1,'fa fa-barcode');
				$Form_Inputs->form_textarea('Observaciones', 'Observacion', $x6, 1);
				$Form_Inputs->form_multiple_upload('Seleccionar Archivo','Archivo', 1, '"jpg", "png", "gif", "jpeg", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "txt", "rtf", "gz", "gzip", "7Z", "zip", "rar"');

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
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
		case 'numero_asc':          $order_by = 'aguas_clientes_eventos.idEventos ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Numero Evento Ascendente'; break;
		case 'numero_desc':         $order_by = 'aguas_clientes_eventos.idEventos DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Numero Evento Descendente';break;
		case 'fecha_asc':           $order_by = 'aguas_clientes_eventos.Fecha ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':          $order_by = 'aguas_clientes_eventos.Fecha DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'identificador_asc':   $order_by = 'aguas_clientes_listado.Identificador ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente'; break;
		case 'identificador_desc':  $order_by = 'aguas_clientes_listado.Identificador DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Identificador Descendente';break;
		case 'creador_asc':         $order_by = 'usuarios_listado.Nombre ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Creador Ascendente';break;
		case 'creador_desc':        $order_by = 'usuarios_listado.Nombre DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Creador Descendente';break;
		case 'tipo_asc':            $order_by = 'aguas_clientes_eventos_tipos.Nombre ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Ascendente';break;
		case 'tipo_desc':           $order_by = 'aguas_clientes_eventos_tipos.Nombre DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Descendente';break;

		default: $order_by = 'aguas_clientes_eventos.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'aguas_clientes_eventos.Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "aguas_clientes_eventos.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){       $SIS_where .= " AND aguas_clientes_eventos.idCliente='".$_GET['idCliente']."'";}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){             $SIS_where .= " AND aguas_clientes_eventos.idTipo='".$_GET['idTipo']."'";}
if(isset($_GET['FechaEjecucion']) && $_GET['FechaEjecucion']!=''){    $SIS_where .= " AND aguas_clientes_eventos.FechaEjecucion='".$_GET['FechaEjecucion']."'";}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){               $SIS_where .= " AND aguas_clientes_eventos.Fecha='".$_GET['Fecha']."'";}
if(isset($_GET['NSello']) && $_GET['NSello']!=''){             $SIS_where .= " AND aguas_clientes_eventos.NSello='".$_GET['NSello']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'aguas_clientes_eventos.idEventos', 'aguas_clientes_eventos', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
aguas_clientes_eventos.idEventos,
aguas_clientes_eventos.Fecha,
aguas_clientes_listado.Identificador,
usuarios_listado.Nombre AS Creador,
aguas_clientes_eventos_tipos.Nombre AS Tipo,
core_sistemas.Nombre AS sistema';
$SIS_join  = '
LEFT JOIN `core_sistemas`                 ON core_sistemas.idSistema                = aguas_clientes_eventos.idSistema
LEFT JOIN `aguas_clientes_listado`        ON aguas_clientes_listado.idCliente       = aguas_clientes_eventos.idCliente
LEFT JOIN `aguas_clientes_eventos_tipos`  ON aguas_clientes_eventos_tipos.idTipo    = aguas_clientes_eventos.idTipo
LEFT JOIN `usuarios_listado`              ON usuarios_listado.idUsuario             = aguas_clientes_eventos.idUsuario';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrUsers = array();
$arrUsers = db_select_array (false, $SIS_query, 'aguas_clientes_eventos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUsers');

//Indico el sistema
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Evento</a><?php } ?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idCliente)){        $x1  = $idCliente;         }else{$x1  = '';}
				if(isset($idTipo)){           $x2  = $idTipo;            }else{$x2  = '';}
				if(isset($FechaEjecucion)){   $x3  = $FechaEjecucion;    }else{$x3  = '';}
				if(isset($Fecha)){  $x4  = $Fecha;             }else{$x4  = '';}
				if(isset($NSello)){           $x5  = $NSello;            }else{$x5  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 1, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_select('Tipo de Evento','idTipo', $x2, 1, 'idTipo', 'Nombre', 'aguas_clientes_eventos_tipos', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Ejecucion','FechaEjecucion', $x3, 1);
				$Form_Inputs->form_date('Fecha Facturacion (9 del mes)','Fecha', $x4, 1);
				$Form_Inputs->form_input_icon('Numero de Sello', 'NSello', $x5, 1,'fa fa-barcode');

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Eventos</h5>
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
						<th>
							<div class="pull-left">Tipo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios){ ?>
					<tr class="odd">
						<td><?php echo n_doc($usuarios['idEventos'], 7); ?></td>
						<td><?php echo fecha_estandar($usuarios['Fecha']); ?></td>
						<td><?php echo $usuarios['Identificador']; ?></td>
						<td><?php echo $usuarios['Creador']; ?></td>
						<td><?php echo $usuarios['Tipo']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_aguas_eventos.php?view='.simpleEncode($usuarios['idEventos'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$usuarios['idEventos']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($usuarios['idEventos'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar el evento '.$usuarios['Tipo'].' del cliente '.$usuarios['Identificador'].'?'; ?>
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
