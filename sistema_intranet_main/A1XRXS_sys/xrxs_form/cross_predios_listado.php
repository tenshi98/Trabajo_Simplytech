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
	if ( !empty($_POST['idPredio']) )    $idPredio    = $_POST['idPredio'];
	if ( !empty($_POST['idSistema']) )   $idSistema   = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )    $idEstado    = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )      $Nombre      = $_POST['Nombre'];
	if ( !empty($_POST['idPais']) )      $idPais      = $_POST['idPais'];
	if ( !empty($_POST['idCiudad']) )    $idCiudad    = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )    $idComuna    = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )   $Direccion   = $_POST['Direccion'];
	
	
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
			case 'idPredio':   if(empty($idPredio)){   $error['idPredio']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':  if(empty($idSistema)){  $error['idSistema']   = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':   if(empty($idEstado)){   $error['idEstado']    = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':     if(empty($Nombre)){     $error['Nombre']      = 'error/No ha ingresado el nombre';}break;
			case 'idPais':     if(empty($idPais)){     $error['idPais']      = 'error/No ha seleccionado el Pais';}break;
			case 'idCiudad':   if(empty($idCiudad)){   $error['idCiudad']    = 'error/No ha seleccionado la Ciudad';}break;
			case 'idComuna':   if(empty($idComuna)){   $error['idComuna']    = 'error/No ha seleccionado la Comuna';}break;
			case 'Direccion':  if(empty($Direccion)){  $error['Direccion']   = 'error/No ha seleccionado la Direccion';}break;
			
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
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'cross_predios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){  $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
				if(isset($idEstado) && $idEstado != ''){    $a .= ",'".$idEstado."'" ;   }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",'".$Nombre."'" ;     }else{$a .=",''";}
				if(isset($idPais) && $idPais != ''){        $a .= ",'".$idPais."'" ;     }else{$a .=",''";}
				if(isset($idCiudad) && $idCiudad != ''){    $a .= ",'".$idCiudad."'" ;   }else{$a .=",''";}
				if(isset($idComuna) && $idComuna != ''){    $a .= ",'".$idComuna."'" ;   }else{$a .=",''";}
				if(isset($Direccion) && $Direccion != ''){  $a .= ",'".$Direccion."'" ;  }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_predios_listado` (idSistema, idEstado, Nombre, idPais,
				idCiudad, idComuna, Direccion) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
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
			if(isset($Nombre)&&isset($idSistema)&&isset($idPredio)){
				$ndata_1 = db_select_nrows ('Nombre', 'cross_predios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idPredio!='".$idPredio."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idPredio='".$idPredio."'" ;
				if(isset($idSistema) && $idSistema != ''){    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){      $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){          $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idPais) && $idPais != ''){          $a .= ",idPais='".$idPais."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){      $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){      $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){    $a .= ",Direccion='".$Direccion."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `cross_predios_listado` SET ".$a." WHERE idPredio = '$idPredio'";
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
			
			//se borran los datos
			$query  = "DELETE FROM `cross_predios_listado` WHERE idPredio = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			
			//se borran los datos
			$query  = "DELETE FROM `cross_predios_listado_zonas` WHERE idPredio = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			
			//se borran los datos
			$query  = "DELETE FROM `cross_predios_listado_zonas_ubicaciones` WHERE idPredio = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;								
/*******************************************************************************************************************/
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idPredio   = $_GET['id'];
			$estado     = $_GET['estado'];
			$query  = "UPDATE cross_predios_listado SET idEstado = '$estado'	
			WHERE idPredio    = '$idPredio'";
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
			

		break;						
					
/*******************************************************************************************************************/
	}
?>
