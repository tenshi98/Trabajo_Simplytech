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
	if ( !empty($_POST['idAFP']) )                    $idAFP                     = $_POST['idAFP'];
	if ( !empty($_POST['Nombre']) )                   $Nombre                    = $_POST['Nombre'];
	if ( isset($_POST['PorcentajeDependiente']) )     $PorcentajeDependiente     = $_POST['PorcentajeDependiente'];
	if ( isset($_POST['PorcentajeIndependiente']) )   $PorcentajeIndependiente   = $_POST['PorcentajeIndependiente'];
	if ( !empty($_POST['idEstado']) )                 $idEstado                  = $_POST['idEstado'];
	
	
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
			case 'idAFP':                    if(empty($idAFP)){                     $error['idAFP']                    = 'error/No ha ingresado el id';}break;
			case 'Nombre':                   if(empty($Nombre)){                    $error['Nombre']                   = 'error/No ha ingresado el nombre de la afp';}break;
			case 'PorcentajeDependiente':    if(!isset($PorcentajeDependiente)){    $error['PorcentajeDependiente']    = 'error/No ha ingresado el porcentaje para trabajadores dependientes';}break;
			case 'PorcentajeIndependiente':  if(!isset($PorcentajeIndependiente)){  $error['PorcentajeIndependiente']  = 'error/No ha ingresado el porcentaje para trabajadores independientes';}break;
			case 'idEstado':                 if(empty($idEstado)){                  $error['idEstado']                 = 'error/No ha seleccionado el estado';}break;
			
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
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'sistema_afp', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                                    $a = "'".$Nombre."'" ;                     }else{$a ="''";}
				if(isset($PorcentajeDependiente) && $PorcentajeDependiente != ''){      $a .= ",'".$PorcentajeDependiente."'" ;    }else{$a .=",''";}
				if(isset($PorcentajeIndependiente) && $PorcentajeIndependiente != ''){  $a .= ",'".$PorcentajeIndependiente."'" ;  }else{$a .=",''";}
				if(isset($idEstado) && $idEstado != ''){                                $a .= ",'".$idEstado."'" ;                 }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `sistema_afp` (Nombre, PorcentajeDependiente, PorcentajeIndependiente,
				idEstado) 
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
			if(isset($Nombre)&&isset($idAFP)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'sistema_afp', '', "Nombre='".$Nombre."' AND idAFP!='".$idAFP."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAFP='".$idAFP."'" ;
				if(isset($Nombre) && $Nombre != ''){                                    $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($PorcentajeDependiente) && $PorcentajeDependiente != ''){      $a .= ",PorcentajeDependiente='".$PorcentajeDependiente."'" ;}
				if(isset($PorcentajeIndependiente) && $PorcentajeIndependiente != ''){  $a .= ",PorcentajeIndependiente='".$PorcentajeIndependiente."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                $a .= ",idEstado='".$idEstado."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'sistema_afp', 'idAFP = "'.$idAFP.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'sistema_afp', 'idAFP = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
