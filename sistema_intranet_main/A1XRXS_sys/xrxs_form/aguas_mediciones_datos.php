<?php
//Llamamos a la libreria para importar datos en excel
require '../LIBS_php/PhpOffice/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-016).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idDatos']))                   $idDatos                   = $_POST['idDatos'];
	if (!empty($_POST['idSistema']))                 $idSistema                 = $_POST['idSistema'];
	if (!empty($_POST['idUsuario']))                 $idUsuario                 = $_POST['idUsuario'];
	if (!empty($_POST['Fecha']))                     $Fecha                     = $_POST['Fecha'];
	if (!empty($_POST['Dia']))                       $Dia                       = $_POST['Dia'];
	if (!empty($_POST['idMes']))                     $idMes                     = $_POST['idMes'];
	if (!empty($_POST['Ano']))                       $Ano                       = $_POST['Ano'];
	if (!empty($_POST['Nombre']))                    $Nombre                    = $_POST['Nombre'];
	if (!empty($_POST['Observaciones']))             $Observaciones             = $_POST['Observaciones'];
	if (!empty($_POST['fCreacion']))                 $fCreacion                 = $_POST['fCreacion'];
	if (!empty($_POST['idTipo']))                    $idTipo                    = $_POST['idTipo'];
	if (!empty($_POST['idTipoMedicion']))            $idTipoMedicion            = $_POST['idTipoMedicion'];
	if (!empty($_POST['idMarcadoresUsado']))         $idMarcadoresUsado         = $_POST['idMarcadoresUsado'];
	if (!empty($_POST['ConsumoMedidor']))            $ConsumoMedidor            = $_POST['ConsumoMedidor'];

	if (!empty($_POST['idDatosDetalle']))            $idDatosDetalle            = $_POST['idDatosDetalle'];
	if (!empty($_POST['Consumo']))                   $Consumo                   = $_POST['Consumo'];

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
			case 'fCreacion':            if(empty($fCreacion)){             $error['fCreacion']               = 'error/No ha ingresado la fecha de creación';}break;
			case 'idTipo':               if(empty($idTipo)){                $error['idTipo']                  = 'error/No ha seleccionado el tipo';}break;
			case 'idTipoMedicion':       if(empty($idTipoMedicion)){        $error['idTipoMedicion']          = 'error/No ha seleccionado el tipo de medicion';}break;
			case 'idMarcadoresUsado':    if(empty($idMarcadoresUsado)){     $error['idMarcadoresUsado']       = 'error/No ha seleccionado el Tipo de marcador usado';}break;
			case 'ConsumoMedidor':       if(empty($ConsumoMedidor)){        $error['ConsumoMedidor']          = 'error/No ha ingresado el consumo del medidor';}break;

			case 'idDatosDetalle':       if(empty($idDatosDetalle)){        $error['idDatosDetalle']          = 'error/No ha ingresado el id del medidor';}break;
			case 'Consumo':              if(empty($Consumo)){               $error['Consumo']                 = 'error/No ha ingresado el consumo del remarcador';}break;

		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Nombre) && $Nombre!=''){                 $Nombre         = EstandarizarInput($Nombre);}
	if(isset($Observaciones) && $Observaciones!=''){   $Observaciones  = EstandarizarInput($Observaciones);}
	if(isset($ConsumoMedidor) && $ConsumoMedidor!=''){ $ConsumoMedidor = EstandarizarInput($ConsumoMedidor);}
	if(isset($Consumo) && $Consumo!=''){               $Consumo        = EstandarizarInput($Consumo);}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($Nombre)&&contar_palabras_censuradas($Nombre)!=0){                $error['Nombre']        = 'error/Edita Nombre,contiene palabras no permitidas';}
	if(isset($Observaciones)&&contar_palabras_censuradas($Observaciones)!=0){  $error['Observaciones'] = 'error/Edita la Observacion, contiene palabras no permitidas';}

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
			if(isset($Fecha) && $Fecha != ''&&isset($idSistema)&& $idSistema!=''){
				$idMes   = fecha2NMes($Fecha);
				$Ano     = fecha2Ano($Fecha);
				$ndata_1 = db_select_nrows (false, 'idDatos', 'aguas_mediciones_datos', '', "idMes = '".$idMes."' AND Ano = '".$Ano."' AND idSistema='".$idSistema."' AND idTipo=1", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1 > 0) {$error['ndata_1'] = 'error/La Medicion ya existe en el sistema';}
			/*******************************************************************/

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

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
								while (!feof($file_handle)){
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
								//Cargo el archivo
								$spreadsheet = IOFactory::load($_FILES['File_Med']['tmp_name']);
								//Obtengo los nombres de las hojas
								$loadedSheetNames = $spreadsheet->getSheetNames();
								//recorro las hojas
								foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
									//seteo la hoja
									$spreadsheet->setActiveSheetIndex($sheetIndex);
									//selecciono la hoja
									$worksheet = $spreadsheet->getActiveSheet();
									//obtengo el total de datos
									$highestRow = $worksheet->getHighestRow();
									//si es una hoja en especifico
									if ($loadedSheetName == "Datos"){
										//recorro
										for ($row=2; $row<=$highestRow; $row++){

											$ID_Cliente     = $worksheet->getCellByColumnAndRow(1,   $row)->getValue();
											//Se eliminan espacios en blanco
											$ID_Cliente = str_replace(' ', '', $ID_Cliente);

											//verifico si el usuario ingresado en el excel existe
											if(!isset($arrClientesMod[$ID_Cliente]['Identificador'])&&$ID_Cliente!=''&&$ID_Cliente!='N.Cliente'){
												$ndata_2++;
											}
										}
									}
								}
							}
							/*******************************************************************/
							//generacion de errores
							if($ndata_2 > 0) {$error['ndata_2'] = 'error/Hay '.$ndata_2.' clientes que no existen, favor verificar excel';}
							/*******************************************************************/
							//Si no hay errores ejecuto el codigo
							if(empty($error)){
								//Creo el registro en la tabla madre
								if(isset($idSistema) && $idSistema!=''){   $SIS_data  = "'".$idSistema."'";   }else{$SIS_data  = "''";}
								if(isset($idUsuario) && $idUsuario!=''){   $SIS_data .= ",'".$idUsuario."'";  }else{$SIS_data .= ",''";}
								if(isset($Fecha) && $Fecha!=''){
									$SIS_data .= ",'".$Fecha."'";
									$SIS_data .= ",'".fecha2NdiaMes($Fecha)."'";
									$SIS_data .= ",'".fecha2NMes($Fecha)."'";
									$SIS_data .= ",'".fecha2Ano($Fecha)."'";
									$SIS_data .= ",'Facturación mes ".fecha2NombreMes($Fecha)." ".fecha2Ano($Fecha)."'";
								}else{
									$SIS_data .= ",''";
									$SIS_data .= ",''";
									$SIS_data .= ",''";
									$SIS_data .= ",''";
									$SIS_data .= ",''";
								}
								if(isset($Observaciones) && $Observaciones!=''){ $SIS_data .= ",'".$Observaciones."'"; }else{$SIS_data .=",'Sin Observaciones'";}
								$SIS_data .=",'".fecha_actual()."'";
								$SIS_data .=",'1'";

								// inserto los datos de registro en la db
								$SIS_columns = 'idSistema, idUsuario, Fecha, Dia, idMes, Ano, Nombre,Observaciones, fCreacion, idTipo';
								$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_datos', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

								//Si ejecuto correctamente la consulta
								if($ultimo_id!=0){

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
												if(isset($idSistema) && $idSistema!=''){    $SIS_data  = "'".$idSistema."'";     }else{$SIS_data  = "''";}
												if(isset($idUsuario) && $idUsuario!=''){    $SIS_data .= ",'".$idUsuario."'";    }else{$SIS_data .= ",''";}
												$SIS_data .= ",'".$ultimo_id."'";
												if(isset($ID_FLectura) && $ID_FLectura!=''){
													$SIS_data .= ",'".ExcelFechaCompleta($ID_FLectura)."'";
													$SIS_data .= ",'".ExcelFechaDia($ID_FLectura)."'";
													$SIS_data .= ",'".ExcelFechaMes($ID_FLectura)."'";
													$SIS_data .= ",'".ExcelFechaAno($ID_FLectura)."'";
												}else{
													$SIS_data .= ",''";
													$SIS_data .= ",''";
													$SIS_data .= ",''";
													$SIS_data .= ",''";
												}
												if(isset($idCliente) && $idCliente!=''){             $SIS_data .= ",'".$idCliente."'";        }else{$SIS_data .= ",''";}
												if(isset($idMarcadores) && $idMarcadores!=''){       $SIS_data .= ",'".$idMarcadores."'";     }else{$SIS_data .= ",''";}
												if(isset($idRemarcadores) && $idRemarcadores!=''){   $SIS_data .= ",'".$idRemarcadores."'";   }else{$SIS_data .= ",''";}
												if(isset($ID_TipoMIU) && $ID_TipoMIU!=''){           $SIS_data .= ",'".$ID_TipoMIU."'";       }else{$SIS_data .= ",''";}
												if(isset($ID_MIU) && $ID_MIU!=''){                   $SIS_data .= ",'".$ID_MIU."'";           }else{$SIS_data .= ",''";}
												if(isset($ID_Contador) && $ID_Contador!=''){         $SIS_data .= ",'".$ID_Contador."'";      }else{$SIS_data .= ",''";}
												if(isset($ID_Consumo) && $ID_Consumo!=''){           $SIS_data .= ",'".$ID_Consumo."'";       }else{$SIS_data .= ",''";}
												$SIS_data .= ",'1'";
												$SIS_data .= ",'0'";
												$SIS_data .=",'".fecha_actual()."'";
												$SIS_data .= ",'1'";
												$SIS_data .= ",'1'";

												// inserto los datos de registro en la db
												$SIS_columns = 'idSistema, idUsuario, idDatos, Fecha,
												Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, TipoMIU, MIU, Contador, Consumo,
												idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura';
												$ultimo_id2 = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_datos_detalle', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

											}
										}

										//redirijo
										header( 'Location: '.$location.'&created=true' );
										die;

									//si es un excel normal
									}else{

										//Cargo el archivo
										$spreadsheet = IOFactory::load($_FILES['File_Med']['tmp_name']);
										//Obtengo los nombres de las hojas
										$loadedSheetNames = $spreadsheet->getSheetNames();
										//recorro las hojas
										foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
											//seteo la hoja
											$spreadsheet->setActiveSheetIndex($sheetIndex);
											//selecciono la hoja
											$worksheet = $spreadsheet->getActiveSheet();
											//obtengo el total de datos
											$highestRow = $worksheet->getHighestRow();
											//si es una hoja en especifico
											if ($loadedSheetName == "Datos"){
												//recorro
												for ($row=2; $row<=$highestRow; $row++){

													$ID_Cliente     = $worksheet->getCellByColumnAndRow(1,   $row)->getValue();
													$ID_Nombre      = $worksheet->getCellByColumnAndRow(2,   $row)->getValue();
													$ID_Direccion   = $worksheet->getCellByColumnAndRow(3,   $row)->getValue();
													$ID_Consumo     = $worksheet->getCellByColumnAndRow(4,   $row)->getValue();
													$ID_FLectura    = $worksheet->getCellByColumnAndRow(6,   $row)->getValue();
													$ID_TipoMIU     = $worksheet->getCellByColumnAndRow(9,   $row)->getValue();
													$ID_MIU         = $worksheet->getCellByColumnAndRow(10,  $row)->getValue();
													$ID_Contador    = $worksheet->getCellByColumnAndRow(12,  $row)->getValue();

													//si la celda no esta vacia
													if($ID_Cliente!=''){
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
															if(isset($idSistema) && $idSistema!=''){    $SIS_data  = "'".$idSistema."'";     }else{$SIS_data  = "''";}
															if(isset($idUsuario) && $idUsuario!=''){    $SIS_data .= ",'".$idUsuario."'";    }else{$SIS_data .= ",''";}
															$SIS_data .= ",'".$ultimo_id."'";
															if(isset($Fecha) && $Fecha!=''){
																$SIS_data .= ",'".$Fecha."'";
																$SIS_data .= ",'".fecha2NdiaMes($Fecha)."'";
																$SIS_data .= ",'".fecha2NMes($Fecha)."'";
																$SIS_data .= ",'".fecha2Ano($Fecha)."'";
															}else{
																$SIS_data .= ",''";
																$SIS_data .= ",''";
																$SIS_data .= ",''";
																$SIS_data .= ",''";
															}
															if(isset($idCliente) && $idCliente!=''){             $SIS_data .= ",'".$idCliente."'";        }else{$SIS_data .= ",''";}
															if(isset($idMarcadores) && $idMarcadores!=''){       $SIS_data .= ",'".$idMarcadores."'";     }else{$SIS_data .= ",''";}
															if(isset($idRemarcadores) && $idRemarcadores!=''){   $SIS_data .= ",'".$idRemarcadores."'";   }else{$SIS_data .= ",''";}
															if(isset($ID_TipoMIU) && $ID_TipoMIU!=''){           $SIS_data .= ",'".$ID_TipoMIU."'";       }else{$SIS_data .= ",''";}
															if(isset($ID_MIU) && $ID_MIU!=''){                   $SIS_data .= ",'".$ID_MIU."'";           }else{$SIS_data .= ",''";}
															if(isset($ID_Contador) && $ID_Contador!=''){         $SIS_data .= ",'".$ID_Contador."'";      }else{$SIS_data .= ",''";}
															if(isset($ID_Consumo) && $ID_Consumo!=''){           $SIS_data .= ",'".$ID_Consumo."'";       }else{$SIS_data .= ",''";}
															$SIS_data .= ",'1'";
															$SIS_data .= ",'0'";
															$SIS_data .= ",'".fecha_actual()."'";
															$SIS_data .= ",'1'";
															$SIS_data .= ",'1'";

															// inserto los datos de registro en la db
															$SIS_columns = 'idSistema, idUsuario, idDatos, Fecha,
															Dia, idMes, Ano, idCliente, idMarcadores, idRemarcadores, TipoMIU, MIU, Contador, Consumo,
															idFacturado, idFacturacion, fCreacion, idTipoFacturacion,idTipoLectura';
															$ultimo_id2 = db_insert_data (false, $SIS_columns, $SIS_data, 'aguas_mediciones_datos_detalle', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

														}
													}
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

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idDatos='".$idDatos."'";
				if(isset($idSistema) && $idSistema!=''){    $SIS_data .= ",idSistema='".$idSistema."'";}
				if(isset($idUsuario) && $idUsuario!=''){    $SIS_data .= ",idUsuario='".$idUsuario."'";}
				if(isset($Fecha) && $Fecha!=''){
					$SIS_data .= ",Fecha='".$Fecha."'";
					$SIS_data .= ",Dia='".fecha2NdiaMes($Fecha)."'";
					$SIS_data .= ",idMes='".fecha2NMes($Fecha)."'";
					$SIS_data .= ",Ano='".fecha2Ano($Fecha)."'";
					$SIS_data .= ",Nombre='Facturación mes ".fecha2NombreMes($Fecha)." ".fecha2Ano($Fecha)."'";
				}
				if(isset($Observaciones) && $Observaciones!=''){            $SIS_data .= ",Observaciones='".$Observaciones."'";}
				if(isset($fCreacion) && $fCreacion!=''){                    $SIS_data .= ",fCreacion='".$fCreacion."'";}
				if(isset($idTipo) && $idTipo!=''){                          $SIS_data .= ",idTipo='".$idTipo."'";}
				if(isset($idTipoMedicion) && $idTipoMedicion!=''){          $SIS_data .= ",idTipoMedicion='".$idTipoMedicion."'";}
				if(isset($idMarcadoresUsado) && $idMarcadoresUsado!=''){    $SIS_data .= ",idMarcadoresUsado='".$idMarcadoresUsado."'";}
				if(isset($ConsumoMedidor) && $ConsumoMedidor!=''){          $SIS_data .= ",ConsumoMedidor='".$ConsumoMedidor."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_datos', 'idDatos = "'.$idDatos.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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

			//Si no hay errores ejecuto el codigo
			if(empty($error)){
				//Filtros
				$SIS_data = "idDatosDetalle='".$idDatosDetalle."'";
				if(isset($Consumo) && $Consumo!=''){    $SIS_data .= ",Consumo='".$Consumo."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'aguas_mediciones_datos_detalle', 'idDatosDetalle = "'.$idDatosDetalle.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$error['validarNumero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero';
				$errorn++;
			}
			//Verifica si el numero recibido es un entero
			if (!validaEntero($indice)&&$indice!=''){
				$error['validaEntero'] = 'error/El valor ingresado en $indice ('.$indice.') en la opción DEL  no es un numero entero';
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
