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
orden_trabajo_eventos_listado.Fecha,
orden_trabajo_eventos_listado.Hora,
orden_trabajo_eventos_listado.Observacion,
core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
trabajadores_listado.Nombre AS TrabNombre,
maquinas_listado.Nombre AS NombreMaquina,
clientes_listado.Nombre AS NombreCliente

FROM `orden_trabajo_eventos_listado`
LEFT JOIN `usuarios_listado`      ON usuarios_listado.idUsuario         = orden_trabajo_eventos_listado.idUsuario
LEFT JOIN `core_sistemas`         ON core_sistemas.idSistema            = orden_trabajo_eventos_listado.idSistema
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador  = orden_trabajo_eventos_listado.idTrabajador
LEFT JOIN `maquinas_listado`      ON maquinas_listado.idMaquina         = orden_trabajo_eventos_listado.idMaquina
LEFT JOIN `clientes_listado`      ON clientes_listado.idCliente         = orden_trabajo_eventos_listado.idCliente

WHERE orden_trabajo_eventos_listado.idEvento = {$_GET['view']}";
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

//Listado de archivos
$arrArchivos = array();
$query = "SELECT idArchivo, Nombre 
FROM `orden_trabajo_eventos_listado_archivos`
WHERE idEvento = {$_GET['view']}";
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
array_push( $arrArchivos,$row );
}
?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Detalle del evento</h5>
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/mantencion_event.jpg">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Evento</h2>
						<p class="text-muted">
							<strong>Usuario Ingreso : </strong><?php echo $rowdata['Usuario']; ?><br/>
							<strong>Trabajador : </strong><?php echo $rowdata['TrabApellidoPat'].' '.$rowdata['TrabApellidoMat'].' '.$rowdata['TrabNombre']; ?><br/>
							<strong>Maquina : </strong><?php if(isset($rowdata['NombreCliente'])&&$rowdata['NombreCliente']!=''){echo $rowdata['NombreCliente'].' - '.$rowdata['NombreMaquina'];}else{echo $rowdata['NombreMaquina'];} ?><br/>
							<strong>Fecha : </strong><?php echo $rowdata['Fecha']; ?><br/>
							<strong>Hora : </strong><?php echo $rowdata['Hora']; ?><br/>
							<strong>Sistema : </strong><?php echo $rowdata['Sistema']; ?><br/>
							
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Observacion</h2>
						<p class="text-muted"><?php echo $rowdata['Observacion']; ?></p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos Adjuntos</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php foreach ($arrArchivos as $tipo) {
									echo '
										<tr class="item-row">
											<td>'.$tipo['Nombre'].'</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$tipo['Nombre'].'&return=true" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$tipo['Nombre'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								?>
							</tbody>
						</table>
						

						
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
