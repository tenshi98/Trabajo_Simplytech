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
	if ( !empty($_POST['idMarcadores']) )   $idMarcadores    = $_POST['idMarcadores'];
	if ( !empty($_POST['idSistema']) )      $idSistema       = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )         $Nombre          = $_POST['Nombre'];
	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $form_obligatorios);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idMarcadores':   if(empty($idMarcadores)){   $error['idMarcadores']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':      if(empty($idSistema)){      $error['idSistema']      = 'error/No ha ingresado el id del sistema';}break;
			case 'Nombre':         if(empty($Nombre)){         $error['Nombre']         = 'error/No ha ingresado el nombre del medidor';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			//Verifico otros datos
			
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$sql_usuario = mysqli_query("SELECT Nombre FROM marcadores_listado WHERE Nombre='".$Nombre."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El medidor ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){  $a  = "'".$idSistema."'" ; }else{$a  ="''";}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",'".$Nombre."'" ;   }else{$a .=",''";}

				// inserto los datos de registro en la db
				$query  = "INSERT INTO `marcadores_listado` (idSistema, Nombre) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idMarcadores='".$idMarcadores."'" ;
				if(isset($idSistema) && $idSistema != ''){  $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",Nombre='".$Nombre."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `marcadores_listado` SET ".$a." WHERE idMarcadores = '$idMarcadores'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `marcadores_listado` WHERE idMarcadores = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
