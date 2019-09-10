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
prospectos_listado.Nombre AS nombre_prospecto,
usuarios_listado.Nombre AS nombre_usuario,
prospectos_etapa_fidelizacion.Fecha,
prospectos_etapa_fidelizacion.Observacion,
prospectos_etapa.Nombre AS Etapa

FROM `prospectos_etapa_fidelizacion`
LEFT JOIN `prospectos_listado`   ON prospectos_listado.idProspecto     = prospectos_etapa_fidelizacion.idProspecto
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario         = prospectos_etapa_fidelizacion.idUsuario
LEFT JOIN `prospectos_etapa`     ON prospectos_etapa.idEtapa           = prospectos_etapa_fidelizacion.idEtapa
WHERE prospectos_etapa_fidelizacion.idEtapaFide = {$_GET['view']}";
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
			<h5>Ver Datos de la Etapa</h5>		
		</header>
        <div class="body">
            <h2 class="text-primary">Datos Basicos</h2>
            <p class="text-muted">
				<strong>Prospecto : </strong><?php echo $rowdata['nombre_prospecto']; ?><br/>
				<strong>Etapa : </strong><?php echo $rowdata['Etapa']; ?><br/>
				<strong>Usuario : </strong><?php echo $rowdata['nombre_usuario']; ?><br/>
				<strong>Fecha : </strong><?php echo Fecha_completa_alt($rowdata['Fecha']); ?>
            </p>
                      
            <h2 class="text-primary">Observacion</h2>
            <p class="text-muted word_break " ><?php echo $rowdata['Observacion']; ?></p>
            
        	
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
