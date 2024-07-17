<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);

/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
//variable de ubicacion en el menu
$rowlevel['nombre_categoria'] = '';
?>
<?php require_once 'core/header.php';?>
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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Cargo</h3>
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
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
// Se traen todos los datos de mi usuario
$query = "SELECT 
clientes_otros_cargos.Fecha,
clientes_otros_cargos.Observacion,
clientes_otros_cargos.ValorCargo,
clientes_listado.Rut AS ClienteRut,
clientes_listado.Nombre AS ClienteNombre,
usuarios_listado.Nombre AS UsuarioNombre,
core_sistemas.Nombre AS sistema



FROM `clientes_otros_cargos`
LEFT JOIN `clientes_listado`         ON clientes_listado.idCliente       = clientes_otros_cargos.idCliente
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario       = clientes_otros_cargos.idUsuario
LEFT JOIN `core_sistemas`            ON core_sistemas.idSistema          = clientes_otros_cargos.idSistema



WHERE idOtrosCargos = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$row_data = mysqli_fetch_assoc ($resultado);?>

<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Notificacion</h5>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-lg-4" style="margin-bottom:5px;"></div>	
					
					<div class="col-lg-8">
						
						<h2 class="text-primary">Datos Basicos</h2>
						<p class="text-muted"><strong>Autor: </strong><?php echo $row_data['UsuarioNombre']; ?></p>
						
						<p class="text-muted"><strong>Cliente: </strong><?php echo $row_data['ClienteNombre']; ?></p>
						<p class="text-muted"><strong>Rut: </strong><?php echo $row_data['ClienteRut']; ?></p>
						<p class="text-muted"><strong>Fecha: </strong><?php echo fecha_estandar($row_data['Fecha']);?></p>
						<p class="text-muted"><strong>Valor: </strong><?php echo valores($row_data['ValorCargo'], 0);?></p>
						
						<p class="text-muted"><strong>Sistema: </strong><?php echo $row_data['sistema'];?></p>
						
						<h2 class="text-primary">Mensaje</h2>
						<p class="text-muted" style="white-space: normal;"><?php echo $row_data['Observacion'];?></p>
					
						
						<?php if (isset($row_data['Archivo'])&&$row_data['Archivo']!='') { ?>
							<h2 class="text-primary">Archivo</h2>
							<a href="download.php?dir=upload&file=<?php echo $row_data['Archivo']; ?>" class="btn btn-danger margin_width" data-original-title="" title=""><i class="fa fa-cloud-download" aria-hidden="true"></i>  <?php echo $row_data['Archivo']; ?></a>
							<br/>
							<div style="margin-bottom:25px;"></div>
						<?php }?>
					
					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
        </div>	
	</div>
</div>



	
	



 

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

         
			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
