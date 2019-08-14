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

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,
sistema_origen.Contacto_Nombre AS SistemaContacto,

usuarios_listado.Nombre AS NombreEncargado,

telemetria_historial_mantencion.Fecha, 
telemetria_historial_mantencion.Duracion, 
telemetria_historial_mantencion.Resumen, 
telemetria_historial_mantencion.Resolucion,

telemetria_listado.Nombre AS Equipo

FROM `telemetria_historial_mantencion`
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = telemetria_historial_mantencion.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = telemetria_historial_mantencion.idUsuario
LEFT JOIN `telemetria_listado`                      ON telemetria_listado.idTelemetria              = telemetria_historial_mantencion.idTelemetria

WHERE telemetria_historial_mantencion.idMantencion = {$_GET['view']}";
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

//Se buscan todos los archivos relacionados
$arrArchivos = array();
$query = "SELECT Nombre
FROM `telemetria_historial_mantencion_archivos`
WHERE idMantencion = {$_GET['view']}";
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
array_push( $arrArchivos,$row );
}

?>
<div class="col-xs-12" style="margin-top:15px;">
	<a target="new" href="view_telemetria_mantencion_to_pdf.php?view=<?php echo $_GET['view'].'&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'] ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
		<i class="fa fa-file-pdf-o"></i> Exportar a PDF
	</a>
</div>
<div class="clearfix"></div>


<section class="invoice">


	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> Mantenciones.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['Fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php


				echo '
				<div class="col-sm-4 invoice-col">
					Empresa Visitada
					<address>
						<strong>'.$row_data['SistemaOrigen'].'</strong><br>
						'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br>
						'.$row_data['SistemaOrigenDireccion'].'<br>
						Fono Fijo: '.$row_data['SistemaOrigenFono'].'<br>
						Rut: '.$row_data['SistemaOrigenRut'].'<br>
						Email: '.$row_data['SistemaOrigenEmail'].'<br>
						Contacto: '.$row_data['SistemaContacto'].'<br>
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					Tecnico a Cargo
					<address>
						<strong>'.$row_data['NombreEncargado'].'</strong><br>
						Fecha: '.Fecha_estandar($row_data['Fecha']).'<br>
						Horas: '.$row_data['Duracion'].'<br>
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					Equipo
					<address>
						<strong>'.$row_data['Equipo'].'</strong><br>
					</address>
				</div>';

				?>
	</div>
	
	

	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Resumen:</p>
			<div class="text-muted well well-sm no-shadow" ><?php echo $row_data['Resumen'];?></div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Resolucion:</p>
			<div class="text-muted well well-sm no-shadow" ><?php echo $row_data['Resolucion'];?></div>
		</div>
	</div>
	

	<div class="">
		<p class="lead"><a name="Ancla_obs"></a>Imagenes:</p>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<?php foreach ($arrArchivos as $archivos) { ?>
					<tr class="odd">
						<td><?php echo $archivos['Nombre']; ?></td>
						<td width="10">
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$archivos['Nombre'].'&return=true'; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<a href="<?php echo '1download.php?dir=upload&file='.$archivos['Nombre']; ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
						
    </div>



      
</section>

 
<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>



	</body>
</html>
