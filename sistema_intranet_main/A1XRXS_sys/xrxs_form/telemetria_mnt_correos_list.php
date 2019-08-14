<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idCorreos']) )      $idCorreos      = $_POST['idCorreos'];
	if ( !empty($_POST['idCorreosCat']) )   $idCorreosCat   = $_POST['idCorreosCat'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario      = $_POST['idUsuario'];
	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idCorreos':     if(empty($idCorreos)){      $error['idCorreos']      = 'error/No ha ingresado el id';}break;
			case 'idCorreosCat':  if(empty($idCorreosCat)){   $error['idCorreosCat']   = 'error/No ha seleccionado la ciudad';}break;
			case 'idUsuario':     if(empty($idUsuario)){      $error['idUsuario']      = 'error/No ha seleccionado el Usuario';}break;
			
		}
	}

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
			if(isset($idUsuario)&&isset($idCorreosCat)){
				$ndata_1 = db_select_nrows ('idUsuario', 'telemetria_mnt_correos_list', '', "idUsuario='".$idUsuario."' AND idCorreosCat='".$idCorreosCat."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Usuario ya existe';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idCorreosCat) && $idCorreosCat != ''){   $a = "'".$idCorreosCat."'" ;    }else{$a ="''";}
				if(isset($idUsuario) && $idUsuario != ''){         $a .= ",'".$idUsuario."'" ;     }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_mnt_correos_list` (idCorreosCat, idUsuario) VALUES ({$a} )";
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
			if(isset($idUsuario)&&isset($idCorreosCat)&&isset($idCorreos)){
				$ndata_1 = db_select_nrows ('idUsuario', 'telemetria_mnt_correos_list', '', "idUsuario='".$idUsuario."' AND idCorreosCat='".$idCorreosCat."' AND idCorreos!='".$idCorreos."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El idUsuario de la comuna ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCorreos='".$idCorreos."'" ;
				if(isset($idCorreosCat) && $idCorreosCat != ''){    $a .= ",idCorreosCat='".$idCorreosCat."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){          $a .= ",idUsuario='".$idUsuario."'" ;}
				
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_mnt_correos_list` SET ".$a." WHERE idCorreos = '$idCorreos'";
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
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `telemetria_mnt_correos_list` WHERE idCorreos = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&deleted=true' );
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
