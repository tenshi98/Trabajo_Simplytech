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
	if ( !empty($_POST['idDescuento']) )      $idDescuento      = $_POST['idDescuento'];
	if ( !empty($_POST['idTrabajador']) )     $idTrabajador     = $_POST['idTrabajador'];
	if ( !empty($_POST['idDescuentoFijo']) )  $idDescuentoFijo  = $_POST['idDescuentoFijo'];
	if ( !empty($_POST['idAFP']) )            $idAFP            = $_POST['idAFP'];
	if ( !empty($_POST['Monto']) )            $Monto            = $_POST['Monto'];
	
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
			case 'idDescuento':     if(empty($idDescuento)){      $error['idDescuento']     = 'error/No ha ingresado el id';}break;
			case 'idTrabajador':    if(empty($idTrabajador)){     $error['idTrabajador']    = 'error/No ha seleccionado el trabajador';}break;
			case 'idDescuentoFijo': if(empty($idDescuentoFijo)){  $error['idDescuentoFijo'] = 'error/No ha seleccionado el descuento';}break;
			case 'idAFP':           if(empty($idAFP)){            $error['idAFP']           = 'error/No ha seleccionado la AFP';}break;
			case 'Monto':           if(empty($Monto)){            $error['Monto']           = 'error/No ha ingresado el monto';}break;
			
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
			if(isset($idDescuentoFijo)&&isset($idTrabajador)){
				$ndata_1 = db_select_nrows ('idDescuentoFijo', 'trabajadores_listado_descuentos_fijos', '', "idDescuentoFijo='".$idDescuentoFijo."' AND idTrabajador='".$idTrabajador."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El descuento ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTrabajador) && $idTrabajador != ''){        $a  = "'".$idTrabajador."'" ;     }else{$a  ="''";}
				if(isset($idDescuentoFijo) && $idDescuentoFijo != ''){  $a .= ",'".$idDescuentoFijo."'" ; }else{$a .=",''";}
				if(isset($idAFP) && $idAFP != ''){                      $a .= ",'".$idAFP."'" ;           }else{$a .=",''";}
				if(isset($Monto) && $Monto != ''){                      $a .= ",'".$Monto."'" ;           }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_listado_descuentos_fijos` (idTrabajador, idDescuentoFijo, idAFP, Monto) 
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
			if(isset($idDescuentoFijo)&&isset($idTrabajador)&&isset($idDescuento)){
				$ndata_1 = db_select_nrows ('idDescuentoFijo', 'trabajadores_listado_descuentos_fijos', '', "idDescuentoFijo='".$idDescuentoFijo."' AND idTrabajador='".$idTrabajador."' AND idDescuento!='".$idDescuento."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Bono ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idDescuento='".$idDescuento."'" ;
				if(isset($idTrabajador) && $idTrabajador != ''){        $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($idDescuentoFijo) && $idDescuentoFijo != ''){  $a .= ",idDescuentoFijo='".$idDescuentoFijo."'" ;}
				if(isset($idAFP) && $idAFP != ''){                      $a .= ",idAFP='".$idAFP."'" ;}
				if(isset($Monto) && $Monto != ''){                      $a .= ",Monto='".$Monto."'" ;}
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_listado_descuentos_fijos` SET ".$a." WHERE idDescuento = '$idDescuento'";
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
			$query  = "DELETE FROM `trabajadores_listado_descuentos_fijos` WHERE idDescuento = {$_GET['del']}";
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
