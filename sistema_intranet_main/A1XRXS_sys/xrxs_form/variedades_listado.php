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
	if ( !empty($_POST['idProducto']) )       $idProducto       = $_POST['idProducto'];
	if ( !empty($_POST['idTipo']) )           $idTipo           = $_POST['idTipo'];
	if ( !empty($_POST['idCategoria']) )      $idCategoria      = $_POST['idCategoria'];
	if ( !empty($_POST['Nombre']) )           $Nombre           = $_POST['Nombre'];
	if ( !empty($_POST['Descripcion']) )      $Descripcion      = $_POST['Descripcion'];
	if ( !empty($_POST['Codigo']) )           $Codigo           = $_POST['Codigo'];
	if ( !empty($_POST['MaxAplicacion']) )    $MaxAplicacion    = $_POST['MaxAplicacion'];
	if ( !empty($_POST['Direccion_img']) )    $Direccion_img    = $_POST['Direccion_img'];
	if ( !empty($_POST['FichaTecnica']) )     $FichaTecnica     = $_POST['FichaTecnica'];
	if ( !empty($_POST['HDS']) )              $HDS              = $_POST['HDS'];
	if ( !empty($_POST['idEstado']) )         $idEstado         = $_POST['idEstado'];
	if ( !empty($_POST['idTipoImagen']) )     $idTipoImagen     = $_POST['idTipoImagen'];
	if ( !empty($_POST['idOpciones_1']) )     $idOpciones_1     = $_POST['idOpciones_1'];
	if ( !empty($_POST['idOpciones_2']) )     $idOpciones_2     = $_POST['idOpciones_2'];
	if ( !empty($_POST['idOpciones_3']) )     $idOpciones_3     = $_POST['idOpciones_3'];
	if ( !empty($_POST['idOpciones_4']) )     $idOpciones_4     = $_POST['idOpciones_4'];
	if ( !empty($_POST['idOpciones_5']) )     $idOpciones_5     = $_POST['idOpciones_5'];
	if ( !empty($_POST['idOpciones_6']) )     $idOpciones_6     = $_POST['idOpciones_6'];
	if ( !empty($_POST['idOpciones_7']) )     $idOpciones_7     = $_POST['idOpciones_7'];
	if ( !empty($_POST['idOpciones_8']) )     $idOpciones_8     = $_POST['idOpciones_8'];
	if ( !empty($_POST['idOpciones_9']) )     $idOpciones_9     = $_POST['idOpciones_9'];
	

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
			case 'idProducto':      if(empty($idProducto)){       $error['idProducto']      = 'error/No ha ingresado el id';}break;
			case 'idTipo':          if(empty($idTipo)){           $error['idTipo']          = 'error/No ha seleccionado el tipo de producto';}break;
			case 'idCategoria':     if(empty($idCategoria)){      $error['idCategoria']     = 'error/No ha seleccionado la categoria del producto';}break;
			case 'Nombre':          if(empty($Nombre)){           $error['Nombre']          = 'error/No ha ingresado el nombre del producto';}break;
			case 'Descripcion':     if(empty($Descripcion)){      $error['Descripcion']     = 'error/No ha ingresado una Descripcion';}break;
			case 'Codigo':          if(empty($Codigo)){           $error['Codigo']          = 'error/No ha ingresado un Codigo';}break;
			case 'MaxAplicacion':   if(empty($MaxAplicacion)){    $error['MaxAplicacion']   = 'error/No ha ingresado el maximo de dias de aplicacion';}break;
			case 'Direccion_img':   if(empty($Direccion_img)){    $error['Direccion_img']   = 'error/No ha adjuntado una imagen';}break;
			case 'FichaTecnica':    if(empty($FichaTecnica)){     $error['FichaTecnica']    = 'error/No ha adjuntado una ficha tecnica';}break;
			case 'HDS':             if(empty($HDS)){              $error['HDS']             = 'error/No ha adjuntado un archivo de seguridad';}break;
			case 'idEstado':        if(empty($idEstado)){         $error['idEstado']        = 'error/No ha ingresado el estado del producto';}break;
			case 'idTipoImagen':    if(empty($idTipoImagen)){     $error['idTipoImagen']    = 'error/No ha seleccionado el tipo de imagen';}break;
			case 'idOpciones_1':    if(empty($idOpciones_1)){     $error['idOpciones_1']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_2':    if(empty($idOpciones_2)){     $error['idOpciones_2']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_3':    if(empty($idOpciones_3)){     $error['idOpciones_3']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_4':    if(empty($idOpciones_4)){     $error['idOpciones_4']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_5':    if(empty($idOpciones_5)){     $error['idOpciones_5']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_6':    if(empty($idOpciones_6)){     $error['idOpciones_6']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_7':    if(empty($idOpciones_7)){     $error['idOpciones_7']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_8':    if(empty($idOpciones_8)){     $error['idOpciones_8']    = 'error/No ha seleccionado una opcion';}break;
			case 'idOpciones_9':    if(empty($idOpciones_9)){     $error['idOpciones_9']    = 'error/No ha seleccionado una opcion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){            $error['Nombre']      = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){  $error['Descripcion'] = 'error/Edita la Descripcion, contiene palabras no permitidas'; }	
	if(isset($Codigo)&&contar_palabras_censuradas($Codigo)!=0){            $error['Codigo']      = 'error/Edita Codigo, contiene palabras no permitidas'; }	
	
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
				$ndata_1 = db_select_nrows (false, 'Nombre', 'variedades_listado', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTipo) && $idTipo != ''){                   $a  = "'".$idTipo."'" ;           }else{$a  ="''";}
				if(isset($idCategoria) && $idCategoria != ''){         $a .= ",'".$idCategoria."'" ;     }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                   $a .= ",'".$Nombre."'" ;          }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){         $a .= ",'".$Descripcion."'" ;     }else{$a .=",''";}
				if(isset($Codigo) && $Codigo != ''){                   $a .= ",'".$Codigo."'" ;          }else{$a .=",''";}
				if(isset($MaxAplicacion) && $MaxAplicacion != ''){     $a .= ",'".$MaxAplicacion."'" ;   }else{$a .=",''";}
				if(isset($Direccion_img) && $Direccion_img != ''){     $a .= ",'".$Direccion_img."'" ;   }else{$a .=",''";}
				if(isset($FichaTecnica) && $FichaTecnica != ''){       $a .= ",'".$FichaTecnica."'" ;    }else{$a .=",''";}
				if(isset($HDS) && $HDS != ''){                         $a .= ",'".$HDS."'" ;             }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){               $a .= ",'".$idEstado."'" ;        }else{$a .=",''";}
				if(isset($idTipoImagen) && $idTipoImagen != ''){       $a .= ",'".$idTipoImagen."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_1) && $idOpciones_1 != ''){       $a .= ",'".$idOpciones_1."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_2) && $idOpciones_2 != ''){       $a .= ",'".$idOpciones_2."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_3) && $idOpciones_3 != ''){       $a .= ",'".$idOpciones_3."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_4) && $idOpciones_4 != ''){       $a .= ",'".$idOpciones_4."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_5) && $idOpciones_5 != ''){       $a .= ",'".$idOpciones_5."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_6) && $idOpciones_6 != ''){       $a .= ",'".$idOpciones_6."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_7) && $idOpciones_7 != ''){       $a .= ",'".$idOpciones_7."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_8) && $idOpciones_8 != ''){       $a .= ",'".$idOpciones_8."'" ;    }else{$a .=",''";}
				if(isset($idOpciones_9) && $idOpciones_9 != ''){       $a .= ",'".$idOpciones_9."'" ;    }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `variedades_listado` (idTipo,idCategoria,Nombre,
				Descripcion,Codigo,MaxAplicacion,Direccion_img,FichaTecnica,HDS, idEstado, idTipoImagen,
				idOpciones_1, idOpciones_2, idOpciones_3, idOpciones_4, idOpciones_5, idOpciones_6, 
				idOpciones_7, idOpciones_8, idOpciones_9 ) 
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
			if(isset($Nombre)&&isset($idProducto)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'variedades_listado', '', "Nombre='".$Nombre."' AND idProducto!='".$idProducto."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idProducto='".$idProducto."'" ;
				if(isset($idTipo) && $idTipo != ''){                   $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idCategoria) && $idCategoria != ''){         $a .= ",idCategoria='".$idCategoria."'" ;}
				if(isset($Nombre) && $Nombre != ''){                   $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){         $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($Codigo) && $Codigo != ''){                   $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($MaxAplicacion) && $MaxAplicacion != ''){     $a .= ",MaxAplicacion='".$MaxAplicacion."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){     $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($FichaTecnica) && $FichaTecnica != ''){       $a .= ",FichaTecnica='".$FichaTecnica."'" ;}
				if(isset($HDS) && $HDS != ''){                         $a .= ",HDS='".$HDS."'" ;}
				if(isset($idEstado) && $idEstado != ''){               $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTipoImagen) && $idTipoImagen != ''){       $a .= ",idTipoImagen='".$idTipoImagen."'" ;}
				if(isset($idOpciones_1) && $idOpciones_1 != ''){       $a .= ",idOpciones_1='".$idOpciones_1."'" ;}
				if(isset($idOpciones_2) && $idOpciones_2 != ''){       $a .= ",idOpciones_2='".$idOpciones_2."'" ;}
				if(isset($idOpciones_3) && $idOpciones_3 != ''){       $a .= ",idOpciones_3='".$idOpciones_3."'" ;}
				if(isset($idOpciones_4) && $idOpciones_4 != ''){       $a .= ",idOpciones_4='".$idOpciones_4."'" ;}
				if(isset($idOpciones_5) && $idOpciones_5 != ''){       $a .= ",idOpciones_5='".$idOpciones_5."'" ;}
				if(isset($idOpciones_6) && $idOpciones_6 != ''){       $a .= ",idOpciones_6='".$idOpciones_6."'" ;}
				if(isset($idOpciones_7) && $idOpciones_7 != ''){       $a .= ",idOpciones_7='".$idOpciones_7."'" ;}
				if(isset($idOpciones_8) && $idOpciones_8 != ''){       $a .= ",idOpciones_8='".$idOpciones_8."'" ;}
				if(isset($idOpciones_9) && $idOpciones_9 != ''){       $a .= ",idOpciones_9='".$idOpciones_9."'" ;}
											
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
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
				$sufijo = 'prod_img_'.$idProducto.'_';
				  
				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						//$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
						//Muevo el archivo
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
							if(isset($idTipoImagen) && $idTipoImagen != ''){       $a .= ",idTipoImagen='".$idTipoImagen."'" ;}
							
							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){
								
								header( 'Location: '.$location.'&img_id='.$idProducto );
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
		case 'submit_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["FichaTecnica"]["error"] > 0){
				$error['FichaTecnica'] = 'error/'.uploadPHPError($_FILES["FichaTecnica"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/pdf", "application/octet-stream", "application/x-real", "application/vnd.adobe.xfdf", "application/vnd.fdf", "binary/octet-stream");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'prod_file_'.$idProducto.'_';
				  
				if (in_array($_FILES['FichaTecnica']['type'], $permitidos) && $_FILES['FichaTecnica']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['FichaTecnica']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["FichaTecnica"]["tmp_name"], $ruta);
						if ($move_result){
								
							//Filtro para idSistema		
							$a = "FichaTecnica='".$sufijo.$_FILES['FichaTecnica']['name']."'" ;
							
							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){
								
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
							$error['FichaTecnica']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['FichaTecnica']       = 'error/El archivo '.$_FILES['FichaTecnica']['name'].' ya existe';
					}
				} else {
					$error['FichaTecnica']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'submit_hds':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["HDS"]["error"] > 0){
				$error['HDS'] = 'error/'.uploadPHPError($_FILES["HDS"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/pdf", "application/octet-stream", "application/x-real", "application/vnd.adobe.xfdf", "application/vnd.fdf", "binary/octet-stream");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'prod_hds_'.$idProducto.'_';
				  
				if (in_array($_FILES['HDS']['type'], $permitidos) && $_FILES['HDS']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['HDS']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["HDS"]["tmp_name"], $ruta);
						if ($move_result){
								
							//Filtro para idSistema		
							$a = "HDS='".$sufijo.$_FILES['HDS']['name']."'" ;
							
							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){
								
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
							$error['HDS']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['HDS']       = 'error/El archivo '.$_FILES['HDS']['name'].' ya existe';
					}
				} else {
					$error['HDS']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'Direccion_img', 'variedades_listado', '', 'idProducto = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			/*******************************************************/
			//se actualizan los datos
			$a = "Direccion_img='', idTipoImagen=0" ;
			$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
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
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'FichaTecnica', 'variedades_listado', '', 'idProducto = "'.$_GET['del_file'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			/*******************************************************/
			//se actualizan los datos
			$a = "FichaTecnica=''" ;
			$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$_GET['del_file'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				//se elimina el archivo
				if(isset($rowdata['FichaTecnica'])&&$rowdata['FichaTecnica']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['FichaTecnica'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['FichaTecnica']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_file'] );
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
		case 'del_hds':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$rowdata = db_select_data (false, 'HDS', 'variedades_listado', '', 'idProducto = "'.$_GET['del_hds'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			/*******************************************************/
			//se actualizan los datos
			$a = "HDS=''" ;
			$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$_GET['del_hds'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				//se elimina el archivo
				if(isset($rowdata['HDS'])&&$rowdata['HDS']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['HDS'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['HDS']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_hds'] );
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
				$rowdata = db_select_data (false, 'Direccion_img, FichaTecnica, HDS', 'variedades_listado', '', 'idProducto = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//se borran los datos
				$resultado = db_delete_data (false, 'variedades_listado', 'idProducto = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
					//Se elimina el archivo adjunto
					if(isset($rowdata['FichaTecnica'])&&$rowdata['FichaTecnica']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['FichaTecnica'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['FichaTecnica']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					//Se elimina el archivo adjunto
					if(isset($rowdata['HDS'])&&$rowdata['HDS']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['HDS'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['HDS']);
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
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idProducto  = $_GET['id'];
			$idEstado    = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$a = "idEstado='".$idEstado."'" ;
			$resultado = db_update_data (false, $a, 'variedades_listado', 'idProducto = "'.$idProducto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
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
			

		break;	
		
/*******************************************************************************************************************/
	}
?>
