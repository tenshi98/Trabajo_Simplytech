<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
//Verifico si es superusuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Type.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion original
$original = "core_sistemas.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
?>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="box">
<header>
<h5>Basic Progress Bar

</h5>
<div class="toolbar">
<div class="progress mini">
<div class="progress-bar" style="width: 43%;" data-original-title="" title=""></div>
</div>
</div>
</header>
<div class="body">
<div class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete</span>
</div>
</div>
<div class="progress">
<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;" data-original-title="" title="">
<span class="sr-only">20% Complete</span>
</div>
</div>
<div class="progress">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;" data-original-title="" title="">
<span class="sr-only">40% Complete (success)</span>
</div>
</div>
<div class="progress">
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete (warning)</span>
</div>
</div>
<div class="progress">
<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;" data-original-title="" title="">
<span class="sr-only">80% Complete</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="box">
<header>
<h5>Striped Progress Bar

</h5>
<div class="toolbar">
<div class="progress mini progress-striped">
<div class="progress-bar" style="width: 43%;" data-original-title="" title=""></div>
</div>
</div>
</header>
<div class="body">
<div class="progress progress-striped">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete</span>
</div>
</div>
<div class="progress progress-striped">
<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;" data-original-title="" title="">
<span class="sr-only">20% Complete</span>
</div>
</div>
<div class="progress progress-striped">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;" data-original-title="" title="">
<span class="sr-only">40% Complete (success)</span>
</div>
</div>
<div class="progress progress-striped">
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete (warning)</span>
</div>
</div>
<div class="progress progress-striped">
<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;" data-original-title="" title="">
<span class="sr-only">80% Complete</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="box">
<header>
<h5>Animated Striped Progress Bar

</h5>
<div class="toolbar">
<div class="progress mini progress-striped active">
<div class="progress-bar" style="width: 43%;" data-original-title="" title=""></div>
</div>
</div>
</header>
<div class="body">
<div class="progress progress-striped active">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete</span>
</div>
</div>
<div class="progress progress-striped active">
<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;" data-original-title="" title="">
<span class="sr-only">20% Complete</span>
</div>
</div>
<div class="progress progress-striped active">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;" data-original-title="" title="">
<span class="sr-only">40% Complete (success)</span>
</div>
</div>
<div class="progress progress-striped active">
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete (warning)</span>
 </div>
</div>
<div class="progress progress-striped active">
<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;" data-original-title="" title="">
<span class="sr-only">80% Complete</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="box">
<header>
<h5>Stacked Progress Bar

</h5>
<div class="toolbar">
<div class="progress mini">
<div class="progress-bar progress-bar-success" style="width: 35%;" data-original-title="" title=""><span class="sr-only">35% Complete (success)</span>
</div>
<div class="progress-bar progress-bar-warning" style="width: 20%;" data-original-title="" title=""><span class="sr-only">20% Complete (warning)</span>
</div>
<div class="progress-bar progress-bar-danger" style="width: 10%;" data-original-title="" title=""><span class="sr-only">10% Complete (danger)</span>
</div>
</div>
</div>
</header>
<div class="body">
<div class="progress">
<div class="progress-bar progress-bar-success" style="width: 35%;" data-original-title="" title=""><span class="sr-only">35% Complete (success)</span>
</div>
<div class="progress-bar progress-bar-warning" style="width: 20%;" data-original-title="" title=""><span class="sr-only">20% Complete (warning)</span>
</div>
<div class="progress-bar progress-bar-danger" style="width: 10%;" data-original-title="" title=""><span class="sr-only">10% Complete (danger)</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="box">
<header>
<h5>Progress Bar Size

</h5>
<div class="toolbar">
<div class="progress mini progress-striped active">
<div class="progress-bar" style="width: 43%;" data-original-title="" title=""></div>
</div>
</div>
</header>
<div class="body">
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">Default</div>
<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
<div class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete</span>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">large</div>
<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
<div class="progress lg">
<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" data-original-title="" title="">
<span class="sr-only">60% Complete</span>
</div>
</div>
 </div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">Middle</div>
<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
<div class="progress md">
<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;" data-original-title="" title="">
<span class="sr-only">20% Complete</span>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">Mini</div>
<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
<div class="progress xs">
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;" data-original-title="" title="">
<span class="sr-only">40% Complete (success)</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
