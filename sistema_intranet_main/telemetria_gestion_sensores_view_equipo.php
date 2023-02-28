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
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
// consulto los datos
$query = "SELECT 
telemetria_listado.Nombre,
telemetria_listado.cantSensores,
telemetria_listado.id_Sensores,
telemetria_listado.Direccion_img,
telemetria_listado.TiempoFueraLinea,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
telemetria_listado.Direccion

FROM `telemetria_listado`
LEFT JOIN `core_ubicacion_ciudad`       ON core_ubicacion_ciudad.idCiudad        = telemetria_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`      ON core_ubicacion_comunas.idComuna       = telemetria_listado.idComuna

WHERE idTelemetria = ".simpleDecode($_GET['view'], fecha_actual());
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

//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnimed');

$arrFinalUnimed = array();
foreach ($arrUnimed as $sen) {
	$arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];
}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Equipo <?php echo $rowdata['Nombre']; ?></h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>

				<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
				<li class=""><a href="#mediciones" data-toggle="tab"><i class="fa fa-wifi" aria-hidden="true"></i> Ultimas Mediciones</a></li>
				<?php } ?>

				<li class=""><a href="#alertas" data-toggle="tab"><i class="fa fa-bullhorn"  aria-hidden="true"></i> Alertas</a></li>
				<li class=""><a href="#flinea" data-toggle="tab"><i class="fa fa-power-off" aria-hidden="true"></i> Fuera de Linea</a></li>

			</ul>
		</header>
        <div class="tab-content">

			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/maquina.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php } ?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h2 class="text-primary">Datos del Equipo</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['Comuna'].', '.$rowdata['Ciudad']; ?><br/>
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
						
						//numero sensores equipo
						$N_Maximo_Sensores = 72;
						$subquery = '';
						for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
							$subquery .= ',SensoresNombre_'.$i;
							$subquery .= ',SensoresUniMed_'.$i;
							$subquery .= ',SensoresActivo_'.$i;
							$subquery .= ',SensoresMedActual_'.$i;
						}
						// consulto los datos
						$query = "SELECT Nombre,id_Sensores,cantSensores,LastUpdateFecha,LastUpdateHora,
						GeoVelocidad
						".$subquery."

						FROM `telemetria_listado`
						WHERE idTelemetria = ".simpleDecode($_GET['view'], fecha_actual());
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
						
						?>

						<div class="table-responsive">

							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_sensores_view_equipo_mediciones.php?view='.simpleDecode($_GET['view'], fecha_actual()).'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default pull-right margin_width fmrbtn" >Ver Ubicacion</a>
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_2.php?view='.simpleDecode($_GET['view'], fecha_actual()); ?>" class="btn btn-default pull-right margin_width fmrbtn" >Informe Medicion Sensores</a>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>

								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>#</th>
											<th>Nombre</th>
											<th>Fecha/hora</th>
											<th>Medicion Actual</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
											//solo sensores activos
											if(isset($rowMed['SensoresActivo_'.$i])&&$rowMed['SensoresActivo_'.$i]==1){ 
												$unimed = ' '.$arrFinalUnimed[$rowMed['SensoresUniMed_'.$i]];
												?>
												<tr class="odd">
													<td><?php echo 's'.$i ?></td>
													<td><?php echo $rowMed['SensoresNombre_'.$i]; ?></td>
													<td><?php echo fecha_estandar($rowMed['LastUpdateFecha']).' - '.$rowMed['LastUpdateHora'].' hrs'; ?></td>
													<td><?php 
													if(isset($rowMed['SensoresMedActual_'.$i])&&$rowMed['SensoresMedActual_'.$i]<99900){
														echo Cantidades_decimales_justos($rowMed['SensoresMedActual_'.$i]).$unimed;
													}else{
														echo 'Sin Datos';
													} ?>
													</td>
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
						WHERE telemetria_listado_errores.idTelemetria = ".simpleDecode($_GET['view'], fecha_actual())."
						AND telemetria_listado_errores.idTipo!='999'
						AND telemetria_listado_errores.Valor<'99900'
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
						while ( $row = mysqli_fetch_assoc ($resultado)){
						array_push( $arrAlertas,$row );
						}
						
						?>

						<div class="table-responsive">

							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_2.php?idTelemetria='.simpleDecode($_GET['view'], fecha_actual()).'&submit_filter=Filtrar'; ?>" class="btn btn-default pull-right margin_width fmrbtn" >Abrir Reporte</a>
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
										$unimed = ' '.$arrFinalUnimed[$error['SensoresUniMed_'.$error['Sensor']]]; ?>
										<tr>
											<td><?php echo $error['Descripcion']; ?></td>
											<td><?php echo fecha_estandar($error['Fecha']); ?></td>
											<td><?php echo $error['Hora']; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor']).$unimed; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor_min']).$unimed; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor_max']).$unimed; ?></td>
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_2_view.php?view='.$error['idErrores']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
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
						WHERE idTelemetria = ".simpleDecode($_GET['view'], fecha_actual())."
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
						while ( $row = mysqli_fetch_assoc ($resultado)){
						array_push( $arrFlinea,$row );
						}
						?>

						<div class="table-responsive">

							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_2.php?idTelemetria='.simpleDecode($_GET['view'], fecha_actual()).'&submit_filter=Filtrar'; ?>" class="btn btn-default pull-right margin_width fmrbtn" >Abrir Reporte</a>
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
													<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_2_view.php?view='.$error['idFueraLinea']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
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

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';

?>
