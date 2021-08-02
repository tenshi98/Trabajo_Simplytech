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
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT 
solicitud_listado.Creacion_fecha,
solicitud_listado.Observaciones,

usuarios_listado.Nombre AS NombreUsuario,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut

FROM `solicitud_listado`
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = solicitud_listado.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = solicitud_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna

WHERE solicitud_listado.idSolicitud = ".$X_Puntero;
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
$row_data = mysqli_fetch_assoc ($resultado);

/*****************************************/				
//Insumos
$arrInsumos = array();
$query = "SELECT 
insumos_listado.Nombre,
solicitud_listado_existencias_insumos.Cantidad,
sistema_productos_uml.Nombre AS Unidad

FROM `solicitud_listado_existencias_insumos` 
LEFT JOIN `insumos_listado`          ON insumos_listado.idProducto    = solicitud_listado_existencias_insumos.idProducto
LEFT JOIN `sistema_productos_uml`    ON sistema_productos_uml.idUml   = insumos_listado.idUml
WHERE solicitud_listado_existencias_insumos.idSolicitud = ".$X_Puntero;
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
array_push( $arrInsumos,$row );
}
/*****************************************/				
//Productos
$arrProductos = array();
$query = "SELECT 
productos_listado.Nombre,
solicitud_listado_existencias_productos.Cantidad,
sistema_productos_uml.Nombre AS Unidad

FROM `solicitud_listado_existencias_productos` 
LEFT JOIN `productos_listado`          ON productos_listado.idProducto    = solicitud_listado_existencias_productos.idProducto
LEFT JOIN `sistema_productos_uml`      ON sistema_productos_uml.idUml     = productos_listado.idUml
WHERE solicitud_listado_existencias_productos.idSolicitud = ".$X_Puntero;
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
array_push( $arrProductos,$row );
}
/*****************************************/				
//Arriendos
$arrArriendos = array();
$query = "SELECT 
equipos_arriendo_listado.Nombre,
solicitud_listado_existencias_arriendos.Cantidad,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `solicitud_listado_existencias_arriendos` 
LEFT JOIN `equipos_arriendo_listado`    ON equipos_arriendo_listado.idEquipo     = solicitud_listado_existencias_arriendos.idEquipo
LEFT JOIN `core_tiempo_frecuencia`      ON core_tiempo_frecuencia.idFrecuencia   = solicitud_listado_existencias_arriendos.idFrecuencia
WHERE solicitud_listado_existencias_arriendos.idSolicitud = ".$X_Puntero;
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
array_push( $arrArriendos,$row );
}
/*****************************************/				
//Servicios
$arrServicios = array();
$query = "SELECT 
servicios_listado.Nombre,
solicitud_listado_existencias_servicios.Cantidad,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `solicitud_listado_existencias_servicios` 
LEFT JOIN `servicios_listado`       ON servicios_listado.idServicio          = solicitud_listado_existencias_servicios.idServicio
LEFT JOIN `core_tiempo_frecuencia`  ON core_tiempo_frecuencia.idFrecuencia   = solicitud_listado_existencias_servicios.idFrecuencia
WHERE solicitud_listado_existencias_servicios.idSolicitud = ".$X_Puntero;
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
array_push( $arrServicios,$row );
}
/*****************************************/				
//Otros
$arrOtros = array();
$query = "SELECT 
solicitud_listado_existencias_otros.Nombre,
solicitud_listado_existencias_otros.Cantidad,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `solicitud_listado_existencias_otros` 
LEFT JOIN `core_tiempo_frecuencia`  ON core_tiempo_frecuencia.idFrecuencia   = solicitud_listado_existencias_otros.idFrecuencia
WHERE solicitud_listado_existencias_otros.idSolicitud = ".$X_Puntero;
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
array_push( $arrOtros,$row );
}	
?>

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Solicitud de Productos.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['Creacion_fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php echo '
				<div class="col-sm-12 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						'.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono: '.$row_data['SistemaOrigenFono'].'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>';
		?>

	</div>
	
	
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Detalle</th>
						<th align="right" width="160">Cantidad</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrInsumos) { ?>
						<tr class="active"><td colspan="2"><strong>Insumos</strong></td></tr>
						<?php foreach ($arrInsumos as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Unidad']; ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrProductos) { ?>
						<tr class="active"><td colspan="2"><strong>Productos</strong></td></tr>
						<?php foreach ($arrProductos as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Unidad']; ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrArriendos) { ?>
						<tr class="active"><td colspan="2"><strong>Arriendos</strong></td></tr>
						<?php foreach ($arrArriendos as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Frecuencia']; ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrServicios) { ?>
						<tr class="active"><td colspan="2"><strong>Servicios</strong></td></tr>
						<?php foreach ($arrServicios as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Frecuencia']; ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrOtros) { ?>
						<tr class="active"><td colspan="2"><strong>Otros</strong></td></tr>
						<?php foreach ($arrOtros as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Frecuencia']; ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Observaciones'];?></p>
		</div>
	</div>
	
	
      
</section>

<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>
 
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
