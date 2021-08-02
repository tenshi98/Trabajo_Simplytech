<?php session_start();
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../LIBS_php/PHPExcel/PHPExcel.php';
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Excel.php';
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
//obtengo los datos de la empresa
$rowEmpresa = db_select_data (false, 'Nombre', 'core_sistemas', '', 'idSistema='.$_GET['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');


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

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator($rowEmpresa['Nombre'])
							 ->setLastModifiedBy($rowEmpresa['Nombre'])
							 ->setTitle("Office 2007")
							 ->setSubject("Office 2007")
							 ->setDescription("Document for Office 2007")
							 ->setKeywords("office 2007")
							 ->setCategory("office 2007 result file");

			
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Bodega: '.$arrProductos[0]['NombreBodega']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Producto: '.$arrProductos[0]['NombreProducto']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Ultimos 100 Registros');            
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Movimiento')
            ->setCellValue('B5', 'Proveedor/Cliente')
            ->setCellValue('C5', 'Documento')
            ->setCellValue('D5', 'Fecha')
            ->setCellValue('E5', 'Cant Ing')
            ->setCellValue('F5', 'Cant eg')
            ->setCellValue('G5', 'Unidad de Medida');
            
$nn=6;
foreach ($arrProductos as $productos) { 
if(isset($productos['Proveedor'])&&$productos['Proveedor']){
	$empresa = 'Proveedor : '.$productos['Proveedor'];
}else{
	$empresa = 'Cliente : '.$productos['Cliente'];
}
							
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, $productos['TipoMovimiento'])
            ->setCellValue('B'.$nn, $empresa)
            ->setCellValue('C'.$nn, $productos['Documento'].' N° '.$productos['N_Doc'])
            ->setCellValue('D'.$nn, Fecha_estandar($productos['Creacion_fecha']))
            ->setCellValue('E'.$nn, cantidades_excel($productos['Cantidad_ing']))
            ->setCellValue('F'.$nn, cantidades_excel($productos['Cantidad_eg']))
            ->setCellValue('G'.$nn, $productos['UnidadMedida']);
 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle(cortar('Bodega '.$arrProductos[0]['NombreBodega'], 25));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Movimiento Producto '.$arrProductos[0]['NombreProducto'].' Bodega '.$arrProductos[0]['NombreBodega'].' ultimos 100 registros.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
