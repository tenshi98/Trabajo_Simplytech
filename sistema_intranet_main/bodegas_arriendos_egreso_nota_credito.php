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
$original = "bodegas_arriendos_egreso_nota_credito.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){            $location .= "&idCliente=".$_GET['idCliente'];                  $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos'] != ''){          $location .= "&idDocumentos=".$_GET['idDocumentos'];            $search .= "&idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                        $location .= "&N_Doc=".$_GET['N_Doc'];                          $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];        $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
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
	$form_trabajo= 'new_egreso_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modBase_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_prod']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_prod_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_prod']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_prod_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_prod_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_otros']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_otros_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_otros']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_otros_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if ( !empty($_GET['del_otros']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_otros_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
/**********************************************/
//se borra un dato
if ( !empty($_GET['add_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'add_obs_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
//se borra un dato
if ( !empty($_GET['del_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_obs_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_impuesto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_impuesto_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if ( !empty($_GET['del_impuesto']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_impuesto_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_file']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_file_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_file_egr_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
/**********************************************/
if ( !empty($_GET['egr_bodega_nc']) )     {
	//Llamamos al formulario
	$form_trabajo= 'egr_bodega_nc';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Nota de Credito Realizada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Nota de Credito Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Nota de Credito borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['addFile']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data">
			
				<?php           
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"');
					
				?> 

				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>              
		</div>
	</div>
</div>	

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editProd']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Ingreso de Arriendo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idEquipo)) {       $x1  = $idEquipo;      }else{$x1  = $_SESSION['arriendos_egr_nc_productos'][$_GET['editProd']]['idEquipo'];}
				if(isset($Cantidad_ing)) {    $x2  = $Cantidad_ing;   }else{$x2  = Cantidades_decimales_justos($_SESSION['arriendos_egr_nc_productos'][$_GET['editProd']]['Cantidad_ing']);}
				if(isset($idFrecuencia)) {   $x3  = $idFrecuencia;  }else{$x3  = $_SESSION['arriendos_egr_nc_productos'][$_GET['editProd']]['idFrecuencia'];}
				if(isset($ValorTotal)) {     $x4  = $ValorTotal;    }else{$x4  = Cantidades_decimales_justos($_SESSION['arriendos_egr_nc_productos'][$_GET['editProd']]['ValorTotal']);}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Equipos','idEquipo', $x1, 2, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', '', $dbConn);
				$Form_Imputs->form_input_number('Cantidad', 'Cantidad_ing', $x2, 2);
				$Form_Imputs->form_select('Frecuencia','idFrecuencia', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, '', $dbConn);
				
				$Form_Imputs->form_input_disabled('Valor Unitario Neto','Unitario', Cantidades_decimales_justos($_SESSION['arriendos_egr_nc_productos'][$_GET['editProd']]['ValorIngreso']), 1);
				$Form_Imputs->form_input_number('Valor Total Neto', 'ValorTotal', $x4, 2);
				$Form_Imputs->form_input_hidden('vUnitario', Cantidades_decimales_justos($_SESSION['arriendos_egr_nc_productos'][$_GET['editProd']]['ValorIngreso']), 2);
				
				echo operacion_input('Cantidad_ing', 'ValorTotal', 'Unitario', 'vUnitario', 4);
				
				
				$Form_Imputs->form_input_hidden('oldItemID', $_GET['editProd'], 2);
				?>

			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_prod"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addProd']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Arriendo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idEquipo)) {       $x1  = $idEquipo;      }else{$x1  = '';}
				if(isset($Cantidad_ing)) {    $x2  = $Cantidad_ing;   }else{$x2  = '';}
				if(isset($idFrecuencia)) {   $x3  = $idFrecuencia;  }else{$x3  = '';}
				if(isset($ValorTotal)) {     $x4  = $ValorTotal;    }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Equipos','idEquipo', $x1, 2, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', '', $dbConn);
				$Form_Imputs->form_input_number('Cantidad', 'Cantidad_ing', $x2, 2);
				$Form_Imputs->form_select('Frecuencia','idFrecuencia', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, '', $dbConn);
				
				$Form_Imputs->form_input_disabled('Valor Unitario Neto','Unitario', '', 1);
				$Form_Imputs->form_input_number('Valor Total Neto', 'ValorTotal', $x4, 2);
				$Form_Imputs->form_input_hidden('vUnitario', '', 2);
				
				echo operacion_input('Cantidad_ing', 'ValorTotal', 'Unitario', 'vUnitario', 4);
				
				
				?>

			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_prod"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addImpuesto']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Impuestos</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idImpuesto )) {       $x1  = $idImpuesto ;      }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Impuestos','idImpuesto', $x1, 2, 'idImpuesto', 'Nombre', 'sistema_impuestos', 0, '', $dbConn);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_impuesto"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editOtros']) ) {  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Otros</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {  $x1  = $Nombre;  }else{$x1  = $_SESSION['arriendos_egr_nc_otros'][$_GET['editOtros']]['Nombre'];}
				if(isset($vTotal)) {  $x2  = $vTotal;  }else{$x2  = Cantidades_decimales_justos($_SESSION['arriendos_egr_nc_otros'][$_GET['editOtros']]['vTotal']);}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);
				
				$Form_Imputs->form_input_hidden('oldidProducto', $_SESSION['arriendos_egr_nc_otros'][$_GET['editOtros']]['idOtros'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_otros"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>                
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addOtros']) ) {  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Otros</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {  $x1  = $Nombre;  }else{$x1  = '';}
				if(isset($vTotal)) {  $x2  = $vTotal;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);

				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_otros"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>                
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$y = "idTipo=3 AND idSistema>=0";
	$w = "idSistema>=0 AND idEstado=1";
	$z = "bodegas_arriendos_listado.idSistema>=0";
}else{
	$y = "idTipo=3 AND idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
	$z = "bodegas_arriendos_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_bodegas_arriendos.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";		
} ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar datos basicos de la Venta</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {          $x1  = $idCliente;        }else{$x1  = $_SESSION['arriendos_egr_nc_basicos']['idCliente'];}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = $_SESSION['arriendos_egr_nc_basicos']['N_Doc'];}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = $_SESSION['arriendos_egr_nc_basicos']['Creacion_fecha'];}
				if(isset($idBodega)) {           $x4  = $idBodega;         }else{$x4  = $_SESSION['arriendos_egr_nc_basicos']['idBodega'];}
				if(isset($Observaciones)) {      $x5  = $Observaciones;    }else{$x5  = $_SESSION['arriendos_egr_nc_basicos']['Observaciones'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
				$Form_Imputs->form_date('Fecha Documento','Creacion_fecha', $x3, 2);
				$Form_Imputs->form_select_join_filter('Bodega destino','idBodega', $x4, 2, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $z, $dbConn);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x5, 1, 160);
				
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idTipo', 13, 2);			
				$Form_Imputs->form_input_hidden('fecha_auto', fecha_actual(), 2);	
				$Form_Imputs->form_input_hidden('idDocumentos', 3, 2);	
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} elseif ( ! empty($_GET['view']) ) { 
$Form_Imputs = new Inputs();
	 
	 
	 
// Se trae el documento mercantil utilizado
$query = "SELECT Nombre
FROM `core_documentos_mercantiles`
WHERE idDocumentos = {$_SESSION['arriendos_egr_nc_basicos']['idDocumentos']}";
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
$rowDocumento = mysqli_fetch_assoc ($resultado); 	

// Se trae el tipo de documento
$query = "SELECT Nombre
FROM `bodegas_arriendos_facturacion_tipo`
WHERE idTipo = {$_SESSION['arriendos_egr_nc_basicos']['idTipo']}";
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
$rowTipoDocumento = mysqli_fetch_assoc ($resultado);	
	 

// Se trae un listado con todos los servicios
$arrServicios = array();
$query = "SELECT  idEquipo, Nombre 
FROM `equipos_arriendo_listado` 
WHERE idEstado=1";
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
array_push( $arrServicios,$row );
}

// Se trae el cliente
$query = "SELECT Nombre
FROM `clientes_listado`
WHERE idCliente = {$_SESSION['arriendos_egr_nc_basicos']['idCliente']}";
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
$rowCliente = mysqli_fetch_assoc ($resultado);

// Se trae la bodega relacionada
$query = "SELECT Nombre
FROM `bodegas_arriendos_listado`
WHERE idBodega = {$_SESSION['arriendos_egr_nc_basicos']['idBodega']}";
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
$rowBodega = mysqli_fetch_assoc ($resultado);


// Se trae un listado con todos los impuestos existentes
$arrImpuestos = array();
$query = "SELECT idImpuesto, Nombre, Porcentaje
FROM `sistema_impuestos`
ORDER BY idImpuesto ASC ";
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
array_push( $arrImpuestos,$row );
}

// Se trae un listado con todos los frecuencias
$arrFrecuencia = array();
$query = "SELECT  idFrecuencia, Nombre
FROM `core_tiempo_frecuencia`  ";
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
array_push( $arrFrecuencia,$row );
}				
?>



<div class="col-sm-12 fcenter" style="margin-bottom:30px">

	<?php 
	$ubicacion = $location.'&view=true&egr_bodega_nc=true';
	$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width"><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>	


	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

	<div class="clearfix"></div>
</div> 


<div class="col-sm-12 fcenter">

	<div id="page-wrap">
		<div id="header"> <?php echo $rowTipoDocumento['Nombre']?></div>
	   

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Cliente</td>
						<td><?php echo $rowCliente['Nombre']?></td>
					</tr>
					<tr>
						<td class="meta-head">Documento</td>
						<td><?php echo $rowDocumento['Nombre'].' N°'.$_SESSION['arriendos_egr_nc_basicos']['N_Doc']?></td>
					</tr>
					<tr>
						<td class="meta-head">Bodega</td>
						<td><?php echo $rowBodega['Nombre']?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['arriendos_egr_nc_basicos']['Creacion_fecha'])?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				
				<tr>
					<th colspan="5">Detalle</th>
					<th width="10">Acciones</th>
				</tr>		  
				

				
				<tr class="item-row fact_tittle">
					<td colspan="5">Arriendo a Ingresar</td>
					<td><a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Arriendo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Arriendo</a></td>
				</tr>
				<?php 
				$vtotal_neto = 0;
				if (isset($_SESSION['arriendos_egr_nc_productos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($arrServicios as $prod) { 
						foreach ($_SESSION['arriendos_egr_nc_productos'] as $key => $producto){
							if($prod['idEquipo']==$producto['idEquipo']){
								$vtotal_neto = $vtotal_neto + $producto['ValorTotal']; ?>
								<tr class="item-row linea_punteada">
									<td class="item-name" colspan="2">
										<?php echo $prod['Nombre'];?>
									</td>
									<td class="item-name">
										<?php 
										$medida = '';
										foreach ($arrFrecuencia as $frec){
											if($producto['idFrecuencia']==$frec['idFrecuencia']){
												$medida = $frec['Nombre'];
											}
										}
										//se imprime la cantidad
										echo Cantidades_decimales_justos($producto['Cantidad_ing']).' '.$medida;
										?>
									</td>
									<td class="item-name" align="right">
										<?php echo valores($producto['ValorIngreso'], 0).' x '.$medida;?>
									</td>
									<td class="item-name" align="right">
										<?php echo Valores(Cantidades_decimales_justos($producto['ValorTotal']), 0);?>
									</td>
									<td>
										<div class="btn-group" style="width: 70px;" >
											<a href="<?php echo $location.'&editProd='.$producto['idEquipo']; ?>" title="Editar Arriendo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
											<?php 
											$ubicacion = $location.'&del_prod='.$producto['idEquipo'];
											$dialogo   = '¿Realmente deseas eliminar el registro '.str_replace('"','',$prod['Nombre']).'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Arriendo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
										</div>
									</td>
								</tr> 
					  <?php }
						}
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>';?>
				
				
				
				
				
				<tr class="item-row fact_tittle">
					<td colspan="5">Otros a Ingresar</td>
					<td><a href="<?php echo $location.'&addOtros=true' ?>" title="Agregar Otro" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Otros</a></td>
				</tr>
				<?php 
				if (isset($_SESSION['arriendos_egr_nc_otros'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['arriendos_egr_nc_otros'] as $key => $producto){
						$vtotal_neto = $vtotal_neto + $producto['vTotal'];?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="4"><?php echo $producto['Nombre'];?></td>
							<td class="item-name" align="right">
								<?php echo valores($producto['vTotal'], 0);?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editOtros='.$producto['idOtros']; ?>" title="Editar Otros" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
									<?php if(!isset($_GET['soli']) OR $_GET['soli']==''){ ?>	
										<?php 
										$ubicacion = $location.'&del_otros='.$producto['idOtros'];
										$dialogo   = '¿Realmente deseas eliminar  '.$producto['Nombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Otros" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
									<?php } ?>
								</div>
							</td>
						</tr> 
					 <?php 	
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>';?>
				
				
				

				<?php  //Guardo el neto
				$_SESSION['arriendos_egr_nc_basicos']['valor_neto_fact'] = $vtotal_neto;
				?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"><strong>Subtotal Neto</strong></td> 
						<td align="right"><?php echo Valores($vtotal_neto, 0);?></td>
						<td></td>
					</tr>
					
					
					<?php  //Guardo el neto imponible
					$_SESSION['arriendos_egr_nc_basicos']['valor_neto_imp'] = $vtotal_neto;
					?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"><strong>Neto Imponible</strong></td> 
						<td align="right"><?php echo Valores($vtotal_neto, 0);?></td>
						<td></td>
					</tr>
					
					<tr class="item-row linea_punteada">
						<td class="item-name" colspan="5"><strong>Impuestos</strong></td>
						<td><a href="<?php echo $location.'&addImpuesto=true' ?>" title="Agregar Impuesto" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Impuestos</a></td>
					</tr>
					<?php 
					if (isset($_SESSION['arriendos_egr_nc_impuestos'])){
						//guardo el valor neto
						$tempa = $vtotal_neto;
						//recorro el lsiatdo entregado por la base de datos
						foreach ($arrImpuestos as $impto) { 
							foreach ($_SESSION['arriendos_egr_nc_impuestos'] as $key => $producto){
								if($impto['idImpuesto']==$producto['idImpuesto']){
									//se hacen los calculos matematicos
									$vtotal_IVA = ($tempa / 100) * $impto['Porcentaje'];
									$vtotal_neto = $vtotal_neto + $vtotal_IVA;
									//se guardan los valores en variables de sesion
									$_SESSION['arriendos_egr_nc_impuestos'][$producto['idImpuesto']]['valor'] = $vtotal_IVA;
									
									?>
									<tr class="invoice-total" bgcolor="#f1f1f1">
										<td colspan="4" align="right"><strong><?php echo $impto['Nombre'].' ('.Cantidades_decimales_justos($impto['Porcentaje']).'%)';?></strong></td>      
										<td align="right">
											<?php echo Valores($vtotal_IVA, 0);?>
										</td>
										<td>
											<div class="btn-group" style="width: 35px;" >
												<?php 
												$ubicacion = $location.'&del_impuesto='.$impto['idImpuesto'];
												$dialogo   = '¿Realmente deseas eliminar el impuesto '.$impto['Nombre'].'?';?>
												<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Impuesto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
											</div>
										</td>
									</tr>
						  <?php }
							}
						}
					}
					//guardo el total
					$_SESSION['arriendos_egr_nc_basicos']['valor_total_fact'] = $vtotal_neto;
					
					?>
					
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"> <strong>Total</strong></td>    
						<td align="right"><?php echo Valores($vtotal_neto, 0);?></td>
						<td></td>
					</tr>
					

				
				<tr>
					<?php if(isset($_SESSION['arriendos_egr_nc_basicos']['Observaciones'])&&$_SESSION['arriendos_egr_nc_basicos']['Observaciones']!=''){ ?>
					
						<td colspan="5" class="blank word_break"> 
							<?php echo $_SESSION['arriendos_egr_nc_basicos']['Observaciones'];?>
						</td>
						<td class="blank">
							<div class="btn-group" style="width: 35px;" >
								<?php 
								$ubicacion = $location.'&view=true&del_obs=true';
								$dialogo   = '¿Realmente deseas eliminar la observacion?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
							</div>
						</td>
					
					<?php }else{?>
						<td colspan="5" class="blank"> 
							<?php 
							$non = '';
							if(isset($_SESSION['arriendos_egr_nc_temporal'])&&$_SESSION['arriendos_egr_nc_temporal']!=''){
								$non = $_SESSION['arriendos_egr_nc_temporal'];
							}	
								
							$Form_Imputs->input_textarea_obs('Observaciones','Observaciones', 1,'width:100%; height: 200px;', $non);?>
						</td>
						<td class="blank">
							<div class="btn-group" style="width: 35px;" >
								<?php $ubicacion=$location.'&view=true&add_obs=true';?>			
								<a onclick="add_obs('<?php echo $ubicacion ?>')" title="Agregar Observacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-check-square-o"></i></a>
							</div>
						</td>
						
					<?php }?>	
					
					
				</tr>
				<tr>
					<td colspan="6" class="blank"><p>Observaciones</p></td> 
				</tr>
				
				
					
					
				
			</tbody>
		</table>
    </div>
    
    <table id="items" style="margin-bottom: 20px;">
        <tbody>
            
			<tr class="invoice-total" bgcolor="#f1f1f1">
                <td colspan="5">Archivos Adjuntos</td>
                <td width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></td>
            </tr>		  
            
			<?php 
			if (isset($_SESSION['arriendos_egr_nc_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['arriendos_egr_nc_archivos'] as $key => $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $numeral.' - '.$producto['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<?php 
								$ubicacion = $location.'&del_file='.$producto['idFile'];
								$dialogo   = '¿Realmente deseas eliminar  '.str_replace('"','',$producto['Nombre']).'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>								
							</div>
						</td>
					</tr>
					 
				 <?php 
				$numeral++;	
				}
			}?>

		</tbody>
    </table>


</div>

<?php require_once '../LIBS_js/modal/modal.php';?>
<div class="clearfix"></div>



<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$y = "idTipo=3 AND idSistema>=0";
	$w = "idSistema>=0 AND idEstado=1";
	$z = "bodegas_arriendos_listado.idSistema>=0";
}else{
	$y = "idTipo=3 AND idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
	$z = "bodegas_arriendos_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_bodegas_arriendos.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";		
} ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nota de Credito</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {          $x1  = $idCliente;        }else{$x1  = '';}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = '';}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = '';}
				if(isset($idBodega)) {           $x4  = $idBodega;         }else{$x4  = '';}
				if(isset($Observaciones)) {      $x5  = $Observaciones;    }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
				$Form_Imputs->form_date('Fecha Documento','Creacion_fecha', $x3, 2);
				$Form_Imputs->form_select_join_filter('Bodega destino','idBodega', $x4, 2, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $z, $dbConn);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x5, 1, 160);
				
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idTipo', 13, 2);			
				$Form_Imputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				$Form_Imputs->form_input_hidden('idDocumentos', 3, 2);			
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf046; Crear Documento" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
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
		case 'cliente_asc':  $order_by = 'ORDER BY clientes_listado.Nombre ASC ';                      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Cliente Ascendente'; break;
		case 'cliente_desc': $order_by = 'ORDER BY clientes_listado.Nombre DESC ';                     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Cliente Descendente';break;
		case 'fecha_asc':    $order_by = 'ORDER BY bodegas_arriendos_facturacion.Creacion_fecha ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':   $order_by = 'ORDER BY bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'doc_asc':      $order_by = 'ORDER BY core_documentos_mercantiles.Nombre ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Documento Ascendente';break;
		case 'doc_desc':     $order_by = 'ORDER BY core_documentos_mercantiles.Nombre DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Documento Descendente';break;
		
		default: $order_by = 'ORDER BY bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$y = "idTipo=3 AND idSistema>=0";
	$w = "idSistema>=0 AND idEstado=1";
	$v = "bodegas_arriendos_listado.idSistema>=0";
}else{
	$y = "idTipo=3 AND idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
	$v = "bodegas_arriendos_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_bodegas_arriendos.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";		
}
/**********************************************************/
//Variable con la ubicacion
$z="WHERE bodegas_arriendos_facturacion.idTipo=13";//Solo egresos
//Verifico el tipo de usuario que esta ingresando
$z.=" AND bodegas_arriendos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){                $z .= " AND bodegas_arriendos_facturacion.idCliente=".$_GET['idCliente'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos'] != ''){          $z .= " AND bodegas_arriendos_facturacion.idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                        $z .= " AND bodegas_arriendos_facturacion.N_Doc LIKE '%".$_GET['N_Doc']."%'";}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){      $z .= " AND bodegas_arriendos_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['Devolucion_fecha']) && $_GET['Devolucion_fecha'] != ''){  $z .= " AND bodegas_arriendos_facturacion.Devolucion_fecha='".$_GET['Devolucion_fecha']."'";}
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador'] != ''){          $z .= " AND bodegas_arriendos_facturacion.idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['idBodega']) && $_GET['idBodega'] != ''){                  $z .= " AND bodegas_arriendos_facturacion.idBodega=".$_GET['idBodega'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones'] != ''){        $z .= " AND bodegas_arriendos_facturacion.Observaciones LIKE '%".$_GET['Observaciones']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `bodegas_arriendos_facturacion` ".$z;
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
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
clientes_listado.Nombre AS Cliente

FROM `bodegas_arriendos_facturacion`
LEFT JOIN `core_sistemas`                   ON core_sistemas.idSistema                      = bodegas_arriendos_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles`     ON core_documentos_mercantiles.idDocumentos     = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `clientes_listado`                ON clientes_listado.idCliente                   = bodegas_arriendos_facturacion.idCliente
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
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){ ?>
		<?php if (isset($_SESSION['arriendos_egr_nc_basicos']['idCliente'])&&$_SESSION['arriendos_egr_nc_basicos']['idCliente']!=''){?>
			
			<?php 
			$ubicacion = $location.'&clear_all=true';
			$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
			
			<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Nota de Credito</a>
		<?php }else{ ?>
			<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Nota de Credito</a>
		<?php } ?>
	<?php } ?>
</div> 
<div class="clearfix"></div>                     
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {          $x1  = $idCliente;        }else{$x1  = '';}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = '';}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = '';}
				if(isset($idBodega)) {           $x4  = $idBodega;         }else{$x4  = '';}
				if(isset($Observaciones)) {      $x5  = $Observaciones;    }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Cliente','idCliente', $x1, 1, 'idCliente', 'Nombre', 'clientes_listado', $w, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 1);
				$Form_Imputs->form_date('Fecha Documento','Creacion_fecha', $x3, 1);
				$Form_Imputs->form_select_join_filter('Bodega destino','idBodega', $x4, 1, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $v, $dbConn);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x5, 1, 160);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				$Form_Imputs->form_input_hidden('idDocumentos', 3, 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Notas de Credito</h5>
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
							<div class="pull-left">Cliente</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=cliente_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=cliente_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha de Venta</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Documento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=doc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=doc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
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
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_mov_arriendos.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
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

<?php require_once '../LIBS_js/modal/modal.php';?>
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
