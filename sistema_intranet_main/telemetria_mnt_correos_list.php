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
$original = "telemetria_mnt_correos_list.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idCorreosCat']) && $_GET['idCorreosCat'] != ''){  $location .= "&idCorreosCat=".$_GET['idCorreosCat'];  $search .= "&idCorreosCat=".$_GET['idCorreosCat'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){        $location .= "&idUsuario=".$_GET['idUsuario'];        $search .= "&idUsuario=".$_GET['idUsuario'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_mnt_correos_list.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_mnt_correos_list.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/telemetria_mnt_correos_list.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Correo Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Correo Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Correo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) {
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
// Se traen todos los datos de mi usuario
$query = "SELECT idCorreosCat, idUsuario
FROM `telemetria_mnt_correos_list`
WHERE idCorreos = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado); ?>
 
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Correo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idCorreosCat)) {    $x1  = $idCorreosCat;    }else{$x1  = $rowdata['idCorreosCat'];}
				if(isset($idUsuario)) {       $x2  = $idUsuario;       }else{$x2  = $rowdata['idUsuario'];}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Categoria','idCorreosCat', $x1, 2, 'idCorreosCat', 'Nombre', 'telemetria_mnt_correos_cat', 0, '', $dbConn);
				$Form_Imputs->form_select_join_filter('Usuario','idUsuario', $x2, 2, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				
				$Form_Imputs->form_input_hidden('idCorreos', $_GET['id'], 2);
				?>
			
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {  
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Correo</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCorreosCat)) {    $x1  = $idCorreosCat;    }else{$x1  = '';}
				if(isset($idUsuario)) {       $x2  = $idUsuario;       }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Categoria','idCorreosCat', $x1, 2, 'idCorreosCat', 'Nombre', 'telemetria_mnt_correos_cat', 0, '', $dbConn);
				$Form_Imputs->form_select_join_filter('Usuario','idUsuario', $x2, 2, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				?>

				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'categoria_asc':  $order_by = 'ORDER BY telemetria_mnt_correos_cat.Nombre ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Categoria Ascendente';break;
		case 'categoria_desc': $order_by = 'ORDER BY telemetria_mnt_correos_cat.Nombre DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Categoria Descendente';break;
		case 'nombre_asc':     $order_by = 'ORDER BY usuarios_listado.Nombre ASC ';                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':    $order_by = 'ORDER BY usuarios_listado.Nombre DESC ';               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'email_asc':      $order_by = 'ORDER BY usuarios_listado.email ASC ';                 $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Email Ascendente';break;
		case 'email_desc':     $order_by = 'ORDER BY usuarios_listado.email DESC ';                $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Email Descendente';break;
		
		default: $order_by = 'ORDER BY telemetria_mnt_correos_cat.Nombre ASC, usuarios_listado.email ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Categoria, Email Ascendente';
	}
}else{
	$order_by = 'ORDER BY telemetria_mnt_correos_cat.Nombre ASC, usuarios_listado.email ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Categoria, Email Ascendente';
}
/**********************************************************/
//Verifico el tipo de usuario que esta ingresando
$usrfil = 'usuarios_sistemas.idSistema='.$_SESSION['usuario']['basic_data']['idSistema'].' AND usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';	
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_mnt_correos_list.idCorreos!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idCorreosCat']) && $_GET['idCorreosCat'] != ''){  $z .= " AND telemetria_mnt_correos_cat.idCorreosCat=".$_GET['idCorreosCat'];}
if(isset($_GET['idUsuario']) && $_GET['idUsuario'] != ''){        $z .= " AND telemetria_mnt_correos_cat.idUsuario=".$_GET['idUsuario'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idCorreos FROM `telemetria_mnt_correos_list` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrComunas = array();
$query = "SELECT 
telemetria_mnt_correos_list.idCorreos,
usuarios_listado.Nombre AS NombreEmail,
usuarios_listado.email AS Email,
telemetria_mnt_correos_cat.Nombre AS Categoria
FROM `telemetria_mnt_correos_list`
LEFT JOIN `telemetria_mnt_correos_cat` ON telemetria_mnt_correos_cat.idCorreosCat  = telemetria_mnt_correos_list.idCorreosCat
LEFT JOIN `usuarios_listado`           ON usuarios_listado.idUsuario               = telemetria_mnt_correos_list.idUsuario
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrComunas,$row );
}?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Correo</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idCorreosCat)) {    $x1  = $idCorreosCat;    }else{$x1  = '';}
				if(isset($idUsuario)) {       $x2  = $idUsuario;       }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select('Categoria','idCorreosCat', $x1, 1, 'idCorreosCat', 'Nombre', 'telemetria_mnt_correos_cat', 0, '', $dbConn);
				$Form_Imputs->form_select_join_filter('Usuario','idUsuario', $x2, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas', $usrfil, $dbConn);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                      
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Correos</h5>
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Categoria</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=categoria_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=categoria_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Email</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=email_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=email_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrComunas as $comunas) { ?>
					<tr class="odd">
						<td><?php echo $comunas['Categoria']; ?></td>
						<td><?php echo $comunas['NombreEmail']; ?></td>
						<td><?php echo $comunas['Email']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$comunas['idCorreos']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$comunas['idCorreos'];
									$dialogo   = '¿Realmente deseas eliminar el correo '.$comunas['NombreEmail'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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
