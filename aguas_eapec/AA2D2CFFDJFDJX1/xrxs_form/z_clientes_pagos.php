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
	if ( !empty($_POST['idCliente']) )            $idCliente                = $_POST['idCliente'];
	if ( !empty($_POST['idTipoPago']) )           $idTipoPago               = $_POST['idTipoPago'];
	if ( !empty($_POST['nDocPago']) )             $nDocPago                 = $_POST['nDocPago'];
	if ( !empty($_POST['fechaPago']) )            $fechaPago                = $_POST['fechaPago'];
	if ( !empty($_POST['montoPago']) )            $montoPago                = $_POST['montoPago'];
	if ( !empty($_POST['idUsuarioPago']) )        $idUsuarioPago            = $_POST['idUsuarioPago'];
	if ( !empty($_POST['idFacturacionDetalle']) ) $idFacturacionDetalle     = $_POST['idFacturacionDetalle'];

	
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
			case 'idCliente':       if(empty($idCliente)){        $error['idCliente']      = 'error/No ha ingresado el permiso';}break;
			case 'idTipoPago':      if(empty($idTipoPago)){       $error['idTipoPago']     = 'error/No ha seleccionado el metodo de pago';}break;
			case 'nDocPago':        if(empty($nDocPago)){         $error['nDocPago']       = 'error/No ha ingresado el numero del documento de pago';}break;
			case 'fechaPago':       if(empty($fechaPago)){        $error['fechaPago']      = 'error/No ha ingresado la fecha de pago';}break;
			case 'montoPago':       if(empty($montoPago)){        $error['montoPago']      = 'error/No ha ingresado el monto de pago';}break;
			case 'idUsuarioPago':   if(empty($idUsuarioPago)){    $error['idUsuarioPago']  = 'error/No ha ingresado el usuario pagador';}break;
			
		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'search':
			
			//redirijo a la vista
			header( 'Location: '.$location.'&idCliente='.$idCliente );
			die;
	
		break;
/*******************************************************************************************************************/		
		case 'search2':
			
			//redirijo a la vista
			header( 'Location: view_cliente.php?view='.$idCliente );
			die;
	
		break;
/*******************************************************************************************************************/		
		case 'pago':	
		
			//obtengo las facturaciones atrasadas
			$arrFacturaciones = array();
			$query = "SELECT idFacturacionDetalle, DetalleTotalAPagar, DetalleTotalVenta, montoPago
			FROM `facturacion_listado_detalle`
			WHERE idCliente = '{$idCliente}'
			AND idEstado = 1
			ORDER BY Ano ASC, idMes ASC";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrFacturaciones,$row );
			}


			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Se crea el registro madre con el pago ingresado
				if(isset($idTipoPago) && $idTipoPago != ''){                      $a  = "'".$idTipoPago."'" ;             }else{$a  ="''";}
				if(isset($nDocPago) && $nDocPago != ''){                          $a .= ",'".$nDocPago."'" ;              }else{$a .=",''";}
				if(isset($fechaPago) && $fechaPago != ''){                        
					$a .= ",'".$fechaPago."'" ;
					$a .= ",'".dia_transformado($fechaPago)."'" ; 
					$a .= ",'".Fecha_mes_n($fechaPago)."'" ; 
					$a .= ",'".Fecha_año($fechaPago)."'" ;             
				}else{
					$a .=",''";
					$a .=",''";
					$a .=",''";
					$a .=",''";
				}
				if(isset($montoPago) && $montoPago != ''){                        $a .= ",'".$montoPago."'" ;             }else{$a .=",''";}
				if(isset($idUsuarioPago) && $idUsuarioPago != ''){                $a .= ",'".$idUsuarioPago."'" ;         }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){                        $a .= ",'".$idCliente."'" ;             }else{$a .=",''";}
				if(isset($idFacturacionDetalle) && $idFacturacionDetalle != ''){  $a .= ",'".$idFacturacionDetalle."'" ;  }else{$a .=",''";}
													
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `clientes_pago` (idTipoPago, nDocPago, fechaPago, DiaPago, idMesPago, AnoPago, montoPago, idUsuarioPago,
				idCliente, idFacturacionDetalle ) 
				VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
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
					//Guardo el ultimo saldo a pagar
					$ultimo_pago = $fac['DetalleTotalAPagar'];
					//guardo el monto en caso de tener un pago anterior
					$pago_anterior = $fac['montoPago'];
					//se verifica si el monto pagado cubre el saldo a pagar
					if($fac['DetalleTotalVenta'] <= $temp_monto1){
						//resto el saldo a pagar de lo pagado
						$temp_monto1   = ($temp_monto1 + $fac['montoPago']) - $fac['DetalleTotalVenta'];
						
						//actualizo el esto y los detalles de la facturacion
						$a = "idEstado='2'";
						if(isset($idTipoPago) && $idTipoPago != ''){        $a .= ",idTipoPago='".$idTipoPago."'" ;}
						if(isset($nDocPago) && $nDocPago != ''){            $a .= ",nDocPago='".$nDocPago."'" ;}
						if(isset($fechaPago) && $fechaPago != ''){          
							$a .= ",fechaPago='".$fechaPago."'" ;
							$a .= ",DiaPago='".dia_transformado($fechaPago)."'" ; 
							$a .= ",idMesPago='".Fecha_mes_n($fechaPago)."'" ; 
							$a .= ",AnoPago='".Fecha_año($fechaPago)."'" ;
						}
						if(isset($montoPago) && $montoPago != ''){          $a .= ",montoPago='".$fac['DetalleTotalAPagar']."'" ;}
						if(isset($idUsuarioPago) && $idUsuarioPago != ''){  $a .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
						if(isset($ultimo_id) && $ultimo_id != ''){          $a .= ",idPago='".$ultimo_id."'" ;}
							
						$query  = "UPDATE `facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '{$fac['idFacturacionDetalle']}'";
						$result = mysqli_query($dbConn, $query);
						
						
						//Guardo los pagos relacionados
						if(isset($idTipoPago) && $idTipoPago != ''){   $a  = "'".$idTipoPago."'" ; }else{$a  ="''";}
						if(isset($nDocPago) && $nDocPago != ''){       $a .= ",'".$nDocPago."'" ;  }else{$a .=",''";}
						if(isset($fechaPago) && $fechaPago != ''){          
							$a .= ",'".$fechaPago."'" ;
							$a .= ",'".dia_transformado($fechaPago)."'" ; 
							$a .= ",'".Fecha_mes_n($fechaPago)."'" ; 
							$a .= ",'".Fecha_año($fechaPago)."'" ;
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
						$query  = "INSERT INTO `clientes_pagos_relacionados` (idTipoPago, nDocPago, fechaPago, DiaPago, idMesPago, AnoPago,
						montoPago, idUsuarioPago, idCliente, idFacturacionDetalle) VALUES ({$a} )";
						$result = mysqli_query($dbConn, $query);
						
						
						
					}else{
						$fact_impagas++;
					}
					
				}
				
				//actualizo el estado de la ultima facturacion
				$a = "idFacturacionDetalle = '{$idFacturacionDetalle}' ";
				//verifico que el saldo haya alcanzado para pagar
				if($ultimo_pago>$montoPago){
					$a .= ",idEstado='1'";
				}elseif($ultimo_pago==$montoPago){
					$a .= ",idEstado='2'";
				}elseif($ultimo_pago<=$montoPago){
					$a .= ",idEstado='2'";
				}else{
					if($fact_impagas==0){ $a .= ",idEstado='2'"; }
				}
				if(isset($idTipoPago) && $idTipoPago != ''){        $a .= ",idTipoPago='".$idTipoPago."'" ;}
				if(isset($nDocPago) && $nDocPago != ''){            $a .= ",nDocPago='".$nDocPago."'" ;}
				if(isset($fechaPago) && $fechaPago != ''){          
					$a .= ",fechaPago='".$fechaPago."'" ;
					$a .= ",DiaPago='".dia_transformado($fechaPago)."'" ; 
					$a .= ",idMesPago='".Fecha_mes_n($fechaPago)."'" ; 
					$a .= ",AnoPago='".Fecha_año($fechaPago)."'" ;
				}
				//se verifica si se tiene algun pago anterior, si es asi se suman los montos
				if($pago_anterior>0){
					$nuevo_pago = $pago_anterior + $montoPago;
					if(isset($montoPago) && $montoPago != ''){          $a .= ",montoPago='".$nuevo_pago."'" ;}
				}else{
					if(isset($montoPago) && $montoPago != ''){          $a .= ",montoPago='".$montoPago."'" ;}
				}
				if(isset($idUsuarioPago) && $idUsuarioPago != ''){  $a .= ",idUsuarioPago='".$idUsuarioPago."'" ;}
				if(isset($ultimo_id) && $ultimo_id != ''){          $a .= ",idPago='".$ultimo_id."'" ;}
							
				$query  = "UPDATE `facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '{$idFacturacionDetalle}'";
				$result = mysqli_query($dbConn, $query);
				
				//Se actualiza el estado del cliente dependiendo del no pago
				$a = "idCliente='".$idCliente."'" ;
				switch ($fact_impagas) {
					case 0:   $a .= ",idEstadoPago='1'" ; break;
					case 1:   $a .= ",idEstadoPago='2'" ; break;
					/*case 2:   $a .= ",idEstadoPago='3'" ; break;
					case 3:   $a .= ",idEstadoPago='3'" ; break;
					case 4:   $a .= ",idEstadoPago='3'" ; break;
					case 5:   $a .= ",idEstadoPago='3'" ; break;
					case 6:   $a .= ",idEstadoPago='3'" ; break;
					case 7:   $a .= ",idEstadoPago='3'" ; break;
					case 8:   $a .= ",idEstadoPago='3'" ; break;
					case 9:   $a .= ",idEstadoPago='3'" ; break;
					case 10:  $a .= ",idEstadoPago='3'" ; break;
					case 11:  $a .= ",idEstadoPago='3'" ; break;
					case 12:  $a .= ",idEstadoPago='3'" ; break;*/
				}
				// inserto los datos de registro en la db
				$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$idCliente}'";
				$result = mysqli_query($dbConn, $query);
				
				//Se actualiza el estado del cliente en caso de que el pago actual cubra la facturacion actual
				if($ultimo_pago<=$montoPago){
					$query  = "UPDATE `clientes_listado` SET idEstadoPago='1' WHERE idCliente = '{$idCliente}'";
					$result = mysqli_query($dbConn, $query);
				}
				
				//redirijo a la vista
				header( 'Location: '.$location.'&created=true' );
				die;
			}

	
				
		break;
/*******************************************************************************************************************/
	}
?>
