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
core_sistemas.Rut AS SistemaRut,
aguas_facturacion_listado_detalle.ClienteIdentificador,
aguas_facturacion_listado_detalle.AguasInfUltimoPagoFecha,
aguas_facturacion_listado_detalle.AguasInfUltimoPagoMonto AS Medicion';
$SIS_join  = '
LEFT JOIN `aguas_clientes_listado` ON aguas_clientes_listado.idCliente = aguas_facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`          ON core_sistemas.idSistema          = aguas_facturacion_listado_detalle.idSistema';
$SIS_where = 'aguas_facturacion_listado_detalle.idMes = '.$_GET['idMes'].' AND aguas_facturacion_listado_detalle.Ano = '.$_GET['Ano'].' AND aguas_facturacion_listado_detalle.idSistema = '.$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_facturacion_listado_detalle.idEstado = 1';
$SIS_order = 'aguas_facturacion_listado_detalle.DetConsMesTotalCantidad ASC';
$arrFacturacion = array();
$arrFacturacion = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrFacturacion');

//Programacion Cretiva
$informepr = array();
//definicion de variables vacias
for ($x = 1; $x <= 18; $x++) {
	//se define la cantidad de clientes
	$informepr[$x]['Cantidad'] = '';
	//se define el valor de as mediciones
	$informepr[$x]['Medicion'] = 0;
}

function dif_dias($year, $month, $nn, $dia){
	//se construye una fecha
	$mes_ant  = $month - $nn;
	$ano      = $year;
	//verifico que el mes restado sea correcto
	if($mes_ant==0){
		$mes_ant  = 12;
		$ano      = $year - 1;
	}
	//le agrego un cero en caso de ser inferior a 10
	$mes_ant = numero_mes($mes_ant);
	//le agrego un cero en caso de ser inferior a 10
	$dia = numero_dia($dia);
	//construyo la fecha
	$fecha_completa = date("Y-m-d", strtotime($ano.'-'.$mes_ant.'-'.$dia));

	return $fecha_completa;
}
function devolver_tramo($dato){
	switch ($dato) {
		case 1: $data = "1 - 30 días"; break;
		case 2: $data = "31 -60 días"; break;
		case 3: $data = "61 - 90 días"; break;
		case 4: $data = "91 - 180 días"; break;
		case 5: $data = "181 y más días"; break;
	}
	return $data;
}
$errores = '';
foreach ($arrFacturacion as $fact) {
	//saco la diferencia de dias
	$fecha_vencimiento = dif_dias($_GET['Ano'], $_GET['idMes'], 0, 31);

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
		//listo los errores
		$errores .= 'Cliente '.$fact['ClienteIdentificador'].' : '.$fact['AguasInfUltimoPagoFecha'].' - '.$fecha_vencimiento.' = '.$ndiasdif.'<br/>';
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

/**********************************************************************************************************************************/
/*                                                          Ejecucion                                                             */
/**********************************************************************************************************************************/
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator(DeSanitizar($rowEmpresa['Nombre']))
							 ->setLastModifiedBy(DeSanitizar($rowEmpresa['Nombre']))
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
            ->setCellValue('E1', 'codigoLocalidad')
            ->setCellValue('F1', 'tramoMorosidad')
            ->setCellValue('G1', 'MontoDeuda')
            ->setCellValue('H1', 'NumClientes');

$nn       = 2;
$total1   = 0;
$clientes = 0;
for ($x = 1; $x <= 18; $x++) {
	if(isset($informepr[$x]['Cantidad'])&&$informepr[$x]['Cantidad']!=''){
		//se suman los totales de las mediciones y los clientes
		$total1   = $total1 + $informepr[$x]['Medicion'];
		$clientes = $clientes + $informepr[$x]['Cantidad'];
		$rut      = substr($arrFacturacion[0]['SistemaRut'], 0, -2);

		$fecha = $_GET['Ano'].numero_mes($_GET['idMes']);

		$spreadsheet->setActiveSheetIndex(0)
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
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('G'.$nn, $total1)
			->setCellValue('H'.$nn, $clientes);


// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Informe PR031');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Informe PR031';
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
