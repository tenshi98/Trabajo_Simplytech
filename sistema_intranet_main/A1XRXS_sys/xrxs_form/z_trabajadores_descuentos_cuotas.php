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
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador    = $_POST['idTrabajador'];
	if ( !empty($_POST['fecha_auto']) )     $fecha_auto      = $_POST['fecha_auto'];
	if ( !empty($_POST['Creacion_fecha']) ) $Creacion_fecha  = $_POST['Creacion_fecha'];
	if ( !empty($_POST['Observaciones']) )  $Observaciones   = $_POST['Observaciones'];
	if ( !empty($_POST['Monto']) )          $Monto           = $_POST['Monto'];
	if ( !empty($_POST['N_Cuotas']) )       $N_Cuotas        = $_POST['N_Cuotas'];
	
	if ( !empty($_POST['FechaCuota']) )     $FechaCuota      = $_POST['FechaCuota'];
	if ( !empty($_POST['MontoCuota']) )     $MontoCuota      = $_POST['MontoCuota'];
	if ( !empty($_POST['oldidProducto']) )  $oldidProducto   = $_POST['oldidProducto'];
	
	
	
	
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
			case 'idUsuario':       if(empty($idUsuario)){        $error['idUsuario']        = 'error/No ha seleccionado el usuario';}break;
			case 'idTipo':          if(empty($idTipo)){           $error['idTipo']           = 'error/No ha seleccionado el tipo';}break;
			case 'idTrabajador':    if(empty($idTrabajador)){     $error['idTrabajador']     = 'error/No ha seleccionado el trabajador';}break;
			case 'fecha_auto':      if(empty($fecha_auto)){       $error['fecha_auto']       = 'error/No ha ingresado la fecha auto';}break;
			case 'Creacion_fecha':  if(empty($Creacion_fecha)){   $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Observaciones':   if(empty($Observaciones)){    $error['Observaciones']    = 'error/No ha ingresado la observacion';}break;
			case 'Monto':           if(empty($Monto)){            $error['Monto']            = 'error/No ha ingresado el monto';}break;
			case 'N_Cuotas':        if(empty($N_Cuotas)){         $error['N_Cuotas']         = 'error/No ha seleccionado el numero de cuotas';}break;
			
			case 'FechaCuota':      if(empty($FechaCuota)){       $error['FechaCuota']       = 'error/No ha ingresado la fecha de la cuota';}break;
			case 'MontoCuota':      if(empty($MontoCuota)){       $error['MontoCuota']       = 'error/No ha ingresado el monto de la cuota';}break;
			case 'oldidProducto':   if(empty($oldidProducto)){    $error['oldidProducto']    = 'error/No ha ingresado el id de la cuota';}break;
			
		
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
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones= "Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['desc_cuotas_basicos']);
				unset($_SESSION['desc_cuotas_listado']);
				unset($_SESSION['desc_cuotas_temporal']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['desc_cuotas_archivos'])){
					foreach ($_SESSION['desc_cuotas_archivos'] as $key => $producto){
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
				unset($_SESSION['desc_cuotas_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['desc_cuotas_basicos']['idTrabajador']     = $idTrabajador;
				$_SESSION['desc_cuotas_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['desc_cuotas_basicos']['idTipo']           = $idTipo;
				$_SESSION['desc_cuotas_basicos']['Monto']            = $Monto;
				$_SESSION['desc_cuotas_basicos']['N_Cuotas']         = $N_Cuotas;
				$_SESSION['desc_cuotas_basicos']['Observaciones']    = $Observaciones;
				$_SESSION['desc_cuotas_basicos']['idSistema']        = $idSistema;
				$_SESSION['desc_cuotas_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['desc_cuotas_basicos']['fecha_auto']       = $fecha_auto;
				
				/*******************************/
				//Calculo aproximado cuotas
				$monto_cuotas= ceil ($Monto/$N_Cuotas);
				$total_temporal = $Monto;
				//cuotas
				for ($i = 1; $i <= $N_Cuotas; $i++) {
					$_SESSION['desc_cuotas_listado'][$i]['fecha'] = '0000-00-00';
					$_SESSION['desc_cuotas_listado'][$i]['cuota'] = $i;
					//verifico el saldo
					if($monto_cuotas<$total_temporal){
						$_SESSION['desc_cuotas_listado'][$i]['monto'] = $monto_cuotas;
					}else{
						$_SESSION['desc_cuotas_listado'][$i]['monto'] = $total_temporal;
					}
					//calculo de saldo
					$total_temporal = $total_temporal - $monto_cuotas;
					
				}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `trabajadores_descuentos_cuotas_tipos`
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
					$_SESSION['desc_cuotas_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['desc_cuotas_basicos']['TipoDocumento'] = '';
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
					$rowTrabajador = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['desc_cuotas_basicos']['Trabajador'] = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				}else{
					$_SESSION['desc_cuotas_basicos']['Trabajador'] = '';
				}
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
					$_SESSION['desc_cuotas_basicos']['Usuario'] = $rowUsuario['Nombre'];
				}else{
					$_SESSION['desc_cuotas_basicos']['Usuario'] = '';
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
			unset($_SESSION['desc_cuotas_basicos']);
			unset($_SESSION['desc_cuotas_listado']);
			unset($_SESSION['desc_cuotas_temporal']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['desc_cuotas_archivos'])){
				foreach ($_SESSION['desc_cuotas_archivos'] as $key => $producto){
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
			unset($_SESSION['desc_cuotas_archivos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['desc_cuotas_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['desc_cuotas_listado']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['desc_cuotas_basicos']['idTrabajador']     = $idTrabajador;
				$_SESSION['desc_cuotas_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['desc_cuotas_basicos']['idTipo']           = $idTipo;
				$_SESSION['desc_cuotas_basicos']['Monto']            = $Monto;
				$_SESSION['desc_cuotas_basicos']['N_Cuotas']         = $N_Cuotas;
				$_SESSION['desc_cuotas_basicos']['idSistema']        = $idSistema;
				$_SESSION['desc_cuotas_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['desc_cuotas_basicos']['fecha_auto']       = $fecha_auto;
				
				/*******************************/
				//Calculo aproximado cuotas
				$monto_cuotas   = ceil ($Monto/$N_Cuotas);
				$total_temporal = $Monto;
				//cuotas
				for ($i = 1; $i <= $N_Cuotas; $i++) {
					$_SESSION['desc_cuotas_listado'][$i]['fecha'] = '0000-00-00';
					$_SESSION['desc_cuotas_listado'][$i]['cuota'] = $i;
					//verifico el saldo
					if($monto_cuotas<$total_temporal){
						$_SESSION['desc_cuotas_listado'][$i]['monto'] = $monto_cuotas;
					}else{
						$_SESSION['desc_cuotas_listado'][$i]['monto'] = $total_temporal;
					}
					//calculo de saldo
					$total_temporal = $total_temporal - $monto_cuotas;
					
				}
				
				/****************************************************/
				if(isset($idTipo) && $idTipo != ''){ 
					// Se traen todos los datos de mi usuario
					$query = "SELECT Nombre
					FROM `trabajadores_descuentos_cuotas_tipos`
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
					$_SESSION['desc_cuotas_basicos']['TipoDocumento'] = $rowTipoDocumento['Nombre'];
				}else{
					$_SESSION['desc_cuotas_basicos']['TipoDocumento'] = '';
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
					$rowTrabajador = mysqli_fetch_assoc ($resultado);
					//se guarda dato
					$_SESSION['desc_cuotas_basicos']['Trabajador'] = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				}else{
					$_SESSION['desc_cuotas_basicos']['Trabajador'] = '';
				}
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
					$_SESSION['desc_cuotas_basicos']['Usuario'] = $rowUsuario['Nombre'];
				}else{
					$_SESSION['desc_cuotas_basicos']['Usuario'] = '';
				}
			
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
	
/*******************************************************************************************************************/		
		case 'edit_cuota_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			//verifico que ninguna cuota se cobre en el mismo mes
			foreach ($_SESSION['desc_cuotas_listado'] as $key => $producto){
				if(isset($FechaCuota)&&isset($producto['fecha'])&&fecha2NMes($FechaCuota)==fecha2NMes($producto['fecha'])&&fecha2Ano($FechaCuota)==fecha2Ano($producto['fecha'])){
					$error['ndata_1'] = 'error/La fecha de cobro esta dentro del mismo mes y año de otra fecha de cobro';
				}
			}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//creo el producto
				$_SESSION['desc_cuotas_listado'][$oldidProducto]['fecha'] = $FechaCuota;
				$_SESSION['desc_cuotas_listado'][$oldidProducto]['cuota'] = $oldidProducto;
				$_SESSION['desc_cuotas_listado'][$oldidProducto]['monto'] = $MontoCuota;
				
				header( 'Location: '.$location.'&view=true' );
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
				$_SESSION['desc_cuotas_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['desc_cuotas_temporal'] = $_SESSION['desc_cuotas_basicos']['Observaciones'];
			$_SESSION['desc_cuotas_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['desc_cuotas_archivos'])){
				foreach ($_SESSION['desc_cuotas_archivos'] as $key => $trabajos){
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
						$sufijo = 'descuentos_cuotas_ingreso_'.fecha_actual().'_';
					  
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
									$_SESSION['desc_cuotas_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['desc_cuotas_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['desc_cuotas_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['desc_cuotas_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['desc_cuotas_archivos'][$_GET['del_file']]);
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
			if (isset($_SESSION['desc_cuotas_basicos'])){
				if(!isset($_SESSION['desc_cuotas_basicos']['idTrabajador']) or $_SESSION['desc_cuotas_basicos']['idTrabajador']=='' ){     $error['idTrabajador']     = 'error/No ha seleccionado el trabajador';}
				if(!isset($_SESSION['desc_cuotas_basicos']['Creacion_fecha']) or $_SESSION['desc_cuotas_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la fecha de creacion';}
				if(!isset($_SESSION['desc_cuotas_basicos']['idTipo']) or $_SESSION['desc_cuotas_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de boleta';}
				if(!isset($_SESSION['desc_cuotas_basicos']['Monto']) or $_SESSION['desc_cuotas_basicos']['Monto']=='' ){                   $error['Monto']            = 'error/No ha ingresado el Monto total de las cuotas';}
				if(!isset($_SESSION['desc_cuotas_basicos']['N_Cuotas']) or $_SESSION['desc_cuotas_basicos']['N_Cuotas']=='' ){             $error['N_Cuotas']         = 'error/No ha ingresado el numero total de cuotas';}
				if(!isset($_SESSION['desc_cuotas_basicos']['Observaciones']) or $_SESSION['desc_cuotas_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['desc_cuotas_basicos']['idSistema']) or $_SESSION['desc_cuotas_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['desc_cuotas_basicos']['idUsuario']) or $_SESSION['desc_cuotas_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['desc_cuotas_basicos']['fecha_auto']) or $_SESSION['desc_cuotas_basicos']['fecha_auto']=='' ){         $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}
					
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al descuento por cuotas';
			}
			//productos o guias
			if (!isset($_SESSION['desc_cuotas_listado'])){
				$error['idProducto']   = 'error/No se han asignado cuotas';
			}
			//Se verifican productos
			if (isset($_SESSION['desc_cuotas_listado'])){
				foreach ($_SESSION['desc_cuotas_listado'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No se han asignado cuotas';
			}
				
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['desc_cuotas_basicos']['idSistema']) && $_SESSION['desc_cuotas_basicos']['idSistema'] != ''){            $a  = "'".$_SESSION['desc_cuotas_basicos']['idSistema']."'" ;       }else{$a  = "''";}
				if(isset($_SESSION['desc_cuotas_basicos']['idUsuario']) && $_SESSION['desc_cuotas_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['desc_cuotas_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['desc_cuotas_basicos']['idTipo']) && $_SESSION['desc_cuotas_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['desc_cuotas_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['desc_cuotas_basicos']['idTrabajador']) && $_SESSION['desc_cuotas_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['desc_cuotas_basicos']['idTrabajador']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['desc_cuotas_basicos']['fecha_auto']) && $_SESSION['desc_cuotas_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['desc_cuotas_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['desc_cuotas_basicos']['Creacion_fecha']) && $_SESSION['desc_cuotas_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['desc_cuotas_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['desc_cuotas_basicos']['Observaciones']) && $_SESSION['desc_cuotas_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['desc_cuotas_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['desc_cuotas_basicos']['Monto']) && $_SESSION['desc_cuotas_basicos']['Monto'] != ''){                    $a .= ",'".$_SESSION['desc_cuotas_basicos']['Monto']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['desc_cuotas_basicos']['N_Cuotas'])&&$_SESSION['desc_cuotas_basicos']['N_Cuotas']!=''){                  $a .= ",'".$_SESSION['desc_cuotas_basicos']['N_Cuotas']."'";        }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_descuentos_cuotas` (idSistema, idUsuario, idTipo, idTrabajador,
				fecha_auto, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, Observaciones, Monto, N_Cuotas) 
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
					if(isset($_SESSION['desc_cuotas_listado'])){		
						foreach ($_SESSION['desc_cuotas_listado'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                          }else{$a  = "''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idSistema']) && $_SESSION['desc_cuotas_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['desc_cuotas_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idUsuario']) && $_SESSION['desc_cuotas_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['desc_cuotas_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idTipo']) && $_SESSION['desc_cuotas_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['desc_cuotas_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idTrabajador']) && $_SESSION['desc_cuotas_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['desc_cuotas_basicos']['idTrabajador']."'" ;   }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['fecha_auto']) && $_SESSION['desc_cuotas_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['desc_cuotas_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['Creacion_fecha']) && $_SESSION['desc_cuotas_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['desc_cuotas_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NSemana($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2NMes($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['fecha']) && $producto['fecha'] != ''){                                                        $a .= ",'".$producto['fecha']."'" ;                            }else{$a .= ",''";}
							if(isset($producto['cuota']) && $producto['cuota'] != ''){                                                        $a .= ",'".$producto['cuota']."'" ;                            }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['N_Cuotas']) && $_SESSION['desc_cuotas_basicos']['N_Cuotas'] != ''){    $a .= ",'".$_SESSION['desc_cuotas_basicos']['N_Cuotas']."'" ;  }else{$a .= ",''";}
							if(isset($producto['monto']) && $producto['monto'] != ''){                                                        $a .= ",'".$producto['monto']."'" ;                            }else{$a .= ",''";}
							$a .= ",'1'" ; 
								
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `trabajadores_descuentos_cuotas_listado` (idFacturacion,idSistema, idUsuario, idTipo, idTrabajador,
							fecha_auto, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano,Fecha, nCuota, TotalCuotas, monto_cuotas, idUso ) 
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
					if(isset($_SESSION['desc_cuotas_archivos'])){
						foreach ($_SESSION['desc_cuotas_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                  $a  = "'".$ultimo_id."'" ;                                          }else{$a  = "''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idSistema']) && $_SESSION['desc_cuotas_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['desc_cuotas_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idUsuario']) && $_SESSION['desc_cuotas_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['desc_cuotas_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idTipo']) && $_SESSION['desc_cuotas_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['desc_cuotas_basicos']['idTipo']."'" ;         }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['idTrabajador']) && $_SESSION['desc_cuotas_basicos']['idTrabajador'] != ''){      $a .= ",'".$_SESSION['desc_cuotas_basicos']['idTrabajador']."'" ;   }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['fecha_auto']) && $_SESSION['desc_cuotas_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['desc_cuotas_basicos']['fecha_auto']."'" ;     }else{$a .= ",''";}
							if(isset($_SESSION['desc_cuotas_basicos']['Creacion_fecha']) && $_SESSION['desc_cuotas_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['desc_cuotas_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NSemana($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2NMes($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['desc_cuotas_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){    $a .= ",'".$producto['Nombre']."'" ;     }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `trabajadores_descuentos_cuotas_archivos` (idFacturacion,idSistema, idUsuario, idTipo, idTrabajador,
							fecha_auto, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano,Nombre) 
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
					unset($_SESSION['desc_cuotas_basicos']);
					unset($_SESSION['desc_cuotas_listado']);
					unset($_SESSION['desc_cuotas_temporal']);
					unset($_SESSION['desc_cuotas_archivos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	


/*******************************************************************************************************************/
	}
?>
