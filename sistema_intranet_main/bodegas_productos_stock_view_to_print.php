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
// Se trae un listado con todos los datos
$arrProductos = array();
$query = "SELECT 
bodegas_productos_facturacion_existencias.Creacion_fecha,
bodegas_productos_facturacion_existencias.Cantidad_ing,
bodegas_productos_facturacion_existencias.Cantidad_eg,
bodegas_productos_facturacion_tipo.Nombre AS TipoMovimiento,
productos_listado.Nombre AS NombreProducto,
sistema_productos_uml.Nombre AS UnidadMedida,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_productos_facturacion.N_Doc AS N_Doc,
clientes_listado.Nombre AS Cliente,
proveedor_listado.Nombre AS Proveedor,
bodegas_productos_listado.Nombre AS NombreBodega

FROM `bodegas_productos_facturacion_existencias`
LEFT JOIN `bodegas_productos_facturacion_tipo`          ON bodegas_productos_facturacion_tipo.idTipo               = bodegas_productos_facturacion_existencias.idTipo
LEFT JOIN `productos_listado`                           ON productos_listado.idProducto                            = bodegas_productos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`                       ON sistema_productos_uml.idUml                             = productos_listado.idUml
LEFT JOIN `bodegas_productos_facturacion`               ON bodegas_productos_facturacion.idFacturacion             = bodegas_productos_facturacion_existencias.idFacturacion
LEFT JOIN `core_documentos_mercantiles`                 ON core_documentos_mercantiles.idDocumentos                = bodegas_productos_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`                           ON proveedor_listado.idProveedor                           = bodegas_productos_facturacion.idProveedor
LEFT JOIN `clientes_listado`                            ON clientes_listado.idCliente                              = bodegas_productos_facturacion.idCliente
LEFT JOIN `bodegas_productos_listado`                   ON bodegas_productos_listado.idBodega                      = bodegas_productos_facturacion_existencias.idBodega

WHERE bodegas_productos_facturacion_existencias.idProducto=".$_GET['view']."  
AND bodegas_productos_facturacion_existencias.idBodega=".$_GET['idBodega']."
ORDER BY bodegas_productos_facturacion_existencias.Creacion_fecha DESC 
LIMIT 100";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
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
			Movimientos Bodega: <strong>'.$arrProductos[0]['NombreBodega'].'</strong><br/>
			Producto: <strong>'.$arrProductos[0]['NombreProducto'].'</strong><br/>
			Ultimos 100 Registros<br/>
			<br/>
			<br/>
			
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Movimiento</th>
								<th>Proveedor/Cliente</th>
								<th>Documento</th>
								<th width="160">Fecha</th>
								<th width="160">Cant Ing</th>
								<th width="160">Cant eg</th>
							</tr>
						</thead>
						<tbody>';
		
		
	
							foreach ($arrProductos as $productos) { 
							
							if(isset($productos['Proveedor'])&&$productos['Proveedor']){
								$empresa = 'Proveedor : '.$productos['Proveedor'];
							}else{
								$empresa = 'Cliente : '.$productos['Cliente'];
							}
							$my_html .='<tr">
											<td>'.$productos['TipoMovimiento'].'</td>
											<td>'.$empresa.'</td>
											<td>'.$productos['Documento'].' N° '.$productos['N_Doc'].'</td>
											<td width="160">'.Fecha_estandar($productos['Creacion_fecha']).'</td>
											<td width="160">'.Cantidades_decimales_justos($productos['Cantidad_ing']).' '.$productos['UnidadMedida'].'</td>
											<td width="160">'.Cantidades_decimales_justos($productos['Cantidad_eg']).' '.$productos['UnidadMedida'].'</td>
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
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';
?>
