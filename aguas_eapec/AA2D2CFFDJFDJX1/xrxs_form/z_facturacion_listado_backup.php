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
			case 'intAnual':               if(empty($intAnual)){                 $error['intAnual']               = 'error/No ha ingresado el intres anual';}break;
			
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
			$SIS_idSistema           = $_SESSION['basicos']['idSistema'];
			$SIS_Fecha_Completa      = $_SESSION['basicos']['Fecha'];
			$SIS_Fecha_Ano           = Fecha_año($_SESSION['basicos']['Fecha']);
			$SIS_Fecha_Ano_Actual    = Fecha_año($_SESSION['basicos']['Fecha']);
			$SIS_Fecha_Mes           = Fecha_mes_n($_SESSION['basicos']['Fecha']);
			
			$SIS_Fecha_Ano_Anterior  = Fecha_año($_SESSION['basicos']['Fecha']);
			if($SIS_Fecha_Mes==1){
				$SIS_Fecha_Mes_Anterior  = 12;
				$SIS_Fecha_Ano_Anterior  = $SIS_Fecha_Ano-1;
				$SIS_Fecha_Ano_Actual    = $SIS_Fecha_Ano-1;
			}else{
				$SIS_Fecha_Mes_Anterior = $SIS_Fecha_Mes-1;
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
			
			// Se trae un listado con todos los clientes
			$arrClientes = array();
			$query = "SELECT 
			clientes_listado.idCliente,
			clientes_listado.Nombre,
			clientes_listado.Direccion,
			clientes_listado.Identificador,
			clientes_listado.UnidadHabitacional,
			clientes_listado.Arranque,
			mnt_ubicacion_comunas.Nombre AS NombreComuna,
			mnt_ubicacion_ciudad.Nombre AS NombreCiudad,
			marcadores_listado.Nombre AS NombreMedidor,
			marcadores_remarcadores.Nombre AS NombreRemarcador,
			
				(SELECT  COUNT(idFacturacionDetalle) AS Cuenta
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idEstado = 1
				LIMIT 1) AS CuentaPendientes,
				
				(SELECT  DetalleTotalAPagar
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idEstado = 1
				AND idMes = '{$SIS_Fecha_Mes_Anterior}'
				AND Ano = '{$SIS_Fecha_Ano_Actual}'
				LIMIT 1) AS SaldoAnterior,
				
				(SELECT  Fecha
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idMes = '{$SIS_Fecha_Mes_Anterior}'
				AND Ano = '{$SIS_Fecha_Ano_Actual}'
				LIMIT 1) AS FechaVencimiento,
				
				(SELECT fechaPago
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idMes = '{$SIS_Fecha_Mes_Anterior}'
				AND Ano = '{$SIS_Fecha_Ano_Actual}'
				LIMIT 1) AS FechaPago,
				
				(SELECT DetalleTotalAPagar
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idMes = '{$SIS_Fecha_Mes_Anterior}'
				AND Ano = '{$SIS_Fecha_Ano_Actual}'
				LIMIT 1) AS MontoPactado,

				(SELECT montoPago
				FROM `facturacion_listado_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND idMes = '{$SIS_Fecha_Mes_Anterior}'
				AND Ano = '{$SIS_Fecha_Ano_Actual}'
				LIMIT 1) AS MontoPagado,
				
				(SELECT  idDatosDetalle
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS DetMesActualidDatosDetalle,
				
				(SELECT  Fecha
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS DetMesActualFecha,
				
				(SELECT  Consumo
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS DetMesActualConsumo,
				
				(SELECT  idTipoMedicion
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS idTipoMedicion,
				
				(SELECT  ConsumoMedidor
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS ConsumoMedidor,
				
				(SELECT  ConsumoGeneral
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS ConsumoGeneral,
				
				(SELECT  CantRemarcadores
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano}'
				AND idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS CantRemarcadores,
				

				(SELECT 
				data1.Nombre AS TipoFacturacion
				FROM `mediciones_datos_detalle`
				LEFT JOIN `mediciones_datos_detalle_tipofacturacion` data1 ON data1.idTipoFacturacion   = mediciones_datos_detalle.idTipoFacturacion
				WHERE mediciones_datos_detalle.idCliente = clientes_listado.idCliente 
				AND mediciones_datos_detalle.Ano='{$SIS_Fecha_Ano}'
				AND mediciones_datos_detalle.idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS DetMesActualTipoFacturacion,

				(SELECT 
				data2.Nombre AS TipoLectura
				FROM `mediciones_datos_detalle`
				LEFT JOIN `mediciones_datos_detalle_tipolectura`     data2 ON data2.idTipoLectura       = mediciones_datos_detalle.idTipoLectura
				WHERE mediciones_datos_detalle.idCliente = clientes_listado.idCliente 
				AND mediciones_datos_detalle.Ano='{$SIS_Fecha_Ano}'
				AND mediciones_datos_detalle.idMes='{$SIS_Fecha_Mes}'
				LIMIT 1) AS DetMesActualTipoLectura,
				
				(SELECT  Consumo
				FROM `mediciones_datos_detalle`
				WHERE idCliente = clientes_listado.idCliente 
				AND Ano='{$SIS_Fecha_Ano_Anterior}'
				AND idMes='{$SIS_Fecha_Mes_Anterior}'
				LIMIT 1) AS DetMesAnteriorConsumo
				
			
			
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
				
				
				
				/////////////////////////////////////////////////////////////////////////////////
				//Se traen todos los eventos transcurridos en el mes
				$arrEventos = array();
				$query = "SELECT  idCliente,idTipo, ValorEvento
				FROM `clientes_eventos`
				WHERE idSistema = '{$SIS_idSistema}'
				AND Ano =  '{$SIS_Fecha_Ano}'
				AND idMes =  '{$SIS_Fecha_Mes}'
				";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrEventos,$row );
				}
				
				
				///////////////////////////////////////////////////////////////////////////////////////////
				foreach ($arrClientes as $cliente) { 
					foreach ($_SESSION['clientes'] as $key => $clientes){
						if($cliente['idCliente']==$clientes['idCliente']){
							
							///////////////////////////////////////////////////////////////////////////////////////
							//                                                                                   //
							//                                     Variables                                     //
							//                                                                                   //
							///////////////////////////////////////////////////////////////////////////////////////
							//calculos del consumo
							if($cliente['DetMesActualConsumo']!=0){ 
								$ConsCantidad = valores_truncados($cliente['DetMesActualConsumo'])-valores_truncados($cliente['DetMesAnteriorConsumo']);    
							}else{
								$ConsCantidad = 0;
							}
							
							//calculo de los remarcadores
							$rem_cantidad = 0;
							$rem_procentaje = 0;
							$rem_negative = '';
							$rem_modalidad = '';
							$rem_diferencia = 0;
							//verificacion de remarcador
							if($cliente['idTipoMedicion']!=0){
								//verifico el tipo de medicion
								switch ($cliente['idTipoMedicion']) {
									//Calculo valor promedio
									case 1:
										$xcalc = $cliente['ConsumoMedidor'] - $cliente['ConsumoGeneral'];
										$rem_modalidad = 'Promedio';
										if($xcalc > 0){
											$rem_negative = 'suma';
											$rem_cantidad = $xcalc / $cliente['CantRemarcadores'];
											$rem_procentaje = valores_truncados(100 / $cliente['CantRemarcadores']);
											$rem_diferencia = $xcalc;
											//realizo reajuste
											$ConsCantidad = $ConsCantidad + $rem_cantidad;
										}else{
											$rem_negative = 'resta';
											$rem_cantidad = ($xcalc * -1) / $cliente['CantRemarcadores'];
											$rem_procentaje = valores_truncados(100 / $cliente['CantRemarcadores']);
											$rem_diferencia = ($xcalc * -1);
											//realizo reajuste
											$ConsCantidad = $ConsCantidad - $rem_cantidad;
										}
										break;
									
									//calculo proporcional
									case 2:
										$xcalc  = $cliente['ConsumoMedidor'] - $cliente['ConsumoGeneral'];
										$xcalc2 = valores_truncados(($ConsCantidad*100)/$cliente['ConsumoMedidor']);
										$rem_modalidad = 'Proporcional al consumo';
										if($xcalc > 0){
											$rem_negative = 'suma';
											$rem_cantidad = ($xcalc*$xcalc2) /100 ;
											$rem_procentaje = $xcalc2;
											$rem_diferencia = $xcalc;
											//realizo reajuste
											$ConsCantidad = $ConsCantidad + $rem_cantidad;
										}else{
											$rem_negative = 'resta';
											$rem_cantidad = (($xcalc*-1)*$xcalc2) /100 ;
											$rem_procentaje = $xcalc2;
											$rem_diferencia = ($xcalc * -1);
											//realizo reajuste
											$ConsCantidad = $ConsCantidad - $rem_cantidad;
										}				
										break;
								}
							}
							
							
							
							
							$TotalAgua = $rowSistema['valorAgua']*$ConsCantidad;
							$TotalRecoleccion = $rowSistema['valorRecoleccion']*$ConsCantidad;
							
							//Se calcula el valor total
							$subtotal   = 0;
							$subtotal = valores_truncados(($rowSistema['valorCargoFijo']*$cliente['UnidadHabitacional']) + $TotalAgua + $TotalRecoleccion);
							
							
							//recorro los eventos de los clientes
							$ev1 = 0;
							$ev2 = 0;
							$ev3 = 0;
							$ev4 = 0;
							$ev5 = 0;
							foreach ($arrEventos as $eventos)   {
								//solo los eventos del cliente
								if($cliente['idCliente']==$eventos['idCliente']){
									switch ($eventos['idTipo']) {
										case 1: $ev1 = $ev1 + $eventos['ValorEvento']; break;
										case 2: $ev2 = $ev2 + $eventos['ValorEvento']; break;
										case 3: $ev3 = $ev3 + $eventos['ValorEvento']; break;
										case 4: $ev4 = $ev4 + $eventos['ValorEvento']; break;
										case 5: $ev5 = $ev5 + $eventos['ValorEvento']; break;
									}
									//se suma
									$subtotal = $subtotal + valores_truncados($eventos['ValorEvento']);
								}
							}
							//obtengo los datos del medidor
							if(isset($cliente['NombreRemarcador']) && $cliente['NombreRemarcador'] != ''){  
								$Medidor = $cliente['NombreRemarcador'];
							}else{
								$Medidor = $cliente['NombreMedidor'];
							}
							
							//calculo del interes de la deuda
							$interes1 = 0;
							$interes2 = 0;
							$interes3 = 0;
							$interes4 = 0;
							//Se trae el saldo anterior si es que este existe
							if(isset($cliente['FechaPago'])&&$cliente['FechaPago']!='0000-00-00'){ 
								
								//funcion para obtener la diferencia de dias
								$ndiasdif1 = dias_transcurridos($cliente['FechaPago'],sumarDias($cliente['FechaVencimiento'],$rowSistema['NdiasPago'] ));
								$ndiasdif1 = $ndiasdif1 - 2;
								
								//Se calculan los dias de diferencia entre cuando pago y la fecha actual de vencimiento
								$ndiasdif2 = dias_transcurridos($_SESSION['basicos']['Fecha'],$cliente['FechaPago']);
								
								//calculo los dias entre la facturacion actual y la anterior
								$ndiasdif3 = dias_transcurridos($_SESSION['basicos']['Fecha'],$cliente['FechaVencimiento']);
								$ndiasdif3 = $ndiasdif3 - 1;
						
								//calculo la diferencia entre lo facturado y lo pagado
								$montoFinal = $cliente['MontoPagado'] - $cliente['MontoPactado'];
								//verifico si efectivamente el valor pagado fue inferior al facturado
								if($montoFinal<0){
									$montoFinal = -1 * $montoFinal;
								}else{
									$montoFinal = 0;
								}
								
								//Se calcula el interes por el valor total en la diferencia de dias
								$interes1 = (($cliente['MontoPactado'] * $ndiasdif1 * $_SESSION['basicos']['intAnual'])/(360*100))*1.19;
								
								//Se calcula el interes del saldo en contra desde que se paga hasta que se factura
								$interes2 = (($montoFinal * $ndiasdif2 * $_SESSION['basicos']['intAnual'])/(360*100))*1.19;	
								
								//en caso de solo abonar se calcula el interes por la diferencia
								$saldo_ant = $cliente['MontoPactado'] - $cliente['MontoPagado'];
								if($saldo_ant>0){
									$interes3 = (($saldo_ant * $ndiasdif3 * $_SESSION['basicos']['intAnual'])/(360*100))*1.19;
								}else{
									$interes3 = $saldo_ant;
								}
								
								$subtotal = $subtotal + valores_truncados($interes1 + $interes2 + $interes3);
								
							}
							if(isset($cliente['SaldoAnterior'])&&$cliente['SaldoAnterior']!=''&&$cliente['SaldoAnterior']!=0){
								//calculo los dias entre la facturacion actual y la anterior
								$ndiasdif = dias_transcurridos($_SESSION['basicos']['Fecha'],$cliente['FechaVencimiento']);
								$ndiasdif = $ndiasdif - 1;
								//calculo
								$interes4 = (($cliente['SaldoAnterior'] * $ndiasdif * $_SESSION['basicos']['intAnual'])/(360*100))*1.19;
								$subtotal = $subtotal + valores_truncados($interes4);
							}
							$bla = $interes1 + $interes2 + $interes3 + $interes4;
							if($bla > 0){ 
								$DetalleInteresDeuda = $bla;
								$DetalleSaldoFavor = 0;
							}elseif($bla < 0){
								$DetalleInteresDeuda = 0;
								$DetalleSaldoFavor = $bla * -1;
							}else{
								$DetalleInteresDeuda = 0;
								$DetalleSaldoFavor = 0;
							}
							
							
							//Se trae el saldo anterior si es que este existe
							$saldo_ant = $cliente['MontoPactado'] - $cliente['MontoPagado'];
							if($saldo_ant>0){ 
								$DetalleSaldoAnterior = $saldo_ant;
							}else{
								$DetalleSaldoAnterior = 0;
							}
							$subtotal = $subtotal + valores_truncados($DetalleSaldoAnterior);
							
							
							
							
							//Ultimo Pago
							$AguasInfUltimoPago = $cliente['FechaPago'];
							
							
							//Total a Pagar
							$DetalleTotalAPagar = valores_truncados($subtotal);
							
							//Calculo de intereses y atrasos
							$AguasInfFactorCobro = 1;
							
							
							
	

							
							
							
							
							
							

							///////////////////////////////////////////////////////////////////////////////////////
							//                                                                                   //
							//                                     Ejecucion                                     //
							//                                                                                   //
							///////////////////////////////////////////////////////////////////////////////////////
							//se guarda el registro hijo
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
							if(isset($cliente['idCliente']) && $cliente['idCliente'] != ''){                                        $a .= ",'".$cliente['idCliente']."'" ;                                    }else{$a .=",''";}
							if(isset($cliente['Nombre']) && $cliente['Nombre'] != ''){                                              $a .= ",'".$cliente['Nombre']."'" ;                                       }else{$a .=",''";}
							if(isset($cliente['Direccion']) && $cliente['Direccion'] != ''){                                        $a .= ",'".$cliente['Direccion']."'" ;                                    }else{$a .=",''";}
							if(isset($cliente['Identificador']) && $cliente['Identificador'] != ''){                                $a .= ",'".$cliente['Identificador']."'" ;                                }else{$a .=",''";}
							if(isset($cliente['NombreComuna']) && $cliente['NombreComuna'] != ''){                                  $a .= ",'".$cliente['NombreComuna'].', '.$cliente['NombreCiudad']."'" ;   }else{$a .=",''";}
							if(isset($rowSistema['valorCargoFijo']) && $rowSistema['valorCargoFijo'] != ''){                        $a .= ",'".valores_truncados($rowSistema['valorCargoFijo']*$cliente['UnidadHabitacional'])."'" ;         }else{$a .=",''";}
							if(isset($ConsCantidad) &&$ConsCantidad != ''){                                                         $a .= ",'".$ConsCantidad."'" ;                                            }else{$a .=",''";}
							if(isset($TotalAgua) && $TotalAgua != ''){                                                              $a .= ",'".valores_truncados($TotalAgua)."'" ;                            }else{$a .=",''";}
							if(isset($ConsCantidad) &&$ConsCantidad != ''){                                                         $a .= ",'".$ConsCantidad."'" ;                                            }else{$a .=",''";}
							if(isset($TotalRecoleccion) && $TotalRecoleccion != ''){                                                $a .= ",'".valores_truncados($TotalRecoleccion)."'" ;                     }else{$a .=",''";}
							if(isset($ev1) && $ev1 != ''){                                                                          $a .= ",'".valores_truncados($ev1)."'" ;                                  }else{$a .=",''";}
							if(isset($ev2) && $ev2 != ''){                                                                          $a .= ",'".valores_truncados($ev2)."'" ;                                  }else{$a .=",''";}
							if(isset($ev3) && $ev3 != ''){                                                                          $a .= ",'".valores_truncados($ev3)."'" ;                                  }else{$a .=",''";}
							if(isset($ev4) && $ev4 != ''){                                                                          $a .= ",'".valores_truncados($ev4)."'" ;                                  }else{$a .=",''";}
							if(isset($ev5) && $ev5 != ''){                                                                          $a .= ",'".valores_truncados($ev5)."'" ;                                  }else{$a .=",''";}
							if(isset($DetalleInteresDeuda) && $DetalleInteresDeuda != ''){                                          $a .= ",'".valores_truncados($DetalleInteresDeuda)."'" ;                  }else{$a .=",''";}
							if(isset($DetalleSaldoFavor) && $DetalleSaldoFavor != ''){                                              $a .= ",'".valores_truncados($DetalleSaldoFavor)."'" ;                    }else{$a .=",''";}
							if(isset($DetalleSaldoAnterior) && $DetalleSaldoAnterior != ''){                                        $a .= ",'".valores_truncados($DetalleSaldoAnterior)."'" ;                 }else{$a .=",''";}
							if(isset($DetalleTotalAPagar) && $DetalleTotalAPagar != ''){                                            $a .= ",'".valores_truncados($DetalleTotalAPagar)."'" ;                   }else{$a .=",''";}
							if(isset($cliente['DetMesAnteriorConsumo']) && $cliente['DetMesAnteriorConsumo'] != ''){                $a .= ",'".valores_truncados($cliente['DetMesAnteriorConsumo'])."'" ;     }else{$a .=",''";}
							if(isset($cliente['DetMesActualConsumo']) && $cliente['DetMesActualConsumo'] != ''){                    $a .= ",'".valores_truncados($cliente['DetMesActualConsumo'])."'" ;       }else{$a .=",''";}
							if(isset($ConsCantidad) && $ConsCantidad != ''){                                                        $a .= ",'".$ConsCantidad."'" ;                                            }else{$a .=",''";}
							if(isset($cliente['DetMesActualFecha']) && $cliente['DetMesActualFecha'] != ''){                        $a .= ",'".sumarDias($cliente['DetMesActualFecha'], 30)."'" ;             }else{$a .=",''";}
							if(isset($rowSistema['Fac_nEmergencia']) && $rowSistema['Fac_nEmergencia'] != ''){                      $a .= ",'".$rowSistema['Fac_nEmergencia']."'" ;                           }else{$a .=",''";}
							if(isset($rowSistema['Fac_nConsultas']) && $rowSistema['Fac_nConsultas'] != ''){                        $a .= ",'".$rowSistema['Fac_nConsultas']."'" ;                            }else{$a .=",''";}
							if(isset($rowSistema['valorCargoFijo']) && $rowSistema['valorCargoFijo'] != ''){                        $a .= ",'".valores_truncados($rowSistema['valorCargoFijo'])."'" ;         }else{$a .=",''";}
							if(isset($rowSistema['valorAgua']) && $rowSistema['valorAgua'] != ''){                                  $a .= ",'".valores_truncados($rowSistema['valorAgua'])."'" ;              }else{$a .=",''";}
							if(isset($rowSistema['valorRecoleccion']) && $rowSistema['valorRecoleccion'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorRecoleccion'])."'" ;       }else{$a .=",''";}
							if(isset($rowSistema['valorVisitaCorte']) && $rowSistema['valorVisitaCorte'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorVisitaCorte'])."'" ;       }else{$a .=",''";}
							if(isset($rowSistema['valorCorte1']) && $rowSistema['valorCorte1'] != ''){                              $a .= ",'".valores_truncados($rowSistema['valorCorte1'])."'" ;            }else{$a .=",''";}
							if(isset($rowSistema['valorCorte2']) && $rowSistema['valorCorte2'] != ''){                              $a .= ",'".valores_truncados($rowSistema['valorCorte2'])."'" ;            }else{$a .=",''";}
							if(isset($rowSistema['valorReposicion1']) && $rowSistema['valorReposicion1'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorReposicion1'])."'" ;       }else{$a .=",''";}
							if(isset($rowSistema['valorReposicion2']) && $rowSistema['valorReposicion2'] != ''){                    $a .= ",'".valores_truncados($rowSistema['valorReposicion2'])."'" ;       }else{$a .=",''";}
							if(isset($AguasInfFactorCobro) && $AguasInfFactorCobro!= ''){                                           $a .= ",'".$AguasInfFactorCobro."'" ;                                     }else{$a .=",''";}
							if(isset($cliente['Arranque']) && $cliente['Arranque'] != ''){                                          $a .= ",'".$cliente['Arranque']."'" ;                                     }else{$a .=",''";}
							if(isset($cliente['DetMesActualTipoFacturacion']) && $cliente['DetMesActualTipoFacturacion'] != ''){    $a .= ",'".$cliente['DetMesActualTipoFacturacion']."'" ;                  }else{$a .=",''";}
							if(isset($cliente['DetMesActualTipoLectura']) && $cliente['DetMesActualTipoLectura'] != ''){            $a .= ",'".$cliente['DetMesActualTipoLectura']."'" ;                      }else{$a .=",''";}
							if(isset($Medidor) && $Medidor != ''){                                                                  $a .= ",'".$Medidor."'" ;                                                 }else{$a .=",''";}
							if(isset($_SESSION['basicos']['Fecha']) && $_SESSION['basicos']['Fecha'] != ''){                        $a .= ",'".$_SESSION['basicos']['Fecha']."'" ;                            }else{$a .=",''";}
							if(isset($AguasInfUltimoPago) && $AguasInfUltimoPago != ''){                                            $a .= ",'".$AguasInfUltimoPago."'" ;                                      }else{$a .=",''";}
							if(isset($cliente['DetMesActualFecha']) && $cliente['DetMesActualFecha'] != ''){                        $a .= ",'".$cliente['DetMesActualFecha']."'" ;                            }else{$a .=",''";}
							$a .= ",'1'" ; 
							if(isset($_SESSION['basicos']['intAnual']) && $_SESSION['basicos']['intAnual'] != ''){                  $a .= ",'".$_SESSION['basicos']['intAnual']."'" ;                         }else{$a .=",''";}
							if(isset($rem_cantidad)&&$rem_cantidad!= ''){                                                           $a .= ",'".$rem_cantidad."'" ;                                            }else{$a .=",''";}
							if(isset($rem_procentaje)&&$rem_procentaje!= ''){                                                       $a .= ",'".$rem_procentaje."'" ;                                          }else{$a .=",''";}
							if(isset($rem_negative)&&$rem_negative!= ''){                                                           $a .= ",'".$rem_negative."'" ;                                            }else{$a .=",''";}
							if(isset($rem_modalidad)&&$rem_modalidad!= ''){                                                         $a .= ",'".$rem_modalidad."'" ;                                           }else{$a .=",''";}
							if(isset($rem_diferencia)&&$rem_diferencia!= ''){                                                       $a .= ",'".$rem_diferencia."'" ;                                          }else{$a .=",''";}
							
							
							
							// inserto los datos de registro en la db
							$query  = "INSERT INTO `facturacion_listado_detalle` (idSistema, idUsuario, idFacturacion, Fecha, Dia,
							idMes, Ano, idCliente, ClienteNombre, ClienteDireccion, ClienteIdentificador, ClienteNombreComuna,
							DetalleCargoFijoValor, DetalleConsumoCantidad, DetalleConsumoValor, DetalleRecoleccionCantidad,
							DetalleRecoleccionValor, DetalleVisitaCorte, DetalleCorte1Valor, DetalleCorte2Valor, DetalleReposicion1Valor,
							DetalleReposicion2Valor, DetalleInteresDeuda, DetalleSaldoFavor, DetalleSaldoAnterior, DetalleTotalAPagar, DetConsMesAnteriorCantidad,
							DetConsMesActualCantidad, DetConsMesTotalCantidad, DetConsFechaProxLectura, DetConsFonoEmergencias, DetConsFonoConsultas,
							AguasInfCargoFijo, AguasInfMetroAgua, AguasInfMetroRecolecion, AguasInfVisitaCorte, AguasInfCorte1,
							AguasInfCorte2, AguasInfReposicion1, AguasInfReposicion2, AguasInfFactorCobro, AguasInfPuntoDiametro,
							AguasInfClaveFacturacion, AguasInfClaveLectura, AguasInfNumeroMedidor, AguasInfFechaEmision, AguasInfUltimoPago, 
							AguasInfMovimientosHasta, idEstado, intAnual, rem_cantidad, rem_procentaje, rem_negative, rem_modalidad, rem_diferencia ) 
							VALUES ({$a} )";
							$result = mysqli_query($dbConn, $query);
							
							echo $query.'<br/>';
							
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
								case 2:   $a .= ",idEstadoPago='3'" ; break;
								case 3:   $a .= ",idEstadoPago='3'" ; break;
								case 4:   $a .= ",idEstadoPago='3'" ; break;
								case 5:   $a .= ",idEstadoPago='3'" ; break;
								case 6:   $a .= ",idEstadoPago='3'" ; break;
								case 7:   $a .= ",idEstadoPago='3'" ; break;
								case 8:   $a .= ",idEstadoPago='3'" ; break;
								case 9:   $a .= ",idEstadoPago='3'" ; break;
								case 10:  $a .= ",idEstadoPago='3'" ; break;
								case 11:  $a .= ",idEstadoPago='3'" ; break;
								case 12:  $a .= ",idEstadoPago='3'" ; break;
							}
							// inserto los datos de registro en la db
							$query  = "UPDATE `clientes_listado` SET ".$a." WHERE idCliente = '{$cliente['idCliente']}'";
							$result = mysqli_query($dbConn, $query);
				
							
							
						
						}
					}
				}
				

				//redirijo a la vista
			//	header( 'Location: '.$location.'&created=true' );
			//	die;
				
				
				
			}
		
		
		
		break;
/*******************************************************************************************************************/
	}
?>
