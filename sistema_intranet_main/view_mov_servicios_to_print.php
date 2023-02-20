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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
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
// consulto los datos
$SIS_query = '
bodegas_servicios_facturacion.idTipo,
bodegas_servicios_facturacion.idFacturacion,
bodegas_servicios_facturacion.Creacion_fecha,
bodegas_servicios_facturacion.N_Doc,
bodegas_servicios_facturacion.Observaciones,
bodegas_servicios_facturacion.idOcompra,
bodegas_servicios_facturacion.OC_Ventas,
bodegas_servicios_facturacion_tipo.Nombre AS TipoDoc,
core_documentos_mercantiles.Nombre AS Documento,
usuarios_listado.Nombre AS NombreUsuario,
bodegas_servicios_facturacion.ValorNeto,
bodegas_servicios_facturacion.ValorNetoImp,
bodegas_servicios_facturacion.Impuesto_01,
bodegas_servicios_facturacion.Impuesto_02,
bodegas_servicios_facturacion.Impuesto_03,
bodegas_servicios_facturacion.Impuesto_04,
bodegas_servicios_facturacion.Impuesto_05,
bodegas_servicios_facturacion.Impuesto_06,
bodegas_servicios_facturacion.Impuesto_07,
bodegas_servicios_facturacion.Impuesto_08,
bodegas_servicios_facturacion.Impuesto_09,
bodegas_servicios_facturacion.Impuesto_10,
bodegas_servicios_facturacion.ValorTotal,
bodegas_servicios_facturacion.fecha_fact_desde,
bodegas_servicios_facturacion.fecha_fact_hasta,
bodegas_servicios_facturacion.idUsoIVA,

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

core_estado_facturacion.Nombre AS Estado,
bodegas_servicios_facturacion.Pago_fecha,
sistema_documentos_pago.Nombre AS DocPago,
bodegas_servicios_facturacion.N_DocPago,
bodegas_servicios_facturacion.F_Pago,

clientes_listado.Nombre AS NombreCliente,
clientes_listado.email AS EmailCliente,
clientes_listado.Rut AS RutCliente,
clienciudad.Nombre AS CiudadCliente,
cliencomuna.Nombre AS ComunaCliente,
clientes_listado.Direccion AS DireccionCliente,
clientes_listado.Fono1 AS Fono1Cliente,
clientes_listado.Fono2 AS Fono2Cliente,
clientes_listado.Fax AS FaxCliente,
clientes_listado.PersonaContacto AS PersonaContactoCliente,
clientes_listado.Giro AS GiroCliente,

trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellido,

centrocosto_listado.Nombre AS CentroCosto_Nombre,
centrocosto_listado_level_1.Nombre AS CentroCosto_Level_1,
centrocosto_listado_level_2.Nombre AS CentroCosto_Level_2,
centrocosto_listado_level_3.Nombre AS CentroCosto_Level_3,
centrocosto_listado_level_4.Nombre AS CentroCosto_Level_4,
centrocosto_listado_level_5.Nombre AS CentroCosto_Level_5';
$SIS_join  = '
LEFT JOIN `bodegas_servicios_facturacion_tipo`      ON bodegas_servicios_facturacion_tipo.idTipo    = bodegas_servicios_facturacion.idTipo
LEFT JOIN `core_documentos_mercantiles`             ON core_documentos_mercantiles.idDocumentos     = bodegas_servicios_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = bodegas_servicios_facturacion.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = bodegas_servicios_facturacion.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `proveedor_listado`                       ON proveedor_listado.idProveedor                = bodegas_servicios_facturacion.idProveedor
LEFT JOIN `core_ubicacion_ciudad`    provciudad     ON provciudad.idCiudad                          = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   provcomuna     ON provcomuna.idComuna                          = proveedor_listado.idComuna
LEFT JOIN `core_estado_facturacion`                 ON core_estado_facturacion.idEstado             = bodegas_servicios_facturacion.idEstado
LEFT JOIN `sistema_documentos_pago`                 ON sistema_documentos_pago.idDocPago            = bodegas_servicios_facturacion.idDocPago
LEFT JOIN `clientes_listado`                        ON clientes_listado.idCliente                   = bodegas_servicios_facturacion.idCliente
LEFT JOIN `core_ubicacion_ciudad`    clienciudad    ON clienciudad.idCiudad                         = clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   cliencomuna    ON cliencomuna.idComuna                         = clientes_listado.idComuna
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador            = bodegas_servicios_facturacion.idTrabajador
LEFT JOIN `centrocosto_listado`                     ON centrocosto_listado.idCentroCosto            = bodegas_servicios_facturacion.idCentroCosto
LEFT JOIN `centrocosto_listado_level_1`             ON centrocosto_listado_level_1.idLevel_1        = bodegas_servicios_facturacion.idLevel_1
LEFT JOIN `centrocosto_listado_level_2`             ON centrocosto_listado_level_2.idLevel_2        = bodegas_servicios_facturacion.idLevel_2
LEFT JOIN `centrocosto_listado_level_3`             ON centrocosto_listado_level_3.idLevel_3        = bodegas_servicios_facturacion.idLevel_3
LEFT JOIN `centrocosto_listado_level_4`             ON centrocosto_listado_level_4.idLevel_4        = bodegas_servicios_facturacion.idLevel_4
LEFT JOIN `centrocosto_listado_level_5`             ON centrocosto_listado_level_5.idLevel_5        = bodegas_servicios_facturacion.idLevel_5';
$SIS_where = 'bodegas_servicios_facturacion.idFacturacion ='.$X_Puntero;
$row_data = db_select_data (false, $SIS_query, 'bodegas_servicios_facturacion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'row_data');

/*****************************************/
// Se trae un listado con todos los productos utilizados
$SIS_query = '
servicios_listado.Nombre,
bodegas_servicios_facturacion_existencias.Cantidad_ing,
bodegas_servicios_facturacion_existencias.Cantidad_eg,
bodegas_servicios_facturacion_existencias.Valor,
bodegas_servicios_facturacion_existencias.ValorTotal,
core_tiempo_frecuencia.Nombre AS Frecuencia';
$SIS_join  = '
LEFT JOIN `servicios_listado`        ON servicios_listado.idServicio           = bodegas_servicios_facturacion_existencias.idServicio
LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia    = bodegas_servicios_facturacion_existencias.idFrecuencia';
$SIS_where = 'bodegas_servicios_facturacion_existencias.idFacturacion ='.$X_Puntero;
$SIS_order = 'servicios_listado.Nombre ASC';
$arrServicios = array();
$arrServicios = db_select_array (false, $SIS_query, 'bodegas_servicios_facturacion_existencias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrServicios');

/*****************************************/
// Se trae un listado con todos los otros
$SIS_query = 'Nombre,vTotal';
$SIS_join  = '';
$SIS_where = 'idFacturacion ='.$X_Puntero;
$SIS_order = 'Nombre ASC';
$arrOtros = array();
$arrOtros = db_select_array (false, $SIS_query, 'bodegas_servicios_facturacion_otros', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrOtros');

/*****************************************/
// Se trae un listado con todos los impuestos existentes
$SIS_query = 'Nombre,vTotal';
$SIS_join  = '';
$SIS_where = 'idFacturacion ='.$X_Puntero;
$SIS_order = 'Nombre ASC';
$arrDescuentos = array();
$arrDescuentos = db_select_array (false, $SIS_query, 'bodegas_servicios_facturacion_descuentos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrDescuentos');

/*****************************************/
// Se trae un listado con todos los impuestos existentes
$SIS_query = 'Nombre,Porcentaje';
$SIS_join  = '';
$SIS_where = 'Nombre!=""';
$SIS_order = 'idImpuesto ASC';
$arrImpuestos = array();
$arrImpuestos = db_select_array (false, $SIS_query, 'sistema_impuestos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrImpuestos');

/*****************************************/
// Se trae un listado con todas las guias relacionadas al documento
$SIS_query = 'N_Doc, ValorNeto';
$SIS_join  = '';
$SIS_where = 'idDocumentos = 1 AND DocRel ='.$X_Puntero;
$SIS_order = 'N_Doc ASC';
$arrGuias = array();
$arrGuias = db_select_array (false, $SIS_query, 'bodegas_servicios_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGuias');

/*****************************************/
$nn = 0;
$impuestos = array();
foreach ($arrImpuestos as $impto) {
	$impuestos[$nn]['nimp'] = $impto['Nombre'].' ('.Cantidades_decimales_justos($impto['Porcentaje']).'%)';
	$nn++;
}
					
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Print.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
$html ='<section class="invoice">';
$html .= '
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> '.$row_data['TipoDoc'].'
				<small class="pull-right">Fecha Creacion: '.Fecha_estandar($row_data['Creacion_fecha']).'</small>
			</h2>
		</div>
	</div>

	<div class="row invoice-info">';
		
		//se verifica el tipo de movimiento
		switch ($row_data['idTipo']) {
			//Ingreso de Productos a bodega
			case 1:
			case 10:
			case 11:
				$html .= '
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['NombreProveedor'].'</strong><br/>
						'.$row_data['CiudadProveedor'].', '.$row_data['ComunaProveedor'].'<br/>
						'.$row_data['DireccionProveedor'].'<br/>
						Fono Fijo: '.formatPhone($row_data['Fono1Proveedor']).'<br/>
						Celular: '.formatPhone($row_data['Fono2Proveedor']).'<br/>
						Fax: '.$row_data['FaxProveedor'].'<br/>
						Rut: '.$row_data['RutProveedor'].'<br/>
						Email: '.$row_data['EmailProveedor'].'<br/>
						Contacto: '.$row_data['PersonaContactoProveedor'].'<br/>
						Giro de la Empresa: '.$row_data['GiroProveedor'].'
					</address>
				</div>
				
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						'.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono: '.formatPhone($row_data['SistemaOrigenFono']).'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
			   
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</strong><br/>
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>';

					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){
						$html .= '<strong>Estado: </strong>'.$row_data['Estado'].'<br/>';
					}
					if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){
						$html .= '<strong>Vencimiento : </strong>'.Fecha_estandar($row_data['Pago_fecha']).'<br/>';
					}
					/*if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){
						$html .= '<strong>Dto de Pago : </strong>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br/>';
					}
					if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){
						$html .= '<strong>Fecha Pagado: </strong>'.Fecha_estandar($row_data['F_Pago']).'<br/>';
					}*/
					if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){
						$html .= '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['idOcompra'], 5).'<br/>';
					}
					if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''&&$row_data['OC_Ventas']!=0){
						$html .= '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['OC_Ventas'], 5).'<br/>';
					} 
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					if(isset($row_data['fecha_fact_desde'])&&$row_data['fecha_fact_desde']!=''&&$row_data['fecha_fact_desde']!='0000-00-00'){
						$html .= '<strong>Facturacion Desde : </strong>'.Fecha_estandar($row_data['fecha_fact_desde']).'<br/>';
					}
					if(isset($row_data['fecha_fact_hasta'])&&$row_data['fecha_fact_hasta']!=''&&$row_data['fecha_fact_hasta']!='0000-00-00'){
						$html .= '<strong>Facturacion Hasta : </strong>'.Fecha_estandar($row_data['fecha_fact_hasta']).'<br/>';
					}
					if(isset($row_data['idUsoIVA'])&&$row_data['idUsoIVA']!=''&&$row_data['idUsoIVA']==1){
						$html .= '<strong>Exento de IVA : </strong>Factura exenta de IVA<br/>';
					}
					
				$html .= '</div>';

				break;
			//Egreso de Productos de bodega
			case 2:
			case 12:
			case 13:
				$html .= '
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					Empresa Origen
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						'.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono: '.formatPhone($row_data['SistemaOrigenFono']).'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					Empresa Destino
					<address>
						<strong>'.$row_data['NombreCliente'].'</strong><br/>
						'.$row_data['CiudadCliente'].', '.$row_data['ComunaProveedor'].'<br/>
						'.$row_data['DireccionCliente'].'<br/>
						Fono Fijo: '.formatPhone($row_data['Fono1Cliente']).'<br/>
						Celular: '.formatPhone($row_data['Fono2Cliente']).'<br/>
						Fax: '.$row_data['FaxCliente'].'<br/>
						Rut: '.$row_data['RutCliente'].'<br/>
						Email: '.$row_data['EmailCliente'].'<br/>
						Contacto: '.$row_data['PersonaContactoCliente'].'<br/>
						Giro de la Empresa: '.$row_data['GiroCliente'].'
					</address>
				</div>
				
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>'.$row_data['Documento'].' N°'.$row_data['N_Doc'].'</strong><br/>
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Vendedor: </strong>'.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellido'].'<br/>';

					if(isset($row_data['Estado'])&&$row_data['Estado']!=''){
						$html .= '<strong>Estado: </strong>'.$row_data['Estado'].'<br/>';
					}
					if(isset($row_data['Pago_fecha'])&&$row_data['Pago_fecha']!=''&&$row_data['Pago_fecha']!='0000-00-00'){
						$html .= '<strong>Vencimiento : </strong>'.Fecha_estandar($row_data['Pago_fecha']).'<br/>';
					}
					if(isset($row_data['DocPago'])&&$row_data['DocPago']!=''){
						$html .= '<strong>Dto de Pago : </strong>'.$row_data['DocPago'].' '.$row_data['N_DocPago'].'<br/>';
					}
					if(isset($row_data['F_Pago'])&&$row_data['F_Pago']!=''&&$row_data['F_Pago']!='0000-00-00'){
						$html .= '<strong>Fecha Pagado: </strong>'.Fecha_estandar($row_data['F_Pago']).'<br/>';
					}
					if(isset($row_data['idOcompra'])&&$row_data['idOcompra']!=''&&$row_data['idOcompra']!=0){
						$html .= '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['idOcompra'], 5).'<br/>';
					}
					if(isset($row_data['OC_Ventas'])&&$row_data['OC_Ventas']!=''&&$row_data['OC_Ventas']!=0){
						$html .= '<strong>OC Relacionada N°: </strong>'.N_doc($row_data['OC_Ventas'], 5).'<br/>';
					} 
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					if(isset($row_data['fecha_fact_desde'])&&$row_data['fecha_fact_desde']!=''&&$row_data['fecha_fact_desde']!='0000-00-00'){
						$html .= '<strong>Facturacion Desde : </strong>'.Fecha_estandar($row_data['fecha_fact_desde']).'<br/>';
					}
					if(isset($row_data['fecha_fact_hasta'])&&$row_data['fecha_fact_hasta']!=''&&$row_data['fecha_fact_hasta']!='0000-00-00'){
						$html .= '<strong>Facturacion Hasta : </strong>'.Fecha_estandar($row_data['fecha_fact_hasta']).'<br/>';
					}
					if(isset($row_data['idUsoIVA'])&&$row_data['idUsoIVA']!=''&&$row_data['idUsoIVA']==1){
						$html .= '<strong>Exento de IVA : </strong>Factura exenta de IVA<br/>';
					}
					
				$html .= '
				</div>';
				break;

		}
		
	$html .= '</div>
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th colspan="4">Detalle</th>
						<th width="160" align="right">Valor Total</th>
					</tr>
				</thead>
				<tbody>';
					//si existen productos
					if ($arrServicios!=false && !empty($arrServicios) && $arrServicios!='') {
						$html .= '<tr class="active"><td colspan="5"><strong>Productos</strong></td></tr>';
						foreach ($arrServicios as $prod) {
							$html .= '<tr>
								<td colspan="2">'.$prod['Nombre'].'</td>';
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									$html .= '<td align="right">'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prod['Frecuencia'].'</td>';
								}elseif(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									$html .= '<td align="right">'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prod['Frecuencia'].'</td>';
								}
								$html .= '
								<td align="right">'.Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prod['Frecuencia'].'</td>
								<td align="right">'.Valores(Cantidades_decimales_justos($prod['ValorTotal']), 0).'</td>
							</tr>';
						}
					}
					//si existen guias
					if ($arrGuias!=false && !empty($arrGuias) && $arrGuias!='') {
						$html .= '<tr style="background-color: #f9f9f9;"><td colspan="5"><strong>Guias de Despacho</strong></td></tr>';
						foreach ($arrGuias as $guia) {
							$html .= '<tr>
								<td colspan="4" style="vertical-align: top;">Guia de Despacho N°'.$guia['N_Doc'].'</td>
								<td align="right">'.Valores($guia['ValorNeto'], 0).'</td>
							</tr>';
						} 
					}
					
					//si existen guias
					if ($arrOtros!=false && !empty($arrOtros) && $arrOtros!='') {
						$html .= '<tr style="background-color: #f9f9f9;"><td colspan="5"><strong>Otros</strong></td></tr>';
						foreach ($arrOtros as $otro) {
							$html .= '<tr>
								<td colspan="4" style="vertical-align: top;">'.$otro['Nombre'].'</td>
								<td align="right">'.Valores($otro['vTotal'], 0).'</td>
							</tr>';
						} 
					}
				$html .= '</tbody>
			</table>

			<table class="table">
				<tbody>';	
					
					//Recorro y guard el nombre de los impuestos 
					if(isset($row_data['ValorNeto'])&&$row_data['ValorNeto']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Subtotal</strong></td>
							<td width="160" align="right">'.Valores($row_data['ValorNeto'], 0).'</td>
						</tr>';
					}
					foreach ($arrDescuentos as $descuentos) {
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Descuento: '.$descuentos['Nombre'].'</strong></td> 
							<td align="right">'.Valores($descuentos['vTotal'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['ValorNetoImp'])&&$row_data['ValorNetoImp']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Neto Imponible</strong></td>
							<td align="right">'.Valores($row_data['ValorNetoImp'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_01'])&&$row_data['Impuesto_01']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[0]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_01'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_02'])&&$row_data['Impuesto_02']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[1]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_02'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_03'])&&$row_data['Impuesto_03']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[2]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_03'], 0).'</td>
						</tr>';
					} 
					if(isset($row_data['Impuesto_04'])&&$row_data['Impuesto_04']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[3]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_04'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_05'])&&$row_data['Impuesto_05']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[4]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_05'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_06'])&&$row_data['Impuesto_06']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[5]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_06'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_07'])&&$row_data['Impuesto_07']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[6]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_07'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_08'])&&$row_data['Impuesto_08']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[7]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_08'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_09'])&&$row_data['Impuesto_09']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[8]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_09'], 0).'</td>
						</tr>';
					}
					if(isset($row_data['Impuesto_10'])&&$row_data['Impuesto_10']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>'.$impuestos[9]['nimp'].'</strong></td> 
							<td align="right">'.Valores($row_data['Impuesto_10'], 0).'</td>
						</tr>';
					} 
					if(isset($row_data['ValorTotal'])&&$row_data['ValorTotal']!=0){
						$html .= '<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="4" align="right"><strong>Total</strong></td>
							<td align="right">'.Valores($row_data['ValorTotal'], 0).'</td>
						</tr>';
					}
				
				$html .= '</tbody>
			</table>
			
		</div>
	</div>

	<div class="col-xs-12">
		<div class="row">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" >'.$row_data['Observaciones'].'</p>
		</div>
	</div>';
	
	if($row_data['idTipo']==6){
		$html .= '<div class="row firma">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 fcont"><p>Firma Transportista</p></div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 fcont" style="left:50%;"><p>Firma Receptor</p></div>
		</div>';
	}
    
$html .= '</section>';
echo $html;
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';
?>
