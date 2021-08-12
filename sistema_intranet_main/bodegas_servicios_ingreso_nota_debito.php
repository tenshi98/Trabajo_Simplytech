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
$original = "bodegas_servicios_ingreso_nota_debito.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idProveedor']) && $_GET['idProveedor'] != ''){            $location .= "&idProveedor=".$_GET['idProveedor'];              $search .= "&idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos'] != ''){          $location .= "&idDocumentos=".$_GET['idDocumentos'];            $search .= "&idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                        $location .= "&N_Doc=".$_GET['N_Doc'];                          $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];        $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano'] != ''){          $location .= "&Creacion_ano=".$_GET['Creacion_ano'];            $search .= "&Creacion_ano=".$_GET['Creacion_ano'];}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes'] != ''){          $location .= "&Creacion_mes=".$_GET['Creacion_mes'];            $search .= "&Creacion_mes=".$_GET['Creacion_mes'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones'] != ''){        $location .= "&Observaciones=".$_GET['Observaciones'];          $search .= "&Observaciones=".$_GET['Observaciones'];}
if(isset($_GET['idUsoIVA']) && $_GET['idUsoIVA'] != ''){                  $location .= "&idUsoIVA=".$_GET['idUsoIVA'];                    $search .= "&idUsoIVA=".$_GET['idUsoIVA'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_ingreso_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//formulario para editar
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modBase_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//formulario para editar
if ( !empty($_GET['clear_all']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clear_all_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//formulario para editar
if ( !empty($_POST['submit_modCentroCosto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modCentroCosto_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_prod']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_prod_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_prod']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_prod_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//se borra un dato
if ( !empty($_GET['del_prod']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_prod_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_otros']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_otros_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//formulario para crear
if ( !empty($_POST['submit_edit_otros']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'edit_otros_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//se borra un dato
if ( !empty($_GET['del_otros']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_otros_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_file']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_file_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_file_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';	
}
/**********************************************/
//formulario para crear
if ( !empty($_POST['submit_impuesto']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'new_impuesto_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';
}
//se borra un dato
if ( !empty($_GET['del_impuesto']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_impuesto_ing_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';	
}
/**********************************************/
if ( !empty($_GET['ing_bodega_nd']) )     {
	//Llamamos al formulario
	$form_trabajo= 'ing_bodega_nd';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_servicios.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Nota de Debito Realizada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Nota de Debito Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Nota de Debito borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['addFile']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Subir Archivo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate enctype="multipart/form-data">
			
				<?php           
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_multiple_upload('Seleccionar archivo','exFile', 1, '"jpg", "png", "gif", "jpeg", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"');
					
				?> 

				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_file"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>              
		</div>
	</div>
</div>	

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editProd']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Ingreso de Servicio</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idServicio)) {       $x1  = $idServicio;      }else{$x1  = $_SESSION['servicios_ing_nd_productos'][$_GET['editProd']]['idServicio'];}
				if(isset($Cantidad_ing)) {   $x2  = $Cantidad_ing;  }else{$x2  = Cantidades_decimales_justos($_SESSION['servicios_ing_nd_productos'][$_GET['editProd']]['Cantidad_ing']);}
				if(isset($idFrecuencia)) {   $x3  = $idFrecuencia;  }else{$x3  = $_SESSION['servicios_ing_nd_productos'][$_GET['editProd']]['idFrecuencia'];}
				if(isset($ValorTotal)) {     $x4  = $ValorTotal;    }else{$x4  = Cantidades_decimales_justos($_SESSION['servicios_ing_nd_productos'][$_GET['editProd']]['ValorTotal']);}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Servicios','idServicio', $x1, 2, 'idServicio', 'Nombre', 'servicios_listado', 'idEstado=1', '', $dbConn);
				$Form_Inputs->form_select_disabled('Servicios','idServicio_fake', $x1, 2, 'idServicio', 'Nombre', 'servicios_listado', 'idEstado=1', $dbConn);
				
				$Form_Inputs->form_input_number('Cantidad', 'Cantidad_ing', $x2, 2);
			
				$Form_Inputs->form_select('Frecuencia','idFrecuencia', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, '', $dbConn);
				$Form_Inputs->form_select_disabled('Frecuencia','idFrecuencia_fake', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, $dbConn);
				
				$Form_Inputs->form_input_disabled('Valor Unitario Neto','Unitario', Cantidades_decimales_justos($_SESSION['servicios_ing_nd_productos'][$_GET['editProd']]['ValorIngreso']), 1);
				$Form_Inputs->form_input_number('Valor Total Neto', 'ValorTotal', $x4, 2);
				$Form_Inputs->form_input_hidden('vUnitario', Cantidades_decimales_justos($_SESSION['servicios_ing_nd_productos'][$_GET['editProd']]['ValorIngreso']), 2);
				
				echo operacion_input('Cantidad_ing', 'ValorTotal', 'Unitario', 'vUnitario', 4);
				
				
				$Form_Inputs->form_input_hidden('oldItemID', $_GET['editProd'], 2);
				?>
				
				<script>
					<?php if(isset($_SESSION['servicios_ing_nd_basicos']['idOcompra']) && $_SESSION['servicios_ing_nd_basicos']['idOcompra']!=''){ ?>
						document.getElementById("div_idServicio").style.display = 'none';
						document.getElementById("div_idFrecuencia").style.display = 'none';
						document.getElementById("div_idServicio_fake").style.display = '';
						document.getElementById("div_idFrecuencia_fake").style.display = '';
					<?php }else{ ?>
						document.getElementById("div_idServicio").style.display = '';
						document.getElementById("div_idFrecuencia").style.display = '';
						document.getElementById("div_idServicio_fake").style.display = 'none';
						document.getElementById("div_idFrecuencia_fake").style.display = 'none';
					<?php } ?>
				</script>
				
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_prod"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addProd']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Servicio</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idServicio)) {       $x1  = $idServicio;      }else{$x1  = '';}
				if(isset($Cantidad_ing)) {   $x2  = $Cantidad_ing;  }else{$x2  = '';}
				if(isset($idFrecuencia)) {   $x3  = $idFrecuencia;  }else{$x3  = '';}
				if(isset($ValorTotal)) {     $x4  = $ValorTotal;    }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Servicios','idServicio', $x1, 2, 'idServicio', 'Nombre', 'servicios_listado', 'idEstado=1', '', $dbConn);
				$Form_Inputs->form_input_number('Cantidad', 'Cantidad_ing', $x2, 2);
				$Form_Inputs->form_select('Frecuencia','idFrecuencia', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, '', $dbConn);
				
				$Form_Inputs->form_input_disabled('Valor Unitario Neto','Unitario', '', 1);
				$Form_Inputs->form_input_number('Valor Total Neto', 'ValorTotal', $x4, 2);
				$Form_Inputs->form_input_hidden('vUnitario', '', 2);
				
				echo operacion_input('Cantidad_ing', 'ValorTotal', 'Unitario', 'vUnitario', 4);
				
				
				?>
				 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_prod"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addImpuesto']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Impuestos</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idImpuesto )) {       $x1  = $idImpuesto ;      }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Impuestos','idImpuesto', $x1, 2, 'idImpuesto', 'Nombre', 'sistema_impuestos', 0, '', $dbConn);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_impuesto"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editOtros']) ) {  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Otros</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {  $x1  = $Nombre;  }else{$x1  = $_SESSION['servicios_ing_nd_otros'][$_GET['editOtros']]['Nombre'];}
				if(isset($vTotal)) {  $x2  = $vTotal;  }else{$x2  = Cantidades_decimales_justos($_SESSION['servicios_ing_nd_otros'][$_GET['editOtros']]['vTotal']);}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);
				
				$Form_Inputs->form_input_hidden('oldidProducto', $_SESSION['servicios_ing_nd_otros'][$_GET['editOtros']]['idOtros'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_otros"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>                
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['addOtros']) ) {  ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Otros</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {  $x1  = $Nombre;  }else{$x1  = '';}
				if(isset($vTotal)) {  $x2  = $vTotal;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_number('Valor Total Neto', 'vTotal', $x2, 2);

				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_otros"> 
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>                
		</div>
	</div>
</div>


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
				if(isset($idCentroCosto)) {  $x1  = $idCentroCosto;  }else{$x1  = $_SESSION['servicios_ing_nd_basicos']['idCentroCosto'];}
				if(isset($idLevel_1)) {      $x2  = $idLevel_1;      }else{$x2  = $_SESSION['servicios_ing_nd_basicos']['idLevel_1'];}
				if(isset($idLevel_2)) {      $x3  = $idLevel_2;      }else{$x3  = $_SESSION['servicios_ing_nd_basicos']['idLevel_2'];}
				if(isset($idLevel_3)) {      $x4  = $idLevel_3;      }else{$x4  = $_SESSION['servicios_ing_nd_basicos']['idLevel_3'];}
				if(isset($idLevel_4)) {      $x5  = $idLevel_4;      }else{$x5  = $_SESSION['servicios_ing_nd_basicos']['idLevel_4'];}
				if(isset($idLevel_5)) {      $x6  = $idLevel_5;      }else{$x6  = $_SESSION['servicios_ing_nd_basicos']['idLevel_5'];}
				
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
//Verifico el tipo de usuario que esta ingresando
$w="idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

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
				if(isset($idProveedor)) {        $x1  = $idProveedor;      }else{$x1  = $_SESSION['servicios_ing_nd_basicos']['idProveedor'];}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = $_SESSION['servicios_ing_nd_basicos']['N_Doc'];}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'];}
				if(isset($Observaciones)) {      $x4  = $Observaciones;    }else{$x4  = $_SESSION['servicios_ing_nd_basicos']['Observaciones'];}
				if(isset($idUsoIVA)) {           $x5  = $idUsoIVA;         }else{$x5  = $_SESSION['servicios_ing_nd_basicos']['idUsoIVA'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 2, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x3, 2);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				$Form_Inputs->form_post_data(1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opcion <strong>SI</strong>, para el resto es de uso obligatorio la opcion <strong>NO</strong>. ');
				$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x5, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 10, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idDocumentos', 4, 2);
				
				
				?> 

				<script>
					document.getElementById('div_fecha_fact_desde').style.display = 'none';
					document.getElementById('div_fecha_fact_hasta').style.display = 'none';
					
					var idDocumentos;
					var idDocumentosSelected;
					
					//se ejecuta al cargar la página (OBLIGATORIO)
					$(document).ready(function(){ 
							
						idDocumentosSelected= $("#idDocumentos").val();
						//si es Factura
						if(idDocumentosSelected == 2){ 
							document.getElementById('div_fecha_fact_desde').style.display = '';
							document.getElementById('div_fecha_fact_hasta').style.display = '';
															
						//Para el resto
						} else { 
							document.getElementById('div_fecha_fact_desde').style.display = 'none';
							document.getElementById('div_fecha_fact_hasta').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementsByName('fecha_fact_desde').value = "0";
							document.getElementsByName('fecha_fact_hasta').value = "0";
						}
							
					}); 
						
					$("#idDocumentos").on("change", function(){ //se ejecuta al cambiar valor del select
						idDocumentos = $(this).val(); //Asignamos el valor seleccionado
					
						//si es Factura
						if(idDocumentos == 2){ 
							document.getElementById('div_fecha_fact_desde').style.display = '';
							document.getElementById('div_fecha_fact_hasta').style.display = '';
															
						//Para el resto
						} else { 
							document.getElementById('div_fecha_fact_desde').style.display = 'none';
							document.getElementById('div_fecha_fact_hasta').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementsByName('fecha_fact_desde').value = "0";
							document.getElementsByName('fecha_fact_hasta').value = "0";
						}
					});

				</script>

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
?>

<div class="col-sm-12" style="margin-bottom:30px">

	<?php 		
	$ubicacion = $location.'&view=true&ing_bodega_nd=true';
	$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?<br/>Revise si los <strong>montos</strong> y <strong>cantidades</strong> coinciden con el documento ingresado.';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary fright margin_width" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>			

	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

	<?php 
	$ubicacion = $location.'&clear_all=true';
	$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
	<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

	<div class="clearfix"></div>
</div> 

<div class="col-sm-12">

	<div id="page-wrap">
		<div id="header"> <?php echo $_SESSION['servicios_ing_nd_basicos']['TipoDocumento']; ?></div>

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip fright" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Proveedor</td>
						<td><?php echo $_SESSION['servicios_ing_nd_basicos']['Proveedor']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Documento</td>
						<td><?php echo $_SESSION['servicios_ing_nd_basicos']['Documento'].' N°'.$_SESSION['servicios_ing_nd_basicos']['N_Doc']?></td>
					</tr>
					<tr>
						<td class="meta-head"><strong>Centro de Costo</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modCentroCosto=true' ?>" title="Modificar Centro de Costo" class="btn btn-xs btn-primary fright tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Centro de Costo</td>
						<td><?php echo $_SESSION['servicios_ing_nd_basicos']['CentroCosto']; ?></td>
					</tr>
					<?php if(isset($_SESSION['servicios_ing_nd_basicos']['idUsoIVA'])&&$_SESSION['servicios_ing_nd_basicos']['idUsoIVA']==1){ ?>
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
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])?></td>
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
					<td colspan="5">Servicio a Ingresar</td>
					<td>
						<a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Servicio" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Servicio</a>
					</td>
				</tr>
				<?php 
				$vtotal_neto = 0;
				if (isset($_SESSION['servicios_ing_nd_productos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['servicios_ing_nd_productos'] as $key => $producto){
						$vtotal_neto = $vtotal_neto + $producto['ValorTotal']; ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="2">
								<?php echo $producto['Servicio'];?>
							</td>
							<td class="item-name">
								<?php echo Cantidades_decimales_justos($producto['Cantidad_ing']).' '.$producto['Frecuencia'];?>
							</td>
							<td class="item-name" align="right">
								<?php echo valores($producto['ValorIngreso'], 0).' x '.$producto['Frecuencia'];?>
							</td>
							<td class="item-name" align="right">
								<?php echo Valores(Cantidades_decimales_justos($producto['ValorTotal']), 0);?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editProd='.$producto['idServicio']; ?>" title="Editar Servicio" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<?php 
									$ubicacion = $location.'&del_prod='.$producto['idServicio'];
									$dialogo   = '¿Realmente deseas eliminar el servicio '.str_replace('"','',$producto['Servicio']).'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Servicio" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
								</div>
							</td>
						</tr> 
				<?php }
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>';?>
				
				
				<tr class="item-row fact_tittle">
					<td colspan="5">Otros a Ingresar</td>
					<td><a href="<?php echo $location.'&addOtros=true' ?>" title="Agregar Otro" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Otros</a></td>
				</tr>
				<?php 
				if (isset($_SESSION['servicios_ing_nd_otros'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['servicios_ing_nd_otros'] as $key => $producto){
						$vtotal_neto = $vtotal_neto + $producto['vTotal'];?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="4"><?php echo $producto['Nombre'];?></td>
							<td class="item-name" align="right">
								<?php echo valores($producto['vTotal'], 0);?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editOtros='.$producto['idOtros']; ?>" title="Editar Otros" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<?php if(!isset($_GET['soli']) OR $_GET['soli']==''){ ?>	
										<?php 
										$ubicacion = $location.'&del_otros='.$producto['idOtros'];
										$dialogo   = '¿Realmente deseas eliminar  '.$producto['Nombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Otros" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
									<?php } ?>
								</div>
							</td>
						</tr> 
					 <?php 	
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>';?>
				
				
		
				<?php  //Guardo el neto
				$_SESSION['servicios_ing_nd_basicos']['valor_neto_fact'] = $vtotal_neto;
				?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"><strong>Subtotal Neto</strong></td> 
						<td align="right"><?php echo Valores($vtotal_neto, 0);?></td>
						<td></td>
					</tr>
					
					
					<?php  //Guardo el neto imponible
					$_SESSION['servicios_ing_nd_basicos']['valor_neto_imp'] = $vtotal_neto;
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
					if (isset($_SESSION['servicios_ing_nd_impuestos'])){
						//guardo el valor neto
						$tempa = $vtotal_neto;
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['servicios_ing_nd_impuestos'] as $key => $producto){
							//se hacen los calculos matematicos
							$vtotal_IVA = ($tempa / 100) * $producto['Porcentaje'];
							$vtotal_neto = $vtotal_neto + $vtotal_IVA;
							//se guardan los valores en variables de sesion
							$_SESSION['servicios_ing_nd_impuestos'][$producto['idImpuesto']]['valor'] = $vtotal_IVA;
									
							?>
							<tr class="invoice-total" bgcolor="#f1f1f1">
								<td colspan="4" align="right"><strong><?php echo $producto['Nombre'].' ('.Cantidades_decimales_justos($producto['Porcentaje']).'%)';?></strong></td>      
								<td align="right">
									<?php echo Valores($vtotal_IVA, 0);?>
								</td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php 
										$ubicacion = $location.'&del_impuesto='.$producto['idImpuesto'];
										$dialogo   = '¿Realmente deseas eliminar el impuesto '.$producto['Nombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Impuesto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
									</div>
								</td>
							</tr>
					<?php }
					}
					//guardo el total
					$_SESSION['servicios_ing_nd_basicos']['valor_total_fact'] = $vtotal_neto;?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"> <strong>Total</strong></td>    
						<td align="right"><?php echo Valores($vtotal_neto, 0);?></td>
						<td></td>
					</tr>
					
			</tbody>
		</table>
    </div>
    
    <div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['servicios_ing_nd_basicos']['Observaciones'];?></p>
		</div>
	</div>
    
    <table id="items" style="margin-bottom: 20px;">
        <tbody>
            
			<tr class="invoice-total" bgcolor="#f1f1f1">
                <td colspan="5">Archivos Adjuntos</td>
                <td width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></td>
            </tr>		  
            
			<?php 
			if (isset($_SESSION['servicios_ing_nd_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['servicios_ing_nd_archivos'] as $key => $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $numeral.' - '.$producto['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()); ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<?php 
								$ubicacion = $location.'&del_file='.$producto['idFile'];
								$dialogo   = '¿Realmente deseas eliminar  '.str_replace('"','',$producto['Nombre']).'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Archivo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>								
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

<?php widget_modal(80, 95); ?>
<div class="clearfix"></div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
 ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Ingresar Nota de Debito</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idProveedor)) {        $x1  = $idProveedor;      }else{$x1  = '';}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = '';}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = '';}
				if(isset($Observaciones)) {      $x4  = $Observaciones;    }else{$x4  = '';}
				if(isset($idUsoIVA)) {           $x5  = $idUsoIVA;         }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 2, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 2);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x3, 2);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x4, 1, 160);
				$Form_Inputs->form_post_data(1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opcion <strong>SI</strong>, para el resto es de uso obligatorio la opcion <strong>NO</strong>. ');
				$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x5, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 10, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idDocumentos', 4, 2);
						
				?>
				
				<script>
					document.getElementById('div_fecha_fact_desde').style.display = 'none';
					document.getElementById('div_fecha_fact_hasta').style.display = 'none';
						
					var idDocumentos;
						
					$("#idDocumentos").on("change", function(){ //se ejecuta al cambiar valor del select
						idDocumentos = $(this).val(); //Asignamos el valor seleccionado
					
						//si es Factura
						if(idDocumentos == 2){ 
							document.getElementById('div_fecha_fact_desde').style.display = '';
							document.getElementById('div_fecha_fact_hasta').style.display = '';
															
						//Para el resto
						} else { 
							document.getElementById('div_fecha_fact_desde').style.display = 'none';
							document.getElementById('div_fecha_fact_hasta').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementsByName('fecha_fact_desde').value = "0";
							document.getElementsByName('fecha_fact_hasta').value = "0";
						}
					});

				</script>
				
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
		case 'proveedor_asc':  $order_by = 'ORDER BY proveedor_listado.Nombre ASC ';                       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Proveedor Ascendente'; break;
		case 'proveedor_desc': $order_by = 'ORDER BY proveedor_listado.Nombre DESC ';                      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Proveedor Descendente';break;
		case 'fecha_asc':      $order_by = 'ORDER BY bodegas_servicios_facturacion.Creacion_fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':     $order_by = 'ORDER BY bodegas_servicios_facturacion.Creacion_fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'doc_asc':        $order_by = 'ORDER BY core_documentos_mercantiles.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Documento Ascendente';break;
		case 'doc_desc':       $order_by = 'ORDER BY core_documentos_mercantiles.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Documento Descendente';break;
		
		default: $order_by = 'ORDER BY bodegas_servicios_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY bodegas_servicios_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

/**********************************************************/
//Variable con la ubicacion
$z="WHERE bodegas_servicios_facturacion.idTipo=10";//Solo ingresos
//Verifico el tipo de usuario que esta ingresando
$z.=" AND bodegas_servicios_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idProveedor']) && $_GET['idProveedor'] != ''){            $z .= " AND bodegas_servicios_facturacion.idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos'] != ''){          $z .= " AND bodegas_servicios_facturacion.idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc'] != ''){                        $z .= " AND bodegas_servicios_facturacion.N_Doc LIKE '%".$_GET['N_Doc']."%'";}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){      $z .= " AND bodegas_servicios_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano'] != ''){          $z .= " AND bodegas_servicios_facturacion.Creacion_ano='".$_GET['Creacion_ano']."'";}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes'] != ''){          $z .= " AND bodegas_servicios_facturacion.Creacion_mes='".$_GET['Creacion_mes']."'";}
if(isset($_GET['Observaciones']) && $_GET['Observaciones'] != ''){        $z .= " AND bodegas_servicios_facturacion.Observaciones LIKE '%".$_GET['Observaciones']."%'";}
if(isset($_GET['idUsoIVA']) && $_GET['idUsoIVA'] != ''){                  $z .= " AND bodegas_servicios_facturacion.idUsoIVA=".$_GET['idUsoIVA'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idFacturacion FROM `bodegas_servicios_facturacion` ".$z;
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
bodegas_servicios_facturacion.idFacturacion,
bodegas_servicios_facturacion.Creacion_fecha,
bodegas_servicios_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
proveedor_listado.Nombre AS Proveedor

FROM `bodegas_servicios_facturacion`
LEFT JOIN `core_sistemas`                   ON core_sistemas.idSistema                      = bodegas_servicios_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles`     ON core_documentos_mercantiles.idDocumentos     = bodegas_servicios_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`               ON proveedor_listado.idProveedor                = bodegas_servicios_facturacion.idProveedor
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
	
	<?php if ($rowlevel['level']>=3){ ?>
		<?php if (isset($_SESSION['servicios_ing_nd_basicos']['idProveedor'])&&$_SESSION['servicios_ing_nd_basicos']['idProveedor']!=''){?>
			
			<?php 
			$ubicacion = $location.'&clear_all=true';
			$dialogo   = '¿Realmente deseas eliminar todos los registros?';?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>
			
			<a href="<?php echo $location; ?>&view=true" class="btn btn-default fright margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Nota de Debito</a>
		<?php }else{ ?>
			<a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Ingresar Nota de Debito</a>
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
				if(isset($idProveedor)) {        $x1  = $idProveedor;      }else{$x1  = '';}
				if(isset($N_Doc)) {              $x2  = $N_Doc;            }else{$x2  = '';}
				if(isset($Creacion_fecha)) {     $x3  = $Creacion_fecha;   }else{$x3  = '';}
				if(isset($Creacion_ano)) {       $x4  = $Creacion_ano;     }else{$x4  = '';}
				if(isset($Creacion_mes)) {       $x5  = $Creacion_mes;     }else{$x5  = '';}
				if(isset($Observaciones)) {      $x6  = $Observaciones;    }else{$x6  = '';}
				if(isset($idUsoIVA)) {           $x7  = $idUsoIVA;         }else{$x7  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 1, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x2, 1);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x3, 1);
				$Form_Inputs->form_select_n_auto('Año Documento','Creacion_ano', $x4, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes Documento','Creacion_mes', $x5, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'ORDER BY idMes ASC', $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x6, 1, 160);
				$Form_Inputs->form_post_data(1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opcion <strong>SI</strong>, para el resto es de uso obligatorio la opcion <strong>NO</strong>. ');
				$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x7, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				
				
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				$Form_Inputs->form_input_hidden('idDocumentos', 4, 2);
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Notas de Debito</h5>
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
							<div class="pull-left">Proveedor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=proveedor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=proveedor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
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
						<td><?php echo $tipo['Proveedor']; ?></td>
						<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_mov_servicios.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
