<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Excel.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/

if(isset($_GET['type'])&&$_GET['type']!=''){
	switch ($_GET['type']) {
		/*******************************************************************/
		//Insumos
		case 1:
			//Verificar la existencia
			//Si existe se elimina
			if(isset($_SESSION['pago_clientes_insumos'][$_GET['idFacturacion']]['idFacturacion'])&&$_SESSION['pago_clientes_insumos'][$_GET['idFacturacion']]['idFacturacion']!=''&&$_SESSION['pago_clientes_insumos'][$_GET['idFacturacion']]['idFacturacion']==$_GET['idFacturacion']){
				unset($_SESSION['pago_clientes_insumos'][$_GET['idFacturacion']]);
			//Si no existe se crea	
			}else{
				//consulto todos los documentos relacionados al proveedor
				$query = "SELECT 
				bodegas_insumos_facturacion.idFacturacion,
				bodegas_insumos_facturacion.N_Doc,
				bodegas_insumos_facturacion.ValorTotal,
				bodegas_insumos_facturacion.idSistema,
				bodegas_insumos_facturacion.idCliente,
				bodegas_insumos_facturacion.idDocumentos,
				clientes_listado.Nombre AS ClienteNombre,
				core_documentos_mercantiles.Nombre AS Documento,
				(SELECT SUM(MontoPagado) FROM `pagos_facturas_clientes` WHERE idFacturacion= bodegas_insumos_facturacion.idFacturacion LIMIT 1) AS MontoPagado

				FROM `bodegas_insumos_facturacion`
				LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos  = bodegas_insumos_facturacion.idDocumentos
				LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                = bodegas_insumos_facturacion.idCliente
								
				WHERE bodegas_insumos_facturacion.idFacturacion=".$_GET['idFacturacion'];
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
									
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
									
				}
				$row_data = mysqli_fetch_assoc ($resultado);

				/******************************************************************/
				//Se traspasan los valores a variables de sesion
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['idFacturacion']      = $row_data['idFacturacion'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['N_Doc']              = $row_data['N_Doc'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['Documento']          = $row_data['Documento'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['Cliente']            = $row_data['ClienteNombre'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['ValorTotal']         = $row_data['ValorTotal'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['MontoPagado']        = $row_data['MontoPagado'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['idSistema']          = $row_data['idSistema'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['idCliente']          = $row_data['idCliente'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['idDocumentos']       = $row_data['idDocumentos'];
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['ValorPagado']        = '';
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['FacRelacionada']     = '';
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['idFacRelacionada']   = 0;
				$_SESSION['pago_clientes_insumos'][$row_data['idFacturacion']]['MontoNC']            = 0;

			}
					
			break;
		/*******************************************************************/
		//Productos
		case 2:
			//Verificar la existencia
			//Si existe se elimina
			if(isset($_SESSION['pago_clientes_productos'][$_GET['idFacturacion']]['idFacturacion'])&&$_SESSION['pago_clientes_productos'][$_GET['idFacturacion']]['idFacturacion']!=''&&$_SESSION['pago_clientes_productos'][$_GET['idFacturacion']]['idFacturacion']==$_GET['idFacturacion']){
				unset($_SESSION['pago_clientes_productos'][$_GET['idFacturacion']]);
			//Si no existe se crea	
			}else{
				/*************************************************************/
				//consulto todos los documentos relacionados al proveedor
				$query = "SELECT 
				bodegas_productos_facturacion.idFacturacion,
				bodegas_productos_facturacion.N_Doc,
				bodegas_productos_facturacion.ValorTotal,
				bodegas_productos_facturacion.idSistema,
				bodegas_productos_facturacion.idCliente,
				bodegas_productos_facturacion.idDocumentos,
				clientes_listado.Nombre AS ClienteNombre,
				core_documentos_mercantiles.Nombre AS Documento,
				(SELECT SUM(MontoPagado) FROM `pagos_facturas_clientes` WHERE idFacturacion= bodegas_productos_facturacion.idFacturacion LIMIT 1) AS MontoPagado
								
				FROM `bodegas_productos_facturacion`
				LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos  = bodegas_productos_facturacion.idDocumentos
				LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                = bodegas_productos_facturacion.idCliente
								
				WHERE bodegas_productos_facturacion.idFacturacion=".$_GET['idFacturacion'];
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
									
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
									
				}
				$row_data = mysqli_fetch_assoc ($resultado);

				/******************************************************************/
				//Se traspasan los valores a variables de sesion
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['idFacturacion']      = $row_data['idFacturacion'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['N_Doc']              = $row_data['N_Doc'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['Documento']          = $row_data['Documento'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['Cliente']            = $row_data['ClienteNombre'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['ValorTotal']         = $row_data['ValorTotal'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['MontoPagado']        = $row_data['MontoPagado'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['idSistema']          = $row_data['idSistema'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['idCliente']          = $row_data['idCliente'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['idDocumentos']       = $row_data['idDocumentos'];
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['ValorPagado']        = '';
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['FacRelacionada']     = '';
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['idFacRelacionada']   = 0;
				$_SESSION['pago_clientes_productos'][$row_data['idFacturacion']]['MontoNC']            = 0;

			}
			break;
		/*******************************************************************/
		//Arriendos
		case 3:
			//Verificar la existencia
			//Si existe se elimina
			if(isset($_SESSION['pago_clientes_arriendo'][$_GET['idFacturacion']]['idFacturacion'])&&$_SESSION['pago_clientes_arriendo'][$_GET['idFacturacion']]['idFacturacion']!=''&&$_SESSION['pago_clientes_arriendo'][$_GET['idFacturacion']]['idFacturacion']==$_GET['idFacturacion']){
				unset($_SESSION['pago_clientes_arriendo'][$_GET['idFacturacion']]);
			//Si no existe se crea	
			}else{
				/*************************************************************/
				//consulto todos los documentos relacionados al proveedor
				$query = "SELECT 
				bodegas_arriendos_facturacion.idFacturacion,
				bodegas_arriendos_facturacion.N_Doc,
				bodegas_arriendos_facturacion.ValorTotal,
				bodegas_arriendos_facturacion.idSistema,
				bodegas_arriendos_facturacion.idCliente,
				bodegas_arriendos_facturacion.idDocumentos,
				clientes_listado.Nombre AS ClienteNombre,
				core_documentos_mercantiles.Nombre AS Documento,
				(SELECT SUM(MontoPagado) FROM `pagos_facturas_clientes` WHERE idFacturacion= bodegas_arriendos_facturacion.idFacturacion LIMIT 1) AS MontoPagado
								
				FROM `bodegas_arriendos_facturacion`
				LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos  = bodegas_arriendos_facturacion.idDocumentos
				LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                = bodegas_arriendos_facturacion.idCliente
								
				WHERE bodegas_arriendos_facturacion.idFacturacion=".$_GET['idFacturacion'];
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
									
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
									
				}
				$row_data = mysqli_fetch_assoc ($resultado);

				/******************************************************************/
				//Se traspasan los valores a variables de sesion
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['idFacturacion']      = $row_data['idFacturacion'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['N_Doc']              = $row_data['N_Doc'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['Documento']          = $row_data['Documento'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['Cliente']            = $row_data['ClienteNombre'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['ValorTotal']         = $row_data['ValorTotal'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['MontoPagado']        = $row_data['MontoPagado'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['idSistema']          = $row_data['idSistema'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['idCliente']          = $row_data['idCliente'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['idDocumentos']       = $row_data['idDocumentos'];
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['ValorPagado']        = '';
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['FacRelacionada']     = '';
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['idFacRelacionada']   = 0;
				$_SESSION['pago_clientes_arriendo'][$row_data['idFacturacion']]['MontoNC']            = 0;

			}
			break;
		/*******************************************************************/
		//Servicios
		case 4:
			//Verificar la existencia
			//Si existe se elimina
			if(isset($_SESSION['pago_clientes_servicio'][$_GET['idFacturacion']]['idFacturacion'])&&$_SESSION['pago_clientes_servicio'][$_GET['idFacturacion']]['idFacturacion']!=''&&$_SESSION['pago_clientes_servicio'][$_GET['idFacturacion']]['idFacturacion']==$_GET['idFacturacion']){
				unset($_SESSION['pago_clientes_servicio'][$_GET['idFacturacion']]);
			//Si no existe se crea	
			}else{
				/*************************************************************/
				//consulto todos los documentos relacionados al proveedor
				$query = "SELECT 
				bodegas_servicios_facturacion.idFacturacion,
				bodegas_servicios_facturacion.N_Doc,
				bodegas_servicios_facturacion.ValorTotal,
				bodegas_servicios_facturacion.idSistema,
				bodegas_servicios_facturacion.idCliente,
				bodegas_servicios_facturacion.idDocumentos,
				clientes_listado.Nombre AS ClienteNombre,
				core_documentos_mercantiles.Nombre AS Documento,
				(SELECT SUM(MontoPagado) FROM `pagos_facturas_clientes` WHERE idFacturacion= bodegas_servicios_facturacion.idFacturacion LIMIT 1) AS MontoPagado
								
				FROM `bodegas_servicios_facturacion`
				LEFT JOIN `core_documentos_mercantiles`  ON core_documentos_mercantiles.idDocumentos  = bodegas_servicios_facturacion.idDocumentos
				LEFT JOIN `clientes_listado`             ON clientes_listado.idCliente                = bodegas_servicios_facturacion.idCliente
								
				WHERE bodegas_servicios_facturacion.idFacturacion=".$_GET['idFacturacion'];
				//Consulta
				$resultado = mysqli_query ($dbConn, $query);
				//Si ejecuto correctamente la consulta
				if(!$resultado){
					//Genero numero aleatorio
					$vardata = genera_password(8,'alfanumerico');
									
					//Guardo el error en una variable temporal
					$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
					$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
					$_SESSION['ErrorListing'][$vardata]['query']        = $query;
									
				}
				$row_data = mysqli_fetch_assoc ($resultado);

				/******************************************************************/
				//Se traspasan los valores a variables de sesion
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['idFacturacion']      = $row_data['idFacturacion'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['N_Doc']              = $row_data['N_Doc'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['Documento']          = $row_data['Documento'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['Cliente']            = $row_data['ClienteNombre'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['ValorTotal']         = $row_data['ValorTotal'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['MontoPagado']        = $row_data['MontoPagado'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['idSistema']          = $row_data['idSistema'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['idCliente']          = $row_data['idCliente'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['idDocumentos']       = $row_data['idDocumentos'];
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['ValorPagado']        = '';
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['FacRelacionada']     = '';
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['idFacRelacionada']   = 0;
				$_SESSION['pago_clientes_servicio'][$row_data['idFacturacion']]['MontoNC']            = 0;

			}
			break;
	}
}










	
























?>
