<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "usuarios_listado.php";
$location = $original;
$new_location = "usuarios_listado_permisos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){ 
	$location .= "&search=".$_GET['search'] ; 	
	$new_location .= "&search=".$_GET['search'] ; 	
}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_GET['prm_add']) )  { 
	//Llamamos al formulario
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	$location.='#'.$_GET['anclaje'];
	$form_obligatorios = '';
	$form_trabajo= 'prm_add';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';
}
//se borra un dato
if ( !empty($_GET['prm_del']) )     {
	//Llamamos al formulario
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	$location.='#'.$_GET['anclaje'];
	$form_obligatorios = '';
	$form_trabajo= 'prm_del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';	
}
//se borra un dato
if ( !empty($_GET['perm']) )     {
	//Llamamos al formulario
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	$location.='#'.$_GET['anclaje'];
	$form_obligatorios = '';
	$form_trabajo= 'perm';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';	
}

?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// tomo los datos del usuario
$query = "SELECT Nombre
FROM `usuarios_listado`
WHERE idUsuario = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);

//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
$z=" AND core_permisos.idAdmpm>0";	
}else{
$z=" AND core_permisos.visualizacion={$arrUsuario['idSistema']} OR core_permisos.visualizacion=9998 ";	
}
// SE TRAE UN LISTADO DE TODOS LOS PERMISOS ASIGNADOS SOLO A UN USUARIO
$arrPermisos = array();
$query =
"SELECT 
core_permisos.idAdmpm, 
core_permisos.Nombre AS Nombre_permiso,
core_permisos_cat.Nombre AS Categoria,
core_permisos.visualizacion,
core_sistemas.Nombre AS ver,
(SELECT COUNT(idPermisos) FROM usuarios_permisos WHERE idAdmpm = core_permisos.idAdmpm AND idUsuario = {$_GET['id']}) AS contar,
(SELECT idPermisos FROM usuarios_permisos WHERE idAdmpm = core_permisos.idAdmpm AND idUsuario = {$_GET['id']}) AS idpermiso,
(SELECT level FROM usuarios_permisos WHERE idAdmpm = core_permisos.idAdmpm AND idUsuario = {$_GET['id']}) AS level
FROM `core_permisos`
INNER JOIN `core_permisos_cat`     ON core_permisos_cat.id_pmcat        = core_permisos.id_pmcat
LEFT JOIN `core_sistemas`          ON core_sistemas.idSistema           = core_permisos.visualizacion
WHERE core_permisos.idAdmpm>=0 ".$z."
ORDER BY Categoria ASC,  Nombre_permiso ASC  
";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPermisos,$row );
}
mysqli_free_result($resultado);
?>
<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Usuario : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div> 

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'usuarios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos</a></li>
				<li class="active"><a href="<?php echo 'usuarios_listado_permisos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Permisos</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_tipo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Tipo</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contraseña</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_widget.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Widget</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_bodegas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Bodegas</a></li>
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Permisos</th> 
						<th>Visualizacion</th>
						<th>Acciones</th>
						<th width="160">Nivel</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					//Obtengo la ubicacion completa para devolver al punto inicial
					$xxx ='&id='.$_GET['id'];//Ciclo
					foreach ($arrPermisos as $permiso) { ?>
					<tr> 
						<td>
							<a name="<?php echo $permiso['idAdmpm'] ?>"></a>
							<?php echo $permiso['Categoria'].' - '.$permiso['Nombre_permiso']; ?>
						</td> 
						<td>
						<?php
						if($permiso['visualizacion']==9999){   
							echo 'Solo Superadministradores';
						}elseif($permiso['visualizacion']==9998){   
							echo 'Todos';
						}else{   
							echo $permiso['ver'];
						} ?>
						</td>
						<td>
							<div style="width:90px;" >
								<?php $w='&anclaje='.$permiso['idAdmpm'];?>
								<ul class="interruptor">   
								   <?php if ( $permiso['contar']=='1' ) {?>   
									<li class="primer_int"><a href="<?php echo $new_location.$xxx; ?>&prm_del=<?php echo $permiso['idpermiso'].$w; ?>">OFF</a></li>
									<li class="ultimo_int on"><a href="#">ON</a></li>
								   <?php } else {?>
									<li class="primer_int on"><a href="#">OFF</a></li>
									<li class="ultimo_int"><a href="<?php echo $new_location.$xxx; ?>&prm_add=<?php echo $permiso['idAdmpm'].$w; ?>">ON</a></li>
								   <?php }?>    
								</ul>
							</div> 
						</td>
						<td>
							<div class="widthtd160">
								<?php if ($permiso['level'] > 0){ ?>
								  <a href="<?php echo $new_location.$xxx.'&perm='.$permiso['idpermiso'].'&mod=1'.$w ?>" title="Solo ver"                       class="icon-number-1 info-tooltip <?php if ($permiso['level'] == 1) { echo 'icon-number-selected';} ?>"></a>
								  <a href="<?php echo $new_location.$xxx.'&perm='.$permiso['idpermiso'].'&mod=2'.$w ?>" title="Ver - Editar"                   class="icon-number-2 info-tooltip <?php if ($permiso['level'] == 2) { echo 'icon-number-selected';} ?>"></a>
								  <a href="<?php echo $new_location.$xxx.'&perm='.$permiso['idpermiso'].'&mod=3'.$w ?>" title="Ver - Editar - Crear"           class="icon-number-3 info-tooltip <?php if ($permiso['level'] == 3) { echo 'icon-number-selected';} ?>"></a>
								  <a href="<?php echo $new_location.$xxx.'&perm='.$permiso['idpermiso'].'&mod=4'.$w ?>" title="Ver - Editar - Crear - Borrar"  class="icon-number-4 info-tooltip <?php if ($permiso['level'] == 4) { echo 'icon-number-selected';} ?>"></a>
								<?php } ?>
							</div>
						</td> 
					</tr> 
					<?php } ?>
				</tbody>
			</table>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>


<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
