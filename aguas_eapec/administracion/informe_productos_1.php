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
$original = "informe_productos_1.php";
$location = $original;
//Se agregan ubicaciones
$location .='?filtro=true';			       
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
if ( ! empty($_GET['filtro']) ) { 
// Se trae un listado con todos los usuarios
$arrProductos = array();
$query = "SELECT 
bodegas_facturacion_existencias.Creacion_fecha,
bodegas_facturacion_existencias.Cantidad_ing,
bodegas_facturacion_existencias.Cantidad_eg,
bodegas_facturacion_existencias.idFacturacion,
bodegas_facturacion_existencias.Valor,
bodegas_facturacion_tipo.Nombre AS TipoMovimiento,
productos_listado.Nombre AS NombreProducto,
productos_uml.Nombre AS UnidadMedida,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `bodegas_facturacion_tipo`    ON bodegas_facturacion_tipo.idTipo   = bodegas_facturacion_existencias.idTipo
LEFT JOIN `productos_listado`           ON productos_listado.idProducto      = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`               ON productos_uml.idUml               = productos_listado.idUml
LEFT JOIN `bodegas_listado`             ON bodegas_listado.idBodega          = bodegas_facturacion_existencias.idBodega

WHERE bodegas_facturacion_existencias.idProducto={$_GET['idProducto']}  
AND bodegas_facturacion_existencias.idBodega={$_GET['idBodega']}
AND bodegas_facturacion_existencias.Creacion_fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'
AND bodegas_facturacion_existencias.idTipo={$_GET['idTipo']}
ORDER BY bodegas_facturacion_existencias.Creacion_fecha DESC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
} 

?>
 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Listado de Movimientos de <?php echo $arrProductos[0]['NombreProducto'];?> de la bodega <?php echo $arrProductos[0]['NombreBodega']; ?></h5>
			<div class="toolbar">
				<?php
				$zz  = '?idSistema='.$arrUsuario['idSistema'];
				$zz .= '&idProducto='.$_GET['idProducto'];
				$zz .= '&idBodega='.$_GET['idBodega'];
				$zz .= '&f_inicio='.$_GET['f_inicio'];
				$zz .= '&f_termino='.$_GET['f_termino'];
				$zz .= '&idTipo='.$_GET['idTipo'];
				?>
				<a target="new" href="informe_productos_1_to_excel.php<?php echo $zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
				<a target="new" href="informe_productos_1_to_pdf.php<?php echo $zz ?>" class="btn btn-sm btn-metis-3"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a>
				<a target="new" href="informe_productos_1_to_print.php<?php echo $zz ?>" class="btn btn-sm btn-metis-5"><i class="fa fa-print"></i> Imprimir</a>
			</div>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Movimiento</th>
						<th>Fecha</th>
						<th>Cant Ing</th>
						<th>Cant eg</th>
						<th>Valor</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $productos) { ?>
					<tr class="odd">
						<td>
							<div class="btn-group" >
								<a href="<?php echo 'view_doc.php?view='.$productos['idFacturacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>
							</div>
							<?php echo $productos['TipoMovimiento']; ?>
						</td>
						<td><?php echo Fecha_estandar($productos['Creacion_fecha']); ?></td>
						<td><?php echo Cantidades_decimales_justos($productos['Cantidad_ing']).' '.$productos['UnidadMedida'];?></td>
						<td><?php echo Cantidades_decimales_justos($productos['Cantidad_eg']).' '.$productos['UnidadMedida'];?></td>
						<td><?php echo Valores_sd($productos['Valor']).' x '.$productos['UnidadMedida']; ?></td>
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
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "idSistema>=0";
	$w = "idRubro>=0";	
}else{
	$z = "idSistema={$arrUsuario['idSistema']}";
	$w = "idRubro={$arrUsuario['idRubro']} OR idRubro=1";	
}
 
 ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1">
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {        $x1  = $idTipo;        }else{$x1  = '';}
				if(isset($idBodega)) {      $x2  = $idBodega;      }else{$x2  = '';}
				if(isset($idProducto)) {    $x3  = $idProducto;    }else{$x3  = '';}
				if(isset($f_inicio)) {      $x4  = $f_inicio;      }else{$x4  = '';}
				if(isset($f_termino)) {     $x5  = $f_termino;     }else{$x5  = '';}

				//se dibujan los inputs
				echo form_select('Movimiento','idTipo', $x1, 2, 'idTipo', 'Nombre', 'bodegas_facturacion_tipo', 0, $dbConn);
				echo form_select('Bodega','idBodega', $x2, 2, 'idBodega', 'Nombre', 'bodegas_listado', $z, $dbConn);
				echo form_select_filter('Producto','idProducto', $x3, 2, 'idProducto', 'Nombre', 'productos_listado', $w, $dbConn);
				echo form_date('Fecha Inicio','f_inicio', $x4, 2);
				echo form_date('Fecha Termino','f_termino', $x5, 2);	
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
