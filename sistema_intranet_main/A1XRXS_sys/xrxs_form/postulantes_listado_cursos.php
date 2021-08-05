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
	if ( !empty($_POST['idEstudioPost']) )            $idEstudioPost             = $_POST['idEstudioPost'];
	if ( !empty($_POST['idPostulante']) )             $idPostulante              = $_POST['idPostulante'];
	if ( !empty($_POST['AnoInicio']) )                $AnoInicio                 = $_POST['AnoInicio'];
	if ( !empty($_POST['AnoTermino']) )               $AnoTermino                = $_POST['AnoTermino'];
	if ( !empty($_POST['idEstado']) )                 $idEstado                  = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )                   $Nombre                    = $_POST['Nombre'];
	if ( !empty($_POST['CasaEstudios']) )             $CasaEstudios              = $_POST['CasaEstudios'];
	if ( !empty($_POST['Descripcion']) )              $Descripcion               = $_POST['Descripcion'];
	
	
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
			case 'idEstudioPost':            if(empty($idEstudioPost)){             $error['idEstudioPost']             = 'error/No ha ingresado el id';}break;
			case 'idPostulante':             if(empty($idPostulante)){              $error['idPostulante']              = 'error/No ha seleccionado el postulante';}break;
			case 'AnoInicio':                if(empty($AnoInicio)){                 $error['AnoInicio']                 = 'error/No ha ingresado el año de inicio';}break;
			case 'AnoTermino':               if(empty($AnoTermino)){                $error['AnoTermino']                = 'error/No ha ingresado el año de termino';}break;
			case 'idEstado':                 if(empty($idEstado)){                  $error['idEstado']                  = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':                   if(empty($Nombre)){                    $error['Nombre']                    = 'error/No ha seleccionado la categoria';}break;
			case 'CasaEstudios':             if(empty($CasaEstudios)){              $error['CasaEstudios']              = 'error/No ha ingresado la casa de estudios';}break;
			case 'Descripcion':              if(empty($Descripcion)){               $error['Descripcion']               = 'error/No ha ingresado la descripcion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){              $error['Nombre']       = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($CasaEstudios)&&contar_palabras_censuradas($CasaEstudios)!=0){  $error['CasaEstudios'] = 'error/Edita la Casa Estudios, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){    $error['Descripcion']  = 'error/Edita la Descripcion, contiene palabras no permitidas'; }	
	
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
				
				//filtros
				if(isset($idPostulante) && $idPostulante != ''){        $a  = "'".$idPostulante."'" ;      }else{$a  = "''";}
				if(isset($AnoInicio) && $AnoInicio != ''){              $a .= ",'".$AnoInicio."'" ;        }else{$a .= ",''";}
				if(isset($AnoTermino) && $AnoTermino != ''){            $a .= ",'".$AnoTermino."'" ;       }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;         }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",'".$Nombre."'" ;           }else{$a .= ",''";}
				if(isset($CasaEstudios) && $CasaEstudios != ''){        $a .= ",'".$CasaEstudios."'" ;     }else{$a .= ",''";}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",'".$Descripcion."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `postulantes_listado_cursos` (idPostulante, AnoInicio, AnoTermino, idEstado, 
				Nombre,CasaEstudios,Descripcion) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
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
				$a = "idEstudioPost='".$idEstudioPost."'" ;
				if(isset($idPostulante) && $idPostulante != ''){        $a .= ",idPostulante='".$idPostulante."'" ;}
				if(isset($AnoInicio) && $AnoInicio != ''){              $a .= ",AnoInicio='".$AnoInicio."'" ;}
				if(isset($AnoTermino) && $AnoTermino != ''){            $a .= ",AnoTermino='".$AnoTermino."'" ;}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($CasaEstudios) && $CasaEstudios != ''){        $a .= ",CasaEstudios='".$CasaEstudios."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",Descripcion='".$Descripcion."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'postulantes_listado_cursos', 'idEstudioPost = "'.$idEstudioPost.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'postulantes_listado_cursos', 'idEstudioPost = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
