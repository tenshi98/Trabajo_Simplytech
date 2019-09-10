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
$original = "vehiculos_listado.php";
$location = $original;
$new_location = "vehiculos_listado_doc_mantencion.php";
$new_location .='?pagina='.$_GET['pagina'];
$new_location .='&id='.$_GET['id'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Nueva ubicacion
	$location = $new_location;
	//Llamamos al formulario
	$form_trabajo= 'submit_doc_mantencion';
	require_once 'A1XRXS_sys/xrxs_form/vehiculos_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_doc_mantencion']) )     {
	//Nueva ubicacion
	$location = $new_location;
	//Llamamos al formulario
	$form_trabajo= 'del_doc_mantencion';
	require_once 'A1XRXS_sys/xrxs_form/vehiculos_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Mantencion creada correctamente';}
if (isset($_GET['del_doc_vehi'])) {$error['usuario']  = 'sucess/Mantencion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['new_mant']) ) { ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Mantencion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
					
				<?php 
				//Se verifican si existen los datos
				if(isset($doc_fecha_mantencion)) {  $x1  = $doc_fecha_mantencion;   }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Mantenciones</h3>';
				$Form_Imputs->form_multiple_upload('Seleccionar archivo','doc_mantencion', 1, '"doc","docx","pdf","jpg", "png", "gif", "jpeg"');
				$Form_Imputs->form_date('Fecha Vencimiento','doc_fecha_mantencion', $x1, 2);
				
				$Form_Imputs->form_input_hidden('idVehiculo', $_GET['id'], 2);
				?> 

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf093; Subir Archivo" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
							  
			</form> 
			<?php widget_validator(); ?>  
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else{
// Se traen todos los datos del trabajador
$query = "SELECT Nombre,Patente,idOpciones_1,idOpciones_2,idOpciones_3,idOpciones_4,idOpciones_5, idOpciones_6,
idOpciones_7, idOpciones_8, doc_mantencion, doc_fecha_mantencion
FROM `vehiculos_listado`
WHERE idVehiculo = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);

$arrTipoCliente = array();
$query = "SELECT idMantenciones, doc_mantencion, doc_fecha_mantencion, Fecha_ingreso 
FROM `vehiculos_mantenciones`
WHERE idVehiculo = {$_GET['id']}";
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
array_push( $arrTipoCliente,$row );
}


/************************************************/
//Accesos a los equipos de telemetria
$trans_1 = "telemetria_listado.php";
$trans_2 = "admin_telemetria_listado.php";

//Accesos a bodegas de productos
$trans_3 = "bodegas_productos_egreso.php";
$trans_4 = "bodegas_productos_ingreso.php";
$trans_5 = "bodegas_productos_simple_stock.php";
$trans_6 = "bodegas_productos_stock.php";

//Accesos a rutas
$trans_7 = "vehiculos_rutas.php";
$trans_8 = "vehiculos_ruta_alternativa.php";

//Accesos a trabajadores
$trans_9 = "trabajadores_listado.php";

//Accesos a apoderados
$trans_10 = "apoderados_listado.php";

//Accesos a clientes
$trans_11 = "clientes_listado.php";

//Accesos a colegios
$trans_12 = "colegios_listado.php";

//realizo la consulta
$query = "SELECT

(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_1."' AND visualizacion!=9999 LIMIT 1) AS tran_1,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_2."' AND visualizacion!=9999 LIMIT 1) AS tran_2,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_3."' AND visualizacion!=9999 LIMIT 1) AS tran_3,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_4."' AND visualizacion!=9999 LIMIT 1) AS tran_4,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_5."' AND visualizacion!=9999 LIMIT 1) AS tran_5,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_6."' AND visualizacion!=9999 LIMIT 1) AS tran_6,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_7."' AND visualizacion!=9999 LIMIT 1) AS tran_7,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_8."' AND visualizacion!=9999 LIMIT 1) AS tran_8,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_9."' AND visualizacion!=9999 LIMIT 1) AS tran_9,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_10."' AND visualizacion!=9999 LIMIT 1) AS tran_10,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_11."' AND visualizacion!=9999 LIMIT 1) AS tran_11,
(SELECT COUNT(visualizacion) FROM core_permisos_listado WHERE Direccionbase ='".$trans_12."' AND visualizacion!=9999 LIMIT 1) AS tran_12

FROM usuarios_listado
WHERE usuarios_listado.idUsuario='".$_GET['id']."' "; 
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
$rowdatax = mysqli_fetch_assoc ($resultado);


$telemetria  = $rowdatax['tran_1'] + $rowdatax['tran_2'];
$bodega      = $rowdatax['tran_3'] + $rowdatax['tran_4'] + $rowdatax['tran_5'] + $rowdatax['tran_6'];
$ruta        = $rowdatax['tran_7'] + $rowdatax['tran_8'];
$trabajador  = $rowdatax['tran_9'];
$pasajeros   = $rowdatax['tran_10'];
$peonetas    = $rowdatax['tran_11'];
$colegios    = $rowdatax['tran_12'];

$todos = $telemetria + $bodega + $ruta + $trabajador + $pasajeros + $peonetas + $colegios;

$idTipoUsuario  = $_SESSION['usuario']['basic_data']['idTipoUsuario'];
?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Vehiculo</span>
				<span class="info-box-number">
					<?php echo $rowdata['Nombre']; 
					if(isset($rowdata['Patente'])&&$rowdata['Patente']!=''){
						echo ' Patente '.$rowdata['Patente'];
					} ?>
				</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Mantenciones</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'vehiculos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'vehiculos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos</a></li>
				<?php if($todos!=0 or $idTipoUsuario==1) { ?>
					<li class=""><a href="<?php echo 'vehiculos_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<?php } ?>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>			
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_1.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Telemetria</a></li>
						<?php }
						if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>	
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_2.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Bodega</a></li>
						<?php }
						if(isset($rowdata['idOpciones_3'])&&$rowdata['idOpciones_3']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_3.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Ruta</a></li>
						<?php }
						if(isset($rowdata['idOpciones_4'])&&$rowdata['idOpciones_4']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_4.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Conductor</a></li>
						<?php }
						if(isset($rowdata['idOpciones_5'])&&$rowdata['idOpciones_5']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_5.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Pasajeros</a></li>
						<?php }
						//Si se utiliza la APP 
						if(isset($rowdata['idOpciones_6'])&&$rowdata['idOpciones_6']==1){?>
							<li class=""><a href="<?php echo 'vehiculos_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Password APP</a></li>
						<?php }
						//Si se utilizan peonetas 
						if(isset($rowdata['idOpciones_7'])&&$rowdata['idOpciones_7']==1){?>
							<li class=""><a href="<?php echo 'vehiculos_listado_peonetas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Peonetas</a></li>
						<?php }
						//Si se utilizan colegios 
						if(isset($rowdata['idOpciones_8'])&&$rowdata['idOpciones_8']==1){?>
							<li class=""><a href="<?php echo 'vehiculos_listado_colegios.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Colegios</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'vehiculos_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Foto</a></li>
						
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_padron.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Padron</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_permiso_circulacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Permiso Circulacion</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_soap.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - SOAP</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_revision_tecnica.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Revision Tecnica</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_seguro_carga.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Seguro Carga</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_resolucion_sanitaria.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Resolucion Sanitaria</a></li>
						<li class="active"><a href="<?php echo 'vehiculos_listado_doc_mantencion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Mantenciones</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_trans_personas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivo - Cert. Transporte Personas</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				
				<?php if(isset($rowdata['doc_mantencion'])&&$rowdata['doc_mantencion']!=''){?>
        
					<div class="col-sm-10 fcenter">
						<h3>Archivo</h3>
						<p>Fecha de Vencimiento: <?php echo fecha_estandar($rowdata['doc_fecha_mantencion']); ?></p>
						<?php echo preview_docs('upload', $rowdata['doc_mantencion'], ''); ?>
					</div>
					
				<?php }?> 
				
				
				
			</div>
			
			
			
			
<div class="col-sm-12">
	<a href="<?php echo $new_location.'&id='.$_GET['id'].'&new_mant='.$_GET['id']; ?>" class="btn btn-default fright margin_width" style="margin-top:10px;margin-bottom:10px;"><i class="fa fa-file-o" aria-hidden="true"></i> Crear Mantencion</a>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Mantenciones</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre Archivo</th>
						<th>Fecha Vencimiento</th>
						<th>Fecha Ingreso</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								 
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTipoCliente as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['doc_mantencion']; ?></td>
						<td><?php echo fecha_estandar($tipo['doc_fecha_mantencion']); ?></td>
						<td><?php echo fecha_estandar($tipo['Fecha_ingreso']); ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$tipo['doc_mantencion']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
								<?php 
								$ubicacion = $new_location.'&del_doc_mantencion='.$tipo['idMantenciones'];
								$dialogo   = '¿Realmente deseas eliminar el documento '.$tipo['doc_mantencion'].'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>							
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
					
					
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
