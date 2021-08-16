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


<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#glyphicons" data-toggle="tab">Glyphicons</a></li>
				<li class=""><a href="#fontawesome" data-toggle="tab">Font Awesome</a></li>
				<li class=""><a href="#elegantfont" data-toggle="tab">Elegant Font</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="glyphicons">

				<ul class="the-icons clearfix">
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-asterisk"></i>&nbsp; glyphicon-asterisk
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-plus"></i>&nbsp; glyphicon-plus
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-euro"></i>&nbsp; glyphicon-euro
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-minus"></i>&nbsp; glyphicon-minus
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-cloud"></i>&nbsp; glyphicon-cloud
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-envelope"></i>&nbsp; glyphicon-envelope
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-pencil"></i>&nbsp; glyphicon-pencil
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-glass"></i>&nbsp; glyphicon-glass
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-music"></i>&nbsp; glyphicon-music
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-search"></i>&nbsp; glyphicon-search
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-heart"></i>&nbsp; glyphicon-heart
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-star"></i>&nbsp; glyphicon-star
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-star-empty"></i>&nbsp; glyphicon-star-empty
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-user"></i>&nbsp; glyphicon-user
				 </li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-film"></i>&nbsp; glyphicon-film
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-th-large"></i>&nbsp; glyphicon-th-large
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-th"></i>&nbsp; glyphicon-th
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-th-list"></i>&nbsp; glyphicon-th-list
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-ok"></i>&nbsp; glyphicon-ok
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-remove"></i>&nbsp; glyphicon-remove
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-zoom-in"></i>&nbsp; glyphicon-zoom-in
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-zoom-out"></i>&nbsp; glyphicon-zoom-out
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-off"></i>&nbsp; glyphicon-off
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-signal"></i>&nbsp; glyphicon-signal
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-cog"></i>&nbsp; glyphicon-cog
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-trash"></i>&nbsp; glyphicon-trash
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-home"></i>&nbsp; glyphicon-home
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-file"></i>&nbsp; glyphicon-file
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-time"></i>&nbsp; glyphicon-time
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-road"></i>&nbsp; glyphicon-road
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-download-alt"></i>&nbsp; glyphicon-download-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-download"></i>&nbsp; glyphicon-download
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-upload"></i>&nbsp; glyphicon-upload
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-inbox"></i>&nbsp; glyphicon-inbox
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-play-circle"></i>&nbsp; glyphicon-play-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-repeat"></i>&nbsp; glyphicon-repeat
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-refresh"></i>&nbsp; glyphicon-refresh
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-list-alt"></i>&nbsp; glyphicon-list-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-lock"></i>&nbsp; glyphicon-lock
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-flag"></i>&nbsp; glyphicon-flag
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-headphones"></i>&nbsp; glyphicon-headphones
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-volume-off"></i>&nbsp; glyphicon-volume-off
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-volume-down"></i>&nbsp; glyphicon-volume-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-volume-up"></i>&nbsp; glyphicon-volume-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-qrcode"></i>&nbsp; glyphicon-qrcode
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-barcode"></i>&nbsp; glyphicon-barcode
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tag"></i>&nbsp; glyphicon-tag
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tags"></i>&nbsp; glyphicon-tags
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-book"></i>&nbsp; glyphicon-book
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-bookmark"></i>&nbsp; glyphicon-bookmark
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-print"></i>&nbsp; glyphicon-print
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-camera"></i>&nbsp; glyphicon-camera
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-font"></i>&nbsp; glyphicon-font
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-bold"></i>&nbsp; glyphicon-bold
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-italic"></i>&nbsp; glyphicon-italic
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-text-height"></i>&nbsp; glyphicon-text-height
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-text-width"></i>&nbsp; glyphicon-text-width
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-align-left"></i>&nbsp; glyphicon-align-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-align-center"></i>&nbsp; glyphicon-align-center
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-align-right"></i>&nbsp; glyphicon-align-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-align-justify"></i>&nbsp; glyphicon-align-justify
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-list"></i>&nbsp; glyphicon-list
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-indent-left"></i>&nbsp; glyphicon-indent-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-indent-right"></i>&nbsp; glyphicon-indent-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-facetime-video"></i>&nbsp; glyphicon-facetime-video
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-picture"></i>&nbsp; glyphicon-picture
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-map-marker"></i>&nbsp; glyphicon-map-marker
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-adjust"></i>&nbsp; glyphicon-adjust
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tint"></i>&nbsp; glyphicon-tint
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-edit"></i>&nbsp; glyphicon-edit
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-share"></i>&nbsp; glyphicon-share
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-check"></i>&nbsp; glyphicon-check
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-move"></i>&nbsp; glyphicon-move
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-step-backward"></i>&nbsp; glyphicon-step-backward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-fast-backward"></i>&nbsp; glyphicon-fast-backward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-backward"></i>&nbsp; glyphicon-backward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-play"></i>&nbsp; glyphicon-play
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-pause"></i>&nbsp; glyphicon-pause
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-stop"></i>&nbsp; glyphicon-stop
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-forward"></i>&nbsp; glyphicon-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-fast-forward"></i>&nbsp; glyphicon-fast-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-step-forward"></i>&nbsp; glyphicon-step-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-eject"></i>&nbsp; glyphicon-eject
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-chevron-left"></i>&nbsp; glyphicon-chevron-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-chevron-right"></i>&nbsp; glyphicon-chevron-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-plus-sign"></i>&nbsp; glyphicon-plus-sign
				</li>
				 <li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-minus-sign"></i>&nbsp; glyphicon-minus-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-remove-sign"></i>&nbsp; glyphicon-remove-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-ok-sign"></i>&nbsp; glyphicon-ok-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-question-sign"></i>&nbsp; glyphicon-question-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-info-sign"></i>&nbsp; glyphicon-info-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-screenshot"></i>&nbsp; glyphicon-screenshot
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-remove-circle"></i>&nbsp; glyphicon-remove-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; glyphicon-ok-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; glyphicon-ban-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-arrow-left"></i>&nbsp; glyphicon-arrow-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-arrow-right"></i>&nbsp; glyphicon-arrow-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-arrow-up"></i>&nbsp; glyphicon-arrow-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-arrow-down"></i>&nbsp; glyphicon-arrow-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-share-alt"></i>&nbsp; glyphicon-share-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-resize-full"></i>&nbsp; glyphicon-resize-full
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-resize-small"></i>&nbsp; glyphicon-resize-small
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-exclamation-sign"></i>&nbsp; glyphicon-exclamation-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-gift"></i>&nbsp; glyphicon-gift
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-leaf"></i>&nbsp; glyphicon-leaf
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-fire"></i>&nbsp; glyphicon-fire
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-eye-open"></i>&nbsp; glyphicon-eye-open
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-eye-close"></i>&nbsp; glyphicon-eye-close
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-warning-sign"></i>&nbsp; glyphicon-warning-sign
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				 <i class="glyphicon glyphicon-plane"></i>&nbsp; glyphicon-plane
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-calendar"></i>&nbsp; glyphicon-calendar
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-random"></i>&nbsp; glyphicon-random
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-comment"></i>&nbsp; glyphicon-comment
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-magnet"></i>&nbsp; glyphicon-magnet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-chevron-up"></i>&nbsp; glyphicon-chevron-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-chevron-down"></i>&nbsp; glyphicon-chevron-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-retweet"></i>&nbsp; glyphicon-retweet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-shopping-cart"></i>&nbsp; glyphicon-shopping-cart
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-folder-close"></i>&nbsp; glyphicon-folder-close
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-folder-open"></i>&nbsp; glyphicon-folder-open
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-resize-vertical"></i>&nbsp; glyphicon-resize-vertical
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-resize-horizontal"></i>&nbsp; glyphicon-resize-horizontal
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-hdd"></i>&nbsp; glyphicon-hdd
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-bullhorn"></i>&nbsp; glyphicon-bullhorn
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-bell"></i>&nbsp; glyphicon-bell
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-certificate"></i>&nbsp; glyphicon-certificate
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-thumbs-up"></i>&nbsp; glyphicon-thumbs-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-thumbs-down"></i>&nbsp; glyphicon-thumbs-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-hand-right"></i>&nbsp; glyphicon-hand-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-hand-left"></i>&nbsp; glyphicon-hand-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-hand-up"></i>&nbsp; glyphicon-hand-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-hand-down"></i>&nbsp; glyphicon-hand-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-circle-arrow-right"></i>&nbsp; glyphicon-circle-arrow-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-circle-arrow-left"></i>&nbsp; glyphicon-circle-arrow-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-circle-arrow-up"></i>&nbsp; glyphicon-circle-arrow-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-circle-arrow-down"></i>&nbsp; glyphicon-circle-arrow-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-globe"></i>&nbsp; glyphicon-globe
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-wrench"></i>&nbsp; glyphicon-wrench
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tasks"></i>&nbsp; glyphicon-tasks
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-filter"></i>&nbsp; glyphicon-filter
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-briefcase"></i>&nbsp; glyphicon-briefcase
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-fullscreen"></i>&nbsp; glyphicon-fullscreen
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-dashboard"></i>&nbsp; glyphicon-dashboard
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-paperclip"></i>&nbsp; glyphicon-paperclip
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-heart-empty"></i>&nbsp; glyphicon-heart-empty
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-link"></i>&nbsp; glyphicon-link
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-phone"></i>&nbsp; glyphicon-phone
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-pushpin"></i>&nbsp; glyphicon-pushpin
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-usd"></i>&nbsp; glyphicon-usd
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-gbp"></i>&nbsp; glyphicon-gbp
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort"></i>&nbsp; glyphicon-sort
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort-by-alphabet"></i>&nbsp; glyphicon-sort-by-alphabet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>&nbsp; glyphicon-sort-by-alphabet-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort-by-order"></i>&nbsp; glyphicon-sort-by-order
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort-by-order-alt"></i>&nbsp; glyphicon-sort-by-order-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort-by-attributes"></i>&nbsp; glyphicon-sort-by-attributes
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sort-by-attributes-alt"></i>&nbsp; glyphicon-sort-by-attributes-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-unchecked"></i>&nbsp; glyphicon-unchecked
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-expand"></i>&nbsp; glyphicon-expand
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-collapse-down"></i>&nbsp; glyphicon-collapse-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-collapse-up"></i>&nbsp; glyphicon-collapse-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-log-in"></i>&nbsp; glyphicon-log-in
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-flash"></i>&nbsp; glyphicon-flash
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-log-out"></i>&nbsp; glyphicon-log-out
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-new-window"></i>&nbsp; glyphicon-new-window
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-record"></i>&nbsp; glyphicon-record
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-save"></i>&nbsp; glyphicon-save
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-open"></i>&nbsp; glyphicon-open
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-saved"></i>&nbsp; glyphicon-saved
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-import"></i>&nbsp; glyphicon-import
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-export"></i>&nbsp; glyphicon-export
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-send"></i>&nbsp; glyphicon-send
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-floppy-disk"></i>&nbsp; glyphicon-floppy-disk
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-floppy-saved"></i>&nbsp; glyphicon-floppy-saved
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-floppy-remove"></i>&nbsp; glyphicon-floppy-remove
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-floppy-save"></i>&nbsp; glyphicon-floppy-save
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-floppy-open"></i>&nbsp; glyphicon-floppy-open
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-credit-card"></i>&nbsp; glyphicon-credit-card
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-transfer"></i>&nbsp; glyphicon-transfer
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-cutlery"></i>&nbsp; glyphicon-cutlery
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-header"></i>&nbsp; glyphicon-header
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-compressed"></i>&nbsp; glyphicon-compressed
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-earphone"></i>&nbsp; glyphicon-earphone
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-phone-alt"></i>&nbsp; glyphicon-phone-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tower"></i>&nbsp; glyphicon-tower
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-stats"></i>&nbsp; glyphicon-stats
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sd-video"></i>&nbsp; glyphicon-sd-video
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-hd-video"></i>&nbsp; glyphicon-hd-video
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-subtitles"></i>&nbsp; glyphicon-subtitles
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sound-stereo"></i>&nbsp; glyphicon-sound-stereo
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sound-dolby"></i>&nbsp; glyphicon-sound-dolby
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sound-5-1"></i>&nbsp; glyphicon-sound-5-1
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sound-6-1"></i>&nbsp; glyphicon-sound-6-1
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-sound-7-1"></i>&nbsp; glyphicon-sound-7-1
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-copyright-mark"></i>&nbsp; glyphicon-copyright-mark
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-registration-mark"></i>&nbsp; glyphicon-registration-mark
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-cloud-download"></i>&nbsp; glyphicon-cloud-download
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-cloud-upload"></i>&nbsp; glyphicon-cloud-upload
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tree-conifer"></i>&nbsp; glyphicon-tree-conifer
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="glyphicon glyphicon-tree-deciduous"></i>&nbsp; glyphicon-tree-deciduous
				</li>
				</ul>


			</div>
			
			<div class="tab-pane fade" id="fontawesome">
				<ul class="the-icons clearfix">
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-adjust"></i>&nbsp; fa fa-adjust
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-adn"></i>&nbsp; fa fa-adn
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-align-center"></i>&nbsp; fa fa-align-center
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-align-justify"></i>&nbsp; fa fa-align-justify
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-align-left"></i>&nbsp; fa fa-align-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-align-right"></i>&nbsp; fa fa-align-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ambulance"></i>&nbsp; fa fa-ambulance
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-anchor"></i>&nbsp; fa fa-anchor
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-android"></i>&nbsp; fa fa-android
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-double-down"></i>&nbsp; fa fa-angle-double-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-double-left"></i>&nbsp; fa fa-angle-double-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-double-right"></i>&nbsp; fa fa-angle-double-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-double-up"></i>&nbsp; fa fa-angle-double-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-down"></i>&nbsp; fa fa-angle-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-left"></i>&nbsp; fa fa-angle-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-right"></i>&nbsp; fa fa-angle-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-angle-up"></i>&nbsp; fa fa-angle-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-apple"></i>&nbsp; fa fa-apple
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-archive"></i>&nbsp; fa fa-archive
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-down"></i>&nbsp; fa fa-arrow-circle-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-left"></i>&nbsp; fa fa-arrow-circle-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-o-down"></i>&nbsp; fa fa-arrow-circle-o-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-o-left"></i>&nbsp; fa fa-arrow-circle-o-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-o-right"></i>&nbsp; fa fa-arrow-circle-o-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-o-up"></i>&nbsp; fa fa-arrow-circle-o-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-right"></i>&nbsp; fa fa-arrow-circle-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-circle-up"></i>&nbsp; fa fa-arrow-circle-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-down"></i>&nbsp; fa fa-arrow-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-left"></i>&nbsp; fa fa-arrow-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-right"></i>&nbsp; fa fa-arrow-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrow-up"></i>&nbsp; fa fa-arrow-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrows"></i>&nbsp; fa fa-arrows
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrows-alt"></i>&nbsp; fa fa-arrows-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrows-h"></i>&nbsp; fa fa-arrows-h
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-arrows-v"></i>&nbsp; fa fa-arrows-v
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-asterisk"></i>&nbsp; fa fa-asterisk
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-automobile"></i>&nbsp; fa fa-automobile
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-backward"></i>&nbsp; fa fa-backward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ban"></i>&nbsp; fa fa-ban
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bank"></i>&nbsp; fa fa-bank
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bar-chart-o"></i>&nbsp; fa fa-bar-chart-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-barcode"></i>&nbsp; fa fa-barcode
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bars"></i>&nbsp; fa fa-bars
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-beer"></i>&nbsp; fa fa-beer
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-behance"></i>&nbsp; fa fa-behance
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-behance-square"></i>&nbsp; fa fa-behance-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bell"></i>&nbsp; fa fa-bell
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bell-o"></i>&nbsp; fa fa-bell-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bitbucket"></i>&nbsp; fa fa-bitbucket
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bitbucket-square"></i>&nbsp; fa fa-bitbucket-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bitcoin"></i>&nbsp; fa fa-bitcoin
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bold"></i>&nbsp; fa fa-bold
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bolt"></i>&nbsp; fa fa-bolt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bomb"></i>&nbsp; fa fa-bomb
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-book"></i>&nbsp; fa fa-book
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bookmark"></i>&nbsp; fa fa-bookmark
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bookmark-o"></i>&nbsp; fa fa-bookmark-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-briefcase"></i>&nbsp; fa fa-briefcase
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-btc"></i>&nbsp; fa fa-btc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bug"></i>&nbsp; fa fa-bug
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-building"></i>&nbsp; fa fa-building
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-building-o"></i>&nbsp; fa fa-building-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bullhorn"></i>&nbsp; fa fa-bullhorn
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-bullseye"></i>&nbsp; fa fa-bullseye
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cab"></i>&nbsp; fa fa-cab
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-calendar"></i>&nbsp; fa fa-calendar
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-calendar-o"></i>&nbsp; fa fa-calendar-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-camera"></i>&nbsp; fa fa-camera
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-camera-retro"></i>&nbsp; fa fa-camera-retro
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-car"></i>&nbsp; fa fa-car
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-down"></i>&nbsp; fa fa-caret-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-left"></i>&nbsp; fa fa-caret-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-right"></i>&nbsp; fa fa-caret-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-square-o-down"></i>&nbsp; fa fa-caret-square-o-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-square-o-left"></i>&nbsp; fa fa-caret-square-o-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-square-o-right"></i>&nbsp; fa fa-caret-square-o-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-square-o-up"></i>&nbsp; fa fa-caret-square-o-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-caret-up"></i>&nbsp; fa fa-caret-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-certificate"></i>&nbsp; fa fa-certificate
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chain"></i>&nbsp; fa fa-chain
				</li>
				 <li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chain-broken"></i>&nbsp; fa fa-chain-broken
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-check"></i>&nbsp; fa fa-check
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-check-circle"></i>&nbsp; fa fa-check-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-check-circle-o"></i>&nbsp; fa fa-check-circle-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-check-square"></i>&nbsp; fa fa-check-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-check-square-o"></i>&nbsp; fa fa-check-square-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-circle-down"></i>&nbsp; fa fa-chevron-circle-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-circle-left"></i>&nbsp; fa fa-chevron-circle-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-circle-right"></i>&nbsp; fa fa-chevron-circle-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-circle-up"></i>&nbsp; fa fa-chevron-circle-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-down"></i>&nbsp; fa fa-chevron-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-left"></i>&nbsp; fa fa-chevron-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-right"></i>&nbsp; fa fa-chevron-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-chevron-up"></i>&nbsp; fa fa-chevron-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-child"></i>&nbsp; fa fa-child
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-circle"></i>&nbsp; fa fa-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-circle-o"></i>&nbsp; fa fa-circle-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-circle-o-notch"></i>&nbsp; fa fa-circle-o-notch
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-circle-thin"></i>&nbsp; fa fa-circle-thin
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-clipboard"></i>&nbsp; fa fa-clipboard
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-clock-o"></i>&nbsp; fa fa-clock-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cloud"></i>&nbsp; fa fa-cloud
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cloud-download"></i>&nbsp; fa fa-cloud-download
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cloud-upload"></i>&nbsp; fa fa-cloud-upload
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cny"></i>&nbsp; fa fa-cny
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-code"></i>&nbsp; fa fa-code
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-code-fork"></i>&nbsp; fa fa-code-fork
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-codepen"></i>&nbsp; fa fa-codepen
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-coffee"></i>&nbsp; fa fa-coffee
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cog"></i>&nbsp; fa fa-cog
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cogs"></i>&nbsp; fa fa-cogs
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-columns"></i>&nbsp; fa fa-columns
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-comment"></i>&nbsp; fa fa-comment
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-comment-o"></i>&nbsp; fa fa-comment-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-comments"></i>&nbsp; fa fa-comments
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-comments-o"></i>&nbsp; fa fa-comments-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-compass"></i>&nbsp; fa fa-compass
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-compress"></i>&nbsp; fa fa-compress
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-copy"></i>&nbsp; fa fa-copy
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-credit-card"></i>&nbsp; fa fa-credit-card
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-crop"></i>&nbsp; fa fa-crop
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-crosshairs"></i>&nbsp; fa fa-crosshairs
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-css3"></i>&nbsp; fa fa-css3
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cube"></i>&nbsp; fa fa-cube
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cubes"></i>&nbsp; fa fa-cubes
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cut"></i>&nbsp; fa fa-cut
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-cutlery"></i>&nbsp; fa fa-cutlery
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-dashboard"></i>&nbsp; fa fa-dashboard
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-database"></i>&nbsp; fa fa-database
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-dedent"></i>&nbsp; fa fa-dedent
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-delicious"></i>&nbsp; fa fa-delicious
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-desktop"></i>&nbsp; fa fa-desktop
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-deviantart"></i>&nbsp; fa fa-deviantart
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-digg"></i>&nbsp; fa fa-digg
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-dollar"></i>&nbsp; fa fa-dollar
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-dot-circle-o"></i>&nbsp; fa fa-dot-circle-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-download"></i>&nbsp; fa fa-download
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-dribbble"></i>&nbsp; fa fa-dribbble
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-dropbox"></i>&nbsp; fa fa-dropbox
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-drupal"></i>&nbsp; fa fa-drupal
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-edit"></i>&nbsp; fa fa-edit
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-eject"></i>&nbsp; fa fa-eject
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ellipsis-h"></i>&nbsp; fa fa-ellipsis-h
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ellipsis-v"></i>&nbsp; fa fa-ellipsis-v
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-empire"></i>&nbsp; fa fa-empire
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-envelope"></i>&nbsp; fa fa-envelope
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-envelope-o"></i>&nbsp; fa fa-envelope-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-envelope-square"></i>&nbsp; fa fa-envelope-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-eraser"></i>&nbsp; fa fa-eraser
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-eur"></i>&nbsp; fa fa-eur
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-euro"></i>&nbsp; fa fa-euro
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-exchange"></i>&nbsp; fa fa-exchange
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-exclamation"></i>&nbsp; fa fa-exclamation
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-exclamation-circle"></i>&nbsp; fa fa-exclamation-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-exclamation-triangle"></i>&nbsp; fa fa-exclamation-triangle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-expand"></i>&nbsp; fa fa-expand
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-external-link"></i>&nbsp; fa fa-external-link
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-external-link-square"></i>&nbsp; fa fa-external-link-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-eye"></i>&nbsp; fa fa-eye
				 </li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-eye-slash"></i>&nbsp; fa fa-eye-slash
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-facebook"></i>&nbsp; fa fa-facebook
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-facebook-square"></i>&nbsp; fa fa-facebook-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-fast-backward"></i>&nbsp; fa fa-fast-backward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-fast-forward"></i>&nbsp; fa fa-fast-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-fax"></i>&nbsp; fa fa-fax
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-female"></i>&nbsp; fa fa-female
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-fighter-jet"></i>&nbsp; fa fa-fighter-jet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file"></i>&nbsp; fa fa-file
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-archive-o"></i>&nbsp; fa fa-file-archive-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-audio-o"></i>&nbsp; fa fa-file-audio-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-code-o"></i>&nbsp; fa fa-file-code-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-excel-o"></i>&nbsp; fa fa-file-excel-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-image-o"></i>&nbsp; fa fa-file-image-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-movie-o"></i>&nbsp; fa fa-file-movie-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-o"></i>&nbsp; fa fa-file-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-pdf-o"></i>&nbsp; fa fa-file-pdf-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-photo-o"></i>&nbsp; fa fa-file-photo-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-picture-o"></i>&nbsp; fa fa-file-picture-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-powerpoint-o"></i>&nbsp; fa fa-file-powerpoint-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-sound-o"></i>&nbsp; fa fa-file-sound-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-text"></i>&nbsp; fa fa-file-text
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-text-o"></i>&nbsp; fa fa-file-text-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-video-o"></i>&nbsp; fa fa-file-video-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-word-o"></i>&nbsp; fa fa-file-word-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-file-zip-o"></i>&nbsp; fa fa-file-zip-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-files-o"></i>&nbsp; fa fa-files-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-film"></i>&nbsp; fa fa-film
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-filter"></i>&nbsp; fa fa-filter
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-fire"></i>&nbsp; fa fa-fire
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-fire-extinguisher"></i>&nbsp; fa fa-fire-extinguisher
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-flag"></i>&nbsp; fa fa-flag
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-flag-checkered"></i>&nbsp; fa fa-flag-checkered
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-flag-o"></i>&nbsp; fa fa-flag-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-flash"></i>&nbsp; fa fa-flash
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-flask"></i>&nbsp; fa fa-flask
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-flickr"></i>&nbsp; fa fa-flickr
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-floppy-o"></i>&nbsp; fa fa-floppy-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-folder"></i>&nbsp; fa fa-folder
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-folder-o"></i>&nbsp; fa fa-folder-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-folder-open"></i>&nbsp; fa fa-folder-open
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-folder-open-o"></i>&nbsp; fa fa-folder-open-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-font"></i>&nbsp; fa fa-font
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-forward"></i>&nbsp; fa fa-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-foursquare"></i>&nbsp; fa fa-foursquare
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-frown-o"></i>&nbsp; fa fa-frown-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gamepad"></i>&nbsp; fa fa-gamepad
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gavel"></i>&nbsp; fa fa-gavel
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gbp"></i>&nbsp; fa fa-gbp
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ge"></i>&nbsp; fa fa-ge
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gear"></i>&nbsp; fa fa-gear
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gears"></i>&nbsp; fa fa-gears
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gift"></i>&nbsp; fa fa-gift
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-git"></i>&nbsp; fa fa-git
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-git-square"></i>&nbsp; fa fa-git-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-github"></i>&nbsp; fa fa-github
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-github-alt"></i>&nbsp; fa fa-github-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-github-square"></i>&nbsp; fa fa-github-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-gittip"></i>&nbsp; fa fa-gittip
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-glass"></i>&nbsp; fa fa-glass
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-globe"></i>&nbsp; fa fa-globe
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-google"></i>&nbsp; fa fa-google
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-google-plus"></i>&nbsp; fa fa-google-plus
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-google-plus-square"></i>&nbsp; fa fa-google-plus-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-graduation-cap"></i>&nbsp; fa fa-graduation-cap
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-group"></i>&nbsp; fa fa-group
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-h-square"></i>&nbsp; fa fa-h-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hacker-news"></i>&nbsp; fa fa-hacker-news
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hand-o-down"></i>&nbsp; fa fa-hand-o-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hand-o-left"></i>&nbsp; fa fa-hand-o-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hand-o-right"></i>&nbsp; fa fa-hand-o-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hand-o-up"></i>&nbsp; fa fa-hand-o-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hdd-o"></i>&nbsp; fa fa-hdd-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-header"></i>&nbsp; fa fa-header
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-headphones"></i>&nbsp; fa fa-headphones
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-heart"></i>&nbsp; fa fa-heart
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-heart-o"></i>&nbsp; fa fa-heart-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-history"></i>&nbsp; fa fa-history
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-home"></i>&nbsp; fa fa-home
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-hospital-o"></i>&nbsp; fa fa-hospital-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-html5"></i>&nbsp; fa fa-html5
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-image"></i>&nbsp; fa fa-image
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-inbox"></i>&nbsp; fa fa-inbox
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-indent"></i>&nbsp; fa fa-indent
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-info"></i>&nbsp; fa fa-info
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-info-circle"></i>&nbsp; fa fa-info-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-inr"></i>&nbsp; fa fa-inr
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-instagram"></i>&nbsp; fa fa-instagram
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-institution"></i>&nbsp; fa fa-institution
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-italic"></i>&nbsp; fa fa-italic
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-joomla"></i>&nbsp; fa fa-joomla
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-jpy"></i>&nbsp; fa fa-jpy
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-jsfiddle"></i>&nbsp; fa fa-jsfiddle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-key"></i>&nbsp; fa fa-key
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-keyboard-o"></i>&nbsp; fa fa-keyboard-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-krw"></i>&nbsp; fa fa-krw
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-language"></i>&nbsp; fa fa-language
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-laptop"></i>&nbsp; fa fa-laptop
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-leaf"></i>&nbsp; fa fa-leaf
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-legal"></i>&nbsp; fa fa-legal
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-lemon-o"></i>&nbsp; fa fa-lemon-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-level-down"></i>&nbsp; fa fa-level-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-level-up"></i>&nbsp; fa fa-level-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-life-bouy"></i>&nbsp; fa fa-life-bouy
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-life-ring"></i>&nbsp; fa fa-life-ring
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-life-saver"></i>&nbsp; fa fa-life-saver
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-lightbulb-o"></i>&nbsp; fa fa-lightbulb-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-link"></i>&nbsp; fa fa-link
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-linkedin"></i>&nbsp; fa fa-linkedin
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-linkedin-square"></i>&nbsp; fa fa-linkedin-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-linux"></i>&nbsp; fa fa-linux
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-list"></i>&nbsp; fa fa-list
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-list-alt"></i>&nbsp; fa fa-list-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-list-ol"></i>&nbsp; fa fa-list-ol
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-list-ul"></i>&nbsp; fa fa-list-ul
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-location-arrow"></i>&nbsp; fa fa-location-arrow
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-lock"></i>&nbsp; fa fa-lock
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-long-arrow-down"></i>&nbsp; fa fa-long-arrow-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-long-arrow-left"></i>&nbsp; fa fa-long-arrow-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-long-arrow-right"></i>&nbsp; fa fa-long-arrow-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-long-arrow-up"></i>&nbsp; fa fa-long-arrow-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-magic"></i>&nbsp; fa fa-magic
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-magnet"></i>&nbsp; fa fa-magnet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-mail-forward"></i>&nbsp; fa fa-mail-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-mail-reply"></i>&nbsp; fa fa-mail-reply
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-mail-reply-all"></i>&nbsp; fa fa-mail-reply-all
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-male"></i>&nbsp; fa fa-male
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-map-marker"></i>&nbsp; fa fa-map-marker
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-maxcdn"></i>&nbsp; fa fa-maxcdn
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-medkit"></i>&nbsp; fa fa-medkit
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-meh-o"></i>&nbsp; fa fa-meh-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-microphone"></i>&nbsp; fa fa-microphone
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				 <i class="fa fa-microphone-slash"></i>&nbsp; fa fa-microphone-slash
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-minus"></i>&nbsp; fa fa-minus
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-minus-circle"></i>&nbsp; fa fa-minus-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-minus-square"></i>&nbsp; fa fa-minus-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-minus-square-o"></i>&nbsp; fa fa-minus-square-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-mobile"></i>&nbsp; fa fa-mobile
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-mobile-phone"></i>&nbsp; fa fa-mobile-phone
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-money"></i>&nbsp; fa fa-money
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-moon-o"></i>&nbsp; fa fa-moon-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-mortar-board"></i>&nbsp; fa fa-mortar-board
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-music"></i>&nbsp; fa fa-music
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-navicon"></i>&nbsp; fa fa-navicon
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-openid"></i>&nbsp; fa fa-openid
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-outdent"></i>&nbsp; fa fa-outdent
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pagelines"></i>&nbsp; fa fa-pagelines
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-paper-plane"></i>&nbsp; fa fa-paper-plane
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-paper-plane-o"></i>&nbsp; fa fa-paper-plane-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-paperclip"></i>&nbsp; fa fa-paperclip
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-paragraph"></i>&nbsp; fa fa-paragraph
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-paste"></i>&nbsp; fa fa-paste
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pause"></i>&nbsp; fa fa-pause
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-paw"></i>&nbsp; fa fa-paw
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pencil"></i>&nbsp; fa fa-pencil
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pencil-square"></i>&nbsp; fa fa-pencil-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pencil-square-o"></i>&nbsp; fa fa-pencil-square-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-phone"></i>&nbsp; fa fa-phone
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-phone-square"></i>&nbsp; fa fa-phone-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-photo"></i>&nbsp; fa fa-photo
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-picture-o"></i>&nbsp; fa fa-picture-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pied-piper"></i>&nbsp; fa fa-pied-piper
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pied-piper-alt"></i>&nbsp; fa fa-pied-piper-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pied-piper-square"></i>&nbsp; fa fa-pied-piper-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pinterest"></i>&nbsp; fa fa-pinterest
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-pinterest-square"></i>&nbsp; fa fa-pinterest-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-plane"></i>&nbsp; fa fa-plane
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-play"></i>&nbsp; fa fa-play
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-play-circle"></i>&nbsp; fa fa-play-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-play-circle-o"></i>&nbsp; fa fa-play-circle-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-plus"></i>&nbsp; fa fa-plus
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-plus-circle"></i>&nbsp; fa fa-plus-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-plus-square"></i>&nbsp; fa fa-plus-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-plus-square-o"></i>&nbsp; fa fa-plus-square-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-power-off"></i>&nbsp; fa fa-power-off
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-print"></i>&nbsp; fa fa-print
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-puzzle-piece"></i>&nbsp; fa fa-puzzle-piece
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-qq"></i>&nbsp; fa fa-qq
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-qrcode"></i>&nbsp; fa fa-qrcode
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-question"></i>&nbsp; fa fa-question
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-question-circle"></i>&nbsp; fa fa-question-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-quote-left"></i>&nbsp; fa fa-quote-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-quote-right"></i>&nbsp; fa fa-quote-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ra"></i>&nbsp; fa fa-ra
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-random"></i>&nbsp; fa fa-random
				 </li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rebel"></i>&nbsp; fa fa-rebel
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-recycle"></i>&nbsp; fa fa-recycle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-reddit"></i>&nbsp; fa fa-reddit
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-reddit-square"></i>&nbsp; fa fa-reddit-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-refresh"></i>&nbsp; fa fa-refresh
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-renren"></i>&nbsp; fa fa-renren
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-reorder"></i>&nbsp; fa fa-reorder
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-repeat"></i>&nbsp; fa fa-repeat
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-reply"></i>&nbsp; fa fa-reply
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-reply-all"></i>&nbsp; fa fa-reply-all
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-retweet"></i>&nbsp; fa fa-retweet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rmb"></i>&nbsp; fa fa-rmb
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-road"></i>&nbsp; fa fa-road
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rocket"></i>&nbsp; fa fa-rocket
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rotate-left"></i>&nbsp; fa fa-rotate-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rotate-right"></i>&nbsp; fa fa-rotate-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rouble"></i>&nbsp; fa fa-rouble
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rss"></i>&nbsp; fa fa-rss
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rss-square"></i>&nbsp; fa fa-rss-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rub"></i>&nbsp; fa fa-rub
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ruble"></i>&nbsp; fa fa-ruble
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-rupee"></i>&nbsp; fa fa-rupee
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-save"></i>&nbsp; fa fa-save
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-scissors"></i>&nbsp; fa fa-scissors
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-search"></i>&nbsp; fa fa-search
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-search-minus"></i>&nbsp; fa fa-search-minus
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-search-plus"></i>&nbsp; fa fa-search-plus
				 </li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-send"></i>&nbsp; fa fa-send
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-send-o"></i>&nbsp; fa fa-send-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-share"></i>&nbsp; fa fa-share
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-share-alt"></i>&nbsp; fa fa-share-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-share-alt-square"></i>&nbsp; fa fa-share-alt-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-share-square"></i>&nbsp; fa fa-share-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-share-square-o"></i>&nbsp; fa fa-share-square-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-shield"></i>&nbsp; fa fa-shield
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-shopping-cart"></i>&nbsp; fa fa-shopping-cart
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sign-in"></i>&nbsp; fa fa-sign-in
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sign-out"></i>&nbsp; fa fa-sign-out
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-signal"></i>&nbsp; fa fa-signal
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sitemap"></i>&nbsp; fa fa-sitemap
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-skype"></i>&nbsp; fa fa-skype
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-slack"></i>&nbsp; fa fa-slack
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sliders"></i>&nbsp; fa fa-sliders
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-smile-o"></i>&nbsp; fa fa-smile-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort"></i>&nbsp; fa fa-sort
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-alpha-asc"></i>&nbsp; fa fa-sort-alpha-asc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-alpha-desc"></i>&nbsp; fa fa-sort-alpha-desc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-amount-asc"></i>&nbsp; fa fa-sort-amount-asc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-amount-desc"></i>&nbsp; fa fa-sort-amount-desc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-asc"></i>&nbsp; fa fa-sort-asc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-desc"></i>&nbsp; fa fa-sort-desc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-down"></i>&nbsp; fa fa-sort-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-numeric-asc"></i>&nbsp; fa fa-sort-numeric-asc
				</li>
				 <li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-numeric-desc"></i>&nbsp; fa fa-sort-numeric-desc
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sort-up"></i>&nbsp; fa fa-sort-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-soundcloud"></i>&nbsp; fa fa-soundcloud
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-space-shuttle"></i>&nbsp; fa fa-space-shuttle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-spinner"></i>&nbsp; fa fa-spinner
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-spoon"></i>&nbsp; fa fa-spoon
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-spotify"></i>&nbsp; fa fa-spotify
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-square"></i>&nbsp; fa fa-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-square-o"></i>&nbsp; fa fa-square-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-stack-exchange"></i>&nbsp; fa fa-stack-exchange
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-stack-overflow"></i>&nbsp; fa fa-stack-overflow
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-star"></i>&nbsp; fa fa-star
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-star-half"></i>&nbsp; fa fa-star-half
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-star-half-empty"></i>&nbsp; fa fa-star-half-empty
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-star-half-full"></i>&nbsp; fa fa-star-half-full
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-star-half-o"></i>&nbsp; fa fa-star-half-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-star-o"></i>&nbsp; fa fa-star-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-steam"></i>&nbsp; fa fa-steam
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-steam-square"></i>&nbsp; fa fa-steam-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-step-backward"></i>&nbsp; fa fa-step-backward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-step-forward"></i>&nbsp; fa fa-step-forward
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-stethoscope"></i>&nbsp; fa fa-stethoscope
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-stop"></i>&nbsp; fa fa-stop
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-strikethrough"></i>&nbsp; fa fa-strikethrough
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-stumbleupon"></i>&nbsp; fa fa-stumbleupon
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-stumbleupon-circle"></i>&nbsp; fa fa-stumbleupon-circle
				 </li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-subscript"></i>&nbsp; fa fa-subscript
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-suitcase"></i>&nbsp; fa fa-suitcase
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-sun-o"></i>&nbsp; fa fa-sun-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-superscript"></i>&nbsp; fa fa-superscript
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-support"></i>&nbsp; fa fa-support
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-table"></i>&nbsp; fa fa-table
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tablet"></i>&nbsp; fa fa-tablet
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tachometer"></i>&nbsp; fa fa-tachometer
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tag"></i>&nbsp; fa fa-tag
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tags"></i>&nbsp; fa fa-tags
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tasks"></i>&nbsp; fa fa-tasks
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-truck"></i>&nbsp; fa fa-truck
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-try"></i>&nbsp; fa fa-try
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tumblr"></i>&nbsp; fa fa-tumblr
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tumblr-square"></i>&nbsp; fa fa-tumblr-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-turkish-lira"></i>&nbsp; fa fa-turkish-lira
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-twitter"></i>&nbsp; fa fa-twitter
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-twitter-square"></i>&nbsp; fa fa-twitter-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-umbrella"></i>&nbsp; fa fa-umbrella
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-underline"></i>&nbsp; fa fa-underline
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-undo"></i>&nbsp; fa fa-undo
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-university"></i>&nbsp; fa fa-university
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-unlink"></i>&nbsp; fa fa-unlink
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-unlock"></i>&nbsp; fa fa-unlock
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-unlock-alt"></i>&nbsp; fa fa-unlock-alt
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-unsorted"></i>&nbsp; fa fa-unsorted
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-upload"></i>&nbsp; fa fa-upload
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-usd"></i>&nbsp; fa fa-usd
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-user"></i>&nbsp; fa fa-user
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-user-md"></i>&nbsp; fa fa-user-md
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-users"></i>&nbsp; fa fa-users
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-video-camera"></i>&nbsp; fa fa-video-camera
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-vimeo-square"></i>&nbsp; fa fa-vimeo-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-vine"></i>&nbsp; fa fa-vine
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-vk"></i>&nbsp; fa fa-vk
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-volume-down"></i>&nbsp; fa fa-volume-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-volume-off"></i>&nbsp; fa fa-volume-off
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-volume-up"></i>&nbsp; fa fa-volume-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-warning"></i>&nbsp; fa fa-warning
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-wechat"></i>&nbsp; fa fa-wechat
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-weibo"></i>&nbsp; fa fa-weibo
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-weixin"></i>&nbsp; fa fa-weixin
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-wheelchair"></i>&nbsp; fa fa-wheelchair
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-windows"></i>&nbsp; fa fa-windows
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-won"></i>&nbsp; fa fa-won
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-wordpress"></i>&nbsp; fa fa-wordpress
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-wrench"></i>&nbsp; fa fa-wrench
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-xing"></i>&nbsp; fa fa-xing
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-xing-square"></i>&nbsp; fa fa-xing-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-yahoo"></i>&nbsp; fa fa-yahoo
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-yen"></i>&nbsp; fa fa-yen
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-youtube"></i>&nbsp; fa fa-youtube
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-youtube-play"></i>&nbsp; fa fa-youtube-play
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-youtube-square"></i>&nbsp; fa fa-youtube-square
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-taxi"></i>&nbsp; fa fa-taxi
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tencent-weibo"></i>&nbsp; fa fa-tencent-weibo
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-terminal"></i>&nbsp; fa fa-terminal
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-text-height"></i>&nbsp; fa fa-text-height
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-text-width"></i>&nbsp; fa fa-text-width
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-th"></i>&nbsp; fa fa-th
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-th-large"></i>&nbsp; fa fa-th-large
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-th-list"></i>&nbsp; fa fa-th-list
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-thumb-tack"></i>&nbsp; fa fa-thumb-tack
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-thumbs-down"></i>&nbsp; fa fa-thumbs-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-thumbs-o-down"></i>&nbsp; fa fa-thumbs-o-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-thumbs-o-up"></i>&nbsp; fa fa-thumbs-o-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-thumbs-up"></i>&nbsp; fa fa-thumbs-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-ticket"></i>&nbsp; fa fa-ticket
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-times"></i>&nbsp; fa fa-times
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-times-circle"></i>&nbsp; fa fa-times-circle
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-times-circle-o"></i>&nbsp; fa fa-times-circle-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tint"></i>&nbsp; fa fa-tint
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-toggle-down"></i>&nbsp; fa fa-toggle-down
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-toggle-left"></i>&nbsp; fa fa-toggle-left
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-toggle-right"></i>&nbsp; fa fa-toggle-right
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-toggle-up"></i>&nbsp; fa fa-toggle-up
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-trash-o"></i>&nbsp; fa fa-trash-o
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-tree"></i>&nbsp; fa fa-tree
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-trello"></i>&nbsp; fa fa-trello
				</li>
				<li class="col-sm-6 col-md-4 col-lg-3">
				<i class="fa fa-trophy"></i>&nbsp; fa fa-trophy
				 </li>
				</ul>


			</div>
			
			<div class="tab-pane fade" id="elegantfont">
				<div class="mtm clearfix" id="glyphs">
					<div class="glyph">
							<div class="fs1" aria-hidden="true" data-icon="!"></div>
							<input type="text" readonly="" value="&amp;#x21;">
					</div>
					<div class="glyph">
							<div class="fs1" aria-hidden="true" data-icon="&quot;"></div>
							<input type="text" readonly="" value="&amp;#x22;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="#"></div>
						<input type="text" readonly="" value="&amp;#x23;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="$"></div>
						<input type="text" readonly="" value="&amp;#x24;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="%"></div>
						<input type="text" readonly="" value="&amp;#x25;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="&amp;"></div>
						<input type="text" readonly="" value="&amp;#x26;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="'"></div>
						<input type="text" readonly="" value="&amp;#x27;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="("></div>
						<input type="text" readonly="" value="&amp;#x28;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=")"></div>
						<input type="text" readonly="" value="&amp;#x29;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="*"></div>
						<input type="text" readonly="" value="&amp;#x2a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="+"></div>
						<input type="text" readonly="" value="&amp;#x2b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=","></div>
						<input type="text" readonly="" value="&amp;#x2c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="-"></div>
						<input type="text" readonly="" value="&amp;#x2d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="."></div>
						<input type="text" readonly="" value="&amp;#x2e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="/"></div>
						<input type="text" readonly="" value="&amp;#x2f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="0"></div>
						<input type="text" readonly="" value="&amp;#x30;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="1"></div>
						<input type="text" readonly="" value="&amp;#x31;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="2"></div>
						<input type="text" readonly="" value="&amp;#x32;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="3"></div>
						<input type="text" readonly="" value="&amp;#x33;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="4"></div>
						<input type="text" readonly="" value="&amp;#x34;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="5"></div>
						<input type="text" readonly="" value="&amp;#x35;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="6"></div>
						<input type="text" readonly="" value="&amp;#x36;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="7"></div>
						<input type="text" readonly="" value="&amp;#x37;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="8"></div>
						<input type="text" readonly="" value="&amp;#x38;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="9"></div>
						<input type="text" readonly="" value="&amp;#x39;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=":"></div>
						<input type="text" readonly="" value="&amp;#x3a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=";"></div>
						<input type="text" readonly="" value="&amp;#x3b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="<"></div>
						<input type="text" readonly="" value="&amp;#x3c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="="></div>
						<input type="text" readonly="" value="&amp;#x3d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=">"></div>
						<input type="text" readonly="" value="&amp;#x3e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="?"></div>
						<input type="text" readonly="" value="&amp;#x3f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="@"></div>
						<input type="text" readonly="" value="&amp;#x40;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="A"></div>
						<input type="text" readonly="" value="&amp;#x41;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="B"></div>
						<input type="text" readonly="" value="&amp;#x42;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="C"></div>
						<input type="text" readonly="" value="&amp;#x43;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="D"></div>
						<input type="text" readonly="" value="&amp;#x44;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="E"></div>
						<input type="text" readonly="" value="&amp;#x45;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="F"></div>
						<input type="text" readonly="" value="&amp;#x46;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="G"></div>
						<input type="text" readonly="" value="&amp;#x47;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="H"></div>
						<input type="text" readonly="" value="&amp;#x48;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="I"></div>
						<input type="text" readonly="" value="&amp;#x49;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="J"></div>
						<input type="text" readonly="" value="&amp;#x4a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="K"></div>
						<input type="text" readonly="" value="&amp;#x4b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="L"></div>
						<input type="text" readonly="" value="&amp;#x4c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="M"></div>
						<input type="text" readonly="" value="&amp;#x4d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="N"></div>
						<input type="text" readonly="" value="&amp;#x4e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="O"></div>
						<input type="text" readonly="" value="&amp;#x4f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="P"></div>
						<input type="text" readonly="" value="&amp;#x50;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="Q"></div>
						<input type="text" readonly="" value="&amp;#x51;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="R"></div>
						<input type="text" readonly="" value="&amp;#x52;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="S"></div>
						<input type="text" readonly="" value="&amp;#x53;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="T"></div>
						<input type="text" readonly="" value="&amp;#x54;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="U"></div>
						<input type="text" readonly="" value="&amp;#x55;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="V"></div>
						<input type="text" readonly="" value="&amp;#x56;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="W"></div>
						<input type="text" readonly="" value="&amp;#x57;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="X"></div>
						<input type="text" readonly="" value="&amp;#x58;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="Y"></div>
						<input type="text" readonly="" value="&amp;#x59;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="Z"></div>
						<input type="text" readonly="" value="&amp;#x5a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="["></div>
						<input type="text" readonly="" value="&amp;#x5b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="\"></div>
						<input type="text" readonly="" value="&amp;#x5c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="]"></div>
						<input type="text" readonly="" value="&amp;#x5d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="^"></div>
						<input type="text" readonly="" value="&amp;#x5e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="_"></div>
						<input type="text" readonly="" value="&amp;#x5f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="`"></div>
						<input type="text" readonly="" value="&amp;#x60;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="a"></div>
						<input type="text" readonly="" value="&amp;#x61;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="b"></div>
						<input type="text" readonly="" value="&amp;#x62;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="c"></div>
						<input type="text" readonly="" value="&amp;#x63;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="d"></div>
						<input type="text" readonly="" value="&amp;#x64;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="e"></div>
						<input type="text" readonly="" value="&amp;#x65;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="f"></div>
						<input type="text" readonly="" value="&amp;#x66;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="g"></div>
						<input type="text" readonly="" value="&amp;#x67;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="h"></div>
						<input type="text" readonly="" value="&amp;#x68;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="i"></div>
						<input type="text" readonly="" value="&amp;#x69;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="j"></div>
						<input type="text" readonly="" value="&amp;#x6a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="k"></div>
						<input type="text" readonly="" value="&amp;#x6b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="l"></div>
						<input type="text" readonly="" value="&amp;#x6c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="m"></div>
						<input type="text" readonly="" value="&amp;#x6d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="n"></div>
						<input type="text" readonly="" value="&amp;#x6e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="o"></div>
						<input type="text" readonly="" value="&amp;#x6f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="p"></div>
						<input type="text" readonly="" value="&amp;#x70;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="q"></div>
						<input type="text" readonly="" value="&amp;#x71;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="r"></div>
						<input type="text" readonly="" value="&amp;#x72;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="s"></div>
						<input type="text" readonly="" value="&amp;#x73;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="t"></div>
						<input type="text" readonly="" value="&amp;#x74;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="u"></div>
						<input type="text" readonly="" value="&amp;#x75;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="v"></div>
						<input type="text" readonly="" value="&amp;#x76;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="w"></div>
						<input type="text" readonly="" value="&amp;#x77;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="x"></div>
						<input type="text" readonly="" value="&amp;#x78;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="y"></div>
						<input type="text" readonly="" value="&amp;#x79;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="z"></div>
						<input type="text" readonly="" value="&amp;#x7a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="{"></div>
						<input type="text" readonly="" value="&amp;#x7b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="|"></div>
						<input type="text" readonly="" value="&amp;#x7c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="}"></div>
						<input type="text" readonly="" value="&amp;#x7d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon="~"></div>
						<input type="text" readonly="" value="&amp;#x7e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe000;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe001;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe002;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe003;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe004;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe005;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe006;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe007;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe008;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe009;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe00a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe00b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe00c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe00d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe00e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe00f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe010;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe011;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe012;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe013;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe014;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe015;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe016;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe017;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe018;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe019;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe01a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe01b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe01c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe01d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe01e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe01f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe020;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe021;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe022;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe023;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe024;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe025;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe026;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe027;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe028;">
					</div>
					<div class="glyph">
					 <div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe029;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe02a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe02b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe02c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe02d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe02e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe02f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe030;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe103;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ee;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ef;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e8;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ea;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe101;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe107;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe108;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe102;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe106;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0eb;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe105;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ed;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe100;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe104;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e9;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe109;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ec;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0fe;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f6;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0fb;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e2;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e3;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f5;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e1;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ff;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe031;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe032;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe033;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe034;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe035;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe036;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe037;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe038;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe039;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe03a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe03b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe03c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe03d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe03e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe03f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe040;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe041;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe042;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe043;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe044;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe045;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe046;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe047;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe048;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe049;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe04a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe04b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe04c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe04d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe04e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe04f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe050;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe051;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe052;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe053;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe054;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe055;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe056;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe057;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe058;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe059;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe05a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe05b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe05c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe05d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe05e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe05f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe060;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe061;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe062;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe063;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe064;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe065;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe066;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe067;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe068;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe069;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe06a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe06b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe06c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe06d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe06e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe06f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe070;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe071;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe072;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe073;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe074;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe075;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe076;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe077;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe078;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe079;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe07a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe07b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe07c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe07d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe07e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe07f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe080;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe081;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe082;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe083;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe084;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe085;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe086;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe087;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe088;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe089;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe08a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe08b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe08c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe08d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe08e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe08f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe090;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe091;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe092;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f8;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0fa;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e7;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0fd;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e4;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e5;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f7;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e0;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0fc;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f9;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0dd;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f1;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0dc;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f3;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d8;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0db;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f0;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0df;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f2;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0f4;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d9;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0da;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0de;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0e6;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe093;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe094;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe095;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe096;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe097;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe098;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe099;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe09a;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe09b;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe09c;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe09d;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe09e;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe09f;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a0;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a1;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a2;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a3;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a4;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a5;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a6;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a7;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a8;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0a9;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0aa;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ab;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ac;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ad;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ae;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0af;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b0;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b1;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b2;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b3;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b4;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b5;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b6;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b7;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b8;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0b9;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ba;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0bb;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0bc;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0bd;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0be;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0bf;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c0;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c1;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c2;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c3;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c4;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c5;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c6;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c7;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c8;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0c9;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ca;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0cb;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0cc;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0cd;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0ce;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0cf;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d0;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d1;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d2;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d3;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d4;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d5;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d6;">
					</div>
					<div class="glyph">
						<div class="fs1" aria-hidden="true" data-icon=""></div>
						<input type="text" readonly="" value="&amp;#xe0d7;">
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
