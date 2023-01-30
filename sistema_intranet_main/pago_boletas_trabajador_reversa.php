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
$original = "pago_boletas_trabajador_reversa.php";
$location = $original;     
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
/************************************************************/
//formulario para borrar
if (!empty($_GET['del_idPago'])){
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
if (isset($_GET['reversa'])){ $error['reversa'] = 'sucess/Pago Reversado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['submit_filter'])){

/**********************************************************************************************/
//datos 
$filter   = 'WHERE pagos_boletas_trabajadores.idPago!=0';
if(isset($_GET['idDocPago'])&&$_GET['idDocPago']!=''){
	$filter .= ' AND pagos_boletas_trabajadores.idDocPago='.$_GET['idDocPago'];
}
if(isset($_GET['N_DocPago'])&&$_GET['N_DocPago']!=''){
	$filter .= ' AND pagos_boletas_trabajadores.N_DocPago='.$_GET['N_DocPago'];
}
if(isset($_GET['idTrabajador'])&&$_GET['idTrabajador']!=''){
	$filter .= ' AND pagos_boletas_trabajadores.idTrabajador='.$_GET['idTrabajador'];
}
		
//consulto todos los documentos relacionados al Trabajador
$arrBoletas = array();
$query = "SELECT 
pagos_boletas_trabajadores.idPago,
trabajadores_listado.Nombre AS TrabNombre,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
sistema_documentos_pago.Nombre AS DocumentoPago,
pagos_boletas_trabajadores.N_DocPago AS DocumentoPagoNumero,
pagos_boletas_trabajadores.montoPactado AS DocumentoMontoPactado,
pagos_boletas_trabajadores.MontoPagado AS DocumentoMontoPagado,
pagos_boletas_trabajadores.idFacturacion

FROM `pagos_boletas_trabajadores`
LEFT JOIN `trabajadores_listado`      ON trabajadores_listado.idTrabajador   = pagos_boletas_trabajadores.idTrabajador
LEFT JOIN `sistema_documentos_pago`   ON sistema_documentos_pago.idDocPago   = pagos_boletas_trabajadores.idDocPago

".$filter;
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrBoletas,$row );
}
?> 
							
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Boletas Pagadas</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Trabajador</th>
						<th>Facturado</th>
						<th>Pagado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					if ($arrBoletas!=false && !empty($arrBoletas) && $arrBoletas!='') {
						//llamamos a la función para filtrar los datos
						filtrar($arrBoletas, 'DocumentoPagoNumero');
						//recorremos el array para imprimirlo con formato HTML
						foreach($arrBoletas as $menu=>$productos) { ?>
							<tr class="odd">
								<td colspan="3" style="background-color: #BFBFBF;"><?php echo $productos[0]['DocumentoPago'].' '.$menu; ?></td>
								<td style="background-color: #BFBFBF;">
									<div class="btn-group" style="width: 35px;" >
										<?php if ($rowlevel['level']>=4){
											$ubicacion = $location.'&submit_filter=Filtrar&del_idPago='.simpleEncode($productos[0]['idPago'], fecha_actual()).'&idFacturacion='.simpleEncode($productos[0]['idFacturacion'], fecha_actual());
											$dialogo   = '¿Realmente deseas eliminar el pago '.$productos[0]['DocumentoPago'].' '.$menu.'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-exchange" aria-hidden="true"></i></a>
										<?php } ?>
									</div>
								</td>
							</tr>
							<?php foreach ($productos as $tipo){ ?>
								<tr class="odd">
									<td><?php echo $tipo['TrabNombre'].' '.$tipo['TrabApellidoPat'].' '.$tipo['TrabApellidoMat']; ?></td>
									<td align="right"><?php echo valores($tipo['DocumentoMontoPactado'], 0); ?></td>
									<td align="right"><?php echo valores($tipo['DocumentoMontoPagado'], 0); ?></td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="view_boleta_honorarios.php?view=<?php echo simpleEncode($tipo['idFacturacion'], fecha_actual()); ?>" title="Ver Informacion" class="btn btn-primary btn-sm iframe tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
										</div>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
					<?php } ?>
						
				</tbody>
			</table>
		</div>
	</div>
</div>  
<?php widget_modal(80, 95); ?>


  
<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger pull-right margin_form_btn" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
<div class="clearfix"></div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//Verifico el tipo de usuario que esta ingresando
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1"; 
 ?>
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idDocPago)){      $x1  = $idDocPago;      }else{$x1  = '';}
				if(isset($N_DocPago)){      $x2  = $N_DocPago;      }else{$x2  = '';}
				if(isset($idTrabajador)){   $x3  = $idTrabajador;   }else{$x3  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Documento de Pago','idDocPago', $x1, 1, 'idDocPago', 'Nombre', 'sistema_documentos_pago', 0, '', $dbConn);
				$Form_Inputs->form_input_number('N° Documento de Pago', 'N_DocPago', $x2, 1);	
				$Form_Inputs->form_select_filter('Trabajador','idTrabajador', $x3, 1, 'idTrabajador', 'Rut,Nombre,ApellidoPat,ApellidoMat', 'trabajadores_listado', $z, '', $dbConn);
				
				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="submit_filter">
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
