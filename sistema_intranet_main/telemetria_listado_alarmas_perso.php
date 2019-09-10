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
// tomo los datos del usuario
$query = "SELECT Sensor_N, Rango_ini, Rango_fin
FROM `telemetria_listado_alarmas_perso_items`
WHERE idItem = {$_GET['editItem']}";
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

$Form_Imputs = new Form_Inputs();
?>
	
	
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Item</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				$Form_Imputs = new Form_Inputs();
				
				//Se traen todos los nombres
				$query = "SELECT
				idTelemetria, cantSensores, 
								
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
								
				SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
				SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
				SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
				SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
				SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
				SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
				SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
				SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
				SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
				SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50

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
				$rowSensores = mysqli_fetch_assoc ($resultado);

								
								
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

				echo '<div class="form-group" id="div_sensorn" >
						<label for="text2" class="control-label col-sm-4">Sensor</label>
						<div class="col-sm-8">
							<select name="Sensor_N" id="Sensor_N" class="form-control" required="">
								<option value="" selected>Seleccione una Opcion</option>';

								for ($i = 1; $i <= $rowSensores['cantSensores']; $i++) {
									//solo sensores activos
									if(isset($rowSensores['SensoresActivo_'.$i])&&$rowSensores['SensoresActivo_'.$i]==1){
										//se verifica grupo
										foreach ($arrGrupos as $sen) { 
											if($rowSensores['SensoresGrupo_'.$i]==$sen['idGrupo']){
												$selected = '';
												if($rowdata['Sensor_N']==$i){
													$selected = 'selected';
												}
												
												
												
												echo '<option value="'.$i.'" '.$selected.'>'.$sen['Nombre'].' - '.$rowSensores['SensoresNombre_'.$i].'</option>';
											}
										}
												
									}
								}
									
							echo '	
							</select>
						</div>
					</div>';
				
				if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&$_GET['idTipo']==3){
					//Se verifican si existen los datos
					if(isset($Rango_ini)) {  $x1  = $Rango_ini;  }else{$x1  = Cantidades_decimales_justos($rowdata['Rango_ini']);}
					if(isset($Rango_fin)) {  $x2  = $Rango_fin;  }else{$x2  = Cantidades_decimales_justos($rowdata['Rango_fin']);}
					
					//opcionales ocultos
					$Form_Imputs->form_input_number('Rango Inicio','Rango_ini', $x1, 2);
					$Form_Imputs->form_input_number('Rango Termino','Rango_fin', $x2, 2);
				}
				
				
				
				
				$Form_Imputs->form_input_hidden('idItem', $_GET['editItem'], 2);
									
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_item">
					<a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['addItem']) ) { ?>
	
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Item</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				$Form_Imputs = new Form_Inputs();
				
				//Se traen todos los nombres
				$query = "SELECT
				idTelemetria, cantSensores, 
								
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
								
				SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
				SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
				SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
				SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
				SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
				SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
				SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
				SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
				SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
				SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50

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
				$rowSensores = mysqli_fetch_assoc ($resultado);

								
								
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

				echo '<div class="form-group" id="div_sensorn" >
						<label for="text2" class="control-label col-sm-4">Sensor</label>
						<div class="col-sm-8">
							<select name="Sensor_N" id="Sensor_N" class="form-control" required="">
								<option value="" selected>Seleccione una Opcion</option>';

								for ($i = 1; $i <= $rowSensores['cantSensores']; $i++) {
									//solo sensores activos
									if(isset($rowSensores['SensoresActivo_'.$i])&&$rowSensores['SensoresActivo_'.$i]==1){
										//se verifica grupo
										foreach ($arrGrupos as $sen) { 
											if($rowSensores['SensoresGrupo_'.$i]==$sen['idGrupo']){
												echo '<option value="'.$i.'">'.$sen['Nombre'].' - '.$rowSensores['SensoresNombre_'.$i].'</option>';
											}
										}
												
									}
								}
									
							echo '	
							</select>
						</div>
					</div>';
				
				if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''&&$_GET['idTipo']==3){
					//Se verifican si existen los datos
					if(isset($Rango_ini)) {  $x1  = $Rango_ini;  }else{$x1  = '';}
					if(isset($Rango_fin)) {  $x2  = $Rango_fin;  }else{$x2  = '';}
					
					//opcionales ocultos
					$Form_Imputs->form_input_number('Rango Inicio','Rango_ini', $x1, 2);
					$Form_Imputs->form_input_number('Rango Termino','Rango_fin', $x2, 2);
				}
				
				
				
				
				$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('idAlarma', $_GET['listItems'], 2);
									
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_item">
					<a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
$query = "SELECT  idItem, Sensor_N, Rango_ini, Rango_fin
FROM `telemetria_listado_alarmas_perso_items`
WHERE idAlarma = {$_GET['listItems']}";
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
array_push( $arrAlarmas,$row );
}

//Se traen todos los nombres
$query = "SELECT
idTelemetria, cantSensores, 
				
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
$rowSensores = mysqli_fetch_assoc ($resultado);

				
				
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
?>

<div class="col-sm-12">
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo']; ?>&addItem=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Item</a><?php } ?>
</div>
<div class="clearfix"></div> 



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Items de <?php echo $_GET['nombre_equipo']; ?></h5>	
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
							$grupo = '';
							foreach ($arrGrupos as $gru) {
								if($gru['idGrupo']==$rowSensores['SensoresGrupo_'.$alarmas['Sensor_N']]){
									$grupo = $gru['Nombre'].' - ';
								}
							}
							echo $grupo.$rowSensores['SensoresNombre_'.$alarmas['Sensor_N']]; 
							if(isset($alarmas['Rango_ini'])&&$alarmas['Rango_ini']!=0&&isset($alarmas['Rango_fin'])&&$alarmas['Rango_fin']!=0){
								echo '('.Cantidades_decimales_justos($alarmas['Rango_ini']).' - '.Cantidades_decimales_justos($alarmas['Rango_fin']).')';
							}
							?>
							</td>		
							<td>
								<div class="btn-group" style="width: 70px;" >
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&nombre_equipo='.$_GET['nombre_equipo'].'&listItems='.$_GET['listItems'].'&idTipo='.$_GET['idTipo'].'&editItem='.$alarmas['idItem']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										//se verifica que el usuario no sea uno mismo
										$ubicacion = $new_location.'&delAlarma_item='.$alarmas['idItem'];
										$dialogo   = '¿Realmente deseas eliminar el item '.$grupo.$rowSensores['SensoresNombre_'.$alarmas['Sensor_N']].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $new_location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['editAlarma']) ) { 
// tomo los datos del usuario
$query = "SELECT Nombre, idTipo, valor_error, valor_diferencia
FROM `telemetria_listado_alarmas_perso`
WHERE idAlarma = {$_GET['editAlarma']}";
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
			<h5>Editar Alarma Personalizada</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {            $x1  = $Nombre;            }else{$x1  = $rowdata['Nombre'];}
				if(isset($idTipo)) {            $x2  = $idTipo;            }else{$x2  = $rowdata['idTipo'];}
				if(isset($valor_error)) {       $x3  = $valor_error;       }else{$x3  = Cantidades_decimales_justos($rowdata['valor_error']);}
				if(isset($valor_diferencia)) {  $x4  = $valor_diferencia;  }else{$x4  = Cantidades_decimales_justos($rowdata['valor_diferencia']);}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select('Tipo Alarma','idTipo', $x2, 2, 'idTipo', 'Nombre', 'telemetria_listado_alarmas_perso_tipos', 0, '', $dbConn);
				//opcionales ocultos
				$Form_Imputs->form_input_number('Valor error','valor_error', $x3, 1);
				$Form_Imputs->form_input_number('porcentaje diferencia','valor_diferencia', $x4, 1);
				
				$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('idAlarma', $_GET['editAlarma'], 2);
					
				?>
				
				<script>
					
					$(document).ready(function(){
						document.getElementById("div_valor_error").style.display = "none";
						document.getElementById("div_valor_diferencia").style.display = "none";
						cambia_tipo();
					});
					
					document.getElementById("idTipo").onchange = function() {cambia_tipo()};
					
					function cambia_tipo(){
						var Componente
						Componente = document.form1.idTipo[document.form1.idTipo.selectedIndex].value;
						
						switch(Componente) {
							//Errores Conjuntos
							case '1':
								document.getElementById("div_valor_error").style.display = "block";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("valor_diferencia").value = "";
							break;
							//Rango Porcentaje Grupo
							case '2':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("div_valor_diferencia").style.display = "block";
							break;
							//Alertas Personalizadas
							case '3':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
							break;

						}
					}
				</script>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Alarma Personalizada</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {            $x1  = $Nombre;            }else{$x1  = '';}
				if(isset($idTipo)) {            $x2  = $idTipo;            }else{$x2  = '';}
				if(isset($valor_error)) {       $x3  = $valor_error;       }else{$x3  = '';}
				if(isset($valor_diferencia)) {  $x4  = $valor_diferencia;  }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select('Tipo Alarma','idTipo', $x2, 2, 'idTipo', 'Nombre', 'telemetria_listado_alarmas_perso_tipos', 0, '', $dbConn);
				//opcionales ocultos
				$Form_Imputs->form_input_number('Valor error','valor_error', $x3, 1);
				$Form_Imputs->form_input_number('porcentaje diferencia','valor_diferencia', $x4, 1);
				
				
				$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
				
					
				?>
				<script>
					
					$(document).ready(function(){
						document.getElementById("div_valor_error").style.display = "none";
						document.getElementById("div_valor_diferencia").style.display = "none";
					});
					
					document.getElementById("idTipo").onchange = function() {cambia_tipo()};
					
					function cambia_tipo(){
						var Componente
						Componente = document.form1.idTipo[document.form1.idTipo.selectedIndex].value;
						
						switch(Componente) {
							//Errores Conjuntos
							case '1':
								document.getElementById("div_valor_error").style.display = "block";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("valor_diferencia").value = "";
							break;
							//Rango Porcentaje Grupo
							case '2':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("div_valor_diferencia").style.display = "block";
							break;
							//Alertas Personalizadas
							case '3':
								document.getElementById("div_valor_error").style.display = "none";
								document.getElementById("div_valor_diferencia").style.display = "none";
								document.getElementById("valor_error").value = "";
								document.getElementById("valor_diferencia").value = "";
							break;

						}
					}
				</script>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $new_location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>	
	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {// tomo los datos del usuario
$query = "SELECT Nombre, idUsoContrato, id_Geo, id_Sensores
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

// Se trae un listado con todas las alarmas
$arrAlarmas = array();
$query = "SELECT 
telemetria_listado_alarmas_perso.idAlarma, 
telemetria_listado_alarmas_perso.Nombre,
telemetria_listado_alarmas_perso.idTipo,
telemetria_listado_alarmas_perso_tipos.Nombre AS Tipo
FROM `telemetria_listado_alarmas_perso`
LEFT JOIN `telemetria_listado_alarmas_perso_tipos` ON telemetria_listado_alarmas_perso_tipos.idTipo = telemetria_listado_alarmas_perso.idTipo
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrAlarmas,$row );
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
				<span class="progress-description">Editar Alertas Personalizadas</span>
			</div>
		</div>
	</div>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location; ?>&newAlarma=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Alarma</a><?php } ?>

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
						<li class=""><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Sensores</a></li>
						<li class="active"><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Alarmas Personalizadas</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Horario</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Otros Datos</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivos</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">   
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Tipo</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrAlarmas as $alarmas) { ?>
						<tr class="odd">		
							<td><?php echo $alarmas['Nombre']; ?></td>	
							<td><?php echo $alarmas['Tipo']; ?></td>	
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&nombre_equipo='.$alarmas['Nombre'].'&listItems='.$alarmas['idAlarma'].'&idTipo='.$alarmas['idTipo']; ?>" title="Editar Sensores" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&editAlarma='.$alarmas['idAlarma']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										//se verifica que el usuario no sea uno mismo
										$ubicacion = $new_location.'&delAlarma='.$alarmas['idAlarma'];
										$dialogo   = '¿Realmente deseas eliminar la alarma personalizada '.$alarmas['Nombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
