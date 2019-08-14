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
	if ( !empty($_POST['idDocumentacion']) ) $idDocumentacion  = $_POST['idDocumentacion'];
	if ( !empty($_POST['idCurso']) )         $idCurso          = $_POST['idCurso'];
	if ( !empty($_POST['File']) )            $File             = $_POST['File'];
	if ( !empty($_POST['Semana']) )          $Semana           = $_POST['Semana'];
	
	
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
			case 'idDocumentacion': if(empty($idDocumentacion)){   $error['idDocumentacion']  = 'error/No ha ingresado el id';}break;
			case 'idCurso':         if(empty($idCurso)){           $error['idCurso']          = 'error/No ha seleccionado el cliente';}break;
			case 'File':            if(empty($File)){              $error['File']             = 'error/No ha ingresado el nombre';}break;
			case 'Semana':          if(empty($Semana)){            $error['Semana']           = 'error/No ha ingresado la semana';}break;
			
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
			if(isset($File)){
				$ndata_1 = db_select_nrows ('File', 'alumnos_cursos_documentacion', '', "File='".$File."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				if ($_FILES["File"]["error"] > 0){ 
					$error['File']     = 'error/Ha ocurrido un error'; 
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
										
										"audio/basic", 
										"audio/mid", 
										"audio/mpeg", 
										"audio/x-wav",
										
										"video/mpeg", 
										"video/quicktime", 
										"video/x-ms-asf", 
										"video/x-msvideo",
										
										"text/plain",
										"text/richtext",
										
										"image/jpg", 
										"image/jpeg", 
										"image/gif", 
										"image/png"

												);
												
					//Se verifica que el archivo subido no exceda los 100 kb
					$limite_kb = 10000;
					//Sufijo
					$sufijo = 'file_'.$idCurso.'_';
								  
					if (in_array($_FILES['File']['type'], $permitidos) && $_FILES['File']['size'] <= $limite_kb * 1024){
						//Se especifica carpeta de destino
						$ruta = "upload/".$sufijo.$_FILES['File']['name'];
						//Se verifica que el archivo un archivo con el mismo nombre no existe
						if (!file_exists($ruta)){
							//Se mueve el archivo a la carpeta previamente configurada
							$move_result = @move_uploaded_file($_FILES["File"]["tmp_name"], $ruta);
							if ($move_result){
												
								//Filtro para idSistema
								$File = $sufijo.$_FILES['File']['name'];
								
								//filtros
								if(isset($idCurso) && $idCurso != ''){  $a  = "'".$idCurso."'" ;   }else{$a  ="''";}
								if(isset($File) && $File != ''){        $a .= ",'".$File."'" ;     }else{$a .=",''";}
								if(isset($Semana) && $Semana != ''){    $a .= ",'".$Semana."'" ;   }else{$a .=",''";}
								
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `alumnos_cursos_documentacion` (idCurso, File, Semana) VALUES ({$a} )";
								//Consulta
								$resultado = mysqli_query ($dbConn, $query);
								//Si ejecuto correctamente la consulta
								if($resultado){
									
									header( 'Location: '.$location );
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
								$error['File']     = 'error/Ocurrio un error al mover el archivo'; 
							}
						} else {
							$error['File']     = 'error/El archivo '.$_FILES['File']['name'].' ya existe'; 
						}
					} else {
						$error['File']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
					}
				}
				
			}
	
		break;
	
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del archivo
			$rowdata = db_select_data ('File', 'alumnos_cursos_documentacion', '', "idDocumentacion = ".$_GET['delFile'], $dbConn);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `alumnos_cursos_documentacion` WHERE idDocumentacion = {$_GET['delFile']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['File'])&&$rowdata['File']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['File'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['File']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}

				//redirijo			
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
	}
?>
