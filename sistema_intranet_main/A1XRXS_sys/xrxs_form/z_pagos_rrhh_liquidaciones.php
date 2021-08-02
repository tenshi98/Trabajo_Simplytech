<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idDocPago']) )       $idDocPago       = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )       $N_DocPago       = $_POST['N_DocPago'];
	if ( !empty($_POST['F_Pago']) )          $F_Pago          = $_POST['F_Pago'];
	if ( !empty($_POST['idUsuario']) )       $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['idSistema']) )       $idSistema       = $_POST['idSistema'];
	
				
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$INT_piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($INT_piezas as $INT_valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($INT_valor) {
			case 'idDocPago':      if(empty($idDocPago)){       $error['idDocPago']      = 'error/No ha seleccionado el documento de pago';}break;
			case 'N_DocPago':      if(empty($N_DocPago)){       $error['N_DocPago']      = 'error/No ha ingresado numero de documento de pago';}break;
			case 'F_Pago':         if(empty($F_Pago)){          $error['F_Pago']         = 'error/No ha ingresado la fecha de pago';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']      = 'error/No ha seleccionado el usuario';}break;
			case 'idSistema':      if(empty($idSistema)){       $error['idSistema']      = 'error/No ha seleccionado el sistema';}break;
			
		}
	}
				
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                  Pago Masivo                                                    */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'del_liquidacion':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Borro todas las sesiones
			unset($_SESSION['pago_rrhh_liquidaciones'][$_GET['del_liquidacion']]);
			
			header( 'Location: '.$location.'&next=true' );
			die;
		
		break;

/*******************************************************************************************************************/		
		case 'pago_general':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//si no existe un numero de documento, se genera uno automaticamente
				if(!isset($N_DocPago) OR $N_DocPago == ''){
					$N_DocPago = time();//clave unica
				}
				
				////////////////////////////////////////////////////////////////////////////////////////////////
				//recorro todos los existentes y les doy pago
				if(isset($_SESSION['pago_rrhh_liquidaciones'])){
					foreach ($_SESSION['pago_rrhh_liquidaciones'] as $key => $tipo){
						//se toman datos previamente guardados
						$idFactTrab    = $tipo['idFactTrab'];
						$montoPactado  = valores_enteros($tipo['TotalAPagar']);
						$ValorPagado   = valores_enteros($tipo['ValorPagado']);
						$MontoPagado   = valores_enteros($tipo['ValorPagado']+$tipo['MontoPagado']);
						
						/*********************************************************************/		
						//se actualiza la liquidacion
						$a = "idFactTrab='".$idFactTrab."'" ;
						if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuarioPago='".$idUsuario."'" ;}
						if(isset($idDocPago) && $idDocPago != ''){       $a .= ",idDocPago='".$idDocPago."'" ;}
						if(isset($N_DocPago) && $N_DocPago != ''){       $a .= ",N_DocPago='".$N_DocPago."'" ;}
						if(isset($F_Pago) && $F_Pago != ''){  
							$a .= ",F_Pago='".$F_Pago."'" ;
							$a .= ",F_Pago_dia='".fecha2NdiaMes($F_Pago)."'" ;
							$a .= ",F_Pago_mes='".fecha2NMes($F_Pago)."'" ;
							$a .= ",F_Pago_ano='".fecha2Ano($F_Pago)."'" ;
						}else{
							$a .= ",''";
							$a .= ",''";
							$a .= ",''";
							$a .= ",''";
						}
						if(isset($MontoPagado) &&$MontoPagado!= ''){   $a .= ",MontoPagado='".$MontoPagado."'" ;}
						//verifico el cierre
						if($montoPactado<=$MontoPagado){
							$a .= ",idEstado='2'" ;//cerrado
						}else{
							$a .= ",idEstado='1'" ;//abierto
						}
						// inserto los datos de registro en la db
						$query  = "UPDATE `rrhh_sueldos_facturacion_trabajadores` SET ".$a." WHERE idFactTrab = '$idFactTrab'";
						//Consulta
						$resultado = mysqli_query($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
									
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
									
						}
						/*********************************************************************/		
						//se inserta el pago
						if(isset($idDocPago) && $idDocPago != ''){   $a  = "'".$idDocPago."'" ;   }else{ $a  = "''"; }
						if(isset($N_DocPago) && $N_DocPago != ''){   $a .= ",'".$N_DocPago."'" ;  }else{ $a .= ",''"; }
						if(isset($F_Pago) && $F_Pago != ''){  
							$a .= ",'".$F_Pago."'" ;
							$a .= ",'".fecha2NdiaMes($F_Pago)."'" ;
							$a .= ",'".fecha2NSemana($F_Pago)."'" ;
							$a .= ",'".fecha2NMes($F_Pago)."'" ;
							$a .= ",'".fecha2Ano($F_Pago)."'" ;
						}else{
							$a .= ",''";
							$a .= ",''";
							$a .= ",''";
							$a .= ",''";
							$a .= ",''";
						}
						if(isset($ValorPagado) && $ValorPagado != ''){       $a .= ",'".$ValorPagado."'" ;    }else{ $a .= ",''"; }
						if(isset($montoPactado) && $montoPactado != ''){     $a .= ",'".$montoPactado."'" ;   }else{ $a .= ",''"; }
						if(isset($idUsuario) && $idUsuario != ''){           $a .= ",'".$idUsuario."'" ;      }else{ $a .= ",''"; }
						if(isset($idSistema) && $idSistema != ''){           $a .= ",'".$idSistema."'" ;      }else{ $a .= ",''"; }
						if(isset($idFactTrab) && $idFactTrab != ''){         $a .= ",'".$idFactTrab."'" ;     }else{ $a .= ",''"; }
									
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `pagos_rrhh_liquidaciones` (idDocPago,N_DocPago,F_Pago,
						F_Pago_dia,F_Pago_Semana,F_Pago_mes,F_Pago_ano,MontoPagado,montoPactado,
						idUsuario,idSistema,idFactTrab) 
						VALUES (".$a.")";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if(!$resultado){
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
										
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
										
						}			
					}	
				}
				
				////////////////////////////////////////////////////////////////////////////////////////////
				//elimino los datos
				unset($_SESSION['pago_rrhh_liquidaciones']);
				
				//redirijo
				header( 'Location: '.$location.'?pay=true' );
				die;
			}

		break;
	
	
	}
?>
