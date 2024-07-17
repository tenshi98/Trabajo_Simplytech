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
	if ( !empty($_POST['idImpuesto']) )      $idImpuesto      = $_POST['idImpuesto'];
	if ( !empty($_POST['Nombre']) )           $Nombre           = $_POST['Nombre'];
	if ( !empty($_POST['Porcentaje']) )       $Porcentaje       = $_POST['Porcentaje'];
	
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
			case 'idImpuesto':      if(empty($idImpuesto)){      $error['idImpuesto']       = 'error/No ha ingresado el id';}break;
			case 'Nombre':          if(empty($Nombre)){          $error['Nombre']           = 'error/No ha ingresado el nombre';}break;
			case 'Porcentaje':      if(empty($Porcentaje)){      $error['Porcentaje']       = 'error/No ha ingresado el porcentaje';}break;
			
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
				$sql_usuario = mysqli_query("SELECT Nombre FROM bodegas_impuestos WHERE Nombre='".$Nombre."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El Nombre del impuesto ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){            $a = "'".$Nombre."'" ;         }else{$a ="''";}
				if(isset($Porcentaje) && $Porcentaje != ''){    $a .= ",'".$Porcentaje."'" ;   }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_impuestos` (Nombre, Porcentaje) VALUES ({$a} )";
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
				$a = "idImpuesto='".$idImpuesto."'" ;
				if(isset($Nombre) && $Nombre != ''){             $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Porcentaje) && $Porcentaje != ''){     $a .= ",Porcentaje='".$Porcentaje."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `bodegas_impuestos` SET ".$a." WHERE idImpuesto = '$idImpuesto'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
							
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `bodegas_impuestos` WHERE idImpuesto = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
					
/*******************************************************************************************************************/
	}
?>
