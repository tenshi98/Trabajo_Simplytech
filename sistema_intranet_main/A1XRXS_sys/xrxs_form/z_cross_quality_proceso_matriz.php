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

	if ( !empty($_POST['idMatriz']) )             $idMatriz              = $_POST['idMatriz'];
	if ( !empty($_POST['idSistema']) )            $idSistema             = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )             $idEstado              = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )               $Nombre                = $_POST['Nombre'];
	if ( !empty($_POST['cantPuntos']) )           $cantPuntos            = $_POST['cantPuntos'];
	if ( !empty($_POST['idTipo']) )               $idTipo                = $_POST['idTipo'];
	if ( !empty($_POST['mod']) )                  $mod                   = $_POST['mod'];
	if ( !empty($_POST['PuntoNombre']) )          $PuntoNombre           = $_POST['PuntoNombre'];
	if ( !empty($_POST['PuntoidTipo']) )          $PuntoidTipo           = $_POST['PuntoidTipo'];
	if ( !empty($_POST['PuntoMedAceptable']) )    $PuntoMedAceptable     = $_POST['PuntoMedAceptable'];
	if ( !empty($_POST['PuntoMedAlerta']) )       $PuntoMedAlerta        = $_POST['PuntoMedAlerta'];
	if ( !empty($_POST['PuntoMedCondenatorio']) ) $PuntoMedCondenatorio  = $_POST['PuntoMedCondenatorio'];
	if ( !empty($_POST['PuntoUniMed']) )          $PuntoUniMed           = $_POST['PuntoUniMed'];
	if ( !empty($_POST['PuntoidGrupo']) )         $PuntoidGrupo          = $_POST['PuntoidGrupo'];
	if ( !empty($_POST['idNota_1']) )             $idNota_1              = $_POST['idNota_1'];
	if ( !empty($_POST['idNota_2']) )             $idNota_2              = $_POST['idNota_2'];
	if ( !empty($_POST['idNota_3']) )             $idNota_3              = $_POST['idNota_3'];
	if ( !empty($_POST['idNotaTipo_1']) )         $idNotaTipo_1          = $_POST['idNotaTipo_1'];
	if ( !empty($_POST['idNotaTipo_2']) )         $idNotaTipo_2          = $_POST['idNotaTipo_2'];
	if ( !empty($_POST['idNotaTipo_3']) )         $idNotaTipo_3          = $_POST['idNotaTipo_3'];
	if ( !empty($_POST['Validar']) )              $Validar               = $_POST['Validar'];
	if ( !empty($_POST['Validar_1']) )            $Validar_1             = $_POST['Validar_1'];
	if ( !empty($_POST['Validar_2']) )            $Validar_2             = $_POST['Validar_2'];
	if ( !empty($_POST['Validar_3']) )            $Validar_3             = $_POST['Validar_3'];
	
	
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
			case 'idMatriz':            if(empty($idMatriz)){             $error['idMatriz']              = 'error/No ha ingresado el id';}break;
			case 'idSistema':           if(empty($idSistema)){            $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':            if(empty($idEstado)){             $error['idEstado']              = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':              if(empty($Nombre)){               $error['Nombre']                = 'error/No ha ingresado el nombre';}break;
			case 'cantPuntos':          if(empty($cantPuntos)){           $error['cantPuntos']            = 'error/No ha ingresado la cantidad de puntos';}break;
			case 'idTipo':              if(empty($idTipo)){               $error['idTipo']                = 'error/No ha seleccionado de tipo de planilla';}break;
			case 'mod':                 if(empty($mod)){                  $error['mod']                   = 'error/No ha ingresado el mod';}break;
			case 'PuntoNombre':         if(empty($PuntoNombre)){          $error['PuntoNombre']           = 'error/No ha ingresado el nombre del punto';}break;
			case 'PuntoidTipo':         if(empty($PuntoidTipo)){          $error['PuntoidTipo']           = 'error/No ha seleccionado el tipo de punto';}break;
			case 'PuntoMedAceptable':   if(empty($PuntoMedAceptable)){    $error['PuntoMedAceptable']     = 'error/No ha ingresado el valor aceptable';}break;
			case 'PuntoMedAlerta':      if(empty($PuntoMedAlerta)){       $error['PuntoMedAlerta']        = 'error/No ha ingresado el valor de alerta';}break;
			case 'PuntoMedCondenatorio':if(empty($PuntoMedCondenatorio)){ $error['PuntoMedCondenatorio']  = 'error/No ha ingresado el valor condenatorio';}break;
			case 'PuntoUniMed':         if(empty($PuntoUniMed)){          $error['PuntoUniMed']           = 'error/No ha seleccionado la unidad de medida';}break;
			case 'PuntoidGrupo':        if(empty($PuntoidGrupo)){         $error['PuntoidGrupo']          = 'error/No ha seleccionado el grupo';}break;
			case 'idNota_1':            if(empty($idNota_1)){             $error['idNota_1']              = 'error/No ha seleccionado la Nota Calidad';}break;
			case 'idNota_2':            if(empty($idNota_2)){             $error['idNota_2']              = 'error/No ha seleccionado la Nota Condicion';}break;
			case 'idNota_3':            if(empty($idNota_3)){             $error['idNota_3']              = 'error/No ha seleccionado la Calificacion';}break;
			case 'idNotaTipo_1':        if(empty($idNotaTipo_1)){         $error['idNotaTipo_1']          = 'error/No ha seleccionado el tipo de Nota Calidad';}break;
			case 'idNotaTipo_2':        if(empty($idNotaTipo_2)){         $error['idNotaTipo_2']          = 'error/No ha seleccionado el tipo de Nota Condicion';}break;
			case 'idNotaTipo_3':        if(empty($idNotaTipo_3)){         $error['idNotaTipo_3']          = 'error/No ha seleccionado el tipo de Calificacion';}break;
			case 'Validar':             if(empty($Validar)){              $error['Validar']               = 'error/No ha ingresado los datos para validar';}break;
			case 'Validar_1':           if(empty($Validar_1)){            $error['Validar_1']             = 'error/No ha ingresado los datos para validar de Nota Calidad';}break;
			case 'Validar_2':           if(empty($Validar_2)){            $error['Validar_2']             = 'error/No ha ingresado los datos para validar de Nota Condicion';}break;
			case 'Validar_3':           if(empty($Validar_3)){            $error['Validar_3']             = 'error/No ha ingresado los datos para validar de Calificacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){            $error['Nombre']      = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($PuntoNombre)&&contar_palabras_censuradas($PuntoNombre)!=0){  $error['PuntoNombre'] = 'error/Edita Punto Nombre, contiene palabras no permitidas'; }	

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
							
		case 'insert_matriz':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'cross_quality_calidad_matriz', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Tipo de Planilla ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){             $a  = "'".$Nombre."'" ;         }else{$a ="''";}
				if(isset($cantPuntos) && $cantPuntos != ''){     $a .= ",'".$cantPuntos."'" ;    }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){             $a .= ",'".$idTipo."'" ;        }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
				if(isset($idSistema) && $idSistema != ''){       $a .= ",'".$idSistema."'" ;     }else{$a .=",''";}
				if(isset($idNota_1) && $idNota_1 != ''){         $a .= ",'".$idNota_1."'" ;      }else{$a .=",''";}
				if(isset($idNota_2) && $idNota_2 != ''){         $a .= ",'".$idNota_2."'" ;      }else{$a .=",''";}
				if(isset($idNota_3) && $idNota_3 != ''){         $a .= ",'".$idNota_3."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_quality_proceso_matriz` (Nombre, cantPuntos, idTipo, idEstado,
				idSistema, idNota_1, idNota_2, idNota_3) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&idMatriz='.$ultimo_id.'&created=true' );
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
		case 'update_matriz':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idMatriz)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'cross_quality_calidad_matriz', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idMatriz!='".$idMatriz."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Tipo de Planilla ya existe en el sistema';}
			/*******************************************************************/
			
			if ( empty($error) ) {
		
				//Filtros
				$a = "idMatriz='".$idMatriz."'" ;
				if(isset($Nombre) && $Nombre != ''){                              $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($cantPuntos) && $cantPuntos != ''){                      $a .= ",cantPuntos='".$cantPuntos."'" ;}
				if(isset($idTipo) && $idTipo != ''){                              $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($PuntoNombre) && $PuntoNombre != ''){                    $a .= ",PuntoNombre_".$mod."='".$PuntoNombre."'" ;}
				if(isset($PuntoidTipo) && $PuntoidTipo != ''){                    $a .= ",PuntoidTipo_".$mod."='".$PuntoidTipo."'" ;}
				if(isset($PuntoMedAceptable) && $PuntoMedAceptable != ''){        $a .= ",PuntoMedAceptable_".$mod."='".$PuntoMedAceptable."'" ;}
				if(isset($PuntoMedAlerta) && $PuntoMedAlerta != ''){              $a .= ",PuntoMedAlerta_".$mod."='".$PuntoMedAlerta."'" ;}
				if(isset($PuntoMedCondenatorio) && $PuntoMedCondenatorio != ''){  $a .= ",PuntoMedCondenatorio_".$mod."='".$PuntoMedCondenatorio."'" ;}
				if(isset($PuntoUniMed) && $PuntoUniMed != ''){                    $a .= ",PuntoUniMed_".$mod."='".$PuntoUniMed."'" ;}
				if(isset($PuntoidGrupo) && $PuntoidGrupo != ''){                  $a .= ",PuntoidGrupo_".$mod."='".$PuntoidGrupo."'" ;}
				if(isset($idEstado) && $idEstado != ''){                          $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idNota_1) && $idNota_1 != ''){                          $a .= ",idNota_1='".$idNota_1."'" ;}
				if(isset($idNota_2) && $idNota_2 != ''){                          $a .= ",idNota_2='".$idNota_2."'" ;}
				if(isset($idNota_3) && $idNota_3 != ''){                          $a .= ",idNota_3='".$idNota_3."'" ;}
				if(isset($idNotaTipo_1) && $idNotaTipo_1 != ''){                  $a .= ",idNotaTipo_1='".$idNotaTipo_1."'" ;}
				if(isset($idNotaTipo_2) && $idNotaTipo_2 != ''){                  $a .= ",idNotaTipo_2='".$idNotaTipo_2."'" ;}
				if(isset($idNotaTipo_3) && $idNotaTipo_3 != ''){                  $a .= ",idNotaTipo_3='".$idNotaTipo_3."'" ;}
				if(isset($idSistema) && $idSistema != ''){                        $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Validar) && $Validar != ''){                            $a .= ",Validacion_".$mod."='".$Validar."'" ;}
				if(isset($Validar_1) && $Validar_1 != ''){                        $a .= ",Validar_1='".$Validar_1."'" ;}
				if(isset($Validar_2) && $Validar_2 != ''){                        $a .= ",Validar_2='".$Validar_2."'" ;}
				if(isset($Validar_3) && $Validar_3 != ''){                        $a .= ",Validar_3='".$Validar_3."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'cross_quality_proceso_matriz', 'idMatriz = "'.$idMatriz.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location );
					die;
					
				}
			}

		break;	
/*******************************************************************************************************************/
		case 'del_matriz':	
			
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
				$resultado = db_delete_data (false, 'cross_quality_proceso_matriz', 'idMatriz = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
		case 'clone_Matriz':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'cross_quality_calidad_matriz', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Tipo de Planilla ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//bucle
				$qry = '';
				for ($i = 1; $i <= 100; $i++) {
					$qry .= ',PuntoNombre_'.$i;
					$qry .= ',PuntoMedAceptable_'.$i;
					$qry .= ',PuntoMedAlerta_'.$i;
					$qry .= ',PuntoMedCondenatorio_'.$i;
					$qry .= ',PuntoUniMed_'.$i;
					$qry .= ',PuntoidTipo_'.$i;
					$qry .= ',PuntoidGrupo_'.$i;
					$qry .= ',Validacion_'.$i;
					
				}

				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$rowdata = db_select_data (false, 'cantPuntos, idEstado, idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3, idTipo, idSistema'.$qry, 'cross_quality_proceso_matriz', '', 'idMatriz ='.$idMatriz, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/*******************************************************************/
				//filtros
				if(isset($rowdata['cantPuntos']) && $rowdata['cantPuntos'] != ''){       $a  = "'".$rowdata['cantPuntos']."'" ;      }else{$a  ="''";}
				if(isset($rowdata['idTipo']) && $rowdata['idTipo'] != ''){               $a .= ",'".$rowdata['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){         $a .= ",'".$rowdata['idSistema']."'" ;      }else{$a .= ",''";}
				if(isset($rowdata['idEstado']) && $rowdata['idEstado'] != ''){           $a .= ",'".$rowdata['idEstado']."'" ;       }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                     $a .= ",'".$Nombre."'" ;                    }else{$a .= ",''";}
				if(isset($rowdata['idNota_1']) && $rowdata['idNota_1'] != ''){           $a .= ",'".$rowdata['idNota_1']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['idNota_2']) && $rowdata['idNota_2'] != ''){           $a .= ",'".$rowdata['idNota_2']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['idNota_3']) && $rowdata['idNota_3'] != ''){           $a .= ",'".$rowdata['idNota_3']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['idNotaTipo_1']) && $rowdata['idNotaTipo_1'] != ''){   $a .= ",'".$rowdata['idNotaTipo_1']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['idNotaTipo_2']) && $rowdata['idNotaTipo_2'] != ''){   $a .= ",'".$rowdata['idNotaTipo_2']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['idNotaTipo_3']) && $rowdata['idNotaTipo_3'] != ''){   $a .= ",'".$rowdata['idNotaTipo_3']."'" ;   }else{$a .= ",''";}
				

				for ($i = 1; $i <= 100; $i++) {
					if(isset($rowdata['PuntoNombre_'.$i]) && $rowdata['PuntoNombre_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedAceptable_'.$i]) && $rowdata['PuntoMedAceptable_'.$i] != ''){        $a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;     }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedAlerta_'.$i]) && $rowdata['PuntoMedAlerta_'.$i] != ''){              $a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedCondenatorio_'.$i]) && $rowdata['PuntoMedCondenatorio_'.$i] != ''){  $a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;  }else{$a .= ",''";}
					if(isset($rowdata['PuntoUniMed_'.$i]) && $rowdata['PuntoUniMed_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoUniMed_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoidTipo_'.$i]) && $rowdata['PuntoidTipo_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoidTipo_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoidGrupo_'.$i]) && $rowdata['PuntoidGrupo_'.$i] != ''){                  $a .= ",'".$rowdata['PuntoidGrupo_'.$i]."'" ;          }else{$a .= ",''";}
					if(isset($rowdata['Validacion_'.$i]) && $rowdata['Validacion_'.$i] != ''){                      $a .= ",'".$rowdata['Validacion_'.$i]."'" ;            }else{$a .= ",''";}
					
				}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_quality_proceso_matriz` (cantPuntos,idTipo,idSistema,idEstado, Nombre,
				idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3
				".$qry.") 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&clone=true' );
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
		case 'clone_Matriz_sis':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'cross_quality_calidad_matriz', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Tipo de Planilla ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//bucle
				$qry = '';
				for ($i = 1; $i <= 100; $i++) {
					$qry .= ',PuntoNombre_'.$i;
					$qry .= ',PuntoMedAceptable_'.$i;
					$qry .= ',PuntoMedAlerta_'.$i;
					$qry .= ',PuntoMedCondenatorio_'.$i;
					$qry .= ',PuntoUniMed_'.$i;
					$qry .= ',PuntoidTipo_'.$i;
					$qry .= ',PuntoidGrupo_'.$i;
					$qry .= ',Validacion_'.$i;
					
				}

				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$rowdata = db_select_data (false, 'cantPuntos, idEstado, idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3, idTipo, idSistema'.$qry, 'cross_quality_proceso_matriz', '', 'idMatriz ='.$idMatriz, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				/*******************************************************************/
				//filtros
				if(isset($rowdata['cantPuntos']) && $rowdata['cantPuntos'] != ''){       $a  = "'".$rowdata['cantPuntos']."'" ;      }else{$a  ="''";}
				if(isset($rowdata['idTipo']) && $rowdata['idTipo'] != ''){               $a .= ",'".$rowdata['idTipo']."'" ;         }else{$a .= ",''";}
				if(isset($idSistema) && $idSistema != ''){                               $a .= ",'".$idSistema."'" ;                 }else{$a .= ",''";}
				if(isset($rowdata['idEstado']) && $rowdata['idEstado'] != ''){           $a .= ",'".$rowdata['idEstado']."'" ;       }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                     $a .= ",'".$Nombre."'" ;                    }else{$a .= ",''";}
				if(isset($rowdata['idNota_1']) && $rowdata['idNota_1'] != ''){           $a .= ",'".$rowdata['idNota_1']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['idNota_2']) && $rowdata['idNota_2'] != ''){           $a .= ",'".$rowdata['idNota_2']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['idNota_3']) && $rowdata['idNota_3'] != ''){           $a .= ",'".$rowdata['idNota_3']."'" ;       }else{$a .= ",''";}
				if(isset($rowdata['idNotaTipo_1']) && $rowdata['idNotaTipo_1'] != ''){   $a .= ",'".$rowdata['idNotaTipo_1']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['idNotaTipo_2']) && $rowdata['idNotaTipo_2'] != ''){   $a .= ",'".$rowdata['idNotaTipo_2']."'" ;   }else{$a .= ",''";}
				if(isset($rowdata['idNotaTipo_3']) && $rowdata['idNotaTipo_3'] != ''){   $a .= ",'".$rowdata['idNotaTipo_3']."'" ;   }else{$a .= ",''";}
				

				for ($i = 1; $i <= 100; $i++) {
					if(isset($rowdata['PuntoNombre_'.$i]) && $rowdata['PuntoNombre_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedAceptable_'.$i]) && $rowdata['PuntoMedAceptable_'.$i] != ''){        $a .= ",'".$rowdata['PuntoMedAceptable_'.$i]."'" ;     }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedAlerta_'.$i]) && $rowdata['PuntoMedAlerta_'.$i] != ''){              $a .= ",'".$rowdata['PuntoMedAlerta_'.$i]."'" ;        }else{$a .= ",''";}
					if(isset($rowdata['PuntoMedCondenatorio_'.$i]) && $rowdata['PuntoMedCondenatorio_'.$i] != ''){  $a .= ",'".$rowdata['PuntoMedCondenatorio_'.$i]."'" ;  }else{$a .= ",''";}
					if(isset($rowdata['PuntoUniMed_'.$i]) && $rowdata['PuntoUniMed_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoUniMed_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoidTipo_'.$i]) && $rowdata['PuntoidTipo_'.$i] != ''){                    $a .= ",'".$rowdata['PuntoidTipo_'.$i]."'" ;           }else{$a .= ",''";}
					if(isset($rowdata['PuntoidGrupo_'.$i]) && $rowdata['PuntoidGrupo_'.$i] != ''){                  $a .= ",'".$rowdata['PuntoidGrupo_'.$i]."'" ;          }else{$a .= ",''";}
					if(isset($rowdata['Validacion_'.$i]) && $rowdata['Validacion_'.$i] != ''){                      $a .= ",'".$rowdata['Validacion_'.$i]."'" ;            }else{$a .= ",''";}
					
				}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `cross_quality_proceso_matriz` (cantPuntos,idTipo,idSistema,idEstado, Nombre,
				idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3
				".$qry.") 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&clone=true' );
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
	}
?>
