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
	if ( !empty($_POST['Nombre']) )                   $Nombre                    = $_POST['Nombre'];
	if ( !empty($_POST['Cargo']) )                    $Cargo                     = $_POST['Cargo'];
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
			case 'Nombre':                   if(empty($Nombre)){                    $error['Nombre']                    = 'error/No ha ingresado el nombre de la empresa';}break;
			case 'Cargo':                    if(empty($Cargo)){                     $error['Cargo']                     = 'error/No ha ingresado el cargo';}break;
			case 'Descripcion':              if(empty($Descripcion)){               $error['Descripcion']               = 'error/No ha ingresado la descripcion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){            $error['Nombre']      = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Cargo)&&contar_palabras_censuradas($Cargo)!=0){              $error['Cargo']       = 'error/Edita Cargo, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){  $error['Descripcion'] = 'error/Edita la Descripcion, contiene palabras no permitidas'; }	
	
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
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",'".$Nombre."'" ;           }else{$a .= ",''";}
				if(isset($Cargo) && $Cargo != ''){                      $a .= ",'".$Cargo."'" ;            }else{$a .= ",''";}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",'".$Descripcion."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `postulantes_listado_experiencia` (idPostulante, AnoInicio, AnoTermino, 
				Nombre,Cargo,Descripcion) 
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
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Cargo) && $Cargo != ''){                      $a .= ",Cargo='".$Cargo."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",Descripcion='".$Descripcion."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `postulantes_listado_experiencia` SET ".$a." WHERE idEstudioPost = '$idEstudioPost'";
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
				$resultado = db_delete_data (false, 'postulantes_listado_experiencia', 'idEstudioPost = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
