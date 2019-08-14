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
	if ( !empty($_POST['idItem']) )         $idItem          = $_POST['idItem'];
	if ( !empty($_POST['idTelemetria']) )   $idTelemetria    = $_POST['idTelemetria'];
	if ( !empty($_POST['idAlarma']) )       $idAlarma        = $_POST['idAlarma'];
	if ( !empty($_POST['Sensor_N']) )       $Sensor_N        = $_POST['Sensor_N'];
	if ( !empty($_POST['Rango_ini']) )      $Rango_ini       = $_POST['Rango_ini'];
	if ( !empty($_POST['Rango_fin']) )      $Rango_fin       = $_POST['Rango_fin'];
	
	
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
			case 'idItem':         if(empty($idItem)){         $error['idItem']         = 'error/No ha ingresado el id';}break;
			case 'idTelemetria':   if(empty($idTelemetria)){   $error['idTelemetria']   = 'error/No ha seleccionado el equipo de telemetria';}break;
			case 'idAlarma':       if(empty($idAlarma)){       $error['idAlarma']       = 'error/No ha seleccionado el tipo de alarma';}break;
			case 'Sensor_N':       if(empty($Sensor_N)){       $error['Sensor_N']       = 'error/No ha seleccionado el Sensor';}break;
			case 'Rango_ini':      if(empty($Rango_ini)){      $error['Rango_ini']      = 'error/No ha ingresado el rango de inicio';}break;
			case 'Rango_fin':      if(empty($Rango_fin)){      $error['Rango_fin']      = 'error/No ha ingresado el rango de termino';}break;
			
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
				if(isset($idTelemetria) && $idTelemetria != ''){  $a = "'".$idTelemetria."'" ;  }else{$a ="''";}
				if(isset($idAlarma) && $idAlarma != ''){          $a .= ",'".$idAlarma."'" ;    }else{$a .=",''";}
				if(isset($Sensor_N) && $Sensor_N != ''){          $a .= ",'".$Sensor_N."'" ;    }else{$a .=",''";}
				if(isset($Rango_ini) && $Rango_ini != ''){        $a .= ",'".$Rango_ini."'" ;   }else{$a .=",''";}
				if(isset($Rango_fin) && $Rango_fin != ''){        $a .= ",'".$Rango_fin."'" ;   }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado_alarmas_perso_items` (idTelemetria, idAlarma, Sensor_N, Rango_ini, Rango_fin) 
				VALUES ({$a} )";
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
				$a = "idItem='".$idItem."'" ;
				if(isset($idTelemetria) && $idTelemetria != ''){  $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($idAlarma) && $idAlarma != ''){          $a .= ",idAlarma='".$idAlarma."'" ;}
				if(isset($Sensor_N) && $Sensor_N != ''){          $a .= ",Sensor_N='".$Sensor_N."'" ;}
				if(isset($Rango_ini) && $Rango_ini != ''){        $a .= ",Rango_ini='".$Rango_ini."'" ;}
				if(isset($Rango_fin) && $Rango_fin != ''){        $a .= ",Rango_fin='".$Rango_fin."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado_alarmas_perso_items` SET ".$a." WHERE idItem = '$idItem'";
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
		case 'delAlarma_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `telemetria_listado_alarmas_perso_items` WHERE idItem = {$_GET['delAlarma_item']}";
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
