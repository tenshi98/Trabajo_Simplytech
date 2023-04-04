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
//Cargamos la ubicacion original
$original = "alumnos_videoconferencia_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCurso']) && $_GET['idCurso']!=''){      $location .= "&idCurso=".$_GET['idCurso'];       $search .= "&idCurso=".$_GET['idCurso'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario']!=''){  $location .= "&idUsuario=".$_GET['idUsuario'];   $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/VideoConferencia Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/VideoConferencia Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/VideoConferencia borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**********************************************************/
//obtengo el numero del dia de la semana
$idDia = fecha2NDiaSemana(fecha_actual());
//Variable de busqueda
$SIS_where = "cursos_listado_videoconferencia.idVideoConferencia!=0";
//Verifico el tipo de usuario que esta ingresando
$SIS_where.= " AND cursos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where.= " AND cursos_listado_videoconferencia.idDia_".$idDia." = 2";
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	//filtro por la columna correspondiente
	$SIS_where.= " AND cursos_listado_videoconferencia.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCurso']) && $_GET['idCurso']!=''){      $SIS_where .= " AND cursos_listado.idCurso='".$_GET['idCurso']."'";}
if(isset($_GET['idUsuario']) && $_GET['idUsuario']!=''){  $SIS_where .= " AND cursos_listado_videoconferencia.idUsuario='".$_GET['idUsuario']."'";}

/**********************************************************/
// Se trae un listado con todos los elementos
$SIS_query = '
cursos_listado_videoconferencia.idVideoConferencia,
cursos_listado.Nombre AS Curso,
usuarios_listado.Nombre AS Profesor,
cursos_listado_videoconferencia.Nombre,
cursos_listado_videoconferencia.HoraInicio,
cursos_listado_videoconferencia.HoraTermino,
core_sistemas.Nombre AS RazonSocial';
$SIS_join  = '
LEFT JOIN `cursos_listado_videoconferencia`  ON cursos_listado_videoconferencia.idCurso  = cursos_listado.idCurso
LEFT JOIN `core_sistemas`                    ON core_sistemas.idSistema                  = cursos_listado.idSistema
LEFT JOIN `usuarios_listado`                 ON usuarios_listado.idUsuario               = cursos_listado_videoconferencia.idUsuario';
$SIS_order = 'usuarios_listado.Nombre ASC, cursos_listado_videoconferencia.HoraInicio ASC';
$arrVideoConferencia = array();
$arrVideoConferencia = db_select_array (false, $SIS_query, 'cursos_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrVideoConferencia');

//filtro de los cursos
$y = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$usrfil .= " AND usuarios_sistemas.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
}

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default">Listado de Videoconferencias</li>
	</ul>

</div>
<div class="clearfix"></div>

<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idCurso)){     $x1  = $idCurso;     }else{$x1  = '';}
				if(isset($idUsuario)){   $x2  = $idUsuario;   }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Cursos Alumnos','idCurso', $x1, 1, 'idCurso', 'Nombre', 'cursos_listado', $y, '', $dbConn);
				$Form_Inputs->form_select_join_filter('Profesor','idUsuario', $x2, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas',$usrfil, $dbConn);

				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>

			</form>
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de VideoConferencias dia <?php echo numero_nombreDia($idDia); ?></h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Curso</th>
						<th>Profesor</th>
						<th>VideoConferencia</th>
						<th>Horario</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrVideoConferencia as $vid) { ?>
						<tr class="odd">
							<td><?php echo $vid['Curso']; ?></td>
							<td><?php echo $vid['Profesor']; ?></td>
							<td><?php echo $vid['Nombre']; ?></td>
							<td><?php echo $vid['HoraInicio'].' - '.$vid['HoraTermino']; ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $vid['RazonSocial']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'alumnos_videoconferencia_listado_room.php?view='.$vid['idVideoConferencia']; ?>" title="Entrar en la Videoconferencia" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
