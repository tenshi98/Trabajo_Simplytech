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
	if ( !empty($_POST['idOcompra']) )          $idOcompra            = $_POST['idOcompra'];
	if ( !empty($_POST['idSistema']) )          $idSistema            = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )          $idUsuario            = $_POST['idUsuario'];
	if ( !empty($_POST['idEstado']) )           $idEstado             = $_POST['idEstado'];
	if ( !empty($_POST['idProveedor']) )        $idProveedor          = $_POST['idProveedor'];
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
	
	if ( !empty($_POST['type']) )               $type                 = $_POST['type'];
	if ( !empty($_POST['CantComp']) )           $CantComp             = $_POST['CantComp'];
	if ( isset($_POST['cant_ingresada']) )      $cant_ingresada       = $_POST['cant_ingresada'];
	
	if ( !empty($_POST['idTrabajador']) )       $idTrabajador         = $_POST['idTrabajador'];
	if ( !empty($_POST['N_Doc']) )              $N_Doc                = $_POST['N_Doc'];
	if ( !empty($_POST['Descripcion']) )        $Descripcion          = $_POST['Descripcion'];
	if ( !empty($_POST['Valor']) )              $Valor                = $_POST['Valor'];
		


				
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
			case 'idOcompra':         if(empty($idOcompra)){        $error['idOcompra']       = 'error/No ha ingresado el id';}break;
			case 'idSistema':         if(empty($idSistema)){        $error['idSistema']       = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':         if(empty($idUsuario)){        $error['idUsuario']       = 'error/No ha seleccionado el usuario';}break;
			case 'idEstado':          if(empty($idEstado)){         $error['idEstado']        = 'error/No ha ingresado el estado';}break;
			case 'idProveedor':       if(empty($idProveedor)){      $error['idProveedor']     = 'error/No ha seleccionado al proveedor';}break;
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
		case 'new_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['ocompra_basicos']);
				unset($_SESSION['ocompra_arriendos']);
				unset($_SESSION['ocompra_insumos']);
				unset($_SESSION['ocompra_productos']);
				unset($_SESSION['ocompra_servicios']);
				unset($_SESSION['ocompra_temporal']);
				unset($_SESSION['ocompra_documentos']);
				unset($_SESSION['ocompra_otros']);
				unset($_SESSION['ocompra_boletas']);
				unset($_SESSION['ocompra_sol_rel']);
				
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['ocompra_archivos'])){
					foreach ($_SESSION['ocompra_archivos'] as $key => $producto){
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
				unset($_SESSION['ocompra_archivos']);
				
				//Se guarda el dato del proveedor
				$query = "SELECT Nombre
				FROM `proveedor_listado`
				WHERE idProveedor = {$idProveedor}";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowProveedor = mysqli_fetch_assoc ($resultado);
				
				// Se trae el usuario
				$query = "SELECT Nombre
				FROM `usuarios_listado`
				WHERE idUsuario = {$idUsuario}";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowUsuario = mysqli_fetch_assoc ($resultado);

				/*******************************************************************/
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ocompra_basicos']['idSistema']       = $idSistema;
				$_SESSION['ocompra_basicos']['idUsuario']       = $idUsuario;
				$_SESSION['ocompra_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['ocompra_basicos']['Observaciones']   = $Observaciones;
				$_SESSION['ocompra_basicos']['idEstado']        = $idEstado;
				$_SESSION['ocompra_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['ocompra_basicos']['Solicitud']       = 2;
				$_SESSION['ocompra_basicos']['Proveedor']       = $rowProveedor['Nombre'];
				$_SESSION['ocompra_basicos']['Usuario']         = $rowUsuario['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'clear_all_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_basicos']);
			unset($_SESSION['ocompra_arriendos']);
			unset($_SESSION['ocompra_insumos']);
			unset($_SESSION['ocompra_productos']);
			unset($_SESSION['ocompra_servicios']);
			unset($_SESSION['ocompra_temporal']);
			unset($_SESSION['ocompra_documentos']);
			unset($_SESSION['ocompra_otros']);
			unset($_SESSION['ocompra_boletas']);
			unset($_SESSION['ocompra_sol_rel']);
			
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['ocompra_archivos'])){
				foreach ($_SESSION['ocompra_archivos'] as $key => $producto){
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
			unset($_SESSION['ocompra_archivos']);
					
			header( 'Location: '.$location );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'modBase_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['insumos_ing_temporal']);
				
				//Se guarda el dato del proveedor
				$query = "SELECT Nombre
				FROM `proveedor_listado`
				WHERE idProveedor = {$idProveedor}";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowProveedor = mysqli_fetch_assoc ($resultado);
				
				// Se trae el usuario
				$query = "SELECT Nombre
				FROM `usuarios_listado`
				WHERE idUsuario = {$idUsuario}";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowUsuario = mysqli_fetch_assoc ($resultado);
				
				
				/*******************************************************************/
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ocompra_basicos']['idSistema']       = $idSistema;
				$_SESSION['ocompra_basicos']['Creacion_fecha']  = $Creacion_fecha;
				$_SESSION['ocompra_basicos']['idProveedor']     = $idProveedor;
				$_SESSION['ocompra_basicos']['Solicitud']       = 2;
				$_SESSION['ocompra_basicos']['Proveedor']       = $rowProveedor['Nombre'];
				$_SESSION['ocompra_basicos']['Usuario']         = $rowUsuario['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
	
		break;			
/*******************************************************************************************************************/		
		case 'add_obs_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['ocompra_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['ocompra_temporal'] = $_SESSION['ocompra_basicos']['Observaciones'];
			$_SESSION['ocompra_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_prod_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ocompra_productos'][$idProducto])&&$_SESSION['ocompra_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos del producto seleccionado
				$query = "SELECT 
				productos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE productos_listado.idProducto=".$idProducto;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowProducto = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_productos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['ocompra_productos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['ocompra_productos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['ocompra_productos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['ocompra_productos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['ocompra_productos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['ocompra_productos'][$oldidProducto]);
			
				//Se traen los datos del producto seleccionado
				$query = "SELECT 
				productos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `productos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = productos_listado.idUml
				WHERE productos_listado.idProducto=".$idProducto;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowProducto = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_productos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['ocompra_productos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['ocompra_productos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['ocompra_productos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['ocompra_productos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['ocompra_productos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_ins_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ocompra_insumos'][$idProducto])&&$_SESSION['ocompra_insumos'][$idProducto]>0){
				$error['productos'] = 'error/El insumo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos del producto seleccionado
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idProducto=".$idProducto;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowProducto = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_insumos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['ocompra_insumos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['ocompra_insumos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['ocompra_insumos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['ocompra_insumos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['ocompra_insumos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_ins_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['ocompra_insumos'][$oldidProducto]);
			
				//Se traen los datos del producto seleccionado
				$query = "SELECT 
				insumos_listado.idProducto, 
				insumos_listado.Nombre,
				sistema_productos_uml.Nombre AS Unimed
				FROM `insumos_listado` 
				LEFT JOIN `sistema_productos_uml` ON sistema_productos_uml.idUml = insumos_listado.idUml
				WHERE insumos_listado.idProducto=".$idProducto;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowProducto = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_insumos'][$idProducto]['idProducto']  = $idProducto;
				$_SESSION['ocompra_insumos'][$idProducto]['Cantidad']    = $Cantidad;
				$_SESSION['ocompra_insumos'][$idProducto]['vUnitario']   = $vUnitario;
				$_SESSION['ocompra_insumos'][$idProducto]['vTotal']      = $vTotal;
				$_SESSION['ocompra_insumos'][$idProducto]['Nombre']      = $rowProducto['Nombre'];
				$_SESSION['ocompra_insumos'][$idProducto]['Unimed']      = $rowProducto['Unimed'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_ins_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_insumos'][$_GET['del_ins']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;			
/*******************************************************************************************************************/		
		case 'new_arriendo_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ocompra_arriendos'][$idEquipo])&&$_SESSION['ocompra_arriendos'][$idEquipo]>0){
				$error['productos'] = 'error/El arriendo que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos del equipo a arrendar
				$query = "SELECT Nombre
				FROM `equipos_arriendo_listado` 
				WHERE idEquipo=".$idEquipo;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowEquipo = mysqli_fetch_assoc ($resultado);

				//Se traen los datos de la frecuencia
				$query = "SELECT Nombre
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_arriendos'][$idEquipo]['idEquipo']      = $idEquipo;
				$_SESSION['ocompra_arriendos'][$idEquipo]['Cantidad']      = $Cantidad;
				$_SESSION['ocompra_arriendos'][$idEquipo]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['ocompra_arriendos'][$idEquipo]['vUnitario']     = $vUnitario;
				$_SESSION['ocompra_arriendos'][$idEquipo]['vTotal']        = $vTotal;
				$_SESSION['ocompra_arriendos'][$idEquipo]['Equipo']        = $rowEquipo['Nombre'];
				$_SESSION['ocompra_arriendos'][$idEquipo]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_arriendo_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['ocompra_arriendos'][$oldidProducto]);
			
				//Se traen los datos del equipo a arrendar
				$query = "SELECT Nombre
				FROM `equipos_arriendo_listado` 
				WHERE idEquipo=".$idEquipo;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowEquipo = mysqli_fetch_assoc ($resultado);

				//Se traen los datos de la frecuencia
				$query = "SELECT Nombre
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);


				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_arriendos'][$idEquipo]['idEquipo']      = $idEquipo;
				$_SESSION['ocompra_arriendos'][$idEquipo]['Cantidad']      = $Cantidad;
				$_SESSION['ocompra_arriendos'][$idEquipo]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['ocompra_arriendos'][$idEquipo]['vUnitario']     = $vUnitario;
				$_SESSION['ocompra_arriendos'][$idEquipo]['vTotal']        = $vTotal;
				$_SESSION['ocompra_arriendos'][$idEquipo]['Equipo']        = $rowEquipo['Nombre'];
				$_SESSION['ocompra_arriendos'][$idEquipo]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_arriendo_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_arriendos'][$_GET['del_arriendo']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_servicio_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ocompra_servicios'][$idServicio])&&$_SESSION['ocompra_servicios'][$idServicio]>0){
				$error['productos'] = 'error/El servicio que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos del equipo a arrendar
				$query = "SELECT Nombre
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowServicio = mysqli_fetch_assoc ($resultado);

				//Se traen los datos de la frecuencia
				$query = "SELECT Nombre
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_servicios'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['ocompra_servicios'][$idServicio]['Cantidad']      = $Cantidad;
				$_SESSION['ocompra_servicios'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['ocompra_servicios'][$idServicio]['vUnitario']     = $vUnitario;
				$_SESSION['ocompra_servicios'][$idServicio]['vTotal']        = $vTotal;
				$_SESSION['ocompra_servicios'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['ocompra_servicios'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_servicio_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro el producto
				unset($_SESSION['ocompra_servicios'][$oldidProducto]);
			
				//Se traen los datos del equipo a arrendar
				$query = "SELECT Nombre
				FROM `servicios_listado` 
				WHERE idServicio=".$idServicio;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowServicio = mysqli_fetch_assoc ($resultado);

				//Se traen los datos de la frecuencia
				$query = "SELECT Nombre
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_servicios'][$idServicio]['idServicio']    = $idServicio;
				$_SESSION['ocompra_servicios'][$idServicio]['Cantidad']      = $Cantidad;
				$_SESSION['ocompra_servicios'][$idServicio]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['ocompra_servicios'][$idServicio]['vUnitario']     = $vUnitario;
				$_SESSION['ocompra_servicios'][$idServicio]['vTotal']        = $vTotal;
				$_SESSION['ocompra_servicios'][$idServicio]['Servicio']      = $rowServicio['Nombre'];
				$_SESSION['ocompra_servicios'][$idServicio]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_servicio_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_servicios'][$_GET['del_servicio']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_otros_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['ocompra_otros'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['ocompra_otros'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la frecuencia
				$query = "SELECT Nombre
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_otros'][$bvar]['idOtros']       = $bvar;
				$_SESSION['ocompra_otros'][$bvar]['Nombre']        = $Nombre;
				$_SESSION['ocompra_otros'][$bvar]['Cantidad']      = $Cantidad;
				$_SESSION['ocompra_otros'][$bvar]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['ocompra_otros'][$bvar]['vUnitario']     = $vUnitario;
				$_SESSION['ocompra_otros'][$bvar]['vTotal']        = $vTotal;
				$_SESSION['ocompra_otros'][$bvar]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_otros_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la frecuencia
				$query = "SELECT Nombre
				FROM `core_tiempo_frecuencia` 
				WHERE idFrecuencia=".$idFrecuencia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowFrecuencia = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_otros'][$oldidProducto]['idOtros']       = $oldidProducto;
				$_SESSION['ocompra_otros'][$oldidProducto]['Nombre']        = $Nombre;
				$_SESSION['ocompra_otros'][$oldidProducto]['Cantidad']      = $Cantidad;
				$_SESSION['ocompra_otros'][$oldidProducto]['idFrecuencia']  = $idFrecuencia;
				$_SESSION['ocompra_otros'][$oldidProducto]['vUnitario']     = $vUnitario;
				$_SESSION['ocompra_otros'][$oldidProducto]['vTotal']        = $vTotal;
				$_SESSION['ocompra_otros'][$oldidProducto]['Frecuencia']    = $rowFrecuencia['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_otros_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_otros'][$_GET['del_otros']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_boleta_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['ocompra_boletas'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['ocompra_boletas'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la frecuencia
				$query = "SELECT Rut, Nombre, ApellidoPat
				FROM `trabajadores_listado` 
				WHERE idTrabajador=".$idTrabajador;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowTrabajador = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_boletas'][$bvar]['idBoleta']      = $bvar;
				$_SESSION['ocompra_boletas'][$bvar]['idTrabajador']  = $idTrabajador;
				$_SESSION['ocompra_boletas'][$bvar]['N_Doc']         = $N_Doc;
				$_SESSION['ocompra_boletas'][$bvar]['Descripcion']   = $Descripcion;
				$_SESSION['ocompra_boletas'][$bvar]['Valor']         = $Valor;
				$_SESSION['ocompra_boletas'][$bvar]['trabajador']    = $rowTrabajador['Rut'].' - '.$rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_boleta_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se traen los datos de la frecuencia
				$query = "SELECT Rut, Nombre, ApellidoPat
				FROM `trabajadores_listado` 
				WHERE idTrabajador=".$idTrabajador;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowTrabajador = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_boletas'][$oldidProducto]['idBoleta']      = $bvar;
				$_SESSION['ocompra_boletas'][$oldidProducto]['idTrabajador']  = $idTrabajador;
				$_SESSION['ocompra_boletas'][$oldidProducto]['N_Doc']         = $N_Doc;
				$_SESSION['ocompra_boletas'][$oldidProducto]['Descripcion']   = $Descripcion;
				$_SESSION['ocompra_boletas'][$oldidProducto]['Valor']         = $Valor;
				$_SESSION['ocompra_boletas'][$oldidProducto]['trabajador']    = $rowTrabajador['Rut'].' - '.$rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_boleta_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_boletas'][$_GET['del_boleta']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_boleta_emp_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['ocompra_boletasEmp'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['ocompra_boletasEmp'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_boletasEmp'][$bvar]['idBoleta']      = $bvar;
				$_SESSION['ocompra_boletasEmp'][$bvar]['Descripcion']   = $Descripcion;
				$_SESSION['ocompra_boletasEmp'][$bvar]['Valor']         = $Valor;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_boleta_emp_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_boletasEmp'][$oldidProducto]['idBoleta']      = $bvar;
				$_SESSION['ocompra_boletasEmp'][$oldidProducto]['Descripcion']   = $Descripcion;
				$_SESSION['ocompra_boletasEmp'][$oldidProducto]['Valor']         = $Valor;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_boleta_emp_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_boletasEmp'][$_GET['del_boleta_emp']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_documentos_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verificar si existe algun otro dato
			if(!isset($_SESSION['ocompra_documentos'])){
				$bvar = 1;
			}else{
				$bvar = 1;
				foreach ($_SESSION['ocompra_documentos'] as $key => $producto){
					$bvar++;
				}	
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se trae un listado con todos los frecuencias
				$query = "SELECT Nombre
				FROM `sistema_documentos_pago` 
				WHERE idDocPago=".$idDocPago;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowDocumentos = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_documentos'][$bvar]['idDoc']       = $bvar;
				$_SESSION['ocompra_documentos'][$bvar]['idDocPago']   = $idDocPago;
				$_SESSION['ocompra_documentos'][$bvar]['NDocPago']    = $NDocPago;
				$_SESSION['ocompra_documentos'][$bvar]['Fpago']       = $Fpago;
				$_SESSION['ocompra_documentos'][$bvar]['vTotal']      = $vTotal;
				$_SESSION['ocompra_documentos'][$bvar]['DocPago']     = $rowDocumentos['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	
/*******************************************************************************************************************/		
		case 'edit_documentos_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se trae un listado con todos los frecuencias
				$query = "SELECT Nombre
				FROM `sistema_documentos_pago` 
				WHERE idDocPago=".$idDocPago;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowDocumentos = mysqli_fetch_assoc ($resultado);

				/*************************************************************************/
				//creo el producto
				$_SESSION['ocompra_documentos'][$oldidProducto]['idDoc']       = $oldidProducto;
				$_SESSION['ocompra_documentos'][$oldidProducto]['idDocPago']   = $idDocPago;
				$_SESSION['ocompra_documentos'][$oldidProducto]['NDocPago']    = $NDocPago;
				$_SESSION['ocompra_documentos'][$oldidProducto]['Fpago']       = $Fpago;
				$_SESSION['ocompra_documentos'][$oldidProducto]['vTotal']      = $vTotal;
				$_SESSION['ocompra_documentos'][$oldidProducto]['DocPago']     = $rowDocumentos['Nombre'];
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_documentos_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['ocompra_documentos'][$_GET['del_documento']]);
			
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
			if(isset($_SESSION['ocompra_archivos'])){
				foreach ($_SESSION['ocompra_archivos'] as $key => $trabajos){
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
						$sufijo = 'ocompra_'.fecha_actual().'_';
					  
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
									$_SESSION['ocompra_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['ocompra_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['ocompra_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['ocompra_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['ocompra_archivos'][$_GET['del_file']]);
				}
			}catch(Exception $e) { 
					//guardar el dato en un archivo log
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&view=true' );
			die;


		break;

	
		
/*******************************************************************************************************************/		
		case 'ing_ocompra':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			/*********************************************************************/
			//variables
			$valor       = 0;
			$count_zero  = 0;

			//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['ocompra_basicos'])){
				if(!isset($_SESSION['ocompra_basicos']['idSistema']) or $_SESSION['ocompra_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['ocompra_basicos']['idUsuario']) or $_SESSION['ocompra_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['ocompra_basicos']['Creacion_fecha']) or $_SESSION['ocompra_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}
				if(!isset($_SESSION['ocompra_basicos']['Observaciones']) or $_SESSION['ocompra_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['ocompra_basicos']['idProveedor']) or $_SESSION['ocompra_basicos']['idProveedor']=='' ){       $error['idProveedor']      = 'error/No ha seleccionado un proveedor';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a la Orden de Compra';
			}
			/*********************************************/
			//Se verifican arriendos
			if (isset($_SESSION['ocompra_arriendos'])){
				foreach ($_SESSION['ocompra_arriendos'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican insumos
			if (isset($_SESSION['ocompra_insumos'])){
				foreach ($_SESSION['ocompra_insumos'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican productos
			if (isset($_SESSION['ocompra_productos'])){
				foreach ($_SESSION['ocompra_productos'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican servicios
			if (isset($_SESSION['ocompra_servicios'])){
				foreach ($_SESSION['ocompra_servicios'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican otros
			if (isset($_SESSION['ocompra_otros'])){
				foreach ($_SESSION['ocompra_otros'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['vUnitario'])&&$producto['vUnitario']==0){$count_zero++;}
					if(isset($producto['vTotal'])&&$producto['vTotal']==0){$count_zero++;}
				}
			}
			//Se verifican boletas trabajadores
			if (isset($_SESSION['ocompra_boletas'])){
				foreach ($_SESSION['ocompra_boletas'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['Valor'])&&$producto['Valor']==0){$count_zero++;}
				}
			}
			//Se verifican boletas empresas
			if (isset($_SESSION['ocompra_boletasEmp'])){
				foreach ($_SESSION['ocompra_boletasEmp'] as $key => $producto){
					$valor++;
					//Se verifican valores en 0
					if(isset($producto['Valor'])&&$producto['Valor']==0){$count_zero++;}
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
				if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a  = "'".$_SESSION['ocompra_basicos']['idSistema']."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['ocompra_basicos']['Observaciones']) && $_SESSION['ocompra_basicos']['Observaciones'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['Observaciones']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['ocompra_basicos']['Solicitud']) && $_SESSION['ocompra_basicos']['Solicitud'] != ''){                $a .= ",'".$_SESSION['ocompra_basicos']['Solicitud']."'" ;            }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado` (idSistema,idUsuario,idEstado, idProveedor, Creacion_fecha, Creacion_mes,
				Creacion_ano, Observaciones, Solicitud ) 
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
					if(isset($_SESSION['ocompra_insumos'])){
						foreach ($_SESSION['ocompra_insumos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
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
							$query  = "INSERT INTO `ocompra_listado_existencias_insumos` (idOcompra, idSistema, idUsuario, idEstado, idProveedor,Creacion_fecha,
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
					if(isset($_SESSION['ocompra_productos'])){
						foreach ($_SESSION['ocompra_productos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
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
							$query  = "INSERT INTO `ocompra_listado_existencias_productos` (idOcompra, idSistema, idUsuario, idEstado, idProveedor,Creacion_fecha,
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
					if(isset($_SESSION['ocompra_arriendos'])){
						foreach ($_SESSION['ocompra_arriendos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
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
							$query  = "INSERT INTO `ocompra_listado_existencias_arriendos` (idOcompra, idSistema, idUsuario, idEstado, idProveedor,Creacion_fecha,
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
					if(isset($_SESSION['ocompra_servicios'])){
						foreach ($_SESSION['ocompra_servicios'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
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
							$query  = "INSERT INTO `ocompra_listado_existencias_servicios` (idOcompra, idSistema, idUsuario, idEstado, idProveedor,Creacion_fecha,
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
					//Otros
					if(isset($_SESSION['ocompra_otros'])){
						foreach ($_SESSION['ocompra_otros'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){               $a .= ",'".$producto['Nombre']."'" ;        }else{$a .= ",''";}
							if(isset($producto['Cantidad']) && $producto['Cantidad'] != ''){           $a .= ",'".$producto['Cantidad']."'" ;      }else{$a .= ",''";}
							if(isset($producto['idFrecuencia']) && $producto['idFrecuencia'] != ''){   $a .= ",'".$producto['idFrecuencia']."'" ;  }else{$a .= ",''";}
							if(isset($producto['vUnitario']) && $producto['vUnitario'] != ''){         $a .= ",'".$producto['vUnitario']."'" ;     }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){               $a .= ",'".$producto['vTotal']."'" ;        }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `ocompra_listado_existencias_otros` (idOcompra, idSistema, idUsuario, idEstado, idProveedor, 
							Creacion_fecha, Creacion_mes, Creacion_ano, Nombre, Cantidad, idFrecuencia, vUnitario, vTotal) 
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
					//Boletas Trabajadores
					if(isset($_SESSION['ocompra_boletas'])){
						foreach ($_SESSION['ocompra_boletas'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idTrabajador']) && $producto['idTrabajador'] != ''){  $a .= ",'".$producto['idTrabajador']."'" ;   }else{$a .= ",''";}
							if(isset($producto['N_Doc']) && $producto['N_Doc'] != ''){                $a .= ",'".$producto['N_Doc']."'" ;          }else{$a .= ",''";}
							if(isset($producto['Descripcion']) && $producto['Descripcion'] != ''){    $a .= ",'".$producto['Descripcion']."'" ;    }else{$a .= ",''";}
							if(isset($producto['Valor']) && $producto['Valor'] != ''){                $a .= ",'".$producto['Valor']."'" ;          }else{$a .= ",''";}
							$a .= ",'1'" ; //no utilizado
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `ocompra_listado_existencias_boletas` (idOcompra, idSistema, idUsuario, 
							Creacion_fecha, Creacion_mes, Creacion_ano, idTrabajador, N_Doc, Descripcion, Valor, idUso) 
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
					//Boletas Empresas
					if(isset($_SESSION['ocompra_boletasEmp'])){
						foreach ($_SESSION['ocompra_boletasEmp'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Descripcion']) && $producto['Descripcion'] != ''){    $a .= ",'".$producto['Descripcion']."'" ;    }else{$a .= ",''";}
							if(isset($producto['Valor']) && $producto['Valor'] != ''){                $a .= ",'".$producto['Valor']."'" ;          }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `ocompra_listado_existencias_boletas_empresas` (idOcompra, idSistema, idUsuario, 
							Creacion_fecha, Creacion_mes, Creacion_ano, Descripcion, Valor) 
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
					//Documentos
					if(isset($_SESSION['ocompra_documentos'])){
						foreach ($_SESSION['ocompra_documentos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2NSemana($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['idDocPago']) && $producto['idDocPago'] != ''){    $a .= ",'".$producto['idDocPago']."'" ;     }else{$a .= ",''";}
							if(isset($producto['NDocPago']) && $producto['NDocPago'] != ''){      $a .= ",'".$producto['NDocPago']."'" ;      }else{$a .= ",''";}
							if(isset($producto['Fpago']) && $producto['Fpago'] != ''){            $a .= ",'".$producto['Fpago']."'" ;         }else{$a .= ",''";}
							if(isset($producto['vTotal']) && $producto['vTotal'] != ''){          $a .= ",'".$producto['vTotal']."'" ;        }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `ocompra_listado_documentos` (idOcompra, idSistema, idUsuario, idEstado, idProveedor,Creacion_fecha,
							Creacion_mes, Creacion_ano, Creacion_semana, idDocPago, NDocPago, Fpago, vTotal) 
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
					if(isset($_SESSION['ocompra_archivos'])){
						foreach ($_SESSION['ocompra_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `ocompra_listado_archivos` (idOcompra, idSistema, idUsuario, idEstado, idProveedor,Creacion_fecha,
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
					//Solicitudes Relacionadas
					if(isset($_SESSION['ocompra_sol_rel'])){
						foreach ($_SESSION['ocompra_sol_rel'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
							if(isset($_SESSION['ocompra_basicos']['idSistema']) && $_SESSION['ocompra_basicos']['idSistema'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idSistema']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idUsuario']) && $_SESSION['ocompra_basicos']['idUsuario'] != ''){      $a .= ",'".$_SESSION['ocompra_basicos']['idUsuario']."'" ;    }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idEstado']) && $_SESSION['ocompra_basicos']['idEstado'] != ''){        $a .= ",'".$_SESSION['ocompra_basicos']['idEstado']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['idProveedor']) && $_SESSION['ocompra_basicos']['idProveedor'] != ''){  $a .= ",'".$_SESSION['ocompra_basicos']['idProveedor']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['ocompra_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Type']) && $producto['Type'] != ''){                  $a .= ",'".$producto['Type']."'" ;          }else{$a .= ",''";}
							if(isset($producto['idExistencia']) && $producto['idExistencia'] != ''){  $a .= ",'".$producto['idExistencia']."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `ocompra_listado_sol_rel` (idOcompra, idSistema, idUsuario, idEstado, idProveedor, 
							Creacion_fecha, Creacion_mes, Creacion_ano, Type, idExistencia) 
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
							
							/****************************************************************/
							//Dato a Actualizar
							$a = "idOcompra='".$ultimo_id."'" ;
									
							//Actualizar OC en las tablas de solicitudes
							switch ($producto['Type']) {
								/****************************************/
								//Productos
								case 1:
									// inserto los datos de registro en la db
									$query  = "UPDATE `solicitud_listado_existencias_productos` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if(!$resultado){
										//Genero numero aleatorio
										$vardata = genera_password(8,'alfanumerico');
										
										//Guardo el error en una variable temporal
										$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
										$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
										$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
									}
									break;
								/****************************************/
								//Insumos
								case 2:
									// inserto los datos de registro en la db
									$query  = "UPDATE `solicitud_listado_existencias_insumos` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if(!$resultado){
										//Genero numero aleatorio
										$vardata = genera_password(8,'alfanumerico');
										
										//Guardo el error en una variable temporal
										$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
										$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
										$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
									}
									break;
								/****************************************/
								//Arriendos
								case 3:
									// inserto los datos de registro en la db
									$query  = "UPDATE `solicitud_listado_existencias_arriendos` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if(!$resultado){
										//Genero numero aleatorio
										$vardata = genera_password(8,'alfanumerico');
										
										//Guardo el error en una variable temporal
										$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
										$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
										$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
									}
									break;
								/****************************************/
								//Servicios
								case 4:
									// inserto los datos de registro en la db
									$query  = "UPDATE `solicitud_listado_existencias_servicios` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if(!$resultado){
										//Genero numero aleatorio
										$vardata = genera_password(8,'alfanumerico');
										
										//Guardo el error en una variable temporal
										$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
										$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
										$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
									}
									break;
								/****************************************/
								//Otros
								case 5:
									// inserto los datos de registro en la db
									$query  = "UPDATE `solicitud_listado_existencias_otros` SET ".$a." WHERE idExistencia = '".$producto['idExistencia']."'";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if(!$resultado){
										//Genero numero aleatorio
										$vardata = genera_password(8,'alfanumerico');
										
										//Guardo el error en una variable temporal
										$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
										$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
										$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
									}
									break;
							}
							
							
						}
					}
					/*********************************************************************/		
					//Se guarda en historial la accion
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;  }else{$a  = "''";}
					if(isset($_SESSION['ocompra_basicos']['Creacion_fecha']) && $_SESSION['ocompra_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['ocompra_basicos']['Creacion_fecha']."'" ;  
					}else{
						$a .= ",''";
					}
					$a .= ",'1'";                                                                                            //Creacion Satisfactoria
					$a .= ",'Creacion de la Orden de Compra N°".n_doc($ultimo_id, 5).", queda en espera de aprobacion'";     //Observacion
					$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";                                          //idUsuario
					
								
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
					unset($_SESSION['ocompra_basicos']);
					unset($_SESSION['ocompra_arriendos']);
					unset($_SESSION['ocompra_insumos']);
					unset($_SESSION['ocompra_productos']);
					unset($_SESSION['ocompra_servicios']);
					unset($_SESSION['ocompra_otros']);
					unset($_SESSION['ocompra_boletas']);
					unset($_SESSION['ocompra_temporal']);
					unset($_SESSION['ocompra_documentos']);
					unset($_SESSION['ocompra_sol_rel']);
					unset($_SESSION['ocompra_archivos']);
					
				
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	
		break;	
/*******************************************************************************************************************/		
		case 'del_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Verifico el tipo
				switch ($_GET['del_sol_type']) {
					/****************************************/
					//Productos
					case 1:
						//realizo la resta
						$_SESSION['ocompra_productos'][$_GET['del_sol_prod']]['Cantidad'] = $_SESSION['ocompra_productos'][$_GET['del_sol_prod']]['Cantidad'] - $_GET['del_sol_cant'];
						
						//Elimino en caso de que quede en 0
						if($_SESSION['ocompra_productos'][$_GET['del_sol_prod']]['Cantidad']==0){
							//Borro todas las sesiones
							unset($_SESSION['ocompra_productos'][$_GET['del_sol_prod']]);
						//Sino Actualizo valores
						}else{
							$Cantidad = $_SESSION['ocompra_productos'][$_GET['del_sol_prod']]['Cantidad'];
							$vUnitario = $_SESSION['ocompra_productos'][$_GET['del_sol_prod']]['vUnitario'];
							$_SESSION['ocompra_productos'][$_GET['del_sol_prod']]['vTotal'] = $Cantidad * $vUnitario;
						}
						break;
					/****************************************/
					//Insumos
					case 2:
						$_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]['Cantidad'] = $_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]['Cantidad'] - $_GET['del_sol_cant'];
						
						//Elimino en caso de que quede en 0
						if($_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]['Cantidad']==0){
							//Borro todas las sesiones
							unset($_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]);
						//Sino Actualizo valores
						}else{
							$Cantidad = $_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]['Cantidad'];
							$vUnitario = $_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]['vUnitario'];
							$_SESSION['ocompra_insumos'][$_GET['del_sol_prod']]['vTotal'] = $Cantidad * $vUnitario;
						}
						break;
					/****************************************/
					//Arriendos
					case 3:
						$_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]['Cantidad'] = $_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]['Cantidad'] - $_GET['del_sol_cant'];
						
						//Elimino en caso de que quede en 0
						if($_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]['Cantidad']==0){
							//Borro todas las sesiones
							unset($_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]);
						//Sino Actualizo valores
						}else{
							$Cantidad = $_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]['Cantidad'];
							$vUnitario = $_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]['vUnitario'];
							$_SESSION['ocompra_arriendos'][$_GET['del_sol_prod']]['vTotal'] = $Cantidad * $vUnitario;
						}
						break;
					/****************************************/
					//Servicios
					case 4:
						$_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]['Cantidad'] = $_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]['Cantidad'] - $_GET['del_sol_cant'];
						
						//Elimino en caso de que quede en 0
						if($_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]['Cantidad']==0){
							//Borro todas las sesiones
							unset($_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]);
						//Sino Actualizo valores
						}else{
							$Cantidad = $_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]['Cantidad'];
							$vUnitario = $_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]['vUnitario'];
							$_SESSION['ocompra_servicios'][$_GET['del_sol_prod']]['vTotal'] = $Cantidad * $vUnitario;
						}
						break;
					/****************************************/
					//Otros
					case 5:
						unset($_SESSION['ocompra_otros'][$_GET['del_sol_prod']]);

						break;
				}
				
				//Borro todas las sesiones
				unset($_SESSION['ocompra_sol_rel'][$_GET['del_solicitud']]);
				
				//Redirijo
				header( 'Location: '.$location.'&view=true' );
				die;	
				
			}
		
		
		break;	





/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                     MODIFICACION                                                */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'update_ocompra':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT 
				proveedor_listado.Nombre AS Proveedor,
				ocompra_listado.idProveedor,
				ocompra_listado.Creacion_fecha,
				ocompra_listado.Observaciones
				
				FROM `ocompra_listado`
				LEFT JOIN `proveedor_listado`    ON proveedor_listado.idProveedor   = ocompra_listado.idProveedor

				WHERE ocompra_listado.idOcompra = '$idOcompra' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				
				//Se toman los datos
				$query = "SELECT Nombre FROM `proveedor_listado` WHERE idProveedor = '$idProveedor' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se realizan cambios en los datos basicos de la OC ';
				if(isset($idProveedor)&&isset($rowdata_1['idProveedor'])&&$idProveedor!=$rowdata_1['idProveedor']){               $cambios .= ",se cambia proveedor de ".$rowdata_1['Proveedor']." a ".$rowdata_2['Nombre']." " ;}
				if(isset($Creacion_fecha)&&isset($rowdata_1['Creacion_fecha'])&&$Creacion_fecha!=$rowdata_1['Creacion_fecha']){   $cambios .= ",se cambia fecha de ".$rowdata_1['Creacion_fecha']." a ".$Creacion_fecha."" ;}
				if(isset($Observaciones)&&isset($rowdata_1['Observaciones'])&&$Observaciones!=$rowdata_1['Observaciones']){       $cambios .= ",se cambia observacion " ;}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/	
				
				//Filtros
				$a = "idOcompra='".$idOcompra."'" ;
				if(isset($idSistema) && $idSistema != ''){        $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){        $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){          $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){    $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($Observaciones) && $Observaciones != ''){   $a .= ",Observaciones='".$Observaciones."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado` SET ".$a." WHERE idOcompra = '$idOcompra'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
/*******************************************************************************************************************/		
		case 'edit_prod_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idProducto)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_productos', '', "idOcompra='".$idOcompra."' AND idProducto='".$idProducto."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Producto ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idProducto) && $idProducto != ''){            $a .= ",'".$idProducto."'" ;  }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;    }else{$a .=",''";}
				if(isset($vUnitario) && $vUnitario != ''){              $a .= ",'".$vUnitario."'" ;   }else{$a .=",''";}
				if(isset($vTotal) && $vTotal != ''){                    $a .= ",'".$vTotal."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_productos` (idOcompra, idSistema, 
				idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, 
				idProducto, Cantidad, vUnitario, vTotal) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `productos_listado` WHERE idProducto = '$idProducto' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){    
					$cambios .= "Se agrega producto ".$rowdata['Nombre']." por una cantidad de ".$Cantidad." con valor total de ".Valores($vTotal, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/	
				
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_prod_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idProducto)&&isset($idExistencia)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_productos', '', "idOcompra='".$idOcompra."' AND idProducto='".$idProducto."' AND idExistencia!='".$idExistencia."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Producto ya existe';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `productos_listado` WHERE idProducto = '$idProducto' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				ocompra_listado_existencias_productos.Cantidad,
				ocompra_listado_existencias_productos.vTotal,
				productos_listado.Nombre AS Producto
				FROM `ocompra_listado_existencias_productos` 
				LEFT JOIN `productos_listado` ON productos_listado.idProducto = ocompra_listado_existencias_productos.idProducto
				WHERE ocompra_listado_existencias_productos.idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia de '.$rowdata_2['Producto'].' por una cantidad de '.Cantidades_decimales_justos($rowdata_2['Cantidad']).' con un valor total de '.Valores($rowdata_2['vTotal'], 0).'';
				$cambios.= '<br/>a '.$rowdata_1['Nombre'].' por una cantidad de '.$Cantidad.' con un valor total de '.Valores($vTotal, 0).'';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){   $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($idProducto) && $idProducto != ''){   $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){       $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($vUnitario) && $vUnitario != ''){     $a .= ",vUnitario='".$vUnitario."'" ;}
				if(isset($vTotal) && $vTotal != ''){           $a .= ",vTotal='".$vTotal."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_prod_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			ocompra_listado_existencias_productos.idOcompra,
			ocompra_listado_existencias_productos.Cantidad,
			ocompra_listado_existencias_productos.vTotal,
			productos_listado.Nombre AS Producto
			FROM `ocompra_listado_existencias_productos` 
			LEFT JOIN `productos_listado` ON productos_listado.idProducto = ocompra_listado_existencias_productos.idProducto
			WHERE ocompra_listado_existencias_productos.idExistencia = '".$_GET['del_prod']."' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina '.$rowdata_2['Producto'].' por una cantidad de '.Cantidades_decimales_justos($rowdata_2['Cantidad']).' con un valor total de '.Valores($rowdata_2['vTotal'], 0).'';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha     = fecha_actual();
			$idOcompra = $rowdata_2['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_productos` WHERE idExistencia = {$_GET['del_prod']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_ins_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idProducto)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_insumos', '', "idOcompra='".$idOcompra."' AND idProducto='".$idProducto."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Producto ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idProducto) && $idProducto != ''){            $a .= ",'".$idProducto."'" ;  }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;    }else{$a .=",''";}
				if(isset($vUnitario) && $vUnitario != ''){              $a .= ",'".$vUnitario."'" ;   }else{$a .=",''";}
				if(isset($vTotal) && $vTotal != ''){                    $a .= ",'".$vTotal."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_insumos` (idOcompra, idSistema, 
				idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, 
				idProducto, Cantidad, vUnitario, vTotal) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `insumos_listado` WHERE idProducto = '$idProducto' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){    
					$cambios .= "Se agrega insumo ".$rowdata['Nombre']." por una cantidad de ".$Cantidad." con valor total de ".Valores($vTotal, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                                      //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/	
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_ins_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idProducto)&&isset($idExistencia)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_insumos', '', "idOcompra='".$idOcompra."' AND idProducto='".$idProducto."' AND idExistencia!='".$idExistencia."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Producto ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `insumos_listado` WHERE idProducto = '$idProducto' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				ocompra_listado_existencias_insumos.Cantidad, 
				ocompra_listado_existencias_insumos.vTotal,
				insumos_listado.Nombre AS Producto
				FROM `ocompra_listado_existencias_insumos` 
				LEFT JOIN `insumos_listado` ON insumos_listado.idProducto = ocompra_listado_existencias_insumos.idProducto
				WHERE ocompra_listado_existencias_insumos.idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia de '.$rowdata_2['Producto'].' por una cantidad de '.Cantidades_decimales_justos($rowdata_2['Cantidad']).' con un valor total de '.Valores($rowdata_2['vTotal'], 0).'';
				$cambios.= '<br/>a '.$rowdata_1['Nombre'].' por una cantidad de '.$Cantidad.' con un valor total de '.Valores($vTotal, 0).'';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                                      //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){   $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($idProducto) && $idProducto != ''){   $a .= ",idProducto='".$idProducto."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){       $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($vUnitario) && $vUnitario != ''){     $a .= ",vUnitario='".$vUnitario."'" ;}
				if(isset($vTotal) && $vTotal != ''){           $a .= ",vTotal='".$vTotal."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_ins_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			ocompra_listado_existencias_insumos.idOcompra,
			ocompra_listado_existencias_insumos.Cantidad, 
			ocompra_listado_existencias_insumos.vTotal,
			insumos_listado.Nombre AS Producto
			FROM `ocompra_listado_existencias_insumos` 
			LEFT JOIN `insumos_listado` ON insumos_listado.idProducto = ocompra_listado_existencias_insumos.idProducto
			WHERE ocompra_listado_existencias_insumos.idExistencia = '".$_GET['del_ins']."' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina '.$rowdata_2['Producto'].' por una cantidad de '.Cantidades_decimales_justos($rowdata_2['Cantidad']).' con un valor total de '.Valores($rowdata_2['vTotal'], 0).'';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha     = fecha_actual();
			$idOcompra = $rowdata_2['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                                      //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_insumos` WHERE idExistencia = {$_GET['del_ins']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_arriendo_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idEquipo)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_arriendos', '', "idOcompra='".$idOcompra."' AND idEquipo='".$idEquipo."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Arriendo ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idEquipo) && $idEquipo != ''){                $a .= ",'".$idEquipo."'" ;      }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;      }else{$a .=",''";}
				if(isset($idFrecuencia) && $idFrecuencia != ''){        $a .= ",'".$idFrecuencia."'" ;  }else{$a .=",''";}
				if(isset($vUnitario) && $vUnitario != ''){              $a .= ",'".$vUnitario."'" ;     }else{$a .=",''";}
				if(isset($vTotal) && $vTotal != ''){                    $a .= ",'".$vTotal."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_arriendos` (idOcompra, idSistema, 
				idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, 
				idEquipo, Cantidad, idFrecuencia, vUnitario, vTotal) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `equipos_arriendo_listado` WHERE idEquipo = '$idEquipo' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				$query = "SELECT Nombre FROM `core_tiempo_frecuencia` WHERE idFrecuencia = '$idFrecuencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata_1['Nombre'])&&$rowdata_1['Nombre']!=''&&isset($rowdata_2['Nombre'])&&$rowdata_2['Nombre']!=''){    
					$cambios .= "Se agrega arriendo ".$rowdata_1['Nombre']." por ".$Cantidad." ".$rowdata_2['Nombre']." con valor total de ".Valores($vTotal, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                                      //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_arriendo_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idEquipo)&&isset($idExistencia)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_arriendos', '', "idOcompra='".$idOcompra."' AND idEquipo='".$idEquipo."' AND idExistencia!='".$idExistencia."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Arriendo ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `equipos_arriendo_listado` WHERE idEquipo = '$idEquipo' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT Nombre FROM `core_tiempo_frecuencia` WHERE idFrecuencia = '$idFrecuencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				ocompra_listado_existencias_arriendos.Cantidad, 
				ocompra_listado_existencias_arriendos.vTotal,
				equipos_arriendo_listado.Nombre AS Producto,
				core_tiempo_frecuencia.Nombre AS Frecuencia
				FROM `ocompra_listado_existencias_arriendos` 
				LEFT JOIN `equipos_arriendo_listado` ON equipos_arriendo_listado.idEquipo   = ocompra_listado_existencias_arriendos.idEquipo
				LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia = ocompra_listado_existencias_arriendos.idFrecuencia
				WHERE ocompra_listado_existencias_arriendos.idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia de '.$rowdata_3['Producto'].' por '.Cantidades_decimales_justos($rowdata_3['Cantidad']).' '.$rowdata_3['Frecuencia'].' con un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				$cambios.= '<br/>a '.$rowdata_1['Nombre'].' por '.$Cantidad.' '.$rowdata_2['Nombre'].' con un valor total de '.Valores($vTotal, 0).'';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){   $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($idEquipo) && $idEquipo != ''){             $a .= ",idEquipo='".$idEquipo."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){             $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($idFrecuencia) && $idFrecuencia != ''){     $a .= ",idFrecuencia='".$idFrecuencia."'" ;}
				if(isset($vUnitario) && $vUnitario != ''){           $a .= ",vUnitario='".$vUnitario."'" ;}
				if(isset($vTotal) && $vTotal != ''){                 $a .= ",vTotal='".$vTotal."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_arriendo_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			ocompra_listado_existencias_arriendos.idOcompra,
			ocompra_listado_existencias_arriendos.Cantidad, 
			ocompra_listado_existencias_arriendos.vTotal,
			equipos_arriendo_listado.Nombre AS Producto,
			core_tiempo_frecuencia.Nombre AS Frecuencia
			FROM `ocompra_listado_existencias_arriendos` 
			LEFT JOIN `equipos_arriendo_listado` ON equipos_arriendo_listado.idEquipo   = ocompra_listado_existencias_arriendos.idEquipo
			LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia = ocompra_listado_existencias_arriendos.idFrecuencia
			WHERE ocompra_listado_existencias_arriendos.idExistencia = '".$_GET['del_arriendo']."' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina '.$rowdata_3['Producto'].' por '.Cantidades_decimales_justos($rowdata_3['Cantidad']).' '.$rowdata_3['Frecuencia'].' con un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha     = fecha_actual();
			$idOcompra = $rowdata_3['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_arriendos` WHERE idExistencia = {$_GET['del_arriendo']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_servicio_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idServicio)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_servicios', '', "idOcompra='".$idOcompra."' AND idServicio='".$idServicio."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Servicio ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idServicio) && $idServicio != ''){            $a .= ",'".$idServicio."'" ;    }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;      }else{$a .=",''";}
				if(isset($idFrecuencia) && $idFrecuencia != ''){        $a .= ",'".$idFrecuencia."'" ;  }else{$a .=",''";}
				if(isset($vUnitario) && $vUnitario != ''){              $a .= ",'".$vUnitario."'" ;     }else{$a .=",''";}
				if(isset($vTotal) && $vTotal != ''){                    $a .= ",'".$vTotal."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_servicios` (idOcompra, idSistema, 
				idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, 
				idServicio, Cantidad, idFrecuencia, vUnitario, vTotal) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `servicios_listado` WHERE idServicio = '$idServicio' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				$query = "SELECT Nombre FROM `core_tiempo_frecuencia` WHERE idFrecuencia = '$idFrecuencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata_1['Nombre'])&&$rowdata_1['Nombre']!=''&&isset($rowdata_2['Nombre'])&&$rowdata_2['Nombre']!=''){    
					$cambios .= "Se agrega servicio ".$rowdata_1['Nombre']." por ".$Cantidad." ".$rowdata_2['Nombre']." con valor total de ".Valores($vTotal, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                                      //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_servicio_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&isset($idServicio)&&isset($idExistencia)){
				$ndata_1 = db_select_nrows ('idExistencia', 'ocompra_listado_existencias_servicios', '', "idOcompra='".$idOcompra."' AND idServicio='".$idServicio."' AND idExistencia!='".$idExistencia."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Servicio ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `servicios_listado` WHERE idServicio = '$idServicio' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_1 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT Nombre FROM `core_tiempo_frecuencia` WHERE idFrecuencia = '$idFrecuencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				ocompra_listado_existencias_servicios.idServicio,
				ocompra_listado_existencias_servicios.idFrecuencia,
				ocompra_listado_existencias_servicios.Cantidad, 
				ocompra_listado_existencias_servicios.vTotal,
				servicios_listado.Nombre AS Producto,
				core_tiempo_frecuencia.Nombre AS Frecuencia
				FROM `ocompra_listado_existencias_servicios` 
				LEFT JOIN `servicios_listado`        ON servicios_listado.idServicio         = ocompra_listado_existencias_servicios.idServicio
				LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia  = ocompra_listado_existencias_servicios.idFrecuencia
				WHERE ocompra_listado_existencias_servicios.idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia de '.$rowdata_3['Producto'].' por '.Cantidades_decimales_justos($rowdata_3['Cantidad']).' '.$rowdata_3['Frecuencia'].' con un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				$cambios.= '<br/>a '.$rowdata_1['Nombre'].' por '.$Cantidad.' '.$rowdata_2['Nombre'].' con un valor total de '.Valores($vTotal, 0).'';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){   $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($idServicio) && $idServicio != ''){         $a .= ",idServicio='".$idServicio."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){             $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($idFrecuencia) && $idFrecuencia != ''){     $a .= ",idFrecuencia='".$idFrecuencia."'" ;}
				if(isset($vUnitario) && $vUnitario != ''){           $a .= ",vUnitario='".$vUnitario."'" ;}
				if(isset($vTotal) && $vTotal != ''){                 $a .= ",vTotal='".$vTotal."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_servicio_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			ocompra_listado_existencias_servicios.idOcompra,
			ocompra_listado_existencias_servicios.Cantidad, 
			ocompra_listado_existencias_servicios.vTotal,
			servicios_listado.Nombre AS Producto,
			core_tiempo_frecuencia.Nombre AS Frecuencia
			FROM `ocompra_listado_existencias_servicios` 
			LEFT JOIN `servicios_listado`        ON servicios_listado.idServicio         = ocompra_listado_existencias_servicios.idServicio
			LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia  = ocompra_listado_existencias_servicios.idFrecuencia
			WHERE ocompra_listado_existencias_servicios.idExistencia = '".$_GET['del_servicio']."' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina '.$rowdata_3['Producto'].' por '.Cantidades_decimales_justos($rowdata_3['Cantidad']).' '.$rowdata_3['Frecuencia'].' con un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha      = fecha_actual();
			$idOcompra  = $rowdata_3['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_servicios` WHERE idExistencia = {$_GET['del_servicio']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_otros_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($Cantidad) && $Cantidad != ''){                $a .= ",'".$Cantidad."'" ;      }else{$a .=",''";}
				if(isset($idFrecuencia) && $idFrecuencia != ''){        $a .= ",'".$idFrecuencia."'" ;  }else{$a .=",''";}
				if(isset($vUnitario) && $vUnitario != ''){              $a .= ",'".$vUnitario."'" ;     }else{$a .=",''";}
				if(isset($vTotal) && $vTotal != ''){                    $a .= ",'".$vTotal."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_otros` (idOcompra, idSistema, 
				idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, 
				Nombre, Cantidad, idFrecuencia, vUnitario, vTotal) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `core_tiempo_frecuencia` WHERE idFrecuencia = '$idFrecuencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata_2['Nombre'])&&$rowdata_2['Nombre']!=''){    
					$cambios .= "Se agrega otro ".$Nombre." por ".$Cantidad." ".$rowdata_2['Nombre']." con valor total de ".Valores($vTotal, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_otros_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `core_tiempo_frecuencia` WHERE idFrecuencia = '$idFrecuencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				ocompra_listado_existencias_otros.Cantidad, 
				ocompra_listado_existencias_otros.vTotal,
				ocompra_listado_existencias_otros.Nombre,
				core_tiempo_frecuencia.Nombre AS Frecuencia
				FROM `ocompra_listado_existencias_otros` 
				LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia  = ocompra_listado_existencias_otros.idFrecuencia
				WHERE ocompra_listado_existencias_otros.idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia de '.$rowdata_3['Nombre'].' por '.Cantidades_decimales_justos($rowdata_3['Cantidad']).' '.$rowdata_3['Frecuencia'].' con un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				$cambios.= '<br/>a '.$Nombre.' por '.$Cantidad.' '.$rowdata_2['Nombre'].' con un valor total de '.Valores($vTotal, 0).'';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){   $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($Nombre) && $Nombre != ''){                 $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Cantidad) && $Cantidad != ''){             $a .= ",Cantidad='".$Cantidad."'" ;}
				if(isset($idFrecuencia) && $idFrecuencia != ''){     $a .= ",idFrecuencia='".$idFrecuencia."'" ;}
				if(isset($vUnitario) && $vUnitario != ''){           $a .= ",vUnitario='".$vUnitario."'" ;}
				if(isset($vTotal) && $vTotal != ''){                 $a .= ",vTotal='".$vTotal."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_otros` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_otros_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			ocompra_listado_existencias_otros.idOcompra,
			ocompra_listado_existencias_otros.Cantidad, 
			ocompra_listado_existencias_otros.vTotal,
			ocompra_listado_existencias_otros.Nombre,
			core_tiempo_frecuencia.Nombre AS Frecuencia
			FROM `ocompra_listado_existencias_otros` 
			LEFT JOIN `core_tiempo_frecuencia`   ON core_tiempo_frecuencia.idFrecuencia  = ocompra_listado_existencias_otros.idFrecuencia
			WHERE ocompra_listado_existencias_otros.idExistencia = '".$_GET['del_otros']."' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina '.$rowdata_3['Nombre'].' por '.Cantidades_decimales_justos($rowdata_3['Cantidad']).' '.$rowdata_3['Frecuencia'].' con un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha     = fecha_actual();
			$idOcompra = $rowdata_3['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_otros` WHERE idExistencia = {$_GET['del_otros']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
		
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_boleta_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idTrabajador) && $idTrabajador != ''){   $a .= ",'".$idTrabajador."'" ;  }else{$a .=",''";}
				if(isset($N_Doc) && $N_Doc != ''){                 $a .= ",'".$N_Doc."'" ;         }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){     $a .= ",'".$Descripcion."'" ;   }else{$a .=",''";}
				if(isset($Valor) && $Valor != ''){                 $a .= ",'".$Valor."'" ;         }else{$a .=",''";}
				$a .= ",'1'" ; //no utilizado
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_boletas` (idOcompra, idSistema, 
				idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idTrabajador, N_Doc, Descripcion,
				Valor, idUso ) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre, ApellidoPat FROM `trabajadores_listado` WHERE idTrabajador = '$idTrabajador' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata_2['Nombre'])&&$rowdata_2['Nombre']!=''&&isset($rowdata_2['ApellidoPat'])&&$rowdata_2['ApellidoPat']!=''){    
					$cambios .= "Se agrega boleta honorarios N° ".$N_Doc." del trabajador ".$rowdata_2['Nombre']." ".$rowdata_2['ApellidoPat']." con valor total de ".Valores($Valor, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_boleta_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre, ApellidoPat FROM `trabajadores_listado` WHERE idTrabajador = '$idTrabajador' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				ocompra_listado_existencias_boletas.N_Doc,
				ocompra_listado_existencias_boletas.Valor,

				trabajadores_listado.Nombre AS TrabNombre,
				trabajadores_listado.ApellidoPat AS TrabApellidoPat

				FROM `ocompra_listado_existencias_boletas` 
				LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador   = ocompra_listado_existencias_boletas.idTrabajador
				WHERE ocompra_listado_existencias_boletas.idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia la boleta de honorarios N° '.$rowdata_3['N_Doc'].' del trabajador '.$rowdata_3['TrabNombre'].' '.$rowdata_3['TrabApellidoPat'].' con un valor total de '.Valores($rowdata_3['Valor'], 0).'';
				$cambios.= '<br/>a boleta de honorarios N° '.$N_Doc.' del trabajador '.$rowdata_2['Nombre'].' '.$rowdata_2['ApellidoPat'].' con un valor total de '.Valores($Valor, 0).'.';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($idTrabajador) && $idTrabajador != ''){  $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($N_Doc) && $N_Doc != ''){                $a .= ",N_Doc='".$N_Doc."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){    $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($Valor) && $Valor != ''){                $a .= ",Valor='".$Valor."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_boletas` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_boleta_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			ocompra_listado_existencias_boletas.N_Doc,
			ocompra_listado_existencias_boletas.Valor,

			trabajadores_listado.Nombre AS TrabNombre,
			trabajadores_listado.ApellidoPat AS TrabApellidoPat

			FROM `ocompra_listado_existencias_boletas` 
			LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador   = ocompra_listado_existencias_boletas.idTrabajador
			WHERE ocompra_listado_existencias_boletas.idExistencia = '$idExistencia' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina la boleta de honorarios N° '.$rowdata_3['N_Doc'].' del trabajador '.$rowdata_3['TrabNombre'].' '.$rowdata_3['TrabApellidoPat'].' con un valor total de '.Valores($rowdata_3['Valor'], 0).'.';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha     = fecha_actual();
			$idOcompra = $rowdata_3['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_boletas` WHERE idExistencia = {$_GET['del_boleta']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_boleta_insert_emp':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($Descripcion) && $Descripcion != ''){     $a .= ",'".$Descripcion."'" ;   }else{$a .=",''";}
				if(isset($Valor) && $Valor != ''){                 $a .= ",'".$Valor."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_existencias_boletas_empresas` (idOcompra, idSistema, 
				idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, Descripcion,Valor ) 
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
				/*********************************************************************/	
				//Se realizan comparacion
				$cambios = "Se agrega boleta honorarios de la empresa con valor total de ".Valores($Valor, 0)."." ;
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_boleta_update_emp':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Valor,Descripcion
				FROM `ocompra_listado_existencias_boletas_empresas` 
				WHERE idExistencia = '$idExistencia' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia la boleta de honorarios de la empresa con la descripcion '.$rowdata_3['Descripcion'].' con un valor total de '.Valores($rowdata_3['Valor'], 0).'';
				$cambios.= '<br/>a boleta de honorarios con la descripcion '.$Descripcion.' con un valor total de '.Valores($Valor, 0).'.';
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($Descripcion) && $Descripcion != ''){    $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($Valor) && $Valor != ''){                $a .= ",Valor='".$Valor."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_existencias_boletas_empresas` SET ".$a." WHERE idExistencia = '$idExistencia'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_boleta_del_emp':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT Valor,Descripcion
			FROM `ocompra_listado_existencias_boletas_empresas` 
			WHERE idExistencia = '$idExistencia' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina la boleta de honorarios con la descripcion '.$rowdata_3['Descripcion'].' con un valor total de '.Valores($rowdata_3['Valor'], 0).'.';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha     = fecha_actual();
			$idOcompra = $rowdata_3['idOcompra'];
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_existencias_boletas_empresas` WHERE idExistencia = {$_GET['del_boleta']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/		
/*******************************************************************************************************************/		
		case 'edit_documento_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
				if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
					$a .= ",'".fecha2NSemana($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idDocPago) && $idDocPago != ''){      $a .= ",'".$idDocPago."'" ;      }else{$a .=",''";}
				if(isset($NDocPago) && $NDocPago != ''){        $a .= ",'".$NDocPago."'" ;       }else{$a .=",''";}
				if(isset($Fpago) && $Fpago != ''){              $a .= ",'".$Fpago."'" ;          }else{$a .=",''";}
				if(isset($vTotal) && $vTotal != ''){            $a .= ",'".$vTotal."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_documentos` (idOcompra, idSistema, 
				idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, 
				Creacion_semana, idDocPago, NDocPago, Fpago, vTotal) 
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
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `sistema_documentos_pago` WHERE idDocPago = '$idDocPago' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
			
				/******************************************/
				//Se realizan comparacion
				$cambios = '';
				if(isset($rowdata_2['Nombre'])&&$rowdata_2['Nombre']!=''){    
					$cambios .= "Se agrega documento de pago ".$rowdata_2['Nombre']." N°".$NDocPago." con fecha de pago ".$Fpago." por valor total de ".Valores($vTotal, 0)."." ;
				}
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'edit_documento_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*********************************************************************/	
				/*********************************************************************/	
				//Se toman los datos
				$query = "SELECT Nombre FROM `sistema_documentos_pago` WHERE idDocPago = '$idDocPago' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_2 = mysqli_fetch_assoc ($resultado);
				
				$query = "SELECT 
				sistema_documentos_pago.Nombre,
				ocompra_listado_documentos.NDocPago,
				ocompra_listado_documentos.Fpago,
				ocompra_listado_documentos.vTotal
				
				FROM `ocompra_listado_documentos` 
				LEFT JOIN `sistema_documentos_pago`   ON sistema_documentos_pago.idDocPago  = ocompra_listado_documentos.idDocPago
				WHERE ocompra_listado_documentos.idDocumento = '$idDocumento' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
				/******************************************/
				//Se realizan comparacion
				$cambios = 'Se cambia de '.$rowdata_3['Nombre'].' N°'.$rowdata_3['NDocPago'].' con fecha de pago '.$rowdata_3['Fpago'].' por un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				$cambios.= '<br/>a '.$rowdata_2['Nombre'].' N°'.$NDocPago.' con fecha de pago '.$Fpago.' por valor total de '.Valores($vTotal, 0).'.' ;
				
				/******************************************/
				//Se guarda en historial la accion
				$fecha = fecha_actual();
				if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
				if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
				$a .= ",'2'";                                                     //Creacion Satisfactoria
				$a .= ",'".$cambios."'";                                          //Observacion
				$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				/*********************************************************************/
				
				//Filtros
				$a = "idDocumento='".$idDocumento."'" ;
				if(isset($idOcompra) && $idOcompra != ''){       $a .= ",idOcompra='".$idOcompra."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idProveedor) && $idProveedor != ''){   $a .= ",idProveedor='".$idProveedor."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
					$a .= ",Creacion_semana='".fecha2NSemana($Creacion_fecha)."'" ;
				}
				if(isset($idDocPago) && $idDocPago != ''){   $a .= ",idDocPago='".$idDocPago."'" ;}
				if(isset($NDocPago) && $NDocPago != ''){     $a .= ",NDocPago='".$NDocPago."'" ;}
				if(isset($Fpago) && $Fpago != ''){           $a .= ",Fpago='".$Fpago."'" ;}
				if(isset($vTotal) && $vTotal != ''){         $a .= ",vTotal='".$vTotal."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `ocompra_listado_documentos` SET ".$a." WHERE idDocumento = '$idDocumento'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
		case 'edit_documento_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se toman los datos
			$query = "SELECT 
			sistema_documentos_pago.Nombre,
			ocompra_listado_documentos.NDocPago,
			ocompra_listado_documentos.Fpago,
			ocompra_listado_documentos.vTotal
				
			FROM `ocompra_listado_documentos` 
			LEFT JOIN `sistema_documentos_pago`   ON sistema_documentos_pago.idDocPago  = ocompra_listado_documentos.idDocPago
			WHERE ocompra_listado_documentos.idDocumento = '".$_GET['del_documento']."' ";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata_3 = mysqli_fetch_assoc ($resultado);
				
			/******************************************/
			//Se realizan comparacion
			$cambios = 'Se elimina '.$rowdata_3['Nombre'].' N°'.$rowdata_3['NDocPago'].' con fecha de pago '.$rowdata_3['Fpago'].' por un valor total de '.Valores($rowdata_3['vTotal'], 0).'';
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha = fecha_actual();
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `ocompra_listado_documentos` WHERE idDocumento = {$_GET['del_documento']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'edit_file_insert':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");	
			
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
						$sufijo = 'ocompra_'.fecha_actual().'_';
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//Creacion del nombre del archivo
									$Nombre = $sufijo.$_FILES['exFile']['name'];
									
									//filtros
									if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;     }else{$a  ="''";}
									if(isset($idSistema) && $idSistema != ''){              $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
									if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
									if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;     }else{$a .=",''";}
									if(isset($idProveedor) && $idProveedor != ''){          $a .= ",'".$idProveedor."'" ;  }else{$a .=",''";}
									if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
										$a .= ",'".$Creacion_fecha."'" ;
										$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
										$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									if(isset($Nombre) && $Nombre != ''){      $a .= ",'".$Nombre."'" ;      }else{$a .=",''";}
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `ocompra_listado_archivos` (idOcompra, idSistema, 
									idUsuario, idEstado, idProveedor, Creacion_fecha, Creacion_mes, Creacion_ano, Nombre) 
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
									/*********************************************************************/	
									//Se realizan comparacion
									$cambios = "Se agrega sube archivo ".$Nombre." con fecha ".$Creacion_fecha."." ;
									
									/******************************************/
									//Se guarda en historial la accion
									$fecha = fecha_actual();
									if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
									if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
									$a .= ",'2'";                                                     //Creacion Satisfactoria
									$a .= ",'".$cambios."'";                                          //Observacion
									$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
									/*********************************************************************/
										
									header( 'Location: '.$location.'&created=true' );
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
		case 'edit_file_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Nombre
			FROM `ocompra_listado_archivos`
			WHERE idFile = {$_GET['del_file']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			/*********************************************************************/	
			/*********************************************************************/	
			//Se realizan comparacion
			$cambios = 'Se elimina archivo '.$rowdata['Nombre'];
				
			/******************************************/
			//Se guarda en historial la accion
			$fecha = fecha_actual();
			if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
			if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
			$a .= ",'2'";                                                     //Creacion Satisfactoria
			$a .= ",'".$cambios."'";                                          //Observacion
			$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
			/*********************************************************************/
			
			
			//se borra el archivo de la base de datos
			$query  = "DELETE FROM `ocompra_listado_archivos` WHERE idFile = {$_GET['del_file']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}
			
			//se elimina el archivo
			if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){
				try {
					if(!is_writable('upload/'.$rowdata['Nombre'])){
						//throw new Exception('File not writable');
					}else{
						unlink('upload/'.$rowdata['Nombre']);
						unset($_SESSION['ocompra_archivos'][$_GET['del_file']]);
					}
				}catch(Exception $e) { 
						//guardar el dato en un archivo log
				}
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&deleted=true' );
			die;


		break;	

/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'edit_del_solicitud':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Verifico el tipo
				switch ($_GET['del_sol_type']) {
					/****************************************/
					//Productos
					case 1:
						//Se trae los datos
						$query = "SELECT 
						ocompra_listado_existencias_productos.idExistencia,
						ocompra_listado_existencias_productos.Cantidad,
						ocompra_listado_existencias_productos.vUnitario,
						productos_listado.Nombre AS Producto,
						sistema_productos_uml.Nombre AS Medida
						FROM `ocompra_listado_existencias_productos`
						LEFT JOIN `productos_listado`      ON productos_listado.idProducto   = ocompra_listado_existencias_productos.idProducto
						LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml    = productos_listado.idUml
						WHERE ocompra_listado_existencias_productos.idOcompra = {$_GET['view']}
						AND ocompra_listado_existencias_productos.idProducto= {$_GET['del_sol_prod']}
						LIMIT 1";
						$resultado = mysqli_query($dbConn, $query);
						$rowdata = mysqli_fetch_assoc ($resultado);
						/*********************************************************************/	
						/*********************************************************************/	
						//Se realizan comparacion
						$cambios = 'Se eliminan '.$rowdata['Cantidad'].' '.$rowdata['Medida'].' de '.$rowdata['Producto'].' de la solicitud';
						/******************************************/
						//Se guarda en historial la accion
						$fecha = fecha_actual();
						if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
						if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
						$a .= ",'2'";                                                     //Creacion Satisfactoria
						$a .= ",'".$cambios."'";                                          //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
						/*********************************************************************/
						//Verifico cantidades
						$Resta = $rowdata['Cantidad'] - $_GET['del_sol_cant'];
						//Elimino en caso de que quede en 0
						if($Resta==0){
							//Elimino el dato de la lista de la OC
							$query  = "DELETE FROM `ocompra_listado_existencias_productos` WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_productos` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
						//Sino Actualizo valores
						}else{
							$nuevo = $Resta * $rowdata['vUnitario'];
							//Actualizo las cantidades
							$query  = "UPDATE `ocompra_listado_existencias_productos` SET Cantidad=".$Resta.", vTotal=".$nuevo." WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_productos` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
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
						break;
					/****************************************/
					//Insumos
					case 2:
						//Se trae los datos
						$query = "SELECT 
						ocompra_listado_existencias_insumos.idExistencia,
						ocompra_listado_existencias_insumos.Cantidad,
						ocompra_listado_existencias_insumos.vUnitario,
						insumos_listado.Nombre AS Producto,
						sistema_productos_uml.Nombre AS Medida
						FROM `ocompra_listado_existencias_insumos`
						LEFT JOIN `insumos_listado`        ON insumos_listado.idProducto     = ocompra_listado_existencias_insumos.idProducto
						LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml    = insumos_listado.idUml
						WHERE ocompra_listado_existencias_insumos.idOcompra = {$_GET['view']}
						AND ocompra_listado_existencias_insumos.idProducto= {$_GET['del_sol_prod']}
						LIMIT 1";
						$resultado = mysqli_query($dbConn, $query);
						$rowdata = mysqli_fetch_assoc ($resultado);
						/*********************************************************************/	
						/*********************************************************************/	
						//Se realizan comparacion
						$cambios = 'Se eliminan '.$rowdata['Cantidad'].' '.$rowdata['Medida'].' de '.$rowdata['Producto'].' de la solicitud';
						/******************************************/
						//Se guarda en historial la accion
						$fecha = fecha_actual();
						if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
						if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
						$a .= ",'2'";                                                     //Creacion Satisfactoria
						$a .= ",'".$cambios."'";                                          //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
						/*********************************************************************/
						//Verifico cantidades
						$Resta = $rowdata['Cantidad'] - $_GET['del_sol_cant'];
						//Elimino en caso de que quede en 0
						if($Resta==0){
							//Elimino el dato de la lista de la OC
							$query  = "DELETE FROM `ocompra_listado_existencias_insumos` WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_insumos` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
						//Sino Actualizo valores
						}else{
							$nuevo = $Resta * $rowdata['vUnitario'];
							//Actualizo las cantidades
							$query  = "UPDATE `ocompra_listado_existencias_insumos` SET Cantidad=".$Resta.", vTotal=".$nuevo." WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_insumos` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
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
						break;
					/****************************************/
					//Arriendos
					case 3:
						//Se trae los datos
						$query = "SELECT 
						ocompra_listado_existencias_arriendos.idExistencia,
						ocompra_listado_existencias_arriendos.Cantidad,
						ocompra_listado_existencias_arriendos.vUnitario,
						equipos_arriendo_listado.Nombre AS Producto,
						core_tiempo_frecuencia.Nombre AS Medida
						FROM `ocompra_listado_existencias_arriendos`
						LEFT JOIN `equipos_arriendo_listado`   ON equipos_arriendo_listado.idEquipo     = ocompra_listado_existencias_arriendos.idEquipo
						LEFT JOIN `core_tiempo_frecuencia`     ON core_tiempo_frecuencia.idFrecuencia   = ocompra_listado_existencias_arriendos.idFrecuencia
						WHERE ocompra_listado_existencias_arriendos.idOcompra = {$_GET['view']}
						AND ocompra_listado_existencias_arriendos.idEquipo= {$_GET['del_sol_prod']}
						LIMIT 1";
						$resultado = mysqli_query($dbConn, $query);
						$rowdata = mysqli_fetch_assoc ($resultado);
						/*********************************************************************/	
						/*********************************************************************/	
						//Se realizan comparacion
						$cambios = 'Se eliminan '.$rowdata['Cantidad'].' '.$rowdata['Medida'].' de '.$rowdata['Producto'].' de la solicitud';
						/******************************************/
						//Se guarda en historial la accion
						$fecha = fecha_actual();
						if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
						if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
						$a .= ",'2'";                                                     //Creacion Satisfactoria
						$a .= ",'".$cambios."'";                                          //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
						/*********************************************************************/
						//Verifico cantidades
						$Resta = $rowdata['Cantidad'] - $_GET['del_sol_cant'];
						//Elimino en caso de que quede en 0
						if($Resta==0){
							//Elimino el dato de la lista de la OC
							$query  = "DELETE FROM `ocompra_listado_existencias_arriendos` WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_arriendos` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
						//Sino Actualizo valores
						}else{
							$nuevo = $Resta * $rowdata['vUnitario'];
							//Actualizo las cantidades
							$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET Cantidad=".$Resta.", vTotal=".$nuevo." WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_arriendos` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
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
						break;
					/****************************************/
					//Servicios
					case 4:
						//Se trae los datos
						$query = "SELECT 
						ocompra_listado_existencias_servicios.idExistencia,
						ocompra_listado_existencias_servicios.Cantidad,
						ocompra_listado_existencias_servicios.vUnitario,
						servicios_listado.Nombre AS Producto,
						core_tiempo_frecuencia.Nombre AS Medida
						FROM `ocompra_listado_existencias_servicios`
						LEFT JOIN `servicios_listado`          ON servicios_listado.idServicio          = ocompra_listado_existencias_servicios.idServicio
						LEFT JOIN `core_tiempo_frecuencia`     ON core_tiempo_frecuencia.idFrecuencia   = ocompra_listado_existencias_servicios.idFrecuencia
						WHERE ocompra_listado_existencias_servicios.idOcompra = {$_GET['view']}
						AND ocompra_listado_existencias_servicios.idServicio= {$_GET['del_sol_prod']}
						LIMIT 1";
						$resultado = mysqli_query($dbConn, $query);
						$rowdata = mysqli_fetch_assoc ($resultado);
						/*********************************************************************/	
						/*********************************************************************/	
						//Se realizan comparacion
						$cambios = 'Se eliminan '.$rowdata['Cantidad'].' '.$rowdata['Medida'].' de '.$rowdata['Producto'].' de la solicitud';
						/******************************************/
						//Se guarda en historial la accion
						$fecha = fecha_actual();
						if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
						if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
						$a .= ",'2'";                                                     //Creacion Satisfactoria
						$a .= ",'".$cambios."'";                                          //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
						/*********************************************************************/
						//Verifico cantidades
						$Resta = $rowdata['Cantidad'] - $_GET['del_sol_cant'];
						//Elimino en caso de que quede en 0
						if($Resta==0){
							//Elimino el dato de la lista de la OC
							$query  = "DELETE FROM `ocompra_listado_existencias_servicios` WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_servicios` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
						//Sino Actualizo valores
						}else{
							$nuevo = $Resta * $rowdata['vUnitario'];
							//Actualizo las cantidades
							$query  = "UPDATE `ocompra_listado_existencias_servicios` SET Cantidad=".$Resta.", vTotal=".$nuevo." WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_servicios` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
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
						break;
					/****************************************/
					//Otros
					case 5:
						//Se trae los datos
						$query = "SELECT 
						ocompra_listado_existencias_otros.idExistencia,
						ocompra_listado_existencias_otros.Cantidad,
						ocompra_listado_existencias_otros.vUnitario,
						ocompra_listado_existencias_otros.Nombre AS Producto,
						core_tiempo_frecuencia.Nombre AS Medida
						FROM `ocompra_listado_existencias_otros`
						LEFT JOIN `core_tiempo_frecuencia`     ON core_tiempo_frecuencia.idFrecuencia   = ocompra_listado_existencias_otros.idFrecuencia
						WHERE ocompra_listado_existencias_otros.idOcompra = {$_GET['view']}
						AND ocompra_listado_existencias_otros.Nombre= {$_GET['del_sol_prod']}
						LIMIT 1";
						$resultado = mysqli_query($dbConn, $query);
						$rowdata = mysqli_fetch_assoc ($resultado);
						/*********************************************************************/	
						/*********************************************************************/	
						//Se realizan comparacion
						$cambios = 'Se eliminan '.$rowdata['Cantidad'].' '.$rowdata['Medida'].' de '.$rowdata['Producto'].' de la solicitud';
						/******************************************/
						//Se guarda en historial la accion
						$fecha = fecha_actual();
						if(isset($idOcompra) && $idOcompra != ''){ $a  = "'".$idOcompra."'" ;  }else{ $a  = "''";}
						if(isset($fecha) && $fecha != ''){         $a .= ",'".$fecha."'" ;     }else{ $a .= ",''"; }
						$a .= ",'2'";                                                     //Creacion Satisfactoria
						$a .= ",'".$cambios."'";                                          //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";   //idUsuario
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
						/*********************************************************************/
						//Verifico cantidades
						$Resta = $rowdata['Cantidad'] - $_GET['del_sol_cant'];
						//Elimino en caso de que quede en 0
						if($Resta==0){
							//Elimino el dato de la lista de la OC
							$query  = "DELETE FROM `ocompra_listado_existencias_otros` WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_otros` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
						//Sino Actualizo valores
						}else{
							$nuevo = $Resta * $rowdata['vUnitario'];
							//Actualizo las cantidades
							$query  = "UPDATE `ocompra_listado_existencias_otros` SET Cantidad=".$Resta.", vTotal=".$nuevo." WHERE idExistencia = {$rowdata['idExistencia']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
								
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
								
							}
							//Elimino el numero de OC para dejar libre la solicitud
							$query  = "UPDATE `solicitud_listado_existencias_otros` SET idOcompra=0 WHERE idExistencia = {$_GET['del_solicitud']}";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
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
						break;
				}
				
				//elimino el dato de las solicitudes relacionadas
				$query  = "DELETE FROM `ocompra_listado_sol_rel` WHERE idSolRel = {$_GET['del_sol_SolRel']}";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
							
				
				//Redirijo
				header( 'Location: '.$location );
				die;	
				
			}
		
		
		break;
/*******************************************************************************************************************/
/*******************************************************************************************************************/
		case 'edit_oc_ok':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEstado='1'" ;
				
				// Actualizo los datos
				$query  = "UPDATE `ocompra_listado` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_archivos` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_documentos` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_otros` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idOcompra = '".$_GET['ing_ocompra']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				//Creo los datos en el historial
				$idOcompra        = $_GET['ing_ocompra'];
				$Creacion_fecha   = fecha_actual();
				$idTipo           = 2;
				$Observacion      = 'La Orden de Compra ha sido modificada, queda en espera de aprobacion';
				$idUsuario        = $_SESSION['usuario']['basic_data']['idUsuario'];
				
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){          $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		break;	
		
/*******************************************************************************************************************/
		case 'rechazo_ocompra':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEstado='3'" ;
				
				// Actualizo los datos
				$query  = "UPDATE `ocompra_listado` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_archivos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_documentos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_otros` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				//Creo los datos en el historial
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;    }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){          $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, Creacion_hora, idTipo, Observacion, idUsuario) 
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
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;
/*******************************************************************************************************************/
		case 'nula_ocompra':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEstado='4'" ;
				
				// Actualizo los datos
				$query  = "UPDATE `ocompra_listado` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_archivos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_documentos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_otros` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idOcompra = '".$idOcompra."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				//Creo los datos en el historial
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;    }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){          $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, Creacion_hora, idTipo, Observacion, idUsuario) 
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
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;
/*******************************************************************************************************************/
		case 'aprob_ocompra':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$idOcompra        = $_GET['compra_aprobar'];
			$Creacion_fecha   = fecha_actual();
			$Creacion_hora    = hora_actual();
			$idUsuario        = $_SESSION['usuario']['basic_data']['idUsuario'];
				
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idOcompra)&&$idOcompra!=''&&isset($idUsuario)&&$idUsuario!=''){
				$ndata_1 = db_select_nrows ('idOcompra', 'ocompra_listado_aprobaciones', '', "idOcompra='".$idOcompra."' AND idUsuario='".$idUsuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La aprobacion ya fue realizada';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/**********************************************************/
				//Creo los datos en el historial
				$idTipo           = 2;
				$Observacion      = 'La Orden de Compra ha sido aceptada por un aprobador';
				
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;    }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){          $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, Creacion_hora, idTipo, Observacion, idUsuario) 
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
				
				/**********************************************************/
				//Inserto la aprobacion en la tabla de aprobaciones
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;   }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_aprobaciones` (idOcompra, Creacion_fecha, Creacion_hora, idUsuario) 
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
				
				/**********************************************************/
				//Reviso si las aprobaciones igualan a los aprobadores
				$arrAprobado = array();
				$query = "SELECT 
				sistema_aprobador_oc.idUsuario,
				ocompra_listado.idOcompra,
				(SELECT COUNT(idAprobaciones) FROM `ocompra_listado_aprobaciones` WHERE idOcompra=ocompra_listado.idOcompra AND idUsuario=sistema_aprobador_oc.idUsuario  LIMIT 1) AS C_apro

				FROM `ocompra_listado` 
				LEFT JOIN `sistema_aprobador_oc`  ON sistema_aprobador_oc.idSistema   = ocompra_listado.idSistema
				
				WHERE ocompra_listado.idOcompra = {$idOcompra} ";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrAprobado,$row );
				}
				//variables
				$napro_list = 0;
				$napro_true = 0;
				foreach ($arrAprobado as $apro) {
					$napro_list++;
					if(isset($apro['C_apro'])&&$apro['C_apro']==1){
						$napro_true++;
					}
				}
				
				//verifico cantidades
				if($napro_list==$napro_true){
					//Filtros
					$a = "idEstado='2'" ;
					
					// Actualizo los datos
					$query  = "UPDATE `ocompra_listado` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_archivos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_documentos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_existencias_otros` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
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
					$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if(!$resultado){
						//Genero numero aleatorio
						$vardata = genera_password(8,'alfanumerico');
						
						//Guardo el error en una variable temporal
						$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
						$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
						$_SESSION['ErrorListing'][$vardata]['query']        = $query;
						
					}
					
					//Creo los datos en el historial
					$idTipo           = 1;
					$Observacion      = 'La Orden de Compra ha sido aprobada';
					
					if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
					if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
					if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;    }else{$a .=",''";}
					if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
					if(isset($Observacion) && $Observacion != ''){          $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
					if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, Creacion_hora, idTipo, Observacion, idUsuario) 
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
				
				
				
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;		
/*******************************************************************************************************************/
		case 'aprob_auto_ocompra':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idEstado='2'" ;
					
				// Actualizo los datos
				$query  = "UPDATE `ocompra_listado` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_archivos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_documentos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_otros` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
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
				$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idOcompra = '".$_GET['compra_aprobar']."'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
					
				//Creo los datos en el historial
				$idOcompra        = $_GET['compra_aprobar'];
				$Creacion_fecha   = fecha_actual();
				$Creacion_hora    = hora_actual();
				$idTipo           = 1;
				$Observacion      = 'La Orden de Compra ha sido aprobada';
				$idUsuario        = $_SESSION['usuario']['basic_data']['idUsuario'];
				
					
				if(isset($idOcompra) && $idOcompra != ''){              $a  = "'".$idOcompra."'" ;         }else{$a  ="''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $a .= ",'".$Creacion_fecha."'" ;   }else{$a .=",''";}
				if(isset($Creacion_hora) && $Creacion_hora != ''){      $a .= ",'".$Creacion_hora."'" ;    }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){          $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){              $a .= ",'".$idUsuario."'" ;        }else{$a .=",''";}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_historial` (idOcompra, Creacion_fecha, Creacion_hora, idTipo, Observacion, idUsuario) 
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
				
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		
		break;
/*******************************************************************************************************************/		
		case 'cerrar_incompleta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//Se verifica si el dato existe
			if(isset($cant_ingresada)&&isset($CantComp)){
				if($cant_ingresada!=$CantComp) {$error['ndata_1'] = 'error/Existen diferencias entre lo solicitado y lo recibido';}
			}
			
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idExistencia='".$idExistencia."'" ;
				
		
				// inserto los datos de registro en la db
				switch ($_GET['type']) {
					/********************************************************/
					//Servicios
					case 1:
						//Variables
						if(isset($cant_ingresada) && $cant_ingresada != ''){  $a .= ",cant_ingresada='".$cant_ingresada."'" ;}
						//Query
						$query  = "UPDATE `ocompra_listado_existencias_servicios` SET ".$a." WHERE idExistencia = '$idExistencia'";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					break;
					/********************************************************/
					//Arriendo
					case 2:
						//Variables
						if(isset($cant_ingresada) && $cant_ingresada != ''){  $a .= ",cant_ingresada='".$cant_ingresada."'" ;}
						//Query
						$query  = "UPDATE `ocompra_listado_existencias_arriendos` SET ".$a." WHERE idExistencia = '$idExistencia'";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					break;
					/********************************************************/
					//Insumo
					case 3:
						//Variables
						if(isset($cant_ingresada) && $cant_ingresada != ''){  $a .= ",cant_ingresada='".$cant_ingresada."'" ;}
						//Query
						$query  = "UPDATE `ocompra_listado_existencias_insumos` SET ".$a." WHERE idExistencia = '$idExistencia'";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					break;
					/********************************************************/
					//Productos
					case 4:
						//Variables
						if(isset($cant_ingresada) && $cant_ingresada != ''){  $a .= ",cant_ingresada='".$cant_ingresada."'" ;}
						//Query
						$query  = "UPDATE `ocompra_listado_existencias_productos` SET ".$a." WHERE idExistencia = '$idExistencia'";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					break;
					/********************************************************/
					//Boletas Trabajadores
					case 5:
						//Variables
						$a .= ",idUso='2'" ;
						//Query
						$query  = "UPDATE `ocompra_listado_existencias_boletas` SET ".$a." WHERE idExistencia = '$idExistencia'";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					break;
					/********************************************************/
					//Boletas Empresas
					case 6:
						//Variables
						if(isset($cant_ingresada) && $cant_ingresada != ''){  $a .= ",Total_Ingresado='".$cant_ingresada."'" ;}
						//Query
						$query  = "UPDATE `ocompra_listado_existencias_boletas_empresas` SET ".$a." WHERE idExistencia = '$idExistencia'";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					break;
				}
				
				
				header( 'Location: '.$location.'?submit_filter=+Filtrar&edited=true' );
				die;
			}
		
	
		break;	
/*******************************************************************************************************************/		
		case 'eliminar_orden':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			$ndata_5 = 0;
			$ndata_6 = 0;
			$ndata_7 = 0;
			//Se verifica si el dato existe
			if(isset($_GET['del'])&&$_GET['del']!=''){
				$ndata_1 = db_select_nrows ('idOcompra', 'ocompra_listado', '', "idOcompra='".$_GET['del']."'", $dbConn);
				$ndata_2 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_arriendos', '', "idOcompra='".$_GET['del']."' AND cant_ingresada!=0", $dbConn);
				$ndata_3 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_insumos', '', "idOcompra='".$_GET['del']."' AND cant_ingresada!=0", $dbConn);
				$ndata_4 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_productos', '', "idOcompra='".$_GET['del']."' AND cant_ingresada!=0", $dbConn);
				$ndata_5 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_servicios', '', "idOcompra='".$_GET['del']."' AND cant_ingresada!=0", $dbConn);
				$ndata_6 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_boletas', '', "idOcompra='".$_GET['del']."' AND idUso=2", $dbConn);
				$ndata_7 = db_select_nrows ('idOcompra', 'ocompra_listado_existencias_boletas_empresas', '', "idOcompra='".$_GET['del']."' AND Total_Ingresado!=0", $dbConn);
			
			}else{
				$error['del'] = 'error/No existe OC a eliminar';
			}
			//generacion de errores
			if($ndata_1==0) {$error['ndata_1'] = 'error/No existe OC a eliminar';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/Existen solicitudes de arriendo facturadas';}
			if($ndata_3 > 0) {$error['ndata_2'] = 'error/Existen solicitudes de insumos facturadas';}
			if($ndata_4 > 0) {$error['ndata_2'] = 'error/Existen solicitudes de productos facturadas';}
			if($ndata_5 > 0) {$error['ndata_2'] = 'error/Existen solicitudes de servicios facturadas';}
			if($ndata_6 > 0) {$error['ndata_2'] = 'error/Existen solicitudes de boletas de honorarios facturadas';}
			if($ndata_7 > 0) {$error['ndata_2'] = 'error/Existen solicitudes de boletas de honorarios de empresas facturadas';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/********************************************************/
				//Log oculto de la eliminacion de la OC
				$idOcompra   = $_GET['del'];
				$idSistema   = $_SESSION['usuario']['basic_data']['idSistema'];
				$idUsuario   = $_SESSION['usuario']['basic_data']['idUsuario'];
				$Fecha_elim  = fecha_actual();
				$Hora_elim   = hora_actual();
				
				//filtros
				$a = "'".$idOcompra."'" ;
				$a .= ",'".$idSistema."'" ;
				$a .= ",'".$idUsuario."'" ;
				$a .= ",'".$Fecha_elim."'" ;
				$a .= ",'".$Hora_elim."'" ;
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `ocompra_listado_log_eliminacion` (idOcompra, idSistema, idUsuario, Fecha_elim, Hora_elim) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				
				
				/********************************************************/
				// Se trae un listado con todos los archivos relacionados
				$arrArchivos = array();
				$query = "SELECT Nombre
				FROM `ocompra_listado_archivos` 
				WHERE idOcompra = {$_GET['del']} ";
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
				$query  = "DELETE FROM `ocompra_listado` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_aprobaciones` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_archivos` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_documentos` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_arriendos` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_boletas` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_boletas_empresas` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_insumos` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_otros` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_productos` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_existencias_servicios` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_historial` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
				$query  = "DELETE FROM `ocompra_listado_sol_rel` WHERE idOcompra = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);
				
			}
	
		break;		
/*******************************************************************************************************************/		
		
		
		
		
		
		
		
						
	}
?>
