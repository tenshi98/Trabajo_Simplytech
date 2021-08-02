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
	if ( !empty($_POST['idContrato']) )    $idContrato    = $_POST['idContrato'];
	if ( !empty($_POST['idTelemetria']) )  $idTelemetria  = $_POST['idTelemetria'];
	if ( !empty($_POST['Codigo']) )        $Codigo        = $_POST['Codigo'];
	if ( !empty($_POST['F_Inicio']) )      $F_Inicio      = $_POST['F_Inicio'];
	if ( !empty($_POST['F_Termino']) )     $F_Termino     = $_POST['F_Termino'];
	
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
			case 'idContrato':     if(empty($idContrato)){    $error['idContrato']     = 'error/No ha ingresado el id';}break;
			case 'idTelemetria':   if(empty($idTelemetria)){  $error['idTelemetria']   = 'error/No ha seleccionado el equipo telemetria';}break;
			case 'Codigo':         if(empty($Codigo)){        $error['Codigo']         = 'error/No ha ingresado el Codigo';}break;
			case 'F_Inicio':       if(empty($F_Inicio)){      $error['F_Inicio']       = 'error/No ha ingresado la fecha de inicio';}break;
			case 'F_Termino':      if(empty($F_Termino)){     $error['F_Termino']      = 'error/No ha ingresado la fecha de termino';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Codigo)&&contar_palabras_censuradas($Codigo)!=0){  $error['Codigo'] = 'error/Edita Codigo, contiene palabras no permitidas'; }	

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
			if(isset($Codigo)){
				$ndata_1 = db_select_nrows (false, 'Codigo', 'telemetria_listado_contratos', '', "Codigo='".$Codigo."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Codigo ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/***********************************************************/
				//Inserto el nuevo contrato
				if(isset($idTelemetria) && $idTelemetria != ''){  $a  = "'".$idTelemetria."'" ;   }else{$a  ="''";}
				if(isset($Codigo) && $Codigo != ''){              $a .= ",'".$Codigo."'" ;        }else{$a .=",''";}
				if(isset($F_Inicio) && $F_Inicio != ''){          $a .= ",'".$F_Inicio."'" ;      }else{$a .=",''";}
				if(isset($F_Termino) && $F_Termino != ''){        $a .= ",'".$F_Termino."'" ;     }else{$a .=",''";}
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado_contratos` (idTelemetria, Codigo, F_Inicio, F_Termino) 
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
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					/***********************************************************/
					//Actualizo la tabla de telemetria relacionado
					$a = "idTelemetria='".$idTelemetria."'" ;
					if(isset($ultimo_id) && $ultimo_id != ''){    $a .= ",idContrato='".$ultimo_id."'" ;}
					if(isset($Codigo) && $Codigo != ''){          $a .= ",Codigo='".$Codigo."'" ;}
					if(isset($F_Inicio) && $F_Inicio != ''){      $a .= ",F_Inicio='".$F_Inicio."'" ;}
					if(isset($F_Termino) && $F_Termino != ''){    $a .= ",F_Termino='".$F_Termino."'" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$idTelemetria'";
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
			if(isset($Codigo)&&isset($idContrato)){
				$ndata_1 = db_select_nrows (false, 'Codigo', 'telemetria_listado_contratos', '', "Codigo='".$Codigo."' AND idContrato!='".$idContrato."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Codigo ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/***********************************************************/
				//Actualizo el contrato
				$a = "idContrato='".$idContrato."'" ;
				if(isset($idTelemetria) && $idTelemetria != ''){    $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($Codigo) && $Codigo != ''){                $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($F_Inicio) && $F_Inicio != ''){            $a .= ",F_Inicio='".$F_Inicio."'" ;}
				if(isset($F_Termino) && $F_Termino != ''){          $a .= ",F_Termino='".$F_Termino."'" ;}
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado_contratos` SET ".$a." WHERE idContrato = '$idContrato'";
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
				
				/***********************************************************/
				//Actualizo la tabla de telemetria relacionado
				$a = "idTelemetria='".$idTelemetria."'" ;
				if(isset($idContrato) && $idContrato != ''){  $a .= ",idContrato='".$idContrato."'" ;}
				if(isset($Codigo) && $Codigo != ''){          $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($F_Inicio) && $F_Inicio != ''){      $a .= ",F_Inicio='".$F_Inicio."'" ;}
				if(isset($F_Termino) && $F_Termino != ''){    $a .= ",F_Termino='".$F_Termino."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idTelemetria = '$idTelemetria'";
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
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				

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
				/***********************************************************/
				//se borran los datos
				$resultado = db_delete_data (false, 'telemetria_listado_contratos', 'idContrato = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/***********************************************************/
				//Actualizo la tabla de telemetria relacionado
				$a = "idTelemetria='".$idTelemetria."'" ;
				$a .= ",idContrato=''" ;
				$a .= ",Codigo=''" ;
				$a .= ",F_Inicio=''" ;
				$a .= ",F_Termino=''" ;
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_listado` SET ".$a." WHERE idContrato = ".$indice;
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
							
				header( 'Location: '.$location.'&deleted=true' );
				die;
				
			}else{
				//se valida hackeo
				require_once '0_hacking_1.php';
			}
			

		break;				
/*******************************************************************************************************************/
	}
?>
