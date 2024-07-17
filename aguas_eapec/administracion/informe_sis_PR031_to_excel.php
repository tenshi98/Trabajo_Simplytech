<?php
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'lib_PHPExcel/PHPExcel.php';
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
// Se trae un listado con todos los datos
$arrFacturacion = array();
$query = "SELECT
core_sistemas.Rut AS SistemaRut,
facturacion_listado_detalle.idCliente, 
facturacion_listado_detalle.AguasInfUltimoPagoFecha,
facturacion_listado_detalle.AguasInfUltimoPagoMonto AS Medicion

FROM `facturacion_listado_detalle`
LEFT JOIN `clientes_listado`      ON clientes_listado.idCliente     = facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`         ON core_sistemas.idSistema        = facturacion_listado_detalle.idSistema
WHERE idMes = {$_GET['idMes']} 
AND Ano = {$_GET['Ano']}
AND facturacion_listado_detalle.idEstado = 1
ORDER BY facturacion_listado_detalle.DetConsMesTotalCantidad ASC


";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
} 

//Programacion Cretiva
$informepr = array();
//definicion de variables vacias
for ($x = 1; $x <= 18; $x++) {
	//se define la cantidad de clientes
	$informepr[$x]['Cantidad'] = '';
	//se define el valor de as mediciones
	$informepr[$x]['Medicion'] = 0;
}

/*function dif_dias($year, $month, $nn, $dia){
	//se construye una fecha
	$mes_ant  = $month - $nn;
	$ano      = $year;
	//verifico que el mes restado sea correcto
	if($mes_ant==0){
		$mes_ant  = 12;
		$ano      = $year - 1;
	}
	//le agrego un cero en caso de ser inferior a 10
	if($mes_ant < 10){
		$mes_ant = '0'.$mes_ant;
	}
	//le agrego un cero en caso de ser inferior a 10
	if($dia < 10){
		$dia = '0'.$dia;
	}
	//construyo la fecha
	return $fecha_completa = $ano.'-'.$mes_ant.'-'.$dia;
					
					
}*/
				
				
foreach ($arrFacturacion as $fact) { 
	//saco la diferencia de dias
	//$fecha_vencimiento = dif_dias($_GET['Ano'], $_GET['idMes'], 0, 31);
	//The 4th of February 2014.
	$dateString = $_GET['Ano'].'-'.$_GET['idMes'].'-04';

	//Last date of current month.
	$fecha_vencimiento = date("Y-m-t", strtotime($dateString));
	
	$ndiasdif = 0;
	//Se verifica si pago despues de la fecha limite
	if($fact['AguasInfUltimoPagoFecha'] < $fecha_vencimiento){
		$ndiasdif = dias_transcurridos($fact['AguasInfUltimoPagoFecha'],$fecha_vencimiento);
		//se da 1 dia de gracia
		$ndiasdif = $ndiasdif - 1;
		//si la resta queda inferior a 0
		if($ndiasdif < 0){
			$ndiasdif = 0;
		}
	}
	
	//separo por codigo de rango
	if($ndiasdif==0){
		$informepr[0]['Cantidad']++;
		$informepr[0]['Medicion'] = $informepr[0]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>0 && $ndiasdif<=30){	
		$informepr[1]['Cantidad']++;
		$informepr[1]['Medicion'] = $informepr[1]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>30 && $ndiasdif<=60){
		$informepr[2]['Cantidad']++;
		$informepr[2]['Medicion'] = $informepr[2]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>60 && $ndiasdif<=90){
		$informepr[3]['Cantidad']++;
		$informepr[3]['Medicion'] = $informepr[3]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>90 && $ndiasdif<=180){
		$informepr[4]['Cantidad']++;
		$informepr[4]['Medicion'] = $informepr[4]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>180){
		$informepr[5]['Cantidad']++;
		$informepr[5]['Medicion'] = $informepr[5]['Medicion'] + $fact['Medicion'];
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

			         
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'codigoProceso')
            ->setCellValue('B1', 'codigoArchivo')
            ->setCellValue('C1', 'rut')
            ->setCellValue('D1', 'periodo')
            ->setCellValue('E1', 'codigoLocalidad')
            ->setCellValue('F1', 'tramoMorosidad')
            ->setCellValue('G1', 'MontoDeuda')
            ->setCellValue('H1', 'NumClientes');
            
$nn=2;
$total1 = 0;
$clientes = 0;
for ($x = 1; $x <= 18; $x++) {
	if(isset($informepr[$x]['Cantidad'])&&$informepr[$x]['Cantidad']!=''){ 
		//se suman los totales de las mediciones y los clientes
		$total1 = $total1 + $informepr[$x]['Medicion'];
		$clientes = $clientes + $informepr[$x]['Cantidad'];
		$rut = substr($arrFacturacion[0]['SistemaRut'], 0, -2);
			
		if($_GET['idMes']>9){$fecha = $_GET['Ano'].$_GET['idMes'];}else{$fecha = $_GET['Ano'].'0'.$_GET['idMes'];}
			
			
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, '15')
					->setCellValue('B'.$nn, '1')
					->setCellValue('C'.$nn, $rut)
					->setCellValue('D'.$nn, $fecha)
					->setCellValue('E'.$nn, '393')
					->setCellValue('F'.$nn, $x)
					->setCellValue('G'.$nn, $informepr[$x]['Medicion'])
					->setCellValue('H'.$nn, $informepr[$x]['Cantidad']);

		 $nn++;           
   
	}
}





// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Informe PR031');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe PR031.xls"');
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
