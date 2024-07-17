<?php
/**********************************/
/*       Bloque de seguridad      */
/**********************************/
if( ! defined('XMBCXRXSKGC')) {
    die('No tienes acceso a esta carpeta o archivo.');
}
/**********************************/
/* Configuracion Base de la datos */
/**********************************/
//verifica la capa de desarrollo
$whitelist = array( 'localhost', '127.0.0.1', '::1' );
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de desarrollo
if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){
	define( 'DB_SERVER', 'localhost' );
	define( 'DB_NAME', 'eapec_aguas');
	define( 'DB_USER', 'root');
	define( 'DB_PASS', '');
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de produccion	
}else{
	define( 'DB_SERVER', 'localhost' );
	define( 'DB_NAME', 'eapec_aguas');
	define( 'DB_USER', 'eapec_aguas');
	define( 'DB_PASS', '*o1Szj]RDVh#');
}
?>
