<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                   Se filtran las entradas para evitar ataques                                                  */
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

//verificacion sesion usuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Session.php';

//carga librerias propias de la plataforma
require_once '../Legacy/gestion_modular/funciones/Helpers.Functions.Propias.php';
require_once '../Legacy/gestion_modular/funciones/Components.UI.FormInputs.Extended.php';
require_once '../Legacy/gestion_modular/funciones/Components.UI.Inputs.Extended.php';
require_once '../Legacy/gestion_modular/funciones/Components.UI.Widgets.Extended.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "index_select.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para recuperar la contraseña
if ( !empty($_GET['ini']) )  { 
	$form_trabajo= 'select_sistema';
	require_once 'A1XRXS_sys/xrxs_form/usuarios_listado.php';
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Seleccion Plataforma</title>
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
		<link href="<?php echo DB_SITE ?>/LIBS_js/tooltipster/css/tooltipster.bundle.min.css" rel="stylesheet" type="text/css">
		<script src="<?php echo DB_SITE ?>/LIBS_js/tooltipster/js/tooltipster.bundle.min.js"></script>
		<script>
			<!--
			$(document).ready(function() {
				$('.tooltip').tooltipster({
				   animation: 'grow',
				   delay: 130,
				   maxWidth: 300
				});
			});
			//-->
		</script>
		<style>
		.bx_shad{-webkit-box-shadow: 0px 0px 31px 6px rgba(0,0,0,1);-moz-box-shadow: 0px 0px 31px 6px rgba(0,0,0,1);box-shadow: 0px 0px 31px 6px rgba(0,0,0,1);}
		</style>
	</head>

	<body class="login">
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

//Si el usuario es un super usuario
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	// Se trae un listado con todos los sistemas
	$arrSistemas = array();
	$query = "SELECT  idSistema, Nombre AS RazonSocial
	FROM `core_sistemas`
	WHERE idEstado=1";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSistemas,$row );
	}						
//Si el usuario es un usuario normal
}else{
	// Se trae un listado con todos los sistemas
	$arrSistemas = array();
	$query = "SELECT 
	usuarios_sistemas.idSistema,
	core_sistemas.Nombre AS RazonSocial
	FROM `usuarios_sistemas`
	LEFT JOIN `core_sistemas`  ON core_sistemas.idSistema  = usuarios_sistemas.idSistema
	WHERE usuarios_sistemas.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']}
	AND core_sistemas.idEstado=1";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	while ( $row = mysqli_fetch_assoc ($resultado)) {
	array_push( $arrSistemas,$row );
	}												
}


?>

<div class="container">

	<h1 style="margin-top: 0px;margin-bottom: 0px;color: white;"><?php echo DB_SOFT_NAME; ?></h1>
	
	<div class="col-sm-12">
		<div class="col-sm-4">
			<div class="box bx_shad">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div>
					<h5>Bienvenido <?php echo $_SESSION['usuario']['basic_data']['Nombre']; ?></h5>
				</header>
				<div class="tab-content">
					<div class="col-sm-12" style="padding-top:15px;">
						<?php if ($_SESSION['usuario']['basic_data']['Direccion_img']=='') { ?>
							<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/usr.png">
						<?php }else{  ?>
							<img class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-sm-8">
			
			<div class="box bx_shad">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Sistemas Autorizados</h5>
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Sistema</th>
								<th width="10">Acciones</th>
							</tr>
						</thead>			  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrSistemas as $sis) { ?>
								<tr class="odd">
									<td><?php echo $sis['RazonSocial']; ?></td>
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="<?php echo $location.'?ini='.$sis['idSistema'].'&id='.$_SESSION['usuario']['basic_data']['idUsuario']; ?>" title="Seleccionar sistema" class="btn btn-primary btn-sm tooltip"><i class="fa fa-check" aria-hidden="true"></i></a>
										</div>
									</td>
								</tr>
							<?php } ?>                    
						</tbody>
					</table>
				</div> 
			</div>
			
		</div>
	</div>
</div>


<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

	</body>
</html>
