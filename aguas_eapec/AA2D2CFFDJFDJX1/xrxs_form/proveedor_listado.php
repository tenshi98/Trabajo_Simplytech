<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridProveedorad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if ( !empty($_POST['idProveedor']) )      $idProveedor        = $_POST['idProveedor'];
	if ( !empty($_POST['idSistema']) )        $idSistema          = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )         $idEstado           = $_POST['idEstado'];
	if ( !empty($_POST['idTipo']) )           $idTipo             = $_POST['idTipo'];
	if ( !empty($_POST['email']) )            $email              = $_POST['email'];
	if ( !empty($_POST['Nombre']) )           $Nombre 	          = $_POST['Nombre'];
	if ( !empty($_POST['Rut']) )              $Rut 	              = $_POST['Rut'];
	if ( !empty($_POST['fNacimiento']) )      $fNacimiento 	      = $_POST['fNacimiento'];
	if ( !empty($_POST['Direccion']) )        $Direccion 	      = $_POST['Direccion'];
	if ( !empty($_POST['Fono1']) )            $Fono1 	          = $_POST['Fono1'];
	if ( !empty($_POST['Fono2']) )            $Fono2 	          = $_POST['Fono2'];
	if ( !empty($_POST['idCiudad']) )         $idCiudad           = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )         $idComuna           = $_POST['idComuna'];
	if ( !empty($_POST['Fax']) )              $Fax                = $_POST['Fax'];
	if ( !empty($_POST['PersonaContacto']) )  $PersonaContacto    = $_POST['PersonaContacto'];
	if ( !empty($_POST['Web']) )              $Web                = $_POST['Web'];
	if ( !empty($_POST['idPais']) )           $idPais             = $_POST['idPais'];
	if ( !empty($_POST['Giro']) )             $Giro               = $_POST['Giro'];

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
			case 'idProveedor':       if(empty($idProveedor)){       $error['idProveedor']        = 'error/No ha ingresado el id';}break;
			case 'idSistema':         if(empty($idSistema)){         $error['idSistema']          = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':          if(empty($idEstado)){          $error['idEstado']           = 'error/No ha seleccionado el Estado';}break;
			case 'idTipo':            if(empty($idTipo)){            $error['idTipo']             = 'error/No ha seleccionado el ripo de proveedor';}break;
			case 'email':             if(empty($email)){             $error['email']              = 'error/No ha ingresado la email';}break;
			case 'Nombre':            if(empty($Nombre)){            $error['Nombre']             = 'error/No ha ingresado el Nombre';}break;
			case 'Rut':               if(empty($Rut)){               $error['Rut']                = 'error/No ha ingresado el Rut';}break;	
			case 'fNacimiento':       if(empty($fNacimiento)){       $error['fNacimiento']        = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'Direccion':         if(empty($Direccion)){         $error['Direccion']          = 'error/No ha ingresado la direccion';}break;
			case 'Fono1':             if(empty($Fono1)){             $error['Fono1']              = 'error/No ha ingresado el numero telefonico';}break;
			case 'Fono2':             if(empty($Fono2)){             $error['Fono2']              = 'error/No ha ingresado el numero telefonico';}break;
			case 'idCiudad':          if(empty($idCiudad)){          $error['idCiudad']           = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':          if(empty($idComuna)){          $error['idComuna']           = 'error/No ha seleccionado la comuna';}break;
			case 'Fax':               if(empty($Fax)){               $error['Fax']                = 'error/No ha ingresado el fax';}break;
			case 'PersonaContacto':   if(empty($PersonaContacto)){   $error['PersonaContacto']    = 'error/No ha ingresado el nombre de la persona de contato';}break;
			case 'Web':               if(empty($Web)){               $error['Web']                = 'error/No ha ingresado la pagina web';}break;
			case 'idPais':            if(empty($idPais)){            $error['idPais']             = 'error/No ha seleccionado el pais';}break;
			case 'Giro':              if(empty($Giro)){              $error['Giro']               = 'error/No ha ingresado el Giro de la empresa';}break;
			
			
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
	if(isset($Fax)){if(validarnumero($Fax)) {            $error['Fax']     = 'error/Ingrese un numero de fax valido'; }}
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
				$sql_usuario = mysqli_query("SELECT Nombre FROM proveedor_listado WHERE Nombre='".$Nombre."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El nombre ingresado ya existe en el sistema';}
			
			// se verifica si el rut ya existe
			if(isset($Rut)){
				$sql_email = mysqli_query("SELECT Rut FROM proveedor_listado WHERE Rut='".$Rut."' AND idSistema='".$idSistema."'  ");
				$n2 = mysqli_num_rows($sql_email);
			} else {$n2=0;}
			if($n2 > 0) {$error['Rut'] = 'error/El Rut ya existe en el sistema';}
			
			// se verifica si el correo ya existe
			if(isset($email)){
				$sql_email = mysqli_query("SELECT email FROM proveedor_listado WHERE email='".$email."' AND idSistema='".$idSistema."' ");
				$n2 = mysqli_num_rows($sql_email);
			} else {$n2=0;}
			if($n2 > 0) {$error['email'] = 'error/El correo de ingresado ya existe en el sistema';}
			
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                 $a  = "'".$idSistema."'" ;          }else{$a  = "''";}
				if(isset($idEstado) && $idEstado != ''){                   $a .= ",'".$idEstado."'" ;          }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                       $a .= ",'".$idTipo."'" ;            }else{$a .= ",''";}
				if(isset($email) && $email != ''){                         $a .= ",'".$email."'" ;             }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                       $a .= ",'".$Nombre."'" ;            }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                             $a .= ",'".$Rut."'" ;               }else{$a .= ",''";}
				if(isset($fNacimiento) && $fNacimiento != ''){             $a .= ",'".$fNacimiento."'" ;       }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                 $a .= ",'".$Direccion."'" ;         }else{$a .= ",''";}
				if(isset($Fono1) && $Fono1 != ''){                         $a .= ",'".$Fono1."'" ;             }else{$a .= ",''";}
				if(isset($Fono2) && $Fono2 != ''){                         $a .= ",'".$Fono2."'" ;             }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                   $a .= ",'".$idCiudad."'" ;          }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                   $a .= ",'".$idComuna."'" ;          }else{$a .= ",''";}
				if(isset($Fax) && $Fax != ''){                             $a .= ",'".$Fax."'" ;               }else{$a .= ",''";}
				if(isset($PersonaContacto) && $PersonaContacto != ''){     $a .= ",'".$PersonaContacto."'" ;   }else{$a .= ",''";}
				if(isset($Web) && $Web != ''){                             $a .= ",'".$Web."'" ;               }else{$a .= ",''";}
				if(isset($idPais) && $idPais != ''){                       $a .= ",'".$idPais."'" ;            }else{$a .= ",''";}
				if(isset($Giro) && $Giro != ''){                           $a .= ",'".$Giro."'" ;              }else{$a .= ",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `proveedor_listado` (idSistema, idEstado, idTipo, email, Nombre,
				Rut, fNacimiento, Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, PersonaContacto,
				Web, idPais, Giro) VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
					
				header( 'Location: '.$location.'&created=true' );
				die;
				
			}
	
		break;	
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idProveedor='".$idProveedor."'" ;
				if(isset($idSistema) && $idSistema != ''){                 $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                   $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTipo) && $idTipo != ''){                       $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($email) && $email != ''){                         $a .= ",email='".$email."'" ;}
				if(isset($Nombre) && $Nombre != ''){                       $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($Rut) && $Rut != ''){                             $a .= ",Rut='".$Rut."'" ;}
				if(isset($fNacimiento) && $fNacimiento != ''){             $a .= ",fNacimiento='".$fNacimiento."'" ;}
				if(isset($Direccion) && $Direccion != ''){                 $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Fono1) && $Fono1 != ''){                         $a .= ",Fono1='".$Fono1."'" ;}
				if(isset($Fono2) && $Fono2 != ''){                         $a .= ",Fono2='".$Fono2."'" ;}
				if(isset($idCiudad) && $idCiudad!= ''){                    $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna!= ''){                    $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Fax) && $Fax!= ''){                              $a .= ",Fax='".$Fax."'" ;}
				if(isset($PersonaContacto) && $PersonaContacto!= ''){      $a .= ",PersonaContacto='".$PersonaContacto."'" ;}
				if(isset($Web) && $Web!= ''){                              $a .= ",Web='".$Web."'" ;}
				if(isset($idPais) && $idPais!= ''){                        $a .= ",idPais='".$idPais."'" ;}
				if(isset($Giro) && $Giro!= ''){                            $a .= ",Giro='".$Giro."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `proveedor_listado` SET ".$a." WHERE idProveedor = '$idProveedor'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	

						
/*******************************************************************************************************************/
		case 'del':	

			//se borran los permisos del usuario
			$query  = "DELETE FROM `proveedor_listado` WHERE idProveedor = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
						
			header( 'Location: '.$location.'&deleted=true' );
			die;

		break;							
/*******************************************************************************************************************/
		case 'estado':	
		
			$idProveedor  = $_GET['id'];
			$estado     = $_GET['estado'];
			$query  = "UPDATE proveedor_listado SET idEstado = '$estado'	
			WHERE idProveedor    = '$idProveedor'";
			$result = mysqli_query($dbConn, $query);

			header( 'Location: '.$location.'&edited=true' );
			die; 


		break;				
/*******************************************************************************************************************/
	}
?>
