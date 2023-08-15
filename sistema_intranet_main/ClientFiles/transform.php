<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../A1XRXS_sys/xrxs_configuracion/config.php';  //Configuracion de la plataforma
require_once '../../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.ardu.php';  //carga librerias de la plataforma
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
set_time_limit(2400);         
//Memora RAM Maxima del servidor, 4GB por defecto
ini_set('memory_limit', '4096M'); 
/**********************************************************************************************************************************/
/*                                                      Codigo                                                                    */
/**********************************************************************************************************************************/
//variables
$pos1 = 13; //posicion de inicio de la fecha desde
$pos2 = 28; //posicion de inicio de la fecha hasta

//si se envia la ubicacion
if(isset($_GET['Ubication'])&&$_GET['Ubication']!=''&&isset($_GET['File'])&&$_GET['File']!=''){
	//se genera ubicacion fisica dentro del servidor
	$Ubication  = '/home/crosstech/public_html/power_engine/sistema_intranet_crosstech/ClientFiles/'.$_GET['Ubication'].'/';
	$File       = $_GET['File'];

	//desde
	$data1  = substr($File, $pos1, 14);
	$fecha1 = substr($data1, 0, 8);
	$hora1  = substr($data1, 8, 4);
	//hasta
	$data2  = substr($File, $pos2, 14);
	$fecha2 = substr($data2, 0, 8);
	$hora2  = substr($data2, 8, 4);
					
	//ubicaciones de los archivos
	$FileOriginal = $Ubication.$File;
					
	//Nombre de salida del archivo
	$FileFinal    = $Ubication.$fecha1.'_'.$hora1.'-'.$fecha2.'_'.$hora2.'.mp4';
					
	//se transforma y se crea archivo
	$cmd = 'ffmpeg -y -i '.$FileOriginal.' -vcodec libx264 -crf 24 '.$FileFinal;

	//error_log($cmd, 0);
	
	
	shell_exec($cmd);

	/*
	 * sudo yum install epel-release
	 * sudo yum localinstall --nogpgcheck https://download1.rpmfusion.org/free/el/rpmfusion-free-release-7.noarch.rpm
	 * sudo yum install ffmpeg ffmpeg-devel
	 * ffmpeg -version
	 * */				
	//se elimina archivo
	/*try {
		if(!is_writable($FileOriginal)){

		//throw new Exception('File not writable');
		}else{
			unlink($FileOriginal);
		}
	}catch(Exception $e) {
		//guardar el dato en un archivo log
	}*/
	
	

?>
<!DOCTYPE html>
<html lang="es-ES">
	<head>
		<!-- Info-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport"              content="width=device-width, initial-scale=1, user-scalable=no">
		<meta http-equiv="Content-Type"    content="text/html; charset=UTF-8">

		<!-- Información del sitio-->
		<title>Descarga</title>
		<meta name="description"           content="">
		<meta name="author"                content="">
		<meta name="keywords"              content="">

		<!-- WEB FONT -->
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- CSS Base -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/bootstrap3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/theme_color_1.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/my_style.css?<?php echo time(); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/css/my_colors.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/my_corrections.css?<?php echo time(); ?>">

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/js/main.min.js"></script>

		<!-- Favicons-->
		<?php
		//Favicon Personalizado
		$nombre_fichero = '../img/mifavicon.png';
		if (file_exists($nombre_fichero)){ ?>
			<link rel="icon"             type="image/png"                    href="../img/mifavicon.png" >
			<link rel="shortcut icon"    type="image/x-icon"                 href="../img/mifavicon.png" >
			<link rel="apple-touch-icon" type="image/x-icon"                 href="../img/mifavicon-57x57.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"   href="../img/mifavicon-72x72.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="../img/mifavicon-114x114.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="../img/mifavicon-144x144.png">
		<?php
		//Favicon predefinido
		}else{ ?>
			<link rel="icon"             type="image/png"                    href="<?php echo DB_SITE_REPO ?>/LIB_assets/img/favicons/favicon.png" >
			<link rel="shortcut icon"    type="image/x-icon"                 href="<?php echo DB_SITE_REPO ?>/LIB_assets/img/favicons/favicon.png" >
			<link rel="apple-touch-icon" type="image/x-icon"                 href="<?php echo DB_SITE_REPO ?>/LIB_assets/img/favicons/apple-touch-icon-57x57-precomposed.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"   href="<?php echo DB_SITE_REPO ?>/LIB_assets/img/favicons/apple-touch-icon-72x72-precomposed.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo DB_SITE_REPO ?>/LIB_assets/img/favicons/apple-touch-icon-114x114-precomposed.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo DB_SITE_REPO ?>/LIB_assets/img/favicons/apple-touch-icon-144x144-precomposed.png">
		<?php } ?>
		
		
	</head>

	<body class="transform">

		<style>
			.transform {background-image: none !important;background-color: #1A1A1A !important;}
			.buttonDownload {display: inline-block;position: relative;padding: 10px 25px;background-color: #8b00ff;color: white;font-family: sans-serif;text-decoration: none;font-size: 0.9em;text-align: center;text-indent: 15px;}
			.buttonDownload:hover {background-color: #691CA9;color: white;}
			.buttonDownload:before, .buttonDownload:after {content: ' ';display: block;position: absolute;left: 15px;top: 52%;}
			.buttonDownload:before {width: 10px;height: 2px;border-style: solid;border-width: 0 2px 2px;}
			.buttonDownload:after {width: 0;height: 0;margin-left: 3px;margin-top: -7px;border-style: solid;border-width: 4px 4px 0 4px;border-color: transparent;border-top-color: inherit;animation: downloadArrow 2s linear infinite;animation-play-state: paused;}
			.buttonDownload:hover:before {border-color: #4CC713;}
			.buttonDownload:hover:after {border-top-color: #4CC713;animation-play-state: running;}

			/* keyframes for the download icon anim */
			@keyframes downloadArrow {
				/* 0% and 0.001% keyframes used as a hackish way of having the button frozen on a nice looking frame by default */
				0% {
					margin-top: -7px;
					opacity: 1;
				}
				
				0.001% {
					margin-top: -15px;
					opacity: 0;
				}
				
				50% {
					opacity: 1;
				}
				
				100% {
					margin-top: 0;
					opacity: 0;
				}
			}

		</style>
		<br/>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php
			$Alert_Text = 'Descargue el archivo en Formato MP4.';
			alert_post_data(1,1,1,0, $Alert_Text);
			?>
		</div>

		<div class="text-center" style="padding:50px;">
			<?php
			//enlace
			$Directorio = 'ClientFiles/'.$_GET['Ubication'];	
			$Archivo    = $fecha1.'_'.$hora1.'-'.$fecha2.'_'.$hora2.'.mp4';
			?>
			<a href="<?php echo DB_SITE_MAIN.'/1download.php?dir='.simpleEncode($Directorio, fecha_actual()).'&file='.simpleEncode($Archivo, fecha_actual()); ?>" title="Descargar Archivo MP4" class="buttonDownload">Descargar Archivo MP4</a>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php
			$Alert_Text = 'En algunos casos el archivo transformado no reproduce sonido, puede descargar el archivo original y reproducirlo con VLC Player.';
			alert_post_data(4,1,1,0, $Alert_Text);
			?>
		</div>

		<div class="text-center" style="padding:50px;">
			<?php
			//enlace
			$Directorio = 'ClientFiles/'.$_GET['Ubication'];	
			$Archivo    = $File;
			?>
			<a href="<?php echo DB_SITE_MAIN.'/1download.php?dir='.simpleEncode($Directorio, fecha_actual()).'&file='.simpleEncode($Archivo, fecha_actual()); ?>" title="Descargar Archivo Original" class="buttonDownload">Descargar Archivo Original</a>
		</div>

		<!--Otros archivos javascript -->
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/bootstrap3/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/main.min.js"></script>

	</body>
</html>

<?php } ?>
	
