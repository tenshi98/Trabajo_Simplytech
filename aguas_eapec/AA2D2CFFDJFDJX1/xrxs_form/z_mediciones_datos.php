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
	if ( !empty($_POST['idDatos']) )           $idDatos            = $_POST['idDatos'];
	if ( !empty($_POST['idSistema']) )         $idSistema          = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )         $idUsuario          = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )             $Fecha              = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )               $Dia                = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )             $idMes              = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )               $Ano                = $_POST['Ano'];
	if ( !empty($_POST['Nombre']) )            $Nombre             = $_POST['Nombre'];
	if ( !empty($_POST['Observaciones']) )     $Observaciones      = $_POST['Observaciones'];
	if ( !empty($_POST['idDatosDetalle']) )    $idDatosDetalle     = $_POST['idDatosDetalle'];
	if ( !empty($_POST['Consumo']) )           $Consumo            = $_POST['Consumo'];
	if ( !empty($_POST['idCliente']) )         $idCliente          = $_POST['idCliente'];
	if ( !empty($_POST['idMarcadores']) )      $idMarcadores       = $_POST['idMarcadores'];
	if ( !empty($_POST['idRemarcadores']) )    $idRemarcadores     = $_POST['idRemarcadores'];
	if ( !empty($_POST['fCreacion']) )         $fCreacion          = $_POST['fCreacion'];
	if ( !empty($_POST['TipoMIU']) )           $TipoMIU            = $_POST['TipoMIU'];
	if ( !empty($_POST['MIU']) )               $MIU                = $_POST['MIU'];
	if ( !empty($_POST['Contador']) )          $Contador           = $_POST['Contador'];
	if ( !empty($_POST['idTipoFacturacion']) ) $idTipoFacturacion  = $_POST['idTipoFacturacion'];
	if ( !empty($_POST['idTipoLectura']) )     $idTipoLectura      = $_POST['idTipoLectura'];
	if ( !empty($_POST['idTipo']) )            $idTipo             = $_POST['idTipo'];
	if ( !empty($_POST['idTipoMedicion']) )    $idTipoMedicion     = $_POST['idTipoMedicion'];
	

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
			case 'idDatos':          if(empty($idDatos)){            $error['idDatos']          = 'error/No ha ingresado el id';}break;
			case 'idSistema':        if(empty($idSistema)){          $error['idSistema']        = 'error/No ha ingresado el sistema';}break;
			case 'idUsuario':        if(empty($idUsuario)){          $error['idUsuario']        = 'error/No ha ingresado el usuario creador';}break;
			case 'Fecha':            if(empty($Fecha)){              $error['Fecha']            = 'error/No ha ingresado el Fecha';}break;
			case 'Dia':              if(empty($Dia)){                $error['Dia']              = 'error/No ha ingresado la Dia';}break;
			case 'idMes':            if(empty($idMes)){              $error['idMes']            = 'error/No ha ingresado el usuario receptor';}break;
			case 'Ano':              if(empty($Ano)){                $error['Ano']              = 'error/No ha seleccionado el Ano de usuario';}break;
			case 'Nombre':           if(empty($Nombre)){             $error['Nombre']           = 'error/No ha ingresado el nombre';}break;
			case 'Observaciones':    if(empty($Observaciones)){      $error['Observaciones']    = 'error/No ha ingresado la fecha de nacimiento inicio';}break;
			case 'idDatosDetalle':   if(empty($idDatosDetalle)){     $error['idDatosDetalle']   = 'error/No ha ingresado la id del detalle';}break;
			case 'Consumo':          if(empty($Consumo)){            $error['Consumo']          = 'error/No ha ingresado el consumo';}break;
			case 'idCliente':        if(empty($idCliente)){          $error['idCliente']        = 'error/No ha ingresado el cliente';}break;
			case 'idMarcadores':     if(empty($idMarcadores)){       $error['idMarcadores']     = 'error/No ha ingresado el medidor';}break;
			case 'idRemarcadores':   if(empty($idRemarcadores)){     $error['idRemarcadores']   = 'error/No ha ingresado el remarcador';}break;
			case 'fCreacion':        if(empty($fCreacion)){          $error['fCreacion']        = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idTipoMedicion':   if(empty($idTipoMedicion)){     $error['idTipoMedicion']   = 'error/No ha seleccionado el tipo de medicion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert':
			
			//variable
			$n1=0;
			//Verifica si la planilla ingresada no es del mismo mes en curso
			if(isset($idSistema)&&isset($Fecha)){
				$idMes = Fecha_mes_n($Fecha); 
				$Ano   = Fecha_año($Fecha);
				$query = "SELECT idDatos 
				FROM mediciones_datos 
				WHERE idSistema='".$idSistema."' AND idMes='".$idMes."' AND Ano='".$Ano."' AND idTipo=1";
				$resultado = mysqli_query ($dbConn, $query);
				$n1 = mysqli_num_rows ($resultado);
			}
			if($n1 > 0) {$error['Nombre'] = 'error/La Medicion ya existe en el sistema';}

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				
				//se verifica si la imagen existe
				if (!empty($_FILES['file']['name'])){
					if ($_FILES["file"]["error"] > 0){
						$error['file']       = 'error/Ha ocurrido un error';
					} else {
						//Se verifican las extensiones de los archivos
						$permitidos = array("text/csv",
											"application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
											);
						//si el archivo esta dentro de los permitidos
						if (in_array($_FILES['file']['type'], $permitidos)){
							
							/*******************************************************************/
							//funcion para leer archivos csv
							function readCSV($csvFile){
								$file_handle = fopen($csvFile, 'r');
								while (!feof($file_handle) ) {
									$line_of_text[] = fgetcsv($file_handle, 1024,"\t");
								}
								fclose($file_handle);
								return $line_of_text;
							}
							function ExcelFechaCompleta($Fecha){
									
								$porciones  = explode(" ", $Fecha);
								$Fecha      = $porciones[0]; // fecha
								$Hora       = $porciones[1]; // hora
								$porciones  = explode("/", $Fecha);
								$Fecha1     = $porciones[2].'-'.$porciones[1].'-'.$porciones[0];
									
								return $Fecha1;
							}
							function ExcelFechaDia($Fecha){
									
								$porciones  = explode(" ", $Fecha);
								$Fecha      = $porciones[0]; // fecha
								$Hora       = $porciones[1]; // hora
								$porciones  = explode("/", $Fecha);
								$Fecha1     = $porciones[0];
									
								return $Fecha1;
							}
							function ExcelFechaMes($Fecha){
									
								$porciones  = explode(" ", $Fecha);
								$Fecha      = $porciones[0]; // fecha
								$Hora       = $porciones[1]; // hora
								$porciones  = explode("/", $Fecha);
								$Fecha1     = $porciones[1];
									
								return $Fecha1;
							}
							function ExcelFechaAno($Fecha){
									
								$porciones  = explode(" ", $Fecha);
								$Fecha      = $porciones[0]; // fecha
								$Hora       = $porciones[1]; // hora
								$porciones  = explode("/", $Fecha);
								$Fecha1     = $porciones[2];
									
								return $Fecha1;
							}
							/*******************************************************************/
							//Cargo a todos los clientes del sistema
							$arrClientes = array();
							$query = "SELECT Identificador, idCliente, idMarcadores, idRemarcadores
							FROM `clientes_listado`
							WHERE idSistema=".$idSistema." AND idEstado=1";
							$resultado = mysqli_query ($dbConn, $query);
							while ( $row = mysqli_fetch_assoc ($resultado)) {
							array_push( $arrClientes,$row );
							}
							
							//recorro los clientes
							$arrClientesMod = array();		
							foreach ($arrClientes as $clientes)   {
								$arrClientesMod[$clientes['Identificador']]['Identificador']    = $clientes['Identificador'];
								$arrClientesMod[$clientes['Identificador']]['idCliente']        = $clientes['idCliente'];
								$arrClientesMod[$clientes['Identificador']]['idMarcadores']     = $clientes['idMarcadores'];
								$arrClientesMod[$clientes['Identificador']]['idRemarcadores']   = $clientes['idRemarcadores'];
							}
							/*******************************************************************/
							//variables
							$ndata_2 = '';
							//verifico la existencia de los clientes
							if($_FILES['file']['type']=='text/csv'){
								//se lee el archivo
								$csv = readCSV($_FILES['file']['tmp_name']);
								
								//se recorre el arreglo
								foreach ($csv as $archivo) {
									//se definen celdas
									$ID_Cliente     = $archivo[0]; 
										
									//Se eliminan espacios en blanco
									$ID_Cliente = str_replace(' ', '', $ID_Cliente);
										
									//verifico si el usuario ingresado en el excel existe
									if(!isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
										$ndata_2.=', '.$ID_Cliente;	
									}
								}
							//si es un excel normal	
							}else{
								//Cargo la libreria de lectura de archivos excel
								$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
								//recorro la hoja excel
								foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ 
									$highestRow = $worksheet->getHighestRow();  
									for ($row=2; $row<=$highestRow; $row++){ 
																	  
										$ID_Cliente     = $worksheet->getCellByColumnAndRow(0,  $row)->getValue(); 
										//Se eliminan espacios en blanco
										$ID_Cliente = str_replace(' ', '', $ID_Cliente);
										
										//verifico si el usuario ingresado en el excel existe
										if(!isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
											$ndata_2.=', '.$ID_Cliente;
										}	
									}
								}
							}		
							/*******************************************************************/
							//generacion de errores
							if($ndata_2!='') {$error['ndata_2'] = 'error/Los clientes '.$ndata_2.', no existen en el listado de clientes, favor verificar excel';}
							/*******************************************************************/
							// si no hay errores ejecuto el codigo	
							if ( empty($error) ) {
								//Creo el registro en la tabla madre
								if(isset($idSistema) && $idSistema != ''){   $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
								if(isset($idUsuario) && $idUsuario != ''){   $a .= ",'".$idUsuario."'" ;  }else{$a .=",''";}
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
								if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
								if(isset($Observaciones) && $Observaciones != ''){ $a .= ",'".$Observaciones."'" ; }else{$a .=",'Sin Observaciones'";}
								$a .=",'".fecha_actual()."'";
								$a .=",'1'";
								
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `mediciones_datos` (idSistema, idUsuario, Fecha, Dia, idMes, 
								Ano, Nombre, Observaciones, fCreacion, idTipo) 
								VALUES ({$a} )";
								$result = mysqli_query($dbConn, $query);
								//Si ejecuto correctamente la consulta
								if($resultado){
									//recibo el último id generado por mi sesion
									$ultimo_id = mysqli_insert_id($dbConn);
									
									//Se verifica el tipo de archivo
									if($_FILES['file']['type']=='text/csv'){
										//se lee el archivo
										$csv = readCSV($_FILES['file']['tmp_name']);
										
										//se recorre el arreglo
										foreach ($csv as $archivo) {
											
											$ID_Cliente     = $archivo[0]; 
											$ID_Nombre      = $archivo[1];  
											$ID_Direccion   = $archivo[2];  
											$ID_Consumo     = $archivo[3]; 
											$ID_FLectura    = $archivo[5]; 
											$ID_TipoMIU     = $archivo[8];
											$ID_MIU         = $archivo[9]; 
											$ID_Contador    = $archivo[11];
											
											//Se eliminan espacios en blanco
											$ID_Cliente  = str_replace(' ', '', $ID_Cliente);
											$ID_Consumo  = str_replace(',', '.', $ID_Consumo);
												
											//verifico si el usuario ingresado en el excel existe
											if(isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
												
												//defino variables
												$idCliente       = $arrClientesMod[$ID_Cliente]['idCliente'];
												$idMarcadores    = $arrClientesMod[$ID_Cliente]['idMarcadores'];
												$idRemarcadores  = $arrClientesMod[$ID_Cliente]['idRemarcadores'];
														
												//filtros
												if(isset($idSistema) && $idSistema != ''){    $a  = "'".$idSistema."'" ;     }else{$a  ="''";}
												if(isset($idUsuario) && $idUsuario != ''){    $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
												$a .= ",'".$ultimo_id."'" ;       
												if(isset($ID_FLectura) && $ID_FLectura != ''){                  
													$a .= ",'".ExcelFechaCompleta($ID_FLectura)."'" ; 
													$a .= ",'".ExcelFechaDia($ID_FLectura)."'" ; 
													$a .= ",'".ExcelFechaMes($ID_FLectura)."'" ; 
													$a .= ",'".ExcelFechaAno($ID_FLectura)."'" ;          
												}else{
													$a .=",''";
													$a .=",''";
													$a .=",''";
													$a .=",''";
												}
												if(isset($idCliente) && $idCliente != ''){             $a .= ",'".$idCliente."'" ;        }else{$a .=",''";}
												if(isset($idMarcadores) && $idMarcadores != ''){       $a .= ",'".$idMarcadores."'" ;     }else{$a .=",''";}
												if(isset($idRemarcadores) && $idRemarcadores != ''){   $a .= ",'".$idRemarcadores."'" ;   }else{$a .=",''";}
												if(isset($ID_TipoMIU) && $ID_TipoMIU != ''){           $a .= ",'".$ID_TipoMIU."'" ;       }else{$a .=",''";}
												if(isset($ID_MIU) && $ID_MIU != ''){                   $a .= ",'".$ID_MIU."'" ;           }else{$a .=",''";}
												if(isset($ID_Contador) && $ID_Contador != ''){         $a .= ",'".$ID_Contador."'" ;      }else{$a .=",''";}
												if(isset($ID_Consumo) && $ID_Consumo != ''){           $a .= ",'".$ID_Consumo."'" ;       }else{$a .=",''";}
												$a .= ",'1'" ;
												$a .= ",'0'" ;
												$a .=",'".fecha_actual()."'";
												$a .= ",'1'" ;
												$a .= ",'1'" ;
														
												// inserto los datos de registro en la db
												$query  = "INSERT INTO `mediciones_datos_detalle` (idSistema, idUsuario, idDatos, Fecha, 
												Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, TipoMIU, MIU, Contador, Consumo, 
												idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura) 
												VALUES (".$a.")";
												//Consulta
												$resultado = mysqli_query ($dbConn, $query);
											}
										}
										
										//redirijo
										header( 'Location: '.$location.'&created=true' );
										die;
									
									//si es un excel normal	
									}else{
										
										//Cargo la libreria de lectura de archivos excel
										$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
										//recorro la hoja excel
										foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   { 
											$highestRow = $worksheet->getHighestRow();  
											for ($row=2; $row<=$highestRow; $row++){ 
																		  
												$ID_Cliente     = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); 
												$ID_Nombre      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();  
												$ID_Direccion   = $worksheet->getCellByColumnAndRow(2, $row)->getValue();  
												$ID_Consumo     = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); 
												$ID_FLectura    = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); 
												$ID_TipoMIU     = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
												$ID_MIU         = $worksheet->getCellByColumnAndRow(9, $row)->getValue(); 
												$ID_Contador    = $worksheet->getCellByColumnAndRow(11, $row)->getValue(); 
				
												//Se eliminan espacios en blanco
												$ID_Cliente = str_replace(' ', '', $ID_Cliente);
												$ID_Consumo = str_replace(',', '.', $ID_Consumo);
												
												//verifico si el usuario ingresado en el excel existe
												if(isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
													
													//defino variables
													$idCliente       = $arrClientesMod[$ID_Cliente]['idCliente'];
													$idMarcadores    = $arrClientesMod[$ID_Cliente]['idMarcadores'];
													$idRemarcadores  = $arrClientesMod[$ID_Cliente]['idRemarcadores'];
													
													
													//filtros
													if(isset($idSistema) && $idSistema != ''){    $a  = "'".$idSistema."'" ;     }else{$a  ="''";}
													if(isset($idUsuario) && $idUsuario != ''){    $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
													$a .= ",'".$ultimo_id."'" ;       
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
													if(isset($idCliente) && $idCliente != ''){             $a .= ",'".$idCliente."'" ;        }else{$a .=",''";}
													if(isset($idMarcadores) && $idMarcadores != ''){       $a .= ",'".$idMarcadores."'" ;     }else{$a .=",''";}
													if(isset($idRemarcadores) && $idRemarcadores != ''){   $a .= ",'".$idRemarcadores."'" ;   }else{$a .=",''";}
													if(isset($ID_TipoMIU) && $ID_TipoMIU != ''){           $a .= ",'".$ID_TipoMIU."'" ;       }else{$a .=",''";}
													if(isset($ID_MIU) && $ID_MIU != ''){                   $a .= ",'".$ID_MIU."'" ;           }else{$a .=",''";}
													if(isset($ID_Contador) && $ID_Contador != ''){         $a .= ",'".$ID_Contador."'" ;      }else{$a .=",''";}
													if(isset($ID_Consumo) && $ID_Consumo != ''){           $a .= ",'".$ID_Consumo."'" ;       }else{$a .=",''";}
													$a .= ",'1'" ;
													$a .= ",'0'" ;
													$a .=",'".fecha_actual()."'";
													$a .= ",'1'" ;
													$a .= ",'1'" ;
															
													// inserto los datos de registro en la db
													$query  = "INSERT INTO `mediciones_datos_detalle` (idSistema, idUsuario, idDatos, Fecha, 
													Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, TipoMIU, MIU, Contador, Consumo, 
													idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura) 
													VALUES (".$a.")";
													//Consulta
													$resultado = mysqli_query ($dbConn, $query);
													
												}
												
											}
										}
										//redirijo
										header( 'Location: '.$location.'&created=true' );
										die;
									}
								}
								
							}
							
						} else {
							$error['file']       = 'error/Esta tratando de subir un archivo no permitido';
						}
					}
				}else{
					$error['file']       = 'error/No ha seleccionado un archivo';
				}
	
				

			}

		break;
		
/*******************************************************************************************************************/		
		case 'edit_consumo':
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Filtros
				$a = "idDatosDetalle='".$idDatosDetalle."'" ;
				if(isset($Consumo) && $Consumo != ''){                      $a .= ",Consumo='".$Consumo."'" ;}
				if(isset($idTipoFacturacion) && $idTipoFacturacion != ''){  $a .= ",idTipoFacturacion='".$idTipoFacturacion."'" ;}
				if(isset($idTipoLectura) && $idTipoLectura != ''){          $a .= ",idTipoLectura='".$idTipoLectura."'" ;}
				
				// inserto los datos de registro en la db
				$query  = "UPDATE `mediciones_datos_detalle` SET ".$a." WHERE idDatosDetalle = '$idDatosDetalle'";
				$result = mysqli_query($dbConn, $query);
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			}
		
		break;
/*******************************************************************************************************************/		
		case 'edit_datos_basicos':
		
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/////////////////////////////////////////////////////////////////////////////
				//Se actualizan los datos principales
				$a = "idDatos='".$idDatos."'" ;
				if(isset($Fecha) && $Fecha != ''){                  
					$a .= ",Fecha='".$Fecha."'" ; 
					$a .= ",Dia='".dia_transformado($Fecha)."'" ; 
					$a .= ",idMes='".Fecha_mes_n($Fecha)."'" ; 
					$a .= ",Ano='".Fecha_año($Fecha)."'" ;          
				}else{
					$a .=",Fecha='''";
					$a .=",Dia='''";
					$a .=",idMes='''";
					$a .=",Ano='''";
				}
				if(isset($Nombre) && $Nombre != ''){                $a .= ",Nombre='".$Nombre."'" ;}			
				if(isset($Observaciones) && $Observaciones != ''){  $a .= ",Observaciones='".$Observaciones."'" ;}			

				// inserto los datos de registro en la db
				$query  = "UPDATE `mediciones_datos` SET ".$a." WHERE idDatos = '$idDatos'";
				$result = mysqli_query($dbConn, $query);
				
				
			
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			}
		
		break;	
/*******************************************************************************************************************/		
		case 'insert_manual':
		
			//Se verifica si el ingreso de este cliente eiste
			if(isset($idCliente)&&isset($Fecha)&&isset($idSistema)){
				$idMes = Fecha_mes_n($Fecha); 
				$Ano = Fecha_año($Fecha); 
				$sql_usuario = mysqli_query("SELECT idCliente FROM mediciones_datos_detalle WHERE idCliente='".$idCliente."' AND idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$idSistema."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El ingreso ya existe en el sistema';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Creo el registro en la tabla madre
				if(isset($idSistema) && $idSistema != ''){   $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){   $a .= ",'".$idUsuario."'" ;  }else{$a .=",''";}
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
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($Observaciones) && $Observaciones != ''){ $a .= ",'".$Observaciones."'" ; }else{$a .=",'Sin Observaciones'";}
				$a .=",'".fecha_actual()."'";
				$a .=",'3'";			
							
							
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `mediciones_datos` (idSistema, idUsuario, Fecha, Dia, idMes, 
				Ano, Nombre, Observaciones, fCreacion, idTipo) 
				VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
				
				//filtros
				if(isset($idSistema) && $idSistema != ''){    $a  = "'".$idSistema."'" ;     }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){    $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
				$a .= ",'".$ultimo_id."'" ;       
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
				$a .= ",'".$idCliente."'" ;
				if(isset($idMarcadores) && $idMarcadores != ''){       $a .= ",'".$idMarcadores."'" ;     }else{$a .=",''";}
				if(isset($idRemarcadores) && $idRemarcadores != ''){   $a .= ",'".$idRemarcadores."'" ;   }else{$a .=",''";}
				if(isset($TipoMIU) && $TipoMIU != ''){                 $a .= ",'".$TipoMIU."'" ;          }else{$a .=",''";}
				if(isset($MIU) && $MIU != ''){                         $a .= ",'".$MIU."'" ;              }else{$a .=",''";}
				if(isset($Contador) && $Contador != ''){               $a .= ",'".$Contador."'" ;         }else{$a .=",''";}
				if(isset($Consumo) && $Consumo != ''){                 $a .= ",'".$Consumo."'" ;          }else{$a .=",''";}
				$a .= ",'1'" ;
				$a .= ",'0'" ;
				$a .=",'".fecha_actual()."'";
				if(isset($idTipoFacturacion) && $idTipoFacturacion != ''){   $a .= ",'".$idTipoFacturacion."'" ;   }else{$a .=",''";}
				if(isset($idTipoLectura) && $idTipoLectura != ''){           $a .= ",'".$idTipoLectura."'" ;       }else{$a .=",''";}
				
						
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `mediciones_datos_detalle` (idSistema, idUsuario, idDatos, Fecha, 
				Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, TipoMIU, MIU, Contador, Consumo, 
				idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura) 
				VALUES ({$a} )";						
				$result = mysqli_query($dbConn, $query);

				
				header( 'Location: '.$location.'&created=true' );
				die;

			}
			
		
		break;	
/*******************************************************************************************************************/		
		case 'create_new':
		
			//Verifica si la planilla ingresada no es del mismo mes en curso
			if(isset($idSistema)&&isset($Fecha)){
				$idMes = Fecha_mes_n($Fecha); 
				$Ano   = Fecha_año($Fecha); 
				$query = "SELECT idDatos FROM mediciones_datos WHERE idSistema='".$idSistema."' AND idMes='".$idMes."' AND Ano='".$Ano."' AND idTipo=2 AND idMarcadoresUsado='".$idMarcadores."'";
				$resultado = mysqli_query ($dbConn, $query);
				$n1 = mysqli_num_rows ($resultado);
			} else {
				$n1=0;
			}
			if($n1 > 0) {$error['Nombre'] = 'error/El ingreso ya existe en el sistema';}
			
			//Obtengo el consumo actual y el anterior
			
			$SIS_Fecha_Mes  = $idMes-1;
			$SIS_Fecha_Ano  = $Ano;
			if($SIS_Fecha_Mes==0){
				$SIS_Fecha_Mes  = 12;
				$SIS_Fecha_Ano  = $SIS_Fecha_Ano-1;
			}
			
			
			if(isset($idMarcadores)&&isset($Fecha)){
				$idMes = Fecha_mes_n($Fecha); 
				$Ano   = Fecha_año($Fecha); 
				$query = "SELECT 
				mediciones_datos_detalle.idMarcadores,
				mediciones_datos_detalle.Consumo,
					(SELECT Consumo 
					FROM mediciones_datos_detalle 
					WHERE idMarcadores='".$idMarcadores."' 
					AND idRemarcadores = 0
					AND idMes='".$SIS_Fecha_Mes."' AND Ano='".$SIS_Fecha_Ano."'
					ORDER BY Ano DESC, idMes DESC
					LIMIT 1 ) AS MedicionAnterior
				
				FROM mediciones_datos_detalle WHERE idMarcadores='".$idMarcadores."' 
				AND idRemarcadores = 0
				AND idMes='".$idMes."' AND Ano='".$Ano."'";
				$resultado = mysqli_query ($dbConn, $query);
				$n1 = mysqli_num_rows ($resultado);
				$rowConsumo = mysqli_fetch_assoc ($resultado);
			}
			if($n1==0) {$error['Consumo'] = 'error/El Medidor seleccionado no posee mediciones en el periodo';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
			//Borro todas las sesiones
				unset($_SESSION['basicos']);
				unset($_SESSION['clientes']);
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($Fecha)){          $_SESSION['basicos']['Fecha'] = $Fecha;                   }else{$_SESSION['basicos']['Fecha'] = '';}
				if(isset($Nombre)){         $_SESSION['basicos']['Nombre'] = $Nombre;                 }else{$_SESSION['basicos']['Nombre'] = '';}
				if(isset($Observaciones)){  $_SESSION['basicos']['Observaciones'] = $Observaciones;   }else{$_SESSION['basicos']['Observaciones'] = 'Sin Observaciones';}
				if(isset($idSistema)){      $_SESSION['basicos']['idSistema'] = $idSistema;           }else{$_SESSION['basicos']['idSistema'] = '';}
				if(isset($idUsuario)){      $_SESSION['basicos']['idUsuario'] = $idUsuario;           }else{$_SESSION['basicos']['idUsuario'] = '';}
				if(isset($fCreacion)){      $_SESSION['basicos']['fCreacion'] = $fCreacion;           }else{$_SESSION['basicos']['fCreacion'] = '';}
				if(isset($idMarcadores)){   
					$_SESSION['basicos']['idMarcadores'] = $idMarcadores; 
					$_SESSION['basicos']['Consumo'] = ($rowConsumo['Consumo'] - $rowConsumo['MedicionAnterior']);    
				}else{
					$_SESSION['basicos']['idMarcadores'] = '';
					$_SESSION['basicos']['Consumo'] = '';
				}
				if(isset($idTipoMedicion)){  $_SESSION['basicos']['idTipoMedicion'] = $idTipoMedicion;   }else{$_SESSION['basicos']['idTipoMedicion'] = '';}
				
				
				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;
			}
		
		break;	
/*******************************************************************************************************************/		
		case 'add_cliente':
		
			//Se verifica si el dato existe
			if(isset($idCliente)&&isset($_SESSION['basicos']['Fecha'])&&isset($_SESSION['basicos']['idSistema'])){
				$idMes = Fecha_mes_n($_SESSION['basicos']['Fecha']); 
				$Ano = Fecha_año($_SESSION['basicos']['Fecha']); 
				$sql_usuario = mysqli_query("SELECT idCliente FROM mediciones_datos_detalle WHERE idCliente='".$idCliente."' AND idMes='".$idMes."' AND Ano='".$Ano."' AND idSistema='".$_SESSION['basicos']['idSistema']."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			if($n1 > 0) {$error['Nombre'] = 'error/El ingreso ya existe en el sistema';}
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idCliente)){       $_SESSION['clientes'][$idCliente]['idCliente'] = $idCliente;             }else{$_SESSION[$idCliente]['idCliente'] = '';}
				if(isset($idMarcadores)){    $_SESSION['clientes'][$idCliente]['idMarcadores'] = $idMarcadores;       }else{$_SESSION[$idCliente]['idMarcadores'] = '';}
				if(isset($idRemarcadores)){  $_SESSION['clientes'][$idCliente]['idRemarcadores'] = $idRemarcadores;   }else{$_SESSION[$idCliente]['idRemarcadores'] = '';}
				if(isset($Consumo)){         $_SESSION['clientes'][$idCliente]['Consumo'] = $Consumo;                 }else{$_SESSION[$idCliente]['Consumo'] = '';}
				if(isset($TipoMIU)){         $_SESSION['clientes'][$idCliente]['TipoMIU'] = $TipoMIU;                 }else{$_SESSION[$idCliente]['TipoMIU'] = '';}
				if(isset($MIU)){             $_SESSION['clientes'][$idCliente]['MIU'] = $MIU;                         }else{$_SESSION[$idCliente]['MIU'] = '';}
				if(isset($Contador)){        $_SESSION['clientes'][$idCliente]['Contador'] = $Contador;               }else{$_SESSION[$idCliente]['Contador'] = '';}
				
				
				
				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;
			}
			
		
		break;
/*******************************************************************************************************************/		
		case 'del_cliente':
		
			$idCliente   = $_GET['del_cliente'];

			//$_SESSION['clientes'][$idCliente] = '';
			unset($_SESSION['clientes'][$idCliente]);
			
			//redirijo a la vista
			header( 'Location: '.$location.'&view=true' );
			die;
			
		
		break;
/*******************************************************************************************************************/		
		case 'edit_datos':
		
			//En caso de que elija otro medidor borro los datos
			if(isset($idMarcadores)&&$idMarcadores!=$_SESSION['basicos']['idMarcadores']){
				unset($_SESSION['clientes']);				
			} 
			
			
			//Se guardan los datos basicos del formulario recien llenado
			if(isset($Fecha)){           $_SESSION['basicos']['Fecha'] = $Fecha;                     }else{$_SESSION['basicos']['Fecha'] = '';}
			if(isset($Nombre)){          $_SESSION['basicos']['Nombre'] = $Nombre;                   }else{$_SESSION['basicos']['Nombre'] = '';}
			if(isset($Observaciones)){   $_SESSION['basicos']['Observaciones'] = $Observaciones;     }else{$_SESSION['basicos']['Observaciones'] = 'Sin Observaciones';}
			if(isset($idTipoMedicion)){  $_SESSION['basicos']['idTipoMedicion'] = $idTipoMedicion;   }else{$_SESSION['basicos']['idTipoMedicion'] = '';}
			if(isset($idMarcadores)){    $_SESSION['basicos']['idMarcadores'] = $idMarcadores;       }else{$_SESSION['basicos']['idMarcadores'] = ''; }
			
			//redirijo a la vista
			header( 'Location: '.$location.'&view=true' );
			die;
		
		break;
/*******************************************************************************************************************/		
		case 'clear_all':

			//Borro todas las sesiones
			unset($_SESSION['basicos']);
			unset($_SESSION['clientes']);
			
			header( 'Location: '.$location );
			die;

		break;
/*******************************************************************************************************************/		
		case 'crear_ingreso':

			//Datos basicos
			if (isset($_SESSION['basicos'])){
				if(!isset($_SESSION['basicos']['Fecha']) or $_SESSION['basicos']['Fecha']=='' ){                   $error['Fecha']          = 'error/No ha ingresado la fecha';}
				if(!isset($_SESSION['basicos']['Nombre']) or $_SESSION['basicos']['Nombre']=='' ){                 $error['Nombre']         = 'error/No ha ingresado el nombre';}
				if(!isset($_SESSION['basicos']['Observaciones']) or $_SESSION['basicos']['Observaciones']=='' ){   $error['Observaciones']  = 'error/No ha ingresado la observacion';}
				if(!isset($_SESSION['basicos']['idSistema']) or $_SESSION['basicos']['idSistema']=='' ){           $error['idSistema']      = 'error/No ha seleccionado el sistema';}
				if(!isset($_SESSION['basicos']['idUsuario']) or $_SESSION['basicos']['idUsuario']=='' ){           $error['idUsuario']      = 'error/No ha ingresado el usuario';}
				if(!isset($_SESSION['basicos']['fCreacion']) or $_SESSION['basicos']['fCreacion']=='' ){           $error['fCreacion']      = 'error/No ha ingresado la fecha de creacion';}
			}else{
				$error['basicos'] = 'error/No tiene datos basicos asignados al documento';
			}
			//trabajos
			if (isset($_SESSION['clientes'])){
				foreach ($_SESSION['clientes'] as $key => $client){
						
					if(!isset($client['idCliente']) or $client['idCliente'] == ''){         $error['idCliente']      = 'error/No ha ingresado un cliente';}
					if(!isset($client['idMarcadores']) or $client['idMarcadores'] == ''){   $error['idMarcadores']   = 'error/No ha ingresado un medidor';}
					if(!isset($client['Consumo']) or $client['Consumo'] == ''){             $error['Consumo']        = 'error/No ha ingresado un consumo';}

				}
			}else{
				$error['clientes'] = 'error/No tiene clientes relacionados en el documento';
			}
			
			
			
			
			
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				$idSistema      = $_SESSION['basicos']['idSistema'];
				$idUsuario      = $_SESSION['basicos']['idUsuario'];
				$Fecha          = $_SESSION['basicos']['Fecha'];
				$Nombre         = $_SESSION['basicos']['Nombre'];
				$Observaciones  = $_SESSION['basicos']['Observaciones'];
				
				$idTipoMedicion  = $_SESSION['basicos']['idTipoMedicion'];
				$idMarcadores    = $_SESSION['basicos']['idMarcadores'];
				$Consumo         = $_SESSION['basicos']['Consumo'];
				
				
				//Creo el registro en la tabla madre
				if(isset($idSistema) && $idSistema != ''){   $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
				if(isset($idUsuario) && $idUsuario != ''){   $a .= ",'".$idUsuario."'" ;  }else{$a .=",''";}
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
				if(isset($Nombre) && $Nombre != ''){               $a .= ",'".$Nombre."'" ;        }else{$a .=",''";}
				if(isset($Observaciones) && $Observaciones != ''){ $a .= ",'".$Observaciones."'" ; }else{$a .=",''";}
				$a .=",'".fecha_actual()."'";
				$a .=",'2'";
				$a .= ",'".$idTipoMedicion."'" ;
				$a .= ",'".$idMarcadores."'" ;
				$a .= ",'".$Consumo."'" ;

				// inserto los datos de registro en la db
				$query  = "INSERT INTO `mediciones_datos` (idSistema, idUsuario, Fecha, Dia, idMes, 
				Ano, Nombre, Observaciones, fCreacion, idTipo, idTipoMedicion, idMarcadoresUsado,
				ConsumoMedidor) 
				VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
							
				if (isset($_SESSION['clientes'])){
					
					//Verifico el saldo anterior de todos los clienbtes
					$arrClientes = array();
					$query = "SELECT 
					clientes_listado.idCliente,
						(SELECT Consumo FROM `mediciones_datos_detalle` 
						WHERE idCliente = clientes_listado.idCliente 
						ORDER BY Ano DESC, idMes DESC LIMIT 1 ) AS ConsumoAnterior
									
					FROM `clientes_listado`
					WHERE idSistema = '{$idSistema}' AND idMarcadores = '{$idMarcadores}'
					ORDER BY clientes_listado.idCliente";
					$resultado = mysqli_query ($dbConn, $query);
					while ( $row = mysqli_fetch_assoc ($resultado)) {
					array_push( $arrClientes,$row );
					}
					
					//Verifico el total de los consumos
					$consumoGeneral = 0;
					$cantRemarcadores = 0;
					foreach ($_SESSION['clientes'] as $key => $client){	
						//Primero cuento la cantidad de remarcadores
						if(isset($client['Consumo']) && $client['Consumo'] != ''){ 
							$cantRemarcadores++;
						}
						//ahora busco a los usuarios
						if(isset($client['Consumo']) && $client['Consumo'] != ''){ 
							foreach ($arrClientes as $cliente) { 
								if($cliente['idCliente']==$client['idCliente']){
									$consumoGeneral = $consumoGeneral + ($client['Consumo']-$cliente['ConsumoAnterior']);
								}
							}
							
						}
					}
					
					//Ejecuto el resto del codigo
					foreach ($_SESSION['clientes'] as $key => $client){	
					
						if(isset($idSistema) && $idSistema != ''){    $a  = "'".$idSistema."'" ;     }else{$a  ="''";}
						if(isset($idUsuario) && $idUsuario != ''){    $a .= ",'".$idUsuario."'" ;    }else{$a .=",''";}
						$a .= ",'".$ultimo_id."'" ;       
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
						
						if(isset($client['idCliente']) && $client['idCliente'] != ''){             $a .= ",'".$client['idCliente']."'" ;      }else{$a .=",''";}
						if(isset($client['idMarcadores']) && $client['idMarcadores'] != ''){       $a .= ",'".$client['idMarcadores']."'" ;   }else{$a .=",''";}
						if(isset($client['idRemarcadores']) && $client['idRemarcadores'] != ''){   $a .= ",'".$client['idRemarcadores']."'" ; }else{$a .=",''";}
						if(isset($client['TipoMIU']) && $client['TipoMIU'] != ''){                 $a .= ",'".$client['TipoMIU']."'" ;        }else{$a .=",''";}
						if(isset($client['MIU']) && $client['MIU'] != ''){                         $a .= ",'".$client['MIU']."'" ;            }else{$a .=",''";}
						if(isset($client['Contador']) && $client['Contador'] != ''){               $a .= ",'".$client['Contador']."'" ;       }else{$a .=",''";}
						if(isset($client['Consumo']) && $client['Consumo'] != ''){                 $a .= ",'".$client['Consumo']."'" ;        }else{$a .=",''";}
						$a .= ",'1'" ;
						$a .= ",'0'" ;
						$a .=",'".fecha_actual()."'";
						$a .= ",'1'" ;
						$a .= ",'1'" ;
						
						$a .= ",'".$idTipoMedicion."'" ;
						$a .= ",'".$idMarcadores."'" ;
						$a .= ",'".$Consumo."'" ;
						$a .= ",'".$consumoGeneral."'" ;
						$a .= ",'".$cantRemarcadores."'" ;
										
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `mediciones_datos_detalle` (idSistema, idUsuario, idDatos, Fecha, 
						Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, TipoMIU, MIU, Contador, Consumo, 
						idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura, idTipoMedicion,
						idMarcadoresUsado, ConsumoMedidor, ConsumoGeneral, CantRemarcadores) 
						VALUES ({$a} )";
				
				
						$result = mysqli_query($dbConn, $query);
					
					}
				}		
				
				
	
				header( 'Location: '.$location.'&created=true' );
				die;

			}

		break;
/*******************************************************************************************************************/		
		case 'del':		
		
			//se borran los permisos del usuario
			$query  = "DELETE FROM `mediciones_datos` WHERE idDatos = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);	
			
			//se borran los permisos del usuario
			$query  = "DELETE FROM `mediciones_datos_detalle` WHERE idDatos = {$_GET['del']}";
			$result = mysqli_query($dbConn, $query);
			
			//redirijo
			header( 'Location: '.$location.'&deleted=true' );
			die;
		
		break;
/*******************************************************************************************************************/
	}
?>
