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
	if ( !empty($_POST['idElearning']) )  $idElearning   = $_POST['idElearning'];
	if ( !empty($_POST['idSistema']) )    $idSistema     = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )       $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['Resumen']) )      $Resumen       = $_POST['Resumen'];
	if ( !empty($_POST['Unidades']) )     $Unidades      = $_POST['Unidades'];
	if ( !empty($_POST['Imagen']) )       $Imagen        = $_POST['Imagen'];
	if ( !empty($_POST['LastUpdate']) )   $LastUpdate    = $_POST['LastUpdate'];
	if ( !empty($_POST['Objetivos']) )    $Objetivos     = $_POST['Objetivos'];
	if ( !empty($_POST['Requisitos']) )   $Requisitos    = $_POST['Requisitos'];
	if ( !empty($_POST['Descripcion']) )  $Descripcion   = $_POST['Descripcion'];
	
	if ( !empty($_POST['idUnidad']) )     $idUnidad      = $_POST['idUnidad'];
	if ( !empty($_POST['N_Unidad']) )     $N_Unidad      = $_POST['N_Unidad'];
	if ( !empty($_POST['Duracion']) )     $Duracion      = $_POST['Duracion'];
	
	if ( !empty($_POST['idContenido']) )  $idContenido   = $_POST['idContenido'];
	if ( !empty($_POST['Contenido']) )    $Contenido     = $_POST['Contenido'];


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
			case 'idElearning':  if(empty($idElearning)){  $error['idElearning'] = 'error/No ha ingresado el id';}break;
			case 'idSistema':    if(empty($idSistema)){    $error['idSistema']   = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':       if(empty($Nombre)){       $error['Nombre']      = 'error/No ha ingresado el nombre';}break;
			case 'Resumen':      if(empty($Resumen)){      $error['Resumen']     = 'error/No ha ingresado el resumen';}break;
			case 'Unidades':     if(empty($Unidades)){     $error['Unidades']    = 'error/No ha ingresado la unidad';}break;
			case 'Imagen':       if(empty($Imagen)){       $error['Imagen']      = 'error/No ha ingresado la imagen';}break;
			case 'LastUpdate':   if(empty($LastUpdate)){   $error['LastUpdate']  = 'error/No ha ingresado la ultima actualizacion';}break;
			case 'Objetivos':    if(empty($Objetivos)){    $error['Objetivos']   = 'error/No ha ingresado el objetivo';}break;
			case 'Requisitos':   if(empty($Requisitos)){   $error['Requisitos']  = 'error/No ha ingresado los requisitos';}break;
			case 'Descripcion':  if(empty($Descripcion)){  $error['Descripcion'] = 'error/No ha ingresado la descipcion';}break;
			
			case 'idUnidad':     if(empty($idUnidad)){     $error['idUnidad']    = 'error/No ha ingresado el id';}break;
			case 'N_Unidad':     if(empty($N_Unidad)){     $error['N_Unidad']    = 'error/No ha seleccionado el numero de unidad';}break;
			case 'Duracion':     if(empty($Duracion)){     $error['Duracion']    = 'error/No ha ingresado la fecha de inicio';}break;
			
			case 'idContenido':  if(empty($idContenido)){  $error['idContenido'] = 'error/No ha ingresado el id';}break;
			case 'Contenido':    if(empty($Contenido)){    $error['Contenido']   = 'error/No ha ingresado el contenido';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert_curso':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_elearning_listado', '', "Nombre='".$Nombre."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){  $a  = "'".$idSistema."'" ;    }else{$a  ="''";}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",'".$Nombre."'" ;      }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `alumnos_elearning_listado` (idSistema, Nombre) VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					//Creo cada unidad dependiente dentro del elearning
					for ($i = 1; $i <= $Unidades; $i++) {
						
						//Se crean las variables a guardar
						$a  = "'".$ultimo_id."'" ;
						$a .= ",'".$i."'" ;
						$a .= ",''" ;
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `alumnos_elearning_listado_unidades` (idElearning, N_Unidad, Nombre) VALUES ({$a} )";
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
						
					header( 'Location: '.$location.'&created=true&id_curso='.$ultimo_id );
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
		case 'update_curso':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idElearning)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_elearning_listado', '', "Nombre='".$Nombre."' AND idElearning!='".$idElearning."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//variables
				$LastUpdate = fecha_actual();
				
				//Filtros
				$a = "idElearning='".$idElearning."'" ;
				if(isset($idSistema) && $idSistema != ''){     $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){           $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Resumen) && $Resumen != ''){         $a .= ",Resumen='".$Resumen."'" ;}
				if(isset($Imagen) && $Imagen != ''){           $a .= ",Imagen='".$Imagen."'" ;}
				if(isset($LastUpdate) && $LastUpdate != ''){   $a .= ",LastUpdate='".$LastUpdate."'" ;}
				if(isset($Objetivos) && $Objetivos != ''){     $a .= ",Objetivos='".$Objetivos."'" ;}
				if(isset($Requisitos) && $Requisitos != ''){   $a .= ",Requisitos='".$Requisitos."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){ $a .= ",Descripcion='".$Descripcion."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `alumnos_elearning_listado` SET ".$a." WHERE idElearning = '$idElearning'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edited=true&id_curso='.$idElearning );
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
		case 'del_curso':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el listado de archivos relacionados
			$arrContenidos = array();
			$query = "SELECT File
			FROM `alumnos_elearning_listado_unidades_documentacion`
			WHERE idElearning = {$_GET['del_curso']}";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContenidos,$row );
			}
			
			//se elimina el archivo
			foreach ($arrContenidos as $cont) {
				if(isset($cont['File'])&&$cont['File']!=''){
					try {
						if(!is_writable('upload/'.$cont['File'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$cont['File']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
			}

			//se borran los cursos
			$query  = "DELETE FROM `alumnos_elearning_listado` WHERE idElearning = {$_GET['del_curso']}";
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
			
			
				
			
			//se borran las unidads del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades` WHERE idElearning = {$_GET['del_curso']}";
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
			
			//se borran los contenidos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_contenido` WHERE idElearning = {$_GET['del_curso']}";
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
			
			//se borran los documentos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_documentacion` WHERE idElearning = {$_GET['del_curso']}";
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
						
			header( 'Location: '.$location.'&deleted=true&id_curso='.$_GET['id_curso'] );
			die;

		break;							
/*******************************************************************************************************************/		
		case 'insert_unidad':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($N_Unidad)&&isset($idElearning)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_elearning_listado_unidades', '', "N_Unidad='".$N_Unidad."' AND idElearning='".$idElearning."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La unidad ya existe';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idElearning) && $idElearning != ''){   $a  = "'".$idElearning."'" ;   }else{$a  ="''";}
				if(isset($N_Unidad) && $N_Unidad != ''){         $a .= ",'".$N_Unidad."'" ;     }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",'".$Nombre."'" ;       }else{$a .=",''";}
				if(isset($Duracion) && $Duracion != ''){         $a .= ",'".$Duracion."'" ;     }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `alumnos_elearning_listado_unidades` (idElearning, N_Unidad, Nombre,
				Duracion) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&created=true&id_curso='.$idElearning );
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
		case 'update_unidad':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($N_Unidad)&&isset($idElearning)&&isset($idUnidad)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_elearning_listado_unidades', '', "N_Unidad='".$N_Unidad."' AND idElearning='".$idElearning."' AND idUnidad!='".$idUnidad."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La unidad ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idUnidad='".$idUnidad."'" ;
				if(isset($idElearning) && $idElearning != ''){ $a .= ",idElearning='".$idElearning."'" ;}
				if(isset($N_Unidad) && $N_Unidad != ''){       $a .= ",N_Unidad='".$N_Unidad."'" ;}
				if(isset($Nombre) && $Nombre != ''){           $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Duracion) && $Duracion != ''){       $a .= ",Duracion='".$Duracion."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `alumnos_elearning_listado_unidades` SET ".$a." WHERE idUnidad = '$idUnidad'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edited=true&id_curso='.$idElearning );
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
		case 'del_unidad':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el listado de archivos relacionados
			$arrContenidos = array();
			$query = "SELECT File
			FROM `alumnos_elearning_listado_unidades_documentacion`
			WHERE idUnidad = {$_GET['del_Unidad']}";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContenidos,$row );
			}
			
			//se elimina el archivo
			foreach ($arrContenidos as $cont) {
				if(isset($cont['File'])&&$cont['File']!=''){
					try {
						if(!is_writable('upload/'.$cont['File'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$cont['File']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
			}
			
			//se borran las unidades del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades` WHERE idUnidad = {$_GET['del_Unidad']}";
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
			
			//se borran los contenidos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_contenido` WHERE idUnidad = {$_GET['del_Unidad']}";
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
			
			//se borran los documentos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_documentacion` WHERE idUnidad = {$_GET['del_Unidad']}";
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
						
			header( 'Location: '.$location.'&deleted=true&id_curso='.$_GET['id_curso'] );
			die;

		break;	
/*******************************************************************************************************************/		
		case 'insert_contenido':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idUnidad)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_elearning_listado_unidades_contenido', '', "Nombre='".$Nombre."' AND idUnidad='".$idUnidad."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Contenido ya existe';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idUnidad) && $idUnidad != ''){        $a  = "'".$idUnidad."'" ;      }else{$a  ="''";}
				if(isset($idElearning) && $idElearning != ''){  $a .= ",'".$idElearning."'" ;  }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){            $a .= ",'".$Nombre."'" ;       }else{$a .=",''";}
				if(isset($Contenido) && $Contenido != ''){      $a .= ",'".$Contenido."'" ;    }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `alumnos_elearning_listado_unidades_contenido` (idUnidad, idElearning, 
				Nombre, Contenido) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&created=true&id_curso='.$idElearning );
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
		case 'update_contenido':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idUnidad)&&isset($idContenido)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_elearning_listado_unidades_contenido', '', "Nombre='".$Nombre."' AND idUnidad='".$idUnidad."' AND idContenido!='".$idContenido."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Contenido ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idContenido='".$idContenido."'" ;
				if(isset($idUnidad) && $idUnidad != ''){        $a .= ",idUnidad='".$idUnidad."'" ;}
				if(isset($idElearning) && $idElearning != ''){  $a .= ",idElearning='".$idElearning."'" ;}
				if(isset($Nombre) && $Nombre != ''){            $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Contenido) && $Contenido != ''){      $a .= ",Contenido='".$Contenido."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `alumnos_elearning_listado_unidades_contenido` SET ".$a." WHERE idContenido = '$idContenido'";
				$result = mysqli_query($dbConn, $query);
				
				//Actualizo la unidad del documento relacionado
				$a = "idUnidad='".$idUnidad."'" ;
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `alumnos_elearning_listado_unidades_documentacion` SET ".$a." 
				WHERE idContenido = '$idContenido'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&edited=true&id_curso='.$idElearning );
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
		case 'del_contenido':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el listado de archivos relacionados
			$arrContenidos = array();
			$query = "SELECT File
			FROM `alumnos_elearning_listado_unidades_documentacion`
			WHERE idContenido = {$_GET['del_Contenido']}";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContenidos,$row );
			}
			
			//se elimina el archivo
			foreach ($arrContenidos as $cont) {
				if(isset($cont['File'])&&$cont['File']!=''){
					try {
						if(!is_writable('upload/'.$cont['File'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$cont['File']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
			}
			
			//se borran los contenidos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_contenido` WHERE idContenido = {$_GET['del_Contenido']}";
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
			
			//se borran los documentos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_documentacion` WHERE idContenido = {$_GET['del_Contenido']}";
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
						
			header( 'Location: '.$location.'&deleted=true&id_curso='.$_GET['id_curso'] );
			die;

		break;		
/*******************************************************************************************************************/		
		case 'new_file':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( empty($error) ) {
				
				
				//Se verifica 
				if(isset($_FILES["exFile"])){
					if ($_FILES["exFile"]["error"] > 0){ 
						$error['exFile']     = 'error/Ha ocurrido un error'; 
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("application/msword",
											"application/vnd.ms-word",
											"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
									
											"application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
											
											"application/mspowerpoint",
											"application/vnd.ms-powerpoint",
											"application/vnd.openxmlformats-officedocument.presentationml.presentation",
											
											"application/pdf",
											"application/octet-stream",
											"application/x-real",
											"application/vnd.adobe.xfdf",
											"application/vnd.fdf",
											"binary/octet-stream",
											
											"image/jpg", 
											"image/jpeg", 
											"image/gif", 
											"image/png"

											);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'elearning_files_'.$idContenido.'_';
						
					  
						if (in_array($_FILES['exFile']['type'], $permitidos) && $_FILES['exFile']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['exFile']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["exFile"]["tmp_name"], $ruta);
								if ($move_result){
									
									//filtros
									if(isset($idUnidad) && $idUnidad != ''){        $a  = "'".$idUnidad."'" ;      }else{$a  ="''";}
									if(isset($idElearning) && $idElearning != ''){  $a .= ",'".$idElearning."'" ;  }else{$a .=",''";}
									if(isset($idContenido) && $idContenido != ''){  $a .= ",'".$idContenido."'" ;  }else{$a .=",''";}
									$a .= ",'".$sufijo.$_FILES['exFile']['name']."'" ; 
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `alumnos_elearning_listado_unidades_documentacion` (idUnidad, idElearning, 
									idContenido, File) 
									VALUES ({$a} )";
									//Consulta
									$resultado = mysqli_query ($dbConn, $query);
									//Si ejecuto correctamente la consulta
									if($resultado){
										
										//redirijo
										header( 'Location: '.$location.'&edited=true&id_curso='.$idElearning );
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
			
								} else {
									$error['exFile']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['exFile']     = 'error/El archivo '.$_FILES['exFile']['name'].' ya existe'; 
							}
						} else {
							$error['exFile']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}				
				}	
				
			}

		break;	
		
/*******************************************************************************************************************/
		case 'del_file':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el listado de archivos relacionados
			$arrContenidos = array();
			$query = "SELECT File
			FROM `alumnos_elearning_listado_unidades_documentacion`
			WHERE idDocumentacion = {$_GET['del_file']}";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContenidos,$row );
			}
			
			//se elimina el archivo
			foreach ($arrContenidos as $cont) {
				if(isset($cont['File'])&&$cont['File']!=''){
					try {
						if(!is_writable('upload/'.$cont['File'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$cont['File']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
			}
			
			//se borran los documentos del curso
			$query  = "DELETE FROM `alumnos_elearning_listado_unidades_documentacion` WHERE idDocumentacion = {$_GET['del_file']}";
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
						
			header( 'Location: '.$location.'&deleted=true&id_curso='.$_GET['id_curso'] );
			die;
			

		break;				
/*******************************************************************************************************************/
	}
?>
