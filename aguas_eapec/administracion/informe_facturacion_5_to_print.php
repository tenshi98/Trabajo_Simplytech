<?php
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
// Se trae un listado con todos los datos
$arrFacturacion = array();
$query = "SELECT
Ano AS anoActual, 
idMes AS mesActual,
 
COUNT(idFacturacionDetalle) AS nClientes,
SUM(DetalleConsumoCantidad) AS M3Consumidos,

SUM(DetalleSubtotalServicio) AS DetalleSubtotalServicio,
SUM(DetalleInteresDeuda) AS DetalleInteresDeuda,
SUM(DetalleSaldoFavor) AS DetalleSaldoFavor,
SUM(DetalleTotalVenta) AS DetalleTotalVenta,
SUM(DetalleSaldoAnterior) AS SaldoAnterior,
SUM(DetalleOtrosCargos1Valor) AS OtrosCargos1,
SUM(DetalleOtrosCargos2Valor) AS OtrosCargos2,
SUM(DetalleOtrosCargos3Valor) AS OtrosCargos3,
SUM(DetalleOtrosCargos4Valor) AS OtrosCargos4,
SUM(DetalleOtrosCargos5Valor) AS OtrosCargos5,
SUM(DetalleTotalAPagar) AS TotalAPagar,

(SELECT SUM(montoPago) AS Pagos FROM `clientes_pago` WHERE AnoPago = anoActual AND idMesPago = mesActual ) AS PagoReal,

(SELECT COUNT(idFacturacionDetalle) AS Pagos FROM `facturacion_listado_detalle` WHERE Ano = anoActual AND idMes = mesActual AND idEstado = 1 ) AS ClientesImp_N,
(SELECT SUM(DetalleTotalVenta) AS Pagos FROM `facturacion_listado_detalle` WHERE Ano = anoActual AND idMes = mesActual AND idEstado = 1 ) AS ClientesImp_Val,

SUM(montoPago) AS PagoTotal

FROM `facturacion_listado_detalle`
WHERE  facturacion_listado_detalle.Fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'
GROUP BY anoActual, mesActual
ORDER BY anoActual ASC, mesActual ASC

";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
} ?>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Imprimir</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<!-- Bootstrap -->
		<link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/lib/font-awesome-animation/font-awesome-animation.min.css">
		<!-- Metis core stylesheet -->
		<link rel="stylesheet" href="assets/css/main.min.css">
		<!-- Metis Theme stylesheet -->
		<link rel="stylesheet" href="assets/lib/fullcalendar/fullcalendar.css">
		<!-- Estilo definido por mi -->
		<link href="assets/css/my_style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/my_colors.css" rel="stylesheet" type="text/css">
		<link href="assets/css/my_corrections.css" rel="stylesheet" type="text/css">
		<style>
		body{background-color:#fff;}
		.invoice, .well, .page-header, th, tr, td {border: none !important;}
		.well { box-shadow: none !important;}
		body, .invoice .page-header, th, tr, td {font-family: Times New Roman !important;font-size: 12px !important;color: #333 !important;font-style: normal !important;}
		.table > tbody > tr > td, .table > tfoot > tr > td {padding: 2px !important;}
		small, .small { font-size: 100% !important; }
		.table .tright{text-align: right !important;}
		.table .tcenter{text-align: center !important;}
		
		.invoice {
			padding-left: 0px !important;
			padding-rigth: 0px !important;
			padding-bottom: 0px !important;
			margin-bottom: 0px !important;
			margin: 10px 0px !important;
		}
		.invoice {
			position: relative !important;
		}
		.invoice-info{
			position: absolute !important;
			top: 80px !important;
			right: 0 !important;
			width: 100% !important;
		}
		.invoice-detalis{
			background-color: #fff !important;
			position: absolute !important;
			top: 200px !important;
			right: 0 !important;
		}
		.invoice-footer{
			position: absolute !important;
			top: 480px !important;
			right: 0 !important;
			
		}
		.invoice-footer .footer-left{
			padding-left: 0px; padding-right: 20px; padding-top:10px;
		}
		.invoice-footer .footer-right{
			background-color: #fff;
		}

		</style>
	</head>

	<body>
		
		<div class="col-lg-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div>
					<h5> Resumen </h5>
				</header>
				<div class="table-responsive"> 
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Mes</th>
								<th>N° Clientes</th>
								<th>M3 Consumidos</th>
								<th class="active">Total Servicio</th>
								<th class="active">Intereses</th>
								<th class="active">Otros Cargos</th>
								<th class="active">Total Venta</th>
								<th class="info">Pagos del mes</th>
								<th class="info">Saldo</th>
							</tr>
						</thead>



						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php 
						//Variables
						$x1 = 0;
						$x2 = 0;
						$x3 = 0;
						$x4 = 0;
						$x5 = 0;
						$x6 = 0;
						$x7 = 0;
						$x8 = 0;
						$x9 = 0;
						
						$rev = 0;
						//Se recorre la tabla
						foreach ($arrFacturacion as $fact) {  
							$OtrosCargos = $fact['OtrosCargos1'] + $fact['OtrosCargos2'] + $fact['OtrosCargos3'] + $fact['OtrosCargos4'] + $fact['OtrosCargos5'];
							//
							$rev = $rev + ($fact['DetalleTotalVenta']-$fact['PagoReal']);
							
							?>

							<tr class="odd">
								<td><?php echo numero_mes2($fact['mesActual']).' '.$fact['anoActual']; ?></td>
								<td><?php echo $fact['nClientes']; ?></td>
								<td><?php echo $fact['M3Consumidos'].' M3'; ?></td>
								
								<td class="active"><?php echo Valores($fact['DetalleSubtotalServicio'], 0); ?></td>
								<td class="active"><?php echo Valores($fact['DetalleInteresDeuda'], 0); ?></td>
								<td class="active"><?php echo Valores($OtrosCargos, 0); ?></td>
								<td class="active"><?php echo Valores($fact['DetalleTotalVenta'], 0); ?></td>
								<td class="info"><?php echo Valores($fact['PagoReal'], 0); ?></td>
								<td class="info"><?php echo Valores($rev, 0); ?></td>
								
								
							</tr>
						<?php 
							//Se suman totales
							$x1 = $x1 + $fact['M3Consumidos'];
							$x2 = $x2 + $fact['DetalleSubtotalServicio'];
							$x3 = $x3 + $fact['DetalleInteresDeuda'];
							$x4 = $x4 + $OtrosCargos;
							$x5 = $x5 + $fact['DetalleTotalVenta'];
							$x6 = $x6 + $fact['PagoReal'];
							$x7 = $x7 + $fact['SaldoAnterior'];
							$x8 = $x8 + $fact['TotalAPagar'];
							$x9 = $x9 + $fact['PagoTotal'];
						} ?>
							<tr class="odd">
								<td colspan="9"></td>
							</tr>
							<tr class="odd">
								<td><strong>TOTALES</strong></td>
								<td></td>
								<td><strong><?php echo $x1.' M3'; ?></strong></td>
								
								<td class="active"><strong><?php echo Valores($x2, 0); ?></strong></td>
								<td class="active"><strong><?php echo Valores($x3, 0); ?></strong></td>
								<td class="active"><strong><?php echo Valores($x4, 0); ?></strong></td>
								<td class="active"><strong><?php echo Valores($x5, 0); ?></strong></td>
								<td class="info"><strong><?php echo Valores($x6, 0); ?></strong></td>
								<td class="info"><strong><?php echo Valores($x5 - $x6, 0); ?></strong></td>

							</tr> 	
						</tbody>
					</table>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<div class="col-lg-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div>
					<h5> Graficos </h5>
					
				</header>
				<div class="table-responsive">
					
					
					<script>
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawChart);

						function drawChart() {
							var data = new google.visualization.DataTable();
							data.addColumn('string', 'Fecha'); 
							data.addColumn('number', 'Total Venta'); 
							data.addColumn('number', 'Pagos del mes'); 
							data.addColumn({type: 'string', role: 'annotation'});
							data.addRows([
							<?php foreach ($arrFacturacion as $fac) { ?>
								['<?php echo numero_a_mes($fac['mesActual']).' '.$fac['anoActual']; ?>',  <?php echo $fac['DetalleTotalVenta']; ?>,   <?php echo $fac['PagoReal']; ?>,  '<?php echo porcentaje($fac['PagoReal'] / $fac['DetalleTotalVenta']); ?>'],
							<?php } ?>
							  
							]);

							var options = {
								title: 'Grafico Ventas vs Pagos',
								hAxis: { title: 'Meses', },
								vAxis: { title: 'Montos' },
								curveType: 'function',
								annotations: {
											  alwaysOutside: true,
											  textStyle: {
												fontSize: 14,
												color: '#000',
												auraColor: 'none'
											  }
											},
							};

							var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));
							
							// Wait for the chart to finish drawing before calling the getImageURI() method.
							google.visualization.events.addListener(chart, 'ready', function () {
								curve_chart1.innerHTML = '<img src="' + chart.getImageURI() + '">';
								console.log(curve_chart1.innerHTML);
							});
					  
							chart.draw(data, options);
						}

					</script> 
					<div id="curve_chart1" style="height: 500px"></div>

					
					
					
					<script>
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawChart);

						function drawChart() {
							var data = new google.visualization.DataTable();
							data.addColumn('string', 'Fecha'); // Implicit domain label col.
							data.addColumn('number', 'Metros Cubicos'); // Implicit series 1 data col.
							data.addColumn({type: 'string', role: 'annotation'});
							data.addRows([
							<?php foreach ($arrFacturacion as $fac) { ?>
								['<?php echo numero_a_mes($fac['mesActual']).' '.$fac['anoActual']; ?>',  <?php echo $fac['M3Consumidos']; ?>,  '<?php echo $fac['M3Consumidos']; ?>'],
							<?php } ?>
							  
							]);

							var options = {
								title: 'Consumos Metros Cubicos',
								hAxis: { title: 'Meses', },
								vAxis: { title: 'Cantidad Metros Cubicos' },
								curveType: 'function',
								annotations: {
											  alwaysOutside: true,
											  textStyle: {
												fontSize: 14,
												color: '#000',
												auraColor: 'none'
											  }
											},
							};

							var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
							
							// Wait for the chart to finish drawing before calling the getImageURI() method.
							google.visualization.events.addListener(chart, 'ready', function () {
								curve_chart.innerHTML = '<img src="' + chart.getImageURI() + '">';
								console.log(curve_chart.innerHTML);
							});
							
							chart.draw(data, options);
						}

					</script> 
					<div id="curve_chart" style="height: 500px"></div>
					
					
					
					
					
					
						
								
								
				</div>
			</div>
		</div>

		
	</body>
</html>
