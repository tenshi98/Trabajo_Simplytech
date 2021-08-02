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
cotizacion_prospectos_listado.Creacion_fecha,
cotizacion_prospectos_listado.Observaciones,
cotizacion_prospectos_listado.ValorNetoImp,
cotizacion_prospectos_listado.Impuesto_01,
cotizacion_prospectos_listado.Impuesto_02,
cotizacion_prospectos_listado.Impuesto_03,
cotizacion_prospectos_listado.Impuesto_04,
cotizacion_prospectos_listado.Impuesto_05,
cotizacion_prospectos_listado.Impuesto_06,
cotizacion_prospectos_listado.Impuesto_07,
cotizacion_prospectos_listado.Impuesto_08,
cotizacion_prospectos_listado.Impuesto_09,
cotizacion_prospectos_listado.Impuesto_10,
cotizacion_prospectos_listado.ValorTotal,

usuarios_listado.Nombre AS NombreUsuario,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

prospectos_listado.Nombre AS NombreProveedor,
prospectos_listado.email AS EmailProveedor,
prospectos_listado.Rut AS RutProveedor,
clientciudad.Nombre AS CiudadProveedor,
clientcomuna.Nombre AS ComunaProveedor,
prospectos_listado.Direccion AS DireccionProveedor,
prospectos_listado.Fono1 AS Fono1Proveedor,
prospectos_listado.Fono2 AS Fono2Proveedor,
prospectos_listado.Fax AS FaxProveedor,
prospectos_listado.PersonaContacto AS PersonaContactoProveedor,
prospectos_listado.Giro AS GiroProveedor,

cotizacion_prospectos_listado.idSistema

FROM `cotizacion_prospectos_listado`
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario       = cotizacion_prospectos_listado.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema         = cotizacion_prospectos_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad           = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna           = sistema_origen.idComuna
LEFT JOIN `prospectos_listado`                      ON prospectos_listado.idProspecto   = cotizacion_prospectos_listado.idProspecto
LEFT JOIN `core_ubicacion_ciudad`    clientciudad   ON clientciudad.idCiudad            = prospectos_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   clientcomuna   ON clientcomuna.idComuna            = prospectos_listado.idComuna

WHERE cotizacion_prospectos_listado.idCotizacion = ".$X_Puntero;
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
cotizacion_prospectos_listado_existencias_insumos.Cantidad,
cotizacion_prospectos_listado_existencias_insumos.vUnitario,
cotizacion_prospectos_listado_existencias_insumos.vTotal,
sistema_productos_uml.Nombre AS Unidad

FROM `cotizacion_prospectos_listado_existencias_insumos` 
LEFT JOIN `insumos_listado`          ON insumos_listado.idProducto    = cotizacion_prospectos_listado_existencias_insumos.idProducto
LEFT JOIN `sistema_productos_uml`    ON sistema_productos_uml.idUml   = insumos_listado.idUml
WHERE cotizacion_prospectos_listado_existencias_insumos.idCotizacion = ".$X_Puntero;
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
cotizacion_prospectos_listado_existencias_productos.Cantidad,
cotizacion_prospectos_listado_existencias_productos.vUnitario,
cotizacion_prospectos_listado_existencias_productos.vTotal,
sistema_productos_uml.Nombre AS Unidad

FROM `cotizacion_prospectos_listado_existencias_productos` 
LEFT JOIN `productos_listado`          ON productos_listado.idProducto    = cotizacion_prospectos_listado_existencias_productos.idProducto
LEFT JOIN `sistema_productos_uml`      ON sistema_productos_uml.idUml     = productos_listado.idUml
WHERE cotizacion_prospectos_listado_existencias_productos.idCotizacion = ".$X_Puntero;
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
cotizacion_prospectos_listado_existencias_arriendos.Cantidad,
cotizacion_prospectos_listado_existencias_arriendos.vUnitario,
cotizacion_prospectos_listado_existencias_arriendos.vTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `cotizacion_prospectos_listado_existencias_arriendos` 
LEFT JOIN `equipos_arriendo_listado`    ON equipos_arriendo_listado.idEquipo     = cotizacion_prospectos_listado_existencias_arriendos.idEquipo
LEFT JOIN `core_tiempo_frecuencia`      ON core_tiempo_frecuencia.idFrecuencia   = cotizacion_prospectos_listado_existencias_arriendos.idFrecuencia
WHERE cotizacion_prospectos_listado_existencias_arriendos.idCotizacion = ".$X_Puntero;
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
cotizacion_prospectos_listado_existencias_servicios.Cantidad,
cotizacion_prospectos_listado_existencias_servicios.vUnitario,
cotizacion_prospectos_listado_existencias_servicios.vTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia

FROM `cotizacion_prospectos_listado_existencias_servicios` 
LEFT JOIN `servicios_listado`       ON servicios_listado.idServicio          = cotizacion_prospectos_listado_existencias_servicios.idServicio
LEFT JOIN `core_tiempo_frecuencia`  ON core_tiempo_frecuencia.idFrecuencia   = cotizacion_prospectos_listado_existencias_servicios.idFrecuencia
WHERE cotizacion_prospectos_listado_existencias_servicios.idCotizacion = ".$X_Puntero;
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
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `cotizacion_prospectos_listado_archivos` 
WHERE idCotizacion = ".$X_Puntero;
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
array_push( $arrArchivo,$row );
}
/*****************************************/		
// Se trae un listado con todos los impuestos existentes
$arrImpuestos = array();
$query = "SELECT Nombre, Porcentaje
FROM `sistema_impuestos`
ORDER BY idImpuesto ASC ";
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
array_push( $arrImpuestos,$row );
}


?>

		
<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Cotizacion <?php echo n_doc($X_Puntero, 5); ?>.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['Creacion_fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php 
		echo '
				<div class="col-sm-4 invoice-col">
					Empresa Emisora
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						'.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono: '.$row_data['SistemaOrigenFono'].'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				
				<div class="col-sm-4 invoice-col">
					Empresa Receptora
					<address>
						<strong>'.$row_data['NombreProveedor'].'</strong><br/>
						'.$row_data['CiudadProveedor'].', '.$row_data['ComunaProveedor'].'<br/>
						'.$row_data['DireccionProveedor'].'<br/>
						Fono Fijo: '.$row_data['Fono1Proveedor'].'<br/>
						Celular: '.$row_data['Fono2Proveedor'].'<br/>
						Fax: '.$row_data['FaxProveedor'].'<br/>
						Rut: '.$row_data['RutProveedor'].'<br/>
						Email: '.$row_data['EmailProveedor'].'<br/>
						Contacto: '.$row_data['PersonaContactoProveedor'].'<br/>
						Giro de la Empresa: '.$row_data['GiroProveedor'].'
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					Vendedor: '.$row_data['NombreUsuario'].'<br/>
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
				</tbody>
			</table>
			<table class="table">
				<tbody>	
					<?php
					//Recorro y guard el nombre de los impuestos 
					$nn = 0;
					$impuestos = array();
					foreach ($arrImpuestos as $impto) { 
						$impuestos[$nn]['nimp'] = $impto['Nombre'].' ('.Cantidades_decimales_justos($impto['Porcentaje']).'%)';
						$nn++;
					}?>
					<?php if(isset($row_data['ValorNetoImp'])&&$row_data['ValorNetoImp']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Neto Imponible</strong></td> 
							<td width="160" align="right"><?php echo Valores($row_data['ValorNetoImp'], 0); ?></td>
						</tr>
					<?php } ?>
					
					<?php if(isset($row_data['Impuesto_01'])&&$row_data['Impuesto_01']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[0]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_01'], 0); ?></td>
						</tr>
					<?php } ?>
					
					<?php if(isset($row_data['Impuesto_02'])&&$row_data['Impuesto_02']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[1]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_02'], 0); ?></td>
						</tr>
					<?php } ?>
					
					<?php if(isset($row_data['Impuesto_03'])&&$row_data['Impuesto_03']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[2]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_03'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_04'])&&$row_data['Impuesto_04']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[3]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_04'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_05'])&&$row_data['Impuesto_05']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[4]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_05'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_06'])&&$row_data['Impuesto_06']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[5]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_06'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_07'])&&$row_data['Impuesto_07']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[6]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_07'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_08'])&&$row_data['Impuesto_08']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[7]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_08'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_09'])&&$row_data['Impuesto_09']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[8]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_09'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['Impuesto_10'])&&$row_data['Impuesto_10']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong><?php echo $impuestos[9]['nimp']; ?></strong></td> 
							<td align="right"><?php echo Valores($row_data['Impuesto_10'], 0); ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($row_data['ValorTotal'])&&$row_data['ValorTotal']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Total</strong></td> 
							<td align="right"><?php echo Valores($row_data['ValorTotal'], 0); ?></td>
						</tr>
					<?php } ?>
				
				</tbody>
			</table>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Condiciones Comerciales:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Observaciones'];?></p>
		</div>
	</div>
	
	
      
</section>

<div class="col-xs-12" style="margin-bottom:15px;">
	
	
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
								<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Documento" class="btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="1download.php?dir=<?php echo simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($producto['Nombre'], fecha_actual()); ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
					 
				 <?php 	
				}
			}?>
		</tbody>
    </table>
</div>




		
	<div class="col-xs-12" style="margin-bottom:30px">
		<a target="new" href="view_cotizacion_prospectos_to_print.php?view=<?php echo $_GET['view'] ?>" class="btn btn-default pull-right" style="margin-right: 5px;">
			<i class="fa fa-print" aria-hidden="true"></i> Imprimir
		</a>
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
