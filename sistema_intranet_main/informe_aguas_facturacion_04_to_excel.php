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
$SIS_query = '
ClienteIdentificador, 
DetalleCargoFijoValor, DetalleConsumoValor, DetalleRecoleccionValor,
DetalleVisitaCorte, DetalleCorte1Valor, DetalleCorte2Valor, DetalleReposicion1Valor, DetalleReposicion2Valor,
DetalleInteresDeuda,
DetalleOtrosCargos1Valor, DetalleOtrosCargos2Valor, DetalleOtrosCargos3Valor,DetalleOtrosCargos4Valor, DetalleOtrosCargos5Valor,
DetalleTotalAPagar,
Fecha';
$SIS_join  = '';
$SIS_where = 'idMes = '.$_GET['idMes'].' AND Ano = '.$_GET['Ano'].' AND idSistema = '.$_GET['idSistema'];
$SIS_order = 'ClienteIdentificador ASC';
$arrFacturacion = array();
$arrFacturacion = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrFacturacion');

/**********************************************************************************************************************************/
/*                                                          Ejecucion                                                             */
/**********************************************************************************************************************************/
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator($rowEmpresa['Nombre'])
							 ->setLastModifiedBy($rowEmpresa['Nombre'])
							 ->setTitle("Office 2007")
							 ->setSubject("Office 2007")
							 ->setDescription("Document for Office 2007")
							 ->setKeywords("office 2007")
							 ->setCategory("office 2007 result file");
               
//Titulo documento
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Facturacion Mes de '.Fecha_mes_ano($arrFacturacion[0]['Fecha']));
            			         
//Titulo columnas
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A3', 'Identificador')
            ->setCellValue('B3', 'Consumo mes')
            ->setCellValue('C3', 'Otros Cargos')
            ->setCellValue('D3', 'Intereses')
            ->setCellValue('E3', 'Total Con IVA')
            ->setCellValue('F3', 'IVA')
            ->setCellValue('G3', 'Total Sin IVA');

					
$nn=4;
//variables en 0
$t_consumo_mes  = 0;
$t_OtrosCargos  = 0;
$t_Intereses    = 0;
$t_TotalConIva  = 0;
$t_iva          = 0;
$t_TotalSinIva  = 0;
//se recorre arreglo
foreach ($arrFacturacion as $fact) { 
	//Se hacen los calculos
	$consumo_mes  = $fact['DetalleCargoFijoValor'] + $fact['DetalleConsumoValor'] + $fact['DetalleRecoleccionValor'];
	$OtrosCargos  = $fact['DetalleVisitaCorte'] + $fact['DetalleCorte1Valor'] + $fact['DetalleCorte2Valor'] + $fact['DetalleReposicion1Valor'] + $fact['DetalleReposicion2Valor'] + $fact['DetalleOtrosCargos1Valor'] + $fact['DetalleOtrosCargos2Valor'] + $fact['DetalleOtrosCargos3Valor'] + $fact['DetalleOtrosCargos4Valor'] + $fact['DetalleOtrosCargos5Valor'];
	$Intereses    = $fact['DetalleInteresDeuda'];
	$TotalConIva  = $consumo_mes + $OtrosCargos + $Intereses;
	$iva          = $TotalConIva - ($TotalConIva / 1.19);
	$TotalSinIva  = $TotalConIva / 1.19;
	//se guardan totales
	$t_consumo_mes  = $t_consumo_mes + $consumo_mes;
	$t_OtrosCargos  = $t_OtrosCargos + $OtrosCargos;
	$t_Intereses    = $t_Intereses + $Intereses;
	$t_TotalConIva  = $t_TotalConIva + $TotalConIva;
	$t_iva          = $t_iva + $iva;
	$t_TotalSinIva  = $t_TotalSinIva + $TotalSinIva;
	
	$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $fact['ClienteIdentificador'])
				->setCellValue('B'.$nn, $consumo_mes)
				->setCellValue('C'.$nn, $OtrosCargos)
				->setCellValue('D'.$nn, $Intereses)
				->setCellValue('E'.$nn, $TotalConIva)
				->setCellValue('F'.$nn, $iva)
				->setCellValue('G'.$nn, $TotalSinIva);

	$nn++;
   
} 

//se imprimen totales
$nn++;
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$nn, 'Totales')
            ->setCellValue('B'.$nn, $t_consumo_mes)
            ->setCellValue('C'.$nn, $t_OtrosCargos)
            ->setCellValue('D'.$nn, $t_Intereses)
            ->setCellValue('E'.$nn, $t_TotalConIva)
            ->setCellValue('F'.$nn, $t_iva)
            ->setCellValue('G'.$nn, $t_TotalSinIva); 			
				                       

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Facturacion');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Facturacion Mes de '.Fecha_mes_ano($arrFacturacion[0]['Fecha']);
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

