<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/
	//Traspaso de valores input a variables
	if ( !empty($_POST['idFacturacion']) )         $idFacturacion          = $_POST['idFacturacion'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )                 $Fecha                  = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )                   $Dia                    = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )                 $idMes                  = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )                   $Ano                    = $_POST['Ano'];
	if ( !empty($_POST['Observaciones']) )         $Observaciones          = $_POST['Observaciones'];
	if ( !empty($_POST['fCreacion']) )             $fCreacion              = $_POST['fCreacion'];
	if ( !empty($_POST['idFacturacionDetalle']) )  $idFacturacionDetalle   = $_POST['idFacturacionDetalle'];
	if ( !empty($_POST['idCliente']) )             $idCliente              = $_POST['idCliente'];
	if ( !empty($_POST['intAnual']) )              $intAnual               = $_POST['intAnual'];
	if ( !empty($_POST['SII_NDoc']) )              $SII_NDoc               = $_POST['SII_NDoc'];
	if ( !empty($_POST['idOpcionesInteres']) )     $idOpcionesInteres      = $_POST['idOpcionesInteres'];
	
	if ( !empty($_POST['idFacturacionDetalle']) )         $idFacturacionDetalle          = $_POST['idFacturacionDetalle'];
	if ( !empty($_POST['ClienteNombre']) )                $ClienteNombre                 = $_POST['ClienteNombre'];
	if ( !empty($_POST['ClienteDireccion']) )             $ClienteDireccion              = $_POST['ClienteDireccion'];
	if ( !empty($_POST['ClienteIdentificador']) )         $ClienteIdentificador          = $_POST['ClienteIdentificador'];
	if ( !empty($_POST['ClienteNombreComuna']) )          $ClienteNombreComuna           = $_POST['ClienteNombreComuna'];
	if ( !empty($_POST['ClienteFechaVencimiento']) )      $ClienteFechaVencimiento       = $_POST['ClienteFechaVencimiento'];
	if ( !empty($_POST['ClienteEstado']) )                $ClienteEstado                 = $_POST['ClienteEstado'];
	if ( !empty($_POST['DetalleCargoFijoValor']) )        $DetalleCargoFijoValor         = $_POST['DetalleCargoFijoValor'];
	if ( !empty($_POST['DetalleConsumoCantidad']) )       $DetalleConsumoCantidad        = $_POST['DetalleConsumoCantidad'];
	if ( !empty($_POST['DetalleConsumoValor']) )          $DetalleConsumoValor           = $_POST['DetalleConsumoValor'];
	if ( !empty($_POST['DetalleRecoleccionCantidad']) )   $DetalleRecoleccionCantidad    = $_POST['DetalleRecoleccionCantidad'];
	if ( !empty($_POST['DetalleRecoleccionValor']) )      $DetalleRecoleccionValor       = $_POST['DetalleRecoleccionValor'];
	if ( !empty($_POST['DetalleVisitaCorte']) )           $DetalleVisitaCorte            = $_POST['DetalleVisitaCorte'];
	if ( !empty($_POST['DetalleCorte1Valor']) )           $DetalleCorte1Valor            = $_POST['DetalleCorte1Valor'];
	if ( !empty($_POST['DetalleCorte1Fecha']) )           $DetalleCorte1Fecha            = $_POST['DetalleCorte1Fecha'];
	if ( !empty($_POST['DetalleCorte2Valor']) )           $DetalleCorte2Valor            = $_POST['DetalleCorte2Valor'];
	if ( !empty($_POST['DetalleCorte2Fecha']) )           $DetalleCorte2Fecha            = $_POST['DetalleCorte2Fecha'];
	if ( !empty($_POST['DetalleReposicion1Valor']) )      $DetalleReposicion1Valor       = $_POST['DetalleReposicion1Valor'];
	if ( !empty($_POST['DetalleReposicion1Fecha']) )      $DetalleReposicion1Fecha       = $_POST['DetalleReposicion1Fecha'];
	if ( !empty($_POST['DetalleReposicion2Valor']) )      $DetalleReposicion2Valor       = $_POST['DetalleReposicion2Valor'];
	if ( !empty($_POST['DetalleReposicion2Fecha']) )      $DetalleReposicion2Fecha       = $_POST['DetalleReposicion2Fecha'];
	if ( !empty($_POST['DetalleSubtotalServicio']) )      $DetalleSubtotalServicio       = $_POST['DetalleSubtotalServicio'];
	if ( !empty($_POST['DetalleInteresDeuda']) )          $DetalleInteresDeuda           = $_POST['DetalleInteresDeuda'];
	if ( !empty($_POST['DetalleOtrosCargos1Texto']) )     $DetalleOtrosCargos1Texto      = $_POST['DetalleOtrosCargos1Texto'];
	if ( !empty($_POST['DetalleOtrosCargos2Texto']) )     $DetalleOtrosCargos2Texto      = $_POST['DetalleOtrosCargos2Texto'];
	if ( !empty($_POST['DetalleOtrosCargos3Texto']) )     $DetalleOtrosCargos3Texto      = $_POST['DetalleOtrosCargos3Texto'];
	if ( !empty($_POST['DetalleOtrosCargos4Texto']) )     $DetalleOtrosCargos4Texto      = $_POST['DetalleOtrosCargos4Texto'];
	if ( !empty($_POST['DetalleOtrosCargos5Texto']) )     $DetalleOtrosCargos5Texto      = $_POST['DetalleOtrosCargos5Texto'];
	if ( !empty($_POST['DetalleOtrosCargos1Valor']) )     $DetalleOtrosCargos1Valor      = $_POST['DetalleOtrosCargos1Valor'];
	if ( !empty($_POST['DetalleOtrosCargos2Valor']) )     $DetalleOtrosCargos2Valor      = $_POST['DetalleOtrosCargos2Valor'];
	if ( !empty($_POST['DetalleOtrosCargos3Valor']) )     $DetalleOtrosCargos3Valor      = $_POST['DetalleOtrosCargos3Valor'];
	if ( !empty($_POST['DetalleOtrosCargos4Valor']) )     $DetalleOtrosCargos4Valor      = $_POST['DetalleOtrosCargos4Valor'];
	if ( !empty($_POST['DetalleOtrosCargos5Valor']) )     $DetalleOtrosCargos5Valor      = $_POST['DetalleOtrosCargos5Valor'];
	if ( !empty($_POST['DetalleOtrosCargos1Fecha']) )     $DetalleOtrosCargos1Fecha      = $_POST['DetalleOtrosCargos1Fecha'];
	if ( !empty($_POST['DetalleOtrosCargos2Fecha']) )     $DetalleOtrosCargos2Fecha      = $_POST['DetalleOtrosCargos2Fecha'];
	if ( !empty($_POST['DetalleOtrosCargos3Fecha']) )     $DetalleOtrosCargos3Fecha      = $_POST['DetalleOtrosCargos3Fecha'];
	if ( !empty($_POST['DetalleOtrosCargos4Fecha']) )     $DetalleOtrosCargos4Fecha      = $_POST['DetalleOtrosCargos4Fecha'];
	if ( !empty($_POST['DetalleOtrosCargos5Fecha']) )     $DetalleOtrosCargos5Fecha      = $_POST['DetalleOtrosCargos5Fecha'];
	if ( !empty($_POST['DetalleTotalVenta']) )            $DetalleTotalVenta             = $_POST['DetalleTotalVenta'];
	if ( !empty($_POST['DetalleSaldoFavor']) )            $DetalleSaldoFavor             = $_POST['DetalleSaldoFavor'];
	if ( !empty($_POST['DetalleSaldoAnterior']) )         $DetalleSaldoAnterior          = $_POST['DetalleSaldoAnterior'];
	if ( !empty($_POST['DetalleTotalAPagar']) )           $DetalleTotalAPagar            = $_POST['DetalleTotalAPagar'];
	if ( !empty($_POST['GraficoMes1Valor']) )             $GraficoMes1Valor              = $_POST['GraficoMes1Valor'];
	if ( !empty($_POST['GraficoMes2Valor']) )             $GraficoMes2Valor              = $_POST['GraficoMes2Valor'];
	if ( !empty($_POST['GraficoMes3Valor']) )             $GraficoMes3Valor              = $_POST['GraficoMes3Valor'];
	if ( !empty($_POST['GraficoMes4Valor']) )             $GraficoMes4Valor              = $_POST['GraficoMes4Valor'];
	if ( !empty($_POST['GraficoMes5Valor']) )             $GraficoMes5Valor              = $_POST['GraficoMes5Valor'];
	if ( !empty($_POST['GraficoMes6Valor']) )             $GraficoMes6Valor              = $_POST['GraficoMes6Valor'];
	if ( !empty($_POST['GraficoMes7Valor']) )             $GraficoMes7Valor              = $_POST['GraficoMes7Valor'];
	if ( !empty($_POST['GraficoMes8Valor']) )             $GraficoMes8Valor              = $_POST['GraficoMes8Valor'];
	if ( !empty($_POST['GraficoMes9Valor']) )             $GraficoMes9Valor              = $_POST['GraficoMes9Valor'];
	if ( !empty($_POST['GraficoMes10Valor']) )            $GraficoMes10Valor             = $_POST['GraficoMes10Valor'];
	if ( !empty($_POST['GraficoMes11Valor']) )            $GraficoMes11Valor             = $_POST['GraficoMes11Valor'];
	if ( !empty($_POST['GraficoMes12Valor']) )            $GraficoMes12Valor             = $_POST['GraficoMes12Valor'];
	if ( !empty($_POST['GraficoMes1Fecha']) )             $GraficoMes1Fecha              = $_POST['GraficoMes1Fecha'];
	if ( !empty($_POST['GraficoMes2Fecha']) )             $GraficoMes2Fecha              = $_POST['GraficoMes2Fecha'];
	if ( !empty($_POST['GraficoMes3Fecha']) )             $GraficoMes3Fecha              = $_POST['GraficoMes3Fecha'];
	if ( !empty($_POST['GraficoMes4Fecha']) )             $GraficoMes4Fecha              = $_POST['GraficoMes4Fecha'];
	if ( !empty($_POST['GraficoMes5Fecha']) )             $GraficoMes5Fecha              = $_POST['GraficoMes5Fecha'];
	if ( !empty($_POST['GraficoMes6Fecha']) )             $GraficoMes6Fecha              = $_POST['GraficoMes6Fecha'];
	if ( !empty($_POST['GraficoMes7Fecha']) )             $GraficoMes7Fecha              = $_POST['GraficoMes7Fecha'];
	if ( !empty($_POST['GraficoMes8Fecha']) )             $GraficoMes8Fecha              = $_POST['GraficoMes8Fecha'];
	if ( !empty($_POST['GraficoMes9Fecha']) )             $GraficoMes9Fecha              = $_POST['GraficoMes9Fecha'];
	if ( !empty($_POST['GraficoMes10Fecha']) )            $GraficoMes10Fecha             = $_POST['GraficoMes10Fecha'];
	if ( !empty($_POST['GraficoMes11Fecha']) )            $GraficoMes11Fecha             = $_POST['GraficoMes11Fecha'];
	if ( !empty($_POST['GraficoMes12Fecha']) )            $GraficoMes12Fecha             = $_POST['GraficoMes12Fecha'];
	if ( !empty($_POST['DetConsMesAnteriorCantidad']) )   $DetConsMesAnteriorCantidad    = $_POST['DetConsMesAnteriorCantidad'];
	if ( !empty($_POST['DetConsMesAnteriorFecha']) )      $DetConsMesAnteriorFecha       = $_POST['DetConsMesAnteriorFecha'];
	if ( !empty($_POST['DetConsMesActualCantidad']) )     $DetConsMesActualCantidad      = $_POST['DetConsMesActualCantidad'];
	if ( !empty($_POST['DetConsMesActualFecha']) )        $DetConsMesActualFecha         = $_POST['DetConsMesActualFecha'];
	if ( !empty($_POST['DetConsMesDiferencia']) )         $DetConsMesDiferencia          = $_POST['DetConsMesDiferencia'];
	if ( !empty($_POST['DetConsProrateo']) )              $DetConsProrateo               = $_POST['DetConsProrateo'];
	if ( !empty($_POST['DetConsProrateoSigno']) )         $DetConsProrateoSigno          = $_POST['DetConsProrateoSigno'];
	if ( !empty($_POST['DetConsMesTotalCantidad']) )      $DetConsMesTotalCantidad       = $_POST['DetConsMesTotalCantidad'];
	if ( !empty($_POST['DetConsFechaProxLectura']) )      $DetConsFechaProxLectura       = $_POST['DetConsFechaProxLectura'];
	if ( !empty($_POST['DetConsModalidad']) )             $DetConsModalidad              = $_POST['DetConsModalidad'];
	if ( !empty($_POST['DetConsFonoEmergencias']) )       $DetConsFonoEmergencias        = $_POST['DetConsFonoEmergencias'];
	if ( !empty($_POST['DetConsFonoConsultas']) )         $DetConsFonoConsultas          = $_POST['DetConsFonoConsultas'];
	if ( !empty($_POST['AguasInfCargoFijo']) )            $AguasInfCargoFijo             = $_POST['AguasInfCargoFijo'];
	if ( !empty($_POST['AguasInfMetroAgua']) )            $AguasInfMetroAgua             = $_POST['AguasInfMetroAgua'];
	if ( !empty($_POST['AguasInfMetroRecolecion']) )      $AguasInfMetroRecolecion       = $_POST['AguasInfMetroRecolecion'];
	if ( !empty($_POST['AguasInfVisitaCorte']) )          $AguasInfVisitaCorte           = $_POST['AguasInfVisitaCorte'];
	if ( !empty($_POST['AguasInfCorte1']) )               $AguasInfCorte1                = $_POST['AguasInfCorte1'];
	if ( !empty($_POST['AguasInfCorte2']) )               $AguasInfCorte2                = $_POST['AguasInfCorte2'];
	if ( !empty($_POST['AguasInfReposicion1']) )          $AguasInfReposicion1           = $_POST['AguasInfReposicion1'];
	if ( !empty($_POST['AguasInfReposicion2']) )          $AguasInfReposicion2           = $_POST['AguasInfReposicion2'];
	if ( !empty($_POST['AguasInfFactorCobro']) )          $AguasInfFactorCobro           = $_POST['AguasInfFactorCobro'];
	if ( !empty($_POST['AguasInfDifMedGeneral']) )        $AguasInfDifMedGeneral         = $_POST['AguasInfDifMedGeneral'];
	if ( !empty($_POST['AguasInfProcProrrateo']) )        $AguasInfProcProrrateo         = $_POST['AguasInfProcProrrateo'];
	if ( !empty($_POST['AguasInfTipoMedicion']) )         $AguasInfTipoMedicion          = $_POST['AguasInfTipoMedicion'];
	if ( !empty($_POST['AguasInfPuntoDiametro']) )        $AguasInfPuntoDiametro         = $_POST['AguasInfPuntoDiametro'];
	if ( !empty($_POST['AguasInfClaveFacturacion']) )     $AguasInfClaveFacturacion      = $_POST['AguasInfClaveFacturacion'];
	if ( !empty($_POST['AguasInfClaveLectura']) )         $AguasInfClaveLectura          = $_POST['AguasInfClaveLectura'];
	if ( !empty($_POST['AguasInfNumeroMedidor']) )        $AguasInfNumeroMedidor         = $_POST['AguasInfNumeroMedidor'];
	if ( !empty($_POST['AguasInfFechaEmision']) )         $AguasInfFechaEmision          = $_POST['AguasInfFechaEmision'];
	if ( !empty($_POST['AguasInfUltimoPagoFecha']) )      $AguasInfUltimoPagoFecha       = $_POST['AguasInfUltimoPagoFecha'];
	if ( !empty($_POST['AguasInfUltimoPagoMonto']) )      $AguasInfUltimoPagoMonto       = $_POST['AguasInfUltimoPagoMonto'];
	if ( !empty($_POST['AguasInfMovimientosHasta']) )     $AguasInfMovimientosHasta      = $_POST['AguasInfMovimientosHasta'];
	if ( !empty($_POST['idEstado']) )                     $idEstado                      = $_POST['idEstado'];
	if ( !empty($_POST['intAnual']) )                     $intAnual                      = $_POST['intAnual'];
	if ( !empty($_POST['idTipoPago']) )                   $idTipoPago                    = $_POST['idTipoPago'];
	if ( !empty($_POST['nDocPago']) )                     $nDocPago                      = $_POST['nDocPago'];
	if ( !empty($_POST['fechaPago']) )                    $fechaPago                     = $_POST['fechaPago'];
	if ( !empty($_POST['DiaPago']) )                      $DiaPago                       = $_POST['DiaPago'];
	if ( !empty($_POST['idMesPago']) )                    $idMesPago                     = $_POST['idMesPago'];
	if ( !empty($_POST['AnoPago']) )                      $AnoPago                       = $_POST['AnoPago'];
	if ( !empty($_POST['montoPago']) )                    $montoPago                     = $_POST['montoPago'];
	if ( !empty($_POST['idUsuarioPago']) )                $idUsuarioPago                 = $_POST['idUsuarioPago'];
	if ( !empty($_POST['idPago']) )                       $idPago                        = $_POST['idPago'];
	if ( !empty($_POST['rem_cantidad']) )                 $rem_cantidad                  = $_POST['rem_cantidad'];
	if ( !empty($_POST['rem_procentaje']) )               $rem_procentaje                = $_POST['rem_procentaje'];
	if ( !empty($_POST['rem_negative']) )                 $rem_negative                  = $_POST['rem_negative'];
	if ( !empty($_POST['rem_modalidad']) )                $rem_modalidad                 = $_POST['rem_modalidad'];
	if ( !empty($_POST['rem_diferencia']) )               $rem_diferencia                = $_POST['rem_diferencia'];
	if ( !empty($_POST['SII_idFacturable']) )             $SII_idFacturable              = $_POST['SII_idFacturable'];
	if ( !empty($_POST['SII_NDoc']) )                     $SII_NDoc                      = $_POST['SII_NDoc'];
	if ( !empty($_POST['NombreArchivo']) )                $NombreArchivo                 = $_POST['NombreArchivo'];


/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $form_obligatorios);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idFacturacion':          if(empty($idFacturacion)){            $error['idFacturacion']          = 'error/No ha ingresado el id';}break;
			case 'idSistema':              if(empty($idSistema)){                $error['idSistema']              = 'error/No ha ingresado el sistema';}break;
			case 'idUsuario':              if(empty($idUsuario)){                $error['idUsuario']              = 'error/No ha ingresado el usuario creador';}break;
			case 'Fecha':                  if(empty($Fecha)){                    $error['Fecha']                  = 'error/No ha ingresado el Fecha';}break;
			case 'Dia':                    if(empty($Dia)){                      $error['Dia']                    = 'error/No ha ingresado la Dia';}break;
			case 'idMes':                  if(empty($idMes)){                    $error['idMes']                  = 'error/No ha ingresado el mes';}break;
			case 'Ano':                    if(empty($Ano)){                      $error['Ano']                    = 'error/No ha seleccionado el Ano';}break;
			case 'Observaciones':          if(empty($Observaciones)){            $error['Observaciones']          = 'error/No ha ingresado la observacion';}break;
			case 'fCreacion':              if(empty($fCreacion)){                $error['fCreacion']              = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idFacturacionDetalle':   if(empty($idFacturacionDetalle)){     $error['idFacturacionDetalle']   = 'error/No ha ingresado la id del detalle';}break;
			case 'idCliente':              if(empty($idCliente)){                $error['idCliente']              = 'error/No ha ingresado el cliente';}break;
			case 'intAnual':               if(empty($intAnual)){                 $error['intAnual']               = 'error/No ha ingresado el interes anual';}break;
			case 'SII_NDoc':               if(empty($SII_NDoc)){                 $error['SII_NDoc']               = 'error/No ha ingresado el numero de documento';}break;
			case 'idOpcionesInteres':      if(empty($idOpcionesInteres)){        $error['idOpcionesInteres']      = 'error/No ha Seleccionado si va a calcular intereses';}break;
			
			case 'idFacturacionDetalle':              if(empty($idFacturacionDetalle)){                $error['idFacturacionDetalle']              = 'error/No ha ingresado el id';}break;
			case 'idCliente':                         if(empty($idCliente)){                           $error['idCliente']                         = 'error/No ha seleccionado el cliente';}break;
			case 'ClienteNombre':                     if(empty($ClienteNombre)){                       $error['ClienteNombre']                     = 'error/No ha ingresado el nombre del cliente';}break;
			case 'ClienteDireccion':                  if(empty($ClienteDireccion)){                    $error['ClienteDireccion']                  = 'error/No ha ingresado la direccion del cliente';}break;
			case 'ClienteIdentificador':              if(empty($ClienteIdentificador)){                $error['ClienteIdentificador']              = 'error/No ha ingresado el identificador del cliente';}break;
			case 'ClienteNombreComuna':               if(empty($ClienteNombreComuna)){                 $error['ClienteNombreComuna']               = 'error/No ha ingresado la comuna del cliente';}break;
			case 'ClienteFechaVencimiento':           if(empty($ClienteFechaVencimiento)){             $error['ClienteFechaVencimiento']           = 'error/No ha ingresado la fecha de vencimiento de la boleta o factura';}break;
			case 'ClienteEstado':                     if(empty($ClienteEstado)){                       $error['ClienteEstado']                     = 'error/No ha ingresado el estado';}break;
			case 'DetalleCargoFijoValor':             if(empty($DetalleCargoFijoValor)){               $error['DetalleCargoFijoValor']             = 'error/No ha ingresado el valor del cargo fijo';}break;
			case 'DetalleConsumoCantidad':            if(empty($DetalleConsumoCantidad)){              $error['DetalleConsumoCantidad']            = 'error/No ha ingresado los metros cubicos consumidos';}break;
			case 'DetalleConsumoValor':               if(empty($DetalleConsumoValor)){                 $error['DetalleConsumoValor']               = 'error/No ha ingresado el valor de los metros cubicos consumidos';}break;
			case 'DetalleRecoleccionCantidad':        if(empty($DetalleRecoleccionCantidad)){          $error['DetalleRecoleccionCantidad']        = 'error/No ha ingresado los metros cubicos recolectados';}break;
			case 'DetalleRecoleccionValor':           if(empty($DetalleRecoleccionValor)){             $error['DetalleRecoleccionValor']           = 'error/No ha ingresado el valor de los metros cubicos recolectados';}break;
			case 'DetalleVisitaCorte':                if(empty($DetalleVisitaCorte)){                  $error['DetalleVisitaCorte']                = 'error/No ha ingresado el detalle visita corte';}break;
			case 'DetalleCorte1Valor':                if(empty($DetalleCorte1Valor)){                  $error['DetalleCorte1Valor']                = 'error/No ha ingresado el valor del corte 1° instancia';}break;
			case 'DetalleCorte1Fecha':                if(empty($DetalleCorte1Fecha)){                  $error['DetalleCorte1Fecha']                = 'error/No ha ingresado la fecha del corte 1° instancia';}break;
			case 'DetalleCorte2Valor':                if(empty($DetalleCorte2Valor)){                  $error['DetalleCorte2Valor']                = 'error/No ha ingresado el valor del corte 2° instancia';}break;
			case 'DetalleCorte2Fecha':                if(empty($DetalleCorte2Fecha)){                  $error['DetalleCorte2Fecha']                = 'error/No ha ingresado la fecha del corte 2° instancia';}break;
			case 'DetalleReposicion1Valor':           if(empty($DetalleReposicion1Valor)){             $error['DetalleReposicion1Valor']           = 'error/No ha ingresado el valor de la reposicion 1° instancia';}break;
			case 'DetalleReposicion1Fecha':           if(empty($DetalleReposicion1Fecha)){             $error['DetalleReposicion1Fecha']           = 'error/No ha ingresado la fecha de la reposicion 1° instancia';}break;
			case 'DetalleReposicion2Valor':           if(empty($DetalleReposicion2Valor)){             $error['DetalleReposicion2Valor']           = 'error/No ha ingresado el valor de la reposicion 2° instancia';}break;
			case 'DetalleReposicion2Fecha':           if(empty($DetalleReposicion2Fecha)){             $error['DetalleReposicion2Fecha']           = 'error/No ha ingresado la fecha de la reposicion 2° instancia';}break;
			case 'DetalleSubtotalServicio':           if(empty($DetalleSubtotalServicio)){             $error['DetalleSubtotalServicio']           = 'error/No ha ingresado el valor del subtotal del servicio';}break;
			case 'DetalleInteresDeuda':               if(empty($DetalleInteresDeuda)){                 $error['DetalleInteresDeuda']               = 'error/No ha ingresado el interes';}break;
			case 'DetalleOtrosCargos1Texto':          if(empty($DetalleOtrosCargos1Texto)){            $error['DetalleOtrosCargos1Texto']          = 'error/No ha ingresado la descripcion de otros cargos 1';}break;
			case 'DetalleOtrosCargos2Texto':          if(empty($DetalleOtrosCargos2Texto)){            $error['DetalleOtrosCargos2Texto']          = 'error/No ha ingresado la descripcion de otros cargos 2';}break;
			case 'DetalleOtrosCargos3Texto':          if(empty($DetalleOtrosCargos3Texto)){            $error['DetalleOtrosCargos3Texto']          = 'error/No ha ingresado la descripcion de otros cargos 3';}break;
			case 'DetalleOtrosCargos4Texto':          if(empty($DetalleOtrosCargos4Texto)){            $error['DetalleOtrosCargos4Texto']          = 'error/No ha ingresado la descripcion de otros cargos 4';}break;
			case 'DetalleOtrosCargos5Texto':          if(empty($DetalleOtrosCargos5Texto)){            $error['DetalleOtrosCargos5Texto']          = 'error/No ha ingresado la descripcion de otros cargos 5';}break;
			case 'DetalleOtrosCargos1Valor':          if(empty($DetalleOtrosCargos1Valor)){            $error['DetalleOtrosCargos1Valor']          = 'error/No ha ingresado el valor de otros cargos 1';}break;
			case 'DetalleOtrosCargos2Valor':          if(empty($DetalleOtrosCargos2Valor)){            $error['DetalleOtrosCargos2Valor']          = 'error/No ha ingresado el valor de otros cargos 2';}break;
			case 'DetalleOtrosCargos3Valor':          if(empty($DetalleOtrosCargos3Valor)){            $error['DetalleOtrosCargos3Valor']          = 'error/No ha ingresado el valor de otros cargos 3';}break;
			case 'DetalleOtrosCargos4Valor':          if(empty($DetalleOtrosCargos4Valor)){            $error['DetalleOtrosCargos4Valor']          = 'error/No ha ingresado el valor de otros cargos 4';}break;
			case 'DetalleOtrosCargos5Valor':          if(empty($DetalleOtrosCargos5Valor)){            $error['DetalleOtrosCargos5Valor']          = 'error/No ha ingresado el valor de otros cargos 5';}break;
			case 'DetalleOtrosCargos1Fecha':          if(empty($DetalleOtrosCargos1Fecha)){            $error['DetalleOtrosCargos1Fecha']          = 'error/No ha ingresado la fecha de otros cargos 1';}break;
			case 'DetalleOtrosCargos2Fecha':          if(empty($DetalleOtrosCargos2Fecha)){            $error['DetalleOtrosCargos2Fecha']          = 'error/No ha ingresado la fecha de otros cargos 2';}break;
			case 'DetalleOtrosCargos3Fecha':          if(empty($DetalleOtrosCargos3Fecha)){            $error['DetalleOtrosCargos3Fecha']          = 'error/No ha ingresado la fecha de otros cargos 3';}break;
			case 'DetalleOtrosCargos4Fecha':          if(empty($DetalleOtrosCargos4Fecha)){            $error['DetalleOtrosCargos4Fecha']          = 'error/No ha ingresado la fecha de otros cargos 4';}break;
			case 'DetalleOtrosCargos5Fecha':          if(empty($DetalleOtrosCargos5Fecha)){            $error['DetalleOtrosCargos5Fecha']          = 'error/No ha ingresado la fecha de otros cargos 5';}break;
			case 'DetalleTotalVenta':                 if(empty($DetalleTotalVenta)){                   $error['DetalleTotalVenta']                 = 'error/No ha ingresado el total de la venta';}break;
			case 'DetalleSaldoFavor':                 if(empty($DetalleSaldoFavor)){                   $error['DetalleSaldoFavor']                 = 'error/No ha ingresado el saldo a favor';}break;
			case 'DetalleSaldoAnterior':              if(empty($DetalleSaldoAnterior)){                $error['DetalleSaldoAnterior']              = 'error/No ha ingresado el saldo anterior';}break;
			case 'DetalleTotalAPagar':                if(empty($DetalleTotalAPagar)){                  $error['DetalleTotalAPagar']                = 'error/No ha ingresado el total a pagar';}break;
			case 'GraficoMes1Valor':                  if(empty($GraficoMes1Valor)){                    $error['GraficoMes1Valor']                  = 'error/No ha ingresado el valor del grafico mes 1';}break;
			case 'GraficoMes2Valor':                  if(empty($GraficoMes2Valor)){                    $error['GraficoMes2Valor']                  = 'error/No ha ingresado el valor del grafico mes 2';}break;
			case 'GraficoMes3Valor':                  if(empty($GraficoMes3Valor)){                    $error['GraficoMes3Valor']                  = 'error/No ha ingresado el valor del grafico mes 3';}break;
			case 'GraficoMes4Valor':                  if(empty($GraficoMes4Valor)){                    $error['GraficoMes4Valor']                  = 'error/No ha ingresado el valor del grafico mes 4';}break;
			case 'GraficoMes5Valor':                  if(empty($GraficoMes5Valor)){                    $error['GraficoMes5Valor']                  = 'error/No ha ingresado el valor del grafico mes 5';}break;
			case 'GraficoMes6Valor':                  if(empty($GraficoMes6Valor)){                    $error['GraficoMes6Valor']                  = 'error/No ha ingresado el valor del grafico mes 6';}break;
			case 'GraficoMes7Valor':                  if(empty($GraficoMes7Valor)){                    $error['GraficoMes7Valor']                  = 'error/No ha ingresado el valor del grafico mes 7';}break;
			case 'GraficoMes8Valor':                  if(empty($GraficoMes8Valor)){                    $error['GraficoMes8Valor']                  = 'error/No ha ingresado el valor del grafico mes 8';}break;
			case 'GraficoMes9Valor':                  if(empty($GraficoMes9Valor)){                    $error['GraficoMes9Valor']                  = 'error/No ha ingresado el valor del grafico mes 9';}break;
			case 'GraficoMes10Valor':                 if(empty($GraficoMes10Valor)){                   $error['GraficoMes10Valor']                 = 'error/No ha ingresado el valor del grafico mes 10';}break;
			case 'GraficoMes11Valor':                 if(empty($GraficoMes11Valor)){                   $error['GraficoMes11Valor']                 = 'error/No ha ingresado el valor del grafico mes 11';}break;
			case 'GraficoMes12Valor':                 if(empty($GraficoMes12Valor)){                   $error['GraficoMes12Valor']                 = 'error/No ha ingresado el valor del grafico mes 12';}break;
			case 'GraficoMes1Fecha':                  if(empty($GraficoMes1Fecha)){                    $error['GraficoMes1Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 1';}break;
			case 'GraficoMes2Fecha':                  if(empty($GraficoMes2Fecha)){                    $error['GraficoMes2Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 2';}break;
			case 'GraficoMes3Fecha':                  if(empty($GraficoMes3Fecha)){                    $error['GraficoMes3Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 3';}break;
			case 'GraficoMes4Fecha':                  if(empty($GraficoMes4Fecha)){                    $error['GraficoMes4Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 4';}break;
			case 'GraficoMes5Fecha':                  if(empty($GraficoMes5Fecha)){                    $error['GraficoMes5Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 5';}break;
			case 'GraficoMes6Fecha':                  if(empty($GraficoMes6Fecha)){                    $error['GraficoMes6Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 6';}break;
			case 'GraficoMes7Fecha':                  if(empty($GraficoMes7Fecha)){                    $error['GraficoMes7Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 7';}break;
			case 'GraficoMes8Fecha':                  if(empty($GraficoMes8Fecha)){                    $error['GraficoMes8Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 8';}break;
			case 'GraficoMes9Fecha':                  if(empty($GraficoMes9Fecha)){                    $error['GraficoMes9Fecha']                  = 'error/No ha ingresado la fecha del grafico mes 9';}break;
			case 'GraficoMes10Fecha':                 if(empty($GraficoMes10Fecha)){                   $error['GraficoMes10Fecha']                 = 'error/No ha ingresado la fecha del grafico mes 10';}break;
			case 'GraficoMes11Fecha':                 if(empty($GraficoMes11Fecha)){                   $error['GraficoMes11Fecha']                 = 'error/No ha ingresado la fecha del grafico mes 11';}break;
			case 'GraficoMes12Fecha':                 if(empty($GraficoMes12Fecha)){                   $error['GraficoMes12Fecha']                 = 'error/No ha ingresado la fecha del grafico mes 12';}break;
			case 'DetConsMesAnteriorCantidad':        if(empty($DetConsMesAnteriorCantidad)){          $error['DetConsMesAnteriorCantidad']        = 'error/No ha ingresado el consumo del mes anterior';}break;
			case 'DetConsMesAnteriorFecha':           if(empty($DetConsMesAnteriorFecha)){             $error['DetConsMesAnteriorFecha']           = 'error/No ha ingresado la fecha del consumo del mes anterior';}break;
			case 'DetConsMesActualCantidad':          if(empty($DetConsMesActualCantidad)){            $error['DetConsMesActualCantidad']          = 'error/No ha ingresado el consumo del mes actual';}break;
			case 'DetConsMesActualFecha':             if(empty($DetConsMesActualFecha)){               $error['DetConsMesActualFecha']             = 'error/No ha ingresado la fecha del consumo del mes actual';}break;
			case 'DetConsMesDiferencia':              if(empty($DetConsMesDiferencia)){                $error['DetConsMesDiferencia']              = 'error/No ha ingresado la diferencia';}break;
			case 'DetConsProrateo':                   if(empty($DetConsProrateo)){                     $error['DetConsProrateo']                   = 'error/No ha ingresado el prorateo';}break;
			case 'DetConsProrateoSigno':              if(empty($DetConsProrateoSigno)){                $error['DetConsProrateoSigno']              = 'error/No ha ingresado el signo del prorateo';}break;
			case 'DetConsMesTotalCantidad':           if(empty($DetConsMesTotalCantidad)){             $error['DetConsMesTotalCantidad']           = 'error/No ha ingresado el total de consumo';}break;
			case 'DetConsFechaProxLectura':           if(empty($DetConsFechaProxLectura)){             $error['DetConsFechaProxLectura']           = 'error/No ha ingresado la fecha de la proxima lectura';}break;
			case 'DetConsModalidad':                  if(empty($DetConsModalidad)){                    $error['DetConsModalidad']                  = 'error/No ha ingresado la modalidad';}break;
			case 'DetConsFonoEmergencias':            if(empty($DetConsFonoEmergencias)){              $error['DetConsFonoEmergencias']            = 'error/No ha ingresado el fono de emergencia';}break;
			case 'DetConsFonoConsultas':              if(empty($DetConsFonoConsultas)){                $error['DetConsFonoConsultas']              = 'error/No ha ingresado el fono de consultas';}break;
			case 'AguasInfCargoFijo':                 if(empty($AguasInfCargoFijo)){                   $error['AguasInfCargoFijo']                 = 'error/No ha ingresado el cargo fijo';}break;
			case 'AguasInfMetroAgua':                 if(empty($AguasInfMetroAgua)){                   $error['AguasInfMetroAgua']                 = 'error/No ha ingresado el valor del metro cubico de agua';}break;
			case 'AguasInfMetroRecolecion':           if(empty($AguasInfMetroRecolecion)){             $error['AguasInfMetroRecolecion']           = 'error/No ha ingresado el valor del metro cubico de recoleccion';}break;
			case 'AguasInfVisitaCorte':               if(empty($AguasInfVisitaCorte)){                 $error['AguasInfVisitaCorte']               = 'error/No ha ingresado el valor de la visita de corte';}break;
			case 'AguasInfCorte1':                    if(empty($AguasInfCorte1)){                      $error['AguasInfCorte1']                    = 'error/No ha ingresado el valor del corte de 1° instancia';}break;
			case 'AguasInfCorte2':                    if(empty($AguasInfCorte2)){                      $error['AguasInfCorte2']                    = 'error/No ha ingresado el valor del corte de 2° instancia';}break;
			case 'AguasInfReposicion1':               if(empty($AguasInfReposicion1)){                 $error['AguasInfReposicion1']               = 'error/No ha ingresado el valor de la reposicion de 1° instancia';}break;
			case 'AguasInfReposicion2':               if(empty($AguasInfReposicion2)){                 $error['AguasInfReposicion2']               = 'error/No ha ingresado el valor de la reposicion de 2° instancia';}break;
			case 'AguasInfFactorCobro':               if(empty($AguasInfFactorCobro)){                 $error['AguasInfFactorCobro']               = 'error/No ha ingresado el factor de cobro';}break;
			case 'AguasInfDifMedGeneral':             if(empty($AguasInfDifMedGeneral)){               $error['AguasInfDifMedGeneral']             = 'error/No ha ingresado la diferencia con el medidor general';}break;
			case 'AguasInfProcProrrateo':             if(empty($AguasInfProcProrrateo)){               $error['AguasInfProcProrrateo']             = 'error/No ha ingresado el porcentaje de prorateo';}break;
			case 'AguasInfTipoMedicion':              if(empty($AguasInfTipoMedicion)){                $error['AguasInfTipoMedicion']              = 'error/No ha ingresado el tipo de medicion';}break;
			case 'AguasInfPuntoDiametro':             if(empty($AguasInfPuntoDiametro)){               $error['AguasInfPuntoDiametro']             = 'error/No ha ingresado el punto de diametro';}break;
			case 'AguasInfClaveFacturacion':          if(empty($AguasInfClaveFacturacion)){            $error['AguasInfClaveFacturacion']          = 'error/No ha ingresado la clave de facturacion';}break;
			case 'AguasInfClaveLectura':              if(empty($AguasInfClaveLectura)){                $error['AguasInfClaveLectura']              = 'error/No ha ingresado la clave de lectura';}break;
			case 'AguasInfNumeroMedidor':             if(empty($AguasInfNumeroMedidor)){               $error['AguasInfNumeroMedidor']             = 'error/No ha ingresado el numero de medidor';}break;
			case 'AguasInfFechaEmision':              if(empty($AguasInfFechaEmision)){                $error['AguasInfFechaEmision']              = 'error/No ha ingresado la fecha de emision del documento';}break;
			case 'AguasInfUltimoPagoFecha':           if(empty($AguasInfUltimoPagoFecha)){             $error['AguasInfUltimoPagoFecha']           = 'error/No ha ingresado la fecha del ultimo pago';}break;
			case 'AguasInfUltimoPagoMonto':           if(empty($AguasInfUltimoPagoMonto)){             $error['AguasInfUltimoPagoMonto']           = 'error/No ha ingresado el monto del ultimo pago';}break;
			case 'AguasInfMovimientosHasta':          if(empty($AguasInfMovimientosHasta)){            $error['AguasInfMovimientosHasta']          = 'error/No ha ingresado el rango de facturacion';}break;
			case 'idEstado':                          if(empty($idEstado)){                            $error['idEstado']                          = 'error/No ha seleccionado el estado de pago';}break;
			case 'intAnual':                          if(empty($intAnual)){                            $error['intAnual']                          = 'error/No ha ingresado el interes anual';}break;
			case 'idTipoPago':                        if(empty($idTipoPago)){                          $error['idTipoPago']                        = 'error/No ha seleccionado el documento de pago';}break;
			case 'nDocPago':                          if(empty($nDocPago)){                            $error['nDocPago']                          = 'error/No ha ingresado el numero de documento de pago';}break;
			case 'fechaPago':                         if(empty($fechaPago)){                           $error['fechaPago']                         = 'error/No ha ingresado la fecha de pago';}break;
			case 'DiaPago':                           if(empty($DiaPago)){                             $error['DiaPago']                           = 'error/No ha ingresado el dia de pago';}break;
			case 'idMesPago':                         if(empty($idMesPago)){                           $error['idMesPago']                         = 'error/No ha ingresado el mes de pago';}break;
			case 'AnoPago':                           if(empty($AnoPago)){                             $error['AnoPago']                           = 'error/No ha ingresado el año de pago';}break;
			case 'montoPago':                         if(empty($montoPago)){                           $error['montoPago']                         = 'error/No ha ingresado el monto pagado';}break;
			case 'idUsuarioPago':                     if(empty($idUsuarioPago)){                       $error['idUsuarioPago']                     = 'error/No ha seleccionado el usuario que ingreso el pago';}break;
			case 'idPago':                            if(empty($idPago)){                              $error['idPago']                            = 'error/No ha seleccionado la relacion con el documento de pago';}break;
			case 'rem_cantidad':                      if(empty($rem_cantidad)){                        $error['rem_cantidad']                      = 'error/No ha ingresado el rem_cantidad';}break;
			case 'rem_procentaje':                    if(empty($rem_procentaje)){                      $error['rem_procentaje']                    = 'error/No ha ingresado el rem_procentaje';}break;
			case 'rem_negative':                      if(empty($rem_negative)){                        $error['rem_negative']                      = 'error/No ha ingresado el rem_negative';}break;
			case 'rem_modalidad':                     if(empty($rem_modalidad)){                       $error['rem_modalidad']                     = 'error/No ha ingresado el rem_modalidad';}break;
			case 'rem_diferencia':                    if(empty($rem_diferencia)){                      $error['rem_diferencia']                    = 'error/No ha ingresado el rem_diferencia';}break;
			case 'SII_idFacturable':                  if(empty($SII_idFacturable)){                    $error['SII_idFacturable']                  = 'error/No ha seleccionado el tipo de documento';}break;
			case 'SII_NDoc':                          if(empty($SII_NDoc)){                            $error['SII_NDoc']                          = 'error/No ha ingresado el numero de documento';}break;
			case 'NombreArchivo':                     if(empty($NombreArchivo)){                       $error['NombreArchivo']                     = 'error/No ha ingresado el nombre del archivo adjunto';}break;

		}
	}
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {

/*******************************************************************************************************************/		
		case 'create_new':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Fecha)&&isset($idSistema)){
				$idMes   = Fecha_mes_n($Fecha);
				$Ano     = Fecha_año($Fecha);
				$query = "SELECT idFacturacion 
				FROM facturacion_listado 
				WHERE idSistema='".$idSistema."' AND idMes='".$idMes."' AND Ano='".$Ano."'";
				$resultado = mysqli_query ($dbConn, $query);
				$ndata_1 = mysqli_num_rows ($resultado);
			}
			//generacion de errores
			if($ndata_1 > 0) { $error['ndata_1'] = 'error/El Facturacion ingresada ya existe en el sistema';}
			/*******************************************************************/
			//existencia de datos
			if(!isset($idSistema) OR $idSistema == ''){                  $error['idSistema']         = 'error/No ha seleccionado el Sistema';}
			if(!isset($idUsuario) OR $idUsuario == ''){                  $error['idUsuario']         = 'error/No ha seleccionado Usuario';}
			if(!isset($Fecha) OR $Fecha == ''){                          $error['Fecha']             = 'error/No ha ingresado la Fecha';}
			if(!isset($fCreacion) OR $fCreacion == ''){                  $error['fCreacion']         = 'error/No ha ingresado la Fecha de creacion';}
			if(!isset($intAnual) OR $intAnual == ''){                    $error['intAnual']          = 'error/No ha ingresado el interes anual';}
			if(!isset($idOpcionesInteres) OR $idOpcionesInteres == ''){  $error['idOpcionesInteres'] = 'error/No ha seleccionado la opcion de calculo de intereses';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/******************************************************************************************/
				/*                                        Variables                                       */
				/******************************************************************************************/
				$Eventos           = array();
				$MedicionActual    = array();
				$MedicionAnterior  = array();
				$Estados           = array();
				$OtrosCargos       = array();
				$Graficos          = array();
				$DocFacturable     = array();
				$cargoCont         = 0;
				$ultimocliente     = 0;
				$Dia               = Fecha_dia($Fecha);
				$idMes             = Fecha_mes_n($Fecha);
				$Ano               = Fecha_año($Fecha);
				
				//mes anterior
				$idMesAnterior   = $idMes-1;
				$AnoAnterior     = $Ano;
				if($idMesAnterior==0){
					$idMesAnterior = 12;
					$AnoAnterior   = $Ano - 1;
				}
				//Mes Proximo
				$idMesProximo   = $idMes+1;
				$AnoProximo     = $Ano;
				if($idMesProximo==13){
					$idMesProximo = 1;
					$AnoProximo   = $Ano + 1;
				}
				
				/******************************************************************************************/
				/*                                        Consultas                                       */
				/******************************************************************************************/
				//actualizo el estado de todos los que ya estan pagados
				$query = "UPDATE `facturacion_listado_detalle` SET `idEstado`='2' WHERE `DetalleTotalAPagar`=`montoPago` AND idEstado=1";
				$resultado = mysqli_query ($dbConn, $query);
				
				//ubico los datos actualizados de facturacion
				$query = "SELECT Nombre FROM `usuarios_listado` WHERE idUsuario='".$idUsuario."' ";
				$resultado = mysqli_query ($dbConn, $query);
				$rowUsuario = mysqli_fetch_assoc ($resultado);
				
				//ubico los datos actualizados de facturacion
				$query = "SELECT
				core_sistemas.Nombre AS SistemaNombre,
				core_sistemas.Rut AS SistemaRut,
				core_sistemas.Rubro AS SistemaRubro,
				core_sistemas.Direccion AS SistemaDireccion,
				core_sistemas.Fono AS SistemaFono1,
				core_sistemas.Comuna AS SistemaComuna,
				core_sistemas.Ciudad AS SistemaCiudad,
				core_sistemas.valorCargoFijo, 
				core_sistemas.valorAgua, 
				core_sistemas.valorRecoleccion, 
				core_sistemas.valorVisitaCorte, 
				core_sistemas.valorCorte1, 
				core_sistemas.valorCorte2, 
				core_sistemas.valorReposicion1, 
				core_sistemas.valorReposicion2, 
				core_sistemas.NdiasPago, 
				core_sistemas.Fac_nEmergencia, 
				core_sistemas.Fac_nConsultas
				
				FROM `core_sistemas`
				WHERE core_sistemas.idSistema='".$idSistema."' ";
				$resultado = mysqli_query ($dbConn, $query);
				$rowSistema = mysqli_fetch_assoc ($resultado);
				
				
				/* ************************************************** */
				// Se trae un listado con todos los clientes
				$arrClientes = array();
				$query = "SELECT 
				clientes_listado.idCliente,
				clientes_listado.idCliente AS ID,
				clientes_listado.Nombre,
				clientes_listado.RazonSocial,
				clientes_listado.Direccion,
				clientes_listado.Identificador,
				clientes_listado.UnidadHabitacional,
				clientes_listado.Arranque,
				clientes_listado.idFacturable,
				clientes_listado.Rut,
				clientes_listado.Giro,
				clientes_listado.Fono1,
				clientes_listado.Fono2,
				clientes_listado.idEstadoPago,
				mnt_ubicacion_comunas.Nombre AS NombreComuna,
				mnt_ubicacion_ciudad.Nombre AS NombreCiudad,
				marcadores_listado.Nombre AS NombreMedidor,
				marcadores_remarcadores.Nombre AS NombreMarcador,
					
				(SELECT DetalleTotalAPagar                    FROM `facturacion_listado_detalle`      WHERE idCliente = ID AND idEstado = 1 ORDER BY Fecha DESC LIMIT 1) AS SaldoAnterior,
				(SELECT ClienteFechaVencimiento               FROM `facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY ClienteFechaVencimiento DESC LIMIT 1) AS FechaVencimiento,
				(SELECT DetalleTotalAPagar                    FROM `facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS MontoPactado,
				(SELECT montoPago                             FROM `facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS MontoPagado,
				(SELECT fechaPago                             FROM `facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS FechaPagado,
				(SELECT idDatosDetalle                        FROM `mediciones_datos_detalle`         WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS DetMesActualidDatosDetalle,
				(SELECT COUNT(idFacturacionDetalle) AS Cuenta FROM `facturacion_listado_detalle`      WHERE idCliente = ID AND idEstado = 1 LIMIT 1) AS CuentaPendientes,
				(SELECT fechaPago                             FROM `clientes_pago`                    WHERE idCliente = ID ORDER BY fechaPago DESC LIMIT 1) AS PagoFecha,
				(SELECT montoPago                             FROM `clientes_pago`                    WHERE idCliente = ID ORDER BY fechaPago DESC LIMIT 1) AS PagoMonto

				FROM `clientes_listado`
				LEFT JOIN `mnt_ubicacion_comunas`      ON mnt_ubicacion_comunas.idComuna            = clientes_listado.idComuna
				LEFT JOIN `mnt_ubicacion_ciudad`       ON mnt_ubicacion_ciudad.idCiudad             = clientes_listado.idCiudad
				LEFT JOIN `marcadores_listado`         ON marcadores_listado.idMarcadores           = clientes_listado.idMarcadores
				LEFT JOIN `marcadores_remarcadores`    ON marcadores_remarcadores.idRemarcadores    = clientes_listado.idRemarcadores
				
				WHERE clientes_listado.idSistema=".$idSistema." AND clientes_listado.idFacturable != 3
				ORDER BY clientes_listado.idCliente ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				
				/* ************************************************** */
				//Se traen todos los eventos transcurridos en el mes
				$arrEventos = array();
				$query = "SELECT idCliente, idTipo, ValorEvento, FechaEjecucion, Fecha
				FROM `clientes_eventos`
				WHERE idSistema = ".$idSistema." AND Ano = ".$Ano." AND idMes = ".$idMes."
				ORDER BY idCliente ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrEventos,$row );
				}
				
				/* ************************************************** */
				//Se traen todos los consumos del mes
				$arrDatos = array();
				$query = "SELECT
				mediciones_datos_detalle.idCliente,
				mediciones_datos_detalle.Consumo, 
				mediciones_datos_detalle.Fecha,

				mediciones_datos_detalle.idTipoMedicion,
				mediciones_datos_detalle.ConsumoMedidor,
				mediciones_datos_detalle.ConsumoGeneral,
				mediciones_datos_detalle.CantRemarcadores,

				data1.Nombre AS TipoFacturacion,
				data2.Nombre AS TipoLectura
				FROM `mediciones_datos_detalle`
				LEFT JOIN `mediciones_datos_detalle_tipofacturacion` data1 ON data1.idTipoFacturacion   = mediciones_datos_detalle.idTipoFacturacion
				LEFT JOIN `mediciones_datos_detalle_tipolectura`     data2 ON data2.idTipoLectura       = mediciones_datos_detalle.idTipoLectura
				WHERE mediciones_datos_detalle.idSistema = ".$idSistema."
				AND mediciones_datos_detalle.Ano = ".$Ano."
				AND mediciones_datos_detalle.idMes = ".$idMes."
				ORDER BY mediciones_datos_detalle.idCliente ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDatos,$row );
				}
				
				/* ************************************************** */
				//Se traen todos los consumos del mes anterior
				$arrDatosAnteriores = array();
				$query = "SELECT idCliente, Consumo, Fecha
				FROM `mediciones_datos_detalle`
				WHERE idSistema = ".$idSistema." AND Ano = ".$AnoAnterior." AND idMes = ".$idMesAnterior."
				ORDER BY idCliente ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDatosAnteriores,$row );
				}
				
				/* ************************************************** */
				//se consultan los estados de pago de los clientes
				$arrEstados = array();
				$query = "SELECT idEstadoPago, Nombre
				FROM `clientes_estadopago` ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrEstados,$row );
				}
				
				/* ************************************************** */
				//Se traen todos los cargos transcurridos en el mes
				$arrCargos = array();
				$query = "SELECT idCliente, FechaEjecucion, Observacion, ValorCargo
				FROM `clientes_otros_cargos`
				WHERE idSistema = ".$idSistema." AND Ano = ".$Ano." AND idMes = ".$idMes."
				ORDER BY idCliente ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrCargos,$row );
				}
				
				/* ************************************************** */
				//Leo todos los datos de la base
				$arrGraficos = array();
				$query = "SELECT idCliente,GraficoMes1Valor,GraficoMes2Valor,GraficoMes3Valor,
				GraficoMes4Valor,GraficoMes5Valor,GraficoMes6Valor,GraficoMes7Valor,GraficoMes8Valor,
				GraficoMes9Valor,GraficoMes10Valor,GraficoMes11Valor,GraficoMes12Valor,GraficoMes1Fecha,
				GraficoMes2Fecha,GraficoMes3Fecha,GraficoMes4Fecha,GraficoMes5Fecha,GraficoMes6Fecha,
				GraficoMes7Fecha,GraficoMes8Fecha,GraficoMes9Fecha,GraficoMes10Fecha,GraficoMes11Fecha,
				GraficoMes12Fecha
				FROM `facturacion_listado_detalle`
				WHERE idSistema = ".$idSistema." AND Ano = ".$AnoAnterior." AND idMes = ".$idMesAnterior."
				ORDER BY idCliente ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrGraficos,$row );
				}
				
				/* ************************************************** */
				//se consultan los estados de pago de los clientes
				$arrDocFacturable = array();
				$query = "SELECT idFacturable, Nombre
				FROM `clientes_facturable`
				ORDER BY Nombre ASC  ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrDocFacturable,$row );
				}
				
				
				
				/* ************************************************** */
				/* ************************************************** */
				//Arreglo Temporal
				//Se recorren los eventos
				foreach ($arrEventos as $datos) { 	
					$Eventos[$datos['idCliente']][$datos['idTipo']]['idTipo']          = $datos['idTipo'];
					$Eventos[$datos['idCliente']][$datos['idTipo']]['ValorEvento']     = $datos['ValorEvento'];
					$Eventos[$datos['idCliente']][$datos['idTipo']]['Fecha']           = $datos['Fecha'];
					$Eventos[$datos['idCliente']][$datos['idTipo']]['FechaEjecucion']  = $datos['FechaEjecucion'];
				}
				//Se recorren las mediciones
				foreach ($arrDatos as $datos) { 	
					$MedicionActual[$datos['idCliente']]['idCliente']          = $datos['idCliente'];
					$MedicionActual[$datos['idCliente']]['Fecha']              = $datos['Fecha'];
					$MedicionActual[$datos['idCliente']]['Consumo']            = $datos['Consumo'];
					$MedicionActual[$datos['idCliente']]['idTipoMedicion']     = $datos['idTipoMedicion'];
					$MedicionActual[$datos['idCliente']]['ConsumoMedidor']     = $datos['ConsumoMedidor'];
					$MedicionActual[$datos['idCliente']]['ConsumoGeneral']     = $datos['ConsumoGeneral'];
					$MedicionActual[$datos['idCliente']]['CantRemarcadores']   = $datos['CantRemarcadores'];
					$MedicionActual[$datos['idCliente']]['TipoFacturacion']    = $datos['TipoFacturacion'];
					$MedicionActual[$datos['idCliente']]['TipoLectura']        = $datos['TipoLectura'];
				}
				//Se recorren las mediciones
				foreach ($arrDatosAnteriores as $datos) { 	
					$MedicionAnterior[$datos['idCliente']]['idCliente']        = $datos['idCliente'];
					$MedicionAnterior[$datos['idCliente']]['Consumo']          = $datos['Consumo'];
					$MedicionAnterior[$datos['idCliente']]['Fecha']            = $datos['Fecha'];
				}
				//Se recorren los estados
				foreach ($arrEstados as $datos) { 	
					$Estados[$datos['idEstadoPago']]['Nombre'] = $datos['Nombre'];
				}
				//Se recorren los otros cargos
				foreach ($arrCargos as $datos) { 	
					//comparo el ultimo cliente
					if($ultimocliente!=$datos['idCliente']){
						$ultimocliente = $datos['idCliente'];
						$cargoCont = 0;
					}
					//creo las variables	
					$OtrosCargos[$datos['idCliente']][$cargoCont]['Observacion']     = $datos['Observacion'];
					$OtrosCargos[$datos['idCliente']][$cargoCont]['ValorCargo']      = $datos['ValorCargo'];
					$OtrosCargos[$datos['idCliente']][$cargoCont]['FechaEjecucion']  = $datos['FechaEjecucion'];
					$cargoCont++;
				
				}
				//Se recorren los graficos
				foreach($arrGraficos as $datos){
					//valores
					$Graficos[$datos['idCliente']]['GraficoMes1Valor']   = $datos['GraficoMes2Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes2Valor']   = $datos['GraficoMes3Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes3Valor']   = $datos['GraficoMes4Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes4Valor']   = $datos['GraficoMes5Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes5Valor']   = $datos['GraficoMes6Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes6Valor']   = $datos['GraficoMes7Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes7Valor']   = $datos['GraficoMes8Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes8Valor']   = $datos['GraficoMes9Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes9Valor']   = $datos['GraficoMes10Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes10Valor']  = $datos['GraficoMes11Valor'];
					$Graficos[$datos['idCliente']]['GraficoMes11Valor']  = $datos['GraficoMes12Valor'];
					//fechas				
					$Graficos[$datos['idCliente']]['GraficoMes1Fecha']   = $datos['GraficoMes2Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes2Fecha']   = $datos['GraficoMes3Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes3Fecha']   = $datos['GraficoMes4Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes4Fecha']   = $datos['GraficoMes5Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes5Fecha']   = $datos['GraficoMes6Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes6Fecha']   = $datos['GraficoMes7Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes7Fecha']   = $datos['GraficoMes8Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes8Fecha']   = $datos['GraficoMes9Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes9Fecha']   = $datos['GraficoMes10Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes10Fecha']  = $datos['GraficoMes11Fecha'];
					$Graficos[$datos['idCliente']]['GraficoMes11Fecha']  = $datos['GraficoMes12Fecha'];
					
				}
				//Se recorren los estados
				foreach ($arrDocFacturable as $datos) { 	
					$DocFacturable[$datos['idFacturable']]['Nombre'] = $datos['Nombre'];
				}
			
				/******************************************************************************************/
				/*                                        Ejecucion                                       */
				/******************************************************************************************/
				unset($_SESSION['Facturacion_basicos']);
				unset($_SESSION['Facturacion_clientes']);
				
				/********************************************************************************/
				//Bloque tabla principal
				if(isset($idSistema) && $idSistema != ''){                  $_SESSION['Facturacion_basicos']['idSistema']             = $idSistema;             }else{$_SESSION['Facturacion_basicos']['idSistema']            = '';}
				if(isset($idUsuario) && $idUsuario != ''){                  $_SESSION['Facturacion_basicos']['idUsuario']             = $idUsuario;             }else{$_SESSION['Facturacion_basicos']['idUsuario']            = '';}
				if(isset($Fecha) && $Fecha != ''){                          $_SESSION['Facturacion_basicos']['Fecha']                 = $Fecha;                 }else{$_SESSION['Facturacion_basicos']['Fecha']                = '';}
				if(isset($Dia) && $Dia != ''){                              $_SESSION['Facturacion_basicos']['Dia']                   = $Dia;                   }else{$_SESSION['Facturacion_basicos']['Dia']                  = '';}
				if(isset($idMes) && $idMes != ''){                          $_SESSION['Facturacion_basicos']['idMes']                 = $idMes;                 }else{$_SESSION['Facturacion_basicos']['idMes']                = '';}
				if(isset($Ano) && $Ano != ''){                              $_SESSION['Facturacion_basicos']['Ano']                   = $Ano;                   }else{$_SESSION['Facturacion_basicos']['Ano']                  = '';}
				if(isset($Observaciones) && $Observaciones != ''){          $_SESSION['Facturacion_basicos']['Observaciones']         = $Observaciones;         }else{$_SESSION['Facturacion_basicos']['Observaciones']        = 'Sin Observaciones';}
				if(isset($fCreacion) && $fCreacion != ''){                  $_SESSION['Facturacion_basicos']['fCreacion']             = $fCreacion;             }else{$_SESSION['Facturacion_basicos']['fCreacion']            = '';}
				if(isset($intAnual) && $intAnual != ''){                    $_SESSION['Facturacion_basicos']['intAnual']              = $intAnual;              }else{$_SESSION['Facturacion_basicos']['intAnual']             = '';}
				if(isset($idOpcionesInteres) && $idOpcionesInteres != ''){  $_SESSION['Facturacion_basicos']['idOpcionesInteres']     = $idOpcionesInteres;     }else{$_SESSION['Facturacion_basicos']['idOpcionesInteres']    = '';}
				//dato extra
				if(isset($idUsuario) && $idUsuario != ''){                  $_SESSION['Facturacion_basicos']['Usuario']               = $rowUsuario['Nombre'];  }else{$_SESSION['Facturacion_basicos']['Usuario']              = '';}
				if(isset($idSistema) && $idSistema != ''){                  
					$_SESSION['Facturacion_basicos']['SistemaNombre']     = $rowSistema['SistemaNombre'];        
					$_SESSION['Facturacion_basicos']['SistemaRut']        = $rowSistema['SistemaRut'];         
					$_SESSION['Facturacion_basicos']['SistemaRubro']      = $rowSistema['SistemaRubro'];          
					$_SESSION['Facturacion_basicos']['SistemaDireccion']  = $rowSistema['SistemaDireccion'];         
					$_SESSION['Facturacion_basicos']['SistemaFono1']      = $rowSistema['SistemaFono1'];          
					$_SESSION['Facturacion_basicos']['SistemaComuna']     = $rowSistema['SistemaComuna'];          
					$_SESSION['Facturacion_basicos']['SistemaCiudad']     = $rowSistema['SistemaCiudad'];        
				}else{
					$_SESSION['Facturacion_basicos']['SistemaNombre']     = '';
					$_SESSION['Facturacion_basicos']['SistemaRut']        = '';   
					$_SESSION['Facturacion_basicos']['SistemaRubro']      = ''; 
					$_SESSION['Facturacion_basicos']['SistemaDireccion']  = '';    
					$_SESSION['Facturacion_basicos']['SistemaFono1']      = '';    
					$_SESSION['Facturacion_basicos']['SistemaComuna']     = '';     
					$_SESSION['Facturacion_basicos']['SistemaCiudad']     = '';
				}
				
				
				/********************************************************************************/
				//bloque detalles
				foreach ($arrClientes as $cliente) {
					
					//Variables Vacias
					$rem_modalidad             = '';
					$rem_cantidad              = 0;
					$rem_porcentaje            = 0;
					$rem_diferencia            = 0;
					$DetalleVisitaCorte        = 0;
					$DetalleCorte1Fecha        = 0;
					$DetalleCorte1Valor        = 0;
					$DetalleCorte2Fecha        = 0;
					$DetalleCorte2Valor        = 0;
					$DetalleReposicion1Fecha   = 0;
					$DetalleReposicion1Valor   = 0;
					$DetalleReposicion2Fecha   = 0;
					$DetalleReposicion2Valor   = 0;
					$xcalc_1                   = 0;
					$xcalc_2                   = 0;
					$interes1                  = 0;
					$interes2                  = 0;
					$interes3                  = 0;
					$interes4                  = 0;
					$intereses                 = 0;
					$saldofavor                = 0;
					$xcalc1                    = 0;
					$difsaldoant               = 0;
					$DetalleOtrosCargos1Texto  = '';
					$DetalleOtrosCargos2Texto  = '';
					$DetalleOtrosCargos3Texto  = '';
					$DetalleOtrosCargos4Texto  = '';
					$DetalleOtrosCargos5Texto  = '';
					$DetalleOtrosCargos1Valor  = 0;
					$DetalleOtrosCargos2Valor  = 0;
					$DetalleOtrosCargos3Valor  = 0;
					$DetalleOtrosCargos4Valor  = 0;
					$DetalleOtrosCargos5Valor  = 0;
					$DetalleOtrosCargos1Fecha  = '';
					$DetalleOtrosCargos2Fecha  = '';
					$DetalleOtrosCargos3Fecha  = '';
					$DetalleOtrosCargos4Fecha  = '';
					$DetalleOtrosCargos5Fecha  = '';
					
					//Consumo inicial
					if(isset($MedicionActual[$cliente['idCliente']]['Consumo'])&&isset($MedicionAnterior[$cliente['idCliente']]['Consumo'])){
						$ConsumoMes = valores_truncados($MedicionActual[$cliente['idCliente']]['Consumo']) - valores_truncados($MedicionAnterior[$cliente['idCliente']]['Consumo']);
					}else{
						$ConsumoMes = 0;
					}
					
					//Tipo de medicion para los remarcadores
					if(isset($MedicionActual[$cliente['idCliente']]['idTipoMedicion'])){
						switch ($MedicionActual[$cliente['idCliente']]['idTipoMedicion']) {
							//Calculo valor promedio
							case 1:
								$xcalc_1         = $MedicionActual[$cliente['idCliente']]['ConsumoMedidor'] - $MedicionActual[$cliente['idCliente']]['ConsumoGeneral'];
								$rem_modalidad   = 'Promedio';
								$rem_cantidad    = $xcalc_1 / $MedicionActual[$cliente['idCliente']]['CantRemarcadores'];
								$rem_porcentaje  = 100 / $MedicionActual[$cliente['idCliente']]['CantRemarcadores'];
								$rem_diferencia  = $xcalc_1;
							break;
							//calculo proporcional
							case 2:
								$xcalc_1           = $MedicionActual[$cliente['idCliente']]['ConsumoMedidor'] - $MedicionActual[$cliente['idCliente']]['ConsumoGeneral'];
								//se verifica que el consumo sea distinto de 0
								if($MedicionActual[$cliente['idCliente']]['ConsumoGeneral']!=0){   
									$xcalc_2 = valores_truncados(($ConsumoMes*100)/$MedicionActual[$cliente['idCliente']]['ConsumoGeneral']);
								}else{
									$xcalc_2 = 0;
								}	
								$rem_modalidad  = 'Con Reparto(Proporcional al consumo)';
								$rem_cantidad   = number_format((($xcalc_1*$xcalc_2) /100), 2) ;
								$rem_porcentaje = $xcalc_2;
								$rem_diferencia = $xcalc_1;
							break;
						}
					}else{
						$rem_modalidad  = '';
						$rem_cantidad   = 0;
						$rem_porcentaje = 0;
						$rem_diferencia = 0;
					}
						
					if(isset($MedicionActual[$cliente['idCliente']]['Consumo'])&&$MedicionActual[$cliente['idCliente']]['Consumo']!=0){ 
						$ConsumoMesActual = (valores_truncados($MedicionActual[$cliente['idCliente']]['Consumo'])- valores_truncados($MedicionAnterior[$cliente['idCliente']]['Consumo'])) + $rem_cantidad;  
					}else{
						$ConsumoMesActual = 0;
					}
					
					
					/* ************************************************** */
					/*                      Consumos                       */
					/* ************************************************** */
					//variables para sacar los totales
					$DetalleCargoFijoValor       = $rowSistema['valorCargoFijo']*1;
					$DetalleConsumoCantidad      = $ConsumoMesActual;
					$DetalleConsumoValor         = valores_truncados($rowSistema['valorAgua'] * $ConsumoMesActual);
					$DetalleRecoleccionCantidad  = $ConsumoMesActual;
					$DetalleRecoleccionValor     = valores_truncados($rowSistema['valorRecoleccion'] * $ConsumoMesActual);
							
					$subtotal = 0;
					$subtotal = $subtotal + $DetalleCargoFijoValor;
					$subtotal = $subtotal + $DetalleConsumoValor;
					$subtotal = $subtotal + $DetalleRecoleccionValor;
					
					/* ************************************************** */
					/*                      Eventos                       */
					/* ************************************************** */
					//visita corte
					if(isset($Eventos[$cliente['idCliente']][1]['idTipo'])){
						$DetalleVisitaCorte = $Eventos[$cliente['idCliente']][1]['ValorEvento'];
						$subtotal = $subtotal + $DetalleVisitaCorte; 
					}
					//corte 1
					if(isset($Eventos[$cliente['idCliente']][2]['idTipo'])){
						$DetalleCorte1Fecha = $Eventos[$cliente['idCliente']][2]['FechaEjecucion'];
						$DetalleCorte1Valor = $Eventos[$cliente['idCliente']][2]['ValorEvento']; 
						$subtotal = $subtotal + $DetalleCorte1Valor;
					}
					//corte 2
					if(isset($Eventos[$cliente['idCliente']][3]['idTipo'])){
						$DetalleCorte2Fecha = $Eventos[$cliente['idCliente']][3]['FechaEjecucion'];
						$DetalleCorte2Valor = $Eventos[$cliente['idCliente']][3]['ValorEvento'];
						$subtotal = $subtotal + $DetalleCorte2Valor; 
					}
					//reposicion 1
					if(isset($Eventos[$cliente['idCliente']][4]['idTipo'])){
						$DetalleReposicion1Fecha = $Eventos[$cliente['idCliente']][4]['FechaEjecucion'];
						$DetalleReposicion1Valor = $Eventos[$cliente['idCliente']][4]['ValorEvento'];
						$subtotal = $subtotal + $DetalleReposicion1Valor; 
					}
					//reposicion 2
					if(isset($Eventos[$cliente['idCliente']][5]['idTipo'])){
						$DetalleReposicion2Fecha = $Eventos[$cliente['idCliente']][5]['FechaEjecucion'];
						$DetalleReposicion2Valor = $Eventos[$cliente['idCliente']][5]['ValorEvento'];
						$subtotal = $subtotal + $DetalleReposicion2Valor; 
					}		
					$DetalleSubtotalServicio = $subtotal;
					
					
					/* ************************************************** */
					/*                     Intereses                      */
					/* ************************************************** */
					//en caso de que se calculen los intereses
					if(isset($idOpcionesInteres) && $idOpcionesInteres==1){
					
						//Se verifica si se ha pagado la facturacion anterior
						if(isset($cliente['FechaPagado'])&&$cliente['FechaPagado']!='0000-00-00'){ 
							//valido que el usuario este realmente atrasado
							if($cliente['FechaPagado'] > $cliente['FechaVencimiento']){
								//se calculan los dias entre la fecha de pago y la de vencimiento
								$ndiasdif1 = valores_truncados(dias_transcurridos($cliente['FechaPagado'],$cliente['FechaVencimiento']));
								$ndiasdif1 = $ndiasdif1 - 1;
								//si la resta queda inferior a 0
								if($ndiasdif1 < 0){ $ndiasdif1 = 0; }
							}else{
								$ndiasdif1 = 0;
							}
											
							//Se calculan los dias de diferencia entre cuando pago y la fecha actual de vencimiento
							$ndiasdif2 = valores_truncados(dias_transcurridos($Fecha,$cliente['FechaPagado']));
									
							//calculo los dias entre la facturacion actual y la anterior
							$ndiasdif3 = valores_truncados(dias_transcurridos($Fecha,$cliente['FechaVencimiento']));
							$ndiasdif3 = $ndiasdif3 - 1;
							//si la resta queda inferior a 0
							if($ndiasdif3 < 0){ $ndiasdif3 = 0; }
									
							//calculo la diferencia entre lo facturado y lo pagado
							$montoFinal = $cliente['MontoPagado'] - $cliente['MontoPactado'];
							//verifico si efectivamente el valor pagado fue inferior al facturado
							if($montoFinal < 0){ $montoFinal = -1 * $montoFinal; }else{ $montoFinal = 0; }
									
							//se calcula el interes entre la fecha de pago y la fecha pagada
							$interes1 = valores_truncados((($cliente['MontoPactado'] * $ndiasdif1 * $intAnual)/(360*100))*1.19);
									
							//Se calcula el interes del saldo en contra desde que se paga hasta que se factura
							$interes2 = valores_truncados((($montoFinal * $ndiasdif2 * $intAnual)/(360*100))*1.19);	
									
							//en caso de solo abonar se calcula el interes por la diferencia
							$saldo_ant = $cliente['MontoPactado'] - $cliente['MontoPagado'];
							if($saldo_ant > 0){
								$interes3 = valores_truncados((($saldo_ant * $ndiasdif3 * $intAnual)/(360*100))*1.19);
								$interes2 = 0;
								$xcalc1 = 1;
							}else{
								$xcalc1 = 1;
								//$interes3 = valores_truncados($saldo_ant);
								$saldofavor = valores_truncados($saldo_ant * -1);
							}		
									
						}	
						
						//se calcula saldo anterior	
						if(isset($cliente['SaldoAnterior'])&&$cliente['SaldoAnterior']!=''&&$cliente['SaldoAnterior']!=0&&$cliente['SaldoAnterior']>0){
							//calculo
							$difsaldoant = $cliente['SaldoAnterior'] - $cliente['MontoPagado'];
							//calculo de intereses
							if(isset($xcalc1)&&$xcalc1==0){
								//calculo los dias entre la facturacion actual y la anterior
								$ndiasdif = valores_truncados(dias_transcurridos($Fecha,$cliente['FechaVencimiento']));
								$ndiasdif = $ndiasdif - 1;
								//si la resta queda inferior a 0
								if($ndiasdif < 0){ $ndiasdif = 0; }
								$interes4 = valores_truncados((($difsaldoant * $ndiasdif * $intAnual)/(360*100))*1.19);
							}
						}
								
							
						//si existe un saldo en negativo
						if($cliente['MontoPactado']<0){
							$saldofavor = $saldofavor + valores_truncados($cliente['MontoPactado'] * -1);
						}
								
						$DetalleInteresDeuda = $interes1 + $interes2 + $interes3 + $interes4;
						$subtotal = $subtotal + $DetalleInteresDeuda; 
					
					//en caso de que no se calculen los intereses	
					}else{
						
						//se calcula saldo anterior	
						if(isset($cliente['SaldoAnterior'])&&$cliente['SaldoAnterior']!=''&&$cliente['SaldoAnterior']!=0&&$cliente['SaldoAnterior']>0){
							//calculo
							$difsaldoant = $cliente['SaldoAnterior'] - $cliente['MontoPagado'];
						}
								
						//si existe un saldo en negativo
						if($cliente['MontoPactado']<0){
							$saldofavor = $saldofavor + valores_truncados($cliente['MontoPactado'] * -1);
						}
						
						//se guardan los intereses
						$DetalleInteresDeuda = 0;
					}
					/* ************************************************** */
					/*                    Otros Cargos                    */
					/* ************************************************** */
					//Se calcula el valor de los otros cargos
					if(isset($OtrosCargos[$cliente['idCliente']][0]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][0]['Observacion']!=''){        $DetalleOtrosCargos1Texto = $OtrosCargos[$cliente['idCliente']][0]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][1]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][1]['Observacion']!=''){        $DetalleOtrosCargos2Texto = $OtrosCargos[$cliente['idCliente']][1]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][2]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][2]['Observacion']!=''){        $DetalleOtrosCargos3Texto = $OtrosCargos[$cliente['idCliente']][2]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][3]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][3]['Observacion']!=''){        $DetalleOtrosCargos4Texto = $OtrosCargos[$cliente['idCliente']][3]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][4]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][4]['Observacion']!=''){        $DetalleOtrosCargos5Texto = $OtrosCargos[$cliente['idCliente']][4]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][0]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][0]['ValorCargo']!=''){          $DetalleOtrosCargos1Valor = $OtrosCargos[$cliente['idCliente']][0]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][1]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][1]['ValorCargo']!=''){          $DetalleOtrosCargos2Valor = $OtrosCargos[$cliente['idCliente']][1]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][2]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][2]['ValorCargo']!=''){          $DetalleOtrosCargos3Valor = $OtrosCargos[$cliente['idCliente']][2]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][3]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][3]['ValorCargo']!=''){          $DetalleOtrosCargos4Valor = $OtrosCargos[$cliente['idCliente']][3]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][4]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][4]['ValorCargo']!=''){          $DetalleOtrosCargos5Valor = $OtrosCargos[$cliente['idCliente']][4]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][0]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][0]['FechaEjecucion']!=''){  $DetalleOtrosCargos1Fecha = $OtrosCargos[$cliente['idCliente']][0]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][1]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][1]['FechaEjecucion']!=''){  $DetalleOtrosCargos2Fecha = $OtrosCargos[$cliente['idCliente']][1]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][2]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][2]['FechaEjecucion']!=''){  $DetalleOtrosCargos3Fecha = $OtrosCargos[$cliente['idCliente']][2]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][3]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][3]['FechaEjecucion']!=''){  $DetalleOtrosCargos4Fecha = $OtrosCargos[$cliente['idCliente']][3]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][4]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][4]['FechaEjecucion']!=''){  $DetalleOtrosCargos5Fecha = $OtrosCargos[$cliente['idCliente']][4]['FechaEjecucion'];}
							
					$subtotal = $subtotal + $DetalleOtrosCargos1Valor; 
					$subtotal = $subtotal + $DetalleOtrosCargos2Valor; 
					$subtotal = $subtotal + $DetalleOtrosCargos3Valor; 
					$subtotal = $subtotal + $DetalleOtrosCargos4Valor; 
					$subtotal = $subtotal + $DetalleOtrosCargos5Valor; 
							
					/* ************************************************** */
					/*                       Totales                      */
					/* ************************************************** */
					//DetalleTotalVenta
					$DetalleTotalVenta = $subtotal;
					
					//DetalleSaldoFavor
					$subtotal = $subtotal - $saldofavor;
					$DetalleSaldoFavor = $saldofavor;
							
					//DetalleSaldoAnterior		
					if($difsaldoant > 0){ 
						$DetalleSaldoAnterior = $difsaldoant;
						$subtotal = $subtotal + $DetalleSaldoAnterior; 
					}else{
						$DetalleSaldoAnterior = 0;
					}
					
					/* ************************************************** */
					//DetalleTotalAPagar
					$DetalleTotalAPagar = $subtotal;
					
					
					
					/* ************************************************************************************************** */
					/*                                     Se guardan los datos temporales                                */
					/* ************************************************************************************************** */
					//Ingreso el nombre del cliente, verifico la razon social primero
					if(isset($cliente['RazonSocial']) && $cliente['RazonSocial'] != ''){
						$ClienteNombre = $cliente['RazonSocial']; 
					}else{
						if(isset($cliente['Nombre']) && $cliente['Nombre'] != ''){                  
							$ClienteNombre = $cliente['Nombre']; 
						}
					}
					//Se verifica el estado para esta facturacion
					if(isset($idOpcionesInteres) && $idOpcionesInteres==1){
						//se verifica si cliente ya tiene el suministro cortado
						if(isset($cliente['idEstadoPago'])&&$cliente['idEstadoPago']==3){
							$S_Estado = $Estados[3]['Nombre']; 
						//si no esta cortado se ejecuta normal
						}else{
							switch ($cliente['CuentaPendientes']) {
								case 0:   $S_Estado = $Estados[1]['Nombre']; break;
								case 1:   $S_Estado = $Estados[2]['Nombre']; break;
								case 2:   $S_Estado = $Estados[2]['Nombre']; break;//se impide que la facturacion cambie el estado de corte
								case 3:   $S_Estado = $Estados[2]['Nombre']; break;
								case 4:   $S_Estado = $Estados[2]['Nombre']; break;
								case 5:   $S_Estado = $Estados[2]['Nombre']; break;
								case 6:   $S_Estado = $Estados[2]['Nombre']; break;
								case 7:   $S_Estado = $Estados[2]['Nombre']; break;
								case 8:   $S_Estado = $Estados[2]['Nombre']; break;
								case 9:   $S_Estado = $Estados[2]['Nombre']; break;
								case 10:  $S_Estado = $Estados[2]['Nombre']; break;
								case 11:  $S_Estado = $Estados[2]['Nombre']; break;
								case 12:  $S_Estado = $Estados[2]['Nombre']; break;
							}
						}
						
					//en caso de que no se calculen los intereses	
					}else{
						//se verifica si cliente ya tiene el suministro cortado
						if(isset($cliente['idEstadoPago'])&&$cliente['idEstadoPago']==3){
							$S_Estado = $Estados[3]['Nombre'];
						//si no esta cortado se ejecuta normal
						}else{
							$S_Estado = $Estados[1]['Nombre'];
						}
					}
					
					//obtengo el signo del prorateo
					if($rem_cantidad>0){
						$rem_cantidad_signo = '(+)' ; 
					}else{
						$rem_cantidad_signo = '(-)' ;
					}
					//Tipo de medicion
					if(isset($MedicionActual[$cliente['idCliente']]['idTipoMedicion'])&&$MedicionActual[$cliente['idCliente']]['idTipoMedicion']!=0){
						$TipoMedicion = 'Remarcador';
					}else{ 	
						$TipoMedicion = 'Arranque individual';
					}
					//Numero Medidor
					if(isset($cliente['NombreMarcador'])&&$cliente['NombreMarcador']!=''){
						$NumeroMedidor = $cliente['NombreMarcador'];
					}else{
						$NumeroMedidor = $cliente['NombreMedidor'];
					}
					//seleccion del estado de pago
					if(isset($DetalleTotalAPagar) && $DetalleTotalAPagar != ''){  
						if($DetalleTotalAPagar <= 0){
							$EstadoPago = 2; //si es negativo, queda pagado
						}else{
							$EstadoPago = 1;
						}                  
					}else{
						$EstadoPago = 1;
					}		
					
					
					//Mes Diferencia
					if(isset($MedicionActual[$cliente['idCliente']]['Consumo'])&&isset($MedicionAnterior[$cliente['idCliente']]['Consumo'])){
						$MesDiferencia = valores_truncados(valores_truncados($MedicionActual[$cliente['idCliente']]['Consumo']) - valores_truncados($MedicionAnterior[$cliente['idCliente']]['Consumo']));
					}else{
						$MesDiferencia = 0;
					}
					
					/******************************************************************************/
					if(isset($cliente['idCliente'])){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idCliente']                       = $cliente['idCliente'];                                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idCliente']                   = '';}
					if(isset($ClienteNombre)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteNombre']                   = $ClienteNombre;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteNombre']               = '';}
					if(isset($cliente['Direccion'])){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteDireccion']                = $cliente['Direccion'];                                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteDireccion']            = '';}
					if(isset($cliente['Identificador'])){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteIdentificador']            = $cliente['Identificador'];                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteIdentificador']        = '';}
					if(isset($cliente['UnidadHabitacional'])){                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteUnidadHabitacional']       = $cliente['UnidadHabitacional'];                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteUnidadHabitacional']   = '';}
					if(isset($cliente['NombreComuna'])&&isset($cliente['NombreCiudad'])){       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteNombreComuna']             = $cliente['NombreComuna'].', '.$cliente['NombreCiudad'];                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteNombreComuna']         = '';}
					if(isset($cliente['Rut'])){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteRut']                      = $cliente['Rut'];                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteRut']                  = '';}
					if(isset($cliente['Giro'])){                                                $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteGiro']                     = $cliente['Giro'];                                                            }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteGiro']                 = '';}
					if(isset($cliente['Fono1'])){                                               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFono1']                    = $cliente['Fono1'];                                                           }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFono1']                = '';}
					if(isset($cliente['Fono2'])){                                               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFono2']                    = $cliente['Fono2'];                                                           }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFono2']                = '';}
					if(isset($Fecha)&&isset($rowSistema['NdiasPago'])){                         $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFechaVencimiento']         = sumarDias($Fecha,$rowSistema['NdiasPago']);                                  }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFechaVencimiento']     = '';}
					if(isset($S_Estado)){                                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteEstado']                   = $S_Estado;                                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteEstado']               = '';}
					if(isset($DetalleCargoFijoValor)){                                          $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCargoFijoValor']           = valores_truncados($DetalleCargoFijoValor);                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCargoFijoValor']       = '';}
					if(isset($DetalleConsumoCantidad)){                                         $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleConsumoCantidad']          = $DetalleConsumoCantidad;                                                     }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleConsumoCantidad']      = '';}
					if(isset($DetalleConsumoValor)){                                            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleConsumoValor']             = valores_truncados($DetalleConsumoValor);                                     }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleConsumoValor']         = '';}
					if(isset($DetalleRecoleccionCantidad)){                                     $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleRecoleccionCantidad']      = $DetalleRecoleccionCantidad;                                                 }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleRecoleccionCantidad']  = '';}
					if(isset($DetalleRecoleccionValor)){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleRecoleccionValor']         = valores_truncados($DetalleRecoleccionValor);                                 }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleRecoleccionValor']     = '';}
					if(isset($DetalleVisitaCorte)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleVisitaCorte']              = valores_truncados($DetalleVisitaCorte);                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleVisitaCorte']          = '';}
					if(isset($DetalleCorte1Valor)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte1Valor']              = valores_truncados($DetalleCorte1Valor);                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte1Valor']          = '';}
					if(isset($DetalleCorte1Fecha)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte1Fecha']              = $DetalleCorte1Fecha;                                                         }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte1Fecha']          = '';}
					if(isset($DetalleCorte2Valor)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte2Valor']              = valores_truncados($DetalleCorte2Valor);                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte2Valor']          = '';}
					if(isset($DetalleCorte2Fecha)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte2Fecha']              = $DetalleCorte2Fecha;                                                         }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleCorte2Fecha']          = '';}
					if(isset($DetalleReposicion1Valor)){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion1Valor']         = valores_truncados($DetalleReposicion1Valor);                                 }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion1Valor']     = '';}
					if(isset($DetalleReposicion1Fecha)){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion1Fecha']         = $DetalleReposicion1Fecha;                                                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion1Fecha']     = '';}
					if(isset($DetalleReposicion2Valor)){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion2Valor']         = valores_truncados($DetalleReposicion2Valor);                                 }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion2Valor']     = '';}
					if(isset($DetalleReposicion2Fecha)){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion2Fecha']         = $DetalleReposicion2Fecha;                                                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleReposicion2Fecha']     = '';}
					if(isset($DetalleSubtotalServicio)){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleSubtotalServicio']         = valores_truncados($DetalleSubtotalServicio);                                 }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleSubtotalServicio']     = '';}
					if(isset($DetalleInteresDeuda)){                                            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleInteresDeuda']             = valores_truncados($DetalleInteresDeuda);                                     }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleInteresDeuda']         = '';}
					if(isset($DetalleOtrosCargos1Texto)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos1Texto']        = $DetalleOtrosCargos1Texto;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos1Texto']    = '';}
					if(isset($DetalleOtrosCargos2Texto)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos2Texto']        = $DetalleOtrosCargos2Texto;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos2Texto']    = '';}
					if(isset($DetalleOtrosCargos3Texto)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos3Texto']        = $DetalleOtrosCargos3Texto;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos3Texto']    = '';}
					if(isset($DetalleOtrosCargos4Texto)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos4Texto']        = $DetalleOtrosCargos4Texto;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos4Texto']    = '';}
					if(isset($DetalleOtrosCargos5Texto)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos5Texto']        = $DetalleOtrosCargos5Texto;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos5Texto']    = '';}
					if(isset($DetalleOtrosCargos1Valor)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos1Valor']        = valores_truncados($DetalleOtrosCargos1Valor);                                }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos1Valor']    = '';}
					if(isset($DetalleOtrosCargos2Valor)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos2Valor']        = valores_truncados($DetalleOtrosCargos2Valor);                                }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos2Valor']    = '';}
					if(isset($DetalleOtrosCargos3Valor)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos3Valor']        = valores_truncados($DetalleOtrosCargos3Valor);                                }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos3Valor']    = '';}
					if(isset($DetalleOtrosCargos4Valor)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos4Valor']        = valores_truncados($DetalleOtrosCargos4Valor);                                }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos4Valor']    = '';}
					if(isset($DetalleOtrosCargos5Valor)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos5Valor']        = valores_truncados($DetalleOtrosCargos5Valor);                                }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos5Valor']    = '';}
					if(isset($DetalleOtrosCargos1Fecha)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos1Fecha']        = $DetalleOtrosCargos1Fecha;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos1Fecha']    = '';}
					if(isset($DetalleOtrosCargos2Fecha)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos2Fecha']        = $DetalleOtrosCargos2Fecha;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos2Fecha']    = '';}
					if(isset($DetalleOtrosCargos3Fecha)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos3Fecha']        = $DetalleOtrosCargos3Fecha;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos3Fecha']    = '';}
					if(isset($DetalleOtrosCargos4Fecha)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos4Fecha']        = $DetalleOtrosCargos4Fecha;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos4Fecha']    = '';}
					if(isset($DetalleOtrosCargos5Fecha)){                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos5Fecha']        = $DetalleOtrosCargos5Fecha;                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleOtrosCargos5Fecha']    = '';}
					if(isset($DetalleTotalVenta)){                                              $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleTotalVenta']               = valores_truncados($DetalleTotalVenta);                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleTotalVenta']           = '';}
					if(isset($DetalleSaldoFavor)){                                              $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleSaldoFavor']               = valores_truncados($DetalleSaldoFavor);                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleSaldoFavor']           = '';}
					if(isset($DetalleSaldoAnterior)){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleSaldoAnterior']            = valores_truncados($DetalleSaldoAnterior);                                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleSaldoAnterior']        = '';}
					if(isset($DetalleTotalAPagar)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleTotalAPagar']              = valores_truncados($DetalleTotalAPagar);                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetalleTotalAPagar']          = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes1Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes1Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes1Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes1Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes2Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes2Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes2Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes2Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes3Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes3Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes3Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes3Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes4Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes4Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes4Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes4Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes5Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes5Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes5Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes5Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes6Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes6Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes6Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes6Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes7Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes7Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes7Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes7Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes8Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes8Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes8Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes8Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes9Valor'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes9Valor']                = $Graficos[$cliente['idCliente']]['GraficoMes9Valor'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes9Valor']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes10Valor'])){           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes10Valor']               = $Graficos[$cliente['idCliente']]['GraficoMes10Valor'];                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes10Valor']           = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes11Valor'])){           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes11Valor']               = $Graficos[$cliente['idCliente']]['GraficoMes11Valor'];                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes11Valor']           = '';}
					if(isset($DetalleConsumoCantidad)){                                         $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes12Valor']               = $DetalleConsumoCantidad;                                                     }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes12Valor']           = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes1Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes1Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes1Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes1Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes2Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes2Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes2Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes2Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes3Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes3Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes3Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes3Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes4Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes4Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes4Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes4Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes5Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes5Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes5Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes5Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes6Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes6Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes6Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes6Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes7Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes7Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes7Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes7Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes8Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes8Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes8Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes8Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes9Fecha'])){            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes9Fecha']                = $Graficos[$cliente['idCliente']]['GraficoMes9Fecha'];                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes9Fecha']            = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes10Fecha'])){           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes10Fecha']               = $Graficos[$cliente['idCliente']]['GraficoMes10Fecha'];                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes10Fecha']           = '';}
					if(isset($Graficos[$cliente['idCliente']]['GraficoMes11Fecha'])){           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes11Fecha']               = $Graficos[$cliente['idCliente']]['GraficoMes11Fecha'];                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes11Fecha']           = '';}
					if(isset($idMes)){                                                          $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes12Fecha']               = numero_a_mes_c($idMes);                                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes12Fecha']           = '';}
					if(isset($MedicionAnterior[$cliente['idCliente']]['Consumo'])){             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorCantidad']      = valores_truncados($MedicionAnterior[$cliente['idCliente']]['Consumo']);      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorCantidad']  = '';}
					if(isset($MedicionAnterior[$cliente['idCliente']]['Fecha'])){               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorFecha']         = $MedicionAnterior[$cliente['idCliente']]['Fecha'];                           }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorFecha']     = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['Consumo'])){               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualCantidad']        = valores_truncados($MedicionActual[$cliente['idCliente']]['Consumo']);        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualCantidad']    = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['Fecha'])){                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualFecha']           = $MedicionActual[$cliente['idCliente']]['Fecha'];                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualFecha']       = '';}
					if(isset($MesDiferencia)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesDiferencia']            = $MesDiferencia;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesDiferencia']        = '';}   
					if(isset($rem_cantidad)){                                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateo']                 = $rem_cantidad;                                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateo']             = '';}
					if(isset($rem_cantidad_signo)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateoSigno']            = $rem_cantidad_signo;                                                         }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateoSigno']        = '';}
					if(isset($DetalleConsumoCantidad)){                                         $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesTotalCantidad']         = $DetalleConsumoCantidad;                                                     }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesTotalCantidad']     = '';}
					if(isset($AnoProximo)&&isset($idMesProximo)){                               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFechaProxLectura']         = $AnoProximo.'-'.numero_mes1($idMesProximo).'-01';                            }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFechaProxLectura']     = '';}
					if(isset($rem_modalidad)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsModalidad']                = $rem_modalidad;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsModalidad']            = '';}
					if(isset($rowSistema['Fac_nEmergencia'])){                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoEmergencias']          = $rowSistema['Fac_nEmergencia'];                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoEmergencias']      = '';}
					if(isset($rowSistema['Fac_nConsultas'])){                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoConsultas']            = $rowSistema['Fac_nConsultas'];                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoConsultas']        = '';}
					if(isset($rowSistema['valorCargoFijo'])){                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCargoFijo']               = valores_truncados($rowSistema['valorCargoFijo']);                            }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCargoFijo']           = '';}
					if(isset($rowSistema['valorAgua'])){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroAgua']               = $rowSistema['valorAgua'];                                                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroAgua']           = '';}
					if(isset($rowSistema['valorRecoleccion'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroRecolecion']         = $rowSistema['valorRecoleccion'];                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroRecolecion']     = '';}
					if(isset($rowSistema['valorVisitaCorte'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfVisitaCorte']             = valores_truncados($rowSistema['valorVisitaCorte']);                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfVisitaCorte']         = '';}
					if(isset($rowSistema['valorCorte1'])){                                      $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte1']                  = valores_truncados($rowSistema['valorCorte1']);                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte1']              = '';}
					if(isset($rowSistema['valorCorte2'])){                                      $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte2']                  = valores_truncados($rowSistema['valorCorte2']);                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte2']              = '';}
					if(isset($rowSistema['valorReposicion1'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion1']             = valores_truncados($rowSistema['valorReposicion1']);                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion1']         = '';}
					if(isset($rowSistema['valorReposicion2'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion2']             = valores_truncados($rowSistema['valorReposicion2']);                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion2']         = '';}
					if(isset($rem_diferencia)){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfDifMedGeneral']           = $rem_diferencia;                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfDifMedGeneral']       = '';}
					if(isset($rem_porcentaje)){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfProcProrrateo']           = $rem_porcentaje;                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfProcProrrateo']       = '';}
					if(isset($TipoMedicion)){                                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfTipoMedicion']            = $TipoMedicion;                                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfTipoMedicion']        = '';}
					if(isset($cliente['Arranque'])){                                            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfPuntoDiametro']           = $cliente['Arranque'];                                                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfPuntoDiametro']       = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['TipoFacturacion'])){       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveFacturacion']        = $MedicionActual[$cliente['idCliente']]['TipoFacturacion'];                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveFacturacion']    = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['TipoLectura'])){           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveLectura']            = $MedicionActual[$cliente['idCliente']]['TipoLectura'];                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveLectura']        = '';}
					if(isset($NumeroMedidor)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfNumeroMedidor']           = $NumeroMedidor;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfNumeroMedidor']       = '';}
					if(isset($Fecha)){                                                          $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfFechaEmision']            = $Fecha;                                                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfFechaEmision']        = '';}
					if(isset($cliente['PagoFecha'])){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoFecha']         = $cliente['PagoFecha'];                                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoFecha']     = '';}
					if(isset($cliente['PagoMonto'])){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoMonto']         = $cliente['PagoMonto'];                                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoMonto']     = '';}
					if(isset($Ano)&&isset($idMes)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMovimientosHasta']        = $Ano.'-'.numero_mes1($idMes).'-09';                                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMovimientosHasta']    = '';}
					if(isset($EstadoPago)){                                                     $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idEstado']                        = $EstadoPago;                                                                 }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idEstado']                    = '';}
					if(isset($intAnual)){                                                       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['intAnual']                        = $intAnual;                                                                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['intAnual']                    = '';}
					if(isset($rem_cantidad)){                                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_cantidad']                    = $rem_cantidad;                                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_cantidad']                = '';}
					if(isset($rem_porcentaje)){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_porcentaje']                  = $rem_porcentaje;                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_porcentaje']              = '';}
					if(isset($rem_modalidad)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_modalidad']                   = $rem_modalidad;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_modalidad']               = '';}
					if(isset($rem_diferencia)){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_diferencia']                  = $rem_diferencia;                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_diferencia']              = '';}
					if(isset($cliente['idFacturable'])){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['SII_idFacturable']                = $cliente['idFacturable'];                                                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['SII_idFacturable']            = '';}
					if(isset($cliente['idFacturable'])){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DocFacturable']                   = $DocFacturable[$cliente['idFacturable']]['Nombre'];                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DocFacturable']               = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['idTipoMedicion'])){        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idTipoMedicion']                  = $MedicionActual[$cliente['idCliente']]['idTipoMedicion'];                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idTipoMedicion']              = '';}
					if(isset($cliente['DetMesActualidDatosDetalle'])){                          $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetMesActualidDatosDetalle']      = $cliente['DetMesActualidDatosDetalle'];                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetMesActualidDatosDetalle']  = '';}
					
					
					
					
					
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfFactorCobro']    = 1;
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idTipoPago']             = 0;
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['nDocPago']               = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['fechaPago']              = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DiaPago']                = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idMesPago']              = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AnoPago']                = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['montoPago']              = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idUsuarioPago']          = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['idPago']                 = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['rem_negative']           = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['SII_NDoc']               = '';
					$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['NombreArchivo']          = '';
					
							
				}
				
				
				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;
			}
		
		break;
/*******************************************************************************************************************/		
		case 'clear_all':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['Facturacion_basicos']);
			unset($_SESSION['Facturacion_clientes']);
			
			header( 'Location: '.$location );
			die;

		break;

/*******************************************************************************************************************/		
		case 'ing_Facturacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Datos basicos
			if (isset($_SESSION['Facturacion_basicos'])){
				if(!isset($_SESSION['Facturacion_basicos']['idSistema']) OR $_SESSION['Facturacion_basicos']['idSistema']=='' ){                   $error['idSistema']          = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['Facturacion_basicos']['idUsuario']) OR $_SESSION['Facturacion_basicos']['idUsuario']=='' ){                   $error['idUsuario']          = 'error/No ha ingresado el usuario';}
				if(!isset($_SESSION['Facturacion_basicos']['Fecha']) OR $_SESSION['Facturacion_basicos']['Fecha']=='' ){                           $error['Fecha']              = 'error/No ha ingresado la fecha';}
				if(!isset($_SESSION['Facturacion_basicos']['fCreacion']) OR $_SESSION['Facturacion_basicos']['fCreacion']=='' ){                   $error['fCreacion']          = 'error/No ha ingresado el nombre';}
				if(!isset($_SESSION['Facturacion_basicos']['intAnual']) OR $_SESSION['Facturacion_basicos']['intAnual']=='' ){                     $error['intAnual']           = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['Facturacion_basicos']['idOpcionesInteres']) OR $_SESSION['Facturacion_basicos']['idOpcionesInteres']=='' ){   $error['idOpcionesInteres']  = 'error/No ha seleccionado el Tipo Medicion';}
				
			}else{
				$error['Facturacion_basicos'] = 'error/No tiene datos basicos asignados al documento';
			}	
			//clientes
			if (isset($_SESSION['Facturacion_clientes'])){
				foreach ($_SESSION['Facturacion_clientes'] as $key => $clientes){ 
					if(!isset($clientes['idCliente']) OR $clientes['idCliente'] == ''){                                    $error['idCliente']  = 'error/No ha seleccionado un cliente';}
					if(!isset($clientes['DetMesActualidDatosDetalle']) OR $clientes['DetMesActualidDatosDetalle'] == ''){  $error['idCliente']  = 'error/Uno de los clientes no tiene una facturacion de este mes';}
				}
			}else{
				$error['clientes'] = 'error/No tiene clientes relacionados en el documento';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se traspasan las variables
				
				$idSistema          = $_SESSION['Facturacion_basicos']['idSistema'];
				$idUsuario          = $_SESSION['Facturacion_basicos']['idUsuario'];
				$Fecha              = $_SESSION['Facturacion_basicos']['Fecha'];
				$Dia                = $_SESSION['Facturacion_basicos']['Dia'];
				$idMes              = $_SESSION['Facturacion_basicos']['idMes'];
				$Ano                = $_SESSION['Facturacion_basicos']['Ano'];
				$Observaciones      = $_SESSION['Facturacion_basicos']['Observaciones'];
				$fCreacion          = $_SESSION['Facturacion_basicos']['fCreacion'];
				$intAnual           = $_SESSION['Facturacion_basicos']['intAnual'];
				$idOpcionesInteres  = $_SESSION['Facturacion_basicos']['idOpcionesInteres'];
				
				
				//Creo el registro en la tabla madre
				if(isset($idSistema) && $idSistema != ''){                   $a  = "'".$idSistema."'";           }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){                   $a .= ",'".$idUsuario."'";          }else{$a .=",''";}
				if(isset($Fecha) && $Fecha != ''){                           $a .= ",'".$Fecha."'";              }else{$a .=",''";}
				if(isset($Dia) && $Dia != ''){                               $a .= ",'".$Dia."'";                }else{$a .=",''";}
				if(isset($idMes) && $idMes != ''){                           $a .= ",'".$idMes."'";              }else{$a .=",''";}
				if(isset($Ano) && $Ano != ''){                               $a .= ",'".$Ano."'";                }else{$a .=",''";}
				if(isset($Observaciones) && $Observaciones != ''){           $a .= ",'".$Observaciones."'";      }else{$a .=",''";}
				if(isset($fCreacion) && $fCreacion != ''){                   $a .= ",'".$fCreacion."'";          }else{$a .=",''";}
				if(isset($intAnual) && $intAnual != ''){                     $a .= ",'".$intAnual."'";           }else{$a .=",''";}
				if(isset($idOpcionesInteres) && $idOpcionesInteres != ''){   $a .= ",'".$idOpcionesInteres."'";  }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `facturacion_listado` (idSistema, idUsuario, Fecha, Dia, idMes, 
				Ano, Observaciones, fCreacion, intAnual, idOpcionesInteres) 
				VALUES (".$a.")";
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
					
				}else{
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					if (isset($_SESSION['Facturacion_clientes'])){
						
						//contador
						$Cuenta_correcto = 0;
						
						//Ejecuto el resto del codigo
						foreach ($_SESSION['Facturacion_clientes'] as $key => $client){	
						
							if(isset($idSistema) && $idSistema != ''){                                                           $a  = "'".$idSistema."'";                               }else{$a  ="''";}
							if(isset($idUsuario) && $idUsuario != ''){                                                           $a .= ",'".$idUsuario."'";                              }else{$a .=",''";}
							$a .= ",'".$ultimo_id."'";       
							if(isset($Fecha) && $Fecha != ''){                                                                   $a .= ",'".$Fecha."'";                                  }else{$a .=",''";}
							if(isset($Dia) && $Dia != ''){                                                                       $a .= ",'".$Dia."'";                                    }else{$a .=",''";}
							if(isset($idMes) && $idMes != ''){                                                                   $a .= ",'".$idMes."'";                                  }else{$a .=",''";}
							if(isset($Ano) && $Ano != ''){                                                                       $a .= ",'".$Ano."'";                                    }else{$a .=",''";}
							if(isset($client['idCliente']) && $client['idCliente'] != ''){                                       $a .= ",'".$client['idCliente']."'";                    }else{$a .=",''";}
							if(isset($client['ClienteNombre']) && $client['ClienteNombre'] != ''){                               $a .= ",'".$client['ClienteNombre']."'";                }else{$a .=",''";}
							if(isset($client['ClienteDireccion']) && $client['ClienteDireccion'] != ''){                         $a .= ",'".$client['ClienteDireccion']."'";             }else{$a .=",''";}
							if(isset($client['ClienteIdentificador']) && $client['ClienteIdentificador'] != ''){                 $a .= ",'".$client['ClienteIdentificador']."'";         }else{$a .=",''";}
							if(isset($client['ClienteNombreComuna']) && $client['ClienteNombreComuna'] != ''){                   $a .= ",'".$client['ClienteNombreComuna']."'";          }else{$a .=",''";}
							if(isset($client['ClienteFechaVencimiento']) && $client['ClienteFechaVencimiento'] != ''){           $a .= ",'".$client['ClienteFechaVencimiento']."'";      }else{$a .=",''";}
							if(isset($client['ClienteEstado']) && $client['ClienteEstado'] != ''){                               $a .= ",'".$client['ClienteEstado']."'";                }else{$a .=",''";}
							if(isset($client['DetalleCargoFijoValor']) && $client['DetalleCargoFijoValor'] != ''){               $a .= ",'".$client['DetalleCargoFijoValor']."'";        }else{$a .=",''";}
							if(isset($client['DetalleConsumoCantidad']) && $client['DetalleConsumoCantidad'] != ''){             $a .= ",'".$client['DetalleConsumoCantidad']."'";       }else{$a .=",''";}
							if(isset($client['DetalleConsumoValor']) && $client['DetalleConsumoValor'] != ''){                   $a .= ",'".$client['DetalleConsumoValor']."'";          }else{$a .=",''";}
							if(isset($client['DetalleRecoleccionCantidad']) && $client['DetalleRecoleccionCantidad'] != ''){     $a .= ",'".$client['DetalleRecoleccionCantidad']."'";   }else{$a .=",''";}
							if(isset($client['DetalleRecoleccionValor']) && $client['DetalleRecoleccionValor'] != ''){           $a .= ",'".$client['DetalleRecoleccionValor']."'";      }else{$a .=",''";}
							if(isset($client['DetalleVisitaCorte']) && $client['DetalleVisitaCorte'] != ''){                     $a .= ",'".$client['DetalleVisitaCorte']."'";           }else{$a .=",''";}
							if(isset($client['DetalleCorte1Valor']) && $client['DetalleCorte1Valor'] != ''){                     $a .= ",'".$client['DetalleCorte1Valor']."'";           }else{$a .=",''";}
							if(isset($client['DetalleCorte1Fecha']) && $client['DetalleCorte1Fecha'] != ''){                     $a .= ",'".$client['DetalleCorte1Fecha']."'";           }else{$a .=",''";}
							if(isset($client['DetalleCorte2Valor']) && $client['DetalleCorte2Valor'] != ''){                     $a .= ",'".$client['DetalleCorte2Valor']."'";           }else{$a .=",''";}
							if(isset($client['DetalleCorte2Fecha']) && $client['DetalleCorte2Fecha'] != ''){                     $a .= ",'".$client['DetalleCorte2Fecha']."'";           }else{$a .=",''";}
							if(isset($client['DetalleReposicion1Valor']) && $client['DetalleReposicion1Valor'] != ''){           $a .= ",'".$client['DetalleReposicion1Valor']."'";      }else{$a .=",''";}
							if(isset($client['DetalleReposicion1Fecha']) && $client['DetalleReposicion1Fecha'] != ''){           $a .= ",'".$client['DetalleReposicion1Fecha']."'";      }else{$a .=",''";}
							if(isset($client['DetalleReposicion2Valor']) && $client['DetalleReposicion2Valor'] != ''){           $a .= ",'".$client['DetalleReposicion2Valor']."'";      }else{$a .=",''";}
							if(isset($client['DetalleReposicion2Fecha']) && $client['DetalleReposicion2Fecha'] != ''){           $a .= ",'".$client['DetalleReposicion2Fecha']."'";      }else{$a .=",''";}
							if(isset($client['DetalleSubtotalServicio']) && $client['DetalleSubtotalServicio'] != ''){           $a .= ",'".$client['DetalleSubtotalServicio']."'";      }else{$a .=",''";}
							if(isset($client['DetalleInteresDeuda']) && $client['DetalleInteresDeuda'] != ''){                   $a .= ",'".$client['DetalleInteresDeuda']."'";          }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos1Texto']) && $client['DetalleOtrosCargos1Texto'] != ''){         $a .= ",'".$client['DetalleOtrosCargos1Texto']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos2Texto']) && $client['DetalleOtrosCargos2Texto'] != ''){         $a .= ",'".$client['DetalleOtrosCargos2Texto']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos3Texto']) && $client['DetalleOtrosCargos3Texto'] != ''){         $a .= ",'".$client['DetalleOtrosCargos3Texto']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos4Texto']) && $client['DetalleOtrosCargos4Texto'] != ''){         $a .= ",'".$client['DetalleOtrosCargos4Texto']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos5Texto']) && $client['DetalleOtrosCargos5Texto'] != ''){         $a .= ",'".$client['DetalleOtrosCargos5Texto']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos1Valor']) && $client['DetalleOtrosCargos1Valor'] != ''){         $a .= ",'".$client['DetalleOtrosCargos1Valor']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos2Valor']) && $client['DetalleOtrosCargos2Valor'] != ''){         $a .= ",'".$client['DetalleOtrosCargos2Valor']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos3Valor']) && $client['DetalleOtrosCargos3Valor'] != ''){         $a .= ",'".$client['DetalleOtrosCargos3Valor']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos4Valor']) && $client['DetalleOtrosCargos4Valor'] != ''){         $a .= ",'".$client['DetalleOtrosCargos4Valor']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos5Valor']) && $client['DetalleOtrosCargos5Valor'] != ''){         $a .= ",'".$client['DetalleOtrosCargos5Valor']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos1Fecha']) && $client['DetalleOtrosCargos1Fecha'] != ''){         $a .= ",'".$client['DetalleOtrosCargos1Fecha']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos2Fecha']) && $client['DetalleOtrosCargos2Fecha'] != ''){         $a .= ",'".$client['DetalleOtrosCargos2Fecha']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos3Fecha']) && $client['DetalleOtrosCargos3Fecha'] != ''){         $a .= ",'".$client['DetalleOtrosCargos3Fecha']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos4Fecha']) && $client['DetalleOtrosCargos4Fecha'] != ''){         $a .= ",'".$client['DetalleOtrosCargos4Fecha']."'";     }else{$a .=",''";}
							if(isset($client['DetalleOtrosCargos5Fecha']) && $client['DetalleOtrosCargos5Fecha'] != ''){         $a .= ",'".$client['DetalleOtrosCargos5Fecha']."'";     }else{$a .=",''";}
							if(isset($client['DetalleTotalVenta']) && $client['DetalleTotalVenta'] != ''){                       $a .= ",'".$client['DetalleTotalVenta']."'";            }else{$a .=",''";}
							if(isset($client['DetalleSaldoFavor']) && $client['DetalleSaldoFavor'] != ''){                       $a .= ",'".$client['DetalleSaldoFavor']."'";            }else{$a .=",''";}
							if(isset($client['DetalleSaldoAnterior']) && $client['DetalleSaldoAnterior'] != ''){                 $a .= ",'".$client['DetalleSaldoAnterior']."'";         }else{$a .=",''";}
							if(isset($client['DetalleTotalAPagar']) && $client['DetalleTotalAPagar'] != ''){                     $a .= ",'".$client['DetalleTotalAPagar']."'";           }else{$a .=",''";}
							if(isset($client['GraficoMes1Valor']) && $client['GraficoMes1Valor'] != ''){                         $a .= ",'".$client['GraficoMes1Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes2Valor']) && $client['GraficoMes2Valor'] != ''){                         $a .= ",'".$client['GraficoMes2Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes3Valor']) && $client['GraficoMes3Valor'] != ''){                         $a .= ",'".$client['GraficoMes3Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes4Valor']) && $client['GraficoMes4Valor'] != ''){                         $a .= ",'".$client['GraficoMes4Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes5Valor']) && $client['GraficoMes5Valor'] != ''){                         $a .= ",'".$client['GraficoMes5Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes6Valor']) && $client['GraficoMes6Valor'] != ''){                         $a .= ",'".$client['GraficoMes6Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes7Valor']) && $client['GraficoMes7Valor'] != ''){                         $a .= ",'".$client['GraficoMes7Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes8Valor']) && $client['GraficoMes8Valor'] != ''){                         $a .= ",'".$client['GraficoMes8Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes9Valor']) && $client['GraficoMes9Valor'] != ''){                         $a .= ",'".$client['GraficoMes9Valor']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes10Valor']) && $client['GraficoMes10Valor'] != ''){                       $a .= ",'".$client['GraficoMes10Valor']."'";            }else{$a .=",''";}
							if(isset($client['GraficoMes11Valor']) && $client['GraficoMes11Valor'] != ''){                       $a .= ",'".$client['GraficoMes11Valor']."'";            }else{$a .=",''";}
							if(isset($client['GraficoMes12Valor']) && $client['GraficoMes12Valor'] != ''){                       $a .= ",'".$client['GraficoMes12Valor']."'";            }else{$a .=",''";}
							if(isset($client['GraficoMes1Fecha']) && $client['GraficoMes1Fecha'] != ''){                         $a .= ",'".$client['GraficoMes1Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes2Fecha']) && $client['GraficoMes2Fecha'] != ''){                         $a .= ",'".$client['GraficoMes2Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes3Fecha']) && $client['GraficoMes3Fecha'] != ''){                         $a .= ",'".$client['GraficoMes3Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes4Fecha']) && $client['GraficoMes4Fecha'] != ''){                         $a .= ",'".$client['GraficoMes4Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes5Fecha']) && $client['GraficoMes5Fecha'] != ''){                         $a .= ",'".$client['GraficoMes5Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes6Fecha']) && $client['GraficoMes6Fecha'] != ''){                         $a .= ",'".$client['GraficoMes6Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes7Fecha']) && $client['GraficoMes7Fecha'] != ''){                         $a .= ",'".$client['GraficoMes7Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes8Fecha']) && $client['GraficoMes8Fecha'] != ''){                         $a .= ",'".$client['GraficoMes8Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes9Fecha']) && $client['GraficoMes9Fecha'] != ''){                         $a .= ",'".$client['GraficoMes9Fecha']."'";             }else{$a .=",''";}
							if(isset($client['GraficoMes10Fecha']) && $client['GraficoMes10Fecha'] != ''){                       $a .= ",'".$client['GraficoMes10Fecha']."'";            }else{$a .=",''";}
							if(isset($client['GraficoMes11Fecha']) && $client['GraficoMes11Fecha'] != ''){                       $a .= ",'".$client['GraficoMes11Fecha']."'";            }else{$a .=",''";}
							if(isset($client['GraficoMes12Fecha']) && $client['GraficoMes12Fecha'] != ''){                       $a .= ",'".$client['GraficoMes12Fecha']."'";            }else{$a .=",''";}
							if(isset($client['DetConsMesAnteriorCantidad']) && $client['DetConsMesAnteriorCantidad'] != ''){     $a .= ",'".$client['DetConsMesAnteriorCantidad']."'";   }else{$a .=",''";}
							if(isset($client['DetConsMesAnteriorFecha']) && $client['DetConsMesAnteriorFecha'] != ''){           $a .= ",'".$client['DetConsMesAnteriorFecha']."'";      }else{$a .=",''";}
							if(isset($client['DetConsMesActualCantidad']) && $client['DetConsMesActualCantidad'] != ''){         $a .= ",'".$client['DetConsMesActualCantidad']."'";     }else{$a .=",''";}
							if(isset($client['DetConsMesActualFecha']) && $client['DetConsMesActualFecha'] != ''){               $a .= ",'".$client['DetConsMesActualFecha']."'";        }else{$a .=",''";}
							if(isset($client['DetConsMesDiferencia']) && $client['DetConsMesDiferencia'] != ''){                 $a .= ",'".$client['DetConsMesDiferencia']."'";         }else{$a .=",''";}
							if(isset($client['DetConsProrateo']) && $client['DetConsProrateo'] != ''){                           $a .= ",'".$client['DetConsProrateo']."'";              }else{$a .=",''";}
							if(isset($client['DetConsProrateoSigno']) && $client['DetConsProrateoSigno'] != ''){                 $a .= ",'".$client['DetConsProrateoSigno']."'";         }else{$a .=",''";}
							if(isset($client['DetConsMesTotalCantidad']) && $client['DetConsMesTotalCantidad'] != ''){           $a .= ",'".$client['DetConsMesTotalCantidad']."'";      }else{$a .=",''";}
							if(isset($client['DetConsFechaProxLectura']) && $client['DetConsFechaProxLectura'] != ''){           $a .= ",'".$client['DetConsFechaProxLectura']."'";      }else{$a .=",''";}
							if(isset($client['DetConsModalidad']) && $client['DetConsModalidad'] != ''){                         $a .= ",'".$client['DetConsModalidad']."'";             }else{$a .=",''";}
							if(isset($client['DetConsFonoEmergencias']) && $client['DetConsFonoEmergencias'] != ''){             $a .= ",'".$client['DetConsFonoEmergencias']."'";       }else{$a .=",''";}
							if(isset($client['DetConsFonoConsultas']) && $client['DetConsFonoConsultas'] != ''){                 $a .= ",'".$client['DetConsFonoConsultas']."'";         }else{$a .=",''";}
							if(isset($client['AguasInfCargoFijo']) && $client['AguasInfCargoFijo'] != ''){                       $a .= ",'".$client['AguasInfCargoFijo']."'";            }else{$a .=",''";}
							if(isset($client['AguasInfMetroAgua']) && $client['AguasInfMetroAgua'] != ''){                       $a .= ",'".$client['AguasInfMetroAgua']."'";            }else{$a .=",''";}
							if(isset($client['AguasInfMetroRecolecion']) && $client['AguasInfMetroRecolecion'] != ''){           $a .= ",'".$client['AguasInfMetroRecolecion']."'";      }else{$a .=",''";}
							if(isset($client['AguasInfVisitaCorte']) && $client['AguasInfVisitaCorte'] != ''){                   $a .= ",'".$client['AguasInfVisitaCorte']."'";          }else{$a .=",''";}
							if(isset($client['AguasInfCorte1']) && $client['AguasInfCorte1'] != ''){                             $a .= ",'".$client['AguasInfCorte1']."'";               }else{$a .=",''";}
							if(isset($client['AguasInfCorte2']) && $client['AguasInfCorte2'] != ''){                             $a .= ",'".$client['AguasInfCorte2']."'";               }else{$a .=",''";}
							if(isset($client['AguasInfReposicion1']) && $client['AguasInfReposicion1'] != ''){                   $a .= ",'".$client['AguasInfReposicion1']."'";          }else{$a .=",''";}
							if(isset($client['AguasInfReposicion2']) && $client['AguasInfReposicion2'] != ''){                   $a .= ",'".$client['AguasInfReposicion2']."'";          }else{$a .=",''";}
							if(isset($client['AguasInfFactorCobro']) && $client['AguasInfFactorCobro'] != ''){                   $a .= ",'".$client['AguasInfFactorCobro']."'";          }else{$a .=",''";}
							if(isset($client['AguasInfDifMedGeneral']) && $client['AguasInfDifMedGeneral'] != ''){               $a .= ",'".$client['AguasInfDifMedGeneral']."'";        }else{$a .=",''";}
							if(isset($client['AguasInfProcProrrateo']) && $client['AguasInfProcProrrateo'] != ''){               $a .= ",'".$client['AguasInfProcProrrateo']."'";        }else{$a .=",''";}
							if(isset($client['AguasInfTipoMedicion']) && $client['AguasInfTipoMedicion'] != ''){                 $a .= ",'".$client['AguasInfTipoMedicion']."'";         }else{$a .=",''";}
							if(isset($client['AguasInfPuntoDiametro']) && $client['AguasInfPuntoDiametro'] != ''){               $a .= ",'".$client['AguasInfPuntoDiametro']."'";        }else{$a .=",''";}
							if(isset($client['AguasInfClaveFacturacion']) && $client['AguasInfClaveFacturacion'] != ''){         $a .= ",'".$client['AguasInfClaveFacturacion']."'";     }else{$a .=",''";}
							if(isset($client['AguasInfClaveLectura']) && $client['AguasInfClaveLectura'] != ''){                 $a .= ",'".$client['AguasInfClaveLectura']."'";         }else{$a .=",''";}
							if(isset($client['AguasInfNumeroMedidor']) && $client['AguasInfNumeroMedidor'] != ''){               $a .= ",'".$client['AguasInfNumeroMedidor']."'";        }else{$a .=",''";}
							if(isset($client['AguasInfFechaEmision']) && $client['AguasInfFechaEmision'] != ''){                 $a .= ",'".$client['AguasInfFechaEmision']."'";         }else{$a .=",''";}
							if(isset($client['AguasInfUltimoPagoFecha']) && $client['AguasInfUltimoPagoFecha'] != ''){           $a .= ",'".$client['AguasInfUltimoPagoFecha']."'";      }else{$a .=",''";}
							if(isset($client['AguasInfUltimoPagoMonto']) && $client['AguasInfUltimoPagoMonto'] != ''){           $a .= ",'".$client['AguasInfUltimoPagoMonto']."'";      }else{$a .=",''";}
							if(isset($client['AguasInfMovimientosHasta']) && $client['AguasInfMovimientosHasta'] != ''){         $a .= ",'".$client['AguasInfMovimientosHasta']."'";     }else{$a .=",''";}
							if(isset($client['idEstado']) && $client['idEstado'] != ''){                                         $a .= ",'".$client['idEstado']."'";                     }else{$a .=",''";}
							if(isset($client['intAnual']) && $client['intAnual'] != ''){                                         $a .= ",'".$client['intAnual']."'";                     }else{$a .=",''";}
							if(isset($client['idTipoPago']) && $client['idTipoPago'] != ''){                                     $a .= ",'".$client['idTipoPago']."'";                   }else{$a .=",''";}
							if(isset($client['nDocPago']) && $client['nDocPago'] != ''){                                         $a .= ",'".$client['nDocPago']."'";                     }else{$a .=",''";}
							if(isset($client['fechaPago']) && $client['fechaPago'] != ''){                                       $a .= ",'".$client['fechaPago']."'";                    }else{$a .=",''";}
							if(isset($client['DiaPago']) && $client['DiaPago'] != ''){                                           $a .= ",'".$client['DiaPago']."'";                      }else{$a .=",''";}
							if(isset($client['idMesPago']) && $client['idMesPago'] != ''){                                       $a .= ",'".$client['idMesPago']."'";                    }else{$a .=",''";}
							if(isset($client['AnoPago']) && $client['AnoPago'] != ''){                                           $a .= ",'".$client['AnoPago']."'";                      }else{$a .=",''";}
							if(isset($client['montoPago']) && $client['montoPago'] != ''){                                       $a .= ",'".$client['montoPago']."'";                    }else{$a .=",''";}
							if(isset($client['idUsuarioPago']) && $client['idUsuarioPago'] != ''){                               $a .= ",'".$client['idUsuarioPago']."'";                }else{$a .=",''";}
							if(isset($client['idPago']) && $client['idPago'] != ''){                                             $a .= ",'".$client['idPago']."'";                       }else{$a .=",''";}
							if(isset($client['rem_cantidad']) && $client['rem_cantidad'] != ''){                                 $a .= ",'".$client['rem_cantidad']."'";                 }else{$a .=",''";}
							if(isset($client['rem_porcentaje']) && $client['rem_porcentaje'] != ''){                             $a .= ",'".$client['rem_porcentaje']."'";               }else{$a .=",''";}
							if(isset($client['rem_negative']) && $client['rem_negative'] != ''){                                 $a .= ",'".$client['rem_negative']."'";                 }else{$a .=",''";}
							if(isset($client['rem_modalidad']) && $client['rem_modalidad'] != ''){                               $a .= ",'".$client['rem_modalidad']."'";                }else{$a .=",''";}
							if(isset($client['rem_diferencia']) && $client['rem_diferencia'] != ''){                             $a .= ",'".$client['rem_diferencia']."'";               }else{$a .=",''";}
							if(isset($client['SII_idFacturable']) && $client['SII_idFacturable'] != ''){                         $a .= ",'".$client['SII_idFacturable']."'";             }else{$a .=",''";}
							if(isset($client['SII_NDoc']) && $client['SII_NDoc'] != ''){                                         $a .= ",'".$client['SII_NDoc']."'";                     }else{$a .=",''";}
							if(isset($client['NombreArchivo']) && $client['NombreArchivo'] != ''){                               $a .= ",'".$client['NombreArchivo']."'";                }else{$a .=",''";}
							
										
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `facturacion_listado_detalle` (idSistema,idUsuario,
							idFacturacion,Fecha,Dia,idMes,Ano,idCliente,ClienteNombre,ClienteDireccion,
							ClienteIdentificador,ClienteNombreComuna,ClienteFechaVencimiento,ClienteEstado,
							DetalleCargoFijoValor,DetalleConsumoCantidad,DetalleConsumoValor,
							DetalleRecoleccionCantidad,DetalleRecoleccionValor,DetalleVisitaCorte,
							DetalleCorte1Valor,DetalleCorte1Fecha,DetalleCorte2Valor,DetalleCorte2Fecha,
							DetalleReposicion1Valor,DetalleReposicion1Fecha,DetalleReposicion2Valor,
							DetalleReposicion2Fecha,DetalleSubtotalServicio,DetalleInteresDeuda,
							DetalleOtrosCargos1Texto,DetalleOtrosCargos2Texto,DetalleOtrosCargos3Texto,
							DetalleOtrosCargos4Texto,DetalleOtrosCargos5Texto,DetalleOtrosCargos1Valor,
							DetalleOtrosCargos2Valor,DetalleOtrosCargos3Valor,DetalleOtrosCargos4Valor,
							DetalleOtrosCargos5Valor,DetalleOtrosCargos1Fecha,DetalleOtrosCargos2Fecha,
							DetalleOtrosCargos3Fecha,DetalleOtrosCargos4Fecha,DetalleOtrosCargos5Fecha,
							DetalleTotalVenta,DetalleSaldoFavor,DetalleSaldoAnterior,DetalleTotalAPagar,
							GraficoMes1Valor,GraficoMes2Valor,GraficoMes3Valor,GraficoMes4Valor,
							GraficoMes5Valor,GraficoMes6Valor,GraficoMes7Valor,GraficoMes8Valor,
							GraficoMes9Valor,GraficoMes10Valor,GraficoMes11Valor,GraficoMes12Valor,
							GraficoMes1Fecha,GraficoMes2Fecha,GraficoMes3Fecha,GraficoMes4Fecha,
							GraficoMes5Fecha,GraficoMes6Fecha,GraficoMes7Fecha,GraficoMes8Fecha,
							GraficoMes9Fecha,GraficoMes10Fecha,GraficoMes11Fecha,GraficoMes12Fecha,
							DetConsMesAnteriorCantidad,DetConsMesAnteriorFecha,DetConsMesActualCantidad,
							DetConsMesActualFecha,DetConsMesDiferencia,DetConsProrateo,DetConsProrateoSigno,
							DetConsMesTotalCantidad,DetConsFechaProxLectura,DetConsModalidad,DetConsFonoEmergencias,
							DetConsFonoConsultas,AguasInfCargoFijo,AguasInfMetroAgua,AguasInfMetroRecolecion,
							AguasInfVisitaCorte,AguasInfCorte1,AguasInfCorte2,AguasInfReposicion1,AguasInfReposicion2,
							AguasInfFactorCobro,AguasInfDifMedGeneral,AguasInfProcProrrateo,AguasInfTipoMedicion,
							AguasInfPuntoDiametro,AguasInfClaveFacturacion,AguasInfClaveLectura,AguasInfNumeroMedidor,
							AguasInfFechaEmision,AguasInfUltimoPagoFecha,AguasInfUltimoPagoMonto,AguasInfMovimientosHasta,
							idEstado,intAnual,idTipoPago,nDocPago,fechaPago,DiaPago,idMesPago,AnoPago,montoPago,
							idUsuarioPago,idPago,rem_cantidad,rem_procentaje,rem_negative,rem_modalidad,rem_diferencia,
							SII_idFacturable,SII_NDoc,NombreArchivo) 
							VALUES (".$a.")";
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
							
							$Cuenta_correcto++;
						}
						
						///////////////////////////////////////////////////////////////////////////////////////
						//Se actualiza el estado de la facturacion si se ejecuta correctamente
						if(isset($Cuenta_correcto)&&$Cuenta_correcto!=0){
							$a = "idFacturado='2'";
							if(isset($ultimo_id) && $ultimo_id != ''){  $a .= ",idFacturacion='".$ultimo_id."'" ;}
							$query  = "UPDATE `mediciones_datos_detalle` SET ".$a." 
							WHERE mediciones_datos_detalle.idSistema = '".$idSistema."'
							AND mediciones_datos_detalle.Ano = '".$Ano."'
							AND mediciones_datos_detalle.idMes = '".$idMes."'
							AND mediciones_datos_detalle.idFacturacion='0'
							";
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
							
						
							//borro todo		
							unset($_SESSION['Facturacion_basicos']);
							unset($_SESSION['Facturacion_clientes']);
							
							//redirijo
							header( 'Location: '.$location.'&created=true' );
							die;
						}
					}
				}
			}

		break;
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			if($errorn==0){
				// actualizo los datos de registro en la db
				$query  = "UPDATE `mediciones_datos_detalle` SET `idFacturacion`='0' WHERE (`idFacturacion`='".$_GET['del']."')";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);

				//borro los datos
				$query  = "DELETE FROM `facturacion_listado` WHERE idFacturacion = ".$_GET['del']."";
				$resultado_1 = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `facturacion_listado_detalle` WHERE idFacturacion = ".$_GET['del']."";
				$resultado_2 = mysqli_query($dbConn, $query);
				
				//Si ejecuto correctamente la consulta
				if($resultado_1==true OR $resultado_2==true){
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}
			
			
		break;			
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_archivo':	

			if ($_FILES["Archivo"]["error"] > 0){ 
				$error['Archivo']     = 'error/Ha ocurrido un error'; 
			} else {
			  //Se verifican las extensiones de los archivos
			  $permitidos = array("application/pdf",
								  "application/octet-stream",
								  "application/x-real",
								  "application/vnd.adobe.xfdf",
								  "application/vnd.fdf",
								  "binary/octet-stream");
			  //Se verifica que el archivo subido no exceda los 100 kb
			  $limite_kb = 10000;
			  //Sufijo
			  $sufijo = '';
			  
			  if (in_array($_FILES['Archivo']['type'], $permitidos) && $_FILES['Archivo']['size'] <= $limite_kb * 1024){
				//Se especifica carpeta de destino
				$ruta = "upload/".$sufijo.$_FILES['Archivo']['name'];
				//Se verifica que el archivo un archivo con el mismo nombre no existe
				if (!file_exists($ruta)){
				  //Se mueve el archivo a la carpeta previamente configurada
				  $resultado = @move_uploaded_file($_FILES["Archivo"]["tmp_name"], $ruta);
				  if ($resultado){
					
					//Filtro para idSistema
					if ( !empty($_POST['idFacturacionDetalle']) )    $idFacturacionDetalle       = $_POST['idFacturacionDetalle'];
					if ( !empty($_POST['SII_NDoc']) )                $SII_NDoc                   = $_POST['SII_NDoc'];
					
					$a = "NombreArchivo='".$sufijo.$_FILES['Archivo']['name']."'" ;
					if(isset($SII_NDoc)&&$SII_NDoc!=''){ $a .= ",SII_NDoc='".$SII_NDoc."'" ;}

					// inserto los datos de registro en la db
					$query  = "UPDATE `facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '$idFacturacionDetalle'";
					$result = mysqli_query($dbConn, $query);
					
					header( 'Location: '.$location.'&created=true' );
					die;
					
					
				  } else {
					$error['Archivo']     = 'error/Ocurrio un error al mover el archivo'; 
				  }
				} else {
				  $error['Archivo']     = 'error/El archivo '.$_FILES['Archivo']['name'].' ya existe'; 
				}
			  } else {
				$error['Archivo']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
			  }
			}


		break;	
/*******************************************************************************************************************/
		case 'del_archivo':	
		
			// Se obtiene el nombre del logo
			$query = "SELECT NombreArchivo
			FROM `facturacion_listado_detalle`
			WHERE idFacturacionDetalle = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			if(unlink('upload/'.$rowdata['NombreArchivo'])&&isset($rowdata['NombreArchivo'])&&$rowdata['NombreArchivo']!=''){	
					
				// actualizo los datos de registro en la db
				$query  = "UPDATE `facturacion_listado_detalle` SET NombreArchivo='' WHERE idFacturacionDetalle = '{$_GET['del']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo			
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}else{

				// actualizo los datos de registro en la db
				$query  = "UPDATE `facturacion_listado_detalle` SET NombreArchivo='' WHERE idFacturacionDetalle = '{$_GET['del']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo				
				header( 'Location: '.$location.'&deleted=true' );
				die;

			} 


		break;
/*******************************************************************************************************************/		
		case 'updateFacturacion':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idFacturacionDetalle='".$idFacturacionDetalle."'" ;
				if(isset($idSistema) && $idSistema != ''){                                       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){                                       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idFacturacion) && $idFacturacion != ''){                               $a .= ",idFacturacion='".$idFacturacion."'" ;}
				if(isset($Fecha) && $Fecha != ''){                                               $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Dia) && $Dia != ''){                                                   $a .= ",Dia='".$Dia."'" ;}
				if(isset($idMes) && $idMes != ''){                                               $a .= ",idMes='".$idMes."'" ;}
				if(isset($Ano) && $Ano != ''){                                                   $a .= ",Ano='".$Ano."'" ;}
				if(isset($idCliente) && $idCliente != ''){                                       $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($ClienteNombre) && $ClienteNombre != ''){                               $a .= ",ClienteNombre='".$ClienteNombre."'" ;}
				if(isset($ClienteDireccion) && $ClienteDireccion != ''){                         $a .= ",ClienteDireccion='".$ClienteDireccion."'" ;}
				if(isset($ClienteIdentificador) && $ClienteIdentificador != ''){                 $a .= ",ClienteIdentificador='".$ClienteIdentificador."'" ;}
				if(isset($ClienteNombreComuna) && $ClienteNombreComuna != ''){                   $a .= ",ClienteNombreComuna='".$ClienteNombreComuna."'" ;}
				if(isset($ClienteFechaVencimiento) && $ClienteFechaVencimiento != ''){           $a .= ",ClienteFechaVencimiento='".$ClienteFechaVencimiento."'" ;}
				if(isset($ClienteEstado) && $ClienteEstado != ''){                               $a .= ",ClienteEstado='".$ClienteEstado."'" ;}
				if(isset($DetalleCargoFijoValor) && $DetalleCargoFijoValor != ''){               $a .= ",DetalleCargoFijoValor='".$DetalleCargoFijoValor."'" ;}
				if(isset($DetalleConsumoCantidad) && $DetalleConsumoCantidad != ''){             $a .= ",DetalleConsumoCantidad='".$DetalleConsumoCantidad."'" ;}
				if(isset($DetalleConsumoValor) && $DetalleConsumoValor != ''){                   $a .= ",DetalleConsumoValor='".$DetalleConsumoValor."'" ;}
				if(isset($DetalleRecoleccionCantidad) && $DetalleRecoleccionCantidad != ''){     $a .= ",DetalleRecoleccionCantidad='".$DetalleRecoleccionCantidad."'" ;}
				if(isset($DetalleRecoleccionValor) && $DetalleRecoleccionValor != ''){           $a .= ",DetalleRecoleccionValor='".$DetalleRecoleccionValor."'" ;}
				if(isset($DetalleVisitaCorte) && $DetalleVisitaCorte != ''){                     $a .= ",DetalleVisitaCorte='".$DetalleVisitaCorte."'" ;}
				if(isset($DetalleCorte1Valor) && $DetalleCorte1Valor != ''){                     $a .= ",DetalleCorte1Valor='".$DetalleCorte1Valor."'" ;}
				if(isset($DetalleCorte1Fecha) && $DetalleCorte1Fecha != ''){                     $a .= ",DetalleCorte1Fecha='".$DetalleCorte1Fecha."'" ;}
				if(isset($DetalleCorte2Valor) && $DetalleCorte2Valor != ''){                     $a .= ",DetalleCorte2Valor='".$DetalleCorte2Valor."'" ;}
				if(isset($DetalleCorte2Fecha) && $DetalleCorte2Fecha != ''){                     $a .= ",DetalleCorte2Fecha='".$DetalleCorte2Fecha."'" ;}
				if(isset($DetalleReposicion1Valor) && $DetalleReposicion1Valor != ''){           $a .= ",DetalleReposicion1Valor='".$DetalleReposicion1Valor."'" ;}
				if(isset($DetalleReposicion1Fecha) && $DetalleReposicion1Fecha != ''){           $a .= ",DetalleReposicion1Fecha='".$DetalleReposicion1Fecha."'" ;}
				if(isset($DetalleReposicion2Valor) && $DetalleReposicion2Valor != ''){           $a .= ",DetalleReposicion2Valor='".$DetalleReposicion2Valor."'" ;}
				if(isset($DetalleReposicion2Fecha) && $DetalleReposicion2Fecha != ''){           $a .= ",DetalleReposicion2Fecha='".$DetalleReposicion2Fecha."'" ;}
				if(isset($DetalleSubtotalServicio) && $DetalleSubtotalServicio != ''){           $a .= ",DetalleSubtotalServicio='".$DetalleSubtotalServicio."'" ;}
				if(isset($DetalleInteresDeuda) && $DetalleInteresDeuda != ''){                   $a .= ",DetalleInteresDeuda='".$DetalleInteresDeuda."'" ;}
				if(isset($DetalleOtrosCargos1Texto) && $DetalleOtrosCargos1Texto != ''){         $a .= ",DetalleOtrosCargos1Texto='".$DetalleOtrosCargos1Texto."'" ;}else{$a .= ",DetalleOtrosCargos1Texto=''" ;}
				if(isset($DetalleOtrosCargos2Texto) && $DetalleOtrosCargos2Texto != ''){         $a .= ",DetalleOtrosCargos2Texto='".$DetalleOtrosCargos2Texto."'" ;}else{$a .= ",DetalleOtrosCargos2Texto=''" ;}
				if(isset($DetalleOtrosCargos3Texto) && $DetalleOtrosCargos3Texto != ''){         $a .= ",DetalleOtrosCargos3Texto='".$DetalleOtrosCargos3Texto."'" ;}else{$a .= ",DetalleOtrosCargos3Texto=''" ;}
				if(isset($DetalleOtrosCargos4Texto) && $DetalleOtrosCargos4Texto != ''){         $a .= ",DetalleOtrosCargos4Texto='".$DetalleOtrosCargos4Texto."'" ;}else{$a .= ",DetalleOtrosCargos4Texto=''" ;}
				if(isset($DetalleOtrosCargos5Texto) && $DetalleOtrosCargos5Texto != ''){         $a .= ",DetalleOtrosCargos5Texto='".$DetalleOtrosCargos5Texto."'" ;}else{$a .= ",DetalleOtrosCargos5Texto=''" ;}
				if(isset($DetalleOtrosCargos1Valor) && $DetalleOtrosCargos1Valor != ''){         $a .= ",DetalleOtrosCargos1Valor='".$DetalleOtrosCargos1Valor."'" ;}else{$a .= ",DetalleOtrosCargos1Valor=''" ;}
				if(isset($DetalleOtrosCargos2Valor) && $DetalleOtrosCargos2Valor != ''){         $a .= ",DetalleOtrosCargos2Valor='".$DetalleOtrosCargos2Valor."'" ;}else{$a .= ",DetalleOtrosCargos2Valor=''" ;}
				if(isset($DetalleOtrosCargos3Valor) && $DetalleOtrosCargos3Valor != ''){         $a .= ",DetalleOtrosCargos3Valor='".$DetalleOtrosCargos3Valor."'" ;}else{$a .= ",DetalleOtrosCargos3Valor=''" ;}
				if(isset($DetalleOtrosCargos4Valor) && $DetalleOtrosCargos4Valor != ''){         $a .= ",DetalleOtrosCargos4Valor='".$DetalleOtrosCargos4Valor."'" ;}else{$a .= ",DetalleOtrosCargos4Valor=''" ;}
				if(isset($DetalleOtrosCargos5Valor) && $DetalleOtrosCargos5Valor != ''){         $a .= ",DetalleOtrosCargos5Valor='".$DetalleOtrosCargos5Valor."'" ;}else{$a .= ",DetalleOtrosCargos5Valor=''" ;}
				if(isset($DetalleOtrosCargos1Fecha) && $DetalleOtrosCargos1Fecha != ''){         $a .= ",DetalleOtrosCargos1Fecha='".$DetalleOtrosCargos1Fecha."'" ;}else{$a .= ",DetalleOtrosCargos1Fecha=''" ;}
				if(isset($DetalleOtrosCargos2Fecha) && $DetalleOtrosCargos2Fecha != ''){         $a .= ",DetalleOtrosCargos2Fecha='".$DetalleOtrosCargos2Fecha."'" ;}else{$a .= ",DetalleOtrosCargos2Fecha=''" ;}
				if(isset($DetalleOtrosCargos3Fecha) && $DetalleOtrosCargos3Fecha != ''){         $a .= ",DetalleOtrosCargos3Fecha='".$DetalleOtrosCargos3Fecha."'" ;}else{$a .= ",DetalleOtrosCargos3Fecha=''" ;}
				if(isset($DetalleOtrosCargos4Fecha) && $DetalleOtrosCargos4Fecha != ''){         $a .= ",DetalleOtrosCargos4Fecha='".$DetalleOtrosCargos4Fecha."'" ;}else{$a .= ",DetalleOtrosCargos4Fecha=''" ;}
				if(isset($DetalleOtrosCargos5Fecha) && $DetalleOtrosCargos5Fecha != ''){         $a .= ",DetalleOtrosCargos5Fecha='".$DetalleOtrosCargos5Fecha."'" ;}else{$a .= ",DetalleOtrosCargos5Fecha=''" ;}
				if(isset($DetalleTotalVenta) && $DetalleTotalVenta != ''){                       $a .= ",DetalleTotalVenta='".$DetalleTotalVenta."'" ;}
				if(isset($DetalleSaldoFavor) && $DetalleSaldoFavor != ''){                       $a .= ",DetalleSaldoFavor='".$DetalleSaldoFavor."'" ;}
				if(isset($DetalleSaldoAnterior) && $DetalleSaldoAnterior != ''){                 $a .= ",DetalleSaldoAnterior='".$DetalleSaldoAnterior."'" ;}
				if(isset($DetalleTotalAPagar) && $DetalleTotalAPagar != ''){                     $a .= ",DetalleTotalAPagar='".$DetalleTotalAPagar."'" ;}
				if(isset($GraficoMes1Valor) && $GraficoMes1Valor != ''){                         $a .= ",GraficoMes1Valor='".$GraficoMes1Valor."'" ;}
				if(isset($GraficoMes2Valor) && $GraficoMes2Valor != ''){                         $a .= ",GraficoMes2Valor='".$GraficoMes2Valor."'" ;}
				if(isset($GraficoMes3Valor) && $GraficoMes3Valor != ''){                         $a .= ",GraficoMes3Valor='".$GraficoMes3Valor."'" ;}
				if(isset($GraficoMes4Valor) && $GraficoMes4Valor != ''){                         $a .= ",GraficoMes4Valor='".$GraficoMes4Valor."'" ;}
				if(isset($GraficoMes5Valor) && $GraficoMes5Valor != ''){                         $a .= ",GraficoMes5Valor='".$GraficoMes5Valor."'" ;}
				if(isset($GraficoMes6Valor) && $GraficoMes6Valor != ''){                         $a .= ",GraficoMes6Valor='".$GraficoMes6Valor."'" ;}
				if(isset($GraficoMes7Valor) && $GraficoMes7Valor != ''){                         $a .= ",GraficoMes7Valor='".$GraficoMes7Valor."'" ;}
				if(isset($GraficoMes8Valor) && $GraficoMes8Valor != ''){                         $a .= ",GraficoMes8Valor='".$GraficoMes8Valor."'" ;}
				if(isset($GraficoMes9Valor) && $GraficoMes9Valor != ''){                         $a .= ",GraficoMes9Valor='".$GraficoMes9Valor."'" ;}
				if(isset($GraficoMes10Valor) && $GraficoMes10Valor != ''){                       $a .= ",GraficoMes10Valor='".$GraficoMes10Valor."'" ;}
				if(isset($GraficoMes11Valor) && $GraficoMes11Valor != ''){                       $a .= ",GraficoMes11Valor='".$GraficoMes11Valor."'" ;}
				if(isset($GraficoMes12Valor) && $GraficoMes12Valor != ''){                       $a .= ",GraficoMes12Valor='".$GraficoMes12Valor."'" ;}
				if(isset($GraficoMes1Fecha) && $GraficoMes1Fecha != ''){                         $a .= ",GraficoMes1Fecha='".$GraficoMes1Fecha."'" ;}
				if(isset($GraficoMes2Fecha) && $GraficoMes2Fecha != ''){                         $a .= ",GraficoMes2Fecha='".$GraficoMes2Fecha."'" ;}
				if(isset($GraficoMes3Fecha) && $GraficoMes3Fecha != ''){                         $a .= ",GraficoMes3Fecha='".$GraficoMes3Fecha."'" ;}
				if(isset($GraficoMes4Fecha) && $GraficoMes4Fecha != ''){                         $a .= ",GraficoMes4Fecha='".$GraficoMes4Fecha."'" ;}
				if(isset($GraficoMes5Fecha) && $GraficoMes5Fecha != ''){                         $a .= ",GraficoMes5Fecha='".$GraficoMes5Fecha."'" ;}
				if(isset($GraficoMes6Fecha) && $GraficoMes6Fecha != ''){                         $a .= ",GraficoMes6Fecha='".$GraficoMes6Fecha."'" ;}
				if(isset($GraficoMes7Fecha) && $GraficoMes7Fecha != ''){                         $a .= ",GraficoMes7Fecha='".$GraficoMes7Fecha."'" ;}
				if(isset($GraficoMes8Fecha) && $GraficoMes8Fecha != ''){                         $a .= ",GraficoMes8Fecha='".$GraficoMes8Fecha."'" ;}
				if(isset($GraficoMes9Fecha) && $GraficoMes9Fecha != ''){                         $a .= ",GraficoMes9Fecha='".$GraficoMes9Fecha."'" ;}
				if(isset($GraficoMes10Fecha) && $GraficoMes10Fecha != ''){                       $a .= ",GraficoMes10Fecha='".$GraficoMes10Fecha."'" ;}
				if(isset($GraficoMes11Fecha) && $GraficoMes11Fecha != ''){                       $a .= ",GraficoMes11Fecha='".$GraficoMes11Fecha."'" ;}
				if(isset($GraficoMes12Fecha) && $GraficoMes12Fecha != ''){                       $a .= ",GraficoMes12Fecha='".$GraficoMes12Fecha."'" ;}
				if(isset($DetConsMesAnteriorCantidad) && $DetConsMesAnteriorCantidad != ''){     $a .= ",DetConsMesAnteriorCantidad='".$DetConsMesAnteriorCantidad."'" ;}
				if(isset($DetConsMesAnteriorFecha) && $DetConsMesAnteriorFecha != ''){           $a .= ",DetConsMesAnteriorFecha='".$DetConsMesAnteriorFecha."'" ;}
				if(isset($DetConsMesActualCantidad) && $DetConsMesActualCantidad != ''){         $a .= ",DetConsMesActualCantidad='".$DetConsMesActualCantidad."'" ;}
				if(isset($DetConsMesActualFecha) && $DetConsMesActualFecha != ''){               $a .= ",DetConsMesActualFecha='".$DetConsMesActualFecha."'" ;}
				if(isset($DetConsMesDiferencia) && $DetConsMesDiferencia != ''){                 $a .= ",DetConsMesDiferencia='".$DetConsMesDiferencia."'" ;}
				if(isset($DetConsProrateo) && $DetConsProrateo != ''){                           $a .= ",DetConsProrateo='".$DetConsProrateo."'" ;}
				if(isset($DetConsProrateoSigno) && $DetConsProrateoSigno != ''){                 $a .= ",DetConsProrateoSigno='".$DetConsProrateoSigno."'" ;}
				if(isset($DetConsMesTotalCantidad) && $DetConsMesTotalCantidad != ''){           $a .= ",DetConsMesTotalCantidad='".$DetConsMesTotalCantidad."'" ;}
				if(isset($DetConsFechaProxLectura) && $DetConsFechaProxLectura != ''){           $a .= ",DetConsFechaProxLectura='".$DetConsFechaProxLectura."'" ;}
				if(isset($DetConsModalidad) && $DetConsModalidad != ''){                         $a .= ",DetConsModalidad='".$DetConsModalidad."'" ;}
				if(isset($DetConsFonoEmergencias) && $DetConsFonoEmergencias != ''){             $a .= ",DetConsFonoEmergencias='".$DetConsFonoEmergencias."'" ;}
				if(isset($DetConsFonoConsultas) && $DetConsFonoConsultas != ''){                 $a .= ",DetConsFonoConsultas='".$DetConsFonoConsultas."'" ;}
				if(isset($AguasInfCargoFijo) && $AguasInfCargoFijo != ''){                       $a .= ",AguasInfCargoFijo='".$AguasInfCargoFijo."'" ;}
				if(isset($AguasInfMetroAgua) && $AguasInfMetroAgua != ''){                       $a .= ",AguasInfMetroAgua='".$AguasInfMetroAgua."'" ;}
				if(isset($AguasInfMetroRecolecion) && $AguasInfMetroRecolecion != ''){           $a .= ",AguasInfMetroRecolecion='".$AguasInfMetroRecolecion."'" ;}
				if(isset($AguasInfVisitaCorte) && $AguasInfVisitaCorte != ''){                   $a .= ",AguasInfVisitaCorte='".$AguasInfVisitaCorte."'" ;}
				if(isset($AguasInfCorte1) && $AguasInfCorte1 != ''){                             $a .= ",AguasInfCorte1='".$AguasInfCorte1."'" ;}
				if(isset($AguasInfCorte2) && $AguasInfCorte2 != ''){                             $a .= ",AguasInfCorte2='".$AguasInfCorte2."'" ;}
				if(isset($AguasInfReposicion1) && $AguasInfReposicion1 != ''){                   $a .= ",AguasInfReposicion1='".$AguasInfReposicion1."'" ;}
				if(isset($AguasInfReposicion2) && $AguasInfReposicion2 != ''){                   $a .= ",AguasInfReposicion2='".$AguasInfReposicion2."'" ;}
				if(isset($AguasInfFactorCobro) && $AguasInfFactorCobro != ''){                   $a .= ",AguasInfFactorCobro='".$AguasInfFactorCobro."'" ;}
				if(isset($AguasInfDifMedGeneral) && $AguasInfDifMedGeneral != ''){               $a .= ",AguasInfDifMedGeneral='".$AguasInfDifMedGeneral."'" ;}
				if(isset($AguasInfProcProrrateo) && $AguasInfProcProrrateo != ''){               $a .= ",AguasInfProcProrrateo='".$AguasInfProcProrrateo."'" ;}
				if(isset($AguasInfTipoMedicion) && $AguasInfTipoMedicion != ''){                 $a .= ",AguasInfTipoMedicion='".$AguasInfTipoMedicion."'" ;}
				if(isset($AguasInfPuntoDiametro) && $AguasInfPuntoDiametro != ''){               $a .= ",AguasInfPuntoDiametro='".$AguasInfPuntoDiametro."'" ;}
				if(isset($AguasInfClaveFacturacion) && $AguasInfClaveFacturacion != ''){         $a .= ",AguasInfClaveFacturacion='".$AguasInfClaveFacturacion."'" ;}
				if(isset($AguasInfClaveLectura) && $AguasInfClaveLectura != ''){                 $a .= ",AguasInfClaveLectura='".$AguasInfClaveLectura."'" ;}
				if(isset($AguasInfNumeroMedidor) && $AguasInfNumeroMedidor != ''){               $a .= ",AguasInfNumeroMedidor='".$AguasInfNumeroMedidor."'" ;}
				if(isset($AguasInfFechaEmision) && $AguasInfFechaEmision != ''){                 $a .= ",AguasInfFechaEmision='".$AguasInfFechaEmision."'" ;}
				if(isset($AguasInfUltimoPagoFecha) && $AguasInfUltimoPagoFecha != ''){           $a .= ",AguasInfUltimoPagoFecha='".$AguasInfUltimoPagoFecha."'" ;}
				if(isset($AguasInfUltimoPagoMonto) && $AguasInfUltimoPagoMonto != ''){           $a .= ",AguasInfUltimoPagoMonto='".$AguasInfUltimoPagoMonto."'" ;}
				if(isset($AguasInfMovimientosHasta) && $AguasInfMovimientosHasta != ''){         $a .= ",AguasInfMovimientosHasta='".$AguasInfMovimientosHasta."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($intAnual) && $intAnual != ''){                                         $a .= ",intAnual='".$intAnual."'" ;}
				if(isset($idTipoPago) && $idTipoPago != ''){                                     $a .= ",idTipoPago='".$idTipoPago."'" ;}
				if(isset($nDocPago) && $nDocPago != ''){                                         $a .= ",nDocPago='".$nDocPago."'" ;}
				if(isset($fechaPago) && $fechaPago != ''){                                       $a .= ",fechaPago='".$fechaPago."'" ;}
				if(isset($DiaPago) && $DiaPago != ''){                                           $a .= ",DiaPago='".$DiaPago."'" ;}
				if(isset($idMesPago) && $idMesPago != ''){                                       $a .= ",idMesPago='".$idMesPago."'" ;}
				if(isset($AnoPago) && $AnoPago != ''){                                           $a .= ",AnoPago='".$AnoPago."'" ;}
				if(isset($montoPago) && $montoPago != ''){                                       $a .= ",montoPago='".$montoPago."'" ;}
				if(isset($idUsuarioPago) && $idUsuarioPago != ''){                               $a .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
				if(isset($idPago) && $idPago != ''){                                             $a .= ",idPago='".$idPago."'" ;}
				if(isset($rem_cantidad) && $rem_cantidad != ''){                                 $a .= ",rem_cantidad='".$rem_cantidad."'" ;}
				if(isset($rem_procentaje) && $rem_procentaje != ''){                             $a .= ",rem_procentaje='".$rem_procentaje."'" ;}
				if(isset($rem_negative) && $rem_negative != ''){                                 $a .= ",rem_negative='".$rem_negative."'" ;}
				if(isset($rem_modalidad) && $rem_modalidad != ''){                               $a .= ",rem_modalidad='".$rem_modalidad."'" ;}
				if(isset($rem_diferencia) && $rem_diferencia != ''){                             $a .= ",rem_diferencia='".$rem_diferencia."'" ;}
				if(isset($SII_idFacturable) && $SII_idFacturable != ''){                         $a .= ",SII_idFacturable='".$SII_idFacturable."'" ;}
				if(isset($SII_NDoc) && $SII_NDoc != ''){                                         $a .= ",SII_NDoc='".$SII_NDoc."'" ;}
				if(isset($NombreArchivo) && $NombreArchivo != ''){                               $a .= ",NombreArchivo='".$NombreArchivo."'" ;}

				// inserto los datos de registro en la db
				$query  = "UPDATE `facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '$idFacturacionDetalle'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
/*******************************************************************************************************************/
	}
?>
