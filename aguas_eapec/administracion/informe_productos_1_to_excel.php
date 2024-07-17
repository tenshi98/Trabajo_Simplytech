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
// Se trae un listado con todos los datos
$arrProductos = array();
$query = "SELECT 
bodegas_facturacion_existencias.Creacion_fecha,
bodegas_facturacion_existencias.Cantidad_ing,
bodegas_facturacion_existencias.Cantidad_eg,
bodegas_facturacion_tipo.Nombre AS TipoMovimiento,
bodegas_facturacion_existencias.Valor,
productos_listado.Nombre AS NombreProducto,
productos_uml.Nombre AS UnidadMedida,
bodegas_documentos_mercantiles.Nombre AS Documento,
bodegas_facturacion.N_Doc AS N_Doc,
clientes_listado.Nombre AS Cliente,
proveedor_listado.Nombre AS Proveedor,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `bodegas_facturacion_tipo`          ON bodegas_facturacion_tipo.idTipo               = bodegas_facturacion_existencias.idTipo
LEFT JOIN `productos_listado`                 ON productos_listado.idProducto                  = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`                     ON productos_uml.idUml                           = productos_listado.idUml
LEFT JOIN `bodegas_facturacion`               ON bodegas_facturacion.idFacturacion             = bodegas_facturacion_existencias.idFacturacion
LEFT JOIN `bodegas_documentos_mercantiles`    ON bodegas_documentos_mercantiles.idDocumentos   = bodegas_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`                 ON proveedor_listado.idProveedor                 = bodegas_facturacion.idProveedor
LEFT JOIN `clientes_listado`                  ON clientes_listado.idCliente                    = bodegas_facturacion.idCliente
LEFT JOIN `bodegas_listado`                   ON bodegas_listado.idBodega                      = bodegas_facturacion_existencias.idBodega

WHERE bodegas_facturacion_existencias.idProducto={$_GET['idProducto']}  
AND bodegas_facturacion_existencias.idBodega={$_GET['idBodega']}
AND bodegas_facturacion_existencias.Creacion_fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'
AND bodegas_facturacion_existencias.idTipo={$_GET['idTipo']}
ORDER BY bodegas_facturacion_existencias.Creacion_fecha DESC 
";
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
            ->setCellValue('A1', 'Bodega: '.$arrProductos[0]['NombreBodega']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Producto: '.$arrProductos[0]['NombreProducto']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Registros entre fechas '.Fecha_estandar($_GET['f_inicio']).' al '.Fecha_estandar($_GET['f_termino']));            
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Movimiento')
            ->setCellValue('B5', 'Proveedor/Cliente')
            ->setCellValue('C5', 'Documento')
            ->setCellValue('D5', 'Fecha')
            ->setCellValue('E5', 'Cant Ing')
            ->setCellValue('F5', 'Cant eg')
            ->setCellValue('G5', 'Unidad de Medida')
            ->setCellValue('H5', 'Valor');
            
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
            ->setCellValue('G'.$nn, $productos['UnidadMedida'])
            ->setCellValue('h'.$nn, $productos['Valor'].' x '.$productos['UnidadMedida']);
 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Bodega '.$arrProductos[0]['NombreBodega']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Valor Producto '.$arrProductos[0]['NombreProducto'].' Bodega '.$arrProductos[0]['NombreBodega'].'.xls"');
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
