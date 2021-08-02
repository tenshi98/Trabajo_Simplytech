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
	
	/*******************************************/
	//Servidor
	define( 'DB_SERVER', 'localhost' );
	define( 'DB_NAME', 'power_engine_main');
	define( 'DB_USER', 'root');
	define( 'DB_PASS', '');
	
	/*******************************************/
	//Repositorio
	define( 'DB_SITE_REPO', 'http://localhost/power_engine' );                                 //repositorio
	//Sitio
	define( 'DB_SITE_MAIN', 'http://localhost/power_engine/sistema_intranet_main' );           //URL del sistema
	define( 'DB_SITE_MAIN_PATH', '/sistema_intranet_main');                                    //Path de la carpeta contenedora
	//sitios externos
	define( 'DB_SITE_ALT_1', 'http://localhost/power_engine/sistema_web_clientes' );           //URL 1 para uso interno
	define( 'DB_SITE_ALT_1_PATH', '/sistema_web_clientes');                                    //Path de la carpeta contenedora
	define( 'DB_SITE_ALT_2', '' );                                                             //URL 2 para uso interno
	define( 'DB_SITE_ALT_2_PATH', '');                                                         //Path de la carpeta contenedora
	define( 'DB_SITE_ALT_3', '' );                                                             //URL 3 para uso interno
	define( 'DB_SITE_ALT_3_PATH', '');                                                         //Path de la carpeta contenedora
	
	/*******************************************/
	//Software
	define( 'DB_SOFT_NAME', 'Intranet');
	define( 'DB_SOFT_SLOGAN', 'Software de gestion');
	
	/*******************************************/
	//Empresa
	define( 'DB_EMPRESA_NAME', 'ASD');
	define( 'DB_EMPRESA_MAIL', 'zzxc@zxc.cl');
	
	/*******************************************/
	//Debug
	define( 'DB_ERROR_MAIL', 'zxc@zxc.cl');
	define( 'DB_COMPARE', 'power_engine_main');
	
	/*******************************************/
	//Notificaciones
	define( 'DB_GMAIL_USER', '');
	define( 'DB_GMAIL_PASSWORD', '');
	
////////////////////////////////////////////////////////////////////////////////
//si estoy en ambiente de produccion	
}else{
	
	/*******************************************/
	//Servidor
	define( 'DB_SERVER', 'localhost' );
	define( 'DB_NAME', 'intranet');
	define( 'DB_USER', 'admin');
	define( 'DB_PASS', 'zxcasdqwe');
	
	/*******************************************/
	//Repositorio
	define( 'DB_SITE_REPO', 'https://repositorio.example.cl' );         //repositorio
	//Sitio
	define( 'DB_SITE_MAIN', 'https://intranet.example.cl' );            //URL del sistema
	define( 'DB_SITE_MAIN_PATH', '/sistema_intranet');                  //Path de la carpeta contenedora
	//sitios externos
	define( 'DB_SITE_ALT_1', 'https://plataforma.example.cl' );         //URL 1 para uso interno
	define( 'DB_SITE_ALT_1_PATH', '/sistema_web_clientes');             //Path de la carpeta contenedora
	define( 'DB_SITE_ALT_2', '' );                                      //URL 2 para uso interno
	define( 'DB_SITE_ALT_2_PATH', '');                                  //Path de la carpeta contenedora
	define( 'DB_SITE_ALT_3', '' );                                      //URL 3 para uso interno
	define( 'DB_SITE_ALT_3_PATH', '');                                  //Path de la carpeta contenedora
	
	/*******************************************/
	//Software
	define( 'DB_SOFT_NAME', 'Intranet');
	define( 'DB_SOFT_SLOGAN', 'Software de gestion');
	
	/*******************************************/
	//Empresa
	define( 'DB_EMPRESA_NAME', 'ASD');
	define( 'DB_EMPRESA_MAIL', 'zzxc@zxc.cl');
	
	/*******************************************/
	//Debug
	define( 'DB_ERROR_MAIL', 'zxc@zxc.cl');
	define( 'DB_COMPARE', 'power_engine_main');
	
	/*******************************************/
	//Notificaciones
	define( 'DB_GMAIL_USER', '');
	define( 'DB_GMAIL_PASSWORD', '');
	
}							
?>
