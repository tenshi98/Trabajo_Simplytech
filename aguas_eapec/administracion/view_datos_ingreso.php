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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del movimiento</h3>
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
// Se traen todos los datos de la subida
$query = "SELECT 
mediciones_datos.fCreacion,
mediciones_datos.Fecha,
mediciones_datos.Nombre AS NombreArchivo,
mediciones_datos.Observaciones,
usuarios_listado.Nombre AS NombreUsuario,
core_sistemas.Nombre AS Sistema,
mediciones_datos.ConsumoMedidor,
mediciones_datos_tipo_medicion.Nombre AS NombreMedicion,
marcadores_listado.Nombre AS NombreMedidor

FROM `mediciones_datos`
LEFT JOIN `core_sistemas`                   ON core_sistemas.idSistema                         = mediciones_datos.idSistema
LEFT JOIN `usuarios_listado`                ON usuarios_listado.idUsuario                      = mediciones_datos.idUsuario
LEFT JOIN `mediciones_datos_tipo_medicion`  ON mediciones_datos_tipo_medicion.idTipoMedicion   = mediciones_datos.idTipoMedicion
LEFT JOIN `marcadores_listado`              ON marcadores_listado.idMarcadores                 = mediciones_datos.idMarcadoresUsado

WHERE mediciones_datos.idDatos = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
				


// Se trae un listado con todos los datos subidos correctamente
$arrDatosCorrectos = array();
$query = "SELECT 
clientes_listado.Nombre,
clientes_listado.Direccion,
clientes_listado.Identificador,
clientes_listado.UnidadHabitacional,
mediciones_datos_detalle.Consumo,
mediciones_datos_detalle_facturado.Nombre AS Facturado,
marcadores_listado.Nombre AS Marcadores,
marcadores_remarcadores.Nombre AS Remarcadores

FROM `mediciones_datos_detalle` 

LEFT JOIN `mediciones_datos_detalle_facturado`   ON mediciones_datos_detalle_facturado.idFacturado     = mediciones_datos_detalle.idFacturado
LEFT JOIN `clientes_listado`                     ON clientes_listado.idCliente                         = mediciones_datos_detalle.idCliente
LEFT JOIN `marcadores_listado`                   ON marcadores_listado.idMarcadores                    = mediciones_datos_detalle.idMarcadores
LEFT JOIN `marcadores_remarcadores`              ON marcadores_remarcadores.idRemarcadores             = mediciones_datos_detalle.idRemarcadores

WHERE mediciones_datos_detalle.idDatos = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDatosCorrectos,$row );
}



// Se trae un listado con todos los datos subidos correctamente
$arrDatosErroneos = array();
$query = "SELECT ID_Cliente, ID_Nombre, ID_Direccion,Consumo, ID_FLectura, ID_TipoMIU, ID_MIU, ID_Contador
FROM `mediciones_datos_erroneos` 
WHERE idDatos = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDatosErroneos,$row );
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
    <div id="header"> Ingreso Datos </div>
   

    <div id="customer">


        <table id="meta" class="fleft otdata">
            <tbody>
				<tr>
                    <td class="meta-head"><strong>DATOS BASICOS</strong></td>
                    <td class="meta-head"></td>
                </tr>
				<tr>
                    <td class="meta-head">Fecha Creacion</td>
                    <td><?php echo Fecha_estandar($rowdata['fCreacion']); ?></td>
                </tr>
				<tr>
                    <td class="meta-head">Creador</td>
                    <td><?php echo $rowdata['NombreUsuario']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Nombre del Archivo</td>
                    <td><?php echo $rowdata['NombreArchivo']?></td>
                </tr>
				<tr>
                    <td class="meta-head">Sistema</td>
                    <td><?php echo $rowdata['Sistema']?></td>
                </tr>
                
				<?php if(isset($rowdata['NombreMedidor'])&&$rowdata['NombreMedidor']!=''){ ?>
                <tr>
                    <td class="meta-head">Medidor</td>
                    <td><?php echo $rowdata['NombreMedidor']?></td>
                </tr>
                <?php } ?>
                <?php if(isset($rowdata['ConsumoMedidor'])&&$rowdata['ConsumoMedidor']!=''&&$rowdata['ConsumoMedidor']!=0){ ?>
                <tr>
                    <td class="meta-head">Medicion del periodo</td>
                    <td><?php echo Cantidades_decimales_justos($rowdata['ConsumoMedidor']).' Metros Cubicos'; ?></td>
                </tr>
                <?php } ?>
                <?php if(isset($rowdata['NombreMedicion'])&&$rowdata['NombreMedicion']!=''){ ?>
                 <tr>
                    <td class="meta-head">Distribucion de diferencia</td>
                    <td><?php echo $rowdata['NombreMedicion']?></td>
                </tr>
                <?php } ?>
                
                



            </tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>
                <tr>
					<td class="meta-head">Fecha Facturacion</td>
					<td><?php echo Fecha_estandar($rowdata['Fecha']);?></td>
				</tr>
            </tbody>
        </table>
    </div>
    <table id="items">
        <tbody>
            
			<tr><th colspan="10">Detalle</th></tr>		  
            
            <?php if($arrDatosCorrectos) { ?>
				<tr class="item-row fact_tittle"><td colspan="8"><strong>Datos Ingresados Correctamente</strong></td></tr>
				<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
					<td class="item-name"><strong>Identificador</strong></td>
					<td class="item-name"><strong>Cliente</strong></td>
					<td class="item-name"><strong>Medidor</strong></td>
					<td class="item-name"><strong>Remarcador</strong></td>
					<td class="item-name"><strong>Direccion</strong></td>
					<td class="item-name"><strong>UH</strong></td>
					<td class="item-name"><strong>Consumo</strong></td>
					<td class="item-name"><strong>Estado Facturacion</strong></td>
				</tr>
				<?php foreach ($arrDatosCorrectos as $datos) { ?>
					<tr class="item-row linea_punteada">
						<td class="item-name"><?php echo $datos['Identificador']; ?></td>
						<td class="item-name"><?php echo $datos['Nombre']; ?></td>
						<td class="item-name"><?php echo $datos['Marcadores']; ?></td>
						<td class="item-name"><?php echo $datos['Remarcadores']; ?></td>
						<td class="item-name"><?php echo $datos['Direccion']; ?></td>
						<td class="item-name"><?php echo $datos['UnidadHabitacional']; ?></td>
						<td class="item-name"><?php echo $datos['Consumo']; ?></td>
						<td class="item-name"><?php echo $datos['Facturado']; ?></td>	
					</tr> 
				<?php } ?>
				<tr id="hiderow"><td colspan="8"></td></tr>
			<?php } ?>
			
			<?php if($arrDatosErroneos) { ?>
				<tr class="item-row fact_tittle"><td colspan="8"><strong>Datos Erroneos</td></tr>
				<tr class="item-row linea_punteada" bgcolor="#F0F0F0">
					<td class="item-name"><strong>N. Cliente</strong></td>
					<td class="item-name"><strong>Cliente</strong></td>
					<td class="item-name"><strong>Direccion</strong></td>
					<td class="item-name"><strong>Medicion</strong></td>
					<td class="item-name"><strong>Fecha lectura</strong></td>
					<td class="item-name"><strong>Tipo MIU</strong></td>
					<td class="item-name"><strong>MIU</strong></td>
					<td class="item-name"><strong>Contador</strong></td>	
				</tr>
				<?php foreach ($arrDatosErroneos as $datos) { ?>
					<tr class="item-row linea_punteada">
						<td class="item-name"><?php echo $datos['ID_Cliente']; ?></td>
						<td class="item-name"><?php echo $datos['ID_Nombre']; ?></td>
						<td class="item-name"><?php echo $datos['ID_Direccion']; ?></td>
						<td class="item-name"><?php echo $datos['Consumo']; ?></td>
						<td class="item-name"><?php echo $datos['ID_FLectura']; ?></td>
						<td class="item-name"><?php echo $datos['ID_TipoMIU']; ?></td>
						<td class="item-name"><?php echo $datos['ID_MIU']; ?></td>
						<td class="item-name"><?php echo $datos['ID_Contador']; ?></td>
					</tr> 
				<?php } ?>
				<tr id="hiderow"><td colspan="8"></td></tr>
			<?php } ?>



			
            <tr>
                <td colspan="8" class="blank"> 
					<p>
						<?php 
						if(isset($rowdata['Observaciones'])&&$rowdata['Observaciones']!=''){
							echo $rowdata['Observaciones'];
						}else{
							echo 'Sin Observaciones';
						}?>
					</p>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="blank"><p>Observaciones</p></td> 
            </tr>
        </tbody>
    </table>
    	<div class="clearfix"></div>
    	
    </div>


</div>
	
	



<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
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
