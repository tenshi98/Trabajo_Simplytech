<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Print.php';
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
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono1,
sistema_origen.Contacto_Fono2 AS SistemaOrigenFono2,
sistema_origen.Contacto_Web AS SistemaOrigenWeb,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,
sistema_origen.Config_imgLogo AS SistemaLogo,

prospectos_listado.Nombre AS NombreProspecto,
prospectos_listado.email AS EmailProspecto,
prospectos_listado.Rut AS RutProspecto,
clientciudad.Nombre AS CiudadProspecto,
clientcomuna.Nombre AS ComunaProspecto,
prospectos_listado.Direccion AS DireccionProspecto,
prospectos_listado.Fono1 AS Fono1Prospecto,
prospectos_listado.Fono2 AS Fono2Prospecto,
prospectos_listado.Fax AS FaxProspecto,
prospectos_listado.PersonaContacto AS PersonaContactoProspecto,
prospectos_listado.Giro AS GiroProspecto,

cotizacion_prospectos_listado.idSistema

FROM `cotizacion_prospectos_listado`
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario       = cotizacion_prospectos_listado.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema         = cotizacion_prospectos_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad           = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna           = sistema_origen.idComuna
LEFT JOIN `prospectos_listado`                      ON prospectos_listado.idProspecto   = cotizacion_prospectos_listado.idProspecto
LEFT JOIN `core_ubicacion_ciudad`    clientciudad   ON clientciudad.idCiudad            = prospectos_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   clientcomuna   ON clientcomuna.idComuna            = prospectos_listado.idComuna

WHERE cotizacion_prospectos_listado.idCotizacion = {$_GET['view']} ";
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
WHERE cotizacion_prospectos_listado_existencias_insumos.idCotizacion = {$_GET['view']} ";
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
WHERE cotizacion_prospectos_listado_existencias_productos.idCotizacion = {$_GET['view']} ";
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
WHERE cotizacion_prospectos_listado_existencias_arriendos.idCotizacion = {$_GET['view']} ";
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
WHERE cotizacion_prospectos_listado_existencias_servicios.idCotizacion = {$_GET['view']} ";
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
/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `cotizacion_prospectos_listado_archivos` 
WHERE idCotizacion = {$_GET['view']} ";
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
array_push( $arrImpuestos,$row );
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Print.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
$html ='
<style>
body {font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;}
table {border-collapse: collapse;border-spacing: 0;}
table > tbody > tr > td{border: 1px solid #bbb;padding-left:5px;padding-rigth:5px;}
tr.oddrow td{display: line;border-bottom: 1px solid #EEE;}
.tableline td, .tableline th{border-bottom: 1px solid #EEE;line-height: 1.42857143;}
table .title{background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-transform: uppercase; padding: 8px 0px;}
</style>


<div class="row">
	<div class="col-xs-12">
			
		
		<table style="margin: 1%; width: 98%;"   cellpadding="10" cellspacing="0">
			<tr>
				<td style="padding: 10px;" valign="top">
			
					<table style="text-align: left; width: 100%;"  cellpadding="0" cellspacing="0">
						<tr>
							<td width="50%">';
							if(isset($row_data['SistemaLogo'])&&$row_data['SistemaLogo']!=''){
								$html .= '<img src="upload/'.$row_data['SistemaLogo'].'" alt="" style="width:100%">';
							}else{
								$html .= '<img src="../LIB_assets/img/logo_empresa.jpg" alt="" style="width:100%">';
							}
							$html .= '
							</td>
							<td width="50%" style="text-align: left; font-size: 16px;">
								<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
								<strong>Rut : </strong>'.$row_data['SistemaOrigenRut'].'<br/>
								<strong>Teléfonos : </strong>'.$row_data['SistemaOrigenFono1'].' - '.$row_data['SistemaOrigenFono2'].'<br/>
								<strong>Dirección Comercial : </strong>'.$row_data['SistemaOrigenDireccion'].', '.$row_data['SistemaOrigenComuna'].', '.$row_data['SistemaOrigenCiudad'].'<br/>
								<strong>E-mail : </strong>'.$row_data['SistemaOrigenEmail'].'<br/>
								<strong>Web : </strong>'.$row_data['SistemaOrigenWeb'].'<br/>
									
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td style="text-align: right;">Cotizacion Nº '.n_doc($_GET['view'], 5).'</td>
						</tr>
						<tr>
							<td>
								<strong>Fecha : </strong>'.Fecha_estandar($row_data['Creacion_fecha']).'<br/>
								<strong>Empresa : </strong>'.$row_data['NombreProspecto'].'<br/>
								<strong>Dirección : </strong>'.$row_data['DireccionProspecto'].'<br/>
								<strong>Fono : </strong>'.$row_data['Fono1Prospecto'].' - '.$row_data['Fono2Prospecto'].'<br/>
								<strong>Giro : </strong>'.$row_data['GiroProspecto'].'<br/>
								<strong>Solicita : </strong>'.$row_data['PersonaContactoProspecto'].'<br/>
								
							
							</td>
							<td>
								<strong>Lugar : </strong>'.$row_data['SistemaOrigenComuna'].', '.$row_data['SistemaOrigenCiudad'].'<br/>
								<strong>RUT : </strong>'.$row_data['RutProspecto'].'<br/>
								<strong>Ciudad/Comuna : </strong>'.$row_data['ComunaProspecto'].'<br/>
								<strong>Region : </strong>'.$row_data['CiudadProspecto'].'<br/>
								<strong>Email : </strong>'.$row_data['EmailProspecto'].'<br/>
								<strong>Cargo : </strong><br/>
							</td>
						</tr>

						<tr>
							<td colspan="2" style="padding: 10px;">
								Estimado Señor: De acuerdo a lo solicitado,tengo el agrado de hacerle llegar la siguiente cotizacion de nuestros productos.
							</td>
						</tr>
					</table>
					<br/>
			 
					<table style="text-align: left; width: 100%;"  cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="6" class="title">Antecedentes producto/servicio</td>
						</tr>
						<tr>
							<td>Item</td>
							<td>Cantidad</td>
							<td>Unidad</td>
							<td>Descripcion</td>
							<td>Valor Unitario</td>
							<td>Subtotal</td>
						</tr>';
					
						$nn = 1;
						$total = 0;
						//Listado de productos solicitados
						foreach ($arrProductos as $prod) { 
						$html .= '<tr>
								<td>'.$nn.'</td>
								<td>'.Cantidades_decimales_justos($prod['Cantidad']).'</td>
								<td>'.$prod['Unidad'].'</td>
								<td>'.$prod['Nombre'].'</td>
								<td align="right">'.Valores($prod['vUnitario'], 0).'</td>
								<td align="right">'.Valores($prod['vTotal'], 0).'</td>
							</tr>';
						$total = $total + $prod['vTotal'];
						$nn++;
						}
						//listado de insumos solicitados
						foreach ($arrInsumos as $prod) { 
						$html .= '<tr>
								<td>'.$nn.'</td>
								<td>'.Cantidades_decimales_justos($prod['Cantidad']).'</td>
								<td>'.$prod['Unidad'].'</td>
								<td>'.$prod['Nombre'].'</td>
								<td align="right">'.Valores($prod['vUnitario'], 0).'</td>
								<td align="right">'.Valores($prod['vTotal'], 0).'</td>
							</tr>';
						$total = $total + $prod['vTotal'];
						$nn++;
						}
						//listado de arriendos solicitados
						foreach ($arrArriendos as $prod) { 
						$html .= '<tr>
								<td>'.$nn.'</td>
								<td>'.Cantidades_decimales_justos($prod['Cantidad']).'</td>
								<td>'.$prod['Frecuencia'].'</td>
								<td>'.$prod['Nombre'].'</td>
								<td align="right">'.Valores($prod['vUnitario'], 0).'</td>
								<td align="right">'.Valores($prod['vTotal'], 0).'</td>
							</tr>';
						$total = $total + $prod['vTotal'];
						$nn++;
						}
						//listado de servicios solicitados
						foreach ($arrServicios as $prod) { 
						$html .= '<tr>
								<td>'.$nn.'</td>
								<td>'.Cantidades_decimales_justos($prod['Cantidad']).'</td>
								<td>'.$prod['Frecuencia'].'</td>
								<td>'.$prod['Nombre'].'</td>
								<td align="right">'.Valores($prod['vUnitario'], 0).'</td>
								<td align="right">'.Valores($prod['vTotal'], 0).'</td>
							</tr>';
						$total = $total + $prod['vTotal'];
						$nn++;
						}
						//se completan las lineas
						for ($i = $nn; $i <= 18; $i++) {
							$html .= '
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>';
						}

					
					
					//Recorro y guard el nombre de los impuestos 
					$nn = 0;
					$impuestos = array();
					foreach ($arrImpuestos as $impto) { 
						$impuestos[$nn]['nimp'] = $impto['Nombre'].' ('.Cantidades_decimales_justos($impto['Porcentaje']).'%)';
						$nn++;
					}
					if(isset($row_data['ValorNetoImp'])&&$row_data['ValorNetoImp']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>Neto Imponible</strong></td> 
							<td align="right">'.Valores($row_data['ValorNetoImp'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_01'])&&$row_data['Impuesto_01']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[0]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_01'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_02'])&&$row_data['Impuesto_02']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[1]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_02'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_03'])&&$row_data['Impuesto_03']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[2]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_03'], 0).'</td>
						</tr>';
					} 
					if(isset($row_data['Impuesto_04'])&&$row_data['Impuesto_04']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[3]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_04'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_05'])&&$row_data['Impuesto_05']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[4]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_05'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_06'])&&$row_data['Impuesto_06']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[5]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_06'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_07'])&&$row_data['Impuesto_07']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[6]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_07'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_08'])&&$row_data['Impuesto_08']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[7]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_08'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_09'])&&$row_data['Impuesto_09']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[8]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_09'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_10'])&&$row_data['Impuesto_10']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>'.$impuestos[9]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_10'], 0).'</td>
						</tr>';
					} 
					if(isset($row_data['ValorTotal'])&&$row_data['ValorTotal']!=0){
						$html .= '
						<tr>
							<td colspan="5" align="right"><strong>Total</strong></td> 
							<td align="right">'.Valores($row_data['ValorTotal'], 0).'</td>
						</tr>';
					}
				
		
					$html .= '
			</table>

			
			  
					
			
					<br/>
					<table style="text-align: left; width: 100%;"  cellpadding="0" cellspacing="0">
						<tr>
							<td class="title">Condiciones Comerciales</td>
						</tr>
						<tr>
							<td style="padding: 10px;">'.$row_data['Observaciones'].'</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>
		
		
			
	</div>   
</div>';
	
echo $html;
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';
?>
