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
	if ( !empty($_POST['idUbicaciones']) )   $idUbicaciones    = $_POST['idUbicaciones'];
	if ( !empty($_POST['idPredio']) )        $idPredio         = $_POST['idPredio'];
	if ( !empty($_POST['idZona']) )          $idZona           = $_POST['idZona'];
	if ( !empty($_POST['Latitud']) )         $Latitud          = $_POST['Latitud'];
	if ( !empty($_POST['Longitud']) )        $Longitud         = $_POST['Longitud'];
	

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
			case 'idUbicaciones':   if(empty($idUbicaciones)){   $error['idUbicaciones']   = 'error/No ha ingresado el id';}break;
			case 'idPredio':        if(empty($idPredio)){        $error['idPredio']        = 'error/No ha seleccionado el predio';}break;
			case 'idZona':          if(empty($idZona)){          $error['idZona']          = 'error/No ha seleccionado el cuartel';}break;
			case 'Latitud':         if(empty($Latitud)){         $error['Latitud']         = 'error/No ha ingresado la Latitud';}break;
			case 'Longitud':        if(empty($Longitud)){        $error['Longitud']        = 'error/No ha ingresado la Longitud';}break;
			
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
				if(isset($idPredio) && $idPredio != ''){      $a  = "'".$idPredio."'" ;     }else{$a  ="''";}
				if(isset($idZona) && $idZona != ''){          $a .= ",'".$idZona."'" ;      }else{$a .=",''";}
				if(isset($Latitud) && $Latitud != ''){        $a .= ",'".$Latitud."'" ;     }else{$a .=",''";}
				if(isset($Longitud) && $Longitud != ''){      $a .= ",'".$Longitud."'" ;    }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_predios_listado_zonas_ubicaciones` (idPredio, idZona, Latitud, Longitud) VALUES ({$a} )";
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
				$a = "idUbicaciones='".$idUbicaciones."'" ;
				if(isset($idPredio) && $idPredio != ''){ $a .= ",idPredio='".$idPredio."'" ;}
				if(isset($idZona) && $idZona != ''){     $a .= ",idZona='".$idZona."'" ;}
				if(isset($Latitud) && $Latitud != ''){   $a .= ",Latitud='".$Latitud."'" ;}
				if(isset($Longitud) && $Longitud != ''){ $a .= ",Longitud='".$Longitud."'" ;}
				
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_predios_listado_zonas_ubicaciones` SET ".$a." WHERE idUbicaciones = '$idUbicaciones'";
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
		case 'del_punto':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			$query  = "DELETE FROM `cross_predios_listado_zonas_ubicaciones` WHERE idUbicaciones = {$_GET['del_punto']}";
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
