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
$original = "bodegas_productos_gasto.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){         $location .= "&idBodega=".$_GET['idBodega'];                $search .= "&idBodega=".$_GET['idBodega'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){      $location .= "&Observaciones=".$_GET['Observaciones'];      $search .= "&Observaciones=".$_GET['Observaciones'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'new_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if (!empty($_POST['submit_modBase'])){
	//Llamamos al formulario
	$form_trabajo= 'modBase_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if (!empty($_GET['clear_all'])){
	//Llamamos al formulario
	$form_trabajo= 'clear_all_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if (!empty($_POST['submit_modCentroCosto'])){
	//Llamamos al formulario
	$form_trabajo= 'modCentroCosto_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'new_prod_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para crear
if (!empty($_POST['submit_edit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'edit_prod_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//se borra un dato
if (!empty($_GET['del_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'del_prod_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_file'])){
	//Llamamos al formulario
	$form_trabajo= 'new_file_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//se borra un dato
if (!empty($_GET['del_file'])){
	//Llamamos al formulario
	$form_trabajo= 'del_file_gasto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
if (!empty($_GET['gasto_bodega'])){
	//Llamamos al formulario
	$form_trabajo= 'gasto_bodega';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Gasto Realizado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Gasto Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Gasto Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['addFile'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
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
//Traspaso la variable de bodega
$query = "SELECT  
productos_listado.idProducto, 
sistema_productos_uml.Nombre AS Unimed,
	(SELECT 
	SUM(Cantidad_ing) AS ingreso
	FROM `bodegas_productos_facturacion_existencias`
	WHERE idProducto = productos_listado.idProducto 
	AND idBodega=".$_SESSION['productos_gasto_basicos']['idBodega']." LIMIT 1) AS ingreso,
				
	(SELECT 
	SUM(Cantidad_eg) AS egreso
	FROM `bodegas_productos_facturacion_existencias`
	WHERE idProducto = productos_listado.idProducto 
	AND idBodega=".$_SESSION['productos_gasto_basicos']['idBodega']." LIMIT 1) AS egreso
FROM `productos_listado`
LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
WHERE productos_listado.idProducto='".$_SESSION['productos_gasto_productos'][$_GET['editProd']]['idProducto']."'
AND productos_listado.idEstado=1";
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
$row_data = mysqli_fetch_assoc ($resultado);	

$Total_existencias = $row_data['ingreso'] - $row_data['egreso'];

//filtro
$zx1 = "idProducto=0";
//Se revisan los permisos a los productos
$arrPermisos = array();
$query = "SELECT idProducto
FROM `core_sistemas_productos`
WHERE idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
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
array_push( $arrPermisos,$row );
}
foreach ($arrPermisos as $prod) {
	$zx1 .= " OR (idEstado=1 AND idProducto=".$prod['idProducto'].")";
}

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Productos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idProducto)){       $x1  = $idProducto;      }else{$x1  = $_SESSION['productos_gasto_productos'][$_GET['editProd']]['idProducto'];}
				if(isset($Number)){           $x2  = $Number;          }else{$x2  = $_SESSION['productos_gasto_productos'][$_GET['editProd']]['Number'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $zx1, '', $dbConn);
				$Form_Inputs->form_input_number('Cantidad', 'Number', $x2, 2);

				$Form_Inputs->form_input_disabled('Unidad de Medida','unimed', $row_data['Unimed']);
				$Form_Inputs->form_input_disabled('Existencias','Existencias', Cantidades_decimales_justos($Total_existencias));
				$Form_Inputs->form_input_disabled('Valor Unitario','Unitario', Cantidades_decimales_justos($_SESSION['productos_gasto_productos'][$_GET['editProd']]['ValorEgreso']));
				$Form_Inputs->form_input_hidden('ValorEgreso', Cantidades_decimales_justos($_SESSION['productos_gasto_productos'][$_GET['editProd']]['ValorEgreso']), 2);

				echo prod_print_venta($_SESSION['productos_gasto_basicos']['idBodega'], 'ValorEgreso', 'productos_listado','bodegas_productos_facturacion_existencias', 
									  'idProducto', 'unimed', 'Unitario', 'Existencias', 'ValorEgreso', $dbConn); 
				
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
//filtro
$zx1 = "productos_listado.idProducto=0";
//Se revisan los permisos a los productos
$arrPermisos = array();
$query = "SELECT idProducto
FROM `core_sistemas_productos`
WHERE idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
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
array_push( $arrPermisos,$row );
}
foreach ($arrPermisos as $prod) {
	$zx1 .= " OR (productos_listado.idEstado=1 AND productos_listado.idProducto=".$prod['idProducto'].")";
} 
$Form_Inputs = new Inputs();

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Productos</h5>
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
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->select_change('Producto','idProducto[]', 2, 'idProducto', 'Nombre', 'productos_listado', $zx1,'', 'OnSelectionChange',$dbConn); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->input_number('Cantidad','Number[]', '', 2); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->input_disabled('text', 'Unidad de medida', 'escribeme1', 0, 1); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->input_disabled('text', 'Valor Unitario', 'escribeme2', 0, 1); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 nopadding">
			<div class="form-group">
				<div class="input-group">
					<?php $Form_Inputs->input_disabled('text', 'Existencias', 'escribeme3', 0, 1); ?>
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
		//Imprimo las variables
		$arrTipo = array();
		$query = "SELECT 
		productos_listado.idProducto, 
		productos_listado.ValorIngreso,
		sistema_productos_uml.Nombre AS Unimed,
		
		(SELECT 
		SUM(Cantidad_ing) AS ingreso
		FROM `bodegas_productos_facturacion_existencias`
		WHERE idProducto = productos_listado.idProducto 
		AND idBodega=".$_SESSION['productos_gasto_basicos']['idBodega'].") AS ingreso,
					
		(SELECT 
		SUM(Cantidad_eg) AS egreso
		FROM `bodegas_productos_facturacion_existencias`
		WHERE idProducto = productos_listado.idProducto 
		AND idBodega=".$_SESSION['productos_gasto_basicos']['idBodega'].") AS egreso
		
		
		FROM `productos_listado`
		LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml   = productos_listado.idUml
		WHERE ".$zx1."
		ORDER BY productos_listado.idProducto ASC";
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
		array_push( $arrTipo,$row );
		}
				
		foreach ($arrTipo as $tipo) {
			$Total_existencias = $tipo['ingreso'] - $tipo['egreso'];
			echo 'let id_med_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';
			echo 'let id_value_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['ValorIngreso']).'";';	
			echo 'let id_exist_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($Total_existencias).'";';
		}
		?>
		let Componente = select.options[select.selectedIndex].value;
		if (Componente != "") {
			//escribo dentro del input
			$(select).closest('.prod_container').find('.escribeme1').val(eval("id_med_" + Componente));
			$(select).closest('.prod_container').find('.escribeme2').val(eval("id_value_" + Componente));
			$(select).closest('.prod_container').find('.escribeme3').val(eval("id_exist_" + Componente));
		}
    }
</script>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['modCentroCosto'])){
//sistema
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar Centro de Costo</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>
        	 
				<?php
				//Se verifican si existen los datos
				if(isset($idCentroCosto)){  $x1  = $idCentroCosto;  }else{$x1  = $_SESSION['productos_gasto_basicos']['idCentroCosto'];}
				if(isset($idLevel_1)){      $x2  = $idLevel_1;      }else{$x2  = $_SESSION['productos_gasto_basicos']['idLevel_1'];}
				if(isset($idLevel_2)){      $x3  = $idLevel_2;      }else{$x3  = $_SESSION['productos_gasto_basicos']['idLevel_2'];}
				if(isset($idLevel_3)){      $x4  = $idLevel_3;      }else{$x4  = $_SESSION['productos_gasto_basicos']['idLevel_3'];}
				if(isset($idLevel_4)){      $x5  = $idLevel_4;      }else{$x5  = $_SESSION['productos_gasto_basicos']['idLevel_4'];}
				if(isset($idLevel_5)){      $x6  = $idLevel_5;      }else{$x6  = $_SESSION['productos_gasto_basicos']['idLevel_5'];}

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
} elseif(!empty($_GET['modBase'])){
$z = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']; 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}  
?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar Datos Básicos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idBodega)){         $x1  = $idBodega;       }else{$x1  = $_SESSION['productos_gasto_basicos']['idBodega'];}
				if(isset($Observaciones)){    $x2  = $Observaciones;  }else{$x2  = $_SESSION['productos_gasto_basicos']['Observaciones'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodega', $x1, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x2, 2);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('Creacion_fecha', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idTipo', 3, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>

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
} elseif(!empty($_GET['view'])){ ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<div class="btn-group pull-right" role="group" aria-label="...">

		<?php
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

		<a href="<?php echo $location; ?>"  class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

		<?php
		$ubicacion = $location.'&view=true&gasto_bodega=true';
		$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?<br/>Revise si los <strong>montos</strong> y <strong>cantidades</strong> coinciden con el documento ingresado.'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>	

	</div>
	<div class="clearfix"></div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<div id="page-wrap">
		<div id="header"> <?php echo $_SESSION['productos_gasto_basicos']['TipoDocumento']; ?></div>
	   

		
		<div id="customer">

			<table id="meta" class="pull-left otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Básicos" class="btn btn-xs btn-primary pull-right tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Bodega Origen</td>
						<td><?php echo $_SESSION['productos_gasto_basicos']['Bodega']; ?></td>
					</tr>
					<tr>
						<td class="meta-head"><strong>Centro de Costo</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modCentroCosto=true' ?>" title="Modificar Centro de Costo" class="btn btn-xs btn-primary pull-right tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Centro de Costo</td>
						<td><?php echo $_SESSION['productos_gasto_basicos']['CentroCosto']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($_SESSION['productos_gasto_basicos']['Creacion_fecha']); ?></td>
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
					<td colspan="5">Productos a Consumir</td>
					<td><a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Producto" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Productos</a></td>
				</tr>
				<?php
				if (isset($_SESSION['productos_gasto_productos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['productos_gasto_productos'] as $key => $producto){ ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="4">
								<?php echo Cantidades_decimales_justos($producto['Number']).' '.$producto['Unimed'].' de '.$producto['Nombre']; ?>
							</td>
							<td class="item-name" align="right">
								<?php echo Valores($producto['ValorTotal'], 0).' ('.Valores($producto['ValorEgreso'], 0).' x '.$producto['Unimed'].')'; ?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editProd='.$producto['idProducto']; ?>" title="Editar Traspaso" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<?php
									$ubicacion = $location.'&del_prod='.$producto['idProducto'];
									$dialogo   = '¿Realmente deseas eliminar el producto '.str_replace('"','',$producto['Nombre']).'?'; ?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Producto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div>
							</td>
						</tr>
				<?php }
				} ?>

			</tbody>
		</table>
    </div>

    <div class="col-xs-12">
		<div class="row">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['productos_gasto_basicos']['Observaciones']; ?></p>
		</div>
	</div>

	<table id="items" style="margin-bottom: 20px;">
        <tbody>

			<tr>
                <th colspan="5">Archivos Adjuntos</th>
                <th width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></th>
            </tr>

			<?php
			if (isset($_SESSION['productos_gasto_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['productos_gasto_archivos'] as $key => $producto){ ?>
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
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro
$z = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']; 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
} ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Gasto</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idBodega)){         $x1  = $idBodega;       }else{$x1  = '';}
				if(isset($Observaciones)){    $x2  = $Observaciones;  }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodega', $x1, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x2, 2);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('Creacion_fecha', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idTipo', 3, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>

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
} else {
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
		case 'bodega_asc':   $order_by = 'bodegas_productos_listado.Nombre ASC ';                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Ascendente'; break;
		case 'bodega_desc':  $order_by = 'bodegas_productos_listado.Nombre DESC ';               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Bodega Descendente';break;
		case 'fecha_asc':    $order_by = 'bodegas_productos_facturacion.Creacion_fecha ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':   $order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;

		default: $order_by = 'ORDER BYbodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
$w = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$w .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
/**********************************************************/
//Variable con la ubicacion
$SIS_where = "bodegas_productos_facturacion.idTipo=3";//Solo gastos
$SIS_where.= " AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){       $SIS_where .= " AND bodegas_productos_facturacion.idBodegaDestino=".$_GET['idBodega'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){    $SIS_where .= " AND bodegas_productos_facturacion.Observaciones LIKE '%".EstandarizarInput($_GET['Observaciones'])."%'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idFacturacion', 'bodegas_productos_facturacion', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
bodegas_productos_facturacion.idFacturacion,
bodegas_productos_facturacion.Creacion_fecha,
bodegas_productos_listado.Nombre AS Bodega,
core_sistemas.Nombre AS Sistema';
$SIS_join  = '
LEFT JOIN `bodegas_productos_listado`   ON bodegas_productos_listado.idBodega      = bodegas_productos_facturacion.idBodegaOrigen
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema                 = bodegas_productos_facturacion.idSistema';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrTipo = array();
$arrTipo = db_select_array (false, $SIS_query, 'bodegas_productos_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){
		if (isset($_SESSION['productos_gasto_basicos']['idBodega'])&&$_SESSION['productos_gasto_basicos']['idBodega']!=''){ ?>

		<?php
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>

		<a href="<?php echo $location; ?>&view=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Gasto</a>
	<?php }else{ ?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Gasto</a>
	<?php }
	 } ?>
</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idBodega)){         $x1  = $idBodega;       }else{$x1  = '';}
				if(isset($Observaciones)){    $x2  = $Observaciones;  }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodega', $x1, 1, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $w, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x2, 1);

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Gastos</h5>
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
							<div class="pull-left">Bodega</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=bodega_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=bodega_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha de Gasto</div>
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
						<td><?php echo $tipo['Bodega']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_mov_productos.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
