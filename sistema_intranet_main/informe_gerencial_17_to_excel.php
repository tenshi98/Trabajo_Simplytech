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
$titulo_cuadro  = 'Ultimas Mediciones';
$seguimiento    = 2;
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();


//Variable
$SIS_where = "telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$SIS_where .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
$SIS_where .= " AND telemetria_listado.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];


//Verifico el tipo de usuario que esta ingresando y el id
$SIS_join = "LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema";	
if(isset($_SESSION['usuario']['basic_data']['idTipoUsuario'])&&$_SESSION['usuario']['basic_data']['idTipoUsuario']!=1&&isset($_SESSION['usuario']['basic_data']['idUsuario'])&&$_SESSION['usuario']['basic_data']['idUsuario']!=0){
	$SIS_join  .= " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$SIS_where .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];	
}

//Se consultan datos
$SIS_query = '
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NErrores';
$SIS_order = 'telemetria_listado.Nombre ASC';
$arrEquipo = array();
$arrEquipo = db_select_array (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrEquipo');


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
            ->setCellValue('A1', $titulo_cuadro);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Noti')
            ->setCellValue('B3', 'Equipo')
            ->setCellValue('C3', 'Ultima Conexion')
            ->setCellValue('D3', 'Estado');					

                 					                              

  
  
         
$nn=4;
foreach($arrEquipo as $equip) {	
	
	/**********************************************/
	//Se resetean
	$in_eq_alertas     = 0;
	$in_eq_fueralinea  = 0;
																	
	/**********************************************/
	//Fuera de linea
	$diaInicio   = $equip['LastUpdateFecha'];
	$diaTermino  = $FechaSistema;
	$tiempo1     = $equip['LastUpdateHora'];
	$tiempo2     = $HoraSistema;
	//calculo diferencia de dias
	$n_dias = dias_transcurridos($diaInicio,$diaTermino);
	//calculo del tiempo transcurrido
	$Tiempo = restahoras($tiempo1, $tiempo2);
	//Calculo del tiempo transcurrido
	if($n_dias!=0){
		if($n_dias>=2){
			$n_dias = $n_dias-1;
			$horas_trans2 = multHoras('24:00:00',$n_dias);
			$Tiempo = sumahoras($Tiempo,$horas_trans2);
		}
		if($n_dias==1&&$tiempo1<$tiempo2){
			$horas_trans2 = multHoras('24:00:00',$n_dias);
			$Tiempo = sumahoras($Tiempo,$horas_trans2);
		}
	}	
	if($Tiempo>$equip['TiempoFueraLinea']&&$equip['TiempoFueraLinea']!='00:00:00'){	
		$in_eq_fueralinea++;
	}
								
	/**********************************************/
	//NErrores
	if(isset($equip['NErrores'])&&$equip['NErrores']>0){ $in_eq_alertas++; }
										
	/*******************************************************/
	//rearmo
	if($in_eq_alertas>0){    
		$danger = 'Alerta';
		$eq_ok  = ' Con Alertas';
	}elseif($in_eq_fueralinea>0){ 
		$danger = 'Peligro';
		$eq_ok  = ' Fuera de Linea';
	}else{
		$danger = 'Normal';
		$eq_ok  = ' Sin Problemas';
	}
					
	/*******************************************************/
	//imprimo
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $danger)
				->setCellValue('B'.$nn, $equip['Nombre'])
				->setCellValue('C'.$nn, fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs')
				->setCellValue('D'.$nn, $eq_ok);		
	
	$nn++;           
   
} 



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($titulo_cuadro);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$titulo_cuadro.'.xls"');
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
