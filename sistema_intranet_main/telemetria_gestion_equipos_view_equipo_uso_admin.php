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

/*************************************************************************/
// consulto los datos
$query = "SELECT Nombre, cantSensores, Direccion_img
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

/*************************************************************************/
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
// consulto los datos
$query = "SELECT Nombre
".$aa."
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
//Cuento si hay sensores activos
$rowcount = 0;
for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
	if(isset($rowMed['SensoresUso_'.$i])&&$rowMed['SensoresUso_'.$i]==1){
		$rowcount++;
	}
}

?>

<div class="col-sm-12 breadcrumb-bar">
	<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_listado.php?pagina=1&id='.simpleDecode($_GET['view'], fecha_actual()); ?>" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Editar Equipo</a>
</div>
<div class="clearfix"></div> 


<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Equipo <?php echo $rowdata['Nombre']; ?></h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#uso" data-toggle="tab"><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="uso">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/maquina.jpg">
						<?php }else{  ?>
							<?php if (isset($_GET['data_1'])&&$_GET['data_1']=='si') { ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo 'https://'.$_GET['data_2'].$rowdata['Direccion_img']; ?>">
							<?php }else{  ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
							<?php }?>	
						<?php }?>
					</div>
					<div class="col-sm-8">
						<?php
						//verifico los resultados y muestro la tabla
						if(isset($rowcount)&&$rowcount!=0){ ?>
							<div class="col-sm-12">
								<div class="box">	
									<header>		
										<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Sensores Supervisados</h5>
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
							<div style="margin-top:15px;">
								<?php 
								$Alert_Text  = 'No existen sensores configurados para la supervision';
								alert_post_data(2,1,1, $Alert_Text);
								?>
							</div>
						<?php } ?>
					</div>	
					<div class="clearfix"></div>
					
					
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
