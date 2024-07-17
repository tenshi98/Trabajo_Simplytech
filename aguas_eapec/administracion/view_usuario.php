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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Usuario</h3>
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
usuarios_listado.usuario, 
usuarios_listado.tipo, 
usuarios_listado.email, 
usuarios_listado.Nombre, 
usuarios_listado.Rut, 
usuarios_listado.fNacimiento, 
usuarios_listado.Direccion, 
usuarios_listado.Fono, 
usuarios_listado.Ciudad, 
usuarios_listado.Comuna,
usuarios_listado.Ultimo_acceso,
usuarios_listado.Direccion_img,
usuarios_estado.Nombre AS estado,
core_sistemas.Nombre AS RazonSocial
FROM `usuarios_listado`
LEFT JOIN `usuarios_estado`   ON usuarios_estado.idEstado     = usuarios_listado.idEstado
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema        = usuarios_listado.idSistema
WHERE idUsuario = {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
//Traigo un listado con todos sus accesos de sistema	
$arrAccess = array();
$query = "SELECT  Fecha, Hora
FROM `usuarios_accesos`
WHERE idUsuario = {$_GET['view']}
ORDER BY idAcceso DESC
LIMIT 13 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrAccess,$row );
}
// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuario_evaluador.Nombre AS nombre_usuario,
usuarios_observaciones.Fecha,
usuarios_observaciones.Observacion
FROM `usuarios_observaciones`
LEFT JOIN `usuarios_listado` usuario_evaluador  ON usuario_evaluador.idUsuario     = usuarios_observaciones.idUsuario
WHERE usuarios_observaciones.idUsuario_observado = {$_GET['view']}
ORDER BY usuarios_observaciones.idObservacion ASC
LIMIT 13 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}

?>
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos</h5>
			<div class="toolbar"></div>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#ingresos" data-toggle="tab">Ingresos al Sistema</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-lg-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="img/usr.png">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-lg-8">
						<h2 class="text-primary">Datos del Perfil</h2>
						<p class="text-muted"><strong>Usuario : </strong><?php echo $rowdata['usuario']; ?></p>
						<p class="text-muted"><strong>Tipo de usuario : </strong><?php echo $rowdata['tipo']; ?></p>
						<p class="text-muted"><strong>Estado : </strong><?php echo $rowdata['estado']; ?></p>
						<p class="text-muted"><strong>Ultimo Acceso : </strong><?php echo $rowdata['Ultimo_acceso']; ?></p>
						
						<h2 class="text-primary">Datos Personales</h2>
						<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
						<p class="text-muted"><strong>Fono : </strong><?php echo $rowdata['Fono']; ?></p>
						<p class="text-muted"><strong>Email : </strong><?php echo $rowdata['email']; ?></p>
						<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
						<p class="text-muted"><strong>Fecha de Nacimiento : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?></p>
						<p class="text-muted"><strong>Ciudad : </strong><?php echo $rowdata['Ciudad']; ?></p>
						<p class="text-muted"><strong>Comuna : </strong><?php echo $rowdata['Comuna']; ?></p>
						<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?></p>
						<p class="text-muted"><strong>Sistema Relacionado : </strong><?php echo $rowdata['RazonSocial']; ?></p>
					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
			
			<div class="tab-pane fade" id="ingresos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Fecha de ingreso</th>
									<th>Hora</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrAccess as $accesos) { ?>
									<tr class="odd">		
										<td><?php echo Fecha_estandar($accesos['Fecha']); ?></td>		
										<td><?php echo $accesos['Hora']; ?></td>	
									</tr>
								<?php } ?>                    
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="observaciones">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Autor</th>
									<th>Fecha</th>
									<th>Observacion</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrObservaciones as $observaciones) { ?>
									<tr class="odd">		
										<td><?php echo $observaciones['nombre_usuario']; ?></td>
										<td><?php echo $observaciones['Fecha']; ?></td>		
										<td class="word_break"><?php echo $observaciones['Observacion']; ?></td>	
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
