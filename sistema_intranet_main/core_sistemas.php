<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
//Verifico si es superusuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Type.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "core_sistemas.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/core_sistemas.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/core_sistemas.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Sistema Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Sistema Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Sistema Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
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
core_sistemas.Contacto_Email,
core_sistemas.email_principal, 
core_sistemas.Contrato_Nombre,
core_sistemas.Contrato_Numero, 
core_sistemas.Contrato_Fecha, 
core_sistemas.Contrato_Duracion,
core_sistemas.Config_IDGoogle,
core_sistemas.Config_Google_apiKey,
core_sistemas.Config_FCM_apiKey,
core_sistemas.Config_FCM_Main_apiKey,
core_theme_colors.Nombre AS Tema,
core_sistemas.Config_CorreoRespaldo,
core_sistemas.Config_Gmail_Usuario,
core_sistemas.Config_Gmail_Password,
core_sistemas.Config_WhatsappToken,
core_sistemas.Config_WhatsappInstanceId,
opc1.Nombre AS OpcionesGen_1,
opc2.Nombre AS OpcionesGen_2,
opc3.Nombre AS OpcionesGen_3,
opc4.Nombre AS OpcionesGen_4,
core_pdf_motores.Nombre AS OpcionesGen_5,
opc7.Nombre AS OpcionesGen_7,
opc8.Nombre AS OpcionesGen_8,
opc9.Nombre AS OpcionesGen_9,
opc10.Nombre AS OpcionesGen_10,
core_sistemas.idOpcionesGen_6,
bodegas_productos_listado.Nombre AS BodegaProd,
bodegas_insumos_listado.Nombre AS BodegaIns,
core_sistemas.Rubro,
core_sistemas_opciones_telemetria.Nombre AS OpcionTelemetria,
core_config_ram.Nombre AS ConfigRam,
core_config_time.Nombre AS ConfigTime,
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
LEFT JOIN `core_ubicacion_ciudad`              ON core_ubicacion_ciudad.idCiudad                   = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`             ON core_ubicacion_comunas.idComuna                  = core_sistemas.idComuna
LEFT JOIN `core_theme_colors`                  ON core_theme_colors.idTheme                        = core_sistemas.Config_idTheme
LEFT JOIN `core_sistemas_opciones`   opc1      ON opc1.idOpciones                                  = core_sistemas.idOpcionesGen_1
LEFT JOIN `core_sistemas_opciones`   opc2      ON opc2.idOpciones                                  = core_sistemas.idOpcionesGen_2
LEFT JOIN `core_sistemas_opciones`   opc3      ON opc3.idOpciones                                  = core_sistemas.idOpcionesGen_3
LEFT JOIN `core_sistemas_opciones`   opc4      ON opc4.idOpciones                                  = core_sistemas.idOpcionesGen_4
LEFT JOIN `core_pdf_motores`                   ON core_pdf_motores.idPDF                           = core_sistemas.idOpcionesGen_5
LEFT JOIN `core_interfaces`          opc7      ON opc7.idInterfaz                                  = core_sistemas.idOpcionesGen_7
LEFT JOIN `core_sistemas_opciones`   opc8      ON opc8.idOpciones                                  = core_sistemas.idOpcionesGen_8
LEFT JOIN `core_sistemas_opciones`   opc9      ON opc9.idOpciones                                  = core_sistemas.idOpcionesGen_9
LEFT JOIN `core_sistemas_opciones`   opc10     ON opc10.idOpciones                                 = core_sistemas.idOpcionesGen_10
LEFT JOIN `bodegas_productos_listado`          ON bodegas_productos_listado.idBodega               = core_sistemas.OT_idBodegaProd
LEFT JOIN `bodegas_insumos_listado`            ON bodegas_insumos_listado.idBodega                 = core_sistemas.OT_idBodegaIns
LEFT JOIN `core_sistemas_opciones_telemetria`  ON core_sistemas_opciones_telemetria.idOpcionesTel  = core_sistemas.idOpcionesTel
LEFT JOIN `core_config_ram`                    ON core_config_ram.idConfigRam                      = core_sistemas.idConfigRam
LEFT JOIN `core_config_time`                   ON core_config_time.idConfigTime                    = core_sistemas.idConfigTime
LEFT JOIN `core_sistemas_opciones`  socialUso  ON socialUso.idOpciones                             = core_sistemas.Social_idUso';
$SIS_where = 'core_sistemas.idSistema ='.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'core_sistemas',$SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Sistema', $rowdata['Nombre'], 'Resumen'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'core_sistemas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'core_sistemas_datos_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Datos Contrato</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_opciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-code" aria-hidden="true"></i> APIS</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Facturacion</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_ot.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-cogs" aria-hidden="true"></i> OT</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Logo</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_oc.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Aprobador OC</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_crosstech.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >CrossTech</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_crossenergy.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >CrossEnergy</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_social.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-facebook-official" aria-hidden="true"></i> Social</a></li>

					</ul>
                </li>
			</ul>
		</header>
        <div class="tab-content">

			<div class="tab-pane fade active in" id="basicos">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
								<strong>Email : </strong><?php echo $rowdata['Contacto_Email']; ?>
							</p>

							<h2 class="text-primary">Contrato</h2>
							<p class="text-muted word_break">
								<strong>Nombre Contrato : </strong><?php echo $rowdata['Contrato_Nombre']; ?><br/>
								<strong>Numero de Contrato : </strong><?php echo $rowdata['Contrato_Numero']; ?><br/>
								<strong>Fecha inicio Contrato : </strong><?php echo $rowdata['Contrato_Fecha']; ?><br/>
								<strong>Duracion Contrato(Meses) : </strong><?php echo $rowdata['Contrato_Duracion']; ?>
							</p>

							<h2 class="text-primary">Configuracion</h2>
							<h3 class="text-muted" style="font-size: 16px!important;color: #337ab7;">Visualizacion General</h3>
							<p class="text-muted word_break">
								<strong>Tema : </strong><?php echo $rowdata['Tema']; ?><br/>
								<strong>Mostrar Repositorio Comun : </strong><?php echo $rowdata['OpcionesGen_9']; ?><br/>
								<strong>Gestor de Correo : </strong><?php echo $rowdata['OpcionesGen_8']; ?><br/>
							</p>

							<h3 class="text-muted" style="font-size: 16px!important;color: #337ab7;">Visualizacion Pagina Inicio</h3>
							<p class="text-muted word_break">
								<strong>Interfaz : </strong><?php echo $rowdata['OpcionesGen_7']; ?><br/>
								<strong>Tipo Resumen Telemetria : </strong><?php echo $rowdata['OpcionTelemetria']; ?><br/>
								<strong>Refresh Pagina Principal : </strong><?php echo $rowdata['OpcionesGen_4'].' ('.$rowdata['idOpcionesGen_6'].' segundos)'; ?><br/>
								<strong>Widget Comunes : </strong><?php echo $rowdata['OpcionesGen_1']; ?><br/>
								<strong>Widget de acceso directo : </strong><?php echo $rowdata['OpcionesGen_2']; ?><br/>
								<strong>Valores promedios de las mediciones : </strong><?php echo $rowdata['OpcionesGen_3']; ?><br/>
								<strong>Nuevo Widget CrossC : </strong><?php echo $rowdata['OpcionesGen_10']; ?><br/>
							</p>

							<h3 class="text-muted" style="font-size: 16px!important;color: #337ab7;">Configuracion Sistema</h3>
							<p class="text-muted word_break">
								<strong>Memoria Ram Maxima : </strong><?php if(isset($rowdata['ConfigRam'])&&$rowdata['ConfigRam']!=0){echo $rowdata['ConfigRam'].' MB';}else{ echo '4096 MB';} ?><br/>
								<strong>Tiempo Maximo de espera : </strong><?php if(isset($rowdata['ConfigTime'])&&$rowdata['ConfigTime']!=0){echo $rowdata['ConfigTime'].' Minutos';}else{ echo '40 Minutos';} ?><br/>
								<strong>Motor PDF : </strong><?php echo $rowdata['OpcionesGen_5']; ?><br/>
								<strong>Correo Respaldo Datos : </strong><?php echo $rowdata['Config_CorreoRespaldo']; ?><br/>
								<strong>Correo Envio Notificaciones : </strong><?php echo $rowdata['email_principal']; ?><br/>
								<strong>Usuario Gmail Envio Notificaciones : </strong><?php echo $rowdata['Config_Gmail_Usuario']; ?><br/>
								<strong>Password Usuario Gmail : </strong><?php echo $rowdata['Config_Gmail_Password']; ?><br/>
								<strong>Whatsapp Token : </strong><?php echo $rowdata['Config_WhatsappToken']; ?><br/>
								<strong>Whatsapp Instance Id : </strong><?php echo $rowdata['Config_WhatsappInstanceId']; ?><br/>
							</p>

							<h2 class="text-primary">APIS</h2>
							<p class="text-muted word_break">
								<strong>ID Google (Mapas) : </strong><?php echo $rowdata['Config_IDGoogle']; ?><br/>
								<strong>ApiKey (Android) : </strong><?php echo $rowdata['Config_Google_apiKey']; ?><br/>
								<strong>ApiKey (Firebase) : </strong><?php echo $rowdata['Config_FCM_apiKey']; ?><br/>
								<strong>Main ApiKey (Firebase) : </strong><?php echo $rowdata['Config_FCM_Main_apiKey']; ?><br/>
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
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
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
								$Alert_Text = 'No tiene una direccion definida';
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

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['new'])){ ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Sistema</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){           $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($Rut)){              $x2  = $Rut;              }else{$x2  = '';}
				if(isset($idCiudad)){         $x3  = $idCiudad;         }else{$x3  = '';}
				if(isset($idComuna)){         $x4  = $idComuna;         }else{$x4  = '';}
				if(isset($Direccion)){        $x5  = $Direccion;        }else{$x5  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x2, 2);
				$Form_Inputs->form_select_depend1('Region','idCiudad', $x3, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										 'Comuna','idComuna', $x4, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
										 $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x5, 2,'fa fa-map');

				$Form_Inputs->form_input_hidden('Config_idTheme', 1, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_1', 1, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_2', 1, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_3', 2, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_4', 2, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_5', 1, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_6', 0, 1);
				$Form_Inputs->form_input_hidden('idOpcionesGen_7', 3, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_8', 2, 2);
				$Form_Inputs->form_input_hidden('idOpcionesGen_9', 2, 2);
				$Form_Inputs->form_input_hidden('idOpcionesTel', 4, 2);
				$Form_Inputs->form_input_hidden('idConfigRam', 9, 2);
				$Form_Inputs->form_input_hidden('idConfigTime', 13, 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);

				?>
	 
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
//Creo la variable con la ubicacion
$SIS_where = "core_sistemas.idSistema!=0 ";
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'core_sistemas.idSistema', 'core_sistemas','LEFT JOIN `core_estados`  ON core_estados.idEstado  = core_sistemas.idEstado', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
core_sistemas.idSistema,
core_sistemas.Nombre,
core_sistemas.Rut,
core_sistemas.idEstado,
core_estados.Nombre AS estado';
$SIS_join  = 'LEFT JOIN `core_estados`  ON core_estados.idEstado  = core_sistemas.idEstado';
$SIS_order = 'core_estados.Nombre ASC, core_sistemas.Nombre ASC LIMIT '.$comienzo.', '.$cant_reg;
$arrSistemas = array();
$arrSistemas = db_select_array (false, $SIS_query, 'core_sistemas',$SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrSistemas');
/**********************************************************/
//paginacion
$search='';

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Sistema</a>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Sistemas</h5>
			<div class="toolbar">
				<?php 
				//paginacion
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Rut</th>
						<th>Estado</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
								 
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrSistemas as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Nombre']; ?></td>
						<td><?php echo $tipo['Rut']; ?></td>
						<td><label class="label <?php if(isset($tipo['idEstado'])&&$tipo['idEstado']==1){echo 'label-success';}else{echo 'label-danger';} ?>"><?php echo $tipo['estado']; ?></label></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<a href="<?php echo 'view_sistema.php?view='.simpleEncode($tipo['idSistema'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&id='.$tipo['idSistema']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<?php
								$ubicacion = $location.'&del='.simpleEncode($tipo['idSistema'], fecha_actual());
								$dialogo   = '¿Realmente deseas eliminar el sistema '.$tipo['Nombre'].'?'; ?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="pagrow">
			<?php
			//paginacion
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
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
