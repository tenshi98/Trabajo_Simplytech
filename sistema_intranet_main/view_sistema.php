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
// Se traen todos los datos del trabajador
$query = "SELECT
core_sistemas.Nombre,  
core_sistemas.Rut, 
core_ubicacion_ciudad.Nombre AS Ciudad, 
core_ubicacion_comunas.Nombre AS Comuna, 
core_sistemas.Direccion, 
core_sistemas.Contacto_Nombre, 
core_sistemas.Contacto_Fono1, 
core_sistemas.Contacto_Fono2, 
core_sistemas.Contacto_Fax, 
core_sistemas.Contacto_Web, 
core_sistemas.Contacto_Email, 
core_sistemas.email_principal, 
core_sistemas.Contrato_Nombre, 
core_sistemas.Contrato_Numero, 
core_sistemas.Contrato_Fecha, 
core_sistemas.Contrato_Duracion,
core_sistemas.Config_IDGoogle,
core_sistemas.Config_Google_apiKey,
core_theme_colors.Nombre AS Tema,
core_sistemas.Config_CorreoRespaldo,
opc1.Nombre AS OpcionesGen_1,
opc2.Nombre AS OpcionesGen_2,
opc3.Nombre AS OpcionesGen_3,
opc3.Nombre AS OpcionesGen_4,
opc5.Nombre AS OpcionesGen_5,
opc7.Nombre AS OpcionesGen_7,
opc8.Nombre AS OpcionesGen_8,
opc9.Nombre AS OpcionesGen_9,
core_sistemas.idOpcionesGen_6,
bodegas_productos_listado.Nombre AS BodegaProd,
bodegas_insumos_listado.Nombre AS BodegaIns,
core_sistemas.Rubro,

core_sistemas_opciones_telemetria.Nombre AS OpcionTelemetria,
core_config_ram.Nombre AS ConfigRam,
core_config_time.Nombre AS ConfigTime

FROM `core_sistemas`
LEFT JOIN `core_ubicacion_ciudad`              ON core_ubicacion_ciudad.idCiudad                   = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`             ON core_ubicacion_comunas.idComuna                  = core_sistemas.idComuna
LEFT JOIN `core_theme_colors`                  ON core_theme_colors.idTheme                        = core_sistemas.Config_idTheme
LEFT JOIN `core_sistemas_opciones`   opc1      ON opc1.idOpciones                                  = core_sistemas.idOpcionesGen_1
LEFT JOIN `core_sistemas_opciones`   opc2      ON opc2.idOpciones                                  = core_sistemas.idOpcionesGen_2
LEFT JOIN `core_sistemas_opciones`   opc3      ON opc3.idOpciones                                  = core_sistemas.idOpcionesGen_3
LEFT JOIN `core_sistemas_opciones`   opc4      ON opc4.idOpciones                                  = core_sistemas.idOpcionesGen_4
LEFT JOIN `core_sistemas_opciones`   opc5      ON opc5.idOpciones                                  = core_sistemas.idOpcionesGen_5
LEFT JOIN `core_interfaces`          opc7      ON opc7.idInterfaz                                  = core_sistemas.idOpcionesGen_7
LEFT JOIN `core_sistemas_opciones`   opc8      ON opc8.idOpciones                                  = core_sistemas.idOpcionesGen_8
LEFT JOIN `core_sistemas_opciones`   opc9      ON opc9.idOpciones                                  = core_sistemas.idOpcionesGen_9
LEFT JOIN `bodegas_productos_listado`          ON bodegas_productos_listado.idBodega               = core_sistemas.OT_idBodegaProd
LEFT JOIN `bodegas_insumos_listado`            ON bodegas_insumos_listado.idBodega                 = core_sistemas.OT_idBodegaIns
LEFT JOIN `core_sistemas_opciones_telemetria`  ON core_sistemas_opciones_telemetria.idOpcionesTel  = core_sistemas.idOpcionesTel
LEFT JOIN `core_config_ram`                    ON core_config_ram.idConfigRam                      = core_sistemas.idConfigRam
LEFT JOIN `core_config_time`                   ON core_config_time.idConfigTime                    = core_sistemas.idConfigTime

WHERE core_sistemas.idSistema = {$_GET['view']}";
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Ver Datos de la empresa</h5>	
		</header>
		<div class="tab-content">
			<div class="table-responsive">
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
									<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
									<strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?><br/>
									<strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?><br/>
									<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
									<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?>
								</p>
										
										
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de contacto</h2>
								<p class="text-muted">
									<strong>Nombre Contacto : </strong><?php echo $rowdata['Contacto_Nombre']; ?><br/>
									<strong>Fono 1: </strong><?php echo $rowdata['Contacto_Fono1']; ?><br/>
									<strong>Fono 2: </strong><?php echo $rowdata['Contacto_Fono2']; ?><br/>
									<strong>Fax : </strong><?php echo $rowdata['Contacto_Fax']; ?><br/>
									<strong>Web : </strong><?php echo $rowdata['Contacto_Web']; ?><br/>
									<strong>Email : </strong><?php echo $rowdata['email_principal']; ?>
								</p>

								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Contrato</h2>
								<p class="text-muted">
									<strong>Nombre Contrato : </strong><?php echo $rowdata['Contrato_Nombre']; ?><br/>
									<strong>Numero de Contrato : </strong><?php echo $rowdata['Contrato_Numero']; ?><br/>
									<strong>Fecha inicio Contrato : </strong><?php echo $rowdata['Contrato_Fecha']; ?><br/>
									<strong>Duracion Contrato(Meses) : </strong><?php echo $rowdata['Contrato_Duracion']; ?>
								</p>
									
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Configuracion</h2>
								<p class="text-muted">
									<strong>Tema : </strong><?php echo $rowdata['Tema']; ?><br/>
									<strong>ID Google (Mapas) : </strong><?php echo $rowdata['Config_IDGoogle']; ?><br/>
									<strong>ApiKey (Android) : </strong><?php echo $rowdata['Config_Google_apiKey']; ?><br/>
									<strong>Correo de Respaldo : </strong><?php echo $rowdata['Config_CorreoRespaldo']; ?><br/>
									<strong>Correo de Sistema : </strong><?php echo $rowdata['email_principal']; ?><br/>
									<strong>Tipo Resumen Telemetria : </strong><?php echo $rowdata['OpcionTelemetria']; ?><br/>
									<strong>Memoria Ram Maxima : </strong><?php if(isset($rowdata['ConfigRam'])&&$rowdata['ConfigRam']!=0){echo $rowdata['ConfigRam'].' MB';}else{ echo '4096 MB';} ?><br/>
									<strong>Tiempo Maximo de espera : </strong><?php if(isset($rowdata['ConfigTime'])&&$rowdata['ConfigTime']!=0){echo $rowdata['ConfigTime'].' Minutos';}else{ echo '40 Minutos';} ?><br/>
								</p>
										
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Opciones</h2>
								<p class="text-muted">
									<strong>Widget Comunes : </strong><?php echo $rowdata['OpcionesGen_1']; ?><br/>
									<strong>Widget de acceso directo : </strong><?php echo $rowdata['OpcionesGen_2']; ?><br/>
									<strong>Valores promedios de las mediciones : </strong><?php echo $rowdata['OpcionesGen_3']; ?><br/>
									<strong>Refresh Pagina Principal : </strong><?php echo $rowdata['OpcionesGen_4'].'('.$rowdata['idOpcionesGen_6'].' segundos)'; ?><br/>
									<strong>PDF Complejo : </strong><?php echo $rowdata['OpcionesGen_5']; ?><br/>
									<strong>Interfaz : </strong><?php echo $rowdata['OpcionesGen_7']; ?><br/>
									<strong>Uso Correo Interno : </strong><?php echo $rowdata['OpcionesGen_8']; ?><br/>
									<strong>Mostrar Repositorio : </strong><?php echo $rowdata['OpcionesGen_9']; ?><br/>
								</p>
								
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Bodegas OT</h2>
								<p class="text-muted">
									<strong>Bodega Productos : </strong><?php echo $rowdata['BodegaProd']; ?><br/>
									<strong>Bodega Insumos : </strong><?php echo $rowdata['BodegaIns']; ?><br/>
								</p>
										
								
							<td>
								<?php 
								$direccion = "";
								if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
								if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
								if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
								echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']);
								?>
							</td>
						</tr>                  
					</tbody>
				</table>
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
