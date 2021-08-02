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
	if ( !empty($_POST['idMantencion']) ) $idMantencion   = $_POST['idMantencion'];
	if ( !empty($_POST['Fecha']) )        $Fecha          = $_POST['Fecha'];
	if ( !empty($_POST['Hora_ini']) )     $Hora_ini       = $_POST['Hora_ini'];
	if ( !empty($_POST['Hora_fin']) )     $Hora_fin       = $_POST['Hora_fin'];
	if ( !empty($_POST['idUsuario']) )    $idUsuario      = $_POST['idUsuario'];
	if ( !empty($_POST['Descripcion']) )  $Descripcion    = $_POST['Descripcion'];
	
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
			case 'idMantencion':  if(empty($idMantencion)){  $error['idMantencion']  = 'error/No ha ingresado el id';}break;
			case 'Fecha':         if(empty($Fecha)){         $error['Fecha']         = 'error/No ha ingresado la Fecha';}break;
			case 'Hora_ini':      if(empty($Hora_ini)){      $error['Hora_ini']      = 'error/No ha ingresado la Hora de inicio';}break;
			case 'Hora_fin':      if(empty($Hora_fin)){      $error['Hora_fin']      = 'error/No ha ingresado la Hora de termino';}break;
			case 'idUsuario':     if(empty($idUsuario)){     $error['idUsuario']     = 'error/No ha seleccionado el usuario';}break;
			case 'Descripcion':   if(empty($Descripcion)){   $error['Descripcion']   = 'error/No ha ingresado la descripcion';}break;
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){  $error['Descripcion'] = 'error/Edita la Descripcion, contiene palabras no permitidas'; }	

	
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
				if(isset($Fecha) && $Fecha != ''){              $a  = "'".$Fecha."'" ;        }else{$a  ="''";}
				if(isset($Hora_ini) && $Hora_ini != ''){        $a .= ",'".$Hora_ini."'" ;    }else{$a .=",''";}
				if(isset($Hora_fin) && $Hora_fin != ''){        $a .= ",'".$Hora_fin."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){      $a .= ",'".$idUsuario."'" ;   }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){  $a .= ",'".$Descripcion."'" ; }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_mantenciones` (Fecha,Hora_ini, Hora_fin, idUsuario, Descripcion) VALUES (".$a.")";
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
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idMantencion='".$idMantencion."'" ;
				if(isset($Fecha) && $Fecha != ''){               $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Hora_ini) && $Hora_ini != ''){         $a .= ",Hora_ini='".$Hora_ini."'" ;}
				if(isset($Hora_fin) && $Hora_fin != ''){         $a .= ",Hora_fin='".$Hora_fin."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){   $a .= ",Descripcion='".$Descripcion."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `core_mantenciones` SET ".$a." WHERE idMantencion = '$idMantencion'";
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
				//se borran los datos
				$resultado = db_delete_data (false, 'core_mantenciones', 'idMantencion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
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
