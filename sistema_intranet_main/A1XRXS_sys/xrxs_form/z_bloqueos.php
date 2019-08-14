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
	if ( !empty($_GET['f_Fecha']) )      $Fecha       = $_GET['f_Fecha'];
	if ( !empty($_GET['f_usuario']) )    $usuario     = $_GET['f_usuario'];
	if ( !empty($_GET['f_email']) )      $email       = $_GET['f_email'];
	if ( !empty($_GET['f_IP_Client']) )  $IP_Client   = $_GET['f_IP_Client'];
										

	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {

/*******************************************************************************************************************/
		case 'del_1':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$filter = 'WHERE idAcceso!=0';
			if(isset($Fecha)&&$Fecha!=''){          $filter .= " AND Fecha = '".$Fecha."'";}
			if(isset($usuario)&&$usuario!=''){      $filter .= " AND usuario = '".$usuario."'";}
			if(isset($email)&&$email!=''){          $filter .= " AND email = '".$email."'";}
			if(isset($IP_Client)&&$IP_Client!=''){  $filter .= " AND IP_Client = '".$IP_Client."'";}
			
			//Condiciono el borrado
			if($filter!='WHERE idAcceso!=0'){
				//se borra la mantencion
				$query  = "DELETE FROM `alumnos_checkbrute` ".$filter;
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
			}
		
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/
		case 'del_2':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$filter = 'WHERE idAcceso!=0';
			if(isset($Fecha)&&$Fecha!=''){          $filter .= " AND Fecha = '".$Fecha."'";}
			if(isset($usuario)&&$usuario!=''){      $filter .= " AND usuario = '".$usuario."'";}
			if(isset($email)&&$email!=''){          $filter .= " AND email = '".$email."'";}
			if(isset($IP_Client)&&$IP_Client!=''){  $filter .= " AND IP_Client = '".$IP_Client."'";}
			
			//Condiciono el borrado
			if($filter!='WHERE idAcceso!=0'){
				//se borra la mantencion
				$query  = "DELETE FROM `clientes_checkbrute` ".$filter;
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
			}
		
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/
		case 'del_3':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$filter = 'WHERE idAcceso!=0';
			if(isset($Fecha)&&$Fecha!=''){          $filter .= " AND Fecha = '".$Fecha."'";}
			if(isset($usuario)&&$usuario!=''){      $filter .= " AND usuario = '".$usuario."'";}
			if(isset($email)&&$email!=''){          $filter .= " AND email = '".$email."'";}
			if(isset($IP_Client)&&$IP_Client!=''){  $filter .= " AND IP_Client = '".$IP_Client."'";}
			
			//Condiciono el borrado
			if($filter!='WHERE idAcceso!=0'){
				//se borra la mantencion
				$query  = "DELETE FROM `transportes_checkbrute` ".$filter;
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
			}
		
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;
/*******************************************************************************************************************/
		case 'del_4':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$filter = 'WHERE idAcceso!=0';
			if(isset($Fecha)&&$Fecha!=''){          $filter .= " AND Fecha = '".$Fecha."'";}
			if(isset($usuario)&&$usuario!=''){      $filter .= " AND usuario = '".$usuario."'";}
			if(isset($email)&&$email!=''){          $filter .= " AND email = '".$email."'";}
			if(isset($IP_Client)&&$IP_Client!=''){  $filter .= " AND IP_Client = '".$IP_Client."'";}
			
			//Condiciono el borrado
			if($filter!='WHERE idAcceso!=0'){
				//se borra la mantencion
				$query  = "DELETE FROM `usuarios_checkbrute` ".$filter;
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
			}
		
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;																	
/*******************************************************************************************************************/
	}
?>
