<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/
	//Traspaso de valores input a variables
	if ( !empty($_POST['idConsolidacion']) )        $idConsolidacion         = $_POST['idConsolidacion'];
	if ( !empty($_POST['CTNNombreCompañia']) )      $CTNNombreCompañia       = $_POST['CTNNombreCompañia'];
	if ( !empty($_POST['NInforme']) )               $NInforme                = $_POST['NInforme'];
	if ( !empty($_POST['Creacion_fecha']) )         $Creacion_fecha          = $_POST['Creacion_fecha'];
	if ( !empty($_POST['FechaInicioEmbarque']) )    $FechaInicioEmbarque     = $_POST['FechaInicioEmbarque'];
	if ( !empty($_POST['HoraInicioCarga']) )        $HoraInicioCarga         = $_POST['HoraInicioCarga'];
	if ( !empty($_POST['FechaTerminoEmbarque']) )   $FechaTerminoEmbarque    = $_POST['FechaTerminoEmbarque'];
	if ( !empty($_POST['HoraTerminoCarga']) )       $HoraTerminoCarga        = $_POST['HoraTerminoCarga'];
	if ( !empty($_POST['idPlantaDespacho']) )       $idPlantaDespacho        = $_POST['idPlantaDespacho'];
	if ( !empty($_POST['idCategoria']) )            $idCategoria             = $_POST['idCategoria'];
	if ( !empty($_POST['idProducto']) )             $idProducto              = $_POST['idProducto'];
	if ( !empty($_POST['CantidadCajas']) )          $CantidadCajas           = $_POST['CantidadCajas'];
	if ( !empty($_POST['idInstructivo']) )          $idInstructivo           = $_POST['idInstructivo'];
	if ( !empty($_POST['idNaviera']) )              $idNaviera               = $_POST['idNaviera'];
	if ( !empty($_POST['idPuertoEmbarque']) )       $idPuertoEmbarque        = $_POST['idPuertoEmbarque'];
	if ( !empty($_POST['idPuertoDestino']) )        $idPuertoDestino         = $_POST['idPuertoDestino'];
	if ( !empty($_POST['idMercado']) )              $idMercado               = $_POST['idMercado'];
	if ( !empty($_POST['idPais']) )                 $idPais                  = $_POST['idPais'];
	if ( !empty($_POST['idRecibidor']) )            $idRecibidor             = $_POST['idRecibidor'];
	if ( !empty($_POST['idEmpresaTransporte']) )    $idEmpresaTransporte     = $_POST['idEmpresaTransporte'];
	if ( !empty($_POST['ChoferNombreRut']) )        $ChoferNombreRut         = $_POST['ChoferNombreRut'];
	if ( !empty($_POST['PatenteCamion']) )          $PatenteCamion           = $_POST['PatenteCamion'];
	if ( !empty($_POST['PatenteCarro']) )           $PatenteCarro            = $_POST['PatenteCarro'];
	if ( !empty($_POST['idCondicion']) )            $idCondicion             = $_POST['idCondicion'];
	if ( !empty($_POST['idSellado']) )              $idSellado               = $_POST['idSellado'];
	if ( !empty($_POST['TSetPoint']) )              $TSetPoint               = $_POST['TSetPoint'];
	if ( !empty($_POST['TVentilacion']) )           $TVentilacion            = $_POST['TVentilacion'];
	if ( !empty($_POST['TAmbiente']) )              $TAmbiente               = $_POST['TAmbiente'];
	if ( !empty($_POST['NumeroSello']) )            $NumeroSello             = $_POST['NumeroSello'];
	if ( !empty($_POST['idInspector']) )            $idInspector             = $_POST['idInspector'];
	if ( !empty($_POST['Observaciones']) )          $Observaciones           = $_POST['Observaciones'];
	if ( !empty($_POST['idSistema']) )              $idSistema               = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )              $idUsuario               = $_POST['idUsuario'];
	if ( !empty($_POST['fecha_auto']) )             $fecha_auto              = $_POST['fecha_auto'];
	if ( !empty($_POST['randompass']) )             $randompass              = $_POST['randompass'];
	
	if ( !empty($_POST['idEstibaListado']) )        $idEstibaListado         = $_POST['idEstibaListado'];
	if ( !empty($_POST['idEstiba']) )               $idEstiba                = $_POST['idEstiba'];
	if ( !empty($_POST['idEstibaUbicacion']) )      $idEstibaUbicacion       = $_POST['idEstibaUbicacion'];
	if ( !empty($_POST['idPosicion']) )             $idPosicion              = $_POST['idPosicion'];
	if ( !empty($_POST['idEnvase']) )               $idEnvase                = $_POST['idEnvase'];
	if ( !empty($_POST['NPallet']) )                $NPallet                 = $_POST['NPallet'];
	if ( !empty($_POST['Temperatura']) )            $Temperatura             = $_POST['Temperatura'];
	if ( !empty($_POST['idTermografo']) )           $idTermografo            = $_POST['idTermografo'];
	if ( !empty($_POST['NSerieSensor']) )           $NSerieSensor            = $_POST['NSerieSensor'];
	
	if ( !empty($_POST['idArchivoTipo']) )         $idArchivoTipo            = $_POST['idArchivoTipo'];
	
	
	if ( !empty($_POST['oldidProducto']) )         $oldidProducto            = $_POST['oldidProducto'];
	if ( !empty($_POST['Observacion']) )           $Observacion              = $_POST['Observacion'];
	if ( !empty($_POST['Creacion_hora']) )         $Creacion_hora            = $_POST['Creacion_hora'];
	if ( !empty($_POST['cloneConsolidacion']) )    $cloneConsolidacion       = $_POST['cloneConsolidacion'];
	
						
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
			case 'idConsolidacion':         if(empty($idConsolidacion)){        $error['idConsolidacion']         = 'error/No ha ingresado el id';}break;
			case 'CTNNombreCompañia':       if(empty($CTNNombreCompañia)){      $error['CTNNombreCompañia']       = 'error/No ha seleccionado';}break;
			case 'NInforme':                if(empty($NInforme)){               $error['NInforme']                = 'error/No ha seleccionado';}break;
			case 'Creacion_fecha':          if(empty($Creacion_fecha)){         $error['Creacion_fecha']          = 'error/No ha seleccionado';}break;
			case 'FechaInicioEmbarque':     if(empty($FechaInicioEmbarque)){    $error['FechaInicioEmbarque']     = 'error/No ha seleccionado';}break;
			case 'HoraInicioCarga':         if(empty($HoraInicioCarga)){        $error['HoraInicioCarga']         = 'error/No ha seleccionado';}break;
			case 'FechaTerminoEmbarque':    if(empty($FechaTerminoEmbarque)){   $error['FechaTerminoEmbarque']    = 'error/No ha seleccionado';}break;
			case 'HoraTerminoCarga':        if(empty($HoraTerminoCarga)){       $error['HoraTerminoCarga']        = 'error/No ha seleccionado';}break;
			case 'idPlantaDespacho':        if(empty($idPlantaDespacho)){       $error['idPlantaDespacho']        = 'error/No ha seleccionado';}break;
			case 'idCategoria':             if(empty($idCategoria)){            $error['idCategoria']             = 'error/No ha seleccionado';}break;
			case 'idProducto':              if(empty($idProducto)){             $error['idProducto']              = 'error/No ha seleccionado';}break;
			case 'CantidadCajas':           if(empty($CantidadCajas)){          $error['CantidadCajas']           = 'error/No ha seleccionado';}break;
			case 'idInstructivo':           if(empty($idInstructivo)){          $error['idInstructivo']           = 'error/No ha seleccionado';}break;
			case 'idNaviera':               if(empty($idNaviera)){              $error['idNaviera']               = 'error/No ha seleccionado';}break;
			case 'idPuertoEmbarque':        if(empty($idPuertoEmbarque)){       $error['idPuertoEmbarque']        = 'error/No ha seleccionado';}break;
			case 'idPuertoDestino':         if(empty($idPuertoDestino)){        $error['idPuertoDestino']         = 'error/No ha seleccionado';}break;
			case 'idMercado':               if(empty($idMercado)){              $error['idMercado']               = 'error/No ha seleccionado';}break;
			case 'idPais':                  if(empty($idPais)){                 $error['idPais']                  = 'error/No ha seleccionado';}break;
			case 'idRecibidor':             if(empty($idRecibidor)){            $error['idRecibidor']             = 'error/No ha seleccionado';}break;
			case 'idEmpresaTransporte':     if(empty($idEmpresaTransporte)){    $error['idEmpresaTransporte']     = 'error/No ha seleccionado';}break;
			case 'ChoferNombreRut':         if(empty($ChoferNombreRut)){        $error['ChoferNombreRut']         = 'error/No ha seleccionado';}break;
			case 'PatenteCamion':           if(empty($PatenteCamion)){          $error['PatenteCamion']           = 'error/No ha seleccionado';}break;
			case 'PatenteCarro':            if(empty($PatenteCarro)){           $error['PatenteCarro']            = 'error/No ha seleccionado';}break;
			case 'idCondicion':             if(empty($idCondicion)){            $error['idCondicion']             = 'error/No ha seleccionado';}break;
			case 'idSellado':               if(empty($idSellado)){              $error['idSellado']               = 'error/No ha seleccionado';}break;
			case 'TSetPoint':               if(empty($TSetPoint)){              $error['TSetPoint']               = 'error/No ha seleccionado';}break;
			case 'TVentilacion':            if(empty($TVentilacion)){           $error['TVentilacion']            = 'error/No ha seleccionado';}break;
			case 'TAmbiente':               if(empty($TAmbiente)){              $error['TAmbiente']               = 'error/No ha seleccionado';}break;
			case 'NumeroSello':             if(empty($NumeroSello)){            $error['NumeroSello']             = 'error/No ha seleccionado';}break;
			case 'idInspector':             if(empty($idInspector)){            $error['idInspector']             = 'error/No ha seleccionado';}break;
			case 'Observaciones':           if(empty($Observaciones)){          $error['Observaciones']           = 'error/No ha seleccionado';}break;
			case 'idSistema':               if(empty($idSistema)){              $error['idSistema']               = 'error/No ha seleccionado';}break;
			case 'idUsuario':               if(empty($idUsuario)){              $error['idUsuario']               = 'error/No ha seleccionado';}break;
			case 'fecha_auto':              if(empty($fecha_auto)){             $error['fecha_auto']              = 'error/No ha seleccionado';}break;
			case 'randompass':              if(empty($randompass)){             $error['randompass']              = 'error/No ha seleccionado';}break;
			
			
			case 'idEstibaListado':         if(empty($idEstibaListado)){        $error['idEstibaListado']         = 'error/No ha seleccionado';}break;
			case 'idEstiba':                if(empty($idEstiba)){               $error['idEstiba']                = 'error/No ha seleccionado';}break;
			case 'idEstibaUbicacion':       if(empty($idEstibaUbicacion)){      $error['idEstibaUbicacion']       = 'error/No ha seleccionado';}break;
			case 'idPosicion':              if(empty($idPosicion)){             $error['idPosicion']              = 'error/No ha seleccionado';}break;
			case 'idEnvase':                if(empty($idEnvase)){               $error['idEnvase']                = 'error/No ha seleccionado';}break;
			case 'NPallet':                 if(empty($NPallet)){                $error['NPallet']                 = 'error/No ha seleccionado';}break;
			case 'Temperatura':             if(empty($Temperatura)){            $error['Temperatura']             = 'error/No ha seleccionado';}break;
			case 'idTermografo':            if(empty($idTermografo)){           $error['idTermografo']            = 'error/No ha seleccionado';}break;
			case 'NSerieSensor':            if(empty($NSerieSensor)){           $error['NSerieSensor']            = 'error/No ha seleccionado';}break;
			
			case 'idArchivoTipo':           if(empty($idArchivoTipo)){          $error['idArchivoTipo']           = 'error/No ha seleccionado';}break;
			
		}
	}	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($CTNNombreCompañia)&&contar_palabras_censuradas($CTNNombreCompañia)!=0){  $error['CTNNombreCompañia'] = 'error/Edita CTN Nombre Compañia, contiene palabras no permitidas'; }	
	if(isset($ChoferNombreRut)&&contar_palabras_censuradas($ChoferNombreRut)!=0){      $error['ChoferNombreRut']   = 'error/Edita Chofer Nombre Rut, contiene palabras no permitidas'; }	
	if(isset($PatenteCamion)&&contar_palabras_censuradas($PatenteCamion)!=0){          $error['PatenteCamion']     = 'error/Edita Patente Camion, contiene palabras no permitidas'; }	
	if(isset($PatenteCarro)&&contar_palabras_censuradas($PatenteCarro)!=0){            $error['PatenteCarro']      = 'error/Edita Patente Carro, contiene palabras no permitidas'; }	
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){          $error['Observaciones']     = 'error/Edita Observaciones, contiene palabras no permitidas'; }	
	if(isset($NPallet)&&contar_palabras_censuradas($NPallet)!=0){                      $error['NPallet']           = 'error/Edita N Pallet, contiene palabras no permitidas'; }	
	if(isset($NSerieSensor)&&contar_palabras_censuradas($NSerieSensor)!=0){            $error['NSerieSensor']      = 'error/Edita N Serie Sensor, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {


/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                       INGRESOS                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_ingreso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			/*$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows (false, 'idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				/************************************************************/
				// Se trae la categoria del producto
				if(isset($idCategoria)&&$idCategoria!=''){
					$rowCategoria = db_select_data (false, 'Nombre', 'sistema_variedades_categorias', '', 'idCategoria = "'.$idCategoria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				// Se trae la informacion del producto
				if(isset($idProducto)&&$idProducto!=''){
					$rowProd = db_select_data (false, 'Nombre', 'variedades_listado', '', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//Condicion CTN
				if(isset($idCondicion)&&$idCondicion!=''){
					$rowCondicionCTN = db_select_data (false, 'Nombre', 'core_cross_shipping_consolidacion_condicion', '', 'idCondicion = "'.$idCondicion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}					
				/************************************************************/
				//Sellado Piso
				if(isset($idSellado)&&$idSellado!=''){
					$rowSellado = db_select_data (false, 'Nombre', 'core_sistemas_opciones', '', 'idOpciones = "'.$idSellado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}									
				/************************************************************/
				//Inspector
				if(isset($idInspector)&&$idInspector!=''){
					$rowTrabajador = db_select_data (false, 'Nombre, ApellidoPat', 'trabajadores_listado', '', 'idTrabajador = "'.$idInspector.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//Planta Despacho
				if(isset($idPlantaDespacho)&&$idPlantaDespacho!=''){
					$rowPlantaDespacho = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_plantas', '', 'idPlantaDespacho = "'.$idPlantaDespacho.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//Instructivo
				if(isset($idInstructivo)&&$idInstructivo!=''){
					$rowInstructivo = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_instructivo', '', 'idInstructivo = "'.$idInstructivo.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Naviera
				if(isset($idNaviera)&&$idNaviera!=''){
					$rowNaviera = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_naviera', '', 'idNaviera = "'.$idNaviera.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//PuertoEmbarque
				if(isset($idPuertoEmbarque)&&$idPuertoEmbarque!=''){
					$rowPuertoEmbarque = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_puerto_embarque', '', 'idPuertoEmbarque = "'.$idPuertoEmbarque.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Mercado
				if(isset($idMercado)&&$idMercado!=''){
					$rowMercado = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_mercado', '', 'idMercado = "'.$idMercado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Pais
				if(isset($idPais)&&$idPais!=''){
					$rowPais = db_select_data (false, 'Nombre', 'core_paises', '', 'idPais = "'.$idPais.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//EmpresaTransporte
				if(isset($idEmpresaTransporte)&&$idEmpresaTransporte!=''){
					$rowEmpresaTransporte = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_empresa_transporte', '', 'idEmpresaTransporte = "'.$idEmpresaTransporte.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//PuertoDestino
				if(isset($idPuertoDestino)&&$idPuertoDestino!=''){
					$rowPuertoDestino = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_puerto_destino', '', 'idPuertoDestino = "'.$idPuertoDestino.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Recibidor
				if(isset($idRecibidor)&&$idRecibidor!=''){
					$rowRecibidor = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_recibidores', '', 'idRecibidor = "'.$idRecibidor.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}				
				
				
				
				/************************************************************/
				//Borro todas las sesiones
				unset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass])){
					foreach ($_SESSION['cross_shipping_consolidacion_archivos'][$randompass] as $key => $productos){
						foreach ($productos as $producto) {
							if(isset($producto['idFile'])&&$producto['idFile']!=0){
								try {
									if(!is_writable('upload/'.$producto['Nombre'])){
										//throw new Exception('File not writable');
									}else{
										unlink('upload/'.$producto['Nombre']);
									}
								}catch(Exception $e) { 
									//guardar el dato en un archivo log
								}
							}
						}
					}
				}
				unset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass]);
				
				
				/************************************************************/
				//Datos desde las consultas
				if(isset($rowProd['Nombre'])&&$rowProd['Nombre']!=''){                            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ProdMuestra']        = $rowCategoria['Nombre'].' '.$rowProd['Nombre'];                        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ProdMuestra']        = 'Sin Datos';}
				if(isset($rowPlantaDespacho['Nombre'])&&$rowPlantaDespacho['Nombre']!=''){        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PlantaDespacho']     = $rowPlantaDespacho['Codigo'].' - '.$rowPlantaDespacho['Nombre'];       }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PlantaDespacho']     = 'Sin Datos';}
				if(isset($rowInstructivo['Nombre'])&&$rowInstructivo['Nombre']!=''){              $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Instructivo']        = $rowInstructivo['Codigo'].' - '.$rowInstructivo['Nombre'];             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Instructivo']        = 'Sin Datos';}
				if(isset($rowNaviera['Nombre'])&&$rowNaviera['Nombre']!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Naviera']            = $rowNaviera['Codigo'].' - '.$rowNaviera['Nombre'];                     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Naviera']            = 'Sin Datos';}
				if(isset($rowPuertoEmbarque['Nombre'])&&$rowPuertoEmbarque['Nombre']!=''){        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoEmbarque']     = $rowPuertoEmbarque['Codigo'].' - '.$rowPuertoEmbarque['Nombre'];       }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoEmbarque']     = 'Sin Datos';}
				if(isset($rowPuertoDestino['Nombre'])&&$rowPuertoDestino['Nombre']!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoDestino']      = $rowPuertoDestino['Codigo'].' - '.$rowPuertoDestino['Nombre'];         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoDestino']      = 'Sin Datos';}
				if(isset($rowMercado['Nombre'])&&$rowMercado['Nombre']!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Mercado']            = $rowMercado['Codigo'].' - '.$rowMercado['Nombre'];                     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Mercado']            = 'Sin Datos';}
				if(isset($rowPais['Nombre'])&&$rowPais['Nombre']!=''){                            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Pais']               = $rowPais['Nombre'];                                                    }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Pais']               = 'Sin Datos';}
				if(isset($rowRecibidor['Nombre'])&&$rowRecibidor['Nombre']!=''){                  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Recibidor']          = $rowRecibidor['Codigo'].' - '.$rowRecibidor['Nombre'];                 }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Recibidor']          = 'Sin Datos';}
				if(isset($rowEmpresaTransporte['Nombre'])&&$rowEmpresaTransporte['Nombre']!=''){  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['EmpresaTransporte']  = $rowEmpresaTransporte['Codigo'].' - '.$rowEmpresaTransporte['Nombre']; }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['EmpresaTransporte']  = 'Sin Datos';}
				if(isset($rowCondicionCTN['Nombre'])&&$rowCondicionCTN['Nombre']!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CondicionCTN']       = $rowCondicionCTN['Nombre'];                                            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CondicionCTN']       = 'Sin Datos';}
				if(isset($rowSellado['Nombre'])&&$rowSellado['Nombre']!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Sellado']            = $rowSellado['Nombre'];                                                 }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Sellado']            = 'Sin Datos';}
				if(isset($rowTrabajador['Nombre'])&&$rowTrabajador['Nombre']!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Trabajador']         = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'];            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Trabajador']         = 'Sin Datos';}
				 
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($randompass)&&$randompass!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['randompass']            = $randompass; }
				if(isset($CTNNombreCompañia)&&$CTNNombreCompañia!=''){        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']     = $CTNNombreCompañia;       }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']     = 'Sin Datos';}
				if(isset($NInforme)&&$NInforme!=''){                          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']              = $NInforme;                }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']              = 'Sin Datos';}
				if(isset($Creacion_fecha)&&$Creacion_fecha!=''){              $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']        = $Creacion_fecha;          }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']        = '0000-00-00';}
				if(isset($FechaInicioEmbarque)&&$FechaInicioEmbarque!=''){    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']   = $FechaInicioEmbarque;     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']   = '0000-00-00';}
				if(isset($HoraInicioCarga)&&$HoraInicioCarga!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']       = $HoraInicioCarga;         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']       = 'Sin Datos';}
				if(isset($FechaTerminoEmbarque)&&$FechaTerminoEmbarque!=''){  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']  = $FechaTerminoEmbarque;    }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']  = '0000-00-00';}
				if(isset($HoraTerminoCarga)&&$HoraTerminoCarga!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']      = $HoraTerminoCarga;        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']      = 'Sin Datos';}
				if(isset($idPlantaDespacho)&&$idPlantaDespacho!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']      = $idPlantaDespacho;        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']      = 'Sin Datos';}
				if(isset($idCategoria)&&$idCategoria!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']           = $idCategoria;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']           = 'Sin Datos';}
				if(isset($idProducto)&&$idProducto!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']            = $idProducto;              }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']            = 'Sin Datos';}
				if(isset($CantidadCajas)&&$CantidadCajas!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']         = $CantidadCajas;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']         = 'Sin Datos';}
				if(isset($idInstructivo)&&$idInstructivo!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']         = $idInstructivo;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']         = 'Sin Datos';}
				if(isset($idNaviera)&&$idNaviera!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']             = $idNaviera;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']             = 'Sin Datos';}
				if(isset($idPuertoEmbarque)&&$idPuertoEmbarque!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']      = $idPuertoEmbarque;        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']      = 'Sin Datos';}
				if(isset($idPuertoDestino)&&$idPuertoDestino!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']       = $idPuertoDestino;         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']       = 'Sin Datos';}
				if(isset($idMercado)&&$idMercado!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']             = $idMercado;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']             = 'Sin Datos';}
				if(isset($idPais)&&$idPais!=''){                              $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']                = $idPais;                  }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']                = 'Sin Datos';}
				if(isset($idRecibidor)&&$idRecibidor!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']           = $idRecibidor;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']           = 'Sin Datos';}
				if(isset($idEmpresaTransporte)&&$idEmpresaTransporte!=''){    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']   = $idEmpresaTransporte;     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']   = 'Sin Datos';}
				if(isset($ChoferNombreRut)&&$ChoferNombreRut!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']       = $ChoferNombreRut;         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']       = 'Sin Datos';}
				if(isset($PatenteCamion)&&$PatenteCamion!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']         = $PatenteCamion;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']         = 'Sin Datos';}
				if(isset($PatenteCarro)&&$PatenteCarro!=''){                  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']          = $PatenteCarro;            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']          = 'Sin Datos';}
				if(isset($idCondicion)&&$idCondicion!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']           = $idCondicion;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']           = 'Sin Datos';}
				if(isset($idSellado)&&$idSellado!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']             = $idSellado;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']             = 'Sin Datos';}
				if(isset($TSetPoint)&&$TSetPoint!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']             = $TSetPoint;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']             = 'Sin Datos';}
				if(isset($TVentilacion)&&$TVentilacion!=''){                  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']          = $TVentilacion;            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']          = 'Sin Datos';}
				if(isset($TAmbiente)&&$TAmbiente!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']             = $TAmbiente;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']             = 'Sin Datos';}
				if(isset($NumeroSello)&&$NumeroSello!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']           = $NumeroSello;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']           = 'Sin Datos';}
				if(isset($idInspector)&&$idInspector!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']           = $idInspector;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']           = 'Sin Datos';}
				if(isset($Observaciones)&&$Observaciones!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']         = $Observaciones;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']         = 'Sin Datos';}
				if(isset($idSistema)&&$idSistema!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']             = $idSistema;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']             = 'Sin Datos';}
				if(isset($idUsuario)&&$idUsuario!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']             = $idUsuario;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']             = 'Sin Datos';}
				if(isset($fecha_auto)&&$fecha_auto!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']            = $fecha_auto;              }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']            = 'Sin Datos';}
				
	
				header( 'Location: '.$location.'&view='.$randompass );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':
			
			//variable
			$randompass = $_GET['clear_all'];
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]);
			unset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass]);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass])){
				foreach ($_SESSION['cross_shipping_consolidacion_archivos'][$randompass] as $key => $productos){
					foreach ($productos as $producto) {
						if(isset($producto['idFile'])&&$producto['idFile']!=0){
							try {
								if(!is_writable('upload/'.$producto['Nombre'])){
									//throw new Exception('File not writable');
								}else{
									unlink('upload/'.$producto['Nombre']);
								}
							}catch(Exception $e) { 
								//guardar el dato en un archivo log
							}
						}
					}
				}
			}
			unset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass]);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			/*$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows (false, 'idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['cross_shipping_consolidacion_temporal'][$randompass]);
				//Borro todas las sesiones
				unset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]);
				
				/************************************************************/
				// Se trae la categoria del producto
				if(isset($idCategoria)&&$idCategoria!=''){
					$rowCategoria = db_select_data (false, 'Nombre', 'sistema_variedades_categorias', '', 'idCategoria = "'.$idCategoria.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				// Se trae la informacion del producto
				if(isset($idProducto)&&$idProducto!=''){
					$rowProd = db_select_data (false, 'Nombre', 'variedades_listado', '', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//Condicion CTN
				if(isset($idCondicion)&&$idCondicion!=''){
					$rowCondicionCTN = db_select_data (false, 'Nombre', 'core_cross_shipping_consolidacion_condicion', '', 'idCondicion = "'.$idCondicion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}					
				/************************************************************/
				//Sellado Piso
				if(isset($idSellado)&&$idSellado!=''){
					$rowSellado = db_select_data (false, 'Nombre', 'core_sistemas_opciones', '', 'idOpciones = "'.$idSellado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}									
				/************************************************************/
				//Inspector
				if(isset($idInspector)&&$idInspector!=''){
					$rowTrabajador = db_select_data (false, 'Nombre, ApellidoPat', 'trabajadores_listado', '', 'idTrabajador = "'.$idTrabajador.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//Planta Despacho
				if(isset($idPlantaDespacho)&&$idPlantaDespacho!=''){
					$rowPlantaDespacho = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_plantas', '', 'idPlantaDespacho = "'.$idPlantaDespacho.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//Instructivo
				if(isset($idInstructivo)&&$idInstructivo!=''){
					$rowInstructivo = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_instructivo', '', 'idInstructivo = "'.$idInstructivo.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Naviera
				if(isset($idNaviera)&&$idNaviera!=''){
					$rowNaviera = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_naviera', '', 'idNaviera = "'.$idNaviera.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//PuertoEmbarque
				if(isset($idPuertoEmbarque)&&$idPuertoEmbarque!=''){
					$rowPuertoEmbarque = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_puerto_embarque', '', 'idPuertoEmbarque = "'.$idPuertoEmbarque.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Mercado
				if(isset($idMercado)&&$idMercado!=''){
					$rowMercado = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_mercado', '', 'idMercado = "'.$idMercado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Pais
				if(isset($idPais)&&$idPais!=''){
					$rowPais = db_select_data (false, 'Nombre', 'core_paises', '', 'idPais = "'.$idPais.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//EmpresaTransporte
				if(isset($idEmpresaTransporte)&&$idEmpresaTransporte!=''){
					$rowEmpresaTransporte = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_empresa_transporte', '', 'idEmpresaTransporte = "'.$idEmpresaTransporte.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/************************************************************/
				//PuertoDestino
				if(isset($idPuertoDestino)&&$idPuertoDestino!=''){
					$rowPuertoDestino = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_puerto_destino', '', 'idPuertoDestino = "'.$idPuertoDestino.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}	
				/************************************************************/
				//Recibidor
				if(isset($idRecibidor)&&$idRecibidor!=''){
					$rowRecibidor = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_recibidores', '', 'idRecibidor = "'.$idRecibidor.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				
				/************************************************************/
				//Datos desde las consultas
				if(isset($rowProd['Nombre'])&&$rowProd['Nombre']!=''){                            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ProdMuestra']        = $rowCategoria['Nombre'].' '.$rowProd['Nombre'];                        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ProdMuestra']        = 'Sin Datos';}
				if(isset($rowPlantaDespacho['Nombre'])&&$rowPlantaDespacho['Nombre']!=''){        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PlantaDespacho']     = $rowPlantaDespacho['Codigo'].' - '.$rowPlantaDespacho['Nombre'];       }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PlantaDespacho']     = 'Sin Datos';}
				if(isset($rowInstructivo['Nombre'])&&$rowInstructivo['Nombre']!=''){              $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Instructivo']        = $rowInstructivo['Codigo'].' - '.$rowInstructivo['Nombre'];             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Instructivo']        = 'Sin Datos';}
				if(isset($rowNaviera['Nombre'])&&$rowNaviera['Nombre']!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Naviera']            = $rowNaviera['Codigo'].' - '.$rowNaviera['Nombre'];                     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Naviera']            = 'Sin Datos';}
				if(isset($rowPuertoEmbarque['Nombre'])&&$rowPuertoEmbarque['Nombre']!=''){        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoEmbarque']     = $rowPuertoEmbarque['Codigo'].' - '.$rowPuertoEmbarque['Nombre'];       }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoEmbarque']     = 'Sin Datos';}
				if(isset($rowPuertoDestino['Nombre'])&&$rowPuertoDestino['Nombre']!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoDestino']      = $rowPuertoDestino['Codigo'].' - '.$rowPuertoDestino['Nombre'];         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PuertoDestino']      = 'Sin Datos';}
				if(isset($rowMercado['Nombre'])&&$rowMercado['Nombre']!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Mercado']            = $rowMercado['Codigo'].' - '.$rowMercado['Nombre'];                     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Mercado']            = 'Sin Datos';}
				if(isset($rowPais['Nombre'])&&$rowPais['Nombre']!=''){                            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Pais']               = $rowPais['Nombre'];                                                    }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Pais']               = 'Sin Datos';}
				if(isset($rowRecibidor['Nombre'])&&$rowRecibidor['Nombre']!=''){                  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Recibidor']          = $rowRecibidor['Codigo'].' - '.$rowRecibidor['Nombre'];                 }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Recibidor']          = 'Sin Datos';}
				if(isset($rowEmpresaTransporte['Nombre'])&&$rowEmpresaTransporte['Nombre']!=''){  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['EmpresaTransporte']  = $rowEmpresaTransporte['Codigo'].' - '.$rowEmpresaTransporte['Nombre']; }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['EmpresaTransporte']  = 'Sin Datos';}
				if(isset($rowCondicionCTN['Nombre'])&&$rowCondicionCTN['Nombre']!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CondicionCTN']       = $rowCondicionCTN['Nombre'];                                            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CondicionCTN']       = 'Sin Datos';}
				if(isset($rowSellado['Nombre'])&&$rowSellado['Nombre']!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Sellado']            = $rowSellado['Nombre'];                                                 }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Sellado']            = 'Sin Datos';}
				if(isset($rowTrabajador['Nombre'])&&$rowTrabajador['Nombre']!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Trabajador']         = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'];            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Trabajador']         = 'Sin Datos';}
				 
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($randompass)&&$randompass!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['randompass']            = $randompass; }
				if(isset($CTNNombreCompañia)&&$CTNNombreCompañia!=''){        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']     = $CTNNombreCompañia;       }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']     = 'Sin Datos';}
				if(isset($NInforme)&&$NInforme!=''){                          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']              = $NInforme;                }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']              = 'Sin Datos';}
				if(isset($Creacion_fecha)&&$Creacion_fecha!=''){              $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']        = $Creacion_fecha;          }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']        = '0000-00-00';}
				if(isset($FechaInicioEmbarque)&&$FechaInicioEmbarque!=''){    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']   = $FechaInicioEmbarque;     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']   = '0000-00-00';}
				if(isset($HoraInicioCarga)&&$HoraInicioCarga!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']       = $HoraInicioCarga;         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']       = 'Sin Datos';}
				if(isset($FechaTerminoEmbarque)&&$FechaTerminoEmbarque!=''){  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']  = $FechaTerminoEmbarque;    }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']  = '0000-00-00';}
				if(isset($HoraTerminoCarga)&&$HoraTerminoCarga!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']      = $HoraTerminoCarga;        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']      = 'Sin Datos';}
				if(isset($idPlantaDespacho)&&$idPlantaDespacho!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']      = $idPlantaDespacho;        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']      = 'Sin Datos';}
				if(isset($idCategoria)&&$idCategoria!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']           = $idCategoria;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']           = 'Sin Datos';}
				if(isset($idProducto)&&$idProducto!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']            = $idProducto;              }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']            = 'Sin Datos';}
				if(isset($CantidadCajas)&&$CantidadCajas!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']         = $CantidadCajas;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']         = 'Sin Datos';}
				if(isset($idInstructivo)&&$idInstructivo!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']         = $idInstructivo;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']         = 'Sin Datos';}
				if(isset($idNaviera)&&$idNaviera!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']             = $idNaviera;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']             = 'Sin Datos';}
				if(isset($idPuertoEmbarque)&&$idPuertoEmbarque!=''){          $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']      = $idPuertoEmbarque;        }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']      = 'Sin Datos';}
				if(isset($idPuertoDestino)&&$idPuertoDestino!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']       = $idPuertoDestino;         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']       = 'Sin Datos';}
				if(isset($idMercado)&&$idMercado!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']             = $idMercado;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']             = 'Sin Datos';}
				if(isset($idPais)&&$idPais!=''){                              $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']                = $idPais;                  }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']                = 'Sin Datos';}
				if(isset($idRecibidor)&&$idRecibidor!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']           = $idRecibidor;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']           = 'Sin Datos';}
				if(isset($idEmpresaTransporte)&&$idEmpresaTransporte!=''){    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']   = $idEmpresaTransporte;     }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']   = 'Sin Datos';}
				if(isset($ChoferNombreRut)&&$ChoferNombreRut!=''){            $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']       = $ChoferNombreRut;         }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']       = 'Sin Datos';}
				if(isset($PatenteCamion)&&$PatenteCamion!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']         = $PatenteCamion;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']         = 'Sin Datos';}
				if(isset($PatenteCarro)&&$PatenteCarro!=''){                  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']          = $PatenteCarro;            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']          = 'Sin Datos';}
				if(isset($idCondicion)&&$idCondicion!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']           = $idCondicion;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']           = 'Sin Datos';}
				if(isset($idSellado)&&$idSellado!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']             = $idSellado;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']             = 'Sin Datos';}
				if(isset($TSetPoint)&&$TSetPoint!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']             = $TSetPoint;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']             = 'Sin Datos';}
				if(isset($TVentilacion)&&$TVentilacion!=''){                  $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']          = $TVentilacion;            }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']          = 'Sin Datos';}
				if(isset($TAmbiente)&&$TAmbiente!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']             = $TAmbiente;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']             = 'Sin Datos';}
				if(isset($NumeroSello)&&$NumeroSello!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']           = $NumeroSello;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']           = 'Sin Datos';}
				if(isset($idInspector)&&$idInspector!=''){                    $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']           = $idInspector;             }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']           = 'Sin Datos';}
				if(isset($Observaciones)&&$Observaciones!=''){                $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']         = $Observaciones;           }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']         = 'Sin Datos';}
				if(isset($idSistema)&&$idSistema!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']             = $idSistema;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']             = 'Sin Datos';}
				if(isset($idUsuario)&&$idUsuario!=''){                        $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']             = $idUsuario;               }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']             = 'Sin Datos';}
				if(isset($fecha_auto)&&$fecha_auto!=''){                      $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']            = $fecha_auto;              }else{$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']            = 'Sin Datos';}
				
				
				header( 'Location: '.$location.'&view='.$randompass );
				die;
			}
	
		break;
			
	
/*******************************************************************************************************************/		
		case 'add_obs_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view='.$randompass.'#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing':
			
			//variable
			$randompass = $_GET['view'];
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['cross_shipping_consolidacion_temporal'][$randompass] = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones'];
			$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view='.$randompass.'#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo])){
				foreach ($_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo] as $key => $trabajos){
					if(isset($trabajos['idFile'])&&$trabajos['idFile']!=''){
						if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
					}
				}
			}
			
			//Se verifica que el archivo subido no exceda los 100 kb
			$limite_kb = 10000;
			//Sufijo
			$sufijo = 'cross_ship_conso_'.$CTNNombreCompañia.'_'.fecha_actual().'_'.$idArchivoTipo.'_';
			//Se verifican las extensiones de los archivos
			$permitidos = array("application/msword",
								"application/vnd.ms-word",
								"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
									
								"application/msexcel",
								"application/vnd.ms-excel",
								"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
											
								"application/mspowerpoint",
								"application/vnd.ms-powerpoint",
								"application/vnd.openxmlformats-officedocument.presentationml.presentation",
											
								"application/pdf",
								"application/octet-stream",
								"application/x-real",
								"application/vnd.adobe.xfdf",
								"application/vnd.fdf",
								"binary/octet-stream",
											
								"image/jpg", 
								"image/jpeg", 
								"image/gif", 
								"image/png"

								);
											
											
			//Verifico errores en los archivos
			foreach($_FILES["exFile"]["tmp_name"] as $key=>$tmp_name){
				if ($_FILES["exFile"]["error"][$key] > 0){ 
					$error['exFile'] = 'error/'.uploadPHPError($_FILES["exFile"]["error"][$key]); 
				}
				if (in_array($_FILES['exFile']['type'][$key], $permitidos) && $_FILES['exFile']['size'][$key] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['exFile']['name'][$key];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (file_exists($ruta)){
						$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'][$key].' ya existe'; 
					}
				} else {
					$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}
			


			if ( empty($error) ) {
				
				/***************************************************/
				// Se trae el tipo de archivo
				$rowTipoArchivo = db_select_data (false, 'Nombre', 'core_cross_shipping_archivos_tipos', '', 'idArchivoTipo = "'.$idArchivoTipo.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
				//Verifico errores en los archivos
				foreach($_FILES["exFile"]["tmp_name"] as $key=>$tmp_name){
					if ($_FILES["exFile"]["error"][$key] > 0){ 
						$error['exFile'] = 'error/'.uploadPHPError($_FILES["exFile"]["error"][$key]); 
					}
					if (in_array($_FILES['exFile']['type'][$key], $permitidos) && $_FILES['exFile']['size'][$key] <= $limite_kb * 1024){
						//Se especifica carpeta de destino
						$ruta = "upload/".$sufijo.$_FILES['exFile']['name'][$key];
						//Se verifica que el archivo un archivo con el mismo nombre no existe
						if (!file_exists($ruta)){
							//Se mueve el archivo a la carpeta previamente configurada
							$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"][$key], $ruta);
							if ($move_result){
									
								//se guarda en el indice siguiente
								$idInterno++;
								//Se guarda el trabajo asignado
								$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo][$idInterno]['idFile']         = $idInterno;
								$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo][$idInterno]['Nombre']         = $sufijo.$_FILES['exFile']['name'][$key];
								$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo][$idInterno]['idArchivoTipo']  = $idArchivoTipo;
								$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo]['ArchivoTipo']                = $rowTipoArchivo['Nombre'];
								$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo]['idArchivoTipo']              = $idArchivoTipo;
			
							} else {
								$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
							}
						}else{
							$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'][$key].' ya existe'; 
						}
					} else {
						$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
					}
				}
				
				header( 'Location: '.$location.'&view='.$randompass );
				die;
								
					
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_ing':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variable
			$randompass     = $_GET['view'];
			$idArchivoTipo  = $_GET['idArchivoTipo'];
			
			try {
				if(!is_writable('upload/'.$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo][$_GET['del_file']]['Nombre']);
					unset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass][$idArchivoTipo][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view='.$randompass );
			die;


		break;		
/*******************************************************************************************************************/		
		case 'new_estiba':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass])){
				foreach ($_SESSION['cross_shipping_consolidacion_estibas'][$randompass] as $key => $trabajos){
					if($idInterno<$trabajos['idInterno']){$idInterno = $trabajos['idInterno'];}
					if($trabajos['idEstibaUbicacion']==$idEstibaUbicacion){
						$error['idEstibaUbicacion'] = 'error/La ubicacion ya esta siendo utilizada';
					}
				}
			}
			
			
			
			if ( empty($error) ) {
				
				/*************************************/
				// tomo los datos de la Estiba
				if(isset($idEstiba)&&$idEstiba!=''){
					$rowEstiba = db_select_data (false, 'Nombre', 'core_estibas', '', 'idEstiba = "'.$idEstiba.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de la Estiba Ubicacion
				if(isset($idEstibaUbicacion)&&$idEstibaUbicacion!=''){
					$rowEstibaUbicacion = db_select_data (false, 'Nombre', 'core_estibas_ubicacion', '', 'idEstibaUbicacion = "'.$idEstibaUbicacion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de la posicion
				if(isset($idPosicion)&&$idPosicion!=''){
					$rowPosicion = db_select_data (false, 'Nombre', 'core_cross_shipping_consolidacion_posicion', '', 'idPosicion = "'.$idPosicion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de Envase
				if(isset($idEnvase)&&$idEnvase!=''){
					$rowEnvase = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_envase', '', 'idEnvase = "'.$idEnvase.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de Termografo
				if(isset($idTermografo)&&$idTermografo!=''){
					$rowTermografo = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_termografo', '', 'idTermografo = "'.$idTermografo.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				
				
				$idInterno = $idInterno+1;
				if(isset($idInterno)&&$idInterno!=''){                  $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idInterno']           = $idInterno;          }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idInterno']          = '';}
				if(isset($idEstiba)&&$idEstiba!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idEstiba']            = $idEstiba;           }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idEstiba']           = '';}
				if(isset($idEstibaUbicacion)&&$idEstibaUbicacion!=''){  $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idEstibaUbicacion']   = $idEstibaUbicacion;  }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idEstibaUbicacion']  = '';}
				if(isset($idPosicion)&&$idPosicion!=''){                $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idPosicion']          = $idPosicion;         }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idPosicion']         = '';}
				if(isset($idEnvase)&&$idEnvase!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idEnvase']            = $idEnvase;           }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idEnvase']           = '';}
				if(isset($NPallet)&&$NPallet!=''){                      $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['NPallet']             = $NPallet;            }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['NPallet']            = '';}
				if(isset($Temperatura)&&$Temperatura!=''){              $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Temperatura']         = $Temperatura;        }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Temperatura']        = '';}
				if(isset($idTermografo)&&$idTermografo!=''){            $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idTermografo']        = $idTermografo;       }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['idTermografo']       = '';}
				if(isset($NSerieSensor)&&$NSerieSensor!=''){            $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['NSerieSensor']        = $NSerieSensor;       }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['NSerieSensor']       = '';}
				
				if(isset($idEstiba)&&$idEstiba!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Estiba']              = $rowEstiba['Nombre'];                                     }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Estiba']           = '';}
				if(isset($idEstibaUbicacion)&&$idEstibaUbicacion!=''){  $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['EstibaUbicacion']     = $rowEstibaUbicacion['Nombre'];                            }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['EstibaUbicacion']  = '';}
				if(isset($idPosicion)&&$idPosicion!=''){                $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Posicion']            = $rowPosicion['Nombre'];                                   }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Posicion']         = '';}
				if(isset($idEnvase)&&$idEnvase!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Envase']              = $rowEnvase['Codigo'].' - '.$rowEnvase['Nombre'];          }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Envase']           = '';}
				if(isset($idTermografo)&&$idTermografo!=''){            $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Termografo']          = $rowTermografo['Codigo'].' - '.$rowTermografo['Nombre'];  }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$idInterno]['Termografo']       = '';}
				
				
				
				//Redirijo			
				header( 'Location: '.$location.'&view='.$randompass );
				die;
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'edit_estiba':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass])){
				foreach ($_SESSION['cross_shipping_consolidacion_estibas'][$randompass] as $key => $trabajos){
					if($trabajos['idEstibaUbicacion']==$idEstibaUbicacion&&$oldidProducto!=$trabajos['idInterno']){
						$error['idEstibaUbicacion'] = 'error/La ubicacion ya esta siendo utilizada';
					}
				}
			}
		
			
			if ( empty($error) ) {
				
				/*************************************/
				// tomo los datos de la Estiba
				if(isset($idEstiba)&&$idEstiba!=''){
					$rowEstiba = db_select_data (false, 'Nombre', 'core_estibas', '', 'idEstiba = "'.$idEstiba.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de la Estiba Ubicacion
				if(isset($idEstibaUbicacion)&&$idEstibaUbicacion!=''){
					$rowEstibaUbicacion = db_select_data (false, 'Nombre', 'core_estibas_ubicacion', '', 'idEstibaUbicacion = "'.$idEstibaUbicacion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de la posicion
				if(isset($idPosicion)&&$idPosicion!=''){
					$rowPosicion = db_select_data (false, 'Nombre', 'core_cross_shipping_consolidacion_posicion', '', 'idPosicion = "'.$idPosicion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de Envase
				if(isset($idEnvase)&&$idEnvase!=''){
					$rowEnvase = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_envase', '', 'idEnvase = "'.$idEnvase.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				/*************************************/
				// tomo los datos de Termografo
				if(isset($idTermografo)&&$idTermografo!=''){
					$rowTermografo = db_select_data (false, 'Codigo, Nombre', 'cross_shipping_termografo', '', 'idTermografo = "'.$idTermografo.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				}
				
				//if(isset($idInterno)&&$idInterno!=''){                  $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idInterno']           = $oldidProducto;      }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idInterno']          = '';}
				if(isset($idEstiba)&&$idEstiba!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idEstiba']            = $idEstiba;           }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idEstiba']           = '';}
				if(isset($idEstibaUbicacion)&&$idEstibaUbicacion!=''){  $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idEstibaUbicacion']   = $idEstibaUbicacion;  }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idEstibaUbicacion']  = '';}
				if(isset($idPosicion)&&$idPosicion!=''){                $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idPosicion']          = $idPosicion;         }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idPosicion']         = '';}
				if(isset($idEnvase)&&$idEnvase!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idEnvase']            = $idEnvase;           }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idEnvase']           = '';}
				if(isset($NPallet)&&$NPallet!=''){                      $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['NPallet']             = $NPallet;            }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['NPallet']            = '';}
				if(isset($Temperatura)&&$Temperatura!=''){              $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Temperatura']         = $Temperatura;        }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Temperatura']        = '';}
				if(isset($idTermografo)&&$idTermografo!=''){            $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idTermografo']        = $idTermografo;       }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['idTermografo']       = '';}
				if(isset($NSerieSensor)&&$NSerieSensor!=''){            $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['NSerieSensor']        = $NSerieSensor;       }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['NSerieSensor']       = '';}
				
				if(isset($idEstiba)&&$idEstiba!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Estiba']              = $rowEstiba['Nombre'];                                     }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Estiba']           = '';}
				if(isset($idEstibaUbicacion)&&$idEstibaUbicacion!=''){  $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['EstibaUbicacion']     = $rowEstibaUbicacion['Nombre'];                            }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['EstibaUbicacion']  = '';}
				if(isset($idPosicion)&&$idPosicion!=''){                $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Posicion']            = $rowPosicion['Nombre'];                                   }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Posicion']         = '';}
				if(isset($idEnvase)&&$idEnvase!=''){                    $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Envase']              = $rowEnvase['Codigo'].' - '.$rowEnvase['Nombre'];          }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Envase']           = '';}
				if(isset($idTermografo)&&$idTermografo!=''){            $_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Termografo']          = $rowTermografo['Codigo'].' - '.$rowTermografo['Nombre'];  }else{$_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$oldidProducto]['Termografo']       = '';}
				
				
				
				//Redirijo			
				header( 'Location: '.$location.'&view='.$randompass );
				die;
			}
	
		break;		
/*******************************************************************************************************************/
		case 'del_estiba':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variable
			$randompass = $_GET['view'];
			
			unset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass][$_GET['del_estiba']]);
			
			//Redirijo			
			header( 'Location: '.$location.'&view='.$randompass );
			die;


		break;	

/*******************************************************************************************************************/		
		case 'ing_Doc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variable
			$randompass = $_GET['view'];
			
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
			
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass])){

				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']=='Sin Datos' ){         $error['CTNNombreCompañia']      = 'error/No ha ingresado el Contenedor Nro.';}
				//if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']=='Sin Datos' ){                         $error['NInforme']               = 'error/No ha ingresado el Nro. Del Informe';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']=='0000-00-00' ){              $error['Creacion_fecha']         = 'error/No ha ingresado la Fecha del informe';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']=='0000-00-00' ){    $error['FechaInicioEmbarque']    = 'error/No ha ingresado la Fecha Inicio del Embarque';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']=='Sin Datos' ){             $error['HoraInicioCarga']        = 'error/No ha ingresado la Hora Inicio Carga';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']=='0000-00-00' ){  $error['FechaTerminoEmbarque']   = 'error/No ha ingresado la Fecha Termino del Embarque';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']=='Sin Datos' ){           $error['HoraTerminoCarga']       = 'error/No ha ingresado la Hora Termino Carga';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']=='Sin Datos' ){           $error['idPlantaDespacho']       = 'error/No ha seleccionado el Planta Despachadora';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']=='Sin Datos' ){                     $error['idCategoria']            = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']=='Sin Datos' ){                       $error['idProducto']             = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']=='Sin Datos' ){                 $error['CantidadCajas']          = 'error/No ha ingresado la Cantidad de Cajas';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']=='Sin Datos' ){                 $error['idInstructivo']          = 'error/No ha seleccionado el N° Instructivo';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']=='Sin Datos' ){                         $error['idNaviera']              = 'error/No ha seleccionado la Naviera';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']=='Sin Datos' ){           $error['idPuertoEmbarque']       = 'error/No ha seleccionado el Puerto Embarque';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']=='Sin Datos' ){             $error['idPuertoDestino']        = 'error/No ha seleccionado el Puerto Destino';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']=='Sin Datos' ){                         $error['idMercado']              = 'error/No ha seleccionado el Mercado';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']=='Sin Datos' ){     $error['idEmpresaTransporte']    = 'error/No ha seleccionado la Empresa Transporte';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']=='Sin Datos' ){             $error['ChoferNombreRut']        = 'error/No ha ingresado el Conductor';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']=='Sin Datos' ){                 $error['PatenteCamion']          = 'error/No ha ingresado la Patente Camion';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']=='Sin Datos' ){                   $error['PatenteCarro']           = 'error/No ha ingresado la Patente Carro';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']=='Sin Datos' ){                     $error['idCondicion']            = 'error/No ha seleccionado la Condicion CTN';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']=='Sin Datos' ){                         $error['idSellado']              = 'error/No ha seleccionado el Sellado Piso';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']=='Sin Datos' ){                         $error['TSetPoint']              = 'error/No ha ingresado la T° Set Point';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']=='Sin Datos' ){                         $error['TAmbiente']              = 'error/No ha ingresado la T° Ambiente';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']=='Sin Datos' ){                     $error['NumeroSello']            = 'error/No ha ingresado el Numero de sello';}
				if(!isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']) OR $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']=='Sin Datos' ){                     $error['idInspector']            = 'error/No ha seleccionado el Inspector';}

			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de datos';
			}
			
			
			/******************************************/
			//Se verifican las estibas
			if (isset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass])){
				foreach ($_SESSION['cross_shipping_consolidacion_estibas'][$randompass] as $key => $producto){
					$n_data1++;
				}
			}
			if(isset($n_data1)&&$n_data1==0){
				$error['estibas'] = 'error/No se han asignado estibas';
			}
			/******************************************/
			//Se verifican los archivos
			if (isset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass])){
				foreach ($_SESSION['cross_shipping_consolidacion_archivos'][$randompass] as $key => $producto){
					$n_data2++;
				}
			}
			if(isset($n_data2)&&$n_data2==0){
				$error['estibas'] = 'error/No se han asignado archivos';
			}
			/******************************************/
			//Consulto el ultimo NInforme
			$rowNInforme = db_select_data (false, 'NInforme', 'cross_shipping_consolidacion', '', 'idSistema = '.$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema'].' ORDER BY NInforme DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			//Verifico la existencia
			if(isset($rowNInforme['NInforme'])&&$rowNInforme['NInforme']!=''){
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme'] = $rowNInforme['NInforme'] + 1;
			}else{
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme'] = 1;
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema'] != ''){             $a  = "'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']."'" ;    }else{$a  = "''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario'] != ''){             $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto'] != ''){           $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia'] != ''){          $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme'] != ''){                            $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']."'" ;              }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque'] != ''){      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga'] != ''){              $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque'] != ''){    $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga'] != ''){            $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho'] != ''){            $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria'] != ''){                      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']."'" ;           }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto'] != ''){                        $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']."'" ;            }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas'] != ''){                  $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo'] != ''){                  $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera'] != ''){                          $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque'] != ''){            $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino'] != ''){              $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado'] != ''){                          $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais'] != ''){                                $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']."'" ;                }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor'] != ''){                      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']."'" ;           }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte'] != ''){      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut'] != ''){              $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion'] != ''){                  $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro'] != ''){                    $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion'] != ''){                      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']."'" ;           }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado'] != ''){                          $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint'] != ''){                          $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion'] != ''){                    $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente'] != ''){                          $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello'] != ''){                      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']."'" ;           }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector'] != ''){                      $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']."'" ;           }else{$a .= ",''";}
				if(isset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']) && $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones'] != ''){                  $a .= ",'".$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']."'" ;         }else{$a .= ",''";}
				$a .= ",'1'";
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_shipping_consolidacion` (idSistema, idUsuario, fecha_auto, 
				Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano,CTNNombreCompañia, NInforme,
				FechaInicioEmbarque, HoraInicioCarga, FechaTerminoEmbarque, HoraTerminoCarga, idPlantaDespacho,
				idCategoria, idProducto, CantidadCajas, idInstructivo, idNaviera, idPuertoEmbarque, idPuertoDestino, 
				idMercado,idPais, idRecibidor, idEmpresaTransporte, ChoferNombreRut, PatenteCamion, PatenteCarro, idCondicion, 
				idSellado,TSetPoint, TVentilacion, TAmbiente, NumeroSello, idInspector, Observaciones, idEstado ) 
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
		
					/*********************************************************************/		
					//Se guardan los datos de las estibas	
					if(isset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass])){		
						foreach ($_SESSION['cross_shipping_consolidacion_estibas'][$randompass] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                           $a  = "'".$ultimo_id."'" ;                          }else{$a  = "''";}
							if(isset($producto['idEstiba']) && $producto['idEstiba'] != ''){                     $a .= ",'".$producto['idEstiba']."'" ;              }else{$a .= ",''";}
							if(isset($producto['idEstibaUbicacion']) && $producto['idEstibaUbicacion'] != ''){   $a .= ",'".$producto['idEstibaUbicacion']."'" ;     }else{$a .= ",''";}
							if(isset($producto['idPosicion']) && $producto['idPosicion'] != ''){                 $a .= ",'".$producto['idPosicion']."'" ;            }else{$a .= ",''";}
							if(isset($producto['idEnvase']) && $producto['idEnvase'] != ''){                     $a .= ",'".$producto['idEnvase']."'" ;              }else{$a .= ",''";}
							if(isset($producto['NPallet']) && $producto['NPallet'] != ''){                       $a .= ",'".$producto['NPallet']."'" ;               }else{$a .= ",''";}
							if(isset($producto['Temperatura']) && $producto['Temperatura'] != ''){               $a .= ",'".$producto['Temperatura']."'" ;           }else{$a .= ",''";}
							if(isset($producto['idTermografo']) && $producto['idTermografo'] != ''){             $a .= ",'".$producto['idTermografo']."'" ;          }else{$a .= ",''";}
							if(isset($producto['NSerieSensor']) && $producto['NSerieSensor'] != ''){             $a .= ",'".$producto['NSerieSensor']."'" ;          }else{$a .= ",''";}
							
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cross_shipping_consolidacion_estibas` (idConsolidacion,idEstiba,
							idEstibaUbicacion, idPosicion, idEnvase, NPallet, Temperatura, idTermografo, NSerieSensor) 
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
						}
					}
					/*********************************************************************/		
					//Archivos
					if(isset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass])){		
						foreach ($_SESSION['cross_shipping_consolidacion_archivos'][$randompass] as $key => $productos){
							foreach ($productos as $producto) {
								if(isset($producto['idFile'])&&$producto['idFile']!=0){
									//filtros
									if(isset($ultimo_id) && $ultimo_id != ''){                                  $a  = "'".$ultimo_id."'" ;                   }else{$a  = "''";}
									if(isset($producto['idArchivoTipo']) && $producto['idArchivoTipo'] != ''){  $a .= ",'".$producto['idArchivoTipo']."'" ;  }else{$a .= ",''";}
									if(isset($producto['Nombre']) && $producto['Nombre'] != ''){                $a .= ",'".$producto['Nombre']."'" ;         }else{$a .= ",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `cross_shipping_consolidacion_archivo` (idConsolidacion, idArchivoTipo,Nombre) 
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
								}
							}
						}
					}
					/***********************************************************************************************/
					/***********************************************************************************************/
					//envio correos
					$arrCorreos = array();
					$arrCorreos = db_select_array (false, 'usuarios_listado.usuario AS UsuarioNick, usuarios_listado.email AS UsuarioEmail, usuarios_listado.Nombre AS UsuarioNombre, core_sistemas.Nombre AS SistemaNombre, core_sistemas.Contacto_Email AS SistemaEmail, core_sistemas.Config_Gmail_Usuario AS Gmail_Usuario, core_sistemas.Config_Gmail_Password AS Gmail_Password', 'sistema_aprobador_cross', 'LEFT JOIN `usuarios_listado` ON usuarios_listado.idUsuario = sistema_aprobador_cross.idUsuario LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = sistema_aprobador_cross.idSistema', 'sistema_aprobador_cross.idSistema='.$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema'], 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					//Declaracion de variables
					$ProdMuestra         = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ProdMuestra'];     
					$Instructivo         = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Instructivo'];  
					$Pais                = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Pais'];  
					$Mercado             = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Mercado'];
					$Naviera             = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Naviera'];
					$PlantaDespacho      = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PlantaDespacho'];
					$Creacion_fecha      = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha'];
					$NInforme            = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme'];
					$CTNNombreCompañia   = $_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia'];
					

					foreach ($arrCorreos as $correo) {
						/*******************/
						//Mensaje
						$xbody = '
						<h3>Notificacion creacion de Consolidacion</h3>
						<p>Una nueva consolidacion ha sido creada, esta queda en espera de aprobacion</p>
						<p><strong>Planta Consolidacion :</strong>'.$PlantaDespacho.'</p>
						<p><strong>Fecha del informe :</strong>'.fecha_estandar($Creacion_fecha).'</p>
						<p><strong>Numero del Informe :</strong>'.$NInforme.'</p>
						<p><strong>Contenedor Nro. :</strong>'.$CTNNombreCompañia.'</p>
						<p><strong>Naviera :</strong>'.$Naviera.'</p>
						<p><strong>Instructivo :</strong>'.$Instructivo.'</p>
						<p><strong>Mercado :</strong>'.$Mercado.'</p>
						<p><strong>Pais :</strong>'.$Pais.'</p>
						<p><strong>Especie/Variedad :</strong>'.$ProdMuestra.'</p>
						<a href="'.DB_SITE_MAIN.'/view_cross_shipping_consolidacion.php?view='.simpleEncode($ultimo_id, fecha_actual()).'">Ver Aqui</a> 
						';
						
						//Envio de correo
						$rmail = tareas_envio_correo($correo['SistemaEmail'], $correo['SistemaNombre'], 
													 $correo['UsuarioEmail'], $correo['UsuarioNombre'], 
													 '', '', 
													 'Notificacion creacion de Consolidacion', 
													 $xbody,'', 
													 '', 
													 1, 
													 $correo['Gmail_Usuario'], 
													 $correo['Gmail_Password']);
						//se guarda el log
						log_response(1, $rmail, $correo['UsuarioEmail'].' (Asunto:Notificacion creacion de Consolidacion)');	
					}
					
					/*********************************************************************/
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['cross_shipping_consolidacion_basicos'][$randompass]);
					unset($_SESSION['cross_shipping_consolidacion_estibas'][$randompass]);
					unset($_SESSION['cross_shipping_consolidacion_archivos'][$randompass]);
					unset($_SESSION['cross_shipping_consolidacion_temporal'][$randompass]);
					
					
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	

/*******************************************************************************************************************/
		case 'rechazo_consolidacion':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEstado='3'" ;
				if(isset($Observacion) && $Observacion != ''){        $a .= ",Observacion='".$Observacion."'" ; }
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idAprobador='".$idUsuario."'" ;   }
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  $a .= ",Aprobacion_Fecha='".$Creacion_fecha."'" ;   }
				if(isset($Creacion_hora) && $Creacion_hora != ''){    $a .= ",Aprobacion_Hora='".$Creacion_hora."'" ;   }
				
				// Actualizo los datos
				$query  = "UPDATE `cross_shipping_consolidacion` SET ".$a." WHERE idConsolidacion = '".$idConsolidacion."'";
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
				
				// Actualizo los datos
				$query  = "UPDATE `cross_shipping_consolidacion_archivos` SET ".$a." WHERE idConsolidacion = '".$idConsolidacion."'";
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
				
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;
/*******************************************************************************************************************/
		case 'nula_consolidacion':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEstado='4'" ;
				if(isset($Observacion) && $Observacion != ''){        $a .= ",Observacion='".$Observacion."'" ; }
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idAprobador='".$idUsuario."'" ;   }
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  $a .= ",Aprobacion_Fecha='".$Creacion_fecha."'" ;   }
				if(isset($Creacion_hora) && $Creacion_hora != ''){    $a .= ",Aprobacion_Hora='".$Creacion_hora."'" ;   }
				
				// Actualizo los datos
				$query  = "UPDATE `cross_shipping_consolidacion` SET ".$a." WHERE idConsolidacion = '".$idConsolidacion."'";
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
				
				
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;
/*******************************************************************************************************************/
		case 'aprob_consolidacion':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$idConsolidacion  = $_GET['consolidacion_aprobar'];
			$Creacion_fecha   = fecha_actual();
			$Creacion_hora    = hora_actual();
			$idUsuario        = $_SESSION['usuario']['basic_data']['idUsuario'];
				
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idConsolidacion)&&$idConsolidacion!=''&&isset($idUsuario)&&$idUsuario!=''){
				$ndata_1 = db_select_nrows (false, 'idConsolidacion', 'cross_shipping_consolidacion_aprobaciones', '', "idConsolidacion='".$idConsolidacion."' AND idUsuario='".$idUsuario."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La aprobacion ya fue realizada';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/**********************************************************/
				//Inserto la aprobacion en la tabla de aprobaciones
				if(isset($idConsolidacion) && $idConsolidacion != ''){  $a  = "'".$idConsolidacion."'" ;   }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_shipping_consolidacion_aprobaciones` (idConsolidacion, Creacion_fecha, Creacion_hora, idUsuario) 
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
				
				/**********************************************************/
				//Reviso si las aprobaciones igualan a los aprobadores
				$arrAprobado = array();
				$arrAprobado = db_select_array (false, 'sistema_aprobador_cross.idUsuario, cross_shipping_consolidacion.idConsolidacion, (SELECT COUNT(idAprobaciones) FROM `cross_shipping_consolidacion_aprobaciones` WHERE idConsolidacion=cross_shipping_consolidacion.idConsolidacion AND idUsuario=sistema_aprobador_cross.idUsuario  LIMIT 1) AS C_apro', 'cross_shipping_consolidacion', 'LEFT JOIN `sistema_aprobador_cross`  ON sistema_aprobador_cross.idSistema   = cross_shipping_consolidacion.idSistema', 'cross_shipping_consolidacion.idConsolidacion = '.$idConsolidacion, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
											
				//variables
				$napro_list = 0;
				$napro_true = 0;
				foreach ($arrAprobado as $apro) {
					$napro_list++;
					if(isset($apro['C_apro'])&&$apro['C_apro']==1){
						$napro_true++;
					}
				}
				
				//Si por lo menos hay una aprobacion
				if($napro_true>=1){
					//Filtros
					$a = "idEstado='2'" ;
					
					// Actualizo los datos
					$query  = "UPDATE `cross_shipping_consolidacion` SET ".$a." WHERE idConsolidacion = '".$_GET['consolidacion_aprobar']."'";
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
					
					
					
					/*********************************************************************/
					/*********************************************************************/
					//envio correos
					$arrCorreos = array();
					$arrCorreos = db_select_array (false, 'sistema_cross_email_aprobados.email AS Email, core_sistemas.Nombre AS SistemaNombre, core_sistemas.Contacto_Email AS SistemaEmail, core_sistemas.Config_Gmail_Usuario AS Gmail_Usuario, core_sistemas.Config_Gmail_Password AS Gmail_Password', 'sistema_cross_email_aprobados', 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = sistema_cross_email_aprobados.idSistema', 'sistema_cross_email_aprobados.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'], 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
											
					/************************************************************/
					// Se trae la informacion del producto
					$SIS_query = '
					cross_shipping_plantas.Nombre AS PlantaNombre,
					cross_shipping_plantas.Codigo AS PlantaCodigo,
					cross_shipping_consolidacion.Creacion_fecha,
					cross_shipping_consolidacion.CTNNombreCompañia,
					cross_shipping_consolidacion.NInforme,
					cross_shipping_naviera.Nombre AS NavieraNombre,
					cross_shipping_naviera.Codigo AS NavieraCodigo,
					cross_shipping_mercado.Nombre AS MercadoNombre,
					cross_shipping_mercado.Codigo AS MercadoCodigo,
					cross_shipping_instructivo.Nombre AS InstructivoNombre,
					cross_shipping_instructivo.Codigo AS InstructivoCodigo,
					core_paises.Nombre AS PaisesNombre,
					sistema_variedades_categorias.Nombre AS Especie,
					variedades_listado.Nombre AS Variedad';
					$SIS_join  = '
					LEFT JOIN `cross_shipping_plantas`          ON cross_shipping_plantas.idPlantaDespacho      = cross_shipping_consolidacion.idPlantaDespacho
					LEFT JOIN `cross_shipping_naviera`          ON cross_shipping_naviera.idNaviera             = cross_shipping_consolidacion.idNaviera
					LEFT JOIN `cross_shipping_mercado`          ON cross_shipping_mercado.idMercado             = cross_shipping_consolidacion.idMercado
					LEFT JOIN `core_paises`                     ON core_paises.idPais                           = cross_shipping_consolidacion.idPais
					LEFT JOIN `sistema_variedades_categorias`   ON sistema_variedades_categorias.idCategoria    = cross_shipping_consolidacion.idCategoria
					LEFT JOIN `variedades_listado`              ON variedades_listado.idProducto                = cross_shipping_consolidacion.idProducto
					LEFT JOIN `cross_shipping_instructivo`      ON cross_shipping_instructivo.idInstructivo     = cross_shipping_consolidacion.idInstructivo
					';
					$SIS_where = 'cross_shipping_consolidacion.idConsolidacion ='.$idConsolidacion;
					$rowConso = db_select_data (false, $SIS_query, 'cross_shipping_consolidacion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
				
					foreach ($arrCorreos as $correo) {
						/*******************/
						//Mensaje
						$xbody = '
						<h3>Notificacion aprobacion de Consolidacion</h3>
						<p>Una nueva consolidacion ha sido aprobada</p>
						<p><strong>Planta Consolidacion :</strong>'.$rowConso['PlantaCodigo'].' - '.$rowConso['PlantaNombre'].'</p>
						<p><strong>Fecha del informe :</strong>'.fecha_estandar($rowConso['Creacion_fecha']).'</p>
						<p><strong>Numero del Informe :</strong>'.$rowConso['NInforme'].'</p>
						<p><strong>Contenedor Nro. :</strong>'.$rowConso['CTNNombreCompañia'].'</p>
						<p><strong>Naviera :</strong>'.$rowConso['NavieraCodigo'].' - '.$rowConso['NavieraNombre'].'</p>
						<p><strong>Instructivo :</strong>'.$rowConso['InstructivoCodigo'].' - '.$rowConso['InstructivoNombre'].'</p>
						<p><strong>Mercado :</strong>'.$rowConso['MercadoCodigo'].' - '.$rowConso['MercadoNombre'].'</p>
						<p><strong>Pais :</strong>'.$rowConso['PaisesNombre'].'</p>
						<p><strong>Especie/Variedad :</strong>'.$rowConso['Especie'].' - '.$rowConso['Variedad'].'</p>
						<a href="'.DB_SITE_MAIN.'/view_cross_shipping_consolidacion.php?view='.simpleEncode($idConsolidacion, fecha_actual()).'">Ver Aqui</a> 
						';
						/*******************/
						//Envio de correo
						$rmail = tareas_envio_correo($correo['SistemaEmail'], $correo['SistemaNombre'], 
													 $correo['Email'], $correo['Email'], 
													 '', '', 
													 'Notificacion aprobacion de Consolidacion', 
													 $xbody,'', 
													 '', 
													 1, 
													 $correo['Gmail_Usuario'], 
													 $correo['Gmail_Password']);
                        //se guarda el log
						log_response(1, $rmail, $correo['Email'].' (Asunto:Notificacion aprobacion de Consolidacion)');
						                 
                        //Envio del mensaje
						if ($rmail!=1) {
							//echo "Mailer Error: " . $rmail;
						} else {
							//echo "Message sent!";
						}
					}
					
				}	
				
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;		
/*******************************************************************************************************************/
		case 'aprob_auto_consolidacion':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idEstado='2'" ;
					
				// Actualizo los datos
				$query  = "UPDATE `cross_shipping_consolidacion` SET ".$a." WHERE idConsolidacion = '".$_GET['consolidacion_aprobar']."'";
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
					
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;
/*******************************************************************************************************************/		
		case 'clona_ingreso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['randompass']             = $randompass;
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ProdMuestra']            = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['ProdMuestra'];
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CTNNombreCompañia']      = $CTNNombreCompañia;                                                                               
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NInforme']               = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['NInforme'];                
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Creacion_fecha']         = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['Creacion_fecha'];          
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaInicioEmbarque']    = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['FechaInicioEmbarque'];    
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraInicioCarga']        = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['HoraInicioCarga'];         
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['FechaTerminoEmbarque']   = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['FechaTerminoEmbarque'];   
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['HoraTerminoCarga']       = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['HoraTerminoCarga'];        
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPlantaDespacho']       = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idPlantaDespacho'];        
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCategoria']            = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idCategoria'];             
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idProducto']             = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idProducto'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['CantidadCajas']          = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['CantidadCajas'];          
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInstructivo']          = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idInstructivo'];          
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idNaviera']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idNaviera'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoEmbarque']       = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idPuertoEmbarque'];        
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPuertoDestino']        = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idPuertoDestino'];        
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idMercado']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idMercado'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idPais']                 = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idPais'];                  
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idRecibidor']            = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idRecibidor'];                  
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idEmpresaTransporte']    = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idEmpresaTransporte'];    
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['ChoferNombreRut']        = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['ChoferNombreRut'];        
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCamion']          = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['PatenteCamion'];           
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['PatenteCarro']           = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['PatenteCarro'];           
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idCondicion']            = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idCondicion'];             
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSellado']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idSellado'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TSetPoint']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['TSetPoint'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TVentilacion']           = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['TVentilacion'];           
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['TAmbiente']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['TAmbiente'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['NumeroSello']            = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['NumeroSello'];             
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idInspector']            = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idInspector'];            
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['Observaciones']          = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['Observaciones'];          
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idSistema']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idSistema'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['idUsuario']              = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['idUsuario'];              
				$_SESSION['cross_shipping_consolidacion_basicos'][$randompass]['fecha_auto']             = $_SESSION['cross_shipping_consolidacion_basicos'][$cloneConsolidacion]['fecha_auto'];             
				
	
				header( 'Location: '.$location.'&view='.$randompass );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'updateConsolidacion':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idConsolidacion='".$idConsolidacion."'" ;
				if(isset($idSistema) && $idSistema != ''){     $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){     $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($fecha_auto) && $fecha_auto != ''){   $a .= ",fecha_auto='".$fecha_auto."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){      
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;  
					$a .= ",Creacion_Semana='".fecha2NSemana($Creacion_fecha)."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				
				}
				if(isset($CTNNombreCompañia) && $CTNNombreCompañia != ''){            $a .= ",CTNNombreCompañia='".$CTNNombreCompañia."'" ;}
				if(isset($NInforme) && $NInforme != ''){                              $a .= ",NInforme='".$NInforme."'" ;}
				if(isset($FechaInicioEmbarque) && $FechaInicioEmbarque != ''){        $a .= ",FechaInicioEmbarque='".$FechaInicioEmbarque."'" ;}
				if(isset($HoraInicioCarga) && $HoraInicioCarga != ''){                $a .= ",HoraInicioCarga='".$HoraInicioCarga."'" ;}
				if(isset($FechaTerminoEmbarque) && $FechaTerminoEmbarque != ''){      $a .= ",FechaTerminoEmbarque='".$FechaTerminoEmbarque."'" ;}
				if(isset($HoraTerminoCarga) && $HoraTerminoCarga != ''){              $a .= ",HoraTerminoCarga='".$HoraTerminoCarga."'" ;}
				if(isset($idPlantaDespacho) && $idPlantaDespacho != ''){              $a .= ",idPlantaDespacho='".$idPlantaDespacho."'" ;}
				if(isset($idCategoria) && $idCategoria != ''){                        $a .= ",idCategoria='".$idCategoria."'" ;}
				if(isset($idProducto) && $idProducto != ''){                          $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($CantidadCajas) && $CantidadCajas != ''){                    $a .= ",CantidadCajas='".$CantidadCajas."'" ;}
				if(isset($idInstructivo) && $idInstructivo != ''){                    $a .= ",idInstructivo='".$idInstructivo."'" ;}
				if(isset($idNaviera) && $idNaviera != ''){                            $a .= ",idNaviera='".$idNaviera."'" ;}
				if(isset($idPuertoEmbarque) && $idPuertoEmbarque != ''){              $a .= ",idPuertoEmbarque='".$idPuertoEmbarque."'" ;}
				if(isset($idPuertoDestino) && $idPuertoDestino != ''){                $a .= ",idPuertoDestino='".$idPuertoDestino."'" ;}
				if(isset($idMercado) && $idMercado != ''){                            $a .= ",idMercado='".$idMercado."'" ;}
				if(isset($idPais) && $idPais != ''){                                  $a .= ",idPais='".$idPais."'" ;}
				if(isset($idRecibidor) && $idRecibidor != ''){                        $a .= ",idRecibidor='".$idRecibidor."'" ;}
				if(isset($idEmpresaTransporte) && $idEmpresaTransporte != ''){        $a .= ",idEmpresaTransporte='".$idEmpresaTransporte."'" ;}
				if(isset($ChoferNombreRut) && $ChoferNombreRut != ''){                $a .= ",ChoferNombreRut='".$ChoferNombreRut."'" ;}
				if(isset($PatenteCamion) && $PatenteCamion != ''){                    $a .= ",PatenteCamion='".$PatenteCamion."'" ;}
				if(isset($PatenteCarro) && $PatenteCarro != ''){                      $a .= ",PatenteCarro='".$PatenteCarro."'" ;}
				if(isset($idCondicion) && $idCondicion != ''){                        $a .= ",idCondicion='".$idCondicion."'" ;}
				if(isset($idSellado) && $idSellado != ''){                            $a .= ",idSellado='".$idSellado."'" ;}
				if(isset($TSetPoint) && $TSetPoint != ''){                            $a .= ",TSetPoint='".$TSetPoint."'" ;}
				if(isset($TVentilacion) && $TVentilacion != ''){                      $a .= ",TVentilacion='".$TVentilacion."'" ;}
				if(isset($TAmbiente) && $TAmbiente != ''){                            $a .= ",TAmbiente='".$TAmbiente."'" ;}
				if(isset($NumeroSello) && $NumeroSello != ''){                        $a .= ",NumeroSello='".$NumeroSello."'" ;}
				if(isset($idInspector) && $idInspector != ''){                        $a .= ",idInspector='".$idInspector."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){                    $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($idEstado) && $idEstado != ''){                              $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Observacion) && $Observacion != ''){                        $a .= ",Observacion='".$Observacion."'" ;}
				if(isset($idAprobador) && $idAprobador != ''){                        $a .= ",idAprobador='".$idAprobador."'" ;}
				if(isset($Aprobacion_Fecha) && $Aprobacion_Fecha != ''){              $a .= ",Aprobacion_Fecha='".$Aprobacion_Fecha."'" ;}
				if(isset($Aprobacion_Hora) && $Aprobacion_Hora != ''){                $a .= ",Aprobacion_Hora='".$Aprobacion_Hora."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_shipping_consolidacion` SET ".$a." WHERE idConsolidacion = '$idConsolidacion'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				//si da error, guardar en el log de errores una copia
				}else{
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
				
			}
		
	
		break;	
/*******************************************************************************************************************/		
		case 'insertEstiba':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idConsolidacion) && $idConsolidacion != ''){          $a  = "'".$idConsolidacion."'" ;       }else{$a  ="''";}
				if(isset($idEstiba) && $idEstiba != ''){                        $a .= ",'".$idEstiba."'" ;             }else{$a .=",''";}
				if(isset($idEstibaUbicacion) && $idEstibaUbicacion != ''){      $a .= ",'".$idEstibaUbicacion."'" ;    }else{$a .=",''";}
				if(isset($idPosicion) && $idPosicion != ''){                    $a .= ",'".$idPosicion."'" ;           }else{$a .=",''";}
				if(isset($idEnvase) && $idEnvase != ''){                        $a .= ",'".$idEnvase."'" ;             }else{$a .=",''";}
				if(isset($NPallet) && $NPallet != ''){                          $a .= ",'".$NPallet."'" ;              }else{$a .=",''";}
				if(isset($Temperatura) && $Temperatura != ''){                  $a .= ",'".$Temperatura."'" ;          }else{$a .=",''";}
				if(isset($idTermografo) && $idTermografo != ''){                $a .= ",'".$idTermografo."'" ;         }else{$a .=",''";}
				if(isset($NSerieSensor) && $NSerieSensor != ''){                $a .= ",'".$NSerieSensor."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_shipping_consolidacion_estibas` (idConsolidacion, idEstiba, idEstibaUbicacion,
				idPosicion, idEnvase, NPallet, Temperatura, idTermografo, NSerieSensor ) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&created=true' );
					die;
					
				//si da error, guardar en el log de errores una copia
				}else{
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'updateEstiba':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEstibaListado='".$idEstibaListado."'" ;
				if(isset($idConsolidacion) && $idConsolidacion != ''){       $a .= ",idConsolidacion='".$idConsolidacion."'" ;}
				if(isset($idEstiba) && $idEstiba != ''){                     $a .= ",idEstiba='".$idEstiba."'" ;}
				if(isset($idEstibaUbicacion) && $idEstibaUbicacion != ''){   $a .= ",idEstibaUbicacion='".$idEstibaUbicacion."'" ;}
				if(isset($idPosicion) && $idPosicion != ''){                 $a .= ",idPosicion='".$idPosicion."'" ;}
				if(isset($idEnvase) && $idEnvase != ''){                     $a .= ",idEnvase='".$idEnvase."'" ;}
				if(isset($NPallet) && $NPallet != ''){                       $a .= ",NPallet='".$NPallet."'" ;}
				if(isset($Temperatura) && $Temperatura != ''){               $a .= ",Temperatura='".$Temperatura."'" ;}
				if(isset($idTermografo) && $idTermografo != ''){             $a .= ",idTermografo='".$idTermografo."'" ;}
				if(isset($NSerieSensor) && $NSerieSensor != ''){             $a .= ",NSerieSensor='".$NSerieSensor."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_shipping_consolidacion_estibas` SET ".$a." WHERE idEstibaListado = '$idEstibaListado'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				//si da error, guardar en el log de errores una copia
				}else{
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
				
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'delEstiba':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_estiba']) OR !validaEntero($_GET['del_estiba']))&&$_GET['del_estiba']!=''){
				$indice = simpleDecode($_GET['del_estiba'], fecha_actual());
			}else{
				$indice = $_GET['del_estiba'];
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
				//se borran los datos
				$resultado = db_delete_data (false, 'cross_shipping_consolidacion_estibas', 'idEstibaListado = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
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
		//Cambia el nivel del permiso
		case 'insert_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			//Se verifica que el archivo subido no exceda los 100 kb
			$limite_kb = 10000;
			//Sufijo
			$sufijo = 'cross_ship_conso_'.$CTNNombreCompañia.'_'.fecha_actual().'_'.$idArchivoTipo.'_';
			//Se verifican las extensiones de los archivos
			$permitidos = array("application/msword",
								"application/vnd.ms-word",
								"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
									
								"application/msexcel",
								"application/vnd.ms-excel",
								"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
											
								"application/mspowerpoint",
								"application/vnd.ms-powerpoint",
								"application/vnd.openxmlformats-officedocument.presentationml.presentation",
											
								"application/pdf",
								"application/octet-stream",
								"application/x-real",
								"application/vnd.adobe.xfdf",
								"application/vnd.fdf",
								"binary/octet-stream",
											
								"image/jpg", 
								"image/jpeg", 
								"image/gif", 
								"image/png"

								);
											
											
			//Verifico errores en los archivos
			foreach($_FILES["exFile"]["tmp_name"] as $key=>$tmp_name){
				if ($_FILES["exFile"]["error"][$key] > 0){ 
					$error['exFile'] = 'error/'.uploadPHPError($_FILES["exFile"]["error"][$key]); 
				}
				if (in_array($_FILES['exFile']['type'][$key], $permitidos) && $_FILES['exFile']['size'][$key] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['exFile']['name'][$key];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (file_exists($ruta)){
						$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'][$key].' ya existe'; 
					}
				} else {
					$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}
			


			if ( empty($error) ) {
								
				//Verifico errores en los archivos
				foreach($_FILES["exFile"]["tmp_name"] as $key=>$tmp_name){
					if ($_FILES["exFile"]["error"][$key] > 0){ 
						$error['exFile'] = 'error/'.uploadPHPError($_FILES["exFile"]["error"][$key]); 
					}
					if (in_array($_FILES['exFile']['type'][$key], $permitidos) && $_FILES['exFile']['size'][$key] <= $limite_kb * 1024){
						//Se especifica carpeta de destino
						$ruta = "upload/".$sufijo.$_FILES['exFile']['name'][$key];
						//Se verifica que el archivo un archivo con el mismo nombre no existe
						if (!file_exists($ruta)){
							//Se mueve el archivo a la carpeta previamente configurada
							$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"][$key], $ruta);
							if ($move_result){
								
								
								//renombro archivo
								$Nombre = $sufijo.$_FILES['exFile']['name'][$key];					
								//filtros
								if(isset($idConsolidacion) && $idConsolidacion != ''){  $a  = "'".$idConsolidacion."'" ;   }else{$a  ="''";}
								if(isset($idArchivoTipo) && $idArchivoTipo != ''){      $a .= ",'".$idArchivoTipo."'" ;    }else{$a .=",''";}
								if(isset($Nombre) && $Nombre != ''){                    $a .= ",'".$Nombre."'" ;           }else{$a .=",''";}
								
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `cross_shipping_consolidacion_archivo` (idConsolidacion, idArchivoTipo, Nombre ) 
								VALUES (".$a.")";
								//Consulta
								$resultado = mysqli_query ($dbConn, $query);
								//Si no ejecuto correctamente la consulta
								if(!$resultado){
									//Genero numero aleatorio
									$vardata = genera_password(8,'alfanumerico');
									
									//Guardo el error en una variable temporal
									$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
									$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
									$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
								}

							} else {
								$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
							}
						}else{
							$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'][$key].' ya existe'; 
						}
					} else {
						$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
					}
				}
				
				header( 'Location: '.$location.'&created=true' );
				die;
	
				
			}
			
			

		break;	
/*******************************************************************************************************************/
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_file']) OR !validaEntero($_GET['del_file']))&&$_GET['del_file']!=''){
				$indice = simpleDecode($_GET['del_file'], fecha_actual());
			}else{
				$indice = $_GET['del_file'];
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
				// Se obtiene el nombre del logo
				$rowdata = db_select_data (false, 'Nombre', 'cross_shipping_consolidacion_archivo', '', 'idArchivo = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//se borran los datos
				$resultado = db_delete_data (false, 'cross_shipping_consolidacion_archivo', 'idArchivo = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//se elimina el archivo
					if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['Nombre'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['Nombre']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					
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
		case 'modEdit':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "UPDATE `cross_shipping_consolidacion` SET idEstado=1 WHERE idConsolidacion = '".$_GET['edit']."'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			//si da error, guardar en el log de errores una copia
			}else{
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			
						
		break;	
/*******************************************************************************************************************/
		case 'reversar':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['reversar']) OR !validaEntero($_GET['reversar']))&&$_GET['reversar']!=''){
				$indice = simpleDecode($_GET['reversar'], fecha_actual());
			}else{
				$indice = $_GET['reversar'];
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
				//se reversa
				$query  = "UPDATE `cross_shipping_consolidacion` SET idEstado=1 WHERE idConsolidacion = '".$indice."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				
				//se borran los datos
				$resultado = db_delete_data (false, 'cross_shipping_consolidacion_aprobaciones', 'idConsolidacion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
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
