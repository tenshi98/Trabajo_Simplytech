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
	if ( !empty($_POST['idCarga']) )            $idCarga             = $_POST['idCarga'];
	if ( !empty($_POST['idSistema']) )          $idSistema           = $_POST['idSistema'];
	if ( !empty($_POST['idTelemetria']) )       $idTelemetria        = $_POST['idTelemetria'];
	if ( !empty($_POST['idUsuario']) )          $idUsuario           = $_POST['idUsuario'];
	if ( !empty($_POST['FechaCarga']) )         $FechaCarga          = $_POST['FechaCarga'];
	if ( !empty($_POST['FechaVencimiento']) )   $FechaVencimiento    = $_POST['FechaVencimiento'];
	if ( !empty($_POST['idDocPago']) )          $idDocPago           = $_POST['idDocPago'];
	if ( !empty($_POST['N_DocPago']) )          $N_DocPago           = $_POST['N_DocPago'];
	if ( !empty($_POST['Monto']) )              $Monto               = $_POST['Monto'];
	
	
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
			case 'idCarga':          if(empty($idCarga)){           $error['idCarga']           = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){         $error['idSistema']         = 'error/No ha seleccionado el equipo de telemetria';}break;
			case 'idTelemetria':     if(empty($idTelemetria)){      $error['idTelemetria']      = 'error/No ha seleccionado el equipo de telemetria';}break;
			case 'idUsuario':        if(empty($idUsuario)){         $error['idUsuario']         = 'error/No ha seleccionado el usuario';}break;
			case 'FechaCarga':       if(empty($FechaCarga)){        $error['FechaCarga']        = 'error/No ha ingresado la fecha de carga';}break;
			case 'FechaVencimiento': if(empty($FechaVencimiento)){  $error['FechaVencimiento']  = 'error/No ha ingresado la fecha de vencimiento';}break;
			case 'idDocPago':        if(empty($idDocPago)){         $error['idDocPago']         = 'error/No ha ingresado la fecha de vencimiento';}break;
			case 'N_DocPago':        if(empty($N_DocPago)){         $error['N_DocPago']         = 'error/No ha ingresado la fecha de vencimiento';}break;
			case 'Monto':            if(empty($Monto)){             $error['Monto']             = 'error/No ha ingresado el Monto';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Numero de semana
				$Ano     = fecha2Ano($FechaVencimiento);
				$Mes     = fecha2NMes($FechaVencimiento);
				$Semana  = fecha2NSemana($FechaVencimiento);
				$Dia     = fecha2NDiaSemana($FechaVencimiento);
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                   $a = "'".$idSistema."'" ;            }else{$a ="''";}
				if(isset($idTelemetria) && $idTelemetria != ''){             $a .= ",'".$idTelemetria."'" ;       }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){                   $a .= ",'".$idUsuario."'" ;          }else{$a .= ",''";}
				if(isset($FechaCarga) && $FechaCarga != ''){                 $a .= ",'".$FechaCarga."'" ;         }else{$a .= ",''";}
				if(isset($FechaVencimiento) && $FechaVencimiento != ''){     $a .= ",'".$FechaVencimiento."'" ;   }else{$a .= ",''";}
				if(isset($Ano) && $Ano != ''){                               $a .= ",'".$Ano."'" ;                }else{$a .= ",''";}
				if(isset($Mes) && $Mes != ''){                               $a .= ",'".$Mes."'" ;                }else{$a .= ",''";}
				if(isset($Semana) && $Semana != ''){                         $a .= ",'".$Semana."'" ;             }else{$a .= ",''";}
				if(isset($Dia) && $Dia != ''){                               $a .= ",'".$Dia."'" ;                }else{$a .= ",''";}
				if(isset($idDocPago) && $idDocPago != ''){                   $a .= ",'".$idDocPago."'" ;          }else{$a .= ",''";}
				if(isset($N_DocPago) && $N_DocPago != ''){                   $a .= ",'".$N_DocPago."'" ;          }else{$a .= ",''";}
				if(isset($Monto) && $Monto != ''){                           $a .= ",'".$Monto."'" ;              }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_carga_bam` (idSistema, idTelemetria, idUsuario, FechaCarga, 
				FechaVencimiento, Ano, Mes, Semana, Dia, idDocPago, N_DocPago, Monto) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
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
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Numero de semana
				$Ano     = fecha2Ano($FechaVencimiento);
				$Mes     = fecha2NMes($FechaVencimiento);
				$Semana  = fecha2NSemana($FechaVencimiento);
				$Dia     = fecha2NDiaSemana($FechaVencimiento);
				
				//Filtros
				$a = "idCarga='".$idCarga."'" ;
				if(isset($idSistema) && $idSistema != ''){                   $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTelemetria) && $idTelemetria != ''){             $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){                   $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($FechaCarga) && $FechaCarga != ''){                 $a .= ",FechaCarga='".$FechaCarga."'" ;}
				if(isset($FechaVencimiento) && $FechaVencimiento != ''){     $a .= ",FechaVencimiento='".$FechaVencimiento."'" ;}
				if(isset($Ano) && $Ano != ''){                               $a .= ",Ano='".$Ano."'" ;}
				if(isset($Mes) && $Mes != ''){                               $a .= ",Mes='".$Mes."'" ;}
				if(isset($Semana) && $Semana != ''){                         $a .= ",Semana='".$Semana."'" ;}
				if(isset($Dia) && $Dia != ''){                               $a .= ",Dia='".$Dia."'" ;}
				if(isset($idDocPago) && $idDocPago != ''){                   $a .= ",idDocPago='".$idDocPago."'" ;}
				if(isset($N_DocPago) && $N_DocPago != ''){                   $a .= ",N_DocPago='".$N_DocPago."'" ;}
				if(isset($Monto) && $Monto != ''){                           $a .= ",Monto='".$Monto."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'telemetria_carga_bam', 'idCarga = "'.$idCarga.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
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
				$resultado = db_delete_data (false, 'telemetria_carga_bam', 'idCarga = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
