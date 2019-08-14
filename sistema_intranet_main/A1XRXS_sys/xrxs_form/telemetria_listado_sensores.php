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
	if ( !empty($_POST['idSensores']) )      $idSensores      = $_POST['idSensores'];
	if ( !empty($_POST['Nombre']) )          $Nombre          = $_POST['Nombre'];
	if ( !empty($_POST['Funcion']) )         $Funcion         = $_POST['Funcion'];
	if ( !empty($_POST['idSensorFuncion']) ) $idSensorFuncion = $_POST['idSensorFuncion'];
	
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
			case 'idSensores':      if(empty($idSensores)){      $error['idSensores']      = 'error/No ha ingresado el id';}break;
			case 'Nombre':          if(empty($Nombre)){          $error['Nombre']          = 'error/No ha ingresado el nombre';}break;
			case 'Funcion':         if(empty($Funcion)){         $error['Funcion']         = 'error/No ha ingresado la funcion';}break;
			case 'idSensorFuncion': if(empty($idSensorFuncion)){ $error['idSensorFuncion'] = 'error/No ha seleccionado la funcion';}break;
			
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
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado_sensores', '', "Nombre='".$Nombre."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                    $a  = "'".$Nombre."'" ;             }else{$a  ="''";}
				if(isset($Funcion) && $Funcion != ''){                  $a .= ",'".$Funcion."'" ;           }else{$a .=",''";}
				if(isset($idSensorFuncion) && $idSensorFuncion != ''){  $a .= ",'".$idSensorFuncion."'" ;   }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado_sensores` (Nombre,Funcion, idSensorFuncion) VALUES ({$a} )";
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
			if(isset($Nombre)&&isset($idSensores)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado_sensores', '', "Nombre='".$Nombre."' AND idSensores!='".$idSensores."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSensores='".$idSensores."'" ;
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Funcion) && $Funcion != ''){                    $a .= ",Funcion='".$Funcion."'" ;}
				if(isset($idSensorFuncion) && $idSensorFuncion != ''){    $a .= ",idSensorFuncion='".$idSensorFuncion."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado_sensores` SET ".$a." WHERE idSensores = '$idSensores'";
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
			$query  = "DELETE FROM `telemetria_listado_sensores` WHERE idSensores = {$_GET['del']}";
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
