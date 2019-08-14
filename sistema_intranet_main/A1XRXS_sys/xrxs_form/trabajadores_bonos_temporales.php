<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idAnticipos']) )           $idAnticipos            = $_POST['idAnticipos'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['fecha_auto']) )            $fecha_auto             = $_POST['fecha_auto'];
	if ( !empty($_POST['Creacion_fecha']) )        $Creacion_fecha         = $_POST['Creacion_fecha'];
	if ( !empty($_POST['idTrabajador']) )          $idTrabajador           = $_POST['idTrabajador'];
	if ( !empty($_POST['idBonoTemporal']) )        $idBonoTemporal         = $_POST['idBonoTemporal'];
	if ( !empty($_POST['Monto']) )                 $Monto                  = $_POST['Monto'];
	if ( !empty($_POST['Observacion']) )           $Observacion            = $_POST['Observacion'];
	if ( !empty($_POST['idUso']) )                 $idUso                  = $_POST['idUso'];
	
	
/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idAnticipos':           if(empty($idAnticipos)){           $error['idAnticipos']           = 'error/No ha ingresado el id';}break;
			case 'idSistema':             if(empty($idSistema)){             $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':             if(empty($idUsuario)){             $error['idUsuario']             = 'error/No ha seleccionado el usuario';}break;
			case 'fecha_auto':            if(empty($fecha_auto)){            $error['fecha_auto']            = 'error/No ha ingresado la fecha de ingreso del documento';}break;
			case 'Creacion_fecha':        if(empty($Creacion_fecha)){        $error['Creacion_fecha']        = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idTrabajador':          if(empty($idTrabajador)){          $error['idTrabajador']          = 'error/No ha seleccionado el trabajador';}break;
			case 'idBonoTemporal':        if(empty($idBonoTemporal)){        $error['idBonoTemporal']        = 'error/No ha seleccionado el bono';}break;
			case 'Monto':                 if(empty($Monto)){                 $error['Monto']                 = 'error/No ha ingresado el monto';}break;
			case 'Observacion':           if(empty($Observacion)){           $error['Observacion']           = 'error/No ha ingresado la observacion';}break;
			case 'idUso':                 if(empty($idUso)){                 $error['idUso']                 = 'error/No ha seleccionado la utilizacion';}break;
			
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
			if(isset($Creacion_fecha)&&isset($idTrabajador)&&isset($idSistema)&&isset($idBonoTemporal)){
				$ndata_1 = db_select_nrows ('Creacion_fecha', 'trabajadores_bonos_temporales', '', "Creacion_mes='".fecha2NMes($Creacion_fecha)."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."' AND idBonoTemporal='".$idBonoTemporal."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El bono ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){            $a  = "'".$idSistema."'" ;       }else{$a  ="''";}
				if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",'".$idTrabajador."'" ;   }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;      }else{$a .=",''";}
				if(isset($fecha_auto) && $fecha_auto != ''){          $a .= ",'".$fecha_auto."'" ;     }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;  
					$a .= ",'".fecha2NSemana($Creacion_fecha)."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idBonoTemporal) && $idBonoTemporal != ''){   $a .= ",'".$idBonoTemporal."'" ;   }else{$a .=",''";}
				if(isset($Monto) && $Monto != ''){                     $a .= ",'".$Monto."'" ;            }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){         $a .= ",'".$Observacion."'" ;      }else{$a .=",''";}
				if(isset($idUso) && $idUso != ''){                     $a .= ",'".$idUso."'" ;            }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_bonos_temporales` (idSistema, idTrabajador, idUsuario,
				fecha_auto, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, idBonoTemporal, Monto,
				Observacion, idUso) 
				VALUES ({$a} )";
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
			if(isset($Creacion_fecha)&&isset($idTrabajador)&&isset($idAnticipos)&&isset($idSistema)&&isset($idBonoTemporal)){
				$ndata_1 = db_select_nrows ('Creacion_fecha', 'trabajadores_bonos_temporales', '', "Creacion_mes='".fecha2NMes($Creacion_fecha)."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."' AND idBonoTemporal='".$idBonoTemporal."' AND idAnticipos!='".$idAnticipos."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El bono ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAnticipos='".$idAnticipos."'" ;
				if(isset($idSistema) && $idSistema != ''){            $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($fecha_auto) && $fecha_auto != ''){          $a .= ",fecha_auto='".$fecha_auto."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;  
					$a .= ",Creacion_Semana='".fecha2NSemana($Creacion_fecha)."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($idBonoTemporal) && $idBonoTemporal != ''){   $a .= ",idBonoTemporal='".$idBonoTemporal."'" ;}
				if(isset($Monto) && $Monto != ''){                     $a .= ",Monto='".$Monto."'" ;}
				if(isset($Observacion) && $Observacion != ''){         $a .= ",Observacion='".$Observacion."'" ;}
				if(isset($idUso) && $idUso != ''){                     $a .= ",idUso='".$idUso."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_bonos_temporales` SET ".$a." WHERE idAnticipos = '$idAnticipos'";
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
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `trabajadores_bonos_temporales` WHERE idAnticipos = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				header( 'Location: '.$location.'&deleted=true' );
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
			

		break;							
						
/*******************************************************************************************************************/
	}
?>
