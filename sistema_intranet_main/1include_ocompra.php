<?php 
// Se traen todos los datos de mi usuario
$query = "SELECT 
ocompra_listado.Creacion_fecha,
ocompra_listado.Observaciones,

usuarios_listado.Nombre AS NombreUsuario,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

proveedor_listado.Nombre AS NombreProveedor,
proveedor_listado.email AS EmailProveedor,
proveedor_listado.Rut AS RutProveedor,
provciudad.Nombre AS CiudadProveedor,
provcomuna.Nombre AS ComunaProveedor,
proveedor_listado.Direccion AS DireccionProveedor,
proveedor_listado.Fono1 AS Fono1Proveedor,
proveedor_listado.Fono2 AS Fono2Proveedor,
proveedor_listado.Fax AS FaxProveedor,
proveedor_listado.PersonaContacto AS PersonaContactoProveedor,
proveedor_listado.Giro AS GiroProveedor,

core_oc_estado.Nombre AS Estado,
ocompra_listado.idEstado,
ocompra_listado.idSistema

FROM `ocompra_listado`
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario       = ocompra_listado.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema         = ocompra_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad           = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna           = sistema_origen.idComuna
LEFT JOIN `proveedor_listado`                       ON proveedor_listado.idProveedor    = ocompra_listado.idProveedor
LEFT JOIN `core_ubicacion_ciudad`    provciudad     ON provciudad.idCiudad              = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   provcomuna     ON provcomuna.idComuna              = proveedor_listado.idComuna
LEFT JOIN `core_oc_estado`                          ON core_oc_estado.idEstado          = ocompra_listado.idEstado

WHERE ocompra_listado.idOcompra = {$_GET['view']} ";
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
$row_data = mysqli_fetch_assoc ($resultado);

/*****************************************/				
//Insumos
$arrInsumos = array();
$query = "SELECT 
insumos_listado.Nombre,
ocompra_listado_existencias_insumos.Cantidad,
ocompra_listado_existencias_insumos.vUnitario,
ocompra_listado_existencias_insumos.vTotal,
sistema_productos_uml.Nombre AS Unidad

FROM `ocompra_listado_existencias_insumos` 
LEFT JOIN `insumos_listado`          ON insumos_listado.idProducto    = ocompra_listado_existencias_insumos.idProducto
LEFT JOIN `sistema_productos_uml`    ON sistema_productos_uml.idUml   = insumos_listado.idUml
WHERE ocompra_listado_existencias_insumos.idOcompra = {$_GET['view']} ";
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
array_push( $arrInsumos,$row );
}
/*****************************************/				
//Productos
$arrProductos = array();
$query = "SELECT 
productos_listado.Nombre,
ocompra_listado_existencias_productos.Cantidad,
ocompra_listado_existencias_productos.vUnitario,
ocompra_listado_existencias_productos.vTotal,
sistema_productos_uml.Nombre AS Unidad

FROM `ocompra_listado_existencias_productos` 
LEFT JOIN `productos_listado`          ON productos_listado.idProducto    = ocompra_listado_existencias_productos.idProducto
LEFT JOIN `sistema_productos_uml`      ON sistema_productos_uml.idUml     = productos_listado.idUml
WHERE ocompra_listado_existencias_productos.idOcompra = {$_GET['view']} ";
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
array_push( $arrProductos,$row );
}
/*****************************************/				
//Arriendos
$arrArriendos = array();
$query = "SELECT 
equipos_arriendo_listado.Nombre,
ocompra_listado_existencias_arriendos.Cantidad,
ocompra_listado_existencias_arriendos.vUnitario,
ocompra_listado_existencias_arriendos.vTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `ocompra_listado_existencias_arriendos` 
LEFT JOIN `equipos_arriendo_listado`    ON equipos_arriendo_listado.idEquipo     = ocompra_listado_existencias_arriendos.idEquipo
LEFT JOIN `core_tiempo_frecuencia`      ON core_tiempo_frecuencia.idFrecuencia   = ocompra_listado_existencias_arriendos.idFrecuencia
WHERE ocompra_listado_existencias_arriendos.idOcompra = {$_GET['view']} ";
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
array_push( $arrArriendos,$row );
}
/*****************************************/				
//Servicios
$arrServicios = array();
$query = "SELECT 
servicios_listado.Nombre,
ocompra_listado_existencias_servicios.Cantidad,
ocompra_listado_existencias_servicios.vUnitario,
ocompra_listado_existencias_servicios.vTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `ocompra_listado_existencias_servicios` 
LEFT JOIN `servicios_listado`       ON servicios_listado.idServicio          = ocompra_listado_existencias_servicios.idServicio
LEFT JOIN `core_tiempo_frecuencia`  ON core_tiempo_frecuencia.idFrecuencia   = ocompra_listado_existencias_servicios.idFrecuencia
WHERE ocompra_listado_existencias_servicios.idOcompra = {$_GET['view']} ";
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
array_push( $arrServicios,$row );
}
/*****************************************/				
//Otros
$arrOtros = array();
$query = "SELECT 
ocompra_listado_existencias_otros.Nombre,
ocompra_listado_existencias_otros.Cantidad,
ocompra_listado_existencias_otros.vUnitario,
ocompra_listado_existencias_otros.vTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `ocompra_listado_existencias_otros` 
LEFT JOIN `core_tiempo_frecuencia`  ON core_tiempo_frecuencia.idFrecuencia   = ocompra_listado_existencias_otros.idFrecuencia
WHERE ocompra_listado_existencias_otros.idOcompra = {$_GET['view']} ";
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
array_push( $arrOtros,$row );
}
/*****************************************/				
//Boletas Trabajadores
$arrBoletas = array();
$query = "SELECT 
ocompra_listado_existencias_boletas.N_Doc,
ocompra_listado_existencias_boletas.Descripcion,
ocompra_listado_existencias_boletas.Valor,

trabajadores_listado.Rut AS TrabRut,
trabajadores_listado.Nombre AS TrabNombre,
trabajadores_listado.ApellidoPat AS TrabApellidoPat

FROM `ocompra_listado_existencias_boletas` 
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador   = ocompra_listado_existencias_boletas.idTrabajador
WHERE ocompra_listado_existencias_boletas.idOcompra = {$_GET['view']} ";
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
array_push( $arrBoletas,$row );
}	
/*****************************************/				
//Boletas Empresas
$arrBoletasEmp = array();
$query = "SELECT  idExistencia, Descripcion, Valor
FROM `ocompra_listado_existencias_boletas_empresas` 
WHERE idOcompra = {$_GET['view']} ";
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
array_push( $arrBoletasEmp,$row );
}
/*****************************************/		
// Se trae un listado con todos los documentos acompañantes
$arrDocumentos = array();
$query = "SELECT 
ocompra_listado_documentos.NDocPago,
ocompra_listado_documentos.Fpago,
ocompra_listado_documentos.vTotal,
sistema_documentos_pago.Nombre AS Documento

FROM `ocompra_listado_documentos` 
LEFT JOIN `sistema_documentos_pago` ON sistema_documentos_pago.idDocPago = ocompra_listado_documentos.idDocPago
WHERE ocompra_listado_documentos.idOcompra = {$_GET['view']} 
ORDER BY ocompra_listado_documentos.Fpago ASC";
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
array_push( $arrDocumentos,$row );
}
/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `ocompra_listado_archivos` 
WHERE idOcompra = {$_GET['view']} ";
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
array_push( $arrArchivo,$row );
}
/*****************************************/		
// Se trae un con los materiales de las solicitudes
$arrSolMat = array();
$query = "SELECT 
ocompra_listado_sol_rel.Type,

solicitud_listado_existencias_productos.idSolicitud AS Prod_idSolicitud,
solicitud_listado_existencias_productos.Cantidad  AS Prod_Cantidad,
productos_sis.Nombre AS Prod_Sistema,
productos_listado.Nombre AS Prod_Nombre,
productos_med.Nombre AS Prod_Medida,

solicitud_listado_existencias_insumos.idSolicitud AS Ins_idSolicitud,
solicitud_listado_existencias_insumos.Cantidad  AS Ins_Cantidad,
insumos_sis.Nombre AS Ins_Sistema,
insumos_listado.Nombre AS Ins_Nombre,
insumos_med.Nombre AS Ins_Medida,

solicitud_listado_existencias_arriendos.idSolicitud AS Arri_idSolicitud,
solicitud_listado_existencias_arriendos.Cantidad  AS Arri_Cantidad,
arriendo_sis.Nombre AS Arri_Sistema,
equipos_arriendo_listado.Nombre AS Arri_Nombre,
arriendo_med.Nombre AS Arri_Medida,

solicitud_listado_existencias_servicios.idSolicitud AS Serv_idSolicitud,
solicitud_listado_existencias_servicios.Cantidad  AS Serv_Cantidad,
servicio_sis.Nombre AS Serv_Sistema,
servicios_listado.Nombre AS Serv_Nombre,
servicio_med.Nombre AS Serv_Medida

FROM `ocompra_listado_sol_rel` 

LEFT JOIN `solicitud_listado_existencias_productos`    ON solicitud_listado_existencias_productos.idExistencia    = ocompra_listado_sol_rel.idExistencia
LEFT JOIN `productos_listado`                          ON productos_listado.idProducto                            = solicitud_listado_existencias_productos.idProducto
LEFT JOIN `core_sistemas`             productos_sis    ON productos_sis.idSistema                                 = solicitud_listado_existencias_productos.idSistema
LEFT JOIN `sistema_productos_uml`     productos_med    ON productos_med.idUml                                     = productos_listado.idUml

LEFT JOIN `solicitud_listado_existencias_insumos`      ON solicitud_listado_existencias_insumos.idExistencia      = ocompra_listado_sol_rel.idExistencia
LEFT JOIN `insumos_listado`                            ON insumos_listado.idProducto                              = solicitud_listado_existencias_insumos.idProducto
LEFT JOIN `core_sistemas`             insumos_sis      ON insumos_sis.idSistema                                   = solicitud_listado_existencias_insumos.idSistema
LEFT JOIN `sistema_productos_uml`     insumos_med      ON insumos_med.idUml                                       = insumos_listado.idUml

LEFT JOIN `solicitud_listado_existencias_arriendos`    ON solicitud_listado_existencias_arriendos.idExistencia    = ocompra_listado_sol_rel.idExistencia
LEFT JOIN `equipos_arriendo_listado`                   ON equipos_arriendo_listado.idEquipo                       = solicitud_listado_existencias_arriendos.idEquipo
LEFT JOIN `core_sistemas`             arriendo_sis     ON arriendo_sis.idSistema                                  = solicitud_listado_existencias_arriendos.idSistema
LEFT JOIN `core_tiempo_frecuencia`    arriendo_med     ON arriendo_med.idFrecuencia                               = solicitud_listado_existencias_arriendos.idFrecuencia

LEFT JOIN `solicitud_listado_existencias_servicios`    ON solicitud_listado_existencias_servicios.idExistencia    = ocompra_listado_sol_rel.idExistencia
LEFT JOIN `servicios_listado`                          ON servicios_listado.idServicio                            = solicitud_listado_existencias_servicios.idServicio
LEFT JOIN `core_sistemas`             servicio_sis     ON servicio_sis.idSistema                                  = solicitud_listado_existencias_servicios.idSistema
LEFT JOIN `core_tiempo_frecuencia`    servicio_med     ON servicio_med.idFrecuencia                               = solicitud_listado_existencias_servicios.idFrecuencia

WHERE ocompra_listado_sol_rel.idOcompra = {$_GET['view']} ";
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
array_push( $arrSolMat,$row );
}

/*****************************************/		
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT 
ocompra_listado_historial.Creacion_fecha, 
ocompra_listado_historial.Observacion,
core_historial_tipos.Nombre,
core_historial_tipos.FonAwesome,
usuarios_listado.Nombre AS Usuario

FROM `ocompra_listado_historial` 
LEFT JOIN `core_historial_tipos`     ON core_historial_tipos.idTipo   = ocompra_listado_historial.idTipo
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario    = ocompra_listado_historial.idUsuario
WHERE ocompra_listado_historial.idOcompra = {$_GET['view']} 
ORDER BY ocompra_listado_historial.idHistorial ASC";
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

/*********************************/
//variables
$alert_borde = '';
$alert_icon  = '';
$alert_obs   = '';
foreach ($arrHistorial as $doc){
	$alert_borde = $doc['Nombre'];
	$alert_icon  = $doc['FonAwesome'];
	$alert_obs   = $doc['Observacion'];
}
?>
<?php if(isset($alert_obs)&&$alert_obs!=''){ ?>
	<div class="col-xs-12" style="margin-top:15px;">
		<div class="alert alert-<?php echo $alert_borde; ?> alert-white rounded"> 
			<div class="icon"><i class="<?php echo $alert_icon; ?>"></i></div> 
			<?php echo $alert_obs; ?>
		</div>
	</div>
	<div class="clearfix" style="margin-bottom:15px;"></div>
<?php } ?>
		
<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> Orden de Compra <?php echo n_doc($_GET['view'], 5); ?>.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['Creacion_fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php 
		echo '
				<div class="col-sm-4 invoice-col">
					Empresa Solicitante
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				
				<div class="col-sm-4 invoice-col">
					Empresa Receptora
					<address>
						<strong>'.$row_data['NombreProveedor'].'</strong><br>
						'.$row_data['CiudadProveedor'].', '.$row_data['ComunaProveedor'].'<br>
						'.$row_data['DireccionProveedor'].'<br>
						Fono Fijo: '.$row_data['Fono1Proveedor'].'<br>
						Celular: '.$row_data['Fono2Proveedor'].'<br>
						Fax: '.$row_data['FaxProveedor'].'<br>
						Rut: '.$row_data['RutProveedor'].'<br>
						Email: '.$row_data['EmailProveedor'].'<br>
						Contacto: '.$row_data['PersonaContactoProveedor'].'<br>
						Giro de la Empresa: '.$row_data['GiroProveedor'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					<b>Estado: </b>'.$row_data['Estado'].'<br>
				</div>';
		?>

	</div>
	
	
	<div class="row">
		<div class="col-xs-12 table-responsive"  style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Detalle</th>
						<th align="right" width="160">Cantidad</th>
						<th align="right" width="160">Valor Unitario</th>
						<th align="right" width="160">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrInsumos) { ?>
						<tr class="active"><td colspan="4"><strong>Insumos</strong></td></tr>
						<?php foreach ($arrInsumos as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Unidad']; ?></td>
								<td align="right"><?php echo valores($prod['vUnitario'], 0).' x '.$prod['Unidad']; ?></td>
								<td align="right"><?php echo valores($prod['vTotal'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrProductos) { ?>
						<tr class="active"><td colspan="4"><strong>Productos</strong></td></tr>
						<?php foreach ($arrProductos as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Unidad']; ?></td>
								<td align="right"><?php echo valores($prod['vUnitario'], 0).' x '.$prod['Unidad']; ?></td>
								<td align="right"><?php echo valores($prod['vTotal'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrArriendos) { ?>
						<tr class="active"><td colspan="4"><strong>Arriendos</strong></td></tr>
						<?php foreach ($arrArriendos as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Frecuencia']; ?></td>
								<td align="right"><?php echo valores($prod['vUnitario'], 0).' x '.$prod['Frecuencia']; ?></td>
								<td align="right"><?php echo valores($prod['vTotal'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrServicios) { ?>
						<tr class="active"><td colspan="4"><strong>Servicios</strong></td></tr>
						<?php foreach ($arrServicios as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Frecuencia']; ?></td>
								<td align="right"><?php echo valores($prod['vUnitario'], 0).' x '.$prod['Frecuencia']; ?></td>
								<td align="right"><?php echo valores($prod['vTotal'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrOtros) { ?>
						<tr class="active"><td colspan="4"><strong>Otros</strong></td></tr>
						<?php foreach ($arrOtros as $prod) { ?>
							<tr>
								<td><?php echo $prod['Nombre']; ?></td>
								<td align="right"><?php echo Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['Frecuencia']; ?></td>
								<td align="right"><?php echo valores($prod['vUnitario'], 0).' x '.$prod['Frecuencia']; ?></td>
								<td align="right"><?php echo valores($prod['vTotal'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrBoletas) { ?>
						<tr class="active"><td colspan="4"><strong>Boletas de Honorarios Trabajadores</strong></td></tr>
						<?php foreach ($arrBoletas as $prod) { ?>
							<tr>
								<td><?php echo $prod['TrabRut'].' - '.$prod['TrabNombre'].' '.$prod['TrabApellidoPat']; ?></td>
								<td><?php echo $prod['Descripcion']; ?></td>
								<td><?php echo 'Boleta N° '.$prod['N_Doc']; ?></td>
								<td align="right"><?php echo valores($prod['Valor'], 0); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrBoletasEmp) { ?>
						<tr class="active"><td colspan="4"><strong>Boletas de Honorarios Empresas</strong></td></tr>
						<?php foreach ($arrBoletasEmp as $prod) { ?>
							<tr>
								<td colspan="3"><?php echo $prod['Descripcion']; ?></td>
								<td align="right"><?php echo valores($prod['Valor'], 0); ?></td>
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

<div class="col-xs-12" style="margin-bottom:15px;">
	
	<table id="items">
        <tbody>
			<tr><th colspan="3">Historial</th></tr>
			<tr>
				<th width="160">Fecha</th>
				<th>Usuario</th>
				<th>Observacion</th>
			</tr>			  
			<?php 
			if (isset($arrHistorial)){
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrHistorial as $doc){?>
					<tr class="item-row">
						<td><?php echo fecha_estandar($doc['Creacion_fecha']); ?></td>
						<td><?php echo $doc['Usuario']; ?></td>
						<td><?php echo '<i class="'.$doc['FonAwesome'].'" aria-hidden="true"></i> '.$doc['Observacion']; ?></td>
					</tr> 
				 <?php 	
				}
			}?>
		</tbody>
    </table>
    
	<?php if ($arrSolMat) { ?>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="4">Solicitudes Relacionadas</th>
				</tr>
				<tr>
					<th>Sistema</th>
					<th>N° Solicitud</th>
					<th>Producto</th>
					<th>Cantidad</th>
				</tr>		  
				<?php 
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrSolMat as $producto){
					switch ($producto['Type']) {
						/****************************************/
						//Productos
						case 1:
						?>
							<tr class="item-row linea_punteada">
								<td class="item-name"><?php echo $producto['Prod_Sistema'];?></td>
								<td class="item-name"><?php echo n_doc($producto['Prod_idSolicitud'], 5);?></td>
								<td class="item-name"><?php echo $producto['Prod_Nombre'];?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($producto['Prod_Cantidad']).' '.$producto['Prod_Medida'];?></td>
							</tr>
						<?php
							break;
						/****************************************/
						//Insumos
						case 2:
							?>
							<tr class="item-row linea_punteada">
								<td class="item-name"><?php echo $producto['Ins_Sistema'];?></td>
								<td class="item-name"><?php echo n_doc($producto['Ins_idSolicitud'], 5);?></td>
								<td class="item-name"><?php echo $producto['Ins_Nombre'];?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($producto['Ins_Cantidad']).' '.$producto['Ins_Medida'];?></td>
							</tr>
						<?php
							break;
						/****************************************/
						//Arriendos
						case 3:
							?>
							<tr class="item-row linea_punteada">
								<td class="item-name"><?php echo $producto['Arri_Sistema'];?></td>
								<td class="item-name"><?php echo n_doc($producto['Arri_idSolicitud'], 5);?></td>
								<td class="item-name"><?php echo $producto['Arri_Nombre'];?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($producto['Arri_Cantidad']).' '.$producto['Arri_Medida'];?></td>
							</tr>
						<?php
							break;
						/****************************************/
						//Servicios
						case 4:
							?>
							<tr class="item-row linea_punteada">
								<td class="item-name"><?php echo $producto['Serv_Sistema'];?></td>
								<td class="item-name"><?php echo n_doc($producto['Serv_idSolicitud'], 5);?></td>
								<td class="item-name"><?php echo $producto['Serv_Nombre'];?></td>
								<td class="item-name"><?php echo Cantidades_decimales_justos($producto['Serv_Cantidad']).' '.$producto['Serv_Medida'];?></td>
							</tr>
						<?php
							break;
					}
				} ?>
			</tbody>
		</table>
    <?php } ?>
  

	<table id="items">
        <tbody>
			<tr><th>Documentos Acompañantes</th></tr>		  
			<?php 
			if (isset($arrDocumentos)){
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrDocumentos as $doc){?>
					<tr class="item-row">
						<td><?php echo $doc['Documento'].' N°'.$doc['NDocPago'].' por '.valores($doc['vTotal'], 0).' (Pago para el '.fecha_estandar($doc['Fpago']).')'; ?></td>
					</tr>
					 
				 <?php 	
				}
			}?>
		</tbody>
    </table>
    <table id="items">
        <tbody>
			<tr><th colspan="6">Archivos Adjuntos</th></tr>		  
			<?php 
			if (isset($arrArchivo)){
				//recorro el lsiatdo entregado por la base de datos
				foreach ($arrArchivo as $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $producto['Nombre']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<a href="1download.php?dir=upload&file=<?php echo $producto['Nombre']; ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
					 
				 <?php 	
				}
			}?>
		</tbody>
    </table>
</div>
<?php widget_modal(80, 95); ?>
