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
	if ( !empty($_POST['idAnalisisAgua']) )            $idAnalisisAgua            = $_POST['idAnalisisAgua'];
	if ( !empty($_POST['idSistema']) )                 $idSistema                 = $_POST['idSistema'];
	if ( !empty($_POST['f_muestra']) )                 $f_muestra                 = $_POST['f_muestra'];
	if ( !empty($_POST['f_recibida']) )                $f_recibida                = $_POST['f_recibida'];
	if ( !empty($_POST['codigoProceso']) )             $codigoProceso             = $_POST['codigoProceso'];
	if ( !empty($_POST['codigoArchivo']) )             $codigoArchivo             = $_POST['codigoArchivo'];
	if ( !empty($_POST['codigoServicio']) )            $codigoServicio            = $_POST['codigoServicio'];
	if ( !empty($_POST['idSector']) )                  $idSector                  = $_POST['idSector'];
	if ( !empty($_POST['UTM_norte']) )                 $UTM_norte                 = $_POST['UTM_norte'];
	if ( !empty($_POST['UTM_este']) )                  $UTM_este                  = $_POST['UTM_este'];
	if ( !empty($_POST['codigoMuestra']) )             $codigoMuestra             = $_POST['codigoMuestra'];
	if ( !empty($_POST['idPuntoMuestreo']) )           $idPuntoMuestreo           = $_POST['idPuntoMuestreo'];
	if ( !empty($_POST['idTipoMuestra']) )             $idTipoMuestra             = $_POST['idTipoMuestra'];
	if ( !empty($_POST['RemuestraFecha']) )            $RemuestraFecha            = $_POST['RemuestraFecha'];
	if ( !empty($_POST['Remuestra_codigo_muestra']) )  $Remuestra_codigo_muestra  = $_POST['Remuestra_codigo_muestra'];
	if ( !empty($_POST['idParametros']) )              $idParametros              = $_POST['idParametros'];
	if ( !empty($_POST['idSigno']) )                   $idSigno                   = $_POST['idSigno'];
	if ( isset($_POST['valorAnalisis']) )              $valorAnalisis             = $_POST['valorAnalisis'];
	if ( !empty($_POST['idLaboratorio']) )             $idLaboratorio             = $_POST['idLaboratorio'];
	if ( !empty($_POST['idEstado']) )                  $idEstado                  = $_POST['idEstado'];
	if ( !empty($_POST['idCliente']) )                 $idCliente                 = $_POST['idCliente'];
	if ( !empty($_POST['Observaciones']) )             $Observaciones             = $_POST['Observaciones'];
	if ( !empty($_POST['idOpciones']) )                $idOpciones                = $_POST['idOpciones'];
	if ( !empty($_POST['idSector_fake2']) )            $idSector             = $_POST['idSector_fake2'];
	if ( !empty($_POST['UTM_norte_fake2']) )           $UTM_norte            = $_POST['UTM_norte_fake2'];
	if ( !empty($_POST['UTM_este_fake2']) )            $UTM_este             = $_POST['UTM_este_fake2'];
	if ( !empty($_POST['idPuntoMuestreo_fake2']) )     $idPuntoMuestreo      = $_POST['idPuntoMuestreo_fake2'];
	if ( !empty($_POST['CodigoLaboratorio']) )         $CodigoLaboratorio         = $_POST['CodigoLaboratorio'];
	

		
					
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
			case 'idAnalisisAgua':            if(empty($idAnalisisAgua)){             $error['idAnalisisAgua']             = 'error/No ha ingresado el id';}break;
			case 'idSistema':                 if(empty($idSistema)){                  $error['idSistema']                  = 'error/No ha seleccionado el sistema';}break;
			case 'f_muestra':                 if(empty($f_muestra)){                  $error['f_muestra']                  = 'error/No ha ingresado la fecha de muestra';}break;
			case 'f_recibida':                if(empty($f_recibida)){                 $error['f_recibida']                 = 'error/No ha ingresado la fecha de recepcion';}break;
			case 'codigoProceso':             if(empty($codigoProceso)){              $error['codigoProceso']              = 'error/No ha ingresado el codigo de proceso';}break;
			case 'codigoArchivo':             if(empty($codigoArchivo)){              $error['codigoArchivo']              = 'error/No ha ingresado el codigo del archivo';}break;
			case 'codigoServicio':            if(empty($codigoServicio)){             $error['codigoServicio']             = 'error/No ha ingresado el codigo del servicio';}break;
			case 'idSector':                  if(empty($idSector)){                   $error['idSector']                   = 'error/No ha seleccionado el sector';}break;
			case 'UTM_norte':                 if(empty($UTM_norte)){                  $error['UTM_norte']                  = 'error/No ha ingresado la UTM norte';}break;
			case 'UTM_este':                  if(empty($UTM_este)){                   $error['UTM_este']                   = 'error/No ha ingresado la UTM este';}break;
			case 'codigoMuestra':             if(empty($codigoMuestra)){              $error['codigoMuestra']              = 'error/No ha ingresado el codigo de muestra';}break;
			case 'idPuntoMuestreo':           if(empty($idPuntoMuestreo)){            $error['idPuntoMuestreo']            = 'error/No ha ingresado el punto de muestreo';}break;
			case 'idTipoMuestra':             if(empty($idTipoMuestra)){              $error['idTipoMuestra']              = 'error/No ha ingresado el tipo de muestra';}break;
			case 'RemuestraFecha':            if(empty($RemuestraFecha)){             $error['RemuestraFecha']             = 'error/No ha ingresado la remuestra';}break;
			case 'Remuestra_codigo_muestra':  if(empty($Remuestra_codigo_muestra)){   $error['Remuestra_codigo_muestra']   = 'error/No ha ingresado el codigo de remuestra';}break;
			case 'idParametros':              if(empty($idParametros)){               $error['idParametros']               = 'error/No ha seleccionado el parametro';}break;
			case 'idSigno':                   if(empty($idSigno)){                    $error['idSigno']                    = 'error/No ha seleccionado el signo';}break;
			case 'valorAnalisis':             if(empty($valorAnalisis)){              $error['valorAnalisis']              = 'error/No ha ingresado el valor del analisis';}break;
			case 'idLaboratorio':             if(empty($idLaboratorio)){              $error['idLaboratorio']              = 'error/No ha seleccionado el laboratorio';}break;
			case 'idEstado':                  if(empty($idEstado)){                   $error['idEstado']                   = 'error/No ha seleccionado el estado';}break;
			case 'idCliente':                 if(empty($idCliente)){                  $error['idCliente']                  = 'error/No ha seleccionado el cliente';}break;
			case 'Observaciones':             if(empty($Observaciones)){              $error['Observaciones']              = 'error/No ha ingresado la observacion';}break;
			case 'idOpciones':                if(empty($idOpciones)){                 $error['idOpciones']                 = 'error/No ha seleccionado la opcion';}break;
			case 'CodigoLaboratorio':         if(empty($CodigoLaboratorio)){          $error['CodigoLaboratorio']          = 'error/No ha ingresado el codigo de laboratorio';}break;
			
		
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			// Se traen el ultimo registro
			$query = "SELECT codigoMuestra FROM `analisis_aguas` ORDER BY `codigoMuestra` DESC LIMIT 1";
			$resultado = mysqli_query ($dbConn, $query);
			$rowMuestra = mysqli_fetch_assoc ($resultado);
			$codigoMuestra = $rowMuestra['codigoMuestra'] + 1;
			
			if($codigoMuestra==1) {$error['idTipoBoton'] = 'error/La muestra ya existe en el sistema';}
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				

				//filtros
				if(isset($idSistema) && $idSistema != ''){                                $a = "'".$idSistema."'" ;                      }else{$a ="''";}
				if(isset($f_muestra) && $f_muestra != ''){                                $a .= ",'".$f_muestra."'" ;                    }else{$a .= ",''";}
				if(isset($f_recibida) && $f_recibida != ''){                              $a .= ",'".$f_recibida."'" ;                   }else{$a .= ",''";}
				if(isset($codigoProceso) && $codigoProceso != ''){                        $a .= ",'".$codigoProceso."'" ;                }else{$a .= ",''";}
				if(isset($codigoArchivo) && $codigoArchivo != ''){                        $a .= ",'".$codigoArchivo."'" ;                }else{$a .= ",''";}
				if(isset($codigoServicio) && $codigoServicio != ''){                      $a .= ",'".$codigoServicio."'" ;               }else{$a .= ",''";}
				if(isset($idSector) && $idSector != ''){                                  $a .= ",'".$idSector."'" ;                     }else{$a .= ",''";}
				if(isset($UTM_norte) && $UTM_norte != ''){                                $a .= ",'".$UTM_norte."'" ;                    }else{$a .= ",''";}
				if(isset($UTM_este) && $UTM_este != ''){                                  $a .= ",'".$UTM_este."'" ;                     }else{$a .= ",''";}
				if(isset($codigoMuestra) && $codigoMuestra != ''){                        $a .= ",'".$codigoMuestra."'" ;                }else{$a .= ",''";}
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo != ''){                    $a .= ",'".$idPuntoMuestreo."'" ;              }else{$a .= ",''";}
				if(isset($idTipoMuestra) && $idTipoMuestra != ''){                        $a .= ",'".$idTipoMuestra."'" ;                }else{$a .= ",''";}
				if(isset($RemuestraFecha) && $RemuestraFecha != ''){                      $a .= ",'".$RemuestraFecha."'" ;               }else{$a .= ",''";}
				if(isset($Remuestra_codigo_muestra) && $Remuestra_codigo_muestra != ''){  $a .= ",'".$Remuestra_codigo_muestra."'" ;     }else{$a .= ",''";}
				if(isset($idParametros) && $idParametros != ''){                          $a .= ",'".$idParametros."'" ;                 }else{$a .= ",''";}
				if(isset($idSigno) && $idSigno != ''){                                    $a .= ",'".$idSigno."'" ;                      }else{$a .= ",''";}
				if(isset($valorAnalisis) && $valorAnalisis != ''){                        $a .= ",'".$valorAnalisis."'" ;                }else{$a .= ",''";}
				if(isset($idLaboratorio) && $idLaboratorio != ''){                        $a .= ",'".$idLaboratorio."'" ;                }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                                  $a .= ",'".$idEstado."'" ;                     }else{$a .= ",''";}
				if(isset($idCliente) && $idCliente != ''){                                $a .= ",'".$idCliente."'" ;                    }else{$a .= ",''";}
				if(isset($Observaciones) && $Observaciones != ''){                        $a .= ",'".$Observaciones."'" ;                }else{$a .= ",''";}
				if(isset($idOpciones) && $idOpciones != ''){                              $a .= ",'".$idOpciones."'" ;                   }else{$a .= ",''";}
				if(isset($CodigoLaboratorio) && $CodigoLaboratorio != ''){                $a .= ",'".$CodigoLaboratorio."'" ;            }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `analisis_aguas` (idSistema, f_muestra, f_recibida, codigoProceso, codigoArchivo, codigoServicio, idSector, UTM_norte, UTM_este,
				codigoMuestra, idPuntoMuestreo, idTipoMuestra, RemuestraFecha, Remuestra_codigo_muestra, idParametros, idSigno, valorAnalisis, idLaboratorio,
				idEstado, idCliente, Observaciones, idOpciones, CodigoLaboratorio) 
				VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idAnalisisAgua='".$idAnalisisAgua."'" ;
				if(isset($idSistema) && $idSistema != ''){                                    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($f_muestra) && $f_muestra != ''){                                    $a .= ",f_muestra='".$f_muestra."'" ;}
				if(isset($f_recibida) && $f_recibida != ''){                                  $a .= ",f_recibida='".$f_recibida."'" ;}
				if(isset($codigoProceso) && $codigoProceso != ''){                            $a .= ",codigoProceso='".$codigoProceso."'" ;}
				if(isset($codigoArchivo) && $codigoArchivo != ''){                            $a .= ",codigoArchivo='".$codigoArchivo."'" ;}
				if(isset($codigoServicio) && $codigoServicio != ''){                          $a .= ",codigoServicio='".$codigoServicio."'" ;}
				if(isset($idSector) && $idSector != ''){                                      $a .= ",idSector='".$idSector."'" ;}
				if(isset($UTM_norte) && $UTM_norte != ''){                                    $a .= ",UTM_norte='".$UTM_norte."'" ;}
				if(isset($UTM_este) && $UTM_este != ''){                                      $a .= ",UTM_este='".$UTM_este."'" ;}
				if(isset($codigoMuestra) && $codigoMuestra != ''){                            $a .= ",codigoMuestra='".$codigoMuestra."'" ;}
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo != ''){                        $a .= ",idPuntoMuestreo='".$idPuntoMuestreo."'" ;}
				if(isset($idTipoMuestra) && $idTipoMuestra != ''){                            $a .= ",idTipoMuestra='".$idTipoMuestra."'" ;}
				if(isset($RemuestraFecha) && $RemuestraFecha != ''){                          $a .= ",RemuestraFecha='".$RemuestraFecha."'" ;}
				if(isset($Remuestra_codigo_muestra) && $Remuestra_codigo_muestra != ''){      $a .= ",Remuestra_codigo_muestra='".$Remuestra_codigo_muestra."'" ;}
				if(isset($idParametros) && $idParametros != ''){                              $a .= ",idParametros='".$idParametros."'" ;}
				if(isset($idSigno) && $idSigno != ''){                                        $a .= ",idSigno='".$idSigno."'" ;}
				if(isset($valorAnalisis) && $valorAnalisis != ''){                            $a .= ",valorAnalisis='".$valorAnalisis."'" ;}
				if(isset($idLaboratorio) && $idLaboratorio != ''){                            $a .= ",idLaboratorio='".$idLaboratorio."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                      $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idCliente) && $idCliente != ''){                                    $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){                            $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($idOpciones) && $idOpciones != ''){                                  $a .= ",idOpciones='".$idOpciones."'" ;}
				if(isset($CodigoLaboratorio) && $CodigoLaboratorio != ''){                    $a .= ",CodigoLaboratorio='".$CodigoLaboratorio."'" ;}
				
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `analisis_aguas` SET ".$a." WHERE idAnalisisAgua = '$idAnalisisAgua'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			
			}
		
		break;	
					
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `analisis_aguas` WHERE idAnalisisAgua = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
						
/*******************************************************************************************************************/
	}
?>
