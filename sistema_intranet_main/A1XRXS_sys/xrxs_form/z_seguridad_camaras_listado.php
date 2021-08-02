<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
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
	if ( !empty($_POST['idCamara']) )             $idCamara             = $_POST['idCamara'];
	if ( !empty($_POST['idSistema']) )            $idSistema            = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )             $idEstado             = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )               $Nombre               = $_POST['Nombre'];
	if ( !empty($_POST['idPais']) )               $idPais               = $_POST['idPais'];
	if ( !empty($_POST['idCiudad']) )             $idCiudad             = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )             $idComuna             = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )            $Direccion            = $_POST['Direccion'];
	if ( !empty($_POST['N_Camaras']) )            $N_Camaras            = $_POST['N_Camaras'];
	if ( !empty($_POST['idSubconfiguracion']) )   $idSubconfiguracion   = $_POST['idSubconfiguracion'];
	if ( !empty($_POST['idTipoCamara']) )         $idTipoCamara         = $_POST['idTipoCamara'];
	if ( !empty($_POST['Config_usuario']) )       $Config_usuario       = $_POST['Config_usuario'];
	if ( !empty($_POST['Config_Password']) )      $Config_Password      = $_POST['Config_Password'];
	if ( !empty($_POST['Config_IP']) )            $Config_IP            = $_POST['Config_IP'];
	if ( !empty($_POST['Config_Puerto']) )        $Config_Puerto        = $_POST['Config_Puerto'];
	if ( !empty($_POST['Config_Web']) )           $Config_Web           = $_POST['Config_Web'];
	if ( !empty($_POST['idCanal']) )              $idCanal              = $_POST['idCanal'];
	if ( !empty($_POST['Chanel']) )               $Chanel               = $_POST['Chanel'];
	
	
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
			case 'idCamara':            if(empty($idCamara)){            $error['idCamara']             = 'error/No ha ingresado el id';}break;
			case 'idSistema':           if(empty($idSistema)){           $error['idSistema']            = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':            if(empty($idEstado)){            $error['idEstado']             = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':              if(empty($Nombre)){              $error['Nombre']               = 'error/No ha ingresado el nombre';}break;
			case 'idPais':              if(empty($idPais)){              $error['idPais']               = 'error/No ha seleccionado el Pais';}break;
			case 'idCiudad':            if(empty($idCiudad)){            $error['idCiudad']             = 'error/No ha seleccionado la Ciudad';}break;
			case 'idComuna':            if(empty($idComuna)){            $error['idComuna']             = 'error/No ha seleccionado la Comuna';}break;
			case 'Direccion':           if(empty($Direccion)){           $error['Direccion']            = 'error/No ha seleccionado la Direccion';}break;
			case 'N_Camaras':           if(empty($N_Camaras)){           $error['N_Camaras']            = 'error/No ha ingresado el numero de camaras';}break;
			case 'idSubconfiguracion':  if(empty($idSubconfiguracion)){  $error['idSubconfiguracion']   = 'error/No ha seleccionado si existe subconfiguracion';}break;
			case 'idTipoCamara':        if(empty($idTipoCamara)){        $error['idTipoCamara']         = 'error/No ha seleccionado el tipo de camara';}break;
			case 'Config_usuario':      if(empty($Config_usuario)){      $error['Config_usuario']       = 'error/No ha ingresado el usuario';}break;
			case 'Config_Password':     if(empty($Config_Password)){     $error['Config_Password']      = 'error/No ha ingresado el password';}break;
			case 'Config_IP':           if(empty($Config_IP)){           $error['Config_IP']            = 'error/No ha ingresado la direccion web o la IP';}break;
			case 'Config_Puerto':       if(empty($Config_Puerto)){       $error['Config_Puerto']        = 'error/No ha ingresado el puerto de comunicacion';}break;
			case 'Config_Web':          if(empty($Config_Web)){          $error['Config_Web']           = 'error/No ha ingresado la pagina de acceso directo';}break;
			case 'idCanal':             if(empty($idCanal)){             $error['idCanal']              = 'error/No ha seleccionado la camara';}break;
			case 'Chanel':              if(empty($Chanel)){              $error['Chanel']               = 'error/No ha seleccionado el canal';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                    $error['Nombre']          = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){              $error['Direccion']       = 'error/Edita Direccion, contiene palabras no permitidas'; }	
	if(isset($Config_usuario)&&contar_palabras_censuradas($Config_usuario)!=0){    $error['Config_usuario']  = 'error/Edita Config usuario, contiene palabras no permitidas'; }	
	if(isset($Config_Password)&&contar_palabras_censuradas($Config_Password)!=0){  $error['Config_Password'] = 'error/Edita Config Password, contiene palabras no permitidas'; }	
	if(isset($Config_IP)&&contar_palabras_censuradas($Config_IP)!=0){              $error['Config_IP']       = 'error/Edita Config IP, contiene palabras no permitidas'; }	
	if(isset($Config_Puerto)&&contar_palabras_censuradas($Config_Puerto)!=0){      $error['Config_Puerto']   = 'error/Edita Config Puerto, contiene palabras no permitidas'; }	
	if(isset($Config_Web)&&contar_palabras_censuradas($Config_Web)!=0){            $error['Config_Web']      = 'error/Edita Config Web, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'grupo_insert':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seguridad_camaras_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                    $a  = "'".$idSistema."'" ;            }else{$a  ="''";}
				if(isset($idEstado) && $idEstado != ''){                      $a .= ",'".$idEstado."'" ;            }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                          $a .= ",'".$Nombre."'" ;              }else{$a .=",''";}
				if(isset($idPais) && $idPais != ''){                          $a .= ",'".$idPais."'" ;              }else{$a .=",''";}
				if(isset($idCiudad) && $idCiudad != ''){                      $a .= ",'".$idCiudad."'" ;            }else{$a .=",''";}
				if(isset($idComuna) && $idComuna != ''){                      $a .= ",'".$idComuna."'" ;            }else{$a .=",''";}
				if(isset($Direccion) && $Direccion != ''){                    $a .= ",'".$Direccion."'" ;           }else{$a .=",''";}
				if(isset($N_Camaras) && $N_Camaras != ''){                    $a .= ",'".$N_Camaras."'" ;           }else{$a .=",''";}
				if(isset($idSubconfiguracion) && $idSubconfiguracion != ''){  $a .= ",'".$idSubconfiguracion."'" ;  }else{$a .=",''";}
				if(isset($idTipoCamara) && $idTipoCamara != ''){              $a .= ",'".$idTipoCamara."'" ;        }else{$a .=",''";}
				if(isset($Config_usuario) && $Config_usuario != ''){          $a .= ",'".$Config_usuario."'" ;      }else{$a .=",''";}
				if(isset($Config_Password) && $Config_Password != ''){        $a .= ",'".$Config_Password."'" ;     }else{$a .=",''";}
				if(isset($Config_IP) && $Config_IP != ''){                    $a .= ",'".$Config_IP."'" ;           }else{$a .=",''";}
				if(isset($Config_Puerto) && $Config_Puerto != ''){            $a .= ",'".$Config_Puerto."'" ;       }else{$a .=",''";}
				if(isset($Config_Web) && $Config_Web != ''){                  $a .= ",'".$Config_Web."'" ;          }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `seguridad_camaras_listado` (idSistema, idEstado, Nombre, idPais,
				idCiudad, idComuna, Direccion, N_Camaras, idSubconfiguracion, idTipoCamara,
				Config_usuario, Config_Password, Config_IP, Config_Puerto, Config_Web) 
				VALUES (".$a.")";
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if($resultado){
					
					//recibo el último id generado por mi sesion
					$ultimo_id = mysqli_insert_id($dbConn);
					
					//Se crean las nuevas camaras
					for ($i = 1; $i <= $N_Camaras; $i++) {
						
						//filtros
						if(isset($ultimo_id) && $ultimo_id != ''){    $a  = "'".$ultimo_id."'" ;   }else{$a  ="''";}
						$a .= ",'1'" ;
						$a .= ",'Camara ".$i."'" ;
						
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `seguridad_camaras_listado_canales` (idCamara, idEstado, Nombre) 
						VALUES (".$a.")";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);
					}
					
					
						
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
		case 'grupo_update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)&&isset($idCamara)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seguridad_camaras_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idCamara!='".$idCamara."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCamara='".$idCamara."'" ;
				if(isset($idSistema) && $idSistema != ''){                      $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                        $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){                            $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idPais) && $idPais != ''){                            $a .= ",idPais='".$idPais."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){                        $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){                        $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){                      $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($N_Camaras) && $N_Camaras != ''){                      $a .= ",N_Camaras='".$N_Camaras."'" ;}
				if(isset($idSubconfiguracion) && $idSubconfiguracion != ''){    $a .= ",idSubconfiguracion='".$idSubconfiguracion."'" ;}
				if(isset($idTipoCamara) && $idTipoCamara != ''){                $a .= ",idTipoCamara='".$idTipoCamara."'" ;}
				if(isset($Config_usuario) && $Config_usuario != ''){            $a .= ",Config_usuario='".$Config_usuario."'" ;}
				if(isset($Config_Password) && $Config_Password != ''){          $a .= ",Config_Password='".$Config_Password."'" ;}
				if(isset($Config_IP) && $Config_IP != ''){                      $a .= ",Config_IP='".$Config_IP."'" ;}
				if(isset($Config_Puerto) && $Config_Puerto != ''){              $a .= ",Config_Puerto='".$Config_Puerto."'" ;}
				if(isset($Config_Web) && $Config_Web != ''){                    $a .= ",Config_Web='".$Config_Web."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `seguridad_camaras_listado` SET ".$a." WHERE idCamara = '$idCamara'";
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
		case 'grupo_del':	
			
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
				$resultado_1 = db_delete_data (false, 'seguridad_camaras_listado', 'idCamara = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'seguridad_camaras_listado_canales', 'idCamara = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado_1==true OR $resultado_2==true){
					
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
		case 'grupo_estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idCamara   = $_GET['id'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			$query  = "UPDATE seguridad_camaras_listado SET idEstado = '".$idEstado."'	
			WHERE idCamara = '".$idCamara."'";
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
		case 'camara_insert':
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idCamara)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seguridad_camaras_listado_canales', '', "Nombre='".$Nombre."' AND idCamara='".$idCamara."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idCamara) && $idCamara != ''){                $a  = "'".$idCamara."'" ;             }else{$a  ="''";}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",'".$idEstado."'" ;            }else{$a .=",''";}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",'".$Nombre."'" ;              }else{$a .=",''";}
				if(isset($idTipoCamara) && $idTipoCamara != ''){        $a .= ",'".$idTipoCamara."'" ;        }else{$a .=",''";}
				if(isset($Config_usuario) && $Config_usuario != ''){    $a .= ",'".$Config_usuario."'" ;      }else{$a .=",''";}
				if(isset($Config_Password) && $Config_Password != ''){  $a .= ",'".$Config_Password."'" ;     }else{$a .=",''";}
				if(isset($Config_IP) && $Config_IP != ''){              $a .= ",'".$Config_IP."'" ;           }else{$a .=",''";}
				if(isset($Config_Puerto) && $Config_Puerto != ''){      $a .= ",'".$Config_Puerto."'" ;       }else{$a .=",''";}
				if(isset($Config_Web) && $Config_Web != ''){            $a .= ",'".$Config_Web."'" ;          }else{$a .=",''";}
				if(isset($Chanel) && $Chanel != ''){                    $a .= ",'".$Chanel."'" ;              }else{$a .=",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `seguridad_camaras_listado_canales` (idCamara, idEstado, Nombre,idTipoCamara,
				Config_usuario, Config_Password, Config_IP, Config_Puerto, Config_Web, Chanel) 
				VALUES (".$a.")";
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
		case 'camara_update':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idCamara)&&isset($idCanal)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'seguridad_camaras_listado_canales', '', "Nombre='".$Nombre."' AND idCamara='".$idCamara."' AND idCanal!='".$idCanal."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idCanal='".$idCanal."'" ;
				if(isset($idCamara) && $idCamara != ''){                $a .= ",idCamara='".$idCamara."'" ;}
				if(isset($idEstado) && $idEstado != ''){                $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){                    $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idTipoCamara) && $idTipoCamara != ''){        $a .= ",idTipoCamara='".$idTipoCamara."'" ;}
				if(isset($Config_usuario) && $Config_usuario != ''){    $a .= ",Config_usuario='".$Config_usuario."'" ;}
				if(isset($Config_Password) && $Config_Password != ''){  $a .= ",Config_Password='".$Config_Password."'" ;}
				if(isset($Config_IP) && $Config_IP != ''){              $a .= ",Config_IP='".$Config_IP."'" ;}
				if(isset($Config_Puerto) && $Config_Puerto != ''){      $a .= ",Config_Puerto='".$Config_Puerto."'" ;}
				if(isset($Config_Web) && $Config_Web != ''){            $a .= ",Config_Web='".$Config_Web."'" ;}
				if(isset($Chanel) && $Chanel != ''){                    $a .= ",Chanel='".$Chanel."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `seguridad_camaras_listado_canales` SET ".$a." WHERE idCanal = '$idCanal'";
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
		case 'camara_del':
		
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Variable
			$errorn = 0;
			
			//verifico si se envia un entero
			if((!validarNumero($_GET['del_camara']) OR !validaEntero($_GET['del_camara']))&&$_GET['del_camara']!=''){
				$indice = simpleDecode($_GET['del_camara'], fecha_actual());
			}else{
				$indice = $_GET['del_camara'];
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
				$resultado = db_delete_data (false, 'seguridad_camaras_listado_canales', 'idCanal = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
	}
?>
