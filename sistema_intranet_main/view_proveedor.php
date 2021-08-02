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
// Se traen todos los datos del proveedor
$query = "SELECT  
proveedor_listado.email, 
proveedor_listado.Nombre, 
proveedor_listado.Rut, 
proveedor_listado.fNacimiento, 
proveedor_listado.Direccion, 
proveedor_listado.Fono1, 
proveedor_listado.Fono2, 
proveedor_listado.Fax,
proveedor_listado.PersonaContacto,
proveedor_listado.PersonaContacto_Fono, 
proveedor_listado.PersonaContacto_email,
proveedor_listado.PersonaContacto_Cargo,
proveedor_listado.Web,
proveedor_listado.Giro,
proveedor_listado.FormaPago,
proveedor_listado.idTipo,
proveedor_listado.RazonSocial, 
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
proveedor_tipos.Nombre AS tipoCliente,
core_rubros.Nombre AS Rubro,
core_paises.Nombre AS Pais,
core_paises.Flag AS Flag

FROM `proveedor_listado`
LEFT JOIN `core_estados`               ON core_estados.idEstado               = proveedor_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`      ON core_ubicacion_ciudad.idCiudad      = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`     ON core_ubicacion_comunas.idComuna     = proveedor_listado.idComuna
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema             = proveedor_listado.idSistema
LEFT JOIN `proveedor_tipos`            ON proveedor_tipos.idTipo              = proveedor_listado.idTipo
LEFT JOIN `core_rubros`                ON core_rubros.idRubro                 = proveedor_listado.idRubro
LEFT JOIN `core_paises`                ON core_paises.idPais                  = proveedor_listado.idPais
WHERE proveedor_listado.idProveedor = ".$X_Puntero;
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
$rowdata = mysqli_fetch_assoc ($resultado);	

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
proveedor_observaciones.Fecha,
proveedor_observaciones.Observacion
FROM `proveedor_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = proveedor_observaciones.idUsuario
WHERE proveedor_observaciones.idProveedor = ".$X_Puntero."
ORDER BY proveedor_observaciones.idObservacion ASC 
LIMIT 15 ";
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
array_push( $arrObservaciones,$row );
}




//verifico que sea un administrador
$z1 = "bodegas_productos_facturacion.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
$z2 = "bodegas_insumos_facturacion.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
$z3 = "bodegas_servicios_facturacion.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];

// Se trae un listado con las compras de Productos
$arrProductos = array();
$query = "SELECT 
bodegas_productos_facturacion.idFacturacion,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_productos_facturacion.N_Doc,
bodegas_productos_facturacion.Creacion_fecha

FROM `bodegas_productos_facturacion`
LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos     = bodegas_productos_facturacion.idDocumentos
WHERE ".$z1." AND bodegas_productos_facturacion.idProveedor = ".$X_Puntero."
ORDER BY bodegas_productos_facturacion.idFacturacion DESC
LIMIT 15 ";
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

// Se trae un listado con las compras de activos
$arrInsumos = array();
$query = "SELECT 
bodegas_insumos_facturacion.idFacturacion,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_insumos_facturacion.N_Doc,
bodegas_insumos_facturacion.Creacion_fecha

FROM `bodegas_insumos_facturacion`
LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos     = bodegas_insumos_facturacion.idDocumentos
WHERE ".$z2." AND bodegas_insumos_facturacion.idProveedor = ".$X_Puntero."
ORDER BY bodegas_insumos_facturacion.idFacturacion DESC
LIMIT 15 ";
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

// Se trae un listado con las compras de activos
$arrServicios = array();
$query = "SELECT 
bodegas_servicios_facturacion.idFacturacion,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_servicios_facturacion.N_Doc,
bodegas_servicios_facturacion.Creacion_fecha

FROM `bodegas_servicios_facturacion`
LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos     = bodegas_servicios_facturacion.idDocumentos
WHERE ".$z3." AND bodegas_servicios_facturacion.idProveedor = ".$X_Puntero."
ORDER BY bodegas_servicios_facturacion.idFacturacion DESC
LIMIT 15 ";
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

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Proveedor</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab"><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
				<li class=""><a href="#productos" data-toggle="tab"><i class="fa fa-cc-visa" aria-hidden="true"></i> Compra de Productos</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="#insumos" data-toggle="tab"><i class="fa fa-cc-visa" aria-hidden="true"></i> Compra de Insumos</a></li>
						<li class=""><a href="#servicios" data-toggle="tab"><i class="fa fa-cc-visa" aria-hidden="true"></i> Pago de Servicios</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="col-sm-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-sm-12">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
							<p class="text-muted word_break">
								<strong>Tipo de Proveedor : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
								<?php 
								//Si el cliente es una empresa
								if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
									<strong>Nombre Fantasia: </strong><?php echo $rowdata['Nombre']; ?><br/>
								<?php 
								//si es una persona
								}else{ ?>
									<strong>Nombre: </strong><?php echo $rowdata['Nombre']; ?><br/>
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
								<?php } ?>
								<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
								<strong>Pais : </strong> <img src="<?php echo DB_SITE_REPO.'/LIB_assets/img/flags/'.strtolower($rowdata['Flag']).'.png'; ?>" alt="flag" height="11" width="16"> <?php echo $rowdata['Pais']; ?><br/>
								<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
								<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
								<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
								<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
							</p>
									
							<?php 
							//Si el proveedor es una empresa
							if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Comerciales</h2>
								<p class="text-muted word_break">
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
									<strong>Razon Social : </strong><?php echo $rowdata['RazonSocial']; ?><br/>
									<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
									<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?><br/>
								</p>
							<?php } ?>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Telefono Fijo : </strong><?php echo $rowdata['Fono1']; ?><br/>
								<strong>Telefono Movil : </strong><?php echo $rowdata['Fono2']; ?><br/>
								<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
								<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="https://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Persona de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
								<strong>Cargo Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto_Cargo']; ?><br/>
								<strong>Telefono : </strong><?php echo $rowdata['PersonaContacto_Fono']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Facturacion</h2>
							<p class="text-muted word_break"><strong>Forma de Pago : </strong><?php echo $rowdata['FormaPago']; ?></p>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<?php 
							//se arma la direccion
							$direccion = "";
							if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
							if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
							if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
							//se despliega mensaje en caso de no existir direccion
							if($direccion!=''){
								echo mapa_from_direccion($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1); 
							}else{
								$Alert_Text  = 'No tiene una direccion definida';
								alert_post_data(4,2,2, $Alert_Text);
							}
						?>
					</div>
				</div>
				<div class="clearfix"></div>
				
			</div>
			
			<div class="tab-pane fade" id="observaciones">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Autor</th>
									<th width="120">Fecha</th>
									<th>Observacion</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrObservaciones as $observaciones) { ?>
								<tr class="odd">		
									<td><?php echo $observaciones['nombre_usuario']; ?></td>
									<td><?php echo $observaciones['Fecha']; ?></td>		
									<td class="word_break"><?php echo $observaciones['Observacion']; ?></td>	
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="productos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Documento</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrProductos as $compras) { ?>
								<tr class="odd">		
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="<?php echo 'view_mov_productos.php?view='.simpleEncode($compras['idFacturacion'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
										</div>
										<?php echo $compras['Documento'].' N°'.$compras['N_Doc']; ?>
									</td>
									<td><?php echo Fecha_estandar($compras['Creacion_fecha']); ?></td>			
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
			<div class="tab-pane fade" id="insumos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Documento</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrInsumos as $compras) { ?>
								<tr class="odd">		
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="<?php echo 'view_mov_insumos.php?view='.simpleEncode($compras['idFacturacion'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
										</div>
										<?php echo $compras['Documento'].' N°'.$compras['N_Doc']; ?>
									</td>
									<td><?php echo Fecha_estandar($compras['Creacion_fecha']); ?></td>			
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="servicios">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Documento</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrServicios as $compras) { ?>
								<tr class="odd">		
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="<?php echo 'view_mov_servicios.php?view='.simpleEncode($compras['idFacturacion'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
										</div>
										<?php echo $compras['Documento'].' N°'.$compras['N_Doc']; ?>
									</td>
									<td><?php echo Fecha_estandar($compras['Creacion_fecha']); ?></td>			
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
        </div>	
	</div>
</div>

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
