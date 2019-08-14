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
$original = "informe_vendedores_02.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search ='&submit_filter=Filtrar';
if(isset($_GET['idProspecto']) && $_GET['idProspecto'] != ''){        $location .= "&idProspecto=".$_GET['idProspecto'];        $search .= "&idProspecto=".$_GET['idProspecto'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];  $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 

             
  

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
		case 'ndoc_asc':          $order_by = 'ORDER BY cotizacion_prospectos_listado.idCotizacion ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Doc Ascendente';break;
		case 'ndoc_desc':         $order_by = 'ORDER BY cotizacion_prospectos_listado.idCotizacion DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc Descendente';break;
		case 'Prospecto_asc':     $order_by = 'ORDER BY prospectos_listado.Nombre ASC ';                      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Prospecto Ascendente';break;
		case 'Prospecto_desc':    $order_by = 'ORDER BY prospectos_listado.Nombre DESC ';                     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Prospecto Descendente';break;
		case 'vendedor_asc':      $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Vendedor Ascendente';break;
		case 'vendedor_desc':     $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';                       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Vendedor Descendente';break;
		case 'fecha_asc':         $order_by = 'ORDER BY cotizacion_prospectos_listado.Creacion_fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':        $order_by = 'ORDER BY cotizacion_prospectos_listado.Creacion_fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		
		default: $order_by = 'ORDER BY cotizacion_prospectos_listado.idCotizacion DESC, cotizacion_prospectos_listado.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc, Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY cotizacion_prospectos_listado.idCotizacion DESC, cotizacion_prospectos_listado.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc, Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE cotizacion_prospectos_listado.idCotizacion>0";
//verifico que sea un administrador
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND cotizacion_prospectos_listado.idSistema>=0";	
}else{
	$z.=" AND cotizacion_prospectos_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND cotizacion_prospectos_listado.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";	
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idProspecto']) && $_GET['idProspecto'] != ''){        $z .= " AND cotizacion_prospectos_listado.idProspecto=".$_GET['idProspecto'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $z .= " AND cotizacion_prospectos_listado.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){            $z .= " AND cotizacion_prospectos_listado.idUsuario='".$_GET['idUsuario']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idCotizacion FROM `cotizacion_prospectos_listado` ".$z;
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

//consulta
$arrCotizaciones = array();
$query = "SELECT 
cotizacion_prospectos_listado.idCotizacion,
cotizacion_prospectos_listado.Creacion_fecha,
prospectos_listado.Nombre AS Prospecto,
usuarios_listado.Nombre AS Vendedor

FROM `cotizacion_prospectos_listado`
LEFT JOIN `prospectos_listado`   ON prospectos_listado.idProspecto   = cotizacion_prospectos_listado.idProspecto 
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario       = cotizacion_prospectos_listado.idUsuario 

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
array_push( $arrCotizaciones,$row );
}


?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>	
	</ul>

</div>
<div class="clearfix"></div> 
                     
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Cotizaciones</h5>
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
						<th width="120">
							<div class="pull-left">N° Doc</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=ndoc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=ndoc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Prospecto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=Prospecto_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=Prospecto_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Vendedor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=vendedor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=vendedor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				



			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrCotizaciones as $sol) { ?>
						<tr class="odd">
							<td><?php echo 'Cotizacion N°'.n_doc($sol['idCotizacion'], 5); ?></td>
							<td><?php echo $sol['Prospecto']; ?></td>
							<td><?php echo $sol['Vendedor']; ?></td>
							<td><?php echo Fecha_estandar($sol['Creacion_fecha']); ?></td>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_cotizacion.php?view='.$sol['idCotizacion']; ?>" title="Ver Cotizacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
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
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w="idSistema>=0";
	$usrfil = 'usuarios_sistemas.idSistema>=0  AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario=5';	
}else{
	$w="idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario=5';	
}
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
				if(isset($idProspecto)) {        $x1  = $idProspecto;      }else{$x1  = '';}
				if(isset($Creacion_fecha)) {   $x2  = $Creacion_fecha; }else{$x2  = '';}
				if(isset($idUsuario)) {        $x3  = $idUsuario;      }else{$x3  = '';}

				//se dibujan los inputs	
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Prospecto','idProspecto', $x1, 1, 'idProspecto', 'Nombre', 'prospectos_listado', $w, '', $dbConn);
				$Form_Imputs->form_date('Fecha de Cotizacion','Creacion_fecha', $x2, 1);
				$Form_Imputs->form_select_join_filter('Vendedor','idUsuario', $x3, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);

				$Form_Imputs->form_input_hidden('pagina', 1, 2);

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
