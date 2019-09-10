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
proveedor_listado.Web,
proveedor_listado.Giro,
proveedor_listado.FormaPago,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
proveedor_tipos.Nombre AS tipoCliente,
core_paises.Nombre AS Pais,
core_paises.Flag AS Flag
FROM `proveedor_listado`
LEFT JOIN `core_estados`               ON core_estados.idEstado               = proveedor_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`      ON core_ubicacion_ciudad.idCiudad      = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`     ON core_ubicacion_comunas.idComuna     = proveedor_listado.idComuna
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema             = proveedor_listado.idSistema
LEFT JOIN `proveedor_tipos`            ON proveedor_tipos.idTipo              = proveedor_listado.idTipo
LEFT JOIN `core_paises`                ON core_paises.idPais                  = proveedor_listado.idPais
WHERE proveedor_listado.idProveedor = {$_GET['view']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
proveedor_observaciones.Fecha,
proveedor_observaciones.Observacion
FROM `proveedor_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = proveedor_observaciones.idUsuario
WHERE proveedor_observaciones.idProveedor = {$_GET['view']}
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
array_push( $arrObservaciones,$row );
}




//verifico que sea un administrador
$z1 = "bodegas_productos_facturacion.idSistema = {$_SESSION['usuario']['basic_data']['idSistema']} ";
$z2 = "bodegas_insumos_facturacion.idSistema = {$_SESSION['usuario']['basic_data']['idSistema']}";
$z3 = "bodegas_servicios_facturacion.idSistema = {$_SESSION['usuario']['basic_data']['idSistema']}";

// Se trae un listado con las compras de Productos
$arrProductos = array();
$query = "SELECT 
bodegas_productos_facturacion.idFacturacion,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_productos_facturacion.N_Doc,
bodegas_productos_facturacion.Creacion_fecha

FROM `bodegas_productos_facturacion`
LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos     = bodegas_productos_facturacion.idDocumentos
WHERE ".$z1." AND bodegas_productos_facturacion.idProveedor = {$_GET['view']}
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

// Se trae un listado con las compras de activos
$arrInsumos = array();
$query = "SELECT 
bodegas_insumos_facturacion.idFacturacion,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_insumos_facturacion.N_Doc,
bodegas_insumos_facturacion.Creacion_fecha

FROM `bodegas_insumos_facturacion`
LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos     = bodegas_insumos_facturacion.idDocumentos
WHERE ".$z2." AND bodegas_insumos_facturacion.idProveedor = {$_GET['view']}
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
WHERE ".$z3." AND bodegas_servicios_facturacion.idProveedor = {$_GET['view']}
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
array_push( $arrServicios,$row );
}

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Proveedor</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>
				<li class=""><a href="#productos" data-toggle="tab">Compra de Productos</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="#insumos" data-toggle="tab">Compra de Insumos</a></li>
						<li class=""><a href="#servicios" data-toggle="tab">Pago de Servicios</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th width="50%" class="word_break">Datos</th>
									<th width="50%">Mapa</th>
								</tr>
							</thead>
											  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd">
									<td class="word_break">
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
										<p class="text-muted">
											<strong>Tipo de Proveedor : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
											<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
											<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
											<strong>Fecha de Ingreso : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
											<strong>Pais : </strong><img src="<?php echo DB_SITE.'/LIB_assets/img/flags/'.strtolower($rowdata['Flag']).'.png'; ?>" alt="flag" height="11" width="16"> <?php echo $rowdata['Pais']; ?><br/>
											<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
											<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
											<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
											<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
											<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
											<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
										</p>
											
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
										<p class="text-muted">
											<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
											<strong>Telefono 1 : </strong><?php echo $rowdata['Fono1']; ?><br/>
											<strong>Telefono 2 : </strong><?php echo $rowdata['Fono2']; ?><br/>
											<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
											<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
											<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="http://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
										</p>
										
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Facturacion</h2>
										<p class="text-muted"><strong>Forma de Pago : </strong><?php echo $rowdata['FormaPago']; ?></p>
										
									</td>
									<td>
										<?php 
										$direccion = "";
										if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
										if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
										if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
										echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']) ?>
									</td>
								</tr>                  
							</tbody>
						</table>
					</div>
				</div>
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
											<a href="<?php echo 'view_mov_productos.php?view='.$compras['idFacturacion'].'&return=true'; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
											<a href="<?php echo 'view_mov_insumos.php?view='.$compras['idFacturacion'].'&return=true'; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
											<a href="<?php echo 'view_mov_servicios.php?view='.$compras['idFacturacion'].'&return=true'; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
