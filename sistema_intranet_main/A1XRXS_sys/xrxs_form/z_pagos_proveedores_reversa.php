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
	if ( !empty($_POST['idProveedor']) )     $idProveedor     = $_POST['idProveedor'];
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
			case 'idProveedor':    if(empty($idProveedor)){     $error['idProveedor']    = 'error/No ha ingresado el id';}break;
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
/*                                               Reversa Pago Masivo                                               */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'del_pagos':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/************************************************************/
			//verifico si se envia un entero
			if((!validarNumero($indice1) OR !validaEntero($indice1))&&$indice1!=''){
				$indice1 = simpleDecode($indice1, fecha_actual());
			}else{
				$indice1 = $indice1;
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
			}
			if((!validarNumero($indice2) OR !validaEntero($indice2))&&$indice2!=''){
				$indice2 = simpleDecode($indice2, fecha_actual());
			}else{
				$indice2 = $indice2;
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
			}
			
			/************************************************************/
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice1)&&$indice1!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice1 ('.$indice1.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice1)&&$indice1!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice1 ('.$indice1.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice2)&&$indice2!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice2 ('.$indice2.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice2)&&$indice2!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice2 ('.$indice2.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			/************************************************************/
			if($errorn==0){
				
				//validaciones
				if(!isset($indice1) OR $indice1==''){
					$error['idDocPago'] = 'error/No ha seleccionado un documento';
				}
				if(!isset($indice2) OR $indice2==''){
					$error['idDocPago'] = 'error/No ha seleccionado un numero de documento';
				}
					
				/*******************************************************************/
				// si no hay errores ejecuto el codigo	
				if ( empty($error) ) {
					
					$NDocsubmit_filter1  = '';
					$NDocsubmit_filter1 .= ' AND pagos_facturas_proveedores.idDocPago='.$indice1;
					$NDocsubmit_filter1 .= ' AND pagos_facturas_proveedores.N_DocPago='.$indice2;
					
					//Variable con el total del documento pagado
					$Valor_Doc = 0;
							
					//consulto todos los documentos relacionados al proveedor
					$SIS_query = '
					pagos_facturas_proveedores.idPago, 
					pagos_facturas_proveedores.idTipo, 
					pagos_facturas_proveedores.idFacturacion,
					pagos_facturas_proveedores.idFacturacion AS idddd,
					pagos_facturas_proveedores.MontoPagado,
					(SELECT SUM(MontoPagado) FROM `pagos_facturas_proveedores`WHERE idFacturacion = idddd AND idTipo=1 LIMIT 1)AS MontoTotal_1,
					(SELECT SUM(MontoPagado) FROM `pagos_facturas_proveedores`WHERE idFacturacion = idddd AND idTipo=2 LIMIT 1)AS MontoTotal_2,
					(SELECT SUM(MontoPagado) FROM `pagos_facturas_proveedores`WHERE idFacturacion = idddd AND idTipo=3 LIMIT 1)AS MontoTotal_3,
					(SELECT SUM(MontoPagado) FROM `pagos_facturas_proveedores`WHERE idFacturacion = idddd AND idTipo=4 LIMIT 1)AS MontoTotal_4';
					$SIS_join  = '
					LEFT JOIN `bodegas_arriendos_facturacion`  ON bodegas_arriendos_facturacion.idFacturacion    = pagos_facturas_proveedores.idFacturacion
					LEFT JOIN `bodegas_insumos_facturacion`    ON bodegas_insumos_facturacion.idFacturacion      = pagos_facturas_proveedores.idFacturacion
					LEFT JOIN `bodegas_productos_facturacion`  ON bodegas_productos_facturacion.idFacturacion    = pagos_facturas_proveedores.idFacturacion
					LEFT JOIN `bodegas_servicios_facturacion`  ON bodegas_servicios_facturacion.idFacturacion    = pagos_facturas_proveedores.idFacturacion';
					$SIS_where = '(bodegas_arriendos_facturacion.idTipo=1 '.$NDocsubmit_filter1.')
					OR (bodegas_insumos_facturacion.idTipo=1 '.$NDocsubmit_filter1.')		
					OR (bodegas_productos_facturacion.idTipo=1 '.$NDocsubmit_filter1.')
					OR (bodegas_servicios_facturacion.idTipo=1 '.$NDocsubmit_filter1.')
					OR (bodegas_arriendos_facturacion.idTipo=10 '.$NDocsubmit_filter1.')
					OR (bodegas_insumos_facturacion.idTipo=10 '.$NDocsubmit_filter1.')		
					OR (bodegas_productos_facturacion.idTipo=10 '.$NDocsubmit_filter1.')
					OR (bodegas_servicios_facturacion.idTipo=10 '.$NDocsubmit_filter1.')';
					$SIS_order = 'pagos_facturas_proveedores.idPago ASC';
					$arrReversa = array();
					$arrReversa = db_select_array (false, $SIS_query, 'pagos_facturas_proveedores', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					/**********************************************************************/
					if(isset($arrReversa)){
						foreach ($arrReversa as $tipo){
							
							switch ($tipo['idTipo']) {
								/**********************************************************************/
								//Factura Insumos
								case 1:
									//calculo el nuevo saldo
									$nuevoMonto  = $tipo['MontoTotal_1'] - $tipo['MontoPagado'];
									//sumo al total de la reversa
									$Valor_Doc   = $Valor_Doc + $tipo['MontoPagado'];
									
									//Actualizo el pago
									$a  = "idUsuarioPago=''" ;
									$a .= ",idDocPago=''" ;
									$a .= ",N_DocPago=''" ;
									$a .= ",F_Pago=''" ;
									$a .= ",F_Pago_dia=''" ;
									$a .= ",F_Pago_mes=''" ;
									$a .= ",F_Pago_ano=''" ;
									$a .= ",MontoPagado='".$nuevoMonto."'" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_insumos_facturacion', 'idFacturacion = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									
									/*********************************************************************/		
									//Se guarda en historial la accion
									if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
									$a .= ",'".fecha_actual()."'" ;           
									$a .= ",'1'";                                                    //Creacion Satisfactoria
									$a .= ",'Se realiza reversa del pago'";                          //Observacion
									$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
									
												
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `bodegas_insumos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
									
									/**********************************************************************/
									//se borran los datos
									$resultado = db_delete_data (false, 'pagos_facturas_proveedores', 'idPago = "'.$tipo['idPago'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									/**********************************************************************/
									//Actualizo las notas de credito
									$a  = "idFacturacionRelacionado=''" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_insumos_facturacion', 'idFacturacionRelacionado = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									
									break;
								/**********************************************************************/
								//Factura Productos
								case 2:
									
									//calculo el nuevo saldo
									$nuevoMonto  = $tipo['MontoTotal_2'] - $tipo['MontoPagado'];
									//sumo al total de la reversa
									$Valor_Doc   = $Valor_Doc + $tipo['MontoPagado'];
									
									//Actualizo el pago
									$a  = "idUsuarioPago=''" ;
									$a .= ",idDocPago=''" ;
									$a .= ",N_DocPago=''" ;
									$a .= ",F_Pago=''" ;
									$a .= ",F_Pago_dia=''" ;
									$a .= ",F_Pago_mes=''" ;
									$a .= ",F_Pago_ano=''" ;
									$a .= ",MontoPagado='".$nuevoMonto."'" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_productos_facturacion', 'idFacturacion = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									
									/*********************************************************************/		
									//Se guarda en historial la accion
									if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
									$a .= ",'".fecha_actual()."'" ;           
									$a .= ",'1'";                                                    //Creacion Satisfactoria
									$a .= ",'Se realiza reversa del pago'";                          //Observacion
									$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
									
												
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `bodegas_productos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
									
									/**********************************************************************/
									//elimino el registro del pago
									$resultado = db_delete_data (false, 'pagos_facturas_proveedores', 'idPago = "'.$tipo['idPago'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									/**********************************************************************/
									//Actualizo las notas de credito
									$a  = "idFacturacionRelacionado=''" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_productos_facturacion', 'idFacturacionRelacionado = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
												
									break;
								/**********************************************************************/
								//Factura Servicios
								case 3:
									
									//calculo el nuevo saldo
									$nuevoMonto  = $tipo['MontoTotal_3'] - $tipo['MontoPagado'];
									//sumo al total de la reversa
									$Valor_Doc   = $Valor_Doc + $tipo['MontoPagado'];
									
									//Actualizo el pago
									$a  = "idUsuarioPago=''" ;
									$a .= ",idDocPago=''" ;
									$a .= ",N_DocPago=''" ;
									$a .= ",F_Pago=''" ;
									$a .= ",F_Pago_dia=''" ;
									$a .= ",F_Pago_mes=''" ;
									$a .= ",F_Pago_ano=''" ;
									$a .= ",MontoPagado='".$nuevoMonto."'" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_servicios_facturacion', 'idFacturacion = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									
									/*********************************************************************/		
									//Se guarda en historial la accion
									if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
									$a .= ",'".fecha_actual()."'" ;           
									$a .= ",'1'";                                                    //Creacion Satisfactoria
									$a .= ",'Se realiza reversa del pago'";                          //Observacion
									$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
									
												
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
									
									/**********************************************************************/
									//elimino el registro del pago
									$resultado = db_delete_data (false, 'pagos_facturas_proveedores', 'idPago = "'.$tipo['idPago'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									/**********************************************************************/
									//Actualizo las notas de credito
									$a  = "idFacturacionRelacionado=''" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_servicios_facturacion', 'idFacturacionRelacionado = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
											
									break;
								/**********************************************************************/
								//Factura Arriendos
								case 4:
									
									//calculo el nuevo saldo
									$nuevoMonto  = $tipo['MontoTotal_4'] - $tipo['MontoPagado'];
									//sumo al total de la reversa
									$Valor_Doc   = $Valor_Doc + $tipo['MontoPagado'];
									
									//Actualizo el pago
									$a  = "idUsuarioPago=''" ;
									$a .= ",idDocPago=''" ;
									$a .= ",N_DocPago=''" ;
									$a .= ",F_Pago=''" ;
									$a .= ",F_Pago_dia=''" ;
									$a .= ",F_Pago_mes=''" ;
									$a .= ",F_Pago_ano=''" ;
									$a .= ",MontoPagado='".$nuevoMonto."'" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_arriendos_facturacion', 'idFacturacion = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									
									/*********************************************************************/		
									//Se guarda en historial la accion
									if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
									$a .= ",'".fecha_actual()."'" ;           
									$a .= ",'1'";                                                    //Creacion Satisfactoria
									$a .= ",'Se realiza reversa del pago'";                          //Observacion
									$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
									
												
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `bodegas_arriendos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
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
									
									/**********************************************************************/
									//elimino el registro del pago
									$resultado = db_delete_data (false, 'pagos_facturas_proveedores', 'idPago = "'.$tipo['idPago'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									/**********************************************************************/
									//Actualizo las notas de credito
									$a  = "idFacturacionRelacionado=''" ;
									$a .= ",idEstado='1'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $a, 'bodegas_arriendos_facturacion', 'idFacturacionRelacionado = "'.$tipo['idFacturacion'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
										
									break;
							}
										
							/**********************************************************************/
							
				
						}
					}
					/**********************************************************************/
					//Inserto el registro de la reversa
					$a  = "'".$_SESSION['usuario']['basic_data']['idUsuario']."'" ;  //idUsuario
					$a .= ",'".$_SESSION['usuario']['basic_data']['idSistema']."'";  //idSistema
					$a .= ",'".fecha_actual()."'" ;                                  //Fecha        
					$a .= ",'".hora_actual()."'" ;                                   //Hora       
					$a .= ",'".$indice1."'" ;                          //idDocPago
					$a .= ",'".$indice2."'" ;                          //N_DocPago
					$a .= ",'".$Valor_Doc."'" ;                                      //Monto
												
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `pagos_facturas_proveedores_reversa` (idUsuario, 
					idSistema, Fecha, Hora, idDocPago, N_DocPago, Monto) 
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
										
					}else{
						//redirijo
						header( 'Location: '.$location.'?reversa=true' );
						die;
					}
					
					
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			
		
		break;

	
	}
?>
