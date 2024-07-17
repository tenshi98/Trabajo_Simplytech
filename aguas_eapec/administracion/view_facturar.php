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
            <h3><i class="fa fa-dashboard"></i> Ver Facturacion</h3>
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
//Listado de errores no manejables
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Facturacion editada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos
$query = "SELECT  
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS NombreSistema,
facturacion_listado.Fecha, 
facturacion_listado.Observaciones, 
facturacion_listado.fCreacion,
facturacion_listado.intAnual

FROM `facturacion_listado`
LEFT JOIN `usuarios_listado`  ON usuarios_listado.idUsuario   = facturacion_listado.idUsuario
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema      = facturacion_listado.idSistema
WHERE idFacturacion = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowFacturacion = mysqli_fetch_assoc ($resultado);

// Se trae un listado con todos los clientes
$arrFacturacion = array();
$query = "SELECT  
facturacion_listado_detalle.idCliente, 
facturacion_listado_detalle.idFacturacionDetalle,
facturacion_listado_detalle.ClienteIdentificador,
facturacion_listado_detalle.ClienteNombre,
facturacion_listado_detalle_estado.Nombre AS Estado,
clientes_facturable.Nombre AS DocFacturable,
facturacion_listado_detalle.ClienteEstado,
facturacion_listado_detalle.ClienteIdentificador,
facturacion_listado_detalle.NombreArchivo

FROM `facturacion_listado_detalle`
LEFT JOIN `facturacion_listado_detalle_estado`  ON facturacion_listado_detalle_estado.idEstado   = facturacion_listado_detalle.idEstado
LEFT JOIN `clientes_facturable`                 ON clientes_facturable.idFacturable              = facturacion_listado_detalle.SII_idFacturable

WHERE facturacion_listado_detalle.idFacturacion = {$_GET['view']} 
ORDER BY facturacion_listado_detalle.ClienteIdentificador ASC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
}


?>



<style>
#address {
    height: auto !important;
}
.otdata td {
    text-align: left !important;
}
.otdata{
	width: 65% !important;
}
.otdata2{
	width: 30% !important;
}

</style> 




<div class="col-lg-11 fcenter table-responsive">

<div id="page-wrap">
    <div id="header"> Facturacion mes <?php echo Fecha_mes_año($rowFacturacion['Fecha']) ?></div>
   

    <div id="customer">


        <table id="meta" class="fleft otdata">
            <tbody>
				<tr>
                    <td class="meta-head"><strong>DATOS BASICOS</strong></td>
                    <td class="meta-head"></td>
                </tr>
				<tr>
                    <td class="meta-head">Fecha Creacion</td>
                    <td><?php echo Fecha_estandar($rowFacturacion['fCreacion']); ?></td>
                </tr>
				<tr>
                    <td class="meta-head">Creador</td>
                    <td><?php echo $rowFacturacion['NombreUsuario']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Sistema</td>
                    <td><?php echo $rowFacturacion['NombreSistema']?></td>
                </tr>
                <tr>
                    <td class="meta-head">Interes Anual</td>
                    <td><?php echo Cantidades($rowFacturacion['intAnual'], 2).'%'?></td>
                </tr>
            </tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>
                <tr>
					<td class="meta-head">Fecha Facturacion</td>
					<td><?php echo Fecha_estandar($rowFacturacion['Fecha']);?></td>
				</tr>
            </tbody>
        </table>
    </div>
    <table id="items">
        <tbody>
            
			<tr>
				<th colspan="9">Detalle</th>
			</tr>		  
            <tr class="item-row linea_punteada" bgcolor="#F0F0F0">
				<td class="item-name"><strong>Identificador</strong></td>
				<td class="item-name" colspan="4"><strong>Cliente</strong></td>
				<td class="item-name"><strong>Estado Pago</strong></td>
				<td class="item-name"><strong>Estado Cliente</strong></td>
				<td class="item-name"><strong>Documento</strong></td>
				<td class="item-name"><strong>Acciones</strong></td>
			</tr>
				
	
			<?php 
			//recorro el lsiatdo entregado por la base de datos
			foreach ($arrFacturacion as $cliente) { ?>
				<tr class="item-row linea_punteada">
					<td class="item-name"><?php echo $cliente['ClienteIdentificador']; ?></td>
					<td class="item-name" colspan="4"><?php echo $cliente['ClienteNombre']; ?></td>
					<td class="item-name"><?php echo $cliente['Estado']; ?></td>
					<td class="item-name"><?php echo $cliente['ClienteEstado']; ?></td>
					<td class="item-name"><?php echo $cliente['DocFacturable']; ?></td>
					<td class="item-name">
						<div class="btn-group widthtd120" >
							<?php 
								echo '<a href="view_facturacion_edit.php?view='.$cliente['idFacturacionDetalle'].'&facturar='.$_GET['view'].'" data-placement="bottom" title="Editar Facturacion" data-toggle="tooltip" class="btn btn-success btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a>';
								echo '<a target="_blank" href="view_cliente.php?view='.$cliente['idCliente'].'" data-placement="bottom" title="Ver Cliente" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>';
								echo '<a target="_blank" href="view_facturacion.php?view='.$cliente['idFacturacionDetalle'].'&idCliente='.$cliente['idCliente'].'" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>';
								if(isset($cliente['NombreArchivo'])&&$cliente['NombreArchivo']!=''){
									echo '<a href="upload/'.$cliente['NombreArchivo'].'" data-placement="bottom" title="Descargar Archivo" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-download"></i></a>';
								}
								if(isset($cliente['ClienteEstado'])&&$cliente['ClienteEstado']=='Corte en Tramite'){
									echo '<a target="_blank" href="view_facturacion_carta.php?view='.$cliente['idFacturacionDetalle'].'&idCliente='.$cliente['idCliente'].'" data-placement="bottom" title="Descargar Carta" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-file-word-o"></i></a>';
								}
							?>
						</div>
					</td>
				</tr> 
			<?php } ?>
	
			<tr id="hiderow"><td colspan="9"></td></tr>
			
			
			


			
            <tr>
                <td colspan="9" class="blank"> 
					<p>
						<?php 
						if(isset($rowFacturacion['Observaciones'])&&$rowFacturacion['Observaciones']!=''){
							echo $rowFacturacion['Observaciones'];
						}else{
							echo 'Sin Observaciones';
						}?>
					</p>
                </td>
            </tr>
            <tr>
                <td colspan="9" class="blank"><p>Observaciones</p></td> 
            </tr>
        </tbody>
    </table>
    	<div class="clearfix"></div>
    	
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
