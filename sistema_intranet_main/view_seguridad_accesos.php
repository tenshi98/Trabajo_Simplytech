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
$query = "SELECT 
seguridad_accesos.idAcceso,
seguridad_accesos.Fecha,
seguridad_accesos.Hora,
seguridad_accesos.HoraSalida,
seguridad_accesos.Nombre,
seguridad_accesos.Rut,
seguridad_accesos.NDocCedula,
core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
ubicacion_listado.Nombre AS Ubicacion,
ubicacion_listado_level_1.Nombre AS UbicacionLVL_1,
ubicacion_listado_level_2.Nombre AS UbicacionLVL_2,
ubicacion_listado_level_3.Nombre AS UbicacionLVL_3,
ubicacion_listado_level_4.Nombre AS UbicacionLVL_4,
ubicacion_listado_level_5.Nombre AS UbicacionLVL_5,
seguridad_accesos.PersonaReunion,
seguridad_accesos.Direccion_img,
core_estado_caja.Nombre AS Estado

FROM `seguridad_accesos`
LEFT JOIN `usuarios_listado`            ON usuarios_listado.idUsuario            = seguridad_accesos.idUsuario
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema               = seguridad_accesos.idSistema
LEFT JOIN `ubicacion_listado`           ON ubicacion_listado.idUbicacion         = seguridad_accesos.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`   ON ubicacion_listado_level_1.idLevel_1   = seguridad_accesos.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`   ON ubicacion_listado_level_2.idLevel_2   = seguridad_accesos.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`   ON ubicacion_listado_level_3.idLevel_3   = seguridad_accesos.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`   ON ubicacion_listado_level_4.idLevel_4   = seguridad_accesos.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`   ON ubicacion_listado_level_5.idLevel_5   = seguridad_accesos.idUbicacion_lvl_5
LEFT JOIN `core_estado_caja`            ON core_estado_caja.idEstado             = seguridad_accesos.idEstado

WHERE seguridad_accesos.idAcceso =  ".$X_Puntero;
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

<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> Control AAcceso Visitas.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($rowdata['Fecha'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php
		$Ubicacion = $rowdata['Ubicacion']; 
		if(isset($rowdata['UbicacionLVL_1'])&&$rowdata['UbicacionLVL_1']!=''){$Ubicacion .= ' - '.$rowdata['UbicacionLVL_1'];}
		if(isset($rowdata['UbicacionLVL_2'])&&$rowdata['UbicacionLVL_2']!=''){$Ubicacion .= ' - '.$rowdata['UbicacionLVL_2'];}
		if(isset($rowdata['UbicacionLVL_3'])&&$rowdata['UbicacionLVL_3']!=''){$Ubicacion .= ' - '.$rowdata['UbicacionLVL_3'];}
		if(isset($rowdata['UbicacionLVL_4'])&&$rowdata['UbicacionLVL_4']!=''){$Ubicacion .= ' - '.$rowdata['UbicacionLVL_4'];}
		if(isset($rowdata['UbicacionLVL_5'])&&$rowdata['UbicacionLVL_5']!=''){$Ubicacion .= ' - '.$rowdata['UbicacionLVL_5'];}
								
								
		echo '
		<div class="col-sm-12 invoice-col">
			Datos del acceso
			<address>
				<strong>Usuario: </strong>'.$rowdata['Usuario'].'<br/>
				<strong>Fecha - Hora: </strong>'.fecha_estandar($rowdata['Fecha']).', desde '.$rowdata['Hora'].' hasta las '.$rowdata['HoraSalida'].' hrs<br/>
				<strong>Nombre Visita: </strong>'.$rowdata['Nombre'].'<br/>
				<strong>Rut Visita: </strong>'.$rowdata['Rut'].'<br/>
				<strong>Numero Doc Visita: </strong>'.$rowdata['NDocCedula'].'<br/>
				<strong>Destino: </strong>'.$Ubicacion.'<br/>
				<strong>Persona Reunion: </strong>'.$rowdata['PersonaReunion'].'<br/>
				<strong>Estado: </strong>'.$rowdata['Estado'].'<br/>
						
			</address>
		</div>';
		?>
	</div>
	
	
	<?php if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){ ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="col-sm-10 fcenter">
					<h3>Archivo Adjunto</h3>
					<?php echo preview_docs('upload', $rowdata['Direccion_img'], '', '', ''); ?>
				</div>
			</div>
		</div>
	<?php } ?>
	

      
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
