<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridPeligroad                                                */
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
	if ( !empty($_POST['idPeligro']) )        $idPeligro        = $_POST['idPeligro'];
	if ( !empty($_POST['idSistema']) )        $idSistema        = $_POST['idSistema'];
	if ( !empty($_POST['idCliente']) )        $idCliente        = $_POST['idCliente'];
	if ( !empty($_POST['idTipo']) )           $idTipo           = $_POST['idTipo'];
	if ( !empty($_POST['idCiudad']) )         $idCiudad         = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )         $idComuna         = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )        $Direccion 	    = $_POST['Direccion'];
	if ( !empty($_POST['GeoLatitud']) )       $GeoLatitud 	    = $_POST['GeoLatitud'];
	if ( !empty($_POST['GeoLongitud']) )      $GeoLongitud 	    = $_POST['GeoLongitud'];
	if ( !empty($_POST['Fecha']) )            $Fecha 	        = $_POST['Fecha'];
	if ( !empty($_POST['Hora']) )             $Hora 	        = $_POST['Hora'];
	if ( !empty($_POST['Descripcion']) )      $Descripcion 	    = $_POST['Descripcion'];
	if ( !empty($_POST['idEstado']) )         $idEstado 	    = $_POST['idEstado'];
	if ( !empty($_POST['idValidado']) )       $idValidado       = $_POST['idValidado'];
	
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
			case 'idPeligro':      if(empty($idPeligro)){          $error['idPeligro']        = 'error/No ha ingresado el id';}break;
			case 'idSistema':      if(empty($idSistema)){          $error['idSistema']        = 'error/No ha seleccionado el sistema';}break;
			case 'idCliente':      if(empty($idCliente)){          $error['idCliente']        = 'error/No ha seleccionado el cliente';}break;
			case 'idTipo':         if(empty($idTipo)){             $error['idTipo']           = 'error/No ha seleccionado el tipo de la zona de peligro';}break;
			case 'idCiudad':       if(empty($idCiudad)){           $error['idCiudad']         = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':       if(empty($idComuna)){           $error['idComuna']         = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':      if(empty($Direccion)){          $error['Direccion']        = 'error/No ha ingresado el Direccion';}break;
			case 'GeoLatitud':     if(empty($GeoLatitud)){         $error['GeoLatitud']       = 'error/No ha ingresado la latitud';}break;
			case 'GeoLongitud':    if(empty($GeoLongitud)){        $error['GeoLongitud']      = 'error/No ha ingresado la longitud';}break;	
			case 'Fecha':          if(empty($Fecha)){              $error['Fecha']            = 'error/No ha ingresado la fecha de la zona de peligro';}break;
			case 'Hora':           if(empty($Hora)){               $error['Hora']             = 'error/No ha ingresado la hora de la zona de peligro';}break;
			case 'Descripcion':    if(empty($Descripcion)){        $error['Descripcion']      = 'error/No ha ingresado la descripcion';}break;
			case 'idEstado':       if(empty($idEstado)){           $error['idEstado']         = 'error/No ha seleccionado el estado';}break;
			case 'idValidado':     if(empty($idValidado)){         $error['idValidado']       = 'error/No ha seleccionado el estado de validacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){      $error['Direccion']   = 'error/Edita la Direccion, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){  $error['Descripcion'] = 'error/Edita la Descripcion, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idPeligro='".$idPeligro."'" ;
				if(isset($idSistema) && $idSistema != ''){       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idCliente) && $idCliente != ''){       $a .= ",idCliente='".$idCliente."'" ;}
				if(isset($idTipo) && $idTipo != ''){             $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){         $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){         $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){       $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($GeoLatitud) && $GeoLatitud != ''){     $a .= ",GeoLatitud='".$GeoLatitud."'" ;}
				if(isset($GeoLongitud) && $GeoLongitud != ''){   $a .= ",GeoLongitud='".$GeoLongitud."'" ;}
				if(isset($Fecha) && $Fecha != ''){                               
					$a .= ",Fecha='".$Fecha."'" ;
					$a .= ",Semana='".fecha2NSemana($Fecha)."'" ;
					$a .= ",Dia='".fecha2NdiaMes($Fecha)."'" ;
					$a .= ",idMes='".fecha2NMes($Fecha)."'" ;
					$a .= ",Ano='".fecha2Ano($Fecha)."'" ;
				}
				if(isset($Hora) && $Hora != ''){                 $a .= ",Hora='".$Hora."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){   $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($idEstado) && $idEstado != ''){         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idValidado) && $idValidado != ''){     $a .= ",idValidado='".$idValidado."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `seg_vecinal_peligros_listado` SET ".$a." WHERE idPeligro = '".$idPeligro."'";
				$resultado = mysqli_query($dbConn, $query);
				
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//se redirige
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
				//se borran los peligros
				$resultado_1 = db_delete_data (false, 'seg_vecinal_peligros_listado', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'seg_vecinal_peligros_listado_archivos', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_3 = db_delete_data (false, 'seg_vecinal_peligros_listado_comentarios', 'idCliente = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//Si ejecuto correctamente la consulta
				if($resultado_1==true OR $resultado_2==true OR $resultado_3==true){
					
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
