<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idCard']) )           $idCard           = $_POST['idCard'];
	if ( !empty($_POST['idCardImage']) )      $idCardImage      = $_POST['idCardImage'];
	if ( !empty($_POST['idCardType']) )       $idCardType       = $_POST['idCardType'];
	if ( !empty($_POST['idPosition']) )       $idPosition       = $_POST['idPosition'];
	if ( !empty($_POST['Nombre']) )           $Nombre           = $_POST['Nombre'];
	if ( !empty($_POST['Direccion_img']) )    $Direccion_img    = $_POST['Direccion_img'];
	

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
			case 'idCard':          if(empty($idCard)){           $error['idCard']          = 'error/No ha ingresado el id';}break;
			case 'idCardImage':     if(empty($idCardImage)){      $error['idCardImage']     = 'error/No ha seleccionado el uso de la imagen';}break;
			case 'idCardType':      if(empty($idCardType)){       $error['idCardType']      = 'error/No ha seleccionado el tipo de alineacion';}break;
			case 'idPosition':      if(empty($idPosition)){       $error['idPosition']      = 'error/No ha seleccionado la posicion del texto';}break;
			case 'Nombre':          if(empty($Nombre)){           $error['Nombre']          = 'error/No ha ingresado el nombre';}break;
			case 'Direccion_img':   if(empty($Direccion_img)){    $error['Direccion_img']   = 'error/No ha adjuntado una imagen';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){  $error['Nombre'] = 'error/Edita Nombre, contiene palabras no permitidas'; }	

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
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'card_listado', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idCardImage) && $idCardImage != ''){   $a  = "'".$idCardImage."'" ;   }else{$a  ="''";}
				if(isset($idCardType) && $idCardType != ''){     $a .= ",'".$idCardType."'" ;   }else{$a .=",''";}
				if(isset($idPosition) && $idPosition != ''){     $a .= ",'".$idPosition."'" ;   }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",'".$Nombre."'" ;       }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `card_listado` (idCardImage,idCardType,idPosition,Nombre ) 
				VALUES (".$a.")";
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idCard)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'card_listado', '', "Nombre='".$Nombre."' AND idCard!='".$idCard."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idCard='".$idCard."'" ;
				if(isset($idCardImage) && $idCardImage != ''){  $a .= ",idCardImage='".$idCardImage."'" ;}
				if(isset($idCardType) && $idCardType != ''){    $a .= ",idCardType='".$idCardType."'" ;}
				if(isset($idPosition) && $idPosition != ''){    $a .= ",idPosition='".$idPosition."'" ;}
				if(isset($Nombre) && $Nombre != ''){            $a .= ",Nombre='".$Nombre."'" ;}
											
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `card_listado` SET ".$a." WHERE idCard = '$idCard'";
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
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Direccion_img"]["error"] > 0){
				$error['Direccion_img'] = 'error/'.uploadPHPError($_FILES["Direccion_img"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'card_img_'.$idCard.'_';
				  
				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						
						//se sube y se transforma la imagen
						$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], "upload/xxxsxx_".$_FILES['Direccion_img']['name']);
						if ($move_result){
						
							//se selecciona la imagen
							switch ($_FILES['Direccion_img']['type']) {
								case 'image/jpg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/jpeg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/gif':
									$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/png':
									$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
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
								if(!is_writable('upload/xxxsxx_'.$_FILES['Direccion_img']['name'])){
									//throw new Exception('File not writable');
								}else{
									unlink('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
								}
							}catch(Exception $e) { 
								//guardar el dato en un archivo log
							}
							//se eliminan las imagenes de la memoria
							imagedestroy($imgBase);

							//Filtro para idSistema		
							$a = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'" ;
							if(isset($idCardImageImagen) && $idCardImageImagen != ''){       $a .= ",idCardImageImagen='".$idCardImageImagen."'" ;}
							
							// inserto los datos de registro en la db
							$query  = "UPDATE `card_listado` SET ".$a." WHERE idCard = '$idCard'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location.'&img_id='.$idCard );
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
							$error['Direccion_img']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['Direccion_img']       = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
					}
				} else {
					$error['Direccion_img']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;

/*******************************************************************************************************************/
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'Direccion_img', 'card_listado', '', "idCard = ".$_GET['del_img'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			//se borra el dato de la base de datos
			$query  = "UPDATE `card_listado` SET Direccion_img='' WHERE idCard = '".$_GET['del_img']."'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Direccion_img'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Direccion_img']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_img'] );
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
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del']) OR !validaEntero($_GET['del']))&&$_GET['del']!=''){
				$indice = simpleDecode($_GET['del'], fecha_actual());
			}else{
				$indice = $_GET['del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				// Se obtiene el nombre del logo
				$rowdata = db_select_data (false, 'Direccion_img', 'card_listado', '', "idCard = ".$indice, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los datos
				$resultado = db_delete_data (false, 'card_listado', 'idCard = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//Se elimina la imagen
					if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['Direccion_img'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['Direccion_img']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			

		break;							
		
/*******************************************************************************************************************/
	}
?>
