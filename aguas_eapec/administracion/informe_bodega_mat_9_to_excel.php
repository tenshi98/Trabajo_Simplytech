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


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Office 2007")
							 ->setLastModifiedBy("Office 2007")
							 ->setTitle("Office 2007")
							 ->setSubject("Office 2007")
							 ->setDescription("Document for Office 2007")
							 ->setKeywords("office 2007")
							 ->setCategory("office 2007 result file");

			
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Bodega Origen: '.$arrProductos[0]['BodegaOrigen']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Bodega Destino: '.$arrProductos[0]['BodegaDestino'].' de '.$arrProductos[0]['SistemaDestino']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Registros entre fechas '.Fecha_estandar($_GET['f_inicio']).' al '.Fecha_estandar($_GET['f_termino']));            
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Fecha')
            ->setCellValue('B5', 'Documento n°')
            ->setCellValue('C5', 'Producto')
            ->setCellValue('D5', 'Cantidad')
            ->setCellValue('E5', 'Unidad de Medida')
            ->setCellValue('F5', 'V/Unitario')
            ->setCellValue('G5', 'V/Total');
            
			
            
$nn=6;
foreach ($arrProductos as $productos) { 
							
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, Fecha_estandar($productos['Creacion_fecha']))
            ->setCellValue('B'.$nn, 'Traspaso N° '.$productos['idFacturacion'])
            ->setCellValue('C'.$nn, $productos['Producto'])
            ->setCellValue('D'.$nn, cantidades_excel($productos['Engreso']))
            ->setCellValue('E'.$nn, $productos['Uml'])
            ->setCellValue('F'.$nn, Valores_sd($productos['ValorIngreso']))
            ->setCellValue('G'.$nn, Valores_sd($productos['Engreso']*$productos['ValorIngreso']));
 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Bodega '.$arrProductos[0]['BodegaOrigen']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Traspaso Productos Bodega '.$arrProductos[0]['BodegaOrigen'].' a Bodega '.$arrProductos[0]['BodegaDestino'].' de '.$arrProductos[0]['SistemaDestino'].'.xls"');
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


