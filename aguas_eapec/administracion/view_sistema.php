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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Sistema</h3>
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
// Se traen todos los datos del trabajador
$query = "SELECT
core_sistemas.Nombre, 
core_sistemas_rubro.Nombre AS Rubro, 
core_sistemas.Rut, 
core_sistemas.Ciudad, 
core_sistemas.Comuna, 
core_sistemas.Direccion, 
core_sistemas.Contacto, 
core_sistemas.Fono, 
core_sistemas.Fax, 
core_sistemas.Web, 
core_sistemas.email_principal, 
core_sistemas.NombreContrato, 
core_sistemas.NContrato, 
core_sistemas.FContrato, 
core_sistemas.DContrato,
core_theme_colors.Nombre AS Tema,
core_sistemas.valorCargoFijo,
core_sistemas.valorAgua,
core_sistemas.valorRecoleccion,
core_sistemas.valorVisitaCorte,
core_sistemas.valorCorte1,
core_sistemas.valorCorte2,
core_sistemas.valorReposicion1,
core_sistemas.valorReposicion2,
core_sistemas.NdiasPago

FROM `core_sistemas`
LEFT JOIN `core_sistemas_rubro`   ON core_sistemas_rubro.idRubro   = core_sistemas.idRubro
LEFT JOIN `core_theme_colors`     ON core_theme_colors.idTheme     = core_sistemas.idTheme



WHERE core_sistemas.idSistema = {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);

?>


<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Ver Datos de la empresa</h5>	
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="50%" class="word_break">Datos</th>
						<th width="50%">Mapa</th>
					</tr>
				</thead>
					  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<tr class="odd">
						<td class="word_break">
							
							<h2 class="text-primary">Datos Basicos</h2>
							<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
							<p class="text-muted"><strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?></p>
							<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
							<p class="text-muted"><strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?></p>
							<p class="text-muted"><strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?></p>
							<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?></p>
									
									
							<h2 class="text-primary">Datos de contacto</h2>
							<p class="text-muted"><strong>Nombre Contacto : </strong><?php echo $rowdata['Contacto']; ?></p>
							<p class="text-muted"><strong>Fono : </strong><?php echo $rowdata['Fono']; ?></p>
							<p class="text-muted"><strong>Fax : </strong><?php echo $rowdata['Fax']; ?></p>
							<p class="text-muted"><strong>Web : </strong><?php echo $rowdata['Web']; ?></p>
							<p class="text-muted"><strong>Email : </strong><?php echo $rowdata['email_principal']; ?></p>
									
							<h2 class="text-primary">Contrato</h2>
							<p class="text-muted"><strong>Nombre Contrato : </strong><?php echo $rowdata['NombreContrato']; ?></p>
							<p class="text-muted"><strong>Numero de Contrato : </strong><?php echo $rowdata['NContrato']; ?></p>
							<p class="text-muted"><strong>Fecha inicio Contrato : </strong><?php echo $rowdata['FContrato']; ?></p>
							<p class="text-muted"><strong>Duracion Contrato(Meses) : </strong><?php echo $rowdata['DContrato']; ?></p>
								
							<h2 class="text-primary">Configuracion</h2>
							<p class="text-muted"><strong>Tema : </strong><?php echo $rowdata['Tema']; ?></p>
									
							<h2 class="text-primary">Datos de Facturacion</h2>
							<p class="text-muted"><strong>Cargo Fijo : </strong><?php echo Valores($rowdata['valorCargoFijo'], 0); ?></p>
							<p class="text-muted"><strong>Metro Cubico Agua : </strong><?php echo Valores($rowdata['valorAgua'], 2); ?></p>
							<p class="text-muted"><strong>Metro Cubico Recoleccion : </strong><?php echo Valores($rowdata['valorRecoleccion'], 2); ?></p>
							<p class="text-muted"><strong>Visita Corte : </strong><?php echo Valores($rowdata['valorVisitaCorte'], 0); ?></p>
							<p class="text-muted"><strong>Corte 1° Instancia : </strong><?php echo Valores($rowdata['valorCorte1'], 0); ?></p>
							<p class="text-muted"><strong>Corte 2° Instancia : </strong><?php echo Valores($rowdata['valorCorte2'], 0); ?></p>
							<p class="text-muted"><strong>Reposicion 1° Instancia : </strong><?php echo Valores($rowdata['valorReposicion1'], 0); ?></p>
							<p class="text-muted"><strong>Reposicion 2° Instancia : </strong><?php echo Valores($rowdata['valorReposicion2'], 0); ?></p>
							<p class="text-muted"><strong>N° Dias para Vencimiento : </strong><?php echo $rowdata['NdiasPago']; ?> dias</p>

						<td>
						<?php 
							$direccion = "";
							if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){  $direccion .= $rowdata["Direccion"];}
							if(isset($rowdata["Comuna"])&&$rowdata["Comuna"]!=''){        $direccion .= ', '.$rowdata["Comuna"];}
							if(isset($rowdata["Ciudad"])&&$rowdata["Ciudad"]!=''){        $direccion .= ', '.$rowdata["Ciudad"];}
							echo mapa2($direccion) ?>
						</td>
					</tr>                  
				</tbody>
			</table>
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
