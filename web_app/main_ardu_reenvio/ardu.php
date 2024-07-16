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
/*                                            Configuracion del sistema                                                           */
/**********************************************************************************************************************************/
	
	include '1_global_config.php';

/**********************************************************************************************************************************/
/*                                                Ejecucion del sistema                                                           */
/**********************************************************************************************************************************/
//Ponderaciones Manuales de los sensores
include 'ardu_include_gets.php';
//Se guarda en un archivo la salida predefinida de los datos recibidos
include 'ardu_include_txt.php';
//Ponderaciones Manuales de los sensores
include 'ardu_include_ponderaciones.php';
//Modificacion del archivo solo en caso de que se necesite reenviar los datos a otro servidor
include 'ardu_include_reenvio.php';

echo 'enviado';

?>
