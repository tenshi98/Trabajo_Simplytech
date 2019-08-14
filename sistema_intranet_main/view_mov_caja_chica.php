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
// Se traen todos los datos de mi usuario
$query = "SELECT 
caja_chica_facturacion.idTipo,
caja_chica_listado.Nombre AS CajaNombre,
core_sistemas.Nombre AS CajaSistema,
usuarios_listado.Nombre AS Usuario,
caja_chica_facturacion_tipo.Nombre AS CajaTipo,
core_estado_caja.Nombre AS CajaEstado,
caja_chica_facturacion.fecha_auto,
caja_chica_facturacion.Creacion_fecha,
caja_chica_facturacion.Observaciones,
caja_chica_facturacion.Valor,

caja_chica_facturacion.idSolicitado,
caja_chica_facturacion.idRevisado,
caja_chica_facturacion.idAprobado,

trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat,
trabajadores_listado.ApellidoMat AS TrabajadorApellidoMat,
trabajadores_listado.Cargo AS TrabajadorCargo,
trabajadores_listado.Fono AS TrabajadorFono,
trabajadores_listado.Rut AS TrabajadorRut,
caja_chica_facturacion.idFacturacionRelacionada,

trab_rel.Nombre AS TrabRelNombre,
trab_rel.ApellidoPat AS TrabRelApellidoPat,
trab_rel.ApellidoMat AS TrabRelApellidoMat,
trab_rel.Cargo AS TrabRelCargo,
trab_rel.Fono AS TrabRelFono,
trab_rel.Rut AS TrabRelRut,
fact_rel.Valor AS RelValor,

trab_soli.Nombre AS SolicitadoNombre,
trab_soli.ApellidoPat AS SolicitadoApellidoPat,

trab_revi.Nombre AS RevisadoNombre,
trab_revi.ApellidoPat AS RevisadoApellidoPat,

trab_apro.Nombre AS AprobadoNombre,
trab_apro.ApellidoPat AS AprobadoApellidoPat

FROM `caja_chica_facturacion`
LEFT JOIN `caja_chica_listado`                  ON caja_chica_listado.idCajaChica       = caja_chica_facturacion.idCajaChica
LEFT JOIN `core_sistemas`                       ON core_sistemas.idSistema              = caja_chica_facturacion.idSistema
LEFT JOIN `usuarios_listado`                    ON usuarios_listado.idUsuario           = caja_chica_facturacion.idUsuario
LEFT JOIN `caja_chica_facturacion_tipo`         ON caja_chica_facturacion_tipo.idTipo   = caja_chica_facturacion.idTipo
LEFT JOIN `core_estado_caja`                    ON core_estado_caja.idEstado            = caja_chica_facturacion.idEstado
LEFT JOIN `trabajadores_listado`                ON trabajadores_listado.idTrabajador    = caja_chica_facturacion.idTrabajador
LEFT JOIN `caja_chica_facturacion`   fact_rel   ON fact_rel.idFacturacion               = caja_chica_facturacion.idFacturacionRelacionada
LEFT JOIN `trabajadores_listado`     trab_rel   ON trab_rel.idTrabajador                = fact_rel.idTrabajador
LEFT JOIN `trabajadores_listado`     trab_soli  ON trab_soli.idTrabajador               = caja_chica_facturacion.idSolicitado
LEFT JOIN `trabajadores_listado`     trab_revi  ON trab_revi.idTrabajador               = caja_chica_facturacion.idRevisado
LEFT JOIN `trabajadores_listado`     trab_apro  ON trab_apro.idTrabajador               = caja_chica_facturacion.idAprobado

WHERE caja_chica_facturacion.idFacturacion = {$_GET['view']} ";
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
$row_data = mysqli_fetch_assoc ($resultado);
				
// Se trae un listado con todos los productos utilizados
$arrDocumentos = array();
$query = "SELECT 
sistema_documentos_pago.Nombre,
caja_chica_facturacion_existencias.N_Doc,
caja_chica_facturacion_existencias.Valor

FROM `caja_chica_facturacion_existencias` 
LEFT JOIN `sistema_documentos_pago`   ON sistema_documentos_pago.idDocPago  = caja_chica_facturacion_existencias.idDocPago
WHERE idFacturacion = {$_GET['view']} ";
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
array_push( $arrDocumentos,$row );
}

// Se trae un listado con todos los productos utilizados
$arrRendiciones = array();
$query = "SELECT Item, Valor

FROM `caja_chica_facturacion_rendiciones` 
WHERE idFacturacion = {$_GET['view']} ";
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
array_push( $arrRendiciones,$row );
}

/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `caja_chica_facturacion_archivos` 
WHERE idFacturacion = {$_GET['view']} ";
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
array_push( $arrArchivo,$row );
}

/*****************************************/		
// Se trae un listado con el historial
$arrHistorial = array();
$query = "SELECT 
caja_chica_facturacion_historial.Creacion_fecha, 
caja_chica_facturacion_historial.Observacion,

core_historial_tipos.FonAwesome,
usuarios_listado.Nombre AS Usuario

FROM `caja_chica_facturacion_historial` 
LEFT JOIN `core_historial_tipos`     ON core_historial_tipos.idTipo   = caja_chica_facturacion_historial.idTipo
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario    = caja_chica_facturacion_historial.idUsuario
WHERE caja_chica_facturacion_historial.idFacturacion = {$_GET['view']} 
ORDER BY caja_chica_facturacion_historial.idHistorial ASC";
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
array_push( $arrHistorial,$row );
}

?>



<section class="invoice">


	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> <?php echo $row_data['CajaTipo']?>.
				<small class="pull-right">Numero Documento: <?php echo n_doc($_GET['view'], 8) ?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php
		//se verifica el tipo de movimiento
		switch ($row_data['idTipo']) {
			//Ingreso
			case 1:
				echo '
				<div class="col-sm-6 invoice-col">
					Datos del Movimiento
					<address>
						Caja: <strong>'.$row_data['CajaNombre'].'</strong><br>
						Sistema: '.$row_data['CajaSistema'].'<br>
						Usuario: '.$row_data['Usuario'].'<br>
						Estado Ingreso: '.$row_data['CajaEstado'].'<br>
						Fecha Real Ingreso: '.Fecha_estandar($row_data['fecha_auto']).'<br>
						Fecha Ingreso: '.Fecha_estandar($row_data['Creacion_fecha']).'<br>
					</address>
				</div>
				
				<div class="col-sm-6 invoice-col">
					
				</div>';

				break;
				
			//Egreso
			case 2:
				
				echo '
				<div class="col-sm-6 invoice-col">
					Datos del Movimiento
					<address>
						Caja: <strong>'.$row_data['CajaNombre'].'</strong><br>
						Sistema: '.$row_data['CajaSistema'].'<br>
						Usuario: '.$row_data['Usuario'].'<br>
						Estado Egreso: '.$row_data['CajaEstado'].'<br>
						Fecha Real Egreso: '.Fecha_estandar($row_data['fecha_auto']).'<br>
						Fecha Egreso: '.Fecha_estandar($row_data['Creacion_fecha']).'<br>
					</address>
				</div>
				
				<div class="col-sm-6 invoice-col">
					Trabajador
					<address>
						<strong>'.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellidoPat'].' '.$row_data['TrabajadorApellidoMat'].'</strong><br>
						Rut: '.$row_data['TrabajadorRut'].'<br>
						Cargo: '.$row_data['TrabajadorCargo'].'<br>
						Fono: '.$row_data['TrabajadorFono'].'<br>
					</address>
				</div>';
				
				break;
				
			//Rendicion 
			case 3:
				
				echo '
				<div class="col-sm-6 invoice-col">
					Datos del Movimiento
					<address>
						Caja: <strong>'.$row_data['CajaNombre'].'</strong><br>
						Sistema: '.$row_data['CajaSistema'].'<br>
						Usuario: '.$row_data['Usuario'].'<br>
						Estado Rendicion: '.$row_data['CajaEstado'].'<br>
						Fecha Real Rendicion: '.Fecha_estandar($row_data['fecha_auto']).'<br>
						Fecha Rendicion: '.Fecha_estandar($row_data['Creacion_fecha']).'<br>
					</address>
				</div>
				
				<div class="col-sm-6 invoice-col">
					Documento Relacionado
					<address>
						<strong>Doc N°'.$row_data['idFacturacionRelacionada'].'</strong><br>
						Valor: '.Valores($row_data['RelValor'], 0).'<br>
						Trabajador: '.$row_data['TrabRelNombre'].' '.$row_data['TrabRelApellidoPat'].' '.$row_data['TrabRelApellidoMat'].'<br>
						Rut: '.$row_data['TrabRelRut'].'<br>
						Cargo: '.$row_data['TrabRelCargo'].'<br>
						Fono: '.$row_data['TrabRelFono'].'<br>
					</address>
				</div>';
				
				break;
		}?>
		
		
		
    
	</div>
	
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Detalle</th>
						<th width="200">Valor Ingreso</th>
						<th width="200">Valor Egreso</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrRendiciones) { ?>
						<tr class="active"><td colspan="3"><strong>Rendiciones</strong></td></tr>
						<?php foreach ($arrRendiciones as $prod) { ?>
							<tr>
								<td><?php echo $prod['Item'];?></td>
								<?php 
								if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
									echo '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
									echo '<td align="right"></td>';
								}else{
									echo '<td align="right"></td>';
									echo '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
								}?>
							</tr>
						<?php } ?>
					<?php } ?>
					
					<?php if ($arrDocumentos) { ?>
						<tr class="active"><td colspan="3"><strong>Montos</strong></td></tr>
						<?php foreach ($arrDocumentos as $prod) { ?>
							<tr>
								<td>
									<?php 
									echo $prod['Nombre'];
									if(isset($prod['N_Doc'])&&$prod['N_Doc']!=''){
										echo ' N°'.$prod['N_Doc'];
									}
									?>
								</td>
								<?php 
								if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
									echo '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
									echo '<td align="right"></td>';
								}else{
									echo '<td align="right"></td>';
									echo '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
								}?>
							</tr>
						<?php } ?>
					<?php } ?>
					
					
					<?php if(isset($row_data['Valor'])&&$row_data['Valor']!=0){ ?>
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td align="right"><strong>Total</strong></td> 
							<?php 
							if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
								echo '<td align="right">'.Valores($row_data['Valor'], 0).'</td>';
								echo '<td align="right"></td>';
							}else{
								echo '<td align="right"></td>';
								echo '<td align="right">'.Valores($row_data['Valor'], 0).'</td>';
							}?>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Observaciones'];?></p>
		</div>
	</div>
	
	<?php 
	//Egreso
	if($row_data['idTipo']==2){?>
		<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Emisor</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Trabajador</p></div> 
		</div>
	<?php }
	//Si es una rendicion
	if($row_data['idTipo']==3&&isset($row_data['idSolicitado'])&&$row_data['idSolicitado']!=''&&isset($row_data['idRevisado'])&&$row_data['idRevisado']!=''&&isset($row_data['idAprobado'])&&$row_data['idAprobado']!=''){?>
		
		<div class="row firma">
			<div class="col-sm-4 fcont"><p>Solicitado Por:<br/><?php echo $row_data['SolicitadoNombre'].' '.$row_data['SolicitadoApellidoPat']; ?><br/>Firma</p></div>
			<div class="col-sm-4 fcont"><p>Revisado Por:<br/><?php echo $row_data['RevisadoNombre'].' '.$row_data['RevisadoApellidoPat']; ?><br/>Firma</p></div>
			<div class="col-sm-4 fcont"><p>Aprobado Por:<br/><?php echo $row_data['AprobadoNombre'].' '.$row_data['AprobadoApellidoPat']; ?><br/>Firma</p></div> 
		</div>
	<?php } ?>
	

<?php
	$zz  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&view='.$_GET['view'];
	?>
	<div class="row no-print">
		<div class="col-xs-12">
			<a target="new" href="view_mov_caja_chica_to_print.php<?php echo $zz ?>" class="btn btn-default">
				<i class="fa fa-print"></i> Imprimir
			</a>

			<a target="new" href="view_mov_caja_chica_to_pdf.php<?php echo $zz ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
				<i class="fa fa-file-pdf-o"></i> Exportar a PDF
			</a>
		</div>
	</div>
      
</section>

<div class="col-xs-12" style="margin-bottom:15px;">
	
	<?php if ($arrHistorial){ ?>
		<table id="items">
			<tbody>
				<tr>
					<th colspan="3">Historial</th>
				</tr>
				<tr>
					<th width="160">Fecha</th>
					<th>Usuario</th>
					<th>Observacion</th>
				</tr>			  
				<?php foreach ($arrHistorial as $doc){?>
					<tr class="item-row">
						<td><?php echo fecha_estandar($doc['Creacion_fecha']); ?></td>
						<td><?php echo $doc['Usuario']; ?></td>
						<td><?php echo '<i class="'.$doc['FonAwesome'].'" aria-hidden="true"></i> '.$doc['Observacion']; ?></td>
					</tr> 
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>
	
	<?php if ($arrArchivo){ ?>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<tr>
					<th colspan="6">Archivos Adjuntos</th>
				</tr>		  
				<?php foreach ($arrArchivo as $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $producto['Nombre']; ?></td>
						<td width="160">
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?return=true&path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<a href="1download.php?dir=upload&file=<?php echo $producto['Nombre']; ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
    <?php } ?>
    
</div>
 
<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>
	</body>
</html>
