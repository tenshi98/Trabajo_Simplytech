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
	if ( !empty($_POST['idPlan']) )        $idPlan        = $_POST['idPlan'];
	if ( !empty($_POST['Nombre']) )        $Nombre        = $_POST['Nombre'];
	if ( !empty($_POST['Valor']) )         $Valor         = $_POST['Valor'];
	if ( !empty($_POST['idTransporte']) )  $idTransporte  = $_POST['idTransporte'];
	
	
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
			case 'idPlan':        if(empty($idPlan)){        $error['idPlan']        = 'error/No ha ingresado el id';}break;
			case 'Nombre':        if(empty($Nombre)){        $error['Nombre']        = 'error/No ha ingresado el nombre del Plan';}break;
			case 'Valor':         if(empty($Valor)){         $error['Valor']         = 'error/No ha ingresado el valor del Plan';}break;
			case 'idTransporte':  if(empty($idTransporte)){  $error['idTransporte']  = 'error/No ha seleccionado el transportista';}break;
			
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
			if(isset($Nombre)&&isset($idTransporte)){
				$ndata_1 = db_select_nrows ('Nombre', 'sistema_planes', '', "Nombre='".$Nombre."' AND idTransporte='".$idTransporte."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                $a  = "'".$Nombre."'" ;         }else{$a  ="''";}
				if(isset($Valor) && $Valor != ''){                  $a .= ",'".$Valor."'" ;         }else{$a .=",''";}
				if(isset($idTransporte) && $idTransporte != ''){    $a .= ",'".$idTransporte."'" ;  }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `sistema_planes` (Nombre, Valor, idTransporte) VALUES ({$a} )";
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
			if(isset($Nombre)&&isset($idTransporte)&&isset($idPlan)){
				$ndata_1 = db_select_nrows ('Nombre', 'sistema_planes', '', "Nombre='".$Nombre."' AND idTransporte='".$idTransporte."' AND idPlan!='".$idPlan."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idPlan='".$idPlan."'" ;
				if(isset($Nombre) && $Nombre != ''){                $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Valor) && $Valor != ''){                  $a .= ",Valor='".$Valor."'" ;}
				if(isset($idTransporte) && $idTransporte != ''){    $a .= ",idTransporte='".$idTransporte."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `sistema_planes` SET ".$a." WHERE idPlan = '$idPlan'";
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
			$query  = "DELETE FROM `sistema_planes` WHERE idPlan = {$_GET['del']}";
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
