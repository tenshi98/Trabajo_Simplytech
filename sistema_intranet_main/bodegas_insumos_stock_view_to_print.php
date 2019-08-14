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
bodegas_insumos_facturacion_existencias.idFacturacion,
bodegas_insumos_facturacion_existencias.Creacion_fecha,
bodegas_insumos_facturacion_existencias.Cantidad_ing,
bodegas_insumos_facturacion_existencias.Cantidad_eg,
bodegas_insumos_facturacion_tipo.Nombre AS TipoMovimiento,
insumos_listado.Nombre AS NombreProducto,
sistema_productos_uml.Nombre AS UnidadMedida,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_insumos_facturacion.N_Doc AS N_Doc,
trabajadores_listado.Nombre AS trab_nombre,
trabajadores_listado.ApellidoPat AS trab_appat,
trabajadores_listado.ApellidoMat AS trab_apmat,
proveedor_listado.Nombre AS Proveedor,
(SELECT Nombre FROM bodegas_insumos_listado WHERE idBodega={$_GET['idBodega']} LIMIT 1) AS NombreBodega

FROM `bodegas_insumos_facturacion_existencias`
LEFT JOIN `bodegas_insumos_facturacion_tipo`    ON bodegas_insumos_facturacion_tipo.idTipo       = bodegas_insumos_facturacion_existencias.idTipo
LEFT JOIN `insumos_listado`                     ON insumos_listado.idProducto                    = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`                         ON sistema_productos_uml.idUml                             = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_facturacion`         ON bodegas_insumos_facturacion.idFacturacion     = bodegas_insumos_facturacion_existencias.idFacturacion
LEFT JOIN `core_documentos_mercantiles`      ON core_documentos_mercantiles.idDocumentos   = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`                   ON proveedor_listado.idProveedor                 = bodegas_insumos_facturacion.idProveedor
LEFT JOIN `trabajadores_listado`                ON trabajadores_listado.idTrabajador             = bodegas_insumos_facturacion.idTrabajador

WHERE bodegas_insumos_facturacion_existencias.idProducto={$_GET['view']}  
AND bodegas_insumos_facturacion_existencias.idBodega={$_GET['idBodega']}
ORDER BY bodegas_insumos_facturacion_existencias.Creacion_fecha DESC 
LIMIT 100";
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
			Movimientos Bodega: <strong>'.$arrProductos[0]['NombreBodega'].'</strong><br/>
			Insumo: <strong>'.$arrProductos[0]['NombreProducto'].'</strong><br/>
			Ultimos 100 Registros<br/>
			<br/>
			<br/>
			
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Movimiento</th>
								<th>Proveedor/Trabajador</th>
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
								$ndoc = $productos['Documento'].' N° '.$productos['N_Doc'];
							}else{
								$empresa = 'Trabajador : '.$productos['trab_nombre'].' '.$productos['trab_appat'].' '.$productos['trab_apmat'];
								$ndoc = 'Documento N° '.$productos['idFacturacion'];
							}
							$my_html .='<tr">
											<td>'.$productos['TipoMovimiento'].'</td>
											<td>'.$empresa.'</td>
											<td>'.$ndoc.'</td>
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
