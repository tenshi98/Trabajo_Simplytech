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
$original = "admin_telemetria_listado.php";
$location = $original;
$new_location = "admin_telemetria_listado_parametros.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//se agregan ubicaciones
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Equipo creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Equipo editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Equipo Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['modAct'])){
//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',telemetria_listado_sensores_nombre.SensoresNombre_'.$i;
}
$SIS_query = '
telemetria_listado.Nombre AS Equipo,
telemetria_listado.SensorActivacionID,
telemetria_listado.SensorActivacionValor,
telemetria_listado.cantSensores'.$subquery;
$SIS_join = 'LEFT JOIN `telemetria_listado_sensores_nombre` ON telemetria_listado_sensores_nombre.idTelemetria = telemetria_listado.idTelemetria';
$SIS_where = 'telemetria_listado.idTelemetria ='.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Sensor Activacion de <?php echo $rowdata['Equipo']; ?></h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//se dibujan los inputs
				$input = '
				<div class="form-group" id="div_SensorActivacionID">
					<label class="control-label col-xs-12 col-sm-4 col-md-4 col-lg-4" id="label_SensorActivacionID">Sensor de Activacion</label>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 field">
						<select name="SensorActivacionID" id="SensorActivacionID" class="form-control" required >
							<option value="" selected>Seleccione una Opcion</option>';
							for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
								$selected = '';
								if($i==$rowdata['SensorActivacionID']){
									$selected = 'selected="selected"';
								}
								$input .= '<option value="'.$i.'" '.$selected.' >Sensor : '.$rowdata['SensoresNombre_'.$i].'</option>';
							}
							$input .= '
						</select>
					</div>
				</div>';
				echo $input;

				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Valor Activacion', 'SensorActivacionValor', $rowdata['SensorActivacionValor'], 1);

				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['mod'])){
//Armo cadena
$cadena  = ',telemetria_listado_sensores_nombre.SensoresNombre_'.$_GET['mod'].' AS Nombre';
$cadena .= ',telemetria_listado_sensores_unimed.SensoresUniMed_'.$_GET['mod'].' AS UniMed';
$cadena .= ',telemetria_listado_sensores_uso.SensoresUso_'.$_GET['mod'].' AS Uso';
$cadena .= ',telemetria_listado_sensores_uso_fecha.SensoresFechaUso_'.$_GET['mod'].' AS FechaUso';
$cadena .= ',telemetria_listado_sensores_accion_c.SensoresAccionC_'.$_GET['mod'].' AS AccionC';
$cadena .= ',telemetria_listado_sensores_accion_t.SensoresAccionT_'.$_GET['mod'].' AS AccionT';
$cadena .= ',telemetria_listado_sensores_accion_alerta.SensoresAccionAlerta_'.$_GET['mod'].' AS AccionAlerta';

// consulto los datos
$SIS_query = 'telemetria_listado.Nombre AS Equipo'.$cadena;
$SIS_join  = '
LEFT JOIN `telemetria_listado_sensores_nombre`          ON telemetria_listado_sensores_nombre.idTelemetria         = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_unimed`          ON telemetria_listado_sensores_unimed.idTelemetria         = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_uso`             ON telemetria_listado_sensores_uso.idTelemetria            = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_uso_fecha`       ON telemetria_listado_sensores_uso_fecha.idTelemetria      = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_accion_c`        ON telemetria_listado_sensores_accion_c.idTelemetria       = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_accion_t`        ON telemetria_listado_sensores_accion_t.idTelemetria       = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_accion_alerta`   ON telemetria_listado_sensores_accion_alerta.idTelemetria  = telemetria_listado.idTelemetria';
$SIS_where = 'telemetria_listado.idTelemetria ='.$_GET['id'];
// consulto los datos
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Parametros de <?php echo $rowdata['Equipo']; ?></h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Editar Sensor:'.$rowdata['Nombre']);

				$Form_Inputs->form_tittle(3, 'Configuracion');
				$Form_Inputs->form_select('Unidad de Medida','SensoresUniMed_'.$_GET['mod'], $rowdata['UniMed'], 1, 'idUniMed', 'Nombre', 'telemetria_listado_unidad_medida', 0, '', $dbConn);

				$Form_Inputs->form_tittle(3, 'Uso');
				$Form_Inputs->form_select('Medicion Acciones','SensoresUso_'.$_GET['mod'], $rowdata['Uso'], 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
				$Form_Inputs->form_date('Fecha Cambio','SensoresFechaUso_'.$_GET['mod'], $rowdata['FechaUso'], 1);
				$Form_Inputs->form_input_number('Contador Accion (Cantidad)','SensoresAccionC_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['AccionC']), 1);
				$Form_Inputs->form_input_number('Tiempo Accion (Horas)','SensoresAccionT_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['AccionT']/3600), 1);
				$Form_Inputs->form_select_n_auto('Porcentaje cumplimiento','SensoresAccionAlerta_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['AccionAlerta']), 1, 1, 100);

				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				?>

				<script>
					//oculto los div
					document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'none';
					document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'none';
					document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'none';
					document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'none';

					$(document).ready(function(){//se ejecuta al cargar la página (OBLIGATORIO)

						let SensoresUso_<?php echo $_GET['mod']; ?>= $("#SensoresUso_<?php echo $_GET['mod']; ?>").val();

						//Si es si
						if(SensoresUso_<?php echo $_GET['mod']; ?> == 1){
							document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'block';

						//Si es no
						}else if(SensoresUso_<?php echo $_GET['mod']; ?> == 2){
							document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'none';

						//si no en ninguno
						}else{
							document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'none';

						}

					});

					$("#SensoresUso_<?php echo $_GET['mod']; ?>").on("change", function(){ //se ejecuta al cambiar valor del select
						let SensoresUso_<?php echo $_GET['mod']; ?>_sel = $(this).val(); //Asignamos el valor seleccionado

						//Si es si
						if(SensoresUso_<?php echo $_GET['mod']; ?>_sel == 1){
							document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'block';

						//Si es no
						}else if(SensoresUso_<?php echo $_GET['mod']; ?>_sel == 2){
							document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'none';
							document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementById('SensoresFechaUso_<?php echo $_GET['mod']; ?>').value = "0000-00-00";
							document.getElementById('SensoresAccionC_<?php echo $_GET['mod']; ?>').value = "0";
							document.getElementById('SensoresAccionT_<?php echo $_GET['mod']; ?>').value = "0";
							document.getElementById('SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').selectedIndex = 0;

						//si no en ninguno
						}else{
							document.getElementById('div_SensoresFechaUso_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionC_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionT_<?php echo $_GET['mod']; ?>').style.display = 'block';
							document.getElementById('div_SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').style.display = 'block';
							//Reseteo los valores a 0
							document.getElementById('SensoresFechaUso_<?php echo $_GET['mod']; ?>').value = "0000-00-00";
							document.getElementById('SensoresAccionC_<?php echo $_GET['mod']; ?>').value = "0";
							document.getElementById('SensoresAccionT_<?php echo $_GET['mod']; ?>').value = "0";
							document.getElementById('SensoresAccionAlerta_<?php echo $_GET['mod']; ?>').selectedIndex = 0;

						}
					});

				</script>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else  {
//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
//Recorro la configuracion de los sensores
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',telemetria_listado_sensores_nombre.SensoresNombre_'.$i;
	$subquery .= ',telemetria_listado_sensores_tipo.SensoresTipo_'.$i;
	$subquery .= ',telemetria_listado_sensores_grupo.SensoresGrupo_'.$i;
	$subquery .= ',telemetria_listado_sensores_unimed.SensoresUniMed_'.$i;
}
//Consultas
$SIS_query = '
telemetria_listado.Nombre,
telemetria_listado.id_Geo,
telemetria_listado.id_Sensores,
telemetria_listado.cantSensores,
telemetria_listado.SensorActivacionID,
telemetria_listado.SensorActivacionValor'.$subquery;
$SIS_join  = '
LEFT JOIN `telemetria_listado_sensores_nombre`          ON telemetria_listado_sensores_nombre.idTelemetria         = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_tipo`            ON telemetria_listado_sensores_tipo.idTelemetria           = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_grupo`           ON telemetria_listado_sensores_grupo.idTelemetria          = telemetria_listado.idTelemetria
LEFT JOIN `telemetria_listado_sensores_unimed`          ON telemetria_listado_sensores_unimed.idTelemetria         = telemetria_listado.idTelemetria';
$SIS_where = 'telemetria_listado.idTelemetria ='.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrGrupos');

$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUnimed');


//Recorro
$arrFinalGrupos    = array();
$arrFinalUnimed    = array();

foreach ($arrGrupos as $sen) {    $arrFinalGrupos[$sen['idGrupo']] = $sen['Nombre'];}
foreach ($arrUnimed as $sen) {    $arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];}

//no configurado
$arrFinalGrupos[0]    = 'No configurado';
$arrFinalUnimed[0]    = 'No configurado';

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Datos Sensores'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'admin_telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'admin_telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_telemetria_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'admin_telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'admin_telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarmas Personalizadas</a></li>
						<?php } ?>
						<?php if($rowdata['id_Geo']==2){ ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-signs" aria-hidden="true"></i> Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
						<li class="active"><a href="<?php echo 'admin_telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'admin_telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i> Otros Datos</a></li>

					</ul>
                </li>
			</ul>
		</header>

        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<tr class="odd">
					<td width="210"><strong>Sensor de Activacion</strong></td>
					<td>
						<?php if(isset($rowdata['SensoresNombre_'.$rowdata['SensorActivacionID']])&&$rowdata['SensoresNombre_'.$rowdata['SensorActivacionID']]!=''){
							echo $rowdata['SensoresNombre_'.$rowdata['SensorActivacionID']];
						} ?>
					</td>
					<td width="10">
						<div class="btn-group" style="width: 35px;" >
							<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&modAct=true'; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
						</div>
					</td>
				</tr>
				<tr class="odd">
					<td width="210"><strong>Valor Sensor Activo</strong></td>
					<td colspan="2">
						<?php if(isset($rowdata['SensorActivacionValor'])&&$rowdata['SensorActivacionValor']!=''){
							echo $rowdata['SensorActivacionValor'];
						} ?>
					</td>
				</tr>
				<tr class="odd"><td colspan="3"></td></tr>
			</table>

			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>#</th>
						<th>Nombre</th>
						<th>Grupo</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
						//Datos
						$Grupos    = $arrFinalGrupos[$rowdata['SensoresGrupo_'.$i]];
						$Unimed    = $arrFinalUnimed[$rowdata['SensoresUniMed_'.$i]];
						?>
						<tr class="odd">
							<td><?php echo 's'.$i ?></td>
							<td><?php echo $rowdata['SensoresNombre_'.$i]; ?></td>
							<td><?php echo $Grupos; ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&mod='.$i; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
