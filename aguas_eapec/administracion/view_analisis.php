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
            <h3><i class="fa fa-dashboard"></i> Ver Datos del Cliente</h3>
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
analisis_aguas.f_muestra,
analisis_aguas.f_recibida,
analisis_aguas.codigoProceso,
analisis_aguas.codigoArchivo,
analisis_aguas.codigoServicio,
analisis_aguas.UTM_norte,
analisis_aguas.UTM_este,
analisis_aguas.codigoMuestra,
analisis_aguas.RemuestraFecha,
analisis_aguas.Remuestra_codigo_muestra,
analisis_aguas.valorAnalisis,
analisis_aguas.CodigoLaboratorio,


core_sistemas.Rut AS Rut,
analisis_sectores.idSector AS CodigoSector,



analisis_aguas_tipo_punto_muestreo.Nombre AS PuntoMuestreo,
analisis_aguas_tipo_muestra.Nombre AS TipoMuestra,
analisis_parametros.Nombre AS Parametro,
analisis_aguas_signo.Nombre AS Signo,
analisis_laboratorios.Nombre AS Laboratorio,

core_sistemas.Nombre AS Sistema,
analisis_sectores.Nombre AS Sector



FROM `analisis_aguas`
LEFT JOIN `core_sistemas`                        ON core_sistemas.idSistema                              = analisis_aguas.idSistema
LEFT JOIN `analisis_sectores`                    ON analisis_sectores.idSector                           = analisis_aguas.idSector
LEFT JOIN `analisis_aguas_tipo_punto_muestreo`   ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo   = analisis_aguas.idPuntoMuestreo
LEFT JOIN `analisis_aguas_tipo_muestra`          ON analisis_aguas_tipo_muestra.idTipoMuestra            = analisis_aguas.idTipoMuestra
LEFT JOIN `analisis_parametros`                  ON analisis_parametros.idParametros                     = analisis_aguas.idParametros
LEFT JOIN `analisis_aguas_signo`                 ON analisis_aguas_signo.idSigno                         = analisis_aguas.idSigno
LEFT JOIN `analisis_laboratorios`                ON analisis_laboratorios.idLaboratorio                  = analisis_aguas.idLaboratorio

WHERE analisis_aguas.idAnalisisAgua = {$_GET['view']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	



?>



<div class="row">
	
	<div class="col-lg-12">
		<div class="box">	
			<header>		
				<div class="icons"><i class="fa fa-table"></i></div><h5>Informe Fecha <?php echo Fecha_estandar($rowdata['f_muestra']); ?></h5>	
			</header>
			<div class="table-responsive">    
				<table id="dataTable" class="table table-bordered table-condensed dataTable">
					
						  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						
						<tr class="odd">
							<td>Codigo Proceso:</td>
							<td><?php echo $rowdata['codigoProceso']; ?></td>
						</tr>
						<tr class="odd">
							<td>Codigo Archivo:</td>
							<td><?php echo $rowdata['codigoArchivo']; ?></td>
						</tr>
						<tr class="odd">
							<td>Rut:</td>
							<td><?php echo $rowdata['Rut']; ?></td>
						</tr>
						<tr class="odd">
							<td>Periodo:</td>
							<td><?php if($rowdata['f_muestra']!='0000-00-00'){echo Fecha_año($rowdata['f_muestra']).Fecha_mes_n($rowdata['f_muestra']);} ?></td>
						</tr>
						<tr class="odd">
							<td>Codigo Servicio:</td>
							<td><?php echo $rowdata['codigoServicio']; ?></td>
						</tr>
						<tr class="odd">
							<td>Codigo Sector:</td>
							<td><?php echo $rowdata['CodigoSector']; ?></td>
						</tr>
						<tr class="odd">
							<td>Codigo Muestra:</td>
							<td><?php echo $rowdata['codigoMuestra']; ?></td>
						</tr>
						<tr class="odd">
							<td>Punto Muestreo:</td>
							<td><?php echo $rowdata['PuntoMuestreo']; ?></td>
						</tr>
						<tr class="odd">
							<td>UTM Norte:</td>
							<td><?php echo $rowdata['UTM_norte']; ?></td>
						</tr>
						<tr class="odd">
							<td>UTM Este:</td>
							<td><?php echo $rowdata['UTM_este']; ?></td>
						</tr>
						<tr class="odd">
							<td>Tipo Muestra:</td>
							<td><?php echo $rowdata['TipoMuestra']; ?></td>
						</tr>
						<tr class="odd">
							<td>Periodo Remuestreo:</td>
							<td><?php if($rowdata['RemuestraFecha']!='0000-00-00'){echo Fecha_año($rowdata['RemuestraFecha']).Fecha_mes_n($rowdata['RemuestraFecha']);} ?></td>
						</tr>
						<tr class="odd">
							<td>Remuestra Fecha:</td>
							<td><?php echo $rowdata['RemuestraFecha']; ?></td>
						</tr>
						<tr class="odd">
							<td>Parametro:</td>
							<td><?php echo $rowdata['Parametro']; ?></td>
						</tr>
						<tr class="odd">
							<td>Signo:</td>
							<td><?php echo $rowdata['Signo']; ?></td>
						</tr>
						<tr class="odd">
							<td>Valor Analisis:</td>
							<td><?php echo $rowdata['valorAnalisis']; ?></td>
						</tr>
						<tr class="odd">
							<td>Laboratorio:</td>
							<td><?php echo $rowdata['Laboratorio']; ?></td>
						</tr>
						<tr class="odd">
							<td>Fecha recibida:</td>
							<td><?php echo $rowdata['f_recibida']; ?></td>
						</tr>
						<tr class="odd">
							<td>Remuestra codigo muestra:</td>
							<td><?php echo $rowdata['Remuestra_codigo_muestra']; ?></td>
						</tr>
						<tr class="odd">
							<td>Sector:</td>
							<td><?php echo $rowdata['Sector']; ?></td>
						</tr>
						<tr class="odd">
							<td>Codigo Laboratorio:</td>
							<td><?php echo $rowdata['CodigoLaboratorio']; ?></td>
						</tr>

					                    
					</tbody>
				</table>
				
			
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
