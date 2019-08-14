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
	if ( !empty($_POST['idCurso']) )      $idCurso       = $_POST['idCurso'];
	if ( !empty($_POST['idSistema']) )    $idSistema     = $_POST['idSistema'];
	if ( !empty($_POST['idCliente']) )    $idCliente     = $_POST['idCliente'];
	if ( !empty($_POST['Nombre']) )       $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['Semanas']) )      $Semanas       = $_POST['Semanas'];
	if ( !empty($_POST['F_inicio']) )     $F_inicio      = $_POST['F_inicio'];
	if ( !empty($_POST['F_termino']) )    $F_termino     = $_POST['F_termino'];
	if ( !empty($_POST['idEstado']) )     $idEstado      = $_POST['idEstado'];
	
	
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
			case 'idCurso':      if(empty($idCurso)){      $error['idCurso']     = 'error/No ha ingresado el id';}break;
			case 'idSistema':    if(empty($idSistema)){    $error['idSistema']   = 'error/No ha seleccionado el sistema';}break;
			case 'idCliente':    if(empty($idCliente)){    $error['idCliente']   = 'error/No ha seleccionado el cliente';}break;
			case 'Nombre':       if(empty($Nombre)){       $error['Nombre']      = 'error/No ha ingresado el nombre';}break;
			case 'Semanas':      if(empty($Semanas)){      $error['Semanas']     = 'error/No ha ingresado la semana';}break;
			case 'F_inicio':     if(empty($F_inicio)){     $error['F_inicio']    = 'error/No ha ingresado la fecha de inicio';}break;
			case 'F_termino':    if(empty($F_termino)){    $error['F_termino']   = 'error/No ha ingresado la fecha de termino';}break;
			case 'idEstado':     if(empty($idEstado)){     $error['idEstado']    = 'error/No ha seleccionado el estado';}break;
			
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
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_cursos', '', 'Nombre="'.$Nombre.'"', $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){  $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
				if(isset($idCliente) && $idCliente != ''){  $a .= ",'".$idCliente."'" ;  }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",'".$Nombre."'" ;     }else{$a .=",''";}
				if(isset($Semanas) && $Semanas != ''){      $a .= ",'".$Semanas."'" ;    }else{$a .=",''";}
				if(isset($F_inicio) && $F_inicio != ''){    $a .= ",'".$F_inicio."'" ;   }else{$a .=",''";}
				if(isset($F_termino) && $F_termino != ''){  $a .= ",'".$F_termino."'" ;  }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){    $a .= ",'".$idEstado."'" ;   }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `alumnos_cursos` (idSistema, idCliente, Nombre, Semanas, F_inicio, 
				F_termino, idEstado) 
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idCurso)){
				$ndata_1 = db_select_nrows ('Nombre', 'alumnos_cursos', '', "Nombre='".$Nombre."' AND idCurso!='".$idCurso."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCurso='".$idCurso."'" ;
				if(isset($idSistema) && $idSistema != ''){  $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idCliente) && $idCliente != ''){  $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($Nombre) && $Nombre != ''){        $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Semanas) && $Semanas != ''){      $a .= ",Semanas='".$Semanas."'" ;}
				if(isset($F_inicio) && $F_inicio != ''){    $a .= ",F_inicio='".$F_inicio."'" ;}
				if(isset($F_termino) && $F_termino != ''){  $a .= ",F_termino='".$F_termino."'" ;}
				if(isset($idEstado) && $idEstado != ''){    $a .= ",idEstado='".$idEstado."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `alumnos_cursos` SET ".$a." WHERE idCurso = '$idCurso'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'&id='.$idCurso.'&edited=true' );
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
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `alumnos_cursos` WHERE idCurso = {$_GET['del']}";
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
		//Cambio el estado de activo a inactivo
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idCurso    = $_GET['id'];
			$idEstado   = $_GET['estado'];
			$query  = "UPDATE alumnos_cursos SET idEstado = '$idEstado'	
			WHERE idCurso    = '$idCurso'";
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
		//Agrega un permiso al usuario
		case 'ele_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idCurso     = $_GET['id'];
			$idElearning = $_GET['ele_add'];

			$query  = "INSERT INTO `alumnos_cursos_elearning` (idCurso, idElearning) 
			VALUES ('$idCurso','$idElearning')";
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
 

		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'ele_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `alumnos_cursos_elearning` WHERE idRelacionados = {$_GET['ele_del']}";
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
			

		break;	
							
/*******************************************************************************************************************/
	}
?>
