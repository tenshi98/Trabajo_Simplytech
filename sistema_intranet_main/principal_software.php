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
$original = "principal_software.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
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
//Filtro
if(isset($_GET['filterCat'])&&$_GET['filterCat']!=''){
	$z = 'WHERE soporte_software_listado.idCategoria='.$_GET['filterCat'];
}else{
	$z = '';
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT Nombre FROM `soporte_software_listado` ".$z;
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
// Se trae un listado con todos los elementos
$arrSoftware = array();
$query = "SELECT 
soporte_software_listado.Nombre, 
soporte_software_listado.Descripcion,
soporte_software_listado.Peso,
soporte_software_listado.SitioWeb,
soporte_software_listado.SitioDescarga,

soporte_software_listado_licencias.Nombre AS Licencia,
soporte_software_listado_categorias.Nombre AS Categoria,
soporte_software_listado_medidas.Nombre AS MedidaPeso

FROM `soporte_software_listado`
LEFT JOIN `soporte_software_listado_licencias`   ON soporte_software_listado_licencias.idLicencia     = soporte_software_listado.idLicencia
LEFT JOIN `soporte_software_listado_categorias`  ON soporte_software_listado_categorias.idCategoria   = soporte_software_listado.idCategoria
LEFT JOIN `soporte_software_listado_medidas`     ON soporte_software_listado_medidas.idMedidaPeso     = soporte_software_listado.idMedidaPeso
".$z."
ORDER BY soporte_software_listado.Nombre ASC
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
array_push( $arrSoftware,$row );
}

//obtengo los usuarios que enviaron la notificacion
$arrCategorias = array();
$query = "SELECT
soporte_software_listado_categorias.idCategoria,
soporte_software_listado_categorias.Nombre,
count(soporte_software_listado.idCategoria)AS cuenta

FROM `soporte_software_listado_categorias`
LEFT JOIN `soporte_software_listado`  ON soporte_software_listado.idCategoria   = soporte_software_listado_categorias.idCategoria

GROUP BY soporte_software_listado_categorias.Nombre
ORDER BY soporte_software_listado_categorias.Nombre ASC";
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
array_push( $arrCategorias,$row );
}

?>
<div class="row">
	
	<div class="col-sm-8">
		<?php foreach ($arrSoftware as $soft) { ?>					
			<div class="block task task-high boxsoftware">
				<div class="row with-padding">
					<div class="col-sm-9">
						<div class="task-description">
							<a href="#"><?php echo $soft['Nombre']; ?></a>
							<i><?php echo $soft['Categoria']; ?></i>
							<span><?php echo $soft['Descripcion']; ?></span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="task-info">
							<span><span class="label label-success"><?php echo $soft['Licencia']; ?></span></span>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-left">
						<span></span>
					</div>
					<div class="pull-right clearfix" style="width: 70px;">
						<ul class="footer-icons-group">
							<?php if(isset($soft['SitioWeb'])&&$soft['SitioWeb']!=''){ ?><li><a href="<?php echo $soft['SitioWeb']; ?>" title="Ir al Sitio" class="tooltip" style="position: relative;"><i class="fa fa-firefox" aria-hidden="true"></i></a></li><?php } ?>
							<li><a href="<?php echo $soft['SitioDescarga']; ?>" title="Descargar" class="tooltip" style="position: relative;"><i class="fa fa-cloud-download" aria-hidden="true"></i></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php } ?>     											
	</div>
	
	
	<div class="col-sm-4 mail-left-box">
  		<div class="list-group inbox-options">
			<?php $todos = 0; foreach ($arrCategorias as $cat) { $todos = $todos + $cat['cuenta']; } ?>
					
			<div class="list-group-item">Filtro</div>	
			<a href="<?php echo $original.'?pagina=1'; ?>" class="list-group-item">
				<i class="fa fa-inbox" aria-hidden="true"></i> 
				Mostrar Todos
				<span class="badge  bg-primary"><?php echo $todos; ?></span> 
			</a>
					
			<?php foreach ($arrCategorias as $cat) { ?>
				<a href="<?php echo $original.'?pagina=1&filterCat='.$cat['idCategoria']; ?>" class="list-group-item">
					<i class="fa fa-inbox" aria-hidden="true"></i> 
					<?php echo $cat['Nombre']; ?>
					<span class="badge  bg-primary"><?php echo $cat['cuenta']; ?></span> 
				</a>	
			<?php } ?>
					
					
  		</div>
	</div>
				
</div>

<?php echo paginador_1($total_paginas, $original, '', $num_pag); ?>


<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px; margin-top:30px">
<a href="principal.php" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

          
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
