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
	if ( !empty($_POST['idRutaAlt']) )     $idRutaAlt     = $_POST['idRutaAlt'];
	if ( !empty($_POST['idRuta']) )        $idRuta        = $_POST['idRuta'];
	if ( !empty($_POST['idSistema']) )     $idSistema     = $_POST['idSistema'];
	if ( !empty($_POST['idTipo']) )        $idTipo        = $_POST['idTipo'];
	if ( !empty($_POST['Fecha']) )         $Fecha         = $_POST['Fecha'];
	if ( !empty($_POST['idDia']) )         $idDia         = $_POST['idDia'];
	if ( !empty($_POST['HoraInicio']) )    $HoraInicio    = $_POST['HoraInicio'];
	if ( !empty($_POST['HoraTermino']) )   $HoraTermino   = $_POST['HoraTermino'];
	if ( !empty($_POST['Nombre']) )        $Nombre        = $_POST['Nombre'];


	
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
			case 'idRutaAlt':    if(empty($idRutaAlt)){    $error['idRutaAlt']     = 'error/No ha ingresado el id';}break;
			case 'idRuta':       if(empty($idRuta)){       $error['idRuta']        = 'error/No ha seleccionado el sistema';}break;
			case 'idSistema':    if(empty($idSistema)){    $error['idSistema']     = 'error/No ha ingresado el nombre';}break;
			case 'idTipo':       if(empty($idTipo)){       $error['idTipo']        = 'error/No ha ingresado el id';}break;
			case 'Fecha':        if(empty($Fecha)){        $error['Fecha']         = 'error/No ha seleccionado el sistema';}break;
			case 'idDia':        if(empty($idDia)){        $error['idDia']         = 'error/No ha ingresado el nombre';}break;
			case 'HoraInicio':   if(empty($HoraInicio)){   $error['HoraInicio']    = 'error/No ha ingresado el id';}break;
			case 'HoraTermino':  if(empty($HoraTermino)){  $error['HoraTermino']   = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':       if(empty($Nombre)){       $error['Nombre']        = 'error/No ha ingresado el nombre';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){  $error['Nombre'] = 'error/Edita Nombre, contiene palabras no permitidas'; }	

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
			if(isset($Nombre)&&isset($idSistema)&&isset($idRuta)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'vehiculos_ruta_alternativa', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idRuta='".$idRuta."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idRuta) && $idRuta != ''){              $a  = "'".$idRuta."'" ;         }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){        $a .= ",'".$idSistema."'" ;     }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){              $a .= ",'".$idTipo."'" ;        }else{$a .=",''";}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",'".$Fecha."'" ;         }else{$a .=",''";}
				if(isset($idDia) && $idDia != ''){                $a .= ",'".$idDia."'" ;         }else{$a .=",''";}
				if(isset($HoraInicio) && $HoraInicio != ''){      $a .= ",'".$HoraInicio."'" ;    }else{$a .=",''";}
				if(isset($HoraTermino) && $HoraTermino != ''){    $a .= ",'".$HoraTermino."'" ;   }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){              $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `vehiculos_ruta_alternativa` (idRuta, idSistema, idTipo, Fecha, idDia, HoraInicio,
				HoraTermino, Nombre) VALUES (".$a.")";
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
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idRuta)&&isset($idRutaAlt)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'vehiculos_ruta_alternativa', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idRuta='".$idRuta."' AND idRutaAlt!='".$idRutaAlt."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idRutaAlt='".$idRutaAlt."'" ;
				if(isset($idRuta) && $idRuta != ''){              $a .= ",idRuta='".$idRuta."'" ;}
				if(isset($idSistema) && $idSistema != ''){        $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTipo) && $idTipo != ''){              $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($Fecha) && $Fecha != ''){                $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($idDia) && $idDia != ''){                $a .= ",idDia='".$idDia."'" ;}
				if(isset($HoraInicio) && $HoraInicio != ''){      $a .= ",HoraInicio='".$HoraInicio."'" ;}
				if(isset($HoraTermino) && $HoraTermino != ''){    $a .= ",HoraTermino='".$HoraTermino."'" ;}
				if(isset($Nombre) && $Nombre != ''){              $a .= ",Nombre='".$Nombre."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'vehiculos_ruta_alternativa', 'idRutaAlt = "'.$idRutaAlt.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
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
				$resultado_1 = db_delete_data (false, 'vehiculos_ruta_alternativa', 'idRutaAlt = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'vehiculos_ruta_alternativa_ubicaciones', 'idRutaAlt = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado_1==true OR $resultado_2==true){
					
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
