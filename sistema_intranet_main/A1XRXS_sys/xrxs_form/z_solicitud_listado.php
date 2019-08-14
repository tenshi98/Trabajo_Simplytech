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
	if ( !empty($_POST['idSolicitud']) )        $idSolicitud          = $_POST['idSolicitud'];
	if ( !empty($_POST['idSistema']) )          $idSistema            = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )          $idUsuario            = $_POST['idUsuario'];
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
	
	if ( !empty($_POST['idProveedor']) )        $idProveedor          = $_POST['idProveedor'];
	if ( !empty($_POST['idExistencia']) )       $idExistencia         = $_POST['idExistencia'];
	
	if ( !empty($_POST['idEstado']) )           $idEstado             = $_POST['idEstado'];
	
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
			case 'idSolicitud':       if(empty($idSolicitud)){      $error['idSolicitud']     = 'error/No ha ingresado el id';}break;
			case 'idSistema':         if(empty($idSistema)){        $error['idSistema']       = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':         if(empty($idUsuario)){        $error['idUsuario']       = 'error/No ha seleccionado el usuario';}break;
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
			
			case 'idProveedor':       if(empty($idProveedor)){      $error['idProveedor']     = 'error/No ha seleccionado el Proveedor';}break;
			case 'idExistencia':      if(empty($idExistencia)){     $error['idExistencia']    = 'error/No ha seleccionado la Existencia';}break;
			
			case 'idEstado':          if(empty($idEstado)){         $error['idEstado']        = 'error/No ha seleccionado el Estado';}break;
			
			
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
		case 'new_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['solicitud_basicos']);
				unset($_SESSION['solicitud_arriendos']);
				unset($_SESSION['solicitud_insumos']);
				unset($_SESSION['solicitud_otros']);
				unset($_SESSION['solicitud_productos']);
				unset($_SESSION['solicitud_servicios']);
				unset($_SESSION['solicitud_temporal']);
				
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['solicitud_basicos']['idSistema']       = $idSistema;
				$_SESSION['solicitud_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['solicitud_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['solicitud_basicos']['Observaciones']   = $Observaciones;
				
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
					$_SESSION['solicitud_basicos']['Usuario'] = $rowUsuario['Nombre'];
				}else{
					$_SESSION['solicitud_basicos']['Usuario'] = '';
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'clear_all_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['solicitud_basicos']);
			unset($_SESSION['solicitud_arriendos']);
			unset($_SESSION['solicitud_insumos']);
			unset($_SESSION['solicitud_otros']);
			unset($_SESSION['solicitud_productos']);
			unset($_SESSION['solicitud_servicios']);
			unset($_SESSION['solicitud_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'modBase_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['solicitud_basicos']['idSistema']       = $idSistema;
				$_SESSION['solicitud_basicos']['Creacion_fecha']  = $Creacion_fecha;
				
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
					$_SESSION['solicitud_basicos']['Usuario'] = $rowUsuario['Nombre'];
				}else{
					$_SESSION['solicitud_basicos']['Usuario'] = '';
				}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
	
		break;			
/*******************************************************************************************************************/		
		case 'add_obs_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['solicitud_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['solicitud_temporal'] = $_SESSION['solicitud_basicos']['Observaciones'];
			$_SESSION['solicitud_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_prod_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['solicitud_productos'][$idProducto])&&$_SESSION['solicitud_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				productos_listado.Nombre,
				productos_listado.idProveedor,
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
				$_SESSION['solicitud_productos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['solicitud_productos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['solicitud_productos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['solicitud_productos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				$_SESSION['solicitud_productos'][$idProducto]['idProveedor'] = $rowProducto['idProveedor'];
							
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				// Se traen los datos del producto
				$query = "SELECT 
				productos_listado.Nombre,
				productos_listado.idProveedor,
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
				unset($_SESSION['solicitud_productos'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['solicitud_productos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['solicitud_productos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['solicitud_productos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['solicitud_productos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				$_SESSION['solicitud_productos'][$idProducto]['idProveedor'] = $rowProducto['idProveedor'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['solicitud_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_ins_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['solicitud_insumos'][$idProducto])&&$_SESSION['solicitud_insumos'][$idProducto]>0){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				insumos_listado.Nombre,
				insumos_listado.idProveedor,
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
				$_SESSION['solicitud_insumos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['solicitud_insumos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['solicitud_insumos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['solicitud_insumos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				$_SESSION['solicitud_insumos'][$idProducto]['idProveedor'] = $rowProducto['idProveedor'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_ins_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT 
				insumos_listado.Nombre,
				insumos_listado.idProveedor,
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
				unset($_SESSION['solicitud_insumos'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['solicitud_insumos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['solicitud_insumos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['solicitud_insumos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['solicitud_insumos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				$_SESSION['solicitud_insumos'][$idProducto]['idProveedor'] = $rowProducto['idProveedor'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_ins_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['solicitud_insumos'][$_GET['del_ins']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;			
/*******************************************************************************************************************/		
		case 'new_arriendo_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['solicitud_arriendos'][$idEquipo])&&$_SESSION['solicitud_arriendos'][$idEquipo]>0){
				$error['productos'] = 'error/El arriendo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre, idProveedor
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
				$_SESSION['solicitud_arriendos'][$idEquipo]['idEquipo']      = $idEquipo;
				$_SESSION['solicitud_arriendos'][$idEquipo]['Cantidad']      = $Cantidad;
				$_SESSION['solicitud_arriendos'][$idEquipo]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['solicitud_arriendos'][$idEquipo]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['solicitud_arriendos'][$idEquipo]['idProveedor']   = $rowProducto['idProveedor'];
				$_SESSION['solicitud_arriendos'][$idEquipo]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_arriendo_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre, idProveedor
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
				unset($_SESSION['solicitud_arriendos'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['solicitud_arriendos'][$idEquipo]['idEquipo']      = $idEquipo;
				$_SESSION['solicitud_arriendos'][$idEquipo]['Cantidad']      = $Cantidad;
				$_SESSION['solicitud_arriendos'][$idEquipo]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['solicitud_arriendos'][$idEquipo]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['solicitud_arriendos'][$idEquipo]['idProveedor']   = $rowProducto['idProveedor'];
				$_SESSION['solicitud_arriendos'][$idEquipo]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_arriendo_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['solicitud_arriendos'][$_GET['del_arriendo']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_servicio_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['solicitud_servicios'][$idServicio])&&$_SESSION['solicitud_servicios'][$idServicio]>0){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre, idProveedor
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
				$_SESSION['solicitud_servicios'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['solicitud_servicios'][$idServicio]['Cantidad']      = $Cantidad;
				$_SESSION['solicitud_servicios'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['solicitud_servicios'][$idServicio]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['solicitud_servicios'][$idServicio]['idProveedor']   = $rowProducto['idProveedor'];
				$_SESSION['solicitud_servicios'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_servicio_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los datos del producto
				$query = "SELECT Nombre, idProveedor
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
				unset($_SESSION['solicitud_servicios'][$oldidProducto]);
			
				//creo el producto
				$_SESSION['solicitud_servicios'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['solicitud_servicios'][$idServicio]['Cantidad']      = $Cantidad;
				$_SESSION['solicitud_servicios'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['solicitud_servicios'][$idServicio]['Nombre']        = $rowProducto['Nombre'];
				$_SESSION['solicitud_servicios'][$idServicio]['idProveedor']   = $rowProducto['idProveedor'];
				$_SESSION['solicitud_servicios'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_servicio_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['solicitud_servicios'][$_GET['del_servicio']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;			
/*******************************************************************************************************************/		
		case 'new_otros_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['solicitud_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['solicitud_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
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
				$_SESSION['solicitud_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['solicitud_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['solicitud_otros'][$bvar]['Cantidad']      = $Cantidad;
				$_SESSION['solicitud_otros'][$bvar]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['solicitud_otros'][$bvar]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_otros_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
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
				//creo el producto
				$_SESSION['solicitud_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['solicitud_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['solicitud_otros'][$oldidProducto]['Cantidad']      = $Cantidad;
				$_SESSION['solicitud_otros'][$oldidProducto]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['solicitud_otros'][$oldidProducto]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['solicitud_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;			

/*******************************************************************************************************************/		
		case 'ing_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$valor = 0;

			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['solicitud_basicos'])){
				if(!isset($_SESSION['solicitud_basicos']['idSistema']) or $_SESSION['solicitud_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['solicitud_basicos']['idUsuario']) or $_SESSION['solicitud_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['solicitud_basicos']['Creacion_fecha']) or $_SESSION['solicitud_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['solicitud_basicos']['Observaciones']) or $_SESSION['solicitud_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la solicitud';
			}
			/*********************************************/
			//Se verifican arriendos
			if (isset($_SESSION['solicitud_arriendos'])){
				foreach ($_SESSION['solicitud_arriendos'] as $key => $producto){
					$valor++;
				}
			}
			//Se verifican insumos
			if (isset($_SESSION['solicitud_insumos'])){
				foreach ($_SESSION['solicitud_insumos'] as $key => $producto){
					$valor++;
				}
			}
			//Se verifican otros
			if (isset($_SESSION['solicitud_otros'])){
				foreach ($_SESSION['solicitud_otros'] as $key => $producto){
					$valor++;
				}
			}
			//Se verifican productos
			if (isset($_SESSION['solicitud_productos'])){
				foreach ($_SESSION['solicitud_productos'] as $key => $producto){
					$valor++;
				}
			}
			//Se verifican servicios
			if (isset($_SESSION['solicitud_servicios'])){
				foreach ($_SESSION['solicitud_servicios'] as $key => $producto){
					$valor++;
				}
			}
			
			/*********************************************/
			//Se verifica el minimo de trabajos
			if(isset($valor)&&$valor==0){
				$error['trabajos'] = 'error/No se ha asignado nada a solicitar';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se guardan los datos basicos
				if(isset($_SESSION['solicitud_basicos']['idSistema']) && $_SESSION['solicitud_basicos']['idSistema'] != ''){      $a  = "'".$_SESSION['solicitud_basicos']['idSistema']."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['solicitud_basicos']['idUsuario']) && $_SESSION['solicitud_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['solicitud_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['solicitud_basicos']['Creacion_fecha']) && $_SESSION['solicitud_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['solicitud_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NMes($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['solicitud_basicos']['Observaciones']) && $_SESSION['solicitud_basicos']['Observaciones'] != ''){        $a .= ",'".$_SESSION['solicitud_basicos']['Observaciones']."'" ;        }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `solicitud_listado` (idSistema,idUsuario,Creacion_fecha, Creacion_mes,
				Creacion_ano, Observaciones ) 
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
					if(isset($_SESSION['solicitud_insumos'])){
						foreach ($_SESSION['solicitud_insumos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                              $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['solicitud_basicos']['idSistema']) && $_SESSION['solicitud_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['idUsuario']) && $_SESSION['solicitud_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['Creacion_fecha']) && $_SESSION['solicitud_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['solicitud_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){   $a .= ",'".$producto['idProducto']."'" ;   }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){       $a .= ",'".$producto['Cantidad']."'" ;     }else{$a .= ",''";}
							if(isset($producto['idProveedor']) && $producto['idProveedor'] != ''){ $a .= ",'".$producto['idProveedor']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `solicitud_listado_existencias_insumos` (idSolicitud, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, idProducto, Cantidad, idProveedor) 
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
					if(isset($_SESSION['solicitud_productos'])){
						foreach ($_SESSION['solicitud_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                              $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['solicitud_basicos']['idSistema']) && $_SESSION['solicitud_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['idUsuario']) && $_SESSION['solicitud_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['Creacion_fecha']) && $_SESSION['solicitud_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['solicitud_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idProducto']) && $producto['idProducto'] != ''){   $a .= ",'".$producto['idProducto']."'" ;   }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){       $a .= ",'".$producto['Cantidad']."'" ;     }else{$a .= ",''";}
							if(isset($producto['idProveedor']) && $producto['idProveedor'] != ''){ $a .= ",'".$producto['idProveedor']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `solicitud_listado_existencias_productos` (idSolicitud, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, idProducto, Cantidad, idProveedor) 
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
					if(isset($_SESSION['solicitud_arriendos'])){
						foreach ($_SESSION['solicitud_arriendos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                              $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['solicitud_basicos']['idSistema']) && $_SESSION['solicitud_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['idUsuario']) && $_SESSION['solicitud_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['Creacion_fecha']) && $_SESSION['solicitud_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['solicitud_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idEquipo']) && $producto['idEquipo'] != ''){           $a .= ",'".$producto['idEquipo']."'" ;      }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){           $a .= ",'".$producto['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){   $a .= ",'".$producto['idFrecuencia']."'" ;  }else{$a .= ",''";}
							if(isset($producto['idProveedor']) && $producto['idProveedor'] != ''){ $a .= ",'".$producto['idProveedor']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `solicitud_listado_existencias_arriendos` (idSolicitud, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, idEquipo, Cantidad, idFrecuencia, idProveedor) 
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
					if(isset($_SESSION['solicitud_servicios'])){
						foreach ($_SESSION['solicitud_servicios'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                              $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['solicitud_basicos']['idSistema']) && $_SESSION['solicitud_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['idUsuario']) && $_SESSION['solicitud_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['Creacion_fecha']) && $_SESSION['solicitud_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['solicitud_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idServicio']) && $producto['idServicio'] != ''){       $a .= ",'".$producto['idServicio']."'" ;    }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){           $a .= ",'".$producto['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){   $a .= ",'".$producto['idFrecuencia']."'" ;  }else{$a .= ",''";}
							if(isset($producto['idProveedor']) && $producto['idProveedor'] != ''){ $a .= ",'".$producto['idProveedor']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `solicitud_listado_existencias_servicios` (idSolicitud, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, idServicio, Cantidad, idFrecuencia, idProveedor) 
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
					//Otros
					if(isset($_SESSION['solicitud_otros'])){
						foreach ($_SESSION['solicitud_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                              $a  = "'".$ultimo_id."'" ;                                       }else{$a  = "''";}
							if(isset($_SESSION['solicitud_basicos']['idSistema']) && $_SESSION['solicitud_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['idUsuario']) && $_SESSION['solicitud_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['solicitud_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['solicitud_basicos']['Creacion_fecha']) && $_SESSION['solicitud_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['solicitud_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['solicitud_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){               $a .= ",'".$producto['Nombre']."'" ;        }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){           $a .= ",'".$producto['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){   $a .= ",'".$producto['idFrecuencia']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `solicitud_listado_existencias_otros` (idSolicitud, idSistema, idUsuario, Creacion_fecha,
							Creacion_mes, Creacion_ano, Nombre, Cantidad, idFrecuencia) 
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
					unset($_SESSION['solicitud_basicos']);
					unset($_SESSION['solicitud_arriendos']);
					unset($_SESSION['solicitud_insumos']);
					unset($_SESSION['solicitud_otros']);
					unset($_SESSION['solicitud_productos']);
					unset($_SESSION['solicitud_servicios']);
					unset($_SESSION['solicitud_temporal']);
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	
/*******************************************************************************************************************/		
		case 'edit_Productos':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				if(isset($idProveedor) && $idProveedor != ''){   $a = "idProveedor='".$idProveedor."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `solicitud_listado_existencias_productos` SET ".$a." WHERE idOcompra=0 AND idProducto='".$idProducto."' ";
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
		case 'edit_Insumos':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				if(isset($idProveedor) && $idProveedor != ''){   $a = "idProveedor='".$idProveedor."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `solicitud_listado_existencias_insumos` SET ".$a." WHERE idOcompra=0 AND idProducto='".$idProducto."' ";
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
		case 'edit_Arriendos':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				if(isset($idProveedor) && $idProveedor != ''){   $a = "idProveedor='".$idProveedor."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `solicitud_listado_existencias_arriendos` SET ".$a." WHERE idOcompra=0 AND idEquipo='".$idEquipo."' ";
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
		case 'edit_Servicios':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				if(isset($idProveedor) && $idProveedor != ''){   $a = "idProveedor='".$idProveedor."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `solicitud_listado_existencias_servicios` SET ".$a." WHERE idOcompra=0 AND idServicio='".$idServicio."' ";
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
		case 'edit_Otros':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				if(isset($idProveedor) && $idProveedor != ''){   $a = "idProveedor='".$idProveedor."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `solicitud_listado_existencias_otros` SET ".$a." WHERE idExistencia = '$idExistencia'";
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
		case 'crear_oc':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/**************************************************************/
				// Se trae un listado con todos los productos
				$arrProductos = array();
				$query = "SELECT 
				solicitud_listado_existencias_productos.idExistencia,
				solicitud_listado_existencias_productos.idSolicitud, 
				solicitud_listado_existencias_productos.idProducto, 
				solicitud_listado_existencias_productos.Cantidad,
				productos_listado.Nombre AS NombreProd,
				productos_listado.ValorIngreso AS Valor,
				core_sistemas.Nombre AS Sistema,
				sistema_productos_uml.Nombre AS Medida,
				solicitud_listado_existencias_productos.idProducto AS idProdSol

				FROM `solicitud_listado_existencias_productos` 
				LEFT JOIN `productos_listado`      ON productos_listado.idProducto   = solicitud_listado_existencias_productos.idProducto
				LEFT JOIN `core_sistemas`          ON core_sistemas.idSistema        = solicitud_listado_existencias_productos.idSistema
				LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml    = productos_listado.idUml
				WHERE solicitud_listado_existencias_productos.idOcompra=0 
				AND solicitud_listado_existencias_productos.idProveedor=".$idProveedor."";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
				// Se trae un listado con todos los insumos
				$arrInsumos = array();
				$query = "SELECT 
				solicitud_listado_existencias_insumos.idExistencia,
				solicitud_listado_existencias_insumos.idSolicitud, 
				solicitud_listado_existencias_insumos.idProducto, 
				solicitud_listado_existencias_insumos.Cantidad,
				insumos_listado.Nombre AS NombreProd,
				insumos_listado.ValorIngreso AS Valor,
				core_sistemas.Nombre AS Sistema,
				sistema_productos_uml.Nombre AS Medida,
				solicitud_listado_existencias_insumos.idProducto AS idProdSol

				FROM `solicitud_listado_existencias_insumos` 
				LEFT JOIN `insumos_listado`        ON insumos_listado.idProducto    = solicitud_listado_existencias_insumos.idProducto
				LEFT JOIN `core_sistemas`          ON core_sistemas.idSistema       = solicitud_listado_existencias_insumos.idSistema
				LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml   = insumos_listado.idUml
				WHERE solicitud_listado_existencias_insumos.idOcompra=0 
				AND solicitud_listado_existencias_insumos.idProveedor=".$idProveedor."";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrInsumos,$row );
				}

				// Se trae un listado con todos los maquinas arriendo
				$arrMaquinasArriendo = array();
				$query = "SELECT  
				solicitud_listado_existencias_arriendos.idExistencia,
				solicitud_listado_existencias_arriendos.idSolicitud, 
				solicitud_listado_existencias_arriendos.idEquipo,
				solicitud_listado_existencias_arriendos.Cantidad,
				solicitud_listado_existencias_arriendos.idFrecuencia,
				equipos_arriendo_listado.Nombre AS NombreProd,
				equipos_arriendo_listado.ValorIngreso AS Valor,
				core_sistemas.Nombre AS Sistema,
				core_tiempo_frecuencia.Nombre AS Medida,
				solicitud_listado_existencias_arriendos.idEquipo AS idProdSol

				FROM `solicitud_listado_existencias_arriendos` 
				LEFT JOIN `equipos_arriendo_listado`  ON equipos_arriendo_listado.idEquipo     = solicitud_listado_existencias_arriendos.idEquipo
				LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema               = solicitud_listado_existencias_arriendos.idSistema
				LEFT JOIN `core_tiempo_frecuencia`    ON core_tiempo_frecuencia.idFrecuencia   = solicitud_listado_existencias_arriendos.idFrecuencia
				WHERE solicitud_listado_existencias_arriendos.idOcompra=0 
				AND solicitud_listado_existencias_arriendos.idProveedor=".$idProveedor."";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrMaquinasArriendo,$row );
				}

				// Se trae un listado con todos los servicios
				$arrServicios = array();
				$query = "SELECT 
				solicitud_listado_existencias_servicios.idExistencia,
				solicitud_listado_existencias_servicios.idSolicitud,  
				solicitud_listado_existencias_servicios.idServicio, 
				solicitud_listado_existencias_servicios.Cantidad,
				solicitud_listado_existencias_servicios.idFrecuencia,
				servicios_listado.Nombre AS NombreProd,
				servicios_listado.ValorIngreso AS Valor,
				core_sistemas.Nombre AS Sistema,
				core_tiempo_frecuencia.Nombre AS Medida,
				solicitud_listado_existencias_servicios.idServicio AS idProdSol

				FROM `solicitud_listado_existencias_servicios` 
				LEFT JOIN `servicios_listado`         ON servicios_listado.idServicio           = solicitud_listado_existencias_servicios.idServicio
				LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema                = solicitud_listado_existencias_servicios.idSistema
				LEFT JOIN `core_tiempo_frecuencia`    ON core_tiempo_frecuencia.idFrecuencia    = solicitud_listado_existencias_servicios.idFrecuencia
				WHERE solicitud_listado_existencias_servicios.idOcompra=0 
				AND solicitud_listado_existencias_servicios.idProveedor=".$idProveedor."";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrServicios,$row );
				}	 

				// Se trae un listado con todos los otros
				$arrOtros = array();
				$query = "SELECT 
				solicitud_listado_existencias_otros.idExistencia,
				solicitud_listado_existencias_otros.idSolicitud, 
				solicitud_listado_existencias_otros.Cantidad,
				solicitud_listado_existencias_otros.Nombre AS NombreProd,
				solicitud_listado_existencias_otros.idFrecuencia,
				core_tiempo_frecuencia.Nombre AS Medida,
				core_sistemas.Nombre AS Sistema

				FROM `solicitud_listado_existencias_otros` 
				LEFT JOIN `core_tiempo_frecuencia`    ON core_tiempo_frecuencia.idFrecuencia   = solicitud_listado_existencias_otros.idFrecuencia
				LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema               = solicitud_listado_existencias_otros.idSistema
				WHERE solicitud_listado_existencias_otros.idOcompra=0 
				AND solicitud_listado_existencias_otros.idProveedor=".$idProveedor."";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrOtros,$row );
				}
				/**************************************************************/

				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="OC Generada a partir de Solicitudes";}
				
				//Borro todas las sesiones
				unset($_SESSION['ocompra_basicos']);
				unset($_SESSION['ocompra_arriendos']);
				unset($_SESSION['ocompra_insumos']);
				unset($_SESSION['ocompra_productos']);
				unset($_SESSION['ocompra_servicios']);
				unset($_SESSION['ocompra_temporal']);
				unset($_SESSION['ocompra_documentos']);
				unset($_SESSION['ocompra_archivos']);
				unset($_SESSION['ocompra_otros']);
				unset($_SESSION['ocompra_sol_rel']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ocompra_basicos']['idSistema']       = $idSistema;
				$_SESSION['ocompra_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['ocompra_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['ocompra_basicos']['Observaciones']   = $Observaciones;
				$_SESSION['ocompra_basicos']['idEstado']        = $idEstado;
				$_SESSION['ocompra_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['ocompra_basicos']['Solicitud']       = 1;
				
				/*************************************************************/
				//Productos
				foreach ($arrProductos as $prod) { 
					//Guardo los datos en variables
					$_SESSION['ocompra_productos'][$prod['idProducto']]['idProducto']  = $prod['idProducto'];
					$_SESSION['ocompra_productos'][$prod['idProducto']]['vUnitario']   = $prod['Valor'];
					if(isset($_SESSION['ocompra_productos'][$prod['idProducto']]['Cantidad'])){
						$_SESSION['ocompra_productos'][$prod['idProducto']]['Cantidad'] = $_SESSION['ocompra_productos'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
						$xcant = $_SESSION['ocompra_productos'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
					}else{
						$_SESSION['ocompra_productos'][$prod['idProducto']]['Cantidad'] = $prod['Cantidad'];
						$xcant = $prod['Cantidad'];
					}
					$_SESSION['ocompra_productos'][$prod['idProducto']]['vTotal']      = $prod['Valor']*$xcant;
				}
				/*************************************************************/
				//Insumos
				foreach ($arrInsumos as $prod) { 
					//Guardo los datos en variables
					$_SESSION['ocompra_insumos'][$prod['idProducto']]['idProducto']  = $prod['idProducto'];
					$_SESSION['ocompra_insumos'][$prod['idProducto']]['vUnitario']   = $prod['Valor'];
					if(isset($_SESSION['ocompra_insumos'][$prod['idProducto']]['Cantidad'])){
						$_SESSION['ocompra_insumos'][$prod['idProducto']]['Cantidad'] = $_SESSION['ocompra_insumos'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
						$xcant = $_SESSION['ocompra_insumos'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
					}else{
						$_SESSION['ocompra_insumos'][$prod['idProducto']]['Cantidad'] = $prod['Cantidad'];
						$xcant = $prod['Cantidad'];
					}
					$_SESSION['ocompra_insumos'][$prod['idProducto']]['vTotal']      = $prod['Valor']*$xcant;
				}
				/*************************************************************/
				//Arriendos
				foreach ($arrMaquinasArriendo as $prod) { 
					//Guardo los datos en variables
					$_SESSION['ocompra_arriendos'][$prod['idEquipo']]['idEquipo']      = $prod['idEquipo'];
					$_SESSION['ocompra_arriendos'][$prod['idEquipo']]['idFrecuencia']  = $prod['idFrecuencia'];
					$_SESSION['ocompra_arriendos'][$prod['idEquipo']]['vUnitario']     = $prod['Valor'];
					if(isset($_SESSION['ocompra_arriendos'][$prod['idProducto']]['Cantidad'])){
						$_SESSION['ocompra_arriendos'][$prod['idProducto']]['Cantidad'] = $_SESSION['ocompra_arriendos'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
						$xcant = $_SESSION['ocompra_arriendos'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
					}else{
						$_SESSION['ocompra_arriendos'][$prod['idProducto']]['Cantidad'] = $prod['Cantidad'];
						$xcant = $prod['Cantidad'];
					}
					$_SESSION['ocompra_arriendos'][$prod['idEquipo']]['vTotal']        = $prod['Valor']*$xcant;
				}
				/*************************************************************/
				//Servicios
				foreach ($arrServicios as $prod) { 
					//Guardo los datos en variables
					$_SESSION['ocompra_servicios'][$prod['idServicio']]['idServicio']    = $prod['idServicio'];
					$_SESSION['ocompra_servicios'][$prod['idServicio']]['idFrecuencia']  = $prod['idFrecuencia'];
					$_SESSION['ocompra_servicios'][$prod['idServicio']]['vUnitario']     = $prod['Valor'];
					if(isset($_SESSION['ocompra_servicios'][$prod['idProducto']]['Cantidad'])){
						$_SESSION['ocompra_servicios'][$prod['idProducto']]['Cantidad'] = $_SESSION['ocompra_servicios'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
						$xcant = $_SESSION['ocompra_servicios'][$prod['idProducto']]['Cantidad'] + $prod['Cantidad'];
					}else{
						$_SESSION['ocompra_servicios'][$prod['idProducto']]['Cantidad'] = $prod['Cantidad'];
						$xcant = $prod['Cantidad'];
					}
					$_SESSION['ocompra_servicios'][$prod['idServicio']]['vTotal']        = $prod['Valor']*$xcant;
				}
				/*************************************************************/
				//Otros
				$cantidad_x = 1;
				foreach ($arrOtros as $prod) { 
					//Guardo los datos en variables
					$_SESSION['ocompra_otros'][$cantidad_x]['idOtros']       = $cantidad_x;
					$_SESSION['ocompra_otros'][$cantidad_x]['Nombre']        = $prod['NombreProd'];
					$_SESSION['ocompra_otros'][$cantidad_x]['Cantidad']      = $prod['Cantidad'];
					$_SESSION['ocompra_otros'][$cantidad_x]['idFrecuencia']  = $prod['idFrecuencia'];
					$_SESSION['ocompra_otros'][$cantidad_x]['vUnitario']     = 0;
					$_SESSION['ocompra_otros'][$cantidad_x]['vTotal']        = 0;
					
					$cantidad_x++;
				}
				/*************************************************************/
				//Guardo en un arreglo las solicitudes relacionadas
				$bvar = 1;
				/************************************/
				//Productos
				foreach ($arrProductos as $prod) { 
					$_SESSION['ocompra_sol_rel'][$bvar]['Type']          = 1;
					$_SESSION['ocompra_sol_rel'][$bvar]['idExistencia']  = $prod['idExistencia'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Sistema']       = $prod['Sistema'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idSolicitud']   = $prod['idSolicitud'];
					$_SESSION['ocompra_sol_rel'][$bvar]['NombreProd']    = $prod['NombreProd'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Cantidad']      = $prod['Cantidad'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Medida']        = $prod['Medida'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idProdSol']     = $prod['idProdSol'];
					$_SESSION['ocompra_sol_rel'][$bvar]['bvar']          = $bvar;
					
					$bvar++;
				}
				/************************************/
				//Insumos
				foreach ($arrInsumos as $prod) { 
					$_SESSION['ocompra_sol_rel'][$bvar]['Type']          = 2;
					$_SESSION['ocompra_sol_rel'][$bvar]['idExistencia']  = $prod['idExistencia'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Sistema']       = $prod['Sistema'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idSolicitud']   = $prod['idSolicitud'];
					$_SESSION['ocompra_sol_rel'][$bvar]['NombreProd']    = $prod['NombreProd'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Cantidad']      = $prod['Cantidad'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Medida']        = $prod['Medida'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idProdSol']     = $prod['idProdSol'];
					$_SESSION['ocompra_sol_rel'][$bvar]['bvar']          = $bvar;
					
					$bvar++;
				}
				/************************************/
				//Arriendos
				foreach ($arrMaquinasArriendo as $prod) { 
					$_SESSION['ocompra_sol_rel'][$bvar]['Type']          = 3;
					$_SESSION['ocompra_sol_rel'][$bvar]['idExistencia']  = $prod['idExistencia'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Sistema']       = $prod['Sistema'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idSolicitud']   = $prod['idSolicitud'];
					$_SESSION['ocompra_sol_rel'][$bvar]['NombreProd']    = $prod['NombreProd'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Cantidad']      = $prod['Cantidad'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Medida']        = $prod['Medida'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idProdSol']     = $prod['idProdSol'];
					$_SESSION['ocompra_sol_rel'][$bvar]['bvar']          = $bvar;
					
					$bvar++;
				}
				/************************************/
				//Servicios
				foreach ($arrServicios as $prod) { 
					$_SESSION['ocompra_sol_rel'][$bvar]['Type']          = 4;
					$_SESSION['ocompra_sol_rel'][$bvar]['idExistencia']  = $prod['idExistencia'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Sistema']       = $prod['Sistema'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idSolicitud']   = $prod['idSolicitud'];
					$_SESSION['ocompra_sol_rel'][$bvar]['NombreProd']    = $prod['NombreProd'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Cantidad']      = $prod['Cantidad'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Medida']        = $prod['Medida'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idProdSol']     = $prod['idProdSol'];
					$_SESSION['ocompra_sol_rel'][$bvar]['bvar']          = $bvar;
					
					$bvar++;
				}
				/************************************/
				//Otros
				$cantidad_x = 1;
				foreach ($arrOtros as $prod) { 
					$_SESSION['ocompra_sol_rel'][$bvar]['Type']          = 5;
					$_SESSION['ocompra_sol_rel'][$bvar]['idExistencia']  = $prod['idExistencia'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Sistema']       = $prod['Sistema'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idSolicitud']   = $prod['idSolicitud'];
					$_SESSION['ocompra_sol_rel'][$bvar]['NombreProd']    = $prod['NombreProd'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Cantidad']      = $prod['Cantidad'];
					$_SESSION['ocompra_sol_rel'][$bvar]['Medida']        = $prod['Medida'];
					$_SESSION['ocompra_sol_rel'][$bvar]['idProdSol']     = $cantidad_x;
					$_SESSION['ocompra_sol_rel'][$bvar]['bvar']          = $bvar;
					
					$bvar++;
					$cantidad_x++;
				}
				
		

			
		
			
	
				
				
					
				//Redirijo a la pagina de las ordenes de compra
				header( 'Location: ocompra_listado.php?pagina=1&view=true&soli=true' );
				die;

			}
		
		
		break;
/*******************************************************************************************************************/
	}
?>
