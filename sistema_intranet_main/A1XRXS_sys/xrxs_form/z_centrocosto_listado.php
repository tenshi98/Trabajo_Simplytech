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

	//Formulario para licitaciones
	if ( !empty($_POST['idCentroCosto']) )        $idCentroCosto         = $_POST['idCentroCosto'];
	if ( !empty($_POST['idSistema']) )          $idSistema           = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )             $Nombre              = $_POST['Nombre'];
	if ( !empty($_POST['idEstado']) )           $idEstado            = $_POST['idEstado'];
	
	
	if ( !empty($_POST['lvl']) )                 $lvl                  = $_POST['lvl'];
	
	
	
	//formulariopara el itemizado
	//Traspaso de valores input a variables
	$idLevel = array();
	if ( !empty($_POST['idLevel_1']) )      $idLevel[1]      = $_POST['idLevel_1'];
	if ( !empty($_POST['idLevel_2']) )      $idLevel[2]      = $_POST['idLevel_2'];
	if ( !empty($_POST['idLevel_3']) )      $idLevel[3]      = $_POST['idLevel_3'];
	if ( !empty($_POST['idLevel_4']) )      $idLevel[4]      = $_POST['idLevel_4'];
	if ( !empty($_POST['idLevel_5']) )      $idLevel[5]      = $_POST['idLevel_5'];

	
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
			case 'idCentroCosto':         if(empty($idCentroCosto)){          $error['idCentroCosto']           = 'error/No ha seleccionado la licitacion';}break;
			case 'idSistema':           if(empty($idSistema)){            $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':              if(empty($Nombre)){               $error['Nombre']                = 'error/No ha ingresado el nombre';}break;
			case 'idEstado':            if(empty($idEstado)){             $error['idEstado']              = 'error/No ha seleccionado el estado';}break;
			
			case 'lvl':                 if(empty($lvl)){                  $error['lvl']                   = 'error/No ha ingresado el nivel';}break;
			
			case 'idLevel_1':           if(empty($idLevel[1])){           $error['idLevel_1']             = 'error/No ha ingresado el idLevel_1';}break;
			case 'idLevel_2':           if(empty($idLevel[2])){           $error['idLevel_2']             = 'error/No ha ingresado el idLevel_2';}break;
			case 'idLevel_3':           if(empty($idLevel[3])){           $error['idLevel_3']             = 'error/No ha ingresado el idLevel_3';}break;
			case 'idLevel_4':           if(empty($idLevel[4])){           $error['idLevel_4']             = 'error/No ha ingresado el idLevel_4';}break;
			case 'idLevel_5':           if(empty($idLevel[5])){           $error['idLevel_5']             = 'error/No ha ingresado el idLevel_5';}break;
			

		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'createBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'centrocosto_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){         $a = "'".$idSistema."'" ;       }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){           $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `centrocosto_listado` (idSistema, Nombre,idEstado) 
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
		case 'createBasicDataClient':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'centrocosto_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){         $a = "'".$idSistema."'" ;       }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){           $a .= ",'".$idEstado."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `centrocosto_listado` (idSistema, Nombre,idEstado) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
						
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
		case 'updateBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idCentroCosto)){
				$ndata_1 = db_select_nrows ('Nombre', 'centrocosto_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idCentroCosto!='".$idCentroCosto."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la licitacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCentroCosto='".$idCentroCosto."'" ;
				if(isset($idSistema) && $idSistema != ''){          $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idEstado) && $idEstado != ''){            $a .= ",idEstado='".$idEstado."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `centrocosto_listado` SET ".$a." WHERE idCentroCosto = '$idCentroCosto'";
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
		case 'delBasicData':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//maximo de registros
			$nmax = 25;
			//se borra la licitacion
			$query  = "DELETE FROM `centrocosto_listado` WHERE idCentroCosto = {$_GET['del']}";
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
			
			
			//se borran los datos relacionados
			for ($i = 1; $i <= $nmax; $i++) {
				$query  = "DELETE FROM `centrocosto_listado_level_".$i."` WHERE idCentroCosto = {$_GET['del']}";
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
			}
				
			//redirijo			
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;	
				
/*******************************************************************************************************************/		
		case 'insert_item':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($lvl)&&isset($Nombre)&&isset($idCentroCosto)&&isset($idSistema)&&isset($Codigo)){
				$ndata_1 = db_select_nrows ('Nombre', 'centrocosto_listado_level_'.$lvl, '', "Nombre='".$Nombre."' AND idCentroCosto='".$idCentroCosto."' AND idSistema='".$idSistema."' AND Codigo='".$Codigo."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El dato ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el Nombre	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){       $a = "'".$idSistema."'" ;        }else{$a ="''";}
				if(isset($idCentroCosto) && $idCentroCosto != ''){   $a .= ",'".$idCentroCosto."'" ;    }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",'".$Nombre."'" ;         }else{$a .=",''";}
				
				$xbla = '';
				for ($i = 2; $i <= $lvl; $i++) {
					//Ubico correctamente el puntero
					$point = $i - 1;
					//Valor a insertar
					if(isset($idLevel[$point]) && $idLevel[$point] != ''){   $a .= ",'".$idLevel[$point]."'" ;   }else{$a .=",''";}
					//donde insertar
					$xbla .= ',idLevel_'.$point;
				}
			
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `centrocosto_listado_level_".$lvl."` (idSistema,idCentroCosto, Nombre
				".$xbla." ) 
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
		case 'update_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el Nombre	
			if ( empty($error) ) {
				//Filtros
				$a = "idLevel_".$lvl."='".$idLevel[$lvl]."'" ;
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idCentroCosto) && $idCentroCosto != ''){   $a .= ",idCentroCosto='".$idCentroCosto."'" ;}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",Nombre='".$Nombre."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `centrocosto_listado_level_".$lvl."` SET ".$a." WHERE idLevel_".$lvl." = '".$idLevel[$lvl]."'";
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
		case 'del_item':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//se borran los datos
			for ($i = $_GET['lvl']; $i <= $_GET['nmax']; $i++) {
				$query  = "DELETE FROM `centrocosto_listado_level_".$i."` WHERE idLevel_".$_GET['lvl']." = {$_GET['del_idLevel']}";
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
			}
				
			//redirijo			
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
/*******************************************************************************************************************/
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idCentroCosto  = $_GET['id'];
			$estado       = $_GET['estado'];
			$query  = "UPDATE centrocosto_listado SET idEstado = '$estado'	
			WHERE idCentroCosto    = '$idCentroCosto'";
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

		break;	
/*******************************************************************************************************************/
		case 'estadoClient':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idCentroCosto  = $_GET['status'];
			$estado         = $_GET['estado'];
			$query  = "UPDATE centrocosto_listado SET idEstado = '$estado'	
			WHERE idCentroCosto    = '$idCentroCosto'";
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

		break;				
/*******************************************************************************************************************/
	}
?>
