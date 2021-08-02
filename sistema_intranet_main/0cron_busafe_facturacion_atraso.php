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


//Se elimina la restriccion del sql 5.7
mysqli_query($dbConn, "SET SESSION sql_mode = ''");

//Consulto las facturaciones pendientes de pago
$arrFactPendientes = array();
$query = "SELECT 
COUNT(vehiculos_facturacion_apoderados_listado_detalle.idFacturacionDetalle) AS NAtrasos,
apoderados_listado.email,
apoderados_listado.Nombre,
apoderados_listado.ApellidoPat,
apoderados_listado.ApellidoMat,
sistema_planes_transporte.Nombre AS NombrePlan,
sistema_planes_transporte.Valor_Mensual AS MontoPactado,
core_sistemas.Nombre AS EmpresaNombre, 
core_sistemas.email_principal AS EmpresaEmail, 
core_sistemas.Config_Gmail_Usuario AS Gmail_Usuario, 
core_sistemas.Config_Gmail_Password AS Gmail_Password

FROM `vehiculos_facturacion_apoderados_listado_detalle`
LEFT JOIN `apoderados_listado`         ON apoderados_listado.idApoderado    = vehiculos_facturacion_apoderados_listado_detalle.idApoderado
LEFT JOIN `sistema_planes_transporte`  ON sistema_planes_transporte.idPlan  = apoderados_listado.idPlan
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema           = apoderados_listado.idSistema
WHERE vehiculos_facturacion_apoderados_listado_detalle.idEstadoPago = 1
GROUP BY vehiculos_facturacion_apoderados_listado_detalle.idApoderado ";
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
array_push( $arrFactPendientes,$row );
}

//Recorro los datos	
foreach ($arrFactPendientes as $pend) {
		
	//Defino el cuerpo por el numero de atrasos
	switch ($pend['NAtrasos']) {
		case 1:
			//Cuerpo del correo
			$BodyMail  = '<p>';
			$BodyMail .= 'Estimado '.$pend['Nombre'].' '.$pend['ApellidoPat'].' '.$pend['ApellidoMat'].'<br/>';
			$BodyMail .= '<br/>';
			$BodyMail .= 'Junto con saludar, nos dirigimos a usted para entregar la siguiente información. Al día de hoy, presenta un pago pendiente de la mensualidad correspondiente al mes de '.fecha2NMes($SIS_Fecha).'/'.fecha2Ano($SIS_Fecha).'.<br/>';
			$BodyMail .= '<br/>';
			$BodyMail .= 'Detalle:<br/>';
			$BodyMail .= '<strong>Plan:</strong>'.$pend['NombrePlan'].'<br/>';
			$BodyMail .= '<strong>Monto:</strong>'.valores($pend['MontoPactado'], 0).'<br/>';
			$BodyMail .= '<br/>';
			$BodyMail .= 'Favor realizar el pago a traves de la pagina principal.<br/>';
			$BodyMail .= 'En caso de ya haber actualizado su pago, haga caso omiso a este correo, o bien contáctese con nosotros al correo contacto@busafe.cl <br/>';
			$BodyMail .= '<br/>';
			$BodyMail .= 'Sin otro particular, muchas gracias.<br/>';
			$BodyMail .= 'Se despide<br/>';
			$BodyMail .= 'Equipo Busafe<br/>';
			$BodyMail .= '</p>';
			
			//envio el correo	
			if(isset($pend['EmpresaEmail'])&&$pend['EmpresaEmail']!=''&&isset($pend['email'])&&$pend['email']!=''&&isset($BodyMail)&&$BodyMail!=''){
				$rmail = tareas_envio_correo($pend['EmpresaEmail'], $pend['EmpresaNombre'], 
											$pend['email'], 'Receptor', 
											'', '', 
											'Pago pendiente servicio Busafe – Monitoreo transporte escolar', 
											$BodyMail,'', 
											'', 
											1, 
											$pend['Gmail_Usuario'], 
											$pend['Gmail_Password']);
				//se guarda el log
				log_response(1, $rmail, $pend['email'].'(Asunto:Pago pendiente servicio Busafe – Monitoreo transporte escolar)');	
			}
			break;
		
	}
	
		
}
	
	
		
	
?>
