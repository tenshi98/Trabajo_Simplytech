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
$original = "comunicaciones_notificaciones_filtro.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTipoUsuario']) && $_GET['idTipoUsuario']!=''){ $location .= "&idTipoUsuario=".$_GET['idTipoUsuario']; $search .= "&idTipoUsuario=".$_GET['idTipoUsuario'];}
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){        $location .= "&Nombre=".$_GET['Nombre'];               $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['rango_a']) && $_GET['rango_a']!=''){      $location .= "&rango_a=".$_GET['rango_a'];             $search .= "&rango_a=".$_GET['rango_a'];}
if(isset($_GET['rango_b']) && $_GET['rango_b']!=''){      $location .= "&rango_b=".$_GET['rango_b'];             $search .= "&rango_b=".$_GET['rango_b'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){    $location .= "&idCiudad=".$_GET['idCiudad'];           $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){    $location .= "&idComuna=".$_GET['idComuna'];           $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){  $location .= "&Direccion=".$_GET['Direccion'];         $search .= "&Direccion=".$_GET['Direccion'];}
if(isset($_GET['idSistema']) && $_GET['idSistema']!=''){  $location .= "&idSistema=".$_GET['idSistema'];         $search .= "&idSistema=".$_GET['idSistema'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit_filter'])){
	//Llamamos al formulario
	$form_trabajo= 'enviar_filtro';
	require_once 'A1XRXS_sys/xrxs_form/z_notificaciones.php';
}
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'enviar_filtrados';
	require_once 'A1XRXS_sys/xrxs_form/z_notificaciones.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/z_notificaciones.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Notificacion Creada correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Notificacion Modificada correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Notificacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 if(!empty($_GET['detalle'])){ 
// consulto los datos
$arrNotificaciones = array();
$query = "SELECT 
principal_notificaciones_ver.Fecha,
principal_notificaciones_ver.FechaVisto,
usuarios_listado.Nombre AS usuario,
core_estado_notificaciones.Nombre AS estado,
principal_notificaciones_ver.idEstado,
principal_notificaciones_listado.Titulo

FROM `principal_notificaciones_ver`
LEFT JOIN `usuarios_listado`                   ON usuarios_listado.idUsuario                          = principal_notificaciones_ver.idUsuario
LEFT JOIN `core_estado_notificaciones`         ON core_estado_notificaciones.idEstado                 = principal_notificaciones_ver.idEstado
LEFT JOIN `principal_notificaciones_listado`   ON principal_notificaciones_listado.idNotificaciones   = principal_notificaciones_ver.idNotificaciones

WHERE principal_notificaciones_ver.idNotificaciones = ".$_GET['detalle'];
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
array_push( $arrNotificaciones,$row );
}

?>
 
 


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5><?php echo $arrNotificaciones[0]['Titulo'];?></h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Usuario</th>
						<th width="120">Estado</th>
						<th width="120">Fecha envio</th>
						<th width="120">Fecha leida</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrNotificaciones as $noti) { ?>
					<tr class="odd">
						<td><?php echo $noti['usuario']; ?></td>
						<td><?php echo $noti['estado']; ?></td>
						<td><?php echo fecha_estandar($noti['Fecha']); ?></td>
						<td><?php if($noti['idEstado']==2){echo fecha_estandar($noti['FechaVisto']);}?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 } elseif(!empty($_GET['filtro'])){ 	
//realizo el filtrado de acuerdo al filtro anterior
$w = 'WHERE usuarios_listado.idEstado = 1';
if(isset($_GET['idTipoUsuario']) && $_GET['idTipoUsuario']!=''){  $w .= " AND usuarios_listado.idTipoUsuario = '".$_GET['idTipoUsuario']."'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {              $w .= " AND usuarios_listado.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != '')  {          $w .= " AND usuarios_listado.idCiudad = '".$_GET['idCiudad']."'";}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != '')  {          $w .= " AND usuarios_listado.idComuna = '".$_GET['idComuna']."'";}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != '')  {        $w .= " AND usuarios_listado.Direccion LIKE '%".EstandarizarInput($_GET['Direccion'])."%'";}
if(isset($_GET['idSistema']) && $_GET['idSistema'] != '')  {        $w .= " AND usuarios_sistemas.idSistema = '".$_GET['idSistema']."'";}
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b']!=''){ 
	$w .= " AND usuarios_listado.fNacimiento BETWEEN '".$_GET['rango_a']."' AND '".$_GET['rango_b']."'";
}
//consulta
$arrNotificaciones = array();
$query = "SELECT 
usuarios_listado.idUsuario,
usuarios_listado.email,
usuarios_listado.Nombre
				
FROM `usuarios_listado`
LEFT JOIN `usuarios_sistemas` ON usuarios_sistemas.idUsuario = usuarios_listado.idUsuario
".$w."
GROUP BY usuarios_listado.idUsuario";
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
array_push( $arrNotificaciones,$row );
}
/*****************************************/
//cuento
$total_usr = 0;
foreach ($arrNotificaciones as $noti) {
	$total_usr++;
}
					
?>
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Crear Notificacion para <?php echo $total_usr ?> usuarios</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php
				//Se verifican si existen los datos
				if(isset($Titulo)){        $x1  = $Titulo;        }else{$x1  = '';}
				if(isset($Notificacion)){  $x2  = $Notificacion;  }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Titulo', 'Titulo', $x1, 2);
				$Form_Inputs->form_textarea('Notificacion','Notificacion', $x2, 2);
				$Form_Inputs->form_input_hidden('Fecha', fecha_actual(), 2);
				$Form_Inputs->form_input_hidden('idUsuario', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
				
				if(isset($_GET['idTipoUsuario']) && $_GET['idTipoUsuario']!=''){  $Form_Inputs->form_input_hidden('idTipoUsuario', $_GET['idTipoUsuario'], 2);}     
				if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {              $Form_Inputs->form_input_hidden('Nombre', $_GET['Nombre'], 2);}           
				if(isset($_GET['rango_a']) && $_GET['rango_a'] != '')  {            $Form_Inputs->form_input_hidden('rango_a', $_GET['rango_a'], 2);}     
				if(isset($_GET['rango_b']) && $_GET['rango_b'] != '')  {            $Form_Inputs->form_input_hidden('rango_b', $_GET['rango_b'], 2);}     
				if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != '')  {          $Form_Inputs->form_input_hidden('idCiudad', $_GET['idCiudad'], 2);}            
				if(isset($_GET['idComuna']) && $_GET['idComuna'] != '')  {          $Form_Inputs->form_input_hidden('idComuna', $_GET['idComuna'], 2);}           
				if(isset($_GET['Direccion']) && $_GET['Direccion'] != '')  {        $Form_Inputs->form_input_hidden('Direccion', $_GET['Direccion'], 2);}     
				if(isset($_GET['idSistema']) && $_GET['idSistema'] != '')  {        $Form_Inputs->form_input_hidden('idSistema', $_GET['idSistema'], 2);}     
				
				?>
				
				<div class="form-group">
					<?php if($total_usr){?>
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf003; Enviar" name="submit">
					<?php } ?>
					<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de usuarios receptores</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrNotificaciones as $usuarios) { ?>
						<tr class="odd">
							<td><?php echo $usuarios['Nombre']; ?></td>
							<td><?php echo $usuarios['email']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div> 
	</div>
</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} elseif(!empty($_GET['new'])){
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn);?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro para Busqueda Avanzada</h5>
		</header>
		<div class="body">
			<form name="form1" class="form-horizontal" method="post"  novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idTipoUsuario)){  $x1  = $idTipoUsuario;  }else{$x1  = '';}
				if(isset($Nombre)){         $x2  = $Nombre;         }else{$x2  = '';}
				if(isset($rango_a)){        $x3  = $rango_a;        }else{$x3  = '';}
				if(isset($rango_b)){        $x4  = $rango_b;        }else{$x4  = '';}
				if(isset($idCiudad)){       $x5  = $idCiudad;       }else{$x5  = '';}
				if(isset($idComuna)){       $x6  = $idComuna;       }else{$x6  = '';}
				if(isset($Direccion)){      $x7  = $Direccion;      }else{$x7  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Tipo de Usuario','idTipoUsuario', $x1, 1, 'idTipoUsuario', 'Nombre', 'usuarios_tipos', 'idTipoUsuario!=1', '', $dbConn);
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 1);
				$Form_Inputs->form_date('F Nacimiento inicio','rango_a', $x3, 1);
				$Form_Inputs->form_date('F Nacimiento termino','rango_b', $x4, 1);
				$Form_Inputs->form_select_depend1('Region','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										 'Comuna','idComuna', $x6, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
										  $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x7, 1,'fa fa-map');
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('pagina', 1, 2);
				?>
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Buscar" name="submit_filter">
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
		case 'fecha_asc':     $order_by = 'Fecha ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Fecha Ascendente'; break;
		case 'fecha_desc':    $order_by = 'Fecha DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';break;
		case 'titulo_asc':    $order_by = 'Titulo ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Titulo Ascendente';break;
		case 'titulo_desc':   $order_by = 'Titulo DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Titulo Descendente';break;
		
		default: $order_by = 'Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
	}
}else{
	$order_by = 'Fecha DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Fecha Descendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "principal_notificaciones_listado.idNotificaciones!=0";
$SIS_where.= " AND principal_notificaciones_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];//Verifico el tipo de usuario que esta ingresando
				
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'idNotificaciones', 'principal_notificaciones_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);
// Se trae un listado con todos los elementos
$SIS_query = 'idNotificaciones,Titulo, Fecha';
$SIS_join  = '';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrNotificaciones = array();
$arrNotificaciones = db_select_array (false, $SIS_query, 'principal_notificaciones_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrNotificaciones');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Notificacion</a><?php } ?>

</div>
<div class="clearfix"></div>
                      
                                 
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Notificaciones</h5>
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
							<div class="pull-left">Fecha</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=fecha_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=fecha_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Titulo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=titulo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=titulo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrNotificaciones as $noti) { ?>
					<tr class="odd">
						<td><?php echo fecha_estandar($noti['Fecha']); ?></td>
						<td><?php echo $noti['Titulo']; ?></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_notificacion.php?view='.simpleEncode($noti['idNotificaciones'], '123333'); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&detalle='.$noti['idNotificaciones']; ?>" title="Ver detalle leidos" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($noti['idNotificaciones'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar la notificacion '.$noti['Titulo'].'?';?>
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
