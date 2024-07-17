<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "informe_facturacion_5.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit_filter']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'f_inicio,f_termino';
	$form_trabajo= 'filtro_por_fechas';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_filtros.php';
}
?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
				<?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
	
// Se trae un listado con todos los usuarios
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
} 




?>
 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5> Resumen </h5>
			<div class="toolbar">
				<?php
				$zz  = '?idSistema='.$arrUsuario['idSistema'];
				$zz .= '&f_inicio='.$_GET['f_inicio'];
				$zz .= '&f_termino='.$_GET['f_termino'];
				?>
				<a target="new" href="informe_facturacion_5_to_print.php<?php echo $zz ?>" class="btn btn-sm btn-metis-5"><i class="fa fa-print"></i> Imprimir</a>
			</div>
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

					chart.draw(data, options);
				}

			</script> 
			<div id="curve_chart" style="height: 500px"></div>
			
			
			
			
			
			
				
						
						
		</div>
	</div>
</div>




 
  
  
  
  
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal"  name="form1" action="<?php echo $location; ?>">
			
				<?php 
				//Se verifican si existen los datos
				if(isset($f_inicio)) {       $x1  = $f_inicio;     }else{$x1  = '';}
				if(isset($f_termino)) {      $x2  = $f_termino;    }else{$x2  = '';}
				

				//se dibujan los inputs
				echo form_date('Fecha Inicio Periodo','f_inicio', $x1, 2);
				echo form_date('Fecha Termino Periodo','f_termino', $x2, 2);
				
						
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width" value="Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
                    
		</div>
	</div>
</div> 
<?php } ?>
<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
