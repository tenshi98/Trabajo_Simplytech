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
postulantes_listado.Direccion_img, 
core_estados.Nombre AS Estado,
core_sistemas.Nombre AS Sistema,
postulantes_listado.Nombre,
postulantes_listado.ApellidoPat,
postulantes_listado.ApellidoMat, 
core_sexo.Nombre AS Sexo,
postulantes_listado.FNacimiento,
core_estado_civil.Nombre AS EstadoCivil,
postulantes_listado.Fono1,
postulantes_listado.Fono2,
postulantes_listado.Rut,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
postulantes_listado.Direccion,
postulantes_listado.Observaciones,
postulantes_listado.SueldoLiquido,
core_tipos_licencia_conducir.Nombre AS LicenciaTipo,
postulantes_listado.File_Curriculum

FROM `postulantes_listado`
LEFT JOIN `core_estados`                     ON core_estados.idEstado                         = postulantes_listado.idEstado
LEFT JOIN `core_sistemas`                    ON core_sistemas.idSistema                       = postulantes_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`            ON core_ubicacion_ciudad.idCiudad                = postulantes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`           ON core_ubicacion_comunas.idComuna               = postulantes_listado.idComuna
LEFT JOIN `core_tipos_licencia_conducir`     ON core_tipos_licencia_conducir.idTipoLicencia   = postulantes_listado.idTipoLicencia
LEFT JOIN `core_sexo`                        ON core_sexo.idSexo                              = postulantes_listado.idSexo
LEFT JOIN `core_estado_civil`                ON core_estado_civil.idEstadoCivil               = postulantes_listado.idEstadoCivil

WHERE postulantes_listado.idPostulante = {$_GET['view']}";
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Ver Datos del Postulante</h5>		
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/usr.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?><br/>
							<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
							<strong>Sexo : </strong><?php echo $rowdata['Sexo']; ?><br/>
							<strong>Fecha de Nacimiento : </strong><?php echo Fecha_estandar($rowdata['FNacimiento']); ?><br/>
							<strong>Fono1 : </strong><?php echo $rowdata['Fono1']; ?><br/>
							<strong>Fono2 : </strong><?php echo $rowdata['Fono2']; ?><br/>
							<strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['nombre_comuna'].', '.$rowdata['nombre_region']; ?><br/>
							<strong>Estado Civil: </strong><?php echo $rowdata['EstadoCivil']; ?><br/>
							<strong>Tipo de Licencia : </strong><?php echo $rowdata['LicenciaTipo']; ?><br/>
							<strong>Pretenciones : </strong><?php echo valores($rowdata['SueldoLiquido'], 0); ?><br/>
							
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?><br/>
							<strong>Sistema : </strong><?php echo $rowdata['Sistema']; ?>
						</p>
					
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Estudios</h2>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Cursos</h2>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Experiencia Laboral</h2>
						
						

						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Otros Datos</h2>
						<p class="text-muted">
							
							<strong>Observaciones : </strong><?php echo $rowdata['Observaciones']; ?>
						</p>
							

						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos</h2>
						<p class="text-muted">
							<?php 
							//Curriculum
							if(isset($rowdata['File_Curriculum'])&&$rowdata['File_Curriculum']!=''){
								echo '<a href="1download.php?dir=upload&file='.$rowdata['File_Curriculum'].'" class="btn btn-xs btn-primary" style="margin-right: 5px;"><i class="fa fa-download"></i> Descargar Curriculum</a>';
							}
							?>
						</p>	
							
							
										
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
