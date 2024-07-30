<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-026).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idHijos']))         $idHijos       = $_POST['idHijos'];
	if (!empty($_POST['idApoderado']))     $idApoderado   = $_POST['idApoderado'];
	if (!empty($_POST['Nombre']))          $Nombre        = $_POST['Nombre'];
	if (!empty($_POST['ApellidoPat']))     $ApellidoPat   = $_POST['ApellidoPat'];
	if (!empty($_POST['ApellidoMat']))     $ApellidoMat   = $_POST['ApellidoMat'];
	if (!empty($_POST['idSexo']))          $idSexo        = $_POST['idSexo'];
	if (!empty($_POST['FNacimiento']))     $FNacimiento   = $_POST['FNacimiento'];
	if (!empty($_POST['idPlan']))          $idPlan        = $_POST['idPlan'];
	if (!empty($_POST['idVehiculo']))      $idVehiculo    = $_POST['idVehiculo'];

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
			case 'idHijos':        if(empty($idHijos)){       $error['idHijos']        = 'error/No ha ingresado el id';}break;
			case 'idApoderado':    if(empty($idApoderado)){   $error['idApoderado']    = 'error/No ha seleccionado el apoderado';}break;
			case 'Nombre':         if(empty($Nombre)){        $error['Nombre']         = 'error/No ha ingresado el nombre';}break;
			case 'ApellidoPat':    if(empty($ApellidoPat)){   $error['ApellidoPat']    = 'error/No ha ingresado el apellido paterno';}break;
			case 'ApellidoMat':    if(empty($ApellidoMat)){   $error['ApellidoMat']    = 'error/No ha ingresado el apellido materno';}break;
			case 'idSexo':         if(empty($idSexo)){        $error['idSexo']         = 'error/No ha seleccionado el sexo';}break;
			case 'FNacimiento':    if(empty($FNacimiento)){   $error['FNacimiento']    = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'idPlan':         if(empty($idPlan)){        $error['idPlan']         = 'error/No ha seleccionado el plan';}break;
			case 'idVehiculo':     if(empty($idVehiculo)){    $error['idVehiculo']     = 'error/No ha seleccionado el vehiculo';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Nombre) && $Nombre!=''){           $Nombre      = EstandarizarInput($Nombre);}
	if(isset($ApellidoPat) && $ApellidoPat!=''){ $ApellidoPat = EstandarizarInput($ApellidoPat);}
	if(isset($ApellidoMat) && $ApellidoMat!=''){ $ApellidoMat = EstandarizarInput($ApellidoMat);}

/*******************************************************************************************************************/
/*                                        Verificación de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){            $error['Nombre']      = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($ApellidoPat)&&contar_palabras_censuradas($ApellidoPat)!=0){  $error['ApellidoPat'] = 'error/Edita Apellido Pat, contiene palabras no permitidas';}
	if(isset($ApellidoMat)&&contar_palabras_censuradas($ApellidoMat)!=0){  $error['ApellidoMat'] = 'error/Edita Apellido Mat, contiene palabras no permitidas';}

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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idApoderado)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'apoderados_listado_hijos', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idApoderado='".$idApoderado."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//se verifica si la imagen existe
				if (!empty($_FILES['Direccion_img']['name'])){

					if ($_FILES["Direccion_img"]["error"] > 0){
						$error['Direccion_img']     = 'error/'.uploadPHPError($_FILES["Direccion_img"]["error"]);
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 1000;
						//Sufijo
						$sufijo = 'hijo_img_'.$idApoderado.'_';

						if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								//$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
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

									//filtros
									if(isset($idApoderado) && $idApoderado!=''){    $SIS_data  = "'".$idApoderado."'";    }else{$SIS_data  = "''";}
									if(isset($Nombre) && $Nombre!=''){              $SIS_data .= ",'".$Nombre."'";        }else{$SIS_data .= ",''";}
									if(isset($ApellidoPat) && $ApellidoPat!=''){    $SIS_data .= ",'".$ApellidoPat."'";   }else{$SIS_data .= ",''";}
									if(isset($ApellidoMat) && $ApellidoMat!=''){    $SIS_data .= ",'".$ApellidoMat."'";   }else{$SIS_data .= ",''";}
									if(isset($idSexo) && $idSexo!=''){              $SIS_data .= ",'".$idSexo."'";        }else{$SIS_data .= ",''";}
									if(isset($FNacimiento) && $FNacimiento!=''){    $SIS_data .= ",'".$FNacimiento."'";   }else{$SIS_data .= ",''";}
									if(isset($idPlan) && $idPlan!=''){              $SIS_data .= ",'".$idPlan."'";        }else{$SIS_data .= ",''";}
									if(isset($idVehiculo) && $idVehiculo!=''){      $SIS_data .= ",'".$idVehiculo."'";    }else{$SIS_data .= ",''";}
									$SIS_data .= ",'".$sufijo.$_FILES['Direccion_img']['name']."'";

									// inserto los datos de registro en la db
									$SIS_columns = 'idApoderado, Nombre,ApellidoPat, ApellidoMat, idSexo, FNacimiento, idPlan, idVehiculo, Direccion_img';
									$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'apoderados_listado_hijos', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

									//Si ejecuto correctamente la consulta
									if($ultimo_id!=0){

										//redirijo
										header( 'Location: '.$location.'&created=true' );
										die;

									}

								}else {
									$error['Direccion_img']     = 'error/Ocurrio un error al mover el archivo';
								}
							} else {
								$error['Direccion_img']     = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
							}
						} else {
							$error['Direccion_img']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
						}
					}
				}else{

					//filtros
					if(isset($idApoderado) && $idApoderado!=''){    $SIS_data  = "'".$idApoderado."'";    }else{$SIS_data  = "''";}
					if(isset($Nombre) && $Nombre!=''){              $SIS_data .= ",'".$Nombre."'";        }else{$SIS_data .= ",''";}
					if(isset($ApellidoPat) && $ApellidoPat!=''){    $SIS_data .= ",'".$ApellidoPat."'";   }else{$SIS_data .= ",''";}
					if(isset($ApellidoMat) && $ApellidoMat!=''){    $SIS_data .= ",'".$ApellidoMat."'";   }else{$SIS_data .= ",''";}
					if(isset($idSexo) && $idSexo!=''){              $SIS_data .= ",'".$idSexo."'";        }else{$SIS_data .= ",''";}
					if(isset($FNacimiento) && $FNacimiento!=''){    $SIS_data .= ",'".$FNacimiento."'";   }else{$SIS_data .= ",''";}
					if(isset($idPlan) && $idPlan!=''){              $SIS_data .= ",'".$idPlan."'";        }else{$SIS_data .= ",''";}
					if(isset($idVehiculo) && $idVehiculo!=''){      $SIS_data .= ",'".$idVehiculo."'";    }else{$SIS_data .= ",''";}

					// inserto los datos de registro en la db
					$SIS_columns = 'idApoderado, Nombre,ApellidoPat, ApellidoMat, idSexo, FNacimiento, idPlan, idVehiculo';
					$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'apoderados_listado_hijos', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

					//Si ejecuto correctamente la consulta
					if($ultimo_id!=0){

						//redirijo
						header( 'Location: '.$location.'&created=true' );
						die;

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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idApoderado)&&isset($idHijos)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'apoderados_listado_hijos', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idApoderado='".$idApoderado."' AND idHijos!='".$idHijos."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//se verifica si la imagen existe
				if (!empty($_FILES['Direccion_img']['name'])){

					if ($_FILES["Direccion_img"]["error"] > 0){
						$error['Direccion_img']     = 'error/'.uploadPHPError($_FILES["Direccion_img"]["error"]);
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 1000;
						//Sufijo
						$sufijo = 'hijo_img_'.$idApoderado.'_';

						if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								//$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
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

									//Filtros
									$SIS_data = "idHijos='".$idHijos."'";
									if(isset($idApoderado) && $idApoderado!=''){      $SIS_data .= ",idApoderado='".$idApoderado."'";}
									if(isset($Nombre) && $Nombre!=''){                $SIS_data .= ",Nombre='".$Nombre."'";}
									if(isset($ApellidoPat) && $ApellidoPat!=''){      $SIS_data .= ",ApellidoPat='".$ApellidoPat."'";}
									if(isset($ApellidoMat) && $ApellidoMat!=''){      $SIS_data .= ",ApellidoMat='".$ApellidoMat."'";}
									if(isset($idSexo) && $idSexo!=''){                $SIS_data .= ",idSexo='".$idSexo."'";}
									if(isset($FNacimiento) && $FNacimiento!=''){      $SIS_data .= ",FNacimiento='".$FNacimiento."'";}
									if(isset($idPlan) && $idPlan!=''){                $SIS_data .= ",idPlan='".$idPlan."'";}
									if(isset($idVehiculo) && $idVehiculo!=''){        $SIS_data .= ",idVehiculo='".$idVehiculo."'";}
									$SIS_data .= ",Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'";

									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $SIS_data, 'apoderados_listado_hijos', 'idHijos = "'.$idHijos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									//Si ejecuto correctamente la consulta
									if($resultado==true){

										header( 'Location: '.$location.'&edited=true' );
										die;

									}

								}else {
									$error['Direccion_img']     = 'error/Ocurrio un error al mover el archivo';
								}
							} else {
								$error['Direccion_img']     = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
							}
						} else {
							$error['Direccion_img']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
						}
					}
				}else{

					//Filtros
					$SIS_data = "idHijos='".$idHijos."'";
					if(isset($idApoderado) && $idApoderado!=''){      $SIS_data .= ",idApoderado='".$idApoderado."'";}
					if(isset($Nombre) && $Nombre!=''){                $SIS_data .= ",Nombre='".$Nombre."'";}
					if(isset($ApellidoPat) && $ApellidoPat!=''){      $SIS_data .= ",ApellidoPat='".$ApellidoPat."'";}
					if(isset($ApellidoMat) && $ApellidoMat!=''){      $SIS_data .= ",ApellidoMat='".$ApellidoMat."'";}
					if(isset($idSexo) && $idSexo!=''){                $SIS_data .= ",idSexo='".$idSexo."'";}
					if(isset($FNacimiento) && $FNacimiento!=''){      $SIS_data .= ",FNacimiento='".$FNacimiento."'";}
					if(isset($idPlan) && $idPlan!=''){                $SIS_data .= ",idPlan='".$idPlan."'";}
					if(isset($idVehiculo) && $idVehiculo!=''){        $SIS_data .= ",idVehiculo='".$idVehiculo."'";}

					/*******************************************************/
					//se actualizan los datos
					$resultado = db_update_data (false, $SIS_data, 'apoderados_listado_hijos', 'idHijos = "'.$idHijos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//Si ejecuto correctamente la consulta
					if($resultado==true){

						header( 'Location: '.$location.'&edited=true' );
						die;

					}
				}
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
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero entero';
				$errorn++;
			}

			if($errorn==0){
				// Se obtiene el nombre del archivo
				$rowData = db_select_data (false, 'Direccion_img', 'apoderados_listado_hijos', '', "idHijos = ".$indice, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los datos
				$resultado = db_delete_data (false, 'apoderados_listado_hijos', 'idHijos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){

					//se elimina la foto
					if(isset($rowData['Direccion_img'])&&$rowData['Direccion_img']!=''){
						try {
							if(!is_writable('upload/'.$rowData['Direccion_img'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowData['Direccion_img']);
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
		case 'del_img':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// Se obtiene el nombre del archivo
			$rowData = db_select_data (false, 'Direccion_img', 'apoderados_listado_hijos', '', "idHijos = ".$_GET['del_img'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "Direccion_img=''";
			$resultado = db_update_data (false, $SIS_data, 'apoderados_listado_hijos', 'idHijos = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){

				//se elimina el archivo
				if(isset($rowData['Direccion_img'])&&$rowData['Direccion_img']!=''){
					try {
						if(!is_writable('upload/'.$rowData['Direccion_img'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowData['Direccion_img']);
						}
					}catch(Exception $e) {
						//guardar el dato en un archivo log
					}
				}

				//redirijo
				header( 'Location: '.$location.'&id_img=true' );
				die;

			}

		break;
/*******************************************************************************************************************/
	}

?>
