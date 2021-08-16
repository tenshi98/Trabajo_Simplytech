<?php session_start();
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
//Cargamos la ubicacion 
$original = "core_sistemas.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
?>


<div class="row">
<div class="col-lg-12">
<h2>Dark
<small>primary</small>
</h2>
<div class="btn-group" data-toggle="buttons" id="dark-toggle">
<label class="btn btn-primary">
<input type="radio" name="options" value="primary"> Primary
</label>
<label class="btn btn-success">
<input type="radio" name="options" value="success"> Success
</label>
<label class="btn btn-danger">
<input type="radio" name="options" value="danger"> Danger
</label>
<label class="btn btn-info">
<input type="radio" name="options" value="info"> Info
</label>
<label class="btn btn-warning">
<input type="radio" name="options" value="warning"> Warning
</label>
<label class="btn btn-default">
<input type="radio" name="options" value="default"> Default
</label>
</div>
<ul class="pricing-table dark" contenteditable="">
<li class="col-lg-4">
<h3>Starter</h3>
<div class="price-body">
<div class="price">
Free
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>5 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>2 months</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-info btn-rect">Get Started</a>
</div>
</li>

<li class="active primary col-lg-4">
<h3>Basic</h3>
<div class="price-body">
<div class="price">
<span class="price-figure"><sup>$</sup>24<small>.99</small> </span>
<span class="price-term">per month</span>
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>20 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>6 months</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-metis-1 btn-lg btn-rect">Get Started</a>
</div>
</li>
<li class="col-lg-4">
<h3>Premium</h3>
<div class="price-body">
<div class="price">
<span class="price-figure"><sup>$</sup>49<small>.99</small> </span>
<span class="price-term">per month</span>
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>50 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>Lifetime</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-info btn-rect">Get Started</a>
</div>
</li>
<div class="clearfix"></div>
</ul>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<h2>Light
<small>warning</small>
</h2>
<div class="btn-group" data-toggle="buttons" id="light-toggle">
<label class="btn btn-primary">
<input type="radio" name="options" value="primary"> Primary
</label>
<label class="btn btn-success">
<input type="radio" name="options" value="success"> Success
</label>
<label class="btn btn-danger">
<input type="radio" name="options" value="danger"> Danger
</label>
<label class="btn btn-info">
<input type="radio" name="options" value="info"> Info
</label>
<label class="btn btn-warning">
<input type="radio" name="options" value="warning"> Warning
</label>
<label class="btn btn-default">
<input type="radio" name="options" value="default"> Default
</label>
</div>
<ul class="pricing-table" id="light" contenteditable="">
<li class="col-lg-3">
<h3>Starter</h3>
<div class="price-body">
 <div class="price">
Free
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>5 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>2 months</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-info btn-rect">Get Started</a>
</div>
</li>

<li class="active danger col-lg-3">
<h3>Basic</h3>
<div class="price-body">
<div class="price">
<span class="price-figure"><sup>$</sup>24<small>.99</small> </span>
<span class="price-term">per month</span>
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>20 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>6 months</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-metis-1 btn-lg btn-rect">Get Started</a>
</div>
</li>
<li class="col-lg-3">
<h3>Premium</h3>
<div class="price-body">
<div class="price">
<span class="price-figure"><sup>$</sup>49<small>.99</small> </span>
<span class="price-term">per month</span>
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>50 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>Lifetime</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-info btn-rect">Get Started</a>
</div>
</li>
<li class="col-lg-3">
<h3>Ultra</h3>
<div class="price-body">
<div class="price">
<span class="price-figure"><sup>$</sup>149<small>.99</small> </span>
<span class="price-term">per month</span>
</div>
</div>
<div class="features">
<ul>
<li>Premium Profile Listing</li>
<li>Unlimited File Access</li>
<li>Free Appointments</li>
<li><strong>150 Bonus Points</strong> every month</li>
<li>Customizable Profile Page</li>
<li><strong>Eternity</strong> support</li>
</ul>
</div>
<div class="footer">
<a href="#" class="btn btn-info btn-rect">Get Started</a>
</div>
</li>
<div class="clearfix"></div>
</ul>
</div>
</div>



<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
