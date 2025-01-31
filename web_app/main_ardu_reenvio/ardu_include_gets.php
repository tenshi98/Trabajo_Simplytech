<?php
/*******************************************************************************************************************/
/*                                              Bloque de seguridad                                                */
/*******************************************************************************************************************/
/*if( ! defined(DB_NAME)){
    die('No tienes acceso a esta carpeta o archivo (Access Code 1014-001).');
}
/*******************************************************************************************************************/
/*                                                Se ejecuta codigo                                                */
/*******************************************************************************************************************/

/******************************************************************************************************/
/*                                                                                                    */
/*                               RECIBE TODOS LOS GETS ENVIADOS POR LOS EQUIPOS                       */
/*                                                                                                    */
/******************************************************************************************************/
//Variables
$Sensor          = array();
$Velocidad       = '';
$Alertas_1       = '';
$Alertas_2       = '';
$Alertas_3       = '';
$FueraLinea      = '';
$FueraGeoCerca   = '';
$Var_Counter     = 0;
////////////////// Recepcion variables //////////////////
//Datos Varios
if ( isset($_GET['lock'])){     $lock                  = str_replace('%20', '', str_replace(' ', '', $_GET['lock']));}
if (!empty($_GET['id'])){       $Identificador         = str_replace('%20', '', str_replace(' ', '', $_GET['id']));}
if (!empty($_GET['f'])){        $Fecha                 = str_replace('%20', '', str_replace(' ', '', $_GET['f']));}
if (!empty($_GET['h'])){        $Hora                  = str_replace('%20', '', str_replace(' ', '', $_GET['h']));}
if ( isset($_GET['lt'])){       $GeoLatitud            = str_replace('%20', '', str_replace(' ', '', $_GET['lt']));}
if ( isset($_GET['lg'])){       $GeoLongitud           = str_replace('%20', '', str_replace(' ', '', $_GET['lg']));}
if ( isset($_GET['v'])){        $GeoVelocidad          = str_replace('%20', '', str_replace(' ', '', $_GET['v']));}
if ( isset($_GET['d'])){        $GeoDireccion          = str_replace('%20', '', str_replace(' ', '', $_GET['d']));}
if ( isset($_GET['dl'])){       $Dataloger             = str_replace('%20', '', str_replace(' ', '', $_GET['dl']));}
if ( isset($_GET['m'])){        $GeoMovimiento         = str_replace('%20', '', str_replace(' ', '', $_GET['m']));}
if ( isset($_GET['ups'])){      $ups                   = str_replace('%20', '', str_replace(' ', '', $_GET['ups']));}
//Sensores Telemetria
for ($i_num = 1; $i_num <= 72; $i_num++) {
    if ( isset($_GET['s'.$i_num])){  $Sensor[$i_num]['valor'] = str_replace('%20', '', str_replace(' ', '', $_GET['s'.$i_num]));    $Var_Counter=$i_num;}
}


?>
