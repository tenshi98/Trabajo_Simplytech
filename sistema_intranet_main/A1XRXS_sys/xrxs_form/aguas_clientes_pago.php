<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridOtrosCargosad                                                */
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
	if ( !empty($_POST['idCliente']) )               $idCliente              = $_POST['idCliente'];
	if ( !empty($_POST['idTipoPago']) )              $idTipoPago             = $_POST['idTipoPago'];
	if ( !empty($_POST['nDocPago']) )                $nDocPago               = $_POST['nDocPago'];
	if ( !empty($_POST['fechaPago']) )               $fechaPago              = $_POST['fechaPago'];
	if ( !empty($_POST['montoPago']) )               $montoPago              = $_POST['montoPago'];
	if ( !empty($_POST['idUsuarioPago']) )           $idUsuarioPago 	     = $_POST['idUsuarioPago'];
	if ( !empty($_POST['idFacturacionDetalle']) )    $idFacturacionDetalle   = $_POST['idFacturacionDetalle'];
	
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
			case 'idCliente':              if(empty($idCliente)){              $error['idCliente']              = 'error/No ha ingresado el id';}break;
			case 'idTipoPago':             if(empty($idTipoPago)){             $error['idTipoPago']             = 'error/No ha seleccionado el tipo de documento de pago';}break;
			case 'nDocPago':               if(empty($nDocPago)){               $error['nDocPago']               = 'error/No ha ingresado el numero del documento de pago';}break;
			case 'fechaPago':              if(empty($fechaPago)){              $error['fechaPago']              = 'error/No ha ingresado la fecha de pago';}break;
			case 'montoPago':              if(empty($montoPago)){              $error['montoPago']              = 'error/No ha ingresado el monto de pago';}break;
			case 'idUsuarioPago':          if(empty($idUsuarioPago)){          $error['idUsuarioPago']          = 'error/No ha seleccionado el usuario de pago';}break;
			case 'idFacturacionDetalle':   if(empty($idFacturacionDetalle)){   $error['idFacturacionDetalle']   = 'error/No ha ingresado el detalle de facturacion';}break;	
			
		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'pago':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$arrFacturaciones = array();
				$arrFacturaciones = db_select_array (false, 'idFacturacionDetalle, DetalleTotalAPagar, DetalleTotalVenta, montoPago', 'aguas_facturacion_listado_detalle', 0, 'idCliente = '.$idCliente.'AND idEstado = 1', 'Ano ASC, idMes ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/*********************************************************************************/
				//Se crea el registro madre con el pago ingresado
				if(isset($idTipoPago) && $idTipoPago != ''){                      $a  = "'".$idTipoPago."'" ;              }else{$a  ="''";}
				if(isset($nDocPago) && $nDocPago != ''){                          $a .= ",'".$nDocPago."'" ;               }else{$a .= ",''";}
				if(isset($montoPago) && $montoPago != ''){                        $a .= ",'".$montoPago."'" ;              }else{$a .= ",''";}
				if(isset($idUsuarioPago) && $idUsuarioPago != ''){                $a .= ",'".$idUsuarioPago."'" ;          }else{$a .= ",''";}
				if(isset($idCliente) && $idCliente != ''){                        $a .= ",'".$idCliente."'" ;              }else{$a .= ",''";}
				if(isset($idFacturacionDetalle) && $idFacturacionDetalle != ''){  $a .= ",'".$idFacturacionDetalle."'" ;   }else{$a .= ",''";}
				if(isset($fechaPago) && $fechaPago != ''){                  
					$a .= ",'".$fechaPago."'" ; 
					$a .= ",'".fecha2NdiaMes($fechaPago)."'" ; 
					$a .= ",'".fecha2NMes($fechaPago)."'" ; 
					$a .= ",'".fecha2Ano($fechaPago)."'" ;         
				}else{
					$a .=",''";
					$a .=",''";
					$a .=",''";
					$a .=",''";
				}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `aguas_clientes_pago` (idTipoPago, nDocPago, montoPago, idUsuarioPago,
				idCliente, idFacturacionDetalle, fechaPago, DiaPago, idMesPago, AnoPago) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					
					/* ******************************** */
					//creo las variables
					$temp_monto1     = $montoPago;
					$fact_impagas    = 0;
					$pago_anterior   = 0;
					$ultimo_pago     = 0;
					
					//recorro las facturaciones impagas y actualizo su estado
					foreach ($arrFacturaciones as $fac) {
						
						$ultimo_pago    = $fac['DetalleTotalAPagar'];   //Guardo el ultimo saldo a pagar
						$pago_anterior  = $fac['montoPago'];            //guardo el monto en caso de tener un pago anterior
						
						//se verifica si el monto pagado cubre el saldo a pagar
						if($fac['DetalleTotalVenta'] <= $temp_monto1){
							//resto el saldo a pagar de lo pagado
							$temp_monto1   = ($temp_monto1 + $fac['montoPago']) - $fac['DetalleTotalVenta'];
							
							/**************************************************************/
							//actualizo el esto y los detalles de la facturacion
							$a = "idEstado='2'";
							if(isset($idTipoPago) && $idTipoPago != ''){        $a .= ",idTipoPago='".$idTipoPago."'" ;}
							if(isset($nDocPago) && $nDocPago != ''){            $a .= ",nDocPago='".$nDocPago."'" ;}
							if(isset($fechaPago) && $fechaPago != ''){          
								$a .= ",fechaPago='".$fechaPago."'" ;
								$a .= ",DiaPago='".fecha2NdiaMes($fechaPago)."'" ; 
								$a .= ",idMesPago='".fecha2NMes($fechaPago)."'" ; 
								$a .= ",AnoPago='".fecha2Ano($fechaPago)."'" ;
							}
							if(isset($montoPago) && $montoPago != ''){          $a .= ",montoPago='".$fac['DetalleTotalAPagar']."'" ;}
							if(isset($idUsuarioPago) && $idUsuarioPago != ''){  $a .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
							if(isset($ultimo_id) && $ultimo_id != ''){          $a .= ",idPago='".$ultimo_id."'" ;}
								
							$query  = "UPDATE `aguas_facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '".$fac['idFacturacionDetalle']."'";
							$resultado = mysqli_query ($dbConn, $query);
							
							/**************************************************************/
							//Guardo los pagos relacionados
							if(isset($idTipoPago) && $idTipoPago != ''){   $a  = "'".$idTipoPago."'" ; }else{$a  ="''";}
							if(isset($nDocPago) && $nDocPago != ''){       $a .= ",'".$nDocPago."'" ;  }else{$a .=",''";}
							if(isset($fechaPago) && $fechaPago != ''){          
								$a .= ",'".$fechaPago."'" ;
								$a .= ",'".fecha2NdiaMes($fechaPago)."'" ; 
								$a .= ",'".fecha2NMes($fechaPago)."'" ; 
								$a .= ",'".fecha2Ano($fechaPago)."'" ;
							}else{
								$a .=",''";
								$a .=",''";
								$a .=",''";
								$a .=",''";
							}
							if(isset($montoPago) && $montoPago != ''){           $a .= ",'".$montoPago."'" ;        }else{$a .=",''";}
							if(isset($idUsuarioPago) && $idUsuarioPago != ''){   $a .= ",'".$idUsuarioPago."'" ;    }else{$a .=",''";}
							if(isset($idCliente) && $idCliente != ''){           $a .= ",'".$idCliente."'" ;        }else{$a .=",''";}
							if(isset($fac['idFacturacionDetalle']) && $fac['idFacturacionDetalle'] != ''){           
								$a .= ",'".$fac['idFacturacionDetalle']."'" ;    
							}else{
								$a .=",''";
							}
									
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `aguas_clientes_pagos_relacionados` (idTipoPago, nDocPago, fechaPago, DiaPago, idMesPago, AnoPago,
							montoPago, idUsuarioPago, idCliente, idFacturacionDetalle) VALUES (".$a.")";
							$resultado = mysqli_query ($dbConn, $query);
							
						}else{
							$fact_impagas++;
						}
						
					}
					
					/**************************************************************/
					//actualizo el estado de la ultima facturacion
					$a = "idFacturacionDetalle = '".$idFacturacionDetalle."' ";
					//verifico que el saldo haya alcanzado para pagar
					//si el ultimo pago no alcanzo para el pago
					if($ultimo_pago>$montoPago){
						$a .= ",idEstado='1'";
					//si alcanzo justo
					}elseif($ultimo_pago==$montoPago){
						$a .= ",idEstado='2'";
					//si sobro
					}elseif($ultimo_pago<=$montoPago){
						$a .= ",idEstado='2'";
					//excepciones
					}else{
						//si no hay facturas impagas
						if($fact_impagas==0){ $a .= ",idEstado='2'"; }
					}
					if(isset($idTipoPago) && $idTipoPago != ''){        $a .= ",idTipoPago='".$idTipoPago."'" ;}
					if(isset($nDocPago) && $nDocPago != ''){            $a .= ",nDocPago='".$nDocPago."'" ;}
					if(isset($fechaPago) && $fechaPago != ''){          
						$a .= ",fechaPago='".$fechaPago."'" ;
						$a .= ",DiaPago='".fecha2NdiaMes($fechaPago)."'" ; 
						$a .= ",idMesPago='".fecha2NMes($fechaPago)."'" ; 
						$a .= ",AnoPago='".fecha2Ano($fechaPago)."'" ;
					}
					//se verifica si se tiene algun pago anterior, si es asi se suman los montos
					if($pago_anterior>0){
						$nuevo_pago = $pago_anterior + $montoPago;
						if(isset($montoPago) && $montoPago != ''){      $a .= ",montoPago='".$nuevo_pago."'" ;}
					}else{
						if(isset($montoPago) && $montoPago != ''){      $a .= ",montoPago='".$montoPago."'" ;}
					}
					if(isset($idUsuarioPago) && $idUsuarioPago != ''){  $a .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
					if(isset($ultimo_id) && $ultimo_id != ''){          $a .= ",idPago='".$ultimo_id."'" ;}
								
					$query  = "UPDATE `aguas_facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '".$idFacturacionDetalle."'";
					$resultado = mysqli_query ($dbConn, $query);
					
					//Se actualiza el estado del cliente dependiendo del no pago
					/*$a = "idCliente='".$idCliente."'" ;
					switch ($fact_impagas) {
						case 0:   $a .= ",idEstadoPago='1'" ; break;
						case 1:   $a .= ",idEstadoPago='2'" ; break;
						case 2:   $a .= ",idEstadoPago='3'" ; break;
						case 3:   $a .= ",idEstadoPago='3'" ; break;
						case 4:   $a .= ",idEstadoPago='3'" ; break;
						case 5:   $a .= ",idEstadoPago='3'" ; break;
						case 6:   $a .= ",idEstadoPago='3'" ; break;
						case 7:   $a .= ",idEstadoPago='3'" ; break;
						case 8:   $a .= ",idEstadoPago='3'" ; break;
						case 9:   $a .= ",idEstadoPago='3'" ; break;
						case 10:  $a .= ",idEstadoPago='3'" ; break;
						case 11:  $a .= ",idEstadoPago='3'" ; break;
						case 12:  $a .= ",idEstadoPago='3'" ; break;
					}
					// inserto los datos de registro en la db
					$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '".$idCliente."'";
					$resultado = mysqli_query ($dbConn, $query);
					
					//Se actualiza el estado del cliente en caso de que el pago actual cubra la facturacion actual
					if($ultimo_pago<=$montoPago){
						$query  = "UPDATE `clientes_listado` SET idEstadoPago='1' WHERE idCliente = '".$idCliente."'";
						$resultado = mysqli_query ($dbConn, $query);
					}*/
					
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
	}
?>
