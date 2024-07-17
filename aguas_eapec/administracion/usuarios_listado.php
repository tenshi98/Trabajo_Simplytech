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
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'usuario,password,tipo,Nombre,email,Direccion,idSistema';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
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
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Usuario creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Usuario editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Usuario borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
usuarios_listado.usuario, 
usuarios_listado.tipo, 
usuarios_listado.email, 
usuarios_listado.Nombre, 
usuarios_listado.Rut, 
usuarios_listado.fNacimiento, 
usuarios_listado.Direccion, 
usuarios_listado.Fono, 
usuarios_listado.Ciudad, 
usuarios_listado.Comuna,
usuarios_listado.Ultimo_acceso,
usuarios_listado.Direccion_img,
usuarios_estado.Nombre AS estado,
core_sistemas.Nombre AS RazonSocial
FROM `usuarios_listado`
LEFT JOIN `usuarios_estado`   ON usuarios_estado.idEstado     = usuarios_listado.idEstado
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema        = usuarios_listado.idSistema
WHERE idUsuario = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);



?>
<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Usuario : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div>  

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'usuarios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_permisos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Permisos</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_tipo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Tipo</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contraseña</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_widget.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Widget</a></li>
				<li class=""><a href="<?php echo 'usuarios_listado_bodegas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Bodegas</a></li>
				
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="img/usr.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-lg-8">
						<h2 class="text-primary">Datos del Perfil</h2>
						<p class="text-muted"><strong>Usuario : </strong><?php echo $rowdata['usuario']; ?></p>
						<p class="text-muted"><strong>Tipo de usuario : </strong><?php echo $rowdata['tipo']; ?></p>
						<p class="text-muted"><strong>Estado : </strong><?php echo $rowdata['estado']; ?></p>
						<p class="text-muted"><strong>Ultimo Acceso : </strong><?php echo $rowdata['Ultimo_acceso']; ?></p>
						
						<h2 class="text-primary">Datos Personales</h2>
						<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
						<p class="text-muted"><strong>Fono : </strong><?php echo $rowdata['Fono']; ?></p>
						<p class="text-muted"><strong>Email : </strong><?php echo $rowdata['email']; ?></p>
						<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
						<p class="text-muted"><strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?></p>
						<p class="text-muted"><strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?></p>
						<p class="text-muted"><strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?></p>
						<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?></p>
						<p class="text-muted"><strong>Sistema Relacionado : </strong><?php echo $rowdata['RazonSocial']; ?></p>
					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nuevo Usuario</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1">
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombusuariore)) {  $x1  = $usuario;        }else{$x1  = '';}
				if(isset($password)) {       $x2  = $password;       }else{$x2  = '';}
				if(isset($tipo)) {           $x3  = $tipo;           }else{$x3  = '';}
				if(isset($Nombre)) {         $x4  = $Nombre;         }else{$x4  = '';}
				if(isset($Fono)) {           $x5  = $Fono;           }else{$x5  = '';}
				if(isset($email)) {          $x6  = $email;          }else{$x6  = '';}
				if(isset($Rut)) {            $x7  = $Rut;            }else{$x7  = '';}
				if(isset($fNacimiento)) {    $x8  = $fNacimiento;    }else{$x8  = '';}
				if(isset($Ciudad)) {         $x9  = $Ciudad;         }else{$x9  = '';}
				if(isset($Comuna)) {         $x10 = $Comuna;         }else{$x10 = '';}
				if(isset($Direccion)) {      $x11 = $Direccion;      }else{$x11 = '';}
				if(isset($idSistema)) {      $x12 = $idSistema;      }else{$x12 = '';}

				//se dibujan los inputs
				echo '<h3>Datos Basicos</h3>';
				echo form_input('text', 'Nombre de Usuario', 'usuario', $x1, 2);
				echo form_input('text', 'Contraseña', 'password', $x2, 2);
				echo form_select('Tipo de usuario','tipo', $x3, 2, 'Nombre', 'Nombre', 'usuarios_tipos', 0, $dbConn);
				
				echo '<h3>Datos Personales</h3>';
				echo form_input('text', 'Nombres', 'Nombre', $x4, 2);
				echo form_input_phone('Fono', 'Fono', $x5, 1);
				echo form_input_icon('text', 'Email', 'email', $x6, 2,'fa fa-envelope-o');
				echo form_input_icon('text', 'Rut', 'Rut', $x7, 1,'fa fa-exclamation-triangle');
				echo form_date('F Nacimiento','fNacimiento', $x8, 1);
				echo form_input_icon('text', 'Ciudad', 'Ciudad', $x9, 1,'fa fa-map');	
				echo form_input_icon('text', 'Comuna', 'Comuna', $x10, 1,'fa fa-map');	
				echo form_input_icon('text', 'Direccion', 'Direccion', $x11, 2,'fa fa-map');
				if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select('Sistema','idSistema', $x12, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}
				?>
								
				<div class="form-group">
					<input type="hidden" name="idEstado"  value="1">		
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//Variable con la ubicacion
$z="WHERE usuarios_listado.tipo!='SuperAdmin'";
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND usuarios_listado.idSistema>=0";	
}else{
	$z.=" AND usuarios_listado.idSistema={$arrUsuario['idSistema']}";	
}
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND usuarios_listado.Nombre LIKE '%{$_GET['search']}%' ";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idUsuario FROM `usuarios_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
usuarios_listado.idUsuario,
usuarios_listado.usuario,
usuarios_listado.tipo, 
usuarios_listado.Nombre,
usuarios_listado.Ultimo_acceso,
usuarios_estado.Nombre AS estado,
core_sistemas.Nombre AS sistema
FROM `usuarios_listado`
LEFT JOIN `usuarios_estado`   ON usuarios_estado.idEstado       = usuarios_listado.idEstado
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema        = usuarios_listado.idSistema
".$z."
ORDER BY usuarios_listado.tipo ASC, usuarios_listado.usuario ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUsers,$row );
}
?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Usuario</label>
    <div class="col-lg-5">	
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >		
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Nombre">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onclick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>	
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Usuario</a><?php } ?>
</div>
<div class="clearfix"></div>                       



                                
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Usuarios</h5>
			<div class="toolbar">
				<?php 
				if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>	
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Usuario</th>
						<th>Nombre del usuario</th>
						<th>Ultimo acceso</th>
						<th>Tipo Usuario</th>
						<th>Sistema</th>
						<th>Estado</th>
						<th width="160">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['usuario']; ?></td>		
						<td><?php echo $usuarios['Nombre']; ?></td>
						<td><?php echo $usuarios['Ultimo_acceso']; ?></td>		
						<td><?php echo $usuarios['tipo']; ?></td>
						<td><?php echo $usuarios['sistema']; ?></td>		
						<td><?php echo $usuarios['estado']; ?></td>		
						<td>
							<div class="btn-group widthtd160" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_usuario.php?view='.$usuarios['idUsuario']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idUsuario']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$usuarios['idUsuario'];
									$dialogo   = '¿Realmente deseas eliminar al usuario '.$usuarios['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
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
			if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
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
