<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-119).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                        Se traspasan los datos a variables                                       */
/*******************************************************************************************************************/

	//Traspaso de valores input a variables
	if (!empty($_POST['idInfraccion']))  $idInfraccion  = $_POST['idInfraccion'];
	if (!empty($_POST['Fecha']))         $Fecha         = $_POST['Fecha'];
	if (!empty($_POST['Descripcion']))   $Descripcion   = $_POST['Descripcion'];
	if (!empty($_POST['idCliente']))     $idCliente     = $_POST['idCliente'];

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
			case 'idInfraccion':  if(empty($idInfraccion)){  $error['idInfraccion'] = 'error/No ha ingresado el id';}break;
			case 'Fecha':         if(empty($Fecha)){         $error['Fecha']        = 'error/No ha ingresado la Fecha';}break;
			case 'Descripcion':   if(empty($Descripcion)){   $error['Descripcion']  = 'error/No ha seleccionado la descripcion';}break;
			case 'idCliente':     if(empty($idCliente)){     $error['idCliente']    = 'error/No ha seleccionado un vecino';}break;
		}
	}
/*******************************************************************************************************************/
/*                                          Verificacion de datos erroneos                                         */
/*******************************************************************************************************************/
	if(isset($Descripcion) && $Descripcion!=''){ $Descripcion = EstandarizarInput($Descripcion);}

/*******************************************************************************************************************/
/*                                        Verificacion de los datos ingresados                                     */
/*******************************************************************************************************************/
	if(isset($Descripcion)&&contar_palabras_censuradas($Descripcion)!=0){  $error['Descripcion'] = 'error/Edita la Descripcion, contiene palabras no permitidas';}

/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		case 'insert':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				//filtros
				if(isset($Fecha) && $Fecha!=''){              $SIS_data  = "'".$Fecha."'";          }else{$SIS_data  = "''";}
				if(isset($Descripcion) && $Descripcion!=''){  $SIS_data .= ",'".$Descripcion."'";   }else{$SIS_data .= ",''";}
				if(isset($idCliente) && $idCliente!=''){      $SIS_data .= ",'".$idCliente."'";     }else{$SIS_data .= ",''";}

				// inserto los datos de registro en la db
				$SIS_columns = 'Fecha, Descripcion, idCliente';
				$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'seg_vecinal_clientes_infracciones', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//Si ejecuto correctamente la consulta
				if($ultimo_id!=0){

					/*******************************************************************/
					//Si ha cometido mas de 3 infracciones, se banea
					$ndata_1 = 0;
					//Se verifica si el dato existe
					if(isset($idCliente)){
						$ndata_1 = db_select_nrows (false, 'idCliente', 'seg_vecinal_clientes_infracciones', '', "idCliente='".$idCliente."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					}
					//generacion de errores
					if($ndata_1 > 3) {

						//variables
						$idEstado   = 2;
						$Fecha      = fecha_actual();
						$Hora       = hora_actual();

						/******************************************************************/
						//desactivo al usuario creador del post
						$SIS_data = "idEstado='".$idEstado."'";

						/*******************************************************/
						//se actualizan los datos
						$resultado = db_update_data (false, $SIS_data, 'seg_vecinal_clientes_listado', 'idCliente = "'.$idCliente.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

						/****************************************/
						// Se trae un listado con todas las ip
						$SIS_query = 'seg_vecinal_clientes_listado_ip.IP_Client, seg_vecinal_clientes_listado.Nombre AS Vecino';
						$SIS_join  = 'LEFT JOIN `seg_vecinal_clientes_listado` ON seg_vecinal_clientes_listado.idCliente = seg_vecinal_clientes_listado_ip.idCliente';
						$SIS_where = 'seg_vecinal_clientes_listado_ip.idCliente='.$idCliente;
						$SIS_order = 0;
						$arrIPClient = array();
						$arrIPClient = db_select_array (false, $SIS_query, 'seg_vecinal_clientes_listado_ip', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

						/****************************************/
						//baneo todas las ip relacionadas
						foreach ($arrIPClient as $ipc) {
							//busca si la ip del usuario ya existe
							$n_ip = db_select_nrows (false, 'idBloqueo', 'sistema_seguridad_bloqueo_ip', '', "IP_Client='".$ipc['IP_Client']."'", $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

							//si la ip no existe la guarda
							if(isset($n_ip)&&$n_ip==0){

								//Variables
								$Motivo = 'Baneo del usuario '.$ipc['Vecino'];

								//filtros
								if(isset($Fecha) && $Fecha!=''){                        $SIS_data  = "'".$Fecha."'";              }else{$SIS_data  = "''";}
								if(isset($Hora) && $Hora!=''){                          $SIS_data .= ",'".$Hora."'";              }else{$SIS_data .= ",''";}
								if(isset($ipc['IP_Client']) && $ipc['IP_Client']!=''){  $SIS_data .= ",'".$ipc['IP_Client']."'";  }else{$SIS_data .= ",''";}
								if(isset($Motivo) && $Motivo!=''){                      $SIS_data .= ",'".$Motivo."'";            }else{$SIS_data .= ",''";}

								// inserto los datos de registro en la db
								$SIS_columns = 'Fecha,Hora, IP_Client, Motivo';
								$ultimo_id = db_insert_data (false, $SIS_columns, $SIS_data, 'sistema_seguridad_bloqueo_ip', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

							}
						}
					}

					//redirijo
					header( 'Location: '.$location.'&created=true' );
					die;

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
				$SIS_data = "idInfraccion='".$idInfraccion."'";
				if(isset($Fecha) && $Fecha!=''){               $SIS_data .= ",Fecha='".$Fecha."'";}
				if(isset($Descripcion) && $Descripcion!=''){   $SIS_data .= ",Descripcion='".$Descripcion."'";}
				if(isset($idCliente) && $idCliente!=''){       $SIS_data .= ",idCliente='".$idCliente."'";}

				/*******************************************************/
				//se actualizan los datos
				$resultado = db_update_data (false, $SIS_data, 'seg_vecinal_clientes_infracciones', 'idInfraccion = "'.$idInfraccion.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
				$resultado = db_delete_data (false, 'seg_vecinal_clientes_infracciones', 'idInfraccion = "'.$indice.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
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
