<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-018).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idIPC']) )          $idIPC          = $_POST['idIPC'];
	if ( !empty($_POST['idSistema']) )      $idSistema      = $_POST['idSistema'];
	if ( !empty($_POST['idMes']) )          $idMes          = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )            $Ano            = $_POST['Ano'];
	if ( isset($_POST['UTM']) )             $UTM            = $_POST['UTM'];
	if ( isset($_POST['UTA']) )             $UTA            = $_POST['UTA'];
	if ( isset($_POST['ValorPuntos']) )     $ValorPuntos    = $_POST['ValorPuntos'];
	if ( isset($_POST['Mensual']) )         $Mensual        = $_POST['Mensual'];
	if ( isset($_POST['Acumulado']) )       $Acumulado      = $_POST['Acumulado'];
	if ( isset($_POST['DoceMeses']) )       $DoceMeses      = $_POST['DoceMeses'];
	
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
			case 'idIPC':         if(empty($idIPC)){         $error['idIPC']        = 'error/No ha ingresado el id';}break;
			case 'idSistema':     if(empty($idSistema)){     $error['idSistema']    = 'error/No ha seleccionado el sistema';}break;
			case 'idMes':         if(empty($idMes)){         $error['idMes']        = 'error/No ha seleccionado el Mes';}break;
			case 'Ano':           if(empty($Ano)){           $error['Ano']          = 'error/No ha seleccionado el Ano';}break;
			case 'UTM':           if(!isset($UTM)){          $error['UTM']          = 'error/No ha ingresado el UTM';}break;
			case 'UTA':           if(!isset($UTA)){          $error['UTA']          = 'error/No ha ingresado el UTA';}break;
			case 'ValorPuntos':   if(!isset($ValorPuntos)){  $error['ValorPuntos']  = 'error/No ha ingresado el Valor Puntos';}break;
			case 'Mensual':       if(!isset($Mensual)){      $error['Mensual']      = 'error/No ha ingresado el Mensual';}break;
			case 'Acumulado':     if(!isset($Acumulado)){    $error['Acumulado']    = 'error/No ha ingresado el Acumulado';}break;
			case 'DoceMeses':     if(!isset($DoceMeses)){    $error['DoceMeses']    = 'error/No ha ingresado el Doce Meses';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/	
	if(isset($Ano) && $Ano != ''){                  $Ano         = EstandarizarInput($Ano); }
	if(isset($UTM) && $UTM != ''){                  $UTM         = EstandarizarInput($UTM); }
	if(isset($UTA) && $UTA != ''){                  $UTA         = EstandarizarInput($UTA); }
	if(isset($ValorPuntos) && $ValorPuntos != ''){  $ValorPuntos = EstandarizarInput($ValorPuntos); }
	if(isset($Mensual) && $Mensual != ''){          $Mensual     = EstandarizarInput($Mensual); }
	if(isset($Acumulado) && $Acumulado != ''){      $Acumulado   = EstandarizarInput($Acumulado); }
	if(isset($DoceMeses) && $DoceMeses != ''){      $DoceMeses   = EstandarizarInput($DoceMeses); }
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idMes)&&isset($Ano)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'idMes', 'aguas_mediciones_ipc', '', "idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){      $SIS_data  = "'".$idSistema."'" ;       }else{$SIS_data  = "''";}
				if(isset($idMes) && $idMes != ''){              $SIS_data .= ",'".$idMes."'" ;          }else{$SIS_data .= ",''";}
				if(isset($Ano) && $Ano != ''){                  $SIS_data .= ",'".$Ano."'" ;            }else{$SIS_data .= ",''";}
				if(isset($UTM) && $UTM != ''){                  $SIS_data .= ",'".$UTM."'" ;            }else{$SIS_data .= ",''";}
				if(isset($UTA) && $UTA != ''){                  $SIS_data .= ",'".$UTA."'" ;            }else{$SIS_data .= ",''";}
				if(isset($ValorPuntos) && $ValorPuntos != ''){  $SIS_data .= ",'".$ValorPuntos."'" ;    }else{$SIS_data .= ",''";}
				if(isset($Mensual) && $Mensual != ''){          $SIS_data .= ",'".$Mensual."'" ;        }else{$SIS_data .= ",''";}
				if(isset($Acumulado) && $Acumulado != ''){      $SIS_data .= ",'".$Acumulado."'" ;      }else{$SIS_data .= ",''";}
				if(isset($DoceMeses) && $DoceMeses != ''){      $SIS_data .= ",'".$DoceMeses."'" ;      }else{$SIS_data .= ",''";}
				
				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idMes, Ano, UTM, UTA, ValorPuntos, Mensual, Acumulado, DoceMeses';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_ipc', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){
					
					//redirijo
					header( 'Location: '.$location.'&created=true' );
					die;
					
				}
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idMes)&&isset($Ano)&&isset($idSistema)&&isset($idIPC)){
				$ndata_1 = db_select_nrows (false, 'idMes', 'aguas_mediciones_ipc', '', "idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$idSistema."' AND idIPC!='".$idIPC."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$SIS_data = "idIPC='".$idIPC."'" ;
				if(isset($idSistema) && $idSistema != ''){       $SIS_data .= ",idSistema='".$idSistema."'" ;}
				if(isset($idMes) && $idMes != ''){               $SIS_data .= ",idMes='".$idMes."'" ;}
				if(isset($Ano) && $Ano != ''){                   $SIS_data .= ",Ano='".$Ano."'" ;}
				if(isset($UTM) && $UTM != ''){                   $SIS_data .= ",UTM='".$UTM."'" ;}
				if(isset($UTA) && $UTA != ''){                   $SIS_data .= ",UTA='".$UTA."'" ;}
				if(isset($ValorPuntos) && $ValorPuntos != ''){   $SIS_data .= ",ValorPuntos='".$ValorPuntos."'" ;}
				if(isset($Mensual) && $Mensual != ''){           $SIS_data .= ",Mensual='".$Mensual."'" ;}
				if(isset($Acumulado) && $Acumulado != ''){       $SIS_data .= ",Acumulado='".$Acumulado."'" ;}
				if(isset($DoceMeses) && $DoceMeses != ''){       $SIS_data .= ",DoceMeses='".$DoceMeses."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_ipc', 'idIPC = "'.$idIPC.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}
		
	
		break;	
							
/*******************************************************************************************************************/
		case 'del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del']) OR !validaEntero($_GET['del']))&&$_GET['del']!=''){
				$indice = simpleDecode($_GET['del'], fecha_actual());
			}else{
				$indice = $_GET['del'];
				//guardo el log
				php_error_log($_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo, '', 'Indice no codificado', '' );
				
			}
			
			//se verifica si es un numero lo que se recibe
			if (!validarNumero($indice)&&$indice!=''){ 
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){ 
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opcion DEL  no es un numero entero';
				$errorn++;
			}
			
			if($errorn==0){
				//se borran los datos
				$resultado = db_delete_data (false, 'aguas_mediciones_ipc', 'idIPC = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//redirijo
					header( 'Location: '.$location.'&deleted=true' );
					die;
					
				}
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			
			
			

		break;							
					
/*******************************************************************************************************************/
	}
?>
