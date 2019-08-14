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
$z.= " AND cross_solicitud_aplicacion_listado.idSistema={$_GET['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){                  $z .= " AND cross_solicitud_aplicacion_listado.idZona=".$_GET['idZona'];}
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
/**********************************************************/
// Se trae un listado con todos los usuarios
$arrOTS = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado.f_creacion,
cross_solicitud_aplicacion_listado.f_programacion,
cross_solicitud_aplicacion_listado.f_ejecucion,
cross_solicitud_aplicacion_listado.f_termino,
cross_solicitud_aplicacion_listado.f_programacion_fin,
cross_solicitud_aplicacion_listado.f_ejecucion_fin,
cross_solicitud_aplicacion_listado.f_termino_fin,
cross_solicitud_aplicacion_listado.horaProg,
cross_solicitud_aplicacion_listado.horaEjecucion,
cross_solicitud_aplicacion_listado.horaTermino,
cross_solicitud_aplicacion_listado.horaProg_fin,
cross_solicitud_aplicacion_listado.horaEjecucion_fin,
cross_solicitud_aplicacion_listado.horaTermino_fin,

cross_predios_listado.Nombre AS NombrePredio,
core_estado_solicitud.Nombre AS Estado,
sistema_variedades_categorias.Nombre AS VariedadCat,
variedades_listado.Nombre AS VariedadNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.AnoPlantacion AS CuartelAnoPlantacion,
cross_predios_listado_zonas.Hectareas AS CuartelHectareas,
cross_predios_listado_zonas.Hileras AS CuartelHileras,
cross_predios_listado_zonas.Plantas AS CuartelPlantas,
cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,
cross_predios_listado_zonas.DistanciaHileras AS CuartelDistanciaHileras,
core_cross_estados_productivos.Nombre AS CuartelEstadoProd,
cross_checking_estado_fenologico.Codigo AS EstadoFenCodigo,
cross_checking_estado_fenologico.Nombre AS EstadoFenNombre,
cross_solicitud_aplicacion_listado_cuarteles.f_cierre AS Cuartelf_cierre,
cross_solicitud_aplicacion_listado_cuarteles.Mojamiento AS CuartelMojamiento,
cross_solicitud_aplicacion_listado_cuarteles.VelTractor AS CuartelVelTractor,
cross_solicitud_aplicacion_listado_cuarteles.VelViento AS CuartelVelViento,
cross_solicitud_aplicacion_listado_cuarteles.TempMin AS CuartelTempMin,
cross_solicitud_aplicacion_listado_cuarteles.TempMax AS CuartelTempMax,
vehiculos_listado.Marca AS Vehiculo_Marca,
telemetria_listado.Identificador AS Telem_Identificador,
telemetria_listado.Capacidad AS Telem_Capacidad,
cross_solicitud_aplicacion_listado_tractores.Diferencia AS Telem_Diferencia,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMin AS Telem_GeoVelocidadMin,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMax AS Telem_GeoVelocidadMax,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadProm AS Telem_GeoVelocidadProm,
cross_solicitud_aplicacion_listado_tractores.GeoDistance AS Telem_GeoDistance,
cross_solicitud_aplicacion_listado_tractores.Sensor_1_Prom AS Telem_Sensor_1_Prom,
cross_solicitud_aplicacion_listado_tractores.Sensor_2_Prom AS Telem_Sensor_2_Prom,
cross_solicitud_aplicacion_listado_tractores.Sensor_1_Min AS Telem_Sensor_1_Min,
cross_solicitud_aplicacion_listado_tractores.Sensor_2_Min AS Telem_Sensor_2_Min,
cross_solicitud_aplicacion_listado_tractores.Sensor_1_Max AS Telem_Sensor_1_Max,
cross_solicitud_aplicacion_listado_tractores.Sensor_2_Max AS Telem_Sensor_2_Max,
cross_solicitud_aplicacion_listado_tractores.Sensor_1_Sum AS Telem_Sensor_1_Sum,
cross_solicitud_aplicacion_listado_tractores.Sensor_2_Sum AS Telem_Sensor_2_Sum,
dosificador.Rut AS DosificadorRut,
dosificador.Nombre AS DosificadorNombre,
dosificador.ApellidoPat AS DosificadorApellidoPat,
conductor.Rut AS ConductorRut,
conductor.Nombre AS ConductorNombre,
conductor.ApellidoPat AS ConductorApellidoPat,
usuarios_listado.Nombre AS NombreUsuario,
cross_checking_temporada.Codigo AS TemporadaCodigo,
cross_checking_temporada.Nombre AS TemporadaNombre,
core_cross_prioridad.Nombre AS NombrePrioridad,

sistema_productos_categorias.Nombre AS ProductoCategoria,
productos_listado.Nombre AS ProductoNombre,
productos_listado.EfectoResidual AS ProductoEfectoResidual,
productos_listado.EfectoRetroactivo AS ProductoEfectoRetroactivo,
productos_listado.CarenciaExportador AS ProductoCarenciaExportador,
sistema_productos_uml.Nombre AS ProductoUniMed,
cross_solicitud_aplicacion_listado_productos.DosisRecomendada AS ProductoDosisRecomendada,
cross_solicitud_aplicacion_listado_productos.DosisAplicar AS ProductoDosisAplicar,
cross_solicitud_aplicacion_listado_productos.Objetivo AS ProductoObjetivo



FROM `cross_solicitud_aplicacion_listado`

LEFT JOIN `cross_predios_listado`                          ON cross_predios_listado.idPredio                             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `usuarios_listado`                               ON usuarios_listado.idUsuario                                 = cross_solicitud_aplicacion_listado.idUsuario
LEFT JOIN `core_estado_solicitud`                          ON core_estado_solicitud.idEstado                             = cross_solicitud_aplicacion_listado.idEstado
LEFT JOIN `cross_checking_temporada`                       ON cross_checking_temporada.idTemporada                       = cross_solicitud_aplicacion_listado.idTemporada
LEFT JOIN `cross_checking_estado_fenologico`               ON cross_checking_estado_fenologico.idEstadoFen               = cross_solicitud_aplicacion_listado.idEstadoFen
LEFT JOIN `sistema_variedades_categorias`                  ON sistema_variedades_categorias.idCategoria                  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                             ON variedades_listado.idProducto                              = cross_solicitud_aplicacion_listado.idProducto
LEFT JOIN `core_cross_prioridad`                           ON core_cross_prioridad.idPrioridad                           = cross_solicitud_aplicacion_listado.idPrioridad
LEFT JOIN `trabajadores_listado`     dosificador           ON dosificador.idTrabajador                                   = cross_solicitud_aplicacion_listado.idDosificador
LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`   ON cross_solicitud_aplicacion_listado_cuarteles.idSolicitud   = cross_solicitud_aplicacion_listado.idSolicitud
LEFT JOIN `cross_predios_listado_zonas`                    ON cross_predios_listado_zonas.idZona                         = cross_solicitud_aplicacion_listado_cuarteles.idZona
LEFT JOIN `core_cross_estados_productivos`                 ON core_cross_estados_productivos.idEstadoProd                = cross_predios_listado_zonas.idEstadoProd
LEFT JOIN `cross_solicitud_aplicacion_listado_tractores`   ON cross_solicitud_aplicacion_listado_tractores.idCuarteles   = cross_solicitud_aplicacion_listado_cuarteles.idCuarteles
LEFT JOIN `telemetria_listado`                             ON telemetria_listado.idTelemetria                            = cross_solicitud_aplicacion_listado_tractores.idTelemetria
LEFT JOIN `vehiculos_listado`                              ON vehiculos_listado.idVehiculo                               = cross_solicitud_aplicacion_listado_tractores.idVehiculo
LEFT JOIN `trabajadores_listado`       conductor           ON conductor.idTrabajador                                     = cross_solicitud_aplicacion_listado_tractores.idTrabajador
LEFT JOIN `cross_solicitud_aplicacion_listado_productos`   ON cross_solicitud_aplicacion_listado_productos.idCuarteles   = cross_solicitud_aplicacion_listado_cuarteles.idCuarteles
LEFT JOIN `productos_listado`                              ON productos_listado.idProducto                               = cross_solicitud_aplicacion_listado_productos.idProducto
LEFT JOIN `sistema_productos_categorias`                   ON sistema_productos_categorias.idCategoria                   = productos_listado.idCategoria
LEFT JOIN `sistema_productos_uml`                          ON sistema_productos_uml.idUml                                = cross_solicitud_aplicacion_listado_productos.idUml

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
            ->setCellValue('B'.$nn, 'N° Solicitud')
            ->setCellValue('C'.$nn, 'Estado')
            ->setCellValue('D'.$nn, 'Especie/Variedad')
            ->setCellValue('E'.$nn, 'Cuartel')
            ->setCellValue('F'.$nn, 'Año Plantacion')
            ->setCellValue('G'.$nn, 'Hectareas')
            ->setCellValue('H'.$nn, 'Hileras')
            ->setCellValue('I'.$nn, 'Plantas')
            ->setCellValue('J'.$nn, 'Distancia Plant')
            ->setCellValue('K'.$nn, 'Distancia Hileras')
            ->setCellValue('L'.$nn, 'Estado Prod')
            ->setCellValue('M'.$nn, 'Estado Fenologico')
            ->setCellValue('N'.$nn, 'Fecha creación')
            ->setCellValue('O'.$nn, 'Solicitud Fecha Inicio')
            ->setCellValue('P'.$nn, 'Solicitud Hora Inicio')
            ->setCellValue('Q'.$nn, 'Solicitud Fecha Termino')
            ->setCellValue('R'.$nn, 'Solicitud Hora Termino')
            ->setCellValue('S'.$nn, 'Programacion Fecha Inicio')
            ->setCellValue('T'.$nn, 'Programacion Hora Inicio')
            ->setCellValue('U'.$nn, 'Programacion Fecha Termino')
            ->setCellValue('V'.$nn, 'Programacion Hora Termino')
            ->setCellValue('W'.$nn, 'Termino Fecha Inicio')
            ->setCellValue('X'.$nn, 'Termino Hora Inicio')
            ->setCellValue('Y'.$nn, 'Termino Fecha Termino')
            ->setCellValue('Z'.$nn, 'Termino Hora Termino')
            ->setCellValue('AA'.$nn, 'Fecha de Cierre')
            ->setCellValue('AB'.$nn, 'Vel Tractor')
            ->setCellValue('AC'.$nn, 'Vel Viento')
            ->setCellValue('AD'.$nn, 'Temp Min')
            ->setCellValue('AE'.$nn, 'Temp Max')
            ->setCellValue('AF'.$nn, 'Codigo Tractor')
            ->setCellValue('AG'.$nn, 'Identificardor Interno')
            ->setCellValue('AH'.$nn, 'Capacidad Estanque')
            ->setCellValue('AI'.$nn, 'Velocidad Min')
            ->setCellValue('AJ'.$nn, 'Velocidad Max')
            ->setCellValue('AK'.$nn, 'Velocidad Prom')
            ->setCellValue('AL'.$nn, 'Distancia recorridas (mtrs.)')
            ->setCellValue('AM'.$nn, 'Categoria Prod Quimico')
            ->setCellValue('AN'.$nn, 'Codigo Prod Quimico')
            ->setCellValue('AO'.$nn, 'Unidad de medida')
            ->setCellValue('AP'.$nn, 'Dosis Recomendada')
            ->setCellValue('AQ'.$nn, 'Dosis Aplicada')
            ->setCellValue('AR'.$nn, 'Efecto Recidual')
            ->setCellValue('AS'.$nn, 'Efecto Retroactivo')
            ->setCellValue('AT'.$nn, 'Carencia Exportador')
            ->setCellValue('AU'.$nn, 'Maquinadas')
            ->setCellValue('AV'.$nn, 'lts. Aplicados')
            ->setCellValue('AW'.$nn, 'Mojamiento')
            ->setCellValue('AX'.$nn, 'Objetivo de la Aplicacion')
            ->setCellValue('AY'.$nn, 'Telem Sensor 1 Prom')
            ->setCellValue('AZ'.$nn, 'Telem Sensor 1 Min')
            ->setCellValue('BA'.$nn, 'Telem Sensor 1 Max')
            ->setCellValue('BB'.$nn, 'Telem Sensor 2 Prom')
            ->setCellValue('BC'.$nn, 'Telem Sensor 2 Min')
            ->setCellValue('BD'.$nn, 'Telem Sensor 2 Max')
            ->setCellValue('BE'.$nn, 'Dosificador')
            ->setCellValue('BF'.$nn, 'Conductor')
            ->setCellValue('BG'.$nn, 'Usuario creador')
            ->setCellValue('BH'.$nn, 'Temporada')
            ->setCellValue('BI'.$nn, 'Prioridad')
            ;

//variables
$nn=3;
foreach ($arrOTS as $ot) {
	//
	if(isset($ot['Telem_Capacidad'])&&$ot['Telem_Capacidad']!=0){
		$sdata1 = $ot['Telem_Diferencia']/$ot['Telem_Capacidad'];
	}else{
		$sdata1 = 'Capacidad con valor 0';
	}
	$sdata2 = ($ot['Telem_Sensor_1_Sum']+$ot['Telem_Sensor_2_Sum']);
	//
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, $ot['NombrePredio'])
				->setCellValue('B'.$nn, $ot['idSolicitud'])
				->setCellValue('C'.$nn, $ot['Estado'])
				->setCellValue('D'.$nn, $ot['VariedadCat'].'/'.$ot['VariedadNombre'])
				->setCellValue('E'.$nn, $ot['CuartelNombre'])
				->setCellValue('F'.$nn, $ot['CuartelAnoPlantacion'])
				->setCellValue('G'.$nn, $ot['CuartelHectareas'])
				->setCellValue('H'.$nn, $ot['CuartelHileras'])
				->setCellValue('I'.$nn, $ot['CuartelPlantas'])
				->setCellValue('J'.$nn, $ot['CuartelDistanciaPlant'])
				->setCellValue('K'.$nn, $ot['CuartelDistanciaHileras'])
				->setCellValue('L'.$nn, $ot['CuartelEstadoProd'])
				->setCellValue('M'.$nn, $ot['EstadoFenCodigo'].' '.$ot['EstadoFenNombre'])
				->setCellValue('N'.$nn, $ot['f_creacion'])
				->setCellValue('O'.$nn, $ot['f_programacion'])
				->setCellValue('P'.$nn, $ot['horaProg'])
				->setCellValue('Q'.$nn, $ot['f_programacion_fin'])
				->setCellValue('R'.$nn, $ot['horaProg_fin'])
				->setCellValue('S'.$nn, $ot['f_ejecucion'])
				->setCellValue('T'.$nn, $ot['horaEjecucion'])
				->setCellValue('U'.$nn, $ot['f_ejecucion_fin'])
				->setCellValue('V'.$nn, $ot['horaEjecucion_fin'])
				->setCellValue('W'.$nn, $ot['f_termino'])
				->setCellValue('X'.$nn, $ot['horaTermino'])
				->setCellValue('Y'.$nn, $ot['f_termino_fin'])
				->setCellValue('Z'.$nn, $ot['horaTermino_fin'])
				->setCellValue('AA'.$nn, $ot['Cuartelf_cierre'])
				->setCellValue('AB'.$nn, $ot['CuartelVelTractor'])
				->setCellValue('AC'.$nn, $ot['CuartelVelViento'])
				->setCellValue('AD'.$nn, $ot['CuartelTempMin'])
				->setCellValue('AE'.$nn, $ot['CuartelTempMax'])
				->setCellValue('AF'.$nn, $ot['Vehiculo_Marca'])
				->setCellValue('AG'.$nn, $ot['Telem_Identificador'])
				->setCellValue('AH'.$nn, $ot['Telem_Capacidad'])
				->setCellValue('AI'.$nn, $ot['Telem_GeoVelocidadMin'])
				->setCellValue('AJ'.$nn, $ot['Telem_GeoVelocidadMax'])
				->setCellValue('AK'.$nn, $ot['Telem_GeoVelocidadProm'])
				->setCellValue('AL'.$nn, $ot['Telem_GeoDistance'])
				->setCellValue('AM'.$nn, $ot['ProductoCategoria'])
				->setCellValue('AN'.$nn, $ot['ProductoNombre'])
				->setCellValue('AO'.$nn, $ot['ProductoUniMed'])
				->setCellValue('AP'.$nn, $ot['ProductoDosisRecomendada'])
				->setCellValue('AQ'.$nn, $ot['ProductoDosisAplicar'])
				->setCellValue('AR'.$nn, $ot['ProductoEfectoResidual'])
				->setCellValue('AS'.$nn, $ot['ProductoEfectoRetroactivo'])
				->setCellValue('AT'.$nn, $ot['ProductoCarenciaExportador'])
				->setCellValue('AU'.$nn, $sdata1)
				->setCellValue('AV'.$nn, $sdata2)
				->setCellValue('AW'.$nn, $ot['CuartelMojamiento'])
				->setCellValue('AX'.$nn, $ot['ProductoObjetivo'])
				->setCellValue('AY'.$nn, $ot['Telem_Sensor_1_Prom'])
				->setCellValue('AZ'.$nn, $ot['Telem_Sensor_1_Min'])
				->setCellValue('BA'.$nn, $ot['Telem_Sensor_1_Max'])
				->setCellValue('BB'.$nn, $ot['Telem_Sensor_2_Prom'])
				->setCellValue('BC'.$nn, $ot['Telem_Sensor_2_Min'])
				->setCellValue('BD'.$nn, $ot['Telem_Sensor_2_Max'])
				->setCellValue('BE'.$nn, $ot['DosificadorRut'].' - '.$ot['DosificadorNombre'].' '.$ot['DosificadorApellidoPat'])
				->setCellValue('BF'.$nn, $ot['ConductorRut'].' - '.$ot['ConductorNombre'].' '.$ot['ConductorApellidoPat'])
				->setCellValue('BG'.$nn, $ot['NombreUsuario'])
				->setCellValue('BH'.$nn, $ot['TemporadaCodigo'].' '.$ot['TemporadaNombre'])
				->setCellValue('BI'.$nn, $ot['NombrePrioridad'])

				
				;

	//Se suma 1
	$nn++;
}

				
				
				                       




// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Exportacion');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Cross Checking - Exportar Datos.xls"');
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
