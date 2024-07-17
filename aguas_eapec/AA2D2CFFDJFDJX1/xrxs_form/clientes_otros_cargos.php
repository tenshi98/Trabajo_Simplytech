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
	if ( !empty($_POST['idOtrosCargos']) )   $idOtrosCargos    = $_POST['idOtrosCargos'];
	if ( !empty($_POST['idSistema']) )       $idSistema        = $_POST['idSistema'];
	if ( !empty($_POST['idCliente']) )       $idCliente        = $_POST['idCliente'];
	if ( !empty($_POST['idUsuario']) )       $idUsuario        = $_POST['idUsuario'];
	if ( !empty($_POST['FechaEjecucion']) )  $FechaEjecucion   = $_POST['FechaEjecucion'];
	if ( !empty($_POST['Fecha']) )           $Fecha            = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )             $Dia              = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )           $idMes            = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )             $Ano              = $_POST['Ano'];
	if ( !empty($_POST['Observacion']) )     $Observacion      = $_POST['Observacion'];
	if ( !empty($_POST['ValorCargo']) )      $ValorCargo       = $_POST['ValorCargo'];
	
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
			case 'idOtrosCargos':  if(empty($idOtrosCargos)){   $error['idOtrosCargos']   = 'error/No ha ingresado el id';}break;
			case 'idSistema':      if(empty($idSistema)){       $error['idSistema']       = 'error/No ha seleccionado el sistema';}break;
			case 'idCliente':      if(empty($idCliente)){       $error['idCliente']       = 'error/No ha seleccionado el cliente';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']       = 'error/No ha seleccionado el usuario';}break;
			case 'FechaEjecucion': if(empty($FechaEjecucion)){  $error['FechaEjecucion']  = 'error/No ha ingresado la Fecha de Ejecucion';}break;
			case 'Fecha':          if(empty($Fecha)){           $error['Fecha']           = 'error/No ha ingresado la Fecha de facturacion';}break;
			case 'Dia':            if(empty($Dia)){             $error['Dia']             = 'error/No ha ingresado el dia de facturacion';}break;
			case 'idMes':          if(empty($idMes)){           $error['idMes']           = 'error/No ha ingresado el mes de facturacion';}break;
			case 'Ano':            if(empty($Ano)){             $error['Ano']             = 'error/No ha ingresado el año de facturacion';}break;
			case 'Observacion':    if(empty($Observacion)){     $error['Observacion']     = 'error/No ha ingresado la observacion';}break;
			case 'ValorCargo':     if(empty($ValorCargo)){      $error['ValorCargo']      = 'error/No ha ingresado rl vaalor del trabajo';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){             $a = "'".$idSistema."'" ;          }else{$a ="''";}
				if(isset($idCliente) && $idCliente != ''){             $a .= ",'".$idCliente."'" ;        }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){             $a .= ",'".$idUsuario."'" ;        }else{$a .= ",''";}
				if(isset($FechaEjecucion) && $FechaEjecucion != ''){   $a .= ",'".$FechaEjecucion."'" ;   }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){                     $a .= ",'".$Fecha."'" ;            }else{$a .= ",''";}
				if(isset($Dia) && $Dia != ''){                         $a .= ",'".$Dia."'" ;              }else{$a .= ",''";}
				if(isset($idMes) && $idMes != ''){                     $a .= ",'".$idMes."'" ;            }else{$a .= ",''";}
				if(isset($Ano) && $Ano != ''){                         $a .= ",'".$Ano."'" ;              }else{$a .= ",''";}
				if(isset($Observacion) && $Observacion != ''){         $a .= ",'".$Observacion."'" ;      }else{$a .= ",''";}
				if(isset($ValorCargo) && $ValorCargo != ''){           $a .= ",'".$ValorCargo."'" ;       }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `clientes_otros_cargos` (idSistema, idCliente, idUsuario, FechaEjecucion,
				Fecha, Dia, idMes, Ano, Observacion, ValorCargo) 
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
				$a = "idOtrosCargos='".$idOtrosCargos."'" ;
				if(isset($idSistema) && $idSistema != ''){             $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idCliente) && $idCliente != ''){             $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){             $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($FechaEjecucion) && $FechaEjecucion != ''){   $a .= ",FechaEjecucion='".$FechaEjecucion."'" ;}
				if(isset($Fecha) && $Fecha != ''){                     $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Dia) && $Dia != ''){                         $a .= ",Dia='".$Dia."'" ;}
				if(isset($idMes) && $idMes != ''){                     $a .= ",idMes='".$idMes."'" ;}
				if(isset($Ano) && $Ano != ''){                         $a .= ",Ano='".$Ano."'" ;}
				if(isset($Observacion) && $Observacion != ''){         $a .= ",Observacion='".$Observacion."'" ;}
				if(isset($ValorCargo) && $ValorCargo != ''){           $a .= ",ValorCargo='".$ValorCargo."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `clientes_otros_cargos` SET ".$a." WHERE idOtrosCargos = '$idOtrosCargos'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	
							
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `clientes_otros_cargos` WHERE idOtrosCargos = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
