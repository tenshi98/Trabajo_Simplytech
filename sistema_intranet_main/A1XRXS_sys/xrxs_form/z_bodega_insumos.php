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
	if ( !empty($_POST['idDocumentos']) )      $idDocumentos        = $_POST['idDocumentos'];
	if ( !empty($_POST['N_Doc']) )             $N_Doc               = $_POST['N_Doc'];
	if ( !empty($_POST['idBodega']) )          $idBodega            = $_POST['idBodega'];
	if ( !empty($_POST['Observaciones']) )     $Observaciones       = $_POST['Observaciones'];
	if ( !empty($_POST['idSistema']) )         $idSistema           = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )         $idUsuario           = $_POST['idUsuario'];
	if ( !empty($_POST['Creacion_fecha']) )    $Creacion_fecha      = $_POST['Creacion_fecha'];
	if ( !empty($_POST['idTipo']) )            $idTipo              = $_POST['idTipo'];
	if ( !empty($_POST['idProducto']) )        $idProducto          = $_POST['idProducto'];
	if ( !empty($_POST['Number']) )            $Number              = $_POST['Number'];
	if ( !empty($_POST['idBodegaOrigen']) )    $idBodegaOrigen      = $_POST['idBodegaOrigen'];
	if ( !empty($_POST['idBodegaDestino']) )   $idBodegaDestino     = $_POST['idBodegaDestino'];
	if ( !empty($_POST['Cantidad']) )          $Cantidad            = $_POST['Cantidad'];
	if ( !empty($_POST['maximo']) )            $maximo              = $_POST['maximo'];
	if ( !empty($_POST['idSistemaDestino']) )  $idSistemaDestino    = $_POST['idSistemaDestino'];
	if ( !empty($_POST['idTrabajador']) )      $idTrabajador        = $_POST['idTrabajador'];
	if ( !empty($_POST['idProveedor']) )       $idProveedor         = $_POST['idProveedor'];
	if ( !empty($_POST['ValorIngreso']) )      $ValorIngreso        = $_POST['ValorIngreso'];
	if ( !empty($_POST['ValorEgreso']) )       $ValorEgreso         = $_POST['ValorEgreso'];
	if ( !empty($_POST['idGuia']) )            $idGuia              = $_POST['idGuia'];
	if ( !empty($_POST['idDocPago']) )         $idDocPago           = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )         $N_DocPago           = $_POST['N_DocPago'];
	if ( !empty($_POST['F_Pago']) )            $F_Pago              = $_POST['F_Pago'];
	if ( !empty($_POST['idFacturacion']) )     $idFacturacion       = $_POST['idFacturacion'];
	if ( !empty($_POST['idImpuesto']) )        $idImpuesto          = $_POST['idImpuesto'];
	if ( !empty($_POST['MontoPagado']) )       $MontoPagado         = $_POST['MontoPagado'];
	if ( !empty($_POST['oldItemID']) )         $oldItemID           = $_POST['oldItemID'];
	if ( !empty($_POST['montoPactado']) )      $montoPactado        = $_POST['montoPactado'];
	if ( !empty($_POST['fecha_auto']) )        $fecha_auto          = $_POST['fecha_auto'];
	if ( !empty($_POST['ValorTotal']) )        $ValorTotal          = $_POST['ValorTotal'];
	if ( !empty($_POST['Nombre']) )            $Nombre              = $_POST['Nombre'];
	if ( !empty($_POST['vTotal']) )            $vTotal              = $_POST['vTotal'];
	if ( !empty($_POST['oldidProducto']) )     $oldidProducto       = $_POST['oldidProducto'];
	if ( !empty($_POST['idCliente']) )         $idCliente           = $_POST['idCliente'];
	if ( !empty($_POST['idOcompra']) )         $idOcompra           = $_POST['idOcompra'];
	if ( !empty($_POST['OC_Ventas']) )         $OC_Ventas           = $_POST['OC_Ventas'];
	if ( !empty($_POST['Cantidad_ing']) )      $Cantidad_ing        = $_POST['Cantidad_ing'];
	if ( !empty($_POST['Cantidad_eg']) )       $Cantidad_eg         = $_POST['Cantidad_eg'];
	if ( !empty($_POST['vUnitario']) )         $vUnitario           = $_POST['vUnitario'];
	if ( !empty($_POST['idCentroCosto']) )     $idCentroCosto       = $_POST['idCentroCosto'];
	if ( !empty($_POST['idLevel_1']) )         $idLevel_1           = $_POST['idLevel_1'];
	if ( !empty($_POST['idLevel_2']) )         $idLevel_2           = $_POST['idLevel_2'];
	if ( !empty($_POST['idLevel_3']) )         $idLevel_3           = $_POST['idLevel_3'];
	if ( !empty($_POST['idLevel_4']) )         $idLevel_4           = $_POST['idLevel_4'];
	if ( !empty($_POST['idLevel_5']) )         $idLevel_5           = $_POST['idLevel_5'];
	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idDocumentos':      if(empty($idDocumentos)){      $error['idDocumentos']     = 'error/No ha ingresado el id';}break;
			case 'N_Doc':             if(empty($N_Doc)){             $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}break;
			case 'idBodega':          if(empty($idBodega)){          $error['idBodega']         = 'error/No ha seleccionado la bodega';}break;
			case 'Observaciones':     if(empty($Observaciones)){     $error['Observaciones']    = 'error/No ha ingresado las obsercaciones';}break;
			case 'idSistema':         if(empty($idSistema)){         $error['idSistema']        = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':         if(empty($idUsuario)){         $error['idUsuario']        = 'error/No ha seleccionado a un usuario';}break;
			case 'Creacion_fecha':    if(empty($Creacion_fecha)){    $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idTipo':            if(empty($idTipo)){            $error['idTipo']           = 'error/No ha seleccionado un tipo';}break;
			case 'idProducto':        if(empty($idProducto)){        $error['idProducto']       = 'error/No ha seleccionado un insumo';}break;
			case 'Number':            if(empty($Number)){            $error['Number']           = 'error/No ha ingresado un numero';}break;
			case 'idBodegaOrigen':    if(empty($idBodegaOrigen)){    $error['idBodegaOrigen']   = 'error/No ha seleccionado la bodega de origen';}break;
			case 'idBodegaDestino':   if(empty($idBodegaDestino)){   $error['idBodegaDestino']  = 'error/No ha seleccionado la bodega de destino';}break;
			case 'Cantidad':          if(empty($Cantidad)){          $error['Cantidad']         = 'error/No ha ingresado la cantidad';}break;
			case 'maximo':            if(empty($maximo)){            $error['maximo']           = 'error/No ha ingresado el maximo';}break;
			case 'idSistemaDestino':  if(empty($idSistemaDestino)){  $error['idSistemaDestino'] = 'error/No ha seleccionado el sistema de destino';}break;
			case 'idTrabajador':      if(empty($idTrabajador)){      $error['idTrabajador']     = 'error/No ha seleccionado un trabajador';}break;
			case 'idProveedor':       if(empty($idProveedor)){       $error['idProveedor']      = 'error/No ha seleccionado el proveedor';}break;
			case 'ValorIngreso':      if(empty($ValorIngreso)){      $error['ValorIngreso']     = 'error/No ha ingresado el valor de ingreso';}break;
			case 'ValorEgreso':       if(empty($ValorEgreso)){       $error['ValorEgreso']      = 'error/No ha ingresado el valor de egreso';}break;
			case 'idGuia':            if(empty($idGuia)){            $error['idGuia']           = 'error/No ha seleccionado una guia';}break;
			case 'idDocPago':         if(empty($idDocPago)){         $error['idDocPago']        = 'error/No ha seleccionado un documento de pago';}break;
			case 'N_DocPago':         if(empty($N_DocPago)){         $error['N_DocPago']        = 'error/No ha ingresado un numero de documento de pago';}break;
			case 'F_Pago':            if(empty($F_Pago)){            $error['F_Pago']           = 'error/No ha ingresado una fecha de vencimiento';}break;
			case 'idFacturacion':     if(empty($idFacturacion)){     $error['idFacturacion']    = 'error/No ha ingresado la id de la facturacion';}break;
			case 'idImpuesto':        if(empty($idImpuesto)){        $error['idImpuesto']       = 'error/No ha seleccionado el impuesto';}break;
			case 'MontoPagado':       if(empty($MontoPagado)){       $error['MontoPagado']      = 'error/No ha ingresado el monto de pago';}break;
			case 'montoPactado':      if(empty($montoPactado)){      $error['montoPactado']     = 'error/No ha ingresado el monto pactado';}break;
			case 'fecha_auto':        if(empty($fecha_auto)){        $error['fecha_auto']       = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Nombre':            if(empty($Nombre)){            $error['Nombre']           = 'error/No ha ingresado el nombre';}break;
			case 'vTotal':            if(empty($vTotal)){            $error['vTotal']           = 'error/No ha ingresado el valor total';}break;
			case 'oldidProducto':     if(empty($oldidProducto)){     $error['oldidProducto']    = 'error/No ha ingresado el id antiguo';}break;
			case 'idCliente':         if(empty($idCliente)){         $error['idCliente']        = 'error/No ha seleccionado el cliente';}break;
			case 'idOcompra':         if(empty($idOcompra)){         $error['idOcompra']        = 'error/No ha ingresado la OC';}break;
			case 'OC_Ventas':         if(empty($OC_Ventas)){         $error['OC_Ventas']        = 'error/No ha ingresado la OC Relacionada';}break;
			case 'Cantidad_ing':      if(empty($Cantidad_ing)){      $error['Cantidad_ing']     = 'error/No ha ingresado la cantidad';}break;
			case 'Cantidad_eg':       if(empty($Cantidad_eg)){       $error['Cantidad_eg']      = 'error/No ha ingresado la cantidad';}break;
			case 'vUnitario':         if(empty($vUnitario)){         $error['vUnitario']        = 'error/No ha ingresado el valor unitario';}break;
			
			case 'idCentroCosto':     if(empty($idCentroCosto)){     $error['idCentroCosto']    = 'error/No ha seleccionado el Centro de Costo';}break;
			case 'idLevel_1':         if(empty($idLevel_1)){         $error['idLevel_1']        = 'error/No ha seleccionado el Nivel 1';}break;
			case 'idLevel_2':         if(empty($idLevel_2)){         $error['idLevel_2']        = 'error/No ha seleccionado el Nivel 2';}break;
			case 'idLevel_3':         if(empty($idLevel_3)){         $error['idLevel_3']        = 'error/No ha seleccionado el Nivel 3';}break;
			case 'idLevel_4':         if(empty($idLevel_4)){         $error['idLevel_4']        = 'error/No ha seleccionado el Nivel 4';}break;
			case 'idLevel_5':         if(empty($idLevel_5)){         $error['idLevel_5']        = 'error/No ha seleccionado el Nivel 5';}break;
			
		}
	}	
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
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_basicos']);
				unset($_SESSION['insumos_ing_productos']);
				unset($_SESSION['insumos_ing_temporal']);
				unset($_SESSION['insumos_ing_guias']);
				unset($_SESSION['insumos_ing_impuestos']);
				unset($_SESSION['insumos_ing_descuentos']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_ing_archivos'])){
					foreach ($_SESSION['insumos_ing_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_ing_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_ing_basicos']['idDocumentos']    = $idDocumentos;
				$_SESSION['insumos_ing_basicos']['N_Doc']           = $N_Doc;
				$_SESSION['insumos_ing_basicos']['idBodega']        = $idBodega;
				$_SESSION['insumos_ing_basicos']['Observaciones']   = $Observaciones;
				$_SESSION['insumos_ing_basicos']['idSistema']       = $idSistema;
				$_SESSION['insumos_ing_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['insumos_ing_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['insumos_ing_basicos']['idTipo']          = $idTipo;
				$_SESSION['insumos_ing_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['insumos_ing_basicos']['fecha_auto']      = $fecha_auto;
				$_SESSION['insumos_ing_basicos']['Pago_fecha']      = '0000-00-00';
				$_SESSION['insumos_ing_basicos']['idOcompra']       = '';
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_ing_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_ing_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_ing_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_ing_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_ing_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_ing_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_ing_basicos']['idLevel_5']     = 0;
				
				
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_basicos']);
			unset($_SESSION['insumos_ing_productos']);
			unset($_SESSION['insumos_ing_temporal']);
			unset($_SESSION['insumos_ing_guias']);
			unset($_SESSION['insumos_ing_impuestos']);
			unset($_SESSION['insumos_ing_descuentos']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_ing_archivos'])){
				foreach ($_SESSION['insumos_ing_archivos'] as $key => $producto){
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
			unset($_SESSION['insumos_ing_archivos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['insumos_ing_productos']);
				unset($_SESSION['insumos_ing_guias']);
				unset($_SESSION['insumos_ing_impuestos']);
				unset($_SESSION['insumos_ing_descuentos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_ing_basicos']['idDocumentos']    = $idDocumentos;
				$_SESSION['insumos_ing_basicos']['N_Doc']           = $N_Doc;
				$_SESSION['insumos_ing_basicos']['idBodega']        = $idBodega;
				$_SESSION['insumos_ing_basicos']['idSistema']       = $idSistema;
				$_SESSION['insumos_ing_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['insumos_ing_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['insumos_ing_basicos']['idTipo']          = $idTipo;
				$_SESSION['insumos_ing_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['insumos_ing_basicos']['fecha_auto']      = $fecha_auto;
				$_SESSION['insumos_ing_basicos']['Pago_fecha']      = '0000-00-00';
				$_SESSION['insumos_ing_basicos']['idOcompra']       = '';
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			}
	
		break;
/*******************************************************************************************************************/		
		case 'modCentroCosto_ing':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_ing_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_ing_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;	
/*******************************************************************************************************************/		
		case 'addfpago':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$valor    = $_GET['val_select'];
			
			//Se comprueba las fechas
			if($_SESSION['insumos_ing_basicos']['Creacion_fecha']>$valor){
				$error['ndata_1'] = 'error/La fecha de vencimiento es anterior a la fecha de creacion';
			}
			
			//valido que no esten vacios
			if(empty($valor)){  $error['valor']  = 'error/No ha ingresado una fecha de vencimiento';}

			if ( empty($error) ) {
				
				$_SESSION['insumos_ing_basicos']['Pago_fecha'] = $valor;
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;		
/*******************************************************************************************************************/		
		case 'delfpago':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				$_SESSION['insumos_ing_basicos']['Pago_fecha'] = '0000-00-00';
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'new_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_ing_productos'][$idProducto[$j1]])&&$_SESSION['insumos_ing_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idEstado=1";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $producto){
					$arrProd['Prod'][$producto['idProducto']]['Nombre'] = $producto['Nombre'];
					$arrProd['Prod'][$producto['idProducto']]['Unimed'] = $producto['Unimed'];
				}
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_ing_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_ing_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_ing_productos'][$idProducto[$j1]]['ValorIngreso']  = $ValorTotal[$j1]/$Number[$j1];
					$_SESSION['insumos_ing_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];
					$_SESSION['insumos_ing_productos'][$idProducto[$j1]]['Nombre']        = $arrProd['Prod'][$idProducto[$j1]]['Nombre'];
					$_SESSION['insumos_ing_productos'][$idProducto[$j1]]['Unimed']        = $arrProd['Prod'][$idProducto[$j1]]['Unimed'];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			
		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_productos'][$idProducto])&&$_SESSION['insumos_ing_productos'][$idProducto]>0&&$_SESSION['insumos_ing_productos'][$idProducto]!=$_SESSION['insumos_ing_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			//Si la cantidad es determinada por una OC verificar si la modificacion no supera el maximo permitido
			if(isset($_SESSION['insumos_ing_basicos']['idOcompra'])&&$_SESSION['insumos_ing_basicos']['idOcompra']!=''){
				if($_SESSION['insumos_ing_productos'][$oldItemID]['cant_max']<($Number + $_SESSION['insumos_ing_productos'][$oldItemID]['cant_ingresada'])){
					$error['productos'] = 'error/No puede ingresar una cantidad superior a la solicitada en la OC (Maximo '.Cantidades_decimales_justos($_SESSION['insumos_ing_productos'][$oldItemID]['cant_max']-$_SESSION['insumos_ing_productos'][$oldItemID]['cant_ingresada']).')';
				}
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE idProducto=".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				
				//Guardo variables si existe una OC
				$temp_idExistencia     = 0;
				$temp_idFrecuencia     = 0;
				$temp_cant_ingresada   = 0;
				$temp_cant_max         = 0;
				
				if(isset($_SESSION['insumos_ing_basicos']['idOcompra'])&&$_SESSION['insumos_ing_basicos']['idOcompra']!=''){
					$temp_idExistencia     = $_SESSION['insumos_ing_productos'][$oldItemID]['idExistencia'];
					$temp_idFrecuencia     = $_SESSION['insumos_ing_productos'][$oldItemID]['idFrecuencia'];
					$temp_cant_ingresada   = $_SESSION['insumos_ing_productos'][$oldItemID]['cant_ingresada'];
					$temp_cant_max         = $_SESSION['insumos_ing_productos'][$oldItemID]['cant_max'];
				}
				
				//Borro el producto
				unset($_SESSION['insumos_ing_productos'][$oldItemID]);
			
				//creo el producto
				$_SESSION['insumos_ing_productos'][$idProducto]['idProducto']       = $idProducto;
				$_SESSION['insumos_ing_productos'][$idProducto]['Number']           = $Number;
				$_SESSION['insumos_ing_productos'][$idProducto]['ValorIngreso']     = $ValorIngreso;
				$_SESSION['insumos_ing_productos'][$idProducto]['ValorTotal']       = $ValorTotal;
				$_SESSION['insumos_ing_productos'][$idProducto]['idExistencia']     = $temp_idExistencia;
				$_SESSION['insumos_ing_productos'][$idProducto]['idFrecuencia']     = $temp_idFrecuencia;
				$_SESSION['insumos_ing_productos'][$idProducto]['cant_ingresada']   = $temp_cant_ingresada;
				$_SESSION['insumos_ing_productos'][$idProducto]['cant_max']         = $temp_cant_max;
				$_SESSION['insumos_ing_productos'][$idProducto]['Nombre']           = $rowProducto['Nombre'];
				$_SESSION['insumos_ing_productos'][$idProducto]['Unimed']           = $rowProducto['Unimed'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_guia':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_guias'][$idGuia])&&$_SESSION['insumos_ing_guias'][$idGuia]>0){
				$error['productos'] = 'error/La guia que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la guia seleccionada
				$query = "SELECT N_Doc, ValorNeto
				FROM `bodegas_insumos_facturacion`
				WHERE idFacturacion = ".$idGuia;
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
				$rowGuia = mysqli_fetch_assoc ($resultado);


				$_SESSION['insumos_ing_guias'][$idGuia]['idGuia']     = $idGuia;
				$_SESSION['insumos_ing_guias'][$idGuia]['N_Doc']      = $rowGuia['N_Doc'];
				$_SESSION['insumos_ing_guias'][$idGuia]['ValorNeto']  = $rowGuia['ValorNeto'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_guia':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_guias'][$_GET['del_guia']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_impuestos'][$idImpuesto])&&$_SESSION['insumos_ing_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_ing_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_ing_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

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
				$_SESSION['insumos_ing_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_ing_temporal'] = $_SESSION['insumos_ing_basicos']['Observaciones'];
			$_SESSION['insumos_ing_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_ing_archivos'])){
				foreach ($_SESSION['insumos_ing_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumos_ingreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_ing_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_ing_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_ing':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_ing_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_ing_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_ing_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;
/*******************************************************************************************************************/		
		case 'new_desc_ing':

			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_ing_descuentos'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_ing_descuentos'] as $key => $producto){
					$bvar++;
				}	
			}
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_ing_descuentos'][$bvar]['idDescuento'] = $bvar;
				$_SESSION['insumos_ing_descuentos'][$bvar]['Nombre'] = $Nombre;
				$_SESSION['insumos_ing_descuentos'][$bvar]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_desc_ing':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se crea el nuevo producto
				$_SESSION['insumos_ing_descuentos'][$oldidProducto]['idDescuento'] = $oldidProducto;
				$_SESSION['insumos_ing_descuentos'][$oldidProducto]['Nombre'] = $Nombre;
				$_SESSION['insumos_ing_descuentos'][$oldidProducto]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_desc_ing':

			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_descuentos'][$_GET['del_descuento']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_OC':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			//Se verifica si existe la orden de compra
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)){
				$ndata_1 = db_select_nrows ('idOcompra', 'ocompra_listado', '', "idOcompra='".$idOcompra."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1==0) {$error['ndata_1'] = 'error/No existen Ordenes de Compra con ese numero';}
			//Si la OC existe se verifica si tiene productos para asignar
			if($ndata_1!=0) {
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_insumos', '', "idOcompra='".$idOcompra."' AND Cantidad > cant_ingresada", $dbConn);
				if($ndata_2==0) {$error['ndata_2'] = 'error/No existen Insumos a asignar';}
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se borran los productos
				unset($_SESSION['insumos_ing_productos']);
				
				//Se traen los productos utilizados
				$arrProductos = array();
				$query = "SELECT idExistencia, idProducto, Cantidad, vUnitario, vTotal, cant_ingresada 
				FROM ocompra_listado_existencias_insumos 
				WHERE idOcompra='".$idOcompra."' AND Cantidad > cant_ingresada ";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				
				//Guardo la OC
				$_SESSION['insumos_ing_basicos']['idOcompra'] = $idOcompra;
				
				//Se guardan los datos
				foreach ($arrProductos as $prod) {
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['idExistencia']   = $prod['idExistencia'];
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['idProducto']     = $prod['idProducto'];
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['Number']         = $prod['Cantidad'] - $prod['cant_ingresada'];
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['ValorIngreso']   = $prod['vUnitario'];
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['ValorTotal']     = $prod['vTotal'];
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['cant_ingresada'] = $prod['cant_ingresada'];
					$_SESSION['insumos_ing_productos'][$prod['idProducto']]['cant_max']       = $prod['Cantidad'];
				}

				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'ing_bodega':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
			
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_ing_basicos'])){
				if(!isset($_SESSION['insumos_ing_basicos']['idDocumentos']) or $_SESSION['insumos_ing_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documento';}
				if(!isset($_SESSION['insumos_ing_basicos']['N_Doc']) or $_SESSION['insumos_ing_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['insumos_ing_basicos']['idBodega']) or $_SESSION['insumos_ing_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No ha seleccionado la bodega';}
				if(!isset($_SESSION['insumos_ing_basicos']['Observaciones']) or $_SESSION['insumos_ing_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_ing_basicos']['idSistema']) or $_SESSION['insumos_ing_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_ing_basicos']['idUsuario']) or $_SESSION['insumos_ing_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['insumos_ing_basicos']['Creacion_fecha']) or $_SESSION['insumos_ing_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['insumos_ing_basicos']['idTipo']) or $_SESSION['insumos_ing_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['insumos_ing_basicos']['idDocumentos']) && $_SESSION['insumos_ing_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['insumos_ing_basicos']['Pago_fecha']) or $_SESSION['insumos_ing_basicos']['Pago_fecha']=='' or $_SESSION['insumos_ing_basicos']['Pago_fecha']=='0000-00-00' ){     
						$error['Pago_fecha']  = 'error/No ha ingresado la fecha de vencimiento de la factura';
					}
				}
				if(!isset($_SESSION['insumos_ing_impuestos']) ){     
					$error['impuesto']  = 'error/No ha seleccionado un impuesto';
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['insumos_ing_productos'])&&!isset($_SESSION['insumos_ing_guias'])){
				$error['idProducto']   = 'error/No se han asignado ni insumos ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_ing_productos'])){
				foreach ($_SESSION['insumos_ing_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['insumos_ing_guias'])){
				foreach ($_SESSION['insumos_ing_guias'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado ni insumos ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_ing_basicos']['idDocumentos']) && $_SESSION['insumos_ing_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['insumos_ing_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['insumos_ing_basicos']['N_Doc']) && $_SESSION['insumos_ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_ing_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idBodega']) && $_SESSION['insumos_ing_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['Observaciones']) && $_SESSION['insumos_ing_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_ing_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idSistema']) && $_SESSION['insumos_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idUsuario']) && $_SESSION['insumos_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idTipo']) && $_SESSION['insumos_ing_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_ing_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_ing_basicos']['idProveedor']) && $_SESSION['insumos_ing_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['Pago_fecha']) && $_SESSION['insumos_ing_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_ing_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['insumos_ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['insumos_ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_ing_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				$a .= ",''";
				if(isset($_SESSION['insumos_ing_basicos']['fecha_auto']) && $_SESSION['insumos_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['valor_neto_fact'])&&$_SESSION['insumos_ing_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['insumos_ing_basicos']['valor_neto_fact']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['valor_neto_imp'])&&$_SESSION['insumos_ing_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['insumos_ing_basicos']['valor_neto_imp']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['valor_total_fact'])&&$_SESSION['insumos_ing_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['insumos_ing_basicos']['valor_total_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][1]['valor'])&&$_SESSION['insumos_ing_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][1]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][2]['valor'])&&$_SESSION['insumos_ing_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][2]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][3]['valor'])&&$_SESSION['insumos_ing_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][3]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][4]['valor'])&&$_SESSION['insumos_ing_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][4]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][5]['valor'])&&$_SESSION['insumos_ing_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][5]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][6]['valor'])&&$_SESSION['insumos_ing_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][6]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][7]['valor'])&&$_SESSION['insumos_ing_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][7]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][8]['valor'])&&$_SESSION['insumos_ing_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][8]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][9]['valor'])&&$_SESSION['insumos_ing_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_impuestos'][9]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_impuestos'][10]['valor'])&&$_SESSION['insumos_ing_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['insumos_ing_impuestos'][10]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idOcompra']) && $_SESSION['insumos_ing_basicos']['idOcompra'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idOcompra']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idCentroCosto']) && $_SESSION['insumos_ing_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['insumos_ing_basicos']['idCentroCosto']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idLevel_1']) && $_SESSION['insumos_ing_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idLevel_1']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idLevel_2']) && $_SESSION['insumos_ing_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idLevel_2']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idLevel_3']) && $_SESSION['insumos_ing_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idLevel_3']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idLevel_4']) && $_SESSION['insumos_ing_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idLevel_4']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_basicos']['idLevel_5']) && $_SESSION['insumos_ing_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idLevel_5']."'" ;          }else{$a .= ",''";}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, idBodegaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, 
				Creacion_Semana, Creacion_mes, Creacion_ano, idProveedor, Pago_fecha, Pago_dia, Pago_Semana, Pago_mes, Pago_ano, idEstado, DocRel, fecha_auto,
				ValorNeto, ValorNetoImp,ValorTotal,Impuesto_01,Impuesto_02,Impuesto_03,Impuesto_04,Impuesto_05,Impuesto_06,Impuesto_07,Impuesto_08,Impuesto_09,
				Impuesto_10, idOcompra, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los productos	
					if(isset($_SESSION['insumos_ing_productos'])){		
						foreach ($_SESSION['insumos_ing_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                         }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_basicos']['idBodega']) && $_SESSION['insumos_ing_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idSistema']) && $_SESSION['insumos_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idUsuario']) && $_SESSION['insumos_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_ing_basicos']['idDocumentos']) && $_SESSION['insumos_ing_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_ing_basicos']['idDocumentos']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['N_Doc']) && $_SESSION['insumos_ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_ing_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idTipo']) && $_SESSION['insumos_ing_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                        $a .= ",'".$producto['idProducto']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                $a .= ",'".$producto['Number']."'" ;                                    }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                    $a .= ",'".$producto['ValorIngreso']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                        $a .= ",'".$producto['ValorTotal']."'" ;                                }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idProveedor']) && $_SESSION['insumos_ing_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['fecha_auto']) && $_SESSION['insumos_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, 
							Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing, Valor, ValorTotal, idProveedor, fecha_auto) 
							VALUES ({$a} )";
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
							
							
							/*******************************************************************/
							//Actualizo el valor de los productos
							$a = "idProducto='".$producto['idProducto']."'" ;
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''&&isset($_SESSION['insumos_ing_basicos']['idProveedor']) && $_SESSION['insumos_ing_basicos']['idProveedor'] != ''){     
								$a .= ",idProveedor='".$_SESSION['insumos_ing_basicos']['idProveedor']."'" ;
								$a .= ",ValorIngreso='".$producto['ValorIngreso']."'" ;
							}
					
							// inserto los datos de registro en la db
							$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '{$producto['idProducto']}'";
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
							
							
							/*******************************************************************/
							//Actualizo lo entregado de la solicitud de la OC si esta existe
							if(isset($_SESSION['insumos_ing_basicos']['idOcompra'])&&$_SESSION['insumos_ing_basicos']['idOcompra']){
								$nueva_cant = $producto['cant_ingresada'] + $producto['Number'];
								$a = "idExistencia='".$producto['idExistencia']."'" ;
								$a .= ",cant_ingresada='".$nueva_cant."'" ;
								
								// inserto los datos de registro en la db
								$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idExistencia = '{$producto['idExistencia']}'";
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
					
					/*********************************************************************/		
					//Descuento
					if(isset($_SESSION['insumos_ing_descuentos'])){
						foreach ($_SESSION['insumos_ing_descuentos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                         }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_basicos']['idSistema']) && $_SESSION['insumos_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idUsuario']) && $_SESSION['insumos_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_descuentos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_ing_archivos'])){
						foreach ($_SESSION['insumos_ing_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                         }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_basicos']['idBodega']) && $_SESSION['insumos_ing_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idSistema']) && $_SESSION['insumos_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['idUsuario']) && $_SESSION['insumos_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se actualizan las guias a un estado de pago y con relacion al documento recien generado
					if (isset($_SESSION['insumos_ing_guias'])){
						foreach ($_SESSION['insumos_ing_guias'] as $key => $guias){
							//filtro
							if(isset($ultimo_id) && $ultimo_id != ''){ 
								
								$a  = "DocRel='".$ultimo_id."'" ;    
								$a .= ",idEstado='2'";

								$query  = "UPDATE `bodegas_insumos_facturacion` SET ".$a." WHERE idFacturacion = '{$guias['idGuia']}'";
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
					
					/*********************************************************************/		
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_ing_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_ing_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                     //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                                //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_ing_basicos']);
					unset($_SESSION['insumos_ing_productos']);
					unset($_SESSION['insumos_ing_temporal']);
					unset($_SESSION['insumos_ing_guias']);
					unset($_SESSION['insumos_ing_impuestos']);
					unset($_SESSION['insumos_ing_archivos']);
					unset($_SESSION['insumos_ing_descuentos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                       EGRESOS                                                   */
/*                                                                                                                 */
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'new_egreso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_egr_basicos']);
				unset($_SESSION['insumos_egr_productos']);
				unset($_SESSION['insumos_egr_temporal']);
				unset($_SESSION['insumos_egr_descuentos']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_egr_archivos'])){
					foreach ($_SESSION['insumos_egr_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_egr_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_egr_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_egr_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_egr_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_egr_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_egr_basicos']['idTipo'] = $idTipo;}
				if(isset($idTrabajador) && $idTrabajador != ''){           $_SESSION['insumos_egr_basicos']['idTrabajador'] = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_egr_basicos']['fecha_auto'] = $fecha_auto;}
				
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_egr_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idTrabajador) && $idTrabajador != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre, ApellidoPat, ApellidoMat
					FROM `trabajadores_listado`
					WHERE idTrabajador = ".$idTrabajador;
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
					$rowTrabajador = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['Trabajador'] = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				}else{
					$_SESSION['insumos_egr_basicos']['Trabajador'] = '';
				}
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_egr_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_egr_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_5']     = 0;
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_basicos']);
			unset($_SESSION['insumos_egr_productos']);
			unset($_SESSION['insumos_egr_temporal']);
			unset($_SESSION['insumos_egr_descuentos']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_egr_archivos'])){
				foreach ($_SESSION['insumos_egr_archivos'] as $key => $producto){
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
			unset($_SESSION['insumos_egr_archivos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_egr_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['insumos_egr_productos']);
				unset($_SESSION['insumos_egr_guias']);
				unset($_SESSION['insumos_egr_impuestos']);
				unset($_SESSION['insumos_egr_descuentos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_egr_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_egr_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_egr_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_egr_basicos']['idTipo'] = $idTipo;}
				if(isset($idTrabajador) && $idTrabajador != ''){           $_SESSION['insumos_egr_basicos']['idTrabajador'] = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_egr_basicos']['fecha_auto'] = $fecha_auto;}
				
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_egr_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idTrabajador) && $idTrabajador != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre, ApellidoPat, ApellidoMat
					FROM `trabajadores_listado`
					WHERE idTrabajador = ".$idTrabajador;
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
					$rowTrabajador = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['Trabajador'] = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				}else{
					$_SESSION['insumos_egr_basicos']['Trabajador'] = '';
				}
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_egr':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_egr_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_egr_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;	
/*******************************************************************************************************************/		
		case 'new_prod_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos   = 0;
				$n_existencia  = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_egr_productos'][$idProducto[$j1]])&&$_SESSION['insumos_egr_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				
				//Se verifica si la existencia alcanza
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$query = "SELECT 
					insumos_listado.ValorIngreso,, 
					insumos_listado.Nombre AS InsumoNombre,
					sistema_productos_uml.Nombre AS Unimed,
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
					FROM `bodegas_insumos_facturacion_existencias`
					LEFT JOIN `insumos_listado`        ON insumos_listado.idProducto    = bodegas_insumos_facturacion_existencias.idProducto
					LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml   = insumos_listado.idUml 
					WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto[$j1]." 
					AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_egr_basicos']['idBodega'];
					$resultado = mysqli_query($dbConn, $query);
					$rowResultado = mysqli_fetch_assoc ($resultado);
					//Sumo los egresos
					$Total_egresos = $rowResultado['egreso'] + $Number[$j1];
					//Verifico si los egresos son inferiores a los ingresos
					if($rowResultado['ingreso']<$Total_egresos){
						$n_existencia++;
					}
					//Guardo el valor ingreso
					$ValorIngreso[$j1]  = $rowResultado['ValorIngreso'];
					$Ins_Nombre[$j1]    = $rowResultado['InsumoNombre'];
					$Ins_Unimed[$j1]    = $rowResultado['Unimed'];
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				//si hay repetidos
				if($n_existencia!=0) {
					$error['productos'] = 'error/No hay suficientes existencias para algunos insumos';	
				}
				
			
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_egr_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_egr_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_egr_productos'][$idProducto[$j1]]['ValorEgreso']   = $ValorIngreso[$j1];
					$_SESSION['insumos_egr_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorIngreso[$j1]*$Number[$j1];
					$_SESSION['insumos_egr_productos'][$idProducto[$j1]]['Nombre']        = $Ins_Nombre[$j1];
					$_SESSION['insumos_egr_productos'][$idProducto[$j1]]['Unimed']        = $Ins_Unimed[$j1];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			
			


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso, 
			insumos_listado.Nombre AS InsumoNombre,
			sistema_productos_uml.Nombre AS Unimed
			FROM `bodegas_insumos_facturacion_existencias`
			LEFT JOIN `insumos_listado`        ON insumos_listado.idProducto    = bodegas_insumos_facturacion_existencias.idProducto
			LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml   = insumos_listado.idUml 
			WHERE idProducto = {$idProducto} AND idBodega={$_SESSION['insumos_egr_basicos']['idBodega']} ";
			$resultado = mysqli_query($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Se guardan datos		
			$Ins_Nombre    = $rowResultado['InsumoNombre'];
			$Ins_Unimed    = $rowResultado['Unimed'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_egr_productos'][$idProducto])&&$_SESSION['insumos_egr_productos'][$idProducto]>0&&$_SESSION['insumos_egr_productos'][$idProducto]!=$_SESSION['insumos_egr_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['insumos_egr_productos'][$oldItemID]);
			
				//creo el producto
				$_SESSION['insumos_egr_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['insumos_egr_productos'][$idProducto]['Number']       = $Number;
				$_SESSION['insumos_egr_productos'][$idProducto]['ValorEgreso']  = $ValorIngreso;
				$_SESSION['insumos_egr_productos'][$idProducto]['ValorTotal']   = $ValorIngreso*$Number;
				$_SESSION['insumos_egr_productos'][$idProducto]['Nombre']       = $Ins_Nombre;
				$_SESSION['insumos_egr_productos'][$idProducto]['Unimed']       = $Ins_Unimed;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_egr_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_egr_temporal'] = $_SESSION['insumos_egr_basicos']['Observaciones'];
			$_SESSION['insumos_egr_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_egr_archivos'])){
				foreach ($_SESSION['insumos_egr_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumo_egreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_egr_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_egr_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_egr':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_egr_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_egr_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_egr_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;
/*******************************************************************************************************************/		
		case 'new_desc_egr':

			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_egr_descuentos'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_egr_descuentos'] as $key => $producto){
					$bvar++;
				}	
			}
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_egr_descuentos'][$bvar]['idDescuento'] = $bvar;
				$_SESSION['insumos_egr_descuentos'][$bvar]['Nombre'] = $Nombre;
				$_SESSION['insumos_egr_descuentos'][$bvar]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_desc_egr':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se crea el nuevo producto
				$_SESSION['insumos_egr_descuentos'][$oldidProducto]['idDescuento'] = $oldidProducto;
				$_SESSION['insumos_egr_descuentos'][$oldidProducto]['Nombre'] = $Nombre;
				$_SESSION['insumos_egr_descuentos'][$oldidProducto]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_desc_egr':

			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_descuentos'][$_GET['del_descuento']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'egr_bodega':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_egr_basicos'])){
				if(!isset($_SESSION['insumos_egr_basicos']['idBodega']) or $_SESSION['insumos_egr_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No ha seleccionado la bodega';}
				if(!isset($_SESSION['insumos_egr_basicos']['Observaciones']) or $_SESSION['insumos_egr_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_egr_basicos']['idSistema']) or $_SESSION['insumos_egr_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_egr_basicos']['idUsuario']) or $_SESSION['insumos_egr_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['insumos_egr_basicos']['Creacion_fecha']) or $_SESSION['insumos_egr_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['insumos_egr_basicos']['idTipo']) or $_SESSION['insumos_egr_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['insumos_egr_basicos']['idTrabajador']) or $_SESSION['insumos_egr_basicos']['idTrabajador']=='' ){     $error['idTrabajador']     = 'error/No ha seleccionado un trabajador';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al egreso de bodega';
			}
			//productos
			if (isset($_SESSION['insumos_egr_productos'])){
				foreach ($_SESSION['insumos_egr_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un insumo para egresar a bodega';}
					$n_data1++;
				}
			}else{
				$error['idProducto'] = 'error/No tiene insumo asignados a este egreso';
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No tiene insumo asignados a este egreso';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_egr_basicos']['idBodega']) && $_SESSION['insumos_egr_basicos']['idBodega'] != ''){              $a  = "'".$_SESSION['insumos_egr_basicos']['idBodega']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['insumos_egr_basicos']['Observaciones']) && $_SESSION['insumos_egr_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_egr_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idSistema']) && $_SESSION['insumos_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idUsuario']) && $_SESSION['insumos_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idTipo']) && $_SESSION['insumos_egr_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_egr_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idTrabajador']) && $_SESSION['insumos_egr_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['insumos_egr_basicos']['idTrabajador']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_egr_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_egr_basicos']['fecha_auto']) && $_SESSION['insumos_egr_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['insumos_egr_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idCentroCosto']) && $_SESSION['insumos_egr_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_egr_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idLevel_1']) && $_SESSION['insumos_egr_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_egr_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idLevel_2']) && $_SESSION['insumos_egr_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_egr_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idLevel_3']) && $_SESSION['insumos_egr_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_egr_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idLevel_4']) && $_SESSION['insumos_egr_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_egr_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_basicos']['idLevel_5']) && $_SESSION['insumos_egr_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_egr_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idBodegaOrigen, Observaciones, 
				idSistema, idUsuario, idTipo, idTrabajador, Creacion_fecha, Creacion_Semana, Creacion_mes, 
				Creacion_ano, fecha_auto, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los trabajadores	
					if(isset($_SESSION['insumos_egr_productos'])){		
						foreach ($_SESSION['insumos_egr_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                         }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_basicos']['idBodega']) && $_SESSION['insumos_egr_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idSistema']) && $_SESSION['insumos_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idUsuario']) && $_SESSION['insumos_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_egr_basicos']['idDocumentos']) && $_SESSION['insumos_egr_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_egr_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['N_Doc']) && $_SESSION['insumos_egr_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_egr_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idTipo']) && $_SESSION['insumos_egr_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_egr_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                        $a .= ",'".$producto['idProducto']."'" ;                           }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                $a .= ",'".$producto['Number']."'" ;                               }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idTrabajador']) && $_SESSION['insumos_egr_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['insumos_egr_basicos']['idTrabajador']."'" ;  }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                      $a .= ",'".$producto['ValorEgreso']."'" ;                          }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                        $a .= ",'".$producto['ValorTotal']."'" ;                           }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idCliente']) && $_SESSION['insumos_egr_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idCliente']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['fecha_auto']) && $_SESSION['insumos_egr_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_egr_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, 
							Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg,idTrabajador, Valor, ValorTotal, idCliente, fecha_auto) 
							VALUES ({$a} )";
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
							
							/*******************************************************************/
							//Actualizo el valor de los productos
							$a = "idProducto='".$producto['idProducto']."'" ;
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''&&isset($_SESSION['insumos_egr_basicos']['idCliente']) && $_SESSION['insumos_egr_basicos']['idCliente'] != ''){     
								$a .= ",idCliente='".$_SESSION['insumos_egr_basicos']['idCliente']."'" ;
								$a .= ",ValorEgreso='".$producto['ValorEgreso']."'" ;
							}
					
							// inserto los datos de registro en la db
							$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '{$producto['idProducto']}'";
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
					//Descuento
					if(isset($_SESSION['insumos_egr_descuentos'])){
						foreach ($_SESSION['insumos_egr_descuentos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_basicos']['idSistema']) && $_SESSION['insumos_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idUsuario']) && $_SESSION['insumos_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_descuentos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_egr_archivos'])){
						foreach ($_SESSION['insumos_egr_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                         }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_basicos']['idBodega']) && $_SESSION['insumos_egr_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idSistema']) && $_SESSION['insumos_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['idUsuario']) && $_SESSION['insumos_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_egr_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_egr_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_egr_basicos']);
					unset($_SESSION['insumos_egr_productos']);
					unset($_SESSION['insumos_egr_temporal']);
					unset($_SESSION['insumos_egr_archivos']);
					unset($_SESSION['insumos_egr_descuentos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                       TRASPASO                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_traspaso_basicos']);
				unset($_SESSION['insumos_traspaso_productos']);
				unset($_SESSION['insumos_traspaso_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_traspaso_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_traspaso_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_traspaso_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_traspaso_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_traspaso_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_traspaso_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_traspaso_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['insumos_traspaso_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['insumos_traspaso_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_traspaso_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_traspaso_basicos']['fecha_auto'] = $fecha_auto;}
				
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_traspaso_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaOrigen;
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
					$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['BodegaOrigen'] = $rowBodegaOrigen['Nombre'];
				}else{
					$_SESSION['insumos_traspaso_basicos']['BodegaOrigen'] = '';
				}
				/****************************************************/
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaDestino;
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
					$rowBodegaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['BodegaDestino'] = $rowBodegaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspaso_basicos']['BodegaDestino'] = '';
				}
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_traspaso_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_traspaso_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_traspaso_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_traspaso_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_traspaso_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_traspaso_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_traspaso_basicos']['idLevel_5']     = 0;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_traspaso_basicos']);
			unset($_SESSION['insumos_traspaso_productos']);
			unset($_SESSION['insumos_traspaso_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_traspaso_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['insumos_traspaso_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_traspaso_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_traspaso_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_traspaso_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_traspaso_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_traspaso_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_traspaso_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['insumos_traspaso_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['insumos_traspaso_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_traspaso_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_traspaso_basicos']['fecha_auto'] = $fecha_auto;}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_traspaso_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaOrigen;
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
					$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['BodegaOrigen'] = $rowBodegaOrigen['Nombre'];
				}else{
					$_SESSION['insumos_traspaso_basicos']['BodegaOrigen'] = '';
				}
				/****************************************************/
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaDestino;
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
					$rowBodegaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['BodegaDestino'] = $rowBodegaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspaso_basicos']['BodegaDestino'] = '';
				}
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;
/*******************************************************************************************************************/		
		case 'modCentroCosto_traspaso':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_traspaso_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_traspaso_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspaso_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspaso_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspaso_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspaso_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspaso_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspaso_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;	
/*******************************************************************************************************************/		
		case 'new_prod_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos   = 0;
				$n_existencia  = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_traspaso_productos'][$idProducto[$j1]])&&$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				
				//Se verifica si la existencia alcanza
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$query = "SELECT 
					insumos_listado.Nombre,
					sistema_productos_uml.Nombre AS Unimed,
					insumos_listado.ValorIngreso,
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
					FROM `bodegas_insumos_facturacion_existencias`
					LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
					LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = insumos_listado.idUml
					WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto[$j1]." 
					AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_traspaso_basicos']['idBodegaOrigen'];
					$resultado = mysqli_query($dbConn, $query);
					$rowResultado = mysqli_fetch_assoc ($resultado);
					//Sumo los egresos
					$Total_egresos = $rowResultado['egreso'] + $Number[$j1];
					//Verifico si los egresos son inferiores a los ingresos
					if($rowResultado['ingreso']<$Total_egresos){
						$n_existencia++;
					}
					//Guardo el valor ingreso
					$ValorIngreso[$j1]   = $rowResultado['ValorIngreso'];
					$ProductoNombre[$j1] = $rowResultado['Nombre'];
					$ProductoUnimed[$j1] = $rowResultado['Unimed'];
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				//si hay repetidos
				if($n_existencia!=0) {
					$error['productos'] = 'error/No hay suficientes existencias para algunos insumos';	
				}
				
			
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]['ValorEgreso']   = $ValorIngreso[$j1];
					$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorIngreso[$j1]*$Number[$j1];
					$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]['Nombre']        = $ProductoNombre[$j1];
					$_SESSION['insumos_traspaso_productos'][$idProducto[$j1]]['Unimed']        = $ProductoUnimed[$j1];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen los totales de los productos
			$query = "SELECT 
			insumos_listado.Nombre,
			sistema_productos_uml.Nombre AS Unimed,
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
			FROM `bodegas_insumos_facturacion_existencias`
			LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
			LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = insumos_listado.idUml
			WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto."
			AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_traspaso_basicos']['idBodegaOrigen'];
			$resultado = mysqli_query($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos     = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			$ProductoNombre    = $rowResultado['Nombre'];
			$ProductoUnimed    = $rowResultado['Unimed'];	
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_traspaso_productos'][$idProducto])&&$_SESSION['insumos_traspaso_productos'][$idProducto]>0&&$_SESSION['insumos_traspaso_productos'][$idProducto]!=$_SESSION['insumos_traspaso_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['insumos_traspaso_productos'][$oldItemID]);
			
				//creo el producto
				$_SESSION['insumos_traspaso_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['insumos_traspaso_productos'][$idProducto]['Number']       = $Number;
				$_SESSION['insumos_traspaso_productos'][$idProducto]['ValorEgreso']  = $ValorIngreso;
				$_SESSION['insumos_traspaso_productos'][$idProducto]['ValorTotal']   = $ValorIngreso*$Number;
				$_SESSION['insumos_traspaso_productos'][$idProducto]['Nombre']       = $ProductoNombre;
				$_SESSION['insumos_traspaso_productos'][$idProducto]['Unimed']       = $ProductoUnimed;
					
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_traspaso_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_traspaso_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_traspaso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_traspaso_temporal'] = $_SESSION['insumos_traspaso_basicos']['Observaciones'];
			$_SESSION['insumos_traspaso_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'traspaso_bodega':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_traspaso_basicos'])){
				if(!isset($_SESSION['insumos_traspaso_basicos']['idBodegaOrigen']) or $_SESSION['insumos_traspaso_basicos']['idBodegaOrigen']=='' ){    $error['idBodegaOrigen']   = 'error/No ha seleccionado la bodega de origen';}
				if(!isset($_SESSION['insumos_traspaso_basicos']['idBodegaDestino']) or $_SESSION['insumos_traspaso_basicos']['idBodegaDestino']=='' ){  $error['idBodegaDestino']  = 'error/No ha seleccionado la bodega de destino';}
				if(!isset($_SESSION['insumos_traspaso_basicos']['Observaciones']) or $_SESSION['insumos_traspaso_basicos']['Observaciones']=='' ){      $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_traspaso_basicos']['idSistema']) or $_SESSION['insumos_traspaso_basicos']['idSistema']=='' ){              $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_traspaso_basicos']['idUsuario']) or $_SESSION['insumos_traspaso_basicos']['idUsuario']=='' ){              $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['insumos_traspaso_basicos']['Creacion_fecha']) or $_SESSION['insumos_traspaso_basicos']['Creacion_fecha']=='' ){    $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['insumos_traspaso_basicos']['idTipo']) or $_SESSION['insumos_traspaso_basicos']['idTipo']=='' ){                    $error['idTipo']           = 'error/No ha seleccionado el tipo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al traspaso de bodega';
			}
			//productos
			if (isset($_SESSION['insumos_traspaso_productos'])){
				foreach ($_SESSION['insumos_traspaso_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un insumo para traspaso a bodega';}
					$n_data1++;
				}
			}else{
				$error['idProducto'] = 'error/No insumo asignados a este traspaso';
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No insumo asignados a este traspaso';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_traspaso_basicos']['idDocumentos']) && $_SESSION['insumos_traspaso_basicos']['idDocumentos'] != ''){        $a  = "'".$_SESSION['insumos_traspaso_basicos']['idDocumentos']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['N_Doc']) && $_SESSION['insumos_traspaso_basicos']['N_Doc'] != ''){                      $a .= ",'".$_SESSION['insumos_traspaso_basicos']['N_Doc']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idBodegaOrigen']) && $_SESSION['insumos_traspaso_basicos']['idBodegaOrigen'] != ''){    $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idBodegaOrigen']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idBodegaDestino']) && $_SESSION['insumos_traspaso_basicos']['idBodegaDestino'] != ''){  $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idBodegaDestino']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['Observaciones']) && $_SESSION['insumos_traspaso_basicos']['Observaciones'] != ''){      $a .= ",'".$_SESSION['insumos_traspaso_basicos']['Observaciones']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idSistema']) && $_SESSION['insumos_traspaso_basicos']['idSistema'] != ''){              $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idSistema']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idUsuario']) && $_SESSION['insumos_traspaso_basicos']['idUsuario'] != ''){              $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idUsuario']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idTipo']) && $_SESSION['insumos_traspaso_basicos']['idTipo'] != ''){                    $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idTipo']."'" ;            }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspaso_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_traspaso_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_traspaso_basicos']['fecha_auto']) && $_SESSION['insumos_traspaso_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['insumos_traspaso_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idCentroCosto']) && $_SESSION['insumos_traspaso_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idLevel_1']) && $_SESSION['insumos_traspaso_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idLevel_2']) && $_SESSION['insumos_traspaso_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idLevel_3']) && $_SESSION['insumos_traspaso_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idLevel_4']) && $_SESSION['insumos_traspaso_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspaso_basicos']['idLevel_5']) && $_SESSION['insumos_traspaso_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, idBodegaDestino, 
				Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, 
				fecha_auto, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los trabajadores	
					if(isset($_SESSION['insumos_traspaso_productos'])){	
						foreach ($_SESSION['insumos_traspaso_productos'] as $key => $producto){
						
							//Primero se realiza el egreso del producto
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                               }else{$a  = "''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idBodegaOrigen']) && $_SESSION['insumos_traspaso_basicos']['idBodegaOrigen'] != ''){  $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idBodegaOrigen']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idSistema']) && $_SESSION['insumos_traspaso_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idUsuario']) && $_SESSION['insumos_traspaso_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspaso_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_traspaso_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_traspaso_basicos']['idDocumentos']) && $_SESSION['insumos_traspaso_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['N_Doc']) && $_SESSION['insumos_traspaso_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_traspaso_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idTipo']) && $_SESSION['insumos_traspaso_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                  $a .= ",'".$producto['idProducto']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                          $a .= ",'".$producto['Number']."'" ;                                    }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                                $a .= ",'".$producto['ValorEgreso']."'" ;                               }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                  $a .= ",'".$producto['ValorTotal']."'" ;                                }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['fecha_auto']) && $_SESSION['insumos_traspaso_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_traspaso_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, 
							idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, 
							idTipo, idProducto, Cantidad_eg, Valor, ValorTotal, fecha_auto) 
							VALUES ({$a} )";
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
							//luego se realiza el ingreso del producto
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                              $a  = "'".$ultimo_id."'" ;                                                 }else{$a  = "''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idBodegaDestino']) && $_SESSION['insumos_traspaso_basicos']['idBodegaDestino'] != ''){  $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idBodegaDestino']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idSistema']) && $_SESSION['insumos_traspaso_basicos']['idSistema'] != ''){              $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idSistema']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idUsuario']) && $_SESSION['insumos_traspaso_basicos']['idUsuario'] != ''){              $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idUsuario']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspaso_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_traspaso_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_traspaso_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_traspaso_basicos']['idDocumentos']) && $_SESSION['insumos_traspaso_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['N_Doc']) && $_SESSION['insumos_traspaso_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_traspaso_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['idTipo']) && $_SESSION['insumos_traspaso_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_traspaso_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                  $a .= ",'".$producto['idProducto']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                          $a .= ",'".$producto['Number']."'" ;                                    }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                                $a .= ",'".$producto['ValorEgreso']."'" ;                               }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                  $a .= ",'".$producto['ValorTotal']."'" ;                                }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspaso_basicos']['fecha_auto']) && $_SESSION['insumos_traspaso_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_traspaso_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, 
							idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, 
							idTipo, idProducto, Cantidad_ing, Valor, ValorTotal, fecha_auto) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_traspaso_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspaso_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_traspaso_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_traspaso_basicos']);
					unset($_SESSION['insumos_traspaso_productos']);
					unset($_SESSION['insumos_traspaso_temporal']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                              TRASPASO OTRA EMPRESA                                              */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si la bodega origen y destino es la misma
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			//verificar si el la empresa origen y destino
			if(isset($idSistema)&&$idSistema!=''&&isset($idSistemaDestino)&&$idSistemaDestino!=''){
				if($idSistema==$idSistemaDestino){
					$error['productos'] = 'error/La empresa de Origen y destino es la misma';
				}
			}
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_traspasoempresa_basicos']);
				unset($_SESSION['insumos_traspasoempresa_productos']);
				unset($_SESSION['insumos_traspasoempresa_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_traspasoempresa_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_traspasoempresa_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_traspasoempresa_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_traspasoempresa_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_traspasoempresa_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_traspasoempresa_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_traspasoempresa_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_traspasoempresa_basicos']['fecha_auto'] = $fecha_auto;}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaOrigen;
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
					$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaOrigen'] = $rowBodegaOrigen['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaOrigen'] = '';
				}
				/****************************************************/
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaDestino;
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
					$rowBodegaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaDestino'] = $rowBodegaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaDestino'] = '';
				}
				/****************************************************/
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_sistemas`
					WHERE idSistema = ".$idSistemaDestino;
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
					$rowSistemaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['SistemaDestino'] = $rowSistemaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['SistemaDestino'] = '';
				}
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_traspasoempresa_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_traspasoempresa_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_traspasoempresa_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_traspasoempresa_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_traspasoempresa_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_traspasoempresa_basicos']['idLevel_5']     = 0;
				
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
		break;
/*******************************************************************************************************************/		
		case 'clear_all_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_traspasoempresa_basicos']);
			unset($_SESSION['insumos_traspasoempresa_productos']);
			unset($_SESSION['insumos_traspasoempresa_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_traspasoempresa_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['insumos_traspasoempresa_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_traspasoempresa_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_traspasoempresa_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_traspasoempresa_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_traspasoempresa_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_traspasoempresa_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_traspasoempresa_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_traspasoempresa_basicos']['fecha_auto'] = $fecha_auto;}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaOrigen;
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
					$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaOrigen'] = $rowBodegaOrigen['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaOrigen'] = '';
				}
				/****************************************************/
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaDestino;
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
					$rowBodegaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaDestino'] = $rowBodegaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['BodegaDestino'] = '';
				}
				/****************************************************/
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_sistemas`
					WHERE idSistema = ".$idSistemaDestino;
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
					$rowSistemaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['SistemaDestino'] = $rowSistemaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspasoempresa_basicos']['SistemaDestino'] = '';
				}
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_traspasoempresa':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_traspasoempresa_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasoempresa_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasoempresa_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasoempresa_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasoempresa_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasoempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasoempresa_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos   = 0;
				$n_existencia  = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]])&&$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				
				//Se verifica si la existencia alcanza
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$query = "SELECT 
					insumos_listado.Nombre,
					sistema_productos_uml.Nombre AS Unimed,
					insumos_listado.ValorIngreso,
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
					FROM `bodegas_insumos_facturacion_existencias`
					LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
					LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = insumos_listado.idUml
					WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto[$j1]." 
					AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen'];
					$resultado = mysqli_query($dbConn, $query);
					$rowResultado = mysqli_fetch_assoc ($resultado);
					//Sumo los egresos
					$Total_egresos = $rowResultado['egreso'] + $Number[$j1];
					//Verifico si los egresos son inferiores a los ingresos
					if($rowResultado['ingreso']<$Total_egresos){
						$n_existencia++;
					}
					//Guardo el valor ingreso
					$ValorIngreso[$j1]   = $rowResultado['ValorIngreso'];
					$ProductoNombre[$j1] = $rowResultado['Nombre'];
					$ProductoUnimed[$j1] = $rowResultado['Unimed'];	
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				//si hay repetidos
				if($n_existencia!=0) {
					$error['productos'] = 'error/No hay suficientes existencias para algunos insumos';	
				}
				
			
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]['ValorEgreso']   = $ValorIngreso[$j1];
					$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorIngreso[$j1]*$Number[$j1];
					$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]['Nombre']        = $ProductoNombre[$j1];
					$_SESSION['insumos_traspasoempresa_productos'][$idProducto[$j1]]['Unimed']        = $ProductoUnimed[$j1];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen los totales de los productos
			$query = "SELECT 
			insumos_listado.Nombre,
			sistema_productos_uml.Nombre AS Unimed,
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
			FROM `bodegas_insumos_facturacion_existencias`
			LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
			LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = insumos_listado.idUml
			WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto." 
			AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen'];
			$resultado = mysqli_query($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos     = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			$ProductoNombre    = $rowResultado['Nombre'];
			$ProductoUnimed    = $rowResultado['Unimed'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_traspasoempresa_productos'][$idProducto])&&$_SESSION['insumos_traspasoempresa_productos'][$idProducto]>0&&$_SESSION['insumos_traspasoempresa_productos'][$idProducto]!=$_SESSION['insumos_traspasoempresa_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['insumos_traspasoempresa_productos'][$oldItemID]);
			
				//creo el producto
				$_SESSION['insumos_traspasoempresa_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['insumos_traspasoempresa_productos'][$idProducto]['Number']       = $Number;
				$_SESSION['insumos_traspasoempresa_productos'][$idProducto]['ValorEgreso']  = $ValorIngreso;
				$_SESSION['insumos_traspasoempresa_productos'][$idProducto]['ValorTotal']   = $ValorIngreso*$Number;
				$_SESSION['insumos_traspasoempresa_productos'][$idProducto]['Nombre']       = $ProductoNombre;
				$_SESSION['insumos_traspasoempresa_productos'][$idProducto]['Unimed']       = $ProductoUnimed;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_traspasoempresa_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_traspasoempresa_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_traspasoempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_traspasoempresa_temporal'] = $_SESSION['insumos_traspasoempresa_basicos']['Observaciones'];
			$_SESSION['insumos_traspasoempresa_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'traspaso_otra_empresa':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_traspasoempresa_basicos'])){
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen']) or $_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen']=='' ){      $error['idBodegaOrigen']    = 'error/No ha seleccionado la bodega de origen';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino']) or $_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino']=='' ){    $error['idBodegaDestino']   = 'error/No ha seleccionado la bodega de destino';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']) or $_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']=='' ){  $error['idSistemaDestino']  = 'error/No ha seleccionado el sistema de destino';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['Observaciones']) or $_SESSION['insumos_traspasoempresa_basicos']['Observaciones']=='' ){        $error['Observaciones']     = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['idSistema']) or $_SESSION['insumos_traspasoempresa_basicos']['idSistema']=='' ){                $error['idSistema']         = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['idUsuario']) or $_SESSION['insumos_traspasoempresa_basicos']['idUsuario']=='' ){                $error['idUsuario']         = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']) or $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']=='' ){      $error['Creacion_fecha']    = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['insumos_traspasoempresa_basicos']['idTipo']) or $_SESSION['insumos_traspasoempresa_basicos']['idTipo']=='' ){                      $error['idTipo']            = 'error/No ha seleccionado el tipo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al traspaso de bodega';
			}
			//productos
			if (isset($_SESSION['insumos_traspasoempresa_productos'])){
				foreach ($_SESSION['insumos_traspasoempresa_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un insumo para traspaso a bodega';}
					$n_data1++;
				}
			}else{
				$error['idProducto'] = 'error/No tiene insumo asignados a este traspaso';
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No tiene insumo asignados a este traspaso';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idDocumentos']) && $_SESSION['insumos_traspasoempresa_basicos']['idDocumentos'] != ''){          $a  = "'".$_SESSION['insumos_traspasoempresa_basicos']['idDocumentos']."'" ;        }else{$a  = "''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['N_Doc']) && $_SESSION['insumos_traspasoempresa_basicos']['N_Doc'] != ''){                        $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen']) && $_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen'] != ''){      $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino']) && $_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino'] != ''){    $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']) && $_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino'] != ''){  $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['Observaciones']) && $_SESSION['insumos_traspasoempresa_basicos']['Observaciones'] != ''){        $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['Observaciones']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idSistema']) && $_SESSION['insumos_traspasoempresa_basicos']['idSistema'] != ''){                $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idSistema']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idUsuario']) && $_SESSION['insumos_traspasoempresa_basicos']['idUsuario'] != ''){                $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idUsuario']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idTipo']) && $_SESSION['insumos_traspasoempresa_basicos']['idTipo'] != ''){                      $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['fecha_auto']) && $_SESSION['insumos_traspasoempresa_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idCentroCosto']) && $_SESSION['insumos_traspasoempresa_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idLevel_1']) && $_SESSION['insumos_traspasoempresa_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idLevel_2']) && $_SESSION['insumos_traspasoempresa_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idLevel_3']) && $_SESSION['insumos_traspasoempresa_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idLevel_4']) && $_SESSION['insumos_traspasoempresa_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasoempresa_basicos']['idLevel_5']) && $_SESSION['insumos_traspasoempresa_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, idBodegaDestino, 
				idSistemaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, 
				Creacion_ano, fecha_auto, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los trabajadores	
					if(isset($_SESSION['insumos_traspasoempresa_productos'])){		
						foreach ($_SESSION['insumos_traspasoempresa_productos'] as $key => $producto){
						
							//Primero se realiza el egreso del producto
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                          $a  = "'".$ultimo_id."'" ;                                                      }else{$a  = "''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen']) && $_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen'] != ''){  $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idBodegaOrigen']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idSistema']) && $_SESSION['insumos_traspasoempresa_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idUsuario']) && $_SESSION['insumos_traspasoempresa_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idDocumentos']) && $_SESSION['insumos_traspasoempresa_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['N_Doc']) && $_SESSION['insumos_traspasoempresa_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idTipo']) && $_SESSION['insumos_traspasoempresa_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                                $a .= ",'".$producto['idProducto']."'" ;                                       }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                                        $a .= ",'".$producto['Number']."'" ;                                           }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                                              $a .= ",'".$producto['ValorEgreso']."'" ;                                      }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                                $a .= ",'".$producto['ValorTotal']."'" ;                                       }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['fecha_auto']) && $_SESSION['insumos_traspasoempresa_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, 
							idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, 
							Cantidad_eg, Valor, ValorTotal, fecha_auto) 
							VALUES ({$a} )";
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
							//luego se realiza el ingreso del producto
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                                $a  = "'".$ultimo_id."'" ;                                                         }else{$a  = "''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino']) && $_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino'] != ''){      $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idBodegaDestino']."'" ;   }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']) && $_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino'] != ''){    $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idUsuario']) && $_SESSION['insumos_traspasoempresa_basicos']['idUsuario'] != ''){                  $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idUsuario']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idDocumentos']) && $_SESSION['insumos_traspasoempresa_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['N_Doc']) && $_SESSION['insumos_traspasoempresa_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idTipo']) && $_SESSION['insumos_traspasoempresa_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                                $a .= ",'".$producto['idProducto']."'" ;                                       }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                                        $a .= ",'".$producto['Number']."'" ;                                           }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                                              $a .= ",'".$producto['ValorEgreso']."'" ;                                      }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                                $a .= ",'".$producto['ValorTotal']."'" ;                                       }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['fecha_auto']) && $_SESSION['insumos_traspasoempresa_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, 
							idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, 
							Cantidad_ing, Valor, ValorTotal, fecha_auto) 
							VALUES ({$a} )";
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
					//Busco los usuarios que posean el permiso a la bodega
					$Direccionbase = "bodegas_insumos_stock.php";
					$Notificacion  = '<div class= "btn-group" ><a href= "view_mov_insumos.php?view='.$ultimo_id.'" title= "Ver Informacion" class= "btn btn-primary btn-sm tooltip"><i class= "fa fa-list"></i></a></div>';
					$Notificacion .= 'Se ha realizado un traspaso de insumoa desde otra empresa';
					$Estado = '1';
					
					$arrPermiso = array();
					$query = "SELECT usuarios_permisos.idUsuario
					FROM usuarios_permisos 
					INNER JOIN core_permisos_listado    ON core_permisos_listado.idAdmpm     = usuarios_permisos.idAdmpm 
					INNER JOIN usuarios_listado         ON usuarios_listado.idUsuario        = usuarios_permisos.idUsuario 
					INNER JOIN usuarios_sistemas        ON usuarios_sistemas.idUsuario       = usuarios_permisos.idUsuario 
					WHERE core_permisos_listado.Direccionbase = '".$Direccionbase."' 
					AND usuarios_sistemas.idSistema = '{$_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']}'";
					$resultado = mysqli_query($dbConn, $query);
					while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrPermiso,$row );
					}

					/*********************************************************************/
					//Inserto el mensaje de entrega de materiales
					if(isset($arrPermiso)){	
						foreach($arrPermiso as $permiso) {
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino']) && $_SESSION['insumos_traspasoempresa_basicos']['idSistemaDestino'] != ''){   $a  = "'".$_SESSION['insumos_egr_basicos']['idSistemaDestino']."'" ;   }else{$a  = "''";}
							if(isset($permiso['idUsuario']) && $permiso['idUsuario'] != ''){                                                                                         $a .= ",'".$permiso['idUsuario']."'" ;                                 }else{$a .= ",''";}
							if(isset($Notificacion) && $Notificacion != ''){                                                                                                         $a .= ",'".$Notificacion."'" ;                                         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] != ''){       $a .= ",'".$_SESSION['insumos_egr_basicos']['Creacion_fecha']."'" ;    }else{$a .= ",''";}
							if(isset($Estado) && $Estado != ''){                                                                                                                     $a .= ",'".$Estado."'" ;                                               }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `principal_notificaciones_ver` (idSistema,idUsuario,Notificacion, Fecha, idEstado) VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_traspasoempresa_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_traspasoempresa_basicos']);
					unset($_SESSION['insumos_traspasoempresa_productos']);
					unset($_SESSION['insumos_traspasoempresa_temporal']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                           TRASPASO MANUAL OTRA EMPRESA                                          */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el la empresa origen y destino
			if(isset($idSistema)&&$idSistema!=''&&isset($idSistemaDestino)&&$idSistemaDestino!=''){
				if($idSistema==$idSistemaDestino){
					$error['productos'] = 'error/La empresa de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_traspasomanualempresa_basicos']);
				unset($_SESSION['insumos_traspasomanualempresa_productos']);
				unset($_SESSION['insumos_traspasomanualempresa_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_traspasomanualempresa_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_traspasomanualempresa_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_traspasomanualempresa_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto'] = $fecha_auto;}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_traspasomanualempresa_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaOrigen;
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
					$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['BodegaOrigen'] = $rowBodegaOrigen['Nombre'];
				}else{
					$_SESSION['insumos_traspasomanualempresa_basicos']['BodegaOrigen'] = '';
				}
				/****************************************************/
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_sistemas`
					WHERE idSistema = ".$idSistemaDestino;
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
					$rowSistemaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['SistemaDestino'] = $rowSistemaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspasomanualempresa_basicos']['SistemaDestino'] = '';
				}
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_traspasomanualempresa_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_5']     = 0;
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
		break;
/*******************************************************************************************************************/		
		case 'clear_all_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_traspasomanualempresa_basicos']);
			unset($_SESSION['insumos_traspasomanualempresa_productos']);
			unset($_SESSION['insumos_traspasomanualempresa_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_traspasomanualempresa':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_traspasomanualempresa_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['insumos_traspasomanualempresa_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_traspasomanualempresa_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_traspasomanualempresa_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_traspasomanualempresa_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto'] = $fecha_auto;}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_traspasomanualempresa_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodegaOrigen;
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
					$rowBodegaOrigen = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['BodegaOrigen'] = $rowBodegaOrigen['Nombre'];
				}else{
					$_SESSION['insumos_traspasomanualempresa_basicos']['BodegaOrigen'] = '';
				}
				/****************************************************/
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_sistemas`
					WHERE idSistema = ".$idSistemaDestino;
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
					$rowSistemaDestino = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['SistemaDestino'] = $rowSistemaDestino['Nombre'];
				}else{
					$_SESSION['insumos_traspasomanualempresa_basicos']['SistemaDestino'] = '';
				}
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_traspasomanualempresa':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_traspasomanualempresa_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_traspasomanualempresa_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos   = 0;
				$n_existencia  = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]])&&$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				
				//Se verifica si la existencia alcanza
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$query = "SELECT 
					insumos_listado.Nombre,
					sistema_productos_uml.Nombre AS Unimed,
					insumos_listado.ValorIngreso,
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
					FROM `bodegas_insumos_facturacion_existencias`
					LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
					LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = insumos_listado.idUml
					WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto[$j1]." 
					AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen'];
					$resultado = mysqli_query($dbConn, $query);
					$rowResultado = mysqli_fetch_assoc ($resultado);
					//Sumo los egresos
					$Total_egresos = $rowResultado['egreso'] + $Number[$j1];
					//Verifico si los egresos son inferiores a los ingresos
					if($rowResultado['ingreso']<$Total_egresos){
						$n_existencia++;
					}
					//Guardo el valor ingreso
					$ValorIngreso[$j1]   = $rowResultado['ValorIngreso'];
					$ProductoNombre[$j1] = $rowResultado['Nombre'];
					$ProductoUnimed[$j1] = $rowResultado['Unimed'];	
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				//si hay repetidos
				if($n_existencia!=0) {
					$error['productos'] = 'error/No hay suficientes existencias para algunos insumos';	
				}
				
			
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]['ValorEgreso']   = $ValorIngreso[$j1];
					$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorIngreso[$j1]*$Number[$j1];
					$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]['Nombre']        = $ProductoNombre[$j1];
					$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto[$j1]]['Unimed']        = $ProductoUnimed[$j1];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen los totales de los productos
			$query = "SELECT 
			insumos_listado.Nombre,
			sistema_productos_uml.Nombre AS Unimed,
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
			FROM `bodegas_insumos_facturacion_existencias`
			LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
			LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml    = insumos_listado.idUml
			WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto." 
			AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen'];
			$resultado = mysqli_query($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos     = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			$ProductoNombre    = $rowResultado['Nombre'];
			$ProductoUnimed    = $rowResultado['Unimed'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_traspasomanualempresa_productos'][$idProducto])&&$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]>0&&$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]!=$_SESSION['insumos_traspasomanualempresa_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['insumos_traspasomanualempresa_productos'][$oldItemID]);
			
				//creo el producto
				$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]['Number']       = $Number;
				$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]['ValorEgreso']  = $ValorIngreso;
				$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]['ValorTotal']   = $ValorIngreso*$Number;
				$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]['Nombre']       = $ProductoNombre;
				$_SESSION['insumos_traspasomanualempresa_productos'][$idProducto]['Unimed']       = $ProductoUnimed;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_traspasomanualempresa_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_traspasomanualempresa':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_traspasomanualempresa_temporal'] = $_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones'];
			$_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'traspasomanual_otra_empresa':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_traspasomanualempresa_basicos'])){
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen']) or $_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen']=='' ){      $error['idBodegaOrigen']    = 'error/No ha seleccionado la bodega de origen';}
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino']) or $_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino']=='' ){  $error['idSistemaDestino']  = 'error/No ha seleccionado el sistema de destino';}
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones']) or $_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones']=='' ){        $error['Observaciones']     = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['idSistema']) or $_SESSION['insumos_traspasomanualempresa_basicos']['idSistema']=='' ){                $error['idSistema']         = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario']) or $_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario']=='' ){                $error['idUsuario']         = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']) or $_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']=='' ){      $error['Creacion_fecha']    = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['insumos_traspasomanualempresa_basicos']['idTipo']) or $_SESSION['insumos_traspasomanualempresa_basicos']['idTipo']=='' ){                      $error['idTipo']            = 'error/No ha seleccionado el tipo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al traspaso de bodega';
			}
			//productos
			if (isset($_SESSION['insumos_traspasomanualempresa_productos'])){
				foreach ($_SESSION['insumos_traspasomanualempresa_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un insumo para traspaso a bodega';}
					$n_data1++;
				}
			}else{
				$error['idProducto'] = 'error/No tiene insumo asignados a este traspaso';
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No tiene insumo asignados a este traspaso';
			}

			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos'] != ''){          $a  = "'".$_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos']."'" ;        }else{$a  = "''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc']) && $_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc'] != ''){                        $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen'] != ''){      $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino'] != ''){  $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idSistemaDestino']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones']) && $_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones'] != ''){        $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['Observaciones']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idSistema']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idSistema'] != ''){                $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idSistema']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario'] != ''){                $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idTipo']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idTipo'] != ''){                      $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto']) && $_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto'] != ''){           $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idCentroCosto']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_1']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_2']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_3']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_4']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_5']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, idSistemaDestino, 
				Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, 
				fecha_auto, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los trabajadores	
					if(isset($_SESSION['insumos_traspasomanualempresa_productos'])){		
						foreach ($_SESSION['insumos_traspasomanualempresa_productos'] as $key => $producto){
						
						//Primero se realiza el egreso del producto
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                                      $a  = "'".$ultimo_id."'" ;                                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen'] != ''){  $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idBodegaOrigen']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idSistema']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc']) && $_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['idTipo']) && $_SESSION['insumos_traspasomanualempresa_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                                            $a .= ",'".$producto['idProducto']."'" ;                                             }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                                                    $a .= ",'".$producto['Number']."'" ;                                                 }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                                                          $a .= ",'".$producto['ValorEgreso']."'" ;                                            }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                                            $a .= ",'".$producto['ValorTotal']."'" ;                                             }else{$a .= ",''";}
							if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto']) && $_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, 
							idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, 
							idTipo, idProducto, Cantidad_eg, Valor, ValorTotal, fecha_auto) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']) && $_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_traspasomanualempresa_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_traspasomanualempresa_basicos']);
					unset($_SESSION['insumos_traspasomanualempresa_productos']);
					unset($_SESSION['insumos_traspasomanualempresa_temporal']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        OTROS                                                    */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'modFecha':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se actualiza el documento 
				$a = "idFacturacion='".$idFacturacion."'" ;
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				// inserto los datos de registro en la db
				$query  = "UPDATE `bodegas_insumos_facturacion` SET ".$a." WHERE idFacturacion = '$idFacturacion'";
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
				
				//Se actualiza el registro de movimiento de materiales
				$a = "idFacturacion='".$idFacturacion."'" ;
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				// inserto los datos de registro en la db
				$query  = "UPDATE `bodegas_insumos_facturacion_existencias` SET ".$a." WHERE idFacturacion = '$idFacturacion'";
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
/*                                                                                                                 */
/*                                                  INGRESOS MANUALES                                              */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_ingreso_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_manual_basicos']);
				unset($_SESSION['insumos_ing_manual_productos']);
				unset($_SESSION['insumos_ing_manual_temporal']);
				unset($_SESSION['insumos_ing_manual_impuestos']);
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_ing_manual_archivos'])){
					foreach ($_SESSION['insumos_ing_manual_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_ing_manual_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_ing_manual_basicos']['idBodega']         = $idBodega;
				$_SESSION['insumos_ing_manual_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['insumos_ing_manual_basicos']['idSistema']        = $idSistema;
				$_SESSION['insumos_ing_manual_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['insumos_ing_manual_basicos']['idTipo']           = $idTipo;
				$_SESSION['insumos_ing_manual_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['insumos_ing_manual_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['insumos_ing_manual_basicos']['Pago_fecha']       = '0000-00-00';
				$_SESSION['insumos_ing_manual_basicos']['idOcompra']        = '';
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_manual_impuestos'][1]['idImpuesto'] = 1;
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_manual_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_manual_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_manual_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_manual_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_manual_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_ing_manual_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_ing_manual_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_ing_manual_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_ing_manual_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_ing_manual_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_ing_manual_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_ing_manual_basicos']['idLevel_5']     = 0;
				
				
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_manual_basicos']);
			unset($_SESSION['insumos_ing_manual_productos']);
			unset($_SESSION['insumos_ing_manual_temporal']);
			unset($_SESSION['insumos_ing_manual_impuestos']);
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_ing_manual_archivos'])){
					foreach ($_SESSION['insumos_ing_manual_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_ing_manual_archivos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_manual_basicos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_ing_manual_basicos']['idBodega']         = $idBodega;
				$_SESSION['insumos_ing_manual_basicos']['idSistema']        = $idSistema;
				$_SESSION['insumos_ing_manual_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['insumos_ing_manual_basicos']['idTipo']           = $idTipo;
				$_SESSION['insumos_ing_manual_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['insumos_ing_manual_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['insumos_ing_manual_basicos']['Pago_fecha']       = '0000-00-00';
				$_SESSION['insumos_ing_manual_basicos']['idOcompra']        = '';
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_manual_impuestos'][1]['idImpuesto'] = 1;
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_manual_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_manual_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_manual_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_manual_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_manual_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_ing_manual':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_ing_manual_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_ing_manual_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_manual_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_manual_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_manual_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_manual_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_manual_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_manual_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]])&&$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idEstado=1";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $producto){
					$arrProd['Prod'][$producto['idProducto']]['Nombre'] = $producto['Nombre'];
					$arrProd['Prod'][$producto['idProducto']]['Unimed'] = $producto['Unimed'];
				}
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]['ValorIngreso']  = $ValorTotal[$j1]/$Number[$j1];
					$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];
					$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]['Nombre']        = $arrProd['Prod'][$idProducto[$j1]]['Nombre'];
					$_SESSION['insumos_ing_manual_productos'][$idProducto[$j1]]['Unimed']        = $arrProd['Prod'][$idProducto[$j1]]['Unimed'];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_manual_productos'][$idProducto])&&$_SESSION['insumos_ing_manual_productos'][$idProducto]>0&&$_SESSION['insumos_ing_manual_productos'][$idProducto]!=$_SESSION['insumos_ing_manual_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE idProducto=".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['insumos_ing_manual_productos'][$oldItemID]);
			
				//creo el producto
				$_SESSION['insumos_ing_manual_productos'][$idProducto]['idProducto']    = $idProducto;
				$_SESSION['insumos_ing_manual_productos'][$idProducto]['Number']        = $Number;
				$_SESSION['insumos_ing_manual_productos'][$idProducto]['ValorIngreso']  = $ValorIngreso;
				$_SESSION['insumos_ing_manual_productos'][$idProducto]['ValorTotal']    = $ValorTotal;
				$_SESSION['insumos_ing_manual_productos'][$idProducto]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['insumos_ing_manual_productos'][$idProducto]['Unimed']        = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_manual_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_manual_impuestos'][$idImpuesto])&&$_SESSION['insumos_ing_manual_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_ing_manual_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_ing_manual_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_manual_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_manual_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_ing_manual_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_ing_manual_temporal'] = $_SESSION['insumos_ing_manual_basicos']['Observaciones'];
			$_SESSION['insumos_ing_manual_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_ing_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_ing_manual_archivos'])){
				foreach ($_SESSION['insumos_ing_manual_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumos_ingreso_manual_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_ing_manual_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_ing_manual_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_ing_manual':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_ing_manual_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_ing_manual_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_ing_manual_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;
/*******************************************************************************************************************/		
		case 'ing_bodega_manual':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_ing_manual_basicos'])){
				if(!isset($_SESSION['insumos_ing_manual_basicos']['idBodega']) or $_SESSION['insumos_ing_manual_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No ha seleccionado la bodega';}
				if(!isset($_SESSION['insumos_ing_manual_basicos']['Observaciones']) or $_SESSION['insumos_ing_manual_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_ing_manual_basicos']['idSistema']) or $_SESSION['insumos_ing_manual_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_ing_manual_basicos']['idUsuario']) or $_SESSION['insumos_ing_manual_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']) or $_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['insumos_ing_manual_basicos']['idTipo']) or $_SESSION['insumos_ing_manual_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['insumos_ing_manual_impuestos']) ){                                                                                  $error['impuesto']         = 'error/No ha seleccionado un impuesto'; }
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}

			//productos o guias
			if (!isset($_SESSION['insumos_ing_manual_productos'])){
				$error['idProducto']   = 'error/No se han asignado insumos';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_ing_manual_productos'])){
				foreach ($_SESSION['insumos_ing_manual_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No se han asignado insumos';
			}

			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_ing_manual_basicos']['idBodega']) && $_SESSION['insumos_ing_manual_basicos']['idBodega'] != ''){              $a  = "'".$_SESSION['insumos_ing_manual_basicos']['idBodega']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['Observaciones']) && $_SESSION['insumos_ing_manual_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idSistema']) && $_SESSION['insumos_ing_manual_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idUsuario']) && $_SESSION['insumos_ing_manual_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idTipo']) && $_SESSION['insumos_ing_manual_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idProveedor']) && $_SESSION['insumos_ing_manual_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
				$a .= ",'1'";
				$a .= ",''";
				if(isset($_SESSION['insumos_ing_manual_basicos']['fecha_auto']) && $_SESSION['insumos_ing_manual_basicos']['fecha_auto'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['valor_neto_fact'])&&$_SESSION['insumos_ing_manual_basicos']['valor_neto_fact']!=''){      $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['valor_neto_fact']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['valor_total_fact'])&&$_SESSION['insumos_ing_manual_basicos']['valor_total_fact']!=''){    $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['valor_total_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][1]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][1]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][1]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][2]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][2]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][2]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][3]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][3]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][3]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][4]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][4]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][4]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][5]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][5]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][5]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][6]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][6]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][6]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][7]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][7]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][7]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][8]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][8]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][8]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][9]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][9]['valor']!=''){                $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][9]['valor']."'";          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_impuestos'][10]['valor'])&&$_SESSION['insumos_ing_manual_impuestos'][10]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_manual_impuestos'][10]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idCentroCosto']) && $_SESSION['insumos_ing_manual_basicos']['idCentroCosto'] != ''){      $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idCentroCosto']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idLevel_1']) && $_SESSION['insumos_ing_manual_basicos']['idLevel_1'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idLevel_1']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idLevel_2']) && $_SESSION['insumos_ing_manual_basicos']['idLevel_2'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idLevel_2']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idLevel_3']) && $_SESSION['insumos_ing_manual_basicos']['idLevel_3'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idLevel_3']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idLevel_4']) && $_SESSION['insumos_ing_manual_basicos']['idLevel_4'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idLevel_4']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_manual_basicos']['idLevel_5']) && $_SESSION['insumos_ing_manual_basicos']['idLevel_5'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idLevel_5']."'" ;          }else{$a .= ",''";}
					
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idBodegaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, 
				Creacion_Semana, Creacion_mes, Creacion_ano, idProveedor, idEstado, DocRel, fecha_auto, ValorNeto,ValorTotal,Impuesto_01,Impuesto_02,Impuesto_03,
				Impuesto_04,Impuesto_05,Impuesto_06,Impuesto_07,Impuesto_08,Impuesto_09,Impuesto_10, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, 
				idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los productos		
					if(isset($_SESSION['insumos_ing_manual_productos'])){	
						foreach ($_SESSION['insumos_ing_manual_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                $a  = "'".$ultimo_id."'" ;                                                }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idBodega']) && $_SESSION['insumos_ing_manual_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idSistema']) && $_SESSION['insumos_ing_manual_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idUsuario']) && $_SESSION['insumos_ing_manual_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idTipo']) && $_SESSION['insumos_ing_manual_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                      $a .= ",'".$producto['idProducto']."'" ;                                       }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                              $a .= ",'".$producto['Number']."'" ;                                           }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                                  $a .= ",'".$producto['ValorIngreso']."'" ;                                     }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                      $a .= ",'".$producto['ValorTotal']."'" ;                                       }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idProveedor']) && $_SESSION['insumos_ing_manual_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['fecha_auto']) && $_SESSION['insumos_ing_manual_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, 
							Creacion_mes, Creacion_ano, idTipo, idProducto, Cantidad_ing, Valor, ValorTotal, idProveedor,fecha_auto) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_ing_manual_archivos'])){
						foreach ($_SESSION['insumos_ing_manual_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                $a  = "'".$ultimo_id."'" ;                                                }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idBodega']) && $_SESSION['insumos_ing_manual_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idSistema']) && $_SESSION['insumos_ing_manual_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['idUsuario']) && $_SESSION['insumos_ing_manual_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_manual_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_manual_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_ing_manual_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_ing_manual_basicos']);
					unset($_SESSION['insumos_ing_manual_productos']);
					unset($_SESSION['insumos_ing_manual_temporal']);
					unset($_SESSION['insumos_ing_manual_impuestos']);
					unset($_SESSION['insumos_ing_manual_archivos']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        EGRESOS                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_venta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			//Se verifica si el dato existe
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_vent_basicos']);
				unset($_SESSION['insumos_vent_productos']);
				unset($_SESSION['insumos_vent_temporal']);
				unset($_SESSION['insumos_vent_guias']);
				unset($_SESSION['insumos_vent_impuestos']);
				unset($_SESSION['insumos_vent_descuentos']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_vent_archivos'])){
					foreach ($_SESSION['insumos_vent_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_vent_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_vent_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_vent_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_vent_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_vent_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_vent_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_vent_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_vent_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_vent_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_vent_basicos']['idCliente'] = $idCliente;}
				if(isset($idTrabajador) && $idTrabajador != ''){           $_SESSION['insumos_vent_basicos']['idTrabajador'] = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_vent_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($OC_Ventas) && $OC_Ventas != ''){                 $_SESSION['insumos_vent_basicos']['OC_Ventas'] = $OC_Ventas;}
				
				//fecha de venta
				$_SESSION['insumos_vent_basicos']['Pago_fecha']      = '0000-00-00';
				
				//Se agrega el impuesto
				$_SESSION['insumos_vent_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['Documento'] = '';
				}
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['TipoDocumento'] = '';
				}
				/********************************************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['Bodega'] = '';
				}
				/********************************************************************************/
				if(isset($idCliente) && $idCliente != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `clientes_listado`
					WHERE idCliente = ".$idCliente;
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
					$rowCliente = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['Cliente'] = '';
				}
				/********************************************************************************/
				if(isset($idTrabajador) && $idTrabajador != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre, ApellidoPat, ApellidoMat
					FROM `trabajadores_listado`
					WHERE idTrabajador = ".$idTrabajador;
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
					$rowVendedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Vendedor'] = $rowVendedor['Nombre'].' '.$rowVendedor['ApellidoPat'].' '.$rowVendedor['ApellidoMat'];
				}else{
					$_SESSION['insumos_vent_basicos']['Vendedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_vent_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_vent_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_vent_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_vent_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_vent_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_vent_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_vent_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_vent_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_vent_basicos']['idLevel_5']     = 0;
				
				
				
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_venta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_vent_basicos']);
			unset($_SESSION['insumos_vent_productos']);
			unset($_SESSION['insumos_vent_temporal']);
			unset($_SESSION['insumos_vent_guias']);
			unset($_SESSION['insumos_vent_impuestos']);
			unset($_SESSION['insumos_vent_descuentos']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_vent_archivos'])){
				foreach ($_SESSION['insumos_vent_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_vent_archivos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_venta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_vent_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['insumos_vent_productos']);
				unset($_SESSION['insumos_vent_guias']);
				unset($_SESSION['insumos_vent_impuestos']);
				unset($_SESSION['insumos_vent_descuentos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_vent_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_vent_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_vent_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_vent_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_vent_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_vent_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_vent_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_vent_basicos']['idCliente'] = $idCliente;}
				if(isset($idTrabajador) && $idTrabajador != ''){           $_SESSION['insumos_vent_basicos']['idTrabajador'] = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_vent_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($OC_Ventas) && $OC_Ventas != ''){                 $_SESSION['insumos_vent_basicos']['OC_Ventas'] = $OC_Ventas;}
				
				//fecha de venta
				$_SESSION['insumos_vent_basicos']['Pago_fecha']      = '0000-00-00';
				
				//Se agrega el impuesto
				$_SESSION['insumos_vent_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['Documento'] = '';
				}
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['TipoDocumento'] = '';
				}
				/********************************************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['Bodega'] = '';
				}
				/********************************************************************************/
				if(isset($idCliente) && $idCliente != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `clientes_listado`
					WHERE idCliente = ".$idCliente;
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
					$rowCliente = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['insumos_vent_basicos']['Cliente'] = '';
				}
				/********************************************************************************/
				if(isset($idTrabajador) && $idTrabajador != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre, ApellidoPat, ApellidoMat
					FROM `trabajadores_listado`
					WHERE idTrabajador = ".$idTrabajador;
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
					$rowVendedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['Vendedor'] = $rowVendedor['Nombre'].' '.$rowVendedor['ApellidoPat'].' '.$rowVendedor['ApellidoMat'];
				}else{
					$_SESSION['insumos_vent_basicos']['Vendedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_vent_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_vent_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_venta':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_vent_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_vent_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_vent_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_vent_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_vent_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_vent_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_vent_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_vent_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_guia_ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_vent_guias'][$idGuia])&&$_SESSION['insumos_vent_guias'][$idGuia]>0){
				$error['productos'] = 'error/La guia que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT N_Doc, ValorNeto
				FROM `bodegas_insumos_facturacion`
				WHERE idFacturacion = ".$idGuia;
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
				$rowGuias = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_vent_guias'][$idGuia]['N_Doc']     = $rowGuias['N_Doc'];
				$_SESSION['insumos_vent_guias'][$idGuia]['ValorNeto'] = $rowGuias['ValorNeto'];
				$_SESSION['insumos_vent_guias'][$idGuia]['idGuia']    = $idGuia;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_guia_ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_vent_guias'][$_GET['del_guia']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_vent_impuestos'][$idImpuesto])&&$_SESSION['insumos_vent_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_vent_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_vent_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_vent_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_vent_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'addfpagoVentas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$valor    = $_GET['val_select'];
			
			//Se comprueba las fechas
			if($_SESSION['insumos_vent_basicos']['Creacion_fecha']>$valor){
				$error['ndata_1'] = 'error/La fecha de vencimiento es anterior a la fecha de creacion';
			}	

			//valido que no esten vacios
			if(empty($valor)){  $error['valor']  = 'error/No ha ingresado una fecha de vencimiento';}

			if ( empty($error) ) {
				
				$_SESSION['insumos_vent_basicos']['Pago_fecha'] = $valor;
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;		
/*******************************************************************************************************************/		
		case 'delfpagoVentas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				$_SESSION['insumos_vent_basicos']['Pago_fecha'] = '0000-00-00';
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'new_prod_Ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos   = 0;
				$n_existencia  = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_vent_productos'][$idProducto[$j1]])&&$_SESSION['insumos_vent_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				
				//Se verifica si la existencia alcanza
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$query = "SELECT 
					insumos_listado.Nombre,
					sistema_productos_uml.Nombre AS Unimed,
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
					SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
					FROM `bodegas_insumos_facturacion_existencias`
					LEFT JOIN `insumos_listado`        ON insumos_listado.idProducto     = bodegas_insumos_facturacion_existencias.idProducto
					LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml    = insumos_listado.idUml
					WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto[$j1]." 
					AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_vent_basicos']['idBodega'];
					$resultado = mysqli_query($dbConn, $query);
					$rowResultado = mysqli_fetch_assoc ($resultado);
					//Sumo los egresos
					$Total_egresos = $rowResultado['egreso'] + $Number[$j1];
					//Verifico si los egresos son inferiores a los ingresos
					if($rowResultado['ingreso']<$Total_egresos){
						$n_existencia++;
					}
					//Guardo el valor ingreso
					$ProductoNombre[$j1] = $rowResultado['Nombre'];
					$ProductoUnimed[$j1] = $rowResultado['Unimed'];	
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				//si hay repetidos
				if($n_existencia!=0) {
					$error['productos'] = 'error/No hay suficientes existencias para algunos insumos';	
				}
				
			
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_vent_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_vent_productos'][$idProducto[$j1]]['Number']        = $Number[$j1];
					$_SESSION['insumos_vent_productos'][$idProducto[$j1]]['ValorEgreso']   = $ValorTotal[$j1]/$Number[$j1];
					$_SESSION['insumos_vent_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];
					$_SESSION['insumos_vent_productos'][$idProducto[$j1]]['Nombre']        = $ProductoNombre[$j1];
					$_SESSION['insumos_vent_productos'][$idProducto[$j1]]['Unimed']        = $ProductoUnimed[$j1];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_Ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se traen los totales de los productos
			$query = "SELECT 
			insumos_listado.Nombre,
			sistema_productos_uml.Nombre AS Unimed,
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_ing) AS ingreso, 
			SUM(bodegas_insumos_facturacion_existencias.Cantidad_eg) AS egreso
			FROM `bodegas_insumos_facturacion_existencias`
			LEFT JOIN `insumos_listado`        ON insumos_listado.idProducto   = bodegas_insumos_facturacion_existencias.idProducto
			LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml  = insumos_listado.idUml
			WHERE bodegas_insumos_facturacion_existencias.idProducto = ".$idProducto." 
			AND bodegas_insumos_facturacion_existencias.idBodega=".$_SESSION['insumos_vent_basicos']['idBodega'];
			$resultado = mysqli_query($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos     = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			$ProductoNombre    = $rowResultado['Nombre'];
			$ProductoUnimed    = $rowResultado['Unimed'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_vent_productos'][$idProducto])&&$_SESSION['insumos_vent_productos'][$idProducto]>0&&$_SESSION['insumos_vent_productos'][$idProducto]!=$_SESSION['insumos_vent_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['insumos_vent_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['insumos_vent_productos'][$idProducto]['idProducto']   = $idProducto;
				$_SESSION['insumos_vent_productos'][$idProducto]['Number']       = $Number;
				$_SESSION['insumos_vent_productos'][$idProducto]['ValorEgreso']  = $ValorEgreso;
				$_SESSION['insumos_vent_productos'][$idProducto]['ValorTotal']   = $ValorTotal;
				$_SESSION['insumos_vent_productos'][$idProducto]['Nombre']       = $ProductoNombre;
				$_SESSION['insumos_vent_productos'][$idProducto]['Unimed']       = $ProductoUnimed;
			
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_Ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_vent_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_Ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_vent_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_Ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_vent_temporal'] = $_SESSION['insumos_vent_basicos']['Observaciones'];
			$_SESSION['insumos_vent_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_Ventas':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_vent_archivos'])){
				foreach ($_SESSION['insumos_vent_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'producto_egreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_vent_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_vent_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_Ventas':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_vent_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_vent_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_vent_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;
/*******************************************************************************************************************/		
		case 'new_desc_Ventas':

			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_vent_descuentos'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_vent_descuentos'] as $key => $producto){
					$bvar++;
				}	
			}
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_vent_descuentos'][$bvar]['idDescuento'] = $bvar;
				$_SESSION['insumos_vent_descuentos'][$bvar]['Nombre'] = $Nombre;
				$_SESSION['insumos_vent_descuentos'][$bvar]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_desc_Ventas':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se crea el nuevo producto
				$_SESSION['insumos_vent_descuentos'][$oldidProducto]['idDescuento'] = $oldidProducto;
				$_SESSION['insumos_vent_descuentos'][$oldidProducto]['Nombre'] = $Nombre;
				$_SESSION['insumos_vent_descuentos'][$oldidProducto]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_desc_Ventas':

			//Borro todas las sesiones
			unset($_SESSION['insumos_vent_descuentos'][$_GET['del_descuento']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'Venta_bodega':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
					
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_vent_basicos'])){
				if(!isset($_SESSION['insumos_vent_basicos']['idDocumentos']) or $_SESSION['insumos_vent_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documentoa';}
				if(!isset($_SESSION['insumos_vent_basicos']['N_Doc']) or $_SESSION['insumos_vent_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['insumos_vent_basicos']['idBodega']) or $_SESSION['insumos_vent_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No ha seleccionado la bodega';}
				if(!isset($_SESSION['insumos_vent_basicos']['Observaciones']) or $_SESSION['insumos_vent_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_vent_basicos']['idSistema']) or $_SESSION['insumos_vent_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_vent_basicos']['idUsuario']) or $_SESSION['insumos_vent_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha sleccionado el usuario';}
				if(!isset($_SESSION['insumos_vent_basicos']['Creacion_fecha']) or $_SESSION['insumos_vent_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado una fecha de creacion';}
				if(!isset($_SESSION['insumos_vent_basicos']['idTipo']) or $_SESSION['insumos_vent_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['insumos_vent_basicos']['idCliente']) or $_SESSION['insumos_vent_basicos']['idCliente']=='' ){           $error['idCliente']        = 'error/No ha seleccionado el cliente';}
				if(!isset($_SESSION['insumos_vent_basicos']['idTrabajador']) or $_SESSION['insumos_vent_basicos']['idTrabajador']=='' ){     $error['idTrabajador']     = 'error/No ha seleccionado el vendedor';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['insumos_vent_basicos']['idDocumentos']) && $_SESSION['insumos_vent_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['insumos_vent_basicos']['Pago_fecha']) or $_SESSION['insumos_vent_basicos']['Pago_fecha']=='' or $_SESSION['insumos_vent_basicos']['Pago_fecha']=='0000-00-00' ){     
						$error['Pago_fecha']  = 'error/No ha ingresado la fecha de vencimiento de la factura';
					}	
				}
				if(!isset($_SESSION['insumos_vent_impuestos']) ){     
					$error['impuestos']  = 'error/No ha seleccionado un impuesto';
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al egreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['insumos_vent_productos'])&&!isset($_SESSION['insumos_vent_guias'])){
				$error['idProducto']   = 'error/No se han asignado ni insumos ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_vent_productos'])){
				foreach ($_SESSION['insumos_vent_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['insumos_vent_guias'])){
				foreach ($_SESSION['insumos_vent_guias'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado ni insumos ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_vent_basicos']['idDocumentos']) && $_SESSION['insumos_vent_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['insumos_vent_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['insumos_vent_basicos']['N_Doc']) && $_SESSION['insumos_vent_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_vent_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idBodega']) && $_SESSION['insumos_vent_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_vent_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['Observaciones']) && $_SESSION['insumos_vent_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_vent_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idSistema']) && $_SESSION['insumos_vent_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idUsuario']) && $_SESSION['insumos_vent_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idTipo']) && $_SESSION['insumos_vent_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_vent_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['Creacion_fecha']) && $_SESSION['insumos_vent_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_vent_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_vent_basicos']['idCliente']) && $_SESSION['insumos_vent_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idCliente']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idTrabajador']) && $_SESSION['insumos_vent_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['insumos_vent_basicos']['idTrabajador']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['fecha_auto']) && $_SESSION['insumos_vent_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_vent_basicos']['fecha_auto']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['valor_neto_fact'])&&$_SESSION['insumos_vent_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['insumos_vent_basicos']['valor_neto_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['valor_neto_imp'])&&$_SESSION['insumos_vent_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['insumos_vent_basicos']['valor_neto_imp']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['valor_total_fact'])&&$_SESSION['insumos_vent_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['insumos_vent_basicos']['valor_total_fact']."'";  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][1]['valor'])&&$_SESSION['insumos_vent_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][1]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][2]['valor'])&&$_SESSION['insumos_vent_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][2]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][3]['valor'])&&$_SESSION['insumos_vent_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][3]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][4]['valor'])&&$_SESSION['insumos_vent_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][4]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][5]['valor'])&&$_SESSION['insumos_vent_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][5]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][6]['valor'])&&$_SESSION['insumos_vent_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][6]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][7]['valor'])&&$_SESSION['insumos_vent_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][7]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][8]['valor'])&&$_SESSION['insumos_vent_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][8]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][9]['valor'])&&$_SESSION['insumos_vent_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['insumos_vent_impuestos'][9]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_impuestos'][10]['valor'])&&$_SESSION['insumos_vent_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['insumos_vent_impuestos'][10]['valor']."'";       }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['Pago_fecha']) && $_SESSION['insumos_vent_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_vent_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['insumos_vent_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['insumos_vent_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_vent_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_vent_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['insumos_vent_basicos']['OC_Ventas']) && $_SESSION['insumos_vent_basicos']['OC_Ventas'] != ''){             $a .= ",'".$_SESSION['insumos_vent_basicos']['OC_Ventas']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idCentroCosto']) && $_SESSION['insumos_vent_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_vent_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idLevel_1']) && $_SESSION['insumos_vent_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_vent_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idLevel_2']) && $_SESSION['insumos_vent_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_vent_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idLevel_3']) && $_SESSION['insumos_vent_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_vent_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idLevel_4']) && $_SESSION['insumos_vent_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_vent_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_vent_basicos']['idLevel_5']) && $_SESSION['insumos_vent_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_vent_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, 
				Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, 
				idCliente, idTrabajador, fecha_auto, ValorNeto, ValorNetoImp, ValorTotal, Impuesto_01, Impuesto_02, 
				Impuesto_03, Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, Impuesto_09, 
				Impuesto_10, Pago_fecha, Pago_dia, Pago_Semana, Pago_mes, Pago_ano, idEstado,OC_Ventas, 
				idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los productos
					if (isset($_SESSION['insumos_vent_productos'])){			
						foreach ($_SESSION['insumos_vent_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_vent_basicos']['idBodega']) && $_SESSION['insumos_vent_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_vent_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idSistema']) && $_SESSION['insumos_vent_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idUsuario']) && $_SESSION['insumos_vent_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['Creacion_fecha']) && $_SESSION['insumos_vent_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_vent_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_vent_basicos']['idDocumentos']) && $_SESSION['insumos_vent_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_vent_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['N_Doc']) && $_SESSION['insumos_vent_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_vent_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idTipo']) && $_SESSION['insumos_vent_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_vent_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                              $a .= ",'".$producto['idProducto']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['Number']) && $producto['Number'] != ''){                                                                      $a .= ",'".$producto['Number']."'" ;                                  }else{$a .= ",''";}
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                            $a .= ",'".$producto['ValorEgreso']."'" ;                             }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                              $a .= ",'".$producto['ValorTotal']."'" ;                              }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idCliente']) && $_SESSION['insumos_vent_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idCliente']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['fecha_auto']) && $_SESSION['insumos_vent_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_vent_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, 
							idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, 
							Valor, ValorTotal, idCliente, fecha_auto) 
							VALUES ({$a} )";
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
							
							/********************************************************************************/
							//Actualizo el valor de los productos
							$a = "idProducto='".$producto['idProducto']."'" ;
							if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){     
								$a .= ",ValorEgreso='".$producto['ValorEgreso']."'" ;
							}
					
							// inserto los datos de registro en la db
							$query  = "UPDATE `insumos_listado` SET ".$a." WHERE idProducto = '{$producto['idProducto']}'";
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
					//Se actualizan las guias a un estado de pago y con relacion al documento recien generado
					if (isset($_SESSION['insumos_vent_guias'])){
						foreach ($_SESSION['insumos_vent_guias'] as $key => $guias){
							//filtro
							if(isset($ultimo_id) && $ultimo_id != ''){ 
								
								$a  = "DocRel='".$ultimo_id."'" ;    
								$a .= ",idEstado='2'";

								$query  = "UPDATE `bodegas_insumos_facturacion` SET ".$a." WHERE idFacturacion = '{$guias['idGuia']}'";
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
					
					/*********************************************************************/		
					//Descuento
					if(isset($_SESSION['insumos_vent_descuentos'])){
						foreach ($_SESSION['insumos_vent_descuentos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_vent_basicos']['idSistema']) && $_SESSION['insumos_vent_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idUsuario']) && $_SESSION['insumos_vent_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['Creacion_fecha']) && $_SESSION['insumos_vent_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_vent_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_descuentos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_vent_archivos'])){
						foreach ($_SESSION['insumos_vent_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_vent_basicos']['idBodega']) && $_SESSION['insumos_vent_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_vent_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idSistema']) && $_SESSION['insumos_vent_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['idUsuario']) && $_SESSION['insumos_vent_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_vent_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_vent_basicos']['Creacion_fecha']) && $_SESSION['insumos_vent_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_vent_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_vent_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_vent_basicos']['Creacion_fecha']) && $_SESSION['insumos_vent_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_vent_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_vent_basicos']);
					unset($_SESSION['insumos_vent_productos']);
					unset($_SESSION['insumos_vent_temporal']);
					unset($_SESSION['insumos_vent_guias']);
					unset($_SESSION['insumos_vent_impuestos']);
					unset($_SESSION['insumos_vent_archivos']);
					unset($_SESSION['insumos_vent_descuentos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                       INGRESOS ND                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_ingreso_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_nd_basicos']);
				unset($_SESSION['insumos_ing_nd_productos']);
				unset($_SESSION['insumos_ing_nd_temporal']);
				unset($_SESSION['insumos_ing_nd_impuestos']);
				unset($_SESSION['insumos_ing_nd_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_ing_nd_archivos'])){
					foreach ($_SESSION['insumos_ing_nd_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_ing_nd_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_ing_nd_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['insumos_ing_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['insumos_ing_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['insumos_ing_nd_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['insumos_ing_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['insumos_ing_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['insumos_ing_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['insumos_ing_nd_basicos']['Pago_fecha']       = '0000-00-00';
				$_SESSION['insumos_ing_nd_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['insumos_ing_nd_basicos']['idBodega']         = $idBodega;
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_nd_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_ing_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_ing_nd_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_ing_nd_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_ing_nd_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_ing_nd_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_ing_nd_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_ing_nd_basicos']['idLevel_5']     = 0;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nd_basicos']);
			unset($_SESSION['insumos_ing_nd_productos']);
			unset($_SESSION['insumos_ing_nd_temporal']);
			unset($_SESSION['insumos_ing_nd_impuestos']);
			unset($_SESSION['insumos_ing_nd_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_ing_nd_archivos'])){
				foreach ($_SESSION['insumos_ing_nd_archivos'] as $key => $producto){
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
			unset($_SESSION['insumos_ing_nd_archivos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_nd_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['insumos_ing_nd_productos']);
				unset($_SESSION['insumos_ing_nd_guias']);
				unset($_SESSION['insumos_ing_nd_impuestos']);
				unset($_SESSION['insumos_ing_nd_otros']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_ing_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['insumos_ing_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['insumos_ing_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['insumos_ing_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['insumos_ing_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['insumos_ing_nd_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['insumos_ing_nd_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['insumos_ing_nd_basicos']['idBodega']         = $idBodega;
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_nd_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_nd_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_ing_nd':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_ing_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_ing_nd_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nd_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nd_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nd_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nd_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nd_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]])&&$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idEstado=1";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $producto){
					$arrProd['Prod'][$producto['idProducto']]['Nombre'] = $producto['Nombre'];
					$arrProd['Prod'][$producto['idProducto']]['Unimed'] = $producto['Unimed'];
				}
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]['Cantidad_ing']  = $Cantidad_ing[$j1];
					$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]['ValorIngreso']  = $ValorTotal[$j1]/$Cantidad_ing[$j1];
					$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];				
					$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]['Nombre']        = $arrProd['Prod'][$idProducto[$j1]]['Nombre'];
					$_SESSION['insumos_ing_nd_productos'][$idProducto[$j1]]['Unimed']        = $arrProd['Prod'][$idProducto[$j1]]['Unimed'];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_nd_productos'][$idProducto])&&$_SESSION['insumos_ing_nd_productos'][$idProducto]>0&&$_SESSION['insumos_ing_nd_productos'][$idProducto]!=$_SESSION['insumos_ing_nd_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				// Se traen los datos del producto
				$query = "SELECT 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE idProducto=".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);	
				
				//Borro el producto
				unset($_SESSION['insumos_ing_nd_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['insumos_ing_nd_productos'][$idProducto]['idProducto']       = $idProducto;
				$_SESSION['insumos_ing_nd_productos'][$idProducto]['Cantidad_ing']     = $Cantidad_ing;
				$_SESSION['insumos_ing_nd_productos'][$idProducto]['ValorIngreso']     = $ValorIngreso;
				$_SESSION['insumos_ing_nd_productos'][$idProducto]['ValorTotal']       = $ValorTotal;
				$_SESSION['insumos_ing_nd_productos'][$idProducto]['Nombre']           = $rowProducto['Nombre'];
				$_SESSION['insumos_ing_nd_productos'][$idProducto]['Unimed']           = $rowProducto['Unimed'];
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro el producto
			unset($_SESSION['insumos_ing_nd_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_ing_nd_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_ing_nd_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_ing_nd_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['insumos_ing_nd_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['insumos_ing_nd_otros'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_otros_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['insumos_ing_nd_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['insumos_ing_nd_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['insumos_ing_nd_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nd_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_nd_impuestos'][$idImpuesto])&&$_SESSION['insumos_ing_nd_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_ing_nd_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_ing_nd_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_nd_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nd_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_ing_nd_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_ing_nd_temporal'] = $_SESSION['insumos_ing_nd_basicos']['Observaciones'];
			$_SESSION['insumos_ing_nd_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_ing_nd_archivos'])){
				foreach ($_SESSION['insumos_ing_nd_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumos_ingreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_ing_nd_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_ing_nd_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_ing_nd':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_ing_nd_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_ing_nd_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_ing_nd_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'ing_bodega_nd':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_ing_nd_basicos'])){
				if(!isset($_SESSION['insumos_ing_nd_basicos']['idDocumentos']) or $_SESSION['insumos_ing_nd_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['insumos_ing_nd_basicos']['N_Doc']) or $_SESSION['insumos_ing_nd_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha seleccionado el area';}
				if(!isset($_SESSION['insumos_ing_nd_basicos']['Observaciones']) or $_SESSION['insumos_ing_nd_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha seleccionado la maquina';}
				if(!isset($_SESSION['insumos_ing_nd_basicos']['idSistema']) or $_SESSION['insumos_ing_nd_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['insumos_ing_nd_basicos']['idUsuario']) or $_SESSION['insumos_ing_nd_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) or $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['insumos_ing_nd_basicos']['idTipo']) or $_SESSION['insumos_ing_nd_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['insumos_ing_nd_basicos']['idDocumentos']) && $_SESSION['insumos_ing_nd_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['insumos_ing_nd_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}	
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['insumos_ing_nd_productos'])&&!isset($_SESSION['insumos_ing_nd_otros'])){
				$error['idProducto']   = 'error/No se han asignado insumos ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_ing_nd_productos'])){
				foreach ($_SESSION['insumos_ing_nd_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['insumos_ing_nd_otros'])){
				foreach ($_SESSION['insumos_ing_nd_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado insumos ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['insumos_ing_nd_basicos']['idBodega']) && $_SESSION['insumos_ing_nd_basicos']['idBodega'] != ''){              $a  = "'".$_SESSION['insumos_ing_nd_basicos']['idBodega']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idSistema']) && $_SESSION['insumos_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idUsuario']) && $_SESSION['insumos_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idDocumentos']) && $_SESSION['insumos_ing_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idDocumentos']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['N_Doc']) && $_SESSION['insumos_ing_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idTipo']) && $_SESSION['insumos_ing_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['Observaciones']) && $_SESSION['insumos_ing_nd_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idProveedor']) && $_SESSION['insumos_ing_nd_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idProveedor']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['Pago_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['insumos_ing_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['insumos_ing_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nd_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['insumos_ing_nd_basicos']['fecha_auto']) && $_SESSION['insumos_ing_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['fecha_auto']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['valor_neto_fact'])&&$_SESSION['insumos_ing_nd_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['valor_neto_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['valor_neto_imp'])&&$_SESSION['insumos_ing_nd_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['valor_neto_imp']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['valor_total_fact'])&&$_SESSION['insumos_ing_nd_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['valor_total_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][1]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][1]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][2]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][2]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][3]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][3]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][4]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][4]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][5]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][5]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][6]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][6]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][7]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][7]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][8]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][8]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][9]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][9]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_impuestos'][10]['valor'])&&$_SESSION['insumos_ing_nd_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['insumos_ing_nd_impuestos'][10]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idCentroCosto']) && $_SESSION['insumos_ing_nd_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idLevel_1']) && $_SESSION['insumos_ing_nd_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idLevel_2']) && $_SESSION['insumos_ing_nd_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idLevel_3']) && $_SESSION['insumos_ing_nd_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idLevel_4']) && $_SESSION['insumos_ing_nd_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nd_basicos']['idLevel_5']) && $_SESSION['insumos_ing_nd_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
					
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idBodegaDestino, idSistema, idUsuario, Creacion_fecha, Creacion_Semana, Creacion_mes,
				Creacion_ano, idDocumentos, N_Doc, idTipo,Observaciones, idProveedor, Pago_fecha,Pago_dia, Pago_Semana, Pago_mes, 
				Pago_ano, idEstado, fecha_auto, ValorNeto, ValorNetoImp, ValorTotal, Impuesto_01, Impuesto_02, Impuesto_03, 
				Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, Impuesto_09, Impuesto_10, idCentroCosto, 
				idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5	) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los trabajadores	
					if(isset($_SESSION['insumos_ing_nd_productos'])){		
						foreach ($_SESSION['insumos_ing_nd_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idBodega']) && $_SESSION['insumos_ing_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idSistema']) && $_SESSION['insumos_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idUsuario']) && $_SESSION['insumos_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idDocumentos']) && $_SESSION['insumos_ing_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idDocumentos']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['N_Doc']) && $_SESSION['insumos_ing_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idTipo']) && $_SESSION['insumos_ing_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                              $a .= ",'".$producto['idProducto']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['Cantidad_ing']) && $producto['Cantidad_ing'] != ''){                                                          $a .= ",'".$producto['Cantidad_ing']."'" ;                                 }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                          $a .= ",'".$producto['ValorIngreso']."'" ;                                 }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                              $a .= ",'".$producto['ValorTotal']."'" ;                                   }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idProveedor']) && $_SESSION['insumos_ing_nd_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['fecha_auto']) && $_SESSION['insumos_ing_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
						
					
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario,
							Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing, Valor, ValorTotal,
							idProveedor, fecha_auto) 
							VALUES ({$a} )";
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
					//Otros Motivos
					if(isset($_SESSION['insumos_ing_nd_otros'])){
						foreach ($_SESSION['insumos_ing_nd_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idBodega']) && $_SESSION['insumos_ing_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idSistema']) && $_SESSION['insumos_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idUsuario']) && $_SESSION['insumos_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_otros` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_ing_nd_archivos'])){
						foreach ($_SESSION['insumos_ing_nd_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idBodega']) && $_SESSION['insumos_ing_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idSistema']) && $_SESSION['insumos_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idUsuario']) && $_SESSION['insumos_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_ing_nd_basicos']);
					unset($_SESSION['insumos_ing_nd_productos']);
					unset($_SESSION['insumos_ing_nd_temporal']);
					unset($_SESSION['insumos_ing_nd_impuestos']);
					unset($_SESSION['insumos_ing_nd_archivos']);
					unset($_SESSION['insumos_ing_nd_otros']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        INGRESOS NC                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_ingreso_nc':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			//Se verifica si el dato existe
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_nc_basicos']);
				unset($_SESSION['insumos_ing_nc_productos']);
				unset($_SESSION['insumos_ing_nc_temporal']);
				unset($_SESSION['insumos_ing_nc_impuestos']);
				unset($_SESSION['insumos_ing_nc_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_ing_nc_archivos'])){
					foreach ($_SESSION['insumos_ing_nc_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_ing_nc_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_ing_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_ing_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_ing_nc_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_ing_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_ing_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_ing_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idProveedor) && $idProveedor != ''){             $_SESSION['insumos_ing_nc_basicos']['idProveedor'] = $idProveedor;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_ing_nc_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_ing_nc_basicos']['idBodega'] = $idBodega;}
				 
				//Se agrega el impuesto
				$_SESSION['insumos_ing_nc_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_ing_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_ing_nc_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_ing_nc_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_ing_nc_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_ing_nc_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_ing_nc_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_ing_nc_basicos']['idLevel_5']     = 0;
				
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nc_basicos']);
			unset($_SESSION['insumos_ing_nc_productos']);
			unset($_SESSION['insumos_ing_nc_temporal']);
			unset($_SESSION['insumos_ing_nc_impuestos']);
			unset($_SESSION['insumos_ing_nc_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_ing_nc_archivos'])){
				foreach ($_SESSION['insumos_ing_nc_archivos'] as $key => $producto){
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
			unset($_SESSION['insumos_ing_nc_archivos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing_nc':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_nc_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['insumos_ing_nc_productos']);
				unset($_SESSION['insumos_ing_nc_impuestos']);
				unset($_SESSION['insumos_ing_nc_otros']);
			
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_ing_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_ing_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_ing_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_ing_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_ing_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idProveedor) && $idProveedor != ''){             $_SESSION['insumos_ing_nc_basicos']['idProveedor'] = $idProveedor;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_ing_nc_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_ing_nc_basicos']['idBodega'] = $idBodega;}
				
				//Se agrega el impuesto
				$_SESSION['insumos_ing_nc_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idProveedor) && $idProveedor != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `proveedor_listado`
					WHERE idProveedor = ".$idProveedor;
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
					$rowProveedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['insumos_ing_nc_basicos']['Proveedor'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_ing_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_ing_nc':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_ing_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_ing_nc_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nc_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nc_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nc_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nc_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_ing_nc_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]])&&$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idEstado=1";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $producto){
					$arrProd['Prod'][$producto['idProducto']]['Nombre'] = $producto['Nombre'];
					$arrProd['Prod'][$producto['idProducto']]['Unimed'] = $producto['Unimed'];
				}
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]['Cantidad_eg']   = $Cantidad_eg[$j1];
					$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]['ValorIngreso']  = $ValorTotal[$j1]/$Cantidad_eg[$j1];
					$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];				
					$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]['Nombre']        = $arrProd['Prod'][$idProducto[$j1]]['Nombre'];
					$_SESSION['insumos_ing_nc_productos'][$idProducto[$j1]]['Unimed']        = $arrProd['Prod'][$idProducto[$j1]]['Unimed'];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_nc_productos'][$idProducto])&&$_SESSION['insumos_ing_nc_productos'][$idProducto]>0&&$_SESSION['insumos_ing_nc_productos'][$idProducto]!=$_SESSION['insumos_ing_nc_productos'][$oldItemID]){
				$error['productos'] = 'error/El Insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
					
				// Se traen los datos del producto
				$query = "SELECT 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE idProducto=".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);	
				
				//Borro el producto
				unset($_SESSION['insumos_ing_nc_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['insumos_ing_nc_productos'][$idProducto]['idProducto']    = $idProducto;
				$_SESSION['insumos_ing_nc_productos'][$idProducto]['Cantidad_eg']   = $Cantidad_eg;
				$_SESSION['insumos_ing_nc_productos'][$idProducto]['ValorIngreso']  = $ValorIngreso;
				$_SESSION['insumos_ing_nc_productos'][$idProducto]['ValorTotal']    = $ValorTotal;
				$_SESSION['insumos_ing_nc_productos'][$idProducto]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['insumos_ing_nc_productos'][$idProducto]['Unimed']        = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;

/*******************************************************************************************************************/		
		case 'del_prod_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nc_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_ing_nc_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_ing_nc_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_ing_nc_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['insumos_ing_nc_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['insumos_ing_nc_otros'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_otros_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['insumos_ing_nc_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['insumos_ing_nc_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['insumos_ing_nc_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nc_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_ing_nc':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_ing_nc_impuestos'][$idImpuesto])&&$_SESSION['insumos_ing_nc_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_ing_nc_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_ing_nc_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_ing_nc_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_ing_nc_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	

/*******************************************************************************************************************/		
		case 'add_obs_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_ing_nc_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_ing_nc_temporal'] = $_SESSION['insumos_ing_nc_basicos']['Observaciones'];
			$_SESSION['insumos_ing_nc_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_ing_nc_archivos'])){
				foreach ($_SESSION['insumos_ing_nc_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumos_egreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_ing_nc_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_ing_nc_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_ing_nc':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_ing_nc_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_ing_nc_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_ing_nc_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'ing_bodega_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
					
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_ing_nc_basicos'])){
				if(!isset($_SESSION['insumos_ing_nc_basicos']['idDocumentos']) or $_SESSION['insumos_ing_nc_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documentoa';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['N_Doc']) or $_SESSION['insumos_ing_nc_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['Observaciones']) or $_SESSION['insumos_ing_nc_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['idSistema']) or $_SESSION['insumos_ing_nc_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['idUsuario']) or $_SESSION['insumos_ing_nc_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha sleccionado el usuario';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']) or $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado una fecha de creacion';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['idTipo']) or $_SESSION['insumos_ing_nc_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['insumos_ing_nc_basicos']['idProveedor']) or $_SESSION['insumos_ing_nc_basicos']['idProveedor']=='' ){       $error['idProveedor']      = 'error/No ha seleccionado el proveedor';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['insumos_ing_nc_basicos']['idDocumentos']) && $_SESSION['insumos_ing_nc_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['insumos_ing_nc_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//productos o guias
			if (!isset($_SESSION['insumos_ing_nc_productos'])&&!isset($_SESSION['insumos_ing_nc_otros'])){
				$error['idProducto']   = 'error/No se han asignado ni insumos ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_ing_nc_productos'])){
				foreach ($_SESSION['insumos_ing_nc_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['insumos_ing_nc_otros'])){
				foreach ($_SESSION['insumos_ing_nc_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos']   = 'error/No se han asignado ni insumos ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_ing_nc_basicos']['idDocumentos']) && $_SESSION['insumos_ing_nc_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['insumos_ing_nc_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['N_Doc']) && $_SESSION['insumos_ing_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['Observaciones']) && $_SESSION['insumos_ing_nc_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idBodega']) && $_SESSION['insumos_ing_nc_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idSistema']) && $_SESSION['insumos_ing_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idUsuario']) && $_SESSION['insumos_ing_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idTipo']) && $_SESSION['insumos_ing_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idProveedor']) && $_SESSION['insumos_ing_nc_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idProveedor']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['fecha_auto']) && $_SESSION['insumos_ing_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['fecha_auto']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['valor_neto_fact'])&&$_SESSION['insumos_ing_nc_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['valor_neto_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['valor_neto_imp'])&&$_SESSION['insumos_ing_nc_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['valor_neto_imp']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['valor_total_fact'])&&$_SESSION['insumos_ing_nc_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['valor_total_fact']."'";  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][1]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][1]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][2]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][2]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][3]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][3]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][4]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][4]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][5]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][5]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][6]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][6]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][7]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][7]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][8]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][8]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][9]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][9]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_impuestos'][10]['valor'])&&$_SESSION['insumos_ing_nc_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['insumos_ing_nc_impuestos'][10]['valor']."'";       }else{$a .= ",''";}
				$a .= ",'1'";
				if(isset($_SESSION['insumos_ing_nc_basicos']['idCentroCosto']) && $_SESSION['insumos_ing_nc_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idLevel_1']) && $_SESSION['insumos_ing_nc_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idLevel_2']) && $_SESSION['insumos_ing_nc_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idLevel_3']) && $_SESSION['insumos_ing_nc_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idLevel_4']) && $_SESSION['insumos_ing_nc_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_ing_nc_basicos']['idLevel_5']) && $_SESSION['insumos_ing_nc_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, Observaciones, 
				idBodegaOrigen, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, 
				Creacion_ano, idProveedor, fecha_auto, ValorNeto, ValorNetoImp,ValorTotal, Impuesto_01, 
				Impuesto_02, Impuesto_03, Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, 
				Impuesto_09, Impuesto_10, idEstado, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, 
				idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los productos	
					if(isset($_SESSION['insumos_ing_nc_productos'])){		
						foreach ($_SESSION['insumos_ing_nc_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idBodega']) && $_SESSION['insumos_ing_nc_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idSistema']) && $_SESSION['insumos_ing_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idUsuario']) && $_SESSION['insumos_ing_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idDocumentos']) && $_SESSION['insumos_ing_nc_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['N_Doc']) && $_SESSION['insumos_ing_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idTipo']) && $_SESSION['insumos_ing_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                              $a .= ",'".$producto['idProducto']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['Cantidad_eg']) && $producto['Cantidad_eg'] != ''){                                                            $a .= ",'".$producto['Cantidad_eg']."'" ;                             }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                          $a .= ",'".$producto['ValorIngreso']."'" ;                            }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                              $a .= ",'".$producto['ValorTotal']."'" ;                              }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idProveedor']) && $_SESSION['insumos_ing_nc_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idProveedor']."'" ;   }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['fecha_auto']) && $_SESSION['insumos_ing_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, 
							idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, Valor,ValorTotal,	 idProveedor, fecha_auto) 
							VALUES ({$a} )";
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
					//Otros Motivos
					if(isset($_SESSION['insumos_ing_nc_otros'])){
						foreach ($_SESSION['insumos_ing_nc_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idBodega']) && $_SESSION['insumos_ing_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idSistema']) && $_SESSION['insumos_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['idUsuario']) && $_SESSION['insumos_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_otros` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_ing_nc_archivos'])){
						foreach ($_SESSION['insumos_ing_nc_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idBodega']) && $_SESSION['insumos_ing_nc_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idSistema']) && $_SESSION['insumos_ing_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['idUsuario']) && $_SESSION['insumos_ing_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_ing_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_ing_nc_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_ing_nc_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_ing_nc_basicos']);
					unset($_SESSION['insumos_ing_nc_productos']);
					unset($_SESSION['insumos_ing_nc_temporal']);
					unset($_SESSION['insumos_ing_nc_impuestos']);
					unset($_SESSION['insumos_ing_nc_archivos']);
					unset($_SESSION['insumos_ing_nc_otros']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                       INGRESOS ND                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_egreso_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_egr_nd_basicos']);
				unset($_SESSION['insumos_egr_nd_productos']);
				unset($_SESSION['insumos_egr_nd_temporal']);
				unset($_SESSION['insumos_egr_nd_impuestos']);
				unset($_SESSION['insumos_egr_nd_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_egr_nd_archivos'])){
					foreach ($_SESSION['insumos_egr_nd_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_egr_nd_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_egr_nd_basicos']['idCliente']        = $idCliente;
				$_SESSION['insumos_egr_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['insumos_egr_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['insumos_egr_nd_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['insumos_egr_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['insumos_egr_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['insumos_egr_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['insumos_egr_nd_basicos']['Pago_fecha']       = '0000-00-00';
				$_SESSION['insumos_egr_nd_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['insumos_egr_nd_basicos']['idBodega']         = $idBodega;
				
				//Se agrega el impuesto
				$_SESSION['insumos_egr_nd_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['Documento'] = '';
				}
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['TipoDocumento'] = '';
				}
				/********************************************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['Bodega'] = '';
				}
				/********************************************************************************/
				if(isset($idCliente) && $idCliente != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `clientes_listado`
					WHERE idCliente = ".$idCliente;
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
					$rowCliente = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['Cliente'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_egr_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_egr_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_egr_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_egr_nd_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_egr_nd_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_egr_nd_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_egr_nd_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_egr_nd_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_egr_nd_basicos']['idLevel_5']     = 0;
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nd_basicos']);
			unset($_SESSION['insumos_egr_nd_productos']);
			unset($_SESSION['insumos_egr_nd_temporal']);
			unset($_SESSION['insumos_egr_nd_impuestos']);
			unset($_SESSION['insumos_egr_nd_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_egr_nd_archivos'])){
				foreach ($_SESSION['insumos_egr_nd_archivos'] as $key => $producto){
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
			unset($_SESSION['insumos_egr_nd_archivos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_egr_nd_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['insumos_egr_nd_productos']);
				unset($_SESSION['insumos_egr_nd_guias']);
				unset($_SESSION['insumos_egr_nd_impuestos']);
				unset($_SESSION['insumos_egr_nd_otros']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['insumos_egr_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['insumos_egr_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['insumos_egr_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['insumos_egr_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['insumos_egr_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['insumos_egr_nd_basicos']['idCliente']        = $idCliente;
				$_SESSION['insumos_egr_nd_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['insumos_egr_nd_basicos']['idBodega']         = $idBodega;
				
				//Se agrega el impuesto
				$_SESSION['insumos_egr_nd_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['Documento'] = '';
				}
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['TipoDocumento'] = '';
				}
				/********************************************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['Bodega'] = '';
				}
				/********************************************************************************/
				if(isset($idCliente) && $idCliente != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `clientes_listado`
					WHERE idCliente = ".$idCliente;
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
					$rowCliente = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['insumos_egr_nd_basicos']['Cliente'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_egr_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_egr_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_egr_nd':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_egr_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_egr_nd_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nd_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nd_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nd_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nd_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nd_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]])&&$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idEstado=1";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $producto){
					$arrProd['Prod'][$producto['idProducto']]['Nombre'] = $producto['Nombre'];
					$arrProd['Prod'][$producto['idProducto']]['Unimed'] = $producto['Unimed'];
				}
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]['Cantidad_eg']   = $Cantidad_eg[$j1];
					$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]['ValorIngreso']  = $ValorTotal[$j1]/$Cantidad_eg[$j1];
					$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];
					$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]['Nombre']        = $arrProd['Prod'][$idProducto[$j1]]['Nombre'];
					$_SESSION['insumos_egr_nd_productos'][$idProducto[$j1]]['Unimed']        = $arrProd['Prod'][$idProducto[$j1]]['Unimed'];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_egr_nd_productos'][$idProducto])&&$_SESSION['insumos_egr_nd_productos'][$idProducto]>0&&$_SESSION['insumos_egr_nd_productos'][$idProducto]!=$_SESSION['insumos_egr_nd_productos'][$oldItemID]){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen todos los datos de mi usuario
				$query = "SELECT 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idProducto=".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['insumos_egr_nd_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['insumos_egr_nd_productos'][$idProducto]['idProducto']       = $idProducto;
				$_SESSION['insumos_egr_nd_productos'][$idProducto]['Cantidad_eg']      = $Cantidad_eg;
				$_SESSION['insumos_egr_nd_productos'][$idProducto]['ValorIngreso']     = $ValorIngreso;
				$_SESSION['insumos_egr_nd_productos'][$idProducto]['ValorTotal']       = $ValorTotal;
				$_SESSION['insumos_egr_nd_productos'][$idProducto]['Nombre']           = $rowProducto['Nombre'];
				$_SESSION['insumos_egr_nd_productos'][$idProducto]['Porcentaje']       = $rowProducto['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro el producto
			unset($_SESSION['insumos_egr_nd_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_egr_nd_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_egr_nd_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_egr_nd_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['insumos_egr_nd_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['insumos_egr_nd_otros'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_otros_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['insumos_egr_nd_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['insumos_egr_nd_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['insumos_egr_nd_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nd_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_egr_nd_impuestos'][$idImpuesto])&&$_SESSION['insumos_egr_nd_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_egr_nd_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_egr_nd_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_egr_nd_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nd_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_egr_nd_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_egr_nd_temporal'] = $_SESSION['insumos_egr_nd_basicos']['Observaciones'];
			$_SESSION['insumos_egr_nd_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_egr_nd_archivos'])){
				foreach ($_SESSION['insumos_egr_nd_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumos_egreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_egr_nd_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_egr_nd_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_egr_nd':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_egr_nd_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_egr_nd_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_egr_nd_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'egr_bodega_nd':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_egr_nd_basicos'])){
				if(!isset($_SESSION['insumos_egr_nd_basicos']['idDocumentos']) or $_SESSION['insumos_egr_nd_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['insumos_egr_nd_basicos']['N_Doc']) or $_SESSION['insumos_egr_nd_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha seleccionado el area';}
				if(!isset($_SESSION['insumos_egr_nd_basicos']['Observaciones']) or $_SESSION['insumos_egr_nd_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha seleccionado la maquina';}
				if(!isset($_SESSION['insumos_egr_nd_basicos']['idSistema']) or $_SESSION['insumos_egr_nd_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['insumos_egr_nd_basicos']['idUsuario']) or $_SESSION['insumos_egr_nd_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) or $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['insumos_egr_nd_basicos']['idTipo']) or $_SESSION['insumos_egr_nd_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['insumos_egr_nd_basicos']['idDocumentos']) && $_SESSION['insumos_egr_nd_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['insumos_egr_nd_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}	
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['insumos_egr_nd_productos'])&&!isset($_SESSION['insumos_egr_nd_otros'])){
				$error['idProducto']   = 'error/No se han asignado insumos ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_egr_nd_productos'])){
				foreach ($_SESSION['insumos_egr_nd_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['insumos_egr_nd_otros'])){
				foreach ($_SESSION['insumos_egr_nd_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado insumos ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['insumos_egr_nd_basicos']['idBodega']) && $_SESSION['insumos_egr_nd_basicos']['idBodega'] != ''){              $a  = "'".$_SESSION['insumos_egr_nd_basicos']['idBodega']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idSistema']) && $_SESSION['insumos_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idUsuario']) && $_SESSION['insumos_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idDocumentos']) && $_SESSION['insumos_egr_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idDocumentos']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['N_Doc']) && $_SESSION['insumos_egr_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idTipo']) && $_SESSION['insumos_egr_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['Observaciones']) && $_SESSION['insumos_egr_nd_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idCliente']) && $_SESSION['insumos_egr_nd_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idCliente']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['Pago_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['insumos_egr_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['insumos_egr_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nd_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['insumos_egr_nd_basicos']['fecha_auto']) && $_SESSION['insumos_egr_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['fecha_auto']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['valor_neto_fact'])&&$_SESSION['insumos_egr_nd_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['valor_neto_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['valor_neto_imp'])&&$_SESSION['insumos_egr_nd_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['valor_neto_imp']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['valor_total_fact'])&&$_SESSION['insumos_egr_nd_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['valor_total_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][1]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][1]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][2]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][2]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][3]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][3]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][4]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][4]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][5]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][5]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][6]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][6]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][7]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][7]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][8]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][8]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][9]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][9]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_impuestos'][10]['valor'])&&$_SESSION['insumos_egr_nd_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['insumos_egr_nd_impuestos'][10]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idCentroCosto']) && $_SESSION['insumos_egr_nd_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idLevel_1']) && $_SESSION['insumos_egr_nd_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idLevel_2']) && $_SESSION['insumos_egr_nd_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idLevel_3']) && $_SESSION['insumos_egr_nd_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idLevel_4']) && $_SESSION['insumos_egr_nd_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nd_basicos']['idLevel_5']) && $_SESSION['insumos_egr_nd_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
					
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idBodegaOrigen, idSistema, idUsuario, Creacion_fecha, Creacion_Semana, Creacion_mes,
				Creacion_ano, idDocumentos, N_Doc, idTipo,Observaciones, idCliente, Pago_fecha,Pago_dia, Pago_Semana, Pago_mes, 
				Pago_ano, idEstado, fecha_auto, ValorNeto, ValorNetoImp, ValorTotal, Impuesto_01, Impuesto_02, Impuesto_03, 
				Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, Impuesto_09, Impuesto_10, idCentroCosto, 
				idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5	) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los trabajadores	
					if(isset($_SESSION['insumos_egr_nd_productos'])){		
						foreach ($_SESSION['insumos_egr_nd_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idBodega']) && $_SESSION['insumos_egr_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idSistema']) && $_SESSION['insumos_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idUsuario']) && $_SESSION['insumos_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idDocumentos']) && $_SESSION['insumos_egr_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idDocumentos']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['N_Doc']) && $_SESSION['insumos_egr_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idTipo']) && $_SESSION['insumos_egr_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                              $a .= ",'".$producto['idProducto']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['Cantidad_eg']) && $producto['Cantidad_eg'] != ''){                                                            $a .= ",'".$producto['Cantidad_eg']."'" ;                                  }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                          $a .= ",'".$producto['ValorIngreso']."'" ;                                 }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                              $a .= ",'".$producto['ValorTotal']."'" ;                                   }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idCliente']) && $_SESSION['insumos_egr_nd_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idCliente']."'" ;          }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['fecha_auto']) && $_SESSION['insumos_egr_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
						
					
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario,
							Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, Valor, ValorTotal,
							idCliente, fecha_auto) 
							VALUES ({$a} )";
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
					//Otros Motivos
					if(isset($_SESSION['insumos_egr_nd_otros'])){
						foreach ($_SESSION['insumos_egr_nd_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idBodega']) && $_SESSION['insumos_egr_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idSistema']) && $_SESSION['insumos_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idUsuario']) && $_SESSION['insumos_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_otros` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_egr_nd_archivos'])){
						foreach ($_SESSION['insumos_egr_nd_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idBodega']) && $_SESSION['insumos_egr_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idSistema']) && $_SESSION['insumos_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idUsuario']) && $_SESSION['insumos_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_egr_nd_basicos']);
					unset($_SESSION['insumos_egr_nd_productos']);
					unset($_SESSION['insumos_egr_nd_temporal']);
					unset($_SESSION['insumos_egr_nd_impuestos']);
					unset($_SESSION['insumos_egr_nd_archivos']);
					unset($_SESSION['insumos_egr_nd_otros']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        INGRESOS NC                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_egreso_nc':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			//Se verifica si el dato existe
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_insumos_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_egr_nc_basicos']);
				unset($_SESSION['insumos_egr_nc_productos']);
				unset($_SESSION['insumos_egr_nc_temporal']);
				unset($_SESSION['insumos_egr_nc_impuestos']);
				unset($_SESSION['insumos_egr_nc_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['insumos_egr_nc_archivos'])){
					foreach ($_SESSION['insumos_egr_nc_archivos'] as $key => $producto){
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
				unset($_SESSION['insumos_egr_nc_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_egr_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_egr_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['insumos_egr_nc_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_egr_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_egr_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_egr_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_egr_nc_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_egr_nc_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_egr_nc_basicos']['idBodega'] = $idBodega;}
				
				//Se agrega el impuesto
				$_SESSION['insumos_egr_nc_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['Documento'] = '';
				}
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['TipoDocumento'] = '';
				}
				/********************************************************************************/
				if(isset($idCliente) && $idCliente != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `clientes_listado`
					WHERE idCliente = ".$idCliente;
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
					$rowCliente = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['Cliente'] = '';
				}
				/********************************************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['Bodega'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_egr_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_egr_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_egr_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_egr_nc_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_egr_nc_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_egr_nc_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_egr_nc_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_egr_nc_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_egr_nc_basicos']['idLevel_5']     = 0;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nc_basicos']);
			unset($_SESSION['insumos_egr_nc_productos']);
			unset($_SESSION['insumos_egr_nc_temporal']);
			unset($_SESSION['insumos_egr_nc_impuestos']);
			unset($_SESSION['insumos_egr_nc_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['insumos_egr_nc_archivos'])){
				foreach ($_SESSION['insumos_egr_nc_archivos'] as $key => $producto){
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
			unset($_SESSION['insumos_egr_nc_archivos']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_egr_nc':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_egr_nc_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['insumos_egr_nc_productos']);
				unset($_SESSION['insumos_egr_nc_impuestos']);
				unset($_SESSION['insumos_egr_nc_otros']);
			
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['insumos_egr_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['insumos_egr_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['insumos_egr_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['insumos_egr_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['insumos_egr_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['insumos_egr_nc_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['insumos_egr_nc_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['insumos_egr_nc_basicos']['idBodega'] = $idBodega;}
				
				//Se agrega el impuesto
				$_SESSION['insumos_egr_nc_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idDocumentos) && $idDocumentos != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `core_documentos_mercantiles`
					WHERE idDocumentos = ".$idDocumentos;
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
					$rowDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['Documento'] = '';
				}
				/********************************************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_facturacion_tipo`
					WHERE idTipo = ".$idTipo;
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
					$rowTipoDocumento = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['TipoDocumento'] = '';
				}
				/********************************************************************************/
				if(isset($idCliente) && $idCliente != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `clientes_listado`
					WHERE idCliente = ".$idCliente;
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
					$rowCliente = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['Cliente'] = '';
				}
				/********************************************************************************/
				if(isset($idBodega) && $idBodega != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_insumos_listado`
					WHERE idBodega = ".$idBodega;
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
					$rowBodega = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['Bodega'] = $rowBodega['Nombre'];
				}else{
					$_SESSION['insumos_egr_nc_basicos']['Bodega'] = '';
				}
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = 1";
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				//se guarda dato
				$_SESSION['insumos_egr_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_egr_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'modCentroCosto_egr_nc':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Centro de Costo vacio
				$_SESSION['insumos_egr_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
				/****************************************************/
				if(isset($idCentroCosto) && $idCentroCosto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado`
					WHERE idCentroCosto = ".$idCentroCosto;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['insumos_egr_nc_basicos']['idCentroCosto'] = $idCentroCosto;
				}
				/****************************************************/
				if(isset($idLevel_1) && $idLevel_1 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_1`
					WHERE idLevel_1 = ".$idLevel_1;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nc_basicos']['idLevel_1']    = $idLevel_1;
				}
				/****************************************************/
				if(isset($idLevel_2) && $idLevel_2 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_2`
					WHERE idLevel_2 = ".$idLevel_2;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nc_basicos']['idLevel_2']    = $idLevel_2;
				}
				/****************************************************/
				if(isset($idLevel_3) && $idLevel_3 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_3`
					WHERE idLevel_3 = ".$idLevel_3;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nc_basicos']['idLevel_3']    = $idLevel_3;
				}
				/****************************************************/
				if(isset($idLevel_4) && $idLevel_4 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_4`
					WHERE idLevel_4 = ".$idLevel_4;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nc_basicos']['idLevel_4']    = $idLevel_4;
				}
				/****************************************************/
				if(isset($idLevel_5) && $idLevel_5 != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `centrocosto_listado_level_5`
					WHERE idLevel_5 = ".$idLevel_5;
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
					$rowCentro = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['insumos_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['insumos_egr_nc_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;
/*******************************************************************************************************************/		
		case 'new_prod_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			if(isset($idProducto)){  $ndata_1 = count($idProducto);  }else{$ndata_1 = 0;}
			//generacion de errores
			if($ndata_1==0) {
				$error['ndata_3'] = 'error/No hay insumos agregados';
			}else{
				$n_repetidos = 0;
				//Recorro los productos verificando repetidos
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					if(isset($_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]])&&$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]>0){
						$n_repetidos++;
					}
				}
				//si hay repetidos
				if($n_repetidos!=0) {
					$error['productos'] = 'error/El insumo que intenta agregar ya existe';	
				}
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idEstado=1";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				$arrProd = array();
				foreach ($arrProductos as $producto){
					$arrProd['Prod'][$producto['idProducto']]['Nombre'] = $producto['Nombre'];
					$arrProd['Prod'][$producto['idProducto']]['Unimed'] = $producto['Unimed'];
				}
			}
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				for($j1 = 0; $j1 < $ndata_1; $j1++){
					$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]['idProducto']    = $idProducto[$j1];
					$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]['Cantidad_ing']  = $Cantidad_ing[$j1];
					$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]['ValorIngreso']  = $ValorTotal[$j1]/$Cantidad_ing[$j1];
					$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]['ValorTotal']    = $ValorTotal[$j1];
					$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]['Nombre']        = $arrProd['Prod'][$idProducto[$j1]]['Nombre'];
					$_SESSION['insumos_egr_nc_productos'][$idProducto[$j1]]['Unimed']        = $arrProd['Prod'][$idProducto[$j1]]['Unimed'];
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}
			

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_egr_nc_productos'][$idProducto])&&$_SESSION['insumos_egr_nc_productos'][$idProducto]>0&&$_SESSION['insumos_egr_nc_productos'][$idProducto]!=$_SESSION['insumos_egr_nc_productos'][$oldItemID]){
				$error['productos'] = 'error/El Insumo que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se trae informacion
				$query = "SELECT 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idProducto=".$idProducto;
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['insumos_egr_nc_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['insumos_egr_nc_productos'][$idProducto]['idProducto']    = $idProducto;
				$_SESSION['insumos_egr_nc_productos'][$idProducto]['Cantidad_ing']  = $Cantidad_ing;
				$_SESSION['insumos_egr_nc_productos'][$idProducto]['ValorIngreso']  = $ValorIngreso;
				$_SESSION['insumos_egr_nc_productos'][$idProducto]['ValorTotal']    = $ValorTotal;
				$_SESSION['insumos_egr_nc_productos'][$idProducto]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['insumos_egr_nc_productos'][$idProducto]['Unimed']        = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;

/*******************************************************************************************************************/		
		case 'del_prod_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nc_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['insumos_egr_nc_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['insumos_egr_nc_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['insumos_egr_nc_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['insumos_egr_nc_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['insumos_egr_nc_otros'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_otros_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['insumos_egr_nc_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['insumos_egr_nc_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['insumos_egr_nc_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nc_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_egr_nc':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['insumos_egr_nc_impuestos'][$idImpuesto])&&$_SESSION['insumos_egr_nc_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************************************/
				// Se traen todos los datos de mi usuario
				$query = "SELECT Nombre, Porcentaje
				FROM `sistema_impuestos`
				WHERE idImpuesto = ".$idImpuesto;
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
				$rowImpuesto = mysqli_fetch_assoc ($resultado);
				
				//se guarda dato
				$_SESSION['insumos_egr_nc_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				$_SESSION['insumos_egr_nc_impuestos'][$idImpuesto]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['insumos_egr_nc_impuestos'][$idImpuesto]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['insumos_egr_nc_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	

/*******************************************************************************************************************/		
		case 'add_obs_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['insumos_egr_nc_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['insumos_egr_nc_temporal'] = $_SESSION['insumos_egr_nc_basicos']['Observaciones'];
			$_SESSION['insumos_egr_nc_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['insumos_egr_nc_archivos'])){
				foreach ($_SESSION['insumos_egr_nc_archivos'] as $key => $trabajos){
					if($idInterno<$trabajos['idFile']){$idInterno = $trabajos['idFile'];}
				}
			}
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
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
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'insumos_egreso_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//se guarda en el indice siguiente
									$idInterno = $idInterno+1;
									//Se guarda el trabajo asignado
									$_SESSION['insumos_egr_nc_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['insumos_egr_nc_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
									header( 'Location: '.$location.'&view=true' );
									die;
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file_egr_nc':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['insumos_egr_nc_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['insumos_egr_nc_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['insumos_egr_nc_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'egr_bodega_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
			$n_data2 = 0;
					
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['insumos_egr_nc_basicos'])){
				if(!isset($_SESSION['insumos_egr_nc_basicos']['idDocumentos']) or $_SESSION['insumos_egr_nc_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documentoa';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['N_Doc']) or $_SESSION['insumos_egr_nc_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['Observaciones']) or $_SESSION['insumos_egr_nc_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['idSistema']) or $_SESSION['insumos_egr_nc_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['idUsuario']) or $_SESSION['insumos_egr_nc_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha sleccionado el usuario';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']) or $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado una fecha de creacion';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['idTipo']) or $_SESSION['insumos_egr_nc_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['insumos_egr_nc_basicos']['idCliente']) or $_SESSION['insumos_egr_nc_basicos']['idCliente']=='' ){           $error['idCliente']        = 'error/No ha seleccionado el cliente';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['insumos_egr_nc_basicos']['idDocumentos']) && $_SESSION['insumos_egr_nc_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['insumos_egr_nc_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//productos o guias
			if (!isset($_SESSION['insumos_egr_nc_productos'])&&!isset($_SESSION['insumos_egr_nc_otros'])){
				$error['idProducto']   = 'error/No se han asignado ni insumos ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['insumos_egr_nc_productos'])){
				foreach ($_SESSION['insumos_egr_nc_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['insumos_egr_nc_otros'])){
				foreach ($_SESSION['insumos_egr_nc_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos']   = 'error/No se han asignado ni insumos ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['insumos_egr_nc_basicos']['idDocumentos']) && $_SESSION['insumos_egr_nc_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['insumos_egr_nc_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['N_Doc']) && $_SESSION['insumos_egr_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['Observaciones']) && $_SESSION['insumos_egr_nc_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idBodega']) && $_SESSION['insumos_egr_nc_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idSistema']) && $_SESSION['insumos_egr_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idUsuario']) && $_SESSION['insumos_egr_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idTipo']) && $_SESSION['insumos_egr_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idCliente']) && $_SESSION['insumos_egr_nc_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idCliente']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['fecha_auto']) && $_SESSION['insumos_egr_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['fecha_auto']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['valor_neto_fact'])&&$_SESSION['insumos_egr_nc_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['valor_neto_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['valor_neto_imp'])&&$_SESSION['insumos_egr_nc_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['valor_neto_imp']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['valor_total_fact'])&&$_SESSION['insumos_egr_nc_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['valor_total_fact']."'";  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][1]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][1]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][2]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][2]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][3]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][3]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][4]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][4]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][5]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][5]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][6]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][6]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][7]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][7]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][8]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][8]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][9]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][9]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_impuestos'][10]['valor'])&&$_SESSION['insumos_egr_nc_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['insumos_egr_nc_impuestos'][10]['valor']."'";       }else{$a .= ",''";}
				$a .= ",'1'";
				if(isset($_SESSION['insumos_egr_nc_basicos']['idCentroCosto']) && $_SESSION['insumos_egr_nc_basicos']['idCentroCosto'] != ''){     $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idCentroCosto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idLevel_1']) && $_SESSION['insumos_egr_nc_basicos']['idLevel_1'] != ''){             $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idLevel_1']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idLevel_2']) && $_SESSION['insumos_egr_nc_basicos']['idLevel_2'] != ''){             $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idLevel_2']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idLevel_3']) && $_SESSION['insumos_egr_nc_basicos']['idLevel_3'] != ''){             $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idLevel_3']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idLevel_4']) && $_SESSION['insumos_egr_nc_basicos']['idLevel_4'] != ''){             $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idLevel_4']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['insumos_egr_nc_basicos']['idLevel_5']) && $_SESSION['insumos_egr_nc_basicos']['idLevel_5'] != ''){             $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idLevel_5']."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_insumos_facturacion` (idDocumentos,N_Doc, Observaciones, 
				idBodegaDestino, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, 
				Creacion_ano, idCliente, fecha_auto, ValorNeto, ValorNetoImp,ValorTotal, Impuesto_01, 
				Impuesto_02, Impuesto_03, Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, 
				Impuesto_09, Impuesto_10, idEstado, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, 
				idLevel_4, idLevel_5) 
				VALUES ({$a} )";
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
					//Se guardan los datos de los productos	
					if(isset($_SESSION['insumos_egr_nc_productos'])){		
						foreach ($_SESSION['insumos_egr_nc_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idBodega']) && $_SESSION['insumos_egr_nc_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idSistema']) && $_SESSION['insumos_egr_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idUsuario']) && $_SESSION['insumos_egr_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idDocumentos']) && $_SESSION['insumos_egr_nc_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['N_Doc']) && $_SESSION['insumos_egr_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idTipo']) && $_SESSION['insumos_egr_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                              $a .= ",'".$producto['idProducto']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['Cantidad_ing']) && $producto['Cantidad_ing'] != ''){                                                          $a .= ",'".$producto['Cantidad_ing']."'" ;                            }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                          $a .= ",'".$producto['ValorIngreso']."'" ;                            }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                              $a .= ",'".$producto['ValorTotal']."'" ;                              }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idCliente']) && $_SESSION['insumos_egr_nc_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idCliente']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['fecha_auto']) && $_SESSION['insumos_egr_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, 
							idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing, Valor,ValorTotal, idCliente, fecha_auto) 
							VALUES ({$a} )";
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
					//Otros Motivos
					if(isset($_SESSION['insumos_egr_nc_otros'])){
						foreach ($_SESSION['insumos_egr_nc_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idBodega']) && $_SESSION['insumos_egr_nd_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idSistema']) && $_SESSION['insumos_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['idUsuario']) && $_SESSION['insumos_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_otros` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, vTotal) 
							VALUES ({$a} )";
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
					if(isset($_SESSION['insumos_egr_nc_archivos'])){
						foreach ($_SESSION['insumos_egr_nc_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                        $a  = "'".$ultimo_id."'" ;                                            }else{$a  = "''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idBodega']) && $_SESSION['insumos_egr_nc_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idSistema']) && $_SESSION['insumos_egr_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['idUsuario']) && $_SESSION['insumos_egr_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['insumos_egr_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_insumos_facturacion_archivos` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre) 
							VALUES ({$a} )";
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
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['insumos_egr_nc_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['insumos_egr_nc_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
					VALUES ({$a} )";
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['insumos_egr_nc_basicos']);
					unset($_SESSION['insumos_egr_nc_productos']);
					unset($_SESSION['insumos_egr_nc_temporal']);
					unset($_SESSION['insumos_egr_nc_impuestos']);
					unset($_SESSION['insumos_egr_nc_archivos']);
					unset($_SESSION['insumos_egr_nc_otros']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;
/*******************************************************************************************************************/
	}
?>
