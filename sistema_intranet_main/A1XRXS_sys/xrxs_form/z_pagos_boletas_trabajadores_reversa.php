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
	if ( !empty($_POST['idTrabajador']) )     $idTrabajador     = $_POST['idTrabajador'];
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
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idTrabajador':    if(empty($idTrabajador)){     $error['idTrabajador']    = 'error/No ha ingresado el id';}break;
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
			
			//validaciones
			if(!isset($_GET['del_idDocPago']) OR $_GET['del_idDocPago']==''){
				$error['idDocPago'] = 'error/No ha seleccionado un documento';
			}
			if(!isset($_GET['del_N_DocPago']) OR $_GET['del_N_DocPago']==''){
				$error['idDocPago'] = 'error/No ha seleccionado un numero de documento';
			}
				
			/*******************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$Docsubmit_filter   = '';
				if(isset($_GET['del_idDocPago'])&&$_GET['del_idDocPago']!=''){
					$Docsubmit_filter .= ' AND pagos_boletas_trabajadores.idDocPago='.$_GET['del_idDocPago'];
				}
				if(isset($_GET['del_N_DocPago'])&&$_GET['del_N_DocPago']!=''){
					$Docsubmit_filter .= ' AND pagos_boletas_trabajadores.N_DocPago='.$_GET['del_N_DocPago'];
				}


						
				//consulto todos los documentos relacionados al Trabajador
				$arrBoletas = array();
				$query = "SELECT 
				pagos_boletas_trabajadores.idPago, 
				pagos_boletas_trabajadores.idTipo, 
				pagos_boletas_trabajadores.idFacturacion,
				pagos_boletas_trabajadores.idFacturacion AS idddd,
				pagos_boletas_trabajadores.MontoPagado,
				(SELECT SUM(MontoPagado) FROM `pagos_boletas_trabajadores`WHERE idFacturacion = idddd AND idTipo=1 LIMIT 1)AS MontoTotal_1,
				(SELECT SUM(MontoPagado) FROM `pagos_boletas_trabajadores`WHERE idFacturacion = idddd AND idTipo=2 LIMIT 1)AS MontoTotal_2,
				(SELECT SUM(MontoPagado) FROM `pagos_boletas_trabajadores`WHERE idFacturacion = idddd AND idTipo=3 LIMIT 1)AS MontoTotal_3,
				(SELECT SUM(MontoPagado) FROM `pagos_boletas_trabajadores`WHERE idFacturacion = idddd AND idTipo=4 LIMIT 1)AS MontoTotal_4
				FROM `pagos_boletas_trabajadores`				
				LEFT JOIN `bodegas_arriendos_facturacion`  ON bodegas_arriendos_facturacion.idFacturacion    = pagos_boletas_trabajadores.idFacturacion
				LEFT JOIN `boleta_honorarios_facturacion`    ON boleta_honorarios_facturacion.idFacturacion      = pagos_boletas_trabajadores.idFacturacion
				LEFT JOIN `bodegas_productos_facturacion`  ON bodegas_productos_facturacion.idFacturacion    = pagos_boletas_trabajadores.idFacturacion
				LEFT JOIN `bodegas_servicios_facturacion`  ON bodegas_servicios_facturacion.idFacturacion    = pagos_boletas_trabajadores.idFacturacion
				WHERE (bodegas_arriendos_facturacion.idTipo=1
				".$Docsubmit_filter.")
				OR (boleta_honorarios_facturacion.idTipo=1
				".$Docsubmit_filter.")		
				OR (bodegas_productos_facturacion.idTipo=1
				".$Docsubmit_filter.")
				OR (bodegas_servicios_facturacion.idTipo=1
				".$Docsubmit_filter.")
				OR (bodegas_arriendos_facturacion.idTipo=10
				".$Docsubmit_filter.")
				OR (boleta_honorarios_facturacion.idTipo=10
				".$Docsubmit_filter.")		
				OR (bodegas_productos_facturacion.idTipo=10
				".$Docsubmit_filter.")
				OR (bodegas_servicios_facturacion.idTipo=10
				".$Docsubmit_filter.")";
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrBoletas,$row );
				}
				
				
				/**********************************************************************/
				if(isset($arrBoletas)){
					foreach ($arrBoletas as $tipo){
						
						switch ($tipo['idTipo']) {
							/**********************************************************************/
							//Factura Insumos
							case 1:
								$nuevoMonto = $tipo['MontoTotal_1'] - $tipo['MontoPagado'];
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
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `boleta_honorarios_facturacion` SET ".$a." WHERE idFacturacion = '".$tipo['idFacturacion']."'";
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
								
								/*********************************************************************/		
								//Se guarda en historial la accion
								if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
								$a .= ",'".fecha_actual()."'" ;           
								$a .= ",'1'";                                                    //Creacion Satisfactoria
								$a .= ",'Se realiza reversa del pago'";                          //Observacion
								$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
								
											
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `boleta_honorarios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
								VALUES ({$a} )";
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
								$query  = "DELETE FROM `pagos_boletas_trabajadores` WHERE idPago = '".$tipo['idPago']."'";
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
								//Actualizo las notas de credito
								$a  = "idFacturacionRelacionado=''" ;
								$a .= ",idEstado='1'" ;
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `boleta_honorarios_facturacion` SET ".$a." WHERE idFacturacionRelacionado = '".$tipo['idFacturacion']."'";
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
								
								break;
							/**********************************************************************/
							//Factura Productos
							case 2:
								
								$nuevoMonto = $tipo['MontoTotal_2'] - $tipo['MontoPagado'];
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
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `bodegas_productos_facturacion` SET ".$a." WHERE idFacturacion = '".$tipo['idFacturacion']."'";
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
								
								/*********************************************************************/		
								//Se guarda en historial la accion
								if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
								$a .= ",'".fecha_actual()."'" ;           
								$a .= ",'1'";                                                    //Creacion Satisfactoria
								$a .= ",'Se realiza reversa del pago'";                          //Observacion
								$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
								
											
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `bodegas_productos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
								VALUES ({$a} )";
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
								$query  = "DELETE FROM `pagos_boletas_trabajadores` WHERE idPago = '".$tipo['idPago']."'";
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
								//Actualizo las notas de credito
								$a  = "idFacturacionRelacionado=''" ;
								$a .= ",idEstado='1'" ;
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `bodegas_productos_facturacion` SET ".$a." WHERE idFacturacionRelacionado = '".$tipo['idFacturacion']."'";
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
											
								break;
							/**********************************************************************/
							//Factura Servicios
							case 3:
								
								$nuevoMonto = $tipo['MontoTotal_3'] - $tipo['MontoPagado'];
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
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `bodegas_servicios_facturacion` SET ".$a." WHERE idFacturacion = '".$tipo['idFacturacion']."'";
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
								
								/*********************************************************************/		
								//Se guarda en historial la accion
								if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
								$a .= ",'".fecha_actual()."'" ;           
								$a .= ",'1'";                                                    //Creacion Satisfactoria
								$a .= ",'Se realiza reversa del pago'";                          //Observacion
								$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
								
											
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `bodegas_servicios_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
								VALUES ({$a} )";
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
								$query  = "DELETE FROM `pagos_boletas_trabajadores` WHERE idPago = '".$tipo['idPago']."'";
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
								//Actualizo las notas de credito
								$a  = "idFacturacionRelacionado=''" ;
								$a .= ",idEstado='1'" ;
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `bodegas_servicios_facturacion` SET ".$a." WHERE idFacturacionRelacionado = '".$tipo['idFacturacion']."'";
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
										
								break;
							/**********************************************************************/
							//Factura Arriendos
							case 4:
								
								$nuevoMonto = $tipo['MontoTotal_4'] - $tipo['MontoPagado'];
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
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `bodegas_arriendos_facturacion` SET ".$a." WHERE idFacturacion = '".$tipo['idFacturacion']."'";
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
								
								/*********************************************************************/		
								//Se guarda en historial la accion
								if(isset($tipo['idFacturacion']) && $tipo['idFacturacion'] != ''){    $a  = "'".$tipo['idFacturacion']."'" ;  }else{$a  = "''";}
								$a .= ",'".fecha_actual()."'" ;           
								$a .= ",'1'";                                                    //Creacion Satisfactoria
								$a .= ",'Se realiza reversa del pago'";                          //Observacion
								$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";  //idUsuario
								
											
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `bodegas_arriendos_facturacion_historial` (idFacturacion, Creacion_fecha, idTipo, Observacion, idUsuario) 
								VALUES ({$a} )";
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
								$query  = "DELETE FROM `pagos_boletas_trabajadores` WHERE idPago = '".$tipo['idPago']."'";
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
								//Actualizo las notas de credito
								$a  = "idFacturacionRelacionado=''" ;
								$a .= ",idEstado='1'" ;
			
								// inserto los datos de registro en la db
								$query  = "UPDATE `bodegas_arriendos_facturacion` SET ".$a." WHERE idFacturacionRelacionado = '".$tipo['idFacturacion']."'";
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
									
								break;
						}
									
						/**********************************************************************/
						
			
					}
				}
				
				
				header( 'Location: '.$location.'?reversa=true' );
				die;
				
			}
			
			
		
		break;

	
	}
?>
