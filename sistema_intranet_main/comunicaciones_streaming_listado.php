<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
$original = "comunicaciones_streaming_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){        $location .= "&Nombre=".$_GET['Nombre'];         $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){          $location .= "&Fecha=".$_GET['Fecha'];           $search .= "&Fecha=".$_GET['Fecha'];}
if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){    $location .= "&idEstado=".$_GET['idEstado'];     $search .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){        $location .= "&idTipo=".$_GET['idTipo'];         $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario']!=''){  $location .= "&idUsuario=".$_GET['idUsuario'];   $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/comunicaciones_streaming_listado.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/comunicaciones_streaming_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Streaming Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Streaming Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Streaming Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 2, $dbConn);
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	comunicaciones_streaming_listado.Nombre,
	comunicaciones_streaming_listado.Fecha,
	comunicaciones_streaming_listado.HoraInicio,
	comunicaciones_streaming_listado.HoraTermino,
	comunicaciones_streaming_listado.idEstado,

	core_sistemas.Nombre AS RazonSocial,
	core_estados.Nombre AS Estado,
	core_tipo_videoconferencia.Nombre AS Tipo,
	usuarios_listado.Nombre AS Usuario';
	$SIS_join  = '
	LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema            = comunicaciones_streaming_listado.idSistema
	LEFT JOIN `core_estados`                ON core_estados.idEstado              = comunicaciones_streaming_listado.idEstado
	LEFT JOIN `core_tipo_videoconferencia`  ON core_tipo_videoconferencia.idTipo  = comunicaciones_streaming_listado.idTipo
	LEFT JOIN `usuarios_listado`            ON usuarios_listado.idUsuario         = comunicaciones_streaming_listado.idUsuario';
	$SIS_where = 'comunicaciones_streaming_listado.idStreaming ='.$_GET['id'];
	$rowData = db_select_data (false, $SIS_query, 'comunicaciones_streaming_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowData');

	/*******************************************************/
	// consulto los datos
	$SIS_query = 'usuarios_listado.Nombre AS Usuario';
	$SIS_join  = 'LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario = comunicaciones_streaming_listado_usuarios.idUsuario';
	$SIS_where = 'comunicaciones_streaming_listado_usuarios.idStreaming ='.$_GET['id'];
	$SIS_order = 'usuarios_listado.Nombre ASC';
	$arrUsuarios = array();
	$arrUsuarios = db_select_array (false, $SIS_query, 'comunicaciones_streaming_listado_usuarios', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUsuarios');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Streaming', $rowData['Nombre'], 'Resumen'); ?>
	</div>
	<div class="clearfix"></div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<ul class="nav nav-tabs pull-right">
					<li class="active"><a href="<?php echo 'comunicaciones_streaming_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
					<li class=""><a href="<?php echo 'comunicaciones_streaming_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Básicos</a></li>
					<li class=""><a href="<?php echo 'comunicaciones_streaming_listado_usuarios.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Usuarios</a></li>         
				</ul>
			</header>
			<div class="tab-content">

				<div class="tab-pane fade active in" id="basicos">
					<div class="wmd-panel">

						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/usr.png">
						</div>
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Básicos</h2>
							<p class="text-muted">
								<strong>Tipo : </strong><?php echo $rowData['Tipo']; ?><br/>
								<strong>Nombre : </strong><?php echo $rowData['Nombre']; ?><br/>
								<strong>Fecha : </strong><?php echo fecha_estandar($rowData['Fecha']); ?><br/>
								<strong>Duracion : </strong><?php echo $rowData['HoraInicio'].' - '.$rowData['HoraTermino']; ?><br/>
								<strong>Estado : </strong><?php echo $rowData['Estado']; ?><br/>
								<strong>Sistema : </strong><?php echo $rowData['RazonSocial']; ?><br/>
								<strong>Usuario Creador : </strong><?php echo $rowData['Usuario']; ?><br/>
							</p>

							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Usuarios Participantes</h2>
							<p class="text-muted">
								<?php
								//Se existen cargas estas se despliegan
								if($arrUsuarios!=false){
									//variable
									$n_carga = 1;
									//recorro
									foreach ($arrUsuarios as $carga) {
										echo '<i class="fa fa-user" aria-hidden="true"></i> '.$carga['Usuario'].'<br/>';
									}
								//si no existen cargas se muestra mensaje
								}else{
									echo 'Sin Usuarios Participantes';
								}
								?>
							</p>

							<div class="row">

							</div>
							<div class="clearfix"></div>

						</div>
						<div class="clearfix"></div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
		<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['new'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Crear Streaming</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idTipo)){       $x1  = $idTipo;        }else{$x1  = '';}
					if(isset($Nombre)){       $x2  = $Nombre;        }else{$x2  = '';}
					if(isset($Fecha)){        $x3  = $Fecha;         }else{$x3  = '';}
					if(isset($HoraInicio)){   $x4  = $HoraInicio;    }else{$x4  = '';}
					if(isset($HoraTermino)){  $x5  = $HoraTermino;   }else{$x5  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Básicos');
					$Form_Inputs->form_select('Tipo','idTipo', $x1, 2, 'idTipo', 'Nombre', 'core_tipo_videoconferencia', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x2, 2);
					$Form_Inputs->form_date('Fecha','Fecha', $x3, 2);
					$Form_Inputs->form_time('Hora Inicio','HoraInicio', $x4, 2, 1);
					$Form_Inputs->form_time('Hora Termino','HoraTermino', $x5, 2, 1);

					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idEstado', 1, 2);
					$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
						<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
	/**********************************************************/
	//Variable de busqueda
	$SIS_where = "comunicaciones_streaming_listado.idEstado!=0";
	//Verifico el tipo de usuario que esta ingresando
	$SIS_where.=" AND comunicaciones_streaming_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
	/**********************************************************/
	//Se aplican los filtros
	if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){        $SIS_where .= " AND comunicaciones_streaming_listado.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
	if(isset($_GET['Fecha']) && $_GET['Fecha']!=''){          $SIS_where .= " AND comunicaciones_streaming_listado.Fecha='".$_GET['Fecha']."'";}
	if(isset($_GET['idEstado']) && $_GET['idEstado']!=''){    $SIS_where .= " AND comunicaciones_streaming_listado.idEstado='".$_GET['idEstado']."'";}
	if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){        $SIS_where .= " AND comunicaciones_streaming_listado.idTipo='".$_GET['idTipo']."'";}
	if(isset($_GET['idUsuario']) && $_GET['idUsuario']!=''){  $SIS_where .= " AND comunicaciones_streaming_listado.idUsuario='".$_GET['idUsuario']."'";}
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	comunicaciones_streaming_listado.idStreaming,
	comunicaciones_streaming_listado.Nombre,
	comunicaciones_streaming_listado.Fecha,
	comunicaciones_streaming_listado.HoraInicio,
	comunicaciones_streaming_listado.HoraTermino,
	comunicaciones_streaming_listado.idEstado,
	comunicaciones_streaming_listado.idTipo,
	comunicaciones_streaming_listado.idUsuario,
	comunicaciones_streaming_listado_usuarios.idUsuario AS idInvitado,

	core_sistemas.Nombre AS RazonSocial,
	core_estados.Nombre AS Estado,
	core_tipo_videoconferencia.Nombre AS Tipo,
	usuarios_listado.Nombre AS Usuario,
	users.Nombre AS UsuarioAsistente';
	$SIS_join  = '
	LEFT JOIN `core_sistemas`                               ON core_sistemas.idSistema                                = comunicaciones_streaming_listado.idSistema
	LEFT JOIN `core_estados`                                ON core_estados.idEstado                                  = comunicaciones_streaming_listado.idEstado
	LEFT JOIN `core_tipo_videoconferencia`                  ON core_tipo_videoconferencia.idTipo                      = comunicaciones_streaming_listado.idTipo
	LEFT JOIN `usuarios_listado`                            ON usuarios_listado.idUsuario                             = comunicaciones_streaming_listado.idUsuario
	LEFT JOIN `comunicaciones_streaming_listado_usuarios`   ON comunicaciones_streaming_listado_usuarios.idStreaming  = comunicaciones_streaming_listado.idStreaming
	LEFT JOIN `usuarios_listado`   users                    ON users.idUsuario                                        = comunicaciones_streaming_listado_usuarios.idUsuario';
	$SIS_order = 'comunicaciones_streaming_listado.idEstado ASC, comunicaciones_streaming_listado.Fecha ASC';
	$arrStreaming = array();
	$arrStreaming = db_select_array (false, $SIS_query, 'comunicaciones_streaming_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrStreaming');

	/**********************************************************/
	//Verifico el tipo de usuario que esta ingresando
	$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';
	//Verifico el tipo de usuario que esta ingresando
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
		$usrfil .= " AND usuarios_sistemas.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema'];
	}

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

		<ul class="btn-group btn-breadcrumb pull-left">
			<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Búsqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
			<li class="btn btn-default">Listado</li>
		</ul>

		<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Streaming</a><?php } ?>

	</div>
	<div class="clearfix"></div>

	<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
		<div class="well">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
					<?php
					//Se verifican si existen los datos
					if(isset($Nombre)){      $x1  = $Nombre;      }else{$x1  = '';}
					if(isset($Fecha)){       $x2  = $Fecha;       }else{$x2  = '';}
					if(isset($idEstado)){    $x3  = $idEstado;    }else{$x3  = '';}
					if(isset($idTipo)){      $x4  = $idTipo;      }else{$x4  = '';}
					if(isset($idUsuario)){   $x5  = $idUsuario;   }else{$x5  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 1);
					$Form_Inputs->form_date('Fecha','Fecha', $x2, 1);
					$Form_Inputs->form_select('Estado','idEstado', $x3, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
					$Form_Inputs->form_select('Tipo','idTipo', $x4, 1, 'idTipo', 'Nombre', 'core_tipo_videoconferencia', 0, '', $dbConn);
					$Form_Inputs->form_select_join_filter('Usuario','idUsuario', $x5, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas',$usrfil, $dbConn);

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
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Streaming</h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Duracion</th>
							<th>Estado</th>
							<th>Usuario Creador</th>
							<th>Asistentes</th>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php
					filtrar($arrStreaming, 'idStreaming');
					foreach($arrStreaming as $Streaming=>$Conferencia){ ?>
						<tr class="odd">
							<td><?php echo $Conferencia[0]['Nombre']; ?></td>
							<td><?php echo $Conferencia[0]['Tipo']; ?></td>
							<td>
								<?php
								if(isset($Conferencia[0]['idTipo'])&&$Conferencia[0]['idTipo']==2){
									echo 'El '.fecha_estandar($Conferencia[0]['Fecha']).' de ';
								}
								echo $Conferencia[0]['HoraInicio'].' - '.$Conferencia[0]['HoraTermino']; ?>
							</td>
							<td><label class="label <?php if(isset($Conferencia[0]['idEstado'])&&$Conferencia[0]['idEstado']==1){echo 'label-success';}else{echo 'label-danger';} ?>"><?php echo $Conferencia[0]['Estado']; ?></label></td>
							<td><?php echo $Conferencia[0]['Usuario']; ?></td>
							<td>
								<?php
								$Asiste = 0;
								foreach ($Conferencia as $conf) {
									//si el asistente es el usuario logueado
									if($_SESSION['usuario']['basic_data']['idUsuario']==$conf['idInvitado']){
										$Asiste++;
									}
									echo '<i class="fa fa-user" aria-hidden="true"></i> '.$conf['UsuarioAsistente'].'<br/>';
								} ?>
							</td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $Conferencia[0]['RazonSocial']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php
									//si esta activa la conferencia
									if(isset($Conferencia[0]['idEstado'])&&$Conferencia[0]['idEstado']==1){
										//si es un usuario participante o el creador
										if(($Asiste!=0) OR ($Conferencia[0]['idUsuario']==$_SESSION['usuario']['basic_data']['idUsuario']) OR ($_SESSION['usuario']['basic_data']['idTipoUsuario']==1)){
											//si es recurrente sienpre se muestra
											if(isset($Conferencia[0]['idTipo'])&&$Conferencia[0]['idTipo']==1){
												if ($rowlevel['level']>=1){ ?><a href="<?php echo 'comunicaciones_streaming_room.php?view='.$Streaming; ?>" title="Entrar en el Streaming" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php }
											//si es por dia fijo
											}elseif(isset($Conferencia[0]['idTipo'])&&$Conferencia[0]['idTipo']==2){
												//se verifica la fecha
												if(isset($Conferencia[0]['Fecha'])&&$Conferencia[0]['Fecha']==fecha_actual()){
													if ($rowlevel['level']>=1){ ?><a href="<?php echo 'comunicaciones_streaming_room.php?view='.$Streaming; ?>" title="Entrar en el Streaming" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php }
												}
											}
										}
									} ?>

									<?php if(($Conferencia[0]['idUsuario']==$_SESSION['usuario']['basic_data']['idUsuario']) OR ($_SESSION['usuario']['basic_data']['idTipoUsuario']==1)){ ?>
										<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$Streaming; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
										<?php if ($rowlevel['level']>=4){
											$ubicacion = $location.'&del='.simpleEncode($Streaming, fecha_actual());
											$dialogo   = '¿Realmente deseas eliminar el Streaming '.$Conferencia[0]['Nombre'].'?'; ?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										<?php } ?>
									<?php } ?>
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
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
