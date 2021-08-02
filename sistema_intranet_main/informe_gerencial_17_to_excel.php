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
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
//solo los equipos que tengan el seguimiento activado
if(isset($seguimiento)&&$seguimiento!=''&&$seguimiento!=0){
	$z .= " AND telemetria_listado.id_Geo = ".$seguimiento;
}
//Filtro el sistema al cual pertenece	
$z .= " AND telemetria_listado.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];


//Verifico el tipo de usuario que esta ingresando y el id
$join = "";	
if(isset($_SESSION['usuario']['basic_data']['idTipoUsuario'])&&$_SESSION['usuario']['basic_data']['idTipoUsuario']!=1&&isset($_SESSION['usuario']['basic_data']['idUsuario'])&&$_SESSION['usuario']['basic_data']['idUsuario']!=0){
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";	
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];	
}


//numero sensores equipo
$N_Maximo_Sensores = 72;
$qry = '';
//Recorro la configuracion de los sensores
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$qry .= ', SensoresNombre_'.$i;
	$qry .= ', SensoresMedErrores_'.$i;
	$qry .= ', SensoresErrorActual_'.$i;
	$qry .= ', SensoresActivo_'.$i;
}						
//Listar los equipos
$arrEquipo = array();
$query = "SELECT
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea
".$qry."

FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$join."
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
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
array_push( $arrEquipo,$row );
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
            ->setCellValue('A1', $titulo_cuadro);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Noti')
            ->setCellValue('B3', 'Equipo')
            ->setCellValue('C3', 'Ultima Conexion')
            ->setCellValue('D3', 'Estado');					

                 					                              

  
  
         
$nn=4;
foreach($arrEquipo as $equip) {	
	//Se resetean
	$eq_alertas     = 0; 
	$eq_fueralinea  = 0; 
	$eq_fueraruta   = 0;
	$eq_detenidos   = 0;
	$xx = 0;
	$xy = 0;
	$xz = 0;
	$xw = 0;
	$dataex = '';
											
	$eq_ok = ' Sin Problemas';
	for ($i = 1; $i <= $equip['cantSensores']; $i++) {
		//verifico si sensor esta activo
		if(isset($equip['SensoresActivo_'.$i])&&$equip['SensoresActivo_'.$i]==1){
			//verifico errores
			$xx = $equip['SensoresMedErrores_'.$i] - $equip['SensoresErrorActual_'.$i];
			if($xx<0){$xy = 1;$eq_ok = '';}
		}
	}
	$eq_alertas = $eq_alertas + $xy;
											
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
		$eq_fueralinea = $eq_fueralinea + 1;	
		$eq_ok = '';
	}
											
											
											
	//equipos ok
	if($eq_alertas>0){$eq_ok = '';$xw = 1;$dataex .= ' Con Alertas';}
	if($eq_fueralinea>0){$eq_ok = '';$xz = 1;$dataex .= ' Fuera de Linea';}
											
	$eq_ok .= $dataex;
								
	if($xz!=0){
		$danger = 'Peligro';
	}elseif($xw!=0){
		$danger = 'Alerta';
	}else{
		$danger = 'Normal';
	}	
						
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
