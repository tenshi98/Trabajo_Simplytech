<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  

?>
<!doctype html>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <title>Preview Tema</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <link rel="stylesheet" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_GET['idTheme'])&&$_GET['idTheme']!=''){echo $_GET['idTheme'];}else{echo '1';} ?>.css">
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
 
  <body>
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
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3>Preview Tema</h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">


<h3>Preview Formularios</h3>

			
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Producto</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($idTipo)) {         $x2  = $idTipo;           }else{$x2  = '';}
				if(isset($idCategoria)) {    $x3  = $idCategoria;      }else{$x3  = '';}
				if(isset($Marca)) {          $x4  = $Marca;            }else{$x4  = '';}
				if(isset($idUml)) {          $x5  = $idUml;            }else{$x5  = '';}
				if(isset($idTipoProducto)) { $x6  = $idTipoProducto;   }else{$x6  = '';}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select_filter('Tipo de Producto','idTipo', $x2, 2, 'idTipo', 'Nombre', 'sistema_productos_tipo', 0,  '',$dbConn);
				$Form_Imputs->form_select_filter('Categoria','idCategoria', $x3, 2, 'idCategoria', 'Nombre', 'sistema_productos_categorias', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Marca', 'Marca', $x4, 2);
				$Form_Imputs->form_select_filter('Unidad de Medida','idUml', $x5, 2, 'idUml', 'Nombre', 'sistema_productos_uml', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Tipo Producto','idTipoProducto', $x6, 2, 'idTipoProducto', 'Nombre', 'core_tipo_producto', 0, '', $dbConn);
				
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" >
					<a href="#" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
		</div>
	</div>
</div>

<h3>Preview Listados</h3>
<?php
//vars
$num_pag = 1;	
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}

//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idComuna FROM `core_ubicacion_comunas` ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrComunas = array();
$query = "SELECT 
core_ubicacion_comunas.idComuna,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_ubicacion_ciudad.Nombre AS nombre_ciudad
FROM `core_ubicacion_comunas`
LEFT JOIN `core_ubicacion_ciudad` ON core_ubicacion_ciudad.idCiudad = core_ubicacion_comunas.idCiudad
ORDER BY core_ubicacion_ciudad.Nombre ASC, core_ubicacion_comunas.Nombre ASC
LIMIT $comienzo, $cant_reg ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrComunas,$row );
}
?>			
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Comunas</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="60">ID</th>
						<th>Nombre Region</th>
						<th>Nombre Comuna</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>				  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrComunas as $comunas) { ?>
					<tr class="odd">
						<td><?php echo $comunas['idComuna']; ?></td>
						<td><?php echo $comunas['nombre_ciudad']; ?></td>
						<td><?php echo $comunas['nombre_comuna']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<a href="#" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
								<?php 
								$ubicacion = '';
								$dialogo   = '¿Realmente deseas eliminar la comuna de '.$comunas['nombre_comuna'].'?';?>
								<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
														
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
      </div> 
    </div>
    <footer id="footer">
	<p><?php echo ano_actual();?> &copy; <?php echo DB_EMPRESA_NAME ?> Todos los derechos reservados.</p>
</footer>

<!--Otros archivos javascript -->
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

  </body>
</html>
