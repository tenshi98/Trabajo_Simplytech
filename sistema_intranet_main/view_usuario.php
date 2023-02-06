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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){
		$X_Puntero = $_GET['view'];
	} else {
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
// consulto los datos
$SIS_query = '
usuarios_listado.usuario,
usuarios_tipos.Nombre AS tipo,
usuarios_listado.email,
usuarios_listado.Nombre,
usuarios_listado.Rut,
usuarios_listado.fNacimiento,
usuarios_listado.Direccion,
usuarios_listado.Fono,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
usuarios_listado.Ultimo_acceso,
usuarios_listado.Direccion_img,
core_estados.Nombre AS estado';
$SIS_join  = '
LEFT JOIN `core_estados`             ON core_estados.idEstado             = usuarios_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`    ON core_ubicacion_ciudad.idCiudad    = usuarios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   ON core_ubicacion_comunas.idComuna   = usuarios_listado.idComuna
LEFT JOIN `usuarios_tipos`           ON usuarios_tipos.idTipoUsuario      = usuarios_listado.idTipoUsuario';
$SIS_where = 'idUsuario ='.$X_Puntero;
$rowdata = db_select_data (false, $SIS_query, 'usuarios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');

//Traigo un listado con todos sus accesos de sistema
$SIS_query = 'Fecha, Hora';
$SIS_join  = '';
$SIS_where = 'idUsuario ='.$X_Puntero;
$SIS_order = 'idAcceso DESC LIMIT 13';
$arrAccess = array();
$arrAccess = db_select_array (false, $SIS_query, 'usuarios_accesos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrAccess');

// consulto los datos
$SIS_query = '
usuario_evaluador.Nombre AS nombre_usuario,
usuarios_observaciones.Fecha,
usuarios_observaciones.Observacion';
$SIS_join  = 'LEFT JOIN `usuarios_listado` usuario_evaluador  ON usuario_evaluador.idUsuario = usuarios_observaciones.idUsuario';
$SIS_where = 'usuarios_observaciones.idUsuario_observado ='.$X_Puntero;
$SIS_order = 'usuarios_observaciones.idObservacion ASC LIMIT 13';
$arrObservaciones = array();
$arrObservaciones = db_select_array (false, $SIS_query, 'usuarios_observaciones', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrObservaciones');

/**********************************/
//Permisos asignados
$SIS_query = '
core_permisos_categorias.Nombre AS CategoriaNombre,
core_font_awesome.Codigo AS CategoriaIcono,
core_permisos_listado.Direccionbase AS TransaccionURLBase,
core_permisos_listado.Direccionweb AS TransaccionURL,
core_permisos_listado.Nombre AS TransaccionNombre,
usuarios_permisos.level';
$SIS_join  = '
INNER JOIN core_permisos_listado      ON core_permisos_listado.idAdmpm        = usuarios_permisos.idAdmpm
INNER JOIN core_permisos_categorias   ON core_permisos_categorias.id_pmcat    = core_permisos_listado.id_pmcat
LEFT JOIN `core_font_awesome`         ON core_font_awesome.idFont             = core_permisos_categorias.idFont';
$SIS_where = 'usuarios_permisos.idUsuario ='.$X_Puntero;
$SIS_order = 'CategoriaNombre ASC, TransaccionNombre ASC';
$arrMenu = array();
$arrMenu = db_select_array (false, $SIS_query, 'usuarios_permisos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrMenu');

/**********************************/
//Permisos a sistemas
$SIS_query = 'core_sistemas.Nombre AS Sistema	';
$SIS_join  = 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = usuarios_sistemas.idSistema';
$SIS_where = 'usuarios_sistemas.idUsuario ='.$X_Puntero;
$SIS_order = 'core_sistemas.Nombre ASC';
$arrSistemas = array();
$arrSistemas = db_select_array (false, $SIS_query, 'usuarios_sistemas',$SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrSistemas');

/**********************************/
//Permisos a bodegas
$SIS_query = 'bodegas_arriendos_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `bodegas_arriendos_listado` ON bodegas_arriendos_listado.idBodega = usuarios_bodegas_arriendos.idBodega';
$SIS_where = 'usuarios_bodegas_arriendos.idUsuario ='.$X_Puntero;
$SIS_order = 'bodegas_arriendos_listado.Nombre ASC';
$arrBodega1 = array();
$arrBodega1 = db_select_array (false, $SIS_query, 'usuarios_bodegas_arriendos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrBodega1');

$SIS_query = 'bodegas_insumos_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `bodegas_insumos_listado` ON bodegas_insumos_listado.idBodega = usuarios_bodegas_insumos.idBodega';
$SIS_where = 'usuarios_bodegas_insumos.idUsuario ='.$X_Puntero;
$SIS_order = 'bodegas_insumos_listado.Nombre ASC';
$arrBodega2 = array();
$arrBodega2 = db_select_array (false, $SIS_query, 'usuarios_bodegas_insumos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrBodega2');

$SIS_query = 'bodegas_productos_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `bodegas_productos_listado` ON bodegas_productos_listado.idBodega = usuarios_bodegas_productos.idBodega';
$SIS_where = 'usuarios_bodegas_productos.idUsuario ='.$X_Puntero;
$SIS_order = 'bodegas_productos_listado.Nombre ASC';
$arrBodega3 = array();
$arrBodega3 = db_select_array (false, $SIS_query, 'usuarios_bodegas_productos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrBodega3');

/**********************************/
//Permisos a equipos telemetria
$SIS_query = 'telemetria_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = usuarios_equipos_telemetria.idTelemetria';
$SIS_where = 'usuarios_equipos_telemetria.idUsuario ='.$X_Puntero;
$SIS_order = 'telemetria_listado.Nombre ASC';
$arrTelemetria = array();
$arrTelemetria = db_select_array (false, $SIS_query, 'usuarios_equipos_telemetria', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrTelemetria');

/**********************************/
//Permisos de vista de los documentos
$SIS_query = 'sistema_documentos_pago.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `sistema_documentos_pago` ON sistema_documentos_pago.idDocPago = usuarios_documentos_pago.idDocPago';
$SIS_where = 'usuarios_documentos_pago.idUsuario ='.$X_Puntero;
$SIS_order = 'sistema_documentos_pago.Nombre ASC';
$arrDocumento = array();
$arrDocumento = db_select_array (false, $SIS_query, 'usuarios_documentos_pago', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrDocumento');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="#ingresos" data-toggle="tab"><i class="fa fa-sign-in" aria-hidden="true"></i> Ingresos al Sistema</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab"><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
			</ul>
		</header>
        <div class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/usr.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Perfil</h2>
						<p class="text-muted">
							<strong>Usuario : </strong><?php echo $rowdata['usuario']; ?><br/>
							<strong>Tipo de usuario : </strong><?php echo $rowdata['tipo']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['estado']; ?><br/>
							<strong>Ultimo Acceso : </strong><?php echo $rowdata['Ultimo_acceso']; ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Personales</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Fono : </strong><?php echo formatPhone($rowdata['Fono']); ?><br/>
							<strong>Email : </strong><?php echo $rowdata['email']; ?><br/>
							<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
							<strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
							<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
							<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
							<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Sistemas Asignados</h2>
						<p class="text-muted">
							<?php foreach($arrSistemas as $sis) { ?>
								<strong><?php echo ' - '.$sis['Sistema']; ?></strong><br/>
							<?php } ?>
						</p>
					</div>
					<?php if($arrMenu!=false && !empty($arrMenu) && $arrMenu!=''){ ?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Permisos Asignados</h2>
							
							<ul class="tree">
								<?php
								filtrar($arrMenu, 'CategoriaNombre');
								foreach($arrMenu as $menu=>$productos) {
									echo '
										<li>
											<div class="blum">
												<div class="pull-left"><i class="'.$productos[0]['CategoriaIcono'].'"></i> '.TituloMenu($menu).'</div>
												<div class="clearfix"></div>
											</div>
											<ul style="padding-left: 20px;">';
									foreach($productos as $producto) {
										echo '
											<li>
												<div class="blum">
													<div class="pull-left"><i class="'.$producto['CategoriaIcono'].'"></i> '.TituloMenu($producto['TransaccionNombre']).'</div>
													<div class="clearfix"></div>
												</div>
											</li>';
									}
									echo '</ul>
									</li>';
								}
								?>			
							</ul>
						</div>
					<?php } ?>
					
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						
						<?php
						
							echo '<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Permisos a Bodegas</h2>';
							echo '<ul class="tree">';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-cubes" aria-hidden="true"></i> Bodegas de Arriendo</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
												
							foreach($arrBodega1 as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-cubes" aria-hidden="true"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-cubes" aria-hidden="true"></i> Bodegas de Insumos</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
							foreach($arrBodega2 as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-cubes" aria-hidden="true"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-cubes" aria-hidden="true"></i> Bodegas de Productos</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
							foreach($arrBodega3 as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-cubes" aria-hidden="true"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							echo '</ul>';
						
						/***************************************************************/
						if($arrTelemetria!=false && !empty($arrTelemetria) && $arrTelemetria!=''){
							echo '<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Permisos a Equipos Telemetria</h2>';
							echo '<ul class="tree">';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-bullseye" aria-hidden="true"></i> Equipos</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
												
							foreach($arrTelemetria as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-bullseye" aria-hidden="true"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							echo '</ul>';
						}
						/***************************************************************/
						if($arrDocumento!=false && !empty($arrDocumento) && $arrDocumento!=''){
							echo '<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Documentos a ver</h2>';
							echo '<ul class="tree">';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Documentos seleccionados</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
												
							foreach($arrDocumento as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-shopping-cart" aria-hidden="true"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							echo '</ul>';
						} ?>
					</div>
			
				</div>
			</div>
			
			<div class="tab-pane fade" id="ingresos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Fecha de ingreso</th>
									<th>Hora</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrAccess as $accesos) { ?>
									<tr class="odd">
										<td><?php echo Fecha_estandar($accesos['Fecha']); ?></td>
										<td><?php echo $accesos['Hora']; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="observaciones">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Autor</th>
									<th>Fecha</th>
									<th>Observacion</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrObservaciones as $observaciones){ ?>
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
			
        </div>
	</div>
</div>

<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }
} ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
