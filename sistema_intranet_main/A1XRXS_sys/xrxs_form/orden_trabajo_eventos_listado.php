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
	if ( !empty($_POST['idEvento']) )       $idEvento        = $_POST['idEvento'];
	if ( !empty($_POST['idSistema']) )      $idSistema       = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )          $Fecha           = $_POST['Fecha'];
	if ( !empty($_POST['Hora']) )           $Hora            = $_POST['Hora'];
	if ( !empty($_POST['Observacion']) )    $Observacion     = $_POST['Observacion'];
	if ( !empty($_POST['idCliente']) )      $idCliente       = $_POST['idCliente'];
	if ( !empty($_POST['idMaquina']) )      $idMaquina       = $_POST['idMaquina'];
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador    = $_POST['idTrabajador'];
	
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
			case 'idEvento':       if(empty($idEvento)){        $error['idEvento']       = 'error/No ha ingresado el id';}break;
			case 'idSistema':      if(empty($idSistema)){       $error['idSistema']      = 'error/No ha seleccionado un sistema';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']      = 'error/No ha seleccionado un usuario';}break;
			case 'Fecha':          if(empty($Fecha)){           $error['Fecha']          = 'error/No ha ingresado la fecha';}break;
			case 'Hora':           if(empty($Hora)){            $error['Hora']           = 'error/No ha ingresado la Hora';}break;
			case 'Observacion':    if(empty($Observacion)){     $error['Observacion']    = 'error/No ha ingresado la observacion';}break;
			case 'idCliente':      if(empty($idCliente)){       $error['idCliente']      = 'error/No ha seleccionado el ciente';}break;
			case 'idMaquina':      if(empty($idMaquina)){       $error['idMaquina']      = 'error/No ha seleccionado la maquina';}break;
			case 'idTrabajador':   if(empty($idTrabajador)){    $error['idTrabajador']   = 'error/No ha seleccionado el trabajador';}break;
			
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
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){        $a = "'".$idSistema."'" ;        }else{$a ="''";}
				if(isset($idUsuario) && $idUsuario != ''){        $a .= ",'".$idUsuario."'" ;      }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",'".$Fecha."'" ;          }else{$a .= ",''";}
				if(isset($Hora) && $Hora != ''){                  $a .= ",'".$Hora."'" ;           }else{$a .= ",''";}
				if(isset($Observacion) && $Observacion != ''){    $a .= ",'".$Observacion."'" ;    }else{$a .= ",''";}
				if(isset($idCliente) && $idCliente != ''){        $a .= ",'".$idCliente."'" ;      }else{$a .= ",''";}
				if(isset($idMaquina) && $idMaquina != ''){        $a .= ",'".$idMaquina."'" ;      }else{$a .= ",''";}
				if(isset($idTrabajador) && $idTrabajador != ''){  $a .= ",'".$idTrabajador."'" ;   }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `orden_trabajo_eventos_listado` ( idSistema, idUsuario, Fecha, Hora, Observacion,
				idCliente, idMaquina, idTrabajador) VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
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
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEvento='".$idEvento."'" ;
				if(isset($idSistema) && $idSistema != ''){         $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){         $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Fecha) && $Fecha != ''){                 $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Hora) && $Hora != ''){                   $a .= ",Hora='".$Hora."'" ;}
				if(isset($Observacion) && $Observacion != ''){     $a .= ",Observacion='".$Observacion."'" ;}
				if(isset($idCliente) && $idCliente != ''){         $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($idMaquina) && $idMaquina != ''){         $a .= ",idMaquina='".$idMaquina."'" ;}
				if(isset($idTrabajador) && $idTrabajador != ''){   $a .= ",idTrabajador='".$idTrabajador."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `orden_trabajo_eventos_listado` SET ".$a." WHERE idEvento = '$idEvento'";
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
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Listado de archivos
			$arrArchivos = array();
			$query = "SELECT Nombre 
			FROM `orden_trabajo_eventos_listado_archivos`
			WHERE idEvento = {$_GET['del']}";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrArchivos,$row );
			}
			
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `orden_trabajo_eventos_listado` WHERE idEvento = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$query  = "DELETE FROM `orden_trabajo_eventos_listado_archivos` WHERE idEvento = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			
			//se borran los archivos relacionados
			foreach ($arrArchivos as $tipo) {
				//se elimina el archivo
				if(isset($tipo['Nombre'])&&$tipo['Nombre']!=''){
					try {
						if(!is_writable('upload/'.$tipo['Nombre'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$tipo['Nombre']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
			}
			
			//se redirige
			header( 'Location: '.$location.'&deleted=true' );
			die;
			
			
			

		break;							
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["event_file"]["error"] > 0){ 
				$error['event_file']     = 'error/Ha ocurrido un error'; 
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
				$sufijo = 'maq_event_'.$idEvento.'_';
			  
				if (in_array($_FILES['event_file']['type'], $permitidos) && $_FILES['event_file']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['event_file']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["event_file"]["tmp_name"], $ruta);
						if ($move_result){
					
							//Filtro para idSistema
							$a  = "'".$idEvento."'" ;
							$a .= ",'".$sufijo.$_FILES['event_file']['name']."'" ;
							
							//se ejecuta la consulta
							$query  = "INSERT INTO `orden_trabajo_eventos_listado_archivos` ( idEvento, Nombre) VALUES ({$a} )";
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
							$error['event_file']     = 'error/Ocurrio un error al mover el archivo'; 
						}
					} else {
						$error['event_file']     = 'error/El archivo '.$_FILES['event_file']['name'].' ya existe'; 
					}
				} else {
					$error['event_file']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}


		break;	
/*******************************************************************************************************************/
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Usuario
			$idArchivo = $_GET['del_file'];
			// Se obtiene el nombre del logo
			$query = "SELECT Nombre
			FROM `orden_trabajo_eventos_listado_archivos`
			WHERE idArchivo = {$idArchivo}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `orden_trabajo_eventos_listado_archivos` WHERE idArchivo = {$idArchivo}";
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
