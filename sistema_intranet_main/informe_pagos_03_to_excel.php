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
//Variable de busqueda
$z1 = "bodegas_arriendos_facturacion.idEstado=1";
$z2 = "bodegas_insumos_facturacion.idEstado=1";
$z3 = "bodegas_productos_facturacion.idEstado=1";
$z4 = "bodegas_servicios_facturacion.idEstado=1";
//Verifico el tipo de usuario que esta ingresando
$z1.=" AND bodegas_arriendos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
$z2.=" AND bodegas_insumos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
$z3.=" AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
$z4.=" AND bodegas_servicios_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
//Verifico que sean solo compras
$z1.=" AND (bodegas_arriendos_facturacion.idTipo=2 OR bodegas_arriendos_facturacion.idTipo=12)";
$z2.=" AND (bodegas_insumos_facturacion.idTipo=2 OR bodegas_insumos_facturacion.idTipo=12)";
$z3.=" AND (bodegas_productos_facturacion.idTipo=2 OR bodegas_productos_facturacion.idTipo=12)";
$z4.=" AND (bodegas_servicios_facturacion.idTipo=2 OR bodegas_servicios_facturacion.idTipo=12)";

if(isset($_GET['idCliente'])&&$_GET['idCliente']!=''){   
	$z1.=" AND bodegas_arriendos_facturacion.idCliente=".$_GET['idCliente'];
	$z2.=" AND bodegas_insumos_facturacion.idCliente=".$_GET['idCliente'];
	$z3.=" AND bodegas_productos_facturacion.idCliente=".$_GET['idCliente'];
	$z4.=" AND bodegas_servicios_facturacion.idCliente=".$_GET['idCliente'];
}
if(isset($_GET['idDocumentos'])&&$_GET['idDocumentos']!=''){ 
	$z1.=" AND bodegas_arriendos_facturacion.idDocumentos=".$_GET['idDocumentos'];
	$z2.=" AND bodegas_insumos_facturacion.idDocumentos=".$_GET['idDocumentos'];
	$z3.=" AND bodegas_productos_facturacion.idDocumentos=".$_GET['idDocumentos'];
	$z4.=" AND bodegas_servicios_facturacion.idDocumentos=".$_GET['idDocumentos'];
}
if(isset($_GET['N_Doc'])&&$_GET['N_Doc']!=''){               
	$z1.=" AND bodegas_arriendos_facturacion.N_Doc=".$_GET['N_Doc'];
	$z2.=" AND bodegas_insumos_facturacion.N_Doc=".$_GET['N_Doc'];
	$z3.=" AND bodegas_productos_facturacion.N_Doc=".$_GET['N_Doc'];
	$z4.=" AND bodegas_servicios_facturacion.N_Doc=".$_GET['N_Doc'];
}
if(isset($_GET['f_creacion_inicio'])&&$_GET['f_creacion_inicio']!=''&&isset($_GET['f_creacion_termino'])&&$_GET['f_creacion_termino']!=''){
	$z1.=" AND bodegas_arriendos_facturacion.Creacion_fecha BETWEEN '".$_GET['f_creacion_inicio']."' AND '".$_GET['f_creacion_termino']."'";
	$z2.=" AND bodegas_insumos_facturacion.Creacion_fecha BETWEEN '".$_GET['f_creacion_inicio']."' AND '".$_GET['f_creacion_termino']."'";
	$z3.=" AND bodegas_productos_facturacion.Creacion_fecha BETWEEN '".$_GET['f_creacion_inicio']."' AND '".$_GET['f_creacion_termino']."'";
	$z4.=" AND bodegas_servicios_facturacion.Creacion_fecha BETWEEN '".$_GET['f_creacion_inicio']."' AND '".$_GET['f_creacion_termino']."'";
}

$table_1 = 'bodegas_arriendos_facturacion';
$table_2 = 'bodegas_insumos_facturacion';
$table_3 = 'bodegas_productos_facturacion';
$table_4 = 'bodegas_servicios_facturacion';

$arrTipo1 = array();
$arrTipo2 = array();
$arrTipo3 = array();
$arrTipo4 = array();

$arrTipo1 = db_select_array (false, $table_1.'.idFacturacion,'.$table_1.'.Creacion_fecha,'.$table_1.'.Pago_fecha,'.$table_1.'.N_Doc,core_sistemas.Nombre AS Sistema,core_documentos_mercantiles.Nombre AS Documento,clientes_listado.Nombre AS Cliente,'.$table_1.'.MontoPagado,'.$table_1.'.ValorTotal', $table_1, 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = '.$table_1.'.idSistema LEFT JOIN `core_documentos_mercantiles` ON core_documentos_mercantiles.idDocumentos = '.$table_1.'.idDocumentos LEFT JOIN `clientes_listado` ON clientes_listado.idCliente = '.$table_1.'.idCliente', $z1, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrTipo1');
$arrTipo2 = db_select_array (false, $table_2.'.idFacturacion,'.$table_2.'.Creacion_fecha,'.$table_2.'.Pago_fecha,'.$table_2.'.N_Doc,core_sistemas.Nombre AS Sistema,core_documentos_mercantiles.Nombre AS Documento,clientes_listado.Nombre AS Cliente,'.$table_2.'.MontoPagado,'.$table_2.'.ValorTotal', $table_2, 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = '.$table_2.'.idSistema LEFT JOIN `core_documentos_mercantiles` ON core_documentos_mercantiles.idDocumentos = '.$table_2.'.idDocumentos LEFT JOIN `clientes_listado` ON clientes_listado.idCliente = '.$table_2.'.idCliente', $z2, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrTipo2');
$arrTipo3 = db_select_array (false, $table_3.'.idFacturacion,'.$table_3.'.Creacion_fecha,'.$table_3.'.Pago_fecha,'.$table_3.'.N_Doc,core_sistemas.Nombre AS Sistema,core_documentos_mercantiles.Nombre AS Documento,clientes_listado.Nombre AS Cliente,'.$table_3.'.MontoPagado,'.$table_3.'.ValorTotal', $table_3, 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = '.$table_3.'.idSistema LEFT JOIN `core_documentos_mercantiles` ON core_documentos_mercantiles.idDocumentos = '.$table_3.'.idDocumentos LEFT JOIN `clientes_listado` ON clientes_listado.idCliente = '.$table_3.'.idCliente', $z3, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrTipo3');
$arrTipo4 = db_select_array (false, $table_4.'.idFacturacion,'.$table_4.'.Creacion_fecha,'.$table_4.'.Pago_fecha,'.$table_4.'.N_Doc,core_sistemas.Nombre AS Sistema,core_documentos_mercantiles.Nombre AS Documento,clientes_listado.Nombre AS Cliente,'.$table_4.'.MontoPagado,'.$table_4.'.ValorTotal', $table_4, 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = '.$table_4.'.idSistema LEFT JOIN `core_documentos_mercantiles` ON core_documentos_mercantiles.idDocumentos = '.$table_4.'.idDocumentos LEFT JOIN `clientes_listado` ON clientes_listado.idCliente = '.$table_4.'.idCliente', $z4, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrTipo4');


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
            ->setCellValue('A1', 'Cliente')
            ->setCellValue('B1', 'Documento')
            ->setCellValue('C1', 'N° Documento')
            ->setCellValue('D1', 'Fecha de Ingreso')
            ->setCellValue('E1', 'Fecha de Pago')
            ->setCellValue('F1', 'Valor Total')
            ->setCellValue('G1', 'Monto Pagado');

           
$nn=2;

/********************************************************/
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, 'Arriendos');
$nn++;  
foreach ($arrTipo1 as $tipo) { 

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $tipo['Cliente'])
				->setCellValue('B'.$nn, $tipo['Documento'])
				->setCellValue('C'.$nn, $tipo['N_Doc'])
				->setCellValue('D'.$nn, Fecha_estandar($tipo['Creacion_fecha']))
				->setCellValue('E'.$nn, Fecha_estandar($tipo['Pago_fecha']))
				->setCellValue('F'.$nn, $tipo['ValorTotal'])
				->setCellValue('G'.$nn, $tipo['MontoPagado']);
	$nn++;           
   
} 
/********************************************************/
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, 'Insumos');
$nn++;  
foreach ($arrTipo2 as $tipo) { 

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $tipo['Cliente'])
				->setCellValue('B'.$nn, $tipo['Documento'])
				->setCellValue('C'.$nn, $tipo['N_Doc'])
				->setCellValue('D'.$nn, Fecha_estandar($tipo['Creacion_fecha']))
				->setCellValue('E'.$nn, Fecha_estandar($tipo['Pago_fecha']))
				->setCellValue('F'.$nn, $tipo['ValorTotal'])
				->setCellValue('G'.$nn, $tipo['MontoPagado']);
	$nn++;           
   
}
/********************************************************/
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, 'Productos');
$nn++;  
foreach ($arrTipo3 as $tipo) { 

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $tipo['Cliente'])
				->setCellValue('B'.$nn, $tipo['Documento'])
				->setCellValue('C'.$nn, $tipo['N_Doc'])
				->setCellValue('D'.$nn, Fecha_estandar($tipo['Creacion_fecha']))
				->setCellValue('E'.$nn, Fecha_estandar($tipo['Pago_fecha']))
				->setCellValue('F'.$nn, $tipo['ValorTotal'])
				->setCellValue('G'.$nn, $tipo['MontoPagado']);
	$nn++;           
   
}
/********************************************************/
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, 'Servicios');
$nn++;  
foreach ($arrTipo4 as $tipo) { 

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $tipo['Cliente'])
				->setCellValue('B'.$nn, $tipo['Documento'])
				->setCellValue('C'.$nn, $tipo['N_Doc'])
				->setCellValue('D'.$nn, Fecha_estandar($tipo['Creacion_fecha']))
				->setCellValue('E'.$nn, Fecha_estandar($tipo['Pago_fecha']))
				->setCellValue('F'.$nn, $tipo['ValorTotal'])
				->setCellValue('G'.$nn, $tipo['MontoPagado']);
	$nn++;           
   
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Listado de Documentos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Documentos Clientes con Pagos pendientes.xls"');
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
