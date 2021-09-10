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
$rowEmpresa = db_select_data (false, 'Nombre', 'core_sistemas', '', 'idSistema='.$_GET['idSistema'], $dbConn, 'arrEquipos1', basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');

/**********************************************************/
$SIS_where_1 = "telemetria_listado_errores_999.idErrores!=0"; //siempre pasa
$SIS_where_2 = "telemetria_listado_error_fuera_linea.idFueraLinea!=0"; //siempre pasa
if(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino'] != ''&&isset($_GET['h_inicio']) && $_GET['h_inicio'] != ''&&isset($_GET['h_termino']) && $_GET['h_termino'] != ''){ 
	$SIS_where_1.=" AND telemetria_listado_errores_999.TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."'";
	$SIS_where_2.=" AND telemetria_listado_error_fuera_linea.TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."'";
}elseif(isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''&&isset($_GET['f_termino']) && $_GET['f_termino'] != ''){ 
	$SIS_where_1.=" AND telemetria_listado_errores_999.Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
	$SIS_where_2.=" AND telemetria_listado_error_fuera_linea.Fecha_inicio BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){  
	$SIS_where_1.=" AND telemetria_listado_errores_999.idTelemetria=".$_GET['idTelemetria'];
	$SIS_where_2.=" AND telemetria_listado_error_fuera_linea.idTelemetria=".$_GET['idTelemetria'];
}


$N_Maximo_Sensores = 72;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$consql .= ',telemetria_listado.SensoresGrupo_'.$i;
	$consql .= ',telemetria_listado.SensoresNombre_'.$i;
}

/*********************************************************/	
//Consulto								
$SIS_query = '
core_sistemas.Nombre AS Sistema,
telemetria_listado.Nombre AS EquipoNombre,
telemetria_listado_errores_999.idTelemetria AS EquipoId,
core_telemetria_tabs.Nombre AS EquipoTab,
telemetria_listado_errores_999.Sensor AS EquipoNSensor,
COUNT(telemetria_listado_errores_999.idErrores) AS Cuenta,
telemetria_listado_errores_999.Descripcion,
telemetria_listado_errores_999.Valor'.$consql;
$SIS_join  = '
LEFT JOIN telemetria_listado     ON telemetria_listado.idTelemetria  = telemetria_listado_errores_999.idTelemetria
LEFT JOIN core_sistemas          ON core_sistemas.idSistema          = telemetria_listado_errores_999.idSistema
LEFT JOIN core_telemetria_tabs   ON core_telemetria_tabs.idTab       = telemetria_listado.idTab';
$SIS_order = 'core_sistemas.Nombre ASC, telemetria_listado.Nombre ASC, core_telemetria_tabs.Nombre ASC, telemetria_listado_errores_999.Sensor ASC, telemetria_listado_errores_999.Descripcion ASC, telemetria_listado_errores_999.Valor ASC';	
$SIS_where_1.= ' GROUP BY core_sistemas.Nombre, telemetria_listado.Nombre, core_telemetria_tabs.Nombre, telemetria_listado_errores_999.Sensor, telemetria_listado_errores_999.Descripcion, telemetria_listado_errores_999.Valor';

$arrEquipos1 = array();
$arrEquipos1 = db_select_array (false, $SIS_query, 'telemetria_listado_errores_999', $SIS_join, $SIS_where_1, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrEquipos1');

/*********************************************************/	
//Consulto
$SIS_query = '
core_sistemas.Nombre AS Sistema,
telemetria_listado.Nombre AS EquipoNombre,
core_telemetria_tabs.Nombre AS EquipoTab,
telemetria_listado_error_fuera_linea.Fecha_inicio, 
telemetria_listado_error_fuera_linea.Hora_inicio, 
telemetria_listado_error_fuera_linea.Fecha_termino, 
telemetria_listado_error_fuera_linea.Hora_termino, 
telemetria_listado_error_fuera_linea.Tiempo';
$SIS_join  = '
LEFT JOIN telemetria_listado     ON telemetria_listado.idTelemetria  = telemetria_listado_error_fuera_linea.idTelemetria
LEFT JOIN core_sistemas          ON core_sistemas.idSistema          = telemetria_listado_error_fuera_linea.idSistema
LEFT JOIN core_telemetria_tabs   ON core_telemetria_tabs.idTab       = telemetria_listado.idTab';
$SIS_order = 'core_sistemas.Nombre ASC, telemetria_listado.Nombre ASC, core_telemetria_tabs.Nombre ASC, telemetria_listado_error_fuera_linea.Fecha_inicio ASC';	
$arrErrores = array();
$arrErrores = db_select_array (false, $SIS_query, 'telemetria_listado_error_fuera_linea', $SIS_join, $SIS_where_2, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrErrores');


/*********************************************************/	
//Se consultan datos
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre, nColumnas', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGrupos');
				
$arrFinalGrupos = array();
foreach ($arrGrupos as $sen) { 
	$arrFinalGrupos[$sen['idGrupo']] = $sen['Nombre'];
}

/*********************************************************/	
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

  
 
/**********************************************************************************/
/*                                    Pagina 1                                    */ 
/**********************************************************************************/           
//variables
$nn = 1;
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$nn, 'Sistema')
            ->setCellValue('B'.$nn, 'Equipo')
            ->setCellValue('C'.$nn, 'Id Telemetria')
            ->setCellValue('D'.$nn, 'Tab')
            ->setCellValue('E'.$nn, 'Grupo')
            ->setCellValue('F'.$nn, 'Numero Sensor')
            ->setCellValue('G'.$nn, 'Nombre Sensor')
            ->setCellValue('H'.$nn, 'Numero Alertas')
            ->setCellValue('I'.$nn, 'Descripcion');

//variables
$nn = 2;
//Recorro
foreach ($arrEquipos1 as $equip) {
	if(isset($equip['Valor'])&&$equip['Valor']==99900){
	
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, $equip['Sistema'])
					->setCellValue('B'.$nn, $equip['EquipoNombre'])
					->setCellValue('C'.$nn, $equip['EquipoId'])
					->setCellValue('D'.$nn, $equip['EquipoTab'])
					->setCellValue('E'.$nn, $arrFinalGrupos[$equip['SensoresGrupo_'.$equip['EquipoNSensor']]])
					->setCellValue('F'.$nn, $equip['EquipoNSensor'])
					->setCellValue('G'.$nn, $equip['SensoresNombre_'.$equip['EquipoNSensor']])
					->setCellValue('H'.$nn, $equip['Cuenta'])
					->setCellValue('I'.$nn, $equip['Descripcion']);
					
		//Se suma 1
		$nn++;
	}
}
						
//seteo el nombre de la hoja
$objPHPExcel->getActiveSheet(0)->setTitle('99900');
//ancho de columnas
/*$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(80);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(20);*/
//negrita
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I1')->getFont()->setBold(true);
//Coloreo celdas
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');
//coloreo fuentes
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I1')->getFont()->getColor()->setRGB('FFFFFF');
//Pongo los bordes
$objPHPExcel->getActiveSheet(0)->getStyle('A1:I'.$nn)->applyFromArray(
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

//variables
$nn = 1;
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$nn, 'Sistema')
            ->setCellValue('B'.$nn, 'Equipo')
            ->setCellValue('C'.$nn, 'Id Telemetria')
            ->setCellValue('D'.$nn, 'Tab')
            ->setCellValue('E'.$nn, 'Grupo')
            ->setCellValue('F'.$nn, 'Numero Sensor')
            ->setCellValue('G'.$nn, 'Nombre Sensor')
            ->setCellValue('H'.$nn, 'Numero Alertas')
            ->setCellValue('I'.$nn, 'Descripcion');

//variables
$nn = 2;
//Recorro
foreach ($arrEquipos1 as $equip) {
	if(isset($equip['Valor'])&&$equip['Valor']==99901){
	
		$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('A'.$nn, $equip['Sistema'])
					->setCellValue('B'.$nn, $equip['EquipoNombre'])
					->setCellValue('C'.$nn, $equip['EquipoId'])
					->setCellValue('D'.$nn, $equip['EquipoTab'])
					->setCellValue('E'.$nn, $arrFinalGrupos[$equip['SensoresGrupo_'.$equip['EquipoNSensor']]])
					->setCellValue('F'.$nn, $equip['EquipoNSensor'])
					->setCellValue('G'.$nn, $equip['SensoresNombre_'.$equip['EquipoNSensor']])
					->setCellValue('H'.$nn, $equip['Cuenta'])
					->setCellValue('I'.$nn, $equip['Descripcion']);
					
		//Se suma 1
		$nn++;
	}
}
						
//seteo el nombre de la hoja
$objPHPExcel->getActiveSheet(1)->setTitle('99901');
//ancho de columnas
/*$objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(80);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(20);*/
//negrita
$objPHPExcel->getActiveSheet(1)->getStyle('A1:I1')->getFont()->setBold(true);
//Coloreo celdas
$objPHPExcel->getActiveSheet(1)->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');
//coloreo fuentes
$objPHPExcel->getActiveSheet(1)->getStyle('A1:I1')->getFont()->getColor()->setRGB('FFFFFF');
//Pongo los bordes
$objPHPExcel->getActiveSheet(1)->getStyle('A1:I'.$nn)->applyFromArray(
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
/*                                    Pagina 3                                    */ 
/**********************************************************************************/   			
//Se crea nueva hoja
$objPHPExcel->createSheet();

//variables
$nn = 1;
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A'.$nn, 'Sistema')
            ->setCellValue('B'.$nn, 'Equipo')
            ->setCellValue('C'.$nn, 'Tab')
            ->setCellValue('D'.$nn, 'Fecha Inicio')
            ->setCellValue('E'.$nn, 'Hora Inicio')
            ->setCellValue('F'.$nn, 'Fecha Termino')
            ->setCellValue('G'.$nn, 'Hora Termino')
            ->setCellValue('H'.$nn, 'Tiempo');
							
//variables
$nn = 2;
//Recorro
foreach ($arrErrores as $error) {

	
	$objPHPExcel->setActiveSheetIndex(2)
				->setCellValue('A'.$nn, $error['Sistema'])
				->setCellValue('B'.$nn, $error['EquipoNombre'])
				->setCellValue('C'.$nn, $error['EquipoTab'])
				->setCellValue('D'.$nn, $error['Fecha_inicio'])
				->setCellValue('E'.$nn, $error['Hora_inicio'])
				->setCellValue('F'.$nn, $error['Fecha_termino'])
				->setCellValue('G'.$nn, $error['Hora_termino'])
				->setCellValue('H'.$nn, $error['Tiempo']);
					
	//Se suma 1
	$nn++;
									
}
						
//seteo el nombre de la hoja
$objPHPExcel->getActiveSheet(2)->setTitle('Fuera de Linea');
//ancho de columnas
/*$objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setWidth(80);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('G')->setWidth(20);*/
//negrita
$objPHPExcel->getActiveSheet(2)->getStyle('A1:H1')->getFont()->setBold(true);
//Coloreo celdas
$objPHPExcel->getActiveSheet(2)->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000000');
//coloreo fuentes
$objPHPExcel->getActiveSheet(2)->getStyle('A1:H1')->getFont()->getColor()->setRGB('FFFFFF');
//Pongo los bordes
$objPHPExcel->getActiveSheet(2)->getStyle('A1:H'.$nn)->applyFromArray(
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
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Administrador - Alertas 999.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('php://output');
exit;
