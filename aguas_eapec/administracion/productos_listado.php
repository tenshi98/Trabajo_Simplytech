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
$original = "productos_listado.php";
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
	$form_obligatorios = 'Nombre,idTipo,idCategoria,idUml,Marca,idTipoProducto,idRubro';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idProducto,Nombre,idTipo,idCategoria,idUml,Marca,idTipoProducto,idRubro';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_listado.php';	
}
//se borra un dato
if ( !empty($_GET['del_img']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_img';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_listado.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Producto Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Producto Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Producto borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre,idTipo,idCategoria,idUml,Marca,idTipoProducto, StockLimite, idRubro, Direccion_img, 
Descripcion, Codigo
FROM `productos_listado`
WHERE idProducto = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Producto</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" name="form1">

			<?php 
			//Se verifican si existen los datos
			if(isset($Nombre)) {         $x1  = $Nombre;           }else{$x1  = $rowdata['Nombre'];}
			if(isset($idTipo)) {         $x2  = $idTipo;           }else{$x2  = $rowdata['idTipo'];}
			if(isset($idCategoria)) {    $x3  = $idCategoria;      }else{$x3  = $rowdata['idCategoria'];}
			if(isset($Marca)) {          $x5  = $Marca;            }else{$x5  = $rowdata['Marca'];}
			if(isset($Codigo)) {         $x6  = $Codigo;           }else{$x6  = $rowdata['Codigo'];}
			if(isset($StockLimite)) {    $x7  = $StockLimite;      }else{$x7  = $rowdata['StockLimite'];}
			if(isset($idUml)) {          $x8  = $idUml;            }else{$x8  = $rowdata['idUml'];}
			if(isset($idTipoProducto)) { $x9  = $idTipoProducto;   }else{$x9  = $rowdata['idTipoProducto'];}
			if(isset($idRubro)) {        $x10 = $idRubro;          }else{$x10 = $rowdata['idRubro'];}
			if(isset($Descripcion)) {    $x11 = $Descripcion;      }else{$x11 = $rowdata['Descripcion'];}

			//se dibujan los inputs
			echo form_input('text', 'Nombre', 'Nombre', $x1, 2);
			echo form_select('Tipo de Producto','idTipo', $x2, 2, 'idTipo', 'Nombre', 'productos_tipo', 0, $dbConn);
			echo form_select('Categoria','idCategoria', $x3, 2, 'idCategoria', 'Nombre', 'productos_categorias', 0, $dbConn);
			echo form_input('text', 'Marca', 'Marca', $x5, 2);
			echo form_input('text', 'Codigo', 'Codigo', $x6, 2);
			
			echo '<h3>Capacidad</h3>';
			echo form_input_number('Stock Minimo', 'StockLimite', $x7, 1);
			echo form_select('Unidad de Medida','idUml', $x8, 2, 'idUml', 'Nombre', 'productos_uml', 0, $dbConn);
			echo form_select('Tipo Producto','idTipoProducto', $x9, 2, 'idTipoProducto', 'Nombre', 'productos_tipo_producto', 'idTipoProducto!=2', $dbConn);
			
			if($arrUsuario['tipo']=='SuperAdmin' OR $arrUsuario['tipo']=='Administrador'){
			echo '<h3>Rubro Giro</h3>';
			echo form_select('Rubro Giro','idRubro', $x10, 2, 'idRubro', 'Nombre', 'core_sistemas_rubro', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idRubro"   value="'.$arrUsuario['idRubro'].'">';
			}
			
			echo '<h3>Imagen del Producto</h3>';
			if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){?>
				<div style="margin-bottom:10px;">
					<div class="col-lg-10 fcenter">
						<img src="upload/<?php echo $rowdata['Direccion_img'] ?>" width="100%" > 
					</div> 
					<a style="margin-top:10px;" href="<?php echo $location.'&del_img='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Borrar Imagen</a>
					<div class="clearfix"></div>
				</div>
				
			
			<?php }else{
				//se dibujan los inputs
				echo form_input_file('Seleccionar archivo','Direccion_img');
			}
			
			echo '<h3>Descripcion del Producto</h3>';
			echo form_ckeditor('Descripcion','Descripcion', $x11, 1, 1);
			
			?>
           
           

			<div class="form-group">
            	<input type="hidden" name="idProducto" value="<?php echo $_GET['id']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Producto</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($Nombre)) {         $x1  = $Nombre;           }else{$x1  = '';}
			if(isset($idTipo)) {         $x2  = $idTipo;           }else{$x2  = '';}
			if(isset($idCategoria)) {    $x3  = $idCategoria;      }else{$x3  = '';}
			if(isset($Marca)) {          $x5  = $Marca;            }else{$x5  = '';}
			if(isset($Codigo)) {         $x6  = $Codigo;           }else{$x6  = '';}
			if(isset($StockLimite)) {    $x7  = $StockLimite;      }else{$x7  = '';}
			if(isset($idUml)) {          $x8  = $idUml;            }else{$x8  = '';}
			if(isset($idTipoProducto)) { $x9  = $idTipoProducto;   }else{$x9  = '';}
			if(isset($idRubro)) {        $x10 = $idRubro;          }else{$x10 = '';}
			if(isset($Descripcion)) {    $x11 = $Descripcion;      }else{$x11 = '';}

			//se dibujan los inputs
			echo form_input('text', 'Nombre', 'Nombre', $x1, 2);
			echo form_select('Tipo de Producto','idTipo', $x2, 2, 'idTipo', 'Nombre', 'productos_tipo', 0, $dbConn);
			echo form_select('Categoria','idCategoria', $x3, 2, 'idCategoria', 'Nombre', 'productos_categorias', 0, $dbConn);
			echo form_input('text', 'Marca', 'Marca', $x5, 2);
			echo form_input('text', 'Codigo', 'Codigo', $x6, 2);
			
			echo '<h3>Capacidad</h3>';
			echo form_input_number('Stock Minimo', 'StockLimite', $x7, 1);
			echo form_select('Unidad de Medida','idUml', $x8, 2, 'idUml', 'Nombre', 'productos_uml', 0, $dbConn);
			echo form_select('Tipo Producto','idTipoProducto', $x9, 2, 'idTipoProducto', 'Nombre', 'productos_tipo_producto', 'idTipoProducto!=2', $dbConn);
			
			
			if($arrUsuario['tipo']=='SuperAdmin' OR $arrUsuario['tipo']=='Administrador'){
			echo '<h3>Rubro Giro</h3>';
			echo form_select('Rubro Giro','idRubro', $x10, 2, 'idRubro', 'Nombre', 'core_sistemas_rubro', 0, $dbConn);
			}else{
			echo '<input type="hidden" name="idRubro"   value="'.$arrUsuario['idRubro'].'">';
			}
			
			echo '<h3>Imagen del Producto</h3>';
			echo form_input_file('Seleccionar archivo','Direccion_img');
			
			echo '<h3>Descripcion del Producto</h3>';
			echo form_ckeditor('Descripcion','Descripcion', $x11, 1, 1);
			?>
			
			<div class="form-group">
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">
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
$z="WHERE productos_listado.idProducto >= 1";	
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND productos_listado.idRubro>=0";	
}else{
	$z.=" AND productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
}
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND productos_listado.Nombre LIKE '%{$_GET['search']}%'";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT productos_listado.idProducto FROM `productos_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrProductos = array();
$query = "SELECT 
productos_listado.idProducto,
productos_listado.Nombre AS NombreProd,
productos_listado.Marca,
productos_tipo.Nombre AS TipoProd,
productos_categorias.Nombre AS Categoria,
productos_uml.Nombre AS Unimed,
productos_tipo_producto.Nombre AS TipoProducto,
core_sistemas_rubro.Nombre AS Rubro

FROM `productos_listado`
LEFT JOIN `productos_tipo`           ON productos_tipo.idTipo                    = productos_listado.idTipo
LEFT JOIN `productos_categorias`     ON productos_categorias.idCategoria         = productos_listado.idCategoria
LEFT JOIN `productos_uml`            ON productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `productos_tipo_producto`  ON productos_tipo_producto.idTipoProducto   = productos_listado.idTipoProducto
LEFT JOIN `core_sistemas_rubro`      ON core_sistemas_rubro.idRubro              = productos_listado.idRubro
".$z."
ORDER BY productos_tipo.Nombre ASC, productos_listado.Marca ASC, productos_listado.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}

?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Producto</label>
    <div class="col-lg-5">
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Nombre">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onClick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Producto</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Productos</h5>
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
						<th>Tipo</th>
						<th>Marca</th> 
						<th>Nombre</th>
						<th>Categoria</th>
						<th>Unidad Medida</th>
						<th>Tipo Producto</th>
						<th>Rubro</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $prod) { ?>
					<tr class="odd">
						<td><?php echo $prod['TipoProd']; ?></td>
						<td><?php echo $prod['Marca']; ?></td>
						<td><?php echo $prod['NombreProd']; ?></td>
						<td><?php echo $prod['Categoria']; ?></td>
						<td><?php echo $prod['Unimed']; ?></td>
						<td><?php echo $prod['TipoProducto']; ?></td>
						<td><?php echo $prod['Rubro']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_productos.php?view='.$prod['idProducto']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$prod['idProducto']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$prod['idProducto'];
									$dialogo   = '¿Realmente deseas eliminar el producto: '.$prod['NombreProd'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
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
