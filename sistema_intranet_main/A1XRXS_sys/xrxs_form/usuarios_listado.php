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
	if ( !empty($_POST['idUsuario']) )      $idUsuario      = $_POST['idUsuario'];
	if ( !empty($_POST['usuario']) )        $usuario        = $_POST['usuario'];
	if ( !empty($_POST['password']) )       $password       = $_POST['password'];
	if ( !empty($_POST['repassword']) )     $repassword     = $_POST['repassword'];
	if ( !empty($_POST['oldpassword']) )    $oldpassword    = $_POST['oldpassword'];
	if ( !empty($_POST['idTipoUsuario']) )  $idTipoUsuario  = $_POST['idTipoUsuario'];
	if ( !empty($_POST['idEstado']) )       $idEstado       = $_POST['idEstado'];
	if ( !empty($_POST['email']) )          $email          = $_POST['email'];
	if ( !empty($_POST['Nombre']) )         $Nombre         = $_POST['Nombre'];
	if ( !empty($_POST['Rut']) )            $Rut 	        = $_POST['Rut'];
	if ( !empty($_POST['fNacimiento']) )    $fNacimiento    = $_POST['fNacimiento'];
	if ( !empty($_POST['Fono']) )           $Fono 	        = $_POST['Fono'];
	if ( !empty($_POST['idCiudad']) )       $idCiudad 	    = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )       $idComuna 	    = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )      $Direccion      = $_POST['Direccion'];
	if ( !empty($_POST['Direccion_img']) )  $Direccion_img  = $_POST['Direccion_img'];
	if ( !empty($_POST['Ultimo_acceso']) )  $Ultimo_acceso  = $_POST['Ultimo_acceso'];
	if ( !empty($_POST['fkinput1']) )       $fkinput1       = $_POST['fkinput1'];
	if ( !empty($_POST['fkinput2']) )       $fkinput2       = $_POST['fkinput2'];
	
	
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
			case 'idUsuario':      if(empty($idUsuario)){     $error['idUsuario']      = 'error/No ha ingresado el id';}break;
			case 'usuario':        if(empty($usuario)){       $error['usuario']        = 'error/No ha ingresado el nombre de usuario del sistema';}break;
			case 'password':       if(empty($password)){      $error['password']       = 'error/No ha ingresado una clave';}break;
			case 'repassword':     if(empty($repassword)){    $error['repassword']     = 'error/No ha ingresado la repeticion de la clave';}break;
			case 'oldpassword':    if(empty($oldpassword)){   $error['oldpassword']    = 'error/No ha ingresado su clave antigua';}break;
			case 'idTipoUsuario':  if(empty($idTipoUsuario)){ $error['idTipoUsuario']  = 'error/No ha seleccionado el tipo de usuario';}break;
			case 'idEstado':       if(empty($idEstado)){      $error['idEstado']       = 'error/No ha seleccionado el estado';}break;
			case 'email':          if(empty($email)){         $error['email']          = 'error/No ha ingresado el email';}break;
			case 'Nombre':         if(empty($Nombre)){        $error['Nombre']         = 'error/No ha ingresado el Nombre';}break;
			case 'Rut':            if(empty($Rut)){           $error['Rut']            = 'error/No ha ingresado el Rut';}break;
			case 'fNacimiento':    if(empty($fNacimiento)){   $error['fNacimiento']    = 'error/No ha ingresado el fNacimiento';}break;
			case 'Fono':           if(empty($Fono)){          $error['Fono']           = 'error/No ha ingresado el Fono';}break;	
			case 'idCiudad':       if(empty($idCiudad)){      $error['idCiudad']       = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':       if(empty($idComuna)){      $error['idComuna']       = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':      if(empty($Direccion)){     $error['Direccion']      = 'error/No ha ingresado la Direccion';}break;
			case 'Direccion_img':  if(empty($Direccion_img)){ $error['Direccion_img']  = 'error/No ha ingresado el nombre de la imagen de perfil';}break;
			case 'Ultimo_acceso':  if(empty($Ultimo_acceso)){ $error['Ultimo_acceso']  = 'error/No ha ingresado el ultimo acceso al sistema';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){     $error['email']    = 'error/El Email ingresado no es valido'; }	
	if(isset($Fono)&&!validarNumero($Fono)) {     $error['Fono']	 = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Rut)&&!validarRut($Rut)){           $error['Rut']      = 'error/El Rut ingresado no es valido'; }
	if(isset($password)&&isset($repassword)){
		if ( $password <> $repassword )           $error['password'] = 'error/Las contraseñas ingresadas no coinciden'; 
	}
	if(isset($usuario)){
		if (strpos($usuario, " ")){               $error['usuario1']  = 'error/El nombre de usuario contiene espacios vacios';}
		if (strtolower($usuario) != $usuario){    $error['usuario2']  = 'error/El nombre de usuario contiene mayusculas';}
	}
	if(isset($password)){
		if (strpos($password, " ")){              $error['Password1'] = 'error/La contraseña de usuario contiene espacios vacios';}
		//if (strtolower($password) != $password){  $error['Password2'] = 'error/La contraseña de usuario contiene mayusculas';}
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
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			//Se verifica si el dato existe
			if(isset($usuario)){
				$ndata_1 = db_select_nrows ('usuario', 'usuarios_listado', '', "usuario='".$usuario."'", $dbConn);
			}
			/*if(isset($Nombre)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('Nombre', 'usuarios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_3 = db_select_nrows ('Rut', 'usuarios_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn);
			}
			if(isset($email)&&isset($idSistema)){
				$ndata_4 = db_select_nrows ('email', 'usuarios_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn);
			}*/
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de usuario ingresado ya existe';}
			/*if($ndata_2 > 0) {$error['ndata_2'] = 'error/El nombre de la persona ingresada ya existe';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El Rut ya ya existe en el sistema';}
			if($ndata_4 > 0) {$error['ndata_4'] = 'error/El email ya existe en el sistema';}*/
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($usuario) && $usuario != ''){              $a  = "'".$usuario."'" ;         }else{$a  ="''";}
				if(isset($password) && $password != ''){            $a .= ",'".md5($password)."'" ;  }else{$a .= ",''";}
				if(isset($idTipoUsuario) && $idTipoUsuario != ''){  $a .= ",'".$idTipoUsuario."'" ;  }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){            $a .= ",'".$idEstado."'" ;       }else{$a .= ",''";}
				if(isset($email) && $email != ''){                  $a .= ",'".$email."'" ;          }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",'".$Nombre."'" ;         }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                      $a .= ",'".$Rut."'" ;            }else{$a .= ",''";}
				if(isset($fNacimiento) && $fNacimiento != ''){      $a .= ",'".$fNacimiento."'" ;    }else{$a .= ",''";}
				if(isset($Fono) && $Fono != ''){                    $a .= ",'".$Fono."'" ;           }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){            $a .= ",'".$idCiudad."'" ;       }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){            $a .= ",'".$idComuna."'" ;       }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){          $a .= ",'".$Direccion."'" ;      }else{$a .= ",''";}
				if(isset($Direccion_img) && $Direccion_img != ''){  $a .= ",'".$Direccion_img."'" ;  }else{$a .= ",''";}
				if(isset($Ultimo_acceso) && $Ultimo_acceso != ''){  $a .= ",'".$Ultimo_acceso."'" ;  }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `usuarios_listado` (usuario, password, idTipoUsuario, idEstado, email, 
				Nombre, Rut, fNacimiento, Fono, idCiudad, idComuna, Direccion, Direccion_img, Ultimo_acceso) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					//Se genera el permiso relacionado al sistema
					if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;   }else{$a  ="''";}
					if(isset($idSistema) && $idSistema != ''){    $a .= ",'".$idSistema."'" ;  }else{$a .= ",''";}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `usuarios_sistemas` (idUsuario, idSistema) 
					VALUES ({$a} )";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
					
					//Si ejecuto correctamente la consulta
					if($resultado){
							
						header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
						die;
					}
					
					
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
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			$ndata_5 = 1;
			//Se verifica si el dato existe
			if(isset($usuario)){
				$ndata_1 = db_select_nrows ('usuario', 'usuarios_listado', '', "usuario='".$usuario."'", $dbConn);
			}
			if(isset($Nombre)&&isset($idUsuario)){
				$ndata_2 = db_select_nrows ('Nombre', 'usuarios_listado', '', "Nombre='".$Nombre."' AND idUsuario!='".$idUsuario."'", $dbConn);
			}
			if(isset($Rut)&&isset($idUsuario)){
				$ndata_3 = db_select_nrows ('Rut', 'usuarios_listado', '', "Rut='".$Rut."' AND idUsuario!='".$idUsuario."'", $dbConn);
			}
			if(isset($email)&&isset($idUsuario)){
				$ndata_4 = db_select_nrows ('email', 'usuarios_listado', '', "email='".$email."' AND idUsuario!='".$idUsuario."'", $dbConn);
			}
			if(isset($oldpassword)&&isset($idUsuario)){
				$ndata_5 = db_select_nrows ('password', 'usuarios_listado', '', "idUsuario='".$idUsuario."' AND password='".md5($oldpassword)."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de usuario ingresado ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El nombre de la persona ingresada ya existe';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El Rut ya ya existe en el sistema';}
			if($ndata_4 > 0) {$error['ndata_4'] = 'error/El email ya existe en el sistema';}
			if($ndata_5 == 0) {$error['ndata_5'] = 'error/Las contraseñas ingresadas no coinciden';}
			/*******************************************************************/

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idUsuario='".$idUsuario."'" ;
				if(isset($usuario) && $usuario != ''){              $a .= ",usuario='".$usuario."'" ;}
				if(isset($password) && $password != ''){            $a .= ",password='".md5($password)."'" ;}
				if(isset($idTipoUsuario) && $idTipoUsuario != ''){  $a .= ",idTipoUsuario='".$idTipoUsuario."'" ;}
				if(isset($idEstado) && $idEstado != ''){            $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($email) && $email != ''){                  $a .= ",email='".$email."'" ;}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Rut) && $Rut != ''){                      $a .= ",Rut='".$Rut."'" ;}
				if(isset($fNacimiento) && $fNacimiento != ''){      $a .= ",fNacimiento='".$fNacimiento."'" ;}
				if(isset($Fono) && $Fono != ''){                    $a .= ",Fono='".$Fono."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){            $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){            $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){          $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Direccion_img) && $Direccion_img != ''){  $a .= ",Direccion_img='".$Direccion_img."'" ;}
				if(isset($Ultimo_acceso) && $Ultimo_acceso != ''){  $a .= ",Ultimo_acceso='".$Ultimo_acceso."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `usuarios_listado` SET ".$a." WHERE idUsuario = '$idUsuario'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//Si se cambia la password se actualiza el dato de session
					if(isset($password) && $password != ''){
						$_SESSION['usuario']['basic_data']['password'] = md5($password);
					}
					
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
			
			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `usuarios_listado`
			WHERE idUsuario = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra al usuario de la base de datos
			$query  = "DELETE FROM `usuarios_listado` WHERE idUsuario = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			
			//se borra al usuario de la base de datos
			$query  = "DELETE FROM `usuarios_sistemas` WHERE idUsuario = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se borra los permisos del usuario de la base de datos
				$query  = "DELETE FROM `usuarios_permisos` WHERE idUsuario = {$_GET['del']}";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//se elimina el archivo
					if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['Direccion_img'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['Direccion_img']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					
					//Redirijo			
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
			
			$idUsuario  = $_GET['id'];
			$idEstado   = $_GET['estado'];
			$query  = "UPDATE usuarios_listado SET idEstado = '$idEstado'	
			WHERE idUsuario    = '$idUsuario'";
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
		case 'prm_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$id_usuario = $_GET['id'];
			$id_permiso = $_GET['prm_add'];
			$level      = '1';
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($id_usuario)&&$id_usuario!=''&&isset($id_permiso)&&$id_permiso!=''){
				$ndata_1 = db_select_nrows ('idUsuario', 'usuarios_permisos', '', "idUsuario='".$id_usuario."' AND idAdmpm='".$id_permiso."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso ya fue otorgado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_permisos` (idUsuario, idAdmpm, level) 
				VALUES ('$id_usuario','$id_permiso','$level')";
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
		//borra un permiso del usuario
		case 'prm_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/**********************************************/
			//Busco la informacion del permiso
			$query = "SELECT idUsuario, idAdmpm, level
			FROM `usuarios_permisos`
			WHERE idPermisos = {$_GET['prm_del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//Datos generados
			$idUsuario        = $rowdata['idUsuario'];
			$idAdmpm          = $rowdata['idAdmpm'];
			$level            = $rowdata['level'];	
			$idUsuario_elim   = $_SESSION['usuario']['basic_data']['idUsuario'];
			$Fecha_elim       = fecha_actual();
			$Hora_elim        = hora_actual();
			
			//filtros
			if(isset($idUsuario) && $idUsuario != ''){            $a  = "'".$idUsuario."'" ;        }else{$a  = "''";}
			if(isset($idAdmpm) && $idAdmpm != ''){                $a .= ",'".$idAdmpm."'" ;         }else{$a .= ",''";}
			if(isset($level) && $level != ''){                    $a .= ",'".$level."'" ;           }else{$a .= ",''";}
			if(isset($idUsuario_elim) && $idUsuario_elim != ''){  $a .= ",'".$idUsuario_elim."'" ;  }else{$a .= ",''";}
			if(isset($Fecha_elim) && $Fecha_elim != ''){          $a .= ",'".$Fecha_elim."'" ;      }else{$a .= ",''";}
			if(isset($Hora_elim) && $Hora_elim != ''){            $a .= ",'".$Hora_elim."'" ;       }else{$a .= ",''";}
				
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `usuarios_permisos_log` (idUsuario, idAdmpm, level, idUsuario_elim, 
			Fecha_elim, Hora_elim) 
			VALUES ({$a} )";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
					
				/**********************************************/
				//Se elimina el permiso
				$query  = "DELETE FROM `usuarios_permisos` WHERE idPermisos = {$_GET['prm_del']}";
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
		case 'prm_cat_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$id_usuario  = $_GET['id'];
			$prm_cat     = $_GET['prm_cat_add'];
			$level       = '1';
			
			//Busco todas las transacciones relacionadas con la categoria
			$arrPermisos = array();
			$query = "SELECT idAdmpm FROM `core_permisos_listado` WHERE id_pmcat = '{$prm_cat}' AND visualizacion!=9999";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrPermisos,$row );
			}
			
			//Se llaman a todos los permisos que tenga el usuario
			$arrPerUsuario = array();
			$query = "SELECT idAdmpm FROM `usuarios_permisos` WHERE idUsuario = '{$id_usuario}' ";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrPerUsuario,$row );
			}
			//creo variables temporales
			$BasesDatos = array();
			foreach ($arrPerUsuario as $pu) {	
				$BasesDatos[$pu['idAdmpm']] = 'true';
			}
			
			//Inserto los permisos
			foreach ($arrPermisos as $comp) {
				
				//creo los permisos solo si no los tiene
				if(!isset($BasesDatos[$comp['idAdmpm']]) && $BasesDatos[$comp['idAdmpm']]!='true'){
					$a  = "'".$id_usuario."'" ;  
					$a .= ",'".$comp['idAdmpm']."'" ;     
					$a .= ",'".$level."'" ;      
					
					$query  = "INSERT INTO `usuarios_permisos` (idUsuario, idAdmpm, level) 
					VALUES ($a)";
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
				
			}
			
	

			header( 'Location: '.$location );
			die;   

		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'prm_cat_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$id_usuario = $_GET['id'];
	
			//Busco todas las transacciones relacionadas con la categoria
			$arrPermisos = array();
			$query = "SELECT idAdmpm FROM `core_permisos_listado` WHERE id_pmcat = '{$_GET['prm_cat_del']}' ";
			$resultado = mysqli_query($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrPermisos,$row );
			}
			
			//Inserto los permisos
			foreach ($arrPermisos as $comp) {
				
				//Busco si el permiso fue dado
				$query = "SELECT idPermisos FROM `usuarios_permisos` WHERE idUsuario = '{$id_usuario}' AND idAdmpm = '{$comp['idAdmpm']}'";
				$resultado = mysqli_query($dbConn, $query);
				$rowdel = mysqli_fetch_assoc ($resultado);
				
				//Borro el permiso si es que lo tiene
				if(isset($rowdel['idPermisos'])&&$rowdel['idPermisos']!=''){
					$query  = "DELETE FROM `usuarios_permisos` WHERE idPermisos = {$rowdel['idPermisos']}";
					$result = mysqli_query($dbConn, $query);
				}
				
			}
			
			header( 'Location: '.$location );
			die;  

		break;	
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'bod_ins_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario = $_GET['id'];
			$idBodega   = $_GET['bod_ins_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idBodega)&&$idBodega!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idBodega', 'usuarios_bodegas_insumos', '', "idBodega='".$idBodega."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso a la bodega ya fue otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_bodegas_insumos` (idUsuario, idBodega) 
				VALUES ('$id_usuario','$idBodega')";
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
		//borra un permiso del usuario
		case 'bod_ins_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_bodegas_insumos` WHERE idBodegaPermiso = {$_GET['bod_ins_del']}";
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
		case 'bod_prod_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario = $_GET['id'];
			$idBodega   = $_GET['bod_prod_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idBodega)&&$idBodega!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idBodega', 'usuarios_bodegas_productos', '', "idBodega='".$idBodega."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso a la bodega ya fue otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_bodegas_productos` (idUsuario, idBodega) 
				VALUES ('$id_usuario','$idBodega')";
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
		//borra un permiso del usuario
		case 'bod_prod_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_bodegas_productos` WHERE idBodegaPermiso = {$_GET['bod_prod_del']}";
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
		case 'bod_arriendo_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario = $_GET['id'];
			$idBodega   = $_GET['bod_arriendo_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idBodega)&&$idBodega!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idBodega', 'usuarios_bodegas_arriendos', '', "idBodega='".$idBodega."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso a la bodega ya fue otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_bodegas_arriendos` (idUsuario, idBodega) 
				VALUES ('$id_usuario','$idBodega')";
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
		//borra un permiso del usuario
		case 'bod_arriendo_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_bodegas_arriendos` WHERE idBodegaPermiso = {$_GET['bod_arriendo_del']}";
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
		//Cambia el nivel del permiso
		case 'perm':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$mod    = $_GET['mod'];
			$perm   = $_GET['perm'];
			$query  = "UPDATE usuarios_permisos SET level = '$mod'	
			WHERE idPermisos    = '$perm'";
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
		//Cambia el nivel del permiso
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ( !empty($_POST['idUsuario']) )    $idUsuario       = $_POST['idUsuario'];
			
			if ($_FILES["imgLogo"]["error"] > 0){ 
				$error['imgLogo']     = 'error/Ha ocurrido un error'; 
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'usr_img_'.$idUsuario.'_';
							  
				if (in_array($_FILES['imgLogo']['type'], $permitidos) && $_FILES['imgLogo']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['imgLogo']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["imgLogo"]["tmp_name"], $ruta);
						if ($move_result){
											
							//Filtro para idSistema
							$a = "Direccion_img='".$sufijo.$_FILES['imgLogo']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `usuarios_listado` SET ".$a." WHERE idUsuario = '$idUsuario'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								//Seteo la variable de sesion si existe
								if(isset($_SESSION['usuario']['basic_data']['Direccion_img'])){
									$_SESSION['usuario']['basic_data']['Direccion_img'] = $sufijo.$_FILES['imgLogo']['name'];
								}

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
						} else {
							$error['imgLogo']     = 'error/Ocurrio un error al mover el archivo'; 
						}
					} else {
						$error['imgLogo']     = 'error/El archivo '.$_FILES['imgLogo']['name'].' ya existe'; 
					}
				} else {
					$error['imgLogo']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}


		break;	
/*******************************************************************************************************************/
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Usuario
			$id_usuario = $_GET['id_usuario'];
			// Se obtiene el nombre del logo
			$query = "SELECT Direccion_img
			FROM `usuarios_listado`
			WHERE idUsuario = {$id_usuario}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `usuarios_listado` SET Direccion_img='' WHERE idUsuario = '{$id_usuario}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Direccion_img'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Direccion_img']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Seteo la variable de sesion si existe
				if(isset($_SESSION['usuario']['basic_data']['Direccion_img'])){
					$_SESSION['usuario']['basic_data']['Direccion_img']='';
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id_img=true' );
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
		case 'login': 
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Elimino cualquier dato de un usuario anterior
			unset($_SESSION['usuario']);
			
			//Variables
			$fecha          = fecha_actual();
			$hora           = hora_actual();
			$Time           = time();
			$IP_Client      = obtenerIpCliente();
			$Agent_Transp   = $_SERVER['HTTP_USER_AGENT'];
			$email          = '';
				
			//Saneado de datos ingresados
			$usuario  = preg_replace("/[^a-zA-Z0-9_\-]+ñÑáéíóúÁÉÍÓÚ-_?¿°()=,.<>:;*@/","",$usuario);
			$password = preg_replace("/[^a-zA-Z0-9_\-]+ñÑáéíóúÁÉÍÓÚ-_?¿°()=,.<>:;*@/","",$password);
				
			//Se verifica si se trata de hacer fuerza bruta en el ingreso
			if (checkbrute($usuario, $email, $IP_Client, 'usuarios_checkbrute', $dbConn) == true) {
				$error['checkbrute']  = 'error/Demasiados accesos fallidos, usuario bloqueado por 2 horas'; 
			}
			
			//Si es una maquina la que esta tratando de entrar
			if(isset($fkinput1)&&$fkinput1!=''){
				//muestro el error
				$error['checkbrute']  = 'error/Ingreso de maquina';
				
				//Inserto el error
				$query  = "INSERT INTO `usuarios_checkbrute` (Fecha, Hora, usuario, email, IP_Client, Agent_Transp, Time) VALUES ('{$fecha}','{$hora}','{$usuario}','{$email}','{$IP_Client}','{$Agent_Transp}','{$Time}' )";
				$resultado = mysqli_query($dbConn, $query);
			}
			//Si es una maquina la que esta tratando de entrar
			if(isset($fkinput2)&&$fkinput2!=''){
				//muestro el error
				$error['checkbrute']  = 'error/Ingreso de maquina';
				
				//Inserto el error
				$query  = "INSERT INTO `usuarios_checkbrute` (Fecha, Hora, usuario, email, IP_Client, Agent_Transp, Time) VALUES ('{$fecha}','{$hora}','{$usuario}','{$email}','{$IP_Client}','{$Agent_Transp}','{$Time}' )";
				$resultado = mysqli_query($dbConn, $query);
			}
					
					
			//si no hay errores
			if ( empty($error) ) {
						
				//Busco al usuario en el sistema
				$query = "SELECT 
				usuarios_listado.idUsuario, 
				usuarios_listado.idUsuario AS ID,
				usuarios_listado.password, 
				usuarios_listado.usuario, 
				usuarios_listado.Nombre, 
				usuarios_listado.idEstado,
				usuarios_listado.Direccion_img, 
				usuarios_listado.idTipoUsuario,
				usuarios_tipos.Nombre AS Usuario_Tipo,
				(SELECT count(idPermisoSistema) FROM usuarios_sistemas WHERE idUsuario=ID) AS COunt

				FROM `usuarios_listado` 
				LEFT JOIN `usuarios_tipos`    ON usuarios_tipos.idTipoUsuario   = usuarios_listado.idTipoUsuario
				
				WHERE usuarios_listado.usuario = '".$usuario."' AND usuarios_listado.password = '".md5($password)."' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowUser = mysqli_fetch_array($resultado);
				
				//Busco al usuario en el sistema
				$query = "SELECT Fecha, Hora
				FROM `usuarios_accesos` 
				WHERE idUsuario = '".$rowUser['idUsuario']."'
				ORDER BY idAcceso DESC
				LIMIT 1";
				$resultado = mysqli_query($dbConn, $query);
				$rowAcceso = mysqli_fetch_array($resultado);

				//Se verifca si los datos ingresados son de un usuario
				if (isset($rowUser['idUsuario'])&&$rowUser['idUsuario']!='') {
					
					//Verifico que el usuario identificado este activo
					if($rowUser['idEstado']==1){
						
						//Actualizo la tabla de los usuarios
						$query = "UPDATE usuarios_listado SET Ultimo_acceso='".$fecha."', IP_Client='".$IP_Client."', Agent_Transp='".$Agent_Transp."' WHERE idUsuario='".$rowUser['idUsuario']."' ";
						$resultado = mysqli_query($dbConn, $query);
						
						//Inserto la fecha con el ingreso
						$query  = "INSERT INTO `usuarios_accesos` (idUsuario,Fecha, Hora, IP_Client, Agent_Transp) VALUES ({$rowUser['idUsuario']},'{$fecha}','{$hora}','{$IP_Client}','{$Agent_Transp}' )";
						$resultado = mysqli_query($dbConn, $query);
					
						//Se crean las variables con todos los datos
						$_SESSION['usuario']['basic_data']['idUsuario']          = $rowUser['idUsuario'];
						$_SESSION['usuario']['basic_data']['password']           = $rowUser['password'];
						$_SESSION['usuario']['basic_data']['usuario']            = $rowUser['usuario'];
						$_SESSION['usuario']['basic_data']['Nombre']             = $rowUser['Nombre'];
						$_SESSION['usuario']['basic_data']['Direccion_img']      = $rowUser['Direccion_img'];
						$_SESSION['usuario']['basic_data']['idTipoUsuario']      = $rowUser['idTipoUsuario'];
						$_SESSION['usuario']['basic_data']['Usuario_Tipo']       = $rowUser['Usuario_Tipo'];
						$_SESSION['usuario']['basic_data']['FechaLogin']         = $rowAcceso['Fecha'];
						$_SESSION['usuario']['basic_data']['HoraLogin']          = $rowAcceso['Hora'];
						$_SESSION['usuario']['basic_data']['COunt']              = $rowUser['COunt'];

						//Se buscan los datos para crear el menu
						$arrMenu = array();
						//Si el usuario es un super usuario
						if($rowUser['idTipoUsuario']==1){
							//se traen todos los permisos existentes
							$query = "SELECT 
							core_permisos_categorias.Nombre AS CategoriaNombre, 
							core_font_awesome.Codigo AS CategoriaIcono,
							core_permisos_listado.Direccionbase AS TransaccionURLBase,
							core_permisos_listado.Direccionweb AS TransaccionURL, 
							core_permisos_listado.Nombre AS TransaccionNombre
							
							
							FROM core_permisos_listado 
							INNER JOIN core_permisos_categorias  ON core_permisos_categorias.id_pmcat  = core_permisos_listado.id_pmcat 
							LEFT JOIN `core_font_awesome`        ON core_font_awesome.idFont           = core_permisos_categorias.idFont
							ORDER BY CategoriaNombre, TransaccionNombre ASC";
						//Si el usuario es un usuario normal
						}else{
							$query = "SELECT 
							core_permisos_categorias.Nombre AS CategoriaNombre, 
							core_font_awesome.Codigo AS CategoriaIcono,
							core_permisos_listado.Direccionbase AS TransaccionURLBase,
							core_permisos_listado.Direccionweb AS TransaccionURL, 
							core_permisos_listado.Nombre AS TransaccionNombre,
							
							usuarios_permisos.level
							
							
							FROM usuarios_permisos 
							INNER JOIN core_permisos_listado      ON core_permisos_listado.idAdmpm        = usuarios_permisos.idAdmpm
							INNER JOIN core_permisos_categorias   ON core_permisos_categorias.id_pmcat    = core_permisos_listado.id_pmcat 
							LEFT JOIN `core_font_awesome`         ON core_font_awesome.idFont             = core_permisos_categorias.idFont
							WHERE usuarios_permisos.idUsuario = ".$rowUser['idUsuario']."
							ORDER BY CategoriaNombre, TransaccionNombre ASC";
						}
						$resultado = mysqli_query($dbConn, $query);
						while ( $row = mysqli_fetch_assoc ($resultado)) {
						array_push( $arrMenu,$row );
						}
						
						//Permisos
						foreach($arrMenu as $menu) {
							$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['CategoriaNombre']     = $menu['CategoriaNombre'];
							$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['CategoriaIcono']      = $menu['TransaccionURL'];
							$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['TransaccionNombre']   = $menu['TransaccionNombre'];
							//Si es un superadmin se resetean los permisos al maximo
							if($rowUser['idTipoUsuario']==1){
								$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['level']   = 4;
							//Si no es superadmin, se heredan de la base de datos
							}else{
								$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['level']   = $menu['level'];
							}
						}
						
						//Construccion de los menus del sistema
						//llamamos a la función para filtrar los datos
						filtrar($arrMenu, 'CategoriaNombre');
						/******************************************************************/
						//recorremos el array para imprimirlo con formato HTML
						foreach($arrMenu as $Categorias=>$Transacciones) {
							
							$ntranx = 0;			
							// recorremos los productos
							foreach($Transacciones as $transaccion) {
								
								$_SESSION['usuario']['menu'][$Categorias][$ntranx]['CategoriaNombre']    = $Categorias;
								$_SESSION['usuario']['menu'][$Categorias][$ntranx]['CategoriaIcono']     = $transaccion['CategoriaIcono'];
								$_SESSION['usuario']['menu'][$Categorias][$ntranx]['TransaccionURL']     = $transaccion['TransaccionURL'];
								$_SESSION['usuario']['menu'][$Categorias][$ntranx]['TransaccionNombre']  = $transaccion['TransaccionNombre'];
								
								$ntranx++;
							}
							   
						}
						
						
						//Si el usuario es un super usuario
						if($rowUser['idTipoUsuario']==1){
							
							//Redirijo a la pagina de seleccion
							header( 'Location: index_select.php' );
							die;
							
						//Si el usuario es un usuario normal
						}else{
							
							/******************************************************************/
							//Verifico la cantidad de sistemas a la cual tiene permitido el acceso
							$query = "SELECT 
							COUNT(idPermisoSistema) AS Sistemas
							FROM `usuarios_sistemas`
							LEFT JOIN `core_sistemas`  ON core_sistemas.idSistema  = usuarios_sistemas.idSistema
							WHERE usuarios_sistemas.idUsuario = ".$rowUser['idUsuario']."
							AND core_sistemas.idEstado=1";
							$resultado = mysqli_query($dbConn, $query);
							$rowSis = mysqli_fetch_array($resultado);
					
					
							//Si no tiene sistemas relacionados
							if(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']==0){
								$error['idUsuario']   = 'error/No tiene sistemas asignados, Contactese con el administrador y solicite el acceso';
							
							//Si tiene solo un sistema asignado
							}elseif(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']==1){
								
								//Verifico la cantidad de sistemas a la cual tiene permitido el acceso
								//$query = "SELECT idSistema FROM `usuarios_sistemas` WHERE idUsuario = '".$rowUser['idUsuario']."' ";
								$query = "SELECT 
								usuarios_sistemas.idSistema
								FROM `usuarios_sistemas`
								LEFT JOIN `core_sistemas`  ON core_sistemas.idSistema  = usuarios_sistemas.idSistema
								WHERE usuarios_sistemas.idUsuario = ".$rowUser['idUsuario']."
								AND core_sistemas.idEstado=1";
								$resultado = mysqli_query($dbConn, $query);
								$rowSystem = mysqli_fetch_array($resultado);
							
								$query = "SELECT 
								core_sistemas.Config_idTheme,
								core_sistemas.Config_imgLogo,
								core_sistemas.Config_IDGoogle,
								core_sistemas.idOpcionesGen_8,
								core_sistemas.Nombre AS RazonSocial,
								core_config_ram.Nombre AS ConfigRam,
								core_config_time.Nombre AS ConfigTime

								FROM `core_sistemas` 
								LEFT JOIN `core_config_ram`   ON core_config_ram.idConfigRam    = core_sistemas.idConfigRam
								LEFT JOIN `core_config_time`  ON core_config_time.idConfigTime  = core_sistemas.idConfigTime
								
								WHERE core_sistemas.idSistema = '".$rowSystem['idSistema']."' ";
								$resultado = mysqli_query($dbConn, $query);
								$rowSistema = mysqli_fetch_array($resultado);
								
								//Se crean las variables con todos los datos
								$_SESSION['usuario']['basic_data']['Config_idTheme']     = $rowSistema['Config_idTheme'];
								$_SESSION['usuario']['basic_data']['Config_imgLogo']     = $rowSistema['Config_imgLogo'];
								$_SESSION['usuario']['basic_data']['Config_IDGoogle']    = $rowSistema['Config_IDGoogle'];
								$_SESSION['usuario']['basic_data']['RazonSocial']        = $rowSistema['RazonSocial'];
								$_SESSION['usuario']['basic_data']['ConfigRam']          = $rowSistema['ConfigRam'];
								$_SESSION['usuario']['basic_data']['ConfigTime']         = $rowSistema['ConfigTime'];
								$_SESSION['usuario']['basic_data']['CorreoInterno']      = $rowSistema['idOpcionesGen_8'];
								$_SESSION['usuario']['basic_data']['idSistema']          = $rowSystem['idSistema'];
								
								//Redirijo a la pagina principal
								header( 'Location: principal.php' );
								die;
							
							//Si tiene mas de uno, se redirije a una pantalla de seleccion
							}elseif(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']>1){
								//Redirijo a la pagina de seleccion
								header( 'Location: index_select.php' );
								die;
							}

						}	
						
						
					//Si no esta activo envio error	
					}else{
						$error['idUsuario']   = 'error/Su usuario esta desactivado, Contactese con el administrador';
					}
				
				//Si no se encuentra ningun usuario se envia un error	
				}else{
					$error['idUsuario']   = 'error/El nombre de usuario o contraseña no coinciden';
					
					//Inserto el error
					$query  = "INSERT INTO `usuarios_checkbrute` (Fecha, Hora, usuario, email, IP_Client, Agent_Transp, Time) VALUES ('{$fecha}','{$hora}','{$usuario}','{$email}','{$IP_Client}','{$Agent_Transp}','{$Time}' )";
					$resultado = mysqli_query($dbConn, $query);
					
				}
						
			} 
		break;
/*******************************************************************************************************************/		
		case 'getpass':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$fecha          = fecha_actual();
			$hora           = hora_actual();
			$Time           = time();
			$IP_Client      = obtenerIpCliente();
			$Agent_Transp   = $_SERVER['HTTP_USER_AGENT'];
			$usuario        = '';
			$password       = '';
				
			//Saneado de datos ingresados
			$email = preg_replace("/[^a-zA-Z0-9_\-]+ñÑáéíóúÁÉÍÓÚ-_?¿°()=,.<>:;*@/","",$email);
				
			//Se verifica si se trata de hacer fuerza bruta en el ingreso
			if (checkbrute($usuario, $email, $IP_Client, 'usuarios_checkbrute', $dbConn) == true) {
				$error['checkbrute']  = 'error/Demasiados accesos fallidos, correo bloqueado por 2 horas'; 
			}
			//se verifica que se haya ingresado el correo
			if(!isset($email) or $email==''){
				$error['email']  = 'error/No ha ingresado un correo'; 
			}
			
			//Si es una maquina la que esta tratando de entrar
			if(isset($fkinput1)&&$fkinput1!=''){
				//muestro el error
				$error['checkbrute']  = 'error/Ingreso de maquina';
				
				//Inserto el error
				$query  = "INSERT INTO `usuarios_checkbrute` (Fecha, Hora, usuario, email, IP_Client, Agent_Transp, Time) VALUES ('{$fecha}','{$hora}','{$usuario}','{$email}','{$IP_Client}','{$Agent_Transp}','{$Time}' )";
				$resultado = mysqli_query($dbConn, $query);
			}
			//Si es una maquina la que esta tratando de entrar
			if(isset($fkinput2)&&$fkinput2!=''){
				//muestro el error
				$error['checkbrute']  = 'error/Ingreso de maquina';
				
				//Inserto el error
				$query  = "INSERT INTO `usuarios_checkbrute` (Fecha, Hora, usuario, email, IP_Client, Agent_Transp, Time) VALUES ('{$fecha}','{$hora}','{$usuario}','{$email}','{$IP_Client}','{$Agent_Transp}','{$Time}' )";
				$resultado = mysqli_query($dbConn, $query);
			}
			
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//traigo los datos almacenados
				$query = "SELECT Nombre, email_principal	
				FROM `core_sistemas` 
				WHERE idSistema=1";	
				$resultado = mysqli_query($dbConn, $query);
				$rowSistema = mysqli_fetch_assoc ($resultado);
				
				//traigo los datos almacenados
				$query = "SELECT email	
				FROM `usuarios_listado` 
				WHERE email='".$email."'  ";	
				$resultado = mysqli_query($dbConn, $query);
				$rowusr = mysqli_fetch_assoc ($resultado);
				$cuenta_registros = mysqli_num_rows($resultado);
				
				//verifico si los datos ingresados son iguales a los almacenados
				if(isset($cuenta_registros)&&$cuenta_registros!=''&&$cuenta_registros!=0){  
					
					//Generacion de nueva clave
					$num_caracteres = "10"; //cantidad de caracteres de la clave
					$clave = substr(md5(rand()),0,$num_caracteres); //generador aleatorio de claves 
					$nueva_clave = md5($clave);//se codifica la clave 
						
					//Actualizacion de la clave en la base de datos
					$query  = "UPDATE `usuarios_listado` SET password='".$nueva_clave."' WHERE email='".$email."'  ";
					$result = mysqli_query($dbConn, $query);
					
					//Carga de la libreria de envio de correos
					require_once '../LIBS_php/PHPMailer/PHPMailerAutoload.php';	
					//Instanciacion
					$mail = new PHPMailer;
					//Quien envia el correo
					$mail->setFrom($rowSistema['email_principal'], $rowSistema['RazonSocial']);
					//A quien responder el correo
					$mail->addReplyTo($rowSistema['email_principal'], $rowSistema['RazonSocial']);
					//Destinatarios
					$mail->addAddress($email, 'Receptor');
					//Asunto
					$mail->Subject = 'Cambio de password';
					//Cuerpo del mensaje
					$mail->msgHTML('<p>Se ha generado una nueva contraseña para el usuario '.$email.', su nueva contraseña es: '.$nueva_clave.'</p>');
					//Datos Adjuntos
					//$mail->addAttachment('images/phpmailer_mini.png');
					//Envio del mensaje
					if (!$mail->send()) {
						$error['email'] 	  = 'error/'.$mail->ErrorInfo;
						//echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						//echo "Message sent!";
						$error['email'] 	  = 'sucess/La nueva contraseña fue enviada a tu correo';
	
					}
				
				//Si no se encuentra ningun usuario se envia un error	
				}else{	
					$error['email'] 	  = 'error/El email ingresado no existe';
				
					//Inserto el error
					$query  = "INSERT INTO `usuarios_checkbrute` (Fecha, Hora, usuario, email, IP_Client, Agent_Transp, Time) VALUES ('{$fecha}','{$hora}','{$usuario}','{$email}','{$IP_Client}','{$Agent_Transp}','{$Time}' )";
					$resultado = mysqli_query($dbConn, $query);
					
				}
			

					
			}

		break;	
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'equipo_tel_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario     = $_GET['id'];
			$idTelemetria   = $_GET['equipo_tel_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTelemetria)&&$idTelemetria!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idTelemetria', 'usuarios_equipos_telemetria', '', "idTelemetria='".$idTelemetria."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso al equipo ya fue otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_equipos_telemetria` (idUsuario, idTelemetria) 
				VALUES ('$id_usuario','$idTelemetria')";
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
		//borra un permiso del usuario
		case 'equipo_tel_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_equipos_telemetria` WHERE idEquipoTelPermiso = {$_GET['equipo_tel_del']}";
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
		case 'doc_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario  = $_GET['id'];
			$idDocPago   = $_GET['doc_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idDocPago)&&$idDocPago!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idDocPago', 'usuarios_documentos_pago', '', "idDocPago='".$idDocPago."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso al documento ya fue otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_documentos_pago` (idUsuario, idDocPago) 
				VALUES ('$id_usuario','$idDocPago')";
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
		//borra un permiso del usuario
		case 'doc_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_documentos_pago` WHERE idDocPagoPermiso = {$_GET['doc_del']}";
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
		//se clona al usuario
		case 'clone_Usuario':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($usuario)){
				$ndata_1 = db_select_nrows ('usuario', 'usuarios_listado', '', "usuario='".$usuario."'", $dbConn);
			}
			/*if(isset($email)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('email', 'usuarios_listado', '', "email='".$email."'", $dbConn);
			}*/
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de usuario ingresado ya existe';}
			/*if($ndata_2 > 0) {$error['ndata_4'] = 'error/El email ya existe en el sistema';}*/
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*******************************************************************/
				//Consultas
				//Datos
				$query = "SELECT idTipoUsuario, Nombre, Rut, fNacimiento, Fono, idCiudad, idComuna, Direccion
				FROM `usuarios_listado` 
				WHERE idUsuario='".$idUsuario."'  ";	
				$resultado = mysqli_query($dbConn, $query);
				$rowusr = mysqli_fetch_assoc ($resultado);
				//sistemas asignados
				$arrSistemas = array();
				$query = "SELECT idSistema
				FROM `usuarios_sistemas`
				WHERE idUsuario='".$idUsuario."'  ";	
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrSistemas,$row );
				}
				//Permisos asignados
				$arrPermisos = array();
				$query = "SELECT idAdmpm, level
				FROM `usuarios_permisos`
				WHERE idUsuario='".$idUsuario."'  ";	
				$resultado = mysqli_query($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrPermisos,$row );
				}
			
				/*******************************************************************/
				//Variables
				$password        = 1234;
				$idTipoUsuario   = $rowusr['idTipoUsuario'];
				$idEstado        = 1;
				$Nombre          = $rowusr['Nombre'];
				$Rut             = $rowusr['Rut'];
				$fNacimiento     = $rowusr['fNacimiento'];
				$Fono            = $rowusr['Fono'];
				$idCiudad        = $rowusr['idCiudad'];
				$idComuna        = $rowusr['idComuna'];
				$Direccion       = $rowusr['Direccion'];
				
				/*******************************************************************/
				/*******************************************************************/
				//filtros
				if(isset($usuario) && $usuario != ''){              $a  = "'".$usuario."'" ;         }else{$a  ="''";}
				if(isset($password) && $password != ''){            $a .= ",'".md5($password)."'" ;  }else{$a .= ",''";}
				if(isset($idTipoUsuario) && $idTipoUsuario != ''){  $a .= ",'".$idTipoUsuario."'" ;  }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){            $a .= ",'".$idEstado."'" ;       }else{$a .= ",''";}
				if(isset($email) && $email != ''){                  $a .= ",'".$email."'" ;          }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",'".$Nombre."'" ;         }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                      $a .= ",'".$Rut."'" ;            }else{$a .= ",''";}
				if(isset($fNacimiento) && $fNacimiento != ''){      $a .= ",'".$fNacimiento."'" ;    }else{$a .= ",''";}
				if(isset($Fono) && $Fono != ''){                    $a .= ",'".$Fono."'" ;           }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){            $a .= ",'".$idCiudad."'" ;       }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){            $a .= ",'".$idComuna."'" ;       }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){          $a .= ",'".$Direccion."'" ;      }else{$a .= ",''";}
				if(isset($Direccion_img) && $Direccion_img != ''){  $a .= ",'".$Direccion_img."'" ;  }else{$a .= ",''";}
				if(isset($Ultimo_acceso) && $Ultimo_acceso != ''){  $a .= ",'".$Ultimo_acceso."'" ;  }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `usuarios_listado` (usuario, password, idTipoUsuario, idEstado, email, 
				Nombre, Rut, fNacimiento, Fono, idCiudad, idComuna, Direccion, Direccion_img, Ultimo_acceso) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					/*******************************************************************/
					/*******************************************************************/
					//Se copian los sistemas
					foreach ($arrSistemas as $sis) {
						//Variables
						$idUsuario  = $ultimo_id;
						$idSistema  = $sis['idSistema'];
						
						//filtros
						if(isset($idUsuario) && $idUsuario != ''){  $a  = "'".$idUsuario."'" ;  }else{$a  ="''";}
						if(isset($idSistema) && $idSistema != ''){  $a .= ",'".$idSistema."'" ; }else{$a .= ",''";}
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `usuarios_sistemas` (idUsuario, idSistema) 
						VALUES ({$a} )";
						$result = mysqli_query($dbConn, $query);
					}
					/*******************************************************************/
					//Se copian los permisos
					foreach ($arrPermisos as $perm) {
						//Variables
						$idUsuario  = $ultimo_id;
						$idAdmpm    = $perm['idAdmpm'];
						$level      = $perm['level'];
					
						//filtros
						if(isset($idUsuario) && $idUsuario != ''){  $a  = "'".$idUsuario."'" ;  }else{$a  ="''";}
						if(isset($idAdmpm) && $idAdmpm != ''){      $a .= ",'".$idAdmpm."'" ;   }else{$a .= ",''";}
						if(isset($level) && $level != ''){          $a .= ",'".$level."'" ;     }else{$a .= ",''";}
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `usuarios_permisos` (idUsuario, idAdmpm, level) 
						VALUES ({$a} )";
						$result = mysqli_query($dbConn, $query);
					}
					
					
						
					header( 'Location: '.$location.'&clone=true' );
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
		//Agrega un permiso al usuario
		case 'contrato_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario     = $_GET['id'];
			$idLicitacion   = $_GET['contrato_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idLicitacion)&&$idLicitacion!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idLicitacion', 'usuarios_contratos', '', "idLicitacion='".$idLicitacion."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso al contrato ya ha sido otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_contratos` (idUsuario, idLicitacion) 
				VALUES ('$id_usuario','$idLicitacion')";
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
		//borra un permiso del usuario
		case 'contrato_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_contratos` WHERE idContratoPermiso = {$_GET['contrato_del']}";
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
		case 'caja_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario  = $_GET['id'];
			$idCajaChica = $_GET['caja_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCajaChica)&&$idCajaChica!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idCajaChica', 'usuarios_cajas_chicas', '', "idCajaChica='".$idCajaChica."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso a la caja chica ya ha sido otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_cajas_chicas` (idUsuario, idCajaChica) 
				VALUES ('$id_usuario','$idCajaChica')";
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
		//borra un permiso del usuario
		case 'caja_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_cajas_chicas` WHERE idCajaPermiso = {$_GET['caja_del']}";
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
		//se dan permisos al usuario
		case 'prm_add_all_bodegas':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico permisos a las transacciones de bodegas
			/******************************************************/
			//Accesos a bodegas de productos
			$trans_1 = "bodegas_productos_egreso.php";
			$trans_2 = "bodegas_productos_ingreso.php";
			$trans_3 = "bodegas_productos_simple_stock.php";
			$trans_4 = "bodegas_productos_stock.php";

			//Accesos a bodegas de productos
			$trans_5 = "bodegas_arriendos_egreso.php";
			$trans_6 = "bodegas_arriendos_ingreso.php";

			//Accesos a bodegas de insumos
			$trans_10 = "bodegas_insumos_egreso.php";
			$trans_11 = "bodegas_insumos_ingreso.php";
			$trans_12 = "bodegas_insumos_simple_stock.php";
			$trans_13 = "bodegas_insumos_stock.php";

			//realizo la consulta
			$query = "SELECT

			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_1."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_1,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_2."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_2,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_3."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_3,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_4."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_4,

			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_5."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_5,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_6."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_6,

			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_10."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_10,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_11."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_11,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_12."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_12,
			(SELECT COUNT(usuarios_permisos.idAdmpm) FROM usuarios_permisos INNER JOIN  core_permisos_listado ON core_permisos_listado.idAdmpm = usuarios_permisos.idAdmpm WHERE core_permisos_listado.Direccionbase ='".$trans_13."'  AND usuarios_permisos.idUsuario='".$_GET['id']."' LIMIT 1) AS tran_13


			FROM usuarios_listado
			WHERE usuarios_listado.idUsuario='".$_GET['id']."' "; 
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
			$rowdatax = mysqli_fetch_assoc ($resultado);


			$productos    = $rowdatax['tran_1'] + $rowdatax['tran_2'] + $rowdatax['tran_3'] + $rowdatax['tran_4'];
			$insumos      = $rowdatax['tran_10'] + $rowdatax['tran_11'] + $rowdatax['tran_12'] + $rowdatax['tran_13'];
			$arriendos    = $rowdatax['tran_5'] + $rowdatax['tran_6'];

			//Verifico que tenga permisos para ver la transaccion de bodega insumos
			if($insumos!=0){
				$arrInsumos = array();
				$query = "SELECT 
				bodegas_insumos_listado.idBodega,
				(SELECT COUNT(idBodegaPermiso) FROM usuarios_bodegas_insumos WHERE idBodega = bodegas_insumos_listado.idBodega AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
				FROM `bodegas_insumos_listado`
				WHERE bodegas_insumos_listado.idSistema = {$_GET['idSistema']}
				ORDER BY bodegas_insumos_listado.idSistema ASC, bodegas_insumos_listado.Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrInsumos,$row );
				}
			}

			//Verifico que tenga permisos para ver la transaccion de bodega productos
			if($productos!=0){
				$arrProductos = array();
				$query = "SELECT 
				bodegas_productos_listado.idBodega,
				(SELECT COUNT(idBodegaPermiso) FROM usuarios_bodegas_productos WHERE idBodega = bodegas_productos_listado.idBodega AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
				FROM `bodegas_productos_listado`
				WHERE bodegas_productos_listado.idSistema = {$_GET['idSistema']}
				ORDER BY bodegas_productos_listado.idSistema ASC, bodegas_productos_listado.Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrProductos,$row );
				}
			}
			//Verifico que tenga permisos para ver la transaccion de bodega productos
			if($arriendos!=0){
				$arrArriendos = array();
				$query = "SELECT 
				bodegas_arriendos_listado.idBodega,
				(SELECT COUNT(idBodegaPermiso) FROM usuarios_bodegas_arriendos WHERE idBodega = bodegas_arriendos_listado.idBodega AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
				FROM `bodegas_arriendos_listado`
				WHERE bodegas_arriendos_listado.idSistema = {$_GET['idSistema']}
				ORDER BY bodegas_arriendos_listado.idSistema ASC, bodegas_arriendos_listado.Nombre ASC";
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
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrArriendos,$row );
				}
			}			
			
			/****************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************************************/
				//Se entregan los permisos relacionados a la bodega de insumos
				if($insumos!=0){
					foreach ($arrInsumos as $ins) {
						//Si no se ha entregado el permiso
						if ( $ins['contar']!='1' ) {
							$query  = "INSERT INTO `usuarios_bodegas_insumos` (idUsuario, idBodega) 
							VALUES ('".$_GET['idUsuario']."','".$ins['idBodega']."')";
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
					}
				}
				/************************************************************************************/
				//Se entregan los permisos relacionados a la bodega de productos
				if($productos!=0){
					foreach ($arrProductos as $prod) {
						//Si no se ha entregado el permiso
						if ( $prod['contar']!='1' ) {
							$query  = "INSERT INTO `usuarios_bodegas_productos` (idUsuario, idBodega) 
							VALUES ('".$_GET['idUsuario']."','".$prod['idBodega']."')";
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
					}
				}
				/************************************************************************************/
				//Se entregan los permisos relacionados a la bodega de arriendos
				if($arriendos!=0){
					foreach ($arrArriendos as $arri) {
						//Si no se ha entregado el permiso
						if ( $arri['contar']!='1' ) {
							$query  = "INSERT INTO `usuarios_bodegas_arriendos` (idUsuario, idBodega) 
							VALUES ('".$_GET['idUsuario']."','".$arri['idBodega']."')";
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
					}
				}
				
				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
								
			}

		break;
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_del_all_bodegas':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_bodegas_insumos` WHERE idUsuario = {$_GET['idUsuario']}";
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
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_bodegas_productos` WHERE idUsuario = {$_GET['idUsuario']}";
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
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_bodegas_arriendos` WHERE idUsuario = {$_GET['idUsuario']}";
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
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;	
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_add_all_cajas':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico permisos a las transacciones 
			$arrCajas = array();
			$query = "SELECT 
			caja_chica_listado.idCajaChica,
			(SELECT COUNT(idCajaChica) FROM usuarios_cajas_chicas WHERE idCajaChica = caja_chica_listado.idCajaChica AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
			FROM `caja_chica_listado`
			WHERE caja_chica_listado.idSistema = {$_GET['idSistema']}
			ORDER BY caja_chica_listado.idSistema ASC, caja_chica_listado.Nombre ASC";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrCajas,$row );
			}
		
		
			
			/****************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************************************/
				//Se entregan los permisos relacionados a la caja
				foreach ($arrCajas as $caja) {
					//Si no se ha entregado el permiso
					if ( $caja['contar']!='1' ) {
						$query  = "INSERT INTO `usuarios_cajas_chicas` (idUsuario, idCajaChica) 
						VALUES ('".$_GET['idUsuario']."','".$caja['idCajaChica']."')";
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
				}
				
				
				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
								
			}

		break;
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_del_all_cajas':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_cajas_chicas` WHERE idUsuario = {$_GET['idUsuario']}";
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
			
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;	
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_add_all_contratos':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico permisos a las transacciones 
			$arrContratos = array();
			$query = "SELECT 
			licitacion_listado.idLicitacion,
			(SELECT COUNT(idLicitacion) FROM usuarios_contratos WHERE idLicitacion = licitacion_listado.idLicitacion AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
			FROM `licitacion_listado`
			WHERE licitacion_listado.idSistema = {$_GET['idSistema']} AND licitacion_listado.idEstado=1
			ORDER BY licitacion_listado.idSistema ASC, licitacion_listado.Nombre ASC";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContratos,$row );
			}
		
		
			
			/****************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************************************/
				//Se entregan los permisos relacionados a la caja
				foreach ($arrContratos as $cont) {
					//Si no se ha entregado el permiso
					if ( $cont['contar']!='1' ) {
						$query  = "INSERT INTO `usuarios_contratos` (idUsuario, idLicitacion) 
						VALUES ('".$_GET['idUsuario']."','".$cont['idLicitacion']."')";
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
				}
				
				
				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
								
			}

		break;
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_del_all_contratos':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_contratos` WHERE idUsuario = {$_GET['idUsuario']}";
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
			
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;	
		
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_add_all_tel':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico permisos a las transacciones 
			$arrContratos = array();
			$query = "SELECT 
			telemetria_listado.idTelemetria,
			(SELECT COUNT(idTelemetria) FROM usuarios_equipos_telemetria WHERE idTelemetria = telemetria_listado.idTelemetria AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
			FROM `telemetria_listado`
			WHERE telemetria_listado.idSistema = {$_GET['idSistema']} AND telemetria_listado.idEstado=1
			ORDER BY telemetria_listado.idSistema ASC, telemetria_listado.Nombre ASC";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContratos,$row );
			}
		
		
			
			/****************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************************************/
				//Se entregan los permisos relacionados a la caja
				foreach ($arrContratos as $cont) {
					//Si no se ha entregado el permiso
					if ( $cont['contar']!='1' ) {
						$query  = "INSERT INTO `usuarios_equipos_telemetria` (idUsuario, idTelemetria) 
						VALUES ('".$_GET['idUsuario']."','".$cont['idTelemetria']."')";
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
				}
				
				
				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
								
			}

		break;
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_del_all_tel':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_equipos_telemetria` WHERE idUsuario = {$_GET['idUsuario']}";
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
			
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;	
/*******************************************************************************************************************/		
		case 'login_alt': 
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$fecha          = fecha_actual();
			
	
			//si no hay errores
			if ( empty($error) ) {
				
				/******************************************************************/
				//Verifico la cantidad de sistemas a la cual tiene permitido el acceso
				$query = "SELECT COUNT(idPermisoSistema) AS Sistemas FROM `usuarios_sistemas` WHERE idUsuario = '".$idUsuario."' ";
				$resultado = mysqli_query($dbConn, $query);
				$rowSis = mysqli_fetch_array($resultado);
					
				//Si no tiene sistemas relacionados
				if(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']==0){
					$error['idUsuario']   = 'error/Este usuario no tiene sistemas asignados';
							
				//Si tiene solo un sistema asignado
				}elseif(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']!=0){
					
					//Elimino cualquier dato de un usuario anterior
					unset($_SESSION['usuario']);
					
					//Busco al usuario en el sistema
					$query = "SELECT 
					usuarios_listado.idUsuario,  
					usuarios_listado.idUsuario AS ID,
					usuarios_listado.password, 
					usuarios_listado.usuario, 
					usuarios_listado.Nombre, 
					usuarios_listado.idEstado,
					usuarios_listado.Direccion_img, 
					usuarios_listado.idTipoUsuario,
					usuarios_tipos.Nombre AS Usuario_Tipo,
					(SELECT count(idPermisoSistema) FROM usuarios_sistemas WHERE idUsuario=ID) AS COunt

					FROM `usuarios_listado` 
					LEFT JOIN `usuarios_tipos`    ON usuarios_tipos.idTipoUsuario   = usuarios_listado.idTipoUsuario
					
					WHERE usuarios_listado.idUsuario = '".$idUsuario."' ";
					$resultado = mysqli_query($dbConn, $query);
					$rowUser = mysqli_fetch_array($resultado);
					
					//Busco al usuario en el sistema
					$query = "SELECT Fecha, Hora
					FROM `usuarios_accesos` 
					WHERE idUsuario = '".$rowUser['idUsuario']."'
					ORDER BY idAcceso DESC
					LIMIT 1";
					$resultado = mysqli_query($dbConn, $query);
					$rowAcceso = mysqli_fetch_array($resultado);
					
					//Se verifca si los datos ingresados son de un usuario
					if (isset($rowUser['idUsuario'])&&$rowUser['idUsuario']!='') {
						
						//Verifico que el usuario identificado este activo
						if($rowUser['idEstado']==1){
							
							//Se crean las variables con todos los datos
							$_SESSION['usuario']['basic_data']['idUsuario']          = $rowUser['idUsuario'];
							$_SESSION['usuario']['basic_data']['password']           = $rowUser['password'];
							$_SESSION['usuario']['basic_data']['usuario']            = $rowUser['usuario'];
							$_SESSION['usuario']['basic_data']['Nombre']             = $rowUser['Nombre'];
							$_SESSION['usuario']['basic_data']['Direccion_img']      = $rowUser['Direccion_img'];
							$_SESSION['usuario']['basic_data']['idTipoUsuario']      = $rowUser['idTipoUsuario'];
							$_SESSION['usuario']['basic_data']['Usuario_Tipo']       = $rowUser['Usuario_Tipo'];
							$_SESSION['usuario']['basic_data']['FechaLogin']         = $rowAcceso['Fecha'];
							$_SESSION['usuario']['basic_data']['HoraLogin']          = $rowAcceso['Hora'];
							$_SESSION['usuario']['basic_data']['COunt']              = $rowUser['COunt'];
							
							//Se buscan los datos para crear el menu
							$arrMenu = array();
							$query = "SELECT 
							core_permisos_categorias.Nombre AS CategoriaNombre, 
							core_font_awesome.Codigo AS CategoriaIcono,
							core_permisos_listado.Direccionbase AS TransaccionURLBase,
							core_permisos_listado.Direccionweb AS TransaccionURL, 
							core_permisos_listado.Nombre AS TransaccionNombre,
							usuarios_permisos.level
							
							FROM usuarios_permisos 
							INNER JOIN core_permisos_listado      ON core_permisos_listado.idAdmpm        = usuarios_permisos.idAdmpm
							INNER JOIN core_permisos_categorias   ON core_permisos_categorias.id_pmcat    = core_permisos_listado.id_pmcat 
							LEFT JOIN `core_font_awesome`         ON core_font_awesome.idFont             = core_permisos_categorias.idFont
							WHERE usuarios_permisos.idUsuario = ".$idUsuario."
							ORDER BY CategoriaNombre, TransaccionNombre ASC";
							$resultado = mysqli_query($dbConn, $query);
							while ( $row = mysqli_fetch_assoc ($resultado)) {
							array_push( $arrMenu,$row );
							}
							
							//Permisos
							foreach($arrMenu as $menu) {
								$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['CategoriaNombre']     = $menu['CategoriaNombre'];
								$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['CategoriaIcono']      = $menu['TransaccionURL'];
								$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['TransaccionNombre']   = $menu['TransaccionNombre'];
								$_SESSION['usuario']['Permisos'][$menu['TransaccionURLBase']]['level']               = $menu['level'];
								
							}
							
							//Construccion de los menus del sistema
							//llamamos a la función para filtrar los datos
							filtrar($arrMenu, 'CategoriaNombre');
							/******************************************************************/
							//recorremos el array para imprimirlo con formato HTML
							foreach($arrMenu as $Categorias=>$Transacciones) {
								
								$ntranx = 0;			
								// recorremos los productos
								foreach($Transacciones as $transaccion) {
									
									$_SESSION['usuario']['menu'][$Categorias][$ntranx]['CategoriaNombre']    = $Categorias;
									$_SESSION['usuario']['menu'][$Categorias][$ntranx]['CategoriaIcono']     = $transaccion['CategoriaIcono'];
									$_SESSION['usuario']['menu'][$Categorias][$ntranx]['TransaccionURL']     = $transaccion['TransaccionURL'];
									$_SESSION['usuario']['menu'][$Categorias][$ntranx]['TransaccionNombre']  = $transaccion['TransaccionNombre'];
									
									$ntranx++;
								}
								   
							}
							
							/******************************************************************/
							//Si el usuario es un super usuario
							if($rowUser['idTipoUsuario']==1){
								
								//Redirijo a la pagina de seleccion
								header( 'Location: index_select.php' );
								die;
								
							//Si el usuario es un usuario normal
							}else{
								
								if(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']==1){
									
									//Verifico la cantidad de sistemas a la cual tiene permitido el acceso
									$query = "SELECT idSistema FROM `usuarios_sistemas` WHERE idUsuario = '".$rowUser['idUsuario']."' ";
									$resultado = mysqli_query($dbConn, $query);
									$rowSystem = mysqli_fetch_array($resultado);
								
									$query = "SELECT 
									core_sistemas.Config_idTheme,
									core_sistemas.Config_imgLogo,
									core_sistemas.Config_IDGoogle,
									core_sistemas.idOpcionesGen_8,
									core_sistemas.Nombre AS RazonSocial,
									core_config_ram.Nombre AS ConfigRam,
									core_config_time.Nombre AS ConfigTime

									FROM `core_sistemas` 
									LEFT JOIN `core_config_ram`   ON core_config_ram.idConfigRam    = core_sistemas.idConfigRam
									LEFT JOIN `core_config_time`  ON core_config_time.idConfigTime  = core_sistemas.idConfigTime
									
									WHERE core_sistemas.idSistema = '".$rowSystem['idSistema']."' ";
									$resultado = mysqli_query($dbConn, $query);
									$rowSistema = mysqli_fetch_array($resultado);
									
									//Se crean las variables con todos los datos
									$_SESSION['usuario']['basic_data']['Config_idTheme']     = $rowSistema['Config_idTheme'];
									$_SESSION['usuario']['basic_data']['Config_imgLogo']     = $rowSistema['Config_imgLogo'];
									$_SESSION['usuario']['basic_data']['Config_IDGoogle']    = $rowSistema['Config_IDGoogle'];
									$_SESSION['usuario']['basic_data']['RazonSocial']        = $rowSistema['RazonSocial'];
									$_SESSION['usuario']['basic_data']['ConfigRam']          = $rowSistema['ConfigRam'];
									$_SESSION['usuario']['basic_data']['ConfigTime']         = $rowSistema['ConfigTime'];
									$_SESSION['usuario']['basic_data']['CorreoInterno']      = $rowSistema['idOpcionesGen_8'];
									$_SESSION['usuario']['basic_data']['idSistema']          = $rowSystem['idSistema'];
									
									//Redirijo a la pagina principal
									header( 'Location: principal.php' );
									die;
								
								//Si tiene mas de uno, se redirije a una pantalla de seleccion
								}elseif(isset($rowSis['Sistemas'])&&$rowSis['Sistemas']>1){
									//Redirijo a la pagina de seleccion
									header( 'Location: index_select.php' );
									die;
								}

							}
							
					
						//Si no esta activo envio error	
						}else{
							$error['idUsuario']   = 'error/Su usuario esta desactivado, Contactese con el administrador';
						}
					
					//Si no se encuentra ningun usuario se envia un error	
					}else{
						$error['idUsuario']   = 'error/El nombre de usuario o contraseña no coinciden';
					}
						
				}
							
							
				
						
			} 
		break;
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sistema_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario  = $_GET['id'];
			$idSistema   = $_GET['sistema_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idSistema)&&$idSistema!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idSistema', 'usuarios_sistemas', '', "idSistema='".$idSistema."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso al sistema ya fue otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_sistemas` (idUsuario, idSistema) 
				VALUES ('$id_usuario','$idSistema')";
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
		//borra un permiso del usuario
		case 'sistema_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_sistemas` WHERE idPermisoSistema = {$_GET['sistema_del']}";
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
		//se dan permisos al usuario
		case 'prm_add_all_sys':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico permisos a las transacciones 
			$arrContratos = array();
			$query = "SELECT 
			core_sistemas.idSistema,
			(SELECT COUNT(idSistema) FROM usuarios_sistemas WHERE idSistema = core_sistemas.idSistema AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
			FROM `core_sistemas`
			ORDER BY core_sistemas.idSistema ASC";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrContratos,$row );
			}
		
		
			
			/****************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************************************/
				//Se entregan los permisos relacionados a la caja
				foreach ($arrContratos as $cont) {
					//Si no se ha entregado el permiso
					if ( $cont['contar']!='1' ) {
						$query  = "INSERT INTO `usuarios_sistemas` (idUsuario, idSistema) 
						VALUES ('".$_GET['idUsuario']."','".$cont['idSistema']."')";
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
				}
				
				
				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
								
			}

		break;
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_del_all_sys':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_sistemas` WHERE idUsuario = {$_GET['idUsuario']}";
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
			
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;	
/*******************************************************************************************************************/		
		case 'select_sistema': 
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			
			//Se eliminan todas las sesiones
			unset($_SESSION['receta']);
			unset($_SESSION['receta_productos']);
	
			unset($_SESSION['arriendos_ing_basicos']);
			unset($_SESSION['arriendos_ing_productos']);
			unset($_SESSION['arriendos_ing_temporal']);
			unset($_SESSION['arriendos_ing_impuestos']);
			unset($_SESSION['arriendos_ing_archivos']);
			unset($_SESSION['arriendos_ing_descuentos']);
			unset($_SESSION['arriendos_ing_guias']);
				
			unset($_SESSION['insumos_ing_basicos']);
			unset($_SESSION['insumos_ing_productos']);
			unset($_SESSION['insumos_ing_temporal']);
			unset($_SESSION['insumos_ing_guias']);
			unset($_SESSION['insumos_ing_impuestos']);
			unset($_SESSION['insumos_ing_archivos']);
			unset($_SESSION['insumos_ing_descuentos']);
				
			unset($_SESSION['productos_ing_basicos']);
			unset($_SESSION['productos_ing_productos']);
			unset($_SESSION['productos_ing_temporal']);
			unset($_SESSION['productos_ing_guias']);
			unset($_SESSION['productos_ing_impuestos']);
			unset($_SESSION['productos_ing_archivos']);
			unset($_SESSION['productos_ing_descuentos']);
				
			unset($_SESSION['servicios_ing_basicos']);
			unset($_SESSION['servicios_ing_productos']);
			unset($_SESSION['servicios_ing_temporal']);
			unset($_SESSION['servicios_ing_impuestos']);
			unset($_SESSION['servicios_ing_archivos']);
			unset($_SESSION['servicios_ing_descuentos']);
			unset($_SESSION['servicios_ing_guias']);
				
			unset($_SESSION['boleta_ing_basicos']);
			unset($_SESSION['boleta_ing_servicios']);
			unset($_SESSION['boleta_ing_temporal']);
			unset($_SESSION['boleta_ing_archivos']);
				
			unset($_SESSION['caja_ing_basicos']);
			unset($_SESSION['caja_ing_documentos']);
			unset($_SESSION['caja_ing_temporal']);
			unset($_SESSION['caja_ing_archivos']);
				
			unset($_SESSION['cotizacion_basicos']);
			unset($_SESSION['cotizacion_arriendos']);
			unset($_SESSION['cotizacion_insumos']);
			unset($_SESSION['cotizacion_productos']);
			unset($_SESSION['cotizacion_servicios']);
			unset($_SESSION['cotizacion_temporal']);
			unset($_SESSION['cotizacion_archivos']);
				
			unset($_SESSION['cotizacion_prospectos_basicos']);
			unset($_SESSION['cotizacion_prospectos_arriendos']);
			unset($_SESSION['cotizacion_prospectos_insumos']);
			unset($_SESSION['cotizacion_prospectos_productos']);
			unset($_SESSION['cotizacion_prospectos_servicios']);
			unset($_SESSION['cotizacion_prospectos_temporal']);
			unset($_SESSION['cotizacion_prospectos_archivos']);
				
			unset($_SESSION['cross_quality_ana_cali_basicos']);
			unset($_SESSION['cross_quality_ana_cali_muestras']);
			unset($_SESSION['cross_quality_ana_cali_maquinas']);
			unset($_SESSION['cross_quality_ana_cali_trabajadores']);
			unset($_SESSION['cross_quality_ana_cali_archivos']);
			unset($_SESSION['cross_quality_ana_cali_temporal']);
				
			unset($_SESSION['cross_quality_reg_insp_basicos']);
			unset($_SESSION['cross_quality_reg_insp_muestras']);
			unset($_SESSION['cross_quality_reg_insp_maquinas']);
			unset($_SESSION['cross_quality_reg_insp_trabajadores']);
			unset($_SESSION['cross_quality_reg_insp_archivos']);
			unset($_SESSION['cross_quality_reg_insp_temporal']);
				
			unset($_SESSION['cross_shipping_consolidacion_basicos']);
			unset($_SESSION['cross_shipping_consolidacion_estibas']);
			unset($_SESSION['cross_shipping_consolidacion_archivos']);
			unset($_SESSION['cross_shipping_consolidacion_temporal']);
				
			unset($_SESSION['sol_apli_basicos']);
			unset($_SESSION['sol_apli_cuarteles']);
			unset($_SESSION['sol_apli_tractores']);
			unset($_SESSION['sol_apli_productos']);
			unset($_SESSION['sol_apli_temporal']);
				
			unset($_SESSION['ocompra_basicos']);
			unset($_SESSION['ocompra_arriendos']);
			unset($_SESSION['ocompra_insumos']);
			unset($_SESSION['ocompra_productos']);
			unset($_SESSION['ocompra_servicios']);
			unset($_SESSION['ocompra_temporal']);
			unset($_SESSION['ocompra_documentos']);
			unset($_SESSION['ocompra_otros']);
			unset($_SESSION['ocompra_sol_rel']);
			unset($_SESSION['ocompra_archivos']);
				
			unset($_SESSION['ot_basicos']);
			unset($_SESSION['ot_trabajador']);
			unset($_SESSION['ot_trabajos']);
			unset($_SESSION['ot_temporal']);
			unset($_SESSION['ot_insumos']);
			unset($_SESSION['ot_productos']);
				
			unset($_SESSION['pagos_boletas_clientes']);
			unset($_SESSION['pagos_boletas_trabajadores']);
				
			unset($_SESSION['pago_clientes_insumos']);
			unset($_SESSION['pago_clientes_productos']);
			unset($_SESSION['pago_clientes_arriendo']);
			unset($_SESSION['pago_clientes_servicio']);
				
			unset($_SESSION['pago_proveedor_insumos']);
			unset($_SESSION['pago_proveedor_productos']);
			unset($_SESSION['pago_proveedor_arriendo']);
			unset($_SESSION['pago_proveedor_servicio']);
				
			unset($_SESSION['fact_sueldos_basicos']);
			unset($_SESSION['fact_sueldos_sueldos']);
			unset($_SESSION['fact_sueldos_temporal']);
			unset($_SESSION['fact_sueldos_archivos']);
				
			unset($_SESSION['solicitud_basicos']);
			unset($_SESSION['solicitud_arriendos']);
			unset($_SESSION['solicitud_insumos']);
			unset($_SESSION['solicitud_otros']);
			unset($_SESSION['solicitud_productos']);
			unset($_SESSION['solicitud_servicios']);
			unset($_SESSION['solicitud_temporal']);
				
			unset($_SESSION['desc_cuotas_basicos']);
			unset($_SESSION['desc_cuotas_listado']);
			unset($_SESSION['desc_cuotas_temporal']);
			unset($_SESSION['desc_cuotas_archivos']);
				
			unset($_SESSION['horas_extras_ing_basicos']);
			unset($_SESSION['horas_extras_ing_horas']);
			unset($_SESSION['horas_extras_ing_temporal']);
			unset($_SESSION['horas_extras_ing_archivos']);
			unset($_SESSION['horas_extras_mens_ing_horas']);
				
			unset($_SESSION['horas_extras_mens_ing_basicos']);
			unset($_SESSION['horas_extras_mens_ing_horas']);
			unset($_SESSION['horas_extras_mens_ing_temporal']);
			unset($_SESSION['horas_extras_mens_ing_archivos']);
				
			unset($_SESSION['basicos']);
			unset($_SESSION['hijos']);
				
				
			//se verifica que el usuario exista
			if (isset($_GET['id'])&&$_GET['id']==$_SESSION['usuario']['basic_data']['idUsuario']) {
				//se verifica el envio de datos
				if(isset($_GET['ini'])&&$_GET['ini']!=''){
								
					$query = "SELECT 
					core_sistemas.Config_idTheme,
					core_sistemas.Config_imgLogo,
					core_sistemas.Config_IDGoogle,
					core_sistemas.idOpcionesGen_8,
					core_sistemas.Nombre AS RazonSocial,
					core_config_ram.Nombre AS ConfigRam,
					core_config_time.Nombre AS ConfigTime

					FROM `core_sistemas` 
					LEFT JOIN `core_config_ram`   ON core_config_ram.idConfigRam    = core_sistemas.idConfigRam
					LEFT JOIN `core_config_time`  ON core_config_time.idConfigTime  = core_sistemas.idConfigTime
									
					WHERE core_sistemas.idSistema = '".$_GET['ini']."' ";
					$resultado = mysqli_query($dbConn, $query);
					$rowSistema = mysqli_fetch_array($resultado);
									
					//Se crean las variables con todos los datos
					$_SESSION['usuario']['basic_data']['Config_idTheme']     = $rowSistema['Config_idTheme'];
					$_SESSION['usuario']['basic_data']['Config_imgLogo']     = $rowSistema['Config_imgLogo'];
					$_SESSION['usuario']['basic_data']['Config_IDGoogle']    = $rowSistema['Config_IDGoogle'];
					$_SESSION['usuario']['basic_data']['RazonSocial']        = $rowSistema['RazonSocial'];
					$_SESSION['usuario']['basic_data']['ConfigRam']          = $rowSistema['ConfigRam'];
					$_SESSION['usuario']['basic_data']['ConfigTime']         = $rowSistema['ConfigTime'];
					$_SESSION['usuario']['basic_data']['CorreoInterno']      = $rowSistema['idOpcionesGen_8'];
					$_SESSION['usuario']['basic_data']['idSistema']          = $_GET['ini'];
												
					//Redirijo a la pagina principal
					header( 'Location: principal.php' );
					die;
								
				}
			}
						
		
		break;
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'camara_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//variables
			$id_usuario  = $_GET['id'];
			$idCamara = $_GET['camara_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idCamara)&&$idCamara!=''&&isset($id_usuario)&&$id_usuario!=''){
				$ndata_1 = db_select_nrows ('idCamara', 'usuarios_camaras', '', "idCamara='".$idCamara."' AND idUsuario='".$id_usuario."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso a la caja chica ya ha sido otorgado';}
			/*******************************************************************/
	
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `usuarios_camaras` (idUsuario, idCamara) 
				VALUES ('$id_usuario','$idCamara')";
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
		//borra un permiso del usuario
		case 'camara_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `usuarios_camaras` WHERE idCamaraPermiso = {$_GET['camara_del']}";
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
		//se dan permisos al usuario
		case 'prm_add_all_camaras':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico permisos a las transacciones 
			$arrCajas = array();
			$query = "SELECT 
			seguridad_camaras_listado.idCamara,
			(SELECT COUNT(idCamara) FROM usuarios_camaras WHERE idCamara = seguridad_camaras_listado.idCamara AND idUsuario = {$_GET['idUsuario']} LIMIT 1) AS contar
			FROM `seguridad_camaras_listado`
			WHERE seguridad_camaras_listado.idSistema = {$_GET['idSistema']}
			ORDER BY seguridad_camaras_listado.idSistema ASC, seguridad_camaras_listado.Nombre ASC";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrCajas,$row );
			}
		
		
			
			/****************************************************************/
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************************************/
				//Se entregan los permisos relacionados a la caja
				foreach ($arrCajas as $caja) {
					//Si no se ha entregado el permiso
					if ( $caja['contar']!='1' ) {
						$query  = "INSERT INTO `usuarios_camaras` (idUsuario, idCamara) 
						VALUES ('".$_GET['idUsuario']."','".$caja['idCamara']."')";
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
				}
				
				
				//redirijo
				header( 'Location: '.$location.'&created=true' );
				die;
								
			}

		break;
/*******************************************************************************************************************/
		//se dan permisos al usuario
		case 'prm_del_all_camaras':	
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/***************************************************************************************/
			$query  = "DELETE FROM `usuarios_camaras` WHERE idUsuario = {$_GET['idUsuario']}";
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
			
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;
/*******************************************************************************************************************/
	}
?>
