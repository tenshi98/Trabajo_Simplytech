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
	if ( !empty($_POST['idAdmpm']) )            $idAdmpm            = $_POST['idAdmpm'];
	if ( !empty($_POST['id_pmcat']) )           $id_pmcat           = $_POST['id_pmcat'];
	if ( !empty($_POST['Direccionweb']) )       $Direccionweb       = $_POST['Direccionweb'];
	if ( !empty($_POST['Direccionbase']) )      $Direccionbase      = $_POST['Direccionbase'];
	if ( !empty($_POST['Nombre']) )             $Nombre             = $_POST['Nombre'];
	if ( !empty($_POST['visualizacion']) )      $visualizacion      = $_POST['visualizacion'];
	if ( !empty($_POST['Version']) )            $Version            = $_POST['Version'];
	if ( !empty($_POST['Descripcion']) )        $Descripcion        = $_POST['Descripcion'];
	if ( !empty($_POST['Level_Limit']) )        $Level_Limit        = $_POST['Level_Limit'];
	if ( !empty($_POST['fake_id_pmcat']) )      $fake_id_pmcat      = $_POST['fake_id_pmcat'];
	if ( !empty($_POST['fake_Nombre']) )        $fake_Nombre        = $_POST['fake_Nombre'];
	if ( isset($_POST['Habilita']) )            $Habilita           = $_POST['Habilita'];
	if ( isset($_POST['Principal']) )           $Principal          = $_POST['Principal'];
	
	
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
			case 'idAdmpm':           if(empty($idAdmpm)){           $error['idAdmpm']            = 'error/No ha ingresado el id';}break;
			case 'id_pmcat':          if(empty($id_pmcat)){          $error['id_pmcat']           = 'error/No ha seleccionado la categoria';}break;
			case 'Direccionweb':      if(empty($Direccionweb)){      $error['Direccionweb']       = 'error/No ha ingresado la imagen';}break;
			case 'Direccionbase':     if(empty($Direccionbase)){     $error['Direccionbase']      = 'error/No ha ingresado la direccion web';}break;
			case 'Nombre':            if(empty($Nombre)){            $error['Nombre']             = 'error/No ha ingresado la direccion base';}break;
			case 'visualizacion':     if(empty($visualizacion)){     $error['visualizacion']      = 'error/No ha ingresado la visualizacion';}break;
			case 'Version':           if(empty($Version)){           $error['Version']            = 'error/No ha ingresado la version';}break;
			case 'Descripcion':       if(empty($Descripcion)){       $error['Descripcion']        = 'error/No ha ingresado una descripcion';}break;
			case 'Level_Limit':       if(empty($Level_Limit)){       $error['Level_Limit']        = 'error/No ha seleccionado el limite del nivel de permiso';}break;
			case 'Habilita':          if(empty($Habilita)){          $error['Habilita']           = 'error/No ha ingresado los tabs que habilita';}break;
			case 'Principal':         if(empty($Principal)){         $error['Principal']          = 'error/No ha ingresado los tabs que habilita en principal';}break;
			
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
			if(isset($Nombre)&&isset($id_pmcat)){
				$ndata_1 = db_select_nrows ('Nombre', 'core_permisos_listado', '', "Nombre='".$Nombre."' AND id_pmcat='".$id_pmcat."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Permiso ya existe en el sistema';}
			/*******************************************************************/

			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/************************************************************/
				//filtros
				if(isset($id_pmcat) && $id_pmcat != ''){             $a = "'".$id_pmcat."'" ;          }else{$a ="''";}
				if(isset($Direccionweb) && $Direccionweb != ''){     $a .= ",'".$Direccionweb."'" ;    }else{$a .= ",''";}
				if(isset($Direccionbase) && $Direccionbase != ''){   $a .= ",'".$Direccionbase."'" ;   }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                 $a .= ",'".$Nombre."'" ;          }else{$a .= ",''";}
				if(isset($visualizacion) && $visualizacion != ''){   $a .= ",'".$visualizacion."'" ;   }else{$a .= ",''";}
				if(isset($Version) && $Version != ''){               $a .= ",'".$Version."'" ;         }else{$a .= ",''";}
				if(isset($Descripcion) && $Descripcion != ''){       $a .= ",'".$Descripcion."'" ;     }else{$a .= ",''";}
				if(isset($Level_Limit) && $Level_Limit != ''){       $a .= ",'".$Level_Limit."'" ;     }else{$a .= ",''";}
				if(isset($Habilita) && $Habilita != ''){             $a .= ",'".$Habilita."'" ;        }else{$a .= ",''";}
				if(isset($Principal) && $Principal != ''){           $a .= ",'".$Principal."'" ;       }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_permisos_listado` (id_pmcat, Direccionweb, Direccionbase, Nombre, visualizacion, Version,
				Descripcion, Level_Limit, Habilita, Principal) VALUES ({$a} )";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					/************************************************************/
					//Ingreso modificacion al log de cambios
					$query = "SELECT Nombre FROM `core_permisos_categorias` WHERE id_pmcat='".$id_pmcat."'";
					$resultado = mysqli_query($dbConn, $query);
					$rowCat = mysqli_fetch_assoc ($resultado);
					/****************************/
					$a = "'".fecha_actual()."'" ;
					if(isset($Nombre) && $Nombre != ''){ 
						$Descripcion = '[NUEVO] ->Se agrega la transaccion <strong>'.$rowCat['Nombre'].' - '.$Nombre.'</strong> al sistema'; 
						$a .= ",'".$Descripcion."'" ;  
					}else{
						$a .= ",''";
					}
					
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `core_log_cambios` (Fecha, Descripcion) 
					VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					
					
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
			if(isset($Nombre)&&isset($id_pmcat)&&isset($idAdmpm)){
				$ndata_1 = db_select_nrows ('Nombre', 'core_permisos_listado', '', "Nombre='".$Nombre."' AND id_pmcat='".$id_pmcat."' AND idAdmpm!='".$idAdmpm."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Permiso ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idAdmpm='".$idAdmpm."'" ;
				if(isset($id_pmcat) && $id_pmcat != ''){            $a .= ",id_pmcat='".$id_pmcat."'" ;}
				if(isset($Direccionweb) && $Direccionweb != ''){    $a .= ",Direccionweb='".$Direccionweb."'" ;}
				if(isset($Direccionbase) && $Direccionbase != ''){  $a .= ",Direccionbase='".$Direccionbase."'" ;}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($visualizacion) && $visualizacion != ''){  $a .= ",visualizacion='".$visualizacion."'" ;}
				if(isset($Version) && $Version != ''){              $a .= ",Version='".$Version."'" ;}
				if(isset($Descripcion) && $Descripcion != ''){      $a .= ",Descripcion='".$Descripcion."'" ;}
				if(isset($Level_Limit) && $Level_Limit != ''){      $a .= ",Level_Limit='".$Level_Limit."'" ;}
				if(isset($Habilita) && $Habilita != ''){            $a .= ",Habilita='".$Habilita."'" ;           }else{$a .= ",Habilita=''" ;}
				if(isset($Principal) && $Principal != ''){          $a .= ",Principal='".$Principal."'" ;         }else{$a .= ",Principal=''" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `core_permisos_listado` SET ".$a." WHERE idAdmpm = '$idAdmpm'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					/************************************************************/
					//Variable
					$Descripcion = '[MODIFICACION] ->';
					
					//Verificaciones
					/****************************************/
					//Si la categoria cambia
					if($id_pmcat!=$fake_id_pmcat){
						//Reviso la categoria antigua
						$query = "SELECT Nombre FROM `core_permisos_categorias` WHERE id_pmcat='".$fake_id_pmcat."'";
						$resultado = mysqli_query($dbConn, $query);
						$rowCat_1 = mysqli_fetch_assoc ($resultado);
						//Reviso la categoria nueva
						$query = "SELECT Nombre FROM `core_permisos_categorias` WHERE id_pmcat='".$id_pmcat."'";
						$resultado = mysqli_query($dbConn, $query);
						$rowCat_2 = mysqli_fetch_assoc ($resultado);
						//concateno mensaje
						$Descripcion .= 'Se cambia la transaccion '.$Nombre.' de la categoria '.$rowCat_1['Nombre'].' a la categoria '.$rowCat_2['Nombre'].'. '; 
						
					}
					//Si la categoria cambia
					if($Nombre!=$fake_Nombre){
						//concateno mensaje
						$Descripcion .= 'Se cambia el nombre de la transaccion '.$fake_Nombre.' a  <strong>'.$Nombre.'</strong>.'; 
					}
					//Verifico que existan cambios
					if($Descripcion!='[MODIFICACION] ->'){
						$a  = "'".fecha_actual()."'" ;
						$a .= ",'".$Descripcion."'" ;  
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `core_log_cambios` (Fecha, Descripcion) 
						VALUES ({$a} )";
						$result = mysqli_query($dbConn, $query);
					}
					
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
			$query  = "DELETE FROM `core_permisos_listado` WHERE idAdmpm = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			
			
				
			
			//elimino los permisos relacionados a los usuarios
			$query  = "DELETE FROM `usuarios_permisos` WHERE idAdmpm = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if(!$resultado){
				//Genero numero aleatorio
				$vardata = genera_password(8,'alfanumerico');
				
				//Guardo el error en una variable temporal
				$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
				$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
				$_SESSION['ErrorListing'][$vardata]['query']        = $query;
				
			}
			
				
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;														
/*******************************************************************************************************************/
	}
?>
