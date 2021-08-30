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
$original = "alumnos_evaluaciones_asignar.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idAsignar']) && $_GET['idAsignar'] != ''){                $location .= "&idAsignar=".$_GET['idAsignar'];                 $search .= "&idAsignar=".$_GET['idAsignar']; }
if(isset($_GET['idCurso']) && $_GET['idCurso'] != ''){                    $location .= "&idCurso=".$_GET['idCurso'];                     $search .= "&idCurso=".$_GET['idCurso'];}
if(isset($_GET['idQuiz']) && $_GET['idQuiz'] != ''){                      $location .= "&idQuiz=".$_GET['idQuiz'];                       $search .= "&idQuiz=".$_GET['idQuiz'];}
if(isset($_GET['Programada_fecha']) && $_GET['Programada_fecha'] != ''){  $location .= "&Programada_fecha=".$_GET['Programada_fecha'];   $search .= "&Programada_fecha=".$_GET['Programada_fecha'];}
if(isset($_GET['N_preguntas']) && $_GET['N_preguntas'] != ''){            $location .= "&N_preguntas=".$_GET['N_preguntas'];             $search .= "&N_preguntas=".$_GET['N_preguntas'];}
if(isset($_GET['N_Alumnos']) && $_GET['N_Alumnos'] != ''){                $location .= "&N_Alumnos=".$_GET['N_Alumnos'];                 $search .= "&N_Alumnos=".$_GET['N_Alumnos'];}
if(isset($_GET['N_Alumnos_Falla']) && $_GET['N_Alumnos_Falla'] != ''){    $location .= "&N_Alumnos_Falla=".$_GET['N_Alumnos_Falla'];     $search .= "&N_Alumnos_Falla=".$_GET['N_Alumnos_Falla'];}
if(isset($_GET['N_Alumnos_Rep']) && $_GET['N_Alumnos_Rep'] != ''){        $location .= "&N_Alumnos_Rep=".$_GET['N_Alumnos_Rep'];         $search .= "&N_Alumnos_Rep=".$_GET['N_Alumnos_Rep'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'paso_1';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_evaluaciones_asignar.php';
}
//formulario para crear
if ( !empty($_POST['submit_pas_2a']) )  { 
	//Nueva Ubicacion
	$location = $original;
	$location .='?pagina='.$_GET['pagina'];
	//Llamamos al formulario
	$form_trabajo= 'paso_2a';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_evaluaciones_asignar.php';
}
//formulario para crear
if ( !empty($_POST['submit_pas_2b']) )  { 
	//Nueva Ubicacion
	$location = $original;
	$location .='?pagina='.$_GET['pagina'];
	//Llamamos al formulario
	$form_trabajo= 'paso_2b';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_evaluaciones_asignar.php';
}
//formulario para crear
if ( !empty($_POST['submit_reintento']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'reintento';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_evaluaciones_asignar.php';
}
//formulario para crear
if ( !empty($_POST['submit_modfecha']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'modfecha';
	require_once 'A1XRXS_sys/xrxs_form/z_alumnos_evaluaciones_asignar.php';
}
//se borra un dato
if ( !empty($_GET['del_asignacion']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_asignacion';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Asignacion Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Asignacion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Asignacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['editFecha']) ) { 
// consulto los datos
$query = "SELECT Programada_fecha
FROM `alumnos_evaluaciones_asignadas`
WHERE idAsignadas = ".$_GET['editFecha'];
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
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Reprogramar Fecha</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Programada_fecha)) {   $x1  = $Programada_fecha;  }else{$x1  = $rowdata['Programada_fecha'];}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Programada','Programada_fecha', $x1, 2);
				
				$Form_Inputs->form_input_hidden('idAsignadas', $_GET['editFecha'], 2);
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit_modfecha"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>	 
	 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['add']) ) { ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Programar Reintento</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Programada_fecha)) {   $x1  = $Programada_fecha;  }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Programada','Programada_fecha', $x1, 2);
				
				$Form_Inputs->form_input_hidden('idAsignadas', $_GET['add'], 2);
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit_reintento"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>	 
	 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['paso_2a']) ) { 
//Consulto por las categorias y el maximo de preguntas por cada una de estas
$arrCategoria = array();
$query = "SELECT 
quiz_categorias.Nombre AS Categoria,
COUNT(quiz_listado_preguntas.idPregunta) AS Cuenta
FROM `quiz_listado_preguntas`
LEFT JOIN `quiz_categorias` ON quiz_categorias.idCategoria = quiz_listado_preguntas.idCategoria
WHERE quiz_listado_preguntas.idQuiz=".$_GET['idQuiz']."
GROUP BY quiz_listado_preguntas.idCategoria
ORDER BY quiz_listado_preguntas.idCategoria ASC";
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
array_push( $arrCategoria,$row );
}


	 
?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Limitar Cantidades por categoria</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php
				$Form_Inputs = new Form_Inputs();
				//variables
				$xxn = 0;
				foreach ($arrCategoria as $cat) {
					$xxn++;
					$Form_Inputs->form_input_number_alt($cat['Categoria'].'(Maximo '.$cat['Cuenta'].')','categoria_'.$xxn, '', 2);
				}
				
				//Se envian ocultos los valores maximos
				$xxn = 0;
				foreach ($arrCategoria as $cat) {
					$xxn++;
					$Form_Inputs->form_input_hidden('n_categoria_'.$xxn, $cat['Cuenta'], 2);
				}
				
				$Form_Inputs->form_input_hidden('idAsignar', $_GET['idAsignar'], 2);
				$Form_Inputs->form_input_hidden('idCurso', $_GET['idCurso'], 2);
				$Form_Inputs->form_input_hidden('idQuiz', $_GET['idQuiz'], 2);
				$Form_Inputs->form_input_hidden('Programada_fecha', $_GET['Programada_fecha'], 2);
				$Form_Inputs->form_input_hidden('idSistema', $_GET['idSistema'], 2);
				//$Form_Inputs->form_input_hidden('Semana', $_GET['Semana'], 2);
				
				
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit_pas_2a"> 
					<a href="<?php echo $location.'&new=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['paso_2b']) ) {
//Consulto por las categorias y el maximo de preguntas por cada una de estas
$arrCategoria = array();
$query = "SELECT 
quiz_categorias.Nombre AS Categoria,
COUNT(quiz_listado_preguntas.idPregunta) AS Cuenta
FROM `quiz_listado_preguntas`
LEFT JOIN `quiz_categorias` ON quiz_categorias.idCategoria = quiz_listado_preguntas.idCategoria
WHERE quiz_listado_preguntas.idQuiz=".$_GET['idQuiz']."
GROUP BY quiz_listado_preguntas.idCategoria
ORDER BY quiz_listado_preguntas.idCategoria ASC";
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
array_push( $arrCategoria,$row );
}


	 
?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Limitar Cantidades por categoria</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php
				$Form_Inputs = new Form_Inputs();
				//variables
				$xxn = 0;
				foreach ($arrCategoria as $cat) {
					$xxn++;
					$Form_Inputs->form_input_number_alt($cat['Categoria'].'(Maximo '.$cat['Cuenta'].')','categoria_'.$xxn, '', 2);
				}
				
				//Se envian ocultos los valores maximos
				$xxn = 0;
				foreach ($arrCategoria as $cat) {
					$xxn++;
					$Form_Inputs->form_input_hidden('n_categoria_'.$xxn, $cat['Cuenta'], 2);
				}
				
				$Form_Inputs->form_input_hidden('idAsignar', $_GET['idAsignar'], 2);
				$Form_Inputs->form_input_hidden('idCurso', $_GET['idCurso'], 2);
				$Form_Inputs->form_input_hidden('idQuiz', $_GET['idQuiz'], 2);
				$Form_Inputs->form_input_hidden('Programada_fecha', $_GET['Programada_fecha'], 2);
				$Form_Inputs->form_input_hidden('idSistema', $_GET['idSistema'], 2);
				//$Form_Inputs->form_input_hidden('Semana', $_GET['Semana'], 2);
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit_pas_2b"> 
					<a href="<?php echo $location.'&new=true'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); 
//Verifico el tipo de usuario que esta ingresando
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Asignar Evaluacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idAsignar)) {          $x1  = $idAsignar;         }else{$x1  = '';}
				if(isset($idCurso)) {            $x2  = $idCurso;           }else{$x2  = '';}
				if(isset($idQuiz)) {             $x3  = $idQuiz;            }else{$x3  = '';}
				if(isset($Programada_fecha)) {   $x4  = $Programada_fecha;  }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Tipo Asignacion','idAsignar', $x1, 2, 'idAsignar', 'Nombre', 'alumnos_evaluaciones_asignar', 0, '', $dbConn);
				$Form_Inputs->form_select_filter('Cursos Alumnos','idCurso', $x2, 2, 'idCurso', 'Nombre', 'cursos_listado', $z, '', $dbConn);
				$Form_Inputs->form_select_filter('Cuestionario','idQuiz', $x3, 2, 'idQuiz', 'Nombre', 'quiz_listado', $z, '', $dbConn);
				$Form_Inputs->form_date('Fecha Programada','Programada_fecha', $x4, 2);
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				
				?>         
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Asignar" name="submit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'fecha_asc':        $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.Programada_fecha ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':       $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.Programada_fecha DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'tipo_asc':         $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.idAsignar ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Asignacion Ascendente'; break;
		case 'tipo_desc':        $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.idAsignar DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Asignacion Descendente';break;
		case 'curso_asc':        $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.idCurso ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Curso Ascendente'; break;
		case 'curso_desc':       $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.idCurso DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Curso Descendente';break;
		case 'evaluacion_asc':   $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.idQuiz ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Evaluacion Ascendente'; break;
		case 'evaluacion_desc':  $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.idQuiz DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Evaluacion Descendente';break;
		case 'npreg_asc':        $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_preguntas ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Preguntas Ascendente'; break;
		case 'npreg_desc':       $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_preguntas DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Preguntas Descendente';break;
		case 'nalum_asc':        $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_Alumnos ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Alumnos Ascendente'; break;
		case 'nalum_desc':       $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_Alumnos DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Alumnos Descendente';break;
		case 'reint_asc':        $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_Alumnos_Rep ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Reintentos Ascendente'; break;
		case 'reint_desc':       $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_Alumnos_Rep DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Reintentos Descendente';break;
		case 'semana_asc':       $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.Semana ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Semana Ascendente'; break;
		case 'semana_desc':      $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.Semana DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Semana Descendente';break;
		case 'nfallas_asc':      $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_Alumnos_Falla ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Fallas Ascendente'; break;
		case 'nfallas_desc':     $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.N_Alumnos_Falla DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Fallas Descendente';break;
		
		
		
		default: $order_by = 'ORDER BY alumnos_evaluaciones_asignadas.Programada_fecha DESC'; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY alumnos_evaluaciones_asignadas.Programada_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE alumnos_evaluaciones_asignadas.idAsignadas!=0";
//verifico que sea un administrador
$z.=" AND alumnos_evaluaciones_asignadas.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idAsignar']) && $_GET['idAsignar'] != ''){                 $z .= " AND alumnos_evaluaciones_asignadas.idAsignar=".$_GET['idAsignar'];}
if(isset($_GET['idCurso']) && $_GET['idCurso'] != ''){                     $z .= " AND alumnos_evaluaciones_asignadas.idCurso=".$_GET['idCurso'];}
if(isset($_GET['idQuiz']) && $_GET['idQuiz'] != ''){                       $z .= " AND alumnos_evaluaciones_asignadas.idQuiz=".$_GET['idQuiz'];}
if(isset($_GET['Programada_fecha']) && $_GET['Programada_fecha'] != ''){   $z .= " AND alumnos_evaluaciones_asignadas.Programada_fecha='".$_GET['Programada_fecha']."'";}
if(isset($_GET['N_preguntas']) && $_GET['N_preguntas'] != ''){             $z .= " AND alumnos_evaluaciones_asignadas.N_preguntas=".$_GET['N_preguntas'];}
if(isset($_GET['N_Alumnos']) && $_GET['N_Alumnos'] != ''){                 $z .= " AND alumnos_evaluaciones_asignadas.N_Alumnos=".$_GET['N_Alumnos'];}
if(isset($_GET['N_Alumnos_Falla']) && $_GET['N_Alumnos_Falla'] != ''){     $z .= " AND alumnos_evaluaciones_asignadas.N_Alumnos_Falla=".$_GET['N_Alumnos_Falla'];}
if(isset($_GET['N_Alumnos_Rep']) && $_GET['N_Alumnos_Rep'] != ''){         $z .= " AND alumnos_evaluaciones_asignadas.N_Alumnos_Rep=".$_GET['N_Alumnos_Rep'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT alumnos_evaluaciones_asignadas.idAsignadas FROM `alumnos_evaluaciones_asignadas` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los elementos
$arrUsers = array();
$query = "SELECT 
alumnos_evaluaciones_asignadas.idAsignadas,
alumnos_evaluaciones_asignadas.Programada_fecha,
alumnos_evaluaciones_asignadas.N_preguntas,
alumnos_evaluaciones_asignadas.N_Alumnos,
alumnos_evaluaciones_asignadas.N_Alumnos_Rep,
alumnos_evaluaciones_asignadas.N_Alumnos_Falla,
alumnos_evaluaciones_asignar.Nombre AS Asignar,
cursos_listado.Nombre AS Curso,
quiz_listado.Nombre AS Quiz,
core_sistemas.Nombre AS Sistema,
alumnos_evaluaciones_asignadas.idQuiz

FROM `alumnos_evaluaciones_asignadas`
LEFT JOIN `alumnos_evaluaciones_asignar`   ON alumnos_evaluaciones_asignar.idAsignar   = alumnos_evaluaciones_asignadas.idAsignar
LEFT JOIN `cursos_listado`                 ON cursos_listado.idCurso                   = alumnos_evaluaciones_asignadas.idCurso
LEFT JOIN `quiz_listado`                   ON quiz_listado.idQuiz                      = alumnos_evaluaciones_asignadas.idQuiz
LEFT JOIN `core_sistemas`                  ON core_sistemas.idSistema                  = alumnos_evaluaciones_asignadas.idSistema
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrUsers,$row );
}
//Verifico el tipo de usuario que esta ingresando
$yz = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Asignar Evaluacion</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idAsignar)) {          $x1  = $idAsignar;         }else{$x1  = '';}
				if(isset($idCurso)) {            $x2  = $idCurso;           }else{$x2  = '';}
				if(isset($idQuiz)) {             $x3  = $idQuiz;            }else{$x3  = '';}
				if(isset($Programada_fecha)) {   $x4  = $Programada_fecha;  }else{$x4  = '';}
				if(isset($N_preguntas)) {        $x5  = $N_preguntas;       }else{$x5  = '';}
				if(isset($N_Alumnos)) {          $x6  = $N_Alumnos;         }else{$x6  = '';}
				if(isset($N_Alumnos_Falla)) {    $x7  = $N_Alumnos_Falla;   }else{$x7  = '';}
				if(isset($N_Alumnos_Rep)) {      $x8  = $N_Alumnos_Rep;     }else{$x8  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Tipo Asignacion','idAsignar', $x1, 1, 'idAsignar', 'Nombre', 'alumnos_evaluaciones_asignar', 0, '', $dbConn);
				$Form_Inputs->form_select_filter('Cursos Alumnos','idCurso', $x2, 1, 'idCurso', 'Nombre', 'cursos_listado', $yz, '', $dbConn);
				$Form_Inputs->form_select_filter('Cuestionario','idQuiz', $x3, 1, 'idQuiz', 'Nombre', 'quiz_listado', $yz, '', $dbConn);
				$Form_Inputs->form_date('Fecha Programada','Programada_fecha', $x4, 1);
				$Form_Inputs->form_input_number('N° Preguntas','N_preguntas', $x5, 1);
				$Form_Inputs->form_input_number('N° Alumnos','N_Alumnos', $x6, 1);
				$Form_Inputs->form_input_number('N° Fallas','N_Alumnos_Falla', $x7, 1);
				$Form_Inputs->form_input_number('N° Reintentos','N_Alumnos_Rep', $x8, 1);
				
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>  
<div class="clearfix"></div>                  
                                 
<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Evaluaciones</h5>	
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="120">
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tipo Asignacion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Curso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=curso_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=curso_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Cuestionario</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=evaluacion_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=evaluacion_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">N° Preguntas</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=npreg_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=npreg_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">N° Alumnos</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nalum_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nalum_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">N° Fallas</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nfallas_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nfallas_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">N° Reintentos</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=reint_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=reint_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo fecha_estandar($usuarios['Programada_fecha']); ?></td>		
						<td><?php echo $usuarios['Asignar']; ?></td>		
						<td><?php echo $usuarios['Curso']; ?></td>		
						<td><?php echo $usuarios['Quiz']; ?></td>		
						<td style="text-align:center"><?php echo $usuarios['N_preguntas']; ?></td>		
						<td style="text-align:center"><?php echo $usuarios['N_Alumnos']; ?></td>		
						<td style="text-align:center"><?php echo $usuarios['N_Alumnos_Falla']; ?></td>		
						<td style="text-align:center"><?php echo $usuarios['N_Alumnos_Rep']; ?></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 140px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_evaluacion.php?view='.simpleEncode($usuarios['idAsignadas'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $location.'&add='.$usuarios['idAsignadas']; ?>" title="Agregar Reintento para Reprobados" class="btn btn-primary btn-sm tooltip"><i class="fa fa-user-plus" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&editFecha='.$usuarios['idAsignadas']; ?>" title="Editar Fecha Programada" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del_asignacion='.simpleEncode($usuarios['idAsignadas'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la evaluacion '.$usuarios['Quiz'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Asignacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								<?php } ?>								
							</div>
						</td>	
					</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>   
	</div>
</div>
	
<?php widget_modal(80, 95); ?>
	 
	 
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
