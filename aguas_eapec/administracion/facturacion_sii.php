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
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "facturacion_sii.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit_filter']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'filtro_por_fechas';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_filtros.php';
}
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
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
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
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
// Se trae un listado con todos los usuarios
$arrFacturacion = array();
$query = "SELECT  
facturacion_listado_detalle.ClienteIdentificador, 
facturacion_listado_detalle.ClienteNombre, 
facturacion_listado_detalle.Fecha, 
facturacion_listado_detalle.DetalleTotalAPagar, 
facturacion_listado_detalle.idFacturacionDetalle, 
facturacion_listado_detalle.SII_NDoc,
clientes_facturable.Nombre AS Facturable



FROM `facturacion_listado_detalle`
LEFT JOIN `clientes_facturable` ON clientes_facturable.idFacturable = facturacion_listado_detalle.SII_idFacturable

WHERE facturacion_listado_detalle.idMes = {$_GET['idMes']} 
AND facturacion_listado_detalle.Ano = {$_GET['Ano']} 
AND facturacion_listado_detalle.SII_idFacturable = {$_GET['idFacturable']}
";
//AND facturacion_listado_detalle.SII_NDoc = 0 ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
} 

?>
 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Facturacion fecha <?php echo Fecha_estandar($arrFacturacion[0]['Fecha']);?> </h5>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>Nombre</th>
						<th width="120">Fecha</th>
						<th width="120">Total a Pagar</th>
						<th width="120">Documentos</th>
						<th width="120">N° Factura SII</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
					  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrFacturacion as $fact) { ?>
					
					<tr class="odd">
						<td><?php echo $fact['ClienteIdentificador']; ?></td>
						<td><?php echo $fact['ClienteNombre']; ?></td>
						<td><?php echo Fecha_estandar($fact['Fecha']); ?></td>
						<td><?php echo valores($fact['DetalleTotalAPagar'], 0); ?></td>
						<td><?php echo $fact['Facturable']; ?></td>
						<td><?php echo n_doc($fact['SII_NDoc'],8); ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php 
								echo '<a target="_blank" href="view_facturacion.php?view='.$fact['idFacturacionDetalle'].'" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>';
								if (isset($fact['SII_NDoc'])&&$fact['SII_NDoc']==0){
									if ($rowlevel['level']>=2){
										$ubicacion = 'lib_libredte_php/exe/001-generar_dte.php?view='.$fact['idFacturacionDetalle'];
										$dialogo   = '¿Desea facturar el documento de la empresa '.$fact['ClienteNombre'].'?';?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Facturar con SII" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-shopping-cart"></i></a>
									<?php }
								} ?>
								
							</div>
						</td>
					</tr>
				<?php } ?>                     
				</tbody>
			</table>
		</div>
	</div>
</div>
  
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal"  name="form1" action="<?php echo $location; ?>">
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Ano)) {      $x1  = $Ano;    }else{$x1  = '';}
				if(isset($idMes)) {    $x2  = $idMes;  }else{$x2  = '';}
				if(isset($idMes)) {    $x3  = $idMes;  }else{$x3  = '';}

				//se dibujan los inputs
				echo form_select_n_auto('Año','Ano', $x1, 2, 2016, 2030);
				echo form_select('Mes','idMes', $x2, 2, 'idMes', 'Nombre', 'mnt_meses', 0, $dbConn);
				echo form_select('Tipo Documento','idFacturable', $x3, 2, 'idFacturable', 'Nombre', 'clientes_facturable', 0, $dbConn);
						
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width" value="Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
                    
		</div>
	</div>
</div> 
<?php } ?>
<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
