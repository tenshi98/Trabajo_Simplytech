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
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
	$w = "bodegas_facturacion.idSistema={$_GET['idSistema']}";
}else{	
	$w = "bodegas_facturacion.idSistema>=0";	
}
// Se trae un listado con todos los productos
$arrProductos = array();
$query = "SELECT 
origen.Nombre AS BodegaOrigen,
destino.Nombre AS BodegaDestino,
core_sistemas.Nombre AS SistemaDestino,
bodegas_facturacion_existencias.idFacturacion,
bodegas_facturacion_existencias.Creacion_fecha,
productos_listado.Nombre AS Producto,
SUM(bodegas_facturacion_existencias.Cantidad_eg) AS Engreso,
productos_uml.Nombre AS Uml,
productos_listado.ValorIngreso

FROM bodegas_facturacion_existencias 
LEFT JOIN bodegas_facturacion        ON bodegas_facturacion.idFacturacion    = bodegas_facturacion_existencias.idFacturacion
LEFT JOIN bodegas_listado   origen   ON origen.idBodega                      = bodegas_facturacion.idBodegaOrigen
LEFT JOIN bodegas_listado   destino  ON destino.idBodega                     = bodegas_facturacion.idBodegaDestino
LEFT JOIN core_sistemas              ON core_sistemas.idSistema              = bodegas_facturacion.idSistemaDestino
LEFT JOIN productos_listado          ON productos_listado.idProducto         = bodegas_facturacion_existencias.idProducto
LEFT JOIN productos_uml              ON productos_uml.idUml                  = productos_listado.idUml

WHERE  bodegas_facturacion.idBodegaOrigen={$_GET['idBodegaOrigen']} 
AND  ".$w." 
AND  bodegas_facturacion.idBodegaDestino={$_GET['idBodegaDestino']} 
AND  bodegas_facturacion.idSistemaDestino={$_GET['idSistemaDestino']} 
AND  bodegas_facturacion_existencias.Creacion_fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'
GROUP BY bodegas_facturacion_existencias.idFacturacion ";
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
			Traspaso Productos Bodega: <strong>'.$arrProductos[0]['BodegaOrigen'].'</strong><br/>
			a Bodega: <strong>'.$arrProductos[0]['BodegaDestino'].' de '.$arrProductos[0]['SistemaDestino'].'</strong><br/>
			Registros entre fechas '.Fecha_estandar($_GET['f_inicio']).' al '.Fecha_estandar($_GET['f_termino']).'<br/>
			<br/>
			<br/>
			
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="120">Fecha</th>
								<th width="120">Documento n°</th>
								<th>Producto</th>
								<th width="120">Cantidad</th>
								<th width="120">Unidad de Medida</th>
								<th width="120">V/Unitario</th>
								<th width="120">V/Total</th>
							</tr>
						</thead>
						<tbody>';
		
		
	
							foreach ($arrProductos as $productos) { 
							
							$my_html .='<tr">
											<td>'.Fecha_estandar($productos['Creacion_fecha']).'</td>
											<td>Traspaso N° '.$productos['idFacturacion'].'</td>
											<td>'.$productos['Producto'].'</td>
											<td>'.cantidades_excel($productos['Engreso']).'</td>
											<td>'.$productos['Uml'].'</td>
											<td>'.Valores_sd($productos['ValorIngreso']).'</td>
											<td>'.Valores_sd($productos['Engreso']*$productos['ValorIngreso']).'</td>
						
										</tr>';
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
