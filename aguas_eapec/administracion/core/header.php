<!doctype html>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <?php 
    //
    if (isset($arrUsuario['RazonSocial'])&&$arrUsuario['RazonSocial']!=''){
		if (isset($rowlevel['nombre_transaccion'])&&$rowlevel['nombre_transaccion']!=''){
			echo '<title>'.$arrUsuario['RazonSocial'].' - '.$rowlevel['nombre_transaccion'].'</title>';
		}else{
			echo '<title>'.$arrUsuario['RazonSocial'].'</title>';
		} 
	}else{
		echo '<title>Aguas</title>';
	} ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/lib/font-awesome-animation/font-awesome-animation.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <link rel="stylesheet" href="assets/css/theme_color_<?php if(isset($arrUsuario['idTheme'])&&$arrUsuario['idTheme']!=''){echo $arrUsuario['idTheme'];}else{echo '0';} ?>.css">
    <link rel="stylesheet" href="assets/lib/fullcalendar/fullcalendar.css">
    <!-- Estilo definido por mi -->
    <link href="assets/css/my_style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/my_colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/my_corrections.css" rel="stylesheet" type="text/css">
	<script src="assets/js/personel.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="assets/lib/html5shiv/html5shiv.js"></script>
        <script src="assets/lib/respond/respond.min.js"></script>
        <![endif]-->
    <!--Modulos de javascript-->
    <script type="text/javascript" src="assets/lib/modernizr/modernizr.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
	<!-- Icono de la pagina -->
	<link rel="icon" type="image/png" href="img/mifavicon.png" />
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
