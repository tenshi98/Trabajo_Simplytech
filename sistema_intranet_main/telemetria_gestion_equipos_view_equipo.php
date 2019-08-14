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
$query = "SELECT 
telemetria_listado.Nombre,
telemetria_listado.Sim_Num_Tel,
telemetria_listado.Sim_Num_Serie,
telemetria_listado.Sim_modelo,
telemetria_listado.Sim_marca,
telemetria_listado.Sim_Compania,
telemetria_listado.IP_Client,
telemetria_listado.IdentificadorEmpresa,
telemetria_listado.cantSensores,
telemetria_listado.id_Sensores,
telemetria_listado.Direccion_img,
telemetria_listado.TiempoFueraLinea,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
telemetria_listado.Direccion,
telemetria_listado.IP_Client,
telemetria_listado.idTelemetria

FROM `telemetria_listado`
LEFT JOIN `core_ubicacion_ciudad`                ON core_ubicacion_ciudad.idCiudad                     = telemetria_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`               ON core_ubicacion_comunas.idComuna                    = telemetria_listado.idComuna

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
				<li class="active"><a href="#basicos" data-toggle="tab">Datos Basicos</a></li>
				
				<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
				<li class=""><a href="#mediciones" data-toggle="tab">Ultimas Mediciones</a></li>
				<?php } ?>
					
				
				<li class=""><a href="#alertas" data-toggle="tab">Alertas</a></li>
				<li class=""><a href="#flinea" data-toggle="tab">Fuera de Linea</a></li>

			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
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
						<h2 class="text-primary">Datos del Equipo</h2>
						<p class="text-muted">
							<?php if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){ ?><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/><?php } ?>
							<?php if(isset($rowdata['IdentificadorEmpresa'])&&$rowdata['IdentificadorEmpresa']!=''){ ?><strong>Identificador Empresa : </strong><?php echo $rowdata['IdentificadorEmpresa']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Num_Tel'])&&$rowdata['Sim_Num_Tel']!=''){ ?><strong>SIM - Numero Telefonico : </strong><?php echo $rowdata['Sim_Num_Tel']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Num_Serie'])&&$rowdata['Sim_Num_Serie']!=''){ ?><strong>SIM - Numero Serie : </strong><?php echo $rowdata['Sim_Num_Serie']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Compania'])&&$rowdata['Sim_Compania']!=''){ ?><strong>SIM - Compañia : </strong><?php echo $rowdata['Sim_Compania']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_marca'])&&$rowdata['Sim_marca']!=''){ ?><strong>BAM - Marca : </strong><?php echo $rowdata['Sim_marca']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_modelo'])&&$rowdata['Sim_modelo']!=''){ ?><strong>BAM - Modelo : </strong><?php echo $rowdata['Sim_modelo']; ?><br/><?php } ?>
							<?php if(isset($rowdata['IP_Client'])&&$rowdata['IP_Client']!=''){ ?><strong>IP Cliente : </strong><?php echo $rowdata['IP_Client']; ?><br/><?php } ?>
							<?php if(isset($rowdata['idTelemetria'])&&$rowdata['idTelemetria']!=''){ ?><strong>ID Equipo : </strong><?php echo $rowdata['idTelemetria']; ?><br/><?php } ?>
						</p>
						
						<h2 class="text-primary">Datos de Configuracion</h2>
						<p class="text-muted">
							<?php if($rowdata['id_Sensores']==1){ ?>
							<strong>Cantidad de Sensores : </strong><?php echo $rowdata['cantSensores']; ?><br/>
							<?php } ?>
							<strong>Tiempo Fuera Linea Maximo : </strong><?php echo $rowdata['TiempoFueraLinea']; ?> Horas<br/>
						</p>

						
					</div>	
					<div class="clearfix"></div>
					
					
				</div>
			</div>
			
			
			<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
				<div class="tab-pane fade" id="mediciones">
					<div class="wmd-panel">
						<?php
						//Se arma la consulta
						$aa = '';
						for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
							$aa .= ',SensoresNombre_'.$i;
							$aa .= ',SensoresGrupo_'.$i;
							$aa .= ',SensoresMedMin_'.$i;
							$aa .= ',SensoresMedMax_'.$i;
							$aa .= ',SensoresUniMed_'.$i;
							$aa .= ',SensoresMedActual_'.$i;
							$aa .= ',SensoresActivo_'.$i;
						}
						// tomo los datos del usuario
						$query = "SELECT Nombre, id_Sensores,cantSensores,LastUpdateFecha,LastUpdateHora,
						GeoVelocidad
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
						
						//Se traen todas las unidades de medida
						$arrUnimed = array();
						$query = "SELECT idUniMed,Nombre
						FROM `telemetria_listado_unidad_medida`
						ORDER BY idUniMed ASC";
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
						array_push( $arrUnimed,$row );
						}
						
						//Se traen todos los grupos
						$arrGrupos = array();
						$query = "SELECT idGrupo,Nombre
						FROM `telemetria_listado_grupos`
						ORDER BY idGrupo ASC";
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
						array_push( $arrGrupos,$row );
						}

						
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_sensores_view_equipo_mediciones.php?view='.$_GET['view'].'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ubicacion</a>
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_2.php?view='.$_GET['view']; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>#</th>
											<th>Nombre</th>
											<th>Grupo</th>
											<th>Fecha/hora</th>
											<th>Medicion Actual</th>
											<th>Minimo</th>
											<th>Maximo</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
											//solo sensores activos
											if(isset($rowMed['SensoresActivo_'.$i])&&$rowMed['SensoresActivo_'.$i]==1){
												$unimed = '';
												//unidad de medida
												foreach ($arrUnimed as $sen) {
													if($rowMed['SensoresUniMed_'.$i]==$sen['idUniMed']){
														$unimed = ' '.$sen['Nombre'];	
													}
												}
												?>
										
												<tr class="odd <?php if($rowMed['SensoresMedMin_'.$i]!=0&&$rowMed['SensoresMedMax_'.$i]!=0){if($rowMed['SensoresMedActual_'.$i] < $rowMed['SensoresMedMin_'.$i] or $rowMed['SensoresMedActual_'.$i]>$rowMed['SensoresMedMax_'.$i]){echo 'danger';}} ?>">		
													<td><?php echo 's'.$i ?></td>
													<td><?php echo $rowMed['SensoresNombre_'.$i]; ?></td>	
													<td>
														<?php 
														foreach ($arrGrupos as $sen) { 
															if($rowMed['SensoresGrupo_'.$i]==$sen['idGrupo']){
																echo $sen['Nombre'];
															}
														}
														?>
													</td>
													<td><?php echo fecha_estandar($rowMed['LastUpdateFecha']).' - '.$rowMed['LastUpdateHora'].' hrs'; ?></td>
													<td><?php 
													if(isset($rowMed['SensoresMedActual_'.$i])&&$rowMed['SensoresMedActual_'.$i]!=999){
														echo Cantidades_decimales_justos($rowMed['SensoresMedActual_'.$i]).$unimed;
													}else{
														echo 'Sin Datos';
													} ?>
													</td>
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMin_'.$i]).$unimed;?></td>		
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMax_'.$i]).$unimed; ?></td>
												</tr>
											<?php } ?>  
										<?php } ?>                    
									</tbody>
								</table>
						
						</div>
					</div>
				</div>
			<?php } ?>
			
			
			
			
			
			
			<div class="tab-pane fade" id="alertas">
					<div class="wmd-panel">
						<?php
						// Se trae un listado con todas las alertas
						$arrAlertas = array();
						$query = "SELECT  
						telemetria_listado_errores.idErrores, 
						telemetria_listado_errores.Descripcion, 
						telemetria_listado_errores.Fecha,  
						telemetria_listado_errores.Hora,  
						telemetria_listado_errores.Valor, 
						telemetria_listado_errores.Valor_min, 
						telemetria_listado_errores.Valor_max,
						telemetria_listado_errores.Sensor,
						SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
						SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
						SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
						SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
						SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
						SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
						SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
						SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
						SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
						SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50
						
						FROM `telemetria_listado_errores`
						LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria
						WHERE telemetria_listado_errores.idTelemetria = {$_GET['view']}
						AND telemetria_listado_errores.idTipo!='999'
						AND telemetria_listado_errores.Valor!='999'
						ORDER BY telemetria_listado_errores.idErrores DESC
						LIMIT 20";
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
						array_push( $arrAlertas,$row );
						}
						
						//Se traen todas las unidades de medida
						$arrUnimed = array();
						$query = "SELECT idUniMed,Nombre
						FROM `telemetria_listado_unidad_medida`
						ORDER BY idUniMed ASC";
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
						array_push( $arrUnimed,$row );
						}
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_2.php?idTelemetria='.$_GET['view'].'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
							
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Descripcion</th>
										<th>Fecha</th>
										<th>Hora</th>
										<th>Valor</th>
										<th>Min</th>
										<th>Max</th>
										<th>Ubicacion</th> 
									</tr>
								</thead>
								
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrAlertas as $error) { 
											//Guardo la unidad de medida
											$unimed = '';
											foreach ($arrUnimed as $sen) {
												if($error['SensoresUniMed_'.$error['Sensor']]==$sen['idUniMed']){
													$unimed = ' '.$sen['Nombre'];	
												}
											} ?>
										<tr>
											<td><?php echo $error['Descripcion']; ?></td>
											<td><?php echo fecha_estandar($error['Fecha']); ?></td>
											<td><?php echo $error['Hora']; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor']).$unimed; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor_min']).$unimed; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor_max']).$unimed; ?></td>
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_2_view.php?view='.$error['idErrores']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
												</div>
											</td>
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="flinea">
					<div class="wmd-panel">
						<?php
						// Se trae un listado con todas las fuera de linea
						$arrFlinea = array();
						$query = "SELECT  idFueraLinea, Fecha_inicio, Hora_inicio, Fecha_termino, Hora_termino, Tiempo

						FROM `telemetria_listado_error_fuera_linea`
						WHERE idTelemetria = {$_GET['view']}
						ORDER BY idFueraLinea DESC
						LIMIT 20";
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
						array_push( $arrFlinea,$row );
						}
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_2.php?idTelemetria='.$_GET['view'].'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
							
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Fecha Inicio</th>
										<th>Hora Inicio</th>
										<th>Fecha Termino</th>
										<th>Hora Termino</th>
										<th>Tiempo</th>
										<th>Ubicacion</th> 
									</tr>
								</thead>
								
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrFlinea as $error) {  ?>
										<tr>
											<td><?php echo fecha_estandar($error['Fecha_inicio']); ?></td>
											<td><?php echo $error['Hora_inicio'].' hrs'; ?></td>
											<td><?php echo fecha_estandar($error['Fecha_termino']); ?></td>
											<td><?php echo $error['Hora_termino'].' hrs'; ?></td>
											<td><?php echo $error['Tiempo'].' hrs'; ?></td>
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_2_view.php?view='.$error['idFueraLinea']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
												</div>
											</td>		
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


<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

		
	</body>
</html>
