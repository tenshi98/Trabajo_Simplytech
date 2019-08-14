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
//obtengo los datos de la empresa
$query = "SELECT Nombre	
FROM `core_sistemas` 
WHERE idSistema = '{$_GET['idSistema']}'  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$rowEmpresa = mysqli_fetch_array ($resultado);

/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_listado_historial_activaciones.idEstado=1";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){       $z.=" AND telemetria_listado_historial_activaciones.idTelemetria =".$_GET['idTelemetria'];}

if(isset($_GET['F_inicio']) && $_GET['F_inicio'] != ''&&isset($_GET['F_termino']) && $_GET['F_termino'] != ''&&isset($_GET['H_inicio']) && $_GET['H_inicio'] != ''&&isset($_GET['H_termino']) && $_GET['H_termino'] != ''){ 
	$z.=" AND telemetria_listado_historial_activaciones.TimeStamp BETWEEN '".$_GET['F_inicio']." ".$_GET['H_inicio']."' AND '".$_GET['F_termino']." ".$_GET['H_termino']."'";
}elseif(isset($_GET['F_inicio']) && $_GET['F_inicio'] != ''&&isset($_GET['F_termino']) && $_GET['F_termino'] != ''){ 
	$z.=" AND telemetria_listado_historial_activaciones.Fecha BETWEEN '{$_GET['F_inicio']}' AND '{$_GET['F_termino']}'";
}
/**********************************************************/
//se consulta
$arrConsulta = array(); 
$query = "SELECT 
telemetria_listado_historial_activaciones.idTelemetria,
telemetria_listado_historial_activaciones.Fecha AS EquipoFecha,
telemetria_listado_historial_activaciones.Hora AS EquipoHora,
telemetria_listado_historial_activaciones.SensorActivacionValor AS EquipoActivacionValor,
telemetria_listado_historial_activaciones.Valor AS EquipoValor,
telemetria_listado_historial_activaciones.idFueraHorario AS FueraHorario,

telemetria_listado.Nombre AS EquipoNombre,
telemetria_listado.Jornada_inicio AS EquipoJornada_inicio,
telemetria_listado.Jornada_termino AS EquipoJornada_termino,
telemetria_listado.Colacion_inicio AS EquipoColacion_inicio,
telemetria_listado.Colacion_termino AS EquipoColacion_termino,
telemetria_listado.Microparada AS EquipoMicroparada,

telemetria_listado_contratos.Codigo AS ContratoCodigo

FROM `telemetria_listado_historial_activaciones`
LEFT JOIN `telemetria_listado`             ON telemetria_listado.idTelemetria          = telemetria_listado_historial_activaciones.idTelemetria
LEFT JOIN `telemetria_listado_contratos`   ON telemetria_listado_contratos.idContrato  = telemetria_listado_historial_activaciones.idContrato
".$z."
ORDER BY telemetria_listado_historial_activaciones.idTelemetria ASC, 
telemetria_listado_historial_activaciones.Fecha ASC, 
telemetria_listado_historial_activaciones.Hora ASC
";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrConsulta,$row );
}

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



            
            
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Equipo')
            ->setCellValue('B1', 'Codigo Interno')
            ->setCellValue('C1', 'Direccion')
            ->setCellValue('D1', 'Fecha')
            ->setCellValue('E1', 'Contrato')
            ->setCellValue('F1', 'Hora Inicio')
            ->setCellValue('G1', 'Hora Termino')
            ->setCellValue('H1', 'Tiempo Colacion')
            ->setCellValue('I1', 'Tiempo Muerto')
            ->setCellValue('J1', 'Tiempo Perdido')
            ->setCellValue('K1', 'Sobre Tiempo');
            
$nn=2;
filtrar($arrConsulta, 'EquipoNombre');
foreach($arrConsulta as $categoria=>$permisos){

	//Variables
	$fecha              = '';
	$HoraInicio         = '';
	$HoraTermino        = '';
	$TiempoColacionIni  = '00:00:00';
	$TiempoColacionTer  = '00:00:00';
	$TiempoColacionTot  = '00:00:00';
	$TiempoMuerto       = '00:00:00';
	$TiempoMuertoTemp   = '00:00:00';
	$TiempoPerdido      = '00:00:00';
	$SobreTiempo_1      = '00:00:00';
	$SobreTiempo_2      = '00:00:00';
	$colacion           = 0;
	$FueraHorario       = 0;
	$Direccion          = '';
	$CodigoInterno      = '';
	$ContratoCodigo     = '';
							
	//Recorrido
	foreach ($permisos as $con) { 
		//Contrato Codigo
		$ContratoCodigo     = $con['ContratoCodigo'];
		$Direccion          = $con['Direccion'];
		$CodigoInterno      = $con['CodigoInterno'];
		
		/*****************************************************************/
		//Verifico si esta dentro del mismo dia
		if($fecha!=''&&$fecha==$con['EquipoFecha']){
			
			/***************************************/
			//Verifico hora inicio
			if($HoraInicio>$con['EquipoHora']&&$con['EquipoValor']==$con['EquipoActivacionValor']){
				$HoraInicio = $con['EquipoHora'];
			}
			//verifico hora termino
			if($HoraTermino<$con['EquipoHora']&&$con['EquipoValor']!=$con['EquipoActivacionValor']){
				$HoraTermino = $con['EquipoHora'];
			}
			/***************************************/
			//verifico la hora de inicio de colacion
			if($con['EquipoColacion_inicio']<=$con['EquipoHora']&&$con['EquipoColacion_termino']>=$con['EquipoHora']&&$con['EquipoValor']!=$con['EquipoActivacionValor']){
				$TiempoColacionIni = $con['EquipoHora'];
				$colacion = 1;
			}
			//se verifica el termino de la colacion
			if($colacion==1&&$TiempoColacionTot=='00:00:00'&&$con['EquipoValor']==$con['EquipoActivacionValor']){
				//reseteo
				$colacion = 0;
				$TiempoColacionTer = $con['EquipoHora'];
				//Calculo colacion
				$Tiempo = restahoras($TiempoColacionIni, $TiempoColacionTer);
				if($Tiempo>'00:30:00'){
					$TiempoColacionTot = $Tiempo;
				}
										
			}						
			/***************************************/
			//Verifico el tiempo muerto
			if($con['EquipoValor']!=$con['EquipoActivacionValor']){
				$TiempoMuertoTemp  = $con['EquipoHora'];
			}
			if($con['EquipoValor']==$con['EquipoActivacionValor']&&$TiempoMuertoTemp!='00:00:00'){
				//calculo los tiempos
				$Tiempo = restahoras($TiempoMuertoTemp ,$con['EquipoHora']);
				//verifico que sea superior a la microparadas
				if($Tiempo>=$con['EquipoMicroparada']){
					$TiempoMuerto = sumahoras($TiempoMuerto,$Tiempo);
					//le resto el tiempo de colacion solo si el tiempo muerto es igual o superior
					if($TiempoMuerto>=$TiempoColacionTot){
						$TiempoMuerto = restahoras($TiempoColacionTot ,$TiempoMuerto);
					}
				}
			}
									
			/***************************************/
			//Verifico el sobretiempo
			if($SobreTiempo_1=='00:00:00'&&$con['EquipoJornada_inicio']>=$con['EquipoHora']&&$con['EquipoValor']==$con['EquipoActivacionValor']){
				$SobreTiempo_1 = sumahoras($SobreTiempo_1, restahoras($con['EquipoHora'], $con['EquipoJornada_inicio']));
			}
			if($con['EquipoJornada_termino']<=$con['EquipoHora']&&$con['EquipoValor']!=$con['EquipoActivacionValor']){
				$SobreTiempo_2 = restahoras($con['EquipoJornada_termino'],$con['EquipoHora'] );
			}
									
			/***************************************/
			//Verifico si tiene algun dato que figure como fuera de horario
			if(isset($con['FueraHorario'])&&$con['FueraHorario']!=0){
				$FueraHorario++;
			}
			
		/*****************************************************************/
		//Si cambia de dia
		}elseif($fecha!=''&&$fecha!=$con['EquipoFecha']){ 
			
			//Calculo de la perdida de tiempo
			if($con['EquipoJornada_inicio']<=$HoraInicio){
				$TiempoPerdido = sumahoras($TiempoPerdido, restahoras($con['EquipoJornada_inicio'], $HoraInicio));
			}
			if($con['EquipoJornada_termino']>=$HoraTermino){
				$TiempoPerdido = sumahoras($TiempoPerdido, restahoras($HoraTermino, $con['EquipoJornada_termino'] ));
			}
			
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, $categoria)
					->setCellValue('B'.$nn, $CodigoInterno)
					->setCellValue('C'.$nn, $Direccion)
					->setCellValue('D'.$nn, fecha_estandar($fecha))
					->setCellValue('E'.$nn, $ContratoCodigo)
					->setCellValue('F'.$nn, $HoraInicio)
					->setCellValue('G'.$nn, $HoraTermino)
					->setCellValue('H'.$nn, $TiempoColacionTot)
					->setCellValue('I'.$nn, $TiempoMuerto)
					->setCellValue('J'.$nn, $TiempoPerdido)
					->setCellValue('K'.$nn, sumahoras($SobreTiempo_1,$SobreTiempo_2));
			$nn++;
			
			//redeclaro variables
			$fecha              = $con['EquipoFecha'];
			$HoraInicio         = $con['EquipoHora'];
			$HoraTermino        = $con['EquipoHora'];
			$TiempoColacionIni  = '00:00:00';
			$TiempoColacionTer  = '00:00:00';
			$TiempoColacionTot  = '00:00:00';
			$TiempoMuerto       = '00:00:00';
			$TiempoMuertoTemp   = '00:00:00';
			$TiempoPerdido      = '00:00:00';
			$SobreTiempo_1      = '00:00:00';
			$SobreTiempo_2      = '00:00:00';
			$colacion           = 0;
			$FueraHorario       = 0;

			/***************************************/
			//Verifico el sobretiempo
			if($SobreTiempo_1=='00:00:00'&&$con['EquipoJornada_inicio']>=$con['EquipoHora']&&$con['EquipoValor']==$con['EquipoActivacionValor']){
				$SobreTiempo_1 = sumahoras($SobreTiempo_1, restahoras($con['EquipoHora'], $con['EquipoJornada_inicio']));
			}
			if($con['EquipoJornada_termino']<=$con['EquipoHora']&&$con['EquipoValor']!=$con['EquipoActivacionValor']){
				$SobreTiempo_2 = restahoras($con['EquipoJornada_termino'],$con['EquipoHora'] );
			}
			/***************************************/
			//Verifico si tiene algun dato que figure como fuera de horario
			if(isset($con['FueraHorario'])&&$con['FueraHorario']!=0){
				$FueraHorario++;
			}
									
		/*****************************************************************/
		//Primer dato
		}else{
			$fecha              = $con['EquipoFecha'];
			$HoraInicio         = $con['EquipoHora'];
			$HoraTermino        = $con['EquipoHora'];
			$TiempoColacionIni  = '00:00:00';
			$TiempoColacionTer  = '00:00:00';
			$TiempoColacionTot  = '00:00:00';
			$TiempoMuerto       = '00:00:00';
			$TiempoMuertoTemp   = '00:00:00';
			$TiempoPerdido      = '00:00:00';
			$SobreTiempo_1      = '00:00:00';
			$SobreTiempo_2      = '00:00:00';
			$colacion           = 0;
			$FueraHorario       = 0;
			$Direccion          = $con['Direccion'];
			$CodigoInterno      = $con['CodigoInterno'];
			
			/***************************************/
			//Verifico el sobretiempo
			if($SobreTiempo_1=='00:00:00'&&$con['EquipoJornada_inicio']>=$con['EquipoHora']&&$con['EquipoValor']==$con['EquipoActivacionValor']){
				$SobreTiempo_1 = sumahoras($SobreTiempo_1, restahoras($con['EquipoHora'], $con['EquipoJornada_inicio']));
			}
			if($con['EquipoJornada_termino']<=$con['EquipoHora']&&$con['EquipoValor']!=$con['EquipoActivacionValor']){
				$SobreTiempo_2 = restahoras($con['EquipoJornada_termino'],$con['EquipoHora'] );
			}
			/***************************************/
			//Verifico si tiene algun dato que figure como fuera de horario
			if(isset($con['FueraHorario'])&&$con['FueraHorario']!=0){
				$FueraHorario++;
			}
					
		}
								
		$l_ejti = $con['EquipoJornada_inicio'];
		$l_ejtt = $con['EquipoJornada_termino'];
		$l_mp   = $con['EquipoMicroparada'];
		$l_v1   = $con['EquipoValor'];
		$l_v2   = $con['EquipoActivacionValor'];
						
	} 
	/**********************************************************************************/
	//ultimo dato
	//Calculo colacion
	//$TiempoColacionTot = restahoras($TiempoColacionIni, $TiempoColacionTer);
	//Calculo de la perdida de tiempo
	if($l_ejti<=$HoraInicio){
		$TiempoPerdido = sumahoras($TiempoPerdido, restahoras($l_ejti, $HoraInicio));
	}
	if($l_ejtt>=$HoraTermino){
		$TiempoPerdido = sumahoras($TiempoPerdido, restahoras($HoraTermino, $l_ejtt ));
	}
	//Verifico el sobretiempo
	if($l_ejti>=$HoraInicio&&$l_v1==$l_v2){
		$SobreTiempo_1 = sumahoras($SobreTiempo_1, restahoras($HoraInicio,$l_ejti));
	}
	if($l_ejtt<=$HoraInicio&&$l_v1!=$l_v2){
		$SobreTiempo_2 = sumahoras($SobreTiempo_2, restahoras($l_ejtt,$HoraInicio ));
	}	
	
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$nn, $categoria)
					->setCellValue('B'.$nn, $CodigoInterno)
					->setCellValue('C'.$nn, $Direccion)
					->setCellValue('D'.$nn, fecha_estandar($fecha))
					->setCellValue('E'.$nn, $ContratoCodigo)
					->setCellValue('F'.$nn, $HoraInicio)
					->setCellValue('G'.$nn, $HoraTermino)
					->setCellValue('H'.$nn, $TiempoColacionTot)
					->setCellValue('I'.$nn, $TiempoMuerto)
					->setCellValue('J'.$nn, $TiempoPerdido)
					->setCellValue('K'.$nn, sumahoras($SobreTiempo_1,$SobreTiempo_2));
	$nn++;		
		
}		




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Activaciones');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Informe Activaciones.xls"');
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
