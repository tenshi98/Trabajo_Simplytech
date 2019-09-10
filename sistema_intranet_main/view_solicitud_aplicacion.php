<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT
cross_solicitud_aplicacion_listado.idSolicitud, 
cross_solicitud_aplicacion_listado.idEstado,
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
cross_solicitud_aplicacion_listado.Mojamiento, 
cross_solicitud_aplicacion_listado.VelTractor, 
cross_solicitud_aplicacion_listado.VelViento, 
cross_solicitud_aplicacion_listado.TempMin, 
cross_solicitud_aplicacion_listado.TempMax,

usuarios_listado.Nombre AS NombreUsuario,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

cross_predios_listado.Nombre AS NombrePredio,
core_estado_solicitud.Nombre AS Estado,
cross_checking_temporada.Codigo AS TemporadaCodigo,
cross_checking_temporada.Nombre AS TemporadaNombre,
cross_checking_estado_fenologico.Codigo AS EstadoFenCodigo,
cross_checking_estado_fenologico.Nombre AS EstadoFenNombre,
sistema_variedades_categorias.Nombre AS VariedadCat,
variedades_listado.Nombre AS VariedadNombre,

core_cross_prioridad.Nombre AS NombrePrioridad,
cross_solicitud_aplicacion_listado.idDosificador,
trabajadores_listado.Rut AS TrabajadorRut,
trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat

FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                     = cross_solicitud_aplicacion_listado.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                       = cross_solicitud_aplicacion_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                         = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                         = sistema_origen.idComuna
LEFT JOIN `cross_predios_listado`                   ON cross_predios_listado.idPredio                 = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `core_estado_solicitud`                   ON core_estado_solicitud.idEstado                 = cross_solicitud_aplicacion_listado.idEstado
LEFT JOIN `cross_checking_temporada`                ON cross_checking_temporada.idTemporada           = cross_solicitud_aplicacion_listado.idTemporada
LEFT JOIN `cross_checking_estado_fenologico`        ON cross_checking_estado_fenologico.idEstadoFen   = cross_solicitud_aplicacion_listado.idEstadoFen
LEFT JOIN `sistema_variedades_categorias`           ON sistema_variedades_categorias.idCategoria      = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                      ON variedades_listado.idProducto                  = cross_solicitud_aplicacion_listado.idProducto
LEFT JOIN `core_cross_prioridad`                    ON core_cross_prioridad.idPrioridad               = cross_solicitud_aplicacion_listado.idPrioridad
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador              = cross_solicitud_aplicacion_listado.idDosificador

WHERE cross_solicitud_aplicacion_listado.idSolicitud = {$_GET['view']} ";
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
$row_data = mysqli_fetch_assoc ($resultado);

/*****************************************/				
//Insumos
$arrCuarteles = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_cuarteles.idEstado,
cross_solicitud_aplicacion_listado_cuarteles.f_cierre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.AnoPlantacion AS CuartelAnoPlantacion,
cross_predios_listado_zonas.Hectareas AS CuartelHectareas,
cross_predios_listado_zonas.Hileras AS CuartelHileras,
cross_predios_listado_zonas.Plantas AS NPlantas,
cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,
cross_predios_listado_zonas.DistanciaHileras AS CuartelDistanciaHileras

FROM `cross_solicitud_aplicacion_listado_cuarteles` 
LEFT JOIN `cross_predios_listado_zonas`    ON cross_predios_listado_zonas.idZona    = cross_solicitud_aplicacion_listado_cuarteles.idZona
WHERE cross_solicitud_aplicacion_listado_cuarteles.idSolicitud = {$_GET['view']} ";
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
array_push( $arrCuarteles,$row );
}

//Se trae un listado con los productos	
$arrTractores = array();
$query = "SELECT 
telemetria_listado.Nombre AS Telemetria,
vehiculos_listado.Nombre AS VehiculoNombre,
trabajadores_listado.Rut,
trabajadores_listado.Nombre,
trabajadores_listado.ApellidoPat,
contratista_listado.Nombre AS Contratista

FROM `cross_solicitud_aplicacion_listado_tractores`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria      = cross_solicitud_aplicacion_listado_tractores.idTelemetria
LEFT JOIN `vehiculos_listado`     ON vehiculos_listado.idVehiculo         = cross_solicitud_aplicacion_listado_tractores.idVehiculo
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador    = cross_solicitud_aplicacion_listado_tractores.idTrabajador
LEFT JOIN `contratista_listado`   ON contratista_listado.idContratista    = trabajadores_listado.idContratista

WHERE cross_solicitud_aplicacion_listado_tractores.idSolicitud = {$_GET['view']} 
GROUP BY telemetria_listado.idTelemetria 
ORDER BY telemetria_listado.Nombre ASC";
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
array_push( $arrTractores,$row );
}



//Se trae un listado con los productos	
$arrProductos = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_productos.idProdQuim,
cross_solicitud_aplicacion_listado_productos.idCuarteles,
cross_solicitud_aplicacion_listado_productos.DosisRecomendada,
cross_solicitud_aplicacion_listado_productos.DosisAplicar,
cross_solicitud_aplicacion_listado_productos.Objetivo,
productos_listado.Nombre AS Producto,
sistema_productos_uml.Nombre AS Unimed

FROM `cross_solicitud_aplicacion_listado_productos`
LEFT JOIN `productos_listado`       ON productos_listado.idProducto   = cross_solicitud_aplicacion_listado_productos.idProducto
LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = cross_solicitud_aplicacion_listado_productos.idUml
WHERE cross_solicitud_aplicacion_listado_productos.idSolicitud = {$_GET['view']} 
GROUP BY cross_solicitud_aplicacion_listado_productos.idProducto
ORDER BY productos_listado.Nombre ASC";
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
array_push( $arrProductos,$row );
}


/*****************************************/		
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado_historial.Creacion_fecha, 
cross_solicitud_aplicacion_listado_historial.Observacion,
usuarios_listado.Nombre AS Usuario,
core_estado_solicitud.Nombre AS Estado

FROM `cross_solicitud_aplicacion_listado_historial` 
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario      = cross_solicitud_aplicacion_listado_historial.idUsuario
LEFT JOIN `core_estado_solicitud`    ON core_estado_solicitud.idEstado  = cross_solicitud_aplicacion_listado_historial.idEstado
WHERE cross_solicitud_aplicacion_listado_historial.idSolicitud = {$_GET['view']} 
ORDER BY cross_solicitud_aplicacion_listado_historial.idHistorial ASC";
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
array_push( $arrHistorial,$row );
}	

?>

<div class="row no-print">
	<div class="col-xs-12">
		<a target="new" href="view_solicitud_aplicacion_to_print.php<?php echo '?view='.$_GET['view'] ?>" class="btn btn-default pull-right" style="margin-right: 5px;">
			<i class="fa fa-print"></i> Imprimir
		</a>
	</div>
</div>

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> Solicitud de Aplicacion.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['f_creacion'])?></small>
			</h2>
		</div>   
	</div>

	<div class="row invoice-info">
		
		<?php echo '
				<div class="col-sm-4 invoice-col">
					<strong>Datos Empresa</strong>
					<address>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Empresa: '.$row_data['SistemaOrigen'].'<br>
						Ciudad-Comuna: '.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						Direccion: '.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<strong>Identificacion</strong>
					<address>
						Predio: '.$row_data['NombrePredio'].'<br>
						Estado: '.$row_data['Estado'].'<br>
						Temporada: '.$row_data['TemporadaCodigo'].' '.$row_data['TemporadaNombre'].'<br>
						Estado Fenologico: '.$row_data['EstadoFenCodigo'].' '.$row_data['EstadoFenNombre'].'<br>
						Especie: '.$row_data['VariedadCat'].'<br>
						Variedad: '.$row_data['VariedadNombre'].'<br>
					</address>
				</div>
				<div class="col-sm-4 invoice-col">
					<strong>Datos de Solicitud</strong>
					<address>
						Prioridad: '.$row_data['NombrePrioridad'].'<br>
						N° Solicitud: '.n_doc($row_data['idSolicitud'], 5).'<br>
						Fecha inicio requerido: '.fecha_estandar($row_data['f_programacion']).' '.$row_data['horaProg'].'<br>
						Fecha termino requerido: '.fecha_estandar($row_data['f_programacion_fin']).' '.$row_data['horaProg_fin'].'<br>';
						if(isset($row_data['f_ejecucion'])&&$row_data['f_ejecucion']!='0000-00-00'){ echo 'Fecha inicio programación: '.fecha_estandar($row_data['f_ejecucion']).' '.$row_data['horaEjecucion'].'<br>';}
						if(isset($row_data['f_ejecucion_fin'])&&$row_data['f_ejecucion_fin']!='0000-00-00'){ echo 'Fecha termino programación: '.fecha_estandar($row_data['f_ejecucion_fin']).' '.$row_data['horaEjecucion_fin'].'<br>';}
						if(isset($row_data['f_termino'])&&$row_data['f_termino']!='0000-00-00'){ echo 'Fecha inicio ejecución: '.fecha_estandar($row_data['f_termino']).' '.$row_data['horaTermino'].'<br>';}
						if(isset($row_data['f_termino_fin'])&&$row_data['f_termino_fin']!='0000-00-00'){ echo 'Terminado: '.fecha_estandar($row_data['f_termino_fin']).' '.$row_data['horaTermino_fin'].'<br>';}
						echo 'Agrónomo: '.$row_data['NombreUsuario'];
						if(isset($row_data['idDosificador'])&&$row_data['idDosificador']!=0){ echo 'Dosificador: '.$row_data['TrabajadorRut'].' '.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellidoPat'].'<br>';}
						
						echo '
					</address>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4 invoice-col">
					<strong>Parámetros de Aplicación</strong>
					<address>
						Mojamiento: '.Cantidades_decimales_justos($row_data['Mojamiento']).' L/ha<br>
						Vel. Tractor: '.Cantidades_decimales_justos($row_data['VelTractor']).' Km/hr<br>
						Vel. Viento: '.Cantidades_decimales_justos($row_data['VelViento']).' Km/hr<br>
						Temp Min: '.Cantidades_decimales_justos($row_data['TempMin']).' °<br>
						Temp Max: '.Cantidades_decimales_justos($row_data['TempMax']).' °<br>
						
					</address>
				</div>';
		?>

	</div>
	
	


	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table">
				<tbody>
					<tr class="active">
						<td><strong>Cuarteles</strong></td>
						<td><strong>N° Plantas</strong></td>
						<td><strong>Hectareas</strong></td>
						<td><strong>Año Plantacion</strong></td>
						<td><strong>Hileras</strong></td>
						<td><strong>Distancia Plant</strong></td>
						<td><strong>Distancia Hileras</strong></td>
					</tr>
					
					<?php 
					//recorro el lsiatdo entregado por la base de datos
					if ($arrCuarteles) {
						foreach ($arrCuarteles as $cuartel) { ?>
							
							<tr class="item-row linea_punteada">
								<td class="item-name"><?php echo $cuartel['CuartelNombre'];if(isset($cuartel['idEstado'])&&$cuartel['idEstado']==2){ echo '(Cerrado el '.fecha_estandar($cuartel['f_cierre']).')';} ?></td>
								<td class="item-name"><?php echo $cuartel['NPlantas']; ?></td>
								<td class="item-name"><?php echo $cuartel['CuartelHectareas']; ?></td>
								<td class="item-name"><?php echo $cuartel['CuartelAnoPlantacion']; ?></td>
								<td class="item-name"><?php echo $cuartel['CuartelHileras']; ?></td>
								<td class="item-name"><?php echo $cuartel['CuartelDistanciaPlant']; ?></td>
								<td class="item-name"><?php echo $cuartel['CuartelDistanciaHileras']; ?></td>
							</tr> 
							<?php 
						}
					}else{
						echo '<tr class="item-row linea_punteada"><td>No hay cuarteles asignados</td></tr>';
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	

	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table">
				<tbody>
					<tr class="active">
						<td><strong>Tractor</strong></td>
						<td><strong>Equipo Aplicación</strong></td>
						<td><strong>Trabajador</strong></td>
						<td><strong>Contratista</strong></td>
					</tr>
					<?php 
					//recorro el lsiatdo entregado por la base de datos
					if ($arrTractores) {
						foreach ($arrTractores as $tract) { ?>
							
							<tr class="item-row linea_punteada">
								<td class="item-name"><i class="fa fa-truck"></i> <?php echo $tract['VehiculoNombre'];?></td>
								<td class="item-name"><?php echo $tract['Telemetria'];?></td>
								<td class="item-name"><?php echo $tract['Rut'].' '.$tract['Nombre'].' '.$tract['ApellidoPat'];?></td>
								<td class="item-name"><?php echo $tract['Contratista'];?></td>
							</tr> 
							<?php 
						}
					}else{
						echo '<tr class="item-row linea_punteada"><td colspan="4">No hay Tractores Asignados</td></tr>';
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table">
				<tbody>
					<tr class="active">
						<td><strong>Producto Químico</strong></td>
						<td><strong>Dosis Recomendada</strong></td>
						<td><strong>Dosis a aplicar</strong></td>
						<td><strong>Objetivo</strong></td>
					</tr>
					<?php 
					//recorro el lsiatdo entregado por la base de datos
					if ($arrProductos) {
						foreach ($arrProductos as $prod) { ?>
							
							<tr class="item-row linea_punteada">
								<td class="item-name"><i class="fa fa-flask"></i><?php echo $prod['Producto'];?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($prod['DosisRecomendada']).' '.$prod['Unimed'];?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($prod['DosisAplicar']).' '.$prod['Unimed'];?></td>
								<td class="item-name"><?php echo $prod['Objetivo'];?></td>
							</tr> 
							<?php 
						}
					}else{
						echo '<tr class="item-row linea_punteada"><td colspan="4">No hay Productos Quimicos Asignados</td></tr>';
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	    
</section>

<div class="col-xs-12" style="margin-bottom:15px;">
	
	<?php if ($arrHistorial){ ?>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="4">Detalles</th>
				</tr>
				<tr>
					<th width="160">Fecha</th>
					<th width="160">Estado</th>
					<th width="260">Usuario</th>
					<th>Observacion</th>
				</tr>			  
				<?php foreach ($arrHistorial as $doc){?>
					<tr class="item-row">
						<td><?php echo fecha_estandar($doc['Creacion_fecha']); ?></td>
						<td><?php echo $doc['Estado']; ?></td>
						<td><?php echo $doc['Usuario']; ?></td>
						<td><?php echo $doc['Observacion']; ?></td>
					</tr> 
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>

</div>

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
 
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
