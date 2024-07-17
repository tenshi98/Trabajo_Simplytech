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
	if ( !empty($_POST['idSector']) )       $idSector       = $_POST['idSector'];
	if ( !empty($_POST['idSistema']) )      $idSistema      = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )         $Nombre         = $_POST['Nombre'];
	if ( !empty($_POST['UTM_norte']) )      $UTM_norte      = $_POST['UTM_norte'];
	if ( !empty($_POST['UTM_este']) )       $UTM_este       = $_POST['UTM_este'];
	

	
	
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
			case 'idSector':  if(empty($idSector)){   $error['idSector']   = 'error/No ha ingresado el id';}break;
			case 'idSistema': if(empty($idSistema)){  $error['idSistema']  = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':    if(empty($Nombre)){     $error['Nombre']     = 'error/No ha ingresado el nombre';}break;
			case 'UTM_norte': if(empty($UTM_norte)){  $error['UTM_norte']  = 'error/No ha ingresado la UTM';}break;
			case 'UTM_este':  if(empty($UTM_este)){   $error['UTM_este']   = 'error/No ha ingresado la UTM';}break;
			
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
				$sql_usuario = mysqli_query("SELECT Nombre FROM analisis_sectores WHERE Nombre='".$Nombre."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idTipoBoton'] = 'error/El nombre del parametro ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){   $a = "'".$idSistema."'" ;      }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){         $a .= ",'".$Nombre."'" ;       }else{$a .= ",''";}
				if(isset($UTM_norte) && $UTM_norte != ''){   $a .= ",'".$UTM_norte."'" ;    }else{$a .= ",''";}
				if(isset($UTM_este) && $UTM_este != ''){     $a .= ",'".$UTM_este."'" ;     }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `analisis_sectores` (idSistema, Nombre, UTM_norte, UTM_este) VALUES ({$a} )";
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
				$a = "idSector='".$idSector."'" ;
				if(isset($idSistema) && $idSistema != ''){    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){          $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($UTM_norte) && $UTM_norte != ''){    $a .= ",UTM_norte='".$UTM_norte."'" ;}
				if(isset($UTM_este) && $UTM_este != ''){      $a .= ",UTM_este='".$UTM_este."'" ;}
				
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `analisis_sectores` SET ".$a." WHERE idSector = '$idSector'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		break;	
					
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `analisis_sectores` WHERE idSector = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
