<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
if( ! defined('XMBCXRXSKGC')){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1009-031).');
}
/*******************************************************************************************************************/
/*                                          Verifica si la Sesion esta activa                                      */
/*******************************************************************************************************************/
require_once '0_validate_user_1.php';
/*******************************************************************************************************************/
/*                                            Se ejecutan las instrucciones                                        */
/*******************************************************************************************************************/
	//ejecuto segun la funcion
	switch ($form_trabajo) {
/*******************************************************************************************************************/
		case 'reset':

			//Se elimina la restriccion del sql 5.7
			mysqli_query($dbConn, "SET SESSION sql_mode = ''");

			//Si no hay errores ejecuto el codigo
			if(empty($error)){

				$idBodega        = $_GET['reseteo'];
				$Observaciones   = 'Cuadratura a 0 en bodegas';
				$idSistema       = $_SESSION['usuario']['basic_data']['idSistema'];
				$idUsuario       = $_SESSION['usuario']['basic_data']['idUsuario'];
				$Creacion_fecha  = fecha_actual();
				$idTipo          = 3;
				$fecha_auto      = fecha_actual();
				$idTrabajador    = 2;

				//Se guardan los datos basicos del formulario recien llenado
				if(isset($idBodega) && $idBodega!=''){                   $_SESSION['insumos_egr_basicos']['idBodega']       = $idBodega;}
				if(isset($Observaciones) && $Observaciones!=''){         $_SESSION['insumos_egr_basicos']['Observaciones']  = $Observaciones;}
				if(isset($idSistema) && $idSistema!=''){                 $_SESSION['insumos_egr_basicos']['idSistema']      = $idSistema;}
				if(isset($idUsuario) && $idUsuario!=''){                 $_SESSION['insumos_egr_basicos']['idUsuario']      = $idUsuario;}
				if(isset($Creacion_fecha) && $Creacion_fecha!=''){       $_SESSION['insumos_egr_basicos']['Creacion_fecha'] = $Creacion_fecha;}
				if(isset($idTipo) && $idTipo!=''){                       $_SESSION['insumos_egr_basicos']['idTipo']         = $idTipo;}
				if(isset($idTrabajador) && $idTrabajador!=''){           $_SESSION['insumos_egr_basicos']['idTrabajador']   = $idTrabajador;}
				if(isset($fecha_auto) && $fecha_auto!=''){               $_SESSION['insumos_egr_basicos']['fecha_auto']     = $fecha_auto;}

				/********************************************************************************/
				if(isset($idTipo) && $idTipo!=''){
					// consulto los datos
					$rowdata = db_select_data (false, 'Nombre', 'bodegas_insumos_facturacion_tipo', '', 'idTipo = "'.$idTipo.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['TipoDocumento'] = $rowdata['Nombre'];
				}else{
					$_SESSION['insumos_egr_basicos']['TipoDocumento'] = '';
				}
				/****************************************************/
				if(isset($idBodega) && $idBodega!=''){
					// consulto los datos
					$rowdata = db_select_data (false, 'Nombre', 'bodegas_insumos_listado', '', 'idBodega = "'.$idBodega.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['Bodega'] = $rowdata['Nombre'];
				}else{
					$_SESSION['insumos_egr_basicos']['Bodega'] = '';
				}
				/****************************************************/
				if(isset($idTrabajador) && $idTrabajador!=''){
					// consulto los datos
					$rowdata = db_select_data (false, 'Nombre,ApellidoPat, ApellidoMat', 'trabajadores_listado', '', 'idTrabajador = "'.$idTrabajador.'"', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);
					//se guarda dato
					$_SESSION['insumos_egr_basicos']['Trabajador'] = $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat'];
				}else{
					$_SESSION['insumos_egr_basicos']['Trabajador'] = '';
				}

				/***********************************/
				//Centro de Costo vacio
				$_SESSION['insumos_egr_basicos']['CentroCosto']   = 'Sin Centro de Costo Asignado';
				$_SESSION['insumos_egr_basicos']['idCentroCosto'] = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_1']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_2']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_3']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_4']     = 0;
				$_SESSION['insumos_egr_basicos']['idLevel_5']     = 0;

				/**********************************************************************************************/
				//Productos
				$SIS_query = '
				insumos_listado.idProducto,
				insumos_listado.Nombre AS NombreProd,
				sistema_productos_uml.Nombre AS UnidadMedida,
				insumos_listado.ValorIngreso,
				(SELECT SUM(Cantidad_ing) FROM bodegas_insumos_facturacion_existencias WHERE idProducto = insumos_listado.idProducto AND idBodega='.$idBodega.'  LIMIT 1) AS stock_entrada,
				(SELECT SUM(Cantidad_eg) FROM bodegas_insumos_facturacion_existencias  WHERE idProducto = insumos_listado.idProducto AND idBodega='.$idBodega.' LIMIT 1) AS stock_salida,
				(SELECT Nombre FROM bodegas_insumos_listado WHERE idBodega='.$idBodega.' LIMIT 1) AS NombreBodega';
				$SIS_join  = 'LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml  = insumos_listado.idUml';
				$SIS_where = 'insumos_listado.idProducto!=0';
				$SIS_order = 'insumos_listado.Nombre ASC';
				$arrProductos = array();
				$arrProductos = db_select_array (false, $SIS_query, 'insumos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, $form_trabajo);

				//recorro loa productos con stock
				foreach ($arrProductos as $productos) {
					$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
					//mientras el stock es superior a 0
					if ($stock_actual>0){

						$_SESSION['insumos_egr_productos'][$productos['idProducto']]['idProducto']    = $productos['idProducto'];
						$_SESSION['insumos_egr_productos'][$productos['idProducto']]['Number']        = $stock_actual;
						$_SESSION['insumos_egr_productos'][$productos['idProducto']]['ValorEgreso']   = $productos['ValorIngreso'];
						$_SESSION['insumos_egr_productos'][$productos['idProducto']]['ValorTotal']    = $productos['ValorIngreso'] * $stock_actual;
						$_SESSION['insumos_egr_productos'][$productos['idProducto']]['Nombre']        = $productos['NombreProd'];
						$_SESSION['insumos_egr_productos'][$productos['idProducto']]['Unimed']        = $productos['UnidadMedida'];

					}
				}

				//redirijo a gastos
				header( 'Location: bodegas_insumos_egreso.php?pagina=1&view=true' );
				die;

			}

		break;

/*******************************************************************************************************************/
	}
?>
