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
/**********************************************************/
//Variable de busqueda
$z = "WHERE cross_solicitud_aplicacion_listado.idSolicitud!=0";
$z .= " AND cross_solicitud_aplicacion_listado.idEstado=3";//solo terminadas
//Verifico el tipo de usuario que esta ingresando
$z.= " AND cross_solicitud_aplicacion_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){ $z .= " AND cross_solicitud_aplicacion_listado.idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){       $z .= " AND cross_solicitud_aplicacion_listado.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idZona']) && $_GET['idZona'] != ''){           $z .= " AND cross_solicitud_aplicacion_listado_cuarteles.idZona=".$_GET['idZona'];}
/**********************************************************/
// Se trae un listado con todos los datos separados por tractores
$arrOTS = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado_cuarteles.f_cierre,

cross_predios_listado.Nombre AS PredioNombre,
sistema_variedades_categorias.Nombre AS VariedadCat,
variedades_listado.Nombre AS VariedadNombre,
cross_predios_listado_zonas.Nombre AS CuartelNombre,
cross_predios_listado_zonas.Plantas AS CuartelCantPlantas,
cross_predios_listado_zonas.DistanciaPlant AS CuartelDistanciaPlant,

telemetria_listado.Nombre AS TractorNombre,
cross_solicitud_aplicacion_listado_tractores.idTractores,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMin,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMax,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadProm,
cross_solicitud_aplicacion_listado_tractores.GeoDistance,
cross_solicitud_aplicacion_listado_tractores.Sensor_1_Prom,
cross_solicitud_aplicacion_listado_tractores.Sensor_2_Prom,
cross_solicitud_aplicacion_listado_tractores.Sensor_3_Min,
cross_solicitud_aplicacion_listado_tractores.Sensor_3_Max,
cross_solicitud_aplicacion_listado_tractores.idTelemetria,

cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMin_out,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadMax_out,
cross_solicitud_aplicacion_listado_tractores.GeoVelocidadProm_out,
cross_solicitud_aplicacion_listado_tractores.GeoDistance_out,
cross_solicitud_aplicacion_listado_tractores.Sensor_out_1_Sum,
cross_solicitud_aplicacion_listado_tractores.Sensor_out_2_Sum,

cross_solicitud_aplicacion_listado_cuarteles.VelTractor


FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `cross_predios_listado`                          ON cross_predios_listado.idPredio                             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `cross_solicitud_aplicacion_listado_cuarteles`   ON cross_solicitud_aplicacion_listado_cuarteles.idSolicitud   = cross_solicitud_aplicacion_listado.idSolicitud
LEFT JOIN `cross_predios_listado_zonas`                    ON cross_predios_listado_zonas.idZona                         = cross_solicitud_aplicacion_listado_cuarteles.idZona
LEFT JOIN `cross_solicitud_aplicacion_listado_tractores`   ON cross_solicitud_aplicacion_listado_tractores.idCuarteles   = cross_solicitud_aplicacion_listado_cuarteles.idCuarteles
LEFT JOIN `telemetria_listado`                             ON telemetria_listado.idTelemetria                            = cross_solicitud_aplicacion_listado_tractores.idTelemetria
LEFT JOIN `sistema_variedades_categorias`                  ON sistema_variedades_categorias.idCategoria                  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`                             ON variedades_listado.idProducto                              = cross_solicitud_aplicacion_listado.idProducto

".$z."
ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC,
cross_predios_listado_zonas.Nombre ASC
";
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
array_push( $arrOTS,$row );
}

filtrar($arrOTS, 'idTelemetria');

?>

<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Detalle Tractores</h5>
			<ul class="nav nav-tabs pull-right">
				<?php 
				$ssx = 0;
				foreach ($arrOTS as $categoria=>$subcategorias) { ?>
					<li class="<?php if($ssx==0){echo 'active';}?>"><a href="#data_tab_<?php echo $categoria; ?>" data-toggle="tab"><?php echo $subcategorias[0]['TractorNombre']; ?></a></li>
				<?php $ssx++; } ?>
			</ul>

		</header>
		<div id="div-3" class="tab-content">
			
			<?php 
			$ssx = 0;
			foreach ($arrOTS as $categoria=>$subcategorias) { ?>
				<div class="tab-pane fade <?php if($ssx==0){echo 'active in';}?>" id="data_tab_<?php echo $categoria; ?>">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th colspan="20" style="text-align: center;"><strong>Monitoreo dentro de cuarteles</strong></th>
								</tr>
								<tr role="row">
									<th colspan="6" style="text-align: center;">Identificacion</th>
									<th colspan="4" style="text-align: center;">Velocidad Tractor (Km/hr)</th>
									<th colspan="2" style="text-align: center;">Promedio Caudales</th>
									<th colspan="2" style="text-align: center;">Nivel Estanque</th>
									<th colspan="2" style="text-align: center;">Plantas</th>
								</tr>
								<tr role="row">
									<th>N° Solicitud</th>
									<th>Fecha</th>
									<th>Predio</th>
									<th>Cuartel</th>
									<th>Especie</th>
									<th>Variedad</th>
									
									<th>Minima</th>
									<th>Maxima</th>
									<th>Promedio</th>
									<th>Programada</th>
									
									<th>Derecho</th>
									<th>Izquierdo</th>
									
									<th>Minima</th>
									<th>Maxima</th>
									
									<th>Totales</th>
									<th>Pendientes</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($subcategorias as $ot) { ?>
									<tr class="odd">		
										<td><?php echo n_doc($ot['idSolicitud'], 5); ?></td>
										<td><?php echo Fecha_estandar($ot['f_cierre']); ?></td>
										<td><?php echo $ot['PredioNombre']; ?></td>
										<td><?php echo $ot['CuartelNombre']; ?></td>
										<td><?php echo $ot['VariedadCat']; ?></td>
										<td><?php echo $ot['VariedadNombre']; ?></td>
										
										<td><?php echo Cantidades($ot['GeoVelocidadMin'], 1); ?></td>
										<td><?php echo Cantidades($ot['GeoVelocidadMax'], 1); ?></td>
										<td><?php echo Cantidades($ot['GeoVelocidadProm'], 1); ?></td>
										<td><?php echo Cantidades($ot['VelTractor'], 1); ?></td>
										
										<td><?php echo Cantidades($ot['Sensor_1_Prom'], 2); ?></td>
										<td><?php echo Cantidades($ot['Sensor_2_Prom'], 2); ?></td>
										
										<td><?php echo Cantidades($ot['Sensor_3_Min'], 0); ?></td>
										<td><?php echo Cantidades($ot['Sensor_3_Max'], 0); ?></td>

										<td><?php echo Cantidades($ot['CuartelCantPlantas'], 0); ?></td>
										<td><?php echo Cantidades(((($ot['CuartelDistanciaPlant']*$ot['CuartelCantPlantas']) - ($ot['GeoDistance']*1000))/$ot['CuartelDistanciaPlant']), 0); ?></td>
											
									</tr>
								<?php } ?>                    
							</tbody>
						</table>	
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								
							<thead>
								<tr role="row">
									<th colspan="14" style="text-align: center;"><strong>Monitoreo fuera de cuarteles</strong></th>
								</tr>
								<tr role="row">
									<th colspan="6" style="text-align: center;">Identificacion</th>
									<th colspan="4" style="text-align: center;">Velocidad Tractor (Km/hr)</th>
									<th colspan="1" style="text-align: center;">Distancia Recorrida(Metros)</th>
									<th colspan="2" style="text-align: center;">Suma Caudales</th>
									<th width="10">Acciones</th>
								</tr>
								<tr role="row">
									<th>N° Solicitud</th>
									<th>Fecha</th>
									<th>Predio</th>
									<th>Cuartel</th>
									<th>Especie</th>
									<th>Variedad</th>
									
									<th>Minima</th>
									<th>Maxima</th>
									<th>Promedio</th>
									<th>Programada</th>
									
									<th>Recorrida</th>
									
									<th>Derecho</th>
									<th>Izquierdo</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($subcategorias as $ot) { ?>
									<tr class="odd">		
										<td><?php echo n_doc($ot['idSolicitud'], 5); ?></td>
										<td><?php echo Fecha_estandar($ot['f_cierre']); ?></td>
										<td><?php echo $ot['PredioNombre']; ?></td>
										<td><?php echo $ot['CuartelNombre']; ?></td>
										<td><?php echo $ot['VariedadCat']; ?></td>
										<td><?php echo $ot['VariedadNombre']; ?></td>
										
										<td><?php echo Cantidades($ot['GeoVelocidadMin_out'], 2); ?></td>
										<td><?php echo Cantidades($ot['GeoVelocidadMax_out'], 2); ?></td>
										<td><?php echo Cantidades($ot['GeoVelocidadProm_out'], 2); ?></td>
										<td><?php echo Cantidades($ot['VelTractor'], 2); ?></td>
										
										<td><?php echo Cantidades($ot['GeoDistance_out'], 2); ?></td>
										
										<td><?php echo Cantidades($ot['Sensor_out_1_Sum'], 2); ?></td>
										<td><?php echo Cantidades($ot['Sensor_out_2_Sum'], 2); ?></td>
	
									</tr>
								<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			<?php $ssx++; } ?>
					
					
		

	</div>
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
