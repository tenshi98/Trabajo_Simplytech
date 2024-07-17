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




//Se traen todos los datos
$query = "SELECT 
 
ClienteNombre,ClienteDireccion,ClienteIdentificador,ClienteNombreComuna,ClienteFechaVencimiento,ClienteEstado,
							
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
							
DetConsMesAnteriorCantidad,DetConsMesAnteriorFecha,
DetConsMesActualCantidad,DetConsMesActualFecha,
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

core_sistemas.Nombre AS SistemaNombre,
core_sistemas.Rubro AS SistemaRubro,
core_sistemas.Rut AS SistemaRut,
core_sistemas.Direccion AS SistemaDireccion,
core_sistemas.Comuna AS SistemaComuna,
core_sistemas.Ciudad AS SistemaCiudad,
core_sistemas.Fono AS SistemaFono,
core_sistemas.NdiasPago,

clientes_facturable.Nombre AS DocFacturable,
SII_NDoc,
core_sistemas_rubro.Nombre AS Rubro,
clientes_listado.Rut AS ClienteRut,
clientes_listado.Giro AS ClienteGiro,
clientes_listado.Fono1 AS ClienteFono1,
clientes_listado.Fono2 AS ClienteFono2,
mnt_ubicacion_comunas.Nombre AS ClienteComunaFact,
clientes_listado.DireccionFact AS ClienteDireccionFact,
clientes_listado.UnidadHabitacional AS ClienteUH



FROM `facturacion_listado_detalle`
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema             = facturacion_listado_detalle.idSistema
LEFT JOIN `core_sistemas_rubro`       ON core_sistemas_rubro.idRubro         = core_sistemas.idRubro
LEFT JOIN `clientes_facturable`       ON clientes_facturable.idFacturable    = facturacion_listado_detalle.SII_idFacturable
LEFT JOIN `clientes_listado`          ON clientes_listado.idCliente          = facturacion_listado_detalle.idCliente
LEFT JOIN `mnt_ubicacion_comunas`     ON mnt_ubicacion_comunas.idComuna      = clientes_listado.idComunaFact



WHERE idFacturacionDetalle = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowDatos = mysqli_fetch_assoc ($resultado);


				
?>
<html class="no-js">
	<head>
		<meta charset="UTF-8">
		<title>Aguas</title>    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/lib/font-awesome-animation/font-awesome-animation.min.css">
		<!-- Metis core stylesheet -->
		<link rel="stylesheet" href="assets/css/main.min.css">
		<!-- Metis Theme stylesheet -->
		<link rel="stylesheet" href="assets/css/theme_color_0.css">
		<link rel="stylesheet" href="assets/lib/fullcalendar/fullcalendar.css">
		<!-- Estilo definido por mi -->
		<link href="assets/css/my_style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/my_colors.css" rel="stylesheet" type="text/css">
		<link href="assets/css/my_corrections.css" rel="stylesheet" type="text/css">
		<script src="assets/js/personel.js"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="assets/lib/html5shiv/html5shiv.js"></script>
			<script src="assets/lib/respond/respond.min.js"></script>
			<![endif]-->
		<!--Modulos de javascript-->
		<script type="text/javascript" src="assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
		<!-- Icono de la pagina -->
		<link rel="icon" type="image/png" href="img/mifavicon.png" />
		<style>
		body {
			background-color: #fff !important;
		}
		.invoice {
			margin: 0px !important;
		}
		@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
		body, h1, h2, h3, h4, h5, h6{
		  font-family: 'Bree Serif', serif;
		}
		.panel-heading {
			padding: 1px 10px !important;
		}
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
			padding: 4px !important;
		}
		
		body, body .table, body .table h4{
			font-size: 12px !important;
		}
		body .table h4 {
			margin-top: 1px !important;
			margin-bottom: 1px !important;
		}
		h1 {
			margin-top: 5px !important;
			margin-bottom: 5px !important;
		}
		h4, .h4 {
			font-size: 16px !important;
			margin-top: 3px !important;
			margin-bottom: 3px !important;
		}
		.panel-body {
			padding: 5px !important;
		}
		</style>
	</head>
 

	<body onload="window.print();">

	  
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12 text-right">
					<h1><?php echo $rowDatos['DocFacturable'] ?> <small><?php echo N_Doc($rowDatos['SII_NDoc'], 7) ?></small></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><a href="#"><?php echo $rowDatos['SistemaNombre']?></a></h4>
						</div>
						<div class="panel-body">
							<p>
								<?php echo 'R.U.T.: '.$rowDatos['SistemaRut']?><br>
								<?php echo $rowDatos['Rubro']?><br>
								<?php echo $rowDatos['SistemaDireccion'].' '.$rowDatos['SistemaComuna'].' '.$rowDatos['SistemaCiudad']; ?><br>
								<?php echo 'Telefono: '.$rowDatos['SistemaFono']?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Cliente : <a href="#"><?php echo $rowDatos['ClienteIdentificador']?></a></h4>
						</div>
						<div class="panel-body">
							<p>
								<?php if(isset($rowDatos['ClienteRut'])&&$rowDatos['ClienteRut']!=''){                     echo 'R.U.T.: '.$rowDatos['ClienteRut'].'<br/>';} ?> 
								<?php if(isset($rowDatos['ClienteGiro'])&&$rowDatos['ClienteGiro']!=''){                   echo 'Rubro: '.$rowDatos['ClienteGiro'].'<br/>';} ?> 
								<?php if(isset($rowDatos['ClienteDireccionFact'])&&$rowDatos['ClienteDireccionFact']!=''){ echo 'Direccion: '.$rowDatos['ClienteDireccionFact'].'<br/>';} ?> 
								<?php if(isset($rowDatos['ClienteComunaFact'])&&$rowDatos['ClienteComunaFact']!=''){       echo 'Comuna: '.$rowDatos['ClienteComunaFact'].'<br/>';} ?> 
								<?php if(isset($rowDatos['ClienteFono1'])&&$rowDatos['ClienteFono1']!=''){                 echo 'Telefono Fijo: '.$rowDatos['ClienteFono1'].'<br/>';} ?> 
								<?php if(isset($rowDatos['ClienteFono2'])&&$rowDatos['ClienteFono2']!=''){                 echo 'Telefono Movil: '.$rowDatos['ClienteFono2'].'<br/>';} ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- / end client details section -->
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><h4>Detalle Cuenta</h4></th>
						<th width="100px"><h4>Cantidad</h4></th>
						<th width="100px" class="text-right"><h4>Total Item</h4></th>
					</tr>
				</thead>
				<tbody>
					<?php
						//verificacion de remarcador
						if(isset($rowDatos['DetConsProrateo'])&&$rowDatos['DetConsProrateo']!=''&&$rowDatos['DetConsProrateo']!=0){
							$ndecim = 2;
						}else{
							$ndecim = 0;	
						}
					?>
								
					<tr>
						<td>Cargo Fijo Cliente</td>
						<td class="text-right"><?php echo $rowDatos['ClienteUH'];?></td>
						<td class="text-right"><?php echo Valores($rowDatos['DetalleCargoFijoValor'], 0);?></td>	
					</tr>
					<tr>
						<td>Consumo Agua Potable</td>
						<td class="text-right"><?php echo Cantidades($rowDatos['DetalleConsumoCantidad'], $ndecim);?></td>
						<td class="text-right"><?php echo Valores($rowDatos['DetalleConsumoValor'], 0);?></td>	
					</tr>
					<tr>
						<td>Recoleccion de Aguas Servidas</td>
						<td class="text-right"><?php echo Cantidades($rowDatos['DetalleRecoleccionCantidad'], $ndecim);?></td>
						<td class="text-right"><?php echo Valores($rowDatos['DetalleRecoleccionValor'], 0);?></td>	
					</tr>
					<?php if(isset($rowDatos['DetalleVisitaCorte'])&&$rowDatos['DetalleVisitaCorte']!=0){ ?>
						<tr>
							<td>Visita Corte</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleVisitaCorte'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleCorte1Valor'])&&$rowDatos['DetalleCorte1Valor']!=0){ ?>
						<tr>
							<td>Corte 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte1Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleCorte1Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleCorte2Valor'])&&$rowDatos['DetalleCorte2Valor']!=0){ ?>
						<tr>
							<td>Corte 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte2Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleCorte2Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleReposicion1Valor'])&&$rowDatos['DetalleReposicion1Valor']!=0){ ?>
						<tr>
							<td>Reposicion 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion1Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleReposicion1Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleReposicion2Valor'])&&$rowDatos['DetalleReposicion2Valor']!=0){ ?>
						<tr>
							<td>Reposicion 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion2Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleReposicion2Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<tr>
						<td colspan="2"><strong>SUBTOTAL SERVICIO</strong></td>
						<td class="text-right"><strong><?php echo Valores($rowDatos['DetalleSubtotalServicio'], 0); ?></strong></td>
					</tr>
					<?php if(isset($rowDatos['DetalleInteresDeuda'])&&$rowDatos['DetalleInteresDeuda']!=0){ ?>
						<tr>
							<td>Interes Deuda</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleInteresDeuda'], 0)?></td>	
						</tr>
					<?php } ?>
					
					<?php 
					//Otros Cargos 1
					if(isset($rowDatos['DetalleOtrosCargos1Valor'])&&$rowDatos['DetalleOtrosCargos1Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos1Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos1Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleOtrosCargos1Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 2
					if(isset($rowDatos['DetalleOtrosCargos2Valor'])&&$rowDatos['DetalleOtrosCargos2Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos2Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos2Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleOtrosCargos2Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 3
					if(isset($rowDatos['DetalleOtrosCargos3Valor'])&&$rowDatos['DetalleOtrosCargos3Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos3Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos3Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleOtrosCargos3Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 4
					if(isset($rowDatos['DetalleOtrosCargos4Valor'])&&$rowDatos['DetalleOtrosCargos4Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos4Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos4Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleOtrosCargos4Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 5
					if(isset($rowDatos['DetalleOtrosCargos5Valor'])&&$rowDatos['DetalleOtrosCargos5Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos5Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos5Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleOtrosCargos5Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<tr>
						<td colspan="2"><strong>TOTAL VENTA</strong></td>
						<td class="text-right"><strong><?php echo Valores($rowDatos['DetalleTotalVenta'], 0); ?></strong></td>
					</tr>
					<?php 
					//variable exento
					$Exento = 0;
					if(isset($rowDatos['DetalleSaldoFavor'])&&$rowDatos['DetalleSaldoFavor']!=0){ 
						$Exento = $Exento - $rowDatos['DetalleSaldoFavor']; ?>
						<tr>
							<td>Saldo a Favor</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo '(-) '.Valores($rowDatos['DetalleSaldoFavor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleSaldoAnterior'])&&$rowDatos['DetalleSaldoAnterior']!=0){ 
						$Exento = $Exento + $rowDatos['DetalleSaldoAnterior']; ?>
						<tr>
							<td>Saldo Anterior</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo '(+) '.Valores($rowDatos['DetalleSaldoAnterior'], 0)?></td>	
						</tr>
					<?php } ?>
					
					
					
				</tbody>
			</table>
			<div class="row text-right" style="margin-top:20px;">
				<div class="col-xs-2 col-xs-offset-8">
					<p>
						<strong>
							TOTAL VENTA : <br>
							EXENTOS : <br>
							TOTAL : <br>
						</strong>
					</p>
				</div>
				<div class="col-xs-2">
					<strong>
						<?php 
						if($rowDatos['DetalleTotalVenta']>0){
							echo Valores($rowDatos['DetalleTotalVenta'], 0).'<br>';
							echo Valores($Exento, 0).'<br>'; 
							echo Valores($rowDatos['DetalleTotalAPagar'], 0).'<br>'; 
						}else{
							echo Valores(0, 0).'<br>';
							echo Valores(0, 0).'<br>';
							echo Valores(0, 0).'<br>';
						}
						?>
					</strong>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-6">
					<div class="row">
						<div class="col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Consumo Ultimos Meses</h4>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-6">
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes1Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes1Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes2Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes2Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes3Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes3Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes4Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes4Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes5Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes5Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes6Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes6Valor'], 2); ?> m3</small> <br/> 
											<div class="clearfix"></div>
										</div>
										<div class="col-xs-6">
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes7Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes7Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes8Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes8Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes9Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes9Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes10Fecha']); ?></div>  <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes10Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes11Fecha']); ?></div>  <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes11Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($rowDatos['GraficoMes12Fecha']); ?></div>  <small class="pull-right"><?php echo Cantidades($rowDatos['GraficoMes12Valor'], 2); ?> m3</small> 
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Detalle de Consumo</h4>
								</div>
								<div class="panel-body">
									<p>
										<?php 
										if(isset($rowDatos['DetConsMesAnteriorFecha'])&&$rowDatos['DetConsMesAnteriorFecha']!='0000-00-00'&&$rowDatos['DetConsMesAnteriorFecha']!=''){
											$mes_anterior = Fecha_estandar($rowDatos['DetConsMesAnteriorFecha']);
										}else{
											$mes_anterior = 'Sin datos';
										}?>
										<div class="pull-left">Lectura Mes anterior <?php echo '('.$mes_anterior.')'; ?></div>
										<small class="pull-right"><?php echo valores_truncados($rowDatos['DetConsMesAnteriorCantidad']) ?> m3</small>
										
										<br/>
										<?php 
										if(isset($rowDatos['DetConsMesActualFecha'])&&$rowDatos['DetConsMesActualFecha']!='0000-00-00'&&$rowDatos['DetConsMesActualFecha']!=''){
											$mes_actual = Fecha_estandar($rowDatos['DetConsMesActualFecha']);
										}else{
											$mes_actual = 'Sin datos';
										}?>
										<div class="pull-left">Lectura Mes actual <?php echo '('.$mes_actual.')'; ?></div>
										<small class="pull-right"><?php echo valores_truncados($rowDatos['DetConsMesActualCantidad']) ?> m3</small>
										
										<br/>
										<div class="pull-left">Diferencia de lecturas</div>
										<small class="pull-right"><?php echo valores_truncados($rowDatos['DetConsMesDiferencia']) ?> m3</small>
									
										<?php
										//verificacion de remarcador
										if(isset($rowDatos['DetConsProrateo'])&&$rowDatos['DetConsProrateo']!=''&&$rowDatos['DetConsProrateo']!=0){?>
										<br/>
											<div class="pull-left">Adicionales por prorrateo</div>
											<small class="pull-right">
												<?php 
												if($rowDatos['DetConsProrateo']>0){
													$bla = $rowDatos['DetConsProrateo'];
												}else{
													$bla = $rowDatos['DetConsProrateo']*-1;
												}
												echo $rowDatos['DetConsProrateoSigno'].' '.$bla.' m3';?>
											</small>	
										<?php } ?>
										
										<br/>
										<div class="pull-left">Consumo Mes Total</div>
										<small class="pull-right"><?php echo Cantidades($rowDatos['DetConsMesTotalCantidad'], $ndecim) ?> m3</small>
									</p>
									
									<div class="clearfix"></div>

									<p>
										<div class="pull-left">Proxima lectura estimada</div>
										<small class="pull-right"><?php echo Fecha_estandar($rowDatos['DetConsFechaProxLectura']);?></small>
										<?php
										//verificacion de remarcador
										if(isset($rowDatos['DetConsProrateo'])&&$rowDatos['DetConsProrateo']!=''&&$rowDatos['DetConsProrateo']!=0){?>
										<br/>
										<div class="pull-left">Modalidad de prorrateo: <?php echo $rowDatos['DetConsModalidad'];?></div>
										<?php } ?>
									</p>
									
									<div class="clearfix"></div>
								
									<p>
										<div class="pull-left">Emergencias 24 horas </div>
										<small class="pull-right"><?php echo $rowDatos['DetConsFonoEmergencias'] ?></small>
										
										<br/>
										<div class="pull-left">Consultas Lunes a Viernes </div>
										<small class="pull-right"><?php echo $rowDatos['DetConsFonoConsultas'] ?></small>
									</p>
								</div>
							</div>
						</div>
						
					</div>	
					
				</div>
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Aguas Informa</h4>
						</div>
						<div class="panel-body">
							<p>
								Los Valores proporcionales con IVA para los consumos realizados a partir del 20-01-2016
								
								<br/>
								<div class="pull-left">Cargo fijo</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfCargoFijo'], 0)?></small>
								
								<br/>
								<div class="pull-left">Metro cubico agua potable</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfMetroAgua'], 2)?></small>
								
								<br/>
								<div class="pull-left">Metro cubico recoleccion</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfMetroRecolecion'], 2)?></small>
								
								<br/>
								<div class="pull-left">Visita corte</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfVisitaCorte'], 0)?></small>
								
								<br/>
								<div class="pull-left">Corte 1° instancia</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfCorte1'], 0)?></small>
								
								<br/>
								<div class="pull-left">Corte 2° instancia</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfCorte2'], 0)?></small>
								
								<br/>
								<div class="pull-left">Reposicion 1° instancia</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfReposicion1'], 0)?></small>
								
								<br/>
								<div class="pull-left">Reposicion 2° instancia</div>
								<small class="pull-right"><?php echo Valores($rowDatos['AguasInfReposicion2'], 0)?></small>

							</p>

							<div class="clearfix"></div>
							
							<p>
								<div class="pull-left">Factor de cobro del periodo</div>
								<small class="pull-right"><?php echo $rowDatos['AguasInfFactorCobro'] ?></small>
								
								<?php
								//verificacion de remarcador
								if(isset($rowDatos['AguasInfDifMedGeneral'])&&$rowDatos['AguasInfDifMedGeneral']!=''&&$rowDatos['AguasInfDifMedGeneral']!=0){?>
								<br/>
									<div class="pull-left">Diferencia medidor general</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['AguasInfDifMedGeneral']>0){
											$bla = '(+)'.Cantidades($rowDatos['AguasInfDifMedGeneral'], 2);
										}else{
											$bla = '(-)'.Cantidades($rowDatos['AguasInfDifMedGeneral']*-1, 2);
										}
										echo $bla.' m3';?>
									</small>
									
									<br/>
									<div class="pull-left">Porcentaje Prorrateo</div>
									<small class="pull-right"><?php echo $rowDatos['AguasInfProcProrrateo'] ?> %</small>	
								<?php } ?>
										
								<br/>
								<div class="pull-left">Punto servicio diametro</div>
								<small class="pull-right"><?php echo $rowDatos['AguasInfTipoMedicion'].' '.$rowDatos['AguasInfPuntoDiametro'].'mm' ?></small>
								
								<br/>
								<div class="pull-left">Clave facturacion</div>
								<small class="pull-right"><?php echo $rowDatos['AguasInfClaveFacturacion'] ?></small>
								
								<br/>
								<div class="pull-left">Clave Lectura</div>
								<small class="pull-right"><?php echo $rowDatos['AguasInfClaveLectura'] ?></small>
								
								<br/>
								<div class="pull-left">Numero medidor</div>
								<small class="pull-right"><?php echo $rowDatos['AguasInfNumeroMedidor'] ?></small>
							</p>
							
							<div class="clearfix"></div>
							
				
							<p>
								<div class="pull-left">Tarifas publicadas la nacion</div>
								<small class="pull-right">26-05-2017</small>
								
								<br/>	
								<div class="pull-left">Fecha emision</div>
								<small class="pull-right"><?php echo Fecha_estandar($rowDatos['AguasInfFechaEmision']);?></small>

								<br/>	
								<div class="pull-left">Ultimo pago</div>
								<small class="pull-right">
									<?php echo '('.valores($rowDatos['AguasInfUltimoPagoMonto'], 0).') ';
									if(isset($rowDatos['AguasInfUltimoPagoFecha'])&&$rowDatos['AguasInfUltimoPagoFecha']!='0000-00-00'){
										echo Fecha_estandar($rowDatos['AguasInfUltimoPagoFecha']);
									}else{
										echo 'Sin datos';
									}?>
								</small>
								
								<br/>	
								<div class="pull-left">Considera movimientos hasta</div>
								<small class="pull-right"><?php echo Fecha_estandar($rowDatos['AguasInfMovimientosHasta']);?></small>
							</p>
							
							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
