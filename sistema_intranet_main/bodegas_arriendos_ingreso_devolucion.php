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
//Cargamos la ubicacion original
$original = "bodegas_arriendos_ingreso_devolucion.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idProveedor']) && $_GET['idProveedor']!=''){     $location .= "&idProveedor=".$_GET['idProveedor'];              $search .= "&idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos']!=''){   $location .= "&idDocumentos=".$_GET['idDocumentos'];            $search .= "&idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc']!=''){                 $location .= "&N_Doc=".$_GET['N_Doc'];                          $search .= "&N_Doc=".$_GET['N_Doc'];}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){      $location .= "&Creacion_fecha=".$_GET['Creacion_fecha'];        $search .= "&Creacion_fecha=".$_GET['Creacion_fecha'];}
if(isset($_GET['Devolucion_fecha']) && $_GET['Devolucion_fecha']!=''){  $location .= "&Devolucion_fecha=".$_GET['Devolucion_fecha'];    $search .= "&Devolucion_fecha=".$_GET['Devolucion_fecha'];}
if(isset($_GET['idTrabajador']) && $_GET['idTrabajador']!=''){   $location .= "&idTrabajador=".$_GET['idTrabajador'];            $search .= "&idTrabajador=".$_GET['idTrabajador'];}
if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){           $location .= "&idBodega=".$_GET['idBodega'];                    $search .= "&idBodega=".$_GET['idBodega'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){ $location .= "&Observaciones=".$_GET['Observaciones'];          $search .= "&Observaciones=".$_GET['Observaciones'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit_devolucion'])){
	//Llamamos al formulario
	$form_trabajo= 'actualizar_devolucion';
	require_once 'A1XRXS_sys/xrxs_form/z_bodega_arriendos.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Compra Realizada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Compra Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Compra borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){?>
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Ingresar Devolucion</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($FechaDevolucionReal)){  $x1  = $FechaDevolucionReal;  }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Devolucion','FechaDevolucionReal', $x1, 2);
				
				$Form_Inputs->form_input_hidden('idFacturacion', $_GET['id'], 2);
				$Form_Inputs->form_input_hidden('idEstadoDevolucion', 2, 2);
				$Form_Inputs->form_input_hidden('idUsuarioDevolucion', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf046; Ingresar Devolucion" name="submit_devolucion">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'proveedor_asc':  $order_by = 'proveedor_listado.Nombre ASC ';                       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Proveedor Ascendente'; break;
		case 'proveedor_desc': $order_by = 'proveedor_listado.Nombre DESC ';                      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Proveedor Descendente';break;
		case 'fecha_asc':      $order_by = 'bodegas_arriendos_facturacion.Creacion_fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';break;
		case 'fecha_desc':     $order_by = 'bodegas_arriendos_facturacion.Creacion_fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'doc_asc':        $order_by = 'core_documentos_mercantiles.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Documento Ascendente';break;
		case 'doc_desc':       $order_by = 'core_documentos_mercantiles.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Documento Descendente';break;
		
		default: $order_by = 'bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'bodegas_arriendos_facturacion.Creacion_fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//filtro
$y = "bodegas_arriendos_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
$w = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";
	
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$y .= " AND usuarios_bodegas_arriendos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
/**********************************************************/
//Variable con la ubicacion
$SIS_where = "bodegas_arriendos_facturacion.idTipo=1";//Solo ingresos
$SIS_where.= " AND bodegas_arriendos_facturacion.idEstadoDevolucion=1";//solo los que no tengan devolucion
$SIS_where.= " AND bodegas_arriendos_facturacion.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idProveedor']) && $_GET['idProveedor']!=''){     $SIS_where .= " AND bodegas_arriendos_facturacion.idProveedor=".$_GET['idProveedor'];}
if(isset($_GET['idDocumentos']) && $_GET['idDocumentos']!=''){   $SIS_where .= " AND bodegas_arriendos_facturacion.idDocumentos=".$_GET['idDocumentos'];}
if(isset($_GET['N_Doc']) && $_GET['N_Doc']!=''){                 $SIS_where .= " AND bodegas_arriendos_facturacion.N_Doc LIKE '%".EstandarizarInput($_GET['N_Doc'])."%'";}
if(isset($_GET['Creacion_fecha']) && $_GET['Creacion_fecha']!=''){      $SIS_where .= " AND bodegas_arriendos_facturacion.Creacion_fecha='".$_GET['Creacion_fecha']."'";}
if(isset($_GET['Devolucion_fecha']) && $_GET['Devolucion_fecha']!=''){  $SIS_where .= " AND bodegas_arriendos_facturacion.Devolucion_fecha='".$_GET['Devolucion_fecha']."'";}
if(isset($_GET['idBodega']) && $_GET['idBodega']!=''){           $SIS_where .= " AND bodegas_arriendos_facturacion.idBodega=".$_GET['idBodega'];}
if(isset($_GET['Observaciones']) && $_GET['Observaciones']!=''){ $SIS_where .= " AND bodegas_arriendos_facturacion.Observaciones LIKE '%".EstandarizarInput($_GET['Observaciones'])."%'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idFacturacion', 'bodegas_arriendos_facturacion', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
core_documentos_mercantiles.Nombre AS Documento,
proveedor_listado.Nombre AS Proveedor';
$SIS_join  = '
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema                   = bodegas_arriendos_facturacion.idSistema
LEFT JOIN `core_documentos_mercantiles` ON core_documentos_mercantiles.idDocumentos  = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`           ON proveedor_listado.idProveedor             = bodegas_arriendos_facturacion.idProveedor';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrTipo = array();
$arrTipo = db_select_array (false, $SIS_query, 'bodegas_arriendos_facturacion', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTipo');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>
	
</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idProveedor)){        $x1  = $idProveedor;      }else{$x1  = '';}
				if(isset($idDocumentos)){       $x2  = $idDocumentos;     }else{$x2  = '';}
				if(isset($N_Doc)){              $x3  = $N_Doc;            }else{$x3  = '';}
				if(isset($Creacion_fecha)){     $x4  = $Creacion_fecha;   }else{$x4  = '';}
				if(isset($Devolucion_fecha)){   $x5  = $Devolucion_fecha; }else{$x5  = '';}
				if(isset($idBodega)){           $x6  = $idBodega;         }else{$x6  = '';}
				if(isset($Observaciones)){      $x7  = $Observaciones;    }else{$x7  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Proveedor','idProveedor', $x1, 1, 'idProveedor', 'Nombre', 'proveedor_listado', $w, '', $dbConn);
				$Form_Inputs->form_select('Tipo Documento','idDocumentos', $x2, 1, 'idDocumentos', 'Nombre', 'core_documentos_mercantiles', 'idDocumentos!=3 AND idDocumentos!=4', '', $dbConn);
				$Form_Inputs->form_input_number('Numero de Documento', 'N_Doc', $x3, 1);
				$Form_Inputs->form_date('Fecha Documento','Creacion_fecha', $x4, 1);
				$Form_Inputs->form_date('F Devolucion Estimada','Devolucion_fecha', $x5, 1);
				$Form_Inputs->form_select_join_filter('Bodega destino','idBodega', $x6, 1, 'idBodega', 'Nombre', 'bodegas_arriendos_listado', 'usuarios_bodegas_arriendos', $y, $dbConn);
				$Form_Inputs->form_textarea('Observaciones','Observaciones', $x7, 1);
				
				
				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>

			</form>
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Arriendos</h5>
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
							<div class="pull-left">Proveedor</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=proveedor_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=proveedor_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Documento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=doc_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=doc_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Fecha de Compra</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Proveedor']; ?></td>
						<td><?php echo $tipo['Documento'].' '.$tipo['N_Doc']; ?></td>
						<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_mov_arriendos.php?view='.simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
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
