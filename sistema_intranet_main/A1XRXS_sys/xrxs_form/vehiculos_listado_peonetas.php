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
	if ( !empty($_POST['idPeoneta']) )     $idPeoneta     = $_POST['idPeoneta'];
	if ( !empty($_POST['idVehiculo']) )    $idVehiculo    = $_POST['idVehiculo'];
	if ( !empty($_POST['Nombre']) )        $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['ApellidoPat']) )   $ApellidoPat   = $_POST['ApellidoPat'];
	if ( !empty($_POST['ApellidoMat']) )   $ApellidoMat   = $_POST['ApellidoMat'];
	if ( !empty($_POST['Rut']) )           $Rut           = $_POST['Rut'];
	if ( !empty($_POST['Fecha']) )         $Fecha         = $_POST['Fecha'];
	
	
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
			case 'idPeoneta':    if(empty($idPeoneta)){    $error['idPeoneta']    = 'error/No ha ingresado el id';}break;
			case 'idVehiculo':   if(empty($idVehiculo)){   $error['idVehiculo']   = 'error/No ha seleccionado el vehiculo';}break;
			case 'Nombre':       if(empty($Nombre)){       $error['Nombre']       = 'error/No ha ingresado el nombre';}break;
			case 'ApellidoPat':  if(empty($ApellidoPat)){  $error['ApellidoPat']  = 'error/No ha ingresado el apellido paterno';}break;
			case 'ApellidoMat':  if(empty($ApellidoMat)){  $error['ApellidoMat']  = 'error/No ha ingresado el apellido materno';}break;
			case 'Rut':          if(empty($Rut)){          $error['Rut']          = 'error/No ha ingresado el Rut';}break;
			case 'Fecha':        if(empty($Fecha)){        $error['Fecha']        = 'error/No ha ingresado la Fecha de nacimiento';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){  $error['Nombre'] = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($ApellidoPat)&&contar_palabras_censuradas($ApellidoPat)!=0){  $error['ApellidoPat'] = 'error/Edita Apellido Pat, contiene palabras no permitidas'; }	
	if(isset($ApellidoMat)&&contar_palabras_censuradas($ApellidoMat)!=0){  $error['ApellidoMat'] = 'error/Edita Apellido Mat, contiene palabras no permitidas'; }	
	
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
			if(isset($Rut)&&isset($idVehiculo)){
				$ndata_1 = db_select_nrows (false, 'Rut', 'vehiculos_listado_peonetas', '', "Rut='".$Rut."' AND idVehiculo='".$idVehiculo."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($idVehiculo)){
				$ndata_2 = db_select_nrows (false, 'Nombre', 'vehiculos_listado_peonetas', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND idVehiculo='".$idVehiculo."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/La Peoneta ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				//filtros
				if(isset($idVehiculo) && $idVehiculo != ''){    $a  = "'".$idVehiculo."'" ;    }else{$a  ="''";}
				if(isset($Nombre) && $Nombre != ''){            $a .= ",'".$Nombre."'" ;       }else{$a .=",''";}
				if(isset($ApellidoPat) && $ApellidoPat != ''){  $a .= ",'".$ApellidoPat."'" ;  }else{$a .=",''";}
				if(isset($ApellidoMat) && $ApellidoMat != ''){  $a .= ",'".$ApellidoMat."'" ;  }else{$a .=",''";}
				if(isset($Rut) && $Rut != ''){                  $a .= ",'".$Rut."'" ;          }else{$a .=",''";}
				if(isset($Fecha) && $Fecha != ''){              $a .= ",'".$Fecha."'" ;        }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `vehiculos_listado_peonetas` (idVehiculo, Nombre, ApellidoPat, ApellidoMat, 
				Rut, Fecha) 
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
			if(isset($Rut)&&isset($idVehiculo)&&isset($idPeoneta)){
				$ndata_1 = db_select_nrows (false, 'Rut', 'vehiculos_listado_peonetas', '', "Rut='".$Rut."' AND idVehiculo='".$idVehiculo."' AND idPeoneta!='".$idPeoneta."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($idVehiculo)&&isset($idPeoneta)){
				$ndata_2 = db_select_nrows (false, 'Nombre', 'vehiculos_listado_peonetas', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND idVehiculo='".$idVehiculo."' AND idPeoneta!='".$idPeoneta."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/La Peoneta ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idPeoneta='".$idPeoneta."'" ;
				if(isset($idVehiculo) && $idVehiculo != ''){     $a .= ",idVehiculo='".$idVehiculo."'" ;}
				if(isset($Nombre) && $Nombre != ''){             $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($ApellidoPat) && $ApellidoPat != ''){   $a .= ",ApellidoPat='".$ApellidoPat."'" ;}
				if(isset($ApellidoMat) && $ApellidoMat != ''){   $a .= ",ApellidoMat='".$ApellidoMat."'" ;}
				if(isset($Rut) && $Rut != ''){                   $a .= ",Rut='".$Rut."'" ;}
				if(isset($Fecha) && $Fecha != ''){               $a .= ",Fecha='".$Fecha."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'vehiculos_listado_peonetas', 'idPeoneta = "'.$idPeoneta.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'vehiculos_listado_peonetas', 'idPeoneta = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
