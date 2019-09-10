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
$z = "WHERE cross_solicitud_aplicacion_listado.idSolicitud!=0";
//Verifico el tipo de usuario que esta ingresando
$z.= " AND cross_solicitud_aplicacion_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){                  $z .= " AND cross_solicitud_aplicacion_listado_cuarteles.idZona=".$_GET['idZona'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $z .= " AND cross_solicitud_aplicacion_listado.idProducto=".$_GET['idProducto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND cross_solicitud_aplicacion_listado.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idEstado=".$_GET['idEstado'];}
if(isset($_GET['f_programacion_desde'])&&$_GET['f_programacion_desde']!=''&&isset($_GET['f_programacion_hasta'])&&$_GET['f_programacion_hasta']!=''){
	$z.=" AND cross_solicitud_aplicacion_listado.f_programacion BETWEEN '{$_GET['f_programacion_desde']}' AND '{$_GET['f_programacion_hasta']}'";
}
if(isset($_GET['f_ejecucion_desde'])&&$_GET['f_ejecucion_desde']!=''&&isset($_GET['f_ejecucion_hasta'])&&$_GET['f_ejecucion_hasta']!=''){
	$z.=" AND cross_solicitud_aplicacion_listado.f_ejecucion BETWEEN '{$_GET['f_ejecucion_desde']}' AND '{$_GET['f_ejecucion_hasta']}'";
}
if(isset($_GET['f_termino_desde'])&&$_GET['f_termino_desde']!=''&&isset($_GET['f_termino_hasta'])&&$_GET['f_termino_hasta']!=''){
	$z.=" AND cross_solicitud_aplicacion_listado.f_termino BETWEEN '{$_GET['f_termino_desde']}' AND '{$_GET['f_termino_hasta']}'";
}
// Se trae un listado con todos los usuarios
$arrOTS = array();
$query = "SELECT 
sistema_variedades_categorias.Nombre AS EspecieNombre,
variedades_listado.Nombre AS VariedadNombre,
cross_solicitud_aplicacion_listado.idSolicitud,
cross_predios_listado.Nombre AS PredioNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.Hectareas AS CuartelHectareas,
cross_solicitud_aplicacion_listado.f_termino,
cross_solicitud_aplicacion_listado.f_termino_fin,
cross_predios_listado_zonas.Plantas AS CuartelPlantas,
cross_checking_estado_fenologico.Nombre AS EstadoFenologico,
core_estado_solicitud.Nombre AS EstadoSolicitud,
core_estado_ejecucion.Nombre AS EstadoEjecucion,

cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,
cross_solicitud_aplicacion_listado_cuarteles.idCuarteles AS ID_1,
cross_solicitud_aplicacion_listado_cuarteles.VelTractor,
(SELECT SUM(GeoDistance)                                          FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS GeoDistance,
(SELECT AVG(NULLIF(IF(GeoVelocidadProm!=0,GeoVelocidadProm,0),0)) FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS VelPromedio,
(SELECT AVG(NULLIF(IF(Sensor_1_Prom!=0,Sensor_1_Prom,0),0))       FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS CaudalDerecho,
(SELECT AVG(NULLIF(IF(Sensor_2_Prom!=0,Sensor_2_Prom,0),0))       FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS CaudalIzquierdo,
(SELECT SUM(Diferencia)                                           FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS LitrosAplicados,
(SELECT AVG(NULLIF(IF(Sensor_4_Prom!=0,Sensor_4_Prom,0),0))       FROM `cross_solicitud_aplicacion_listado_tractores` WHERE idCuarteles=ID_1 LIMIT 1 ) AS PH

FROM `cross_solicitud_aplicacion_listado`

LEFT JOIN `cross_predios_listado`                          ON cross_predios_listado.idPredio                             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `usuarios_listado`                               ON usuarios_listado.idUsuario                                 = cross_solicitud_aplicacion_listado.idUsuario
LEFT JOIN `core_estado_solicitud`                          ON core_estado_solicitud.idEstado                             = cross_solicitud_aplicacion_listado.idEstado
LEFT JOIN `cross_checking_estado_fenologico`               ON cross_checking_estado_fenologico.idEstadoFen               = cross_solicitud_aplicacion_listado.idEstadoFen
LEFT JOIN `sistema_variedades_categorias`                  ON sistema_variedades_categorias.idCategoria                  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                             ON variedades_listado.idProducto                              = cross_solicitud_aplicacion_listado.idProducto
LEFT JOIN `trabajadores_listado`     dosificador           ON dosificador.idTrabajador                                   = cross_solicitud_aplicacion_listado.idDosificador
LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`   ON cross_solicitud_aplicacion_listado_cuarteles.idSolicitud   = cross_solicitud_aplicacion_listado.idSolicitud
LEFT JOIN `cross_predios_listado_zonas`                    ON cross_predios_listado_zonas.idZona                         = cross_solicitud_aplicacion_listado_cuarteles.idZona
LEFT JOIN `core_estado_ejecucion`                          ON core_estado_ejecucion.idEjecucion                          = cross_solicitud_aplicacion_listado_cuarteles.idEjecucion

".$z;
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
array_push( $arrOTS,$row );
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
			->setCellValue('A1', 'Cross Checking - Exportar Datos');

//variables
$nn=2;
//Titulo columnas
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$nn, 'Predio')
            ->setCellValue('B'.$nn, 'Especie')
            ->setCellValue('C'.$nn, 'Variedad')
            ->setCellValue('D'.$nn, '# Solicitud')
            ->setCellValue('E'.$nn, 'Cuartel')
            ->setCellValue('F'.$nn, 'Hectáreas')
            ->setCellValue('G'.$nn, 'Plantas cuartel')
            ->setCellValue('H'.$nn, 'Estado Fenologico')
            ->setCellValue('I'.$nn, 'Estado Solicitud')
            ->setCellValue('J'.$nn, 'Estado Ejecucion')
            ->setCellValue('K'.$nn, 'Fecha Programacion Inicio')
            ->setCellValue('L'.$nn, 'Fin Aplicación')
            ->setCellValue('M'.$nn, 'Plantas aplicadas')
            ->setCellValue('N'.$nn, 'Veloc. Recomendada')
            ->setCellValue('O'.$nn, 'Veloc. Promedio')
            ->setCellValue('P'.$nn, 'Caudal Izquierdo')
            ->setCellValue('Q'.$nn, 'Caudal Derecho')
            ->setCellValue('R'.$nn, 'lts. Aplicados')
			->setCellValue('S'.$nn, 'Lts. Hectarias')
            ->setCellValue('T'.$nn, 'PH');
            

//variables
$nn=3;
foreach ($arrOTS as $temp) {
	//se verifica plantas faltantes
	if(isset($temp['GeoDistance'])&&$temp['GeoDistance']!=0){
		$aplicadas = (($temp['GeoDistance']*1000)/$temp['CuartelDistanciaPlant']);
		if($aplicadas<0){
			$aplicadas = 0;
		}
	}else{
		$aplicadas = 0;
	}
	//calculo de los litros por hectarea
	if(isset($temp['CuartelHectareas'])&&$temp['CuartelHectareas']!=''&&$temp['CuartelHectareas']!=0){
		$litrosxhectarea = $temp['LitrosAplicados'] / $temp['CuartelHectareas'];
	}else{
		$litrosxhectarea = 0;
	}
										
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $temp['PredioNombre'])
				->setCellValue('B'.$nn, $temp['EspecieNombre'])
				->setCellValue('C'.$nn, $temp['VariedadNombre'])
				->setCellValue('D'.$nn, $temp['idSolicitud'])
				->setCellValue('E'.$nn, $temp['CuartelNombre'])
				->setCellValue('F'.$nn, $temp['CuartelHectareas'])
				->setCellValue('G'.$nn, $temp['CuartelPlantas'])
				->setCellValue('H'.$nn, $temp['EstadoFenologico'])
				->setCellValue('I'.$nn, $temp['EstadoSolicitud'])
				->setCellValue('J'.$nn, $temp['EstadoEjecucion'])
				->setCellValue('K'.$nn, $temp['f_termino'])
				->setCellValue('L'.$nn, $temp['f_termino_fin'])
				->setCellValue('M'.$nn, $aplicadas)
				->setCellValue('N'.$nn, $temp['VelTractor'])
				->setCellValue('O'.$nn, $temp['VelPromedio'])
				->setCellValue('P'.$nn, $temp['CaudalDerecho'])
				->setCellValue('Q'.$nn, $temp['CaudalIzquierdo'])
				->setCellValue('R'.$nn, $temp['LitrosAplicados'])
				->setCellValue('S'.$nn, $litrosxhectarea)
				->setCellValue('T'.$nn, $temp['PH']);


	//Se suma 1
	$nn++;
}

				
				
				                       




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Exportacion');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Resumen Aplicación por estado de solicitud.xls"');
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
