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
	if ( !empty($_POST['idDocumentos']) )      $idDocumentos        = $_POST['idDocumentos'];
	if ( !empty($_POST['N_Doc']) )             $N_Doc               = $_POST['N_Doc'];
	if ( !empty($_POST['idBodega']) )          $idBodega            = $_POST['idBodega'];
	if ( !empty($_POST['Observaciones']) )     $Observaciones       = $_POST['Observaciones'];
	if ( !empty($_POST['idSistema']) )         $idSistema           = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )         $idUsuario           = $_POST['idUsuario'];
	if ( !empty($_POST['Creacion_fecha']) )    $Creacion_fecha      = $_POST['Creacion_fecha'];
	if ( !empty($_POST['idTipo']) )            $idTipo              = $_POST['idTipo'];
	if ( !empty($_POST['idProducto']) )        $idProducto          = $_POST['idProducto'];
	if ( !empty($_POST['Number']) )            $Number              = $_POST['Number'];
	if ( !empty($_POST['idBodegaOrigen']) )    $idBodegaOrigen      = $_POST['idBodegaOrigen'];
	if ( !empty($_POST['idBodegaDestino']) )   $idBodegaDestino     = $_POST['idBodegaDestino'];
	if ( !empty($_POST['Cantidad']) )          $Cantidad            = $_POST['Cantidad'];
	if ( !empty($_POST['maximo']) )            $maximo              = $_POST['maximo'];
	if ( !empty($_POST['idSistemaDestino']) )  $idSistemaDestino    = $_POST['idSistemaDestino'];
	if ( !empty($_POST['idProveedor']) )       $idProveedor         = $_POST['idProveedor'];
	if ( !empty($_POST['idCliente']) )         $idCliente           = $_POST['idCliente'];
	if ( !empty($_POST['ValorIngreso']) )      $ValorIngreso        = $_POST['ValorIngreso'];
	if ( !empty($_POST['ValorEgreso']) )       $ValorEgreso         = $_POST['ValorEgreso'];
	if ( !empty($_POST['idGuia']) )            $idGuia              = $_POST['idGuia'];
	if ( !empty($_POST['idDocPago']) )         $idDocPago           = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )         $N_DocPago           = $_POST['N_DocPago'];
	if ( !empty($_POST['F_Pago']) )            $F_Pago              = $_POST['F_Pago'];
	if ( !empty($_POST['idFacturacion']) )     $idFacturacion       = $_POST['idFacturacion'];
	if ( !empty($_POST['idImpuesto']) )        $idImpuesto          = $_POST['idImpuesto'];
	if ( !empty($_POST['MontoPagado']) )       $MontoPagado         = $_POST['MontoPagado'];
	
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
			case 'idDocumentos':      if(empty($idDocumentos)){      $error['idDocumentos']     = 'error/No ha ingresado el id';}break;
			case 'N_Doc':             if(empty($N_Doc)){             $error['N_Doc']            = 'error/No ha ingresado el numero de documento';}break;
			case 'idBodega':          if(empty($idBodega)){          $error['idBodega']         = 'error/No ha seleccionado la bodega';}break;
			case 'Observaciones':     if(empty($Observaciones)){     $error['Observaciones']    = 'error/No ha ingresado las obsercaciones';}break;
			case 'idSistema':         if(empty($idSistema)){         $error['idSistema']        = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':         if(empty($idUsuario)){         $error['idUsuario']        = 'error/No ha seleccionado a un usuario';}break;
			case 'Creacion_fecha':    if(empty($Creacion_fecha)){    $error['Creacion_fecha']   = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idTipo':            if(empty($idTipo)){            $error['idTipo']           = 'error/No ha seleccionado un tipo';}break;
			case 'idProducto':        if(empty($idProducto)){        $error['idProducto']       = 'error/No ha seleccionado un producto';}break;
			case 'Number':            if(empty($Number)){            $error['Number']           = 'error/No ha ingresado un numero';}break;
			case 'idBodegaOrigen':    if(empty($idBodegaOrigen)){    $error['idBodegaOrigen']   = 'error/No ha seleccionado la bodega de origen';}break;
			case 'idBodegaDestino':   if(empty($idBodegaDestino)){   $error['idBodegaDestino']  = 'error/No ha seleccionado la bodega de destino';}break;
			case 'Cantidad':          if(empty($Cantidad)){          $error['Cantidad']         = 'error/No ha ingresado la cantidad';}break;
			case 'maximo':            if(empty($maximo)){            $error['maximo']           = 'error/No ha ingresado el maximo';}break;
			case 'idSistemaDestino':  if(empty($idSistemaDestino)){  $error['idSistemaDestino'] = 'error/No ha seleccionado el sistema de destino';}break;
			case 'idProveedor':       if(empty($idProveedor)){       $error['idProveedor']      = 'error/No ha seleccionado el proveedor';}break;
			case 'idCliente':         if(empty($idCliente)){         $error['idCliente']        = 'error/No ha seleccionado el cliente';}break;
			case 'ValorIngreso':      if(empty($ValorIngreso)){      $error['ValorIngreso']     = 'error/No ha ingresado el valor de ingreso';}break;
			case 'ValorEgreso':       if(empty($ValorEgreso)){       $error['ValorEgreso']      = 'error/No ha ingresado el valor de egreso';}break;
			case 'idGuia':            if(empty($idGuia)){            $error['idGuia']           = 'error/No ha seleccionado una guia';}break;
			case 'idDocPago':         if(empty($idDocPago)){         $error['idDocPago']        = 'error/No ha seleccionado un documento de pago';}break;
			case 'N_DocPago':         if(empty($N_DocPago)){         $error['N_DocPago']        = 'error/No ha ingresado un numero de documento de pago';}break;
			case 'F_Pago':            if(empty($F_Pago)){            $error['F_Pago']           = 'error/No ha ingresado una fecha de pago';}break;
			case 'idFacturacion':     if(empty($idFacturacion)){     $error['idFacturacion']    = 'error/No ha ingresado la id de la facturacion';}break;
			case 'idImpuesto':        if(empty($idImpuesto)){        $error['idImpuesto']       = 'error/No ha seleccionado el impuesto';}break;
			case 'MontoPagado':       if(empty($MontoPagado)){       $error['MontoPagado']      = 'error/No ha ingresado el monto de pago';}break;
			
		}
	}	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                       INGRESOS                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/	
	
		case 'new_ingreso':

			//Se verifica si el dato existe
			if(isset($idProveedor)){
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM bodegas_facturacion WHERE idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idProveedor'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['ing_basicos']);
				unset($_SESSION['ing_productos']);
				unset($_SESSION['ing_temporal']);
				unset($_SESSION['ing_guias']);
				unset($_SESSION['ing_impuestos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ing_basicos']['idDocumentos'] = $idDocumentos;
				$_SESSION['ing_basicos']['N_Doc'] = $N_Doc;
				$_SESSION['ing_basicos']['idBodega'] = $idBodega;
				$_SESSION['ing_basicos']['Observaciones'] = $Observaciones;
				$_SESSION['ing_basicos']['idSistema'] = $idSistema;
				$_SESSION['ing_basicos']['idUsuario'] = $idUsuario;
				$_SESSION['ing_basicos']['Creacion_fecha'] = $Creacion_fecha;
				$_SESSION['ing_basicos']['idTipo'] = $idTipo;
				$_SESSION['ing_basicos']['idProveedor'] = $idProveedor;
				$_SESSION['ing_basicos']['Pago_fecha'] = '0000-00-00';
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_ing':

			//Borro todas las sesiones
			unset($_SESSION['ing_basicos']);
			unset($_SESSION['ing_productos']);
			unset($_SESSION['ing_temporal']);
			unset($_SESSION['ing_guias']);
			unset($_SESSION['ing_impuestos']);

			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_ing':

			//Se verifica si el dato existe
			if(isset($idProveedor)){
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM bodegas_facturacion WHERE idProveedor='".$idProveedor."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idProveedor'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['ing_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				$_SESSION['ing_basicos']['idDocumentos'] = $idDocumentos;
				$_SESSION['ing_basicos']['N_Doc'] = $N_Doc;
				$_SESSION['ing_basicos']['idBodega'] = $idBodega;
				$_SESSION['ing_basicos']['idSistema'] = $idSistema;
				$_SESSION['ing_basicos']['idUsuario'] = $idUsuario;
				$_SESSION['ing_basicos']['Creacion_fecha'] = $Creacion_fecha;
				$_SESSION['ing_basicos']['idTipo'] = $idTipo;
				$_SESSION['ing_basicos']['idProveedor'] = $idProveedor;
				
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
	
		break;	
/*******************************************************************************************************************/		
		case 'addfpago':

			$valor    = $_GET['val_select'];

			//valido que no esten vacios
			if(empty($valor)){  $error['valor']  = 'error/No ha ingresado una fecha de termino';}

			if ( empty($error) ) {
				
				$_SESSION['ing_basicos']['Pago_fecha'] = $valor;
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;		
/*******************************************************************************************************************/		
		case 'delfpago':

			if ( empty($error) ) {
				
				$_SESSION['ing_basicos']['Pago_fecha'] = '0000-00-00';
			
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'new_prod_ing':

			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ing_productos'][$idProducto])&&$_SESSION['ing_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['ing_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['ing_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['ing_productos'][$idProducto]['ValorIngreso'] = ($ValorIngreso/$Number);
				$_SESSION['ing_productos'][$idProducto]['ValorTotal'] = $ValorIngreso;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_ing':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['ing_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['ing_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['ing_productos'][$idProducto]['ValorIngreso'] = ($ValorIngreso/$Number);
				$_SESSION['ing_productos'][$idProducto]['ValorTotal'] = $ValorIngreso;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_ing':

			//Borro todas las sesiones
			unset($_SESSION['ing_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'new_guia':

			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ing_guias'][$idGuia])&&$_SESSION['ing_guias'][$idGuia]>0){
				$error['productos'] = 'error/La guia que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['ing_guias'][$idGuia]['idGuia'] = $idGuia;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_guia':

			//Borro todas las sesiones
			unset($_SESSION['ing_guias'][$_GET['del_guia']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'new_impuesto':

			//verificar si el subcomponente ya existe
			if(isset($_SESSION['ing_impuestos'][$idImpuesto])&&$_SESSION['ing_impuestos'][$idImpuesto]>0){
				$error['productos'] = 'error/Impuesto que trata de ingresar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['ing_impuestos'][$idImpuesto]['idImpuesto'] = $idImpuesto;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'del_impuesto':

			//Borro todas las sesiones
			unset($_SESSION['ing_impuestos'][$_GET['del_impuesto']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_ing':

			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['ing_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_ing':

			$_SESSION['ing_temporal'] = $_SESSION['ing_basicos']['Observaciones'];
			$_SESSION['ing_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'ing_bodega':
	

				
		//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['ing_basicos'])){
				if(!isset($_SESSION['ing_basicos']['idDocumentos']) or $_SESSION['ing_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['ing_basicos']['N_Doc']) or $_SESSION['ing_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No seleccionado el area';}
				if(!isset($_SESSION['ing_basicos']['idBodega']) or $_SESSION['ing_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['ing_basicos']['Observaciones']) or $_SESSION['ing_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No seleccionado la maquina';}
				if(!isset($_SESSION['ing_basicos']['idSistema']) or $_SESSION['ing_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['ing_basicos']['idUsuario']) or $_SESSION['ing_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['ing_basicos']['Creacion_fecha']) or $_SESSION['ing_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['ing_basicos']['idTipo']) or $_SESSION['ing_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				//compruebo que sea una factura y que tenga fecha de pago
				if(isset($_SESSION['ing_basicos']['idDocumentos']) && $_SESSION['ing_basicos']['idDocumentos']==2 ){     
					if(!isset($_SESSION['ing_basicos']['Pago_fecha']) or $_SESSION['ing_basicos']['Pago_fecha']=='' or $_SESSION['ing_basicos']['Pago_fecha']=='0000-00-00' ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado la fecha de Pago de la factura';
					}
					if(!isset($_SESSION['ing_impuestos']) ){     
						$error['Pago_fecha']  = 'error/No ha seleccionado un impuesto para la factura';
					}
				}	
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al ingreso de bodega';
			}
			//productos o guias
			if (!isset($_SESSION['ing_productos'])&&!isset($_SESSION['ing_guias'])){
				$error['idProducto']   = 'error/No se han asignado ni productos ni guias';
			}
			

		// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['ing_basicos']['idDocumentos']) && $_SESSION['ing_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['ing_basicos']['idDocumentos']."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['ing_basicos']['N_Doc']) && $_SESSION['ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['ing_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['idBodega']) && $_SESSION['ing_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['ing_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['Observaciones']) && $_SESSION['ing_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['ing_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['idSistema']) && $_SESSION['ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['idUsuario']) && $_SESSION['ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['idTipo']) && $_SESSION['ing_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ing_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['Creacion_fecha']) && $_SESSION['ing_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['ing_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".Fecha_mes_n($_SESSION['ing_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['ing_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['ing_basicos']['idProveedor']) && $_SESSION['ing_basicos']['idProveedor'] != ''){        $a .= ",'".$_SESSION['ing_basicos']['idProveedor']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['ing_basicos']['Pago_fecha']) && $_SESSION['ing_basicos']['Pago_fecha'] != ''){  
					$a .= ",'".$_SESSION['ing_basicos']['Pago_fecha']."'" ;  
					$a .= ",'".dia_transformado($_SESSION['ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".Fecha_mes_n($_SESSION['ing_basicos']['Pago_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['ing_basicos']['Pago_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				$a .= ",'1'";
				$a .= ",''";
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_facturacion` (idDocumentos,N_Doc, idBodegaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, 
				Creacion_mes, Creacion_ano, idProveedor, Pago_fecha, Pago_dia, Pago_mes, Pago_ano, idEstado, DocRel) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
	
						
			//Se guardan los datos de los trabajadores			
				foreach ($_SESSION['ing_productos'] as $key => $producto){
				
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                  $a  = "'".$ultimo_id."'" ;                                 }else{$a  = "''";}
					if(isset($_SESSION['ing_basicos']['idBodega']) && $_SESSION['ing_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['ing_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['ing_basicos']['idSistema']) && $_SESSION['ing_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['ing_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
					if(isset($_SESSION['ing_basicos']['idUsuario']) && $_SESSION['ing_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['ing_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
					if(isset($_SESSION['ing_basicos']['Creacion_fecha']) && $_SESSION['ing_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['ing_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['ing_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['ing_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['ing_basicos']['idDocumentos']) && $_SESSION['ing_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['ing_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['ing_basicos']['N_Doc']) && $_SESSION['ing_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['ing_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['ing_basicos']['idTipo']) && $_SESSION['ing_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['ing_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                        $a .= ",'".$producto['idProducto']."'" ;                   }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                $a .= ",'".$producto['Number']."'" ;                       }else{$a .= ",''";}
					if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){                                    $a .= ",'".$producto['ValorIngreso']."'" ;                 }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                        $a .= ",'".$producto['ValorTotal']."'" ;                   }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing,Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					
					//Actualizo el valor de los productos
					$a = "idProducto='".$producto['idProducto']."'" ;
					if(isset($producto['ValorIngreso']) && $producto['ValorIngreso'] != ''){     
						$a .= ",ValorIngreso='".$producto['ValorIngreso']."'" ;
					}
			
					// inserto los datos de registro en la db
					$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '{$producto['idProducto']}'";
					$result = mysqli_query($dbConn, $query);
		
				}
				
				//Se actualizan las guias a un estado de pago y con relacion al documento recien generado
				if (isset($_SESSION['ing_guias'])){
					foreach ($_SESSION['ing_guias'] as $key => $guias){
						//filtro
						if(isset($ultimo_id) && $ultimo_id != ''){ 
							
							$a  = "DocRel='".$ultimo_id."'" ;    
							$a .= ",idEstado='2'";

							$query  = "UPDATE `bodegas_facturacion` SET ".$a." WHERE idFacturacion = '{$guias['idGuia']}'";
							$result = mysqli_query($dbConn, $query);
						
						}
					}
				}
				
				//Se actualizan los montos de los documentos
				if(isset($ultimo_id) && $ultimo_id != ''){ 
					
					$a  = "idFacturacion='".$ultimo_id."'" ;    
					if(isset($_SESSION['ing_basicos']['valor_neto_fact'])&&$_SESSION['ing_basicos']['valor_neto_fact']!=''){    $a .= ",ValorNeto='".$_SESSION['ing_basicos']['valor_neto_fact']."'";}
					if(isset($_SESSION['ing_basicos']['valor_total_fact'])&&$_SESSION['ing_basicos']['valor_total_fact']!=''){  $a .= ",ValorTotal='".$_SESSION['ing_basicos']['valor_total_fact']."'";}
						
					//en caso de existir impuestos se actualizan los montos	
					if (isset($_SESSION['ing_impuestos'])){
						if(isset($_SESSION['ing_impuestos'][1]['valor'])&&$_SESSION['ing_impuestos'][1]['valor']!=''){              $a .= ",Impuesto_01='".$_SESSION['ing_impuestos'][1]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][2]['valor'])&&$_SESSION['ing_impuestos'][2]['valor']!=''){              $a .= ",Impuesto_02='".$_SESSION['ing_impuestos'][2]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][3]['valor'])&&$_SESSION['ing_impuestos'][3]['valor']!=''){              $a .= ",Impuesto_03='".$_SESSION['ing_impuestos'][3]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][4]['valor'])&&$_SESSION['ing_impuestos'][4]['valor']!=''){              $a .= ",Impuesto_04='".$_SESSION['ing_impuestos'][4]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][5]['valor'])&&$_SESSION['ing_impuestos'][5]['valor']!=''){              $a .= ",Impuesto_05='".$_SESSION['ing_impuestos'][5]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][6]['valor'])&&$_SESSION['ing_impuestos'][6]['valor']!=''){              $a .= ",Impuesto_06='".$_SESSION['ing_impuestos'][6]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][7]['valor'])&&$_SESSION['ing_impuestos'][7]['valor']!=''){              $a .= ",Impuesto_07='".$_SESSION['ing_impuestos'][7]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][8]['valor'])&&$_SESSION['ing_impuestos'][8]['valor']!=''){              $a .= ",Impuesto_08='".$_SESSION['ing_impuestos'][8]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][9]['valor'])&&$_SESSION['ing_impuestos'][9]['valor']!=''){              $a .= ",Impuesto_09='".$_SESSION['ing_impuestos'][9]['valor']."'";}
						if(isset($_SESSION['ing_impuestos'][10]['valor'])&&$_SESSION['ing_impuestos'][10]['valor']!=''){            $a .= ",Impuesto_10='".$_SESSION['ing_impuestos'][10]['valor']."'";}
					}	
						
					$query  = "UPDATE `bodegas_facturacion` SET ".$a." WHERE idFacturacion = '{$ultimo_id}'";
					$result = mysqli_query($dbConn, $query);
					
				}
			
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['ing_basicos']);
				unset($_SESSION['ing_productos']);
				unset($_SESSION['ing_temporal']);
				unset($_SESSION['ing_guias']);
				unset($_SESSION['ing_impuestos']);
			
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}	
	

		break;	
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                        EGRESOS                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_egreso':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			//Se verifica si el dato existe
			if(isset($idCliente)){
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM bodegas_facturacion WHERE idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idCliente'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['egr_basicos']);
				unset($_SESSION['egr_productos']);
				unset($_SESSION['egr_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['egr_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['egr_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['egr_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['egr_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['egr_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['egr_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['egr_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['egr_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['egr_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['egr_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['egr_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_egr':

			//Borro todas las sesiones
			unset($_SESSION['egr_basicos']);
			unset($_SESSION['egr_productos']);
			unset($_SESSION['egr_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_egr':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['egr_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['egr_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['egr_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['egr_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['egr_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['egr_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['egr_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['egr_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['egr_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['egr_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['egr_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['egr_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'new_prod_egr':

			//Traspaso la variable de bodega
			if(isset($_SESSION['egr_basicos']['idBodegaOrigen'])&&$_SESSION['egr_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['egr_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['egr_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['egr_productos'][$idProducto])&&$_SESSION['egr_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['egr_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['egr_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['egr_productos'][$idProducto]['ValorEgreso'] = ($ValorEgreso/$Number);
				$_SESSION['egr_productos'][$idProducto]['ValorTotal'] = $ValorEgreso;

				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_egr':
			
			//Traspaso la variable de bodega
			if(isset($_SESSION['egr_basicos']['idBodegaOrigen'])&&$_SESSION['egr_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['egr_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['egr_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['egr_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['egr_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['egr_productos'][$idProducto]['ValorEgreso'] = ($ValorEgreso/$Number);
				$_SESSION['egr_productos'][$idProducto]['ValorTotal'] = $ValorEgreso;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_egr':

			//Borro todas las sesiones
			unset($_SESSION['egr_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_egr':

			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['egr_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_egr':

			$_SESSION['egr_temporal'] = $_SESSION['egr_basicos']['Observaciones'];
			$_SESSION['egr_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'egr_bodega':
	

				
		//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['egr_basicos'])){
				if(!isset($_SESSION['egr_basicos']['idDocumentos']) or $_SESSION['egr_basicos']['idDocumentos']=='' ){     $error['idDocumentos']     = 'error/No ha ingresado el id del sistema';}
				if(!isset($_SESSION['egr_basicos']['N_Doc']) or $_SESSION['egr_basicos']['N_Doc']=='' ){                   $error['N_Doc']            = 'error/No seleccionado el area';}
				if(!isset($_SESSION['egr_basicos']['idBodega']) or $_SESSION['egr_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['egr_basicos']['Observaciones']) or $_SESSION['egr_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No seleccionado la maquina';}
				if(!isset($_SESSION['egr_basicos']['idSistema']) or $_SESSION['egr_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['egr_basicos']['idUsuario']) or $_SESSION['egr_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['egr_basicos']['Creacion_fecha']) or $_SESSION['egr_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['egr_basicos']['idTipo']) or $_SESSION['egr_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
				if(!isset($_SESSION['egr_basicos']['idCliente']) or $_SESSION['egr_basicos']['idCliente']=='' ){           $error['idCliente']        = 'error/No ha seleccionado el cliente';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al egreso de bodega';
			}
			//productos
			if (isset($_SESSION['egr_productos'])){
				foreach ($_SESSION['egr_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un producto para egresar a bodega';}
				}
			}else{
				$error['idProducto'] = 'error/No productos asignados a este egreso';
			}
			

		// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['egr_basicos']['idDocumentos']) && $_SESSION['egr_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['egr_basicos']['idDocumentos']."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['egr_basicos']['N_Doc']) && $_SESSION['egr_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['egr_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['egr_basicos']['idBodega']) && $_SESSION['egr_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['egr_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['egr_basicos']['Observaciones']) && $_SESSION['egr_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['egr_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['egr_basicos']['idSistema']) && $_SESSION['egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['egr_basicos']['idUsuario']) && $_SESSION['egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['egr_basicos']['idTipo']) && $_SESSION['egr_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['egr_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['egr_basicos']['Creacion_fecha']) && $_SESSION['egr_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['egr_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".Fecha_mes_n($_SESSION['egr_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['egr_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($_SESSION['egr_basicos']['idCliente']) && $_SESSION['egr_basicos']['idCliente'] != ''){         $a .= ",'".$_SESSION['egr_basicos']['idCliente']."'" ;        }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano, idCliente) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
	
						
			//Se guardan los datos de los trabajadores			
				foreach ($_SESSION['egr_productos'] as $key => $producto){
				
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                  $a  = "'".$ultimo_id."'" ;                                 }else{$a  = "''";}
					if(isset($_SESSION['egr_basicos']['idBodega']) && $_SESSION['egr_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['egr_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['egr_basicos']['idSistema']) && $_SESSION['egr_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['egr_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
					if(isset($_SESSION['egr_basicos']['idUsuario']) && $_SESSION['egr_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['egr_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
					if(isset($_SESSION['egr_basicos']['Creacion_fecha']) && $_SESSION['egr_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['egr_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['egr_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['egr_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['egr_basicos']['idDocumentos']) && $_SESSION['egr_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['egr_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['egr_basicos']['N_Doc']) && $_SESSION['egr_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['egr_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['egr_basicos']['idTipo']) && $_SESSION['egr_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['egr_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                        $a .= ",'".$producto['idProducto']."'" ;                   }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                $a .= ",'".$producto['Number']."'" ;                       }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                      $a .= ",'".$producto['ValorEgreso']."'" ;                  }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                        $a .= ",'".$producto['ValorTotal']."'" ;                   }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					
					//Actualizo el valor de los productos
					$a = "idProducto='".$producto['idProducto']."'" ;
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){     
						$a .= ",ValorEgreso='".$producto['ValorEgreso']."'" ;
					}
			
					// inserto los datos de registro en la db
					$query  = "UPDATE `productos_listado` SET ".$a." WHERE idProducto = '{$producto['idProducto']}'";
					$result = mysqli_query($dbConn, $query);
		
				}
			
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['egr_basicos']);
				unset($_SESSION['egr_productos']);
				unset($_SESSION['egr_temporal']);
			
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                   GASTO BODEGA                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_gasto':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			//Se verifica si el dato existe
			if(isset($idCliente)){
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM bodegas_facturacion WHERE idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idCliente'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['gasto_basicos']);
				unset($_SESSION['gasto_productos']);
				unset($_SESSION['gasto_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['gasto_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['gasto_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['gasto_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['gasto_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['gasto_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['gasto_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['gasto_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['gasto_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['gasto_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['gasto_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['gasto_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['gasto_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_gasto':

			//Borro todas las sesiones
			unset($_SESSION['gasto_basicos']);
			unset($_SESSION['gasto_productos']);
			unset($_SESSION['gasto_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_gasto':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['gasto_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['gasto_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['gasto_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['gasto_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['gasto_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['gasto_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['gasto_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['gasto_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['gasto_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['gasto_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['gasto_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['gasto_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['gasto_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'new_prod_gasto':

			//Traspaso la variable de bodega
			if(isset($_SESSION['gasto_basicos']['idBodegaOrigen'])&&$_SESSION['gasto_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['gasto_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['gasto_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['gasto_productos'][$idProducto])&&$_SESSION['gasto_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['gasto_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['gasto_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['gasto_productos'][$idProducto]['ValorEgreso'] = $ValorEgreso;
				$_SESSION['gasto_productos'][$idProducto]['ValorTotal'] = $ValorEgreso*$Number;

				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_gasto':
			
			//Traspaso la variable de bodega
			if(isset($_SESSION['gasto_basicos']['idBodegaOrigen'])&&$_SESSION['gasto_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['gasto_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['gasto_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['gasto_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['gasto_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['gasto_productos'][$idProducto]['ValorEgreso'] = $ValorEgreso;
				$_SESSION['gasto_productos'][$idProducto]['ValorTotal'] = $ValorEgreso*$Number;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_gasto':

			//Borro todas las sesiones
			unset($_SESSION['gasto_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_gasto':

			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['gasto_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_gasto':

			$_SESSION['gasto_temporal'] = $_SESSION['gasto_basicos']['Observaciones'];
			$_SESSION['gasto_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'gasto_bodega':
	

				
		//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['gasto_basicos'])){
				if(!isset($_SESSION['gasto_basicos']['idBodega']) or $_SESSION['gasto_basicos']['idBodega']=='' ){             $error['idBodega']         = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['gasto_basicos']['Observaciones']) or $_SESSION['gasto_basicos']['Observaciones']=='' ){   $error['Observaciones']    = 'error/No seleccionado la maquina';}
				if(!isset($_SESSION['gasto_basicos']['idSistema']) or $_SESSION['gasto_basicos']['idSistema']=='' ){           $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['gasto_basicos']['idUsuario']) or $_SESSION['gasto_basicos']['idUsuario']=='' ){           $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['gasto_basicos']['Creacion_fecha']) or $_SESSION['gasto_basicos']['Creacion_fecha']=='' ){ $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['gasto_basicos']['idTipo']) or $_SESSION['gasto_basicos']['idTipo']=='' ){                 $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al gasto de bodega';
			}
			//productos
			if (isset($_SESSION['gasto_productos'])){
				foreach ($_SESSION['gasto_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un producto para gasto a bodega';}
				}
			}else{
				$error['idProducto'] = 'error/No productos asignados a este gasto';
			}
			

		// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['gasto_basicos']['idDocumentos']) && $_SESSION['gasto_basicos']['idDocumentos'] != ''){      $a  = "'".$_SESSION['gasto_basicos']['idDocumentos']."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['gasto_basicos']['N_Doc']) && $_SESSION['gasto_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['gasto_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['gasto_basicos']['idBodega']) && $_SESSION['gasto_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['gasto_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['gasto_basicos']['Observaciones']) && $_SESSION['gasto_basicos']['Observaciones'] != ''){    $a .= ",'".$_SESSION['gasto_basicos']['Observaciones']."'" ; }else{$a .= ",''";}
				if(isset($_SESSION['gasto_basicos']['idSistema']) && $_SESSION['gasto_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['gasto_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['gasto_basicos']['idUsuario']) && $_SESSION['gasto_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['gasto_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['gasto_basicos']['idTipo']) && $_SESSION['gasto_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['gasto_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
				if(isset($_SESSION['gasto_basicos']['Creacion_fecha']) && $_SESSION['gasto_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['gasto_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".Fecha_mes_n($_SESSION['gasto_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['gasto_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
	
						
			//Se guardan los datos de los trabajadores			
				foreach ($_SESSION['gasto_productos'] as $key => $producto){
				
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                      $a  = "'".$ultimo_id."'" ;                                   }else{$a  = "''";}
					if(isset($_SESSION['gasto_basicos']['idBodega']) && $_SESSION['gasto_basicos']['idBodega'] != ''){              $a .= ",'".$_SESSION['gasto_basicos']['idBodega']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['gasto_basicos']['idSistema']) && $_SESSION['gasto_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['gasto_basicos']['idSistema']."'" ;     }else{$a .= ",''";}
					if(isset($_SESSION['gasto_basicos']['idUsuario']) && $_SESSION['gasto_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['gasto_basicos']['idUsuario']."'" ;     }else{$a .= ",''";}
					if(isset($_SESSION['gasto_basicos']['Creacion_fecha']) && $_SESSION['gasto_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['gasto_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['gasto_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['gasto_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['gasto_basicos']['idDocumentos']) && $_SESSION['gasto_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['gasto_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['gasto_basicos']['N_Doc']) && $_SESSION['gasto_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['gasto_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['gasto_basicos']['idTipo']) && $_SESSION['gasto_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['gasto_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                            $a .= ",'".$producto['idProducto']."'" ;                     }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                    $a .= ",'".$producto['Number']."'" ;                         }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                          $a .= ",'".$producto['ValorEgreso']."'" ;                    }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                            $a .= ",'".$producto['ValorTotal']."'" ;                     }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
		
				}
			
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['gasto_basicos']);
				unset($_SESSION['gasto_productos']);
				unset($_SESSION['gasto_temporal']);
			
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                TRASPASO BODEGA                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_traspaso':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			//Se verifica si el dato existe
			if(isset($idCliente)){
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM bodegas_facturacion WHERE idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idCliente'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['traspaso_basicos']);
				unset($_SESSION['traspaso_productos']);
				unset($_SESSION['traspaso_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['traspaso_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['traspaso_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['traspaso_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['traspaso_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['traspaso_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['traspaso_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['traspaso_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['traspaso_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['traspaso_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['traspaso_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['traspaso_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['traspaso_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_traspaso':

			//Borro todas las sesiones
			unset($_SESSION['traspaso_basicos']);
			unset($_SESSION['traspaso_productos']);
			unset($_SESSION['traspaso_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_traspaso':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['traspaso_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['traspaso_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['traspaso_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['traspaso_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['traspaso_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['traspaso_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['traspaso_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['traspaso_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['traspaso_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['traspaso_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['traspaso_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['traspaso_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['traspaso_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'new_prod_traspaso':

			//Traspaso la variable de bodega
			if(isset($_SESSION['traspaso_basicos']['idBodegaOrigen'])&&$_SESSION['traspaso_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['traspaso_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['traspaso_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['traspaso_productos'][$idProducto])&&$_SESSION['traspaso_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['traspaso_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['traspaso_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['traspaso_productos'][$idProducto]['ValorEgreso'] = $ValorEgreso;
				$_SESSION['traspaso_productos'][$idProducto]['ValorTotal'] = $ValorEgreso*$Number;

				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_traspaso':
			
			//Traspaso la variable de bodega
			if(isset($_SESSION['traspaso_basicos']['idBodegaOrigen'])&&$_SESSION['traspaso_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['traspaso_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['traspaso_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['traspaso_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['traspaso_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['traspaso_productos'][$idProducto]['ValorEgreso'] = $ValorEgreso;
				$_SESSION['traspaso_productos'][$idProducto]['ValorTotal'] = $ValorEgreso*$Number;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_traspaso':

			//Borro todas las sesiones
			unset($_SESSION['traspaso_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_traspaso':

			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['traspaso_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_traspaso':

			$_SESSION['traspaso_temporal'] = $_SESSION['traspaso_basicos']['Observaciones'];
			$_SESSION['traspaso_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'traspaso_bodega':
	

				
		//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['traspaso_basicos'])){
				if(!isset($_SESSION['traspaso_basicos']['idBodegaOrigen']) or $_SESSION['traspaso_basicos']['idBodegaOrigen']=='' ){    $error['idBodegaOrigen']   = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['traspaso_basicos']['idBodegaDestino']) or $_SESSION['traspaso_basicos']['idBodegaDestino']=='' ){  $error['idBodegaDestino']  = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['traspaso_basicos']['Observaciones']) or $_SESSION['traspaso_basicos']['Observaciones']=='' ){      $error['Observaciones']    = 'error/No seleccionado la maquina';}
				if(!isset($_SESSION['traspaso_basicos']['idSistema']) or $_SESSION['traspaso_basicos']['idSistema']=='' ){              $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['traspaso_basicos']['idUsuario']) or $_SESSION['traspaso_basicos']['idUsuario']=='' ){              $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['traspaso_basicos']['Creacion_fecha']) or $_SESSION['traspaso_basicos']['Creacion_fecha']=='' ){    $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['traspaso_basicos']['idTipo']) or $_SESSION['traspaso_basicos']['idTipo']=='' ){                    $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al traspaso de bodega';
			}
			//productos
			if (isset($_SESSION['traspaso_productos'])){
				foreach ($_SESSION['traspaso_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un producto para traspaso a bodega';}
				}
			}else{
				$error['idProducto'] = 'error/No productos asignados a este traspaso';
			}
			

		// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['traspaso_basicos']['idDocumentos']) && $_SESSION['traspaso_basicos']['idDocumentos'] != ''){        $a  = "'".$_SESSION['traspaso_basicos']['idDocumentos']."'" ;       }else{$a  ="''";}
				if(isset($_SESSION['traspaso_basicos']['N_Doc']) && $_SESSION['traspaso_basicos']['N_Doc'] != ''){                      $a .= ",'".$_SESSION['traspaso_basicos']['N_Doc']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['idBodegaOrigen']) && $_SESSION['traspaso_basicos']['idBodegaOrigen'] != ''){    $a .= ",'".$_SESSION['traspaso_basicos']['idBodegaOrigen']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['idBodegaDestino']) && $_SESSION['traspaso_basicos']['idBodegaDestino'] != ''){  $a .= ",'".$_SESSION['traspaso_basicos']['idBodegaDestino']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['Observaciones']) && $_SESSION['traspaso_basicos']['Observaciones'] != ''){      $a .= ",'".$_SESSION['traspaso_basicos']['Observaciones']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['idSistema']) && $_SESSION['traspaso_basicos']['idSistema'] != ''){              $a .= ",'".$_SESSION['traspaso_basicos']['idSistema']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['idUsuario']) && $_SESSION['traspaso_basicos']['idUsuario'] != ''){              $a .= ",'".$_SESSION['traspaso_basicos']['idUsuario']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['idTipo']) && $_SESSION['traspaso_basicos']['idTipo'] != ''){                    $a .= ",'".$_SESSION['traspaso_basicos']['idTipo']."'" ;            }else{$a .= ",''";}
				if(isset($_SESSION['traspaso_basicos']['Creacion_fecha']) && $_SESSION['traspaso_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['traspaso_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".Fecha_mes_n($_SESSION['traspaso_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['traspaso_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, idBodegaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
	
						
			//Se guardan los datos de los productos			
				foreach ($_SESSION['traspaso_productos'] as $key => $producto){
				
				//Primero se realiza el egreso del producto
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                  $a  = "'".$ultimo_id."'" ;                                  }else{$a  = "''";}
					if(isset($_SESSION['traspaso_basicos']['idBodegaOrigen']) && $_SESSION['traspaso_basicos']['idBodegaOrigen'] != ''){  $a .= ",'".$_SESSION['traspaso_basicos']['idBodegaOrigen']."'" ; }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['idSistema']) && $_SESSION['traspaso_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['traspaso_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['idUsuario']) && $_SESSION['traspaso_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['traspaso_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['Creacion_fecha']) && $_SESSION['traspaso_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['traspaso_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['traspaso_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['traspaso_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['traspaso_basicos']['idDocumentos']) && $_SESSION['traspaso_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['traspaso_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['traspaso_basicos']['N_Doc']) && $_SESSION['traspaso_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['traspaso_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['idTipo']) && $_SESSION['traspaso_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['traspaso_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                  $a .= ",'".$producto['idProducto']."'" ;                        }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                          $a .= ",'".$producto['Number']."'" ;                            }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                $a .= ",'".$producto['ValorEgreso']."'" ;                       }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                  $a .= ",'".$producto['ValorTotal']."'" ;                        }else{$a .= ",''";}
					
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
				
				//luego se realiza el ingreso del producto
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                    $a  = "'".$ultimo_id."'" ;                                    }else{$a  = "''";}
					if(isset($_SESSION['traspaso_basicos']['idBodegaDestino']) && $_SESSION['traspaso_basicos']['idBodegaDestino'] != ''){  $a .= ",'".$_SESSION['traspaso_basicos']['idBodegaDestino']."'" ;  }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['idSistema']) && $_SESSION['traspaso_basicos']['idSistema'] != ''){              $a .= ",'".$_SESSION['traspaso_basicos']['idSistema']."'" ;        }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['idUsuario']) && $_SESSION['traspaso_basicos']['idUsuario'] != ''){              $a .= ",'".$_SESSION['traspaso_basicos']['idUsuario']."'" ;        }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['Creacion_fecha']) && $_SESSION['traspaso_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['traspaso_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['traspaso_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['traspaso_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['traspaso_basicos']['idDocumentos']) && $_SESSION['traspaso_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['traspaso_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['traspaso_basicos']['N_Doc']) && $_SESSION['traspaso_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['traspaso_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['traspaso_basicos']['idTipo']) && $_SESSION['traspaso_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['traspaso_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                  $a .= ",'".$producto['idProducto']."'" ;                        }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                          $a .= ",'".$producto['Number']."'" ;                            }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                $a .= ",'".$producto['ValorEgreso']."'" ;                       }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                  $a .= ",'".$producto['ValorTotal']."'" ;                        }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					
				}
			
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['traspaso_basicos']);
				unset($_SESSION['traspaso_productos']);
				unset($_SESSION['traspaso_temporal']);
			
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                                 TRANSFORMACION                                                  */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_transform':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['transform_basicos']);
				unset($_SESSION['transform_productos']);
				unset($_SESSION['transform_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){        $_SESSION['transform_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                      $_SESSION['transform_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                $_SESSION['transform_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){      $_SESSION['transform_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){              $_SESSION['transform_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){              $_SESSION['transform_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){    $_SESSION['transform_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                    $_SESSION['transform_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){    $_SESSION['transform_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){  $_SESSION['transform_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}

		break;
/*******************************************************************************************************************/		
		case 'modBase_transform':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['transform_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['transform_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['transform_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['transform_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['transform_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['transform_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['transform_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['transform_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['transform_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['transform_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['transform_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['transform_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['transform_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;			
/*******************************************************************************************************************/		
		case 'submit_trans1':
	
			//verificacion de errores
			if(!isset($idProducto) or $idProducto=='' ){     $error['idProducto']     = 'error/No ha seleccionado un producto';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
			
				header( 'Location: '.$location.'&trans2='.$idProducto );
				die;
				
			}	

		break;		
/*******************************************************************************************************************/		
		case 'transformar':

			if($maximo<$Cantidad){   $error['cantidad']   = 'error/No puede transformar mas cantidad de la que actualmente posee';}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			
				// Se trae un listado con productos del documento
				$arrRecetas = array();
				$query = "SELECT 
				productos_recetas.idProductoRel,
				productos_recetas.Cantidad,
				relacionados.ValorIngreso,
				base.ValorIngreso AS valorbase
				FROM `productos_recetas`
				LEFT JOIN `productos_listado` relacionados on relacionados.idProducto   = productos_recetas.idProductoRel
				LEFT JOIN `productos_listado` base         on base.idProducto           = productos_recetas.idProducto
				WHERE productos_recetas.idProducto = {$idProducto}";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrRecetas,$row );
				}
				//recorro los registros y agrego las salidas de materiales
				$totaluni = 0;
				$total = 0;
				foreach ($arrRecetas as $receta) {
					
					$_SESSION['transform_productos'][$receta['idProductoRel']]['idProducto'] = $receta['idProductoRel'];
					$_SESSION['transform_productos'][$receta['idProductoRel']]['prod_egreso'] = $receta['Cantidad'] * $Cantidad;
					$_SESSION['transform_productos'][$receta['idProductoRel']]['ValorEgreso'] = $receta['ValorIngreso'];
					$_SESSION['transform_productos'][$receta['idProductoRel']]['ValorTotal'] = $receta['ValorIngreso'] * $Cantidad;
					$totaluni = $totaluni + $receta['ValorIngreso'];
					$total = $total + $receta['ValorIngreso'] * $Cantidad;

				}

				$_SESSION['transform_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['transform_productos'][$idProducto]['prod_ingreso'] = $Cantidad;
				$_SESSION['transform_productos'][$idProducto]['ValorEgreso'] = $totaluni;
				$_SESSION['transform_productos'][$idProducto]['ValorTotal'] = $total;
			
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}		
		break;
/*******************************************************************************************************************/		
		case 'trans_clear_prod':

			//Borro todas las sesiones
			unset($_SESSION['transform_productos']);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'clear_all_transform':

			//Borro todas las sesiones
			unset($_SESSION['transform_basicos']);
			unset($_SESSION['transform_productos']);
			unset($_SESSION['transform_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'add_obs_transform':

			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['transform_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_transform':

			$_SESSION['transform_temporal'] = $_SESSION['transform_basicos']['Observaciones'];
			$_SESSION['transform_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'trans_bodega':
	

				
		//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['transform_basicos'])){
				if(!isset($_SESSION['transform_basicos']['idBodegaOrigen']) or $_SESSION['transform_basicos']['idBodegaOrigen']=='' ){    $error['idBodegaOrigen']   = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['transform_basicos']['idBodegaDestino']) or $_SESSION['transform_basicos']['idBodegaDestino']=='' ){  $error['idBodegaDestino']  = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['transform_basicos']['Observaciones']) or $_SESSION['transform_basicos']['Observaciones']=='' ){      $error['Observaciones']    = 'error/No seleccionado la maquina';}
				if(!isset($_SESSION['transform_basicos']['idSistema']) or $_SESSION['transform_basicos']['idSistema']=='' ){              $error['idSistema']        = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['transform_basicos']['idUsuario']) or $_SESSION['transform_basicos']['idUsuario']=='' ){              $error['idUsuario']        = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['transform_basicos']['Creacion_fecha']) or $_SESSION['transform_basicos']['Creacion_fecha']=='' ){    $error['Creacion_fecha']   = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['transform_basicos']['idTipo']) or $_SESSION['transform_basicos']['idTipo']=='' ){                    $error['idTipo']           = 'error/No ha seleccionado el tipo de trabajo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al traspaso de bodega';
			}
			//productos
			if (isset($_SESSION['transform_productos'])){
				foreach ($_SESSION['transform_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un producto para transformar';}
				}
			}else{
				$error['idProducto'] = 'error/No productos asignados a este traspaso';
			}
			

		// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['transform_basicos']['idDocumentos']) && $_SESSION['transform_basicos']['idDocumentos'] != ''){        $a  = "'".$_SESSION['transform_basicos']['idDocumentos']."'" ;       }else{$a  ="''";}
				if(isset($_SESSION['transform_basicos']['N_Doc']) && $_SESSION['transform_basicos']['N_Doc'] != ''){                      $a .= ",'".$_SESSION['transform_basicos']['N_Doc']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['idBodegaOrigen']) && $_SESSION['transform_basicos']['idBodegaOrigen'] != ''){    $a .= ",'".$_SESSION['transform_basicos']['idBodegaOrigen']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['idBodegaDestino']) && $_SESSION['transform_basicos']['idBodegaDestino'] != ''){  $a .= ",'".$_SESSION['transform_basicos']['idBodegaDestino']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['Observaciones']) && $_SESSION['transform_basicos']['Observaciones'] != ''){      $a .= ",'".$_SESSION['transform_basicos']['Observaciones']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['idSistema']) && $_SESSION['transform_basicos']['idSistema'] != ''){              $a .= ",'".$_SESSION['transform_basicos']['idSistema']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['idUsuario']) && $_SESSION['transform_basicos']['idUsuario'] != ''){              $a .= ",'".$_SESSION['transform_basicos']['idUsuario']."'" ;         }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['idTipo']) && $_SESSION['transform_basicos']['idTipo'] != ''){                    $a .= ",'".$_SESSION['transform_basicos']['idTipo']."'" ;            }else{$a .= ",''";}
				if(isset($_SESSION['transform_basicos']['Creacion_fecha']) && $_SESSION['transform_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['transform_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".Fecha_mes_n($_SESSION['transform_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['transform_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, idBodegaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
	
						
			//Se guardan los datos de los trabajadores			
				foreach ($_SESSION['transform_productos'] as $key => $producto){
				
				//Primero se realiza el egreso del producto
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                              $a  = "'".$ultimo_id."'" ;                                        }else{$a  = "''";}
					if(isset($_SESSION['transform_basicos']['idBodegaOrigen']) && $_SESSION['transform_basicos']['idBodegaOrigen'] != ''){  $a .= ",'".$_SESSION['transform_basicos']['idBodegaOrigen']."'" ; }else{$a .= ",''";}
					if(isset($_SESSION['transform_basicos']['idSistema']) && $_SESSION['transform_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['transform_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['transform_basicos']['idUsuario']) && $_SESSION['transform_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['transform_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['transform_basicos']['Creacion_fecha']) && $_SESSION['transform_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['transform_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['transform_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['transform_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['transform_basicos']['idDocumentos']) && $_SESSION['transform_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['transform_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['transform_basicos']['N_Doc']) && $_SESSION['transform_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['transform_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['transform_basicos']['idTipo']) && $_SESSION['transform_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['transform_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                    $a .= ",'".$producto['idProducto']."'" ;                         }else{$a .= ",''";}
					if(isset($producto['prod_ingreso']) && $producto['prod_ingreso'] != ''){                                                $a .= ",'".$producto['prod_ingreso']."'" ;                       }else{$a .= ",''";}
					if(isset($producto['prod_egreso']) && $producto['prod_egreso'] != ''){                                                  $a .= ",'".$producto['prod_egreso']."'" ;                        }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                  $a .= ",'".$producto['ValorEgreso']."'" ;                        }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                    $a .= ",'".$producto['ValorTotal']."'" ;                         }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing, Cantidad_eg, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);	
				}
				
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['transform_basicos']);
				unset($_SESSION['transform_productos']);
				unset($_SESSION['transform_temporal']);
			
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}	
	

		break;
/*******************************************************************************************************************/
/*                                                                                                                 */
/*                                        TRASPASO BODEGA  OTRA EMPRESA                                            */
/*                                                                                                                 */
/*******************************************************************************************************************/
/*******************************************************************************************************************/		
		case 'new_traspasoempresa':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}
			//Se verifica si el dato existe
			if(isset($idCliente)){
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM bodegas_facturacion WHERE idCliente='".$idCliente."' AND idDocumentos='".$idDocumentos."' AND N_Doc='".$N_Doc."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['idCliente'] = 'error/El Documento que esta tratando de ingresar ya fue ingresado';}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Condiciono la variable observaciones
				if(empty($Observaciones)){ $Observaciones="Sin observaciones";}
				
				//Borro todas las sesiones
				unset($_SESSION['traspasoempresa_basicos']);
				unset($_SESSION['traspasoempresa_productos']);
				unset($_SESSION['traspasoempresa_temporal']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['traspasoempresa_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['traspasoempresa_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['traspasoempresa_basicos']['idBodega'] = $idBodega;}
				if(isset($Observaciones) && $Observaciones != ''){         $_SESSION['traspasoempresa_basicos']['Observaciones'] = $Observaciones;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['traspasoempresa_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['traspasoempresa_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['traspasoempresa_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['traspasoempresa_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['traspasoempresa_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['traspasoempresa_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['traspasoempresa_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
				
			}
			
			
	
		break;
/*******************************************************************************************************************/		
		case 'clear_all_traspasoempresa':

			//Borro todas las sesiones
			unset($_SESSION['traspasoempresa_basicos']);
			unset($_SESSION['traspasoempresa_productos']);
			unset($_SESSION['traspasoempresa_temporal']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'modBase_traspasoempresa':

			//verificar si el subcomponente ya existe
			if(isset($idBodegaOrigen)&&$idBodegaOrigen!=''&&isset($idBodegaDestino)&&$idBodegaDestino!=''){
				if($idBodegaOrigen==$idBodegaDestino){
					$error['productos'] = 'error/La bodega de Origen y destino es la misma';
				}
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Borro todas las sesiones
				unset($_SESSION['traspasoempresa_temporal']);
				//Elimino los productos para eliminar brechas de seguridad
				unset($_SESSION['traspasoempresa_productos']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idDocumentos) && $idDocumentos != ''){           $_SESSION['traspasoempresa_basicos']['idDocumentos'] = $idDocumentos;}
				if(isset($N_Doc) && $N_Doc != ''){                         $_SESSION['traspasoempresa_basicos']['N_Doc'] = $N_Doc;}
				if(isset($idBodega) && $idBodega != ''){                   $_SESSION['traspasoempresa_basicos']['idBodega'] = $idBodega;}
				if(isset($idSistema) && $idSistema != ''){                 $_SESSION['traspasoempresa_basicos']['idSistema'] = $idSistema;}
				if(isset($idUsuario) && $idUsuario != ''){                 $_SESSION['traspasoempresa_basicos']['idUsuario'] = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){       $_SESSION['traspasoempresa_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo != ''){                       $_SESSION['traspasoempresa_basicos']['idTipo'] = $idTipo;}
				if(isset($idBodegaOrigen) && $idBodegaOrigen != ''){       $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'] = $idBodegaOrigen;}
				if(isset($idBodegaDestino) && $idBodegaDestino != ''){     $_SESSION['traspasoempresa_basicos']['idBodegaDestino'] = $idBodegaDestino;}
				if(isset($idSistemaDestino) && $idSistemaDestino != ''){   $_SESSION['traspasoempresa_basicos']['idSistemaDestino'] = $idSistemaDestino;}
				if(isset($idCliente) && $idCliente != ''){                 $_SESSION['traspasoempresa_basicos']['idCliente'] = $idCliente;}
				
				header( 'Location: '.$location.'&view=true' );
				die;
			
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'new_prod_traspasoempresa':

			//Traspaso la variable de bodega
			if(isset($_SESSION['traspasoempresa_basicos']['idBodegaOrigen'])&&$_SESSION['traspasoempresa_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['traspasoempresa_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			//verificar si el subcomponente ya existe
			if(isset($_SESSION['traspasoempresa_productos'][$idProducto])&&$_SESSION['traspasoempresa_productos'][$idProducto]>0){
				$error['productos'] = 'error/El producto que intenta agregar ya existe';
			}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['traspasoempresa_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['traspasoempresa_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['traspasoempresa_productos'][$idProducto]['ValorEgreso'] = $ValorEgreso;
				$_SESSION['traspasoempresa_productos'][$idProducto]['ValorTotal'] = $ValorEgreso*$Number;

				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}


		break;	
/*******************************************************************************************************************/		
		case 'edit_prod_traspasoempresa':
			
			//Traspaso la variable de bodega
			if(isset($_SESSION['traspasoempresa_basicos']['idBodegaOrigen'])&&$_SESSION['traspasoempresa_basicos']['idBodegaOrigen']!=''){
				$bodega = $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'];
			}else{
				$bodega = $_SESSION['traspasoempresa_basicos']['idBodega'];
			}
			
			// Se traen los totales de los productos
			$query = "SELECT 
			SUM(Cantidad_ing) AS ingreso, 
			SUM(Cantidad_eg) AS egreso
			FROM `bodegas_facturacion_existencias`
			WHERE idProducto = {$idProducto} AND idBodega={$bodega} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowResultado = mysqli_fetch_assoc ($resultado);
			//Sumo los egresos
			$Total_egresos = $rowResultado['egreso'] + $Number;
			$Total_existencias = $rowResultado['ingreso'] - $rowResultado['egreso'];
			//Verifico si los egresos son inferiores a los ingresos
			if($rowResultado['ingreso']<$Total_egresos){
				$error['productos'] = 'error/No hay suficientes existencias, solo quedan '.$Total_existencias;
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$_SESSION['traspasoempresa_productos'][$idProducto]['idProducto'] = $idProducto;
				$_SESSION['traspasoempresa_productos'][$idProducto]['Number'] = $Number;
				$_SESSION['traspasoempresa_productos'][$idProducto]['ValorEgreso'] = $ValorEgreso;
				$_SESSION['traspasoempresa_productos'][$idProducto]['ValorTotal'] = $ValorEgreso*$Number;
				
				header( 'Location: '.$location.'&view=true' );
				die;	
			}

		break;
/*******************************************************************************************************************/		
		case 'del_prod_traspasoempresa':

			//Borro todas las sesiones
			unset($_SESSION['traspasoempresa_productos'][$_GET['del_prod']]);
			
			header( 'Location: '.$location.'&view=true' );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'add_obs_traspasoempresa':

			$Observacion      = $_GET['val_select'];
			
			//valido que no esten vacios
			if(empty($Observacion)){  $error['Observacion']  = 'error/No ha ingresado una observacion';}

			if ( empty($error) ) {
				//Datos a actualizar
				$_SESSION['traspasoempresa_basicos']['Observaciones'] = $Observacion;

				header( 'Location: '.$location.'&view=true#Ancla_obs' );
				die;
			}
		
		break;		
/*******************************************************************************************************************/		
		case 'del_obs_traspasoempresa':

			$_SESSION['traspasoempresa_temporal'] = $_SESSION['traspasoempresa_basicos']['Observaciones'];
			$_SESSION['traspasoempresa_basicos']['Observaciones'] = '';
			
			header( 'Location: '.$location.'&view=true#Ancla_obs' );
			die;

		break;
/*******************************************************************************************************************/		
		case 'traspaso_otra_empresa':
		
		//verificacion de errores
			//Datos basicos
			if (isset($_SESSION['traspasoempresa_basicos'])){
				if(!isset($_SESSION['traspasoempresa_basicos']['idBodegaOrigen']) or $_SESSION['traspasoempresa_basicos']['idBodegaOrigen']=='' ){      $error['idBodegaOrigen']    = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['traspasoempresa_basicos']['idBodegaDestino']) or $_SESSION['traspasoempresa_basicos']['idBodegaDestino']=='' ){    $error['idBodegaDestino']   = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['traspasoempresa_basicos']['idSistemaDestino']) or $_SESSION['traspasoempresa_basicos']['idSistemaDestino']=='' ){  $error['idSistemaDestino']  = 'error/No seleccionado la linea';}
				if(!isset($_SESSION['traspasoempresa_basicos']['Observaciones']) or $_SESSION['traspasoempresa_basicos']['Observaciones']=='' ){        $error['Observaciones']     = 'error/No seleccionado la maquina';}
				if(!isset($_SESSION['traspasoempresa_basicos']['idSistema']) or $_SESSION['traspasoempresa_basicos']['idSistema']=='' ){                $error['idSistema']         = 'error/No ha ingresado el id del usuario';}
				if(!isset($_SESSION['traspasoempresa_basicos']['idUsuario']) or $_SESSION['traspasoempresa_basicos']['idUsuario']=='' ){                $error['idUsuario']         = 'error/No ha ingresado el id del estado';}
				if(!isset($_SESSION['traspasoempresa_basicos']['Creacion_fecha']) or $_SESSION['traspasoempresa_basicos']['Creacion_fecha']=='' ){      $error['Creacion_fecha']    = 'error/No ha seleccionado la prioridad';}
				if(!isset($_SESSION['traspasoempresa_basicos']['idTipo']) or $_SESSION['traspasoempresa_basicos']['idTipo']=='' ){                      $error['idTipo']            = 'error/No ha seleccionado el tipo de trabajo';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al traspaso de bodega';
			}
			//productos
			if (isset($_SESSION['traspasoempresa_productos'])){
				foreach ($_SESSION['traspasoempresa_productos'] as $key => $producto){
					if(!isset($producto['idProducto']) or $producto['idProducto'] == ''){  $error['idProducto']   = 'error/No ha ingresado un producto para traspaso a bodega';}
				}
			}else{
				$error['idProducto'] = 'error/No productos asignados a este traspaso';
			}
			

		// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
			//Se guardan los datos basicos
				if(isset($_SESSION['traspasoempresa_basicos']['idDocumentos']) && $_SESSION['traspasoempresa_basicos']['idDocumentos'] != ''){          $a  = "'".$_SESSION['traspasoempresa_basicos']['idDocumentos']."'" ;        }else{$a  ="''";}
				if(isset($_SESSION['traspasoempresa_basicos']['N_Doc']) && $_SESSION['traspasoempresa_basicos']['N_Doc'] != ''){                        $a .= ",'".$_SESSION['traspasoempresa_basicos']['N_Doc']."'" ;              }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['idBodegaOrigen']) && $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'] != ''){      $a .= ",'".$_SESSION['traspasoempresa_basicos']['idBodegaOrigen']."'" ;     }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['idBodegaDestino']) && $_SESSION['traspasoempresa_basicos']['idBodegaDestino'] != ''){    $a .= ",'".$_SESSION['traspasoempresa_basicos']['idBodegaDestino']."'" ;    }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['idSistemaDestino']) && $_SESSION['traspasoempresa_basicos']['idSistemaDestino'] != ''){  $a .= ",'".$_SESSION['traspasoempresa_basicos']['idSistemaDestino']."'" ;   }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['Observaciones']) && $_SESSION['traspasoempresa_basicos']['Observaciones'] != ''){        $a .= ",'".$_SESSION['traspasoempresa_basicos']['Observaciones']."'" ;      }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['idSistema']) && $_SESSION['traspasoempresa_basicos']['idSistema'] != ''){                $a .= ",'".$_SESSION['traspasoempresa_basicos']['idSistema']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['idUsuario']) && $_SESSION['traspasoempresa_basicos']['idUsuario'] != ''){                $a .= ",'".$_SESSION['traspasoempresa_basicos']['idUsuario']."'" ;          }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['idTipo']) && $_SESSION['traspasoempresa_basicos']['idTipo'] != ''){                      $a .= ",'".$_SESSION['traspasoempresa_basicos']['idTipo']."'" ;             }else{$a .= ",''";}
				if(isset($_SESSION['traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['traspasoempresa_basicos']['Creacion_fecha'] != ''){  
					$a .= ",'".$_SESSION['traspasoempresa_basicos']['Creacion_fecha']."'" ;  
					$a .= ",'".Fecha_mes_n($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])."'" ;
					$a .= ",'".Fecha_año($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `bodegas_facturacion` (idDocumentos,N_Doc, idBodegaOrigen, idBodegaDestino, idSistemaDestino, Observaciones, idSistema, idUsuario, idTipo, Creacion_fecha, Creacion_mes, Creacion_ano) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
	
						
			//Se guardan los datos de los trabajadores			
				foreach ($_SESSION['traspasoempresa_productos'] as $key => $producto){
				
				//Primero se realiza el egreso del producto
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                                          $a  = "'".$ultimo_id."'" ;                                              }else{$a  = "''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idBodegaOrigen']) && $_SESSION['traspasoempresa_basicos']['idBodegaOrigen'] != ''){  $a .= ",'".$_SESSION['traspasoempresa_basicos']['idBodegaOrigen']."'" ; }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idSistema']) && $_SESSION['traspasoempresa_basicos']['idSistema'] != ''){            $a .= ",'".$_SESSION['traspasoempresa_basicos']['idSistema']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idUsuario']) && $_SESSION['traspasoempresa_basicos']['idUsuario'] != ''){            $a .= ",'".$_SESSION['traspasoempresa_basicos']['idUsuario']."'" ;      }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['traspasoempresa_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['traspasoempresa_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['traspasoempresa_basicos']['idDocumentos']) && $_SESSION['traspasoempresa_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['traspasoempresa_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['N_Doc']) && $_SESSION['traspasoempresa_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['traspasoempresa_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idTipo']) && $_SESSION['traspasoempresa_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['traspasoempresa_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                $a .= ",'".$producto['idProducto']."'" ;                               }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                                        $a .= ",'".$producto['Number']."'" ;                                   }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                              $a .= ",'".$producto['ValorEgreso']."'" ;                              }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                $a .= ",'".$producto['ValorTotal']."'" ;                               }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_eg, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
				
				//luego se realiza el ingreso del producto
					//filtros
					if(isset($ultimo_id) && $ultimo_id != ''){                                                                                                $a  = "'".$ultimo_id."'" ;                                                 }else{$a  = "''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idBodegaDestino']) && $_SESSION['traspasoempresa_basicos']['idBodegaDestino'] != ''){      $a .= ",'".$_SESSION['traspasoempresa_basicos']['idBodegaDestino']."'" ;   }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idSistemaDestino']) && $_SESSION['traspasoempresa_basicos']['idSistemaDestino'] != ''){    $a .= ",'".$_SESSION['traspasoempresa_basicos']['idSistemaDestino']."'" ;  }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idUsuario']) && $_SESSION['traspasoempresa_basicos']['idUsuario'] != ''){                  $a .= ",'".$_SESSION['traspasoempresa_basicos']['idUsuario']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['traspasoempresa_basicos']['Creacion_fecha'] != ''){  
						$a .= ",'".$_SESSION['traspasoempresa_basicos']['Creacion_fecha']."'" ;  
						$a .= ",'".Fecha_mes_n($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])."'" ;
						$a .= ",'".Fecha_año($_SESSION['traspasoempresa_basicos']['Creacion_fecha'])."'" ;
					}else{
						$a .= ",''";
						$a .= ",''";
						$a .= ",''";
					}
					if(isset($_SESSION['traspasoempresa_basicos']['idDocumentos']) && $_SESSION['traspasoempresa_basicos']['idDocumentos'] != ''){      $a .= ",'".$_SESSION['traspasoempresa_basicos']['idDocumentos']."'" ;  }else{$a .=",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['N_Doc']) && $_SESSION['traspasoempresa_basicos']['N_Doc'] != ''){                    $a .= ",'".$_SESSION['traspasoempresa_basicos']['N_Doc']."'" ;         }else{$a .= ",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['idTipo']) && $_SESSION['traspasoempresa_basicos']['idTipo'] != ''){                  $a .= ",'".$_SESSION['traspasoempresa_basicos']['idTipo']."'" ;        }else{$a .= ",''";}
					if(isset($producto['idProducto']) && $producto['idProducto'] != ''){                                                                $a .= ",'".$producto['idProducto']."'" ;                               }else{$a .= ",''";}
					if(isset($producto['Number']) && $producto['Number'] != ''){                                                                        $a .= ",'".$producto['Number']."'" ;                                   }else{$a .= ",''";}
					if(isset($producto['ValorEgreso']) && $producto['ValorEgreso'] != ''){                                                              $a .= ",'".$producto['ValorEgreso']."'" ;                              }else{$a .= ",''";}
					if(isset($producto['ValorTotal']) && $producto['ValorTotal'] != ''){                                                                $a .= ",'".$producto['ValorTotal']."'" ;                               }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `bodegas_facturacion_existencias` (idFacturacion, idBodega, idSistema, idUsuario, Creacion_fecha, Creacion_mes, Creacion_ano, idDocumentos, N_Doc, idTipo, idProducto, Cantidad_ing, Valor, ValorTotal) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					
				}
				
				//Busco los usuarios que posean el permiso a la bodega
				$Direccionbase = "bodegas_stock.php";
				$Notificacion  = '<div class="btn-group" ><a href="view_doc.php?view='.$ultimo_id.'" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a></div>';
				$Notificacion .= 'Se ha realizado un traspaso de materiales desde otra empresa';
				$Estado = '1';
				
				$arrPermiso = array();
				$query = "SELECT usuarios_permisos.idUsuario
				FROM usuarios_permisos 
				INNER JOIN core_permisos         ON core_permisos.idAdmpm        = usuarios_permisos.idAdmpm 
				INNER JOIN usuarios_listado      ON usuarios_listado.idUsuario   = usuarios_permisos.idUsuario 
				WHERE core_permisos.Direccionbase = '".$Direccionbase."' 
				AND usuarios_listado.idSistema = '{$_SESSION['traspasoempresa_basicos']['idSistemaDestino']}'";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrPermiso,$row );
				}

				//Inserto el mensaje de entrega de materiales
				foreach($arrPermiso as $permiso) {
					if(isset($_SESSION['traspasoempresa_basicos']['idSistemaDestino']) && $_SESSION['traspasoempresa_basicos']['idSistemaDestino'] != ''){   $a  = "'".$_SESSION['traspasoempresa_basicos']['idSistemaDestino']."'" ;   }else{$a  ="''";}
					if(isset($permiso['idUsuario']) && $permiso['idUsuario'] != ''){                                                                         $a .= ",'".$permiso['idUsuario']."'" ;                                     }else{$a .=",''";}
					if(isset($Notificacion) && $Notificacion != ''){                                                                                         $a .= ",'".$Notificacion."'" ;                                             }else{$a .=",''";}
					if(isset($_SESSION['traspasoempresa_basicos']['Creacion_fecha']) && $_SESSION['traspasoempresa_basicos']['Creacion_fecha'] != ''){       $a .= ",'".$_SESSION['traspasoempresa_basicos']['Creacion_fecha']."'" ;    }else{$a .=",''";}
					if(isset($Estado) && $Estado != ''){                                                                                                     $a .= ",'".$Estado."'" ;                                                   }else{$a .=",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `notificaciones_ver` (idSistema,idUsuario,Notificacion, Fecha, idEstado) VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
				}
			
				//Borro todas las sesiones una vez grabados los datos
				unset($_SESSION['traspasoempresa_basicos']);
				unset($_SESSION['traspasoempresa_productos']);
				unset($_SESSION['traspasoempresa_temporal']);
			
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}	
	

		break;	
		
/*******************************************************************************************************************/		
		case 'pago':	

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idFacturacion='".$idFacturacion."'" ;
				if(isset($idDocPago) && $idDocPago != ''){    $a .= ",idDocPago='".$idDocPago."'" ;}
				if(isset($N_DocPago) && $N_DocPago != ''){    $a .= ",N_DocPago='".$N_DocPago."'" ;}
				if(isset($F_Pago) && $F_Pago != ''){  
					$a .= ",F_Pago='".$F_Pago."'" ;
					$a .= ",F_Pago_dia='".dia_transformado($F_Pago)."'" ;
					$a .= ",F_Pago_mes='".Fecha_mes_n($F_Pago)."'" ;
					$a .= ",F_Pago_ano='".Fecha_año($F_Pago)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($MontoPagado) && $MontoPagado != ''){   $a .= ",MontoPagado='".$MontoPagado."'" ;}
				$a .= ",idEstado='2'" ;
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `bodegas_facturacion` SET ".$a." WHERE idFacturacion = '$idFacturacion'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}

		break;	
/*******************************************************************************************************************/
	}
?>
