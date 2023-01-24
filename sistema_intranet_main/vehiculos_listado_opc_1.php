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
$original = "vehiculos_listado.php";
$location = $original;
$new_location = "vehiculos_listado_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//se agregan ubicaciones
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/vehiculos_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$query = "SELECT Nombre,Patente,idOpciones_1,idOpciones_2,idOpciones_3,idOpciones_4,idOpciones_5,
idOpciones_6, idOpciones_7, idOpciones_8, idTelemetria
FROM `vehiculos_listado`
WHERE idVehiculo = ".$_GET['id'];
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
//Verifico el tipo de usuario que esta ingresando
$w="idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND idEstado=1";

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

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php 
	$vehiculo = $rowdata['Nombre'];
	if(isset($rowdata['Patente'])&&$rowdata['Patente']!=''){
		$vehiculo .= ' Patente '.$rowdata['Patente'];
	}
	echo widget_title('bg-aqua', 'fa-cog', 100, 'Vehiculo', $vehiculo, 'Editar Sensor Telemetria');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'vehiculos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'vehiculos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<?php if($todos!=0 OR $idTipoUsuario==1){?>
					<li class=""><a href="<?php echo 'vehiculos_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<?php } ?>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<?php if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>		
							<li class="active"><a href="<?php echo 'vehiculos_listado_opc_1.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> Telemetria</a></li>
						<?php }
						if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_2.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-database" aria-hidden="true"></i> Bodega</a></li>
						<?php }
						if(isset($rowdata['idOpciones_3'])&&$rowdata['idOpciones_3']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_3.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> Ruta</a></li>
						<?php }
						if(isset($rowdata['idOpciones_4'])&&$rowdata['idOpciones_4']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_4.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-car" aria-hidden="true"></i> Conductor</a></li>
						<?php }
						if(isset($rowdata['idOpciones_5'])&&$rowdata['idOpciones_5']==1){ ?>
							<li class=""><a href="<?php echo 'vehiculos_listado_opc_5.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-users" aria-hidden="true"></i> Pasajeros</a></li>
						<?php }
						if(isset($rowdata['idOpciones_6'])&&$rowdata['idOpciones_6']==1){?>
							<li class=""><a href="<?php echo 'vehiculos_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password APP</a></li>
						<?php }
						//Si se utilizan peonetas 
						if(isset($rowdata['idOpciones_7'])&&$rowdata['idOpciones_7']==1){?>
							<li class=""><a href="<?php echo 'vehiculos_listado_peonetas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-users" aria-hidden="true"></i> Peonetas</a></li>
						<?php }
						//Si se utilizan colegios 
						if(isset($rowdata['idOpciones_8'])&&$rowdata['idOpciones_8']==1){?>
							<li class=""><a href="<?php echo 'vehiculos_listado_colegios.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-graduation-cap" aria-hidden="true"></i> Colegios</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'vehiculos_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-picture-o" aria-hidden="true"></i>  Foto</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_geocercas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> GeoCercas</a></li>
						
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_padron.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Padron</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_permiso_circulacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Permiso Circulacion</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_soap.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - SOAP</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_revision_tecnica.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Revision Tecnica</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_seguro_carga.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Seguro Carga</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_resolucion_sanitaria.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Resolucion Sanitaria</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_mantencion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Mantenciones</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_trans_personas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Cert. Transporte Personas</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_ficha.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivo - Ficha Tecnica</a></li>
						
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

					<?php 
					//Se verifican si existen los datos
					if(isset($idTelemetria)){     $x1  = $idTelemetria;      }else{$x1  = $rowdata['idTelemetria'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select('Equipo Telemetria','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);
					
					
					$Form_Inputs->form_input_hidden('idVehiculo', $_GET['id'], 2);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
