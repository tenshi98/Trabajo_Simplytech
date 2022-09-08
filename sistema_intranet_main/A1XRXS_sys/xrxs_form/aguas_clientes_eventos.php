<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridEventosad                                                */
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
	if ( !empty($_POST['idEventos']) )             $idEventos           = $_POST['idEventos'];
	if ( !empty($_POST['idSistema']) )             $idSistema           = $_POST['idSistema'];
	if ( !empty($_POST['idCliente']) )             $idCliente           = $_POST['idCliente'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario           = $_POST['idUsuario'];
	if ( !empty($_POST['idTipo']) )                $idTipo              = $_POST['idTipo'];
	if ( !empty($_POST['FechaEjecucion']) )        $FechaEjecucion      = $_POST['FechaEjecucion'];
	if ( !empty($_POST['Fecha']) )                 $Fecha 	            = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )                   $Dia 	            = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )                 $idMes 	            = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )                   $Ano 	            = $_POST['Ano'];
	if ( !empty($_POST['Observacion']) )           $Observacion 	    = $_POST['Observacion'];
	if ( !empty($_POST['Archivo']) )               $Archivo 	        = $_POST['Archivo'];
	if ( !empty($_POST['ValorEvento']) )           $ValorEvento         = $_POST['ValorEvento'];
	if ( !empty($_POST['NSello']) )                $NSello              = $_POST['NSello'];
	
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
			case 'idEventos':        if(empty($idEventos)){         $error['idEventos']        = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){         $error['idSistema']        = 'error/No ha seleccionado el sistema';}break;
			case 'idCliente':        if(empty($idCliente)){         $error['idCliente']        = 'error/No ha seleccionado el cliente';}break;
			case 'idUsuario':        if(empty($idUsuario)){         $error['idUsuario']        = 'error/No ha seleccionado el usuario';}break;
			case 'idTipo':           if(empty($idTipo)){            $error['idTipo']           = 'error/No ha seleccionado el tipo';}break;
			case 'FechaEjecucion':   if(empty($FechaEjecucion)){    $error['FechaEjecucion']   = 'error/No ha ingresado la Fecha de Ejecucion';}break;
			case 'Fecha':            if(empty($Fecha)){             $error['Fecha']            = 'error/No ha ingresado la Fecha';}break;
			case 'Dia':              if(empty($Dia)){               $error['Dia']              = 'error/No ha ingresado el Dia';}break;	
			case 'idMes':            if(empty($idMes)){             $error['idMes']            = 'error/No ha ingresado el mes';}break;
			case 'Ano':              if(empty($Ano)){               $error['Ano']              = 'error/No ha ingresado el año';}break;
			case 'Observacion':      if(empty($Observacion)){       $error['Observacion']      = 'error/No ha ingresado la observacion';}break;
			case 'Archivo':          if(empty($Archivo)){           $error['Archivo']          = 'error/No ha ingresado el archivo';}break;
			case 'ValorEvento':      if(empty($ValorEvento)){       $error['ValorEvento']      = 'error/No ha ingresado el Valor del Evento';}break;
			case 'NSello':           if(empty($NSello)){            $error['NSello']           = 'error/No ha ingresado el Numero Sello';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/	
	if(isset($Observacion) && $Observacion != ''){  $Observacion  = EstandarizarInput($Observacion); }
	if(isset($Archivo) && $Archivo != ''){          $Archivo      = EstandarizarInput($Archivo); }
	if(isset($NSello) && $NSello != ''){            $NSello       = EstandarizarInput($NSello); }
	
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Observacion)&&contar_palabras_censuradas($Observacion)!=0){  $error['Observacion'] = 'error/Edita Observacion, contiene palabras no permitidas'; }	
	if(isset($Archivo)&&contar_palabras_censuradas($Archivo)!=0){          $error['Archivo']     = 'error/Edita Archivo, contiene palabras no permitidas'; }	
	if(isset($NSello)&&contar_palabras_censuradas($NSello)!=0){            $error['NSello']      = 'error/Edita N Sello, contiene palabras no permitidas'; }	
	
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
			//Se verifica si el dato existe
			if(isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'idSistema', 'aguas_datos_valores', '', 'idSistema = '.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1==0) {$error['ndata_1'] = 'error/No hay valores configurados de visita, corte u otro';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//selecciono los valores
				$rowValores = db_select_data (false, 'valorVisitaCorte, valorCorte1, valorCorte2, valorReposicion1, valorReposicion2', 'aguas_datos_valores', '', 'idSistema = '.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//Se verifica el ipo de evento
				$ValorEvento = 0;
				switch ($idTipo) {
					case 1: $ValorEvento = $rowValores["valorVisitaCorte"]; break;   //Visita Corte
					case 2: $ValorEvento = $rowValores["valorCorte1"]; break;        //Corte 1° instancia
					case 3: $ValorEvento = $rowValores["valorCorte2"]; break;        //Corte 2° instancia
					case 4: $ValorEvento = $rowValores["valorReposicion1"]; break;   //Reposicion 1° instancia
					case 5: $ValorEvento = $rowValores["valorReposicion2"]; break;   //Reposicion 2° instancia
					
				}
				
				/***********************************************************************************/
				//se verifica si la imagen existe
				if (!empty($_FILES['Archivo']['name'])){
					if ($_FILES["Archivo"]["error"] > 0){
						$error['Archivo']       = 'error/'.uploadPHPError($_FILES["Archivo"]["error"]);
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array(
											"image/jpg", 
											"image/png", 
											"image/gif", 
											"image/jpeg",
											"image/bmp",
								
											"application/msword",
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
													
											"text/plain",
											"text/richtext",
											"application/rtf",
												
											"application/x-zip-compressed",
											"application/zip",
											"multipart/x-zip",			
											"application/x-7z-compressed",
											"application/x-rar-compressed",
											"application/gzip",
											"application/x-gzip",
											"application/x-gtar",
											"application/x-tgz",
											"application/octet-stream"
										);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'aguas_clientes_eventos_'.$idCliente.'_';
							  
						if (in_array($_FILES['Archivo']['type'], $permitidos) && $_FILES['Archivo']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Archivo']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["Archivo"]["tmp_name"], $ruta);
								if ($move_result){
									
									//filtros
									if(isset($idSistema) && $idSistema != ''){             $SIS_data  = "'".$idSistema."'" ;         }else{$SIS_data  ="''";}
									if(isset($idCliente) && $idCliente != ''){             $SIS_data .= ",'".$idCliente."'" ;        }else{$SIS_data .=",''";}
									if(isset($idUsuario) && $idUsuario != ''){             $SIS_data .= ",'".$idUsuario."'" ;        }else{$SIS_data .=",''";}
									if(isset($idTipo) && $idTipo != ''){                   $SIS_data .= ",'".$idTipo."'" ;           }else{$SIS_data .=",''";}
									if(isset($FechaEjecucion) && $FechaEjecucion != ''){   $SIS_data .= ",'".$FechaEjecucion."'" ;   }else{$SIS_data .=",''";}
									if(isset($Fecha) && $Fecha != ''){                  
										$SIS_data .= ",'".$Fecha."'" ; 
										$SIS_data .= ",'".fecha2NdiaMes($Fecha)."'" ; 
										$SIS_data .= ",'".fecha2NMes($Fecha)."'" ; 
										$SIS_data .= ",'".fecha2Ano($Fecha)."'" ;         
									}else{
										$SIS_data .=",''";
										$SIS_data .=",''";
										$SIS_data .=",''";
										$SIS_data .=",''";
									}
									if(isset($Observacion) && $Observacion != ''){   $SIS_data .= ",'".$Observacion."'" ;   }else{$SIS_data .=",''";}
									if(isset($ValorEvento) && $ValorEvento != ''){   $SIS_data .= ",'".$ValorEvento."'" ;   }else{$SIS_data .=",''";}
									if(isset($NSello) && $NSello != ''){             $SIS_data .= ",'".$NSello."'" ;        }else{$SIS_data .=",''";}
									$SIS_data .= ",'".$sufijo.$_FILES['Archivo']['name']."'" ;
									
									// inserto los datos de registro en la db
									$SIS_columns = 'idSistema, idCliente, idUsuario, idTipo, FechaEjecucion, Fecha, Dia, idMes, Ano, Observacion, ValorEvento, NSello, Archivo';
									$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_clientes_eventos', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

									//Si ejecuto correctamente la consulta
									if($ultimo_id!=0){
										
										//redirijo	
										header( 'Location: '.$location.'&created=true' );
										die;	
											
									}	
								} else {
									$error['Archivo']       = 'error/Ocurrio un error al mover el archivo';
								}
							} else {
								$error['Archivo']       = 'error/El archivo '.$_FILES['Archivo']['name'].' ya existe';
							}
						} else {
							$error['Archivo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
						}
					}
				/************************************************************/
				//si no hay archivo
				}else{
					//filtros
					if(isset($idSistema) && $idSistema != ''){             $SIS_data  = "'".$idSistema."'" ;         }else{$SIS_data  ="''";}
					if(isset($idCliente) && $idCliente != ''){             $SIS_data .= ",'".$idCliente."'" ;        }else{$SIS_data .=",''";}
					if(isset($idUsuario) && $idUsuario != ''){             $SIS_data .= ",'".$idUsuario."'" ;        }else{$SIS_data .=",''";}
					if(isset($idTipo) && $idTipo != ''){                   $SIS_data .= ",'".$idTipo."'" ;           }else{$SIS_data .=",''";}
					if(isset($FechaEjecucion) && $FechaEjecucion != ''){   $SIS_data .= ",'".$FechaEjecucion."'" ;   }else{$SIS_data .=",''";}
					if(isset($Fecha) && $Fecha != ''){                  
						$SIS_data .= ",'".$Fecha."'" ; 
						$SIS_data .= ",'".fecha2NdiaMes($Fecha)."'" ; 
						$SIS_data .= ",'".fecha2NMes($Fecha)."'" ; 
						$SIS_data .= ",'".fecha2Ano($Fecha)."'" ;         
					}else{
						$SIS_data .=",''";
						$SIS_data .=",''";
						$SIS_data .=",''";
						$SIS_data .=",''";
					}				
					if(isset($Observacion) && $Observacion != ''){   $SIS_data .= ",'".$Observacion."'" ;   }else{$SIS_data .=",''";}
					if(isset($ValorEvento) && $ValorEvento != ''){   $SIS_data .= ",'".$ValorEvento."'" ;   }else{$SIS_data .=",''";}
					if(isset($NSello) && $NSello != ''){             $SIS_data .= ",'".$NSello."'" ;        }else{$SIS_data .=",''";}
					
					// inserto los datos de registro en la db
					$SIS_columns = 'idSistema, idCliente, idUsuario, idTipo, FechaEjecucion, Fecha, Dia, idMes, Ano, Observacion, ValorEvento, NSello';
					$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_clientes_eventos', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

					//Si ejecuto correctamente la consulta
					if($ultimo_id!=0){
						
						//redirijo	
						header( 'Location: '.$location.'&created=true' );
						die;	
											
					}
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
			//Se verifica si el dato existe
			if(isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'idSistema', 'aguas_datos_valores', '', 'idSistema = '.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1==0) {$error['ndata_1'] = 'error/No hay valores configurados de visita, corte u otro';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//selecciono los valores
				$rowValores = db_select_data (false, 'valorVisitaCorte, valorCorte1, valorCorte2, valorReposicion1, valorReposicion2', 'aguas_datos_valores', '', 'idSistema = '.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//Se verifica el ipo de evento
				$ValorEvento = 0;
				switch ($idTipo) {
					case 1: $ValorEvento = $rowValores["valorVisitaCorte"]; break;   //Visita Corte
					case 2: $ValorEvento = $rowValores["valorCorte1"]; break;        //Corte 1° instancia
					case 3: $ValorEvento = $rowValores["valorCorte2"]; break;        //Corte 2° instancia
					case 4: $ValorEvento = $rowValores["valorReposicion1"]; break;   //Reposicion 1° instancia
					case 5: $ValorEvento = $rowValores["valorReposicion2"]; break;   //Reposicion 2° instancia
					
				}
				
				/***********************************************************************************/
				//se verifica si la imagen existe
				if (!empty($_FILES['Archivo']['name'])){
					if ($_FILES["Archivo"]["error"] > 0){
						$error['Archivo']       = 'error/'.uploadPHPError($_FILES["Archivo"]["error"]);
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array(
											"image/jpg", 
											"image/png", 
											"image/gif", 
											"image/jpeg",
											"image/bmp",
								
											"application/msword",
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
													
											"text/plain",
											"text/richtext",
											"application/rtf",
												
											"application/x-zip-compressed",
											"application/zip",
											"multipart/x-zip",			
											"application/x-7z-compressed",
											"application/x-rar-compressed",
											"application/gzip",
											"application/x-gzip",
											"application/x-gtar",
											"application/x-tgz",
											"application/octet-stream"
										);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
						//Sufijo
						$sufijo = 'aguas_clientes_eventos_'.$idCliente.'_';
							  
						if (in_array($_FILES['Archivo']['type'], $permitidos) && $_FILES['Archivo']['size'] <= $limite_kb * 1024){
							//Se especifica carpeta de destino
							$ruta = "upload/".$sufijo.$_FILES['Archivo']['name'];
							//Se verifica que el archivo un archivo con el mismo nombre no existe
							if (!file_exists($ruta)){
								//Se mueve el archivo a la carpeta previamente configurada
								$move_result = @move_uploaded_file($_FILES["Archivo"]["tmp_name"], $ruta);
								if ($move_result){
									
									//Filtros
									$SIS_data = "idEventos='".$idEventos."'" ;
									if(isset($idSistema) && $idSistema != ''){              $SIS_data .= ",idSistema='".$idSistema."'" ;}
									if(isset($idCliente) && $idCliente != ''){              $SIS_data .= ",idCliente='".$idCliente."'" ;}
									if(isset($idUsuario) && $idUsuario != ''){              $SIS_data .= ",idUsuario='".$idUsuario."'" ;}
									if(isset($idTipo) && $idTipo != ''){                    $SIS_data .= ",idTipo='".$idTipo."'" ;}
									if(isset($FechaEjecucion) && $FechaEjecucion != ''){    $SIS_data .= ",FechaEjecucion='".$FechaEjecucion."'" ;}
									if(isset($Fecha) && $Fecha != ''){                                 
										$SIS_data .= ",Fecha='".$Fecha."'" ;
										$SIS_data .= ",Dia='".fecha2NdiaMes($Fecha)."'" ; 
										$SIS_data .= ",idMes='".fecha2NMes($Fecha)."'" ; 
										$SIS_data .= ",Ano='".fecha2Ano($Fecha)."'" ;  
									}
									if(isset($Observacion) && $Observacion != ''){   $SIS_data .= ",Observacion='".$Observacion."'" ;}
									if(isset($ValorEvento) && $ValorEvento!= ''){    $SIS_data .= ",ValorEvento='".$ValorEvento."'" ;}
									if(isset($NSello) && $NSello!= ''){              $SIS_data .= ",NSello='".$NSello."'" ;}
									$SIS_data .= ",Archivo='".$sufijo.$_FILES['Archivo']['name']."'" ;
									
									/*******************************************************/
									//se actualizan los datos
									$resultado = db_update_data (false, $SIS_data, 'aguas_clientes_eventos', 'idEventos = "'.$idEventos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									//Si ejecuto correctamente la consulta
									if($resultado==true){
										//redirijo
										header( 'Location: '.$location.'&edited=true' );
										die;
									}
										
								} else {
									$error['Archivo']       = 'error/Ocurrio un error al mover el archivo';
								}
							} else {
								$error['Archivo']       = 'error/El archivo '.$_FILES['Archivo']['name'].' ya existe';
							}
						} else {
							$error['Archivo']       = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido';
						}
					}
				/************************************************************/
				//si no hay archivo
				}else{
					//Filtros
					$SIS_data = "idEventos='".$idEventos."'" ;
					if(isset($idSistema) && $idSistema != ''){              $SIS_data .= ",idSistema='".$idSistema."'" ;}
					if(isset($idCliente) && $idCliente != ''){              $SIS_data .= ",idCliente='".$idCliente."'" ;}
					if(isset($idUsuario) && $idUsuario != ''){              $SIS_data .= ",idUsuario='".$idUsuario."'" ;}
					if(isset($idTipo) && $idTipo != ''){                    $SIS_data .= ",idTipo='".$idTipo."'" ;}
					if(isset($FechaEjecucion) && $FechaEjecucion != ''){    $SIS_data .= ",FechaEjecucion='".$FechaEjecucion."'" ;}
					if(isset($Fecha) && $Fecha != ''){                                 
						$SIS_data .= ",Fecha='".$Fecha."'" ;
						$SIS_data .= ",Dia='".fecha2NdiaMes($Fecha)."'" ; 
						$SIS_data .= ",idMes='".fecha2NMes($Fecha)."'" ; 
						$SIS_data .= ",Ano='".fecha2Ano($Fecha)."'" ;  
					}
					if(isset($Observacion) && $Observacion != ''){   $SIS_data .= ",Observacion='".$Observacion."'" ;}
					if(isset($ValorEvento) && $ValorEvento!= ''){    $SIS_data .= ",ValorEvento='".$ValorEvento."'" ;}
					if(isset($NSello) && $NSello!= ''){              $SIS_data .= ",NSello='".$NSello."'" ;}
					
					/*******************************************************/
					//se actualizan los datos
					$resultado = db_update_data (false, $SIS_data, 'aguas_clientes_eventos', 'idEventos = "'.$idEventos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//Si ejecuto correctamente la consulta
					if($resultado==true){
						//redirijo
						header( 'Location: '.$location.'&edited=true' );
						die;
					}				
					
				}
			}
		break;	
/*******************************************************************************************************************/
		case 'del_Archivo':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//busco los archivos relacionados
			$rowdata = db_select_data (false, 'Archivo', 'aguas_clientes_eventos', '', 'idEventos = "'.$_GET['del_Archivo'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			
			/*******************************************************/
			//se actualizan los datos
			$resultado = db_update_data (false, 'Archivo=""', 'aguas_clientes_eventos', 'idEventos = "'.$_GET['del_Archivo'].'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				//se elimina el archivo
				if(isset($rowdata['Archivo'])&&$rowdata['Archivo']!=''){
					try {
						if(!is_writable('upload/'.$rowdata['Archivo'])){
							//throw new Exception('File not writable');
						}else{
							unlink('upload/'.$rowdata['Archivo']);
						}
					}catch(Exception $e) { 
						//guardar el dato en un archivo log
					}
				}
				
				//Redirijo			
				header( 'Location: '.$location.'&del_arch=true' );
				die;
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
				//busco los archivos relacionados
				$rowdata = db_select_data (false, 'Archivo', 'aguas_clientes_eventos', '', 'idEventos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				
				//se borran los datos
				$resultado = db_delete_data (false, 'aguas_clientes_eventos', 'idEventos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					
					//Se elimina la Foto
					if(isset($rowdata['Archivo'])&&$rowdata['Archivo']!=''){
						try {
							if(!is_writable('upload/'.$rowdata['Archivo'])){
								//throw new Exception('File not writable');
							}else{
								unlink('upload/'.$rowdata['Archivo']);
							}
						}catch(Exception $e) { 
							//guardar el dato en un archivo log
						}
					}
					
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
