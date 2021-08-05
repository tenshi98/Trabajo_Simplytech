<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridProspectoad                                                */
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
	if ( !empty($_POST['idProspecto']) )             $idProspecto               = $_POST['idProspecto'];
	if ( !empty($_POST['idSistema']) )               $idSistema                 = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )                $idEstado                  = $_POST['idEstado'];
	if ( !empty($_POST['idTipo']) )                  $idTipo                    = $_POST['idTipo'];
	if ( !empty($_POST['idRubro']) )                 $idRubro                   = $_POST['idRubro'];
	if ( !empty($_POST['email']) )                   $email                     = $_POST['email'];
	if ( !empty($_POST['Nombre']) )                  $Nombre 	                = $_POST['Nombre'];
	if ( !empty($_POST['RazonSocial']) )             $RazonSocial 	            = $_POST['RazonSocial'];
	if ( !empty($_POST['Rut']) )                     $Rut 	                    = $_POST['Rut'];
	if ( !empty($_POST['fNacimiento']) )             $fNacimiento 	            = $_POST['fNacimiento'];
	if ( !empty($_POST['Direccion']) )               $Direccion 	            = $_POST['Direccion'];
	if ( !empty($_POST['Fono1']) )                   $Fono1 	                = $_POST['Fono1'];
	if ( !empty($_POST['Fono2']) )                   $Fono2 	                = $_POST['Fono2'];
	if ( !empty($_POST['idCiudad']) )                $idCiudad                  = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )                $idComuna                  = $_POST['idComuna'];
	if ( !empty($_POST['Fax']) )                     $Fax                       = $_POST['Fax'];
	if ( !empty($_POST['PersonaContacto']) )         $PersonaContacto           = $_POST['PersonaContacto'];
	if ( !empty($_POST['PersonaContacto_Fono']) )    $PersonaContacto_Fono      = $_POST['PersonaContacto_Fono'];
	if ( !empty($_POST['PersonaContacto_email']) )   $PersonaContacto_email     = $_POST['PersonaContacto_email'];
	if ( !empty($_POST['PersonaContacto_Cargo']) )   $PersonaContacto_Cargo     = $_POST['PersonaContacto_Cargo'];
	if ( !empty($_POST['Web']) )                     $Web                       = $_POST['Web'];
	if ( !empty($_POST['Giro']) )                    $Giro                      = $_POST['Giro'];
	if ( !empty($_POST['F_Ingreso']) )               $F_Ingreso                 = $_POST['F_Ingreso'];
	if ( !empty($_POST['idUsuario']) )               $idUsuario                 = $_POST['idUsuario'];
	if ( !empty($_POST['idEstadoFidelizacion']) )    $idEstadoFidelizacion      = $_POST['idEstadoFidelizacion'];
	if ( !empty($_POST['idEtapa']) )                 $idEtapa                   = $_POST['idEtapa'];
	if ( !empty($_POST['FModificacion']) )           $FModificacion             = $_POST['FModificacion'];
	if ( !empty($_POST['HModificacion']) )           $HModificacion             = $_POST['HModificacion'];
	if ( !empty($_POST['idUsuarioMod']) )            $idUsuarioMod              = $_POST['idUsuarioMod'];
	if ( !empty($_POST['idTab_1']) )                 $idTab_1                   = $_POST['idTab_1'];
	if ( !empty($_POST['idTab_2']) )                 $idTab_2                   = $_POST['idTab_2'];
	if ( !empty($_POST['idTab_3']) )                 $idTab_3                   = $_POST['idTab_3'];
	if ( !empty($_POST['idTab_4']) )                 $idTab_4                   = $_POST['idTab_4'];
	if ( !empty($_POST['idTab_5']) )                 $idTab_5                   = $_POST['idTab_5'];
	if ( !empty($_POST['idTab_6']) )                 $idTab_6                   = $_POST['idTab_6'];
	if ( !empty($_POST['idTab_7']) )                 $idTab_7                   = $_POST['idTab_7'];
	if ( !empty($_POST['idTab_8']) )                 $idTab_8                   = $_POST['idDia_8'];
	if ( !empty($_POST['idTab_9']) )                 $idTab_9                   = $_POST['idTab_9'];
	if ( !empty($_POST['idTab_10']) )                $idTab_10                  = $_POST['idTab_10'];
	if ( !empty($_POST['idTab_11']) )                $idTab_11                  = $_POST['idTab_11'];
	if ( !empty($_POST['idTab_12']) )                $idTab_12                  = $_POST['idTab_12'];
	if ( !empty($_POST['idTab_13']) )                $idTab_13                  = $_POST['idTab_13'];
	if ( !empty($_POST['idTab_14']) )                $idTab_14                  = $_POST['idTab_14'];
	if ( !empty($_POST['idTab_15']) )                $idTab_15                  = $_POST['idTab_15'];
	
	
	
	if ( !empty($_POST['Contrato_Nombre']) )         $Contrato_Nombre           = $_POST['Contrato_Nombre'];
	if ( !empty($_POST['Contrato_Numero']) )         $Contrato_Numero           = $_POST['Contrato_Numero'];
	if ( !empty($_POST['Contrato_Fecha_Ini']) )      $Contrato_Fecha_Ini        = $_POST['Contrato_Fecha_Ini'];
	if ( !empty($_POST['Contrato_Fecha_Term']) )     $Contrato_Fecha_Term       = $_POST['Contrato_Fecha_Term'];
	if ( !empty($_POST['Contrato_Valor_Mensual']) )  $Contrato_Valor_Mensual    = $_POST['Contrato_Valor_Mensual'];
	if ( !empty($_POST['Contrato_Valor_Anual']) )    $Contrato_Valor_Anual      = $_POST['Contrato_Valor_Anual'];
	if ( !empty($_POST['Contrato_Obs']) )            $Contrato_Obs              = $_POST['Contrato_Obs'];
	
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
			case 'idProspecto':              if(empty($idProspecto)){              $error['idProspecto']               = 'error/No ha ingresado el id';}break;
			case 'idSistema':                if(empty($idSistema)){                $error['idSistema']                 = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':                 if(empty($idEstado)){                 $error['idEstado']                  = 'error/No ha seleccionado el Estado';}break;
			case 'idTipo':                   if(empty($idTipo)){                   $error['idTipo']                    = 'error/No ha seleccionado el tipo de prospecto';}break;
			case 'idRubro':                  if(empty($idRubro)){                  $error['idRubro']                   = 'error/No ha seleccionado el rubro';}break;
			case 'email':                    if(empty($email)){                    $error['email']                     = 'error/No ha ingresado el email';}break;
			case 'Nombre':                   if(empty($Nombre)){                   $error['Nombre']                    = 'error/No ha ingresado el Nombre de Fantasia';}break;
			case 'RazonSocial':              if(empty($RazonSocial)){              $error['RazonSocial']               = 'error/No ha ingresado la Razon Social';}break;
			case 'Rut':                      if(empty($Rut)){                      $error['Rut']                       = 'error/No ha ingresado el Rut';}break;	
			case 'fNacimiento':              if(empty($fNacimiento)){              $error['fNacimiento']               = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'Direccion':                if(empty($Direccion)){                $error['Direccion']                 = 'error/No ha ingresado la direccion';}break;
			case 'Fono1':                    if(empty($Fono1)){                    $error['Fono1']                     = 'error/No ha ingresado el telefono';}break;
			case 'Fono2':                    if(empty($Fono2)){                    $error['Fono2']                     = 'error/No ha ingresado el telefono';}break;
			case 'idCiudad':                 if(empty($idCiudad)){                 $error['idCiudad']                  = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':                 if(empty($idComuna)){                 $error['idComuna']                  = 'error/No ha seleccionado la comuna';}break;
			case 'Fax':                      if(empty($Fax)){                      $error['Fax']                       = 'error/No ha ingresado el fax';}break;
			case 'PersonaContacto':          if(empty($PersonaContacto)){          $error['PersonaContacto']           = 'error/No ha ingresado el nombre de la persona de contacto';}break;
			case 'PersonaContacto_Fono':     if(empty($PersonaContacto_Fono)){     $error['PersonaContacto_Fono']      = 'error/No ha ingresado el Fono de la persona de contacto';}break;
			case 'PersonaContacto_email':    if(empty($PersonaContacto_email)){    $error['PersonaContacto_email']     = 'error/No ha ingresado el Email de la persona de contacto';}break;
			case 'PersonaContacto_Cargo':    if(empty($PersonaContacto_Cargo)){    $error['PersonaContacto_Cargo']     = 'error/No ha ingresado el Cargo de la persona de contacto';}break;
			case 'Web':                      if(empty($Web)){                      $error['Web']                       = 'error/No ha ingresado la pagina web';}break;
			case 'Giro':                     if(empty($Giro)){                     $error['Giro']                      = 'error/No ha ingresado el Giro de la empresa';}break;
			case 'F_Ingreso':                if(empty($F_Ingreso)){                $error['F_Ingreso']                 = 'error/No ha ingresado la fecha de ingreso';}break;
			case 'idUsuario':                if(empty($idUsuario)){                $error['idUsuario']                 = 'error/No ha seleccionado al usuario';}break;
			case 'idEstadoFidelizacion':     if(empty($idEstadoFidelizacion)){     $error['idEstadoFidelizacion']      = 'error/No ha seleccionado el estado de la fidelizacion';}break;
			case 'idEtapa':                  if(empty($idEtapa)){                  $error['idEtapa']                   = 'error/No ha seleccionado la etapa de la fidelizacion';}break;
			case 'FModificacion':            if(empty($FModificacion)){            $error['FModificacion']             = 'error/No ha ingresado la fecha de modificacion';}break;
			case 'HModificacion':            if(empty($HModificacion)){            $error['HModificacion']             = 'error/No ha ingresado la hora de modificacion';}break;
			case 'idUsuarioMod':             if(empty($idUsuarioMod)){             $error['idUsuarioMod']              = 'error/No ha ingresado el usuario de la modificacion';}break;
			case 'idTab_1':                  if(empty($idTab_1)){                  $error['idTab_1']                   = 'error/No ha seleccionado la Unidad de Negocio 1';}break;
			case 'idTab_2':                  if(empty($idTab_2)){                  $error['idTab_2']                   = 'error/No ha seleccionado la Unidad de Negocio 2';}break;
			case 'idTab_3':                  if(empty($idTab_3)){                  $error['idTab_3']                   = 'error/No ha seleccionado la Unidad de Negocio 3';}break;
			case 'idTab_4':                  if(empty($idTab_4)){                  $error['idTab_4']                   = 'error/No ha seleccionado la Unidad de Negocio 4';}break;
			case 'idTab_5':                  if(empty($idTab_5)){                  $error['idTab_5']                   = 'error/No ha seleccionado la Unidad de Negocio 5';}break;
			case 'idTab_6':                  if(empty($idTab_6)){                  $error['idTab_6']                   = 'error/No ha seleccionado la Unidad de Negocio 6';}break;
			case 'idTab_7':                  if(empty($idTab_7)){                  $error['idTab_7']                   = 'error/No ha seleccionado la Unidad de Negocio 7';}break;
			case 'idTab_8':                  if(empty($idTab_8)){                  $error['idTab_8']                   = 'error/No ha seleccionado la Unidad de Negocio 8';}break;
			case 'idTab_9':                  if(empty($idTab_9)){                  $error['idTab_9']                   = 'error/No ha seleccionado la unidad de negocio 9';}break;
			case 'idTab_10':                 if(empty($idTab_10)){                 $error['idTab_10']                  = 'error/No ha seleccionado la unidad de negocio 10';}break;
			case 'idTab_11':                 if(empty($idTab_11)){                 $error['idTab_11']                  = 'error/No ha seleccionado la unidad de negocio 11';}break;
			case 'idTab_12':                 if(empty($idTab_12)){                 $error['idTab_12']                  = 'error/No ha seleccionado la unidad de negocio 12';}break;
			case 'idTab_13':                 if(empty($idTab_13)){                 $error['idTab_13']                  = 'error/No ha seleccionado la unidad de negocio 13';}break;
			case 'idTab_14':                 if(empty($idTab_14)){                 $error['idTab_14']                  = 'error/No ha seleccionado la unidad de negocio 14';}break;
			case 'idTab_15':                 if(empty($idTab_15)){                 $error['idTab_15']                  = 'error/No ha seleccionado la unidad de negocio 15';}break;
			
	
			case 'Contrato_Nombre':          if(empty($Contrato_Nombre)){          $error['Contrato_Nombre']           = 'error/No ha ingresado el nombre del contrato';}break;
			case 'Contrato_Numero':          if(empty($Contrato_Numero)){          $error['Contrato_Numero']           = 'error/No ha ingresado el numero o codigo del contrato';}break;
			case 'Contrato_Fecha_Ini':       if(empty($Contrato_Fecha_Ini)){       $error['Contrato_Fecha_Ini']        = 'error/No ha ingresado la fecha de inicio del contrato';}break;
			case 'Contrato_Fecha_Term':      if(empty($Contrato_Fecha_Term)){      $error['Contrato_Fecha_Term']       = 'error/No ha ingresado la fecha de termino del contrato';}break;
			case 'Contrato_Valor_Mensual':   if(empty($Contrato_Valor_Mensual)){   $error['Contrato_Valor_Mensual']    = 'error/No ha ingresado el valor mensual del contrato';}break;
			case 'Contrato_Valor_Anual':     if(empty($Contrato_Valor_Anual)){     $error['Contrato_Valor_Anual']      = 'error/No ha ingresado el valor anual del contrato';}break;
			case 'Contrato_Obs':             if(empty($Contrato_Obs)){             $error['Contrato_Obs']              = 'error/No ha ingresado las observaciones del contrato';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($email)&&contar_palabras_censuradas($email)!=0){                                  $error['email']                 = 'error/Edita email, contiene palabras no permitidas'; }	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                                $error['Nombre']                = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($RazonSocial)&&contar_palabras_censuradas($RazonSocial)!=0){                      $error['RazonSocial']           = 'error/Edita la Razon Social, contiene palabras no permitidas'; }	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){                          $error['Direccion']             = 'error/Edita la Direccion, contiene palabras no permitidas'; }	
	if(isset($PersonaContacto)&&contar_palabras_censuradas($PersonaContacto)!=0){              $error['PersonaContacto']       = 'error/Edita la Persona de Contacto, contiene palabras no permitidas'; }	
	if(isset($PersonaContacto_email)&&contar_palabras_censuradas($PersonaContacto_email)!=0){  $error['PersonaContacto_email'] = 'error/Edita la Persona de Contacto email, contiene palabras no permitidas'; }	
	if(isset($PersonaContacto_Cargo)&&contar_palabras_censuradas($PersonaContacto_Cargo)!=0){  $error['PersonaContacto_Cargo'] = 'error/Edita Persona de Contacto Cargo, contiene palabras no permitidas'; }	
	if(isset($Web)&&contar_palabras_censuradas($Web)!=0){                                      $error['Web']                   = 'error/Edita la Web, contiene palabras no permitidas'; }	
	if(isset($Giro)&&contar_palabras_censuradas($Giro)!=0){                                    $error['Giro']                  = 'error/Edita Giro, contiene palabras no permitidas'; }	
	if(isset($Contrato_Nombre)&&contar_palabras_censuradas($Contrato_Nombre)!=0){              $error['Contrato_Nombre']       = 'error/Edita el nombre del contrato, contiene palabras no permitidas'; }	
	if(isset($Contrato_Numero)&&contar_palabras_censuradas($Contrato_Numero)!=0){              $error['Contrato_Numero']       = 'error/Edita el numero de contrato, contiene palabras no permitidas'; }	
	if(isset($Contrato_Obs)&&contar_palabras_censuradas($Contrato_Obs)!=0){                    $error['Contrato_Obs']          = 'error/Edita la observacion del contrato, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email)&&!validarEmail($email)){                                 $error['email']                  = 'error/El Email ingresado no es valido'; }	
	if(isset($Fono1)&&!validarNumero($Fono1)) {                               $error['Fono1']                  = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Fono2)&&!validarNumero($Fono2)) {                               $error['Fono2']                  = 'error/Ingrese un numero telefonico valido'; }
	if(isset($Rut)&&!validarRut($Rut)){                                       $error['Rut']                    = 'error/El Rut ingresado no es valido'; }
	if(isset($PersonaContacto_email)&&!validarEmail($PersonaContacto_email)){ $error['email']                  = 'error/El Email ingresado no es valido'; }	
	if(isset($PersonaContacto_Fono)&&!validarNumero($PersonaContacto_Fono)) { $error['PersonaContacto_Fono']   = 'error/Ingrese un numero telefonico valido'; }
	
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
				$ndata_1 = db_select_nrows (false, 'Nombre', 'prospectos_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'prospectos_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)){
				$ndata_3 = db_select_nrows (false, 'email', 'prospectos_listado', '', "email='".$email."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                           $a  = "'".$idSistema."'" ;               }else{$a ="''";}
				if(isset($idEstado) && $idEstado != ''){                             $a .= ",'".$idEstado."'" ;               }else{$a .= ",''";}
				if(isset($idTipo) && $idTipo != ''){                                 $a .= ",'".$idTipo."'" ;                 }else{$a .= ",''";}
				if(isset($idRubro) && $idRubro != ''){                               $a .= ",'".$idRubro."'" ;                }else{$a .= ",''";}
				if(isset($email) && $email != ''){                                   $a .= ",'".$email."'" ;                  }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",'".$Nombre."'" ;                 }else{$a .= ",''";}
				if(isset($RazonSocial) && $RazonSocial != ''){                       $a .= ",'".$RazonSocial."'" ;            }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                                       $a .= ",'".$Rut."'" ;                    }else{$a .= ",''";}
				if(isset($fNacimiento) && $fNacimiento != ''){                       $a .= ",'".$fNacimiento."'" ;            }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                           $a .= ",'".$Direccion."'" ;              }else{$a .= ",''";}
				if(isset($Fono1) && $Fono1 != ''){                                   $a .= ",'".$Fono1."'" ;                  }else{$a .= ",''";}
				if(isset($Fono2) && $Fono2 != ''){                                   $a .= ",'".$Fono2."'" ;                  }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                             $a .= ",'".$idCiudad."'" ;               }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                             $a .= ",'".$idComuna."'" ;               }else{$a .= ",''";}
				if(isset($Fax) && $Fax != ''){                                       $a .= ",'".$Fax."'" ;                    }else{$a .= ",''";}
				if(isset($PersonaContacto) && $PersonaContacto != ''){               $a .= ",'".$PersonaContacto."'" ;        }else{$a .= ",''";}
				if(isset($PersonaContacto_Fono) && $PersonaContacto_Fono != ''){     $a .= ",'".$PersonaContacto_Fono."'" ;   }else{$a .= ",''";}
				if(isset($PersonaContacto_email) && $PersonaContacto_email != ''){   $a .= ",'".$PersonaContacto_email."'" ;  }else{$a .= ",''";}
				if(isset($PersonaContacto_Cargo) && $PersonaContacto_Cargo != ''){   $a .= ",'".$PersonaContacto_Cargo."'" ;  }else{$a .= ",''";}
				if(isset($Web) && $Web != ''){                                       $a .= ",'".$Web."'" ;                    }else{$a .= ",''";}
				if(isset($Giro) && $Giro != ''){                                     $a .= ",'".$Giro."'" ;                   }else{$a .= ",''";}
				if(isset($F_Ingreso) && $F_Ingreso != ''){                           $a .= ",'".$F_Ingreso."'" ;              }else{$a .= ",''";}
				if(isset($idUsuario) && $idUsuario != ''){                           $a .= ",'".$idUsuario."'" ;              }else{$a .= ",''";}
				if(isset($idEstadoFidelizacion) && $idEstadoFidelizacion != ''){     $a .= ",'".$idEstadoFidelizacion."'" ;   }else{$a .= ",''";}
				if(isset($idEtapa) && $idEtapa != ''){                               $a .= ",'".$idEtapa."'" ;                }else{$a .= ",''";}
				if(isset($FModificacion) && $FModificacion != ''){                   $a .= ",'".$FModificacion."'" ;          }else{$a .= ",''";}
				if(isset($HModificacion) && $HModificacion != ''){                   $a .= ",'".$HModificacion."'" ;          }else{$a .= ",''";}
				if(isset($idUsuarioMod) && $idUsuarioMod != ''){                     $a .= ",'".$idUsuarioMod."'" ;           }else{$a .= ",''";}
				if(isset($idTab_1) && $idTab_1 != ''){                               $a .= ",'".$idTab_1."'" ;                }else{$a .= ",''";}
				if(isset($idTab_2) && $idTab_2 != ''){                               $a .= ",'".$idTab_2."'" ;                }else{$a .= ",''";}
				if(isset($idTab_3) && $idTab_3 != ''){                               $a .= ",'".$idTab_3."'" ;                }else{$a .= ",''";}
				if(isset($idTab_4) && $idTab_4 != ''){                               $a .= ",'".$idTab_4."'" ;                }else{$a .= ",''";}
				if(isset($idTab_5) && $idTab_5 != ''){                               $a .= ",'".$idTab_5."'" ;                }else{$a .= ",''";}
				if(isset($idTab_6) && $idTab_6 != ''){                               $a .= ",'".$idTab_6."'" ;                }else{$a .= ",''";}
				if(isset($idTab_7) && $idTab_7 != ''){                               $a .= ",'".$idTab_7."'" ;                }else{$a .= ",''";}
				if(isset($idTab_8) && $idTab_8 != ''){                               $a .= ",'".$idTab_8."'" ;                }else{$a .= ",''";}
				if(isset($idTab_9) && $idTab_9 != ''){                               $a .= ",'".$idTab_9."'" ;                }else{$a .= ",''";}
				if(isset($idTab_10) && $idTab_10 != ''){                             $a .= ",'".$idTab_10."'" ;               }else{$a .= ",''";}
				if(isset($idTab_11) && $idTab_11 != ''){                             $a .= ",'".$idTab_11."'" ;               }else{$a .= ",''";}
				if(isset($idTab_12) && $idTab_12 != ''){                             $a .= ",'".$idTab_12."'" ;               }else{$a .= ",''";}
				if(isset($idTab_13) && $idTab_13 != ''){                             $a .= ",'".$idTab_13."'" ;               }else{$a .= ",''";}
				if(isset($idTab_14) && $idTab_14 != ''){                             $a .= ",'".$idTab_14."'" ;               }else{$a .= ",''";}
				if(isset($idTab_15) && $idTab_15 != ''){                             $a .= ",'".$idTab_15."'" ;               }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `prospectos_listado` (idSistema, idEstado, idTipo, idRubro, email, Nombre,
				RazonSocial, Rut, fNacimiento, Direccion, Fono1, Fono2, idCiudad, idComuna, Fax, PersonaContacto,
				PersonaContacto_Fono, PersonaContacto_email, PersonaContacto_Cargo, Web, Giro, F_Ingreso, idUsuario, 
				idEstadoFidelizacion, idEtapa, FModificacion, HModificacion, idUsuarioMod, idTab_1, idTab_2, idTab_3, 
				idTab_4, idTab_5, idTab_6, idTab_7, idTab_8, idTab_9, idTab_10, idTab_11, idTab_12, idTab_13, 
				idTab_14, idTab_15) 
				VALUES (".$a.")";
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
			if(isset($Nombre)&&isset($idSistema)&&isset($idProspecto)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'prospectos_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idProspecto!='".$idProspecto."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idProspecto)){
				$ndata_2 = db_select_nrows (false, 'Rut', 'prospectos_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idProspecto!='".$idProspecto."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			if(isset($email)&&isset($idSistema)&&isset($idProspecto)){
				$ndata_3 = db_select_nrows (false, 'email', 'prospectos_listado', '', "email='".$email."' AND idSistema='".$idSistema."' AND idProspecto!='".$idProspecto."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El nombre de la persona ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			if($ndata_3 > 0) {$error['ndata_3'] = 'error/El correo de ingresado ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idProspecto='".$idProspecto."'" ;
				if(isset($idSistema) && $idSistema != ''){                           $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                             $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($idTipo) && $idTipo != ''){                                 $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idRubro) && $idRubro != ''){                               $a .= ",idRubro='".$idRubro."'" ;}
				if(isset($email) && $email != ''){                                   $a .= ",email='".$email."'" ;}
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($RazonSocial) && $RazonSocial != ''){                       $a .= ",RazonSocial='".$RazonSocial."'" ;}
				if(isset($Rut) && $Rut != ''){                                       $a .= ",Rut='".$Rut."'" ;}
				if(isset($fNacimiento) && $fNacimiento != ''){                       $a .= ",fNacimiento='".$fNacimiento."'" ;}
				if(isset($Direccion) && $Direccion != ''){                           $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Fono1) && $Fono1 != ''){                                   $a .= ",Fono1='".$Fono1."'" ;}
				if(isset($Fono2) && $Fono2 != ''){                                   $a .= ",Fono2='".$Fono2."'" ;}
				if(isset($idCiudad) && $idCiudad!= ''){                              $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna!= ''){                              $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Fax) && $Fax!= ''){                                        $a .= ",Fax='".$Fax."'" ;}
				if(isset($PersonaContacto) && $PersonaContacto!= ''){                $a .= ",PersonaContacto='".$PersonaContacto."'" ;}
				if(isset($PersonaContacto_Fono) && $PersonaContacto_Fono!= ''){      $a .= ",PersonaContacto_Fono='".$PersonaContacto_Fono."'" ;}
				if(isset($PersonaContacto_email) && $PersonaContacto_email!= ''){    $a .= ",PersonaContacto_email='".$PersonaContacto_email."'" ;}
				if(isset($PersonaContacto_Cargo) && $PersonaContacto_Cargo!= ''){    $a .= ",PersonaContacto_Cargo='".$PersonaContacto_Cargo."'" ;}
				if(isset($Web) && $Web!= ''){                                        $a .= ",Web='".$Web."'" ;}
				if(isset($Giro) && $Giro!= ''){                                      $a .= ",Giro='".$Giro."'" ;}
				if(isset($F_Ingreso) && $F_Ingreso!= ''){                            $a .= ",F_Ingreso='".$F_Ingreso."'" ;}
				if(isset($idUsuario) && $idUsuario!= ''){                            $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($idEstadoFidelizacion) && $idEstadoFidelizacion!= ''){      $a .= ",idEstadoFidelizacion='".$idEstadoFidelizacion."'" ;}
				if(isset($idEtapa) && $idEtapa!= ''){                                $a .= ",idEtapa='".$idEtapa."'" ;}
				if(isset($FModificacion) && $FModificacion!= ''){                    $a .= ",FModificacion='".$FModificacion."'" ;}
				if(isset($HModificacion) && $HModificacion!= ''){                    $a .= ",HModificacion='".$HModificacion."'" ;}
				if(isset($idUsuarioMod) && $idUsuarioMod!= ''){                      $a .= ",idUsuarioMod='".$idUsuarioMod."'" ;}
				if(isset($idTab_1) && $idTab_1!= ''){                                $a .= ",idTab_1='".$idTab_1."'" ;}
				if(isset($idTab_2) && $idTab_2!= ''){                                $a .= ",idTab_2='".$idTab_2."'" ;}
				if(isset($idTab_3) && $idTab_3!= ''){                                $a .= ",idTab_3='".$idTab_3."'" ;}
				if(isset($idTab_4) && $idTab_4!= ''){                                $a .= ",idTab_4='".$idTab_4."'" ;}
				if(isset($idTab_5) && $idTab_5!= ''){                                $a .= ",idTab_5='".$idTab_5."'" ;}
				if(isset($idTab_6) && $idTab_6!= ''){                                $a .= ",idTab_6='".$idTab_6."'" ;}
				if(isset($idTab_7) && $idTab_7!= ''){                                $a .= ",idTab_7='".$idTab_7."'" ;}
				if(isset($idTab_8) && $idTab_8!= ''){                                $a .= ",idTab_8='".$idTab_8."'" ;}
				if(isset($idTab_9) && $idTab_9!= ''){                                $a .= ",idTab_9='".$idTab_9."'" ;}
				if(isset($idTab_10) && $idTab_10!= ''){                              $a .= ",idTab_10='".$idTab_10."'" ;}
				if(isset($idTab_11) && $idTab_11!= ''){                              $a .= ",idTab_11='".$idTab_11."'" ;}
				if(isset($idTab_12) && $idTab_12!= ''){                              $a .= ",idTab_12='".$idTab_12."'" ;}
				if(isset($idTab_13) && $idTab_13!= ''){                              $a .= ",idTab_13='".$idTab_13."'" ;}
				if(isset($idTab_14) && $idTab_14!= ''){                              $a .= ",idTab_14='".$idTab_14."'" ;}
				if(isset($idTab_15) && $idTab_15!= ''){                              $a .= ",idTab_15='".$idTab_15."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'prospectos_listado', 'idProspecto = "'.$idProspecto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'prospectos_listado', 'idProspecto = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
			
			$idProspecto    = $_GET['id'];
			$idEstado       = simpleDecode($_GET['estado'], fecha_actual());
			$FModificacion  = fecha_actual();
			$HModificacion  = hora_actual();
			$idUsuarioMod   = $_SESSION['usuario']['basic_data']['idUsuario'];
			
			/*******************************************************/
			//se actualizan los datos
			$a  = "idEstado='".$idEstado."'" ;
			$a .= ",FModificacion='".$FModificacion."'" ;
			$a .= ",HModificacion='".$HModificacion."'" ;
			$a .= ",idUsuarioMod='".$idUsuarioMod."'" ;
			$resultado = db_update_data (false, $a, 'prospectos_listado', 'idProspecto = "'.$idProspecto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
			

		break;	
/*******************************************************************************************************************/
		case 'crear_cliente':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************/
			//Obtengo  los datos
			$squery = 'idEtapa';
			$rowEtapa = db_select_data (false, $squery, 'prospectos_etapa', '', 'idEtapa!=0 ORDER BY Nombre DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			$squery = 'idSistema,idTipo,idRubro,email,Nombre,RazonSocial,Rut,fNacimiento,Direccion,Fono1,Fono2,idCiudad,idComuna,Fax,PersonaContacto,PersonaContacto_Fono,PersonaContacto_email,PersonaContacto_Cargo,Web,Giro,idTab_1,idTab_2,idTab_3,idTab_4,idTab_5,idTab_6,idTab_7,idTab_8,idTab_9,idTab_10,idTab_11,idTab_12,idTab_13,idTab_14,idTab_15';
			$rowProspecto = db_select_data (false, $squery, 'prospectos_listado', '', 'idProspecto='.$idProspecto, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			//verifico si cliente existe
			$ndata_1 = 0;
			if(isset($rowProspecto['Rut'])&&isset($rowProspecto['idSistema'])){
				$ndata_1    = db_select_nrows (false, 'Rut', 'clientes_listado', '', "Rut='".$rowProspecto['Rut']."' AND idSistema='".$rowProspecto['idSistema']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$rowCliente = db_select_data (false, 'idCliente', 'clientes_listado', '', "Rut='".$rowProspecto['Rut']."' AND idSistema='".$rowProspecto['idSistema']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/*******************************************************/
				//Verifico que exista la etapa
				if(isset($rowEtapa['idEtapa']) && $rowEtapa['idEtapa'] != ''){
					
					//variables
					$FModificacion  = fecha_actual();
					$HModificacion  = hora_actual();
					$idUsuarioMod   = $_SESSION['usuario']['basic_data']['idUsuario'];
			
					/*******************************************************/
					//Actualizo el prospecto
					$a  = "idProspecto='".$idProspecto."'" ;
					$a .= ",idEstado='2'" ;                         //Se desactiva prospecto
					$a .= ",idEtapa='".$rowEtapa['idEtapa']."'" ;   //se cambia a etapa de cierre
					$a .= ",FModificacion='".$FModificacion."'" ;   //se cambia la fecha de modificacion
					$a .= ",HModificacion='".$HModificacion."'" ;   //se cambia la hora de modificacion
					$a .= ",idUsuarioMod='".$idUsuarioMod."'" ;     //se cambia el usuario de modificacion
					
					//se actualizan los datos
					$resultado = db_update_data (false, $a, 'prospectos_listado', 'idProspecto = "'.$idProspecto.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
					/*******************************************************/
					//verifico si existe el cliente
					/*******************************************/
					//variables
					$idEstado    = 1;
					$password    = 1234;
					$new_folder  = 1;
					$fNacimiento = fecha_actual();
						
					//se actualiza al cliente
					if($ndata_1!=0){
						//Filtros
						
						$a = "idCliente='".$rowCliente['idCliente']."'" ;
						if(isset($rowProspecto['idSistema']) && $rowProspecto['idSistema'] != ''){                               $a .= ",idSistema='".$rowProspecto['idSistema']."'" ;}
						if(isset($rowProspecto['idTipo']) && $rowProspecto['idTipo'] != ''){                                     $a .= ",idTipo='".$rowProspecto['idTipo']."'" ;}
						if(isset($rowProspecto['idRubro']) && $rowProspecto['idRubro'] != ''){                                   $a .= ",idRubro='".$rowProspecto['idRubro']."'" ;}
						if(isset($rowProspecto['email']) && $rowProspecto['email'] != ''){                                       $a .= ",email='".$rowProspecto['email']."'" ;}
						if(isset($rowProspecto['Nombre']) && $rowProspecto['Nombre'] != ''){                                     $a .= ",Nombre='".$rowProspecto['Nombre']."'" ;}
						if(isset($rowProspecto['RazonSocial']) && $rowProspecto['RazonSocial'] != ''){                           $a .= ",RazonSocial='".$rowProspecto['RazonSocial']."'" ;}
						if(isset($rowProspecto['Rut']) && $rowProspecto['Rut'] != ''){                                           $a .= ",Rut='".$rowProspecto['Rut']."'" ;}
						if(isset($fNacimiento) && $fNacimiento != ''){                                                           $a .= ",fNacimiento='".$fNacimiento."'" ;}
						if(isset($rowProspecto['Direccion']) && $rowProspecto['Direccion'] != ''){                               $a .= ",Direccion='".$rowProspecto['Direccion']."'" ;}
						if(isset($rowProspecto['Fono1']) && $rowProspecto['Fono1'] != ''){                                       $a .= ",Fono1='".$rowProspecto['Fono1']."'" ;}
						if(isset($rowProspecto['Fono2']) && $rowProspecto['Fono2'] != ''){                                       $a .= ",Fono2='".$rowProspecto['Fono2']."'" ;}
						if(isset($rowProspecto['idCiudad']) && $rowProspecto['idCiudad']!= ''){                                  $a .= ",idCiudad='".$rowProspecto['idCiudad']."'" ;}
						if(isset($rowProspecto['idComuna']) && $rowProspecto['idComuna']!= ''){                                  $a .= ",idComuna='".$rowProspecto['idComuna']."'" ;}
						if(isset($rowProspecto['Fax']) && $rowProspecto['Fax']!= ''){                                            $a .= ",Fax='".$rowProspecto['Fax']."'" ;}
						if(isset($rowProspecto['PersonaContacto']) && $rowProspecto['PersonaContacto']!= ''){                    $a .= ",PersonaContacto='".$rowProspecto['PersonaContacto']."'" ;}
						if(isset($rowProspecto['PersonaContacto_Fono']) && $rowProspecto['PersonaContacto_Fono']!= ''){          $a .= ",PersonaContacto_Fono='".$rowProspecto['PersonaContacto_Fono']."'" ;}
						if(isset($rowProspecto['PersonaContacto_email']) && $rowProspecto['PersonaContacto_email']!= ''){        $a .= ",PersonaContacto_email='".$rowProspecto['PersonaContacto_email']."'" ;}
						if(isset($rowProspecto['PersonaContacto_Cargo']) && $rowProspecto['PersonaContacto_Cargo']!= ''){        $a .= ",PersonaContacto_Cargo='".$rowProspecto['PersonaContacto_Cargo']."'" ;}
						if(isset($rowProspecto['Web']) && $rowProspecto['Web']!= ''){                                            $a .= ",Web='".$rowProspecto['Web']."'" ;}
						if(isset($rowProspecto['Giro']) && $rowProspecto['Giro']!= ''){                                          $a .= ",Giro='".$rowProspecto['Giro']."'" ;}
						if(isset($rowProspecto['idTab_1']) && $rowProspecto['idTab_1']!= ''){                                    $a .= ",idTab_1='".$rowProspecto['idTab_1']."'" ;}
						if(isset($rowProspecto['idTab_2']) && $rowProspecto['idTab_2']!= ''){                                    $a .= ",idTab_2='".$rowProspecto['idTab_2']."'" ;}
						if(isset($rowProspecto['idTab_3']) && $rowProspecto['idTab_3']!= ''){                                    $a .= ",idTab_3='".$rowProspecto['idTab_3']."'" ;}
						if(isset($rowProspecto['idTab_4']) && $rowProspecto['idTab_4']!= ''){                                    $a .= ",idTab_4='".$rowProspecto['idTab_4']."'" ;}
						if(isset($rowProspecto['idTab_5']) && $rowProspecto['idTab_5']!= ''){                                    $a .= ",idTab_5='".$rowProspecto['idTab_5']."'" ;}
						if(isset($rowProspecto['idTab_6']) && $rowProspecto['idTab_6']!= ''){                                    $a .= ",idTab_6='".$rowProspecto['idTab_6']."'" ;}
						if(isset($rowProspecto['idTab_7']) && $rowProspecto['idTab_7']!= ''){                                    $a .= ",idTab_7='".$rowProspecto['idTab_7']."'" ;}
						if(isset($rowProspecto['idTab_8']) && $rowProspecto['idTab_8']!= ''){                                    $a .= ",idTab_8='".$rowProspecto['idTab_8']."'" ;}
						if(isset($rowProspecto['idTab_9']) && $rowProspecto['idTab_9']!= ''){                                    $a .= ",idTab_9='".$rowProspecto['idTab_9']."'" ;}
						if(isset($rowProspecto['idTab_10']) && $rowProspecto['idTab_10']!= ''){                                  $a .= ",idTab_10='".$rowProspecto['idTab_10']."'" ;}
						if(isset($rowProspecto['idTab_11']) && $rowProspecto['idTab_11']!= ''){                                  $a .= ",idTab_11='".$rowProspecto['idTab_11']."'" ;}
						if(isset($rowProspecto['idTab_12']) && $rowProspecto['idTab_12']!= ''){                                  $a .= ",idTab_12='".$rowProspecto['idTab_12']."'" ;}
						if(isset($rowProspecto['idTab_13']) && $rowProspecto['idTab_13']!= ''){                                  $a .= ",idTab_13='".$rowProspecto['idTab_13']."'" ;}
						if(isset($rowProspecto['idTab_14']) && $rowProspecto['idTab_14']!= ''){                                  $a .= ",idTab_14='".$rowProspecto['idTab_14']."'" ;}
						if(isset($rowProspecto['idTab_15']) && $rowProspecto['idTab_15']!= ''){                                  $a .= ",idTab_15='".$rowProspecto['idTab_15']."'" ;}
						
						if(isset($Contrato_Nombre) && $Contrato_Nombre!= ''){                                                    $a .= ",Contrato_Nombre='".$Contrato_Nombre."'" ;}
						if(isset($Contrato_Numero) && $Contrato_Numero!= ''){                                                    $a .= ",Contrato_Numero='".$Contrato_Numero."'" ;}
						if(isset($Contrato_Fecha_Ini) && $Contrato_Fecha_Ini!= ''){                                              $a .= ",Contrato_Fecha_Ini='".$Contrato_Fecha_Ini."'" ;}
						if(isset($Contrato_Fecha_Term) && $Contrato_Fecha_Term!= ''){                                            $a .= ",Contrato_Fecha_Term='".$Contrato_Fecha_Term."'" ;}
						if(isset($Contrato_Valor_Mensual) && $Contrato_Valor_Mensual!= ''){                                      $a .= ",Contrato_Valor_Mensual='".$Contrato_Valor_Mensual."'" ;}
						if(isset($Contrato_Valor_Anual) && $Contrato_Valor_Anual!= ''){                                          $a .= ",Contrato_Valor_Anual='".$Contrato_Valor_Anual."'" ;}
						if(isset($Contrato_Obs) && $Contrato_Obs!= ''){                                                          $a .= ",Contrato_Obs='".$Contrato_Obs."'" ;}
						$a .= ",idEstado='".$idEstado."'";
						$a .= ",password='".md5($password)."'";
						
						/*******************************************************/
						//se actualizan los datos
						$resultado = db_update_data (false, $a, 'clientes_listado', 'idCliente = "'.$rowCliente['idCliente'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
						//Si ejecuto correctamente la consulta
						if($resultado==true){
							
							//Se crea la carpeta del cliente
							if(isset($new_folder)&&$new_folder!=''&&$new_folder==1){
								//verifico que exista el rut
								if(isset($rowProspecto['Rut'])&&$rowProspecto['Rut']!=''){
									$Rut = $rowProspecto['Rut'];
									$Rut = str_replace(' ', '', $Rut);//elimino espacios
									$Rut = str_replace('-', '', $Rut);//elimino los guiones
									$Rut = str_replace('.', '', $Rut);//elimino los puntos
									$ruta = "ClientFiles/_public/Cliente_".$Rut;
									//si no existe la carpeta
									if (!file_exists($ruta)) {
										try {
											$oldmask = umask(000);//it will set the new umask and returns the old one 
											mkdir($ruta, 0777);
											umask($oldmask);//reset the old umask
											//redirijo
											header( 'Location: '.$location.'&id='.$rowCliente['idCliente'].'&created=true' );
											die;
										} catch (Exception $e) {
											//echo 'Excepción capturada: ',  $e->getMessage(), "\n";
											$error['ndata_1'] = 'error/'.$e->getMessage();
										}
									//si existe carpeta se devuelve error	
									}else{
										//$error['ndata_1'] = 'error/La carpeta del cliente ya existe';
									}
								//si no existe el rut
								}else{
									$error['ndata_1'] = 'error/El cliente debe tener un rut valido ingresado para poder crear la carpeta';
								}
								
							}else{
								//redirijo
								header( 'Location: '.$location.'&edited=true' );
								die;
							}
							
						//si da error, guardar en el log de errores una copia
						}else{
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
							
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
							
						}
					/*******************************************/
					//se crea uno nuevo	
					}else{
						
						//filtros
						if(isset($rowProspecto['idSistema']) && $rowProspecto['idSistema'] != ''){                             $a  = "'".$rowProspecto['idSistema']."'" ;                 }else{$a  = "''";}
						if(isset($rowProspecto['idTipo']) && $rowProspecto['idTipo'] != ''){                                   $a .= ",'".$rowProspecto['idTipo']."'" ;                   }else{$a .= ",''";}
						if(isset($rowProspecto['idRubro']) && $rowProspecto['idRubro'] != ''){                                 $a .= ",'".$rowProspecto['idRubro']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['email']) && $rowProspecto['email'] != ''){                                     $a .= ",'".$rowProspecto['email']."'" ;                    }else{$a .= ",''";}
						if(isset($rowProspecto['Nombre']) && $rowProspecto['Nombre'] != ''){                                   $a .= ",'".$rowProspecto['Nombre']."'" ;                   }else{$a .= ",''";}
						if(isset($rowProspecto['RazonSocial']) && $rowProspecto['RazonSocial'] != ''){                         $a .= ",'".$rowProspecto['RazonSocial']."'" ;              }else{$a .= ",''";}
						if(isset($rowProspecto['Rut']) && $rowProspecto['Rut'] != ''){                                         $a .= ",'".$rowProspecto['Rut']."'" ;                      }else{$a .= ",''";}
						if(isset($fNacimiento) && $fNacimiento != ''){                                                         $a .= ",'".$fNacimiento."'" ;                              }else{$a .= ",''";}
						if(isset($rowProspecto['Direccion']) && $rowProspecto['Direccion'] != ''){                             $a .= ",'".$rowProspecto['Direccion']."'" ;                }else{$a .= ",''";}
						if(isset($rowProspecto['Fono1']) && $rowProspecto['Fono1'] != ''){                                     $a .= ",'".$rowProspecto['Fono1']."'" ;                    }else{$a .= ",''";}
						if(isset($rowProspecto['Fono2']) && $rowProspecto['Fono2'] != ''){                                     $a .= ",'".$rowProspecto['Fono2']."'" ;                    }else{$a .= ",''";}
						if(isset($rowProspecto['idCiudad']) && $rowProspecto['idCiudad'] != ''){                               $a .= ",'".$rowProspecto['idCiudad']."'" ;                 }else{$a .= ",''";}
						if(isset($rowProspecto['idComuna']) && $rowProspecto['idComuna'] != ''){                               $a .= ",'".$rowProspecto['idComuna']."'" ;                 }else{$a .= ",''";}
						if(isset($rowProspecto['Fax']) && $rowProspecto['Fax'] != ''){                                         $a .= ",'".$rowProspecto['Fax']."'" ;                      }else{$a .= ",''";}
						if(isset($rowProspecto['PersonaContacto']) && $rowProspecto['PersonaContacto'] != ''){                 $a .= ",'".$rowProspecto['PersonaContacto']."'" ;          }else{$a .= ",''";}
						if(isset($rowProspecto['PersonaContacto_Fono']) && $rowProspecto['PersonaContacto_Fono'] != ''){       $a .= ",'".$rowProspecto['PersonaContacto_Fono']."'" ;     }else{$a .= ",''";}
						if(isset($rowProspecto['PersonaContacto_email']) && $rowProspecto['PersonaContacto_email'] != ''){     $a .= ",'".$rowProspecto['PersonaContacto_email']."'" ;    }else{$a .= ",''";}
						if(isset($rowProspecto['PersonaContacto_Cargo']) && $rowProspecto['PersonaContacto_Cargo'] != ''){     $a .= ",'".$rowProspecto['PersonaContacto_Cargo']."'" ;    }else{$a .= ",''";}
						if(isset($rowProspecto['Web']) && $rowProspecto['Web'] != ''){                                         $a .= ",'".$rowProspecto['Web']."'" ;                      }else{$a .= ",''";}
						if(isset($rowProspecto['Giro']) && $rowProspecto['Giro'] != ''){                                       $a .= ",'".$rowProspecto['Giro']."'" ;                     }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_1']) && $rowProspecto['idTab_1']!= ''){                                  $a .= ",'".$rowProspecto['idTab_1']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_2']) && $rowProspecto['idTab_2']!= ''){                                  $a .= ",'".$rowProspecto['idTab_2']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_3']) && $rowProspecto['idTab_3']!= ''){                                  $a .= ",'".$rowProspecto['idTab_3']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_4']) && $rowProspecto['idTab_4']!= ''){                                  $a .= ",'".$rowProspecto['idTab_4']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_5']) && $rowProspecto['idTab_5']!= ''){                                  $a .= ",'".$rowProspecto['idTab_5']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_6']) && $rowProspecto['idTab_6']!= ''){                                  $a .= ",'".$rowProspecto['idTab_6']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_7']) && $rowProspecto['idTab_7']!= ''){                                  $a .= ",'".$rowProspecto['idTab_7']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_8']) && $rowProspecto['idTab_8']!= ''){                                  $a .= ",'".$rowProspecto['idTab_8']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_9']) && $rowProspecto['idTab_9']!= ''){                                  $a .= ",'".$rowProspecto['idTab_9']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_10']) && $rowProspecto['idTab_10']!= ''){                                $a .= ",'".$rowProspecto['idTab_10']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_11']) && $rowProspecto['idTab_11']!= ''){                                $a .= ",'".$rowProspecto['idTab_11']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_12']) && $rowProspecto['idTab_12']!= ''){                                $a .= ",'".$rowProspecto['idTab_12']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_13']) && $rowProspecto['idTab_13']!= ''){                                $a .= ",'".$rowProspecto['idTab_13']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_14']) && $rowProspecto['idTab_14']!= ''){                                $a .= ",'".$rowProspecto['idTab_14']."'" ;                  }else{$a .= ",''";}
						if(isset($rowProspecto['idTab_15']) && $rowProspecto['idTab_15']!= ''){                                $a .= ",'".$rowProspecto['idTab_15']."'" ;                  }else{$a .= ",''";}
						if(isset($Contrato_Nombre) && $Contrato_Nombre != ''){                                                 $a .= ",'".$Contrato_Nombre."'" ;                          }else{$a .= ",''";}
						if(isset($Contrato_Numero) && $Contrato_Numero != ''){                                                 $a .= ",'".$Contrato_Numero."'" ;                          }else{$a .= ",''";}
						if(isset($Contrato_Fecha_Ini) && $Contrato_Fecha_Ini != ''){                                           $a .= ",'".$Contrato_Fecha_Ini."'" ;                       }else{$a .= ",''";}
						if(isset($Contrato_Fecha_Term) && $Contrato_Fecha_Term != ''){                                         $a .= ",'".$Contrato_Fecha_Term."'" ;                      }else{$a .= ",''";}
						if(isset($Contrato_Valor_Mensual) && $Contrato_Valor_Mensual != ''){                                   $a .= ",'".$Contrato_Valor_Mensual."'" ;                   }else{$a .= ",''";}
						if(isset($Contrato_Valor_Anual) && $Contrato_Valor_Anual != ''){                                       $a .= ",'".$Contrato_Valor_Anual."'" ;                     }else{$a .= ",''";}
						if(isset($Contrato_Obs) && $Contrato_Obs != ''){                                                       $a .= ",'".$Contrato_Obs."'" ;                             }else{$a .= ",''";}
						$a .= ",'".$idEstado."'";
						$a .= ",'".md5($password)."'";
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `clientes_listado` (idSistema,idTipo,idRubro,email,Nombre,RazonSocial,
						Rut,fNacimiento,Direccion,Fono1,Fono2,idCiudad,idComuna,Fax,PersonaContacto,PersonaContacto_Fono,
						PersonaContacto_email,PersonaContacto_Cargo,Web,Giro,idTab_1,idTab_2,idTab_3,idTab_4,idTab_5,
						idTab_6,idTab_7, idTab_8, idTab_9, idTab_10, idTab_11, idTab_12, idTab_13, idTab_14, idTab_15, 
						Contrato_Nombre, Contrato_Numero, Contrato_Fecha_Ini, Contrato_Fecha_Term, Contrato_Valor_Mensual, 
						Contrato_Valor_Anual, Contrato_Obs,idEstado,password) 
						VALUES (".$a.")";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
						//Si ejecuto correctamente la consulta
						if($resultado){
							
							//recibo el último id generado por mi sesion
							$ultimo_id = mysqli_insert_id($dbConn);
							
							//Se verifica rut
							if(isset($rowProspecto['Rut'])&&$rowProspecto['Rut']!=''){
								//Se crea la carpeta del cliente
								if(isset($new_folder)&&$new_folder!=''&&$new_folder==1){
									
									$Rut = $rowProspecto['Rut'];
									$Rut = str_replace(' ', '', $Rut);//elimino espacios
									$Rut = str_replace('-', '', $Rut);//elimino los guiones
									$Rut = str_replace('.', '', $Rut);//elimino los puntos
									$ruta = "ClientFiles/_public/Cliente_".$Rut;
									//si no existe la carpeta
									if (!file_exists($ruta)) {
										try {
											$oldmask = umask(000);//it will set the new umask and returns the old one 
											mkdir($ruta, 0777);
											umask($oldmask);//reset the old umask
											//redirijo
											header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
											die;
										} catch (Exception $e) {
											//echo 'Excepción capturada: ',  $e->getMessage(), "\n";
											$error['ndata_1'] = 'error/'.$e->getMessage();
										}
									//si existe carpeta se devuelve error	
									}else{
										//$error['ndata_1'] = 'error/La carpeta del cliente ya existe';
										header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
									}
								}else{
									//redirijo
									header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
									die;
								}
							//si no hay rut	
							}else{
								//no se crean las carpetas y se redirige
								header( 'Location: '.$location.'&id='.$ultimo_id.'&created=true' );
							}
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
					
					/*******************************************************/
					
				}
			}
		
		break;				
/*******************************************************************************************************************/
	}
?>
