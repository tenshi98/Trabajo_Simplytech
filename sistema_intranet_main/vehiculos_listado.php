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
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){        $location .= "&Nombre=".$_GET['Nombre'];        $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){        $location .= "&idTipo=".$_GET['idTipo'];        $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['Marca']) && $_GET['Marca'] != ''){          $location .= "&Marca=".$_GET['Marca'];          $search .= "&Marca=".$_GET['Marca'];}
if(isset($_GET['Modelo']) && $_GET['Modelo'] != ''){        $location .= "&Modelo=".$_GET['Modelo'];        $search .= "&Modelo=".$_GET['Modelo'];}
if(isset($_GET['Patente']) && $_GET['Patente'] != ''){      $location .= "&Patente=".$_GET['Patente'];      $search .= "&Patente=".$_GET['Patente'];}
if(isset($_GET['idProceso']) && $_GET['idProceso'] != ''){  $location .= "&idProceso=".$_GET['idProceso'];  $search .= "&idProceso=".$_GET['idProceso'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/vehiculos_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Vehiculo Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Vehiculo Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Vehiculo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos del trabajador
$query = "SELECT 
vehiculos_listado.Direccion_img,

vehiculos_listado.Nombre,
vehiculos_listado.Marca,
vehiculos_listado.Modelo, 
vehiculos_listado.Num_serie, 
vehiculos_listado.AnoFab, 
vehiculos_listado.Patente, 
vehiculos_listado.Password,
vehiculos_listado.idOpciones_1, 
vehiculos_listado.idOpciones_2, 
vehiculos_listado.idOpciones_3, 
vehiculos_listado.idOpciones_4, 
vehiculos_listado.idOpciones_5,
vehiculos_listado.idOpciones_6, 
vehiculos_listado.idOpciones_7,
vehiculos_listado.idOpciones_8,
vehiculos_listado.Capacidad,
vehiculos_listado.MCubicos, 


vehiculos_listado.doc_mantencion,
vehiculos_listado.doc_padron,
vehiculos_listado.doc_permiso_circulacion,
vehiculos_listado.doc_resolucion_sanitaria,
vehiculos_listado.doc_revision_tecnica,
vehiculos_listado.doc_seguro_carga,
vehiculos_listado.doc_soap,
vehiculos_listado.doc_fecha_mantencion,
vehiculos_listado.doc_fecha_padron,
vehiculos_listado.doc_fecha_permiso_circulacion,
vehiculos_listado.doc_fecha_resolucion_sanitaria,
vehiculos_listado.doc_fecha_revision_tecnica,
vehiculos_listado.doc_fecha_seguro_carga,
vehiculos_listado.doc_fecha_soap,

core_sistemas.Nombre AS Sistema,
core_estados.Nombre AS Estado,
vehiculos_tipo.Nombre AS Tipo,
vehiculos_zonas.Nombre AS Zona,
telemetria_listado.Nombre AS Sensor,
bodegas_productos_listado.Nombre AS Bodega,
vehiculos_rutas.Nombre AS Ruta,
trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat,
trabajadores_listado.ApellidoMat AS TrabajadorApellidoMat,
core_estado_aprobacion_vehiculos.Nombre AS AprobacionEstado,
vehiculos_listado.Motivo AS AprobacionMotivo,
vehiculos_listado.idProceso,
vehiculos_tipo_carga.Nombre AS VehiculoTipoCarga

FROM `vehiculos_listado`
LEFT JOIN `core_sistemas`                      ON core_sistemas.idSistema                     = vehiculos_listado.idSistema
LEFT JOIN `core_estados`                       ON core_estados.idEstado                       = vehiculos_listado.idEstado
LEFT JOIN `vehiculos_tipo`                     ON vehiculos_tipo.idTipo                       = vehiculos_listado.idTipo
LEFT JOIN `vehiculos_zonas`                    ON vehiculos_zonas.idZona                      = vehiculos_listado.idZona
LEFT JOIN `telemetria_listado`                 ON telemetria_listado.idTelemetria             = vehiculos_listado.idTelemetria
LEFT JOIN `bodegas_productos_listado`          ON bodegas_productos_listado.idBodega          = vehiculos_listado.idBodega
LEFT JOIN `vehiculos_rutas`                    ON vehiculos_rutas.idRuta                      = vehiculos_listado.idRuta
LEFT JOIN `trabajadores_listado`               ON trabajadores_listado.idTrabajador           = vehiculos_listado.idTrabajador
LEFT JOIN `core_estado_aprobacion_vehiculos`   ON core_estado_aprobacion_vehiculos.idProceso  = vehiculos_listado.idProceso
LEFT JOIN `vehiculos_tipo_carga`               ON vehiculos_tipo_carga.idTipoCarga            = vehiculos_listado.idTipoCarga

WHERE vehiculos_listado.idVehiculo = {$_GET['id']}";
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
	
if(isset($rowdata['idOpciones_5'])&&$rowdata['idOpciones_5']==1){
	// Se trae un listado con todos los pasajeros
	$arrCargas = array();
	$query = "SELECT  
	apoderados_listado_hijos.Nombre, 
	apoderados_listado_hijos.ApellidoPat, 
	apoderados_listado_hijos.ApellidoMat,
	apoderados_listado_hijos.Direccion_img,
	core_sexo.Nombre AS Sexo,
	sistema_planes.Nombre AS PlanNombre,
	sistema_planes.Valor AS PlanValor

	FROM `apoderados_listado_hijos`
	LEFT JOIN `core_sexo`       ON core_sexo.idSexo       = apoderados_listado_hijos.idSexo
	LEFT JOIN `sistema_planes`  ON sistema_planes.idPlan  = apoderados_listado_hijos.idPlan
	WHERE apoderados_listado_hijos.idVehiculo = {$_GET['id']}
	ORDER BY apoderados_listado_hijos.idHijos ASC ";
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
	array_push( $arrCargas,$row );
	}
}
if(isset($rowdata['idOpciones_7'])&&$rowdata['idOpciones_7']==1){
	// Se trae un listado con todas las observaciones el cliente
	$arrPeonetas = array();
	$query = "SELECT idPeoneta, Nombre, ApellidoPat, ApellidoMat, Rut, Fecha
	FROM `vehiculos_listado_peonetas`
	WHERE idVehiculo = {$_GET['id']}
	ORDER BY ApellidoPat ASC, ApellidoMat ASC, Nombre ASC ";
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
	array_push( $arrPeonetas,$row );
	}
}


if(isset($rowdata['idOpciones_8'])&&$rowdata['idOpciones_8']==1){
	// Se trae un listado con todos los colegios
	$arrColegios = array();
	$query = "SELECT 
	colegios_listado.Nombre
	
	FROM `vehiculos_listado_colegios`
	LEFT JOIN `colegios_listado` ON colegios_listado.idColegio = vehiculos_listado_colegios.idColegio
	WHERE vehiculos_listado_colegios.idVehiculo = {$_GET['id']}
	ORDER BY colegios_listado.Nombre ASC ";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Usuario: ". $NombreUsr, 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
						
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrColegios,$row );
	}
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
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'vehiculos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
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
						<li class=""><a href="<?php echo 'vehiculos_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Foto</a></li>
						
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_padron.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Padron</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_permiso_circulacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Permiso Circulacion</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_soap.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >SOAP</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_revision_tecnica.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Revision Tecnica</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_seguro_carga.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Seguro Carga</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_resolucion_sanitaria.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resolucion Sanitaria</a></li>
						<li class=""><a href="<?php echo 'vehiculos_listado_doc_mantencion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Mantenciones</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/car_siluete.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Tipo : </strong><?php echo $rowdata['Tipo']; ?><br/>
							<strong>Marca : </strong><?php echo $rowdata['Marca']; ?><br/>
							<strong>Modelo : </strong><?php echo $rowdata['Modelo']; ?><br/>
							<strong>Numero de serie : </strong><?php echo $rowdata['Num_serie']; ?><br/>
							<strong>Año de Fabricacion : </strong><?php echo $rowdata['AnoFab']; ?><br/>
							<strong>Patente : </strong><?php echo $rowdata['Patente']; ?><br/>
							<strong>Sistema : </strong><?php echo $rowdata['Sistema']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?>
							<?php
							//se verifica si telemetria esta activo y se muestra
							if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){
								echo '<br/><strong>Sensor Telemetrico : </strong>'.$rowdata['Sensor'];
							}
							//se verifica si bodega esta activo y se muestra
							if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){
								echo '<br/><strong>Bodega : </strong>'.$rowdata['Bodega'];
							}
							//se verifica si ruta esta activo y se muestra
							if(isset($rowdata['idOpciones_3'])&&$rowdata['idOpciones_3']==1){
								echo '<br/><strong>Ruta : </strong>'.$rowdata['Ruta'];
							}
							//se verifica si trabajador esta activo y se muestra
							if(isset($rowdata['idOpciones_4'])&&$rowdata['idOpciones_4']==1){
								echo '<br/><strong>Trabajador asignado: </strong>'.$rowdata['TrabajadorNombre'].' '.$rowdata['TrabajadorApellidoPat'].' '.$rowdata['TrabajadorApellidoMat'];
							}
							//se verifica el estado de aprobacion
							if(isset($rowdata['AprobacionEstado'])&&$rowdata['AprobacionEstado']!=''){
								echo '<br/><strong>Proceso Aprobacion: </strong>'.$rowdata['AprobacionEstado'];
								if(isset($rowdata['idProceso'])&&$rowdata['idProceso']==3){echo ' ('.$rowdata['AprobacionMotivo'].')';}
							}?>
							
							
					
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Caracteristicos</h2>
						<p class="text-muted">
							<strong>Zona de Trabajo : </strong><?php echo $rowdata['Zona']; ?><br/>
							<strong>Capacidad (Kilos) : </strong><?php echo Cantidades_decimales_justos($rowdata['Capacidad']); ?><br/>
							<strong>Metros Cubicos (M3) : </strong><?php echo Cantidades_decimales_justos($rowdata['MCubicos']); ?><br/>
							<strong>Tipo de Carga : </strong><?php echo $rowdata['VehiculoTipoCarga']; ?><br/>
						</p>
						
						<?php if(isset($rowdata['idOpciones_6'])&&$rowdata['idOpciones_6']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de acceso a la APP</h2>
							<p class="text-muted">
								<strong>Usuario : </strong><?php echo $rowdata['Patente']; ?><br/>
								<strong>Password : </strong><?php echo $rowdata['Password']; ?><br/>
							</p>
						<?php } ?>

						<?php 
						//se verifica si se transportan personas
						if(isset($rowdata['idOpciones_5'])&&$rowdata['idOpciones_5']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Personas Transportadas</h2>
							<div class="row">
								<?php
								//Verifico el total de cargas
								$nn = 0;
								$n_carga = 1;
								foreach ($arrCargas as $carga) {
									$nn++;
								}
								//Se existen cargas estas se despliegan
								if($nn!=0){
									foreach ($arrCargas as $carga) { ?>
										<div class="col-md-6 col-sm-6 col-xs-12 fleft">
											<div class="info-box" style="box-shadow:none; color:#999 !important;">
												<span class="info-box-icon">
													 <img src="upload/<?php echo $carga['Direccion_img']; ?>" alt="hijo" height="100%" width="100%"> 
												</span>
												<div class="info-box-content">
													<span class="info-box-text"><?php echo $carga['Nombre'].' '.$carga['ApellidoPat'].' '.$carga['ApellidoMat']; ?></span>
													<span class="info-box-text"><?php echo $carga['Sexo']; ?></span>
													<span class="info-box-number"><?php echo $carga['PlanNombre']; ?></span>
												</div>
											</div>
										</div>
									
									<?php 
									}
								//si no existen cargas se muestra mensaje
								}else{
									echo '<p class="text-muted">Sin personas asignadas</p>';
								}
								?>	
							</div>		
							<div class="clearfix"></div>
						<?php } ?>
						
						<?php 
						//se verifica si se tiene peonetas
						if(isset($rowdata['idOpciones_7'])&&$rowdata['idOpciones_7']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Peonetas Asignados</h2>
							<p class="text-muted">
								<?php
								//Verifico el total de peonetas
								$nn     = 0;
								$n_peon = 1;
								foreach ($arrPeonetas as $peoneta) {
									$nn++;
								}
								//Se existen peonetas estas se despliegan
								if($nn!=0){
									foreach ($arrPeonetas as $peoneta) {
										echo '<strong>Peoneta #'.$n_peon.' : </strong>'.$peoneta['Nombre'].' '.$peoneta['ApellidoPat'].' '.$peoneta['ApellidoMat'].'<br/>';
										$n_peon++;
									}
								//si no existen peonetas se muestra mensaje
								}else{
									echo '<p class="text-muted">Sin peonetas asignados</p>';
								}
								?>	
							</p>
						<?php } ?>
						
						<?php if(isset($rowdata['idOpciones_8'])&&$rowdata['idOpciones_8']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Colegios Asignados</h2>
							<table id="items" style="margin-bottom: 20px;">
								<tbody>
									<?php foreach ($arrColegios as $colegio) { ?>
										<tr class="item-row">
											<td><?php $colegio['NombreColegio']; ?></td>
										</tr>
									<?php } ?> 	
								</tbody>
							</table>
						<?php } ?>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php 
								//Fecha ultima mantencion
								if(isset($rowdata['doc_mantencion'])&&$rowdata['doc_mantencion']!=''){
									echo '
										<tr class="item-row">
											<td>Fecha ultima mantencion (vence el '.fecha_estandar($rowdata['doc_fecha_mantencion']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_mantencion'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_mantencion'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Padron del Vehiculo
								if(isset($rowdata['doc_padron'])&&$rowdata['doc_padron']!=''){
									echo '
										<tr class="item-row">
											<td>Padron del Vehiculo (vence el '.fecha_estandar($rowdata['doc_fecha_padron']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_padron'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_padron'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Permiso de Circulacion
								if(isset($rowdata['doc_permiso_circulacion'])&&$rowdata['doc_permiso_circulacion']!=''){
									echo '
										<tr class="item-row">
											<td>Permiso de Circulacion (vence el '.fecha_estandar($rowdata['doc_fecha_permiso_circulacion']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_permiso_circulacion'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_permiso_circulacion'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Resolucion Sanitaria 
								if(isset($rowdata['doc_resolucion_sanitaria'])&&$rowdata['doc_resolucion_sanitaria']!=''){
									echo '
										<tr class="item-row">
											<td>Resolucion Sanitaria (vence el '.fecha_estandar($rowdata['doc_fecha_resolucion_sanitaria']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_resolucion_sanitaria'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_resolucion_sanitaria'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Revision tecnica
								if(isset($rowdata['doc_revision_tecnica'])&&$rowdata['doc_revision_tecnica']!=''){
									echo '
										<tr class="item-row">
											<td>Revision tecnica (vence el '.fecha_estandar($rowdata['doc_fecha_revision_tecnica']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_revision_tecnica'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_revision_tecnica'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Seguro de Carga
								if(isset($rowdata['doc_seguro_carga'])&&$rowdata['doc_seguro_carga']!=''){
									echo '
										<tr class="item-row">
											<td>Seguro de Carga (vence el '.fecha_estandar($rowdata['doc_fecha_seguro_carga']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_seguro_carga'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_seguro_carga'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Seguro SOAP 
								if(isset($rowdata['doc_soap'])&&$rowdata['doc_soap']!=''){
									echo '
										<tr class="item-row">
											<td>Seguro SOAP (vence el '.fecha_estandar($rowdata['doc_fecha_soap']).')</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['doc_soap'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['doc_soap'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								?>
							</tbody>
						</table>
						<?php require_once '../LIBS_js/modal/modal.php';?>	
							
							
										
					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Vehiculo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {       $x1  = $Nombre;       }else{$x1  = '';}
				if(isset($idTipo)) {       $x2  = $idTipo;       }else{$x2  = '';}
				if(isset($Marca)) {        $x3  = $Marca;        }else{$x3  = '';}
				if(isset($Modelo)) {       $x4  = $Modelo;       }else{$x4  = '';}
				if(isset($Patente)) {      $x5  = $Patente;      }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select('Tipo de Vehiculo','idTipo', $x2, 2, 'idTipo', 'Nombre', 'vehiculos_tipo', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Marca', 'Marca', $x3, 2);
				$Form_Imputs->form_input_text( 'Modelo', 'Modelo', $x4, 2);
				$Form_Imputs->form_input_text( 'Patente', 'Patente', $x5, 2);
				
				
		
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('idOpciones_1', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_2', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_3', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_4', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_5', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_6', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_7', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_8', 2, 2);
				$Form_Imputs->form_input_hidden('idProceso', 1, 2);
				
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
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
		case 'nombre_asc':    $order_by = 'ORDER BY vehiculos_listado.Nombre ASC ';                  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'ORDER BY vehiculos_listado.Nombre DESC ';                 $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'marca_asc':     $order_by = 'ORDER BY vehiculos_listado.Marca ASC ';                   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Marca Ascendente';break;
		case 'marca_desc':    $order_by = 'ORDER BY vehiculos_listado.Marca DESC ';                  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Marca Descendente';break;
		case 'modelo_asc':    $order_by = 'ORDER BY vehiculos_listado.Modelo ASC ';                  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Modelo Ascendente';break;
		case 'modelo_desc':   $order_by = 'ORDER BY vehiculos_listado.Modelo DESC ';                 $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Modelo Descendente';break;
		case 'tipo_asc':      $order_by = 'ORDER BY vehiculos_tipo.Nombre ASC ';                     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Ascendente';break;
		case 'tipo_desc':     $order_by = 'ORDER BY vehiculos_tipo.Nombre DESC ';                    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Descendente';break;
		case 'estado_asc':    $order_by = 'ORDER BY core_estados.Nombre ASC ';                       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'ORDER BY core_estados.Nombre DESC ';                      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'proceso_asc':   $order_by = 'ORDER BY core_estado_aprobacion_vehiculos.Nombre ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Proceso Ascendente';break;
		case 'proceso_desc':  $order_by = 'ORDER BY core_estado_aprobacion_vehiculos.Nombre DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Proceso Descendente';break;
		
		default: $order_by = 'ORDER BY vehiculos_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY vehiculos_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE vehiculos_listado.idVehiculo!=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND vehiculos_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){        $z .= " AND vehiculos_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){        $z .= " AND vehiculos_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['Marca']) && $_GET['Marca'] != ''){          $z .= " AND vehiculos_listado.Marca LIKE '%".$_GET['Marca']."%'";}
if(isset($_GET['Modelo']) && $_GET['Modelo'] != ''){        $z .= " AND vehiculos_listado.Modelo LIKE '%".$_GET['Modelo']."%'";}
if(isset($_GET['Patente']) && $_GET['Patente'] != ''){      $z .= " AND vehiculos_listado.Patente LIKE '%".$_GET['Patente']."%'";}
if(isset($_GET['idProceso']) && $_GET['idProceso'] != ''){  $z .= " AND vehiculos_listado.idProceso=".$_GET['idProceso'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idVehiculo FROM `vehiculos_listado` ".$z;
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
$arrTrabajador = array();
$query = "SELECT 
vehiculos_listado.idVehiculo,
vehiculos_listado.Nombre, 
vehiculos_listado.Marca, 
vehiculos_listado.Modelo,
vehiculos_tipo.Nombre AS Tipo,
core_sistemas.Nombre AS RazonSocial,
core_estados.Nombre AS Estado,
vehiculos_listado.idEstado,
core_estado_aprobacion_vehiculos.Nombre AS Proceso

FROM `vehiculos_listado`
LEFT JOIN `vehiculos_tipo`                     ON vehiculos_tipo.idTipo                       = vehiculos_listado.idTipo
LEFT JOIN `core_sistemas`                      ON core_sistemas.idSistema                     = vehiculos_listado.idSistema
LEFT JOIN `core_estados`                       ON core_estados.idEstado                       = vehiculos_listado.idEstado
LEFT JOIN `core_estado_aprobacion_vehiculos`   ON core_estado_aprobacion_vehiculos.idProceso  = vehiculos_listado.idProceso
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
array_push( $arrTrabajador,$row );
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
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Vehiculo</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {       $x1  = $Nombre;       }else{$x1  = '';}
				if(isset($idTipo)) {       $x2  = $idTipo;       }else{$x2  = '';}
				if(isset($Marca)) {        $x3  = $Marca;        }else{$x3  = '';}
				if(isset($Modelo)) {       $x4  = $Modelo;       }else{$x4  = '';}
				if(isset($Patente)) {      $x5  = $Patente;      }else{$x5  = '';}
				if(isset($idProceso)) {    $x6  = $idProceso;    }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				$Form_Imputs->form_select('Tipo de Vehiculo','idTipo', $x2, 1, 'idTipo', 'Nombre', 'vehiculos_tipo', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Marca', 'Marca', $x3, 1);
				$Form_Imputs->form_input_text( 'Modelo', 'Modelo', $x4, 1);
				$Form_Imputs->form_input_text( 'Patente', 'Patente', $x5, 1);
				$Form_Imputs->form_select('Proceso','idProceso', $x6, 1, 'idProceso', 'Nombre', 'core_estado_aprobacion_vehiculos', 0, '', $dbConn);
					
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 

                       
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Vehiculos</h5>
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
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Marca</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=marca_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=marca_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Modelo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=modelo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=modelo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tipo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
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
							<div class="pull-left">Proceso</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=proceso_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=proceso_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrTrabajador as $trab) { ?>
					<tr class="odd">
						<td><?php echo $trab['Nombre']; ?></td>
						<td><?php echo $trab['Marca']; ?></td>
						<td><?php echo $trab['Modelo']; ?></td>
						<td><?php echo $trab['Tipo']; ?></td>
						<td><label class="label <?php if(isset($trab['idEstado'])&&$trab['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $trab['Estado']; ?></label></td>
						<td><?php echo $trab['Proceso']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $trab['RazonSocial']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_vehiculos.php?view='.$trab['idVehiculo']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$trab['idVehiculo']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$trab['idVehiculo'];
									$dialogo   = '¿Realmente deseas eliminar el trabajador '.$trab['Nombre'].' '.$trab['Marca'].' '.$trab['Modelo'].'?';?>
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

<?php require_once '../LIBS_js/modal/modal.php';?>
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
