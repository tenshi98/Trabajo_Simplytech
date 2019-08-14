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
	if ( !empty($_POST['idCarga']) )         $idCarga       = $_POST['idCarga'];
	if ( !empty($_POST['idTrabajador']) )    $idTrabajador  = $_POST['idTrabajador'];
	if ( !empty($_POST['Nombre']) )          $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['ApellidoPat']) )     $ApellidoPat   = $_POST['ApellidoPat'];
	if ( !empty($_POST['ApellidoMat']) )     $ApellidoMat   = $_POST['ApellidoMat'];
	if ( !empty($_POST['idSexo']) )          $idSexo        = $_POST['idSexo'];
	if ( !empty($_POST['FNacimiento']) )     $FNacimiento   = $_POST['FNacimiento'];
	if ( !empty($_POST['idEstado']) )        $idEstado      = $_POST['idEstado'];
	
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
			case 'idCarga':        if(empty($idCarga)){       $error['idCarga']        = 'error/No ha ingresado el id';}break;
			case 'idTrabajador':   if(empty($idTrabajador)){  $error['idTrabajador']   = 'error/No ha seleccionado el trabajador';}break;
			case 'Nombre':         if(empty($Nombre)){        $error['Nombre']         = 'error/No ha ingresado el nombre';}break;
			case 'ApellidoPat':    if(empty($ApellidoPat)){   $error['ApellidoPat']    = 'error/No ha ingresado el apellido paterno';}break;
			case 'ApellidoMat':    if(empty($ApellidoMat)){   $error['ApellidoMat']    = 'error/No ha ingresado el apellido materno';}break;
			case 'idSexo':         if(empty($idSexo)){        $error['idSexo']         = 'error/No ha seleccionado el sexo';}break;
			case 'FNacimiento':    if(empty($FNacimiento)){   $error['FNacimiento']    = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'idEstado':       if(empty($idEstado)){      $error['idEstado']       = 'error/No ha seleccionado el estado';}break;
			
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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)){
				$ndata_1 = db_select_nrows ('Nombre', 'trabajadores_listado_cargas', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTrabajador) && $idTrabajador != ''){  $a  = "'".$idTrabajador."'" ;   }else{$a  ="''";}
				if(isset($Nombre) && $Nombre != ''){              $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($ApellidoPat) && $ApellidoPat != ''){    $a .= ",'".$ApellidoPat."'" ;   }else{$a .=",''";}
				if(isset($ApellidoMat) && $ApellidoMat != ''){    $a .= ",'".$ApellidoMat."'" ;   }else{$a .=",''";}
				if(isset($idSexo) && $idSexo != ''){              $a .= ",'".$idSexo."'" ;        }else{$a .=",''";}
				if(isset($FNacimiento) && $FNacimiento != ''){    $a .= ",'".$FNacimiento."'" ;   }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){          $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_listado_cargas` (idTrabajador, Nombre, ApellidoPat, ApellidoMat,
				idSexo, FNacimiento, idEstado ) 
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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idCarga)){
				$ndata_1 = db_select_nrows ('Nombre', 'trabajadores_listado_cargas', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idCarga!='".$idCarga."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idCarga='".$idCarga."'" ;
				if(isset($idTrabajador) && $idTrabajador != ''){    $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($ApellidoPat) && $ApellidoPat != ''){      $a .= ",ApellidoPat='".$ApellidoPat."'" ;}
				if(isset($ApellidoMat) && $ApellidoMat != ''){      $a .= ",ApellidoMat='".$ApellidoMat."'" ;}
				if(isset($idSexo) && $idSexo != ''){                $a .= ",idSexo='".$idSexo."'" ;}
				if(isset($FNacimiento) && $FNacimiento != ''){      $a .= ",FNacimiento='".$FNacimiento."'" ;}							
				if(isset($idEstado) && $idEstado != ''){            $a .= ",idEstado='".$idEstado."'" ;}							
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_listado_cargas` SET ".$a." WHERE idCarga = '$idCarga'";
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
			$query  = "DELETE FROM `trabajadores_listado_cargas` WHERE idCarga = {$_GET['del']}";
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
