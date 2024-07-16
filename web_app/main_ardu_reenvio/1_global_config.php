<?php
/******************************************************************************************************/
/*                                                                                                    */
/*                                    CONFIGURACION DEL ARCHIVO ardu.php                              */
/*                                                                                                    */
/******************************************************************************************************/
//Tipo de control de log
//	1: contador
//	2: log de los datos recibidos
//	3: URL Recibido
$Control_Type = 1;
//Listado de errores
$ErrorListing = array();
//verifico si ignoro los valores 999
//	1: ignorar
//	2: guardar los valores 999
$dis_999 = 2;
//verifico si ignoro los valores 0
//	1: ignorar
//	2: guardar los valores 0
$dis_0 = 1;
//verifico si realizo reenvio de datos
//	1: no enviar
//	2: reenviar
$Reenvio_datos = 1;
$Reenvio_web   = 'http://webapp.exilon360.net/gruasyequipos/ardu.php';
/******************************************************************************************************/
/*                                                                                                    */
/*                             CONFIGURACION GENERAL DE LOS CRONES                                    */
/*                                                                                                    */
/******************************************************************************************************/
$CorreoAdministrador = '';//Correo del administrador del sistema

/**************************************************************/
//  CONFIGURACION DEL ARCHIVO cron_informe_hora.php
$Global_inf_hora_timeBack            = '01:00:00'; //Tiempo de revision de las bases de datos
$Global_inf_hora_TextFile_Admin      = "logs_cron_informe_hora_admin.txt";
$Global_inf_hora_TextFile_User       = "logs_cron_informe_hora_user.txt";

/**************************************************************/
//  CONFIGURACION DEL ARCHIVO cron_informe_diario.php
$Global_inf_dia_dias                 = 1; //Dias hacia atras a revisar
$Global_inf_dia_TextFile_Admin       = "logs_cron_informe_diario_admin.txt";
$Global_inf_dia_TextFile_User        = "logs_cron_informe_diario_user.txt";

/**************************************************************/
//  CONFIGURACION DEL ARCHIVO cron_informe_semanal.php
$Global_inf_semanal_dias             = 7; //Dias hacia atras a revisar
$Global_inf_semanal_TextFile_Admin   = "logs_cron_informe_semanal_admin.txt";
$Global_inf_semanal_TextFile_User    = "logs_cron_informe_semanal_user.txt";


?>
