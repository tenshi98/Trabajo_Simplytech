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
	if ( !empty($_POST['idStreaming']) )          $idStreaming            = $_POST['idStreaming'];
	if ( !empty($_POST['idSistema']) )            $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )             $idEstado               = $_POST['idEstado'];
	if ( !empty($_POST['idTipo']) )               $idTipo                 = $_POST['idTipo'];
	if ( !empty($_POST['idUsuario']) )            $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['Nombre']) )               $Nombre                 = $_POST['Nombre'];
	if ( !empty($_POST['Fecha']) )                $Fecha                  = $_POST['Fecha'];
	if ( !empty($_POST['HoraInicio']) )           $HoraInicio             = $_POST['HoraInicio'];
	if ( !empty($_POST['HoraTermino']) )          $HoraTermino            = $_POST['HoraTermino'];
	
	
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
			case 'idStreaming':          if(empty($idStreaming)){           $error['idStreaming']          = 'error/No ha ingresado el id';}break;
			case 'idSistema':            if(empty($idSistema)){             $error['idSistema']            = 'error/No ha seleccionado el sistema al cual pertenece';}break;
			case 'idEstado':             if(empty($idEstado)){              $error['idEstado']             = 'error/No ha seleccionado el estado';}break;
			case 'idTipo':               if(empty($idTipo)){                $error['idTipo']               = 'error/No ha seleccionado el tipo';}break;
			case 'idUsuario':            if(empty($idUsuario)){             $error['idUsuario']            = 'error/No ha seleccionado el usuario creador';}break;
			case 'Nombre':               if(empty($Nombre)){                $error['Nombre']               = 'error/No ha ingresado el nombre';}break;
			case 'Fecha':                if(empty($Fecha)){                 $error['Fecha']                = 'error/No ha ingresado la fecha';}break;
			case 'HoraInicio':           if(empty($HoraInicio)){            $error['HoraInicio']           = 'error/No ha ingresado la hora inicio';}break;
			case 'HoraTermino':          if(empty($HoraTermino)){           $error['HoraTermino']          = 'error/No ha ingresado la hora de termino';}break;
			
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
			//generacion de errores
			if($HoraInicio > $HoraTermino) {$error['ndata_1'] = 'error/La Hora de Inicio es superior a la Hora de Termino';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){         $a  = "'".$idSistema."'" ;        }else{$a  = "''";}
				if(isset($idEstado) && $idEstado != ''){           $a .= ",'".$idEstado."'" ;        }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){               $a .= ",'".$idTipo."'" ;          }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){         $a .= ",'".$idUsuario."'" ;       }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;          }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){                 $a .= ",'".$Fecha."'" ;           }else{$a .= ",''";}
				if(isset($HoraInicio) && $HoraInicio != ''){       $a .= ",'".$HoraInicio."'" ;      }else{$a .= ",''";}
				if(isset($HoraTermino) && $HoraTermino != ''){     $a .= ",'".$HoraTermino."'" ;     }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `comunicaciones_streaming_listado` (idSistema, idEstado, 
				idTipo, idUsuario, Nombre, Fecha, HoraInicio, HoraTermino) 
				VALUES (".$a.")";
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
			//generacion de errores
			if($HoraInicio > $HoraTermino) {$error['ndata_1'] = 'error/La Hora de Inicio es superior a la Hora de Termino';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idStreaming='".$idStreaming."'" ;
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTipo) && $idTipo != ''){             $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Fecha) && $Fecha != ''){               $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($HoraInicio) && $HoraInicio != ''){     $a .= ",HoraInicio='".$HoraInicio."'" ;}
				if(isset($HoraTermino) && $HoraTermino != ''){   $a .= ",HoraTermino='".$HoraTermino."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'comunicaciones_streaming_listado', 'idStreaming = "'.$idStreaming.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
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
				$resultado_1 = db_delete_data (false, 'comunicaciones_streaming_listado', 'idStreaming = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'comunicaciones_streaming_listado_usuarios', 'idStreaming = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
