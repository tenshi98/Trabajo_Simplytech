<?php
/**********************************/
/*       Bloque de seguridad      */
/**********************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/********************************/
/* Configuracion de la conexion */
/********************************/
function conectar () {
	$db_con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$db_con->set_charset("utf8");
	return $db_con;
}
?>
