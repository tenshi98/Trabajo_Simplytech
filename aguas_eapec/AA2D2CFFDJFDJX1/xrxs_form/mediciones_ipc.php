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
	if ( !empty($_POST['idIPC']) )         $idIPC        = $_POST['idIPC'];
	if ( !empty($_POST['idSistema']) )     $idSistema    = $_POST['idSistema'];
	if ( !empty($_POST['idMes']) )         $idMes        = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )           $Ano          = $_POST['Ano'];
	if ( !empty($_POST['UTM']) )           $UTM          = $_POST['UTM'];
	if ( !empty($_POST['UTA']) )           $UTA          = $_POST['UTA'];
	if ( !empty($_POST['ValorPuntos']) )   $ValorPuntos  = $_POST['ValorPuntos'];
	if ( !empty($_POST['Mensual']) )       $Mensual      = $_POST['Mensual'];
	if ( !empty($_POST['Acumulado']) )     $Acumulado    = $_POST['Acumulado'];
	if ( !empty($_POST['DoceMeses']) )     $DoceMeses    = $_POST['DoceMeses'];
	
	
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
			case 'idIPC':        if(empty($idIPC)){        $error['idIPC']        = 'error/No ha ingresado el id';}break;
			case 'idSistema':    if(empty($idSistema)){    $error['idSistema']    = 'error/No ha ingresado el idSistema';}break;
			case 'idMes':        if(empty($idMes)){        $error['idMes']        = 'error/No ha ingresado el idMes';}break;
			case 'Ano':          if(empty($Ano)){          $error['Ano']          = 'error/No ha ingresado el año';}break;
			case 'UTM':          if(empty($UTM)){          $error['UTM']          = 'error/No ha ingresado el UTM';}break;
			case 'UTA':          if(empty($UTA)){          $error['UTA']          = 'error/No ha ingresado el UTA';}break;
			case 'ValorPuntos':  if(empty($ValorPuntos)){  $error['ValorPuntos']  = 'error/No ha ingresado el Valor de los puntos';}break;
			case 'Mensual':      if(empty($Mensual)){      $error['Mensual']      = 'error/No ha ingresado el valor mensual';}break;
			case 'Acumulado':    if(empty($Acumulado)){    $error['Acumulado']    = 'error/No ha ingresado el valor acumulado';}break;
			case 'DoceMeses':    if(empty($DoceMeses)){    $error['DoceMeses']    = 'error/No ha ingresado el valor a doce idMeses';}break;
			
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
				$sql_usuario = mysqli_query("SELECT idMes FROM mediciones_ipc WHERE idMes='".$idMes."' AND Ano='".$Ano."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idMes'] = 'error/El IPC de este idMes ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){      $a  = "'".$idSistema."'" ;     }else{$a  ="''";}
				if(isset($idMes) && $idMes != ''){              $a .= ",'".$idMes."'" ;        }else{$a .=",''";}
				if(isset($Ano) && $Ano != ''){                  $a .= ",'".$Ano."'" ;          }else{$a .=",''";}
				if(isset($UTM) && $UTM != ''){                  $a .= ",'".$UTM."'" ;          }else{$a .=",''";}
				if(isset($UTA) && $UTA != ''){                  $a .= ",'".$UTA."'" ;          }else{$a .=",''";}
				if(isset($ValorPuntos) && $ValorPuntos != ''){  $a .= ",'".$ValorPuntos."'" ;  }else{$a .=",''";}
				if(isset($Mensual) && $Mensual != ''){          $a .= ",'".$Mensual."'" ;      }else{$a .=",''";}
				if(isset($Acumulado) && $Acumulado != ''){      $a .= ",'".$Acumulado."'" ;    }else{$a .=",''";}
				if(isset($DoceMeses) && $DoceMeses != ''){      $a .= ",'".$DoceMeses."'" ;    }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `mediciones_ipc` (idSistema, idMes, Ano, UTM, UTA, ValorPuntos,
				Mensual, Acumulado, DoceMeses) 
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
				$a = "idIPC='".$idIPC."'" ;
				if(isset($idSistema) && $idSistema != ''){      $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idMes) && $idMes != ''){              $a .= ",idMes='".$idMes."'" ;}
				if(isset($Ano) && $Ano != ''){                  $a .= ",Ano='".$Ano."'" ;}
				if(isset($UTM) && $UTM != ''){                  $a .= ",UTM='".$UTM."'" ;}
				if(isset($UTA) && $UTA != ''){                  $a .= ",UTA='".$UTA."'" ;}
				if(isset($ValorPuntos) && $ValorPuntos != ''){  $a .= ",ValorPuntos='".$ValorPuntos."'" ;}
				if(isset($Mensual) && $Mensual != ''){          $a .= ",Mensual='".$Mensual."'" ;}
				if(isset($Acumulado) && $Acumulado != ''){      $a .= ",Acumulado='".$Acumulado."'" ;}
				if(isset($DoceMeses) && $DoceMeses != ''){      $a .= ",DoceMeses='".$DoceMeses."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `mediciones_ipc` SET ".$a." WHERE idIPC = '$idIPC'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `mediciones_ipc` WHERE idIPC = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
