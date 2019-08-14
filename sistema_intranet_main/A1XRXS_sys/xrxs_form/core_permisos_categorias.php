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
	if ( !empty($_POST['id_pmcat']) )  $id_pmcat   = $_POST['id_pmcat'];
	if ( !empty($_POST['Nombre']) )    $Nombre     = $_POST['Nombre'];
	if ( !empty($_POST['idFont']) )    $idFont     = $_POST['idFont'];
	
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
			case 'id_pmcat':  if(empty($id_pmcat)){  $error['id_pmcat']  = 'error/No ha ingresado el id';}break;
			case 'Nombre':    if(empty($Nombre)){    $error['Nombre']    = 'error/No ha ingresado el Nombre';}break;
			case 'idFont':    if(empty($idFont)){    $error['idFont']    = 'error/No ha seleccionado el icono';}break;
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
			if(isset($Nombre)&&isset($idFont)){
				$ndata_1 = db_select_nrows ('Nombre', 'core_permisos_categorias', '', "Nombre='".$Nombre."' AND idFont='".$idFont."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La Categoria de permiso ya existe';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){  $a  = "'".$Nombre."'" ;    }else{$a  ="''";}
				if(isset($idFont) && $idFont != ''){  $a .= ",'".$idFont."'" ;   }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_permisos_categorias` (Nombre,idFont) VALUES ({$a} )";
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
			if(isset($Nombre)&&isset($id_pmcat)&&isset($idFont)){
				$ndata_1 = db_select_nrows ('Nombre', 'core_permisos_categorias', '', "Nombre='".$Nombre."' AND idFont='".$idFont."' AND id_pmcat='".$id_pmcat."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La Categoria de permiso ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "id_pmcat='".$id_pmcat."'" ;
				if(isset($Nombre) && $Nombre != ''){   $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idFont) && $idFont != ''){   $a .= ",idFont='".$idFont."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `core_permisos_categorias` SET ".$a." WHERE id_pmcat = '$id_pmcat'";
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
			$query  = "DELETE FROM `core_permisos_categorias` WHERE id_pmcat = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//Traigo un listado con todas las transacciones de la categoria	
				$arrPermisos = array();
				$query = "SELECT  idAdmpm
				FROM `core_permisos`
				WHERE id_pmcat = {$_GET['del']} ";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrPermisos,$row );
				}
				
				//elimino los datos
				foreach ($arrPermisos as $perm) {
					
					//borro la transaccion
					$query  = "DELETE FROM `core_permisos` WHERE idAdmpm = {$perm['idAdmpm']}";
					$result = mysqli_query($dbConn, $query);
					
					//elimino los permisos relacionados a los usuarios
					$query  = "DELETE FROM `usuarios_permisos` WHERE idAdmpm = {$perm['idAdmpm']}";
					$result = mysqli_query($dbConn, $query);	
				}
							
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
