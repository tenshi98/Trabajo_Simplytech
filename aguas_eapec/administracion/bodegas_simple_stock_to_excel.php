<?php
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'lib_PHPExcel/PHPExcel.php';
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
//obtengo los datos de la empresa
$query = "SELECT Nombre	
FROM `core_sistemas` 
WHERE idSistema = '{$_GET['idSistema']}'  ";
$resultado = mysqli_query ($dbConn, $query);
$rowEmpresa = mysqli_fetch_array ($resultado);


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
            ->setCellValue('A1', 'Alertas')
            ->setCellValue('B1', 'Tipo')
            ->setCellValue('C1', 'Nombre')
            ->setCellValue('D1', 'Stock Min')
            ->setCellValue('E1', 'Stock Actual')
            ->setCellValue('F1', 'Unidad de Medida');
            
$nn=2;
foreach ($arrProductos as $productos) { 
	$stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; 
	if ($productos['StockLimite']>$stock_actual){$delta = 'Stock Bajo';}else{$delta = '';}
	if ($stock_actual!=0&&$productos['NombreProd']!=''){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, "$delta")
					->setCellValue('B'.$nn, $productos['tipo_producto'])
					->setCellValue('C'.$nn, $productos['NombreProd'])
					->setCellValue('D'.$nn, cantidades_excel($productos['StockLimite']))
					->setCellValue('E'.$nn, cantidades_excel($stock_actual))
					->setCellValue('F'.$nn, $productos['UnidadMedida']);
		 $nn++;  
	}         
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Bodega '.$arrProductos[0]['NombreBodega']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Stock Bodega '.$arrProductos[0]['NombreBodega'].' al '.fecha_actual().'.xls"');
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
