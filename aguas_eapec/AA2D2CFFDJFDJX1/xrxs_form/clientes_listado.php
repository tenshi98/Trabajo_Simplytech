<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridClientead                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idCliente']) )             $idCliente              = $_POST['idCliente'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )              $idEstado               = $_POST['idEstado'];
	if ( !empty($_POST['idTipo']) )                $idTipo                 = $_POST['idTipo'];
	if ( !empty($_POST['email']) )                 $email                  = $_POST['email'];
	if ( !empty($_POST['Nombre']) )                $Nombre 	               = $_POST['Nombre'];
	if ( !empty($_POST['Rut']) )                   $Rut 	               = $_POST['Rut'];
	if ( !empty($_POST['fNacimiento']) )           $fNacimiento 	       = $_POST['fNacimiento'];
	if ( !empty($_POST['Direccion']) )             $Direccion 	           = $_POST['Direccion'];
	if ( !empty($_POST['Fono1']) )                 $Fono1 	               = $_POST['Fono1'];
	if ( !empty($_POST['Fono2']) )                 $Fono2 	               = $_POST['Fono2'];
	if ( !empty($_POST['idCiudad']) )              $idCiudad               = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )              $idComuna               = $_POST['idComuna'];
	if ( !empty($_POST['Fax']) )                   $Fax                    = $_POST['Fax'];
	if ( !empty($_POST['PersonaContacto']) )       $PersonaContacto        = $_POST['PersonaContacto'];
	if ( !empty($_POST['Web']) )                   $Web                    = $_POST['Web'];
	if ( !empty($_POST['Giro']) )                  $Giro                   = $_POST['Giro'];
	if ( !empty($_POST['UnidadHabitacional']) )    $UnidadHabitacional     = $_POST['UnidadHabitacional'];
	if ( !empty($_POST['UnidadHabitacional_2']) )  $UnidadHabitacional_2   = $_POST['UnidadHabitacional_2'];
	if ( !empty($_POST['idMarcadores']) )          $idMarcadores           = $_POST['idMarcadores'];
	if ( !empty($_POST['idRemarcadores']) )        $idRemarcadores         = $_POST['idRemarcadores'];
	if ( !empty($_POST['Arranque']) )              $Arranque               = $_POST['Arranque'];
	if ( !empty($_POST['Identificador']) )         $Identificador          = $_POST['Identificador'];
	if ( !empty($_POST['idEstadoPago']) )          $idEstadoPago           = $_POST['idEstadoPago'];
	if ( !empty($_POST['idFacturable']) )          $idFacturable           = $_POST['idFacturable'];
	if ( !empty($_POST['latitud']) )               $latitud                = $_POST['latitud'];
	if ( !empty($_POST['longitud']) )              $longitud               = $_POST['longitud'];
	if ( !empty($_POST['idCiudadFact']) )          $idCiudadFact           = $_POST['idCiudadFact'];
	if ( !empty($_POST['idComunaFact']) )          $idComunaFact           = $_POST['idComunaFact'];
	if ( !empty($_POST['DireccionFact']) )         $DireccionFact          = $_POST['DireccionFact'];
	if ( !empty($_POST['idSector']) )              $idSector               = $_POST['idSector'];
	if ( !empty($_POST['idPuntoMuestreo']) )       $idPuntoMuestreo        = $_POST['idPuntoMuestreo'];
	if ( !empty($_POST['UTM_norte']) )             $UTM_norte              = $_POST['UTM_norte'];
	if ( !empty($_POST['UTM_este']) )              $UTM_este               = $_POST['UTM_este'];
	

/*******************************************************************************************************************/
/*                                      Verificacion de los datos obligatorios                                     */
/*******************************************************************************************************************/

	//limpio y separo los datos de la cadena de comprobacion
	$form_obligatorios = str_replace(' ', '', $form_obligatorios);
	$piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($piezas as $valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($valor) {
			case 'idCliente':            if(empty($idCliente)){            $error['idCliente']            = 'error/No ha ingresado el id';}break;
			case 'idSistema':            if(empty($idSistema)){            $error['idSistema']            = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':             if(empty($idEstado)){             $error['idEstado']             = 'error/No ha seleccionado el Estado';}break;
			case 'idTipo':               if(empty($idTipo)){               $error['idTipo']               = 'error/No ha seleccionado el tipo de cliente';}break;
			case 'email':                if(empty($email)){                $error['email']                = 'error/No ha ingresado el email';}break;
			case 'Nombre':               if(empty($Nombre)){               $error['Nombre']               = 'error/No ha ingresado el Nombre';}break;
			case 'Rut':                  if(empty($Rut)){                  $error['Rut']                  = 'error/No ha ingresado el Rut';}break;	
			case 'fNacimiento':          if(empty($fNacimiento)){          $error['fNacimiento']          = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'Direccion':            if(empty($Direccion)){            $error['Direccion']            = 'error/No ha ingresado la cdireccion';}break;
			case 'Fono1':                if(empty($Fono1)){                $error['Fono1']                = 'error/No ha ingresado el telefono';}break;
			case 'Fono2':                if(empty($Fono2)){                $error['Fono2']                = 'error/No ha ingresado el telefono';}break;
			case 'idCiudad':             if(empty($idCiudad)){             $error['idCiudad']             = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':             if(empty($idComuna)){             $error['idComuna']             = 'error/No ha seleccionado la comuna';}break;
			case 'Fax':                  if(empty($Fax)){                  $error['Fax']                  = 'error/No ha ingresado el fax';}break;
			case 'PersonaContacto':      if(empty($PersonaContacto)){      $error['PersonaContacto']      = 'error/No ha ingresado el nombre de la persona de contacto';}break;
			case 'Web':                  if(empty($Web)){                  $error['Web']                  = 'error/No ha ingresado la pagina web';}break;
			case 'Giro':                 if(empty($Giro)){                 $error['Giro']                 = 'error/No ha ingresado el Giro de la empresa';}break;
			case 'UnidadHabitacional':   if(empty($UnidadHabitacional)){   $error['UnidadHabitacional']   = 'error/No ha ingresado el Cargo Fijo';}break;
			case 'UnidadHabitacional_2': if(empty($UnidadHabitacional_2)){ $error['UnidadHabitacional_2'] = 'error/No ha ingresado el Cargo Fijo';}break;
			case 'idMarcadores':         if(empty($idMarcadores)){         $error['idMarcadores']         = 'error/No ha ingresado el marcador';}break;
			case 'idRemarcadores':       if(empty($idRemarcadores)){       $error['idRemarcadores']       = 'error/No ha ingresado el remarcador';}break;
			case 'Arranque':             if(empty($Arranque)){             $error['Arranque']             = 'error/No ha ingresado el arranque';}break;
			case 'Identificador':        if(empty($Identificador)){        $error['Identificador']        = 'error/No ha ingresado el identificador';}break;
			case 'idEstadoPago':         if(empty($idEstadoPago)){         $error['idEstadoPago']         = 'error/No ha seleccionado el estado de pago';}break;
			case 'idFacturable':         if(empty($idFacturable)){         $error['idFacturable']         = 'error/No ha seleccionado si es facturable';}break;
			case 'latitud':              if(empty($latitud)){              $error['latitud']              = 'error/No ha ingresado la latitud';}break;
			case 'longitud':             if(empty($longitud)){             $error['longitud']             = 'error/No ha ingresado la longitud';}break;
			case 'idCiudadFact':         if(empty($idCiudadFact)){         $error['idCiudadFact']         = 'error/No ha seleccionado la region de facturacion';}break;
			case 'idComunaFact':         if(empty($idComunaFact)){         $error['idComunaFact']         = 'error/No ha seleccionado la comuna de facturacion';}break;
			case 'DireccionFact':        if(empty($DireccionFact)){        $error['DireccionFact']        = 'error/No ha ingresado la direccion de facturacion';}break;
			case 'idSector':             if(empty($idSector)){             $error['idSector']             = 'error/No ha seleccionado el sector';}break;
			case 'idPuntoMuestreo':      if(empty($idPuntoMuestreo)){      $error['idPuntoMuestreo']      = 'error/No ha seleccionado el tipo de medicion';}break;
			case 'UTM_norte':            if(empty($UTM_norte)){            $error['UTM_norte']            = 'error/No ha ingresado UTM norte';}break;
			case 'UTM_este':             if(empty($UTM_este)){             $error['UTM_este']             = 'error/No ha ingresado UTM este';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email)){if(validaremail($email)){ }else{   $error['email']   = 'error/El Email ingresado no es valido'; }}	
	if(isset($Fono1)){if(validarnumero($Fono1)) {        $error['Fono1']   = 'error/Ingrese un numero telefonico valido'; }}
	if(isset($Fono2)){if(validarnumero($Fono2)) {        $error['Fono2']   = 'error/Ingrese un numero telefonico valido'; }}
	if(isset($Rut)){if(RutValidate($Rut)==0){            $error['Rut']     = 'error/El Rut ingresado no es valido'; }}
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':

			//Verifico otros datos
			
			//Se verifica si el dato existe
			if(isset($Nombre)){
				$sql_usuario = mysqli_query("SELECT Nombre FROM clientes_listado WHERE Nombre='".$Nombre."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/La nombre de la persona ya existe en el sistema';}
			
			// se verifica si el rut ya existe
			if(isset($Rut)){
				$sql_email = mysqli_query("SELECT Rut FROM clientes_listado WHERE Rut='".$Rut."' AND idSistema='".$idSistema."' ");
				$n2 = mysqli_num_rows($sql_email);
			} else {$n2=0;}
			if($n2 > 0) {$error['Rut'] = 'error/El Rut ya existe en el sistema';}
			
			// se verifica si el correo ya existe
			if(isset($email)){
				$sql_email = mysqli_query("SELECT email FROM clientes_listado WHERE email='".$email."' AND idSistema='".$idSistema."' ");
				$n2 = mysqli_num_rows($sql_email);
			} else {$n2=0;}
			if($n2 > 0) {$error['email'] = 'error/El correo de ingresado ya existe en el sistema';}
			
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                        $a  = "'".$idSistema."'" ;             }else{$a ="''";}
				if(isset($idEstado) && $idEstado != ''){                          $a .= ",'".$idEstado."'" ;             }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                              $a .= ",'".$idTipo."'" ;               }else{$a .= ",''";}
				if(isset($email) && $email != ''){                                $a .= ",'".$email."'" ;                }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                              $a .= ",'".$Nombre."'" ;               }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                                    $a .= ",'".$Rut."'" ;                  }else{$a .= ",''";}
				if(isset($fNacimiento) && $fNacimiento != ''){                    $a .= ",'".$fNacimiento."'" ;          }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                        $a .= ",'".$Direccion."'" ;            }else{$a .= ",''";}
				if(isset($Fono1) && $Fono1 != ''){                                $a .= ",'".$Fono1."'" ;                }else{$a .= ",''";}
				if(isset($Fono2) && $Fono2 != ''){                                $a .= ",'".$Fono2."'" ;                }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                          $a .= ",'".$idCiudad."'" ;             }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                          $a .= ",'".$idComuna."'" ;             }else{$a .= ",''";}
				if(isset($Fax) && $Fax != ''){                                    $a .= ",'".$Fax."'" ;                  }else{$a .= ",''";}
				if(isset($PersonaContacto) && $PersonaContacto != ''){            $a .= ",'".$PersonaContacto."'" ;      }else{$a .= ",''";}
				if(isset($Web) && $Web != ''){                                    $a .= ",'".$Web."'" ;                  }else{$a .= ",''";}
				if(isset($Giro) && $Giro != ''){                                  $a .= ",'".$Giro."'" ;                 }else{$a .= ",''";}
				if(isset($UnidadHabitacional) && $UnidadHabitacional != ''){      $a .= ",'".$UnidadHabitacional."'" ;   }else{$a .= ",''";}
				if(isset($UnidadHabitacional_2) && $UnidadHabitacional_2 != ''){  $a .= ",'".$UnidadHabitacional_2."'" ; }else{$a .= ",''";}
				if(isset($idMarcadores) && $idMarcadores != ''){                  $a .= ",'".$idMarcadores."'" ;         }else{$a .= ",''";}
				if(isset($idRemarcadores) && $idRemarcadores != ''){              $a .= ",'".$idRemarcadores."'" ;       }else{$a .= ",''";}
				if(isset($Arranque) && $Arranque != ''){                          $a .= ",'".$Arranque."'" ;             }else{$a .= ",''";}
				if(isset($Identificador) && $Identificador != ''){                $a .= ",'".$Identificador."'" ;        }else{$a .= ",''";}
				if(isset($idEstadoPago) && $idEstadoPago != ''){                  $a .= ",'".$idEstadoPago."'" ;         }else{$a .= ",''";}
				if(isset($idFacturable) && $idFacturable != ''){                  $a .= ",'".$idFacturable."'" ;         }else{$a .= ",''";}
				if(isset($latitud) && $latitud != ''){                            $a .= ",'".$latitud."'" ;              }else{$a .= ",''";}
				if(isset($longitud) && $longitud != ''){                          $a .= ",'".$longitud."'" ;             }else{$a .= ",''";}
				if(isset($idCiudadFact) && $idCiudadFact != ''){                  $a .= ",'".$idCiudadFact."'" ;         }else{$a .= ",''";}
				if(isset($idComunaFact) && $idComunaFact != ''){                  $a .= ",'".$idComunaFact."'" ;         }else{$a .= ",''";}
				if(isset($DireccionFact) && $DireccionFact != ''){                $a .= ",'".$DireccionFact."'" ;        }else{$a .= ",''";}
				if(isset($RazonSocial) && $RazonSocial != ''){                    $a .= ",'".$RazonSocial."'" ;          }else{$a .= ",''";}
				if(isset($idSector) && $idSector != ''){                          $a .= ",'".$idSector."'" ;             }else{$a .= ",''";}
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo != ''){            $a .= ",'".$idPuntoMuestreo."'" ;      }else{$a .= ",''";}
				if(isset($UTM_norte) && $UTM_norte != ''){                        $a .= ",'".$UTM_norte."'" ;            }else{$a .= ",''";}
				if(isset($UTM_este) && $UTM_este != ''){                          $a .= ",'".$UTM_este."'" ;             }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `clientes_listado` (idSistema, idEstado, idTipo, email, Nombre,
				Rut, fNacimiento, Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, PersonaContacto,
				Web, Giro, UnidadHabitacional, UnidadHabitacional_2, idMarcadores, idRemarcadores, Arranque, 
				Identificador,idEstadoPago, idFacturable, latitud, longitud, idCiudadFact, idComunaFact,
				DireccionFact, RazonSocial, idSector, idPuntoMuestreo, UTM_norte, UTM_este ) 
				VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
					
				header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
				die;
				
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCliente='".$idCliente."'" ;
				if(isset($idSistema) && $idSistema != ''){                       $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                         $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTipo) && $idTipo != ''){                             $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($email) && $email != ''){                               $a .= ",email='".$email."'" ;}
				if(isset($Nombre) && $Nombre != ''){                             $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Rut) && $Rut != ''){                                   $a .= ",Rut='".$Rut."'" ;}
				if(isset($fNacimiento) && $fNacimiento != ''){                   $a .= ",fNacimiento='".$fNacimiento."'" ;}
				if(isset($Direccion) && $Direccion != ''){                       $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Fono1) && $Fono1 != ''){                               $a .= ",Fono1='".$Fono1."'" ;}
				if(isset($Fono2) && $Fono2 != ''){                               $a .= ",Fono2='".$Fono2."'" ;}
				if(isset($idCiudad) && $idCiudad!= ''){                          $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna!= ''){                          $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Fax) && $Fax!= ''){                                    $a .= ",Fax='".$Fax."'" ;}
				if(isset($PersonaContacto) && $PersonaContacto!= ''){            $a .= ",PersonaContacto='".$PersonaContacto."'" ;}
				if(isset($Web) && $Web!= ''){                                    $a .= ",Web='".$Web."'" ;}
				if(isset($Giro) && $Giro!= ''){                                  $a .= ",Giro='".$Giro."'" ;}
				if(isset($UnidadHabitacional) && $UnidadHabitacional!= ''){      $a .= ",UnidadHabitacional='".$UnidadHabitacional."'" ;}
				if(isset($UnidadHabitacional_2) && $UnidadHabitacional_2!= ''){  $a .= ",UnidadHabitacional_2='".$UnidadHabitacional_2."'" ;}
				if(isset($idMarcadores) && $idMarcadores!= ''){                  $a .= ",idMarcadores='".$idMarcadores."'" ;}
				if(isset($idRemarcadores) && $idRemarcadores!= ''){              $a .= ",idRemarcadores='".$idRemarcadores."'" ;}
				if(isset($Arranque) && $Arranque!= ''){                          $a .= ",Arranque='".$Arranque."'" ;}
				if(isset($Identificador) && $Identificador!= ''){                $a .= ",Identificador='".$Identificador."'" ;}
				if(isset($idEstadoPago) && $idEstadoPago!= ''){                  $a .= ",idEstadoPago='".$idEstadoPago."'" ;}
				if(isset($idFacturable) && $idFacturable!= ''){                  $a .= ",idFacturable='".$idFacturable."'" ;}
				if(isset($latitud) && $latitud!= ''){                            $a .= ",latitud='".$latitud."'" ;}
				if(isset($longitud) && $longitud!= ''){                          $a .= ",longitud='".$longitud."'" ;}
				if(isset($idCiudadFact) && $idCiudadFact!= ''){                  $a .= ",idCiudadFact='".$idCiudadFact."'" ;}
				if(isset($idComunaFact) && $idComunaFact!= ''){                  $a .= ",idComunaFact='".$idComunaFact."'" ;}
				if(isset($DireccionFact) && $DireccionFact!= ''){                $a .= ",DireccionFact='".$DireccionFact."'" ;}
				if(isset($RazonSocial) && $RazonSocial!= ''){                    $a .= ",RazonSocial='".$RazonSocial."'" ;}
				if(isset($idSector) && $idSector!= ''){                          $a .= ",idSector='".$idSector."'" ;}
				if(isset($idPuntoMuestreo) && $idPuntoMuestreo!= ''){            $a .= ",idPuntoMuestreo='".$idPuntoMuestreo."'" ;}
				if(isset($UTM_norte) && $UTM_norte!= ''){                        $a .= ",UTM_norte='".$UTM_norte."'" ;}
				if(isset($UTM_este) && $UTM_este!= ''){                          $a .= ",UTM_este='".$UTM_este."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '$idCliente'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	

						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `clientes_listado` WHERE idCliente = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
/*******************************************************************************************************************/
		case 'estado':	
		
			$idCliente  = $_GET['id'];
			$estado     = $_GET['estado'];
			$query  = "UPDATE clientes_listado SET idEstado = '$estado'	
			WHERE idCliente    = '$idCliente'";
			$result = mysqli_query($dbConn, $query);

			header( 'Location: '.$location.'&edited=true' );
			die; 


		break;				
/*******************************************************************************************************************/
	}
?>
