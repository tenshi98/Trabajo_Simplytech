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
$new_location = "telemetria_listado_parametros.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Equipo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Equipo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Equipo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['modAct']) ) { 
// tomo los datos del usuario
$query = "SELECT Nombre AS Equipo,SensorActivacionID, SensorActivacionValor,cantSensores,

SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50

FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['id']}";
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
			<h5>Editar Sensor Activacion de <?php echo $rowdata['Equipo']; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//se dibujan los inputs
				$input = '
				<div class="form-group" id="div_SensorActivacionID">
					<label for="text2" class="control-label col-sm-4" id="label_SensorActivacionID">Sensor de Activacion</label>
					<div class="col-sm-8 field">
						<select name="SensorActivacionID" id="SensorActivacionID" class="form-control" required >
							<option value="" selected>Seleccione una Opcion</option>';
							for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
								$w = '';
								if($i==$rowdata['SensorActivacionID']){
									$w .= 'selected="selected"';
								}
								$input .= '<option value="'.$i.'" '.$w.' >Sensor : '.$rowdata['SensoresNombre_'.$i].'</option>';
							}
							$input .= '
						</select>
					</div>
				</div>';
				echo $input;
				
				
				$Form_Imputs = new Form_Inputs();
				
				$Form_Imputs->form_input_text( 'Valor Activacion', 'SensorActivacionValor', $rowdata['SensorActivacionValor'], 1);
				
				$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				?>
	 
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div> 

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['mod']) ) { 
//Armo cadena
$cadena  = 'SensoresNombre_'.$_GET['mod'].' AS Nombre';
$cadena .= ',SensoresMedMin_'.$_GET['mod'].' AS MedMin';
$cadena .= ',SensoresMedMax_'.$_GET['mod'].' AS MedMax';
$cadena .= ',SensoresMedErrores_'.$_GET['mod'].' AS Errores_1';
$cadena .= ',SensoresMedErrores_2_'.$_GET['mod'].' AS Errores_2';
$cadena .= ',SensoresMedErrores_3_'.$_GET['mod'].' AS Errores_3';
$cadena .= ',SensoresTipo_'.$_GET['mod'].' AS Sensor';
$cadena .= ',SensoresMedAlerta_'.$_GET['mod'].' AS Alerta';
$cadena .= ',SensoresGrupo_'.$_GET['mod'].' AS Grupo';
$cadena .= ',SensoresUniMed_'.$_GET['mod'].' AS UniMed';
$cadena .= ',SensoresActivo_'.$_GET['mod'].' AS Activo';
$cadena .= ',SensoresUso_'.$_GET['mod'].' AS Uso';
$cadena .= ',SensoresFechaUso_'.$_GET['mod'].' AS FechaUso';
$cadena .= ',SensoresAccionC_'.$_GET['mod'].' AS AccionC';
$cadena .= ',SensoresAccionT_'.$_GET['mod'].' AS AccionT';
$cadena .= ',SensoresAccionAlerta_'.$_GET['mod'].' AS AccionAlerta';
$cadena .= ',SensoresRevision_'.$_GET['mod'].' AS Revision';
$cadena .= ',SensoresRevisionGrupo_'.$_GET['mod'].' AS RevisionGrupo';

// tomo los datos del usuario
$query = "SELECT Nombre AS Equipo, ".$cadena."
FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['id']}";
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
			<h5>Editar Parametros de <?php echo $rowdata['Equipo']; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Basicos</h3>';
				$Form_Imputs->form_input_text( 'Nombre', 'SensoresNombre_'.$_GET['mod'], $rowdata['Nombre'], 1);
				
				echo '<h3>Medicion</h3>';
				$Form_Imputs->form_input_number('Minimo Medicion','SensoresMedMin_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['MedMin']), 1);
				$Form_Imputs->form_input_number('Maximo Medicion','SensoresMedMax_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['MedMax']), 1);
				$Form_Imputs->form_input_number('1° Escalamiento Errores','SensoresMedErrores_'.$_GET['mod'], $rowdata['Errores_1'], 1);
				$Form_Imputs->form_input_number('2° Escalamiento Errores','SensoresMedErrores_2_'.$_GET['mod'], $rowdata['Errores_2'], 1);
				$Form_Imputs->form_input_number('3° Escalamiento Errores','SensoresMedErrores_3_'.$_GET['mod'], $rowdata['Errores_3'], 1);
				
				echo '<h3>Configuracion</h3>';
				$Form_Imputs->form_select('Tipo de Sensor','SensoresTipo_'.$_GET['mod'], $rowdata['Sensor'], 1, 'idSensores', 'Nombre', 'telemetria_listado_sensores', 0, '', $dbConn);	
				$Form_Imputs->form_select('Enviar Alerta Temprana','SensoresMedAlerta_'.$_GET['mod'], $rowdata['Alerta'], 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				$Form_Imputs->form_select('Grupo','SensoresGrupo_'.$_GET['mod'], $rowdata['Grupo'], 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos', 0, '', $dbConn);	
				$Form_Imputs->form_select('Unidad de Medida','SensoresUniMed_'.$_GET['mod'], $rowdata['UniMed'], 1, 'idUniMed', 'Nombre', 'telemetria_listado_unidad_medida', 0, '', $dbConn);	
				$Form_Imputs->form_select('Estado Sensor','SensoresActivo_'.$_GET['mod'], $rowdata['Activo'], 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);	
				
				echo '<h3>Uso Sensor(Ciclos, Tiempo, Cumplimiento)</h3>';
				$Form_Imputs->form_select('Utilizacion','SensoresUso_'.$_GET['mod'], $rowdata['Uso'], 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				$Form_Imputs->form_date('Fecha Cambio','SensoresFechaUso_'.$_GET['mod'], $rowdata['FechaUso'], 1);
				$Form_Imputs->form_input_number('Ciclos Limite(Cantidad)','SensoresAccionC_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['AccionC']), 1);
				$Form_Imputs->form_input_number('Tiempo Limite (Horas)','SensoresAccionT_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['AccionT']/3600), 1);
				$Form_Imputs->form_select_n_auto('% Cumplimiento (1 a 100)','SensoresAccionAlerta_'.$_GET['mod'], Cantidades_decimales_justos($rowdata['AccionAlerta']), 1, 1, 100);
		
				echo '<h3>Revision Trabajo</h3>';
				$Form_Imputs->form_select('Utilizar','SensoresRevision_'.$_GET['mod'], $rowdata['Revision'], 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
				$Form_Imputs->form_select('Grupo','SensoresRevisionGrupo_'.$_GET['mod'], $rowdata['RevisionGrupo'], 1, 'idGrupo', 'Nombre', 'telemetria_listado_grupos_uso', 'idSupervisado=1', '', $dbConn);	

				$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('SensoresFechaUso_Fake', $rowdata['FechaUso'], 2);
				?>
				
				<script>
						//oculto los div
						document.getElementById('div_SensoresFechaUso_'.$_GET['mod']).style.display = 'none';
						document.getElementById('div_SensoresAccionC_'.$_GET['mod']).style.display = 'none';
						document.getElementById('div_SensoresAccionT_'.$_GET['mod']).style.display = 'none';
						document.getElementById('div_SensoresAccionAlerta_'.$_GET['mod']).style.display = 'none';
						document.getElementById('div_SensoresRevisionGrupo_'.$_GET['mod']).style.display = 'none';
						
						var SensoresUso_<?php echo $_GET['mod']; ?>;
						var SensoresUso_<?php echo $_GET['mod']; ?>_sel;
						var SensoresRevision_<?php echo $_GET['mod']; ?>;
						var SensoresRevision_<?php echo $_GET['mod']; ?>_sel;
						
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
									
							SensoresUso_<?php echo $_GET['mod']; ?>= $("#SensoresUso_<?php echo $_GET['mod']; ?>").val();
							SensoresRevision_<?php echo $_GET['mod']; ?>= $("#SensoresRevision_<?php echo $_GET['mod']; ?>").val();
							
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
							
							//Si es si
							if(SensoresRevision_<?php echo $_GET['mod']; ?> == 1){ 
								document.getElementById('div_SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').style.display = 'block';
								
							//Si es no
							}else if(SensoresRevision_<?php echo $_GET['mod']; ?> == 2){ 
								document.getElementById('div_SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').style.display = 'none';
								
							//si no en ninguno
							}else{ 
								document.getElementById('div_SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').style.display = 'none';
								
							}		
						}); 
								
						$("#SensoresUso_<?php echo $_GET['mod']; ?>").on("change", function(){ //se ejecuta al cambiar valor del select
							SensoresUso_<?php echo $_GET['mod']; ?>_sel = $(this).val(); //Asignamos el valor seleccionado
							
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
						
						
						$("#SensoresRevision_<?php echo $_GET['mod']; ?>").on("change", function(){ //se ejecuta al cambiar valor del select
							SensoresRevision_<?php echo $_GET['mod']; ?>_sel = $(this).val(); //Asignamos el valor seleccionado
							
							//Si es si
							if(SensoresRevision_<?php echo $_GET['mod']; ?>_sel == 1){ 
								document.getElementById('div_SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').style.display = 'block';
								
							//Si es no
							}else if(SensoresRevision_<?php echo $_GET['mod']; ?>_sel == 2){ 
								document.getElementById('div_SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').selectedIndex = 0;			
								
							
							//si no en ninguno
							}else{ 
								document.getElementById('div_SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').style.display = 'block';
								//Reseteo los valores a 0
								document.getElementById('SensoresRevisionGrupo_<?php echo $_GET['mod']; ?>').selectedIndex = 0;			
								
							}
						});
					
					</script>
	 
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div> 
	 	 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  {	 
// tomo los datos del usuario
$query = "SELECT Nombre,id_Geo, id_Sensores,cantSensores,SensorActivacionID, SensorActivacionValor, 
idUsoContrato,

SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50,

SensoresTipo_1, SensoresTipo_2, SensoresTipo_3, SensoresTipo_4, SensoresTipo_5, 
SensoresTipo_6, SensoresTipo_7, SensoresTipo_8, SensoresTipo_9, SensoresTipo_10, 
SensoresTipo_11, SensoresTipo_12, SensoresTipo_13, SensoresTipo_14, SensoresTipo_15, 
SensoresTipo_16, SensoresTipo_17, SensoresTipo_18, SensoresTipo_19, SensoresTipo_20, 
SensoresTipo_21, SensoresTipo_22, SensoresTipo_23, SensoresTipo_24, SensoresTipo_25, 
SensoresTipo_26, SensoresTipo_27, SensoresTipo_28, SensoresTipo_29, SensoresTipo_30, 
SensoresTipo_31, SensoresTipo_32, SensoresTipo_33, SensoresTipo_34, SensoresTipo_35, 
SensoresTipo_36, SensoresTipo_37, SensoresTipo_38, SensoresTipo_39, SensoresTipo_40, 
SensoresTipo_41, SensoresTipo_42, SensoresTipo_43, SensoresTipo_44, SensoresTipo_45, 
SensoresTipo_46, SensoresTipo_47, SensoresTipo_48, SensoresTipo_49, SensoresTipo_50,
 
SensoresMedMin_1, SensoresMedMin_2, SensoresMedMin_3, SensoresMedMin_4, SensoresMedMin_5, 
SensoresMedMin_6, SensoresMedMin_7, SensoresMedMin_8, SensoresMedMin_9, SensoresMedMin_10, 
SensoresMedMin_11, SensoresMedMin_12, SensoresMedMin_13, SensoresMedMin_14, SensoresMedMin_15, 
SensoresMedMin_16, SensoresMedMin_17, SensoresMedMin_18, SensoresMedMin_19, SensoresMedMin_20, 
SensoresMedMin_21, SensoresMedMin_22, SensoresMedMin_23, SensoresMedMin_24, SensoresMedMin_25, 
SensoresMedMin_26, SensoresMedMin_27, SensoresMedMin_28, SensoresMedMin_29, SensoresMedMin_30, 
SensoresMedMin_31, SensoresMedMin_32, SensoresMedMin_33, SensoresMedMin_34, SensoresMedMin_35, 
SensoresMedMin_36, SensoresMedMin_37, SensoresMedMin_38, SensoresMedMin_39, SensoresMedMin_40, 
SensoresMedMin_41, SensoresMedMin_42, SensoresMedMin_43, SensoresMedMin_44, SensoresMedMin_45, 
SensoresMedMin_46, SensoresMedMin_47, SensoresMedMin_48, SensoresMedMin_49, SensoresMedMin_50,
 
SensoresMedMax_1, SensoresMedMax_2, SensoresMedMax_3, SensoresMedMax_4, SensoresMedMax_5, 
SensoresMedMax_6, SensoresMedMax_7, SensoresMedMax_8, SensoresMedMax_9, SensoresMedMax_10, 
SensoresMedMax_11, SensoresMedMax_12, SensoresMedMax_13, SensoresMedMax_14, SensoresMedMax_15, 
SensoresMedMax_16, SensoresMedMax_17, SensoresMedMax_18, SensoresMedMax_19, SensoresMedMax_20, 
SensoresMedMax_21, SensoresMedMax_22, SensoresMedMax_23, SensoresMedMax_24, SensoresMedMax_25, 
SensoresMedMax_26, SensoresMedMax_27, SensoresMedMax_28, SensoresMedMax_29, SensoresMedMax_30, 
SensoresMedMax_31, SensoresMedMax_32, SensoresMedMax_33, SensoresMedMax_34, SensoresMedMax_35, 
SensoresMedMax_36, SensoresMedMax_37, SensoresMedMax_38, SensoresMedMax_39, SensoresMedMax_40, 
SensoresMedMax_41, SensoresMedMax_42, SensoresMedMax_43, SensoresMedMax_44, SensoresMedMax_45, 
SensoresMedMax_46, SensoresMedMax_47, SensoresMedMax_48, SensoresMedMax_49, SensoresMedMax_50, 

SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50,

SensoresMedErrores_2_1, SensoresMedErrores_2_2, SensoresMedErrores_2_3, SensoresMedErrores_2_4, SensoresMedErrores_2_5, 
SensoresMedErrores_2_6, SensoresMedErrores_2_7, SensoresMedErrores_2_8, SensoresMedErrores_2_9, SensoresMedErrores_2_10, 
SensoresMedErrores_2_11, SensoresMedErrores_2_12, SensoresMedErrores_2_13, SensoresMedErrores_2_14, SensoresMedErrores_2_15, 
SensoresMedErrores_2_16, SensoresMedErrores_2_17, SensoresMedErrores_2_18, SensoresMedErrores_2_19, SensoresMedErrores_2_20, 
SensoresMedErrores_2_21, SensoresMedErrores_2_22, SensoresMedErrores_2_23, SensoresMedErrores_2_24, SensoresMedErrores_2_25, 
SensoresMedErrores_2_26, SensoresMedErrores_2_27, SensoresMedErrores_2_28, SensoresMedErrores_2_29, SensoresMedErrores_2_30, 
SensoresMedErrores_2_31, SensoresMedErrores_2_32, SensoresMedErrores_2_33, SensoresMedErrores_2_34, SensoresMedErrores_2_35, 
SensoresMedErrores_2_36, SensoresMedErrores_2_37, SensoresMedErrores_2_38, SensoresMedErrores_2_39, SensoresMedErrores_2_40, 
SensoresMedErrores_2_41, SensoresMedErrores_2_42, SensoresMedErrores_2_43, SensoresMedErrores_2_44, SensoresMedErrores_2_45, 
SensoresMedErrores_2_46, SensoresMedErrores_2_47, SensoresMedErrores_2_48, SensoresMedErrores_2_49, SensoresMedErrores_2_50, 

SensoresMedErrores_3_1, SensoresMedErrores_3_2, SensoresMedErrores_3_3, SensoresMedErrores_3_4, SensoresMedErrores_3_5, 
SensoresMedErrores_3_6, SensoresMedErrores_3_7, SensoresMedErrores_3_8, SensoresMedErrores_3_9, SensoresMedErrores_3_10, 
SensoresMedErrores_3_11, SensoresMedErrores_3_12, SensoresMedErrores_3_13, SensoresMedErrores_3_14, SensoresMedErrores_3_15, 
SensoresMedErrores_3_16, SensoresMedErrores_3_17, SensoresMedErrores_3_18, SensoresMedErrores_3_19, SensoresMedErrores_3_20, 
SensoresMedErrores_3_21, SensoresMedErrores_3_22, SensoresMedErrores_3_23, SensoresMedErrores_3_24, SensoresMedErrores_3_25, 
SensoresMedErrores_3_26, SensoresMedErrores_3_27, SensoresMedErrores_3_28, SensoresMedErrores_3_29, SensoresMedErrores_3_30, 
SensoresMedErrores_3_31, SensoresMedErrores_3_32, SensoresMedErrores_3_33, SensoresMedErrores_3_34, SensoresMedErrores_3_35, 
SensoresMedErrores_3_36, SensoresMedErrores_3_37, SensoresMedErrores_3_38, SensoresMedErrores_3_39, SensoresMedErrores_3_40, 
SensoresMedErrores_3_41, SensoresMedErrores_3_42, SensoresMedErrores_3_43, SensoresMedErrores_3_44, SensoresMedErrores_3_45, 
SensoresMedErrores_3_46, SensoresMedErrores_3_47, SensoresMedErrores_3_48, SensoresMedErrores_3_49, SensoresMedErrores_3_50,

SensoresMedAlerta_1, SensoresMedAlerta_2, SensoresMedAlerta_3, SensoresMedAlerta_4, SensoresMedAlerta_5, 
SensoresMedAlerta_6, SensoresMedAlerta_7, SensoresMedAlerta_8, SensoresMedAlerta_9, SensoresMedAlerta_10, 
SensoresMedAlerta_11, SensoresMedAlerta_12, SensoresMedAlerta_13, SensoresMedAlerta_14, SensoresMedAlerta_15, 
SensoresMedAlerta_16, SensoresMedAlerta_17, SensoresMedAlerta_18, SensoresMedAlerta_19, SensoresMedAlerta_20, 
SensoresMedAlerta_21, SensoresMedAlerta_22, SensoresMedAlerta_23, SensoresMedAlerta_24, SensoresMedAlerta_25, 
SensoresMedAlerta_26, SensoresMedAlerta_27, SensoresMedAlerta_28, SensoresMedAlerta_29, SensoresMedAlerta_30, 
SensoresMedAlerta_31, SensoresMedAlerta_32, SensoresMedAlerta_33, SensoresMedAlerta_34, SensoresMedAlerta_35, 
SensoresMedAlerta_36, SensoresMedAlerta_37, SensoresMedAlerta_38, SensoresMedAlerta_39, SensoresMedAlerta_40, 
SensoresMedAlerta_41, SensoresMedAlerta_42, SensoresMedAlerta_43, SensoresMedAlerta_44, SensoresMedAlerta_45, 
SensoresMedAlerta_46, SensoresMedAlerta_47, SensoresMedAlerta_48, SensoresMedAlerta_49, SensoresMedAlerta_50,

SensoresGrupo_1, SensoresGrupo_2, SensoresGrupo_3, SensoresGrupo_4, SensoresGrupo_5, 
SensoresGrupo_6, SensoresGrupo_7, SensoresGrupo_8, SensoresGrupo_9, SensoresGrupo_10, 
SensoresGrupo_11, SensoresGrupo_12, SensoresGrupo_13, SensoresGrupo_14, SensoresGrupo_15, 
SensoresGrupo_16, SensoresGrupo_17, SensoresGrupo_18, SensoresGrupo_19, SensoresGrupo_20, 
SensoresGrupo_21, SensoresGrupo_22, SensoresGrupo_23, SensoresGrupo_24, SensoresGrupo_25, 
SensoresGrupo_26, SensoresGrupo_27, SensoresGrupo_28, SensoresGrupo_29, SensoresGrupo_30, 
SensoresGrupo_31, SensoresGrupo_32, SensoresGrupo_33, SensoresGrupo_34, SensoresGrupo_35, 
SensoresGrupo_36, SensoresGrupo_37, SensoresGrupo_38, SensoresGrupo_39, SensoresGrupo_40, 
SensoresGrupo_41, SensoresGrupo_42, SensoresGrupo_43, SensoresGrupo_44, SensoresGrupo_45, 
SensoresGrupo_46, SensoresGrupo_47, SensoresGrupo_48, SensoresGrupo_49, SensoresGrupo_50,

SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50,

SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50,

SensoresRevisionGrupo_1, SensoresRevisionGrupo_2, SensoresRevisionGrupo_3, SensoresRevisionGrupo_4, SensoresRevisionGrupo_5, 
SensoresRevisionGrupo_6, SensoresRevisionGrupo_7, SensoresRevisionGrupo_8, SensoresRevisionGrupo_9, SensoresRevisionGrupo_10, 
SensoresRevisionGrupo_11, SensoresRevisionGrupo_12, SensoresRevisionGrupo_13, SensoresRevisionGrupo_14, SensoresRevisionGrupo_15, 
SensoresRevisionGrupo_16, SensoresRevisionGrupo_17, SensoresRevisionGrupo_18, SensoresRevisionGrupo_19, SensoresRevisionGrupo_20, 
SensoresRevisionGrupo_21, SensoresRevisionGrupo_22, SensoresRevisionGrupo_23, SensoresRevisionGrupo_24, SensoresRevisionGrupo_25, 
SensoresRevisionGrupo_26, SensoresRevisionGrupo_27, SensoresRevisionGrupo_28, SensoresRevisionGrupo_29, SensoresRevisionGrupo_30, 
SensoresRevisionGrupo_31, SensoresRevisionGrupo_32, SensoresRevisionGrupo_33, SensoresRevisionGrupo_34, SensoresRevisionGrupo_35, 
SensoresRevisionGrupo_36, SensoresRevisionGrupo_37, SensoresRevisionGrupo_38, SensoresRevisionGrupo_39, SensoresRevisionGrupo_40, 
SensoresRevisionGrupo_41, SensoresRevisionGrupo_42, SensoresRevisionGrupo_43, SensoresRevisionGrupo_44, SensoresRevisionGrupo_45, 
SensoresRevisionGrupo_46, SensoresRevisionGrupo_47, SensoresRevisionGrupo_48, SensoresRevisionGrupo_49, SensoresRevisionGrupo_50

FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['id']}";
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

//Se traen todos los tipos de sensores existentes
$arrSensores = array();
$query = "SELECT idSensores,Nombre
FROM `telemetria_listado_sensores`
ORDER BY idSensores ASC";
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
array_push( $arrSensores,$row );
}

//Se traen todos los grupos
$arrGrupos = array();
$query = "SELECT idGrupo,Nombre
FROM `telemetria_listado_grupos`
ORDER BY idGrupo ASC";
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
array_push( $arrGrupos,$row );
}

//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
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
array_push( $arrUnimed,$row );
}

//Se traen los estados
$arrEstado = array();
$query = "SELECT idEstado,Nombre
FROM `core_estados`
ORDER BY idEstado ASC";
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
array_push( $arrEstado,$row );
}

//Se traen todos los grupos
$arrGruposRev = array();
$query = "SELECT idGrupo,Nombre
FROM `telemetria_listado_grupos_uso`
ORDER BY idGrupo ASC";
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
array_push( $arrGruposRev,$row );
}
?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Equipo</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Datos Sensores</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
						<li class=""><a href="<?php echo 'telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_alerta_general.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Alarma General</a></li>
						<?php if($rowdata['id_Geo']==2){ ?>
						<li class=""><a href="<?php echo 'telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
						<li class="active"><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Sensores</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Alarmas Personalizadas</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Horario</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Otros Datos</a></li>
						
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
							<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&modAct=true'; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
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
						<th>Tipo Sensor</th>
						<th>Grupo</th>
						<th style="text-align: center;">Grupo<br/>Revision</th>
						<th>Estado</th>
						<th style="text-align: center;">Minimo<br/>Medicion</th>
						<th style="text-align: center;">Maximo<br/>Medicion</th>
						<th style="text-align: center;">Escalar Errores<br/>1° - 2° - 3°</th>
						<th style="text-align: center;">Enviar Alerta<br/>Temprana</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">	
					<?php //bucle con la cantidad de sensores
					for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
						//Unidad medida
						$unimed = '';
						foreach ($arrUnimed as $sen) { 
							if($rowdata['SensoresUniMed_'.$i]==$sen['idUniMed']){
								$unimed = ' '.$sen['Nombre'];
							}
						}
						?>
						<tr class="odd">		
							<td><?php echo 's'.$i ?></td>
							<td><?php echo $rowdata['SensoresNombre_'.$i]; ?></td>	
							<td>
								<?php 
								foreach ($arrSensores as $sen) { 
									if($rowdata['SensoresTipo_'.$i]==$sen['idSensores']){
										echo $sen['Nombre'];
									}
								}
								?>
							</td>
							<td>
								<?php 
								foreach ($arrGrupos as $sen) { 
									if($rowdata['SensoresGrupo_'.$i]==$sen['idGrupo']){
										echo $sen['Nombre'];
									}
								}
								?>
							</td>
							<td>
								<?php 
								foreach ($arrGruposRev as $sen) { 
									if($rowdata['SensoresRevisionGrupo_'.$i]==$sen['idGrupo']){
										echo $sen['Nombre'];
									}
								}
								?>
							</td>
							<td>
								<?php 
								foreach ($arrEstado as $sen) { 
								if($rowdata['SensoresActivo_'.$i]==$sen['idEstado']){
										if(isset($sen['idEstado'])&&$sen['idEstado']==2){
											echo '<span style="color:#FF3A00">'.$sen['Nombre'].'</span>';
										}else{
											echo '<span style="color:#55BD55">'.$sen['Nombre'].'</span>';
										}
									}
								}
								?>
							</td>
							<td style="text-align: center;"><?php echo Cantidades_decimales_justos($rowdata['SensoresMedMin_'.$i]).$unimed; ?></td>		
							<td style="text-align: center;"><?php echo Cantidades_decimales_justos($rowdata['SensoresMedMax_'.$i]).$unimed; ?></td>
							<td style="text-align: center;"><?php echo $rowdata['SensoresMedErrores_'.$i].' - '.$rowdata['SensoresMedErrores_2_'.$i].' - '.$rowdata['SensoresMedErrores_3_'.$i]; ?></td>
							<td style="text-align: center;">
								<?php 
								if($rowdata['SensoresMedAlerta_'.$i]==1){
									echo 'Si';
								}elseif($rowdata['SensoresMedAlerta_'.$i]==2){
									echo 'No';
								}
								?>
							</td>			
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&mod='.$i; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
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
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
