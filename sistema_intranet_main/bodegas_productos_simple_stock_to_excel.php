<?php session_start();
/**********************************************************************************************************************************/
/*                                                     Se llama la libreria                                                       */
/**********************************************************************************************************************************/
require '../LIBS_php/PhpOffice/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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

/*******************************************************/
$SIS_query = '
productos_listado.StockLimite,
productos_listado.Nombre AS NombreProd,
core_tipo_producto.Nombre AS tipo_producto,
sistema_productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_productos_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_productos_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_productos_listado.Nombre AS NombreBodega';
$SIS_join  = '
LEFT JOIN `productos_listado`           ON productos_listado.idProducto          = bodegas_productos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`       ON sistema_productos_uml.idUml           = productos_listado.idUml
LEFT JOIN `bodegas_productos_listado`   ON bodegas_productos_listado.idBodega    = bodegas_productos_facturacion_existencias.idBodega
LEFT JOIN `core_tipo_producto`          ON core_tipo_producto.idTipoProducto     = productos_listado.idTipoProducto';
$SIS_where = 'bodegas_productos_facturacion_existencias.idBodega='.$_GET['idBodega'].' GROUP BY bodegas_productos_facturacion_existencias.idProducto';
$SIS_order = 'core_tipo_producto.Nombre ASC, productos_listado.Nombre ASC';
$arrProductos = array();
$arrProductos = db_select_array (false, $SIS_query, 'bodegas_productos_facturacion_existencias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

/**********************************************************************************************************************************/
/*                                                          Ejecucion                                                             */
/**********************************************************************************************************************************/
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator(DeSanitizar($rowEmpresa['Nombre']))
							 ->setLastModifiedBy(DeSanitizar($rowEmpresa['Nombre']))
							 ->setTitle("Office 2007")
							 ->setSubject("Office 2007")
							 ->setDescription("Document for Office 2007")
							 ->setKeywords("office 2007")
							 ->setCategory("office 2007 result file");
           
//Titulo columnas
$spreadsheet->setActiveSheetIndex(0)
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
		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, DeSanitizar($delta))
					->setCellValue('B'.$nn, DeSanitizar($productos['tipo_producto']))
					->setCellValue('C'.$nn, DeSanitizar($productos['NombreProd']))
					->setCellValue('D'.$nn, cantidades_excel($productos['StockLimite']))
					->setCellValue('E'.$nn, cantidades_excel($stock_actual))
					->setCellValue('F'.$nn, DeSanitizar($productos['UnidadMedida']));
		 $nn++;  
	} 
} 

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle(cortar('Bodega '.DeSanitizar($arrProductos[0]['NombreBodega']), 25));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Stock Bodega '.$arrProductos[0]['NombreBodega'].' al '.fecha_actual();
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.DeSanitizar($filename).'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

