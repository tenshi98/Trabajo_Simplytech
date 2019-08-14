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
	if ( !empty($_POST['idLicencia']) )            $idLicencia             = $_POST['idLicencia'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idTrabajador']) )          $idTrabajador           = $_POST['idTrabajador'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha_ingreso']) )         $Fecha_ingreso          = $_POST['Fecha_ingreso'];
	if ( !empty($_POST['Fecha_inicio']) )          $Fecha_inicio           = $_POST['Fecha_inicio'];
	if ( !empty($_POST['Fecha_termino']) )         $Fecha_termino          = $_POST['Fecha_termino'];
	if ( !empty($_POST['N_Dias']) )                $N_Dias                 = $_POST['N_Dias'];
	if ( !empty($_POST['Observacion']) )           $Observacion            = $_POST['Observacion'];
	if ( !empty($_POST['idUso']) )                 $idUso                  = $_POST['idUso'];
	
	
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
			case 'idLicencia':            if(empty($idLicencia)){            $error['idLicencia']            = 'error/No ha ingresado el id';}break;
			case 'idSistema':             if(empty($idSistema)){             $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idTrabajador':          if(empty($idTrabajador)){          $error['idTrabajador']          = 'error/No ha seleccionado el trabajador';}break;
			case 'idUsuario':             if(empty($idUsuario)){             $error['idUsuario']             = 'error/No ha seleccionado el usuario';}break;
			case 'Fecha_ingreso':         if(empty($Fecha_ingreso)){         $error['Fecha_ingreso']         = 'error/No ha ingresado la fecha de ingreso del documento';}break;
			case 'Fecha_inicio':          if(empty($Fecha_inicio)){          $error['Fecha_inicio']          = 'error/No ha ingresado la fecha de inicio';}break;
			case 'Fecha_termino':         if(empty($Fecha_termino)){         $error['Fecha_termino']         = 'error/No ha ingresado la fecha de termino';}break;
			case 'N_Dias':                if(empty($N_Dias)){                $error['N_Dias']                = 'error/No ha ingresado el numero de dias';}break;
			case 'Observacion':           if(empty($Observacion)){           $error['Observacion']           = 'error/No ha ingresado la observacion';}break;
			case 'idUso':                 if(empty($idUso)){                 $error['idUso']                 = 'error/No ha seleccionado la utilizacion';}break;
			
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Fecha_inicio)&&isset($idTrabajador)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Fecha_inicio', 'trabajadores_licencias', '', "Fecha_inicio='".$Fecha_inicio."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La licencia ya existe en el sistema';}
			/*******************************************************************/
			//verifico que no se ingrese una fecha superior a la fecha actual
			if($Fecha_inicio>fecha_actual()){
				$error['ndata_1'] = 'error/No puede ingresar una fecha a futuro inexistente';
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se verifica si la imagen existe
				if (!empty($_FILES['File_Licencia']['name'])){
						
					if ($_FILES["File_Licencia"]["error"] > 0){ 
						$error['File_Licencia']     = 'error/Ha ocurrido un error'; 
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
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'licencia_'.$idTrabajador.'_'.fecha_actual().'_';
									  
						if (in_array($_FILES['File_Licencia']['type'], $permitidos) && $_FILES['File_Licencia']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['File_Licencia']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["File_Licencia"]["tmp_name"], $ruta);
								if ($move_result){
									
									//filtros
									if(isset($idSistema) && $idSistema != ''){            $a  = "'".$idSistema."'" ;       }else{$a  ="''";}
									if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",'".$idTrabajador."'" ;   }else{$a .=",''";}
									if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;      }else{$a .=",''";}
									if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){    $a .= ",'".$Fecha_ingreso."'" ;  }else{$a .=",''";}
									if(isset($Fecha_inicio) && $Fecha_inicio != ''){      $a .= ",'".$Fecha_inicio."'" ;   }else{$a .=",''";}
									if(isset($Fecha_termino) && $Fecha_termino != ''){    $a .= ",'".$Fecha_termino."'" ;  }else{$a .=",''";}
									if(isset($N_Dias) && $N_Dias != ''){                  $a .= ",'".$N_Dias."'" ;         }else{$a .=",''";}
									if(isset($Observacion) && $Observacion != ''){        $a .= ",'".$Observacion."'" ;    }else{$a .=",''";}
									if(isset($idUso) && $idUso != ''){                    $a .= ",'".$idUso."'" ;          }else{$a .=",''";}
									$a .= ",'".$sufijo.$_FILES['File_Licencia']['name']."'" ;
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `trabajadores_licencias` (idSistema, idTrabajador, idUsuario,
									Fecha_ingreso, Fecha_inicio, Fecha_termino, N_Dias, Observacion, idUso,File_Licencia) 
									VALUES ({$a} )";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if($resultado){
										
										header( 'Location: '.$location.'&created=true' );
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
													
								} else {
									$error['File_Licencia']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['File_Licencia']     = 'error/El archivo '.$_FILES['File_Licencia']['name'].' ya existe'; 
							}
						} else {
							$error['File_Licencia']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				}else{
					
					//filtros
					if(isset($idSistema) && $idSistema != ''){            $a  = "'".$idSistema."'" ;       }else{$a  ="''";}
					if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",'".$idTrabajador."'" ;   }else{$a .=",''";}
					if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;      }else{$a .=",''";}
					if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){    $a .= ",'".$Fecha_ingreso."'" ;  }else{$a .=",''";}
					if(isset($Fecha_inicio) && $Fecha_inicio != ''){      $a .= ",'".$Fecha_inicio."'" ;   }else{$a .=",''";}
					if(isset($Fecha_termino) && $Fecha_termino != ''){    $a .= ",'".$Fecha_termino."'" ;  }else{$a .=",''";}
					if(isset($N_Dias) && $N_Dias != ''){                  $a .= ",'".$N_Dias."'" ;         }else{$a .=",''";}
					if(isset($Observacion) && $Observacion != ''){        $a .= ",'".$Observacion."'" ;    }else{$a .=",''";}
					if(isset($idUso) && $idUso != ''){                    $a .= ",'".$idUso."'" ;          }else{$a .=",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `trabajadores_licencias` (idSistema, idTrabajador, idUsuario,
					Fecha_ingreso, Fecha_inicio, Fecha_termino, N_Dias, Observacion, idUso) 
					VALUES ({$a} )";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					//Si ejecuto correctamente la consulta
					if($resultado){
						
						header( 'Location: '.$location.'&created=true' );
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
				
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Fecha_inicio)&&isset($idTrabajador)&&isset($idLicencia)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Fecha_inicio', 'trabajadores_licencias', '', "Fecha_inicio='".$Fecha_inicio."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."' AND idLicencia!='".$idLicencia."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La licencia ya existe en el sistema';}
			/*******************************************************************/
			//verifico que no se ingrese una fecha superior a la fecha actual
			if($Fecha_inicio>fecha_actual()){
				$error['ndata_1'] = 'error/No puede ingresar una fecha a futuro inexistente';
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se verifica si la imagen existe
				if (!empty($_FILES['File_Licencia']['name'])){
						
					if ($_FILES["File_Licencia"]["error"] > 0){ 
						$error['File_Licencia']     = 'error/Ha ocurrido un error'; 
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
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'licencia_'.$idTrabajador.'_'.fecha_actual().'_';
									  
						if (in_array($_FILES['File_Licencia']['type'], $permitidos) && $_FILES['File_Licencia']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['File_Licencia']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["File_Licencia"]["tmp_name"], $ruta);
								if ($move_result){
									
									//Filtros
									$a = "idLicencia='".$idLicencia."'" ;
									if(isset($idSistema) && $idSistema != ''){            $a .= ",idSistema='".$idSistema."'" ;}
									if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",idTrabajador='".$idTrabajador."'" ;}
									if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idUsuario='".$idUsuario."'" ;}
									if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){    $a .= ",Fecha_ingreso='".$Fecha_ingreso."'" ;}
									if(isset($Fecha_inicio) && $Fecha_inicio != ''){      $a .= ",Fecha_inicio='".$Fecha_inicio."'" ;}
									if(isset($Fecha_termino) && $Fecha_termino != ''){    $a .= ",Fecha_termino='".$Fecha_termino."'" ;}
									if(isset($N_Dias) && $N_Dias != ''){                  $a .= ",N_Dias='".$N_Dias."'" ;}
									if(isset($Observacion) && $Observacion != ''){        $a .= ",Observacion='".$Observacion."'" ;}
									if(isset($idUso) && $idUso != ''){                    $a .= ",idUso='".$idUso."'" ;}
									$a .= ",File_Licencia='".$sufijo.$_FILES['File_Licencia']['name']."'" ;
									
									
									// inserto los datos de registro en la db
									$query  = "UPDATE `trabajadores_licencias` SET ".$a." WHERE idLicencia = '$idLicencia'";
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
									
								} else {
									$error['File_Licencia']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['File_Licencia']     = 'error/El archivo '.$_FILES['File_Licencia']['name'].' ya existe'; 
							}
						} else {
							$error['File_Licencia']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				}else{
					
					//Filtros
					$a = "idLicencia='".$idLicencia."'" ;
					if(isset($idSistema) && $idSistema != ''){            $a .= ",idSistema='".$idSistema."'" ;}
					if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",idTrabajador='".$idTrabajador."'" ;}
					if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idUsuario='".$idUsuario."'" ;}
					if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){    $a .= ",Fecha_ingreso='".$Fecha_ingreso."'" ;}
					if(isset($Fecha_inicio) && $Fecha_inicio != ''){      $a .= ",Fecha_inicio='".$Fecha_inicio."'" ;}
					if(isset($Fecha_termino) && $Fecha_termino != ''){    $a .= ",Fecha_termino='".$Fecha_termino."'" ;}
					if(isset($N_Dias) && $N_Dias != ''){                  $a .= ",N_Dias='".$N_Dias."'" ;}
					if(isset($Observacion) && $Observacion != ''){        $a .= ",Observacion='".$Observacion."'" ;}
					if(isset($idUso) && $idUso != ''){                    $a .= ",idUso='".$idUso."'" ;}
					
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `trabajadores_licencias` SET ".$a." WHERE idLicencia = '$idLicencia'";
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

			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT File_Licencia
			FROM `trabajadores_licencias`
			WHERE idLicencia = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `trabajadores_licencias` WHERE idLicencia = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina la foto
				if(isset($rowdata['File_Licencia'])&&$rowdata['File_Licencia']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['File_Licencia'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['File_Licencia']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				header( 'Location: '.$location.'&deleted=true' );
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
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Usuario
			$idLicencia = $_GET['del_file'];
			// Se obtiene el nombre del logo
			$query = "SELECT File_Licencia
			FROM `trabajadores_licencias`
			WHERE idLicencia = {$idLicencia}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `trabajadores_licencias` SET File_Licencia='' WHERE idLicencia = '{$idLicencia}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['File_Licencia'])&&$rowdata['File_Licencia']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['File_Licencia'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['File_Licencia']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&delfile=true' );
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
