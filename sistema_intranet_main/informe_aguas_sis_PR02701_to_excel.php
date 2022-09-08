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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//obtengo los datos de la empresa
$rowEmpresa = db_select_data (false, 'Nombre', 'core_sistemas', '', 'idSistema='.$_GET['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');

/*******************************************************/
$SIS_query = '
core_sistemas.Rut AS SistemaRut,
aguas_facturacion_listado_detalle.idCliente, 
aguas_clientes_listado.idTipo AS tipoCliente,
aguas_facturacion_listado_detalle.DetConsMesTotalCantidad AS Medicion';
$SIS_join  = '
LEFT JOIN `aguas_clientes_listado`      ON aguas_clientes_listado.idCliente     = aguas_facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema              = aguas_facturacion_listado_detalle.idSistema';
$SIS_where = 'aguas_facturacion_listado_detalle.idMes = '.$_GET['idMes'].' AND aguas_facturacion_listado_detalle.Ano = '.$_GET['Ano'].' AND aguas_facturacion_listado_detalle.idSistema = '.$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_order = ''aguas_facturacion_listado_detalle.DetConsMesTotalCantidad ASC;
$arrFacturacion = array();
$arrFacturacion = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrFacturacion');

//Programacion Cretiva
$informepr = array();
//definicion de variables vacias
for ($i = 1; $i <= 5; $i++) {
	for ($x = 1; $x <= 18; $x++) {
		//se define la cantidad de clientes
		$informepr[$i][$x]['Cantidad'] = '';
		//se define el valor de as mediciones
		$informepr[$i][$x]['Medicion'] = 0;
	}
}

foreach ($arrFacturacion as $fact) { 
	//separo por codigo de rango
	if($fact['Medicion']==0){
		$informepr[$fact['tipoCliente']][1]['Cantidad']++;
		$informepr[$fact['tipoCliente']][1]['Medicion'] = $informepr[$fact['tipoCliente']][1]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>0 && $fact['Medicion']<=10){	
		$informepr[$fact['tipoCliente']][2]['Cantidad']++;
		$informepr[$fact['tipoCliente']][2]['Medicion'] = $informepr[$fact['tipoCliente']][2]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>10 && $fact['Medicion']<=15){
		$informepr[$fact['tipoCliente']][3]['Cantidad']++;
		$informepr[$fact['tipoCliente']][3]['Medicion'] = $informepr[$fact['tipoCliente']][3]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>15 && $fact['Medicion']<=20){
		$informepr[$fact['tipoCliente']][4]['Cantidad']++;
		$informepr[$fact['tipoCliente']][4]['Medicion'] = $informepr[$fact['tipoCliente']][4]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>20 && $fact['Medicion']<=30){
		$informepr[$fact['tipoCliente']][5]['Cantidad']++;
		$informepr[$fact['tipoCliente']][5]['Medicion'] = $informepr[$fact['tipoCliente']][5]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>30 && $fact['Medicion']<=40){
		$informepr[$fact['tipoCliente']][6]['Cantidad']++;
		$informepr[$fact['tipoCliente']][6]['Medicion'] = $informepr[$fact['tipoCliente']][6]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>40 && $fact['Medicion']<=50){
		$informepr[$fact['tipoCliente']][7]['Cantidad']++;
		$informepr[$fact['tipoCliente']][7]['Medicion'] = $informepr[$fact['tipoCliente']][7]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>50 && $fact['Medicion']<=60){
		$informepr[$fact['tipoCliente']][8]['Cantidad']++;
		$informepr[$fact['tipoCliente']][8]['Medicion'] = $informepr[$fact['tipoCliente']][8]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>60 && $fact['Medicion']<=70){
		$informepr[$fact['tipoCliente']][9]['Cantidad']++;
		$informepr[$fact['tipoCliente']][9]['Medicion'] = $informepr[$fact['tipoCliente']][9]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>70 && $fact['Medicion']<=80){
		$informepr[$fact['tipoCliente']][10]['Cantidad']++;
		$informepr[$fact['tipoCliente']][10]['Medicion'] = $informepr[$fact['tipoCliente']][10]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>80 && $fact['Medicion']<=120){
		$informepr[$fact['tipoCliente']][11]['Cantidad']++;
		$informepr[$fact['tipoCliente']][11]['Medicion'] = $informepr[$fact['tipoCliente']][11]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>120 && $fact['Medicion']<=160){
		$informepr[$fact['tipoCliente']][12]['Cantidad']++;
		$informepr[$fact['tipoCliente']][12]['Medicion'] = $informepr[$fact['tipoCliente']][12]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>160 && $fact['Medicion']<=200){
		$informepr[$fact['tipoCliente']][13]['Cantidad']++;
		$informepr[$fact['tipoCliente']][13]['Medicion'] = $informepr[$fact['tipoCliente']][13]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>200 && $fact['Medicion']<=240){
		$informepr[$fact['tipoCliente']][14]['Cantidad']++;
		$informepr[$fact['tipoCliente']][14]['Medicion'] = $informepr[$fact['tipoCliente']][14]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>240 && $fact['Medicion']<=280){
		$informepr[$fact['tipoCliente']][15]['Cantidad']++;
		$informepr[$fact['tipoCliente']][15]['Medicion'] = $informepr[$fact['tipoCliente']][15]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>280 && $fact['Medicion']<=300){
		$informepr[$fact['tipoCliente']][16]['Cantidad']++;
		$informepr[$fact['tipoCliente']][16]['Medicion'] = $informepr[$fact['tipoCliente']][16]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>300 ){
		$informepr[$fact['tipoCliente']][17]['Cantidad']++;
		$informepr[$fact['tipoCliente']][17]['Medicion'] = $informepr[$fact['tipoCliente']][17]['Medicion'] + $fact['Medicion'];
	}else{
		$informepr[$fact['tipoCliente']][18]['Cantidad']++;
		$informepr[$fact['tipoCliente']][18]['Medicion'] = $informepr[$fact['tipoCliente']][18]['Medicion'] + $fact['Medicion'];
	}
}

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
        
            
//Titulo columnas
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'codigoProceso')
            ->setCellValue('B1', 'codigoArchivo')
            ->setCellValue('C1', 'rut')
            ->setCellValue('D1', 'periodo')
            ->setCellValue('E1', 'codigoLimite')
            ->setCellValue('F1', 'codigoLocalidad')
            ->setCellValue('G1', 'codigoComuna')
            ->setCellValue('H1', 'tipoCliente')
            ->setCellValue('I1', 'tipoServicio')
            ->setCellValue('J1', 'codigoRango')
            ->setCellValue('K1', 'MetrosCubicosAP')
            ->setCellValue('L1', 'MetrosCubicosAS')
            ->setCellValue('M1', 'CantidadClientes');

					
$nn       = 2;
$total1   = 0;
$total2   = 0;
$clientes = 0;
for ($i = 1; $i <= 5; $i++) {
	for ($x = 1; $x <= 18; $x++) {
		if(isset($informepr[$i][$x]['Cantidad'])&&$informepr[$i][$x]['Cantidad']!=''){ 
			//se suman los totales de las mediciones y los clientes
			$total1    = $total1 + $informepr[$i][$x]['Medicion'];
			$total2    = $total2 + $informepr[$i][$x]['Medicion'];
			$clientes  = $clientes + $informepr[$i][$x]['Cantidad'];
			
			if($_GET['idMes']>9){$fecha = $_GET['Ano'].$_GET['idMes'];}else{$fecha = $_GET['Ano'].'0'.$_GET['idMes'];}
			
			$rut = substr($arrFacturacion[0]['SistemaRut'], 0, -2);

			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A'.$nn, '3')
						->setCellValue('B'.$nn, '9')
						->setCellValue('C'.$nn, $rut)
						->setCellValue('D'.$nn, $fecha)
						->setCellValue('E'.$nn, '7')
						->setCellValue('F'.$nn, '393')
						->setCellValue('G'.$nn, '13115')
						->setCellValue('H'.$nn, $i)
						->setCellValue('I'.$nn, '3')
						->setCellValue('J'.$nn, $x)
						->setCellValue('K'.$nn, $informepr[$i][$x]['Medicion'])
						->setCellValue('L'.$nn, $informepr[$i][$x]['Medicion'])
						->setCellValue('M'.$nn, $informepr[$i][$x]['Cantidad']);

			$nn++;           
   
		}
	}
}
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('K'.$nn, $total1)
			->setCellValue('L'.$nn, $total2)
			->setCellValue('M'.$nn, $clientes);

			 
// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Informe PR02701');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Informe PR02701';
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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

