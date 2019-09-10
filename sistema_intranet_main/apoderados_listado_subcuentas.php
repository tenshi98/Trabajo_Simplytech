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
$original = "apoderados_listado.php";
$location = $original;
$new_location = "apoderados_listado_subcuentas.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//se agregan ubicaciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_subcuentas.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_subcuentas.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//se agregan ubicaciones
	$location=$new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/apoderados_subcuentas.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Subcuenta creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Subcuenta editada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Subcuenta borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['edit']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT Nombre, Usuario, Password, email
FROM `apoderados_subcuentas`
WHERE idSubcuenta = {$_GET['edit']}";
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

 ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Subcuenta</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {     $x1  = $Nombre;    }else{$x1  = $rowdata['Nombre'];}
				if(isset($Usuario)) {    $x2  = $Usuario;   }else{$x2  = $rowdata['Usuario'];}
				if(isset($Password)) {   $x3  = $Password;  }else{$x3  = $rowdata['Password'];}
				if(isset($email)) {      $x4  = $email;     }else{$x4  = $rowdata['email'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombres', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_icon( 'Nombre de Usuario', 'Usuario', $x2, 2,'fa fa-user');
				$Form_Imputs->form_input_password('Contraseña', 'Password', $x3, 2);
				$Form_Imputs->form_input_icon( 'Email', 'email', $x4, 2,'fa fa-envelope-o');
				
				$Form_Imputs->form_input_hidden('idSubcuenta', $_GET['edit'], 2);
				?>
				
				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Subcuenta</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
   
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {     $x1  = $Nombre;    }else{$x1  = '';}
				if(isset($Usuario)) {    $x2  = $Usuario;   }else{$x2  = '';}
				if(isset($Password)) {   $x3  = $Password;  }else{$x3  = '';}
				if(isset($email)) {      $x4  = $email;     }else{$x4  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_icon( 'Nombre de Usuario', 'Usuario', $x2, 2,'fa fa-user');
				$Form_Imputs->form_input_password('Contraseña', 'Password', $x3, 2);
				$Form_Imputs->form_input_icon( 'Email', 'email', $x4, 2,'fa fa-envelope-o');
				
				$Form_Imputs->form_input_hidden('idApoderado', $_GET['id'], 2);
				?>

				<div class="form-group">		
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $new_location.'&id='.$_GET['id']; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>


 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}else{
// Se traen todos los datos del trabajador
$query = "SELECT Nombre,ApellidoPat,ApellidoMat, idOpciones_1,idOpciones_2
FROM `apoderados_listado`
WHERE idApoderado = {$_GET['id']}";
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
$arrSubcuentas = array();
$query = "SELECT idSubcuenta, Nombre, Usuario, Password, email
FROM `apoderados_subcuentas`
WHERE idApoderado = {$_GET['id']}
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrSubcuentas,$row );
}
?>

<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Apoderado</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Listado de subcuentas</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<?php if ($rowlevel['level']>=3){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&new=true'; ?>" class="btn btn-default fright margin_width" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Subcuenta</a><?php }?>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'apoderados_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'apoderados_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos</a></li>
				<li class=""><a href="<?php echo 'apoderados_listado_ubicacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Ubicacion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'apoderados_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
						<?php
						//Si se utiliza la APP 
						if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){
							//Si se utiliza subcuentas
							if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
								<li class="active"><a href="<?php echo 'apoderados_listado_subcuentas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Subcuentas</a></li>
							<?php }else{ ?>
								<li class=""><a href="<?php echo 'apoderados_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Password</a></li>
							<?php } ?>
						<?php } ?>
						<li class=""><a href="<?php echo 'apoderados_listado_hijos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Hijos</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contrato</a></li>
						<li class=""><a href="<?php echo 'apoderados_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Foto</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Email</th>
						<th>Usuario</th>
						<th>Password</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrSubcuentas as $sub) { ?>
					<tr class="odd">		
						<td><?php echo $sub['Nombre']; ?></td>	
						<td><?php echo $sub['email']; ?></td>
						<td><?php echo $sub['Usuario']; ?></td>	
						<td><?php echo $sub['Password']; ?></td>		
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $new_location.'&id='.$_GET['id'].'&edit='.$sub['idSubcuenta']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $new_location.'&id='.$_GET['id'].'&del='.$sub['idSubcuenta'];
									$dialogo   = '¿Realmente deseas eliminar al usuario '.$sub['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
