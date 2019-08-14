<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "principal_arriendos_alt.php";
$location = $original;
//Se agregan ubicaciones
if(isset($_GET['Mes']) && $_GET['Mes'] != ''){        $location .= "?Mes=".$_GET['Mes'] ;        } else { $location .= "?Mes=".mes_actual(); }
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){        $location .= "&Ano=".$_GET['Ano'] ;        } else { $location .= "&Ano=".ano_actual(); }
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){  $location .= "&idTipo=".$_GET['idTipo'] ;  } else { $location .= "&idTipo=1"; }

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
		<link rel="stylesheet" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/lib/fullcalendar/fullcalendar.css">
		<link href="<?php echo DB_SITE ?>/LIBS_js/tooltipster/css/tooltipster.bundle.min.css" rel="stylesheet" type="text/css">
		<script src="<?php echo DB_SITE ?>/LIBS_js/tooltipster/js/tooltipster.bundle.min.js"></script>
		<script>
			<!--
			$(document).ready(function() {
				$('.tooltip').tooltipster({
				   animation: 'grow',
				   delay: 130,
				});
			});
			//-->
		</script>
		<style>
			body {
				background-color: #FFF;
			}
		</style>
	</head>

	<body>
		<div class="col-sm-12">
			<?php
			//Manejador de errores
			if(isset($error)&&$error!=''){echo notifications_list($error);};
			//Include de la presentacion
			include '1include_principal_arriendos.php';
			?>

		</div>



	

<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>



		
	</body>
</html>
