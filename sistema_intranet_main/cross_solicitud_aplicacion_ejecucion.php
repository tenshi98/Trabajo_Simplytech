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
$original = "cross_solicitud_aplicacion_ejecucion.php";
$location = $original;
//Se agregan ubicaciones
$search ='&submit_filter=Filtrar';
$location .= "?submit_filter=Filtrar";
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $location .= "&idSolicitud=".$_GET['idSolicitud'];        $search .= "&idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPrioridad']) && $_GET['idPrioridad'] != ''){        $location .= "&idPrioridad=".$_GET['idPrioridad'];        $search .= "&idPrioridad=".$_GET['idPrioridad'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $location .= "&idPredio=".$_GET['idPredio'];              $search .= "&idPredio=".$_GET['idPredio'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $location .= "&idTemporada=".$_GET['idTemporada'];        $search .= "&idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $location .= "&idEstadoFen=".$_GET['idEstadoFen'];        $search .= "&idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $location .= "&idCategoria=".$_GET['idCategoria'];        $search .= "&idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $location .= "&idProducto=".$_GET['idProducto'];          $search .= "&idProducto=".$_GET['idProducto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $location .= "&idUsuario=".$_GET['idUsuario'];            $search .= "&idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['f_programacion_desde'])&&$_GET['f_programacion_desde']!=''&&isset($_GET['f_programacion_hasta'])&&$_GET['f_programacion_hasta']!=''){
	$search .="&f_programacion_desde={$_GET['f_programacion_desde']}";
	$search .="&f_programacion_hasta={$_GET['f_programacion_hasta']}";
}
if(isset($_GET['f_ejecucion_desde'])&&$_GET['f_ejecucion_desde']!=''&&isset($_GET['f_ejecucion_hasta'])&&$_GET['f_ejecucion_hasta']!=''){
	$search .="&f_ejecucion_desde={$_GET['f_ejecucion_desde']}";
	$search .="&f_ejecucion_hasta={$_GET['f_ejecucion_hasta']}";
}		     
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//se modifican los datos basicos
if ( !empty($_POST['submit_modBase']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'updt_mod_base';
	require_once 'A1XRXS_sys/xrxs_form/z_cross_solicitud_aplicacion.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['not_modbase']))  {$error['not_modbase'] 	  	  = 'sucess/Cambio de estado cambiado correctamente';}

//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['cancel_ejecution']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Cancelar la Solicitud de Aplicacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {  $x1  = $Observacion;    }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_textarea('Observacion','Observacion', $x1, 2, 160);		
				
				
				$Form_Imputs->form_input_hidden('f_ejecucion', '0000-00-00', 2);
				$Form_Imputs->form_input_hidden('horaEjecucion', '00:00:00', 2);
				$Form_Imputs->form_input_hidden('f_ejecucion_fin', '0000-00-00', 2);
				$Form_Imputs->form_input_hidden('horaEjecucion_fin', '00:00:00', 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('idEstadoActual', 2, 2);
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['cancel_ejecution'], 2);
				$Form_Imputs->form_input_hidden('Creacion_fecha', fecha_actual(), 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['termino']) ) {
// Se traen todos los datos de mi usuario
$query = "SELECT f_termino,horaTermino, f_termino_fin, horaTermino_fin
FROM `cross_solicitud_aplicacion_listado`
WHERE idSolicitud = {$_GET['termino']} ";
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
$row_data = mysqli_fetch_assoc ($resultado);

?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Ejecutar la Solicitud de Aplicacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($f_termino)) {        $x1  = $f_termino;        }else{$x1  = $row_data['f_termino'];}
				if(isset($horaTermino)) {      $x2  = $horaTermino;      }else{$x2  = $row_data['horaTermino'];}
				if(isset($f_termino_fin)) {    $x3  = $f_termino_fin;    }else{$x3  = $row_data['f_termino_fin'];}
				if(isset($horaTermino_fin)) {  $x4  = $horaTermino_fin;  }else{$x4  = $row_data['horaTermino_fin'];}
				if(isset($Observacion)) {      $x5  = $Observacion;      }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha inicio cierre','f_termino', $x1, 2);
				$Form_Imputs->form_time('Hora inicio cierre','horaTermino', $x2, 2, 2);
				$Form_Imputs->form_date('Fecha termino  cierre','f_termino_fin', $x3, 2);
				$Form_Imputs->form_time('Hora termino  cierre','horaTermino_fin', $x4, 2, 2);
				$Form_Imputs->form_textarea('Observacion','Observacion', $x5, 1, 160);		
				
				
				$Form_Imputs->form_input_hidden('idEstado', 3, 2);
				$Form_Imputs->form_input_hidden('idSolicitud', $_GET['termino'], 2);
				$Form_Imputs->form_input_hidden('Creacion_fecha', fecha_actual(), 2);
				$Form_Imputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_modBase"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>         
		</div>
	</div>
</div>	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['submit_filter']) ) { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
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
		case 'id_asc':           $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud ASC ';                         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> ID Ascendente'; break;
		case 'id_desc':          $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC ';                        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> ID Descendente';break;
		case 'fprog_asc':        $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.f_programacion ASC ';                      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Programacion Ascendente';break;
		case 'fprog_desc':       $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.f_programacion DESC ';                     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Programacion Descendente';break;
		case 'predio_asc':       $order_by = 'ORDER BY cross_predios_listado.Nombre ASC ';                                           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Predio Ascendente'; break;
		case 'predio_desc':      $order_by = 'ORDER BY cross_predios_listado.Nombre DESC ';                                          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Predio Descendente';break;
		case 'prioridad_asc':    $order_by = 'ORDER BY core_cross_prioridad.Nombre ASC ';                                            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Prioridad Ascendente'; break;
		case 'prioridad_desc':   $order_by = 'ORDER BY core_cross_prioridad.Nombre DESC ';                                           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Prioridad Descendente';break;
		case 'feje_asc':         $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.f_ejecucion ASC ';                         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ejecucion Ascendente'; break;
		case 'feje_desc':        $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.f_ejecucion DESC ';                        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Ejecucion Descendente';break;
		case 'especie_asc':      $order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC, variedades_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Especie/Variedad Ascendente'; break;
		case 'especie_desc':     $order_by = 'ORDER BY sistema_variedades_categorias.Nombre DESC, variedades_listado.Nombre DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Especie/Variedad Descendente';break;
		
		default: $order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Solicitud Descendente';
	}
}else{
	$order_by = 'ORDER BY cross_solicitud_aplicacion_listado.idSolicitud DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Solicitud Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE cross_solicitud_aplicacion_listado.idSolicitud!=0";
$z .= " AND cross_solicitud_aplicacion_listado.idEstado = 2"; //Solo en ejecucion
//Verifico el tipo de usuario que esta ingresando
$z.= " AND cross_solicitud_aplicacion_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idSolicitud']) && $_GET['idSolicitud'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idSolicitud=".$_GET['idSolicitud'];}
if(isset($_GET['idPrioridad']) && $_GET['idPrioridad'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idPrioridad=".$_GET['idPrioridad'];}
if(isset($_GET['idPredio']) && $_GET['idPredio'] != ''){              $z .= " AND cross_solicitud_aplicacion_listado.idPredio=".$_GET['idPredio'];}
if(isset($_GET['idTemporada']) && $_GET['idTemporada'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idTemporada=".$_GET['idTemporada'];}
if(isset($_GET['idEstadoFen']) && $_GET['idEstadoFen'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idEstadoFen=".$_GET['idEstadoFen'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $z .= " AND cross_solicitud_aplicacion_listado.idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['idProducto']) && $_GET['idProducto'] != ''){          $z .= " AND cross_solicitud_aplicacion_listado.idProducto=".$_GET['idProducto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND cross_solicitud_aplicacion_listado.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['f_programacion_desde'])&&$_GET['f_programacion_desde']!=''&&isset($_GET['f_programacion_hasta'])&&$_GET['f_programacion_hasta']!=''){
	$z.=" AND bodegas_arriendos_facturacion.f_programacion BETWEEN '{$_GET['f_programacion_desde']}' AND '{$_GET['f_programacion_hasta']}'";
}
if(isset($_GET['f_ejecucion_desde'])&&$_GET['f_ejecucion_desde']!=''&&isset($_GET['f_ejecucion_hasta'])&&$_GET['f_ejecucion_hasta']!=''){
	$z.=" AND bodegas_arriendos_facturacion.f_ejecucion BETWEEN '{$_GET['f_ejecucion_desde']}' AND '{$_GET['f_ejecucion_hasta']}'";
}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idSolicitud FROM `cross_solicitud_aplicacion_listado` 
LEFT JOIN `cross_predios_listado`           ON cross_predios_listado.idPredio             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `core_cross_prioridad`            ON core_cross_prioridad.idPrioridad           = cross_solicitud_aplicacion_listado.idPrioridad
LEFT JOIN `sistema_variedades_categorias`   ON sistema_variedades_categorias.idCategoria  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`              ON variedades_listado.idProducto              = cross_solicitud_aplicacion_listado.idProducto
".$z;
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
// Se trae un listado con todos los usuarios
$arrOTS = array();
$query = "SELECT 
cross_solicitud_aplicacion_listado.idSolicitud,
cross_solicitud_aplicacion_listado.f_programacion,
cross_solicitud_aplicacion_listado.f_ejecucion,
cross_predios_listado.Nombre AS NombrePredio,
core_cross_prioridad.Nombre AS Prioridad,
sistema_variedades_categorias.Nombre AS Especie,
variedades_listado.Nombre AS Variedad

FROM `cross_solicitud_aplicacion_listado`
LEFT JOIN `cross_predios_listado`           ON cross_predios_listado.idPredio             = cross_solicitud_aplicacion_listado.idPredio
LEFT JOIN `core_cross_prioridad`            ON core_cross_prioridad.idPrioridad           = cross_solicitud_aplicacion_listado.idPrioridad
LEFT JOIN `sistema_variedades_categorias`   ON sistema_variedades_categorias.idCategoria  = cross_solicitud_aplicacion_listado.idCategoria
LEFT JOIN `variedades_listado`              ON variedades_listado.idProducto              = cross_solicitud_aplicacion_listado.idProducto
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
array_push( $arrOTS,$row );
}
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>	
	</ul>
	
</div>
<div class="clearfix"></div> 


<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Solicitudes de Aplicacion</h5>
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
						<th width="100">
							<div class="pull-left">#</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=id_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=id_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Prioridad</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=prioridad_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=prioridad_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="140">
							<div class="pull-left">F Solicitud</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fprog_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fprog_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="140">
							<div class="pull-left">F Prog</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=feje_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=feje_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Predio</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=predio_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=predio_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Especie/Variedad</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=especie_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=especie_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>Dias Faltantes</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrOTS as $ot) { 
						//variable
						$dias        = 0;
						$dias_text   = 'Sin Fecha ejecucion';
						$n_dias      = 5;
						$td_style    = '';
						
						//Verifico que no exista fecha de entrega
						if(isset($ot['f_ejecucion'])&&$ot['f_ejecucion']!='0000-00-00'){
							$dias = dias_transcurridos($ot['f_ejecucion'],fecha_actual());
							if($ot['f_ejecucion']>fecha_actual()&&$dias>$n_dias){
								$dias_text = 'Quedan '.$dias.' dias';
							}elseif($ot['f_ejecucion']>fecha_actual()&&$dias<=$n_dias){
								$dias_text = 'Quedan '.$dias.' dias';
								$td_style = 'warning';
							}elseif($ot['f_ejecucion']==fecha_actual()){
								$dias_text = 'Quedan '.$dias.' dias';
								$td_style = 'warning';
							}elseif($ot['f_ejecucion']<fecha_actual()){
								$dias_text = 'Atraso de '.$dias.' dias';
								$td_style = 'danger';
							}
						} ?>
						<tr class="odd <?php echo $td_style; ?>">		
							<td><?php echo n_doc($ot['idSolicitud'], 5); ?></td>	
							<td><?php echo $ot['Prioridad']; ?></td>	
							<td><?php echo Fecha_estandar($ot['f_programacion']); ?></td>	
							<td><?php echo Fecha_estandar($ot['f_ejecucion']); ?></td>	
							<td><?php echo $ot['NombrePredio']; ?></td>
							<td><?php echo $ot['Especie'].' '.$ot['Variedad']; ?></td>
							<td><?php echo $dias_text; ?></td>
							<td>
								<div class="btn-group" style="width: 140px;" >
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_solicitud_aplicacion.php?view='.$ot['idSolicitud']; ?>" title="Ver Solicitud" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&cancel_ejecution='.$ot['idSolicitud']; ?>" title="Cancelar Programacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-arrow-left"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a target="_blank" rel="noopener noreferrer" href="<?php echo 'cross_solicitud_aplicacion_editar.php?view='.$ot['idSolicitud']; ?>" title="Editar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&termino='.$ot['idSolicitud']; ?>" title="Ejecutar Solicitud" class="btn btn-success btn-sm tooltip"><i class="fa fa-check-square-o"></i></a><?php } ?>
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
<?php require_once '../LIBS_js/modal/modal.php';?>
  
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
$y = "idEstado=1";
$x = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";	
 
 ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idSolicitud)) {            $x1  = $idSolicitud;            }else{$x1  = '';}
				if(isset($idPrioridad)) {            $x2  = $idPrioridad;            }else{$x2  = '';}
				if(isset($idPredio)) {               $x3  = $idPredio;               }else{$x3  = '';}
				if(isset($idTemporada)) {            $x4  = $idTemporada;            }else{$x4  = '';}
				if(isset($idEstadoFen)) {            $x5  = $idEstadoFen;            }else{$x5  = '';}
				if(isset($idCategoria)) {            $x6  = $idCategoria;            }else{$x6  = '';}
				if(isset($idProducto)) {             $x7  = $idProducto;             }else{$x7  = '';}
				if(isset($f_programacion_desde)) {   $x8  = $f_programacion_desde;   }else{$x8  = '';}
				if(isset($f_programacion_hasta)) {   $x9  = $f_programacion_hasta;   }else{$x9  = '';}
				if(isset($f_ejecucion_desde)) {      $x10 = $f_ejecucion_desde;      }else{$x10 = '';}
				if(isset($f_ejecucion_hasta)) {      $x11 = $f_ejecucion_hasta;      }else{$x11 = '';}
				if(isset($idUsuario)) {              $x12 = $idUsuario;              }else{$x12 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_number('N° Solicitud','idSolicitud', $x1, 1);
				$Form_Imputs->form_select('Prioridad','idPrioridad', $x2, 1, 'idPrioridad', 'Nombre', 'core_cross_prioridad', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Predio','idPredio', $x3, 1, 'idPredio', 'Nombre', 'cross_predios_listado', $x, '', $dbConn);
				$Form_Imputs->form_select_filter('Temporada','idTemporada', $x4, 1, 'idTemporada', 'Codigo,Nombre', 'cross_checking_temporada', $y, '', $dbConn);
				$Form_Imputs->form_select_filter('Estado Fenológico','idEstadoFen', $x5, 1, 'idEstadoFen', 'Codigo,Nombre', 'cross_checking_estado_fenologico', $y, '', $dbConn);
				$Form_Imputs->form_select_depend1('Especie','idCategoria', $x6, 1, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, 0,
										 'Variedad','idProducto', $x7, 1, 'idProducto', 'Nombre', 'variedades_listado', 'idEstado=1', 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_date('Fecha Requerido Desde','f_programacion_desde', $x8, 1);
				$Form_Imputs->form_date('Fecha Requerido Hasta','f_programacion_hasta', $x9, 1);
				$Form_Imputs->form_date('Fecha Programada Desde','f_ejecucion_desde', $x10, 1);
				$Form_Imputs->form_date('Fecha Programada Hasta','f_ejecucion_hasta', $x11, 1);
				$Form_Imputs->form_select_join_filter('Agrónomo','idUsuario', $x12, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
						
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
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
