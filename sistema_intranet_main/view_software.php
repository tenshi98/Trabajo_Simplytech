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



WHERE soporte_software_listado.idSoftware = {$_GET['view']}";
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
<div class="col-md-12" style="margin-top:50px;">
	<div class="row">
		<div class="col-md-12">

								
			<div class="block task task-high">
				<div class="row with-padding">
					<div class="col-sm-9">
						<div class="task-description">
							<a href="#"><?php echo $rowdata['Nombre']; ?></a>
							<i><?php echo $rowdata['Categoria']; ?></i>
							<span><?php echo $rowdata['Descripcion']; ?></span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="task-info">
							<span><?php echo $rowdata['Licencia']; ?></span>
							<span><span class="label label-danger"><?php echo Cantidades_decimales_justos($rowdata['Peso']).' '.$rowdata['MedidaPeso']; ?></span></span>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-left">
						<span></span>
					</div>
					<div class="pull-right clearfix" style="width: 70px;">
						<ul class="footer-icons-group">
							<?php if(isset($rowdata['SitioWeb'])&&$rowdata['SitioWeb']!=''){ ?><li><a href="<?php echo $rowdata['SitioWeb']; ?>" title="Ir al Sitio" class="tooltip" style="position: relative;"><i class="fa fa-firefox" aria-hidden="true"></i></a></li><?php } ?>
							<li><a href="<?php echo $rowdata['SitioDescarga']; ?>" title="Descargar" class="tooltip" style="position: relative;"><i class="fa fa-cloud-download" aria-hidden="true"></i></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
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
