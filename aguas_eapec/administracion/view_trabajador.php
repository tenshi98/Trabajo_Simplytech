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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Trabajador</h3>
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
trabajadores_listado.Nombre,
trabajadores_listado.ApellidoPat,
trabajadores_listado.ApellidoMat, 
trabajadores_listado.Cargo, 
trabajadores_listado.Fono, 
trabajadores_listado.Rut,
trabajadores_listado.Observaciones,
trabajadores_listado_tipos.Nombre AS TipoTrabajador,
core_sistemas.Nombre AS Sistema,
mnt_ubicacion_ciudad.Nombre AS nombre_region,
mnt_ubicacion_comunas.Nombre AS nombre_comuna,
trabajadores_listado.Direccion

FROM `trabajadores_listado`
LEFT JOIN `trabajadores_listado_tipos`  ON trabajadores_listado_tipos.idTipo   = trabajadores_listado.idTipo
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema             = trabajadores_listado.idSistema
LEFT JOIN `mnt_ubicacion_ciudad`        ON mnt_ubicacion_ciudad.idCiudad       = trabajadores_listado.idCiudad
LEFT JOIN `mnt_ubicacion_comunas`       ON mnt_ubicacion_comunas.idComuna      = trabajadores_listado.idComuna

WHERE trabajadores_listado.idTrabajador = {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);


?>


<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Ver Datos del Trabajador</h5>
			<div class="toolbar"></div>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
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
										<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre'].' '.$rowdata['ApellidoPat'].' '.$rowdata['ApellidoMat']; ?></p>
										<p class="text-muted"><strong>Cargo : </strong><?php echo $rowdata['Cargo']; ?></p>
										<p class="text-muted"><strong>Fono : </strong><?php echo $rowdata['Fono']; ?></p>
										<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
										<p class="text-muted"><strong>Tipo Trabajador : </strong><?php echo $rowdata['TipoTrabajador']; ?></p>
										<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['nombre_comuna'].', '.$rowdata['nombre_region']; ?></p>
										<p class="text-muted"><strong>Sistema : </strong><?php echo $rowdata['Sistema']; ?></p>
										<p class="text-muted"><strong>Observaciones : </strong><?php echo $rowdata['Observaciones']; ?></p>
									</td>
									<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
									if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
									echo mapa2($direccion) ?>
									</td>
								</tr>                  
							</tbody>
						</table>
					</div>
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
