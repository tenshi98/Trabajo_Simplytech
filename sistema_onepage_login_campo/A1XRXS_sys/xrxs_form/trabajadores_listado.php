<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridClientead                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-001).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
//require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['Rut']))        $Rut 	    = $_POST['Rut'];
	if (!empty($_POST['Latitud']))    $Latitud    = $_POST['Latitud'];
	if (!empty($_POST['Longitud']))   $Longitud   = $_POST['Longitud'];

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
			case 'Rut':        if(empty($Rut)){        $error['Rut']        = 'error/No ha ingresado el Rut';}break;
			case 'Latitud':    if(empty($Latitud)){    $error['Latitud']    = 'error/No ha ingresado la Latitud';}break;
			case 'Longitud':   if(empty($Longitud)){   $error['Longitud']   = 'error/No ha ingresado la Longitud';}break;

		}
	}
/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	//Verifica si el mail corresponde
	if(isset($Rut)&&!validarRut($Rut)){    $error['Rut']  = 'error/El Rut ingresado no es valido';}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		case 'Ingreso':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Variables internas
			$Fecha      = fecha_actual();
			$Hora       = hora_actual();
			$IP_Client  = obtenerIpCliente();
			$idEstado   = 1;
			$TimeStamp  = fecha_actual().' '.hora_actual();

			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			//Se verifica si el dato existe
			if(isset($Rut)){
				$ndata_1 = db_select_nrows (false, 'Rut', 'trabajadores_listado', '', "Rut='".$Rut."' AND idEstado=1", $dbConn, 'submitIngreso', $original, $form_trabajo);
			}
			if(isset($Latitud)&&$Latitud==0){   $ndata_2++;}
			if(isset($Longitud)&&$Longitud==0){ $ndata_3++;}
			if(isset($Fecha)&&isset($IP_Client)&&isset($idEstado)){
				//$ndata_4 = db_select_nrows (false, 'idAsistencia', 'trabajadores_asistencias_predios', '', "Fecha='".$Fecha."' AND IP_Client='".$IP_Client."' AND idEstado='".$idEstado."'", $dbConn, 'submitIngreso', $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1==0) { $error['ndata_1'] = 'error/El rut ingresado no existe en el sistema';}
			if($ndata_2>0) {  $error['ndata_2'] = 'error/No se ha ingresado la Latitud';}
			if($ndata_3>0) {  $error['ndata_3'] = 'error/No se ha ingresado la Longitud';}
			if($ndata_4>0) {  $error['ndata_4'] = 'error/Este equipo ya ha marcado un ingreso';}
			/*******************************************************************/

			//si no hay errores
			if(empty($error)){

				/*************************************/	
				//Busco al trabajador en el sistema
				$SIS_query = 'idTrabajador,idSistema';
				$SIS_join = '';
				$SIS_where = 'Rut = "'.$Rut.'" AND idEstado=1';
				$rowUser = db_select_data (false, $SIS_query, 'trabajadores_listado', $SIS_join, $SIS_where, $dbConn, 'Login-form', $original, $form_trabajo);

				//Se verifca si los datos ingresados son de un usuario
				if (isset($rowUser['idTrabajador'])&&$rowUser['idTrabajador']!='') {

					/*******************************************************************/
					//variables
					$ndata_5 = 0;
					//Se verifica si el dato existe
					if(isset($rowUser['idTrabajador'])&&isset($Fecha)&&isset($idEstado)){
						$ndata_5 = db_select_nrows (false, 'idAsistencia', 'trabajadores_asistencias_predios', '', "idTrabajador='".$rowUser['idTrabajador']."' AND Fecha='".$Fecha."' AND idEstado='".$idEstado."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}
					//Si no ha ingresado aun
					if($ndata_5==0) {
						/*************************************/	
						//Busco si estaba dentro de un predio
						$arrZonas = array();
						$arrZonas = db_select_array (false, 'cross_predios_listado_zonas.idZona,cross_predios_listado_zonas_ubicaciones.Latitud,cross_predios_listado_zonas_ubicaciones.Longitud', 'cross_predios_listado_zonas', 'LEFT JOIN `cross_predios_listado_zonas_ubicaciones` ON cross_predios_listado_zonas_ubicaciones.idZona = cross_predios_listado_zonas.idZona LEFT JOIN `cross_predios_listado` ON cross_predios_listado.idPredio = cross_predios_listado_zonas.idPredio', 'cross_predios_listado.idSistema ='.$rowUser['idSistema'], 'cross_predios_listado_zonas.idZona ASC, cross_predios_listado_zonas_ubicaciones.idUbicaciones ASC', $dbConn, 'trabajadores_listado', basename($_SERVER["REQUEST_URI"], ".php"), 'arrZonas');
						//se filtran las zonas
						filtrar($arrZonas, 'idZona');
						//se llama al modulo
						$pointLocation = new subpointLocation();
						//verifico si esta dentro	
						$idZona = inLocationPoint($arrZonas, $pointLocation, $Latitud, $Longitud);

						/**************************************************************/
						//Inserto la fecha con el ingreso
						if(isset($rowUser['idSistema']) && $rowUser['idSistema']!=''){ $a  = "'".$rowUser['idSistema']."'";        }else{$a  = "''";}
						if(isset($rowUser['idTrabajador']) && $rowUser['idTrabajador']!=''){  $a .= ",'".$rowUser['idTrabajador']."'";    }else{$a .= ",''";}
						if(isset($Fecha) && $Fecha!=''){  $a .= ",'".$Fecha."'";                      }else{$a .= ",''";}
						if(isset($Hora) && $Hora!=''){                                        $a .= ",'".$Hora."'";                       }else{$a .= ",''";}
						if(isset($TimeStamp) && $TimeStamp!=''){                              $a .= ",'".$TimeStamp."'";                  }else{$a .= ",''";}
						if(isset($IP_Client) && $IP_Client!=''){                              $a .= ",'".$IP_Client."'";                  }else{$a .= ",''";}
						if(isset($Latitud) && $Latitud!=''){                                  $a .= ",'".$Latitud."'";                    }else{$a .= ",''";}
						if(isset($Longitud) && $Longitud!=''){                                $a .= ",'".$Longitud."'";                   }else{$a .= ",''";}
						if(isset($idZona) && $idZona!=''){                                    $a .= ",'".$idZona."'";                     }else{$a .= ",''";}
						if(isset($idEstado) && $idEstado!=''){                               $a .= ",'".$idEstado."'";                   }else{$a .= ",''";}
											
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `trabajadores_asistencias_predios` (idSistema,idTrabajador,Fecha,Hora,TimeStamp,
						IP_Client,Latitud,Longitud,idZona,idEstado) 
						VALUES (".$a.")";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);

						//redirijo
						header( 'Location: principal.php' );
						die;

					//Si ya ingreso	
					}else{
						$error['ndata_5'] = 'error/Este trabajador ya tiene registrado su Ingreso, favor revisar';
					}
				//Si no se encuentra ningun usuario se envia un error	
				}else{
					$error['idCliente']   = 'error/El rut ingresado no existe en el sistema';
				}

			}
		break;
/*******************************************************************************************************************/
		case 'Egreso':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Variables internas
			$Fecha      = fecha_actual();
			$Hora       = hora_actual();
			$IP_Client  = obtenerIpCliente();
			$idEstado   = 2;
			$TimeStamp  = fecha_actual().' '.hora_actual();

			/*******************************************************************/
			//variables
			$ndata_1 = 0;
			$ndata_2 = 0;
			$ndata_3 = 0;
			$ndata_4 = 0;
			//Se verifica si el dato existe
			if(isset($Rut)){
				$ndata_1 = db_select_nrows (false, 'Rut', 'trabajadores_listado', '', "Rut='".$Rut."' AND idEstado=1", $dbConn, 'submitEgreso', $original, $form_trabajo);
			}
			if(isset($Latitud)&&$Latitud==0){   $ndata_2++;}
			if(isset($Longitud)&&$Longitud==0){ $ndata_3++;}
			if(isset($Fecha)&&isset($IP_Client)&&isset($idEstado)){
				//$ndata_4 = db_select_nrows (false, 'idAsistencia', 'trabajadores_asistencias_predios', '', "Fecha='".$Fecha."' AND IP_Client='".$IP_Client."' AND idEstado='".$idEstado."'", $dbConn, 'submitEgreso', $original, $form_trabajo);
			}
			//generacion de errores
			if($ndata_1==0) { $error['ndata_1'] = 'error/El rut ingresado no existe en el sistema';}
			if($ndata_2>0) {  $error['ndata_2'] = 'error/No se ha ingresado la Latitud';}
			if($ndata_3>0) {  $error['ndata_3'] = 'error/No se ha ingresado la Longitud';}
			if($ndata_4>0) {  $error['ndata_4'] = 'error/Este equipo ya ha marcado un egreso';}
			/*******************************************************************/

			//si no hay errores
			if(empty($error)){

				/*************************************/	
				//Busco al trabajador en el sistema
				$SIS_query = 'idTrabajador,idSistema';
				$SIS_join = '';
				$SIS_where = 'Rut = "'.$Rut.'" AND idEstado=1';
				$rowUser = db_select_data (false, $SIS_query, 'trabajadores_listado', $SIS_join, $SIS_where, $dbConn, 'Login-form', $original, $form_trabajo);

				//Se verifca si los datos ingresados son de un usuario
				if (isset($rowUser['idTrabajador'])&&$rowUser['idTrabajador']!='') {

					/*******************************************************************/
					//variables
					$ndata_5 = 0;
					//Se verifica si el dato existe
					if(isset($rowUser['idTrabajador'])&&isset($Fecha)&&isset($idEstado)){
						$ndata_5 = db_select_nrows (false, 'idAsistencia', 'trabajadores_asistencias_predios', '', "idTrabajador='".$rowUser['idTrabajador']."' AND Fecha='".$Fecha."' AND idEstado='".$idEstado."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}
					//Si no ha ingresado aun
					if($ndata_5==0) {
						/*************************************/	
						//Busco si estaba dentro de un predio
						$arrZonas = array();
						$arrZonas = db_select_array (false, 'cross_predios_listado_zonas.idZona,cross_predios_listado_zonas_ubicaciones.Latitud,cross_predios_listado_zonas_ubicaciones.Longitud', 'cross_predios_listado_zonas', 'LEFT JOIN `cross_predios_listado_zonas_ubicaciones` ON cross_predios_listado_zonas_ubicaciones.idZona = cross_predios_listado_zonas.idZona LEFT JOIN `cross_predios_listado` ON cross_predios_listado.idPredio = cross_predios_listado_zonas.idPredio', 'cross_predios_listado.idSistema ='.$rowUser['idSistema'], 'cross_predios_listado_zonas.idZona ASC, cross_predios_listado_zonas_ubicaciones.idUbicaciones ASC', $dbConn, 'trabajadores_listado', basename($_SERVER["REQUEST_URI"], ".php"), 'arrZonas');
						//se filtran las zonas
						filtrar($arrZonas, 'idZona');
						//se llama al modulo
						$pointLocation = new subpointLocation();
						//verifico si esta dentro	
						$idZona = inLocationPoint($arrZonas, $pointLocation, $Latitud, $Longitud);

						/**************************************************************/
						//Inserto la fecha con el ingreso
						if(isset($rowUser['idSistema']) && $rowUser['idSistema']!=''){ $a  = "'".$rowUser['idSistema']."'";        }else{$a  = "''";}
						if(isset($rowUser['idTrabajador']) && $rowUser['idTrabajador']!=''){  $a .= ",'".$rowUser['idTrabajador']."'";    }else{$a .= ",''";}
						if(isset($Fecha) && $Fecha!=''){  $a .= ",'".$Fecha."'";                      }else{$a .= ",''";}
						if(isset($Hora) && $Hora!=''){                                        $a .= ",'".$Hora."'";                       }else{$a .= ",''";}
						if(isset($TimeStamp) && $TimeStamp!=''){                              $a .= ",'".$TimeStamp."'";                  }else{$a .= ",''";}
						if(isset($IP_Client) && $IP_Client!=''){                              $a .= ",'".$IP_Client."'";                  }else{$a .= ",''";}
						if(isset($Latitud) && $Latitud!=''){                                  $a .= ",'".$Latitud."'";                    }else{$a .= ",''";}
						if(isset($Longitud) && $Longitud!=''){                                $a .= ",'".$Longitud."'";                   }else{$a .= ",''";}
						if(isset($idZona) && $idZona!=''){                                    $a .= ",'".$idZona."'";                     }else{$a .= ",''";}
						if(isset($idEstado) && $idEstado!=''){                               $a .= ",'".$idEstado."'";                   }else{$a .= ",''";}
											
						// inserto los datos de registro en la db
						$query  = "INSERT INTO `trabajadores_asistencias_predios` (idSistema,idTrabajador,Fecha,Hora,TimeStamp,
						IP_Client,Latitud,Longitud,idZona,idEstado) 
						VALUES (".$a.")";
						//Consulta
						$resultado = mysqli_query ($dbConn, $query);

						//redirijo
						header( 'Location: principal.php' );
						die;
					//si ya ingreso
					}else{
						$error['ndata_5'] = 'error/Este trabajador ya tiene registrado su Egreso, favor revisar';
					}

				//Si no se encuentra ningun usuario se envia un error	
				}else{
					$error['idCliente']   = 'error/El rut ingresado no existe en el sistema';
				}

			}
		break;

/*******************************************************************************************************************/
	}

?>
