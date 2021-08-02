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
	if ( !empty($_POST['idEtapaFide']) )    $idEtapaFide     = $_POST['idEtapaFide'];
	if ( !empty($_POST['idProspecto']) )    $idProspecto     = $_POST['idProspecto'];
	if ( !empty($_POST['idUsuario']) )      $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['idEtapa']) )        $idEtapa         = $_POST['idEtapa'];
	if ( !empty($_POST['Fecha']) )          $Fecha           = $_POST['Fecha'];
	if ( !empty($_POST['Observacion']) )    $Observacion     = $_POST['Observacion'];

	
	
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
			case 'idEtapaFide':    if(empty($idEtapaFide)){     $error['idEtapaFide']    = 'error/No ha ingresado el id';}break;
			case 'idProspecto':    if(empty($idProspecto)){     $error['idProspecto']    = 'error/No ha seleccionado el prospecto';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']      = 'error/No ha seleccionado un usuario';}break;
			case 'idEtapa':        if(empty($idEtapa)){         $error['idEtapa']        = 'error/No ha seleccionado una etapa';}break;
			case 'Fecha':          if(empty($Fecha)){           $error['Fecha']          = 'error/No ha ingresado la fecha';}break;
			case 'Observacion':    if(empty($Observacion)){     $error['Observacion']    = 'error/No ha ingresado la observacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Observacion)&&contar_palabras_censuradas($Observacion)!=0){  $error['Observacion'] = 'error/Edita Observacion, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idProspecto) && $idProspecto != ''){ $a = "'".$idProspecto."'" ;     }else{$a ="''";}
				if(isset($idUsuario) && $idUsuario != ''){     $a .= ",'".$idUsuario."'" ;     }else{$a .= ",''";}
				if(isset($idEtapa) && $idEtapa != ''){         $a .= ",'".$idEtapa."'" ;       }else{$a .= ",''";}
				if(isset($Fecha) && $Fecha != ''){             $a .= ",'".$Fecha."'" ;         }else{$a .= ",''";}
				if(isset($Observacion) && $Observacion != ''){ $a .= ",'".$Observacion."'" ;   }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `prospectos_transportistas_etapa_fidelizacion` (idProspecto, idUsuario, idEtapa, Fecha, Observacion) VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//Actualizo los datos
					$a = "idProspecto='".$idProspecto."'" ;
					if(isset($idEtapa) && $idEtapa!= ''){  $a .= ",idEtapa='".$idEtapa."'" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `prospectos_listado` SET ".$a." WHERE idProspecto = '$idProspecto'";
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
				$a = "idEtapaFide='".$idEtapaFide."'" ;
				if(isset($idProspecto) && $idProspecto != ''){   $a .= ",idProspecto='".$idProspecto."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){       $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEtapa) && $idEtapa != ''){           $a .= ",idEtapa='".$idEtapa."'" ;}
				if(isset($Fecha) && $Fecha != ''){               $a .= ",Fecha='".$Fecha."'" ;}
				if(isset($Observacion) && $Observacion != ''){   $a .= ",Observacion='".$Observacion."'" ;}
		
				// inserto los datos de registro en la db
				$query  = "UPDATE `prospectos_transportistas_etapa_fidelizacion` SET ".$a." WHERE idEtapaFide = '$idEtapaFide'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//Actualizo los datos
					$a = "idProspecto='".$idProspecto."'" ;
					if(isset($idEtapa) && $idEtapa!= ''){  $a .= ",idEtapa='".$idEtapa."'" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `prospectos_listado` SET ".$a." WHERE idProspecto = '$idProspecto'";
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
	}
?>
