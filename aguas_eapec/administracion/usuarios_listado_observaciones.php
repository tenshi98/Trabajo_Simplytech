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
$new_location = "usuarios_listado_observaciones.php";
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
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	$form_obligatorios = 'idCliente,idUsuario,Fecha,Observacion';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_observaciones.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	$form_obligatorios = 'idObservacion,Observacion';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_observaciones.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_observaciones.php';	
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
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Observacion creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Observacion editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Observacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT Observacion
FROM `usuarios_observaciones`
WHERE idObservacion = {$_GET['edit']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); 
 ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1">

				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = $rowdata['Observacion'];}

				//se dibujan los inputs
				echo form_textarea('Observaciones', 'Observacion', $x1, 2);
				?>
				
				<div class="form-group">
					<input type="hidden" name="idObservacion" value="<?php echo $_GET['edit'] ?>">			
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { ?>

<div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nueva Observacion</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1">
   
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = '';}

				//se dibujan los inputs
				echo form_textarea('Observaciones', 'Observacion', $x1, 2);
				?>

				<div class="form-group">
					<input type="hidden" name="idUsuario_observado" value="<?php echo $_GET['id'] ?>">
					<input type="hidden" name="idUsuario" value="<?php echo $arrUsuario['idUsuario'] ?>">
					<input type="hidden" name="Fecha" value="<?php echo fecha_actual() ?>">			
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">	
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT 
usuario_observado.Nombre AS nombre_cliente,
usuario_evaluador.Nombre AS nombre_usuario,
usuarios_observaciones.Fecha,
usuarios_observaciones.Observacion
FROM `usuarios_observaciones`
LEFT JOIN `usuarios_listado` usuario_observado  ON usuario_observado.idUsuario     = usuarios_observaciones.idUsuario_observado
LEFT JOIN `usuarios_listado` usuario_evaluador  ON usuario_evaluador.idUsuario     = usuarios_observaciones.idUsuario
WHERE usuarios_observaciones.idObservacion = {$_GET['view']}
ORDER BY usuarios_observaciones.idObservacion ASC ";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
?>
<div class="col-lg-8">
	<div class="box">	
		<header>		
			<h5>Ver Datos de la Observacion</h5>		
			<div class="toolbar"></div>	
		</header>
        <div class="body">
            <h2 class="text-primary">Datos Basicos</h2>
            <p class="text-muted"><strong>Cliente : </strong><?php echo $rowdata['nombre_cliente']; ?></p>
            <p class="text-muted"><strong>Usuario : </strong><?php echo $rowdata['nombre_usuario']; ?></p>
            <p class="text-muted"><strong>Fecha : </strong><?php echo Fecha_completa_alt($rowdata['Fecha']); ?></p>
                      
            <h2 class="text-primary">Observacion</h2>
            <p class="text-muted word_break " ><strong>Observacion : </strong><?php echo $rowdata['Observacion']; ?></p>
            
        	
        </div>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}else{
// tomo los datos del usuario
$query = "SELECT tipo,Nombre
FROM `usuarios_listado`
WHERE idUsuario = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_observaciones.idObservacion,
usuario_observado.Nombre AS nombre_cliente,
usuario_evaluador.Nombre AS nombre_usuario,
usuarios_observaciones.Fecha,
usuarios_observaciones.Observacion
FROM `usuarios_observaciones`
LEFT JOIN `usuarios_listado` usuario_observado  ON usuario_observado.idUsuario     = usuarios_observaciones.idUsuario_observado
LEFT JOIN `usuarios_listado` usuario_evaluador  ON usuario_evaluador.idUsuario     = usuarios_observaciones.idUsuario
WHERE usuarios_observaciones.idUsuario_observado = {$_GET['id']}
ORDER BY usuarios_observaciones.idObservacion ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}



?>
<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Usuario : </strong>'.$rowdata['Nombre']; ?></h5>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" >Crear Nueva Observacion</a><?php }?>
</div>
<div class="clearfix"></div>   

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'usuarios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_permisos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Permisos</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_tipo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Tipo</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contraseña</a></li>
				<li class="active"><a href="<?php echo 'usuarios_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_widget.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Widget</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_bodegas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Bodegas</a></li>
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Autor</th>
						<th>Fecha</th>
						<th>Observacion</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrObservaciones as $observaciones) { ?>
					<tr class="odd">		
						<td><?php echo $observaciones['nombre_usuario']; ?></td>
						<td><?php echo $observaciones['Fecha']; ?></td>		
						<td><?php echo cortar($observaciones['Observacion'], 70); ?></td>		
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&view='.$observaciones['idObservacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&edit='.$observaciones['idObservacion']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.$observaciones['idObservacion'];
									$dialogo   = '¿Realmente deseas eliminar la observacion del usuario '.$observaciones['nombre_usuario'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
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

<?php } ?>
<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
