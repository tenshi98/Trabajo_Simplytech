<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Maqueta</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		
		
      
		<style>
			body {background-color: #FFF !important;}
			html, body, iframe, img {
			  width: 100%;
			  height: 100%;
			  padding: 0;
			  margin: 0;
			}
			iframe{
				float:right;
			}
		</style>
	</head>
	

	<body>
<?php 
//Se toman los datos del archivo
$folder_path   = $_GET['path'].'/'; 
$file_name     = $_GET['file'];
//se crea direccion
$path = $folder_path.$file_name;
$ext = pathinfo($path, PATHINFO_EXTENSION);
//otros
$num_files     = glob($path.".{JPG,jpg,jpeg,gif,png,bmp,doc,docx,xls,xlsx,ppt,pptx,odt,odp,ods,pdf}", GLOB_BRACE);
$folder        = opendir($folder_path);
 
if($num_files > 0){
	
	
	//Si son imagenes
	if($ext=='jpg' || $ext =='jpeg' || $ext == 'gif' || $ext =='png' || $ext == 'bmp') {
        echo '<img src="'.$path.'" />';    
	}
	//Si son archivos microsoft office
	if($ext=='doc' || $ext =='docx' || $ext == 'xls' || $ext =='xlsx' || $ext == 'ppt' || $ext =='pptx') {
        echo '
		<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.DB_SITE.'/'.DB_EMPRESA_PATH.'/'.$path.'" frameborder="0">
			<a target="_blank" rel="noopener noreferrer" href="'.DB_SITE.'/'.DB_EMPRESA_PATH.'/'.$path.'">Descargar Documento</a>
		</iframe>';
	}
	//Si son archivos open office
	if($ext=='odt' || $ext =='odp' || $ext == 'ods' || $ext == 'pdf') {
        echo '<iframe src = "'.DB_SITE.'/LIBS_js/ViewerJS/#../../'.DB_EMPRESA_PATH.'/'.$path.'" allowfullscreen webkitallowfullscreen></iframe>';
	}

	//Si son archivos de audio
	if($ext=='mp3') {
        echo '
			<link rel="stylesheet" type="text/css" href="'.DB_SITE.'/LIBS_js/audio_player/css/style.css">
			<div class="audio green-audio-player">
				<div class="loading">
					<div class="spinner"></div>
				</div>
				<div class="play-pause-btn">  
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24">
						<path fill="#566574" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause"/>
					</svg>
				</div>
				  
				<div class="controls">
					<span class="current-time">0:00</span>
					<div class="slider" data-direction="horizontal">
						<div class="progress">
							<div class="pin" id="progress-pin" data-method="rewind"></div>
						</div>
					</div>
					<span class="total-time">0:00</span>
				</div>
				  
				<div class="volume">
					<div class="volume-btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
							<path fill="#566574" fill-rule="evenodd" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z" id="speaker"/>
						</svg>
					</div>
					<div class="volume-controls hidden">
						<div class="slider" data-direction="vertical">
							<div class="progress">
								<div class="pin" id="volume-pin" data-method="changeVolume"></div>
							</div>
						</div>
					</div>
				</div>
				  
				<audio crossorigin>
					<source src="'.$path.'">
				</audio>
			</div>
			<script src="'.DB_SITE.'/LIBS_js/audio_player/js/index.js"></script>        
        ';
	}
	
	//Si son archivos de video
	if($ext=='mp4' || $ext =='webm' || $ext == 'ogv' ) {
		echo '
		
			<link href="'.DB_SITE.'/LIBS_js/video_player/video-js.min.css" rel="stylesheet">
			<script src="'.DB_SITE.'/LIBS_js/video_player/ie8/videojs-ie8.min.js"></script>
			<script src="'.DB_SITE.'/LIBS_js/video_player/video.min.js"></script>
			<style>
			.video-js .vjs-big-play-button {
				visibility: hidden !important;
			}
			
			</style>
			
			<video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264" poster="'.DB_SITE.'/LIB_assets/img/video-thumbnail.png" data-setup="{}">';
				switch ($ext) {
					case 'mp4':
						echo '<source src="'.$path.'" type="video/mp4">';
						break;
					case 'webm':
						echo '<source src="'.$path.'" type="video/webm">';
						break;
					case 'ogv':
						echo '<source src="'.$path.'" type="video/ogg">';
						break;
				}
				echo '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank" rel="noopener noreferrer">supports HTML5 video</a></p>
			</video>
			
			
    
		';
	}
	
}else{
	//se fuerza la descarga del archivo en caso de no ser soportado
	if(isset($folder_path)&&$folder_path!=''&&isset($file_name)&&$file_name!=''){
		header ("Content-Disposition: attachment; filename=".$folder_path." ");
		header ("Content-Type: application/octet-stream");
		header ("Content-Length: ".filesize($path));
		readfile($path);
	}
}
closedir($folder);
?>


<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
		
	</body>
</html>
