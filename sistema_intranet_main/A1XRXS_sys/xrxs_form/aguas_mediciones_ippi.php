<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-019).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idIPPI']))      $idIPPI       = $_POST['idIPPI'];
	if (!empty($_POST['idSistema']))   $idSistema    = $_POST['idSistema'];
	if (!empty($_POST['idMes']))       $idMes        = $_POST['idMes'];
	if (!empty($_POST['Ano']))         $Ano          = $_POST['Ano'];
	if (!empty($_POST['Valor']))       $Valor        = $_POST['Valor'];

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
			case 'idIPPI':     if(empty($idIPPI)){      $error['idIPPI']      = 'error/No ha ingresado el id';}break;
			case 'idSistema':  if(empty($idSistema)){   $error['idSistema']   = 'error/No ha Seleccionado el sistema';}break;
			case 'idMes':      if(empty($idMes)){       $error['idMes']       = 'error/No ha Seleccionado el Mes';}break;
			case 'Ano':        if(empty($Ano)){         $error['Ano']         = 'error/No ha Seleccionado el Ano';}break;
			case 'Valor':      if(empty($Valor)){       $error['Valor']       = 'error/No ha ingresado el Valor';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Ano) && $Ano!=''){       $Ano   = EstandarizarInput($Ano);}
	if(isset($Valor) && $Valor!=''){   $Valor = EstandarizarInput($Valor);}

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
			if(isset($idMes)&&isset($Ano)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'idMes', 'aguas_mediciones_ippi', '', "idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//filtros
				if(isset($idSistema) && $idSistema!=''){    $SIS_data  = "'".$idSistema."'";   }else{$SIS_data  = "''";}
				if(isset($idMes) && $idMes!=''){            $SIS_data .= ",'".$idMes."'";      }else{$SIS_data .= ",''";}
				if(isset($Ano) && $Ano!=''){                $SIS_data .= ",'".$Ano."'";        }else{$SIS_data .= ",''";}
				if(isset($Valor) && $Valor!=''){            $SIS_data .= ",'".$Valor."'";      }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, idMes, Ano, Valor';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_ippi', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

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
			//Se verifica si el dato existe
			if(isset($idMes)&&isset($Ano)&&isset($idSistema)&&isset($idIPPI)){
				$ndata_1 = db_select_nrows (false, 'idMes', 'aguas_mediciones_ippi', '', "idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$idSistema."' AND idIPPI!='".$idIPPI."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idIPPI='".$idIPPI."'";
				if(isset($idSistema) && $idSistema!=''){   $SIS_data .= ",idSistema='".$idSistema."'";}
				if(isset($idMes) && $idMes!=''){           $SIS_data .= ",idMes='".$idMes."'";}
				if(isset($Ano) && $Ano!=''){               $SIS_data .= ",Ano='".$Ano."'";}
				if(isset($Valor) && $Valor!=''){           $SIS_data .= ",Valor='".$Valor."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_ippi', 'idIPPI = "'.$idIPPI.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'aguas_mediciones_ippi', 'idIPPI = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
	}

?>
