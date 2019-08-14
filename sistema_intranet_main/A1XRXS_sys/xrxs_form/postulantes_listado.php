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
	if ( !empty($_POST['idPostulante']) )                $idPostulante                 = $_POST['idPostulante'];
	if ( !empty($_POST['idSistema']) )                   $idSistema                    = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )                    $idEstado                     = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )                      $Nombre                       = $_POST['Nombre'];
	if ( !empty($_POST['ApellidoPat']) )                 $ApellidoPat                  = $_POST['ApellidoPat'];
	if ( !empty($_POST['ApellidoMat']) )                 $ApellidoMat                  = $_POST['ApellidoMat'];
	if ( !empty($_POST['idSexo']) )                      $idSexo                       = $_POST['idSexo'];
	if ( !empty($_POST['FNacimiento']) )                 $FNacimiento                  = $_POST['FNacimiento'];
	if ( !empty($_POST['idEstadoCivil']) )               $idEstadoCivil                = $_POST['idEstadoCivil'];
	if ( !empty($_POST['Fono1']) )                       $Fono1                        = $_POST['Fono1'];
	if ( !empty($_POST['Fono2']) )                       $Fono2                        = $_POST['Fono2'];
	if ( !empty($_POST['Rut']) )                         $Rut                          = $_POST['Rut'];
	if ( !empty($_POST['idCiudad']) )                    $idCiudad                     = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )                    $idComuna                     = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )                   $Direccion                    = $_POST['Direccion'];
	if ( !empty($_POST['Observaciones']) )               $Observaciones                = $_POST['Observaciones'];
	if ( !empty($_POST['SueldoLiquido']) )               $SueldoLiquido                = $_POST['SueldoLiquido'];
	if ( !empty($_POST['idTipoLicencia']) )              $idTipoLicencia               = $_POST['idTipoLicencia'];

	
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
			case 'idPostulante':                if(empty($idPostulante)){                 $error['idPostulante']                 = 'error/No ha ingresado el id';}break;
			case 'idSistema':                   if(empty($idSistema)){                    $error['idSistema']                    = 'error/No ha seleccionado el sistema al cual pertenece';}break;
			case 'idEstado':                    if(empty($idEstado)){                     $error['idEstado']                     = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':                      if(empty($Nombre)){                       $error['Nombre']                       = 'error/No ha ingresado el nombre de la persona';}break;
			case 'ApellidoPat':                 if(empty($ApellidoPat)){                  $error['ApellidoPat']                  = 'error/No ha ingresado el apellido paterno de la persona';}break;
			case 'ApellidoMat':                 if(empty($ApellidoMat)){                  $error['ApellidoMat']                  = 'error/No ha ingresado el apellido materno de la persona';}break;
			case 'idSexo':                      if(empty($idSexo)){                       $error['idSexo']                       = 'error/No ha seleccionado el sexo';}break;
			case 'FNacimiento':                 if(empty($FNacimiento)){                  $error['FNacimiento']                  = 'error/No ha ingresado la fecha de nacimiento';}break;
			case 'idEstadoCivil':               if(empty($idEstadoCivil)){                $error['idEstadoCivil']                = 'error/No ha seleccionado estado civil';}break;
			case 'Fono1':                       if(empty($Fono1)){                        $error['Fono1']                        = 'error/No ha ingresado el fono';}break;
			case 'Fono2':                       if(empty($Fono2)){                        $error['Fono2']                        = 'error/No ha ingresado el fono';}break;
			case 'Rut':                         if(empty($Rut)){                          $error['Rut']                          = 'error/No ha ingresado el rut';}break;
			case 'idCiudad':                    if(empty($idCiudad)){                     $error['idCiudad']                     = 'error/No ha seleccionado la ciudad';}break;
			case 'idComuna':                    if(empty($idComuna)){                     $error['idComuna']                     = 'error/No ha seleccionado la comuna';}break;
			case 'Direccion':                   if(empty($Direccion)){                    $error['Direccion']                    = 'error/No ha ingresado la direccion';}break;
			case 'Observaciones':               if(empty($Observaciones)){                $error['Observaciones']                = 'error/No ha ingresado la observacion';}break;
			case 'SueldoLiquido':               if(empty($SueldoLiquido)){                $error['SueldoLiquido']                = 'error/No ha ingresado el sueldo liquido a pago';}break;
			case 'idTipoLicencia':              if(empty($idTipoLicencia)){               $error['idTipoLicencia']               = 'error/No ha Seleccionado el tipo de licencia';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($Fono1)){if(validarnumero($Fono1)) {     $error['Fono1']   = 'error/Ingrese un numero telefonico valido'; }}
	if(isset($Fono2)){if(validarnumero($Fono2)) {     $error['Fono2']   = 'error/Ingrese un numero telefonico valido'; }}
	//if(isset($Rut)){if(RutValidate($Rut)==0){       $error['Rut']    = 'error/El Rut ingresado no es valido'; }}

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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idSistema)){
				$ndata_1 = db_select_nrows ('Nombre', 'postulantes_listado', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idSistema='".$idSistema."'", $dbConn);
			}
			if(isset($Rut)&&isset($idSistema)){
				$ndata_2 = db_select_nrows ('Rut', 'postulantes_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Postulante que intenta ingresar ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){                                      $a  = "'".$idSistema."'" ;                     }else{$a  = "''";}
				if(isset($idEstado) && $idEstado != ''){                                        $a .= ",'".$idEstado."'" ;                     }else{$a .= ",''";}
				if(isset($Nombre) && $Nombre != ''){                                            $a .= ",'".$Nombre."'" ;                       }else{$a .= ",''";}
				if(isset($ApellidoPat) && $ApellidoPat != ''){                                  $a .= ",'".$ApellidoPat."'" ;                  }else{$a .= ",''";}
				if(isset($ApellidoMat) && $ApellidoMat != ''){                                  $a .= ",'".$ApellidoMat."'" ;                  }else{$a .= ",''";}
				if(isset($idSexo) && $idSexo != ''){                                            $a .= ",'".$idSexo."'" ;                       }else{$a .= ",''";}
				if(isset($FNacimiento) && $FNacimiento != ''){                                  $a .= ",'".$FNacimiento."'" ;                  }else{$a .= ",''";}
				if(isset($idEstadoCivil) && $idEstadoCivil != ''){                              $a .= ",'".$idEstadoCivil."'" ;                }else{$a .= ",''";}
				if(isset($Fono1) && $Fono1 != ''){                                              $a .= ",'".$Fono1."'" ;                        }else{$a .= ",''";}
				if(isset($Fono2) && $Fono2 != ''){                                              $a .= ",'".$Fono2."'" ;                        }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                                                  $a .= ",'".$Rut."'" ;                          }else{$a .= ",''";}
				if(isset($idCiudad) && $idCiudad != ''){                                        $a .= ",'".$idCiudad."'" ;                     }else{$a .= ",''";}
				if(isset($idComuna) && $idComuna != ''){                                        $a .= ",'".$idComuna."'" ;                     }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                                      $a .= ",'".$Direccion."'" ;                    }else{$a .= ",''";}
				if(isset($Observaciones) && $Observaciones != ''){                              $a .= ",'".$Observaciones."'" ;                }else{$a .= ",''";}
				if(isset($SueldoLiquido) && $SueldoLiquido != ''){                              $a .= ",'".$SueldoLiquido."'" ;                }else{$a .= ",''";}
				if(isset($idTipoLicencia) && $idTipoLicencia != ''){                            $a .= ",'".$idTipoLicencia."'" ;               }else{$a .= ",''";}
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `postulantes_listado` (idSistema, idEstado, Nombre, ApellidoPat, 
				ApellidoMat,idSexo,FNacimiento, idEstadoCivil, Fono1, Fono2, Rut, idCiudad,
				idComuna, Direccion, Observaciones, SueldoLiquido, idTipoLicencia) 
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
			if(isset($Nombre)&&isset($ApellidoPat)&&isset($ApellidoMat)&&isset($idSistema)&&isset($idPostulante)){
				$ndata_1 = db_select_nrows ('Nombre', 'postulantes_listado', '', "Nombre='".$Nombre."' AND ApellidoPat='".$ApellidoPat."' AND ApellidoMat='".$ApellidoMat."' AND idSistema='".$idSistema."' AND idPostulante!='".$idPostulante."'", $dbConn);
			}
			if(isset($Rut)&&isset($idSistema)&&isset($idPostulante)){
				$ndata_2 = db_select_nrows ('Rut', 'postulantes_listado', '', "Rut='".$Rut."' AND idSistema='".$idSistema."' AND idPostulante!='".$idPostulante."'", $dbConn);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El trabajador que intenta ingresar ya existe en el sistema';}
			if($ndata_2 > 0) {$error['ndata_2'] = 'error/El Rut ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idPostulante='".$idPostulante."'" ;
				if(isset($idSistema) && $idSistema != ''){                                      $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){                                        $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){                                            $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($ApellidoPat) && $ApellidoPat != ''){                                  $a .= ",ApellidoPat='".$ApellidoPat."'" ;}
				if(isset($ApellidoMat) && $ApellidoMat != ''){                                  $a .= ",ApellidoMat='".$ApellidoMat."'" ;}
				if(isset($idSexo) && $idSexo != ''){                                            $a .= ",idSexo='".$idSexo."'" ;}
				if(isset($FNacimiento) && $FNacimiento != ''){                                  $a .= ",FNacimiento='".$FNacimiento."'" ;}
				if(isset($idEstadoCivil) && $idEstadoCivil != ''){                              $a .= ",idEstadoCivil='".$idEstadoCivil."'" ;}
				if(isset($Fono1) && $Fono1 != ''){                                              $a .= ",Fono1='".$Fono1."'" ;}
				if(isset($Fono2) && $Fono2 != ''){                                              $a .= ",Fono2='".$Fono2."'" ;}
				if(isset($Rut) && $Rut != ''){                                                  $a .= ",Rut='".$Rut."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){                                        $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){                                        $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){                                      $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Observaciones) && $Observaciones != ''){                              $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($SueldoLiquido) && $SueldoLiquido != ''){                              $a .= ",SueldoLiquido='".$SueldoLiquido."'" ;}
				if(isset($idTipoLicencia) && $idTipoLicencia != ''){                            $a .= ",idTipoLicencia='".$idTipoLicencia."'" ;}
				
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `postulantes_listado` SET ".$a." WHERE idPostulante = '$idPostulante'";
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
			$query = "SELECT File_Curriculum
			FROM `postulantes_listado`
			WHERE idPostulante = {$_GET['del']}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "DELETE FROM `postulantes_listado` WHERE idPostulante = {$_GET['del']}";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el curriculum
				if(isset($rowdata['File_Curriculum'])&&$rowdata['File_Curriculum']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['File_Curriculum'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['File_Curriculum']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}

				
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
		//Cambio el estado de activo a inactivo
		case 'estado':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			$idPostulante  = $_GET['id'];
			$idEstado      = $_GET['estado'];
			$query  = "UPDATE postulantes_listado SET idEstado = '$idEstado'	
			WHERE idPostulante    = '$idPostulante'";
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
		//Cambia el nivel del permiso
		case 'submit_curriculum':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			if ($_FILES["File_Curriculum"]["error"] > 0){ 
				$error['File_Curriculum']     = 'error/Ha ocurrido un error'; 
			} else {
			  //Se verifican las extensiones de los archivos
			  $permitidos = array("application/msword",
									"application/vnd.ms-word",
									"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
											
									"application/pdf",
									"application/octet-stream",
									"application/x-real",
									"application/vnd.adobe.xfdf",
									"application/vnd.fdf",
									"binary/octet-stream",
									
									"image/jpg", 
									"image/jpeg", 
									"image/gif", 
									"image/png"

											);
											
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 10000;
				//Sufijo
				$sufijo = 'post_curriculum_'.$idPostulante.'_';
			  
				if (in_array($_FILES['File_Curriculum']['type'], $permitidos) && $_FILES['File_Curriculum']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['File_Curriculum']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$move_result = @move_uploaded_file($_FILES["File_Curriculum"]["tmp_name"], $ruta);
						if ($move_result){
								
							//Filtro para idSistema
							$a = "File_Curriculum='".$sufijo.$_FILES['File_Curriculum']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `postulantes_listado` SET ".$a." WHERE idPostulante = '$idPostulante'";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if($resultado){
								
								header( 'Location: '.$location );
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
							$error['File_Curriculum']     = 'error/Ocurrio un error al mover el archivo'; 
						}
					} else {
						$error['File_Curriculum']     = 'error/El archivo '.$_FILES['File_Curriculum']['name'].' ya existe'; 
					}
				} else {
					$error['File_Curriculum']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
				}
			}


		break;	
/*******************************************************************************************************************/
		case 'del_File_Curriculum':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Usuario
			$idPostulante = $_GET['del_File_Curriculum'];
			// Se obtiene el nombre del logo
			$query = "SELECT File_Curriculum
			FROM `postulantes_listado`
			WHERE idPostulante = {$idPostulante}";
			$resultado = mysqli_query($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);
			
			//se borra el dato de la base de datos
			$query  = "UPDATE `postulantes_listado` SET File_Curriculum='' WHERE idPostulante = '{$idPostulante}'";
			//Consulta
			$resultado = mysqli_query ($dbConn, $query);
			//Si ejecuto correctamente la consulta
			if($resultado){
				
				//se elimina el archivo
				if(isset($rowdata['File_Curriculum'])&&$rowdata['File_Curriculum']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['File_Curriculum'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['File_Curriculum']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&id_img=true' );
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
