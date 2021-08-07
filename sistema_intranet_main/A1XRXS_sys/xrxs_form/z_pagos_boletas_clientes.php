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
	if ( !empty($_POST['idCliente']) )       $idCliente       = $_POST['idCliente'];
	if ( !empty($_POST['idDocPago']) )       $idDocPago       = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )       $N_DocPago       = $_POST['N_DocPago'];
	if ( !empty($_POST['F_Pago']) )          $F_Pago          = $_POST['F_Pago'];
	if ( !empty($_POST['MontoPagado']) )     $MontoPagado     = $_POST['MontoPagado'];
	if ( !empty($_POST['idSistema']) )       $idSistema       = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )       $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['total_pagar']) )     $total_pagar     = $_POST['total_pagar'];
	if ( !empty($_POST['idFacturacion']) )   $idFacturacion   = $_POST['idFacturacion'];
	if ( !empty($_POST['montoPactado']) )    $montoPactado    = $_POST['montoPactado'];

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
			case 'idCliente':      if(empty($idCliente)){       $error['idCliente']      = 'error/No ha ingresado el id';}break;
			case 'idDocPago':      if(empty($idDocPago)){       $error['idDocPago']      = 'error/No ha seleccionado el documento de pago';}break;
			case 'N_DocPago':      if(empty($N_DocPago)){       $error['N_DocPago']      = 'error/No ha ingresado numero de documento de pago';}break;
			case 'F_Pago':         if(empty($F_Pago)){          $error['F_Pago']         = 'error/No ha ingresado la fecha de pago';}break;
			case 'MontoPagado':    if(empty($MontoPagado)){     $error['MontoPagado']    = 'error/No ha ingresado el monto pagado';}break;
			case 'idSistema':      if(empty($idSistema)){       $error['idSistema']      = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']      = 'error/No ha seleccionado el usuario';}break;
			case 'total_pagar':    if(empty($total_pagar)){     $error['total_pagar']    = 'error/No ha ingresado el total a pagar';}break;
			case 'idFacturacion':  if(empty($idFacturacion)){   $error['idFacturacion']  = 'error/No ha seleccionado la facturacion';}break;
			case 'montoPactado':   if(empty($montoPactado)){    $error['montoPactado']   = 'error/No ha ingresado el monto pactado';}break;
			
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
		case 'del_boleta':
		
			//Borro todas las sesiones
			unset($_SESSION['pagos_boletas_clientes'][$_GET['del_boleta']]);
			
			header( 'Location: '.$location.'&next=true' );
			die;
		
		break;
/*******************************************************************************************************************/		
		case 'pago_general':	
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				if(!isset($N_DocPago) OR $N_DocPago == ''){
					$N_DocPago = time();//clave unica
				}
				
				//Verifico el documento de pago
				$rowDoc = db_select_data (false, 'Nombre', 'sistema_documentos_pago', '', 'idDocPago='.$idDocPago, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				////////////////////////////////////////////////////////////////////////////////////////////////
				//recorro todos los existentes y les doy pago
				if(isset($_SESSION['pagos_boletas_clientes'])){
					foreach ($_SESSION['pagos_boletas_clientes'] as $key => $tipo){
						
						$idFacturacion  = $tipo['idFacturacion'];
						$ValorTotal     = $tipo['ValorReal'];
						$MontoPagado    = $tipo['ValorReal']+$tipo['MontoPagado'];
						$MontoCancelado = $tipo['ValorTotal']-$tipo['MontoPagado'];
						$idSistema      = $tipo['idSistema'];
						$idCliente      = $tipo['idCliente'];
								
						//Filtros
						$a = "idFacturacion='".$idFacturacion."'" ;
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
						if(isset($ValorTotal) &&$ValorTotal!= ''){   $a .= ",MontoPagado='".$MontoPagado."'" ;}
						if($ValorTotal==$MontoCancelado){
							$a .= ",idEstado='2'" ;
						}else{
							$a .= ",idEstado='1'" ;
						}
						
						/*******************************************************/
						//se actualizan los datos
						$resultado = db_update_data (false, $a, 'boleta_honorarios_facturacion', 'idFacturacion = "'.$idFacturacion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
						
								
						/*********************************************************************/		
						//Se guarda en historial la accion
						if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
						if(isset($F_Pago) && $F_Pago != ''){                                  $a .= ",'".$F_Pago."'" ;                }else{$a .= ",''";}
						$a .= ",'1'";                                                                             //Creacion Satisfactoria
						$a .= ",'Pago del documento con el documento ".$rowDoc['Nombre']." N° ".$N_DocPago."'";   //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";                           //idUsuario
								
											
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `boleta_honorarios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
								
						/**************************************************************************************/
						//Agrego el pago al historial de pagos
						if(isset($idFacturacion) && $idFacturacion != ''){  $a  = "'".$idFacturacion."'" ;   }else{ $a  = "''"; }
						if(isset($idDocPago) && $idDocPago != ''){          $a .= ",'".$idDocPago."'" ;      }else{ $a .= ",''"; }
						if(isset($N_DocPago) && $N_DocPago != ''){          $a .= ",'".$N_DocPago."'" ;      }else{ $a .= ",''"; }
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
						if(isset($ValorTotal) && $ValorTotal != ''){           $a .= ",'".$ValorTotal."'" ;      }else{ $a .= ",''"; }
						if(isset($MontoCancelado) && $MontoCancelado != ''){   $a .= ",'".$MontoCancelado."'" ;  }else{ $a .= ",''"; }
						if(isset($idUsuario) && $idUsuario != ''){             $a .= ",'".$idUsuario."'" ;       }else{ $a .= ",''"; }
						if(isset($idSistema) && $idSistema != ''){             $a .= ",'".$idSistema."'" ;       }else{ $a .= ",''"; }
						if(isset($idCliente) && $idCliente != ''){             $a .= ",'".$idCliente."'" ;       }else{ $a .= ",''"; }
								
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `pagos_boletas_clientes` (idFacturacion, idDocPago, N_DocPago, F_Pago,
						F_Pago_dia, F_Pago_Semana, F_Pago_mes, F_Pago_ano, MontoPagado, montoPactado, idUsuario, idSistema, idCliente) 
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
				unset($_SESSION['pagos_boletas_clientes']);
				
				//redirijo
				header( 'Location: '.$location.'?pay=true' );
				die;
			}

		break;
	
	
	}
?>
