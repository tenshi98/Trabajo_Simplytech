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
	if ( !empty($_POST['idCategoria']) )                 $idCategoria                  = $_POST['idCategoria'];
	if ( !empty($_POST['Nombre']) )                      $Nombre                       = $_POST['Nombre'];
	if ( !empty($_POST['Temp_optima_min']) )             $Temp_optima_min              = $_POST['Temp_optima_min'];
	if ( !empty($_POST['Temp_optima_max']) )             $Temp_optima_max              = $_POST['Temp_optima_max'];
	if ( !empty($_POST['Temp_optima_margen_critico']) )  $Temp_optima_margen_critico   = $_POST['Temp_optima_margen_critico'];

	
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
			case 'idCategoria':                 if(empty($idCategoria)){                 $error['idCategoria']                 = 'error/No ha ingresado el id';}break;
			case 'Nombre':                      if(empty($Nombre)){                      $error['Nombre']                      = 'error/No ha ingresado el nombre de la categoria';}break;
			case 'Temp_optima_min':             if(empty($Temp_optima_min)){             $error['Temp_optima_min']             = 'error/No ha ingresado el nombre de la categoria';}break;
			case 'Temp_optima_max':             if(empty($Temp_optima_max)){             $error['Temp_optima_max']             = 'error/No ha ingresado el nombre de la categoria';}break;
			case 'Temp_optima_margen_critico':  if(empty($Temp_optima_margen_critico)){  $error['Temp_optima_margen_critico']  = 'error/No ha ingresado el nombre de la categoria';}break;
			
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
				$ndata_1 = db_select_nrows ('Nombre', 'sistema_variedades_categorias', '', "Nombre='".$Nombre."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                                          $a = "'".$Nombre."'" ;                         }else{$a ="''";}
				if(isset($Temp_optima_min) && $Temp_optima_min != ''){                        $a .= ",'".$Temp_optima_min."'" ;              }else{$a .=",''";}
				if(isset($Temp_optima_max) && $Temp_optima_max != ''){                        $a .= ",'".$Temp_optima_max."'" ;              }else{$a .=",''";}
				if(isset($Temp_optima_margen_critico) && $Temp_optima_margen_critico != ''){  $a .= ",'".$Temp_optima_margen_critico."'" ;   }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `sistema_variedades_categorias` (Nombre, Temp_optima_min,
				Temp_optima_max, Temp_optima_margen_critico) 
				VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
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
			if(isset($Nombre)&&isset($idCategoria)){
				$ndata_1 = db_select_nrows ('Nombre', 'sistema_variedades_categorias', '', "Nombre='".$Nombre."' AND idCategoria!='".$idCategoria."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCategoria='".$idCategoria."'" ;
				if(isset($Nombre) && $Nombre != ''){                                          $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Temp_optima_min) && $Temp_optima_min != ''){                        $a .= ",Temp_optima_min='".$Temp_optima_min."'" ;}
				if(isset($Temp_optima_max) && $Temp_optima_max != ''){                        $a .= ",Temp_optima_max='".$Temp_optima_max."'" ;}
				if(isset($Temp_optima_margen_critico) && $Temp_optima_margen_critico != ''){  $a .= ",Temp_optima_margen_critico='".$Temp_optima_margen_critico."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `sistema_variedades_categorias` SET ".$a." WHERE idCategoria = '$idCategoria'";
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
			$query  = "DELETE FROM `sistema_variedades_categorias` WHERE idCategoria = {$_GET['del']}";
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
