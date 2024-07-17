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
	if ( !empty($_POST['idFacturacion']) )         $idFacturacion          = $_POST['idFacturacion'];
	if ( !empty($_POST['idSistema']) )             $idSistema              = $_POST['idSistema'];
	if ( !empty($_POST['idUsuario']) )             $idUsuario              = $_POST['idUsuario'];
	if ( !empty($_POST['Fecha']) )                 $Fecha                  = $_POST['Fecha'];
	if ( !empty($_POST['Dia']) )                   $Dia                    = $_POST['Dia'];
	if ( !empty($_POST['idMes']) )                 $idMes                  = $_POST['idMes'];
	if ( !empty($_POST['Ano']) )                   $Ano                    = $_POST['Ano'];
	if ( !empty($_POST['Observaciones']) )         $Observaciones          = $_POST['Observaciones'];
	if ( !empty($_POST['fCreacion']) )             $fCreacion              = $_POST['fCreacion'];
	if ( !empty($_POST['idFacturacionDetalle']) )  $idFacturacionDetalle   = $_POST['idFacturacionDetalle'];
	if ( !empty($_POST['idCliente']) )             $idCliente              = $_POST['idCliente'];
	if ( !empty($_POST['intAnual']) )              $intAnual               = $_POST['intAnual'];
	if ( !empty($_POST['SII_NDoc']) )              $SII_NDoc               = $_POST['SII_NDoc'];
	


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
			case 'idFacturacion':          if(empty($idFacturacion)){            $error['idFacturacion']          = 'error/No ha ingresado el id';}break;
			case 'idSistema':              if(empty($idSistema)){                $error['idSistema']              = 'error/No ha ingresado el sistema';}break;
			case 'idUsuario':              if(empty($idUsuario)){                $error['idUsuario']              = 'error/No ha ingresado el usuario creador';}break;
			case 'Fecha':                  if(empty($Fecha)){                    $error['Fecha']                  = 'error/No ha ingresado el Fecha';}break;
			case 'Dia':                    if(empty($Dia)){                      $error['Dia']                    = 'error/No ha ingresado la Dia';}break;
			case 'idMes':                  if(empty($idMes)){                    $error['idMes']                  = 'error/No ha ingresado el mes';}break;
			case 'Ano':                    if(empty($Ano)){                      $error['Ano']                    = 'error/No ha seleccionado el Ano';}break;
			case 'Observaciones':          if(empty($Observaciones)){            $error['Observaciones']          = 'error/No ha ingresado la observacion';}break;
			case 'fCreacion':              if(empty($fCreacion)){                $error['fCreacion']              = 'error/No ha ingresado la fecha de creacion';}break;
			case 'idFacturacionDetalle':   if(empty($idFacturacionDetalle)){     $error['idFacturacionDetalle']   = 'error/No ha ingresado la id del detalle';}break;
			case 'idCliente':              if(empty($idCliente)){                $error['idCliente']              = 'error/No ha ingresado el cliente';}break;
			case 'intAnual':               if(empty($intAnual)){                 $error['intAnual']               = 'error/No ha ingresado el interes anual';}break;
			case 'SII_NDoc':               if(empty($SII_NDoc)){                 $error['SII_NDoc']               = 'error/No ha ingresado el numero de documento';}break;
			
		}
	}
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {

/*******************************************************************************************************************/		
		case 'create_new':
		
			//Verifica si la planilla ingresada no es del mismo mes en curso
			if(isset($idSistema)&&isset($Fecha)){
				$idMes = Fecha_mes_n($Fecha); 
				$Ano = Fecha_año($Fecha); 
				$sql_usuario = mysqli_query("SELECT idFacturacion FROM facturacion_listado WHERE idSistema='".$idSistema."' AND idMes='".$idMes."' AND Ano='".$Ano."' "); 
				$n1 = mysqli_num_rows($sql_usuario);
			} else {$n1=0;}
			//if($n1 > 0) {$error['Nombre'] = 'error/La facturacion ya existe en el sistema';}
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
			//Borro todas las sesiones
				unset($_SESSION['basicos']);
				unset($_SESSION['clientes']);
				
				//ubico los datos actualizados de facturacion
				$query = "SELECT valorCargoFijo, valorAgua, valorRecoleccion, valorVisitaCorte, 
				valorCorte1, valorCorte2, valorReposicion1, valorReposicion2
				FROM `core_sistemas`
				WHERE idSistema='{$idSistema}' ";
				$resultado = mysqli_query ($dbConn, $query);
				$row_data = mysqli_fetch_assoc ($resultado);

				
				
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($Fecha)){          $_SESSION['basicos']['Fecha'] = $Fecha;                   }else{$_SESSION['basicos']['Fecha'] = '';}
				if(isset($Observaciones)){  $_SESSION['basicos']['Observaciones'] = $Observaciones;   }else{$_SESSION['basicos']['Observaciones'] = 'Sin Observaciones';}
				if(isset($idSistema)){      $_SESSION['basicos']['idSistema'] = $idSistema;           }else{$_SESSION['basicos']['idSistema'] = '';}
				if(isset($idUsuario)){      $_SESSION['basicos']['idUsuario'] = $idUsuario;           }else{$_SESSION['basicos']['idUsuario'] = '';}
				if(isset($fCreacion)){      $_SESSION['basicos']['fCreacion'] = $fCreacion;           }else{$_SESSION['basicos']['fCreacion'] = '';}
				if(isset($intAnual)){       $_SESSION['basicos']['intAnual'] = $intAnual;             }else{$_SESSION['basicos']['intAnual'] = '';}
				
				if(isset($row_data['valorCargoFijo'])){    $_SESSION['basicos']['valorCargoFijo']     = $row_data['valorCargoFijo'];     }else{$_SESSION['basicos']['valorCargoFijo'] = '';}
				if(isset($row_data['valorAgua'])){         $_SESSION['basicos']['valorAgua']          = $row_data['valorAgua'];          }else{$_SESSION['basicos']['valorAgua'] = '';}
				if(isset($row_data['valorRecoleccion'])){  $_SESSION['basicos']['valorRecoleccion']   = $row_data['valorRecoleccion'];   }else{$_SESSION['basicos']['valorRecoleccion'] = '';}
				if(isset($row_data['valorVisitaCorte'])){  $_SESSION['basicos']['valorVisitaCorte']   = $row_data['valorVisitaCorte'];   }else{$_SESSION['basicos']['valorVisitaCorte'] = '';}
				if(isset($row_data['valorCorte1'])){       $_SESSION['basicos']['valorCorte1']        = $row_data['valorCorte1'];        }else{$_SESSION['basicos']['valorCorte1'] = '';}
				if(isset($row_data['valorCorte2'])){       $_SESSION['basicos']['valorCorte2']        = $row_data['valorCorte2'];        }else{$_SESSION['basicos']['valorCorte2'] = '';}
				if(isset($row_data['valorReposicion1'])){  $_SESSION['basicos']['valorReposicion1']   = $row_data['valorReposicion1'];   }else{$_SESSION['basicos']['valorReposicion1'] = '';}
				if(isset($row_data['valorReposicion2'])){  $_SESSION['basicos']['valorReposicion2']   = $row_data['valorReposicion2'];   }else{$_SESSION['basicos']['valorReposicion2'] = '';}
				
				
				
				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;
			}
		
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
		case 'edit_datos':
		
			if ( empty($error) ) {
				//ubico los datos actualizados de facturacion
				$query = "SELECT valorCargoFijo, valorAgua, valorRecoleccion, valorVisitaCorte, 
				valorCorte1, valorCorte2, valorReposicion1, valorReposicion2
				FROM `core_sistemas`
				WHERE idSistema='{$idSistema}' ";
				$resultado = mysqli_query ($dbConn, $query);
				$row_data = mysqli_fetch_assoc ($resultado);
					
					
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($Fecha)){          $_SESSION['basicos']['Fecha'] = $Fecha;                   }else{$_SESSION['basicos']['Fecha'] = '';}
				if(isset($Nombre)){         $_SESSION['basicos']['Nombre'] = $Nombre;                 }else{$_SESSION['basicos']['Nombre'] = '';}
				if(isset($Observaciones)){  $_SESSION['basicos']['Observaciones'] = $Observaciones;   }else{$_SESSION['basicos']['Observaciones'] = 'Sin Observaciones';}
				if(isset($intAnual)){       $_SESSION['basicos']['intAnual'] = $intAnual;             }else{$_SESSION['basicos']['intAnual'] = '';}
				
				if(isset($row_data['valorCargoFijo'])){    $_SESSION['basicos']['valorCargoFijo']     = $row_data['valorCargoFijo'];     }else{$_SESSION['basicos']['valorCargoFijo'] = '';}
				if(isset($row_data['valorAgua'])){         $_SESSION['basicos']['valorAgua']          = $row_data['valorAgua'];          }else{$_SESSION['basicos']['valorAgua'] = '';}
				if(isset($row_data['valorRecoleccion'])){  $_SESSION['basicos']['valorRecoleccion']   = $row_data['valorRecoleccion'];   }else{$_SESSION['basicos']['valorRecoleccion'] = '';}
				if(isset($row_data['valorVisitaCorte'])){  $_SESSION['basicos']['valorVisitaCorte']   = $row_data['valorVisitaCorte'];   }else{$_SESSION['basicos']['valorVisitaCorte'] = '';}
				if(isset($row_data['valorCorte1'])){       $_SESSION['basicos']['valorCorte1']        = $row_data['valorCorte1'];        }else{$_SESSION['basicos']['valorCorte1'] = '';}
				if(isset($row_data['valorCorte2'])){       $_SESSION['basicos']['valorCorte2']        = $row_data['valorCorte2'];        }else{$_SESSION['basicos']['valorCorte2'] = '';}
				if(isset($row_data['valorReposicion1'])){  $_SESSION['basicos']['valorReposicion1']   = $row_data['valorReposicion1'];   }else{$_SESSION['basicos']['valorReposicion1'] = '';}
				if(isset($row_data['valorReposicion2'])){  $_SESSION['basicos']['valorReposicion2']   = $row_data['valorReposicion2'];   }else{$_SESSION['basicos']['valorReposicion2'] = '';}
				
				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;
			}
		
		break;
/*******************************************************************************************************************/		
		case 'add_cliente':
			
			//Variables
			$SIS_idSistema           = $_SESSION['basicos']['idSistema'];
			$SIS_Fecha_Ano           = Fecha_año($_SESSION['basicos']['Fecha']);
			$SIS_Fecha_Mes           = Fecha_mes_n($_SESSION['basicos']['Fecha']);
				
			//verifico si el usuario tiene pagado el periodo
			$query = "SELECT clientes_listado.idCliente
			FROM `clientes_listado`
			LEFT JOIN `mediciones_datos_detalle` ON mediciones_datos_detalle.idCliente = clientes_listado.idCliente
			WHERE clientes_listado.idSistema = '{$SIS_idSistema}' 
			AND mediciones_datos_detalle.idMes = '{$SIS_Fecha_Mes}' 
			AND mediciones_datos_detalle.Ano = '{$SIS_Fecha_Ano}'
			AND mediciones_datos_detalle.idCliente = '{$idCliente}'
			AND mediciones_datos_detalle.idFacturado = 1
			AND clientes_listado.idFacturable != 3
			GROUP BY clientes_listado.idCliente
			ORDER BY clientes_listado.idCliente ";
			$resultado = mysqli_query ($dbConn, $query);
			$cliente = mysqli_fetch_assoc ($resultado);
			
			//validacion
			if(!isset($cliente['idCliente']) or $cliente['idCliente']==''){
				$error['usuario']  = 'error/El cliente seleccionado ya tiene el periodo facturado';
			}	
			
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idCliente)){       $_SESSION['clientes'][$idCliente]['idCliente'] = $idCliente;             }else{$_SESSION['clientes']['idCliente'] = '';}
				
				//redirijo a la vista
				header( 'Location: '.$location.'&view=true' );
				die;
			}

		break;
/*******************************************************************************************************************/		
		case 'add_all_cliente':

			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				//Variables
				$SIS_idSistema           = $_SESSION['basicos']['idSistema'];
				$SIS_Fecha_Ano           = Fecha_año($_SESSION['basicos']['Fecha']);
				$SIS_Fecha_Mes           = Fecha_mes_n($_SESSION['basicos']['Fecha']);
			
				//reviso a todos los clientes del sistema que no tengan facturado ese periodo
				$arrClientes = array();
				$query = "SELECT clientes_listado.idCliente
				FROM `clientes_listado`
				LEFT JOIN `mediciones_datos_detalle` ON mediciones_datos_detalle.idCliente = clientes_listado.idCliente
				WHERE clientes_listado.idSistema = '{$SIS_idSistema}' 
				AND mediciones_datos_detalle.idMes = '{$SIS_Fecha_Mes}' 
				AND mediciones_datos_detalle.Ano = '{$SIS_Fecha_Ano}'
				AND mediciones_datos_detalle.idFacturado = 1
				AND clientes_listado.idFacturable != 3
				GROUP BY clientes_listado.idCliente
				ORDER BY clientes_listado.idCliente ";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				

				foreach ($arrClientes as $cliente) {
					$_SESSION['clientes'][$cliente['idCliente']]['idCliente'] = $cliente['idCliente'];
				}

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
		case 'facturar':
			///////////////////////////////////////////////////////////////////////////////////////
			//                                                                                   //
			//                                   Variables                                       //
			//                                                                                   //
			///////////////////////////////////////////////////////////////////////////////////////
			$SIS_idSistema       = $_SESSION['basicos']['idSistema'];
			$SIS_Fecha_Completa  = $_SESSION['basicos']['Fecha'];
			$SIS_Fecha_Ano       = Fecha_año($_SESSION['basicos']['Fecha']);
			$SIS_Fecha_Mes       = Fecha_mes_n($_SESSION['basicos']['Fecha']);
			$SIS_año_pasado      = ano_actual()-1;
			$SIS_año_proximo     = ano_actual();
			$SIS_N_Meses         = 12;
			$subtotal            = 0;
			$SIS_Fecha_Mes_prox  = $SIS_Fecha_Mes + 1;

			if($SIS_Fecha_Mes_prox==13){
				$SIS_Fecha_Mes_prox = 1;
				$SIS_año_proximo = ano_actual()+1;	
			}
			///////////////////////////////////////////////////////////////////////////////////////
			//                                                                                   //
			//                                   Consultas                                       //
			//                                                                                   //
			///////////////////////////////////////////////////////////////////////////////////////
			// Se traen todos los datos de la empresa
			$query = "SELECT  
			core_sistemas.Nombre, 
			core_sistemas.Rut,  
			core_sistemas.Direccion,  
			core_sistemas.Ciudad,  
			core_sistemas.Comuna,  
			core_sistemas.Fono,  
			core_sistemas.valorCargoFijo,  
			core_sistemas.valorAgua,  
			core_sistemas.valorRecoleccion,
			core_sistemas.valorVisitaCorte,  
			core_sistemas.valorCorte1,  
			core_sistemas.valorCorte2,  
			core_sistemas.valorReposicion1,  
			core_sistemas.valorReposicion2,
			core_sistemas.NdiasPago,
			core_sistemas.Fac_nEmergencia,
			core_sistemas.Fac_nConsultas,
			core_sistemas_rubro.Nombre AS NombreRubro

			FROM `core_sistemas`
			LEFT JOIN `core_sistemas_rubro` ON core_sistemas_rubro.idRubro = core_sistemas.idRubro
			WHERE core_sistemas.idSistema = {$SIS_idSistema} ";
			$resultado = mysqli_query ($dbConn, $query);
			$rowSistema = mysqli_fetch_assoc ($resultado);
			
			/* ************************************************** */
			// Se trae un listado con todos los clientes
			$arrClientes = array();
			$query = "SELECT  
			clientes_listado.idCliente,
			clientes_listado.Nombre,
			clientes_listado.Direccion,
			clientes_listado.Identificador,
			clientes_listado.UnidadHabitacional,
			clientes_listado.Arranque,
			clientes_listado.idFacturable,
			mnt_ubicacion_comunas.Nombre AS NombreComuna,
			mnt_ubicacion_ciudad.Nombre AS NombreCiudad,
			marcadores_listado.Nombre AS NombreMedidor,
			marcadores_remarcadores.Nombre AS NombreMarcador,
				
				(SELECT  DetalleTotalAPagar
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idEstado = 1
				ORDER BY Fecha DESC
				LIMIT 1) AS SaldoAnterior,
				
				(SELECT  ClienteFechaVencimiento
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY ClienteFechaVencimiento DESC
				LIMIT 1) AS FechaVencimiento,
				
				(SELECT DetalleTotalAPagar
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY Fecha DESC
				LIMIT 1) AS MontoPactado,
				
				(SELECT fechaPago
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY Fecha DESC
				LIMIT 1) AS FechaPago,

				(SELECT montoPago
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY Fecha DESC
				LIMIT 1) AS MontoPagado,
				
				(SELECT  idDatosDetalle
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY Fecha DESC
				LIMIT 1) AS DetMesActualidDatosDetalle,
				
				(SELECT  COUNT(idFacturacionDetalle) AS Cuenta
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idEstado = 1
				LIMIT 1) AS CuentaPendientes,
	
				(SELECT fechaPago
				FROM `clientes_pago`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY fechaPago DESC
				LIMIT 1) AS PagoFecha,
				
				(SELECT montoPago
				FROM `clientes_pago`
				WHERE idCliente = clientes_listado.idCliente 
				ORDER BY fechaPago DESC
				LIMIT 1) AS PagoMonto

			FROM `clientes_listado`
			LEFT JOIN `mnt_ubicacion_comunas`      ON mnt_ubicacion_comunas.idComuna            = clientes_listado.idComuna
			LEFT JOIN `mnt_ubicacion_ciudad`       ON mnt_ubicacion_ciudad.idCiudad             = clientes_listado.idCiudad
			LEFT JOIN `marcadores_listado`         ON marcadores_listado.idMarcadores           = clientes_listado.idMarcadores
			LEFT JOIN `marcadores_remarcadores`    ON marcadores_remarcadores.idRemarcadores    = clientes_listado.idRemarcadores

			WHERE clientes_listado.idSistema='{$SIS_idSistema}'
			ORDER BY clientes_listado.idCliente";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrClientes,$row );
			}
			
			/* ************************************************** */
			//Se traen todos los eventos transcurridos en el mes
			$arrEventos = array();
			$query = "SELECT idCliente, idTipo, ValorEvento, Fecha
			FROM `clientes_eventos`
			WHERE idSistema = '{$SIS_idSistema}'
			AND Ano =  '{$SIS_Fecha_Ano}'
			AND idMes =  '{$SIS_Fecha_Mes}'
			ORDER BY idCliente ASC, Ano ASC, idMes ASC";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrEventos,$row );
			}

	
			//PROGRAMACION CREATIVA
			$mesEvento = array();
			foreach ($arrEventos as $datos) { 	
				$mesEvento[$datos['idCliente']][$datos['idTipo']]['idTipo'] = $datos['idTipo'];
				$mesEvento[$datos['idCliente']][$datos['idTipo']]['ValorEvento'] = $datos['ValorEvento'];
				$mesEvento[$datos['idCliente']][$datos['idTipo']]['Fecha'] = $datos['Fecha'];	//se toma la fecha de facturacion en vez de la de ejecucion
				$mesEvento[$datos['idCliente']][$datos['idTipo']]['FechaEjecucion'] = $datos['FechaEjecucion'];
			}
			
			/* ************************************************** */
			// Se traen todos los datos del mes facturado del cliente
			$z = "WHERE mediciones_datos_detalle.idSistema='{$SIS_idSistema}'";
			$z.= " AND mediciones_datos_detalle.Ano >= {$SIS_año_pasado}";
			

			//se consulta
			$arrDatos = array();
			$query = "SELECT 
			mediciones_datos_detalle.idCliente,
			mediciones_datos_detalle.Ano, 
			mediciones_datos_detalle.idMes, 
			mediciones_datos_detalle.Consumo, 
			mediciones_datos_detalle.Fecha,

			mediciones_datos_detalle.idTipoMedicion,
			mediciones_datos_detalle.ConsumoMedidor,
			mediciones_datos_detalle.ConsumoGeneral,
			mediciones_datos_detalle.CantRemarcadores,

			data1.Nombre AS TipoFacturacion,
			data2.Nombre AS TipoLectura

			FROM `mediciones_datos_detalle`
			LEFT JOIN `mediciones_datos_detalle_tipofacturacion` data1 ON data1.idTipoFacturacion   = mediciones_datos_detalle.idTipoFacturacion
			LEFT JOIN `mediciones_datos_detalle_tipolectura`     data2 ON data2.idTipoLectura       = mediciones_datos_detalle.idTipoLectura
			".$z."
			ORDER BY mediciones_datos_detalle.idCliente ASC, mediciones_datos_detalle.Ano ASC, mediciones_datos_detalle.idMes DESC ";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrDatos,$row );
			}
			
			//PROGRAMACION CREATIVA
			$mes = array();
			foreach ($arrDatos as $datos) { 
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['Consumo'])){           $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['Consumo'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['Fecha'])){             $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['Fecha'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoFac'])){           $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoFac'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoLec'])){           $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoLec'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoMedicion'])){      $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoMedicion'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['ConsumoMedidor'])){    $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['ConsumoMedidor'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['ConsumoGeneral'])){    $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['ConsumoGeneral'] = 0; }
				if(!isset($mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['CantRemarcadores'])){  $mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['CantRemarcadores'] = 0; }
				
				
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['Consumo'] = $datos['Consumo'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['Fecha'] = $datos['Fecha'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoFac'] = $datos['TipoFacturacion'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoLec'] = $datos['TipoLectura'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['TipoMedicion'] = $datos['idTipoMedicion'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['ConsumoMedidor'] = $datos['ConsumoMedidor'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['ConsumoGeneral'] = $datos['ConsumoGeneral'];
				$mes[$datos['idCliente']][$datos['Ano']][$datos['idMes']]['CantRemarcadores'] = $datos['CantRemarcadores'];								
			}
			
			//MAS PROGRAMACION CREATIVA
			$xmes = valores_enteros($SIS_Fecha_Mes);
			$xaño = ano_actual();
			$consumos = array();
			$mes_01 = array();
			$mes_02 = array();
			$mes_03 = array();
			$mes_04 = array();
			$mes_05 = array();
			$mes_06 = array();
			$mes_07 = array();
			$mes_08 = array();
			$mes_09 = array();
			$mes_10 = array();
			$mes_11 = array();
			$mes_12 = array();
			foreach ($arrClientes as $cliente) {
				
				for ($xcontador = 12; $xcontador > 0; $xcontador--) {
									
					if($xmes>0){
						$xaño = ano_actual();
						
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['Consumo'])){            $ndata1            = $mes[$cliente['idCliente']][$xaño][$xmes]['Consumo'];             }else{$ndata1 = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['Fecha'])){              $nFecha            = $mes[$cliente['idCliente']][$xaño][$xmes]['Fecha'];               }else{$nFecha = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['TipoFac'])){            $TipoFac           = $mes[$cliente['idCliente']][$xaño][$xmes]['TipoFac'];             }else{$TipoFac = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['TipoLec'])){            $TipoLec           = $mes[$cliente['idCliente']][$xaño][$xmes]['TipoLec'];             }else{$TipoLec = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['TipoMedicion'])){       $TipoMedicion      = $mes[$cliente['idCliente']][$xaño][$xmes]['TipoMedicion'];        }else{$TipoMedicion = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoMedidor'])){     $ConsumoMedidor    = $mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoMedidor'];      }else{$ConsumoMedidor = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoGeneral'])){     $ConsumoGeneral    = $mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoGeneral'];      }else{$ConsumoGeneral = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['CantRemarcadores'])){   $CantRemarcadores  = $mes[$cliente['idCliente']][$xaño][$xmes]['CantRemarcadores'];    }else{$CantRemarcadores = 0;};
						
						$consumos[$cliente['idCliente']][$xcontador]['mes'] = $xmes;
						$consumos[$cliente['idCliente']][$xcontador]['año'] = $xaño;
						$consumos[$cliente['idCliente']][$xcontador]['Consumo'] = $ndata1;
						$consumos[$cliente['idCliente']][$xcontador]['Fecha'] = $nFecha;
						$consumos[$cliente['idCliente']][$xcontador]['TipoFac'] = $TipoFac;
						$consumos[$cliente['idCliente']][$xcontador]['TipoLec'] = $TipoLec;
						$consumos[$cliente['idCliente']][$xcontador]['TipoMedicion'] = $TipoMedicion;
						$consumos[$cliente['idCliente']][$xcontador]['ConsumoMedidor'] = $ConsumoMedidor;
						$consumos[$cliente['idCliente']][$xcontador]['ConsumoGeneral'] = $ConsumoGeneral;
						$consumos[$cliente['idCliente']][$xcontador]['CantRemarcadores'] = $CantRemarcadores;
					}else{
						$xmes = 12;
						$xaño = ano_actual();
						$xaño = $xaño-1;
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['Consumo'])){            $ndata1             = $mes[$cliente['idCliente']][$xaño][$xmes]['Consumo'];             }else{$ndata1 = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['Fecha'])){              $nFecha             = $mes[$cliente['idCliente']][$xaño][$xmes]['Fecha'];               }else{$nFecha = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['TipoFac'])){            $TipoFac            = $mes[$cliente['idCliente']][$xaño][$xmes]['TipoFac'];             }else{$TipoFac = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['TipoLec'])){            $TipoLec            = $mes[$cliente['idCliente']][$xaño][$xmes]['TipoLec'];             }else{$TipoLec = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['TipoMedicion'])){       $TipoMedicion       = $mes[$cliente['idCliente']][$xaño][$xmes]['TipoMedicion'];        }else{$TipoMedicion = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoMedidor'])){     $ConsumoMedidor     = $mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoMedidor'];      }else{$ConsumoMedidor = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoGeneral'])){     $ConsumoGeneral     = $mes[$cliente['idCliente']][$xaño][$xmes]['ConsumoGeneral'];      }else{$ConsumoGeneral = 0;};
						if(isset($mes[$cliente['idCliente']][$xaño][$xmes]['CantRemarcadores'])){   $CantRemarcadores   = $mes[$cliente['idCliente']][$xaño][$xmes]['CantRemarcadores'];    }else{$CantRemarcadores = 0;};
						
						$consumos[$cliente['idCliente']][$xcontador]['mes'] = $xmes;
						$consumos[$cliente['idCliente']][$xcontador]['año'] = $xaño;
						$consumos[$cliente['idCliente']][$xcontador]['Consumo'] = $ndata1;
						$consumos[$cliente['idCliente']][$xcontador]['Fecha'] = $nFecha;
						$consumos[$cliente['idCliente']][$xcontador]['TipoFac'] = $TipoFac;
						$consumos[$cliente['idCliente']][$xcontador]['TipoLec'] = $TipoLec;
						$consumos[$cliente['idCliente']][$xcontador]['TipoMedicion'] = $TipoMedicion;
						$consumos[$cliente['idCliente']][$xcontador]['ConsumoMedidor'] = $ConsumoMedidor;
						$consumos[$cliente['idCliente']][$xcontador]['ConsumoGeneral'] = $ConsumoGeneral;
						$consumos[$cliente['idCliente']][$xcontador]['CantRemarcadores'] = $CantRemarcadores;
					}
					
					$xmes = $xmes-1;						
				}
				
				
				
				
			}
			//CALCULO PARA LOS REMARCADORES
			//variables calculo remarcadores
			$rem_cantidad = array();
			$rem_procentaje = array();
			$rem_modalidad = array();
			$rem_diferencia = array();
			
			foreach ($arrClientes as $cliente) {
				//para recorrer el año completo
				for ($xcontador = 1; $xcontador < 13; $xcontador++) {
					//se generan las variables vacias
					$rem_cantidad[$cliente['idCliente']][$xcontador]    = 0;
					$rem_procentaje[$cliente['idCliente']][$xcontador]  = 0;
					$rem_modalidad[$cliente['idCliente']][$xcontador]   = '';
					$rem_diferencia[$cliente['idCliente']][$xcontador]  = 0;
					
					//verificacion de remarcador
					if($consumos[$cliente['idCliente']][$xcontador]['TipoMedicion']!=0){
						//verifico el tipo de medicion
						switch ($consumos[$cliente['idCliente']][$xcontador]['TipoMedicion']) {
							//Calculo valor promedio
							case 1:
								$xcalc = $consumos[$cliente['idCliente']][$xcontador]['ConsumoMedidor'] - $consumos[$cliente['idCliente']][$xcontador]['ConsumoGeneral'];
								
								$rem_modalidad[$cliente['idCliente']][$xcontador]   = 'Promedio';
								$rem_cantidad[$cliente['idCliente']][$xcontador]    = $xcalc / $consumos[$cliente['idCliente']][$xcontador]['CantRemarcadores'];
								$rem_procentaje[$cliente['idCliente']][$xcontador]  = 100 / $consumos[$cliente['idCliente']][$xcontador]['CantRemarcadores'];
								$rem_diferencia[$cliente['idCliente']][$xcontador]  = $xcalc;
							break;
							
							//calculo proporcional
							case 2:
								$xbla = $xcontador - 1;
								if($xbla!=0){
									$tempvar = valores_truncados($consumos[$cliente['idCliente']][$xcontador]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][$xbla]['Consumo']);
								}else{
									$tempvar = valores_truncados($consumos[$cliente['idCliente']][$xcontador]['Consumo']);
								}
								$xcalc  = $consumos[$cliente['idCliente']][$xcontador]['ConsumoMedidor'] - $consumos[$cliente['idCliente']][$xcontador]['ConsumoGeneral'];
								//se verifica que el consumo sea distinto de 0
								if($consumos[$cliente['idCliente']][$xcontador]['ConsumoGeneral']!=0){   
									$xcalc2 = valores_truncados(($tempvar*100)/$consumos[$cliente['idCliente']][$xcontador]['ConsumoGeneral']);
								}else{
									$xcalc2 = 0;
								}
								$rem_modalidad[$cliente['idCliente']][$xcontador]  = 'Con Reparto(Proporcional al consumo)';
								$rem_cantidad[$cliente['idCliente']][$xcontador]   = ($xcalc*$xcalc2) /100 ;
								$rem_cantidad[$cliente['idCliente']][$xcontador]   = number_format($rem_cantidad[$cliente['idCliente']][$xcontador], 2);
								$rem_procentaje[$cliente['idCliente']][$xcontador] = $xcalc2;
								$rem_diferencia[$cliente['idCliente']][$xcontador] = $xcalc;
							break;
						}
					}
				}
			}
			
			//AUN MUCHO MAS PROGRAMACION CREATIVA
			foreach ($arrClientes as $cliente) {
				
				//valores
				if($consumos[$cliente['idCliente']][1]['Consumo']!=0){  $mes_01[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][1]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][1] ;                                                                      }else{$mes_01[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][2]['Consumo']!=0){  $mes_02[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][2]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][1]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][2];     }else{$mes_02[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][3]['Consumo']!=0){  $mes_03[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][3]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][2]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][3];     }else{$mes_03[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][4]['Consumo']!=0){  $mes_04[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][4]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][3]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][4];     }else{$mes_04[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][5]['Consumo']!=0){  $mes_05[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][5]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][4]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][5];     }else{$mes_05[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][6]['Consumo']!=0){  $mes_06[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][6]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][5]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][6];     }else{$mes_06[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][7]['Consumo']!=0){  $mes_07[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][7]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][6]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][7];     }else{$mes_07[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][8]['Consumo']!=0){  $mes_08[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][8]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][7]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][8];     }else{$mes_08[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][9]['Consumo']!=0){  $mes_09[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][9]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][8]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][9];     }else{$mes_09[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][10]['Consumo']!=0){ $mes_10[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][10]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][9]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][10];   }else{$mes_10[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][11]['Consumo']!=0){ $mes_11[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][11]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][10]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][11];  }else{$mes_11[$cliente['idCliente']] = 0;}
				if($consumos[$cliente['idCliente']][12]['Consumo']!=0){ $mes_12[$cliente['idCliente']] = (valores_truncados($consumos[$cliente['idCliente']][12]['Consumo'])-valores_truncados($consumos[$cliente['idCliente']][11]['Consumo'])) + $rem_cantidad[$cliente['idCliente']][12];  }else{$mes_12[$cliente['idCliente']] = 0;}

				
			}
			
			/* ************************************************** */
			//se consultan los estados de pago de los clientes
			$arrEstados = array();
			$query = "SELECT idEstadoPago, Nombre
			FROM `clientes_estadopago`";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrEstados,$row );
			}
			//PROGRAMACION CREATIVA
			$estados = array();
			foreach ($arrEstados as $est) { 
				if(!isset($estados[$est['idEstadoPago']]['Nombre'])){   $estados[$est['idEstadoPago']]['Nombre'] = 0; }
				$estados[$est['idEstadoPago']]['Nombre'] = $est['Nombre'];
			}
			
			
			/* ************************************************** */
			//Se traen todos los cargos transcurridos en el mes
			$arrCargos = array();
			$query = "SELECT idCliente, FechaEjecucion, Observacion, ValorCargo
			FROM `clientes_otros_cargos`
			WHERE idSistema = '{$SIS_idSistema}'
			AND Ano =  '{$SIS_Fecha_Ano}'
			AND idMes =  '{$SIS_Fecha_Mes}'
			ORDER BY idCliente ASC, Ano ASC, idMes ASC";
			$resultado = mysqli_query ($dbConn, $query);
			while ( $row = mysqli_fetch_assoc ($resultado)) {
			array_push( $arrCargos,$row );
			}
			
			//PROGRAMACION CREATIVA
			$mesCargos = array();
			$cargoCont = 0;
			$ultimocliente = 0;
			foreach ($arrCargos as $datos) { 
				//comparo el ultimo cliente
				if($ultimocliente!=$datos['idCliente']){
					$ultimocliente = $datos['idCliente'];
					$cargoCont = 0;
				}
				//creo las variables	
				$mesCargos[$datos['idCliente']][$cargoCont]['Observacion']     = $datos['Observacion'];
				$mesCargos[$datos['idCliente']][$cargoCont]['ValorCargo']      = $datos['ValorCargo'];
				$mesCargos[$datos['idCliente']][$cargoCont]['FechaEjecucion']  = $datos['FechaEjecucion'];
				$cargoCont++;	
			}
			
			///////////////////////////////////////////////////////////////////////////////////////
			//                                                                                   //
			//                              Validacion de Errores                                //
			//                                                                                   //
			///////////////////////////////////////////////////////////////////////////////////////
			//Se verifica que todos los usuarios tengan el ingreso de datos en el mes en curso
			foreach ($arrClientes as $cliente) {
				foreach ($_SESSION['clientes'] as $key => $clientes){
					if($cliente['idCliente']==$clientes['idCliente']&&$cliente['DetMesActualidDatosDetalle']==''){
						$error['usuario']  = 'error/Uno de los clientes no tiene una facturacion de este mes';
					}
				}
			}
			
			
			///////////////////////////////////////////////////////////////////////////////////////
			//                                                                                   //
			//                                     Ejecucion                                     //
			//                                                                                   //
			///////////////////////////////////////////////////////////////////////////////////////
			// si no hay errores ejecuto el codigo	
			if ( empty($error) ) {
				
				/* ************************************************** */
				//Se crea el registro madre
				if(isset($SIS_idSistema) && $SIS_idSistema != ''){   $a  = "'".$SIS_idSistema."'" ;   }else{$a  ="''";}
				if(isset($_SESSION['basicos']['idUsuario']) && $_SESSION['basicos']['idUsuario'] != ''){   
					$a .= ",'".$_SESSION['basicos']['idUsuario']."'" ;  
				}else{
					$a .=",''";
				}
				if(isset($_SESSION['basicos']['Fecha']) && $_SESSION['basicos']['Fecha'] != ''){                  
					$a .= ",'".$_SESSION['basicos']['Fecha']."'" ; 
					$a .= ",'".dia_transformado($_SESSION['basicos']['Fecha'])."'" ; 
					$a .= ",'".Fecha_mes_n($_SESSION['basicos']['Fecha'])."'" ; 
					$a .= ",'".Fecha_año($_SESSION['basicos']['Fecha'])."'" ;          
				}else{
					$a .=",''";
					$a .=",''";
					$a .=",''";
					$a .=",''";
				}
				if(isset($_SESSION['basicos']['Observaciones']) && $_SESSION['basicos']['Observaciones'] != ''){  $a .= ",'".$_SESSION['basicos']['Observaciones']."'" ;  }else{$a .=",'Sin Observaciones'";}
				if(isset($_SESSION['basicos']['fCreacion']) && $_SESSION['basicos']['fCreacion'] != ''){          $a .= ",'".$_SESSION['basicos']['fCreacion']."'" ;      }else{$a .=",''";}
				if(isset($_SESSION['basicos']['intAnual']) && $_SESSION['basicos']['intAnual'] != ''){            $a .= ",'".$_SESSION['basicos']['intAnual']."'" ;       }else{$a .=",''";}
												
				// inserto los datos de registro en la db
				$query  = "INSERT INTO `facturacion_listado` (idSistema,idUsuario, Fecha, Dia, idMes, Ano,
				Observaciones, fCreacion, intAnual ) 
				VALUES ({$a} )";
				$result = mysqli_query($dbConn, $query);
				//recibo el último id generado por mi sesion
				$ultimo_id = mysqli_insert_id($dbConn);
			
			
			
			
	
							
								
				/* ************************************************** */
				foreach ($arrClientes as $cliente) { 
					foreach ($_SESSION['clientes'] as $key => $clientes){
						if($cliente['idCliente']==$clientes['idCliente']){
							
							/* ************************************************** */
							//variables para sacar los totales
							$DetalleCargoFijoValor = $rowSistema['valorCargoFijo']*1;
							$DetalleConsumoCantidad = $mes_12[$cliente['idCliente']];
							$DetalleConsumoValor = valores_truncados($rowSistema['valorAgua'] * $mes_12[$cliente['idCliente']]);
							$DetalleRecoleccionCantidad = $mes_12[$cliente['idCliente']];
							$DetalleRecoleccionValor = valores_truncados($rowSistema['valorRecoleccion'] * $mes_12[$cliente['idCliente']]);
							
							$subtotal = 0;
							$subtotal = $subtotal + $DetalleCargoFijoValor;
							$subtotal = $subtotal + $DetalleConsumoValor;
							$subtotal = $subtotal + $DetalleRecoleccionValor;
							
							
							/* ************************************************** */
							//visita corte
							if(isset($mesEvento[$cliente['idCliente']][1]['idTipo'])){
								$DetalleVisitaCorte = $mesEvento[$cliente['idCliente']][1]['ValorEvento'];
								$subtotal = $subtotal + $DetalleVisitaCorte; 
							}else{
								$DetalleVisitaCorte = 0;
							}
							//corte 1
							if(isset($mesEvento[$cliente['idCliente']][2]['idTipo'])){
								$DetalleCorte1Fecha = $mesEvento[$cliente['idCliente']][2]['FechaEjecucion'];
								$DetalleCorte1Valor = $mesEvento[$cliente['idCliente']][2]['ValorEvento']; 
								$subtotal = $subtotal + $DetalleCorte1Valor;
							}else{
								$DetalleCorte1Fecha = 0;
								$DetalleCorte1Valor = 0;
							}
							//corte 2
							if(isset($mesEvento[$cliente['idCliente']][3]['idTipo'])){
								$DetalleCorte2Fecha = $mesEvento[$cliente['idCliente']][3]['FechaEjecucion'];
								$DetalleCorte2Valor = $mesEvento[$cliente['idCliente']][3]['ValorEvento'];
								$subtotal = $subtotal + $DetalleCorte2Valor; 
							}else{
								$DetalleCorte2Fecha = 0;
								$DetalleCorte2Valor = 0;
							}
							//reposicion 1
							if(isset($mesEvento[$cliente['idCliente']][4]['idTipo'])){
								$DetalleReposicion1Fecha = $mesEvento[$cliente['idCliente']][4]['FechaEjecucion'];
								$DetalleReposicion1Valor = $mesEvento[$cliente['idCliente']][4]['ValorEvento'];
								$subtotal = $subtotal + $DetalleReposicion1Valor; 
							}else{
								$DetalleReposicion1Fecha = 0;
								$DetalleReposicion1Valor = 0;
							}
							//reposicion 2
							if(isset($mesEvento[$cliente['idCliente']][5]['idTipo'])){
								$DetalleReposicion2Fecha = $mesEvento[$cliente['idCliente']][5]['FechaEjecucion'];
								$DetalleReposicion2Valor = $mesEvento[$cliente['idCliente']][5]['ValorEvento'];
								$subtotal = $subtotal + $DetalleReposicion2Valor; 
							}else{
								$DetalleReposicion2Fecha = 0;
								$DetalleReposicion2Valor = 0;
							}
							
							$DetalleSubtotalServicio = $subtotal;
							
							/* ************************************************** */
							
							//variables
							$interes1 = 0;
							$interes2 = 0;
							$interes3 = 0;
							$interes4 = 0;
							$interes5 = 0;
							$intereses = 0;
							$saldofavor = 0;
							$xcalc1 = 0;
							$difsaldoant = 0;
							//Se trae el saldo anterior si es que este existe
							if(isset($cliente['FechaPago'])&&$cliente['FechaPago']!='0000-00-00'){ 
								
								//se calculan los dias entre la fecha de pago y la de vencimiento
								$ndiasdif1 = valores_truncados(dias_transcurridos($cliente['FechaPago'],$cliente['FechaVencimiento']));
								//valido que e usuario este realmente atrasado
								if($cliente['FechaPago'] > $cliente['FechaVencimiento']){
									$ndiasdif1 = $ndiasdif1 - 1;
									//si la resta queda inferior a 0
									if($ndiasdif1 < 0){
										$ndiasdif1 = 0;
									}
								}else{
									$ndiasdif1 = 0;
								}
								
								//Se calculan los dias de diferencia entre cuando pago y la fecha actual de vencimiento
								$ndiasdif2 = valores_truncados(dias_transcurridos($_SESSION['basicos']['Fecha'],$cliente['FechaPago']));
								
								//calculo los dias entre la facturacion actual y la anterior
								$ndiasdif3 = valores_truncados(dias_transcurridos($_SESSION['basicos']['Fecha'],$cliente['FechaVencimiento']));
								$ndiasdif3 = $ndiasdif3 - 1;
								//si la resta queda inferior a 0
								if($ndiasdif3 < 0){
									$ndiasdif3 = 0;
								}
								
								//calculo la diferencia entre lo facturado y lo pagado
								$montoFinal = $cliente['MontoPagado'] - $cliente['MontoPactado'];
								//verifico si efectivamente el valor pagado fue inferior al facturado
								if($montoFinal < 0){
									$montoFinal = -1 * $montoFinal;
								}else{
									$montoFinal = 0;
								}
								
								//se calcula el interes entre la fecha de pago y la fecha pagada
								$interes1 = valores_truncados((($cliente['MontoPactado'] * $ndiasdif1 * $_SESSION['basicos']['intAnual'])/(360*100))*1.19);
								
								//Se calcula el interes del saldo en contra desde que se paga hasta que se factura
								$interes2 = valores_truncados((($montoFinal * $ndiasdif2 * $_SESSION['basicos']['intAnual'])/(360*100))*1.19);	
								
								//en caso de solo abonar se calcula el interes por la diferencia
								$saldo_ant = $cliente['MontoPactado'] - $cliente['MontoPagado'];
								if($saldo_ant > 0){
									$interes3 = valores_truncados((($saldo_ant * $ndiasdif3 * $_SESSION['basicos']['intAnual'])/(360*100))*1.19);
									$interes2 = 0;
									$xcalc1 = 1;
								}else{
									$xcalc1 = 1;
									//$interes3 = valores_truncados($saldo_ant);
									$saldofavor = valores_truncados($saldo_ant * -1);
								}
								
								
								
							}
							
								
							if(isset($cliente['SaldoAnterior'])&&$cliente['SaldoAnterior']!=''&&$cliente['SaldoAnterior']!=0&&$xcalc1==0&&$cliente['SaldoAnterior']>0){
								//calculo los dias entre la facturacion actual y la anterior
								$ndiasdif = valores_truncados(dias_transcurridos($_SESSION['basicos']['Fecha'],$cliente['FechaVencimiento']));
								$ndiasdif = $ndiasdif - 1;
								//si la resta queda inferior a 0
								if($ndiasdif < 0){
									$ndiasdif = 0;
								}
								//calculo
								$difsaldoant = $cliente['SaldoAnterior'] - $cliente['MontoPagado'];
								$interes4 = valores_truncados((($difsaldoant * $ndiasdif * $_SESSION['basicos']['intAnual'])/(360*100))*1.19);
								
							}elseif(isset($cliente['SaldoAnterior'])&&$cliente['SaldoAnterior']!=''&&$cliente['SaldoAnterior']!=0&&$xcalc1==1&&$cliente['SaldoAnterior']>0){
								$difsaldoant = $cliente['SaldoAnterior'] - $cliente['MontoPagado'];
							}
							
							//si existe un saldo en negativo
							if($cliente['MontoPactado']<0){
								$interes5 = $cliente['MontoPactado'];
							}
							
							$intereses = $interes1 + $interes2 + $interes3 + $interes4 + $interes5;
							$subtotal = $subtotal + $intereses; 
							$subtotal = $subtotal - $saldofavor;
							
							$DetalleInteresDeuda = $intereses;
							$DetalleSaldoFavor = $saldofavor;
							
							/* ************************************************** */
							//Se calcula el valor de los otros cargos
							if(isset($mesCargos[$cliente['idCliente']][0]['Observacion'])&&$mesCargos[$cliente['idCliente']][0]['Observacion']!=''){        $DetalleOtrosCargos1Texto = $mesCargos[$cliente['idCliente']][0]['Observacion'];     }else{ $DetalleOtrosCargos1Texto = '';}
							if(isset($mesCargos[$cliente['idCliente']][1]['Observacion'])&&$mesCargos[$cliente['idCliente']][1]['Observacion']!=''){        $DetalleOtrosCargos2Texto = $mesCargos[$cliente['idCliente']][1]['Observacion'];     }else{ $DetalleOtrosCargos2Texto = '';}
							if(isset($mesCargos[$cliente['idCliente']][2]['Observacion'])&&$mesCargos[$cliente['idCliente']][2]['Observacion']!=''){        $DetalleOtrosCargos3Texto = $mesCargos[$cliente['idCliente']][2]['Observacion'];     }else{ $DetalleOtrosCargos3Texto = '';}
							if(isset($mesCargos[$cliente['idCliente']][3]['Observacion'])&&$mesCargos[$cliente['idCliente']][3]['Observacion']!=''){        $DetalleOtrosCargos4Texto = $mesCargos[$cliente['idCliente']][3]['Observacion'];     }else{ $DetalleOtrosCargos4Texto = '';}
							if(isset($mesCargos[$cliente['idCliente']][4]['Observacion'])&&$mesCargos[$cliente['idCliente']][4]['Observacion']!=''){        $DetalleOtrosCargos5Texto = $mesCargos[$cliente['idCliente']][4]['Observacion'];     }else{ $DetalleOtrosCargos5Texto = '';}
							if(isset($mesCargos[$cliente['idCliente']][0]['ValorCargo'])&&$mesCargos[$cliente['idCliente']][0]['ValorCargo']!=''){          $DetalleOtrosCargos1Valor = $mesCargos[$cliente['idCliente']][0]['ValorCargo'];      }else{ $DetalleOtrosCargos1Valor = 0;}
							if(isset($mesCargos[$cliente['idCliente']][1]['ValorCargo'])&&$mesCargos[$cliente['idCliente']][1]['ValorCargo']!=''){          $DetalleOtrosCargos2Valor = $mesCargos[$cliente['idCliente']][1]['ValorCargo'];      }else{ $DetalleOtrosCargos2Valor = 0;}
							if(isset($mesCargos[$cliente['idCliente']][2]['ValorCargo'])&&$mesCargos[$cliente['idCliente']][2]['ValorCargo']!=''){          $DetalleOtrosCargos3Valor = $mesCargos[$cliente['idCliente']][2]['ValorCargo'];      }else{ $DetalleOtrosCargos3Valor = 0;}
							if(isset($mesCargos[$cliente['idCliente']][3]['ValorCargo'])&&$mesCargos[$cliente['idCliente']][3]['ValorCargo']!=''){          $DetalleOtrosCargos4Valor = $mesCargos[$cliente['idCliente']][3]['ValorCargo'];      }else{ $DetalleOtrosCargos4Valor = 0;}
							if(isset($mesCargos[$cliente['idCliente']][4]['ValorCargo'])&&$mesCargos[$cliente['idCliente']][4]['ValorCargo']!=''){          $DetalleOtrosCargos5Valor = $mesCargos[$cliente['idCliente']][4]['ValorCargo'];      }else{ $DetalleOtrosCargos5Valor = 0;}
							if(isset($mesCargos[$cliente['idCliente']][0]['FechaEjecucion'])&&$mesCargos[$cliente['idCliente']][0]['FechaEjecucion']!=''){  $DetalleOtrosCargos1Fecha = $mesCargos[$cliente['idCliente']][0]['FechaEjecucion'];  }else{ $DetalleOtrosCargos1Fecha = '';}
							if(isset($mesCargos[$cliente['idCliente']][1]['FechaEjecucion'])&&$mesCargos[$cliente['idCliente']][1]['FechaEjecucion']!=''){  $DetalleOtrosCargos2Fecha = $mesCargos[$cliente['idCliente']][1]['FechaEjecucion'];  }else{ $DetalleOtrosCargos2Fecha = '';}
							if(isset($mesCargos[$cliente['idCliente']][2]['FechaEjecucion'])&&$mesCargos[$cliente['idCliente']][2]['FechaEjecucion']!=''){  $DetalleOtrosCargos3Fecha = $mesCargos[$cliente['idCliente']][2]['FechaEjecucion'];  }else{ $DetalleOtrosCargos3Fecha = '';}
							if(isset($mesCargos[$cliente['idCliente']][3]['FechaEjecucion'])&&$mesCargos[$cliente['idCliente']][3]['FechaEjecucion']!=''){  $DetalleOtrosCargos4Fecha = $mesCargos[$cliente['idCliente']][3]['FechaEjecucion'];  }else{ $DetalleOtrosCargos4Fecha = '';}
							if(isset($mesCargos[$cliente['idCliente']][4]['FechaEjecucion'])&&$mesCargos[$cliente['idCliente']][4]['FechaEjecucion']!=''){  $DetalleOtrosCargos5Fecha = $mesCargos[$cliente['idCliente']][4]['FechaEjecucion'];  }else{ $DetalleOtrosCargos5Fecha = '';}
							
							$subtotal = $subtotal + $DetalleOtrosCargos1Valor; 
							$subtotal = $subtotal + $DetalleOtrosCargos2Valor; 
							$subtotal = $subtotal + $DetalleOtrosCargos3Valor; 
							$subtotal = $subtotal + $DetalleOtrosCargos4Valor; 
							$subtotal = $subtotal + $DetalleOtrosCargos5Valor; 
							
							
							/* ************************************************** */
							$DetalleTotalVenta = $subtotal;
							
							/* ************************************************** */
									
							if($difsaldoant > 0){ 
								$DetalleSaldoAnterior = $difsaldoant;
								$subtotal = $subtotal + $DetalleSaldoAnterior; 
							}else{
								$DetalleSaldoAnterior = 0;
							}
					
							
							$DetalleTotalAPagar = $subtotal;
							
							
						
							
							
							
							/* ************************************************** */
							//datos basicos
							if(isset($SIS_idSistema) && $SIS_idSistema != ''){                                          $a  = "'".$SIS_idSistema."'" ;                        }else{$a  ="''";}
							if(isset($_SESSION['basicos']['idUsuario']) && $_SESSION['basicos']['idUsuario'] != ''){    $a .= ",'".$_SESSION['basicos']['idUsuario']."'" ;    }else{$a .=",''"; }
							if(isset($ultimo_id) && $ultimo_id != ''){                                                  $a .= ",'".$ultimo_id."'" ;                           }else{$a .=",''";}
							if(isset($_SESSION['basicos']['Fecha']) && $_SESSION['basicos']['Fecha'] != ''){                  
								$a .= ",'".$_SESSION['basicos']['Fecha']."'" ; 
								$a .= ",'".dia_transformado($_SESSION['basicos']['Fecha'])."'" ; 
								$a .= ",'".Fecha_mes_n($_SESSION['basicos']['Fecha'])."'" ; 
								$a .= ",'".Fecha_año($_SESSION['basicos']['Fecha'])."'" ;          
							}else{
								$a .=",''";
								$a .=",''";
								$a .=",''";
								$a .=",''";
							}
							//datos del cliente
							if(isset($cliente['idCliente']) && $cliente['idCliente'] != ''){            $a .= ",'".$cliente['idCliente']."'" ;                                    }else{$a .=",''";}
							if(isset($cliente['Nombre']) && $cliente['Nombre'] != ''){                  $a .= ",'".$cliente['Nombre']."'" ;                                       }else{$a .=",''";}
							if(isset($cliente['Direccion']) && $cliente['Direccion'] != ''){            $a .= ",'".$cliente['Direccion']."'" ;                                    }else{$a .=",''";}
							if(isset($cliente['Identificador']) && $cliente['Identificador'] != ''){    $a .= ",'".$cliente['Identificador']."'" ;                                }else{$a .=",''";}
							if(isset($cliente['NombreComuna']) && $cliente['NombreComuna'] != ''){      $a .= ",'".$cliente['NombreComuna'].', '.$cliente['NombreCiudad']."'" ;   }else{$a .=",''";}
							if(isset($_SESSION['basicos']['Fecha']) && $_SESSION['basicos']['Fecha'] != ''){    
								$a .= ",'".sumarDias($_SESSION['basicos']['Fecha'],$rowSistema['NdiasPago'] )."'" ;  
							}else{
								$a .=",''";
							}
							//Se actualiza el estado del cliente dependiendo del no pago
							$xx = '' ;
							switch ($cliente['CuentaPendientes']) {
								case 0:   $xx = ",'".$estados[1]['Nombre']."'" ; break;
								case 1:   $xx = ",'".$estados[2]['Nombre']."'" ; break;
								case 2:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 3:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 4:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 5:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 6:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 7:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 8:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 9:   $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 10:  $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 11:  $xx = ",'".$estados[3]['Nombre']."'" ; break;
								case 12:  $xx = ",'".$estados[3]['Nombre']."'" ; break;
							}
							$a .= $xx;
							//detalle
							if(isset($DetalleCargoFijoValor) && $DetalleCargoFijoValor != ''){              $a .= ",'".valores_truncados($DetalleCargoFijoValor)."'" ;        }else{$a .=",''";}
							if(isset($DetalleConsumoCantidad) && $DetalleConsumoCantidad != ''){            $a .= ",'".$DetalleConsumoCantidad."'" ;                          }else{$a .=",''";}
							if(isset($DetalleConsumoValor) && $DetalleConsumoValor != ''){                  $a .= ",'".valores_truncados($DetalleConsumoValor)."'" ;          }else{$a .=",''";}
							if(isset($DetalleRecoleccionCantidad) && $DetalleRecoleccionCantidad != ''){    $a .= ",'".$DetalleRecoleccionCantidad."'" ;                      }else{$a .=",''";}
							if(isset($DetalleRecoleccionValor) && $DetalleRecoleccionValor != ''){          $a .= ",'".valores_truncados($DetalleRecoleccionValor)."'" ;      }else{$a .=",''";}
							if(isset($DetalleVisitaCorte) && $DetalleVisitaCorte != ''){                    $a .= ",'".valores_truncados($DetalleVisitaCorte)."'" ;           }else{$a .=",''";}
							if(isset($DetalleCorte1Fecha) && $DetalleCorte1Fecha != ''){                    $a .= ",'".$DetalleCorte1Fecha."'" ;                              }else{$a .=",''";}
							if(isset($DetalleCorte1Valor) && $DetalleCorte1Valor != ''){                    $a .= ",'".valores_truncados($DetalleCorte1Valor)."'" ;           }else{$a .=",''";}
							if(isset($DetalleCorte2Fecha) && $DetalleCorte2Fecha != ''){                    $a .= ",'".$DetalleCorte2Fecha."'" ;                              }else{$a .=",''";}
							if(isset($DetalleCorte2Valor) && $DetalleCorte2Valor != ''){                    $a .= ",'".valores_truncados($DetalleCorte2Valor)."'" ;           }else{$a .=",''";}
							if(isset($DetalleReposicion1Fecha) && $DetalleReposicion1Fecha != ''){          $a .= ",'".$DetalleReposicion1Fecha."'" ;                         }else{$a .=",''";}
							if(isset($DetalleReposicion1Valor) && $DetalleReposicion1Valor != ''){          $a .= ",'".valores_truncados($DetalleReposicion1Valor)."'" ;      }else{$a .=",''";}
							if(isset($DetalleReposicion2Fecha) && $DetalleReposicion2Fecha != ''){          $a .= ",'".$DetalleReposicion2Fecha."'" ;                         }else{$a .=",''";}
							if(isset($DetalleReposicion2Valor) && $DetalleReposicion2Valor != ''){          $a .= ",'".valores_truncados($DetalleReposicion2Valor)."'" ;      }else{$a .=",''";}
							if(isset($DetalleSubtotalServicio) && $DetalleSubtotalServicio != ''){          $a .= ",'".valores_truncados($DetalleSubtotalServicio)."'" ;      }else{$a .=",''";}
							if(isset($DetalleInteresDeuda) && $DetalleInteresDeuda != ''){                  $a .= ",'".valores_truncados($DetalleInteresDeuda)."'" ;          }else{$a .=",''";}
							if(isset($DetalleSaldoFavor) && $DetalleSaldoFavor != ''){                      $a .= ",'".valores_truncados($DetalleSaldoFavor)."'" ;            }else{$a .=",''";}
							if(isset($DetalleTotalVenta) && $DetalleTotalVenta != ''){                      $a .= ",'".valores_truncados($DetalleTotalVenta)."'" ;            }else{$a .=",''";}
							if(isset($DetalleSaldoAnterior) && $DetalleSaldoAnterior != ''){                $a .= ",'".valores_truncados($DetalleSaldoAnterior)."'" ;         }else{$a .=",''";}
							
							if(isset($DetalleOtrosCargos1Texto) && $DetalleOtrosCargos1Texto != ''){        $a .= ",'".$DetalleOtrosCargos1Texto."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos2Texto) && $DetalleOtrosCargos2Texto != ''){        $a .= ",'".$DetalleOtrosCargos2Texto."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos3Texto) && $DetalleOtrosCargos3Texto != ''){        $a .= ",'".$DetalleOtrosCargos3Texto."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos4Texto) && $DetalleOtrosCargos4Texto != ''){        $a .= ",'".$DetalleOtrosCargos4Texto."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos5Texto) && $DetalleOtrosCargos5Texto != ''){        $a .= ",'".$DetalleOtrosCargos5Texto."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos1Valor) && $DetalleOtrosCargos1Valor != ''){        $a .= ",'".valores_truncados($DetalleOtrosCargos1Valor)."'" ;     }else{$a .=",''";}
							if(isset($DetalleOtrosCargos2Valor) && $DetalleOtrosCargos2Valor != ''){        $a .= ",'".valores_truncados($DetalleOtrosCargos2Valor)."'" ;     }else{$a .=",''";}
							if(isset($DetalleOtrosCargos3Valor) && $DetalleOtrosCargos3Valor != ''){        $a .= ",'".valores_truncados($DetalleOtrosCargos3Valor)."'" ;     }else{$a .=",''";}
							if(isset($DetalleOtrosCargos4Valor) && $DetalleOtrosCargos4Valor != ''){        $a .= ",'".valores_truncados($DetalleOtrosCargos4Valor)."'" ;     }else{$a .=",''";}
							if(isset($DetalleOtrosCargos5Valor) && $DetalleOtrosCargos5Valor != ''){        $a .= ",'".valores_truncados($DetalleOtrosCargos5Valor)."'" ;     }else{$a .=",''";}
							if(isset($DetalleOtrosCargos1Fecha) && $DetalleOtrosCargos1Fecha != ''){        $a .= ",'".$DetalleOtrosCargos1Fecha."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos2Fecha) && $DetalleOtrosCargos2Fecha != ''){        $a .= ",'".$DetalleOtrosCargos2Fecha."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos3Fecha) && $DetalleOtrosCargos3Fecha != ''){        $a .= ",'".$DetalleOtrosCargos3Fecha."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos4Fecha) && $DetalleOtrosCargos4Fecha != ''){        $a .= ",'".$DetalleOtrosCargos4Fecha."'" ;                        }else{$a .=",''";}
							if(isset($DetalleOtrosCargos5Fecha) && $DetalleOtrosCargos5Fecha != ''){        $a .= ",'".$DetalleOtrosCargos5Fecha."'" ;                        }else{$a .=",''";}
							
							if(isset($DetalleTotalAPagar) && $DetalleTotalAPagar != ''){                    $a .= ",'".valores_truncados($DetalleTotalAPagar)."'" ;           }else{$a .=",''";}
							//graficos
							//vslores
							if(isset($mes_01[$cliente['idCliente']]) && $mes_01[$cliente['idCliente']] != ''){    $a .= ",'".$mes_01[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_02[$cliente['idCliente']]) && $mes_02[$cliente['idCliente']] != ''){    $a .= ",'".$mes_02[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_03[$cliente['idCliente']]) && $mes_03[$cliente['idCliente']] != ''){    $a .= ",'".$mes_03[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_04[$cliente['idCliente']]) && $mes_04[$cliente['idCliente']] != ''){    $a .= ",'".$mes_04[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_05[$cliente['idCliente']]) && $mes_05[$cliente['idCliente']] != ''){    $a .= ",'".$mes_05[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_06[$cliente['idCliente']]) && $mes_06[$cliente['idCliente']] != ''){    $a .= ",'".$mes_06[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_07[$cliente['idCliente']]) && $mes_07[$cliente['idCliente']] != ''){    $a .= ",'".$mes_07[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_08[$cliente['idCliente']]) && $mes_08[$cliente['idCliente']] != ''){    $a .= ",'".$mes_08[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_09[$cliente['idCliente']]) && $mes_09[$cliente['idCliente']] != ''){    $a .= ",'".$mes_09[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_10[$cliente['idCliente']]) && $mes_10[$cliente['idCliente']] != ''){    $a .= ",'".$mes_10[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_11[$cliente['idCliente']]) && $mes_11[$cliente['idCliente']] != ''){    $a .= ",'".$mes_11[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							if(isset($mes_12[$cliente['idCliente']]) && $mes_12[$cliente['idCliente']] != ''){    $a .= ",'".$mes_12[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							//meses
							if(isset($consumos[$cliente['idCliente']][1]['mes']) && $consumos[$cliente['idCliente']][1]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][1]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][2]['mes']) && $consumos[$cliente['idCliente']][2]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][2]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][3]['mes']) && $consumos[$cliente['idCliente']][3]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][3]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][4]['mes']) && $consumos[$cliente['idCliente']][4]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][4]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][5]['mes']) && $consumos[$cliente['idCliente']][5]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][5]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][6]['mes']) && $consumos[$cliente['idCliente']][6]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][6]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][7]['mes']) && $consumos[$cliente['idCliente']][7]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][7]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][8]['mes']) && $consumos[$cliente['idCliente']][8]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][8]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][9]['mes']) && $consumos[$cliente['idCliente']][9]['mes'] != ''){      $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][9]['mes'])."'" ;   }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][10]['mes']) && $consumos[$cliente['idCliente']][10]['mes'] != ''){    $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][10]['mes'])."'" ;  }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][11]['mes']) && $consumos[$cliente['idCliente']][11]['mes'] != ''){    $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][11]['mes'])."'" ;  }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][12]['mes']) && $consumos[$cliente['idCliente']][12]['mes'] != ''){    $a .= ",'".numero_a_mes_c($consumos[$cliente['idCliente']][12]['mes'])."'" ;  }else{$a .=",''";}
							//detalle consumos
							if(isset($consumos[$cliente['idCliente']][11]['Consumo']) && $consumos[$cliente['idCliente']][11]['Consumo'] != ''){    $a .= ",'".valores_truncados($consumos[$cliente['idCliente']][11]['Consumo'])."'" ;  }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][11]['Fecha']) && $consumos[$cliente['idCliente']][11]['Fecha'] != ''){        $a .= ",'".$consumos[$cliente['idCliente']][11]['Fecha']."'" ;                       }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][12]['Consumo']) && $consumos[$cliente['idCliente']][12]['Consumo'] != ''){    $a .= ",'".valores_truncados($consumos[$cliente['idCliente']][12]['Consumo'])."'" ;  }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][12]['Fecha']) && $consumos[$cliente['idCliente']][12]['Fecha'] != ''){        $a .= ",'".$consumos[$cliente['idCliente']][12]['Fecha']."'" ;                       }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][11]['Consumo']) && isset($consumos[$cliente['idCliente']][12]['Consumo'])){
								$tot1 = valores_truncados($consumos[$cliente['idCliente']][11]['Consumo']);
								$tot2 = valores_truncados($consumos[$cliente['idCliente']][12]['Consumo']);
								$Diferencia_lect = $tot2 - $tot1;
								$a .= ",'".valores_truncados($Diferencia_lect)."'" ; 
							}else{
								$a .= ",''" ;
							}
							if(isset($rem_cantidad[$cliente['idCliente']][12]) && $rem_cantidad[$cliente['idCliente']][12] != ''){    
								$a .= ",'".$rem_cantidad[$cliente['idCliente']][12]."'" ;  
								if($rem_cantidad[$cliente['idCliente']][12]>0){
									$a .= ",'(+)'" ; 
								}else{
									$a .= ",'(-)'" ;
								}	
							}else{
								$a .=",''";
								$a .=",''";
							}
							if(isset($mes_12[$cliente['idCliente']]) && $mes_12[$cliente['idCliente']] != ''){    $a .= ",'".$mes_12[$cliente['idCliente']]."'" ;  }else{$a .=",''";}
							$a .=",'".$SIS_año_proximo."-".numero_mes1($SIS_Fecha_Mes_prox)."-01'";
							if(isset($rem_modalidad[$cliente['idCliente']][12]) && $rem_modalidad[$cliente['idCliente']][12] != ''){    $a .= ",'".$rem_modalidad[$cliente['idCliente']][12]."'" ;  }else{$a .=",''";}
							if(isset($rowSistema['Fac_nEmergencia']) && $rowSistema['Fac_nEmergencia'] != ''){                      $a .= ",'".$rowSistema['Fac_nEmergencia']."'" ;                           }else{$a .=",''";}
							if(isset($rowSistema['Fac_nConsultas']) && $rowSistema['Fac_nConsultas'] != ''){                        $a .= ",'".$rowSistema['Fac_nConsultas']."'" ;                            }else{$a .=",''";}
							//aguas informa
							if(isset($rowSistema['valorCargoFijo']) && $rowSistema['valorCargoFijo'] != ''){                        $a .= ",'".valores_truncados($rowSistema['valorCargoFijo'])."'" ;         }else{$a .=",''";}
							if(isset($rowSistema['valorAgua']) && $rowSistema['valorAgua'] != ''){                                  $a .= ",'".$rowSistema['valorAgua']."'" ;                                 }else{$a .=",''";}
							if(isset($rowSistema['valorRecoleccion']) && $rowSistema['valorRecoleccion'] != ''){                    $a .= ",'".$rowSistema['valorRecoleccion']."'" ;                          }else{$a .=",''";}
							if(isset($rowSistema['valorVisitaCorte']) && $rowSistema['valorVisitaCorte'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorVisitaCorte'])."'" ;       }else{$a .=",''";}
							if(isset($rowSistema['valorCorte1']) && $rowSistema['valorCorte1'] != ''){                              $a .= ",'".valores_truncados($rowSistema['valorCorte1'])."'" ;            }else{$a .=",''";}
							if(isset($rowSistema['valorCorte2']) && $rowSistema['valorCorte2'] != ''){                              $a .= ",'".valores_truncados($rowSistema['valorCorte2'])."'" ;            }else{$a .=",''";}
							if(isset($rowSistema['valorReposicion1']) && $rowSistema['valorReposicion1'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorReposicion1'])."'" ;       }else{$a .=",''";}
							if(isset($rowSistema['valorReposicion2']) && $rowSistema['valorReposicion2'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorReposicion2'])."'" ;       }else{$a .=",''";}
							//segundo bloque
							$a .=",'1'";
							if(isset($rem_diferencia[$cliente['idCliente']][12]) && $rem_diferencia[$cliente['idCliente']][12] != ''){              $a .= ",'".$rem_diferencia[$cliente['idCliente']][12]."'" ;            }else{$a .=",''";}
							if(isset($rem_procentaje[$cliente['idCliente']][12]) && $rem_procentaje[$cliente['idCliente']][12] != ''){              $a .= ",'".$rem_procentaje[$cliente['idCliente']][12]."'" ;            }else{$a .=",''";}
							
							if(isset($consumos[$cliente['idCliente']][12]['TipoMedicion']) && $consumos[$cliente['idCliente']][12]['TipoMedicion'] != ''){    
								if($consumos[$cliente['idCliente']][12]['TipoMedicion']!=0){
									$a .=",'Remarcador'";
								}else{ 	
									$a .=",'Arranque individual'";
								} 
							}else{
								$a .=",''";
							}
							if(isset($cliente['Arranque']) && $cliente['Arranque'] != ''){                                                          $a .= ",'".$cliente['Arranque']."'" ;                                  }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][12]['TipoFac']) && $consumos[$cliente['idCliente']][12]['TipoFac'] != ''){    $a .= ",'".$consumos[$cliente['idCliente']][12]['TipoFac']."'" ;       }else{$a .=",''";}
							if(isset($consumos[$cliente['idCliente']][12]['TipoLec']) && $consumos[$cliente['idCliente']][12]['TipoLec'] != ''){    $a .= ",'".$consumos[$cliente['idCliente']][12]['TipoLec']."'" ;       }else{$a .=",''";}
							if(isset($cliente['NombreMarcador'])&&$cliente['NombreMarcador']!=''){
								$a .= ",'".$cliente['NombreMarcador']."'" ;
							}else{
								$a .= ",'".$cliente['NombreMedidor']."'" ;
							}
							if(isset($_SESSION['basicos']['Fecha']) && $_SESSION['basicos']['Fecha'] != ''){                          $a .= ",'".$_SESSION['basicos']['Fecha']."'" ;  }else{$a .=",''";}
							if(isset($cliente['PagoFecha']) && $cliente['PagoFecha'] != '0000-00-00'&& $cliente['PagoFecha'] != ''){  $a .= ",'".$cliente['PagoFecha']."'" ;          }else{$a .=",''";}
							if(isset($cliente['PagoMonto']) && $cliente['PagoMonto'] != ''){                                          $a .= ",'".$cliente['PagoMonto']."'" ;          }else{$a .=",''";}
							$a .=",'".$SIS_Fecha_Ano."-".numero_mes1($SIS_Fecha_Mes)."-09'";
							//otros datos
							$a .= ",'1'" ;
							if(isset($_SESSION['basicos']['intAnual']) && $_SESSION['basicos']['intAnual'] != ''){    $a .= ",'".$_SESSION['basicos']['intAnual']."'" ;       }else{$a .=",''";}
							$a .= ",'0'" ;
							$a .= ",''" ;
							$a .= ",''" ;
							$a .= ",''" ;
							$a .= ",''" ;
							$a .= ",''" ;
							//datos remarcadores
							if(isset($rem_cantidad[$cliente['idCliente']][12]) && $rem_cantidad[$cliente['idCliente']][12] != ''){        $a .= ",'".$rem_cantidad[$cliente['idCliente']][12]."'" ;    }else{$a .=",''";}
							if(isset($rem_procentaje[$cliente['idCliente']][12]) && $rem_procentaje[$cliente['idCliente']][12] != ''){    $a .= ",'".$rem_procentaje[$cliente['idCliente']][12]."'" ;  }else{$a .=",''";}
							if(isset($rem_modalidad[$cliente['idCliente']][12]) && $rem_modalidad[$cliente['idCliente']][12] != ''){      $a .= ",'".$rem_modalidad[$cliente['idCliente']][12]."'" ;   }else{$a .=",''";}
							if(isset($rem_diferencia[$cliente['idCliente']][12]) && $rem_diferencia[$cliente['idCliente']][12] != ''){    $a .= ",'".$rem_diferencia[$cliente['idCliente']][12]."'" ;  }else{$a .=",''";}
							//Datos del SII
							if(isset($cliente['idFacturable']) && $cliente['idFacturable'] != ''){                                        $a .= ",'".$cliente['idFacturable']."'" ;                    }else{$a .=",''";}
							$a .= ",''" ; 
							
							
							
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `facturacion_listado_detalle` (
							idSistema,idUsuario,idFacturacion,Fecha,Dia,idMes,Ano,
							
							idCliente,ClienteNombre,ClienteDireccion,ClienteIdentificador,ClienteNombreComuna,ClienteFechaVencimiento,ClienteEstado,
							
							DetalleCargoFijoValor,
							DetalleConsumoCantidad,DetalleConsumoValor,
							DetalleRecoleccionCantidad,DetalleRecoleccionValor,
							DetalleVisitaCorte,
							DetalleCorte1Fecha,DetalleCorte1Valor,
							DetalleCorte2Fecha,DetalleCorte2Valor,
							DetalleReposicion1Fecha,DetalleReposicion1Valor,
							DetalleReposicion2Fecha,DetalleReposicion2Valor,
							DetalleSubtotalServicio,
							DetalleInteresDeuda,
							DetalleSaldoFavor,
							DetalleTotalVenta,
							DetalleSaldoAnterior,
							
							DetalleOtrosCargos1Texto,
							DetalleOtrosCargos2Texto,
							DetalleOtrosCargos3Texto,
							DetalleOtrosCargos4Texto,
							DetalleOtrosCargos5Texto,
							DetalleOtrosCargos1Valor,
							DetalleOtrosCargos2Valor,
							DetalleOtrosCargos3Valor,
							DetalleOtrosCargos4Valor,
							DetalleOtrosCargos5Valor,
							DetalleOtrosCargos1Fecha,
							DetalleOtrosCargos2Fecha,
							DetalleOtrosCargos3Fecha,
							DetalleOtrosCargos4Fecha,
							DetalleOtrosCargos5Fecha,
							
							DetalleTotalAPagar,
							
							GraficoMes1Valor,GraficoMes2Valor,GraficoMes3Valor,GraficoMes4Valor,GraficoMes5Valor,
							GraficoMes6Valor,GraficoMes7Valor,GraficoMes8Valor,GraficoMes9Valor,GraficoMes10Valor,
							GraficoMes11Valor,GraficoMes12Valor,
							GraficoMes1Fecha,GraficoMes2Fecha,GraficoMes3Fecha,GraficoMes4Fecha,GraficoMes5Fecha,
							GraficoMes6Fecha,GraficoMes7Fecha,GraficoMes8Fecha,GraficoMes9Fecha,GraficoMes10Fecha,
							GraficoMes11Fecha,GraficoMes12Fecha,
							
							DetConsMesAnteriorCantidad, DetConsMesAnteriorFecha,
							DetConsMesActualCantidad, DetConsMesActualFecha,
							DetConsMesDiferencia,
							DetConsProrateo,
							DetConsProrateoSigno,
							DetConsMesTotalCantidad,
							DetConsFechaProxLectura,
							DetConsModalidad,
							DetConsFonoEmergencias,
							DetConsFonoConsultas,
							
							AguasInfCargoFijo,
							AguasInfMetroAgua,
							AguasInfMetroRecolecion,
							AguasInfVisitaCorte,
							AguasInfCorte1,
							AguasInfCorte2,
							AguasInfReposicion1,
							AguasInfReposicion2,
							
							AguasInfFactorCobro,
							AguasInfDifMedGeneral,
							AguasInfProcProrrateo,
							AguasInfTipoMedicion,
							AguasInfPuntoDiametro,
							AguasInfClaveFacturacion,
							AguasInfClaveLectura,
							AguasInfNumeroMedidor,
							AguasInfFechaEmision,
							AguasInfUltimoPagoFecha,AguasInfUltimoPagoMonto,
							AguasInfMovimientosHasta,
							
							idEstado,
							intAnual,
							idTipoPago,
							nDocPago,
							fechaPago,
							montoPago,
							idUsuarioPago,
							idPago,
							
							
							rem_cantidad,
							rem_procentaje,
							rem_modalidad,
							rem_diferencia,
							
							SII_idFacturable,
							SII_NDoc
							
							) 
							VALUES ({$a} )";
							$result = mysqli_query($dbConn, $query);
						
							///////////////////////////////////////////////////////////////////////////////////////
							//Se actualiza el estado de la facturacion
							$a = "idFacturado='2'";
							if(isset($ultimo_id) && $ultimo_id != ''){  $a .= ",idFacturacion='".$ultimo_id."'" ;}
							$query  = "UPDATE `mediciones_datos_detalle` SET ".$a." WHERE idDatosDetalle = '{$cliente['DetMesActualidDatosDetalle']}'";
							$result = mysqli_query($dbConn, $query);
						
							
							///////////////////////////////////////////////////////////////////////////////////////
							//Se actualiza el estado del cliente dependiendo del no pago
							$a = "idCliente='".$cliente['idCliente']."'" ;
							switch ($cliente['CuentaPendientes']) {
								case 0:   $a .= ",idEstadoPago='1'" ; break;
								case 1:   $a .= ",idEstadoPago='2'" ; break;
								/*case 2:   $a .= ",idEstadoPago='3'" ; break;
								case 3:   $a .= ",idEstadoPago='3'" ; break;
								case 4:   $a .= ",idEstadoPago='3'" ; break;
								case 5:   $a .= ",idEstadoPago='3'" ; break;
								case 6:   $a .= ",idEstadoPago='3'" ; break;
								case 7:   $a .= ",idEstadoPago='3'" ; break;
								case 8:   $a .= ",idEstadoPago='3'" ; break;
								case 9:   $a .= ",idEstadoPago='3'" ; break;
								case 10:  $a .= ",idEstadoPago='3'" ; break;
								case 11:  $a .= ",idEstadoPago='3'" ; break;
								case 12:  $a .= ",idEstadoPago='3'" ; break;*/
							}
							// inserto los datos de registro en la db
							$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$cliente['idCliente']}'";
							$result = mysqli_query($dbConn, $query);
						
							
						}
					}
				}
				
				
				//Borro todas las sesiones
				unset($_SESSION['basicos']);
				unset($_SESSION['clientes']);
			
				//redirijo a la vista
				header( 'Location: '.$location.'&created=true' );
				die;
				
				
				
			}

		break;
		
/*******************************************************************************************************************/
		//Cambia el nivel del permiso
		case 'submit_archivo':	

			if ($_FILES["Archivo"]["error"] > 0){ 
				$error['Archivo']     = 'error/Ha ocurrido un error'; 
			} else {
			  //Se verifican las extensiones de los archivos
			  $permitidos = array("application/pdf",
								  "application/octet-stream",
								  "application/x-real",
								  "application/vnd.adobe.xfdf",
								  "application/vnd.fdf",
								  "binary/octet-stream");
			  //Se verifica que el archivo subido no exceda los 100 kb
			  $limite_kb = 10000;
			  //Sufijo
			  $sufijo = '';
			  
			  if (in_array($_FILES['Archivo']['type'], $permitidos) && $_FILES['Archivo']['size'] <= $limite_kb * 1024){
				//Se especifica carpeta de destino
				$ruta = "upload/".$sufijo.$_FILES['Archivo']['name'];
				//Se verifica que el archivo un archivo con el mismo nombre no existe
				if (!file_exists($ruta)){
				  //Se mueve el archivo a la carpeta previamente configurada
				  $resultado = @move_uploaded_file($_FILES["Archivo"]["tmp_name"], $ruta);
				  if ($resultado){
					
					//Filtro para idSistema
					if ( !empty($_POST['idFacturacionDetalle']) )    $idFacturacionDetalle       = $_POST['idFacturacionDetalle'];
					if ( !empty($_POST['SII_NDoc']) )                $SII_NDoc                   = $_POST['SII_NDoc'];
					
					$a = "NombreArchivo='".$sufijo.$_FILES['Archivo']['name']."'" ;
					if(isset($SII_NDoc)&&$SII_NDoc!=''){ $a .= ",SII_NDoc='".$SII_NDoc."'" ;}

					// inserto los datos de registro en la db
					$query  = "UPDATE `facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '$idFacturacionDetalle'";
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
			}


		break;	
/*******************************************************************************************************************/
		case 'del_archivo':	
		
			// Se obtiene el nombre del logo
			$query = "SELECT NombreArchivo
			FROM `facturacion_listado_detalle`
			WHERE idFacturacionDetalle = {$_GET['del']}";
			$resultado = mysqli_query ($dbConn, $query);
			$rowdata = mysqli_fetch_assoc ($resultado);

			if(unlink('upload/'.$rowdata['NombreArchivo'])&&isset($rowdata['NombreArchivo'])&&$rowdata['NombreArchivo']!=''){	
					
				// actualizo los datos de registro en la db
				$query  = "UPDATE `facturacion_listado_detalle` SET NombreArchivo='' WHERE idFacturacionDetalle = '{$_GET['del']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo			
				header( 'Location: '.$location.'&deleted=true' );
				die;

			}else{

				// actualizo los datos de registro en la db
				$query  = "UPDATE `facturacion_listado_detalle` SET NombreArchivo='' WHERE idFacturacionDetalle = '{$_GET['del']}'";
				$result = mysqli_query($dbConn, $query);
				//Redirijo				
				header( 'Location: '.$location.'&deleted=true' );
				die;

			} 


		break;
/*******************************************************************************************************************/
	}
?>
