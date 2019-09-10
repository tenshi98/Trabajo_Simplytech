<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
// Se traen todos los datos de mi usuario
$query = "SELECT 
equipos_arriendo_listado.Nombre,
equipos_arriendo_listado.Descripcion,
equipos_arriendo_listado.Marca,
equipos_arriendo_listado.Codigo,
equipos_arriendo_listado.Direccion_img,
equipos_arriendo_listado.FichaTecnica,
equipos_arriendo_listado.HDS,
core_estados.Nombre AS Estado

FROM `equipos_arriendo_listado`
LEFT JOIN `core_estados`    ON core_estados.idEstado   = equipos_arriendo_listado.idEstado

WHERE equipos_arriendo_listado.idEquipo =  {$_GET['view']}";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$rowdata = mysqli_fetch_assoc ($resultado);



?>
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo <?php echo $rowdata['Nombre']; ?></h5>	
		</header>
        <div id="div-3" class="tab-content">
			
	
				<div class="wmd-panel">

					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/productos.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Producto</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Marca : </strong><?php echo $rowdata['Marca']; ?><br/>
							<strong>Codigo : </strong><?php echo $rowdata['Codigo']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Descripcion</h2>
						<p class="text-muted"><?php echo $rowdata['Descripcion']; ?></p>
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos</h2>
						<p class="text-muted">
							<?php 
							//Ficha Tecnica
							if(isset($rowdata['FichaTecnica'])&&$rowdata['FichaTecnica']!=''){
								echo '<a href="1download.php?dir=upload&file='.$rowdata['FichaTecnica'].'" class="btn btn-xs btn-primary" style="margin-right: 5px;"><i class="fa fa-download"></i> Descargar Ficha Tecnica</a>';
							}
							//Hoja de seguridad
							if(isset($rowdata['HDS'])&&$rowdata['HDS']!=''){
								echo '<a href="1download.php?dir=upload&file='.$rowdata['HDS'].'" class="btn btn-xs btn-primary" style="margin-right: 5px;"><i class="fa fa-download"></i> Descargar Hoja de Seguridad</a>';
							}
							?>
						
						</p>
						
						
					</div>	
					<div class="clearfix"></div>
			
				</div>
		
			

			
			
        </div>	
	</div>
</div>

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
