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

<h3>Buttons</h3>

<div class="row">
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Default Button</h5>
	<div class="toolbar">
	<button class="btn btn-default btn-sm" data-toggle="collapse" data-target="#div1">default</button>
	</div>
	</header>
	<div class="body collapse in" id="div1">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Line Button</h5>
	<div class="toolbar">
	<button class="btn btn-danger btn-sm btn-line" data-toggle="collapse" data-target="#div2">line</button>
	</div>
	</header>
	<div class="body collapse in" id="div2">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box warning">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Rectangle Button</h5>
	<div class="toolbar">
	<button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3">rectangle</button>
	</div>
	</header>
	<div class="body collapse in" id="div3">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Circle Button</h5>
	<div class="toolbar">
	<button class="btn btn-success btn-sm btn-circle" data-toggle="collapse" data-target="#div4">c</button>
	</div>
	</header>
	<div class="body collapse in" id="div4">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box success">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Rounded Button</h5>
	<div class="toolbar">
	<button class="btn btn-primary btn-sm btn-round" data-toggle="collapse" data-target="#div5">round</button>
	</div>
	</header>
	<div class="body collapse in" id="div5">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box inverse">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Flat Button</h5>
	<div class="toolbar">
	<button class="btn btn-info btn-sm btn-flat" data-toggle="collapse" data-target="#div6">flat</button>
	</div>
	</header>
	<div class="body collapse in" id="div6">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Gradient Button</h5>
	<div class="toolbar">
	<button class="btn btn-default btn-sm btn-grad" data-toggle="collapse" data-target="#div7">gradient</button>
	</div>
	</header>
	<div class="body collapse in" id="div7">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Gradient &amp; Rectangle Button</h5>
	<div class="toolbar">
	<button class="btn btn-default btn-sm btn-grad btn-rect" data-toggle="collapse" data-target="#div8">gradient &amp; rectangle</button>
	</div>
	</header>
	<div class="body collapse in" id="div8">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box primary">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Flat &amp; Rectangle Button</h5>
	<div class="toolbar">
	<button class="btn btn-info btn-sm btn-flat btn-rect" data-toggle="collapse" data-target="#div9">flat &amp; rectangle</button>
	</div>
	</header>
	<div class="body collapse in" id="div9">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Line &amp; Rectangle Button</h5>
	<div class="toolbar">
	<button class="btn btn-info btn-sm btn-line btn-rect" data-toggle="collapse" data-target="#div10">line &amp; rectangle</button>
	</div>
	</header>
	<div class="body collapse in" id="div10">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Circle &amp; Line Button</h5>
	<div class="toolbar">
	<button class="btn btn-success btn-sm btn-circle btn-line" data-toggle="collapse" data-target="#div11">c</button>
	</div>
	</header>
	<div class="body collapse in" id="div11">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box danger">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Circle &amp; Gradient Button</h5>
	<div class="toolbar">
	<button class="btn btn-success btn-sm btn-circle btn-grad" data-toggle="collapse" data-target="#div12">c</button>
	</div>
	</header>
	<div class="body collapse in" id="div12">
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
	</div>
	</div>
	<div class="col-lg-12">
	<div class="box inverse">
	<header>
	<div class="icons">
	<i class="fa fa-building-o"></i>
	</div>
	<h5>Rounded &amp; Line Button</h5>
	<div class="toolbar">
	<button class="btn btn-primary btn-sm btn-round btn-line" data-toggle="collapse" data-target="#div13">round &amp; line</button>
	</div>
	</header>
	<div class="body collapse in" id="div13">
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
	</div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
