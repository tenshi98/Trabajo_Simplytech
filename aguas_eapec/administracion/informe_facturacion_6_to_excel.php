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
Fecha,
ClienteIdentificador,
DetalleCargoFijoValor,
DetalleConsumoCantidad,
DetalleConsumoValor,
AguasInfMetroAgua,
AguasInfMetroRecolecion,
DetalleRecoleccionCantidad,
DetalleRecoleccionValor,
DetalleVisitaCorte,
DetalleCorte1Valor,
DetalleCorte2Valor,
DetalleReposicion1Valor,
DetalleReposicion2Valor,
DetalleSubtotalServicio,
DetalleInteresDeuda,
DetalleSaldoFavor,
DetalleTotalVenta,
DetalleSaldoAnterior,
DetalleOtrosCargos1Valor,
DetalleOtrosCargos2Valor,
DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,
DetalleOtrosCargos5Valor,
DetalleTotalAPagar,
AguasInfUltimoPagoFecha,
AguasInfUltimoPagoMonto,
intAnual

FROM `facturacion_listado_detalle`
WHERE idMes = {$_GET['idMes']} 
AND Ano = {$_GET['Ano']} 
ORDER BY ClienteIdentificador";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
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
			->setCellValue('A1', 'Identificador')
            ->setCellValue('B1', 'Cargo Fijo')
            
            ->setCellValue('C1', 'Consumo Cantidad')
            ->setCellValue('D1', 'Consumo Valor')
            ->setCellValue('E1', 'Revision Consumo Valor')
            ->setCellValue('F1', 'Revision Error')
            
            ->setCellValue('G1', 'Recoleccion Cantidad')
            ->setCellValue('H1', 'Recoleccion Valor')
            ->setCellValue('I1', 'Revision Recoleccion Cantidad')
            ->setCellValue('J1', 'Revision Error')
            
            ->setCellValue('K1', 'Visita Corte')
            ->setCellValue('L1', 'Corte 1 ins')
            ->setCellValue('M1', 'Corte 2 ins')
            ->setCellValue('N1', 'Reposicion 1 ins')
            ->setCellValue('O1', 'Reposicion 2 ins')
            ->setCellValue('P1', 'Subtotal Servicio')
            ->setCellValue('Q1', 'Revision Subtotal Servicio')
            ->setCellValue('R1', 'Revision Error')
            
            ->setCellValue('S1', 'Interes')
            ->setCellValue('T1', 'Dias de atraso')
            ->setCellValue('U1', 'Revision Interes')
            ->setCellValue('V1', 'Revision Error')
            
            ->setCellValue('W1', 'Saldo Favor')
            ->setCellValue('X1', 'Total Venta')
            ->setCellValue('Y1', 'Revision Total Venta')
            ->setCellValue('Z1', 'Revision Error')
  
			->setCellValue('AA1', 'Saldo Anterior')
            ->setCellValue('AB1', 'Otros Cargos 1')
            ->setCellValue('AC1', 'Otros Cargos 2')
            ->setCellValue('AD1', 'Otros Cargos 3')
            ->setCellValue('AE1', 'Otros Cargos 4')
            ->setCellValue('AF1', 'Otros Cargos 5')
            ->setCellValue('AG1', 'Total Pagar')
            ->setCellValue('AH1', 'Revision Total Pagar')
            ->setCellValue('AI1', 'Revision Error');
            
$nn=2;
foreach ($arrFacturacion as $fact) { 

	//se construye una fecha
	$mes_ant = $_GET['idMes'] - 1;
	if($mes_ant < 10){
		$mes_ant = '0'.$mes_ant;
	}else{
		$mes_ant  = $mes_ant;
	}
	$fecha_completa = $_GET['Ano'].'-'.$mes_ant.'-'.'25';
					
	//verifico que se haya pagado despues de la fecha de vencimiento para el calculo de intereses
	if($fact['AguasInfUltimoPagoFecha'] > $fecha_completa){
		$ndiasdif1 = dias_transcurridos($fact['AguasInfUltimoPagoFecha'],$fecha_completa);
		//se da 1 dia de gracia
		$ndiasdif1 = $ndiasdif1 - 1;
	}else{
		$ndiasdif1 = 0;
	}
					
					
	//variables 
	$RevConsumo           = valores_truncados($fact['DetalleConsumoCantidad']*$fact['AguasInfMetroAgua']);
	$RevRecoleccion       = valores_truncados($fact['DetalleRecoleccionCantidad']*$fact['AguasInfMetroRecolecion']);
	$RevSubtotalServicio  = $fact['DetalleCargoFijoValor'] + $RevConsumo + $RevRecoleccion + $fact['DetalleVisitaCorte'] + $fact['DetalleCorte1Valor'] + $fact['DetalleCorte2Valor'] + $fact['DetalleReposicion1Valor'] + $fact['DetalleReposicion2Valor'];
	$RevIntereses         = valores_truncados((($ndiasdif1 * $fact['AguasInfUltimoPagoMonto'] * $fact['intAnual'])/36000)*1.19);
	$RevTotalVenta        = $RevSubtotalServicio + $RevIntereses - $fact['DetalleSaldoFavor']; 
	$RevTotalAPagar       = $RevTotalVenta + $fact['DetalleSaldoAnterior'] + $fact['DetalleOtrosCargos1Valor'] + $fact['DetalleOtrosCargos2Valor'] + $fact['DetalleOtrosCargos3Valor'] + $fact['DetalleOtrosCargos4Valor'] + $fact['DetalleOtrosCargos5Valor'];
						
	//revisiones
	if($fact['DetalleConsumoValor']!=$RevConsumo){               $ErrorConsumo = 'Error';          }else{$ErrorConsumo = '';}
	if($fact['DetalleRecoleccionValor']!=$RevRecoleccion){       $ErrorRecoleccion = 'Error';      }else{$ErrorRecoleccion = '';}
	if($fact['DetalleSubtotalServicio']!=$RevSubtotalServicio){  $ErrorSubtotalServicio = 'Error'; }else{$ErrorSubtotalServicio = '';}
	if($fact['DetalleInteresDeuda']!=$RevIntereses){             $ErrorIntereses = 'Error';        }else{$ErrorIntereses = '';}
	if($fact['DetalleTotalVenta']!=$RevTotalVenta){              $ErrorTotalVenta = 'Error';       }else{$ErrorTotalVenta = '';}
	if($fact['DetalleTotalAPagar']!=$RevTotalAPagar){            $ErrorTotalAPagar = 'Error';      }else{$ErrorTotalAPagar = '';}
					
					
	
	
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$nn, $fact['ClienteIdentificador'])
            ->setCellValue('B'.$nn, $fact['DetalleCargoFijoValor'])
            
            ->setCellValue('C'.$nn, $fact['DetalleConsumoCantidad'])
            ->setCellValue('D'.$nn, $fact['DetalleConsumoValor'])
            ->setCellValue('E'.$nn, $RevConsumo)
            ->setCellValue('F'.$nn, $ErrorConsumo)
            
            ->setCellValue('G'.$nn, $fact['DetalleRecoleccionCantidad'])
            ->setCellValue('H'.$nn, $fact['DetalleRecoleccionValor'])
            ->setCellValue('I'.$nn, $RevRecoleccion)
            ->setCellValue('J'.$nn, $ErrorRecoleccion)
            
            ->setCellValue('K'.$nn, $fact['DetalleVisitaCorte'])
            ->setCellValue('L'.$nn, $fact['DetalleCorte1Valor'])
            ->setCellValue('M'.$nn, $fact['DetalleCorte2Valor'])
            ->setCellValue('N'.$nn, $fact['DetalleReposicion1Valor'])
            ->setCellValue('O'.$nn, $fact['DetalleReposicion2Valor'])
            ->setCellValue('P'.$nn, $fact['DetalleSubtotalServicio'])
            ->setCellValue('Q'.$nn, $RevSubtotalServicio)
            ->setCellValue('R'.$nn, $ErrorSubtotalServicio)
            
            ->setCellValue('S'.$nn, $fact['DetalleInteresDeuda'])
            ->setCellValue('T'.$nn, $ndiasdif1)
            ->setCellValue('U'.$nn, $RevIntereses)
            ->setCellValue('V'.$nn, $ErrorIntereses)
            
            ->setCellValue('W'.$nn, $fact['DetalleSaldoFavor'])
            ->setCellValue('X'.$nn, $fact['DetalleTotalVenta'])
            ->setCellValue('Y'.$nn, $RevTotalVenta)
            ->setCellValue('Z'.$nn, $ErrorTotalVenta)
            
            ->setCellValue('AA'.$nn, $fact['DetalleSaldoAnterior'])
            ->setCellValue('AB'.$nn, $fact['DetalleOtrosCargos1Valor'])
            ->setCellValue('AC'.$nn, $fact['DetalleOtrosCargos2Valor'])
            ->setCellValue('AD'.$nn, $fact['DetalleOtrosCargos3Valor'])
            ->setCellValue('AE'.$nn, $fact['DetalleOtrosCargos4Valor'])
            ->setCellValue('AF'.$nn, $fact['DetalleOtrosCargos5Valor'])
            ->setCellValue('AG'.$nn, $fact['DetalleTotalAPagar'])
            ->setCellValue('AH'.$nn, $RevTotalAPagar)
            ->setCellValue('AI'.$nn, $ErrorTotalAPagar);

 $nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Revision Facturacion');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Revision Facturacion fecha '.$arrFacturacion[0]['Fecha'].'.xls"');
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
