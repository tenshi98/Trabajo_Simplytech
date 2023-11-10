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
require_once 'core/Load.Utils.Print.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//verifico que sea un administrador
$arrProductos = array();
$query = "SELECT
insumos_listado.StockLimite,
insumos_listado.Nombre AS NombreProd,
sistema_productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_insumos_listado.Nombre AS NombreBodega

FROM `bodegas_insumos_facturacion_existencias`
LEFT JOIN `insumos_listado`    ON insumos_listado.idProducto    = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`        ON sistema_productos_uml.idUml             = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_listado`    ON bodegas_insumos_listado.idBodega      = bodegas_insumos_facturacion_existencias.idBodega

WHERE bodegas_insumos_facturacion_existencias.idBodega=".$_GET['idBodega']."
GROUP BY bodegas_insumos_facturacion_existencias.idProducto";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
				
}
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrProductos,$row );
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.PrintFact.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
$my_html ='
	<div class="panel panel-cascade panel-invoice">
          
        <div class="panel-body">
			Stock Bodega: <strong>'.$arrProductos[0]['NombreBodega'].'</strong><br/>
			Stock al '.fecha_actual().'<br/>
			<br/>
			<br/>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Stock Minimo</th>
								<th>Stock Actual</th>
							</tr>
						</thead>
						<tbody>';

							foreach ($arrProductos as $productos) {
								$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
								if ($stock_actual!=0&&$productos['NombreProd']!=''){
									$my_html .='<tr>
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
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';

?>
