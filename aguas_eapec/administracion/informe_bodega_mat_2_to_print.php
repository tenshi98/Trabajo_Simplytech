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
// Se trae un listado con todos los datos
$arrProductos = array();
$query = "SELECT 
bodegas_facturacion_existencias.Creacion_fecha,
bodegas_facturacion_existencias.Cantidad_ing,
bodegas_facturacion_existencias.Cantidad_eg,
bodegas_facturacion_tipo.Nombre AS TipoMovimiento,
productos_listado.Nombre AS NombreProducto,
productos_uml.Nombre AS UnidadMedida,
bodegas_documentos_mercantiles.Nombre AS Documento,
bodegas_facturacion.N_Doc AS N_Doc,
clientes_listado.Nombre AS Cliente,
proveedor_listado.Nombre AS Proveedor,
mnt_meses.Nombre AS Mes,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `bodegas_facturacion_tipo`          ON bodegas_facturacion_tipo.idTipo               = bodegas_facturacion_existencias.idTipo
LEFT JOIN `productos_listado`                 ON productos_listado.idProducto                  = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`                     ON productos_uml.idUml                           = productos_listado.idUml
LEFT JOIN `bodegas_facturacion`               ON bodegas_facturacion.idFacturacion             = bodegas_facturacion_existencias.idFacturacion
LEFT JOIN `bodegas_documentos_mercantiles`    ON bodegas_documentos_mercantiles.idDocumentos   = bodegas_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`                 ON proveedor_listado.idProveedor                 = bodegas_facturacion.idProveedor
LEFT JOIN `clientes_listado`                  ON clientes_listado.idCliente                    = bodegas_facturacion.idCliente
LEFT JOIN `mnt_meses`                         ON mnt_meses.idMes                               = bodegas_facturacion_existencias.Creacion_mes
LEFT JOIN `bodegas_listado`                   ON bodegas_listado.idBodega                      = bodegas_facturacion_existencias.idBodega

WHERE bodegas_facturacion_existencias.idProducto={$_GET['idProducto']}  
AND bodegas_facturacion_existencias.idBodega={$_GET['idBodega']}
AND bodegas_facturacion_existencias.Creacion_ano={$_GET['Creacion_ano']}
AND bodegas_facturacion_existencias.Creacion_mes={$_GET['Creacion_mes']}
ORDER BY bodegas_facturacion_existencias.Creacion_fecha DESC 
";
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
			Movimientos Bodega: <strong>'.$arrProductos[0]['NombreBodega'].'</strong><br/>
			Producto: <strong>'.$arrProductos[0]['NombreProducto'].'</strong><br/>
			Registros de '.$arrProductos[0]['Mes'].' de '.$_GET['Creacion_ano'].'<br/>
			<br/>
			<br/>
			
			<div class="row">
				<div class="col-md-12">
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

?>
