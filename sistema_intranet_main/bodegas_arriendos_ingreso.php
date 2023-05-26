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
//Cargamos la ubicacion original
$original = "bodegas_arriendos_ingreso.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idProveedor']) && $_GET['idProveedor']!=''){            $location .= "&idProveedor=".$_GET['idProveedor'];              $search .= "&idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos']!=''){          $location .= "&idDocumentos=".$_GET['idDocumentos'];            $search .= "&idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc']!=''){                        $location .= "&N_Doc=".$_GET['N_Doc'];                          $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];        $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano']!=''){          $location .= "&Creacion_ano=".$_GET['Creacion_ano'];            $search .= "&Creacion_ano=".$_GET['Creacion_ano'];}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes']!=''){          $location .= "&Creacion_mes=".$_GET['Creacion_mes'];            $search .= "&Creacion_mes=".$_GET['Creacion_mes'];}
if(isset($_GET['Devolucion_fecha']) && $_GET['Devolucion_fecha']!=''){  $location .= "&Devolucion_fecha=".$_GET['Devolucion_fecha'];    $search .= "&Devolucion_fecha=".$_GET['Devolucion_fecha'];}
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador']!=''){          $location .= "&idTrabajador=".$_GET['idTrabajador'];            $search .= "&idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){                  $location .= "&idBodega=".$_GET['idBodega'];                    $search .= "&idBodega=".$_GET['idBodega'];}
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
	$form_trabajo= 'new_ingreso';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para editar
if (!empty($_POST['submit_modBase'])){
	//Llamamos al formulario
	$form_trabajo= 'modBase_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para editar
if (!empty($_GET['clear_all'])){
	//Llamamos al formulario
	$form_trabajo= 'clear_all_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para editar
if (!empty($_POST['submit_modCentroCosto'])){
	//Llamamos al formulario
	$form_trabajo= 'modCentroCosto_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'new_prod_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para crear
if (!empty($_POST['submit_edit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'edit_prod_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if (!empty($_GET['del_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'del_prod_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_guia'])){
	//Llamamos al formulario
	$form_trabajo= 'new_guia';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if (!empty($_GET['del_guia'])){
	//Llamamos al formulario
	$form_trabajo= 'del_guia';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_impuesto'])){
	//Llamamos al formulario
	$form_trabajo= 'new_impuesto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if (!empty($_GET['del_impuesto'])){
	//Llamamos al formulario
	$form_trabajo= 'del_impuesto';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_file'])){
	//Llamamos al formulario
	$form_trabajo= 'new_file_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if (!empty($_GET['del_file'])){
	//Llamamos al formulario
	$form_trabajo= 'del_file_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_descuento'])){
	//Llamamos al formulario
	$form_trabajo= 'new_desc_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//formulario para editar
if (!empty($_POST['submit_edit_descuento'])){
	//Llamamos al formulario
	$form_trabajo= 'edit_desc_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if (!empty($_GET['del_descuento'])){
	//Llamamos al formulario
	$form_trabajo= 'del_desc_ing';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//se borra un dato
if (!empty($_GET['addfpago'])){
	//Llamamos al formulario
	$form_trabajo= 'addfpago';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
//se borra un dato
if (!empty($_GET['delfpago'])){
	//Llamamos al formulario
	$form_trabajo= 'delfpago';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
if (!empty($_GET['ing_bodega'])){
	//Llamamos al formulario
	$form_trabajo= 'ing_bodega';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para crear
if (!empty($_POST['submit_modFecha'])){
	//Llamamos al formulario
	$form_trabajo= 'modFecha';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************/
//formulario para editar
if (!empty($_POST['submit_OC'])){
	//Llamamos al formulario
	$form_trabajo= 'add_OC';
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
if (isset($_GET['created'])){ $error['created'] = 'sucess/Ingreso Realizado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Ingreso Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Ingreso Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['addOC'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Asignar OC</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idOcompra)){   $x1  = $idOcompra;    }else{$x1  = $_SESSION['arriendos_ing_basicos']['idOcompra'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_number('Numero de OC', 'idOcompra', $x1, 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Asignar OC" name="submit_OC">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['editDescuentos'])){  ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Descuento</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;     }else{$x1  = $_SESSION['arriendos_ing_descuentos'][$_GET['editDescuentos']]['Nombre'];}
				if(isset($vTotal)){      $x2  = $vTotal;     }else{$x2  = $_SESSION['arriendos_ing_descuentos'][$_GET['editDescuentos']]['vTotal'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_number('Valor', 'vTotal', $x2, 2);

				$Form_Inputs->form_input_hidden('oldidProducto', $_SESSION['arriendos_ing_descuentos'][$_GET['editDescuentos']]['idDescuento'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_descuento">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['addDescuentos'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Descuento</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){      $x1  = $Nombre;     }else{$x1  = '';}
				if(isset($vTotal)){      $x2  = $vTotal;     }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_number('Valor', 'vTotal', $x2, 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_descuento">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['addFile'])){ ?>

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
}elseif(!empty($_GET['editProd'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Ingreso de Equipo</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idEquipo)){       $x1  = $idEquipo;      }else{$x1  = $_SESSION['arriendos_ing_productos'][$_GET['editProd']]['idEquipo'];}
				if(isset($Cantidad_ing)){   $x2  = $Cantidad_ing;  }else{$x2  = Cantidades_decimales_justos($_SESSION['arriendos_ing_productos'][$_GET['editProd']]['Cantidad_ing']);}
				if(isset($idFrecuencia)){   $x3  = $idFrecuencia;  }else{$x3  = $_SESSION['arriendos_ing_productos'][$_GET['editProd']]['idFrecuencia'];}
				if(isset($ValorTotal)){     $x4  = $ValorTotal;    }else{$x4  = Cantidades_decimales_justos($_SESSION['arriendos_ing_productos'][$_GET['editProd']]['ValorTotal']);}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Equipos','idEquipo', $x1, 2, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', '', $dbConn);
				$Form_Inputs->form_select_disabled('Equipos','idEquipo_fake', $x1, 2, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', $dbConn);

				$Form_Inputs->form_input_number('Cantidad', 'Cantidad_ing', $x2, 2);

				$Form_Inputs->form_select('Frecuencia','idFrecuencia', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, '', $dbConn);
				$Form_Inputs->form_select_disabled('Frecuencia','idFrecuencia_fake', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, $dbConn);

				$Form_Inputs->form_input_disabled('Valor Unitario Neto','Unitario', Cantidades_decimales_justos($_SESSION['arriendos_ing_productos'][$_GET['editProd']]['ValorIngreso']));
				$Form_Inputs->form_input_number('Valor Total Neto', 'ValorTotal', $x4, 2);
				$Form_Inputs->form_input_hidden('vUnitario', Cantidades_decimales_justos($_SESSION['arriendos_ing_productos'][$_GET['editProd']]['ValorIngreso']), 2);

				echo operacion_input('Cantidad_ing', 'ValorTotal', 'Unitario', 'vUnitario', 4);

				$Form_Inputs->form_input_hidden('oldItemID', $_GET['editProd'], 2);
				?>

				<script>
					<?php if(isset($_SESSION['arriendos_ing_basicos']['idOcompra']) && $_SESSION['arriendos_ing_basicos']['idOcompra']!=''){ ?>
						document.getElementById("div_idEquipo").style.display = 'none';
						document.getElementById("div_idFrecuencia").style.display = 'none';
						document.getElementById("div_idEquipo_fake").style.display = '';
						document.getElementById("div_idFrecuencia_fake").style.display = '';
					<?php }else{ ?>
						document.getElementById("div_idEquipo").style.display = '';
						document.getElementById("div_idFrecuencia").style.display = '';
						document.getElementById("div_idEquipo_fake").style.display = 'none';
						document.getElementById("div_idFrecuencia_fake").style.display = 'none';
					<?php } ?>
				</script>

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
}elseif(!empty($_GET['addProd'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Equipo</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idEquipo)){       $x1  = $idEquipo;      }else{$x1  = '';}
				if(isset($Cantidad_ing)){   $x2  = $Cantidad_ing;  }else{$x2  = '';}
				if(isset($idFrecuencia)){   $x3  = $idFrecuencia;  }else{$x3  = '';}
				if(isset($ValorTotal)){     $x4  = $ValorTotal;    }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Equipos','idEquipo', $x1, 2, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', '', $dbConn);
				$Form_Inputs->form_input_number('Cantidad', 'Cantidad_ing', $x2, 2);
				$Form_Inputs->form_select('Frecuencia','idFrecuencia', $x3, 2, 'idFrecuencia', 'Nombre', 'core_tiempo_frecuencia', 0, '', $dbConn);

				$Form_Inputs->form_input_disabled('Valor Unitario Neto','Unitario', '');
				$Form_Inputs->form_input_number('Valor Total Neto', 'ValorTotal', $x4, 2);
				$Form_Inputs->form_input_hidden('vUnitario', '', 2);

				echo operacion_input('Cantidad_ing', 'ValorTotal', 'Unitario', 'vUnitario', 4);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_prod">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['addGuia'])){
//filtro para el select
$z=" idDocumentos = 1 AND idEstado = 1 AND idProveedor = ".$_SESSION['arriendos_ing_basicos']['idProveedor'];

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Guias</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idGuia )){       $x1  = $idGuia ;      }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Guias disponibles','idGuia', $x1, 2, 'idFacturacion', 'N_Doc', 'bodegas_arriendos_facturacion', $z, 'ORDER BY N_Doc ASC', $dbConn);

				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_guia">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['addImpuesto'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
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
				if(isset($idCentroCosto)){  $x1  = $idCentroCosto;  }else{$x1  = $_SESSION['arriendos_ing_basicos']['idCentroCosto'];}
				if(isset($idLevel_1)){      $x2  = $idLevel_1;      }else{$x2  = $_SESSION['arriendos_ing_basicos']['idLevel_1'];}
				if(isset($idLevel_2)){      $x3  = $idLevel_2;      }else{$x3  = $_SESSION['arriendos_ing_basicos']['idLevel_2'];}
				if(isset($idLevel_3)){      $x4  = $idLevel_3;      }else{$x4  = $_SESSION['arriendos_ing_basicos']['idLevel_3'];}
				if(isset($idLevel_4)){      $x5  = $idLevel_4;      }else{$x5  = $_SESSION['arriendos_ing_basicos']['idLevel_4'];}
				if(isset($idLevel_5)){      $x6  = $idLevel_5;      }else{$x6  = $_SESSION['arriendos_ing_basicos']['idLevel_5'];}

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
//filtro
$z = "bodegas_arriendos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_bodegas_arriendos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar Datos Basicos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idProveedor)){        $x1  = $idProveedor;      }else{$x1  = $_SESSION['arriendos_ing_basicos']['idProveedor'];}
				if(isset($idDocumentos)){       $x2  = $idDocumentos;     }else{$x2  = $_SESSION['arriendos_ing_basicos']['idDocumentos'];}
				if(isset($N_Doc)){              $x3  = $N_Doc;            }else{$x3  = $_SESSION['arriendos_ing_basicos']['N_Doc'];}
				if(isset($Creacion_fecha)){     $x4  = $Creacion_fecha;   }else{$x4  = $_SESSION['arriendos_ing_basicos']['Creacion_fecha'];}
				if(isset($fecha_fact_desde)){   $x5  = $fecha_fact_desde; }else{$x5  = $_SESSION['arriendos_ing_basicos']['fecha_fact_desde'];}
				if(isset($fecha_fact_hasta)){   $x6  = $fecha_fact_hasta; }else{$x6  = $_SESSION['arriendos_ing_basicos']['fecha_fact_hasta'];}
				if(isset($Devolucion_fecha)){   $x7  = $Devolucion_fecha; }else{$x7  = $_SESSION['arriendos_ing_basicos']['Devolucion_fecha'];}
				if(isset($idBodega)){           $x8  = $idBodega;         }else{$x8  = $_SESSION['arriendos_ing_basicos']['idBodega'];}
				if(isset($Observaciones)){      $x9  = $Observaciones;    }else{$x9  = $_SESSION['arriendos_ing_basicos']['Observaciones'];}
				if(isset($idUsoIVA)){           $x10 = $idUsoIVA;         }else{$x10 = $_SESSION['arriendos_ing_basicos']['idUsoIVA'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 2, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_select('Tipo Documento','idDocumentos', $x2, 2, 'idDocumentos', 'Nombre', 'core_documentos_mercantiles', 'idDocumentos!=3 AND idDocumentos!=4', '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x3, 2);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x4, 2);
				$Form_Inputs->form_date('Facturacion Desde','fecha_fact_desde', $x5, 1);
				$Form_Inputs->form_date('Facturacion Hasta','fecha_fact_hasta', $x6, 1);
				$Form_Inputs->form_date('F Devolucion Estimada','Devolucion_fecha', $x7, 1);
				$Form_Inputs->form_select_join_filter('Bodega destino','idBodega', $x8, 2, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $z, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x9, 1);
				$Form_Inputs->form_post_data(1,1,1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opción <strong>SI</strong>, para el resto es de uso obligatorio la opción <strong>NO</strong>. ');
				$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x10, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 1, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);
				?>

				<script>
					document.getElementById('div_fecha_fact_desde').style.display = 'none';
					document.getElementById('div_fecha_fact_hasta').style.display = 'none';

					//se ejecuta al cargar la página (OBLIGATORIO)
					$(document).ready(function(){
						let idDocumentosSelected= $("#idDocumentos").val();
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
						let idDocumentos = $(this).val(); //Asignamos el valor seleccionado
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
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['view'])){
$Form_Inputs = new Inputs(); ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<div class="btn-group pull-right" role="group" aria-label="...">

		<?php
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger dialogBox"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

		<a href="<?php echo $location; ?>"  class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

		<?php
		$ubicacion = $location.'&view=true&ing_bodega=true';
		$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?<br/>Revise si los <strong>montos</strong> y <strong>cantidades</strong> coinciden con el documento ingresado.'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>

	</div>
	<div class="clearfix"></div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<div id="page-wrap">
		<div id="header"> <?php echo $_SESSION['arriendos_ing_basicos']['Documento']; ?></div>

		<div id="customer">

			<table id="meta" class="pull-left otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Basicos" class="btn btn-xs btn-primary tooltip pull-right" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Proveedor</td>
						<td><?php echo $_SESSION['arriendos_ing_basicos']['Proveedor']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Documento</td>
						<td><?php echo $_SESSION['arriendos_ing_basicos']['TipoDocumento'].' N°'.$_SESSION['arriendos_ing_basicos']['N_Doc']?></td>
					</tr>
					<tr>
						<td class="meta-head">Bodega</td>
						<td><?php echo $_SESSION['arriendos_ing_basicos']['Bodega']; ?></td>
					</tr>
					<tr>
						<td class="meta-head"><strong>OC Relacionada</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&addOC=true' ?>" title="Agregar Orden de Compra" class="btn btn-xs btn-primary tooltip pull-right" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar OC</a></td>
					</tr>
					<?php if(isset($_SESSION['arriendos_ing_basicos']['idOcompra'])&&$_SESSION['arriendos_ing_basicos']['idOcompra']!=''){ ?>
						<tr>
							<td class="meta-head">Orden de Compra</td>
							<td><?php echo $_SESSION['arriendos_ing_basicos']['idOcompra']?></td>
						</tr>
					<?php } ?>
					<tr>
						<td class="meta-head"><strong>Centro de Costo</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modCentroCosto=true' ?>" title="Modificar Centro de Costo" class="btn btn-xs btn-primary pull-right tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Centro de Costo</td>
						<td><?php echo $_SESSION['arriendos_ing_basicos']['CentroCosto']; ?></td>
					</tr>
					<?php if(isset($_SESSION['arriendos_ing_basicos']['idUsoIVA'])&&$_SESSION['arriendos_ing_basicos']['idUsoIVA']==1){ ?>
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
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['arriendos_ing_basicos']['Creacion_fecha']); ?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha Devolucion</td>
						<td colspan="2"><?php echo Fecha_estandar($_SESSION['arriendos_ing_basicos']['Devolucion_fecha']); ?></td>
					</tr>
					<?php
					//Solo para facturas
					if($_SESSION['arriendos_ing_basicos']['idDocumentos']==2){ ?>
						<tr>
							<td class="meta-head">Fecha Vencimiento</td>
							<?php if($_SESSION['arriendos_ing_basicos']['Pago_fecha']!='0000-00-00'){ ?>
								<td><?php echo Fecha_estandar($_SESSION['arriendos_ing_basicos']['Pago_fecha']); ?></td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php
										$ubicacion = $location.'&view=true&delfpago=true';
										$dialogo   = '¿Realmente deseas eliminar la fecha de Vencimiento?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar fecha de Vencimiento" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</div>
								</td>
							<?php }else{ ?>
								<td><?php $Form_Inputs->input_date('Fecha Vencimiento','f_pago', 2); ?></td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php $ubicacion=$location.'&view=true&addfpago=true'; ?>
										<a onclick="addfpago('<?php echo $ubicacion ?>')"  title="Asignar fecha de termino" class="btn btn-primary btn-sm tooltip"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
									</div>
								</td>
							<?php } ?>
						</tr>
						<?php if(isset($_SESSION['arriendos_ing_basicos']['fecha_fact_desde'])&&$_SESSION['arriendos_ing_basicos']['fecha_fact_desde']!=''&&$_SESSION['arriendos_ing_basicos']['fecha_fact_desde']!='0'&&$_SESSION['arriendos_ing_basicos']['fecha_fact_desde']!='0000-00-00'){ ?>
							<tr>
								<td class="meta-head">Facturacion Desde</td>
								<td colspan="2"><?php echo Fecha_estandar($_SESSION['arriendos_ing_basicos']['fecha_fact_desde']); ?></td>
							</tr>
						<?php } ?>
						<?php if(isset($_SESSION['arriendos_ing_basicos']['fecha_fact_hasta'])&&$_SESSION['arriendos_ing_basicos']['fecha_fact_hasta']!=''&&$_SESSION['arriendos_ing_basicos']['fecha_fact_hasta']!='0'&&$_SESSION['arriendos_ing_basicos']['fecha_fact_hasta']!='0000-00-00'){ ?>
							<tr>
								<td class="meta-head">Facturacion Hasta</td>
								<td colspan="2"><?php echo Fecha_estandar($_SESSION['arriendos_ing_basicos']['fecha_fact_hasta']); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
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
					<td colspan="5">Arriendo a Ingresar</td>
					<td>
						<?php if(isset($_SESSION['arriendos_ing_basicos']['idOcompra'])&&$_SESSION['arriendos_ing_basicos']['idOcompra']==''){ ?>
							<a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Arriendo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Arriendo</a>
						<?php } ?>
					</td>
				</tr>
				<?php
				$vtotal_neto = 0;
				if (isset($_SESSION['arriendos_ing_productos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['arriendos_ing_productos'] as $key => $producto){
						$vtotal_neto = $vtotal_neto + $producto['ValorTotal']; ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="2">
								<?php echo $producto['EquipoNombre']; ?>
							</td>
							<td class="item-name">
								<?php echo Cantidades_decimales_justos($producto['Cantidad_ing']).' '.$producto['Frecuencia']; ?>
							</td>
							<td class="item-name" align="right">
								<?php echo valores($producto['ValorIngreso'], 0).' x '.$producto['Frecuencia']; ?>
							</td>
							<td class="item-name" align="right">
								<?php echo Valores(Cantidades_decimales_justos($producto['ValorTotal']), 0); ?>
							</td>
							<td>
								<div class="btn-group" style="width: 70px;" >
									<a href="<?php echo $location.'&editProd='.$producto['idEquipo']; ?>" title="Editar Arriendo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<?php
									$ubicacion = $location.'&del_prod='.$producto['idEquipo'];
									$dialogo   = '¿Realmente deseas eliminar el Arriendo '.str_replace('"','',$producto['EquipoNombre']).'?'; ?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Arriendo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								</div>
							</td>
						</tr>
					<?php
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>'; ?>

				<?php if($_SESSION['arriendos_ing_basicos']['idDocumentos']==2){ ?>

					<tr class="item-row fact_tittle">
						<td colspan="5">Guias de Despacho a Ingresar</td>
						<td><a href="<?php echo $location.'&addGuia=true' ?>" title="Agregar Guia" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Guia</a></td>
					</tr>
					<?php
					if (isset($_SESSION['arriendos_ing_guias'])){
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['arriendos_ing_guias'] as $key => $producto){ ?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="4">
									<?php echo 'Guia N°'.$producto['N_Doc']; ?>
								</td>
								<td class="item-name" align="right">
									<?php
									$vtotal_neto = $vtotal_neto + $producto['ValorNeto'];
									echo 'Total '.Valores(Cantidades_decimales_justos($producto['ValorNeto']), 0); ?>
								</td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php
										$ubicacion = $location.'&del_guia='.$producto['idGuia'];
										$dialogo   = '¿Realmente deseas eliminar la guia N° '.$producto['N_Doc'].'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Guia" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</div>
								</td>
							</tr>
						  <?php
						}
					}
				}
				echo '<tr id="hiderow"><td colspan="6"><a name="Ancla_obs"></a></td></tr>'; ?>

				<?php  //Guardo el neto
				$_SESSION['arriendos_ing_basicos']['valor_neto_fact'] = $vtotal_neto;
				?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="4" align="right"><strong>Subtotal Neto</strong></td>
						<td align="right"><?php echo Valores($vtotal_neto, 0); ?></td>
						<td></td>
					</tr>

					<tr class="item-row linea_punteada">
						<td class="item-name" colspan="5"><strong>Descuentos</strong></td>
						<td><a href="<?php echo $location.'&addDescuentos=true' ?>" title="Agregar Descuento" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Descuentos</a></td>
					</tr>
					<?php
					if (isset($_SESSION['arriendos_ing_descuentos'])){
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['arriendos_ing_descuentos'] as $key => $producto){ ?>
							<tr class="invoice-total" bgcolor="#f1f1f1">
								<td class="item-name" colspan="4" align="right"><strong><?php echo $producto['Nombre']; ?></strong></td>
								<td class="item-name" align="right">
									<?php echo Valores($producto['vTotal'], 0); ?>
								</td>
								<td>
									<?php $vtotal_neto = $vtotal_neto - $producto['vTotal']; ?>
									<div class="btn-group" style="width: 70px;" >
										<a href="<?php echo $location.'&editDescuentos='.$producto['idDescuento']; ?>" title="Editar Descuento" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
										<?php
										$ubicacion = $location.'&del_descuento='.$producto['idDescuento'];
										$dialogo   = '¿Realmente deseas eliminar el descuento '.$producto['Nombre'].'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Descuento" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</div>
								</td>
							</tr>
						 <?php
						}
					} ?>
					<?php  //Guardo el neto imponible
					$_SESSION['arriendos_ing_basicos']['valor_neto_imp'] = $vtotal_neto;
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
					if (isset($_SESSION['arriendos_ing_impuestos'])){
						//guardo el valor neto
						$tempa = $vtotal_neto;
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['arriendos_ing_impuestos'] as $key => $producto){

							//se hacen los calculos matematicos
							$vtotal_IVA = ($tempa / 100) * $producto['Porcentaje'];
							$vtotal_neto = $vtotal_neto + $vtotal_IVA;
							//se guardan los valores en variables de sesion
							$_SESSION['arriendos_ing_impuestos'][$producto['idImpuesto']]['valor'] = $vtotal_IVA;

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
						  <?php
						}
					}
					//guardo el total
					$_SESSION['arriendos_ing_basicos']['valor_total_fact'] = $vtotal_neto; ?>
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
			<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['arriendos_ing_basicos']['Observaciones']; ?></p>
		</div>
	</div>

    <table id="items" style="margin-bottom: 20px;">
        <tbody>

			<tr class="invoice-total" bgcolor="#f1f1f1">
                <td colspan="5">Archivos Adjuntos</td>
                <td width="160"><a href="<?php echo $location.'&addFile=true' ?>" title="Agregar Archivo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Archivos</a></td>
            </tr>

			<?php
			if (isset($_SESSION['arriendos_ing_archivos'])){
				//recorro el lsiatdo entregado por la base de datos
				$numeral = 1;
				foreach ($_SESSION['arriendos_ing_archivos'] as $key => $producto){ ?>
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
} elseif(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);

/*******************************************************/
// consulto los datos
$SIS_query = 'Creacion_fecha';
$SIS_join  = '';
$SIS_where = 'idFacturacion = '.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'bodegas_arriendos_facturacion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Modificar datos basicos de la Compra</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)){   $x1  = $Creacion_fecha; }else{$x1  = $rowdata['Creacion_fecha'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x1, 2);

				$Form_Inputs->form_input_hidden('idFacturacion', $_GET['id'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modFecha">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//filtro
$z = "bodegas_arriendos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_bodegas_arriendos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Ingresar Arriendo</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idProveedor)){        $x1  = $idProveedor;      }else{$x1  = '';}
				if(isset($idDocumentos)){       $x2  = $idDocumentos;     }else{$x2  = '';}
				if(isset($N_Doc)){              $x3  = $N_Doc;            }else{$x3  = '';}
				if(isset($Creacion_fecha)){     $x4  = $Creacion_fecha;   }else{$x4  = '';}
				if(isset($fecha_fact_desde)){   $x5  = $fecha_fact_desde; }else{$x5  = '';}
				if(isset($fecha_fact_hasta)){   $x6  = $fecha_fact_hasta; }else{$x6  = '';}
				if(isset($Devolucion_fecha)){   $x7  = $Devolucion_fecha; }else{$x7  = '';}
				if(isset($idBodega)){           $x8  = $idBodega;         }else{$x8  = '';}
				if(isset($Observaciones)){      $x9  = $Observaciones;    }else{$x9  = '';}
				if(isset($idUsoIVA)){           $x10 = $idUsoIVA;         }else{$x10 = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 2, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_select('Tipo Documento','idDocumentos', $x2, 2, 'idDocumentos', 'Nombre', 'core_documentos_mercantiles', 'idDocumentos!=3 AND idDocumentos!=4', '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x3, 2);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x4, 2);
				$Form_Inputs->form_date('Facturacion Desde','fecha_fact_desde', $x5, 1);
				$Form_Inputs->form_date('Facturacion Hasta','fecha_fact_hasta', $x6, 1);
				$Form_Inputs->form_date('F Devolucion Estimada','Devolucion_fecha', $x7, 1);
				$Form_Inputs->form_select_join_filter('Bodega destino','idBodega', $x8, 2, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $z, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x9, 1);
				$Form_Inputs->form_post_data(1,1,1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opción <strong>SI</strong>, para el resto es de uso obligatorio la opción <strong>NO</strong>. ');
				$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x10, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 1, 2);
				$Form_Inputs->form_input_hidden('fecha_auto', fecha_actual(), 2);

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
		case 'proveedor_asc':  $order_by = 'proveedor_listado.Nombre ASC ';                       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Proveedor Ascendente'; break;
		case 'proveedor_desc': $order_by = 'proveedor_listado.Nombre DESC ';                      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Proveedor Descendente';break;
		case 'fecha_asc':      $order_by = 'bodegas_arriendos_facturacion.Creacion_fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':     $order_by = 'bodegas_arriendos_facturacion.Creacion_fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'doc_asc':        $order_by = 'core_documentos_mercantiles.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Documento Ascendente';break;
		case 'doc_desc':       $order_by = 'core_documentos_mercantiles.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Documento Descendente';break;

		default: $order_by = 'bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//filtro
$y = "bodegas_arriendos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$y .= " AND usuarios_bodegas_arriendos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
/**********************************************************/
//Variable con la ubicacion
$SIS_where = "bodegas_arriendos_facturacion.idTipo=1";//Solo ingresos
$SIS_where.= " AND bodegas_arriendos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idProveedor']) && $_GET['idProveedor']!=''){            $SIS_where .= " AND bodegas_arriendos_facturacion.idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos']!=''){          $SIS_where .= " AND bodegas_arriendos_facturacion.idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc']!=''){                        $SIS_where .= " AND bodegas_arriendos_facturacion.N_Doc LIKE '%".EstandarizarInput($_GET['N_Doc'])."%'";}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){      $SIS_where .= " AND bodegas_arriendos_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['Creacion_ano']) && $_GET['Creacion_ano']!=''){          $SIS_where .= " AND bodegas_arriendos_facturacion.Creacion_ano='".$_GET['Creacion_ano']."'";}
if(isset($_GET['Creacion_mes']) && $_GET['Creacion_mes']!=''){          $SIS_where .= " AND bodegas_arriendos_facturacion.Creacion_mes='".$_GET['Creacion_mes']."'";}
if(isset($_GET['Devolucion_fecha']) && $_GET['Devolucion_fecha']!=''){  $SIS_where .= " AND bodegas_arriendos_facturacion.Devolucion_fecha='".$_GET['Devolucion_fecha']."'";}
if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){                  $SIS_where .= " AND bodegas_arriendos_facturacion.idBodega=".$_GET['idBodega'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){        $SIS_where .= " AND bodegas_arriendos_facturacion.Observaciones LIKE '%".EstandarizarInput($_GET['Observaciones'])."%'";}
if(isset($_GET['idUsoIVA']) && $_GET['idUsoIVA']!=''){                  $SIS_where .= " AND bodegas_arriendos_facturacion.idUsoIVA=".$_GET['idUsoIVA'];}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idFacturacion', 'bodegas_arriendos_facturacion', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
proveedor_listado.Nombre AS Proveedor';
$SIS_join  = '
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema                  = bodegas_arriendos_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles` ON core_documentos_mercantiles.idDocumentos = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`           ON proveedor_listado.idProveedor            = bodegas_arriendos_facturacion.idProveedor';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrTipo = array();
$arrTipo = db_select_array (false, $SIS_query, 'bodegas_arriendos_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

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
		<?php if (isset($_SESSION['arriendos_ing_basicos']['idProveedor'])&&$_SESSION['arriendos_ing_basicos']['idProveedor']!=''){ ?>

			<?php
			$ubicacion = $location.'&clear_all=true';
			$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
			<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>

			<a href="<?php echo $location; ?>&view=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Ingreso</a>
		<?php }else{ ?>
			<a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Ingresar Arriendo</a>
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
				if(isset($idProveedor)){        $x1  = $idProveedor;      }else{$x1  = '';}
				if(isset($idDocumentos)){       $x2  = $idDocumentos;     }else{$x2  = '';}
				if(isset($N_Doc)){              $x3  = $N_Doc;            }else{$x3  = '';}
				if(isset($Creacion_fecha)){     $x4  = $Creacion_fecha;   }else{$x4  = '';}
				if(isset($Creacion_ano)){       $x5  = $Creacion_ano;     }else{$x5  = '';}
				if(isset($Creacion_mes)){       $x6  = $Creacion_mes;     }else{$x6  = '';}
				if(isset($Devolucion_fecha)){   $x7  = $Devolucion_fecha; }else{$x7  = '';}
				if(isset($idBodega)){           $x8  = $idBodega;         }else{$x8  = '';}
				if(isset($Observaciones)){      $x9  = $Observaciones;    }else{$x9  = '';}
				if(isset($idUsoIVA)){           $x10 = $idUsoIVA;         }else{$x10 = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 1, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_select('Tipo Documento','idDocumentos', $x2, 1, 'idDocumentos', 'Nombre', 'core_documentos_mercantiles', 'idDocumentos!=3 AND idDocumentos!=4', '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x3, 1);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x4, 1);
				$Form_Inputs->form_select_n_auto('Año Documento','Creacion_ano', $x5, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes Documento','Creacion_mes', $x6, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
				$Form_Inputs->form_date('F Devolucion Estimada','Devolucion_fecha', $x7, 1);
				$Form_Inputs->form_select_join_filter('Bodega destino','idBodega', $x8, 1, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $y, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x9, 1);
				$Form_Inputs->form_post_data(1,1,1, 'Solo las empresas que no sean contribuyentes del Impuesto al Valor Agregado (IVA) y las que gocen de exención del IVA de conformidad a lo dispuesto en los Artículos 12 y 13 de la <a href="http://www.sii.cl/pagina/jurisprudencia/legislacion/basica/dl825.doc">Ley del IVA</a> pueden elegir la opción <strong>SI</strong>, para el resto es de uso obligatorio la opción <strong>NO</strong>. ');
				$Form_Inputs->form_select('Exento de IVA','idUsoIVA', $x10, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Arriendos</h5>
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
								<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_mov_arriendos.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
