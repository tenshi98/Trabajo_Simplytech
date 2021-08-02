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

//variables
$idSistema = 1;
$FechaSistema  = fecha_actual();
$Fecha_01      = sumarDias($FechaSistema,1);
$Fecha_10      = sumarDias($FechaSistema,10);
$Fecha_30      = sumarDias($FechaSistema,30);
$SIS_query     = 'clientes_listado.Nombre AS ClienteNombre,
clientes_listado.PersonaContacto_email AS ClienteEmail,
clientes_listado.Contrato_Nombre AS ClienteContrato_Nombre,
clientes_listado.Contrato_Fecha_Term AS ClienteContrato_Fecha_Term,
Negocio_1.Nombre AS ClienteTab_1,
Negocio_2.Nombre AS ClienteTab_2,
Negocio_3.Nombre AS ClienteTab_3,
Negocio_4.Nombre AS ClienteTab_4,
Negocio_5.Nombre AS ClienteTab_5,
Negocio_6.Nombre AS ClienteTab_6,
Negocio_7.Nombre AS ClienteTab_7,
core_sistemas.Nombre AS SistemaNombre, 
core_sistemas.email_principal AS SistemaEmail, 
core_sistemas.Config_Gmail_Usuario AS SistemaGmail_Usuario, 
core_sistemas.Config_Gmail_Password AS SistemaGmail_Password';
$SIS_join     = '
LEFT JOIN core_sistemas                  ON core_sistemas.idSistema   = clientes_listado.idSistema
LEFT JOIN core_telemetria_tabs Negocio_1 ON Negocio_1.idTab           = clientes_listado.idTab_1
LEFT JOIN core_telemetria_tabs Negocio_2 ON Negocio_2.idTab           = clientes_listado.idTab_2
LEFT JOIN core_telemetria_tabs Negocio_3 ON Negocio_3.idTab           = clientes_listado.idTab_3
LEFT JOIN core_telemetria_tabs Negocio_4 ON Negocio_4.idTab           = clientes_listado.idTab_4
LEFT JOIN core_telemetria_tabs Negocio_5 ON Negocio_5.idTab           = clientes_listado.idTab_5
LEFT JOIN core_telemetria_tabs Negocio_6 ON Negocio_6.idTab           = clientes_listado.idTab_6
LEFT JOIN core_telemetria_tabs Negocio_7 ON Negocio_7.idTab           = clientes_listado.idTab_7';

/***********************************************************/
//configuracion de correos
$arrMail = array('hbarzelatto@crosstech.cl', 'clobos@crosstech.cl', 'lcastillo@crosstech.cl', 'gcampos@crosstech.cl');
//Empresas por vencer a 1 dia	
$arrCliente_01 = array();
$arrCliente_01 = db_select_array (false, $SIS_query, 'clientes_listado', $SIS_join, 'clientes_listado.Contrato_Fecha_Term ="'.$Fecha_01.'"', 'clientes_listado.Nombre ASC', $dbConn, 'Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'arrCliente_01');
//Empresas por vencer a 10 dias
$arrCliente_10 = array();
$arrCliente_10 = db_select_array (false, $SIS_query, 'clientes_listado', $SIS_join, 'clientes_listado.Contrato_Fecha_Term ="'.$Fecha_30.'"', 'clientes_listado.Nombre ASC', $dbConn, 'Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'arrCliente_30');
//Empresas por vencer a 30 dias
$arrCliente_30 = array();
$arrCliente_30 = db_select_array (false, $SIS_query, 'clientes_listado', $SIS_join, 'clientes_listado.Contrato_Fecha_Term ="'.$Fecha_30.'"', 'clientes_listado.Nombre ASC', $dbConn, 'Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'arrCliente_30');
	

//logo de la compañia
$login_logo  = DB_SITE_MAIN.'/img/login_logo.png';
$file_logo   = 'img/login_logo.png';
							
//solo si existe
if (file_exists($file_logo)) {
	//envio de correo
	try {

		/****************************************************************************************/
		foreach ($arrCliente_01 as $cliente) {
			/**************************************************/
			//Variables para el titulo del correo
			$BodyAsunto = $cliente['ClienteContrato_Nombre'].' (';
			
			/**************************************************/
			//Se crea el cuerpo	
			$BodyMail  = '<div style="background-color: #D9D9D9; padding: 10px;">';
			$BodyMail .= '<img src="'.$login_logo.'" style="width: 60%;display:block;margin-left: auto;margin-right: auto;margin-top:30px;margin-bottom:30px;">';
			$BodyMail .= '<h3 style="text-align: center;font-size: 30px;">';
			$BodyMail .= '¡Hola <strong>'.$cliente['ClienteNombre'].'</strong>!<br/>';
			$BodyMail .= '</h3>';
			$BodyMail .= '<p style="text-align: center;font-size: 20px;">';
			$BodyMail .= 'Te informamos que el contrato '.$cliente['ClienteContrato_Nombre'];
			$BodyMail .= ' por el servicio ';
			if(isset($cliente['ClienteTab_1'])&&$cliente['ClienteTab_1']!=''){$BodyMail .= $cliente['ClienteTab_1'];$BodyAsunto .= ' - '.$cliente['ClienteTab_1'];}
			if(isset($cliente['ClienteTab_2'])&&$cliente['ClienteTab_2']!=''){$BodyMail .= $cliente['ClienteTab_2'];$BodyAsunto .= ' - '.$cliente['ClienteTab_2'];}
			if(isset($cliente['ClienteTab_3'])&&$cliente['ClienteTab_3']!=''){$BodyMail .= $cliente['ClienteTab_3'];$BodyAsunto .= ' - '.$cliente['ClienteTab_3'];}
			if(isset($cliente['ClienteTab_4'])&&$cliente['ClienteTab_4']!=''){$BodyMail .= $cliente['ClienteTab_4'];$BodyAsunto .= ' - '.$cliente['ClienteTab_4'];}
			if(isset($cliente['ClienteTab_5'])&&$cliente['ClienteTab_5']!=''){$BodyMail .= $cliente['ClienteTab_5'];$BodyAsunto .= ' - '.$cliente['ClienteTab_5'];}
			if(isset($cliente['ClienteTab_6'])&&$cliente['ClienteTab_6']!=''){$BodyMail .= $cliente['ClienteTab_6'];$BodyAsunto .= ' - '.$cliente['ClienteTab_6'];}
			if(isset($cliente['ClienteTab_7'])&&$cliente['ClienteTab_7']!=''){$BodyMail .= $cliente['ClienteTab_7'];$BodyAsunto .= ' - '.$cliente['ClienteTab_7'];}
			$BodyMail .= ', vence el '.fecha_estandar($cliente['ClienteContrato_Fecha_Term']).'.';
			$BodyMail .= '</p>';
			$BodyMail .= '</div>';
			
			/**************************************************/
			//Variables para el titulo del correo
			$BodyAsunto .= ') está pronto a vencer';
			
			/**************************************************/
			//Se verifica que correo exista
			if(isset($cliente['SistemaEmail'])&&$cliente['SistemaEmail']!=''&&isset($cliente['ClienteEmail'])&&$cliente['ClienteEmail']!=''){
				
				/**************************************************/
				//se envia correo al cliente
				/*$rmail = tareas_envio_correo($cliente['SistemaEmail'], $cliente['SistemaNombre'], 
											 $cliente['ClienteEmail'], $cliente['ClienteNombre'], 
											 '', '', 
											 $BodyAsunto, 
											 $BodyMail,'', 
											 '', 
											 1, 
											 $cliente['SistemaGmail_Usuario'], 
											 $cliente['SistemaGmail_Password']);
											 
				//se guarda el log
				log_response(1, $rmail, $cliente['ClienteEmail']);	
				
				/**************************************************/
				//se envia correo a encargados
				foreach ($arrMail as $e_mail) {
					if(isset($e_mail)&&$e_mail!=''){
						$rmail = tareas_envio_correo($cliente['SistemaEmail'], $cliente['SistemaNombre'], 
													 $e_mail, 'Destinatario', 
													 '', '', 
													 $BodyAsunto, 
													 $BodyMail,'', 
													 '', 
													 1, 
													 $cliente['SistemaGmail_Usuario'], 
													 $cliente['SistemaGmail_Password']);
													 
						//se guarda el log
						log_response(1, $rmail, $cliente['ClienteEmail']);
					}
				}
			}
		}
		

		/****************************************************************************************/
		foreach ($arrCliente_10 as $cliente) {
			/**************************************************/
			//Variables para el titulo del correo
			$BodyAsunto = $cliente['ClienteContrato_Nombre'].' (';
			
			/**************************************************/
			//Se crea el cuerpo	
			$BodyMail  = '<div style="background-color: #D9D9D9; padding: 10px;">';
			$BodyMail .= '<img src="'.$login_logo.'" style="width: 60%;display:block;margin-left: auto;margin-right: auto;margin-top:30px;margin-bottom:30px;">';
			$BodyMail .= '<h3 style="text-align: center;font-size: 30px;">';
			$BodyMail .= '¡Hola <strong>'.$cliente['ClienteNombre'].'</strong>!<br/>';
			$BodyMail .= '</h3>';
			$BodyMail .= '<p style="text-align: center;font-size: 20px;">';
			$BodyMail .= 'Te informamos que el contrato '.$cliente['ClienteContrato_Nombre'];
			$BodyMail .= ' por el servicio ';
			if(isset($cliente['ClienteTab_1'])&&$cliente['ClienteTab_1']!=''){$BodyMail .= $cliente['ClienteTab_1'];$BodyAsunto .= ' - '.$cliente['ClienteTab_1'];}
			if(isset($cliente['ClienteTab_2'])&&$cliente['ClienteTab_2']!=''){$BodyMail .= $cliente['ClienteTab_2'];$BodyAsunto .= ' - '.$cliente['ClienteTab_2'];}
			if(isset($cliente['ClienteTab_3'])&&$cliente['ClienteTab_3']!=''){$BodyMail .= $cliente['ClienteTab_3'];$BodyAsunto .= ' - '.$cliente['ClienteTab_3'];}
			if(isset($cliente['ClienteTab_4'])&&$cliente['ClienteTab_4']!=''){$BodyMail .= $cliente['ClienteTab_4'];$BodyAsunto .= ' - '.$cliente['ClienteTab_4'];}
			if(isset($cliente['ClienteTab_5'])&&$cliente['ClienteTab_5']!=''){$BodyMail .= $cliente['ClienteTab_5'];$BodyAsunto .= ' - '.$cliente['ClienteTab_5'];}
			if(isset($cliente['ClienteTab_6'])&&$cliente['ClienteTab_6']!=''){$BodyMail .= $cliente['ClienteTab_6'];$BodyAsunto .= ' - '.$cliente['ClienteTab_6'];}
			if(isset($cliente['ClienteTab_7'])&&$cliente['ClienteTab_7']!=''){$BodyMail .= $cliente['ClienteTab_7'];$BodyAsunto .= ' - '.$cliente['ClienteTab_7'];}
			$BodyMail .= ', vence el '.fecha_estandar($cliente['ClienteContrato_Fecha_Term']).'.';
			$BodyMail .= '</p>';
			$BodyMail .= '</div>';
			
			/**************************************************/
			//Variables para el titulo del correo
			$BodyAsunto .= ') está pronto a vencer';
			
			/**************************************************/
			//Se verifica que correo exista
			if(isset($cliente['SistemaEmail'])&&$cliente['SistemaEmail']!=''&&isset($cliente['ClienteEmail'])&&$cliente['ClienteEmail']!=''){
				
				/**************************************************/
				//se envia correo al cliente
				/*$rmail = tareas_envio_correo($cliente['SistemaEmail'], $cliente['SistemaNombre'], 
											 $cliente['ClienteEmail'], $cliente['ClienteNombre'], 
											 '', '', 
											 $BodyAsunto, 
											 $BodyMail,'', 
											 '', 
											 1, 
											 $cliente['SistemaGmail_Usuario'], 
											 $cliente['SistemaGmail_Password']);
											 
				//se guarda el log
				log_response(1, $rmail, $cliente['ClienteEmail']);	
				
				/**************************************************/
				//se envia correo a encargados
				foreach ($arrMail as $e_mail) {
					if(isset($e_mail)&&$e_mail!=''){
						$rmail = tareas_envio_correo($cliente['SistemaEmail'], $cliente['SistemaNombre'], 
													 $e_mail, 'Destinatario', 
													 '', '', 
													 $BodyAsunto, 
													 $BodyMail,'', 
													 '', 
													 1, 
													 $cliente['SistemaGmail_Usuario'], 
													 $cliente['SistemaGmail_Password']);
													 
						//se guarda el log
						log_response(1, $rmail, $cliente['ClienteEmail']);
					}
				}
			}
		}
		
		
		
		/****************************************************************************************/
		foreach ($arrCliente_30 as $cliente) {
			/**************************************************/
			//Variables para el titulo del correo
			$BodyAsunto = $cliente['ClienteContrato_Nombre'].' (';
			
			/**************************************************/
			//Se crea el cuerpo	
			$BodyMail  = '<div style="background-color: #D9D9D9; padding: 10px;">';
			$BodyMail .= '<img src="'.$login_logo.'" style="width: 60%;display:block;margin-left: auto;margin-right: auto;margin-top:30px;margin-bottom:30px;">';
			$BodyMail .= '<h3 style="text-align: center;font-size: 30px;">';
			$BodyMail .= '¡Hola <strong>'.$cliente['ClienteNombre'].'</strong>!<br/>';
			$BodyMail .= '</h3>';
			$BodyMail .= '<p style="text-align: center;font-size: 20px;">';
			$BodyMail .= 'Te informamos que el contrato '.$cliente['ClienteContrato_Nombre'];
			$BodyMail .= ' por el servicio ';
			if(isset($cliente['ClienteTab_1'])&&$cliente['ClienteTab_1']!=''){$BodyMail .= $cliente['ClienteTab_1'];$BodyAsunto .= ' - '.$cliente['ClienteTab_1'];}
			if(isset($cliente['ClienteTab_2'])&&$cliente['ClienteTab_2']!=''){$BodyMail .= $cliente['ClienteTab_2'];$BodyAsunto .= ' - '.$cliente['ClienteTab_2'];}
			if(isset($cliente['ClienteTab_3'])&&$cliente['ClienteTab_3']!=''){$BodyMail .= $cliente['ClienteTab_3'];$BodyAsunto .= ' - '.$cliente['ClienteTab_3'];}
			if(isset($cliente['ClienteTab_4'])&&$cliente['ClienteTab_4']!=''){$BodyMail .= $cliente['ClienteTab_4'];$BodyAsunto .= ' - '.$cliente['ClienteTab_4'];}
			if(isset($cliente['ClienteTab_5'])&&$cliente['ClienteTab_5']!=''){$BodyMail .= $cliente['ClienteTab_5'];$BodyAsunto .= ' - '.$cliente['ClienteTab_5'];}
			if(isset($cliente['ClienteTab_6'])&&$cliente['ClienteTab_6']!=''){$BodyMail .= $cliente['ClienteTab_6'];$BodyAsunto .= ' - '.$cliente['ClienteTab_6'];}
			if(isset($cliente['ClienteTab_7'])&&$cliente['ClienteTab_7']!=''){$BodyMail .= $cliente['ClienteTab_7'];$BodyAsunto .= ' - '.$cliente['ClienteTab_7'];}
			$BodyMail .= ', vence el '.fecha_estandar($cliente['ClienteContrato_Fecha_Term']).'.';
			$BodyMail .= '</p>';
			$BodyMail .= '</div>';
			
			/**************************************************/
			//Variables para el titulo del correo
			$BodyAsunto .= ') está pronto a vencer';
			
			/**************************************************/
			//Se verifica que correo exista
			if(isset($cliente['SistemaEmail'])&&$cliente['SistemaEmail']!=''&&isset($cliente['ClienteEmail'])&&$cliente['ClienteEmail']!=''){
				
				/**************************************************/
				//se envia correo al cliente
				/*$rmail = tareas_envio_correo($cliente['SistemaEmail'], $cliente['SistemaNombre'], 
											 $cliente['ClienteEmail'], $cliente['ClienteNombre'], 
											 '', '', 
											 $BodyAsunto, 
											 $BodyMail,'', 
											 '', 
											 1, 
											 $cliente['SistemaGmail_Usuario'], 
											 $cliente['SistemaGmail_Password']);
											 
				//se guarda el log
				log_response(1, $rmail, $cliente['ClienteEmail']);	
				
				/**************************************************/
				//se envia correo a encargados
				foreach ($arrMail as $e_mail) {
					if(isset($e_mail)&&$e_mail!=''){
						$rmail = tareas_envio_correo($cliente['SistemaEmail'], $cliente['SistemaNombre'], 
													 $e_mail, 'Destinatario', 
													 '', '', 
													 $BodyAsunto, 
													 $BodyMail,'', 
													 '', 
													 1, 
													 $cliente['SistemaGmail_Usuario'], 
													 $cliente['SistemaGmail_Password']);
													 
						//se guarda el log
						log_response(1, $rmail, $cliente['ClienteEmail']);
					}
				}
			}
		}
				
									
	} catch (Exception $e) {
		php_error_log('Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'cron', '', 'error de registro:'.$e->getMessage(), '' );
				
	}	
}else{
	php_error_log('Cron', basename($_SERVER["REQUEST_URI"], ".php"), 'cron', '', 'logo no existe ('.$login_logo.')', '' );
}

	
	
	
	
	
?>
