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
	if ( !empty($_POST['idParametros']) )  $idParametros   = $_POST['idParametros'];
	if ( !empty($_POST['Nombre']) )        $Nombre         = $_POST['Nombre'];
	if ( isset($_POST['Codigo']) )         $Codigo         = $_POST['Codigo'];
	if ( isset($_POST['Rango_min']) )      $Rango_min      = $_POST['Rango_min'];
	if ( isset($_POST['Rango_max']) )      $Rango_max      = $_POST['Rango_max'];
	if ( !empty($_POST['idSistema']) )     $idSistema      = $_POST['idSistema'];
	
	
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
			case 'idParametros':  if(empty($idParametros)){   $error['idParametros']   = 'error/No ha ingresado el id';}break;
			case 'Nombre':        if(empty($Nombre)){         $error['Nombre']         = 'error/No ha ingresado el nombre';}break;
			case 'Codigo':        if(!isset($Codigo)){        $error['Codigo']         = 'error/No ha ingresado el Codigo';}break;
			case 'Rango_min':     if(!isset($Rango_min)){     $error['Rango_min']      = 'error/No ha ingresado la Rango minimo';}break;
			case 'Rango_max':     if(!isset($Rango_max)){     $error['Rango_max']      = 'error/No ha ingresado el Rango maximo';}break;
			case 'idSistema':     if(empty($idSistema)){      $error['idSistema']      = 'error/No ha seleccionado el sistema';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){  $error['Nombre'] = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Codigo)&&contar_palabras_censuradas($Codigo)!=0){  $error['Codigo'] = 'error/Edita Codigo, contiene palabras no permitidas'; }	

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
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'aguas_analisis_parametros', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Codigo)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Codigo', 'aguas_analisis_parametros', '', "Codigo='".$Codigo."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ingresado ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Codigo ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){            $a  = "'".$Nombre."'" ;         }else{$a  ="''";}
				if(isset($Codigo) && $Codigo != ''){            $a .= ",'".$Codigo."'" ;        }else{$a .=",''";}
				if(isset($Rango_min) && $Rango_min != ''){      $a .= ",'".$Rango_min."'" ;     }else{$a .=",''";}
				if(isset($Rango_max) && $Rango_max != ''){      $a .= ",'".$Rango_max."'" ;     }else{$a .=",''";}
				if(isset($idSistema) && $idSistema != ''){      $a .= ",'".$idSistema."'" ;     }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `aguas_analisis_parametros` (Nombre, Codigo, Rango_min, Rango_max, 
				idSistema) 
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
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idParametros)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'aguas_analisis_parametros', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idParametros!='".$idParametros."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Codigo)&&isset($idSistema)&&isset($idParametros)){
				$ndata_2 = db_select_nrows (false, 'Codigo', 'aguas_analisis_parametros', '', "Codigo='".$Codigo."' AND idSistema='".$idSistema."' AND idParametros!='".$idParametros."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ingresado ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Codigo ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idParametros='".$idParametros."'" ;
				if(isset($Nombre) && $Nombre != ''){           $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Codigo) && $Codigo != ''){           $a .= ",Codigo='".$Codigo."'" ;}
				if(isset($Rango_min) && $Rango_min != ''){     $a .= ",Rango_min='".$Rango_min."'" ;}
				if(isset($Rango_max) && $Rango_max != ''){     $a .= ",Rango_max='".$Rango_max."'" ;}
				if(isset($idSistema) && $idSistema != ''){     $a .= ",idSistema='".$idSistema."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'aguas_analisis_parametros', 'idParametros = "'.$idParametros.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'aguas_analisis_parametros', 'idParametros = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
