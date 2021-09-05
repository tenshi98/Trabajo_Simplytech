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
$query = "SELECT Nombre, IdentificadorEmpresa, LimiteVelocidad, cantSensores, id_Geo, id_Sensores, Direccion_img, TiempoFueraLinea, TiempoDetencion
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
$rowdata = mysqli_fetch_assoc ($resultado);


//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresUniMed_'.$i;
}
/*****************************************************************/
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
telemetria_listado_errores.Sensor
".$subquery."
						
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrAlertas,$row );
}
						
//Se traen todas las unidades de medida
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnimed');

$arrFinalUnimed = array();
foreach ($arrUnimed as $sen) {
	$arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];
}

/*************************************************************************/
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFlinea,$row );
}
?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Equipo <?php echo $rowdata['Nombre']; ?></h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				
				<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
					<li class=""><a href="#mediciones" data-toggle="tab"><i class="fa fa-wifi" aria-hidden="true"></i> Ultimas Mediciones</a></li>
				<?php } ?>
				<?php if(!empty($arrAlertas)){ ?>
					<li class=""><a href="#alertas" data-toggle="tab"><i class="fa fa-bullhorn"  aria-hidden="true"></i> Alertas</a></li>
				<?php } ?>
				<?php if(!empty($arrFlinea)){ ?>
					<li class=""><a href="#flinea" data-toggle="tab"><i class="fa fa-power-off" aria-hidden="true"></i> Fuera de Linea</a></li>
				<?php } ?>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/maquina.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary">Datos del Equipo</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Identificador Empresa : </strong><?php echo $rowdata['IdentificadorEmpresa']; ?><br/>
						</p>

						<h2 class="text-primary">Datos de Configuracion</h2>
						<p class="text-muted">
							<?php if($rowdata['id_Geo']==1){ ?>
							<strong>Limite Velocidad : </strong><?php echo Cantidades_decimales_justos($rowdata['LimiteVelocidad']).' KM/h'; ?><br/>
							<?php } ?>
							<?php if($rowdata['id_Sensores']==1){ ?>
							<strong>Cantidad de Sensores : </strong><?php echo $rowdata['cantSensores']; ?><br/>
							<?php } ?>
							<strong>Tiempo Fuera Linea Maximo : </strong><?php echo $rowdata['TiempoFueraLinea']; ?> Horas<br/>
							<strong>Tiempo Maximo Detencion : </strong><?php echo $rowdata['TiempoDetencion']; ?> Horas<br/>
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
							$subquery .= ',SensoresMedMin_'.$i;
							$subquery .= ',SensoresMedMax_'.$i;
							$subquery .= ',SensoresUniMed_'.$i;
							$subquery .= ',SensoresMedActual_'.$i;
							$subquery .= ',SensoresActivo_'.$i;
						}
						// consulto los datos
						$query = "SELECT Nombre,id_Geo, id_Sensores,cantSensores,LastUpdateFecha,LastUpdateHora,
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
								<?php if(isset($rowMed['id_Geo'])&&$rowMed['id_Geo']!=''&&$rowMed['id_Geo']==1){ ?>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_flota_view_equipo_mediciones.php?view='.simpleDecode($_GET['view'], fecha_actual()).'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ultima Ubicacion</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_1.php?view='.simpleDecode($_GET['view'], fecha_actual()); ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_velocidad.php?view='.simpleDecode($_GET['view'], fecha_actual()); ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Velocidades</a>
								<?php }elseif(isset($rowMed['id_Geo'])&&$rowMed['id_Geo']!=''&&$rowMed['id_Geo']==2){ ?>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_sensores_view_equipo_mediciones.php?view='.simpleDecode($_GET['view'], fecha_actual()).'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ultima Ubicacion</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_2.php?view='.simpleDecode($_GET['view'], fecha_actual()); ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
								<?php } ?>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
							<?php if(isset($rowdata['LimiteVelocidad'])&&$rowdata['LimiteVelocidad']!=0){ ?>
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>Parametro</th>
											<th>Fecha/hora</th>
											<th>Medicion Actual</th>
											<th>Maximo Medicion</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<tr class="odd <?php if($rowMed['GeoVelocidad'] > $rowdata['LimiteVelocidad']){echo 'danger';}?>">		
											<td>Velocidad</td>	
											<td><?php echo fecha_estandar($rowMed['LastUpdateFecha']).' - '.$rowMed['LastUpdateHora'].' hrs'; ?></td>
											<td><?php echo Cantidades($rowMed['GeoVelocidad'], 0).' KM/h'; ?></td>		
											<td><?php echo Cantidades($rowdata['LimiteVelocidad'], 0).' KM/h'; ?></td>
										</tr>
														   
									</tbody>
								</table>
							<?php } ?>
							
							  
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>#</th>
											<th>Nombre</th>
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
												$unimed = ' '.$arrFinalUnimed[$rowMed['SensoresUniMed_'.$i]];?>
												<tr class="odd <?php if($rowMed['SensoresMedActual_'.$i] < $rowMed['SensoresMedMin_'.$i] OR $rowMed['SensoresMedActual_'.$i]>$rowMed['SensoresMedMax_'.$i]){echo 'danger';}?>">		
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
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMin_'.$i]).$unimed; ?></td>		
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
			
			
			
			<?php if(!empty($arrAlertas)){ ?>
				<div class="tab-pane fade" id="alertas">
					<div class="wmd-panel">
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'.php?idTelemetria='.simpleDecode($_GET['view'], fecha_actual()).'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
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
										<?php if($rowdata['id_Geo']==1){ ?>
											<th>Ubicacion</th> 
										<?php } ?> 
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
											<?php if($rowdata['id_Geo']==1){ ?>
												<td>
													<div class="btn-group" style="width: 35px;" >
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'_view.php?view='.$error['idErrores']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
													</div>
												</td>
											<?php } ?> 		
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php if(!empty($arrFlinea)){ ?>	
				<div class="tab-pane fade" id="flinea">
					<div class="wmd-panel">
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'.php?idTelemetria='.simpleDecode($_GET['view'], fecha_actual()).'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
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
										<?php if($rowdata['id_Geo']==1){ ?>
											<th>Ubicacion</th> 
										<?php } ?> 
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
											<?php if($rowdata['id_Geo']==1){ ?>
												<td>
													<div class="btn-group" style="width: 35px;" >
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'_view.php?view='.$error['idFueraLinea']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
													</div>
												</td>
											<?php } ?> 		
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
			<?php } ?>
			
			
        </div>	
	</div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
