<?php
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//verifico que sea un administrador
$arrProductos = array();
$query = "SELECT
productos_listado.StockLimite,
productos_listado.Nombre AS NombreProd,
productos_tipo_producto.Nombre AS tipo_producto,
productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `productos_listado`          ON productos_listado.idProducto             = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`              ON productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `bodegas_listado`            ON bodegas_listado.idBodega                 = bodegas_facturacion_existencias.idBodega
LEFT JOIN `productos_tipo_producto`    ON productos_tipo_producto.idTipoProducto   = productos_listado.idTipoProducto
WHERE bodegas_facturacion_existencias.idBodega={$_GET['idBodega']}
GROUP BY bodegas_facturacion_existencias.idProducto
ORDER BY productos_tipo_producto.Nombre ASC, productos_listado.Nombre ASC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}



$my_html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Imprimir</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.25" />
	<!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/factura.css">
</head>

<body onload="window.print();">
	
	<div class="panel panel-cascade panel-invoice">
          
        <div class="panel-body">
			Stock Bodega: <strong>'.$arrProductos[0]['NombreBodega'].'</strong><br/>
			Stock al '.fecha_actual().'<br/>
			<br/>
			<br/>
			
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Tipo</th>
								<th>Nombre</th>
								<th>Stock Min</th>
								<th>Stock Actual</th>
							</tr>
						</thead>
						<tbody>';
							
							foreach ($arrProductos as $productos) { 
								$stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; 
								if ($productos['StockLimite']>$stock_actual){$delta = 'destaca';}else{$delta = '';}
								if ($stock_actual!=0&&$productos['NombreProd']!=''){
									$my_html .='<tr class="'.$delta.'">
												<td>'.$productos['tipo_producto'].'</td>
												<td>'.$productos['NombreProd'].'</td>
												<td width="160">'.Cantidades_decimales_justos($productos['StockLimite']).' '.$productos['UnidadMedida'].'</td>
												<td width="160">'.Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida'].'</td>
											</tr>';
								}
							}
							

						$my_html .='</tbody>
					</table>
				</div>
			</div>
			
			<div class="clear"></div>

		</div>
	</div>
</body>
</html>';

echo $my_html;

?>
