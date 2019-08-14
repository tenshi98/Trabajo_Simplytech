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
// Se trae un listado con todos los productos
$arrProductos = array();
$query = "SELECT 
insumos_listado.StockLimite,
insumos_listado.ValorIngreso,
insumos_listado.Nombre AS NombreProd,
sistema_productos_uml.Nombre AS UnidadMedida,
(SELECT SUM(Cantidad_ing) FROM bodegas_insumos_facturacion_existencias WHERE idProducto = insumos_listado.idProducto AND idBodega={$_GET['idBodega']}  LIMIT 1) AS stock_entrada,
(SELECT SUM(Cantidad_eg) FROM bodegas_insumos_facturacion_existencias WHERE idProducto = insumos_listado.idProducto AND idBodega={$_GET['idBodega']} LIMIT 1) AS stock_salida,
(SELECT Nombre FROM bodegas_insumos_listado WHERE idBodega={$_GET['idBodega']} LIMIT 1) AS NombreBodega
FROM `insumos_listado`
LEFT JOIN `sistema_productos_uml`                ON sistema_productos_uml.idUml                        = insumos_listado.idUml

ORDER BY insumos_listado.Nombre ASC";
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
								<th>Nombre</th>
								<th>Stock Min</th>
								<th>Stock Actual</th>
								<th>V/Unitario</th>
								<th>V/Total</th>
							</tr>
						</thead>
						<tbody>';
							
							foreach ($arrProductos as $productos) { 
								$stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; 
								if ($stock_actual!=0){
									if ($productos['StockLimite']>$stock_actual){$delta = 'destaca';}else{$delta = '';}
								
									$my_html .='<tr class="'.$delta.'">
												<td>'.$productos['NombreProd'].'</td>
												<td width="160">'.Cantidades_decimales_justos($productos['StockLimite']).' '.$productos['UnidadMedida'].'</td>
												<td width="160">'.Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida'].'</td>
												<td>'.Valores($productos['ValorIngreso'], 0).'</td>
												<td>'.Valores($stock_actual*$productos['ValorIngreso'], 0).'</td>
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
