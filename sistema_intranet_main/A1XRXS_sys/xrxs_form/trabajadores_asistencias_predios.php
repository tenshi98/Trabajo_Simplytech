<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridClientead                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
//require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idAsistencia']) )   $idAsistencia  = $_POST['idAsistencia'];
	if ( !empty($_POST['idSistema']) )      $idSistema 	   = $_POST['idSistema'];
	if ( !empty($_POST['idTrabajador']) )   $idTrabajador  = $_POST['idTrabajador'];
	if ( !empty($_POST['Fecha']) )          $Fecha         = $_POST['Fecha'];
	if ( !empty($_POST['Hora']) )           $Hora          = $_POST['Hora'];
	if ( !empty($_POST['TimeStamp']) )      $TimeStamp     = $_POST['TimeStamp'];
	if ( !empty($_POST['IP_Client']) )      $IP_Client     = $_POST['IP_Client'];
	if ( !empty($_POST['Latitud']) )        $Latitud       = $_POST['Latitud'];
	if ( !empty($_POST['Longitud']) )       $Longitud      = $_POST['Longitud'];		
	if ( !empty($_POST['idPredio']) )       $idPredio 	   = $_POST['idPredio'];
	if ( !empty($_POST['idZona']) )         $idZona        = $_POST['idZona'];
	if ( !empty($_POST['idEstado']) )       $idEstado      = $_POST['idEstado'];
				
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
			case 'idAsistencia':  if(empty($idAsistencia)){  $error['idAsistencia']  = 'error/No ha ingresado el ID';}break;	
			case 'idSistema':     if(empty($idSistema)){     $error['idSistema']     = 'error/No ha Seleccionado el Sistema';}break;	
			case 'idTrabajador':  if(empty($idTrabajador)){  $error['idTrabajador']  = 'error/No ha Seleccionado el Trabajador';}break;	
			case 'Fecha':         if(empty($Fecha)){         $error['Fecha']         = 'error/No ha ingresado la Fecha';}break;
			case 'Hora':          if(empty($Hora)){          $error['Hora']          = 'error/No ha ingresado la Hora';}break;
			case 'TimeStamp':     if(empty($TimeStamp)){     $error['TimeStamp']     = 'error/No ha ingresado el TimeStamp';}break;
			case 'IP_Client':     if(empty($IP_Client)){     $error['IP_Client']     = 'error/No ha ingresado la IP Cliente';}break;
			case 'Latitud':       if(empty($Latitud)){       $error['Latitud']       = 'error/No ha ingresado la Latitud';}break;
			case 'Longitud':      if(empty($Longitud)){      $error['Longitud']      = 'error/No ha ingresado la Longitud';}break;
			case 'idPredio':      if(empty($idPredio)){      $error['idPredio']      = 'error/No ha Seleccionado el Predio';}break;	
			case 'idZona':        if(empty($idZona)){        $error['idZona']        = 'error/No ha Seleccionado el cuartel';}break;
			case 'idEstado':      if(empty($idEstado)){      $error['idEstado']      = 'error/No ha Seleccionado el tipo de acceso';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($Rut)&&!validarRut($Rut)){    $error['Rut']  = 'error/El Rut ingresado no es valido'; }
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'new_registro': 
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($Fecha)&&isset($idEstado)){
				$ndata_1 = db_select_nrows (false, 'idAsistencia', 'trabajadores_asistencias_predios', '', "idTrabajador='".$idTrabajador."' AND Fecha='".$Fecha."' AND idEstado='".$idEstado."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}		
			//generacion de errores
			if($ndata_1>0) {  $error['ndata_1'] = 'error/Este trabajador ya tiene registrado su Ingreso-Egreso, favor revisar';}
			/*******************************************************************/
			
			//si no hay errores
			if ( empty($error) ) {
				
				//variables
				$TimeStamp  = $Fecha.' '.$Hora;
				
				/**************************************************************/
				//Inserto la fecha con el ingreso
				if(isset($idSistema) && $idSistema != ''){        $a  = "'".$idSistema."'" ;        }else{$a  = "''";}
				if(isset($idTrabajador) && $idTrabajador != ''){  $a .= ",'".$idTrabajador."'" ;    }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",'".$Fecha."'" ;           }else{$a .= ",''";}
				if(isset($Hora) && $Hora != ''){                  $a .= ",'".$Hora."'" ;            }else{$a .= ",''";}
				if(isset($TimeStamp) && $TimeStamp != ''){        $a .= ",'".$TimeStamp."'" ;       }else{$a .= ",''";}
				if(isset($IP_Client) && $IP_Client != ''){        $a .= ",'".$IP_Client."'" ;       }else{$a .= ",''";}
				if(isset($Latitud) && $Latitud != ''){            $a .= ",'".$Latitud."'" ;         }else{$a .= ",''";}
				if(isset($Longitud) && $Longitud != ''){          $a .= ",'".$Longitud."'" ;        }else{$a .= ",''";}
				if(isset($idZona) && $idZona != ''){              $a .= ",'".$idZona."'" ;          }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){          $a .= ",'".$idEstado."'" ;        }else{$a .= ",''";}
										
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_asistencias_predios` (idSistema,idTrabajador,Fecha,Hora,TimeStamp,
				IP_Client,Latitud,Longitud,idZona,idEstado) 
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
		case 'update_registro':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTrabajador)&&isset($Fecha)&&isset($idEstado)&&isset($idAsistencia)){
				$ndata_1 = db_select_nrows (false, 'idAsistencia', 'trabajadores_asistencias_predios', '', "idTrabajador='".$idTrabajador."' AND Fecha='".$Fecha."' AND idEstado='".$idEstado."' AND idAsistencia!='".$idAsistencia."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}		
			//generacion de errores
			if($ndata_1>0) {  $error['ndata_1'] = 'error/Este trabajador ya tiene registrado su Ingreso-Egreso, favor revisar';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//variables
				$TimeStamp  = $Fecha.' '.$Hora;
				
				//Filtros
				$a = "idAsistencia='".$idAsistencia."'" ;
				if(isset($idSistema) && $idSistema != ''){        $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTrabajador) && $idTrabajador != ''){  $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Hora) && $Hora != ''){                  $a .= ",Hora='".$Hora."'" ;}
				if(isset($TimeStamp) && $TimeStamp != ''){        $a .= ",TimeStamp='".$TimeStamp."'" ;}
				if(isset($IP_Client) && $IP_Client != ''){        $a .= ",IP_Client='".$IP_Client."'" ;}
				if(isset($Latitud) && $Latitud != ''){            $a .= ",Latitud='".$Latitud."'" ;}
				if(isset($Longitud) && $Longitud != ''){          $a .= ",Longitud='".$Longitud."'" ;}
				if(isset($idZona) && $idZona != ''){              $a .= ",idZona='".$idZona."'" ;}
				if(isset($idEstado) && $idEstado != ''){          $a .= ",idEstado='".$idEstado."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'trabajadores_asistencias_predios', 'idAsistencia = "'.$idAsistencia.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}
		
	
		break;	
							
/*******************************************************************************************************************/
		case 'del_registro':	
			
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
				$resultado = db_delete_data (false, 'trabajadores_asistencias_predios', 'idAsistencia = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
