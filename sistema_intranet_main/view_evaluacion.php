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
alumnos_evaluaciones_asignadas.idAsignadas,
alumnos_evaluaciones_asignadas.Programada_fecha,
alumnos_evaluaciones_asignadas.N_preguntas,
alumnos_evaluaciones_asignadas.N_Alumnos,
alumnos_evaluaciones_asignadas.N_Alumnos_Falla,
alumnos_evaluaciones_asignadas.N_Alumnos_Rep,
alumnos_evaluaciones_asignar.Nombre AS Asignar,
alumnos_cursos.Nombre AS Curso,
quiz_listado.Nombre AS Quiz,
core_sistemas.Nombre AS Sistema

FROM `alumnos_evaluaciones_asignadas`
LEFT JOIN `alumnos_evaluaciones_asignar`   ON alumnos_evaluaciones_asignar.idAsignar   = alumnos_evaluaciones_asignadas.idAsignar
LEFT JOIN `alumnos_cursos`                 ON alumnos_cursos.idCurso                   = alumnos_evaluaciones_asignadas.idCurso
LEFT JOIN `quiz_listado`                   ON quiz_listado.idQuiz                      = alumnos_evaluaciones_asignadas.idQuiz
LEFT JOIN `core_sistemas`                  ON core_sistemas.idSistema                  = alumnos_evaluaciones_asignadas.idSistema
WHERE alumnos_evaluaciones_asignadas.idAsignadas={$_GET['view']}";
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
// Se trae un listado con todas las observaciones el cliente
$arrAlumnos = array();
$query = "SELECT 
alumnos_listado.Nombre AS AlumnoNombre,
alumnos_listado.ApellidoPat AS AlumnoApellidoPat,
alumnos_listado.ApellidoMat AS AlumnoApellidoMat,
alumnos_evaluaciones_asignadas_alumnos.idTipo,
alumnos_evaluaciones_asignadas_alumnos.Programada_fecha

FROM `alumnos_evaluaciones_asignadas_alumnos`
LEFT JOIN `alumnos_listado`   ON alumnos_listado.idAlumno     = alumnos_evaluaciones_asignadas_alumnos.idAlumno
WHERE alumnos_evaluaciones_asignadas_alumnos.idAsignadas = {$_GET['view']}
";
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
array_push( $arrAlumnos,$row );
}


?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos de la evaluacion</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#alumnos" data-toggle="tab">Alumnos</a></li>
				<li class=""><a href="#fallas" data-toggle="tab">Fallas</a></li>
				<li class=""><a href="#reintentos" data-toggle="tab">Reintentos</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/evaluation.jpg">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Tipo Asignacion : </strong><?php echo $rowdata['Asignar']; ?><br/>
							<strong>Grupo: </strong><?php echo $rowdata['Curso']; ?><br/>
							<strong>Evaluacion : </strong><?php echo $rowdata['Quiz']; ?><br/>
							<strong>Fecha Programada : </strong><?php echo fecha_estandar($rowdata['Programada_fecha']); ?><br/>
							<strong>N° Preguntas : </strong><?php echo $rowdata['N_preguntas']; ?><br/>
							<strong>N° Alumnos : </strong><?php echo $rowdata['N_Alumnos']; ?><br/>
							<strong>N° Fallas : </strong><?php echo $rowdata['N_Alumnos_Falla']; ?><br/>
							<strong>N° Reintentos : </strong><?php echo $rowdata['N_Alumnos_Rep']; ?><br/>
						</p>

					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
			
	
			<div class="tab-pane fade" id="alumnos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Nombre</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrAlumnos as $alum) { 
									if(isset($alum['idTipo'])&&$alum['idTipo']==1){?>
										<tr class="odd">		
											<td><?php echo $alum['AlumnoNombre'].' '.$alum['AlumnoApellidoPat'].' '.$alum['AlumnoApellidoMat']; ?></td>
											<td><?php echo $alum['Programada_fecha']; ?></td>		
										</tr>
									<?php } ?>  
								<?php } ?>                      
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="fallas">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Nombre</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrAlumnos as $alum) { 
									if(isset($alum['idTipo'])&&$alum['idTipo']==3){?>
										<tr class="odd">		
											<td><?php echo $alum['AlumnoNombre'].' '.$alum['AlumnoApellidoPat'].' '.$alum['AlumnoApellidoMat']; ?></td>
											<td><?php echo $alum['Programada_fecha']; ?></td>		
										</tr>
									<?php } ?>  
								<?php } ?>                      
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="reintentos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Nombre</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrAlumnos as $alum) { 
									if(isset($alum['idTipo'])&&$alum['idTipo']==2){?>
										<tr class="odd">		
											<td><?php echo $alum['AlumnoNombre'].' '.$alum['AlumnoApellidoPat'].' '.$alum['AlumnoApellidoMat']; ?></td>
											<td><?php echo $alum['Programada_fecha']; ?></td>		
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
