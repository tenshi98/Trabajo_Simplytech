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
	if ( !empty($_POST['idSoftware']) )      $idSoftware      = $_POST['idSoftware'];
	if ( !empty($_POST['Nombre']) )          $Nombre          = $_POST['Nombre'];
	if ( !empty($_POST['Descripcion']) )     $Descripcion     = $_POST['Descripcion'];
	if ( !empty($_POST['idLicencia']) )      $idLicencia      = $_POST['idLicencia'];
	if ( !empty($_POST['Peso']) )            $Peso            = $_POST['Peso'];
	if ( !empty($_POST['idMedidaPeso']) )    $idMedidaPeso    = $_POST['idMedidaPeso'];
	if ( !empty($_POST['SitioWeb']) )        $SitioWeb        = $_POST['SitioWeb'];
	if ( !empty($_POST['SitioDescarga']) )   $SitioDescarga   = $_POST['SitioDescarga'];
	if ( !empty($_POST['idCategoria']) )     $idCategoria     = $_POST['idCategoria'];
	
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
			case 'idSoftware':      if(empty($idSoftware)){      $error['idSoftware']       = 'error/No ha ingresado el id';}break;
			case 'Nombre':          if(empty($Nombre)){          $error['Nombre']           = 'error/No ha ingresado el nombre';}break;
			case 'Descripcion':     if(empty($Descripcion)){     $error['Descripcion']      = 'error/No ha ingresado la Descripcion';}break;
			case 'idLicencia':      if(empty($idLicencia)){      $error['idLicencia']       = 'error/No ha seleccionado el tipo de licencia';}break;
			case 'Peso':            if(empty($Peso)){            $error['Peso']             = 'error/No ha ingresado el peso del archivo';}break;
			case 'idMedidaPeso':    if(empty($idMedidaPeso)){    $error['idMedidaPeso']     = 'error/No ha seleccionado la medida del peso';}break;
			case 'SitioWeb':        if(empty($SitioWeb)){        $error['SitioWeb']         = 'error/No ha ingresado el sitio web';}break;
			case 'SitioDescarga':   if(empty($SitioDescarga)){   $error['SitioDescarga']    = 'error/No ha ingresado la direccion de descarga';}break;
			case 'idCategoria':     if(empty($idCategoria)){     $error['idCategoria']      = 'error/No ha seleccionado la categoria de la aplicacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                $error['Nombre']        = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){      $error['Descripcion']   = 'error/Edita Descripcion, contiene palabras no permitidas'; }	
	if(isset($SitioWeb)&&contar_palabras_censuradas($SitioWeb)!=0){            $error['SitioWeb']      = 'error/Edita SitioWeb, contiene palabras no permitidas'; }	
	if(isset($SitioDescarga)&&contar_palabras_censuradas($SitioDescarga)!=0){  $error['SitioDescarga'] = 'error/Edita SitioDescarga, contiene palabras no permitidas'; }	
	
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
				$ndata_1 = db_select_nrows (false, 'Nombre', 'soporte_software_listado', '', "Nombre='".$Nombre."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la aplicacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                $a = "'".$Nombre."'" ;           }else{$a ="''";}
				if(isset($Descripcion) && $Descripcion != ''){      $a .= ",'".$Descripcion."'" ;    }else{$a .=",''";}
				if(isset($idLicencia) && $idLicencia != ''){        $a .= ",'".$idLicencia."'" ;     }else{$a .=",''";}
				if(isset($Peso) && $Peso != ''){                    $a .= ",'".$Peso."'" ;           }else{$a .=",''";}
				if(isset($idMedidaPeso) && $idMedidaPeso != ''){    $a .= ",'".$idMedidaPeso."'" ;   }else{$a .=",''";}
				if(isset($SitioWeb) && $SitioWeb != ''){            $a .= ",'".$SitioWeb."'" ;       }else{$a .=",''";}
				if(isset($SitioDescarga) && $SitioDescarga != ''){  $a .= ",'".$SitioDescarga."'" ;  }else{$a .=",''";}
				if(isset($idCategoria) && $idCategoria != ''){      $a .= ",'".$idCategoria."'" ;    }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `soporte_software_listado` (Nombre, Descripcion, idLicencia, Peso,
				idMedidaPeso, SitioWeb, SitioDescarga, idCategoria ) 
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
			if(isset($Nombre)&&isset($idSoftware)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'soporte_software_listado', '', "Nombre='".$Nombre."' AND idSoftware!='".$idSoftware."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre de la aplicacion ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSoftware='".$idSoftware."'" ;
				if(isset($Nombre) && $Nombre != ''){                   $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){         $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($idLicencia) && $idLicencia != ''){           $a .= ",idLicencia='".$idLicencia."'" ;}
				if(isset($Peso) && $Peso != ''){                       $a .= ",Peso='".$Peso."'" ;}
				if(isset($idMedidaPeso) && $idMedidaPeso != ''){       $a .= ",idMedidaPeso='".$idMedidaPeso."'" ;}
				if(isset($SitioWeb) && $SitioWeb != ''){               $a .= ",SitioWeb='".$SitioWeb."'" ;}
				if(isset($SitioDescarga) && $SitioDescarga != ''){     $a .= ",SitioDescarga='".$SitioDescarga."'" ;}
				if(isset($idCategoria) && $idCategoria != ''){         $a .= ",idCategoria='".$idCategoria."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'soporte_software_listado', 'idSoftware = "'.$idSoftware.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'soporte_software_listado', 'idSoftware = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
