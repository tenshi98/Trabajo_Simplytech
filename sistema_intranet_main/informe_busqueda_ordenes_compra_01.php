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
$original = "informe_busqueda_ordenes_compra_01.php";
$location = $original;
//Se agregan ubicaciones
$search ='&submit_filter=Filtrar';
if(isset($_GET['idProveedor'])&&$_GET['idProveedor']!=''){     $search .="&idProveedor={$_GET['idProveedor']}";}
if(isset($_GET['idLicitacion'])&&$_GET['idLicitacion']!=''){   $search .="&idLicitacion={$_GET['idLicitacion']}";}
if(isset($_GET['idOcompra'])&&$_GET['idOcompra']!=''){             $search .="&idOcompra={$_GET['idOcompra']}";}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){           $search .="&idEstado={$_GET['idEstado']}";}
if(isset($_GET['f_creacion_inicio'])&&$_GET['f_creacion_inicio']!=''&&isset($_GET['f_creacion_termino'])&&$_GET['f_creacion_termino']!=''){
	$search .="&f_creacion_inicio={$_GET['f_creacion_inicio']}";
	$search .="&f_creacion_termino={$_GET['f_creacion_termino']}";
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
		case 'proveedor_asc':  $order_by = 'ORDER BY proveedor_listado.Nombre ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Proveedor Ascendente'; break;
		case 'proveedor_desc': $order_by = 'ORDER BY proveedor_listado.Nombre DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Proveedor Descendente';break;
		case 'ndoc_asc':       $order_by = 'ORDER BY ocompra_listado.idOcompra ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Doc Ascendente';break;
		case 'ndoc_desc':      $order_by = 'ORDER BY ocompra_listado.idOcompra DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc Descendente';break;
		case 'fecha_asc':      $order_by = 'ORDER BY ocompra_listado.Creacion_fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':     $order_by = 'ORDER BY ocompra_listado.Creacion_fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		
		default: $order_by = 'ORDER BY ocompra_listado.idOcompra DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc Descendente';
	}
}else{
	$order_by = 'ORDER BY ocompra_listado.idOcompra DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE ocompra_listado.idOcompra>=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND ocompra_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

if(isset($_GET['idProveedor'])&&$_GET['idProveedor']!=''){   $z.=" AND ocompra_listado.idProveedor={$_GET['idProveedor']}";}
if(isset($_GET['idOcompra'])&&$_GET['idOcompra']!=''){           $z.=" AND ocompra_listado.idOcompra={$_GET['idOcompra']}";}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){         $z.=" AND ocompra_listado.idEstado={$_GET['idEstado']}";}

if(isset($_GET['f_creacion_inicio'])&&$_GET['f_creacion_inicio']!=''&&isset($_GET['f_creacion_termino'])&&$_GET['f_creacion_termino']!=''){
	$z.=" AND ocompra_listado.Creacion_fecha BETWEEN '{$_GET['f_creacion_inicio']}' AND '{$_GET['f_creacion_termino']}'";
}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT ocompra_listado.idOcompra FROM `ocompra_listado` ".$z;
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
$arrOrdenes = array();
$query = "SELECT 
ocompra_listado.idOcompra,
ocompra_listado.Creacion_fecha,
proveedor_listado.Nombre AS NombreProveedor
FROM `ocompra_listado`
LEFT JOIN `proveedor_listado`     ON proveedor_listado.idProveedor      = ocompra_listado.idProveedor
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
array_push( $arrOrdenes,$row );
}
//paginacion
$search='';

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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Ordenes de Compra</h5>
			<div class="toolbar">
				<?php 
				//paginacion
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">   
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Proveedor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=proveedor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=proveedor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">N° Doc</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=ndoc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=ndoc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'?d=d'.$search.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrOrdenes as $orden) { ?>
					<tr class="odd">
						<td><?php echo $orden['NombreProveedor']; ?></td>
						<td><?php echo 'Orden Compra N°'.n_doc($orden['idOcompra'], 5); ?></td>
						<td><?php echo Fecha_estandar($orden['Creacion_fecha']); ?></td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_ocompra.php?view='.$orden['idOcompra']; ?>" title="Ver Orden" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
							</div>
						</td>
					</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			//paginacion
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
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
				if(isset($idProveedor)) {          $x1  = $idProveedor;         }else{$x1  = '';}
				if(isset($idOcompra)) {            $x2  = $idOcompra;           }else{$x2  = '';}
				if(isset($f_creacion_inicio)) {    $x3  = $f_creacion_inicio;   }else{$x3  = '';}
				if(isset($f_creacion_termino)) {   $x4  = $f_creacion_termino;  }else{$x4  = '';}
				if(isset($idEstado)) {             $x5  = $idEstado;            }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Emision</h3>';
				$Form_Imputs->form_select_filter('Proveedor','idProveedor', $x1, 1, 'idProveedor', 'Nombre', 'proveedor_listado', $z, '', $dbConn);
				$Form_Imputs->form_input_number('N° Documento', 'idOcompra', $x2, 1);
				$Form_Imputs->form_date('Fecha Creacion Desde','f_creacion_inicio', $x3, 1);
				$Form_Imputs->form_date('Fecha Creacion Hasta','f_creacion_termino', $x4, 1);
				$Form_Imputs->form_select('Estado','idEstado', $x5, 1, 'idEstado', 'Nombre', 'core_estado_aprobacion', 0, '', $dbConn);
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
