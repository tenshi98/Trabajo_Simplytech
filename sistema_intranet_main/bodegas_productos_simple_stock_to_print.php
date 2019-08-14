<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Print.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//verifico que sea un administrador
$arrProductos = array();
$query = "SELECT
productos_listado.StockLimite,
productos_listado.Nombre AS NombreProd,
core_tipo_producto.Nombre AS tipo_producto,
sistema_productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_productos_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_productos_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_productos_listado.Nombre AS NombreBodega

FROM `bodegas_productos_facturacion_existencias`
LEFT JOIN `productos_listado`           ON productos_listado.idProducto           = bodegas_productos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`       ON sistema_productos_uml.idUml            = productos_listado.idUml
LEFT JOIN `bodegas_productos_listado`   ON bodegas_productos_listado.idBodega     = bodegas_productos_facturacion_existencias.idBodega
LEFT JOIN `core_tipo_producto`          ON core_tipo_producto.idTipoProducto      = productos_listado.idTipoProducto
WHERE bodegas_productos_facturacion_existencias.idBodega={$_GET['idBodega']}
GROUP BY bodegas_productos_facturacion_existencias.idProducto
ORDER BY core_tipo_producto.Nombre ASC, productos_listado.Nombre ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}



$my_html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Imprimir</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.25" />
	<!-- Bootstrap -->
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/css/factura.css">
</head>

<body onload="window.print();">
	
	<div class="panel panel-cascade panel-invoice">
          
        <div class="panel-body">
			Stock Bodega: <strong>'.$arrProductos[0]['NombreBodega'].'</strong><br/>
			Stock al '.fecha_actual().'<br/>
			<br/>
			<br/>
			
			<div class="row">
				<div class="col-sm-12">
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
