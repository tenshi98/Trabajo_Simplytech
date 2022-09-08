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
// consulto los datos
$SIS_query = '
core_sistemas.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
core_sistemas.Direccion AS SistemaOrigenDireccion,
core_sistemas.Contacto_Fono1 AS SistemaOrigenFono,
core_sistemas.email_principal AS SistemaOrigenEmail,
core_sistemas.Rut AS SistemaOrigenRut,
core_sistemas.Contacto_Nombre AS SistemaContacto,
usuarios_listado.Nombre AS NombreEncargado,
telemetria_historial_mantencion.Fecha, 
telemetria_historial_mantencion.h_Inicio, 
telemetria_historial_mantencion.h_Termino, 
telemetria_historial_mantencion.Duracion, 
telemetria_historial_mantencion.Resumen, 
telemetria_historial_mantencion.Resolucion,
telemetria_historial_mantencion.idOpciones_1,
telemetria_historial_mantencion.idOpciones_2,
telemetria_historial_mantencion.idOpciones_3,
telemetria_historial_mantencion.Recepcion_Nombre, 
telemetria_historial_mantencion.Recepcion_Rut, 
telemetria_historial_mantencion.Recepcion_Email,
telemetria_historial_mantencion.Path_Firma,
core_telemetria_servicio_tecnico.Nombre AS Servicio';
$SIS_join  = '
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = telemetria_historial_mantencion.idUsuario
LEFT JOIN `core_telemetria_servicio_tecnico`        ON core_telemetria_servicio_tecnico.idServicio  = telemetria_historial_mantencion.idServicio
LEFT JOIN `core_sistemas`                           ON core_sistemas.idSistema                      = telemetria_historial_mantencion.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = core_sistemas.idComuna';
$SIS_where = 'telemetria_historial_mantencion.idMantencion ='.$X_Puntero;
$row_data = db_select_data (false, $SIS_query, 'telemetria_historial_mantencion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'row_data');


/**********************************/				
$arrOpciones = array();
$arrOpciones = db_select_array (false, 'idOpciones, Nombre', 'core_telemetria_servicio_tecnico_opciones', '', '', 'Nombre ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrOpciones');

/**********************************/
$arrOpcionesDisplay = array();
foreach ($arrOpciones as $mant) {
	$arrOpcionesDisplay[$mant['idOpciones']]['Nombre'] = $mant['Nombre'];
}

/*************************************************************************/
//Se buscan todos los archivos relacionados
$SIS_query = '
telemetria_listado.Identificador AS Identificador,
telemetria_listado.Nombre AS Equipo';
$SIS_join  = 'LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_historial_mantencion_equipos.idTelemetria';
$SIS_where = 'telemetria_historial_mantencion_equipos.idMantencion ='.$X_Puntero;
$SIS_order = 'telemetria_listado.Nombre ASC';
$arrEquipos = array();
$arrEquipos = db_select_array (false, $SIS_query, 'telemetria_historial_mantencion_equipos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrEquipos');

/*************************************************************************/
//Se buscan todos los archivos relacionados
$SIS_query = 'Nombre';
$SIS_join  = '';
$SIS_where = 'idMantencion ='.$X_Puntero;
$SIS_order = 'Nombre ASC';
$arrArchivos = array();
$arrArchivos = db_select_array (false, $SIS_query, 'telemetria_historial_mantencion_archivos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrArchivos');

?>

<div class="col-xs-12" style="margin-top:15px;">
	<a target="new" href="view_telemetria_mantencion_to_pdf.php?view=<?php echo $_GET['view'].'&idSistema='.simpleEncode($_SESSION['usuario']['basic_data']['idSistema'], fecha_actual()) ?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
		<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF
	</a>
</div>
<div class="clearfix"></div>


<section class="invoice">


	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Visita Tecnica.
				<small class="pull-right">N°: <?php echo n_doc($X_Puntero, 7)?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php


				echo '
				<div class="col-sm-4 invoice-col">
					<strong>Empresa Visitada</strong>
					<address>
						Nombre: '.$row_data['SistemaOrigen'].'<br/>
						Ubicacion: '.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
						Direccion: '.$row_data['SistemaOrigenDireccion'].'<br/>
						Fono Fijo: '.$row_data['SistemaOrigenFono'].'<br/>
						Rut: '.$row_data['SistemaOrigenRut'].'<br/>
						Email: '.$row_data['SistemaOrigenEmail'].'<br/>
						Persona contacto:'.$row_data['SistemaContacto'].'<br/>
						Aprobador Nombre: '.$row_data['Recepcion_Nombre'].'<br/>
						Aprobador Rut: '.$row_data['Recepcion_Rut'].'<br/>
						Aprobador Email: '.$row_data['Recepcion_Email'].'<br/>
					</address>
				</div>
				
				<div class="col-sm-4 invoice-col">
					<strong>Tecnico a Cargo</strong>
					<address>
						Nombre: '.$row_data['NombreEncargado'].'<br/>
						Fecha: '.Fecha_estandar($row_data['Fecha']).'<br/>
						Hora Inicio: '.$row_data['h_Inicio'].'<br/>
						Hora Termino: '.$row_data['h_Termino'].'<br/>
						Duracion: '.$row_data['Duracion'].'<br/>
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					<strong>Trabajo</strong>
					<address>
						Servicio: '.$row_data['Servicio'].'<br/>
						Opciones: ';
						$ntot = 0;
						if(isset($row_data['idOpciones_1'])&&$row_data['idOpciones_1']==2){if($ntot!=0){echo ' - '.$arrOpcionesDisplay[1]['Nombre'];$ntot++;}else{echo $arrOpcionesDisplay[1]['Nombre'];$ntot++;}}
						if(isset($row_data['idOpciones_2'])&&$row_data['idOpciones_2']==2){if($ntot!=0){echo ' - '.$arrOpcionesDisplay[2]['Nombre'];$ntot++;}else{echo $arrOpcionesDisplay[2]['Nombre'];$ntot++;}}
						if(isset($row_data['idOpciones_3'])&&$row_data['idOpciones_3']==2){if($ntot!=0){echo ' - '.$arrOpcionesDisplay[3]['Nombre'];$ntot++;}else{echo $arrOpcionesDisplay[3]['Nombre'];$ntot++;}}
						echo '
						<br/>
					</address>
				</div>';

				?>
	</div>
	
	
	<div class="">
		<p class="lead"><a name="Ancla_obs"></a>Equipos:</p>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<?php foreach ($arrEquipos as $archivos) { ?>
					<tr class="odd">
						<td><?php echo $archivos['Identificador']; ?></td>
						<td><?php echo $archivos['Equipo']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>			
    </div>

	<div class="col-xs-12">
		<div class="row">
			<p class="lead"><a name="Ancla_obs"></a>Diagnostico tecnico y acciones realizadas:</p>
			<div class="text-muted well well-sm no-shadow" ><?php echo $row_data['Resumen'];?></div>
		</div>
	</div>
	
	<div class="col-xs-12">
		<div class="row">
			<p class="lead"><a name="Ancla_obs"></a>Resumen de Visita:</p>
			<div class="text-muted well well-sm no-shadow" ><?php echo $row_data['Resolucion'];?></div>
		</div>
	</div>
	

	<div class="">
		<p class="lead"><a name="Ancla_obs"></a>Imagenes:</p>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<?php foreach ($arrArchivos as $archivos) { ?>
					<tr class="odd">
						<td><?php echo $archivos['Nombre']; ?></td>
						<td width="10">
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?path='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($archivos['Nombre'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Documento" class="btn btn-primary btn-sm tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<a href="<?php echo '1download.php?dir='.simpleEncode('upload', fecha_actual()).'&file='.simpleEncode($archivos['Nombre'], fecha_actual()); ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>			
    </div>

	<div class="row firma">
		
		<div class="col-sm-6 fcont">
			<?php if(isset($row_data['Path_Firma'])&&$row_data['Path_Firma']!=''){ ?>
				<div class="col-sm-6 fcenter">
					<img style="" class="media-object user-img width100" alt="User Picture" src="upload/<?php echo $row_data['Path_Firma']; ?>">
				</div>	
			<?php } ?>
			<p>Firma Aprobador</p>
		</div>
		<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Trabajador</p></div> 
	</div>

      
</section>

 
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
