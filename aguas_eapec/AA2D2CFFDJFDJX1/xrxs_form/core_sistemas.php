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
	if ( !empty($_POST['idSistema']) )          $idSistema         = $_POST['idSistema'];
	if ( !empty($_POST['Nombre']) )             $Nombre            = $_POST['Nombre'];
	if ( !empty($_POST['imgLogo']) )            $imgLogo           = $_POST['imgLogo'];
	if ( !empty($_POST['email_principal']) )    $email_principal   = $_POST['email_principal'];
	if ( !empty($_POST['Rut']) )                $Rut               = $_POST['Rut'];
	if ( !empty($_POST['Direccion']) )          $Direccion         = $_POST['Direccion'];
	if ( !empty($_POST['Fono']) )               $Fono              = $_POST['Fono'];
	if ( !empty($_POST['Ciudad']) )             $Ciudad            = $_POST['Ciudad'];
	if ( !empty($_POST['Comuna']) )             $Comuna            = $_POST['Comuna'];
	if ( !empty($_POST['idTheme']) )            $idTheme           = $_POST['idTheme'];
	if ( !empty($_POST['Fax']) )                $Fax               = $_POST['Fax'];
	if ( !empty($_POST['Web']) )                $Web               = $_POST['Web'];
	if ( !empty($_POST['Rubro']) )              $Rubro             = $_POST['Rubro'];
	if ( !empty($_POST['Contacto']) )           $Contacto          = $_POST['Contacto'];
	if ( !empty($_POST['NombreContrato']) )     $NombreContrato    = $_POST['NombreContrato'];
	if ( !empty($_POST['NContrato']) )          $NContrato         = $_POST['NContrato'];
	if ( !empty($_POST['FContrato']) )          $FContrato         = $_POST['FContrato'];
	if ( !empty($_POST['DContrato']) )          $DContrato         = $_POST['DContrato'];
	if ( !empty($_POST['Bodega_OT']) )          $Bodega_OT         = $_POST['Bodega_OT'];
	if ( !empty($_POST['idRubro']) )            $idRubro           = $_POST['idRubro'];
	if ( !empty($_POST['Wheater']) )            $Wheater           = $_POST['Wheater'];
	if ( !empty($_POST['valorCargoFijo']) )     $valorCargoFijo    = $_POST['valorCargoFijo'];
	if ( !empty($_POST['valorAgua']) )          $valorAgua         = $_POST['valorAgua'];
	if ( !empty($_POST['valorRecoleccion']) )   $valorRecoleccion  = $_POST['valorRecoleccion'];
	if ( !empty($_POST['valorVisitaCorte']) )   $valorVisitaCorte  = $_POST['valorVisitaCorte'];
	if ( !empty($_POST['valorCorte1']) )        $valorCorte1       = $_POST['valorCorte1'];
	if ( !empty($_POST['valorCorte2']) )        $valorCorte2       = $_POST['valorCorte2'];
	if ( !empty($_POST['valorReposicion1']) )   $valorReposicion1  = $_POST['valorReposicion1'];
	if ( !empty($_POST['valorReposicion2']) )   $valorReposicion2  = $_POST['valorReposicion2'];
	if ( !empty($_POST['NdiasPago']) )          $NdiasPago         = $_POST['NdiasPago'];
	if ( !empty($_POST['Fac_nEmergencia']) )    $Fac_nEmergencia   = $_POST['Fac_nEmergencia'];
	if ( !empty($_POST['Fac_nConsultas']) )     $Fac_nConsultas    = $_POST['Fac_nConsultas'];
	
	
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
			case 'idSistema':        if(empty($idSistema)){         $error['idSistema']        = 'error/No ha ingresado el id';}break;
			case 'Nombre':           if(empty($Nombre)){            $error['Nombre']           = 'error/No ha ingresado el nombre del sistema';}break;
			case 'imgLogo':          if(empty($imgLogo)){           $error['imgLogo']          = 'error/No ha ingresado el logo del sistema';}break;
			case 'email_principal':  if(empty($email_principal)){   $error['email_principal']  = 'error/No ha ingresado el email del sistema';}break;
			case 'Rut':              if(empty($Rut)){               $error['Rut']              = 'error/No ha ingresado el rut del sistema';}break;
			case 'Direccion':        if(empty($Direccion)){         $error['Direccion']        = 'error/No ha ingresado la direccion del sistema';}break;
			case 'Fono':             if(empty($Fono)){              $error['Fono']             = 'error/No ha ingresado el fono del sistema';}break;
			case 'Ciudad':           if(empty($Ciudad)){            $error['Ciudad']           = 'error/No ha seleccionado la ciudad del sistema';}break;
			case 'Comuna':           if(empty($Comuna)){            $error['Comuna']           = 'error/No ha seleccionado la comuna del sistema';}break;
			case 'idTheme':          if(empty($idTheme)){           $error['idTheme']          = 'error/No ha ingresado el tema del sistema';}break;	
			case 'Fax':              if(empty($Fax)){               $error['Fax']              = 'error/No ha ingresado el fax del sistema';}break;	
			case 'Web':              if(empty($Web)){               $error['Web']              = 'error/No ha ingresado la pagina web del sistema';}break;	
			case 'Rubro':            if(empty($Rubro)){             $error['Rubro']            = 'error/No ha ingresado el rubro del sistema';}break;	
			case 'Contacto':         if(empty($Contacto)){          $error['Contacto']         = 'error/No ha ingresado el contacto del sistema';}break;	
			case 'NombreContrato':   if(empty($NombreContrato)){    $error['NombreContrato']   = 'error/No ha ingresado el nombre de contrato del sistema';}break;	
			case 'NContrato':        if(empty($NContrato)){         $error['NContrato']        = 'error/No ha ingresado el numero de contrato del sistema';}break;	
			case 'FContrato':        if(empty($FContrato)){         $error['FContrato']        = 'error/No ha ingresado la fecha de contrato del sistema';}break;	
			case 'DContrato':        if(empty($DContrato)){         $error['DContrato']        = 'error/No ha ingresado duracion del contrato del sistema';}break;	
			case 'idRubro':          if(empty($idRubro)){           $error['idRubro']          = 'error/No ha seleccionado el rubro del sistema';}break;
			case 'Wheater':          if(empty($Wheater)){           $error['Wheater']          = 'error/No ha ingresado la direccion del pronostico del tiempo';}break;
			case 'valorCargoFijo':   if(empty($valorCargoFijo)){    $error['valorCargoFijo']   = 'error/No ha ingresado el valor del cargo fijo';}break;
			case 'valorAgua':        if(empty($valorAgua)){         $error['valorAgua']        = 'error/No ha ingresado el valor del metro cubico del agua';}break;
			case 'valorRecoleccion': if(empty($valorRecoleccion)){  $error['valorRecoleccion'] = 'error/No ha ingresado el valor del metro cubico de recoleccion';}break;
			case 'valorVisitaCorte': if(empty($valorVisitaCorte)){  $error['valorVisitaCorte'] = 'error/No ha ingresado el valor de la visita';}break;
			case 'valorCorte1':      if(empty($valorCorte1)){       $error['valorCorte1']      = 'error/No ha ingresado el valor del corte';}break;
			case 'valorCorte2':      if(empty($valorCorte2)){       $error['valorCorte2']      = 'error/No ha ingresado el valor del corte';}break;
			case 'valorReposicion1': if(empty($valorReposicion1)){  $error['valorReposicion1'] = 'error/No ha ingresado el valor de la reposicion';}break;
			case 'valorReposicion2': if(empty($valorReposicion2)){  $error['valorReposicion2'] = 'error/No ha ingresado el valor de la reposicion';}break;
			case 'NdiasPago':        if(empty($NdiasPago)){         $error['NdiasPago']        = 'error/No ha ingresado el valor de la reposicion';}break;
			case 'Fac_nEmergencia':  if(empty($Fac_nEmergencia)){   $error['Fac_nEmergencia']  = 'error/No ha ingresado el valor de la reposicion';}break;
			case 'Fac_nConsultas':   if(empty($Fac_nConsultas)){    $error['Fac_nConsultas']   = 'error/No ha ingresado el valor de la reposicion';}break;
			
		}
	}
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	//Verifica si el mail corresponde
	if(isset($email_principal)){if(validaremail($email_principal)){ }else{   $error['email_principal']   = 'error/El Email ingresado no es valido'; }}	
	if(isset($Fono)){if (validarnumero($Fono)) {                             $error['Fono']	   = 'error/Ingrese un numero telefonico valido'; }}
	if(isset($Rut)){if(RutValidate($Rut)==0){                                $error['Rut']     = 'error/El Rut ingresado no es valido'; }}
	
	
	
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
				$sql_usuario = mysqli_query("SELECT Nombre FROM core_sistemas WHERE Nombre='".$Nombre."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El nombre del sistema ya existe';}
			
			
			// se verifica si el correo ya existe
			if(isset($Rut)){
				$sql_email = mysqli_query("SELECT Rut FROM core_sistemas WHERE Rut='".$Rut."'  ");
				$n2 = mysqli_num_rows($sql_email);
			} else {$n2=0;}
			if($n2 > 0) {$error['Rut'] = 'error/El Rut ya existe en el sistema';}
			
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//filtros
				if(isset($Nombre) && $Nombre != ''){                        $a = "'".$Nombre."'" ;               }else{$a ="''";}
				if(isset($imgLogo) && $imgLogo != ''){                      $a .= ",'".$imgLogo."'" ;            }else{$a .= ",''";}
				if(isset($email_principal) && $email_principal != ''){      $a .= ",'".$email_principal."'" ;    }else{$a .= ",''";}
				if(isset($Rut) && $Rut != ''){                              $a .= ",'".$Rut."'" ;                }else{$a .= ",''";}
				if(isset($Direccion) && $Direccion != ''){                  $a .= ",'".$Direccion."'" ;          }else{$a .= ",''";}
				if(isset($Fono) && $Fono != ''){                            $a .= ",'".$Fono."'" ;               }else{$a .= ",''";}
				if(isset($Ciudad) && $Ciudad != ''){                        $a .= ",'".$Ciudad."'" ;             }else{$a .= ",''";}
				if(isset($Comuna) && $Comuna != ''){                        $a .= ",'".$Comuna."'" ;             }else{$a .= ",''";}
				if(isset($idTheme) && $idTheme != ''){                      $a .= ",'".$idTheme."'" ;            }else{$a .= ",''";}
				if(isset($Fax) && $Fax != ''){                              $a .= ",'".$Fax."'" ;                }else{$a .= ",''";}
				if(isset($Web) && $Web != ''){                              $a .= ",'".$Web."'" ;                }else{$a .= ",''";}
				if(isset($Rubro) && $Rubro != ''){                          $a .= ",'".$Rubro."'" ;              }else{$a .= ",''";}
				if(isset($Contacto) && $Contacto != ''){                    $a .= ",'".$Contacto."'" ;           }else{$a .= ",''";}
				if(isset($NombreContrato) && $NombreContrato != ''){        $a .= ",'".$NombreContrato."'" ;     }else{$a .= ",''";}
				if(isset($NContrato) && $NContrato != ''){                  $a .= ",'".$NContrato."'" ;          }else{$a .= ",''";}
				if(isset($FContrato) && $FContrato != ''){                  $a .= ",'".$FContrato."'" ;          }else{$a .= ",''";}
				if(isset($DContrato) && $DContrato != ''){                  $a .= ",'".$DContrato."'" ;          }else{$a .= ",''";}
				if(isset($idRubro) && $idRubro != ''){                      $a .= ",'".$idRubro."'" ;            }else{$a .=",''";}
				if(isset($Wheater) && $Wheater != ''){                      $a .= ",'".$Wheater."'" ;            }else{$a .=",''";}
				if(isset($valorCargoFijo) && $valorCargoFijo != ''){        $a .= ",'".$valorCargoFijo."'" ;     }else{$a .=",''";}
				if(isset($valorAgua) && $valorAgua != ''){                  $a .= ",'".$valorAgua."'" ;          }else{$a .=",''";}
				if(isset($valorRecoleccion) && $valorRecoleccion != ''){    $a .= ",'".$valorRecoleccion."'" ;   }else{$a .=",''";}
				if(isset($valorVisitaCorte) && $valorVisitaCorte != ''){    $a .= ",'".$valorVisitaCorte."'" ;   }else{$a .=",''";}
				if(isset($valorCorte1) && $valorCorte1 != ''){              $a .= ",'".$valorCorte1."'" ;        }else{$a .=",''";}
				if(isset($valorCorte2) && $valorCorte2 != ''){              $a .= ",'".$valorCorte2."'" ;        }else{$a .=",''";}
				if(isset($valorReposicion1) && $valorReposicion1 != ''){    $a .= ",'".$valorReposicion1."'" ;   }else{$a .=",''";}
				if(isset($valorReposicion2) && $valorReposicion2 != ''){    $a .= ",'".$valorReposicion2."'" ;   }else{$a .=",''";}
				if(isset($NdiasPago) && $NdiasPago != ''){                  $a .= ",'".$NdiasPago."'" ;          }else{$a .=",''";}
				if(isset($Fac_nEmergencia) && $Fac_nEmergencia != ''){      $a .= ",'".$Fac_nEmergencia."'" ;    }else{$a .=",''";}
				if(isset($Fac_nConsultas) && $Fac_nConsultas != ''){        $a .= ",'".$Fac_nConsultas."'" ;     }else{$a .=",''";}
				
				
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `core_sistemas` (Nombre, imgLogo, email_principal, Rut, 
				Direccion, Fono, Ciudad, Comuna, idTheme,Fax, Web, Rubro, Contacto, NombreContrato,NContrato,
				FContrato,DContrato,idRubro, Wheater, valorCargoFijo,valorAgua, valorRecoleccion,
				valorVisitaCorte, valorCorte1, valorCorte2, valorReposicion1, valorReposicion2,NdiasPago,
				Fac_nEmergencia, Fac_nConsultas) 
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
				$a = "idSistema='".$idSistema."'" ;
				if(isset($Nombre) && $Nombre != ''){                        $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($imgLogo) && $imgLogo != ''){                      $a .= ",imgLogo='".$imgLogo."'" ;}
				if(isset($email_principal) && $email_principal != ''){      $a .= ",email_principal='".$email_principal."'" ;}
				if(isset($Rut) && $Rut != ''){                              $a .= ",Rut='".$Rut."'" ;}
				if(isset($Direccion) && $Direccion != ''){                  $a .= ",Direccion='".$Direccion."'" ;}
				if(isset($Fono) && $Fono != ''){                            $a .= ",Fono='".$Fono."'" ;}
				if(isset($Ciudad) && $Ciudad != ''){                        $a .= ",Ciudad='".$Ciudad."'" ;}
				if(isset($Comuna) && $Comuna != ''){                        $a .= ",Comuna='".$Comuna."'" ;}
				if(isset($idTheme) && $idTheme != ''){                      $a .= ",idTheme='".$idTheme."'" ;}
				if(isset($Fax) && $Fax != ''){                              $a .= ",Fax='".$Fax."'" ;}
				if(isset($Web) && $Web != ''){                              $a .= ",Web='".$Web."'" ;}
				if(isset($Rubro) && $Rubro != ''){                          $a .= ",Rubro='".$Rubro."'" ;}
				if(isset($Contacto) && $Contacto != ''){                    $a .= ",Contacto='".$Contacto."'" ;}
				if(isset($NombreContrato) && $NombreContrato != ''){        $a .= ",NombreContrato='".$NombreContrato."'" ;}
				if(isset($NContrato) && $NContrato != ''){                  $a .= ",NContrato='".$NContrato."'" ;}
				if(isset($FContrato) && $FContrato != ''){                  $a .= ",FContrato='".$FContrato."'" ;}
				if(isset($DContrato) && $DContrato != ''){                  $a .= ",DContrato='".$DContrato."'" ;}
				if(isset($idRubro) && $idRubro != ''){                      $a .= ",idRubro='".$idRubro."'" ;}
				if(isset($Wheater) && $Wheater != ''){                      $a .= ",Wheater='".$Wheater."'" ;}
				if(isset($valorCargoFijo) && $valorCargoFijo != ''){        $a .= ",valorCargoFijo='".$valorCargoFijo."'" ;}
				if(isset($valorAgua) && $valorAgua != ''){                  $a .= ",valorAgua='".$valorAgua."'" ;}
				if(isset($valorRecoleccion) && $valorRecoleccion != ''){    $a .= ",valorRecoleccion='".$valorRecoleccion."'" ;}
				if(isset($valorVisitaCorte) && $valorVisitaCorte != ''){    $a .= ",valorVisitaCorte='".$valorVisitaCorte."'" ;}
				if(isset($valorCorte1) && $valorCorte1 != ''){              $a .= ",valorCorte1='".$valorCorte1."'" ;}
				if(isset($valorCorte2) && $valorCorte2 != ''){              $a .= ",valorCorte2='".$valorCorte2."'" ;}
				if(isset($valorReposicion1) && $valorReposicion1 != ''){    $a .= ",valorReposicion1='".$valorReposicion1."'" ;}
				if(isset($valorReposicion2) && $valorReposicion2 != ''){    $a .= ",valorReposicion2='".$valorReposicion2."'" ;}
				if(isset($NdiasPago) && $NdiasPago != ''){                  $a .= ",NdiasPago='".$NdiasPago."'" ;}
				if(isset($Fac_nEmergencia) && $Fac_nEmergencia != ''){      $a .= ",Fac_nEmergencia='".$Fac_nEmergencia."'" ;}
				if(isset($Fac_nConsultas) && $Fac_nConsultas != ''){        $a .= ",Fac_nConsultas='".$Fac_nConsultas."'" ;}
				
				//calculo valores netos
				if(isset($valorCargoFijo) && $valorCargoFijo != ''){       $a .= ",valorCargoFijoNeto='".($valorCargoFijo / 1.19)."'" ;}
				if(isset($valorAgua) && $valorAgua != ''){                 $a .= ",valorAguaNeto='".($valorAgua / 1.19)."'" ;}
				if(isset($valorRecoleccion) && $valorRecoleccion != ''){   $a .= ",valorRecoleccionNeto='".($valorRecoleccion / 1.19)."'" ;}
				if(isset($valorVisitaCorte) && $valorVisitaCorte != ''){   $a .= ",valorVisitaCorteNeto='".($valorVisitaCorte / 1.19)."'" ;}
				if(isset($valorCorte1) && $valorCorte1 != ''){             $a .= ",valorCorte1Neto='".($valorCorte1 / 1.19)."'" ;}
				if(isset($valorCorte2) && $valorCorte2 != ''){             $a .= ",valorCorte2Neto='".($valorCorte2 / 1.19)."'" ;}
				if(isset($valorReposicion1) && $valorReposicion1 != ''){   $a .= ",valorReposicion1Neto='".($valorReposicion1 / 1.19)."'" ;}
				if(isset($valorReposicion2) && $valorReposicion2 != ''){   $a .= ",valorReposicion2Neto='".($valorReposicion2 / 1.19)."'" ;}

				
				// inserto los datos de registro en la db
				$query  = "UPDATE `core_sistemas` SET ".$a." WHERE idSistema = '$idSistema'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
			}
		
	
		break;	

						
/*******************************************************************************************************************/
		case 'del':	

			// Se obtiene el nombre del logo
			$query = "SELECT imgLogo
			FROM `core_sistemas`
			WHERE idSistema = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			if(unlink('upload/'.$rowdata['imgLogo'])&&isset($rowdata['imgLogo'])&&$rowdata['imgLogo']!=''){
					
				//se borran los permisos del usuario
				$query  = "DELETE FROM `core_sistemas` WHERE idSistema = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);	
							
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}else{

				//se borran los permisos del usuario
				$query  = "DELETE FROM `core_sistemas` WHERE idSistema = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);	
							
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}

		break;							
/*******************************************************************************************************************/
		case 'submit_img':	

			if ($_FILES["imgLogo"]["error"] > 0){
				$error['imgLogo']       = 'error/Ha ocurrido un error';
			} else {
				//Se verifican las extensiones de los archivos
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				//Se verifica que el archivo subido no exceda los 100 kb
				$limite_kb = 1000;
				//Sufijo
				$sufijo = 'logos_';
				  
				if (in_array($_FILES['imgLogo']['type'], $permitidos) && $_FILES['imgLogo']['size'] <= $limite_kb * 1024){
					//Se especifica carpeta de destino
					$ruta = "upload/".$sufijo.$_FILES['imgLogo']['name'];
					//Se verifica que el archivo un archivo con el mismo nombre no existe
					if (!file_exists($ruta)){
						//Se mueve el archivo a la carpeta previamente configurada
						$resultado = @move_uploaded_file($_FILES["imgLogo"]["tmp_name"], $ruta);
						if ($resultado){
								
							//Filtro para idSistema
							if ( !empty($_POST['idSistema']) )    $idSistema       = $_POST['idSistema'];
									
							$a = "idSistema='".$idSistema."'" ;
							$a .= ",imgLogo='".$sufijo.$_FILES['imgLogo']['name']."'" ;

							// inserto los datos de registro en la db
							$query  = "UPDATE `core_sistemas` SET ".$a." WHERE idSistema = '$idSistema'";
							$result = mysqli_query($dbConn, $query);
									
							header( 'Location: '.$location.'&img_id='.$idSistema );
							die;
									
									
						} else {
							$error['imgLogo']       = 'error/Ocurrio un error al mover el archivo';
						}
					} else {
						$error['imgLogo']       = 'error/El archivo '.$_FILES['imgLogo']['name'].' ya existe';
					}
				} else {
					$error['imgLogo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
				}
			}

		break;
/*******************************************************************************************************************/
		case 'del_img':	

			// Se obtiene el nombre del logo
			$query = "SELECT imgLogo
			FROM `core_sistemas`
			WHERE idSistema = {$_GET['del_img']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			if(unlink('upload/'.$rowdata['imgLogo'])&&isset($rowdata['imgLogo'])&&$rowdata['imgLogo']!=''){	
					
				// actualizo los datos de registro en la db
				$query  = "UPDATE `core_sistemas` SET imgLogo='' WHERE idSistema = '{$_GET['del_img']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo			
				header( 'Location: '.$location.'&img_id='.$_GET['del_img'] );
				die;

			}else{

				// actualizo los datos de registro en la db
				$query  = "UPDATE `core_sistemas` SET imgLogo='' WHERE idSistema = '{$_GET['del_img']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo				
				header( 'Location: '.$location.'&img_id='.$_GET['del_img'] );
				die;

			}

		break;		
/*******************************************************************************************************************/
	}
?>
