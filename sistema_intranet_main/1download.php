<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Ejecucion de la logica                                                         */
/**********************************************************************************************************************************/
//Se verifica si existe el directorio y el nombre del archivo a descargar
if(isset($_GET['dir'], $_GET['file'])&&$_GET['dir']!=''&&$_GET['file']!=''){

	/************************************************/
	//se decodifica los datos
	$Directorio = simpleDecode($_GET['dir'], fecha_actual());
	$Archivo    = simpleDecode($_GET['file'], fecha_actual());

	//enlace
	$file = $Directorio."/".$Archivo;

	/************************************************/
	//Se verifica si la ruta es local
	$needle = 'http';
	//en el caso de que sea remoto, ejecuto javascript
	if (strpos($Directorio, $needle) !== false) {
		echo '<a href="'.$file.'" download></a>';
		echo '<script>
			function testCallBack(){
				setTimeout(()=>{
					window.close();
				},2000);
			}
			document.querySelector("a").click();
			testCallBack();
		</script>';
	//en el caso de que sea local
	}else{
		header("Content-Description: File Transfer");
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"". basename($file) ."\"");

		readfile ($file);
		exit();

	}

}

?>


