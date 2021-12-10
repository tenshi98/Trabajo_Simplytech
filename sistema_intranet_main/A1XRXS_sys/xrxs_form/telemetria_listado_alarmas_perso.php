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
	if ( !empty($_POST['idAlarma']) )         $idAlarma            = $_POST['idAlarma'];
	if ( !empty($_POST['idTelemetria']) )     $idTelemetria        = $_POST['idTelemetria'];
	if ( !empty($_POST['Nombre']) )           $Nombre              = $_POST['Nombre'];
	if ( !empty($_POST['idTipo']) )           $idTipo              = $_POST['idTipo'];
	if ( !empty($_POST['idTipoAlerta']) )     $idTipoAlerta        = $_POST['idTipoAlerta'];
	if ( !empty($_POST['idUniMed']) )         $idUniMed            = $_POST['idUniMed'];
	if ( !empty($_POST['valor_error']) )      $valor_error         = $_POST['valor_error'];
	if ( !empty($_POST['valor_diferencia']) ) $valor_diferencia    = $_POST['valor_diferencia'];
	if ( !empty($_POST['Rango_ini']) )        $Rango_ini           = $_POST['Rango_ini'];
	if ( !empty($_POST['Rango_fin']) )        $Rango_fin           = $_POST['Rango_fin'];
	if ( !empty($_POST['NErroresMax']) )      $NErroresMax         = $_POST['NErroresMax'];
	if ( !empty($_POST['NErroresActual']) )   $NErroresActual      = $_POST['NErroresActual'];
	if ( !empty($_POST['idEstado']) )         $idEstado            = $_POST['idEstado'];
	
	
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
			case 'idAlarma':          if(empty($idAlarma)){            $error['idAlarma']           = 'error/No ha ingresado el id';}break;
			case 'idTelemetria':      if(empty($idTelemetria)){        $error['idTelemetria']       = 'error/No ha seleccionado el equipo de telemetria';}break;
			case 'Nombre':            if(empty($Nombre)){              $error['Nombre']             = 'error/No ha ingresado el nombre';}break;
			case 'idTipo':            if(empty($idTipo)){              $error['idTipo']             = 'error/No ha seleccionado el tipo';}break;
			case 'idTipoAlerta':      if(empty($idTipoAlerta)){        $error['idTipoAlerta']       = 'error/No ha seleccionado la prioridad de la alerta';}break;
			case 'idUniMed':          if(empty($idUniMed)){            $error['idUniMed']           = 'error/No ha seleccionado la unidad de medida de la alerta';}break;
			case 'valor_error':       if(empty($valor_error)){         $error['valor_error']        = 'error/No ha ingresado el valor de error';}break;
			case 'valor_diferencia':  if(empty($valor_diferencia)){    $error['valor_diferencia']   = 'error/No ha ingresado el porcentaje de diferencia';}break;
			case 'Rango_ini':         if(empty($Rango_ini)){           $error['Rango_ini']          = 'error/No ha ingresado el rango de inicio';}break;
			case 'Rango_fin':         if(empty($Rango_fin)){           $error['Rango_fin']          = 'error/No ha ingresado el rango de termino';}break;
			case 'NErroresMax':       if(empty($NErroresMax)){         $error['NErroresMax']        = 'error/No ha ingresado el numero maximo de errores';}break;
			case 'NErroresActual':    if(empty($NErroresActual)){      $error['NErroresActual']     = 'error/No ha ingresado el numero actual de errores';}break;
			case 'idEstado':          if(empty($idEstado)){            $error['idEstado']           = 'error/No ha seleccionado el estado';}break;
			
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
			if(isset($Nombre)&&isset($idTelemetria)&&isset($idTipoAlerta)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'telemetria_listado_alarmas_perso', '', "Nombre='".$Nombre."' AND idTelemetria='".$idTelemetria."' AND idTipoAlerta='".$idTipoAlerta."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idTelemetria) && $idTelemetria != ''){          $a = "'".$idTelemetria."'" ;       }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){                      $a .= ",'".$Nombre."'" ;           }else{$a .=",''";}
				if(isset($idTipo) && $idTipo != ''){                      $a .= ",'".$idTipo."'" ;           }else{$a .=",''";}
				if(isset($idTipoAlerta) && $idTipoAlerta != ''){          $a .= ",'".$idTipoAlerta."'" ;     }else{$a .=",''";}
				if(isset($idUniMed) && $idUniMed != ''){                  $a .= ",'".$idUniMed."'" ;         }else{$a .=",''";}
				if(isset($valor_error) && $valor_error != ''){            $a .= ",'".$valor_error."'" ;      }else{$a .=",''";}
				if(isset($valor_diferencia) && $valor_diferencia != ''){  $a .= ",'".$valor_diferencia."'" ; }else{$a .=",''";}
				if(isset($Rango_ini) && $Rango_ini != ''){                $a .= ",'".$Rango_ini."'" ;        }else{$a .=",''";}
				if(isset($Rango_fin) && $Rango_fin != ''){                $a .= ",'".$Rango_fin."'" ;        }else{$a .=",''";}
				if(isset($NErroresMax) && $NErroresMax != ''){            $a .= ",'".$NErroresMax."'" ;      }else{$a .=",''";}
				if(isset($NErroresActual) && $NErroresActual != ''){      $a .= ",'".$NErroresActual."'" ;   }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                  $a .= ",'".$idEstado."'" ;         }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `telemetria_listado_alarmas_perso` (idTelemetria, Nombre, 
				idTipo, idTipoAlerta, idUniMed, valor_error, valor_diferencia, Rango_ini, 
				Rango_fin, NErroresMax, NErroresActual, idEstado) 
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
			if(isset($Nombre)&&isset($idTelemetria)&&isset($idTipoAlerta)&&isset($idAlarma)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'telemetria_listado_alarmas_perso', '', "Nombre='".$Nombre."' AND idTelemetria='".$idTelemetria."' AND idTipoAlerta='".$idTipoAlerta."' AND idAlarma!='".$idAlarma."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAlarma='".$idAlarma."'" ;
				if(isset($idTelemetria) && $idTelemetria != ''){            $a .= ",idTelemetria='".$idTelemetria."'" ;}
				if(isset($Nombre) && $Nombre != ''){                        $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idTipo) && $idTipo != ''){                        $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idTipoAlerta) && $idTipoAlerta != ''){            $a .= ",idTipoAlerta='".$idTipoAlerta."'" ;}
				if(isset($idUniMed) && $idUniMed != ''){                    $a .= ",idUniMed='".$idUniMed."'" ;}
				if(isset($valor_error) && $valor_error != ''){              $a .= ",valor_error='".$valor_error."'" ;}
				if(isset($valor_diferencia) && $valor_diferencia != ''){    $a .= ",valor_diferencia='".$valor_diferencia."'" ;}
				if(isset($Rango_ini) && $Rango_ini != ''){                  $a .= ",Rango_ini='".$Rango_ini."'" ;}
				if(isset($Rango_fin) && $Rango_fin != ''){                  $a .= ",Rango_fin='".$Rango_fin."'" ;}
				if(isset($NErroresMax) && $NErroresMax != ''){              $a .= ",NErroresMax='".$NErroresMax."'" ;         }else{$a .= ",NErroresMax='0'" ;}
				if(isset($NErroresActual) && $NErroresActual != ''){        $a .= ",NErroresActual='".$NErroresActual."'" ;   }else{$a .= ",NErroresActual='0'" ;}
				if(isset($idEstado) && $idEstado != ''){                    $a .= ",idEstado='".$idEstado."'" ;   }
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'telemetria_listado_alarmas_perso', 'idAlarma = "'.$idAlarma.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}
		
	
		break;	
						
/*******************************************************************************************************************/
		case 'delAlarma':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['delAlarma']) OR !validaEntero($_GET['delAlarma']))&&$_GET['delAlarma']!=''){
				$indice = simpleDecode($_GET['delAlarma'], fecha_actual());
			}else{
				$indice = $_GET['delAlarma'];
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
				$resultado_1 = db_delete_data (false, 'telemetria_listado_alarmas_perso', 'idAlarma = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'telemetria_listado_alarmas_perso_items', 'idAlarma = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
