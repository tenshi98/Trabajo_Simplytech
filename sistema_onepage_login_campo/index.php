<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_seguridad/AntiXSS.php';
require_once '../A2XRXS_gears/xrxs_seguridad/Bootup.php';
require_once '../A2XRXS_gears/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'A1XRXS_sys/xrxs_configuracion/config.php';                                  //Configuracion de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';         //carga librerias de la plataforma
require_once '../Legacy/gestion_modular/funciones/Components.UI.FormInputs.Extended.php'; //carga formularios de la plataforma
require_once '../Legacy/gestion_modular/funciones/Components.UI.Inputs.Extended.php';     //carga inputs de la plataforma
require_once '../Legacy/gestion_modular/funciones/Components.UI.Widgets.Extended.php';    //carga widgets de la plataforma

// obtengo puntero de conexion con la db
$dbConn = conectar();
//Se elimina la restriccion del sql 5.7
mysqli_query($dbConn, "SET SESSION sql_mode = ''");
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
set_time_limit(2400);
//Memora RAM Maxima del servidor, 4GB por defecto
ini_set('memory_limit', '4096M');
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "index.php";
/**********************************************************************************************************************************/
/*                                               Se cargan los formularios                                                        */
/**********************************************************************************************************************************/
//formulario para iniciar sesion
if (!empty($_POST['submitIngreso'])){
	//Llamamos al formulario
	$form_trabajo= 'Ingreso';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_listado.php';
}
//formulario para recuperar la contraseña
if (!empty($_POST['submitEgreso'])){
	//Llamamos al formulario
	$form_trabajo= 'Egreso';
	require_once 'A1XRXS_sys/xrxs_form/trabajadores_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                     Armado del form                                                            */
/**********************************************************************************************************************************/
//Elimino los datos previos del form
unset($_SESSION['form_require']);
//se carga dato previo
$_SESSION['form_require'] = 'required';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}

/*****************************************************/
//log de accesos
$Fecha_actual  = fecha_actual();
$Hora_actual   = hora_actual();
$IP_Client     = obtenerIpCliente();
$Archivo       = '1_logs_accesos.txt';

//Verifico si existe IP
if(isset($IP_Client)&&$IP_Client!=''){

	//consulto quien es
	$SIS_query = 'trabajadores_listado.Nombre,trabajadores_listado.ApellidoPat,trabajadores_listado.ApellidoMat';
	$SIS_join  = 'LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador = trabajadores_asistencias_predios.idTrabajador';
	$SIS_where = 'trabajadores_asistencias_predios.IP_Client="'.$IP_Client.'" ORDER BY trabajadores_asistencias_predios.Fecha DESC';
	$rowUser = db_select_data (false, $SIS_query, 'trabajadores_asistencias_predios', $SIS_join, $SIS_where, $dbConn, 'login', basename($_SERVER["REQUEST_URI"], ".php"), 'existIP');

	//genero nombre
	if(isset($rowUser['ApellidoPat'])&&$rowUser['ApellidoPat']!=''){
		$Trabajador_nombre = $rowUser['ApellidoPat']." ".$rowUser['ApellidoMat']." ".$rowUser['Nombre'];
	}else{
		$Trabajador_nombre = 'S/N';
	}
	//Genero data
	$Data = $Fecha_actual." ".$Hora_actual." - ".$IP_Client." - ".$Trabajador_nombre." \n";

	//solo si existe
	if (file_exists($Archivo)){
		//se trata de guardar el archivo
		try {
			//Se guarda el registro de los correos enviados
			if ($FP = fopen ($Archivo, "a")){
				fwrite ($FP, $Data);
				fclose ($FP);
			}
		} catch (Exception $e) {
			error_log("Ha ocurrido un error (".$e->getMessage().")", 0);
		}
	}else{
		error_log("No existe el archivo (".$Archivo.")", 0);
	}
}



			
				
							
				
/*****************************************************/		
?>

<script>

	if (navigator.geolocation){
		
		navigator.geolocation.getCurrentPosition(function(objPosition){
			var lat = objPosition.coords.latitude;
			var lon = objPosition.coords.longitude;
			
			document.getElementById("Latitud").value  = lat;
			document.getElementById("Longitud").value = lon;
									
			document.getElementById("Latitud_fake").value  = lat;
			document.getElementById("Longitud_fake").value = lon;
			
			document.getElementById("alertas_x").style.display = "none";
			
			
		}, function(objPositionError){
			switch (objPositionError.code){
				case objPositionError.PERMISSION_DENIED:
					alert("Favor encienda su GPS y espere un poco para reconocer su posicion, luego intentelo nuevamente.");
				break;
				case objPositionError.POSITION_UNAVAILABLE:
					alert("No se ha podido acceder a la información del GPS.");
				break;
				case objPositionError.TIMEOUT:
					alert("El GPS ha tardado demasiado tiempo en responder.");
				break;
				default:
					alert("Error desconocido.");
			}
		}, {
			maximumAge: 75000,
			timeout: 15000
		});
	}else{
		alert("Su navegador no soporta la ubicacion por GPS.");
	}
</script>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Registro de asistencia</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($Rut)){   $x1  = $Rut; }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x1, 2);

				$Form_Inputs->form_input_disabled('Fecha Actual','Fecha', fecha_actual());
				$Form_Inputs->form_input_disabled('Hora Actual','Hora', hora_actual());

				echo '<div id="alertas_x">';
					alert_post_data(4,1,1,0, 'El GPS esta apagado, haga el favor de encenderlo antes de registrarse.');
				echo '</div>';

				$Form_Inputs->form_input_disabled('Latitud', 'Latitud_fake', 0);
				$Form_Inputs->form_input_disabled('Longitud', 'Longitud_fake', 0);

				$Form_Inputs->form_input_hidden('Latitud', 0, 2);
				$Form_Inputs->form_input_hidden('Longitud', 0, 2);

				//Registro de la hora actual
				$Hora = hora_actual();
				?>

				<?php if($Hora<'12:00:00'){ ?>
					<input type="submit" id="text1" class="btn btn-lg btn-primary btn-block fa-input" value="&#xf090; Entrada" name="submitIngreso">
				<?php }else{ ?>
					<input type="submit" id="text2" class="btn btn-lg btn-danger btn-block fa-input"  value="&#xf08b; Salida"  name="submitEgreso">
			    <?php } ?>
					 
			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div> 



<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';

?>
