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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Proveedor</h3>
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

// Se traen todos los datos del proveedor
$query = "SELECT  
proveedor_listado.email, 
proveedor_listado.Nombre, 
proveedor_listado.Rut, 
proveedor_listado.fNacimiento, 
proveedor_listado.Direccion, 
proveedor_listado.Fono1, 
proveedor_listado.Fono2, 
proveedor_listado.Fax,
proveedor_listado.PersonaContacto,
proveedor_listado.Web,
proveedor_listado.Giro,
mnt_ubicacion_ciudad.Nombre AS nombre_region,
mnt_ubicacion_comunas.Nombre AS nombre_comuna,
proveedor_estado.Nombre AS estado,
core_sistemas.Nombre AS sistema,
proveedor_tipos.Nombre AS tipoCliente,
proveedor_paises.Nombre AS Pais
FROM `proveedor_listado`
LEFT JOIN `proveedor_estado`           ON proveedor_estado.idEstado           = proveedor_listado.idEstado
LEFT JOIN `mnt_ubicacion_ciudad`       ON mnt_ubicacion_ciudad.idCiudad       = proveedor_listado.idCiudad
LEFT JOIN `mnt_ubicacion_comunas`      ON mnt_ubicacion_comunas.idComuna      = proveedor_listado.idComuna
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema             = proveedor_listado.idSistema
LEFT JOIN `proveedor_tipos`            ON proveedor_tipos.idTipo              = proveedor_listado.idTipo
LEFT JOIN `proveedor_paises`           ON proveedor_paises.idPais             = proveedor_listado.idPais
WHERE proveedor_listado.idProveedor = {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	

// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
usuarios_listado.Nombre AS nombre_usuario,
proveedor_observaciones.Fecha,
proveedor_observaciones.Observacion
FROM `proveedor_observaciones`
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = proveedor_observaciones.idUsuario
WHERE proveedor_observaciones.idProveedor = {$_GET['view']}
ORDER BY proveedor_observaciones.idObservacion ASC 
LIMIT 15 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}




//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z1 = "bodegas_facturacion.idSistema>=0";
	$z2 = "bodegas_activos_facturacion.idSistema>=0";	
}else{
	$z1 = "bodegas_facturacion.idSistema = {$arrUsuario['idSistema']} ";
	$z2 = "bodegas_activos_facturacion.idSistema = {$arrUsuario['idSistema']}";
}

// Se trae un listado con las compras de materiales
$arrCompras = array();
$query = "SELECT 
bodegas_facturacion.idFacturacion,
bodegas_documentos_mercantiles.Nombre AS Documento,
bodegas_facturacion.N_Doc,
bodegas_facturacion.Creacion_fecha

FROM `bodegas_facturacion`
LEFT JOIN `bodegas_documentos_mercantiles`   ON bodegas_documentos_mercantiles.idDocumentos     = bodegas_facturacion.idDocumentos
WHERE ".$z1." AND bodegas_facturacion.idProveedor = {$_GET['view']}
ORDER BY bodegas_facturacion.idFacturacion DESC
LIMIT 15 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrCompras,$row );
}



?>

<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Proveedor</h5>
			<div class="toolbar"></div>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos</a></li>
				<li class=""><a href="#observaciones" data-toggle="tab">Observaciones</a></li>
				<li class=""><a href="#productos" data-toggle="tab">Compra de Productos</a></li>
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
										<p class="text-muted"><strong>Tipo de Proveedor : </strong><?php echo $rowdata['tipoCliente']; ?></p>
										<p class="text-muted"><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?></p>
										<p class="text-muted"><strong>Rut : </strong><?php echo $rowdata['Rut']; ?></p>
										<p class="text-muted"><strong>Fecha de Ingreso : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?></p>
										<p class="text-muted"><strong>Pais : </strong><?php echo $rowdata['Pais']; ?></p>
										<p class="text-muted"><strong>Region : </strong><?php echo $rowdata['nombre_region']; ?></p>
										<p class="text-muted"><strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?></p>
										<p class="text-muted"><strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?></p>
										<p class="text-muted"><strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?></p>
										<p class="text-muted"><strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?></p>
										
										<h2 class="text-primary">Datos de Contacto</h2>
										<p class="text-muted"><strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?></p>
										<p class="text-muted"><strong>Telefono 1 : </strong><?php echo $rowdata['Fono1']; ?></p>
										<p class="text-muted"><strong>Telefono 2 : </strong><?php echo $rowdata['Fono2']; ?></p>
										<p class="text-muted"><strong>Fax : </strong><?php echo $rowdata['Fax']; ?></p>
										<p class="text-muted"><strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a></p>
										<p class="text-muted"><strong>Web : </strong><a target="_new" href="http://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a></p>
									<td>
									<?php 
									$direccion = "";
									if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
									if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
									if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
									if(isset($rowdata["Pais"])&&$rowdata["Pais"]!=''){                     $direccion .= ', '.$rowdata["Pais"];}
									echo mapa2($direccion) ?>
									</td>
								</tr>                  
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
									<th width="120">Fecha</th>
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
			
			<div class="tab-pane fade" id="productos">
				<div class="wmd-panel">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Documento</th>
									<th width="120">Fecha</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php foreach ($arrCompras as $compras) { ?>
								<tr class="odd">		
									<td>
										<div class="btn-group" >
											<a target="_new" href="<?php echo 'view_doc.php?view='.$productos['idFacturacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>
										</div>
										<?php echo $compras['Documento'].' N°'.$compras['N_Doc']; ?>
									</td>
									<td><?php echo Fecha_estandar($compras['Creacion_fecha']); ?></td>			
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
