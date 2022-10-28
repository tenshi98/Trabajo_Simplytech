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
$original = "admin_datos.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$SIS_query = '
core_sistemas.Nombre,  
core_sistemas.Rut, 
core_ubicacion_ciudad.Nombre AS Ciudad, 
core_ubicacion_comunas.Nombre AS Comuna, 
core_sistemas.Direccion, 
core_sistemas.Contacto_Nombre, 
core_sistemas.Contacto_Fono1, 
core_sistemas.Contacto_Fono2, 
core_sistemas.Contacto_Fax, 
core_sistemas.Contacto_Web, 
core_sistemas.email_principal, 
core_sistemas.Contrato_Nombre, 
core_sistemas.Contrato_Numero, 
core_sistemas.Contrato_Fecha, 
core_sistemas.Contrato_Duracion,
core_sistemas.Config_IDGoogle,
core_theme_colors.Nombre AS Tema,
bodegas_productos_listado.Nombre AS BodegaProd,
bodegas_insumos_listado.Nombre AS BodegaIns,
core_sistemas.Rubro,
socialUso.Nombre AS SocialUso,
core_sistemas.Social_idUso,
core_sistemas.Social_facebook,
core_sistemas.Social_twitter,
core_sistemas.Social_instagram,
core_sistemas.Social_linkedin,
core_sistemas.Social_rss,
core_sistemas.Social_youtube,
core_sistemas.Social_tumblr';
$SIS_join  = '
LEFT JOIN `core_theme_colors`                  ON core_theme_colors.idTheme            = core_sistemas.Config_idTheme
LEFT JOIN `core_ubicacion_ciudad`              ON core_ubicacion_ciudad.idCiudad       = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`             ON core_ubicacion_comunas.idComuna      = core_sistemas.idComuna
LEFT JOIN `bodegas_productos_listado`          ON bodegas_productos_listado.idBodega   = core_sistemas.OT_idBodegaProd
LEFT JOIN `bodegas_insumos_listado`            ON bodegas_insumos_listado.idBodega     = core_sistemas.OT_idBodegaIns
LEFT JOIN `core_sistemas_opciones`  socialUso  ON socialUso.idOpciones                 = core_sistemas.Social_idUso';
$SIS_where = 'core_sistemas.idSistema = '.$_SESSION['usuario']['basic_data']['idSistema'];
$rowdata = db_select_data (false, $SIS_query, 'core_sistemas', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

/******************************************************/
//Accesos a bodegas de productos
$trans_1 = "bodegas_productos_egreso.php";
$trans_2 = "bodegas_productos_ingreso.php";
$trans_3 = "bodegas_productos_simple_stock.php";
$trans_4 = "bodegas_productos_stock.php";
$trans_5 = "productores_listado.php";

//Accesos a bodegas de insumos
$trans_11 = "bodegas_insumos_egreso.php";
$trans_12 = "bodegas_insumos_ingreso.php";
$trans_13 = "bodegas_insumos_simple_stock.php";
$trans_14 = "bodegas_insumos_stock.php";
$trans_15 = "insumos_listado.php";

//Accesos a Ordenes de Trabajo
$trans_21 = "orden_trabajo_crear.php";
$trans_22 = "orden_trabajo_terminar.php";

//Accesos a Ordenes de Compra
$trans_26 = "ocompra_generacion.php";
$trans_27 = "ocompra_listado_sin_aprobar.php";

//Accesos al sistema cross
$trans_31 = "sistema_variedades_categorias.php";
$trans_32 = "sistema_variedades_tipo.php";
$trans_33 = "variedades_listado.php";
$trans_34 = "cross_quality_registrar_inspecciones.php";
$trans_35 = "cross_shipping_consolidacion.php";
$trans_36 = "cross_shipping_consolidacion_aprobar.php";
$trans_37 = "cross_shipping_consolidacion_aprobar_auto.php";


/************************************/
//realizo la consulta
$SIS_query = '
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_1."'  AND visualizacion!=9999 LIMIT 1) AS tran_1,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_2."'  AND visualizacion!=9999 LIMIT 1) AS tran_2,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_3."'  AND visualizacion!=9999 LIMIT 1) AS tran_3,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_4."'  AND visualizacion!=9999 LIMIT 1) AS tran_4,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_5."'  AND visualizacion!=9999 LIMIT 1) AS tran_5,

(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_11."'  AND visualizacion!=9999 LIMIT 1) AS tran_11,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_12."'  AND visualizacion!=9999 LIMIT 1) AS tran_12,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_13."'  AND visualizacion!=9999 LIMIT 1) AS tran_13,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_14."'  AND visualizacion!=9999 LIMIT 1) AS tran_14,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_15."'  AND visualizacion!=9999 LIMIT 1) AS tran_15,

(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_21."'  AND visualizacion!=9999 LIMIT 1) AS tran_21,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_22."'  AND visualizacion!=9999 LIMIT 1) AS tran_22,

(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_26."'  AND visualizacion!=9999 LIMIT 1) AS tran_26,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_27."'  AND visualizacion!=9999 LIMIT 1) AS tran_27,

(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_31."'  AND visualizacion!=9999 LIMIT 1) AS tran_31,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_32."'  AND visualizacion!=9999 LIMIT 1) AS tran_32,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_33."'  AND visualizacion!=9999 LIMIT 1) AS tran_33,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_34."'  AND visualizacion!=9999 LIMIT 1) AS tran_34,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_35."'  AND visualizacion!=9999 LIMIT 1) AS tran_35,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_36."'  AND visualizacion!=9999 LIMIT 1) AS tran_36,
(SELECT COUNT(idAdmpm) FROM core_permisos_listado WHERE Direccionbase ='".$trans_37."'  AND visualizacion!=9999 LIMIT 1) AS tran_37,

idUsuario';
$SIS_join  = '';
$SIS_where = 'usuarios_listado.idUsuario=1';
$rowdata_x = db_select_data (false, $SIS_query, 'usuarios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata_x');

//verifico que sea un administrador
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	//Totales de los permisos que se pueden acceder
	$Count_productos    = 1;
	$Count_insumos      = 1;
	$Count_OT           = 1;
	$Count_OC           = 1;
	$Count_Variedades   = 1;
	$Count_Shipping     = 1;
}else{
	//Totales de los permisos que se pueden acceder
	$Count_productos    = $rowdata_x['tran_1'] + $rowdata_x['tran_2'] + $rowdata_x['tran_3'] + $rowdata_x['tran_4'] + $rowdata_x['tran_5'];
	$Count_insumos      = $rowdata_x['tran_11'] + $rowdata_x['tran_12'] + $rowdata_x['tran_13'] + $rowdata_x['tran_14'] + $rowdata_x['tran_15'];
	$Count_OT           = $rowdata_x['tran_21'] + $rowdata_x['tran_22'];
	$Count_OC           = $rowdata_x['tran_26'] + $rowdata_x['tran_27'];
	$Count_Variedades   = $rowdata_x['tran_31'] + $rowdata_x['tran_32'] + $rowdata_x['tran_33'] + $rowdata_x['tran_34'];
	$Count_Shipping     = $rowdata_x['tran_35'] + $rowdata_x['tran_36'] + $rowdata_x['tran_37'];
}

?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Sistema', $rowdata['Nombre'], 'Resumen');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'admin_datos.php';?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'admin_datos_datos.php';?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'admin_datos_datos_contacto.php';?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'admin_datos_datos_contrato.php';?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Datos Contrato</a></li>
						<li class=""><a href="<?php echo 'admin_datos_datos_configuracion.php';?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
						<li class=""><a href="<?php echo 'admin_datos_datos_temas.php';?>" ><i class="fa fa-tags" aria-hidden="true"></i> Temas</a></li>
						<li class=""><a href="<?php echo 'admin_datos_datos_facturacion.php';?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Facturacion</a></li>
						<?php if(isset($Count_OT)&&$Count_OT!=0){?>
							<li class=""><a href="<?php echo 'admin_datos_datos_ot.php';?>" ><i class="fa fa-cogs" aria-hidden="true"></i> OT</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_datos_datos_imagen.php';?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Logo</a></li>
						<?php if(isset($Count_OC)&&$Count_OC!=0){?>
							<li class=""><a href="<?php echo 'admin_datos_datos_oc.php';?>" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Aprobador OC</a></li>
						<?php } ?>
						<?php if(isset($Count_productos)&&$Count_productos!=0){?>
							<li class=""><a href="<?php echo 'admin_datos_datos_productos.php';?>" ><i class="fa fa-cubes" aria-hidden="true"></i> Productos Usados</a></li>
						<?php } ?>
						<?php if(isset($Count_insumos)&&$Count_insumos!=0){?>
							<li class=""><a href="<?php echo 'admin_datos_datos_insumos.php';?>" ><i class="fa fa-cubes" aria-hidden="true"></i> Insumos Usados</a></li>
						<?php } ?>
						<?php if(isset($Count_Variedades)&&$Count_Variedades!=0){?>
							<li class=""><a href="<?php echo 'admin_datos_datos_variedades_especies.php';?>" ><i class="fa fa-recycle" aria-hidden="true"></i> Especies</a></li>
							<li class=""><a href="<?php echo 'admin_datos_datos_variedades_nombres.php';?>" ><i class="fa fa-recycle" aria-hidden="true"></i> Variedades</a></li>
						<?php } ?>
						<?php if(isset($Count_Shipping)&&$Count_Shipping!=0){?>
							<li class=""><a href="<?php echo 'admin_datos_datos_cross.php';?>" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Aprobador CrossShipping</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'admin_datos_datos_social.php'; ?>" ><i class="fa fa-facebook-official" aria-hidden="true"></i> Social</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="col-sm-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-sm-12">
							<h2 class="text-primary">Datos Basicos</h2>
							<p class="text-muted word_break">
								<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
								<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
								<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
								<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
								<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?>
							</p>
									
									
							<h2 class="text-primary">Datos de contacto</h2>
							<p class="text-muted word_break">
								<strong>Nombre Contacto : </strong><?php echo $rowdata['Contacto_Nombre']; ?><br/>
								<strong>Fono 1: </strong><?php echo formatPhone($rowdata['Contacto_Fono1']); ?><br/>
								<strong>Fono 2: </strong><?php echo formatPhone($rowdata['Contacto_Fono2']); ?><br/>
								<strong>Fax : </strong><?php echo $rowdata['Contacto_Fax']; ?><br/>
								<strong>Web : </strong><?php echo $rowdata['Contacto_Web']; ?><br/>
								<strong>Email : </strong><?php echo $rowdata['email_principal']; ?>
							</p>

							<h2 class="text-primary">Contrato</h2>
							<p class="text-muted word_break">
								<strong>Nombre Contrato : </strong><?php echo $rowdata['Contrato_Nombre']; ?><br/>
								<strong>Numero de Contrato : </strong><?php echo $rowdata['Contrato_Numero']; ?><br/>
								<strong>Fecha inicio Contrato : </strong><?php echo $rowdata['Contrato_Fecha']; ?><br/>
								<strong>Duracion Contrato(Meses) : </strong><?php echo $rowdata['Contrato_Duracion']; ?>
							</p>
								
							<h2 class="text-primary">Configuracion</h2>
							<p class="text-muted word_break">
								<strong>Tema : </strong><?php echo $rowdata['Tema']; ?><br/>
								<strong>ID Google : </strong><?php echo $rowdata['Config_IDGoogle']; ?><br/>
							</p>
									
							<h2 class="text-primary">Bodegas OT</h2>
							<p class="text-muted word_break">
								<strong>Bodega Productos : </strong><?php echo $rowdata['BodegaProd']; ?><br/>
								<strong>Bodega Insumos : </strong><?php echo $rowdata['BodegaIns']; ?><br/>
							</p>
									
							<h2 class="text-primary">Social</h2>
							<p class="text-muted word_break">
								<strong>Uso de widget Sociales : </strong><?php echo $rowdata['SocialUso']; ?><br/>
								<?php if(isset($rowdata['Social_idUso'])&&$rowdata['Social_idUso']==1){ ?>
									<strong>Facebook : </strong><?php echo $rowdata['Social_facebook']; ?><br/>
									<strong>Twitter : </strong><?php echo $rowdata['Social_twitter']; ?><br/>
									<strong>Instagram : </strong><?php echo $rowdata['Social_instagram']; ?><br/>
									<strong>Linkedin : </strong><?php echo $rowdata['Social_linkedin']; ?><br/>
									<strong>Rss : </strong><?php echo $rowdata['Social_rss']; ?><br/>
									<strong>Youtube : </strong><?php echo $rowdata['Social_youtube']; ?><br/>
									<strong>Tumblr : </strong><?php echo $rowdata['Social_tumblr']; ?><br/>
								<?php } ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<?php 
							//se arma la direccion
							$direccion = "";
							if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
							if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
							if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
							//se despliega mensaje en caso de no existir direccion
							if($direccion!=''){
								echo mapa_from_direccion($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1);
							}else{
								$Alert_Text = '<strong>No tiene una direccion definida</strong>';
								alert_post_data(4,2,2, $Alert_Text);
							}
						?>
					</div>
				</div>
				<div class="clearfix"></div>
				
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
