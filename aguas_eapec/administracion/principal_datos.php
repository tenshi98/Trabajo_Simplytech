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
$original = "principal_datos.php";
$location = $original;
$location .= '?d=d';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['edit_datos']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idUsuario,Nombre,email,Rut,fNacimiento';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';
}
//formulario para editar
if ( !empty($_POST['edit_clave']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idUsuario,oldpassword,password,repassword';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_img']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'submit_img';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_img']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_img';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/usuarios_listado.php';	
}
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//variable con el nombre de la categoria de la transaccion
$rowlevel['nombre_categoria']='Mis Datos';
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
            <h3><i class="fa fa-dashboard"></i> Mis Datos Personales</h3>
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
if (isset($_GET['edited']))   {$error['usuario'] 	  = 'sucess/Tus datos han sido modificados correctamente';}
if (isset($_GET['password'])) {$error['usuario'] 	  = 'sucess/Tu clave ha sido modificada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id_img']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT Direccion_img, Nombre
FROM `usuarios_listado`
WHERE idUsuario = {$arrUsuario['idUsuario']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); ?>
 
 
    
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion Imagen usuario: <?php echo $rowdata['Nombre']; ?></h5>
		</header>
		<div id="div-1" class="body">
        <?php if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){?>
        
        <div class="col-lg-10 fcenter">
          <img src="upload/<?php echo $rowdata['Direccion_img'] ?>" width="100%" > 
          </div><br/>
            <a href="<?php echo $location.'&del_img=true'; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Borrar Imagen</a>
            <a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
            <div class="clearfix"></div>
        
		<?php }else{?>


		<form class="form-horizontal" method="post" enctype="multipart/form-data" name="form1">
			
			<?php           
			//se dibujan los inputs
			echo form_input_file('Seleccionar archivo','imgLogo');
			?> 

			<div class="form-group">
            	<input type="hidden" name="idUsuario" value="<?php echo $arrUsuario['idUsuario']; ?>">
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_img"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
           <?php }?>       
                  
                    
		</div>
	</div>
</div>     
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} elseif ( ! empty($_GET['clave']) ) { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar Mi Contraseña</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($oldpassword)) {   $x1  = $oldpassword;  }else{$x1  = '';}
            if(isset($password)) {      $x2  = $password;     }else{$x2  = '';}
            if(isset($repassword)) {    $x3  = $repassword;   }else{$x3  = '';}
            
			//se dibujan los inputs
			echo '<h4>Atencion!:Esto cerrara tu sesion actual</h4>';
        	echo form_input('password', 'Password Antigua', 'oldpassword', $x1, 2);
            echo form_input('password', 'Password', 'password', $x2, 2);
            echo form_input('password', 'Repetir Password', 'repassword', $x3, 2);
			?> 
                      
			<div class="form-group">
            	<input type="hidden" name="idUsuario" value="<?php echo $arrUsuario['idUsuario']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Cambiar Password" name="edit_clave">
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
 
<?php /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT email, Nombre, Rut, fNacimiento, Direccion, Fono, Ciudad, Comuna
FROM `usuarios_listado`
WHERE idUsuario = {$arrUsuario['idUsuario']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
?>
 
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificar Mis Datos</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
			
			<?php 
			//Se verifican si existen los datos
            if(isset($Nombre)) {        $x5  = $Nombre;       }else{$x5  = $rowdata['Nombre'];}
            if(isset($Fono)) {          $x6  = $Fono;         }else{$x6  = $rowdata['Fono'];}
            if(isset($email)) {         $x7  = $email;        }else{$x7  = $rowdata['email'];}
            if(isset($Rut)) {           $x8  = $Rut;          }else{$x8  = $rowdata['Rut'];}
            if(isset($fNacimiento)) {   $x9  = $fNacimiento;  }else{$x9  = $rowdata['fNacimiento'];}
            if(isset($Ciudad)) {        $x10 = $Ciudad;       }else{$x10 = $rowdata['Ciudad'];}
            if(isset($Comuna)) {        $x11 = $Comuna;       }else{$x11 = $rowdata['Comuna'];}
            if(isset($Direccion)) {     $x12 = $Direccion;    }else{$x12 = $rowdata['Direccion'];}
            
			//se dibujan los inputs
            echo form_input('text', 'Nombre', 'Nombre', $x5, 2); 
            echo form_input_phone('Fono','Fono', $x6, 1);
            echo form_input_icon('text', 'Email', 'email', $x7, 2,'fa fa-envelope-o');
            echo form_input_icon('text', 'Rut', 'Rut', $x8, 2,'fa fa-exclamation-triangle');
            echo form_date('Fecha de Nacimiento','fNacimiento', $x9, 2); 
            echo form_input_icon('text', 'Ciudad', 'Ciudad', $x10, 1,'fa fa-map');	
            echo form_input_icon('text', 'Comuna', 'Comuna', $x11, 1,'fa fa-map');	
            echo form_input_icon('text', 'Direccion', 'Direccion', $x12, 1,'fa fa-map');
            
			?> 
			
			<div class="form-group">
            	<input type="hidden" name="idUsuario" value="<?php echo $arrUsuario['idUsuario']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="edit_datos">
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
 
<?php /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  {
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
core_sistemas.Nombre AS RazonSocial,
usuarios_listado.Direccion_img
FROM `usuarios_listado`
LEFT JOIN `core_sistemas`    ON core_sistemas.idSistema   = usuarios_listado.idSistema
WHERE idUsuario = {$arrUsuario['idUsuario']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	?>

<div class="col-lg-12">
	<div class="box">
		<header>
			<h5>Mis datos</h5>
			<div class="toolbar"></div>
		</header>
        <div class="body">
			<div class="col-lg-4">
				<?php if ($rowdata['Direccion_img']=='') { ?>
					<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="img/usr.png">
				<?php }else{  ?>
					<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $arrUsuario['Direccion_img']; ?>">
				<?php }?>

				<div class="btn-group-vertical" role="group" aria-label="..." style="margin-top:10px; width:100%;">
					<a href="<?php echo $location ?>&id=true" class="btn btn-primary" >Editar Datos Personales</a>
					<a href="<?php echo $location ?>&id_img=true" class="btn btn-primary" >Cambiar Imagen</a>
					<a href="<?php echo $location ?>&clave=true" class="btn btn-primary">Cambiar Password</a>
				</div>
			</div>
			<div class="col-lg-8">
				<h2 class="text-primary">Datos del Perfil</h2>
				<p class="text-muted"><strong>Usuario : </strong><?php echo $rowdata['usuario']; ?></p>
				<p class="text-muted"><strong>Tipo de usuario : </strong><?php echo $rowdata['tipo']; ?></p>
				
				<h2 class="text-primary">Datos Personales</h2>
				<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
				<p class="text-muted"><strong>Fono : </strong><?php echo $rowdata['Fono']; ?></p>
				<p class="text-muted"><strong>Email : </strong><?php echo $rowdata['email']; ?></p>
				<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
				<p class="text-muted"><strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?></p>
				<p class="text-muted"><strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?></p>
				<p class="text-muted"><strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?></p>
				<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?></p>
				<p class="text-muted"><strong>Empresa Relacionada : </strong><?php echo $rowdata['RazonSocial']; ?></p>
			</div>	
            <div class="clearfix"></div>
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
