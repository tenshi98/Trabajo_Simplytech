<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-011).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idDato']))                $idDato                  = $_POST['idDato'];
	if (!empty($_POST['idSistema']))             $idSistema               = $_POST['idSistema'];
	if (!empty($_POST['valorCargoFijo']))        $valorCargoFijo          = $_POST['valorCargoFijo'];
	if (!empty($_POST['valorCargoFijoNeto']))    $valorCargoFijoNeto      = $_POST['valorCargoFijoNeto'];
	if (!empty($_POST['valorAgua']))             $valorAgua               = $_POST['valorAgua'];
	if (!empty($_POST['valorAguaNeto']))         $valorAguaNeto           = $_POST['valorAguaNeto'];
	if (!empty($_POST['valorRecoleccion']))      $valorRecoleccion        = $_POST['valorRecoleccion'];
	if (!empty($_POST['valorRecoleccionNeto']))  $valorRecoleccionNeto    = $_POST['valorRecoleccionNeto'];
	if (!empty($_POST['valorVisitaCorte']))      $valorVisitaCorte        = $_POST['valorVisitaCorte'];
	if (!empty($_POST['valorVisitaCorteNeto']))  $valorVisitaCorteNeto    = $_POST['valorVisitaCorteNeto'];
	if (!empty($_POST['valorCorte1']))           $valorCorte1             = $_POST['valorCorte1'];
	if (!empty($_POST['valorCorte1Neto']))       $valorCorte1Neto         = $_POST['valorCorte1Neto'];
	if (!empty($_POST['valorCorte2']))           $valorCorte2             = $_POST['valorCorte2'];
	if (!empty($_POST['valorCorte2Neto']))       $valorCorte2Neto         = $_POST['valorCorte2Neto'];
	if (!empty($_POST['valorReposicion1']))      $valorReposicion1        = $_POST['valorReposicion1'];
	if (!empty($_POST['valorReposicion1Neto']))  $valorReposicion1Neto    = $_POST['valorReposicion1Neto'];
	if (!empty($_POST['valorReposicion2']))      $valorReposicion2        = $_POST['valorReposicion2'];
	if (!empty($_POST['valorReposicion2Neto']))  $valorReposicion2Neto    = $_POST['valorReposicion2Neto'];
	if (!empty($_POST['NdiasPago']))             $NdiasPago               = $_POST['NdiasPago'];
	if (!empty($_POST['Fac_nEmergencia']))       $Fac_nEmergencia         = $_POST['Fac_nEmergencia'];
	if (!empty($_POST['Fac_nConsultas']))        $Fac_nConsultas          = $_POST['Fac_nConsultas'];

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
			case 'idDato':                  if(empty($idDato)){                  $error['idDato']                  = 'error/No ha ingresado el id';}break;
			case 'idSistema':               if(empty($idSistema)){               $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'valorCargoFijo':          if(empty($valorCargoFijo)){          $error['valorCargoFijo']          = 'error/No ha ingresado el valor Cargo Fijo';}break;
			case 'valorCargoFijoNeto':      if(empty($valorCargoFijoNeto)){      $error['valorCargoFijoNeto']      = 'error/No ha ingresado el valor Cargo Fijo Neto';}break;
			case 'valorAgua':               if(empty($valorAgua)){               $error['valorAgua']               = 'error/No ha ingresado el valor Agua';}break;
			case 'valorAguaNeto':           if(empty($valorAguaNeto)){           $error['valorAguaNeto']           = 'error/No ha ingresado el valor Agua Neto';}break;
			case 'valorRecoleccion':        if(empty($valorRecoleccion)){        $error['valorRecoleccion']        = 'error/No ha ingresado el valor Recoleccion';}break;
			case 'valorRecoleccionNeto':    if(empty($valorRecoleccionNeto)){    $error['valorRecoleccionNeto']    = 'error/No ha ingresado el valor Recoleccion Neto';}break;
			case 'valorVisitaCorte':        if(empty($valorVisitaCorte)){        $error['valorVisitaCorte']        = 'error/No ha ingresado el valor Visita Corte';}break;
			case 'valorVisitaCorteNeto':    if(empty($valorVisitaCorteNeto)){    $error['valorVisitaCorteNeto']    = 'error/No ha ingresado el valor Visita Corte Neto';}break;
			case 'valorCorte1':             if(empty($valorCorte1)){             $error['valorCorte1']             = 'error/No ha ingresado el valor Corte 1 instancia';}break;
			case 'valorCorte1Neto':         if(empty($valorCorte1Neto)){         $error['valorCorte1Neto']         = 'error/No ha ingresado el valor Corte 1 instancia Neto';}break;
			case 'valorCorte2':             if(empty($valorCorte2)){             $error['valorCorte2']             = 'error/No ha ingresado el valor Corte 2 instancia';}break;
			case 'valorCorte2Neto':         if(empty($valorCorte2Neto)){         $error['valorCorte2Neto']         = 'error/No ha ingresado el valor Corte 2 instancia Neto';}break;
			case 'valorReposicion1':        if(empty($valorReposicion1)){        $error['valorReposicion1']        = 'error/No ha ingresado el valor Reposicion 1 instancia';}break;
			case 'valorReposicion1Neto':    if(empty($valorReposicion1Neto)){    $error['valorReposicion1Neto']    = 'error/No ha ingresado el valor Reposicion 1 instancia Neto';}break;
			case 'valorReposicion2':        if(empty($valorReposicion2)){        $error['valorReposicion2']        = 'error/No ha ingresado el valor Reposicion 2 instancia';}break;
			case 'valorReposicion2Neto':    if(empty($valorReposicion2Neto)){    $error['valorReposicion2Neto']    = 'error/No ha ingresado el valor Reposicion 2 instancia Neto';}break;
			case 'NdiasPago':               if(empty($NdiasPago)){               $error['NdiasPago']               = 'error/No ha ingresado el N dias Pago';}break;
			case 'Fac_nEmergencia':         if(empty($Fac_nEmergencia)){         $error['Fac_nEmergencia']         = 'error/No ha ingresado el Fono numero Emergencia';}break;
			case 'Fac_nConsultas':          if(empty($Fac_nConsultas)){          $error['Fac_nConsultas']          = 'error/No ha ingresado el Fono numero Consultas';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($valorCargoFijo) && $valorCargoFijo!=''){              $valorCargoFijo        = EstandarizarInput($valorCargoFijo);}
	if(isset($valorCargoFijoNeto) && $valorCargoFijoNeto!=''){      $valorCargoFijoNeto    = EstandarizarInput($valorCargoFijoNeto);}
	if(isset($valorAgua) && $valorAgua!=''){                        $valorAgua             = EstandarizarInput($valorAgua);}
	if(isset($valorAguaNeto) && $valorAguaNeto!=''){                $valorAguaNeto         = EstandarizarInput($valorAguaNeto);}
	if(isset($valorRecoleccion) && $valorRecoleccion!=''){          $valorRecoleccion      = EstandarizarInput($valorRecoleccion);}
	if(isset($valorRecoleccionNeto) && $valorRecoleccionNeto!=''){  $valorRecoleccionNeto  = EstandarizarInput($valorRecoleccionNeto);}
	if(isset($valorVisitaCorte) && $valorVisitaCorte!=''){          $valorVisitaCorte      = EstandarizarInput($valorVisitaCorte);}
	if(isset($valorVisitaCorteNeto) && $valorVisitaCorteNeto!=''){  $valorVisitaCorteNeto  = EstandarizarInput($valorVisitaCorteNeto);}
	if(isset($valorCorte1) && $valorCorte1!=''){                    $valorCorte1           = EstandarizarInput($valorCorte1);}
	if(isset($valorCorte1Neto) && $valorCorte1Neto!=''){            $valorCorte1Neto       = EstandarizarInput($valorCorte1Neto);}
	if(isset($valorCorte2) && $valorCorte2!=''){                    $valorCorte2           = EstandarizarInput($valorCorte2);}
	if(isset($valorCorte2Neto) && $valorCorte2Neto!=''){            $valorCorte2Neto       = EstandarizarInput($valorCorte2Neto);}
	if(isset($valorReposicion1) && $valorReposicion1!=''){          $valorReposicion1      = EstandarizarInput($valorReposicion1);}
	if(isset($valorReposicion1Neto) && $valorReposicion1Neto!=''){  $valorReposicion1Neto  = EstandarizarInput($valorReposicion1Neto);}
	if(isset($valorReposicion2) && $valorReposicion2!=''){          $valorReposicion2      = EstandarizarInput($valorReposicion2);}
	if(isset($valorReposicion2Neto) && $valorReposicion2Neto!=''){  $valorReposicion2Neto  = EstandarizarInput($valorReposicion2Neto);}
	if(isset($NdiasPago) && $NdiasPago!=''){                        $NdiasPago             = EstandarizarInput($NdiasPago);}
	if(isset($Fac_nEmergencia) && $Fac_nEmergencia!=''){            $Fac_nEmergencia       = EstandarizarInput($Fac_nEmergencia);}
	if(isset($Fac_nConsultas) && $Fac_nConsultas!=''){              $Fac_nConsultas        = EstandarizarInput($Fac_nConsultas);}

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
			if(isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'idSistema', 'aguas_datos_valores', '', "idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//filtros
				if(isset($idSistema) && $idSistema!=''){                 $SIS_data  = "'".$idSistema."'";                                                               }else{ $SIS_data  = "''";}
				if(isset($valorCargoFijo) && $valorCargoFijo!=''){       $SIS_data .= ",'".$valorCargoFijo."'";      $SIS_data .= ",'".($valorCargoFijo / 1.19)."'";    }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorAgua) && $valorAgua!=''){                 $SIS_data .= ",'".$valorAgua."'";           $SIS_data .= ",'".($valorAgua / 1.19)."'";         }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorRecoleccion) && $valorRecoleccion!=''){   $SIS_data .= ",'".$valorRecoleccion."'";    $SIS_data .= ",'".($valorRecoleccion / 1.19)."'";  }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorVisitaCorte) && $valorVisitaCorte!=''){   $SIS_data .= ",'".$valorVisitaCorte."'";    $SIS_data .= ",'".($valorVisitaCorte / 1.19)."'";  }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorCorte1) && $valorCorte1!=''){             $SIS_data .= ",'".$valorCorte1."'";         $SIS_data .= ",'".($valorCorte1 / 1.19)."'";       }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorCorte2) && $valorCorte2!=''){             $SIS_data .= ",'".$valorCorte2."'";         $SIS_data .= ",'".($valorCorte2 / 1.19)."'";       }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorReposicion1) && $valorReposicion1!=''){   $SIS_data .= ",'".$valorReposicion1."'";    $SIS_data .= ",'".($valorReposicion1 / 1.19)."'";  }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($valorReposicion2) && $valorReposicion2!=''){   $SIS_data .= ",'".$valorReposicion2."'";    $SIS_data .= ",'".($valorReposicion2 / 1.19)."'";  }else{ $SIS_data .= ",''"; $SIS_data .= ",''"; }
				if(isset($NdiasPago) && $NdiasPago!=''){                 $SIS_data .= ",'".$NdiasPago."'";                                                              }else{ $SIS_data .= ",''";}
				if(isset($Fac_nEmergencia) && $Fac_nEmergencia!=''){     $SIS_data .= ",'".$Fac_nEmergencia."'";                                                        }else{ $SIS_data .= ",''";}
				if(isset($Fac_nConsultas) && $Fac_nConsultas!=''){       $SIS_data .= ",'".$Fac_nConsultas."'";                                                         }else{ $SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'idSistema, valorCargoFijo, valorCargoFijoNeto,
				valorAgua, valorAguaNeto, valorRecoleccion, valorRecoleccionNeto, valorVisitaCorte,
				valorVisitaCorteNeto, valorCorte1, valorCorte1Neto, valorCorte2, valorCorte2Neto,
				valorReposicion1, valorReposicion1Neto, valorReposicion2, valorReposicion2Neto,
				NdiasPago, Fac_nEmergencia, Fac_nConsultas';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_datos_valores', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){

					//redirijo
					header( 'Location: '.$location.'?created=true' );
					die;

				}
			}

		break;
/*******************************************************************************************************************/
		case 'update':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idDato='".$idDato."'";
				if(isset($idSistema) && $idSistema!=''){                         $SIS_data .= ",idSistema='".$idSistema."'";}

				if(isset($valorCargoFijo) && $valorCargoFijo!=''){               $SIS_data .= ",valorCargoFijo='".$valorCargoFijo."'";       $SIS_data .= ",valorCargoFijoNeto='".($valorCargoFijo / 1.19)."'";}
				if(isset($valorAgua) && $valorAgua!=''){                         $SIS_data .= ",valorAgua='".$valorAgua."'";                 $SIS_data .= ",valorAguaNeto='".($valorAgua / 1.19)."'";}
				if(isset($valorRecoleccion) && $valorRecoleccion!=''){           $SIS_data .= ",valorRecoleccion='".$valorRecoleccion."'";   $SIS_data .= ",valorRecoleccionNeto='".($valorRecoleccion / 1.19)."'";}
				if(isset($valorVisitaCorte) && $valorVisitaCorte!=''){           $SIS_data .= ",valorVisitaCorte='".$valorVisitaCorte."'";   $SIS_data .= ",valorVisitaCorteNeto='".($valorVisitaCorte / 1.19)."'";}
				if(isset($valorCorte1) && $valorCorte1!=''){                     $SIS_data .= ",valorCorte1='".$valorCorte1."'";             $SIS_data .= ",valorCorte1Neto='".($valorCorte1 / 1.19)."'";}
				if(isset($valorCorte2) && $valorCorte2!=''){                     $SIS_data .= ",valorCorte2='".$valorCorte2."'";             $SIS_data .= ",valorCorte2Neto='".($valorCorte2 / 1.19)."'";}
				if(isset($valorReposicion1) && $valorReposicion1!=''){           $SIS_data .= ",valorReposicion1='".$valorReposicion1."'";   $SIS_data .= ",valorReposicion1Neto='".($valorReposicion1 / 1.19)."'";}
				if(isset($valorReposicion2) && $valorReposicion2!=''){           $SIS_data .= ",valorReposicion2='".$valorReposicion2."'";   $SIS_data .= ",valorReposicion2Neto='".($valorReposicion2 / 1.19)."'";}

				if(isset($NdiasPago) && $NdiasPago!=''){                         $SIS_data .= ",NdiasPago='".$NdiasPago."'";}
				if(isset($Fac_nEmergencia) && $Fac_nEmergencia!=''){             $SIS_data .= ",Fac_nEmergencia='".$Fac_nEmergencia."'";}
				if(isset($Fac_nConsultas) && $Fac_nConsultas!=''){               $SIS_data .= ",Fac_nConsultas='".$Fac_nConsultas."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_datos_valores', 'idDato = "'.$idDato.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
					header( 'Location: '.$location.'?edited=true' );
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
				$resultado = db_delete_data (false, 'aguas_datos_valores', 'idDato = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){

					//redirijo
					header( 'Location: '.$location.'?deleted=true' );
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
