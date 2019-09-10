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
	if ( !empty($_POST['idAprobador']) )     $idAprobador      = $_POST['idAprobador'];
	if ( !empty($_POST['idSistema']) )       $idSistema        = $_POST['idSistema'];
	if ( !empty($_POST['email']) )           $email            = $_POST['email'];
	
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
			case 'idAprobador':      if(empty($idAprobador)){      $error['idAprobador']      = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){        $error['idSistema']        = 'error/No ha seleccionado el sistema al cual pertenece';}break;
			case 'email':            if(empty($email)){            $error['email']            = 'error/No ha ingresado un correo';}break;
			
		}
	}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){  $error['email']   = 'error/El Email ingresado no es valido'; }
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
			if(isset($email)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('email', 'alumnos_cursos', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Usuario ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){       $a  = "'".$idSistema."'" ;        }else{$a  = "''";}
				if(isset($email) && $email != ''){               $a .= ",'".$email."'" ;           }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `sistema_cross_email_aprobados` (idSistema, email) 
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
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($email)&&isset($idSistema)&&isset($idAprobador)){
				$ndata_1 = db_select_nrows ('email', 'alumnos_cursos', '', "email='".$email."' AND idSistema='".$idSistema."' AND idAprobador!='".$idAprobador."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Usuario ya existe';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAprobador='".$idAprobador."'" ;
				if(isset($idSistema) && $idSistema != ''){   $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($email) && $email != ''){           $a .= ",email='".$email."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `sistema_cross_email_aprobados` SET ".$a." WHERE idAprobador = '$idAprobador'";
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
			$query  = "DELETE FROM `sistema_cross_email_aprobados` WHERE idAprobador = {$_GET['del']}";
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
