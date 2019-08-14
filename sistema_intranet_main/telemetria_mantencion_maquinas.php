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
$original = "telemetria_mantencion_maquinas.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){             $location .= "&Nombre=".$_GET['Nombre'];            $search .= "&Nombre=".$_GET['Nombre'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_matriz']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_mantencion_matriz.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit_mat']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_mantencion_matriz.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location.='&idMatriz='.$_GET['idMatriz'];
	//Llamamos al formulario
	$form_trabajo= 'update_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_mantencion_matriz.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_mantencion_matriz.php';	
}
//se clona la maquina
if ( !empty($_POST['clone_Matriz']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clone_Matriz';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_mantencion_matriz.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Matriz creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Matriz editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Matriz borrado correctamente';}
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
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
$cadena .= ',SensoresTipo_'.$_GET['mod'].' AS Sensor';
$cadena .= ',SensoresValor_'.$_GET['mod'].' AS Valor';
$cadena .= ',SensoresNumero_'.$_GET['mod'].' AS SensoresNumero';

// tomo los datos del usuario
$query = "SELECT ".$cadena."
FROM `telemetria_mantencion_matriz`
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
				$Form_Imputs->form_input_text( 'Nombre', 'PuntoNombre', $rowdata['Nombre'], 2);
				$Form_Imputs->form_select('Tipo de Sensor','SensoresTipo', $rowdata['Sensor'], 2, 'idSensores', 'Nombre', 'telemetria_listado_sensores', 0, '', $dbConn);	
				$Form_Imputs->form_input_number('Valor a Alcanzar','SensoresValor', Cantidades_decimales_justos($rowdata['Valor']), 2);
				$Form_Imputs->form_select_n_auto('N° Sensor Revisado','SensoresNumero', $rowdata['SensoresNumero'], 2, 1, 50);
				
				$Form_Imputs->form_input_hidden('idMatriz', $_GET['idMatriz'], 2);
				$Form_Imputs->form_input_hidden('mod', $_GET['mod'], 2);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $location.'&idMatriz='.$_GET['idMatriz']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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

SensoresTipo_1,SensoresTipo_2,SensoresTipo_3,SensoresTipo_4,SensoresTipo_5,
SensoresTipo_6,SensoresTipo_7,SensoresTipo_8,SensoresTipo_9,SensoresTipo_10,
SensoresTipo_11,SensoresTipo_12,SensoresTipo_13,SensoresTipo_14,SensoresTipo_15,
SensoresTipo_16,SensoresTipo_17,SensoresTipo_18,SensoresTipo_19,SensoresTipo_20,
SensoresTipo_21,SensoresTipo_22,SensoresTipo_23,SensoresTipo_24,SensoresTipo_25,
SensoresTipo_26,SensoresTipo_27,SensoresTipo_28,SensoresTipo_29,SensoresTipo_30,
SensoresTipo_31,SensoresTipo_32,SensoresTipo_33,SensoresTipo_34,SensoresTipo_35,
SensoresTipo_36,SensoresTipo_37,SensoresTipo_38,SensoresTipo_39,SensoresTipo_40,
SensoresTipo_41,SensoresTipo_42,SensoresTipo_43,SensoresTipo_44,SensoresTipo_45,
SensoresTipo_46,SensoresTipo_47,SensoresTipo_48,SensoresTipo_49,SensoresTipo_50,

SensoresValor_1,SensoresValor_2,SensoresValor_3,SensoresValor_4,SensoresValor_5,
SensoresValor_6,SensoresValor_7,SensoresValor_8,SensoresValor_9,SensoresValor_10,
SensoresValor_11,SensoresValor_12,SensoresValor_13,SensoresValor_14,SensoresValor_15,
SensoresValor_16,SensoresValor_17,SensoresValor_18,SensoresValor_19,SensoresValor_20,
SensoresValor_21,SensoresValor_22,SensoresValor_23,SensoresValor_24,SensoresValor_25,
SensoresValor_26,SensoresValor_27,SensoresValor_28,SensoresValor_29,SensoresValor_30,
SensoresValor_31,SensoresValor_32,SensoresValor_33,SensoresValor_34,SensoresValor_35,
SensoresValor_36,SensoresValor_37,SensoresValor_38,SensoresValor_39,SensoresValor_40,
SensoresValor_41,SensoresValor_42,SensoresValor_43,SensoresValor_44,SensoresValor_45,
SensoresValor_46,SensoresValor_47,SensoresValor_48,SensoresValor_49,SensoresValor_50,

SensoresNumero_1,SensoresNumero_2,SensoresNumero_3,SensoresNumero_4,SensoresNumero_5,
SensoresNumero_6,SensoresNumero_7,SensoresNumero_8,SensoresNumero_9,SensoresNumero_10,
SensoresNumero_11,SensoresNumero_12,SensoresNumero_13,SensoresNumero_14,SensoresNumero_15,
SensoresNumero_16,SensoresNumero_17,SensoresNumero_18,SensoresNumero_19,SensoresNumero_20,
SensoresNumero_21,SensoresNumero_22,SensoresNumero_23,SensoresNumero_24,SensoresNumero_25,
SensoresNumero_26,SensoresNumero_27,SensoresNumero_28,SensoresNumero_29,SensoresNumero_30,
SensoresNumero_31,SensoresNumero_32,SensoresNumero_33,SensoresNumero_34,SensoresNumero_35,
SensoresNumero_36,SensoresNumero_37,SensoresNumero_38,SensoresNumero_39,SensoresNumero_40,
SensoresNumero_41,SensoresNumero_42,SensoresNumero_43,SensoresNumero_44,SensoresNumero_45,
SensoresNumero_46,SensoresNumero_47,SensoresNumero_48,SensoresNumero_49,SensoresNumero_50

FROM `telemetria_mantencion_matriz`
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

//Se traen todos los tipos
$arrTipos = array();
$query = "SELECT 
telemetria_listado_sensores.idSensores,
telemetria_listado_sensores.Nombre,
core_sensores_funciones.Nombre AS SensorFuncion

FROM `telemetria_listado_sensores`
LEFT JOIN `core_sensores_funciones` ON core_sensores_funciones.idSensorFuncion = telemetria_listado_sensores.idSensorFuncion
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
array_push( $arrTipos,$row );
}

				
?>



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Puntos de <?php echo $rowdata['Nombre']; ?></h5>		
		</header>
		
		
        <div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Tipo Sensor</th>
						<th>Funcion</th>
						<th width="120">N° Sensor Revisado</th>
						<th width="120">Valor a Alcanzar</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php for ($i = 1; $i <= $rowdata['cantPuntos']; $i++) { ?>
					<tr class="odd">		
						<td><?php echo $rowdata['PuntoNombre_'.$i]; ?></td>
						<td><?php foreach ($arrTipos as $tipo) { if($rowdata['SensoresTipo_'.$i]==$tipo['idSensores']){ echo $tipo['Nombre'];}} ?></td>	
						<td><?php foreach ($arrTipos as $tipo) { if($rowdata['SensoresTipo_'.$i]==$tipo['idSensores']){ echo $tipo['SensorFuncion'];}} ?></td>	
						<td><?php echo $rowdata['SensoresNumero_'.$i]; ?></td>			
						<td><?php echo $rowdata['SensoresValor_'.$i]; ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&idMatriz='.$_GET['idMatriz'].'&mod='.$i; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
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
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['idMatriz_2']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, cantPuntos, idSistema
FROM `telemetria_mantencion_matriz`
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
			<h5>Modificacion Matriz</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {      $x1  = $Nombre;       }else{$x1  = $rowdata['Nombre'];}
				if(isset($cantPuntos)) {  $x2  = $cantPuntos;   }else{$x2  = $rowdata['cantPuntos'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2); 
				$Form_Imputs->form_select_n_auto('N° Puntos Revision','cantPuntos', $x2, 2, 1, 50);
					
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);	
				$Form_Imputs->form_input_hidden('idMatriz', $_GET['idMatriz_2'], 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit_mat"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
			<h5>Crear Matriz</h5>
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
				$Form_Imputs->form_select_n_auto('N° Puntos Revision','cantPuntos', $x2, 2, 1, 50);
				
					
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);	
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar" name="submit_matriz"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?>
                    
		</div>
	</div>
</div> 

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':   $order_by = 'ORDER BY telemetria_mantencion_matriz.Nombre ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':  $order_by = 'ORDER BY telemetria_mantencion_matriz.Nombre DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'puntos_asc':   $order_by = 'ORDER BY telemetria_mantencion_matriz.cantPuntos ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Puntos Ascendente'; break;
		case 'puntos_desc':  $order_by = 'ORDER BY telemetria_mantencion_matriz.cantPuntos DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Puntos Descendente';break;
		case 'estado_asc':   $order_by = 'ORDER BY core_estados.Nombre ASC ';                        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':  $order_by = 'ORDER BY core_estados.Nombre DESC ';                       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'ORDER BY telemetria_mantencion_matriz.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY telemetria_mantencion_matriz.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_mantencion_matriz.idMatriz!=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND telemetria_mantencion_matriz.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){        $z .= " AND telemetria_mantencion_matriz.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){    $z .= " AND telemetria_mantencion_matriz.idEstado=".$_GET['idEstado'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idMatriz FROM `telemetria_mantencion_matriz` ".$z;
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
// Se trae un listado de la matriz
$arrMatriz = array();
$query = "SELECT 
telemetria_mantencion_matriz.idMatriz, 
telemetria_mantencion_matriz.Nombre, 
telemetria_mantencion_matriz.cantPuntos,
core_estados.Nombre AS Estado,
telemetria_mantencion_matriz.idEstado

FROM `telemetria_mantencion_matriz`
LEFT JOIN `core_estados` ON core_estados.idEstado = telemetria_mantencion_matriz.idEstado
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
array_push( $arrMatriz,$row );
}


?>


<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location.'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Matriz</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {    $x1  = $Nombre;     }else{$x1  = '';}
				if(isset($idEstado)) {  $x2  = $idEstado;   }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				$Form_Imputs->form_select('Estado','idEstado', $x2, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 

 

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Matrices</h5>
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
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">N° Puntos</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=puntos_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=puntos_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrMatriz as $maq) { ?>
					<tr class="odd">			
						<td><?php echo $maq['Nombre']; ?></td>
						<td><?php echo $maq['cantPuntos']; ?></td>	
						<td><label class="label <?php if(isset($maq['idEstado'])&&$maq['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $maq['Estado']; ?></label></td>		
						<td>
							<div class="btn-group" style="width: 140px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&idMatriz_2='.$maq['idMatriz']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&nombre_matriz='.$maq['Nombre'].'&clone_idMatriz='.$maq['idMatriz']; ?>" title="Clonar Matriz" class="btn btn-primary btn-sm tooltip"><i class="fa fa-files-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&idMatriz='.$maq['idMatriz']; ?>" title="Editar Matriz" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$maq['idMatriz'];
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
		<div class="pagrow">	
			<?php 
			//se llama al paginador
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
