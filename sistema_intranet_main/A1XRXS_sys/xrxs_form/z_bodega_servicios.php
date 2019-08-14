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
	if ( !empty($_POST['idProveedor']) )       $idProveedor         = $_POST['idProveedor'];
	if ( !empty($_POST['idDocumentos']) )      $idDocumentos        = $_POST['idDocumentos'];
	if ( !empty($_POST['N_Doc']) )             $N_Doc               = $_POST['N_Doc'];
	if ( !empty($_POST['Creacion_fecha']) )    $Creacion_fecha      = $_POST['Creacion_fecha'];
	if ( !empty($_POST['Observaciones']) )     $Observaciones       = $_POST['Observaciones'];
	if ( !empty($_POST['idSistema']) )         $idSistema           = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )         $idUsuario           = $_POST['idUsuario'];
	if ( !empty($_POST['idTipo']) )            $idTipo              = $_POST['idTipo'];
	if ( !empty($_POST['idServicio']) )        $idServicio          = $_POST['idServicio'];
	if ( !empty($_POST['ValorTotal']) )        $ValorTotal          = $_POST['ValorTotal'];
	if ( !empty($_POST['oldItemID']) )         $oldItemID           = $_POST['oldItemID'];
	if ( !empty($_POST['idImpuesto']) )        $idImpuesto          = $_POST['idImpuesto'];
	if ( !empty($_POST['idDocPago']) )         $idDocPago           = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )         $N_DocPago           = $_POST['N_DocPago'];
	if ( !empty($_POST['F_Pago']) )            $F_Pago              = $_POST['F_Pago'];
	if ( !empty($_POST['MontoPagado']) )       $MontoPagado         = $_POST['MontoPagado'];
	if ( !empty($_POST['montoPactado']) )      $montoPactado        = $_POST['montoPactado'];
	if ( !empty($_POST['idFacturacion']) )     $idFacturacion       = $_POST['idFacturacion'];
	if ( !empty($_POST['idCliente']) )         $idCliente           = $_POST['idCliente'];
	if ( !empty($_POST['idTrabajador']) )      $idTrabajador        = $_POST['idTrabajador'];
	if ( !empty($_POST['fecha_auto']) )        $fecha_auto          = $_POST['fecha_auto'];
	if ( !empty($_POST['Nombre']) )            $Nombre              = $_POST['Nombre'];
	if ( !empty($_POST['vTotal']) )            $vTotal              = $_POST['vTotal'];
	if ( !empty($_POST['oldidProducto']) )     $oldidProducto       = $_POST['oldidProducto'];
	if ( !empty($_POST['idOcompra']) )         $idOcompra           = $_POST['idOcompra'];
	if ( !empty($_POST['Cantidad_ing']) )      $Cantidad_ing        = $_POST['Cantidad_ing'];
	if ( !empty($_POST['Cantidad_eg']) )       $Cantidad_eg         = $_POST['Cantidad_eg'];
	if ( !empty($_POST['idFrecuencia']) )      $idFrecuencia        = $_POST['idFrecuencia'];
	if ( !empty($_POST['vUnitario']) )         $vUnitario           = $_POST['vUnitario'];
	if ( !empty($_POST['OC_Ventas']) )         $OC_Ventas           = $_POST['OC_Ventas'];
	if ( !empty($_POST['idGuia']) )            $idGuia              = $_POST['idGuia'];
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
			case 'idProveedor':      if(empty($idProveedor)){      $error['idProveedor']     = 'error/No ha ingresado el id';}break;
			case 'idDocumentos':     if(empty($idDocumentos)){     $error['idDocumentos']    = 'error/No ha seleccionado el tipo de documento';}break;
			case 'N_Doc':            if(empty($N_Doc)){            $error['N_Doc']           = 'error/No ha ingresado el numero de documento';}break;
			case 'Creacion_fecha':   if(empty($Creacion_fecha)){   $error['Creacion_fecha']  = 'error/No ha ingresado la fecha del documento';}break;
			case 'Observaciones':    if(empty($Observaciones)){    $error['Observaciones']   = 'error/No ha ingresado la observacion';}break;
			case 'idSistema':        if(empty($idSistema)){        $error['idSistema']       = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':        if(empty($idUsuario)){        $error['idUsuario']       = 'error/No ha seleccionado el usuario';}break;
			case 'idTipo':           if(empty($idTipo)){           $error['idTipo']          = 'error/No ha seleccionado el tipo';}break;
			case 'idServicio':       if(empty($idServicio)){       $error['idServicio']      = 'error/No ha seleccionado el servicio';}break;
			case 'ValorTotal':       if(empty($ValorTotal)){       $error['ValorTotal']      = 'error/No ha ingresado el valor total';}break;
			case 'oldItemID':        if(empty($oldItemID)){        $error['oldItemID']       = 'error/No ha seleccionado el item antiguo';}break;
			case 'idImpuesto':       if(empty($idImpuesto)){       $error['idImpuesto']      = 'error/No ha seleccionado el impuesto';}break;
			case 'idDocPago':        if(empty($idDocPago)){        $error['idDocPago']       = 'error/No ha seleccionado el documento de pago';}break;
			case 'N_DocPago':        if(empty($N_DocPago)){        $error['N_DocPago']       = 'error/No ha ingresado el numero del documento de pago';}break;
			case 'F_Pago':           if(empty($F_Pago)){           $error['F_Pago']          = 'error/No ha ingresado la fecha de pago';}break;
			case 'MontoPagado':      if(empty($MontoPagado)){      $error['MontoPagado']     = 'error/No ha ingresado el monto pagado';}break;
			case 'montoPactado':     if(empty($montoPactado)){     $error['montoPactado']    = 'error/No ha ingresado el monto pactado';}break;
			case 'idFacturacion':    if(empty($idFacturacion)){    $error['idFacturacion']   = 'error/No ha seleccionado la facturacion';}break;
			case 'idCliente':        if(empty($idCliente)){        $error['idCliente']       = 'error/No ha seleccionado el cliente';}break;
			case 'idTrabajador':     if(empty($idTrabajador)){     $error['idTrabajador']    = 'error/No ha seleccionado el trabajador';}break;
			case 'fecha_auto':       if(empty($fecha_auto)){       $error['fecha_auto']      = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Nombre':           if(empty($Nombre)){           $error['Nombre']          = 'error/No ha ingresado el nombre';}break;
			case 'vTotal':           if(empty($vTotal)){           $error['vTotal']          = 'error/No ha ingresado el valor total';}break;
			case 'oldidProducto':    if(empty($oldidProducto)){    $error['oldidProducto']   = 'error/No ha ingresado el id antiguo';}break;
			case 'idOcompra':        if(empty($idOcompra)){        $error['idOcompra']       = 'error/No ha ingresado la OC';}break;
			case 'Cantidad_ing':     if(empty($Cantidad_ing)){     $error['Cantidad_ing']    = 'error/No ha ingresado la cantidad';}break;
			case 'Cantidad_eg':      if(empty($Cantidad_eg)){      $error['Cantidad_eg']     = 'error/No ha ingresado la cantidad';}break;
			case 'idFrecuencia':     if(empty($idFrecuencia)){     $error['idFrecuencia']    = 'error/No ha ingresado la fecuencia';}break;
			case 'vUnitario':        if(empty($vUnitario)){        $error['vUnitario']       = 'error/No ha ingresado el valor unitario';}break;
			case 'OC_Ventas':        if(empty($OC_Ventas)){        $error['OC_Ventas']       = 'error/No ha ingresado la OC Relacionada';}break;
			case 'idGuia':           if(empty($idGuia)){           $error['idGuia']          = 'error/No ha seleccionado la guia relacionada';}break;
			
			case 'idCentroCosto':    if(empty($idCentroCosto)){    $error['idCentroCosto']   = 'error/No ha seleccionado el Centro de Costo';}break;
			case 'idLevel_1':        if(empty($idLevel_1)){        $error['idLevel_1']       = 'error/No ha seleccionado el Nivel 1';}break;
			case 'idLevel_2':        if(empty($idLevel_2)){        $error['idLevel_2']       = 'error/No ha seleccionado el Nivel 2';}break;
			case 'idLevel_3':        if(empty($idLevel_3)){        $error['idLevel_3']       = 'error/No ha seleccionado el Nivel 3';}break;
			case 'idLevel_4':        if(empty($idLevel_4)){        $error['idLevel_4']       = 'error/No ha seleccionado el Nivel 4';}break;
			case 'idLevel_5':        if(empty($idLevel_5)){        $error['idLevel_5']       = 'error/No ha seleccionado el Nivel 5';}break;
			
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_ing_basicos']);
				unset($_SESSION['servicios_ing_productos']);
				unset($_SESSION['servicios_ing_temporal']);
				unset($_SESSION['servicios_ing_impuestos']);
				unset($_SESSION['servicios_ing_descuentos']);
				unset($_SESSION['servicios_ing_guias']);
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['servicios_ing_archivos'])){
					foreach ($_SESSION['servicios_ing_archivos'] as $key => $producto){
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
				unset($_SESSION['servicios_ing_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['servicios_ing_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['servicios_ing_basicos']['idDocumentos']    = $idDocumentos;
				$_SESSION['servicios_ing_basicos']['N_Doc']           = $N_Doc;
				$_SESSION['servicios_ing_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['servicios_ing_basicos']['Observaciones']   = $Observaciones;
				$_SESSION['servicios_ing_basicos']['idSistema']       = $idSistema;
				$_SESSION['servicios_ing_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['servicios_ing_basicos']['idTipo']          = $idTipo;
				$_SESSION['servicios_ing_basicos']['Pago_fecha']      = '0000-00-00';
				$_SESSION['servicios_ing_basicos']['fecha_auto']      = $fecha_auto;
				$_SESSION['servicios_ing_basicos']['idOcompra']       = '';
				
				//Se agrega el impuesto
				$_SESSION['servicios_ing_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_ing_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_ing_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_basicos']['TipoDocumento'] = '';
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
					$_SESSION['servicios_ing_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['servicios_ing_basicos']['Proveedor'] = '';
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
				$_SESSION['servicios_ing_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_ing_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['servicios_ing_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['servicios_ing_basicos']['idCentroCosto'] = 0;
				$_SESSION['servicios_ing_basicos']['idLevel_1']     = 0;
				$_SESSION['servicios_ing_basicos']['idLevel_2']     = 0;
				$_SESSION['servicios_ing_basicos']['idLevel_3']     = 0;
				$_SESSION['servicios_ing_basicos']['idLevel_4']     = 0;
				$_SESSION['servicios_ing_basicos']['idLevel_5']     = 0;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_basicos']);
			unset($_SESSION['servicios_ing_productos']);
			unset($_SESSION['servicios_ing_temporal']);
			unset($_SESSION['servicios_ing_impuestos']);
			unset($_SESSION['servicios_ing_descuentos']);
			unset($_SESSION['servicios_ing_guias']);
			
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['servicios_ing_archivos'])){
				foreach ($_SESSION['servicios_ing_archivos'] as $key => $producto){
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
			unset($_SESSION['servicios_ing_archivos']);

			
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_ing_temporal']);
				//se borran datos por seguridad
				unset($_SESSION['servicios_ing_productos']);
				unset($_SESSION['servicios_ing_temporal']);
				unset($_SESSION['servicios_ing_impuestos']);
				unset($_SESSION['servicios_ing_descuentos']);
				unset($_SESSION['servicios_ing_guias']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['servicios_ing_basicos']['idDocumentos']    = $idDocumentos;
				$_SESSION['servicios_ing_basicos']['N_Doc']           = $N_Doc;
				$_SESSION['servicios_ing_basicos']['idSistema']       = $idSistema;
				$_SESSION['servicios_ing_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['servicios_ing_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['servicios_ing_basicos']['idTipo']          = $idTipo;
				$_SESSION['servicios_ing_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['servicios_ing_basicos']['fecha_auto']      = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['servicios_ing_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_ing_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_ing_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_basicos']['TipoDocumento'] = '';
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
					$_SESSION['servicios_ing_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['servicios_ing_basicos']['Proveedor'] = '';
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
				$_SESSION['servicios_ing_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_ing_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
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
				$_SESSION['servicios_ing_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
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
					$_SESSION['servicios_ing_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['servicios_ing_basicos']['idCentroCosto'] = $idCentroCosto;
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
					$_SESSION['servicios_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_basicos']['idLevel_1']    = $idLevel_1;
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
					$_SESSION['servicios_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_basicos']['idLevel_2']    = $idLevel_2;
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
					$_SESSION['servicios_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_basicos']['idLevel_3']    = $idLevel_3;
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
					$_SESSION['servicios_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_basicos']['idLevel_4']    = $idLevel_4;
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
					$_SESSION['servicios_ing_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_basicos']['idLevel_5']    = $idLevel_5;
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
			if($_SESSION['servicios_ing_basicos']['Creacion_fecha']>$valor){
				$error['ndata_1'] = 'error/La fecha de vencimiento es anterior a la fecha de creacion';
			}
			
			//valido que no esten vacios
			if(empty($valor)){  $error['valor']  = 'error/No ha ingresado una fecha de vencimiento';}

			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_basicos']['Pago_fecha'] = $valor;
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;		
/*******************************************************************************************************************/		
		case 'delfpago':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_basicos']['Pago_fecha'] = '0000-00-00';
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'new_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el producto ya existe
			if(isset($_SESSION['servicios_ing_productos'][$idServicio])&&$_SESSION['servicios_ing_productos'][$idServicio]>0){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				$_SESSION['servicios_ing_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_ing_productos'][$idServicio]['Cantidad_ing']  = $Cantidad_ing;
				$_SESSION['servicios_ing_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_ing_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_ing_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_ing_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_ing_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_productos'][$idServicio])&&$_SESSION['servicios_ing_productos'][$idServicio]>0&&$_SESSION['servicios_ing_productos'][$idServicio]!=$_SESSION['servicios_ing_productos'][$oldItemID]){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}
			//Si la cantidad es determinada por una OC verificar si la modificacion no supera el maximo permitido
			if(isset($_SESSION['servicios_ing_basicos']['idOcompra'])&&$_SESSION['servicios_ing_basicos']['idOcompra']!=''){
				if($_SESSION['servicios_ing_productos'][$oldItemID]['cant_max']<($Cantidad_ing + $_SESSION['servicios_ing_productos'][$oldItemID]['cant_ingresada'])){
					$error['productos'] = 'error/No puede ingresar una cantidad superior a la solicitada en la OC (Maximo '.Cantidades_decimales_justos($_SESSION['servicios_ing_productos'][$oldItemID]['cant_max']-$_SESSION['servicios_ing_productos'][$oldItemID]['cant_ingresada']).')';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				//Guardo variables si existe una OC
				$temp_idExistencia     = 0;
				$temp_idFrecuencia     = 0;
				$temp_cant_ingresada   = 0;
				$temp_cant_max         = 0;
				
				if(isset($_SESSION['servicios_ing_basicos']['idOcompra'])&&$_SESSION['servicios_ing_basicos']['idOcompra']!=''){
					$temp_idExistencia     = $_SESSION['servicios_ing_productos'][$oldItemID]['idExistencia'];
					$temp_idFrecuencia     = $_SESSION['servicios_ing_productos'][$oldItemID]['idFrecuencia'];
					$temp_cant_ingresada   = $_SESSION['servicios_ing_productos'][$oldItemID]['cant_ingresada'];
					$temp_cant_max         = $_SESSION['servicios_ing_productos'][$oldItemID]['cant_max'];
				}
				
				//Borro el producto
				unset($_SESSION['servicios_ing_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['servicios_ing_productos'][$idServicio]['idServicio']       = $idServicio;
				$_SESSION['servicios_ing_productos'][$idServicio]['Cantidad_ing']     = $Cantidad_ing;
				$_SESSION['servicios_ing_productos'][$idServicio]['ValorIngreso']     = $vUnitario;
				$_SESSION['servicios_ing_productos'][$idServicio]['ValorTotal']       = $ValorTotal;
				$_SESSION['servicios_ing_productos'][$idServicio]['idFrecuencia']     = $idFrecuencia;
				$_SESSION['servicios_ing_productos'][$idServicio]['idExistencia']     = $temp_idExistencia;
				$_SESSION['servicios_ing_productos'][$idServicio]['idFrecuencia']     = $temp_idFrecuencia;
				$_SESSION['servicios_ing_productos'][$idServicio]['cant_ingresada']   = $temp_cant_ingresada;
				$_SESSION['servicios_ing_productos'][$idServicio]['cant_max']         = $temp_cant_max;
				$_SESSION['servicios_ing_productos'][$idServicio]['Servicio']         = $rowServicio['Nombre'];
				$_SESSION['servicios_ing_productos'][$idServicio]['Frecuencia']       = $rowFrecuencia['Nombre'];
					
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro el producto
			unset($_SESSION['servicios_ing_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_guia':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_guias'][$idGuia])&&$_SESSION['servicios_ing_guias'][$idGuia]>0){
				$error['productos'] = 'error/La guia que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la guia seleccionada
				$query = "SELECT N_Doc, ValorNeto
				FROM `bodegas_servicios_facturacion`
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
				
				$_SESSION['servicios_ing_guias'][$idGuia]['idGuia']     = $idGuia;
				$_SESSION['servicios_ing_guias'][$idGuia]['N_Doc']      = $rowGuia['N_Doc'];
				$_SESSION['servicios_ing_guias'][$idGuia]['ValorNeto']  = $rowGuia['ValorNeto'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_guia':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_guias'][$_GET['del_guia']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_impuesto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_impuestos'][$idImpuesto])&&$_SESSION['servicios_ing_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_impuestos'][$_GET['del_impuesto']]);
			
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
				$_SESSION['servicios_ing_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['servicios_ing_temporal'] = $_SESSION['servicios_ing_basicos']['Observaciones'];
			$_SESSION['servicios_ing_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['servicios_ing_archivos'])){
				foreach ($_SESSION['servicios_ing_archivos'] as $key => $trabajos){
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
						$sufijo = 'servicios_ingreso_'.fecha_actual().'_';
					  
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
									$_SESSION['servicios_ing_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['servicios_ing_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['servicios_ing_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['servicios_ing_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['servicios_ing_archivos'][$_GET['del_file']]);
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
			if(!isset($_SESSION['servicios_ing_descuentos'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['servicios_ing_descuentos'] as $key => $producto){
					$bvar++;
				}	
			}
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_descuentos'][$bvar]['idDescuento'] = $bvar;
				$_SESSION['servicios_ing_descuentos'][$bvar]['Nombre'] = $Nombre;
				$_SESSION['servicios_ing_descuentos'][$bvar]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_desc_ing':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se crea el nuevo producto
				$_SESSION['servicios_ing_descuentos'][$oldidProducto]['idDescuento'] = $oldidProducto;
				$_SESSION['servicios_ing_descuentos'][$oldidProducto]['Nombre'] = $Nombre;
				$_SESSION['servicios_ing_descuentos'][$oldidProducto]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_desc_ing':

			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_descuentos'][$_GET['del_descuento']]);
			
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
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_servicios', '', "idOcompra='".$idOcompra."' AND Cantidad > cant_ingresada", $dbConn);
				if($ndata_2==0) {$error['ndata_2'] = 'error/No existen Servicios a asignar';}
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se borran los productos
				unset($_SESSION['servicios_ing_productos']);
				
				//Se traen los productos utilizados
				$arrProductos = array();
				$query = "SELECT idExistencia, idServicio, Cantidad, vUnitario, vTotal, idFrecuencia, cant_ingresada 
				FROM ocompra_listado_existencias_servicios 
				WHERE idOcompra='".$idOcompra."' AND Cantidad > cant_ingresada ";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				
				//Guardo la OC
				$_SESSION['servicios_ing_basicos']['idOcompra'] = $idOcompra;
				
				//Se guardan los datos
				foreach ($arrProductos as $prod) {
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['idExistencia']    = $prod['idExistencia'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['idServicio']      = $prod['idServicio'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['Cantidad_ing']    = $prod['Cantidad'] - $prod['cant_ingresada'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['ValorIngreso']    = $prod['vUnitario'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['ValorTotal']      = $prod['vTotal'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['idFrecuencia']    = $prod['idFrecuencia'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['cant_ingresada']  = $prod['cant_ingresada'];
					$_SESSION['servicios_ing_productos'][$prod['idServicio']]['cant_max']        = $prod['Cantidad'];
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
			if (isset($_SESSION['servicios_ing_basicos'])){
				if(!isset($_SESSION['servicios_ing_basicos']['idDocumentos']) or $_SESSION['servicios_ing_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['servicios_ing_basicos']['N_Doc']) or $_SESSION['servicios_ing_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha seleccionado el area';}
				if(!isset($_SESSION['servicios_ing_basicos']['Observaciones']) or $_SESSION['servicios_ing_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha seleccionado la maquina';}
				if(!isset($_SESSION['servicios_ing_basicos']['idSistema']) or $_SESSION['servicios_ing_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['servicios_ing_basicos']['idUsuario']) or $_SESSION['servicios_ing_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['servicios_ing_basicos']['Creacion_fecha']) or $_SESSION['servicios_ing_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['servicios_ing_basicos']['idTipo']) or $_SESSION['servicios_ing_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['servicios_ing_basicos']['idDocumentos']) && $_SESSION['servicios_ing_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['servicios_ing_basicos']['Pago_fecha']) or $_SESSION['servicios_ing_basicos']['Pago_fecha']=='' or $_SESSION['servicios_ing_basicos']['Pago_fecha']=='0000-00-00' ){     
						$error['Pago_fecha']  = 'error/No ha ingresado la fecha de vencimiento de la factura';
					}
					if(!isset($_SESSION['servicios_ing_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}	
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['servicios_ing_productos'])&&!isset($_SESSION['servicios_ing_guias'])){
				$error['idProducto']   = 'error/No se han asignado Servicios ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['servicios_ing_productos'])){
				foreach ($_SESSION['servicios_ing_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['servicios_ing_guias'])){
				foreach ($_SESSION['servicios_ing_guias'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado Servicios ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['servicios_ing_basicos']['idSistema']) && $_SESSION['servicios_ing_basicos']['idSistema'] != ''){            $a  = "'".$_SESSION['servicios_ing_basicos']['idSistema']."'" ;      }else{$a  = "''";}
				if(isset($_SESSION['servicios_ing_basicos']['idUsuario']) && $_SESSION['servicios_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_ing_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['servicios_ing_basicos']['idDocumentos']) && $_SESSION['servicios_ing_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_ing_basicos']['idDocumentos']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['N_Doc']) && $_SESSION['servicios_ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_ing_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idTipo']) && $_SESSION['servicios_ing_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_ing_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['Observaciones']) && $_SESSION['servicios_ing_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['servicios_ing_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idProveedor']) && $_SESSION['servicios_ing_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['servicios_ing_basicos']['idProveedor']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['Pago_fecha']) && $_SESSION['servicios_ing_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_ing_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['servicios_ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['servicios_ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_ing_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['servicios_ing_basicos']['fecha_auto']) && $_SESSION['servicios_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_ing_basicos']['fecha_auto']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['valor_neto_fact'])&&$_SESSION['servicios_ing_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['servicios_ing_basicos']['valor_neto_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['valor_neto_imp'])&&$_SESSION['servicios_ing_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['servicios_ing_basicos']['valor_neto_imp']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['valor_total_fact'])&&$_SESSION['servicios_ing_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['servicios_ing_basicos']['valor_total_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][1]['valor'])&&$_SESSION['servicios_ing_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][1]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][2]['valor'])&&$_SESSION['servicios_ing_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][2]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][3]['valor'])&&$_SESSION['servicios_ing_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][3]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][4]['valor'])&&$_SESSION['servicios_ing_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][4]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][5]['valor'])&&$_SESSION['servicios_ing_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][5]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][6]['valor'])&&$_SESSION['servicios_ing_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][6]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][7]['valor'])&&$_SESSION['servicios_ing_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][7]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][8]['valor'])&&$_SESSION['servicios_ing_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][8]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][9]['valor'])&&$_SESSION['servicios_ing_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_impuestos'][9]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_impuestos'][10]['valor'])&&$_SESSION['servicios_ing_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['servicios_ing_impuestos'][10]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idOcompra']) && $_SESSION['servicios_ing_basicos']['idOcompra'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idOcompra']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idCentroCosto']) && $_SESSION['servicios_ing_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['servicios_ing_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idLevel_1']) && $_SESSION['servicios_ing_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idLevel_2']) && $_SESSION['servicios_ing_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idLevel_3']) && $_SESSION['servicios_ing_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idLevel_4']) && $_SESSION['servicios_ing_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_basicos']['idLevel_5']) && $_SESSION['servicios_ing_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
					
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_servicios_facturacion` (idSistema, idUsuario, Creacion_fecha, Creacion_Semana, Creacion_mes,
				Creacion_ano, idDocumentos, N_Doc, idTipo,Observaciones, idProveedor, Pago_fecha,Pago_dia, Pago_Semana, Pago_mes, 
				Pago_ano, idEstado, fecha_auto, ValorNeto, ValorNetoImp, ValorTotal, Impuesto_01, Impuesto_02, Impuesto_03, 
				Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, Impuesto_09, Impuesto_10, idOcompra, 
				idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, idLevel_5	) 
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
					if(isset($_SESSION['servicios_ing_productos'])){		
						foreach ($_SESSION['servicios_ing_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_basicos']['idSistema']) && $_SESSION['servicios_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['idUsuario']) && $_SESSION['servicios_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['servicios_ing_basicos']['idDocumentos']) && $_SESSION['servicios_ing_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_ing_basicos']['idDocumentos']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['N_Doc']) && $_SESSION['servicios_ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_ing_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['idTipo']) && $_SESSION['servicios_ing_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_ing_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){                                                            $a .= ",'".$producto['idServicio']."'" ;                                  }else{$a .= ",''";}
							if(isset($producto['Cantidad_ing']) && $producto['Cantidad_ing'] != ''){                                                        $a .= ",'".$producto['Cantidad_ing']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){                                                        $a .= ",'".$producto['idFrecuencia']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                        $a .= ",'".$producto['ValorIngreso']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                            $a .= ",'".$producto['ValorTotal']."'" ;                                  }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['idProveedor']) && $_SESSION['servicios_ing_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['servicios_ing_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['fecha_auto']) && $_SESSION['servicios_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_ing_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
						
						
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_existencias` (idFacturacion, idSistema, idUsuario,
							Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idServicio, Cantidad_ing, idFrecuencia, Valor,ValorTotal,
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
							
							/*******************************************************************/
							//Actualizo el valor de los productos
							$a = "idServicio='".$producto['idServicio']."'" ;
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''&&isset($_SESSION['servicios_ing_basicos']['idProveedor']) && $_SESSION['servicios_ing_basicos']['idProveedor'] != ''){     
								$a .= ",idProveedor='".$_SESSION['servicios_ing_basicos']['idProveedor']."'" ;
								$a .= ",ValorIngreso='".$producto['ValorIngreso']."'" ;
							}
							
							// inserto los datos de registro en la db
							$query  = "UPDATE `servicios_listado` SET ".$a." WHERE idServicio = '{$producto['idServicio']}'";
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
							if(isset($_SESSION['servicios_ing_basicos']['idOcompra'])&&$_SESSION['servicios_ing_basicos']['idOcompra']){
								$nueva_cant = $producto['cant_ingresada'] + $producto['Cantidad_ing'];
								$a = "idExistencia='".$producto['idExistencia']."'" ;
								$a .= ",cant_ingresada='".$nueva_cant."'" ;
								
								// inserto los datos de registro en la db
								$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idExistencia = '{$producto['idExistencia']}'";
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
					//Se actualizan las guias a un estado de pago y con relacion al documento recien generado
					if (isset($_SESSION['servicios_ing_guias'])){
						foreach ($_SESSION['servicios_ing_guias'] as $key => $guias){
							//filtro
							if(isset($ultimo_id) && $ultimo_id != ''){ 
								
								$a  = "DocRel='".$ultimo_id."'" ;    
								$a .= ",idEstado='2'";

								$query  = "UPDATE `bodegas_servicios_facturacion` SET ".$a." WHERE idFacturacion = '{$guias['idGuia']}'";
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
					if(isset($_SESSION['servicios_ing_descuentos'])){
						foreach ($_SESSION['servicios_ing_descuentos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_basicos']['idSistema']) && $_SESSION['servicios_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['idUsuario']) && $_SESSION['servicios_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_descuentos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_ing_archivos'])){
						foreach ($_SESSION['servicios_ing_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_basicos']['idSistema']) && $_SESSION['servicios_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['idUsuario']) && $_SESSION['servicios_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_ing_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['servicios_ing_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['servicios_ing_basicos']);
					unset($_SESSION['servicios_ing_productos']);
					unset($_SESSION['servicios_ing_temporal']);
					unset($_SESSION['servicios_ing_impuestos']);
					unset($_SESSION['servicios_ing_archivos']);
					unset($_SESSION['servicios_ing_descuentos']);
					unset($_SESSION['servicios_ing_guias']);
					
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
		case 'new_egreso':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
		
			//Se verifica si el dato existe
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($idDocumentos)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_egr_basicos']);
				unset($_SESSION['servicios_egr_productos']);
				unset($_SESSION['servicios_egr_temporal']);
				unset($_SESSION['servicios_egr_guias']);
				unset($_SESSION['servicios_egr_impuestos']);
				unset($_SESSION['servicios_egr_descuentos']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['servicios_egr_archivos'])){
					foreach ($_SESSION['servicios_egr_archivos'] as $key => $producto){
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
				unset($_SESSION['servicios_egr_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['servicios_egr_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['servicios_egr_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['servicios_egr_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['servicios_egr_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['servicios_egr_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['servicios_egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['servicios_egr_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['servicios_egr_basicos']['idCliente'] = $idCliente;}
				if(isset($idTrabajador) && $idTrabajador != ''){           $_SESSION['servicios_egr_basicos']['idTrabajador'] = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['servicios_egr_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($OC_Ventas) && $OC_Ventas != ''){                 $_SESSION['servicios_egr_basicos']['OC_Ventas'] = $OC_Ventas;}
				
				//Fecha de vencimiento
				$_SESSION['servicios_egr_basicos']['Pago_fecha']      = '0000-00-00';
				
				//Se agrega el impuesto
				$_SESSION['servicios_egr_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_egr_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_egr_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
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
					$_SESSION['servicios_egr_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['servicios_egr_basicos']['Cliente'] = '';
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
					$rowVendedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['servicios_egr_basicos']['Vendedor'] = $rowVendedor['Nombre'].' '.$rowVendedor['ApellidoPat'].' '.$rowVendedor['ApellidoMat'];
				}else{
					$_SESSION['servicios_egr_basicos']['Vendedor'] = '';
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
				$_SESSION['servicios_egr_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_egr_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['servicios_egr_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['servicios_egr_basicos']['idCentroCosto'] = 0;
				$_SESSION['servicios_egr_basicos']['idLevel_1']     = 0;
				$_SESSION['servicios_egr_basicos']['idLevel_2']     = 0;
				$_SESSION['servicios_egr_basicos']['idLevel_3']     = 0;
				$_SESSION['servicios_egr_basicos']['idLevel_4']     = 0;
				$_SESSION['servicios_egr_basicos']['idLevel_5']     = 0;
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_basicos']);
			unset($_SESSION['servicios_egr_productos']);
			unset($_SESSION['servicios_egr_temporal']);
			unset($_SESSION['servicios_egr_guias']);
			unset($_SESSION['servicios_egr_impuestos']);
			unset($_SESSION['servicios_egr_descuentos']);
			
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['servicios_egr_archivos'])){
				foreach ($_SESSION['servicios_egr_archivos'] as $key => $producto){
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
			unset($_SESSION['servicios_egr_archivos']);
			
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
				unset($_SESSION['servicios_egr_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['servicios_egr_productos']);
				unset($_SESSION['servicios_egr_guias']);
				unset($_SESSION['servicios_egr_impuestos']);
				unset($_SESSION['servicios_egr_descuentos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['servicios_egr_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['servicios_egr_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['servicios_egr_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['servicios_egr_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['servicios_egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['servicios_egr_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['servicios_egr_basicos']['idCliente'] = $idCliente;}
				if(isset($idTrabajador) && $idTrabajador != ''){           $_SESSION['servicios_egr_basicos']['idTrabajador'] = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['servicios_egr_basicos']['fecha_auto'] = $fecha_auto;}
				if(isset($OC_Ventas) && $OC_Ventas != ''){                 $_SESSION['servicios_egr_basicos']['OC_Ventas'] = $OC_Ventas;}
				
				//Fecha de vencimiento
				$_SESSION['servicios_egr_basicos']['Pago_fecha']      = '0000-00-00';
				
				//Se agrega el impuesto
				$_SESSION['servicios_egr_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_egr_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_egr_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
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
					$_SESSION['servicios_egr_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['servicios_egr_basicos']['Cliente'] = '';
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
					$rowVendedor = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['servicios_egr_basicos']['Vendedor'] = $rowVendedor['Nombre'].' '.$rowVendedor['ApellidoPat'].' '.$rowVendedor['ApellidoMat'];
				}else{
					$_SESSION['servicios_egr_basicos']['Vendedor'] = '';
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
				$_SESSION['servicios_egr_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_egr_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
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
				$_SESSION['servicios_egr_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
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
					$_SESSION['servicios_egr_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['servicios_egr_basicos']['idCentroCosto'] = $idCentroCosto;
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
					$_SESSION['servicios_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_basicos']['idLevel_1']    = $idLevel_1;
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
					$_SESSION['servicios_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_basicos']['idLevel_2']    = $idLevel_2;
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
					$_SESSION['servicios_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_basicos']['idLevel_3']    = $idLevel_3;
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
					$_SESSION['servicios_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_basicos']['idLevel_4']    = $idLevel_4;
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
					$_SESSION['servicios_egr_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_basicos']['idLevel_5']    = $idLevel_5;
				}
				
				
				//Se redirije
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
		break;	
/*******************************************************************************************************************/		
		case 'new_guia_venta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_guias'][$idGuia])&&$_SESSION['servicios_egr_guias'][$idGuia]>0){
				$error['productos'] = 'error/La guia que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la guia seleccionada
				$query = "SELECT N_Doc, ValorNeto
				FROM `bodegas_servicios_facturacion`
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
				
				$_SESSION['servicios_egr_guias'][$idGuia]['idGuia']     = $idGuia;
				$_SESSION['servicios_egr_guias'][$idGuia]['N_Doc']      = $rowGuia['N_Doc'];
				$_SESSION['servicios_egr_guias'][$idGuia]['ValorNeto']  = $rowGuia['ValorNeto'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_guia_venta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_guias'][$_GET['del_guia']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_venta':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_impuestos'][$idImpuesto])&&$_SESSION['servicios_egr_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_venta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'addfpagoVenta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$valor    = $_GET['val_select'];
			
			//Se comprueba las fechas
			if($_SESSION['servicios_egr_basicos']['Creacion_fecha']>$valor){
				$error['ndata_1'] = 'error/La fecha de vencimiento es anterior a la fecha de creacion';
			}
			
			//valido que no esten vacios
			if(empty($valor)){  $error['valor']  = 'error/No ha ingresado una fecha de vencimiento';}

			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_basicos']['Pago_fecha'] = $valor;
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;		
/*******************************************************************************************************************/		
		case 'delfpagoVenta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_basicos']['Pago_fecha'] = '0000-00-00';
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'new_prod_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_productos'][$idServicio])&&$_SESSION['servicios_egr_productos'][$idServicio]>0){
				$error['productos'] = 'error/El Servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				$_SESSION['servicios_egr_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_egr_productos'][$idServicio]['Cantidad_eg']   = $Cantidad_eg;
				$_SESSION['servicios_egr_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_egr_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_egr_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_egr_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_egr_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_productos'][$idServicio])&&$_SESSION['servicios_egr_productos'][$idServicio]>0&&$_SESSION['servicios_egr_productos'][$idServicio]!=$_SESSION['servicios_egr_productos'][$oldItemID]){
				$error['productos'] = 'error/El Servicio que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['servicios_egr_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['servicios_egr_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_egr_productos'][$idServicio]['Cantidad_eg']   = $Cantidad_eg;
				$_SESSION['servicios_egr_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_egr_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_egr_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_egr_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_egr_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_productos'][$_GET['del_prod']]);
			
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
				$_SESSION['servicios_egr_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['servicios_egr_temporal'] = $_SESSION['servicios_egr_basicos']['Observaciones'];
			$_SESSION['servicios_egr_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['servicios_egr_archivos'])){
				foreach ($_SESSION['servicios_egr_archivos'] as $key => $trabajos){
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
						$sufijo = 'servicios_egreso_'.fecha_actual().'_';
					  
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
									$_SESSION['servicios_egr_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['servicios_egr_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['servicios_egr_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['servicios_egr_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['servicios_egr_archivos'][$_GET['del_file']]);
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
			if(!isset($_SESSION['servicios_egr_descuentos'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['servicios_egr_descuentos'] as $key => $producto){
					$bvar++;
				}	
			}
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_descuentos'][$bvar]['idDescuento'] = $bvar;
				$_SESSION['servicios_egr_descuentos'][$bvar]['Nombre'] = $Nombre;
				$_SESSION['servicios_egr_descuentos'][$bvar]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_desc_egr':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se crea el nuevo producto
				$_SESSION['servicios_egr_descuentos'][$oldidProducto]['idDescuento'] = $oldidProducto;
				$_SESSION['servicios_egr_descuentos'][$oldidProducto]['Nombre'] = $Nombre;
				$_SESSION['servicios_egr_descuentos'][$oldidProducto]['vTotal'] = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_desc_egr':

			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_descuentos'][$_GET['del_descuento']]);
			
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
			$n_data2 = 0;
					
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['servicios_egr_basicos'])){
				if(!isset($_SESSION['servicios_egr_basicos']['idDocumentos']) or $_SESSION['servicios_egr_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documentoa';}
				if(!isset($_SESSION['servicios_egr_basicos']['N_Doc']) or $_SESSION['servicios_egr_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['servicios_egr_basicos']['Observaciones']) or $_SESSION['servicios_egr_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['servicios_egr_basicos']['idSistema']) or $_SESSION['servicios_egr_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['servicios_egr_basicos']['idUsuario']) or $_SESSION['servicios_egr_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha sleccionado el usuario';}
				if(!isset($_SESSION['servicios_egr_basicos']['Creacion_fecha']) or $_SESSION['servicios_egr_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado una fecha de creacion';}
				if(!isset($_SESSION['servicios_egr_basicos']['idTipo']) or $_SESSION['servicios_egr_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['servicios_egr_basicos']['idCliente']) or $_SESSION['servicios_egr_basicos']['idCliente']=='' ){           $error['idCliente']        = 'error/No ha seleccionado el cliente';}
				if(!isset($_SESSION['servicios_egr_basicos']['idTrabajador']) or $_SESSION['servicios_egr_basicos']['idTrabajador']=='' ){     $error['idTrabajador']     = 'error/No ha seleccionado el vendedor';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['servicios_egr_basicos']['idDocumentos']) && $_SESSION['servicios_egr_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['servicios_egr_basicos']['Pago_fecha']) or $_SESSION['servicios_egr_basicos']['Pago_fecha']=='' or $_SESSION['servicios_egr_basicos']['Pago_fecha']=='0000-00-00' ){     
						$error['Pago_fecha']  = 'error/No ha ingresado la fecha de vencimiento de la factura';
					}
					if(!isset($_SESSION['servicios_egr_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//productos o guias
			if (!isset($_SESSION['servicios_egr_productos'])&&!isset($_SESSION['servicios_egr_guias'])){
				$error['idProducto']   = 'error/No se han asignado ni servicios ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['servicios_egr_productos'])){
				foreach ($_SESSION['servicios_egr_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['servicios_egr_guias'])){
				foreach ($_SESSION['servicios_egr_guias'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos']   = 'error/No se han asignado ni servicios ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['servicios_egr_basicos']['idDocumentos']) && $_SESSION['servicios_egr_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['servicios_egr_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['servicios_egr_basicos']['N_Doc']) && $_SESSION['servicios_egr_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_egr_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['Observaciones']) && $_SESSION['servicios_egr_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['servicios_egr_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idSistema']) && $_SESSION['servicios_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idUsuario']) && $_SESSION['servicios_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idTipo']) && $_SESSION['servicios_egr_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_egr_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_egr_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['servicios_egr_basicos']['idCliente']) && $_SESSION['servicios_egr_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idCliente']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idTrabajador']) && $_SESSION['servicios_egr_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['servicios_egr_basicos']['idTrabajador']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['fecha_auto']) && $_SESSION['servicios_egr_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_egr_basicos']['fecha_auto']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['valor_neto_fact'])&&$_SESSION['servicios_egr_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['servicios_egr_basicos']['valor_neto_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['valor_neto_imp'])&&$_SESSION['servicios_egr_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['servicios_egr_basicos']['valor_neto_imp']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['valor_total_fact'])&&$_SESSION['servicios_egr_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['servicios_egr_basicos']['valor_total_fact']."'";  }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][1]['valor'])&&$_SESSION['servicios_egr_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][1]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][2]['valor'])&&$_SESSION['servicios_egr_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][2]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][3]['valor'])&&$_SESSION['servicios_egr_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][3]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][4]['valor'])&&$_SESSION['servicios_egr_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][4]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][5]['valor'])&&$_SESSION['servicios_egr_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][5]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][6]['valor'])&&$_SESSION['servicios_egr_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][6]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][7]['valor'])&&$_SESSION['servicios_egr_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][7]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][8]['valor'])&&$_SESSION['servicios_egr_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][8]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][9]['valor'])&&$_SESSION['servicios_egr_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_impuestos'][9]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_impuestos'][10]['valor'])&&$_SESSION['servicios_egr_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['servicios_egr_impuestos'][10]['valor']."'";       }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['Pago_fecha']) && $_SESSION['servicios_egr_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_egr_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['servicios_egr_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['servicios_egr_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_egr_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_egr_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['servicios_egr_basicos']['OC_Ventas']) && $_SESSION['servicios_egr_basicos']['OC_Ventas'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['OC_Ventas']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idCentroCosto']) && $_SESSION['servicios_egr_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['servicios_egr_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idLevel_1']) && $_SESSION['servicios_egr_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idLevel_2']) && $_SESSION['servicios_egr_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idLevel_3']) && $_SESSION['servicios_egr_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idLevel_4']) && $_SESSION['servicios_egr_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_basicos']['idLevel_5']) && $_SESSION['servicios_egr_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_servicios_facturacion` (idDocumentos,N_Doc, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, 
				Creacion_ano, idCliente, idTrabajador, fecha_auto, ValorNeto, ValorNetoImp, ValorTotal, Impuesto_01, Impuesto_02, Impuesto_03, Impuesto_04, Impuesto_05, Impuesto_06, 
				Impuesto_07, Impuesto_08, Impuesto_09, Impuesto_10, Pago_fecha,Pago_dia, Pago_Semana, Pago_mes, Pago_ano, idEstado,OC_Ventas, idCentroCosto, idLevel_1, idLevel_2, 
				idLevel_3, idLevel_4, idLevel_5) 
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
					if(isset($_SESSION['servicios_egr_productos'])){		
						foreach ($_SESSION['servicios_egr_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_basicos']['idSistema']) && $_SESSION['servicios_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['idUsuario']) && $_SESSION['servicios_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['servicios_egr_basicos']['idDocumentos']) && $_SESSION['servicios_egr_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_egr_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['N_Doc']) && $_SESSION['servicios_egr_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_egr_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['idTipo']) && $_SESSION['servicios_egr_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_egr_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){                                                            $a .= ",'".$producto['idServicio']."'" ;                             }else{$a .= ",''";}
							if(isset($producto['Cantidad_eg']) && $producto['Cantidad_eg'] != ''){                                                          $a .= ",'".$producto['Cantidad_eg']."'" ;                            }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){                                                        $a .= ",'".$producto['idFrecuencia']."'" ;                           }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                        $a .= ",'".$producto['ValorIngreso']."'" ;                           }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                            $a .= ",'".$producto['ValorTotal']."'" ;                             }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['idCliente']) && $_SESSION['servicios_egr_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idCliente']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['fecha_auto']) && $_SESSION['servicios_egr_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_egr_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_existencias` (idFacturacion, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, 
							idDocumentos, N_Doc, idTipo, idServicio, Cantidad_eg, idFrecuencia, Valor,ValorTotal, idCliente, fecha_auto) 
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
							$a = "idServicio='".$producto['idServicio']."'" ;
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){     
								$a .= ",ValorEgreso='".$producto['ValorTotal']."'" ;
							}
					
							// inserto los datos de registro en la db
							$query  = "UPDATE `servicios_listado` SET ".$a." WHERE idServicio = '{$producto['idServicio']}'";
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
					if (isset($_SESSION['servicios_egr_guias'])){
						foreach ($_SESSION['servicios_egr_guias'] as $key => $guias){
							//filtro
							if(isset($ultimo_id) && $ultimo_id != ''){ 
								
								$a  = "DocRel='".$ultimo_id."'" ;    
								$a .= ",idEstado='2'";

								$query  = "UPDATE `bodegas_servicios_facturacion` SET ".$a." WHERE idFacturacion = '{$guias['idGuia']}'";
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
					if(isset($_SESSION['servicios_egr_descuentos'])){
						foreach ($_SESSION['servicios_egr_descuentos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_basicos']['idSistema']) && $_SESSION['servicios_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['idUsuario']) && $_SESSION['servicios_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_descuentos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_egr_archivos'])){
						foreach ($_SESSION['servicios_egr_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                      $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_basicos']['idSistema']) && $_SESSION['servicios_egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['idUsuario']) && $_SESSION['servicios_egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($ultimo_id) && $ultimo_id != ''){           $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['servicios_egr_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['servicios_egr_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['servicios_egr_basicos']);
					unset($_SESSION['servicios_egr_productos']);
					unset($_SESSION['servicios_egr_temporal']);
					unset($_SESSION['servicios_egr_guias']);
					unset($_SESSION['servicios_egr_impuestos']);
					unset($_SESSION['servicios_egr_archivos']);
					unset($_SESSION['servicios_egr_descuentos']);
					
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_ing_nd_basicos']);
				unset($_SESSION['servicios_ing_nd_productos']);
				unset($_SESSION['servicios_ing_nd_temporal']);
				unset($_SESSION['servicios_ing_nd_impuestos']);
				unset($_SESSION['servicios_ing_nd_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['servicios_ing_nd_archivos'])){
					foreach ($_SESSION['servicios_ing_nd_archivos'] as $key => $producto){
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
				unset($_SESSION['servicios_ing_nd_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['servicios_ing_nd_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['servicios_ing_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['servicios_ing_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['servicios_ing_nd_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['servicios_ing_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['servicios_ing_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['servicios_ing_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['servicios_ing_nd_basicos']['Pago_fecha']       = '0000-00-00';
				$_SESSION['servicios_ing_nd_basicos']['fecha_auto']       = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['servicios_ing_nd_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_ing_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nd_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_ing_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nd_basicos']['TipoDocumento'] = '';
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
					$_SESSION['servicios_ing_nd_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['servicios_ing_nd_basicos']['Proveedor'] = '';
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
				$_SESSION['servicios_ing_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_ing_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['servicios_ing_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['servicios_ing_nd_basicos']['idCentroCosto'] = 0;
				$_SESSION['servicios_ing_nd_basicos']['idLevel_1']     = 0;
				$_SESSION['servicios_ing_nd_basicos']['idLevel_2']     = 0;
				$_SESSION['servicios_ing_nd_basicos']['idLevel_3']     = 0;
				$_SESSION['servicios_ing_nd_basicos']['idLevel_4']     = 0;
				$_SESSION['servicios_ing_nd_basicos']['idLevel_5']     = 0;
				
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nd_basicos']);
			unset($_SESSION['servicios_ing_nd_productos']);
			unset($_SESSION['servicios_ing_nd_temporal']);
			unset($_SESSION['servicios_ing_nd_impuestos']);
			unset($_SESSION['servicios_ing_nd_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['servicios_ing_nd_archivos'])){
				foreach ($_SESSION['servicios_ing_nd_archivos'] as $key => $producto){
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
			unset($_SESSION['servicios_ing_nd_archivos']);

			
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_ing_nd_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['servicios_ing_nd_productos']);
				unset($_SESSION['servicios_ing_nd_guias']);
				unset($_SESSION['servicios_ing_nd_impuestos']);
				unset($_SESSION['servicios_ing_nd_otros']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['servicios_ing_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['servicios_ing_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['servicios_ing_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['servicios_ing_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['servicios_ing_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['servicios_ing_nd_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['servicios_ing_nd_basicos']['fecha_auto']       = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['servicios_ing_nd_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_ing_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nd_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_ing_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nd_basicos']['TipoDocumento'] = '';
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
					$_SESSION['servicios_ing_nd_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['servicios_ing_nd_basicos']['Proveedor'] = '';
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
				$_SESSION['servicios_ing_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_ing_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
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
				$_SESSION['servicios_ing_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
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
					$_SESSION['servicios_ing_nd_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['servicios_ing_nd_basicos']['idCentroCosto'] = $idCentroCosto;
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
					$_SESSION['servicios_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nd_basicos']['idLevel_1']    = $idLevel_1;
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
					$_SESSION['servicios_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nd_basicos']['idLevel_2']    = $idLevel_2;
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
					$_SESSION['servicios_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nd_basicos']['idLevel_3']    = $idLevel_3;
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
					$_SESSION['servicios_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nd_basicos']['idLevel_4']    = $idLevel_4;
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
					$_SESSION['servicios_ing_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nd_basicos']['idLevel_5']    = $idLevel_5;
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
			
			//verificar si el producto ya existe
			if(isset($_SESSION['servicios_ing_nd_productos'][$idServicio])&&$_SESSION['servicios_ing_nd_productos'][$idServicio]>0){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['Cantidad_ing']  = $Cantidad_ing;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_nd_productos'][$idServicio])&&$_SESSION['servicios_ing_nd_productos'][$idServicio]>0&&$_SESSION['servicios_ing_nd_productos'][$idServicio]!=$_SESSION['servicios_ing_nd_productos'][$oldItemID]){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				//Borro el producto
				unset($_SESSION['servicios_ing_nd_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['idServicio']       = $idServicio;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['Cantidad_ing']     = $Cantidad_ing;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['ValorIngreso']     = $vUnitario;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['ValorTotal']       = $ValorTotal;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['idFrecuencia']     = $idFrecuencia;
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['Servicio']         = $rowServicio['Nombre'];
				$_SESSION['servicios_ing_nd_productos'][$idServicio]['Frecuencia']       = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro el producto
			unset($_SESSION['servicios_ing_nd_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['servicios_ing_nd_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['servicios_ing_nd_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_nd_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['servicios_ing_nd_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['servicios_ing_nd_otros'][$bvar]['vTotal']        = $vTotal;
				
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
				$_SESSION['servicios_ing_nd_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['servicios_ing_nd_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['servicios_ing_nd_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nd_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_nd_impuestos'][$idImpuesto])&&$_SESSION['servicios_ing_nd_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_nd_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nd_impuestos'][$_GET['del_impuesto']]);
			
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
				$_SESSION['servicios_ing_nd_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['servicios_ing_nd_temporal'] = $_SESSION['servicios_ing_nd_basicos']['Observaciones'];
			$_SESSION['servicios_ing_nd_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['servicios_ing_nd_archivos'])){
				foreach ($_SESSION['servicios_ing_nd_archivos'] as $key => $trabajos){
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
						$sufijo = 'servicios_ingreso_'.fecha_actual().'_';
					  
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
									$_SESSION['servicios_ing_nd_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['servicios_ing_nd_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['servicios_ing_nd_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['servicios_ing_nd_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['servicios_ing_nd_archivos'][$_GET['del_file']]);
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
			if (isset($_SESSION['servicios_ing_nd_basicos'])){
				if(!isset($_SESSION['servicios_ing_nd_basicos']['idDocumentos']) or $_SESSION['servicios_ing_nd_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['servicios_ing_nd_basicos']['N_Doc']) or $_SESSION['servicios_ing_nd_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha seleccionado el area';}
				if(!isset($_SESSION['servicios_ing_nd_basicos']['Observaciones']) or $_SESSION['servicios_ing_nd_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha seleccionado la maquina';}
				if(!isset($_SESSION['servicios_ing_nd_basicos']['idSistema']) or $_SESSION['servicios_ing_nd_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['servicios_ing_nd_basicos']['idUsuario']) or $_SESSION['servicios_ing_nd_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) or $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['servicios_ing_nd_basicos']['idTipo']) or $_SESSION['servicios_ing_nd_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['servicios_ing_nd_basicos']['idDocumentos']) && $_SESSION['servicios_ing_nd_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['servicios_ing_nd_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}	
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['servicios_ing_nd_productos'])&&!isset($_SESSION['servicios_ing_nd_otros'])){
				$error['idProducto']   = 'error/No se han asignado servicios ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['servicios_ing_nd_productos'])){
				foreach ($_SESSION['servicios_ing_nd_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['servicios_ing_nd_otros'])){
				foreach ($_SESSION['servicios_ing_nd_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado servicios ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['servicios_ing_nd_basicos']['idSistema']) && $_SESSION['servicios_ing_nd_basicos']['idSistema'] != ''){            $a  = "'".$_SESSION['servicios_ing_nd_basicos']['idSistema']."'" ;      }else{$a  = "''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idUsuario']) && $_SESSION['servicios_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idDocumentos']) && $_SESSION['servicios_ing_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idDocumentos']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['N_Doc']) && $_SESSION['servicios_ing_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idTipo']) && $_SESSION['servicios_ing_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['Observaciones']) && $_SESSION['servicios_ing_nd_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idProveedor']) && $_SESSION['servicios_ing_nd_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idProveedor']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['Pago_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['servicios_ing_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['servicios_ing_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nd_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['servicios_ing_nd_basicos']['fecha_auto']) && $_SESSION['servicios_ing_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['fecha_auto']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['valor_neto_fact'])&&$_SESSION['servicios_ing_nd_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['valor_neto_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['valor_neto_imp'])&&$_SESSION['servicios_ing_nd_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['valor_neto_imp']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['valor_total_fact'])&&$_SESSION['servicios_ing_nd_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['valor_total_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][1]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][1]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][2]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][2]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][3]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][3]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][4]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][4]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][5]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][5]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][6]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][6]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][7]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][7]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][8]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][8]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][9]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][9]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_impuestos'][10]['valor'])&&$_SESSION['servicios_ing_nd_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['servicios_ing_nd_impuestos'][10]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idCentroCosto']) && $_SESSION['servicios_ing_nd_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idLevel_1']) && $_SESSION['servicios_ing_nd_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idLevel_2']) && $_SESSION['servicios_ing_nd_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idLevel_3']) && $_SESSION['servicios_ing_nd_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idLevel_4']) && $_SESSION['servicios_ing_nd_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nd_basicos']['idLevel_5']) && $_SESSION['servicios_ing_nd_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
					
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_servicios_facturacion` ( idSistema, idUsuario, Creacion_fecha, Creacion_Semana, Creacion_mes,
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
					if(isset($_SESSION['servicios_ing_nd_productos'])){		
						foreach ($_SESSION['servicios_ing_nd_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idSistema']) && $_SESSION['servicios_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idUsuario']) && $_SESSION['servicios_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idDocumentos']) && $_SESSION['servicios_ing_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idDocumentos']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['N_Doc']) && $_SESSION['servicios_ing_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idTipo']) && $_SESSION['servicios_ing_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){                                                                  $a .= ",'".$producto['idServicio']."'" ;                                     }else{$a .= ",''";}
							if(isset($producto['Cantidad_ing']) && $producto['Cantidad_ing'] != ''){                                                              $a .= ",'".$producto['Cantidad_ing']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){                                                              $a .= ",'".$producto['idFrecuencia']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                              $a .= ",'".$producto['ValorIngreso']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                  $a .= ",'".$producto['ValorTotal']."'" ;                                     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idProveedor']) && $_SESSION['servicios_ing_nd_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['fecha_auto']) && $_SESSION['servicios_ing_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
						
					
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_existencias` (idFacturacion, idSistema, idUsuario,
							Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idServicio, Cantidad_ing, idFrecuencia, Valor, ValorTotal,
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
					if(isset($_SESSION['servicios_ing_nd_otros'])){
						foreach ($_SESSION['servicios_ing_nd_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idSistema']) && $_SESSION['servicios_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idUsuario']) && $_SESSION['servicios_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_otros` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_ing_nd_archivos'])){
						foreach ($_SESSION['servicios_ing_nd_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idSistema']) && $_SESSION['servicios_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idUsuario']) && $_SESSION['servicios_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['servicios_ing_nd_basicos']);
					unset($_SESSION['servicios_ing_nd_productos']);
					unset($_SESSION['servicios_ing_nd_temporal']);
					unset($_SESSION['servicios_ing_nd_impuestos']);
					unset($_SESSION['servicios_ing_nd_archivos']);
					unset($_SESSION['servicios_ing_nd_otros']);
					
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_ing_nc_basicos']);
				unset($_SESSION['servicios_ing_nc_productos']);
				unset($_SESSION['servicios_ing_nc_temporal']);
				unset($_SESSION['servicios_ing_nc_impuestos']);
				unset($_SESSION['servicios_ing_nc_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['servicios_ing_nc_archivos'])){
					foreach ($_SESSION['servicios_ing_nc_archivos'] as $key => $producto){
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
				unset($_SESSION['servicios_ing_nc_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['servicios_ing_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['servicios_ing_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['servicios_ing_nc_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['servicios_ing_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['servicios_ing_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['servicios_ing_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idProveedor) && $idProveedor != ''){             $_SESSION['servicios_ing_nc_basicos']['idProveedor'] = $idProveedor;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['servicios_ing_nc_basicos']['fecha_auto'] = $fecha_auto;}
				
				//Se agrega el impuesto
				$_SESSION['servicios_ing_nc_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_ing_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nc_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_ing_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nc_basicos']['TipoDocumento'] = '';
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
					$_SESSION['servicios_ing_nc_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['servicios_ing_nc_basicos']['Proveedor'] = '';
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
				$_SESSION['servicios_ing_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_ing_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['servicios_ing_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['servicios_ing_nc_basicos']['idCentroCosto'] = 0;
				$_SESSION['servicios_ing_nc_basicos']['idLevel_1']     = 0;
				$_SESSION['servicios_ing_nc_basicos']['idLevel_2']     = 0;
				$_SESSION['servicios_ing_nc_basicos']['idLevel_3']     = 0;
				$_SESSION['servicios_ing_nc_basicos']['idLevel_4']     = 0;
				$_SESSION['servicios_ing_nc_basicos']['idLevel_5']     = 0;
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nc_basicos']);
			unset($_SESSION['servicios_ing_nc_productos']);
			unset($_SESSION['servicios_ing_nc_temporal']);
			unset($_SESSION['servicios_ing_nc_impuestos']);
			unset($_SESSION['servicios_ing_nc_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['servicios_ing_nc_archivos'])){
				foreach ($_SESSION['servicios_ing_nc_archivos'] as $key => $producto){
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
			unset($_SESSION['servicios_ing_nc_archivos']);
			
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
				unset($_SESSION['servicios_ing_nc_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['servicios_ing_nc_productos']);
				unset($_SESSION['servicios_ing_nc_impuestos']);
				unset($_SESSION['servicios_ing_nc_otros']);
			
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['servicios_ing_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['servicios_ing_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['servicios_ing_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['servicios_ing_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['servicios_ing_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idProveedor) && $idProveedor != ''){             $_SESSION['servicios_ing_nc_basicos']['idProveedor'] = $idProveedor;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['servicios_ing_nc_basicos']['fecha_auto'] = $fecha_auto;}
				
				//Se agrega el impuesto
				$_SESSION['servicios_ing_nc_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_ing_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nc_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_ing_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_ing_nc_basicos']['TipoDocumento'] = '';
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
					$_SESSION['servicios_ing_nc_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['servicios_ing_nc_basicos']['Proveedor'] = '';
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
				$_SESSION['servicios_ing_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_ing_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
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
				$_SESSION['servicios_ing_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
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
					$_SESSION['servicios_ing_nc_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['servicios_ing_nc_basicos']['idCentroCosto'] = $idCentroCosto;
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
					$_SESSION['servicios_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nc_basicos']['idLevel_1']    = $idLevel_1;
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
					$_SESSION['servicios_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nc_basicos']['idLevel_2']    = $idLevel_2;
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
					$_SESSION['servicios_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nc_basicos']['idLevel_3']    = $idLevel_3;
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
					$_SESSION['servicios_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nc_basicos']['idLevel_4']    = $idLevel_4;
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
					$_SESSION['servicios_ing_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_ing_nc_basicos']['idLevel_5']    = $idLevel_5;
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
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_nc_productos'][$idServicio])&&$_SESSION['servicios_ing_nc_productos'][$idServicio]>0){
				$error['productos'] = 'error/El Servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['Cantidad_eg']   = $Cantidad_eg;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_nc_productos'][$idServicio])&&$_SESSION['servicios_ing_nc_productos'][$idServicio]>0&&$_SESSION['servicios_ing_nc_productos'][$idServicio]!=$_SESSION['servicios_ing_nc_productos'][$oldItemID]){
				$error['productos'] = 'error/El Servicio que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['servicios_ing_nc_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['Cantidad_eg']   = $Cantidad_eg;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_ing_nc_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;

/*******************************************************************************************************************/		
		case 'del_prod_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nc_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['servicios_ing_nc_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['servicios_ing_nc_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_nc_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['servicios_ing_nc_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['servicios_ing_nc_otros'][$bvar]['vTotal']        = $vTotal;
				
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
				$_SESSION['servicios_ing_nc_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['servicios_ing_nc_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['servicios_ing_nc_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nc_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_ing_nc':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_ing_nc_impuestos'][$idImpuesto])&&$_SESSION['servicios_ing_nc_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_ing_nc_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_ing_nc_impuestos'][$_GET['del_impuesto']]);
			
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
				$_SESSION['servicios_ing_nc_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['servicios_ing_nc_temporal'] = $_SESSION['servicios_ing_nc_basicos']['Observaciones'];
			$_SESSION['servicios_ing_nc_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['servicios_ing_nc_archivos'])){
				foreach ($_SESSION['servicios_ing_nc_archivos'] as $key => $trabajos){
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
						$sufijo = 'servicios_egreso_'.fecha_actual().'_';
					  
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
									$_SESSION['servicios_ing_nc_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['servicios_ing_nc_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['servicios_ing_nc_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['servicios_ing_nc_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['servicios_ing_nc_archivos'][$_GET['del_file']]);
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
			if (isset($_SESSION['servicios_ing_nc_basicos'])){
				if(!isset($_SESSION['servicios_ing_nc_basicos']['idDocumentos']) or $_SESSION['servicios_ing_nc_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documentoa';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['N_Doc']) or $_SESSION['servicios_ing_nc_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['Observaciones']) or $_SESSION['servicios_ing_nc_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['idSistema']) or $_SESSION['servicios_ing_nc_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['idUsuario']) or $_SESSION['servicios_ing_nc_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha sleccionado el usuario';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']) or $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado una fecha de creacion';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['idTipo']) or $_SESSION['servicios_ing_nc_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['servicios_ing_nc_basicos']['idProveedor']) or $_SESSION['servicios_ing_nc_basicos']['idProveedor']=='' ){           $error['idProveedor']        = 'error/No ha seleccionado el cliente';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['servicios_ing_nc_basicos']['idDocumentos']) && $_SESSION['servicios_ing_nc_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['servicios_ing_nc_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//productos o guias
			if (!isset($_SESSION['servicios_ing_nc_productos'])&&!isset($_SESSION['servicios_ing_nc_otros'])){
				$error['idProducto']   = 'error/No se han asignado ni servicios ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['servicios_ing_nc_productos'])){
				foreach ($_SESSION['servicios_ing_nc_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['servicios_ing_nc_otros'])){
				foreach ($_SESSION['servicios_ing_nc_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos']   = 'error/No se han asignado ni servicios ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['servicios_ing_nc_basicos']['idDocumentos']) && $_SESSION['servicios_ing_nc_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['servicios_ing_nc_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['N_Doc']) && $_SESSION['servicios_ing_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['Observaciones']) && $_SESSION['servicios_ing_nc_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idSistema']) && $_SESSION['servicios_ing_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idUsuario']) && $_SESSION['servicios_ing_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idTipo']) && $_SESSION['servicios_ing_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idProveedor']) && $_SESSION['servicios_ing_nc_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idProveedor']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['fecha_auto']) && $_SESSION['servicios_ing_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['fecha_auto']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['valor_neto_fact'])&&$_SESSION['servicios_ing_nc_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['valor_neto_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['valor_neto_imp'])&&$_SESSION['servicios_ing_nc_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['valor_neto_imp']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['valor_total_fact'])&&$_SESSION['servicios_ing_nc_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['valor_total_fact']."'";  }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][1]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][1]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][2]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][2]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][3]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][3]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][4]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][4]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][5]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][5]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][6]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][6]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][7]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][7]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][8]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][8]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][9]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][9]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_impuestos'][10]['valor'])&&$_SESSION['servicios_ing_nc_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['servicios_ing_nc_impuestos'][10]['valor']."'";       }else{$a .= ",''";}
				$a .= ",'1'";
				if(isset($_SESSION['servicios_ing_nc_basicos']['idCentroCosto']) && $_SESSION['servicios_ing_nc_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idLevel_1']) && $_SESSION['servicios_ing_nc_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idLevel_2']) && $_SESSION['servicios_ing_nc_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idLevel_3']) && $_SESSION['servicios_ing_nc_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idLevel_4']) && $_SESSION['servicios_ing_nc_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_ing_nc_basicos']['idLevel_5']) && $_SESSION['servicios_ing_nc_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_servicios_facturacion` (idDocumentos,N_Doc, Observaciones, 
				idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, 
				Creacion_ano, idProveedor, fecha_auto, ValorNeto, ValorNetoImp,ValorTotal, Impuesto_01, 
				Impuesto_02, Impuesto_03, Impuesto_04, Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, 
				Impuesto_09, Impuesto_10, idEstado, idCentroCosto, idLevel_1, idLevel_2, idLevel_3, idLevel_4, 
				idLevel_5) 
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
					if(isset($_SESSION['servicios_ing_nc_productos'])){		
						foreach ($_SESSION['servicios_ing_nc_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idSistema']) && $_SESSION['servicios_ing_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idUsuario']) && $_SESSION['servicios_ing_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idDocumentos']) && $_SESSION['servicios_ing_nc_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['N_Doc']) && $_SESSION['servicios_ing_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idTipo']) && $_SESSION['servicios_ing_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){                                                                  $a .= ",'".$producto['idServicio']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['Cantidad_eg']) && $producto['Cantidad_eg'] != ''){                                                                $a .= ",'".$producto['Cantidad_eg']."'" ;                               }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){                                                              $a .= ",'".$producto['idFrecuencia']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                              $a .= ",'".$producto['ValorIngreso']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                  $a .= ",'".$producto['ValorTotal']."'" ;                                }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idProveedor']) && $_SESSION['servicios_ing_nc_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idProveedor']."'" ;   }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['fecha_auto']) && $_SESSION['servicios_ing_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_existencias` (idFacturacion, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, 
							idDocumentos, N_Doc, idTipo, idServicio, Cantidad_eg, idFrecuencia, Valor,ValorTotal,	 idProveedor, fecha_auto) 
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
					if(isset($_SESSION['servicios_ing_nc_otros'])){
						foreach ($_SESSION['servicios_ing_nc_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idSistema']) && $_SESSION['servicios_ing_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['idUsuario']) && $_SESSION['servicios_ing_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_otros` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_ing_nc_archivos'])){
						foreach ($_SESSION['servicios_ing_nc_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idSistema']) && $_SESSION['servicios_ing_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['idUsuario']) && $_SESSION['servicios_ing_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_ing_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_ing_nc_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['servicios_ing_nc_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['servicios_ing_nc_basicos']);
					unset($_SESSION['servicios_ing_nc_productos']);
					unset($_SESSION['servicios_ing_nc_temporal']);
					unset($_SESSION['servicios_ing_nc_impuestos']);
					unset($_SESSION['servicios_ing_nc_archivos']);
					unset($_SESSION['servicios_ing_nc_otros']);
				
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_egr_nd_basicos']);
				unset($_SESSION['servicios_egr_nd_productos']);
				unset($_SESSION['servicios_egr_nd_temporal']);
				unset($_SESSION['servicios_egr_nd_impuestos']);
				unset($_SESSION['servicios_egr_nd_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['servicios_egr_nd_archivos'])){
					foreach ($_SESSION['servicios_egr_nd_archivos'] as $key => $producto){
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
				unset($_SESSION['servicios_egr_nd_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['servicios_egr_nd_basicos']['idCliente']        = $idCliente;
				$_SESSION['servicios_egr_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['servicios_egr_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['servicios_egr_nd_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['servicios_egr_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['servicios_egr_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['servicios_egr_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['servicios_egr_nd_basicos']['Pago_fecha']       = '0000-00-00';
				$_SESSION['servicios_egr_nd_basicos']['fecha_auto']       = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['servicios_egr_nd_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_egr_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nd_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_egr_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nd_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
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
					$_SESSION['servicios_egr_nd_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['servicios_egr_nd_basicos']['Cliente'] = '';
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
				$_SESSION['servicios_egr_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_egr_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['servicios_egr_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['servicios_egr_nd_basicos']['idCentroCosto'] = 0;
				$_SESSION['servicios_egr_nd_basicos']['idLevel_1']     = 0;
				$_SESSION['servicios_egr_nd_basicos']['idLevel_2']     = 0;
				$_SESSION['servicios_egr_nd_basicos']['idLevel_3']     = 0;
				$_SESSION['servicios_egr_nd_basicos']['idLevel_4']     = 0;
				$_SESSION['servicios_egr_nd_basicos']['idLevel_5']     = 0;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nd_basicos']);
			unset($_SESSION['servicios_egr_nd_productos']);
			unset($_SESSION['servicios_egr_nd_temporal']);
			unset($_SESSION['servicios_egr_nd_impuestos']);
			unset($_SESSION['servicios_egr_nd_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['servicios_egr_nd_archivos'])){
				foreach ($_SESSION['servicios_egr_nd_archivos'] as $key => $producto){
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
			unset($_SESSION['servicios_egr_nd_archivos']);

			
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_egr_nd_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['servicios_egr_nd_productos']);
				unset($_SESSION['servicios_egr_nd_guias']);
				unset($_SESSION['servicios_egr_nd_impuestos']);
				unset($_SESSION['servicios_egr_nd_otros']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['servicios_egr_nd_basicos']['idDocumentos']     = $idDocumentos;
				$_SESSION['servicios_egr_nd_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['servicios_egr_nd_basicos']['idSistema']        = $idSistema;
				$_SESSION['servicios_egr_nd_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['servicios_egr_nd_basicos']['idTipo']           = $idTipo;
				$_SESSION['servicios_egr_nd_basicos']['idCliente']        = $idCliente;
				$_SESSION['servicios_egr_nd_basicos']['fecha_auto']       = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['servicios_egr_nd_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_egr_nd_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nd_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_egr_nd_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nd_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
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
					$_SESSION['servicios_egr_nd_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['servicios_egr_nd_basicos']['Cliente'] = '';
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
				$_SESSION['servicios_egr_nd_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_egr_nd_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
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
				$_SESSION['servicios_egr_nd_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
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
					$_SESSION['servicios_egr_nd_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['servicios_egr_nd_basicos']['idCentroCosto'] = $idCentroCosto;
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
					$_SESSION['servicios_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nd_basicos']['idLevel_1']    = $idLevel_1;
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
					$_SESSION['servicios_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nd_basicos']['idLevel_2']    = $idLevel_2;
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
					$_SESSION['servicios_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nd_basicos']['idLevel_3']    = $idLevel_3;
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
					$_SESSION['servicios_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nd_basicos']['idLevel_4']    = $idLevel_4;
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
					$_SESSION['servicios_egr_nd_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nd_basicos']['idLevel_5']    = $idLevel_5;
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
			
			//verificar si el producto ya existe
			if(isset($_SESSION['servicios_egr_nd_productos'][$idServicio])&&$_SESSION['servicios_egr_nd_productos'][$idServicio]>0){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
	
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['Cantidad_eg']   = $Cantidad_eg;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_nd_productos'][$idServicio])&&$_SESSION['servicios_egr_nd_productos'][$idServicio]>0&&$_SESSION['servicios_egr_nd_productos'][$idServicio]!=$_SESSION['servicios_egr_nd_productos'][$oldItemID]){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['servicios_egr_nd_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['idServicio']       = $idServicio;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['Cantidad_eg']      = $Cantidad_eg;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['ValorIngreso']     = $vUnitario;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['ValorTotal']       = $ValorTotal;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['idFrecuencia']     = $idFrecuencia;
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['Servicio']         = $rowServicio['Nombre'];
				$_SESSION['servicios_egr_nd_productos'][$idServicio]['Frecuencia']       = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro el producto
			unset($_SESSION['servicios_egr_nd_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['servicios_egr_nd_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['servicios_egr_nd_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_nd_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['servicios_egr_nd_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['servicios_egr_nd_otros'][$bvar]['vTotal']        = $vTotal;
				
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
				$_SESSION['servicios_egr_nd_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['servicios_egr_nd_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['servicios_egr_nd_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nd_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_nd_impuestos'][$idImpuesto])&&$_SESSION['servicios_egr_nd_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_nd_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nd_impuestos'][$_GET['del_impuesto']]);
			
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
				$_SESSION['servicios_egr_nd_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['servicios_egr_nd_temporal'] = $_SESSION['servicios_egr_nd_basicos']['Observaciones'];
			$_SESSION['servicios_egr_nd_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['servicios_egr_nd_archivos'])){
				foreach ($_SESSION['servicios_egr_nd_archivos'] as $key => $trabajos){
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
						$sufijo = 'servicios_egreso_'.fecha_actual().'_';
					  
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
									$_SESSION['servicios_egr_nd_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['servicios_egr_nd_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['servicios_egr_nd_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['servicios_egr_nd_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['servicios_egr_nd_archivos'][$_GET['del_file']]);
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
			if (isset($_SESSION['servicios_egr_nd_basicos'])){
				if(!isset($_SESSION['servicios_egr_nd_basicos']['idDocumentos']) or $_SESSION['servicios_egr_nd_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['servicios_egr_nd_basicos']['N_Doc']) or $_SESSION['servicios_egr_nd_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha seleccionado el area';}
				if(!isset($_SESSION['servicios_egr_nd_basicos']['Observaciones']) or $_SESSION['servicios_egr_nd_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha seleccionado la maquina';}
				if(!isset($_SESSION['servicios_egr_nd_basicos']['idSistema']) or $_SESSION['servicios_egr_nd_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['servicios_egr_nd_basicos']['idUsuario']) or $_SESSION['servicios_egr_nd_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) or $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['servicios_egr_nd_basicos']['idTipo']) or $_SESSION['servicios_egr_nd_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['servicios_egr_nd_basicos']['idDocumentos']) && $_SESSION['servicios_egr_nd_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['servicios_egr_nd_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}	
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['servicios_egr_nd_productos'])&&!isset($_SESSION['servicios_egr_nd_otros'])){
				$error['idProducto']   = 'error/No se han asignado servicios ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['servicios_egr_nd_productos'])){
				foreach ($_SESSION['servicios_egr_nd_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['servicios_egr_nd_otros'])){
				foreach ($_SESSION['servicios_egr_nd_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se han asignado servicios ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['servicios_egr_nd_basicos']['idSistema']) && $_SESSION['servicios_egr_nd_basicos']['idSistema'] != ''){           $a  = "'".$_SESSION['servicios_egr_nd_basicos']['idSistema']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idUsuario']) && $_SESSION['servicios_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idDocumentos']) && $_SESSION['servicios_egr_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idDocumentos']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['N_Doc']) && $_SESSION['servicios_egr_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idTipo']) && $_SESSION['servicios_egr_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['Observaciones']) && $_SESSION['servicios_egr_nd_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idCliente']) && $_SESSION['servicios_egr_nd_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idCliente']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['Pago_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".fecha2NdiaMes($_SESSION['servicios_egr_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NSemana($_SESSION['servicios_egr_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nd_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nd_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				if(isset($_SESSION['servicios_egr_nd_basicos']['fecha_auto']) && $_SESSION['servicios_egr_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['fecha_auto']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['valor_neto_fact'])&&$_SESSION['servicios_egr_nd_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['valor_neto_fact']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['valor_neto_imp'])&&$_SESSION['servicios_egr_nd_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['valor_neto_imp']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['valor_total_fact'])&&$_SESSION['servicios_egr_nd_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['valor_total_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][1]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][1]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][2]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][2]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][3]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][3]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][4]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][4]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][5]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][5]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][6]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][6]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][7]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][7]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][8]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][8]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][9]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][9]['valor']."'";         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_impuestos'][10]['valor'])&&$_SESSION['servicios_egr_nd_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['servicios_egr_nd_impuestos'][10]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idCentroCosto']) && $_SESSION['servicios_egr_nd_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idLevel_1']) && $_SESSION['servicios_egr_nd_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idLevel_2']) && $_SESSION['servicios_egr_nd_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idLevel_3']) && $_SESSION['servicios_egr_nd_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idLevel_4']) && $_SESSION['servicios_egr_nd_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nd_basicos']['idLevel_5']) && $_SESSION['servicios_egr_nd_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
					
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_servicios_facturacion` ( idSistema, idUsuario, Creacion_fecha, Creacion_Semana, Creacion_mes,
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
					if(isset($_SESSION['servicios_egr_nd_productos'])){		
						foreach ($_SESSION['servicios_egr_nd_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idSistema']) && $_SESSION['servicios_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idUsuario']) && $_SESSION['servicios_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idDocumentos']) && $_SESSION['servicios_egr_nd_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idDocumentos']."'" ;       }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['N_Doc']) && $_SESSION['servicios_egr_nd_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idTipo']) && $_SESSION['servicios_egr_nd_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){                                                                  $a .= ",'".$producto['idServicio']."'" ;                                     }else{$a .= ",''";}
							if(isset($producto['Cantidad_eg']) && $producto['Cantidad_eg'] != ''){                                                                $a .= ",'".$producto['Cantidad_eg']."'" ;                                    }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){                                                              $a .= ",'".$producto['idFrecuencia']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                              $a .= ",'".$producto['ValorIngreso']."'" ;                                   }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                  $a .= ",'".$producto['ValorTotal']."'" ;                                     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idCliente']) && $_SESSION['servicios_egr_nd_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idCliente']."'" ;          }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['fecha_auto']) && $_SESSION['servicios_egr_nd_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['fecha_auto']."'" ;         }else{$a .= ",''";}
						
					
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_existencias` (idFacturacion, idSistema, idUsuario,
							Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idServicio, Cantidad_eg, idFrecuencia, Valor, ValorTotal,
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
					if(isset($_SESSION['servicios_egr_nd_otros'])){
						foreach ($_SESSION['servicios_egr_nd_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idSistema']) && $_SESSION['servicios_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idUsuario']) && $_SESSION['servicios_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_otros` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_egr_nd_archivos'])){
						foreach ($_SESSION['servicios_egr_nd_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idSistema']) && $_SESSION['servicios_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idUsuario']) && $_SESSION['servicios_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['servicios_egr_nd_basicos']);
					unset($_SESSION['servicios_egr_nd_productos']);
					unset($_SESSION['servicios_egr_nd_temporal']);
					unset($_SESSION['servicios_egr_nd_impuestos']);
					unset($_SESSION['servicios_egr_nd_archivos']);
					unset($_SESSION['servicios_egr_nd_otros']);
					
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
				$ndata_1 = db_select_nrows ('idFacturacion', 'bodegas_servicios_facturacion', '', "idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['servicios_egr_nc_basicos']);
				unset($_SESSION['servicios_egr_nc_productos']);
				unset($_SESSION['servicios_egr_nc_temporal']);
				unset($_SESSION['servicios_egr_nc_impuestos']);
				unset($_SESSION['servicios_egr_nc_otros']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['servicios_egr_nc_archivos'])){
					foreach ($_SESSION['servicios_egr_nc_archivos'] as $key => $producto){
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
				unset($_SESSION['servicios_egr_nc_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['servicios_egr_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['servicios_egr_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['servicios_egr_nc_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['servicios_egr_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['servicios_egr_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['servicios_egr_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['servicios_egr_nc_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['servicios_egr_nc_basicos']['fecha_auto'] = $fecha_auto;}
				
				//Se agrega el impuesto
				$_SESSION['servicios_egr_nc_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_egr_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nc_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_egr_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nc_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
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
					$_SESSION['servicios_egr_nc_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['servicios_egr_nc_basicos']['Cliente'] = '';
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
				$_SESSION['servicios_egr_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_egr_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				/***********************************/
				//Centro de Costo vacio
				$_SESSION['servicios_egr_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['servicios_egr_nc_basicos']['idCentroCosto'] = 0;
				$_SESSION['servicios_egr_nc_basicos']['idLevel_1']     = 0;
				$_SESSION['servicios_egr_nc_basicos']['idLevel_2']     = 0;
				$_SESSION['servicios_egr_nc_basicos']['idLevel_3']     = 0;
				$_SESSION['servicios_egr_nc_basicos']['idLevel_4']     = 0;
				$_SESSION['servicios_egr_nc_basicos']['idLevel_5']     = 0;
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nc_basicos']);
			unset($_SESSION['servicios_egr_nc_productos']);
			unset($_SESSION['servicios_egr_nc_temporal']);
			unset($_SESSION['servicios_egr_nc_impuestos']);
			unset($_SESSION['servicios_egr_nc_otros']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['servicios_egr_nc_archivos'])){
				foreach ($_SESSION['servicios_egr_nc_archivos'] as $key => $producto){
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
			unset($_SESSION['servicios_egr_nc_archivos']);
			
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
				unset($_SESSION['servicios_egr_nc_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['servicios_egr_nc_productos']);
				unset($_SESSION['servicios_egr_nc_impuestos']);
				unset($_SESSION['servicios_egr_nc_otros']);
			
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['servicios_egr_nc_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['servicios_egr_nc_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['servicios_egr_nc_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['servicios_egr_nc_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['servicios_egr_nc_basicos']['idTipo'] = $idTipo;}
				if(isset($idCliente) && $idCliente != ''){             $_SESSION['servicios_egr_nc_basicos']['idCliente'] = $idCliente;}
				if(isset($fecha_auto) && $fecha_auto != ''){               $_SESSION['servicios_egr_nc_basicos']['fecha_auto'] = $fecha_auto;}
				
				//Se agrega el impuesto
				$_SESSION['servicios_egr_nc_impuestos'][1]['idImpuesto'] = 1;
				
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
					$_SESSION['servicios_egr_nc_basicos']['Documento'] = $rowDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nc_basicos']['Documento'] = '';
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `bodegas_servicios_facturacion_tipo`
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
					$_SESSION['servicios_egr_nc_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['servicios_egr_nc_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
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
					$_SESSION['servicios_egr_nc_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['servicios_egr_nc_basicos']['Cliente'] = '';
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
				$_SESSION['servicios_egr_nc_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['servicios_egr_nc_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
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
				$_SESSION['servicios_egr_nc_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				
				
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
					$_SESSION['servicios_egr_nc_basicos']['CentroCosto']   = $rowCentro['Nombre'];
					$_SESSION['servicios_egr_nc_basicos']['idCentroCosto'] = $idCentroCosto;
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
					$_SESSION['servicios_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nc_basicos']['idLevel_1']    = $idLevel_1;
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
					$_SESSION['servicios_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nc_basicos']['idLevel_2']    = $idLevel_2;
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
					$_SESSION['servicios_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nc_basicos']['idLevel_3']    = $idLevel_3;
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
					$_SESSION['servicios_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nc_basicos']['idLevel_4']    = $idLevel_4;
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
					$_SESSION['servicios_egr_nc_basicos']['CentroCosto'] .= ' - '.$rowCentro['Nombre'];
					$_SESSION['servicios_egr_nc_basicos']['idLevel_5']    = $idLevel_5;
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
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_nc_productos'][$idServicio])&&$_SESSION['servicios_egr_nc_productos'][$idServicio]>0){
				$error['productos'] = 'error/El Servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				/*************************************************/
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['Cantidad_ing']  = $Cantidad_ing;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_nc_productos'][$idServicio])&&$_SESSION['servicios_egr_nc_productos'][$idServicio]>0&&$_SESSION['servicios_egr_nc_productos'][$idServicio]!=$_SESSION['servicios_egr_nc_productos'][$oldItemID]){
				$error['productos'] = 'error/El Servicio que intenta agregar ya existe';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
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
				$rowServicio = mysqli_fetch_assoc ($resultado);
				
				// Se traen los datos del producto
				$query = "SELECT  Nombre 
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
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
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);
				
				//Borro el producto
				unset($_SESSION['servicios_egr_nc_productos'][$oldItemID]); 
			
				//creo el producto
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['Cantidad_ing']  = $Cantidad_ing;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['ValorIngreso']  = $vUnitario;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['ValorTotal']    = $ValorTotal;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['servicios_egr_nc_productos'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;

/*******************************************************************************************************************/		
		case 'del_prod_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nc_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['servicios_egr_nc_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['servicios_egr_nc_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_nc_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['servicios_egr_nc_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['servicios_egr_nc_otros'][$bvar]['vTotal']        = $vTotal;
				
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
				$_SESSION['servicios_egr_nc_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['servicios_egr_nc_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['servicios_egr_nc_otros'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nc_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_impuesto_egr_nc':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['servicios_egr_nc_impuestos'][$idImpuesto])&&$_SESSION['servicios_egr_nc_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['servicios_egr_nc_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['servicios_egr_nc_impuestos'][$_GET['del_impuesto']]);
			
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
				$_SESSION['servicios_egr_nc_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr_nc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['servicios_egr_nc_temporal'] = $_SESSION['servicios_egr_nc_basicos']['Observaciones'];
			$_SESSION['servicios_egr_nc_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['servicios_egr_nc_archivos'])){
				foreach ($_SESSION['servicios_egr_nc_archivos'] as $key => $trabajos){
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
						$sufijo = 'servicios_egreso_'.fecha_actual().'_';
					  
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
									$_SESSION['servicios_egr_nc_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['servicios_egr_nc_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['servicios_egr_nc_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['servicios_egr_nc_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['servicios_egr_nc_archivos'][$_GET['del_file']]);
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
			if (isset($_SESSION['servicios_egr_nc_basicos'])){
				if(!isset($_SESSION['servicios_egr_nc_basicos']['idDocumentos']) or $_SESSION['servicios_egr_nc_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha seleccionado el documentoa';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['N_Doc']) or $_SESSION['servicios_egr_nc_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['Observaciones']) or $_SESSION['servicios_egr_nc_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['idSistema']) or $_SESSION['servicios_egr_nc_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['idUsuario']) or $_SESSION['servicios_egr_nc_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha sleccionado el usuario';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']) or $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado una fecha de creacion';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['idTipo']) or $_SESSION['servicios_egr_nc_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo';}
				if(!isset($_SESSION['servicios_egr_nc_basicos']['idCliente']) or $_SESSION['servicios_egr_nc_basicos']['idCliente']=='' ){           $error['idCliente']        = 'error/No ha seleccionado el cliente';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['servicios_egr_nc_basicos']['idDocumentos']) && $_SESSION['servicios_egr_nc_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['servicios_egr_nc_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//productos o guias
			if (!isset($_SESSION['servicios_egr_nc_productos'])&&!isset($_SESSION['servicios_egr_nc_otros'])){
				$error['idProducto']   = 'error/No se han asignado ni servicios ni guias';
			}
			//Se verifican productos
			if (isset($_SESSION['servicios_egr_nc_productos'])){
				foreach ($_SESSION['servicios_egr_nc_productos'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifican guias
			if (isset($_SESSION['servicios_egr_nc_otros'])){
				foreach ($_SESSION['servicios_egr_nc_otros'] as $key => $producto){
					$n_data2++;
				}
			}
			$valor = $n_data1 + $n_data2;
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos']   = 'error/No se han asignado ni servicios ni guias';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['servicios_egr_nc_basicos']['idDocumentos']) && $_SESSION['servicios_egr_nc_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['servicios_egr_nc_basicos']['idDocumentos']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['N_Doc']) && $_SESSION['servicios_egr_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['Observaciones']) && $_SESSION['servicios_egr_nc_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idSistema']) && $_SESSION['servicios_egr_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idUsuario']) && $_SESSION['servicios_egr_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idTipo']) && $_SESSION['servicios_egr_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idCliente']) && $_SESSION['servicios_egr_nc_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idCliente']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['fecha_auto']) && $_SESSION['servicios_egr_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['fecha_auto']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['valor_neto_fact'])&&$_SESSION['servicios_egr_nc_basicos']['valor_neto_fact']!=''){    $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['valor_neto_fact']."'";   }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['valor_neto_imp'])&&$_SESSION['servicios_egr_nc_basicos']['valor_neto_imp']!=''){      $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['valor_neto_imp']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['valor_total_fact'])&&$_SESSION['servicios_egr_nc_basicos']['valor_total_fact']!=''){  $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['valor_total_fact']."'";  }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][1]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][1]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][1]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][2]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][2]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][2]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][3]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][3]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][3]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][4]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][4]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][4]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][5]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][5]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][5]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][6]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][6]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][6]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][7]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][7]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][7]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][8]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][8]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][8]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][9]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][9]['valor']!=''){              $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][9]['valor']."'";        }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_impuestos'][10]['valor'])&&$_SESSION['servicios_egr_nc_impuestos'][10]['valor']!=''){            $a .= ",'".$_SESSION['servicios_egr_nc_impuestos'][10]['valor']."'";       }else{$a .= ",''";}
				$a .= ",'1'";
				if(isset($_SESSION['servicios_egr_nc_basicos']['idCentroCosto']) && $_SESSION['servicios_egr_nc_basicos']['idCentroCosto'] != ''){    $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idCentroCosto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idLevel_1']) && $_SESSION['servicios_egr_nc_basicos']['idLevel_1'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idLevel_1']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idLevel_2']) && $_SESSION['servicios_egr_nc_basicos']['idLevel_2'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idLevel_2']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idLevel_3']) && $_SESSION['servicios_egr_nc_basicos']['idLevel_3'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idLevel_3']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idLevel_4']) && $_SESSION['servicios_egr_nc_basicos']['idLevel_4'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idLevel_4']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['servicios_egr_nc_basicos']['idLevel_5']) && $_SESSION['servicios_egr_nc_basicos']['idLevel_5'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idLevel_5']."'" ;         }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_servicios_facturacion` (idDocumentos,N_Doc, Observaciones, 
				idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_Semana, Creacion_mes, 
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
					if(isset($_SESSION['servicios_egr_nc_productos'])){		
						foreach ($_SESSION['servicios_egr_nc_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idSistema']) && $_SESSION['servicios_egr_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idUsuario']) && $_SESSION['servicios_egr_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idDocumentos']) && $_SESSION['servicios_egr_nc_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idDocumentos']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['N_Doc']) && $_SESSION['servicios_egr_nc_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idTipo']) && $_SESSION['servicios_egr_nc_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){                                                                  $a .= ",'".$producto['idServicio']."'" ;                                }else{$a .= ",''";}
							if(isset($producto['Cantidad_ing']) && $producto['Cantidad_ing'] != ''){                                                              $a .= ",'".$producto['Cantidad_ing']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){                                                              $a .= ",'".$producto['idFrecuencia']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                                              $a .= ",'".$producto['ValorIngreso']."'" ;                              }else{$a .= ",''";}
							if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                  $a .= ",'".$producto['ValorTotal']."'" ;                                }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idCliente']) && $_SESSION['servicios_egr_nc_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idCliente']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['fecha_auto']) && $_SESSION['servicios_egr_nc_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['fecha_auto']."'" ;    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_existencias` (idFacturacion, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, 
							idDocumentos, N_Doc, idTipo, idServicio, Cantidad_ing, idFrecuencia, Valor,ValorTotal,	 idCliente, fecha_auto) 
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
					if(isset($_SESSION['servicios_egr_nc_otros'])){
						foreach ($_SESSION['servicios_egr_nc_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idSistema']) && $_SESSION['servicios_egr_nd_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['idUsuario']) && $_SESSION['servicios_egr_nd_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nd_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_nd_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nd_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_otros` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_egr_nc_archivos'])){
						foreach ($_SESSION['servicios_egr_nc_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idSistema']) && $_SESSION['servicios_egr_nc_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['idUsuario']) && $_SESSION['servicios_egr_nc_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['servicios_egr_nc_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `bodegas_servicios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, Creacion_fecha,
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
					if(isset($_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']) && $_SESSION['servicios_egr_nc_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['servicios_egr_nc_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                    //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                               //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['servicios_egr_nc_basicos']);
					unset($_SESSION['servicios_egr_nc_productos']);
					unset($_SESSION['servicios_egr_nc_temporal']);
					unset($_SESSION['servicios_egr_nc_impuestos']);
					unset($_SESSION['servicios_egr_nc_archivos']);
					unset($_SESSION['servicios_egr_nc_otros']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;
/*******************************************************************************************************************/
	}
?>
