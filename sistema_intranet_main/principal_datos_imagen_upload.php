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
	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	
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
			$a = "Direccion_img='".$imageName."'" ;

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
