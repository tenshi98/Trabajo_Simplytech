<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "bodegas_ingreso.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProveedor,idDocumentos,N_Doc,idBodega,idSistema,idUsuario,Creacion_fecha,idTipo';
	$form_trabajo= 'new_ingreso';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProveedor,idDocumentos,N_Doc,idBodega,idSistema,idUsuario,Creacion_fecha,idTipo';
	$form_trabajo= 'modBase_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para crear
if ( !empty($_POST['submit_prod']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProducto,Number,ValorIngreso';
	$form_trabajo= 'new_prod_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_prod']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProducto,Number,ValorIngreso';
	$form_trabajo= 'edit_prod_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'clear_all_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//se borra un dato
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_prod_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//se borra un dato
if ( !empty($_GET['add_obs']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'add_obs_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//se borra un dato
if ( !empty($_GET['del_obs']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_obs_ing';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
if ( !empty($_GET['ing_bodega']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'ing_bodega';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//se borra un dato
if ( !empty($_GET['addfpago']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'addfpago';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//se borra un dato
if ( !empty($_GET['delfpago']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'delfpago';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}

//formulario para crear
if ( !empty($_POST['submit_guia']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idGuia';
	$form_trabajo= 'new_guia';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//se borra un dato
if ( !empty($_GET['del_guia']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_guia';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//formulario para crear
if ( !empty($_POST['submit_impuesto']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idImpuesto';
	$form_trabajo= 'new_impuesto';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//se borra un dato
if ( !empty($_GET['del_impuesto']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_impuesto';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}


?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Ingreso Realizado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Ingreso Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Ingreso borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['editProd']) ) {
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z=" AND productos_listado.idRubro>=0";	
}else{
	$z=" AND productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
} 
$query = "SELECT  productos_uml.Nombre AS Unimed
FROM `productos_listado`
LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml
WHERE productos_listado.idProducto='{$_SESSION['ing_productos'][$_GET['editProd']]['idProducto']}'";
$resultado = mysqli_query ($dbConn, $query);
$row_data = mysqli_fetch_assoc ($resultado);	
?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar ingreso de Productos</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($idProducto)) {       $x1  = $idProducto;      }else{$x1  = $_SESSION['ing_productos'][$_GET['editProd']]['idProducto'];}
			if(isset($Number)) {           $x2  = $Number;          }else{$x2  = $_SESSION['ing_productos'][$_GET['editProd']]['Number'];}
			if(isset($ValorIngreso)) {     $x3  = $ValorIngreso;    }else{$x3  = $_SESSION['ing_productos'][$_GET['editProd']]['ValorIngreso']*$_SESSION['ing_productos'][$_GET['editProd']]['Number'];}
			
			//se dibujan los inputs
			echo form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', 'idTipoProducto!=2'.$z, $dbConn);
			echo form_input_number('Cantidad', 'Number', $x2, 2);
			
			echo '<div class="form-group" id="div_">
				<label class="control-label col-lg-4" id="label_">Unidad de Medida</label>
				<div class="col-lg-8">
					<input type="text" placeholder="Unidad de Medida" class="form-control"  name="escribeme" id="escribeme" disabled value="'.$row_data['Unimed'].'">
				</div>
			</div>';
			
			echo form_values('Valor Neto Total', 'ValorIngreso', $x3, 2);
			
			//Imprimo las variables
			$arrTipo = array();
			$query = "SELECT 
			productos_listado.idProducto,
			productos_uml.Nombre AS Unimed
			FROM `productos_listado`
			LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml
			ORDER BY productos_uml.Nombre";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTipo,$row );
			}
			
			echo '<script>';
			foreach ($arrTipo as $tipo) {
				echo 'var id_data_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
			}
			?>
			document.getElementById("idProducto").onchange = function() {myFunction()};

			function myFunction() {
				var Componente = document.getElementById("idProducto").value;
				if (Componente != "") {
					id_data=eval("id_data_" + Componente)
					//escribo dentro del input
					var elem = document.getElementById("escribeme");
					elem.value = id_data;
				}
			}
			</script>
          
			<div class="form-group">
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit_prod"> 
				<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addProd']) ) { 
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z=" AND productos_listado.idRubro>=0";	
}else{
	$z=" AND productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
} 
?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Productos</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
            <?php 
			//Se verifican si existen los datos
			if(isset($idProducto)) {       $x1  = $idProducto;      }else{$x1  = '';}
			if(isset($Number)) {           $x2  = $Number;          }else{$x2  = '';}
			if(isset($ValorIngreso)) {     $x3  = $ValorIngreso;    }else{$x3  = '';}
			
			//se dibujan los inputs
			echo form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', 'idTipoProducto!=2'.$z, $dbConn);
			echo form_input_number('Cantidad', 'Number', $x2, 2);
			
			echo '<div class="form-group" id="div_">
				<label class="control-label col-lg-4" id="label_">Unidad de Medida</label>
				<div class="col-lg-8">
					<input type="text" placeholder="Unidad de Medida" class="form-control"  name="escribeme" id="escribeme" disabled >
				</div>
			</div>';
			
			echo form_values('Valor Neto Total', 'ValorIngreso', $x3, 2);
			
			//Imprimo las variables
			$arrTipo = array();
			$query = "SELECT 
			productos_listado.idProducto,
			productos_uml.Nombre AS Unimed
			FROM `productos_listado`
			LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml
			ORDER BY productos_uml.Nombre";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrTipo,$row );
			}
			
			echo '<script>';
			foreach ($arrTipo as $tipo) {
				echo 'var id_data_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
			}
			?>
			document.getElementById("idProducto").onchange = function() {myFunction()};

			function myFunction() {
				var Componente = document.getElementById("idProducto").value;
				if (Componente != "") {
					id_data=eval("id_data_" + Componente)
					//escribo dentro del input
					var elem = document.getElementById("escribeme");
					elem.value = id_data;
				}
			}
			</script>
          
			<div class="form-group">
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_prod"> 
				<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addGuia']) ) { 
//filtro para el select
$z=" idDocumentos = 1 AND idEstado = 1 AND idProveedor = {$_SESSION['ing_basicos']['idProveedor']}";		 
?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Guias</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
            <?php 
			//Se verifican si existen los datos
			if(isset($idGuia )) {       $x1  = $idGuia ;      }else{$x1  = '';}
			
			//se dibujan los inputs
			echo form_select_filter_custom('Guias disponibles','idGuia', $x1, 2, 'idFacturacion', 'N_Doc', 'bodegas_facturacion', $z, 'N_Doc', $dbConn);

			?>

			<div class="form-group">
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_guia"> 
				<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addImpuesto']) ) { ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Impuestos</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
            <?php 
			//Se verifican si existen los datos
			if(isset($idImpuesto )) {       $x1  = $idImpuesto ;      }else{$x1  = '';}
			
			//se dibujan los inputs
			echo form_select('Impuestos','idImpuesto', $x1, 2, 'idImpuesto', 'Nombre', 'bodegas_impuestos', 0, $dbConn);

			?>

			<div class="form-group">
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_impuesto"> 
				<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="bodegas_listado.idSistema>=0";
}else{
	$z="bodegas_listado.idSistema={$arrUsuario['idSistema']} AND usuarios_bodegas_productos.idUsuario = {$arrUsuario['idUsuario']}";		
}
?>

<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar datos basicos del Ingreso</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
            <?php 
			//Se verifican si existen los datos
			if(isset($idProveedor)) {      $x1  = $idProveedor;    }else{$x1  = $_SESSION['ing_basicos']['idProveedor'];}
			if(isset($idDocumentos)) {     $x2  = $idDocumentos;   }else{$x2  = $_SESSION['ing_basicos']['idDocumentos'];}
            if(isset($N_Doc)) {            $x3  = $N_Doc;          }else{$x3  = $_SESSION['ing_basicos']['N_Doc'];}
            if(isset($Creacion_fecha)) {   $x4  = $Creacion_fecha; }else{$x4  = $_SESSION['ing_basicos']['Creacion_fecha'];}
            if(isset($idBodega)) {         $x5  = $idBodega;       }else{$x5  = $_SESSION['ing_basicos']['idBodega'];}
			if(isset($idSistema)) {        $x6  = $idSistema;      }else{$x6  = $_SESSION['ing_basicos']['idSistema'];}

			//se dibujan los inputs
			echo form_select_filter('Proveedor','idProveedor', $x1, 2, 'idProveedor', 'Nombre', 'proveedor_listado', 'idEstado=1', $dbConn);
			echo form_select('Tipo Documento','idDocumentos', $x2, 2, 'idDocumentos', 'Nombre', 'bodegas_documentos_mercantiles', 0, $dbConn);
			echo form_input_number('Numero de Documento', 'N_Doc', $x3, 2);
			echo form_date('F Documento','Creacion_fecha', $x4, 1);
			echo form_select_bodega('Bodega destino','idBodega', $x5, 2, 'idBodega', 'Nombre', 'bodegas_listado', 'usuarios_bodegas_productos', $z, $dbConn);
			
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x6, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}

			echo '<input type="hidden" name="idUsuario"   value="'.$arrUsuario['idUsuario'].'">';
			echo '<input type="hidden" name="idTipo"   value="1">';			
			?> 

			<div class="form-group">
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_modBase"> 
				<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['view']) ) { 
// Se trae el documento mercantil utilizado
$query = "SELECT Nombre
FROM `bodegas_documentos_mercantiles`
WHERE idDocumentos = {$_SESSION['ing_basicos']['idDocumentos']}";
$resultado = mysqli_query ($dbConn, $query);
$rowDocumento = mysqli_fetch_assoc ($resultado); 	

// Se trae el tipo de documento
$query = "SELECT Nombre
FROM `bodegas_facturacion_tipo`
WHERE idTipo = {$_SESSION['ing_basicos']['idTipo']}";
$resultado = mysqli_query ($dbConn, $query);
$rowTipoDocumento = mysqli_fetch_assoc ($resultado);	
	 
// Se trae la bodega
$query = "SELECT Nombre
FROM `bodegas_listado`
WHERE idBodega = {$_SESSION['ing_basicos']['idBodega']}";
$resultado = mysqli_query ($dbConn, $query);
$rowBodega = mysqli_fetch_assoc ($resultado);

// Se trae un listado con todos los productos
$arrProductos = array();
$query = "SELECT 
productos_listado.idProducto, 
productos_listado.Nombre,
productos_uml.Nombre AS Unimed
FROM `productos_listado` 
LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}

// Se trae el proveedor
$query = "SELECT Nombre
FROM `proveedor_listado`
WHERE idProveedor = {$_SESSION['ing_basicos']['idProveedor']}";
$resultado = mysqli_query ($dbConn, $query);
$rowProveedor = mysqli_fetch_assoc ($resultado);	

// Se trae un listado con todas las guias no pagadas de esta empresa
$arrGuias = array();
$query = "SELECT idFacturacion, N_Doc, ValorNeto
FROM `bodegas_facturacion`
WHERE idDocumentos = 1 AND idEstado = 1 AND idProveedor = {$_SESSION['ing_basicos']['idProveedor']}
ORDER BY N_Doc ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGuias,$row );
}


// Se trae un listado con todos los impuestos existentes
$arrImpuestos = array();
$query = "SELECT idImpuesto, Nombre, Porcentaje
FROM `bodegas_impuestos`
ORDER BY Nombre ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrImpuestos,$row );
}							
?>

<style>
#address {
    height: auto !important;
}
.otdata td {
    text-align: left !important;
}
.otdata{
	width: 65% !important;
}
.otdata2{
	width: 30% !important;
}
</style> 
<div class="col-lg-11 fcenter">

<div id="page-wrap">
    <div id="header"> <?php echo $rowTipoDocumento['Nombre']?></div>
   

    
    <div id="customer">
        
        <table id="meta" class="fleft otdata">
            <tbody>
                <tr>
                    <td class="meta-head"><strong>DATOS BASICOS</strong></td>
                    <td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" class="btn btn-xs btn-primary fright">Modificar</a></td>
                </tr>
                <tr>
                    <td class="meta-head">Proveedor</td>
                    <td><?php echo $rowProveedor['Nombre']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Documento</td>
                    <td><?php echo $rowDocumento['Nombre'].' N°'.$_SESSION['ing_basicos']['N_Doc']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Bodega Destino</td>
                    <td><?php echo $rowBodega['Nombre']?></td>
                </tr>
            </tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>
                <tr>
                    <td class="meta-head">Fecha Creacion</td>
                    <td colspan="2"><?php echo Fecha_estandar($_SESSION['ing_basicos']['Creacion_fecha'])?></td>
                </tr>
                <?php if($_SESSION['ing_basicos']['idDocumentos']==2){?>
					<tr>
						<td class="meta-head">Fecha de Pago</td>
						<?php if($_SESSION['ing_basicos']['Pago_fecha']!='0000-00-00'){?>
							<td><?php echo Fecha_estandar($_SESSION['ing_basicos']['Pago_fecha']);?></td>
							<td>
								<div class="btn-group" >
									<?php 
									$ubicacion = $location.'&view=true&delfpago=true';
									$dialogo   = '¿Realmente deseas eliminar la fecha de pago?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar fecha de termino" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>							
								</div>	
							</td>
						<?php }else{?>
							<td><?php echo input_date('Fecha Pago','f_pago', 2);?></td>
							<td>
								<div class="btn-group" >
									<?php $ubicacion=$location.'&view=true&addfpago=true';?>			
									<a onclick="addfpago('<?php echo $ubicacion ?>')"  data-placement="bottom" title="Asignar fecha de termino" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-check-square-o"></i></a>
								</div>	
							</td>
						<?php }?>
					</tr>
				<?php }?>
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
				<td colspan="5">Productos a Ingresar</td>
				<td><a href="<?php echo $location.'&addProd=true' ?>" class="btn btn-xs btn-primary fright">Agregar Productos</a></td>
			</tr>
			<?php 
			$total_neto = 0;
			if (isset($_SESSION['ing_productos'])){
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrProductos as $prod) { 
					foreach ($_SESSION['ing_productos'] as $key => $producto){
						if($prod['idProducto']==$producto['idProducto']){?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="2">
									<?php echo $prod['Nombre'];?>
								</td>
								<td class="item-name">
									<?php echo Cantidades_decimales_justos($producto['Number']).' '.$prod['Unimed'];?>
								</td>
								<td class="item-name">
									<?php echo Valores_sd(Cantidades_decimales_justos($producto['ValorIngreso'])).' x '.$prod['Unimed'];?>
								</td>
								<td class="item-name">
									<?php 
									$total_neto = $total_neto + ($producto['ValorIngreso']*$producto['Number']);
									echo 'Total '.Valores_sd(Cantidades_decimales_justos($producto['ValorIngreso']*$producto['Number']));?>
								</td>
								<td>
									<div class="btn-group" >
										<a href="<?php echo $location.'&editProd='.$producto['idProducto']; ?>" data-placement="bottom" title="Editar Ingreso" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a>
										<?php 
										$ubicacion = $location.'&del_prod='.$producto['idProducto'];
										$dialogo   = '¿Realmente deseas eliminar el producto '.$prod['Nombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Producto" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>								
									</div>
								</td>
							</tr> 
				  <?php }
					}
				}
			}?>
			
			<tr id="hiderow">
                <td colspan="6"><a name="Ancla_obs"></a></td>
            </tr>
			
			<?php if($_SESSION['ing_basicos']['idDocumentos']==2){ ?>
				
				<tr class="item-row fact_tittle">
					<td colspan="5">Guias de Despacho a Ingresar</td>
					<td><a href="<?php echo $location.'&addGuia=true' ?>" class="btn btn-xs btn-primary fright">Agregar Guia</a></td>
				</tr>
				<?php 
				if (isset($_SESSION['ing_guias'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($arrGuias as $guias) { 
						foreach ($_SESSION['ing_guias'] as $key => $producto){
							if($guias['idFacturacion']==$producto['idGuia']){?>
								<tr class="item-row linea_punteada">
									<td class="item-name" colspan="4">
										<?php echo 'Guia N°'.$guias['N_Doc'];?>
									</td>
									<td class="item-name">
										<?php 
										$total_neto = $total_neto + $guias['ValorNeto'];
										echo 'Total '.Valores_sd(Cantidades_decimales_justos($guias['ValorNeto']));?>
									</td>
									<td>
										<div class="btn-group" >
											<?php 
											$ubicacion = $location.'&del_guia='.$producto['idGuia'];
											$dialogo   = '¿Realmente deseas eliminar la guia N° '.$guias['N_Doc'].'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Guia" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>								
										</div>
									</td>
								</tr> 
					  <?php }
						}
					}
				}?>
				
				<tr id="hiderow">
					<td colspan="6"><a name="Ancla_obs"></a></td>
				</tr>
			
			<?php }?>
			
			
			
            <tr>
				<?php if(isset($_SESSION['ing_basicos']['Observaciones'])&&$_SESSION['ing_basicos']['Observaciones']!=''){ ?>
				
					<td colspan="5" class="blank word_break"> 
						<?php echo $_SESSION['ing_basicos']['Observaciones'];?>
					</td>
					<td class="blank">
						<div class="btn-group" >
							<?php 
							$ubicacion = $location.'&view=true&del_obs=true';
							$dialogo   = '¿Realmente deseas eliminar la observacion?';?>
							<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>							
						</div>
					</td>
                
				<?php }else{?>
					<td colspan="5" class="blank"> 
						<?php 
						$non = '';
						if(isset($_SESSION['ing_temporal'])&&$_SESSION['ing_temporal']!=''){
							$non = $_SESSION['ing_temporal'];
						}	
							
						echo input_textarea_obs('Observaciones','Observaciones', 1,'width:100%; height: 200px;', $non);?>
					</td>
					<td class="blank">
						<div class="btn-group" >
							<?php $ubicacion=$location.'&view=true&add_obs=true';?>			
							<a onclick="add_obs('<?php echo $ubicacion ?>')" data-placement="bottom" title="Agregar Observacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-check-square-o"></i></a>
						</div>
					</td>
					
				<?php }?>	
				
				
            </tr>
            <tr>
                <td colspan="6" class="blank"><p>Observaciones</p></td> 
            </tr>
            
            <?php  //seteo de variables
				$vtotal_neto = $total_neto;
				$vtotal_general = $total_neto;
				$_SESSION['ing_basicos']['valor_neto_fact'] = $total_neto;
				?>
				<tr class="invoice-total" bgcolor="#f1f1f1"><td colspan="5" align="right"><strong>Subtotal</strong> </td> <td align="right"><?php echo Valores_sd($vtotal_neto);?></td></tr>
				<tr class="invoice-total" bgcolor="#f1f1f1">
					<td colspan="5"></td>
					<td><a href="<?php echo $location.'&addImpuesto=true' ?>" class="btn btn-xs btn-primary fright">Agregar Impuestos</a></td>
				</tr>
				
				<?php 
				if (isset($_SESSION['ing_impuestos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($arrImpuestos as $impto) { 
						foreach ($_SESSION['ing_impuestos'] as $key => $producto){
							if($impto['idImpuesto']==$producto['idImpuesto']){
								//se hacen los calculos matematicos
								$vtotal_IVA = ($total_neto / 100) * $impto['Porcentaje'];
								$vtotal_general = $vtotal_general + $vtotal_IVA;
								//se guardan los valores en variables de sesion
								$_SESSION['ing_impuestos'][$producto['idImpuesto']]['valor'] = $vtotal_IVA;
								
								?>
								<tr class="invoice-total" bgcolor="#f1f1f1">
									<td colspan="5" align="right"><strong><?php echo $impto['Nombre'];?></strong></td>      
									<td align="right">
										<?php echo Valores_sd($vtotal_IVA);?>
										<div class="btn-group" >
											<?php 
											$ubicacion = $location.'&del_impuesto='.$impto['idImpuesto'];
											$dialogo   = '¿Realmente deseas eliminar el impuesto '.$impto['Nombre'].'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Impuesto" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>								
										</div>
									</td>
								</tr>
					  <?php }
						}
					}
				}
				//guardo el total
				$_SESSION['ing_basicos']['valor_total_fact'] = $vtotal_general;
				
				?>
				
				<tr class="invoice-total" bgcolor="#f1f1f1"><td colspan="5" align="right"> <strong>Total</strong></td>    <td align="right"><?php echo Valores_sd($vtotal_general);?></td></tr>
				
						
						
            
        </tbody>
    </table>
    	<div class="clearfix"></div>
    	<div class="col-lg-12 fcenter" style="margin-top:30px; margin-bottom:30px">   
        	<div class="clearfix"></div>
        </div>
    </div>


</div>


<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">

<?php 		
$ubicacion = $location.'&view=true&ing_bodega=true';
$dialogo   = '¿Realmente desea realizar el ingreso a bodega, una vez realizada no podra realizar cambios?';?>
<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width" data-original-title=""  title="">Realizar ingreso</a>			



<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>

<?php 
$ubicacion = $location.'&clear_all=true';
$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width dialogBox" data-original-title="" title="">Borrar Todo</a>




<div class="clearfix"></div>
</div> 


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="bodegas_listado.idSistema>=0";
}else{
	$z="bodegas_listado.idSistema={$arrUsuario['idSistema']} AND usuarios_bodegas_productos.idUsuario = {$arrUsuario['idUsuario']}";		
}?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Ingreso</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($idProveedor)) {      $x1  = $idProveedor;    }else{$x1  = '';}
			if(isset($idDocumentos)) {     $x2  = $idDocumentos;   }else{$x2  = '';}
            if(isset($N_Doc)) {            $x3  = $N_Doc;          }else{$x3  = '';}
            if(isset($Creacion_fecha)) {   $x4  = $Creacion_fecha; }else{$x4  = '';}
            if(isset($idBodega)) {         $x5  = $idBodega;       }else{$x5  = '';}
            if(isset($Observaciones)) {    $x6  = $Observaciones;  }else{$x6  = '';}
			if(isset($idSistema)) {        $x7  = $idSistema;      }else{$x7  = '';}

			//se dibujan los inputs
			echo form_select_filter('Proveedor','idProveedor', $x1, 2, 'idProveedor', 'Nombre', 'proveedor_listado', 'idEstado=1', $dbConn);
			echo form_select('Tipo Documento','idDocumentos', $x2, 2, 'idDocumentos', 'Nombre', 'bodegas_documentos_mercantiles', 0, $dbConn);
			echo form_input_number('Numero de Documento', 'N_Doc', $x3, 2);
			echo form_date('F Documento','Creacion_fecha', $x4, 1);
			echo form_select_bodega('Bodega destino','idBodega', $x5, 2, 'idBodega', 'Nombre', 'bodegas_listado', 'usuarios_bodegas_productos', $z, $dbConn);
			echo form_textarea('Observaciones','Observaciones', $x6, 1);
			
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x7, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}

			echo '<input type="hidden" name="idUsuario"   value="'.$arrUsuario['idUsuario'].'">';
			echo '<input type="hidden" name="idTipo"   value="1">';			
			?>
			
			<div class="form-group">
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Crear Ingreso" name="submit">
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
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
//Variable con la ubicacion
$z="WHERE bodegas_facturacion.idTipo=1";//Solo ingresos
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND bodegas_facturacion.idSistema>=0";	
}else{
	$z.=" AND bodegas_facturacion.idSistema={$arrUsuario['idSistema']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `bodegas_facturacion` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrTipo = array();
$query = "SELECT 
bodegas_facturacion.idFacturacion,
bodegas_facturacion.Creacion_fecha,
bodegas_facturacion.N_Doc,
bodegas_listado.Nombre AS Bodega,
core_sistemas.Nombre AS Sistema,
bodegas_documentos_mercantiles.Nombre AS Documento,
proveedor_listado.Nombre AS Proveedor

FROM `bodegas_facturacion`
LEFT JOIN `bodegas_listado`                 ON bodegas_listado.idBodega                     = bodegas_facturacion.idBodegaDestino
LEFT JOIN `core_sistemas`                   ON core_sistemas.idSistema                      = bodegas_facturacion.idSistema
LEFT JOIN `bodegas_documentos_mercantiles`  ON bodegas_documentos_mercantiles.idDocumentos  = bodegas_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`               ON proveedor_listado.idProveedor                = bodegas_facturacion.idProveedor
".$z."
ORDER BY bodegas_facturacion.Creacion_fecha DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipo,$row );
}?>

<div class="form-group">
<?php if ($rowlevel['level']>=3){
	if (isset($_SESSION['ing_basicos']['idProveedor'])&&$_SESSION['ing_basicos']['idProveedor']!=''){?>
		<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" >Continuar Ingreso</a>
<?php }else{?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" >Crear Nuevo Ingreso</a>
<?php }
 }?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Ingresos</h5>
			<div class="toolbar">
				<?php 
				if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Bodega</th>
						<th>Proveedor</th>
						<th>Documento</th>
						<th>Fecha de Ingreso</th>
						<th>Sistema</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Bodega']; ?></td>
						<td><?php echo $tipo['Proveedor']; ?></td>
						<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<td><?php echo $tipo['Sistema']; ?></td>
						<td>
							<div class="btn-group" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_doc.php?view='.$tipo['idFacturacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
							</div>
						</td>
					</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>
<?php } ?>           
			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
