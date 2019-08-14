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
	if ( !empty($_POST['idAlarma']) )         $idAlarma            = $_POST['idAlarma'];
	if ( !empty($_POST['idTelemetria']) )     $idTelemetria        = $_POST['idTelemetria'];
	if ( !empty($_POST['Nombre']) )           $Nombre              = $_POST['Nombre'];
	if ( !empty($_POST['idTipo']) )           $idTipo              = $_POST['idTipo'];
	if ( !empty($_POST['valor_error']) )      $valor_error         = $_POST['valor_error'];
	if ( !empty($_POST['valor_diferencia']) ) $valor_diferencia    = $_POST['valor_diferencia'];
	
	
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
			case 'idAlarma':          if(empty($idAlarma)){            $error['idAlarma']           = 'error/No ha ingresado el id';}break;
			case 'idTelemetria':      if(empty($idTelemetria)){        $error['idTelemetria']       = 'error/No ha seleccionado el equipo de telemetria';}break;
			case 'Nombre':            if(empty($Nombre)){              $error['Nombre']             = 'error/No ha ingresado el nombre';}break;
			case 'idTipo':            if(empty($idTipo)){              $error['idTipo']             = 'error/No ha seleccionado el tipo';}break;
			case 'valor_error':       if(empty($valor_error)){         $error['valor_error']        = 'error/No ha ingresado el valor de error';}break;
			case 'valor_diferencia':  if(empty($valor_diferencia)){    $error['valor_diferencia']   = 'error/No ha ingresado el porcentaje de diferencia';}break;
			
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
			if(isset($Nombre)&&isset($idTelemetria)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado_alarmas_perso', '', "Nombre='".$Nombre."' AND idTelemetria='".$idTelemetria."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTelemetria) && $idTelemetria != ''){          $a = "'".$idTelemetria."'" ;       }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",'".$Nombre."'" ;           }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                      $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($valor_error) && $valor_error != ''){            $a .= ",'".$valor_error."'" ;      }else{$a .=",''";}
				if(isset($valor_diferencia) && $valor_diferencia != ''){  $a .= ",'".$valor_diferencia."'" ; }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado_alarmas_perso` (idTelemetria, Nombre, idTipo, valor_error, valor_diferencia) 
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idTelemetria)&&isset($idAlarma)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_listado_alarmas_perso', '', "Nombre='".$Nombre."' AND idTelemetria='".$idTelemetria."' AND idAlarma!='".$idAlarma."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAlarma='".$idAlarma."'" ;
				if(isset($idTelemetria) && $idTelemetria != ''){            $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($Nombre) && $Nombre != ''){                        $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idTipo) && $idTipo != ''){                        $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($valor_error) && $valor_error != ''){              $a .= ",valor_error='".$valor_error."'" ;}
				if(isset($valor_diferencia) && $valor_diferencia != ''){    $a .= ",valor_diferencia='".$valor_diferencia."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado_alarmas_perso` SET ".$a." WHERE idAlarma = '$idAlarma'";
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
		case 'delAlarma':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `telemetria_listado_alarmas_perso` WHERE idAlarma = {$_GET['delAlarma']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `telemetria_listado_alarmas_perso_items` WHERE idAlarma = {$_GET['delAlarma']}";
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
