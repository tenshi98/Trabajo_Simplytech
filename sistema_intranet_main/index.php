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
//Configuracion de la plataforma
require_once 'A1XRXS_sys/xrxs_configuracion/config.php';
require_once 'core/rename.php';

//Carga de las funciones del nucleo
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Utils.Load.php';                  //Carga de variables
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Common.php';            //Funciones comunes
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Convertions.php';       //Conversiones de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Date.php';         //Funciones relacionadas a las fechas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Numbers.php';      //Funciones relacionadas a los numeros
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Operations.php';   //Funciones relacionadas a operaciones matematicas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Text.php';         //Funciones relacionadas a los textos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Time.php';         //Funciones relacionadas a las horas
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Data.Validations.php';  //Funciones de validacion de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.DataBase.php';          //Funciones relacionadas a la base de datos
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.Location.php';          //Funciones relacionadas a la geolozalizacion
require_once '../A2XRXS_gears/xrxs_funciones/Helpers.Functions.ServerData.php';        //Funciones para entregar informacion del servidor o cliente


//Carga de los componentes de los formularios
require_once '../A2XRXS_gears/xrxs_funciones/Components.UI.FormInputs.php';
require_once '../A2XRXS_gears/xrxs_funciones/Components.UI.Inputs.php';
require_once '../A2XRXS_gears/xrxs_funciones/Components.UI.Widgets.php';

//carga librerias propias de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';
require_once '../Legacy/gestion_modular/funciones/Components.UI.FormInputs.Extended.php';
require_once '../Legacy/gestion_modular/funciones/Components.UI.Inputs.Extended.php';
require_once '../Legacy/gestion_modular/funciones/Components.UI.Widgets.Extended.php';


// obtengo puntero de conexion con la db
$dbConn = conectar();

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
/***********************************************/
//Elimino los datos previos del form
unset($_SESSION['form_require']);
//se carga dato previo
$_SESSION['form_require'] = 'required';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_1.css">
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/lib/fullcalendar/fullcalendar.css">
    <!-- Estilo definido por mi -->
    <link href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css" rel="stylesheet" type="text/css">
	<script src="<?php echo DB_SITE ?>/LIB_assets/js/personel.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo DB_SITE ?>/LIB_assets/lib/html5shiv/html5shiv.js"></script>
        <script src="<?php echo DB_SITE ?>/LIB_assets/lib/respond/respond.min.js"></script>
        <![endif]-->
    <!--Modulos de javascript-->
    <script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
    <script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
	<!-- Icono de la pagina -->
	<link rel="icon" type="image/png" href="img/mifavicon.png" />
  </head>
  <body class="login">
<?php 
//Despliegue de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}

//Se ven las mantenciones programadas
$query = "SELECT Fecha, Hora_ini, Hora_fin
FROM `core_mantenciones`
ORDER BY idMantencion
LIMIT 1 ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
$Mantenciones = mysqli_fetch_assoc ($resultado);

//calculos
$bloqueo=0;
if(strtotime($Mantenciones['Fecha'])>=strtotime(fecha_actual())){    $bloqueo++;}
if(strtotime($Mantenciones['Hora_ini'])<=strtotime(hora_actual())){  $bloqueo++;}
if(strtotime($Mantenciones['Hora_fin'])>=strtotime(hora_actual())){  $bloqueo++;}
	
//Si no esta bloquedado
if($bloqueo!=3){ 
	require_once '1include_login_form.php';
//Si esta bloqueado
} else{ 
	echo '
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 ">
				<h1 class="comingsoontxt">Sitio en mantencion desde '.$Mantenciones['Hora_ini'].' hasta las '.$Mantenciones['Hora_fin'].' hrs</h1>
			</div>
			<div class="col-md-3"></div>
		</div>';
		require_once '1include_login_ani.php';         
	echo '</div>';	
} 
require_once '../LIBS_js/validator/form_validator.php';?>
	
  </body>
</html>
