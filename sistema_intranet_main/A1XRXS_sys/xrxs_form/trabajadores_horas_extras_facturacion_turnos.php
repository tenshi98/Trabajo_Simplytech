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
	if ( !empty($_POST['idServicios']) )           $idServicios            = $_POST['idServicios'];
	if ( !empty($_POST['idFacturacion']) )         $idFacturacion          = $_POST['idFacturacion'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['fecha_auto']) )            $fecha_auto             = $_POST['fecha_auto'];
	if ( !empty($_POST['Creacion_fecha']) )        $Creacion_fecha         = $_POST['Creacion_fecha'];
	if ( !empty($_POST['idTrabajador']) )          $idTrabajador           = $_POST['idTrabajador'];
	if ( !empty($_POST['idTurnos']) )              $idTurnos               = $_POST['idTurnos'];
	if ( !empty($_POST['idUso']) )                 $idUso                  = $_POST['idUso'];
	
	
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
			case 'idServicios':           if(empty($idServicios)){           $error['idServicios']           = 'error/No ha ingresado el id';}break;
			case 'idFacturacion':         if(empty($idFacturacion)){         $error['idFacturacion']         = 'error/No ha seleccionado la facturacion';}break;
			case 'idSistema':             if(empty($idSistema)){             $error['idSistema']             = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':             if(empty($idUsuario)){             $error['idUsuario']             = 'error/No ha seleccionado el usuario';}break;
			case 'fecha_auto':            if(empty($fecha_auto)){            $error['fecha_auto']            = 'error/No ha ingresado la fecha de ingreso del documento';}break;
			case 'Creacion_fecha':        if(empty($Creacion_fecha)){        $error['Creacion_fecha']        = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idTrabajador':          if(empty($idTrabajador)){          $error['idTrabajador']          = 'error/No ha seleccionado el trabajador';}break;
			case 'idTurnos':              if(empty($idTurnos)){              $error['idTurnos']              = 'error/No ha seleccionado el turno';}break;
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
				$ndata_1 = db_select_nrows (false, 'Creacion_fecha', 'trabajadores_horas_extras_facturacion_turnos', '', "nSem='".fecha2NSemana($Creacion_fecha)."' AND Creacion_ano='".fecha2Ano($Creacion_fecha)."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El turno ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idFacturacion) && $idFacturacion != ''){    $a  = "'".$idFacturacion."'" ; }else{$a  ="''";}
				if(isset($idSistema) && $idSistema != ''){            $a .= ",'".$idSistema."'" ;    }else{$a .=",''";}
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				if(isset($fecha_auto) && $fecha_auto != ''){          $a .= ",'".$fecha_auto."'" ;   }else{$a .=",''";}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",'".$Creacion_fecha."'" ;  
					$a .= ",'".fecha2NSemana($Creacion_fecha)."'" ;
					$a .= ",'".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",'".fecha2Ano($Creacion_fecha)."'" ; 
					$a .= ",'".fecha2NSemana($Creacion_fecha)."'" ;
				}else{
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
					$a .= ",''";
				}
				if(isset($idTrabajador) && $idTrabajador != ''){   $a .= ",'".$idTrabajador."'" ; }else{$a .=",''";}
				if(isset($idTurnos) && $idTurnos != ''){           $a .= ",'".$idTurnos."'" ;     }else{$a .=",''";}
				if(isset($idUso) && $idUso != ''){                 $a .= ",'".$idUso."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `trabajadores_horas_extras_facturacion_turnos` (idFacturacion, idSistema, idUsuario,
				fecha_auto, Creacion_fecha, Creacion_Semana, Creacion_mes, Creacion_ano, nSem, idTrabajador, idTurnos,
				idUso) 
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
			if(isset($Creacion_fecha)&&isset($idTrabajador)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Creacion_fecha', 'trabajadores_horas_extras_facturacion_turnos', '', "nSem='".fecha2NSemana($Creacion_fecha)."' AND Creacion_ano='".fecha2Ano($Creacion_fecha)."' AND idTrabajador='".$idTrabajador."' AND idSistema='".$idSistema."' AND idServicios!='".$idServicios."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El turno ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idServicios='".$idServicios."'" ;
				if(isset($idFacturacion) && $idFacturacion != ''){    $a .= ",idFacturacion='".$idFacturacion."'" ;}
				if(isset($idSistema) && $idSistema != ''){            $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){            $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($fecha_auto) && $fecha_auto != ''){          $a .= ",fecha_auto='".$fecha_auto."'" ;}
				if(isset($Creacion_fecha) && $Creacion_fecha != ''){  
					$a .= ",Creacion_fecha='".$Creacion_fecha."'" ;  
					$a .= ",Creacion_Semana='".fecha2NSemana($Creacion_fecha)."'" ;
					$a .= ",Creacion_mes='".fecha2NMes($Creacion_fecha)."'" ;
					$a .= ",Creacion_ano='".fecha2Ano($Creacion_fecha)."'" ;  
					$a .= ",nSem='".fecha2NSemana($Creacion_fecha)."'" ;
				}
				if(isset($idTrabajador) && $idTrabajador != ''){      $a .= ",idTrabajador='".$idTrabajador."'" ;}
				if(isset($idTurnos) && $idTurnos != ''){              $a .= ",idTurnos='".$idTurnos."'" ;}
				if(isset($idUso) && $idUso != ''){                    $a .= ",idUso='".$idUso."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `trabajadores_horas_extras_facturacion_turnos` SET ".$a." WHERE idServicios = '$idServicios'";
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
				$resultado = db_delete_data (false, 'trabajadores_horas_extras_facturacion_turnos', 'idServicios = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
