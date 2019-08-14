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
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
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
				$ndata_1 = db_select_nrows ('Nombre', 'soporte_software_listado', '', "Nombre='".$Nombre."'", $dbConn);
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
			if(isset($Nombre)&&isset($idSoftware)){
				$ndata_1 = db_select_nrows ('Nombre', 'soporte_software_listado', '', "Nombre='".$Nombre."' AND idSoftware!='".$idSoftware."'", $dbConn);
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
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `soporte_software_listado` SET ".$a." WHERE idSoftware = '$idSoftware'";
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
			$query  = "DELETE FROM `soporte_software_listado` WHERE idSoftware = {$_GET['del']}";
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
