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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
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
// consulto los datos
$SIS_query = '
alumnos_listado.email, 
alumnos_listado.Nombre, 
alumnos_listado.ApellidoPat, 
alumnos_listado.ApellidoMat, 
alumnos_listado.Rut, 
alumnos_listado.fNacimiento, 
alumnos_listado.Direccion, 
alumnos_listado.Fono1, 
alumnos_listado.Fono2, 
alumnos_listado.Fax,
alumnos_listado.PersonaContacto,
alumnos_listado.PersonaContacto_Fono,
alumnos_listado.PersonaContacto_email,
alumnos_listado.Web,
alumnos_listado.Direccion_img,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
cursos_listado.Nombre AS Curso';
$SIS_join  = '
LEFT JOIN `core_estados`           ON core_estados.idEstado            = alumnos_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`  ON core_ubicacion_ciudad.idCiudad   = alumnos_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas` ON core_ubicacion_comunas.idComuna  = alumnos_listado.idComuna
LEFT JOIN `core_sistemas`          ON core_sistemas.idSistema          = alumnos_listado.idSistema
LEFT JOIN `cursos_listado`         ON cursos_listado.idCurso           = alumnos_listado.idCurso';
$SIS_where = 'alumnos_listado.idAlumno ='.$X_Puntero;
$rowdata = db_select_data (false, $SIS_query, 'alumnos_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');

/**********************************************************/
// consulto los datos
$SIS_query = '
usuarios_listado.Nombre AS nombre_usuario,
alumnos_observaciones.Fecha,
alumnos_observaciones.Observacion';
$SIS_join  = 'LEFT JOIN `usuarios_listado` ON usuarios_listado.idUsuario = alumnos_observaciones.idUsuario';
$SIS_where = 'alumnos_observaciones.idAlumno ='.$X_Puntero;
$SIS_order = 'alumnos_observaciones.idObservacion ASC  LIMIT 15';
$arrObservaciones = array();
$arrObservaciones = db_select_array (false, $SIS_query, 'alumnos_observaciones', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrObservaciones');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Cliente</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<?php if($arrObservaciones!=false && !empty($arrObservaciones) && $arrObservaciones!=''){ ?>
					<li class=""><a href="#observaciones" data-toggle="tab"><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
				<?php } ?>
			</ul>
		</header>
        <div class="tab-content">

			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="<?php echo DB_SITE_REPO ?>/LIB_assets/img/usr.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="Imagen Referencia" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php } ?>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
						<p class="text-muted">
							<strong>Curso : </strong><?php echo $rowdata['Curso']; ?><br/>
							<strong>Nombre: </strong><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?><br/>
							<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
							<strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
							<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
							<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
							<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
							<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
						</p>
										
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
						<p class="text-muted">
							<strong>Telefono Fijo : </strong><?php echo formatPhone($rowdata['Fono1']); ?><br/>
							<strong>Telefono Movil : </strong><?php echo formatPhone($rowdata['Fono2']); ?><br/>
							<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
							<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
							<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="https://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
						</p>

						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Persona de Contacto</h2>
						<p class="text-muted">
							<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
							<strong>Telefono : </strong><?php echo formatPhone($rowdata['PersonaContacto_Fono']); ?><br/>
							<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
						</p>

					</div>
					<div class="clearfix"></div>

				</div>
			</div>

			<?php if($arrObservaciones!=false && !empty($arrObservaciones) && $arrObservaciones!=''){ ?>
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
								<?php foreach ($arrObservaciones as $observaciones){ ?>
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
			<?php } ?>
			
        </div>
	</div>
</div>

<?php
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
