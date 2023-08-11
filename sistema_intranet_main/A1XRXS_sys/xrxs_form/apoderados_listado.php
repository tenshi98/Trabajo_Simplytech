<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-025).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idApoderado']))                 $idApoderado                  = $_POST['idApoderado'];
	if (!empty($_POST['idSistema']))                   $idSistema                    = $_POST['idSistema'];
	if (!empty($_POST['idEstado']))                    $idEstado                     = $_POST['idEstado'];
	if (!empty($_POST['Nombre']))                      $Nombre                       = $_POST['Nombre'];
	if (!empty($_POST['ApellidoPat']))                 $ApellidoPat                  = $_POST['ApellidoPat'];
	if (!empty($_POST['ApellidoMat']))                 $ApellidoMat                  = $_POST['ApellidoMat'];
	if (!empty($_POST['Fono1']))                       $Fono1                        = $_POST['Fono1'];
	if (!empty($_POST['Fono2']))                       $Fono2                        = $_POST['Fono2'];
	if (!empty($_POST['FNacimiento']))                 $FNacimiento                  = $_POST['FNacimiento'];
	if (!empty($_POST['Rut']))                         $Rut                          = $_POST['Rut'];
	if (!empty($_POST['idCiudad']))                    $idCiudad                     = $_POST['idCiudad'];
	if (!empty($_POST['idComuna']))                    $idComuna                     = $_POST['idComuna'];
	if (!empty($_POST['Direccion']))                   $Direccion                    = $_POST['Direccion'];
	if (!empty($_POST['F_Inicio_Contrato']))           $F_Inicio_Contrato            = $_POST['F_Inicio_Contrato'];
	if (!empty($_POST['F_Termino_Contrato']))          $F_Termino_Contrato           = $_POST['F_Termino_Contrato'];
	if (!empty($_POST['Password']))                    $Password                     = $_POST['Password'];
	if (!empty($_POST['dispositivo']))                 $dispositivo                  = $_POST['dispositivo'];
	if (!empty($_POST['IMEI']))                        $IMEI                         = $_POST['IMEI'];
	if (!empty($_POST['GSM']))                         $GSM                          = $_POST['GSM'];
	if (!empty($_POST['GeoLatitud']))                  $GeoLatitud                   = $_POST['GeoLatitud'];
	if (!empty($_POST['GeoLongitud']))                 $GeoLongitud                  = $_POST['GeoLongitud'];
	if (!empty($_POST['idOpciones_1']))                $idOpciones_1                 = $_POST['idOpciones_1'];
	if (!empty($_POST['idOpciones_2']))                $idOpciones_2                 = $_POST['idOpciones_2'];
	if (!empty($_POST['idOpciones_3']))                $idOpciones_3                 = $_POST['idOpciones_3'];
	if (!empty($_POST['idOpciones_4']))                $idOpciones_4                 = $_POST['idOpciones_4'];
	if (!empty($_POST['idOpciones_5']))                $idOpciones_5                 = $_POST['idOpciones_5'];

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
			case 'idApoderado':                 if(empty($idApoderado)){                  $error['idApoderado']                  = 'error/No ha ingresado el id';}break;
			case 'idSistema':                   if(empty($idSistema)){                    $error['idSistema']                    = 'error/No ha seleccionado el sistema al cual pertenece';}break;
			case 'idEstado':                    if(empty($idEstado)){                     $error['idEstado']                     = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':                      if(empty($Nombre)){                       $error['Nombre']                       = 'error/No ha ingresado el nombre de la persona';}break;
			case 'ApellidoPat':                 if(empty($ApellidoPat)){                  $error['ApellidoPat']                  = 'error/No ha ingresado el apellido paterno de la persona';}break;
			case 'ApellidoMat':                 if(empty($ApellidoMat)){                  $error['ApellidoMat']                  = 'error/No ha ingresado el apellido materno de la persona';}break;
			case 'Fono1':                       if(empty($Fono1)){                        $error['Fono1']                        = 'error/No ha ingresado el Fono1 a desempeñar';}break;
			case 'Fono2':                       if(empty($Fono2)){                        $error['Fono2']                        = 'error/No ha ingresado el Fono2';}break;
			case 'FNacimiento':                 if(empty($FNacimiento)){                  $error['FNacimiento']                  = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'Rut':                         if(empty($Rut)){                          $error['Rut']                          = 'error/No ha ingresado el rut';}break;
			case 'idCiudad':                    if(empty($idCiudad)){                     $error['idCiudad']                     = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':                    if(empty($idComuna)){                     $error['idComuna']                     = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':                   if(empty($Direccion)){                    $error['Direccion']                    = 'error/No ha ingresado la dirección';}break;
			case 'F_Inicio_Contrato':           if(empty($F_Inicio_Contrato)){            $error['F_Inicio_Contrato']            = 'error/No ha ingresado la fecha de inicio';}break;
			case 'F_Termino_Contrato':          if(empty($F_Termino_Contrato)){           $error['F_Termino_Contrato']           = 'error/No ha ingresado la fecha de termino';}break;
			case 'Password':                    if(empty($Password)){                     $error['Password']                     = 'error/No ha ingresado la password';}break;
			case 'dispositivo':                 if(empty($dispositivo)){                  $error['dispositivo']                  = 'error/No ha ingresado el dispositivo utilizado';}break;
			case 'IMEI':                        if(empty($IMEI)){                         $error['IMEI']                         = 'error/No ha ingresado el imei del equipo';}break;
			case 'GSM':                         if(empty($GSM)){                          $error['GSM']                          = 'error/No ha ingresado el gsm del equipo';}break;
			case 'GeoLatitud':                  if(empty($GeoLatitud)){                   $error['GeoLatitud']                   = 'error/No ha ingresado la latitud del equipo';}break;
			case 'GeoLongitud':                 if(empty($GeoLongitud)){                  $error['GeoLongitud']                  = 'error/No ha ingresado la longitud del equipo';}break;
			case 'idOpciones_1':                if(empty($idOpciones_1)){                 $error['idOpciones_1']                 = 'error/No ha ingresado la opción 1';}break;
			case 'idOpciones_2':                if(empty($idOpciones_2)){                 $error['idOpciones_2']                 = 'error/No ha ingresado la opción 2';}break;
			case 'idOpciones_3':                if(empty($idOpciones_3)){                 $error['idOpciones_3']                 = 'error/No ha ingresado la opción 3';}break;
			case 'idOpciones_4':                if(empty($idOpciones_4)){                 $error['idOpciones_4']                 = 'error/No ha ingresado la opción 4';}break;
			case 'idOpciones_5':                if(empty($idOpciones_5)){                 $error['idOpciones_5']                 = 'error/No ha ingresado la opción 5';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Nombre) && $Nombre!=''){           $Nombre         = EstandarizarInput($Nombre);}
	if(isset($ApellidoPat) && $ApellidoPat!=''){ $ApellidoPat    = EstandarizarInput($ApellidoPat);}
	if(isset($ApellidoMat) && $ApellidoMat!=''){ $ApellidoMat    = EstandarizarInput($ApellidoMat);}
	if(isset($Direccion) && $Direccion!=''){     $Direccion      = EstandarizarInput($Direccion);}
	if(isset($Password) && $Password!=''){       $Password       = EstandarizarInput($Password);}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	//Verifica si el mail corresponde
	if(isset($Fono1)&&!validarNumero($Fono1)){  $error['Fono1']   = 'error/Ingrese un numero telefonico valido';}
	if(isset($Fono2)&&!validarNumero($Fono2)){  $error['Fono2']   = 'error/Ingrese un numero telefonico valido';}
	//if(isset($Rut)&&!validarRut($Rut)){       $error['Rut']    = 'error/El Rut ingresado no es valido';}

	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){            $error['Nombre']      = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($ApellidoPat)&&contar_palabras_censuradas($ApellidoPat)!=0){  $error['ApellidoPat'] = 'error/Edita Apellido Pat, contiene palabras no permitidas';}
	if(isset($ApellidoMat)&&contar_palabras_censuradas($ApellidoMat)!=0){  $error['ApellidoMat'] = 'error/Edita Apellido Mat, contiene palabras no permitidas';}
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){      $error['Direccion']   = 'error/Edita Direccion, contiene palabras no permitidas';}
	if(isset($Password)&&contar_palabras_censuradas($Password)!=0){        $error['Password']    = 'error/Edita la Password, contiene palabras no permitidas';}

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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'apoderados_listado', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'apoderados_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El apoderado que intenta ingresar ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//Se genera una password aleatoria
				$Password = genera_password(6,'alfanumerico');

				//filtros
				if(isset($idSistema) && $idSistema!=''){                       $SIS_data  = "'".$idSistema."'";               }else{$SIS_data  = "''";}
				if(isset($idEstado) && $idEstado!=''){                         $SIS_data .= ",'".$idEstado."'";               }else{$SIS_data .= ",''";}
				if(isset($Nombre) && $Nombre!=''){                             $SIS_data .= ",'".$Nombre."'";                 }else{$SIS_data .= ",''";}
				if(isset($ApellidoPat) && $ApellidoPat!=''){                   $SIS_data .= ",'".$ApellidoPat."'";            }else{$SIS_data .= ",''";}
				if(isset($ApellidoMat) && $ApellidoMat!=''){                   $SIS_data .= ",'".$ApellidoMat."'";            }else{$SIS_data .= ",''";}
				if(isset($Fono1) && $Fono1!=''){                               $SIS_data .= ",'".$Fono1."'";                  }else{$SIS_data .= ",''";}
				if(isset($Fono2) && $Fono2!=''){                               $SIS_data .= ",'".$Fono2."'";                  }else{$SIS_data .= ",''";}
				if(isset($FNacimiento) && $FNacimiento!=''){                   $SIS_data .= ",'".$FNacimiento."'";            }else{$SIS_data .= ",''";}
				if(isset($Rut) && $Rut!=''){                                   $SIS_data .= ",'".$Rut."'";                    }else{$SIS_data .= ",''";}
				if(isset($idCiudad) && $idCiudad!=''){                         $SIS_data .= ",'".$idCiudad."'";               }else{$SIS_data .= ",''";}
				if(isset($idComuna) && $idComuna!=''){                         $SIS_data .= ",'".$idComuna."'";               }else{$SIS_data .= ",''";}
				if(isset($Direccion) && $Direccion!=''){                       $SIS_data .= ",'".$Direccion."'";              }else{$SIS_data .= ",''";}
				if(isset($F_Inicio_Contrato) && $F_Inicio_Contrato!=''){       $SIS_data .= ",'".$F_Inicio_Contrato."'";      }else{$SIS_data .= ",''";}
				if(isset($F_Termino_Contrato) && $F_Termino_Contrato!=''){     $SIS_data .= ",'".$F_Termino_Contrato."'";     }else{$SIS_data .= ",''";}
				if(isset($Password) && $Password!=''){                         $SIS_data .= ",'".md5($Password)."'";          }else{$SIS_data .= ",''";}
				if(isset($dispositivo) && $dispositivo!=''){                   $SIS_data .= ",'".$dispositivo."'";            }else{$SIS_data .= ",''";}
				if(isset($IMEI) && $IMEI!=''){                                 $SIS_data .= ",'".$IMEI."'";                   }else{$SIS_data .= ",''";}
				if(isset($GSM) && $GSM!=''){                                   $SIS_data .= ",'".$GSM."'";                    }else{$SIS_data .= ",''";}
				if(isset($GeoLatitud) && $GeoLatitud!=''){                     $SIS_data .= ",'".$GeoLatitud."'";             }else{$SIS_data .= ",''";}
				if(isset($GeoLongitud) && $GeoLongitud!=''){                   $SIS_data .= ",'".$GeoLongitud."'";            }else{$SIS_data .= ",''";}
				if(isset($idOpciones_1) && $idOpciones_1!=''){                 $SIS_data .= ",'".$idOpciones_1."'";           }else{$SIS_data .= ",''";}
				if(isset($idOpciones_2) && $idOpciones_2!=''){                 $SIS_data .= ",'".$idOpciones_2."'";           }else{$SIS_data .= ",''";}
				if(isset($idOpciones_3) && $idOpciones_3!=''){                 $SIS_data .= ",'".$idOpciones_3."'";           }else{$SIS_data .= ",''";}
				if(isset($idOpciones_4) && $idOpciones_4!=''){                 $SIS_data .= ",'".$idOpciones_4."'";           }else{$SIS_data .= ",''";}
				if(isset($idOpciones_5) && $idOpciones_5!=''){                 $SIS_data .= ",'".$idOpciones_5."'";           }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idEstado, Nombre,ApellidoPat, ApellidoMat, Fono1,
				Fono2, FNacimiento, Rut, idCiudad, idComuna, Direccion, F_Inicio_Contrato,
				F_Termino_Contrato, Password, dispositivo, IMEI, GSM, GeoLatitud, GeoLongitud,
				idOpciones_1, idOpciones_2, idOpciones_3, idOpciones_4, idOpciones_5';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'apoderados_listado', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

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
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idSistema)&&isset($idApoderado)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'apoderados_listado', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idSistema='".$idSistema."' AND idApoderado!='".$idApoderado."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idApoderado)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'apoderados_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idApoderado!='".$idApoderado."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El apoderado que intenta ingresar ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idApoderado='".$idApoderado."'";
				if(isset($idSistema) && $idSistema!=''){                     $SIS_data .= ",idSistema='".$idSistema."'";}
				if(isset($idEstado) && $idEstado!=''){                       $SIS_data .= ",idEstado='".$idEstado."'";}
				if(isset($Nombre) && $Nombre!=''){                           $SIS_data .= ",Nombre='".$Nombre."'";}
				if(isset($ApellidoPat) && $ApellidoPat!=''){                 $SIS_data .= ",ApellidoPat='".$ApellidoPat."'";}
				if(isset($ApellidoMat) && $ApellidoMat!=''){                 $SIS_data .= ",ApellidoMat='".$ApellidoMat."'";}
				if(isset($Fono1) && $Fono1!=''){                             $SIS_data .= ",Fono1='".$Fono1."'";}
				if(isset($Fono2) && $Fono2!=''){                             $SIS_data .= ",Fono2='".$Fono2."'";}
				if(isset($FNacimiento) && $FNacimiento!=''){                 $SIS_data .= ",FNacimiento='".$FNacimiento."'";}
				if(isset($Rut) && $Rut!=''){                                 $SIS_data .= ",Rut='".$Rut."'";}
				if(isset($idCiudad) && $idCiudad!=''){                       $SIS_data .= ",idCiudad='".$idCiudad."'";}
				if(isset($idComuna) && $idComuna!=''){                       $SIS_data .= ",idComuna='".$idComuna."'";}
				if(isset($Direccion) && $Direccion!=''){                     $SIS_data .= ",Direccion='".$Direccion."'";}
				if(isset($F_Inicio_Contrato) && $F_Inicio_Contrato!=''){     $SIS_data .= ",F_Inicio_Contrato='".$F_Inicio_Contrato."'";}
				if(isset($F_Termino_Contrato) && $F_Termino_Contrato!=''){   $SIS_data .= ",F_Termino_Contrato='".$F_Termino_Contrato."'";}
				if(isset($Password) && $Password!=''){                       $SIS_data .= ",Password='".md5($Password)."'";}
				if(isset($dispositivo) && $dispositivo!=''){                 $SIS_data .= ",dispositivo='".$dispositivo."'";}
				if(isset($IMEI) && $IMEI!=''){                               $SIS_data .= ",IMEI='".$IMEI."'";}
				if(isset($GSM) && $GSM!=''){                                 $SIS_data .= ",GSM='".$GSM."'";}
				if(isset($GeoLatitud) && $GeoLatitud!=''){                   $SIS_data .= ",GeoLatitud='".$GeoLatitud."'";}
				if(isset($GeoLongitud) && $GeoLongitud!=''){                 $SIS_data .= ",GeoLongitud='".$GeoLongitud."'";}
				if(isset($idOpciones_1) && $idOpciones_1!=''){               $SIS_data .= ",idOpciones_1='".$idOpciones_1."'";}
				if(isset($idOpciones_2) && $idOpciones_2!=''){               $SIS_data .= ",idOpciones_2='".$idOpciones_2."'";}
				if(isset($idOpciones_3) && $idOpciones_3!=''){               $SIS_data .= ",idOpciones_3='".$idOpciones_3."'";}
				if(isset($idOpciones_4) && $idOpciones_4!=''){               $SIS_data .= ",idOpciones_4='".$idOpciones_4."'";}
				if(isset($idOpciones_5) && $idOpciones_5!=''){               $SIS_data .= ",idOpciones_5='".$idOpciones_5."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'apoderados_listado', 'idApoderado = "'.$idApoderado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				// Se obtiene el nombre del archivo
				$rowdata = db_select_data (false, 'Direccion_img, File_Contrato', 'apoderados_listado', '', "idApoderado = ".$indice, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//se borran los datos
				$resultado = db_delete_data (false, 'apoderados_listado', 'idApoderado = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){

					//se elimina la foto
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

					//se elimina el contrato
					if(isset($rowdata['File_Contrato'])&&$rowdata['File_Contrato']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['File_Contrato'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['File_Contrato']);
							}
						}catch(Exception $e) {
							//guardar el dato en un archivo log
						}
					}

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
		//Cambio el estado de activo a inactivo
		case 'estado':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			$idApoderado  = $_GET['id'];
			$idEstado     = simpleDecode($_GET['estado'], fecha_actual());

			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "idEstado='".$idEstado."'";
			$resultado = db_update_data (false, $SIS_data, 'apoderados_listado', 'idApoderado = "'.$idApoderado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){

				header( 'Location: '.$location.'&edited=true' );
				die;

			}

		break;
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_img':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			if ($_FILES["Direccion_img"]["error"] > 0){
				$error['Direccion_img'] = 'error/'.uploadPHPError($_FILES["Direccion_img"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'apod_img_'.$idApoderado.'_';

				if (in_array($_FILES['Direccion_img']['type'], $permitidos) && $_FILES['Direccion_img']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Direccion_img']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						//$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], $ruta);
						//Muevo el archivo
						$move_result = @move_uploaded_file($_FILES["Direccion_img"]["tmp_name"], "upload/xxxsxx_".$_FILES['Direccion_img']['name']);
						if ($move_result){

							//se selecciona la imagen
							switch ($_FILES['Direccion_img']['type']) {
								case 'image/jpg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/jpeg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/gif':
									$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
								case 'image/png':
									$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
									break;
							}

							//se reescala la imagen en caso de ser necesario
							$imgBase_width = imagesx( $imgBase );
							$imgBase_height = imagesy( $imgBase );

							//Se establece el tamaño maximo
							$max_width  = 640;
							$max_height = 640;

							if ($imgBase_width > $imgBase_height) {
								if($imgBase_width < $max_width){
									$newwidth = $imgBase_width;
								}else{
									$newwidth = $max_width;
								}
								$divisor = $imgBase_width / $newwidth;
								$newheight = floor( $imgBase_height / $divisor);
							}else {
								if($imgBase_height < $max_height){
									$newheight = $imgBase_height;
								}else{
									$newheight =  $max_height;
								}
								$divisor = $imgBase_height / $newheight;
								$newwidth = floor( $imgBase_width / $divisor );
							}

							$imgBase = imagescale($imgBase, $newwidth, $newheight);

							//se establece la calidad del archivo
							$quality = 75;

							//se crea la imagen
							imagejpeg($imgBase, $ruta, $quality);

							//se elimina la imagen base
							try {
								if(!is_writable('upload/xxxsxx_'.$_FILES['Direccion_img']['name'])){
									//throw new Exception('File not writable');
								}else{
									unlink('upload/xxxsxx_'.$_FILES['Direccion_img']['name']);
								}
							}catch(Exception $e) {
								//guardar el dato en un archivo log
							}
							//se eliminan las imagenes de la memoria
							imagedestroy($imgBase);

							//Filtro para idSistema
							$SIS_data = "Direccion_img='".$sufijo.$_FILES['Direccion_img']['name']."'";

							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $SIS_data, 'apoderados_listado', 'idApoderado = "'.$idApoderado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){

								header( 'Location: '.$location );
								die;

							}

						} else {
							$error['Direccion_img']     = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['Direccion_img']     = 'error/El archivo '.$_FILES['Direccion_img']['name'].' ya existe';
					}
				} else {
					$error['Direccion_img']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}


		break;
/*******************************************************************************************************************/
		case 'del_img':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// Se obtiene el nombre del archivo
			$rowdata = db_select_data (false, 'Direccion_img', 'apoderados_listado', '', "idApoderado = ".$_GET['del_img'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "Direccion_img=''";
			$resultado = db_update_data (false, $SIS_data, 'apoderados_listado', 'idApoderado = "'.$_GET['del_img'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){

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

				//redirijo
				header( 'Location: '.$location.'&id_img=true' );
				die;

			}

		break;
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_contrato':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			if ($_FILES["File_Contrato"]["error"] > 0){
				$error['File_Contrato'] = 'error/'.uploadPHPError($_FILES["File_Contrato"]["error"]);
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("application/msword",
									"application/vnd.ms-word",
									"application/vnd.openxmlformats-officedocument.wordprocessingml.document",

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
				$sufijo = 'apod_contrato_'.$idApoderado.'_';

				if (in_array($_FILES['File_Contrato']['type'], $permitidos) && $_FILES['File_Contrato']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['File_Contrato']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["File_Contrato"]["tmp_name"], $ruta);
						if ($move_result){

							//Filtro para idSistema
							$SIS_data = "File_Contrato='".$sufijo.$_FILES['File_Contrato']['name']."'";

							/*******************************************************/
							//se actualizan los datos
							$resultado = db_update_data (false, $SIS_data, 'apoderados_listado', 'idApoderado = "'.$idApoderado.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							//Si ejecuto correctamente la consulta
							if($resultado==true){

								header( 'Location: '.$location );
								die;

							}

						} else {
							$error['File_Contrato']     = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['File_Contrato']     = 'error/El archivo '.$_FILES['File_Contrato']['name'].' ya existe';
					}
				} else {
					$error['File_Contrato']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}


		break;
/*******************************************************************************************************************/
		case 'del_File_Contrato':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			// Se obtiene el nombre del archivo
			$rowdata = db_select_data (false, 'File_Contrato', 'apoderados_listado', '', "idApoderado = ".$_GET['del_File_Contrato'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

			/*******************************************************/
			//se actualizan los datos
			$SIS_data = "File_Contrato=''";
			$resultado = db_update_data (false, $SIS_data, 'apoderados_listado', 'idApoderado = "'.$_GET['del_File_Contrato'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){

				//se elimina el archivo
				if(isset($rowdata['File_Contrato'])&&$rowdata['File_Contrato']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['File_Contrato'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['File_Contrato']);
						}
					}catch(Exception $e) {
						//guardar el dato en un archivo log
					}
				}

				//redirijo
				header( 'Location: '.$location.'&id_img=true' );
				die;

			}

		break;

/*******************************************************************************************************************/
	}

?>
