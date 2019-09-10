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
$original = "pago_masivo_cliente_reversa.php";
$location = $original;   
//Se agregan ubicaciones
$search ='&Filtrar=Filtrar';
$location .= "?Filtrar=Filtrar";
if(isset($_GET['idDocPago']) && $_GET['idDocPago'] != ''){   $location .= "&idDocPago=".$_GET['idDocPago'];  $search .= "&idDocPago=".$_GET['idDocPago'];}
if(isset($_GET['N_DocPago']) && $_GET['N_DocPago'] != ''){   $location .= "&N_DocPago=".$_GET['N_DocPago'];  $search .= "&N_DocPago=".$_GET['N_DocPago'];}
if(isset($_GET['Monto']) && $_GET['Monto'] != ''){           $location .= "&Monto=".$_GET['Monto'];          $search .= "&Monto=".$_GET['Monto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){   $location .= "&idUsuario=".$_GET['idUsuario'];  $search .= "&idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Fecha_Inicio'])&&$_GET['Fecha_Inicio']!=''&&isset($_GET['Fecha_Termino'])&&$_GET['Fecha_Termino']!=''){
	$search .="&f_programacion_desde={$_GET['Fecha_Inicio']}";
	$search .="&f_programacion_hasta={$_GET['Fecha_Termino']}";
}    
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
/************************************************************/
//formulario para borrar
if ( !empty($_GET['del_idDocPago']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'del_pagos';
	require_once 'A1XRXS_sys/xrxs_form/z_pagos_clientes_reversa.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['reversa']))  {$error['usuario'] 	  = 'sucess/Pago Reversado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>						
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) {  

/**********************************************************************************************/
//datos de la obra
$NDocsubmit_filter1   = '';
if(isset($_GET['idDocPago'])&&$_GET['idDocPago']!=''){
	$NDocsubmit_filter1 .= ' AND pagos_facturas_clientes.idDocPago='.$_GET['idDocPago'];
}
if(isset($_GET['N_DocPago'])&&$_GET['N_DocPago']!=''){
	$NDocsubmit_filter1 .= ' AND pagos_facturas_clientes.N_DocPago='.$_GET['N_DocPago'];
}

//consulto todos los documentos relacionados al proveedor
$arrReversa = array();
$query = "SELECT 
pagos_facturas_clientes.idTipo,

doc_merc_1.Nombre AS ArriendoDocumentoTipo,
bodegas_arriendos_facturacion.N_Doc AS ArriendoDocumentoNumero,
clien_1.Nombre AS ArriendoCliente,

doc_merc_2.Nombre AS InsumoDocumentoTipo,
bodegas_insumos_facturacion.N_Doc AS InsumoDocumentoNumero,
clien_2.Nombre AS InsumoCliente,

doc_merc_3.Nombre AS ProductoDocumentoTipo,
bodegas_productos_facturacion.N_Doc AS ProductoDocumentoNumero,
clien_3.Nombre AS ProductoCliente,

doc_merc_4.Nombre AS ServicioDocumentoTipo,
bodegas_servicios_facturacion.N_Doc AS ServicioDocumentoNumero,
clien_4.Nombre AS ServicioCliente,

sistema_documentos_pago.Nombre AS DocumentoPago,
pagos_facturas_clientes.idDocPago,
pagos_facturas_clientes.idFacturacion,
pagos_facturas_clientes.N_DocPago AS DocumentoPagoNumero,
pagos_facturas_clientes.montoPactado AS DocumentoMontoPactado,
pagos_facturas_clientes.MontoPagado AS DocumentoMontoPagado

FROM `pagos_facturas_clientes`
LEFT JOIN `bodegas_arriendos_facturacion`            ON bodegas_arriendos_facturacion.idFacturacion    = pagos_facturas_clientes.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_1   ON doc_merc_1.idDocumentos                        = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `clientes_listado` clien_1                 ON clien_1.idCliente                              = bodegas_arriendos_facturacion.idCliente
LEFT JOIN `bodegas_insumos_facturacion`              ON bodegas_insumos_facturacion.idFacturacion      = pagos_facturas_clientes.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_2   ON doc_merc_2.idDocumentos                        = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `clientes_listado` clien_2                 ON clien_2.idCliente                              = bodegas_insumos_facturacion.idCliente
LEFT JOIN `bodegas_productos_facturacion`            ON bodegas_productos_facturacion.idFacturacion    = pagos_facturas_clientes.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_3   ON doc_merc_3.idDocumentos                        = bodegas_productos_facturacion.idDocumentos
LEFT JOIN `clientes_listado` clien_3                 ON clien_3.idCliente                              = bodegas_productos_facturacion.idCliente
LEFT JOIN `bodegas_servicios_facturacion`            ON bodegas_servicios_facturacion.idFacturacion    = pagos_facturas_clientes.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_4   ON doc_merc_4.idDocumentos                        = bodegas_servicios_facturacion.idDocumentos
LEFT JOIN `clientes_listado` clien_4                 ON clien_4.idCliente                              = bodegas_servicios_facturacion.idCliente

LEFT JOIN `sistema_documentos_pago`                 ON sistema_documentos_pago.idDocPago             = pagos_facturas_clientes.idDocPago

				
WHERE (bodegas_arriendos_facturacion.idTipo=2
".$NDocsubmit_filter1.")

OR (bodegas_insumos_facturacion.idTipo=2
".$NDocsubmit_filter1.")
				
OR (bodegas_productos_facturacion.idTipo=2
".$NDocsubmit_filter1.")

OR (bodegas_servicios_facturacion.idTipo=2
".$NDocsubmit_filter1.")

OR (bodegas_arriendos_facturacion.idTipo=12
".$NDocsubmit_filter1.")

OR (bodegas_insumos_facturacion.idTipo=12
".$NDocsubmit_filter1.")
				
OR (bodegas_productos_facturacion.idTipo=12
".$NDocsubmit_filter1.")

OR (bodegas_servicios_facturacion.idTipo=12
".$NDocsubmit_filter1.")

";
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
array_push( $arrReversa,$row );
}



?> 


							
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Facturaciones Pagadas</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Documento</th>
						<th>Cliente</th>
						<th>Documento de Pago</th>
						<th>Facturado</th>
						<th>Pagado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					if(isset($arrReversa)){
						//llamamos a la función para filtrar los datos
						filtrar($arrReversa, 'DocumentoPagoNumero');
						//recorremos el array para imprimirlo con formato HTML
						foreach($arrReversa as $menu=>$productos) {
							echo '<tr class="odd">';
								echo '<td colspan="6" style="background-color: #BFBFBF;">'.$productos[0]['DocumentoPago'].' '.$menu.'</td>';
							echo '</tr>';
										
							// recorremos los productos
							foreach ($productos as $tipo){ ?>
								<tr class="odd">
									
									<?php
									switch ($tipo['idTipo']) {
										//Factura Insumos
										case 1:
											echo '
											<td>'.$tipo['InsumoDocumentoTipo'].' N°'.$tipo['InsumoDocumentoNumero'].'</td>
											<td>'.$tipo['InsumoCliente'].'</td>';
											break;
										//Factura Productos
										case 2:
											echo '
											<td>'.$tipo['ProductoDocumentoTipo'].' N°'.$tipo['ProductoDocumentoNumero'].'</td>
											<td>'.$tipo['ProductoCliente'].'</td>';
											break;
										//Factura Servicios
										case 3:
											echo '
											<td>'.$tipo['ServicioDocumentoTipo'].' N°'.$tipo['ServicioDocumentoNumero'].'</td>
											<td>'.$tipo['ServicioCliente'].'</td>';
											break;
										//Factura Arriendos
										case 4:
											echo '
											<td>'.$tipo['ArriendoDocumentoTipo'].' N°'.$tipo['ArriendoDocumentoNumero'].'</td>
											<td>'.$tipo['ArriendoCliente'].'</td>';
											break;
									}
									?>

									<td><?php echo $tipo['DocumentoPago'].' '.$menu; ?></td>
									<td align="right"><?php echo valores($tipo['DocumentoMontoPactado'], 0); ?></td>
									<td align="right"><?php echo valores($tipo['DocumentoMontoPagado'], 0); ?></td>

									<td>
										<div class="btn-group" style="width: 70px;" >
											<?php
											switch ($tipo['idTipo']) {
												//Factura Insumos
												case 1:
													echo '<a href="view_mov_insumos.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="btn btn-primary btn-sm iframe tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>';
													$docu = $tipo['InsumoDocumentoTipo'].' N'.$tipo['InsumoDocumentoNumero'];
													break;
												//Factura Productos
												case 2:
													echo '<a href="view_mov_productos.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="btn btn-primary btn-sm iframe tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>';
													$docu = $tipo['ProductoDocumentoTipo'].' N'.$tipo['ProductoDocumentoNumero'];
													break;
												//Factura Servicios
												case 3:
													echo '<a href="view_mov_servicios.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="btn btn-primary btn-sm iframe tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>';
													$docu = $tipo['ServicioDocumentoTipo'].' N'.$tipo['ServicioDocumentoNumero'];
													break;
												//Factura Arriendos
												case 4:
													echo '<a href="view_mov_arriendos.php?view='.$tipo['idFacturacion'].'" title="Ver Informacion" class="btn btn-primary btn-sm iframe tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>';
													$docu = $tipo['ArriendoDocumentoTipo'].' N'.$tipo['ArriendoDocumentoNumero'];
													break;
											}
											?>
											<?php
											$ubicacion = $location.'?submit_filter=Filtrar&del_idDocPago='.$tipo['idDocPago'].'&del_N_DocPago='.$menu;
											$dialogo   = '¿Realmente deseas eliminar el documento '.$docu.'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Reversar Pago" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-exchange"></i></a>
											

										</div>
									</td>
								</tr>
						<?php 
							}
						}
					} ?>
							
                  
				</tbody>
			</table>
		</div>
	</div>
</div>  
<?php widget_modal(80, 95); ?>
		

	

  
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width" >Cancelar y Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} elseif ( ! empty($_GET['new']) ) { 
//Verifico el tipo de usuario que esta ingresando 
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} ";		
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idDocPago)) {   $x1  = $idDocPago;  }else{$x1  = '';}
				if(isset($N_DocPago)) {   $x2  = $N_DocPago;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Documento Pago','idDocPago', $x1, 1, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_DocPago', $x2, 1);	
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
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
		case 'fecha_asc':        $order_by = 'ORDER BY pagos_facturas_clientes_reversa.Fecha ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':       $order_by = 'ORDER BY pagos_facturas_clientes_reversa.Fecha DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'documento_asc':    $order_by = 'ORDER BY sistema_documentos_pago.Nombre ASC ';                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Documento Ascendente'; break;
		case 'documento_desc':   $order_by = 'ORDER BY sistema_documentos_pago.Nombre DESC ';               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Documento Descendente';break;
		case 'n_documento_asc':  $order_by = 'ORDER BY pagos_facturas_clientes_reversa.N_DocPago ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> N° Documento Ascendente'; break;
		case 'n_documento_desc': $order_by = 'ORDER BY pagos_facturas_clientes_reversa.N_DocPago DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> N° Documento Descendente';break;
		case 'monto_asc':        $order_by = 'ORDER BY pagos_facturas_clientes_reversa.Monto ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Monto Ascendente'; break;
		case 'monto_desc':       $order_by = 'ORDER BY pagos_facturas_clientes_reversa.Monto DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Monto Descendente';break;
		case 'usuario_asc':      $order_by = 'ORDER BY usuarios_listado.Nombre AS Usuario ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Usuario Ascendente'; break;
		case 'usuario_desc':     $order_by = 'ORDER BY usuarios_listado.Nombre AS Usuario DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Usuario Descendente';break;
		
		default: $order_by = 'ORDER BY pagos_facturas_clientes_reversa.Fecha ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';
	}
}else{
	$order_by = 'ORDER BY pagos_facturas_clientes_reversa.Fecha ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente';
}

/**********************************************************/
//Variable de busqueda
$z = "WHERE pagos_facturas_clientes_reversa.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';		
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idDocPago']) && $_GET['idDocPago'] != ''){   $z .= " AND pagos_facturas_clientes_reversa.idDocPago=".$_GET['idDocPago'];}
if(isset($_GET['N_DocPago']) && $_GET['N_DocPago'] != ''){   $z .= " AND pagos_facturas_clientes_reversa.N_DocPago=".$_GET['N_DocPago'];}
if(isset($_GET['Monto']) && $_GET['Monto'] != ''){           $z .= " AND pagos_facturas_clientes_reversa.Monto=".$_GET['Monto'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){   $z .= " AND pagos_facturas_clientes_reversa.idUsuario=".$_GET['idUsuario'];}
if(isset($_GET['Fecha_Inicio'])&&$_GET['Fecha_Inicio']!=''&&isset($_GET['Fecha_Termino'])&&$_GET['Fecha_Termino']!=''){
	$z.=" AND pagos_facturas_clientes_reversa.Fecha BETWEEN '{$_GET['Fecha_Inicio']}' AND '{$_GET['Fecha_Termino']}'";
}			
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idReversa FROM `pagos_facturas_clientes_reversa` 
LEFT JOIN `usuarios_listado`          ON usuarios_listado.idUsuario          = pagos_facturas_clientes_reversa.idUsuario
LEFT JOIN `sistema_documentos_pago`   ON sistema_documentos_pago.idDocPago   = pagos_facturas_clientes_reversa.idDocPago
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
$arrAFP = array();
$query = "SELECT 
pagos_facturas_clientes_reversa.Fecha,
pagos_facturas_clientes_reversa.Hora,
pagos_facturas_clientes_reversa.N_DocPago,
pagos_facturas_clientes_reversa.Monto,

usuarios_listado.Nombre AS Usuario,
sistema_documentos_pago.Nombre AS DocPago

FROM `pagos_facturas_clientes_reversa`
LEFT JOIN `usuarios_listado`          ON usuarios_listado.idUsuario          = pagos_facturas_clientes_reversa.idUsuario
LEFT JOIN `sistema_documentos_pago`   ON sistema_documentos_pago.idDocPago   = pagos_facturas_clientes_reversa.idDocPago
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
array_push( $arrAFP,$row );
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Reversa</a><?php } ?>
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				if(isset($idDocPago)) {       $x1  = $idDocPago;       }else{$x1  = '';}
				if(isset($N_DocPago)) {       $x2  = $N_DocPago;       }else{$x2  = '';}
				if(isset($Monto)) {           $x3  = $Monto;           }else{$x3  = '';}
				if(isset($idUsuario)) {       $x4  = $idUsuario;       }else{$x4  = '';}
				if(isset($Fecha_Inicio)) {    $x5  = $Fecha_Inicio;    }else{$x5  = '';}
				if(isset($Fecha_Termino)) {   $x6  = $Fecha_Termino;   }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Documento Pago','idDocPago', $x1, 1, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_DocPago', $x2, 1);	
				$Form_Imputs->form_input_number('Monto', 'Monto', $x3, 1);
				$Form_Imputs->form_select_join_filter('Usuario','idUsuario', $x4, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				$Form_Imputs->form_date('Fecha Inicio','Fecha_Inicio', $x5, 1);
				$Form_Imputs->form_date('Fecha Termino','Fecha_Termino', $x6, 1);
				
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Reversas</h5>
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
						<th width="160">
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Documento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=documento_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=documento_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="180">
							<div class="pull-left">N° Documento</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=n_documento_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=n_documento_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Monto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=monto_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=monto_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Usuario</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=usuario_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=usuario_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrAFP as $afp) { ?>
					<tr class="odd">
						<td><?php echo $afp['Fecha'].' '.$afp['Hora']; ?></td>
						<td><?php echo $afp['DocPago']; ?></td>
						<td><?php echo $afp['N_DocPago']; ?></td>
						<td><?php echo valores($afp['Monto'], 0); ?></td>
						<td><?php echo $afp['Usuario']; ?></td>
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
