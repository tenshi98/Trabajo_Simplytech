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
	if ( !empty($_POST['idTrabajador']) )     $idTrabajador     = $_POST['idTrabajador'];
	
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
			case 'idTrabajador':    if(empty($idTrabajador)){     $error['idTrabajador']    = 'error/No ha ingresado el id';}break;
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
			
			//Variable
			$errorn = 0;
			
			/************************************************************/
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_idPago']) OR !validaEntero($_GET['del_idPago']))&&$_GET['del_idPago']!=''){
				$indice1 = simpleDecode($_GET['del_idPago'], fecha_actual());
			}else{
				$indice1 = $_GET['del_idPago'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
			}
			if((!validarNumero($_GET['idFacturacion']) OR !validaEntero($_GET['idFacturacion']))&&$_GET['idFacturacion']!=''){
				$indice2 = simpleDecode($_GET['idFacturacion'], fecha_actual());
			}else{
				$indice2 = $_GET['idFacturacion'];
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
					$error['idDocPago'] = 'error/No ha seleccionado el pago';
				}
				if(!isset($indice2) OR $indice2==''){
					$error['idFacturacion'] = 'error/No ha seleccionado el documento';
				}
					
				/*******************************************************************/
				// si no hay errores ejecuto el codigo	
				if ( empty($error) ) {
					
					/**********************************************************************/
					//selecciono el monto desde el registro de pago
					$rowPago = db_select_data (false, 'pagos_boletas_empresas.MontoPagado,sistema_documentos_pago.Nombre AS Documento,pagos_boletas_empresas.N_DocPago', 'pagos_boletas_empresas', 'LEFT JOIN sistema_documentos_pago ON sistema_documentos_pago.idDocPago = pagos_boletas_empresas.idDocPago', 'pagos_boletas_empresas.idPago = "'.$indice1.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					//selecciono los datos de la boleta
					$rowBoleta = db_select_data (false, 'MontoPagado,idUsuarioPago,idDocPago,N_DocPago,F_Pago,F_Pago_dia,F_Pago_mes,F_Pago_ano', 'boleta_honorarios_facturacion', '', 'idFacturacion = "'.$indice2.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
					//verifico si el dato es pago parcial
					if($rowBoleta['MontoPagado']>$rowPago['MontoPagado']){
						$nuevoMonto = $rowBoleta['MontoPagado'] - $rowPago['MontoPagado'];
						//se actualiza con los datos del pago anterior
						$a  = "idUsuarioPago='".$rowBoleta['idUsuarioPago']."'" ;
						$a .= ",idDocPago='".$rowBoleta['idDocPago']."'" ;
						$a .= ",N_DocPago='".$rowBoleta['N_DocPago']."'" ;
						$a .= ",F_Pago='".$rowBoleta['F_Pago']."'" ;
						$a .= ",F_Pago_dia='".$rowBoleta['F_Pago_dia']."'" ;
						$a .= ",F_Pago_mes='".$rowBoleta['F_Pago_mes']."'" ;
						$a .= ",F_Pago_ano='".$rowBoleta['F_Pago_ano']."'" ;
						$a .= ",MontoPagado='".$nuevoMonto."'" ;
						$a .= ",idEstado='1'" ;
				
						// inserto los datos de registro en la db
						$query  = "UPDATE `boleta_honorarios_facturacion` SET ".$a." WHERE idFacturacion = '".$indice2."'";
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
						
					//si es pago completo
					}elseif($rowBoleta['MontoPagado']==$rowPago['MontoPagado']){
						//se actualiza con los datos del pago anterior
						$a  = "idUsuarioPago=''";
						$a .= ",idDocPago=''";
						$a .= ",N_DocPago=''";
						$a .= ",F_Pago=''";
						$a .= ",F_Pago_dia=''";
						$a .= ",F_Pago_mes=''";
						$a .= ",F_Pago_ano=''";
						$a .= ",MontoPagado=''";
						$a .= ",idEstado='1'" ;
				
						// inserto los datos de registro en la db
						$query  = "UPDATE `boleta_honorarios_facturacion` SET ".$a." WHERE idFacturacion = '".$indice2."'";
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
					
					/**********************************************************************/
					//se guarda dato en el historial, indicando documento eliminado y su numero
					if(isset($indice2) && $indice2 != ''){    
						
						$a  = "'".$indice2."'" ;  
						$a .= ",'".fecha_actual()."'" ;           
						$a .= ",'1'";                                                                                                   //Creacion Satisfactoria
						$a .= ",'Se realiza reversa del pago del documento ".$rowPago['Documento']." N° ".$rowPago['N_DocPago']."'";    //Observacion
						$a .= ",'".$_SESSION['usuario']['basic_data']['idUsuario']."'";                                                 //idUsuario
												
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
					}
					
					/**********************************************************************/
					//se borran los datos
					if(isset($indice2) && $indice2 != ''){
						$resultado = db_delete_data (false, 'pagos_boletas_empresas', 'idFacturacion = "'.$indice2.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
						//Si ejecuto correctamente la consulta
						if($resultado==true){
							
							//redirijo
							header( 'Location: '.$location.'?reversa=true' );
							die;
							
						}
					}	
				
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			
		
		break;

	}
?>
