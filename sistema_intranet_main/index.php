<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../A2XRXS_gears/xrxs_seguridad/AntiXSS.php';
require_once '../A2XRXS_gears/xrxs_seguridad/Bootup.php';
require_once '../A2XRXS_gears/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'A1XRXS_sys/xrxs_configuracion/config.php';                                  //Configuracion de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';         //carga librerias de la plataforma
require_once '../Legacy/gestion_modular/funciones/Components.UI.FormInputs.Extended.php'; //carga formularios de la plataforma
require_once '../Legacy/gestion_modular/funciones/Components.UI.Inputs.Extended.php';     //carga inputs de la plataforma
require_once '../Legacy/gestion_modular/funciones/Components.UI.Widgets.Extended.php';    //carga widgets de la plataforma

// obtengo puntero de conexion con la db
$dbConn = conectar();
//Se elimina la restriccion del sql 5.7
mysqli_query($dbConn, "SET SESSION sql_mode = ''");
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "index.php";
/**********************************************************************************************************************************/
/*                                               Se cargan los formularios                                                        */
/**********************************************************************************************************************************/
//formulario para iniciar sesion
if ( !empty($_POST['submit_login']) )  { 
	$form_trabajo= 'login';
	require_once 'A1XRXS_sys/xrxs_form/usuarios_listado.php';
}
//formulario para recuperar la contraseña
if ( !empty($_POST['submit_pass']) )  { 
	$form_trabajo= 'getpass';
	require_once 'A1XRXS_sys/xrxs_form/usuarios_listado.php';
}
/**********************************************************************************************************************************/
/*                                                     Armado del form                                                            */
/**********************************************************************************************************************************/
//Elimino los datos previos del form
unset($_SESSION['form_require']);
//se carga dato previo
$_SESSION['form_require'] = 'required';
?>
<!DOCTYPE html>
<html lang="es-ES">
	<head>
		<!-- Info-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport"              content="width=device-width, initial-scale=1, user-scalable=no">
		<meta http-equiv="Content-Type"    content="text/html; charset=UTF-8">
		
		<!-- Informacion del sitio-->
		<title>Login</title>
		<meta name="description"           content="">
		<meta name="author"                content="">
		<meta name="keywords"              content="">
		
		<!-- WEB FONT -->
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
		<!-- CSS Base -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/bootstrap3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/lib/fullcalendar/fullcalendar.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIB_assets/css/my_colors.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/prism/prism.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/elegant_font/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/material_datetimepicker/css/bootstrap-material-datetimepicker.min.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_colorpicker/dist/css/bootstrap-colorpicker.min.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_colorpicker/dist/css/bootstrap-colorpicker-plus.min.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_fileinput/css/fileinput.min.css" media="all" >
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_fileinput/themes/explorer/theme.min.css" media="all" >
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/country_picker/css/bootstrap-select.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/chosen/chosen.css">

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/js/main.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/form_functions.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/rut_validate/jquery.rut.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_touchspin/src/jquery.bootstrap-touchspin.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/material_datetimepicker/js/moment-with-locales.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/material_datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/clock_timepicker/dist/bootstrap-clockpicker.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/autosize/dist/autosize.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_fileinput/js/plugins/sortable.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_fileinput/js/fileinput.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_fileinput/js/locales/es.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/bootstrap_fileinput/themes/explorer/theme.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/country_picker/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/plotly_js/dist/plotly.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/plotly_js/dist/plotly-locale-es-ar.js"></script>
		
		<!-- Favicons-->
		<?php
		//Favicon Personalizado
		$nombre_fichero = 'img/mifavicon.png';
		if (file_exists($nombre_fichero)) { ?>
			<link rel="icon"             type="image/png"                    href="img/mifavicon.png" >
			<link rel="shortcut icon"    type="image/x-icon"                 href="img/mifavicon.png" >
			<link rel="apple-touch-icon" type="image/x-icon"                 href="img/mifavicon-57x57.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"   href="img/mifavicon-72x72.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/mifavicon-114x114.png">
			<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/mifavicon-144x144.png">
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
		
		<!-- Correcciones CSS -->
		<style>
			.login {background-image: none !important;background-color: #1A1A1A !important;}
			.login .form-signin {max-width: 330px;padding: 20px;margin: 0 auto;background-color: rgba(255, 255, 255, 0.7) !important;border-radius: 15px;-webkit-box-shadow: none !important;-moz-box-shadow: none !important;box-shadow: none !important;position: relative;}
			.login_logo{width:100%!important;margin-bottom: 20px;}
			.tab-content .text-muted {margin-left: 0px !important;color: #FFFFFF !important;}
		</style>
	</head>
	<body class="login">
	  
		<canvas id="canv" style="width: 100%;height: 100%;position: absolute;top: 0px;left: 0px;"></canvas>
	  
	  
<?php 
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}

/**********************************************************************************************************************************/
/*                                                   Verificacion bloqueos                                                        */
/**********************************************************************************************************************************/
//fichero del logo
$nombre_fichero = 'img/login_logo.png';
//calculos
$bloqueo = 0;
//reviso si se conecta desde chile
$INT_IP   = obtenerIpCliente();
$INT_Pais = obtenerInfoIp($INT_IP, "countryName");

//Se consultan los datos
$Mantenciones = db_select_data (false, 'Fecha, Hora_ini, Hora_fin', 'core_mantenciones', '', "idMantencion!=0 ORDER BY idMantencion DESC", $dbConn, 'login', basename($_SERVER["REQUEST_URI"], ".php"), 'Mantenciones');
$ip_bloqueada = db_select_nrows (false, 'idBloqueo', 'sistema_seguridad_bloqueo_ip', '', "IP_Client='".$INT_IP."'", $dbConn, 'login', basename($_SERVER["REQUEST_URI"], ".php"), 'ip_bloqueada');

//Se crean los bloqueos
if(strtotime($Mantenciones['Fecha'])>=strtotime(fecha_actual())&&strtotime($Mantenciones['Hora_ini'])<=strtotime(hora_actual())&&strtotime($Mantenciones['Hora_fin'])>=strtotime(hora_actual())&&$bloqueo==0){ $bloqueo=1;}
if(isset($INT_Pais)&&$INT_Pais!=''&&$INT_Pais!='Chile'&&$INT_IP!='::1'&&$bloqueo==0){  $bloqueo = 2;}
if(isset($ip_bloqueada)&&$ip_bloqueada!=0&&$bloqueo==0){ $bloqueo = 3;}
	
/**********************************************************************************************************************************/
/*                                                        Despliegue                                                              */
/**********************************************************************************************************************************/
//Imagen del logo

if (file_exists($nombre_fichero)) {
	echo '
	<style>
		.btn-primary {color: #fff;background-color: #8b00ff !important;border-color: #8b00ff !important;}
		.btn-primary:hover {background-color: #670CB3 !important;}
		.login_text1{color: #111111 !important;text-align: center;margin-top: 0px;margin-bottom: 0px;}
	</style>
	';
}else{
	echo '
	<style>
		.login_text1{color: #DB4F21 !important;text-align: center;margin-top: 0px;margin-bottom: 0px;}
	</style>
	';
}


//se selecciona la pantalla a mostrar
switch ($bloqueo) {
    //pantalla normal
    case 0:
        require_once '1include_login_form.php';
        break;
	//pantalla de mantenimiento
    case 1:
        require_once '1include_login_ani.php';
        break;
    //pantalla de bloqueo pais
    case 2:
        require_once '1include_login_block.php';
        //se entregan datos
        $sesion_archivo  = 'index.php';
		$sesion_tarea    = 'login-form';
        //se valida hackeo
		require_once 'A1XRXS_sys/xrxs_form/0_hacking_1.php';
        break;
    //pantalla de baneo
    case 3:
        require_once '1include_login_banned.php';
        break;
}
//validador
widget_validator(); ?>
	
	
	
		<script id="rendered-js" >
			window.requestAnimFrame = function () {
			  return window.requestAnimationFrame ||
			  window.webkitRequestAnimationFrame ||
			  window.mozRequestAnimationFrame ||
			  window.oRequestAnimationFrame ||
			  window.msRequestAnimationFrame ||
			  function (callback) {
				window.setTimeout(callback, 1000 / 60);
			  };
			}();

			var c = document.getElementById('canv'),
			$ = c.getContext('2d'),
			w = c.width = window.innerWidth,
			h = c.height = window.innerHeight,
			arr = [],
			u = 0;
			o = 0,

			$.fillStyle = '#1A1A1A';
			$.fillRect(0, 0, w, h);
			$.globalCompositeOperation = "source-over";

			var inv = function () {
			  $.restore();
			  $.fillStyle = "#" + (o ? "FEFAE6" : "1A1A1A");
			  $.fillRect(0, 0, w, h);
			  $.fillStyle = "#" + (o ? "1A1A1A" : "FEFAE6");
			  $.save();
			};

			window.addEventListener('resize', function () {
			  c.width = window.innerWidth;
			  c.height = window.innerHeight;
			}, false);

			var ready = function () {
			  arr = [];
			  for (let i = 0; i < 20; i++) {
				set();
			  }
			};

			var set = function () {
			  arr.push({
				x1: w,
				y1: h,
				_x1: w - Math.random() * w,
				_y1: h - Math.random() * h,
				_x2: w - Math.random() * w,
				_y2: h - Math.random() * h,
				x2: -w + Math.random() * w,
				y2: -h + Math.random() * h,
				rot: Math.random() * 180,
				a1: Math.random() * 10,
				a2: Math.random() * 10,
				a3: Math.random() * 10 });

			};

			var pretty = function () {
			  //u -= .2;
			  u = 190;
			  for (var i in arr) {
				var b = arr[i];
				b._x1 *= Math.sin(b.a1 -= 0.001);
				b._y1 *= Math.sin(b.a1);
				b._x2 -= Math.sin(b.a2 += 0.001);
				b._y1 += Math.sin(b.a2);
				b.x1 -= Math.sin(b.a3 += 0.001);
				b.y1 += Math.sin(b.a3);
				b.x2 -= Math.sin(b.a3 -= 0.001);
				b.y2 += Math.sin(b.a3);
				$.save();
				$.globalAlpha = 0.03;
				$.beginPath();
				$.strokeStyle = 'hsla(' + u + ', 85%, 60%, .7)';
				$.moveTo(b.x1, b.y1);
				$.bezierCurveTo(b._x1, b._y1, b._x2, b._y2, b.x2, b.y2);
				$.stroke();
				$.restore();
			  }
			  window.requestAnimFrame(pretty);
			};
			ready();
			pretty();

		</script>
	</body>
</html>
