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
$original = "cross_solicitud_aplicacion_editar.php";
$location = $original;
//Se agregan ubicaciones
$location .='?view='.$_GET['view'];
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//se modifican los datos basicos
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_mod_base';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_cuartel']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_addCuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se agrega un trabajo
if ( !empty($_POST['submit_edit_cuartel']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_editCuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se cierra un trabajo
if ( !empty($_POST['submit_close_cuartel']) )     {
	//Llamamos al formulario
	$form_trabajo= 'updt_close_Cuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
//se cierra un trabajo
if ( !empty($_POST['submit_close_all_cuartel']) )     {
	//Llamamos al formulario
	$form_trabajo= 'updt_close_all_Cuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
//se borra un trabajo
if ( !empty($_GET['del_cuartel']) )     {
	//Llamamos al formulario
	$form_trabajo= 'updt_del_Cuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_tractor']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_addtractor';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se agrega un trabajo
if ( !empty($_POST['submit_edit_tractor']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_edittractor';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se borra un trabajo
if ( !empty($_GET['del_trac']) )     {
	//Llamamos al formulario
	$form_trabajo= 'updt_del_trac';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_producto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_addproducto';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se agrega un trabajo
if ( !empty($_POST['submit_edit_producto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_editproducto';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se borra un trabajo
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_trabajo= 'updt_del_prod';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_add_detalle']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_adddetalle';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['not_modbase']))  {$error['not_modbase'] 	  	   = 'sucess/Datos basicos editados correctamente';}
if (isset($_GET['not_addcuartel']))  {$error['not_addcuartel'] 	   = 'sucess/Cuartel agregado correctamente';}
if (isset($_GET['not_closecuartel']))  {$error['not_closecuartel'] = 'sucess/Cuartel cerrado correctamente';}
if (isset($_GET['not_delcuartel'])) {$error['not_delcuartel'] 	   = 'sucess/Cuartel borrado correctamente';}
if (isset($_GET['not_addtractor']))  {$error['not_addtractor'] 	   = 'sucess/Tractor agregado correctamente';}
if (isset($_GET['not_edittrac']))  {$error['not_edittrac'] 	       = 'sucess/Tractor editado correctamente';}
if (isset($_GET['not_deltractor']))  {$error['not_deltractor'] 	   = 'sucess/Tractor borrado correctamente';}
if (isset($_GET['not_addprod']))  {$error['not_addprod'] 	  	   = 'sucess/Producto agregado correctamente';}
if (isset($_GET['not_editprod'])) {$error['not_editprod'] 	  	   = 'sucess/Producto editado correctamente';}
if (isset($_GET['not_delprod']))  {$error['not_delprod'] 	  	   = 'sucess/Producto borrado correctamente';}
if (isset($_GET['not_adddetalle']))  {$error['not_adddetalle']     = 'sucess/Detalle agregado correctamente';}

//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
if(isset($error1)&&$error1!=''){echo notifications_list($error1);};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['addDetalle']) ) {?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Detalle</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {      $x1  = $Observacion;        }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_textarea('Observacion','Observacion', $x1, 1, 160);
				
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				$Form_Imputs->form_input_hidden('idEstado', $_GET['idEstado'], 2);
				$Form_Imputs->form_input_hidden('Creacion_fecha', fecha_actual(), 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_add_detalle"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['lock_all_cuartel']) ) {
/*****************************************/				
//Cuarteles
$arrCuarteles = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_cuarteles.idCuarteles,
cross_predios_listado_zonas.Nombre AS Cuartel

FROM `cross_solicitud_aplicacion_listado_cuarteles` 
LEFT JOIN `cross_predios_listado_zonas`    ON cross_predios_listado_zonas.idZona    = cross_solicitud_aplicacion_listado_cuarteles.idZona
WHERE cross_solicitud_aplicacion_listado_cuarteles.idSolicitud = {$_GET['view']} 
AND cross_solicitud_aplicacion_listado_cuarteles.idEstado=1
ORDER BY cross_solicitud_aplicacion_listado_cuarteles.idCuarteles ASC";
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
array_push( $arrCuarteles,$row );
}
	
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Cerrar Todos los Cuarteles</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				$Form_Imputs = new Form_Inputs();
				
				
				//Recorro todos los cuarteles
				foreach ($arrCuarteles as  $cuartel){
					$Form_Imputs->form_date('Fecha Cierre Cuartel '.$cuartel['Cuartel'],'f_cierre[]', '', 2);	
					$Form_Imputs->form_select('Ejecucion de '.$cuartel['Cuartel'],'idEjecucion[]', '', 2, 'idEjecucion', 'Nombre', 'core_estado_ejecucion', 0, '', $dbConn);
					$Form_Imputs->form_input_hidden('Nombre_cuartel[]', $cuartel['Cuartel'], 2);
					$Form_Imputs->form_input_hidden('ID_cuartel[]', $cuartel['idCuarteles'], 2);
				}
				
		
				$Form_Imputs->form_input_hidden('f_ejecucion', $_GET['f_ejecucion'], 2);
				$Form_Imputs->form_input_hidden('f_ejecucion_fin', $_GET['f_ejecucion_fin'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_close_all_cuartel"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['lock_cuartel']) ) {?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Cerrar Cuartel</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($f_cierre)) {      $x1  = $f_cierre;     }else{$x1  = '';}
				if(isset($idEjecucion)) {   $x2  = $idEjecucion;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Cierre Cuartel','f_cierre', $x1, 2);	
				$Form_Imputs->form_select('Ejecucion','idEjecucion', $x2, 2, 'idEjecucion', 'Nombre', 'core_estado_ejecucion', 0, '', $dbConn);

				$Form_Imputs->form_input_hidden('idCuarteles', $_GET['lock_cuartel'], 2);
				$Form_Imputs->form_input_hidden('f_ejecucion', $_GET['f_ejecucion'], 2);
				$Form_Imputs->form_input_hidden('f_ejecucion_fin', $_GET['f_ejecucion_fin'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_close_cuartel"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['edit_Cuarteles']) ) {
// Se traen todos los datos de mi usuario
$query = "SELECT idPredio, idCategoria, idProducto
FROM `cross_solicitud_aplicacion_listado`
WHERE idSolicitud = {$_GET['view']} ";
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
$row_data_ini = mysqli_fetch_assoc ($resultado);

//Verifico el tipo de usuario que esta ingresando
$z ="idPredio=".$row_data_ini['idPredio']." ";
$z.=" AND idCategoria=".$row_data_ini['idCategoria']." ";
$z.=" AND idProducto=".$row_data_ini['idProducto']." ";
$z.=" AND idEstado=1 ";

/***************************************************/	
// Se traen todos los datos de mi usuario
$query = "SELECT idZona,Mojamiento,VelTractor,VelViento,TempMin,TempMax
FROM `cross_solicitud_aplicacion_listado_cuarteles`
WHERE idCuarteles = {$_GET['cuartel_id']} ";
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
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Cuartel</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idZona)) {         $x1  = $idZona;        }else{$x1  = $row_data['idZona'];}
				if(isset($Mojamiento)) {     $x2  = $Mojamiento;    }else{$x2  = $row_data['Mojamiento'];}
				if(isset($VelTractor)) {     $x3  = $VelTractor;    }else{$x3  = $row_data['VelTractor'];}
				if(isset($VelViento)) {      $x4  = $VelViento;     }else{$x4  = $row_data['VelViento'];}
				if(isset($TempMin)) {        $x5  = $TempMin;       }else{$x5  = $row_data['TempMin'];}
				if(isset($TempMax)) {        $x6  = $TempMax;       }else{$x6  = $row_data['TempMax'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Identificación cuartel</h3>';
				$Form_Imputs->form_select_filter('Cuartel','idZona', $x1, 2, 'idZona', 'Nombre', 'cross_predios_listado_zonas', $z, '', $dbConn);

				echo '<h3>Parámetros de Aplicación</h3>';
				$Form_Imputs->form_input_number_spinner('Mojamiento L/ha','Mojamiento', $x2, 0, 10000, 1, 0, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Tractor Km/hr','VelTractor', $x3, 0, 50, '0.1', 1, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Viento Km/hr','VelViento', $x4, 0, 500, '0.001', 3, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura minima','TempMin', $x5, -20, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura maxima','TempMax', $x6, -20, 500, '0.01', 2, 2);
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				$Form_Imputs->form_input_hidden('idCuarteles', $_GET['cuartel_id'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_cuartel"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['edit_prod']) ) { 
$x="idEstado=1 ";	
// Se traen todos los datos de mi usuario
$query = "SELECT idProducto, DosisAplicar, Objetivo
FROM `cross_solicitud_aplicacion_listado_productos`
WHERE idProdQuim = {$_GET['edit_prod']} ";
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
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Producto Químico</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idProducto)) {     $x1  = $idProducto;    }else{$x1  = $row_data['idProducto'];}
				if(isset($DosisAplicar)) {   $x2  = $DosisAplicar;  }else{$x2  = $row_data['DosisAplicar'];}
				if(isset($Objetivo)) {       $x3  = $Objetivo;      }else{$x3  = $row_data['Objetivo'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Producto Químico a aplicar</h3>';
				$Form_Imputs->form_select_filter('Producto Químico','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $x, '', $dbConn);
				$Form_Imputs->form_input_disabled( 'Dosis Recomendada', 'escribeme1', 0, 1);
				$Form_Imputs->form_input_number_spinner('Dosis a aplicar','DosisAplicar', $x2, 0, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_disabled( 'Unidad de medida', 'escribeme2', 0, 1);
				$Form_Imputs->form_textarea('Objetivo','Objetivo', $x3, 1, 160);
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				$Form_Imputs->form_input_hidden('idCuarteles', $_GET['cuartel_id'], 2);
				$Form_Imputs->form_input_hidden('idProdQuim', $_GET['edit_prod'], 2);
				
				
				//Imprimo las variables
				$arrTipo = array();
				$query = "SELECT 
				productos_listado.idProducto, 
				productos_listado.DosisRecomendada,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE ".$x."
				ORDER BY idProducto ASC";
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
				
				echo '<script>';
				foreach ($arrTipo as $tipo) {
					echo 'var id_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['DosisRecomendada']).'";';	
					echo 'var id_med_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
				}
				?>
				document.getElementById("idProducto").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idProducto").value;
					if (Componente != "") {
						id_data1=eval("id_data_" + Componente)
						id_data2=eval("id_med_" + Componente)
						//escribo dentro del input
						var elem1 = document.getElementById("escribeme1");
						var elem2 = document.getElementById("escribeme2");
						elem1.value = id_data1;
						elem2.value = id_data2;
					}
				}
				
				$(document).ready(function(){
					var Componente = document.getElementById("idProducto").value;
					if (Componente != "") {
						id_data1=eval("id_data_" + Componente)
						id_data2=eval("id_med_" + Componente)
						//escribo dentro del input
						var elem1 = document.getElementById("escribeme1");
						var elem2 = document.getElementById("escribeme2");
						elem1.value = id_data1;
						elem2.value = id_data2;
					}
				});
				</script>
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_producto"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['add_prod']) ) { 
$x="idEstado=1 ";			
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Producto Químico</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idProducto)) {     $x1  = $idProducto;    }else{$x1  = '';}
				if(isset($DosisAplicar)) {   $x2  = $DosisAplicar;  }else{$x2  = '';}
				if(isset($Objetivo)) {       $x3  = $Objetivo;      }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Producto Químico a aplicar</h3>';
				$Form_Imputs->form_select_filter('Producto Químico','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $x, '', $dbConn);
				$Form_Imputs->form_input_disabled( 'Dosis Recomendada', 'escribeme1', 0, 1);
				$Form_Imputs->form_input_number_spinner('Dosis a aplicar','DosisAplicar', $x2, 0, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_disabled( 'Unidad de medida', 'escribeme2', 0, 1);
				$Form_Imputs->form_textarea('Objetivo','Objetivo', $x3, 1, 160);
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				$Form_Imputs->form_input_hidden('idCuarteles', $_GET['cuartel_id'], 2);
				
				
				//Imprimo las variables
				$arrTipo = array();
				$query = "SELECT 
				productos_listado.idProducto, 
				productos_listado.DosisRecomendada,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE ".$x."
				ORDER BY idProducto ASC";
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
				
				echo '<script>';
				foreach ($arrTipo as $tipo) {
					echo 'var id_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['DosisRecomendada']).'";';	
					echo 'var id_med_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
				}
				?>
				document.getElementById("idProducto").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idProducto").value;
					if (Componente != "") {
						id_data1=eval("id_data_" + Componente)
						id_data2=eval("id_med_" + Componente)
						//escribo dentro del input
						var elem1 = document.getElementById("escribeme1");
						var elem2 = document.getElementById("escribeme2");
						elem1.value = id_data1;
						elem2.value = id_data2;
					}
				}
				
				$(document).ready(function(){
					var Componente = document.getElementById("idProducto").value;
					if (Componente != "") {
						id_data1=eval("id_data_" + Componente)
						id_data2=eval("id_med_" + Componente)
						//escribo dentro del input
						var elem1 = document.getElementById("escribeme1");
						var elem2 = document.getElementById("escribeme2");
						elem1.value = id_data1;
						elem2.value = id_data2;
					}
				});
				</script>
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_producto"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['edit_trac']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w = "telemetria_listado.idSistema>=0  AND telemetria_listado.idEstado=1";
	$z = "idSistema>=0 AND idEstado=1";
	$x = "idSistema>=0 AND idEstado=1";
}else{
	$w = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.idEstado=1";		
	$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
	$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
}

// Se traen todos los datos de mi usuario
$query = "SELECT idVehiculo, idTelemetria, idTrabajador
FROM `cross_solicitud_aplicacion_listado_tractores`
WHERE idTractores = {$_GET['edit_trac']} ";
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
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Tractor</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idVehiculo)) {     $x1  = $idVehiculo;    }else{$x1  = $row_data['idVehiculo'];}
				if(isset($idTelemetria)) {   $x2  = $idTelemetria;  }else{$x2  = $row_data['idTelemetria'];}
				if(isset($idTrabajador)) {   $x3  = $idTrabajador;  }else{$x3  = $row_data['idTrabajador'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Tractor</h3>';
				$Form_Imputs->form_select_filter('Tractor','idVehiculo', $x1, 2, 'idVehiculo', 'Nombre', 'vehiculos_listado', $z, '', $dbConn);
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo Aplicacion','idTelemetria', $x2, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo Aplicacion','idTelemetria', $x2, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				$Form_Imputs->form_select_filter('Trabajador Asignado','idTrabajador', $x3, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat', 'trabajadores_listado', $x, '', $dbConn);
				
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				$Form_Imputs->form_input_hidden('idCuarteles', $_GET['cuartel_id'], 2);
				$Form_Imputs->form_input_hidden('idTractores', $_GET['edit_trac'], 2);
				
				?>
				
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_tractor"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['add_trac']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w = "telemetria_listado.idSistema>=0  AND telemetria_listado.idEstado=1";
	$z = "idSistema>=0 AND idEstado=1";
	$x = "idSistema>=0 AND idEstado=1";
}else{
	$w = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.idEstado=1";		
	$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
	$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
}
			
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Tractor</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idVehiculo)) {     $x1  = $idVehiculo;    }else{$x1  = '';}
				if(isset($idTelemetria)) {   $x2  = $idTelemetria;  }else{$x2  = '';}
				if(isset($idTrabajador)) {   $x3  = $idTrabajador;  }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Tractor</h3>';
				$Form_Imputs->form_select_filter('Tractor','idVehiculo', $x1, 2, 'idVehiculo', 'Nombre', 'vehiculos_listado', $z, '', $dbConn);
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo Aplicacion','idTelemetria', $x2, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo Aplicacion','idTelemetria', $x2, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				$Form_Imputs->form_select_filter('Trabajador Asignado','idTrabajador', $x3, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat', 'trabajadores_listado', $x, '', $dbConn);
				
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				$Form_Imputs->form_input_hidden('idCuarteles', $_GET['cuartel_id'], 2);
				
				?>
				
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_tractor"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addCuartel']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT idPredio, idCategoria, idProducto,
Mojamiento, VelTractor, VelViento, TempMin, TempMax
FROM `cross_solicitud_aplicacion_listado`
WHERE idSolicitud = {$_GET['view']} ";
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

//Verifico el tipo de usuario que esta ingresando
$z ="idPredio=".$row_data['idPredio']." ";
$z.=" AND idCategoria=".$row_data['idCategoria']." ";
$z.=" AND idProducto=".$row_data['idProducto']." ";
$z.=" AND idEstado=1 ";

$x="idEstado=1 ";
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w = "telemetria_listado.idSistema>=0  AND telemetria_listado.idEstado=1";
	$y = "idSistema>=0 AND idEstado=1";
	$m = "idSistema>=0 AND idEstado=1";
}else{
	$w = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}  AND telemetria_listado.idEstado=1 ";
	$y = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
	$m = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
}			
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Agregar Cuartel</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idZona)) {         $x1  = $idZona;        }else{$x1  = '';}
				if(isset($Mojamiento)) {     $x2  = $Mojamiento;    }else{$x2  = $row_data['Mojamiento'];}
				if(isset($VelTractor)) {     $x3  = $VelTractor;    }else{$x3  = $row_data['VelTractor'];}
				if(isset($VelViento)) {      $x4  = $VelViento;     }else{$x4  = $row_data['VelViento'];}
				if(isset($TempMin)) {        $x5  = $TempMin;       }else{$x5  = $row_data['TempMin'];}
				if(isset($TempMax)) {        $x6  = $TempMax;       }else{$x6  = $row_data['TempMax'];}
				if(isset($idVehiculo)) {     $x7  = $idVehiculo;    }else{$x7  = '';}
				if(isset($idTelemetria)) {   $x8  = $idTelemetria;  }else{$x8  = '';}
				if(isset($idTrabajador)) {   $x9  = $idTrabajador;  }else{$x9  = '';}
				if(isset($idProducto)) {     $x10 = $idProducto;    }else{$x10 = '';}
				if(isset($DosisAplicar)) {   $x11 = $DosisAplicar;  }else{$x11 = '';}
				if(isset($Objetivo)) {       $x12 = $Objetivo;      }else{$x12 = '';}
				
			
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Identificación cuartel</h3>';
				$Form_Imputs->form_select_filter('Cuartel','idZona', $x1, 2, 'idZona', 'Nombre', 'cross_predios_listado_zonas', $z, '', $dbConn);

				echo '<h3>Parámetros de Aplicación</h3>';
				$Form_Imputs->form_input_number_spinner('Mojamiento L/ha','Mojamiento', $x2, 0, 10000, 1, 0, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Tractor Km/hr','VelTractor', $x3, 0, 50, '0.1', 1, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Viento Km/hr','VelViento', $x4, 0, 500, '0.001', 3, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura minima','TempMin', $x5, -20, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura maxima','TempMax', $x6, -20, 500, '0.01', 2, 2);
				
				echo '<h3>Tractor</h3>';
				$Form_Imputs->form_select_filter('Tractor','idVehiculo', $x7, 2, 'idVehiculo', 'Nombre', 'vehiculos_listado', $y, '', $dbConn);
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo Aplicacion','idTelemetria', $x8, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo Aplicacion','idTelemetria', $x8, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				$Form_Imputs->form_select_filter('Trabajador Asignado','idTrabajador', $x9, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat', 'trabajadores_listado', $m, '', $dbConn);
				
				
				echo '<h3>Producto Químico a aplicar</h3>';
				$Form_Imputs->form_select_filter('Producto Químico','idProducto', $x10, 2, 'idProducto', 'Nombre', 'productos_listado', $x, '', $dbConn);
				$Form_Imputs->form_input_disabled( 'Dosis Recomendada', 'escribeme1', 0, 1);
				$Form_Imputs->form_input_number_spinner('Dosis a aplicar','DosisAplicar', $x11, 0, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_disabled( 'Unidad de medida', 'escribeme2', 0, 1);
				$Form_Imputs->form_textarea('Objetivo','Objetivo', $x12, 1, 160);
				
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
								
					
				//Imprimo las variables
				$arrTipo = array();
				$query = "SELECT 
				productos_listado.idProducto, 
				productos_listado.DosisRecomendada,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado`
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE ".$x."
				ORDER BY idProducto ASC";
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
				
				echo '<script>';
				foreach ($arrTipo as $tipo) {
					echo 'var id_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['DosisRecomendada']).'";';	
					echo 'var id_med_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
				}
				?>
				document.getElementById("idProducto").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idProducto").value;
					if (Componente != "") {
						id_data1=eval("id_data_" + Componente)
						id_data2=eval("id_med_" + Componente)
						//escribo dentro del input
						var elem1 = document.getElementById("escribeme1");
						var elem2 = document.getElementById("escribeme2");
						elem1.value = id_data1;
						elem2.value = id_data2;
					}
				}
				
				$(document).ready(function(){
					var Componente = document.getElementById("idProducto").value;
					if (Componente != "") {
						id_data1=eval("id_data_" + Componente)
						id_data2=eval("id_med_" + Componente)
						//escribo dentro del input
						var elem1 = document.getElementById("escribeme1");
						var elem2 = document.getElementById("escribeme2");
						elem1.value = id_data1;
						elem2.value = id_data2;
					}
				});
				</script>
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_cuartel"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
//Verifico el tipo de usuario que esta ingresando
$y = "idEstado=1";
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
$m = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	


// Se traen todos los datos de mi usuario
$query = "SELECT idPredio, idTemporada, idEstadoFen, idCategoria, idProducto, f_programacion, 
horaProg, idSistema, idEstado, f_ejecucion, f_termino, horaEjecucion, horaTermino,
Mojamiento, VelTractor, VelViento, TempMin, TempMax, idPrioridad, f_programacion_fin, 
horaProg_fin, f_ejecucion_fin, horaEjecucion_fin, f_termino_fin, horaTermino_fin,
idDosificador
FROM `cross_solicitud_aplicacion_listado`
WHERE idSolicitud = {$_GET['view']} ";
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

?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar la Solicitud de Aplicacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idPrioridad)) {          $x0  = $idPrioridad;          }else{$x0  = $row_data['idPrioridad'];}
				if(isset($idPredio)) {             $x1  = $idPredio;             }else{$x1  = $row_data['idPredio'];}
				if(isset($idTemporada)) {          $x2  = $idTemporada;          }else{$x2  = $row_data['idTemporada'];}
				if(isset($idEstadoFen)) {          $x3  = $idEstadoFen;          }else{$x3  = $row_data['idEstadoFen'];}
				if(isset($idCategoria)) {          $x4  = $idCategoria;          }else{$x4  = $row_data['idCategoria'];}
				if(isset($idProducto)) {           $x5  = $idProducto;           }else{$x5  = $row_data['idProducto'];}
				if(isset($f_programacion)) {       $x6  = $f_programacion;       }else{$x6  = $row_data['f_programacion'];}
				if(isset($horaProg)) {             $x7  = $horaProg;             }else{$x7  = $row_data['horaProg'];}
				if(isset($f_ejecucion)) {          $x8  = $f_ejecucion;          }else{$x8  = $row_data['f_ejecucion'];}
				if(isset($horaEjecucion)) {        $x9  = $horaEjecucion;        }else{$x9  = $row_data['horaEjecucion'];}
				if(isset($f_termino)) {            $x10 = $f_termino;            }else{$x10 = $row_data['f_termino'];}
				if(isset($horaTermino)) {          $x11 = $horaTermino;          }else{$x11 = $row_data['horaTermino'];}
				if(isset($Mojamiento)) {           $x13 = $Mojamiento;           }else{$x13 = Cantidades_decimales_justos($row_data['Mojamiento']);}
				if(isset($VelTractor)) {           $x14 = $VelTractor;           }else{$x14 = Cantidades_decimales_justos($row_data['VelTractor']);}
				if(isset($VelViento)) {            $x15 = $VelViento;            }else{$x15 = Cantidades_decimales_justos($row_data['VelViento']);}
				if(isset($TempMin)) {              $x16 = $TempMin;              }else{$x16 = Cantidades_decimales_justos($row_data['TempMin']);}
				if(isset($TempMax)) {              $x17 = $TempMax;              }else{$x17 = Cantidades_decimales_justos($row_data['TempMax']);}
				if(isset($f_programacion_fin)) {   $x18 = $f_programacion_fin;   }else{$x18 = $row_data['f_programacion_fin'];}
				if(isset($horaProg_fin)) {         $x19 = $horaProg_fin;         }else{$x19 = $row_data['horaProg_fin'];}
				if(isset($f_ejecucion_fin)) {      $x20 = $f_ejecucion_fin;      }else{$x20 = $row_data['f_ejecucion_fin'];}
				if(isset($horaEjecucion_fin)) {    $x21 = $horaEjecucion_fin;    }else{$x21 = $row_data['horaEjecucion_fin'];}
				if(isset($f_termino_fin)) {        $x22 = $f_termino_fin;        }else{$x22 = $row_data['f_termino_fin'];}
				if(isset($horaTermino_fin)) {      $x23 = $horaTermino_fin;      }else{$x23 = $row_data['horaTermino_fin'];}
				if(isset($idDosificador)) {        $x24 = $idDosificador;        }else{$x24 = $row_data['idDosificador'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				//Verifico el estado
				switch ($row_data['idEstado']) {
					//Solicitada
					case 1:
						echo '<h3>Datos Basicos</h3>';
						$Form_Imputs->form_select('Prioridad','idPrioridad', $x0, 2, 'idPrioridad', 'Nombre', 'core_cross_prioridad', 0, '', $dbConn);
						$Form_Imputs->form_select_filter('Predio','idPredio', $x1, 2, 'idPredio', 'Nombre', 'cross_predios_listado', $z, '', $dbConn);
						$Form_Imputs->form_select_filter('Temporada','idTemporada', $x2, 2, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
						$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x3, 2, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
						$Form_Imputs->form_select_depend1('Especie','idCategoria', $x4, 2, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, 0,
												 'Variedad','idProducto', $x5, 2, 'idProducto', 'Nombre', 'variedades_listado', 'idEstado=1', 0, 
												 $dbConn, 'form1');
						$Form_Imputs->form_date('Fecha inicio requerido','f_programacion', $x6, 2);
						$Form_Imputs->form_time('Hora inicio requerido','horaProg', $x7, 2, 1);
						$Form_Imputs->form_date('Fecha termino requerido','f_programacion_fin', $x18, 2);
						$Form_Imputs->form_time('Hora termino requerido','horaProg_fin', $x19, 2, 1);
				
				
						echo '<h3>Parámetros de Aplicación</h3>';
						$Form_Imputs->form_input_number_spinner('Mojamiento L/ha','Mojamiento', $x13, 0, 10000, 1, 0, 2);
						$Form_Imputs->form_input_number_spinner('Velocidad Tractor Km/hr','VelTractor', $x14, 0, 50, '0.1', 1, 2);
						$Form_Imputs->form_input_number_spinner('Velocidad Viento Km/hr','VelViento', $x15, 0, 500, '0.001', 3, 2);
						$Form_Imputs->form_input_number_spinner('Temperatura minima','TempMin', $x16, -20, 500, '0.01', 2, 2);
						$Form_Imputs->form_input_number_spinner('Temperatura maxima','TempMax', $x17, -20, 500, '0.01', 2, 2);
						
						break;
					//Programada
					case 2:
						echo '<h3>Datos Basicos</h3>';
						$Form_Imputs->form_select_filter('Temporada','idTemporada', $x2, 2, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
						$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x3, 2, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
						$Form_Imputs->form_date('Fecha inicio programación','f_ejecucion', $x8, 2);
						$Form_Imputs->form_time('Hora inicio programación','horaEjecucion', $x9, 2, 1);
						$Form_Imputs->form_date('Fecha termino programación','f_ejecucion_fin', $x20, 2);
						$Form_Imputs->form_time('Hora termino programación','horaEjecucion_fin', $x21, 2, 1);
						$Form_Imputs->form_select_filter('Dosificador','idDosificador', $x24, 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat', 'trabajadores_listado', $m, '', $dbConn);
				
				
						break;
					//Ejecutada
					case 3:
						echo '<h3>Datos Basicos</h3>';
						$Form_Imputs->form_date('Fecha inicio cierre','f_termino', $x10, 2);
						$Form_Imputs->form_time('Hora inicio cierre','horaTermino', $x11, 2, 1);
						$Form_Imputs->form_date('Fecha termino cierre','f_termino_fin', $x22, 2);
						$Form_Imputs->form_time('Hora termino cierre','horaTermino_fin', $x23, 2, 1);
						break;
				}		 
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['view'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>					
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else { 
/**********************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT
cross_solicitud_aplicacion_listado.idEstado,
cross_solicitud_aplicacion_listado.idSolicitud, 
cross_solicitud_aplicacion_listado.f_creacion,
cross_solicitud_aplicacion_listado.f_programacion,
cross_solicitud_aplicacion_listado.f_ejecucion,
cross_solicitud_aplicacion_listado.f_termino,
cross_solicitud_aplicacion_listado.f_programacion_fin,
cross_solicitud_aplicacion_listado.f_ejecucion_fin,
cross_solicitud_aplicacion_listado.f_termino_fin,
cross_solicitud_aplicacion_listado.horaProg,
cross_solicitud_aplicacion_listado.horaEjecucion,
cross_solicitud_aplicacion_listado.horaTermino,
cross_solicitud_aplicacion_listado.horaProg_fin,
cross_solicitud_aplicacion_listado.horaEjecucion_fin,
cross_solicitud_aplicacion_listado.horaTermino_fin,
cross_solicitud_aplicacion_listado.Mojamiento, 
cross_solicitud_aplicacion_listado.VelTractor, 
cross_solicitud_aplicacion_listado.VelViento, 
cross_solicitud_aplicacion_listado.TempMin, 
cross_solicitud_aplicacion_listado.TempMax,

usuarios_listado.Nombre AS NombreUsuario,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

cross_predios_listado.Nombre AS NombrePredio,
core_estado_solicitud.Nombre AS Estado,
cross_checking_temporada.Codigo AS TemporadaCodigo,
cross_checking_temporada.Nombre AS TemporadaNombre,
cross_checking_estado_fenologico.Codigo AS EstadoFenCodigo,
cross_checking_estado_fenologico.Nombre AS EstadoFenNombre,
sistema_variedades_categorias.Nombre AS VariedadCat,
variedades_listado.Nombre AS VariedadNombre,
core_cross_prioridad.Nombre AS NombrePrioridad,
cross_solicitud_aplicacion_listado.idDosificador,
trabajadores_listado.Rut AS TrabajadorRut,
trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat

FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                     = cross_solicitud_aplicacion_listado.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                       = cross_solicitud_aplicacion_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                         = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                         = sistema_origen.idComuna
LEFT JOIN `cross_predios_listado`                   ON cross_predios_listado.idPredio                 = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `core_estado_solicitud`                   ON core_estado_solicitud.idEstado                 = cross_solicitud_aplicacion_listado.idEstado
LEFT JOIN `cross_checking_temporada`                ON cross_checking_temporada.idTemporada           = cross_solicitud_aplicacion_listado.idTemporada
LEFT JOIN `cross_checking_estado_fenologico`        ON cross_checking_estado_fenologico.idEstadoFen   = cross_solicitud_aplicacion_listado.idEstadoFen
LEFT JOIN `sistema_variedades_categorias`           ON sistema_variedades_categorias.idCategoria      = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                      ON variedades_listado.idProducto                  = cross_solicitud_aplicacion_listado.idProducto
LEFT JOIN `core_cross_prioridad`                    ON core_cross_prioridad.idPrioridad               = cross_solicitud_aplicacion_listado.idPrioridad
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador              = cross_solicitud_aplicacion_listado.idDosificador

WHERE cross_solicitud_aplicacion_listado.idSolicitud = {$_GET['view']} ";
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

/*****************************************/				
//Cuarteles
$arrCuarteles = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_cuarteles.idCuarteles,
cross_solicitud_aplicacion_listado_cuarteles.Mojamiento,
cross_solicitud_aplicacion_listado_cuarteles.VelTractor,
cross_solicitud_aplicacion_listado_cuarteles.VelViento,
cross_solicitud_aplicacion_listado_cuarteles.TempMin,
cross_solicitud_aplicacion_listado_cuarteles.TempMax,
cross_solicitud_aplicacion_listado_cuarteles.idEstado,
cross_solicitud_aplicacion_listado_cuarteles.f_cierre,
cross_predios_listado_zonas.Nombre AS Cuartel

FROM `cross_solicitud_aplicacion_listado_cuarteles` 
LEFT JOIN `cross_predios_listado_zonas`    ON cross_predios_listado_zonas.idZona    = cross_solicitud_aplicacion_listado_cuarteles.idZona
WHERE cross_solicitud_aplicacion_listado_cuarteles.idSolicitud = {$_GET['view']} ";
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
array_push( $arrCuarteles,$row );
}

//Se trae un listado con los Tractores	
$arrTractores = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_tractores.idTractores,
cross_solicitud_aplicacion_listado_tractores.idCuarteles,
telemetria_listado.Nombre AS TeleNombre,
vehiculos_listado.Nombre AS VehiculoNombre,
trabajadores_listado.Rut,
trabajadores_listado.Nombre,
trabajadores_listado.ApellidoPat

FROM `cross_solicitud_aplicacion_listado_tractores`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria      = cross_solicitud_aplicacion_listado_tractores.idTelemetria
LEFT JOIN `vehiculos_listado`     ON vehiculos_listado.idVehiculo         = cross_solicitud_aplicacion_listado_tractores.idVehiculo
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador    = cross_solicitud_aplicacion_listado_tractores.idTrabajador
WHERE cross_solicitud_aplicacion_listado_tractores.idSolicitud = {$_GET['view']} 
ORDER BY telemetria_listado.Nombre ASC";
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
array_push( $arrTractores,$row );
}
$arrTrac = array();
foreach ($arrTractores as $prod) {
	$arrTrac[$prod['idCuarteles']][$prod['idTractores']]['idTractores']     = $prod['idTractores'];
	$arrTrac[$prod['idCuarteles']][$prod['idTractores']]['Nombre']          = $prod['TeleNombre'];
	$arrTrac[$prod['idCuarteles']][$prod['idTractores']]['VehiculoNombre']  = $prod['VehiculoNombre'];
	$arrTrac[$prod['idCuarteles']][$prod['idTractores']]['Trabajador']      = $prod['Rut'].' - '.$prod['Nombre'].' '.$prod['ApellidoPat'];
}


//Se trae un listado con los productos	
$arrProductos = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_productos.idProdQuim,
cross_solicitud_aplicacion_listado_productos.idCuarteles,
cross_solicitud_aplicacion_listado_productos.DosisRecomendada,
cross_solicitud_aplicacion_listado_productos.DosisAplicar,
cross_solicitud_aplicacion_listado_productos.Objetivo,
productos_listado.Nombre AS Producto,
sistema_productos_uml.Nombre AS Unimed

FROM `cross_solicitud_aplicacion_listado_productos`
LEFT JOIN `productos_listado`       ON productos_listado.idProducto   = cross_solicitud_aplicacion_listado_productos.idProducto
LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = cross_solicitud_aplicacion_listado_productos.idUml
WHERE cross_solicitud_aplicacion_listado_productos.idSolicitud = {$_GET['view']} 
ORDER BY productos_listado.Nombre ASC";
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
array_push( $arrProductos,$row );
}
$arrProd = array();
foreach ($arrProductos as $prod) {
	$arrProd[$prod['idCuarteles']][$prod['idProdQuim']]['idProdQuim']       = $prod['idProdQuim'];
	$arrProd[$prod['idCuarteles']][$prod['idProdQuim']]['DosisRecomendada'] = $prod['DosisRecomendada'];
	$arrProd[$prod['idCuarteles']][$prod['idProdQuim']]['DosisAplicar']     = $prod['DosisAplicar'];
	$arrProd[$prod['idCuarteles']][$prod['idProdQuim']]['Objetivo']         = $prod['Objetivo'];
	$arrProd[$prod['idCuarteles']][$prod['idProdQuim']]['Producto']         = $prod['Producto'];
	$arrProd[$prod['idCuarteles']][$prod['idProdQuim']]['Unimed']           = $prod['Unimed'];
}

/*****************************************/		
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_historial.Creacion_fecha, 
cross_solicitud_aplicacion_listado_historial.Observacion,
usuarios_listado.Nombre AS Usuario,
core_estado_solicitud.Nombre AS Estado

FROM `cross_solicitud_aplicacion_listado_historial` 
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario      = cross_solicitud_aplicacion_listado_historial.idUsuario
LEFT JOIN `core_estado_solicitud`    ON core_estado_solicitud.idEstado  = cross_solicitud_aplicacion_listado_historial.idEstado
WHERE cross_solicitud_aplicacion_listado_historial.idSolicitud = {$_GET['view']} 
ORDER BY cross_solicitud_aplicacion_listado_historial.idHistorial ASC";
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
array_push( $arrHistorial,$row );
}	

 ?>
 
<div class="col-sm-11 fcenter table-responsive" style="margin-bottom:30px">

	<div id="page-wrap">
		<div id="header"> SOLICITUD DE APLICACIONES N° <?php echo n_doc($row_data['idSolicitud'], 5); ?></div>
		<div id="customer"> 
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Prioridad</td>
						<td><?php echo $row_data['NombrePrioridad']?></td>
					</tr>
					<tr>
						<td class="meta-head">Predio</td>
						<td><?php echo $row_data['NombrePredio']?></td>
					</tr>
					<tr>
						<td class="meta-head">Temporada</td>
						<td><?php echo $row_data['TemporadaCodigo'].' '.$row_data['TemporadaNombre']?></td>
					</tr>
					<tr>
						<td class="meta-head">Estado Fenológico</td>
						<td><?php echo $row_data['EstadoFenCodigo'].' '.$row_data['EstadoFenNombre']?></td>
					</tr>
					<tr>
						<td class="meta-head">Especie - Variedad</td>
						<td><?php echo $row_data['VariedadCat'].' - '.$row_data['VariedadNombre']?></td>
					</tr>
					<tr>
						<td class="meta-head">Estado</td>
						<td><?php echo $row_data['Estado']?></td>
					</tr>
					<tr>
						<td class="meta-head">Usuario Creador</td>
						<td><?php echo $row_data['NombreUsuario']?></td>
					</tr>
					<tr>
						<td class="meta-head">Mojamiento</td>
						<td><?php echo Cantidades_decimales_justos($row_data['Mojamiento']).' L/ha'; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Vel. Tractor</td>
						<td><?php echo Cantidades_decimales_justos($row_data['VelTractor']).' Km/hr'; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Vel. Viento</td>
						<td><?php echo Cantidades_decimales_justos($row_data['VelViento']).' Km/hr'; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Temp Min</td>
						<td><?php echo Cantidades_decimales_justos($row_data['TempMin']).' °'; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Temp Max</td>
						<td><?php echo Cantidades_decimales_justos($row_data['TempMax']).' °'; ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Creado</td>
						<td><?php echo Fecha_estandar($row_data['f_creacion'])?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha inicio requerido</td>
						<td><?php echo fecha_estandar($row_data['f_programacion']).' '.$row_data['horaProg']?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha termino requerido</td>
						<td><?php echo fecha_estandar($row_data['f_programacion_fin']).' '.$row_data['horaProg_fin']?></td>
					</tr>
					<?php if(isset($row_data['f_ejecucion'])&&$row_data['f_ejecucion']!='0000-00-00'){ ?>
						<tr>
							<td class="meta-head">Fecha inicio programación</td>
							<td><?php echo fecha_estandar($row_data['f_ejecucion']).' '.$row_data['horaEjecucion']?></td>
						</tr>
						<tr>
							<td class="meta-head">Fecha termino programación</td>
							<td><?php echo fecha_estandar($row_data['f_ejecucion_fin']).' '.$row_data['horaEjecucion_fin']?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['f_termino'])&&$row_data['f_termino']!='0000-00-00'){ ?>
						<tr>
							<td class="meta-head">Fecha inicio ejecución</td>
							<td><?php echo fecha_estandar($row_data['f_termino']).' '.$row_data['horaTermino']?></td>
						</tr>
						<tr>
							<td class="meta-head">Fecha termino ejecución</td>
							<td><?php echo fecha_estandar($row_data['f_termino_fin']).' '.$row_data['horaTermino_fin']?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['idDosificador'])&&$row_data['idDosificador']!=0){ ?>
						<tr>
							<td class="meta-head">Dosificador</td>
							<td><?php echo $row_data['TrabajadorRut'].' '.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellidoPat']?></td>
						</tr>
					<?php } ?>
					

				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>
				
				<tr>
					<th colspan="6">Detalle</th>
					<th width="160">Acciones</th>
				</tr>		  
				

				
				<?php /**********************************************************************************/ ?> 
				<tr class="item-row fact_tittle">
					<td><strong>Cuarteles</strong></td>
					<td><strong>Mojamiento</strong></td>
					<td><strong>Vel. Tractor</strong></td>
					<td><strong>Vel. Viento</strong></td>
					<td><strong>Temp Min</strong></td>
					<td><strong>Temp Max</strong></td>
					<td>
						<?php if(isset($row_data['idEstado'])&&$row_data['idEstado']!=3){ ?><a href="<?php echo $location.'&addCuartel=true' ?>" title="Agregar Cuartel" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus"></i> Agregar Cuartel</a><?php } ?>
						<?php if(isset($row_data['idEstado'])&&$row_data['idEstado']==2){ ?><a href="<?php echo $location.'&lock_all_cuartel=true&f_ejecucion='.$row_data['f_ejecucion'].'&f_ejecucion_fin='.$row_data['f_ejecucion_fin'] ?>" title="Cerrar Todos los Cuarteles" class="btn btn-xs btn-metis-1 tooltip" style="position: initial;margin-top:5px;"><i class="fa fa-lock"></i> Cerrar Cuarteles</a><?php } ?>
					</td>
					
		
											
				</tr>
				<?php 
					//recorro el lsiatdo entregado por la base de datos
					if ($arrCuarteles) {
						foreach ($arrCuarteles as $cuartel) { ?>
							
							<tr class="item-row linea_punteada" style="background: #eee;">
								<td class="item-name"><?php echo $cuartel['Cuartel'];if(isset($cuartel['idEstado'])&&$cuartel['idEstado']==2){ echo '(Cerrado el '.fecha_estandar($cuartel['f_cierre']).')';} ?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($cuartel['Mojamiento']).' L/ha';?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($cuartel['VelTractor']).' Km/hr';?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($cuartel['VelViento']).' Km/hr';?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($cuartel['TempMin']).' °';?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($cuartel['TempMax']).' °';?></td>
								<td>
									<div class="btn-group" <?php if(isset($row_data['idEstado'])&&$row_data['idEstado']!=2){echo 'style="width: 140px;"';}else{echo 'style="width: 175px;"';} ?> >
										<?php if(isset($row_data['idEstado'])&&$row_data['idEstado']!=3&&isset($cuartel['idEstado'])&&$cuartel['idEstado']==1){ ?>
											<a href="<?php echo $location.'&cuartel_id='.$cuartel['idCuarteles'].'&edit_Cuarteles='.$row_data['idEstado']; ?>" title="Editar Cuartel" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
											<a href="<?php echo $location.'&cuartel_id='.$cuartel['idCuarteles'].'&add_trac=true'; ?>" title="Agregar Tractor" class="btn btn-primary btn-sm tooltip"><i class="fa fa-truck"></i></a>
											<a href="<?php echo $location.'&cuartel_id='.$cuartel['idCuarteles'].'&add_prod=true'; ?>" title="Agregar Producto Químico" class="btn btn-primary btn-sm tooltip"><i class="fa fa-flask"></i></a>
											<?php if(isset($row_data['idEstado'])&&$row_data['idEstado']==2){ ?>
												<?php 
												$ubicacion = $location.'&lock_cuartel='.$cuartel['idCuarteles'].'&f_ejecucion='.$row_data['f_ejecucion'].'&f_ejecucion_fin='.$row_data['f_ejecucion_fin'];
												$dialogo   = '¿Realmente deseas cerrar el cuartel '.$cuartel['Cuartel'].', una vez hecho no podras realizar mas modificaciones?';?>
												<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Cerrar Cuartel" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-lock"></i></a>
											<?php } ?>
											<?php 
											$ubicacion = $location.'&del_cuartel='.$cuartel['idCuarteles'];
											$dialogo   = '¿Realmente deseas eliminar el cuartel '.$cuartel['Cuartel'].'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Cuartel" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
										<?php } ?>
									</div>
								</td>
							</tr> 
							<?php 
							if($arrTrac[$cuartel['idCuarteles']]){
								//Se recorren los tractores
								foreach ($arrTrac[$cuartel['idCuarteles']] as $tract){?>
									
									<tr class="item-row linea_punteada">
											<td class="item-name" colspan="2"><i class="fa fa-truck"></i> <?php echo '<strong>Tractor: </strong>'.$tract['VehiculoNombre'];?></td>
											<td class="item-name" colspan="2"><?php echo '<strong>Equipo Aplicación: </strong>'.$tract['Nombre'];?></td>
											<td class="item-name" colspan="2"><?php echo '<strong>Trabajador: </strong>'.$tract['Trabajador'];?></td>
											<td>
											<div class="btn-group" style="width: 70px;" >
												<?php if(isset($row_data['idEstado'])&&$row_data['idEstado']!=3&&isset($cuartel['idEstado'])&&$cuartel['idEstado']==1){ ?>
													<a href="<?php echo $location.'&cuartel_id='.$cuartel['idCuarteles'].'&edit_trac='.$tract['idTractores']; ?>" title="Editar Tractor" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
													<?php 
													$ubicacion = $location.'&cuartel_id='.$cuartel['idCuarteles'].'&del_trac='.$tract['idTractores'];
													$dialogo   = '¿Realmente deseas eliminar el tractor '.$tract['Nombre'].'?';?>
													<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Tractor" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
												<?php } ?>
											</div>
										</td>
									</tr> 
								<?php
								}
							}
							if($arrProd[$cuartel['idCuarteles']]){
								//Se recorren los quimicos a utilizar
								foreach ($arrProd[$cuartel['idCuarteles']] as $prod){?>
									
									<tr class="item-row linea_punteada">
										<td class="item-name" colspan="3">
											<i class="fa fa-flask"></i>
											<?php echo '<strong>Producto Químico: </strong>'.$prod['Producto'];?><br/>
											<?php echo '<strong>Objetivo: </strong>'.$prod['Objetivo'];?><br/>
										</td>
										<td class="item-name" colspan="3">
											<?php echo '<strong>Dosis Recomendada: </strong>'.Cantidades_decimales_justos($prod['DosisRecomendada']).' '.$prod['Unimed'];?><br/>
											<?php echo '<strong>Dosis a aplicar: </strong>'.Cantidades_decimales_justos($prod['DosisAplicar']).' '.$prod['Unimed'];?><br/>
										</td>
										<td>
											<div class="btn-group" style="width: 70px;" >
												<?php if(isset($row_data['idEstado'])&&$row_data['idEstado']!=3&&isset($cuartel['idEstado'])&&$cuartel['idEstado']==1){ ?>
													<a href="<?php echo $location.'&cuartel_id='.$cuartel['idCuarteles'].'&edit_prod='.$prod['idProdQuim']; ?>" title="Editar Producto Quimico" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
													<?php 
													$ubicacion = $location.'&cuartel_id='.$cuartel['idCuarteles'].'&del_prod='.$prod['idProdQuim'];
													$dialogo   = '¿Realmente deseas eliminar el producto '.$prod['Producto'].'?';?>
													<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Producto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
												<?php } ?>
											</div>
										</td>
								</tr> 
							
								<?php
								}
							}
						}
					}else{
						echo '<tr class="item-row linea_punteada"><td colspan="6">No hay cuarteles asignados</td></tr>';
					} ?>
					
				
			</tbody>
		</table>
		<div class="clearfix"></div>
			
	</div>
	
	
	<table id="items" style="margin-bottom: 20px;">
        <tbody>
            
			<tr class="invoice-total" bgcolor="#f1f1f1">
                <th colspan="6">Detalles</th>
                <th width="160"><a href="<?php echo $location.'&idEstado='.$row_data['idEstado'].'&addDetalle=true' ?>" title="Agregar Detalle" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Detalle</a></th>
            </tr>
			<tr>
				<th width="160">Fecha</th>
				<th width="160">Estado</th>
				<th width="260">Usuario</th>
				<th colspan="4">Observacion</th>
			</tr>		  
            
			<?php foreach ($arrHistorial as $doc){?>
				<tr class="item-row">
					<td><?php echo fecha_estandar($doc['Creacion_fecha']); ?></td>
					<td><?php echo $doc['Estado']; ?></td>
					<td><?php echo $doc['Usuario']; ?></td>
					<td colspan="4"><?php echo $doc['Observacion']; ?></td>
				</tr> 
			<?php } ?>

		</tbody>
    </table>


</div>


<?php } ?>

         
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
