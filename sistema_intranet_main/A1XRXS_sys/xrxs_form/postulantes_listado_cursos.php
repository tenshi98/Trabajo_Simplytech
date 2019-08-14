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
	if ( !empty($_POST['idEstado']) )                 $idEstado                  = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )                   $Nombre                    = $_POST['Nombre'];
	if ( !empty($_POST['CasaEstudios']) )             $CasaEstudios              = $_POST['CasaEstudios'];
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
			case 'idEstado':                 if(empty($idEstado)){                  $error['idEstado']                  = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':                   if(empty($Nombre)){                    $error['Nombre']                    = 'error/No ha seleccionado la categoria';}break;
			case 'CasaEstudios':             if(empty($CasaEstudios)){              $error['CasaEstudios']              = 'error/No ha ingresado la casa de estudios';}break;
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
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;         }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",'".$Nombre."'" ;           }else{$a .= ",''";}
				if(isset($CasaEstudios) && $CasaEstudios != ''){        $a .= ",'".$CasaEstudios."'" ;     }else{$a .= ",''";}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",'".$Descripcion."'" ;      }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `postulantes_listado_cursos` (idPostulante, AnoInicio, AnoTermino, idEstado, 
				Nombre,CasaEstudios,Descripcion) 
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
				if(isset($idEstado) && $idEstado != ''){                $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($CasaEstudios) && $CasaEstudios != ''){        $a .= ",CasaEstudios='".$CasaEstudios."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){          $a .= ",Descripcion='".$Descripcion."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `postulantes_listado_cursos` SET ".$a." WHERE idEstudioPost = '$idEstudioPost'";
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
			$query  = "DELETE FROM `postulantes_listado_cursos` WHERE idEstudioPost = {$_GET['del']}";
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
