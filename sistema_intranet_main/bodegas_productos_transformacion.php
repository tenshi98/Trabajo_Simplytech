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
$original = "bodegas_productos_transformacion.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){    $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];    $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['idBodegaOrigen']) && $_GET['idBodegaOrigen']!=''){    $location .= "&idBodegaOrigen=".$_GET['idBodegaOrigen'];    $search .= "&idBodegaOrigen=".$_GET['idBodegaOrigen'];}
if(isset($_GET['idBodegaDestino']) && $_GET['idBodegaDestino']!=''){  $location .= "&idBodegaDestino=".$_GET['idBodegaDestino'];  $search .= "&idBodegaDestino=".$_GET['idBodegaDestino'];}
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
	$form_trabajo= 'new_transform';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if (!empty($_POST['submit_modBase'])){
	//Llamamos al formulario
	$form_trabajo= 'modBase_transform';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if (!empty($_GET['clear_all'])){
	//Llamamos al formulario
	$form_trabajo= 'clear_all_transform';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para editar
if (!empty($_POST['submit_modCentroCosto'])){
	//Llamamos al formulario
	$form_trabajo= 'modCentroCosto_transform';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
//formulario para transformar
if (!empty($_POST['submit_trans1'])){
	//Llamamos al formulario
	$form_trabajo= 'submit_trans1';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para transformar
if (!empty($_POST['submit_transform'])){
	//Llamamos al formulario
	$form_trabajo= 'transformar';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
//formulario para eliminar producto seleccionado
if (!empty($_GET['clear_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'trans_clear_prod';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
//formulario para agregar producto
if (!empty($_POST['submit_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'submit_prod_trans';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para eliminar producto seleccionado
if (!empty($_GET['del_prod'])){
	//Llamamos al formulario
	$form_trabajo= 'del_prod_trans';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
//formulario para agregar insumo
if (!empty($_POST['submit_ins'])){
	//Llamamos al formulario
	$form_trabajo= 'submit_ins_trans';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
//formulario para eliminar insumo seleccionado
if (!empty($_GET['del_ins'])){
	//Llamamos al formulario
	$form_trabajo= 'del_ins_trans';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_productos.php';
}
/**********************************************/
if (!empty($_GET['trans_bodega'])){
	//Llamamos al formulario
	$form_trabajo= 'trans_bodega';
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
if(!empty($_GET['addIns'])){
//Se revisan los permisos a los productos
$SIS_query = 'idProducto';
$SIS_join  = '';
$SIS_where = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_order = 'idProducto ASC';
$arrPermisos = array();
$arrPermisos = db_select_array (false, $SIS_query, 'core_sistemas_insumos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrPermisos');

/****************************************/
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
			<h5>Agregar Insumos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idProducto)){       $x1  = $idProducto;      }else{$x1  = '';}
				if(isset($Number)){           $x2  = $Number;          }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Insumo','idProducto', $x1, 2, 'idProducto', 'Nombre', 'insumos_listado', $zx2, '', $dbConn);
				$Form_Inputs->form_input_number('Cantidad', 'Number', $x2, 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_ins">
					<a href="<?php echo $location.'&view=true'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['addProd'])){
//Se revisan los permisos a los productos
$SIS_query = 'idProducto';
$SIS_join  = '';
$SIS_where = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_order = 'idProducto ASC';
$arrPermisos = array();
$arrPermisos = db_select_array (false, $SIS_query, 'core_sistemas_productos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrPermisos');

/****************************************/
//filtro
$zx1 = "idProducto=0";
foreach ($arrPermisos as $prod) {
	$zx1 .= " OR (idEstado=1 AND idProducto=".$prod['idProducto'].")";
}	 
?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Agregar Productos</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idProducto)){       $x1  = $idProducto;      }else{$x1  = '';}
				if(isset($Number)){           $x2  = $Number;          }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $zx1, '', $dbConn);
				$Form_Inputs->form_input_number('Cantidad', 'Number', $x2, 2);
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
}elseif(!empty($_GET['trans2'])){
// Se trae un listado con productos del documento
$SIS_query = '
productos_recetas.idReceta,
productos_listado.Nombre AS NombreProd,
productos_listado.idEstado AS EstadoProd,
productos_recetas.Cantidad,
sistema_productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_productos_facturacion_existencias.Cantidad_ing) AS ingreso,
SUM(bodegas_productos_facturacion_existencias.Cantidad_eg) AS egreso';
$SIS_join  = '
LEFT JOIN `productos_listado`                             ON productos_listado.idProducto                            = productos_recetas.idProductoRel
LEFT JOIN `sistema_productos_uml`                         ON sistema_productos_uml.idUml                             = productos_listado.idUml
LEFT JOIN `bodegas_productos_facturacion_existencias`     ON bodegas_productos_facturacion_existencias.idProducto    = productos_recetas.idProductoRel';
$SIS_where = 'productos_recetas.idProducto = '.$_GET['trans2'].' AND bodegas_productos_facturacion_existencias.idBodega='.$_SESSION['productos_transform_basicos']['idBodegaOrigen'];
$SIS_order = 'productos_listado.Nombre ASC';
$arrRecetas = array();
$arrRecetas = db_select_array (false, $SIS_query, 'productos_recetas', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrRecetas');

//Se traen los datos del producto editado
$SIS_query = '
productos_listado.Nombre AS Producto,
sistema_productos_uml.Nombre AS Medida';
$SIS_join  = 'LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml';
$SIS_where = 'productos_listado.idProducto ='.$_GET['trans2'];
$rowdata = db_select_data (false, $SIS_query, 'productos_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//variable con el maximo a transformar
$max = 1000000 ;

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<form class="facturacion" name="doc1" method="post" novalidate>
<div id="page-wrap">
    <div id="header">Transformar <?php echo $rowdata['Medida'].' de '.$rowdata['Producto']; ?></div>

    <div style="clear:both"></div>

    <table id="items">
        <tbody>
            <tr>
                <th colspan="4">Detalle</th>
                <th width="90">Necesario</th>
                <th width="90">En Bodega</th>
            </tr>
            <?php if($arrRecetas!=false && !empty($arrRecetas) && $arrRecetas!='') { ?>              
				<?php
				//Se cuentan los productos inactivos
				$inactivos = 0;
				foreach ($arrRecetas as $receta) {
					//Se verifica si esta inactivo
					if(isset($receta['EstadoProd'])&&$receta['EstadoProd']==2){
						$inactivos++;
					}
					?>
					<tr class="item-row">
						<td class="item-name" colspan="4"><?php echo $receta['NombreProd']; ?></td>
						<td width="90"><?php echo Cantidades_decimales_justos($receta['Cantidad']).' '.$receta['UnidadMedida']; ?></td>
						<?php $total = $receta['ingreso']-$receta['egreso']; ?>
						<td width="90"><?php echo $total.' '.$receta['UnidadMedida'] ?></td>
						<?php 
						$maximo = floor($total/$receta['Cantidad']);
						if($max>$maximo){$max=$maximo;} 
						
						?>
					</tr>
				<?php } ?>
				<tr class="item-row fact_tittle">
					<td colspan="6">Maximo posible para crear : <strong><?php echo $max.' '.$arrRecetas[0]['UnidadMedida'] ?></strong></td>
				</tr>
				<?php if($inactivos==0&&$max>0){ ?>
					<tr>
						<td colspan="6">
							<?php
							//se dibujan los inputs
							$Form_Inputs = new Inputs();
							$Form_Inputs->input_values_val('text',$rowdata['Medida'],'Cantidad',2,'','display:inline-block; width:200px;', '');
							$Form_Inputs->input_hidden('maximo', $max, 2);
							$Form_Inputs->input_hidden('idProducto', $_GET['trans2'], 2);
							?>
							<input type="submit" class="btn btn-primary fa-input" value="&#xf0c7; Transformar" name="submit_transform">
						</td>
					</tr>
				<?php } else { ?>
					<tr class="item-row fact_tittle">
						<td colspan="6">Uno o mas de los componentes de la receta esta inactivo o no posee la cantidad necesaria para la transformacion, favor verificar</td>
					</tr>

				<?php } ?>
            <?php } else { ?>
				<tr class="item-row fact_tittle">
					<td colspan="6">Este producto no posee recetas</td>
				</tr>
            
            <?php } ?>
             
            
            
        </tbody>
    </table>         
    <div class="clearfix"></div>

    </div>

</form>
<?php widget_validator(); ?>
</div>	 


<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px">
<a href="<?php echo $location.'&trans1=true' ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['trans1'])){
//Se revisan los permisos a los productos
$SIS_query = 'idProducto';
$SIS_join  = '';
$SIS_where = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_order = 'idProducto ASC';
$arrPermisos = array();
$arrPermisos = db_select_array (false, $SIS_query, 'core_sistemas_productos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrPermisos');

//filtro
$zx1 = "idProducto=0";
foreach ($arrPermisos as $prod) {
	$zx1 .= " OR (idTipoProducto=2 AND idEstado=1 AND idProducto=".$prod['idProducto'].")";
}	 
?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Seleccionar Producto a crear</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idProducto)){       $x1  = $idProducto;      }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Producto','idProducto', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $zx1, '', $dbConn);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf178; Continuar" name="submit_trans1">
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
				if(isset($idCentroCosto)){  $x1  = $idCentroCosto;  }else{$x1  = $_SESSION['productos_transform_basicos']['idCentroCosto'];}
				if(isset($idLevel_1)){      $x2  = $idLevel_1;      }else{$x2  = $_SESSION['productos_transform_basicos']['idLevel_1'];}
				if(isset($idLevel_2)){      $x3  = $idLevel_2;      }else{$x3  = $_SESSION['productos_transform_basicos']['idLevel_2'];}
				if(isset($idLevel_3)){      $x4  = $idLevel_3;      }else{$x4  = $_SESSION['productos_transform_basicos']['idLevel_3'];}
				if(isset($idLevel_4)){      $x5  = $idLevel_4;      }else{$x5  = $_SESSION['productos_transform_basicos']['idLevel_4'];}
				if(isset($idLevel_5)){      $x6  = $idLevel_5;      }else{$x6  = $_SESSION['productos_transform_basicos']['idLevel_5'];}

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
$z1 = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z2 = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z1 .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
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
				if(isset($Creacion_fecha)){   $x0  = $Creacion_fecha;    }else{$x0  = $_SESSION['productos_transform_basicos']['Creacion_fecha'];}
				if(isset($idBodegaOrigen)){   $x1  = $idBodegaOrigen;    }else{$x1  = $_SESSION['productos_transform_basicos']['idBodegaOrigen'];}
				if(isset($idBodegaDestino)){  $x2  = $idBodegaDestino;   }else{$x2  = $_SESSION['productos_transform_basicos']['idBodegaDestino'];}
				if(isset($Observaciones)){    $x3  = $Observaciones;     }else{$x3  = $_SESSION['productos_transform_basicos']['Observaciones'];}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Transformacion','Creacion_fecha', $x0, 2);
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodegaOrigen', $x1, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z1, $dbConn);
				$Form_Inputs->form_select('Bodega Destino','idBodegaDestino', $x2, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', $z2, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x3, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 5, 2);
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
}elseif(!empty($_GET['view'])){
$Form_Inputs = new Inputs();

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<div class="btn-group pull-right" role="group" aria-label="...">

		<?php
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Todo</a>

		<a href="<?php echo $location; ?>"  class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

		<?php
		$ubicacion = $location.'&view=true&trans_bodega=true';
		$dialogo   = '¿Realmente desea ingresar el documento, una vez realizada no podra realizar cambios?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Ingresar Documento</a>		

	</div>
	<div class="clearfix"></div>
</div> 


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<div id="page-wrap">
		<div id="header"> <?php echo $_SESSION['productos_transform_basicos']['TipoDocumento']; ?></div>

		<div id="customer">

			<table id="meta" class="pull-left otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"><a href="<?php echo $location.'&modBase=true' ?>" title="Modificar Datos Básicos" class="btn btn-xs btn-primary pull-right tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
					</tr>
					<tr>
						<td class="meta-head">Bodega Origen</td>
						<td><?php echo $_SESSION['productos_transform_basicos']['BodegaOrigen']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Bodega Destino</td>
						<td><?php echo $_SESSION['productos_transform_basicos']['BodegaDestino']; ?></td>
					</tr>
						<tr>
							<td class="meta-head"><strong>Centro de Costo</strong></td>
							<td class="meta-head"><a href="<?php echo $location.'&modCentroCosto=true' ?>" title="Modificar Centro de Costo" class="btn btn-xs btn-primary pull-right tooltip" style="position: initial;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar</a></td>
						</tr>
						<tr>
							<td class="meta-head">Centro de Costo</td>
							<td><?php echo $_SESSION['productos_transform_basicos']['CentroCosto']; ?></td>
						</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Creacion</td>
						<td><?php echo Fecha_estandar($_SESSION['productos_transform_basicos']['Creacion_fecha']); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<table id="items">
			<tbody>

				<tr>
					<th colspan="3">Detalle</th>
					<th width="120">Valor unitario</th>
					<th width="120">Ingreso</th>
					<th width="120">Egreso</th>
				</tr>

				<tr class="item-row fact_tittle">
					<td colspan="5">Productos a Transformar</td>
					<td>
						<?php if (isset($_SESSION['productos_transform_productos'])){ ?>
							<a href="<?php echo $location.'&clear_prod=true' ?>" title="Borrar Producto" class="btn btn-xs btn-danger tooltip" style="position: initial;"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Producto</a>
						<?php }else{ ?>
							<a href="<?php echo $location.'&trans1=true' ?>" title="Agregar Producto" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Seleccionar Producto</a>
						<?php } ?>

					</td>
				</tr>
				<?php
				if (isset($_SESSION['productos_transform_productos'])){
					//recorro el lsiatdo entregado por la base de datos
					foreach ($_SESSION['productos_transform_productos'] as $key => $producto){ ?>
						<tr class="item-row linea_punteada">
							<td class="item-name" colspan="3">
								<?php echo $producto['Nombre']; ?>
							</td>
							<?php
							if(isset($producto['prod_egreso'])&&$producto['prod_egreso']!=''){
								echo '<td class="item-name">'.Valores(($producto['ValorEgreso']), 0).'</td>';
								echo '<td></td>';
								echo '<td>'.($producto['prod_egreso']).' '.$producto['Unimed'].'</td>';
							}else{
								echo '<td class="item-name">'.Valores(($producto['ValorEgreso']), 0).'(Referencial)</td>';
								echo '<td>'.($producto['prod_ingreso']).' '.$producto['Unimed'].'</td>';
								echo '<td></td>';
							}
							?>

						</tr>
				<?php }
				} ?>
				<tr class="item-row fact_tittle">
					<td colspan="5">Otros Productos a Utilizar</td>
					<td>
						<a href="<?php echo $location.'&addProd=true' ?>" title="Agregar Producto" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto</a>
					</td>
				</tr>

				<?php
					if (isset($_SESSION['productos_transform_productos_prod'])){
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['productos_transform_productos_prod'] as $key => $producto){ ?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="2">
									<?php echo $producto['Nombre']; ?>
								</td>
								<td class="item-name">
									<?php echo Cantidades_decimales_justos($producto['Number']).' '.$producto['Unimed']; ?>
								</td>
								<td class="item-name" align="right">
									<?php echo Valores(Cantidades_decimales_justos($producto['ValorEgreso']), 0).' x '.$producto['Unimed']; ?>
								</td>
								<td class="item-name" align="right">
									<?php echo 'Total '.Valores(Cantidades_decimales_justos($producto['ValorTotal']), 0); ?>
								</td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php
										$ubicacion = $location.'&del_prod='.$producto['idProducto'];
										$dialogo   = '¿Realmente deseas eliminar el producto '.str_replace('"','',$prod['Nombre']).'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Producto" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</div>
								</td>
							</tr>
					<?php }
					} ?>
				<tr class="item-row fact_tittle">
					<td colspan="5">Otros Insumos a Utilizar</td>
					<td>
						<a href="<?php echo $location.'&addIns=true' ?>" title="Agregar Insumo" class="btn btn-xs btn-primary tooltip" style="position: initial;"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Insumo</a>
					</td>
				</tr>
				<?php
					if (isset($_SESSION['productos_transform_productos_ins'])){
						//recorro el lsiatdo entregado por la base de datos
						foreach ($_SESSION['productos_transform_productos_ins'] as $key => $producto){ ?>
							<tr class="item-row linea_punteada">
								<td class="item-name" colspan="2">
									<?php echo $producto['Nombre']; ?>
								</td>
								<td class="item-name">
									<?php echo Cantidades_decimales_justos($producto['Number']).' '.$producto['Unimed']; ?>
								</td>
								<td class="item-name" align="right">
									<?php echo Valores(Cantidades_decimales_justos($producto['ValorEgreso']), 0).' x '.$producto['Unimed']; ?>
								</td>
								<td class="item-name" align="right">
									<?php echo 'Total '.Valores(Cantidades_decimales_justos($producto['ValorTotal']), 0); ?>
								</td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php
										$ubicacion = $location.'&del_ins='.$producto['idProducto'];
										$dialogo   = '¿Realmente deseas eliminar el insumo '.str_replace('"','',$producto['Nombre']).'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Insumo" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
			<p class="text-muted well well-sm no-shadow" ><?php echo $_SESSION['productos_transform_basicos']['Observaciones']; ?></p>
		</div>
	</div>

</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//se crea filtro
$z1 = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z2 = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z1 .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Transformacion</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Creacion_fecha)){   $x0  = $Creacion_fecha;    }else{$x0  = '';}
				if(isset($idBodegaOrigen)){   $x1  = $idBodegaOrigen;    }else{$x1  = '';}
				if(isset($idBodegaDestino)){  $x2  = $idBodegaDestino;   }else{$x2  = '';}
				if(isset($Observaciones)){    $x3  = $Observaciones;     }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Transformacion','Creacion_fecha', $x0, 2);
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodegaOrigen', $x1, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z1, $dbConn);
				$Form_Inputs->form_select('Bodega Destino','idBodegaDestino', $x2, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', $z2, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x3, 1);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				$Form_Inputs->form_input_hidden('idTipo', 5, 2);
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
		case 'bodega_ori_asc':     $order_by = 'bodega1.Nombre ASC ';                                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Origen Ascendente'; break;
		case 'bodega_ori_desc':    $order_by = 'bodega1.Nombre DESC ';                               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Bodega Origen Descendente';break;
		case 'bodega_dest_asc':    $order_by = 'bodega2.Nombre ASC ';                                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Bodega Destino Ascendente';break;
		case 'bodega_dest_desc':   $order_by = 'bodega2.Nombre DESC ';                               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Bodega Destino Descendente';break;
		case 'fecha_asc':          $order_by = 'bodegas_productos_facturacion.Creacion_fecha ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':         $order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;

		default: $order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'bodegas_productos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
$z1 = "bodegas_productos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z2 = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z1 .= " AND usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
/**********************************************************/
//Variable con la ubicacion
$SIS_where = "bodegas_productos_facturacion.idTipo=5";//Solo traspaso
//Verifico el tipo de usuario que esta ingresando
$SIS_where.= " AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){$SIS_where .= " AND bodegas_productos_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['idBodegaOrigen']) && $_GET['idBodegaOrigen']!=''){$SIS_where .= " AND bodegas_productos_facturacion.idBodegaOrigen=".$_GET['idBodegaOrigen'];}
if(isset($_GET['idBodegaDestino']) && $_GET['idBodegaDestino']!=''){     $SIS_where .= " AND bodegas_productos_facturacion.idBodegaDestino=".$_GET['idBodegaDestino'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){  $SIS_where .= " AND bodegas_productos_facturacion.Observaciones LIKE '%".EstandarizarInput($_GET['Observaciones'])."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idFacturacion', 'bodegas_productos_facturacion', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
bodegas_productos_facturacion.idFacturacion,
bodegas_productos_facturacion.Creacion_fecha,
bodega1.Nombre AS BodegaOrigen,
bodega2.Nombre AS BodegaDestino,
core_sistemas.Nombre AS Sistema';
$SIS_join  = '
LEFT JOIN `bodegas_productos_listado`  bodega1   ON bodega1.idBodega         = bodegas_productos_facturacion.idBodegaOrigen
LEFT JOIN `bodegas_productos_listado`  bodega2   ON bodega2.idBodega         = bodegas_productos_facturacion.idBodegaDestino
LEFT JOIN `core_sistemas`                        ON core_sistemas.idSistema  = bodegas_productos_facturacion.idSistema';
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
		if (isset($_SESSION['productos_transform_basicos'])&&$_SESSION['productos_transform_basicos']!=''){ ?>

		<?php
		$ubicacion = $location.'&clear_all=true';
		$dialogo   = '¿Realmente deseas eliminar todos los registros?'; ?>
		<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</a>

		<a href="<?php echo $location; ?>&view=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar Transformacion</a>
	<?php }else{ ?>
		<a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Transformacion</a>
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
				if(isset($Creacion_fecha)){   $x0  = $Creacion_fecha;    }else{$x0  = '';}
				if(isset($idBodegaOrigen)){   $x1  = $idBodegaOrigen;    }else{$x1  = '';}
				if(isset($idBodegaDestino)){  $x2  = $idBodegaDestino;   }else{$x2  = '';}
				if(isset($Observaciones)){    $x3  = $Observaciones;     }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Transformacion','Creacion_fecha', $x0, 1);
				$Form_Inputs->form_select_join_filter('Bodega Origen','idBodegaOrigen', $x1, 1, 'idBodega', 'Nombre', 'bodegas_productos_listado', 'usuarios_bodegas_productos', $z1, $dbConn);
				$Form_Inputs->form_select('Bodega Destino','idBodegaDestino', $x2, 1, 'idBodega', 'Nombre', 'bodegas_productos_listado', $z2, '', $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x3, 1);

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Transformaciones</h5>
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
							<div class="pull-left">Bodega Origen</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=bodega_ori_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=bodega_ori_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Bodega Destino</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=bodega_dest_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=bodega_dest_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha de Transformacion</div>
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
						<td><?php echo $tipo['BodegaOrigen']; ?></td>
						<td><?php echo $tipo['BodegaDestino']; ?></td>
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
