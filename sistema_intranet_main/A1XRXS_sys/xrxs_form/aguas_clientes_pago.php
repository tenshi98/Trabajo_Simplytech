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
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/	
	if(isset($nDocPago) && $nDocPago != ''){    $nDocPago  = EstandarizarInput($nDocPago); }
	if(isset($montoPago) && $montoPago != ''){  $montoPago = EstandarizarInput($montoPago); }
	
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
				$arrFacturaciones = db_select_array (false, 'idFacturacionDetalle, DetalleTotalAPagar, DetalleTotalVenta, montoPago', 'aguas_facturacion_listado_detalle', 0, 'idCliente = '.$idCliente.' AND idEstado = 1', 'Ano ASC, idMes ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/*********************************************************************************/
				//Se crea el registro madre con el pago ingresado
				if(isset($idTipoPago) && $idTipoPago != ''){                      $SIS_data  = "'".$idTipoPago."'" ;              }else{$SIS_data  = "''";}
				if(isset($nDocPago) && $nDocPago != ''){                          $SIS_data .= ",'".$nDocPago."'" ;               }else{$SIS_data .= ",''";}
				if(isset($montoPago) && $montoPago != ''){                        $SIS_data .= ",'".$montoPago."'" ;              }else{$SIS_data .= ",''";}
				if(isset($idUsuarioPago) && $idUsuarioPago != ''){                $SIS_data .= ",'".$idUsuarioPago."'" ;          }else{$SIS_data .= ",''";}
				if(isset($idCliente) && $idCliente != ''){                        $SIS_data .= ",'".$idCliente."'" ;              }else{$SIS_data .= ",''";}
				if(isset($idFacturacionDetalle) && $idFacturacionDetalle != ''){  $SIS_data .= ",'".$idFacturacionDetalle."'" ;   }else{$SIS_data .= ",''";}
				if(isset($fechaPago) && $fechaPago != ''){                  
					$SIS_data .= ",'".$fechaPago."'" ; 
					$SIS_data .= ",'".fecha2NdiaMes($fechaPago)."'" ; 
					$SIS_data .= ",'".fecha2NMes($fechaPago)."'" ; 
					$SIS_data .= ",'".fecha2Ano($fechaPago)."'" ;         
				}else{
					$SIS_data .= ",''";
					$SIS_data .= ",''";
					$SIS_data .= ",''";
					$SIS_data .= ",''";
				}
				
				// inserto los datos de registro en la db
				$SIS_columns = 'idTipoPago, nDocPago, montoPago, idUsuarioPago, idCliente, idFacturacionDetalle, fechaPago, DiaPago, idMesPago, AnoPago';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_clientes_pago', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){
				
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
							$SIS_data = "idEstado='2'";
							if(isset($idTipoPago) && $idTipoPago != ''){        $SIS_data .= ",idTipoPago='".$idTipoPago."'" ;}
							if(isset($nDocPago) && $nDocPago != ''){            $SIS_data .= ",nDocPago='".$nDocPago."'" ;}
							if(isset($fechaPago) && $fechaPago != ''){          
								$SIS_data .= ",fechaPago='".$fechaPago."'" ;
								$SIS_data .= ",DiaPago='".fecha2NdiaMes($fechaPago)."'" ; 
								$SIS_data .= ",idMesPago='".fecha2NMes($fechaPago)."'" ; 
								$SIS_data .= ",AnoPago='".fecha2Ano($fechaPago)."'" ;
							}
							if(isset($montoPago) && $montoPago != ''){          $SIS_data .= ",montoPago='".$fac['DetalleTotalAPagar']."'" ;}
							if(isset($idUsuarioPago) && $idUsuarioPago != ''){  $SIS_data .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
							if(isset($ultimo_id) && $ultimo_id != ''){          $SIS_data .= ",idPago='".$ultimo_id."'" ;}
								
							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $SIS_data, 'aguas_facturacion_listado_detalle', 'idFacturacionDetalle = "'.$fac['idFacturacionDetalle'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							
							/**************************************************************/
							//Guardo los pagos relacionados
							if(isset($idTipoPago) && $idTipoPago != ''){   $SIS_data  = "'".$idTipoPago."'" ; }else{$SIS_data  = "''";}
							if(isset($nDocPago) && $nDocPago != ''){       $SIS_data .= ",'".$nDocPago."'" ;  }else{$SIS_data .= ",''";}
							if(isset($fechaPago) && $fechaPago != ''){          
								$SIS_data .= ",'".$fechaPago."'" ;
								$SIS_data .= ",'".fecha2NdiaMes($fechaPago)."'" ; 
								$SIS_data .= ",'".fecha2NMes($fechaPago)."'" ; 
								$SIS_data .= ",'".fecha2Ano($fechaPago)."'" ;
							}else{
								$SIS_data .= ",''";
								$SIS_data .= ",''";
								$SIS_data .= ",''";
								$SIS_data .= ",''";
							}
							if(isset($montoPago) && $montoPago != ''){           $SIS_data .= ",'".$montoPago."'" ;        }else{$SIS_data .= ",''";}
							if(isset($idUsuarioPago) && $idUsuarioPago != ''){   $SIS_data .= ",'".$idUsuarioPago."'" ;    }else{$SIS_data .= ",''";}
							if(isset($idCliente) && $idCliente != ''){           $SIS_data .= ",'".$idCliente."'" ;        }else{$SIS_data .= ",''";}
							if(isset($fac['idFacturacionDetalle']) && $fac['idFacturacionDetalle'] != ''){           
								$SIS_data .= ",'".$fac['idFacturacionDetalle']."'" ;    
							}else{
								$SIS_data .= ",''";
							}
							
							// inserto los datos de registro en la db
							$SIS_columns = 'idTipoPago, nDocPago, fechaPago, DiaPago, idMesPago, AnoPago, montoPago, idUsuarioPago, idCliente, idFacturacionDetalle';
							$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_clientes_pagos_relacionados', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							
						}else{
							$fact_impagas++;
						}
						
					}
					
					/**************************************************************/
					//actualizo el estado de la ultima facturacion
					$SIS_data = "idFacturacionDetalle = '".$idFacturacionDetalle."' ";
					//verifico que el saldo haya alcanzado para pagar
					//si el ultimo pago no alcanzo para el pago
					if($ultimo_pago>$montoPago){
						$SIS_data .= ",idEstado='1'";
					//si alcanzo justo
					}elseif($ultimo_pago==$montoPago){
						$SIS_data .= ",idEstado='2'";
					//si sobro
					}elseif($ultimo_pago<=$montoPago){
						$SIS_data .= ",idEstado='2'";
					//excepciones
					}else{
						//si no hay facturas impagas
						if($fact_impagas==0){ $SIS_data .= ",idEstado='2'"; }
					}
					if(isset($idTipoPago) && $idTipoPago != ''){        $SIS_data .= ",idTipoPago='".$idTipoPago."'" ;}
					if(isset($nDocPago) && $nDocPago != ''){            $SIS_data .= ",nDocPago='".$nDocPago."'" ;}
					if(isset($fechaPago) && $fechaPago != ''){          
						$SIS_data .= ",fechaPago='".$fechaPago."'" ;
						$SIS_data .= ",DiaPago='".fecha2NdiaMes($fechaPago)."'" ; 
						$SIS_data .= ",idMesPago='".fecha2NMes($fechaPago)."'" ; 
						$SIS_data .= ",AnoPago='".fecha2Ano($fechaPago)."'" ;
					}
					//se verifica si se tiene algun pago anterior, si es asi se suman los montos
					if($pago_anterior>0){
						$nuevo_pago = $pago_anterior + $montoPago;
						if(isset($montoPago) && $montoPago != ''){      $SIS_data .= ",montoPago='".$nuevo_pago."'" ;}
					}else{
						if(isset($montoPago) && $montoPago != ''){      $SIS_data .= ",montoPago='".$montoPago."'" ;}
					}
					if(isset($idUsuarioPago) && $idUsuarioPago != ''){  $SIS_data .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
					if(isset($ultimo_id) && $ultimo_id != ''){          $SIS_data .= ",idPago='".$ultimo_id."'" ;}
								
					/*******************************************************/
					//se actualizan los datos
					$resultado = db_update_data (false, $SIS_data, 'aguas_facturacion_listado_detalle', 'idFacturacionDetalle = "'.$idFacturacionDetalle.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					//Se actualiza el estado del cliente dependiendo del no pago
					/*$SIS_data = "idCliente='".$idCliente."'" ;
					switch ($fact_impagas) {
						case 0:   $SIS_data .= ",idEstadoPago='1'" ; break;
						case 1:   $SIS_data .= ",idEstadoPago='2'" ; break;
						case 2:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 3:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 4:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 5:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 6:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 7:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 8:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 9:   $SIS_data .= ",idEstadoPago='3'" ; break;
						case 10:  $SIS_data .= ",idEstadoPago='3'" ; break;
						case 11:  $SIS_data .= ",idEstadoPago='3'" ; break;
						case 12:  $SIS_data .= ",idEstadoPago='3'" ; break;
					}
					//se actualizan los datos
					$resultado = db_update_data (false, $SIS_data, 'clientes_listado', 'idCliente = "'.$idCliente.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					//Se actualiza el estado del cliente en caso de que el pago actual cubra la facturacion actual
					if($ultimo_pago<=$montoPago){
						//se actualizan los datos
						$SIS_data = "idEstadoPago='1'" ;
						$resultado = db_update_data (false, $SIS_data, 'clientes_listado', 'idCliente = "'.$idCliente.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}*/
					
					header( 'Location: '.$location.'&created=true' );
					die;
					
				}
			}
	
		break;	
						
			
/*******************************************************************************************************************/
	}
?>
