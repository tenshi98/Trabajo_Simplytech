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
$original = "bodegas_insumos_ventas_nota_debito.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){                $location .= "&idCliente=".$_GET['idCliente'];                  $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos']!=''){          $location .= "&idDocumentos=".$_GET['idDocumentos'];            $search .= "&idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc']!=''){                        $location .= "&N_Doc=".$_GET['N_Doc'];                          $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];        $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano']!=''){          $location .= "&Creacion_ano=".$_GET['Creacion_ano'];            $search .= "&Creacion_ano=".$_GET['Creacion_ano'];}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes']!=''){          $location .= "&Creacion_mes=".$_GET['Creacion_mes'];            $search .= "&Creacion_mes=".$_GET['Creacion_mes'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){        $location .= "&Observaciones=".$_GET['Observaciones'];          $search .= "&Observaciones=".$_GET['Observaciones'];}
if(isset($_GET['idUsoIVA']) && $_GET['idUsoIVA']!=''){                  $location .= "&idUsoIVA=".$_GET['idUsoIVA'];                    $search .= "&idUsoIVA=".$_GET['idUsoIVA'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'new_egreso_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//formulario para editar
if (!empty($_POST['submit_modBase'])){
	//Llamamos al formulario
	$form_trabajo= 'modBase_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//formulario para editar
if (!empty($_GET['clear_all'])){
	//Llamamos al formulario
	$form_trabajo= 'clear_all_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//formulario para editar
if (!empty($_POST['submit_modCentroCosto'])){
	//Llamamos al formulario
	$form_trabajo= 'modCentroCosto_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'new_prod_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//formulario para crear
if (!empty($_POST['submit_edit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'edit_prod_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//se borra un dato
if (!empty($_GET['del_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'del_prod_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_otros'])){
	//Llamamos al formulario
	$form_trabajo= 'new_otros_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//formulario para crear
if (!empty($_POST['submit_edit_otros'])){
	//Llamamos al formulario
	$form_trabajo= 'edit_otros_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//se borra un dato
if (!empty($_GET['del_otros'])){
	//Llamamos al formulario
	$form_trabajo= 'del_otros_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_file'])){
	//Llamamos al formulario
	$form_trabajo= 'new_file_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//se borra un dato
if (!empty($_GET['del_file'])){
	//Llamamos al formulario
	$form_trabajo= 'del_file_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_impuesto'])){
	//Llamamos al formulario
	$form_trabajo= 'new_impuesto_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
//se borra un dato
if (!empty($_GET['del_impuesto'])){
	//Llamamos al formulario
	$form_trabajo= 'del_impuesto_egr_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
/**********************************************/
if (!empty($_GET['egr_bodega_nd'])){
	//Llamamos al formulario
	$form_trabajo= 'egr_bodega_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_insumos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Nota de Debito Realizada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Nota de Debito Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Nota de Debito Borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['addFile'])){ ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Subir Archivo</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off" novalidate>

					<?php
					//Se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"');

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['editProd'])){
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	sistema_productos_uml.Nombre AS Unimed,
	cliente_listado.Nombre AS Cliente';
	$SIS_join  = '
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml      = insumos_listado.idUml
	LEFT JOIN `cliente_listado`         ON cliente_listado.idCliente        = insumos_listado.idCliente';
	$SIS_where = 'insumos_listado.idProducto='.$_SESSION['insumos_egr_nd_productos'][$_GET['editProd']]['idProducto'];
	$SIS_where.= ' AND insumos_listado.idEstado=1';
	$row_data = db_select_data (false, $SIS_query, 'insumos_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'row_data');

	/*******************************************************/
	// consulto los datos
	$SIS_query = 'idProducto';
	$SIS_join  = '';
	$SIS_where = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$SIS_order = 0;
	$arrPermisos = array();
	$arrPermisos = db_select_array (false, $SIS_query, 'core_sistemas_insumos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrPermisos');

	/*******************************************************/
	//filtro
	$zx2 = "idProducto=0";
	foreach ($arrPermisos as $prod) {
		$zx2 .= " OR (idEstado=1 AND idProducto=".$prod['idProducto'].")";
	}

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Editar Insumos</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idProducto)){       $x1  = $idProducto;      }else{$x1  = $_SESSION['insumos_egr_nd_productos'][$_GET['editProd']]['idProducto'];}
					if(isset($Cantidad_eg)){      $x2  = $Cantidad_eg;     }else{$x2  = $_SESSION['insumos_egr_nd_productos'][$_GET['editProd']]['Cantidad_eg'];}
					if(isset($ValorTotal)){       $x3  = $ValorTotal;      }else{$x3  = $_SESSION['insumos_egr_nd_productos'][$_GET['editProd']]['ValorTotal'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_filter('Insumo','idProducto', $x1, 2, 'idProducto', 'Nombre', 'insumos_listado', $zx2, '', $dbConn);
					$Form_Inputs->form_input_number('Cantidad', 'Cantidad_eg', $x2, 2);

					if(isset($row_data['Cliente'])&&$row_data['Cliente']!=''){$prov=$row_data['Cliente'];}else{$prov='Sin cliente';}
					$Form_Inputs->form_input_disabled('Unidad de Medida','unimed', $row_data['Unimed']);
					$Form_Inputs->form_input_disabled('Cliente Actual','cliente', $prov);
					$Form_Inputs->form_input_disabled('Valor Unitario Neto','Unitario', Cantidades_decimales_justos($_SESSION['insumos_egr_nd_productos'][$_GET['editProd']]['ValorIngreso']));
					$Form_Inputs->form_input_number('Valor Total Neto', 'ValorTotal', $x3, 2);
					$Form_Inputs->form_input_hidden('ValorIngreso', Cantidades_decimales_justos($_SESSION['insumos_egr_nd_productos'][$_GET['editProd']]['ValorIngreso']), 2);

					echo sell_print_value('insumos_listado', 'idProducto', 'unimed', 'cliente', $dbConn);
					echo operacion_input('Cantidad_eg', 'ValorTotal', 'Unitario', 'ValorIngreso', 4);
					$Form_Inputs->form_input_hidden('oldItemID', $_GET['editProd'], 2);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_prod">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['addProd'])){
	/*******************************************************/
	// consulto los datos
	$SIS_query = 'idProducto';
	$SIS_join  = '';
	$SIS_where = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$SIS_order = 0;
	$arrPermisos = array();
	$arrPermisos = db_select_array (false, $SIS_query, 'core_sistemas_insumos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrPermisos');

	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	insumos_listado.idProducto,
	insumos_listado.ValorEgreso,
	clientes_listado.Nombre AS Cliente,
	sistema_productos_uml.Nombre AS Unimed';
	$SIS_join  = '
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml   = insumos_listado.idUml
	LEFT JOIN `clientes_listado`        ON clientes_listado.idCliente    = insumos_listado.idCliente';
	$SIS_where = "insumos_listado.idProducto=0";
	foreach ($arrPermisos as $prod) {
		$SIS_where .= " OR (insumos_listado.idEstado=1 AND insumos_listado.idProducto=".$prod['idProducto'].")";
	}
	$SIS_order = 'insumos_listado.idProducto ASC';
	$arrTipo = array();
	$arrTipo = db_select_array (false, $SIS_query, 'insumos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

	/*******************************************************/
	// Fromularios
	$Form_Inputs = new Inputs();

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Agregar Insumos</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar" style="margin-bottom:10px;">
						<a onclick="producto_add();"  class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Nuevo</a>
					</div>
					<div class="clearfix"></div>
					<div id="insert_producto"></div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_prod">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<div style="display: none;">
		<div id="clone_producto" class="prod_container">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
				<div class="form-group">
					<?php $Form_Inputs->select_change('Insumo','idProducto[]', 2, 'idProducto', 'Nombre', 'insumos_listado', $zx2,'', 'OnSelectionChange',$dbConn); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
				<div class="form-group">
					<?php $Form_Inputs->input_number('Cantidad','Cantidad_eg[]', '', 2); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
				<div class="form-group">
					<?php $Form_Inputs->input_disabled('text', 'Unidad de medida', 'escribeme1', 0, 1); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
				<div class="form-group">
					<?php $Form_Inputs->input_disabled('text', 'Cliente Actual', 'escribeme2', 0, 1); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-1 col-md-1 col-lg-1 nopadding">
				<div class="form-group">
					<?php $Form_Inputs->input_disabled('text', 'V Neto', 'escribeme3', 0, 1); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 nopadding">
				<div class="form-group">
					<div class="input-group">
						<?php $Form_Inputs->input_number('Valor Total Neto','ValorTotal[]', '', 2); ?>
						<div class="input-group-btn">
							<button class="btn btn-metis-1 tooltip remove_producto" type="button" title="Borrar Información" > <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

	</div>
	<div class="clearfix"></div>

	<script>

		let room = 0;

		/**********************************************************/
		//Se agrega producto
		function producto_add(){
			//se incrementa en 1
			room++;
			//se estancian los objetos a clonar
			let objTo    = document.getElementById('insert_producto');
			let objclone = document.getElementById('clone_producto'),
			//se clonan los div
			clone_producto = objclone.cloneNode(true);
			clone_producto.id = 'new_producto_'+room;
			//inserto dentro del div deseado
			objTo.appendChild(clone_producto);
		}

		//se eliminan filas
		$(document).on('click', '.remove_producto', function(e) {
			e.preventDefault();
			$(this).parent().parent().parent().parent().parent().remove();
		});
		/**********************************************************/
		//se ejecuta al cambiar
		function OnSelectionChange (select) {
			//variables varias
			<?php
			//recorro
			foreach ($arrTipo as $tipo) {
				echo 'let id_cli_'.$tipo['idProducto'].'= "'.$tipo['Cliente'].'";';
				echo 'let id_med_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';
				echo 'let id_value_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['ValorEgreso']).'";';
			}
			?>
			let Componente = select.options[select.selectedIndex].value;
			if (Componente != "") {
				//escribo dentro del input
				$(select).closest('.prod_container').find('.escribeme1').val(eval("id_med_" + Componente));
				$(select).closest('.prod_container').find('.escribeme2').val(eval("id_cli_" + Componente));
				$(select).closest('.prod_container').find('.escribeme3').val(eval("id_value_" + Componente));
			}
		}
	</script>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['addImpuesto'])){ ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Agregar Impuestos</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idImpuesto )){       $x1  = $idImpuesto ;      }else{$x1  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select('Impuestos','idImpuesto', $x1, 2, 'idImpuesto', 'Nombre', 'sistema_impuestos', 0, '', $dbConn);

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_impuesto">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['editOtros'])){  ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Editar Otros</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($Nombre)){  $x1  = $Nombre;  }else{$x1  = $_SESSION['insumos_egr_nd_otros'][$_GET['editOtros']]['Nombre'];}
					if(isset($vTotal)){  $x2  = $vTotal;  }else{$x2  = Cantidades_decimales_justos($_SESSION['insumos_egr_nd_otros'][$_GET['editOtros']]['vTotal']);}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
					$Form_Inputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);

					$Form_Inputs->form_input_hidden('oldidProducto', $_SESSION['insumos_egr_nd_otros'][$_GET['editOtros']]['idOtros'], 2);

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_otros">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['addOtros'])){  ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Agregar Otros</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($Nombre)){  $x1  = $Nombre;  }else{$x1  = '';}
					if(isset($vTotal)){  $x2  = $vTotal;  }else{$x2  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
					$Form_Inputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_otros">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['modCentroCosto'])){
	//sistema
	$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Modificar Centro de Costo</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idCentroCosto)){  $x1  = $idCentroCosto;  }else{$x1  = $_SESSION['insumos_egr_nd_basicos']['idCentroCosto'];}
					if(isset($idLevel_1)){      $x2  = $idLevel_1;      }else{$x2  = $_SESSION['insumos_egr_nd_basicos']['idLevel_1'];}
					if(isset($idLevel_2)){      $x3  = $idLevel_2;      }else{$x3  = $_SESSION['insumos_egr_nd_basicos']['idLevel_2'];}
					if(isset($idLevel_3)){      $x4  = $idLevel_3;      }else{$x4  = $_SESSION['insumos_egr_nd_basicos']['idLevel_3'];}
					if(isset($idLevel_4)){      $x5  = $idLevel_4;      }else{$x5  = $_SESSION['insumos_egr_nd_basicos']['idLevel_4'];}
					if(isset($idLevel_5)){      $x6  = $idLevel_5;      }else{$x6  = $_SESSION['insumos_egr_nd_basicos']['idLevel_5'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_depend5('Centro de Costo', 'idCentroCosto',  $x1,  2,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  $z,   0,
											'Nivel 1', 'idLevel_1',  $x2,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0,
											'Nivel 2', 'idLevel_2',  $x3,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
											'Nivel 3', 'idLevel_3',  $x4,  1,  'idLevel_3',  'Nombre',  'centrocosto_listado_level_3',  0,   0,
											'Nivel 4', 'idLevel_4',  $x5,  1,  'idLevel_4',  'Nombre',  'centrocosto_listado_level_4',  0,   0,
											'Nivel 5', 'idLevel_5',  $x6,  1,  'idLevel_5',  'Nombre',  'centrocosto_listado_level_5',  0,   0,
											$dbConn, 'form1');
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modCentroCosto">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['modBase'])){
	$z = "bodegas_insumos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1"; 
	//Verifico el tipo de usuario que esta ingresando
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
		$z.=" AND usuarios_bodegas_insumos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	}

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Modificar Datos Básicos</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idCliente)){          $x1  = $idCliente;        }else{$x1  = $_SESSION['insumos_egr_nd_basicos']['idCliente'];}
					if(isset($N_Doc)){              $x2  = $N_Doc;            }else{$x2  = $_SESSION['insumos_egr_nd_basicos']['N_Doc'];}
					if(isset($Creacion_fecha)){     $x3  = $Creacion_fecha;   }else{$x3  = $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'];}
					if(isset($idBodega)){           $x4  = $idBodega;         }else{$x4  = $_SESSION['insumos_egr_nd_basicos']['idBodega'];}
					if(isset($Observaciones)){      $x5  = $Observaciones;    }else{$x5  = $_SESSION['insumos_egr_nd_basicos']['Observaciones'];}
					if(isset($idUsoIVA)){           $x6  = $idUsoIVA;         }else{$x6  = $_SESSION['insumos_egr_nd_basicos']['idUsoIVA'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
					$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
					$Form_Inputs->form_date('F Documento','Creacion_fecha', $x3, 2);
					$Form_Inputs->form_select_join_filter('Bodega origen','idBodega', $x4, 2, 'idBodega', 'Nombre', 'bodegas_insumos_listado', 'usuarios_bodegas_insumos', $z, $dbConn);
					$Form_Inputs->form_textarea('Observaciones','Observaciones', $x5, 1);
					$Form_Inputs->form_post_data(1,1,1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opción <strong>SI</strong>, para el resto es de uso obligatorio la opción <strong>NO</strong>. ');
					$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x6, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);

					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
					$Form_Inputs->form_input_hidden('idTipo', 12, 2);
					$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
					$Form_Inputs->form_input_hidden('idDocumentos', 4, 2);

					?>

					<script>
						/**********************************************************************/
						$(document).ready(function(){
							document.getElementById('div_fecha_fact_desde').style.display = 'none';
							document.getElementById('div_fecha_fact_hasta').style.display = 'none';
							//se ejecuta al inicio
							LoadDocumentos(0);
						});

						/**********************************************************************/
						document.getElementById("idDocumentos").onchange = function() {LoadDocumentos(1)};

						/**********************************************************************/
						function LoadDocumentos(caseLoad){
							//obtengo los valores
							let idDocumentos = $("#idDocumentos").val();
							//selecciono
							switch(idDocumentos) {
								//Errores Conjuntos
								case '2':
									document.getElementById('div_fecha_fact_desde').style.display = '';
									document.getElementById('div_fecha_fact_hasta').style.display = '';
								break;
								default:
									document.getElementById('div_fecha_fact_desde').style.display = 'none';
									document.getElementById('div_fecha_fact_hasta').style.display = 'none';
									//Reseteo los valores a 0
									document.getElementsByName('fecha_fact_desde').value = "0";
									document.getElementsByName('fecha_fact_hasta').value = "0";
								break;
							}
						}

					</script>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase">
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['view'])){
	/*******************************************************/
	// Formularios
	$Form_Inputs = new Inputs();

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
		<div class="btn-group pull-right" role="group" aria-label="...">

			<?php
			$ubicacion = $location.'&clear_all=true';
			$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

			<a href="<?php echo $location; ?>"  class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

			<?php
			$ubicacion = $location.'&view=true&egr_bodega_nd=true';
			$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?<br/>Revise si los <strong>montos</strong> y <strong>cantidades</strong> coinciden con el documento ingresado.'; ?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>

		</div>
		<div class="clearfix"></div>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div id="page-wrap">
			<div id="header"> <?php echo $_SESSION['insumos_egr_nd_basicos']['TipoDocumento']; ?></div>

			<div id="customer">

				<table id="meta" class="pull-left otdata">
					<tbody>
						<tr>
							<td class="meta-head"><strong>DATOS BASICOS</strong></td>
							<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Básicos" class="btn btn-xs btn-primary tooltip pull-right" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
						</tr>
						<tr>
							<td class="meta-head">Cliente</td>
							<td><?php echo $_SESSION['insumos_egr_nd_basicos']['Cliente']; ?></td>
						</tr>
						<tr>
							<td class="meta-head">Documento</td>
							<td><?php echo $_SESSION['insumos_egr_nd_basicos']['Documento'].' N°'.$_SESSION['insumos_egr_nd_basicos']['N_Doc']?></td>
						</tr>
						<tr>
							<td class="meta-head">Bodega</td>
							<td><?php echo $_SESSION['insumos_egr_nd_basicos']['Bodega']; ?></td>
						</tr>
						<tr>
							<td class="meta-head"><strong>Centro de Costo</strong></td>
							<td class="meta-head"><a href="<?php echo $location.'&modCentroCosto=true' ?>" title="Modificar Centro de Costo" class="btn btn-xs btn-primary pull-right tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
						</tr>
						<tr>
							<td class="meta-head">Centro de Costo</td>
							<td><?php echo $_SESSION['insumos_egr_nd_basicos']['CentroCosto']; ?></td>
						</tr>
						<?php if(isset($_SESSION['insumos_egr_nd_basicos']['idUsoIVA'])&&$_SESSION['insumos_egr_nd_basicos']['idUsoIVA']==1){ ?>
							<tr>
								<td class="meta-head">Exento de IVA</td>
								<td>Factura exenta de IVA</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<table id="meta" class="otdata2">
					<tbody>
						<tr>
							<td class="meta-head">Fecha Creacion</td>
							<td colspan="2"><?php echo Fecha_estandar($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<table id="items">
				<tbody>

					<tr>
						<th colspan="5">Detalle</th>
						<th width="160">Acciones</th>
					</tr>

					<tr class="item-row fact_tittle">
						<td colspan="5">Insumo a Ingresar</td>
						<td>
							<a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Insumo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Insumo</a>
						</td>
					</tr>
					<?php
					$vtotal_neto = 0;
					if (isset($_SESSION['insumos_egr_nd_productos'])){
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['insumos_egr_nd_productos'] as $key => $producto){
							$vtotal_neto = $vtotal_neto + $producto['ValorTotal']; ?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="2">
									<?php echo $producto['Nombre']; ?>
								</td>
								<td class="item-name">
									<?php echo Cantidades_decimales_justos($producto['Cantidad_eg']).' '.$producto['Unimed']; ?>
								</td>
								<td class="item-name" align="right">
									<?php echo Valores(Cantidades_decimales_justos($producto['ValorIngreso']), 0).' x '.$producto['Unimed']; ?>
								</td>
								<td class="item-name" align="right">
									<?php echo 'Total '.Valores(Cantidades_decimales_justos($producto['ValorTotal']), 0); ?>
								</td>
								<td>
									<div class="btn-group" style="width: 70px;" >
										<a href="<?php echo $location.'&editProd='.$producto['idProducto']; ?>" title="Editar Insumo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<?php
										$ubicacion = $location.'&del_prod='.$producto['idProducto'];
										$dialogo   = '¿Realmente deseas eliminar el Insumo '.str_replace('"','',$producto['Nombre']).'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Insumo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</div>
								</td>
							</tr>
					<?php }
					}
					echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>'; ?>

					<tr class="item-row fact_tittle">
						<td colspan="5">Otros a Ingresar</td>
						<td><a href="<?php echo $location.'&addOtros=true' ?>" title="Agregar Otro" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Otros</a></td>
					</tr>
					<?php
					if (isset($_SESSION['insumos_egr_nd_otros'])){
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['insumos_egr_nd_otros'] as $key => $producto){
							$vtotal_neto = $vtotal_neto + $producto['vTotal']; ?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="4"><?php echo $producto['Nombre']; ?></td>
								<td class="item-name" align="right">
									<?php echo valores($producto['vTotal'], 0); ?>
								</td>
								<td>
									<div class="btn-group" style="width: 70px;" >
										<a href="<?php echo $location.'&editOtros='.$producto['idOtros']; ?>" title="Editar Otros" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<?php if(!isset($_GET['soli']) OR $_GET['soli']==''){ ?>
											<?php
											$ubicacion = $location.'&del_otros='.$producto['idOtros'];
											$dialogo   = '¿Realmente deseas eliminar  '.$producto['Nombre'].'?'; ?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Otros" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										<?php } ?>
									</div>
								</td>
							</tr>
						<?php
						}
					}
					echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>'; ?>

					<?php  //Guardo el neto
					$_SESSION['insumos_egr_nd_basicos']['valor_neto_fact'] = $vtotal_neto;
					?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Subtotal Neto</strong></td>
							<td align="right"><?php echo Valores($vtotal_neto, 0); ?></td>
							<td></td>
						</tr>

						<?php  //Guardo el neto imponible
						$_SESSION['insumos_egr_nd_basicos']['valor_neto_imp'] = $vtotal_neto;
						?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Neto Imponible</strong></td>
							<td align="right"><?php echo Valores($vtotal_neto, 0); ?></td>
							<td></td>
						</tr>

						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="5"><strong>Impuestos</strong></td>
							<td><a href="<?php echo $location.'&addImpuesto=true' ?>" title="Agregar Impuesto" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Impuestos</a></td>
						</tr>
						<?php
						if (isset($_SESSION['insumos_egr_nd_impuestos'])){
							//guardo el valor neto
							$tempa = $vtotal_neto;
							//recorro el lsiatdo entregado por la base de datos
							foreach ($_SESSION['insumos_egr_nd_impuestos'] as $key => $producto){
								//se hacen los calculos matematicos
								$vtotal_IVA = ($tempa / 100) * $producto['Porcentaje'];
								$vtotal_neto = $vtotal_neto + $vtotal_IVA;
								//se guardan los valores en variables de sesion
								$_SESSION['insumos_egr_nd_impuestos'][$producto['idImpuesto']]['valor'] = $vtotal_IVA;

								?>
								<tr class="invoice-total" bgcolor="#f1f1f1">
									<td colspan="4" align="right"><strong><?php echo $producto['Nombre'].' ('.Cantidades_decimales_justos($producto['Porcentaje']).'%)'; ?></strong></td>
									<td align="right">
										<?php echo Valores($vtotal_IVA, 0); ?>
									</td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<?php
											$ubicacion = $location.'&del_impuesto='.$producto['idImpuesto'];
											$dialogo   = '¿Realmente deseas eliminar el impuesto '.$producto['Nombre'].'?'; ?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Impuesto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										</div>
									</td>
								</tr>
						<?php }
						}
						//guardo el total
						$_SESSION['insumos_egr_nd_basicos']['valor_total_fact'] = $vtotal_neto; ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"> <strong>Total</strong></td>
							<td align="right"><?php echo Valores($vtotal_neto, 0); ?></td>
							<td></td>
						</tr>

				</tbody>
			</table>
		</div>

		<div class="col-xs-12">
			<div class="row">
				<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
				<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['insumos_egr_nd_basicos']['Observaciones']; ?></p>
			</div>
		</div>

		<table id="items" style="margin-bottom: 20px;">
			<tbody>

				<tr class="invoice-total" bgcolor="#f1f1f1">
					<td colspan="5">Archivos Adjuntos</td>
					<td width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></td>
				</tr>

				<?php
				if (isset($_SESSION['insumos_egr_nd_archivos'])){
					//recorro el lsiatdo entregado por la base de datos
					$numeral = 1;
					foreach ($_SESSION['insumos_egr_nd_archivos'] as $key => $producto){ ?>
						<tr class="item-row">
							<td colspan="5"><?php echo $numeral.' - '.$producto['Nombre']; ?></td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<?php
									$ubicacion = $location.'&del_file='.$producto['idFile'];
									$dialogo   = '¿Realmente deseas eliminar  '.str_replace('"','',$producto['Nombre']).'?'; ?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div>
							</td>
						</tr>

					<?php
					$numeral++;
					}
				} ?>

			</tbody>
		</table>

	</div>

	<div class="clearfix"></div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['new'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 3, $dbConn);
	//se crea filtro
	$z = "bodegas_insumos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
	//Verifico el tipo de usuario que esta ingresando
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
		$z .= " AND usuarios_bodegas_insumos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	} ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Ingresar Nota de Debito</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idCliente)){          $x1  = $idCliente;        }else{$x1  = '';}
					if(isset($N_Doc)){              $x2  = $N_Doc;            }else{$x2  = '';}
					if(isset($Creacion_fecha)){     $x3  = $Creacion_fecha;   }else{$x3  = '';}
					if(isset($idBodega)){           $x4  = $idBodega;         }else{$x4  = '';}
					if(isset($Observaciones)){      $x5  = $Observaciones;    }else{$x5  = '';}
					if(isset($idUsoIVA)){           $x6  = $idUsoIVA;         }else{$x6  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
					$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
					$Form_Inputs->form_date('F Documento','Creacion_fecha', $x3, 2);
					$Form_Inputs->form_select_join_filter('Bodega origen','idBodega', $x4, 2, 'idBodega', 'Nombre', 'bodegas_insumos_listado', 'usuarios_bodegas_insumos', $z, $dbConn);
					$Form_Inputs->form_textarea('Observaciones','Observaciones', $x5, 1);
					$Form_Inputs->form_post_data(1,1,1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opción <strong>SI</strong>, para el resto es de uso obligatorio la opción <strong>NO</strong>. ');
					$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x6, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);

					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
					$Form_Inputs->form_input_hidden('idTipo', 12, 2);
					$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
					$Form_Inputs->form_input_hidden('idDocumentos', 4, 2);

					?>

					<script>
						/**********************************************************************/
						$(document).ready(function(){
							document.getElementById('div_fecha_fact_desde').style.display = 'none';
							document.getElementById('div_fecha_fact_hasta').style.display = 'none';
						});

						/**********************************************************************/
						document.getElementById("idDocumentos").onchange = function() {LoadDocumentos(1)};

						/**********************************************************************/
						function LoadDocumentos(caseLoad){
							//obtengo los valores
							let idDocumentos = $("#idDocumentos").val();
							//selecciono
							switch(idDocumentos) {
								//Errores Conjuntos
								case '2':
									document.getElementById('div_fecha_fact_desde').style.display = '';
									document.getElementById('div_fecha_fact_hasta').style.display = '';
								break;
								default:
									document.getElementById('div_fecha_fact_desde').style.display = 'none';
									document.getElementById('div_fecha_fact_hasta').style.display = 'none';
									//Reseteo los valores a 0
									document.getElementsByName('fecha_fact_desde').value = "0";
									document.getElementsByName('fecha_fact_hasta').value = "0";
								break;
							}
						}

					</script>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf046; Crear Documento" name="submit">
						<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
	//Se inicializa el paginador de resultados
	//tomo el numero de la pagina si es que este existe
	if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
	//Defino la cantidad total de elementos por pagina
	$cant_reg = 30;
	//resto de variables
	if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
	/**********************************************************/
	//ordenamiento
	if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
		switch ($_GET['order_by']) {
			case 'cliente_asc':    $order_by = 'clientes_listado.Nombre ASC ';                        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Cliente Ascendente'; break;
			case 'cliente_desc':   $order_by = 'clientes_listado.Nombre DESC ';                       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Cliente Descendente';break;
			case 'fecha_asc':      $order_by = 'bodegas_insumos_facturacion.Creacion_fecha ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
			case 'fecha_desc':     $order_by = 'bodegas_insumos_facturacion.Creacion_fecha DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
			case 'doc_asc':        $order_by = 'core_documentos_mercantiles.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Documento Ascendente';break;
			case 'doc_desc':       $order_by = 'core_documentos_mercantiles.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Documento Descendente';break;

			default: $order_by = 'bodegas_insumos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
		}
	}else{
		$order_by = 'bodegas_insumos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
	/**********************************************************/
	//Verifico el tipo de usuario que esta ingresando
	$y = "bodegas_insumos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
		$y .= " AND usuarios_bodegas_insumos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	}
	/**********************************************************/
	//Variable con la ubicacion
	$SIS_where = "bodegas_insumos_facturacion.idTipo=12";//Solo ingresos
	$SIS_where.= " AND bodegas_insumos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando

	/**********************************************************/
	//Se aplican los filtros
	if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){                $SIS_where .= " AND bodegas_insumos_facturacion.idCliente=".$_GET['idCliente'];}
	if(isset($_GET['idDocumentos']) && $_GET['idDocumentos']!=''){          $SIS_where .= " AND bodegas_insumos_facturacion.idDocumentos=".$_GET['idDocumentos'];}
	if(isset($_GET['N_Doc']) && $_GET['N_Doc']!=''){                        $SIS_where .= " AND bodegas_insumos_facturacion.N_Doc LIKE '%".EstandarizarInput($_GET['N_Doc'])."%'";}
	if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){      $SIS_where .= " AND bodegas_insumos_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
	if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano']!=''){          $SIS_where .= " AND bodegas_insumos_facturacion.Creacion_ano='".$_GET['Creacion_ano']."'";}
	if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes']!=''){          $SIS_where .= " AND bodegas_insumos_facturacion.Creacion_mes='".$_GET['Creacion_mes']."'";}
	if(isset($_GET['Devolucion_fecha']) && $_GET['Devolucion_fecha']!=''){  $SIS_where .= " AND bodegas_insumos_facturacion.Devolucion_fecha='".$_GET['Devolucion_fecha']."'";}
	if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){                  $SIS_where .= " AND bodegas_insumos_facturacion.idBodega=".$_GET['idBodega'];}
	if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){        $SIS_where .= " AND bodegas_insumos_facturacion.Observaciones LIKE '%".EstandarizarInput($_GET['Observaciones'])."%'";}
	if(isset($_GET['idUsoIVA']) && $_GET['idUsoIVA']!=''){                  $SIS_where .= " AND bodegas_insumos_facturacion.idUsoIVA=".$_GET['idUsoIVA'];}

	/**********************************************************/
	//Realizo una consulta para saber el total de elementos existentes
	$cuenta_registros = db_select_nrows (false, 'idFacturacion', 'bodegas_insumos_facturacion', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
	//Realizo la operacion para saber la cantidad de paginas que hay
	$total_paginas = ceil($cuenta_registros / $cant_reg);
	// Se trae un listado con todos los elementos
	$SIS_query = '
	bodegas_insumos_facturacion.idFacturacion,
	bodegas_insumos_facturacion.Creacion_fecha,
	bodegas_insumos_facturacion.N_Doc,
	core_sistemas.Nombre AS Sistema,
	core_documentos_mercantiles.Nombre AS Documento,
	clientes_listado.Nombre AS Cliente';
	$SIS_join  = '
	LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                   = bodegas_insumos_facturacion.idSistema
	LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos  = bodegas_insumos_facturacion.idDocumentos
	LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                = bodegas_insumos_facturacion.idCliente';
	$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
	$arrTipo = array();
	$arrTipo = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

		<ul class="btn-group btn-breadcrumb pull-left">
			<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
			<li class="btn btn-default"><?php echo $bread_order; ?></li>
			<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
				<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
			<?php } ?>
		</ul>

		<?php if ($rowlevel['level']>=3){ ?>
			<?php if (isset($_SESSION['insumos_egr_nd_basicos']['idCliente'])&&$_SESSION['insumos_egr_nd_basicos']['idCliente']!=''){ ?>

				<?php
				$ubicacion = $location.'&clear_all=true';
				$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
				<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>

				<a href="<?php echo $location; ?>&view=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Nota de Debito</a>
			<?php }else{ ?>
				<a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Ingresar Nota de Debito</a>
			<?php } ?>
		<?php } ?>
	</div>
	<div class="clearfix"></div>
	<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
		<div class="well">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
					<?php
					//Se verifican si existen los datos
					if(isset($idCliente)){          $x1  = $idCliente;        }else{$x1  = '';}
					if(isset($N_Doc)){              $x2  = $N_Doc;            }else{$x2  = '';}
					if(isset($Creacion_fecha)){     $x3  = $Creacion_fecha;   }else{$x3  = '';}
					if(isset($Creacion_ano)){       $x4  = $Creacion_ano;     }else{$x4  = '';}
					if(isset($Creacion_mes)){       $x5  = $Creacion_mes;     }else{$x5  = '';}
					if(isset($idBodega)){           $x6  = $idBodega;         }else{$x6  = '';}
					if(isset($Observaciones)){      $x7  = $Observaciones;    }else{$x7  = '';}
					if(isset($idUsoIVA)){           $x8  = $idUsoIVA;         }else{$x8  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 1, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
					$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 1);
					$Form_Inputs->form_date('F Documento','Creacion_fecha', $x3, 1);
					$Form_Inputs->form_select_n_auto('Año Documento','Creacion_ano', $x4, 1, 2016, ano_actual());
					$Form_Inputs->form_select_filter('Mes Documento','Creacion_mes', $x5, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
					$Form_Inputs->form_select_join_filter('Bodega origen','idBodega', $x6, 1, 'idBodega', 'Nombre', 'bodegas_insumos_listado', 'usuarios_bodegas_insumos', $y, $dbConn);
					$Form_Inputs->form_textarea('Observaciones','Observaciones', $x7, 1);
					$Form_Inputs->form_post_data(1,1,1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opción <strong>SI</strong>, para el resto es de uso obligatorio la opción <strong>NO</strong>. ');
					$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x8, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);

					$Form_Inputs->form_input_hidden('pagina', 1, 1);
					$Form_Inputs->form_input_hidden('idDocumentos', 4, 2);
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
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Notas de Debito</h5>
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
								<div class="pull-left">Cliente</div>
								<div class="btn-group pull-right" style="width: 50px;" >
									<a href="<?php echo $location.'&order_by=cliente_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
									<a href="<?php echo $location.'&order_by=cliente_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
							<th>
								<div class="pull-left">Documento</div>
								<div class="btn-group pull-right" style="width: 50px;" >
									<a href="<?php echo $location.'&order_by=doc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
									<a href="<?php echo $location.'&order_by=doc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
							<th>
								<div class="pull-left">Fecha de Compra</div>
								<div class="btn-group pull-right" style="width: 50px;" >
									<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
									<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
							<th width="10">Acciones</th>
						</tr>
					</thead>

					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Cliente']; ?></td>
							<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_mov_insumos.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
