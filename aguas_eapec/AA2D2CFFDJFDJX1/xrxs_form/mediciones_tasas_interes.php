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
	if ( !empty($_POST['idTasasInteres']) ) $idTasasInteres  = $_POST['idTasasInteres'];
	if ( !empty($_POST['idSistema']) )      $idSistema       = $_POST['idSistema'];
	if ( !empty($_POST['Fecha']) )          $Fecha           = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )            $Dia             = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )          $idMes           = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )            $Ano             = $_POST['Ano'];
	if ( !empty($_POST['TasaCorriente']) )  $TasaCorriente   = $_POST['TasaCorriente'];
	if ( isset($_POST['TasaDia']) )         $TasaDia         = $_POST['TasaDia'];
	if ( !empty($_POST['MC']) )             $MC              = $_POST['MC'];

	
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
			case 'idTasasInteres':   if(empty($idTasasInteres)){  $error['idTasasInteres']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){       $error['idSistema']        = 'error/No ha ingresado el idSistema';}break;
			case 'Fecha':            if(empty($Fecha)){           $error['Fecha']            = 'error/No ha ingresado el Fecha';}break;
			case 'Dia':              if(empty($Dia)){             $error['Dia']              = 'error/No ha ingresado el año';}break;
			case 'idMes':            if(empty($idMes)){           $error['idMes']            = 'error/No ha ingresado el idMes';}break;
			case 'Ano':              if(empty($Ano)){             $error['Ano']              = 'error/No ha ingresado el Ano';}break;
			case 'TasaCorriente':    if(empty($TasaCorriente)){   $error['TasaCorriente']    = 'error/No ha ingresado el Valor de los puntos';}break;
			case 'TasaDia':          if(empty($TasaDia)){         $error['TasaDia']          = 'error/No ha ingresado el valor TasaDia';}break;
			case 'MC':               if(empty($MC)){              $error['MC']               = 'error/No ha ingresado el valor MC';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecAnon las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			//Verifico otros datos
			
			//Se verifica si el dato existe
			if(isset($Fecha)&&isset($Dia)){
				$sql_usuario = mysqli_query("SELECT Fecha FROM mediciones_tasas_interes WHERE Fecha='".$Fecha."' AND Dia='".$Dia."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Fecha'] = 'error/El IPC de este Fecha ya existe en el sistema';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){          $a  = "'".$idSistema."'" ;       }else{$a  ="''";}
				if(isset($Fecha) && $Fecha != ''){                  
					$a .= ",'".$Fecha."'" ; 
					$a .= ",'".dia_transformado($Fecha)."'" ; 
					$a .= ",'".Fecha_mes_n($Fecha)."'" ; 
					$a .= ",'".Fecha_año($Fecha)."'" ;          
				}else{
					$a .=",''";
					$a .=",''";
					$a .=",''";
					$a .=",''";
				}
				if(isset($TasaCorriente) && $TasaCorriente != ''){  $a .= ",'".$TasaCorriente."'" ;  }else{$a .=",''";}
				if(isset($TasaDia) && $TasaDia != ''){              $a .= ",'".$TasaDia."'" ;        }else{$a .=",''";}
				if(isset($MC) && $MC != ''){                        $a .= ",'".$MC."'" ;             }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `mediciones_tasas_interes` (idSistema, Fecha, Dia, idMes, Ano, TasaCorriente,
				TasaDia, MC) 
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
				$a = "idTasasInteres='".$idTasasInteres."'" ;
				if(isset($idSistema) && $idSistema != ''){          $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Fecha) && $Fecha != ''){                  
					$a .= ",Fecha='".$Fecha."'" ;
					$a .= ",Dia='".dia_transformado($Fecha)."'" ;
					$a .= ",idMes='".Fecha_mes_n($Fecha)."'" ;
					$a .= ",Ano='".Fecha_año($Fecha)."'" ;
				}
				if(isset($TasaCorriente) && $TasaCorriente != ''){  $a .= ",TasaCorriente='".$TasaCorriente."'" ;}
				if(isset($TasaDia) && $TasaDia != ''){              $a .= ",TasaDia='".$TasaDia."'" ;}
				if(isset($MC) && $MC != ''){                        $a .= ",MC='".$MC."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `mediciones_tasas_interes` SET ".$a." WHERE idTasasInteres = '$idTasasInteres'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `mediciones_tasas_interes` WHERE idTasasInteres = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
