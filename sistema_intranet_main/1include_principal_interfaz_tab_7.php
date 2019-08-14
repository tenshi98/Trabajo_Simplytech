<?php
/**************************************************************************/
//Cross
$temp = $prm_x[38] + $prm_x[39] + $prm_x[40] + $prm_x[41];					
if($temp!=0) {
	
//Se traen todas las solicitudes		
$arrSolicitud = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado.idEstado,
cross_solicitud_aplicacion_listado.f_programacion,
cross_solicitud_aplicacion_listado.horaProg,
cross_predios_listado.Nombre AS NombrePredio

FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `cross_predios_listado`     ON cross_predios_listado.idPredio      = cross_solicitud_aplicacion_listado.idPredio
WHERE cross_solicitud_aplicacion_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']."
ORDER BY cross_solicitud_aplicacion_listado.idEstado ASC
LIMIT 100";
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
array_push( $arrSolicitud,$row );
}

?>

	<div class="tab-pane fade" id="Menu_tab_7">
		
		<div class="col-sm-12" style="margin-top:30px">
			<div class="bootstrap snippet">
				<div class="alert alert-info alert-white rounded">
					<div class="icon">
						<i class="fa fa-info-circle"></i>
					</div>
					Descargar APP SmartFlux  
					<a href="1download.php?dir=app&file=smartflux.apk" title="Descargar APP" class="btn btn-primary btn-sm" ><i class="fa fa-download"></i> Descargar</a>
				</div>     
			</div>
		</div>
		

			
		<div class="col-sm-12">
			<div class="box">	
				<header>		
					<div class="icons"><i class="fa fa-table"></i></div><h5>Monitor de aplicaciones</h5>
					<div class="toolbar">
						<a target="new" href="informe_busqueda_solicitud_aplicacion_01.php" class="btn btn-xs btn-primary btn-line">Busqueda Solicitud</a>
					</div>
				</header>
				<div class="table-responsive">
					<div class="col-sm-4">
						<div class="row">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th colspan="4">Programadas</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrSolicitud as $sol) { ?>
										<?php if(isset($sol['idEstado'])&&$sol['idEstado']==1){ ?>
											<tr class="odd">		
												<td><?php echo n_doc($sol['idSolicitud'], 5); ?></td>	
												<td><?php echo Fecha_estandar($sol['f_programacion']).' '.$sol['horaProg']; ?></td>	
												<td><?php echo $sol['NombrePredio']; ?></td>
												<td>
													<div class="btn-group" style="width: 105px;" >
														<a href="<?php echo 'view_solicitud_aplicacion.php?view='.$sol['idSolicitud']; ?>" title="Ver Solicitud" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'cross_solicitud_aplicacion_editar.php?view='.$sol['idSolicitud']; ?>" title="Editar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
														<a href="<?php echo 'cross_solicitud_aplicacion_ejecutar.php?submit_filter=Filtrar&ejecution='.$sol['idSolicitud']; ?>" title="Ejecutar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-arrow-right"></i></a>							
													</div>
												</td>	
											</tr>
										<?php } ?>   
									<?php } ?>                    
								</tbody>
							</table>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="row">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th colspan="4">En Ejecucion</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrSolicitud as $sol) { ?>
										<?php if(isset($sol['idEstado'])&&$sol['idEstado']==2){ ?>
											<tr class="odd">		
												<td><?php echo n_doc($sol['idSolicitud'], 5); ?></td>	
												<td><?php echo Fecha_estandar($sol['f_programacion']).' '.$sol['horaProg']; ?></td>	
												<td><?php echo $sol['NombrePredio']; ?></td>
												<td>
													<div class="btn-group" style="width: 105px;" >
														<a href="<?php echo 'view_solicitud_aplicacion.php?view='.$sol['idSolicitud']; ?>" title="Ver Solicitud" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'cross_solicitud_aplicacion_editar.php?view='.$sol['idSolicitud']; ?>" title="Editar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
														<a href="<?php echo 'cross_solicitud_aplicacion_ejecucion.php?submit_filter=Filtrar&termino='.$sol['idSolicitud']; ?>" title="Terminar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-check-square-o"></i></a>							
													</div>
												</td>	
											</tr>
										<?php } ?>   
									<?php } ?>                    
								</tbody>
							</table>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="row">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th colspan="4">Terminadas</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrSolicitud as $sol) { ?>
										<?php if(isset($sol['idEstado'])&&$sol['idEstado']==3){ ?>
											<tr class="odd">		
												<td><?php echo n_doc($sol['idSolicitud'], 5); ?></td>	
												<td><?php echo Fecha_estandar($sol['f_programacion']).' '.$sol['horaProg']; ?></td>	
												<td><?php echo $sol['NombrePredio']; ?></td>
												<td>
													<div class="btn-group" style="width: 70px;" >
														<a href="<?php echo 'view_solicitud_aplicacion.php?view='.$sol['idSolicitud']; ?>" title="Ver Solicitud" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'cross_solicitud_aplicacion_editar.php?view='.$sol['idSolicitud']; ?>" title="Editar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
													</div>
												</td>	
											</tr>
										<?php } ?>   
									<?php } ?>                    
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<?php require_once '../LIBS_js/modal/modal.php';?>
	</div>
	
<?php } ?>






