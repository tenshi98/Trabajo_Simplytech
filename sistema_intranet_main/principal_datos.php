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
if (isset($_GET['created'])){ $error['created'] = 'sucess/Perfil creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Perfil editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Perfil borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$SIS_query = '
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
usuarios_listado.Direccion_img';
$SIS_join  = '
LEFT JOIN `usuarios_tipos`           ON usuarios_tipos.idTipoUsuario      = usuarios_listado.idTipoUsuario
LEFT JOIN `core_ubicacion_ciudad`    ON core_ubicacion_ciudad.idCiudad    = usuarios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`   ON core_ubicacion_comunas.idComuna   = usuarios_listado.idComuna';
$SIS_where = 'usuarios_listado.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$rowdata = db_select_data (false, $SIS_query, 'usuarios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');


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
$SIS_where = 'usuarios_permisos.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'CategoriaNombre ASC, TransaccionNombre ASC';
$arrMenu = array();
$arrMenu = db_select_array (false, $SIS_query, 'usuarios_permisos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrMenu');

/**********************************/
//Permisos a sistemas
$SIS_query = 'core_sistemas.Nombre AS Sistema';
$SIS_join  = 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = usuarios_sistemas.idSistema';
$SIS_where = 'usuarios_sistemas.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'core_sistemas.Nombre ASC';
$arrSistemas = array();
$arrSistemas = db_select_array (false, $SIS_query, 'usuarios_sistemas', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrSistemas');

/**********************************/
//Permisos a bodegas
$SIS_query = 'bodegas_arriendos_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `bodegas_arriendos_listado` ON bodegas_arriendos_listado.idBodega = usuarios_bodegas_arriendos.idBodega';
$SIS_where = 'usuarios_bodegas_arriendos.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'bodegas_arriendos_listado.Nombre ASC';
$arrBodega1 = array();
$arrBodega1 = db_select_array (false, $SIS_query, 'usuarios_bodegas_arriendos',  $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrBodega1');

/**********************************/
$SIS_query = 'bodegas_insumos_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `bodegas_insumos_listado` ON bodegas_insumos_listado.idBodega = usuarios_bodegas_insumos.idBodega';
$SIS_where = 'usuarios_bodegas_insumos.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'bodegas_insumos_listado.Nombre ASC';
$arrBodega2 = array();
$arrBodega2 = db_select_array (false, $SIS_query, 'usuarios_bodegas_insumos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrBodega2');

/**********************************/
$SIS_query = 'bodegas_productos_listado.Nombre AS Bodega	';
$SIS_join  = 'LEFT JOIN `bodegas_productos_listado` ON bodegas_productos_listado.idBodega = usuarios_bodegas_productos.idBodega';
$SIS_where = 'usuarios_bodegas_productos.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'bodegas_productos_listado.Nombre ASC';
$arrBodega3 = array();
$arrBodega3 = db_select_array (false, $SIS_query, 'usuarios_bodegas_productos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrBodega3');

/**********************************/
//Permisos a equipos telemetria
$SIS_query = 'telemetria_listado.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = usuarios_equipos_telemetria.idTelemetria';
$SIS_where = 'usuarios_equipos_telemetria.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'telemetria_listado.Nombre ASC';
$arrTelemetria = array();
$arrTelemetria = db_select_array (false, $SIS_query, 'usuarios_equipos_telemetria', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrTelemetria');

/**********************************/
//Permisos de vista de los documentos
$SIS_query = 'sistema_documentos_pago.Nombre AS Bodega';
$SIS_join  = 'LEFT JOIN `sistema_documentos_pago` ON sistema_documentos_pago.idDocPago = usuarios_documentos_pago.idDocPago';
$SIS_where = 'usuarios_documentos_pago.idUsuario ='.$_SESSION['usuario']['basic_data']['idUsuario'];
$SIS_order = 'sistema_documentos_pago.Nombre ASC';
$arrDocumento = array();
$arrDocumento = db_select_array (false, $SIS_query, 'usuarios_documentos_pago', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrDocumento');

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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Perfil', $_SESSION['usuario']['basic_data']['Nombre'], 'Resumen');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'principal_datos.php';?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'principal_datos_datos.php';?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Personales</a></li>
				<li class=""><a href="<?php echo 'principal_datos_imagen.php';?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Cambiar Imagen</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'principal_datos_password.php';?>" ><i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña</a></li>
						<?php if($Count_pagos!=0){ ?>
							<li class=""><a href="<?php echo 'principal_datos_documentos_pago.php'?>" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Documentos Pago</a></li>
						<?php } ?>
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos" style="padding-top:5px;">
				
				<div class="col-sm-4">
					<?php if ($rowdata['Direccion_img']=='') { ?>
						<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/usr.png">
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
						<strong>Fono : </strong><?php echo formatPhone($rowdata['Fono']); ?><br/>
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
				
				<?php if($arrMenu!=false && !empty($arrMenu) && $arrMenu!=''){ ?>
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
					}?>
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
