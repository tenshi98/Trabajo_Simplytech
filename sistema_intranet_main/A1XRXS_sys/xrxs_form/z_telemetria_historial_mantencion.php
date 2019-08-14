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
	if ( !empty($_POST['idMantencion']) )   $idMantencion     = $_POST['idMantencion'];
	if ( !empty($_POST['idSistema']) )      $idSistema        = $_POST['idSistema'];
	if ( !empty($_POST['idTelemetria']) )   $idTelemetria     = $_POST['idTelemetria'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario        = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )          $Fecha            = $_POST['Fecha'];
	if ( !empty($_POST['Duracion']) )       $Duracion         = $_POST['Duracion'];
	if ( !empty($_POST['Resumen']) )        $Resumen          = $_POST['Resumen'];
	if ( !empty($_POST['Resolucion']) )     $Resolucion       = $_POST['Resolucion'];
	
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
			case 'idMantencion':     if(empty($idMantencion)){      $error['idMantencion']      = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){         $error['idSistema']         = 'error/No ha seleccionado el sistema';}break;
			case 'idTelemetria':     if(empty($idTelemetria)){      $error['idTelemetria']      = 'error/No ha seleccionado el equipo de telemetria';}break;
			case 'idUsuario':        if(empty($idUsuario)){         $error['idUsuario']         = 'error/No ha seleccionado el usuario';}break;
			case 'Fecha':            if(empty($Fecha)){             $error['Fecha']             = 'error/No ha ingresado la fecha';}break;
			case 'Duracion':         if(empty($Duracion)){          $error['Duracion']          = 'error/No ha ingresado la duracion';}break;
			case 'Resumen':          if(empty($Resumen)){           $error['Resumen']           = 'error/No ha ingresado el resumen';}break;
			case 'Resolucion':       if(empty($Resolucion)){        $error['Resolucion']        = 'error/No ha ingresado la resolucion';}break;
			case 'Monto':            if(empty($Monto)){             $error['Monto']             = 'error/No ha ingresado el Monto';}break;
			
		}
	}

	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico que los tipos de archivo correspondan y que tengan el peso necesario
			if($_FILES['files_adj']){
				$images = $_FILES['files_adj'];
				$filenames = $images['name'];
				if(count($filenames)>0){
					for($i=0; $i < count($filenames); $i++){
						if ($images['error'][$i] > 0){ 
							$error['files_adj']     = 'error/Ha ocurrido un error'; 
						} else {
							//Se verifican las extensiones de los archivos
							$permitidos = array("image/jpg", 
												"image/jpeg", 
												"image/gif", 
												"image/png"

												);
							//Se verifica que el archivo subido no exceda los 100 kb
							$limite_kb = 1000;
							//Se verifica
							if (in_array($images['type'][$i], $permitidos) && $images['size'][$i] <= $limite_kb * 1024){
								//nada mas que validar
							}else{
								$error['files_adj']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
							}
						}
					}
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Numero de semana
				$Ano     = fecha2Ano($Fecha);
				$Mes     = fecha2NMes($Fecha);
				$Semana  = fecha2NSemana($Fecha);
				$Dia     = fecha2NDiaSemana($Fecha);
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){          $a = "'".$idSistema."'" ;       }else{$a ="''";}
				if(isset($idTelemetria) && $idTelemetria != ''){    $a .= ",'".$idTelemetria."'" ;  }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){          $a .= ",'".$idUsuario."'" ;     }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){                  $a .= ",'".$Fecha."'" ;         }else{$a .= ",''";}
				if(isset($Duracion) && $Duracion != ''){            $a .= ",'".$Duracion."'" ;      }else{$a .= ",''";}
				if(isset($Resumen) && $Resumen != ''){              $a .= ",'".$Resumen."'" ;       }else{$a .= ",''";}
				if(isset($Resolucion) && $Resolucion != ''){        $a .= ",'".$Resolucion."'" ;    }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_historial_mantencion` (idSistema, idTelemetria, idUsuario, Fecha, 
				Duracion, Resumen, Resolucion) 
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
					
					
					/************************************************************/
					//Guardo los archivos en el servidor
					if($_FILES['files_adj']){
						$images = $_FILES['files_adj'];
						$filenames = $images['name'];
						if(count($filenames)>0){
							echo 'true';
							for($i=0; $i < count($filenames); $i++){
								if ($images['error'][$i] > 0){ 
									$error['files_adj'.$i]     = 'error/Ha ocurrido un error'; 
								} else {
									//Se verifican las extensiones de los archivos
									$permitidos = array("image/jpg", 
														"image/jpeg", 
														"image/gif", 
														"image/png"

														);
									//Se verifica que el archivo subido no exceda los 100 kb
									$limite_kb = 1000;
									//Sufijo
									$sufijo = 'tel_mnt_'.$ultimo_id.'_';
						  
									if (in_array($images['type'][$i], $permitidos) && $images['size'][$i] <= $limite_kb * 1024){
										//Se especifica carpeta de destino
										$ruta = "upload/".$sufijo.$images['name'][$i];
										//Se verifica que el archivo un archivo con el mismo nombre no existe
										if (!file_exists($ruta)){
											//Se mueve el archivo a la carpeta previamente configurada
											$move_result = @move_uploaded_file($images["tmp_name"][$i], $ruta);
											if ($move_result){
											
												//Filtro para nombre del archivo
												$nombre_arc = $sufijo.$images['name'][$i] ;

												//filtros
												if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;    }else{$a  ="''";}
												if(isset($nombre_arc) && $nombre_arc != ''){  $a .= ",'".$nombre_arc."'" ;  }else{$a .=",''";}
														
												// inserto los datos de registro en la db
												$query  = "INSERT INTO `telemetria_historial_mantencion_archivos` (idMantencion,Nombre ) 
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

											} else {
												$error['files_adj'.$i]     = 'error/Ocurrio un error al mover el archivo'; 
											}
										} else {
											$error['files_adj'.$i]     = 'error/El archivo '.$images['name'][$i].' ya existe'; 
										}
									}else{
										$error['files_adj'.$i]     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
									}
								}
							}
						}
					}
				
					//Si no hay errores internos
					if ( empty($error) ) {
						//header( 'Location: '.$location.'&created=true' );
						//die;
					}
				}
				
				
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Numero de semana
				$Ano     = fecha2Ano($Duracion);
				$Mes     = fecha2NMes($Duracion);
				$Semana  = fecha2NSemana($Duracion);
				$Dia     = fecha2NDiaSemana($Duracion);
				
				//Filtros
				$a = "idMantencion='".$idMantencion."'" ;
				if(isset($idSistema) && $idSistema != ''){         $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTelemetria) && $idTelemetria != ''){   $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){         $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Fecha) && $Fecha != ''){                 $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Duracion) && $Duracion != ''){           $a .= ",Duracion='".$Duracion."'" ;}
				if(isset($Resumen) && $Resumen != ''){             $a .= ",Resumen='".$Resumen."'" ;}
				if(isset($Resolucion) && $Resolucion != ''){       $a .= ",Resolucion='".$Resolucion."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_historial_mantencion` SET ".$a." WHERE idMantencion = '$idMantencion'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
					
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
				}
				
				/************************************************************/
				//Guardo los archivos en el servidor
				$images = $_FILES['files_adj'];
				$filenames = $images['name'];
				for($i=0; $i < count($filenames); $i++){
					if ($images['error'][$i] > 0){ 
						$error['files_adj'.$i]     = 'error/Ha ocurrido un error'; 
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("application/msword",
											"application/vnd.ms-word",
											"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
													
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
						$limite_kb = 1000;
						//Sufijo
						$sufijo = 'tel_mnt_'.$idMantencion.'_';
			  
						if (in_array($images['type'][$i], $permitidos) && $images['size'][$i] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$images['name'][$i];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($images["tmp_name"][$i], $ruta);
								if ($move_result){
								
									//Filtro para nombre del archivo
									$nombre_arc = $sufijo.$images['name'][$i] ;

									//filtros
									if(isset($idMantencion) && $idMantencion != ''){    $a  = "'".$idMantencion."'" ;    }else{$a  ="''";}
									if(isset($nombre_arc) && $nombre_arc != ''){        $a .= ",'".$nombre_arc."'" ;     }else{$a .=",''";}
											
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `telemetria_historial_mantencion_archivos` (idMantencion,Nombre ) 
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

								} else {
									$error['files_adj'.$i]     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['files_adj'.$i]     = 'error/El archivo '.$images['name'][$i].' ya existe'; 
							}
						}else{
							$error['files_adj'.$i]     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				}
				//Si no hay errores internos
				if ( empty($error) ) {
					header( 'Location: '.$location.'&edited=true' );
					die;
				}

			}
		
	
		break;	
							
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			//Se buscan todos los archivos relacionados
			$arrArchivos = array();
			$query = "SELECT Nombre
			FROM `telemetria_historial_mantencion_archivos`
			WHERE idMantencion = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrArchivos,$row );
			}
			
			//Se recorren los archivos
			foreach ($arrArchivos as $archivos) {
				//se elimina el archivo
				if(isset($archivos['Nombre'])&&$archivos['Nombre']!=''){
					try {
						if(!is_writable('upload/'.$archivos['Nombre'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$archivos['Nombre']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
			}
			
			//se borra la mantencion
			$query  = "DELETE FROM `telemetria_historial_mantencion` WHERE idMantencion = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
					
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
			}
			
			//se borran los archivos relacionados
			$query  = "DELETE FROM `telemetria_historial_mantencion_archivos` WHERE idMantencion = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
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
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Nombre
			FROM `telemetria_historial_mantencion_archivos`
			WHERE idArchivo = {$_GET['del_img']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `telemetria_historial_mantencion_archivos` WHERE idArchivo = {$_GET['del_img']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
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
				
				//Redirijo			
				header( 'Location: '.$location.'&deleted_img=true' );
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
	}
?>
