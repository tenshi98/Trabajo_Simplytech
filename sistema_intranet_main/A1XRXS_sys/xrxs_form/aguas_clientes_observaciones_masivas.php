<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-008).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idObservacion']) )  $idObservacion   = $_POST['idObservacion'];
	if ( !empty($_POST['idCliente']) )      $idCliente       = $_POST['idCliente'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )          $Fecha           = $_POST['Fecha'];
	if ( !empty($_POST['Observacion']) )    $Observacion     = $_POST['Observacion'];
	if ( !empty($_POST['idTipo']) )         $idTipo          = $_POST['idTipo'];
	if ( !empty($_POST['idFacturable']) )   $idFacturable    = $_POST['idFacturable'];
	if ( !empty($_POST['idSector']) )       $idSector        = $_POST['idSector'];
	if ( !empty($_POST['NClientes']) )      $NClientes       = $_POST['NClientes'];

/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$INT_piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($INT_piezas as $INT_valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($INT_valor) {
			case 'idObservacion':  if(empty($idObservacion)){   $error['idObservacion']  = 'error/No ha ingresado el id';}break;
			case 'idCliente':      if(empty($idCliente)){       $error['idCliente']      = 'error/No ha seleccionado el cliente';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']      = 'error/No ha seleccionado un usuario';}break;
			case 'Fecha':          if(empty($Fecha)){           $error['Fecha']          = 'error/No ha ingresado la fecha';}break;
			case 'Observacion':    if(empty($Observacion)){     $error['Observacion']    = 'error/No ha ingresado la observacion';}break;
			case 'idTipo':         if(empty($idTipo)){          $error['idTipo']         = 'error/No ha seleccionado el tipo';}break;
			case 'idFacturable':   if(empty($idFacturable)){    $error['idFacturable']   = 'error/No ha seleccionado la forma de cobro';}break;
			case 'idSector':       if(empty($idSector)){        $error['idSector']       = 'error/No ha seleccionado el sector';}break;
			case 'NClientes':      if(empty($NClientes)){       $error['NClientes']      = 'error/No ha ingresado el numero de clientes';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/	
	if(isset($Observacion) && $Observacion != ''){ $Observacion = EstandarizarInput($Observacion); }
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Observacion)&&contar_palabras_censuradas($Observacion)!=0){  $error['Observacion'] = 'error/Edita la Observacion, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'send_masivo':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//verifico la cantidad a enviar
			if(!isset($NClientes) OR $NClientes==0){
				$error['ndata_1'] = 'error/No hay clientes en el listado de envio';
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/**********************************************************/
				//Variable de busqueda
				$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
				/**********************************************************/
				//Se aplican los filtros
				if(isset($idCliente) && $idCliente != ''){        $z .= " AND aguas_clientes_listado.idCliente=".$idCliente;}
				if(isset($idTipo) && $idTipo != ''){              $z .= " AND aguas_clientes_listado.idTipo=".$idTipo;}
				if(isset($idFacturable) && $idFacturable != ''){  $z .= " AND aguas_clientes_listado.idFacturable=".$idFacturable;}
				if(isset($idSector) && $idSector != ''){          $z .= " AND aguas_clientes_listado.idSector=".$idSector;}
				/**********************************************************/
				// Se trae un listado con todos los elementos
				$arrUsers = array();
				$arrUsers = db_select_array (false, 'idCliente', 'aguas_clientes_listado', 0, $z, 0, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				
				//recorro los resultados
				foreach ($arrUsers as $usuarios) {
					
					$idCliente = $usuarios['idCliente'];
					//filtros
					if(isset($idCliente) && $idCliente != ''){     $SIS_data  = "'".$idCliente."'" ;      }else{$SIS_data  = "''";}
					if(isset($idUsuario) && $idUsuario != ''){     $SIS_data .= ",'".$idUsuario."'" ;     }else{$SIS_data .= ",''";}
					if(isset($Fecha) && $Fecha != ''){             $SIS_data .= ",'".$Fecha."'" ;         }else{$SIS_data .= ",''";}
					if(isset($Observacion) && $Observacion != ''){ $SIS_data .= ",'".$Observacion."'" ;   }else{$SIS_data .= ",''";}
					
					// inserto los datos de registro en la db
					$SIS_columns = 'idCliente, idUsuario, Fecha, Observacion';
					$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_clientes_observaciones', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					//Si ejecuto correctamente la consulta
					if($ultimo_id!=0){
						
						/***********************************************************************************/
						if ($_FILES["Formulario"]["error"] > 0){
							$error['Formulario'] = 'error/'.uploadPHPError($_FILES["Formulario"]["error"]);
						} else {
							//Se verifican las extensiones de los archivos
							$permitidos = array(
												"image/jpg", 
												"image/png", 
												"image/gif", 
												"image/jpeg",
												"image/bmp",
								
												"application/msword",
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
													
												"text/plain",
												"text/richtext",
												"application/rtf",
												
												"application/x-zip-compressed",
												"application/zip",
												"multipart/x-zip",			
												"application/x-7z-compressed",
												"application/x-rar-compressed",
												"application/gzip",
												"application/x-gzip",
												"application/x-gtar",
												"application/x-tgz",
												"application/octet-stream"
											);
							//Se verifica que el archivo subido no exceda los 100 kb
							$limite_kb = 10000;
							//Sufijo
							$sufijo = 'aguas_clientes_formulario_'.$idCliente.'_';
							  
							if (in_array($_FILES['Formulario']['type'], $permitidos) && $_FILES['Formulario']['size'] <= $limite_kb * 1024){
								//Se especifica carpeta de destino
								$ruta = "upload/".$sufijo.$_FILES['Formulario']['name'];
								//Se verifica que el archivo un archivo con el mismo nombre no existe
								if (!file_exists($ruta)){
									//Se mueve el archivo a la carpeta previamente configurada
									$move_result = @move_uploaded_file($_FILES["Formulario"]["tmp_name"], $ruta);
									if ($move_result){
											
										//Filtro para idSistema		
										$SIS_data = "Formulario='".$sufijo.$_FILES['Formulario']['name']."'" ;
										
										/*******************************************************/
										//se actualizan los datos
										$resultado = db_update_data (false, $SIS_data, 'aguas_clientes_observaciones', 'idObservacion = "'.$ultimo_id.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
										//Si ejecuto correctamente la consulta
										if($resultado==true){
											//redirijo
											//header( 'Location: '.$location.'&edited=true' );
											//die;
										}	
									} else {
										$error['Formulario']       = 'error/Ocurrio un error al mover el archivo';
									}
								} else {
									$error['Formulario']       = 'error/El archivo '.$_FILES['Formulario']['name'].' ya existe';
								}
							} else {
								$error['Formulario']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
							}
						}

						
						
						/***********************************************************************************/
						if ($_FILES["Foto"]["error"] > 0){
							$error['Foto'] = 'error/'.uploadPHPError($_FILES["Foto"]["error"]);
						} else {
							//Se verifican las extensiones de los archivos
							$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
							//Se verifica que el archivo subido no exceda los 100 kb
							$limite_kb = 1000;
							//Sufijo
							$sufijo = 'aguas_clientes_foto_'.$idCliente.'_';
							  
							if (in_array($_FILES['Foto']['type'], $permitidos) && $_FILES['Foto']['size'] <= $limite_kb * 1024){
								//Se especifica carpeta de destino
								$ruta = "upload/".$sufijo.$_FILES['Foto']['name'];
								//Se verifica que el archivo un archivo con el mismo nombre no existe
								if (!file_exists($ruta)){
									
									//Muevo el archivo
									$move_result = @move_uploaded_file($_FILES["Foto"]["tmp_name"], "upload/xxxsxx_".$_FILES['Foto']['name']);
									if ($move_result){
										//se selecciona la imagen
										switch ($_FILES['Foto']['type']) {
											case 'image/jpg':
												$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Foto']['name']);
												break;
											case 'image/jpeg':
												$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Foto']['name']);
												break;
											case 'image/gif':
												$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Foto']['name']);
												break;
											case 'image/png':
												$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Foto']['name']);
												break;
										}
											
										//se reescala la imagen en caso de ser necesario
										$imgBase_width = imagesx( $imgBase );
										$imgBase_height = imagesy( $imgBase );
											
										//Se establece el tamaño maximo
										$max_width  = 640;
										$max_height = 640;

										if ($imgBase_width > $imgBase_height) {
											if($imgBase_width < $max_width){
												$newwidth = $imgBase_width;
											}else{
												$newwidth = $max_width;	
											}
											$divisor = $imgBase_width / $newwidth;
											$newheight = floor( $imgBase_height / $divisor);
										}else {
											if($imgBase_height < $max_height){
												$newheight = $imgBase_height;
											}else{
												$newheight =  $max_height;
											} 
											$divisor = $imgBase_height / $newheight;
											$newwidth = floor( $imgBase_width / $divisor );
										}

										$imgBase = imagescale($imgBase, $newwidth, $newheight);

										//se establece la calidad del archivo
										$quality = 75;
											
										//se crea la imagen
										imagejpeg($imgBase, $ruta, $quality);
											
										//se elimina la imagen base
										try {
											if(!is_writable('upload/xxxsxx_'.$_FILES['Foto']['name'])){
												//throw new Exception('File not writable');
											}else{
												unlink('upload/xxxsxx_'.$_FILES['Foto']['name']);
											}
										}catch(Exception $e) { 
											//guardar el dato en un archivo log
										}
										//se eliminan las imagenes de la memoria
										imagedestroy($imgBase);
										
										//Filtro para idSistema		
										$SIS_data = "Foto='".$sufijo.$_FILES['Foto']['name']."'" ;
										
										/*******************************************************/
										//se actualizan los datos
										$resultado = db_update_data (false, $SIS_data, 'aguas_clientes_observaciones', 'idObservacion = "'.$ultimo_id.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
										//Si ejecuto correctamente la consulta
										if($resultado==true){
											//redirijo
											//header( 'Location: '.$location.'&edited=true' );
											//die;
										}	
										
											
									} else {
										$error['Foto']       = 'error/Ocurrio un error al mover el archivo';
									}
								} else {
									$error['Foto']       = 'error/El archivo '.$_FILES['Foto']['name'].' ya existe';
								}
							} else {
								$error['Foto']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
							}
						}
					}
				}
				
				//redirijo
				header( 'Location: '.$location.'?created=true' );
				die;
				
			}
	
		break;
							
						
/*******************************************************************************************************************/
	}
?>
