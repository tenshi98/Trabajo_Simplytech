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
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
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
				if(isset($Cargo) && $Cargo != ''){                      $a .= ",'".$Cargo."'" ;           }else{$a .= ",''";}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",'".$Descripcion."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `postulantes_listado_experiencia` (idPostulante, AnoInicio, AnoTermino, 
				Nombre,Cargo,Descripcion) 
				VALUES ({$a} )";
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
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `postulantes_listado_experiencia` WHERE idEstudioPost = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&deleted=true' );
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

		break;	
		
		
/*******************************************************************************************************************/
	}
?>
