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
	if ( !empty($_POST['idInasistenciaHora']) )    $idInasistenciaHora     = $_POST['idInasistenciaHora'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idTrabajador']) )          $idTrabajador           = $_POST['idTrabajador'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha_ingreso']) )         $Fecha_ingreso          = $_POST['Fecha_ingreso'];
	if ( !empty($_POST['Creacion_fecha']) )        $Creacion_fecha         = $_POST['Creacion_fecha'];
	if ( !empty($_POST['Horas']) )                 $Horas                  = $_POST['Horas'];
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
			case 'idInasistenciaHora':    if(empty($idInasistenciaHora)){    $error['idInasistenciaHora']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':             if(empty($idSistema)){             $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idTrabajador':          if(empty($idTrabajador)){          $error['idTrabajador']          = 'error/No ha seleccionado el trabajador';}break;
			case 'idUsuario':             if(empty($idUsuario)){             $error['idUsuario']             = 'error/No ha seleccionado el usuario';}break;
			case 'Fecha_ingreso':         if(empty($Fecha_ingreso)){         $error['Fecha_ingreso']         = 'error/No ha ingresado la fecha de ingreso del documento';}break;
			case 'Creacion_fecha':        if(empty($Creacion_fecha)){        $error['Creacion_fecha']        = 'error/No ha ingresado la fecha de creacion';}break;
			case 'Horas':                 if(empty($Horas)){                 $error['Horas']                 = 'error/No ha ingresado la cantidad de horas';}break;
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
			if(isset($Creacion_fecha)&&isset($idTrabajador)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Creacion_fecha', 'trabajadores_inasistencias_horas', '', "Creacion_fecha='".$Creacion_fecha."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El atraso ya existe en el sistema';}
			/*******************************************************************/
			//verifico que no se ingrese una fecha superior a la fecha actual
			if($Creacion_fecha>fecha_actual()){
				$error['ndata_1'] = 'error/No puede ingresar una fecha a futuro inexistente';
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){            $a  = "'".$idSistema."'" ;       }else{$a  ="''";}
				if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",'".$idTrabajador."'" ;   }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;      }else{$a .=",''";}
				if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){    $a .= ",'".$Fecha_ingreso."'" ;  }else{$a .=",''";}
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
				if(isset($Horas) && $Horas != ''){                $a .= ",'".$Horas."'" ;        }else{$a .=",''";}
				if(isset($Observacion) && $Observacion != ''){    $a .= ",'".$Observacion."'" ;  }else{$a .=",''";}
				if(isset($idUso) && $idUso != ''){                $a .= ",'".$idUso."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_inasistencias_horas` (idSistema, idTrabajador, idUsuario,
				Fecha_ingreso, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano,
				Horas, Observacion, idUso) 
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
			if(isset($Creacion_fecha)&&isset($idTrabajador)&&isset($idInasistenciaHora)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Creacion_fecha', 'trabajadores_inasistencias_horas', '', "Creacion_fecha='".$Creacion_fecha."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."' AND idInasistenciaHora!='".$idInasistenciaHora."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El atraso ya existe en el sistema';}
			/*******************************************************************/
			//verifico que no se ingrese una fecha superior a la fecha actual
			if($Creacion_fecha>fecha_actual()){
				$error['ndata_1'] = 'error/No puede ingresar una fecha a futuro inexistente';
			}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idInasistenciaHora='".$idInasistenciaHora."'" ;
				if(isset($idSistema) && $idSistema != ''){            $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Fecha_ingreso) && $Fecha_ingreso != ''){    $a .= ",Fecha_ingreso='".$Fecha_ingreso."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;  
					$a .= ",Creacion_Semana='".fecha2NSemana($Creacion_fecha)."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;
				}
				if(isset($Horas) && $Horas != ''){                $a .= ",Horas='".$Horas."'" ;}
				if(isset($Observacion) && $Observacion != ''){    $a .= ",Observacion='".$Observacion."'" ;}
				if(isset($idUso) && $idUso != ''){                $a .= ",idUso='".$idUso."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_inasistencias_horas` SET ".$a." WHERE idInasistenciaHora = '$idInasistenciaHora'";
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
			$query  = "DELETE FROM `trabajadores_inasistencias_horas` WHERE idInasistenciaHora = {$_GET['del']}";
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
