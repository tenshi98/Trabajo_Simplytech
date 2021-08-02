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
	if ( !empty($_POST['idAnalisisAgua']) )            $idAnalisisAgua             = $_POST['idAnalisisAgua'];
	if ( !empty($_POST['idSistema']) )                 $idSistema                  = $_POST['idSistema'];
	if ( !empty($_POST['f_muestra']) )                 $f_muestra                  = $_POST['f_muestra'];
	if ( !empty($_POST['f_recibida']) )                $f_recibida                 = $_POST['f_recibida'];
	if ( !empty($_POST['codigoProceso']) )             $codigoProceso              = $_POST['codigoProceso'];
	if ( !empty($_POST['codigoArchivo']) )             $codigoArchivo              = $_POST['codigoArchivo'];
	if ( !empty($_POST['codigoServicio']) )            $codigoServicio             = $_POST['codigoServicio'];
	if ( !empty($_POST['idSector']) )                  $idSector                   = $_POST['idSector'];
	if ( !empty($_POST['UTM_norte']) )                 $UTM_norte                  = $_POST['UTM_norte'];
	if ( !empty($_POST['UTM_este']) )                  $UTM_este                   = $_POST['UTM_este'];
	if ( !empty($_POST['codigoMuestra']) )             $codigoMuestra              = $_POST['codigoMuestra'];
	if ( !empty($_POST['idPuntoMuestreo']) )           $idPuntoMuestreo            = $_POST['idPuntoMuestreo'];
	if ( !empty($_POST['idTipoMuestra']) )             $idTipoMuestra              = $_POST['idTipoMuestra'];
	if ( !empty($_POST['RemuestraFecha']) )            $RemuestraFecha             = $_POST['RemuestraFecha'];
	if ( !empty($_POST['Remuestra_codigo_muestra']) )  $Remuestra_codigo_muestra   = $_POST['Remuestra_codigo_muestra'];
	if ( !empty($_POST['idParametros']) )              $idParametros               = $_POST['idParametros'];
	if ( !empty($_POST['idSigno']) )                   $idSigno                    = $_POST['idSigno'];
	if ( isset($_POST['valorAnalisis']) )              $valorAnalisis              = $_POST['valorAnalisis'];
	if ( !empty($_POST['idLaboratorio']) )             $idLaboratorio              = $_POST['idLaboratorio'];
	if ( !empty($_POST['CodigoLaboratorio']) )         $CodigoLaboratorio          = $_POST['CodigoLaboratorio'];
	if ( !empty($_POST['idEstado']) )                  $idEstado                   = $_POST['idEstado'];
	if ( !empty($_POST['idCliente']) )                 $idCliente                  = $_POST['idCliente'];
	if ( !empty($_POST['Observaciones']) )             $Observaciones              = $_POST['Observaciones'];
	if ( !empty($_POST['idOpciones']) )                $idOpciones                 = $_POST['idOpciones'];
	
	if ( !empty($_POST['idSector_fake2']) )            $idSector                   = $_POST['idSector_fake2'];
	if ( !empty($_POST['UTM_norte_fake2']) )           $UTM_norte                  = $_POST['UTM_norte_fake2'];
	if ( !empty($_POST['UTM_este_fake2']) )            $UTM_este                   = $_POST['UTM_este_fake2'];
	if ( !empty($_POST['idPuntoMuestreo_fake2']) )     $idPuntoMuestreo            = $_POST['idPuntoMuestreo_fake2'];
	
	
	
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
			case 'idAnalisisAgua':            if(empty($idAnalisisAgua)){             $error['idAnalisisAgua']             = 'error/No ha ingresado el id';}break;
			case 'idSistema':                 if(empty($idSistema)){                  $error['idSistema']                  = 'error/No ha seleccionado el sistema';}break;
			case 'f_muestra':                 if(empty($f_muestra)){                  $error['f_muestra']                  = 'error/No ha ingresado la fecha de la muestra';}break;
			case 'f_recibida':                if(empty($f_recibida)){                 $error['f_recibida']                 = 'error/No ha ingresado la fecha de recepcion de la muestra';}break;
			case 'codigoProceso':             if(empty($codigoProceso)){              $error['codigoProceso']              = 'error/No ha ingresado el codigo Proceso';}break;
			case 'codigoArchivo':             if(empty($codigoArchivo)){              $error['codigoArchivo']              = 'error/No ha ingresado el codigo Archivo';}break;
			case 'codigoServicio':            if(empty($codigoServicio)){             $error['codigoServicio']             = 'error/No ha ingresado el codigo Servicio';}break;
			case 'idSector':                  if(empty($idSector)){                   $error['idSector']                   = 'error/No ha seleccionado el Sector';}break;
			case 'UTM_norte':                 if(empty($UTM_norte)){                  $error['UTM_norte']                  = 'error/No ha ingresado la UTM norte';}break;
			case 'UTM_este':                  if(empty($UTM_este)){                   $error['UTM_este']                   = 'error/No ha ingresado la UTM este';}break;
			case 'codigoMuestra':             if(empty($codigoMuestra)){              $error['codigoMuestra']              = 'error/No ha ingresado el codigo Muestra';}break;
			case 'idPuntoMuestreo':           if(empty($idPuntoMuestreo)){            $error['idPuntoMuestreo']            = 'error/No ha seleccionado el Punto Muestreo';}break;
			case 'idTipoMuestra':             if(empty($idTipoMuestra)){              $error['idTipoMuestra']              = 'error/No ha seleccionado el Tipo Muestra';}break;
			case 'RemuestraFecha':            if(empty($RemuestraFecha)){             $error['RemuestraFecha']             = 'error/No ha ingresado la fecha de la remuestra';}break;
			case 'Remuestra_codigo_muestra':  if(empty($Remuestra_codigo_muestra)){   $error['Remuestra_codigo_muestra']   = 'error/No ha ingresado el codigo de la remuestra';}break;
			case 'idParametros':              if(empty($idParametros)){               $error['idParametros']               = 'error/No ha seleccionado el Parametros';}break;
			case 'idSigno':                   if(empty($idSigno)){                    $error['idSigno']                    = 'error/No ha seleccionado el Signo';}break;
			case 'valorAnalisis':             if(!isset($valorAnalisis)){             $error['valorAnalisis']              = 'error/No ha ingresado el valor de Analisis';}break;
			case 'idLaboratorio':             if(empty($idLaboratorio)){              $error['idLaboratorio']              = 'error/No ha seleccionado el Laboratorio';}break;
			case 'CodigoLaboratorio':         if(empty($CodigoLaboratorio)){          $error['CodigoLaboratorio']          = 'error/No ha ingresado el Codigo de Laboratorio';}break;
			case 'idEstado':                  if(empty($idEstado)){                   $error['idEstado']                   = 'error/No ha seleccionado el Estado';}break;
			case 'idCliente':                 if(empty($idCliente)){                  $error['idCliente']                  = 'error/No ha seleccionado el Cliente';}break;
			case 'Observaciones':             if(empty($Observaciones)){              $error['Observaciones']              = 'error/No ha ingresado las Observaciones';}break;
			case 'idOpciones':                if(empty($idOpciones)){                 $error['idOpciones']                 = 'error/No ha seleccionado las Opciones';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($CodigoLaboratorio)&&contar_palabras_censuradas($CodigoLaboratorio)!=0){  $error['CodigoLaboratorio'] = 'error/Edita Codigo Laboratorio, contiene palabras no permitidas'; }	
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){          $error['Observaciones']     = 'error/Edita Observaciones, contiene palabras no permitidas'; }	

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/******************************************/
			if(isset($idSistema) && $idSistema != ''){
				//Consulto el ultimo codigoMuestra
				$rowMuestra = db_select_data (false, 'codigoMuestra', 'analisis_aguas', '', 'idSistema = "'.$idSistema.'" ORDER BY codigoMuestra DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					
				//Verifico la existencia
				if(isset($rowMuestra['codigoMuestra'])&&$rowMuestra['codigoMuestra']!=''){
					$codigoMuestra = $rowMuestra['codigoMuestra'] + 1;
				}else{
					$codigoMuestra = 1;
				}
			}else{
				$error['idSistema'] = 'error/No ha seleccionado el sistema';
			}
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                                 $a  = "'".$idSistema."'" ;                   }else{$a  ="''";}
				if(isset($f_muestra) && $f_muestra != ''){                                 $a .= ",'".$f_muestra."'" ;                  }else{$a .=",''";}
				if(isset($f_recibida) && $f_recibida != ''){                               $a .= ",'".$f_recibida."'" ;                 }else{$a .=",''";}
				if(isset($codigoProceso) && $codigoProceso != ''){                         $a .= ",'".$codigoProceso."'" ;              }else{$a .=",''";}
				if(isset($codigoArchivo) && $codigoArchivo != ''){                         $a .= ",'".$codigoArchivo."'" ;              }else{$a .=",''";}
				if(isset($codigoServicio) && $codigoServicio != ''){                       $a .= ",'".$codigoServicio."'" ;             }else{$a .=",''";}
				if(isset($idSector) && $idSector != ''){                                   $a .= ",'".$idSector."'" ;                   }else{$a .=",''";}
				if(isset($UTM_norte) && $UTM_norte != ''){                                 $a .= ",'".$UTM_norte."'" ;                  }else{$a .=",''";}
				if(isset($UTM_este) && $UTM_este != ''){                                   $a .= ",'".$UTM_este."'" ;                   }else{$a .=",''";}
				if(isset($codigoMuestra) && $codigoMuestra != ''){                         $a .= ",'".$codigoMuestra."'" ;              }else{$a .=",''";}
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo != ''){                     $a .= ",'".$idPuntoMuestreo."'" ;            }else{$a .=",''";}
				if(isset($idTipoMuestra) && $idTipoMuestra != ''){                         $a .= ",'".$idTipoMuestra."'" ;              }else{$a .=",''";}
				if(isset($RemuestraFecha) && $RemuestraFecha != ''){                       $a .= ",'".$RemuestraFecha."'" ;             }else{$a .=",''";}
				if(isset($Remuestra_codigo_muestra) && $Remuestra_codigo_muestra != ''){   $a .= ",'".$Remuestra_codigo_muestra."'" ;   }else{$a .=",''";}
				if(isset($idParametros) && $idParametros != ''){                           $a .= ",'".$idParametros."'" ;               }else{$a .=",''";}
				if(isset($idSigno) && $idSigno != ''){                                     $a .= ",'".$idSigno."'" ;                    }else{$a .=",''";}
				if(isset($valorAnalisis) && $valorAnalisis != ''){                         $a .= ",'".$valorAnalisis."'" ;              }else{$a .=",''";}
				if(isset($idLaboratorio) && $idLaboratorio != ''){                         $a .= ",'".$idLaboratorio."'" ;              }else{$a .=",''";}
				if(isset($CodigoLaboratorio) && $CodigoLaboratorio != ''){                 $a .= ",'".$CodigoLaboratorio."'" ;          }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                                   $a .= ",'".$idEstado."'" ;                   }else{$a .=",''";}
				if(isset($idCliente) && $idCliente != ''){                                 $a .= ",'".$idCliente."'" ;                  }else{$a .=",''";}
				if(isset($Observaciones) && $Observaciones != ''){                         $a .= ",'".$Observaciones."'" ;              }else{$a .=",''";}
				if(isset($idOpciones) && $idOpciones != ''){                               $a .= ",'".$idOpciones."'" ;                 }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `aguas_analisis_aguas` (idSistema, f_muestra, f_recibida, 
				codigoProceso, codigoArchivo, codigoServicio, idSector, UTM_norte, UTM_este,
				codigoMuestra, idPuntoMuestreo, idTipoMuestra, RemuestraFecha, Remuestra_codigo_muestra,
				idParametros, idSigno, valorAnalisis, idLaboratorio, CodigoLaboratorio, idEstado,
				idCliente, Observaciones, idOpciones) 
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
				//Filtros
				$a = "idAnalisisAgua='".$idAnalisisAgua."'" ;
				if(isset($idSistema) && $idSistema != ''){                                 $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($f_muestra) && $f_muestra != ''){                                 $a .= ",f_muestra='".$f_muestra."'" ;}
				if(isset($f_recibida) && $f_recibida != ''){                               $a .= ",f_recibida='".$f_recibida."'" ;}
				if(isset($codigoProceso) && $codigoProceso != ''){                         $a .= ",codigoProceso='".$codigoProceso."'" ;}
				if(isset($codigoArchivo) && $codigoArchivo != ''){                         $a .= ",codigoArchivo='".$codigoArchivo."'" ;}
				if(isset($codigoServicio) && $codigoServicio != ''){                       $a .= ",codigoServicio='".$codigoServicio."'" ;}
				if(isset($idSector) && $idSector != ''){                                   $a .= ",idSector='".$idSector."'" ;}
				if(isset($UTM_norte) && $UTM_norte != ''){                                 $a .= ",UTM_norte='".$UTM_norte."'" ;}
				if(isset($UTM_este) && $UTM_este != ''){                                   $a .= ",UTM_este='".$UTM_este."'" ;}
				if(isset($codigoMuestra) && $codigoMuestra != ''){                         $a .= ",codigoMuestra='".$codigoMuestra."'" ;}
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo != ''){                     $a .= ",idPuntoMuestreo='".$idPuntoMuestreo."'" ;}
				if(isset($idTipoMuestra) && $idTipoMuestra != ''){                         $a .= ",idTipoMuestra='".$idTipoMuestra."'" ;}
				if(isset($RemuestraFecha) && $RemuestraFecha != ''){                       $a .= ",RemuestraFecha='".$RemuestraFecha."'" ;}
				if(isset($Remuestra_codigo_muestra) && $Remuestra_codigo_muestra != ''){   $a .= ",Remuestra_codigo_muestra='".$Remuestra_codigo_muestra."'" ;}
				if(isset($idParametros) && $idParametros != ''){                           $a .= ",idParametros='".$idParametros."'" ;}
				if(isset($idSigno) && $idSigno != ''){                                     $a .= ",idSigno='".$idSigno."'" ;}
				if(isset($valorAnalisis) && $valorAnalisis != ''){                         $a .= ",valorAnalisis='".$valorAnalisis."'" ;}
				if(isset($idLaboratorio) && $idLaboratorio != ''){                         $a .= ",idLaboratorio='".$idLaboratorio."'" ;}
				if(isset($CodigoLaboratorio) && $CodigoLaboratorio != ''){                 $a .= ",CodigoLaboratorio='".$CodigoLaboratorio."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                   $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idCliente) && $idCliente != ''){                                 $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){                         $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($idOpciones) && $idOpciones != ''){                               $a .= ",idOpciones='".$idOpciones."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'aguas_analisis_aguas', 'idAnalisisAgua = "'.$idAnalisisAgua.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'aguas_analisis_aguas', 'idAnalisisAgua = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
