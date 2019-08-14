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

	//Traspaso de idUsuarioes input a variables
	if ( !empty($_POST['idAcceso']) )    $idAcceso     = $_POST['idAcceso'];
	if ( !empty($_POST['idSistema']) )   $idSistema    = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )   $idUsuario    = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )       $Fecha        = $_POST['Fecha'];
	if ( !empty($_POST['Hora']) )        $Hora         = $_POST['Hora'];
	if ( !empty($_POST['Nombre']) )      $Nombre       = $_POST['Nombre'];
	
	
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
			case 'idAcceso':    if(empty($idAcceso)){    $error['idAcceso']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':   if(empty($idSistema)){   $error['idSistema']   = 'error/No ha seleccionado el Sistema';}break;
			case 'idUsuario':   if(empty($idUsuario)){   $error['idUsuario']   = 'error/No ha seleccionado el Usuario';}break;
			case 'Fecha':       if(empty($Fecha)){       $error['Fecha']       = 'error/No ha ingresado la fecha';}break;
			case 'Hora':        if(empty($Hora)){        $error['Hora']        = 'error/No ha ingresado la hora';}break;
			case 'Nombre':      if(empty($Nombre)){      $error['Nombre']      = 'error/No ha ingresado el nombre';}break;
			
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
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){  $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){  $a .= ",'".$idUsuario."'" ;  }else{$a .=",''";}
				if(isset($Fecha) && $Fecha != ''){          $a .= ",'".$Fecha."'" ;      }else{$a .=",''";}
				if(isset($Hora) && $Hora != ''){            $a .= ",'".$Hora."'" ;       }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",'".$Nombre."'" ;     }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `seguridad_accesos` (idSistema, idUsuario, Fecha, Hora, Nombre) VALUES ({$a} )";
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
				$a = "idAcceso='".$idAcceso."'" ;
				if(isset($idSistema) && $idSistema != ''){  $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){  $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Fecha) && $Fecha != ''){          $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Hora) && $Hora != ''){            $a .= ",Hora='".$Hora."'" ;}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",Nombre='".$Nombre."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `seguridad_accesos` SET ".$a." WHERE idAcceso = '$idAcceso'";
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
			$query  = "DELETE FROM `seguridad_accesos` WHERE idAcceso = {$_GET['del']}";
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
