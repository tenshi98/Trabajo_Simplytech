<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Print.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
// Se trae un listado con todos los productos
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

(SELECT SUM(montoPago) AS Pagos FROM `aguas_clientes_pago` WHERE AnoPago = anoActual AND idMesPago = mesActual ) AS PagoReal,

(SELECT COUNT(idFacturacionDetalle) AS Pagos FROM `aguas_facturacion_listado_detalle` WHERE Ano = anoActual AND idMes = mesActual AND idEstado = 1 ) AS ClientesImp_N,
(SELECT SUM(DetalleTotalVenta) AS Pagos FROM `aguas_facturacion_listado_detalle` WHERE Ano = anoActual AND idMes = mesActual AND idEstado = 1 ) AS ClientesImp_Val,

SUM(montoPago) AS PagoTotal

FROM `aguas_facturacion_listado_detalle`
WHERE  aguas_facturacion_listado_detalle.Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'
GROUP BY anoActual, mesActual
ORDER BY anoActual ASC, mesActual ASC

";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.PrintFact.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Resumen</h5>
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
						$rev = $rev + ($fact['DetalleTotalVenta']-$fact['PagoReal']); ?>

						<tr class="odd">
							<td><?php echo numero_a_mes($fact['mesActual']).' '.$fact['anoActual']; ?></td>
							<td><?php echo $fact['nClientes']; ?></td>
							<td><?php echo $fact['M3Consumidos'].' M3'; ?></td>
							
							<td align="right" class="active"><?php echo Valores($fact['DetalleSubtotalServicio'], 0); ?></td>
							<td align="right" class="active"><?php echo Valores($fact['DetalleInteresDeuda'], 0); ?></td>
							<td align="right" class="active"><?php echo Valores($OtrosCargos, 0); ?></td>
							<td align="right" class="active"><?php echo Valores($fact['DetalleTotalVenta'], 0); ?></td>
							<td align="right" class="info"><?php echo Valores($fact['PagoReal'], 0); ?></td>
							<td align="right" class="info"><?php echo Valores($rev, 0); ?></td>
							
							
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
						
						<td align="right" class="active"><strong><?php echo Valores($x2, 0); ?></strong></td>
						<td align="right" class="active"><strong><?php echo Valores($x3, 0); ?></strong></td>
						<td align="right" class="active"><strong><?php echo Valores($x4, 0); ?></strong></td>
						<td align="right" class="active"><strong><?php echo Valores($x5, 0); ?></strong></td>
						<td align="right" class="info"><strong><?php echo Valores($x6, 0); ?></strong></td>
						<td align="right" class="info"><strong><?php echo Valores($x5 - $x6, 0); ?></strong></td>

					</tr> 
					                 
				</tbody>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">google.charts.load('current', {'packages':['corechart']});</script>
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5> Graficos </h5>
			
		</header>
		<div class="table-responsive">
			<script>

				google.charts.setOnLoadCallback(drawChart_1);

				function drawChart_1() {
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

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart_1'));

					chart.draw(data, options);
				}

			
				google.charts.setOnLoadCallback(drawChart_2);

				function drawChart_2() {
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

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart_2'));

					chart.draw(data, options);
				}

			</script> 
			<div id="curve_chart_1" style="height: 500px"></div>
			<div id="curve_chart_2" style="height: 500px"></div>
			
		</div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';
?>
