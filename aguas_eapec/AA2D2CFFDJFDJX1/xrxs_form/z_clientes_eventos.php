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
	if ( !empty($_POST['idEventos']) )       $idEventos       = $_POST['idEventos'];
	if ( !empty($_POST['idSistema']) )       $idSistema       = $_POST['idSistema'];
	if ( !empty($_POST['idCliente']) )       $idCliente       = $_POST['idCliente'];
	if ( !empty($_POST['idUsuario']) )       $idUsuario       = $_POST['idUsuario'];
	if ( !empty($_POST['idTipo']) )          $idTipo          = $_POST['idTipo'];
	if ( !empty($_POST['FechaEjecucion']) )  $FechaEjecucion  = $_POST['FechaEjecucion'];
	if ( !empty($_POST['Fecha']) )           $Fecha           = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )             $Dia             = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )           $idMes           = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )             $Ano             = $_POST['Ano'];
	if ( !empty($_POST['Observacion']) )     $Observacion     = $_POST['Observacion'];
	if ( !empty($_POST['NSello']) )          $NSello          = $_POST['NSello'];
	
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
			case 'idEventos':      if(empty($idEventos)){       $error['idEventos']         = 'error/No ha ingresado el id';}break;
			case 'idSistema':      if(empty($idSistema)){       $error['idSistema']         = 'error/No ha ingresado el sistema';}break;
			case 'idCliente':      if(empty($idCliente)){       $error['idCliente']         = 'error/No ha ingresado el cliente';}break;
			case 'idUsuario':      if(empty($idUsuario)){       $error['idUsuario']         = 'error/No ha ingresado la idUsuario';}break;
			case 'idTipo':         if(empty($idTipo)){          $error['idTipo']            = 'error/No ha ingresado el idTipo';}break;
			case 'FechaEjecucion': if(empty($FechaEjecucion)){  $error['FechaEjecucion']    = 'error/No ha ingresado la fecha de ejecucion';}break;
			case 'Fecha':          if(empty($Fecha)){           $error['Fecha']             = 'error/No ha ingresado la fecha de facturacion';}break;
			case 'Dia':            if(empty($Dia)){             $error['Dia']               = 'error/No ha ingresado el dia';}break;
			case 'idMes':          if(empty($idMes)){           $error['idMes']             = 'error/No ha ingresado el mes';}break;
			case 'Ano':            if(empty($Ano)){             $error['Ano']               = 'error/No ha ingresado el año';}break;
			case 'Observacion':    if(empty($Observacion)){     $error['Observacion']       = 'error/No ha ingresado la observacion';}break;
			case 'NSello':         if(empty($NSello)){          $error['NSello']            = 'error/No ha ingresado el numero de sello';}break;
			
		}
	}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los valores de los distintos eventos guardados en la base de datos
				$query = "SELECT valorVisitaCorte, valorCorte1, valorCorte2, valorReposicion1, valorReposicion2
				FROM `core_sistemas`
				WHERE idSistema = {$idSistema}";
				$resultado = mysqli_query ($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);	
				
				//Se verifica el ipo de evento
				$valor_evento = 0;
				switch ($idTipo) {
					case 1: $valor_evento = $rowdata["valorVisitaCorte"]; break;   //Visita Corte
					case 2: $valor_evento = $rowdata["valorCorte1"]; break;        //Corte 1° instancia
					case 3: $valor_evento = $rowdata["valorCorte2"]; break;        //Corte 2° instancia
					case 4: $valor_evento = $rowdata["valorReposicion1"]; break;   //Reposicion 1° instancia
					case 5: $valor_evento = $rowdata["valorReposicion2"]; break;   //Reposicion 2° instancia
					
				} 
				
				if($_FILES['Archivo']['error'] == 0){
					//Se verifican las extensiones de los archivos
						$permitidos = array("application/msword",
											"application/vnd.ms-word",
											"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
									
											"application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
											
											"application/mspowerpoint",
											"application/vnd.ms-powerpoint",
											"application/vnd.openxmlformats-officedocument.presentationml.presentation",
											
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
						$limite_kb = 100000;
						//Sufijo
						$sufijo = 'evento_';
					  
						if (in_array($_FILES['Archivo']['type'], $permitidos) && $_FILES['Archivo']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Archivo']['name'];
							//Se verifica que el archivo un archivo con el mismo idTipo no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Archivo"]["tmp_name"], $ruta);
								if ($resultado){
									

									//filtros
									if(isset($idSistema) && $idSistema != ''){            $a  = "'".$idSistema."'" ;        }else{$a  ="''";}
									if(isset($idCliente) && $idCliente != ''){            $a .= ",'".$idCliente."'" ;       }else{$a .=",''";}
									if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;       }else{$a .=",''";}
									if(isset($idTipo) && $idTipo != ''){                  $a .= ",'".$idTipo."'" ;          }else{$a .=",''";}
									if(isset($FechaEjecucion) && $FechaEjecucion != ''){  $a .= ",'".$FechaEjecucion."'" ;  }else{$a .=",''";}
									if(isset($Fecha) && $Fecha != ''){                  
										$a .= ",'".$Fecha."'" ; 
										$a .= ",'".dia_transformado($Fecha)."'" ; 
										$a .= ",'".Fecha_mes_n($Fecha)."'" ; 
										$a .= ",'".Fecha_año($Fecha)."'" ;          
									}else{
										$a .=",''";
										$a .=",''";
										$a .=",''";
										$a .=",''";
									}
									if(isset($Observacion) && $Observacion != ''){   $a .= ",'".$Observacion."'" ;  }else{$a .=",''";}
									if(isset($NSello) && $NSello != ''){             $a .= ",'".$NSello."'" ;       }else{$a .=",''";}
									$a .= ",'".$sufijo.$_FILES['Archivo']['name']."'" ;
									$a .= ",'".$valor_evento."'" ;
									
									
									// inserto los datos de registro en la db
									$query  = "INSERT INTO `clientes_eventos` (idSistema, idCliente, idUsuario, idTipo, FechaEjecucion, Fecha,
									Dia, idMes, Ano, Observacion, NSello, Archivo, ValorEvento) 
									VALUES ({$a} )";
									$result = mysqli_query($dbConn, $query);
									
									//Se actualiza el estado del cliente dependiendo tipo de evento
									$a = "idCliente='".$idCliente."'" ;
									switch ($idTipo) {
										case 2:   $a .= ",idEstadoPago='3'" ; break;
										case 3:   $a .= ",idEstadoPago='3'" ; break;
										case 4:   $a .= ",idEstadoPago='1'" ; break;
										case 5:   $a .= ",idEstadoPago='1'" ; break;
										
									}
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$idCliente}'";
									$result = mysqli_query($dbConn, $query);
				
										
									header( 'Location: '.$location.'&created=true' );
									die;
		
										
								} else {
									$error['Archivo']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Archivo']     = 'error/El archivo '.$_FILES['Archivo']['name'].' ya existe'; 
							}
						} else {
							$error['Archivo']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					
									
				}else{
					
					
					//filtros
					if(isset($idSistema) && $idSistema != ''){            $a  = "'".$idSistema."'" ;        }else{$a  ="''";}
					if(isset($idCliente) && $idCliente != ''){            $a .= ",'".$idCliente."'" ;       }else{$a .=",''";}
					if(isset($idUsuario) && $idUsuario != ''){            $a .= ",'".$idUsuario."'" ;       }else{$a .=",''";}
					if(isset($idTipo) && $idTipo != ''){                  $a .= ",'".$idTipo."'" ;          }else{$a .=",''";}
					if(isset($FechaEjecucion) && $FechaEjecucion != ''){  $a .= ",'".$FechaEjecucion."'" ;  }else{$a .=",''";}
					if(isset($Fecha) && $Fecha != ''){                  
						$a .= ",'".$Fecha."'" ; 
						$a .= ",'".dia_transformado($Fecha)."'" ; 
						$a .= ",'".Fecha_mes_n($Fecha)."'" ; 
						$a .= ",'".Fecha_año($Fecha)."'" ;          
					}else{
						$a .=",''";
						$a .=",''";
						$a .=",''";
						$a .=",''";
					}
					if(isset($Observacion) && $Observacion != ''){   $a .= ",'".$Observacion."'" ;  }else{$a .=",''";}
					if(isset($NSello) && $NSello != ''){             $a .= ",'".$NSello."'" ;       }else{$a .=",''";}
					$a .= ",'".$valor_evento."'" ;
									
									
					// inserto los datos de registro en la db
					$query  = "INSERT INTO `clientes_eventos` (idSistema, idCliente, idUsuario, idTipo, FechaEjecucion, Fecha,
					Dia, idMes, Ano, Observacion, NSello, ValorEvento) 
					VALUES ({$a} )";
					$result = mysqli_query($dbConn, $query);
					
					//Se actualiza el estado del cliente dependiendo tipo de evento
					$a = "idCliente='".$idCliente."'" ;
					switch ($idTipo) {
						case 2:   $a .= ",idEstadoPago='3'" ; break;
						case 3:   $a .= ",idEstadoPago='3'" ; break;
						case 4:   $a .= ",idEstadoPago='1'" ; break;
						case 5:   $a .= ",idEstadoPago='1'" ; break;
										
					}
					// inserto los datos de registro en la db
					$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$idCliente}'";
					$result = mysqli_query($dbConn, $query);
										
					header( 'Location: '.$location.'&created=true' );
					die;
					
				}
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				// Se traen los valores de los distintos eventos guardados en la base de datos
				$query = "SELECT valorVisitaCorte, valorCorte1, valorCorte2, valorReposicion1, valorReposicion2
				FROM `core_sistemas`
				WHERE idSistema = {$idSistema}";
				$resultado = mysqli_query ($dbConn, $query);
				$rowdata = mysqli_fetch_assoc ($resultado);	
				
				//Se verifica el ipo de evento
				$valor_evento = 0;
				switch ($idTipo) {
					case 1: $valor_evento = $rowdata["valorVisitaCorte"]; break;   //Visita Corte
					case 2: $valor_evento = $rowdata["valorCorte1"]; break;        //Corte 1° instancia
					case 3: $valor_evento = $rowdata["valorCorte2"]; break;        //Corte 2° instancia
					case 4: $valor_evento = $rowdata["valorReposicion1"]; break;   //Reposicion 1° instancia
					case 5: $valor_evento = $rowdata["valorReposicion2"]; break;   //Reposicion 2° instancia
					
				}
				
				
				if(isset($_FILES["Archivo"])){
					
					if ($_FILES["Archivo"]["error"] > 0){ 
						$error['Archivo']     = 'error/Ha ocurrido un error'; 
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("application/msword",
											"application/vnd.ms-word",
											"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 
									
											"application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
											
											"application/mspowerpoint",
											"application/vnd.ms-powerpoint",
											"application/vnd.openxmlformats-officedocument.presentationml.presentation",
											
											"application/pdf",
											"application/octet-streamn",
											"application/x-real",
											"application/vnd.adobe.xfdf",
											"application/vnd.fdf",
											
											"image/jpg", 
											"image/jpeg", 
											"image/gif", 
											"image/png"

											);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'evento_';
						  
						if (in_array($_FILES['Archivo']['type'], $permitidos) && $_FILES['Archivo']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Archivo']['name'];
							//Se verifica que el archivo un archivo con el mismo idTipo no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$resultado = @move_uploaded_file($_FILES["Archivo"]["tmp_name"], $ruta);
								if ($resultado){
									
									//Filtros
									$a = "idEventos='".$idEventos."'" ;
									if(isset($idSistema) && $idSistema != ''){             $a .= ",idSistema='".$idSistema."'" ;}
									if(isset($idCliente) && $idCliente != ''){             $a .= ",idCliente='".$idCliente."'" ;}
									if(isset($idUsuario) && $idUsuario != ''){             $a .= ",idUsuario='".$idUsuario."'" ;}
									if(isset($idTipo) && $idTipo != ''){                   $a .= ",idTipo='".$idTipo."'" ;}
									if(isset($FechaEjecucion) && $FechaEjecucion != ''){   $a .= ",FechaEjecucion='".$FechaEjecucion."'" ;}
									if(isset($Fecha) && $Fecha != ''){                  
										$a .= ",Fecha='".$Fecha."'" ; 
										$a .= ",Dia='".dia_transformado($Fecha)."'" ; 
										$a .= ",idMes='".Fecha_mes_n($Fecha)."'" ; 
										$a .= ",Ano='".Fecha_año($Fecha)."'" ;          
									}else{
										$a .=",''";
										$a .=",''";
										$a .=",''";
										$a .=",''";
									}
									if(isset($Observacion) && $Observacion != ''){   $a .= ",Observacion='".$Observacion."'" ;}
									$a .= ",Archivo='".$sufijo.$_FILES['Archivo']['name']."'" ;
									$a .= ",ValorEvento='".$valor_evento."'" ;
									if(isset($NSello) && $NSello != ''){   $a .= ",NSello='".$NSello."'" ;}
					
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_eventos` SET ".$a." WHERE idEventos = '$idEventos'";
									$result = mysqli_query($dbConn, $query);
									
									//Se actualiza el estado del cliente dependiendo tipo de evento
									$a = "idCliente='".$idCliente."'" ;
									switch ($idTipo) {
										case 2:   $a .= ",idEstadoPago='3'" ; break;
										case 3:   $a .= ",idEstadoPago='3'" ; break;
										case 4:   $a .= ",idEstadoPago='1'" ; break;
										case 5:   $a .= ",idEstadoPago='1'" ; break;
														
									}
									// inserto los datos de registro en la db
									$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$idCliente}'";
									$result = mysqli_query($dbConn, $query);
									
									header( 'Location: '.$location.'&edited=true' );
									die;
										
										
								} else {
									$error['Archivo']     = 'error/Ocurrio un error al mover el archivo'; 
								}
							} else {
								$error['Archivo']     = 'error/El archivo '.$_FILES['Archivo']['name'].' ya existe'; 
							}
						} else {
							$error['Archivo']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
			
				}else{
			
					//Filtros
					$a = "idEventos='".$idEventos."'" ;
					if(isset($idSistema) && $idSistema != ''){             $a .= ",idSistema='".$idSistema."'" ;}
					if(isset($idCliente) && $idCliente != ''){             $a .= ",idCliente='".$idCliente."'" ;}
					if(isset($idUsuario) && $idUsuario != ''){             $a .= ",idUsuario='".$idUsuario."'" ;}
					if(isset($idTipo) && $idTipo != ''){                   $a .= ",idTipo='".$idTipo."'" ;}
					if(isset($FechaEjecucion) && $FechaEjecucion != ''){   $a .= ",FechaEjecucion='".$FechaEjecucion."'" ;}
					if(isset($Fecha) && $Fecha != ''){                  
						$a .= ",Fecha='".$Fecha."'" ; 
						$a .= ",Dia='".dia_transformado($Fecha)."'" ; 
						$a .= ",idMes='".Fecha_mes_n($Fecha)."'" ; 
						$a .= ",Ano='".Fecha_año($Fecha)."'" ;          
					}else{
						$a .=",''";
						$a .=",''";
						$a .=",''";
						$a .=",''";
					}
					if(isset($Observacion) && $Observacion != ''){   $a .= ",Observacion='".$Observacion."'" ;}
					$a .= ",ValorEvento='".$valor_evento."'" ;
					if(isset($NSello) && $NSello != ''){   $a .= ",NSello='".$NSello."'" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `clientes_eventos` SET ".$a." WHERE idEventos = '$idEventos'";
					$result = mysqli_query($dbConn, $query);
					
					//Se actualiza el estado del cliente dependiendo tipo de evento
					$a = "idCliente='".$idCliente."'" ;
					switch ($idTipo) {
						case 2:   $a .= ",idEstadoPago='3'" ; break;
						case 3:   $a .= ",idEstadoPago='3'" ; break;
						case 4:   $a .= ",idEstadoPago='1'" ; break;
						case 5:   $a .= ",idEstadoPago='1'" ; break;
										
					}
					// inserto los datos de registro en la db
					$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$idCliente}'";
					$result = mysqli_query($dbConn, $query);
									
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
				
			}
		
	
		break;	
/*******************************************************************************************************************/
		case 'del_file':	
		
			// Se obtiene el idTipo del logo
			$query = "SELECT Archivo
			FROM `clientes_eventos`
			WHERE idEventos = {$_GET['del_file']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			if(unlink('upload/'.$rowdata['Archivo'])&&isset($rowdata['Archivo'])&&$rowdata['Archivo']!=''){	
					
				// actualizo los datos de registro en la db
				$query  = "UPDATE `clientes_eventos` SET Archivo='' WHERE idEventos = '{$_GET['del_file']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo			
				header( 'Location: '.$location.'&id='.$_GET['del_file'] );
				die;

			}else{

				// actualizo los datos de registro en la db
				$query  = "UPDATE `clientes_eventos` SET Archivo='' WHERE idEventos = '{$_GET['del_file']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo				
				header( 'Location: '.$location.'&id='.$_GET['del_file'] );
				die;

			} 


		break;							
/*******************************************************************************************************************/
		case 'del':	

			// Se obtiene el idTipo del logo
			$query = "SELECT Archivo
			FROM `clientes_eventos`
			WHERE idEventos = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			//Obtengo el idTipo fisico del archivo
			$archivo = $rowdata['Archivo'];
			

			if(unlink('upload/'.$archivo)&&isset($rowdata['Archivo'])&&$rowdata['Archivo']!=''){	
					
				//se borran los datos
				$query  = "DELETE FROM `clientes_eventos` WHERE idEventos = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);	
							
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}else{

				//se borran los datos
				$query  = "DELETE FROM `clientes_eventos` WHERE idEventos = {$_GET['del']}";
				$result = mysqli_query($dbConn, $query);	
							
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}
			


		break;							
					
/*******************************************************************************************************************/
	}
?>
