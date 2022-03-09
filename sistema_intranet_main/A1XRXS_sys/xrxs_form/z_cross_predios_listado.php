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
	if ( !empty($_POST['idPredio']) )    $idPredio    = $_POST['idPredio'];
	if ( !empty($_POST['idSistema']) )   $idSistema   = $_POST['idSistema'];
	if ( !empty($_POST['idEstado']) )    $idEstado    = $_POST['idEstado'];
	if ( !empty($_POST['Nombre']) )      $Nombre      = $_POST['Nombre'];
	if ( !empty($_POST['idPais']) )      $idPais      = $_POST['idPais'];
	if ( !empty($_POST['idCiudad']) )    $idCiudad    = $_POST['idCiudad'];
	if ( !empty($_POST['idComuna']) )    $idComuna    = $_POST['idComuna'];
	if ( !empty($_POST['Direccion']) )   $Direccion   = $_POST['Direccion'];
	
	
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
			case 'idPredio':   if(empty($idPredio)){   $error['idPredio']    = 'error/No ha ingresado el id';}break;
			case 'idSistema':  if(empty($idSistema)){  $error['idSistema']   = 'error/No ha seleccionado el sistema';}break;
			case 'idEstado':   if(empty($idEstado)){   $error['idEstado']    = 'error/No ha seleccionado el estado';}break;
			case 'Nombre':     if(empty($Nombre)){     $error['Nombre']      = 'error/No ha ingresado el nombre';}break;
			case 'idPais':     if(empty($idPais)){     $error['idPais']      = 'error/No ha seleccionado el Pais';}break;
			case 'idCiudad':   if(empty($idCiudad)){   $error['idCiudad']    = 'error/No ha seleccionado la Ciudad';}break;
			case 'idComuna':   if(empty($idComuna)){   $error['idComuna']    = 'error/No ha seleccionado la Comuna';}break;
			case 'Direccion':  if(empty($Direccion)){  $error['Direccion']   = 'error/No ha seleccionado la Direccion';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/	
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){        $error['Nombre']    = 'error/Edita Nombre, contiene palabras no permitidas'; }	
	if(isset($Direccion)&&contar_palabras_censuradas($Direccion)!=0){  $error['Direccion'] = 'error/Edita Direccion, contiene palabras no permitidas'; }	
	
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/		
		case 'insert_plant':
			
			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");
			
			//Verifico otros datos
			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			//Se verifica si el dato existe
			if(isset($Nombre)&&isset($idSistema)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'cross_predios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//se verifica si la imagen existe
				if (!empty($_FILES['FilePredio']['name'])){
					
					if ($_FILES['FilePredio']["error"] > 0){ 
						$error['FilePredio'] = 'error/'.uploadPHPError($_FILES["FilePredio"]["error"]); 
						
					} else {
						
						//Se verifican las extensiones de los archivos
						$permitidos = array("application/msexcel",
											"application/vnd.ms-excel",
											"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
										);
						//Se verifica que el archivo subido no exceda los 100 kb
						$limite_kb = 10000;
									  
						if (in_array($_FILES['FilePredio']['type'], $permitidos) && $_FILES['FilePredio']['size'] <= $limite_kb * 1024){
							
							
							/*******************************************************************/
							//variables
							$ndata_2  = 0;
							$nPredios = 0;
							//Cargo la libreria de lectura de archivos excel
							$objPHPExcel = PHPExcel_IOFactory::load($_FILES['FilePredio']['tmp_name']);
							//recorro la hoja excel
							foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ 
								$highestRow = $worksheet->getHighestRow(); 
								$sheetname  = $worksheet->getTitle(); 
								//solo reviso la pestaña predio
								if ($sheetname == "Predio"){ 
									for ($row=2; $row<=$highestRow; $row++){ 
																	  
										$Predio_Nombre    = $worksheet->getCellByColumnAndRow(0,  $row)->getValue(); 
										$Predio_Pais      = $worksheet->getCellByColumnAndRow(1,  $row)->getValue(); 
										$Predio_Ciudad    = $worksheet->getCellByColumnAndRow(2,  $row)->getValue(); 
										$Predio_Comuna    = $worksheet->getCellByColumnAndRow(3,  $row)->getValue(); 
										$Predio_Direccion = $worksheet->getCellByColumnAndRow(4,  $row)->getValue(); 
											
										//verifico si el predio ingresado en el excel existe
										$SIS_query = 'Nombre';
										$SIS_join  = '';
										$SIS_where = 'idSistema='.$idSistema.' AND Nombre="'.$Predio_Nombre.'"';
										$nRows = db_select_nrows (false, $SIS_query, 'cross_predios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'nRows');

										//Si existe se marca error
										if(isset($nRows)&&$nRows!=0){
											$ndata_2++;	
										}
										
										//conteo de predios
										$nPredios++;	
									}
								}
								
							}
							/*******************************************************************/
							//generacion de errores
							if($ndata_2 > 0) {  $error['ndata_2']  = 'error/El predio ingresado ya existe en el sistema';}
							if($nPredios > 1) { $error['nPredios'] = 'error/Esta tratando de ingresar mas de un predio';}
							
							/*******************************************************************/
							// si no hay errores ejecuto el codigo	
							if ( empty($error) ) {
								
								//Obtengo los id
								$rowPais   = db_select_data (false, 'idPais', 'core_paises', '', 'Nombre="'.$Predio_Pais.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
								$rowCiudad = db_select_data (false, 'idCiudad', 'core_ubicacion_ciudad', '', 'Nombre="'.$Predio_Ciudad.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
								$rowComuna = db_select_data (false, 'idComuna', 'core_ubicacion_comunas', '', 'Nombre="'.$Predio_Comuna.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
								
								//Asigno valores
								$Nombre    = $Predio_Nombre;
								$idPais    = $rowPais['idPais'];
								$idCiudad  = $rowCiudad['idCiudad'];
								$idComuna  = $rowComuna['idComuna'];
								$Direccion = $Predio_Direccion;
								
								//filtros
								if(isset($idSistema) && $idSistema != ''){  $a  = "'".$idSistema."'" ;   }else{$a  ="''";}
								if(isset($idEstado) && $idEstado != ''){    $a .= ",'".$idEstado."'" ;   }else{$a .=",''";}
								if(isset($Nombre) && $Nombre != ''){        $a .= ",'".$Nombre."'" ;     }else{$a .=",''";}
								if(isset($idPais) && $idPais != ''){        $a .= ",'".$idPais."'" ;     }else{$a .=",''";}
								if(isset($idCiudad) && $idCiudad != ''){    $a .= ",'".$idCiudad."'" ;   }else{$a .=",''";}
								if(isset($idComuna) && $idComuna != ''){    $a .= ",'".$idComuna."'" ;   }else{$a .=",''";}
								if(isset($Direccion) && $Direccion != ''){  $a .= ",'".$Direccion."'" ;  }else{$a .=",''";}
								
								// inserto los datos de registro en la db
								$query  = "INSERT INTO `cross_predios_listado` (idSistema, idEstado, Nombre, idPais,
								idCiudad, idComuna, Direccion) 
								VALUES (".$a.")";
								//Consulta
								$resultado = mysqli_query ($dbConn, $query);
								
								//Si ejecuto correctamente la consulta
								if($resultado){
									
									//recibo el último id generado por mi sesion
									$ultimo_id = mysqli_insert_id($dbConn);
									
									/*******************************************************************/
									//Cargo a todos los clientes del sistema
									$arrEspecies   = array();
									$arrVariedades = array();
									$arrEstadoProd = array();
									$arrEstado     = array();
									
									$arrEspecies   = db_select_array (false, 'idCategoria,Nombre', 'sistema_variedades_categorias', '', '', 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									$arrVariedades = db_select_array (false, 'idProducto,Nombre', 'variedades_listado', '', 'idEstado=1', 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									$arrEstadoProd = db_select_array (false, 'idEstadoProd,Nombre', 'core_cross_estados_productivos', '', '', 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									$arrEstado     = db_select_array (false, 'idEstado,Nombre', 'core_estados', '', '', 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
									
									//recorro los datos
									$arrEspeciesMod   = array();		
									$arrVariedadesMod = array();		
									$arrEstadoProdMod = array();		
									$arrEstadoMod     = array();		
									foreach ($arrEspecies as $data) {   $arrEspeciesMod[$data['Nombre']]['idCategoria']    = $data['idCategoria']; }
									foreach ($arrVariedades as $data) { $arrVariedadesMod[$data['Nombre']]['idProducto']   = $data['idProducto']; }
									foreach ($arrEstadoProd as $data) { $arrEstadoProdMod[$data['Nombre']]['idEstadoProd'] = $data['idEstadoProd']; }
									foreach ($arrEstado as $data) {     $arrEstadoMod[$data['Nombre']]['idEstado']         = $data['idEstado']; }
									
									//Cargo la libreria de lectura de archivos excel
									$objPHPExcel = PHPExcel_IOFactory::load($_FILES['FilePredio']['tmp_name']);
									//recorro la hoja excel
									foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ 
										$highestRow = $worksheet->getHighestRow();
										$sheetname  = $worksheet->getTitle();  
										//solo reviso la pestaña cuarteles
										if ($sheetname == "Cuarteles"){ 
											for ($row=2; $row<=$highestRow; $row++){ 
																		  
												$ID                  = $worksheet->getCellByColumnAndRow(0,  $row)->getValue();  
												$NombreCuartel       = $worksheet->getCellByColumnAndRow(1,  $row)->getValue();  
												$CodigoCuartel       = $worksheet->getCellByColumnAndRow(2,  $row)->getValue();  
												$Especie             = $worksheet->getCellByColumnAndRow(3,  $row)->getValue(); 
												$Variedad            = $worksheet->getCellByColumnAndRow(4,  $row)->getValue(); 
												$AnoPlantacion       = $worksheet->getCellByColumnAndRow(5,  $row)->getValue();
												$N_Hectareas         = $worksheet->getCellByColumnAndRow(6,  $row)->getValue(); 
												$N_Hileras           = $worksheet->getCellByColumnAndRow(7,  $row)->getValue(); 
												$N_Plantas           = $worksheet->getCellByColumnAndRow(8,  $row)->getValue(); 
												$EstadoProductivo    = $worksheet->getCellByColumnAndRow(9,  $row)->getValue(); 
												$DistanciaPlantacion = $worksheet->getCellByColumnAndRow(10, $row)->getValue(); 
												$DistanciaHileras    = $worksheet->getCellByColumnAndRow(11, $row)->getValue(); 
												$Estado              = $worksheet->getCellByColumnAndRow(12, $row)->getValue(); 
												
												//Mientras exista dato ejecuta
												if(isset($ID)&&$ID!=''){
													//Se cambian comas por puntos
													$ID_AnoPlantacion       = str_replace(',', '.', $AnoPlantacion);
													$ID_N_Hectareas         = str_replace(',', '.', $N_Hectareas);
													$ID_N_Hileras           = str_replace(',', '.', $N_Hileras);
													$ID_N_Plantas           = str_replace(',', '.', $N_Plantas);
													$ID_DistanciaPlantacion = str_replace(',', '.', $DistanciaPlantacion);
													$ID_DistanciaHileras    = str_replace(',', '.', $DistanciaHileras);
													
													//verifico si existen los datos
													if(isset($Especie)&&isset($arrEspeciesMod[$Especie]['idCategoria'])){                       $ID_idCategoria  = $arrEspeciesMod[$Especie]['idCategoria'];}   
													if(isset($Variedad)&&isset($arrVariedadesMod[$Variedad]['idProducto'])){                    $ID_idProducto   = $arrVariedadesMod[$Variedad]['idProducto'];}  
													if(isset($EstadoProductivo)&&isset($arrEstadoProdMod[$EstadoProductivo]['idEstadoProd'])){  $ID_idEstadoProd = $arrEstadoProdMod[$EstadoProductivo]['idEstadoProd'];} 
													if(isset($Estado)&&isset($arrEstadoMod[$Estado]['idEstado'])){                              $ID_idEstado     = $arrEstadoMod[$Estado]['idEstado'];}         
													
													//filtros
													if(isset($ultimo_id) && $ultimo_id != ''){                            $a  = "'".$ultimo_id."'" ;                }else{$a  ="''";}
													if(isset($NombreCuartel) && $NombreCuartel != ''){                    $a .= ",'".$NombreCuartel."'" ;           }else{$a .=",''";}
													if(isset($ID_idEstado) && $ID_idEstado != ''){                        $a .= ",'".$ID_idEstado."'" ;             }else{$a .=",''";}
													if(isset($CodigoCuartel) && $CodigoCuartel != ''){                    $a .= ",'".$CodigoCuartel."'" ;           }else{$a .=",''";}
													if(isset($ID_idCategoria) && $ID_idCategoria != ''){                  $a .= ",'".$ID_idCategoria."'" ;          }else{$a .=",''";}
													if(isset($ID_idProducto) && $ID_idProducto != ''){                    $a .= ",'".$ID_idProducto."'" ;           }else{$a .=",''";}
													if(isset($ID_AnoPlantacion) && $ID_AnoPlantacion != ''){              $a .= ",'".$ID_AnoPlantacion."'" ;        }else{$a .=",''";}
													if(isset($ID_N_Hectareas) && $ID_N_Hectareas != ''){                  $a .= ",'".$ID_N_Hectareas."'" ;          }else{$a .=",''";}
													if(isset($ID_N_Hileras) && $ID_N_Hileras != ''){                      $a .= ",'".$ID_N_Hileras."'" ;            }else{$a .=",''";}
													if(isset($ID_N_Plantas) && $ID_N_Plantas != ''){                      $a .= ",'".$ID_N_Plantas."'" ;            }else{$a .=",''";}
													if(isset($ID_idEstadoProd) && $ID_idEstadoProd != ''){                $a .= ",'".$ID_idEstadoProd."'" ;         }else{$a .=",''";}
													if(isset($ID_DistanciaPlantacion) && $ID_DistanciaPlantacion != ''){  $a .= ",'".$ID_DistanciaPlantacion."'" ;  }else{$a .=",''";}
													if(isset($ID_DistanciaHileras) && $ID_DistanciaHileras != ''){        $a .= ",'".$ID_DistanciaHileras."'" ;     }else{$a .=",''";}
													
													// inserto los datos de registro en la db
													$query  = "INSERT INTO `cross_predios_listado_zonas` (idPredio, Nombre, idEstado, Codigo, idCategoria,
													idProducto, AnoPlantacion, Hectareas, Hileras, Plantas, idEstadoProd, DistanciaPlant, DistanciaHileras) 
													VALUES (".$a.")";
													//Consulta
													$resultado = mysqli_query ($dbConn, $query);
												}					  
											}	
										}	
									}
									
									//redirijo
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
							
						} else {
							$error['FilePredio']     = 'error/Esta tratando de subir un archivo no permitido o que excede el tamaño permitido'; 
						}
					}
				}else{
					//se devuelve error
					$error['FilePredio'] = 'error/No ha seleccionado un archivo';
					
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
			if(isset($Nombre)&&isset($idSistema)&&isset($idPredio)){
				$ndata_1 = db_select_nrows (false, 'Nombre', 'cross_predios_listado', '', "Nombre='".$Nombre."' AND idSistema='".$idSistema."' AND idPredio!='".$idPredio."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/El Nombre ya existe en el sistema';}
			/*******************************************************************/
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Filtros
				$a = "idPredio='".$idPredio."'" ;
				if(isset($idSistema) && $idSistema != ''){    $a .= ",idSistema='".$idSistema."'" ;}
				if(isset($idEstado) && $idEstado != ''){      $a .= ",idEstado='".$idEstado."'" ;}
				if(isset($Nombre) && $Nombre != ''){          $a .= ",Nombre='".$Nombre."'" ;}
				if(isset($idPais) && $idPais != ''){          $a .= ",idPais='".$idPais."'" ;}
				if(isset($idCiudad) && $idCiudad != ''){      $a .= ",idCiudad='".$idCiudad."'" ;}
				if(isset($idComuna) && $idComuna != ''){      $a .= ",idComuna='".$idComuna."'" ;}
				if(isset($Direccion) && $Direccion != ''){    $a .= ",Direccion='".$Direccion."'" ;}
				
				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $a, 'cross_predios_listado', 'idPredio = "'.$idPredio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado_1 = db_delete_data (false, 'cross_predios_listado', 'idPredio = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_2 = db_delete_data (false, 'cross_predios_listado_zonas', 'idPredio = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				$resultado_3 = db_delete_data (false, 'cross_predios_listado_zonas_ubicaciones', 'idPredio = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
				//Si ejecuto correctamente la consulta
				if($resultado_1==true OR $resultado_2==true OR $resultado_3==true){
					
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
			
			$idPredio   = $_GET['id'];
			$idEstado   = simpleDecode($_GET['estado'], fecha_actual());
			/*******************************************************/
			//se actualizan los datos
			$a = "idEstado='".$idEstado."'" ;
			$resultado = db_update_data (false, $a, 'cross_predios_listado', 'idPredio = "'.$idPredio.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			//Si ejecuto correctamente la consulta
			if($resultado==true){
				
				header( 'Location: '.$location.'&edited=true' );
				die;
				
			}
			

		break;						
					
/*******************************************************************************************************************/
	}
?>
