<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridTransportead                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'cliente_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$idTransporte = $_GET['id'];
			$idCliente    = $_GET['cliente_add'];
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($idTransporte)&&$idTransporte!=''&&isset($idCliente)&&$idCliente!=''){
				$ndata_1 = db_select_nrows (false, 'idRelacion', 'transportes_listado_clientes', '', "idTransporte='".$idTransporte."' AND idCliente='".$idCliente."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El permiso ya fue otorgado';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$query  = "INSERT INTO `transportes_listado_clientes` (idTransporte, idCliente) 
				VALUES ('$idTransporte','$idCliente')";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					header( 'Location: '.$location );
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
		//borra un permiso del usuario
		case 'cliente_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['cliente_del']) OR !validaEntero($_GET['cliente_del']))&&$_GET['cliente_del']!=''){
				$indice = simpleDecode($_GET['cliente_del'], fecha_actual());
			}else{
				$indice = $_GET['cliente_del'];
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
				$resultado = db_delete_data (false, 'transportes_listado_clientes', 'idRelacion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
		//Agrega un permiso al usuario
		case 'prm_add_all':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variables
			$idTransporte  = $_GET['id'];
			
			//Busco todos los clientes activos
			$SIS_query = 'idCliente';
			$SIS_join  = '';
			$SIS_where = 'idEstado = 1';
			$SIS_order = 0;
			$arrClientes = array();
			$arrClientes = db_select_array (false, $SIS_query, 'clientes_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			//Inserto los clientes
			foreach ($arrClientes as $cli) {
				
				//variables
				$a  = "'".$idTransporte."'" ;  
				$a .= ",'".$cli['idCliente']."'" ;
				//Inserto datos	
				$query  = "INSERT INTO `transportes_listado_clientes` (idTransporte, idCliente) 
				VALUES ($a)";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);

			}
			
			//redirijo
			header( 'Location: '.$location );
			die;   

		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'prm_del_all':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['idTransporte']) OR !validaEntero($_GET['idTransporte']))&&$_GET['idTransporte']!=''){
				$indice = simpleDecode($_GET['idTransporte'], fecha_actual());
			}else{
				$indice = $_GET['idTransporte'];
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
				$resultado = db_delete_data (false, 'transportes_listado_clientes', 'idTransporte = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
