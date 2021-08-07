<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridTransportead                                                */
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
	if ( !empty($_POST['idTransporte']) )          $idTransporte            = $_POST['idTransporte'];
	if ( !empty($_POST['idSistema']) )             $idSistema               = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )              $idEstado                = $_POST['idEstado'];
	if ( !empty($_POST['idTipo']) )                $idTipo                  = $_POST['idTipo'];
	if ( !empty($_POST['idRubro']) )               $idRubro                 = $_POST['idRubro'];
	if ( !empty($_POST['email']) )                 $email                   = $_POST['email'];
	if ( !empty($_POST['Nombre']) )                $Nombre 	                = $_POST['Nombre'];
	if ( !empty($_POST['RazonSocial']) )           $RazonSocial 	        = $_POST['RazonSocial'];
	if ( !empty($_POST['Rut']) )                   $Rut 	                = $_POST['Rut'];
	if ( !empty($_POST['fNacimiento']) )           $fNacimiento 	        = $_POST['fNacimiento'];
	if ( !empty($_POST['Direccion']) )             $Direccion 	            = $_POST['Direccion'];
	if ( !empty($_POST['Fono1']) )                 $Fono1 	                = $_POST['Fono1'];
	if ( !empty($_POST['Fono2']) )                 $Fono2 	                = $_POST['Fono2'];
	if ( !empty($_POST['idCiudad']) )              $idCiudad                = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )              $idComuna                = $_POST['idComuna'];
	if ( !empty($_POST['Fax']) )                   $Fax                     = $_POST['Fax'];
	if ( !empty($_POST['PersonaContacto']) )       $PersonaContacto         = $_POST['PersonaContacto'];
	if ( !empty($_POST['PersonaContacto_Fono']) )  $PersonaContacto_Fono    = $_POST['PersonaContacto_Fono'];
	if ( !empty($_POST['PersonaContacto_email']) ) $PersonaContacto_email   = $_POST['PersonaContacto_email'];
	if ( !empty($_POST['Web']) )                   $Web                     = $_POST['Web'];
	if ( !empty($_POST['Giro']) )                  $Giro                    = $_POST['Giro'];
	if ( !empty($_POST['password']) )              $password                = $_POST['password'];
	if ( !empty($_POST['repassword']) )            $repassword              = $_POST['repassword'];
	if ( !empty($_POST['oldpassword']) )           $oldpassword             = $_POST['oldpassword'];
	if ( !empty($_POST['idBanco']) )               $idBanco                 = $_POST['idBanco'];
	if ( !empty($_POST['NCuentaBanco']) )          $NCuentaBanco            = $_POST['NCuentaBanco'];
	if ( !empty($_POST['MailBanco']) )             $MailBanco               = $_POST['MailBanco'];
	
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
			case 'idTransporte':           if(empty($idTransporte)){           $error['idTransporte']               = 'error/No ha ingresado el id';}break;
			case 'idSistema':              if(empty($idSistema)){              $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':               if(empty($idEstado)){               $error['idEstado']                = 'error/No ha seleccionado el Estado';}break;
			case 'idTipo':                 if(empty($idTipo)){                 $error['idTipo']                  = 'error/No ha seleccionado el tipo de transporte';}break;
			case 'idRubro':                if(empty($idRubro)){                $error['idRubro']                 = 'error/No ha seleccionado el rubro';}break;
			case 'email':                  if(empty($email)){                  $error['email']                   = 'error/No ha ingresado el email';}break;
			case 'Nombre':                 if(empty($Nombre)){                 $error['Nombre']                  = 'error/No ha ingresado el Nombre de Fantasia';}break;
			case 'RazonSocial':            if(empty($RazonSocial)){            $error['RazonSocial']             = 'error/No ha ingresado la Razon Social';}break;
			case 'Rut':                    if(empty($Rut)){                    $error['Rut']                     = 'error/No ha ingresado el Rut';}break;	
			case 'fNacimiento':            if(empty($fNacimiento)){            $error['fNacimiento']             = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'Direccion':              if(empty($Direccion)){              $error['Direccion']               = 'error/No ha ingresado la direccion';}break;
			case 'Fono1':                  if(empty($Fono1)){                  $error['Fono1']                   = 'error/No ha ingresado el telefono';}break;
			case 'Fono2':                  if(empty($Fono2)){                  $error['Fono2']                   = 'error/No ha ingresado el telefono';}break;
			case 'idCiudad':               if(empty($idCiudad)){               $error['idCiudad']                = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':               if(empty($idComuna)){               $error['idComuna']                = 'error/No ha seleccionado la comuna';}break;
			case 'Fax':                    if(empty($Fax)){                    $error['Fax']                     = 'error/No ha ingresado el fax';}break;
			case 'PersonaContacto':        if(empty($PersonaContacto)){        $error['PersonaContacto']         = 'error/No ha ingresado el nombre de la persona de contacto';}break;
			case 'PersonaContacto_Fono':   if(empty($PersonaContacto_Fono)){   $error['PersonaContacto_Fono']    = 'error/No ha ingresado el nombre de la persona de contacto';}break;
			case 'PersonaContacto_email':  if(empty($PersonaContacto_email)){  $error['PersonaContacto_email']   = 'error/No ha ingresado el nombre de la persona de contacto';}break;
			case 'Web':                    if(empty($Web)){                    $error['Web']                     = 'error/No ha ingresado la pagina web';}break;
			case 'Giro':                   if(empty($Giro)){                   $error['Giro']                    = 'error/No ha ingresado el Giro de la empresa';}break;
			case 'password':               if(empty($password)){               $error['password']                = 'error/No ha ingresado el password';}break;
			case 'repassword':             if(empty($repassword)){             $error['repassword']              = 'error/No ha ingresado la repeticion de la clave';}break;
			case 'oldpassword':            if(empty($oldpassword)){            $error['oldpassword']             = 'error/No ha ingresado su clave antigua';}break;
			case 'idBanco':                if(empty($idBanco)){                $error['idBanco']                 = 'error/No ha seleccionado el banco';}break;
			case 'NCuentaBanco':           if(empty($NCuentaBanco)){           $error['NCuentaBanco']            = 'error/No ha ingresado el numero de cuenta de banco';}break;
			case 'MailBanco':              if(empty($MailBanco)){              $error['MailBanco']               = 'error/No ha ingresado el email de confirmacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($email)&&contar_palabras_censuradas($email)!=0){                                  $error['email']                 = 'error/Edita email, contiene palabras no permitidas'; }	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                                $error['Nombre']                = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($RazonSocial)&&contar_palabras_censuradas($RazonSocial)!=0){                      $error['RazonSocial']           = 'error/Edita la Razon Social, contiene palabras no permitidas'; }	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){                          $error['Direccion']             = 'error/Edita la Direccion, contiene palabras no permitidas'; }	
	if(isset($PersonaContacto)&&contar_palabras_censuradas($PersonaContacto)!=0){              $error['PersonaContacto']       = 'error/Edita la Persona de Contacto, contiene palabras no permitidas'; }	
	if(isset($PersonaContacto_email)&&contar_palabras_censuradas($PersonaContacto_email)!=0){  $error['PersonaContacto_email'] = 'error/Edita la Persona de Contacto email, contiene palabras no permitidas'; }	
	if(isset($Web)&&contar_palabras_censuradas($Web)!=0){                                      $error['Web']                   = 'error/Edita la Web, contiene palabras no permitidas'; }	
	if(isset($Giro)&&contar_palabras_censuradas($Giro)!=0){                                    $error['Giro']                  = 'error/Edita Giro, contiene palabras no permitidas'; }	
	if(isset($password)&&contar_palabras_censuradas($password)!=0){                            $error['password']              = 'error/Edita la password, contiene palabras no permitidas'; }	
	if(isset($repassword)&&contar_palabras_censuradas($repassword)!=0){                        $error['repassword']            = 'error/Edita la repassword, contiene palabras no permitidas'; }	
	if(isset($oldpassword)&&contar_palabras_censuradas($oldpassword)!=0){                      $error['oldpassword']           = 'error/Edita la oldpassword, contiene palabras no permitidas'; }	
	if(isset($MailBanco)&&contar_palabras_censuradas($MailBanco)!=0){                          $error['MailBanco']             = 'error/Edita Mail Banco, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){                                 $error['email']                = 'error/El Email ingresado no es valido'; }
	if(isset($Fono1)&&!validarNumero($Fono1)) {                               $error['Fono1']                = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Fono2)&&!validarNumero($Fono2)) {                               $error['Fono2']                = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Rut)&&!validarRut($Rut)){                                       $error['Rut']                  = 'error/El Rut ingresado no es valido'; }
	if(isset($PersonaContacto_email)&&!validarEmail($PersonaContacto_email)){ $error['email']                = 'error/El Email ingresado no es valido'; }	
	if(isset($PersonaContacto_Fono)&&!validarNumero($PersonaContacto_Fono)) { $error['PersonaContacto_Fono'] = 'error/Ingrese un numero telefonico valido'; }
	if(isset($MailBanco)&&!validarEmail($MailBanco)){                         $error['MailBanco']            = 'error/El Email ingresado no es valido'; }	
	if(isset($password)&&isset($repassword)){
		if ( $password <> $repassword )                  $error['password']  = 'error/Las contraseñas ingresadas no coinciden'; 
	}
	if(isset($password)){
		if (strpos($password, " ")){                     $error['Password1'] = 'error/La contraseña contiene espacios vacios';}
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
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'transportes_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'transportes_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)){
				$ndata_3 = db_select_nrows (false, 'email', 'transportes_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                           $a  = "'".$idSistema."'" ;               }else{$a ="''";}
				if(isset($idEstado) && $idEstado != ''){                             $a .= ",'".$idEstado."'" ;               }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                                 $a .= ",'".$idTipo."'" ;                 }else{$a .= ",''";}
				if(isset($idRubro) && $idRubro != ''){                               $a .= ",'".$idRubro."'" ;                }else{$a .= ",''";}
				if(isset($email) && $email != ''){                                   $a .= ",'".$email."'" ;                  }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",'".$Nombre."'" ;                 }else{$a .= ",''";}
				if(isset($RazonSocial) && $RazonSocial != ''){                       $a .= ",'".$RazonSocial."'" ;            }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                                       $a .= ",'".$Rut."'" ;                    }else{$a .= ",''";}
				if(isset($fNacimiento) && $fNacimiento != ''){                       $a .= ",'".$fNacimiento."'" ;            }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                           $a .= ",'".$Direccion."'" ;              }else{$a .= ",''";}
				if(isset($Fono1) && $Fono1 != ''){                                   $a .= ",'".$Fono1."'" ;                  }else{$a .= ",''";}
				if(isset($Fono2) && $Fono2 != ''){                                   $a .= ",'".$Fono2."'" ;                  }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                             $a .= ",'".$idCiudad."'" ;               }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                             $a .= ",'".$idComuna."'" ;               }else{$a .= ",''";}
				if(isset($Fax) && $Fax != ''){                                       $a .= ",'".$Fax."'" ;                    }else{$a .= ",''";}
				if(isset($PersonaContacto) && $PersonaContacto != ''){               $a .= ",'".$PersonaContacto."'" ;        }else{$a .= ",''";}
				if(isset($PersonaContacto_Fono) && $PersonaContacto_Fono != ''){     $a .= ",'".$PersonaContacto_Fono."'" ;   }else{$a .= ",''";}
				if(isset($PersonaContacto_email) && $PersonaContacto_email != ''){   $a .= ",'".$PersonaContacto_email."'" ;  }else{$a .= ",''";}
				if(isset($Web) && $Web != ''){                                       $a .= ",'".$Web."'" ;                    }else{$a .= ",''";}
				if(isset($Giro) && $Giro != ''){                                     $a .= ",'".$Giro."'" ;                   }else{$a .= ",''";}
				if(isset($password) && $password != ''){                             $a .= ",'".md5($password)."'" ;          }else{$a .= ",''";}
				if(isset($idBanco) && $idBanco != ''){                               $a .= ",'".$idBanco."'" ;                }else{$a .= ",''";}
				if(isset($NCuentaBanco) && $NCuentaBanco != ''){                     $a .= ",'".$NCuentaBanco."'" ;           }else{$a .= ",''";}
				if(isset($MailBanco) && $MailBanco != ''){                           $a .= ",'".$MailBanco."'" ;              }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `transportes_listado` (idSistema, idEstado, idTipo, idRubro, email, Nombre,
				RazonSocial, Rut, fNacimiento, Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, PersonaContacto,
				PersonaContacto_Fono, PersonaContacto_email, Web, Giro, password, idBanco, NCuentaBanco, MailBanco) 
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
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 1;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idTransporte)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'transportes_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idTransporte!='".$idTransporte."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idTransporte)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'transportes_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idTransporte!='".$idTransporte."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)&&isset($idTransporte)){
				$ndata_3 = db_select_nrows (false, 'email', 'transportes_listado', '', "email='".$email."' AND idSistema='".$idSistema."' AND idTransporte!='".$idTransporte."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($oldpassword)&&isset($idTransporte)){
				$ndata_4 = db_select_nrows (false, 'password', 'transportes_listado', '', "idTransporte='".$idTransporte."' AND password='".md5($oldpassword)."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			if($ndata_4 == 0) {$error['ndata_4'] = 'error/Las contraseñas ingresadas no coinciden';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTransporte='".$idTransporte."'" ;
				if(isset($idSistema) && $idSistema != ''){                           $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                             $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTipo) && $idTipo != ''){                                 $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idRubro) && $idRubro != ''){                               $a .= ",idRubro='".$idRubro."'" ;}
				if(isset($email) && $email != ''){                                   $a .= ",email='".$email."'" ;}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($RazonSocial) && $RazonSocial != ''){                       $a .= ",RazonSocial='".$RazonSocial."'" ;}
				if(isset($Rut) && $Rut != ''){                                       $a .= ",Rut='".$Rut."'" ;}
				if(isset($fNacimiento) && $fNacimiento != ''){                       $a .= ",fNacimiento='".$fNacimiento."'" ;}
				if(isset($Direccion) && $Direccion != ''){                           $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Fono1) && $Fono1 != ''){                                   $a .= ",Fono1='".$Fono1."'" ;}
				if(isset($Fono2) && $Fono2 != ''){                                   $a .= ",Fono2='".$Fono2."'" ;}
				if(isset($idCiudad) && $idCiudad!= ''){                              $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna!= ''){                              $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Fax) && $Fax!= ''){                                        $a .= ",Fax='".$Fax."'" ;}
				if(isset($PersonaContacto) && $PersonaContacto!= ''){                $a .= ",PersonaContacto='".$PersonaContacto."'" ;}
				if(isset($PersonaContacto_Fono) && $PersonaContacto_Fono!= ''){      $a .= ",PersonaContacto_Fono='".$PersonaContacto_Fono."'" ;}
				if(isset($PersonaContacto_email) && $PersonaContacto_email!= ''){    $a .= ",PersonaContacto_email='".$PersonaContacto_email."'" ;}
				if(isset($Web) && $Web!= ''){                                        $a .= ",Web='".$Web."'" ;}
				if(isset($Giro) && $Giro!= ''){                                      $a .= ",Giro='".$Giro."'" ;}
				if(isset($password) && $password!= ''){                              $a .= ",password='".md5($password)."'" ;}
				if(isset($idBanco) && $idBanco!= ''){                                $a .= ",idBanco='".$idBanco."'" ;}
				if(isset($NCuentaBanco) && $NCuentaBanco!= ''){                      $a .= ",NCuentaBanco='".$NCuentaBanco."'" ;}
				if(isset($MailBanco) && $MailBanco!= ''){                            $a .= ",MailBanco='".$MailBanco."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'transportes_listado', 'idTransporte = "'.$idTransporte.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
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
				$resultado = db_delete_data (false, 'transportes_listado', 'idTransporte = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idTransporte  = $_GET['id'];
			$idEstado      = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$a = "idEstado='".$idEstado."'" ;
			$resultado = db_update_data (false, $a, 'transportes_listado', 'idTransporte = "'.$idTransporte.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			}
			


		break;				
/*******************************************************************************************************************/
	}
?>
