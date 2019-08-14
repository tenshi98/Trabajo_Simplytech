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
	if ( !empty($_POST['idCotizacion']) )       $idCotizacion         = $_POST['idCotizacion'];
	if ( !empty($_POST['idSistema']) )          $idSistema            = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )          $idUsuario            = $_POST['idUsuario'];
	if ( !empty($_POST['idProspecto']) )        $idProspecto          = $_POST['idProspecto'];
	if ( !empty($_POST['Creacion_fecha']) )     $Creacion_fecha       = $_POST['Creacion_fecha'];
	if ( !empty($_POST['Creacion_mes']) )       $Creacion_mes         = $_POST['Creacion_mes'];
	if ( !empty($_POST['Creacion_ano']) )       $Creacion_ano         = $_POST['Creacion_ano'];
	if ( !empty($_POST['Observaciones']) )      $Observaciones        = $_POST['Observaciones'];
	
	if ( !empty($_POST['idProducto']) )         $idProducto           = $_POST['idProducto'];
	if ( !empty($_POST['Cantidad']) )           $Cantidad             = $_POST['Cantidad'];
	if ( !empty($_POST['oldidProducto']) )      $oldidProducto        = $_POST['oldidProducto'];
	if ( !empty($_POST['idEquipo']) )           $idEquipo             = $_POST['idEquipo'];
	if ( !empty($_POST['idFrecuencia']) )       $idFrecuencia         = $_POST['idFrecuencia'];
	if ( !empty($_POST['idServicio']) )         $idServicio           = $_POST['idServicio'];
	if ( !empty($_POST['Nombre']) )             $Nombre               = $_POST['Nombre'];
	if ( !empty($_POST['vUnitario']) )          $vUnitario            = $_POST['vUnitario'];
	if ( !empty($_POST['vTotal']) )             $vTotal               = $_POST['vTotal'];
	
	if ( !empty($_POST['idDocPago']) )          $idDocPago            = $_POST['idDocPago'];
	if ( !empty($_POST['NDocPago']) )           $NDocPago             = $_POST['NDocPago'];
	if ( !empty($_POST['Fpago']) )              $Fpago                = $_POST['Fpago'];
	
	if ( !empty($_POST['idExistencia']) )       $idExistencia         = $_POST['idExistencia'];
	if ( !empty($_POST['idDocumento']) )        $idDocumento          = $_POST['idDocumento'];
	if ( !empty($_POST['Creacion_semana']) )    $Creacion_semana      = $_POST['Creacion_semana'];
	
	if ( !empty($_POST['Observacion']) )        $Observacion          = $_POST['Observacion'];
	if ( !empty($_POST['idTipo']) )             $idTipo               = $_POST['idTipo'];
	if ( !empty($_POST['Creacion_hora']) )      $Creacion_hora        = $_POST['Creacion_hora'];
	if ( !empty($_POST['idImpuesto']) )         $idImpuesto           = $_POST['idImpuesto'];
	if ( !empty($_POST['fecha_auto']) )         $fecha_auto           = $_POST['fecha_auto'];
			
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
			case 'idCotizacion':      if(empty($idCotizacion)){     $error['idCotizacion']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':         if(empty($idSistema)){        $error['idSistema']       = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':         if(empty($idUsuario)){        $error['idUsuario']       = 'error/No ha seleccionado el usuario';}break;
			case 'idProspecto':       if(empty($idProspecto)){      $error['idProspecto']     = 'error/No ha seleccionado al proveedor';}break;
			case 'Creacion_fecha':    if(empty($Creacion_fecha)){   $error['Creacion_fecha']  = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Creacion_mes':      if(empty($Creacion_mes)){     $error['Creacion_mes']    = 'error/No ha ingresado el mes de creacion';}break;
			case 'Creacion_ano':      if(empty($Creacion_ano)){     $error['Creacion_ano']    = 'error/No ha ingresado el año de creacion';}break;
			case 'Observaciones':     if(empty($Observaciones)){    $error['Observaciones']   = 'error/No ha ingresado la observacion';}break;
			
			case 'idProducto':        if(empty($idProducto)){       $error['idProducto']      = 'error/No ha seleccionado el producto';}break;
			case 'Cantidad':          if(empty($Cantidad)){         $error['Cantidad']        = 'error/No ha ingresado la cantidad';}break;
			case 'oldidProducto':     if(empty($oldidProducto)){    $error['oldidProducto']   = 'error/No ha ingresado el producto';}break;
			case 'idEquipo':          if(empty($idEquipo)){         $error['idEquipo']        = 'error/No ha seleccionado el equipo';}break;
			case 'idFrecuencia':      if(empty($idFrecuencia)){     $error['idFrecuencia']    = 'error/No ha seleccionado la frecuencia';}break;
			case 'idServicio':        if(empty($idServicio)){       $error['idServicio']      = 'error/No ha seleccionado el servicio';}break;
			case 'Nombre':            if(empty($Nombre)){           $error['Nombre']          = 'error/No ha ingresado el Nombre';}break;
			case 'vUnitario':         if(empty($vUnitario)){        $error['vUnitario']       = 'error/No ha ingresado el Nombre';}break;
			case 'vTotal':            if(empty($vTotal)){           $error['vTotal']          = 'error/No ha ingresado el Nombre';}break;
			
			case 'idDocPago':         if(empty($idDocPago)){        $error['idDocPago']       = 'error/No ha seleccionado el documento';}break;
			case 'NDocPago':          if(empty($NDocPago)){         $error['NDocPago']        = 'error/No ha ingresado el numero de documento';}break;
			case 'Fpago':             if(empty($Fpago)){            $error['Fpago']           = 'error/No ha ingresado la fecha del documento';}break;
			
			case 'idExistencia':      if(empty($idExistencia)){     $error['idExistencia']    = 'error/No ha ingresado el id existencia';}break;
			case 'idDocumento':       if(empty($idDocumento)){      $error['idDocumento']     = 'error/No ha seleccionado el documento';}break;
			case 'Creacion_semana':   if(empty($Creacion_semana)){  $error['Creacion_semana'] = 'error/No ha ingresado la semana de creacion';}break;
			
			case 'Observacion':       if(empty($Observacion)){      $error['Observacion']     = 'error/No ha ingresado la Observacion';}break;
			case 'idTipo':            if(empty($idTipo)){           $error['idTipo']          = 'error/No ha ingresado el Tipo';}break;
			case 'Creacion_hora':     if(empty($Creacion_hora)){    $error['Creacion_hora']   = 'error/No ha ingresado la hora de creacion';}break;
			case 'idImpuesto':        if(empty($idImpuesto)){       $error['idImpuesto']      = 'error/No ha ingresado el impuesto';}break;
			case 'fecha_auto':        if(empty($fecha_auto)){       $error['fecha_auto']      = 'error/No ha ingresado la fecha de creacion';}break;
			
			
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
		case 'new_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin Condiciones Comerciales";}
				
				//Borro todas las sesiones
				unset($_SESSION['cotizacion_prospectos_basicos']);
				unset($_SESSION['cotizacion_prospectos_arriendos']);
				unset($_SESSION['cotizacion_prospectos_insumos']);
				unset($_SESSION['cotizacion_prospectos_productos']);
				unset($_SESSION['cotizacion_prospectos_servicios']);
				unset($_SESSION['cotizacion_prospectos_temporal']);
				unset($_SESSION['cotizacion_prospectos_impuestos']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['cotizacion_prospectos_archivos'])){
					foreach ($_SESSION['cotizacion_prospectos_archivos'] as $key => $producto){
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
				unset($_SESSION['cotizacion_prospectos_archivos']);
				
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['cotizacion_prospectos_basicos']['idSistema']       = $idSistema;
				$_SESSION['cotizacion_prospectos_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['cotizacion_prospectos_basicos']['Observaciones']   = $Observaciones;
				$_SESSION['cotizacion_prospectos_basicos']['idProspecto']     = $idProspecto;
				$_SESSION['cotizacion_prospectos_basicos']['fecha_auto']      = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['cotizacion_prospectos_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idUsuario) && $idUsuario != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `usuarios_listado`
					WHERE idUsuario = ".$idUsuario;
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if(!$resultado){
						//Genero numero aleatorio
						$vardata = genera_password(8,'alfanumerico');
										
						//Guardo el error en una variable temporal
						$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
						$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
						$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
					}
					$rowUsuario = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['cotizacion_prospectos_basicos']['Usuario'] = $rowUsuario['Nombre'];
				}else{
					$_SESSION['cotizacion_prospectos_basicos']['Usuario'] = '';
				}
				/********************************************************************************/
				if(isset($idProspecto) && $idProspecto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `prospectos_listado`
					WHERE idProspecto = ".$idProspecto;
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if(!$resultado){
						//Genero numero aleatorio
						$vardata = genera_password(8,'alfanumerico');
										
						//Guardo el error en una variable temporal
						$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
						$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
						$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
					}
					$rowProspecto = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['cotizacion_prospectos_basicos']['Prospecto'] = $rowProspecto['Nombre'];
				}else{
					$_SESSION['cotizacion_prospectos_basicos']['Prospecto'] = '';
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
				$_SESSION['cotizacion_prospectos_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['cotizacion_prospectos_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'clear_all_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cotizacion_prospectos_basicos']);
			unset($_SESSION['cotizacion_prospectos_arriendos']);
			unset($_SESSION['cotizacion_prospectos_insumos']);
			unset($_SESSION['cotizacion_prospectos_productos']);
			unset($_SESSION['cotizacion_prospectos_servicios']);
			unset($_SESSION['cotizacion_prospectos_temporal']);
			unset($_SESSION['cotizacion_prospectos_impuestos']);
				
			
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['cotizacion_prospectos_archivos'])){
				foreach ($_SESSION['cotizacion_prospectos_archivos'] as $key => $producto){
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
			unset($_SESSION['cotizacion_prospectos_archivos']);
					
			header( 'Location: '.$location );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'modBase_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['cotizacion_prospectos_basicos']['idSistema']       = $idSistema;
				$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['cotizacion_prospectos_basicos']['idProspecto']     = $idProspecto;
				$_SESSION['cotizacion_prospectos_basicos']['fecha_auto']      = $fecha_auto;
				
				//Se agrega el impuesto
				$_SESSION['cotizacion_prospectos_impuestos'][1]['idImpuesto'] = 1;
				
				/********************************************************************************/
				if(isset($idUsuario) && $idUsuario != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `usuarios_listado`
					WHERE idUsuario = ".$idUsuario;
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if(!$resultado){
						//Genero numero aleatorio
						$vardata = genera_password(8,'alfanumerico');
										
						//Guardo el error en una variable temporal
						$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
						$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
						$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
					}
					$rowUsuario = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['cotizacion_prospectos_basicos']['Usuario'] = $rowUsuario['Nombre'];
				}else{
					$_SESSION['cotizacion_prospectos_basicos']['Usuario'] = '';
				}
				/********************************************************************************/
				if(isset($idProspecto) && $idProspecto != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `prospectos_listado`
					WHERE idProspecto = ".$idProspecto;
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if(!$resultado){
						//Genero numero aleatorio
						$vardata = genera_password(8,'alfanumerico');
										
						//Guardo el error en una variable temporal
						$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
						$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
						$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
					}
					$rowProspecto = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['cotizacion_prospectos_basicos']['Prospecto'] = $rowProspecto['Nombre'];
				}else{
					$_SESSION['cotizacion_prospectos_basicos']['Prospecto'] = '';
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
				$_SESSION['cotizacion_prospectos_impuestos'][1]['Nombre']     = $rowImpuesto['Nombre'];
				$_SESSION['cotizacion_prospectos_impuestos'][1]['Porcentaje'] = $rowImpuesto['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
	
		break;			
/*******************************************************************************************************************/		
		case 'add_obs_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['cotizacion_prospectos_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['cotizacion_prospectos_temporal'] = $_SESSION['cotizacion_prospectos_basicos']['Observaciones'];
			$_SESSION['cotizacion_prospectos_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_prod_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['cotizacion_prospectos_productos'][$idProducto])&&$_SESSION['cotizacion_prospectos_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				productos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
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
				
				/*****************************************************************************/
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				productos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
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
				
				/*****************************************************************************/
				//Borro el producto
				unset($_SESSION['cotizacion_prospectos_productos'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_productos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cotizacion_prospectos_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_ins_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['cotizacion_prospectos_insumos'][$idProducto])&&$_SESSION['cotizacion_prospectos_insumos'][$idProducto]>0){
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
				
				/*****************************************************************************/
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_ins_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
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
				
				/*****************************************************************************/
				//Borro el producto
				unset($_SESSION['cotizacion_prospectos_insumos'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_insumos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_ins_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cotizacion_prospectos_insumos'][$_GET['del_ins']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;			
/*******************************************************************************************************************/		
		case 'new_arriendo_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['cotizacion_prospectos_arriendos'][$idEquipo])&&$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]>0){
				$error['productos'] = 'error/El arriendo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre
				FROM `equipos_arriendo_listado` 
				WHERE idEquipo=".$idEquipo;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				/***************************************/
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
				
				/*****************************************************************************/
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['idEquipo']      = $idEquipo;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['Cantidad']      = $Cantidad;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['vUnitario']     = $vUnitario;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['vTotal']        = $vTotal;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_arriendo_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				// Se traen los datos del producto
				$query = "SELECT Nombre
				FROM `equipos_arriendo_listado` 
				WHERE idEquipo=".$idEquipo;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				/***************************************/
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
				
				/*****************************************************************************/
				//Borro el producto
				unset($_SESSION['cotizacion_prospectos_arriendos'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['idEquipo']      = $idEquipo;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['Cantidad']      = $Cantidad;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['vUnitario']     = $vUnitario;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['vTotal']        = $vTotal;
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_arriendos'][$idEquipo]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_arriendo_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cotizacion_prospectos_arriendos'][$_GET['del_arriendo']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_servicio_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['cotizacion_prospectos_servicios'][$idServicio])&&$_SESSION['cotizacion_prospectos_servicios'][$idServicio]>0){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				/***************************************/
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
				
				/*****************************************************************************/
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['Cantidad']      = $Cantidad;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['vUnitario']     = $vUnitario;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['vTotal']        = $vTotal;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_servicio_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre
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
				$rowProducto = mysqli_fetch_assoc ($resultado);
				/***************************************/
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
				
				/*****************************************************************************/
				//Borro el producto
				unset($_SESSION['cotizacion_prospectos_servicios'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['Cantidad']      = $Cantidad;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['vUnitario']     = $vUnitario;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['vTotal']        = $vTotal;
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['cotizacion_prospectos_servicios'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_servicio_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cotizacion_prospectos_servicios'][$_GET['del_servicio']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;			
/*******************************************************************************************************************/		
		case 'new_file':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se inicializa variable
			$idInterno = 0;
			
			//verificar la cantidad de trabajos
			if(isset($_SESSION['cotizacion_prospectos_archivos'])){
				foreach ($_SESSION['cotizacion_prospectos_archivos'] as $key => $trabajos){
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
						$sufijo = 'cotizacion_prospectos_'.fecha_actual().'_';
					  
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
									$_SESSION['cotizacion_prospectos_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['cotizacion_prospectos_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			try {
				if(!is_writable('upload/'.$_SESSION['cotizacion_prospectos_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['cotizacion_prospectos_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['cotizacion_prospectos_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;
/*******************************************************************************************************************/		
		case 'new_impuesto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['cotizacion_prospectos_impuestos'][$idImpuesto])&&$_SESSION['cotizacion_prospectos_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['cotizacion_prospectos_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['cotizacion_prospectos_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'ing_cotizacion':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$valor       = 0;
			$count_zero  = 0;

			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['cotizacion_prospectos_basicos'])){
				if(!isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) or $_SESSION['cotizacion_prospectos_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) or $_SESSION['cotizacion_prospectos_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) or $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['cotizacion_prospectos_basicos']['Observaciones']) or $_SESSION['cotizacion_prospectos_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) or $_SESSION['cotizacion_prospectos_basicos']['idProspecto']=='' ){       $error['idProspecto']      = 'error/No ha seleccionado un proveedor';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la Cotizacion';
			}
			/*********************************************/
			//Se verifican arriendos
			if (isset($_SESSION['cotizacion_prospectos_arriendos'])){
				foreach ($_SESSION['cotizacion_prospectos_arriendos'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican insumos
			if (isset($_SESSION['cotizacion_prospectos_insumos'])){
				foreach ($_SESSION['cotizacion_prospectos_insumos'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican productos
			if (isset($_SESSION['cotizacion_prospectos_productos'])){
				foreach ($_SESSION['cotizacion_prospectos_productos'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican servicios
			if (isset($_SESSION['cotizacion_prospectos_servicios'])){
				foreach ($_SESSION['cotizacion_prospectos_servicios'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			/*********************************************/
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se ha asignado nada a solicitar';
			}
			/*********************************************/
			//Se verifica si hay alguna solicitud sin valor asignado
			if(isset($count_zero)&&$count_zero!=0){
				$error['count_zero'] = 'error/Existen Solicitudes con valor neto o total en 0, favor verificar';
			}
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) && $_SESSION['cotizacion_prospectos_basicos']['idSistema'] != ''){      $a  = "'".$_SESSION['cotizacion_prospectos_basicos']['idSistema']."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) && $_SESSION['cotizacion_prospectos_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) && $_SESSION['cotizacion_prospectos_basicos']['idProspecto'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idProspecto']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) && $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NMes($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['Observaciones']) && $_SESSION['cotizacion_prospectos_basicos']['Observaciones'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['fecha_auto']) && $_SESSION['cotizacion_prospectos_basicos']['fecha_auto'] != ''){        $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['vtotal_neto'])&&$_SESSION['cotizacion_prospectos_basicos']['vtotal_neto']!=''){          $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['vtotal_neto']."'";     }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_basicos']['vtotal_total'])&&$_SESSION['cotizacion_prospectos_basicos']['vtotal_total']!=''){        $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['vtotal_total']."'";    }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][1]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][1]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][1]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][2]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][2]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][2]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][3]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][3]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][3]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][4]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][4]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][4]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][5]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][5]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][5]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][6]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][6]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][6]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][7]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][7]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][7]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][8]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][8]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][8]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][9]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][9]['valor']!=''){            $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][9]['valor']."'";      }else{$a .= ",''";}
				if(isset($_SESSION['cotizacion_prospectos_impuestos'][10]['valor'])&&$_SESSION['cotizacion_prospectos_impuestos'][10]['valor']!=''){          $a .= ",'".$_SESSION['cotizacion_prospectos_impuestos'][10]['valor']."'";     }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cotizacion_prospectos_listado` (idSistema,idUsuario, idProspecto, Creacion_fecha, Creacion_mes,
				Creacion_ano, Observaciones, fecha_auto, ValorNetoImp, ValorTotal, Impuesto_01, Impuesto_02, Impuesto_03, Impuesto_04, 
				Impuesto_05, Impuesto_06, Impuesto_07, Impuesto_08, Impuesto_09, Impuesto_10 ) 
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
					//Insumos
					if(isset($_SESSION['cotizacion_prospectos_insumos'])){
						foreach ($_SESSION['cotizacion_prospectos_insumos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) && $_SESSION['cotizacion_prospectos_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) && $_SESSION['cotizacion_prospectos_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) && $_SESSION['cotizacion_prospectos_basicos']['idProspecto'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idProspecto']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) && $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){   $a .= ",'".$producto['idProducto']."'" ;   }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){       $a .= ",'".$producto['Cantidad']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vUnitario']) && $producto['vUnitario'] != ''){     $a .= ",'".$producto['vUnitario']."'" ;    }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){           $a .= ",'".$producto['vTotal']."'" ;       }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cotizacion_prospectos_listado_existencias_insumos` (idCotizacion, idSistema, idUsuario, idProspecto,Creacion_fecha,
							Creacion_mes, Creacion_ano, idProducto, Cantidad, vUnitario, vTotal) 
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
					//Productos
					if(isset($_SESSION['cotizacion_prospectos_productos'])){
						foreach ($_SESSION['cotizacion_prospectos_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) && $_SESSION['cotizacion_prospectos_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) && $_SESSION['cotizacion_prospectos_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) && $_SESSION['cotizacion_prospectos_basicos']['idProspecto'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idProspecto']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) && $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){   $a .= ",'".$producto['idProducto']."'" ;   }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){       $a .= ",'".$producto['Cantidad']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vUnitario']) && $producto['vUnitario'] != ''){     $a .= ",'".$producto['vUnitario']."'" ;    }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){           $a .= ",'".$producto['vTotal']."'" ;       }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cotizacion_prospectos_listado_existencias_productos` (idCotizacion, idSistema, idUsuario, idProspecto,Creacion_fecha,
							Creacion_mes, Creacion_ano, idProducto, Cantidad, vUnitario, vTotal) 
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
					//Arriendos
					if(isset($_SESSION['cotizacion_prospectos_arriendos'])){
						foreach ($_SESSION['cotizacion_prospectos_arriendos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) && $_SESSION['cotizacion_prospectos_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) && $_SESSION['cotizacion_prospectos_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) && $_SESSION['cotizacion_prospectos_basicos']['idProspecto'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idProspecto']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) && $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idEquipo']) && $producto['idEquipo'] != ''){           $a .= ",'".$producto['idEquipo']."'" ;      }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){           $a .= ",'".$producto['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){   $a .= ",'".$producto['idFrecuencia']."'" ;  }else{$a .= ",''";}
							if(isset($producto['vUnitario']) && $producto['vUnitario'] != ''){         $a .= ",'".$producto['vUnitario']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){               $a .= ",'".$producto['vTotal']."'" ;        }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cotizacion_prospectos_listado_existencias_arriendos` (idCotizacion, idSistema, idUsuario, idProspecto,Creacion_fecha,
							Creacion_mes, Creacion_ano, idEquipo, Cantidad, idFrecuencia, vUnitario, vTotal) 
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
					//Servicios
					if(isset($_SESSION['cotizacion_prospectos_servicios'])){
						foreach ($_SESSION['cotizacion_prospectos_servicios'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) && $_SESSION['cotizacion_prospectos_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) && $_SESSION['cotizacion_prospectos_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) && $_SESSION['cotizacion_prospectos_basicos']['idProspecto'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idProspecto']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) && $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){       $a .= ",'".$producto['idServicio']."'" ;    }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){           $a .= ",'".$producto['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){   $a .= ",'".$producto['idFrecuencia']."'" ;  }else{$a .= ",''";}
							if(isset($producto['vUnitario']) && $producto['vUnitario'] != ''){         $a .= ",'".$producto['vUnitario']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){               $a .= ",'".$producto['vTotal']."'" ;        }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cotizacion_prospectos_listado_existencias_servicios` (idCotizacion, idSistema, idUsuario, idProspecto,Creacion_fecha,
							Creacion_mes, Creacion_ano, idServicio, Cantidad, idFrecuencia, vUnitario, vTotal) 
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
					if(isset($_SESSION['cotizacion_prospectos_archivos'])){
						foreach ($_SESSION['cotizacion_prospectos_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idSistema']) && $_SESSION['cotizacion_prospectos_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idUsuario']) && $_SESSION['cotizacion_prospectos_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['idProspecto']) && $_SESSION['cotizacion_prospectos_basicos']['idProspecto'] != ''){  $a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['idProspecto']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']) && $_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['cotizacion_prospectos_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `cotizacion_prospectos_listado_archivos` (idCotizacion, idSistema, idUsuario, idProspecto,Creacion_fecha,
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
					//Borro todas las sesiones una vez grabados los datos
					unset($_SESSION['cotizacion_prospectos_basicos']);
					unset($_SESSION['cotizacion_prospectos_arriendos']);
					unset($_SESSION['cotizacion_prospectos_insumos']);
					unset($_SESSION['cotizacion_prospectos_productos']);
					unset($_SESSION['cotizacion_prospectos_servicios']);
					unset($_SESSION['cotizacion_prospectos_temporal']);
					unset($_SESSION['cotizacion_prospectos_archivos']);
					
				
					header( 'Location: '.$location.'&created=true' );
					die;
					
				}
				
			}	
	
		break;	
/*******************************************************************************************************************/
	
	}
?>
