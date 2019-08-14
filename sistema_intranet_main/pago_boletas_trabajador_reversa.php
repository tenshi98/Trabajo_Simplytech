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
$original = "pago_boletas_trabajador_reversa.php";
$location = $original;     
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
	require_once 'A1XRXS_sys/xrxs_form/z_pagos_boletas_trabajadores_reversa.php';
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
$Docsubmit_filter   = '';
if(isset($_GET['idDocPago'])&&$_GET['idDocPago']!=''){
	$Docsubmit_filter .= ' AND pagos_boletas_trabajadores.idDocPago='.$_GET['idDocPago'];
}
if(isset($_GET['N_DocPago'])&&$_GET['N_DocPago']!=''){
	$Docsubmit_filter .= ' AND pagos_boletas_trabajadores.N_DocPago='.$_GET['N_DocPago'];
}


		
//consulto todos los documentos relacionados al Trabajador
$arrBoletas = array();
$query = "SELECT 
pagos_boletas_trabajadores.idTipo,

doc_merc_1.Nombre AS ArriendoDocumentoTipo,
bodegas_arriendos_facturacion.N_Doc AS ArriendoDocumentoNumero,
prov_1.Nombre AS ArriendoTrabajador,

doc_merc_2.Nombre AS InsumoDocumentoTipo,
boleta_honorarios_facturacion.N_Doc AS InsumoDocumentoNumero,
prov_2.Nombre AS InsumoTrabajador,

doc_merc_3.Nombre AS ProductoDocumentoTipo,
bodegas_productos_facturacion.N_Doc AS ProductoDocumentoNumero,
prov_3.Nombre AS ProductoTrabajador,

doc_merc_4.Nombre AS ServicioDocumentoTipo,
bodegas_servicios_facturacion.N_Doc AS ServicioDocumentoNumero,
prov_4.Nombre AS ServicioTrabajador,

sistema_documentos_pago.Nombre AS DocumentoPago,
pagos_boletas_trabajadores.idDocPago,
pagos_boletas_trabajadores.idFacturacion,
pagos_boletas_trabajadores.N_DocPago AS DocumentoPagoNumero,
pagos_boletas_trabajadores.montoPactado AS DocumentoMontoPactado,
pagos_boletas_trabajadores.MontoPagado AS DocumentoMontoPagado

FROM `pagos_boletas_trabajadores`
LEFT JOIN `bodegas_arriendos_facturacion`           ON bodegas_arriendos_facturacion.idFacturacion   = pagos_boletas_trabajadores.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_1  ON doc_merc_1.idDocumentos                       = bodegas_arriendos_facturacion.idDocumentos
LEFT JOIN `trabajadores_listado` prov_1                ON prov_1.idTrabajador                            = bodegas_arriendos_facturacion.idTrabajador
LEFT JOIN `boleta_honorarios_facturacion`             ON boleta_honorarios_facturacion.idFacturacion     = pagos_boletas_trabajadores.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_2  ON doc_merc_2.idDocumentos                       = boleta_honorarios_facturacion.idDocumentos
LEFT JOIN `trabajadores_listado` prov_2                ON prov_2.idTrabajador                            = boleta_honorarios_facturacion.idTrabajador
LEFT JOIN `bodegas_productos_facturacion`           ON bodegas_productos_facturacion.idFacturacion   = pagos_boletas_trabajadores.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_3  ON doc_merc_3.idDocumentos                       = bodegas_productos_facturacion.idDocumentos
LEFT JOIN `trabajadores_listado` prov_3                ON prov_3.idTrabajador                            = bodegas_productos_facturacion.idTrabajador
LEFT JOIN `bodegas_servicios_facturacion`           ON bodegas_servicios_facturacion.idFacturacion   = pagos_boletas_trabajadores.idFacturacion
LEFT JOIN `core_documentos_mercantiles` doc_merc_4  ON doc_merc_4.idDocumentos                       = bodegas_servicios_facturacion.idDocumentos
LEFT JOIN `trabajadores_listado` prov_4                ON prov_4.idTrabajador                            = bodegas_servicios_facturacion.idTrabajador

LEFT JOIN `sistema_documentos_pago`                 ON sistema_documentos_pago.idDocPago             = pagos_boletas_trabajadores.idDocPago

				
WHERE (bodegas_arriendos_facturacion.idTipo=1
".$Docsubmit_filter.")

OR (boleta_honorarios_facturacion.idTipo=1
".$Docsubmit_filter.")
				
OR (bodegas_productos_facturacion.idTipo=1
".$Docsubmit_filter.")

OR (bodegas_servicios_facturacion.idTipo=1
".$Docsubmit_filter.")

OR (bodegas_arriendos_facturacion.idTipo=10
".$Docsubmit_filter.")

OR (boleta_honorarios_facturacion.idTipo=10
".$Docsubmit_filter.")
				
OR (bodegas_productos_facturacion.idTipo=10
".$Docsubmit_filter.")

OR (bodegas_servicios_facturacion.idTipo=10
".$Docsubmit_filter.")

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
array_push( $arrBoletas,$row );
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
								<th>Trabajador</th>
								<th>Documento de Pago</th>
								<th>Facturado</th>
								<th>Pagado</th>
								<th width="10">Acciones</th>
							</tr>
						</thead>			  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php 
						if(isset($arrBoletas)){
							foreach ($arrBoletas as $tipo){ ?>
								<tr class="odd">
									
									<?php
									switch ($tipo['idTipo']) {
										//Factura Insumos
										case 1:
											echo '
											<td>'.$tipo['InsumoDocumentoTipo'].' N°'.$tipo['InsumoDocumentoNumero'].'</td>
											<td>'.$tipo['InsumoTrabajador'].'</td>';
											break;
										//Factura Productos
										case 2:
											echo '
											<td>'.$tipo['ProductoDocumentoTipo'].' N°'.$tipo['ProductoDocumentoNumero'].'</td>
											<td>'.$tipo['ProductoTrabajador'].'</td>';
											break;
										//Factura Servicios
										case 3:
											echo '
											<td>'.$tipo['ServicioDocumentoTipo'].' N°'.$tipo['ServicioDocumentoNumero'].'</td>
											<td>'.$tipo['ServicioTrabajador'].'</td>';
											break;
										//Factura Arriendos
										case 4:
											echo '
											<td>'.$tipo['ArriendoDocumentoTipo'].' N°'.$tipo['ArriendoDocumentoNumero'].'</td>
											<td>'.$tipo['ArriendoTrabajador'].'</td>';
											break;
									}
									?>

									<td><?php echo $tipo['DocumentoPago'].' '.$tipo['DocumentoPagoNumero']; ?></td>
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
											$ubicacion = $location.'?submit_filter=Filtrar&del_idDocPago='.$tipo['idDocPago'].'&del_N_DocPago='.$tipo['DocumentoPagoNumero'];
											$dialogo   = '¿Realmente deseas eliminar el documento '.$docu.'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Reversar Pago" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-exchange"></i></a>
										
										</div>
									</td>
								</tr>
						<?php 
							}
						} ?>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>  
		<?php require_once '../LIBS_js/modal/modal.php';?>
		


  
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright margin_width" ><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
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
				if(isset($idDocPago)) {   $x1  = $idDocPago;   }else{$x1  = '';}
				if(isset($N_DocPago)) {   $x2  = $N_DocPago;   }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Documento Pago','idDocPago', $x1, 1, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Imputs->form_input_number('Numero de Documento', 'N_DocPago', $x2, 1);	
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
