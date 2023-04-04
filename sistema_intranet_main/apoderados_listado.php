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
$original = "apoderados_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){     $location .= "&Nombre=".$_GET['Nombre'];             $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['ApellidoPat']) && $_GET['ApellidoPat']!=''){  $location .= "&ApellidoPat=".$_GET['ApellidoPat'];   $search .= "&ApellidoPat=".$_GET['ApellidoPat'];}
if(isset($_GET['ApellidoMat']) && $_GET['ApellidoMat']!=''){  $location .= "&ApellidoMat=".$_GET['ApellidoMat'];   $search .= "&ApellidoMat=".$_GET['ApellidoMat'];}
if(isset($_GET['Rut']) && $_GET['Rut']!=''){           $location .= "&Rut=".$_GET['Rut'];                   $search .= "&Rut=".$_GET['Rut'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Apoderado Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Apoderado Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Apoderado borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['id'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT 
apoderados_listado.Direccion_img,
apoderados_listado.Nombre,
apoderados_listado.ApellidoPat,
apoderados_listado.ApellidoMat, 
apoderados_listado.Rut,
apoderados_listado.Password,
apoderados_listado.FNacimiento,
apoderados_listado.Fono1,
apoderados_listado.Fono2,
apoderados_listado.GeoLatitud,
apoderados_listado.GeoLongitud,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
apoderados_listado.Direccion,
core_estados.Nombre AS Estado,
core_sistemas.Nombre AS Sistema,
apoderados_listado.F_Inicio_Contrato,
apoderados_listado.F_Termino_Contrato,
apoderados_listado.File_Contrato,
apoderados_listado.idOpciones_1,
apoderados_listado.idOpciones_2

FROM `apoderados_listado`
LEFT JOIN `core_estados`                     ON core_estados.idEstado               = apoderados_listado.idEstado
LEFT JOIN `core_sistemas`                    ON core_sistemas.idSistema             = apoderados_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`            ON core_ubicacion_ciudad.idCiudad      = apoderados_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`           ON core_ubicacion_comunas.idComuna     = apoderados_listado.idComuna

WHERE apoderados_listado.idApoderado = ".$_GET['id'];
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

// Se trae un listado con todas las cargas familiares
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
WHERE apoderados_listado_hijos.idApoderado = ".$_GET['id']."
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrCargas,$row );
}

// Se trae un listado con todas las cargas familiares
$arrSubcuentas = array();
$query = "SELECT Nombre,Usuario, Password
FROM `apoderados_subcuentas`
WHERE idApoderado = ".$_GET['id']."
ORDER BY Nombre ASC ";
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
array_push( $arrSubcuentas,$row );
}

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Apoderado', $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat'], 'Resumen'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'apoderados_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'apoderados_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'apoderados_listado_ubicacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-o" aria-hidden="true"></i> Ubicacion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'apoderados_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
						<?php
						//Si se utiliza la APP 
						if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>
							<li class=""><a href="<?php echo 'apoderados_listado_subcuentas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sitemap" aria-hidden="true"></i> Subcuentas</a></li>
						<?php } ?>
						<?php
						//Si se utiliza subcuentas
						if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
							<li class=""><a href="<?php echo 'apoderados_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'apoderados_listado_hijos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-child" aria-hidden="true"></i> Hijos</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-briefcase" aria-hidden="true"></i> Contrato</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>

					</ul>
                </li>
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
						<?php } ?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?><br/>
							<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
							<strong>Fecha de Nacimiento : </strong><?php echo Fecha_estandar($rowdata['FNacimiento']); ?><br/>
							<strong>Fono : </strong><?php echo formatPhone($rowdata['Fono1']); ?><br/>
							<strong>Fono : </strong><?php echo formatPhone($rowdata['Fono2']); ?><br/>
							<strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['nombre_comuna'].', '.$rowdata['nombre_region']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?><br/>
							<strong>Sistema : </strong><?php echo $rowdata['Sistema']; ?><br/>
							<strong>Fecha de Inicio Contrato : </strong><?php if(isset($rowdata['F_Inicio_Contrato'])&&$rowdata['F_Inicio_Contrato']!='0000-00-00'){echo Fecha_estandar($rowdata['F_Inicio_Contrato']);}else{echo 'Sin fecha de inicio';} ?><br/>
							<strong>Fecha de Termino Contrato : </strong><?php if(isset($rowdata['F_Termino_Contrato'])&&$rowdata['F_Termino_Contrato']!='0000-00-00'){echo Fecha_estandar($rowdata['F_Termino_Contrato']);}else{echo 'Sin fecha de termino';} ?><br/>
						</p>

						<?php
						//Si se utiliza la APP 
						if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){
							//Si se utiliza subcuentas
							if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Acceso Subcuentas APP</h2>
								<?php foreach ($arrSubcuentas as $sub) { ?>
									<p class="text-muted">
										<strong>Nombre : </strong><?php echo $sub['Nombre']; ?> -
										<strong>Usuario : </strong><?php echo $sub['Usuario']; ?> -
										<strong>Password : </strong><?php echo $sub['Password']; ?>
									</p>
								<?php } ?>
							<?php }else{ ?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Acceso APP</h2>
								<p class="text-muted">
									<strong>Usuario : </strong><?php echo $rowdata['Rut']; ?><br/>
									<strong>Password : </strong><?php echo $rowdata['Password']; ?><br/>
								</p>
							<?php } ?>
						<?php } ?>
				

						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Hijos</h2>
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
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
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
								echo '<p class="text-muted">Apoderado Sin Hijos</p>';
							}
							?>
						</div>
						<div class="clearfix"></div>

		
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php
								//Contrato
								if(isset($rowdata['File_Contrato'])&&$rowdata['File_Contrato']!=''){
									echo '
										<tr class="item-row">
											<td>Contrato</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($rowdata['File_Contrato'], fecha_actual()).'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<a href="1download.php?dir='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($rowdata['File_Contrato'], fecha_actual()).'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download" aria-hidden="true"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								?>
							</tbody>
						</table>
						
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Ubicacion</h2>
						<?php echo mapa_from_gps($rowdata['GeoLatitud'], $rowdata['GeoLongitud'], 'Direccion', 'Calle', $rowdata['Direccion'], $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1); ?>
											
					</div>
					<div class="clearfix"></div>

				</div>
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
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Apoderado</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){              $x1  = $Nombre;               }else{$x1  = '';}
				if(isset($ApellidoPat)){         $x2  = $ApellidoPat;          }else{$x2  = '';}
				if(isset($ApellidoMat)){         $x3  = $ApellidoMat;          }else{$x3  = '';}
				if(isset($Rut)){                 $x4  = $Rut;                  }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
				$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x2, 2);
				$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x3, 2);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x4, 2);

				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				$Form_Inputs->form_input_hidden('GeoLatitud', '-33.477271996598965', 2);
				$Form_Inputs->form_input_hidden('GeoLongitud', '-70.65170304882815', 2);
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
/**********************************************************/
//paginador de resultados
if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'apoderados_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'apoderados_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':    $order_by = 'apoderados_listado.idEstado ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'apoderados_listado.idEstado DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;

		default: $order_by = 'apoderados_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'apoderados_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "apoderados_listado.idApoderado!=0";
$SIS_where.= " AND apoderados_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){     $SIS_where .= " AND apoderados_listado.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['ApellidoPat']) && $_GET['ApellidoPat']!=''){  $SIS_where .= " AND apoderados_listado.ApellidoPat LIKE '%".EstandarizarInput($_GET['ApellidoPat'])."%'";}
if(isset($_GET['ApellidoMat']) && $_GET['ApellidoMat']!=''){  $SIS_where .= " AND apoderados_listado.ApellidoMat LIKE '%".EstandarizarInput($_GET['ApellidoMat'])."%'";}
if(isset($_GET['Rut']) && $_GET['Rut']!=''){           $SIS_where .= " AND apoderados_listado.Rut LIKE '%".EstandarizarInput($_GET['Rut'])."%'";}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idApoderado', 'apoderados_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = '
apoderados_listado.idApoderado,
apoderados_listado.Nombre,
apoderados_listado.ApellidoPat, 
apoderados_listado.ApellidoMat,
core_sistemas.Nombre AS RazonSocial,
core_estados.Nombre AS Estado,
apoderados_listado.idEstado';
$SIS_join  = '
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = apoderados_listado.idSistema
LEFT JOIN `core_estados`  ON core_estados.idEstado   = apoderados_listado.idEstado';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrApoderado = array();
$arrApoderado = db_select_array (false, $SIS_query, 'apoderados_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrApoderado');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>
	</ul>

	<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Apoderado</a><?php } ?>

</div>
<div class="clearfix"></div>
<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
	<div class="well">
		<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
				<?php
				//Se verifican si existen los datos
				if(isset($Nombre)){              $x1  = $Nombre;               }else{$x1  = '';}
				if(isset($ApellidoPat)){         $x2  = $ApellidoPat;          }else{$x2  = '';}
				if(isset($ApellidoMat)){         $x3  = $ApellidoMat;          }else{$x3  = '';}
				if(isset($Rut)){                 $x4  = $Rut;                  }else{$x4  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 1);
				$Form_Inputs->form_input_text('Apellido Paterno', 'ApellidoPat', $x2, 1);
				$Form_Inputs->form_input_text('Apellido Materno', 'ApellidoMat', $x3, 1);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x4, 1);

				$Form_Inputs->form_input_hidden('pagina', 1, 1);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>

			</form>
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Apoderados</h5>
			<div class="toolbar">
				<?php
				//Se llama al paginador
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
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrApoderado as $trab) { ?>
						<tr class="odd">
							<td><?php echo $trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat']; ?></td>
							<td><label class="label <?php if(isset($trab['idEstado'])&&$trab['idEstado']==1){echo 'label-success';}else{echo 'label-danger';} ?>"><?php echo $trab['Estado']; ?></label></td>
							<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $trab['RazonSocial']; ?></td><?php } ?>
							<td>
								<div class="btn-group" style="width: 105px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_apoderado.php?view='.simpleEncode($trab['idApoderado'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$trab['idApoderado']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del='.simpleEncode($trab['idApoderado'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar el trabajador '.$trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat'].'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
