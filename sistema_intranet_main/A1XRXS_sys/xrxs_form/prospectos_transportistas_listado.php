<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridProspectoad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idProspecto']) )           $idProspecto             = $_POST['idProspecto'];
	if ( !empty($_POST['idSistema']) )             $idSistema               = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )                $Nombre 	                = $_POST['Nombre'];
	if ( !empty($_POST['Fono']) )                  $Fono 	                = $_POST['Fono'];
	if ( !empty($_POST['email']) )                 $email                   = $_POST['email'];
	if ( !empty($_POST['email_noti']) )            $email_noti              = $_POST['email_noti'];
	if ( !empty($_POST['F_Ingreso']) )             $F_Ingreso               = $_POST['F_Ingreso'];
	if ( !empty($_POST['idEstadoFidelizacion']) )  $idEstadoFidelizacion    = $_POST['idEstadoFidelizacion'];
	if ( !empty($_POST['idEtapa']) )               $idEtapa                 = $_POST['idEtapa'];
	
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
			case 'idProspecto':            if(empty($idProspecto)){            $error['idProspecto']             = 'error/No ha ingresado el id';}break;
			case 'idSistema':              if(empty($idSistema)){              $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'Nombre':                 if(empty($Nombre)){                 $error['Nombre']                  = 'error/No ha ingresado el Nombre del chofer';}break;
			case 'Fono':                   if(empty($Fono)){                   $error['Fono']                    = 'error/No ha ingresado el telefono';}break;
			case 'email':                  if(empty($email)){                  $error['email']                   = 'error/No ha ingresado el email';}break;
			case 'email_noti':             if(empty($email_noti)){             $error['email_noti']              = 'error/No ha ingresado el email de notificacion';}break;
			case 'F_Ingreso':              if(empty($F_Ingreso)){              $error['F_Ingreso']               = 'error/No ha ingresado la fecha de ingreso';}break;
			case 'idEstadoFidelizacion':   if(empty($idEstadoFidelizacion)){   $error['idEstadoFidelizacion']    = 'error/No ha seleccionado el estado de la fidelizacion';}break;
			case 'idEtapa':                if(empty($idEtapa)){                $error['idEtapa']                 = 'error/No ha seleccionado la etapa de la fidelizacion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email)){if(validaremail($email)){ }else{   $error['email']   = 'error/El Email ingresado no es valido'; }}	
	if(isset($email_noti)){if(validaremail($email_noti)){ }else{   $error['email_noti']   = 'error/El Email ingresado no es valido'; }}	
	if(isset($Fono)){if(validarnumero($Fono)) {        $error['Fono']   = 'error/Ingrese un numero telefonico valido'; }}
	
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
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'prospectos_transportistas_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn);
			}
			if(isset($email)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('email', 'prospectos_transportistas_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                           $a  = "'".$idSistema."'" ;               }else{$a ="''";}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",'".$Nombre."'" ;                 }else{$a .= ",''";}
				if(isset($Fono) && $Fono != ''){                                     $a .= ",'".$Fono."'" ;                   }else{$a .= ",''";}
				if(isset($email) && $email != ''){                                   $a .= ",'".$email."'" ;                  }else{$a .= ",''";}
				if(isset($email_noti) && $email_noti != ''){                         $a .= ",'".$email_noti."'" ;             }else{$a .= ",''";}
				if(isset($F_Ingreso) && $F_Ingreso != ''){                           $a .= ",'".$F_Ingreso."'" ;              }else{$a .= ",''";}
				if(isset($idEstadoFidelizacion) && $idEstadoFidelizacion != ''){     $a .= ",'".$idEstadoFidelizacion."'" ;   }else{$a .= ",''";}
				if(isset($idEtapa) && $idEtapa != ''){                               $a .= ",'".$idEtapa."'" ;                }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `prospectos_transportistas_listado` (idSistema, Nombre, Fono, email, email_noti,
				F_Ingreso, idEstadoFidelizacion, idEtapa) 
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
			$ndata_2 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idProspecto)){
				$ndata_1 = db_select_nrows ('Nombre', 'prospectos_transportistas_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idProspecto!='".$idProspecto."'", $dbConn);
			}
			if(isset($email)&&isset($idSistema)&&isset($idProspecto)){
				$ndata_2 = db_select_nrows ('email', 'prospectos_transportistas_listado', '', "email='".$email."' AND idSistema='".$idSistema."' AND idProspecto!='".$idProspecto."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idProspecto='".$idProspecto."'" ;
				if(isset($idSistema) && $idSistema != ''){                       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($Nombre) && $Nombre != ''){                             $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Fono) && $Fono != ''){                                 $a .= ",Fono='".$Fono."'" ;}
				if(isset($email) && $email != ''){                               $a .= ",email='".$email."'" ;}
				if(isset($email_noti) && $email_noti != ''){                     $a .= ",email_noti='".$email_noti."'" ;}
				if(isset($F_Ingreso) && $F_Ingreso!= ''){                        $a .= ",F_Ingreso='".$F_Ingreso."'" ;}
				if(isset($idEstadoFidelizacion) && $idEstadoFidelizacion!= ''){  $a .= ",idEstadoFidelizacion='".$idEstadoFidelizacion."'" ;}
				if(isset($idEtapa) && $idEtapa!= ''){                            $a .= ",idEtapa='".$idEtapa."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `prospectos_transportistas_listado` SET ".$a." WHERE idProspecto = '$idProspecto'";
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
			$query  = "DELETE FROM `prospectos_transportistas_listado` WHERE idProspecto = {$_GET['del']}";
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
