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
clientes_listado.email, 
clientes_listado.Nombre, 
clientes_listado.Rut, 
clientes_listado.RazonSocial, 
clientes_listado.fNacimiento, 
clientes_listado.Direccion, 
clientes_listado.Fono1, 
clientes_listado.Fono2, 
clientes_listado.Fax,
clientes_listado.PersonaContacto,
clientes_listado.PersonaContacto_Fono,
clientes_listado.PersonaContacto_email,
clientes_listado.PersonaContacto_Cargo,
clientes_listado.Web,
clientes_listado.Giro,
clientes_listado.idTipo,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
clientes_tipos.Nombre AS tipoCliente,
core_rubros.Nombre AS Rubro, 
clientes_listado.Contrato_Nombre, 
clientes_listado.Contrato_Numero, 
core_cross_cliente.Nombre AS Contrato_Periodo,
clientes_listado.Contrato_Fecha_Ini, 
clientes_listado.Contrato_Fecha_Term, 
clientes_listado.Contrato_N_Meses,
clientes_listado.Contrato_Representante_Legal,
clientes_listado.Contrato_Representante_Rut,
clientes_listado.Contrato_Representante_Fono,
clientes_listado.Contrato_Valor_Mensual, 
clientes_listado.Contrato_Valor_Anual,
clientes_listado.Contrato_UF_Instalacion ,
clientes_listado.Contrato_UF_Mensual,
clientes_listado.Contrato_Obs,
clientes_listado.idTab_1,
clientes_listado.idTab_2,
clientes_listado.idTab_3,
clientes_listado.idTab_4,
clientes_listado.idTab_5,
clientes_listado.idTab_6,
clientes_listado.idTab_7,
clientes_listado.idTab_8

FROM `clientes_listado`
LEFT JOIN `core_estados`              ON core_estados.idEstado                    = clientes_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`     ON core_ubicacion_ciudad.idCiudad           = clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`    ON core_ubicacion_comunas.idComuna          = clientes_listado.idComuna
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema                  = clientes_listado.idSistema
LEFT JOIN `clientes_tipos`            ON clientes_tipos.idTipo                    = clientes_listado.idTipo
LEFT JOIN `core_rubros`               ON core_rubros.idRubro                      = clientes_listado.idRubro
LEFT JOIN `core_cross_cliente`        ON core_cross_cliente.idPeriodo             = clientes_listado.Contrato_idPeriodo

WHERE clientes_listado.idCliente = ".$X_Puntero;
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

/*******************************************/
//Listado con los tabs
$arrTabs = array();
$arrTabs = db_select_array (false, 'idTab, Nombre', 'core_telemetria_tabs', '', '', 'idTab ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTabs');

//recorro
$arrTabsSorter = array();
foreach ($arrTabs as $tab) {
	$arrTabsSorter[$tab['idTab']] = $tab['Nombre'];
}

/**********************************************************/
// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
clientes_observaciones.Fecha,
clientes_observaciones.Observacion
FROM `clientes_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = clientes_observaciones.idUsuario
WHERE clientes_observaciones.idCliente = ".$X_Puntero."
ORDER BY clientes_observaciones.idObservacion ASC 
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

/**********************************************************/
//verifico que sea un administrador
$z1 = "bodegas_productos_facturacion.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];

// Se trae un listado con las compras de Productos
$arrVentas = array();
$query = "SELECT 
bodegas_productos_facturacion.idFacturacion,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_productos_facturacion.N_Doc,
bodegas_productos_facturacion.Creacion_fecha

FROM `bodegas_productos_facturacion`
LEFT JOIN `core_documentos_mercantiles`   ON core_documentos_mercantiles.idDocumentos     = bodegas_productos_facturacion.idDocumentos
WHERE ".$z1." AND bodegas_productos_facturacion.idCliente = ".$X_Puntero."
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
array_push( $arrVentas,$row );
}

/**********************************************************/
//Variable de busqueda
$z = "WHERE cotizacion_listado.idCliente = ".$X_Puntero;
$z.= " AND cotizacion_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//verifico que sea un administrador
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z.="  AND cotizacion_listado.idUsuario=".$_SESSION['usuario']['basic_data']['idUsuario'];	
}
//consulta
$arrCotizaciones = array();
$query = "SELECT 
cotizacion_listado.idCotizacion,
cotizacion_listado.Creacion_fecha,
clientes_listado.Nombre AS Cliente

FROM `cotizacion_listado`
LEFT JOIN `clientes_listado`   ON clientes_listado.idCliente   = cotizacion_listado.idCliente 

".$z." 
ORDER BY cotizacion_listado.idCotizacion DESC, cotizacion_listado.Creacion_fecha DESC";
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
array_push( $arrCotizaciones,$row );
}

?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Cliente</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<?php if(!empty($arrObservaciones)){ ?>
					<li class=""><a href="#observaciones" data-toggle="tab"><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
				<?php } ?>
				<?php if(!empty($arrVentas)){ ?>
					<li class=""><a href="#ventas" data-toggle="tab"><i class="fa fa-usd" aria-hidden="true"></i> Ventas realizadas</a></li>
				<?php } ?>
				<?php if(!empty($arrCotizaciones)){ ?>
					<li class=""><a href="#cotizaciones" data-toggle="tab"><i class="fa fa-search" aria-hidden="true"></i> Cotizaciones realizadas</a></li>
				<?php } ?>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="col-sm-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-sm-12">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
							<p class="text-muted word_break">
								<strong>Tipo de Cliente : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
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
								<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
								<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
								<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
								<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
							</p>
										
							<?php 
							//Si el cliente es una empresa
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
							
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Contrato</h2>
							<p class="text-muted word_break">
								<strong>Nombre : </strong><?php echo $rowdata['Contrato_Nombre']; ?><br/>
								<strong>Numero o Codigo : </strong><?php echo $rowdata['Contrato_Numero']; ?><br/>
								<strong>Periodo : </strong><?php echo $rowdata['Contrato_Periodo']; ?><br/>
								<strong>Fecha inicio : </strong><?php echo fecha_estandar($rowdata['Contrato_Fecha_Ini']); ?><br/>
								<strong>Fecha termino : </strong><?php echo fecha_estandar($rowdata['Contrato_Fecha_Term']); ?><br/>
								<strong>Duracion N° Meses : </strong><?php echo Cantidades_decimales_justos($rowdata['Contrato_N_Meses']); ?><br/>
								<strong>Representante Legal Nombre : </strong><?php echo $rowdata['Contrato_Representante_Legal']; ?><br/>
								<strong>Representante Legal Rut : </strong><?php echo $rowdata['Contrato_Representante_Rut']; ?><br/>
								<strong>Representante Legal Fono : </strong><?php echo $rowdata['Contrato_Representante_Fono']; ?><br/>
								<strong>Valor Mensual : </strong><?php echo valores($rowdata['Contrato_Valor_Mensual'], 0); ?><br/>
								<strong>Valor Anual : </strong><?php echo valores($rowdata['Contrato_Valor_Anual'], 0); ?><br/>
								<strong>Valor UF instalacion : </strong><?php echo Cantidades_decimales_justos($rowdata['Contrato_UF_Instalacion']); ?><br/>
								<strong>Valor UF mensual : </strong><?php echo Cantidades_decimales_justos($rowdata['Contrato_UF_Mensual']); ?><br/>
								<strong>Observaciones : </strong><br/>
								<div class="text-muted well well-sm no-shadow">
									<?php if(isset($rowdata['Contrato_Obs'])&&$rowdata['Contrato_Obs']!=''){echo $rowdata['Contrato_Obs'];}else{echo 'Sin Observaciones';} ?>
									<div class="clearfix"></div>
								</div>
							</p>
							
							<?php if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==7){?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Unidades de Negocio</h2>
								<p class="text-muted word_break">
									<?php 
										if(isset($rowdata['idTab_1'])&&$rowdata['idTab_1']==2&&isset($arrTabsSorter[1])){ echo ' - '.$arrTabsSorter[1].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 1, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_2'])&&$rowdata['idTab_2']==2&&isset($arrTabsSorter[2])){ echo ' - '.$arrTabsSorter[2].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 2, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_3'])&&$rowdata['idTab_3']==2&&isset($arrTabsSorter[3])){ echo ' - '.$arrTabsSorter[3].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 3, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_4'])&&$rowdata['idTab_4']==2&&isset($arrTabsSorter[4])){ echo ' - '.$arrTabsSorter[4].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 4, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_5'])&&$rowdata['idTab_5']==2&&isset($arrTabsSorter[5])){ echo ' - '.$arrTabsSorter[5].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 5, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_6'])&&$rowdata['idTab_6']==2&&isset($arrTabsSorter[6])){ echo ' - '.$arrTabsSorter[6].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 6, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_7'])&&$rowdata['idTab_7']==2&&isset($arrTabsSorter[7])){ echo ' - '.$arrTabsSorter[7].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 7, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';}
										if(isset($rowdata['idTab_8'])&&$rowdata['idTab_8']==2&&isset($arrTabsSorter[8])){ echo ' - '.$arrTabsSorter[8].' <a target="new" href="view_cliente_contrato.php?view='.$_GET['view'].'&idTab='.simpleEncode( 8, fecha_actual()).'" class="btn btn-default btn-sm"><i class="fa fa-file-word-o" aria-hidden="true"></i> Exportar Contrato Tipo</a><br/>';} 
									?>
								</p>			
							<?php } ?>
							
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
			
			<?php if(!empty($arrObservaciones)){ ?>
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
			<?php } ?>
			
			
			<?php if(!empty($arrVentas)){ ?>
				<div class="tab-pane fade" id="ventas">
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
								<?php foreach ($arrVentas as $venta) { ?>
									<tr class="odd">		
										<td>
											<div class="btn-group" style="width: 35px;" >
												<a href="<?php echo 'view_mov_productos.php?view='.simpleEncode($venta['idFacturacion'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
											</div>
											<?php echo $venta['Documento'].' N°'.$venta['N_Doc']; ?>
										</td>
										<td><?php echo Fecha_estandar($venta['Creacion_fecha']); ?></td>			
									</tr>
								<?php } ?>                    
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
			
			
			<?php if(!empty($arrCotizaciones)){ ?>
				<div class="tab-pane fade" id="cotizaciones">
					<div class="wmd-panel">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>N° Doc</th>
										<th width="120">Fecha</th>
										<th width="10">Acciones</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrCotizaciones as $sol) { ?>
										<tr class="odd">
											<td><?php echo 'Cotizacion N°'.n_doc($sol['idCotizacion'], 5); ?></td>
											<td><?php echo Fecha_estandar($sol['Creacion_fecha']); ?></td>
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a href="<?php echo 'view_cotizacion.php?view='.simpleEncode($sol['idCotizacion'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Orden" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
												</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
			
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
