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
	if ( !empty($_POST['idEmbalaje']) )     $idEmbalaje       = $_POST['idEmbalaje'];
	if ( !empty($_POST['idCategoria']) )    $idCategoria      = $_POST['idCategoria'];
	if ( !empty($_POST['idTipo']) )         $idTipo           = $_POST['idTipo'];
	if ( !empty($_POST['idProceso']) )      $idProceso        = $_POST['idProceso'];
	if ( !empty($_POST['idSistema']) )      $idSistema        = $_POST['idSistema'];
	
	
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
			case 'idEmbalaje':     if(empty($idEmbalaje)){   $error['idEmbalaje']    = 'error/No ha ingresado el id';}break;
			case 'idCategoria':    if(empty($idCategoria)){  $error['idCategoria']   = 'error/No ha seleccionado la categoria';}break;
			case 'idTipo':         if(empty($idTipo)){       $error['idTipo']        = 'error/No ha seleccionado el tipo';}break;
			case 'idProceso':      if(empty($idProceso)){    $error['idProceso']     = 'error/No ha seleccionado el proceso';}break;
			case 'idSistema':      if(empty($idSistema)){    $error['idSistema']     = 'error/No ha seleccionado el sistema';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert_embalaje':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCategoria)&&isset($idProceso)&&isset($idTipo)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('idEmbalaje', 'sistema_variedades_categorias_tipo_emb', '', "idCategoria='".$idCategoria."' AND idTipo='".$idTipo."' AND idProceso='".$idProceso."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El embalaje ya existe en el sistema';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idCategoria) && $idCategoria != ''){  $a = "'".$idCategoria."'" ;  }else{$a ="''";}
				if(isset($idTipo) && $idTipo != ''){            $a .= ",'".$idTipo."'" ;     }else{$a .=",''";}
				if(isset($idProceso) && $idProceso != ''){      $a .= ",'".$idProceso."'" ;  }else{$a .=",''";}
				if(isset($idSistema) && $idSistema != ''){      $a .= ",'".$idSistema."'" ;  }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `sistema_variedades_categorias_tipo_emb` (idCategoria, idTipo, idProceso, idSistema) 
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
		case 'update_embalaje':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCategoria)&&isset($idProceso)&&isset($idTipo)&&isset($idSistema)&&isset($idEmbalaje)){
				$ndata_1 = db_select_nrows ('idEmbalaje', 'sistema_variedades_categorias_tipo_emb', '', "idCategoria='".$idCategoria."' AND idTipo='".$idTipo."' AND idProceso='".$idProceso."' AND idSistema='".$idSistema."' AND idEmbalaje!='".$idEmbalaje."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El embalaje ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idEmbalaje='".$idEmbalaje."'" ;
				if(isset($idCategoria) && $idCategoria != ''){   $a .= ",idCategoria='".$idCategoria."'" ;}
				if(isset($idTipo) && $idTipo != ''){             $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idProceso) && $idProceso != ''){       $a .= ",idProceso='".$idProceso."'" ;}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `sistema_variedades_categorias_tipo_emb` SET ".$a." WHERE idEmbalaje = '$idEmbalaje'";
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
		case 'del_embalaje':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `sistema_variedades_categorias_tipo_emb` WHERE idEmbalaje = {$_GET['del']}";
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
