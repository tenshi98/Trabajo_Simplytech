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
$query = "SELECT Nombre	
FROM `core_sistemas` 
WHERE idSistema = '{$_GET['idSistema']}'  ";
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
$rowEmpresa = mysqli_fetch_array ($resultado);

// Se trae un listado con todos los datos
$arrProductos = array();
$query = "SELECT 
bodegas_insumos_facturacion_existencias.idFacturacion,
bodegas_insumos_facturacion_existencias.Creacion_fecha,
bodegas_insumos_facturacion_existencias.Cantidad_ing,
bodegas_insumos_facturacion_existencias.Cantidad_eg,
bodegas_insumos_facturacion_tipo.Nombre AS TipoMovimiento,
insumos_listado.Nombre AS NombreProducto,
sistema_productos_uml.Nombre AS UnidadMedida,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_insumos_facturacion.N_Doc AS N_Doc,
trabajadores_listado.Nombre AS trab_nombre,
trabajadores_listado.ApellidoPat AS trab_appat,
trabajadores_listado.ApellidoMat AS trab_apmat,
proveedor_listado.Nombre AS Proveedor,
(SELECT Nombre FROM bodegas_insumos_listado WHERE idBodega={$_GET['idBodega']} LIMIT 1) AS NombreBodega

FROM `bodegas_insumos_facturacion_existencias`
LEFT JOIN `bodegas_insumos_facturacion_tipo`    ON bodegas_insumos_facturacion_tipo.idTipo       = bodegas_insumos_facturacion_existencias.idTipo
LEFT JOIN `insumos_listado`                     ON insumos_listado.idProducto                    = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`                         ON sistema_productos_uml.idUml                             = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_facturacion`         ON bodegas_insumos_facturacion.idFacturacion     = bodegas_insumos_facturacion_existencias.idFacturacion
LEFT JOIN `core_documentos_mercantiles`      ON core_documentos_mercantiles.idDocumentos   = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`                   ON proveedor_listado.idProveedor                 = bodegas_insumos_facturacion.idProveedor
LEFT JOIN `trabajadores_listado`                ON trabajadores_listado.idTrabajador             = bodegas_insumos_facturacion.idTrabajador

WHERE bodegas_insumos_facturacion_existencias.idProducto={$_GET['view']}  
AND bodegas_insumos_facturacion_existencias.idBodega={$_GET['idBodega']}
ORDER BY bodegas_insumos_facturacion_existencias.Creacion_fecha DESC 
LIMIT 100";
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
array_push( $arrProductos,$row );
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
            ->setCellValue('A1', 'Bodega: '.$arrProductos[0]['NombreBodega']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Producto: '.$arrProductos[0]['NombreProducto']);
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Ultimos 100 Registros');            
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Movimiento')
            ->setCellValue('B5', 'Proveedor/Cliente')
            ->setCellValue('C5', 'Documento')
            ->setCellValue('D5', 'Fecha')
            ->setCellValue('E5', 'Cant Ing')
            ->setCellValue('F5', 'Cant eg')
            ->setCellValue('G5', 'Unidad de Medida');
            
$nn=6;
foreach ($arrProductos as $productos) { 
if(isset($productos['Proveedor'])&&$productos['Proveedor']){
	$empresa = 'Proveedor : '.$productos['Proveedor'];
	$ndoc = $productos['Documento'].' N° '.$productos['N_Doc'];
}else{
	$empresa = 'Trabajador : '.$productos['trab_nombre'].' '.$productos['trab_appat'].' '.$productos['trab_apmat'];
	$ndoc = 'Documento N° '.$productos['idFacturacion'];
}
							
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, $productos['TipoMovimiento'])
            ->setCellValue('B'.$nn, $empresa)
            ->setCellValue('C'.$nn, $ndoc)
            ->setCellValue('D'.$nn, Fecha_estandar($productos['Creacion_fecha']))
            ->setCellValue('E'.$nn, cantidades_excel($productos['Cantidad_ing']))
            ->setCellValue('F'.$nn, cantidades_excel($productos['Cantidad_eg']))
            ->setCellValue('G'.$nn, $productos['UnidadMedida']);
 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle(cortar('Bodega '.$arrProductos[0]['NombreBodega'], 25));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Movimiento Producto '.$arrProductos[0]['NombreProducto'].' Bodega '.$arrProductos[0]['NombreBodega'].' ultimos 100 registros.xls"');
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
