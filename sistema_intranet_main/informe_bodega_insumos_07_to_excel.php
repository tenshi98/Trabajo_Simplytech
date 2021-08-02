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
//Variables
$año_pasado = ano_actual()-1;

/****************************************************/
//Nombre de la bodega
$query = "SELECT Nombre
FROM `bodegas_insumos_listado`
WHERE idBodega=".$_GET['idBodegaOrigen'];
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
$rowBodega = mysqli_fetch_assoc ($resultado);
/****************************************************/
$arrCategoria = array();
$query = "SELECT idCategoria, Nombre
FROM `sistema_productos_categorias`";
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
array_push( $arrCategoria,$row );
}
/****************************************************/
$arrBodega = array();
$query = "SELECT idBodega, Nombre
FROM `bodegas_insumos_listado`";
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
array_push( $arrBodega,$row );
}
// Se trae un listado con los valores de las existencias actuales	
$año_pasado = ano_actual()-1;
$z = "WHERE bodegas_insumos_facturacion_existencias.idSistema='".$_SESSION['usuario']['basic_data']['idSistema']."'";
$z.= " AND bodegas_insumos_facturacion_existencias.Creacion_ano >= ".$año_pasado;

$z.= " AND bodegas_insumos_facturacion_existencias.idTipo = 6";
$z.= " AND bodegas_insumos_facturacion_existencias.idBodega = ".$_GET['idBodegaOrigen'];
//Verificar si es por concepto de ingreso o egreso de bodega
//Egreso
$z.= " AND bodegas_insumos_facturacion_existencias.Cantidad_ing=0 AND bodegas_insumos_facturacion_existencias.Cantidad_eg!=0";

/****************************************************/
//se consulta
$arrExistenciasMain = array();
$query = "SELECT 
bodegas_insumos_facturacion_existencias.Creacion_ano,
bodegas_insumos_facturacion_existencias.Creacion_mes,
SUM(bodegas_insumos_facturacion_existencias.ValorTotal) AS Valor,
insumos_listado.idCategoria

FROM `bodegas_insumos_facturacion_existencias`
LEFT JOIN `insumos_listado` ON insumos_listado.idProducto = bodegas_insumos_facturacion_existencias.idProducto
".$z."
GROUP BY bodegas_insumos_facturacion_existencias.Creacion_ano,
bodegas_insumos_facturacion_existencias.Creacion_mes,
insumos_listado.idCategoria

ORDER BY bodegas_insumos_facturacion_existencias.Creacion_ano ASC, 
bodegas_insumos_facturacion_existencias.Creacion_mes ASC,
insumos_listado.idCategoria ASC
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
array_push( $arrExistenciasMain,$row );
}

/****************************************************/
$mes = array();
foreach ($arrExistenciasMain as $existencias) { 
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']] = 0;}
	
	$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']] + $existencias['Valor'];									
}
								
/****************************************************/
$xmes = mes_actual();
$xaño = ano_actual();
$graficoMain = array();
for ($xcontador = 12; $xcontador > 0; $xcontador--) {
									
	if($xmes>0){
		$graficoMain[$xcontador]['mes'] = $xmes;
		$graficoMain[$xcontador]['año'] = $xaño;
		
		foreach ($arrCategoria as $cat) { 
			if(isset($mes[$xaño][$xmes][$cat['idCategoria']])){ $graficoMain[$xcontador][$cat['idCategoria']] = $mes[$xaño][$xmes][$cat['idCategoria']]; }else{$graficoMain[$xcontador][$cat['idCategoria']] = 0;};
		}
									
	}else{
		$xmes = 12;
		$xaño = $xaño-1;
		$graficoMain[$xcontador]['mes'] = $xmes;
		$graficoMain[$xcontador]['año'] = $xaño;
		
		foreach ($arrCategoria as $cat) { 
			if(isset($mes[$xaño][$xmes][$cat['idCategoria']])){ $graficoMain[$xcontador][$cat['idCategoria']] = $mes[$xaño][$xmes][$cat['idCategoria']]; }else{$graficoMain[$xcontador][$cat['idCategoria']] = 0;};
		}	
	}
	$xmes = $xmes-1;								
}

/****************************************************************************************/
// Se trae un listado con los valores de las existencias actuales	
$z = "WHERE bodegas_insumos_facturacion_existencias.idTipo = 6";
$z.= " AND bodegas_insumos_facturacion_existencias.Creacion_ano >= ".$año_pasado;
$z.= " AND bodegas_insumos_facturacion.idBodegaOrigen = ".$_GET['idBodegaOrigen'];
$z.= " AND bodegas_insumos_facturacion.idBodegaDestino != ".$_GET['idBodegaOrigen'];
//Verificar si es por concepto de ingreso o egreso de bodega
//Ingreso
$z.= " AND bodegas_insumos_facturacion_existencias.Cantidad_ing!=0 AND bodegas_insumos_facturacion_existencias.Cantidad_eg=0";

/****************************************************/
//se consulta
$arrExistencias = array();
$query = "SELECT 
bodegas_insumos_facturacion_existencias.Creacion_ano,
bodegas_insumos_facturacion_existencias.Creacion_mes,
SUM(bodegas_insumos_facturacion_existencias.ValorTotal) AS Valor,
insumos_listado.idCategoria,
bodegas_insumos_facturacion.idBodegaDestino AS BodegaID,
bodegas_insumos_listado.Nombre AS BodegaNombre

FROM `bodegas_insumos_facturacion_existencias`
LEFT JOIN `insumos_listado`              ON insumos_listado.idProducto                 = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `bodegas_insumos_facturacion`  ON bodegas_insumos_facturacion.idFacturacion  = bodegas_insumos_facturacion_existencias.idFacturacion
LEFT JOIN `bodegas_insumos_listado`      ON bodegas_insumos_listado.idBodega           = bodegas_insumos_facturacion.idBodegaDestino
".$z."
GROUP BY bodegas_insumos_facturacion.idBodegaDestino,
bodegas_insumos_facturacion_existencias.Creacion_ano,
bodegas_insumos_facturacion_existencias.Creacion_mes,
insumos_listado.idCategoria

ORDER BY bodegas_insumos_facturacion.idBodegaDestino ASC,
bodegas_insumos_facturacion_existencias.Creacion_ano ASC, 
bodegas_insumos_facturacion_existencias.Creacion_mes ASC,
insumos_listado.idCategoria ASC
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
array_push( $arrExistencias,$row );
}

/****************************************************/
$mes = array();
foreach ($arrExistencias as $existencias) { 
	if(!isset($mes[$existencias['BodegaID']][$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']])){ $mes[$existencias['BodegaID']][$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']] = 0;}
	
	$mes[$existencias['BodegaID']][$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']] = $mes[$existencias['BodegaID']][$existencias['Creacion_ano']][$existencias['Creacion_mes']][$existencias['idCategoria']] + $existencias['Valor'];									
}
								
/****************************************************/
$grafico = array();
foreach ($arrBodega as $bod) {
	$xmes = mes_actual();
	$xaño = ano_actual();

	for ($xcontador = 12; $xcontador > 0; $xcontador--) {
										
		if($xmes>0){
			$grafico[$bod['idBodega']][$xcontador]['mes'] = $xmes;
			$grafico[$bod['idBodega']][$xcontador]['año'] = $xaño;

			foreach ($arrCategoria as $cat) { 
				if(isset($mes[$bod['idBodega']][$xaño][$xmes][$cat['idCategoria']])){ $grafico[$bod['idBodega']][$xcontador][$cat['idCategoria']] = $mes[$bod['idBodega']][$xaño][$xmes][$cat['idCategoria']]; }else{$grafico[$bod['idBodega']][$xcontador][$cat['idCategoria']] = 0;};
			}
										
		}else{
			$xmes = 12;
			$xaño = $xaño-1;
			$grafico[$bod['idBodega']][$xcontador]['mes'] = $xmes;
			$grafico[$bod['idBodega']][$xcontador]['año'] = $xaño;
			
			foreach ($arrCategoria as $cat) { 
				if(isset($mes[$bod['idBodega']][$xaño][$xmes][$cat['idCategoria']])){ $grafico[$bod['idBodega']][$xcontador][$cat['idCategoria']] = $mes[$bod['idBodega']][$xaño][$xmes][$cat['idCategoria']]; }else{$grafico[$bod['idBodega']][$xcontador][$cat['idCategoria']] = 0;};
			}	
		}
		$xmes = $xmes-1;								
	}
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



            
//Numero de hoja
$sheet = 0;
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex($sheet)
            ->setCellValue('A1', $x_column_producto_cat_sing)
			->setCellValue('B1', numero_a_mes_corto($graficoMain[1]['mes']))
			->setCellValue('C1', numero_a_mes_corto($graficoMain[2]['mes']))
			->setCellValue('D1', numero_a_mes_corto($graficoMain[3]['mes']))
			->setCellValue('E1', numero_a_mes_corto($graficoMain[4]['mes']))
			->setCellValue('F1', numero_a_mes_corto($graficoMain[5]['mes']))
			->setCellValue('G1', numero_a_mes_corto($graficoMain[6]['mes']))
			->setCellValue('H1', numero_a_mes_corto($graficoMain[7]['mes']))
			->setCellValue('I1', numero_a_mes_corto($graficoMain[8]['mes']))
			->setCellValue('J1', numero_a_mes_corto($graficoMain[9]['mes']))
			->setCellValue('K1', numero_a_mes_corto($graficoMain[10]['mes']))
			->setCellValue('L1', numero_a_mes_corto($graficoMain[11]['mes']))
			->setCellValue('M1', numero_a_mes_corto($graficoMain[12]['mes']))
			->setCellValue('N1', 'SubTotal');
            
$nn=2;
//Variables
$Total        = 0;
$SubTotal_1   = 0;
$SubTotal_2   = 0;
$SubTotal_3   = 0;
$SubTotal_4   = 0;
$SubTotal_5   = 0;
$SubTotal_6   = 0;
$SubTotal_7   = 0;
$SubTotal_8   = 0;
$SubTotal_9   = 0;
$SubTotal_10  = 0;
$SubTotal_11  = 0;
$SubTotal_12  = 0;
								
foreach ($arrCategoria as $cat) {
	 
	$SubTotalGen = 0;

	$SubTotalGen = $SubTotalGen+$graficoMain[1][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[2][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[3][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[4][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[5][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[6][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[7][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[8][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[9][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[10][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[11][$cat['idCategoria']]; 
	$SubTotalGen = $SubTotalGen+$graficoMain[12][$cat['idCategoria']]; 

	$SubTotal_1   = $SubTotal_1+$graficoMain[1][$cat['idCategoria']];
	$SubTotal_2   = $SubTotal_2+$graficoMain[2][$cat['idCategoria']];
	$SubTotal_3   = $SubTotal_3+$graficoMain[3][$cat['idCategoria']];
	$SubTotal_4   = $SubTotal_4+$graficoMain[4][$cat['idCategoria']];
	$SubTotal_5   = $SubTotal_5+$graficoMain[5][$cat['idCategoria']];
	$SubTotal_6   = $SubTotal_6+$graficoMain[6][$cat['idCategoria']];
	$SubTotal_7   = $SubTotal_7+$graficoMain[7][$cat['idCategoria']];
	$SubTotal_8   = $SubTotal_8+$graficoMain[8][$cat['idCategoria']];
	$SubTotal_9   = $SubTotal_9+$graficoMain[9][$cat['idCategoria']];
	$SubTotal_10  = $SubTotal_10+$graficoMain[10][$cat['idCategoria']];
	$SubTotal_11  = $SubTotal_11+$graficoMain[11][$cat['idCategoria']];
	$SubTotal_12  = $SubTotal_12+$graficoMain[12][$cat['idCategoria']];

	$Total = $Total + $SubTotalGen;
	
	if($SubTotalGen!=0){

		$objPHPExcel->setActiveSheetIndex($sheet)
					->setCellValue('A'.$nn, $cat['Nombre'])
					->setCellValue('B'.$nn, $graficoMain[1][$cat['idCategoria']])
					->setCellValue('C'.$nn, $graficoMain[2][$cat['idCategoria']])
					->setCellValue('D'.$nn, $graficoMain[3][$cat['idCategoria']])
					->setCellValue('E'.$nn, $graficoMain[4][$cat['idCategoria']])
					->setCellValue('F'.$nn, $graficoMain[5][$cat['idCategoria']])
					->setCellValue('G'.$nn, $graficoMain[6][$cat['idCategoria']])
					->setCellValue('H'.$nn, $graficoMain[7][$cat['idCategoria']])
					->setCellValue('I'.$nn, $graficoMain[8][$cat['idCategoria']])
					->setCellValue('J'.$nn, $graficoMain[9][$cat['idCategoria']])
					->setCellValue('K'.$nn, $graficoMain[10][$cat['idCategoria']])
					->setCellValue('L'.$nn, $graficoMain[11][$cat['idCategoria']])
					->setCellValue('M'.$nn, $graficoMain[12][$cat['idCategoria']])
					->setCellValue('N'.$nn, $SubTotalGen);
		$nn++; 
	}          
   
} 

$objPHPExcel->setActiveSheetIndex($sheet)
			->setCellValue('A'.$nn, 'Totales')
			->setCellValue('B'.$nn, $SubTotal_1)
			->setCellValue('C'.$nn, $SubTotal_2)
			->setCellValue('D'.$nn, $SubTotal_3)
			->setCellValue('E'.$nn, $SubTotal_4)
			->setCellValue('F'.$nn, $SubTotal_5)
			->setCellValue('G'.$nn, $SubTotal_6)
			->setCellValue('H'.$nn, $SubTotal_7)
			->setCellValue('I'.$nn, $SubTotal_8)
			->setCellValue('J'.$nn, $SubTotal_9)
			->setCellValue('K'.$nn, $SubTotal_10)
			->setCellValue('L'.$nn, $SubTotal_11)
			->setCellValue('M'.$nn, $SubTotal_12)
			->setCellValue('N'.$nn, $Total);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle(cortar('Egresos de '.$rowBodega['Nombre'], 25));


$sheet++;
filtrar($arrExistencias, 'BodegaNombre');
foreach($arrExistencias as $empresa=>$datos) {
	
	//Se crea nueva hoja
	$objPHPExcel->createSheet();
		
	//Titulo columnas
	$objPHPExcel->setActiveSheetIndex($sheet)
				->setCellValue('A1', $x_column_producto_cat_sing)
				->setCellValue('B1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][1]['mes']))
				->setCellValue('C1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][2]['mes']))
				->setCellValue('D1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][3]['mes']))
				->setCellValue('E1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][4]['mes']))
				->setCellValue('F1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][5]['mes']))
				->setCellValue('G1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][6]['mes']))
				->setCellValue('H1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][7]['mes']))
				->setCellValue('I1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][8]['mes']))
				->setCellValue('J1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][9]['mes']))
				->setCellValue('K1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][10]['mes']))
				->setCellValue('L1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][11]['mes']))
				->setCellValue('M1', numero_a_mes_corto($grafico[$datos[0]['BodegaID']][12]['mes']))
				->setCellValue('N1', 'SubTotal');
				
				
	$nn=2;
	//Variables
	$Total        = 0;
	$SubTotal_1   = 0;
	$SubTotal_2   = 0;
	$SubTotal_3   = 0;
	$SubTotal_4   = 0;
	$SubTotal_5   = 0;
	$SubTotal_6   = 0;
	$SubTotal_7   = 0;
	$SubTotal_8   = 0;
	$SubTotal_9   = 0;
	$SubTotal_10  = 0;
	$SubTotal_11  = 0;
	$SubTotal_12  = 0;
									
	foreach ($arrCategoria as $cat) {
		 
		$SubTotalGen = 0;

		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][1][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][2][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][3][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][4][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][5][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][6][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][7][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][8][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][9][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][10][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][11][$cat['idCategoria']]; 
		$SubTotalGen = $SubTotalGen+$grafico[$datos[0]['BodegaID']][12][$cat['idCategoria']]; 

		$SubTotal_1   = $SubTotal_1+$grafico[$datos[0]['BodegaID']][1][$cat['idCategoria']];
		$SubTotal_2   = $SubTotal_2+$grafico[$datos[0]['BodegaID']][2][$cat['idCategoria']];
		$SubTotal_3   = $SubTotal_3+$grafico[$datos[0]['BodegaID']][3][$cat['idCategoria']];
		$SubTotal_4   = $SubTotal_4+$grafico[$datos[0]['BodegaID']][4][$cat['idCategoria']];
		$SubTotal_5   = $SubTotal_5+$grafico[$datos[0]['BodegaID']][5][$cat['idCategoria']];
		$SubTotal_6   = $SubTotal_6+$grafico[$datos[0]['BodegaID']][6][$cat['idCategoria']];
		$SubTotal_7   = $SubTotal_7+$grafico[$datos[0]['BodegaID']][7][$cat['idCategoria']];
		$SubTotal_8   = $SubTotal_8+$grafico[$datos[0]['BodegaID']][8][$cat['idCategoria']];
		$SubTotal_9   = $SubTotal_9+$grafico[$datos[0]['BodegaID']][9][$cat['idCategoria']];
		$SubTotal_10  = $SubTotal_10+$grafico[$datos[0]['BodegaID']][10][$cat['idCategoria']];
		$SubTotal_11  = $SubTotal_11+$grafico[$datos[0]['BodegaID']][11][$cat['idCategoria']];
		$SubTotal_12  = $SubTotal_12+$grafico[$datos[0]['BodegaID']][12][$cat['idCategoria']];

		$Total = $Total + $SubTotalGen;
		
		if($SubTotalGen!=0){

			$objPHPExcel->setActiveSheetIndex($sheet)
						->setCellValue('A'.$nn, $cat['Nombre'])
						->setCellValue('B'.$nn, $grafico[$datos[0]['BodegaID']][1][$cat['idCategoria']])
						->setCellValue('C'.$nn, $grafico[$datos[0]['BodegaID']][2][$cat['idCategoria']])
						->setCellValue('D'.$nn, $grafico[$datos[0]['BodegaID']][3][$cat['idCategoria']])
						->setCellValue('E'.$nn, $grafico[$datos[0]['BodegaID']][4][$cat['idCategoria']])
						->setCellValue('F'.$nn, $grafico[$datos[0]['BodegaID']][5][$cat['idCategoria']])
						->setCellValue('G'.$nn, $grafico[$datos[0]['BodegaID']][6][$cat['idCategoria']])
						->setCellValue('H'.$nn, $grafico[$datos[0]['BodegaID']][7][$cat['idCategoria']])
						->setCellValue('I'.$nn, $grafico[$datos[0]['BodegaID']][8][$cat['idCategoria']])
						->setCellValue('J'.$nn, $grafico[$datos[0]['BodegaID']][9][$cat['idCategoria']])
						->setCellValue('K'.$nn, $grafico[$datos[0]['BodegaID']][10][$cat['idCategoria']])
						->setCellValue('L'.$nn, $grafico[$datos[0]['BodegaID']][11][$cat['idCategoria']])
						->setCellValue('M'.$nn, $grafico[$datos[0]['BodegaID']][12][$cat['idCategoria']])
						->setCellValue('N'.$nn, $SubTotalGen);
			$nn++;
		}           
	   
	} 

	$objPHPExcel->setActiveSheetIndex($sheet)
				->setCellValue('A'.$nn, 'Totales')
				->setCellValue('B'.$nn, $SubTotal_1)
				->setCellValue('C'.$nn, $SubTotal_2)
				->setCellValue('D'.$nn, $SubTotal_3)
				->setCellValue('E'.$nn, $SubTotal_4)
				->setCellValue('F'.$nn, $SubTotal_5)
				->setCellValue('G'.$nn, $SubTotal_6)
				->setCellValue('H'.$nn, $SubTotal_7)
				->setCellValue('I'.$nn, $SubTotal_8)
				->setCellValue('J'.$nn, $SubTotal_9)
				->setCellValue('K'.$nn, $SubTotal_10)
				->setCellValue('L'.$nn, $SubTotal_11)
				->setCellValue('M'.$nn, $SubTotal_12)
				->setCellValue('N'.$nn, $Total);


	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle(cortar('Ingresos de '.$empresa, 25));
			
	
	$sheet++;
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Bodega Insumos - Traspasos por Categorias x Empresas.xls"');
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
