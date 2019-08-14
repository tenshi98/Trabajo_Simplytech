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
$z1 = "WHERE bodegas_arriendos_facturacion.idTipo=2"; //solo ventas
$z2 = "WHERE bodegas_insumos_facturacion.idTipo=2";   //solo ventas
$z3 = "WHERE bodegas_productos_facturacion.idTipo=2"; //solo ventas
$z4 = "WHERE bodegas_servicios_facturacion.idTipo=2"; //solo ventas
//sololas del mismo sistema
$z1.=" AND bodegas_arriendos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
$z2.=" AND bodegas_insumos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
$z3.=" AND bodegas_productos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
$z4.=" AND bodegas_servicios_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";

if(isset($_GET['idTrabajador'])&&$_GET['idTrabajador']!=''){ 
	$z1.=" AND bodegas_arriendos_facturacion.idTrabajador={$_GET['idTrabajador']}";
	$z2.=" AND bodegas_insumos_facturacion.idTrabajador={$_GET['idTrabajador']}";
	$z3.=" AND bodegas_productos_facturacion.idTrabajador={$_GET['idTrabajador']}";
	$z4.=" AND bodegas_servicios_facturacion.idTrabajador={$_GET['idTrabajador']}";
}
if(isset($_GET['Creacion_ano'])&&$_GET['Creacion_ano']!=''){ 
	$z1.=" AND bodegas_arriendos_facturacion.Creacion_ano={$_GET['Creacion_ano']}";
	$z2.=" AND bodegas_insumos_facturacion.Creacion_ano={$_GET['Creacion_ano']}";
	$z3.=" AND bodegas_productos_facturacion.Creacion_ano={$_GET['Creacion_ano']}";
	$z4.=" AND bodegas_servicios_facturacion.Creacion_ano={$_GET['Creacion_ano']}";
}
	

			
		
				
/*************************************************************************************************/
//Bodega de Arriendos
$arrTemporal_1 = array();
$query = "SELECT 
bodegas_arriendos_facturacion.idTrabajador,
bodegas_arriendos_facturacion.Creacion_mes,
trabajadores_listado.Nombre AS TrabNombre,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
SUM(bodegas_arriendos_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_arriendos_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_arriendos_facturacion`
LEFT JOIN `trabajadores_listado`    ON trabajadores_listado.idTrabajador   = bodegas_arriendos_facturacion.idTrabajador
".$z1."
GROUP BY bodegas_arriendos_facturacion.idTrabajador, bodegas_arriendos_facturacion.Creacion_mes
ORDER BY bodegas_arriendos_facturacion.Creacion_mes DESC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTemporal_1,$row );
}
/*************************************************************************************************/
//Bodega de Insumos
$arrTemporal_2 = array();
$query = "SELECT 
bodegas_insumos_facturacion.idTrabajador,
bodegas_insumos_facturacion.Creacion_mes,
trabajadores_listado.Nombre AS TrabNombre,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
SUM(bodegas_insumos_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_insumos_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_insumos_facturacion`
LEFT JOIN `trabajadores_listado`    ON trabajadores_listado.idTrabajador   = bodegas_insumos_facturacion.idTrabajador
".$z2."
GROUP BY bodegas_insumos_facturacion.idTrabajador, bodegas_insumos_facturacion.Creacion_mes
ORDER BY bodegas_insumos_facturacion.Creacion_mes DESC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTemporal_2,$row );
}
/*************************************************************************************************/
//Bodega de Productos
$arrTemporal_3 = array();
$query = "SELECT 
bodegas_productos_facturacion.idTrabajador,
bodegas_productos_facturacion.Creacion_mes,
trabajadores_listado.Nombre AS TrabNombre,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
SUM(bodegas_productos_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_productos_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_productos_facturacion`
LEFT JOIN `trabajadores_listado`    ON trabajadores_listado.idTrabajador   = bodegas_productos_facturacion.idTrabajador
".$z3."
GROUP BY bodegas_productos_facturacion.idTrabajador, bodegas_productos_facturacion.Creacion_mes
ORDER BY bodegas_productos_facturacion.Creacion_mes DESC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTemporal_3,$row );
}
/*************************************************************************************************/
//Bodega de Servicios
$arrTemporal_4 = array();
$query = "SELECT 
bodegas_servicios_facturacion.idTrabajador,
bodegas_servicios_facturacion.Creacion_mes,
trabajadores_listado.Nombre AS TrabNombre,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
SUM(bodegas_servicios_facturacion.ValorNetoImp) AS ValorNeto,
SUM(bodegas_servicios_facturacion.ValorTotal) AS ValorTotal

FROM `bodegas_servicios_facturacion`
LEFT JOIN `trabajadores_listado`    ON trabajadores_listado.idTrabajador   = bodegas_servicios_facturacion.idTrabajador
".$z4."
GROUP BY bodegas_servicios_facturacion.idTrabajador, bodegas_servicios_facturacion.Creacion_mes
ORDER BY bodegas_servicios_facturacion.Creacion_mes DESC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTemporal_4,$row );
}
/*************************************************************************************************/
//Se crea arreglo
$arrCreativo = array();
foreach ($arrTemporal_1 as $temp) {
	$arrCreativo[$temp['idTrabajador']][0]['Trabajador']                          = $temp['TrabNombre'].' '.$temp['TrabApellidoPat'].' '.$temp['TrabApellidoMat'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['idTrabajador']    = $temp['idTrabajador'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Creacion_mes']    = $temp['Creacion_mes'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Neto_1']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Total_1']         = $temp['ValorTotal'];
}
foreach ($arrTemporal_2 as $temp) {
	$arrCreativo[$temp['idTrabajador']][0]['Trabajador']                          = $temp['TrabNombre'].' '.$temp['TrabApellidoPat'].' '.$temp['TrabApellidoMat'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['idTrabajador']    = $temp['idTrabajador'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Creacion_mes']    = $temp['Creacion_mes'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Neto_2']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Total_2']         = $temp['ValorTotal'];
}
foreach ($arrTemporal_3 as $temp) {
	$arrCreativo[$temp['idTrabajador']][0]['Trabajador']                          = $temp['TrabNombre'].' '.$temp['TrabApellidoPat'].' '.$temp['TrabApellidoMat'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['idTrabajador']    = $temp['idTrabajador'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Creacion_mes']    = $temp['Creacion_mes'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Neto_3']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Total_3']         = $temp['ValorTotal'];
}
foreach ($arrTemporal_4 as $temp) {
	$arrCreativo[$temp['idTrabajador']][0]['Trabajador']                          = $temp['TrabNombre'].' '.$temp['TrabApellidoPat'].' '.$temp['TrabApellidoMat'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['idTrabajador']    = $temp['idTrabajador'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Creacion_mes']    = $temp['Creacion_mes'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Neto_4']          = $temp['ValorNeto'];
	$arrCreativo[$temp['idTrabajador']][$temp['Creacion_mes']]['Total_4']         = $temp['ValorTotal'];
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
            ->setCellValue('A2', 'Trabajador')
            ->setCellValue('B2', 'Mes')
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
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$nn, $datais[0]['Trabajador']);
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
		
		if(isset($prod['Creacion_mes'])&&$prod['Creacion_mes']!=''&&$prod['Creacion_mes']!=0){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$nn, '')
						->setCellValue('B'.$nn, numero_a_mes($prod['Creacion_mes']))
						->setCellValue('C'.$nn, cantidades_excel($prod['Neto_1']))
						->setCellValue('D'.$nn, cantidades_excel($prod['Neto_2']))
						->setCellValue('E'.$nn, cantidades_excel($prod['Neto_3']))
						->setCellValue('F'.$nn, cantidades_excel($prod['Neto_4']))
						->setCellValue('G'.$nn, cantidades_excel($sub_1))
						->setCellValue('H'.$nn, cantidades_excel($prod['Total_1']))
						->setCellValue('I'.$nn, cantidades_excel($prod['Total_2']))
						->setCellValue('J'.$nn, cantidades_excel($prod['Total_3']))
						->setCellValue('K'.$nn, cantidades_excel($prod['Total_4']))
						->setCellValue('L'.$nn, cantidades_excel($sub_2));
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
$objPHPExcel->getActiveSheet()->setTitle('Ventas Vendedores por mes');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Ventas Vendedores por mes Resumen.xls"');
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
