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
	if ( !empty($_POST['idFacturacion']) )  $idFacturacion   = $_POST['idFacturacion'];
	if ( !empty($_POST['idSistema']) )      $idSistema       = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['idTipo']) )         $idTipo          = $_POST['idTipo'];
	if ( !empty($_POST['Creacion_fecha']) ) $Creacion_fecha  = $_POST['Creacion_fecha'];
	if ( !empty($_POST['N_Doc']) )          $N_Doc           = $_POST['N_Doc'];
	if ( !empty($_POST['Observaciones']) )  $Observaciones   = $_POST['Observaciones'];
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador    = $_POST['idTrabajador'];
	if ( !empty($_POST['idCliente']) )      $idCliente       = $_POST['idCliente'];
	if ( !empty($_POST['idProveedor']) )    $idProveedor     = $_POST['idProveedor'];
	if ( !empty($_POST['idEstado']) )       $idEstado        = $_POST['idEstado'];
	if ( !empty($_POST['fecha_auto']) )     $fecha_auto      = $_POST['fecha_auto'];
	if ( !empty($_POST['ValorNeto']) )      $ValorNeto       = $_POST['ValorNeto'];
	if ( !empty($_POST['Impuesto']) )       $Impuesto        = $_POST['Impuesto'];
	if ( !empty($_POST['ValorTotal']) )     $ValorTotal      = $_POST['ValorTotal'];
	if ( !empty($_POST['idUsuarioPago']) )  $idUsuarioPago   = $_POST['idUsuarioPago'];
	if ( !empty($_POST['idDocPago']) )      $idDocPago       = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )      $N_DocPago       = $_POST['N_DocPago'];
	if ( !empty($_POST['F_Pago']) )         $F_Pago          = $_POST['F_Pago'];
	if ( !empty($_POST['MontoPagado']) )    $MontoPagado     = $_POST['MontoPagado'];
	if ( !empty($_POST['idOcompra']) )      $idOcompra       = $_POST['idOcompra'];
	
	if ( !empty($_POST['Nombre']) )         $Nombre          = $_POST['Nombre'];
	if ( !empty($_POST['vTotal']) )         $vTotal          = $_POST['vTotal'];
	if ( !empty($_POST['oldidProducto']) )  $oldidProducto   = $_POST['oldidProducto'];
	if ( !empty($_POST['idExistencia']) )   $idExistencia    = $_POST['idExistencia'];
	
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
			case 'idFacturacion':   if(empty($idFacturacion)){    $error['idFacturacion']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':       if(empty($idSistema)){        $error['idSistema']        = 'error/No ha ingresado el numero de documento';}break;
			case 'idUsuario':       if(empty($idUsuario)){        $error['idUsuario']        = 'error/No ha seleccionado la bodega';}break;
			case 'idTipo':          if(empty($idTipo)){           $error['idTipo']           = 'error/No ha ingresado las obsercaciones';}break;
			case 'Creacion_fecha':  if(empty($Creacion_fecha)){   $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}break;
			case 'N_Doc':           if(empty($N_Doc)){            $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}break;
			case 'Observaciones':   if(empty($Observaciones)){    $error['Observaciones']    = 'error/No ha ingresado la observacion';}break;
			case 'idTrabajador':    if(empty($idTrabajador)){     $error['idTrabajador']     = 'error/No ha seleccionado el trabajador';}break;
			case 'idCliente':       if(empty($idCliente)){        $error['idCliente']        = 'error/No ha seleccionado el cliente';}break;
			case 'idProveedor':     if(empty($idProveedor)){      $error['idProveedor']      = 'error/No ha seleccionado el Proveedor';}break;
			case 'idEstado':        if(empty($idEstado)){         $error['idEstado']         = 'error/No ha seleccionado el estado';}break;
			case 'fecha_auto':      if(empty($fecha_auto)){       $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}break;
			case 'ValorNeto':       if(empty($ValorNeto)){        $error['ValorNeto']        = 'error/No ha ingresado el valor neto';}break;
			case 'Impuesto':        if(empty($Impuesto)){         $error['Impuesto']         = 'error/No ha ingresado la retencion';}break;
			case 'ValorTotal':      if(empty($ValorTotal)){       $error['ValorTotal']       = 'error/No ha ingresado el valor total';}break;
			case 'idUsuarioPago':   if(empty($idUsuarioPago)){    $error['idUsuarioPago']    = 'error/No ha seleccionado el usuario de pago';}break;
			case 'idDocPago':       if(empty($idDocPago)){        $error['idDocPago']        = 'error/No ha seleccionado el documento de pago';}break;
			case 'N_DocPago':       if(empty($N_DocPago)){        $error['N_DocPago']        = 'error/No ha seleccionado el numero documento de pago';}break;
			case 'F_Pago':          if(empty($F_Pago)){           $error['F_Pago']           = 'error/No ha ingresado la fecha de pago';}break;
			case 'MontoPagado':     if(empty($MontoPagado)){      $error['MontoPagado']      = 'error/No ha ingresado el monto de pago';}break;
			case 'idOcompra':       if(empty($idOcompra)){        $error['idOcompra']        = 'error/No ha ingresado la Orden de Compra Relacionada';}break;
			
			case 'Nombre':          if(empty($Nombre)){           $error['Nombre']           = 'error/No ha ingresado el nombre';}break;
			case 'vTotal':          if(empty($vTotal)){           $error['vTotal']           = 'error/No ha ingresado el valor total';}break;
			case 'oldidProducto':   if(empty($oldidProducto)){    $error['oldidProducto']    = 'error/No ha ingresado el id del producto';}break;
			case 'idExistencia':    if(empty($idExistencia)){     $error['idExistencia']     = 'error/No ha ingresado el id de la existencia';}break;
			
			case 'idCentroCosto':   if(empty($idCentroCosto)){    $error['idCentroCosto']    = 'error/No ha seleccionado el Centro de Costo';}break;
			case 'idLevel_1':       if(empty($idLevel_1)){        $error['idLevel_1']        = 'error/No ha seleccionado el Nivel 1';}break;
			case 'idLevel_2':       if(empty($idLevel_2)){        $error['idLevel_2']        = 'error/No ha seleccionado el Nivel 2';}break;
			case 'idLevel_3':       if(empty($idLevel_3)){        $error['idLevel_3']        = 'error/No ha seleccionado el Nivel 3';}break;
			case 'idLevel_4':       if(empty($idLevel_4)){        $error['idLevel_4']        = 'error/No ha seleccionado el Nivel 4';}break;
			case 'idLevel_5':       if(empty($idLevel_5)){        $error['idLevel_5']        = 'error/No ha seleccionado el Nivel 5';}break;
			

	
		}
	}	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        INGRESOS                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_ingreso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "idTrabajador='".$idTrabajador."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			if(isset($idOcompra)&&$idOcompra!=''){
				//Se verifica la existencia de la ocompra
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado', '', "idOcompra='".$idOcompra."' AND idEstado='2'", $dbConn);
				//se verifica si aun hay datos pendientes
				$ndata_3 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_boletas', '', "idUso=1 AND idOcompra = ".$idOcompra." AND idTrabajador = ".$idTrabajador." AND N_Doc = ".$N_Doc."", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			if(isset($idOcompra)&&$idOcompra!=''){
				if($ndata_2==0) {$error['ndata_2'] = 'error/La OC ingresada no esta aprobada o no existe, favor verificar';}
				if($ndata_3==0) {$error['ndata_3'] = 'error/No existen items pendientes dentro de la OC';}
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['boleta_ing_basicos']);
				unset($_SESSION['boleta_ing_servicios']);
				unset($_SESSION['boleta_ing_temporal']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['boleta_ing_archivos'])){
					foreach ($_SESSION['boleta_ing_archivos'] as $key => $producto){
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
				unset($_SESSION['boleta_ing_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['boleta_ing_basicos']['idTrabajador']     = $idTrabajador;
				$_SESSION['boleta_ing_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['boleta_ing_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['boleta_ing_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['boleta_ing_basicos']['idSistema']        = $idSistema;
				$_SESSION['boleta_ing_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['boleta_ing_basicos']['idTipo']           = $idTipo;
				$_SESSION['boleta_ing_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['boleta_ing_basicos']['idEstado']         = $idEstado;
				
				/*******************************************************/
				//Si existe una Orden de compra relacionada
				if(isset($idOcompra)&&$idOcompra!=''){
					
					$_SESSION['boleta_ing_basicos']['idOcompra'] = $idOcompra;
					
					// Se trae un listado con todos las boletas de los trabajadores
					$arrBoletas = array();
					$query = "SELECT idExistencia, Descripcion, Valor
					FROM `ocompra_listado_existencias_boletas` 
					WHERE idUso=1 
					AND idOcompra = ".$idOcompra."
					AND idTrabajador = ".$idTrabajador."
					AND N_Doc = ".$N_Doc." ";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					array_push( $arrBoletas,$row );
					} 
					
					//Se guardan los datos
					$bvar = 1;
					foreach ($arrBoletas as $motivo){
						//se recorren los datos
						$_SESSION['boleta_ing_servicios'][$bvar]['idServicio']    = $bvar;
						$_SESSION['boleta_ing_servicios'][$bvar]['idExistencia']  = $motivo['idExistencia'];
						$_SESSION['boleta_ing_servicios'][$bvar]['Nombre']        = $motivo['Descripcion'];
						$_SESSION['boleta_ing_servicios'][$bvar]['vTotal']        = $motivo['Valor'];
						
						$bvar++;
					}
				
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `boleta_honorarios_facturacion_tipo`
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
					$_SESSION['boleta_ing_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['boleta_ing_basicos']['TipoDocumento'] = '';
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
					$_SESSION['boleta_ing_basicos']['Trabajador'] = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				}else{
					$_SESSION['boleta_ing_basicos']['Trabajador'] = '';
				}
				
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['boleta_ing_basicos']);
			unset($_SESSION['boleta_ing_servicios']);
			unset($_SESSION['boleta_ing_temporal']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['boleta_ing_archivos'])){
				foreach ($_SESSION['boleta_ing_archivos'] as $key => $producto){
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
			unset($_SESSION['boleta_ing_archivos']);

			
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
			$ndata_2 = 0;
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "idTrabajador='".$idTrabajador."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			if(isset($idOcompra)&&$idOcompra!=''){
				//Se verifica la existencia de la ocompra
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado', '', "idOcompra='".$idOcompra."' AND idEstado='2'", $dbConn);
				//se verifica si aun hay datos pendientes
				$ndata_3 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_boletas', '', "idUso=1 AND idOcompra = ".$idOcompra." AND idTrabajador = ".$idTrabajador." AND N_Doc = ".$N_Doc."", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			if(isset($idOcompra)&&$idOcompra!=''){
				if($ndata_2==0) {$error['ndata_2'] = 'error/La OC ingresada no esta aprobada o no existe, favor verificar';}
				if($ndata_3==0) {$error['ndata_3'] = 'error/No existen items pendientes dentro de la OC';}
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['boleta_ing_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['boleta_ing_servicios']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['boleta_ing_basicos']['idTrabajador']     = $idTrabajador;
				$_SESSION['boleta_ing_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['boleta_ing_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['boleta_ing_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['boleta_ing_basicos']['idSistema']        = $idSistema;
				$_SESSION['boleta_ing_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['boleta_ing_basicos']['idTipo']           = $idTipo;
				$_SESSION['boleta_ing_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['boleta_ing_basicos']['idEstado']         = $idEstado;
				
				/*******************************************************/
				//Si existe una Orden de compra relacionada
				if(isset($idOcompra)&&$idOcompra!=''){
					
					$_SESSION['boleta_ing_basicos']['idOcompra']        = $idOcompra;
					
					// Se trae un listado con todos las boletas de los trabajadores
					$arrBoletas = array();
					$query = "SELECT idExistencia, Descripcion, Valor
					FROM `ocompra_listado_existencias_boletas` 
					WHERE idUso=1 
					AND idOcompra = ".$idOcompra."
					AND idTrabajador = ".$idTrabajador."
					AND N_Doc = ".$N_Doc." ";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					array_push( $arrBoletas,$row );
					} 
					
					//Se guardan los datos
					$bvar = 1;
					foreach ($arrBoletas as $motivo){
						//se recorren los datos
						$_SESSION['boleta_ing_servicios'][$bvar]['idServicio']    = $bvar;
						$_SESSION['boleta_ing_servicios'][$bvar]['idExistencia']  = $motivo['idExistencia'];
						$_SESSION['boleta_ing_servicios'][$bvar]['Nombre']        = $motivo['Descripcion'];
						$_SESSION['boleta_ing_servicios'][$bvar]['vTotal']        = $motivo['Valor'];
						
						$bvar++;
					}
				
				}
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `boleta_honorarios_facturacion_tipo`
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
					$_SESSION['boleta_ing_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['boleta_ing_basicos']['TipoDocumento'] = '';
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
					$_SESSION['boleta_ing_basicos']['Trabajador'] = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				}else{
					$_SESSION['boleta_ing_basicos']['Trabajador'] = '';
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'new_servicio_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['boleta_ing_servicios'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['boleta_ing_servicios'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['boleta_ing_servicios'][$bvar]['idServicio']    = $bvar;
				$_SESSION['boleta_ing_servicios'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['boleta_ing_servicios'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_servicio_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['boleta_ing_servicios'][$oldidProducto]['idServicio']    = $oldidProducto;
				$_SESSION['boleta_ing_servicios'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['boleta_ing_servicios'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_servicio_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['boleta_ing_servicios'][$_GET['del_servicios']]);
			
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
				$_SESSION['boleta_ing_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['boleta_ing_temporal'] = $_SESSION['boleta_ing_basicos']['Observaciones'];
			$_SESSION['boleta_ing_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['boleta_ing_archivos'])){
				foreach ($_SESSION['boleta_ing_archivos'] as $key => $trabajos){
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
						$sufijo = 'boletas_honorarios_ingreso_'.fecha_actual().'_';
					  
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
									$_SESSION['boleta_ing_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['boleta_ing_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['boleta_ing_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['boleta_ing_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['boleta_ing_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'ing_bodega':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['boleta_ing_basicos'])){
				if(!isset($_SESSION['boleta_ing_basicos']['idTrabajador']) or $_SESSION['boleta_ing_basicos']['idTrabajador']=='' ){     $error['idTrabajador']     = 'error/No ha seleccionado el trabajador';}
				if(!isset($_SESSION['boleta_ing_basicos']['N_Doc']) or $_SESSION['boleta_ing_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['boleta_ing_basicos']['Creacion_fecha']) or $_SESSION['boleta_ing_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la fecha de creacion';}
				if(!isset($_SESSION['boleta_ing_basicos']['Observaciones']) or $_SESSION['boleta_ing_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['boleta_ing_basicos']['idSistema']) or $_SESSION['boleta_ing_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['boleta_ing_basicos']['idUsuario']) or $_SESSION['boleta_ing_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['boleta_ing_basicos']['idTipo']) or $_SESSION['boleta_ing_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de boleta';}
				if(!isset($_SESSION['boleta_ing_basicos']['fecha_auto']) or $_SESSION['boleta_ing_basicos']['fecha_auto']=='' ){         $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}
				if(!isset($_SESSION['boleta_ing_basicos']['idEstado']) or $_SESSION['boleta_ing_basicos']['idEstado']=='' ){             $error['idEstado']         = 'error/No ha seleccionado el estado';}
					
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la boleta de honorarios';
			}
			//productos o guias
			if (!isset($_SESSION['boleta_ing_servicios'])){
				$error['idProducto']   = 'error/No se han asignado servicios';
			}
			//Se verifican productos
			if (isset($_SESSION['boleta_ing_servicios'])){
				foreach ($_SESSION['boleta_ing_servicios'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No se han asignado servicios';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['boleta_ing_basicos']['idSistema']) && $_SESSION['boleta_ing_basicos']['idSistema'] != ''){    $a  = "'".$_SESSION['boleta_ing_basicos']['idSistema']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['boleta_ing_basicos']['idUsuario']) && $_SESSION['boleta_ing_basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['boleta_ing_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['idTipo']) && $_SESSION['boleta_ing_basicos']['idTipo'] != ''){          $a .= ",'".$_SESSION['boleta_ing_basicos']['idTipo']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['boleta_ing_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['boleta_ing_basicos']['N_Doc']) && $_SESSION['boleta_ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['boleta_ing_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['Observaciones']) && $_SESSION['boleta_ing_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['boleta_ing_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['idTrabajador']) && $_SESSION['boleta_ing_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['boleta_ing_basicos']['idTrabajador']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['idEstado']) && $_SESSION['boleta_ing_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['boleta_ing_basicos']['idEstado']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['fecha_auto']) && $_SESSION['boleta_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['boleta_ing_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['valor_neto'])&&$_SESSION['boleta_ing_basicos']['valor_neto']!=''){              $a .= ",'".$_SESSION['boleta_ing_basicos']['valor_neto']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['valor_imp'])&&$_SESSION['boleta_ing_basicos']['valor_imp']!=''){                $a .= ",'".$_SESSION['boleta_ing_basicos']['valor_imp']."'";       }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['valor_total'])&&$_SESSION['boleta_ing_basicos']['valor_total']!=''){            $a .= ",'".$_SESSION['boleta_ing_basicos']['valor_total']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_basicos']['idOcompra'])&&$_SESSION['boleta_ing_basicos']['idOcompra']!=''){                $a .= ",'".$_SESSION['boleta_ing_basicos']['idOcompra']."'";       }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `boleta_honorarios_facturacion` (idSistema, idUsuario, idTipo, Creacion_fecha,
				Creacion_Semana, Creacion_mes, Creacion_ano, N_Doc, Observaciones, idTrabajador, idEstado, fecha_auto,
				ValorNeto, Impuesto, ValorTotal, idOcompra) 
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
					//Se guardan los servicios
					if(isset($_SESSION['boleta_ing_servicios'])){		
						foreach ($_SESSION['boleta_ing_servicios'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                        $a  = "'".$ultimo_id."'" ;                                     }else{$a  = "''";}
							if(isset($_SESSION['boleta_ing_basicos']['idSistema']) && $_SESSION['boleta_ing_basicos']['idSistema'] != ''){    $a .= ",'".$_SESSION['boleta_ing_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_basicos']['idUsuario']) && $_SESSION['boleta_ing_basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['boleta_ing_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_basicos']['idTipo']) && $_SESSION['boleta_ing_basicos']['idTipo'] != ''){          $a .= ",'".$_SESSION['boleta_ing_basicos']['idTipo']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['boleta_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){              $a .= ",'".$producto['Nombre']."'" ;        }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){              $a .= ",'".$producto['vTotal']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idExistencia']) && $producto['idExistencia'] != ''){  $a .= ",'".$producto['idExistencia']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `boleta_honorarios_facturacion_servicios` (idFacturacion, idSistema, idUsuario,
							idTipo, Creacion_fecha, Creacion_mes, Creacion_ano, Nombre, vTotal, idExistencia ) 
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
							//Si existe la OC se actualizan los estados de esta
							if(isset($_SESSION['boleta_ing_basicos']['idOcompra']) && $_SESSION['boleta_ing_basicos']['idOcompra'] != ''){  
								
								//Actualizo 
								$a = "idUso='2'" ;
								
								// inserto los datos de registro en la db
								$query  = "UPDATE `ocompra_listado_existencias_boletas` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
								$result = mysqli_query($dbConn, $query);
								
							}
							
							
							
						}
					}
					
					/*********************************************************************/		
					//Archivos
					if(isset($_SESSION['boleta_ing_archivos'])){
						foreach ($_SESSION['boleta_ing_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                     $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['boleta_ing_basicos']['idSistema']) && $_SESSION['boleta_ing_basicos']['idSistema'] != ''){ $a .= ",'".$_SESSION['boleta_ing_basicos']['idSistema']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_basicos']['idUsuario']) && $_SESSION['boleta_ing_basicos']['idUsuario'] != ''){ $a .= ",'".$_SESSION['boleta_ing_basicos']['idUsuario']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_basicos']['idTipo']) && $_SESSION['boleta_ing_basicos']['idTipo'] != ''){       $a .= ",'".$_SESSION['boleta_ing_basicos']['idTipo']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['boleta_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['boleta_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `boleta_honorarios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, idTipo, Creacion_fecha,
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
					if(isset($_SESSION['boleta_ing_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['boleta_ing_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `boleta_honorarios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['boleta_ing_basicos']);
					unset($_SESSION['boleta_ing_servicios']);
					unset($_SESSION['boleta_ing_temporal']);
					unset($_SESSION['boleta_ing_archivos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                          EGRESO                                                 */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_egreso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "idCliente='".$idCliente."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['boleta_eg_basicos']);
				unset($_SESSION['boleta_eg_servicios']);
				unset($_SESSION['boleta_eg_temporal']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['boleta_eg_archivos'])){
					foreach ($_SESSION['boleta_eg_archivos'] as $key => $producto){
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
				unset($_SESSION['boleta_eg_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['boleta_eg_basicos']['idCliente']        = $idCliente;
				$_SESSION['boleta_eg_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['boleta_eg_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['boleta_eg_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['boleta_eg_basicos']['idSistema']        = $idSistema;
				$_SESSION['boleta_eg_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['boleta_eg_basicos']['idTipo']           = $idTipo;
				$_SESSION['boleta_eg_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['boleta_eg_basicos']['idEstado']         = $idEstado;
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `boleta_honorarios_facturacion_tipo`
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
					$_SESSION['boleta_eg_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['boleta_eg_basicos']['TipoDocumento'] = '';
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
					$_SESSION['boleta_eg_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['boleta_eg_basicos']['Cliente'] = '';
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['boleta_eg_basicos']);
			unset($_SESSION['boleta_eg_servicios']);
			unset($_SESSION['boleta_eg_temporal']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['boleta_eg_archivos'])){
				foreach ($_SESSION['boleta_eg_archivos'] as $key => $producto){
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
			unset($_SESSION['boleta_eg_archivos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "idCliente='".$idCliente."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['boleta_eg_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['boleta_eg_servicios']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['boleta_eg_basicos']['idCliente']        = $idCliente;
				$_SESSION['boleta_eg_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['boleta_eg_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['boleta_eg_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['boleta_eg_basicos']['idSistema']        = $idSistema;
				$_SESSION['boleta_eg_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['boleta_eg_basicos']['idTipo']           = $idTipo;
				$_SESSION['boleta_eg_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['boleta_eg_basicos']['idEstado']         = $idEstado;
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `boleta_honorarios_facturacion_tipo`
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
					$_SESSION['boleta_eg_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['boleta_eg_basicos']['TipoDocumento'] = '';
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
					$_SESSION['boleta_eg_basicos']['Cliente'] = $rowCliente['Nombre'];
				}else{
					$_SESSION['boleta_eg_basicos']['Cliente'] = '';
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'new_servicio_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['boleta_eg_servicios'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['boleta_eg_servicios'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['boleta_eg_servicios'][$bvar]['idServicio']    = $bvar;
				$_SESSION['boleta_eg_servicios'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['boleta_eg_servicios'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_servicio_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['boleta_eg_servicios'][$oldidProducto]['idServicio']    = $oldidProducto;
				$_SESSION['boleta_eg_servicios'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['boleta_eg_servicios'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_servicio_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['boleta_eg_servicios'][$_GET['del_servicios']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'add_obs_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['boleta_eg_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['boleta_eg_temporal'] = $_SESSION['boleta_eg_basicos']['Observaciones'];
			$_SESSION['boleta_eg_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_eg':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['boleta_eg_archivos'])){
				foreach ($_SESSION['boleta_eg_archivos'] as $key => $trabajos){
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
						$sufijo = 'boletas_honorarios_egreso_'.fecha_actual().'_';
					  
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
									$_SESSION['boleta_eg_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['boleta_eg_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
		case 'del_file_eg':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['boleta_eg_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['boleta_eg_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['boleta_eg_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'eg_bodega':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['boleta_eg_basicos'])){
				if(!isset($_SESSION['boleta_eg_basicos']['idCliente']) or $_SESSION['boleta_eg_basicos']['idCliente']=='' ){           $error['idCliente']        = 'error/No ha seleccionado el Cliente';}
				if(!isset($_SESSION['boleta_eg_basicos']['N_Doc']) or $_SESSION['boleta_eg_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['boleta_eg_basicos']['Creacion_fecha']) or $_SESSION['boleta_eg_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la fecha de creacion';}
				if(!isset($_SESSION['boleta_eg_basicos']['Observaciones']) or $_SESSION['boleta_eg_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['boleta_eg_basicos']['idSistema']) or $_SESSION['boleta_eg_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['boleta_eg_basicos']['idUsuario']) or $_SESSION['boleta_eg_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['boleta_eg_basicos']['idTipo']) or $_SESSION['boleta_eg_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de boleta';}
				if(!isset($_SESSION['boleta_eg_basicos']['fecha_auto']) or $_SESSION['boleta_eg_basicos']['fecha_auto']=='' ){         $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}
				if(!isset($_SESSION['boleta_eg_basicos']['idEstado']) or $_SESSION['boleta_eg_basicos']['idEstado']=='' ){             $error['idEstado']         = 'error/No ha seleccionado el estado';}
					
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la boleta de honorarios';
			}
			//productos o guias
			if (!isset($_SESSION['boleta_eg_servicios'])){
				$error['idProducto']   = 'error/No se han asignado servicios';
			}
			//Se verifican productos
			if (isset($_SESSION['boleta_eg_servicios'])){
				foreach ($_SESSION['boleta_eg_servicios'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No se han asignado servicios';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['boleta_eg_basicos']['idSistema']) && $_SESSION['boleta_eg_basicos']['idSistema'] != ''){    $a  = "'".$_SESSION['boleta_eg_basicos']['idSistema']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['boleta_eg_basicos']['idUsuario']) && $_SESSION['boleta_eg_basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['boleta_eg_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['idTipo']) && $_SESSION['boleta_eg_basicos']['idTipo'] != ''){          $a .= ",'".$_SESSION['boleta_eg_basicos']['idTipo']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['Creacion_fecha']) && $_SESSION['boleta_eg_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['boleta_eg_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['boleta_eg_basicos']['N_Doc']) && $_SESSION['boleta_eg_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['boleta_eg_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['Observaciones']) && $_SESSION['boleta_eg_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['boleta_eg_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['idCliente']) && $_SESSION['boleta_eg_basicos']['idCliente'] != ''){            $a .= ",'".$_SESSION['boleta_eg_basicos']['idCliente']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['idEstado']) && $_SESSION['boleta_eg_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['boleta_eg_basicos']['idEstado']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['fecha_auto']) && $_SESSION['boleta_eg_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['boleta_eg_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['valor_neto'])&&$_SESSION['boleta_eg_basicos']['valor_neto']!=''){              $a .= ",'".$_SESSION['boleta_eg_basicos']['valor_neto']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['valor_imp'])&&$_SESSION['boleta_eg_basicos']['valor_imp']!=''){                $a .= ",'".$_SESSION['boleta_eg_basicos']['valor_imp']."'";       }else{$a .= ",''";}
				if(isset($_SESSION['boleta_eg_basicos']['valor_total'])&&$_SESSION['boleta_eg_basicos']['valor_total']!=''){            $a .= ",'".$_SESSION['boleta_eg_basicos']['valor_total']."'";     }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `boleta_honorarios_facturacion` (idSistema, idUsuario, idTipo, Creacion_fecha,
				Creacion_Semana, Creacion_mes, Creacion_ano, N_Doc, Observaciones, idCliente, idEstado, fecha_auto,
				ValorNeto, Impuesto, ValorTotal) 
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
					//Se guardan los servicios
					if(isset($_SESSION['boleta_eg_servicios'])){		
						foreach ($_SESSION['boleta_eg_servicios'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                      $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['boleta_eg_basicos']['idSistema']) && $_SESSION['boleta_eg_basicos']['idSistema'] != ''){    $a .= ",'".$_SESSION['boleta_eg_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['boleta_eg_basicos']['idUsuario']) && $_SESSION['boleta_eg_basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['boleta_eg_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['boleta_eg_basicos']['idTipo']) && $_SESSION['boleta_eg_basicos']['idTipo'] != ''){          $a .= ",'".$_SESSION['boleta_eg_basicos']['idTipo']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['boleta_eg_basicos']['Creacion_fecha']) && $_SESSION['boleta_eg_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['boleta_eg_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;  }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){    $a .= ",'".$producto['vTotal']."'" ;  }else{$a .= ",''";}

							// inserto los datos de registro en la db
							$query  = "INSERT INTO `boleta_honorarios_facturacion_servicios` (idFacturacion, idSistema, idUsuario,
							idTipo, Creacion_fecha, Creacion_mes, Creacion_ano, Nombre, vTotal ) 
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
					if(isset($_SESSION['boleta_eg_archivos'])){
						foreach ($_SESSION['boleta_eg_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                   $a  = "'".$ultimo_id."'" ;                                   }else{$a  = "''";}
							if(isset($_SESSION['boleta_eg_basicos']['idSistema']) && $_SESSION['boleta_eg_basicos']['idSistema'] != ''){ $a .= ",'".$_SESSION['boleta_eg_basicos']['idSistema']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['boleta_eg_basicos']['idUsuario']) && $_SESSION['boleta_eg_basicos']['idUsuario'] != ''){ $a .= ",'".$_SESSION['boleta_eg_basicos']['idUsuario']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['boleta_eg_basicos']['idTipo']) && $_SESSION['boleta_eg_basicos']['idTipo'] != ''){       $a .= ",'".$_SESSION['boleta_eg_basicos']['idTipo']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['boleta_eg_basicos']['Creacion_fecha']) && $_SESSION['boleta_eg_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['boleta_eg_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['boleta_eg_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `boleta_honorarios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, idTipo, Creacion_fecha,
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
					if(isset($_SESSION['boleta_eg_basicos']['Creacion_fecha']) && $_SESSION['boleta_eg_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['boleta_eg_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `boleta_honorarios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['boleta_eg_basicos']);
					unset($_SESSION['boleta_eg_servicios']);
					unset($_SESSION['boleta_eg_temporal']);
					unset($_SESSION['boleta_eg_archivos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;

/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                    INGRESOS  EMPRESAS                                           */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_ingreso_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "idProveedor='".$idProveedor."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			if(isset($idOcompra)&&$idOcompra!=''){
				//Se verifica la existencia de la ocompra
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado', '', "idOcompra='".$idOcompra."' AND idEstado='2'", $dbConn);
				//se verifica si aun hay datos pendientes
				$ndata_3 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_boletas_empresas', '', "Valor>Total_Ingresado AND idOcompra = ".$idOcompra."", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			if(isset($idOcompra)&&$idOcompra!=''){
				if($ndata_2==0) {$error['ndata_2'] = 'error/La OC ingresada no esta aprobada o no existe, favor verificar';}
				if($ndata_3==0) {$error['ndata_3'] = 'error/No existen items pendientes dentro de la OC';}
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['boleta_ing_prov_basicos']);
				unset($_SESSION['boleta_ing_prov_servicios']);
				unset($_SESSION['boleta_ing_prov_temporal']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['boleta_ing_prov_archivos'])){
					foreach ($_SESSION['boleta_ing_prov_archivos'] as $key => $producto){
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
				unset($_SESSION['boleta_ing_prov_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['boleta_ing_prov_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['boleta_ing_prov_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['boleta_ing_prov_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['boleta_ing_prov_basicos']['idSistema']        = $idSistema;
				$_SESSION['boleta_ing_prov_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['boleta_ing_prov_basicos']['idTipo']           = $idTipo;
				$_SESSION['boleta_ing_prov_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['boleta_ing_prov_basicos']['idEstado']         = $idEstado;
				
				/*******************************************************/
				//Si existe una Orden de compra relacionada
				if(isset($idOcompra)&&$idOcompra!=''){
					
					$_SESSION['boleta_ing_prov_basicos']['idOcompra']        = $idOcompra;
					
					// Se trae un listado con todos las boletas de los trabajadores
					$arrBoletas = array();
					$query = "SELECT idExistencia, Descripcion, Valor, Total_Ingresado
					FROM `ocompra_listado_existencias_boletas_empresas` 
					WHERE Valor>Total_Ingresado 
					AND idOcompra = ".$idOcompra." ";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					array_push( $arrBoletas,$row );
					} 
					
					//Se guardan los datos
					$bvar = 1;
					foreach ($arrBoletas as $motivo){
						//se recorren los datos
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['idServicio']    = $bvar;
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['idExistencia']  = $motivo['idExistencia'];
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['Nombre']        = $motivo['Descripcion'];
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['vTotal']        = $motivo['Valor'] - $motivo['Total_Ingresado'];
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['Total_ing']     = $motivo['Total_Ingresado'];
						
						$bvar++;
					}
				
				}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `boleta_honorarios_facturacion_tipo`
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
					$_SESSION['boleta_ing_prov_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['boleta_ing_prov_basicos']['TipoDocumento'] = '';
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
					$_SESSION['boleta_ing_prov_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['boleta_ing_prov_basicos']['Proveedor'] = '';
				}
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['boleta_ing_prov_basicos']);
			unset($_SESSION['boleta_ing_prov_servicios']);
			unset($_SESSION['boleta_ing_prov_temporal']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['boleta_ing_prov_archivos'])){
				foreach ($_SESSION['boleta_ing_prov_archivos'] as $key => $producto){
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
			unset($_SESSION['boleta_ing_prov_archivos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($idProveedor)&&isset($N_Doc)){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "idProveedor='".$idProveedor."' AND N_Doc='".$N_Doc."'", $dbConn);
			}
			if(isset($idOcompra)&&$idOcompra!=''){
				//Se verifica la existencia de la ocompra
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado', '', "idOcompra='".$idOcompra."' AND idEstado='2'", $dbConn);
				//se verifica si aun hay datos pendientes
				$ndata_3 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_boletas_empresas', '', "Valor>Total_Ingresado AND idOcompra = ".$idOcompra."", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			if(isset($idOcompra)&&$idOcompra!=''){
				if($ndata_2==0) {$error['ndata_2'] = 'error/La OC ingresada no esta aprobada o no existe, favor verificar';}
				if($ndata_3==0) {$error['ndata_3'] = 'error/No existen items pendientes dentro de la OC';}
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['boleta_ing_prov_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['boleta_ing_prov_servicios']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['boleta_ing_prov_basicos']['idProveedor']      = $idProveedor;
				$_SESSION['boleta_ing_prov_basicos']['N_Doc']            = $N_Doc;
				$_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['boleta_ing_prov_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['boleta_ing_prov_basicos']['idSistema']        = $idSistema;
				$_SESSION['boleta_ing_prov_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['boleta_ing_prov_basicos']['idTipo']           = $idTipo;
				$_SESSION['boleta_ing_prov_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['boleta_ing_prov_basicos']['idEstado']         = $idEstado;
				
				/*******************************************************/
				//Si existe una Orden de compra relacionada
				if(isset($idOcompra)&&$idOcompra!=''){
					
					//se guarda la OC Relacionada
					$_SESSION['boleta_ing_prov_basicos']['idOcompra'] = $idOcompra;
					
					// Se trae un listado con todos las boletas de los trabajadores
					$arrBoletas = array();
					$query = "SELECT idExistencia, Descripcion, Valor, Total_Ingresado
					FROM `ocompra_listado_existencias_boletas_empresas` 
					WHERE Valor>Total_Ingresado 
					AND idOcompra = ".$idOcompra." ";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					array_push( $arrBoletas,$row );
					} 
					
					//Se guardan los datos
					$bvar = 1;
					foreach ($arrBoletas as $motivo){
						//se recorren los datos
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['idServicio']    = $bvar;
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['idExistencia']  = $motivo['idExistencia'];
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['Nombre']        = $motivo['Descripcion'];
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['vTotal']        = $motivo['Valor'] - $motivo['Total_Ingresado'];
						$_SESSION['boleta_ing_prov_servicios'][$bvar]['Total_ing']     = $motivo['Total_Ingresado'];
						
						$bvar++;
					}
				
				//si no existe se guarda vacia
				}else{
					$_SESSION['boleta_ing_prov_basicos']['idOcompra'] = '';
				}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `boleta_honorarios_facturacion_tipo`
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
					$_SESSION['boleta_ing_prov_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['boleta_ing_prov_basicos']['TipoDocumento'] = '';
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
					$_SESSION['boleta_ing_prov_basicos']['Proveedor'] = $rowProveedor['Nombre'];
				}else{
					$_SESSION['boleta_ing_prov_basicos']['Proveedor'] = '';
				}
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'new_servicio_ing_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['boleta_ing_prov_servicios'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['boleta_ing_prov_servicios'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['boleta_ing_prov_servicios'][$bvar]['idServicio']    = $bvar;
				$_SESSION['boleta_ing_prov_servicios'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['boleta_ing_prov_servicios'][$bvar]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_servicio_ing_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//se verifica la existencia de la OC 
			if(isset($_SESSION['boleta_ing_prov_basicos']['idOcompra'])&&$_SESSION['boleta_ing_prov_basicos']['idOcompra']!=''){
				//Se verifica si el dato existe
				if(isset($idExistencia)){
					$query  = "SELECT Valor, Total_Ingresado FROM ocompra_listado_existencias_boletas_empresas WHERE idExistencia='".$idExistencia."'";
					$result = mysqli_query($dbConn, $query);
					$rowOrden = mysqli_fetch_assoc ($result);		
				}
				//Comprovacion de cantidades
				if($rowOrden['Valor']<($rowOrden['Total_Ingresado']+$vTotal)){
					$error['ndata_1'] = 'error/El Valor que esta ingresando es superior al de la Orden de Compra';
				}
			}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['boleta_ing_prov_servicios'][$oldidProducto]['idServicio']    = $oldidProducto;
				$_SESSION['boleta_ing_prov_servicios'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['boleta_ing_prov_servicios'][$oldidProducto]['vTotal']        = $vTotal;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_servicio_ing_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['boleta_ing_prov_servicios'][$_GET['del_servicios']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'add_obs_ing_nd_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['boleta_ing_prov_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nd_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['boleta_ing_prov_temporal'] = $_SESSION['boleta_ing_prov_basicos']['Observaciones'];
			$_SESSION['boleta_ing_prov_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_file_ing_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['boleta_ing_prov_archivos'])){
				foreach ($_SESSION['boleta_ing_prov_archivos'] as $key => $trabajos){
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
						$sufijo = 'boletas_honorarios_ingreso_'.fecha_actual().'_';
					  
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
									$_SESSION['boleta_ing_prov_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['boleta_ing_prov_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
		case 'del_file_ing_emp':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['boleta_ing_prov_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['boleta_ing_prov_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['boleta_ing_prov_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

/*******************************************************************************************************************/		
		case 'ing_bodega_emp':
	
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$n_data1 = 0;
				
			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['boleta_ing_prov_basicos'])){
				if(!isset($_SESSION['boleta_ing_prov_basicos']['idProveedor']) or $_SESSION['boleta_ing_prov_basicos']['idProveedor']=='' ){       $error['idProveedor']      = 'error/No ha seleccionado el proveedor';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['N_Doc']) or $_SESSION['boleta_ing_prov_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']) or $_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la fecha de creacion';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['Observaciones']) or $_SESSION['boleta_ing_prov_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['idSistema']) or $_SESSION['boleta_ing_prov_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['idUsuario']) or $_SESSION['boleta_ing_prov_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['idTipo']) or $_SESSION['boleta_ing_prov_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de boleta';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['fecha_auto']) or $_SESSION['boleta_ing_prov_basicos']['fecha_auto']=='' ){         $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}
				if(!isset($_SESSION['boleta_ing_prov_basicos']['idEstado']) or $_SESSION['boleta_ing_prov_basicos']['idEstado']=='' ){             $error['idEstado']         = 'error/No ha seleccionado el estado';}
					
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la boleta de honorarios';
			}
			//productos o guias
			if (!isset($_SESSION['boleta_ing_prov_servicios'])){
				$error['idProducto']   = 'error/No se han asignado servicios';
			}
			//Se verifican productos
			if (isset($_SESSION['boleta_ing_prov_servicios'])){
				foreach ($_SESSION['boleta_ing_prov_servicios'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No se han asignado servicios';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['boleta_ing_prov_basicos']['idSistema']) && $_SESSION['boleta_ing_prov_basicos']['idSistema'] != ''){    $a  = "'".$_SESSION['boleta_ing_prov_basicos']['idSistema']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['idUsuario']) && $_SESSION['boleta_ing_prov_basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['idTipo']) && $_SESSION['boleta_ing_prov_basicos']['idTipo'] != ''){          $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idTipo']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['boleta_ing_prov_basicos']['N_Doc']) && $_SESSION['boleta_ing_prov_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['N_Doc']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['Observaciones']) && $_SESSION['boleta_ing_prov_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['idProveedor']) && $_SESSION['boleta_ing_prov_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idProveedor']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['idEstado']) && $_SESSION['boleta_ing_prov_basicos']['idEstado'] != ''){              $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idEstado']."'" ;       }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['fecha_auto']) && $_SESSION['boleta_ing_prov_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['valor_neto'])&&$_SESSION['boleta_ing_prov_basicos']['valor_neto']!=''){              $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['valor_neto']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['valor_imp'])&&$_SESSION['boleta_ing_prov_basicos']['valor_imp']!=''){                $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['valor_imp']."'";       }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['valor_total'])&&$_SESSION['boleta_ing_prov_basicos']['valor_total']!=''){            $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['valor_total']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['boleta_ing_prov_basicos']['idOcompra'])&&$_SESSION['boleta_ing_prov_basicos']['idOcompra']!=''){                $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idOcompra']."'";       }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `boleta_honorarios_facturacion` (idSistema, idUsuario, idTipo, Creacion_fecha,
				Creacion_Semana, Creacion_mes, Creacion_ano, N_Doc, Observaciones, idProveedor, idEstado, fecha_auto,
				ValorNeto, Impuesto, ValorTotal, idOcompra) 
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
					//Se guardan los servicios
					if(isset($_SESSION['boleta_ing_prov_servicios'])){		
						foreach ($_SESSION['boleta_ing_prov_servicios'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                        $a  = "'".$ultimo_id."'" ;                                     }else{$a  = "''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['idSistema']) && $_SESSION['boleta_ing_prov_basicos']['idSistema'] != ''){    $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['idUsuario']) && $_SESSION['boleta_ing_prov_basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['idTipo']) && $_SESSION['boleta_ing_prov_basicos']['idTipo'] != ''){          $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idTipo']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){              $a .= ",'".$producto['Nombre']."'" ;        }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){              $a .= ",'".$producto['vTotal']."'" ;        }else{$a .= ",''";}
							if(isset($producto['idExistencia']) && $producto['idExistencia'] != ''){  $a .= ",'".$producto['idExistencia']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `boleta_honorarios_facturacion_servicios` (idFacturacion, idSistema, idUsuario,
							idTipo, Creacion_fecha, Creacion_mes, Creacion_ano, Nombre, vTotal, idExistencia ) 
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
							//Si existe la OC se actualizan los estados de esta
							if(isset($_SESSION['boleta_ing_prov_basicos']['idOcompra']) && $_SESSION['boleta_ing_prov_basicos']['idOcompra'] != ''){  
								
								//calculo
								$nuevo_total = $producto['vTotal'] + $producto['Total_ing'];
								//Actualizo 
								$a = "Total_Ingresado='".$nuevo_total."'" ;
								
								// inserto los datos de registro en la db
								$query  = "UPDATE `ocompra_listado_existencias_boletas_empresas` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
								$result = mysqli_query($dbConn, $query);
								
							}
						}
					}
					
					/*********************************************************************/		
					//Archivos
					if(isset($_SESSION['boleta_ing_prov_archivos'])){
						foreach ($_SESSION['boleta_ing_prov_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                     $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['idSistema']) && $_SESSION['boleta_ing_prov_basicos']['idSistema'] != ''){ $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idSistema']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['idUsuario']) && $_SESSION['boleta_ing_prov_basicos']['idUsuario'] != ''){ $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idUsuario']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['idTipo']) && $_SESSION['boleta_ing_prov_basicos']['idTipo'] != ''){       $a .= ",'".$_SESSION['boleta_ing_prov_basicos']['idTipo']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `boleta_honorarios_facturacion_archivos` (idFacturacion, idSistema, idUsuario, idTipo, Creacion_fecha,
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
					if(isset($_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']) && $_SESSION['boleta_ing_prov_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['boleta_ing_prov_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                   //Creacion Satisfactoria
					$a .= ",'Creacion del documento'";                              //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'"; //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `boleta_honorarios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['boleta_ing_prov_basicos']);
					unset($_SESSION['boleta_ing_prov_servicios']);
					unset($_SESSION['boleta_ing_prov_temporal']);
					unset($_SESSION['boleta_ing_prov_archivos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;
/*******************************************************************************************************************/		
		case 'del_boleta':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($_GET['del'])&&$_GET['del']!=''){
				$ndata_1 = db_select_nrows ('idFacturacion', 'boleta_honorarios_facturacion', '', "WHERE idFacturacion='".$_GET['del']."' AND idEstado=2", $dbConn);
				$ndata_2 = db_select_nrows ('idPago', 'pagos_boletas_clientes', '', "idFacturacion='".$_GET['del']."'", $dbConn);
				$ndata_3 = db_select_nrows ('idPago', 'pagos_boletas_trabajadores', '', "idFacturacion='".$_GET['del']."'", $dbConn);
			}else{
				$error['del'] = 'error/No existe OC a eliminar';
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La boleta ya tiene pagos ingresados, primero reverse los pagos antes de eliminar la boleta';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El documento que trata de eliminar ya posee pagos relacionados';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El documento que trata de eliminar ya posee pagos relacionados';}
			
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/********************************************************/
				//Actualizo la OC
				$arrServicios = array();
				$query = "SELECT 
				boleta_honorarios_facturacion_servicios.idTipo, 
				boleta_honorarios_facturacion_servicios.vTotal,
				boleta_honorarios_facturacion_servicios.idExistencia,
				ocompra_listado_existencias_boletas_empresas.Total_Ingresado
				
				FROM `boleta_honorarios_facturacion_servicios` 
				LEFT JOIN `ocompra_listado_existencias_boletas_empresas`   ON ocompra_listado_existencias_boletas_empresas.idExistencia   = boleta_honorarios_facturacion_servicios.idExistencia
				WHERE boleta_honorarios_facturacion_servicios.idFacturacion = ".$_GET['del'];
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrServicios,$row );
				}
				
				foreach ($arrServicios as $serv) {
					if(isset($serv['idExistencia'])&&$serv['idExistencia']!=0){
						switch ($serv['idTipo']) {
							//Boleta Trabajadores
							case 1:
								$query  = "UPDATE `ocompra_listado_existencias_boletas` SET idUso='1' WHERE idExistencia = '".$serv['idExistencia']."'";
								$result = mysqli_query($dbConn, $query);
								break;
							//Boleta Clientes
							case 2:
								break;
							//Boleta Empresas
							case 3:
								//calculo
								$nuevo_total = $serv['Total_Ingresado'] - $serv['vTotal'];
								//Actualizo 
								$a = "Total_Ingresado='".$nuevo_total."'" ;
								// inserto los datos de registro en la db
								$query  = "UPDATE `ocompra_listado_existencias_boletas_empresas` SET ".$a." WHERE idExistencia = '".$serv['idExistencia']."'";
								$result = mysqli_query($dbConn, $query);
								break;
						}
					}
				}
				
				
				/********************************************************/
				// Se trae un listado con todos los archivos relacionados
				$arrArchivos = array();
				$query = "SELECT Nombre
				FROM `boleta_honorarios_facturacion_archivos` 
				WHERE idFacturacion = {$_GET['del']} ";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrArchivos,$row );
				}
				
				/********************************************************/
				//Se borran los archivos relacionados
				foreach ($arrArchivos as $archivo){
					try {
						if(!is_writable('upload/'.$archivo['Nombre'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$archivo['Nombre']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				/********************************************************/
				//se borran los datos
				$query  = "DELETE FROM `boleta_honorarios_facturacion` WHERE idFacturacion = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `boleta_honorarios_facturacion_archivos` WHERE idFacturacion = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `boleta_honorarios_facturacion_historial` WHERE idFacturacion = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `boleta_honorarios_facturacion_servicios` WHERE idFacturacion = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				
				//Redirijo			
				header( 'Location: '.$location.'&deleted=true' );
				die;
				
			}
			
	
		break;	
/*******************************************************************************************************************/
	}
?>
