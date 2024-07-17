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
$original = "productos_recetas.php";
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
	//Agrego ubicacion
	$location .='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_obligatorios = 'idProducto,idProductoRel,Cantidad';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_recetas.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Agrego ubicacion
	$location .='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_obligatorios = 'idReceta,idProductoRel,Cantidad';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_recetas.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Agrego ubicacion
	$location .='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/productos_recetas.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Receta Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Receta Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Receta borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['mod']) ) {
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="idTipoProducto = 1 AND productos_listado.idRubro>=0";	
}else{
	$z="idTipoProducto = 1 AND productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
}
//Se traen los datos a modificar
$query = "SELECT  idProductoRel, Cantidad
FROM `productos_recetas`
WHERE idReceta = {$_GET['mod']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); 
//Agrego ubicacion
$location .='&id='.$_GET['id'];
?>
 
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Producto</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">

			<?php 
			//Se verifican si existen los datos
			if(isset($idProductoRel)) {   $x1  = $idProductoRel;   }else{$x1  = $rowdata['idProductoRel'];}
			if(isset($Cantidad)) {        $x2  = $Cantidad;        }else{$x2  = Cantidades_decimales_justos($rowdata['Cantidad']);}
				
			//se dibujan los inputs
			echo form_select('Producto','idProductoRel', $x1, 2, 'idProducto', 'Nombre', 'productos_listado', $z, $dbConn);
			echo form_input_number('Cantidad', 'Cantidad', $x2, 2);	 
			?>

			<div class="form-group">
            	<input type="hidden" name="idReceta" value="<?php echo $_GET['mod']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['id']) ) {
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "productos_listado.idTipoProducto = 1 AND productos_listado.idRubro>=0";	
}else{
	$z = "productos_listado.idTipoProducto = 1 AND productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
}
$z .= " AND productos_listado.idProducto!={$_GET['id']}";	
//Se traen los datos del producto editado
$query = "SELECT 
productos_listado.Nombre AS Producto,
productos_uml.Nombre AS Medida
FROM `productos_listado`
LEFT JOIN `productos_uml` ON productos_uml.idUml = productos_listado.idUml
WHERE productos_listado.idProducto = {$_GET['id']} ";
$resultado = mysqli_query ($dbConn, $query);
$row_data = mysqli_fetch_assoc ($resultado);
// Se trae un listado con productos del documento
$arrRecetas = array();
$query = "SELECT 
productos_recetas.idReceta,
productos_listado.Nombre AS NombreProd,
productos_listado.ValorIngreso,
productos_recetas.Cantidad,
productos_uml.Nombre AS UnidadMedida
FROM `productos_recetas`
LEFT JOIN `productos_listado`   ON productos_listado.idProducto     = productos_recetas.idProductoRel
LEFT JOIN `productos_uml`       ON productos_uml.idUml              = productos_listado.idUml
WHERE productos_recetas.idProducto = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrRecetas,$row );
}
 ?>



<div class="col-lg-11 fcenter">
<form class="facturacion" name="doc1" method="post">
<?php $subtotal = 0 ;?>
<div id="page-wrap">
    <div id="header">Receta de <?php echo $row_data['Producto']?></div>

    <div style="clear:both"></div>

    <table id="items">
        <tbody>
            <tr>
                <th colspan="3">Detalle</th>
                <th width="90">Cantidad</th>
                <th width="90">V/Unitario</th>
                <th width="90">V/Total</th>
            </tr>		  

            <tr class="item-row fact_tittle">
				<td colspan="6">Productos necesarios para crear 1 <?php echo $row_data['Medida'].' de '.$row_data['Producto']?></td>
			</tr>
             <tr>
                <td colspan="2">
					<?php
                	echo input_select_val_filter('Productos','idProductoRel', 2, 'idProducto', 'Nombre', 'productos_listado', $z,'width:200px; display:inline-block;','', $dbConn);
                	?>
				</td>	
				<td colspan="4">
                	<?php
                	echo input_values('text','Cantidad','Cantidad',2,'','width:200px; display:inline-block;');
                	echo input_text_val('hidden','idProducto','idProducto',2,'','',$_GET['id']);
                	?>
                	
                    <input type="submit" class="btn btn-primary" value="Agregar" name="submit">
                </td>
            </tr>
                     
            <?php foreach ($arrRecetas as $receta) { ?>
				<tr class="item-row">
					<td class="item-name" colspan="3">
						<div class="btn-group" >
							<a href="<?php echo $location.'&id='.$_GET['id'].'&mod='.$receta['idReceta']; ?>" data-placement="bottom" title="Editar Componente" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a>
							<?php 
							$ubicacion = $location.'&id='.$_GET['id'].'&del='.$receta['idReceta'];
							$dialogo   = '¿Realmente deseas eliminar el registro de : '.$receta['NombreProd'].'?';?>
							<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Componente" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>								
						</div>
						<?php echo $receta['NombreProd']; ?>
					</td>
					<td width="90"><?php echo Cantidades_decimales_justos($receta['Cantidad']).' '.$receta['UnidadMedida'];?></td>
					<td><?php echo Valores_sd($receta['ValorIngreso']); ?></td>
					<td><?php echo Valores_sd($receta['Cantidad']*$receta['ValorIngreso']); ?></td>
				</tr>
			<?php }?>
            

           
            

        </tbody>
    </table>

                
    <div class="clearfix"></div>

    </div>

</form>
</div>


<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px;margin-top:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
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
	$z="WHERE productos_listado.idTipoProducto = 3";//solo productos terminados
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND productos_listado.Nombre LIKE '%{$_GET['search']}%' ";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idProducto FROM `productos_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrProductos = array();
$query = "SELECT 
productos_listado.idProducto,
productos_listado.Nombre AS NombreProd,
productos_tipo_producto.Nombre AS tipo_producto,
COUNT(productos_recetas.idProducto) AS cantidad
FROM `productos_listado`
LEFT JOIN `productos_tipo_producto`    ON productos_tipo_producto.idTipoProducto     = productos_listado.idTipoProducto
LEFT JOIN `productos_recetas`          ON productos_recetas.idProducto               = productos_listado.idProducto
".$z."
GROUP BY productos_listado.Nombre
ORDER BY productos_listado.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}?>

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
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Productos con recetas</h5>
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
						<th>Nombre</th>
						<th>Cantidad Materiales</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>			
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $productos) { ?>
					<tr class="odd">
						<td><?php echo $productos['tipo_producto']; ?></td>
						<td><?php echo $productos['NombreProd']; ?></td>
						<td><?php echo $productos['cantidad']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo 'view_recetas.php?view='.$productos['idProducto']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){?><a href="<?php echo $location.'&id='.$productos['idProducto']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>							
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
