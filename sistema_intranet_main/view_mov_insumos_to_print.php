<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
bodegas_insumos_facturacion.idTipo,
bodegas_insumos_facturacion.idFacturacion,
bodegas_insumos_facturacion.Creacion_fecha,
bodegas_insumos_facturacion.N_Doc,
bodegas_insumos_facturacion.Observaciones,
bodegas_insumos_facturacion.idOcompra,
bodegas_insumos_facturacion.OC_Ventas,
bodegas_insumos_facturacion.idOT,
bodega1.Nombre AS BodegaDesde,
bodega2.Nombre AS BodegaHacia,
bodegas_insumos_facturacion_tipo.Nombre AS TipoDoc,
core_documentos_mercantiles.Nombre AS Documento,
usuarios_listado.Nombre AS NombreUsuario,
bodegas_insumos_facturacion.ValorNeto,
bodegas_insumos_facturacion.ValorNetoImp,
bodegas_insumos_facturacion.Impuesto_01,
bodegas_insumos_facturacion.Impuesto_02,
bodegas_insumos_facturacion.Impuesto_03,
bodegas_insumos_facturacion.Impuesto_04,
bodegas_insumos_facturacion.Impuesto_05,
bodegas_insumos_facturacion.Impuesto_06,
bodegas_insumos_facturacion.Impuesto_07,
bodegas_insumos_facturacion.Impuesto_08,
bodegas_insumos_facturacion.Impuesto_09,
bodegas_insumos_facturacion.Impuesto_10,
bodegas_insumos_facturacion.ValorTotal,
bodegas_insumos_facturacion.fecha_fact_desde,
bodegas_insumos_facturacion.fecha_fact_hasta,
bodegas_insumos_facturacion.idUsoIVA,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

sistema_destino.Nombre AS SistemaDestino,
sistema_destino.Rut AS SistemaDestinoRut,
sis_des_ciudad.Nombre AS SistemaDestinoCiudad,
sis_des_comuna.Nombre AS SistemaDestinoComuna,
sistema_destino.Direccion AS SistemaDestinoDireccion,
sistema_destino.Contacto_Fono1 AS SistemaDestinoFono,
sistema_destino.Contacto_Fax AS SistemaDestinoFax,
sistema_destino.email_principal AS SistemaDestinoEmail,

trabajadores_listado.Nombre AS Nombre_trab,
trabajadores_listado.ApellidoPat AS ApellidoPat_trab,
trabajadores_listado.ApellidoMat AS ApellidoMat_trab,
trabajadores_listado.Cargo AS Cargo_trab,
trabajadores_listado.Fono AS Fono_trab,
trabajadores_listado.Rut AS Rut_trab,
trabajadores_listado_tipos.Nombre AS Tipo_trab,

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

core_estado_facturacion.Nombre AS Estado,
bodegas_insumos_facturacion.Pago_fecha,
sistema_documentos_pago.Nombre AS DocPago,
bodegas_insumos_facturacion.N_DocPago,
bodegas_insumos_facturacion.F_Pago,

centrocosto_listado.Nombre AS CentroCosto_Nombre,
centrocosto_listado_level_1.Nombre AS CentroCosto_Level_1,
centrocosto_listado_level_2.Nombre AS CentroCosto_Level_2,
centrocosto_listado_level_3.Nombre AS CentroCosto_Level_3,
centrocosto_listado_level_4.Nombre AS CentroCosto_Level_4,
centrocosto_listado_level_5.Nombre AS CentroCosto_Level_5';
$SIS_join  = '
LEFT JOIN `bodegas_insumos_listado`       bodega1   ON bodega1.idBodega                             = bodegas_insumos_facturacion.idBodegaOrigen
LEFT JOIN `bodegas_insumos_listado`       bodega2   ON bodega2.idBodega                             = bodegas_insumos_facturacion.idBodegaDestino
LEFT JOIN `bodegas_insumos_facturacion_tipo`        ON bodegas_insumos_facturacion_tipo.idTipo      = bodegas_insumos_facturacion.idTipo
LEFT JOIN `core_documentos_mercantiles`             ON core_documentos_mercantiles.idDocumentos     = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = bodegas_insumos_facturacion.idUsuario
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = bodegas_insumos_facturacion.idSistema
LEFT JOIN `core_sistemas`   sistema_destino         ON sistema_destino.idSistema                    = bodegas_insumos_facturacion.idSistemaDestino
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `core_ubicacion_ciudad`   sis_des_ciudad  ON sis_des_ciudad.idCiudad                      = sistema_destino.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_des_comuna  ON sis_des_comuna.idComuna                      = sistema_destino.idComuna
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador            = bodegas_insumos_facturacion.idTrabajador
LEFT JOIN `trabajadores_listado_tipos`              ON trabajadores_listado_tipos.idTipo            = trabajadores_listado.idTipo
LEFT JOIN `proveedor_listado`                       ON proveedor_listado.idProveedor                = bodegas_insumos_facturacion.idProveedor
LEFT JOIN `clientes_listado`                        ON clientes_listado.idCliente                   = bodegas_insumos_facturacion.idCliente
LEFT JOIN `core_ubicacion_ciudad`    provciudad     ON provciudad.idCiudad                          = proveedor_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   provcomuna     ON provcomuna.idComuna                          = proveedor_listado.idComuna
LEFT JOIN `core_ubicacion_ciudad`    clienciudad    ON clienciudad.idCiudad                         = clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   cliencomuna    ON cliencomuna.idComuna                         = clientes_listado.idComuna
LEFT JOIN `core_estado_facturacion`                 ON core_estado_facturacion.idEstado             = bodegas_insumos_facturacion.idEstado
LEFT JOIN `sistema_documentos_pago`                 ON sistema_documentos_pago.idDocPago            = bodegas_insumos_facturacion.idDocPago
LEFT JOIN `centrocosto_listado`                     ON centrocosto_listado.idCentroCosto            = bodegas_insumos_facturacion.idCentroCosto
LEFT JOIN `centrocosto_listado_level_1`             ON centrocosto_listado_level_1.idLevel_1        = bodegas_insumos_facturacion.idLevel_1
LEFT JOIN `centrocosto_listado_level_2`             ON centrocosto_listado_level_2.idLevel_2        = bodegas_insumos_facturacion.idLevel_2
LEFT JOIN `centrocosto_listado_level_3`             ON centrocosto_listado_level_3.idLevel_3        = bodegas_insumos_facturacion.idLevel_3
LEFT JOIN `centrocosto_listado_level_4`             ON centrocosto_listado_level_4.idLevel_4        = bodegas_insumos_facturacion.idLevel_4
LEFT JOIN `centrocosto_listado_level_5`             ON centrocosto_listado_level_5.idLevel_5        = bodegas_insumos_facturacion.idLevel_5';
$SIS_where = 'bodegas_insumos_facturacion.idFacturacion ='.$X_Puntero;
$row_data = db_select_data (false, $SIS_query, 'bodegas_insumos_facturacion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'row_data');

/*****************************************/
// Se trae un listado con todos los productos utilizados
$SIS_query = '
insumos_listado.Nombre,
sistema_productos_uml.Nombre AS Unimed,
sistema_productos_uml.Abreviatura AS UnimedAbrev,
bodegas_insumos_facturacion_existencias.Cantidad_ing,
bodegas_insumos_facturacion_existencias.Cantidad_eg,
bodegas_insumos_facturacion_existencias.Valor,
bodegas_insumos_facturacion_existencias.ValorTotal,
insumos_listado.ValorIngreso AS  ValorTraspaso,
bodegas_insumos_listado.Nombre AS NombreBodega';
$SIS_join  = '
LEFT JOIN `insumos_listado`            ON insumos_listado.idProducto             = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`      ON sistema_productos_uml.idUml            = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_listado`    ON bodegas_insumos_listado.idBodega       = bodegas_insumos_facturacion_existencias.idBodega';
$SIS_where = 'bodegas_insumos_facturacion_existencias.idFacturacion ='.$X_Puntero;
$SIS_order = 'insumos_listado.Nombre ASC';
$arrProductos = array();
$arrProductos = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion_existencias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

/*****************************************/
// Se trae un listado con todos los otros
$SIS_query = 'Nombre,vTotal';
$SIS_join  = '';
$SIS_where = 'idFacturacion ='.$X_Puntero;
$SIS_order = 'Nombre ASC';
$arrOtros = array();
$arrOtros = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion_otros', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrOtros');

/*****************************************/
// Se trae un listado con todos los impuestos existentes
$SIS_query = 'Nombre,vTotal';
$SIS_join  = '';
$SIS_where = 'idFacturacion ='.$X_Puntero;
$SIS_order = 'Nombre ASC';
$arrDescuentos = array();
$arrDescuentos = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion_descuentos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrDescuentos');

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
$arrGuias = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGuias');

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
$html .= '<div class="row">
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
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Bodega Destino: </strong>'.$row_data['BodegaHacia'].'<br/>';

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
					<strong>Vendedor: </strong>'.$row_data['Nombre_trab'].' '.$row_data['ApellidoPat_trab'].'<br/>';

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
			//Gasto de Productos
			case 3:
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
					Datos del Trabajador
					<address>
						<strong>'.$row_data['Nombre_trab'].' '.$row_data['ApellidoPat_trab'].' '.$row_data['ApellidoMat_trab'].'</strong><br/>
						Rut: '.$row_data['Rut_trab'].'<br/>
						Fono: '.formatPhone($row_data['Fono_trab']).'<br/>
						Cargo: '.$row_data['Cargo_trab'].'<br/>
						Tipo Cargo: '.$row_data['Tipo_trab'].'
					</address>
				</div>
			 
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>Entrega de insumos a Personal</strong><br/>
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				break;
			//Traspaso de Productos entre bodegas
			case 4:
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

				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Bodega Origen: </strong>'.$row_data['BodegaDesde'].'<br/>
					<strong>Bodega Destino: </strong>'.$row_data['BodegaHacia'].'<br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				break;
			//Transformacion de Productos
			case 5:
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

				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Bodega Origen: </strong>'.$row_data['BodegaDesde'].'<br/>
					<strong>Bodega Destino: </strong>'.$row_data['BodegaHacia'].'<br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				break;
			//Transpaso de insumos otras empresas
			case 6:
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
						<strong>'.$row_data['SistemaDestino'].'</strong><br/>
						'.$row_data['SistemaDestinoCiudad'].' '.$row_data['SistemaDestinoComuna'].'<br/>
						'.$row_data['SistemaDestinoDireccion'].'<br/>
						Fono: '.formatPhone($row_data['SistemaDestinoFono']).'<br/>
						Fax: '.$row_data['SistemaDestinoFax'].'<br/>
						Rut: '.$row_data['SistemaDestinoRut'].'<br/>
						Email: '.$row_data['SistemaDestinoEmail'].'
					</address>
				</div>
			 
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Bodega de destino:</strong> '.$row_data['BodegaHacia'].'<br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				break;
			//Gasto de Productos en una Orden de Trabajo
			case 7:
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

				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Bodega utilizada:</strong> '.$row_data['BodegaDesde'].'<br/>
					<strong>Orden de Trabajo N°:</strong> '.N_doc($row_data['idOT'], 5).'<br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				break;
			//Traspaso Manual de Insumos a otra Empresa
			case 8:
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
						<strong>'.$row_data['SistemaDestino'].'</strong><br/>
						'.$row_data['SistemaDestinoCiudad'].' '.$row_data['SistemaDestinoComuna'].'<br/>
						'.$row_data['SistemaDestinoDireccion'].'<br/>
						Fono: '.formatPhone($row_data['SistemaDestinoFono']).'<br/>
						Fax: '.$row_data['SistemaDestinoFax'].'<br/>
						Rut: '.$row_data['SistemaDestinoRut'].'<br/>
						Email: '.$row_data['SistemaDestinoEmail'].'
					</address>
				</div>
			 
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 invoice-col">
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				break;
			//Ingreso manual de insumos
			case 9:
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
					<strong>Doc N°'.N_doc($row_data['idFacturacion'], 5).'</strong><br/>
					<strong>Bodega Destino: </strong>'.$row_data['BodegaHacia'].'<br/>';
					if(isset($row_data['CentroCosto_Nombre'])&&$row_data['CentroCosto_Nombre']!=''){
						$html .= '<strong>Centro de Costo : </strong>'.$row_data['CentroCosto_Nombre'];
						if(isset($row_data['CentroCosto_Level_1'])&&$row_data['CentroCosto_Level_1']!=''){$html .= ' - '.$row_data['CentroCosto_Level_1'];}
						if(isset($row_data['CentroCosto_Level_2'])&&$row_data['CentroCosto_Level_2']!=''){$html .= ' - '.$row_data['CentroCosto_Level_2'];}
						if(isset($row_data['CentroCosto_Level_3'])&&$row_data['CentroCosto_Level_3']!=''){$html .= ' - '.$row_data['CentroCosto_Level_3'];}
						if(isset($row_data['CentroCosto_Level_4'])&&$row_data['CentroCosto_Level_4']!=''){$html .= ' - '.$row_data['CentroCosto_Level_4'];}
						if(isset($row_data['CentroCosto_Level_5'])&&$row_data['CentroCosto_Level_5']!=''){$html .= ' - '.$row_data['CentroCosto_Level_5'];}
						$html .= '<br/>';
					}
					$html .= '
				</div>';
				
				break;
		}
		
	$html .= '</div>

	<div class="">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Detalle</th>
						<th>Ingreso</th>
						<th>Egreso</th>
						<th>Valor</th>
						<th align="right">Valor Total</th>
					</tr>
				</thead>
				<tbody>';
					//si existen productos
					if ($arrProductos!=false && !empty($arrProductos) && $arrProductos!='') {
						$html .= '<tr class="active"><td colspan="5"><strong>Productos</strong></td></tr>';
						foreach ($arrProductos as $prod) {
							$html .= '<tr>
								<td><strong>'.$prod['NombreBodega'].'</strong> - '.$prod['Nombre'].'</td>';
								//Verifico la existencia de la abreviatura de la unidad de medida
								if(isset($prod['UnimedAbrev'])&&$prod['UnimedAbrev']!=''){
									$prodUnimed = $prod['UnimedAbrev'];
								}else{
									$prodUnimed = $prod['Unimed'];
								}
								if(isset($prod['Cantidad_ing'])&&$prod['Cantidad_ing']!=0){
									$html .= '<td>'.Cantidades_decimales_justos($prod['Cantidad_ing']).' '.$prodUnimed.'</td>';
									$html .= '<td></td>';
								}
								if(isset($prod['Cantidad_eg'])&&$prod['Cantidad_eg']!=0){
									$html .= '<td></td>';
									$html .= '<td>'.Cantidades_decimales_justos($prod['Cantidad_eg']).' '.$prodUnimed.'</td>';
								}
								$html .= '<td>'.Valores(Cantidades_decimales_justos($prod['Valor']), 0).' x '.$prodUnimed.'</td>';
								$html .= '<td align="right">'.Valores(Cantidades_decimales_justos($prod['ValorTotal']), 0).'</td>

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
	
	if($row_data['idTipo']==3){
		$html .= '<div class="row firma">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 fcont"><p>Firma Emisor</p></div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 fcont" style="left:50%;"><p>Firma Trabajador</p></div>
		</div>';
	} 
	
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
