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
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idAgenda':   if(empty($idAgenda)){    $error['idAgenda']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':  if(empty($idSistema)){   $error['idSistema']  = 'error/No ha ingresado el sistema';}break;
			case 'idUsuario':  if(empty($idUsuario)){   $error['idUsuario']  = 'error/No ha ingresado el usuario';}break;
			case 'Nombre':     if(empty($Nombre)){      $error['Nombre']     = 'error/No ha ingresado el nombre';}break;
			case 'Fono':       if(empty($Fono)){        $error['Fono']       = 'error/No ha ingresado el fono';}break;
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
			if(isset($Fono)&&isset($idSistema)&&isset($idUsuario)){
				$ndata_1 = db_select_nrows ('idUsuario', 'principal_agenda_telefonica', '', "Fono='".$Fono."' AND idSistema='".$idSistema."' AND idUsuario='".$idUsuario."'", $dbConn);
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
				$query  = "INSERT INTO `principal_agenda_telefonica` (idSistema, idUsuario, Nombre, Fono) VALUES ({$a} )";
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
				$ndata_1 = db_select_nrows ('idUsuario', 'principal_agenda_telefonica', '', "Fono='".$Fono."' AND idSistema='".$idSistema."' AND idUsuario='".$idUsuario."' AND idAgenda!='".$idAgenda."'", $dbConn);
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
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `principal_agenda_telefonica` SET ".$a." WHERE idAgenda = '$idAgenda'";
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
			$query  = "DELETE FROM `principal_agenda_telefonica` WHERE idAgenda = {$_GET['del']}";
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
