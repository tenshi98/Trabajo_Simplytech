<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Excel.php';
/**********************************************************************************************************************************/
/*                                                 Ejecucion de codigo                                                            */
/**********************************************************************************************************************************/


if(isset($_POST["image"])){

	//Se obtiene la imagen
	$img  = $_POST['image']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
	$img  = str_replace('data:image/png;base64,', '', $img);
	$img  = str_replace(' ', '+', $img);
	$data = base64_decode($img);

	$idUsuario  = $_SESSION['usuario']['basic_data']['idUsuario'];
	$imageName  = 'usr_img_'.$idUsuario.'_'.time().'.png';
	$ruta       = "upload/".$imageName;

	//Se verifica que el archivo un archivo con el mismo nombre no existe
	if (!file_exists($ruta)){
		//Se mueve el archivo a la carpeta previamente configurada
		//$resultado = @move_uploaded_file($imageName, $ruta);
		$resultado = file_put_contents($ruta, $data);
		if ($resultado){
											
			//Filtro para idSistema
			$a = "Direccion_img='".$imageName."'";

			// inserto los datos de registro en la db
			$query  = "UPDATE `usuarios_listado` SET ".$a." WHERE idUsuario = '$idUsuario'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
								
				//Seteo la variable de sesion si existe
				if(isset($_SESSION['usuario']['basic_data']['Direccion_img'])){
					$_SESSION['usuario']['basic_data']['Direccion_img'] = $imageName;
				}
			}
		} else {
			$error['imgLogo']     = 'error/Ocurrio un error al mover el archivo';
		}
	} else {
		$error['imgLogo']     = 'error/El archivo '.$imageName.' ya existe';
	}
}

?>
