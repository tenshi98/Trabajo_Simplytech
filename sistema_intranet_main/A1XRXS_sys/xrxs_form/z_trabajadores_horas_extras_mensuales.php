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
	if ( !empty($_POST['fecha_auto']) )     $fecha_auto      = $_POST['fecha_auto'];
	if ( !empty($_POST['Creacion_fecha']) ) $Creacion_fecha  = $_POST['Creacion_fecha'];
	if ( !empty($_POST['Ano']) )            $Ano             = $_POST['Ano'];
	if ( !empty($_POST['idMes']) )          $idMes           = $_POST['idMes'];
	if ( !empty($_POST['Observaciones']) )  $Observaciones   = $_POST['Observaciones'];
	
	if ( !empty($_POST['idTrabajador']) )      $idTrabajador       = $_POST['idTrabajador'];
	if ( !empty($_POST['horas_dia']) )         $horas_dia          = $_POST['horas_dia'];
	if ( !empty($_POST['porcentaje_dia']) )    $porcentaje_dia     = $_POST['porcentaje_dia'];
	
	
				
					
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
			case 'fecha_auto':      if(empty($fecha_auto)){       $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}break;
			case 'Creacion_fecha':  if(empty($Creacion_fecha)){   $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Ano':             if(empty($Ano)){              $error['Ano']              = 'error/No ha seleccionado el año';}break;
			case 'idMes':           if(empty($idMes)){            $error['idMes']            = 'error/No ha seleccionado el mes';}break;
			case 'Observaciones':   if(empty($Observaciones)){    $error['Observaciones']    = 'error/No ha ingresado la observacion';}break;
			
			case 'idTrabajador':    if(empty($idTrabajador)){     $error['idTrabajador']     = 'error/No ha seleccionado el trabajador';}break;
			case 'idTurnos':        if(empty($idTurnos)){         $error['idTurnos']         = 'error/No ha seleccionado el turno';}break;
			
			
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
				unset($_SESSION['horas_extras_mens_ing_basicos']);
				unset($_SESSION['horas_extras_mens_ing_horas']);
				unset($_SESSION['horas_extras_mens_ing_temporal']);
				
				//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
				if (isset($_SESSION['horas_extras_mens_ing_archivos'])){
					foreach ($_SESSION['horas_extras_mens_ing_archivos'] as $key => $producto){
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
				unset($_SESSION['horas_extras_mens_ing_archivos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['horas_extras_mens_ing_basicos']['Ano']              = $Ano;
				$_SESSION['horas_extras_mens_ing_basicos']['idMes']            = $idMes;
				$_SESSION['horas_extras_mens_ing_basicos']['idSistema']        = $idSistema;
				$_SESSION['horas_extras_mens_ing_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['horas_extras_mens_ing_basicos']['Observaciones']    = $Observaciones;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['horas_extras_mens_ing_basicos']);
			unset($_SESSION['horas_extras_mens_ing_horas']);
			unset($_SESSION['horas_extras_mens_ing_temporal']);
				
			//Recorro los archivos subidos y los borro antes de eliminar la variable de sesion
			if (isset($_SESSION['horas_extras_mens_ing_archivos'])){
				foreach ($_SESSION['horas_extras_mens_ing_archivos'] as $key => $producto){
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
			unset($_SESSION['horas_extras_mens_ing_archivos']);

			
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
				unset($_SESSION['horas_extras_mens_ing_temporal']);
				//Elimino los datos por seguridad
				unset($_SESSION['horas_extras_mens_ing_horas']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']   = $Creacion_fecha;
				$_SESSION['horas_extras_mens_ing_basicos']['Ano']              = $Ano;
				$_SESSION['horas_extras_mens_ing_basicos']['idMes']            = $idMes;
				$_SESSION['horas_extras_mens_ing_basicos']['idSistema']        = $idSistema;
				$_SESSION['horas_extras_mens_ing_basicos']['idUsuario']        = $idUsuario;
				$_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']       = $fecha_auto;
				$_SESSION['horas_extras_mens_ing_basicos']['Observaciones']    = $Observaciones;
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'new_horas_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($porcentaje_dia)&&isset($idMes)&&isset($Ano)){
				$ndata_1 = db_select_nrows ('idTrabajador', 'trabajadores_horas_extras_mensuales_facturacion_horas', '', "idTrabajador='".$idTrabajador."' AND idPorcentaje='".$porcentaje_dia."' AND idMes='".$idMes."' AND Ano='".$Ano."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/Las horas extras que esta tratando de ingresar ya fueron ingresadas previamente';}
			/*******************************************************************/
			//Trabajador
			if(isset($idTrabajador)&&$idTrabajador!=''){
				$query = "SELECT Nombre, ApellidoPat, ApellidoMat, Rut
				FROM `trabajadores_listado`
				WHERE idTrabajador=".$idTrabajador;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					$error['idTrabajador'] = 'error/No existe el trabajador seleccionado';				
				}
				$rowTrabajador = mysqli_fetch_assoc ($resultado);
			}else{
				$error['idTrabajador'] = 'error/No ha seleccionado trabajador';	
			}
				
			/************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/****************************/
				//Porcentaje
				$query = "SELECT Porcentaje
				FROM `core_horas_extras_porcentajes` 
				WHERE idPorcentaje=".$porcentaje_dia;
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				$rowPorcentaje = mysqli_fetch_assoc ($resultado);
	
				//Horas trabajadores			
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador]['TrabajadorNombre']                   = $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat'];
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador]['TrabajadorRut']                      = $rowTrabajador['Rut'];
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador]['idTrabajador']                       = $idTrabajador;
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador][$porcentaje_dia]['idTrabajador']      = $idTrabajador;
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador][$porcentaje_dia]['porcentaje_dia']    = $porcentaje_dia;
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador][$porcentaje_dia]['horas_dia']         = $horas_dia;
				$_SESSION['horas_extras_mens_ing_horas'][$idTrabajador][$porcentaje_dia]['porcentaje_nombre'] = $rowPorcentaje['Porcentaje'];
				
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;	

/*******************************************************************************************************************/		
		case 'del_horas_ing':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['horas_extras_mens_ing_horas'][$_GET['idTrabajador']]);
			
			
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
				$_SESSION['horas_extras_mens_ing_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing_nd':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$_SESSION['horas_extras_mens_ing_temporal'] = $_SESSION['horas_extras_mens_ing_basicos']['Observaciones'];
			$_SESSION['horas_extras_mens_ing_basicos']['Observaciones'] = '';
			
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
			if(isset($_SESSION['horas_extras_mens_ing_archivos'])){
				foreach ($_SESSION['horas_extras_mens_ing_archivos'] as $key => $trabajos){
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
						$sufijo = 'hhee_mens_ingreso_'.fecha_actual().'_';
					  
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
									$_SESSION['horas_extras_mens_ing_archivos'][$idInterno]['idFile'] = $idInterno;
									$_SESSION['horas_extras_mens_ing_archivos'][$idInterno]['Nombre'] = $sufijo.$_FILES['exFile']['name'];
										
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
				if(!is_writable('upload/'.$_SESSION['horas_extras_mens_ing_archivos'][$_GET['del_file']]['Nombre'])){
					//throw new Exception('File not writable');
				}else{
					unlink('upload/'.$_SESSION['horas_extras_mens_ing_archivos'][$_GET['del_file']]['Nombre']);
					unset($_SESSION['horas_extras_mens_ing_archivos'][$_GET['del_file']]);
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
			if (isset($_SESSION['horas_extras_mens_ing_basicos'])){
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']) or $_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la fecha de creacion';}
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['Ano']) or $_SESSION['horas_extras_mens_ing_basicos']['Ano']=='' ){                       $error['Ano']              = 'error/No ha seleccionado el año de creacion';}
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['idMes']) or $_SESSION['horas_extras_mens_ing_basicos']['idMes']=='' ){                   $error['idMes']            = 'error/No ha seleccionado el mes de creacion';}
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['idSistema']) or $_SESSION['horas_extras_mens_ing_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['idUsuario']) or $_SESSION['horas_extras_mens_ing_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha seleccionado el usuario';}
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']) or $_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']=='' ){         $error['fecha_auto']       = 'error/No ha ingresado la fecha automatica';}
				if(!isset($_SESSION['horas_extras_mens_ing_basicos']['Observaciones']) or $_SESSION['horas_extras_mens_ing_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No ha ingresado la observacion';}
						
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados a las horas extras';
			}
			//Horas
			if (!isset($_SESSION['horas_extras_mens_ing_horas'])){
				$error['idProducto']   = 'error/No se han asignado horas extras';
			}
			//Se verifican productos
			if (isset($_SESSION['horas_extras_mens_ing_horas'])){
				foreach ($_SESSION['horas_extras_mens_ing_horas'] as $key => $producto){
					$n_data1++;
				}
			}
			//Se verifica el minimo de trabajos
			if(isset($n_data1)&&$n_data1==0){
				$error['trabajos'] = 'error/No se han asignado horas extras';
			}
			
			/*********************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['idSistema']) && $_SESSION['horas_extras_mens_ing_basicos']['idSistema'] != ''){            $a  = "'".$_SESSION['horas_extras_mens_ing_basicos']['idSistema']."'" ;   }else{$a  = "''";}
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['idUsuario']) && $_SESSION['horas_extras_mens_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']) && $_SESSION['horas_extras_mens_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']) && $_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".fecha2NSemana($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2NMes($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".fecha2Ano($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['Ano']) && $_SESSION['horas_extras_mens_ing_basicos']['Ano'] != ''){                        $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Ano']."'" ;            }else{$a .= ",''";}
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['idMes']) && $_SESSION['horas_extras_mens_ing_basicos']['idMes'] != ''){                    $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idMes']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['horas_extras_mens_ing_basicos']['Observaciones']) && $_SESSION['horas_extras_mens_ing_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Observaciones']."'" ;  }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_horas_extras_mensuales_facturacion` (idSistema, idUsuario, fecha_auto,
				Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, Ano, idMes, Observaciones) 
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
					if (isset($_SESSION['horas_extras_mens_ing_horas'])){
						
						foreach ($_SESSION['horas_extras_mens_ing_horas'] as $key => $producto){
						
							foreach ($producto as $prod) {
								//verifico la existencia de datos
								if(isset($prod['horas_dia']) && $prod['horas_dia'] != ''){  
									
									if(isset($ultimo_id) && $ultimo_id != ''){                                                                                            $a  = "'".$ultimo_id."'" ;                                           }else{$a  = "''";}
									if(isset($_SESSION['horas_extras_mens_ing_basicos']['idSistema']) && $_SESSION['horas_extras_mens_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
									if(isset($_SESSION['horas_extras_mens_ing_basicos']['idUsuario']) && $_SESSION['horas_extras_mens_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
									if(isset($_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']) && $_SESSION['horas_extras_mens_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']."'" ; }else{$a .= ",''";}
									if(isset($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']) && $_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'] != ''){  
										$a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']."'" ;  
										$a .= ",'".fecha2NSemana($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
										$a .= ",'".fecha2NMes($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
										$a .= ",'".fecha2Ano($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
									}else{
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
										$a .= ",''";
									}
									if(isset($_SESSION['horas_extras_mens_ing_basicos']['Ano']) && $_SESSION['horas_extras_mens_ing_basicos']['Ano'] != ''){       $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Ano']."'" ;     }else{$a .= ",''";}
									if(isset($_SESSION['horas_extras_mens_ing_basicos']['idMes']) && $_SESSION['horas_extras_mens_ing_basicos']['idMes'] != ''){   $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idMes']."'" ;   }else{$a .= ",''";}
									if(isset($prod['idTrabajador']) && $prod['idTrabajador'] != ''){                                                               $a .= ",'".$prod['idTrabajador']."'" ;                             }else{$a .= ",''";}
									if(isset($prod['horas_dia']) && $prod['horas_dia'] != ''){                                                                     $a .= ",'".$prod['horas_dia']."'" ;                                }else{$a .= ",''";}
									if(isset($prod['porcentaje_dia']) && $prod['porcentaje_dia'] != ''){                                                           $a .= ",'".$prod['porcentaje_dia']."'" ;                           }else{$a .= ",''";}
									$a .= ",'1'";									
														
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `trabajadores_horas_extras_mensuales_facturacion_horas` (idFacturacion, idSistema,
									idUsuario, fecha_auto, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, Ano, idMes, idTrabajador,
									N_Horas, idPorcentaje, idUso) 
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
						}
					}
					
					/*********************************************************************/		
					//Archivos
					if(isset($_SESSION['horas_extras_mens_ing_archivos'])){
						foreach ($_SESSION['horas_extras_mens_ing_archivos'] as $key => $producto){
						
							//filtros
							if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                      $a  = "'".$ultimo_id."'" ;                                                }else{$a  = "''";}
							if(isset($_SESSION['horas_extras_mens_ing_basicos']['idSistema']) && $_SESSION['horas_extras_mens_ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idSistema']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['horas_extras_mens_ing_basicos']['idUsuario']) && $_SESSION['horas_extras_mens_ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idUsuario']."'" ;  }else{$a .= ",''";}
							if(isset($_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']) && $_SESSION['horas_extras_mens_ing_basicos']['fecha_auto'] != ''){          $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['fecha_auto']."'" ; }else{$a .= ",''";}
							if(isset($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']) && $_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'] != ''){  
								$a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha']."'" ;  
								$a .= ",'".fecha2NMes($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
								$a .= ",'".fecha2Ano($_SESSION['horas_extras_mens_ing_basicos']['Creacion_fecha'])."'" ;
							}else{
								$a .= ",''";
								$a .= ",''";
								$a .= ",''";
							}
							if(isset($_SESSION['horas_extras_mens_ing_basicos']['Ano']) && $_SESSION['horas_extras_mens_ing_basicos']['Ano'] != ''){      $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['Ano']."'" ;      }else{$a .= ",''";}
							if(isset($_SESSION['horas_extras_mens_ing_basicos']['idMes']) && $_SESSION['horas_extras_mens_ing_basicos']['idMes'] != ''){  $a .= ",'".$_SESSION['horas_extras_mens_ing_basicos']['idMes']."'" ;    }else{$a .= ",''";}
							if(isset($producto['Nombre']) && $producto['Nombre'] != ''){                                                                  $a .= ",'".$producto['Nombre']."'" ;                                    }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `trabajadores_horas_extras_mensuales_facturacion_archivos` (idFacturacion, idSistema, idUsuario, fecha_auto, Creacion_fecha,
							Creacion_mes, Creacion_ano, Ano, idMes, Nombre) 
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
					unset($_SESSION['horas_extras_mens_ing_basicos']);
					unset($_SESSION['horas_extras_mens_ing_horas']);
					unset($_SESSION['horas_extras_mens_ing_temporal']);
					unset($_SESSION['horas_extras_mens_ing_archivos']);
					
					header( 'Location: '.$location.'&created=true' );
					die;
				}
				
				
			}	
	

		break;	

/*******************************************************************************************************************/
	}
?>
