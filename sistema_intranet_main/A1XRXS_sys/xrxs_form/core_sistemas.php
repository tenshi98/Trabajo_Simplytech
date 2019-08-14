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
	if ( !empty($_POST['idSistema']) )                 $idSistema                = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )                    $Nombre                   = $_POST['Nombre'];
	if ( isset($_POST['email_principal']) )            $email_principal          = $_POST['email_principal'];
	if ( !empty($_POST['Rut']) )                       $Rut                      = $_POST['Rut'];
	if ( isset($_POST['idCiudad']) )                   $idCiudad                 = $_POST['idCiudad'];
	if ( isset($_POST['idComuna']) )                   $idComuna                 = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )                 $Direccion                = $_POST['Direccion'];
	if ( isset($_POST['CajaChica']) )                  $CajaChica                = $_POST['CajaChica'];
	if ( isset($_POST['Contacto_Nombre']) )            $Contacto_Nombre          = $_POST['Contacto_Nombre'];
	if ( isset($_POST['Contacto_Fono1']) )             $Contacto_Fono1           = $_POST['Contacto_Fono1'];
	if ( isset($_POST['Contacto_Fono2']) )             $Contacto_Fono2           = $_POST['Contacto_Fono2'];
	if ( isset($_POST['Contacto_Fax']) )               $Contacto_Fax             = $_POST['Contacto_Fax'];
	if ( isset($_POST['Contacto_Email']) )             $Contacto_Email           = $_POST['Contacto_Email'];
	if ( isset($_POST['Contacto_Web']) )               $Contacto_Web             = $_POST['Contacto_Web'];
	if ( isset($_POST['Contrato_Nombre']) )            $Contrato_Nombre          = $_POST['Contrato_Nombre'];
	if ( !empty($_POST['Contrato_Numero']) )           $Contrato_Numero          = $_POST['Contrato_Numero'];
	if ( !empty($_POST['Contrato_Fecha']) )            $Contrato_Fecha           = $_POST['Contrato_Fecha'];
	if ( !empty($_POST['Contrato_Duracion']) )         $Contrato_Duracion        = $_POST['Contrato_Duracion'];
	if ( !empty($_POST['Config_IDGoogle']) )           $Config_IDGoogle          = $_POST['Config_IDGoogle'];
	if ( !empty($_POST['Config_Google_apiKey']) )      $Config_Google_apiKey     = $_POST['Config_Google_apiKey'];
	if ( !empty($_POST['Config_imgLogo']) )            $Config_imgLogo           = $_POST['Config_imgLogo'];
	if ( !empty($_POST['Config_idTheme']) )            $Config_idTheme           = $_POST['Config_idTheme'];
	if ( !empty($_POST['Config_CorreoRespaldo']) )     $Config_CorreoRespaldo    = $_POST['Config_CorreoRespaldo'];
	if ( !empty($_POST['idOpcionesGen_1']) )           $idOpcionesGen_1          = $_POST['idOpcionesGen_1'];
	if ( !empty($_POST['idOpcionesGen_2']) )           $idOpcionesGen_2          = $_POST['idOpcionesGen_2'];
	if ( !empty($_POST['idOpcionesGen_3']) )           $idOpcionesGen_3          = $_POST['idOpcionesGen_3'];
	if ( !empty($_POST['idOpcionesGen_4']) )           $idOpcionesGen_4          = $_POST['idOpcionesGen_4'];
	if ( !empty($_POST['idOpcionesGen_5']) )           $idOpcionesGen_5          = $_POST['idOpcionesGen_5'];
	if ( isset($_POST['idOpcionesGen_6']) )            $idOpcionesGen_6          = $_POST['idOpcionesGen_6'];
	if ( !empty($_POST['idOpcionesGen_7']) )           $idOpcionesGen_7          = $_POST['idOpcionesGen_7'];
	if ( !empty($_POST['idOpcionesGen_8']) )           $idOpcionesGen_8          = $_POST['idOpcionesGen_8'];
	if ( !empty($_POST['idOpcionesGen_9']) )           $idOpcionesGen_9          = $_POST['idOpcionesGen_9'];
	if ( !empty($_POST['OT_idBodegaProd']) )           $OT_idBodegaProd          = $_POST['OT_idBodegaProd'];
	if ( !empty($_POST['OT_idBodegaIns']) )            $OT_idBodegaIns           = $_POST['OT_idBodegaIns'];
	if ( !empty($_POST['Rubro']) )                     $Rubro                    = $_POST['Rubro'];
	if ( !empty($_POST['idOpcionesTel']) )             $idOpcionesTel            = $_POST['idOpcionesTel'];
	if ( !empty($_POST['idConfigRam']) )               $idConfigRam              = $_POST['idConfigRam'];
	if ( !empty($_POST['idConfigTime']) )              $idConfigTime             = $_POST['idConfigTime'];
	if ( !empty($_POST['idEstado']) )                  $idEstado                 = $_POST['idEstado'];
	

	
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
			case 'idSistema':               if(empty($idSistema)){               $error['idSistema']               = 'error/No ha ingresado el id';}break;
			case 'Nombre':                  if(empty($Nombre)){                  $error['Nombre']                  = 'error/No ha ingresado el Nombre';}break;
			case 'email_principal':         if(empty($email_principal)){         $error['email_principal']         = 'error/No ha ingresado el email';}break;
			case 'Rut':                     if(empty($Rut)){                     $error['Rut']                     = 'error/No ha ingresado el Rut';}break;
			case 'idCiudad':                if(empty($idCiudad)){                $error['idCiudad']                = 'error/No ha seleccionado la region';}break;
			case 'idComuna':                if(empty($idComuna)){                $error['idComuna']                = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':               if(empty($Direccion)){               $error['Direccion']               = 'error/No ha ingresado la direccion';}break;
			case 'CajaChica':               if(empty($CajaChica)){               $error['CajaChica']               = 'error/No ha ingresado el Nombre monto de la caja chica';}break;
			case 'Contacto_Nombre':         if(empty($Contacto_Nombre)){         $error['Contacto_Nombre']         = 'error/No ha ingresado el Nombre del contacto';}break;
			case 'Contacto_Fono1':          if(empty($Contacto_Fono1)){          $error['Contacto_Fono1']          = 'error/No ha ingresado el telefono 1';}break;
			case 'Contacto_Fono2':          if(empty($Contacto_Fono2)){          $error['Contacto_Fono2']          = 'error/No ha ingresado el telefono 2';}break;
			case 'Contacto_Fax':            if(empty($Contacto_Fax)){            $error['Contacto_Fax']            = 'error/No ha ingresado el fax';}break;
			case 'Contacto_Email':          if(empty($Contacto_Email)){          $error['Contacto_Email']          = 'error/No ha ingresado el email del sistema';}break;
			case 'Contacto_Web':            if(empty($Contacto_Web)){            $error['Contacto_Web']            = 'error/No ha ingresado la pagina web';}break;
			case 'Contrato_Nombre':         if(empty($Contrato_Nombre)){         $error['Contrato_Nombre']         = 'error/No ha ingresado el Nombre del contrato';}break;
			case 'Contrato_Numero':         if(empty($Contrato_Numero)){         $error['Contrato_Numero']         = 'error/No ha ingresado el numero de contrato';}break;
			case 'Contrato_Fecha':          if(empty($Contrato_Fecha)){          $error['Contrato_Fecha']          = 'error/No ha ingresado la fecha de contrato';}break;
			case 'Contrato_Duracion':       if(empty($Contrato_Duracion)){       $error['Contrato_Duracion']       = 'error/No ha ingresado la duracion del contrato';}break;
			case 'Config_IDGoogle':         if(empty($Config_IDGoogle)){         $error['Config_IDGoogle']         = 'error/No ha ingresado la ID de Google';}break;
			case 'Config_Google_apiKey':    if(empty($Config_Google_apiKey)){    $error['Config_Google_apiKey']    = 'error/No ha ingresado la ID de Google';}break;
			case 'Config_imgLogo':          if(empty($Config_imgLogo)){          $error['Config_imgLogo']          = 'error/No ha subido el logo';}break;
			case 'Config_idTheme':          if(empty($Config_idTheme)){          $error['Config_idTheme']          = 'error/No ha seleccionado el tema';}break;
			case 'Config_CorreoRespaldo':   if(empty($Config_CorreoRespaldo)){   $error['Config_CorreoRespaldo']   = 'error/No ha ingresado el correo de respaldo';}break;
			case 'idOpcionesGen_1':         if(empty($idOpcionesGen_1)){         $error['idOpcionesGen_1']         = 'error/No ha seleccionado la opcion 1';}break;
			case 'idOpcionesGen_2':         if(empty($idOpcionesGen_2)){         $error['idOpcionesGen_2']         = 'error/No ha seleccionado la opcion 2';}break;
			case 'idOpcionesGen_3':         if(empty($idOpcionesGen_3)){         $error['idOpcionesGen_3']         = 'error/No ha seleccionado la opcion 3';}break;
			case 'idOpcionesGen_4':         if(empty($idOpcionesGen_4)){         $error['idOpcionesGen_4']         = 'error/No ha seleccionado la opcion 4';}break;
			case 'idOpcionesGen_5':         if(empty($idOpcionesGen_5)){         $error['idOpcionesGen_5']         = 'error/No ha seleccionado la opcion 5';}break;
			case 'idOpcionesGen_6':         if(empty($idOpcionesGen_6)){         $error['idOpcionesGen_6']         = 'error/No ha seleccionado la opcion 6';}break;
			case 'idOpcionesGen_7':         if(empty($idOpcionesGen_7)){         $error['idOpcionesGen_7']         = 'error/No ha seleccionado la opcion 7';}break;
			case 'idOpcionesGen_8':         if(empty($idOpcionesGen_8)){         $error['idOpcionesGen_8']         = 'error/No ha seleccionado la opcion 8';}break;
			case 'idOpcionesGen_9':         if(empty($idOpcionesGen_9)){         $error['idOpcionesGen_9']         = 'error/No ha seleccionado la opcion 9';}break;
			case 'OT_idBodegaProd':         if(empty($OT_idBodegaProd)){         $error['OT_idBodegaProd']         = 'error/No ha seleccionado la bodega de productos';}break;
			case 'OT_idBodegaIns':          if(empty($OT_idBodegaIns)){          $error['OT_idBodegaIns']          = 'error/No ha seleccionado la bodega de insumos';}break;
			case 'Rubro':                   if(empty($Rubro)){                   $error['Rubro']                   = 'error/No ha ingresado el rubro';}break;
			case 'idOpcionesTel':           if(empty($idOpcionesTel)){           $error['idOpcionesTel']           = 'error/No ha seleccionado el resumen de telemetria a mostrar';}break;
			case 'idConfigRam':             if(empty($idConfigRam)){             $error['idConfigRam']             = 'error/No ha seleccionado la configuracion de la ram';}break;
			case 'idConfigTime':            if(empty($idConfigTime)){            $error['idConfigTime']            = 'error/No ha seleccionado la configuracion del tiempo de espera';}break;
			case 'idEstado':                if(empty($idEstado)){                $error['idEstado']                = 'error/No ha seleccionado el sistema';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email_principal)&&$email_principal!=''){if(validaremail($email_principal)){ }else{   $error['email_principal']   = 'error/El Email de sistema ingresado no es valido'; }}	
	if(isset($Contacto_Fono1)&&$Contacto_Fono1!=''){if (validarnumero($Contacto_Fono1)) {         $error['Fono1']	         = 'error/Ingrese un numero telefonico valido'; }}
	if(isset($Contacto_Fono2)&&$Contacto_Fono2!=''){if (validarnumero($Contacto_Fono2)) {         $error['Fono2']	         = 'error/Ingrese un numero telefonico valido'; }}
	if(isset($Rut)){if(RutValidate($Rut)==0){                                $error['Rut']               = 'error/El Rut ingresado no es valido'; }}
	if(isset($Contacto_Email)&&$email_principal!=''){if(validaremail($Contacto_Email)){ }else{     $error['Contacto_Email']    = 'error/El Email de contacto ingresado no es valido'; }}	
	
	
	
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
			if(isset($Nombre)){
				$ndata_1 = db_select_nrows ('Nombre', 'core_sistemas', '', "Nombre='".$Nombre."'", $dbConn);
			}
			if(isset($Rut)){
				$ndata_2 = db_select_nrows ('Rut', 'core_sistemas', '', "Rut='".$Rut."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                                 $a = "'".$Nombre."'" ;                    }else{$a ="''";}
				if(isset($email_principal) && $email_principal != ''){               $a .= ",'".$email_principal."'" ;         }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                                       $a .= ",'".$Rut."'" ;                     }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                             $a .= ",'".$idCiudad."'" ;                }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                             $a .= ",'".$idComuna."'" ;                }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                           $a .= ",'".$Direccion."'" ;               }else{$a .= ",''";}
				if(isset($CajaChica) && $CajaChica != ''){                           $a .= ",'".$CajaChica."'" ;               }else{$a .= ",''";}
				if(isset($Contacto_Nombre) && $Contacto_Nombre != ''){               $a .= ",'".$Contacto_Nombre."'" ;         }else{$a .= ",''";}
				if(isset($Contacto_Fono1) && $Contacto_Fono1 != ''){                 $a .= ",'".$Contacto_Fono1."'" ;          }else{$a .= ",''";}
				if(isset($Contacto_Fono2) && $Contacto_Fono2 != ''){                 $a .= ",'".$Contacto_Fono2."'" ;          }else{$a .= ",''";}
				if(isset($Contacto_Fax) && $Contacto_Fax != ''){                     $a .= ",'".$Contacto_Fax."'" ;            }else{$a .= ",''";}
				if(isset($Contacto_Email) && $Contacto_Email != ''){                 $a .= ",'".$Contacto_Email."'" ;          }else{$a .= ",''";}
				if(isset($Contacto_Web) && $Contacto_Web != ''){                     $a .= ",'".$Contacto_Web."'" ;            }else{$a .= ",''";}
				if(isset($Contrato_Nombre) && $Contrato_Nombre != ''){               $a .= ",'".$Contrato_Nombre."'" ;         }else{$a .= ",''";}
				if(isset($Contrato_Numero) && $Contrato_Numero != ''){               $a .= ",'".$Contrato_Numero."'" ;         }else{$a .= ",''";}
				if(isset($Contrato_Fecha) && $Contrato_Fecha != ''){                 $a .= ",'".$Contrato_Fecha."'" ;          }else{$a .= ",''";}
				if(isset($Contrato_Duracion) && $Contrato_Duracion != ''){           $a .= ",'".$Contrato_Duracion."'" ;       }else{$a .= ",''";}
				if(isset($Config_IDGoogle) && $Config_IDGoogle != ''){               $a .= ",'".$Config_IDGoogle."'" ;         }else{$a .= ",''";}
				if(isset($Config_Google_apiKey) && $Config_Google_apiKey != ''){     $a .= ",'".$Config_Google_apiKey."'" ;    }else{$a .= ",''";}
				if(isset($Config_imgLogo) && $Config_imgLogo != ''){                 $a .= ",'".$Config_imgLogo."'" ;          }else{$a .= ",''";}
				if(isset($Config_idTheme) && $Config_idTheme != ''){                 $a .= ",'".$Config_idTheme."'" ;          }else{$a .= ",''";}
				if(isset($Config_CorreoRespaldo) && $Config_CorreoRespaldo != ''){   $a .= ",'".$Config_CorreoRespaldo."'" ;   }else{$a .= ",''";}
				if(isset($idOpcionesGen_1) && $idOpcionesGen_1 != ''){               $a .= ",'".$idOpcionesGen_1."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_2) && $idOpcionesGen_2 != ''){               $a .= ",'".$idOpcionesGen_2."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_3) && $idOpcionesGen_3 != ''){               $a .= ",'".$idOpcionesGen_3."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_4) && $idOpcionesGen_4 != ''){               $a .= ",'".$idOpcionesGen_4."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_5) && $idOpcionesGen_5 != ''){               $a .= ",'".$idOpcionesGen_5."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_6) && $idOpcionesGen_6 != ''){               $a .= ",'".$idOpcionesGen_6."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_7) && $idOpcionesGen_7 != ''){               $a .= ",'".$idOpcionesGen_7."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_8) && $idOpcionesGen_8 != ''){               $a .= ",'".$idOpcionesGen_8."'" ;         }else{$a .= ",''";}
				if(isset($idOpcionesGen_9) && $idOpcionesGen_9 != ''){               $a .= ",'".$idOpcionesGen_9."'" ;         }else{$a .= ",''";}
				if(isset($OT_idBodegaProd) && $OT_idBodegaProd != ''){               $a .= ",'".$OT_idBodegaProd."'" ;         }else{$a .= ",''";}
				if(isset($OT_idBodegaIns) && $OT_idBodegaIns != ''){                 $a .= ",'".$OT_idBodegaIns."'" ;          }else{$a .= ",''";}
				if(isset($Rubro) && $Rubro != ''){                                   $a .= ",'".$Rubro."'" ;                   }else{$a .= ",''";}
				if(isset($idOpcionesTel) && $idOpcionesTel != ''){                   $a .= ",'".$idOpcionesTel."'" ;           }else{$a .= ",''";}
				if(isset($idConfigRam) && $idConfigRam != ''){                       $a .= ",'".$idConfigRam."'" ;             }else{$a .= ",''";}
				if(isset($idConfigTime) && $idConfigTime != ''){                     $a .= ",'".$idConfigTime."'" ;            }else{$a .= ",''";}
				if(isset($idEstado) && $idEstado != ''){                             $a .= ",'".$idEstado."'" ;                }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_sistemas` (Nombre, email_principal, Rut, idCiudad, idComuna, Direccion,
				CajaChica, Contacto_Nombre, Contacto_Fono1, Contacto_Fono2, Contacto_Fax, Contacto_Email, Contacto_Web, 
				Contrato_Nombre, Contrato_Numero, Contrato_Fecha, Contrato_Duracion, Config_IDGoogle,Config_Google_apiKey,
				Config_imgLogo, Config_idTheme, Config_CorreoRespaldo, idOpcionesGen_1, idOpcionesGen_2, idOpcionesGen_3,
				idOpcionesGen_4, idOpcionesGen_5, idOpcionesGen_6, idOpcionesGen_7, idOpcionesGen_8, idOpcionesGen_9,
				OT_idBodegaProd, OT_idBodegaIns, Rubro, idOpcionesTel, idConfigRam, idConfigTime, idEstado) 
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
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'core_sistemas', '', "Nombre='".$Nombre."' AND idSistema!='".$idSistema."'", $dbConn);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('Rut', 'core_sistemas', '', "Rut='".$Rut."' AND idSistema!='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSistema='".$idSistema."'" ;
				if(isset($Nombre) && $Nombre != ''){                                 $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($email_principal) && $email_principal != ''){               $a .= ",email_principal='".$email_principal."'" ;}
				if(isset($Rut) && $Rut != ''){                                       $a .= ",Rut='".$Rut."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){                             $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){                             $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){                           $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($CajaChica) && $CajaChica != ''){                           $a .= ",CajaChica='".$CajaChica."'" ;}
				if(isset($Contacto_Nombre) && $Contacto_Nombre != ''){               $a .= ",Contacto_Nombre='".$Contacto_Nombre."'" ;}
				if(isset($Contacto_Fono1) && $Contacto_Fono1 != ''){                 $a .= ",Contacto_Fono1='".$Contacto_Fono1."'" ;}
				if(isset($Contacto_Fono2) && $Contacto_Fono2 != ''){                 $a .= ",Contacto_Fono2='".$Contacto_Fono2."'" ;}
				if(isset($Contacto_Fax) && $Contacto_Fax != ''){                     $a .= ",Contacto_Fax='".$Contacto_Fax."'" ;}
				if(isset($Contacto_Email) && $Contacto_Email != ''){                 $a .= ",Contacto_Email='".$Contacto_Email."'" ;}
				if(isset($Contacto_Web) && $Contacto_Web != ''){                     $a .= ",Contacto_Web='".$Contacto_Web."'" ;}
				if(isset($Contrato_Nombre) && $Contrato_Nombre != ''){               $a .= ",Contrato_Nombre='".$Contrato_Nombre."'" ;}
				if(isset($Contrato_Numero) && $Contrato_Numero != ''){               $a .= ",Contrato_Numero='".$Contrato_Numero."'" ;}
				if(isset($Contrato_Fecha) && $Contrato_Fecha != ''){                 $a .= ",Contrato_Fecha='".$Contrato_Fecha."'" ;}
				if(isset($Contrato_Duracion) && $Contrato_Duracion != ''){           $a .= ",Contrato_Duracion='".$Contrato_Duracion."'" ;}
				if(isset($Config_IDGoogle) && $Config_IDGoogle != ''){               $a .= ",Config_IDGoogle='".$Config_IDGoogle."'" ;}
				if(isset($Config_Google_apiKey) && $Config_Google_apiKey != ''){     $a .= ",Config_Google_apiKey='".$Config_Google_apiKey."'" ;}
				if(isset($Config_imgLogo) && $Config_imgLogo != ''){                 $a .= ",Config_imgLogo='".$Config_imgLogo."'" ;}
				if(isset($Config_idTheme) && $Config_idTheme != ''){                 $a .= ",Config_idTheme='".$Config_idTheme."'" ;}
				if(isset($Config_CorreoRespaldo) && $Config_CorreoRespaldo != ''){   $a .= ",Config_CorreoRespaldo='".$Config_CorreoRespaldo."'" ;}
				if(isset($idOpcionesGen_1) && $idOpcionesGen_1 != ''){               $a .= ",idOpcionesGen_1='".$idOpcionesGen_1."'" ;}
				if(isset($idOpcionesGen_2) && $idOpcionesGen_2 != ''){               $a .= ",idOpcionesGen_2='".$idOpcionesGen_2."'" ;}
				if(isset($idOpcionesGen_3) && $idOpcionesGen_3 != ''){               $a .= ",idOpcionesGen_3='".$idOpcionesGen_3."'" ;}
				if(isset($idOpcionesGen_4) && $idOpcionesGen_4 != ''){               $a .= ",idOpcionesGen_4='".$idOpcionesGen_4."'" ;}
				if(isset($idOpcionesGen_5) && $idOpcionesGen_5 != ''){               $a .= ",idOpcionesGen_5='".$idOpcionesGen_5."'" ;}
				if(isset($idOpcionesGen_6) && $idOpcionesGen_6 != ''){               $a .= ",idOpcionesGen_6='".$idOpcionesGen_6."'" ;}
				if(isset($idOpcionesGen_7) && $idOpcionesGen_7 != ''){               $a .= ",idOpcionesGen_7='".$idOpcionesGen_7."'" ;}
				if(isset($idOpcionesGen_8) && $idOpcionesGen_8 != ''){               $a .= ",idOpcionesGen_8='".$idOpcionesGen_8."'" ;}
				if(isset($idOpcionesGen_9) && $idOpcionesGen_9 != ''){               $a .= ",idOpcionesGen_9='".$idOpcionesGen_9."'" ;}
				if(isset($OT_idBodegaProd) && $OT_idBodegaProd != ''){               $a .= ",OT_idBodegaProd='".$OT_idBodegaProd."'" ;}
				if(isset($OT_idBodegaIns) && $OT_idBodegaIns != ''){                 $a .= ",OT_idBodegaIns='".$OT_idBodegaIns."'" ;}
				if(isset($Rubro) && $Rubro != ''){                                   $a .= ",Rubro='".$Rubro."'" ;}
				if(isset($idOpcionesTel) && $idOpcionesTel != ''){                   $a .= ",idOpcionesTel='".$idOpcionesTel."'" ;}
				if(isset($idConfigRam) && $idConfigRam != ''){                       $a .= ",idConfigRam='".$idConfigRam."'" ;}
				if(isset($idConfigTime) && $idConfigTime != ''){                     $a .= ",idConfigTime='".$idConfigTime."'" ;}
				if(isset($idEstado) && $idEstado != ''){                             $a .= ",idEstado='".$idEstado."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `core_sistemas` SET ".$a." WHERE idSistema = '$idSistema'";
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
			
			// Se obtiene el nombre del logo
			$query = "SELECT Config_imgLogo
			FROM `core_sistemas`
			WHERE idSistema = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `core_sistemas` WHERE idSistema = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['Config_imgLogo'])&&$rowdata['Config_imgLogo']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Config_imgLogo'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Config_imgLogo']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
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
		case 'submit_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["Config_imgLogo"]["error"] > 0){
				$error['Config_imgLogo']       = 'error/Ha ocurrido un error';
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'logos_';
				  
				if (in_array($_FILES['Config_imgLogo']['type'], $permitidos) && $_FILES['Config_imgLogo']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['Config_imgLogo']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						//$move_result = @move_uploaded_file($_FILES["Config_imgLogo"]["tmp_name"], $ruta);
						//Muevo el archivo
						$move_result = @move_uploaded_file($_FILES["Config_imgLogo"]["tmp_name"], "upload/xxxsxx_".$_FILES['Config_imgLogo']['name']);
						
						if ($move_result){
							//se selecciona la imagen
							switch ($_FILES['Config_imgLogo']['type']) {
								case 'image/jpg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
								case 'image/jpeg':
									$imgBase = imagecreatefromjpeg('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
								case 'image/gif':
									$imgBase = imagecreatefromgif('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
								case 'image/png':
									$imgBase = imagecreatefrompng('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
									break;
							}
								
							//se reescala la imagen en caso de ser necesario
							$imgBase_width = imagesx( $imgBase );
							$imgBase_height = imagesy( $imgBase );
								
							//Se establece el tamaño maximo
							$max_width  = 640;
							$max_height = 640;

							if ($imgBase_width > $imgBase_height) {
								if($imgBase_width < $max_width){
									$newwidth = $imgBase_width;
								}else{
									$newwidth = $max_width;	
								}
								$divisor = $imgBase_width / $newwidth;
								$newheight = floor( $imgBase_height / $divisor);
							}else {
								if($imgBase_height < $max_height){
									$newheight = $imgBase_height;
								}else{
									$newheight =  $max_height;
								} 
								$divisor = $imgBase_height / $newheight;
								$newwidth = floor( $imgBase_width / $divisor );
							}

							$imgBase = imagescale($imgBase, $newwidth, $newheight);

							//se establece la calidad del archivo
							$quality = 75;
								
							//se crea la imagen
							imagejpeg($imgBase, $ruta, $quality);
								
							//se elimina la imagen base
							try {
								if(!is_writable('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name'])){
									//throw new Exception('File not writable');
								}else{
									unlink('upload/xxxsxx_'.$_FILES['Config_imgLogo']['name']);
								}
							}catch(Exception $e) { 
								//guardar el dato en un archivo log
							}
							//se eliminan las imagenes de la memoria
							imagedestroy($imgBase);
							
								
							//Filtro para idSistema
							if ( !empty($_POST['idSistema']) )    $idSistema       = $_POST['idSistema'];
									
							$a = "Config_imgLogo='".$sufijo.$_FILES['Config_imgLogo']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `core_sistemas` SET ".$a." WHERE idSistema = '$idSistema'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location.'&img_id='.$idSistema );
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
									
						} else {
							$error['Config_imgLogo']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['Config_imgLogo']       = 'error/El archivo '.$_FILES['Config_imgLogo']['name'].' ya existe';
					}
				} else {
					$error['Config_imgLogo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'del_img':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// Se obtiene el nombre del logo
			$query = "SELECT Config_imgLogo
			FROM `core_sistemas`
			WHERE idSistema = {$_GET['del_img']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `core_sistemas` SET Config_imgLogo='' WHERE idSistema = '{$_GET['del_img']}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['Config_imgLogo'])&&$rowdata['Config_imgLogo']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Config_imgLogo'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Config_imgLogo']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&img_id='.$_GET['del_img'] );
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
		case 'update_theme':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$idSistema       = $_GET['idSistema'];
			$Config_idTheme  = $_GET['idTheme'];
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idSistema='".$idSistema."'" ;
				if(isset($Config_idTheme) && $Config_idTheme != ''){    $a .= ",Config_idTheme='".$Config_idTheme."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `core_sistemas` SET ".$a." WHERE idSistema = '$idSistema'";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//Seteo la variable de sesion si existe
					if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])){
						$_SESSION['usuario']['basic_data']['Config_idTheme'] = $Config_idTheme;
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
		//Agrega un permiso al usuario
		case 'sis_prod_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idProducto   = $_GET['sis_prod_add'];
			$query  = "INSERT INTO `core_sistemas_productos` (idSistema, idProducto) 
			VALUES ('$id_sistema','$idProducto')";
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
			
		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'sis_prod_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `core_sistemas_productos` WHERE idSisProd = {$_GET['sis_prod_del']}";
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
			
		break;	
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_ins_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idProducto   = $_GET['sis_ins_add'];
			$query  = "INSERT INTO `core_sistemas_insumos` (idSistema, idProducto) 
			VALUES ('$id_sistema','$idProducto')";
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
			
		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'sis_ins_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `core_sistemas_insumos` WHERE idSisProd = {$_GET['sis_ins_del']}";
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
			
		break;	
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_especie_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idCategoria   = $_GET['sis_especie_add'];
			$query  = "INSERT INTO `core_sistemas_variedades_categorias` (idSistema, idCategoria) 
			VALUES ('$id_sistema','$idCategoria')";
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
			
		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'sis_especie_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/**************************/
			//Listado de productos
			$arrProductos = array();
			echo $query = "SELECT 
			variedades_listado.idProducto,
			(SELECT COUNT(idSisProd) FROM core_sistemas_variedades_listado WHERE idProducto = variedades_listado.idProducto AND idSistema = {$_SESSION['usuario']['basic_data']['idSistema']} LIMIT 1) AS contar,
			(SELECT idSisProd FROM core_sistemas_variedades_listado WHERE idProducto = variedades_listado.idProducto AND idSistema = {$_SESSION['usuario']['basic_data']['idSistema']} LIMIT 1) AS idpermiso
			FROM `core_sistemas_variedades_categorias`
			LEFT JOIN `variedades_listado`             ON variedades_listado.idCategoria             = core_sistemas_variedades_categorias.idCategoria

			WHERE 
			core_sistemas_variedades_categorias.idSisProd = {$_GET['sis_especie_del']}
			AND variedades_listado.idEstado = 1
			ORDER BY core_sistemas_variedades_categorias.idSisProd ASC";
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
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrProductos,$row );
			}
			
			


			/**************************/
			//elimino la categoria
			$query  = "DELETE FROM `core_sistemas_variedades_categorias` WHERE idSisProd = {$_GET['sis_especie_del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			
			/**************************/
			//elimino los productos relacionados a la categoria
			foreach ($arrProductos as $productos) {
				if ( isset($productos['contar'])&&$productos['contar']!='0' ) {
					$query  = "DELETE FROM `core_sistemas_variedades_listado` WHERE idSisProd = {$productos['idpermiso']}";
					//Consulta
					$resultado = mysqli_query ($dbConn, $query);
				}
				
			}
			
			
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
			
		break;	
		
/*******************************************************************************************************************/
		//Agrega un permiso al usuario
		case 'sis_variedad_add':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$id_sistema   = $_GET['id'];
			$idProducto   = $_GET['sis_variedad_add'];
			$query  = "INSERT INTO `core_sistemas_variedades_listado` (idSistema, idProducto) 
			VALUES ('$id_sistema','$idProducto')";
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
			
		break;	
/*******************************************************************************************************************/
		//borra un permiso del usuario
		case 'sis_variedad_del':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$query  = "DELETE FROM `core_sistemas_variedades_listado` WHERE idSisProd = {$_GET['sis_variedad_del']}";
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
			
		break;	
/*******************************************************************************************************************/
		//Cambio el estado de activo a inactivo
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idSistema  = $_GET['id'];
			$idEstado   = $_GET['estado'];
			$query  = "UPDATE core_sistemas SET idEstado = '$idEstado'	
			WHERE idSistema    = '$idSistema'";
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

		break;
/*******************************************************************************************************************/
	}
?>
