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
alumnos_elearning_listado.Nombre, 
alumnos_elearning_listado.Resumen, 
alumnos_elearning_listado.Imagen,
alumnos_elearning_listado.LastUpdate,
alumnos_elearning_listado.Objetivos,
alumnos_elearning_listado.Requisitos,
alumnos_elearning_listado.Descripcion

FROM `alumnos_elearning_listado`
WHERE alumnos_elearning_listado.idElearning = {$_GET['view']}";
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

// Se trae un listado con todos los usuarios
$arrContenidos = array();
$query = "SELECT
alumnos_elearning_listado_unidades.idUnidad AS Unidad_ID, 
alumnos_elearning_listado_unidades.N_Unidad AS Unidad_Numero, 
alumnos_elearning_listado_unidades.Nombre AS Unidad_Nombre,
alumnos_elearning_listado_unidades.Duracion AS Unidad_Duracion,
alumnos_elearning_listado_unidades_contenido.idContenido AS Contenido_ID,
alumnos_elearning_listado_unidades_contenido.Nombre AS Contenido_Nombre

FROM `alumnos_elearning_listado_unidades`
LEFT JOIN `alumnos_elearning_listado_unidades_contenido` ON alumnos_elearning_listado_unidades_contenido.idUnidad = alumnos_elearning_listado_unidades.idUnidad
WHERE alumnos_elearning_listado_unidades.idElearning = {$_GET['view']}
ORDER BY alumnos_elearning_listado_unidades.N_Unidad ASC ";
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
array_push( $arrContenidos,$row );
}

// Se trae un listado con todos los usuarios
$arrFiles = array();
$query = "SELECT idDocumentacion, idUnidad, idElearning, idContenido, File
FROM `alumnos_elearning_listado_unidades_documentacion`
WHERE idElearning = {$_GET['view']}
ORDER BY File ASC ";
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
array_push( $arrFiles,$row );
}

$Dias_Duracion = 0;
filtrar($arrContenidos, 'Unidad_Numero');  
foreach($arrContenidos as $categoria=>$permisos){
	$Dias_Duracion = $Dias_Duracion + $permisos[0]['Unidad_Duracion'];
}

	

?>






	<div class="col-sm-12">
		<div class="box">	
			<header>		
				<div class="icons"><i class="fa fa-table"></i></div><h5>Datos Basicos</h5>
			</header>
			<div class="tab-content">
				<div class="table-responsive">    
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<tr>
								<td class="meta-head">Nombre Elearning</td>
								<td><?php echo $rowdata['Nombre']; ?></td>
							</tr>
							<tr>
								<td class="meta-head">Dias de Duracion</td>
								<td><?php echo $Dias_Duracion.' dias'; ?></td>
							</tr>
							<tr>
								<td class="meta-head">Resumen</td>
								<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Resumen']; ?></span></td>
							</tr> 
							<tr>
								<td class="meta-head">Ultima Actualizacion</td>
								<td><?php echo fecha_estandar($rowdata['LastUpdate']); ?></td>
							</tr> 
							<tr>
								<td class="meta-head">Objetivos</td>
								<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Objetivos']; ?></span></td>
							</tr> 
							<tr>
								<td class="meta-head">Requisitos</td>
								<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Requisitos']; ?></span></td>
							</tr> 
							<tr>
								<td class="meta-head">Descripcion</td>
								<td><span style="word-wrap: break-word;white-space: initial;"><?php echo $rowdata['Descripcion']; ?></span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	


	<div class="col-sm-12">
		<div class="box">	
			<header>		
				<div class="icons"><i class="fa fa-table"></i></div><h5>Contenido</h5>
			</header>
			<div class="tab-content">
				<div class="table-responsive">    
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							
							<?php 
							//filtrar($arrContenidos, 'Unidad_Numero');  
							foreach($arrContenidos as $categoria=>$permisos){?>
								<tr class="odd" >
									<td style="background-color:#DDD"><strong>Unidad <?php echo $categoria; ?></strong> - <?php echo $permisos[0]['Unidad_Nombre'].' ('.$permisos[0]['Unidad_Duracion'].' dias de duracion)'; ?></td>
								</tr>
								<?php foreach ($permisos as $preg) { 
									if(isset($preg['Contenido_Nombre'])&&$preg['Contenido_Nombre']!=''){?>
										<tr class="item-row linea_punteada">
											<td class="item-name">
												<span style="word-wrap: break-word;white-space: initial;"><?php echo $preg['Contenido_Nombre']; ?></span>	
												<hr>	
												<?php foreach ($arrFiles as $file) {
													//verifico que el archivo sea del contenido
													if(isset($preg['Unidad_ID'])&&$preg['Unidad_ID']==$file['idUnidad']&&isset($preg['Contenido_ID'])&&$preg['Contenido_ID']==$file['idContenido']){ ?>
														<div class="col-sm-12">
															<?php 
															$f_file = str_replace('elearning_files_'.$file['idContenido'].'_','',$file['File']);
															echo $f_file; 
															?>
														</div>
													<?php } ?>
												<?php } ?>
											
											</td>			
										</tr>
									<?php } ?> 
								<?php } ?> 
							<?php } ?> 
											  
						</tbody>
					</table>
				</div>
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
