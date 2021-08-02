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


//Variable de busqueda
$z      = "WHERE aguas_facturacion_listado_detalle.idFacturacionDetalle!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){                $z .= " AND aguas_facturacion_listado_detalle.Ano=".$_GET['Ano'];}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){            $z .= " AND aguas_facturacion_listado_detalle.idMes=".$_GET['idMes'];}
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){    $z .= " AND aguas_facturacion_listado_detalle.idCliente=".$_GET['idCliente'];}

//obtengo las facturaciones 
$arrConsumos = array();
$query = "SELECT 
aguas_facturacion_listado_detalle.Ano, 
aguas_facturacion_listado_detalle.DetalleConsumoCantidad, 
aguas_facturacion_listado_detalle.DetalleRecoleccionCantidad,
core_tiempo_meses.Nombre AS Mes,
aguas_clientes_listado.Identificador AS ClienteIdentificador,
aguas_clientes_listado.Nombre AS ClienteNombre

FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `core_tiempo_meses`        ON core_tiempo_meses.idMes            = aguas_facturacion_listado_detalle.idMes
LEFT JOIN `aguas_clientes_listado`   ON aguas_clientes_listado.idCliente   = aguas_facturacion_listado_detalle.idCliente
".$z."
ORDER BY aguas_clientes_listado.Identificador ASC, aguas_facturacion_listado_detalle.Ano ASC, aguas_facturacion_listado_detalle.idMes ASC
";
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
array_push( $arrConsumos,$row );
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
	
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $fact['ClienteIdentificador'])
				->setCellValue('B'.$nn, $fact['ClienteNombre'])
				->setCellValue('C'.$nn, $fact['Ano'])
				->setCellValue('D'.$nn, $fact['Mes'])
				->setCellValue('E'.$nn, $fact['DetalleConsumoCantidad'])
				->setCellValue('F'.$nn, $fact['DetalleRecoleccionCantidad']);
														
	$nn++;
}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Consumo Historico');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Consumo Historico.xls"');
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
