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
$original = "admin_telemetria_encendido_apagado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){   $location .= "&Identificador=".$_GET['Identificador'];   $search .= "&Identificador=".$_GET['Identificador'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                 $location .= "&Nombre=".$_GET['Nombre'];                 $search .= "&Nombre=".$_GET['Nombre'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Si el estado esta distinto de vacio
if ( !empty($_GET['idEstadoEncendido']) ) {
	//Llamamos al formulario
	$form_trabajo= 'EstadoEncendido';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/ 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Equipo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Equipo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Equipo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
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
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':         $order_by = 'ORDER BY telemetria_listado.Nombre ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':        $order_by = 'ORDER BY telemetria_listado.Nombre DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'identificador_asc':  $order_by = 'ORDER BY telemetria_listado.Identificador ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente';break;
		case 'identificador_desc': $order_by = 'ORDER BY telemetria_listado.Identificador DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Identificador Descendente';break;
		
		default: $order_by = 'ORDER BY telemetria_listado.Identificador ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente';
	}
}else{
	$order_by = 'ORDER BY telemetria_listado.Identificador ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z="WHERE telemetria_listado.idEstado=1"; //Solo equipos encendidos
$join = "";
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND telemetria_listado.idSistema>=0";	
}else{
	$z.=" AND telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
	$z.=" AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	$join = "INNER JOIN `usuarios_equipos_telemetria` ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria";	
}
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){  $z .= " AND telemetria_listado.Identificador LIKE '%".$_GET['Identificador']."%'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                $z .= " AND telemetria_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT telemetria_listado.idTelemetria FROM `telemetria_listado` ".$join." ".$z." GROUP BY telemetria_listado.idTelemetria";
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
telemetria_listado.idTelemetria,
telemetria_listado.Identificador,
telemetria_listado.Nombre,
core_sistemas.Nombre AS sistema,
telemetria_listado.idEstadoEncendido,
core_estado_encendido.Nombre AS EstadoEncendido

FROM `telemetria_listado`
LEFT JOIN `core_sistemas`          ON core_sistemas.idSistema                  = telemetria_listado.idSistema
LEFT JOIN `core_estado_encendido`  ON core_estado_encendido.idEstadoEncendido  = telemetria_listado.idEstadoEncendido
".$join."
".$z."
GROUP BY telemetria_listado.idTelemetria
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
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Identificador)) {   $x1  = $Identificador;    }else{$x1  = '';}
				if(isset($Nombre)) {          $x2  = $Nombre;           }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_icon( 'Identificador', 'Identificador', $x1, 1,'fa fa-flag');
				$Form_Imputs->form_input_text( 'Nombre del Equipo', 'Nombre', $x2, 1);	
				
				
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Equipos</h5>
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
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Identificador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=identificador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=identificador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
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
						<td><?php echo $usuarios['Identificador']; ?></td>		
						<td><label class="label <?php if(isset($usuarios['idEstadoEncendido'])&&$usuarios['idEstadoEncendido']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['EstadoEncendido']; ?></label></td>	
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 100px;" id="toggle_event_editing"> 
								<?php if ($rowlevel['level']>=2){?>    				
									<?php if ( $usuarios['idEstadoEncendido']==1 ) {?>   
										<a class="btn btn-sm btn-default unlocked_inactive" href="<?php echo $location.'&idTelemetria='.$usuarios['idTelemetria'].'&idEstadoEncendido=2' ; ?>">OFF</a>
										<a class="btn btn-sm btn-info locked_active" href="#">ON</a>
									<?php } else {?>
										<a class="btn btn-sm btn-info locked_active" href="#">OFF</a>
										<a class="btn btn-sm btn-default unlocked_inactive" href="<?php echo $location.'&idTelemetria='.$usuarios['idTelemetria'].'&idEstadoEncendido=1' ; ?>">ON</a>
									<?php }?>    
								<?php }?>  
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

<?php widget_modal(80, 95); ?>
	
	


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
