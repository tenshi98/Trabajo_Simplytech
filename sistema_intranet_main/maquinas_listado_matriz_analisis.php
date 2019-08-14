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
$original = "maquinas_listado.php";
$location = $original;
$new_location = "maquinas_listado_matriz_analisis.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit']) )  { 
	//se agregan ubicaciones
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'insert_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_maquinas_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_maquinas_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//se agregan ubicaciones
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_maquinas_listado.php';	
}
//se clona la maquina
if ( !empty($_POST['clone_Matriz']) )  { 
	//se agregan ubicaciones
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'clone_Matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_maquinas_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/'.$x_column_maquina_sing.' creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/'.$x_column_maquina_sing.' editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/'.$x_column_maquina_sing.' borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['clone_idMatriz']) ) { 
	
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Clonar Matriz <?php echo $_GET['nombre_matriz']; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {           $x1  = $Nombre;           }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				
				$Form_Imputs->form_input_hidden('idMatriz', $_GET['clone_idMatriz'], 2);
				?>  
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c5; Clonar" name="clone_Matriz">
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
$cadena  = 'PuntoNombre_'.$_GET['mod'].' AS Nombre';
$cadena .= ',PuntoMedAceptable_'.$_GET['mod'].' AS Aceptable';
$cadena .= ',PuntoMedAlerta_'.$_GET['mod'].' AS Alerta';
$cadena .= ',PuntoMedCondenatorio_'.$_GET['mod'].' AS Condenatorio';
$cadena .= ',PuntoUniMed_'.$_GET['mod'].' AS UniMed';
$cadena .= ',PuntoidTipo_'.$_GET['mod'].' AS Tipo';
$cadena .= ',PuntoidGrupo_'.$_GET['mod'].' AS Grupo';

// tomo los datos del usuario
$query = "SELECT ".$cadena."
FROM `maquinas_listado_matriz`
WHERE idMatriz = {$_GET['idMatriz']}";
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
			<h5>Editar Parametros</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'PuntoNombre', $rowdata['Nombre'], 1);
				$Form_Imputs->form_select_depend1('Tipo', 'PuntoidTipo',  $rowdata['Tipo'],  1, 'idTipo', 'Nombre', 'core_analisis_tipos', 0,  0,
										 'Grupo', 'PuntoidGrupo',  $rowdata['Grupo'],  1,  'idGrupo', 'Nombre', 'maquinas_listado_matriz_grupos', 0,   0, 
										 $dbConn, 'form1');
							 
				$Form_Imputs->form_input_number('Aceptable','PuntoMedAceptable', Cantidades_decimales_justos($rowdata['Aceptable']), 1);
				$Form_Imputs->form_input_number('Alerta','PuntoMedAlerta', Cantidades_decimales_justos($rowdata['Alerta']), 1);
				$Form_Imputs->form_input_number('Condenatorio','PuntoMedCondenatorio', Cantidades_decimales_justos($rowdata['Condenatorio']), 1);
				$Form_Imputs->form_select('Unidad de Medida','PuntoUniMed', $rowdata['UniMed'], 1, 'idUml', 'Nombre', 'sistema_analisis_uml', 0, '', $dbConn);	
				
				
				$Form_Imputs->form_input_hidden('idMatriz', $_GET['idMatriz'], 2);
				$Form_Imputs->form_input_hidden('mod', $_GET['mod'], 2);
				?>

				<script>
					document.getElementById('div_PuntoMedAceptable').style.display = 'none';
					document.getElementById('div_PuntoMedAlerta').style.display = 'none';
					document.getElementById('div_PuntoMedCondenatorio').style.display = 'none';
					document.getElementById('div_PuntoUniMed').style.display = 'none';
					
					var Sensores_val;
					var modelSelected1;
							
			 
					$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
								
						Sensores_val= $("#PuntoidTipo").val();
						
						//si es medicion
						if(Sensores_val == 1){ 
							document.getElementById('div_PuntoMedAceptable').style.display = '';
							document.getElementById('div_PuntoMedAlerta').style.display = '';
							document.getElementById('div_PuntoMedCondenatorio').style.display = '';
							document.getElementById('div_PuntoUniMed').style.display = '';						
						//para el resto
						} else { 
							document.getElementById('div_PuntoMedAceptable').style.display = 'none';
							document.getElementById('div_PuntoMedAlerta').style.display = 'none';
							document.getElementById('div_PuntoMedCondenatorio').style.display = 'none';
							document.getElementById('div_PuntoUniMed').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementById('PuntoMedAceptable').value = "0";
							document.getElementById('PuntoMedAlerta').value = "0";
							document.getElementById('PuntoMedCondenatorio').value = "0";
							document.getElementById('PuntoUniMed').value = "0";
							
						}		
					}); 
							
					$("#PuntoidTipo").on("change", function(){ //se ejecuta al cambiar valor del select
						modelSelected1 = $(this).val(); //Asignamos el valor seleccionado
						
						//si es medicion
						if(modelSelected1 == 1){ 
							document.getElementById('div_PuntoMedAceptable').style.display = '';
							document.getElementById('div_PuntoMedAlerta').style.display = '';
							document.getElementById('div_PuntoMedCondenatorio').style.display = '';
							document.getElementById('div_PuntoUniMed').style.display = '';						
						//para el resto
						} else { 
							document.getElementById('div_PuntoMedAceptable').style.display = 'none';
							document.getElementById('div_PuntoMedAlerta').style.display = 'none';
							document.getElementById('div_PuntoMedCondenatorio').style.display = 'none';
							document.getElementById('div_PuntoUniMed').style.display = 'none';
							//Reseteo los valores a 0
							document.getElementById('PuntoMedAceptable').value = "0";
							document.getElementById('PuntoMedAlerta').value = "0";
							document.getElementById('PuntoMedCondenatorio').value = "0";
							document.getElementById('PuntoUniMed').value = "0";
						}
					});
							
							
				</script> 
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id'].'&idMatriz='.$_GET['idMatriz']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div> 
	 	 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} elseif ( ! empty($_GET['idMatriz']) ) {    
// tomo los datos del usuario
$query = "SELECT Nombre,cantPuntos,
PuntoNombre_1,PuntoNombre_2,PuntoNombre_3,PuntoNombre_4,PuntoNombre_5,
PuntoNombre_6,PuntoNombre_7,PuntoNombre_8,PuntoNombre_9,PuntoNombre_10,
PuntoNombre_11,PuntoNombre_12,PuntoNombre_13,PuntoNombre_14,PuntoNombre_15,
PuntoNombre_16,PuntoNombre_17,PuntoNombre_18,PuntoNombre_19,PuntoNombre_20,
PuntoNombre_21,PuntoNombre_22,PuntoNombre_23,PuntoNombre_24,PuntoNombre_25,
PuntoNombre_26,PuntoNombre_27,PuntoNombre_28,PuntoNombre_29,PuntoNombre_30,
PuntoNombre_31,PuntoNombre_32,PuntoNombre_33,PuntoNombre_34,PuntoNombre_35,
PuntoNombre_36,PuntoNombre_37,PuntoNombre_38,PuntoNombre_39,PuntoNombre_40,
PuntoNombre_41,PuntoNombre_42,PuntoNombre_43,PuntoNombre_44,PuntoNombre_45,
PuntoNombre_46,PuntoNombre_47,PuntoNombre_48,PuntoNombre_49,PuntoNombre_50,

PuntoMedAceptable_1,PuntoMedAceptable_2,PuntoMedAceptable_3,PuntoMedAceptable_4,PuntoMedAceptable_5,
PuntoMedAceptable_6,PuntoMedAceptable_7,PuntoMedAceptable_8,PuntoMedAceptable_9,PuntoMedAceptable_10,
PuntoMedAceptable_11,PuntoMedAceptable_12,PuntoMedAceptable_13,PuntoMedAceptable_14,PuntoMedAceptable_15,
PuntoMedAceptable_16,PuntoMedAceptable_17,PuntoMedAceptable_18,PuntoMedAceptable_19,PuntoMedAceptable_20,
PuntoMedAceptable_21,PuntoMedAceptable_22,PuntoMedAceptable_23,PuntoMedAceptable_24,PuntoMedAceptable_25,
PuntoMedAceptable_26,PuntoMedAceptable_27,PuntoMedAceptable_28,PuntoMedAceptable_29,PuntoMedAceptable_30,
PuntoMedAceptable_31,PuntoMedAceptable_32,PuntoMedAceptable_33,PuntoMedAceptable_34,PuntoMedAceptable_35,
PuntoMedAceptable_36,PuntoMedAceptable_37,PuntoMedAceptable_38,PuntoMedAceptable_39,PuntoMedAceptable_40,
PuntoMedAceptable_41,PuntoMedAceptable_42,PuntoMedAceptable_43,PuntoMedAceptable_44,PuntoMedAceptable_45,
PuntoMedAceptable_46,PuntoMedAceptable_47,PuntoMedAceptable_48,PuntoMedAceptable_49,PuntoMedAceptable_50,

PuntoMedAlerta_1,PuntoMedAlerta_2,PuntoMedAlerta_3,PuntoMedAlerta_4,PuntoMedAlerta_5,
PuntoMedAlerta_6,PuntoMedAlerta_7,PuntoMedAlerta_8,PuntoMedAlerta_9,PuntoMedAlerta_10,
PuntoMedAlerta_11,PuntoMedAlerta_12,PuntoMedAlerta_13,PuntoMedAlerta_14,PuntoMedAlerta_15,
PuntoMedAlerta_16,PuntoMedAlerta_17,PuntoMedAlerta_18,PuntoMedAlerta_19,PuntoMedAlerta_20,
PuntoMedAlerta_21,PuntoMedAlerta_22,PuntoMedAlerta_23,PuntoMedAlerta_24,PuntoMedAlerta_25,
PuntoMedAlerta_26,PuntoMedAlerta_27,PuntoMedAlerta_28,PuntoMedAlerta_29,PuntoMedAlerta_30,
PuntoMedAlerta_31,PuntoMedAlerta_32,PuntoMedAlerta_33,PuntoMedAlerta_34,PuntoMedAlerta_35,
PuntoMedAlerta_36,PuntoMedAlerta_37,PuntoMedAlerta_38,PuntoMedAlerta_39,PuntoMedAlerta_40,
PuntoMedAlerta_41,PuntoMedAlerta_42,PuntoMedAlerta_43,PuntoMedAlerta_44,PuntoMedAlerta_45,
PuntoMedAlerta_46,PuntoMedAlerta_47,PuntoMedAlerta_48,PuntoMedAlerta_49,PuntoMedAlerta_50,

PuntoMedCondenatorio_1,PuntoMedCondenatorio_2,PuntoMedCondenatorio_3,PuntoMedCondenatorio_4,PuntoMedCondenatorio_5,
PuntoMedCondenatorio_6,PuntoMedCondenatorio_7,PuntoMedCondenatorio_8,PuntoMedCondenatorio_9,PuntoMedCondenatorio_10,
PuntoMedCondenatorio_11,PuntoMedCondenatorio_12,PuntoMedCondenatorio_13,PuntoMedCondenatorio_14,PuntoMedCondenatorio_15,
PuntoMedCondenatorio_16,PuntoMedCondenatorio_17,PuntoMedCondenatorio_18,PuntoMedCondenatorio_19,PuntoMedCondenatorio_20,
PuntoMedCondenatorio_21,PuntoMedCondenatorio_22,PuntoMedCondenatorio_23,PuntoMedCondenatorio_24,PuntoMedCondenatorio_25,
PuntoMedCondenatorio_26,PuntoMedCondenatorio_27,PuntoMedCondenatorio_28,PuntoMedCondenatorio_29,PuntoMedCondenatorio_30,
PuntoMedCondenatorio_31,PuntoMedCondenatorio_32,PuntoMedCondenatorio_33,PuntoMedCondenatorio_34,PuntoMedCondenatorio_35,
PuntoMedCondenatorio_36,PuntoMedCondenatorio_37,PuntoMedCondenatorio_38,PuntoMedCondenatorio_39,PuntoMedCondenatorio_40,
PuntoMedCondenatorio_41,PuntoMedCondenatorio_42,PuntoMedCondenatorio_43,PuntoMedCondenatorio_44,PuntoMedCondenatorio_45,
PuntoMedCondenatorio_46,PuntoMedCondenatorio_47,PuntoMedCondenatorio_48,PuntoMedCondenatorio_49,PuntoMedCondenatorio_50,

PuntoUniMed_1,PuntoUniMed_2,PuntoUniMed_3,PuntoUniMed_4,PuntoUniMed_5,
PuntoUniMed_6,PuntoUniMed_7,PuntoUniMed_8,PuntoUniMed_9,PuntoUniMed_10,
PuntoUniMed_11,PuntoUniMed_12,PuntoUniMed_13,PuntoUniMed_14,PuntoUniMed_15,
PuntoUniMed_16,PuntoUniMed_17,PuntoUniMed_18,PuntoUniMed_19,PuntoUniMed_20,
PuntoUniMed_21,PuntoUniMed_22,PuntoUniMed_23,PuntoUniMed_24,PuntoUniMed_25,
PuntoUniMed_26,PuntoUniMed_27,PuntoUniMed_28,PuntoUniMed_29,PuntoUniMed_30,
PuntoUniMed_31,PuntoUniMed_32,PuntoUniMed_33,PuntoUniMed_34,PuntoUniMed_35,
PuntoUniMed_36,PuntoUniMed_37,PuntoUniMed_38,PuntoUniMed_39,PuntoUniMed_40,
PuntoUniMed_41,PuntoUniMed_42,PuntoUniMed_43,PuntoUniMed_44,PuntoUniMed_45,
PuntoUniMed_46,PuntoUniMed_47,PuntoUniMed_48,PuntoUniMed_49,PuntoUniMed_50,

PuntoidGrupo_1,PuntoidGrupo_2,PuntoidGrupo_3,PuntoidGrupo_4,PuntoidGrupo_5,
PuntoidGrupo_6,PuntoidGrupo_7,PuntoidGrupo_8,PuntoidGrupo_9,PuntoidGrupo_10,
PuntoidGrupo_11,PuntoidGrupo_12,PuntoidGrupo_13,PuntoidGrupo_14,PuntoidGrupo_15,
PuntoidGrupo_16,PuntoidGrupo_17,PuntoidGrupo_18,PuntoidGrupo_19,PuntoidGrupo_20,
PuntoidGrupo_21,PuntoidGrupo_22,PuntoidGrupo_23,PuntoidGrupo_24,PuntoidGrupo_25,
PuntoidGrupo_26,PuntoidGrupo_27,PuntoidGrupo_28,PuntoidGrupo_29,PuntoidGrupo_30,
PuntoidGrupo_31,PuntoidGrupo_32,PuntoidGrupo_33,PuntoidGrupo_34,PuntoidGrupo_35,
PuntoidGrupo_36,PuntoidGrupo_37,PuntoidGrupo_38,PuntoidGrupo_39,PuntoidGrupo_40,
PuntoidGrupo_41,PuntoidGrupo_42,PuntoidGrupo_43,PuntoidGrupo_44,PuntoidGrupo_45,
PuntoidGrupo_46,PuntoidGrupo_47,PuntoidGrupo_48,PuntoidGrupo_49,PuntoidGrupo_50,

PuntoidTipo_1,PuntoidTipo_2,PuntoidTipo_3,PuntoidTipo_4,PuntoidTipo_5,
PuntoidTipo_6,PuntoidTipo_7,PuntoidTipo_8,PuntoidTipo_9,PuntoidTipo_10,
PuntoidTipo_11,PuntoidTipo_12,PuntoidTipo_13,PuntoidTipo_14,PuntoidTipo_15,
PuntoidTipo_16,PuntoidTipo_17,PuntoidTipo_18,PuntoidTipo_19,PuntoidTipo_20,
PuntoidTipo_21,PuntoidTipo_22,PuntoidTipo_23,PuntoidTipo_24,PuntoidTipo_25,
PuntoidTipo_26,PuntoidTipo_27,PuntoidTipo_28,PuntoidTipo_29,PuntoidTipo_30,
PuntoidTipo_31,PuntoidTipo_32,PuntoidTipo_33,PuntoidTipo_34,PuntoidTipo_35,
PuntoidTipo_36,PuntoidTipo_37,PuntoidTipo_38,PuntoidTipo_39,PuntoidTipo_40,
PuntoidTipo_41,PuntoidTipo_42,PuntoidTipo_43,PuntoidTipo_44,PuntoidTipo_45,
PuntoidTipo_46,PuntoidTipo_47,PuntoidTipo_48,PuntoidTipo_49,PuntoidTipo_50



FROM `maquinas_listado_matriz`
WHERE idMatriz = {$_GET['idMatriz']}";
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



//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUml,Nombre
FROM `sistema_analisis_uml`
ORDER BY idUml ASC";
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

//Se traen todos los tipos
$arrTipos = array();
$query = "SELECT idTipo,Nombre
FROM `core_analisis_tipos`
ORDER BY idTipo ASC";
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
array_push( $arrTipos,$row );
}

//Se traen todos los grupos
$arrGrupos = array();
$query = "SELECT idGrupo,Nombre
FROM `maquinas_listado_matriz_grupos`
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
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Puntos de Analisis</h5>		
		</header>
		
		
        <div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>#</th>
						<th>Tipo</th>
						<th>Nombre</th>
						<th>Grupo</th>
						<th>Aceptable</th>
						<th>Alerta</th>
						<th>Condenatorio</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php for ($i = 1; $i <= $rowdata['cantPuntos']; $i++) { 
						//Unidad medida
						$unimed = '';
						foreach ($arrUnimed as $sen) { 
							if($rowdata['PuntoUniMed_'.$i]==$sen['idUml']){
								$unimed = ' '.$sen['Nombre'];
							}
						}
						?>
					<tr class="odd">		
						<td><?php echo 'p'.$i ?></td>
						<td><?php foreach ($arrTipos as $tipo) { if($rowdata['PuntoidTipo_'.$i]==$tipo['idTipo']){ echo $tipo['Nombre'];}} ?></td>	
						<td><?php echo $rowdata['PuntoNombre_'.$i]; ?></td>
						<td><?php foreach ($arrGrupos as $gru) { if($rowdata['PuntoidGrupo_'.$i]==$gru['idGrupo']){ echo $gru['Nombre'];}} ?></td>		
						<td><?php if(isset($rowdata['PuntoidTipo_'.$i])&&$rowdata['PuntoidTipo_'.$i]==1){echo Cantidades_decimales_justos($rowdata['PuntoMedAceptable_'.$i]).$unimed;}else{echo 'No Aplica';} ?></td>		
						<td><?php if(isset($rowdata['PuntoidTipo_'.$i])&&$rowdata['PuntoidTipo_'.$i]==1){echo Cantidades_decimales_justos($rowdata['PuntoMedAlerta_'.$i]).$unimed;}else{echo 'No Aplica';} ?></td>
						<td><?php if(isset($rowdata['PuntoidTipo_'.$i])&&$rowdata['PuntoidTipo_'.$i]==1){echo Cantidades_decimales_justos($rowdata['PuntoMedCondenatorio_'.$i]).$unimed;}else{echo 'No Aplica';} ?></td>
									
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&idMatriz='.$_GET['idMatriz'].'&mod='.$i; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
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
<a href="<?php echo $new_location.'&id='.$_GET['id'] ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['idMatriz_2']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, cantPuntos, idEstado
FROM `maquinas_listado_matriz`
WHERE idMatriz = {$_GET['idMatriz_2']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion Matriz de Analisis</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;       }else{$x1  = $rowdata['Nombre'];}
				if(isset($cantPuntos)) {  $x2  = $cantPuntos;   }else{$x2  = $rowdata['cantPuntos'];}
				if(isset($idEstado)) {    $x3  = $idEstado;     }else{$x3  = $rowdata['idEstado'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2); 
				$Form_Imputs->form_select_n_auto('Cantidad de Puntos','cantPuntos', $x2, 2, 1, 50);
				$Form_Imputs->form_select('Estado','idEstado', $x3, 2, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);	
						
					
				$Form_Imputs->form_input_hidden('idMatriz', $_GET['idMatriz_2'], 2);
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
 } elseif ( ! empty($_GET['new']) ) {  
//verifico que sea un administrador
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	 
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Matriz de Analisis</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;       }else{$x1  = '';}
				if(isset($cantPuntos)) {  $x2  = $cantPuntos;   }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2); 
				$Form_Imputs->form_select_n_auto('Cantidad de Puntos','cantPuntos', $x2, 2, 1, 50);
					
					
				$Form_Imputs->form_input_hidden('idMaquina', $_GET['id'], 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit"> 
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?>
                    
		</div>
	</div>
</div> 

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
// Se traen todos los datos de mi usuario
$query = "SELECT  Nombre,  idConfig_1,  idConfig_2, idConfig_3
FROM `maquinas_listado`
WHERE idMaquina = {$_GET['id']}";
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

// Se trae un listado de la matriz
$arrMatriz = array();
$query = "SELECT 
maquinas_listado_matriz.idMatriz, 
maquinas_listado_matriz.Nombre, 
maquinas_listado_matriz.cantPuntos,
core_estados.Nombre AS Estado,
maquinas_listado_matriz.idEstado

FROM `maquinas_listado_matriz`
LEFT JOIN `core_estados` ON core_estados.idEstado = maquinas_listado_matriz.idEstado
WHERE maquinas_listado_matriz.idMaquina = {$_GET['id']}
ORDER BY maquinas_listado_matriz.Nombre ASC";
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
array_push( $arrMatriz,$row );
}


?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text"><?php echo $x_column_maquina_plur; ?></span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Matriz Analisis</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Matriz</a><?php }?>
	</div>
</div>
<div class="clearfix"></div>   

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'maquinas_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'maquinas_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'maquinas_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if(isset($rowdata['idConfig_3'])&&$rowdata['idConfig_3']==1){ ?>
							<li class=""><a href="<?php echo 'maquinas_listado_datos_clientes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Clientes</a></li>
							<li class=""><a href="<?php echo 'maquinas_listado_ubicacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><?php echo $x_column_ubicacion; ?></a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_ficha.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Ficha Tecnica</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_hds.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >HDS</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'maquinas_listado_datos_descripcion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Descripcion</a></li>
						<?php if(isset($rowdata['idConfig_1'])&&$rowdata['idConfig_1']==1){ ?>
							<li class=""><a href="<?php echo 'maquinas_listado_componentes.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Componentes</a></li>
						<?php } ?>
						<?php if(isset($rowdata['idConfig_2'])&&$rowdata['idConfig_2']==1){ ?>
							<li class="active"><a href="<?php echo 'maquinas_listado_matriz_analisis.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Matriz Analisis</a></li>
						<?php } ?>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th width="120">Estado</th>
						<th width="10">N° Puntos</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrMatriz as $maq) { ?>
					<tr class="odd">			
						<td><?php echo $maq['Nombre']; ?></td>
						<td><label class="label <?php if(isset($maq['idEstado'])&&$maq['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $maq['Estado']; ?></label></td>
						<td><?php echo $maq['cantPuntos']; ?></td>		
						<td>
							<div class="btn-group" style="width: 140px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&idMatriz_2='.$maq['idMatriz']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&nombre_matriz='.$maq['Nombre'].'&clone_idMatriz='.$maq['idMatriz']; ?>" title="Clonar Matriz" class="btn btn-primary btn-sm tooltip"><i class="fa fa-files-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&idMatriz='.$maq['idMatriz']; ?>" title="Editar Matriz" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.$maq['idMatriz'];
									$dialogo   = '¿Realmente deseas eliminar la matriz '.$maq['Nombre'].'?';?>
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
