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
$original = "seg_vecinal_reportes_comment_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){    $location .= "&idCliente=".$_GET['idCliente'];    $search .= "&idCliente=".$_GET['idCliente'];}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){   $location .= "&idTipo=".$_GET['idTipo'];          $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){     $location .= "&Fecha=".$_GET['Fecha'];            $search .= "&Fecha=".$_GET['Fecha'];}
if(isset($_GET['Hora']) && $_GET['Hora']!=''){       $location .= "&Hora=".$_GET['Hora'];              $search .= "&Hora=".$_GET['Hora'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//se borra un dato
if (!empty($_GET['validate'])){
	//Llamamos al formulario
	$form_trabajo= 'validate';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_reportes_comment_listado.php';
}
//se borra un dato
if (!empty($_GET['disabled'])){
	//Llamamos al formulario
	$form_trabajo= 'disabled';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_reportes_comment_listado.php';
}	
//se borra un dato
if (!empty($_GET['banned'])){
	//Llamamos al formulario
	$form_trabajo= 'banned';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_reportes_comment_listado.php';
}
//formulario para crear
if (!empty($_POST['submit_infraction'])){
	//Nueva ubicacion
	$location .= '&idTipofil='.$_GET['idTipofil'];
	$location .= '&idComentario='.$_GET['idComentario'];
	$location .= '&idEventoPeligro='.$_GET['idEventoPeligro'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_clientes_infracciones.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Evento Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Evento borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['infract_post'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);
/******************************************************************************/
//Verifico el tipo de usuario que esta ingresando
$z = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND idEstado=1'; 
/******************************************************************************/
$ubicacion  = $location;
$ubicacion .= '&idTipofil='.$_GET['idTipofil'];
$ubicacion .= '&idComentario='.$_GET['idComentario'];
$ubicacion .= '&idEventoPeligro='.$_GET['idEventoPeligro'];


?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Infraccion</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Fecha)){       $x1 = $Fecha;       }else{$x1 = '';}
				if(isset($Descripcion)){ $x2 = $Descripcion; }else{$x2 = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha','Fecha', $x1, 2);
				$Form_Inputs->form_textarea('Descripcion','Descripcion', $x2, 1);

				$Form_Inputs->form_input_hidden('idCliente', $_GET['idCreador'], 2);
				?>
	 
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_infraction">
					<a href="<?php echo $ubicacion; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['idEventoPeligro'])){
//Se filtra la tabla a revisar
//peligro
if(isset($_GET['idTipofil'])&&$_GET['idTipofil']==1){
	//datos
	$x_table  = 'seg_vecinal_peligros_listado';
	$x_select = 'seg_vecinal_peligros_listado.idCliente AS idCreador,
				 seg_vecinal_peligros_listado.Descripcion,
				 seg_vecinal_peligros_tipos.Nombre AS Tipo,
				 seg_vecinal_peligros_listado.idEstado,
				 core_estados.Nombre AS Estado,
                 seg_vecinal_clientes_listado.Nombre AS Vecino';
	$x_where  = 'LEFT JOIN `seg_vecinal_peligros_tipos`    ON seg_vecinal_peligros_tipos.idTipo        = seg_vecinal_peligros_listado.idTipo
				 LEFT JOIN `core_estados`                  ON core_estados.idEstado                    = seg_vecinal_peligros_listado.idEstado
				 LEFT JOIN `seg_vecinal_clientes_listado`  ON seg_vecinal_clientes_listado.idCliente   = seg_vecinal_peligros_listado.idCliente
				 WHERE seg_vecinal_peligros_listado.idPeligro ='.$_GET['idEventoPeligro'];
	//Comentarios
	$y_table  = 'seg_vecinal_peligros_listado_comentarios';
	$y_where  = 'WHERE seg_vecinal_peligros_listado_comentarios.idPeligro ='.$_GET['idEventoPeligro'];
//evento	
}elseif(isset($_GET['idTipofil'])&&$_GET['idTipofil']==2){
	//datos
	$x_table  = 'seg_vecinal_eventos_listado';
	$x_select = 'seg_vecinal_eventos_listado.idCliente AS idCreador,
				 seg_vecinal_eventos_tipos.Nombre AS Tipo,
				 seg_vecinal_eventos_listado.DescripcionTipo,
				 seg_vecinal_eventos_listado.DescripcionSituacion,
                 seg_vecinal_clientes_listado.Nombre AS Vecino';
	$x_where  = 'LEFT JOIN `seg_vecinal_eventos_tipos`     ON seg_vecinal_eventos_tipos.idTipo         = seg_vecinal_eventos_listado.idTipo
				 LEFT JOIN `seg_vecinal_clientes_listado`  ON seg_vecinal_clientes_listado.idCliente   = seg_vecinal_eventos_listado.idCliente
				 WHERE seg_vecinal_eventos_listado.idEvento ='.$_GET['idEventoPeligro'];
	//Comentarios
	$y_table  = 'seg_vecinal_eventos_listado_comentarios';
	$y_where  = 'WHERE seg_vecinal_eventos_listado_comentarios.idEvento ='.$_GET['idEventoPeligro'];
}
/**********************************/
//consulta
$query = "SELECT  
".$x_table.".Direccion,
".$x_table.".GeoLatitud,
".$x_table.".GeoLongitud,
".$x_table.".Fecha,
".$x_table.".Hora,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
".$x_select."
FROM `".$x_table."`
LEFT JOIN `core_ubicacion_ciudad`       ON core_ubicacion_ciudad.idCiudad     = ".$x_table.".idCiudad
LEFT JOIN `core_ubicacion_comunas`      ON core_ubicacion_comunas.idComuna    = ".$x_table.".idComuna
".$x_where;
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

// Se trae un listado con todos los comentarios
$arrComentarios = array();
$query = "SELECT 
".$y_table.".idComentario,
".$y_table.".idCliente,
".$y_table.".Fecha,
".$y_table.".Hora,
".$y_table.".Comentario,
seg_vecinal_clientes_listado.Nombre,
seg_vecinal_clientes_listado.Direccion_img

FROM `".$y_table."`
LEFT JOIN `seg_vecinal_clientes_listado` ON seg_vecinal_clientes_listado.idCliente = ".$y_table.".idCliente
".$y_where;
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrComentarios,$row );
}

// Se trae un listado con todos los elementos
$arrReportes = array();
$query = "SELECT 
seg_vecinal_reportes_comment_listado.idCliente,
seg_vecinal_reportes_comment_listado.Fecha,
seg_vecinal_reportes_comment_listado.Hora,
seg_vecinal_reportes_comment_listado.Comentario,
seg_vecinal_clientes_listado.Nombre AS Vecino,
".$y_table.".Comentario AS ComentarioOriginal,
".$y_table.".idCliente AS ComentarioIdCliente

FROM `seg_vecinal_reportes_comment_listado`
LEFT JOIN `seg_vecinal_clientes_listado`    ON seg_vecinal_clientes_listado.idCliente  = seg_vecinal_reportes_comment_listado.idCliente
LEFT JOIN `".$y_table."`                    ON ".$y_table.".idComentario               = seg_vecinal_reportes_comment_listado.idComentario

WHERE seg_vecinal_reportes_comment_listado.idEventoPeligro = ".$_GET['idEventoPeligro']." 
AND seg_vecinal_reportes_comment_listado.idComentario = ".$_GET['idComentario']."
AND seg_vecinal_reportes_comment_listado.idTipo = ".$_GET['idTipofil']."
ORDER BY seg_vecinal_reportes_comment_listado.Fecha DESC, seg_vecinal_reportes_comment_listado.Hora DESC";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrReportes,$row );
}

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">

	<div class="btn-group pull-right margin_width">
		<button type="button" class="btn btn-primary">Acciones</button>
		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="caret"></span>
			<span class="sr-only">Toggle Dropdown</span>
		</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<?php
			$ubicacion  = $location.'&validate=true';
			$ubicacion .= '&idTipofil='.$_GET['idTipofil'];
			$ubicacion .= '&idComentario='.$_GET['idComentario'];
			$ubicacion .= '&idEventoPeligro='.$_GET['idEventoPeligro'];
			$ubicacion .= '&idCreador='.$arrReportes[0]['ComentarioIdCliente'];
			$dialogo    = '¿Va a validar Post?'; ?>
			<li><a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')"><i class="fa fa-check-square-o" aria-hidden="true"></i> Validar Comentario</a></li>

			<?php
			$ubicacion  = $location.'&disabled=true';
			$ubicacion .= '&idTipofil='.$_GET['idTipofil'];
			$ubicacion .= '&idComentario='.$_GET['idComentario'];
			$ubicacion .= '&idEventoPeligro='.$_GET['idEventoPeligro'];
			$ubicacion .= '&idCreador='.$arrReportes[0]['ComentarioIdCliente'];
			$dialogo    = '¿Va a banear al usuario creador del Post?'; ?>
			<li><a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')"><i class="fa fa-check-square-o" aria-hidden="true"></i> Desactivar Creador Comentario</a></li>

			<?php
			$ubicacion  = $location.'&banned=true';
			$ubicacion .= '&idTipofil='.$_GET['idTipofil'];
			$ubicacion .= '&idComentario='.$_GET['idComentario'];
			$ubicacion .= '&idEventoPeligro='.$_GET['idEventoPeligro'];
			$ubicacion .= '&idCreador='.$arrReportes[0]['ComentarioIdCliente'];
			$dialogo    = '¿Va a banear al usuario creador del Post?'; ?>
			<li><a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')"><i class="fa fa-check-square-o" aria-hidden="true"></i> Banear Creador Comentario</a></li>

			<?php
			$ubicacion  = $location.'&infract_post=true';
			$ubicacion .= '&idTipofil='.$_GET['idTipofil'];
			$ubicacion .= '&idComentario='.$_GET['idComentario'];
			$ubicacion .= '&idEventoPeligro='.$_GET['idEventoPeligro'];
			$ubicacion .= '&idCreador='.$arrReportes[0]['ComentarioIdCliente']; ?>
			<li><a href="<?php echo $ubicacion; ?>"><i class="fa fa-rss" aria-hidden="true"></i> Notificar Infraccion Creador Post</a></li>

			<?php 
			/*
			<li role="separator" class="divider"></li>

			<li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i> Notificar Infraccion Creador Reporte</a></li>
			*/ ?>

		</ul>
	</div>
	<a href="<?php echo $location; ?>"  class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>

	<div class="clearfix"></div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5><?php echo $rowdata['Tipo']; ?></h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-flag" aria-hidden="true"></i> Datos</a></li>
				<li class=""><a href="#reportes" data-toggle="tab"><i class="fa fa-flag" aria-hidden="true"></i> Reportes</a></li>
			</ul>
		</header>
        <div class="tab-content">

			<div class="tab-pane fade active in" id="basicos">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Principales</h2>
							<p class="text-muted" style="white-space: initial;">
								<strong>Vecino : </strong><?php echo $rowdata['Vecino']; ?><br/>
								<?php if(isset($_GET['idTipofil'])&&$_GET['idTipofil']==1){ ?>
									<strong>Tipo de Peligro : </strong><?php echo $rowdata['Tipo']; ?><br/>
									<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
									<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
									<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
									<strong>Descripcion : </strong><?php echo $rowdata['Descripcion']; ?><br/>
								<?php }elseif(isset($_GET['idTipofil'])&&$_GET['idTipofil']==2){ ?>
									<strong>Tipo de Evento : </strong><?php echo $rowdata['Tipo']; ?><br/>
									<strong>Caracteristicas Agresor : </strong><?php echo $rowdata['DescripcionTipo']; ?><br/>
									<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
									<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
									<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
									<strong>Fecha : </strong><?php echo fecha_estandar($rowdata['Fecha']); ?><br/>
									<strong>Hora : </strong><?php echo $rowdata['Hora']; ?><br/>
									<strong>Descripcion Situacion : </strong><?php echo $rowdata['DescripcionSituacion']; ?><br/>
								<?php } ?>
							</p>
						</div>
						<?php
						//Se arma la direccion
						$direccion = "";
						if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){   $direccion .= $rowdata["Direccion"];}
						if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){         $direccion .= ', '.$rowdata["Comuna"];}
						if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){         $direccion .= ', '.$rowdata["Ciudad"];}
						//se despliega mensaje en caso de no existir direccion
						if($direccion!=''){
							echo mapa_from_gps($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Evento', 'Calle', $direccion, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 19, 2);
						}else{
							$Alert_Text = 'No tiene una direccion definida';
							alert_post_data(4,2,2, $Alert_Text);
						} ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2 class="text-primary"><i class="fa fa-comment-o" aria-hidden="true"></i> Comentarios</h2>
						</div>
						<div class="clearfix"></div>
						<div class="seg_chat">
							<ul class="chat">
								<?php foreach ($arrComentarios as $comment) { ?>
									<li class="right clearfix">
										<span class="chat-img pull-right">
											<?php echo '<img alt="Imagen Referencia" class="img-circle" src="'.DB_SITE_REPO.'/LIB_assets/img/usr.png">'; ?>
										</span>
										<div class="chat-body clearfix">
											<div class="header">
												<small class="text-muted" style="margin-left: 0px !important;"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $comment['Fecha'].' '.$comment['Hora']; ?></small>
												<strong class="pull-right primary-font" style="color: #337ab7;"><?php echo $comment['Nombre']; ?></strong>
											</div>
											<p style="white-space: initial;"><?php echo $comment['Comentario']; ?></p>
										</div>
									</li>	
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="tab-pane fade" id="reportes">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th width="250">Datos</th>
							<th>Descripcion</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<tr class="odd">
							<td colspan="3" class="word_break">
								<blockquote><p><?php echo $arrReportes[0]['ComentarioOriginal']; ?></p></blockquote>
							</td>
						</tr>
						<?php foreach ($arrReportes as $report) { ?>
							<tr class="odd">
								<td>
									<?php echo $report['Vecino']; ?><br/>
									<?php echo 'Fecha: '.fecha_estandar($report['Fecha']); ?><br/>
									<?php echo 'Hora: '.$report['Hora']; ?>
								</td>
								<td class="word_break"><?php echo $report['Comentario']; ?></td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<?php
										$ubicacion  = $location.'&infract_post=true';
										$ubicacion .= '&idTipofil='.$_GET['idTipofil'];
										$ubicacion .= '&idEventoPeligro='.$_GET['idEventoPeligro'];
										$ubicacion .= '&idCreador='.$report['idCliente']; ?>
										<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $ubicacion; ?>" title="Notificar Infraccion Creador Reporte" class="btn btn-success btn-sm tooltip"><i class="fa fa-rss" aria-hidden="true"></i></a><?php } ?>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>	



<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
	<a href="<?php echo $location; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
/**********************************************************/
//paginador de resultados
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//Variable de busqueda
$SIS_where  = "seg_vecinal_reportes_comment_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
$SIS_where .= " AND seg_vecinal_reportes_comment_listado.idRevisado=1"; //solo los no revisados
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCliente']) && $_GET['idCliente']!=''){      $SIS_where .= " AND seg_vecinal_reportes_comment_listado.idCliente='".$_GET['idCliente']."'";}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){     $SIS_where .= " AND seg_vecinal_reportes_comment_listado.idTipo='".$_GET['idTipo']."'";}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){       $SIS_where .= " AND seg_vecinal_reportes_comment_listado.Fecha='".$_GET['Fecha']."'";}
if(isset($_GET['Hora']) && $_GET['Hora']!=''){         $SIS_where .= " AND seg_vecinal_reportes_comment_listado.Hora='".$_GET['Hora']."'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idReportes', 'seg_vecinal_reportes_comment_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
seg_vecinal_reportes_comment_listado.idEventoPeligro,
seg_vecinal_reportes_comment_listado.idComentario,
seg_vecinal_reportes_comment_listado.idTipo,
seg_vecinal_reportes_comment_listado.Fecha,
seg_vecinal_reportes_comment_listado.Hora,
seg_vecinal_reportes_comment_tipos.Nombre AS TipoReporte,
seg_vecinal_clientes_listado.Nombre AS Vecino,
seg_vecinal_eventos_listado.Direccion AS EventoDireccion,
seg_vecinal_eventos_tipos.Nombre AS EventoTipo,
seg_vecinal_peligros_listado.Direccion AS PeligroDireccion,
seg_vecinal_peligros_tipos.Nombre AS PeligroTipo';
$SIS_join  = '
LEFT JOIN `seg_vecinal_reportes_comment_tipos` ON seg_vecinal_reportes_comment_tipos.idTipo  = seg_vecinal_reportes_comment_listado.idTipo
LEFT JOIN `seg_vecinal_clientes_listado`       ON seg_vecinal_clientes_listado.idCliente     = seg_vecinal_reportes_comment_listado.idCliente
LEFT JOIN `seg_vecinal_eventos_listado`        ON seg_vecinal_eventos_listado.idEvento       = seg_vecinal_reportes_comment_listado.idEventoPeligro
LEFT JOIN `seg_vecinal_eventos_tipos`          ON seg_vecinal_eventos_tipos.idTipo           = seg_vecinal_eventos_listado.idTipo
LEFT JOIN `seg_vecinal_peligros_listado`       ON seg_vecinal_peligros_listado.idPeligro     = seg_vecinal_reportes_comment_listado.idEventoPeligro
LEFT JOIN `seg_vecinal_peligros_tipos`         ON seg_vecinal_peligros_tipos.idTipo          = seg_vecinal_peligros_listado.idTipo';
$SIS_order = 'seg_vecinal_reportes_comment_listado.Fecha DESC, seg_vecinal_reportes_comment_listado.Hora DESC LIMIT '.$comienzo.', '.$cant_reg;
$arrReportes = array();
$arrReportes = db_select_array (false, $SIS_query, 'seg_vecinal_reportes_comment_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrReportes');

/******************************************************************************/
//Verifico el tipo de usuario que esta ingresando
$z = 'idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND idEstado=1';

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default">Fecha Ascendente</li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($idCliente)){   $x1 = $idCliente;   }else{$x1  = '';}
				if(isset($idTipo)){      $x2 = $idTipo;      }else{$x2  = '';}
				if(isset($Fecha)){       $x3 = $Fecha;       }else{$x3  = '';}
				if(isset($Hora)){        $x4 = $Hora;        }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Vecino','idCliente', $x1, 1, 'idCliente', 'Nombre', 'seg_vecinal_clientes_listado', $z, '', $dbConn);
				$Form_Inputs->form_select('Tipo de Reporte','idTipo', $x2, 1, 'idTipo', 'Nombre', 'seg_vecinal_reportes_comment_tipos', 0, '',$dbConn);
				$Form_Inputs->form_date('Fecha','Fecha', $x3, 1);
				$Form_Inputs->form_time('Hora','Hora', $x4, 1, 1);

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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Reportes</h5>
			<div class="toolbar">
				<?php 
				//paginacion
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Vecino</th>
						<th>Tipo Reporte</th>
						<th>Tipo Evento-Peligro</th>
						<th>Ubicacion</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrReportes as $eve) { ?>
						<tr class="odd">
							<td><?php echo $eve['Vecino']; ?></td>
							<td><?php echo $eve['TipoReporte']; ?></td>
							<?php if(isset($eve['idTipo'])&&$eve['idTipo']==1){ ?>
								<td><?php echo $eve['PeligroTipo']; ?></td>
								<td><?php echo $eve['PeligroDireccion']; ?></td>
							<?php }else{ ?>
								<td><?php echo $eve['EventoTipo']; ?></td>
								<td><?php echo $eve['EventoDireccion']; ?></td>
							<?php } ?>
							<td><?php echo fecha_estandar($eve['Fecha']); ?></td>
							<td><?php echo $eve['Hora']; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&idEventoPeligro='.$eve['idEventoPeligro'].'&idComentario='.$eve['idComentario'].'&idTipofil='.$eve['idTipo']; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="pagrow">
			<?php 
			//paginacion
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
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
