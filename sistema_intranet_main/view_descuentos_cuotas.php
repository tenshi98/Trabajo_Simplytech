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
usuarios_listado.Nombre AS Usuario,
trabajadores_descuentos_cuotas_tipos.Nombre AS Documento,
trabajadores_descuentos_cuotas.fecha_auto,
trabajadores_descuentos_cuotas.Creacion_fecha,
trabajadores_descuentos_cuotas.Observaciones,
trabajadores_descuentos_cuotas.Monto,
trabajadores_descuentos_cuotas.N_Cuotas,

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,

trabajadores_listado.Nombre AS Nombre_trab,
trabajadores_listado.ApellidoPat AS ApellidoPat_trab,
trabajadores_listado.ApellidoMat AS ApellidoMat_trab,
trabajadores_listado.Cargo AS Cargo_trab,
trabajadores_listado.Fono AS Fono_trab,
trabajadores_listado.Rut AS Rut_trab,
trabajadores_listado_tipos.Nombre AS Tipo_trab

FROM `trabajadores_descuentos_cuotas`
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = trabajadores_descuentos_cuotas.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = trabajadores_descuentos_cuotas.idUsuario
LEFT JOIN `trabajadores_descuentos_cuotas_tipos`    ON trabajadores_descuentos_cuotas_tipos.idTipo  = trabajadores_descuentos_cuotas.idTipo
LEFT JOIN `trabajadores_listado`                    ON trabajadores_listado.idTrabajador            = trabajadores_descuentos_cuotas.idTrabajador
LEFT JOIN `trabajadores_listado_tipos`              ON trabajadores_listado_tipos.idTipo            = trabajadores_listado.idTipo

WHERE trabajadores_descuentos_cuotas.idFacturacion = {$_GET['view']} ";
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
$arrCuotas = array();
$query = "SELECT Fecha, nCuota, TotalCuotas, monto_cuotas
FROM `trabajadores_descuentos_cuotas_listado` 
WHERE idFacturacion = {$_GET['view']} 
ORDER BY nCuota ASC";
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
array_push( $arrCuotas,$row );
}


/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `trabajadores_descuentos_cuotas_archivos` 
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

?>

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> <?php echo $row_data['Documento']?>.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['Creacion_fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php
			echo '
				<div class="col-sm-4 invoice-col">
					Datos del Trabajador
					<address>
						<strong>'.$row_data['Nombre_trab'].' '.$row_data['ApellidoPat_trab'].' '.$row_data['ApellidoMat_trab'].'</strong><br>
						Rut: '.$row_data['Rut_trab'].'<br>
						Fono: '.$row_data['Fono_trab'].'<br>
						Cargo: '.$row_data['Cargo_trab'].'<br>
						Tipo Cargo: '.$row_data['Tipo_trab'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Empresa
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">';
					
					if(isset($row_data['Usuario'])&&$row_data['Usuario']!=''){ 
						echo '<b>Usuario creador: </b>'.$row_data['Usuario'].'<br>';
					}
					if(isset($row_data['fecha_auto'])&&$row_data['fecha_auto']!=''&&$row_data['fecha_auto']!='0000-00-00'){ 
						echo '<b>Fecha Ingreso : </b>'.Fecha_estandar($row_data['fecha_auto']).'<br>';
					}
					if(isset($row_data['Monto'])&&$row_data['Monto']!=''){ 
						echo '<b>Monto Cuotas : </b>'.valores($row_data['Monto'],0).'<br>';
					}
					if(isset($row_data['N_Cuotas'])&&$row_data['N_Cuotas']!=''&&$row_data['N_Cuotas']!='0'){ 
						echo '<b>N° Cuotas: </b>'.$row_data['N_Cuotas'].'<br>';
					}
					
				echo '</div>';
				?>
		
	</div>
	
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Fecha Cobro</th>
						<th>Numero Cuota</th>
						<th align="right">Valor</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrCuotas) { ?>
						<?php foreach ($arrCuotas as $prod) { ?>
							<tr>
								<td><?php echo fecha_estandar($prod['Fecha']);?></td>
								<td><?php echo 'Cuota '.$prod['nCuota'].' de '.$prod['TotalCuotas'];?></td>
								<td align="right"><?php echo Valores(Cantidades_decimales_justos($prod['monto_cuotas']), 0);?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="2" align="right"><strong>Total Cuotas</strong></td> 
						<td width="160" align="right"><?php echo Valores($row_data['Monto'], 0); ?></td>
					</tr>
					
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
	

      
</section>


<div class="col-xs-12" style="margin-bottom:15px;">
	
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
