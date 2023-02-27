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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//obtengo los datos de la empresa
$rowEmpresa = db_select_data (false, 'Nombre', 'core_sistemas','', 'idSistema='.$_GET['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');

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
/*                                                          Ejecucion                                                             */
/**********************************************************************************************************************************/
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator(DeSanitizar($rowEmpresa['Nombre']))
							 ->setLastModifiedBy(DeSanitizar($rowEmpresa['Nombre']))
							 ->setTitle('Office 2007')
							 ->setSubject('Office 2007')
							 ->setDescription('Document for Office 2007.')
							 ->setKeywords('office 2007 openxml php')
							 ->setCategory('office 2007 result file');
					 						 
// Add some data
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Alerta')
            ->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'Stock Minimo')
            ->setCellValue('D1', 'Stock Actual')
            ->setCellValue('E1', 'Unidad de Medida');
            

$nn=2;
foreach ($arrProductos as $productos) {
	$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
	if ($productos['StockLimite']>$stock_actual){$delta = 'Stock Bajo';}else{$delta = '';}
	if ($stock_actual!=0&&$productos['NombreProd']!=''){
		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, DeSanitizar($delta))
					->setCellValue('B'.$nn, DeSanitizar($productos['NombreProd']))
					->setCellValue('C'.$nn, cantidades_excel($productos['StockLimite']))
					->setCellValue('D'.$nn, cantidades_excel($stock_actual))
					->setCellValue('E'.$nn, DeSanitizar($productos['UnidadMedida']));
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

