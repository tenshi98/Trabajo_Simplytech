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
$original = "clientes_pagos.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idCliente';
	$form_trabajo= 'search';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_clientes_pagos.php';
}
//formulario para editar
if ( !empty($_POST['submit_pago']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'fechaPago,idTipoPago,montoPago,idUsuarioPago';
	$form_trabajo= 'pago';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_clientes_pagos.php';
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
<?php 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Pago Realizado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['pagar']) ) { 
//obtengo los datos del cliente
$query = "SELECT Nombre, Identificador
FROM `clientes_listado`
WHERE idCliente = '{$_GET['idCliente']}' ";
$resultado = mysqli_query ($dbConn, $query);
$rowCliente = mysqli_fetch_assoc ($resultado);

//obtengo los datos de la facturacion
$query = "SELECT 
idFacturacionDetalle,
Fecha,
DetalleCargoFijoValor,
DetalleConsumoValor,
DetalleRecoleccionValor,
DetalleVisitaCorte,
DetalleCorte1Valor,
DetalleCorte2Valor,
DetalleReposicion1Valor,
DetalleReposicion2Valor,
DetalleInteresDeuda,
DetalleSaldoFavor,
DetalleSaldoAnterior,
DetalleOtrosCargos1Valor,
DetalleOtrosCargos2Valor,
DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,
DetalleOtrosCargos5Valor,
DetalleTotalAPagar, 
montoPago

FROM `facturacion_listado_detalle`
WHERE idCliente = '{$_GET['idCliente']}'
AND idEstado = 1
ORDER BY Ano DESC, idMes DESC
LIMIT 1";
$resultado = mysqli_query ($dbConn, $query);
$rowFacturacion = mysqli_fetch_assoc ($resultado);
?>
 
 
<div class="row inbox"> 
	<div class="col-lg-12">
		<h2><strong>Cliente : </strong><?php echo $rowCliente['Identificador']; ?></h2>
		<hr>	
	</div>
</div> 
 

<div class="row inbox">
  						
	  
	
	<div class="col-md-4">
		<ul class="list-group inbox-options">
			<li class="list-group-item"><i class="fa fa-inbox"></i>  Facturacion <?php echo Fecha_mes_año($rowFacturacion['Fecha']);?></li>
			<li class="list-group-item">		
				<div class="pull-left">Cargo Fijo Cliente</div>
				<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleCargoFijoValor'], 0); ?></small>
				<br/>
				
				<?php if(isset($rowFacturacion['DetalleConsumoValor'])&&$rowFacturacion['DetalleConsumoValor']!='0'){ ?>
					<div class="pull-left">Consumo Agua Potable</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleConsumoValor'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleRecoleccionValor'])&&$rowFacturacion['DetalleRecoleccionValor']!='0'){ ?>
					<div class="pull-left">Recoleccion de Aguas Servidas</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleRecoleccionValor'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleVisitaCorte'])&&$rowFacturacion['DetalleVisitaCorte']!='0'){ ?>
					<div class="pull-left">Visita Corte</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleVisitaCorte'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleCorte1Valor'])&&$rowFacturacion['DetalleCorte1Valor']!='0'){ ?>
					<div class="pull-left">Corte 1° instancia</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleCorte1Valor'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleCorte2Valor'])&&$rowFacturacion['DetalleCorte2Valor']!='0'){ ?>
					<div class="pull-left">Corte 2° instancia</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleCorte2Valor'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleReposicion1Valor'])&&$rowFacturacion['DetalleReposicion1Valor']!='0'){ ?>
					<div class="pull-left">Reposicion 1° instancia</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleReposicion1Valor'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleReposicion2Valor'])&&$rowFacturacion['DetalleReposicion2Valor']!='0'){ ?>
					<div class="pull-left">Reposicion 2° instancia</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleReposicion2Valor'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleInteresDeuda'])&&$rowFacturacion['DetalleInteresDeuda']!='0'){ ?>
					<div class="pull-left">Interes Deuda</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleInteresDeuda'], 0); ?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleSaldoFavor'])&&$rowFacturacion['DetalleSaldoFavor']!='0'){ ?>
					<div class="pull-left">Saldo a Favor</div>
					<small class="pull-right"><?php echo '(-) '.Valores($rowFacturacion['DetalleSaldoFavor'], 0)?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleSaldoAnterior'])&&$rowFacturacion['DetalleSaldoAnterior']!='0'){ ?>
					<div class="pull-left">Saldo Anterior</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleSaldoAnterior'], 0)?></small>
					<br/>
				<?php } ?>	
				
				<?php if(isset($rowFacturacion['DetalleOtrosCargos1Valor'])&&$rowFacturacion['DetalleOtrosCargos1Valor']!='0'){ ?>
					<div class="pull-left">Otros Cargos 1</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos1Valor'], 0)?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleOtrosCargos2Valor'])&&$rowFacturacion['DetalleOtrosCargos2Valor']!='0'){ ?>
					<div class="pull-left">Otros Cargos 2</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos2Valor'], 0)?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleOtrosCargos3Valor'])&&$rowFacturacion['DetalleOtrosCargos3Valor']!='0'){ ?>
					<div class="pull-left">Otros Cargos 3</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos3Valor'], 0)?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleOtrosCargos4Valor'])&&$rowFacturacion['DetalleOtrosCargos4Valor']!='0'){ ?>
					<div class="pull-left">Otros Cargos 4</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos4Valor'], 0)?></small>
					<br/>
				<?php } ?>
				<?php if(isset($rowFacturacion['DetalleOtrosCargos5Valor'])&&$rowFacturacion['DetalleOtrosCargos5Valor']!='0'){ ?>
					<div class="pull-left">Otros Cargos 5</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos5Valor'], 0)?></small>
					<br/>
				<?php } ?>
	
			</li>
			<?php if($rowFacturacion['montoPago']!=0){?>
				<li class="list-group-item">
					
					<div class="pull-left">Pagado</div>
					<small class="pull-right"><?php echo '(-) '.Valores($rowFacturacion['montoPago'], 0); ?></small>
					<br/>
					
				</li>
			<?php } ?>
			<li class="list-group-item">
				
				<div class="pull-left">TOTAL A PAGAR</div>
				<?php $calculo = $rowFacturacion['DetalleTotalAPagar'] - $rowFacturacion['montoPago']; ?>
				<small class="pull-right"><strong><?php echo Valores($calculo, 0); ?></strong></small>
				<br/>
				
			</li>
		</ul>
  	
	</div>
	

	
	<div class="col-lg-8">
		<div class="col-lg-8">
			
			<ul class="list-group inbox-options">
				<form class="form-horizontal" method="post" name="form1" >
					<li class="list-group-item"><i class="fa fa-inbox"></i>  Pago</li>
					<li class="list-group-item">		
						<?php 
						//Se verifican si existen los datos
						if(isset($fechaPago)) {    $x1  = $fechaPago;     }else{$x1  = '';}
						if(isset($idTipoPago)) {   $x2  = $idTipoPago;    }else{$x2  = '';}
						if(isset($nDocPago)) {     $x3  = $nDocPago;      }else{$x3  = '';}
						if(isset($montoPago)) {    $x4  = $montoPago;     }else{$x4  = '';}
						
						//se dibujan los inputs
						echo form_date('Fecha Pago','fechaPago', $x1, 2);
						echo form_select('Documento de Pago','idTipoPago', $x2, 2, 'idTipoPago', 'Nombre', 'facturacion_listado_detalle_tipo_pago', 0, $dbConn);
						echo form_input('text', 'N° Documento', 'nDocPago', $x3, 1);
						echo '<div class="form-group" id="div_">
							<label class="control-label col-lg-4" id="label_">Total a Pagar</label>
							<div class="col-lg-8">
								<input value="'.Valores($calculo, 0).'" type="text" placeholder="Unidad de Medida" class="form-control"  name="unimed" id="unimed" disabled >
							</div>
						</div>';
						echo form_values('Monto Pagado', 'montoPago', $x4, 2);
						
						echo '<input type="hidden" name="idUsuarioPago"   value="'.$arrUsuario['idUsuario'].'">';
						echo '<input type="hidden" name="idCliente"   value="'.$_GET['idCliente'].'">';
						echo '<input type="hidden" name="idFacturacionDetalle"   value="'.$rowFacturacion['idFacturacionDetalle'].'">';
						
						?>

					</li>
					<li class="list-group-item">
						<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Realizar Pago" name="submit_pago">
						<div class="clearfix"></div>
					</li>
				</form> 
			</ul>
			
		</div> 
	</div> 
							
</div>






 
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" >
<a href="<?php echo $location.'&idCliente='.$_GET['idCliente']; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div> 

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['idCliente']) ) { 
//obtengo los datos del cliente
$query = "SELECT Nombre, Identificador
FROM `clientes_listado`
WHERE idCliente = '{$_GET['idCliente']}' ";
$resultado = mysqli_query ($dbConn, $query);
$rowCliente = mysqli_fetch_assoc ($resultado);

//obtengo los datos de la ultima facturacion
$query = "SELECT 
DetalleCargoFijoValor,
DetalleConsumoValor,
DetalleRecoleccionValor,
DetalleVisitaCorte,
DetalleCorte1Valor,
DetalleCorte2Valor,
DetalleReposicion1Valor,
DetalleReposicion2Valor,
DetalleInteresDeuda,
DetalleSaldoFavor,

DetalleSaldoAnterior,
DetalleOtrosCargos1Valor,
DetalleOtrosCargos2Valor,
DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,
DetalleOtrosCargos5Valor,

DetalleTotalAPagar, 
montoPago

FROM `facturacion_listado_detalle`
WHERE idCliente = '{$_GET['idCliente']}'
AND idEstado = 1
ORDER BY Ano DESC, idMes DESC
LIMIT 1";
$resultado = mysqli_query ($dbConn, $query);
$rowFacturacion = mysqli_fetch_assoc ($resultado);

//obtengo las facturaciones atrasadas
$arrFacturaciones = array();
$query = "SELECT 
facturacion_listado_detalle.idFacturacionDetalle,
facturacion_listado_detalle.DetalleTotalAPagar, 
facturacion_listado_detalle.AguasInfFechaEmision,
facturacion_listado_detalle.idMes,
facturacion_listado_detalle.Ano,
facturacion_listado_detalle_estado.Nombre AS Estado
FROM `facturacion_listado_detalle`
LEFT JOIN `facturacion_listado_detalle_estado` ON facturacion_listado_detalle_estado.idEstado = facturacion_listado_detalle.idEstado
WHERE facturacion_listado_detalle.idCliente = '{$_GET['idCliente']}'
AND facturacion_listado_detalle.idEstado = 1
ORDER BY facturacion_listado_detalle.Ano ASC, facturacion_listado_detalle.idMes DESC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturaciones,$row );
}				
					 
?>
 
<div class="row inbox"> 
	<div class="col-lg-12">
		<h2><strong>Cliente : </strong><?php echo $rowCliente['Identificador']; ?></h2>
		<hr>	
	</div>
</div>
 
<?php if(isset($rowFacturacion['DetalleTotalAPagar'])&&$rowFacturacion['DetalleTotalAPagar']!=''){ ?>
	<div class="row inbox">
							
		<div class="col-lg-8">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>Facturaciones Pendientes</h5>
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Año</th>
								<th>Mes</th>
								<th>Estado</th>
								<th>Total</th>
								<th width="120">Acciones</th>
							</tr>
						</thead>			  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrFacturaciones as $fac) { ?>
							<tr class="odd">
								<td><?php echo $fac['Ano']; ?></td>
								<td><?php echo numero_a_mes($fac['idMes']); ?></td>
								<td><?php echo $fac['Estado']; ?></td>
								<td><?php echo  Valores($fac['DetalleTotalAPagar'], 0); ?></td>
								<td>
									<div class="btn-group widthtd120" >
										<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_facturacion.php?view='.$fac['idFacturacionDetalle']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
																		
									</div>
								</td>
							</tr>
						<?php } ?>                    
						</tbody>
					</table>
				</div>
			</div>
		</div>  



		
		<div class="col-md-4 mail-left-box">
			<ul class="list-group inbox-options">
				<li class="list-group-item"><i class="fa fa-inbox"></i>  Detalle Ultima Facturacion</li>
				<li class="list-group-item">		
					<div class="pull-left">Cargo Fijo Cliente</div>
					<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleCargoFijoValor'], 0); ?></small>
					<br/>
					
					<?php if(isset($rowFacturacion['DetalleConsumoValor'])&&$rowFacturacion['DetalleConsumoValor']!='0'){ ?>
						<div class="pull-left">Consumo Agua Potable</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleConsumoValor'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleRecoleccionValor'])&&$rowFacturacion['DetalleRecoleccionValor']!='0'){ ?>
						<div class="pull-left">Recoleccion de Aguas Servidas</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleRecoleccionValor'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleVisitaCorte'])&&$rowFacturacion['DetalleVisitaCorte']!='0'){ ?>
						<div class="pull-left">Visita Corte</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleVisitaCorte'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleCorte1Valor'])&&$rowFacturacion['DetalleCorte1Valor']!='0'){ ?>
						<div class="pull-left">Corte 1° instancia</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleCorte1Valor'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleCorte2Valor'])&&$rowFacturacion['DetalleCorte2Valor']!='0'){ ?>
						<div class="pull-left">Corte 2° instancia</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleCorte2Valor'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleReposicion1Valor'])&&$rowFacturacion['DetalleReposicion1Valor']!='0'){ ?>
						<div class="pull-left">Reposicion 1° instancia</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleReposicion1Valor'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleReposicion2Valor'])&&$rowFacturacion['DetalleReposicion2Valor']!='0'){ ?>
						<div class="pull-left">Reposicion 2° instancia</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleReposicion2Valor'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleInteresDeuda'])&&$rowFacturacion['DetalleInteresDeuda']!='0'){ ?>
						<div class="pull-left">Interes Deuda</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleInteresDeuda'], 0); ?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleSaldoFavor'])&&$rowFacturacion['DetalleSaldoFavor']!='0'){ ?>
						<div class="pull-left">Saldo a Favor</div>
						<small class="pull-right"><?php echo '(-) '.Valores($rowFacturacion['DetalleSaldoFavor'], 0)?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleSaldoAnterior'])&&$rowFacturacion['DetalleSaldoAnterior']!='0'){ ?>
						<div class="pull-left">Saldo Anterior</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleSaldoAnterior'], 0)?></small>
						<br/>
					<?php } ?>	
					
					<?php if(isset($rowFacturacion['DetalleOtrosCargos1Valor'])&&$rowFacturacion['DetalleOtrosCargos1Valor']!='0'){ ?>
						<div class="pull-left">Otros Cargos 1</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos1Valor'], 0)?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleOtrosCargos2Valor'])&&$rowFacturacion['DetalleOtrosCargos2Valor']!='0'){ ?>
						<div class="pull-left">Otros Cargos 2</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos2Valor'], 0)?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleOtrosCargos3Valor'])&&$rowFacturacion['DetalleOtrosCargos3Valor']!='0'){ ?>
						<div class="pull-left">Otros Cargos 3</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos3Valor'], 0)?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleOtrosCargos4Valor'])&&$rowFacturacion['DetalleOtrosCargos4Valor']!='0'){ ?>
						<div class="pull-left">Otros Cargos 4</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos4Valor'], 0)?></small>
						<br/>
					<?php } ?>
					<?php if(isset($rowFacturacion['DetalleOtrosCargos5Valor'])&&$rowFacturacion['DetalleOtrosCargos5Valor']!='0'){ ?>
						<div class="pull-left">Otros Cargos 5</div>
						<small class="pull-right"><?php echo '(+) '.Valores($rowFacturacion['DetalleOtrosCargos5Valor'], 0)?></small>
						<br/>
					<?php } ?>
				</li>
				<?php if($rowFacturacion['montoPago']!=0){?>
					<li class="list-group-item">
						
						<div class="pull-left">Pagado</div>
						<small class="pull-right"><?php echo '(-) '.Valores($rowFacturacion['montoPago'], 0); ?></small>
						<br/>
						
					</li>
				<?php } ?>
				<li class="list-group-item">
					
					<div class="pull-left">TOTAL A PAGAR</div>
					<?php $calculo = $rowFacturacion['DetalleTotalAPagar'] - $rowFacturacion['montoPago']; ?>
					<small class="pull-right"><strong><?php echo Valores($calculo, 0); ?></strong></small>
					<br/>
					
				</li>
			</ul>
		
		</div> 
								
	</div>



<?php } else{ ?>
<p class="bg-primary" style="padding: 10px;">Este cliente no registra ninguna deuda</p>
<?php }  ?>
 
<div class="clearfix"></div>
<?php if ($rowlevel['level']>=4){?>
	<div class="col-lg-12 fcenter" >
		<?php if($rowFacturacion['DetalleTotalAPagar']!=0){ ?>
		<a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&pagar=true'; ?>"  class="btn btn-primary fright margin_width" data-original-title="" title="">Pagar</a>
		<?php } ?>
		<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
		<div class="clearfix"></div>
	</div> 
<?php } ?> 

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  {
//filtro sistema
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'clientes_listado.idSistema>0';
}else{
	$z = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
}	
	
	
	 ?>
	
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Seleccionar cliente</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1" >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;        }else{$x1  = '';}
				if(isset($nCliente)) {         $x2  = $nCliente;         }else{$x2  = '';}
				
				
				//se dibujan los inputs
				echo form_select_filter_custom('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador', 'clientes_listado', $z, 'Identificador', $dbConn);
				
				echo '<div class="form-group" id="div_">
					<label class="control-label col-lg-4" id="label_">Nombre Cliente</label>
					<div class="col-lg-8">
						<input type="text" placeholder="Nombre Cliente" class="form-control"  name="nCliente" id="nCliente" disabled value="'.$x2.'">
					</div>
				</div>';
				
				//Imprimo las variables
				$arrClientes = array();
				$query = "SELECT idCliente,Nombre AS NombreCliente
				FROM `clientes_listado`
				WHERE ".$z."
				ORDER BY idCliente";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				
				echo '<script>';
				foreach ($arrClientes as $tipo) {
					echo 'var nombre_cliente_'.$tipo['idCliente'].'= "'.$tipo['NombreCliente'].'";';	
				}
				
				
			
				?>
				document.getElementById("idCliente").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idCliente").value;
					if (Componente != "") {
						nombre_cliente  = eval("nombre_cliente_" + Componente)
						var elem1       = document.getElementById("nCliente");
						elem1.value     = nombre_cliente;
					}
				}
				</script>
				
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Buscar" name="submit">
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
