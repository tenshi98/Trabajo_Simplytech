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
	if ( !empty($_POST['idDatos']) )                   $idDatos                   = $_POST['idDatos'];
	if ( !empty($_POST['idSistema']) )                 $idSistema                 = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )                 $idUsuario                 = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )                     $Fecha                     = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )                       $Dia                       = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )                     $idMes                     = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )                       $Ano                       = $_POST['Ano'];
	if ( !empty($_POST['Nombre']) )                    $Nombre                    = $_POST['Nombre'];
	if ( !empty($_POST['Observaciones']) )             $Observaciones             = $_POST['Observaciones'];
	if ( !empty($_POST['fCreacion']) )                 $fCreacion                 = $_POST['fCreacion'];
	if ( !empty($_POST['idTipo']) )                    $idTipo                    = $_POST['idTipo'];
	if ( !empty($_POST['idTipoMedicion']) )            $idTipoMedicion            = $_POST['idTipoMedicion'];
	if ( !empty($_POST['idMarcadoresUsado']) )         $idMarcadoresUsado         = $_POST['idMarcadoresUsado'];
	if ( !empty($_POST['ConsumoMedidor']) )            $ConsumoMedidor            = $_POST['ConsumoMedidor'];
	
	if ( !empty($_POST['idDatosDetalle']) )            $idDatosDetalle            = $_POST['idDatosDetalle'];
	if ( !empty($_POST['Consumo']) )                   $Consumo                   = $_POST['Consumo'];
	
	
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
			case 'idDatos':              if(empty($idDatos)){               $error['idDatos']                 = 'error/No ha ingresado el id';}break;
			case 'idSistema':            if(empty($idSistema)){             $error['idSistema']               = 'error/No ha seleccionado el sistema';}break;
			case 'idUsuario':            if(empty($idUsuario)){             $error['idUsuario']               = 'error/No ha seleccionado el usuario';}break;
			case 'Fecha':                if(empty($Fecha)){                 $error['Fecha']                   = 'error/No ha ingresado la fecha de facturacion';}break;
			case 'Dia':                  if(empty($Dia)){                   $error['Dia']                     = 'error/No ha ingresado el dia de facturacion';}break;
			case 'idMes':                if(empty($idMes)){                 $error['idMes']                   = 'error/No ha ingresado el mes de facturacion';}break;
			case 'Ano':                  if(empty($Ano)){                   $error['Ano']                     = 'error/No ha ingresado el año de facturacion';}break;
			case 'Nombre':               if(empty($Nombre)){                $error['Nombre']                  = 'error/No ha ingresado el nombre de la facturacion';}break;
			case 'Observaciones':        if(empty($Observaciones)){         $error['Observaciones']           = 'error/No ha ingresado la Observacion';}break;
			case 'fCreacion':            if(empty($fCreacion)){             $error['fCreacion']               = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idTipo':               if(empty($idTipo)){                $error['idTipo']                  = 'error/No ha seleccionado el tipo';}break;
			case 'idTipoMedicion':       if(empty($idTipoMedicion)){        $error['idTipoMedicion']          = 'error/No ha seleccionado el tipo de medicion';}break;
			case 'idMarcadoresUsado':    if(empty($idMarcadoresUsado)){     $error['idMarcadoresUsado']       = 'error/No ha seleccionado el Tipo de marcador usado';}break;
			case 'ConsumoMedidor':       if(empty($ConsumoMedidor)){        $error['ConsumoMedidor']          = 'error/No ha ingresado el consumo del medidor';}break;
			
			case 'idDatosDetalle':       if(empty($idDatosDetalle)){        $error['idDatosDetalle']          = 'error/No ha ingresado el id del medidor';}break;
			case 'Consumo':              if(empty($Consumo)){               $error['Consumo']                 = 'error/No ha ingresado el consumo del remarcador';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                $error['Nombre']        = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){  $error['Observaciones'] = 'error/Edita la Observacion, contiene palabras no permitidas'; }	

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
			if(isset($Fecha) && $Fecha != ''&&isset($idSistema)&& $idSistema != ''){
				$idMes   = fecha2NMes($Fecha); 
				$Ano     = fecha2Ano($Fecha);
				$ndata_1 = db_select_nrows (false, 'idDatos', 'aguas_mediciones_datos', '', "idMes = '".$idMes."' AND Ano = '".$Ano."' AND idSistema='".$idSistema."' AND idTipo=1", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La Medicion ya existe en el sistema';}
			/*******************************************************************/
								
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se verifica si la imagen existe
				if (!empty($_FILES['File_Med']['name'])){
					
					if ($_FILES['File_Med']["error"] > 0){ 
						$error['File_Med'] = 'error/'.uploadPHPError($_FILES["File_Med"]["error"]); 
						
					} else {
						
						//Se verifican las extensiones de los archivos
						$permitidos = array("text/csv",
											"application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
										);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
									  
						if (in_array($_FILES['File_Med']['type'], $permitidos) && $_FILES['File_Med']['size'] <= $limite_kb * 1024){
							
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
														
								$porciones   = explode(" ", $Fecha);
								$Fecha       = $porciones[0]; // fecha
								$Hora        = $porciones[1]; // hora
								$porciones   = explode("/", $Fecha);
								$Fecha1      = $porciones[0];
														
								return $Fecha1;
							}
							function ExcelFechaMes($Fecha){
														
								$porciones   = explode(" ", $Fecha);
								$Fecha       = $porciones[0]; // fecha
								$Hora        = $porciones[1]; // hora
								$porciones   = explode("/", $Fecha);
								$Fecha1      = $porciones[1];
														
								return $Fecha1;
							}
							function ExcelFechaAno($Fecha){
														
								$porciones   = explode(" ", $Fecha);
								$Fecha       = $porciones[0]; // fecha
								$Hora        = $porciones[1]; // hora
								$porciones   = explode("/", $Fecha);
								$Fecha1      = $porciones[2];
														
								return $Fecha1;
							}
							/*******************************************************************/
							//Cargo a todos los clientes del sistema
							$SIS_query = 'Identificador, idCliente, idMarcadores, idRemarcadores';
							$SIS_join  = '';
							$SIS_where = 'idSistema='.$idSistema.' AND idEstado=1';
							$SIS_order = 0;
							$arrClientes = array();
							$arrClientes = db_select_array (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
							
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
							$ndata_2 = 0;
							//verifico la existencia de los clientes
							if($_FILES['File_Med']['type']=='text/csv'){
								//se lee el archivo
								$csv = readCSV($_FILES['File_Med']['tmp_name']);
								
								//se recorre el arreglo
								foreach ($csv as $archivo) {
									//se definen celdas
									$ID_Cliente     = $archivo[0]; 
										
									//Se eliminan espacios en blanco
									$ID_Cliente = str_replace(' ', '', $ID_Cliente);
										
									//verifico si el usuario ingresado en el excel existe
									if(!isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
										$ndata_2++;	
									}
								}
							//si es un excel normal	
							}else{
								//Cargo la libreria de lectura de archivos excel
								$objPHPExcel = PHPExcel_IOFactory::load($_FILES['File_Med']['tmp_name']);
								//recorro la hoja excel
								foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ 
									$highestRow = $worksheet->getHighestRow();  
									for ($row=2; $row<=$highestRow; $row++){ 
																	  
										$ID_Cliente     = $worksheet->getCellByColumnAndRow(0,  $row)->getValue(); 
										//Se eliminan espacios en blanco
										$ID_Cliente = str_replace(' ', '', $ID_Cliente);
										
										//verifico si el usuario ingresado en el excel existe
										if(!isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
											$ndata_2++;	
										}	
									}
								}
							}		
							/*******************************************************************/
							//generacion de errores
							if($ndata_2 > 0) {$error['ndata_2'] = 'error/Hay '.$ndata_2.' clientes que no existen, favor verificar excel';}
							/*******************************************************************/
							// si no hay errores ejecuto el codigo	
							if ( empty($error) ) {
								//Creo el registro en la tabla madre
								if(isset($idSistema) && $idSistema != ''){   $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
								if(isset($idUsuario) && $idUsuario != ''){   $a .= ",'".$idUsuario."'" ;  }else{$a .=",''";}
								if(isset($Fecha) && $Fecha != ''){                  
									$a .= ",'".$Fecha."'" ; 
									$a .= ",'".fecha2NdiaMes($Fecha)."'" ; 
									$a .= ",'".fecha2NMes($Fecha)."'" ; 
									$a .= ",'".fecha2Ano($Fecha)."'" ;  
									$a .= ",'Facturación mes ".fecha2NombreMes($Fecha)." ".fecha2Ano($Fecha)."'" ;        
								}else{
									$a .=",''";
									$a .=",''";
									$a .=",''";
									$a .=",''";
									$a .=",''";
								}
								if(isset($Observaciones) && $Observaciones != ''){ $a .= ",'".$Observaciones."'" ; }else{$a .=",'Sin Observaciones'";}
								$a .=",'".fecha_actual()."'";
								$a .=",'1'";
								
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `aguas_mediciones_datos` (idSistema, idUsuario, Fecha, Dia, 
								idMes, Ano, Nombre, Observaciones, fCreacion, idTipo) 
								VALUES (".$a.")";
								//Consulta
								$resultado = mysqli_query ($dbConn, $query);
								//Si ejecuto correctamente la consulta
								if($resultado){
									
									//recibo el último id generado por mi sesion
									$ultimo_id = mysqli_insert_id($dbConn);
								
									//Se verifica el tipo de archivo
									if($_FILES['File_Med']['type']=='text/csv'){
										
										//se lee el archivo
										$csv = readCSV($_FILES['File_Med']['tmp_name']);
										
										//se recorre el arreglo
										foreach ($csv as $archivo) {
											
											//se definen celdas
											$ID_Cliente     = $archivo[0]; 
											$ID_Nombre      = $archivo[1];  
											$ID_Direccion   = $archivo[2];  
											$ID_Consumo     = $archivo[3]; 
											$ID_FLectura    = $archivo[5]; 
											$ID_TipoMIU     = $archivo[8];
											$ID_MIU         = $archivo[9]; 
											$ID_Contador    = $archivo[11]; 
											
											//Se eliminan espacios en blanco
											$ID_Cliente = str_replace(' ', '', $ID_Cliente);
											//Se cambian comas por puntos
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
												$query  = "INSERT INTO `aguas_mediciones_datos_detalle` (idSistema, idUsuario, idDatos, Fecha, 
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
										$objPHPExcel = PHPExcel_IOFactory::load($_FILES['File_Med']['tmp_name']);
										//recorro la hoja excel
										foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ 
											$highestRow = $worksheet->getHighestRow();  
											for ($row=2; $row<=$highestRow; $row++){ 
																		  
												$ID_Cliente     = $worksheet->getCellByColumnAndRow(0,  $row)->getValue(); 
												$ID_Nombre      = $worksheet->getCellByColumnAndRow(1,  $row)->getValue();  
												$ID_Direccion   = $worksheet->getCellByColumnAndRow(2,  $row)->getValue();  
												$ID_Consumo     = $worksheet->getCellByColumnAndRow(3,  $row)->getValue(); 
												$ID_FLectura    = $worksheet->getCellByColumnAndRow(5,  $row)->getValue(); 
												$ID_TipoMIU     = $worksheet->getCellByColumnAndRow(8,  $row)->getValue();
												$ID_MIU         = $worksheet->getCellByColumnAndRow(9,  $row)->getValue(); 
												$ID_Contador    = $worksheet->getCellByColumnAndRow(11, $row)->getValue(); 
				
												//Se eliminan espacios en blanco
												$ID_Cliente = str_replace(' ', '', $ID_Cliente);
												//Se cambian comas por puntos
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
														$a .= ",'".fecha2NdiaMes($Fecha)."'" ; 
														$a .= ",'".fecha2NMes($Fecha)."'" ; 
														$a .= ",'".fecha2Ano($Fecha)."'" ;
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
													$query  = "INSERT INTO `aguas_mediciones_datos_detalle` (idSistema, idUsuario, idDatos, Fecha, 
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
							
						} else {
							$error['File_Med']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				}else{
					//se devuelve error
					$error['File_Med'] = 'error/No ha seleccionado un archivo';
					
				}	
				
			}
	
		break;
/*******************************************************************************************************************/		
		case 'update':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idDatos='".$idDatos."'" ;
				if(isset($idSistema) && $idSistema != ''){    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idUsuario) && $idUsuario != ''){    $a .= ",idUsuario='".$idUsuario."'" ;}
				if(isset($Fecha) && $Fecha != ''){                               
					$a .= ",Fecha='".$Fecha."'" ; 
					$a .= ",Dia='".fecha2NdiaMes($Fecha)."'" ; 
					$a .= ",idMes='".fecha2NMes($Fecha)."'" ; 
					$a .= ",Ano='".fecha2Ano($Fecha)."'" ;  
					$a .= ",Nombre='Facturación mes ".fecha2NombreMes($Fecha)." ".fecha2Ano($Fecha)."'" ;
				}
				if(isset($Observaciones) && $Observaciones != ''){            $a .= ",Observaciones='".$Observaciones."'" ;}
				if(isset($fCreacion) && $fCreacion != ''){                    $a .= ",fCreacion='".$fCreacion."'" ;}
				if(isset($idTipo) && $idTipo != ''){                          $a .= ",idTipo='".$idTipo."'" ;}
				if(isset($idTipoMedicion) && $idTipoMedicion != ''){          $a .= ",idTipoMedicion='".$idTipoMedicion."'" ;}
				if(isset($idMarcadoresUsado) && $idMarcadoresUsado != ''){    $a .= ",idMarcadoresUsado='".$idMarcadoresUsado."'" ;}
				if(isset($ConsumoMedidor) && $ConsumoMedidor != ''){          $a .= ",ConsumoMedidor='".$ConsumoMedidor."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'aguas_mediciones_datos', 'idDatos = "'.$idDatos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
					header( 'Location: '.$location.'&edited=true' );
					die;
					
				}
			}
		
	
		break;	
/*******************************************************************************************************************/		
		case 'updateConsumo':	
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idDatosDetalle='".$idDatosDetalle."'" ;
				if(isset($Consumo) && $Consumo != ''){    $a .= ",Consumo='".$Consumo."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'aguas_mediciones_datos_detalle', 'idDatosDetalle = "'.$idDatosDetalle.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado==true){
					//redirijo
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
				$resultado_1 = db_delete_data (false, 'aguas_mediciones_datos', 'idDatos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'aguas_mediciones_datos_detalle', 'idDatos = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
	}
?>
