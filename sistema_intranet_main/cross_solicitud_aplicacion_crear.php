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
$original = "cross_solicitud_aplicacion_crear.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $location .= "&idSolicitud=".$_GET['idSolicitud'];        $search .= "&idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $location .= "&idPredio=".$_GET['idPredio'];              $search .= "&idPredio=".$_GET['idPredio'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $location .= "&idTemporada=".$_GET['idTemporada'];        $search .= "&idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $location .= "&idEstadoFen=".$_GET['idEstadoFen'];        $search .= "&idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $location .= "&idCategoria=".$_GET['idCategoria'];        $search .= "&idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $location .= "&idProducto=".$_GET['idProducto'];          $search .= "&idProducto=".$_GET['idProducto'];}
if(isset($_GET['f_programacion']) && $_GET['f_programacion'] != ''){  $location .= "&f_programacion=".$_GET['f_programacion'];  $search .= "&f_programacion=".$_GET['f_programacion'];}
if(isset($_GET['horaProg']) && $_GET['horaProg'] != ''){              $location .= "&horaProg=".$_GET['horaProg'];              $search .= "&horaProg=".$_GET['horaProg'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $location .= "&idUsuario=".$_GET['idUsuario'];            $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//se cera la orden
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'creacion';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se borra n los datos temporales
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se modifican los datos basicos
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'mod_base';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_cuartel']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'addCuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se agrega un trabajo
if ( !empty($_POST['submit_edit_cuartel']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'editCuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se borra un trabajo
if ( !empty($_GET['del_cuartel']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_Cuartel';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_tractor']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'addtractor';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se agrega un trabajo
if ( !empty($_POST['submit_edit_tractor']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edittractor';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se borra un trabajo
if ( !empty($_GET['del_trac']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_trac';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se agrega un trabajo
if ( !empty($_POST['submit_producto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'addproducto';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se agrega un trabajo
if ( !empty($_POST['submit_edit_producto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'editproducto';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
//se borra un trabajo
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_prod';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se agrega una observacion
if ( !empty($_GET['add_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'add_obs';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
//se elimina la observacion
if ( !empty($_GET['del_obs']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_obs';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
/*************************************************************************/
//se crea la ot
if ( !empty($_GET['crear_solicitud']) )     {
	//Llamamos al formulario
	$form_trabajo= 'crear_solicitud';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';	
}
//se elimina la observacion
if ( !empty($_GET['del_Solicitud']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_Solicitud';
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
if (isset($_GET['created']))     {$error['usuario'] 	  = 'sucess/Solicitud creada correctamente';}
if (isset($_GET['edited']))      {$error['usuario'] 	  = 'sucess/Solicitud editada correctamente';}
if (isset($_GET['deleted']))     {$error['usuario'] 	  = 'sucess/Solicitud borrada correctamente';}
if (isset($_GET['notslectjob'])) {$error['notslectjob']   = 'error/No ha seleccionado un trabajo a realizar';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit_Cuarteles']) ) {
//Verifico el tipo de usuario que esta ingresando
$z ="idPredio=".$_SESSION['sol_apli_basicos']['idPredio']." ";
$z.=" AND idCategoria=".$_SESSION['sol_apli_basicos']['idCategoria']." ";
$z.=" AND idProducto=".$_SESSION['sol_apli_basicos']['idProducto']." ";
$z.=" AND idEstado=1 ";		
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
				if(isset($idZona)) {         $x1  = $idZona;        }else{$x1  = $_SESSION['sol_apli_cuarteles'][$_GET['cuartel_id']]['idZona'];}
				/*if(isset($Mojamiento)) {     $x2  = $Mojamiento;    }else{$x2  = Cantidades_decimales_justos($_SESSION['sol_apli_cuarteles'][$_GET['cuartel_id']]['Mojamiento']);}
				if(isset($VelTractor)) {     $x3  = $VelTractor;    }else{$x3  = Cantidades_decimales_justos($_SESSION['sol_apli_cuarteles'][$_GET['cuartel_id']]['VelTractor']);}
				if(isset($VelViento)) {      $x4  = $VelViento;     }else{$x4  = Cantidades_decimales_justos($_SESSION['sol_apli_cuarteles'][$_GET['cuartel_id']]['VelViento']);}
				if(isset($TempMin)) {        $x5  = $TempMin;       }else{$x5  = Cantidades_decimales_justos($_SESSION['sol_apli_cuarteles'][$_GET['cuartel_id']]['TempMin']);}
				if(isset($TempMax)) {        $x6  = $TempMax;       }else{$x6  = Cantidades_decimales_justos($_SESSION['sol_apli_cuarteles'][$_GET['cuartel_id']]['TempMax']);}*/
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Identificación cuartel</h3>';
				$Form_Imputs->form_select_filter('Cuartel','idZona', $x1, 2, 'idZona', 'Nombre', 'cross_predios_listado_zonas', $z, '', $dbConn);

				/*echo '<h3>Parámetros de Aplicación</h3>';
				$Form_Imputs->form_input_number_spinner('Mojamiento L/ha','Mojamiento', $x2, 0, 10000, 1, 0, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Tractor Km/hr','VelTractor', $x3, 0, 50, '0.1', 1, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Viento Km/hr','VelViento', $x4, 0, 500, '0.001', 3, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura minima','TempMin', $x5, -20, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura maxima','TempMax', $x6, -20, 500, '0.01', 2, 2);*/
				
				$Form_Imputs->form_input_hidden('idInterno', $_GET['cuartel_id'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_cuartel"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( isset($_GET['edit_prod'])&&$_GET['edit_prod']!='' ) { 
$x="idEstado=1 ";			
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
				if(isset($idProducto)) {     $x1  = $idProducto;    }else{$x1  = $_SESSION['sol_apli_productos'][$_GET['cuartel_id']][$_GET['edit_prod']]['idProducto'];}
				if(isset($DosisAplicar)) {   $x2  = $DosisAplicar;  }else{$x2  = $_SESSION['sol_apli_productos'][$_GET['cuartel_id']][$_GET['edit_prod']]['DosisAplicar'];}
				if(isset($Objetivo)) {       $x3  = $Objetivo;      }else{$x3  = $_SESSION['sol_apli_productos'][$_GET['cuartel_id']][$_GET['edit_prod']]['Objetivo'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Producto Químico a aplicar</h3>';
				$Form_Imputs->form_select_filter('Producto Químico','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $x, '', $dbConn);
				$Form_Imputs->form_input_disabled( 'Dosis Recomendada', 'escribeme1', 0, 1);
				$Form_Imputs->form_input_number_spinner('Dosis a aplicar','DosisAplicar', $x2, 0, 500, '0.01', 2, 2);
				$Form_Imputs->form_input_disabled( 'Unidad de medida', 'escribeme2', 0, 1);
				$Form_Imputs->form_textarea('Objetivo','Objetivo', $x3, 1, 160);
				
				$Form_Imputs->form_input_hidden('idInterno', $_GET['cuartel_id'], 2);
				$Form_Imputs->form_input_hidden('idInterno3', $_GET['edit_prod'], 2);
				
				
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
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
				
				$Form_Imputs->form_input_hidden('idInterno', $_GET['cuartel_id'], 2);
				
				
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
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( isset($_GET['edit_trac'])&&$_GET['edit_trac']!='' ) { 
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
			<h5>Editar Tractor</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idVehiculo)) {     $x1  = $idVehiculo;    }else{$x1  =  $_SESSION['sol_apli_tractores'][$_GET['cuartel_id']][$_GET['edit_trac']]['idVehiculo'];}
				if(isset($idTelemetria)) {   $x2  = $idTelemetria;  }else{$x2  =  $_SESSION['sol_apli_tractores'][$_GET['cuartel_id']][$_GET['edit_trac']]['idTelemetria'];}
				if(isset($idTrabajador)) {   $x3  = $idTrabajador;  }else{$x3  =  $_SESSION['sol_apli_tractores'][$_GET['cuartel_id']][$_GET['edit_trac']]['idTrabajador'];}
				
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
				
				$Form_Imputs->form_input_hidden('idInterno', $_GET['cuartel_id'], 2);
				$Form_Imputs->form_input_hidden('idInterno2', $_GET['edit_trac'], 2);
				
				?>
				
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_tractor"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
					
				
				$Form_Imputs->form_input_hidden('idInterno', $_GET['cuartel_id'], 2);
				
				?>
				
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_tractor"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addCuartel']) ) { 
//Verifico el tipo de usuario que esta ingresando
$z ="idPredio=".$_SESSION['sol_apli_basicos']['idPredio']." ";
$z.=" AND idCategoria=".$_SESSION['sol_apli_basicos']['idCategoria']." ";
$z.=" AND idProducto=".$_SESSION['sol_apli_basicos']['idProducto']." ";
$z.=" AND idEstado=1 ";

//Variable filtro
$x="idEstado=1 ";

//Verifico el tipo de usuario
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w = "telemetria_listado.idSistema>=0  AND telemetria_listado.idEstado=1";
	$y = "idSistema>=0 AND idEstado=1";
	$m = "idSistema>=0 AND idEstado=1";
}else{
	$w = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.idEstado=1";		
	$y = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
	$m = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
}
//se dibujan los inputs
$Form_Imputs = new Inputs();
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box dark">
			<header>
				<div class="icons"><i class="fa fa-edit"></i></div>
				<h5>Agregar Trabajos</h5>
			</header>
			<div id="div-1" class="body">
				
				

				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
					<h3>Parámetros de Aplicación</h3>
					<div> 	
						<div class="col-sm-2 nopadding">
							<div class="form-group">
								<?php $Form_Imputs->input_number('Mojamiento L/ha','Mojamiento', Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['Mojamiento']), 2);?>
							</div>
						</div>
						<div class="col-sm-3 nopadding">
							<div class="form-group">
								<?php $Form_Imputs->input_number('Velocidad Tractor Km/hr','VelTractor', Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['VelTractor']), 2);?>
							</div>
						</div>
						<div class="col-sm-3 nopadding">
							<div class="form-group">
								<?php $Form_Imputs->input_number('Velocidad Viento Km/hr','VelViento', Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['VelViento']), 2);?>
							</div>
						</div>
						<div class="col-sm-2 nopadding">
							<div class="form-group">
								<?php $Form_Imputs->input_number('T° Minima','TempMin', Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['TempMin']), 2);?>
							</div>
						</div>
						<div class="col-sm-2 nopadding">
							<div class="form-group">
								<?php $Form_Imputs->input_number('T° Maxima','TempMax', Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['TempMax']), 2);?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
	
					<div class="col-sm-12 breadcrumb-bar" style="margin-bottom:10px;">
						<h3 class="fleft" style="margin-top: 0px;margin-bottom: 0px;">Cuarteles</h3>
						<a onclick="cuartel_all_add();"  class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Todos Cuarteles</a>
						<a onclick="cuartel_add();"  class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Cuarteles</a>
					</div>
					
					<div class="clearfix"></div> 
					<div id="insert_cuartel"></div>
					
					<div class="col-sm-12 breadcrumb-bar" style="margin-bottom:10px;">
						<h3 class="fleft" style="margin-top: 0px;margin-bottom: 0px;">Productos</h3>
						<a onclick="producto_add();"  class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Productos</a>
					</div>
					<div class="clearfix"></div> 
					<div id="insert_producto"></div>
					
					<div class="col-sm-12 breadcrumb-bar" style="margin-bottom:10px;">
						<h3 class="fleft" style="margin-top: 0px;margin-bottom: 0px;">Tractores</h3>
						<a onclick="tractor_add();"  class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Agregar Tractores</a>
					</div>
					<div class="clearfix"></div> 
					<div id="insert_tractor"></div>

				
					<div class="form-group" style="margin-top:10px;">
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit_cuartel"> 
						<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>
						  
				</form> 
				<?php require_once '../LIBS_js/validator/form_validator.php';?>         
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div style="display: none;"> 
	
	<div id="clone_cuartel" class="cuartel_container"> 
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->select_change('Cuarteles','idZona[]', 2, 'idZona', 'Nombre', 'cross_predios_listado_zonas', $z,'', 'ChangePredio',$dbConn); ?>	
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_disabled('text', 'Codigo', 'escribeme1', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_disabled('text', 'Hectareas', 'escribeme2', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_disabled('text', 'Hileras', 'escribeme3', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_disabled('text', 'Dist Plantas', 'escribeme4', 0, 1);?>
			</div>
		</div>	
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<div class="input-group">
					<?php $Form_Imputs->input_disabled('text', 'Dist Hileras', 'escribeme5', 0, 1);?>
					<div class="input-group-btn">
						<button class="btn btn-metis-1 tooltip remove_cuartel" type="button" title="Borrar Informacion" > <i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	
	
	<div id="clone_producto" class="prod_container"> 	
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->select_change('Producto Químico','idProducto[]', 2, 'idProducto', 'Nombre', 'productos_listado', $x,'', 'OnSelectionChange',$dbConn); ?>	
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_disabled('text', 'Dosis Recomendada', 'escribeme1', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_number('Dosis a aplicar','DosisAplicar[]', '', 2);?>
			</div>
		</div>
		<div class="col-sm-2 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->input_disabled('text', 'Unidad de medida', 'escribeme2', 0, 1);?>
			</div>
		</div>
		<div class="col-sm-4 nopadding">
			<div class="form-group">
				<div class="input-group">
					<?php $Form_Imputs->input_hold('text','Objetivo','Objetivo[]', '', 1); ?>
					<div class="input-group-btn">
						<button class="btn btn-metis-1 tooltip remove_producto" type="button" title="Borrar Informacion" > <i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	
	
	<div id="clone_tractor"> 	
		<div class="col-sm-4 nopadding">
			<div class="form-group">
				<?php $Form_Imputs->select('Tractor','idVehiculo[]', 2, 'idVehiculo', 'Nombre', 'vehiculos_listado', $y,'', $dbConn); ?>	
			</div>
		</div>
		<div class="col-sm-4 nopadding">
			<div class="form-group">
			<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
				$Form_Imputs->select('Equipo Aplicacion','idTelemetria[]', 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w,'', $dbConn);	
			}else{
				$Form_Imputs->select_bodega('Equipo Aplicacion','idTelemetria[]', '', 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
			} ?>
			</div>
		</div>
		<div class="col-sm-4 nopadding">
			<div class="form-group">
				<div class="input-group">
					<?php $Form_Imputs->select('Trabajador Asignado','idTrabajador[]', 2, 'idTrabajador', 'Rut,Nombre,ApellidoPat', 'trabajadores_listado', $m,'', $dbConn); ?>	
					<div class="input-group-btn">
						<button class="btn btn-metis-1 tooltip remove_tractor" type="button" title="Borrar Informacion" > <i class="fa fa-trash-o"></i> </button>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
		
		

</div>
<div class="clearfix"></div>

					
<script>
	
<?php 
$arrCuenta = array();
$query = "SELECT idZona FROM `cross_predios_listado_zonas` WHERE ".$z;
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
array_push( $arrCuenta,$row );
}	
	
?>
	
	
	var room1 = 0;
	var room2 = 0;
	var room3 = 0;
	var incre = 0;


	/**********************************************************/
	//Se agrega cuartel
	function cuartel_add() { 
		//se incrementa en 1
		room1++;
		//se estancian los objetos a clonar
		var objTo    = document.getElementById('insert_cuartel');
		var objclone = document.getElementById('clone_cuartel'),
		//se clonan los div
		clone_cuartel = objclone.cloneNode(true); 
		clone_cuartel.id = 'new_cuartel_'+room1;
		//inserto dentro del div deseado
		objTo.appendChild(clone_cuartel);
    } 
	
	//Se agrega cuartel
	function cuartel_add_2() { 
		//se incrementa en 1
		room1++;
		incre++;
		//se estancian los objetos a clonar
		var objTo    = document.getElementById('insert_cuartel');
		var objclone = document.getElementById('clone_cuartel'),
		//se clonan los div
		clone_cuartel = objclone.cloneNode(true); 
		clone_cuartel.id = 'new_cuartel_'+room1;
		//inserto dentro del div deseado
		objTo.appendChild(clone_cuartel);
		//Autoselecciono los items
		var div = document.getElementById('new_cuartel_'+room1);
		if (div) {
			div.querySelector('select').selectedIndex = incre;
			var subdiv = div.querySelector('select');
			ChangePredio (subdiv);
		}

		
    } 
	//Se agregan todos los cuarteles
	function cuartel_all_add() { 
		<?php foreach ($arrCuenta as $cc) { ?>
			cuartel_add_2();
		<?php } ?>
    }
   
   
   
   
	//se eliminan filas
	$(document).on('click', '.remove_cuartel', function(e) {
		e.preventDefault();
		$(this).parent().parent().parent().parent().parent().remove();
	});
	
	/**********************************************************/
	//Se agrega producto
	function producto_add() { 
		//se incrementa en 1
		room2++;
		//se estancian los objetos a clonar
		var objTo    = document.getElementById('insert_producto');
		var objclone = document.getElementById('clone_producto'),
		//se clonan los div
		clone_producto = objclone.cloneNode(true);
		clone_producto.id = 'new_producto_'+room2; 
		//inserto dentro del div deseado
		objTo.appendChild(clone_producto);
    } 
   
	//se eliminan filas
	$(document).on('click', '.remove_producto', function(e) {
		e.preventDefault();
		$(this).parent().parent().parent().parent().parent().remove();
	});
	
	/**********************************************************/
	//Se agrega tractor
	function tractor_add() { 
		//se incrementa en 1
		room3++;
		//se estancian los objetos a clonar
		var objTo    = document.getElementById('insert_tractor');
		var objclone = document.getElementById('clone_tractor'),
		//se clonan los div
		clone_tractor = objclone.cloneNode(true); 
		clone_tractor.id = 'new_tractor_'+room3;
		//inserto dentro del div deseado
		objTo.appendChild(clone_tractor);
    } 
   
	//se eliminan filas
	$(document).on('click', '.remove_tractor', function(e) {
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
				
		foreach ($arrTipo as $tipo) {
			echo 'var id_data_'.$tipo['idProducto'].'= "'.Cantidades_decimales_justos($tipo['DosisRecomendada']).'";';	
			echo 'var id_med_'.$tipo['idProducto'].'= "'.$tipo['Unimed'].'";';	
		}
		?>
		var selectedOption = select.options[select.selectedIndex];
        var Componente = selectedOption.value;
		if (Componente != "") {
			id_data1=eval("id_data_" + Componente)
			id_data2=eval("id_med_" + Componente)
			//escribo dentro del input
			$(select).closest('.prod_container').find('.escribeme1').val(id_data1);
			$(select).closest('.prod_container').find('.escribeme2').val(id_data2);
		}
    }
    /**********************************************************/
	//se ejecuta al cambiar
	function ChangePredio (select) {
		//variables varias
		<?php
		//Imprimo las variables
		$arrTipo = array();
		$query = "SELECT idZona,Codigo,Hectareas,Hileras,DistanciaPlant,DistanciaHileras
		FROM `cross_predios_listado_zonas`
		WHERE ".$z."
		ORDER BY Nombre ASC";
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
			echo 'var id_codigo_'.$tipo['idZona'].'= "'.$tipo['Codigo'].'";';
			echo 'var id_hectarea_'.$tipo['idZona'].'= "'.Cantidades_decimales_justos($tipo['Hectareas']).'";';	
			echo 'var id_hilera_'.$tipo['idZona'].'= "'.$tipo['Hileras'].'";';	
			echo 'var id_distancia_p_'.$tipo['idZona'].'= "'.Cantidades_decimales_justos($tipo['DistanciaPlant']).'";';	
			echo 'var id_distancia_h_'.$tipo['idZona'].'= "'.Cantidades_decimales_justos($tipo['DistanciaHileras']).'";';	
		}
		?>
		var selectedOption = select.options[select.selectedIndex];
        var Componente = selectedOption.value;
		if (Componente != "") {
			id_data1=eval("id_codigo_" + Componente)
			id_data2=eval("id_hectarea_" + Componente)
			id_data3=eval("id_hilera_" + Componente)
			id_data4=eval("id_distancia_p_" + Componente)
			id_data5=eval("id_distancia_h_" + Componente)
			//escribo dentro del input
			$(select).closest('.cuartel_container').find('.escribeme1').val('Cod: '+id_data1);
			$(select).closest('.cuartel_container').find('.escribeme2').val('Hect: '+id_data2);
			$(select).closest('.cuartel_container').find('.escribeme3').val('Hil: '+id_data3);
			$(select).closest('.cuartel_container').find('.escribeme4').val('D Plantas: '+id_data4);
			$(select).closest('.cuartel_container').find('.escribeme5').val('D Hileras: '+id_data5);
		}
    }
    


</script>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['modBase']) ) { 
//Verifico el tipo de usuario que esta ingresando
$y = "idEstado=1";
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
/*************************************************************/
//filtro
$zx1 = "idCategoria=0";
$zx2 = "idProducto=0";
/************************************/
//Se revisan los permisos a las especies
$arrPermisos = array();
$query = "SELECT idCategoria
FROM `core_sistemas_variedades_categorias`
WHERE idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
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
	$zx1 .= " OR (idCategoria={$prod['idCategoria']})";
}
/************************************/
//Se revisan los permisos a las variantes
$arrPermisos = array();
$query = "SELECT idProducto
FROM `core_sistemas_variedades_listado`
WHERE idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
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
	$zx2 .= " OR (idEstado=1 AND idProducto={$prod['idProducto']})";
}
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
				if(isset($idPrioridad)) {          $x0  = $idPrioridad;          }else{$x0  = $_SESSION['sol_apli_basicos']['idPrioridad'];}
				if(isset($idPredio)) {             $x1  = $idPredio;             }else{$x1  = $_SESSION['sol_apli_basicos']['idPredio'];}
				if(isset($idTemporada)) {          $x2  = $idTemporada;          }else{$x2  = $_SESSION['sol_apli_basicos']['idTemporada'];}
				if(isset($idEstadoFen)) {          $x3  = $idEstadoFen;          }else{$x3  = $_SESSION['sol_apli_basicos']['idEstadoFen'];}
				if(isset($idCategoria)) {          $x4  = $idCategoria;          }else{$x4  = $_SESSION['sol_apli_basicos']['idCategoria'];}
				if(isset($idProducto)) {           $x5  = $idProducto;           }else{$x5  = $_SESSION['sol_apli_basicos']['idProducto'];}
				if(isset($f_programacion)) {       $x6  = $f_programacion;       }else{$x6  = $_SESSION['sol_apli_basicos']['f_programacion'];}
				if(isset($horaProg)) {             $x7  = $horaProg;             }else{$x7  = $_SESSION['sol_apli_basicos']['horaProg'];}
				if(isset($f_programacion_fin)) {   $x8  = $f_programacion_fin;   }else{$x8  = $_SESSION['sol_apli_basicos']['f_programacion_fin'];}
				if(isset($horaProg_fin)) {         $x9  = $horaProg_fin;         }else{$x9  = $_SESSION['sol_apli_basicos']['horaProg_fin'];}
				if(isset($Mojamiento)) {           $x10 = $Mojamiento;           }else{$x10 = Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['Mojamiento']);}
				if(isset($VelTractor)) {           $x11 = $VelTractor;           }else{$x11 = Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['VelTractor']);}
				if(isset($VelViento)) {            $x12 = $VelViento;            }else{$x12 = Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['VelViento']);}
				if(isset($TempMin)) {              $x13 = $TempMin;              }else{$x13 = Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['TempMin']);}
				if(isset($TempMax)) {              $x14 = $TempMax;              }else{$x14 = Cantidades_decimales_justos($_SESSION['sol_apli_basicos']['TempMax']);}
				
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Datos Basicos</h3>';
				$Form_Imputs->form_select('Prioridad','idPrioridad', $x0, 2, 'idPrioridad', 'Nombre', 'core_cross_prioridad', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Predio','idPredio', $x1, 2, 'idPredio', 'Nombre', 'cross_predios_listado', $z, '', $dbConn);
				$Form_Imputs->form_select_filter('Temporada','idTemporada', $x2, 2, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
				$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x3, 2, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
				$Form_Imputs->form_select_depend1('Especie','idCategoria', $x4, 2, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', $zx1, 0,
										 'Variedad','idProducto', $x5, 2, 'idProducto', 'Nombre', 'variedades_listado', $zx2, 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_date('Fecha inicio requerido','f_programacion', $x6, 2);
				$Form_Imputs->form_time('Hora inicio requerido','horaProg', $x7, 2, 1);
				$Form_Imputs->form_date('Fecha termino requerido','f_programacion_fin', $x8, 2);
				$Form_Imputs->form_time('Hora termino requerido','horaProg_fin', $x9, 2, 1);
				
				
				
				echo '<h3>Parámetros de Aplicación</h3>';
				$Form_Imputs->form_input_number_spinner('Mojamiento L/ha','Mojamiento', $x10, 0, 10000, 1, 0, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Tractor Km/hr','VelTractor', $x11, 0, 50, '0.1', 1, 2);
				$Form_Imputs->form_input_number_spinner('Velocidad Viento Km/hr','VelViento', $x12, 0, 50, 1, 0, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura minima','TempMin', $x13, -20, 50, '0.1', 1, 2);
				$Form_Imputs->form_input_number_spinner('Temperatura maxima','TempMax', $x14, -20, 50, '0.1', 1, 2);
				
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('f_creacion', fecha_actual(), 2);
				
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
?>
 
<div class="col-sm-12 fcenter" >

	<?php 
	$ubicacion = $location.'&view=true&crear_solicitud=true';
	$dialogo   = '¿Desea crear ingresar el documento, tenga en cuenta que no podra realizar mas modificaciones una vez creada?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width"><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>
									
									
	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los datos de la Solicitud en curso?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

	<div class="clearfix"></div>
</div> 


<div class="col-sm-11 fcenter table-responsive" style="margin-bottom:30px">

	<div id="page-wrap">
		<div id="header"> SOLICITUD DE APLICACIONES</div>
		<div id="customer"> 
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Prioridad</td>
						<td><?php echo $_SESSION['sol_apli_basicos']['Prioridad']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Predio</td>
						<td><?php echo $_SESSION['sol_apli_basicos']['Predio']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Temporada</td>
						<td><?php echo $_SESSION['sol_apli_basicos']['Temporada']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Estado Fenológico</td>
						<td><?php echo $_SESSION['sol_apli_basicos']['EstadoFen']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Especie - Variedad</td>
						<td><?php echo $_SESSION['sol_apli_basicos']['EspecieVariedad']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Mojamiento</td>
						<td><?php if(isset($_SESSION['sol_apli_basicos']['Mojamiento'])&&$_SESSION['sol_apli_basicos']['Mojamiento']!=''){echo $_SESSION['sol_apli_basicos']['Mojamiento'].' L/ha';} ?></td>
					</tr>
					<tr>
						<td class="meta-head">Vel. Tractor</td>
						<td><?php if(isset($_SESSION['sol_apli_basicos']['VelTractor'])&&$_SESSION['sol_apli_basicos']['VelTractor']!=''){echo $_SESSION['sol_apli_basicos']['VelTractor'].' Km/hr';} ?></td>
					</tr>
					<tr>
						<td class="meta-head">Vel. Viento</td>
						<td><?php if(isset($_SESSION['sol_apli_basicos']['VelViento'])&&$_SESSION['sol_apli_basicos']['VelViento']!=''){echo $_SESSION['sol_apli_basicos']['VelViento'].' Km/hr';} ?></td>
					</tr>
					<tr>
						<td class="meta-head">Temp Min</td>
						<td><?php if(isset($_SESSION['sol_apli_basicos']['TempMin'])&&$_SESSION['sol_apli_basicos']['TempMin']!=''){echo $_SESSION['sol_apli_basicos']['TempMin'].' °';} ?></td>
					</tr>
					<tr>
						<td class="meta-head">Temp Max</td>
						<td><?php if(isset($_SESSION['sol_apli_basicos']['TempMax'])&&$_SESSION['sol_apli_basicos']['TempMax']!=''){echo $_SESSION['sol_apli_basicos']['TempMax'].' °';} ?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha inicio requerido</td>
						<td><?php echo Fecha_estandar($_SESSION['sol_apli_basicos']['f_programacion']).' '.$_SESSION['sol_apli_basicos']['horaProg']?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha termino requerido</td>
						<td><?php echo Fecha_estandar($_SESSION['sol_apli_basicos']['f_programacion_fin']).' '.$_SESSION['sol_apli_basicos']['horaProg_fin']?></td>
					</tr>
					
					
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
						<?php if(isset($_SESSION['sol_apli_basicos']['Mojamiento'])&&$_SESSION['sol_apli_basicos']['Mojamiento']!=''&&$_SESSION['sol_apli_basicos']['Mojamiento']!=0){ ?>
							<a href="<?php echo $location.'&addCuartel=true' ?>" title="Agregar Trabajos" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus"></i> Agregar Trabajos</a>
						<?php } ?>
					</td>
				</tr>
				<?php 
				//recorro el lsiatdo entregado por la base de datos
				if(isset($_SESSION['sol_apli_cuarteles'])&&$_SESSION['sol_apli_cuarteles']!=''){
					foreach ($_SESSION['sol_apli_cuarteles'] as $key => $cuartel){ ?>
						
						<tr class="item-row linea_punteada" style="background: #eee;">
							<td class="item-name"><?php echo $cuartel['CuartelNombre'];?></td>
							<td class="item-name"><?php echo $cuartel['Mojamiento'].' L/ha';?></td>
							<td class="item-name"><?php echo $cuartel['VelTractor'].' Km/hr';?></td>
							<td class="item-name"><?php echo $cuartel['VelViento'].' Km/hr';?></td>
							<td class="item-name"><?php echo $cuartel['TempMin'].' °';?></td>
							<td class="item-name"><?php echo $cuartel['TempMax'].' °';?></td>
							<td>
								<div class="btn-group" style="width: 140px;" >
									<a href="<?php echo $location.'&cuartel_id='.$cuartel['valor_id'].'&edit_Cuarteles=true'; ?>" title="Editar Cuartel" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
									<a href="<?php echo $location.'&cuartel_id='.$cuartel['valor_id'].'&add_trac=true'; ?>" title="Agregar Tractor" class="btn btn-primary btn-sm tooltip"><i class="fa fa-truck"></i></a>
									<a href="<?php echo $location.'&cuartel_id='.$cuartel['valor_id'].'&add_prod=true'; ?>" title="Agregar Producto Químico" class="btn btn-primary btn-sm tooltip"><i class="fa fa-flask"></i></a>
									<?php 
									$ubicacion = $location.'&del_cuartel='.$cuartel['valor_id'];
									$dialogo   = '¿Realmente deseas eliminar el cuartel '.$cuartel['CuartelNombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Cuartel" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
								</div>
							</td>
						</tr> 
						
						<?php 
						/****************************************************************/
						if($_SESSION['sol_apli_tractores'][$cuartel['valor_id']]){
							//Se recorren los tractores
							foreach ($_SESSION['sol_apli_tractores'][$cuartel['valor_id']] as $key => $tract){
								?>
								
								<tr class="item-row linea_punteada">
									<td class="item-name" colspan="2">
										<i class="fa fa-truck"></i>
										<?php echo '<strong>Tractor: </strong>'.$tract['Vehiculo'];?>
									</td>
									<td class="item-name" colspan="2"><?php echo '<strong>Equipo Aplicación: </strong>'.$tract['Telemetria'];?></td>
									<td class="item-name" colspan="2"><?php echo '<strong>Trabajador: </strong>'.$tract['Trabajador'];?></td>
									<td>
										<div class="btn-group" style="width: 70px;" >
											<a href="<?php echo $location.'&cuartel_id='.$cuartel['valor_id'].'&edit_trac='.$tract['valor_id']; ?>" title="Editar Tractor" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
											<?php 
											$ubicacion = $location.'&cuartel_id='.$cuartel['valor_id'].'&del_trac='.$tract['valor_id'];
											$dialogo   = '¿Realmente deseas eliminar el tractor '.$tract['Vehiculo'].'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Tractor" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
										</div>
									</td>
								</tr> 
				
							<?php
							}
						}
						/****************************************************************/
						if($_SESSION['sol_apli_productos'][$cuartel['valor_id']]){
							//Se recorren los quimicos a utilizar
							foreach ($_SESSION['sol_apli_productos'][$cuartel['valor_id']] as $key => $prod){?>
								
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
											<a href="<?php echo $location.'&cuartel_id='.$cuartel['valor_id'].'&edit_prod='.$prod['valor_id']; ?>" title="Editar Producto Quimico" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
											<?php 
											$ubicacion = $location.'&cuartel_id='.$cuartel['valor_id'].'&del_prod='.$prod['valor_id'];
											$dialogo   = '¿Realmente deseas eliminar el producto '.$prod['Producto'].'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Producto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
										</div>
									</td>
								</tr> 
						
							<?php
							}
						}
					}
				}else{
					echo '<tr class="item-row linea_punteada"><td colspan="7">No hay cuarteles asignados</td></tr>';
				} ?>
				
				<?php /**********************************************************************************/ ?> 
				<tr id="hiderow"><td colspan="7"><a name="Ancla_obs"></a></td></tr>
				<tr>
					<?php if(isset($_SESSION['sol_apli_basicos']['Observaciones'])&&$_SESSION['sol_apli_basicos']['Observaciones']!=''){ ?>
						<td colspan="6" class="blank word_break"><?php echo $_SESSION['sol_apli_basicos']['Observaciones'];?></td>
						<td class="blank">
							<div class="btn-group" style="width: 35px;" >
								<?php 
								$ubicacion = $location.'&view=true&del_obs=true';
								$dialogo   = '¿Realmente deseas eliminar la observacion?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Observacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
							</div>
						</td>
					<?php }else{?>
						<td colspan="6" class="blank"> 
							<?php 
							$non = '';
							if(isset($_SESSION['sol_apli_temporal'])&&$_SESSION['sol_apli_temporal']!=''){
								$non = $_SESSION['sol_apli_temporal'];
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
				<tr><td colspan="6" class="blank"><p>Observacion</p></td></tr>
				
			</tbody>
		</table>
		<div class="clearfix"></div>
			
	</div>


</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//Verifico el tipo de usuario que esta ingresando
$y = "idEstado=1";
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
/*************************************************************/
//filtro
$zx1 = "idCategoria=0";
$zx2 = "idProducto=0";
/************************************/
//Se revisan los permisos a las especies
$arrPermisos = array();
$query = "SELECT idCategoria
FROM `core_sistemas_variedades_categorias`
WHERE idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
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
	$zx1 .= " OR (idCategoria={$prod['idCategoria']})";
}
/************************************/
//Se revisan los permisos a las variantes
$arrPermisos = array();
$query = "SELECT idProducto
FROM `core_sistemas_variedades_listado`
WHERE idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
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
	$zx2 .= " OR (idEstado=1 AND idProducto={$prod['idProducto']})";
} 
 ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nueva Solicitud de Aplicacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idPrioridad)) {          $x0  = $idPrioridad;          }else{$x0  = '';}
				if(isset($idPredio)) {             $x1  = $idPredio;             }else{$x1  = '';}
				if(isset($idTemporada)) {          $x2  = $idTemporada;          }else{$x2  = '';}
				if(isset($idEstadoFen)) {          $x3  = $idEstadoFen;          }else{$x3  = '';}
				if(isset($idCategoria)) {          $x4  = $idCategoria;          }else{$x4  = '';}
				if(isset($idProducto)) {           $x5  = $idProducto;           }else{$x5  = '';}
				if(isset($f_programacion)) {       $x6  = $f_programacion;       }else{$x6  = '';}
				if(isset($horaProg)) {             $x7  = $horaProg;             }else{$x7  = '';}
				if(isset($f_programacion_fin)) {   $x8  = $f_programacion_fin;   }else{$x8  = '';}
				if(isset($horaProg_fin)) {         $x9  = $horaProg_fin;         }else{$x9  = '';}
				if(isset($Observaciones)) {        $x10 = $Observaciones;        }else{$x10 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Prioridad','idPrioridad', $x0, 2, 'idPrioridad', 'Nombre', 'core_cross_prioridad', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Predio','idPredio', $x1, 2, 'idPredio', 'Nombre', 'cross_predios_listado', $z, '', $dbConn);
				$Form_Imputs->form_select_filter('Temporada','idTemporada', $x2, 2, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
				$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x3, 2, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
				$Form_Imputs->form_select_depend1('Especie','idCategoria', $x4, 2, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', $zx1, 0,
										 'Variedad','idProducto', $x5, 2, 'idProducto', 'Nombre', 'variedades_listado', $zx2, 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_date('Fecha inicio requerido','f_programacion', $x6, 2);
				$Form_Imputs->form_time('Hora inicio requerido','horaProg', $x7, 2, 1);
				$Form_Imputs->form_date('Fecha termino requerido','f_programacion_fin', $x8, 2);
				$Form_Imputs->form_time('Hora termino requerido','horaProg_fin', $x9, 2, 1);
				$Form_Imputs->form_textarea('Observaciones','Observaciones', $x10, 2, 160);
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('f_creacion', fecha_actual(), 2);
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
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
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
		case 'id_asc':        $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud ASC ';                         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> ID Ascendente'; break;
		case 'id_desc':       $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC ';                        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> ID Descendente';break;
		case 'fprog_asc':     $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.f_programacion ASC ';                      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Programacion Ascendente';break;
		case 'fprog_desc':    $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.f_programacion DESC ';                     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Programacion Descendente';break;
		case 'predio_asc':    $order_by = 'ORDER BY cross_predios_listado.Nombre ASC ';                                           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Predio Ascendente'; break;
		case 'predio_desc':   $order_by = 'ORDER BY cross_predios_listado.Nombre DESC ';                                          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Predio Descendente';break;
		case 'especie_asc':   $order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC, variedades_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Especie/Variedad Ascendente'; break;
		case 'especie_desc':  $order_by = 'ORDER BY sistema_variedades_categorias.Nombre DESC, variedades_listado.Nombre DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Especie/Variedad Descendente';break;
		
	
		default: $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Solicitud Descendente';
	}
}else{
	$order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Solicitud Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE cross_solicitud_aplicacion_listado.idSolicitud!=0";
$z .= " AND cross_solicitud_aplicacion_listado.idEstado = 1"; //Solo las programadas
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.= " AND cross_solicitud_aplicacion_listado.idSistema>=0";	
	$usrfil = 'usuarios_sistemas.idSistema>=0  AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
	$y = "idEstado=1";
	$x = "idSistema>=0 AND idEstado=1";	
}else{
	$z.= " AND cross_solicitud_aplicacion_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
	$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
	$y = "idEstado=1";
	$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $z .= " AND cross_solicitud_aplicacion_listado.idProducto=".$_GET['idProducto'];}
if(isset($_GET['f_programacion']) && $_GET['f_programacion'] != ''){  $z .= " AND cross_solicitud_aplicacion_listado.f_programacion=".$_GET['f_programacion'];}
if(isset($_GET['horaProg']) && $_GET['horaProg'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.horaProg=".$_GET['horaProg'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND cross_solicitud_aplicacion_listado.idUsuario=".$_GET['idUsuario'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idSolicitud FROM `cross_solicitud_aplicacion_listado` 
LEFT JOIN `cross_predios_listado`           ON cross_predios_listado.idPredio             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `sistema_variedades_categorias`   ON sistema_variedades_categorias.idCategoria  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`              ON variedades_listado.idProducto              = cross_solicitud_aplicacion_listado.idProducto
".$z;
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
$arrOTS = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado.f_programacion,
cross_solicitud_aplicacion_listado.f_ejecucion,
cross_predios_listado.Nombre AS NombrePredio,
sistema_variedades_categorias.Nombre AS Especie,
variedades_listado.Nombre AS Variedad

FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `cross_predios_listado`           ON cross_predios_listado.idPredio             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `sistema_variedades_categorias`   ON sistema_variedades_categorias.idCategoria  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`              ON variedades_listado.idProducto              = cross_solicitud_aplicacion_listado.idProducto
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
array_push( $arrOTS,$row );
}


				
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){
	if (isset($_SESSION['sol_apli_basicos']['idPredio'])&&$_SESSION['sol_apli_basicos']['idPredio']!=''){?>
		
		<?php 
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
		
		<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Solicitud</a>
	<?php }else{?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Solicitud</a>
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
				if(isset($idSolicitud)) {      $x1  = $idSolicitud;      }else{$x1  = '';}
				if(isset($idPredio)) {         $x2  = $idPredio;         }else{$x2  = '';}
				if(isset($idTemporada)) {      $x3  = $idTemporada;      }else{$x3  = '';}
				if(isset($idEstadoFen)) {      $x4  = $idEstadoFen;      }else{$x4  = '';}
				if(isset($idCategoria)) {      $x5  = $idCategoria;      }else{$x5  = '';}
				if(isset($idProducto)) {       $x6  = $idProducto;       }else{$x6  = '';}
				if(isset($f_programacion)) {   $x7  = $f_programacion;   }else{$x7  = '';}
				if(isset($horaProg)) {         $x8  = $horaProg;         }else{$x8  = '';}
				if(isset($idUsuario)) {        $x9  = $idUsuario;        }else{$x9  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_number('N° Solicitud','idSolicitud', $x1, 1);
				$Form_Imputs->form_select_filter('Predio','idPredio', $x2, 1, 'idPredio', 'Nombre', 'cross_predios_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Temporada','idTemporada', $x3, 1, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
				$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x4, 1, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
				$Form_Imputs->form_select_depend1('Especie','idCategoria', $x5, 1, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, 0,
										 'Variedad','idProducto', $x6, 1, 'idProducto', 'Nombre', 'variedades_listado', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_date('Fecha Programada','f_programacion', $x7, 1);
				$Form_Imputs->form_time('Hora Programada','horaProg', $x8, 1, 2);
				$Form_Imputs->form_select_join_filter('Usuario Creador','idUsuario', $x9, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Solicitudes de Aplicacion</h5>
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
						<th width="100">
							<div class="pull-left">#</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=id_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=id_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="140">
							<div class="pull-left">F Solicitud</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fprog_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fprog_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Predio</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=predio_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=predio_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Especie/Variedad</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=especie_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=especie_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrOTS as $ot) { ?>
						<tr class="odd">		
							<td><?php echo n_doc($ot['idSolicitud'], 5); ?></td>	
							<td><?php echo Fecha_estandar($ot['f_programacion']); ?></td>	
							<td><?php echo $ot['NombrePredio']; ?></td>
							<td><?php echo $ot['Especie'].' '.$ot['Variedad']; ?></td>
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_solicitud_aplicacion.php?view='.$ot['idSolicitud']; ?>" title="Ver Solicitud" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a target="_blank" rel="noopener noreferrer" href="<?php echo 'cross_solicitud_aplicacion_editar.php?view='.$ot['idSolicitud']; ?>" title="Editar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del_Solicitud='.$ot['idSolicitud'];
										$dialogo   = '¿Realmente deseas eliminar el registro de la Solicitud  '.n_doc($ot['idSolicitud'], 5).'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
<?php require_once '../LIBS_js/modal/modal.php';?>
<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
