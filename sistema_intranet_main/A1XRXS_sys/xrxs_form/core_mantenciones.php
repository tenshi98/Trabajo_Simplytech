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
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idMantencion':  if(empty($idMantencion)){  $error['idMantencion']  = 'error/No ha ingresado el id';}break;
			case 'Fecha':         if(empty($Fecha)){         $error['Fecha']         = 'error/No ha ingresado la Fecha';}break;
			case 'Hora_ini':      if(empty($Hora_ini)){      $error['Hora_ini']      = 'error/No ha ingresado la Hora de inicio';}break;
			case 'Hora_fin':      if(empty($Hora_fin)){      $error['Hora_fin']      = 'error/No ha ingresado la Hora de termino';}break;
			case 'idUsuario':     if(empty($idUsuario)){     $error['idUsuario']     = 'error/No ha seleccionado el usuario';}break;
			case 'Descripcion':   if(empty($Descripcion)){   $error['Descripcion']   = 'error/No ha ingresado la descripcion';}break;
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
				if(isset($Fecha) && $Fecha != ''){              $a  = "'".$Fecha."'" ;        }else{$a  ="''";}
				if(isset($Hora_ini) && $Hora_ini != ''){        $a .= ",'".$Hora_ini."'" ;    }else{$a .=",''";}
				if(isset($Hora_fin) && $Hora_fin != ''){        $a .= ",'".$Hora_fin."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){      $a .= ",'".$idUsuario."'" ;   }else{$a .=",''";}
				if(isset($Descripcion) && $Descripcion != ''){  $a .= ",'".$Descripcion."'" ; }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_mantenciones` (Fecha,Hora_ini, Hora_fin, idUsuario, Descripcion) VALUES ({$a} )";
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
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `core_mantenciones` WHERE idMantencion = {$_GET['del']}";
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
