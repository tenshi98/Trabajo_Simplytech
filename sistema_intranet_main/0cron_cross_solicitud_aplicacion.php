<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
/**********************************************************************************************************************************/
/*                                   Se filtran las entradas para evitar ataques                                                  */
/**********************************************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_seguridad/AntiXSS.php';
require_once '../A2XRXS_gears/xrxs_seguridad/Bootup.php';
require_once '../A2XRXS_gears/xrxs_seguridad/UTF8.php';
//Inicializo funcion
$security = new AntiXSS();
//Se limpian datos recibidos
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
//Configuracion de la plataforma
require_once 'A1XRXS_sys/xrxs_configuracion/config.php';
require_once 'core/rename.php';

//Carga de las funciones del nucleo
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Utils.Load.php';                  //Carga de variables
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Common.php';            //Funciones comunes
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Convertions.php';       //Conversiones de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Date.php';         //Funciones relacionadas a las fechas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Numbers.php';      //Funciones relacionadas a los numeros
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Operations.php';   //Funciones relacionadas a operaciones matematicas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Text.php';         //Funciones relacionadas a los textos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Time.php';         //Funciones relacionadas a las horas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Validations.php';  //Funciones de validacion de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.DataBase.php';          //Funciones relacionadas a la base de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Location.php';          //Funciones relacionadas a la geolozalizacion
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Client.php';     //Funciones para entregar informacion del cliente
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Server.php';     //Funciones para entregar informacion del servidor
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Server.Web.php';        //Funciones para entregar informacion de la web

//carga librerias propias de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';

// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  




//Permiso concedido
$transaccion      = ''; //Transaccion que los usuarios deben tener permiso
$CorreoInterno    = '';//Correo de la empresa
$RazonSocial      = '';//Nombre de la empresa
$Gmail_Usuario    = '';//Nombre de la empresa
$Gmail_Password   = '';//Nombre de la empresa
//Validar que exista
if(isset($transaccion)&&$transaccion!=''&&isset($CorreoInterno)&&$CorreoInterno!=''&&isset($RazonSocial)&&$RazonSocial!=''){
	/*******************************************************/
	//Verificar quienes tienen acceso a las transacciones
	$arrPermisos = array();
	$query = "SELECT 
	usuarios_listado.usuario AS UsuarioNick,
	usuarios_listado.email AS UsuarioNombre,
	usuarios_listado.Nombre AS UsuarioEmail

	FROM `core_permisos_listado`
	INNER JOIN `usuarios_permisos`  ON usuarios_permisos.idAdmpm    = core_permisos_listado.idAdmpm
	LEFT JOIN `usuarios_listado`    ON usuarios_listado.idUsuario   = usuarios_permisos.idUsuario
	WHERE core_permisos_listado.Direccionbase='".$transaccion."'
	";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		php_error_log('Cron', $Transaccion, 'cron', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrPermisos,$row );
	}
	/*******************************************************/
	//Listado de solicitudes ejecutadas
	$arrSolicitudes = array();
	$query = "SELECT idSolicitud
	FROM `cross_solicitud_aplicacion_listado`
	WHERE idEstado='3' ";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		php_error_log('Cron', $Transaccion, 'cron', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
	}
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSolicitudes,$row );
	}
	
	/*******************************************************/
	//Creacion cuerpo del mensaje
	$xbody = '
	<h3>Notificacion de cierre de solicitudes</h3>
	<p>Las siguientes solicitudes han sido cerradas</p>';
	foreach ($arrSolicitudes as $sol) {
		$xbody .= '<a href="'.DB_SITE_MAIN.'/informe_cross_checking_05.php?idSolicitud='.$sol['idSolicitud'].'&submit_filter=Filtrar">Solicitud '.n_doc($sol['idSolicitud'], 5).'</a>';
	}
	
	/*******************************************************/
	//Notificaciones a los correos
	foreach ($arrPermisos as $correo) {
		/*******************/
		//Envio de correo
		$rmail = tareas_envio_correo($CorreoInterno, $RazonSocial, 
									$correo['UsuarioEmail'], $correo['UsuarioNombre'], 
									'', '', 
									'Notificacion Solicitudes', 
									$xbody,'', 
									'',
									1, 
									$Gmail_Usuario, 
									$Gmail_Password);
		//se guarda el log
		log_response(1, $rmail, $correo['UsuarioEmail'].'(Asunto:Notificacion Solicitudes)');														
									 
		//Envio del mensaje
		if ($rmail!=1) {
			//echo "Mailer Error: " . $rmail;
		} else {
			//echo "Message sent!";
		}
	}	
}


	
	
	
	
	
?>
