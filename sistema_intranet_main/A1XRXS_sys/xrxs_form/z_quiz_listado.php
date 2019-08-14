<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridQuizad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idQuiz']) )            $idQuiz              = $_POST['idQuiz'];
	if ( !empty($_POST['idSistema']) )         $idSistema           = $_POST['idSistema'];
	if ( isset($_POST['Nombre']) )             $Nombre 	            = $_POST['Nombre'];
	if ( !empty($_POST['Header_texto']) )      $Header_texto        = $_POST['Header_texto'];
	if ( !empty($_POST['Header_fecha']) )      $Header_fecha        = $_POST['Header_fecha'];
	if ( !empty($_POST['Footer_texto']) )      $Footer_texto        = $_POST['Footer_texto'];
	if ( isset($_POST['Texto_Inicio']) )       $Texto_Inicio        = $_POST['Texto_Inicio'];
	if ( !empty($_POST['idEstado']) )          $idEstado            = $_POST['idEstado'];
	if ( !empty($_POST['idEscala']) )          $idEscala            = $_POST['idEscala'];
	if ( !empty($_POST['Porcentaje_apro']) )   $Porcentaje_apro     = $_POST['Porcentaje_apro'];
	if ( !empty($_POST['Tiempo']) )            $Tiempo              = $_POST['Tiempo'];
	if ( !empty($_POST['idTipoEvaluacion']) )  $idTipoEvaluacion    = $_POST['idTipoEvaluacion'];
	if ( !empty($_POST['idTipoQuiz']) )        $idTipoQuiz          = $_POST['idTipoQuiz'];
	if ( !empty($_POST['idLimiteTiempo']) )    $idLimiteTiempo      = $_POST['idLimiteTiempo'];
	
	if ( !empty($_POST['idPregunta']) )        $idPregunta          = $_POST['idPregunta'];
	if ( !empty($_POST['idTipo']) )            $idTipo 	            = $_POST['idTipo'];
	if ( isset($_POST['Opcion_1']) )           $Opcion_1 	        = $_POST['Opcion_1'];
	if ( isset($_POST['Opcion_2']) )           $Opcion_2 	        = $_POST['Opcion_2'];
	if ( isset($_POST['Opcion_3']) )           $Opcion_3 	        = $_POST['Opcion_3'];
	if ( isset($_POST['Opcion_4']) )           $Opcion_4 	        = $_POST['Opcion_4'];
	if ( isset($_POST['Opcion_5']) )           $Opcion_5 	        = $_POST['Opcion_5'];
	if ( isset($_POST['Opcion_6']) )           $Opcion_6 	        = $_POST['Opcion_6'];
	if ( isset($_POST['OpcionCorrecta']) )     $OpcionCorrecta      = $_POST['OpcionCorrecta'];
	if ( !empty($_POST['idCategoria']) )       $idCategoria         = $_POST['idCategoria'];
	
		
						
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
			case 'idQuiz':            if(empty($idQuiz)){            $error['idQuiz']             = 'error/No ha ingresado el id';}break;
			case 'idSistema':         if(empty($idSistema)){         $error['idSistema']          = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':            if(empty($Nombre)){            $error['Nombre']             = 'error/No ha ingresado el Nombre';}break;
			case 'Header_texto':      if(empty($Header_texto)){      $error['Header_texto']       = 'error/No ha ingresado el texto de la cabecera';}break;
			case 'Header_fecha':      if(empty($Header_fecha)){      $error['Header_fecha']       = 'error/No ha ingresado la fecha de la cabecera';}break;
			case 'Footer_texto':      if(empty($Footer_texto)){      $error['Footer_texto']       = 'error/No ha ingresado el texto del pie de pagina';}break;
			case 'Texto_Inicio':      if(empty($Texto_Inicio)){      $error['Texto_Inicio']       = 'error/No ha ingresado el texto de inicio del contenido';}break;
			case 'idEstado':          if(empty($idEstado)){          $error['idEstado']           = 'error/No ha seleccionado el estado';}break;
			case 'idEscala':          if(empty($idEscala)){          $error['idEscala']           = 'error/No ha seleccionado la escala';}break;
			case 'Porcentaje_apro':   if(empty($Porcentaje_apro)){   $error['Porcentaje_apro']    = 'error/No ha seleccionado el porcentaje de aprobacion';}break;
			case 'Tiempo':            if(empty($Tiempo)){            $error['Tiempo']             = 'error/No ha ingresado el tiempo de ejecucion';}break;
			case 'idTipoEvaluacion':  if(empty($idTipoEvaluacion)){  $error['idTipoEvaluacion']   = 'error/No ha seleccionado el tipo de evaluacion';}break;
			case 'idTipoQuiz':        if(empty($idTipoQuiz)){        $error['idTipoQuiz']         = 'error/No ha seleccionado el tipo de quiz';}break;
			case 'idLimiteTiempo':    if(empty($idLimiteTiempo)){    $error['idLimiteTiempo']     = 'error/No ha seleccionado el limite de tiempo';}break;
			
			case 'idPregunta':        if(empty($idPregunta)){        $error['idPregunta']         = 'error/No ha ingresado la id de la pregunta';}break;
			case 'idTipo':            if(empty($idTipo)){            $error['idTipo']             = 'error/No ha seleccionado el tipo de pregunta';}break;
			case 'Opcion_1':          if(empty($Opcion_1)){          $error['Opcion_1']           = 'error/No ha ingresado la opcion 1';}break;
			case 'Opcion_2':          if(empty($Opcion_2)){          $error['Opcion_2']           = 'error/No ha ingresado la opcion 2';}break;
			case 'Opcion_3':          if(empty($Opcion_3)){          $error['Opcion_3']           = 'error/No ha ingresado la opcion 3';}break;
			case 'Opcion_4':          if(empty($Opcion_4)){          $error['Opcion_4']           = 'error/No ha ingresado la opcion 4';}break;
			case 'Opcion_5':          if(empty($Opcion_5)){          $error['Opcion_5']           = 'error/No ha ingresado la opcion 5';}break;
			case 'Opcion_6':          if(empty($Opcion_6)){          $error['Opcion_6']           = 'error/No ha ingresado la opcion 6';}break;
			case 'OpcionCorrecta':    if(empty($OpcionCorrecta)){    $error['OpcionCorrecta']     = 'error/No ha ingresado la opcion correcta';}break;
			case 'idCategoria':       if(empty($idCategoria)){       $error['idCategoria']        = 'error/No ha seleccionado la categoria';}break;
			
			
		}
	}

	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert_quiz':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'quiz_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){               $a  = "'".$idSistema."'" ;          }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){                     $a .= ",'".$Nombre."'" ;            }else{$a .= ",''";}
				if(isset($Header_texto) && $Header_texto != ''){         $a .= ",'".$Header_texto."'" ;      }else{$a .= ",''";}
				if(isset($Header_fecha) && $Header_fecha != ''){         $a .= ",'".$Header_fecha."'" ;      }else{$a .= ",''";}
				if(isset($Footer_texto) && $Footer_texto != ''){         $a .= ",'".$Footer_texto."'" ;      }else{$a .= ",''";}
				if(isset($Texto_Inicio) && $Texto_Inicio != ''){         $a .= ",'".$Texto_Inicio."'" ;      }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                 $a .= ",'".$idEstado."'" ;          }else{$a .= ",''";}
				if(isset($idEscala) && $idEscala != ''){                 $a .= ",'".$idEscala."'" ;          }else{$a .= ",''";}
				if(isset($Porcentaje_apro) && $Porcentaje_apro != ''){   $a .= ",'".$Porcentaje_apro."'" ;   }else{$a .= ",''";}
				if(isset($Tiempo) && $Tiempo != ''){                     $a .= ",'".$Tiempo."'" ;            }else{$a .= ",''";}
				if(isset($idTipoEvaluacion) && $idTipoEvaluacion != ''){ $a .= ",'".$idTipoEvaluacion."'" ;  }else{$a .= ",''";}
				if(isset($idTipoQuiz) && $idTipoQuiz != ''){             $a .= ",'".$idTipoQuiz."'" ;        }else{$a .= ",''";}
				if(isset($idLimiteTiempo) && $idLimiteTiempo != ''){     $a .= ",'".$idLimiteTiempo."'" ;    }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `quiz_listado` (idSistema, Nombre, Header_texto, Header_fecha, Footer_texto,
				Texto_Inicio, idEstado, idEscala, Porcentaje_apro, Tiempo, idTipoEvaluacion, idTipoQuiz, idLimiteTiempo) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&id_quiz='.$ultimo_id.'&created=true' );
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
		case 'update_quiz':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idQuiz='".$idQuiz."'" ;
				if(isset($idSistema) && $idSistema != ''){               $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){                     $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Header_texto) && $Header_texto != ''){         $a .= ",Header_texto='".$Header_texto."'" ;}
				if(isset($Header_fecha) && $Header_fecha != ''){         $a .= ",Header_fecha='".$Header_fecha."'" ;}
				if(isset($Footer_texto) && $Footer_texto != ''){         $a .= ",Footer_texto='".$Footer_texto."'" ;}
				if(isset($Texto_Inicio) && $Texto_Inicio != ''){         $a .= ",Texto_Inicio='".$Texto_Inicio."'" ;}
				if(isset($idEstado) && $idEstado != ''){                 $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idEscala) && $idEscala != ''){                 $a .= ",idEscala='".$idEscala."'" ;}
				if(isset($Porcentaje_apro) && $Porcentaje_apro != ''){   $a .= ",Porcentaje_apro='".$Porcentaje_apro."'" ;}
				if(isset($Tiempo) && $Tiempo != ''){                     $a .= ",Tiempo='".$Tiempo."'" ;}
				if(isset($idTipoEvaluacion) && $idTipoEvaluacion != ''){ $a .= ",idTipoEvaluacion='".$idTipoEvaluacion."'" ;}
				if(isset($idTipoQuiz) && $idTipoQuiz != ''){             $a .= ",idTipoQuiz='".$idTipoQuiz."'" ;}
				if(isset($idLimiteTiempo) && $idLimiteTiempo != ''){     $a .= ",idLimiteTiempo='".$idLimiteTiempo."'" ;}
					
				// inserto los datos de registro en la db
				$query  = "UPDATE `quiz_listado` SET ".$a." WHERE idQuiz = '$idQuiz'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
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
		case 'del_quiz':	

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			$query  = "DELETE FROM `quiz_listado` WHERE idQuiz = {$_GET['del_quiz']}";
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
			
			//Borrar preguntas
			$query  = "DELETE FROM `quiz_listado_preguntas` WHERE idQuiz = {$_GET['del_quiz']}";
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

		break;							
/*******************************************************************************************************************/		
		case 'insert_pregunta':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idQuiz) && $idQuiz != ''){                      $a  = "'".$idQuiz."'" ;               }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",'".$Nombre."'" ;              }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                      $a .= ",'".$idTipo."'" ;              }else{$a .= ",''";}
				if(isset($Opcion_1) && $Opcion_1 != ''){                  $a .= ",'".$Opcion_1."'" ;            }else{$a .= ",''";}
				if(isset($Opcion_2) && $Opcion_2 != ''){                  $a .= ",'".$Opcion_2."'" ;            }else{$a .= ",''";}
				if(isset($Opcion_3) && $Opcion_3 != ''){                  $a .= ",'".$Opcion_3."'" ;            }else{$a .= ",''";}
				if(isset($Opcion_4) && $Opcion_4 != ''){                  $a .= ",'".$Opcion_4."'" ;            }else{$a .= ",''";}
				if(isset($Opcion_5) && $Opcion_5 != ''){                  $a .= ",'".$Opcion_5."'" ;            }else{$a .= ",''";}
				if(isset($Opcion_6) && $Opcion_6 != ''){                  $a .= ",'".$Opcion_6."'" ;            }else{$a .= ",''";}
				if(isset($OpcionCorrecta) && $OpcionCorrecta != ''){      $a .= ",'".$OpcionCorrecta."'" ;      }else{$a .= ",''";}
				if(isset($idCategoria) && $idCategoria != ''){            $a .= ",'".$idCategoria."'" ;         }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `quiz_listado_preguntas` (idQuiz, Nombre, idTipo, Opcion_1, Opcion_2, Opcion_3,
				Opcion_4, Opcion_5, Opcion_6, OpcionCorrecta, idCategoria  ) 
				VALUES ({$a} )";
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
		case 'update_pregunta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idPregunta='".$idPregunta."'" ;
				if(isset($idQuiz) && $idQuiz != ''){                    $a .= ",idQuiz='".$idQuiz."'" ;                }else{$a .= ",idQuiz='".$idQuiz."'" ;}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",Nombre='".$Nombre."'" ;                  }else{$a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idTipo) && $idTipo != ''){                    $a .= ",idTipo='".$idTipo."'" ;                  }else{$a .= ",idTipo='".$idTipo."'" ;}
				if(isset($Opcion_1) && $Opcion_1 != ''){                $a .= ",Opcion_1='".$Opcion_1."'" ;              }else{$a .= ",Opcion_1='".$Opcion_1."'" ;}
				if(isset($Opcion_2) && $Opcion_2 != ''){                $a .= ",Opcion_2='".$Opcion_2."'" ;              }else{$a .= ",Opcion_2='".$Opcion_2."'" ;}
				if(isset($Opcion_3) && $Opcion_3 != ''){                $a .= ",Opcion_3='".$Opcion_3."'" ;              }else{$a .= ",Opcion_3='".$Opcion_3."'" ;}
				if(isset($Opcion_4) && $Opcion_4 != ''){                $a .= ",Opcion_4='".$Opcion_4."'" ;              }else{$a .= ",Opcion_4='".$Opcion_4."'" ;}
				if(isset($Opcion_5) && $Opcion_5 != ''){                $a .= ",Opcion_5='".$Opcion_5."'" ;              }else{$a .= ",Opcion_5='".$Opcion_5."'" ;}
				if(isset($Opcion_6) && $Opcion_6 != ''){                $a .= ",Opcion_6='".$Opcion_6."'" ;              }else{$a .= ",Opcion_6='".$Opcion_6."'" ;}
				if(isset($OpcionCorrecta) && $OpcionCorrecta != ''){    $a .= ",OpcionCorrecta='".$OpcionCorrecta."'" ;  }else{$a .= ",OpcionCorrecta='".$OpcionCorrecta."'" ;}
				if(isset($idCategoria) && $idCategoria != ''){          $a .= ",idCategoria='".$idCategoria."'" ;  }else{$a .= ",OpcionCorrecta='".$OpcionCorrecta."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `quiz_listado_preguntas` SET ".$a." WHERE idPregunta = '$idPregunta'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
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
		case 'del_pregunta':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			$query  = "DELETE FROM `quiz_listado_preguntas` WHERE idPregunta = {$_GET['del_pregunta']}";
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

		break;				
/*******************************************************************************************************************/
	}
?>
