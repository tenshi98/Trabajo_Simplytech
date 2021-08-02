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
//Solo compras pagadas totalmente
$z1 = "WHERE bodegas_arriendos_facturacion.idTipo=1"; //solo ventas
$z2 = "WHERE bodegas_insumos_facturacion.idTipo=1";   //solo ventas
$z3 = "WHERE bodegas_productos_facturacion.idTipo=1"; //solo ventas
$z4 = "WHERE bodegas_servicios_facturacion.idTipo=1"; //solo ventas
//sololas del mismo sistema
$z1.=" AND bodegas_arriendos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z2.=" AND bodegas_insumos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z3.=" AND bodegas_productos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$z4.=" AND bodegas_servicios_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];

if(isset($_GET['idProveedor'])&&$_GET['idProveedor']!=''){ 
	$z1.=" AND bodegas_arriendos_facturacion.idProveedor=".$_GET['idProveedor'];
	$z2.=" AND bodegas_insumos_facturacion.idProveedor=".$_GET['idProveedor'];
	$z3.=" AND bodegas_productos_facturacion.idProveedor=".$_GET['idProveedor'];
	$z4.=" AND bodegas_servicios_facturacion.idProveedor=".$_GET['idProveedor'];
}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){ 
	$z1.=" AND bodegas_arriendos_facturacion.idEstado=".$_GET['idEstado'];
	$z2.=" AND bodegas_insumos_facturacion.idEstado=".$_GET['idEstado'];
	$z3.=" AND bodegas_productos_facturacion.idEstado=".$_GET['idEstado'];
	$z4.=" AND bodegas_servicios_facturacion.idEstado=".$_GET['idEstado'];
}
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){ 
	$z1.=" AND bodegas_arriendos_facturacion.Creacion_fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
	$z2.=" AND bodegas_insumos_facturacion.Creacion_fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
	$z3.=" AND bodegas_productos_facturacion.Creacion_fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
	$z4.=" AND bodegas_servicios_facturacion.Creacion_fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
	

			
		
				
/*************************************************************************************************/
//Bodega de Arriendos
$arrTemporal_1 = array();
$query = "SELECT 
bodegas_arriendos_facturacion.idProveedor,
bodegas_arriendos_facturacion.Creacion_Semana,
proveedor_listado.Nombre AS ProveedorNombre,
SUM(bodegas_arriendos_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_arriendos_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_arriendos_facturacion`
LEFT JOIN `proveedor_listado`    ON proveedor_listado.idProveedor   = bodegas_arriendos_facturacion.idProveedor
".$z1."
GROUP BY bodegas_arriendos_facturacion.idProveedor, bodegas_arriendos_facturacion.Creacion_Semana
ORDER BY bodegas_arriendos_facturacion.Creacion_Semana DESC";
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
array_push( $arrTemporal_1,$row );
}
/*************************************************************************************************/
//Bodega de Insumos
$arrTemporal_2 = array();
$query = "SELECT 
bodegas_insumos_facturacion.idProveedor,
bodegas_insumos_facturacion.Creacion_Semana,
proveedor_listado.Nombre AS ProveedorNombre,
SUM(bodegas_insumos_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_insumos_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_insumos_facturacion`
LEFT JOIN `proveedor_listado`    ON proveedor_listado.idProveedor   = bodegas_insumos_facturacion.idProveedor
".$z2."
GROUP BY bodegas_insumos_facturacion.idProveedor, bodegas_insumos_facturacion.Creacion_Semana
ORDER BY bodegas_insumos_facturacion.Creacion_Semana DESC";
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
array_push( $arrTemporal_2,$row );
}
/*************************************************************************************************/
//Bodega de Productos
$arrTemporal_3 = array();
$query = "SELECT 
bodegas_productos_facturacion.idProveedor,
bodegas_productos_facturacion.Creacion_Semana,
proveedor_listado.Nombre AS ProveedorNombre,
SUM(bodegas_productos_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_productos_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_productos_facturacion`
LEFT JOIN `proveedor_listado`    ON proveedor_listado.idProveedor   = bodegas_productos_facturacion.idProveedor
".$z3."
GROUP BY bodegas_productos_facturacion.idProveedor, bodegas_productos_facturacion.Creacion_Semana
ORDER BY bodegas_productos_facturacion.Creacion_Semana DESC";
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
array_push( $arrTemporal_3,$row );
}
/*************************************************************************************************/
//Bodega de Servicios
$arrTemporal_4 = array();
$query = "SELECT 
bodegas_servicios_facturacion.idProveedor,
bodegas_servicios_facturacion.Creacion_Semana,
proveedor_listado.Nombre AS ProveedorNombre,
SUM(bodegas_servicios_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_servicios_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_servicios_facturacion`
LEFT JOIN `proveedor_listado`    ON proveedor_listado.idProveedor   = bodegas_servicios_facturacion.idProveedor
".$z4."
GROUP BY bodegas_servicios_facturacion.idProveedor, bodegas_servicios_facturacion.Creacion_Semana
ORDER BY bodegas_servicios_facturacion.Creacion_Semana DESC";
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
array_push( $arrTemporal_4,$row );
}
/*************************************************************************************************/
//Se crea arreglo
$arrCreativo = array();
foreach ($arrTemporal_1 as $temp) {
	$arrCreativo[$temp['idProveedor']][0]['Proveedor']                                = $temp['ProveedorNombre'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['idProveedor']       = $temp['idProveedor'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Creacion_Semana'] = $temp['Creacion_Semana'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Neto_1']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Total_1']         = $temp['ValorTotal'];
}
foreach ($arrTemporal_2 as $temp) {
	$arrCreativo[$temp['idProveedor']][0]['Proveedor']                                = $temp['ProveedorNombre'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['idProveedor']       = $temp['idProveedor'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Creacion_Semana'] = $temp['Creacion_Semana'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Neto_2']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Total_2']         = $temp['ValorTotal'];
}
foreach ($arrTemporal_3 as $temp) {
	$arrCreativo[$temp['idProveedor']][0]['Proveedor']                                = $temp['ProveedorNombre'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['idProveedor']       = $temp['idProveedor'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Creacion_Semana'] = $temp['Creacion_Semana'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Neto_3']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Total_3']         = $temp['ValorTotal'];
}
foreach ($arrTemporal_4 as $temp) {
	$arrCreativo[$temp['idProveedor']][0]['Proveedor']                                = $temp['ProveedorNombre'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['idProveedor']       = $temp['idProveedor'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Creacion_Semana'] = $temp['Creacion_Semana'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Neto_4']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idProveedor']][$temp['Creacion_Semana']]['Total_4']         = $temp['ValorTotal'];
}
/*************************************************************************************************/

//Variables
$Neto_1 = 0;
$Neto_2 = 0;
$Neto_3 = 0;
$Neto_4 = 0;

$Total_1 = 0;
$Total_2 = 0;
$Total_3 = 0;
$Total_4 = 0;

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
            ->setCellValue('A1', '')
            ->setCellValue('B1', '')
            ->setCellValue('C1', 'Netos')
            ->setCellValue('H1', 'Totales');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Proveedor')
            ->setCellValue('B2', 'Semana')
            ->setCellValue('C2', 'Arriendos')
            ->setCellValue('D2', 'Insumos')
            ->setCellValue('E2', 'Productos')
            ->setCellValue('F2', 'Servicios')
            ->setCellValue('G2', 'Subtotal')
            ->setCellValue('H2', 'Arriendos')
            ->setCellValue('I2', 'Insumos')
            ->setCellValue('J2', 'Productos')
            ->setCellValue('K2', 'Servicios')
            ->setCellValue('L2', 'Subtotal');

						
            
$nn=3;
foreach ($arrCreativo as $datais) {
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$nn, $datais[0]['Proveedor']);
	$nn++;
	
	foreach ($datais as $prod) {
		
		// subtotales Netos
		$sub_1 = 0;
		if(isset($prod['Neto_1'])){$sub_1 = $sub_1 + $prod['Neto_1'];}
		if(isset($prod['Neto_2'])){$sub_1 = $sub_1 + $prod['Neto_2'];}
		if(isset($prod['Neto_3'])){$sub_1 = $sub_1 + $prod['Neto_3'];}
		if(isset($prod['Neto_4'])){$sub_1 = $sub_1 + $prod['Neto_4'];}
		
									
		// subtotales Totales
		$sub_2 = 0;
		if(isset($prod['Total_1'])){$sub_2 = $sub_2 + $prod['Total_1'];}
		if(isset($prod['Total_2'])){$sub_2 = $sub_2 + $prod['Total_2'];}
		if(isset($prod['Total_3'])){$sub_2 = $sub_2 + $prod['Total_3'];}
		if(isset($prod['Total_4'])){$sub_2 = $sub_2 + $prod['Total_4'];}
	
		if(isset($prod['Creacion_Semana'])&&$prod['Creacion_Semana']!=''&&$prod['Creacion_Semana']!=0){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$nn, '')
						->setCellValue('B'.$nn, $prod['Creacion_Semana'])
						->setCellValue('C'.$nn, cantidades_excel($prod['Neto_1']))
						->setCellValue('D'.$nn, cantidades_excel($prod['Neto_2']))
						->setCellValue('E'.$nn, cantidades_excel($prod['Neto_3']))
						->setCellValue('F'.$nn, cantidades_excel($prod['Neto_4']))
						->setCellValue('G'.$nn, cantidades_excel($sub_1))
						->setCellValue('H'.$nn, cantidades_excel($prod['Total_1']))
						->setCellValue('I'.$nn, cantidades_excel($prod['Total_2']))
						->setCellValue('J'.$nn, cantidades_excel($prod['Total_3']))
						->setCellValue('K'.$nn, cantidades_excel($prod['Total_4']))
						->setCellValue('L'.$nn, cantidades_excel($sub_1));
			$nn++;
			//Suma de variables
			$Neto_1 = $Neto_1 + $prod['Neto_1']; 
			$Neto_2 = $Neto_2 + $prod['Neto_2'];
			$Neto_3 = $Neto_3 + $prod['Neto_3'];
			$Neto_4 = $Neto_4 + $prod['Neto_4'];
			$Total_1 = $Total_1 + $prod['Total_1'];
			$Total_2 = $Total_2 + $prod['Total_2'];
			$Total_3 = $Total_3 + $prod['Total_3'];
			$Total_4 = $Total_4 + $prod['Total_4']; 
		}          
	}  
} 
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$nn, '')
			->setCellValue('B'.$nn, 'Totales')
			->setCellValue('C'.$nn, cantidades_excel($Neto_1))
			->setCellValue('D'.$nn, cantidades_excel($Neto_2))
			->setCellValue('E'.$nn, cantidades_excel($Neto_3))
			->setCellValue('F'.$nn, cantidades_excel($Neto_4))
			->setCellValue('G'.$nn, cantidades_excel($Neto_1+$Neto_2+$Neto_3+$Neto_4))
			->setCellValue('H'.$nn, cantidades_excel($Total_1))
			->setCellValue('I'.$nn, cantidades_excel($Total_2))
			->setCellValue('J'.$nn, cantidades_excel($Total_3))
			->setCellValue('K'.$nn, cantidades_excel($Total_4))
			->setCellValue('L'.$nn, cantidades_excel($Total_1+$Total_2+$Total_3+$Total_4));


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Compras Proveedor por semana');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Compras Proveedor por semana.xls"');
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
