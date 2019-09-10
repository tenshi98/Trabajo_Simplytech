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
trabajadores_listado.ApellidoPat AS TrabApellidoPat,
trabajadores_listado.ApellidoMat AS TrabApellidoMat,
trabajadores_listado.Nombre AS TrabNombre,
usuarios_listado.Nombre AS UserNombre,
trabajadores_licencias.Fecha_ingreso,
trabajadores_licencias.Fecha_inicio,
trabajadores_licencias.Fecha_termino,
trabajadores_licencias.N_Dias,
trabajadores_licencias.File_Licencia,
trabajadores_licencias.Observacion,
core_sistemas.Nombre AS Sistema,
trabajadores_licencias.idUso

FROM `trabajadores_licencias`
LEFT JOIN `trabajadores_listado` ON trabajadores_listado.idTrabajador  = trabajadores_licencias.idTrabajador
LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario         = trabajadores_licencias.idUsuario
LEFT JOIN `core_sistemas`        ON core_sistemas.idSistema            = trabajadores_licencias.idSistema
WHERE trabajadores_licencias.idLicencia = {$_GET['view']}";
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
			<h5>Datos de la Licencia</h5>
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">
					
						<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/licencia.jpg">
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Trabajador : </strong><?php echo $rowdata['TrabNombre'].' '.$rowdata['TrabApellidoPat'].' '.$rowdata['TrabApellidoMat']; ?><br/>
							<strong>Usuario : </strong><?php echo $rowdata['UserNombre']; ?><br/>
							<strong>Fecha de Creacion : </strong><?php echo Fecha_completa($rowdata['Fecha_ingreso']); ?><br/>
							<strong>Fecha de Inicio : </strong><?php echo Fecha_completa($rowdata['Fecha_inicio']); ?><br/>
							<strong>Fecha de Termino : </strong><?php echo Fecha_completa($rowdata['Fecha_termino']); ?><br/>
							<strong>N° Dias duracion : </strong><?php echo $rowdata['N_Dias'].' dias'; ?><br/>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['Sistema']; ?>
						</p>
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Observaciones</h2>
						<p class="text-muted"><?php echo $rowdata['Observacion']; ?></p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos Relacionados</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php if(isset($rowdata['File_Licencia'])&&$rowdata['File_Licencia']!=''){ ?>
									<tr class="odd">
										<td>Copia de la Licencia</td>
										<td width="10">
											<div class="btn-group" style="width: 70px;" >
												<a href="<?php echo 'view_doc_preview.php?path=upload&file='.$rowdata['File_Licencia'].'&return=true'; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
											</div>
										</td>
									</tr>
								<?php }else{ ?>
									<tr class="odd">
										<td colspan="2">
											<div class="btn-group" style="width: 70px;" >
												Sin documentos relacionados
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						
				
					</div>	
					<div class="clearfix"></div>
					
					
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
