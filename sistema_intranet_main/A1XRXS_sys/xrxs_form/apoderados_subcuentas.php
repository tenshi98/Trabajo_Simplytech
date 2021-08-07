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
	if ( !empty($_POST['idSubcuenta']) )       $idSubcuenta       = $_POST['idSubcuenta'];
	if ( !empty($_POST['idApoderado']) )       $idApoderado       = $_POST['idApoderado'];
	if ( !empty($_POST['Nombre']) )            $Nombre            = $_POST['Nombre'];
	if ( !empty($_POST['Usuario']) )           $Usuario           = $_POST['Usuario'];
	if ( !empty($_POST['Password']) )          $Password          = $_POST['Password'];
	if ( !empty($_POST['email']) )             $email             = $_POST['email'];
	if ( !empty($_POST['dispositivo']) )       $dispositivo       = $_POST['dispositivo'];
	if ( !empty($_POST['IMEI']) )              $IMEI              = $_POST['IMEI'];
	if ( !empty($_POST['GSM']) )               $GSM               = $_POST['GSM'];
		
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
			case 'idSubcuenta':    if(empty($idSubcuenta)){      $error['idSubcuenta']    = 'error/No ha ingresado el id';}break;
			case 'idApoderado':    if(empty($idApoderado)){      $error['idApoderado']    = 'error/No ha seleccionado el apoderado';}break;
			case 'Nombre':         if(empty($Nombre)){           $error['Nombre']         = 'error/No ha ingresado el nombre de la persona';}break;
			case 'Usuario':        if(empty($Usuario)){          $error['Usuario']        = 'error/No ha ingresado el usuario';}break;
			case 'Password':       if(empty($Password)){         $error['Password']       = 'error/No ha ingresado la contraseña';}break;
			case 'email':          if(empty($email)){            $error['email']          = 'error/No ha ingresado el email';}break;
			case 'dispositivo':    if(empty($dispositivo)){      $error['dispositivo']    = 'error/No ha ingresado el tipo de dispositivo';}break;
			case 'IMEI':           if(empty($IMEI)){             $error['IMEI']           = 'error/No ha ingresado el codigo imei';}break;
			case 'GSM':            if(empty($GSM)){              $error['GSM']            = 'error/No ha ingresado el codigo gsm';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Usuario)){
		if (strpos($Usuario, " ")){                      $error['usuario1'] = 'error/El nombre de usuario contiene espacios vacios';}
		if (strtolower($Usuario) != $Usuario){           $error['usuario2'] = 'error/El nombre de usuario contiene mayusculas';}
	}
	if(isset($Password)){
		if (strpos($Password, " ")){                      $error['Password1'] = 'error/La contraseña de usuario contiene espacios vacios';}
		if (strtolower($Password) != $Password){          $error['Password2'] = 'error/La contraseña de usuario contiene mayusculas';}
	}
	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){     $error['Nombre']   = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Usuario)&&contar_palabras_censuradas($Usuario)!=0){   $error['Usuario']  = 'error/Edita Usuario, contiene palabras no permitidas'; }	
	if(isset($Password)&&contar_palabras_censuradas($Password)!=0){ $error['Password'] = 'error/Edita Password, contiene palabras no permitidas'; }	
	if(isset($email)&&contar_palabras_censuradas($email)!=0){       $error['email']    = 'error/Edita email, contiene palabras no permitidas'; }	
	
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
			if(isset($Usuario)&&isset($Password)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'apoderados_subcuentas', '', "Usuario='".$Usuario."' AND Password='".$Password."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El usuario que intenta ingresar ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				//filtros
				if(isset($idApoderado) && $idApoderado != ''){    $a  = "'".$idApoderado."'" ;   }else{$a  = "''";}
				if(isset($Nombre) && $Nombre != ''){              $a .= ",'".$Nombre."'" ;       }else{$a .= ",''";}
				if(isset($Usuario) && $Usuario != ''){            $a .= ",'".$Usuario."'" ;      }else{$a .= ",''";}
				if(isset($Password) && $Password != ''){          $a .= ",'".$Password."'" ;     }else{$a .= ",''";}
				if(isset($email) && $email != ''){                $a .= ",'".$email."'" ;        }else{$a .= ",''";}
				if(isset($dispositivo) && $dispositivo != ''){    $a .= ",'".$dispositivo."'" ;  }else{$a .= ",''";}
				if(isset($IMEI) && $IMEI != ''){                  $a .= ",'".$IMEI."'" ;         }else{$a .= ",''";}
				if(isset($GSM) && $GSM != ''){                    $a .= ",'".$GSM."'" ;          }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `apoderados_subcuentas` (idApoderado, Nombre, Usuario, 
				Password, email, dispositivo, IMEI, GSM) 
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
			if(isset($Usuario)&&isset($Password)&&isset($idSubcuenta)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'apoderados_subcuentas', '', "Usuario='".$Usuario."' AND Password='".$Password."' AND idSubcuenta!='".$idSubcuenta."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El usuario que intenta ingresar ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSubcuenta='".$idSubcuenta."'" ;
				if(isset($idApoderado) && $idApoderado != ''){  $a .= ",idApoderado='".$idApoderado."'" ;}
				if(isset($Nombre) && $Nombre != ''){            $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Usuario) && $Usuario != ''){          $a .= ",Usuario='".$Usuario."'" ;}
				if(isset($Password) && $Password != ''){        $a .= ",Password='".$Password."'" ;}
				if(isset($email) && $email != ''){              $a .= ",email='".$email."'" ;}
				if(isset($dispositivo) && $dispositivo != ''){  $a .= ",dispositivo='".$dispositivo."'" ;}
				if(isset($IMEI) && $IMEI != ''){                $a .= ",IMEI='".$IMEI."'" ;}
				if(isset($GSM) && $GSM != ''){                  $a .= ",GSM='".$GSM."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'apoderados_subcuentas', 'idSubcuenta = "'.$idSubcuenta.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
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
				$resultado = db_delete_data (false, 'apoderados_subcuentas', 'idSubcuenta = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
