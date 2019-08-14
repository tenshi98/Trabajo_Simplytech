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
$original = "prospectos_transportistas_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                              $location .= "&Nombre=".$_GET['Nombre'];                               $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idEstadoFidelizacion']) && $_GET['idEstadoFidelizacion'] != ''){  $location .= "&idEstadoFidelizacion=".$_GET['idEstadoFidelizacion'];   $search .= "&idEstadoFidelizacion=".$_GET['idEstadoFidelizacion'];}
if(isset($_GET['idEtapa']) && $_GET['idEtapa'] != ''){                            $location .= "&idEtapa=".$_GET['idEtapa'];                             $search .= "&idEtapa=".$_GET['idEtapa'];}

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
	require_once 'A1XRXS_sys/xrxs_form/prospectos_transportistas_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/prospectos_transportistas_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Prospecto creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Prospecto editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Prospecto borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
// Se traen todos los datos de mi usuario
$query = "SELECT  
prospectos_transportistas_listado.Nombre,
prospectos_transportistas_listado.Fono, 
prospectos_transportistas_listado.email, 
prospectos_transportistas_listado.email_noti, 
prospectos_transportistas_listado.F_Ingreso, 

core_sistemas.Nombre AS Sistema,
prospectos_estado_fidelizacion.Nombre AS Fidelizacion,
prospectos_transportistas_etapa.Nombre AS Etapa

FROM `prospectos_transportistas_listado`
LEFT JOIN `core_sistemas`                     ON core_sistemas.idSistema                              = prospectos_transportistas_listado.idSistema
LEFT JOIN `prospectos_estado_fidelizacion`    ON prospectos_estado_fidelizacion.idEstadoFidelizacion  = prospectos_transportistas_listado.idEstadoFidelizacion
LEFT JOIN `prospectos_transportistas_etapa`   ON prospectos_transportistas_etapa.idEtapa              = prospectos_transportistas_listado.idEtapa

WHERE prospectos_transportistas_listado.idProspecto = {$_GET['id']}";
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
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Prospecto</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'prospectos_transportistas_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'prospectos_transportistas_listado_etapas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Etapa Fidelizacion</a></li>
				<li class=""><a href="<?php echo 'prospectos_transportistas_listado_fidelizacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado Fidelizacion</a></li>
				<li class=""><a href="<?php echo 'prospectos_transportistas_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/usr.png">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Prospecto</h2>
						<p class="text-muted">
							<strong>Nombre Prospecto: </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Telefono : </strong><?php echo $rowdata['Fono']; ?><br/>
							<strong>Email Prospecto: </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
							<strong>Email Respuesta: </strong><a href="mailto:<?php echo $rowdata['email_noti']; ?>"><?php echo $rowdata['email_noti']; ?></a><br/>
							<strong>Fecha de Registro : </strong><?php echo Fecha_estandar($rowdata['F_Ingreso']); ?><br/>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['Sistema']; ?><br/>
							<strong>Estado Fidelizacion: </strong><?php echo $rowdata['Fidelizacion']; ?><br/>
							<strong>Etapa Fidelizacion: </strong><?php echo $rowdata['Etapa']; ?>
						</p>
					</div>
					
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Prospecto</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {       $x1  = $Nombre;       }else{$x1  = '';}
				if(isset($Fono)) {         $x2  = $Fono;         }else{$x2  = '';}
				if(isset($email)) {        $x3  = $email;        }else{$x3  = '';}
				if(isset($email_noti)) {   $x4  = $email_noti;   }else{$x4  = '';}
									
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3 class="register-heading">Datos Chofer</h3>';
				$Form_Imputs->form_input_text( 'Nombre del chofer', 'Nombre', $x1, 2);
				$Form_Imputs->form_input_phone('Telefono', 'Fono', $x2, 2);
				$Form_Imputs->form_input_icon( 'Email', 'email', $x3, 1,'fa fa-envelope-o');
						
				echo '<h3 class="register-heading">Datos Apoderado</h3>';
				$Form_Imputs->form_input_icon( 'Email de notificacion', 'email_noti', $x4, 2,'fa fa-envelope-o');
						
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('F_Ingreso', fecha_actual(), 2);			
				$Form_Imputs->form_input_hidden('idEstadoFidelizacion', 1, 2);			
				$Form_Imputs->form_input_hidden('idEtapa', 1, 2);	
				?>
								
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php require_once '../LIBS_js/validator/form_validator.php';?>
			
			
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'ORDER BY prospectos_transportistas_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':   $order_by = 'ORDER BY prospectos_transportistas_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'etapa_asc':     $order_by = 'ORDER BY prospectos_transportistas_etapa.Nombre ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Etapa Ascendente';break;
		case 'etapa_desc':    $order_by = 'ORDER BY prospectos_transportistas_etapa.Nombre DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Etapa Descendente';break;
	
		default: $order_by = 'ORDER BY prospectos_transportistas_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY prospectos_transportistas_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE prospectos_transportistas_listado.idProspecto!=0";
//verifico que sea un administrador
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND prospectos_transportistas_listado.idSistema>=0";	
}else{
	$z.=" AND prospectos_transportistas_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND prospectos_transportistas_listado.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";	
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                              $z .= " AND prospectos_transportistas_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idEstadoFidelizacion']) && $_GET['idEstadoFidelizacion'] != ''){  $z .= " AND prospectos_transportistas_listado.idEstadoFidelizacion=".$_GET['idEstadoFidelizacion'];}
if(isset($_GET['idEtapa']) && $_GET['idEtapa'] != ''){                            $z .= " AND prospectos_transportistas_listado.idEtapa=".$_GET['idEtapa'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT prospectos_transportistas_listado.idProspecto FROM `prospectos_transportistas_listado` LEFT JOIN `prospectos_transportistas_etapa`  ON prospectos_transportistas_etapa.idEtapa = prospectos_transportistas_listado.idEtapa ".$z;
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
$arrUsers = array();
$query = "SELECT 
prospectos_transportistas_listado.idProspecto,
prospectos_transportistas_listado.Nombre,
core_sistemas.Nombre AS sistema,
prospectos_transportistas_etapa.Nombre AS Etapa

FROM `prospectos_transportistas_listado`
LEFT JOIN `core_sistemas`                    ON core_sistemas.idSistema                     = prospectos_transportistas_listado.idSistema
LEFT JOIN `prospectos_transportistas_etapa`  ON prospectos_transportistas_etapa.idEtapa     = prospectos_transportistas_listado.idEtapa
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
array_push( $arrUsers,$row );
}

?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Prospecto</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {                $x1 = $Nombre;                 }else{$x1 = '';}
				if(isset($idEstadoFidelizacion)) {  $x2 = $idEstadoFidelizacion;   }else{$x2 = '';}
				if(isset($idEtapa)) {               $x3 = $idEtapa;                }else{$x3 = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombres', 'Nombre', $x1, 1);
				$Form_Imputs->form_select('Estado Fidelizacion','idEstadoFidelizacion', $x2, 1, 'idEstadoFidelizacion', 'Nombre', 'prospectos_estado_fidelizacion', 0, '', $dbConn);
				$Form_Imputs->form_select('Etapa','idEtapa', $x3, 1, 'idEtapa', 'Nombre', 'prospectos_transportistas_etapa', 0, '', $dbConn);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>
        </div>
	</div>
</div>  
<div class="clearfix"></div>                  
                                 
<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Prospectos</h5>	
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
							<div class="pull-left">Nombre del Prospecto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Etapa</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=etapa_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=etapa_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Nombre']; ?></td>		
						<td><?php echo $usuarios['Etapa']; ?></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_prospecto_transportista.php?view='.$usuarios['idProspecto']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idProspecto']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$usuarios['idProspecto'];
									$dialogo   = '¿Realmente deseas eliminar al prospecto '.$usuarios['Nombre'].'?';?>
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
	
<?php require_once '../LIBS_js/modal/modal.php';?>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
