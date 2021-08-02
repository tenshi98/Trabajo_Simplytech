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
	
//variables
$SIS_idSistema   = 1;
$SIS_Fecha       = fecha_actual();

	
//traigo solo los apoderados con plan y cobro mensual
$arrApoderado = array();
$query = "SELECT 
apoderados_listado.email,
apoderados_listado.Nombre,
apoderados_listado.ApellidoPat,
apoderados_listado.ApellidoMat,
core_sistemas.Nombre AS EmpresaNombre, 
core_sistemas.email_principal AS EmpresaEmail, 
core_sistemas.Config_Gmail_Usuario AS Gmail_Usuario, 
core_sistemas.Config_Gmail_Password AS Gmail_Password
			
FROM `apoderados_listado`
LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema  = apoderados_listado.idSistema
WHERE apoderados_listado.idSistema = '".$SIS_idSistema."' 
AND apoderados_listado.idEstado = 1
AND apoderados_listado.idPlan != 0 
AND apoderados_listado.idCobro = 1";
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
array_push( $arrApoderado,$row );
}

				
/*********************************************************************/		
//Se recorren los apoderados
foreach ($arrApoderado as $apo) {

	/***********************************************/
	//Envio de correo
	$BodyMail  = '<p>';
	$BodyMail .= 'Estimado '.$apo['Nombre'].' '.$apo['ApellidoPat'].' '.$apo['ApellidoMat'].'<br/>';
	$BodyMail .= '<br/>';
	$BodyMail .= 'Junto con saludar, le recordamos que el día 05 vencerá el mes de servicio Busafe, “monitoreo de transporte escolar”. Favor realizar el pago desde la pagina principal una vez facturado.<br/>';
	$BodyMail .= 'Le recordamos que todos los 05 de cada mes, le llegará su facturación a este correo.<br/>';
	$BodyMail .= '<br/>';
	$BodyMail .= 'Muchas gracias por su atención.<br/>';
	$BodyMail .= 'Que tenga un excelente día.<br/>';
	$BodyMail .= 'Equipo Busafe.<br/>';
	$BodyMail .= '</p>';
	
	//Se verifica que existan datos
	if(isset($apo['EmpresaEmail'])&&$apo['EmpresaEmail']!=''&&isset($apo['email'])&&$apo['email']!=''&&isset($BodyMail)&&$BodyMail!=''){
		$rmail = tareas_envio_correo($apo['EmpresaEmail'], $apo['EmpresaNombre'], 
									$apo['email'], 'Receptor', 
									'', '', 
									'Recordatorio pago servicio Busafe '.fecha2NMes($SIS_Fecha).'/'.fecha2Ano($SIS_Fecha).'', 
									$BodyMail,'', 
									'', 
									1, 
									$apo['Gmail_Usuario'], 
									$apo['Gmail_Password']);
		//se guarda el log
		log_response(1, $rmail, $apo['email'].'(Asunto:Recordatorio pago servicio Busafe '.fecha2NMes($SIS_Fecha).'/'.fecha2Ano($SIS_Fecha).')');	
	}
					
}
	
	
	
?>
