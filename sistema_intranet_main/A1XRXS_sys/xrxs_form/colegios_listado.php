<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridColegioad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-038).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idColegio']))             $idColegio               = $_POST['idColegio'];
	if (!empty($_POST['idSistema']))             $idSistema               = $_POST['idSistema'];
	if (!empty($_POST['idEstado']))              $idEstado                = $_POST['idEstado'];
	if (!empty($_POST['email']))                 $email                   = $_POST['email'];
	if (!empty($_POST['Nombre']))                $Nombre 	              = $_POST['Nombre'];
	if (!empty($_POST['Direccion']))             $Direccion 	          = $_POST['Direccion'];
	if (!empty($_POST['Fono1']))                 $Fono1 	              = $_POST['Fono1'];
	if (!empty($_POST['Fono2']))                 $Fono2 	              = $_POST['Fono2'];
	if (!empty($_POST['idCiudad']))              $idCiudad                = $_POST['idCiudad'];
	if (!empty($_POST['idComuna']))              $idComuna                = $_POST['idComuna'];
	if (!empty($_POST['Fax']))                   $Fax                     = $_POST['Fax'];
	if (!empty($_POST['GeoLatitud']))            $GeoLatitud              = $_POST['GeoLatitud'];
	if (!empty($_POST['GeoLongitud']))           $GeoLongitud             = $_POST['GeoLongitud'];

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
			case 'idColegio':              if(empty($idColegio)){              $error['idColegio']               = 'error/No ha ingresado el id';}break;
			case 'idSistema':              if(empty($idSistema)){              $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':               if(empty($idEstado)){               $error['idEstado']                = 'error/No ha seleccionado el Estado';}break;
			case 'email':                  if(empty($email)){                  $error['email']                   = 'error/No ha ingresado el email';}break;
			case 'Nombre':                 if(empty($Nombre)){                 $error['Nombre']                  = 'error/No ha ingresado el Nombre de Fantasia';}break;
			case 'Direccion':              if(empty($Direccion)){              $error['Direccion']               = 'error/No ha ingresado la dirección';}break;
			case 'Fono1':                  if(empty($Fono1)){                  $error['Fono1']                   = 'error/No ha ingresado el telefono';}break;
			case 'Fono2':                  if(empty($Fono2)){                  $error['Fono2']                   = 'error/No ha ingresado el telefono';}break;
			case 'idCiudad':               if(empty($idCiudad)){               $error['idCiudad']                = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':               if(empty($idComuna)){               $error['idComuna']                = 'error/No ha seleccionado la comuna';}break;
			case 'Fax':                    if(empty($Fax)){                    $error['Fax']                     = 'error/No ha ingresado el fax';}break;
			case 'GeoLatitud':             if(empty($GeoLatitud)){             $error['GeoLatitud']              = 'error/No ha ingresado la latitud';}break;
			case 'GeoLongitud':            if(empty($GeoLongitud)){            $error['GeoLongitud']             = 'error/No ha ingresado la longitud';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	//if(isset($email) && $email!=''){          $email      = EstandarizarInput($email);}
	if(isset($Nombre) && $Nombre!=''){        $Nombre     = EstandarizarInput($Nombre);}
	if(isset($Direccion) && $Direccion!=''){  $Direccion  = EstandarizarInput($Direccion);}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($email)&&contar_palabras_censuradas($email)!=0){          $error['email']     = 'error/Edita email, contiene palabras no permitidas';}
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){        $error['Nombre']    = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){  $error['Direccion'] = 'error/Edita la Direccion, contiene palabras no permitidas';}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){   $error['email']   = 'error/El Email ingresado no es valido';}
	if(isset($Fono1)&&!validarNumero($Fono1)){  $error['Fono1']   = 'error/Ingrese un numero telefonico valido';}
	if(isset($Fono2)&&!validarNumero($Fono2)){  $error['Fono2']   = 'error/Ingrese un numero telefonico valido';}

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
			if(isset($Nombre, $idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'colegios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut, $idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'colegios_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email, $idSistema)){
				$ndata_3 = db_select_nrows (false, 'email', 'colegios_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			//Consulto la latitud y la longitud
			if(isset($idCiudad, $idComuna, $Direccion) && $idCiudad != '' && $idComuna != '' && $Direccion!=''){
				//variable con la dirección
				$address = '';
				if(isset($idCiudad) && $idCiudad!=''){
					$rowData = db_select_data (false, 'Nombre', 'core_ubicacion_ciudad', '', 'idCiudad = "'.$idCiudad.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowData['Nombre'].', ';
				}
				if(isset($idComuna) && $idComuna!=''){
					$rowData = db_select_data (false, 'Nombre', 'core_ubicacion_comunas', '', 'idComuna = "'.$idComuna.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowData['Nombre'].', ';
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
						$error['ndata_4'] = 'error/Detalles de la dirección incorrectos!';
					}
				}else{
					$error['ndata_4'] = 'error/Sin dirección ingresada';
				}
			}else{
				$error['ndata_4'] = 'error/Sin dirección ingresada';
			}

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//filtros
				if(isset($idSistema) && $idSistema!=''){          $SIS_data  = "'".$idSistema."'";       }else{$SIS_data  = "''";}
				if(isset($idEstado) && $idEstado!=''){            $SIS_data .= ",'".$idEstado."'";       }else{$SIS_data .= ",''";}
				if(isset($email) && $email!=''){                  $SIS_data .= ",'".$email."'";          }else{$SIS_data .= ",''";}
				if(isset($Nombre) && $Nombre!=''){                $SIS_data .= ",'".$Nombre."'";         }else{$SIS_data .= ",''";}
				if(isset($Direccion) && $Direccion!=''){          $SIS_data .= ",'".$Direccion."'";      }else{$SIS_data .= ",''";}
				if(isset($Fono1) && $Fono1!=''){                  $SIS_data .= ",'".$Fono1."'";          }else{$SIS_data .= ",''";}
				if(isset($Fono2) && $Fono2!=''){                  $SIS_data .= ",'".$Fono2."'";          }else{$SIS_data .= ",''";}
				if(isset($idCiudad) && $idCiudad!=''){            $SIS_data .= ",'".$idCiudad."'";       }else{$SIS_data .= ",''";}
				if(isset($idComuna) && $idComuna!=''){            $SIS_data .= ",'".$idComuna."'";       }else{$SIS_data .= ",''";}
				if(isset($Fax) && $Fax!=''){                      $SIS_data .= ",'".$Fax."'";            }else{$SIS_data .= ",''";}
				if(isset($GeoLatitud) && $GeoLatitud!=''){        $SIS_data .= ",'".$GeoLatitud."'";     }else{$SIS_data .= ",''";}
				if(isset($GeoLongitud) && $GeoLongitud!=''){      $SIS_data .= ",'".$GeoLongitud."'";    }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idEstado, email, Nombre,Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, GeoLatitud, GeoLongitud';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'colegios_listado', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

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
			if(isset($Nombre)&&isset($idSistema)&&isset($idColegio)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'colegios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idColegio!='".$idColegio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idColegio)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'colegios_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idColegio!='".$idColegio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)&&isset($idColegio)){
				$ndata_3 = db_select_nrows (false, 'email', 'colegios_listado', '', "email='".$email."' AND idSistema='".$idSistema."' AND idColegio!='".$idColegio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			//Consulto la latitud y la longitud
			if(isset($idCiudad, $idComuna, $Direccion) && $idCiudad != '' && $idComuna != '' && $Direccion!=''){
				//variable con la dirección
				$address = '';
				if(isset($idCiudad) && $idCiudad!=''){
					$rowData = db_select_data (false, 'Nombre', 'core_ubicacion_ciudad', '', 'idCiudad = "'.$idCiudad.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowData['Nombre'].', ';
				}
				if(isset($idComuna) && $idComuna!=''){
					$rowData = db_select_data (false, 'Nombre', 'core_ubicacion_comunas', '', 'idComuna = "'.$idComuna.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					$address .= $rowData['Nombre'].', ';
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
						$error['ndata_4'] = 'error/Detalles de la dirección incorrectos!';
					}
				}else{
					$error['ndata_4'] = 'error/Sin dirección ingresada';
				}
			}else{
				$error['ndata_4'] = 'error/Sin dirección ingresada';
			}

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idColegio='".$idColegio."'";
				if(isset($idSistema) && $idSistema!=''){        $SIS_data .= ",idSistema='".$idSistema."'";}
				if(isset($idEstado) && $idEstado!=''){          $SIS_data .= ",idEstado='".$idEstado."'";}
				if(isset($email) && $email!=''){                $SIS_data .= ",email='".$email."'";}
				if(isset($Nombre) && $Nombre!=''){              $SIS_data .= ",Nombre='".$Nombre."'";}
				if(isset($Direccion) && $Direccion!=''){        $SIS_data .= ",Direccion='".$Direccion."'";}
				if(isset($Fono1) && $Fono1!=''){                $SIS_data .= ",Fono1='".$Fono1."'";}
				if(isset($Fono2) && $Fono2!=''){                $SIS_data .= ",Fono2='".$Fono2."'";}
				if(isset($idCiudad) && $idCiudad!= ''){         $SIS_data .= ",idCiudad='".$idCiudad."'";}
				if(isset($idComuna) && $idComuna!= ''){         $SIS_data .= ",idComuna='".$idComuna."'";}
				if(isset($Fax) && $Fax!= ''){                   $SIS_data .= ",Fax='".$Fax."'";}
				if(isset($GeoLatitud) && $GeoLatitud!= ''){     $SIS_data .= ",GeoLatitud='".$GeoLatitud."'";}
				if(isset($GeoLongitud) && $GeoLongitud!= ''){   $SIS_data .= ",GeoLongitud='".$GeoLongitud."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'colegios_listado', 'idColegio = "'.$idColegio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero entero';
				$errorn++;
			}

			if($errorn==0){
				//se borran los datos
				$resultado = db_delete_data (false, 'colegios_listado', 'idColegio = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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

			$idColegio  = $_GET['id'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "idEstado='".$idEstado."'";
			$resultado = db_update_data (false, $SIS_data, 'colegios_listado', 'idColegio = "'.$idColegio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
