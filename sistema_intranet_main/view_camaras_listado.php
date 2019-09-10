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
seguridad_camaras_listado.idCamara,
seguridad_camaras_listado.Nombre,
seguridad_camaras_listado.idSubconfiguracion,
seguridad_camaras_listado.Direccion,
seguridad_camaras_listado.N_Camaras,
seguridad_camaras_listado.Config_usuario,
seguridad_camaras_listado.Config_Password,
seguridad_camaras_listado.Config_IP,
seguridad_camaras_listado.Config_Puerto,

core_sistemas.Nombre AS sistema,
core_estados.Nombre AS estado,
core_paises.Nombre AS Pais,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
core_sistemas_opciones.Nombre AS Subconfiguracion,
core_tipos_camara.Nombre AS TipoCamara

FROM `seguridad_camaras_listado`
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema             = seguridad_camaras_listado.idSistema
LEFT JOIN `core_estados`               ON core_estados.idEstado               = seguridad_camaras_listado.idEstado
LEFT JOIN `core_paises`                ON core_paises.idPais                  = seguridad_camaras_listado.idPais
LEFT JOIN `core_ubicacion_ciudad`      ON core_ubicacion_ciudad.idCiudad      = seguridad_camaras_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`     ON core_ubicacion_comunas.idComuna     = seguridad_camaras_listado.idComuna
LEFT JOIN `core_sistemas_opciones`     ON core_sistemas_opciones.idOpciones   = seguridad_camaras_listado.idSubconfiguracion
LEFT JOIN `core_tipos_camara`          ON core_tipos_camara.idTipoCamara      = seguridad_camaras_listado.idTipoCamara

WHERE seguridad_camaras_listado.idCamara = {$_GET['view']}";
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Camaras de seguridad</h5>
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th width="50%" class="word_break">Datos</th>
									<th width="50%">Mapa</th>
								</tr>
							</thead>
											  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd">
									<td class="word_break">
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
										<p class="text-muted">
											<strong>Nombre del Grupo : </strong><?php echo $rowdata['Nombre']; ?><br/>
											<strong>Numero de Camaras: </strong><?php echo $rowdata['N_Camaras']; ?><br/>
											<strong>Pais : </strong><?php echo $rowdata['Pais']; ?><br/>
											<strong>Region : </strong><?php echo $rowdata['Ciudad']; ?><br/>
											<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
											<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
											<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
											<strong>Estado : </strong><?php echo $rowdata['estado']; ?><br/>
											<strong>Subconfiguracion : </strong><?php echo $rowdata['Subconfiguracion']; ?>
										</p>
										
										<?php if(isset($rowdata['idSubconfiguracion'])&&$rowdata['idSubconfiguracion']==2){ ?>
											<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Subconfiguracion</h2>
											<p class="text-muted">
												<strong>Tipo de Camara : </strong><?php echo $rowdata['TipoCamara']; ?><br/>
												<strong>Usuario : </strong><?php echo $rowdata['Config_usuario']; ?><br/>
												<strong>Password: </strong><?php echo $rowdata['Config_Password']; ?><br/>
												<strong>IP : </strong><?php echo $rowdata['Config_IP']; ?><br/>
												<strong>Puerto : </strong><?php echo $rowdata['Config_Puerto']; ?><br/>
											</p>
										<?php } ?>
										
									</td>
									<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
									if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
									echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']) ?>
									</td>
								</tr>                  
							</tbody>
						</table>
			
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