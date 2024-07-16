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
require_once 'A1XRXS_sys/xrxs_configuracion/config.php';                               //Configuracion de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';      //carga librerias de la plataforma

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

//variables
$SIS_idSistema   = 38;                               //plataforma a utilizar
$WhatsappChat_id = '120363040088931805@g.us';        //chat id del grupo
$hora            = hora_actual();                   //hora actual del servidor
$diaSem          = fecha2NDiaSemana(fecha_actual()); //obtengo el numero del dia de la semana
$diaEnvio        = array(1,2,3,4,5,6);               //Se definen los dias en que se envian las noti (1=lunes)

/****************************************************************/
//includes con las ejecuciones
include '0cron_envio_notificacion_include.php'; 
						
	
?>
