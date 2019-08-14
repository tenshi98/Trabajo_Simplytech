<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "informe_cross_checking_06.php";
$location = $original;
//Se agregan ubicaciones
$search ='&submit_filter=Filtrar';
$location .= "?submit_filter=Filtrar";
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $location .= "&idSolicitud=".$_GET['idSolicitud'];        $search .= "&idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $location .= "&idPredio=".$_GET['idPredio'];              $search .= "&idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){                  $location .= "&idZona=".$_GET['idZona'];                  $search .= "&idZona=".$_GET['idZona'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $location .= "&idTemporada=".$_GET['idTemporada'];        $search .= "&idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $location .= "&idEstadoFen=".$_GET['idEstadoFen'];        $search .= "&idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $location .= "&idCategoria=".$_GET['idCategoria'];        $search .= "&idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $location .= "&idProducto=".$_GET['idProducto'];          $search .= "&idProducto=".$_GET['idProducto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $location .= "&idUsuario=".$_GET['idUsuario'];            $search .= "&idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){              $location .= "&idEstado=".$_GET['idEstado'];              $search .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['f_programacion_desde'])&&$_GET['f_programacion_desde']!=''&&isset($_GET['f_programacion_hasta'])&&$_GET['f_programacion_hasta']!=''){
	$search .="&f_programacion_desde={$_GET['f_programacion_desde']}";
	$search .="&f_programacion_hasta={$_GET['f_programacion_hasta']}";
}
if(isset($_GET['f_ejecucion_desde'])&&$_GET['f_ejecucion_desde']!=''&&isset($_GET['f_ejecucion_hasta'])&&$_GET['f_ejecucion_hasta']!=''){
	$search .="&f_ejecucion_desde={$_GET['f_ejecucion_desde']}";
	$search .="&f_ejecucion_hasta={$_GET['f_ejecucion_hasta']}";
}
if(isset($_GET['f_termino_desde'])&&$_GET['f_termino_desde']!=''&&isset($_GET['f_termino_hasta'])&&$_GET['f_termino_hasta']!=''){
	$search .="&f_termino_desde={$_GET['f_termino_desde']}";
	$search .="&f_termino_hasta={$_GET['f_termino_hasta']}";
}			     
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
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
cross_predios_listado.Nombre AS NombrePredio,
sistema_variedades_categorias.Nombre AS VariedadCat,
variedades_listado.Nombre AS VariedadNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.Plantas AS CuartelPlantas,
cross_predios_listado_zonas.Hectareas AS CuartelHectareas,
cross_predios_listado_zonas.AnoPlantacion AS CuartelAnoPlantacion,
core_cross_estados_productivos.Nombre AS CuartelEstadoProd,
cross_checking_estado_fenologico.Nombre AS EstadoFenNombre,
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado.f_creacion,
cross_solicitud_aplicacion_listado.f_programacion,
cross_solicitud_aplicacion_listado.f_programacion_fin,
cross_solicitud_aplicacion_listado.f_ejecucion,
cross_solicitud_aplicacion_listado.f_ejecucion_fin,
cross_solicitud_aplicacion_listado.f_termino,
cross_solicitud_aplicacion_listado.f_termino_fin,
usuarios_listado.Nombre AS NombreUsuario,
cross_solicitud_aplicacion_listado_productos.Objetivo AS ProductoObjetivo,
core_estado_solicitud.Nombre AS Estado,
dosificador.Nombre AS DosificadorNombre,
dosificador.ApellidoPat AS DosificadorApellidoPat,
conductor.Nombre AS ConductorNombre,
conductor.ApellidoPat AS ConductorApellidoPat,
vehiculos_listado.Nombre AS Vehiculo_Nombre,
telemetria_listado.Identificador AS Telem_Identificador,
telemetria_listado.Capacidad AS Telem_Capacidad,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadProm AS Telem_GeoVelocidadProm,
telemetria_listado.Capacidad AS Telem_Capacidad,
cross_solicitud_aplicacion_listado_tractores.Diferencia AS Telem_Diferencia,
cross_solicitud_aplicacion_listado_tractores.Sensor_1_Prom AS Telem_Sensor_1_Prom,
cross_solicitud_aplicacion_listado_tractores.Sensor_2_Prom AS Telem_Sensor_2_Prom,
productos_listado.Nombre AS ProductoNombre,
sistema_productos_categorias.Nombre AS ProductoCategoria,
cross_solicitud_aplicacion_listado_productos.DosisRecomendada AS ProductoDosisRecomendada,
cross_solicitud_aplicacion_listado_productos.DosisAplicar AS ProductoDosisAplicar,
productos_listado.CarenciaExportador AS ProductoCarenciaExportador,
productos_listado.EfectoResidual AS ProductoEfectoResidual,
productos_listado.EfectoRetroactivo AS ProductoEfectoRetroactivo,

cross_solicitud_aplicacion_listado_cuarteles.f_cierre,
cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,
cross_solicitud_aplicacion_listado_tractores.GeoDistance AS GeoDistance,
cross_solicitud_aplicacion_listado_cuarteles.VelTractor,
cross_solicitud_aplicacion_listado_tractores.Sensor_4_Prom AS Telem_Sensor_4_Prom,
cross_solicitud_aplicacion_listado_tractores.Sensor_6_Prom AS Telem_Sensor_6_Prom,
productos_listado.IngredienteActivo AS ProductoIngredienteActivo

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
LEFT JOIN `core_cross_estados_productivos`                 ON core_cross_estados_productivos.idEstadoProd                = cross_predios_listado_zonas.idEstadoProd
LEFT JOIN `cross_solicitud_aplicacion_listado_tractores`   ON cross_solicitud_aplicacion_listado_tractores.idCuarteles   = cross_solicitud_aplicacion_listado_cuarteles.idCuarteles
LEFT JOIN `telemetria_listado`                             ON telemetria_listado.idTelemetria                            = cross_solicitud_aplicacion_listado_tractores.idTelemetria
LEFT JOIN `vehiculos_listado`                              ON vehiculos_listado.idVehiculo                               = cross_solicitud_aplicacion_listado_tractores.idVehiculo
LEFT JOIN `trabajadores_listado`       conductor           ON conductor.idTrabajador                                     = cross_solicitud_aplicacion_listado_tractores.idTrabajador
LEFT JOIN `cross_solicitud_aplicacion_listado_productos`   ON cross_solicitud_aplicacion_listado_productos.idCuarteles   = cross_solicitud_aplicacion_listado_cuarteles.idCuarteles
LEFT JOIN `productos_listado`                              ON productos_listado.idProducto                               = cross_solicitud_aplicacion_listado_productos.idProducto
LEFT JOIN `sistema_productos_categorias`                   ON sistema_productos_categorias.idCategoria                   = productos_listado.idCategoria

".$z;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrOTS,$row );
}
?>

<div class="col-sm-12">
	<div class="table-responsive" style="height: 800px;"> 
		<link href="<?php echo DB_SITE ?>/LIBS_js/webdatarocks/webdatarocks.min.css" rel="stylesheet" />
		<script src="<?php echo DB_SITE ?>/LIBS_js/webdatarocks/webdatarocks.toolbar.min.js"></script>
		<script src="<?php echo DB_SITE ?>/LIBS_js/webdatarocks/webdatarocks.js"></script>
		
		<div id="wdr-component"></div>
		<?php
		echo '<script>';
			echo 'var tipsData = [';
				foreach ($arrOTS as $temp) {
					//Calculo de las maquinadas
					if(isset($temp['Telem_Capacidad'])&&$temp['Telem_Capacidad']!=''&&$temp['Telem_Capacidad']!=0){
						$maquinada = $temp['Telem_Diferencia'] / $temp['Telem_Capacidad'];
					}else{
						$maquinada = 0;
					}
					//calculo de los litros por hectarea
					if(isset($temp['CuartelHectareas'])&&$temp['CuartelHectareas']!=''&&$temp['CuartelHectareas']!=0){
						$litrosxhectarea = $temp['Telem_Diferencia'] / $temp['CuartelHectareas'];
					}else{
						$litrosxhectarea = 0;
					}
					//se verifica cumplimiento de fechas
					if(isset($temp['f_cierre'])&&$temp['f_cierre']>=$temp['f_termino']&&$temp['f_cierre']<=$temp['f_termino_fin']){
						$cumplimiento = 'Si';
					}else{
						$cumplimiento = 'No';
					}
					//se verifica plantas faltantes
					if(isset($temp['GeoDistance'])&&$temp['GeoDistance']!=0){
						$faltante = ((($temp['CuartelDistanciaPlant']*$temp['CuartelPlantas']) - ($temp['GeoDistance']*1000))/$temp['CuartelDistanciaPlant']);
						if($faltante<0){
							$faltante = 0;
						}
					}else{
						$faltante = 0;
					}
					//Desviacion
					if(isset($temp['Telem_Sensor_1_Prom'])&&$temp['Telem_Sensor_1_Prom']>0){
						$desviacion = (($temp['Telem_Sensor_1_Prom']-$temp['Telem_Sensor_2_Prom'])/$temp['Telem_Sensor_1_Prom'])*100;
					}else{
						$desviacion = 0;
					}
					
								
										
	
					echo '{
						"Predio": "'.$temp['NombrePredio'].'",
						"Especie": "'.$temp['VariedadCat'].'",
						"Variedad": "'.$temp['VariedadNombre'].'",
						"Cuartel": "'.$temp['CuartelNombre'].'",
						"Nro.Plantas": "'.$temp['CuartelPlantas'].'",
						"Hectáreas": "'.$temp['CuartelHectareas'].'",
						"Año Plantación": "'.$temp['CuartelAnoPlantacion'].'",
						"Estado Productivo": "'.$temp['CuartelEstadoProd'].'",
						"Estado fenológico": "'.$temp['EstadoFenNombre'].'",
						"# Solicitud": "'.$temp['idSolicitud'].'",
						"Fecha creacion": "'.$temp['f_creacion'].'",
						"Fecha Solicitud Inicio": "'.$temp['f_programacion'].'",
						"Fecha Solicitud termino": "'.$temp['f_programacion_fin'].'",
						"Fecha Programacion Inicio": "'.$temp['f_ejecucion'].'",
						"Fecha Programacion termino": "'.$temp['f_ejecucion_fin'].'",
						"Inicio Aplicación": "'.$temp['f_termino'].'",
						"Fin Aplicación": "'.$temp['f_termino_fin'].'",
						"Cumple Programacion (si/no)": "'.$cumplimiento.'",
						"Solicitado Por": "'.$temp['NombreUsuario'].'",
						"Objetivo": "'.$temp['ProductoObjetivo'].'",
						"Estado de la aplicación": "'.$temp['Estado'].'",
						"Dosificador": "'.$temp['DosificadorNombre'].' '.$temp['DosificadorApellidoPat'].'",
						"Aplicador": "'.$temp['ConductorNombre'].' '.$temp['ConductorApellidoPat'].'",
						"Tractor": "'.$temp['Vehiculo_Nombre'].'",
						"Equipo": "'.$temp['Telem_Identificador'].'",
						"Capacidad Estanque": "'.$temp['Telem_Capacidad'].'",
						"Plantas Faltantes": "'.$faltante.'",
						"Veloc. Recomendada": "'.$temp['VelTractor'].'",
						"Veloc. Promedio": "'.$temp['Telem_GeoVelocidadProm'].'",
						"Maquinadas": "'.$maquinada.'",
						"Caudal Izquierdo": "'.$temp['Telem_Sensor_1_Prom'].'",
						"Caudal derecho": "'.$temp['Telem_Sensor_2_Prom'].'",
						"% Desviacion": "'.$desviacion.'",
						"pH": "'.$temp['Telem_Sensor_4_Prom'].'",
						"lts. Aplicados": "'.$temp['Telem_Diferencia'].'",
						"Lts. Hectarias": "'.$litrosxhectarea.'",
						"Nombre Producto": "'.$temp['ProductoNombre'].'",
						"Tipo de Producto": "'.$temp['ProductoCategoria'].'",
						"Ingrediente Activo": "'.$temp['ProductoIngredienteActivo'].'",
						"Dosis recomendada": "'.$temp['ProductoDosisRecomendada'].'",
						"Dosis Solicitada": "'.$temp['ProductoDosisAplicar'].'",
						"Objetivo Producto": "",
						"Fin Carencia": "'.$temp['ProductoCarenciaExportador'].'",
						"Fin efecto Residual": "'.$temp['ProductoEfectoResidual'].'",
						"Efecto Retroactivo": "'.$temp['ProductoEfectoRetroactivo'].'",
					},';
				}

			echo '];';
		echo '</script>';
		?>
		
		<script>
		var pivot = new WebDataRocks({
			container: "#wdr-component",
			toolbar: true,
			report: {
				dataSource: {
					data: tipsData
				},
				slice: {
					rows: [
						{
							"uniqueName": "Especie"
						},
						{
							"uniqueName": "Variedad"
						},
						{
							"uniqueName": "# Solicitud"
						},
						{
							"uniqueName": "Cuartel"
						},
						{
							"uniqueName": "Hectáreas"
						},
						{
							"uniqueName": "Fecha Programacion Inicio"
						},
						{
							"uniqueName": "Fin Aplicación"
						}
					],
					columns: [
						{
							"uniqueName": "Measures"
						}
					],
					measures: [
						{
							"uniqueName": "Nro.Plantas",
							"aggregation": "sum"
						},
						{
							"uniqueName": "Plantas aplicadas",
							"aggregation": "sum"
						},
						{
							"uniqueName": "Veloc. Recomendada",
							"aggregation": "prom"
						},
						{
							"uniqueName": "Veloc. Promedio",
							"aggregation": "prom"
						},
						{
							"uniqueName": "Caudal Izquierdo",
							"aggregation": "prom"
						},
						{
							"uniqueName": "Caudal derecho",
							"aggregation": "prom"
						},
						{
							"uniqueName": "lts. Aplicados",
							"aggregation": "sum"
						},
						{
							"uniqueName": "Lts. Hectarias",
							"aggregation": "sum"
						},
						{
							"uniqueName": "pH",
							"aggregation": "prom"
						}
					]
				},
				options: {
					grid: {
						"type": "flat"
					}
				}
			},
			global: {
				// replace this path with the path to your own translated file
				localization: "https://cdn.webdatarocks.com/loc/es.json"
			}
		});
		</script>
    
	</div>
</div>


<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
$y = "idEstado=1";
$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
 
 ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idSolicitud)) {            $x1  = $idSolicitud;            }else{$x1  = '';}
				if(isset($idPredio)) {               $x2  = $idPredio;               }else{$x2  = '';}
				if(isset($idZona)) {                 $x3  = $idZona;                 }else{$x3  = '';}
				if(isset($idTemporada)) {            $x4  = $idTemporada;            }else{$x4  = '';}
				if(isset($idEstadoFen)) {            $x5  = $idEstadoFen;            }else{$x5  = '';}
				if(isset($idCategoria)) {            $x6  = $idCategoria;            }else{$x6  = '';}
				if(isset($idProducto)) {             $x7  = $idProducto;             }else{$x7  = '';}
				if(isset($f_programacion_desde)) {   $x8  = $f_programacion_desde;   }else{$x8  = '';}
				if(isset($f_programacion_hasta)) {   $x9  = $f_programacion_hasta;   }else{$x9  = '';}
				if(isset($f_ejecucion_desde)) {      $x10 = $f_ejecucion_desde;      }else{$x10 = '';}
				if(isset($f_ejecucion_hasta)) {      $x11 = $f_ejecucion_hasta;      }else{$x11 = '';}
				if(isset($f_termino_desde)) {        $x12 = $f_termino_desde;        }else{$x12 = '';}
				if(isset($f_termino_hasta)) {        $x13 = $f_termino_hasta;        }else{$x13 = '';}
				if(isset($idUsuario)) {              $x14 = $idUsuario;              }else{$x14 = '';}
				if(isset($idEstado)) {               $x15 = $idEstado;               }else{$x15 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_number('N° Solicitud','idSolicitud', $x1, 1);
				$Form_Imputs->form_select_depend1('Predio','idPredio', $x2, 1, 'idPredio', 'Nombre', 'cross_predios_listado', $x, 0,
										 'Cuarteles','idZona', $x3, 1, 'idZona', 'Nombre', 'cross_predios_listado_zonas', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_select_filter('Temporada','idTemporada', $x4, 1, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
				$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x5, 1, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
				$Form_Imputs->form_select_depend1('Especie','idCategoria', $x6, 1, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, 0,
										 'Variedad','idProducto', $x7, 1, 'idProducto', 'Nombre', 'variedades_listado', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_date('Fecha Programada Desde','f_programacion_desde', $x8, 1);
				$Form_Imputs->form_date('Fecha Programada Hasta','f_programacion_hasta', $x9, 1);
				$Form_Imputs->form_date('Fecha Ejecutada Desde','f_ejecucion_desde', $x10, 1);
				$Form_Imputs->form_date('Fecha Ejecutada Hasta','f_ejecucion_hasta', $x11, 1);
				$Form_Imputs->form_date('Fecha Terminada Desde','f_termino_desde', $x12, 1);
				$Form_Imputs->form_date('Fecha Terminada Hasta','f_termino_hasta', $x13, 1);
				$Form_Imputs->form_select_join_filter('Usuario Creador','idUsuario', $x14, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				$Form_Imputs->form_select('Estado','idEstado', $x15, 1, 'idEstado', 'Nombre', 'core_estado_solicitud', 0, '', $dbConn);
						
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div> 
<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
