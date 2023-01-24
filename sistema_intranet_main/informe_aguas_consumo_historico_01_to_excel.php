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

/*******************************************************/
//Variable de busqueda
$SIS_where = "aguas_facturacion_listado_detalle.idFacturacionDetalle!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Ano']) && $_GET['Ano']!=''){         $SIS_where .= " AND aguas_facturacion_listado_detalle.Ano=".$_GET['Ano'];}
if(isset($_GET['idMes']) && $_GET['idMes']!=''){     $SIS_where .= " AND aguas_facturacion_listado_detalle.idMes=".$_GET['idMes'];}
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){    $SIS_where .= " AND aguas_facturacion_listado_detalle.idCliente=".$_GET['idCliente'];}

$SIS_query = '
aguas_facturacion_listado_detalle.Ano, 
aguas_facturacion_listado_detalle.DetalleConsumoCantidad, 
aguas_facturacion_listado_detalle.DetalleRecoleccionCantidad,
core_tiempo_meses.Nombre AS Mes,
aguas_clientes_listado.Identificador AS ClienteIdentificador,
aguas_clientes_listado.Nombre AS ClienteNombre';
$SIS_join  = '
LEFT JOIN `core_tiempo_meses`        ON core_tiempo_meses.idMes            = aguas_facturacion_listado_detalle.idMes
LEFT JOIN `aguas_clientes_listado`   ON aguas_clientes_listado.idCliente   = aguas_facturacion_listado_detalle.idCliente';
$SIS_order = 'aguas_clientes_listado.Identificador ASC, aguas_facturacion_listado_detalle.Ano ASC, aguas_facturacion_listado_detalle.idMes ASC';
$arrConsumos = array();
$arrConsumos = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrConsumos');

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
			->setCellValue('A1', 'Identificador')
            ->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'Año')
            ->setCellValue('D1', 'Mes')
            ->setCellValue('E1', 'Consumo')
            ->setCellValue('F1', 'Recoleccion');
				
//variables
$nn = 2;
//arreglo
foreach ($arrConsumos as $fact) { 

	$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, DeSanitizar($fact['ClienteIdentificador']))
				->setCellValue('B'.$nn, DeSanitizar($fact['ClienteNombre']))
				->setCellValue('C'.$nn, $fact['Ano'])
				->setCellValue('D'.$nn, $fact['Mes'])
				->setCellValue('E'.$nn, $fact['DetalleConsumoCantidad'])
				->setCellValue('F'.$nn, $fact['DetalleRecoleccionCantidad']);
														
	$nn++;
}



// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Consumo Historico');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Consumo Historico';
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
