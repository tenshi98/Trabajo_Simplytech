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
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
// consulto los datos
$query = "SELECT  
alumnos_cursos.Nombre AS CursoNombre,
alumnos_cursos.Semanas AS CursoSemanas,
alumnos_cursos.F_inicio AS CursoF_inicio,
alumnos_cursos.F_termino AS CursoF_termino,
core_estados.Nombre AS CursoEstado,
core_sistemas.Nombre AS CursoSistema

FROM `alumnos_cursos`
LEFT JOIN `core_sistemas`       ON core_sistemas.idSistema      = alumnos_cursos.idSistema
LEFT JOIN `core_estados`        ON core_estados.idEstado        = alumnos_cursos.idEstado
WHERE alumnos_cursos.idCurso = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
$rowdata = mysqli_fetch_assoc ($resultado);

//Listado con los elearning
$arrElearnng = array();
$query = "SELECT 
alumnos_elearning_listado.Nombre AS NombreElearning

FROM `alumnos_cursos_elearning`
LEFT JOIN `alumnos_elearning_listado`   ON alumnos_elearning_listado.idElearning     = alumnos_cursos_elearning.idElearning
WHERE alumnos_cursos_elearning.idCurso = ".$X_Puntero."
ORDER BY alumnos_elearning_listado.Nombre ASC  ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrElearnng,$row );
}

// Se trae un listado con todos los elementos
$arrArchivos = array();
$query = "SELECT idDocumentacion, File, Semana
FROM `alumnos_cursos_documentacion`
WHERE idCurso = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrArchivos,$row );
}

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Grupo</h5>
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">
					
						<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/training.jpg">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary">Datos Basicos</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['CursoNombre']; ?><br/>
							<strong>Semanas : </strong><?php echo $rowdata['CursoSemanas'].' semanas de duracion'; ?><br/>
							<strong>Fecha de Inicio : </strong><?php echo Fecha_completa($rowdata['CursoF_inicio']); ?><br/>
							<strong>Fecha de Termino : </strong><?php echo Fecha_completa($rowdata['CursoF_termino']); ?><br/>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['CursoSistema']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['CursoEstado']; ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Elearnings  Relacionados</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php foreach ($arrElearnng as $permiso) {?>
									<tr><td><?php echo $permiso['NombreElearning']; ?></td></tr> 
								<?php } ?>
							</tbody>
						</table>
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos Relacionados</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php foreach ($arrArchivos as $ciudad) { ?>
									<tr class="odd">
										<?php /*<td><?php echo 'Semana '.$ciudad['Semana']; ?></td>*/ ?>
										<td><?php echo $ciudad['File']; ?></td>
										<td>
											<div class="btn-group" style="width: 70px;" >
												<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($ciudad['File'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Documento" class="btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						
				
					</div>	
					<div class="clearfix"></div>
					
					
					</div>
				</div>
			</div>
			
			
        </div>	
	</div>
</div>


<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
