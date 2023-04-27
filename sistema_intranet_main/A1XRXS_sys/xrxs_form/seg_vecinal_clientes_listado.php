<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridClientead                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-120).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idCliente']))             $idCliente               = $_POST['idCliente'];
	if (!empty($_POST['idSistema']))             $idSistema               = $_POST['idSistema'];
	if (!empty($_POST['idEstado']))              $idEstado                = $_POST['idEstado'];
	if (!empty($_POST['idTipo']))                $idTipo                  = $_POST['idTipo'];
	if (!empty($_POST['idRubro']))               $idRubro                 = $_POST['idRubro'];
	if (!empty($_POST['email']))                 $email                   = $_POST['email'];
	if (!empty($_POST['Nombre']))                $Nombre 	              = $_POST['Nombre'];
	if (!empty($_POST['RazonSocial']))           $RazonSocial 	          = $_POST['RazonSocial'];
	if (!empty($_POST['Rut']))                   $Rut 	                  = $_POST['Rut'];
	if (!empty($_POST['fNacimiento']))           $fNacimiento 	          = $_POST['fNacimiento'];
	if (!empty($_POST['Direccion']))             $Direccion 	          = $_POST['Direccion'];
	if (!empty($_POST['Fono1']))                 $Fono1 	              = $_POST['Fono1'];
	if (!empty($_POST['Fono2']))                 $Fono2 	              = $_POST['Fono2'];
	if (!empty($_POST['idCiudad']))              $idCiudad                = $_POST['idCiudad'];
	if (!empty($_POST['idComuna']))              $idComuna                = $_POST['idComuna'];
	if (!empty($_POST['Fax']))                   $Fax                     = $_POST['Fax'];
	if (!empty($_POST['PersonaContacto']))       $PersonaContacto         = $_POST['PersonaContacto'];
	if (!empty($_POST['PersonaContacto_Fono']))  $PersonaContacto_Fono    = $_POST['PersonaContacto_Fono'];
	if (!empty($_POST['PersonaContacto_email'])) $PersonaContacto_email   = $_POST['PersonaContacto_email'];
	if (!empty($_POST['PersonaContacto_Cargo'])) $PersonaContacto_Cargo   = $_POST['PersonaContacto_Cargo'];
	if (!empty($_POST['Web']))                   $Web                     = $_POST['Web'];
	if (!empty($_POST['Giro']))                  $Giro                    = $_POST['Giro'];
	if (!empty($_POST['password']))              $password                = $_POST['password'];
	if (!empty($_POST['idCompartir']))           $idCompartir             = $_POST['idCompartir'];
	if (!empty($_POST['GeoLatitud']))            $GeoLatitud              = $_POST['GeoLatitud'];
	if (!empty($_POST['GeoLongitud']))           $GeoLongitud             = $_POST['GeoLongitud'];
	if (!empty($_POST['idNuevo']))               $idNuevo                 = $_POST['idNuevo'];
	if (!empty($_POST['idVerificado']))          $idVerificado            = $_POST['idVerificado'];

	if (!empty($_POST['repassword']))            $repassword              = $_POST['repassword'];
	if (!empty($_POST['oldpassword']))           $oldpassword             = $_POST['oldpassword'];

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
			case 'idCliente':              if(empty($idCliente)){              $error['idCliente']               = 'error/No ha ingresado el id';}break;
			case 'idSistema':              if(empty($idSistema)){              $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':               if(empty($idEstado)){               $error['idEstado']                = 'error/No ha seleccionado el Estado';}break;
			case 'idTipo':                 if(empty($idTipo)){                 $error['idTipo']                  = 'error/No ha seleccionado el tipo de cliente';}break;
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
			case 'PersonaContacto_Fono':   if(empty($PersonaContacto_Fono)){   $error['PersonaContacto_Fono']    = 'error/No ha ingresado el Fono de la persona de contacto';}break;
			case 'PersonaContacto_email':  if(empty($PersonaContacto_email)){  $error['PersonaContacto_email']   = 'error/No ha ingresado el Email de la persona de contacto';}break;
			case 'PersonaContacto_Cargo':  if(empty($PersonaContacto_Cargo)){  $error['PersonaContacto_Cargo']   = 'error/No ha ingresado el Cargo de la persona de contacto';}break;
			case 'Web':                    if(empty($Web)){                    $error['Web']                     = 'error/No ha ingresado la pagina web';}break;
			case 'Giro':                   if(empty($Giro)){                   $error['Giro']                    = 'error/No ha ingresado el Giro de la empresa';}break;
			case 'password':               if(empty($password)){               $error['password']                = 'error/No ha ingresado el password';}break;
			case 'idCompartir':            if(empty($idCompartir)){            $error['idCompartir']             = 'error/No ha seleccionado la opcion de compartir datos personales';}break;
			case 'GeoLatitud':             if(empty($GeoLatitud)){             $error['GeoLatitud']              = 'error/No ha ingresado la Latitud';}break;
			case 'GeoLongitud':            if(empty($GeoLongitud)){            $error['GeoLongitud']             = 'error/No ha ingresado la Longitud';}break;
			case 'idNuevo':                if(empty($idNuevo)){                $error['idNuevo']                 = 'error/No ha seleccionado si es nuevo';}break;
			case 'idVerificado':           if(empty($idVerificado)){           $error['idVerificado']            = 'error/No ha seleccionado la verificacion';}break;

			case 'repassword':             if(empty($repassword)){             $error['repassword']              = 'error/No ha ingresado la repeticion del password';}break;
			case 'oldpassword':            if(empty($oldpassword)){            $error['oldpassword']             = 'error/No ha ingresado el password antiguo';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	//if(isset($email) && $email!=''){                                  $email                 = EstandarizarInput($email);}
	if(isset($Nombre) && $Nombre!=''){                                $Nombre                = EstandarizarInput($Nombre);}
	if(isset($RazonSocial) && $RazonSocial!=''){                      $RazonSocial           = EstandarizarInput($RazonSocial);}
	if(isset($Direccion) && $Direccion!=''){                          $Direccion             = EstandarizarInput($Direccion);}
	if(isset($PersonaContacto) && $PersonaContacto!=''){              $PersonaContacto       = EstandarizarInput($PersonaContacto);}
	if(isset($PersonaContacto_email) && $PersonaContacto_email!=''){  $PersonaContacto_email = EstandarizarInput($PersonaContacto_email);}
	if(isset($PersonaContacto_Cargo) && $PersonaContacto_Cargo!=''){  $PersonaContacto_Cargo = EstandarizarInput($PersonaContacto_Cargo);}
	if(isset($Web) && $Web!=''){                                      $Web                   = EstandarizarInput($Web);}
	if(isset($Giro) && $Giro!=''){                                    $Giro                  = EstandarizarInput($Giro);}
	if(isset($password) && $password!=''){                            $password              = EstandarizarInput($password);}
	if(isset($repassword) && $repassword!=''){                        $repassword            = EstandarizarInput($repassword);}
	if(isset($oldpassword) && $oldpassword!=''){                      $oldpassword           = EstandarizarInput($oldpassword);}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($email)&&contar_palabras_censuradas($email)!=0){                                  $error['email']                 = 'error/Edita email, contiene palabras no permitidas';}
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                                $error['Nombre']                = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($RazonSocial)&&contar_palabras_censuradas($RazonSocial)!=0){                      $error['RazonSocial']           = 'error/Edita la Razon Social, contiene palabras no permitidas';}
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){                          $error['Direccion']             = 'error/Edita la Direccion, contiene palabras no permitidas';}
	if(isset($PersonaContacto)&&contar_palabras_censuradas($PersonaContacto)!=0){              $error['PersonaContacto']       = 'error/Edita la Persona de Contacto, contiene palabras no permitidas';}
	if(isset($PersonaContacto_email)&&contar_palabras_censuradas($PersonaContacto_email)!=0){  $error['PersonaContacto_email'] = 'error/Edita la Persona de Contacto email, contiene palabras no permitidas';}
	if(isset($PersonaContacto_Cargo)&&contar_palabras_censuradas($PersonaContacto_Cargo)!=0){  $error['PersonaContacto_Cargo'] = 'error/Edita Persona de Contacto Cargo, contiene palabras no permitidas';}
	if(isset($Web)&&contar_palabras_censuradas($Web)!=0){                                      $error['Web']                   = 'error/Edita la Web, contiene palabras no permitidas';}
	if(isset($Giro)&&contar_palabras_censuradas($Giro)!=0){                                    $error['Giro']                  = 'error/Edita Giro, contiene palabras no permitidas';}
	if(isset($password)&&contar_palabras_censuradas($password)!=0){                            $error['password']              = 'error/Edita la password, contiene palabras no permitidas';}
	if(isset($repassword)&&contar_palabras_censuradas($repassword)!=0){                        $error['repassword']            = 'error/Edita la password, contiene palabras no permitidas';}
	if(isset($oldpassword)&&contar_palabras_censuradas($oldpassword)!=0){                      $error['oldpassword']           = 'error/Edita la password, contiene palabras no permitidas';}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){                                 $error['email']                  = 'error/El Email ingresado no es valido';}
	if(isset($Fono1)&&!validarNumero($Fono1)){                                $error['Fono1']                  = 'error/Ingrese un numero telefonico valido';}
	if(isset($Fono2)&&!validarNumero($Fono2)){                                $error['Fono2']                  = 'error/Ingrese un numero telefonico valido';}
	if(isset($Rut)&&!validarRut($Rut)){                                       $error['Rut']                    = 'error/El Rut ingresado no es valido';}
	if(isset($PersonaContacto_email)&&!validarEmail($PersonaContacto_email)){ $error['email']                  = 'error/El Email ingresado no es valido';}
	if(isset($PersonaContacto_Fono)&&!validarNumero($PersonaContacto_Fono)){  $error['PersonaContacto_Fono']   = 'error/Ingrese un numero telefonico valido';}
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
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seg_vecinal_clientes_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'seg_vecinal_clientes_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)){
				$ndata_3 = db_select_nrows (false, 'email', 'seg_vecinal_clientes_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			//Consulto la latitud y la longitud
			if(isset($idCiudad) && $idCiudad != ''&&isset($idComuna) && $idComuna != ''&&isset($Direccion) && $Direccion!=''){
				//variable con la direccion
				$address = '';
				if(isset($idCiudad) && $idCiudad!=''){
					$rowdata = db_select_data (false, 'Nombre', 'core_ubicacion_ciudad', '', 'idCiudad = "'.$idCiudad.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowdata['Nombre'].', ';
				}
				if(isset($idComuna) && $idComuna!=''){
					$rowdata = db_select_data (false, 'Nombre', 'core_ubicacion_comunas', '', 'idComuna = "'.$idComuna.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowdata['Nombre'].', ';
				}
				if(isset($Direccion) && $Direccion!=''){
					$address .= $Direccion;
				}
				if($address!=''){
					$geocodeData = getGeocodeData($address, $_SESSION['usuario']['basic_data']['Config_IDGoogle']);
					if($geocodeData){
						$GeoLatitud  = $geocodeData[0];
						$GeoLongitud = $geocodeData[1];
					} else {
						$error['ndata_4'] = 'error/Detalles de la direccion incorrectos!';
					}
				}else{
					$error['ndata_4'] = 'error/Sin direccion ingresada';
				}
			}else{
				$error['ndata_4'] = 'error/Sin direccion ingresada';
			}

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//filtros
				if(isset($idSistema) && $idSistema!=''){                           $SIS_data  = "'".$idSistema."'";               }else{$SIS_data  = "''";}
				if(isset($idEstado) && $idEstado!=''){                             $SIS_data .= ",'".$idEstado."'";               }else{$SIS_data .= ",''";}
				if(isset($idTipo) && $idTipo!=''){                                 $SIS_data .= ",'".$idTipo."'";                 }else{$SIS_data .= ",''";}
				if(isset($idRubro) && $idRubro!=''){                               $SIS_data .= ",'".$idRubro."'";                }else{$SIS_data .= ",''";}
				if(isset($email) && $email!=''){                                   $SIS_data .= ",'".$email."'";                  }else{$SIS_data .= ",''";}
				if(isset($Nombre) && $Nombre!=''){                                 $SIS_data .= ",'".$Nombre."'";                 }else{$SIS_data .= ",''";}
				if(isset($RazonSocial) && $RazonSocial!=''){                       $SIS_data .= ",'".$RazonSocial."'";            }else{$SIS_data .= ",''";}
				if(isset($Rut) && $Rut!=''){                                       $SIS_data .= ",'".$Rut."'";                    }else{$SIS_data .= ",''";}
				if(isset($fNacimiento) && $fNacimiento!=''){                       $SIS_data .= ",'".$fNacimiento."'";            }else{$SIS_data .= ",''";}
				if(isset($Direccion) && $Direccion!=''){                           $SIS_data .= ",'".$Direccion."'";              }else{$SIS_data .= ",''";}
				if(isset($Fono1) && $Fono1!=''){                                   $SIS_data .= ",'".$Fono1."'";                  }else{$SIS_data .= ",''";}
				if(isset($Fono2) && $Fono2!=''){                                   $SIS_data .= ",'".$Fono2."'";                  }else{$SIS_data .= ",''";}
				if(isset($idCiudad) && $idCiudad!=''){                             $SIS_data .= ",'".$idCiudad."'";               }else{$SIS_data .= ",''";}
				if(isset($idComuna) && $idComuna!=''){                             $SIS_data .= ",'".$idComuna."'";               }else{$SIS_data .= ",''";}
				if(isset($Fax) && $Fax!=''){                                       $SIS_data .= ",'".$Fax."'";                    }else{$SIS_data .= ",''";}
				if(isset($PersonaContacto) && $PersonaContacto!=''){               $SIS_data .= ",'".$PersonaContacto."'";        }else{$SIS_data .= ",''";}
				if(isset($PersonaContacto_Fono) && $PersonaContacto_Fono!=''){     $SIS_data .= ",'".$PersonaContacto_Fono."'";   }else{$SIS_data .= ",''";}
				if(isset($PersonaContacto_email) && $PersonaContacto_email!=''){   $SIS_data .= ",'".$PersonaContacto_email."'";  }else{$SIS_data .= ",''";}
				if(isset($PersonaContacto_Cargo) && $PersonaContacto_Cargo!=''){   $SIS_data .= ",'".$PersonaContacto_Cargo."'";  }else{$SIS_data .= ",''";}
				if(isset($Web) && $Web!=''){                                       $SIS_data .= ",'".$Web."'";                    }else{$SIS_data .= ",''";}
				if(isset($Giro) && $Giro!=''){                                     $SIS_data .= ",'".$Giro."'";                   }else{$SIS_data .= ",''";}
				if(isset($password) && $password!=''){                             $SIS_data .= ",'".md5($password)."'";          }else{$SIS_data .= ",''";}
				if(isset($idCompartir) && $idCompartir!=''){                       $SIS_data .= ",'".$idCompartir."'";            }else{$SIS_data .= ",''";}
				if(isset($GeoLatitud) && $GeoLatitud!=''){                         $SIS_data .= ",'".$GeoLatitud."'";             }else{$SIS_data .= ",''";}
				if(isset($GeoLongitud) && $GeoLongitud!=''){                       $SIS_data .= ",'".$GeoLongitud."'";            }else{$SIS_data .= ",''";}
				if(isset($idNuevo) && $idNuevo!=''){                               $SIS_data .= ",'".$idNuevo."'";                }else{$SIS_data .= ",''";}
				if(isset($idVerificado) && $idVerificado!=''){                     $SIS_data .= ",'".$idVerificado."'";           }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idEstado, idTipo, idRubro, email, Nombre,
				RazonSocial, Rut, fNacimiento, Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, PersonaContacto,
				PersonaContacto_Fono, PersonaContacto_email, PersonaContacto_Cargo, Web, Giro, password, idCompartir,
				GeoLatitud, GeoLongitud, idNuevo, idVerificado';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'seg_vecinal_clientes_listado', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){
					//redirijo
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
					die;
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
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idCliente)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seg_vecinal_clientes_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idCliente!='".$idCliente."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idCliente)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'seg_vecinal_clientes_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idCliente!='".$idCliente."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)&&isset($idCliente)){
				$ndata_3 = db_select_nrows (false, 'email', 'seg_vecinal_clientes_listado', '', "email='".$email."' AND idSistema='".$idSistema."' AND idCliente!='".$idCliente."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			//Consulto la latitud y la longitud
			if(isset($idCiudad) && $idCiudad != ''&&isset($idComuna) && $idComuna != ''&&isset($Direccion) && $Direccion!=''){
				//variable con la direccion
				$address = '';
				if(isset($idCiudad) && $idCiudad!=''){
					$rowdata = db_select_data (false, 'Nombre', 'core_ubicacion_ciudad', '', 'idCiudad = "'.$idCiudad.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowdata['Nombre'].', ';
				}
				if(isset($idComuna) && $idComuna!=''){
					$rowdata = db_select_data (false, 'Nombre', 'core_ubicacion_comunas', '', 'idComuna = "'.$idComuna.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowdata['Nombre'].', ';
				}
				if(isset($Direccion) && $Direccion!=''){
					$address .= $Direccion;
				}
				if($address!=''){
					$geocodeData = getGeocodeData($address, $_SESSION['usuario']['basic_data']['Config_IDGoogle']);
					if($geocodeData){
						$GeoLatitud  = $geocodeData[0];
						$GeoLongitud = $geocodeData[1];
					} else {
						$error['ndata_4'] = 'error/Detalles de la direccion incorrectos!';
					}
				}else{
					$error['ndata_4'] = 'error/Sin direccion ingresada';
				}
			}else{
				$error['ndata_4'] = 'error/Sin direccion ingresada';
			}

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idCliente='".$idCliente."'";
				if(isset($idSistema) && $idSistema!=''){                             $SIS_data .= ",idSistema='".$idSistema."'";}
				if(isset($idEstado) && $idEstado!=''){                               $SIS_data .= ",idEstado='".$idEstado."'";}
				if(isset($idTipo) && $idTipo!=''){                                   $SIS_data .= ",idTipo='".$idTipo."'";}
				if(isset($idRubro) && $idRubro!=''){                                 $SIS_data .= ",idRubro='".$idRubro."'";}
				if(isset($email) && $email!=''){                                     $SIS_data .= ",email='".$email."'";}
				if(isset($Nombre) && $Nombre!=''){                                   $SIS_data .= ",Nombre='".$Nombre."'";}
				if(isset($RazonSocial) && $RazonSocial!=''){                         $SIS_data .= ",RazonSocial='".$RazonSocial."'";}
				if(isset($Rut) && $Rut!=''){                                         $SIS_data .= ",Rut='".$Rut."'";}
				if(isset($fNacimiento) && $fNacimiento!=''){                         $SIS_data .= ",fNacimiento='".$fNacimiento."'";}
				if(isset($Direccion) && $Direccion!=''){                             $SIS_data .= ",Direccion='".$Direccion."'";}
				if(isset($Fono1) && $Fono1!=''){                                     $SIS_data .= ",Fono1='".$Fono1."'";}
				if(isset($Fono2) && $Fono2!=''){                                     $SIS_data .= ",Fono2='".$Fono2."'";}
				if(isset($idCiudad) && $idCiudad!= ''){                              $SIS_data .= ",idCiudad='".$idCiudad."'";}
				if(isset($idComuna) && $idComuna!= ''){                              $SIS_data .= ",idComuna='".$idComuna."'";}
				if(isset($Fax) && $Fax!= ''){                                        $SIS_data .= ",Fax='".$Fax."'";}
				if(isset($PersonaContacto) && $PersonaContacto!= ''){                $SIS_data .= ",PersonaContacto='".$PersonaContacto."'";}
				if(isset($PersonaContacto_Fono) && $PersonaContacto_Fono!= ''){      $SIS_data .= ",PersonaContacto_Fono='".$PersonaContacto_Fono."'";}
				if(isset($PersonaContacto_email) && $PersonaContacto_email!= ''){    $SIS_data .= ",PersonaContacto_email='".$PersonaContacto_email."'";}
				if(isset($PersonaContacto_Cargo) && $PersonaContacto_Cargo!= ''){    $SIS_data .= ",PersonaContacto_Cargo='".$PersonaContacto_Cargo."'";}
				if(isset($Web) && $Web!= ''){                                        $SIS_data .= ",Web='".$Web."'";}
				if(isset($Giro) && $Giro!= ''){                                      $SIS_data .= ",Giro='".$Giro."'";}
				if(isset($password) && $password!= ''){                              $SIS_data .= ",password='".md5($password)."'";}
				if(isset($idCompartir) && $idCompartir!= ''){                        $SIS_data .= ",idCompartir='".$idCompartir."'";}
				if(isset($GeoLatitud) && $GeoLatitud!= ''){                          $SIS_data .= ",GeoLatitud='".$GeoLatitud."'";}
				if(isset($GeoLongitud) && $GeoLongitud!= ''){                        $SIS_data .= ",GeoLongitud='".$GeoLongitud."'";}
				if(isset($idNuevo) && $idNuevo!= ''){                                $SIS_data .= ",idNuevo='".$idNuevo."'";}
				if(isset($idVerificado) && $idVerificado!= ''){                      $SIS_data .= ",idVerificado='".$idVerificado."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'seg_vecinal_clientes_listado', 'idCliente = "'.$idCliente.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
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
				/********************************************************************/
				//se obtienen los archivos
				// Se obtiene el nombre de la imagen de perfil
				$rowdata = db_select_data (false, 'Direccion_img', 'seg_vecinal_clientes_listado', '', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				$arrEventos  = array();
				$arrArchivos = array();
				$arrEventos  = db_select_array (false, 'seg_vecinal_eventos_listado_archivos.Nombre AS DATA', 'seg_vecinal_eventos_listado', 'LEFT JOIN seg_vecinal_eventos_listado_archivos ON seg_vecinal_eventos_listado_archivos.idEvento = seg_vecinal_eventos_listado.idEvento', 'seg_vecinal_eventos_listado.idCliente='.$indice, 'seg_vecinal_eventos_listado.idEvento ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$arrArchivos = db_select_array (false, 'seg_vecinal_peligros_listado_archivos.Nombre AS DATA', 'seg_vecinal_peligros_listado', 'LEFT JOIN seg_vecinal_peligros_listado_archivos ON seg_vecinal_peligros_listado_archivos.idPeligro = seg_vecinal_peligros_listado.idPeligro', 'seg_vecinal_peligros_listado.idCliente='.$indice, 'seg_vecinal_peligros_listado.idPeligro ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				/********************************************************************/
				//se eliminan archivos
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
				foreach ($arrEventos as $data) {
					if(isset($data['DATA'])&&$data['DATA']!=''){
						try {
							if(!is_writable('upload/'.$data['DATA'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$data['DATA']);
							}
						}catch(Exception $e) {
							//guardar el dato en un archivo log
						}
					}
				}
				foreach ($arrArchivos as $data) {
					if(isset($data['DATA'])&&$data['DATA']!=''){
						try {
							if(!is_writable('upload/'.$data['DATA'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$data['DATA']);
							}
						}catch(Exception $e) {
							//guardar el dato en un archivo log
						}
					}
				}

				/********************************************************************/
				//se borran los datos del cliente
				$resultado_1 = db_delete_data (false, 'seg_vecinal_clientes_listado', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'seg_vecinal_clientes_observaciones', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_3 = db_delete_data (false, 'seg_vecinal_clientes_accesos', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_4 = db_delete_data (false, 'seg_vecinal_clientes_listado_ip', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran las camaras
				$resultado_5 = db_delete_data (false, 'seg_vecinal_camaras_listado', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_6 = db_delete_data (false, 'seg_vecinal_camaras_listado_canales', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los eventos
				$resultado_7 = db_delete_data (false, 'seg_vecinal_eventos_listado', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_8 = db_delete_data (false, 'seg_vecinal_eventos_listado_archivos', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_9 = db_delete_data (false, 'seg_vecinal_eventos_listado_comentarios', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los peligros
				$resultado_10 = db_delete_data (false, 'seg_vecinal_peligros_listado', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_11 = db_delete_data (false, 'seg_vecinal_peligros_listado_archivos', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_12 = db_delete_data (false, 'seg_vecinal_peligros_listado_comentarios', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//borrado
				$borrado_true = 0;
				if($resultado_1==true OR $resultado_2==true OR $resultado_3==true OR $resultado_4==true){
					$borrado_true++;
				}
				if($resultado_5==true OR $resultado_6==true){
					$borrado_true++;
				}
				if($resultado_7==true OR $resultado_8==true OR $resultado_9==true){
					$borrado_true++;
				}
				if($resultado_10==true OR $resultado_11==true OR $resultado_12==true){
					$borrado_true++;
				}

				//Si ejecuto correctamente la consulta
				if($borrado_true!=0){

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

			$idCliente  = $_GET['id'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "idEstado='".$idEstado."'";
			$resultado = db_update_data (false, $SIS_data, 'seg_vecinal_clientes_listado', 'idCliente = "'.$idCliente.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				//redirijo
				header( 'Location: '.$location.'&edited=true' );
				die;

			}

		break;
/*******************************************************************************************************************/
		case 'verificacion':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			$idCliente    = simpleDecode($_GET['id'], fecha_actual());
			$idVerificado = simpleDecode($_GET['verificacion'], fecha_actual());

			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "idVerificado='".$idVerificado."'";
			$resultado = db_update_data (false, $SIS_data, 'seg_vecinal_clientes_listado', 'idCliente = "'.$idCliente.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				//redirijo
				header( 'Location: '.$location.'&edited=true' );
				die;

			}

		break;
/*******************************************************************************************************************/
	}

?>
