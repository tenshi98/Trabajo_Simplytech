<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Maqueta</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<style>
			body {background-color: #FFF !important;}
		</style>
	</head>

	<body>
<?php 
/**********************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT  
prospectos_listado.email, 
prospectos_listado.Nombre, 
prospectos_listado.Rut, 
prospectos_listado.RazonSocial, 
prospectos_listado.fNacimiento, 
prospectos_listado.Direccion, 
prospectos_listado.Fono1, 
prospectos_listado.Fono2, 
prospectos_listado.Fax,
prospectos_listado.PersonaContacto,
prospectos_listado.PersonaContacto_Fono,
prospectos_listado.PersonaContacto_email,
prospectos_listado.Web,
prospectos_listado.Giro,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
prospectos_tipos.Nombre AS tipoProspecto,
core_rubros.Nombre AS Rubro,
usuarios_listado.Nombre AS prospectoVendedor,
prospectos_estado_fidelizacion.Nombre AS prospectoEstado,
prospectos_listado.F_Ingreso AS prospectoFecha,
prospectos_etapa.Nombre AS prospectoEtapa

FROM `prospectos_listado`
LEFT JOIN `core_estados`                    ON core_estados.idEstado                                = prospectos_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`           ON core_ubicacion_ciudad.idCiudad                       = prospectos_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`          ON core_ubicacion_comunas.idComuna                      = prospectos_listado.idComuna
LEFT JOIN `core_sistemas`                   ON core_sistemas.idSistema                              = prospectos_listado.idSistema
LEFT JOIN `prospectos_tipos`                ON prospectos_tipos.idTipo                              = prospectos_listado.idTipo
LEFT JOIN `core_rubros`                     ON core_rubros.idRubro                                  = prospectos_listado.idRubro
LEFT JOIN `usuarios_listado`                ON usuarios_listado.idUsuario                           = prospectos_listado.idUsuario
LEFT JOIN `prospectos_estado_fidelizacion`  ON prospectos_estado_fidelizacion.idEstadoFidelizacion  = prospectos_listado.idEstadoFidelizacion
LEFT JOIN `prospectos_etapa`                ON prospectos_etapa.idEtapa                             = prospectos_listado.idEtapa

WHERE prospectos_listado.idProspecto = {$_GET['view']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	

/**********************************************************/
// Se trae un listado con todas las observaciones el Prospecto
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
prospectos_observaciones.Fecha,
prospectos_observaciones.Observacion
FROM `prospectos_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = prospectos_observaciones.idUsuario
WHERE prospectos_observaciones.idProspecto = {$_GET['view']}
ORDER BY prospectos_observaciones.idObservacion ASC 
LIMIT 15 ";
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
array_push( $arrObservaciones,$row );
}

// Se trae un listado con todas las etapa el Prospecto
$arrEtapa = array();
$query = "SELECT 
prospectos_etapa_fidelizacion.idEtapaFide,
usuarios_listado.Nombre AS nombre_usuario,
prospectos_etapa_fidelizacion.Fecha,
prospectos_etapa.Nombre AS Etapa

FROM `prospectos_etapa_fidelizacion`
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario         = prospectos_etapa_fidelizacion.idUsuario
LEFT JOIN `prospectos_etapa`     ON prospectos_etapa.idEtapa           = prospectos_etapa_fidelizacion.idEtapa

WHERE prospectos_etapa_fidelizacion.idProspecto = {$_GET['view']}
ORDER BY prospectos_etapa.Nombre DESC ";
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
array_push( $arrEtapa,$row );
}




?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Prospecto</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<?php if(!empty($arrObservaciones)){ ?>
					<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>
				<?php } ?>
				<?php if(!empty($arrEtapa)){ ?>
					<li class=""><a href="#etapas" data-toggle="tab">Etapas</a></li>
				<?php } ?>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">
					
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th width="50%" class="word_break">Datos</th>
									<th width="50%">Mapa</th>
								</tr>
							</thead>
											  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd">
									<td class="word_break">
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Prospecto</h2>
										<p class="text-muted">
											<strong>Vendedor : </strong><?php echo $rowdata['prospectoVendedor']; ?><br/>
											<strong>Fecha de Registrado : </strong><?php echo Fecha_completa($rowdata['prospectoFecha']); ?><br/>
											<strong>Estado Fidelizacion: </strong><?php echo $rowdata['prospectoEstado']; ?><br/>
											<strong>Etapa Fidelizacion: </strong><?php echo $rowdata['prospectoEtapa']; ?>
										</p>
									
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
										<p class="text-muted">
											<strong>Tipo de Prospecto : </strong><?php echo $rowdata['tipoProspecto']; ?><br/>
											<strong>Nombre Fantasia: </strong><?php echo $rowdata['Nombre']; ?><br/>
											<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
											<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
											<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
											<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
											<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
											<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
										</p>
										
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Comerciales</h2>
										<p class="text-muted">
											<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
											<strong>Razon Social : </strong><?php echo $rowdata['RazonSocial']; ?><br/>
											<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
											<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?><br/>
										</p>
											
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
										<p class="text-muted">
											<strong>Telefono Fijo : </strong><?php echo $rowdata['Fono1']; ?><br/>
											<strong>Telefono Movil : </strong><?php echo $rowdata['Fono2']; ?><br/>
											<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
											<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
											<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="http://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
										</p>
										
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Persona de Contacto</h2>
										<p class="text-muted">
											<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
											<strong>Telefono : </strong><?php echo $rowdata['PersonaContacto_Fono']; ?><br/>
											<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
										</p>
										
									</td>
									<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
									if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
									echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']) ?>
									</td>
								</tr>                  
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<?php if(!empty($arrObservaciones)){ ?>
				<div class="tab-pane fade" id="observaciones">
					<div class="wmd-panel">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Autor</th>
										<th width="120">Fecha</th>
										<th>Observacion</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrObservaciones as $observaciones) { ?>
									<tr class="odd">		
										<td><?php echo $observaciones['nombre_usuario']; ?></td>
										<td><?php echo $observaciones['Fecha']; ?></td>		
										<td class="word_break"><?php echo $observaciones['Observacion']; ?></td>	
									</tr>
								<?php } ?>                    
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php if(!empty($arrEtapa)){ ?>
				<div class="tab-pane fade" id="etapas">
					<div class="wmd-panel">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th width="120">Fecha</th>
										<th>Autor</th>
										<th>Etapa</th>
										<th width="10">Acciones</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrEtapa as $etapa) { ?>
										<tr class="odd">		
											<td><?php echo fecha_estandar($etapa['Fecha']); ?></td>		
											<td><?php echo $etapa['nombre_usuario']; ?></td>
											<td><?php echo $etapa['Etapa']; ?></td>	
											<td>
												<div class="btn-group" style="width: 35px;" >
													<a href="<?php echo 'view_prospecto_etapa.php?view='.$etapa['idEtapaFide'].'&return=true'; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
												</div>
											</td>	
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
			
        </div>	
	</div>
</div>


<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

		
	</body>
</html>
