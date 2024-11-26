<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
$original = "aguas_analisis_parametros.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){  $location .= "&Nombre=".$_GET['Nombre'];         $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Codigo']) && $_GET['Codigo']!=''){  $location .= "&Codigo=".$_GET['Codigo'];         $search .= "&Codigo=".$_GET['Codigo'];}
if(isset($_GET['Rango_min']) && $_GET['Rango_min']!=''){   $location .= "&Rango_min=".$_GET['Rango_min'];   $search .= "&Rango_min=".$_GET['Rango_min'];}
if(isset($_GET['Rango_max']) && $_GET['Rango_max']!=''){   $location .= "&Rango_max=".$_GET['Rango_max'];   $search .= "&Rango_max=".$_GET['Rango_max'];}
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
	require_once 'A1XRXS_sys/xrxs_form/aguas_analisis_parametros.php';
}
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_analisis_parametros.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/aguas_analisis_parametros.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Parametro Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Parametro Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Parametro Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);

/*******************************************************/
// consulto los datos
$SIS_query = 'Nombre,Codigo, Rango_min, Rango_max';
$SIS_join  = '';
$SIS_where = 'idParametros = '.$_GET['id'];
$rowData = db_select_data (false, $SIS_query, 'aguas_analisis_parametros', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowData');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificación del Parametro</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;      }else{$x1  = $rowData['Nombre'];}
				if(isset($Codigo)){      $x2  = $Codigo;      }else{$x2  = $rowData['Codigo'];}
				if(isset($Rango_min)){   $x3  = $Rango_min;   }else{$x3  = Cantidades_decimales_justos($rowData['Rango_min']);}
				if(isset($Rango_max)){   $x4  = $Rango_max;   }else{$x4  = Cantidades_decimales_justos($rowData['Rango_max']);}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_text('Codigo', 'Codigo', $x2, 1);
				$Form_Inputs->form_input_number('Rango minimo', 'Rango_min', $x3, 1);
				$Form_Inputs->form_input_number('Rango maximo', 'Rango_max', $x4, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idParametros', $_GET['id'], 2);
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
}elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Parametro</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;      }else{$x1  = '';}
				if(isset($Codigo)){      $x2  = $Codigo;      }else{$x2  = '';}
				if(isset($Rango_min)){   $x3  = $Rango_min;   }else{$x3  = '';}
				if(isset($Rango_max)){   $x4  = $Rango_max;   }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_text('Codigo', 'Codigo', $x2, 1);
				$Form_Inputs->form_input_number('Rango minimo', 'Rango_min', $x3, 1);
				$Form_Inputs->form_input_number('Rango maximo', 'Rango_max', $x4, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
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
}else{
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
		case 'nombre_asc':        $order_by = 'aguas_analisis_parametros.Nombre ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':       $order_by = 'aguas_analisis_parametros.Nombre DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'codigo_asc':        $order_by = 'aguas_analisis_parametros.Codigo ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Codigo Ascendente'; break;
		case 'codigo_desc':       $order_by = 'aguas_analisis_parametros.Codigo DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Codigo Descendente';break;
		case 'rangomin_asc':      $order_by = 'aguas_analisis_parametros.Rango_min ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Rango minimo Ascendente'; break;
		case 'rangomin_desc':     $order_by = 'aguas_analisis_parametros.Rango_min DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Rango minimo Descendente';break;
		case 'rangomax_asc':      $order_by = 'aguas_analisis_parametros.Rango_max ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Rango maximo Ascendente'; break;
		case 'rangomax_desc':     $order_by = 'aguas_analisis_parametros.Rango_max DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Rango maximo Descendente';break;

		default: $order_by = 'aguas_analisis_parametros.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'aguas_analisis_parametros.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "aguas_analisis_parametros.idParametros!=0";
$SIS_where.= " AND aguas_analisis_parametros.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){    $SIS_where .= " AND aguas_analisis_parametros.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['Codigo']) && $_GET['Codigo']!=''){    $SIS_where .= " AND aguas_analisis_parametros.Codigo LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['Rango_min']) && $_GET['Rango_min']!=''){     $SIS_where .= " AND aguas_analisis_parametros.Rango_min='".$_GET['Nombre']."'";}
if(isset($_GET['Rango_max']) && $_GET['Rango_max']!=''){     $SIS_where .= " AND aguas_analisis_parametros.Rango_max='".$_GET['Nombre']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idParametros', 'aguas_analisis_parametros', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
aguas_analisis_parametros.idParametros,
aguas_analisis_parametros.Nombre,
aguas_analisis_parametros.Codigo, 
aguas_analisis_parametros.Rango_min,
aguas_analisis_parametros.Rango_max,
core_sistemas.Nombre AS sistema';
$SIS_join  = 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = aguas_analisis_parametros.idSistema';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrUML = array();
$arrUML = db_select_array (false, $SIS_query, 'aguas_analisis_parametros', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUML');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Búsqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Parametro</a><?php } ?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;     }else{$x1  = '';}
				if(isset($Codigo)){      $x2  = $Codigo;     }else{$x2  = '';}
				if(isset($Rango_min)){   $x3  = $Rango_min;  }else{$x3  = '';}
				if(isset($Rango_max)){   $x4  = $Rango_max;  }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 1);
				$Form_Inputs->form_input_text('Codigo', 'Codigo', $x2, 1);
				$Form_Inputs->form_input_number('Rango minimo', 'Rango_min', $x3, 1);
				$Form_Inputs->form_input_number('Rango maximo', 'Rango_max', $x4, 1);

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Parametros</h5>
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
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Codigo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=codigo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=codigo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Rango minimo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=rangomin_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=rangomin_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Rango Maximo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=rangomax_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=rangomax_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrUML as $uml) { ?>
					<tr class="odd">
						<td><?php echo $uml['Nombre']; ?></td>
						<td><?php echo $uml['Codigo']; ?></td>
						<td><?php echo Cantidades_decimales_justos($uml['Rango_min']); ?></td>
						<td><?php echo Cantidades_decimales_justos($uml['Rango_max']); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $uml['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$uml['idParametros']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($uml['idParametros'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar el parametro '.$uml['Nombre'].'?'; ?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
