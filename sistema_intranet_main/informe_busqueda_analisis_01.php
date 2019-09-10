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
$original = "informe_busqueda_analisis_01.php";
$location = $original;
//Se agregan ubicaciones
$search ='&submit_filter=Filtrar';
if(isset($_GET['n_muestra'])&&$_GET['n_muestra']!=''){     $search .="&n_muestra={$_GET['n_muestra']}";}
if(isset($_GET['idMaquina'])&&$_GET['idMaquina']!=''){     $search .="&idMaquina={$_GET['idMaquina']}";}
if(isset($_GET['idMatriz'])&&$_GET['idMatriz']!=''){       $search .="&idMatriz={$_GET['idMatriz']}";}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){       $search .="&idEstado={$_GET['idEstado']}";}
if(isset($_GET['f_muestreo_ini'])&&$_GET['f_muestreo_ini']!=''&&isset($_GET['f_muestreo_fin'])&&$_GET['f_muestreo_fin']!=''){
	$search .="&f_muestreo_ini={$_GET['f_muestreo_ini']}";
	$search .="&f_muestreo_fin={$_GET['f_muestreo_fin']}";
}
if(isset($_GET['f_recibida_ini'])&&$_GET['f_recibida_ini']!=''&&isset($_GET['f_recibida_fin'])&&$_GET['f_recibida_fin']!=''){
	$search .="&f_recibida_ini={$_GET['f_recibida_ini']}";
	$search .="&f_recibida_fin={$_GET['f_recibida_fin']}";
}
if(isset($_GET['f_reporte_ini'])&&$_GET['f_reporte_ini']!=''&&isset($_GET['f_reporte_fin'])&&$_GET['f_reporte_fin']!=''){
	$search .="&f_reporte_ini={$_GET['f_reporte_ini']}";
	$search .="&f_reporte_fin={$_GET['f_reporte_fin']}";
}

//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
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
		case 'maquina_asc':     $order_by = 'ORDER BY maquinas_listado.Nombre ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> '.$x_column_maquina_sing.' Ascendente'; break;
		case 'maquina_desc':    $order_by = 'ORDER BY maquinas_listado.Nombre DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> '.$x_column_maquina_sing.' Descendente';break;
		case 'analisis_asc':    $order_by = 'ORDER BY maquinas_listado_matriz.Nombre ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Analisis Ascendente';break;
		case 'analisis_desc':   $order_by = 'ORDER BY maquinas_listado_matriz.Nombre DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Analisis Descendente';break;
		case 'estado_asc':      $order_by = 'ORDER BY core_analisis_estado.Nombre ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':     $order_by = 'ORDER BY core_analisis_estado.Nombre DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'fmuestro_asc':    $order_by = 'ORDER BY analisis_listado.f_muestreo ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha muestreo Ascendente';break;
		case 'fmuestro_desc':   $order_by = 'ORDER BY analisis_listado.f_muestreo DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha muestreo Descendente';break;
		case 'frecibida_asc':   $order_by = 'ORDER BY analisis_listado.f_recibida ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha recibida Ascendente';break;
		case 'frecibida_desc':  $order_by = 'ORDER BY analisis_listado.f_recibida DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha recibida Descendente';break;
		case 'freporte_asc':    $order_by = 'ORDER BY analisis_listado.f_reporte ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha reporte Ascendente';break;
		case 'freporte_desc':   $order_by = 'ORDER BY analisis_listado.f_reporte DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha reporte Descendente';break;
		
		default: $order_by = 'ORDER BY analisis_listado.idAnalisis ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Analisis Ascendente';
	}
}else{
	$order_by = 'ORDER BY analisis_listado.idAnalisis ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Analisis Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z="WHERE analisis_listado.idAnalisis!=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND analisis_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

if(isset($_GET['n_muestra'])&&$_GET['n_muestra']!=''){   $z.=" AND analisis_listado.n_muestra={$_GET['n_muestra']}";}
if(isset($_GET['idMaquina'])&&$_GET['idMaquina']!=''){   $z.=" AND analisis_listado.idMaquina={$_GET['idMaquina']}";}
if(isset($_GET['idMatriz'])&&$_GET['idMatriz']!=''){     $z.=" AND analisis_listado.idMatriz={$_GET['idMatriz']}";}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){     $z.=" AND analisis_listado.idEstado={$_GET['idEstado']}";}

if(isset($_GET['f_muestreo_ini'])&&$_GET['f_muestreo_ini']!=''&&isset($_GET['f_muestreo_fin'])&&$_GET['f_muestreo_fin']!=''){
	$z.=" AND analisis_listado.Creacion_fecha BETWEEN '{$_GET['f_muestreo_ini']}' AND '{$_GET['f_muestreo_fin']}'";
}
if(isset($_GET['f_recibida_ini'])&&$_GET['f_recibida_ini']!=''&&isset($_GET['f_recibida_fin'])&&$_GET['f_recibida_fin']!=''){
	$z.=" AND analisis_listado.Pago_fecha BETWEEN '{$_GET['f_recibida_ini']}' AND '{$_GET['f_recibida_fin']}'";
}
if(isset($_GET['f_reporte_ini'])&&$_GET['f_reporte_ini']!=''&&isset($_GET['f_reporte_fin'])&&$_GET['f_reporte_fin']!=''){
	$z.=" AND analisis_listado.F_Pago BETWEEN '{$_GET['f_reporte_ini']}' AND '{$_GET['f_reporte_fin']}'";
}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idAnalisis FROM `analisis_listado` ".$z;
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
$arrTipo = array();
$query = "SELECT 
analisis_listado.idAnalisis,
core_sistemas.Nombre AS Sistema,
maquinas_listado.Nombre AS Maquina,
maquinas_listado_matriz.Nombre AS Analisis,
core_analisis_estado.Nombre AS Estado,
analisis_listado.n_muestra,
analisis_listado.f_muestreo,
analisis_listado.f_recibida,
analisis_listado.f_reporte

FROM `analisis_listado`
LEFT JOIN `core_sistemas`            ON core_sistemas.idSistema            = analisis_listado.idSistema
LEFT JOIN `maquinas_listado`         ON maquinas_listado.idMaquina         = analisis_listado.idMaquina
LEFT JOIN `maquinas_listado_matriz`  ON maquinas_listado_matriz.idMatriz   = analisis_listado.idMatriz
LEFT JOIN `core_analisis_estado`     ON core_analisis_estado.idEstado      = analisis_listado.idEstado
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
array_push( $arrTipo,$row );
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Documentos</h5>
			<div class="toolbar">
				<?php echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">   
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="200">
							<div class="pull-left"><?php echo $x_column_maquina_sing; ?></div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=maquina_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=maquina_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="200">
							<div class="pull-left">Analisis</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=analisis_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=analisis_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="200">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="270">
							<div class="pull-left">Fecha Muestreo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=fmuestro_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=fmuestro_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="270">
							<div class="pull-left">Fecha Recibida</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=frecibida_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=frecibida_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="270">
							<div class="pull-left">Fecha Reporte</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=freporte_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=freporte_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Maquina']; ?></td>
							<td><?php echo $tipo['Analisis'].' N°'.$tipo['n_muestra']; ?></td>
							<td><?php echo $tipo['Estado']; ?></td>
							<td><?php echo Fecha_estandar($tipo['f_muestreo']); ?></td>
							<td><?php echo Fecha_estandar($tipo['f_recibida']); ?></td>
							<td><?php echo Fecha_estandar($tipo['f_reporte']); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_analisis.php?view='.$tipo['idAnalisis']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>
<?php widget_modal(80, 95); ?>
  
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
 
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
				if(isset($n_muestra)) {        $x1  = $n_muestra;        }else{$x1  = '';}
				if(isset($idMaquina)) {        $x2  = $idMaquina;        }else{$x2  = '';}
				if(isset($idMatriz)) {         $x3  = $idMatriz;         }else{$x3  = '';}
				if(isset($idEstado)) {         $x4  = $idEstado;         }else{$x4  = '';}
				if(isset($f_muestreo_ini)) {   $x5  = $f_muestreo_ini;   }else{$x5  = '';}
				if(isset($f_muestreo_fin)) {   $x6  = $f_muestreo_fin;   }else{$x6  = '';}
				if(isset($f_recibida_ini)) {   $x7  = $f_recibida_ini;   }else{$x7  = '';}
				if(isset($f_recibida_fin)) {   $x8  = $f_recibida_fin;   }else{$x8  = '';}
				if(isset($f_reporte_ini)) {    $x9  = $f_reporte_ini;    }else{$x9  = '';}
				if(isset($f_reporte_fin)) {    $x10 = $f_reporte_fin;    }else{$x10 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_number('N° Muestra de Pago', 'n_muestra', $x1, 1);
				$Form_Imputs->form_select_depend1($x_column_maquina_sing,'idMaquina', $x2, 1, 'idMaquina', 'Nombre', 'maquinas_listado', $z, 0,
										 'Analisis','idMatriz', $x3, 1, 'idMatriz', 'Nombre', 'maquinas_listado_matriz', 'idEstado=1', 0, 
										  $dbConn, 'form1');
				$Form_Imputs->form_select('Tipo Documento','idEstado', $x4, 1, 'idEstado', 'Nombre', 'core_analisis_estado', 0, '', $dbConn);
				$Form_Imputs->form_date('Fecha Muestreo Desde','f_muestreo_ini', $x5, 1);
				$Form_Imputs->form_date('Fecha Muestreo Hasta','f_muestreo_fin', $x6, 1);
				$Form_Imputs->form_date('Fecha Recibida Desde','f_recibida_ini', $x7, 1);
				$Form_Imputs->form_date('Fecha Recibida Hasta','f_recibida_fin', $x8, 1);
				$Form_Imputs->form_date('Fecha Reporte Desde','f_reporte_ini', $x9, 1);
				$Form_Imputs->form_date('Fecha Reporte Hasta','f_reporte_fin', $x10, 1);
				
				
						
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
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
