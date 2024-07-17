<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../../../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../../../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../../../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
//variable de ubicacion en el menu
$rowlevel['nombre_categoria'] = '';
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//Se traen todos los datos
$query = "SELECT 
facturacion_listado_detalle.DetConsMesAnteriorFecha,
facturacion_listado_detalle.DetConsMesActualFecha,
facturacion_listado_detalle.ClienteFechaVencimiento,
core_sistemas.Rut AS SistemaRut,
clientes_listado.Rut AS ClienteRut,
facturacion_listado_detalle.ClienteNombre,
clientes_listado.Giro AS ClienteGiro,
clientes_listado.DireccionFact AS ClienteDireccionFact,
mnt_ubicacion_comunas.Nombre AS ClienteComunaFact,
clientes_listado.Fono1 AS ClienteFono1,
clientes_listado.email AS ClienteEmail,
clientes_listado.UnidadHabitacional AS ClienteUH,
facturacion_listado_detalle.AguasInfCargoFijo,
facturacion_listado_detalle.AguasInfMetroAgua,
facturacion_listado_detalle.AguasInfMetroRecolecion,
facturacion_listado_detalle.AguasInfVisitaCorte,
facturacion_listado_detalle.AguasInfCorte1,
facturacion_listado_detalle.AguasInfCorte2,
facturacion_listado_detalle.AguasInfReposicion1,
facturacion_listado_detalle.AguasInfReposicion2,
facturacion_listado_detalle.DetalleConsumoCantidad,
facturacion_listado_detalle.DetalleRecoleccionCantidad,
					
DetalleVisitaCorte,
DetalleCorte1Fecha,DetalleCorte1Valor,
DetalleCorte2Fecha,DetalleCorte2Valor,
DetalleReposicion1Fecha,DetalleReposicion1Valor,
DetalleReposicion2Fecha,DetalleReposicion2Valor,

DetalleInteresDeuda,
DetalleSaldoFavor,

DetalleSaldoAnterior,
							
DetalleOtrosCargos1Texto,
DetalleOtrosCargos2Texto,
DetalleOtrosCargos3Texto,
DetalleOtrosCargos4Texto,
DetalleOtrosCargos5Texto,
DetalleOtrosCargos1Valor,
DetalleOtrosCargos2Valor,
DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,
DetalleOtrosCargos5Valor,
DetalleOtrosCargos1Fecha,
DetalleOtrosCargos2Fecha,
DetalleOtrosCargos3Fecha,
DetalleOtrosCargos4Fecha,
DetalleOtrosCargos5Fecha,
SII_NDoc


FROM `facturacion_listado_detalle`
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema             = facturacion_listado_detalle.idSistema
LEFT JOIN `clientes_listado`          ON clientes_listado.idCliente          = facturacion_listado_detalle.idCliente
LEFT JOIN `mnt_ubicacion_comunas`     ON mnt_ubicacion_comunas.idComuna      = clientes_listado.idComunaFact
WHERE idFacturacionDetalle = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowDatos = mysqli_fetch_assoc ($resultado);



/**********************************************************************************************************************************/
/*                                                     Ejecucion transaccion                                                      */
/**********************************************************************************************************************************/
//Verifico que la factura no este creada
if(isset($rowDatos['SII_NDoc'])&&$rowDatos['SII_NDoc']==0){
	// datos a utilizar
	$url = 'https://libredte.cl';
	$hash = 'J5ewtxvMQHDVjdBTf669SAvJ8fMWZn0q';

	$dte = array();

	//Datos del encabezado
	$dte['Encabezado']['IdDoc']['TipoDTE'] = 33;
	$dte['Encabezado']['IdDoc']['PeriodoDesde'] = $rowDatos['DetConsMesAnteriorFecha'];
	$dte['Encabezado']['IdDoc']['PeriodoHasta'] = $rowDatos['DetConsMesActualFecha'];
	$dte['Encabezado']['IdDoc']['FchVenc'] = $rowDatos['ClienteFechaVencimiento'];

	//Datos del emisor
	$dte['Encabezado']['Emisor']['RUTEmisor'] = $rowDatos['SistemaRut'];

	//Datos del receptor de la factura
	$dte['Encabezado']['Receptor']['RUTRecep'] = $rowDatos['ClienteRut'];
	$dte['Encabezado']['Receptor']['RznSocRecep'] = $rowDatos['ClienteNombre'];
	$dte['Encabezado']['Receptor']['GiroRecep'] = $rowDatos['ClienteGiro'];
	$dte['Encabezado']['Receptor']['DirRecep'] = $rowDatos['ClienteDireccionFact'];
	$dte['Encabezado']['Receptor']['CmnaRecep'] = $rowDatos['ClienteComunaFact'];
	$dte['Encabezado']['Receptor']['Contacto'] = $rowDatos['ClienteFono1'];
	$dte['Encabezado']['Receptor']['CorreoRecep'] = $rowDatos['ClienteEmail'];

	//Variable de avance en el arreglo
	$nn = 0;

	//Cargo Fijo Cliente
	$dte['Detalle'][$nn]['NmbItem'] = 'Cargo Fijo Cliente';
	$dte['Detalle'][$nn]['QtyItem'] = $rowDatos['ClienteUH'];
	$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['AguasInfCargoFijo']/1.19), 2);

	//Consumo Agua Potable
	
	//Si la cantidad es 0 envio todo en 0 para evitar problemas
	if(isset($rowDatos['DetalleConsumoCantidad'])&&$rowDatos['DetalleConsumoCantidad']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Consumo Agua Potable';
		$dte['Detalle'][$nn]['QtyItem'] = Cantidades3($rowDatos['DetalleConsumoCantidad'], 2);
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['AguasInfMetroAgua']/1.19), 2);
	}

	//Recoleccion de Aguas Servidas
	//Si la cantidad es 0 envio todo en 0 para evitar problemas
	if(isset($rowDatos['DetalleRecoleccionCantidad'])&&$rowDatos['DetalleRecoleccionCantidad']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Recoleccion de Aguas Servidas';
		$dte['Detalle'][$nn]['QtyItem'] = Cantidades3($rowDatos['DetalleRecoleccionCantidad'], 2);
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['AguasInfMetroRecolecion']/1.19), 2);
	}

	//Visita Corte
	if(isset($rowDatos['DetalleVisitaCorte'])&&$rowDatos['DetalleVisitaCorte']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Visita Corte';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleVisitaCorte']/1.19), 2);
	}

	//Corte 1° instancia
	if(isset($rowDatos['DetalleCorte1Valor'])&&$rowDatos['DetalleCorte1Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Corte 1° instancia ('.Fecha_estandar($rowDatos['DetalleCorte1Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleCorte1Valor']/1.19), 2);
	}

	//Corte 2° instancia
	if(isset($rowDatos['DetalleCorte2Valor'])&&$rowDatos['DetalleCorte2Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Corte 2° instancia ('.Fecha_estandar($rowDatos['DetalleCorte2Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleCorte2Valor']/1.19), 2);
	}

	//Reposicion 1° instancia
	if(isset($rowDatos['DetalleReposicion1Valor'])&&$rowDatos['DetalleReposicion1Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Reposicion 1° instancia ('.Fecha_estandar($rowDatos['DetalleReposicion1Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleReposicion1Valor']/1.19), 2);
	}
	//Reposicion 2° instancia
	if(isset($rowDatos['DetalleReposicion2Valor'])&&$rowDatos['DetalleReposicion2Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Reposicion 2° instancia ('.Fecha_estandar($rowDatos['DetalleReposicion2Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleReposicion2Valor']/1.19), 2);
	}

	//Interes Deuda
	if(isset($rowDatos['DetalleInteresDeuda'])&&$rowDatos['DetalleInteresDeuda']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Interes Deuda';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleInteresDeuda']/1.19), 2);
	}

	//Otros Cargos 1
	if(isset($rowDatos['DetalleOtrosCargos1Valor'])&&$rowDatos['DetalleOtrosCargos1Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = $rowDatos['DetalleOtrosCargos1Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos1Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleOtrosCargos1Valor']/1.19), 2);
	}

	//Otros Cargos 2
	if(isset($rowDatos['DetalleOtrosCargos2Valor'])&&$rowDatos['DetalleOtrosCargos2Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = $rowDatos['DetalleOtrosCargos2Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos2Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleOtrosCargos2Valor']/1.19), 2);
	}

	//Otros Cargos 3
	if(isset($rowDatos['DetalleOtrosCargos3Valor'])&&$rowDatos['DetalleOtrosCargos3Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = $rowDatos['DetalleOtrosCargos3Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos3Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleOtrosCargos3Valor']/1.19), 2);
	}

	//Otros Cargos 4
	if(isset($rowDatos['DetalleOtrosCargos4Valor'])&&$rowDatos['DetalleOtrosCargos4Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = $rowDatos['DetalleOtrosCargos4Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos4Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleOtrosCargos4Valor']/1.19), 2);
	}

	//Otros Cargos 5
	if(isset($rowDatos['DetalleOtrosCargos5Valor'])&&$rowDatos['DetalleOtrosCargos5Valor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = $rowDatos['DetalleOtrosCargos5Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos5Fecha']).')';
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3(($rowDatos['DetalleOtrosCargos5Valor']/1.19), 2);
	}

	//Saldo a favor
	if(isset($rowDatos['DetalleSaldoFavor'])&&$rowDatos['DetalleSaldoFavor']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Saldo a Favor';
		$dte['Detalle'][$nn]['IndExe']  = 1;
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['DescuentoMonto'] = Cantidades3($rowDatos['DetalleSaldoFavor'], 0);
		$dte['Detalle'][$nn]['MontoItem'] = Cantidades3($rowDatos['DetalleSaldoFavor'], 0)*-1;
	}

	//Saldo Anterior
	if(isset($rowDatos['DetalleSaldoAnterior'])&&$rowDatos['DetalleSaldoAnterior']!=0){
		$nn++;
		$dte['Detalle'][$nn]['NmbItem'] = 'Saldo Anterior';
		$dte['Detalle'][$nn]['IndExe']  = 1;
		$dte['Detalle'][$nn]['QtyItem'] = 1;
		$dte['Detalle'][$nn]['PrcItem'] = Cantidades3($rowDatos['DetalleSaldoAnterior'], 0);
	}



	echo '<pre>';
		var_dump($dte);
	echo '</pre>';


	// incluir autocarga de composer
	require('../vendor/autoload.php');

	// crear cliente
	$LibreDTE = new \sasco\LibreDTE\SDK\LibreDTE($hash, $url);
	$LibreDTE->setSSL(false, false); ///< segundo parámetro =false desactiva verificación de SSL

	   
	// crear DTE temporal
	$emitir = $LibreDTE->post('/dte/documentos/emitir', $dte);
	if ($emitir['status']['code']!=200) {
		die('Error al emitir DTE temporal: '.$emitir['body']."\n");
	   
	}

	/*

	// crear DTE real

	$generar = $LibreDTE->post('/dte/documentos/generar', $emitir['body']);
	if ($generar['status']['code']!=200) {
		die('Error al generar DTE real: '.$generar['body']."\n");
	}

	echo '<pre>';
		var_dump($emitir);
	echo '</pre>';

	// obtener el PDF del DTE
	$generar_pdf = $LibreDTE->post('/dte/documentos/generar_pdf', ['xml'=>$generar['body']['xml']]);
	if ($generar_pdf['status']['code']!=200) {
		die('Error al generar PDF del DTE: '.$generar_pdf['body']."\n");
	}

	// guardar PDF en el disco
	file_put_contents(str_replace('.php', '.pdf', basename(__FILE__)), $generar_pdf['body']);


	*/
	
	//Un update de estado despues de enviar al SII
	
	
	
}else{
	echo 'El documento ya fue enviado al SII';
}

?>
