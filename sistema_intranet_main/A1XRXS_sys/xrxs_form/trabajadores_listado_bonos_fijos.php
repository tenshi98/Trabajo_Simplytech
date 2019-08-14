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
	if ( !empty($_POST['idBono']) )         $idBono        = $_POST['idBono'];
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador  = $_POST['idTrabajador'];
	if ( !empty($_POST['idBonoFijo']) )     $idBonoFijo    = $_POST['idBonoFijo'];
	if ( !empty($_POST['Monto']) )          $Monto         = $_POST['Monto'];

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
			case 'idBono':         if(empty($idBono)){        $error['idBono']         = 'error/No ha ingresado el id';}break;
			case 'idTrabajador':   if(empty($idTrabajador)){  $error['idTrabajador']   = 'error/No ha seleccionado el trabajador';}break;
			case 'idBonoFijo':     if(empty($idBonoFijo)){    $error['idBonoFijo']     = 'error/No ha seleccionado el bono';}break;
			case 'Monto':          if(empty($Monto)){         $error['Monto']          = 'error/No ha ingresado el monto';}break;
			
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
			if(isset($idBonoFijo)&&isset($idTrabajador)){
				$ndata_1 = db_select_nrows ('idBonoFijo', 'trabajadores_listado_bonos_fijos', '', "idBonoFijo='".$idBonoFijo."' AND idTrabajador='".$idTrabajador."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Bono ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTrabajador) && $idTrabajador != ''){  $a  = "'".$idTrabajador."'" ;   }else{$a  ="''";}
				if(isset($idBonoFijo) && $idBonoFijo != ''){      $a .= ",'".$idBonoFijo."'" ;    }else{$a .=",''";}
				if(isset($Monto) && $Monto != ''){                $a .= ",'".$Monto."'" ;         }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_listado_bonos_fijos` (idTrabajador, idBonoFijo, Monto) 
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
			if(isset($idBonoFijo)&&isset($idTrabajador)&&isset($idBono)){
				$ndata_1 = db_select_nrows ('idBonoFijo', 'trabajadores_listado_bonos_fijos', '', "idBonoFijo='".$idBonoFijo."' AND idTrabajador='".$idTrabajador."' AND idBono!='".$idBono."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Bono ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idBono='".$idBono."'" ;
				if(isset($idTrabajador) && $idTrabajador != ''){    $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($idBonoFijo) && $idBonoFijo != ''){        $a .= ",idBonoFijo='".$idBonoFijo."'" ;}
				if(isset($Monto) && $Monto != ''){                  $a .= ",Monto='".$Monto."'" ;}
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_listado_bonos_fijos` SET ".$a." WHERE idBono = '$idBono'";
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
			$query  = "DELETE FROM `trabajadores_listado_bonos_fijos` WHERE idBono = {$_GET['del']}";
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
