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

	//Formulario para maquinas
	if ( !empty($_POST['idMatriz']) )             $idMatriz              = $_POST['idMatriz'];
	if ( !empty($_POST['idSistema']) )            $idSistema             = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )             $idEstado              = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )               $Nombre                = $_POST['Nombre'];
	if ( !empty($_POST['cantPuntos']) )           $cantPuntos            = $_POST['cantPuntos'];
	
	if ( !empty($_POST['mod']) )                  $mod                   = $_POST['mod'];
	
	if ( !empty($_POST['PuntoNombre']) )          $PuntoNombre           = $_POST['PuntoNombre'];
	if ( !empty($_POST['SensoresTipo']) )         $SensoresTipo          = $_POST['SensoresTipo'];
	if ( !empty($_POST['SensoresValor']) )        $SensoresValor         = $_POST['SensoresValor'];
	if ( !empty($_POST['SensoresNumero']) )       $SensoresNumero        = $_POST['SensoresNumero'];
	

	
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
			case 'idMatriz':            if(empty($idMatriz)){             $error['idMatriz']              = 'error/No ha ingresado el ID';}break;
			case 'idSistema':           if(empty($idSistema)){            $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':            if(empty($idEstado)){             $error['idEstado']              = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':              if(empty($Nombre)){               $error['Nombre']                = 'error/No ha ingresado el nombre';}break;
			case 'cantPuntos':          if(empty($cantPuntos)){           $error['cantPuntos']            = 'error/No ha ingresado la cantidad de puntos';}break;
			
			case 'PuntoNombre':         if(empty($PuntoNombre)){          $error['PuntoNombre']           = 'error/No ha ingresado el nombre del punto';}break;
			case 'SensoresTipo':        if(empty($SensoresTipo)){         $error['SensoresTipo']          = 'error/No ha seleccionado el tipo de sensor';}break;
			case 'SensoresValor':       if(empty($SensoresValor)){        $error['SensoresValor']         = 'error/No ha ingresado el valor del sensor';}break;
			case 'SensoresNumero':      if(empty($SensoresNumero)){       $error['SensoresNumero']        = 'error/No ha seleccionado el sensor a revisar';}break;
			

		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {	
/*******************************************************************************************************************/		
		case 'insert_matriz':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_mantencion_matriz', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La matriz ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){       $a  = "'".$idSistema."'" ;      }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($cantPuntos) && $cantPuntos != ''){     $a .= ",'".$cantPuntos."'" ;    }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_mantencion_matriz` (idSistema, Nombre, cantPuntos, idEstado) 
				VALUES ({$a} )";
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
			
			if ( empty($error) ) {
		
				//Filtros
				$a = "idMatriz='".$idMatriz."'" ;
				if(isset($idSistema) && $idSistema != ''){                        $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                          $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){                              $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($cantPuntos) && $cantPuntos != ''){                      $a .= ",cantPuntos='".$cantPuntos."'" ;}
				
				if(isset($PuntoNombre) && $PuntoNombre != ''){                    $a .= ",PuntoNombre_".$mod."='".$PuntoNombre."'" ;}
				if(isset($SensoresTipo) && $SensoresTipo != ''){                  $a .= ",SensoresTipo_".$mod."='".$SensoresTipo."'" ;}
				if(isset($SensoresValor) && $SensoresValor != ''){                $a .= ",SensoresValor_".$mod."='".$SensoresValor."'" ;}
				if(isset($SensoresNumero) && $SensoresNumero != ''){              $a .= ",SensoresNumero_".$mod."='".$SensoresNumero."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `telemetria_mantencion_matriz` SET ".$a." WHERE idMatriz = '$idMatriz'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location );
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
		case 'del_matriz':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `telemetria_mantencion_matriz` WHERE idMatriz = {$_GET['del']}";
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
		case 'clone_Matriz':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'telemetria_mantencion_matriz', '', "Nombre='".$Nombre."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la matriz ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//bucle
				$qry = '';
				for ($i = 1; $i <= 50; $i++) {
					$qry .= ',PuntoNombre_'.$i;
					$qry .= ',SensoresTipo_'.$i;
					$qry .= ',SensoresValor_'.$i;
					$qry .= ',SensoresNumero_'.$i;

				}

				/*******************************************************************/
				// Se traen todos los datos de la maquina
				$query = "SELECT 
				idSistema, idEstado, cantPuntos
				".$qry."
				FROM `telemetria_mantencion_matriz`
				WHERE idMatriz = {$idMatriz}";
				$resultado = mysqli_query($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);

				/*******************************************************************/
				//filtros
				if(isset($rowdata['idSistema']) && $rowdata['idSistema'] != ''){     $a  = "'".$rowdata['idSistema']."'" ;     }else{$a  ="''";}
				if(isset($rowdata['idEstado']) && $rowdata['idEstado'] != ''){       $a .= ",'".$rowdata['idEstado']."'" ;     }else{$a .= ",''";}
				if(isset($rowdata['cantPuntos']) && $rowdata['cantPuntos'] != ''){   $a .= ",'".$rowdata['cantPuntos']."'" ;   }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",'".$Nombre."'" ;                  }else{$a .= ",''";}
				

				for ($i = 1; $i <= 50; $i++) {
					if(isset($rowdata['PuntoNombre_'.$i]) && $rowdata['PuntoNombre_'.$i] != ''){        $a .= ",'".$rowdata['PuntoNombre_'.$i]."'" ;     }else{$a .= ",''";}
					if(isset($rowdata['SensoresTipo_'.$i]) && $rowdata['SensoresTipo_'.$i] != ''){      $a .= ",'".$rowdata['SensoresTipo_'.$i]."'" ;    }else{$a .= ",''";}
					if(isset($rowdata['SensoresValor_'.$i]) && $rowdata['SensoresValor_'.$i] != ''){    $a .= ",'".$rowdata['SensoresValor_'.$i]."'" ;   }else{$a .= ",''";}
					if(isset($rowdata['SensoresNumero_'.$i]) && $rowdata['SensoresNumero_'.$i] != ''){  $a .= ",'".$rowdata['SensoresNumero_'.$i]."'" ;  }else{$a .= ",''";}
					
				}
					
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_mantencion_matriz` (idSistema,idEstado,cantPuntos,Nombre
				".$qry.") 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&id='.$ultimo_id.'&clone=true' );
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
