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
			body {background-color: #FFF !important;}
		</style>
	</head>

	<body>
<?php 
// Se traen todos los datos de la pregunta
$query = "SELECT
quiz_listado.Nombre,
quiz_listado.Header_texto,
quiz_listado.Header_fecha,
quiz_listado.Footer_texto,
quiz_listado.Texto_Inicio,
quiz_listado.Tiempo,
core_sistemas.Nombre AS sistema,
core_estados.Nombre AS Estado,
esc_1.Nombre AS Escala,
esc_2.Nombre AS Aprobado,
quiz_tipo_evaluacion.Nombre AS TipoEvaluacion,
quiz_tipo_quiz.Nombre AS TipoQuiz,
quiz_listado.idTipoEvaluacion,
quiz_listado.idTipoQuiz,
quiz_listado.idLimiteTiempo

FROM `quiz_listado`
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema                   = quiz_listado.idSistema
LEFT JOIN `core_estados`            ON core_estados.idEstado                     = quiz_listado.idEstado
LEFT JOIN `quiz_escala`  esc_1      ON esc_1.idEscala                            = quiz_listado.idEscala
LEFT JOIN `quiz_escala`  esc_2      ON esc_2.idEscala                            = quiz_listado.Porcentaje_apro
LEFT JOIN `quiz_tipo_evaluacion`    ON quiz_tipo_evaluacion.idTipoEvaluacion     = quiz_listado.idTipoEvaluacion
LEFT JOIN `quiz_tipo_quiz`          ON quiz_tipo_quiz.idTipoQuiz                 = quiz_listado.idTipoQuiz

WHERE quiz_listado.idQuiz = {$_GET['view']}";
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

// Se trae un listado con todas las preguntas
$arrPreguntas = array();
$query = "SELECT
quiz_listado_preguntas.idPregunta, 
quiz_listado_preguntas.Nombre AS Pregunta,
quiz_tipo.Nombre AS Tipo,
quiz_listado_preguntas.Opcion_1,
quiz_listado_preguntas.Opcion_2,
quiz_listado_preguntas.Opcion_3,
quiz_listado_preguntas.Opcion_4,
quiz_listado_preguntas.Opcion_5,
quiz_listado_preguntas.Opcion_6,
quiz_listado_preguntas.OpcionCorrecta,
quiz_listado_preguntas.idCategoria,
quiz_categorias.Nombre AS Categoria

FROM `quiz_listado_preguntas`
LEFT JOIN `quiz_tipo`        ON quiz_tipo.idTipo              = quiz_listado_preguntas.idTipo
LEFT JOIN `quiz_categorias`  ON quiz_categorias.idCategoria   = quiz_listado_preguntas.idCategoria
WHERE quiz_listado_preguntas.idQuiz = {$_GET['view']}
ORDER BY quiz_listado_preguntas.idCategoria ASC
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
array_push( $arrPreguntas,$row );
}


//cuento las preguntas
$count = 0;
foreach ($arrPreguntas as $preg) {
	$count++;
} 

?>

<?php if(isset($count)&&$count==0){ ?>
		
	<div class="col-sm-12">
		<div class="alert alert-danger" role="alert" style="margin-top:20px;">No tiene preguntas asignadas a la Quiz</div>
	</div>

<?php } ?>
<div class="clearfix"></div>  


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
								<td class="meta-head">Nombre</td>
								<td colspan="3"><?php echo $rowdata['Nombre']?></td>
							</tr>
							<tr>
								<td class="meta-head">Texto Cabecera</td>
								<td colspan="3"><?php echo $rowdata['Header_texto']; ?></td>
							</tr>
							<tr>
								<td class="meta-head">Fecha Cabecera</td>
								<td colspan="3"><?php echo fecha_estandar($rowdata['Header_fecha']); ?></td>
							</tr> 
							<tr>
								<td class="meta-head">Texto Contenido</td>
								<td colspan="3"><?php echo $rowdata['Texto_Inicio']; ?></td>
							</tr>
							<tr>
								<td class="meta-head">Texto Pie Pagina</td>
								<td colspan="3"><?php echo $rowdata['Footer_texto']; ?></td>
							</tr>
							<tr>
								<td class="meta-head">Sistema</td>
								<td><?php echo $rowdata['sistema']; ?></td>
								<td class="meta-head">Estado</td>
								<td><?php echo $rowdata['Estado']; ?></td>
							</tr> 
							<tr>
								<td class="meta-head">Tipo Puntuacion</td>
								<?php
								//Escala
								if(isset($rowdata['idTipoEvaluacion'])&&$rowdata['idTipoEvaluacion']==1){
									echo '<td colspan="3">'.$rowdata['TipoEvaluacion'].' : '.$rowdata['Escala'].'</td>';
								//Porcentaje	
								}else{
									echo '<td colspan="3">'.$rowdata['TipoEvaluacion'].' : '.$rowdata['Aprobado'].'</td>';
								}
								?>
							</tr>
							<tr>
								<td class="meta-head">Tipo Evaluacion</td>
								<?php
								//Cerrada
								if(isset($rowdata['idTipoQuiz'])&&$rowdata['idTipoQuiz']==1){
									echo '<td colspan="3">'.$rowdata['TipoQuiz'].'</td>';
								//Abierta 	
								}else{
									echo '<td colspan="3">'.$rowdata['TipoQuiz'].'</td>';
								}
								?>
							</tr>
							<tr>
								<td class="meta-head">Limite de Tiempo</td>
								<?php
								//Si
								if(isset($rowdata['idLimiteTiempo'])&&$rowdata['idLimiteTiempo']==1){
									echo '<td colspan="3">Limitado a '.$rowdata['Tiempo'].' hrs.</td>';
								//No	
								}else{
									echo '<td colspan="3">Sin Limite de Tiempo</td>';
								}
								?>
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
				<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Preguntas</h5>
			</header>
			<div class="tab-content">
				<div class="table-responsive">    
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							
							<?php 
							filtrar($arrPreguntas, 'Categoria');  
							foreach($arrPreguntas as $categoria=>$permisos){ 
								echo '<tr class="odd" ><td colspan="2"  style="background-color:#DDD"><strong>'.$categoria.'</strong></td></tr>';
								foreach ($permisos as $preg) { ?>
						
									<tr class="item-row linea_punteada">
										<td class="item-name">
											<strong><?php echo $preg['Tipo']; ?> : </strong><?php echo $preg['Pregunta']; ?><br/>	
											<?php
											$resp_correct = 1;
											if(isset($preg['Opcion_1'])&&$preg['Opcion_1']!=''){$tex = '';if($preg['OpcionCorrecta']==$resp_correct){$tex = ' <strong>-> correcta</strong>';};echo ' - '.$preg['Opcion_1'].$tex.'<br/>';$resp_correct++;}
											if(isset($preg['Opcion_2'])&&$preg['Opcion_2']!=''){$tex = '';if($preg['OpcionCorrecta']==$resp_correct){$tex = ' <strong>-> correcta</strong>';};echo ' - '.$preg['Opcion_2'].$tex.'<br/>';$resp_correct++;}
											if(isset($preg['Opcion_3'])&&$preg['Opcion_3']!=''){$tex = '';if($preg['OpcionCorrecta']==$resp_correct){$tex = ' <strong>-> correcta</strong>';};echo ' - '.$preg['Opcion_3'].$tex.'<br/>';$resp_correct++;}
											if(isset($preg['Opcion_4'])&&$preg['Opcion_4']!=''){$tex = '';if($preg['OpcionCorrecta']==$resp_correct){$tex = ' <strong>-> correcta</strong>';};echo ' - '.$preg['Opcion_4'].$tex.'<br/>';$resp_correct++;}
											if(isset($preg['Opcion_5'])&&$preg['Opcion_5']!=''){$tex = '';if($preg['OpcionCorrecta']==$resp_correct){$tex = ' <strong>-> correcta</strong>';};echo ' - '.$preg['Opcion_5'].$tex.'<br/>';$resp_correct++;}
											if(isset($preg['Opcion_6'])&&$preg['Opcion_6']!=''){$tex = '';if($preg['OpcionCorrecta']==$resp_correct){$tex = ' <strong>-> correcta</strong>';};echo ' - '.$preg['Opcion_6'].$tex.'<br/>';$resp_correct++;}
											?>	
							
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
	
	



 
          

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

	
	</body>
</html>
