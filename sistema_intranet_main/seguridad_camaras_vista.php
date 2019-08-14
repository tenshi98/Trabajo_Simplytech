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
$original = "seguridad_camaras_vista.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){
	$location .= "&Nombre=".$_GET['Nombre'] ;
	$search .= "&Nombre=".$_GET['Nombre'] ;  	
}
/********************************************************************/

//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['idCamara']) ) { 
// Se trae el usuario
$query = "SELECT Nombre, idSubconfiguracion, idTipoCamara, Config_usuario, Config_Password,
Config_IP, Config_Puerto, Config_Web
FROM `seguridad_camaras_listado`
WHERE idCamara = {$_GET['idCamara']}";
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
$rowCamara = mysqli_fetch_assoc ($resultado);
             
//Si existe subconfiguracion
if(isset($rowCamara['idSubconfiguracion'])&&$rowCamara['idSubconfiguracion']==1){
	// Se trae un listado con todos los impuestos existentes
	$arrCamaras = array();
	$query = "SELECT Nombre, idTipoCamara, Config_usuario, Config_Password,
	Config_IP, Config_Puerto, Config_Web
	FROM `seguridad_camaras_listado_canales`
	WHERE idCamara = {$_GET['idCamara']}";
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
	array_push( $arrCamaras,$row );
	}
}
?>



<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Camaras de Seguridad</h5>
		</header>
		<div class="table-responsive">   
			<?php
			//recorro las camaras
			foreach ($arrCamaras as $camara) {
				//si existe subconfiguracion
				if(isset($rowCamara['idSubconfiguracion'])&&$rowCamara['idSubconfiguracion']==1){
					//Verifico el tipo de camara
					switch ($camara['idTipoCamara']) {
						//Dahua
						case 1:
							echo '<img name="main" id="main" border="0" width="640" height="480" src="http://'.$camara['Config_usuario'].':'.$camara['Config_Password'].'@'.$camara['Config_IP'].'/cgi-bin/mjpg/video.cgi?channel=1&subtype=1">';
							break;
						//otra
						case 2:
							echo '<img name="main" id="main" border="0" width="640" height="480" >';
							break;
					}
				//si no existe subconfihuracion
				}elseif(isset($rowCamara['idSubconfiguracion'])&&$rowCamara['idSubconfiguracion']==2){
					//Verifico el tipo de camara
					switch ($rowCamara['idTipoCamara']) {
						//Dahua
						case 1:
							echo '<img name="main" id="main" border="0" width="640" height="480" src="http://'.$rowCamara['Config_usuario'].':'.$rowCamara['Config_Password'].'@'.$rowCamara['Config_IP'].'/cgi-bin/mjpg/video.cgi?channel=1&subtype=1">';
							break;
						//otra
						case 2:
							echo '<img name="main" id="main" border="0" width="640" height="480" >';
							break;
					}
				}	
			}
				
			
			?>
			
			
		</div>
	</div>
</div>



<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
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
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'camara_asc':    $order_by = 'ORDER BY seguridad_camaras_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Camara Ascendente';break;
		case 'camara_desc':   $order_by = 'ORDER BY seguridad_camaras_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Camara Descendente';break;
		
		default: $order_by = 'ORDER BY seguridad_camaras_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Camara Ascendente';
	}
}else{
	$order_by = 'ORDER BY seguridad_camaras_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Camara Ascendente';
}
/**********************************************************/
//Variable con la ubicacion
$z    = "WHERE seguridad_camaras_listado.idCamara!=0";
$join = "";
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z.=" AND seguridad_camaras_listado.idSistema>=0";	
}else{
	$z.=" AND seguridad_camaras_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
	$z.=" AND usuarios_camaras.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
	$join = "INNER JOIN `usuarios_camaras` ON usuarios_camaras.idCamara = seguridad_camaras_listado.idCamara";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT seguridad_camaras_listado.idCamara FROM `seguridad_camaras_listado` ".$join." ".$z." GROUP BY seguridad_camaras_listado.idCamara";
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
$arrTipo = array();
$query = "SELECT 
seguridad_camaras_listado.idCamara,
seguridad_camaras_listado.Nombre,
core_sistemas.Nombre AS RazonSocial
FROM `seguridad_camaras_listado`
LEFT JOIN `core_sistemas`             ON core_sistemas.idSistema                 = seguridad_camaras_listado.idSistema
".$join."
".$z."
GROUP BY seguridad_camaras_listado.idCamara
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
array_push( $arrTipo,$row );
}?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>	
	</ul>
	
</div>                    
<div class="clearfix"></div> 

                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Camaras</h5>
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
							<div class="pull-left">Camara</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=camara_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=camara_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php echo $tipo['Nombre']; ?></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $tipo['RazonSocial']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $location.'&idCamara='.$tipo['idCamara']; ?>" title="Ver Camara" class="btn btn-primary btn-sm tooltip"><i class="fa fa-video-camera"></i></a><?php } ?>
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
