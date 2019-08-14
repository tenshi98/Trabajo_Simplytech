<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Maqueta</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<style>
			body {background-color: #FFF !important;}
		</style>
	</head>

	<body>
<?php 
//
$arrProducto = array();

//Filtro el tipo de documento
switch ($_GET['type']) {
    /********************************************************/
    //Producto
    case 1:
        // Se trae un listado de los valores
		$query = "SELECT
		bodegas_productos_facturacion_existencias.Valor AS Precio,
		bodegas_productos_facturacion_existencias.Creacion_fecha,
		productos_listado.Nombre AS Producto,
		proveedor_listado.Nombre AS Proveedor

		FROM `bodegas_productos_facturacion_existencias`
		LEFT JOIN bodegas_productos_facturacion    ON bodegas_productos_facturacion.idFacturacion    = bodegas_productos_facturacion_existencias.idFacturacion
		LEFT JOIN productos_listado                ON productos_listado.idProducto                   = bodegas_productos_facturacion_existencias.idProducto
		LEFT JOIN proveedor_listado                ON proveedor_listado.idProveedor                  = bodegas_productos_facturacion_existencias.idProveedor

		WHERE bodegas_productos_facturacion_existencias.idProducto={$_GET['view']}
		AND bodegas_productos_facturacion.idTipo = 1 
		ORDER BY bodegas_productos_facturacion_existencias.Creacion_fecha DESC 
		LIMIT 40";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			error_log("========================================================================================================================================", 0);
			error_log("Usuario: ". $NombreUsr, 0);
			error_log("Transaccion: ". $Transaccion, 0);
			error_log("-------------------------------------------------------------------", 0);
			error_log("Error code: ". mysqli_errno($dbConn), 0);
			error_log("Error description: ". mysqli_error($dbConn), 0);
			error_log("Error query: ". $query, 0);
			error_log("-------------------------------------------------------------------", 0);
							
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrProducto,$row );
		}
    break;
    /********************************************************/
    //Insumo
    case 2:
        // Se trae un listado de los valores
		$query = "SELECT
		bodegas_insumos_facturacion_existencias.Valor AS Precio,
		bodegas_insumos_facturacion_existencias.Creacion_fecha,
		insumos_listado.Nombre AS Producto,
		proveedor_listado.Nombre AS Proveedor

		FROM `bodegas_insumos_facturacion_existencias`
		LEFT JOIN bodegas_insumos_facturacion      ON bodegas_insumos_facturacion.idFacturacion      = bodegas_insumos_facturacion_existencias.idFacturacion
		LEFT JOIN insumos_listado                  ON insumos_listado.idProducto                     = bodegas_insumos_facturacion_existencias.idProducto
		LEFT JOIN proveedor_listado                ON proveedor_listado.idProveedor                  = bodegas_insumos_facturacion_existencias.idProveedor

		WHERE bodegas_insumos_facturacion_existencias.idProducto={$_GET['view']}
		AND bodegas_insumos_facturacion.idTipo = 1 
		ORDER BY bodegas_insumos_facturacion_existencias.Creacion_fecha DESC 
		LIMIT 40";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			error_log("========================================================================================================================================", 0);
			error_log("Usuario: ". $NombreUsr, 0);
			error_log("Transaccion: ". $Transaccion, 0);
			error_log("-------------------------------------------------------------------", 0);
			error_log("Error code: ". mysqli_errno($dbConn), 0);
			error_log("Error description: ". mysqli_error($dbConn), 0);
			error_log("Error query: ". $query, 0);
			error_log("-------------------------------------------------------------------", 0);
							
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrProducto,$row );
		}
    break;
    /********************************************************/
    //Arriendo
    case 3:
        // Se trae un listado de los valores
		$query = "SELECT
		bodegas_arriendos_facturacion_existencias.ValorTotal AS Precio,
		bodegas_arriendos_facturacion_existencias.Creacion_fecha,
		equipos_arriendo_listado.Nombre AS Producto,
		proveedor_listado.Nombre AS Proveedor

		FROM `bodegas_arriendos_facturacion_existencias`
		LEFT JOIN bodegas_arriendos_facturacion    ON bodegas_arriendos_facturacion.idFacturacion    = bodegas_arriendos_facturacion_existencias.idFacturacion
		LEFT JOIN equipos_arriendo_listado         ON equipos_arriendo_listado.idEquipo              = bodegas_arriendos_facturacion_existencias.idEquipo
		LEFT JOIN proveedor_listado                ON proveedor_listado.idProveedor                  = bodegas_arriendos_facturacion_existencias.idProveedor

		WHERE bodegas_arriendos_facturacion_existencias.idEquipo={$_GET['view']}
		AND bodegas_arriendos_facturacion.idTipo = 1 
		ORDER BY bodegas_arriendos_facturacion_existencias.Creacion_fecha DESC 
		LIMIT 40";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			error_log("========================================================================================================================================", 0);
			error_log("Usuario: ". $NombreUsr, 0);
			error_log("Transaccion: ". $Transaccion, 0);
			error_log("-------------------------------------------------------------------", 0);
			error_log("Error code: ". mysqli_errno($dbConn), 0);
			error_log("Error description: ". mysqli_error($dbConn), 0);
			error_log("Error query: ". $query, 0);
			error_log("-------------------------------------------------------------------", 0);
							
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrProducto,$row );
		}
    break;
    /********************************************************/
    //Servicios
    case 4:
        // Se trae un listado de los valores
		$query = "SELECT
		bodegas_servicios_facturacion_existencias.ValorTotal AS Precio,
		bodegas_servicios_facturacion_existencias.Creacion_fecha,
		servicios_listado.Nombre AS Producto,
		proveedor_listado.Nombre AS Proveedor

		FROM `bodegas_servicios_facturacion_existencias`
		LEFT JOIN bodegas_servicios_facturacion    ON bodegas_servicios_facturacion.idFacturacion    = bodegas_servicios_facturacion_existencias.idFacturacion
		LEFT JOIN servicios_listado                ON servicios_listado.idServicio                   = bodegas_servicios_facturacion_existencias.idServicio
		LEFT JOIN proveedor_listado                ON proveedor_listado.idProveedor                  = bodegas_servicios_facturacion_existencias.idProveedor

		WHERE bodegas_servicios_facturacion_existencias.idServicio={$_GET['view']}
		AND bodegas_servicios_facturacion.idTipo = 1 
		ORDER BY bodegas_servicios_facturacion_existencias.Creacion_fecha DESC 
		LIMIT 40";
		//Consulta
		$resultado = mysqli_query ($dbConn, $query);
		//Si ejecuto correctamente la consulta
		if(!$resultado){
			
			//variables
			$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
			$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

			//generar log
			error_log("========================================================================================================================================", 0);
			error_log("Usuario: ". $NombreUsr, 0);
			error_log("Transaccion: ". $Transaccion, 0);
			error_log("-------------------------------------------------------------------", 0);
			error_log("Error code: ". mysqli_errno($dbConn), 0);
			error_log("Error description: ". mysqli_error($dbConn), 0);
			error_log("Error query: ". $query, 0);
			error_log("-------------------------------------------------------------------", 0);
							
		}
		while ( $row = mysqli_fetch_assoc ($resultado)) {
		array_push( $arrProducto,$row );
		}
    break;
}
///////////////////////////////////////////////
if(!empty($arrProducto)){?>

	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div>
				<h5>Variacion Precios de <?php echo $arrProducto[0]['Producto']; ?></h5>
			</header>
			<div id="div-3" class="tab-content">
				
					<div class="wmd-panel">
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						
						<div class="table-responsive">			
							<script>
								google.charts.load('current', {'packages':['corechart']});
								google.charts.setOnLoadCallback(drawChart);

								function drawChart() {
									var data = new google.visualization.DataTable();
									data.addColumn('string', 'Fecha'); 
									data.addColumn('number', 'Valor');
									data.addColumn({type: 'string', role: 'annotation'});
											
									data.addRows([
									<?php 
										foreach ($arrProducto as $prod) {
											$chain  = "'".Fecha_estandar($prod['Creacion_fecha'])."'";
											$chain .= ", ".$prod['Precio'];
											$chain .= ",'".valores($prod['Precio'], 0)."'";
													
											echo '['.$chain.'],';
										} 
									?>
									]);

									var options = {
										title: 'Variacion de precios',
										width: 900,
										height: 500,
												
										hAxis: { 
											title: 'Fecha',
										},
										vAxis: { title: 'Valor' },
										curveType: 'function',
										//puntos dentro de las curvas
										series: {
											0: {
												pointsVisible: true
											},
													 
										},
								
										annotations: {
													  alwaysOutside: true,
													  textStyle: {
														fontSize: 14,
														color: '#000',
														auraColor: 'none'
													  }
													},
										colors: ['#FFB347']
									};

									var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

									chart.draw(data, options);
								}

							</script> 
							<div id="curve_chart1" style="height: 500px"></div>
												
						</div>
						
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th width="120">Fecha</th>
										<th>Proveedor</th>
										<th width="120">Valor</th>
									</tr>
								</thead>
			  
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrProducto as $prod) { ?>
									
									<tr class="odd">
										<td><?php echo Fecha_estandar($prod['Creacion_fecha']); ?></td>
										<td><?php echo $prod['Proveedor']; ?></td>
										<td><?php echo valores($prod['Precio'], 0); ?></td>
									</tr>
								<?php } ?>                     
								</tbody>
							</table>
						</div>
					</div>

			</div>	
		</div>
	</div>

<?php }else{
	echo '<div class="col-sm-12" style="margin-top:15px;"><div class="alert alert-danger" role="alert">No existen datos</div></div>';
}?>

<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

		
	</body>
</html>
