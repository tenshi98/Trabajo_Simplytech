<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
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
	if ( !empty($_POST['idDato']) )                $idDato                  = $_POST['idDato'];
	if ( !empty($_POST['idSistema']) )             $idSistema               = $_POST['idSistema'];
	if ( !empty($_POST['valorCargoFijo']) )        $valorCargoFijo          = $_POST['valorCargoFijo'];
	if ( !empty($_POST['valorCargoFijoNeto']) )    $valorCargoFijoNeto      = $_POST['valorCargoFijoNeto'];
	if ( !empty($_POST['valorAgua']) )             $valorAgua               = $_POST['valorAgua'];
	if ( !empty($_POST['valorAguaNeto']) )         $valorAguaNeto           = $_POST['valorAguaNeto'];
	if ( !empty($_POST['valorRecoleccion']) )      $valorRecoleccion        = $_POST['valorRecoleccion'];
	if ( !empty($_POST['valorRecoleccionNeto']) )  $valorRecoleccionNeto    = $_POST['valorRecoleccionNeto'];
	if ( !empty($_POST['valorVisitaCorte']) )      $valorVisitaCorte        = $_POST['valorVisitaCorte'];
	if ( !empty($_POST['valorVisitaCorteNeto']) )  $valorVisitaCorteNeto    = $_POST['valorVisitaCorteNeto'];
	if ( !empty($_POST['valorCorte1']) )           $valorCorte1             = $_POST['valorCorte1'];
	if ( !empty($_POST['valorCorte1Neto']) )       $valorCorte1Neto         = $_POST['valorCorte1Neto'];
	if ( !empty($_POST['valorCorte2']) )           $valorCorte2             = $_POST['valorCorte2'];
	if ( !empty($_POST['valorCorte2Neto']) )       $valorCorte2Neto         = $_POST['valorCorte2Neto'];
	if ( !empty($_POST['valorReposicion1']) )      $valorReposicion1        = $_POST['valorReposicion1'];
	if ( !empty($_POST['valorReposicion1Neto']) )  $valorReposicion1Neto    = $_POST['valorReposicion1Neto'];
	if ( !empty($_POST['valorReposicion2']) )      $valorReposicion2        = $_POST['valorReposicion2'];
	if ( !empty($_POST['valorReposicion2Neto']) )  $valorReposicion2Neto    = $_POST['valorReposicion2Neto'];
	if ( !empty($_POST['NdiasPago']) )             $NdiasPago               = $_POST['NdiasPago'];
	if ( !empty($_POST['Fac_nEmergencia']) )       $Fac_nEmergencia         = $_POST['Fac_nEmergencia'];
	if ( !empty($_POST['Fac_nConsultas']) )        $Fac_nConsultas          = $_POST['Fac_nConsultas'];
	
	
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
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                         $a  = "'".$idSistema."'";                 }else{$a  ="''";}
				
				if(isset($valorCargoFijo) && $valorCargoFijo != ''){       $a .= ",'".$valorCargoFijo."'";      $a .= ",'".($valorCargoFijo / 1.19)."'";    }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorAgua) && $valorAgua != ''){                 $a .= ",'".$valorAgua."'";           $a .= ",'".($valorAgua / 1.19)."'";         }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorRecoleccion) && $valorRecoleccion != ''){   $a .= ",'".$valorRecoleccion."'";    $a .= ",'".($valorRecoleccion / 1.19)."'";  }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorVisitaCorte) && $valorVisitaCorte != ''){   $a .= ",'".$valorVisitaCorte."'";    $a .= ",'".($valorVisitaCorte / 1.19)."'";  }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorCorte1) && $valorCorte1 != ''){             $a .= ",'".$valorCorte1."'";         $a .= ",'".($valorCorte1 / 1.19)."'";       }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorCorte2) && $valorCorte2 != ''){             $a .= ",'".$valorCorte2."'";         $a .= ",'".($valorCorte2 / 1.19)."'";       }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorReposicion1) && $valorReposicion1 != ''){   $a .= ",'".$valorReposicion1."'";    $a .= ",'".($valorReposicion1 / 1.19)."'";  }else{ $a .=",''"; $a .=",''"; }
				if(isset($valorReposicion2) && $valorReposicion2 != ''){   $a .= ",'".$valorReposicion2."'";    $a .= ",'".($valorReposicion2 / 1.19)."'";  }else{ $a .=",''"; $a .=",''"; }
				
				if(isset($NdiasPago) && $NdiasPago != ''){                         $a .= ",'".$NdiasPago."'";                }else{$a .=",''";}
				if(isset($Fac_nEmergencia) && $Fac_nEmergencia != ''){             $a .= ",'".$Fac_nEmergencia."'";          }else{$a .=",''";}
				if(isset($Fac_nConsultas) && $Fac_nConsultas != ''){               $a .= ",'".$Fac_nConsultas."'";           }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `aguas_datos_valores` (idSistema, valorCargoFijo, valorCargoFijoNeto,
				valorAgua, valorAguaNeto, valorRecoleccion, valorRecoleccionNeto, valorVisitaCorte,
				valorVisitaCorteNeto, valorCorte1, valorCorte1Neto, valorCorte2, valorCorte2Neto,
				valorReposicion1, valorReposicion1Neto, valorReposicion2, valorReposicion2Neto,
				NdiasPago, Fac_nEmergencia, Fac_nConsultas ) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'?created=true' );
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
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idDato='".$idDato."'";
				if(isset($idSistema) && $idSistema != ''){                         $a .= ",idSistema='".$idSistema."'";}
				
				if(isset($valorCargoFijo) && $valorCargoFijo != ''){               $a .= ",valorCargoFijo='".$valorCargoFijo."'";       $a .= ",valorCargoFijoNeto='".($valorCargoFijo / 1.19)."'";}
				if(isset($valorAgua) && $valorAgua != ''){                         $a .= ",valorAgua='".$valorAgua."'";                 $a .= ",valorAguaNeto='".($valorAgua / 1.19)."'";}
				if(isset($valorRecoleccion) && $valorRecoleccion != ''){           $a .= ",valorRecoleccion='".$valorRecoleccion."'";   $a .= ",valorRecoleccionNeto='".($valorRecoleccion / 1.19)."'";}
				if(isset($valorVisitaCorte) && $valorVisitaCorte != ''){           $a .= ",valorVisitaCorte='".$valorVisitaCorte."'";   $a .= ",valorVisitaCorteNeto='".($valorVisitaCorte / 1.19)."'";}
				if(isset($valorCorte1) && $valorCorte1 != ''){                     $a .= ",valorCorte1='".$valorCorte1."'";             $a .= ",valorCorte1Neto='".($valorCorte1 / 1.19)."'";}
				if(isset($valorCorte2) && $valorCorte2 != ''){                     $a .= ",valorCorte2='".$valorCorte2."'";             $a .= ",valorCorte2Neto='".($valorCorte2 / 1.19)."'";}
				if(isset($valorReposicion1) && $valorReposicion1 != ''){           $a .= ",valorReposicion1='".$valorReposicion1."'";   $a .= ",valorReposicion1Neto='".($valorReposicion1 / 1.19)."'";}
				if(isset($valorReposicion2) && $valorReposicion2 != ''){           $a .= ",valorReposicion2='".$valorReposicion2."'";   $a .= ",valorReposicion2Neto='".($valorReposicion2 / 1.19)."'";}
				
				if(isset($NdiasPago) && $NdiasPago != ''){                         $a .= ",NdiasPago='".$NdiasPago."'";}
				if(isset($Fac_nEmergencia) && $Fac_nEmergencia != ''){             $a .= ",Fac_nEmergencia='".$Fac_nEmergencia."'";}
				if(isset($Fac_nConsultas) && $Fac_nConsultas != ''){               $a .= ",Fac_nConsultas='".$Fac_nConsultas."'";}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `aguas_datos_valores` SET ".$a." WHERE idDato = '$idDato'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location.'?edited=true' );
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
