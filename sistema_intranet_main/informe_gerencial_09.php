<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "informe_gerencial_09.php";
$location = $original;
//Se agregan ubicaciones
$location .='?filtro=true';			
       
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

             
  

//Se definen las variables
if(isset($_GET["Ano"])){   $Ano = $_GET["Ano"];   } else { $Ano  = ano_actual(); }
$Mes  = mes_actual();

//Solo compras pagadas totalmente
$z1 = "WHERE pagos_facturas_proveedores.idPago!=0";
$z2 = "WHERE pagos_facturas_clientes.idPago!=0";

if(isset($Ano)&&$Ano!=''){ 
	$z1.=" AND pagos_facturas_proveedores.F_Pago_ano={$Ano}";
	$z2.=" AND pagos_facturas_clientes.F_Pago_ano={$Ano}";
}
//arreglo con los meses
$meses=array(1=>"Enero", 
				"Febrero", 
				"Marzo", 
				"Abril", 
				"Mayo", 
				"Junio", 
				"Julio",
				"Agosto", 
				"Septiembre", 
				"Octubre", 
				"Noviembre", 
				"Diciembre"
			);
/*************************************************************************************************/
//Bodega de Productos
$arrTemporal_1 = array();
$query = "SELECT 
pagos_facturas_proveedores.idDocPago,
pagos_facturas_proveedores.F_Pago_ano,
pagos_facturas_proveedores.F_Pago_mes,
core_tiempo_meses.Nombre AS Mes,
SUM(pagos_facturas_proveedores.MontoPagado) AS Pagado
FROM `pagos_facturas_proveedores`
LEFT JOIN `core_tiempo_meses` ON core_tiempo_meses.idMes = pagos_facturas_proveedores.F_Pago_mes
".$z1."
GROUP BY pagos_facturas_proveedores.F_Pago_ano, pagos_facturas_proveedores.F_Pago_mes, pagos_facturas_proveedores.idDocPago";
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
array_push( $arrTemporal_1,$row );
} 
//Bodega de Insumos
$arrTemporal_2 = array();
$query = "SELECT 
pagos_facturas_clientes.idDocPago,
pagos_facturas_clientes.F_Pago_ano,
pagos_facturas_clientes.F_Pago_mes,
core_tiempo_meses.Nombre AS Mes,
SUM(pagos_facturas_clientes.MontoPagado) AS Pagado
FROM `pagos_facturas_clientes`
LEFT JOIN `core_tiempo_meses` ON core_tiempo_meses.idMes = pagos_facturas_clientes.F_Pago_mes
".$z2."
GROUP BY pagos_facturas_clientes.F_Pago_ano, pagos_facturas_clientes.F_Pago_mes, pagos_facturas_clientes.idDocPago";
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
array_push( $arrTemporal_2,$row );
} 
/*************************************************************/
//Listado de documentos
$arrDocumentos = array();
$query = "SELECT idDocPago, Nombre
FROM `sistema_documentos_pago`
ORDER BY idDocPago ASC";
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
array_push( $arrDocumentos,$row );
} 
/****************************************/
//Se crea arreglo
$arrEgreso = array();
for ($i = 1; $i <= 12; $i++) {
    $arrEgreso[$i]['Pagado'] = 0;
    //recorro los documentos
    foreach ($arrDocumentos as $doc) {
		$arrEgreso[$i][$doc['idDocPago']]['Pagado'] = 0;
	}
}
//recorro
foreach ($arrTemporal_1 as $temp) {
	$arrEgreso[$temp['F_Pago_mes']]['Pagado']                     = $arrEgreso[$temp['F_Pago_mes']]['Pagado'] + $temp['Pagado'];
	$arrEgreso[$temp['F_Pago_mes']][$temp['idDocPago']]['Pagado'] = $arrEgreso[$temp['F_Pago_mes']][$temp['idDocPago']]['Pagado'] + $temp['Pagado'];
}
/****************************************/
//Se crea arreglo
$arrIngreso = array();
for ($i = 1; $i <= 12; $i++) {
    $arrIngreso[$i]['Pagado'] = 0;
    //recorro los documentos
    foreach ($arrDocumentos as $doc) {
		$arrIngreso[$i][$doc['idDocPago']]['Pagado'] = 0;
	}
}
//recorro
foreach ($arrTemporal_2 as $temp) {
	$arrIngreso[$temp['F_Pago_mes']]['Pagado']                     = $arrIngreso[$temp['F_Pago_mes']]['Pagado'] + $temp['Pagado'];
	$arrIngreso[$temp['F_Pago_mes']][$temp['idDocPago']]['Pagado'] = $arrIngreso[$temp['F_Pago_mes']][$temp['idDocPago']]['Pagado'] + $temp['Pagado'];
}



?>



<div class="col-sm-12">
	<div class="">	
		<div id="calendar_content" class="body">
			<div id="calendar" class="fc fc-ltr">
				<table class="fc-header" style="width:100%">
					<tbody>
						<tr>
							<?php
							if(isset($_GET["Ano"])){
								$Ano_a  = $_GET["Ano"] - 1;
								$Ano_b  = $_GET["Ano"] + 1;	
							} else {
								$Ano_a  = ano_actual() - 1;
								$Ano_b  = ano_actual() + 1;
							}
							?>
							<td class="fc-header-left"><a href="<?php echo '?Ano='.$Ano_a ?>" class="btn btn-default">‹</a></td>
							<td class="fc-header-center"><span class="fc-header-title"><h2>Flujo de Caja <?php echo $Ano?></h2></span></td>
							<td class="fc-header-right"><a href="<?php echo '?Ano='.$Ano_b ?>" class="btn btn-default">›</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">google.charts.load('current', {'packages':['bar', 'corechart', 'table']});</script>	


<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#tab1" data-toggle="tab">Resumen</a></li>
				<li class=""><a href="#tab2" data-toggle="tab">Egreso</a></li>
				<li class=""><a href="#tab3" data-toggle="tab">Ingreso</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="tab1">
				<div class="wmd-panel">
					<div class="table-responsive">
									
						<script>
							
							google.charts.setOnLoadCallback(drawChart0);

							function drawChart0() {
								 var data = google.visualization.arrayToDataTable([
								  ['Mes', 'Ingresos', 'Egresos'],
								  ['Ene',  <?php echo $arrIngreso[1]['Pagado']; ?>,  <?php echo $arrEgreso[1]['Pagado']; ?>],
								  ['Feb',  <?php echo $arrIngreso[2]['Pagado']; ?>,  <?php echo $arrEgreso[2]['Pagado']; ?>],
								  ['Mar',  <?php echo $arrIngreso[3]['Pagado']; ?>,  <?php echo $arrEgreso[3]['Pagado']; ?>],
								  ['Abr',  <?php echo $arrIngreso[4]['Pagado']; ?>,  <?php echo $arrEgreso[4]['Pagado']; ?>],
								  ['May',  <?php echo $arrIngreso[5]['Pagado']; ?>,  <?php echo $arrEgreso[5]['Pagado']; ?>],
								  ['Jun',  <?php echo $arrIngreso[6]['Pagado']; ?>,  <?php echo $arrEgreso[6]['Pagado']; ?>],
								  ['Jul',  <?php echo $arrIngreso[7]['Pagado']; ?>,  <?php echo $arrEgreso[7]['Pagado']; ?>],
								  ['Ago',  <?php echo $arrIngreso[8]['Pagado']; ?>,  <?php echo $arrEgreso[8]['Pagado']; ?>],
								  ['Sep',  <?php echo $arrIngreso[9]['Pagado']; ?>,  <?php echo $arrEgreso[9]['Pagado']; ?>],
								  ['Oct',  <?php echo $arrIngreso[10]['Pagado']; ?>,  <?php echo $arrEgreso[10]['Pagado']; ?>],
								  ['Nov',  <?php echo $arrIngreso[11]['Pagado']; ?>,  <?php echo $arrEgreso[11]['Pagado']; ?>],
								  ['Dic',  <?php echo $arrIngreso[12]['Pagado']; ?>,  <?php echo $arrEgreso[12]['Pagado']; ?>],
								]);


    
								var options = {
								  title: 'Flujo de caja',
								  hAxis: {title: 'Mes',  titleTextStyle: {color: '#333'}},
								  vAxis: {minValue: 0}
								};

								var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
								chart.draw(data, options);
								var table_1 = new google.visualization.Table(document.getElementById('table_div_1'));
								table_1.draw(data, {showRowNumber: true, width: '100%', height: '100%'});	

							}
						</script> 
						<div id="chart_div" style="height: 500px; width: 100%;"></div>
						<div id="table_div_1" ></div>		
						
					</div>
				</div>
			</div>
			
		
			<div class="tab-pane fade" id="tab2">
				<div class="wmd-panel">
					<div class="table-responsive">
									
						<script>
								
							google.charts.setOnLoadCallback(drawChart1);

							function drawChart1() {
								
								
								var data = new google.visualization.DataTable();
								  data.addColumn('string', 'Meses');
								  <?php foreach ($arrDocumentos as $doc) { ?>
									data.addColumn('number', '<?php echo $doc['Nombre']; ?>');
								  <?php } ?>

								  data.addRows([
									<?php for ($i = 1; $i <= 12; $i++) { ?>
										['<?php echo numero_a_mes_c($i); ?>'
										<?php foreach ($arrDocumentos as $doc) { ?>
											, <?php echo $arrEgreso[$i][$doc['idDocPago']]['Pagado']; ?>
										<?php } ?>
										],
									<?php } ?>
									
								  ]);

								  var options = {
									title: 'Egresos',
									isStacked: true,
									hAxis: {
									  title: '',
									},
									vAxis: {
									  title: 'Montos $'
									}
								  };

								  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_2'));
								  chart.draw(data, options);		
								  var table_2 = new google.visualization.Table(document.getElementById('table_div_2'));
								  table_2.draw(data, {showRowNumber: true, width: '100%', height: '100%'});	
							}
						</script> 
						<div id="chart_div_2" style="height: 500px; width: 100%;"></div>
						<div id="table_div_2" ></div>		
							
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="tab3">
				<div class="wmd-panel">
					<div class="table-responsive">
									
						<script>
								
							google.charts.setOnLoadCallback(drawChart2);

							function drawChart2() {
								
								
								var data = new google.visualization.DataTable();
								  data.addColumn('string', 'Meses');
								  <?php foreach ($arrDocumentos as $doc) { ?>
									data.addColumn('number', '<?php echo $doc['Nombre']; ?>');
								  <?php } ?>

								  data.addRows([
									<?php for ($i = 1; $i <= 12; $i++) { ?>
										['<?php echo numero_a_mes_c($i); ?>'
										<?php foreach ($arrDocumentos as $doc) { ?>
											, <?php echo $arrIngreso[$i][$doc['idDocPago']]['Pagado']; ?>
										<?php } ?>
										],
									<?php } ?>
									
								  ]);

								  var options = {
									title: 'Ingresos',
									isStacked: true,
									hAxis: {
									  title: '',
									},
									vAxis: {
									  title: 'Montos $'
									}
								  };

								  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_3'));
								  chart.draw(data, options);
								  var table_3 = new google.visualization.Table(document.getElementById('table_div_3'));
								  table_3.draw(data, {showRowNumber: true, width: '100%', height: '100%'});		
									
							}
						</script> 
						<div id="chart_div_3" style="height: 500px; width: 100%;"></div>
						<div id="table_div_3" ></div>	
							
					</div>
				</div>
			</div>
			

			
        </div>	
	</div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
