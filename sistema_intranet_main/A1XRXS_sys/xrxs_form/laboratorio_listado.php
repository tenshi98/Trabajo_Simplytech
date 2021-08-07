<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridLaboratorioad                                                */
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
	if ( !empty($_POST['idLaboratorio']) )    $idLaboratorio      = $_POST['idLaboratorio'];
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
	$form_obligatorios = str_replace(' ', '', $_SESSION['form_require']);
	$INT_piezas = explode(",", $form_obligatorios);
	//recorro los elementos
	foreach ($INT_piezas as $INT_valor) {
		//veo si existe el dato solicitado y genero el error
		switch ($INT_valor) {
			case 'idLaboratorio':     if(empty($idLaboratorio)){     $error['idLaboratorio']      = 'error/No ha ingresado el id';}break;
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
	if(isset($email)&&!validarEmail($email)){    $error['email']   = 'error/El Email ingresado no es valido'; }	
	if(isset($Fono1)&&!validarNumero($Fono1)) {  $error['Fono1']   = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Fono2)&&!validarNumero($Fono2)) {  $error['Fono2']   = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Rut)&&!validarRut($Rut)){          $error['Rut']     = 'error/El Rut ingresado no es valido'; }
	if(isset($Fax)&&!validarNumero($Fax)) {      $error['Fax']     = 'error/Ingrese un numero de fax valido'; }

	if(isset($email)&&contar_palabras_censuradas($email)!=0){                      $error['email']           = 'error/Edita email, contiene palabras no permitidas'; }	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                    $error['Nombre']          = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){              $error['Direccion']       = 'error/Edita Direccion, contiene palabras no permitidas'; }	
	if(isset($PersonaContacto)&&contar_palabras_censuradas($PersonaContacto)!=0){  $error['PersonaContacto'] = 'error/Edita la Persona de Contacto, contiene palabras no permitidas'; }	
	if(isset($Web)&&contar_palabras_censuradas($Web)!=0){                          $error['Web']             = 'error/Edita la Web, contiene palabras no permitidas'; }	
	if(isset($Giro)&&contar_palabras_censuradas($Giro)!=0){                        $error['Giro']            = 'error/Edita Giro, contiene palabras no permitidas'; }	
	
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
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'laboratorio_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'laboratorio_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)){
				$ndata_3 = db_select_nrows (false, 'email', 'laboratorio_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ingresado ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			
			
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
				$query  = "INSERT INTO `laboratorio_listado` (idSistema, idEstado, idTipo, email, Nombre,
				Rut, fNacimiento, Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, PersonaContacto,
				Web, idPais, Giro) VALUES (".$a.")";
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
			$ndata_3 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idLaboratorio)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'laboratorio_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idLaboratorio!='".$idLaboratorio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idLaboratorio)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'laboratorio_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idLaboratorio!='".$idLaboratorio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)&&isset($idLaboratorio)){
				$ndata_3 = db_select_nrows (false, 'email', 'laboratorio_listado', '', "email='".$email."' AND idSistema='".$idSistema."' AND idLaboratorio!='".$idLaboratorio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre ingresado ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idLaboratorio='".$idLaboratorio."'" ;
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
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'laboratorio_listado', 'idLaboratorio = "'.$idLaboratorio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					header( 'Location: '.$location.'&edited=true' );
					die;
					
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
				$resultado = db_delete_data (false, 'laboratorio_listado', 'idLaboratorio = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idLaboratorio  = $_GET['id'];
			$idEstado       = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$a = "idEstado='".$idEstado."'" ;
			$resultado = db_update_data (false, $a, 'laboratorio_listado', 'idLaboratorio = "'.$idLaboratorio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			}
			

		break;				
/*******************************************************************************************************************/
	}
?>
