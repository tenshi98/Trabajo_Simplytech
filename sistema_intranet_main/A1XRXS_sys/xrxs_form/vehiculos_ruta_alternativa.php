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
	if ( !empty($_POST['idRutaAlt']) )     $idRutaAlt     = $_POST['idRutaAlt'];
	if ( !empty($_POST['idRuta']) )        $idRuta        = $_POST['idRuta'];
	if ( !empty($_POST['idSistema']) )     $idSistema     = $_POST['idSistema'];
	if ( !empty($_POST['idTipo']) )        $idTipo        = $_POST['idTipo'];
	if ( !empty($_POST['Fecha']) )         $Fecha         = $_POST['Fecha'];
	if ( !empty($_POST['idDia']) )         $idDia         = $_POST['idDia'];
	if ( !empty($_POST['HoraInicio']) )    $HoraInicio    = $_POST['HoraInicio'];
	if ( !empty($_POST['HoraTermino']) )   $HoraTermino   = $_POST['HoraTermino'];
	if ( !empty($_POST['Nombre']) )        $Nombre        = $_POST['Nombre'];


	
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
			case 'idRutaAlt':    if(empty($idRutaAlt)){    $error['idRutaAlt']     = 'error/No ha ingresado el id';}break;
			case 'idRuta':       if(empty($idRuta)){       $error['idRuta']        = 'error/No ha seleccionado el sistema';}break;
			case 'idSistema':    if(empty($idSistema)){    $error['idSistema']     = 'error/No ha ingresado el nombre';}break;
			case 'idTipo':       if(empty($idTipo)){       $error['idTipo']        = 'error/No ha ingresado el id';}break;
			case 'Fecha':        if(empty($Fecha)){        $error['Fecha']         = 'error/No ha seleccionado el sistema';}break;
			case 'idDia':        if(empty($idDia)){        $error['idDia']         = 'error/No ha ingresado el nombre';}break;
			case 'HoraInicio':   if(empty($HoraInicio)){   $error['HoraInicio']    = 'error/No ha ingresado el id';}break;
			case 'HoraTermino':  if(empty($HoraTermino)){  $error['HoraTermino']   = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':       if(empty($Nombre)){       $error['Nombre']        = 'error/No ha ingresado el nombre';}break;
			
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idRuta)){
				$ndata_1 = db_select_nrows ('Nombre', 'vehiculos_ruta_alternativa', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idRuta='".$idRuta."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idRuta) && $idRuta != ''){              $a  = "'".$idRuta."'" ;         }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){        $a .= ",'".$idSistema."'" ;     }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){              $a .= ",'".$idTipo."'" ;        }else{$a .=",''";}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",'".$Fecha."'" ;         }else{$a .=",''";}
				if(isset($idDia) && $idDia != ''){                $a .= ",'".$idDia."'" ;         }else{$a .=",''";}
				if(isset($HoraInicio) && $HoraInicio != ''){      $a .= ",'".$HoraInicio."'" ;    }else{$a .=",''";}
				if(isset($HoraTermino) && $HoraTermino != ''){    $a .= ",'".$HoraTermino."'" ;   }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){              $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `vehiculos_ruta_alternativa` (idRuta, idSistema, idTipo, Fecha, idDia, HoraInicio,
				HoraTermino, Nombre) VALUES ({$a} )";
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idRuta)&&isset($idRutaAlt)){
				$ndata_1 = db_select_nrows ('Nombre', 'vehiculos_ruta_alternativa', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idRuta='".$idRuta."' AND idRutaAlt!='".$idRutaAlt."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idRutaAlt='".$idRutaAlt."'" ;
				if(isset($idRuta) && $idRuta != ''){              $a .= ",idRuta='".$idRuta."'" ;}
				if(isset($idSistema) && $idSistema != ''){        $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTipo) && $idTipo != ''){              $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($idDia) && $idDia != ''){                $a .= ",idDia='".$idDia."'" ;}
				if(isset($HoraInicio) && $HoraInicio != ''){      $a .= ",HoraInicio='".$HoraInicio."'" ;}
				if(isset($HoraTermino) && $HoraTermino != ''){    $a .= ",HoraTermino='".$HoraTermino."'" ;}
				if(isset($Nombre) && $Nombre != ''){              $a .= ",Nombre='".$Nombre."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `vehiculos_ruta_alternativa` SET ".$a." WHERE idRutaAlt = '$idRutaAlt'";
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
			
			//se borran los datos
			$query  = "DELETE FROM `vehiculos_ruta_alternativa` WHERE idRutaAlt = {$_GET['del']}";
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
			
			
			//se borran los datos
			$query  = "DELETE FROM `vehiculos_ruta_alternativa_ubicaciones` WHERE idRutaAlt = {$_GET['del']}";
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
