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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Cliente</h3>
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
// Se traen todos los datos de mi usuario
$query = "SELECT  
clientes_listado.email, 
clientes_listado.Nombre, 
clientes_listado.Rut, 
clientes_listado.fNacimiento, 
clientes_listado.Direccion, 
clientes_listado.Fono1, 
clientes_listado.Fono2, 
clientes_listado.Fax,
clientes_listado.PersonaContacto,
clientes_listado.Web,
clientes_listado.Giro,
clientes_listado.UnidadHabitacional,
clientes_listado.Identificador,
clientes_listado.Arranque,
clientes_listado.latitud,
clientes_listado.longitud,
mnt_ubicacion_ciudad.Nombre AS nombre_region,
mnt_ubicacion_comunas.Nombre AS nombre_comuna,
clientes_estado.Nombre AS estado,
core_sistemas.Nombre AS sistema,
clientes_tipos.Nombre AS tipoCliente,
marcadores_listado.Nombre AS medidor,
marcadores_remarcadores.Nombre AS remarcador,
clientes_estadopago.Nombre AS EstadoPago,
clientes_facturable.Nombre AS DocFacturable,
ciudad.Nombre AS nombre_region_fact,
comuna.Nombre AS nombre_comuna_fact,
clientes_listado.DireccionFact,
clientes_listado.RazonSocial,
analisis_aguas_tipo_punto_muestreo.Nombre AS TipoPunto,
analisis_sectores.Nombre AS Sector

FROM `clientes_listado`
LEFT JOIN `clientes_estado`                     ON clientes_estado.idEstado                             = clientes_listado.idEstado
LEFT JOIN `mnt_ubicacion_ciudad`                ON mnt_ubicacion_ciudad.idCiudad                        = clientes_listado.idCiudad
LEFT JOIN `mnt_ubicacion_comunas`               ON mnt_ubicacion_comunas.idComuna                       = clientes_listado.idComuna
LEFT JOIN `core_sistemas`                       ON core_sistemas.idSistema                              = clientes_listado.idSistema
LEFT JOIN `clientes_tipos`                      ON clientes_tipos.idTipo                                = clientes_listado.idTipo
LEFT JOIN `marcadores_listado`                  ON marcadores_listado.idMarcadores                      = clientes_listado.idMarcadores
LEFT JOIN `marcadores_remarcadores`             ON marcadores_remarcadores.idRemarcadores               = clientes_listado.idRemarcadores
LEFT JOIN `clientes_estadopago`                 ON clientes_estadopago.idEstadoPago                     = clientes_listado.idEstadoPago
LEFT JOIN `clientes_facturable`                 ON clientes_facturable.idFacturable                     = clientes_listado.idFacturable
LEFT JOIN `mnt_ubicacion_ciudad`   ciudad       ON ciudad.idCiudad                                      = clientes_listado.idCiudadFact
LEFT JOIN `mnt_ubicacion_comunas`  comuna       ON comuna.idComuna                                      = clientes_listado.idComunaFact
LEFT JOIN `analisis_aguas_tipo_punto_muestreo`  ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo   = clientes_listado.idPuntoMuestreo
LEFT JOIN `analisis_sectores`                   ON analisis_sectores.idSector                           = clientes_listado.idSector

WHERE clientes_listado.idCliente =  {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
clientes_observaciones.Fecha,
clientes_observaciones.Observacion
FROM `clientes_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = clientes_observaciones.idUsuario
WHERE clientes_observaciones.idCliente = {$_GET['view']}
ORDER BY clientes_observaciones.idObservacion ASC 
LIMIT 15 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}

// Se trae un listado con todas las observaciones el cliente
$arrPagos = array();
$query = "SELECT 
clientes_pago.idPago,
facturacion_listado_detalle_tipo_pago.Nombre AS TipoPago,
clientes_pago.nDocPago,
clientes_pago.fechaPago,
clientes_pago.montoPago

FROM `clientes_pago`
LEFT JOIN `facturacion_listado_detalle_tipo_pago` ON facturacion_listado_detalle_tipo_pago.idTipoPago     = clientes_pago.idTipoPago
WHERE clientes_pago.idCliente = {$_GET['view']}
ORDER BY clientes_pago.fechaPago DESC 
LIMIT 30 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagos,$row );
}

//obtengo las facturaciones 
$arrFacturaciones = array();
$query = "SELECT 
facturacion_listado_detalle.idFacturacionDetalle,
facturacion_listado_detalle.DetalleTotalAPagar, 
facturacion_listado_detalle.AguasInfFechaEmision,
facturacion_listado_detalle.idMes,
facturacion_listado_detalle.Ano,
facturacion_listado_detalle.DetalleConsumoCantidad,
facturacion_listado_detalle.DetalleRecoleccionCantidad,
facturacion_listado_detalle.fechaPago,
facturacion_listado_detalle.montoPago,
facturacion_listado_detalle.SII_NDoc,
clientes_facturable.Nombre AS Facturable,
facturacion_listado_detalle_estado.Nombre AS Estado,
facturacion_listado_detalle.idPago,
facturacion_listado_detalle.DetalleSaldoAnterior

FROM `facturacion_listado_detalle`
LEFT JOIN `facturacion_listado_detalle_estado`  ON facturacion_listado_detalle_estado.idEstado   = facturacion_listado_detalle.idEstado
LEFT JOIN `clientes_facturable`                 ON clientes_facturable.idFacturable              = facturacion_listado_detalle.SII_idFacturable
WHERE facturacion_listado_detalle.idCliente = '{$_GET['view']}'
ORDER BY facturacion_listado_detalle.Ano DESC, facturacion_listado_detalle.idMes DESC
LIMIT 30 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturaciones,$row );
}

//obtengo las facturaciones 
$arrConsumos = array();
$query = "SELECT idMes, Ano, DetalleConsumoCantidad, DetalleRecoleccionCantidad
FROM `facturacion_listado_detalle`
WHERE idCliente = '{$_GET['view']}'
ORDER BY Ano ASC, idMes ASC
LIMIT 12 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrConsumos,$row );
}

// Se trae un listado con todas las observaciones el cliente
$arrEventos = array();
$query = "SELECT 
clientes_eventos_tipos.Nombre AS TipoEvento,
clientes_eventos.FechaEjecucion,
clientes_eventos.Observacion,
clientes_eventos.ValorEvento

FROM `clientes_eventos`
LEFT JOIN `clientes_eventos_tipos` ON clientes_eventos_tipos.idTipo     = clientes_eventos.idTipo
WHERE clientes_eventos.idCliente = {$_GET['view']}
ORDER BY clientes_eventos.Fecha DESC 
LIMIT 30 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrEventos,$row );
}

// Se trae un listado con todas las observaciones el cliente
$arrOtros = array();
$query = "SELECT  FechaEjecucion, Observacion, ValorCargo
FROM `clientes_otros_cargos`
WHERE idCliente = {$_GET['view']}
ORDER BY Fecha DESC 
LIMIT 30 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrOtros,$row );
}




?>




<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Cliente <?php echo $rowdata['Identificador']; ?></h5>
			<div class="toolbar"></div>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>
				<li class=""><a href="#consumos" data-toggle="tab">Consumos</a></li>
				<li class=""><a href="#pagos" data-toggle="tab">Pagos</a></li>
				<li class=""><a href="#facturaciones" data-toggle="tab">Facturaciones</a></li>
				<li class=""><a href="#eventos" data-toggle="tab">Eventos</a></li>
				<li class=""><a href="#otroscobros" data-toggle="tab">Otros Cobros</a></li>
			
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">
					
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th width="50%" class="word_break">Datos</th>
									<th width="50%">Mapa</th>
								</tr>
							</thead>
											  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd">
									<td class="word_break">
										
										<h2 class="text-primary">Datos Basicos</h2>
										<p class="text-muted">
											<strong>Tipo de Cliente : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
											<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
											<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
											<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
											<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
											<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
											<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
											<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?>
										</p>
											
										<h2 class="text-primary">Datos de Contacto</h2>
										<p class="text-muted">
											<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
											<strong>Telefono 1 : </strong><?php echo $rowdata['Fono1']; ?><br/>
											<strong>Telefono 2 : </strong><?php echo $rowdata['Fono2']; ?><br/>
											<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
											<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
											<strong>Web : </strong><a target="_new" href="http://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
										</p>
										
										<h2 class="text-primary">Datos de Facturacion</h2>
										<p class="text-muted">
											<strong>Identificador : </strong><?php echo $rowdata['Identificador']; ?><br/>
											<strong>ID medidor : </strong><?php echo $rowdata['medidor']; ?><br/>
											<strong>ID remarcador : </strong><?php echo $rowdata['remarcador']; ?><br/>
											<strong>Unidades Habitacionales : </strong><?php echo $rowdata['UnidadHabitacional']; ?><br/>
											<strong>Arranque : </strong><?php echo $rowdata['Arranque']; ?> mm<br/>
											<strong>Estado : </strong><?php echo $rowdata['EstadoPago']; ?><br/>
											<strong>Forma Facturacion : </strong><?php echo $rowdata['DocFacturable']; ?><br/>
											<strong>Region Facturacion : </strong><?php echo $rowdata['nombre_region_fact']; ?><br/>
											<strong>Ciudad Facturacion : </strong><?php echo $rowdata['nombre_comuna_fact']; ?><br/>
											<strong>Direccion Facturacion : </strong><?php echo $rowdata['DireccionFact']; ?><br/>
											<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
											<strong>Razon Social de la empresa: </strong><?php echo $rowdata['RazonSocial']; ?><br/>
											
										</p>
										
										<h2 class="text-primary">Datos de Medicion</h2>
										<p class="text-muted">
											<strong>Sector : </strong><?php echo $rowdata['Sector']; ?><br/>
											<strong>Tipo de Medicion : </strong><?php echo $rowdata['TipoPunto']; ?><br/>
										</p>
										
									</td>
									<td>
										<?php echo mapa1($rowdata["latitud"], $rowdata["longitud"], $rowdata['Identificador']) ?>
									</td>
								</tr>                  
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="observaciones">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Autor</th>
									<th width="120">Fecha</th>
									<th>Observacion</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrObservaciones as $observaciones) { ?>
								<tr class="odd">		
									<td><?php echo $observaciones['nombre_usuario']; ?></td>
									<td><?php echo $observaciones['Fecha']; ?></td>		
									<td class="word_break"><?php echo $observaciones['Observacion']; ?></td>	
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="consumos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<script>
							google.charts.load('current', {packages: ['corechart', 'bar']});
							google.charts.setOnLoadCallback(drawAnnotations);

							function drawAnnotations() {
								  var data = new google.visualization.DataTable();
								  data.addColumn('string', 'Fecha');
								  data.addColumn('number', 'Consumo');
								  data.addColumn({type: 'string', role: 'annotation'});
								  data.addColumn('number', 'Recoleccion');
								  data.addColumn({type: 'string', role: 'annotation'});

								  data.addRows([
									<?php foreach ($arrConsumos as $fac) { ?>
										['<?php echo numero_a_mes($fac['idMes']).' '.$fac['Ano']; ?>',   <?php echo $fac['DetalleConsumoCantidad']; ?>, '<?php echo cantidades($fac['DetalleConsumoCantidad'],0); ?>',  <?php echo $fac['DetalleRecoleccionCantidad']; ?>, '<?php echo cantidades($fac['DetalleRecoleccionCantidad'],0); ?>'],
									<?php } ?>
									
								  ]);

								  var options = {
									title: 'Consumos Ultimos Meses',
									width: $(window).width()*0.75,
									height: 500,
									annotations: {
									  alwaysOutside: true,
									  textStyle: {
										fontSize: 14,
										color: '#000',
										auraColor: 'none'
									  }
									},
									hAxis: { title: 'Meses', },
									vAxis: { title: 'Comsumos m3' },
								  };

								  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
								  chart.draw(data, options);
								}
							
							
							
							
						</script>
						<div id="chart_div" style="height: 500px;"></div>
						
						
					</div>
				</div>
			</div>
			
			
			
			<div class="tab-pane fade" id="pagos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th width="120">N° Transaccion</th>
									<th width="120">Fecha</th>
									<th>Forma de Pago</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrPagos as $pagos) { ?>
								<tr class="odd">
									<td><?php echo n_doc($pagos['idPago'], 8); ?></td>		
									<td><?php echo fecha_estandar($pagos['fechaPago']); ?></td>		
									<td><?php echo $pagos['TipoPago'].' '.$pagos['nDocPago']; ?></td>
									<td><?php echo valores($pagos['montoPago'], 0); ?></td>	
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
			
			<div class="tab-pane fade" id="facturaciones">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Fecha</th>
									<th>Valor</th>
									<th>Saldo Anterior</th>
									<th>Estado</th>
									<th>SII</th>
									<th width="120">N° Transaccion</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrFacturaciones as $fac) { ?>
									<tr class="odd">
										<td>
											<a href="<?php echo 'view_facturacion.php?view='.$fac['idFacturacionDetalle']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>
											<?php echo numero_a_mes($fac['idMes']).' '.$fac['Ano']; ?>
										</td>
										<td><?php echo  Valores($fac['DetalleTotalAPagar'], 0); ?></td>
										<td><?php echo  Valores($fac['DetalleSaldoAnterior'], 0); ?></td>
										<td><?php echo $fac['Estado'];
										if($fac['fechaPago']!='0000-00-00'){
											echo ' ('.fecha_estandar($fac['fechaPago']).' -> '.Valores($fac['montoPago'], 0).')';
										}
										 ?></td>
										<td><?php echo $fac['Facturable'].' '.$fac['SII_NDoc']; ?></td>
										<td><?php if($fac['idPago']!=0){echo n_doc($fac['idPago'], 8);} ?></td>	
									</tr>
								<?php } ?>                     
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
			
			<div class="tab-pane fade" id="eventos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Fecha</th>
									<th>Tipo</th>
									<th>Observacion</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrEventos as $eventos) { ?>
									<tr class="odd">
										<td><?php echo  fecha_estandar($eventos['FechaEjecucion']); ?></td>
										<td><?php echo  $eventos['TipoEvento']; ?></td>
										<td><?php echo  $eventos['Observacion']; ?></td>
										<td><?php echo  Valores($eventos['ValorEvento'], 0); ?></td>
									</tr>
								<?php } ?>                     
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
					
			
			<div class="tab-pane fade" id="otroscobros">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Fecha</th>
									<th>Observacion</th>
									<th>Valor</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrOtros as $otros) { ?>
									<tr class="odd">
										<td><?php echo  fecha_estandar($otros['FechaEjecucion']); ?></td>
										<td><?php echo  $otros['Observacion']; ?></td>
										<td><?php echo  Valores($otros['ValorCargo'], 0); ?></td>
									</tr>
								<?php } ?>                     
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			
        </div>	
	</div>
</div>
















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
