<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-012).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idFacturacion']))             $idFacturacion             = $_POST['idFacturacion'];
	if (!empty($_POST['idSistema']))                 $idSistema                 = $_POST['idSistema'];
	if (!empty($_POST['idUsuario']))                 $idUsuario                 = $_POST['idUsuario'];
	if (!empty($_POST['Fecha']))                     $Fecha                     = $_POST['Fecha'];
	if (!empty($_POST['Dia']))                       $Dia                       = $_POST['Dia'];
	if (!empty($_POST['idMes']))                     $idMes                     = $_POST['idMes'];
	if (!empty($_POST['Ano']))                       $Ano                       = $_POST['Ano'];
	if (!empty($_POST['Observaciones']))             $Observaciones             = $_POST['Observaciones'];
	if (!empty($_POST['fCreacion']))                 $fCreacion                 = $_POST['fCreacion'];
	if (!empty($_POST['intAnual']))                  $intAnual                  = $_POST['intAnual'];
	if (!empty($_POST['idOpcionesInteres']))         $idOpcionesInteres         = $_POST['idOpcionesInteres'];

	if (!empty($_POST['NClientes'])){
		$NClientes  = $_POST['NClientes'];
		//recorro
		$arrPostClientes = array();
		for ($i = 1; $i <= $NClientes; $i++) {
			if (!empty($_POST['SII_NDoc_'.$i])){              $arrPostClientes[$i]['SII_NDoc']                 = $_POST['SII_NDoc_'.$i];}
			if (!empty($_POST['idFacturacionDetalle_'.$i])){  $arrPostClientes[$i]['idFacturacionDetalle']     = $_POST['idFacturacionDetalle_'.$i];}
		}
	}

/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$INT_piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($INT_piezas as $INT_valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($INT_valor) {
			case 'idFacturacion':        if(empty($idFacturacion)){         $error['idFacturacion']           = 'error/No ha ingresado el id';}break;
			case 'idSistema':            if(empty($idSistema)){             $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':            if(empty($idUsuario)){             $error['idUsuario']               = 'error/No ha seleccionado el usuario';}break;
			case 'Fecha':                if(empty($Fecha)){                 $error['Fecha']                   = 'error/No ha ingresado la fecha de facturacion';}break;
			case 'Dia':                  if(empty($Dia)){                   $error['Dia']                     = 'error/No ha ingresado el dia de facturacion';}break;
			case 'idMes':                if(empty($idMes)){                 $error['idMes']                   = 'error/No ha ingresado el mes de facturacion';}break;
			case 'Ano':                  if(empty($Ano)){                   $error['Ano']                     = 'error/No ha ingresado el año de facturacion';}break;
			case 'Observaciones':        if(empty($Observaciones)){         $error['Observaciones']           = 'error/No ha ingresado la Observacion';}break;
			case 'fCreacion':            if(empty($fCreacion)){             $error['fCreacion']               = 'error/No ha ingresado la fecha de creacion';}break;
			case 'intAnual':             if(empty($intAnual)){              $error['intAnual']                = 'error/No ha seleccionado el tipo';}break;
			case 'idOpcionesInteres':    if(empty($idOpcionesInteres)){     $error['idOpcionesInteres']       = 'error/No ha seleccionado el tipo de medicion';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Observaciones) && $Observaciones!=''){ $Observaciones = EstandarizarInput($Observaciones);}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){  $error['Observaciones'] = 'error/Edita la Observacion, contiene palabras no permitidas';}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		case 'new_Facturacion':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Fecha)&&isset($idSistema)){
				$idMes   = fecha2NMes($Fecha);
				$Ano     = fecha2Ano($Fecha);
				$ndata_1 = db_select_nrows (false, 'idFacturacion', 'aguas_facturacion_listado', '', "idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'idSistema', 'aguas_datos_valores', '', 'idSistema = '.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) { $error['ndata_1'] = 'error/El Facturacion ingresada ya existe en el sistema';}
			if($ndata_2==0) {  $error['ndata_2'] = 'error/No hay valores configurados de visita, corte u otro';}
			/*******************************************************************/
			//existencia de datos
			if(!isset($idSistema) OR $idSistema == ''){                  $error['idSistema']         = 'error/No ha seleccionado el Sistema';}
			if(!isset($idUsuario) OR $idUsuario == ''){                  $error['idUsuario']         = 'error/No ha seleccionado Usuario';}
			if(!isset($Fecha) OR $Fecha == ''){                          $error['Fecha']             = 'error/No ha ingresado la Fecha';}
			if(!isset($fCreacion) OR $fCreacion == ''){                  $error['fCreacion']         = 'error/No ha ingresado la Fecha de creacion';}
			if(!isset($intAnual) OR $intAnual == ''){                    $error['intAnual']          = 'error/No ha ingresado el interes anual';}
			if(!isset($idOpcionesInteres) OR $idOpcionesInteres == ''){  $error['idOpcionesInteres'] = 'error/No ha seleccionado la opcion de calculo de intereses';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

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
				$Dia               = fecha2NdiaMes($Fecha);
				$idMes             = fecha2NMes($Fecha);
				$Ano               = fecha2Ano($Fecha);

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
				// Se traen todos los datos del usuario
				$rowUsuario = db_select_data (false, 'Nombre', 'usuarios_listado', '', 'idUsuario = "'.$idUsuario.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				$SIS_query = '
				core_sistemas.Nombre AS SistemaNombre,
				core_sistemas.Rut AS SistemaRut,
				core_sistemas.Rubro AS SistemaRubro,
				core_sistemas.Direccion AS SistemaDireccion,
				core_sistemas.Contacto_Fono1 AS SistemaFono1,
				core_sistemas.Contacto_Fono2 AS SistemaFono2,
				core_ubicacion_comunas.Nombre AS SistemaComuna,
				core_ubicacion_ciudad.Nombre AS SistemaCiudad
				';
				$SIS_join = '
				LEFT JOIN `core_ubicacion_comunas`   ON core_ubicacion_comunas.idComuna   = core_sistemas.idComuna
				LEFT JOIN `core_ubicacion_ciudad`    ON core_ubicacion_ciudad.idCiudad    = core_sistemas.idCiudad
				';
				// Se traen todos los datos del usuario
				$rowSistema = db_select_data (false, $SIS_query, 'core_sistemas',$SIS_join, 'core_sistemas.idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Consulto los datos de la tabla de valores
				$SIS_query = 'valorCargoFijo, valorAgua, valorRecoleccion, valorVisitaCorte, valorCorte1, 
				valorCorte2, valorReposicion1, valorReposicion2, NdiasPago, Fac_nEmergencia, Fac_nConsultas';
				$rowValores = db_select_data (false, $SIS_query, 'aguas_datos_valores', '', 'idSistema = "'.$idSistema.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				// Se trae un listado con todos los clientes
				$SIS_query = '
				aguas_clientes_listado.idCliente,
				aguas_clientes_listado.idCliente AS ID,
				aguas_clientes_listado.Nombre,
				aguas_clientes_listado.RazonSocial,
				aguas_clientes_listado.Direccion,
				aguas_clientes_listado.Identificador,
				aguas_clientes_listado.UnidadHabitacional,
				aguas_clientes_listado.Arranque,
				aguas_clientes_listado.idFacturable,
				aguas_clientes_listado.Rut,
				aguas_clientes_listado.Giro,
				aguas_clientes_listado.Fono1,
				aguas_clientes_listado.Fono2,
				aguas_clientes_listado.idEstadoPago,
				core_ubicacion_comunas.Nombre AS NombreComuna,
				core_ubicacion_ciudad.Nombre AS NombreCiudad,
				aguas_marcadores_listado.Nombre AS NombreMedidor,
				aguas_marcadores_remarcadores.Nombre AS NombreMarcador,

				(SELECT DetalleTotalAPagar                    FROM `aguas_facturacion_listado_detalle`      WHERE idCliente = ID AND idEstado = 1 ORDER BY Fecha DESC LIMIT 1) AS SaldoAnterior,
				(SELECT ClienteFechaVencimiento               FROM `aguas_facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY ClienteFechaVencimiento DESC LIMIT 1) AS FechaVencimiento,
				(SELECT DetalleTotalAPagar                    FROM `aguas_facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS MontoPactado,
				(SELECT montoPago                             FROM `aguas_facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS MontoPagado,
				(SELECT fechaPago                             FROM `aguas_facturacion_listado_detalle`      WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS FechaPagado,
				(SELECT idDatosDetalle                        FROM `aguas_mediciones_datos_detalle`         WHERE idCliente = ID ORDER BY Fecha DESC LIMIT 1) AS DetMesActualidDatosDetalle,
				(SELECT COUNT(idFacturacionDetalle) AS Cuenta FROM `aguas_facturacion_listado_detalle`      WHERE idCliente = ID AND idEstado = 1 LIMIT 1) AS CuentaPendientes,
				(SELECT fechaPago                             FROM `aguas_clientes_pago`                    WHERE idCliente = ID ORDER BY fechaPago DESC LIMIT 1) AS PagoFecha,
				(SELECT montoPago                             FROM `aguas_clientes_pago`                    WHERE idCliente = ID ORDER BY fechaPago DESC LIMIT 1) AS PagoMonto';
				$SIS_join  = '
				LEFT JOIN `core_ubicacion_comunas`           ON core_ubicacion_comunas.idComuna                 = aguas_clientes_listado.idComuna
				LEFT JOIN `core_ubicacion_ciudad`            ON core_ubicacion_ciudad.idCiudad                  = aguas_clientes_listado.idCiudad
				LEFT JOIN `aguas_marcadores_listado`         ON aguas_marcadores_listado.idMarcadores           = aguas_clientes_listado.idMarcadores
				LEFT JOIN `aguas_marcadores_remarcadores`    ON aguas_marcadores_remarcadores.idRemarcadores    = aguas_clientes_listado.idRemarcadores
				';
				$SIS_where = 'aguas_clientes_listado.idSistema='.$idSistema.' AND aguas_clientes_listado.idFacturable != 3';
				$SIS_order = 'aguas_clientes_listado.idCliente ASC';
				$arrClientes = array();
				$arrClientes = db_select_array (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//Se traen todos los eventos transcurridos en el mes
				$arrEventos = array();
				$arrEventos = db_select_array (false, 'idCliente, idTipo, ValorEvento, FechaEjecucion, Fecha', 'aguas_clientes_eventos', 0, 'idSistema = '.$idSistema.' AND Ano = '.$Ano.' AND idMes = '.$idMes, 'idCliente ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//Se traen todos los consumos del mes
				$SIS_query = '
				aguas_mediciones_datos_detalle.idCliente,
				aguas_mediciones_datos_detalle.Consumo,
				aguas_mediciones_datos_detalle.Fecha,

				aguas_mediciones_datos_detalle.idTipoMedicion,
				aguas_mediciones_datos_detalle.ConsumoMedidor,
				aguas_mediciones_datos_detalle.ConsumoGeneral,
				aguas_mediciones_datos_detalle.CantRemarcadores,

				data1.Nombre AS TipoFacturacion,
				data2.Nombre AS TipoLectura';
				$SIS_join  = '
				LEFT JOIN `aguas_mediciones_datos_detalle_tipofacturacion` data1 ON data1.idTipoFacturacion   = aguas_mediciones_datos_detalle.idTipoFacturacion
				LEFT JOIN `aguas_mediciones_datos_detalle_tipolectura`     data2 ON data2.idTipoLectura       = aguas_mediciones_datos_detalle.idTipoLectura
				';
				$SIS_where = 'aguas_mediciones_datos_detalle.idSistema = '.$idSistema.'
				AND aguas_mediciones_datos_detalle.Ano = '.$Ano.'
				AND aguas_mediciones_datos_detalle.idMes = '.$idMes;
				$SIS_order = 'aguas_mediciones_datos_detalle.idCliente ASC';
				$arrDatos = array();
				$arrDatos = db_select_array (false, $SIS_query, 'aguas_mediciones_datos_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//Se traen todos los consumos del mes anterior
				$SIS_query = 'idCliente, Consumo, Fecha';
				$SIS_join  = '';
				$SIS_where = 'idSistema = '.$idSistema.' AND Ano = '.$AnoAnterior.' AND idMes = '.$idMesAnterior;
				$SIS_order = 'idCliente ASC';
				$arrDatosAnteriores = array();
				$arrDatosAnteriores = db_select_array (false, $SIS_query, 'aguas_mediciones_datos_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//se consultan los estados de pago de los clientes
				$SIS_query = 'idEstadoPago, Nombre';
				$SIS_join  = '';
				$SIS_where = 'idEstadoPago!=0';
				$SIS_order = 0;
				$arrEstados = array();
				$arrEstados = db_select_array (false, $SIS_query, 'aguas_clientes_estadopago', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//Se traen todos los cargos transcurridos en el mes
				$SIS_query = 'idCliente, FechaEjecucion, Observacion, ValorCargo';
				$SIS_join  = '';
				$SIS_where = 'idSistema = '.$idSistema.' AND Ano = '.$Ano.' AND idMes = '.$idMes;
				$SIS_order = 'idCliente ASC';
				$arrCargos = array();
				$arrCargos = db_select_array (false, $SIS_query, 'aguas_clientes_otros_cargos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//Leo todos los datos de la base
				$arrGraficos = array();
				$arrGraficos = db_select_array (false, 'idCliente,GraficoMes1Valor,GraficoMes2Valor,GraficoMes3Valor,GraficoMes4Valor,GraficoMes5Valor,GraficoMes6Valor,GraficoMes7Valor,GraficoMes8Valor,GraficoMes9Valor,GraficoMes10Valor,GraficoMes11Valor,GraficoMes12Valor,GraficoMes1Fecha,GraficoMes2Fecha,GraficoMes3Fecha,GraficoMes4Fecha,GraficoMes5Fecha,GraficoMes6Fecha,GraficoMes7Fecha,GraficoMes8Fecha,GraficoMes9Fecha,GraficoMes10Fecha,GraficoMes11Fecha,GraficoMes12Fecha', 'aguas_facturacion_listado_detalle', 0, 'idSistema = '.$idSistema.' AND Ano = '.$AnoAnterior.' AND idMes = '.$idMesAnterior, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				//se consultan los estados de pago de los clientes
				$arrDocFacturable = array();
				$arrDocFacturable = db_select_array (false, 'idFacturable, Nombre', 'aguas_clientes_facturable', 0, 0, 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/* ************************************************** */
				/* ************************************************** */
				//Arreglo Temporal
				//Se recorren los eventos
				foreach ($arrEventos as $datos){
					$Eventos[$datos['idCliente']][$datos['idTipo']]['idTipo']          = $datos['idTipo'];
					$Eventos[$datos['idCliente']][$datos['idTipo']]['ValorEvento']     = $datos['ValorEvento'];
					$Eventos[$datos['idCliente']][$datos['idTipo']]['Fecha']           = $datos['Fecha'];
					$Eventos[$datos['idCliente']][$datos['idTipo']]['FechaEjecucion']  = $datos['FechaEjecucion'];
				}
				//Se recorren las mediciones
				foreach ($arrDatos as $datos){
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
				foreach ($arrDatosAnteriores as $datos){
					$MedicionAnterior[$datos['idCliente']]['idCliente']        = $datos['idCliente'];
					$MedicionAnterior[$datos['idCliente']]['Consumo']          = $datos['Consumo'];
					$MedicionAnterior[$datos['idCliente']]['Fecha']            = $datos['Fecha'];
				}
				//Se recorren los estados
				foreach ($arrEstados as $datos){
					$Estados[$datos['idEstadoPago']]['Nombre'] = $datos['Nombre'];
				}
				//Se recorren los otros cargos
				foreach ($arrCargos as $datos){
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
				foreach ($arrDocFacturable as $datos){
					$DocFacturable[$datos['idFacturable']]['Nombre'] = $datos['Nombre'];
				}

				/******************************************************************************************/
				/*                                        Ejecucion                                       */
				/******************************************************************************************/
				unset($_SESSION['Facturacion_basicos']);
				unset($_SESSION['Facturacion_clientes']);

				/********************************************************************************/
				//Bloque tabla principal
				if(isset($idSistema) && $idSistema!=''){                  $_SESSION['Facturacion_basicos']['idSistema']             = $idSistema;             }else{$_SESSION['Facturacion_basicos']['idSistema']            = '';}
				if(isset($idUsuario) && $idUsuario!=''){                  $_SESSION['Facturacion_basicos']['idUsuario']             = $idUsuario;             }else{$_SESSION['Facturacion_basicos']['idUsuario']            = '';}
				if(isset($Fecha) && $Fecha!=''){                          $_SESSION['Facturacion_basicos']['Fecha']                 = $Fecha;                 }else{$_SESSION['Facturacion_basicos']['Fecha']                = '';}
				if(isset($Dia) && $Dia!=''){                              $_SESSION['Facturacion_basicos']['Dia']                   = $Dia;                   }else{$_SESSION['Facturacion_basicos']['Dia']                  = '';}
				if(isset($idMes) && $idMes!=''){                          $_SESSION['Facturacion_basicos']['idMes']                 = $idMes;                 }else{$_SESSION['Facturacion_basicos']['idMes']                = '';}
				if(isset($Ano) && $Ano!=''){                              $_SESSION['Facturacion_basicos']['Ano']                   = $Ano;                   }else{$_SESSION['Facturacion_basicos']['Ano']                  = '';}
				if(isset($Observaciones) && $Observaciones!=''){          $_SESSION['Facturacion_basicos']['Observaciones']         = $Observaciones;         }else{$_SESSION['Facturacion_basicos']['Observaciones']        = 'Sin Observaciones';}
				if(isset($fCreacion) && $fCreacion!=''){                  $_SESSION['Facturacion_basicos']['fCreacion']             = $fCreacion;             }else{$_SESSION['Facturacion_basicos']['fCreacion']            = '';}
				if(isset($intAnual) && $intAnual!=''){                    $_SESSION['Facturacion_basicos']['intAnual']              = $intAnual;              }else{$_SESSION['Facturacion_basicos']['intAnual']             = '';}
				if(isset($idOpcionesInteres) && $idOpcionesInteres!=''){  $_SESSION['Facturacion_basicos']['idOpcionesInteres']     = $idOpcionesInteres;     }else{$_SESSION['Facturacion_basicos']['idOpcionesInteres']    = '';}
				//dato extra
				if(isset($idUsuario) && $idUsuario!=''){                  $_SESSION['Facturacion_basicos']['Usuario']               = $rowUsuario['Nombre'];  }else{$_SESSION['Facturacion_basicos']['Usuario']              = '';}
				if(isset($idSistema) && $idSistema!=''){
					$_SESSION['Facturacion_basicos']['SistemaNombre']     = $rowSistema['SistemaNombre'];
					$_SESSION['Facturacion_basicos']['SistemaRut']        = $rowSistema['SistemaRut'];
					$_SESSION['Facturacion_basicos']['SistemaRubro']      = $rowSistema['SistemaRubro'];
					$_SESSION['Facturacion_basicos']['SistemaDireccion']  = $rowSistema['SistemaDireccion'];
					$_SESSION['Facturacion_basicos']['SistemaFono1']      = $rowSistema['SistemaFono1'];
					$_SESSION['Facturacion_basicos']['SistemaFono2']      = $rowSistema['SistemaFono2'];
					$_SESSION['Facturacion_basicos']['SistemaComuna']     = $rowSistema['SistemaComuna'];
					$_SESSION['Facturacion_basicos']['SistemaCiudad']     = $rowSistema['SistemaCiudad'];
				}else{
					$_SESSION['Facturacion_basicos']['SistemaNombre']     = '';
					$_SESSION['Facturacion_basicos']['SistemaRut']        = '';
					$_SESSION['Facturacion_basicos']['SistemaRubro']      = '';
					$_SESSION['Facturacion_basicos']['SistemaDireccion']  = '';
					$_SESSION['Facturacion_basicos']['SistemaFono1']      = '';
					$_SESSION['Facturacion_basicos']['SistemaFono2']      = '';
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
					$DetalleCargoFijoValor       = $rowValores['valorCargoFijo']*1;
					$DetalleConsumoCantidad      = $ConsumoMesActual;
					$DetalleConsumoValor         = valores_truncados($rowValores['valorAgua'] * $ConsumoMesActual);
					$DetalleRecoleccionCantidad  = $ConsumoMesActual;
					$DetalleRecoleccionValor     = valores_truncados($rowValores['valorRecoleccion'] * $ConsumoMesActual);

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
					if(isset($OtrosCargos[$cliente['idCliente']][0]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][0]['Observacion']!=''){$DetalleOtrosCargos1Texto = $OtrosCargos[$cliente['idCliente']][0]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][1]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][1]['Observacion']!=''){$DetalleOtrosCargos2Texto = $OtrosCargos[$cliente['idCliente']][1]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][2]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][2]['Observacion']!=''){$DetalleOtrosCargos3Texto = $OtrosCargos[$cliente['idCliente']][2]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][3]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][3]['Observacion']!=''){$DetalleOtrosCargos4Texto = $OtrosCargos[$cliente['idCliente']][3]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][4]['Observacion'])&&$OtrosCargos[$cliente['idCliente']][4]['Observacion']!=''){$DetalleOtrosCargos5Texto = $OtrosCargos[$cliente['idCliente']][4]['Observacion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][0]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][0]['ValorCargo']!=''){  $DetalleOtrosCargos1Valor = $OtrosCargos[$cliente['idCliente']][0]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][1]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][1]['ValorCargo']!=''){  $DetalleOtrosCargos2Valor = $OtrosCargos[$cliente['idCliente']][1]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][2]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][2]['ValorCargo']!=''){  $DetalleOtrosCargos3Valor = $OtrosCargos[$cliente['idCliente']][2]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][3]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][3]['ValorCargo']!=''){  $DetalleOtrosCargos4Valor = $OtrosCargos[$cliente['idCliente']][3]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][4]['ValorCargo'])&&$OtrosCargos[$cliente['idCliente']][4]['ValorCargo']!=''){  $DetalleOtrosCargos5Valor = $OtrosCargos[$cliente['idCliente']][4]['ValorCargo'];}
					if(isset($OtrosCargos[$cliente['idCliente']][0]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][0]['FechaEjecucion']!=''){ $DetalleOtrosCargos1Fecha = $OtrosCargos[$cliente['idCliente']][0]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][1]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][1]['FechaEjecucion']!=''){ $DetalleOtrosCargos2Fecha = $OtrosCargos[$cliente['idCliente']][1]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][2]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][2]['FechaEjecucion']!=''){ $DetalleOtrosCargos3Fecha = $OtrosCargos[$cliente['idCliente']][2]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][3]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][3]['FechaEjecucion']!=''){ $DetalleOtrosCargos4Fecha = $OtrosCargos[$cliente['idCliente']][3]['FechaEjecucion'];}
					if(isset($OtrosCargos[$cliente['idCliente']][4]['FechaEjecucion'])&&$OtrosCargos[$cliente['idCliente']][4]['FechaEjecucion']!=''){ $DetalleOtrosCargos5Fecha = $OtrosCargos[$cliente['idCliente']][4]['FechaEjecucion'];}

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
					if(isset($cliente['RazonSocial']) && $cliente['RazonSocial']!=''){
						$ClienteNombre = $cliente['RazonSocial'];
					}else{
						if(isset($cliente['Nombre']) && $cliente['Nombre']!=''){
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
					if(isset($DetalleTotalAPagar) && $DetalleTotalAPagar!=''){
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
					if(isset($Fecha)&&isset($rowValores['NdiasPago'])){                         $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFechaVencimiento']         = sumarDias($Fecha,$rowValores['NdiasPago']);                                  }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['ClienteFechaVencimiento']     = '';}
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
					if(isset($idMesProximo)){                                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes12Fecha']               = numero_a_mes_corto($idMesProximo);                                           }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['GraficoMes12Fecha']           = '';}
					if(isset($MedicionAnterior[$cliente['idCliente']]['Consumo'])){             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorCantidad']      = valores_truncados($MedicionAnterior[$cliente['idCliente']]['Consumo']);      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorCantidad']  = '';}
					if(isset($MedicionAnterior[$cliente['idCliente']]['Fecha'])){               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorFecha']         = $MedicionAnterior[$cliente['idCliente']]['Fecha'];                           }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesAnteriorFecha']     = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['Consumo'])){               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualCantidad']        = valores_truncados($MedicionActual[$cliente['idCliente']]['Consumo']);        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualCantidad']    = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['Fecha'])){                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualFecha']           = $MedicionActual[$cliente['idCliente']]['Fecha'];                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesActualFecha']       = '';}
					if(isset($MesDiferencia)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesDiferencia']            = $MesDiferencia;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesDiferencia']        = '';}   
					if(isset($rem_cantidad)){                                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateo']                 = $rem_cantidad;                                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateo']             = '';}
					if(isset($rem_cantidad_signo)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateoSigno']            = $rem_cantidad_signo;                                                         }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsProrateoSigno']        = '';}
					if(isset($DetalleConsumoCantidad)){                                         $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesTotalCantidad']         = $DetalleConsumoCantidad;                                                     }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsMesTotalCantidad']     = '';}
					if(isset($AnoProximo)&&isset($idMesProximo)){                               $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFechaProxLectura']         = $AnoProximo.'-'.numero_mes($idMesProximo).'-01';                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFechaProxLectura']     = '';}
					if(isset($rem_modalidad)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsModalidad']                = $rem_modalidad;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsModalidad']            = '';}
					if(isset($rowValores['Fac_nEmergencia'])){                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoEmergencias']          = $rowValores['Fac_nEmergencia'];                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoEmergencias']      = '';}
					if(isset($rowValores['Fac_nConsultas'])){                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoConsultas']            = $rowValores['Fac_nConsultas'];                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['DetConsFonoConsultas']        = '';}
					if(isset($rowValores['valorCargoFijo'])){                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCargoFijo']               = valores_truncados($rowValores['valorCargoFijo']);                            }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCargoFijo']           = '';}
					if(isset($rowValores['valorAgua'])){                                        $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroAgua']               = $rowValores['valorAgua'];                                                    }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroAgua']           = '';}
					if(isset($rowValores['valorRecoleccion'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroRecolecion']         = $rowValores['valorRecoleccion'];                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMetroRecolecion']     = '';}
					if(isset($rowValores['valorVisitaCorte'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfVisitaCorte']             = valores_truncados($rowValores['valorVisitaCorte']);                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfVisitaCorte']         = '';}
					if(isset($rowValores['valorCorte1'])){                                      $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte1']                  = valores_truncados($rowValores['valorCorte1']);                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte1']              = '';}
					if(isset($rowValores['valorCorte2'])){                                      $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte2']                  = valores_truncados($rowValores['valorCorte2']);                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfCorte2']              = '';}
					if(isset($rowValores['valorReposicion1'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion1']             = valores_truncados($rowValores['valorReposicion1']);                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion1']         = '';}
					if(isset($rowValores['valorReposicion2'])){                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion2']             = valores_truncados($rowValores['valorReposicion2']);                          }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfReposicion2']         = '';}
					if(isset($rem_diferencia)){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfDifMedGeneral']           = $rem_diferencia;                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfDifMedGeneral']       = '';}
					if(isset($rem_porcentaje)){                                                 $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfProcProrrateo']           = $rem_porcentaje;                                                             }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfProcProrrateo']       = '';}
					if(isset($TipoMedicion)){                                                   $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfTipoMedicion']            = $TipoMedicion;                                                               }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfTipoMedicion']        = '';}
					if(isset($cliente['Arranque'])){                                            $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfPuntoDiametro']           = $cliente['Arranque'];                                                        }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfPuntoDiametro']       = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['TipoFacturacion'])){       $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveFacturacion']        = $MedicionActual[$cliente['idCliente']]['TipoFacturacion'];                   }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveFacturacion']    = '';}
					if(isset($MedicionActual[$cliente['idCliente']]['TipoLectura'])){           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveLectura']            = $MedicionActual[$cliente['idCliente']]['TipoLectura'];                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfClaveLectura']        = '';}
					if(isset($NumeroMedidor)){                                                  $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfNumeroMedidor']           = $NumeroMedidor;                                                              }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfNumeroMedidor']       = '';}
					if(isset($Fecha)){                                                $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfFechaEmision']            = $Fecha;                                                                      }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfFechaEmision']        = '';}
					if(isset($cliente['PagoFecha'])){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoFecha']         = $cliente['PagoFecha'];                                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoFecha']     = '';}
					if(isset($cliente['PagoMonto'])){                                           $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoMonto']         = $cliente['PagoMonto'];                                                       }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfUltimoPagoMonto']     = '';}
					if(isset($Ano)&&isset($idMes)){                                             $_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMovimientosHasta']        = $Ano.'-'.numero_mes($idMes).'-09';                                           }else{$_SESSION['Facturacion_clientes'][$cliente['idCliente']]['AguasInfMovimientosHasta']    = '';}
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

			//redirijo
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

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

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
				if(isset($idSistema) && $idSistema!=''){                   $SIS_data  = "'".$idSistema."'";           }else{$SIS_data  = "''";}
				if(isset($idUsuario) && $idUsuario!=''){                   $SIS_data .= ",'".$idUsuario."'";          }else{$SIS_data .= ",''";}
				if(isset($Fecha) && $Fecha!=''){                           $SIS_data .= ",'".$Fecha."'";              }else{$SIS_data .= ",''";}
				if(isset($Dia) && $Dia!=''){                               $SIS_data .= ",'".$Dia."'";                }else{$SIS_data .= ",''";}
				if(isset($idMes) && $idMes!=''){                           $SIS_data .= ",'".$idMes."'";              }else{$SIS_data .= ",''";}
				if(isset($Ano) && $Ano!=''){                               $SIS_data .= ",'".$Ano."'";                }else{$SIS_data .= ",''";}
				if(isset($Observaciones) && $Observaciones!=''){           $SIS_data .= ",'".$Observaciones."'";      }else{$SIS_data .= ",''";}
				if(isset($fCreacion) && $fCreacion!=''){                   $SIS_data .= ",'".$fCreacion."'";          }else{$SIS_data .= ",''";}
				if(isset($intAnual) && $intAnual!=''){                     $SIS_data .= ",'".$intAnual."'";           }else{$SIS_data .= ",''";}
				if(isset($idOpcionesInteres) && $idOpcionesInteres!=''){   $SIS_data .= ",'".$idOpcionesInteres."'";  }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idUsuario, Fecha, Dia, idMes, Ano, Observaciones, fCreacion, intAnual, idOpcionesInteres';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_facturacion_listado', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){

					if (isset($_SESSION['Facturacion_clientes'])){

						//contador
						$Cuenta_correcto = 0;

						//Ejecuto el resto del codigo
						foreach ($_SESSION['Facturacion_clientes'] as $key => $client){

							if(isset($idSistema) && $idSistema!=''){                                                           $SIS_data  = "'".$idSistema."'";                               }else{$SIS_data  = "''";}
							if(isset($idUsuario) && $idUsuario!=''){                                                           $SIS_data .= ",'".$idUsuario."'";                              }else{$SIS_data .= ",''";}
							$SIS_data .= ",'".$ultimo_id."'";
							if(isset($Fecha) && $Fecha!=''){                                                                   $SIS_data .= ",'".$Fecha."'";                                  }else{$SIS_data .= ",''";}
							if(isset($Dia) && $Dia!=''){                                                                       $SIS_data .= ",'".$Dia."'";                                    }else{$SIS_data .= ",''";}
							if(isset($idMes) && $idMes!=''){                                                                   $SIS_data .= ",'".$idMes."'";                                  }else{$SIS_data .= ",''";}
							if(isset($Ano) && $Ano!=''){                                                                       $SIS_data .= ",'".$Ano."'";                                    }else{$SIS_data .= ",''";}
							if(isset($client['idCliente']) && $client['idCliente']!=''){                                       $SIS_data .= ",'".$client['idCliente']."'";                    }else{$SIS_data .= ",''";}
							if(isset($client['ClienteNombre']) && $client['ClienteNombre']!=''){                               $SIS_data .= ",'".$client['ClienteNombre']."'";                }else{$SIS_data .= ",''";}
							if(isset($client['ClienteDireccion']) && $client['ClienteDireccion']!=''){                         $SIS_data .= ",'".$client['ClienteDireccion']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['ClienteIdentificador']) && $client['ClienteIdentificador']!=''){                 $SIS_data .= ",'".$client['ClienteIdentificador']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['ClienteNombreComuna']) && $client['ClienteNombreComuna']!=''){                   $SIS_data .= ",'".$client['ClienteNombreComuna']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['ClienteFechaVencimiento']) && $client['ClienteFechaVencimiento']!=''){           $SIS_data .= ",'".$client['ClienteFechaVencimiento']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['ClienteEstado']) && $client['ClienteEstado']!=''){                               $SIS_data .= ",'".$client['ClienteEstado']."'";                }else{$SIS_data .= ",''";}
							if(isset($client['DetalleCargoFijoValor']) && $client['DetalleCargoFijoValor']!=''){               $SIS_data .= ",'".$client['DetalleCargoFijoValor']."'";        }else{$SIS_data .= ",''";}
							if(isset($client['DetalleConsumoCantidad']) && $client['DetalleConsumoCantidad']!=''){             $SIS_data .= ",'".$client['DetalleConsumoCantidad']."'";       }else{$SIS_data .= ",''";}
							if(isset($client['DetalleConsumoValor']) && $client['DetalleConsumoValor']!=''){                   $SIS_data .= ",'".$client['DetalleConsumoValor']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['DetalleRecoleccionCantidad']) && $client['DetalleRecoleccionCantidad']!=''){     $SIS_data .= ",'".$client['DetalleRecoleccionCantidad']."'";   }else{$SIS_data .= ",''";}
							if(isset($client['DetalleRecoleccionValor']) && $client['DetalleRecoleccionValor']!=''){           $SIS_data .= ",'".$client['DetalleRecoleccionValor']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetalleVisitaCorte']) && $client['DetalleVisitaCorte']!=''){                     $SIS_data .= ",'".$client['DetalleVisitaCorte']."'";           }else{$SIS_data .= ",''";}
							if(isset($client['DetalleCorte1Valor']) && $client['DetalleCorte1Valor']!=''){                     $SIS_data .= ",'".$client['DetalleCorte1Valor']."'";           }else{$SIS_data .= ",''";}
							if(isset($client['DetalleCorte1Fecha']) && $client['DetalleCorte1Fecha']!=''){                     $SIS_data .= ",'".$client['DetalleCorte1Fecha']."'";           }else{$SIS_data .= ",''";}
							if(isset($client['DetalleCorte2Valor']) && $client['DetalleCorte2Valor']!=''){                     $SIS_data .= ",'".$client['DetalleCorte2Valor']."'";           }else{$SIS_data .= ",''";}
							if(isset($client['DetalleCorte2Fecha']) && $client['DetalleCorte2Fecha']!=''){                     $SIS_data .= ",'".$client['DetalleCorte2Fecha']."'";           }else{$SIS_data .= ",''";}
							if(isset($client['DetalleReposicion1Valor']) && $client['DetalleReposicion1Valor']!=''){           $SIS_data .= ",'".$client['DetalleReposicion1Valor']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetalleReposicion1Fecha']) && $client['DetalleReposicion1Fecha']!=''){           $SIS_data .= ",'".$client['DetalleReposicion1Fecha']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetalleReposicion2Valor']) && $client['DetalleReposicion2Valor']!=''){           $SIS_data .= ",'".$client['DetalleReposicion2Valor']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetalleReposicion2Fecha']) && $client['DetalleReposicion2Fecha']!=''){           $SIS_data .= ",'".$client['DetalleReposicion2Fecha']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetalleSubtotalServicio']) && $client['DetalleSubtotalServicio']!=''){           $SIS_data .= ",'".$client['DetalleSubtotalServicio']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetalleInteresDeuda']) && $client['DetalleInteresDeuda']!=''){                   $SIS_data .= ",'".$client['DetalleInteresDeuda']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos1Texto']) && $client['DetalleOtrosCargos1Texto']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos1Texto']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos2Texto']) && $client['DetalleOtrosCargos2Texto']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos2Texto']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos3Texto']) && $client['DetalleOtrosCargos3Texto']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos3Texto']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos4Texto']) && $client['DetalleOtrosCargos4Texto']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos4Texto']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos5Texto']) && $client['DetalleOtrosCargos5Texto']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos5Texto']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos1Valor']) && $client['DetalleOtrosCargos1Valor']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos1Valor']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos2Valor']) && $client['DetalleOtrosCargos2Valor']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos2Valor']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos3Valor']) && $client['DetalleOtrosCargos3Valor']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos3Valor']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos4Valor']) && $client['DetalleOtrosCargos4Valor']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos4Valor']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos5Valor']) && $client['DetalleOtrosCargos5Valor']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos5Valor']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos1Fecha']) && $client['DetalleOtrosCargos1Fecha']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos1Fecha']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos2Fecha']) && $client['DetalleOtrosCargos2Fecha']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos2Fecha']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos3Fecha']) && $client['DetalleOtrosCargos3Fecha']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos3Fecha']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos4Fecha']) && $client['DetalleOtrosCargos4Fecha']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos4Fecha']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleOtrosCargos5Fecha']) && $client['DetalleOtrosCargos5Fecha']!=''){         $SIS_data .= ",'".$client['DetalleOtrosCargos5Fecha']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetalleTotalVenta']) && $client['DetalleTotalVenta']!=''){                       $SIS_data .= ",'".$client['DetalleTotalVenta']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['DetalleSaldoFavor']) && $client['DetalleSaldoFavor']!=''){                       $SIS_data .= ",'".$client['DetalleSaldoFavor']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['DetalleSaldoAnterior']) && $client['DetalleSaldoAnterior']!=''){                 $SIS_data .= ",'".$client['DetalleSaldoAnterior']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['DetalleTotalAPagar']) && $client['DetalleTotalAPagar']!=''){                     $SIS_data .= ",'".$client['DetalleTotalAPagar']."'";           }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes1Valor']) && $client['GraficoMes1Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes1Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes2Valor']) && $client['GraficoMes2Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes2Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes3Valor']) && $client['GraficoMes3Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes3Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes4Valor']) && $client['GraficoMes4Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes4Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes5Valor']) && $client['GraficoMes5Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes5Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes6Valor']) && $client['GraficoMes6Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes6Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes7Valor']) && $client['GraficoMes7Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes7Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes8Valor']) && $client['GraficoMes8Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes8Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes9Valor']) && $client['GraficoMes9Valor']!=''){                         $SIS_data .= ",'".$client['GraficoMes9Valor']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes10Valor']) && $client['GraficoMes10Valor']!=''){                       $SIS_data .= ",'".$client['GraficoMes10Valor']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes11Valor']) && $client['GraficoMes11Valor']!=''){                       $SIS_data .= ",'".$client['GraficoMes11Valor']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes12Valor']) && $client['GraficoMes12Valor']!=''){                       $SIS_data .= ",'".$client['GraficoMes12Valor']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes1Fecha']) && $client['GraficoMes1Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes1Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes2Fecha']) && $client['GraficoMes2Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes2Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes3Fecha']) && $client['GraficoMes3Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes3Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes4Fecha']) && $client['GraficoMes4Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes4Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes5Fecha']) && $client['GraficoMes5Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes5Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes6Fecha']) && $client['GraficoMes6Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes6Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes7Fecha']) && $client['GraficoMes7Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes7Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes8Fecha']) && $client['GraficoMes8Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes8Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes9Fecha']) && $client['GraficoMes9Fecha']!=''){                         $SIS_data .= ",'".$client['GraficoMes9Fecha']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes10Fecha']) && $client['GraficoMes10Fecha']!=''){                       $SIS_data .= ",'".$client['GraficoMes10Fecha']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes11Fecha']) && $client['GraficoMes11Fecha']!=''){                       $SIS_data .= ",'".$client['GraficoMes11Fecha']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['GraficoMes12Fecha']) && $client['GraficoMes12Fecha']!=''){                       $SIS_data .= ",'".$client['GraficoMes12Fecha']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['DetConsMesAnteriorCantidad']) && $client['DetConsMesAnteriorCantidad']!=''){     $SIS_data .= ",'".$client['DetConsMesAnteriorCantidad']."'";   }else{$SIS_data .= ",''";}
							if(isset($client['DetConsMesAnteriorFecha']) && $client['DetConsMesAnteriorFecha']!=''){           $SIS_data .= ",'".$client['DetConsMesAnteriorFecha']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetConsMesActualCantidad']) && $client['DetConsMesActualCantidad']!=''){         $SIS_data .= ",'".$client['DetConsMesActualCantidad']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['DetConsMesActualFecha']) && $client['DetConsMesActualFecha']!=''){               $SIS_data .= ",'".$client['DetConsMesActualFecha']."'";        }else{$SIS_data .= ",''";}
							if(isset($client['DetConsMesDiferencia']) && $client['DetConsMesDiferencia']!=''){                 $SIS_data .= ",'".$client['DetConsMesDiferencia']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['DetConsProrateo']) && $client['DetConsProrateo']!=''){                           $SIS_data .= ",'".$client['DetConsProrateo']."'";              }else{$SIS_data .= ",''";}
							if(isset($client['DetConsProrateoSigno']) && $client['DetConsProrateoSigno']!=''){                 $SIS_data .= ",'".$client['DetConsProrateoSigno']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['DetConsMesTotalCantidad']) && $client['DetConsMesTotalCantidad']!=''){           $SIS_data .= ",'".$client['DetConsMesTotalCantidad']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetConsFechaProxLectura']) && $client['DetConsFechaProxLectura']!=''){           $SIS_data .= ",'".$client['DetConsFechaProxLectura']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['DetConsModalidad']) && $client['DetConsModalidad']!=''){                         $SIS_data .= ",'".$client['DetConsModalidad']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['DetConsFonoEmergencias']) && $client['DetConsFonoEmergencias']!=''){             $SIS_data .= ",'".$client['DetConsFonoEmergencias']."'";       }else{$SIS_data .= ",''";}
							if(isset($client['DetConsFonoConsultas']) && $client['DetConsFonoConsultas']!=''){                 $SIS_data .= ",'".$client['DetConsFonoConsultas']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfCargoFijo']) && $client['AguasInfCargoFijo']!=''){                       $SIS_data .= ",'".$client['AguasInfCargoFijo']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfMetroAgua']) && $client['AguasInfMetroAgua']!=''){                       $SIS_data .= ",'".$client['AguasInfMetroAgua']."'";            }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfMetroRecolecion']) && $client['AguasInfMetroRecolecion']!=''){           $SIS_data .= ",'".$client['AguasInfMetroRecolecion']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfVisitaCorte']) && $client['AguasInfVisitaCorte']!=''){                   $SIS_data .= ",'".$client['AguasInfVisitaCorte']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfCorte1']) && $client['AguasInfCorte1']!=''){                             $SIS_data .= ",'".$client['AguasInfCorte1']."'";               }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfCorte2']) && $client['AguasInfCorte2']!=''){                             $SIS_data .= ",'".$client['AguasInfCorte2']."'";               }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfReposicion1']) && $client['AguasInfReposicion1']!=''){                   $SIS_data .= ",'".$client['AguasInfReposicion1']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfReposicion2']) && $client['AguasInfReposicion2']!=''){                   $SIS_data .= ",'".$client['AguasInfReposicion2']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfFactorCobro']) && $client['AguasInfFactorCobro']!=''){                   $SIS_data .= ",'".$client['AguasInfFactorCobro']."'";          }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfDifMedGeneral']) && $client['AguasInfDifMedGeneral']!=''){               $SIS_data .= ",'".$client['AguasInfDifMedGeneral']."'";        }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfProcProrrateo']) && $client['AguasInfProcProrrateo']!=''){               $SIS_data .= ",'".$client['AguasInfProcProrrateo']."'";        }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfTipoMedicion']) && $client['AguasInfTipoMedicion']!=''){                 $SIS_data .= ",'".$client['AguasInfTipoMedicion']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfPuntoDiametro']) && $client['AguasInfPuntoDiametro']!=''){               $SIS_data .= ",'".$client['AguasInfPuntoDiametro']."'";        }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfClaveFacturacion']) && $client['AguasInfClaveFacturacion']!=''){         $SIS_data .= ",'".$client['AguasInfClaveFacturacion']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfClaveLectura']) && $client['AguasInfClaveLectura']!=''){                 $SIS_data .= ",'".$client['AguasInfClaveLectura']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfNumeroMedidor']) && $client['AguasInfNumeroMedidor']!=''){               $SIS_data .= ",'".$client['AguasInfNumeroMedidor']."'";        }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfFechaEmision']) && $client['AguasInfFechaEmision']!=''){                 $SIS_data .= ",'".$client['AguasInfFechaEmision']."'";         }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfUltimoPagoFecha']) && $client['AguasInfUltimoPagoFecha']!=''){           $SIS_data .= ",'".$client['AguasInfUltimoPagoFecha']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfUltimoPagoMonto']) && $client['AguasInfUltimoPagoMonto']!=''){           $SIS_data .= ",'".$client['AguasInfUltimoPagoMonto']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['AguasInfMovimientosHasta']) && $client['AguasInfMovimientosHasta']!=''){         $SIS_data .= ",'".$client['AguasInfMovimientosHasta']."'";     }else{$SIS_data .= ",''";}
							if(isset($client['idEstado']) && $client['idEstado']!=''){                                         $SIS_data .= ",'".$client['idEstado']."'";                     }else{$SIS_data .= ",''";}
							if(isset($client['intAnual']) && $client['intAnual']!=''){                                         $SIS_data .= ",'".$client['intAnual']."'";                     }else{$SIS_data .= ",''";}
							if(isset($client['idTipoPago']) && $client['idTipoPago']!=''){                                     $SIS_data .= ",'".$client['idTipoPago']."'";                   }else{$SIS_data .= ",''";}
							if(isset($client['nDocPago']) && $client['nDocPago']!=''){                                         $SIS_data .= ",'".$client['nDocPago']."'";                     }else{$SIS_data .= ",''";}
							if(isset($client['fechaPago']) && $client['fechaPago']!=''){                                       $SIS_data .= ",'".$client['fechaPago']."'";                    }else{$SIS_data .= ",''";}
							if(isset($client['DiaPago']) && $client['DiaPago']!=''){                                           $SIS_data .= ",'".$client['DiaPago']."'";                      }else{$SIS_data .= ",''";}
							if(isset($client['idMesPago']) && $client['idMesPago']!=''){                                       $SIS_data .= ",'".$client['idMesPago']."'";                    }else{$SIS_data .= ",''";}
							if(isset($client['AnoPago']) && $client['AnoPago']!=''){                                           $SIS_data .= ",'".$client['AnoPago']."'";                      }else{$SIS_data .= ",''";}
							if(isset($client['montoPago']) && $client['montoPago']!=''){                                       $SIS_data .= ",'".$client['montoPago']."'";                    }else{$SIS_data .= ",''";}
							if(isset($client['idUsuarioPago']) && $client['idUsuarioPago']!=''){                               $SIS_data .= ",'".$client['idUsuarioPago']."'";                }else{$SIS_data .= ",''";}
							if(isset($client['idPago']) && $client['idPago']!=''){                                             $SIS_data .= ",'".$client['idPago']."'";                       }else{$SIS_data .= ",''";}
							if(isset($client['rem_cantidad']) && $client['rem_cantidad']!=''){                                 $SIS_data .= ",'".$client['rem_cantidad']."'";                 }else{$SIS_data .= ",''";}
							if(isset($client['rem_porcentaje']) && $client['rem_porcentaje']!=''){                             $SIS_data .= ",'".$client['rem_porcentaje']."'";               }else{$SIS_data .= ",''";}
							if(isset($client['rem_negative']) && $client['rem_negative']!=''){                                 $SIS_data .= ",'".$client['rem_negative']."'";                 }else{$SIS_data .= ",''";}
							if(isset($client['rem_modalidad']) && $client['rem_modalidad']!=''){                               $SIS_data .= ",'".$client['rem_modalidad']."'";                }else{$SIS_data .= ",''";}
							if(isset($client['rem_diferencia']) && $client['rem_diferencia']!=''){                             $SIS_data .= ",'".$client['rem_diferencia']."'";               }else{$SIS_data .= ",''";}
							if(isset($client['SII_idFacturable']) && $client['SII_idFacturable']!=''){                         $SIS_data .= ",'".$client['SII_idFacturable']."'";             }else{$SIS_data .= ",''";}
							if(isset($client['SII_NDoc']) && $client['SII_NDoc']!=''){                                         $SIS_data .= ",'".$client['SII_NDoc']."'";                     }else{$SIS_data .= ",''";}
							if(isset($client['NombreArchivo']) && $client['NombreArchivo']!=''){                               $SIS_data .= ",'".$client['NombreArchivo']."'";                }else{$SIS_data .= ",''";}

							// inserto los datos de registro en la db
							$SIS_columns = 'idSistema,idUsuario, idFacturacion,Fecha,Dia,idMes,Ano,idCliente,
							ClienteNombre,ClienteDireccion, ClienteIdentificador,ClienteNombreComuna,ClienteFechaVencimiento,
							ClienteEstado, DetalleCargoFijoValor,DetalleConsumoCantidad,DetalleConsumoValor,
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
							SII_idFacturable,SII_NDoc,NombreArchivo';
							$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_facturacion_listado_detalle', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

							//Si ejecuto correctamente la consulta
							if($ultimo_id!=0){
								$Cuenta_correcto++;
							}

						}

						///////////////////////////////////////////////////////////////////////////////////////
						//se actualizael estado de la facturacion si se ejecuta correctamente
						if(isset($Cuenta_correcto)&&$Cuenta_correcto!=0){
							$SIS_data = "idFacturado='2'";
							if(isset($ultimo_id) && $ultimo_id!=''){  $SIS_data .= ",idFacturacion='".$ultimo_id."'";}
							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_datos_detalle', 'aguas_mediciones_datos_detalle.idSistema = '.$idSistema.' AND aguas_mediciones_datos_detalle.Ano = '.$Ano.' AND aguas_mediciones_datos_detalle.idMes = '.$idMes.' AND aguas_mediciones_datos_detalle.idFacturacion=0', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

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

			//verifico si se envia un entero
			if((!validarNumero($_GET['del']) OR !validaEntero($_GET['del']))&&$_GET['del']!=''){
				$indice = simpleDecode($_GET['del'], fecha_actual());
			}else{
				$indice = $_GET['del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );

			}

			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}

			if($errorn==0){

				//se actualizan los datos
				$SIS_data = "idFacturacion`='0'" ;
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_datos_detalle', 'idFacturacion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//borro los datos
				$resultado_1 = db_delete_data (false, 'aguas_facturacion_listado', 'idFacturacion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'aguas_facturacion_listado_detalle', 'idFacturacion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado_1==true OR $resultado_2==true){

					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;

				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}

		break;
/*******************************************************************************************************************/
		case 'updt_boleta':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			if (isset($NClientes)&&$NClientes!=0){
				//recorro
				for ($i = 1; $i <= $NClientes; $i++) {
					//variables
					$ndata_1 = 0;
					//Se verifica si el dato existe
					if(isset($idSistema)&& $idSistema != ''&&isset($arrPostClientes[$i]['SII_NDoc']) && $arrPostClientes[$i]['SII_NDoc'] != ''&&isset($arrPostClientes[$i]['idFacturacionDetalle'])&& $arrPostClientes[$i]['idFacturacionDetalle']!=''){
						$ndata_1    = db_select_nrows (false, 'SII_NDoc', 'aguas_facturacion_listado_detalle', '', "SII_NDoc = '".$arrPostClientes[$i]['SII_NDoc']."' AND idFacturacionDetalle != '".$arrPostClientes[$i]['idFacturacionDetalle']."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}
					//generacion de errores
					if($ndata_1 > 0) { $error['ndata_'.$i] = 'error/La Boleta '.$arrPostClientes[$i]['SII_NDoc'].' ya existe en el sistema';}
				}
			}else{
				$error['clientes'] = 'error/No hay clientes ingresados';
			}
			/*******************************************************************/
			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				/*******************************************************************/
				if (isset($NClientes)&&$NClientes!=0){
					//Variables
					$n_apro = 0;
					//recorro
					for ($i = 1; $i <= $NClientes; $i++) {
						if(isset($arrPostClientes[$i]['SII_NDoc'])&&$arrPostClientes[$i]['SII_NDoc']!=''){
							//Filtros
							$SIS_data = "idFacturacionDetalle='".$arrPostClientes[$i]['idFacturacionDetalle']."'";
							if(isset($arrPostClientes[$i]['SII_NDoc']) && $arrPostClientes[$i]['SII_NDoc']!=''){
								$SIS_data .= ",SII_NDoc='".$arrPostClientes[$i]['SII_NDoc']."'";
							}

							//se actualizan los datos
							$resultado = db_update_data (false, $SIS_data, 'aguas_facturacion_listado_detalle', 'idFacturacionDetalle = "'.$arrPostClientes[$i]['idFacturacionDetalle'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){

								$n_apro++;

							}
						}
					}

					//si hay al menos un dato actualizado correctamente
					if($n_apro!=0){
						//redirijo a la vista
						header( 'Location: '.$location.'&view=true' );
						die;
					}
				}
			}

		break;
/*******************************************************************************************************************/
	}
?>
