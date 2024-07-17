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
$original = "bodegas_traspaso_empresa.php";
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
	$form_obligatorios = 'idBodegaOrigen,idBodegaDestino,idSistema,idUsuario,Creacion_fecha,idTipo,idSistemaDestino';
	$form_trabajo= 'new_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idBodegaOrigen,idBodegaDestino,idSistema,idUsuario,Creacion_fecha,idTipo,idSistemaDestino';
	$form_trabajo= 'modBase_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para crear
if ( !empty($_POST['submit_prod']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProducto,Number';
	$form_trabajo= 'new_prod_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_prod']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProducto,Number';
	$form_trabajo= 'edit_prod_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'clear_all_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';
}
//se borra un dato
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_prod_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//se borra un dato
if ( !empty($_GET['add_obs']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'add_obs_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
//se borra un dato
if ( !empty($_GET['del_obs']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_obs_traspasoempresa';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_bodega.php';	
}
if ( !empty($_GET['trasp_bodega']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'traspaso_otra_empresa';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Traspaso Realizado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Traspaso Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Traspaso borrado correctamente';}
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
$query = "SELECT  
productos_uml.Nombre AS Unimed,
productos_listado.ValorIngreso
FROM `productos_listado`
LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml
WHERE productos_listado.idProducto='{$_SESSION['traspasoempresa_productos'][$_GET['editProd']]['idProducto']}'";
$resultado = mysqli_query ($dbConn, $query);
$row_data = mysqli_fetch_assoc ($resultado);	
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
			if(isset($idProducto)) {       $x1  = $idProducto;      }else{$x1  = $_SESSION['traspasoempresa_productos'][$_GET['editProd']]['idProducto'];}
			if(isset($Number)) {           $x2  = $Number;          }else{$x2  = $_SESSION['traspasoempresa_productos'][$_GET['editProd']]['Number'];}
			
			//se dibujan los inputs
			echo form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', 'idTipoProducto!=2'.$z, $dbConn);
			echo form_input_number('Cantidad', 'Number', $x2, 2);
			
			echo '<div class="form-group" id="div_">
				<label class="control-label col-lg-4" id="label_">Unidad de Medida</label>
				<div class="col-lg-8">
					<input type="text" placeholder="Unidad de Medida" class="form-control"  name="escribeme" id="escribeme" disabled value="'.$row_data['Unimed'].'">
				</div>
			</div>';
			
			echo '<div class="form-group" id="div_">
				<label class="control-label col-lg-4" id="label_">Valor Unitario</label>
				<div class="col-lg-8">
					<input type="text" placeholder="Valor Unitario" class="form-control"  name="escribeme2" id="escribeme2" disabled value="'.Cantidades_decimales_justos($row_data['ValorIngreso']).'">
					<input type="hidden" name="ValorEgreso" id="ValorEgreso" value="'.Cantidades_decimales_justos($row_data['ValorIngreso']).'">
				</div>
			</div>';
			
			//Imprimo las variables
			$arrTipo = array();
			$query = "SELECT 
			productos_listado.idProducto,
			productos_listado.ValorIngreso,
			productos_uml.Nombre AS Unimed,
			productos_listado.idRubro
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
			foreach ($arrTipo as $tipo) {
				echo 'var id_rubro_'.$tipo['idProducto'].'= "'.$tipo['idRubro'].'";';	
			}
			foreach ($arrTipo as $tipo) {
				echo 'var valor_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['ValorIngreso']).'";';	
			}
			?>
			document.getElementById("idProducto").onchange = function() {myFunction()};

			function myFunction() {
				var Componente = document.getElementById("idProducto").value;
				var empresaOrigen = 1;//'.$arrUsuario['idRubro'].';
				if (Componente != "") {
					
					id_data=eval("id_data_" + Componente);
					id_rubro=eval("id_rubro_" + Componente);
					valor_data=eval("valor_data_" + Componente);
					
					if(id_rubro!=1){
						if(empresaOrigen!=id_rubro){
							dialogBox("#", "El rubro de la empresa de origen y el de destino es distinto, tenga en cuenta que no puede hacer este traspaso");
							document.getElementById("submit").style.display = 'none';
						}
					}else{
						//escribo dentro del input
						var elem = document.getElementById("escribeme");
						elem.value = id_data;
						document.getElementById("submit").style.display = 'inline';

						var elem2 = document.getElementById("escribeme2");
						var elem3 = document.getElementById("ValorEgreso");
						elem2.value = valor_data;
						elem3.value = valor_data;
					
					
					}
					
				}
			}
			</script>
          
			<div class="form-group">
				<input type="submit" id="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit_prod"> 
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
			
			//se dibujan los inputs
			echo form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', 'idTipoProducto!=2'.$z, $dbConn);
			echo form_input_number('Cantidad', 'Number', $x2, 2);
			
			echo '<div class="form-group" id="div_">
				<label class="control-label col-lg-4" id="label_">Unidad de Medida</label>
				<div class="col-lg-8">
					<input type="text" placeholder="Unidad de Medida" class="form-control"  name="escribeme" id="escribeme" disabled >
				</div>
			</div>';
			
			echo '<div class="form-group" id="div_">
				<label class="control-label col-lg-4" id="label_">Valor Unitario</label>
				<div class="col-lg-8">
					<input type="text" placeholder="Valor Unitario" class="form-control"  name="escribeme2" id="escribeme2" disabled >
					<input type="hidden" name="ValorEgreso" id="ValorEgreso" >
				</div>
			</div>';
			
			//Imprimo las variables
			$arrTipo = array();
			$query = "SELECT 
			productos_listado.idProducto,
			productos_listado.ValorIngreso,
			productos_uml.Nombre AS Unimed,
			productos_listado.idRubro
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
			foreach ($arrTipo as $tipo) {
				echo 'var id_rubro_'.$tipo['idProducto'].'= "'.$tipo['idRubro'].'";';	
			}
			foreach ($arrTipo as $tipo) {
				echo 'var valor_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['ValorIngreso']).'";';	
			}
			?>
			document.getElementById("idProducto").onchange = function() {myFunction()};

			function myFunction() {
				var Componente = document.getElementById("idProducto").value;
				var empresaOrigen = 1;//'.$arrUsuario['idRubro'].';
				if (Componente != "") {
					
					id_data=eval("id_data_" + Componente);
					id_rubro=eval("id_rubro_" + Componente);
					valor_data=eval("valor_data_" + Componente);
					
					if(id_rubro!=1){
						if(empresaOrigen!=id_rubro){
							dialogBox("#", "El rubro de la empresa de origen y el de destino es distinto, tenga en cuenta que no puede hacer este traspaso");
							document.getElementById("submit").style.display = 'none';
						}
					}else{
						//escribo dentro del input
						var elem = document.getElementById("escribeme");
						elem.value = id_data;
						document.getElementById("submit").style.display = 'inline';
						
						var elem2 = document.getElementById("escribeme2");
						var elem3 = document.getElementById("ValorEgreso");
						elem2.value = valor_data;
						elem3.value = valor_data;
					}
					
				}
			}
			</script>
          
			<div class="form-group">
				<input type="submit" id="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_prod"> 
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
			<h5>Modificar datos basicos del Traspaso</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	 
			<?php 
			//Se verifican si existen los datos
            if(isset($idBodegaOrigen)) {    $x1  = $idBodegaOrigen;     }else{$x1  = $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'];}
            if(isset($idSistemaDestino)) {  $x2  = $idSistemaDestino;   }else{$x2  = $_SESSION['traspasoempresa_basicos']['idSistemaDestino'];}
            if(isset($idBodegaDestino)) {   $x3  = $idBodegaDestino;    }else{$x3  = $_SESSION['traspasoempresa_basicos']['idBodegaDestino'];}
			if(isset($idSistema)) {         $x4  = $idSistema;          }else{$x4  = $_SESSION['traspasoempresa_basicos']['idSistema'];}

			//se dibujan los inputs
			echo form_select_bodega('Bodega Origen','idBodegaOrigen', $x1, 2, 'idBodega', 'Nombre', 'bodegas_listado', 'usuarios_bodegas_productos', $z, $dbConn);
			echo form_select_depend1('Empresa Destino','idSistemaDestino', $x2, 2, 'idSistema', 'Nombre', 'core_sistemas', 0,
							 'Bodega Destino','idBodegaDestino', $x3, 2, 'idBodega', 'idSistema', 'Nombre', 'bodegas_listado', 0, 
							 $dbConn, 'form1');
			
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x4, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}

			echo '<input type="hidden" name="idUsuario"   value="'.$arrUsuario['idUsuario'].'">';
			echo '<input type="hidden" name="Creacion_fecha"   value="'.fecha_actual().'">';
			echo '<input type="hidden" name="idTipo"   value="6">';			
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

// Se traen todos los datos de mi usuario
$query = "SELECT Nombre
FROM `bodegas_facturacion_tipo`
WHERE idTipo = {$_SESSION['traspasoempresa_basicos']['idTipo']}";
$resultado = mysqli_query ($dbConn, $query);
$rowTipoDocumento = mysqli_fetch_assoc ($resultado);	
	 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre
FROM `bodegas_listado`
WHERE idBodega = {$_SESSION['traspasoempresa_basicos']['idBodegaOrigen']}";
$resultado = mysqli_query ($dbConn, $query);
$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);

// Se traen todos los datos de mi usuario
$query = "SELECT Nombre
FROM `bodegas_listado`
WHERE idBodega = {$_SESSION['traspasoempresa_basicos']['idBodegaDestino']}";
$resultado = mysqli_query ($dbConn, $query);
$rowBodegaDestino = mysqli_fetch_assoc ($resultado);

// Se trae un listado con todos los usuarios
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

// Se traen todos los datos de mi usuario
$query = "SELECT Nombre
FROM `core_sistemas`
WHERE idSistema = {$_SESSION['traspasoempresa_basicos']['idSistemaDestino']}";
$resultado = mysqli_query ($dbConn, $query);
$rowEmpresaDestino = mysqli_fetch_assoc ($resultado);			
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
                    <td class="meta-head">Bodega Origen</td>
                    <td><?php echo $rowBodegaOrigen['Nombre']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Empresa Destino</td>
                    <td><?php echo $rowEmpresaDestino['Nombre']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Bodega Destino</td>
                    <td><?php echo $rowBodegaDestino['Nombre']?></td>
                </tr>
            </tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>
                <tr>
                    <td class="meta-head">Fecha Creacion</td>
                    <td><?php echo Fecha_estandar($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])?></td>
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
				<td><a href="<?php echo $location.'&addProd=true' ?>" class="btn btn-xs btn-primary fright">Agregar Productos</a></td>
			</tr>
			<?php 
			if (isset($_SESSION['traspasoempresa_productos'])){
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrProductos as $prod) { 
					foreach ($_SESSION['traspasoempresa_productos'] as $key => $producto){
						if($prod['idProducto']==$producto['idProducto']){?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="4">
									<?php echo Cantidades_decimales_justos($producto['Number']).' '.$prod['Unimed'].' de '.$prod['Nombre'];?>
								</td>
								<td class="item-name">
									<?php echo Valores_sd($producto['ValorTotal']).' ('.Valores_sd($producto['ValorEgreso']).' x '.$prod['Unimed'].')';?>
								</td>
								<td>
									<div class="btn-group" >
										<a href="<?php echo $location.'&editProd='.$producto['idProducto']; ?>" data-placement="bottom" title="Editar Traspaso" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a>
										<?php 
										$ubicacion = $location.'&del_prod='.$producto['idProducto'];
										$dialogo   = '¿Realmente deseas eliminar el registro de : '.$prod['Nombre'].'?';?>
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
			
            <tr>
				<?php if(isset($_SESSION['traspasoempresa_basicos']['Observaciones'])&&$_SESSION['traspasoempresa_basicos']['Observaciones']!=''){ ?>
				
					<td colspan="5" class="blank word_break"> 
						<?php echo $_SESSION['traspasoempresa_basicos']['Observaciones'];?>
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
						if(isset($_SESSION['temporal'])&&$_SESSION['temporal']!=''){
							$non = $_SESSION['temporal'];
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
$ubicacion = $location.'&view=true&trasp_bodega=true';
$dialogo   = '¿Realmente desea mover los materiales, una vez realizada no podra realizar cambios?';?>
<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width" data-original-title="" title="">Realizar traspaso</a>	



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
}  ?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Traspaso a otra empresa</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
            if(isset($idBodegaOrigen)) {    $x1  = $idBodegaOrigen;     }else{$x1  = '';}
            if(isset($idSistemaDestino)) {  $x2  = $idSistemaDestino;   }else{$x2  = '';}
            if(isset($idBodegaDestino)) {   $x3  = $idBodegaDestino;    }else{$x3  = '';}
            if(isset($Observaciones)) {     $x4  = $Observaciones;      }else{$x4  = '';}
			if(isset($idSistema)) {         $x5  = $idSistema;          }else{$x5  = '';}

			//se dibujan los inputs
			echo form_select_bodega('Bodega Origen','idBodegaOrigen', $x1, 2, 'idBodega', 'Nombre', 'bodegas_listado', 'usuarios_bodegas_productos', $z, $dbConn);
			echo form_select_depend1('Empresa Destino','idSistemaDestino', $x2, 2, 'idSistema', 'Nombre', 'core_sistemas', 0,
							 'Bodega Destino','idBodegaDestino', $x3, 2, 'idBodega', 'idSistema', 'Nombre', 'bodegas_listado', 0, 
							 $dbConn, 'form1');
				 
			echo form_textarea('Observaciones','Observaciones', $x4, 1);
			
			if($arrUsuario['tipo']=='SuperAdmin'){
			echo form_select('Sistema','idSistema', $x5, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}

			echo '<input type="hidden" name="idUsuario"   value="'.$arrUsuario['idUsuario'].'">';
			echo '<input type="hidden" name="Creacion_fecha"   value="'.fecha_actual().'">';
			echo '<input type="hidden" name="idTipo"   value="6">';			
			?>
			
			<div class="form-group">
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Crear traspaso" name="submit">
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
$z="WHERE bodegas_facturacion.idTipo=6";//Solo traspaso a otra empresa
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
bodega1.Nombre AS BodegaOrigen,
bodega2.Nombre AS BodegaDestino,
core_sistemas.Nombre AS Sistema

FROM `bodegas_facturacion`
LEFT JOIN `bodegas_listado`  bodega1   ON bodega1.idBodega         = bodegas_facturacion.idBodegaOrigen
LEFT JOIN `bodegas_listado`  bodega2   ON bodega2.idBodega         = bodegas_facturacion.idBodegaDestino
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema  = bodegas_facturacion.idSistema
".$z."
ORDER BY bodegas_facturacion.Creacion_fecha DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipo,$row );
}?>

<div class="form-group">
<?php if ($rowlevel['level']>=3){
	if (isset($_SESSION['traspasoempresa_basicos']['idBodegaOrigen'])&&$_SESSION['traspasoempresa_basicos']['idBodegaOrigen']!=''){?>
		<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" >Continuar Traspaso</a>
<?php }else{?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" >Crear Nuevo Traspaso</a>
<?php }
 }?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Traspasos</h5>
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
						<th>Bodega Origen</th>
						<th>Bodega Destino</th>
						<th>Fecha de Traspaso</th>
						<th>Sistema</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>                    
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['BodegaOrigen']; ?></td>
						<td><?php echo $tipo['BodegaDestino']; ?></td>
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
