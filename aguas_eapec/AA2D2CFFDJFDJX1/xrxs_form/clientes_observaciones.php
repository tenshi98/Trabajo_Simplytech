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
	if ( !empty($_POST['idObservacion']) )  $idObservacion   = $_POST['idObservacion'];
	if ( !empty($_POST['idCliente']) )      $idCliente       = $_POST['idCliente'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )          $Fecha           = $_POST['Fecha'];
	if ( !empty($_POST['Observacion']) )    $Observacion     = $_POST['Observacion'];

	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $form_obligatorios);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idObservacion':  if(empty($idObservacion)){   $error['idObservacion']  = 'error/No ha ingresado el id';}break;
			case 'idCliente':      if(empty($idCliente)){       $error['idCliente']      = 'error/No ha seleccionado el cliente';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']      = 'error/No ha seleccionado un usuario';}break;
			case 'Fecha':          if(empty($Fecha)){           $error['Fecha']          = 'error/No ha ingresado la fecha';}break;
			case 'Observacion':    if(empty($Observacion)){     $error['Observacion']    = 'error/No ha ingresado la observacion';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idCliente) && $idCliente != ''){     $a = "'".$idCliente."'" ;       }else{$a ="''";}
				if(isset($idUsuario) && $idUsuario != ''){     $a .= ",'".$idUsuario."'" ;     }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){             $a .= ",'".$Fecha."'" ;         }else{$a .= ",''";}
				if(isset($Observacion) && $Observacion != ''){ $a .= ",'".$Observacion."'" ;   }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `clientes_observaciones` (idCliente, idUsuario, Fecha, Observacion) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
				
				/*********************************************************/
				//Guardo el formulario adjunto
					
					if ($_FILES["Formulario"]["error"] > 0){ 
						$error['Formulario']     = 'error/Ha ocurrido un error'; 
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
						$sufijo = 'clientes_obs_form_';
						  
						if (in_array($_FILES['Formulario']['type'], $permitidos) && $_FILES['Formulario']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Formulario']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Formulario"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "Formulario='".$sufijo.$_FILES['Formulario']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$ultimo_id'";
									$result = mysqli_query($dbConn, $query);
										
								} else {
									$error['Formulario']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Formulario']     = 'error/El archivo '.$_FILES['Formulario']['name'].' ya existe'; 
							}
						} else {
							$error['Formulario']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}

				
				/*********************************************************/
				//Guardo el formulario adjunto
					
					if ($_FILES["Foto"]["error"] > 0){ 
						$error['Foto']     = 'error/Ha ocurrido un error'; 
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
						$sufijo = 'clientes_obs_foto_';
						  
						if (in_array($_FILES['Foto']['type'], $permitidos) && $_FILES['Foto']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Foto']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Foto"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "Foto='".$sufijo.$_FILES['Foto']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$ultimo_id'";
									$result = mysqli_query($dbConn, $query);		
										
								} else {
									$error['Foto']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Foto']     = 'error/El archivo '.$_FILES['Foto']['name'].' ya existe'; 
							}
						} else {
							$error['Foto']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				
				/*********************************************************/	
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idObservacion='".$idObservacion."'" ;
				if(isset($idCliente) && $idCliente != ''){       $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Fecha) && $Fecha != ''){               $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Observacion) && $Observacion != ''){   $a .= ",Observacion='".$Observacion."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$idObservacion'";
				$result = mysqli_query($dbConn, $query);
				
				/*********************************************************/
				//Guardo el formulario adjunto
					
					if ($_FILES["Formulario"]["error"] > 0){ 
						$error['Formulario']     = 'error/Ha ocurrido un error'; 
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
						$sufijo = 'clientes_obs_form_';
						  
						if (in_array($_FILES['Formulario']['type'], $permitidos) && $_FILES['Formulario']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Formulario']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Formulario"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "Formulario='".$sufijo.$_FILES['Formulario']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$idObservacion'";
									$result = mysqli_query($dbConn, $query);
										
								} else {
									$error['Formulario']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Formulario']     = 'error/El archivo '.$_FILES['Formulario']['name'].' ya existe'; 
							}
						} else {
							$error['Formulario']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				
				/*********************************************************/
				//Guardo el formulario adjunto
					
					if ($_FILES["Foto"]["error"] > 0){ 
						$error['Foto']     = 'error/Ha ocurrido un error'; 
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
						$sufijo = 'clientes_obs_foto_';
						  
						if (in_array($_FILES['Foto']['type'], $permitidos) && $_FILES['Foto']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Foto']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Foto"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "Foto='".$sufijo.$_FILES['Foto']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$idObservacion'";
									$result = mysqli_query($dbConn, $query);		
										
								} else {
									$error['Foto']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Foto']     = 'error/El archivo '.$_FILES['Foto']['name'].' ya existe'; 
							}
						} else {
							$error['Foto']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				
				/*********************************************************/
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
							
/*******************************************************************************************************************/
		case 'del':	
			
			
			// Se obtiene el nombre del logo
			$query = "SELECT Formulario, Foto
			FROM `clientes_observaciones`
			WHERE idObservacion = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);		
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `clientes_observaciones` WHERE idObservacion = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);
				
			//Se elimina la imagen
			if(isset($rowdata['Formulario'])&&$rowdata['Formulario']!=''){
				try {
					if(!is_writable('upload/'.$rowdata['Formulario'])){
						//throw new Exception('File not writable');
					}else{
						unlink('upload/'.$rowdata['Formulario']);
					}
				}catch(Exception $e) { 
					//guardar el dato en un archivo log
				}
			}
			//Se elimina el archivo adjunto
			if(isset($rowdata['Foto'])&&$rowdata['Foto']!=''){
				try {
					if(!is_writable('upload/'.$rowdata['Foto'])){
						//throw new Exception('File not writable');
					}else{
						unlink('upload/'.$rowdata['Foto']);
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
		case 'del_formulario':	
			
			// Se obtiene el nombre del logo
			$query = "SELECT Formulario
			FROM `clientes_observaciones`
			WHERE idObservacion = {$_GET['del_formulario']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `clientes_observaciones` SET Formulario='' WHERE idObservacion = '{$_GET['del_formulario']}'";
			$result = mysqli_query($dbConn, $query);
				
			//se elimina el archivo
			if(isset($rowdata['Formulario'])&&$rowdata['Formulario']!=''){
				try {
					if(!is_writable('upload/'.$rowdata['Formulario'])){
						//throw new Exception('File not writable');
					}else{
						unlink('upload/'.$rowdata['Formulario']);
					}
				}catch(Exception $e) { 
					//guardar el dato en un archivo log
				}
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&edit='.$_GET['del_formulario'] );
			die;		

		break;	
/*******************************************************************************************************************/
		case 'del_foto':	
			
			// Se obtiene el nombre del logo
			$query = "SELECT Foto
			FROM `clientes_observaciones`
			WHERE idObservacion = {$_GET['del_foto']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `clientes_observaciones` SET Foto='' WHERE idObservacion = '{$_GET['del_foto']}'";
			$result = mysqli_query($dbConn, $query);
				
			//se elimina el archivo
			if(isset($rowdata['Foto'])&&$rowdata['Foto']!=''){
				try {
					if(!is_writable('upload/'.$rowdata['Foto'])){
						//throw new Exception('File not writable');
					}else{
						unlink('upload/'.$rowdata['Foto']);
					}
				}catch(Exception $e) { 
					//guardar el dato en un archivo log
				}
			}
			
			//Redirijo			
			header( 'Location: '.$location.'&edit='.$_GET['del_foto'] );
			die;		

		break;	
		
/*******************************************************************************************************************/		
		case 'masiva':

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Busco a todos los clientes
				$arrClientes = array();
				$query = "SELECT idCliente
				FROM `clientes_listado`
				WHERE idEstado=1 ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				
				foreach ($arrClientes as $cliente) {
					//filtros
					if(isset($cliente['idCliente']) && $cliente['idCliente'] != ''){     $a = "'".$cliente['idCliente']."'" ;       }else{$a ="''";}
					if(isset($idUsuario) && $idUsuario != ''){                           $a .= ",'".$idUsuario."'" ;                }else{$a .= ",''";}
					if(isset($Fecha) && $Fecha != ''){                                   $a .= ",'".$Fecha."'" ;                    }else{$a .= ",''";}
					if(isset($Observacion) && $Observacion != ''){                       $a .= ",'".$Observacion."'" ;              }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `clientes_observaciones` (idCliente, idUsuario, Fecha, Observacion) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
				
					/*********************************************************/
					//Guardo el formulario adjunto
					if ($_FILES["Formulario"]["error"] > 0){ 
						$error['Formulario']     = 'error/Ha ocurrido un error'; 
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
						$sufijo = 'clientes_obs_form_'.$ultimo_id.'_';
						  
						if (in_array($_FILES['Formulario']['type'], $permitidos) && $_FILES['Formulario']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Formulario']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Formulario"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "Formulario='".$sufijo.$_FILES['Formulario']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$ultimo_id'";
									$result = mysqli_query($dbConn, $query);
										
								} else {
									$error['Formulario']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Formulario']     = 'error/El archivo '.$_FILES['Formulario']['name'].' ya existe'; 
							}
						} else {
							$error['Formulario']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}

				
					/*********************************************************/
					//Guardo el formulario adjunto
					if ($_FILES["Foto"]["error"] > 0){ 
						$error['Foto']     = 'error/Ha ocurrido un error'; 
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
						$sufijo = 'clientes_obs_foto_'.$ultimo_id.'_';
						  
						if (in_array($_FILES['Foto']['type'], $permitidos) && $_FILES['Foto']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Foto']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Foto"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "Foto='".$sufijo.$_FILES['Foto']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_observaciones` SET ".$a." WHERE idObservacion = '$ultimo_id'";
									$result = mysqli_query($dbConn, $query);		
										
								} else {
									$error['Foto']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Foto']     = 'error/El archivo '.$_FILES['Foto']['name'].' ya existe'; 
							}
						} else {
							$error['Foto']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				
				
				}
				
	
				header( 'Location: '.$location.'?created=true' );
				die;
				
			}
	
		break;				
/*******************************************************************************************************************/
	}
?>
