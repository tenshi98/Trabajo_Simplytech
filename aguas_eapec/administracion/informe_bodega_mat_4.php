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
$original = "informe_bodega_mat_4.php";
$location = $original;
//Se agregan ubicaciones
$location .='?filtro=true';			
if (isset($_GET['idBodega']) && $_GET['idBodega'] != ''){        $location .="&idBodega={$_GET['idBodega']}";}

//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit_filter']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'filtro_por_fechas';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_filtros.php';
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

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['idBodega']) ) { 
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = " WHERE productos_listado.idRubro>=0";	
}else{
	$z = " WHERE productos_listado.idRubro={$arrUsuario['idRubro']} OR productos_listado.idRubro=1";	
}
// Se trae un listado con todos los productos
$arrProductos = array();
$query = "SELECT 
productos_listado.StockLimite,
productos_listado.Nombre AS NombreProd,
productos_tipo_producto.Nombre AS tipo_producto,
productos_uml.Nombre AS UnidadMedida,
(SELECT SUM(Cantidad_ing) FROM bodegas_facturacion_existencias WHERE idProducto = productos_listado.idProducto AND idBodega={$_GET['idBodega']} ) AS stock_entrada,
(SELECT SUM(Cantidad_eg) FROM bodegas_facturacion_existencias WHERE idProducto = productos_listado.idProducto AND idBodega={$_GET['idBodega']}) AS stock_salida,
(SELECT Nombre FROM bodegas_listado WHERE idBodega={$_GET['idBodega']}) AS NombreBodega
FROM `productos_listado`
LEFT JOIN `productos_uml`              ON productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `productos_tipo_producto`    ON productos_tipo_producto.idTipoProducto   = productos_listado.idTipoProducto
".$z."
ORDER BY productos_listado.Nombre ASC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
} ?>
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Productos de la bodega <?php echo $arrProductos[0]['NombreBodega']; ?></h5>
			<div class="toolbar">
				<?php
				$zz  = '?idSistema='.$arrUsuario['idSistema'];
				$zz .= '&tipo='.$arrUsuario['tipo'];
				$zz .= '&idRubro='.$arrUsuario['idRubro'];
				$zz .= '&idBodega='.$_GET['idBodega'];
				?>
				<a target="new" href="informe_bodega_mat_4_to_excel.php<?php echo $zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
				<a target="new" href="informe_bodega_mat_4_to_pdf.php<?php echo $zz ?>" class="btn btn-sm btn-metis-3"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a>
				<a target="new" href="informe_bodega_mat_4_to_print.php<?php echo $zz ?>" class="btn btn-sm btn-metis-5"><i class="fa fa-print"></i> Imprimir</a>
			</div>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Tipo</th>
						<th>Nombre</th>
						<th>Stock Min</th>
						<th>Stock Actual</th>
					</tr>
				</thead>
							  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $productos) { ?>
					<?php $stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; 
					if ($productos['StockLimite']>$stock_actual){ ?>
					<tr class="odd">
						<td><?php echo $productos['tipo_producto']; ?></td>
						<td><?php echo $productos['NombreProd']; ?></td>
						<td><?php echo Cantidades_decimales_justos($productos['StockLimite']); ?> <?php echo $productos['UnidadMedida'];?></td>
						<td><?php echo Cantidades_decimales_justos($stock_actual) ?> <?php echo $productos['UnidadMedida'];?></td>
					</tr>
				<?php } 
				} ?>                     
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "idSistema>=0";
}else{
	$z = "idSistema={$arrUsuario['idSistema']}";
}
 
 ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1">
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idBodega)) {      $x1  = $idBodega;    }else{$x1  = '';}

				//se dibujan los inputs
				echo form_select('Bodega','idBodega', $x1, 2, 'idBodega', 'Nombre', 'bodegas_listado', $z, $dbConn);		
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width" value="Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
                    
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
