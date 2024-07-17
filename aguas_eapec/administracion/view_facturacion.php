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
//variable de ubicacion en el menu
$rowlevel['nombre_categoria'] = '';
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
            <h3><i class="fa fa-dashboard"></i> Ver Facturacion</h3>
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
<?php 



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


SII_idFacturable,
NombreArchivo,
clientes_facturable.Nombre AS DocFacturable,
SII_NDoc,
core_sistemas_rubro.Nombre AS Rubro,
clientes_listado.Rut AS ClienteRut,
clientes_listado.Giro AS ClienteGiro,
clientes_listado.Fono1 AS ClienteFono1,
clientes_listado.Fono2 AS ClienteFono2,
mnt_ubicacion_comunas.Nombre AS ClienteComunaFact,
clientes_listado.DireccionFact AS ClienteDireccionFact,
clientes_listado.UnidadHabitacional AS ClienteUH,
clientes_listado.idRemarcadores AS ClienteRemarcador,

usuarios_listado.Nombre AS PagoUsuario,
idTipoPago,nDocPago,fechaPago,montoPago,idPago,facturacion_listado_detalle.idEstado


FROM `facturacion_listado_detalle`
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema             = facturacion_listado_detalle.idSistema
LEFT JOIN `core_sistemas_rubro`       ON core_sistemas_rubro.idRubro         = core_sistemas.idRubro
LEFT JOIN `clientes_facturable`       ON clientes_facturable.idFacturable    = facturacion_listado_detalle.SII_idFacturable
LEFT JOIN `clientes_listado`          ON clientes_listado.idCliente          = facturacion_listado_detalle.idCliente
LEFT JOIN `usuarios_listado`          ON usuarios_listado.idUsuario          = facturacion_listado_detalle.idUsuarioPago
LEFT JOIN `mnt_ubicacion_comunas`     ON mnt_ubicacion_comunas.idComuna      = clientes_listado.idComunaFact
WHERE idFacturacionDetalle = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowDatos = mysqli_fetch_assoc ($resultado);


			
// Se trae un listado con todos los usuarios
$arrTipoPagos = array();
$query = "SELECT idTipoPago, Nombre
FROM `facturacion_listado_detalle_tipo_pago`";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipoPagos,$row );
}

// Se trae un listado con todos los usuarios
$arrPagosRel = array();
$query = "SELECT 
facturacion_listado_detalle_tipo_pago.Nombre,
clientes_pagos_relacionados.nDocPago,
clientes_pagos_relacionados.fechaPago,
clientes_pagos_relacionados.montoPago

FROM `clientes_pagos_relacionados`
LEFT JOIN `facturacion_listado_detalle_tipo_pago`    ON facturacion_listado_detalle_tipo_pago.idTipoPago    = clientes_pagos_relacionados.idTipoPago
WHERE clientes_pagos_relacionados.idFacturacionDetalle = {$_GET['view']} 
";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagosRel,$row );
}

?>

<div class="row no-print">
	<div class="col-xs-12">
		<?php
		switch ($rowDatos['SII_idFacturable']) {
			//Boleta Electronica
			case 1:
				echo '<a target="new" href="view_facturacion_to_print_1.php?view='.$_GET['view'].'" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimir</a>';
				$tipo = 1;
				break;
			//Factura Electronica
			case 2:
				echo '<a target="new" href="view_facturacion_to_print_2.php?view='.$_GET['view'].'" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimir</a>';
				$tipo = 2;
				break;
			//No Facturable
			case 3:
				//echo '<a target="new" href="view_facturacion_to_print_1.php?view='.$_GET['view'].'" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimir</a>';
				$tipo = 3;
				break;	
			//Boleta Manual
			case 4:
				echo '<a target="new" href="view_facturacion_to_print_4.php?view='.$_GET['view'].'" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimir</a>';
				$tipo = 4;
				break;	
			//Factura Manual
			case 5:
				echo '<a target="new" href="view_facturacion_to_print_5.php?view='.$_GET['view'].'" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimir</a>';
				$tipo = 5;
				break;		
			} 
			
			//Boton de descarga
			if(isset($rowDatos['NombreArchivo'])&&$rowDatos['NombreArchivo']!=''){
				echo '<a target="new" href="upload/'.$rowDatos['NombreArchivo'].'" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Descargar</a>';
			}
			
			
			
			?>
		
	</div>
</div>




<?php 
//Si el documento esta pagado se muestran los datos relacionados al pago
if($rowDatos['idEstado']==2){ ?>
	<div class="row" style="margin-top:10px;">
		<div class="col-xs-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="fa fa-check" aria-hidden="true"></i> Pago Confirmado</h6>
				</div>
				<div class="panel-body">
					<div class="row invoice-payment">
						<div class="col-sm-8">
							<h6 class="text-success"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo 'Pagado el '.Fecha_estandar($rowDatos['fechaPago']) ?></h6>
							<?php foreach ($arrTipoPagos as $pago) { ?>
								<label class="radio <?php if($pago['idTipoPago']==$rowDatos['idTipoPago']){echo 'disabled';} ?>">
									<div class="choice"><span><input <?php if($pago['idTipoPago']==$rowDatos['idTipoPago']){echo 'disabled="disabled" checked="checked"';} ?> name="payment-paid" class="styled" type="radio"></span></div>
									<?php echo $pago['Nombre'] ?>
									<?php if($pago['idTipoPago']==$rowDatos['idTipoPago']&&$rowDatos['nDocPago']!=''){
										echo 'Doc N° '.$rowDatos['nDocPago'];
										} 
									?>
								</label>
							<?php } ?>
						</div>
						<div class="col-sm-4">
							<h6><?php echo 'Usuario encargado '.$rowDatos['PagoUsuario']?></h6>
							<table class="table">
								<tbody>
									<tr>
										<th>Monto Pagado:</th>
										<td class="text-right"><?php echo Valores($rowDatos['montoPago'], 0) ?></td>
									</tr>
									<tr>
										<th>Monto Facturado:</th>
										<td class="text-right"><?php echo Valores($rowDatos['DetalleTotalAPagar'], 0) ?></td>
									</tr>
									<tr>
										<th>Diferencia:</th>
										<?php 
										$diferencia = $rowDatos['montoPago'] - $rowDatos['DetalleTotalAPagar'];
										if($diferencia<0){
											echo '<td class="text-right text-danger"><h6><i class="fa fa-arrow-down" aria-hidden="true"></i> '.Valores($diferencia, 0).'</h6></td>';
										}elseif($diferencia>0){
											echo '<td class="text-right text-info"><h6><i class="fa fa-arrow-up" aria-hidden="true"></i> '.Valores($diferencia, 0).'</h6></td>';
										}else{
											echo '<td class="text-right"><h6>Pago OK</h6></td>';
										}
										?>
										
									</tr>
								</tbody>
							</table>
					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php 
	//cuento la cantidad de pagos relacionados
	$nn = 0;
	foreach ($arrPagosRel as $pagos) { 
		$nn++;
	}
	//si tiene mas de un pago relacionado se muestran los pagos relacionados
	if($nn>1){?>
		<div class="row" style="margin-top:10px;">
			<div class="col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h6 class="panel-title"><i class="fa fa-usd" aria-hidden="true"></i> Pagos Relacionados</h6>
					</div>
					<div class="panel-body">
						<div class="row invoice-payment">
							<table class="table">
								<thead>
									<tr role="row">
										<th>Documento</th>
										<th>Fecha</th> 
										<th>Monto</th>
									</tr>
								</thead>			  
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrPagosRel as $pagos) { ?>
									<tr class="odd">
										<td><?php echo $pagos['Nombre'].' Doc N° '.$pagos['nDocPago']; ?></td>
										<td><?php echo $pagos['fechaPago']; ?></td>
										<td><?php echo $pagos['montoPago']; ?></td>
									</tr>
								<?php } ?>                    
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	<?php } ?>	
	
<?php }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
//Boleta Electronica	
if($tipo==1){ ?>
	<div class="row">
		<div class="invoice">
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
						if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){
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
										if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
										<br/>
											<div class="pull-left">Adicionales por prorrateo</div>
											<small class="pull-right">
												<?php 
												if($rowDatos['DetConsProrateo']>0){
													$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo'];
												}elseif($rowDatos['DetConsProrateo']<0){
													$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo']*-1;
												}else{
													$bla = '(+) 0';
												}
												echo $bla.' m3';?>
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
										if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
								<br/>
									<div class="pull-left">Diferencia medidor general</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['AguasInfDifMedGeneral']>0){
											$bla = '(+)'.Cantidades($rowDatos['AguasInfDifMedGeneral'], 2);
										}elseif($rowDatos['AguasInfDifMedGeneral']<0){
											$bla = '(-)'.Cantidades($rowDatos['AguasInfDifMedGeneral']*-1, 2);
										}else{
											$bla = '(+)0';
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
	</div>

<?php 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
//Factura Electronica	
}elseif($tipo==2){ ?>
	<div class="row">
		<div class="invoice">
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
						<th width="100px"><h4>IVA</h4></th>
						<th width="100px"><h4>Cantidad</h4></th>
						<th width="100px"><h4>Precio Unitario</h4></th>
						<th width="100px" class="text-right"><h4>Total Item</h4></th>
					</tr>
				</thead>
				<tbody>
					<?php
						//verificacion de remarcador
						if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){
							$ndecim = 2;
						}else{
							$ndecim = 0;	
						}
					?>
								
					<tr>
						<td>Cargo Fijo Cliente</td>
						<td>Afecto</td>
						<td class="text-right"><?php echo $rowDatos['ClienteUH'];?></td>
						<td class="text-right"><?php echo Valores(($rowDatos['AguasInfCargoFijo']/1.19), 2);?></td>
						<td class="text-right"><?php echo Valores(($rowDatos['DetalleCargoFijoValor']/1.19), 0);?></td>	
					</tr>
					<tr>
						<td>Consumo Agua Potable</td>
						<td>Afecto</td>
						<td class="text-right"><?php echo Cantidades($rowDatos['DetalleConsumoCantidad'], $ndecim);?></td>
						<td class="text-right"><?php echo Valores(($rowDatos['AguasInfMetroAgua']/1.19), 2);?></td>
						<td class="text-right"><?php echo Valores(($rowDatos['DetalleConsumoValor']/1.19), 0);?></td>	
					</tr>
					<tr>
						<td>Recoleccion de Aguas Servidas</td>
						<td>Afecto</td>
						<td class="text-right"><?php echo Cantidades($rowDatos['DetalleRecoleccionCantidad'], $ndecim);?></td>
						<td class="text-right"><?php echo Valores(($rowDatos['AguasInfMetroRecolecion']/1.19), 2);?></td>
						<td class="text-right"><?php echo Valores(($rowDatos['DetalleRecoleccionValor']/1.19), 0);?></td>	
					</tr>
					<?php if(isset($rowDatos['DetalleVisitaCorte'])&&$rowDatos['DetalleVisitaCorte']!=0){ ?>
						<tr>
							<td>Visita Corte</td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleVisitaCorte']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleVisitaCorte']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleCorte1Valor'])&&$rowDatos['DetalleCorte1Valor']!=0){ ?>
						<tr>
							<td>Corte 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte1Fecha']).')'?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte1Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte1Valor']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleCorte2Valor'])&&$rowDatos['DetalleCorte2Valor']!=0){ ?>
						<tr>
							<td>Corte 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte2Fecha']).')'?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte2Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte2Valor']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleReposicion1Valor'])&&$rowDatos['DetalleReposicion1Valor']!=0){ ?>
						<tr>
							<td>Reposicion 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion1Fecha']).')'?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion1Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion1Valor']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleReposicion2Valor'])&&$rowDatos['DetalleReposicion2Valor']!=0){ ?>
						<tr>
							<td>Reposicion 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion2Fecha']).')'?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion2Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion2Valor']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					<tr>
						<td colspan="4"><strong>SUBTOTAL SERVICIO</strong></td>
						<td class="text-right"><strong><?php echo Valores(($rowDatos['DetalleSubtotalServicio']/1.19), 0); ?></strong></td>
					</tr>
					<?php if(isset($rowDatos['DetalleInteresDeuda'])&&$rowDatos['DetalleInteresDeuda']!=0){ ?>
						<tr>
							<td>Interes Deuda</td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleInteresDeuda']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleInteresDeuda']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					
					<?php 
					//Otros Cargos 1
					if(isset($rowDatos['DetalleOtrosCargos1Valor'])&&$rowDatos['DetalleOtrosCargos1Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos1Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos1Fecha']).')'; ?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos1Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos1Valor']/1.19), 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 2
					if(isset($rowDatos['DetalleOtrosCargos2Valor'])&&$rowDatos['DetalleOtrosCargos2Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos2Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos2Fecha']).')'; ?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos2Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos2Valor']/1.19), 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 3
					if(isset($rowDatos['DetalleOtrosCargos3Valor'])&&$rowDatos['DetalleOtrosCargos3Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos3Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos3Fecha']).')'; ?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos3Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos3Valor']/1.19), 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 4
					if(isset($rowDatos['DetalleOtrosCargos4Valor'])&&$rowDatos['DetalleOtrosCargos4Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos4Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos4Fecha']).')'; ?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos4Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos4Valor']/1.19), 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 5
					if(isset($rowDatos['DetalleOtrosCargos5Valor'])&&$rowDatos['DetalleOtrosCargos5Valor']!=0){ ?>
						<tr>
							<td><?php echo $rowDatos['DetalleOtrosCargos5Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos5Fecha']).')'; ?></td>
							<td>Afecto</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos5Valor']/1.19), 2)?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos5Valor']/1.19), 0)?></td>	
						</tr>
					<?php } ?>
					<tr>
						<td colspan="4"><strong>TOTAL VENTA NETO</strong></td>
						<td class="text-right"><strong><?php echo Valores(($rowDatos['DetalleTotalVenta']/1.19), 0); ?></strong></td>
					</tr>
					<?php 
					//variable exento
					$Exento = 0;
					if(isset($rowDatos['DetalleSaldoFavor'])&&$rowDatos['DetalleSaldoFavor']!=0){ 
						$Exento = $Exento - $rowDatos['DetalleSaldoFavor']; ?>
						<tr>
							<td>Saldo a Favor</td>
							<td>Exento</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleSaldoFavor'], 0)?></td>
							<td class="text-right"><?php echo '(-) '.Valores($rowDatos['DetalleSaldoFavor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($rowDatos['DetalleSaldoAnterior'])&&$rowDatos['DetalleSaldoAnterior']!=0){ 
						$Exento = $Exento + $rowDatos['DetalleSaldoAnterior']; ?>
						<tr>
							<td>Saldo Anterior</td>
							<td>Exento</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($rowDatos['DetalleSaldoAnterior'], 0)?></td>
							<td class="text-right"><?php echo '(+) '.Valores($rowDatos['DetalleSaldoAnterior'], 0)?></td>	
						</tr>
					<?php } ?>
					
					
					
				</tbody>
			</table>
			<div class="row text-right" style="margin-top:20px;">
				<div class="col-xs-2 col-xs-offset-8">
					<p>
						<strong>
							TOTAL VENTA NETO : <br>
							AFECTO IVA (19%) : <br>
							EXENTOS : <br>
							TOTAL : <br>
						</strong>
					</p>
				</div>
				<div class="col-xs-2">
					<strong>
						<?php 
						if($rowDatos['DetalleTotalVenta']>0){
							echo Valores(($rowDatos['DetalleTotalVenta']/1.19), 0).'<br>';
							echo Valores(($rowDatos['DetalleTotalVenta']-($rowDatos['DetalleTotalVenta']/1.19)), 0).'<br>';
							echo Valores($Exento, 0).'<br>'; 
							echo Valores($rowDatos['DetalleTotalAPagar'], 0).'<br>'; 
						}else{
							echo Valores(0, 0).'<br>';
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
										if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
										<br/>
											<div class="pull-left">Adicionales por prorrateo</div>
											<small class="pull-right">
												<?php 
												if($rowDatos['DetConsProrateo']>0){
													$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo'];
												}elseif($rowDatos['DetConsProrateo']<0){
													$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo']*-1;
												}else{
													$bla = '(+) 0';
												}
												echo $bla.' m3';?>
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
										if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
								<br/>
									<div class="pull-left">Diferencia medidor general</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['AguasInfDifMedGeneral']>0){
											$bla = '(+)'.Cantidades($rowDatos['AguasInfDifMedGeneral'], 2);
										}elseif($rowDatos['AguasInfDifMedGeneral']<0){
											$bla = '(-)'.Cantidades($rowDatos['AguasInfDifMedGeneral']*-1, 2);
										}else{
											$bla = '(+)0';
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
			
			<div class="row">
				<div class="col-xs-12">
					<div class="col-sm-12 well well-sm no-shadow" style="background-color: #fff;">
						<p><?php echo 'Son: '.numtoletras($rowDatos['DetalleTotalAPagar']); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
//Boleta Manual
}elseif($tipo==4){ ?>
	<div class="row">
		<section class="invoice">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-header">
						<i class="fa fa-globe"></i> <?php echo $rowDatos['SistemaNombre']?>
					</h2>
				</div>   
			</div>
			
			<div class="row invoice-info">
			
				<div class="col-sm-6 invoice-col">
					<address>
						RUT : <?php echo $rowDatos['SistemaRut']?><br>
						<?php echo $rowDatos['Rubro']?><br>
						<?php echo $rowDatos['SistemaDireccion'].' '.$rowDatos['SistemaComuna'].' '.$rowDatos['SistemaCiudad']; ?><br>
						<?php echo $rowDatos['SistemaFono']?>
					</address>
				</div>
						
				<div class="col-sm-6 invoice-col">
					<br><br><br>
					<?php echo $rowDatos['DocFacturable'].' '.$rowDatos['SII_NDoc'] ?>
				</div>

			</div>
			
			<div class="row invoice-info">
				<div class="col-sm-6 invoice-col">
					<p class="well well-sm no-shadow" style="background-color: #fff;text-align: center;" >
						<br>
						<?php echo $rowDatos['ClienteNombre']?><br>
						<?php echo $rowDatos['ClienteDireccionFact']?><br>
						<?php echo $rowDatos['ClienteComunaFact']?><br>
						<br>
					</p>
				</div>
						
				<div class="col-sm-6 invoice-col">
					<p class="well well-sm no-shadow" style="background-color: #fff;text-align: center;" >
						N° Cliente: <?php echo $rowDatos['ClienteIdentificador']?>
					</p>
					<p class="well well-sm no-shadow" style="background-color: #fff;text-align: center;" >
						TOTAL A PAGAR:<?php if($rowDatos['DetalleTotalAPagar']>0){echo Valores($rowDatos['DetalleTotalAPagar'], 0);}else{echo '0';} ?>
						<br>
						<?php
						//Se trae el saldo anterior si es que este existe
						if($rowDatos['ClienteEstado']=='Sin Problemas'){
							echo 'VENCIMIENTO: '.Fecha_estandar($rowDatos['ClienteFechaVencimiento']);	
						}else{
							echo $rowDatos['ClienteEstado'];
						}
						?>
					</p>
					
				</div>

			</div>
			
			
			
				<div class="col-xs-12 well well-sm no-shadow" style="background-color: #fff;">
					<table class="table">
						<thead>
							<tr>
								<th>Detalle Cuenta</th>
								<th width="200px">Metros Cubicos</th>
								<th width="100px" align="right">Valor Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
								//verificacion de remarcador
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){
									$ndecim = 2;
								}else{
									$ndecim = 0;	
								}
							?>
							<tr>
								<td>Cargo Fijo Cliente</td>
								<td></td>
								<td align="right"><?php echo Valores($rowDatos['DetalleCargoFijoValor'], 0);?></td>	
							</tr>
							<tr>
								<td>Consumo Agua Potable</td>
								<td><?php echo Cantidades($rowDatos['DetalleConsumoCantidad'], $ndecim);?></td>
								<td align="right"><?php echo Valores($rowDatos['DetalleConsumoValor'], 0);?></td>	
							</tr>
							<tr>
								<td>Recoleccion de Aguas Servidas</td>
								<td><?php echo Cantidades($rowDatos['DetalleRecoleccionCantidad'], $ndecim);?></td>
								<td align="right"><?php echo Valores($rowDatos['DetalleRecoleccionValor'], 0);?></td>	
							</tr>
						
							<?php if(isset($rowDatos['DetalleVisitaCorte'])&&$rowDatos['DetalleVisitaCorte']!=0){ ?>
								<tr>
									<td colspan="2">Visita Corte</td>
									<td align="right"><?php echo Valores($rowDatos['DetalleVisitaCorte'], 0)?></td>	
								</tr>
							<?php } ?>
							<?php if(isset($rowDatos['DetalleCorte1Valor'])&&$rowDatos['DetalleCorte1Valor']!=0){ ?>
								<tr>
									<td colspan="2">Corte 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte1Fecha']).')'?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleCorte1Valor'], 0)?></td>	
								</tr>
							<?php } ?>
							<?php if(isset($rowDatos['DetalleCorte2Valor'])&&$rowDatos['DetalleCorte2Valor']!=0){ ?>
								<tr>
									<td colspan="2">Corte 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte2Fecha']).')'?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleCorte2Valor'], 0)?></td>	
								</tr>
							<?php } ?>
							<?php if(isset($rowDatos['DetalleReposicion1Valor'])&&$rowDatos['DetalleReposicion1Valor']!=0){ ?>
								<tr>
									<td colspan="2">Reposicion 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion1Fecha']).')'?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleReposicion1Valor'], 0)?></td>	
								</tr>
							<?php } ?>
							<?php if(isset($rowDatos['DetalleReposicion2Valor'])&&$rowDatos['DetalleReposicion2Valor']!=0){ ?>
								<tr>
									<td colspan="2">Reposicion 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion2Fecha']).')'?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleReposicion2Valor'], 0)?></td>	
								</tr>
							<?php } ?>
							
							<tr>
								<td colspan="2"><strong>SUBTOTAL SERVICIO</strong></td>
								<td align="right"><strong><?php echo Valores($rowDatos['DetalleSubtotalServicio'], 0); ?></strong></td>
							</tr>
							
							<?php if(isset($rowDatos['DetalleInteresDeuda'])&&$rowDatos['DetalleInteresDeuda']!=0){ ?>
								<tr>
									<td colspan="2">Interes Deuda</td>
									<td align="right"><?php echo Valores($rowDatos['DetalleInteresDeuda'], 0)?></td>	
								</tr>
							<?php } ?>
							
							<?php 
							//Otros Cargos 1
							if(isset($rowDatos['DetalleOtrosCargos1Valor'])&&$rowDatos['DetalleOtrosCargos1Valor']!=0){ ?>
								<tr>
									<td colspan="2"><?php echo $rowDatos['DetalleOtrosCargos1Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos1Fecha']).')'; ?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleOtrosCargos1Valor'], 0)?></td>	
								</tr>
							<?php } 
							//Otros Cargos 2
							if(isset($rowDatos['DetalleOtrosCargos2Valor'])&&$rowDatos['DetalleOtrosCargos2Valor']!=0){ ?>
								<tr>
									<td colspan="2"><?php echo $rowDatos['DetalleOtrosCargos2Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos2Fecha']).')'; ?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleOtrosCargos2Valor'], 0)?></td>	
								</tr>
							<?php } 
							//Otros Cargos 3
							if(isset($rowDatos['DetalleOtrosCargos3Valor'])&&$rowDatos['DetalleOtrosCargos3Valor']!=0){ ?>
								<tr>
									<td colspan="2"><?php echo $rowDatos['DetalleOtrosCargos3Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos3Fecha']).')'; ?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleOtrosCargos3Valor'], 0)?></td>	
								</tr>
							<?php } 
							//Otros Cargos 4
							if(isset($rowDatos['DetalleOtrosCargos4Valor'])&&$rowDatos['DetalleOtrosCargos4Valor']!=0){ ?>
								<tr>
									<td colspan="2"><?php echo $rowDatos['DetalleOtrosCargos4Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos4Fecha']).')'; ?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleOtrosCargos4Valor'], 0)?></td>	
								</tr>
							<?php } 
							//Otros Cargos 5
							if(isset($rowDatos['DetalleOtrosCargos5Valor'])&&$rowDatos['DetalleOtrosCargos5Valor']!=0){ ?>
								<tr>
									<td colspan="2"><?php echo $rowDatos['DetalleOtrosCargos5Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos5Fecha']).')'; ?></td>
									<td align="right"><?php echo Valores($rowDatos['DetalleOtrosCargos5Valor'], 0)?></td>	
								</tr>
							<?php } ?>
							<tr>
								<td colspan="2"><strong>TOTAL VENTA</strong></td>
								<td align="right"><strong><?php if($rowDatos['DetalleTotalVenta']>0){echo Valores($rowDatos['DetalleTotalVenta'], 0);}else{echo '0';} ?></strong></td>
							</tr>
							<?php if(isset($rowDatos['DetalleSaldoFavor'])&&$rowDatos['DetalleSaldoFavor']!=0){ ?>
								<tr>
									<td colspan="2">Saldo a Favor</td>
									<td align="right"><?php echo '(-) '.Valores($rowDatos['DetalleSaldoFavor'], 0)?></td>	
								</tr>
							<?php } ?>
							<?php if(isset($rowDatos['DetalleSaldoAnterior'])&&$rowDatos['DetalleSaldoAnterior']!=0){ ?>
								<tr>
									<td colspan="2">Saldo Anterior</td>
									<td align="right"><?php echo Valores($rowDatos['DetalleSaldoAnterior'], 0)?></td>	
								</tr>
							<?php } ?>
							<tr>
								<td colspan="2"><strong>TOTAL A PAGAR</strong></td>
								<td align="right"><strong><?php if($rowDatos['DetalleTotalAPagar']>0){echo Valores($rowDatos['DetalleTotalAPagar'], 0);}else{echo '0';} ?></strong></td>
							</tr>
							
						</tbody>
					</table>
					
				</div>
				
			<div class="row">
				<div class="col-xs-12">
					
					<div class="col-sm-6" style="padding-left: 0px;">
						<div class="well well-sm no-shadow" style="background-color: #fff;">
							
						<?php
						//comparacion
						$mayor = 0;
						$mes_01 = $rowDatos['GraficoMes1Valor'];
						$mes_02 = $rowDatos['GraficoMes2Valor'];
						$mes_03 = $rowDatos['GraficoMes3Valor'];
						$mes_04 = $rowDatos['GraficoMes4Valor'];
						$mes_05 = $rowDatos['GraficoMes5Valor'];
						$mes_06 = $rowDatos['GraficoMes6Valor'];
						$mes_07 = $rowDatos['GraficoMes7Valor'];
						$mes_08 = $rowDatos['GraficoMes8Valor'];
						$mes_09 = $rowDatos['GraficoMes9Valor'];
						$mes_10 = $rowDatos['GraficoMes10Valor'];
						$mes_11 = $rowDatos['GraficoMes11Valor'];
						$mes_12 = $rowDatos['GraficoMes12Valor'];
						
						if($mayor<$mes_01){$mayor=$mes_01;}
						if($mayor<$mes_02){$mayor=$mes_02;}
						if($mayor<$mes_03){$mayor=$mes_03;}
						if($mayor<$mes_04){$mayor=$mes_04;}
						if($mayor<$mes_05){$mayor=$mes_05;}
						if($mayor<$mes_06){$mayor=$mes_06;}
						if($mayor<$mes_07){$mayor=$mes_07;}
						if($mayor<$mes_08){$mayor=$mes_08;}
						if($mayor<$mes_09){$mayor=$mes_09;}
						if($mayor<$mes_10){$mayor=$mes_10;}
						if($mayor<$mes_11){$mayor=$mes_11;}
						if($mayor<$mes_12){$mayor=$mes_12;}

						//variables
						$maximo = $mayor + 20;
						$minimo = $mayor * 0.25;
						//alto de los graficos
						$alto_01 = ($mes_01*170)/$maximo;
						$alto_02 = ($mes_02*170)/$maximo;
						$alto_03 = ($mes_03*170)/$maximo;
						$alto_04 = ($mes_04*170)/$maximo;
						$alto_05 = ($mes_05*170)/$maximo;
						$alto_06 = ($mes_06*170)/$maximo;
						$alto_07 = ($mes_07*170)/$maximo;
						$alto_08 = ($mes_08*170)/$maximo;
						$alto_09 = ($mes_09*170)/$maximo;
						$alto_10 = ($mes_10*170)/$maximo;
						$alto_11 = ($mes_11*170)/$maximo;
						$alto_12 = ($mes_12*170)/$maximo;
						
						
						?>

							<div class="graficos">
								<div class="bargraph" style= "width: 362px;">
									<p class="centered">Consumo Ultimos Meses</p> 
									<ul class="bars">
										<li class="bar1"  style="height: <?php echo $alto_01; ?>px;"><?php if($mes_01>$minimo){echo Cantidades($mes_01, $ndecim);}else{echo '<span>'.Cantidades($mes_01, $ndecim).'</span>';} ?></li>
										<li class="bar2"  style="height: <?php echo $alto_02; ?>px;"><?php if($mes_02>$minimo){echo Cantidades($mes_02, $ndecim);}else{echo '<span>'.Cantidades($mes_02, $ndecim).'</span>';} ?></li>
										<li class="bar3"  style="height: <?php echo $alto_03; ?>px;"><?php if($mes_03>$minimo){echo Cantidades($mes_03, $ndecim);}else{echo '<span>'.Cantidades($mes_03, $ndecim).'</span>';} ?></li>
										<li class="bar4"  style="height: <?php echo $alto_04; ?>px;"><?php if($mes_04>$minimo){echo Cantidades($mes_04, $ndecim);}else{echo '<span>'.Cantidades($mes_04, $ndecim).'</span>';} ?></li>
										<li class="bar5"  style="height: <?php echo $alto_05; ?>px;"><?php if($mes_05>$minimo){echo Cantidades($mes_05, $ndecim);}else{echo '<span>'.Cantidades($mes_05, $ndecim).'</span>';} ?></li>
										<li class="bar6"  style="height: <?php echo $alto_06; ?>px;"><?php if($mes_06>$minimo){echo Cantidades($mes_06, $ndecim);}else{echo '<span>'.Cantidades($mes_06, $ndecim).'</span>';} ?></li>
										<li class="bar7"  style="height: <?php echo $alto_07; ?>px;"><?php if($mes_07>$minimo){echo Cantidades($mes_07, $ndecim);}else{echo '<span>'.Cantidades($mes_07, $ndecim).'</span>';} ?></li>
										<li class="bar8"  style="height: <?php echo $alto_08; ?>px;"><?php if($mes_08>$minimo){echo Cantidades($mes_08, $ndecim);}else{echo '<span>'.Cantidades($mes_08, $ndecim).'</span>';} ?></li>
										<li class="bar9"  style="height: <?php echo $alto_09; ?>px;"><?php if($mes_09>$minimo){echo Cantidades($mes_09, $ndecim);}else{echo '<span>'.Cantidades($mes_09, $ndecim).'</span>';} ?></li>
										<li class="bar10" style="height: <?php echo $alto_10; ?>px;"><?php if($mes_10>$minimo){echo Cantidades($mes_10, $ndecim);}else{echo '<span>'.Cantidades($mes_10, $ndecim).'</span>';} ?></li>
										<li class="bar11" style="height: <?php echo $alto_11; ?>px;"><?php if($mes_11>$minimo){echo Cantidades($mes_11, $ndecim);}else{echo '<span>'.Cantidades($mes_11, $ndecim).'</span>';} ?></li>
										<li class="bar12" style="height: <?php echo $alto_12; ?>px;"><?php if($mes_12>$minimo){echo Cantidades($mes_12, $ndecim);}else{echo '<span>'.Cantidades($mes_12, $ndecim).'</span>';} ?></li>
									</ul>
									<ul class="label">
										<li><?php echo $rowDatos['GraficoMes1Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes2Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes3Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes4Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes5Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes6Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes7Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes8Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes9Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes10Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes11Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes12Fecha']; ?></li>	
									</ul>
								</div>
							</div>
						</div>
						<div class="well well-sm no-shadow" style="background-color: #fff;">
							<strong>Detalle de Consumo</strong>
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
								<br/>
									<div class="pull-left">Adicionales por prorrateo</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['DetConsProrateo']>0){
											$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo'];
										}elseif($rowDatos['DetConsProrateo']<0){
											$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo']*-1;
										}else{
											$bla = '(+) 0';
										}
										echo $bla.' m3';?>
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
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
							
					<div class="col-sm-6 well well-sm no-shadow" style="background-color: #fff;">
						<strong>Aguas Informa</strong>
							<p>
								Los Valores proporcionales con IVA para los consumos realizados<br/>
								a partir del 20-01-2016
								
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
								<br/>
									<div class="pull-left">Diferencia medidor general</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['AguasInfDifMedGeneral']>0){
											$bla = '(+)'.Cantidades($rowDatos['AguasInfDifMedGeneral'], 2);
										}elseif($rowDatos['AguasInfDifMedGeneral']<0){
											$bla = '(-)'.Cantidades($rowDatos['AguasInfDifMedGeneral']*-1, 2);
										}else{
											$bla = '(+)0';
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
		</section>
	</div>	

<?php  
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
//Factura Manual	
}elseif($tipo==5){ ?>
	<div class="row">
		<section class="invoice">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-header">
						<i class="fa fa-globe"></i> <?php echo $rowDatos['SistemaNombre']?>
					</h2>
				</div>   
			</div>
			
			<div class="row invoice-info">
			
				<div class="col-sm-6 invoice-col">
					<address>
						RUT : <?php echo $rowDatos['SistemaRut']?><br>
						<?php echo $rowDatos['Rubro']?><br>
						<?php echo $rowDatos['SistemaDireccion'].' '.$rowDatos['SistemaComuna'].' '.$rowDatos['SistemaCiudad']; ?><br>
						<?php echo $rowDatos['SistemaFono']?>
					</address>
				</div>
						
				<div class="col-sm-6 invoice-col">
					<br><br><br>
					<?php echo $rowDatos['DocFacturable'].' '.$rowDatos['SII_NDoc'] ?>
				</div>

			</div>
			
			<div class="row invoice-info">
				<div class="col-sm-6 invoice-col">
					<p class="well well-sm no-shadow" style="background-color: #fff;text-align: center;" >
						<br>
						<?php echo $rowDatos['ClienteNombre']?><br>
						<?php echo $rowDatos['ClienteDireccionFact']?><br>
						<?php echo $rowDatos['ClienteComunaFact']?><br>
						<br>
					</p>
				</div>
						
				<div class="col-sm-6 invoice-col">
					<p class="well well-sm no-shadow" style="background-color: #fff;text-align: center;" >
						N° Cliente: <?php echo $rowDatos['ClienteIdentificador']?>
					</p>
					<p class="well well-sm no-shadow" style="background-color: #fff;text-align: center;" >
						TOTAL A PAGAR:<?php if($rowDatos['DetalleTotalAPagar']>0){echo Valores($rowDatos['DetalleTotalAPagar'], 0);}else{echo '0';} ?>
						<br>
						<?php
						//Se trae el saldo anterior si es que este existe
						if($rowDatos['ClienteEstado']=='Sin Problemas'){
							echo 'VENCIMIENTO: '.Fecha_estandar($rowDatos['ClienteFechaVencimiento']);	
						}else{
							echo $rowDatos['ClienteEstado'];
						}
						?>
					</p>
					
				</div>

			</div>
			
			
			
				<div class="col-xs-12 well well-sm no-shadow" style="background-color: #fff;">
					<table class="table">
						<thead>
						<tr>
							<th>Detalle Cuenta</th>
							<th width="100px">IVA</th>
							<th width="100px">Cantidad</th>
							<th width="100px">Precio Unitario</th>
							<th width="100px" class="text-right">Total Item</th>
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
							<td>Afecto</td>
							<td class="text-right"><?php echo $rowDatos['ClienteUH'];?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['AguasInfCargoFijo']/1.19), 2);?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleCargoFijoValor']/1.19), 0);?></td>	
						</tr>
						<tr>
							<td>Consumo Agua Potable</td>
							<td>Afecto</td>
							<td class="text-right"><?php echo Cantidades($rowDatos['DetalleConsumoCantidad'], $ndecim);?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['AguasInfMetroAgua']/1.19), 2);?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleConsumoValor']/1.19), 0);?></td>	
						</tr>
						<tr>
							<td>Recoleccion de Aguas Servidas</td>
							<td>Afecto</td>
							<td class="text-right"><?php echo Cantidades($rowDatos['DetalleRecoleccionCantidad'], $ndecim);?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['AguasInfMetroRecolecion']/1.19), 2);?></td>
							<td class="text-right"><?php echo Valores(($rowDatos['DetalleRecoleccionValor']/1.19), 0);?></td>	
						</tr>
						<?php if(isset($rowDatos['DetalleVisitaCorte'])&&$rowDatos['DetalleVisitaCorte']!=0){ ?>
							<tr>
								<td>Visita Corte</td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleVisitaCorte']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleVisitaCorte']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						<?php if(isset($rowDatos['DetalleCorte1Valor'])&&$rowDatos['DetalleCorte1Valor']!=0){ ?>
							<tr>
								<td>Corte 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte1Fecha']).')'?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte1Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte1Valor']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						<?php if(isset($rowDatos['DetalleCorte2Valor'])&&$rowDatos['DetalleCorte2Valor']!=0){ ?>
							<tr>
								<td>Corte 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleCorte2Fecha']).')'?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte2Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleCorte2Valor']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						<?php if(isset($rowDatos['DetalleReposicion1Valor'])&&$rowDatos['DetalleReposicion1Valor']!=0){ ?>
							<tr>
								<td>Reposicion 1° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion1Fecha']).')'?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion1Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion1Valor']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						<?php if(isset($rowDatos['DetalleReposicion2Valor'])&&$rowDatos['DetalleReposicion2Valor']!=0){ ?>
							<tr>
								<td>Reposicion 2° instancia <?php echo ' ('.Fecha_estandar($rowDatos['DetalleReposicion2Fecha']).')'?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion2Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleReposicion2Valor']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						<tr>
							<td colspan="4"><strong>SUBTOTAL SERVICIO</strong></td>
							<td class="text-right"><strong><?php echo Valores(($rowDatos['DetalleSubtotalServicio']/1.19), 0); ?></strong></td>
						</tr>
						<?php if(isset($rowDatos['DetalleInteresDeuda'])&&$rowDatos['DetalleInteresDeuda']!=0){ ?>
							<tr>
								<td>Interes Deuda</td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleInteresDeuda']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleInteresDeuda']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						
						<?php 
						//Otros Cargos 1
						if(isset($rowDatos['DetalleOtrosCargos1Valor'])&&$rowDatos['DetalleOtrosCargos1Valor']!=0){ ?>
							<tr>
								<td><?php echo $rowDatos['DetalleOtrosCargos1Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos1Fecha']).')'; ?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos1Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos1Valor']/1.19), 0)?></td>	
							</tr>
						<?php } 
						//Otros Cargos 2
						if(isset($rowDatos['DetalleOtrosCargos2Valor'])&&$rowDatos['DetalleOtrosCargos2Valor']!=0){ ?>
							<tr>
								<td><?php echo $rowDatos['DetalleOtrosCargos2Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos2Fecha']).')'; ?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos2Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos2Valor']/1.19), 0)?></td>	
							</tr>
						<?php } 
						//Otros Cargos 3
						if(isset($rowDatos['DetalleOtrosCargos3Valor'])&&$rowDatos['DetalleOtrosCargos3Valor']!=0){ ?>
							<tr>
								<td><?php echo $rowDatos['DetalleOtrosCargos3Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos3Fecha']).')'; ?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos3Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos3Valor']/1.19), 0)?></td>	
							</tr>
						<?php } 
						//Otros Cargos 4
						if(isset($rowDatos['DetalleOtrosCargos4Valor'])&&$rowDatos['DetalleOtrosCargos4Valor']!=0){ ?>
							<tr>
								<td><?php echo $rowDatos['DetalleOtrosCargos4Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos4Fecha']).')'; ?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos4Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos4Valor']/1.19), 0)?></td>	
							</tr>
						<?php } 
						//Otros Cargos 5
						if(isset($rowDatos['DetalleOtrosCargos5Valor'])&&$rowDatos['DetalleOtrosCargos5Valor']!=0){ ?>
							<tr>
								<td><?php echo $rowDatos['DetalleOtrosCargos5Texto'].' ('.Fecha_estandar($rowDatos['DetalleOtrosCargos5Fecha']).')'; ?></td>
								<td>Afecto</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos5Valor']/1.19), 2)?></td>
								<td class="text-right"><?php echo Valores(($rowDatos['DetalleOtrosCargos5Valor']/1.19), 0)?></td>	
							</tr>
						<?php } ?>
						<tr>
							<td colspan="4"><strong>TOTAL VENTA NETO</strong></td>
							<td class="text-right"><strong><?php echo Valores(($rowDatos['DetalleTotalVenta']/1.19), 0); ?></strong></td>
						</tr>
						<?php 
						//variable exento
						$Exento = 0;
						if(isset($rowDatos['DetalleSaldoFavor'])&&$rowDatos['DetalleSaldoFavor']!=0){ 
							$Exento = $Exento - $rowDatos['DetalleSaldoFavor']; ?>
							<tr>
								<td>Saldo a Favor</td>
								<td>Exento</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores($rowDatos['DetalleSaldoFavor'], 0)?></td>
								<td class="text-right"><?php echo '(-) '.Valores($rowDatos['DetalleSaldoFavor'], 0)?></td>	
							</tr>
						<?php } ?>
						<?php if(isset($rowDatos['DetalleSaldoAnterior'])&&$rowDatos['DetalleSaldoAnterior']!=0){ 
							$Exento = $Exento + $rowDatos['DetalleSaldoAnterior']; ?>
							<tr>
								<td>Saldo Anterior</td>
								<td>Exento</td>
								<td class="text-right">1</td>
								<td class="text-right"><?php echo Valores($rowDatos['DetalleSaldoAnterior'], 0)?></td>
								<td class="text-right"><?php echo '(+) '.Valores($rowDatos['DetalleSaldoAnterior'], 0)?></td>	
							</tr>
						<?php } ?>
						
						
						
					</tbody>
				</table>
				<div class="row text-right" style="margin-top:20px;">
					<div class="col-xs-2 col-xs-offset-8">
						<p>
							<strong>
								TOTAL VENTA NETO : <br>
								AFECTO IVA (19%) : <br>
								EXENTOS : <br>
								TOTAL : <br>
							</strong>
						</p>
					</div>
					<div class="col-xs-2">
						<strong>
							<?php 
							if($rowDatos['DetalleTotalVenta']>0){
								echo Valores(($rowDatos['DetalleTotalVenta']/1.19), 0).'<br>';
								echo Valores(($rowDatos['DetalleTotalVenta']-($rowDatos['DetalleTotalVenta']/1.19)), 0).'<br>';
								echo Valores($Exento, 0).'<br>'; 
								echo Valores($rowDatos['DetalleTotalAPagar'], 0).'<br>'; 
							}else{
								echo Valores(0, 0).'<br>';
								echo Valores(0, 0).'<br>';
								echo Valores(0, 0).'<br>';
								echo Valores(0, 0).'<br>';
							}
							?>
						</strong>
					</div>
				</div>
			</div>
				
			<div class="row">
				<div class="col-xs-12">
					
					<div class="col-sm-6" style="padding-left: 0px;">
						<div class="well well-sm no-shadow" style="background-color: #fff;">
							
						<?php
						//comparacion
						$mayor = 0;
						$mes_01 = $rowDatos['GraficoMes1Valor'];
						$mes_02 = $rowDatos['GraficoMes2Valor'];
						$mes_03 = $rowDatos['GraficoMes3Valor'];
						$mes_04 = $rowDatos['GraficoMes4Valor'];
						$mes_05 = $rowDatos['GraficoMes5Valor'];
						$mes_06 = $rowDatos['GraficoMes6Valor'];
						$mes_07 = $rowDatos['GraficoMes7Valor'];
						$mes_08 = $rowDatos['GraficoMes8Valor'];
						$mes_09 = $rowDatos['GraficoMes9Valor'];
						$mes_10 = $rowDatos['GraficoMes10Valor'];
						$mes_11 = $rowDatos['GraficoMes11Valor'];
						$mes_12 = $rowDatos['GraficoMes12Valor'];
						
						if($mayor<$mes_01){$mayor=$mes_01;}
						if($mayor<$mes_02){$mayor=$mes_02;}
						if($mayor<$mes_03){$mayor=$mes_03;}
						if($mayor<$mes_04){$mayor=$mes_04;}
						if($mayor<$mes_05){$mayor=$mes_05;}
						if($mayor<$mes_06){$mayor=$mes_06;}
						if($mayor<$mes_07){$mayor=$mes_07;}
						if($mayor<$mes_08){$mayor=$mes_08;}
						if($mayor<$mes_09){$mayor=$mes_09;}
						if($mayor<$mes_10){$mayor=$mes_10;}
						if($mayor<$mes_11){$mayor=$mes_11;}
						if($mayor<$mes_12){$mayor=$mes_12;}

						//variables
						$maximo = $mayor + 20;
						$minimo = $mayor * 0.25;
						//alto de los graficos
						$alto_01 = ($mes_01*170)/$maximo;
						$alto_02 = ($mes_02*170)/$maximo;
						$alto_03 = ($mes_03*170)/$maximo;
						$alto_04 = ($mes_04*170)/$maximo;
						$alto_05 = ($mes_05*170)/$maximo;
						$alto_06 = ($mes_06*170)/$maximo;
						$alto_07 = ($mes_07*170)/$maximo;
						$alto_08 = ($mes_08*170)/$maximo;
						$alto_09 = ($mes_09*170)/$maximo;
						$alto_10 = ($mes_10*170)/$maximo;
						$alto_11 = ($mes_11*170)/$maximo;
						$alto_12 = ($mes_12*170)/$maximo;
						
						
						?>

							<div class="graficos">
								<div class="bargraph" style= "width: 362px;">
									<p class="centered">Consumo Ultimos Meses</p> 
									<ul class="bars">
										<li class="bar1"  style="height: <?php echo $alto_01; ?>px;"><?php if($mes_01>$minimo){echo Cantidades($mes_01, $ndecim);}else{echo '<span>'.Cantidades($mes_01, $ndecim).'</span>';} ?></li>
										<li class="bar2"  style="height: <?php echo $alto_02; ?>px;"><?php if($mes_02>$minimo){echo Cantidades($mes_02, $ndecim);}else{echo '<span>'.Cantidades($mes_02, $ndecim).'</span>';} ?></li>
										<li class="bar3"  style="height: <?php echo $alto_03; ?>px;"><?php if($mes_03>$minimo){echo Cantidades($mes_03, $ndecim);}else{echo '<span>'.Cantidades($mes_03, $ndecim).'</span>';} ?></li>
										<li class="bar4"  style="height: <?php echo $alto_04; ?>px;"><?php if($mes_04>$minimo){echo Cantidades($mes_04, $ndecim);}else{echo '<span>'.Cantidades($mes_04, $ndecim).'</span>';} ?></li>
										<li class="bar5"  style="height: <?php echo $alto_05; ?>px;"><?php if($mes_05>$minimo){echo Cantidades($mes_05, $ndecim);}else{echo '<span>'.Cantidades($mes_05, $ndecim).'</span>';} ?></li>
										<li class="bar6"  style="height: <?php echo $alto_06; ?>px;"><?php if($mes_06>$minimo){echo Cantidades($mes_06, $ndecim);}else{echo '<span>'.Cantidades($mes_06, $ndecim).'</span>';} ?></li>
										<li class="bar7"  style="height: <?php echo $alto_07; ?>px;"><?php if($mes_07>$minimo){echo Cantidades($mes_07, $ndecim);}else{echo '<span>'.Cantidades($mes_07, $ndecim).'</span>';} ?></li>
										<li class="bar8"  style="height: <?php echo $alto_08; ?>px;"><?php if($mes_08>$minimo){echo Cantidades($mes_08, $ndecim);}else{echo '<span>'.Cantidades($mes_08, $ndecim).'</span>';} ?></li>
										<li class="bar9"  style="height: <?php echo $alto_09; ?>px;"><?php if($mes_09>$minimo){echo Cantidades($mes_09, $ndecim);}else{echo '<span>'.Cantidades($mes_09, $ndecim).'</span>';} ?></li>
										<li class="bar10" style="height: <?php echo $alto_10; ?>px;"><?php if($mes_10>$minimo){echo Cantidades($mes_10, $ndecim);}else{echo '<span>'.Cantidades($mes_10, $ndecim).'</span>';} ?></li>
										<li class="bar11" style="height: <?php echo $alto_11; ?>px;"><?php if($mes_11>$minimo){echo Cantidades($mes_11, $ndecim);}else{echo '<span>'.Cantidades($mes_11, $ndecim).'</span>';} ?></li>
										<li class="bar12" style="height: <?php echo $alto_12; ?>px;"><?php if($mes_12>$minimo){echo Cantidades($mes_12, $ndecim);}else{echo '<span>'.Cantidades($mes_12, $ndecim).'</span>';} ?></li>
									</ul>
									<ul class="label">
										<li><?php echo $rowDatos['GraficoMes1Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes2Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes3Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes4Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes5Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes6Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes7Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes8Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes9Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes10Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes11Fecha']; ?></li>
										<li><?php echo $rowDatos['GraficoMes12Fecha']; ?></li>	
									</ul>
								</div>
							</div>
						</div>
						<div class="well well-sm no-shadow" style="background-color: #fff;">
							<strong>Detalle de Consumo</strong>
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
								<br/>
									<div class="pull-left">Adicionales por prorrateo</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['DetConsProrateo']>0){
											$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo'];
										}elseif($rowDatos['DetConsProrateo']<0){
											$bla = $rowDatos['DetConsProrateoSigno'].' '.$rowDatos['DetConsProrateo']*-1;
										}else{
											$bla = '(+) 0';
										}
										echo $bla.' m3';?>
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
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
							
					<div class="col-sm-6 well well-sm no-shadow" style="background-color: #fff;">
						<strong>Aguas Informa</strong>
							<p>
								Los Valores proporcionales con IVA para los consumos realizados<br/>
								a partir del 20-01-2016
								
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
								if(isset($rowDatos['ClienteRemarcador'])&&$rowDatos['ClienteRemarcador']!=''&&$rowDatos['ClienteRemarcador']!=0){?>
								<br/>
									<div class="pull-left">Diferencia medidor general</div>
									<small class="pull-right">
										<?php 
										if($rowDatos['AguasInfDifMedGeneral']>0){
											$bla = '(+)'.Cantidades($rowDatos['AguasInfDifMedGeneral'], 2);
										}elseif($rowDatos['AguasInfDifMedGeneral']<0){
											$bla = '(-)'.Cantidades($rowDatos['AguasInfDifMedGeneral']*-1, 2);
										}else{
											$bla = '(+)0';
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
		</section>
		
		<div class="row">
				<div class="col-xs-12">
					<div class="col-sm-12 well well-sm no-shadow" style="background-color: #fff;">
						<p><?php echo 'Son: '.numtoletras($rowDatos['DetalleTotalAPagar']); ?></p>
					</div>
				</div>
			</div>
			
	</div>	

<?php } ?>		

	 
	






 
          

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
