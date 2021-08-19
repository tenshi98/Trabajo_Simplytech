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
$original = "telemetria_listado.php";
$location = $original;
$new_location = "telemetria_listado_sensor_operaciones.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Agregamos nuevas direcciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_definicion_operacional.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Agregamos nuevas direcciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_definicion_operacional.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Agregamos nuevas direcciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_definicion_operacional.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Observacion creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Observacion editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Observacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}
//Consultas
$rowdata = db_select_data (false, 'cantSensores'.$subquery, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Se traen todos los grupos
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre, nColumnas', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGrupos');
				
$arrFinalGrupos = array();
foreach ($arrGrupos as $sen) { $arrFinalGrupos[$sen['idGrupo']]['Nombre'] = $sen['Nombre']; $arrFinalGrupos[$sen['idGrupo']]['nColumnas'] = $sen['nColumnas']; $arrFinalGrupos[$sen['idGrupo']]['idGrupo'] = $sen['idGrupo']; }


//los datos guardados
$rowdata_i = db_select_data (false, 'N_Sensor, ValorActivo, RangoMinimo, RangoMaximo, idFuncion', 'telemetria_listado_definicion_operacional', '', 'idDefinicion ='.$_GET['edit'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata_i');

?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Editar Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php 
				//Se verifican si existen los datos
				if(isset($idFuncion)) {       $x1  = $idFuncion;      }else{$x1  = $rowdata_i['idFuncion'];}
				if(isset($ValorActivo)) {     $x2  = $ValorActivo;    }else{$x2  = Cantidades_decimales_justos($rowdata_i['ValorActivo']);}
				if(isset($RangoMinimo)) {     $x3  = $RangoMinimo;    }else{$x3  = Cantidades_decimales_justos($rowdata_i['RangoMinimo']);}
				if(isset($RangoMaximo)) {     $x4  = $RangoMaximo;    }else{$x4  = Cantidades_decimales_justos($rowdata_i['RangoMaximo']);}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				
				
				$input = '<div class="form-group" id="div_sensorn" >
								<label for="text2" class="control-label col-sm-4">Sensor Activo</label>
								<div class="col-sm-8 field">
									<select name="N_Sensor" id="N_Sensor" class="form-control" required="">';
										$input .= '<option value="" selected>Seleccione una Opcion</option>';
										
										for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
											//solo sensores activos
											if(isset($rowdata['SensoresActivo_'.$i])&&$rowdata['SensoresActivo_'.$i]==1){
												if(isset($rowdata_i['N_Sensor'])&&$rowdata_i['N_Sensor']==$i){$selected='selected';}else{$selected='';}
												if(isset($arrFinalGrupos[$rowdata['SensoresGrupo_'.$i]]['Nombre'])){$grupo = $arrFinalGrupos[$rowdata['SensoresGrupo_'.$i]]['Nombre'].' - ';}else{$grupo = '';}
												$input .= '<option value="'.$i.'" '.$selected.'>'.$grupo.$rowdata['SensoresNombre_'.$i].'</option>';
											}
										}
					
									$input .= '
									</select>
								</div>
							</div>';
					
				echo $input;		
				
				$Form_Inputs->form_select('Funcion','idFuncion', $x1, 2, 'idFuncion', 'Nombre', 'core_telemetria_funciones', 0, '', $dbConn);		
				$Form_Inputs->form_input_number('Valor Supervisado','ValorActivo', $x2, 1);
				$Form_Inputs->form_input_number('Rango Valor Minimo','RangoMinimo', $x3, 1);
				$Form_Inputs->form_input_number('Rango Valor Maximo','RangoMaximo', $x4, 1);
				
				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				$Form_Inputs->form_input_hidden('idDefinicion', $_GET['edit'], 2);
				?>
				
				<script>
					//oculto los div
					document.getElementById('div_ValorActivo').style.display = 'none';
					document.getElementById('div_RangoMinimo').style.display = 'none';
					document.getElementById('div_RangoMaximo').style.display = 'none';
						
					$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
									
						let idFuncion= $("#idFuncion").val();
							
						//Voltaje
						if(idFuncion == 15){ 
							document.getElementById('div_ValorActivo').style.display = 'none';
							document.getElementById('div_RangoMinimo').style.display = 'block';
							document.getElementById('div_RangoMaximo').style.display = 'block';
								
						//el resto
						}else{ 
							document.getElementById('div_ValorActivo').style.display = 'block';
							document.getElementById('div_RangoMinimo').style.display = 'none';
							document.getElementById('div_RangoMaximo').style.display = 'none';
								
						}		
					}); 
						
					$("#idFuncion").on("change", function(){ //se ejecuta al cambiar valor del select
						let idFuncion_sel = $(this).val(); //Asignamos el valor seleccionado
						
						//Voltaje
						if(idFuncion_sel == 15){ 
							document.getElementById('div_ValorActivo').style.display = 'none';
							document.getElementById('div_RangoMinimo').style.display = 'block';
							document.getElementById('div_RangoMaximo').style.display = 'block';
							//Reseteo los valores a 0
							document.getElementById('ValorActivo').value = "0";				
								
						//el resto
						}else{ 
							document.getElementById('div_ValorActivo').style.display = 'block';
							document.getElementById('div_RangoMinimo').style.display = 'none';
							document.getElementById('div_RangoMaximo').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementById('RangoMinimo').value = "0";				
							document.getElementById('RangoMaximo').value = "0";				
								
						}
					});
					
				</script>
				
				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); 

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}
//Consultas
$rowdata = db_select_data (false, 'cantSensores'.$subquery, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Se traen todos los grupos
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre, nColumnas', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGrupos');
				
$arrFinalGrupos = array();
foreach ($arrGrupos as $sen) { $arrFinalGrupos[$sen['idGrupo']]['Nombre'] = $sen['Nombre']; $arrFinalGrupos[$sen['idGrupo']]['nColumnas'] = $sen['nColumnas']; $arrFinalGrupos[$sen['idGrupo']]['idGrupo'] = $sen['idGrupo']; }

				

?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Crear Definicion Operacional</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
   
				<?php 
				//Se verifican si existen los datos
				if(isset($idFuncion)) {       $x1 = $idFuncion;      }else{$x1 = '';}
				if(isset($ValorActivo)) {     $x2 = $ValorActivo;    }else{$x2 = '';}
				if(isset($RangoMinimo)) {     $x3 = $RangoMinimo;    }else{$x3 = '';}
				if(isset($RangoMaximo)) {     $x4 = $RangoMaximo;    }else{$x4 = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				
				
				$input = '<div class="form-group" id="div_sensorn" >
								<label for="text2" class="control-label col-sm-4">Sensor Activo</label>
								<div class="col-sm-8 field">
									<select name="N_Sensor" id="N_Sensor" class="form-control" required="">';
										$input .= '<option value="" selected>Seleccione una Opcion</option>';
										
										for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
											//solo sensores activos
											if(isset($rowdata['SensoresActivo_'.$i])&&$rowdata['SensoresActivo_'.$i]==1){
												if(isset($arrFinalGrupos[$rowdata['SensoresGrupo_'.$i]]['Nombre'])){$grupo = $arrFinalGrupos[$rowdata['SensoresGrupo_'.$i]]['Nombre'].' - ';}else{$grupo = '';}
												$input .= '<option value="'.$i.'">'.$grupo.$rowdata['SensoresNombre_'.$i].'</option>';
											}
										}
					
									$input .= '
									</select>
								</div>
							</div>';
					
				echo $input;		
				
				$Form_Inputs->form_select('Funcion','idFuncion', $x1, 2, 'idFuncion', 'Nombre', 'core_telemetria_funciones', 0, '', $dbConn);		
				$Form_Inputs->form_input_number('Valor Supervisado','ValorActivo', $x2, 1);
				$Form_Inputs->form_input_number('Rango Valor Minimo','RangoMinimo', $x3, 1);
				$Form_Inputs->form_input_number('Rango Valor Maximo','RangoMaximo', $x4, 1);
				
				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				?>
				
				<script>
					//oculto los div
					document.getElementById('div_ValorActivo').style.display = 'none';
					document.getElementById('div_RangoMinimo').style.display = 'none';
					document.getElementById('div_RangoMaximo').style.display = 'none';
						
					$("#idFuncion").on("change", function(){ //se ejecuta al cambiar valor del select
						let idFuncion_sel = $(this).val(); //Asignamos el valor seleccionado
						
						//Voltaje
						if(idFuncion_sel == 15){ 
							document.getElementById('div_ValorActivo').style.display = 'none';
							document.getElementById('div_RangoMinimo').style.display = 'block';
							document.getElementById('div_RangoMaximo').style.display = 'block';
							//Reseteo los valores a 0
							document.getElementById('ValorActivo').value = "0";				
								
						//el resto
						}else{ 
							document.getElementById('div_ValorActivo').style.display = 'block';
							document.getElementById('div_RangoMinimo').style.display = 'none';
							document.getElementById('div_RangoMaximo').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementById('RangoMinimo').value = "0";				
							document.getElementById('RangoMaximo').value = "0";				
								
						}
					});
					
				</script>

				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>


 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}else{
//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresNombre_'.$i;
}
//Consultas
$rowdata = db_select_data (false, 'Nombre,id_Geo, id_Sensores, idUsoContrato, idUsoGeocerca'.$subquery, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');


// Se trae un listado con todas las observaciones el cliente
$arrOperaciones = array();
$query = "SELECT 
telemetria_listado_definicion_operacional.idDefinicion,
telemetria_listado_definicion_operacional.N_Sensor,
telemetria_listado_definicion_operacional.ValorActivo,
telemetria_listado_definicion_operacional.RangoMinimo,
telemetria_listado_definicion_operacional.RangoMaximo,
telemetria_listado_definicion_operacional.idFuncion,
core_telemetria_funciones.Nombre AS Funcion

FROM `telemetria_listado_definicion_operacional`
LEFT JOIN `core_telemetria_funciones`   ON core_telemetria_funciones.idFuncion  = telemetria_listado_definicion_operacional.idFuncion
WHERE telemetria_listado_definicion_operacional.idTelemetria = ".$_GET['id']."
ORDER BY telemetria_listado_definicion_operacional.N_Sensor ASC ";
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
array_push( $arrOperaciones,$row );
}



?>
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Definicion Operacional');?>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Definicion Operacional</a><?php }?>
	</div>
</div>
<div class="clearfix"></div> 



<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_alerta_general.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarma General</a></li>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarmas Personalizadas</a></li>
						<?php } ?>
						<?php if($rowdata['id_Geo']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_gps.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> Datos GPS</a></li>
							<?php if($rowdata['idUsoGeocerca']==1){ ?>
								<li class=""><a href="<?php echo 'telemetria_listado_geocercas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> GeoCercas</a></li>
							<?php } ?>
						<?php } elseif($rowdata['id_Geo']==2){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-signs" aria-hidden="true"></i> Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
							<li class="active"><a href="<?php echo 'telemetria_listado_sensor_operaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Definicion Operacional</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Horario Envio Notificaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i> Otros Datos</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivos</a></li>
						
					</ul>
                </li>           
			</ul>
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Sensor</th>
						<th width="200">Valor Activo o Rango</th>
						<th>Funcion</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrOperaciones as $oper) { ?>
					<tr class="odd">		
						<td><?php echo $rowdata['SensoresNombre_'.$oper['N_Sensor']]; ?></td>
						<td>
							<?php 
							if(isset($oper['idFuncion'])&&$oper['idFuncion']!=15){
								echo Cantidades_decimales_justos($oper['ValorActivo']);
							}else{
								echo Cantidades_decimales_justos($oper['RangoMinimo']).' - '.Cantidades_decimales_justos($oper['RangoMaximo']);
							}?>
						</td>
						<td><?php echo $oper['Funcion']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&edit='.$oper['idDefinicion']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.simpleEncode($oper['idDefinicion'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la definicion de '.$rowdata['SensoresNombre_'.$oper['N_Sensor']].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
