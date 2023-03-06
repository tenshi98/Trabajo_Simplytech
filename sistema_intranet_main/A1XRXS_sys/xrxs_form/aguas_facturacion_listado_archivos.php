<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-013).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idSistema']))      $idSistema     = $_POST['idSistema'];
	if (!empty($_POST['idUsuario']))      $idUsuario     = $_POST['idUsuario'];

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
			case 'idSistema':   if(empty($idSistema)){   $error['idSistema'] = 'error/No ha Seleccionado el sistema';}break;
			case 'idUsuario':   if(empty($idUsuario)){   $error['idUsuario'] = 'error/No ha Seleccionado el usuario';}break;

		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		case 'upload':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(!isset($idSistema) OR $idSistema==''){
				$ndata_1++;
			}
			if(!isset($idUsuario) OR $idUsuario==''){
				$ndata_1++;
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/No se han identificado los datos basicos';}
			/*******************************************************************/

			//Se verifica que el archivo subido no exceda los 100 kb
			$limite_kb = 10000;
			//Sufijo
			$sufijo = 'boleta_'.ano_actual().'_'.mes_actual().'_';
			//Se verifican las extensiones de los archivos
			$permitidos = array("application/pdf",
								"application/octet-stream",
								"application/x-real",
								"application/vnd.adobe.xfdf",
								"application/vnd.fdf",
								"binary/octet-stream"
								);

			//Verifico errores en los archivos
			foreach($_FILES["File_Upload"]["tmp_name"] as $key=>$tmp_name){
				if ($_FILES["File_Upload"]["error"][$key] > 0){
					$error['File_Upload'] = 'error/'.uploadPHPError($_FILES["File_Upload"]["error"][$key]);
				}
				if (in_array($_FILES['File_Upload']['type'][$key], $permitidos) && $_FILES['File_Upload']['size'][$key] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['File_Upload']['name'][$key];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (file_exists($ruta)){
						$error['File_Upload']     = 'error/El archivo '.$_FILES['File_Upload']['name'][$key].' ya existe';
					}
				} else {
					$error['File_Upload']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

			//si no hay errores
			if(empty($error)){

				//vaariable
				$idInterno = 0;

				//Verifico errores en los archivos
				foreach($_FILES["File_Upload"]["tmp_name"] as $key=>$tmp_name){
					if ($_FILES["File_Upload"]["error"][$key] > 0){
						$error['File_Upload'] = 'error/'.uploadPHPError($_FILES["File_Upload"]["error"][$key]);
					}
					if (in_array($_FILES['File_Upload']['type'][$key], $permitidos) && $_FILES['File_Upload']['size'][$key] <= $limite_kb * 1024){
						//Se especifica carpeta de destino
						$ruta = "upload/".$sufijo.$_FILES['File_Upload']['name'][$key];
						//Se verifica que el archivo un archivo con el mismo nombre no existe
						if (!file_exists($ruta)){
							//Se mueve el archivo a la carpeta previamente configurada
							$move_result = @move_uploaded_file($_FILES["File_Upload"]["tmp_name"][$key], $ruta);
							if ($move_result){

								//se cuenta la cantidad de archivos satisfactoriamente subidos
								$idInterno++;

							} else {
								$error['File_Upload']     = 'error/Ocurrio un error al mover el archivo';
							}
						}else{
							$error['File_Upload']     = 'error/El archivo '.$_FILES['File_Upload']['name'][$key].' ya existe';
						}
					} else {
						$error['File_Upload']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
					}
				}

				//si se subio a lo menos unarchivo
				if($idInterno!=0){
					header( 'Location: '.$location.'?filUp='.$idInterno );
					die;
				}
			}

		break;
/*******************************************************************************************************************/
	}

?>
