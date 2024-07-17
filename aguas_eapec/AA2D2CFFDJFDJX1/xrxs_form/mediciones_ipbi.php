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
	if ( !empty($_POST['idIPBI']) )     $idIPBI       = $_POST['idIPBI'];
	if ( !empty($_POST['idSistema']) )  $idSistema    = $_POST['idSistema'];
	if ( !empty($_POST['idMes']) )      $idMes        = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )        $Ano          = $_POST['Ano'];
	if ( !empty($_POST['Valor']) )      $Valor        = $_POST['Valor'];

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
			case 'idIPBI':      if(empty($idIPBI)){     $error['idIPBI']     = 'error/No ha ingresado el id';}break;
			case 'idSistema':   if(empty($idSistema)){  $error['idSistema']  = 'error/No ha ingresado el idSistema';}break;
			case 'idMes':       if(empty($idMes)){      $error['idMes']        = 'error/No ha ingresado el idMes';}break;
			case 'Ano':         if(empty($Ano)){        $error['Ano']        = 'error/No ha ingresado el año';}break;
			case 'Valor':       if(empty($Valor)){      $error['Valor']      = 'error/No ha ingresado el Valor';}break;
			
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
			if(isset($idMes)&&isset($Ano)){
				$sql_usuario = mysqli_query("SELECT idMes FROM mediciones_ipbi WHERE idMes='".$idMes."' AND Ano='".$Ano."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idMes'] = 'error/El IPC de este idMes ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){      $a  = "'".$idSistema."'" ;     }else{$a  ="''";}
				if(isset($idMes) && $idMes != ''){              $a .= ",'".$idMes."'" ;        }else{$a .=",''";}
				if(isset($Ano) && $Ano != ''){                  $a .= ",'".$Ano."'" ;          }else{$a .=",''";}
				if(isset($Valor) && $Valor != ''){              $a .= ",'".$Valor."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `mediciones_ipbi` (idSistema, idMes, Ano, Valor) 
				VALUES ({$a} )";
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
				$a = "idIPBI='".$idIPBI."'" ;
				if(isset($idSistema) && $idSistema != ''){      $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idMes) && $idMes != ''){              $a .= ",idMes='".$idMes."'" ;}
				if(isset($Ano) && $Ano != ''){                  $a .= ",Ano='".$Ano."'" ;}
				if(isset($Valor) && $Valor != ''){              $a .= ",Valor='".$Valor."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `mediciones_ipbi` SET ".$a." WHERE idIPBI = '$idIPBI'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `mediciones_ipbi` WHERE idIPBI = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
