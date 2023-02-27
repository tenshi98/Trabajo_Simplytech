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
//Verifico el tipo de usuario que esta ingresando
$SIS_where = "aguas_analisis_aguas.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//Filtros
if (isset($_GET['idSector']) && $_GET['idSector']!=''){        $SIS_where .=" AND aguas_analisis_aguas.idSector='".$_GET['idSector']."'"; }
if (isset($_GET['idPuntoMuestreo']) && $_GET['idPuntoMuestreo']!=''){ $SIS_where .=" AND aguas_analisis_aguas.idPuntoMuestreo='".$_GET['idPuntoMuestreo']."'"; }
if (isset($_GET['idTipoMuestra']) && $_GET['idTipoMuestra']!=''){     $SIS_where .=" AND aguas_analisis_aguas.idTipoMuestra='".$_GET['idTipoMuestra']."'"; }
if (isset($_GET['idParametros']) && $_GET['idParametros']!=''){$SIS_where .=" AND aguas_analisis_aguas.idParametros='".$_GET['idParametros']."'"; }
if (isset($_GET['idSigno']) && $_GET['idSigno']!=''){          $SIS_where .=" AND aguas_analisis_aguas.idSigno='".$_GET['idSigno']."'"; }
if (isset($_GET['idLaboratorio']) && $_GET['idLaboratorio']!=''){     $SIS_where .=" AND aguas_analisis_aguas.idLaboratorio='".$_GET['idLaboratorio']."'"; }

if(isset($_GET['f_muestra_inicio']) && $_GET['f_muestra_inicio'] != ''&&isset($_GET['f_muestra_termino']) && $_GET['f_muestra_termino']!=''){
	$SIS_where .= " AND aguas_analisis_aguas.f_muestra BETWEEN '".$_GET['f_muestra_inicio']."' AND '".$_GET['f_muestra_termino']."'";
}
if(isset($_GET['f_recibida_inicio']) && $_GET['f_recibida_inicio'] != ''&&isset($_GET['f_recibida_termino']) && $_GET['f_recibida_termino']!=''){
	$SIS_where .= " AND aguas_analisis_aguas.f_recibida BETWEEN '".$_GET['f_recibida_inicio']."' AND '".$_GET['f_recibida_termino']."'";
}

$SIS_query = '
aguas_analisis_aguas.codigoProceso,
aguas_analisis_aguas.codigoArchivo,
core_sistemas.Rut AS rut,
aguas_analisis_aguas.f_recibida AS periodo,
aguas_analisis_aguas.codigoServicio AS codigo_servicio,
aguas_analisis_aguas.idSector AS codigo_sector,
aguas_analisis_aguas.codigoMuestra AS codigo_muestra,
aguas_analisis_aguas_tipo_punto_muestreo.Codigo AS tipo_punto_muestreo,
aguas_analisis_aguas.UTM_norte,
aguas_analisis_aguas.UTM_este,
aguas_analisis_aguas_tipo_muestra.Codigo AS tipo_muestra,
aguas_analisis_aguas.RemuestraFecha AS periodo_remuestreo,
aguas_analisis_aguas.f_muestra AS fecha_muestra,
aguas_analisis_parametros.Codigo AS codigo_parametro,
aguas_analisis_aguas_signo.Codigo AS signo,
aguas_analisis_aguas.valorAnalisis AS valor,
aguas_analisis_laboratorios.Rut AS rutLaboratorio,
aguas_analisis_laboratorios.Codigo AS idLaboratorio,
aguas_clientes_listado.Identificador';
$SIS_join  = '
LEFT JOIN `core_sistemas`                               ON core_sistemas.idSistema                                       = aguas_analisis_aguas.idSistema
LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo`    ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo      = aguas_analisis_aguas.idPuntoMuestreo
LEFT JOIN `aguas_analisis_aguas_tipo_muestra`           ON aguas_analisis_aguas_tipo_muestra.idTipoMuestra               = aguas_analisis_aguas.idTipoMuestra
LEFT JOIN `aguas_analisis_parametros`                   ON aguas_analisis_parametros.idParametros                        = aguas_analisis_aguas.idParametros
LEFT JOIN `aguas_analisis_aguas_signo`                  ON aguas_analisis_aguas_signo.idSigno                            = aguas_analisis_aguas.idSigno
LEFT JOIN `aguas_analisis_laboratorios`                 ON aguas_analisis_laboratorios.idLaboratorio                     = aguas_analisis_aguas.idLaboratorio
LEFT JOIN `aguas_clientes_listado`                      ON aguas_clientes_listado.idCliente                              = aguas_analisis_aguas.idCliente';
$SIS_order = 'aguas_analisis_aguas.f_recibida ASC';
$arrProductos = array();
$arrProductos = db_select_array (false, $SIS_query, 'aguas_analisis_aguas', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

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
            ->setCellValue('E1', 'codigo_servicio')
            ->setCellValue('F1', 'codigo_sector')
            ->setCellValue('G1', 'codigo_muestra')
            ->setCellValue('H1', 'tipo_punto_muestreo')
            ->setCellValue('I1', 'UTM_norte')
            ->setCellValue('J1', 'UTM_este')
            ->setCellValue('K1', 'tipo_muestra')
            ->setCellValue('L1', 'periodo_remuestreo')
            ->setCellValue('M1', 'fecha_muestra')
            ->setCellValue('N1', 'codigo_parametro')
            ->setCellValue('O1', 'signo')
            ->setCellValue('P1', 'valor')
            ->setCellValue('Q1', 'rutLaboratorio')
            ->setCellValue('R1', 'idLaboratorio');

					
$nn  = 2;
$var = "";
foreach ($arrProductos as $productos) { 
	
	if($productos['periodo_remuestreo']!='0000-00-00'){$var = fecha2Ano($productos['periodo_remuestreo']).fecha2NdiaMesCon0($productos['periodo_remuestreo']);}
						
	$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, DeSanitizar($productos['codigoProceso']))
				->setCellValue('B'.$nn, DeSanitizar($productos['codigoArchivo']))
				->setCellValue('C'.$nn, cortarRut($productos['rut']))
				->setCellValue('D'.$nn, fecha2Ano($productos['periodo']).fecha2NdiaMesCon0($productos['periodo']))
				
				->setCellValue('E'.$nn, DeSanitizar($productos['codigo_servicio']))
				->setCellValue('F'.$nn, DeSanitizar($productos['codigo_sector']))
				->setCellValue('G'.$nn, DeSanitizar($productos['codigo_muestra']))
				->setCellValue('H'.$nn, DeSanitizar($productos['tipo_punto_muestreo']))
				
				->setCellValue('I'.$nn, $productos['UTM_norte'])
				->setCellValue('J'.$nn, $productos['UTM_este'])
				->setCellValue('K'.$nn, DeSanitizar($productos['tipo_muestra']))
				->setCellValue('L'.$nn, $var)
				
				->setCellValue('M'.$nn, $productos['fecha_muestra'])
				->setCellValue('N'.$nn, DeSanitizar($productos['codigo_parametro']))
				->setCellValue('O'.$nn, DeSanitizar($productos['signo']))
				->setCellValue('P'.$nn, $productos['valor'])
				->setCellValue('Q'.$nn, $productos['rutLaboratorio'])
				->setCellValue('R'.$nn, DeSanitizar($productos['idLaboratorio']));				
	$nn++;
	   
} 

			 
// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Informe Analisis');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Informe Analisis';
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
