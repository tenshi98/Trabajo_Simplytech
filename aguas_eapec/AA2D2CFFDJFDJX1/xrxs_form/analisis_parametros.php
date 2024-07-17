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
	if ( !empty($_POST['idParametros']) )   $idParametros   = $_POST['idParametros'];
	if ( !empty($_POST['idSistema']) )      $idSistema      = $_POST['idSistema'];
	if ( !empty($_POST['Codigo']) )         $Codigo         = $_POST['Codigo'];
	if ( !empty($_POST['Nombre']) )         $Nombre         = $_POST['Nombre'];
	if ( isset($_POST['Rango_min']) )       $Rango_min      = $_POST['Rango_min'];
	if ( isset($_POST['Rango_max']) )       $Rango_max      = $_POST['Rango_max'];
	
	
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
			case 'idParametros':  if(empty($idParametros)){   $error['idParametros']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':     if(empty($idSistema)){      $error['idSistema']      = 'error/No ha seleccionado el sistema';}break;
			case 'Codigo':        if(empty($Codigo)){         $error['Codigo']         = 'error/No ha ingresado el codigo';}break;
			case 'Nombre':        if(empty($Nombre)){         $error['Nombre']         = 'error/No ha ingresado el nombre';}break;
			case 'Rango_min':     if(empty($Rango_min)){      $error['Rango_min']      = 'error/No ha ingresado el rango minimo';}break;
			case 'Rango_max':     if(empty($Rango_max)){      $error['Rango_max']      = 'error/No ha ingresado el rango maximo';}break;
			
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
				$sql_usuario = mysqli_query("SELECT Nombre FROM analisis_parametros WHERE Nombre='".$Nombre."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idTipoBoton'] = 'error/El nombre del parametro ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){   $a = "'".$idSistema."'" ;      }else{$a ="''";}
				if(isset($Codigo) && $Codigo != ''){         $a .= ",'".$Codigo."'" ;       }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){         $a .= ",'".$Nombre."'" ;       }else{$a .= ",''";}
				if(isset($Rango_min) && $Rango_min != ''){   $a .= ",'".$Rango_min."'" ;    }else{$a .= ",''";}
				if(isset($Rango_max) && $Rango_max != ''){   $a .= ",'".$Rango_max."'" ;    }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `analisis_parametros` (idSistema, Codigo, Nombre, Rango_min, Rango_max) VALUES ({$a} )";
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
				$a = "idParametros='".$idParametros."'" ;
				if(isset($idSistema) && $idSistema != ''){    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Codigo) && $Codigo != ''){          $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($Nombre) && $Nombre != ''){          $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Rango_min) && $Rango_min != ''){    $a .= ",Rango_min='".$Rango_min."'" ;}
				if(isset($Rango_max) && $Rango_max != ''){    $a .= ",Rango_max='".$Rango_max."'" ;}
				
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `analisis_parametros` SET ".$a." WHERE idParametros = '$idParametros'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
		break;	
					
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `analisis_parametros` WHERE idParametros = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
