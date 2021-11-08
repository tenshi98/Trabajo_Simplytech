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
$new_location = "telemetria_listado_alarmas_perso.php";
$new_location .='?pagina='.$_GET['pagina'];
$new_location .='&id='.$_GET['id'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//se agregan ubicaciones
	$location =$new_location;
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location =$new_location;
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso.php';
}
//se borra un dato
if ( !empty($_GET['delAlarma']) )     {
	//se agregan ubicaciones
	$location =$new_location;
	//Llamamos al formulario
	$form_trabajo= 'delAlarma';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso.php';	
}

//formulario para crear
if ( !empty($_POST['submit_item']) )  { 
	//se agregan ubicaciones
	$location =$new_location;
	$location.='&id='.$_GET['id'];
	$location.='&nombre_equipo='.$_GET['nombre_equipo'];
	$location.='&listItems='.$_GET['listItems'];
	$location.='&idTipo='.$_GET['idTipo'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso_items.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit_item']) )  { 
	//se agregan ubicaciones
	$location =$new_location;
	$location.='&id='.$_GET['id'];
	$location.='&nombre_equipo='.$_GET['nombre_equipo'];
	$location.='&listItems='.$_GET['listItems'];
	$location.='&idTipo='.$_GET['idTipo'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso_items.php';
}
//se borra un dato
if ( !empty($_GET['delAlarma_item']) )     {
	//se agregan ubicaciones
	$location =$new_location;
	$location.='&id='.$_GET['id'];
	$location.='&nombre_equipo='.$_GET['nombre_equipo'];
	$location.='&listItems='.$_GET['listItems'];
	$location.='&idTipo='.$_GET['idTipo'];
	//Llamamos al formulario
	$form_trabajo= 'delAlarma_item';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_listado_alarmas_perso_items.php';	
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
if ( ! empty($_GET['editItem']) ) { 
// consulto los datos
$rowdata = db_select_data (false, 'Sensor_N, Rango_ini, Rango_fin, valor_especifico', 'telemetria_listado_alarmas_perso_items', '', 'idItem ='.$_GET['editItem'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}
//Se traen todos los datos
$rowSensores = db_select_data (false, 'idTelemetria, cantSensores'.$subquery, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowSensores');
								
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrGrupos');

$arrFinalGrupos    = array();
foreach ($arrGrupos as $sen) {    $arrFinalGrupos[$sen['idGrupo']] = $sen['Nombre']; }								
			
				
?>
		
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Item</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				$Form_Inputs = new Form_Inputs();
				
					

				echo '<div class="form-group" id="div_sensorn" >
						<label for="text2" class="control-label col-sm-4">Sensor</label>
						<div class="col-sm-8 field">
							<select name="Sensor_N" id="Sensor_N" class="form-control" required="">
								<option value="" selected>Seleccione una Opcion</option>';

								for ($i = 1; $i <= $rowSensores['cantSensores']; $i++) {
									//solo sensores activos
									if(isset($rowSensores['SensoresActivo_'.$i])&&$rowSensores['SensoresActivo_'.$i]==1){
										//se verifica que el grupo exista
										if(isset($arrFinalGrupos[$rowSensores['SensoresGrupo_'.$i]])&&$arrFinalGrupos[$rowSensores['SensoresGrupo_'.$i]]!=''){
											//Se trae el grupo
											$Grupos = $arrFinalGrupos[$rowSensores['SensoresGrupo_'.$i]];
											//Se marca como seleccionado
											$selected = '';
											if($rowdata['Sensor_N']==$i){
												$selected = 'selected';
											}
											//se imprime
											echo '<option value="'.$i.'" '.$selected.'>'.$Grupos.' - '.$rowSensores['SensoresNombre_'.$i].'</option>';
										//si no existe grupo se imprime sin este
										}else{
											//Se marca como seleccionado
											$selected = '';
											if($rowdata['Sensor_N']==$i){
												$selected = 'selected';
											}
											//se imprime
											echo '<option value="'.$i.'" '.$selected.'>'.$rowSensores['SensoresNombre_'.$i].'</option>';
										}		
									}
								}
									
							echo '	
							</select>
						</div>
					</div>';
				
				if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&($_GET['idTipo']==3 OR $_GET['idTipo']==4)){
					//Se verifican si existen los datos
					if(isset($Rango_ini)) {  $x1  = $Rango_ini;  }else{$x1  = Cantidades_decimales_justos($rowdata['Rango_ini']);}
					if(isset($Rango_fin)) {  $x2  = $Rango_fin;  }else{$x2  = Cantidades_decimales_justos($rowdata['Rango_fin']);}
					
					//opcionales 
					$Form_Inputs->form_post_data(1, 'Rango de valores donde normalmente trabaja el sensor, en caso de que un valor sea distinto de este rango (inferior al minimo, superior al maximo) marcara una alerta personalizada');
					$Form_Inputs->form_input_number('Rango Inicio','Rango_ini', $x1, 2);
					$Form_Inputs->form_input_number('Rango Termino','Rango_fin', $x2, 2);
				}elseif(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&$_GET['idTipo']==6){
					if(isset($valor_especifico)) {  $x3  = $valor_especifico;  }else{$x3  = Cantidades_decimales_justos($rowdata['valor_especifico']);}
					
					//opcionales 
					$Form_Inputs->form_post_data(1, 'El valor especifico que es considerado como error (por ejemplo 0 o 1)');
					$Form_Inputs->form_input_number('Valor Especifico','valor_especifico', $x3, 2);
				
				}
				
				
				$Form_Inputs->form_input_hidden('idItem', $_GET['editItem'], 2);
									
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_item">
					<a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['addItem']) ) { 
	
//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}
//Se traen todos los datos
$rowSensores = db_select_data (false, 'idTelemetria, cantSensores'.$subquery, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowSensores');
								
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrGrupos');

$arrFinalGrupos    = array();
foreach ($arrGrupos as $sen) {    $arrFinalGrupos[$sen['idGrupo']] = $sen['Nombre']; }								
	
	
?>
	
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Item</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				$Form_Inputs = new Form_Inputs();
				
				
				echo '<div class="form-group" id="div_sensorn" >
						<label for="text2" class="control-label col-sm-4">Sensor</label>
						<div class="col-sm-8 field">
							<select name="Sensor_N" id="Sensor_N" class="form-control" required="">
								<option value="" selected>Seleccione una Opcion</option>';

								for ($i = 1; $i <= $rowSensores['cantSensores']; $i++) {
									//solo sensores activos
									if(isset($rowSensores['SensoresActivo_'.$i])&&$rowSensores['SensoresActivo_'.$i]==1){
										//se verifica que el grupo exista
										if(isset($arrFinalGrupos[$rowSensores['SensoresGrupo_'.$i]])&&$arrFinalGrupos[$rowSensores['SensoresGrupo_'.$i]]!=''){
											//Se trae el grupo
											$Grupos = $arrFinalGrupos[$rowSensores['SensoresGrupo_'.$i]];
											//se imprime
											echo '<option value="'.$i.'">'.$Grupos.' - '.$rowSensores['SensoresNombre_'.$i].'</option>';
										//si no existe grupo se imprime sin este
										}else{
											//se imprime
											echo '<option value="'.$i.'">'.$rowSensores['SensoresNombre_'.$i].'</option>';
										}		
									}
								}
									
							echo '	
							</select>
						</div>
					</div>';
				
				if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&($_GET['idTipo']==3 OR $_GET['idTipo']==4)){
					//Se verifican si existen los datos
					if(isset($Rango_ini)) {  $x1  = $Rango_ini;  }else{$x1  = '';}
					if(isset($Rango_fin)) {  $x2  = $Rango_fin;  }else{$x2  = '';}
					
					//opcionales 
					$Form_Inputs->form_post_data(1, 'Rango de valores donde normalmente trabaja el sensor, en caso de que un valor sea distinto de este rango (inferior al minimo, superior al maximo) marcara una alerta personalizada');
					$Form_Inputs->form_input_number('Rango Inicio','Rango_ini', $x1, 2);
					$Form_Inputs->form_input_number('Rango Termino','Rango_fin', $x2, 2);
				}elseif(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&$_GET['idTipo']==6){
					if(isset($valor_especifico)) {  $x3  = $valor_especifico;  }else{$x3  = '';}
					
					//opcionales 
					$Form_Inputs->form_post_data(1, 'El valor especifico que es considerado como error (por ejemplo 0 o 1)');
					$Form_Inputs->form_input_number('Valor Especifico','valor_especifico', $x3, 2);
				
				}
				
				
				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				$Form_Inputs->form_input_hidden('idAlarma', $_GET['listItems'], 2);
									
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_item">
					<a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>	
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['listItems']) ) {
// Se trae un listado con todas las alarmas
$arrAlarmas = array();
$arrAlarmas = db_select_array (false, 'idItem, Sensor_N, Rango_ini, Rango_fin, valor_especifico', 'telemetria_listado_alarmas_perso_items', '', 'idAlarma ='.$_GET['listItems'], 'idItem ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrAlarmas');

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresNombre_'.$i;
}
//Se traen todos los datos
$rowSensores = db_select_data (false, 'idTelemetria, cantSensores'.$subquery, 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowSensores');
								
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrGrupos');

$arrFinalGrupos    = array();
foreach ($arrGrupos as $sen) {    $arrFinalGrupos[$sen['idGrupo']] = $sen['Nombre']; }								
					
?>

<div class="col-sm-12">
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo']; ?>&addItem=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Item</a><?php } ?>
</div>
<div class="clearfix"></div> 



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Items de <?php echo $_GET['nombre_equipo']; ?></h5>	
		</header>
        <div class="table-responsive">   
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Sensor</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrAlarmas as $alarmas) { ?>
						<tr class="odd">		
							<td><?php 
							$grupo = $arrFinalGrupos[$rowSensores['SensoresGrupo_'.$alarmas['Sensor_N']]];
							echo $grupo.$rowSensores['SensoresNombre_'.$alarmas['Sensor_N']]; 
							if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&($_GET['idTipo']==3 OR $_GET['idTipo']==4)){
								echo ' (Rango: '.Cantidades_decimales_justos($alarmas['Rango_ini']).' / '.Cantidades_decimales_justos($alarmas['Rango_fin']).')';
							}elseif(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&$_GET['idTipo']==6){
								echo ' (Valor especifico: '.Cantidades_decimales_justos($alarmas['valor_especifico']).')';
							}
							?>
							</td>		
							<td>
								<div class="btn-group" style="width: 70px;" >
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo'].'&editItem='.$alarmas['idItem']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										//se verifica que el usuario no sea uno mismo
										$ubicacion = $new_location.'&delAlarma_item='.simpleEncode($alarmas['idItem'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar el item '.$grupo.$rowSensores['SensoresNombre_'.$alarmas['Sensor_N']].'?';?>
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
<a href="<?php echo $new_location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editAlarma']) ) { 
// consulto los datos
$SIS_query = 'Nombre, idTipoAlerta, idUniMed, idTipo, valor_error, valor_diferencia, Rango_ini, Rango_fin,
NErroresMax, NErroresActual';
$rowdata = db_select_data (false, $SIS_query, 'telemetria_listado_alarmas_perso', '', 'idAlarma ='.$_GET['editAlarma'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>
	
	
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Editar Alarma Personalizada</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {            $x1  = $Nombre;            }else{$x1  = $rowdata['Nombre'];}
				if(isset($idTipoAlerta)) {      $x2  = $idTipoAlerta;      }else{$x2  = $rowdata['idTipoAlerta'];}
				if(isset($idUniMed)) {          $x3  = $idUniMed;          }else{$x3  = $rowdata['idUniMed'];}
				if(isset($idTipo)) {            $x4  = $idTipo;            }else{$x4  = $rowdata['idTipo'];}
				if(isset($NErroresMax)) {       $x5  = $NErroresMax;       }else{$x5  = Cantidades_decimales_justos($rowdata['NErroresMax']);}
				if(isset($NErroresActual)) {    $x6  = $NErroresActual;    }else{$x6  = Cantidades_decimales_justos($rowdata['NErroresActual']);}
				if(isset($valor_error)) {       $x7  = $valor_error;       }else{$x7  = Cantidades_decimales_justos($rowdata['valor_error']);}
				if(isset($valor_diferencia)) {  $x8  = $valor_diferencia;  }else{$x8  = Cantidades_decimales_justos($rowdata['valor_diferencia']);}
				if(isset($Rango_ini)) {         $x9  = $Rango_ini;         }else{$x9  = Cantidades_decimales_justos($rowdata['Rango_ini']);}
				if(isset($Rango_fin)) {         $x10 = $Rango_fin;         }else{$x10 = Cantidades_decimales_justos($rowdata['Rango_fin']);}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				
				$Form_Inputs->form_post_data(1, 'Seleccione un Tipo Alarma');
				$Form_Inputs->form_select('Tipo Alarma','idTipo', $x4, 2, 'idTipo', 'Nombre', 'telemetria_listado_alarmas_perso_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_number('N° Maximo Errores','NErroresMax', $x5, 2);
				$Form_Inputs->form_input_number('N° Actual Errores','NErroresActual', $x6, 1);
				//opcionales ocultos
				$Form_Inputs->form_input_number('Valor de error','valor_error', $x7, 1);
				$Form_Inputs->form_input_number('Porcentaje de diferencia','valor_diferencia', $x8, 1);
				$Form_Inputs->form_input_number('Rango Inicio','Rango_ini', $x9, 1);
				$Form_Inputs->form_input_number('Rango Termino','Rango_fin', $x10, 1);
				
				$Form_Inputs->form_post_data(1, 'Tiene relacion a como se notificaran:<br/>- <strong>Normales</strong> = cada 15 minutos.<br/>- <strong>Catastrofica</strong> = cada vez que ocurra.');
				$Form_Inputs->form_select('Prioridad Alarma','idTipoAlerta', $x2, 2, 'idTipoAlerta', 'Nombre', 'core_telemetria_tipo_alertas', 0, '', $dbConn);
				
				$Form_Inputs->form_post_data(1, 'Se utiliza unicamente en <strong>Informes CrossCrane - Alertas por Grua</strong> para poder agrupar los errores de voltaje.');
				$Form_Inputs->form_select('Unidad de Medida','idUniMed', $x3, 1, 'idUniMed', 'Nombre', 'telemetria_listado_unidad_medida', 0, '', $dbConn);	
				
				
				
				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				$Form_Inputs->form_input_hidden('idAlarma', $_GET['editAlarma'], 2);
					
				?>
				
				<script>
					
					$(document).ready(function(){
						document.getElementById("div_valor_error").style.display = "none";
						document.getElementById("div_valor_diferencia").style.display = "none";
						document.getElementById("div_Rango_ini").style.display = "none";
						document.getElementById("div_Rango_fin").style.display = "none";
						cambia_tipo();
					});
					
					document.getElementById("idTipo").onchange = function() {cambia_tipo()};
					
					function cambia_tipo(){
						let Componente = document.form1.idTipo[document.form1.idTipo.selectedIndex].value;
						
						switch(Componente) {
							//Errores Conjuntos
							case '1':
								document.getElementById("div_valor_error").style.display = "block";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Todos los sensores tienen el mismo valor de error";
							break;
							//Rango Porcentaje Grupo
							case '2':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "block";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Un sensor tiene un valor que es x porcentaje inferior o superior a otro sensor dentro del grupo de sensores";
							break;
							//Alertas Personalizadas (al menos 1 error)
							case '3':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Al menos un sensor se encuentra fuera del rango de trabajo normal";
							break;
							//Alertas Personalizadas (todos con error)
							case '4':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Todos los sensores se encuentra fuera del rango de trabajo normal";
							break;
							//Promedios fuera de Rangos
							case '5':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "block";
								document.getElementById("div_Rango_fin").style.display = "block";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("alert_post_data").innerHTML = "El promedio de los sensores esta fuera del rango establecido";
							break;
							//Alertas Personalizadas (todos con valor especifico)
							case '6':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Todos los sensores estan con un valor predefinido, el cual indica error";
							break;

						}
						
					}
				</script>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['newAlarma']) ) { ?>
	
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Alarma Personalizada</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {            $x1  = $Nombre;            }else{$x1  = '';}
				if(isset($idTipoAlerta)) {      $x2  = $idTipoAlerta;      }else{$x2  = '';}
				if(isset($idUniMed)) {          $x3  = $idUniMed;          }else{$x3  = '';}
				if(isset($idTipo)) {            $x4  = $idTipo;            }else{$x4  = '';}
				if(isset($NErroresMax)) {       $x5  = $NErroresMax;       }else{$x5  = '';}
				if(isset($NErroresActual)) {    $x6  = $NErroresActual;    }else{$x6  = '';}
				if(isset($valor_error)) {       $x7  = $valor_error;       }else{$x7  = '';}
				if(isset($valor_diferencia)) {  $x8  = $valor_diferencia;  }else{$x8  = '';}
				if(isset($Rango_ini)) {         $x9  = $Rango_ini;         }else{$x9  = '';}
				if(isset($Rango_fin)) {         $x10 = $Rango_fin;         }else{$x10 = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				
				$Form_Inputs->form_post_data(1, 'Seleccione un Tipo Alarma');
				$Form_Inputs->form_select('Tipo Alarma','idTipo', $x4, 2, 'idTipo', 'Nombre', 'telemetria_listado_alarmas_perso_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_number('N° Maximo Errores','NErroresMax', $x5, 2);
				$Form_Inputs->form_input_number('N° Actual Errores','NErroresActual', $x6, 1);
				//opcionales ocultos
				$Form_Inputs->form_input_number('Valor de error','valor_error', $x7, 1);
				$Form_Inputs->form_input_number('Porcentaje de diferencia','valor_diferencia', $x8, 1);
				$Form_Inputs->form_input_number('Rango Inicio','Rango_ini', $x9, 1);
				$Form_Inputs->form_input_number('Rango Termino','Rango_fin', $x10, 1);
				
				$Form_Inputs->form_post_data(1, 'Tiene relacion a como se notificaran:<br/>- <strong>Normales</strong> = cada 15 minutos.<br/>- <strong>Catastrofica</strong> = cada vez que ocurra.');
				$Form_Inputs->form_select('Prioridad Alarma','idTipoAlerta', $x2, 2, 'idTipoAlerta', 'Nombre', 'core_telemetria_tipo_alertas', 0, '', $dbConn);
				
				$Form_Inputs->form_post_data(1, 'Se utiliza unicamente en <strong>Informes CrossCrane - Alertas por Grua</strong> para poder agrupar los errores de voltaje.');
				$Form_Inputs->form_select('Unidad de Medida','idUniMed', $x3, 1, 'idUniMed', 'Nombre', 'telemetria_listado_unidad_medida', 0, '', $dbConn);	
				
				
				$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				
					
				?>
				<script>
					
					$(document).ready(function(){
						document.getElementById("div_valor_error").style.display = "none";
						document.getElementById("div_valor_diferencia").style.display = "none";
						document.getElementById("div_Rango_ini").style.display = "none";
						document.getElementById("div_Rango_fin").style.display = "none";
					});
					
					document.getElementById("idTipo").onchange = function() {cambia_tipo()};
					
					function cambia_tipo(){
						let Componente = document.form1.idTipo[document.form1.idTipo.selectedIndex].value;
						
						switch(Componente) {
							//Errores Conjuntos
							case '1':
								document.getElementById("div_valor_error").style.display = "block";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Todos los sensores tienen el mismo valor de error";
							break;
							//Rango Porcentaje Grupo
							case '2':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "block";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Un sensor tiene un valor que es x porcentaje inferior o superior a otro sensor dentro del grupo de sensores";
							break;
							//Alertas Personalizadas (al menos 1 error)
							case '3':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Al menos un sensor se encuentra fuera del rango de trabajo normal";
							break;
							//Alertas Personalizadas (todos con error)
							case '4':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Todos los sensores se encuentra fuera del rango de trabajo normal";
							break;
							//Promedios fuera de Rangos
							case '5':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "block";
								document.getElementById("div_Rango_fin").style.display = "block";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("alert_post_data").innerHTML = "El promedio de los sensores esta fuera del rango establecido";
							break;
							//Alertas Personalizadas (todos con valor especifico)
							case '6':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("div_Rango_ini").style.display = "none";
								document.getElementById("div_Rango_fin").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
								document.getElementById("Rango_ini").value = "";
								document.getElementById("Rango_fin").value = "";
								document.getElementById("alert_post_data").innerHTML = "Todos los sensores estan con un valor predefinido, el cual indica error";
							break;

						}
					}
				</script>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $new_location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>	
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {	  
// tomo los datos del equipo
$rowdata = db_select_data (false, 'Nombre, idUsoContrato, id_Geo, id_Sensores, idUsoGeocerca, cantSensores', 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//defino los nombres de los sensores
$subsql = '';
for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
    $subsql .= ',telemetria_listado.SensoresNombre_'.$i;
    $subsql .= ',telemetria_listado.SensoresGrupo_'.$i; 
}

$SIS_query = '
telemetria_listado_alarmas_perso.idAlarma, 
telemetria_listado_alarmas_perso.Nombre,
telemetria_listado_alarmas_perso.idTipo,
telemetria_listado_alarmas_perso.NErroresMax, 
telemetria_listado_alarmas_perso.NErroresActual,
telemetria_listado_alarmas_perso.Rango_ini AS AlarmIni,
telemetria_listado_alarmas_perso.Rango_fin AS AlarmFin,
telemetria_listado_alarmas_perso_tipos.Nombre AS Tipo,
telemetria_listado_alarmas_perso_items.Sensor_N,
telemetria_listado_alarmas_perso_items.Rango_ini,
telemetria_listado_alarmas_perso_items.Rango_fin,
telemetria_listado_alarmas_perso_items.valor_especifico,
core_telemetria_tipo_alertas.Nombre AS Prioridad,
telemetria_listado_unidad_medida.Nombre AS Unimed,
telemetria_listado_alarmas_perso.idTipoAlerta'.$subsql;
$SIS_join  = '
LEFT JOIN `telemetria_listado_alarmas_perso_tipos` ON telemetria_listado_alarmas_perso_tipos.idTipo    = telemetria_listado_alarmas_perso.idTipo
LEFT JOIN `telemetria_listado_alarmas_perso_items` ON telemetria_listado_alarmas_perso_items.idAlarma  = telemetria_listado_alarmas_perso.idAlarma
LEFT JOIN `telemetria_listado`                     ON telemetria_listado.idTelemetria                  = telemetria_listado_alarmas_perso.idTelemetria
LEFT JOIN `core_telemetria_tipo_alertas`           ON core_telemetria_tipo_alertas.idTipoAlerta        = telemetria_listado_alarmas_perso.idTipoAlerta
LEFT JOIN `telemetria_listado_unidad_medida`       ON telemetria_listado_unidad_medida.idUniMed        = telemetria_listado_alarmas_perso.idUniMed';
$SIS_where = 'telemetria_listado_alarmas_perso.idTelemetria ='.$_GET['id'];
$SIS_order = 'telemetria_listado_alarmas_perso.idAlarma ASC';
$arrAlarmas = array();
$arrAlarmas = db_select_array (false, $SIS_query, 'telemetria_listado_alarmas_perso', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrAlarmas');

$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrGrupos');

$arrGruposEx    = array();
foreach ($arrGrupos as $sen) {    $arrGruposEx[$sen['idGrupo']] = $sen['Nombre']; }								


?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Alertas Personalizadas');?>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location; ?>&newAlarma=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Alarma</a><?php } ?>
	</div>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class="active"><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarmas Personalizadas</a></li>
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
							<li class=""><a href="<?php echo 'telemetria_listado_sensor_operaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Definicion Operacional</a></li>
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
						<th>Tipo</th>
						<th>Nombre</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					filtrar($arrAlarmas, 'idAlarma');  
					foreach($arrAlarmas as $tipo=>$alarmas){ ?>
						<tr class="odd">		
							<td>
								<?php 
								//Si es normal
								if(isset($equip['idTipoAlerta'])&&$equip['idTipoAlerta']==1){
									$label_color = 'label-success';
								//si es catastrofica 
								}else{
									$label_color = 'label-danger';
								}
								//imprimo
								echo '<strong>Tipo: </strong>'.$alarmas[0]['Tipo'].'<br/>'; 
								echo '<strong>Prioridad Alarma: </strong><label class="label '.$label_color.'">'.$alarmas[0]['Prioridad'].'</label><br/>'; 
								echo '<strong>Unidad Medida: </strong>'.$alarmas[0]['Unimed'].'<br/>'; 
								echo '<strong>N° Maximo Errores: </strong>'.$alarmas[0]['NErroresMax'].'<br/>';
								echo '<strong>N° Actual Errores: </strong>'.$alarmas[0]['NErroresActual'].'<br/>';
								?>
							</td>	
							<td>
								<?php 
								echo '<strong>Nombre: </strong>'.$alarmas[0]['Nombre']; 
								if(isset($alarmas[0]['AlarmIni'])&&$alarmas[0]['AlarmIni']!=0&&isset($alarmas[0]['AlarmFin'])&&$alarmas[0]['AlarmFin']!=0){
									echo '('.Cantidades_decimales_justos($alarmas[0]['AlarmIni']).' / '.Cantidades_decimales_justos($alarmas[0]['AlarmFin']).')<br/>';
								}else{
									echo '<br/>';
								}
								
								echo '<strong>Sensores: </strong>'; 
								echo '<ul>';
								foreach ($alarmas as $alarm) {
									//grupo si es que existe
									$sub_nom = '';
									if(isset($alarm['SensoresGrupo_'.$alarm['Sensor_N']])&&isset($arrGruposEx[$alarm['SensoresGrupo_'.$alarm['Sensor_N']]])&&$arrGruposEx[$alarm['SensoresGrupo_'.$alarm['Sensor_N']]]!=''){
										$sub_nom .= $arrGruposEx[$alarm['SensoresGrupo_'.$alarm['Sensor_N']]].' - ';
									}
									//nombre del sensor
									if(isset($alarm['SensoresNombre_'.$alarm['Sensor_N']])&&$alarm['SensoresNombre_'.$alarm['Sensor_N']]!=''){
										$sub_nom .= $alarm['SensoresNombre_'.$alarm['Sensor_N']]; 
									}
									//valores
									if(isset($alarmas[0]['idTipo'])&&$alarmas[0]['idTipo']!=''&&($alarmas[0]['idTipo']==3 OR $alarmas[0]['idTipo']==4)){
										$sub_nom .= ' (Rango: '.Cantidades_decimales_justos($alarm['Rango_ini']).' / '.Cantidades_decimales_justos($alarm['Rango_fin']).')';
									}elseif(isset($alarmas[0]['idTipo'])&&$alarmas[0]['idTipo']!=''&&$alarmas[0]['idTipo']==6){
										$sub_nom .= ' (Valor especifico: '.Cantidades_decimales_justos($alarm['valor_especifico']).')';
									}
									
									/*if(isset($alarm['Rango_ini'])&&$alarm['Rango_ini']!=0&&isset($alarm['Rango_fin'])&&$alarm['Rango_fin']!=0){
										$sub_nom .= '('.Cantidades_decimales_justos($alarm['Rango_ini']).' / '.Cantidades_decimales_justos($alarm['Rango_fin']).')';
									}*/
									echo '<li>'.$sub_nom.'</li>';
								}
								echo '</ul>';
								
								?>
							</td>	
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&editAlarma='.$tipo; ?>" title="Editar Datos Basicos" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&nombre_equipo='.$alarmas[0]['Nombre'].'&listItems='.$tipo.'&idTipo='.$alarmas[0]['idTipo']; ?>" title="Editar Sensores" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										//se verifica que el usuario no sea uno mismo
										$ubicacion = $new_location.'&delAlarma='.simpleEncode($tipo, fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar la alarma personalizada '.$alarmas[0]['Nombre'].'?';?>
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
