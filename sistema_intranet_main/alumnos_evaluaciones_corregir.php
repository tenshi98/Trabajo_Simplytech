<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "alumnos_evaluaciones_corregir.php";
$location = $original;
//Se agregan ubicaciones
$location .='?submit_filter=Filtrar';			
/********************************************************************/
//Variables para filtro y paginacion
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){                $location .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['idCurso']) && $_GET['idCurso'] != ''){                    $location .= "&idCurso=".$_GET['idCurso'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){                  $location .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['idQuiz']) && $_GET['idQuiz'] != ''){                      $location .= "&idQuiz=".$_GET['idQuiz'];}
if(isset($_GET['idTipoEvaluacion']) && $_GET['idTipoEvaluacion'] != ''){  $location .= "&idTipoEvaluacion=".$_GET['idTipoEvaluacion'];}
if(isset($_GET['idTipoQuiz']) && $_GET['idTipoQuiz'] != ''){              $location .= "&idTipoQuiz=".$_GET['idTipoQuiz'];}
if(isset($_GET['idLimiteTiempo']) && $_GET['idLimiteTiempo'] != ''){      $location .= "&idLimiteTiempo=".$_GET['idLimiteTiempo'];}
    
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'upd_mod';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_evaluaciones_asignar.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/ 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Evaluacion creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Evaluacion editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Evaluacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos del trabajador
$query = "SELECT idEstadoAprobacion
FROM `quiz_realizadas`
WHERE idQuizRealizadas = {$_GET['id']}";
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
	
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Modificacion Evaluacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idEstadoAprobacion)) {  $x1  = $idEstadoAprobacion; }else{$x1  = $rowdata['idEstadoAprobacion'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Estado Aprobacion','idEstadoAprobacion', $x1, 2, 'idEstadoAprobacion', 'Nombre', 'core_estado_aprobacion_evaluacion', 'idEstadoAprobacion!=3', '', $dbConn);
				
				
				$Form_Imputs->form_input_hidden('idQuizRealizadas', $_GET['id'], 2);
				?>
								
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?>
			
			
		</div>
	</div>
</div>	
	
	
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['submit_filter']) ) { 
             
  
//Solo las que correspondan		
$z     = "WHERE quiz_realizadas.idQuizRealizadas!=0"; 
//Tipo de usuario
$z.= " AND quiz_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

if(isset($_GET['idCurso'])&&$_GET['idCurso']!=''){                     $z.=" AND alumnos_listado.idCurso={$_GET['idCurso']}";}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){                   $z.=" AND quiz_listado.idEstado={$_GET['idEstado']}";}
if(isset($_GET['idQuiz'])&&$_GET['idQuiz']!=''){                       $z.=" AND quiz_realizadas.idQuiz={$_GET['idQuiz']}";}
if(isset($_GET['idTipoEvaluacion'])&&$_GET['idTipoEvaluacion']!=''){   $z.=" AND quiz_listado.idTipoEvaluacion={$_GET['idTipoEvaluacion']}";}
if(isset($_GET['idTipoQuiz'])&&$_GET['idTipoQuiz']!=''){               $z.=" AND quiz_listado.idTipoQuiz={$_GET['idTipoQuiz']}";}
if(isset($_GET['idLimiteTiempo'])&&$_GET['idLimiteTiempo']!=''){       $z.=" AND quiz_listado.idLimiteTiempo={$_GET['idLimiteTiempo']}";}
			
/*************************************************************************************************/
//Evaluaciones
$arrAlumnos = array();
$query = "SELECT 
quiz_realizadas.idQuizRealizadas,
quiz_listado.Nombre AS NombreEvaluacion,
quiz_realizadas.Programada_fecha,
quiz_realizadas.Total_Preguntas,
quiz_realizadas.Duracion_Max,
core_estado_aprobacion_evaluacion.Nombre AS Evaluacion,
quiz_realizadas.Respondido AS PromRespondido,
quiz_realizadas.Correctas AS PromCorrectas,
quiz_realizadas.Rendimiento AS PromRendimiento,
alumnos_listado.Nombre AS AlumnoNombre,
alumnos_listado.ApellidoPat AS AlumnoApellidoPat

FROM `quiz_realizadas`
LEFT JOIN `quiz_listado`                         ON quiz_listado.idQuiz                                    = quiz_realizadas.idQuiz
LEFT JOIN `alumnos_listado`                      ON alumnos_listado.idAlumno                               = quiz_realizadas.idAlumno
LEFT JOIN `core_estado_aprobacion_evaluacion`    ON core_estado_aprobacion_evaluacion.idEstadoAprobacion   = quiz_realizadas.idEstadoAprobacion
".$z." 
ORDER BY alumnos_listado.idCurso ASC, quiz_realizadas.idQuiz ASC";
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
array_push( $arrAlumnos,$row );
}
?>


<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Alumnos</h5>	
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Evaluacion</th>
						<th>Alumno</th>
						<th>Fecha</th>
						<th>Total Preguntas</th>
						<th>Duracion</th>
						<th>Promedio <br/>Respondido</th>
						<th>Promedio <br/>Correctas</th>
						<th>Promedio <br/>Rendimiento</th>
						<th>Estado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrAlumnos as $eva) { ?>
						<tr class="odd">		
							<td><?php echo $eva['NombreEvaluacion']; ?></td>		
							<td><?php echo $eva['AlumnoNombre'].' '.$eva['AlumnoApellidoPat']; ?></td>		
							<td><?php echo fecha_estandar($eva['Programada_fecha']); ?></td>		
							<td><?php echo $eva['Total_Preguntas']; ?></td>		
							<td><?php echo $eva['Duracion_Max']; ?></td>		
							<td><?php echo Cantidades($eva['PromRespondido'], 1); ?></td>		
							<td><?php echo Cantidades($eva['PromCorrectas'], 1); ?></td>		
							<td><?php echo Cantidades($eva['PromRendimiento'], 1); ?></td>		
							<td><?php echo $eva['Evaluacion']; ?></td>
							<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$eva['idQuizRealizadas']; ?>" title="Editar Evaluacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
							</div>
						</td>		
						</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>  
	</div>
</div>
 
 
 
 
 
 
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
	


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

 
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;         }else{$x1  = '';}
				if(isset($idCurso)) {          $x2  = $idCurso;           }else{$x2  = '';}
				if(isset($idEstado)) {         $x3  = $idEstado;          }else{$x3  = '';}
				if(isset($idQuiz)) {           $x4  = $idQuiz;            }else{$x4  = '';}
				if(isset($idTipoEvaluacion)) { $x5  = $idTipoEvaluacion;  }else{$x5  = '';}
				if(isset($idTipoQuiz)) {       $x6  = $idTipoQuiz;        }else{$x6  = '';}
				if(isset($idLimiteTiempo)) {   $x7  = $idLimiteTiempo;    }else{$x7  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_depend1('Clientes','idCliente', $x1, 2, 'idCliente', 'Nombre', 'clientes_listado', $z, 0,
										'Grupo','idCurso', $x2, 2, 'idCurso', 'Nombre', 'alumnos_cursos', 'idEstado=1', 0, 
										$dbConn, 'form1');
				$Form_Imputs->form_select_depend1('Estado','idEstado', $x3, 2, 'idEstado', 'Nombre', 'core_estados', 0, 0,
										'Evaluacion','idQuiz', $x4, 2, 'idQuiz', 'Nombre', 'quiz_listado', $z, 0, 
										$dbConn, 'form1');
				$Form_Imputs->form_select('Tipo Puntuacion','idTipoEvaluacion', $x5, 1, 'idTipoEvaluacion', 'Nombre', 'quiz_tipo_evaluacion', 0, '', $dbConn);
				$Form_Imputs->form_select('Tipo de Evaluacion','idTipoQuiz', $x6, 1, 'idTipoQuiz', 'Nombre', 'quiz_tipo_quiz', 0, '', $dbConn);
				$Form_Imputs->form_select('Tiempo Limite','idLimiteTiempo', $x7, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
								
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div> 
<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
