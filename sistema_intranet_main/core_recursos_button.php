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

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#Default"  data-toggle="tab">Default Button</a></li>
				<li class=""><a href="#Line"           data-toggle="tab">Line Button</a></li>
				<li class=""><a href="#Rectangle"      data-toggle="tab">Rectangle Button</a></li>
				<li class=""><a href="#Circle"         data-toggle="tab">Circle Button</a></li>
				<li class=""><a href="#Rounded"        data-toggle="tab">Rounded Button</a></li>
				<li class=""><a href="#Flat"           data-toggle="tab">Flat Button</a></li>
				<li class=""><a href="#Gradient"       data-toggle="tab">Gradient Button</a></li>
				<li class=""><a href="#Gradient2"      data-toggle="tab">Gradient &amp; Rectangle Button</a></li>
				<li class=""><a href="#Flat2"          data-toggle="tab">Flat &amp; Rectangle Button</a></li>
				<li class=""><a href="#Line2"          data-toggle="tab">Line &amp; Rectangle Button</a></li>
				<li class=""><a href="#Circle2"        data-toggle="tab">Circle &amp; Line Button</a></li>
				<li class=""><a href="#Circle3"        data-toggle="tab">Circle &amp; Gradient Button</a></li>
				<li class=""><a href="#Rounded2"       data-toggle="tab">Rounded &amp; Line Button</a></li>
				<li class=""><a href="#bttn"           data-toggle="tab">bttn</a></li>
				<li class=""><a href="#directional"    data-toggle="tab">directional Buttons</a></li>
			</ul>
		</header>
        <div class="tab-content">
			<div class="tab-pane fade active in" id="Default">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Line">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-line" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-line" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-line" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-line" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Rectangle">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-rect" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Circle">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-circle" data-original-title="" title="">de</a>
				<a href="#" class="btn btn-primary btn-circle" data-original-title="" title="">pr</a>
				<a href="#" class="btn btn-danger btn-circle" data-original-title="" title="">da</a>
				<a href="#" class="btn btn-success btn-circle" data-original-title="" title="">su</a>
				<a href="#" class="btn btn-info btn-circle" data-original-title="" title="">in</a>
				<a href="#" class="btn btn-warning btn-circle" data-original-title="" title="">wa</a>
				<a href="#" class="btn btn-metis-1 btn-circle" data-original-title="" title="">m1</a>
				<a href="#" class="btn btn-metis-2 btn-circle" data-original-title="" title="">m2</a>
				<a href="#" class="btn btn-metis-3 btn-circle" data-original-title="" title="">m3</a>
				<a href="#" class="btn btn-metis-4 btn-circle" data-original-title="" title="">m4</a>
				<a href="#" class="btn btn-metis-5 btn-circle" data-original-title="" title="">m5</a>
				<a href="#" class="btn btn-metis-6 btn-circle" data-original-title="" title="">m6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-circle" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-primary btn-xs btn-circle" data-original-title="" title="">p</a>
				<a href="#" class="btn btn-danger btn-xs btn-circle" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-success btn-xs btn-circle" data-original-title="" title="">s</a>
				<a href="#" class="btn btn-info btn-xs btn-circle" data-original-title="" title="">i</a>
				<a href="#" class="btn btn-warning btn-xs btn-circle" data-original-title="" title="">w</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-circle" data-original-title="" title="">1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-circle" data-original-title="" title="">2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-circle" data-original-title="" title="">3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-circle" data-original-title="" title="">4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-circle" data-original-title="" title="">5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-circle" data-original-title="" title="">6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-circle" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-primary btn-sm btn-circle" data-original-title="" title="">p</a>
				<a href="#" class="btn btn-danger btn-sm btn-circle" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-success btn-sm btn-circle" data-original-title="" title="">s</a>
				<a href="#" class="btn btn-info btn-sm btn-circle" data-original-title="" title="">i</a>
				<a href="#" class="btn btn-warning btn-sm btn-circle" data-original-title="" title="">w</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-circle" data-original-title="" title="">1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-circle" data-original-title="" title="">2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-circle" data-original-title="" title="">3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-circle" data-original-title="" title="">4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-circle" data-original-title="" title="">5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-circle" data-original-title="" title="">6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-circle" data-original-title="" title="">def</a>
				<a href="#" class="btn btn-primary btn-lg btn-circle" data-original-title="" title="">pri</a>
				<a href="#" class="btn btn-danger btn-lg btn-circle" data-original-title="" title="">dan</a>
				<a href="#" class="btn btn-success btn-lg btn-circle" data-original-title="" title="">suc</a>
				<a href="#" class="btn btn-info btn-lg btn-circle" data-original-title="" title="">inf</a>
				<a href="#" class="btn btn-warning btn-lg btn-circle" data-original-title="" title="">war</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-circle" data-original-title="" title="">m-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-circle" data-original-title="" title="">m-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-circle" data-original-title="" title="">m-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-circle" data-original-title="" title="">m-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-circle" data-original-title="" title="">m-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-circle" data-original-title="" title="">m-6</a>
			</div>
			<div class="tab-pane fade" id="Rounded">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-round" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-round" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-round" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-round" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-round" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-round" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-round" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-round" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-round" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-round" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-round" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-round" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-round" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-round" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-round" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-round" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-round" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-round" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-round" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-round" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-round" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-round" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-round" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-round" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-round" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-round" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-round" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-round" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-round" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-round" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-round" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-round" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-round" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-round" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-round" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-round" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-round" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-round" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-round" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-round" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-round" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-round" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-round" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-round" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-round" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-round" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-round" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-round" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Flat">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-flat" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-flat" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-flat" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-flat" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-flat" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-flat" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-flat" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-flat" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-flat" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-flat" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-flat" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-flat" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-flat" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-flat" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-flat" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-flat" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-flat" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-flat" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-flat" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-flat" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-flat" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-flat" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-flat" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-flat" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-flat" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-flat" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-flat" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-flat" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-flat" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-flat" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-flat" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-flat" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-flat" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-flat" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-flat" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-flat" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-flat" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-flat" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-flat" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-flat" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-flat" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-flat" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-flat" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-flat" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-flat" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-flat" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-flat" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-flat" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Gradient">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-grad" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-grad" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-grad" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-grad" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-grad" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-grad" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-grad" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-grad" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-grad" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-grad" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-grad" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-grad" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-grad" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-grad" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-grad" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-grad" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-grad" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-grad" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-grad" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-grad" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-grad" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-grad" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-grad" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-grad" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-grad" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-grad" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-grad" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-grad" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-grad" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-grad" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-grad" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-grad" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-grad" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-grad" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-grad" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-grad" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-grad" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-grad" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-grad" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-grad" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-grad" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-grad" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-grad" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-grad" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-grad" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-grad" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-grad" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-grad" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Gradient2">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-grad btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-grad btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-grad btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-grad btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-grad btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-grad btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-grad btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-grad btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-grad btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-grad btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-grad btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-grad btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-grad btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-grad btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-grad btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-grad btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-grad btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-grad btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-grad btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-grad btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-grad btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-grad btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-grad btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-grad btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-grad btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-grad btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-grad btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-grad btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-grad btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-grad btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-grad btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-grad btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-grad btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-grad btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-grad btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-grad btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-grad btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-grad btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-grad btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-grad btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-grad btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-grad btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-grad btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-grad btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-grad btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-grad btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-grad btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-grad btn-rect" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Flat2">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-flat btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-flat btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-flat btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-flat btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-flat btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-flat btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-flat btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-flat btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-flat btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-flat btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-flat btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-flat btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-flat btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-flat btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-flat btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-flat btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-flat btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-flat btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-flat btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-flat btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-flat btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-flat btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-flat btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-flat btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-flat btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-flat btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-flat btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-flat btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-flat btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-flat btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-flat btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-flat btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-flat btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-flat btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-flat btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-flat btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-flat btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-flat btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-flat btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-flat btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-flat btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-flat btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-flat btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-flat btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-flat btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-flat btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-flat btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-flat btn-rect" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Line2">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-line btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-line btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-line btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-line btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-line btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-line btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-line btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-line btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-line btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-line btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-line btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-line btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-line btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-line btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-line btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-line btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-line btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-line btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-line btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-line btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-line btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-line btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-line btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-line btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-line btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-line btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-line btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-line btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-line btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-line btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-line btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-line btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-line btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-line btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-line btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-line btn-rect" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-line btn-rect" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-line btn-rect" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-line btn-rect" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-line btn-rect" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-line btn-rect" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-line btn-rect" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-line btn-rect" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-line btn-rect" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-line btn-rect" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-line btn-rect" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-line btn-rect" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-line btn-rect" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="Circle2">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-circle btn-line" data-original-title="" title="">de</a>
				<a href="#" class="btn btn-primary btn-circle btn-line" data-original-title="" title="">pr</a>
				<a href="#" class="btn btn-danger btn-circle btn-line" data-original-title="" title="">da</a>
				<a href="#" class="btn btn-success btn-circle btn-line" data-original-title="" title="">su</a>
				<a href="#" class="btn btn-info btn-circle btn-line" data-original-title="" title="">in</a>
				<a href="#" class="btn btn-warning btn-circle btn-line" data-original-title="" title="">wa</a>
				<a href="#" class="btn btn-metis-1 btn-circle btn-line" data-original-title="" title="">m1</a>
				<a href="#" class="btn btn-metis-2 btn-circle btn-line" data-original-title="" title="">m2</a>
				<a href="#" class="btn btn-metis-3 btn-circle btn-line" data-original-title="" title="">m3</a>
				<a href="#" class="btn btn-metis-4 btn-circle btn-line" data-original-title="" title="">m4</a>
				<a href="#" class="btn btn-metis-5 btn-circle btn-line" data-original-title="" title="">m5</a>
				<a href="#" class="btn btn-metis-6 btn-circle btn-line" data-original-title="" title="">m6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-circle btn-line" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-primary btn-xs btn-circle btn-line" data-original-title="" title="">p</a>
				<a href="#" class="btn btn-danger btn-xs btn-circle btn-line" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-success btn-xs btn-circle btn-line" data-original-title="" title="">s</a>
				<a href="#" class="btn btn-info btn-xs btn-circle btn-line" data-original-title="" title="">i</a>
				<a href="#" class="btn btn-warning btn-xs btn-circle btn-line" data-original-title="" title="">w</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-circle btn-line" data-original-title="" title="">1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-circle btn-line" data-original-title="" title="">2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-circle btn-line" data-original-title="" title="">3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-circle btn-line" data-original-title="" title="">4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-circle btn-line" data-original-title="" title="">5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-circle btn-line" data-original-title="" title="">6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-circle btn-line" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-primary btn-sm btn-circle btn-line" data-original-title="" title="">p</a>
				<a href="#" class="btn btn-danger btn-sm btn-circle btn-line" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-success btn-sm btn-circle btn-line" data-original-title="" title="">s</a>
				<a href="#" class="btn btn-info btn-sm btn-circle btn-line" data-original-title="" title="">i</a>
				<a href="#" class="btn btn-warning btn-sm btn-circle btn-line" data-original-title="" title="">w</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-circle btn-line" data-original-title="" title="">1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-circle btn-line" data-original-title="" title="">2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-circle btn-line" data-original-title="" title="">3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-circle btn-line" data-original-title="" title="">4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-circle btn-line" data-original-title="" title="">5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-circle btn-line" data-original-title="" title="">6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-circle btn-line" data-original-title="" title="">def</a>
				<a href="#" class="btn btn-primary btn-lg btn-circle btn-line" data-original-title="" title="">pri</a>
				<a href="#" class="btn btn-danger btn-lg btn-circle btn-line" data-original-title="" title="">dan</a>
				<a href="#" class="btn btn-success btn-lg btn-circle btn-line" data-original-title="" title="">suc</a>
				<a href="#" class="btn btn-info btn-lg btn-circle btn-line" data-original-title="" title="">inf</a>
				<a href="#" class="btn btn-warning btn-lg btn-circle btn-line" data-original-title="" title="">war</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-circle btn-line" data-original-title="" title="">m-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-circle btn-line" data-original-title="" title="">m-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-circle btn-line" data-original-title="" title="">m-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-circle btn-line" data-original-title="" title="">m-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-circle btn-line" data-original-title="" title="">m-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-circle btn-line" data-original-title="" title="">m-6</a>
			</div>
			<div class="tab-pane fade" id="Circle3">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-circle btn-grad" data-original-title="" title="">de</a>
				<a href="#" class="btn btn-primary btn-circle btn-grad" data-original-title="" title="">pr</a>
				<a href="#" class="btn btn-danger btn-circle btn-grad" data-original-title="" title="">da</a>
				<a href="#" class="btn btn-success btn-circle btn-grad" data-original-title="" title="">su</a>
				<a href="#" class="btn btn-info btn-circle btn-grad" data-original-title="" title="">in</a>
				<a href="#" class="btn btn-warning btn-circle btn-grad" data-original-title="" title="">wa</a>
				<a href="#" class="btn btn-metis-1 btn-circle btn-grad" data-original-title="" title="">m1</a>
				<a href="#" class="btn btn-metis-2 btn-circle btn-grad" data-original-title="" title="">m2</a>
				<a href="#" class="btn btn-metis-3 btn-circle btn-grad" data-original-title="" title="">m3</a>
				<a href="#" class="btn btn-metis-4 btn-circle btn-grad" data-original-title="" title="">m4</a>
				<a href="#" class="btn btn-metis-5 btn-circle btn-grad" data-original-title="" title="">m5</a>
				<a href="#" class="btn btn-metis-6 btn-circle btn-grad" data-original-title="" title="">m6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-circle btn-grad" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-primary btn-xs btn-circle btn-grad" data-original-title="" title="">p</a>
				<a href="#" class="btn btn-danger btn-xs btn-circle btn-grad" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-success btn-xs btn-circle btn-grad" data-original-title="" title="">s</a>
				<a href="#" class="btn btn-info btn-xs btn-circle btn-grad" data-original-title="" title="">i</a>
				<a href="#" class="btn btn-warning btn-xs btn-circle btn-grad" data-original-title="" title="">w</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-circle btn-grad" data-original-title="" title="">1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-circle btn-grad" data-original-title="" title="">2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-circle btn-grad" data-original-title="" title="">3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-circle btn-grad" data-original-title="" title="">4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-circle btn-grad" data-original-title="" title="">5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-circle btn-grad" data-original-title="" title="">6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-circle btn-grad" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-primary btn-sm btn-circle btn-grad" data-original-title="" title="">p</a>
				<a href="#" class="btn btn-danger btn-sm btn-circle btn-grad" data-original-title="" title="">d</a>
				<a href="#" class="btn btn-success btn-sm btn-circle btn-grad" data-original-title="" title="">s</a>
				<a href="#" class="btn btn-info btn-sm btn-circle btn-grad" data-original-title="" title="">i</a>
				<a href="#" class="btn btn-warning btn-sm btn-circle btn-grad" data-original-title="" title="">w</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-circle btn-grad" data-original-title="" title="">1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-circle btn-grad" data-original-title="" title="">2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-circle btn-grad" data-original-title="" title="">3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-circle btn-grad" data-original-title="" title="">4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-circle btn-grad" data-original-title="" title="">5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-circle btn-grad" data-original-title="" title="">6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-circle btn-grad" data-original-title="" title="">def</a>
				<a href="#" class="btn btn-primary btn-lg btn-circle btn-grad" data-original-title="" title="">pri</a>
				<a href="#" class="btn btn-danger btn-lg btn-circle btn-grad" data-original-title="" title="">dan</a>
				<a href="#" class="btn btn-success btn-lg btn-circle btn-grad" data-original-title="" title="">suc</a>
				<a href="#" class="btn btn-info btn-lg btn-circle btn-grad" data-original-title="" title="">inf</a>
				<a href="#" class="btn btn-warning btn-lg btn-circle btn-grad" data-original-title="" title="">war</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-circle btn-grad" data-original-title="" title="">m-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-circle btn-grad" data-original-title="" title="">m-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-circle btn-grad" data-original-title="" title="">m-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-circle btn-grad" data-original-title="" title="">m-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-circle btn-grad" data-original-title="" title="">m-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-circle btn-grad" data-original-title="" title="">m-6</a>
			</div>
			<div class="tab-pane fade" id="Rounded2">
				<h3>Default Button</h3>
				<a href="#" class="btn btn-default btn-round btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-round btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-round btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-round btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-round btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-round btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-round btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-round btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-round btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-round btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-round btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-round btn-line" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Mini Button</h4>
				<a href="#" class="btn btn-default btn-xs btn-round btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-xs btn-round btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-xs btn-round btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-xs btn-round btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-xs btn-round btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-xs btn-round btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-xs btn-round btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-xs btn-round btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-xs btn-round btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-xs btn-round btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-xs btn-round btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-xs btn-round btn-line" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Small Button</h4>
				<a href="#" class="btn btn-default btn-sm btn-round btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-sm btn-round btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-sm btn-round btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-sm btn-round btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-sm btn-round btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-sm btn-round btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-sm btn-round btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-sm btn-round btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-sm btn-round btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-sm btn-round btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-sm btn-round btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-sm btn-round btn-line" data-original-title="" title="">metis-6</a>
				<hr>
				<h4>Large Button</h4>
				<a href="#" class="btn btn-default btn-lg btn-round btn-line" data-original-title="" title="">default</a>
				<a href="#" class="btn btn-primary btn-lg btn-round btn-line" data-original-title="" title="">primary</a>
				<a href="#" class="btn btn-danger btn-lg btn-round btn-line" data-original-title="" title="">danger</a>
				<a href="#" class="btn btn-success btn-lg btn-round btn-line" data-original-title="" title="">success</a>
				<a href="#" class="btn btn-info btn-lg btn-round btn-line" data-original-title="" title="">info</a>
				<a href="#" class="btn btn-warning btn-lg btn-round btn-line" data-original-title="" title="">warning</a>
				<a href="#" class="btn btn-metis-1 btn-lg btn-round btn-line" data-original-title="" title="">metis-1</a>
				<a href="#" class="btn btn-metis-2 btn-lg btn-round btn-line" data-original-title="" title="">metis-2</a>
				<a href="#" class="btn btn-metis-3 btn-lg btn-round btn-line" data-original-title="" title="">metis-3</a>
				<a href="#" class="btn btn-metis-4 btn-lg btn-round btn-line" data-original-title="" title="">metis-4</a>
				<a href="#" class="btn btn-metis-5 btn-lg btn-round btn-line" data-original-title="" title="">metis-5</a>
				<a href="#" class="btn btn-metis-6 btn-lg btn-round btn-line" data-original-title="" title="">metis-6</a>
			</div>
			<div class="tab-pane fade" id="bttn">
				<h3>primary</h3>
				<button class="bttn-slant bttn-md bttn-primary">medium</button>
				<button class="bttn-unite bttn-md bttn-primary">medium</button>
				<button class="bttn-float bttn-md bttn-primary">medium</button>
				<button class="bttn-pill bttn-md bttn-primary">medium</button>
				<button class="bttn-material-flat bttn-md bttn-primary">medium</button>
				<button class="bttn-material-circle bttn-md bttn-primary"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<button class="bttn-fill bttn-md bttn-primary">medium</button>
				<button class="bttn-gradient bttn-md bttn-primary">medium</button>
				<button class="bttn-jelly bttn-md bttn-primary">medium</button>
				<button class="bttn-stretch bttn-md bttn-primary">medium</button>
				<button class="bttn-minimal bttn-md bttn-primary">medium</button>
				<button class="bttn-bordered bttn-md bttn-primary">medium</button>
				<button class="bttn-simple bttn-md bttn-primary">medium</button>
				<hr>
				<h3>warning</h3>
				<button class="bttn-slant bttn-md bttn-warning">medium</button>
				<button class="bttn-unite bttn-md bttn-warning">medium</button>
				<button class="bttn-float bttn-md bttn-warning">medium</button>
				<button class="bttn-pill bttn-md bttn-warning">medium</button>
				<button class="bttn-material-flat bttn-md bttn-warning">medium</button>
				<button class="bttn-material-circle bttn-md bttn-warning"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<button class="bttn-fill bttn-md bttn-warning">medium</button>
				<button class="bttn-gradient bttn-md bttn-warning">medium</button>
				<button class="bttn-jelly bttn-md bttn-warning">medium</button>
				<button class="bttn-stretch bttn-md bttn-warning">medium</button>
				<button class="bttn-minimal bttn-md bttn-warning">medium</button>
				<button class="bttn-bordered bttn-md bttn-warning">medium</button>
				<button class="bttn-simple bttn-md bttn-warning">medium</button>
				<hr>
				<h3>danger</h3>
				<button class="bttn-slant bttn-md bttn-danger">medium</button>
				<button class="bttn-unite bttn-md bttn-danger">medium</button>
				<button class="bttn-float bttn-md bttn-danger">medium</button>
				<button class="bttn-pill bttn-md bttn-danger">medium</button>
				<button class="bttn-material-flat bttn-md bttn-danger">medium</button>
				<button class="bttn-material-circle bttn-md bttn-danger"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<button class="bttn-fill bttn-md bttn-danger">medium</button>
				<button class="bttn-gradient bttn-md bttn-danger">medium</button>
				<button class="bttn-jelly bttn-md bttn-danger">medium</button>
				<button class="bttn-stretch bttn-md bttn-danger">medium</button>
				<button class="bttn-minimal bttn-md bttn-danger">medium</button>
				<button class="bttn-bordered bttn-md bttn-danger">medium</button>
				<button class="bttn-simple bttn-md bttn-danger">medium</button>
				<hr>
				<h3>success</h3>
				<button class="bttn-slant bttn-md bttn-success">medium</button>
				<button class="bttn-unite bttn-md bttn-success">medium</button>
				<button class="bttn-float bttn-md bttn-success">medium</button>
				<button class="bttn-pill bttn-md bttn-success">medium</button>
				<button class="bttn-material-flat bttn-md bttn-success">medium</button>
				<button class="bttn-material-circle bttn-md bttn-success"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<button class="bttn-fill bttn-md bttn-success">medium</button>
				<button class="bttn-gradient bttn-md bttn-success">medium</button>
				<button class="bttn-jelly bttn-md bttn-success">medium</button>
				<button class="bttn-stretch bttn-md bttn-success">medium</button>
				<button class="bttn-minimal bttn-md bttn-success">medium</button>
				<button class="bttn-bordered bttn-md bttn-success">medium</button>
				<button class="bttn-simple bttn-md bttn-success">medium</button>
				<hr>
				<h3>royal</h3>
				<button class="bttn-slant bttn-md bttn-royal">medium</button>
				<button class="bttn-unite bttn-md bttn-royal">medium</button>
				<button class="bttn-float bttn-md bttn-royal">medium</button>
				<button class="bttn-pill bttn-md bttn-royal">medium</button>
				<button class="bttn-material-flat bttn-md bttn-royal">medium</button>
				<button class="bttn-material-circle bttn-md bttn-royal"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<button class="bttn-fill bttn-md bttn-royal">medium</button>
				<button class="bttn-gradient bttn-md bttn-royal">medium</button>
				<button class="bttn-jelly bttn-md bttn-royal">medium</button>
				<button class="bttn-stretch bttn-md bttn-royal">medium</button>
				<button class="bttn-minimal bttn-md bttn-royal">medium</button>
				<button class="bttn-bordered bttn-md bttn-royal">medium</button>
				<button class="bttn-simple bttn-md bttn-royal">medium</button>
				<hr>
				<h3>default</h3>
				<button class="bttn-slant bttn-md bttn-default">medium</button>
				<button class="bttn-unite bttn-md bttn-default">medium</button>
				<button class="bttn-float bttn-md bttn-default">medium</button>
				<button class="bttn-pill bttn-md bttn-default">medium</button>
				<button class="bttn-material-flat bttn-md bttn-default">medium</button>
				<button class="bttn-material-circle bttn-md bttn-default"><i class="fa fa-bars" aria-hidden="true"></i></button>
				<button class="bttn-fill bttn-md bttn-default">medium</button>
				<button class="bttn-gradient bttn-md bttn-default">medium</button>
				<button class="bttn-jelly bttn-md bttn-default">medium</button>
				<button class="bttn-stretch bttn-md bttn-default">medium</button>
				<button class="bttn-minimal bttn-md bttn-default">medium</button>
				<button class="bttn-bordered bttn-md bttn-default">medium</button>
				<button class="bttn-simple bttn-md bttn-default">medium</button>
				<hr>

			</div>
			<div class="tab-pane fade" id="directional" style="padding:25px;">
				<h4>Regular Buttons</h4>
				<button type="button" class="btn btn btn-default btn-arrow-left">Default</button>
				<button type="button" class="btn btn btn-primary btn-arrow-left">Primary</button>
				<button type="button" class="btn btn btn-success btn-arrow-left">Success</button>
				<button type="button" class="btn btn btn-link">Link</button>
				<button type="button" class="btn btn-info btn-arrow-right">Info</button>
				<button type="button" class="btn btn-warning btn-arrow-right">Warning</button>
				<button type="button" class="btn btn-danger btn-arrow-right">Danger</button>

				<h5>Inside .btn-group</h5>
				<div class='btn-group'>
					<button type="button" class="btn btn-default btn-arrow-left">Default</button>
					<button type="button" class="btn btn-primary btn-arrow-left">Primary</button>
					<button type="button" class="btn btn-success btn-arrow-left">Success</button>
					<button type="button" class="btn btn-link">Link</button>
					<button type="button" class="btn btn-info btn-arrow-right">Info</button>
					<button type="button" class="btn btn-warning btn-arrow-right">Warning</button>
					<button type="button" class="btn btn-danger btn-arrow-right">Danger</button>
				</div>

				<h4>Large Buttons</h4>
				<button type="button" class="btn btn-lg btn btn-default btn-arrow-left">Default</button>
				<button type="button" class="btn btn-lg btn-primary btn-arrow-left">Primary</button>
				<button type="button" class="btn btn-lg btn-success btn-arrow-left">Success</button>
				<button type="button" class="btn btn-lg btn-link">Link</button>
				<button type="button" class="btn btn-lg btn-info btn-arrow-right">Info</button>
				<button type="button" class="btn btn-lg btn-warning btn-arrow-right">Warning</button>
				<button type="button" class="btn btn-lg btn-danger btn-arrow-right">Danger</button>

				<h5>Inside .btn-group</h5>
				<div class='btn-group btn-group-lg'>
					<button type="button" class="btn btn-default btn-arrow-left">Default</button>
					<button type="button" class="btn btn-primary btn-arrow-left">Primary</button>
					<button type="button" class="btn btn-success btn-arrow-left">Success</button>
					<button type="button" class="btn btn-link">Link</button>
					<button type="button" class="btn btn-info btn-arrow-right">Info</button>
					<button type="button" class="btn btn-warning btn-arrow-right">Warning</button>
					<button type="button" class="btn btn-danger btn-arrow-right">Danger</button>
				</div>

				<h4>Small Buttons</h4>
				<button type="button" class="btn btn-sm btn btn-default btn-arrow-left">Default</button>
				<button type="button" class="btn btn-sm btn-primary btn-arrow-left">Primary</button>
				<button type="button" class="btn btn-sm btn-success btn-arrow-left">Success</button>
				<button type="button" class="btn btn-sm btn-link">Link</button>
				<button type="button" class="btn btn-sm btn-info btn-arrow-right">Info</button>
				<button type="button" class="btn btn-sm btn-warning btn-arrow-right">Warning</button>
				<button type="button" class="btn btn-sm btn-danger btn-arrow-right">Danger</button>

				<h5>Inside .btn-group</h5>
				<div class='btn-group btn-group-sm'>
					<button type="button" class="btn btn btn-default btn-arrow-left">Default</button>
					<button type="button" class="btn btn-primary btn-arrow-left">Primary</button>
					<button type="button" class="btn btn-success btn-arrow-left">Success</button>
					<button type="button" class="btn btn-link">Link</button>
					<button type="button" class="btn btn-info btn-arrow-right">Info</button>
					<button type="button" class="btn btn-warning btn-arrow-right">Warning</button>
					<button type="button" class="btn btn-danger btn-arrow-right">Danger</button>
				</div>

				<h4>Extra Small Buttons</h4>
				<button type="button" class="btn btn-xs btn btn-default btn-arrow-left">Default</button>
				<button type="button" class="btn btn-xs btn-primary btn-arrow-left">Primary</button>
				<button type="button" class="btn btn-xs btn-success btn-arrow-left">Success</button>
				<button type="button" class="btn btn-xs btn-link">Link</button>
				<button type="button" class="btn btn-xs btn-info btn-arrow-right">Info</button>
				<button type="button" class="btn btn-xs btn-warning btn-arrow-right">Warning</button>
				<button type="button" class="btn btn-xs btn-danger btn-arrow-right">Danger</button>

				<h5>Inside .btn-group</h5>
				<div class='btn-group btn-group-xs'>
					<button type="button" class="btn btn-default btn-arrow-left">Default</button>
					<button type="button" class="btn btn-primary btn-arrow-left">Primary</button>
					<button type="button" class="btn btn-success btn-arrow-left">Success</button>
					<button type="button" class="btn btn-link">Link</button>
					<button type="button" class="btn btn-info btn-arrow-right">Info</button>
					<button type="button" class="btn btn-warning btn-arrow-right">Warning</button>
					<button type="button" class="btn btn-danger btn-arrow-right">Danger</button>
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
