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
	if ( !empty($_POST['idPeoneta']) )     $idPeoneta     = $_POST['idPeoneta'];
	if ( !empty($_POST['idVehiculo']) )    $idVehiculo    = $_POST['idVehiculo'];
	if ( !empty($_POST['Nombre']) )        $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['ApellidoPat']) )   $ApellidoPat   = $_POST['ApellidoPat'];
	if ( !empty($_POST['ApellidoMat']) )   $ApellidoMat   = $_POST['ApellidoMat'];
	if ( !empty($_POST['Rut']) )           $Rut           = $_POST['Rut'];
	if ( !empty($_POST['Fecha']) )         $Fecha         = $_POST['Fecha'];
	
	
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
			case 'idPeoneta':    if(empty($idPeoneta)){    $error['idPeoneta']    = 'error/No ha ingresado el id';}break;
			case 'idVehiculo':   if(empty($idVehiculo)){   $error['idVehiculo']   = 'error/No ha seleccionado el vehiculo';}break;
			case 'Nombre':       if(empty($Nombre)){       $error['Nombre']       = 'error/No ha ingresado el nombre';}break;
			case 'ApellidoPat':  if(empty($ApellidoPat)){  $error['ApellidoPat']  = 'error/No ha ingresado el apellido paterno';}break;
			case 'ApellidoMat':  if(empty($ApellidoMat)){  $error['ApellidoMat']  = 'error/No ha ingresado el apellido materno';}break;
			case 'Rut':          if(empty($Rut)){          $error['Rut']          = 'error/No ha ingresado el Rut';}break;
			case 'Fecha':        if(empty($Fecha)){        $error['Fecha']        = 'error/No ha ingresado la Fecha de nacimiento';}break;
			
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
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Rut)&&isset($idVehiculo)){
				$ndata_1 = db_select_nrows ('Rut', 'vehiculos_listado_peonetas', '', "Rut='".$Rut."' AND idVehiculo='".$idVehiculo."'", $dbConn);
			}
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($idVehiculo)){
				$ndata_2 = db_select_nrows ('Nombre', 'vehiculos_listado_peonetas', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND idVehiculo='".$idVehiculo."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/La Peoneta ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				//filtros
				if(isset($idVehiculo) && $idVehiculo != ''){    $a  = "'".$idVehiculo."'" ;    }else{$a  ="''";}
				if(isset($Nombre) && $Nombre != ''){            $a .= ",'".$Nombre."'" ;       }else{$a .=",''";}
				if(isset($ApellidoPat) && $ApellidoPat != ''){  $a .= ",'".$ApellidoPat."'" ;  }else{$a .=",''";}
				if(isset($ApellidoMat) && $ApellidoMat != ''){  $a .= ",'".$ApellidoMat."'" ;  }else{$a .=",''";}
				if(isset($Rut) && $Rut != ''){                  $a .= ",'".$Rut."'" ;          }else{$a .=",''";}
				if(isset($Fecha) && $Fecha != ''){              $a .= ",'".$Fecha."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `vehiculos_listado_peonetas` (idVehiculo, Nombre, ApellidoPat, ApellidoMat, 
				Rut, Fecha) 
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
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Rut)&&isset($idVehiculo)&&isset($idPeoneta)){
				$ndata_1 = db_select_nrows ('Rut', 'vehiculos_listado_peonetas', '', "Rut='".$Rut."' AND idVehiculo='".$idVehiculo."' AND idPeoneta!='".$idPeoneta."'", $dbConn);
			}
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($idVehiculo)&&isset($idPeoneta)){
				$ndata_2 = db_select_nrows ('Nombre', 'vehiculos_listado_peonetas', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND idVehiculo='".$idVehiculo."' AND idPeoneta!='".$idPeoneta."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/La Peoneta ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idPeoneta='".$idPeoneta."'" ;
				if(isset($idVehiculo) && $idVehiculo != ''){     $a .= ",idVehiculo='".$idVehiculo."'" ;}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($ApellidoPat) && $ApellidoPat != ''){   $a .= ",ApellidoPat='".$ApellidoPat."'" ;}
				if(isset($ApellidoMat) && $ApellidoMat != ''){   $a .= ",ApellidoMat='".$ApellidoMat."'" ;}
				if(isset($Rut) && $Rut != ''){                   $a .= ",Rut='".$Rut."'" ;}
				if(isset($Fecha) && $Fecha != ''){               $a .= ",Fecha='".$Fecha."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `vehiculos_listado_peonetas` SET ".$a." WHERE idPeoneta = '$idPeoneta'";
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
			$query  = "DELETE FROM `vehiculos_listado_peonetas` WHERE idPeoneta = {$_GET['del']}";
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
