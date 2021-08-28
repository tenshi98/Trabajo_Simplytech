<?php
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
require_once 'core/Load.Utils.NoSessions.php';
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

/**********************************************************/
$z = "telemetria_listado_errores.idSistema=".$_GET['idSistema'];
if(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino'] != ''&&isset($_GET['h_inicio']) && $_GET['h_inicio'] != ''&&isset($_GET['h_termino']) && $_GET['h_termino'] != ''){ 
	$z.=" AND telemetria_listado_errores.TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."'";
}elseif(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino'] != ''){ 
	$z.=" AND telemetria_listado_errores.Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){  $z.=" AND telemetria_listado_errores.idTelemetria=".$_GET['idTelemetria'];}
//Agrupo
$w1 =" GROUP BY telemetria_listado.Nombre, telemetria_listado_errores.Descripcion, telemetria_listado_errores.Fecha";
$w2 =" GROUP BY telemetria_listado.Nombre, telemetria_listado_errores.Fecha";

$arrEquipos1 = array();
$arrEquipos1 = db_select_array (false, 'COUNT(telemetria_listado_errores.idErrores) AS Cuenta,telemetria_listado.Nombre AS Equipo,telemetria_listado_errores.Fecha,telemetria_listado_errores.Descripcion,telemetria_listado_errores.Valor_min,telemetria_listado_errores.Valor_max', 'telemetria_listado_errores', 'LEFT JOIN telemetria_listado ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria', $z.$w1, 'telemetria_listado.Nombre ASC, telemetria_listado_errores.Descripcion ASC, telemetria_listado_errores.Fecha ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrEquipos1');

$arrEquipos2 = array();
$arrEquipos2 = db_select_array (false, 'COUNT(telemetria_listado_errores.idErrores) AS Cuenta,telemetria_listado.Nombre AS Equipo,telemetria_listado_errores.Fecha', 'telemetria_listado_errores', 'LEFT JOIN telemetria_listado ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria', $z.$w2, 'telemetria_listado.Nombre ASC, telemetria_listado_errores.Fecha ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrEquipos2');


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


$x = 1;
$arrData = array();
$arrData[$x] = "B"; $x++;
$arrData[$x] = "C"; $x++;
$arrData[$x] = "D"; $x++;
$arrData[$x] = "E"; $x++;
$arrData[$x] = "F"; $x++;
$arrData[$x] = "G"; $x++;
$arrData[$x] = "H"; $x++;
$arrData[$x] = "I"; $x++;
$arrData[$x] = "J"; $x++;
$arrData[$x] = "K"; $x++;
$arrData[$x] = "L"; $x++;
$arrData[$x] = "M"; $x++;
$arrData[$x] = "N"; $x++;
$arrData[$x] = "O"; $x++;
$arrData[$x] = "P"; $x++;
$arrData[$x] = "Q"; $x++;
$arrData[$x] = "R"; $x++;
$arrData[$x] = "S"; $x++;
$arrData[$x] = "T"; $x++;
$arrData[$x] = "U"; $x++;
$arrData[$x] = "V"; $x++;
$arrData[$x] = "W"; $x++;
$arrData[$x] = "X"; $x++;
$arrData[$x] = "Y"; $x++;
$arrData[$x] = "Z"; $x++;
$arrData[$x] = "AA"; $x++;
$arrData[$x] = "AB"; $x++;
$arrData[$x] = "AC"; $x++;
$arrData[$x] = "AD"; $x++;
$arrData[$x] = "AE"; $x++;
$arrData[$x] = "AF"; $x++;
$arrData[$x] = "AG"; $x++;
$arrData[$x] = "AH"; $x++;
$arrData[$x] = "AI"; $x++;
$arrData[$x] = "AJ"; $x++;
$arrData[$x] = "AK"; $x++;
$arrData[$x] = "AL"; $x++;
$arrData[$x] = "AM"; $x++;
$arrData[$x] = "AN"; $x++;
$arrData[$x] = "AO"; $x++;
$arrData[$x] = "AP"; $x++;
$arrData[$x] = "AQ"; $x++;
$arrData[$x] = "AR"; $x++;
$arrData[$x] = "AS"; $x++;
$arrData[$x] = "AT"; $x++;
$arrData[$x] = "AU"; $x++;
$arrData[$x] = "AV"; $x++;
$arrData[$x] = "AW"; $x++;
$arrData[$x] = "AX"; $x++;
$arrData[$x] = "AY"; $x++;
$arrData[$x] = "AZ"; $x++;
$arrData[$x] = "BA"; $x++;
$arrData[$x] = "BB"; $x++;
$arrData[$x] = "BC"; $x++;
$arrData[$x] = "BD"; $x++;
$arrData[$x] = "BE"; $x++;
$arrData[$x] = "BF"; $x++;
$arrData[$x] = "BG"; $x++;
$arrData[$x] = "BH"; $x++;
$arrData[$x] = "BI"; $x++;         
 
/**********************************************************************************/
/*                                    Pagina 1                                    */ 
/**********************************************************************************/           
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Recuento Total de alertas fuera de rango');

//variables
$nn=2;
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, 'Equipo')
            ->setCellValue('B'.$nn, 'Descripcion')
            ->setCellValue('C'.$nn, 'Fecha')
            ->setCellValue('D'.$nn, 'N° Registros')
            ->setCellValue('E'.$nn, 'Minimo Observado')
            ->setCellValue('F'.$nn, 'Maximo Observado');
            
         

//variables
$nn=3;
foreach ($arrEquipos1 as $equip) {
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $equip['Equipo'])
				->setCellValue('B'.$nn, $equip['Descripcion'])
				->setCellValue('C'.$nn, fecha_estandar($equip['Fecha']))
				->setCellValue('D'.$nn, $equip['Cuenta'])
				->setCellValue('E'.$nn, Cantidades($equip['Valor_min'], 2))
				->setCellValue('F'.$nn, Cantidades($equip['Valor_max'], 2));
				
	//Se suma 1
	$nn++;
}
//seteo el nombre de la hoja
$objPHPExcel->getActiveSheet(0)->setTitle('Recuento Total');
//ancho de columnas
$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(80);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(20);
//negrita
$objPHPExcel->getActiveSheet(0)->getStyle('A1:F2')->getFont()->setBold(true);
//Coloreo celdas
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('C6E0B4');
$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');
//coloreo fuentes
$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFont()->getColor()->setRGB('FFFFFF');
//Pongo los bordes
$objPHPExcel->getActiveSheet()->getStyle('A1:F'.$nn)->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '333333')
            )
        )
    )
);


/**********************************************************************************/
/*                                    Pagina 2                                    */ 
/**********************************************************************************/   			
//Se crea nueva hoja
$objPHPExcel->createSheet();

//Titulo columnas
$objPHPExcel->setActiveSheetIndex(1)
			->setCellValue('A1', 'Recuento Total de alertas fuera de rango por Dia');

//variables
$nn=2;
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$nn, 'Equipo');
            

//Creo las columnas            
$ndias = dias_transcurridos($_GET['f_inicio'], $_GET['f_termino']);
for ($i = 1; $i <= $ndias; $i++) {
	$nuevoDia = sumarDias($_GET['f_inicio'],$i);
	$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue($arrData[$i].$nn, Dia_Mes($nuevoDia));
}   

$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue($arrData[$i].$nn, 'Total Registros');
$i++;				
$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue($arrData[$i].$nn, 'Promedio Registros');
				

								                 
/**************************************************************/
//variables
$nn=3;
$ndias = dias_transcurridos($_GET['f_inicio'], $_GET['f_termino']);
//filtro por equipo
filtrar($arrEquipos2, 'Equipo'); 
//recorro los equipos 
foreach($arrEquipos2 as $equipo=>$dias){
	//Nombre del equipo
	$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('A'.$nn, $equipo);
            
	//creo un arreglo
	$DiaActual = array();
	for ($i = 1; $i <= $ndias; $i++) {
		$nuevoDia = sumarDias($_GET['f_inicio'],$i);
		$DiaActual[$i]['fecha'] = $nuevoDia;
		$DiaActual[$i]['valor'] = 0;
	}
	
	//Variables
	$TotalErrores = 0;
	//recorro los dias
	foreach ($dias as $dia) {
		//recorro arreglo
		for ($i = 1; $i <= $ndias; $i++) {
			if(isset($dia['Fecha'])&&$dia['Fecha']==$DiaActual[$i]['fecha']){
				$DiaActual[$i]['valor'] = $DiaActual[$i]['valor'] + $dia['Cuenta'];
				$TotalErrores = $TotalErrores + $dia['Cuenta'];
			}
		}
	}
						
	//recorro los datos guardados

	for ($i = 1; $i <= $ndias; $i++) {
		$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue($arrData[$i].$nn, $DiaActual[$i]['valor']);
	}					
						
	//Creo las columnas  
	$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue($arrData[$i].$nn, $TotalErrores);
	$i++;	
	$ss_to = 0;
	if($ndias!=0){$ss_to = $TotalErrores/$ndias;}			
	$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue($arrData[$i].$nn, cantidades($ss_to, 2));
	
			
	//Se suma 1
	$nn++;
}				
				                       
//seteo el nombre de la hoja
$objPHPExcel->getActiveSheet(1)->setTitle('Recuento Total por Dia');
//negrita
$objPHPExcel->getActiveSheet(1)->getStyle('A1:F2')->getFont()->setBold(true);
//Coloreo celdas
$objPHPExcel->getActiveSheet(1)->getStyle('A1:F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('C6E0B4');
//Pongo los bordes
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$arrData[$i].$nn)->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '333333')
            )
        )
    )
);
//ancho de columnas
$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(60);
for ($i = 1; $i <= $ndias; $i++) {
	$objPHPExcel->getActiveSheet(0)->getColumnDimension($arrData[$i])->setWidth(10);
}
$objPHPExcel->getActiveSheet(0)->getColumnDimension($arrData[$i])->setWidth(20);
$i++;
$objPHPExcel->getActiveSheet(0)->getColumnDimension($arrData[$i])->setWidth(20);






/**********************************************************************************/  
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="CrossCrane - Alertas por Grua.xls"');
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
