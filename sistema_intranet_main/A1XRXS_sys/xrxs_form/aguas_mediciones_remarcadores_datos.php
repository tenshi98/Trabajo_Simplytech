<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-020).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idDatos']))                   $idDatos                   = $_POST['idDatos'];
	if (!empty($_POST['idSistema']))                 $idSistema                 = $_POST['idSistema'];
	if (!empty($_POST['idUsuario']))                 $idUsuario                 = $_POST['idUsuario'];
	if (!empty($_POST['Fecha']))                     $Fecha                     = $_POST['Fecha'];
	if (!empty($_POST['Dia']))                       $Dia                       = $_POST['Dia'];
	if (!empty($_POST['idMes']))                     $idMes                     = $_POST['idMes'];
	if (!empty($_POST['Ano']))                       $Ano                       = $_POST['Ano'];
	if (!empty($_POST['Nombre']))                    $Nombre                    = $_POST['Nombre'];
	if (!empty($_POST['Observaciones']))             $Observaciones             = $_POST['Observaciones'];
	if (!empty($_POST['fCreacion']))                 $fCreacion                 = $_POST['fCreacion'];
	if (!empty($_POST['idTipo']))                    $idTipo                    = $_POST['idTipo'];
	if (!empty($_POST['idTipoMedicion']))            $idTipoMedicion            = $_POST['idTipoMedicion'];
	if (!empty($_POST['idMarcadoresUsado']))         $idMarcadoresUsado         = $_POST['idMarcadoresUsado'];
	if (!empty($_POST['ConsumoMedidor']))            $ConsumoMedidor            = $_POST['ConsumoMedidor'];

	if (!empty($_POST['idCliente']))                 $idCliente                 = $_POST['idCliente'];
	if (!empty($_POST['idTipoMedicion']))            $idTipoMedicion            = $_POST['idTipoMedicion'];

	if (!empty($_POST['idDatosDetalle']))            $idDatosDetalle            = $_POST['idDatosDetalle'];
	if (!empty($_POST['Consumo']))                   $Consumo                   = $_POST['Consumo'];

	if (!empty($_POST['NClientes'])){
		$NClientes  = $_POST['NClientes'];
		//recorro
		$arrPostClientes = array();
		for ($i = 1; $i <= $NClientes; $i++) {
			if (!empty($_POST['Consumo_'.$i])){          $arrPostClientes[$i]['Consumo']          = $_POST['Consumo_'.$i];}
			if (!empty($_POST['idMarcadores_'.$i])){     $arrPostClientes[$i]['idMarcadores']     = $_POST['idMarcadores_'.$i];}
			if (!empty($_POST['idRemarcadores_'.$i])){   $arrPostClientes[$i]['idRemarcadores']   = $_POST['idRemarcadores_'.$i];}
			if (!empty($_POST['idCliente_'.$i])){        $arrPostClientes[$i]['idCliente']        = $_POST['idCliente_'.$i];}
			if (!empty($_POST['Cliente_'.$i])){          $arrPostClientes[$i]['Cliente']          = $_POST['Cliente_'.$i];}
			if (!empty($_POST['Marcadores_'.$i])){       $arrPostClientes[$i]['Marcadores']       = $_POST['Marcadores_'.$i];}
			if (!empty($_POST['Remarcadores_'.$i])){     $arrPostClientes[$i]['Remarcadores']     = $_POST['Remarcadores_'.$i];}

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
			case 'idDatos':              if(empty($idDatos)){               $error['idDatos']                 = 'error/No ha ingresado el id';}break;
			case 'idSistema':            if(empty($idSistema)){             $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':            if(empty($idUsuario)){             $error['idUsuario']               = 'error/No ha seleccionado el usuario';}break;
			case 'Fecha':                if(empty($Fecha)){                 $error['Fecha']                   = 'error/No ha ingresado la fecha de facturacion';}break;
			case 'Dia':                  if(empty($Dia)){                   $error['Dia']                     = 'error/No ha ingresado el dia de facturacion';}break;
			case 'idMes':                if(empty($idMes)){                 $error['idMes']                   = 'error/No ha ingresado el mes de facturacion';}break;
			case 'Ano':                  if(empty($Ano)){                   $error['Ano']                     = 'error/No ha ingresado el año de facturacion';}break;
			case 'Nombre':               if(empty($Nombre)){                $error['Nombre']                  = 'error/No ha ingresado el nombre de la facturacion';}break;
			case 'Observaciones':        if(empty($Observaciones)){         $error['Observaciones']           = 'error/No ha ingresado la Observacion';}break;
			case 'fCreacion':            if(empty($fCreacion)){             $error['fCreacion']               = 'error/No ha ingresado la fecha de creación';}break;
			case 'idTipo':               if(empty($idTipo)){                $error['idTipo']                  = 'error/No ha seleccionado el tipo';}break;
			case 'idTipoMedicion':       if(empty($idTipoMedicion)){        $error['idTipoMedicion']          = 'error/No ha seleccionado el tipo de medicion';}break;
			case 'idMarcadoresUsado':    if(empty($idMarcadoresUsado)){     $error['idMarcadoresUsado']       = 'error/No ha seleccionado el Tipo de marcador usado';}break;
			case 'ConsumoMedidor':       if(empty($ConsumoMedidor)){        $error['ConsumoMedidor']          = 'error/No ha ingresado el consumo del medidor';}break;

			case 'idCliente':            if(empty($idCliente)){             $error['idCliente']               = 'error/No ha seleccionado el cliente';}break;
			case 'idTipoMedicion':       if(empty($idTipoMedicion)){        $error['idTipoMedicion']          = 'error/No ha seleccionado el tipo de medicion';}break;

			case 'idDatosDetalle':       if(empty($idDatosDetalle)){        $error['idDatosDetalle']          = 'error/No ha ingresado el id del medidor';}break;
			case 'Consumo':              if(empty($Consumo)){               $error['Consumo']                 = 'error/No ha ingresado el consumo del remarcador';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Ano) && $Ano!=''){                       $Ano            = EstandarizarInput($Ano);}
	if(isset($Nombre) && $Nombre!=''){                 $Nombre         = EstandarizarInput($Nombre);}
	if(isset($Observaciones) && $Observaciones!=''){   $Observaciones  = EstandarizarInput($Observaciones);}
	if(isset($ConsumoMedidor) && $ConsumoMedidor!=''){ $ConsumoMedidor = EstandarizarInput($ConsumoMedidor);}
	if(isset($Consumo) && $Consumo!=''){               $Consumo        = EstandarizarInput($Consumo);}

/*******************************************************************************************************************/
/*                                        Verificación de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                $error['Nombre']        = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){  $error['Observaciones'] = 'error/Edita la Observacion, contiene palabras no permitidas';}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		case 'new_rem':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Fecha) && $Fecha != ''&&isset($idSistema)&& $idSistema != ''&&isset($idCliente)&& $idCliente!=''){
				$idMes   = fecha2NMes($Fecha);
				$Ano     = fecha2Ano($Fecha);
				$SIS_query = 'aguas_clientes_listado.identificador,aguas_clientes_listado.Nombre,aguas_clientes_listado.idMarcadores,aguas_marcadores_listado.Nombre AS Marcador';
				$SIS_join  = 'LEFT JOIN `aguas_marcadores_listado` ON aguas_marcadores_listado.idMarcadores = aguas_clientes_listado.idMarcadores';
				$SIS_where = 'idCliente = '.$idCliente;
				$rowCliente = db_select_data (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$ndata_1    = db_select_nrows (false, 'idDatos', 'aguas_mediciones_datos', '', "idMes = '".$idMes."' AND Ano = '".$Ano."' AND idSistema='".$idSistema."' AND idTipo=1 AND idMarcadoresUsado='".$rowCliente['idMarcadores']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($rowCliente['idMarcadores'])&&$rowCliente['idMarcadores']!=''&&isset($Fecha) && $Fecha!=''){
				$idMes      = fecha2NMes($Fecha);
				$Ano        = fecha2Ano($Fecha);
				$SIS_idMes  = $idMes-1;
				$SIS_Ano    = $Ano;
				if($SIS_idMes==0){
					$SIS_idMes  = 12;
					$SIS_Ano  = $SIS_Ano-1;
				}
				$SIS_query = "aguas_mediciones_datos_detalle.idMarcadores, aguas_mediciones_datos_detalle.Consumo,(SELECT Consumo FROM aguas_mediciones_datos_detalle WHERE idMarcadores='".$rowCliente['idMarcadores']."' AND idRemarcadores = 0 AND idMes='".$SIS_idMes."' AND Ano='".$SIS_Ano."' ORDER BY Ano DESC, idMes DESC LIMIT 1 ) AS MedicionAnterior";
				$SIS_where = "idMarcadores='".$rowCliente['idMarcadores']."' AND idRemarcadores = 0 AND idMes='".$idMes."' AND Ano='".$Ano."'";
				//consulto
				$ndata_2     = db_select_nrows (false, $SIS_query, 'aguas_mediciones_datos_detalle', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$rowMedicion = db_select_data (false, $SIS_query, 'aguas_mediciones_datos_detalle', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) { $error['ndata_1'] = 'error/La Medicion ya existe en el sistema';}
			if($ndata_2==0) {  $error['ndata_2'] = 'error/El Medidor seleccionado no posee mediciones en el periodo';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				unset($_SESSION['rem_basicos']);
				unset($_SESSION['rem_clientes']);

				//Se guardan los datos basicos del formulario recien llenado
				if(isset($Fecha)){
					$idMes   = fecha2NMes($Fecha);
					$Ano     = fecha2Ano($Fecha);
					$_SESSION['rem_basicos']['Fecha']  = $Fecha;
					$_SESSION['rem_basicos']['Nombre'] = 'Facturación mes '.fecha2NombreMes($Fecha).' '.fecha2Ano($Fecha).' Cliente '.$rowCliente['Nombre'];
				}else{
					$_SESSION['rem_basicos']['Fecha']  = '';
					$_SESSION['rem_basicos']['Nombre'] = '';
				}
				if(isset($idCliente)){                    $_SESSION['rem_basicos']['idCliente']             = $idCliente;                     }else{$_SESSION['rem_basicos']['idCliente']            = '';}
				if(isset($idTipoMedicion)){               $_SESSION['rem_basicos']['idTipoMedicion']        = $idTipoMedicion;                }else{$_SESSION['rem_basicos']['idTipoMedicion']       = '';}
				if(isset($Observaciones)){                $_SESSION['rem_basicos']['Observaciones']         = $Observaciones;                 }else{$_SESSION['rem_basicos']['Observaciones']        = 'Sin Observaciones';}
				if(isset($idSistema)){                    $_SESSION['rem_basicos']['idSistema']             = $idSistema;                     }else{$_SESSION['rem_basicos']['idSistema']            = '';}
				if(isset($idUsuario)){                    $_SESSION['rem_basicos']['idUsuario']             = $idUsuario;                     }else{$_SESSION['rem_basicos']['idUsuario']            = '';}
				if(isset($rowCliente['Nombre'])){         $_SESSION['rem_basicos']['ClienteNombre']         = $rowCliente['Nombre'];          }else{$_SESSION['rem_basicos']['ClienteNombre']        = '';}
				if(isset($rowCliente['identificador'])){  $_SESSION['rem_basicos']['ClienteIdentificador']  = $rowCliente['identificador'];   }else{$_SESSION['rem_basicos']['ClienteIdentificador'] = '';}
				if(isset($rowCliente['Marcador'])){       $_SESSION['rem_basicos']['ClienteMarcador']       = $rowCliente['Marcador'];        }else{$_SESSION['rem_basicos']['ClienteMarcador']      = '';}
				if(isset($rowCliente['idMarcadores'])){   $_SESSION['rem_basicos']['idMarcadores']          = $rowCliente['idMarcadores'];    }else{$_SESSION['rem_basicos']['idMarcadores']         = '';}
				if(isset($rowMedicion['Consumo'])&&isset($rowMedicion['MedicionAnterior'])){
					$_SESSION['rem_basicos']['Consumo'] = ($rowMedicion['Consumo'] - $rowMedicion['MedicionAnterior']);
				}else{
					$_SESSION['rem_basicos']['Consumo'] = '';
				}

				/********************************************************************************/
				if(isset($idUsuario) && $idUsuario!=''){
					// consulto los datos
					$rowData = db_select_data (false, 'Nombre', 'usuarios_listado', '', 'idUsuario = "'.$idUsuario.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['rem_basicos']['Usuario'] = $rowData['Nombre'];
				}else{
					$_SESSION['rem_basicos']['Usuario'] = '';
				}

				/********************************************************************************/
				if(isset($idTipoMedicion) && $idTipoMedicion!=''){
					// consulto los datos
					$rowData = db_select_data (false, 'Nombre', 'aguas_mediciones_datos_tipo_medicion', '', 'idTipoMedicion = "'.$idTipoMedicion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['rem_basicos']['TipoMedicion'] = $rowData['Nombre'];
				}else{
					$_SESSION['rem_basicos']['TipoMedicion'] = '';
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
			unset($_SESSION['rem_basicos']);
			unset($_SESSION['rem_clientes']);

			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/
		case 'modBase':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Fecha) && $Fecha != ''&&isset($idSistema)&& $idSistema != ''&&isset($idCliente)&& $idCliente!=''){
				$idMes   = fecha2NMes($Fecha);
				$Ano     = fecha2Ano($Fecha);
				$SIS_query = 'aguas_clientes_listado.identificador,aguas_clientes_listado.Nombre,aguas_clientes_listado.idMarcadores,aguas_marcadores_listado.Nombre AS Marcador';
				$SIS_join  = 'LEFT JOIN `aguas_marcadores_listado` ON aguas_marcadores_listado.idMarcadores = aguas_clientes_listado.idMarcadores';
				$SIS_where = 'idCliente = '.$idCliente;
				$rowCliente = db_select_data (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$ndata_1    = db_select_nrows (false, 'idDatos', 'aguas_mediciones_datos', '', "idMes = '".$idMes."' AND Ano = '".$Ano."' AND idSistema='".$idSistema."' AND idTipo=1 AND idMarcadoresUsado='".$rowCliente['idMarcadores']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($rowCliente['idMarcadores'])&&$rowCliente['idMarcadores']!=''&&isset($Fecha) && $Fecha!=''){
				$idMes      = fecha2NMes($Fecha);
				$Ano        = fecha2Ano($Fecha);
				$SIS_idMes  = $idMes-1;
				$SIS_Ano    = $Ano;
				if($SIS_idMes==0){
					$SIS_idMes  = 12;
					$SIS_Ano  = $SIS_Ano-1;
				}
				$SIS_query = "aguas_mediciones_datos_detalle.idMarcadores, aguas_mediciones_datos_detalle.Consumo,(SELECT Consumo FROM aguas_mediciones_datos_detalle WHERE idMarcadores='".$rowCliente['idMarcadores']."' AND idRemarcadores = 0 AND idMes='".$SIS_idMes."' AND Ano='".$SIS_Ano."' ORDER BY Ano DESC, idMes DESC LIMIT 1 ) AS MedicionAnterior";
				$SIS_where = "idMarcadores='".$rowCliente['idMarcadores']."' AND idRemarcadores = 0 AND idMes='".$idMes."' AND Ano='".$Ano."'";
				//consulto
				$ndata_2     = db_select_nrows (false, $SIS_query, 'aguas_mediciones_datos_detalle', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$rowMedicion = db_select_data (false, $SIS_query, 'aguas_mediciones_datos_detalle', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) { $error['ndata_1'] = 'error/La Medicion ya existe en el sistema';}
			if($ndata_2==0) {  $error['ndata_2'] = 'error/El Medidor seleccionado no posee mediciones en el periodo';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				unset($_SESSION['rem_basicos']);
				unset($_SESSION['rem_clientes']);

				//Se guardan los datos basicos del formulario recien llenado
				if(isset($Fecha)){
					$idMes   = fecha2NMes($Fecha);
					$Ano     = fecha2Ano($Fecha);
					$_SESSION['rem_basicos']['Fecha']  = $Fecha;
					$_SESSION['rem_basicos']['Nombre'] = 'Facturación mes '.fecha2NombreMes($Fecha).' '.fecha2Ano($Fecha).' Cliente '.$rowCliente['Nombre'];
				}else{
					$_SESSION['rem_basicos']['Fecha']  = '';
					$_SESSION['rem_basicos']['Nombre'] = '';
				}
				if(isset($idCliente)){                    $_SESSION['rem_basicos']['idCliente']             = $idCliente;                     }else{$_SESSION['rem_basicos']['idCliente']            = '';}
				if(isset($idTipoMedicion)){               $_SESSION['rem_basicos']['idTipoMedicion']        = $idTipoMedicion;                }else{$_SESSION['rem_basicos']['idTipoMedicion']       = '';}
				if(isset($Observaciones)){                $_SESSION['rem_basicos']['Observaciones']         = $Observaciones;                 }else{$_SESSION['rem_basicos']['Observaciones']        = 'Sin Observaciones';}
				if(isset($idSistema)){                    $_SESSION['rem_basicos']['idSistema']             = $idSistema;                     }else{$_SESSION['rem_basicos']['idSistema']            = '';}
				if(isset($idUsuario)){                    $_SESSION['rem_basicos']['idUsuario']             = $idUsuario;                     }else{$_SESSION['rem_basicos']['idUsuario']            = '';}
				if(isset($rowCliente['Nombre'])){         $_SESSION['rem_basicos']['ClienteNombre']         = $rowCliente['Nombre'];          }else{$_SESSION['rem_basicos']['ClienteNombre']        = '';}
				if(isset($rowCliente['identificador'])){  $_SESSION['rem_basicos']['ClienteIdentificador']  = $rowCliente['identificador'];   }else{$_SESSION['rem_basicos']['ClienteIdentificador'] = '';}
				if(isset($rowCliente['Marcador'])){       $_SESSION['rem_basicos']['ClienteMarcador']       = $rowCliente['Marcador'];        }else{$_SESSION['rem_basicos']['ClienteMarcador']      = '';}
				if(isset($rowCliente['idMarcadores'])){   $_SESSION['rem_basicos']['idMarcadores']          = $rowCliente['idMarcadores'];    }else{$_SESSION['rem_basicos']['idMarcadores']         = '';}
				if(isset($rowMedicion['Consumo'])&&isset($rowMedicion['MedicionAnterior'])){
					$_SESSION['rem_basicos']['Consumo'] = ($rowMedicion['Consumo'] - $rowMedicion['MedicionAnterior']);
				}else{
					$_SESSION['rem_basicos']['Consumo'] = '';
				}

				/********************************************************************************/
				if(isset($idUsuario) && $idUsuario!=''){
					// consulto los datos
					$rowData = db_select_data (false, 'Nombre', 'usuarios_listado', '', 'idUsuario = "'.$idUsuario.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['rem_basicos']['Usuario'] = $rowData['Nombre'];
				}else{
					$_SESSION['rem_basicos']['Usuario'] = '';
				}

				/********************************************************************************/
				if(isset($idTipoMedicion) && $idTipoMedicion!=''){
					// consulto los datos
					$rowData = db_select_data (false, 'Nombre', 'aguas_mediciones_datos_tipo_medicion', '', 'idTipoMedicion = "'.$idTipoMedicion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['rem_basicos']['TipoMedicion'] = $rowData['Nombre'];
				}else{
					$_SESSION['rem_basicos']['TipoMedicion'] = '';
				}

				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;

			}

		break;
/*******************************************************************************************************************/
		case 'add_client':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			if (isset($NClientes)&&$NClientes!=0){
				//recorro
				for ($i = 1; $i <= $NClientes; $i++) {
					//variables
					$ndata_1 = 0;
					//Se verifica si el dato existe
					if(isset($Fecha) && $Fecha != ''&&isset($idSistema)&& $idSistema != ''&&isset($arrPostClientes[$i]['idCliente'])&& $arrPostClientes[$i]['idCliente']!=''){
						$idMes   = fecha2NMes($Fecha);
						$Ano     = fecha2Ano($Fecha);
						$ndata_1    = db_select_nrows (false, 'idDatosDetalle', 'aguas_mediciones_datos_detalle', '', "idMes = '".$idMes."' AND Ano = '".$Ano."' AND idSistema='".$idSistema."' AND idCliente='".$arrPostClientes[$i]['idCliente']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}
					//generacion de errores
					if($ndata_1 > 0) { $error['ndata_'.$i] = 'error/La Medicion del cliente '.$arrPostClientes[$i]['Cliente'].' ya existe en el sistema';}
				}
			}else{
				$error['clientes'] = 'error/No hay clientes ingresados';
			}
			/*******************************************************************/
			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				/*******************************************************************/
				if (isset($NClientes)&&$NClientes!=0){
					//elimino datos antiguos
					unset($_SESSION['rem_clientes']);
					//Guardo el maximo
					$_SESSION['rem_basicos']['NClientes'] = $NClientes;
					//Guardo el consumo general
					$consumoGeneral = 0;
					//recorro
					for ($i = 1; $i <= $NClientes; $i++) {

						//Obtengo el consumo anterior
						$SIS_where = "idCliente = ".$arrPostClientes[$i]['idCliente']." ORDER BY Ano DESC, idMes DESC";
						//consulto
						$rowConsumoAnterior = db_select_data (false, 'Consumo', 'aguas_mediciones_datos_detalle', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

						//guardo puntero
						$_SESSION['rem_clientes'][$i]['idPoint'] = $i;
						//Basicos
						if(isset($arrPostClientes[$i]['idCliente'])){       $_SESSION['rem_clientes'][$i]['idCliente']       = $arrPostClientes[$i]['idCliente'];        }else{$_SESSION['rem_clientes'][$i]['idCliente']       = '';}
						if(isset($arrPostClientes[$i]['idMarcadores'])){    $_SESSION['rem_clientes'][$i]['idMarcadores']    = $arrPostClientes[$i]['idMarcadores'];     }else{$_SESSION['rem_clientes'][$i]['idMarcadores']    = '';}
						if(isset($arrPostClientes[$i]['idRemarcadores'])){  $_SESSION['rem_clientes'][$i]['idRemarcadores']  = $arrPostClientes[$i]['idRemarcadores'];   }else{$_SESSION['rem_clientes'][$i]['idRemarcadores']  = '';}
						if(isset($arrPostClientes[$i]['Consumo'])){         $_SESSION['rem_clientes'][$i]['Consumo']         = $arrPostClientes[$i]['Consumo'];          }else{$_SESSION['rem_clientes'][$i]['Consumo']         = '';}
						//Para mostrar
						if(isset($arrPostClientes[$i]['Cliente'])){         $_SESSION['rem_clientes'][$i]['Cliente']         = $arrPostClientes[$i]['Cliente'];          }else{$_SESSION['rem_clientes'][$i]['Cliente']         = '';}
						if(isset($arrPostClientes[$i]['Marcadores'])){      $_SESSION['rem_clientes'][$i]['Marcadores']      = $arrPostClientes[$i]['Marcadores'];       }else{$_SESSION['rem_clientes'][$i]['Marcadores']      = '';}
						if(isset($arrPostClientes[$i]['Remarcadores'])){    $_SESSION['rem_clientes'][$i]['Remarcadores']    = $arrPostClientes[$i]['Remarcadores'];     }else{$_SESSION['rem_clientes'][$i]['Remarcadores']    = '';}
						//actualizo el consumo general
						if(isset($arrPostClientes[$i]['Consumo'])){         $consumoGeneral = $consumoGeneral + ($arrPostClientes[$i]['Consumo'] - $rowConsumoAnterior['Consumo']);}
					}
					//Guardo el consumo general
					$_SESSION['rem_basicos']['consumoGeneral'] = $consumoGeneral;

					//redirijo a la vista
					header( 'Location: '.$location.'&view=true' );
					die;
				}
			}

		break;

/*******************************************************************************************************************/
		case 'del_cliente':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//borro cliente
			$idCliente = $_GET['del_cliente'];
			unset($_SESSION['rem_clientes'][$idCliente]);

			//actualizo los datos
			$NClientes      = 0;
			$consumoGeneral = 0;
			//recorro
			foreach ($_SESSION['rem_clientes'] as $key => $clientes){
				$consumoGeneral = $consumoGeneral + $clientes['Consumo'];
				$NClientes++;
			}
			//Guardo el maximo
			$_SESSION['rem_basicos']['NClientes']      = $NClientes;
			//Guardo el consumo general
			$_SESSION['rem_basicos']['consumoGeneral'] = $consumoGeneral;

			//redirijo a la vista
			header( 'Location: '.$location.'&view=true' );
			die;
		break;

/*******************************************************************************************************************/
		case 'ing_rem':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Datos basicos
			if (isset($_SESSION['rem_basicos'])){
				if(!isset($_SESSION['rem_basicos']['idSistema']) OR $_SESSION['rem_basicos']['idSistema']=='' ){             $error['idSistema']       = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['rem_basicos']['idUsuario']) OR $_SESSION['rem_basicos']['idUsuario']=='' ){             $error['idUsuario']       = 'error/No ha ingresado el usuario';}
				if(!isset($_SESSION['rem_basicos']['Fecha']) OR $_SESSION['rem_basicos']['Fecha']=='' ){                     $error['Fecha']           = 'error/No ha ingresado la fecha';}
				if(!isset($_SESSION['rem_basicos']['Nombre']) OR $_SESSION['rem_basicos']['Nombre']=='' ){                   $error['Nombre']          = 'error/No ha ingresado el nombre';}
				if(!isset($_SESSION['rem_basicos']['Observaciones']) OR $_SESSION['rem_basicos']['Observaciones']=='' ){     $error['Observaciones']   = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['rem_basicos']['idTipoMedicion']) OR $_SESSION['rem_basicos']['idTipoMedicion']=='' ){   $error['idTipoMedicion']  = 'error/No ha seleccionado el Tipo Medicion';}
				if(!isset($_SESSION['rem_basicos']['idMarcadores']) OR $_SESSION['rem_basicos']['idMarcadores']=='' ){       $error['idMarcadores']    = 'error/No ha seleccionado el Marcador';}
				//if(!isset($_SESSION['rem_basicos']['Consumo']) OR $_SESSION['rem_basicos']['Consumo']=='' ){                 $error['Consumo']         = 'error/No ha ingresado el Consumo';}
				if(!isset($_SESSION['rem_basicos']['NClientes']) OR $_SESSION['rem_basicos']['NClientes']=='' ){             $error['NClientes']       = 'error/No ha ingresado la cantidad de remarcadores';}
				//if(!isset($_SESSION['rem_basicos']['consumoGeneral']) OR $_SESSION['rem_basicos']['consumoGeneral']=='' ){   $error['consumoGeneral']  = 'error/No ha ingresado el consumo General';}

			}else{
				$error['rem_basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//clientes
			if (isset($_SESSION['rem_clientes'])){
				foreach ($_SESSION['rem_clientes'] as $key => $clientes){
					if(isset($clientes['Cliente'])&&$clientes['Cliente']!=''){
						if(!isset($clientes['idCliente']) OR $clientes['idCliente'] == ''){             $error['idCliente']       = 'error/No ha seleccionado un cliente';}
						if(!isset($clientes['idMarcadores']) OR $clientes['idMarcadores'] == ''){       $error['idMarcadores']    = 'error/No ha seleccionado un medidor';}
						if(!isset($clientes['idRemarcadores']) OR $clientes['idRemarcadores'] == ''){   $error['idRemarcadores']  = 'error/No ha seleccionado un remarcador';}
						if(!isset($clientes['Consumo']) OR $clientes['Consumo'] == ''){                 $error['Consumo']         = 'error/No ha ingresado un consumo';}
					}
				}
			}else{
				$error['clientes'] = 'error/No tiene clientes relacionados en el documento';
			}

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//se traspasan las variables
				$idSistema       = $_SESSION['rem_basicos']['idSistema'];
				$idUsuario       = $_SESSION['rem_basicos']['idUsuario'];
				$Fecha           = $_SESSION['rem_basicos']['Fecha'];
				$Nombre          = $_SESSION['rem_basicos']['Nombre'];
				$Observaciones   = $_SESSION['rem_basicos']['Observaciones'];
				$idTipoMedicion  = $_SESSION['rem_basicos']['idTipoMedicion'];
				$idMarcadores    = $_SESSION['rem_basicos']['idMarcadores'];
				$Consumo         = $_SESSION['rem_basicos']['Consumo'];
				$NClientes       = $_SESSION['rem_basicos']['NClientes'];
				$consumoGeneral  = $_SESSION['rem_basicos']['consumoGeneral'];

				//Creo el registro en la tabla madre
				if(isset($idSistema) && $idSistema!=''){   $SIS_data  = "'".$idSistema."'";   }else{$SIS_data  = "''";}
				if(isset($idUsuario) && $idUsuario!=''){   $SIS_data .= ",'".$idUsuario."'";  }else{$SIS_data .= ",''";}
				if(isset($Fecha) && $Fecha!=''){
					$SIS_data .= ",'".$Fecha."'";
					$SIS_data .= ",'".fecha2NdiaMes($Fecha)."'";
					$SIS_data .= ",'".fecha2NMes($Fecha)."'";
					$SIS_data .= ",'".fecha2Ano($Fecha)."'";
				}else{
					$SIS_data .= ",''";
					$SIS_data .= ",''";
					$SIS_data .= ",''";
					$SIS_data .= ",''";
				}
				if(isset($Nombre) && $Nombre!=''){               $SIS_data .= ",'".$Nombre."'";        }else{$SIS_data .= ",''";}
				if(isset($Observaciones) && $Observaciones!=''){ $SIS_data .= ",'".$Observaciones."'"; }else{$SIS_data .= ",''";}
				$SIS_data .=",'".fecha_actual()."'";
				$SIS_data .=",'2'";
				$SIS_data .= ",'".$idTipoMedicion."'";
				$SIS_data .= ",'".$idMarcadores."'";
				$SIS_data .= ",'".$Consumo."'";

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idUsuario, Fecha, Dia, idMes, Ano, Nombre,Observaciones, fCreacion, idTipo, idTipoMedicion, idMarcadoresUsado, ConsumoMedidor';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_datos', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){

					if (isset($_SESSION['rem_clientes'])){

						//Ejecuto el resto del codigo
						foreach ($_SESSION['rem_clientes'] as $key => $client){

							if(isset($idSistema) && $idSistema!=''){   $SIS_data  = "'".$idSistema."'";     }else{$SIS_data  = "''";}
							if(isset($idUsuario) && $idUsuario!=''){   $SIS_data .= ",'".$idUsuario."'";    }else{$SIS_data .= ",''";}
							$SIS_data .= ",'".$ultimo_id."'";
							if(isset($Fecha) && $Fecha!=''){
								$SIS_data .= ",'".$Fecha."'";
								$SIS_data .= ",'".fecha2NdiaMes($Fecha)."'";
								$SIS_data .= ",'".fecha2NMes($Fecha)."'";
								$SIS_data .= ",'".fecha2Ano($Fecha)."'";
							}else{
								$SIS_data .= ",''";
								$SIS_data .= ",''";
								$SIS_data .= ",''";
								$SIS_data .= ",''";
							}
							if(isset($client['idCliente']) && $client['idCliente']!=''){           $SIS_data .= ",'".$client['idCliente']."'";      }else{$SIS_data .= ",''";}
							if(isset($client['idMarcadores']) && $client['idMarcadores']!=''){     $SIS_data .= ",'".$client['idMarcadores']."'";   }else{$SIS_data .= ",''";}
							if(isset($client['idRemarcadores']) && $client['idRemarcadores']!=''){ $SIS_data .= ",'".$client['idRemarcadores']."'"; }else{$SIS_data .= ",''";}
							if(isset($client['Consumo']) && $client['Consumo']!=''){               $SIS_data .= ",'".$client['Consumo']."'";        }else{$SIS_data .= ",''";}
							$SIS_data .= ",''";                       //TipoMIU
							$SIS_data .= ",''";                       //MIU
							$SIS_data .= ",''";                       //Contador
							$SIS_data .= ",'1'";                     //idFacturado
							$SIS_data .= ",'0'";                     //idFacturacion
							$SIS_data .= ",'".fecha_actual()."'";     //fCreacion
							$SIS_data .= ",'1'";                     //idTipoFacturacion
							$SIS_data .= ",'1'";                     //idTipoLectura
							$SIS_data .= ",'".$idTipoMedicion."'";   //idTipoMedicion
							$SIS_data .= ",'".$idMarcadores."'";     //idMarcadoresUsado
							$SIS_data .= ",'".$Consumo."'";          //ConsumoMedidor
							$SIS_data .= ",'".$consumoGeneral."'";   //ConsumoGeneral
							$SIS_data .= ",'".$NClientes."'";        //CantRemarcadores

							// inserto los datos de registro en la db
							$SIS_columns = 'idSistema, idUsuario, idDatos, Fecha,
							Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, Consumo, TipoMIU, MIU, Contador,
							idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura, idTipoMedicion,
							idMarcadoresUsado, ConsumoMedidor, ConsumoGeneral, CantRemarcadores';
							$ultimo_id2 = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_datos_detalle', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

						}
					}
				}

				//borro todo
				unset($_SESSION['rem_basicos']);
				unset($_SESSION['rem_clientes']);

				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
			}

		break;
/*******************************************************************************************************************/
		case 'update':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//Obtengo el nombre del cliente
				$SIS_query = 'aguas_mediciones_datos.idMarcadoresUsado AS ID,(SELECT Nombre FROM `aguas_clientes_listado` WHERE idMarcadores = ID AND idFacturable = 3 LIMIT 1)AS ClienteNombre';
				$SIS_join  = '';
				$SIS_where = 'aguas_mediciones_datos.idDatos = '.$idDatos;
				$rowCliente = db_select_data (false, $SIS_query, 'aguas_mediciones_datos', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Filtros
				$SIS_data = "idDatos='".$idDatos."'";
				if(isset($idSistema) && $idSistema!=''){    $SIS_data .= ",idSistema='".$idSistema."'";}
				if(isset($idUsuario) && $idUsuario!=''){    $SIS_data .= ",idUsuario='".$idUsuario."'";}
				if(isset($Fecha) && $Fecha!=''){
					$SIS_data .= ",Fecha='".$Fecha."'";
					$SIS_data .= ",Dia='".fecha2NdiaMes($Fecha)."'";
					$SIS_data .= ",idMes='".fecha2NMes($Fecha)."'";
					$SIS_data .= ",Ano='".fecha2Ano($Fecha)."'";
					$SIS_data .= ",Nombre='Facturación mes ".fecha2NombreMes($Fecha)." ".fecha2Ano($Fecha)." Cliente ".$rowCliente['ClienteNombre']."'";
				}
				if(isset($Observaciones) && $Observaciones!=''){            $SIS_data .= ",Observaciones='".$Observaciones."'";}
				if(isset($fCreacion) && $fCreacion!=''){                    $SIS_data .= ",fCreacion='".$fCreacion."'";}
				if(isset($idTipo) && $idTipo!=''){                          $SIS_data .= ",idTipo='".$idTipo."'";}
				if(isset($idTipoMedicion) && $idTipoMedicion!=''){          $SIS_data .= ",idTipoMedicion='".$idTipoMedicion."'";}
				if(isset($idMarcadoresUsado) && $idMarcadoresUsado!=''){    $SIS_data .= ",idMarcadoresUsado='".$idMarcadoresUsado."'";}
				if(isset($ConsumoMedidor) && $ConsumoMedidor!=''){          $SIS_data .= ",ConsumoMedidor='".$ConsumoMedidor."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_datos', 'idDatos = "'.$idDatos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;

				}
			}

		break;
/*******************************************************************************************************************/
		case 'updateConsumo':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idDatosDetalle='".$idDatosDetalle."'";
				if(isset($Consumo) && $Consumo!=''){    $SIS_data .= ",Consumo='".$Consumo."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_datos_detalle', 'idDatosDetalle = "'.$idDatosDetalle.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;

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
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero entero';
				$errorn++;
			}

			if($errorn==0){
				//se borran los datos
				$resultado_1 = db_delete_data (false, 'aguas_mediciones_datos', 'idDatos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'aguas_mediciones_datos_detalle', 'idDatos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
	}

?>
