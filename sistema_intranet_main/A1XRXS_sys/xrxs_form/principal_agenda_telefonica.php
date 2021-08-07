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
	if ( !empty($_POST['idAgenda']) )      $idAgenda      = $_POST['idAgenda'];
	if ( !empty($_POST['idSistema']) )     $idSistema     = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )     $idUsuario     = $_POST['idUsuario'];
	if ( !empty($_POST['Nombre']) )        $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['Fono']) )          $Fono          = $_POST['Fono'];
	
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
			case 'idAgenda':   if(empty($idAgenda)){    $error['idAgenda']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':  if(empty($idSistema)){   $error['idSistema']  = 'error/No ha ingresado el sistema';}break;
			case 'idUsuario':  if(empty($idUsuario)){   $error['idUsuario']  = 'error/No ha ingresado el usuario';}break;
			case 'Nombre':     if(empty($Nombre)){      $error['Nombre']     = 'error/No ha ingresado el nombre';}break;
			case 'Fono':       if(empty($Fono)){        $error['Fono']       = 'error/No ha ingresado el fono';}break;
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
			if(isset($Fono)&&isset($idSistema)&&isset($idUsuario)){
				$ndata_1 = db_select_nrows (false, 'idUsuario', 'principal_agenda_telefonica', '', "Fono='".$Fono."' AND idSistema='".$idSistema."' AND idUsuario='".$idUsuario."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Contacto ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){   $a  = "'".$idSistema."'" ;    }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){   $a .= ",'".$idUsuario."'" ;   }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){         $a .= ",'".$Nombre."'" ;      }else{$a .=",''";}
				if(isset($Fono) && $Fono != ''){             $a .= ",'".$Fono."'" ;        }else{$a .=",''";}

				// inserto los datos de registro en la db
				$query  = "INSERT INTO `principal_agenda_telefonica` (idSistema, idUsuario, Nombre, Fono) VALUES (".$a.")";
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Fono)&&isset($idSistema)&&isset($idUsuario)&&isset($idAgenda)){
				$ndata_1 = db_select_nrows (false, 'idUsuario', 'principal_agenda_telefonica', '', "Fono='".$Fono."' AND idSistema='".$idSistema."' AND idUsuario='".$idUsuario."' AND idAgenda!='".$idAgenda."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Contacto ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAgenda='".$idAgenda."'" ;
				if(isset($idSistema) && $idSistema != ''){   $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){   $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Nombre) && $Nombre != ''){         $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Fono) && $Fono != ''){             $a .= ",Fono='".$Fono."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'principal_agenda_telefonica', 'idAgenda = "'.$idAgenda.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'principal_agenda_telefonica', 'idAgenda = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
