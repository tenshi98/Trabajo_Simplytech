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
$original = "bodegas_productos_traspaso_empresa_manual.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];        $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano'] != ''){          $location .= "&Creacion_ano=".$_GET['Creacion_ano'];            $search .= "&Creacion_ano=".$_GET['Creacion_ano'];}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes'] != ''){          $location .= "&Creacion_mes=".$_GET['Creacion_mes'];            $search .= "&Creacion_mes=".$_GET['Creacion_mes'];}
if(isset($_GET['idBodegaOrigen']) && $_GET['idBodegaOrigen'] != ''){      $location .= "&idBodegaOrigen=".$_GET['idBodegaOrigen'];        $search .= "&idBodegaOrigen=".$_GET['idBodegaOrigen'];}
if(isset($_GET['idSistemaDestino']) && $_GET['idSistemaDestino'] != ''){  $location .= "&idSistemaDestino=".$_GET['idSistemaDestino'];    $search .= "&idSistemaDestino=".$_GET['idSistemaDestino'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones'] != ''){        $location .= "&Observaciones=".$_GET['Observaciones'];          $search .= "&Observaciones=".$_GET['Observaciones'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_traspasomanualempresa'; 
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modBase_traspasomanualmpresa';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all_traspasomanualempresa';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if ( !empty($_POST['submit_modCentroCosto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modCentroCosto_traspasomanualmpresa';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/*************************************************/
//formulario para crear
if ( !empty($_POST['submit_prod']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_prod_traspasomanualempresa';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_prod']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_prod_traspasomanualempresa';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//se borra un dato
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_prod_traspasomanualempresa';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';	
}
/*************************************************/
if ( !empty($_GET['trasp_bodega']) )     {
	//Llamamos al formulario
	$form_trabajo= 'traspasomanual_otra_empresa';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Traspaso Realizado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Traspaso Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Traspaso borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['editProd']) ) { 
$query = "SELECT
productos_listado.idProducto,  
sistema_productos_uml.Nombre AS Unimed,
productos_listado.ValorIngreso,
	(SELECT 
	SUM(Cantidad_ing) AS ingreso
	FROM `bodegas_productos_facturacion_existencias`
	WHERE idProducto = productos_listado.idProducto 
	AND idBodega=".$_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen']." LIMIT 1) AS ingreso,
				
	(SELECT 
	SUM(Cantidad_eg) AS egreso
	FROM `bodegas_productos_facturacion_existencias`
	WHERE idProducto = productos_listado.idProducto 
	AND idBodega=".$_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen']." LIMIT 1) AS egreso
FROM `productos_listado`
LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
WHERE productos_listado.idProducto='".$_SESSION['productos_traspasomanualempresa_productos'][$_GET['editProd']]['idProducto']."'
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPermisos,$row );
}
foreach ($arrPermisos as $prod) {
	$zx1 .= " OR (idEstado=1 AND idProducto={$prod['idProducto']})";
}
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Productos</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idProducto)) {       $x1  = $idProducto;      }else{$x1  = $_SESSION['productos_traspasomanualempresa_productos'][$_GET['editProd']]['idProducto'];}
				if(isset($Number)) {           $x2  = $Number;          }else{$x2  = $_SESSION['productos_traspasomanualempresa_productos'][$_GET['editProd']]['Number'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $zx1, '', $dbConn);
				$Form_Inputs->form_input_number('Cantidad', 'Number', $x2, 2);
				
				$Form_Inputs->form_input_disabled('Unidad de Medida','unimed', $row_data['Unimed'], 1);
				$Form_Inputs->form_input_disabled('Existencias','Existencias', Cantidades_decimales_justos($Total_existencias), 1);
				$Form_Inputs->form_input_disabled('Valor Unitario','Unitario', Cantidades_decimales_justos($_SESSION['productos_traspasomanualempresa_productos'][$_GET['editProd']]['ValorEgreso']), 1);
				$Form_Inputs->form_input_hidden('ValorEgreso', Cantidades_decimales_justos($_SESSION['productos_traspasomanualempresa_productos'][$_GET['editProd']]['ValorEgreso']), 2);
				
				echo prod_print_venta($bodega, 'ValorEgreso', 'productos_listado','bodegas_productos_facturacion_existencias', 
									  'idProducto', 'unimed', 'Unitario', 'Existencias', 'ValorEgreso', $dbConn); 
				
				$Form_Inputs->form_input_hidden('oldItemID', $_GET['editProd'], 2);
				?>
				
			  
				<div class="form-group">
					<input type="submit" id="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_prod"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addProd']) ) { 
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPermisos,$row );
}
foreach ($arrPermisos as $prod) {
	$zx1 .= " OR (productos_listado.idEstado=1 AND productos_listado.idProducto={$prod['idProducto']})";
}
$Form_Inputs = new Inputs();
?>

<div class="col-sm-12">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Productos</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<div class="col-sm-12 breadcrumb-bar" style="margin-bottom:10px;">
					<a onclick="producto_add();"  class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Nuevo</a>
				</div>
				<div class="clearfix"></div> 
				<div id="insert_producto"></div>
				
				<div class="form-group">
					<input type="submit" id="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_prod"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
				
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<div class="clearfix"></div>
			
<div style="display: none;"> 
	<div id="clone_producto" class="prod_container"> 	
		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->select_change('Producto','idProducto[]', 2, 'idProducto', 'Nombre', 'productos_listado', $zx1,'', 'OnSelectionChange',$dbConn); ?>	
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->input_number('Cantidad','Number[]', '', 2);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->input_disabled('text', 'Unidad de medida', 'escribeme1', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Inputs->input_disabled('text', 'Valor Unitario', 'escribeme2', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-3 nopadding">
			<div class="form-group">
				<div class="input-group">
					<?php $Form_Inputs->input_disabled('text', 'Existencias', 'escribeme3', 0, 1);?>
					<div class="input-group-btn">
						<button class="btn btn-metis-1 tooltip remove_producto" type="button" title="Borrar Informacion" > <i class="fa fa-trash-o" aria-hidden="true"></i> </button>
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
	function producto_add() { 
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
		AND idBodega=".$_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen'].") AS ingreso,
					
		(SELECT 
		SUM(Cantidad_eg) AS egreso
		FROM `bodegas_productos_facturacion_existencias`
		WHERE idProducto = productos_listado.idProducto 
		AND idBodega=".$_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen'].") AS egreso
		
		
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
		while ( $row = mysqli_fetch_assoc ($resultado)) {
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
 } elseif ( ! empty($_GET['modCentroCosto']) ) { 
//sistema
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";	
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar Centro de Costo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	 
				<?php 
				//Se verifican si existen los datos
				if(isset($idCentroCosto)) {  $x1  = $idCentroCosto;  }else{$x1  = $_SESSION['productos_traspasomanualempresa_basicos']['idCentroCosto'];}
				if(isset($idLevel_1)) {      $x2  = $idLevel_1;      }else{$x2  = $_SESSION['productos_traspasomanualempresa_basicos']['idLevel_1'];}
				if(isset($idLevel_2)) {      $x3  = $idLevel_2;      }else{$x3  = $_SESSION['productos_traspasomanualempresa_basicos']['idLevel_2'];}
				if(isset($idLevel_3)) {      $x4  = $idLevel_3;      }else{$x4  = $_SESSION['productos_traspasomanualempresa_basicos']['idLevel_3'];}
				if(isset($idLevel_4)) {      $x5  = $idLevel_4;      }else{$x5  = $_SESSION['productos_traspasomanualempresa_basicos']['idLevel_4'];}
				if(isset($idLevel_5)) {      $x6  = $idLevel_5;      }else{$x6  = $_SESSION['productos_traspasomanualempresa_basicos']['idLevel_5'];}
				
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
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modCentroCosto"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
$z = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];	
} 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar Datos Basicos</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	 
				<?php 
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)) {    $x1  = $Creacion_fecha;     }else{$x1  = $_SESSION['productos_traspasomanualempresa_basicos']['Creacion_fecha'];}
				if(isset($idBodegaOrigen)) {    $x2  = $idBodegaOrigen;     }else{$x2  = $_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen'];}
				if(isset($idSistemaDestino)) {  $x3  = $idSistemaDestino;   }else{$x3  = $_SESSION['productos_traspasomanualempresa_basicos']['idSistemaDestino'];}
				if(isset($Observaciones)) {     $x4  = $Observaciones;      }else{$x4  = $_SESSION['productos_traspasomanualempresa_basicos']['Observaciones'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Creacion_fecha', $x1, 2);
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodegaOrigen', $x2, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z, $dbConn);
				$Form_Inputs->form_select('Empresa Destino','idSistemaDestino', $x3, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 8, 2);			
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['view']) ) {
$Form_Inputs = new Inputs();
 	
//verifico los valores de los productos
$valor_0 = 0; 
if (isset($_SESSION['productos_traspasomanualempresa_productos'])){
	foreach ($_SESSION['productos_traspasomanualempresa_productos'] as $key => $producto){
		if($producto['ValorTotal']==0){$valor_0++;}
	}
}

if($valor_0!=0){
	echo '
	<div class="col-sm-12" >';
		$Alert_Text  = 'Uno de los productos seleccionados no tiene un precio asignado,';
		$Alert_Text .= 'vaya a la transaccion <strong>Administrar - Administrar productos - Tag Datos Comerciales</strong> y';
		$Alert_Text .= 'realice los cambios';
		alert_post_data(4,1,1, $Alert_Text);
				
	echo '
	</div>
	<div class="clearfix"></div>
	';
}else{ ?>
	
	<div class="clearfix"></div>
	<div class="col-sm-12" style="margin-bottom:30px">

	<?php 
	$ubicacion = $location.'&view=true&trasp_bodega=true';
	$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width"><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>	

	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

	<div class="clearfix"></div>
	</div> 
	
<?php } ?>
 
<div class="col-sm-12">

	<div id="page-wrap">
		<div id="header"> <?php echo $_SESSION['productos_traspasomanualempresa_basicos']['TipoDocumento']; ?></div>
	   

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary fright tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Bodega Origen</td>
						<td><?php echo $_SESSION['productos_traspasomanualempresa_basicos']['BodegaOrigen']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Empresa Destino</td>
						<td><?php echo $_SESSION['productos_traspasomanualempresa_basicos']['SistemaDestino']; ?></td>
					</tr>
					<tr>
						<td class="meta-head"><strong>Centro de Costo</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modCentroCosto=true' ?>" title="Modificar Centro de Costo" class="btn btn-xs btn-primary fright tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Centro de Costo</td>
						<td><?php echo $_SESSION['productos_traspasomanualempresa_basicos']['CentroCosto']; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($_SESSION['productos_traspasomanualempresa_basicos']['Creacion_fecha'])?></td>
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
					<td colspan="5">Productos a Traspasar</td>
					<td><a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Producto" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Productos</a></td>
				</tr>
				<?php
				//variable
				$valor_0 = 0; 
				//codigo 
				if (isset($_SESSION['productos_traspasomanualempresa_productos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['productos_traspasomanualempresa_productos'] as $key => $producto){?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="4">
								<?php echo Cantidades_decimales_justos($producto['Number']).' '.$prod['Unimed'].' de '.$prod['Nombre'];?>
							</td>
							<td class="item-name" align="right">
								<?php 
								//verifico si el valor es 0
								if($producto['ValorTotal']==0){$valor_0++;}
								echo Valores($producto['ValorTotal'], 0).' ('.Valores($producto['ValorEgreso'], 0).' x '.$prod['Unimed'].')';?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editProd='.$producto['idProducto']; ?>" title="Editar Traspaso" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<?php 
									$ubicacion = $location.'&del_prod='.$producto['idProducto'];
									$dialogo   = '¿Realmente deseas eliminar el registro '.str_replace('"','',$prod['Nombre']).'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Producto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
								</div>
							</td>
						</tr> 
				<?php }
				}?>
				
			</tbody>
		</table>
    </div>
    
    <div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['productos_traspasomanualempresa_basicos']['Observaciones'];?></p>
		</div>
	</div>


</div>



<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro
$z = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];	
}   ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Traspaso a otra empresa</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)) {    $x1  = $Creacion_fecha;     }else{$x1  = '';}
				if(isset($idBodegaOrigen)) {    $x2  = $idBodegaOrigen;     }else{$x2  = '';}
				if(isset($idSistemaDestino)) {  $x3  = $idSistemaDestino;   }else{$x3  = '';}
				if(isset($Observaciones)) {     $x4  = $Observaciones;      }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Creacion_fecha', $x1, 2);
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodegaOrigen', $x2, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z, $dbConn);
				$Form_Inputs->form_select('Empresa Destino','idSistemaDestino', $x3, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, '', $dbConn);	 
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 8, 2);			
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf046; Crear Documento" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
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
		case 'origen_asc':         $order_by = 'ORDER BY bodega1.Nombre ASC ';                                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Origen Ascendente'; break;
		case 'origen_desc':        $order_by = 'ORDER BY bodega1.Nombre DESC ';                               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Origen Descendente';break;
		case 'destino_asc':        $order_by = 'ORDER BY sisdestino.Nombre ASC ';                             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Destino Ascendente';break;
		case 'destino_desc':       $order_by = 'ORDER BY sisdestino.Nombre DESC ';                            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Destino Descendente';break;
		case 'fecha_asc':          $order_by = 'ORDER BY bodegas_productos_facturacion.Creacion_fecha ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':         $order_by = 'ORDER BY bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		
		default: $order_by = 'ORDER BY bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
$w = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$w .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];	
}
/**********************************************************/
//Variable con la ubicacion
$z="WHERE bodegas_productos_facturacion.idTipo=8";//Solo traspaso manual a otra empresa
//Verifico el tipo de usuario que esta ingresando
$z.=" AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){       $z .= " AND bodegas_productos_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano'] != ''){           $z .= " AND bodegas_productos_facturacion.Creacion_ano='".$_GET['Creacion_ano']."'";}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes'] != ''){           $z .= " AND bodegas_productos_facturacion.Creacion_mes='".$_GET['Creacion_mes']."'";}
if(isset($_GET['idBodegaOrigen']) && $_GET['idBodegaOrigen'] != ''){       $z .= " AND bodegas_productos_facturacion.idBodegaOrigen=".$_GET['idBodegaOrigen'];}
if(isset($_GET['idSistemaDestino']) && $_GET['idSistemaDestino'] != ''){   $z .= " AND bodegas_productos_facturacion.idSistemaDestino=".$_GET['idSistemaDestino'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones'] != ''){         $z .= " AND bodegas_productos_facturacion.Observaciones LIKE '%".$_GET['Observaciones']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `bodegas_productos_facturacion` ".$z;
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
$arrTipo = array();
$query = "SELECT 
bodegas_productos_facturacion.idFacturacion,
bodegas_productos_facturacion.Creacion_fecha,
bodega1.Nombre AS BodegaOrigen,
sisorigen.Nombre AS SistemaOrigen,
sisdestino.Nombre AS SistemaDestino

FROM `bodegas_productos_facturacion`
LEFT JOIN `bodegas_productos_listado`  bodega1     ON bodega1.idBodega         = bodegas_productos_facturacion.idBodegaOrigen
LEFT JOIN `core_sistemas`              sisorigen   ON sisorigen.idSistema      = bodegas_productos_facturacion.idSistema
LEFT JOIN `core_sistemas`              sisdestino  ON sisdestino.idSistema     = bodegas_productos_facturacion.idSistemaDestino
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
array_push( $arrTipo,$row );
}?>


<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){
		if (isset($_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen'])&&$_SESSION['productos_traspasomanualempresa_basicos']['idBodegaOrigen']!=''){?>
			
		<?php 
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
		
		<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Traspaso</a>
	<?php }else{?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Traspaso</a>
	<?php }
	 }?>
</div>  
<div class="clearfix"></div>                      
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)) {    $x1  = $Creacion_fecha;     }else{$x1  = '';}
				if(isset($Creacion_ano)) {      $x2  = $Creacion_ano;       }else{$x2  = '';}
				if(isset($Creacion_mes)) {      $x3  = $Creacion_mes;       }else{$x3  = '';}
				if(isset($idBodegaOrigen)) {    $x4  = $idBodegaOrigen;     }else{$x4  = '';}
				if(isset($idSistemaDestino)) {  $x5  = $idSistemaDestino;   }else{$x5  = '';}
				if(isset($Observaciones)) {     $x6  = $Observaciones;      }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Creacion_fecha', $x1, 1);
				$Form_Inputs->form_select_n_auto('Año Documento','Creacion_ano', $x2, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes Documento','Creacion_mes', $x3, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodegaOrigen', $x4, 1, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $w, $dbConn);
				$Form_Inputs->form_select('Empresa Destino','idSistemaDestino', $x5, 1, 'idSistema', 'Nombre', 'core_sistemas', 0, '', $dbConn);	 
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x6, 1, 160);
				
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Traspasos</h5>
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
							<div class="pull-left">Origen</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=origen_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=origen_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Destino</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=destino_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=destino_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha de Traspaso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>                    
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['SistemaOrigen'].' '.$tipo['BodegaOrigen']; ?></td>
						<td><?php echo $tipo['SistemaDestino']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_mov_productos.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
