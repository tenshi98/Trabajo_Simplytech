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
$original = "principal_datos.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Perfil creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Perfil editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Perfil borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

// Se traen todos los datos de mi usuario
$query = "SELECT 
usuarios_listado.usuario, 
usuarios_tipos.Nombre AS Usuario_Tipo,
usuarios_listado.email, 
usuarios_listado.Nombre, 
usuarios_listado.Rut, 
usuarios_listado.fNacimiento, 
usuarios_listado.Direccion, 
usuarios_listado.Fono, 
core_ubicacion_ciudad.Nombre AS Ciudad, 
core_ubicacion_comunas.Nombre AS Comuna,
usuarios_listado.Direccion_img
FROM `usuarios_listado`
LEFT JOIN `usuarios_tipos`           ON usuarios_tipos.idTipoUsuario      = usuarios_listado.idTipoUsuario
LEFT JOIN `core_ubicacion_ciudad`    ON core_ubicacion_ciudad.idCiudad    = usuarios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   ON core_ubicacion_comunas.idComuna   = usuarios_listado.idComuna
WHERE idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}";
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

/**********************************/
//Permisos asignados
$arrMenu = array();
$query = "SELECT 
core_permisos_categorias.Nombre AS CategoriaNombre, 
core_font_awesome.Codigo AS CategoriaIcono,
core_permisos_listado.Direccionbase AS TransaccionURLBase,
core_permisos_listado.Direccionweb AS TransaccionURL, 
core_permisos_listado.Nombre AS TransaccionNombre,
							
usuarios_permisos.level
							
							
FROM usuarios_permisos 
INNER JOIN core_permisos_listado      ON core_permisos_listado.idAdmpm        = usuarios_permisos.idAdmpm
INNER JOIN core_permisos_categorias   ON core_permisos_categorias.id_pmcat    = core_permisos_listado.id_pmcat 
LEFT JOIN `core_font_awesome`         ON core_font_awesome.idFont             = core_permisos_categorias.idFont
WHERE usuarios_permisos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY CategoriaNombre, TransaccionNombre ASC";
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
array_push( $arrMenu,$row );
}
/**********************************/
//Permisos a sistemas
$arrSistemas = array();
$query = "SELECT 
core_sistemas.Nombre AS Sistema						
FROM usuarios_sistemas
LEFT JOIN `core_sistemas`  ON core_sistemas.idSistema  = usuarios_sistemas.idSistema
WHERE usuarios_sistemas.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY core_sistemas.Nombre";
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
array_push( $arrSistemas,$row );
}
/**********************************/
//Permisos a bodegas
$arrBodega1 = array();
$query = "SELECT 
bodegas_arriendos_listado.Nombre AS Bodega						
FROM usuarios_bodegas_arriendos
LEFT JOIN `bodegas_arriendos_listado`  ON bodegas_arriendos_listado.idBodega  = usuarios_bodegas_arriendos.idBodega
WHERE usuarios_bodegas_arriendos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY bodegas_arriendos_listado.Nombre";
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
array_push( $arrBodega1,$row );
}
$arrBodega2 = array();
$query = "SELECT 
bodegas_insumos_listado.Nombre AS Bodega						
FROM usuarios_bodegas_insumos
LEFT JOIN `bodegas_insumos_listado`  ON bodegas_insumos_listado.idBodega  = usuarios_bodegas_insumos.idBodega
WHERE usuarios_bodegas_insumos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY bodegas_insumos_listado.Nombre";
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
array_push( $arrBodega2,$row );
}
$arrBodega3 = array();
$query = "SELECT 
bodegas_productos_listado.Nombre AS Bodega						
FROM usuarios_bodegas_productos
LEFT JOIN `bodegas_productos_listado`  ON bodegas_productos_listado.idBodega  = usuarios_bodegas_productos.idBodega
WHERE usuarios_bodegas_productos.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY bodegas_productos_listado.Nombre";
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
array_push( $arrBodega3,$row );
}
/**********************************/
//Permisos a equipos telemetria
$arrTelemetria = array();
$query = "SELECT 
telemetria_listado.Nombre AS Bodega						
FROM usuarios_equipos_telemetria
LEFT JOIN `telemetria_listado`  ON telemetria_listado.idTelemetria  = usuarios_equipos_telemetria.idTelemetria
WHERE usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY telemetria_listado.Nombre";
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
array_push( $arrTelemetria,$row );
}
/**********************************/
//Permisos de vista de los documentos
$arrDocumento = array();
$query = "SELECT 
sistema_documentos_pago.Nombre AS Bodega						
FROM usuarios_documentos_pago
LEFT JOIN `sistema_documentos_pago`  ON sistema_documentos_pago.idDocPago  = usuarios_documentos_pago.idDocPago
WHERE usuarios_documentos_pago.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario']."
ORDER BY sistema_documentos_pago.Nombre";
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
array_push( $arrDocumento,$row );
}
/*************************************************/
//permisos a las transacciones
$trans[1] = "pago_masivo_cliente.php";           //Pagos clientes
$trans[2] = "pago_masivo_proveedor.php";         //Pagos Proveedores
$trans[3] = "pago_masivo_cliente_reversa.php";   //Reversa Pagos clientes
$trans[4] = "pago_masivo_proveedor_reversa.php"; //Reversa Pagos Proveedores

//Genero los permisos
for ($i = 1; $i <= 4; $i++) {
	//Seteo la variable a 0
	$prm_x[$i] = 0;
	//recorro los permisos
	if(isset($_SESSION['usuario']['menu'])){
		foreach($_SESSION['usuario']['menu'] as $menu=>$productos) {
			foreach($productos as $producto) {
				//elimino los datos extras
				$str = str_replace("?pagina=1", "", $producto['TransaccionURL']);
				//le asigno el valor 1 en caso de que exista
				if($trans[$i]==$str){
					$prm_x[$i] = 1;
				}
			}
		}
	}
}
//verifico permisos
$Count_pagos = $prm_x[1] + $prm_x[2] + $prm_x[3] + $prm_x[4];	


?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Perfil</span>
				<span class="info-box-number"><?php echo $_SESSION['usuario']['basic_data']['Nombre']; ?></span>

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
				<li class="active"><a href="<?php echo 'principal_datos.php';?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'principal_datos_datos.php';?>" >Datos Personales</a></li>
				<li class=""><a href="<?php echo 'principal_datos_imagen.php';?>" >Cambiar Imagen</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'principal_datos_password.php';?>" >Cambiar Contraseña</a></li>
						<?php if($Count_pagos!=0){ ?>
							<li class=""><a href="<?php echo 'principal_datos_documentos_pago.php'?>" >Documentos Pago</a></li>
						<?php } ?>
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos" style="padding-top:5px;">
				
				<div class="col-sm-4">
					<?php if ($rowdata['Direccion_img']=='') { ?>
						<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/usr.png">
					<?php }else{  ?>
						<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
					<?php }?>
				</div>
				<div class="col-sm-8">
					<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Perfil</h2>
					<p class="text-muted">
						<strong>Usuario : </strong><?php echo $rowdata['usuario']; ?><br/>
						<strong>Tipo de usuario : </strong><?php echo $rowdata['Usuario_Tipo']; ?>
					</p>
					
					<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Personales</h2>
					<p class="text-muted">
						<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
						<strong>Fono : </strong><?php echo $rowdata['Fono']; ?><br/>
						<strong>Email : </strong><?php echo $rowdata['email']; ?><br/>
						<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
						<strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
						<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
						<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
						<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
					</p>
						
					<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Sistemas Asignados</h2>
					<p class="text-muted">
						<?php foreach($arrSistemas as $sis) { ?>
							<strong><?php echo ' - '.$sis['Sistema']; ?></strong><br/>
						<?php } ?>
					</p>
				</div>	
				
				
				<?php if(!empty($arrMenu)){ ?>
						<div class="col-sm-6">
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
					
					<div class="col-sm-6">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Permisos a Bodegas</h2>
						<?php
						echo '<ul class="tree">';
						/*******************************/
						echo '
							<li>
								<div class="blum">
									<div class="pull-left"><i class="fa fa-cubes"></i> Bodegas de Arriendo</div>
									<div class="clearfix"></div>
								</div>
								<ul style="padding-left: 20px;">';
											
						foreach($arrBodega1 as $bod) {
							echo '
							<li>
								<div class="blum">
									<div class="pull-left"><i class="fa fa-cubes"></i> '.$bod['Bodega'].'</div>
									<div class="clearfix"></div>
								</div>
							</li>';
						}
						echo '</ul></li>';
						/*******************************/
						echo '
							<li>
								<div class="blum">
									<div class="pull-left"><i class="fa fa-cubes"></i> Bodegas de Insumos</div>
									<div class="clearfix"></div>
								</div>
								<ul style="padding-left: 20px;">';
						foreach($arrBodega2 as $bod) {
							echo '
							<li>
								<div class="blum">
									<div class="pull-left"><i class="fa fa-cubes"></i> '.$bod['Bodega'].'</div>
									<div class="clearfix"></div>
								</div>
							</li>';
						}
						echo '</ul></li>';
						/*******************************/
						echo '
							<li>
								<div class="blum">
									<div class="pull-left"><i class="fa fa-cubes"></i> Bodegas de Productos</div>
									<div class="clearfix"></div>
								</div>
								<ul style="padding-left: 20px;">';
						foreach($arrBodega3 as $bod) {
							echo '
							<li>
								<div class="blum">
									<div class="pull-left"><i class="fa fa-cubes"></i> '.$bod['Bodega'].'</div>
									<div class="clearfix"></div>
								</div>
							</li>';
						}
						echo '</ul></li>';
						echo '</ul>';
						/***************************************************************/
						if(!empty($arrTelemetria)){
							echo '<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Permisos a Equipos Telemetria</h2>';
							echo '<ul class="tree">';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-bullseye"></i> Equipos</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
												
							foreach($arrTelemetria as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-bullseye"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							echo '</ul>';
						}
						/***************************************************************/
						if(!empty($arrDocumento)){
							echo '<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Documentos a ver</h2>';
							echo '<ul class="tree">';
							/*******************************/
							echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-shopping-cart"></i> Documentos seleccionados</div>
										<div class="clearfix"></div>
									</div>
									<ul style="padding-left: 20px;">';
												
							foreach($arrDocumento as $bod) {
								echo '
								<li>
									<div class="blum">
										<div class="pull-left"><i class="fa fa-shopping-cart"></i> '.$bod['Bodega'].'</div>
										<div class="clearfix"></div>
									</div>
								</li>';
							}
							echo '</ul></li>';
							echo '</ul>';
						}
						
						
						
						?>
					</div>
				
				
			</div>
        </div>	
	</div>
</div>



<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
