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
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
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
WHERE trabajadores_licencias.idLicencia = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
$rowdata = mysqli_fetch_assoc ($resultado);	




?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos de la Licencia</h5>
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">
					
						<div class="col-sm-4">
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/licencia.jpg">
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
						<p class="text-muted word_break">
							<div class="text-muted well well-sm no-shadow">
								<?php if(isset($rowdata['Observacion'])&&$rowdata['Observacion']!=''){echo $rowdata['Observacion'];}else{echo 'Sin Observaciones';} ?>
								<div class="clearfix"></div>
							</div>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos Relacionados</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php if(isset($rowdata['File_Licencia'])&&$rowdata['File_Licencia']!=''){ ?>
									<tr class="odd">
										<td>Copia de la Licencia</td>
										<td width="10">
											<div class="btn-group" style="width: 70px;" >
												<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($rowdata['File_Licencia'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Documento" class="btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
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


<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
