<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridServicioad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-126).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idServicio']))            $idServicio              = $_POST['idServicio'];
	if (!empty($_POST['idTipo']))                $idTipo                  = $_POST['idTipo'];
	if (!empty($_POST['Nombre']))                $Nombre 	              = $_POST['Nombre'];
	if (!empty($_POST['Fono1']))                 $Fono1 	              = $_POST['Fono1'];
	if (!empty($_POST['Fono2']))                 $Fono2 	              = $_POST['Fono2'];
	if (!empty($_POST['idCiudad']))              $idCiudad                = $_POST['idCiudad'];
	if (!empty($_POST['idComuna']))              $idComuna                = $_POST['idComuna'];
	if (!empty($_POST['Direccion']))             $Direccion 	          = $_POST['Direccion'];
	if (!empty($_POST['email']))                 $email                   = $_POST['email'];
	if (!empty($_POST['Fax']))                   $Fax                     = $_POST['Fax'];
	if (!empty($_POST['Web']))                   $Web                     = $_POST['Web'];
	if (!empty($_POST['GeoLatitud']))            $GeoLatitud              = $_POST['GeoLatitud'];
	if (!empty($_POST['GeoLongitud']))           $GeoLongitud             = $_POST['GeoLongitud'];
	if (!empty($_POST['HoraInicio']))            $HoraInicio              = $_POST['HoraInicio'];
	if (!empty($_POST['HoraTermino']))           $HoraTermino             = $_POST['HoraTermino'];

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
			case 'idServicio':             if(empty($idServicio)){             $error['idServicio']              = 'error/No ha ingresado el id';}break;
			case 'idTipo':                 if(empty($idTipo)){                 $error['idTipo']                  = 'error/No ha seleccionado el tipo de cliente';}break;
			case 'Nombre':                 if(empty($Nombre)){                 $error['Nombre']                  = 'error/No ha ingresado el Nombre de Fantasia';}break;
			case 'Fono1':                  if(empty($Fono1)){                  $error['Fono1']                   = 'error/No ha ingresado el telefono';}break;
			case 'Fono2':                  if(empty($Fono2)){                  $error['Fono2']                   = 'error/No ha ingresado el telefono';}break;
			case 'idCiudad':               if(empty($idCiudad)){               $error['idCiudad']                = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':               if(empty($idComuna)){               $error['idComuna']                = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':              if(empty($Direccion)){              $error['Direccion']               = 'error/No ha ingresado la dirección';}break;
			case 'email':                  if(empty($email)){                  $error['email']                   = 'error/No ha ingresado el email';}break;
			case 'Fax':                    if(empty($Fax)){                    $error['Fax']                     = 'error/No ha ingresado el fax';}break;
			case 'Web':                    if(empty($Web)){                    $error['Web']                     = 'error/No ha ingresado la pagina web';}break;
			case 'GeoLatitud':             if(empty($GeoLatitud)){             $error['GeoLatitud']              = 'error/No ha ingresado la Latitud';}break;
			case 'GeoLongitud':            if(empty($GeoLongitud)){            $error['GeoLongitud']             = 'error/No ha ingresado la Longitud';}break;
			case 'HoraInicio':             if(empty($HoraInicio)){             $error['HoraInicio']              = 'error/No ha ingresado la hora de inicio';}break;
			case 'HoraTermino':            if(empty($HoraTermino)){            $error['HoraTermino']             = 'error/No ha ingresado la hora de termino';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Nombre) && $Nombre!=''){       $Nombre    = EstandarizarInput($Nombre);}
	if(isset($Direccion) && $Direccion!=''){ $Direccion = EstandarizarInput($Direccion);}
	//if(isset($email) && $email!=''){         $email     = EstandarizarInput($email);}
	if(isset($Web) && $Web!=''){             $Web       = EstandarizarInput($Web);}

/*******************************************************************************************************************/
/*                                        Verificación de los datos ingresados                                     */
/*******************************************************************************************************************/
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){        $error['email']   = 'error/El Email ingresado no es valido';}
	if(isset($Fono1)&&!validarNumero($Fono1)){       $error['Fono1']   = 'error/Ingrese un número telefónico válido';}
	if(isset($Fono2)&&!validarNumero($Fono2)){       $error['Fono2']   = 'error/Ingrese un número telefónico válido';}
	if(isset($Fono1)&&palabra_corto($Fono1, 9)!=1){  $error['Fono1']   = 'error/'.palabra_corto($Fono1, 9);}
	if(isset($Fono2)&&palabra_corto($Fono2, 9)!=1){  $error['Fono2']   = 'error/'.palabra_corto($Fono2, 9);}

	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){        $error['Nombre']    = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){  $error['Direccion'] = 'error/Edita la Direccion, contiene palabras no permitidas';}
	if(isset($email)&&contar_palabras_censuradas($email)!=0){          $error['email']     = 'error/Edita email, contiene palabras no permitidas';}
	if(isset($Web)&&contar_palabras_censuradas($Web)!=0){              $error['Web']       = 'error/Edita la Web, contiene palabras no permitidas';}

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
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seg_vecinal_servicios_listado', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)){
				$ndata_2 = db_select_nrows (false, 'email', 'seg_vecinal_servicios_listado', '', "email='".$email."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
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
				if(isset($idTipo) && $idTipo!=''){              $SIS_data  = "'".$idTipo."'";             }else{$SIS_data  = "''";}
				if(isset($Nombre) && $Nombre!=''){              $SIS_data .= ",'".$Nombre."'";            }else{$SIS_data .= ",''";}
				if(isset($Fono1) && $Fono1!=''){                $SIS_data .= ",'".$Fono1."'";             }else{$SIS_data .= ",''";}
				if(isset($Fono2) && $Fono2!=''){                $SIS_data .= ",'".$Fono2."'";             }else{$SIS_data .= ",''";}
				if(isset($idCiudad) && $idCiudad!=''){          $SIS_data .= ",'".$idCiudad."'";          }else{$SIS_data .= ",''";}
				if(isset($idComuna) && $idComuna!=''){          $SIS_data .= ",'".$idComuna."'";          }else{$SIS_data .= ",''";}
				if(isset($Direccion) && $Direccion!=''){        $SIS_data .= ",'".$Direccion."'";         }else{$SIS_data .= ",''";}
				if(isset($email) && $email!=''){                $SIS_data .= ",'".$email."'";             }else{$SIS_data .= ",''";}
				if(isset($Fax) && $Fax!=''){                    $SIS_data .= ",'".$Fax."'";               }else{$SIS_data .= ",''";}
				if(isset($Web) && $Web!=''){                    $SIS_data .= ",'".$Web."'";               }else{$SIS_data .= ",''";}
				if(isset($GeoLatitud) && $GeoLatitud!=''){      $SIS_data .= ",'".$GeoLatitud."'";        }else{$SIS_data .= ",''";}
				if(isset($GeoLongitud) && $GeoLongitud!=''){    $SIS_data .= ",'".$GeoLongitud."'";       }else{$SIS_data .= ",''";}
				if(isset($HoraInicio) && $HoraInicio!=''){      $SIS_data .= ",'".$HoraInicio."'";        }else{$SIS_data .= ",''";}
				if(isset($HoraTermino) && $HoraTermino!=''){    $SIS_data .= ",'".$HoraTermino."'";       }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idTipo, Nombre,Fono1, Fono2, idCiudad, idComuna, Direccion, email, Fax,  Web, GeoLatitud, GeoLongitud, HoraInicio, HoraTermino';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'seg_vecinal_servicios_listado', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){
					//redirijo
					header( 'Location: '.$location.'&created=true' );
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
			//Se verifica si el dato existe
			if(isset($Nombre, $idServicio)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seg_vecinal_servicios_listado', '', "Nombre='".$Nombre."' AND idServicio!='".$idServicio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idServicio)){
				$ndata_2 = db_select_nrows (false, 'email', 'seg_vecinal_servicios_listado', '', "email='".$email."' AND idServicio!='".$idServicio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
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
				//$error['ndata_4'] = 'error/Sin dirección ingresada';
			}

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idServicio='".$idServicio."'";
				if(isset($idTipo) && $idTipo!=''){               $SIS_data .= ",idTipo='".$idTipo."'";}
				if(isset($Nombre) && $Nombre!=''){               $SIS_data .= ",Nombre='".$Nombre."'";}
				if(isset($Fono1) && $Fono1!=''){                 $SIS_data .= ",Fono1='".$Fono1."'";}
				if(isset($Fono2) && $Fono2!=''){                 $SIS_data .= ",Fono2='".$Fono2."'";}
				if(isset($idCiudad) && $idCiudad!= ''){          $SIS_data .= ",idCiudad='".$idCiudad."'";}
				if(isset($idComuna) && $idComuna!= ''){          $SIS_data .= ",idComuna='".$idComuna."'";}
				if(isset($Direccion) && $Direccion!=''){         $SIS_data .= ",Direccion='".$Direccion."'";}
				if(isset($email) && $email!=''){                 $SIS_data .= ",email='".$email."'";}
				if(isset($Fax) && $Fax!= ''){                    $SIS_data .= ",Fax='".$Fax."'";}
				if(isset($Web) && $Web!= ''){                    $SIS_data .= ",Web='".$Web."'";}
				if(isset($GeoLatitud) && $GeoLatitud!= ''){      $SIS_data .= ",GeoLatitud='".$GeoLatitud."'";}
				if(isset($GeoLongitud) && $GeoLongitud!= ''){    $SIS_data .= ",GeoLongitud='".$GeoLongitud."'";}
				if(isset($HoraInicio) && $HoraInicio!= ''){      $SIS_data .= ",HoraInicio='".$HoraInicio."'";}
				if(isset($HoraTermino) && $HoraTermino!= ''){    $SIS_data .= ",HoraTermino='".$HoraTermino."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'seg_vecinal_servicios_listado', 'idServicio = "'.$idServicio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado_1 = db_delete_data (false, 'seg_vecinal_servicios_listado', 'idServicio = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado_1==true){

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
	}

?>
