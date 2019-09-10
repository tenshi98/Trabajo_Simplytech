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
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT  
prospectos_transportistas_listado.Nombre,
prospectos_transportistas_listado.Fono, 
prospectos_transportistas_listado.email, 
prospectos_transportistas_listado.email_noti, 
prospectos_transportistas_listado.F_Ingreso, 

core_sistemas.Nombre AS Sistema,
prospectos_estado_fidelizacion.Nombre AS Fidelizacion,
prospectos_transportistas_etapa.Nombre AS Etapa

FROM `prospectos_transportistas_listado`
LEFT JOIN `core_sistemas`                     ON core_sistemas.idSistema                              = prospectos_transportistas_listado.idSistema
LEFT JOIN `prospectos_estado_fidelizacion`    ON prospectos_estado_fidelizacion.idEstadoFidelizacion  = prospectos_transportistas_listado.idEstadoFidelizacion
LEFT JOIN `prospectos_transportistas_etapa`   ON prospectos_transportistas_etapa.idEtapa              = prospectos_transportistas_listado.idEtapa

WHERE prospectos_transportistas_listado.idProspecto = {$_GET['view']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	

/**********************************************************/
// Se trae un listado con todas las observaciones el Prospecto
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
prospectos_transportistas_observaciones.Fecha,
prospectos_transportistas_observaciones.Observacion
FROM `prospectos_transportistas_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = prospectos_transportistas_observaciones.idUsuario
WHERE prospectos_transportistas_observaciones.idProspecto = {$_GET['view']}
ORDER BY prospectos_transportistas_observaciones.idObservacion ASC 
LIMIT 15 ";
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
array_push( $arrObservaciones,$row );
}

// Se trae un listado con todas las etapa el Prospecto
$arrEtapa = array();
$query = "SELECT 
prospectos_transportistas_etapa_fidelizacion.idEtapaFide,
usuarios_listado.Nombre AS nombre_usuario,
prospectos_transportistas_etapa_fidelizacion.Fecha,
prospectos_transportistas_etapa.Nombre AS Etapa

FROM `prospectos_transportistas_etapa_fidelizacion`
LEFT JOIN `usuarios_listado`                ON usuarios_listado.idUsuario               = prospectos_transportistas_etapa_fidelizacion.idUsuario
LEFT JOIN `prospectos_transportistas_etapa` ON prospectos_transportistas_etapa.idEtapa  = prospectos_transportistas_etapa_fidelizacion.idEtapa

WHERE prospectos_transportistas_etapa_fidelizacion.idProspecto = {$_GET['view']}
ORDER BY prospectos_transportistas_etapa.Nombre DESC ";
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
array_push( $arrEtapa,$row );
}




?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Prospecto</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<?php if(!empty($arrObservaciones)){ ?>
					<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>
				<?php } ?>
				<?php if(!empty($arrEtapa)){ ?>
					<li class=""><a href="#etapas" data-toggle="tab">Etapas</a></li>
				<?php } ?>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/usr.png">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Prospecto</h2>
						<p class="text-muted">
							<strong>Nombre Prospecto: </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Telefono : </strong><?php echo $rowdata['Fono']; ?><br/>
							<strong>Email Prospecto: </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
							<strong>Email Respuesta: </strong><a href="mailto:<?php echo $rowdata['email_noti']; ?>"><?php echo $rowdata['email_noti']; ?></a><br/>
							<strong>Fecha de Registro : </strong><?php echo Fecha_estandar($rowdata['F_Ingreso']); ?><br/>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['Sistema']; ?><br/>
							<strong>Estado Fidelizacion: </strong><?php echo $rowdata['Fidelizacion']; ?><br/>
							<strong>Etapa Fidelizacion: </strong><?php echo $rowdata['Etapa']; ?>
						</p>
					</div>
					
				</div>
			</div>
			
			<?php if(!empty($arrObservaciones)){ ?>
				<div class="tab-pane fade" id="observaciones">
					<div class="wmd-panel">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Autor</th>
										<th width="120">Fecha</th>
										<th>Observacion</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrObservaciones as $observaciones) { ?>
									<tr class="odd">		
										<td><?php echo $observaciones['nombre_usuario']; ?></td>
										<td><?php echo $observaciones['Fecha']; ?></td>		
										<td class="word_break"><?php echo $observaciones['Observacion']; ?></td>	
									</tr>
								<?php } ?>                    
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php if(!empty($arrEtapa)){ ?>
				<div class="tab-pane fade" id="etapas">
					<div class="wmd-panel">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th width="120">Fecha</th>
										<th>Autor</th>
										<th>Etapa</th>
										<th width="10">Acciones</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrEtapa as $etapa) { ?>
										<tr class="odd">		
											<td><?php echo fecha_estandar($etapa['Fecha']); ?></td>		
											<td><?php echo $etapa['nombre_usuario']; ?></td>
											<td><?php echo $etapa['Etapa']; ?></td>	
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a href="<?php echo 'view_prospecto_etapa.php?view='.$etapa['idEtapaFide'].'&return=true'; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
												</div>
											</td>	
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


<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>