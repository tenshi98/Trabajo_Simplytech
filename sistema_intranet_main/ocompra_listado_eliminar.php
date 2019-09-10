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
$original = "ocompra_listado_eliminar.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idProveedor']) && $_GET['idProveedor'] != ''){        $location .= "&idProveedor=".$_GET['idProveedor'];        $search .= "&idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];  $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
/********************************************************************/
if(isset($_GET['soli']) && $_GET['soli'] != ''){          $location .= "&soli=".$_GET['soli'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//se borra 
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'eliminar_orden';
	require_once 'A1XRXS_sys/xrxs_form/z_ocompra_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Documento Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Documento Editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Documento borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
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
		case 'ndoc_asc':          $order_by = 'ORDER BY ocompra_listado.idOcompra ASC ';        $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Doc Ascendente';break;
		case 'ndoc_desc':         $order_by = 'ORDER BY ocompra_listado.idOcompra DESC ';       $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Doc Descendente';break;
		case 'proveedor_asc':     $order_by = 'ORDER BY proveedor_listado.Nombre ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Proveedor Ascendente';break;
		case 'proveedor_desc':    $order_by = 'ORDER BY proveedor_listado.Nombre DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Proveedor Descendente';break;
		case 'estado_asc':        $order_by = 'ORDER BY core_oc_estado.Nombre ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':       $order_by = 'ORDER BY core_oc_estado.Nombre DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'fecha_asc':         $order_by = 'ORDER BY ocompra_listado.Creacion_fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':        $order_by = 'ORDER BY ocompra_listado.Creacion_fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		
		default: $order_by = 'ORDER BY core_oc_estado.idEstado DESC,ocompra_listado.idOcompra DESC, ocompra_listado.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado, N° Doc, Fecha Descendente';
	}
}else{
	$order_by = 'ORDER BY core_oc_estado.idEstado DESC,ocompra_listado.idOcompra DESC, ocompra_listado.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado, N° Doc, Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE ocompra_listado.idEstado=1 OR ocompra_listado.idEstado=3";
//verifico que sea un administrador
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND ocompra_listado.idSistema>=0";	
	$w="idSistema>=0 AND idEstado=1";
}else{
	$z.=" AND ocompra_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND ocompra_listado.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";	
	$w="idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idProveedor']) && $_GET['idProveedor'] != ''){        $z .= " AND ocompra_listado.idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha'] != ''){  $z .= " AND ocompra_listado.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idOcompra FROM `ocompra_listado` ".$z;
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
$arrSolicitudes = array();
$query = "SELECT 
ocompra_listado.idOcompra,
ocompra_listado.idEstado,
ocompra_listado.Solicitud,
ocompra_listado.Creacion_fecha,
core_oc_estado.Nombre AS Estado,
proveedor_listado.Nombre AS Proveedor

FROM `ocompra_listado`
LEFT JOIN `core_oc_estado`      ON core_oc_estado.idEstado         = ocompra_listado.idEstado 
LEFT JOIN `proveedor_listado`   ON proveedor_listado.idProveedor   = ocompra_listado.idProveedor 

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
array_push( $arrSolicitudes,$row );
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
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idProveedor)) {      $x1  = $idProveedor;    }else{$x1  = '';}
				if(isset($Creacion_fecha)) {   $x2  = $Creacion_fecha; }else{$x2  = '';}
				
				//se dibujan los inputs	
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Proveedor','idProveedor', $x1, 1, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Imputs->form_date('Fecha de Orden de Compra','Creacion_fecha', $x2, 1);
				
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                      
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Ordenes de Compra</h5>
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
							<div class="pull-left">Proveedor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=proveedor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=proveedor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
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
					<?php foreach ($arrSolicitudes as $sol) { ?>
					<tr class="odd <?php if(isset($sol['idEstado'])&&$sol['idEstado']==3){echo 'danger';} ?>">
						<td><?php echo 'OC N°'.n_doc($sol['idOcompra'], 5); ?></td>
						<td><?php echo $sol['Proveedor']; ?></td>
						<td><?php echo $sol['Estado']; ?></td>
						<td><?php echo Fecha_estandar($sol['Creacion_fecha']); ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php 
								$extra = '';
								if(isset($sol['Solicitud'])&&$sol['Solicitud']==1){
									$extra = '&soli=true';
								} ?>
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_ocompra.php?view='.$sol['idOcompra']; ?>" title="Ver Orden" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$sol['idOcompra'];
									$dialogo   = '¿Realmente deseas eliminar la Orden de Compra N° '.$sol['idOcompra'].'?';?>
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

<?php widget_modal(80, 95); ?>	
          
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
