<!DOCTYPE html>
<html lang="es-ES">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<?php 
		//Se verifican las variables para mostrar el titulo e la pagina
		if (isset($_SESSION['usuario']['basic_data']['RazonSocial'])&&$_SESSION['usuario']['basic_data']['RazonSocial']!=''){
			if (isset($_SESSION['usuario']['Permisos'][$original]['TransaccionNombre'])&&$_SESSION['usuario']['Permisos'][$original]['TransaccionNombre']!=''){
				echo '<title>'.TituloMenu($_SESSION['usuario']['Permisos'][$original]['TransaccionNombre']).' - '.$_SESSION['usuario']['basic_data']['RazonSocial'].'</title>';
			}else{
				echo '<title>'.$_SESSION['usuario']['basic_data']['RazonSocial'].'</title>';
			} 
		}else{
			echo '<title>'.DB_SOFT_NAME.'</title>';
		} ?>
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap3/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/lib/fullcalendar/fullcalendar.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/bs3.form.input.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/bs3.form.border.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="<?php echo DB_SITE ?>/LIB_assets/lib/html5shiv/html5shiv.js"></script>
			<script src="<?php echo DB_SITE ?>/LIB_assets/lib/respond/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="<?php echo DB_SITE ?>/Legacy/gestion_modular/js/personel.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<link rel="icon" type="image/png" href="img/mifavicon.png" />
		<?php widget_tooltipster();?>
	</head>

	<?php
	//modificacion de la interfaz
	if(isset($_SESSION['menu'])&&$_SESSION['menu']!=''){
		switch ($_SESSION['menu']) {
			case 1:
			   $classelement = '';
				break;
			case 2:
				$classelement = 'sidebar-left-mini'; 
				break;
			case 3:
				$classelement = 'sidebar-left-hidden';
				break;
		}	
	}else{
		$classelement = ''; 
	}?> 
	<body class="<?php echo $classelement; ?>">
	<?php
	//verifica la capa de desarrollo
	$whitelist = array( 'localhost', '127.0.0.1', '::1' );
	//si estoy en ambiente de desarrollo
	if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){

	//si estoy en ambiente de produccion	
	}else{	
		/*    Global Variables    */
		//Tiempo Maximo de la consulta, 40 minutos por defecto
		if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
		//Memora RAM Maxima del servidor, 4GB por defecto
		if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
	}
	/***********************************************/
	//Elimino los datos previos del form
	unset($_SESSION['form_require']);
	//se carga dato previo
	$_SESSION['form_require'] = 'required'; ?>
		<div id="wrap">
			<div id="top">
				<nav class="navbar navbar-inverse navbar-static-top">
					<div class="container-fluid">
						<header class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span> 
								<span class="icon-bar"></span> 
								<span class="icon-bar"></span> 
								<span class="icon-bar"></span> 
							</button>
							<a href="principal.php" class="navbar-brand">
								<?php require_once 'Web.Body.Nav.Logo.php';?>
							</a> 
						</header>
						<?php require_once 'Web.Body.Nav.Actions.php';?>
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<?php require_once 'Web.Body.Nav.Menu_top.php';?>
						</div>
					</div>
				</nav>
				<header class="head">
					<div class="main-bar">
						<h3>
							<?php 
							//Se verifica que exista transaccion
							if(isset($_SESSION['usuario']['Permisos'][$original]['TransaccionNombre'])){
								echo '<i class="'.$_SESSION['usuario']['Permisos'][$original]['CategoriaIcono'].'"></i> '.TituloMenu($_SESSION['usuario']['Permisos'][$original]['CategoriaNombre']).' - '.TituloMenu($_SESSION['usuario']['Permisos'][$original]['TransaccionNombre']);
							}else{
								echo '<i class="fa fa-dashboard"></i> Principal';
							} ?>
						</h3>
					</div>
				</header>
			</div>
			<div id="left">
				<?php require_once 'Web.Body.Lateralmenu.Userbox.php';?> 
				<?php require_once 'Web.Body.Lateralmenu.Menu.php';?> 
			</div>
			<div id="content">
				<div class="outer">
					<div class="inner">
