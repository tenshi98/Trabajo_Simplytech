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
//si estoy en ambiente de desarrollo
if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){
	
	define( 'DB_SERVER', 'localhost' );
	define( 'DB_SITE', 'http://localhost/power_engine' );
	define( 'DB_NAME', 'power_engine_main');
	//define( 'DB_NAME', 'simyl_pe_casacentral');
	//define( 'DB_NAME', 'exilon36_gruasyequipos');
	//define( 'DB_NAME', 'exilon36_pe_mamut');
	//define( 'DB_NAME', 'exilon36_pe_agropraxis');
	define( 'DB_USER', 'root');
	define( 'DB_PASS', '');
	define( 'DB_SOFT_NAME', 'Plataforma de Pruebas');
	define( 'DB_SOFT_SLOGAN', 'Software de gestion');
	define( 'DB_EMPRESA_NAME', 'TEST');
	define( 'DB_EMPRESA_PATH', '/sistema_intranet_main');
	define( 'DB_ERROR_MAIL', 'vreyes@exilon360.cl');
	define( 'DB_COMPARE', 'simyl_power_engine_main');
	
//si estoy en ambiente de produccion	
}else{
	
	define( 'DB_SERVER', 'localhost' );
	define( 'DB_SITE', 'http://repositorio.exilon360.com' );
	define( 'DB_NAME', 'hbarzela_main');
	define( 'DB_USER', 'hbarzela_madlan');
	define( 'DB_PASS', 'Inicio1*');
	define( 'DB_SOFT_NAME', 'Plataforma de Pruebas');
	define( 'DB_SOFT_SLOGAN', 'Software de gestion');
	define( 'DB_EMPRESA_NAME', 'Exilon360');
	define( 'DB_EMPRESA_PATH', '/sistema_intranet_main');
	define( 'DB_ERROR_MAIL', 'vreyes@exilon360.cl');
	define( 'DB_COMPARE', 'hbarzela_power_engine_main');
	
}							
?>
