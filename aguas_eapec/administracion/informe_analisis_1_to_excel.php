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
//Verifico el tipo de usuario que esta ingresando
$z = "WHERE analisis_aguas.idSistema>=0";
//Filtros
if (isset($_GET['idSector']) && $_GET['idSector'] != ''){                
	$z .=" AND analisis_aguas.idSector='{$_GET['idSector']}'";
}
if (isset($_GET['idPuntoMuestreo']) && $_GET['idPuntoMuestreo'] != ''){  
	$z .=" AND analisis_aguas.idPuntoMuestreo='{$_GET['idPuntoMuestreo']}'";
}
if (isset($_GET['idTipoMuestra']) && $_GET['idTipoMuestra'] != ''){      
	$z .=" AND analisis_aguas.idTipoMuestra='{$_GET['idTipoMuestra']}'";
}
if (isset($_GET['idParametros']) && $_GET['idParametros'] != ''){        
	$z .=" AND analisis_aguas.idParametros='{$_GET['idParametros']}'";
}
if (isset($_GET['idSigno']) && $_GET['idSigno'] != ''){                  
	$z .=" AND analisis_aguas.idSigno='{$_GET['idSigno']}'";
}
if (isset($_GET['idLaboratorio']) && $_GET['idLaboratorio'] != ''){      
	$z .=" AND analisis_aguas.idLaboratorio='{$_GET['idLaboratorio']}'";
}

if(isset($_GET['f_muestra_inicio']) && $_GET['f_muestra_inicio'] != ''&&isset($_GET['f_muestra_termino']) && $_GET['f_muestra_termino'] != ''){ 
	$z .= " AND analisis_aguas.f_muestra BETWEEN '{$_GET['f_muestra_inicio']}' AND '{$_GET['f_muestra_termino']}'" ;
}
if(isset($_GET['f_recibida_inicio']) && $_GET['f_recibida_inicio'] != ''&&isset($_GET['f_recibida_termino']) && $_GET['f_recibida_termino'] != ''){ 
	$z .= " AND analisis_aguas.f_recibida BETWEEN '{$_GET['f_recibida_inicio']}' AND '{$_GET['f_recibida_termino']}'" ;
}

         
            
// Se trae un listado con todos los usuarios
$arrProductos = array();
$query = "SELECT 
analisis_aguas.codigoProceso,
analisis_aguas.codigoArchivo,
core_sistemas.Rut AS rut,
analisis_aguas.f_recibida AS periodo,
analisis_aguas.codigoServicio AS codigo_servicio,
analisis_aguas.idSector AS codigo_sector,
analisis_aguas.codigoMuestra AS codigo_muestra,
analisis_aguas_tipo_punto_muestreo.Codigo AS tipo_punto_muestreo,
analisis_aguas.UTM_norte,
analisis_aguas.UTM_este,
analisis_aguas_tipo_muestra.Codigo AS tipo_muestra,
analisis_aguas.RemuestraFecha AS periodo_remuestreo,
analisis_aguas.f_muestra AS fecha_muestra,
analisis_parametros.Codigo AS codigo_parametro,
analisis_aguas_signo.Codigo AS signo,
analisis_aguas.valorAnalisis AS valor,
analisis_laboratorios.Rut AS rutLaboratorio,
analisis_laboratorios.Codigo AS idLaboratorio

FROM `analisis_aguas`
LEFT JOIN `core_sistemas`                         ON core_sistemas.idSistema                                 = analisis_aguas.idSistema
LEFT JOIN `analisis_aguas_tipo_punto_muestreo`    ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo      = analisis_aguas.idPuntoMuestreo
LEFT JOIN `analisis_aguas_tipo_muestra`           ON analisis_aguas_tipo_muestra.idTipoMuestra               = analisis_aguas.idTipoMuestra
LEFT JOIN `analisis_parametros`                   ON analisis_parametros.idParametros                        = analisis_aguas.idParametros
LEFT JOIN `analisis_aguas_signo`                  ON analisis_aguas_signo.idSigno                            = analisis_aguas.idSigno
LEFT JOIN `analisis_laboratorios`                 ON analisis_laboratorios.idLaboratorio                     = analisis_aguas.idLaboratorio

".$z."
ORDER BY analisis_aguas.f_recibida ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
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
            
            
         
				
						
						
            
$nn=2;
$var = "";
foreach ($arrProductos as $productos) { 
	
	if($productos['periodo_remuestreo']!='0000-00-00'){$var = Fecha_año($productos['periodo_remuestreo']).Fecha_mes_n($productos['periodo_remuestreo']); }
	
						
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $productos['codigoProceso'])
				->setCellValue('B'.$nn, $productos['codigoArchivo'])
				->setCellValue('C'.$nn, cortarRut($productos['rut']))
				->setCellValue('D'.$nn, Fecha_año($productos['periodo']).Fecha_mes_n($productos['periodo']))
				
				->setCellValue('E'.$nn, $productos['codigo_servicio'])
				->setCellValue('F'.$nn, $productos['codigo_sector'])
				->setCellValue('G'.$nn, $productos['codigo_muestra'])
				->setCellValue('H'.$nn, $productos['tipo_punto_muestreo'])
				
				->setCellValue('I'.$nn, $productos['UTM_norte'])
				->setCellValue('J'.$nn, $productos['UTM_este'])
				->setCellValue('K'.$nn, $productos['tipo_muestra'])
				->setCellValue('L'.$nn, $var)
				
				->setCellValue('M'.$nn, $productos['fecha_muestra'])
				->setCellValue('N'.$nn, $productos['codigo_parametro'])
				->setCellValue('O'.$nn, $productos['signo'])
				->setCellValue('P'.$nn, $productos['valor'])
				->setCellValue('Q'.$nn, $productos['rutLaboratorio'])
				->setCellValue('R'.$nn, $productos['idLaboratorio']);				
	 $nn++;           
	   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Informe Analisis');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Analisis.xls"');
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
