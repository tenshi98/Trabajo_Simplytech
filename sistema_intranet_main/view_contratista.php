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
/*                                                Carga del documento HTML                                                        */
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
// Se traen todos los datos del proveedor
$query = "SELECT  
contratista_listado.email, 
contratista_listado.Nombre, 
contratista_listado.Rut, 
contratista_listado.fNacimiento, 
contratista_listado.Direccion, 
contratista_listado.Fono1, 
contratista_listado.Fono2, 
contratista_listado.Fax,
contratista_listado.PersonaContacto,
contratista_listado.Web,
contratista_listado.Giro,
contratista_listado.FormaPago,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
contratista_tipos.Nombre AS tipoCliente,
core_paises.Nombre AS Pais,
core_paises.Flag AS Flag
FROM `contratista_listado`
LEFT JOIN `core_estados`               ON core_estados.idEstado               = contratista_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`      ON core_ubicacion_ciudad.idCiudad      = contratista_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`     ON core_ubicacion_comunas.idComuna     = contratista_listado.idComuna
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema             = contratista_listado.idSistema
LEFT JOIN `contratista_tipos`          ON contratista_tipos.idTipo            = contratista_listado.idTipo
LEFT JOIN `core_paises`                ON core_paises.idPais                  = contratista_listado.idPais
WHERE contratista_listado.idContratista = {$_GET['view']}";
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

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
contratista_observaciones.Fecha,
contratista_observaciones.Observacion
FROM `contratista_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = contratista_observaciones.idUsuario
WHERE contratista_observaciones.idContratista = {$_GET['view']}
ORDER BY contratista_observaciones.idObservacion ASC 
LIMIT 15 ";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}




?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Contratista</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>          
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
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
											<strong>Tipo de Contratista : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
											<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
											<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
											<strong>Fecha de Ingreso : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
											<strong>Pais : </strong><img src="<?php echo DB_SITE.'/LIB_assets/img/flags/'.strtolower($rowdata['Flag']).'.png'; ?>" alt="flag" height="11" width="16"> <?php echo $rowdata['Pais']; ?><br/>
											<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
											<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
											<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
											<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
											<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
											<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
										</p>
											
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
										<p class="text-muted">
											<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
											<strong>Telefono 1 : </strong><?php echo $rowdata['Fono1']; ?><br/>
											<strong>Telefono 2 : </strong><?php echo $rowdata['Fono2']; ?><br/>
											<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
											<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
											<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="http://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
										</p>
										
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Facturacion</h2>
										<p class="text-muted"><strong>Forma de Pago : </strong><?php echo $rowdata['FormaPago']; ?></p>
										
									</td>
									<td>
										<?php 
										$direccion = "";
										if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
										if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
										if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
										echo mapa2($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle']) ?>
									</td>
								</tr>                  
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="observaciones">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Autor</th>
									<th width="120">Fecha</th>
									<th>Observacion</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrObservaciones as $observaciones) { ?>
								<tr class="odd">		
									<td><?php echo $observaciones['nombre_usuario']; ?></td>
									<td><?php echo $observaciones['Fecha']; ?></td>		
									<td class="word_break"><?php echo $observaciones['Observacion']; ?></td>	
								</tr>
							<?php } ?>                    
							</tbody>
						</table>
					</div>
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