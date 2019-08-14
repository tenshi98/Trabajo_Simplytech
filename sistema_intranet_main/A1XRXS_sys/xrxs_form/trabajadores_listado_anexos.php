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
	if ( !empty($_POST['idBono']) )         $idBono        = $_POST['idBono'];
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador  = $_POST['idTrabajador'];
	if ( !empty($_POST['Fecha_ingreso']) )  $Fecha_ingreso = $_POST['Fecha_ingreso'];
	
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
			case 'idBono':         if(empty($idBono)){        $error['idBono']         = 'error/No ha ingresado el id';}break;
			case 'idTrabajador':   if(empty($idTrabajador)){  $error['idTrabajador']   = 'error/No ha seleccionado el trabajador';}break;
			case 'Fecha_ingreso':  if(empty($Fecha_ingreso)){ $error['Fecha_ingreso']  = 'error/No ha ingresado la fecha del anexo';}break;
			
		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_Documento':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Documento"]["error"] > 0){ 
				$error['Documento']     = 'error/Ha ocurrido un error'; 
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
				$sufijo = 'trabajador_anexo_'.$idTrabajador.'_'.$Fecha_ingreso.'_';
			  
				if (in_array($_FILES['Documento']['type'], $permitidos) && $_FILES['Documento']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Documento']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["Documento"]["tmp_name"], $ruta);
						if ($move_result){
					
							
							//Inserto el registro de las mantenciones
							//filtros
							$a = "'".$sufijo.$_FILES['Documento']['name']."'" ;
							if(isset($idTrabajador) && $idTrabajador != ''){        $a .= ",'".$idTrabajador."'" ;   }else{$a .= ",''";}
							if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){      $a .= ",'".$Fecha_ingreso."'" ;  }else{$a .= ",''";}
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `trabajadores_listado_anexos` (Documento, idTrabajador, Fecha_ingreso) 
							VALUES ({$a} )";
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
							$error['Documento']     = 'error/Ocurrio un error al mover el archivo'; 
						}
					} else {
						$error['Documento']     = 'error/El archivo '.$_FILES['Documento']['name'].' ya existe'; 
					}
				} else {
					$error['Documento']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}


		break;	
/*******************************************************************************************************************/
		case 'del_Documento':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Documento
			FROM `trabajadores_listado_anexos`
			WHERE idAnexo = {$_GET['del_Documento']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `trabajadores_listado_anexos` WHERE idAnexo = {$_GET['del_Documento']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['Documento'])&&$rowdata['Documento']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Documento'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Documento']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id_img=true' );
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
