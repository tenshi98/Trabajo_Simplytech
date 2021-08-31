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
$original = "aguas_clientes_pago.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idClienteFilt']) && $_GET['idClienteFilt'] != ''){  $location .= "&idCliente=".$_GET['idClienteFilt'];    $search .= "&idCliente=".$_GET['idClienteFilt'];}
if(isset($_GET['fechaPago']) && $_GET['fechaPago'] != ''){          $location .= "&fechaPago=".$_GET['fechaPago'];        $search .= "&fechaPago=".$_GET['fechaPago'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit_pago']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'pago';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_pago.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Pago realizado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['pagar']) ) { 
//obtengo los datos del cliente
$query = "SELECT Nombre, Identificador
FROM `aguas_clientes_listado`
WHERE idCliente = '".$_GET['idCliente']."'";
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
$rowCliente = mysqli_fetch_assoc ($resultado);

//obtengo los datos de la ultima facturacion
$query = "SELECT 
idFacturacionDetalle,Fecha,DetalleCargoFijoValor,DetalleConsumoValor,
DetalleRecoleccionValor,DetalleVisitaCorte,DetalleCorte1Valor,DetalleCorte2Valor,
DetalleReposicion1Valor,DetalleReposicion2Valor,DetalleInteresDeuda,DetalleSaldoFavor,

DetalleSaldoAnterior,DetalleOtrosCargos1Valor,DetalleOtrosCargos2Valor,DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,DetalleOtrosCargos5Valor,

DetalleTotalAPagar, montoPago

FROM `aguas_facturacion_listado_detalle`
WHERE idCliente = '".$_GET['idCliente']."'
AND idEstado = 1
ORDER BY Ano DESC, idMes DESC
LIMIT 1";
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
			<li class="list-group-item"><i class="fa fa-inbox" aria-hidden="true"></i>  Facturacion <?php echo Fecha_estandar($rowFacturacion['Fecha']);?></li>
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
		<div class="">
			
			<ul class="list-group inbox-options">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate >
					<li class="list-group-item"><i class="fa fa-inbox" aria-hidden="true"></i>  Pago</li>
					<li class="list-group-item">		
						<?php 
						//Se verifican si existen los datos
						if(isset($fechaPago)) {    $x1  = $fechaPago;     }else{$x1  = '';}
						if(isset($idTipoPago)) {   $x2  = $idTipoPago;    }else{$x2  = '';}
						if(isset($nDocPago)) {     $x3  = $nDocPago;      }else{$x3  = '';}
						if(isset($montoPago)) {    $x4  = $montoPago;     }else{$x4  = '';}
						
						//se dibujan los inputs
						$Form_Inputs = new Form_Inputs();
						$Form_Inputs->form_date('Fecha de Pago','fechaPago', $x1, 2);
						$Form_Inputs->form_select('Documento de Pago','idTipoPago', $x2, 2, 'idTipoPago', 'Nombre', 'aguas_facturacion_listado_detalle_tipo_pago', 0, '', $dbConn);
						$Form_Inputs->form_input_number('N° Documento', 'nDocPago', $x3, 1);
						$Form_Inputs->form_input_disabled('Total a Pagar','fake_emp', Valores($calculo, 0));
						$Form_Inputs->form_values('Monto Pagado', 'montoPago', $x4, 2);
						
						$Form_Inputs->form_input_hidden('idUsuarioPago', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
						$Form_Inputs->form_input_hidden('idCliente', $_GET['idCliente'], 2);
						$Form_Inputs->form_input_hidden('idFacturacionDetalle', $rowFacturacion['idFacturacionDetalle'], 2);
						
						?>

					</li>
					<li class="list-group-item">
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf283; Realizar Pago" name="submit_pago">
						<a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&submit_filter=Filtrar'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
						<div class="clearfix"></div>
					</li>
				</form> 
			</ul>
			<?php widget_validator(); ?>
		</div> 
	</div> 
							
</div>
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['submit_filter']) ) { 
//obtengo los datos del cliente
$query = "SELECT Nombre, Identificador
FROM `aguas_clientes_listado`
WHERE idCliente = '".$_GET['idCliente']."'";
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
$rowCliente = mysqli_fetch_assoc ($resultado);

//obtengo los datos de la ultima facturacion
$query = "SELECT 
DetalleCargoFijoValor,DetalleConsumoValor,
DetalleRecoleccionValor,DetalleVisitaCorte,DetalleCorte1Valor,DetalleCorte2Valor,
DetalleReposicion1Valor,DetalleReposicion2Valor,DetalleInteresDeuda,DetalleSaldoFavor,

DetalleSaldoAnterior,DetalleOtrosCargos1Valor,DetalleOtrosCargos2Valor,DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,DetalleOtrosCargos5Valor,

DetalleTotalAPagar, montoPago

FROM `aguas_facturacion_listado_detalle`
WHERE idCliente = '".$_GET['idCliente']."'
AND idEstado = 1
ORDER BY Ano DESC, idMes DESC
LIMIT 1";
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
$rowFacturacion = mysqli_fetch_assoc ($resultado);	

//obtengo las facturaciones atrasadas
$arrFacturaciones = array();
$query = "SELECT 
aguas_facturacion_listado_detalle.idFacturacionDetalle,
aguas_facturacion_listado_detalle.DetalleTotalAPagar, 
aguas_facturacion_listado_detalle.AguasInfFechaEmision,
aguas_facturacion_listado_detalle.idMes,
aguas_facturacion_listado_detalle.Ano,
aguas_facturacion_listado_detalle_estado.Nombre AS Estado
FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `aguas_facturacion_listado_detalle_estado` ON aguas_facturacion_listado_detalle_estado.idEstado = aguas_facturacion_listado_detalle.idEstado
WHERE aguas_facturacion_listado_detalle.idCliente = '".$_GET['idCliente']."'
AND aguas_facturacion_listado_detalle.idEstado = 1
ORDER BY aguas_facturacion_listado_detalle.Ano ASC, aguas_facturacion_listado_detalle.idMes DESC";
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
					<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Facturaciones Pendientes de Pago</h5>
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Año</th>
								<th>Mes</th>
								<th>Estado</th>
								<th>Total</th>
								<th width="10">Acciones</th>
							</tr>
						</thead>			  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrFacturaciones as $fac) { ?>
							<tr class="odd">
								<td><?php echo $fac['Ano']; ?></td>
								<td><?php echo numero_a_mes($fac['idMes']); ?></td>
								<td><?php echo $fac['Estado']; ?></td>
								<td align="right"><?php echo  Valores($fac['DetalleTotalAPagar'], 0); ?></td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_facturacion.php?view='.simpleEncode($fac['idFacturacionDetalle'], fecha_actual()); ?>" title="Ver Facturacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
				<li class="list-group-item"><i class="fa fa-inbox" aria-hidden="true"></i>  Detalle Ultima Facturacion</li>
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
	
	<div class="clearfix"></div>
	<div class="col-lg-12 fcenter" >
		<?php if($rowFacturacion['DetalleTotalAPagar']!=0){ ?>
		<a href="<?php echo $location.'&idCliente='.$_GET['idCliente'].'&pagar=true'; ?>"  class="btn btn-primary fright margin_width"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pagar</a>
		<?php } ?>
		<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php widget_modal(80, 95); ?>

<?php } else{ ?>
<p class="bg-primary" style="padding: 10px;">Este cliente no registra ninguna deuda</p>

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php }  ?>
 
	

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Ingresar Pago</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
            	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 2);
				?>
								
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php widget_validator(); ?>
			
			
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'numero_asc':          $order_by = 'ORDER BY aguas_clientes_pago.idPago ASC ';                           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Numero Evento Ascendente'; break;
		case 'numero_desc':         $order_by = 'ORDER BY aguas_clientes_pago.idPago DESC ';                          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Numero Evento Descendente';break;
		case 'identificador_asc':   $order_by = 'ORDER BY aguas_clientes_listado.Identificador ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente'; break;
		case 'identificador_desc':  $order_by = 'ORDER BY aguas_clientes_listado.Identificador DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Identificador Descendente';break;
		case 'fecha_asc':           $order_by = 'ORDER BY aguas_clientes_pago.fechaPago ASC ';                        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':          $order_by = 'ORDER BY aguas_clientes_pago.fechaPago DESC ';                       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'documento_asc':       $order_by = 'ORDER BY aguas_facturacion_listado_detalle_tipo_pago.Nombre ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Documento Ascendente';break;
		case 'documento_desc':      $order_by = 'ORDER BY aguas_facturacion_listado_detalle_tipo_pago.Nombre DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Documento Descendente';break;
		case 'monto_asc':           $order_by = 'ORDER BY aguas_clientes_pago.montoPago ASC ';                        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Monto Ascendente';break;
		case 'monto_desc':          $order_by = 'ORDER BY aguas_clientes_pago.montoPago DESC ';                       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Monto Descendente';break;
		case 'creador_asc':         $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Creador Ascendente';break;
		case 'creador_desc':        $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Creador Descendente';break;
					
		default: $order_by = 'ORDER BY aguas_clientes_pago.fechaPago DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY aguas_clientes_pago.fechaPago DESC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE aguas_clientes_pago.idPago!=0";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idClienteFilt']) && $_GET['idClienteFilt'] != ''){    $z .= " AND aguas_clientes_pago.idCliente='".$_GET['idClienteFilt']."'";}
if(isset($_GET['fechaPago']) && $_GET['fechaPago'] != ''){            $z .= " AND aguas_clientes_pago.fechaPago='".$_GET['fechaPago']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT aguas_clientes_pago.idPago FROM `aguas_clientes_pago` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los elementos
$arrUsers = array();
$query = "SELECT 
aguas_clientes_pago.idPago,
aguas_clientes_pago.fechaPago,
aguas_clientes_pago.nDocPago,
aguas_clientes_pago.montoPago,
aguas_clientes_listado.Identificador,
usuarios_listado.Nombre AS Creador,
aguas_facturacion_listado_detalle_tipo_pago.Nombre AS TipoPago

FROM `aguas_clientes_pago`
LEFT JOIN `aguas_clientes_listado`                       ON aguas_clientes_listado.idCliente                         = aguas_clientes_pago.idCliente
LEFT JOIN `usuarios_listado`                             ON usuarios_listado.idUsuario                               = aguas_clientes_pago.idUsuarioPago
LEFT JOIN `aguas_facturacion_listado_detalle_tipo_pago`  ON aguas_facturacion_listado_detalle_tipo_pago.idTipoPago   = aguas_clientes_pago.idTipoPago
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrUsers,$row );
}
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';	
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Ingresar Pago</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idClienteFilt)) {   $x1  = $idClienteFilt;    }else{$x1  = '';}
				if(isset($fechaPago)) {       $x2  = $fechaPago;        }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cliente','idClienteFilt', $x1, 1, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				$Form_Inputs->form_date('Fecha Pago','fechaPago', $x2, 1);
					
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>  
<div class="clearfix"></div>                  
                                 
<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Pagos</h5>	
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">N° Transaccion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=numero_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=numero_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Identificador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=identificador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=identificador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Documento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=documento_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=documento_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Monto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=monto_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=monto_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Creador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=creador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=creador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">
						<td><?php echo n_doc($usuarios['idPago'], 7); ?></td>		
						<td><?php echo $usuarios['Identificador']; ?></td>		
						<td><?php echo fecha_estandar($usuarios['fechaPago']); ?></td>		
						<td><?php echo $usuarios['TipoPago'].' '.$usuarios['nDocPago']; ?></td>		
						<td align="right"><?php echo valores($usuarios['montoPago'], 0); ?></td>		
						<td><?php echo $usuarios['Creador']; ?></td>			
					</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>   
	</div>
</div>
	
<?php widget_modal(80, 95); ?>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
