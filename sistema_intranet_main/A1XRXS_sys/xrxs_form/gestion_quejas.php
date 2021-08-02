<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridQuejaad                                                */
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
	if ( !empty($_POST['idQueja']) )           $idQueja            = $_POST['idQueja'];
	if ( !empty($_POST['idSistema']) )         $idSistema          = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )         $idUsuario          = $_POST['idUsuario'];
	if ( !empty($_POST['idUsuarioQueja']) )    $idUsuarioQueja     = $_POST['idUsuarioQueja'];
	if ( !empty($_POST['idTrabajadorQueja']) ) $idTrabajadorQueja  = $_POST['idTrabajadorQueja'];
	if ( !empty($_POST['NombreQueja']) )       $NombreQueja        = $_POST['NombreQueja'];
	if ( !empty($_POST['idTipoQueja']) )       $idTipoQueja        = $_POST['idTipoQueja'];
	if ( !empty($_POST['Observaciones']) )     $Observaciones      = $_POST['Observaciones'];
	if ( !empty($_POST['FechaQueja']) )        $FechaQueja         = $_POST['FechaQueja'];
	
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
			case 'idQueja':           if(empty($idQueja)){            $error['idQueja']            = 'error/No ha ingresado el id';}break;
			case 'idSistema':         if(empty($idSistema)){          $error['idSistema']          = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':         if(empty($idUsuario)){          $error['idUsuario']          = 'error/No ha seleccionado el usuario';}break;
			case 'idUsuarioQueja':    if(empty($idUsuarioQueja)){     $error['idUsuarioQueja']     = 'error/No ha ingresado el usuario de la queja';}break;
			case 'idTrabajadorQueja': if(empty($idTrabajadorQueja)){  $error['idTrabajadorQueja']  = 'error/No ha ingresado el trabajador de la queja';}break;
			case 'NombreQueja':       if(empty($NombreQueja)){        $error['NombreQueja']        = 'error/No ha ingresado la persona de la queja';}break;
			case 'idTipoQueja':       if(empty($idTipoQueja)){        $error['idTipoQueja']        = 'error/No ha seleccionado el tipo de queja';}break;
			case 'Observaciones':     if(empty($Observaciones)){      $error['Observaciones']      = 'error/No ha ingresado la Observacion';}break;
			case 'FechaQueja':        if(empty($FechaQueja)){         $error['FechaQueja']         = 'error/No ha ingresado la fecha de creacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($NombreQueja)&&contar_palabras_censuradas($NombreQueja)!=0){      $error['NombreQueja']   = 'error/Edita Nombre Queja, contiene palabras no permitidas'; }	
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){  $error['Observaciones'] = 'error/Edita Observaciones, contiene palabras no permitidas'; }	
	
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
			//verifico que hay alguien
			if((!isset($idUsuarioQueja) OR $idUsuarioQueja=='')&&(!isset($idTrabajadorQueja) OR $idTrabajadorQueja=='')&&(!isset($NombreQueja) OR $NombreQueja=='')) {$error['ndata_2'] = 'error/No ha ingresado quien se queja';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                    $a  = "'".$idSistema."'" ;          }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){                    $a .= ",'".$idUsuario."'" ;         }else{$a .= ",''";}
				if(isset($idUsuarioQueja) && $idUsuarioQueja != ''){          $a .= ",'".$idUsuarioQueja."'" ;    }else{$a .= ",''";}
				if(isset($idTrabajadorQueja) && $idTrabajadorQueja != ''){    $a .= ",'".$idTrabajadorQueja."'" ; }else{$a .= ",''";}
				if(isset($NombreQueja) && $NombreQueja != ''){                $a .= ",'".$NombreQueja."'" ;       }else{$a .= ",''";}
				if(isset($idTipoQueja) && $idTipoQueja != ''){                $a .= ",'".$idTipoQueja."'" ;       }else{$a .= ",''";}
				if(isset($Observaciones) && $Observaciones != ''){            $a .= ",'".$Observaciones."'" ;     }else{$a .= ",''";}
				if(isset($FechaQueja) && $FechaQueja != ''){                  $a .= ",'".$FechaQueja."'" ;        }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `gestion_quejas` (idSistema, idUsuario, 
				idUsuarioQueja, idTrabajadorQueja, NombreQueja, idTipoQueja, Observaciones, FechaQueja) 
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
			//verifico que hay alguien
			if((!isset($idUsuarioQueja) OR $idUsuarioQueja=='')&&(!isset($idTrabajadorQueja) OR $idTrabajadorQueja=='')&&(!isset($NombreQueja) OR $NombreQueja=='')) {$error['ndata_2'] = 'error/No ha ingresado quien se queja';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idQueja='".$idQueja."'" ;
				if(isset($idSistema) && $idSistema != ''){                 $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){                 $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idUsuarioQueja) && $idUsuarioQueja != ''){       $a .= ",idUsuarioQueja='".$idUsuarioQueja."'" ;}
				if(isset($idTrabajadorQueja) && $idTrabajadorQueja != ''){ $a .= ",idTrabajadorQueja='".$idTrabajadorQueja."'" ;}
				if(isset($NombreQueja) && $NombreQueja != ''){             $a .= ",NombreQueja='".$NombreQueja."'" ;}
				if(isset($idTipoQueja) && $idTipoQueja != ''){             $a .= ",idTipoQueja='".$idTipoQueja."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){         $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($FechaQueja) && $FechaQueja != ''){               $a .= ",FechaQueja='".$FechaQueja."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `gestion_quejas` SET ".$a." WHERE idQueja = '$idQueja'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
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
				$resultado = db_delete_data (false, 'gestion_quejas', 'idQueja = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
