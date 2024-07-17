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
//variable de ubicacion en el menu
$rowlevel['nombre_categoria'] = '';
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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Producto</h3>
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
// Se traen todos los datos de mi usuario
$query = "SELECT 
productos_listado.Nombre,
productos_listado.Descripcion,
productos_listado.Marca,
productos_listado.Codigo,
productos_listado.StockLimite,
productos_listado.ValorIngreso,
productos_listado.ValorEgreso,
productos_listado.Direccion_img,
productos_categorias.Nombre AS Categoria,
productos_tipo.Nombre AS Tipo,
productos_tipo_producto.Nombre AS TipoProd,
productos_uml.Nombre AS Unidad,
core_sistemas_rubro.Nombre AS Rubro

FROM `productos_listado`
LEFT JOIN `productos_categorias`      ON productos_categorias.idCategoria           = productos_listado.idCategoria
LEFT JOIN `productos_tipo`            ON productos_tipo.idTipo                      = productos_listado.idTipo
LEFT JOIN `productos_tipo_producto`   ON productos_tipo_producto.idTipoProducto     = productos_listado.idTipoProducto
LEFT JOIN `productos_uml`             ON productos_uml.idUml                        = productos_listado.idUml
LEFT JOIN `core_sistemas_rubro`       ON core_sistemas_rubro.idRubro                = productos_listado.idRubro

WHERE productos_listado.idProducto = {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);


//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z=" AND bodegas_facturacion_existencias.idSistema>=0";	
}else{
	$z=" AND bodegas_facturacion_existencias.idSistema={$arrUsuario['idSistema']}";	
}


// Se trae un listado con todos los usuarios
$arrProductos = array();
$query = "SELECT 
bodegas_facturacion_existencias.Creacion_fecha,
bodegas_facturacion_existencias.Cantidad_ing,
bodegas_facturacion_existencias.Cantidad_eg,
bodegas_facturacion_existencias.idFacturacion,
bodegas_facturacion_tipo.Nombre AS TipoMovimiento,
productos_listado.Nombre AS NombreProducto,
productos_uml.Nombre AS UnidadMedida,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `bodegas_facturacion_tipo`    ON bodegas_facturacion_tipo.idTipo   = bodegas_facturacion_existencias.idTipo
LEFT JOIN `productos_listado`           ON productos_listado.idProducto      = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`               ON productos_uml.idUml               = productos_listado.idUml
LEFT JOIN `bodegas_listado`             ON bodegas_listado.idBodega          = bodegas_facturacion_existencias.idBodega

WHERE bodegas_facturacion_existencias.idProducto={$_GET['view']}
".$z."
ORDER BY bodegas_facturacion_existencias.Creacion_fecha DESC 
LIMIT 20";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
} 

?>
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Producto <?php echo $rowdata['Nombre']; ?></h5>
			<div class="toolbar"></div>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#movimientos" data-toggle="tab">Movimientos</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="img/productos.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-lg-8">
						<h2 class="text-primary">Datos del Producto</h2>
						<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
						<p class="text-muted"><strong>Marca : </strong><?php echo $rowdata['Marca']; ?></p>
						<p class="text-muted"><strong>Codigo : </strong><?php echo $rowdata['Codigo']; ?></p>
						<p class="text-muted"><strong>Categoria : </strong><?php echo $rowdata['Categoria']; ?></p>
						<p class="text-muted"><strong>Tipo : </strong><?php echo $rowdata['Tipo']; ?></p>
						<p class="text-muted"><strong>Tipo de Producto : </strong><?php echo $rowdata['TipoProd']; ?></p>
						<p class="text-muted"><strong>Unidad de medida : </strong><?php echo $rowdata['Unidad']; ?></p>
						
						<h2 class="text-primary">Datos Comerciales</h2>
						<p class="text-muted"><strong>Stock Minimo : </strong><?php echo Cantidades_decimales_justos($rowdata['StockLimite']).' '.$rowdata['Unidad']; ?></p>
						<p class="text-muted"><strong>Valor promedio Ingreso : </strong><?php echo Valores(Cantidades_decimales_justos($rowdata['ValorIngreso']), 0); ?></p>
						<p class="text-muted"><strong>Valor promedio Egreso : </strong><?php echo Valores(Cantidades_decimales_justos($rowdata['ValorEgreso']), 0); ?></p>
						<p class="text-muted"><strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?></p>
					
						<h2 class="text-primary">Ficha Tecnica</h2>
						<p class="text-muted"><strong>Descripcion : </strong><?php echo $rowdata['Descripcion']; ?></p>
						
					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
			

			
			<div class="tab-pane fade" id="movimientos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Movimiento</th>
									<th>Bodega</th>
									<th>Fecha</th>
									<th>Cant Ing</th>
									<th>Cant eg</th>
								</tr>
							</thead>
		  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrProductos as $productos) { ?>
								
								<tr class="odd">
									<td>
										<div class="btn-group" >
											<a target="_new" href="<?php echo 'view_doc.php?view='.$productos['idFacturacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>
										</div>
										<?php echo $productos['TipoMovimiento']; ?>
									</td>
									<td><?php echo $productos['NombreBodega']; ?></td>
									<td><?php echo Fecha_estandar($productos['Creacion_fecha']); ?></td>
									<td><?php echo Cantidades_decimales_justos($productos['Cantidad_ing']).' '.$productos['UnidadMedida'];?></td>
									<td><?php echo Cantidades_decimales_justos($productos['Cantidad_eg']).' '.$productos['UnidadMedida'];?></td>
						
								</tr>
							<?php } ?>                     
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
        </div>	
	</div>
</div>



<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
