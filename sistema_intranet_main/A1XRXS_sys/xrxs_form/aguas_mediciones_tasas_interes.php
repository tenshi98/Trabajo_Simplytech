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
	if ( !empty($_POST['idTasasInteres']) )   $idTasasInteres   = $_POST['idTasasInteres'];
	if ( !empty($_POST['idSistema']) )        $idSistema        = $_POST['idSistema'];
	if ( !empty($_POST['Fecha']) )            $Fecha            = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )              $Dia              = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )            $idMes            = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )              $Ano              = $_POST['Ano'];
	if ( isset($_POST['TasaCorriente']) )     $TasaCorriente    = $_POST['TasaCorriente'];
	if ( isset($_POST['TasaDia']) )           $TasaDia          = $_POST['TasaDia'];
	if ( isset($_POST['MC']) )                $MC               = $_POST['MC'];
	
	
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
			case 'idTasasInteres':  if(empty($idTasasInteres)){  $error['idTasasInteres']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':       if(empty($idSistema)){       $error['idSistema']         = 'error/No ha seleccionado el sistema';}break;
			case 'Fecha':           if(empty($Fecha)){           $error['Fecha']             = 'error/No ha ingresado la Fecha';}break;
			case 'Dia':             if(empty($Dia)){             $error['Dia']               = 'error/No ha ingresado el Dia';}break;
			case 'idMes':           if(empty($idMes)){           $error['idMes']             = 'error/No ha ingresado el Mes';}break;
			case 'Ano':             if(empty($Ano)){             $error['Ano']               = 'error/No ha ingresado el año';}break;
			case 'TasaCorriente':   if(!isset($TasaCorriente)){  $error['TasaCorriente']     = 'error/No ha ingresado la Tasa Corriente';}break;
			case 'TasaDia':         if(!isset($TasaDia)){        $error['TasaDia']           = 'error/No ha ingresado la Tasa Dia';}break;
			case 'MC':              if(!isset($MC)){             $error['MC']                = 'error/No ha ingresado el MC';}break;
			
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
			if(isset($Fecha)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Fecha', 'aguas_mediciones_tasas_interes', '', "Fecha='".$Fecha."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){             $a  = "'".$idSistema."'" ;       }else{$a  ="''";}
				if(isset($Fecha) && $Fecha != ''){                     
					$a .= ",'".$Fecha."'" ; 
					$a .= ",'".fecha2NdiaMes($Fecha)."'" ;
					$a .= ",'".fecha2NMes($Fecha)."'" ;
					$a .= ",'".fecha2Ano($Fecha)."'" ;         
				}else{
					$a .=",''";
					$a .=",''";
					$a .=",''";
					$a .=",''";
				}
				if(isset($TasaCorriente) && $TasaCorriente != ''){     $a .= ",'".$TasaCorriente."'" ;  }else{$a .=",''";}
				if(isset($TasaDia) && $TasaDia != ''){                 $a .= ",'".$TasaDia."'" ;        }else{$a .=",''";}
				if(isset($MC) && $MC != ''){                           $a .= ",'".$MC."'" ;             }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `aguas_mediciones_tasas_interes` (idSistema, Fecha, Dia, 
				idMes, Ano, TasaCorriente, TasaDia, MC) 
				VALUES (".$a.")";
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
			if(isset($Fecha)&&isset($idSistema)&&isset($idTasasInteres)){
				$ndata_1 = db_select_nrows (false, 'Fecha', 'aguas_mediciones_tasas_interes', '', "Fecha='".$Fecha."' AND idSistema='".$idSistema."' AND idTasasInteres!='".$idTasasInteres."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Dato ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idTasasInteres='".$idTasasInteres."'" ;
				if(isset($idSistema) && $idSistema != ''){             $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Fecha) && $Fecha != ''){                     
					$a .= ",Fecha='".$Fecha."'" ;
					$a .= ",Dia='".fecha2NdiaMes($Fecha)."'" ;
					$a .= ",idMes='".fecha2NMes($Fecha)."'" ;
					$a .= ",Ano='".fecha2Ano($Fecha)."'" ;   
				}
				if(isset($TasaCorriente) && $TasaCorriente != ''){     $a .= ",TasaCorriente='".$TasaCorriente."'" ;}
				if(isset($TasaDia) && $TasaDia != ''){                 $a .= ",TasaDia='".$TasaDia."'" ;}
				if(isset($MC) && $MC != ''){                           $a .= ",MC='".$MC."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'aguas_mediciones_tasas_interes', 'idTasasInteres = "'.$idTasasInteres.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				//se borran los datos
				$resultado = db_delete_data (false, 'aguas_mediciones_tasas_interes', 'idTasasInteres = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
