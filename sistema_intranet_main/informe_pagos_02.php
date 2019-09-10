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
$original = "informe_pagos_02.php";
$location = $original;
//Se agregan ubicaciones
$search ='&submit_filter=Filtrar';
if(isset($_GET['idTipo'])&&$_GET['idTipo']!=''){               $search .="&idTipo={$_GET['idTipo']}";}
if(isset($_GET['idProveedor'])&&$_GET['idProveedor']!=''){     $search .="&idProveedor={$_GET['idProveedor']}";}
if(isset($_GET['idCliente'])&&$_GET['idCliente']!=''){         $search .="&idCliente={$_GET['idCliente']}";}
if(isset($_GET['idTrabajador'])&&$_GET['idTrabajador']!=''){   $search .="&idTrabajador={$_GET['idTrabajador']}";}
if(isset($_GET['idDocumentos'])&&$_GET['idDocumentos']!=''){   $search .="&idDocumentos={$_GET['idDocumentos']}";}
if(isset($_GET['N_Doc'])&&$_GET['N_Doc']!=''){                 $search .="&N_Doc={$_GET['N_Doc']}";}
if(isset($_GET['idEstado'])&&$_GET['idEstado']!=''){           $search .="&idEstado={$_GET['idEstado']}";}
if(isset($_GET['idDocPago'])&&$_GET['idDocPago']!=''){         $search .="&idDocPago={$_GET['idDocPago']}";}
if(isset($_GET['N_DocPago'])&&$_GET['N_DocPago']!=''){         $search .="&N_DocPago={$_GET['N_DocPago']}";}
if(isset($_GET['f_creacion_inicio'])&&$_GET['f_creacion_inicio']!=''&&isset($_GET['f_creacion_termino'])&&$_GET['f_creacion_termino']!=''){
	$search .="&f_creacion_inicio={$_GET['f_creacion_inicio']}";
	$search .="&f_creacion_termino={$_GET['f_creacion_termino']}";
}
if(isset($_GET['f_pago_inicio'])&&$_GET['f_pago_inicio']!=''&&isset($_GET['f_pago_termino'])&&$_GET['f_pago_termino']!=''){
	$search .="&f_pago_inicio={$_GET['f_pago_inicio']}";
	$search .="&f_pago_termino={$_GET['f_pago_termino']}";
}
if(isset($_GET['f_inicio_p'])&&$_GET['f_inicio_p']!=''&&isset($_GET['f_termino_p'])&&$_GET['f_termino_p']!=''){
	$search .="&f_inicio_p={$_GET['f_inicio_p']}";
	$search .="&f_termino_p={$_GET['f_termino_p']}";
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
//Variable de busqueda
$z1 = "WHERE bodegas_arriendos_facturacion.idEstado=1";
$z2 = "WHERE bodegas_insumos_facturacion.idEstado=1";
$z3 = "WHERE bodegas_productos_facturacion.idEstado=1";
$z4 = "WHERE bodegas_servicios_facturacion.idEstado=1";
//se traen solo las notas de credito
$z1.=" AND bodegas_arriendos_facturacion.idDocumentos=3";
$z2.=" AND bodegas_insumos_facturacion.idDocumentos=3";
$z3.=" AND bodegas_productos_facturacion.idDocumentos=3";
$z4.=" AND bodegas_servicios_facturacion.idDocumentos=3";
//Se verifica que no tengan documentos relacionados
$z1.=" AND bodegas_arriendos_facturacion.idFacturacionRelacionado=0";
$z2.=" AND bodegas_insumos_facturacion.idFacturacionRelacionado=0";
$z3.=" AND bodegas_productos_facturacion.idFacturacionRelacionado=0";
$z4.=" AND bodegas_servicios_facturacion.idFacturacionRelacionado=0";
	
//Verifico el tipo de usuario que esta ingresando
$z1.=" AND bodegas_arriendos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
$z2.=" AND bodegas_insumos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
$z3.=" AND bodegas_productos_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
$z4.=" AND bodegas_servicios_facturacion.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

if(isset($_GET['idProveedor'])&&$_GET['idProveedor']!=''){   
	$z1.=" AND bodegas_arriendos_facturacion.idProveedor={$_GET['idProveedor']}";
	$z2.=" AND bodegas_insumos_facturacion.idProveedor={$_GET['idProveedor']}";
	$z3.=" AND bodegas_productos_facturacion.idProveedor={$_GET['idProveedor']}";
	$z4.=" AND bodegas_servicios_facturacion.idProveedor={$_GET['idProveedor']}";
}
if(isset($_GET['N_Doc'])&&$_GET['N_Doc']!=''){               
	$z1.=" AND bodegas_arriendos_facturacion.N_Doc={$_GET['N_Doc']}";
	$z2.=" AND bodegas_insumos_facturacion.N_Doc={$_GET['N_Doc']}";
	$z3.=" AND bodegas_productos_facturacion.N_Doc={$_GET['N_Doc']}";
	$z4.=" AND bodegas_servicios_facturacion.N_Doc={$_GET['N_Doc']}";
}
if(isset($_GET['f_creacion_inicio'])&&$_GET['f_creacion_inicio']!=''&&isset($_GET['f_creacion_termino'])&&$_GET['f_creacion_termino']!=''){
	$z1.=" AND bodegas_arriendos_facturacion.Creacion_fecha BETWEEN '{$_GET['f_creacion_inicio']}' AND '{$_GET['f_creacion_termino']}'";
	$z2.=" AND bodegas_insumos_facturacion.Creacion_fecha BETWEEN '{$_GET['f_creacion_inicio']}' AND '{$_GET['f_creacion_termino']}'";
	$z3.=" AND bodegas_productos_facturacion.Creacion_fecha BETWEEN '{$_GET['f_creacion_inicio']}' AND '{$_GET['f_creacion_termino']}'";
	$z4.=" AND bodegas_servicios_facturacion.Creacion_fecha BETWEEN '{$_GET['f_creacion_inicio']}' AND '{$_GET['f_creacion_termino']}'";
}

/*************************************************************************************/
// Se trae un listado con todos los usuarios
$arrTipo1 = array();
$query = "SELECT 
bodegas_arriendos_facturacion.idFacturacion,
bodegas_arriendos_facturacion.Creacion_fecha,
bodegas_arriendos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
proveedor_listado.Nombre AS Proveedor,
bodegas_arriendos_facturacion.ValorTotal

FROM `bodegas_arriendos_facturacion`
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_arriendos_facturacion.idSistema
LEFT JOIN `proveedor_listado`            ON proveedor_listado.idProveedor               = bodegas_arriendos_facturacion.idProveedor
".$z1;
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
array_push( $arrTipo1,$row );
}
/*************************************************************************************/
// Se trae un listado con todos los usuarios
$arrTipo2 = array();
$query = "SELECT 
bodegas_insumos_facturacion.idFacturacion,
bodegas_insumos_facturacion.Creacion_fecha,
bodegas_insumos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
proveedor_listado.Nombre AS Proveedor,
bodegas_insumos_facturacion.ValorTotal

FROM `bodegas_insumos_facturacion`
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_insumos_facturacion.idSistema
LEFT JOIN `proveedor_listado`            ON proveedor_listado.idProveedor               = bodegas_insumos_facturacion.idProveedor
".$z2;
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
array_push( $arrTipo2,$row );
}
/*************************************************************************************/
// Se trae un listado con todos los usuarios
$arrTipo3 = array();
$query = "SELECT 
bodegas_productos_facturacion.idFacturacion,
bodegas_productos_facturacion.Creacion_fecha,
bodegas_productos_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
proveedor_listado.Nombre AS Proveedor,
bodegas_productos_facturacion.ValorTotal

FROM `bodegas_productos_facturacion`
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_productos_facturacion.idSistema
LEFT JOIN `proveedor_listado`            ON proveedor_listado.idProveedor               = bodegas_productos_facturacion.idProveedor
".$z3;
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
array_push( $arrTipo3,$row );
}
/*************************************************************************************/
// Se trae un listado con todos los usuarios
$arrTipo4 = array();
$query = "SELECT 
bodegas_servicios_facturacion.idFacturacion,
bodegas_servicios_facturacion.Creacion_fecha,
bodegas_servicios_facturacion.N_Doc,
core_sistemas.Nombre AS Sistema,
proveedor_listado.Nombre AS Proveedor,
bodegas_servicios_facturacion.ValorTotal

FROM `bodegas_servicios_facturacion`
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                     = bodegas_servicios_facturacion.idSistema
LEFT JOIN `proveedor_listado`            ON proveedor_listado.idProveedor               = bodegas_servicios_facturacion.idProveedor
".$z4;
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
array_push( $arrTipo4,$row );
}

?>



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Documentos</h5>
		</header>
		<div class="table-responsive">   
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Proveedor</th>
						<th>Documento</th>
						<th>Fecha de Ingreso</th>
						<th>Valor Total</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<tr class="odd"><td style="background-color:#DDD" colspan="<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){echo '8';}else{echo '7';} ?>">Arriendos</td></tr>
					<?php foreach ($arrTipo1 as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Proveedor']; ?></td>
							<td><?php echo 'Nota de Credito N°'.$tipo['N_Doc']; ?></td>
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
							<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_mov_arriendos.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>
					<tr class="odd"><td style="background-color:#DDD" colspan="<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){echo '8';}else{echo '7';} ?>">Insumos</td></tr>
					<?php foreach ($arrTipo2 as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Proveedor']; ?></td>
							<td><?php echo 'Nota de Credito N°'.$tipo['N_Doc']; ?></td>
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
							<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_mov_insumos.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?> 
					<tr class="odd"><td style="background-color:#DDD" colspan="<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){echo '8';}else{echo '7';} ?>">Productos</td></tr>
					<?php foreach ($arrTipo3 as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Proveedor']; ?></td>
							<td><?php echo 'Nota de Credito N°'.$tipo['N_Doc']; ?></td>
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
							<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_mov_productos.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?> 
					<tr class="odd"><td style="background-color:#DDD" colspan="<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){echo '8';}else{echo '7';} ?>">Servicios</td></tr>
					<?php foreach ($arrTipo4 as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Proveedor']; ?></td>
							<td><?php echo 'Nota de Credito N°'.$tipo['N_Doc']; ?></td>
							<td><?php echo Fecha_estandar($tipo['Creacion_fecha']); ?></td>
							<td><?php echo Valores($tipo['ValorTotal'], 0); ?></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['Sistema']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 35px;" >
									<a href="<?php echo 'view_mov_servicios.php?view='.$tipo['idFacturacion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>                  
				</tbody>
			</table>
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
				if(isset($N_Doc)) {                $x3  = $N_Doc;               }else{$x3  = '';}
				if(isset($f_creacion_inicio)) {    $x4  = $f_creacion_inicio;   }else{$x4  = '';}
				if(isset($f_creacion_termino)) {   $x5  = $f_creacion_termino;  }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Emision</h3>';
				$Form_Imputs->form_select_filter('Proveedor','idProveedor', $x1, 1, 'idProveedor', 'Nombre', 'proveedor_listado', $z, '', $dbConn);
				$Form_Imputs->form_input_number('N° Documento', 'N_Doc', $x3, 1);
				$Form_Imputs->form_date('Fecha Creacion Desde','f_creacion_inicio', $x4, 1);
				$Form_Imputs->form_date('Fecha Creacion Hasta','f_creacion_termino', $x5, 1);
						
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
