<?php
//Verifico si esta activada la actualizacion de la pagina
	if($n_permisos['idOpcionesGen_4']=='1') { 
		//si los segundos no estan configurados
		if(isset($n_permisos['idOpcionesGen_6'])&&$n_permisos['idOpcionesGen_6']!=0){
			$x_seg = $n_permisos['idOpcionesGen_6'] * 1000;
		}else{
			$x_seg = 60000;
		}

		$Url  = 'principal_telemetria_alt.php';
		$Url .= '?bla=bla';
		$Url .= '&idTipoUsuario='.$idTipoUsuario;
		$Url .= '&prm_x_7='.$prm_x[7];
		$Url .= '&prm_x_8='.$prm_x[8];
		$Url .= '&prm_x_9='.$prm_x[9];
		$Url .= '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
		$Url .= '&Config_IDGoogle='.$_SESSION['usuario']['basic_data']['Config_IDGoogle'];
		$Url .= '&idUsuario='.$_SESSION['usuario']['basic_data']['idUsuario'];
		$Url .= '&trans_8='.$trans[8];
		$Url .= '&trans_9='.$trans[9];
							
		echo '
			<script type="text/javascript">
				function actualiza_contenido() {
					var url = "'.$Url.'";
					$("#update_tel").load(url);
				}
				setInterval("actualiza_contenido()", '.$x_seg.');

			</script>';
	}
?>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['bar', 'table']});
	</script>
	<?php
	/*****************************************************************************************************************/
	/*                                Visualizacion del widget del administrador                                     */
	/*****************************************************************************************************************/
	if($idTipoUsuario==1) { 
		//verifica la capa de desarrollo
		$whitelist = array( 'localhost', '127.0.0.1', '::1' );
		//si estoy en ambiente de desarrollo
		if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){
			echo widget_superadmin($dbConn, DB_SERVER, DB_USER, DB_PASS, 'power_engine_main', DB_NAME );
		//si estoy en ambiente de produccion	
		}else{
			echo widget_superadmin($dbConn, DB_SERVER, DB_USER, DB_PASS, 'hbarzela_power_engine_main', DB_NAME );
		}
	}
	/*****************************************************************************************************************/
	/*                                    Visualizacion de los widgets Comunes                                       */
	/*****************************************************************************************************************/
	if($n_permisos['idOpcionesGen_1']=='1' or $idTipoUsuario==1) { 

		echo widget_comunes($subconsulta['Comuna'], 
							$subconsulta['Wheater'],
							$_SESSION['usuario']['basic_data']['Nombre'],
							$subconsulta['Notificacion'],
							$subconsulta['CuentaContactos'],
							$subconsulta['CuentaEventos']);

	}
	/*****************************************************************************************************************/
	/*                                Visualizacion de los widgets de las transacciones                              */
	/*****************************************************************************************************************/
	if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) { 
		

		/*******************************************/
		//Acceso a los widget de recordatorio
		//Solicitudes
		if(isset($prm_x[13])&&$prm_x[13]=='1' or $idTipoUsuario==1){
			$totalSol = $subconsulta['CuentaSolProd'] + $subconsulta['CuentaSolIns'] + $subconsulta['CuentaSolArr'] + $subconsulta['CuentaSolServ'] + $subconsulta['CuentaSolOtro'];					
		}else{
			$totalSol = 0;
		}
		//Facturas por pagar
		$PermFactCompra = $prm_x[15] + $prm_x[16] + $prm_x[17] + $prm_x[18];					
		if($PermFactCompra!=0 or $idTipoUsuario==1){
			$totalFactCompra       = $subconsulta['CountFactArriendo'] + $subconsulta['CountFactInsumo'] + $subconsulta['CountFactProducto'] + $subconsulta['CountFactServicio'];					
			$totalFactCompra_retr  = $subconsulta['CountFactArriendo_retr'] + $subconsulta['CountFactInsumo_retr'] + $subconsulta['CountFactProducto_retr'] + $subconsulta['CountFactServicio_retr'];					
		}else{
			$totalFactCompra       = 0;
			$totalFactCompra_retr  = 0;
		}
		//Facturas por cobrar
		$PermFactVenta = $prm_x[19] + $prm_x[20] + $prm_x[21] + $prm_x[22];					
		if($PermFactVenta!=0 or $idTipoUsuario==1){
			$totalFactVenta       = $subconsulta['CountFactArriendoVent'] + $subconsulta['CountFactProductoVent'] + $subconsulta['CountFactServicioVent'];					
		}else{
			$totalFactVenta       = 0;
		}
		//Documentos por pagar
		$PermChequesPagar  = $prm_x[23] + $prm_x[24];
		
		/**********************************************************/
		echo widget_recordatorios($idTipoUsuario,
								$prm_x[12],$subconsulta['CuentaRecargas'],
								$prm_x[13],$totalSol,
								$prm_x[14],$subconsulta['CuentaOC'],
								$PermFactCompra,$totalFactCompra,$totalFactCompra_retr,
								$prm_x[15],$subconsulta['CountArriendoIn'],
								$PermFactVenta,$totalFactVenta,
								$prm_x[19],$subconsulta['CountArriendoOut'],
								$PermChequesPagar,$subconsulta['CountChequePago']
								);


	} 
	/*****************************************************************************************************************/
	/*                             Visualizacion de los widget de geolocalizacion                                    */
	/*****************************************************************************************************************/
	//Vehiculos
	echo '<div class="col-sm-12" id="update_tel">';
		if($prm_x[7]=='1' or $idTipoUsuario==1) {
			
			

			echo widget_GPS_equipos('Mapa GPS','Vehiculos', 1, 2, $_SESSION['usuario']['basic_data']['idSistema'], 
									$_SESSION['usuario']['basic_data']['Config_IDGoogle'],
									$_SESSION['usuario']['basic_data']['idTipoUsuario'],
									$_SESSION['usuario']['basic_data']['idUsuario'],$dbConn);
			echo widget_Resumen_GPS_equipos('Vehiculos', 1, $_SESSION['usuario']['basic_data']['idSistema'],
									$_SESSION['usuario']['basic_data']['idTipoUsuario'],
									$_SESSION['usuario']['basic_data']['idUsuario'],$dbConn);
					
		}
		//Fijos		
		if($prm_x[8]=='1' or $idTipoUsuario==1) {

			echo widget_GPS_equipos('Mapa GPS','Fijos', 2, 2, $_SESSION['usuario']['basic_data']['idSistema'], 
									$_SESSION['usuario']['basic_data']['Config_IDGoogle'],
									$_SESSION['usuario']['basic_data']['idTipoUsuario'],
									$_SESSION['usuario']['basic_data']['idUsuario'],$dbConn);	
			echo widget_GPS_equipos_lista('Ultimas Mediciones', 2, 0, $trans[8], 
										  $_SESSION['usuario']['basic_data']['idSistema'],
										  $_SESSION['usuario']['basic_data']['idTipoUsuario'],
										  $_SESSION['usuario']['basic_data']['idUsuario'], $dbConn);
			
		}
		//Equipos		
		if($prm_x[9]=='1' or $idTipoUsuario==1) {
			
			echo widget_Equipos('Equipo', 2, 0,$trans[9], $_SESSION['usuario']['basic_data']['idSistema'],
								$_SESSION['usuario']['basic_data']['idTipoUsuario'],
								$_SESSION['usuario']['basic_data']['idUsuario'], $dbConn);
			echo widget_Resumen_equipo('Ultimas Mediciones', 2, 0, $trans[9], 
										$_SESSION['usuario']['basic_data']['idSistema'],
										$_SESSION['usuario']['basic_data']['idTipoUsuario'],
										$_SESSION['usuario']['basic_data']['idUsuario'], $dbConn);
				
		}
	echo '</div>';
	/*****************************************************************************************************************/
	/*                                         Stock Bodega de Productos                                             */
	/*****************************************************************************************************************/
	//Si es gerente puede ver todas las bodegas asignadas
	if($prm_x[1]=='1' or $idTipoUsuario==1) {
		
		//Bodega de Productos
		echo widget_bodega('Bodega de Productos',
						   'bodegas_productos_listado', 'bodegas_productos_facturacion_existencias', 'bodegas_productos_facturacion_tipo', 
						   'productos_listado', 'sistema_productos_uml', 'tipo1,tipo2,tipo3,tipo4,tipo5,tipo6,tipo7,tipo8,tipo9',1,
						   $trans[1],$dbConn, 'usuarios_bodegas_productos', $_SESSION['usuario']['basic_data']['idSistema']);
		
		//Bodega de Insumos
		echo widget_bodega('Bodega de Insumos',
						   'bodegas_insumos_listado', 'bodegas_insumos_facturacion_existencias', 'bodegas_insumos_facturacion_tipo', 
						   'insumos_listado', 'sistema_productos_uml', 'tipo1,tipo2,tipo3,tipo4,tipo5,tipo6,tipo7,tipo8,tipo9',2,
						   $trans[1],$dbConn, 'usuarios_bodegas_insumos', $_SESSION['usuario']['basic_data']['idSistema']);
	
	//Si no es gerente solo puede ver las que tengasn permisos			   
	}else{
		//Bodega de Productos
		if($prm_x[2]=='1' or $idTipoUsuario==1) {
			echo widget_bodega('Bodega de Productos',
								'bodegas_productos_listado', 'bodegas_productos_facturacion_existencias', 'bodegas_productos_facturacion_tipo', 
								'productos_listado', 'sistema_productos_uml', 'tipo1,tipo2,tipo3,tipo4,tipo5,tipo6,tipo7,tipo8,tipo9',1,
								$trans[2],$dbConn, 'usuarios_bodegas_productos', $_SESSION['usuario']['basic_data']['idSistema']);
		}
		//Bodega de Insumos
		if($prm_x[3]=='1' or $idTipoUsuario==1) {
			echo widget_bodega('Bodega de Insumos',
								'bodegas_insumos_listado', 'bodegas_insumos_facturacion_existencias', 'bodegas_insumos_facturacion_tipo', 
								'insumos_listado', 'sistema_productos_uml', 'tipo1,tipo2,tipo3,tipo4,tipo5,tipo6,tipo7,tipo8,tipo9',2,
								$trans[3],$dbConn, 'usuarios_bodegas_insumos', $_SESSION['usuario']['basic_data']['idSistema']);
		}
		//Bodega de Arriendos
		if($prm_x[4]=='1' or $idTipoUsuario==1) {
			
		}
		//Bodega de Servicios
		if($prm_x[5]=='1' or $idTipoUsuario==1) {
			
		}
	}

?>
