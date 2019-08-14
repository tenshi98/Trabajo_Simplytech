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
/*                                                Carga del documento HTML                                                        */
/**********************************************************************************************************************************/
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
			body {
				background-color: #FFF;
			}
		</style>
	</head>

	<body>






<?php
//Verifico la existencia de datos de base de datos
if(isset($_GET['data_3'])&&isset($_GET['data_4'])&&isset($_GET['data_5'])&&isset($_GET['data_6'])){
	
	//Funcion para conectarse
	function conectarDB ($servidor, $usuario, $password, $base_datos) {
		$db_con = mysqli_connect($servidor, $usuario, $password, $base_datos);
		$db_con->set_charset("utf8");
		return $db_con; 
	}	
	//ejecuto conexion
	$dbConn = conectarDB($_GET['data_3'], $_GET['data_4'], $_GET['data_5'], $_GET['data_6']);	
		
}


// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, cantSensores, Direccion_img
FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['view']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);


?>


<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Equipo <?php echo $rowdata['Nombre']; ?></h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#uso" data-toggle="tab">Sensores</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="uso">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/maquina.jpg">
						<?php }else{  ?>
							<?php if (isset($_GET['data_1'])&&$_GET['data_1']=='si') { ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo 'http://'.$_GET['data_2'].$rowdata['Direccion_img']; ?>">
							<?php }else{  ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
							<?php }?>	
						<?php }?>
					</div>
					<div class="col-sm-8">
						<?php
						//Se arma la consulta
						$aa = '';
						for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
							$aa .= ',SensoresNombre_'.$i;
							$aa .= ',SensoresUso_'.$i;
							$aa .= ',SensoresFechaUso_'.$i;
							$aa .= ',SensoresAccionC_'.$i;
							$aa .= ',SensoresAccionT_'.$i;
							$aa .= ',SensoresAccionMedC_'.$i;
							$aa .= ',SensoresAccionMedT_'.$i;
							$aa .= ',SensoresAccionAlerta_'.$i;
						}
						// tomo los datos del usuario
						$query = "SELECT Nombre
						".$aa."
						FROM `telemetria_listado`
						WHERE idTelemetria = {$_GET['view']}";
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
						$rowMed = mysqli_fetch_assoc ($resultado);
						//Cuento si hay sensores activos
						$rowcount = 0;
						for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
							if(isset($rowMed['SensoresUso_'.$i])&&$rowMed['SensoresUso_'.$i]==1){
								$rowcount++;
							}
						}
						//verifico los resultados y muestro la tabla
						if(isset($rowcount)&&$rowcount!=0){ ?>
							<div class="col-sm-12">
								<div class="box">	
									<header>		
										<div class="icons"><i class="fa fa-table"></i></div><h5>Sensores Supervisados</h5>
									</header>
									<div class="table-responsive">
				
										<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
											<thead>
												<tr role="row">
													<th>Nombre</th>
													<th>Fecha</th>
													<th>Ciclos Limite</th>
													<th>Ciclos Actuales</th>
													<th>% Cumplimiento</th>
													<th>Horas limite</th>
													<th>Horas Actuales</th>
													<th>% Cumplimiento</th>
													<th>% Alerta</th>
												</tr>
											</thead>
											<tbody role="alert" aria-live="polite" aria-relevant="all">
												<?php for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
													//Se verifica si el sensor esta habilitado para la supervision
													if(isset($rowMed['SensoresUso_'.$i])&&$rowMed['SensoresUso_'.$i]==1){ ?>
														<tr class="odd">
															<td><?php echo $rowMed['SensoresNombre_'.$i]; ?></td>
															<td><?php echo fecha_estandar($rowMed['SensoresFechaUso_'.$i]); ?></td>
															<td><?php echo Cantidades_decimales_justos($rowMed['SensoresAccionC_'.$i]);?></td>		
															<td><?php echo Cantidades_decimales_justos($rowMed['SensoresAccionMedC_'.$i]);?></td>		
															<td><?php echo porcentaje($rowMed['SensoresAccionMedC_'.$i]/$rowMed['SensoresAccionC_'.$i]);?></td>
															<td><?php echo Cantidades_decimales_justos($rowMed['SensoresAccionT_'.$i]/3600);?></td>		
															<td><?php echo Cantidades_decimales_justos($rowMed['SensoresAccionMedT_'.$i]/3600);?></td>		
															<td><?php echo porcentaje($rowMed['SensoresAccionMedT_'.$i]/$rowMed['SensoresAccionT_'.$i]);?></td>
															<td><?php echo Cantidades_decimales_justos($rowMed['SensoresAccionAlerta_'.$i]);?></td>		
														</tr>
													<?php 	
													}
												} ?>
														
							 
											</tbody>
										</table>
									</div>
								</div>
							</div>
						<?php } else{ ?>
							<div class="alert alert-info" role="alert" style="margin-top:15px;">No existen sensores configurados para la supervision</div>
						<?php } ?>
					</div>	
					<div class="clearfix"></div>
					
					
				</div>
			</div>
			
			
			
			
			
        </div>	
	</div>
</div>


<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

		
	</body>
</html>
