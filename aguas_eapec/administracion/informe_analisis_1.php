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
$original = "informe_analisis_1.php";
$location = $original;
//Se agregan ubicaciones
$location .='?filtro=true';			
if (isset($_GET['idBodega']) && $_GET['idBodega'] != ''){        $location .="&idBodega={$_GET['idBodega']}";}
if (isset($_GET['idProducto']) && $_GET['idProducto'] != ''){    $location .="&idProducto={$_GET['idProducto']}";}
if (isset($_GET['f_inicio']) && $_GET['f_inicio'] != ''){        $location .="&f_inicio={$_GET['f_inicio']}";}
if (isset($_GET['f_termino']) && $_GET['f_termino'] != ''){      $location .="&f_termino={$_GET['f_termino']}";}
       
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
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "WHERE analisis_aguas.idSistema>=0";
	$n = "?filter=true";	
}else{
	$z = "WHERE analisis_aguas.idSistema={$arrUsuario['idSistema']}";	
	$n = "?filter=true";	
}
//Filtros
if (isset($_GET['idSector']) && $_GET['idSector'] != ''){                
	$z .=" AND analisis_aguas.idSector='{$_GET['idSector']}'";
	$n .="&idSector={$_GET['idSector']}";
}
if (isset($_GET['idPuntoMuestreo']) && $_GET['idPuntoMuestreo'] != ''){  
	$z .=" AND analisis_aguas.idPuntoMuestreo='{$_GET['idPuntoMuestreo']}'";
	$n .="&idPuntoMuestreo={$_GET['idPuntoMuestreo']}";
}
if (isset($_GET['idTipoMuestra']) && $_GET['idTipoMuestra'] != ''){      
	$z .=" AND analisis_aguas.idTipoMuestra='{$_GET['idTipoMuestra']}'";
	$n .="&idTipoMuestra={$_GET['idTipoMuestra']}";
}
if (isset($_GET['idParametros']) && $_GET['idParametros'] != ''){        
	$z .=" AND analisis_aguas.idParametros='{$_GET['idParametros']}'";
	$n .="&idParametros={$_GET['idParametros']}";
}
if (isset($_GET['idSigno']) && $_GET['idSigno'] != ''){                  
	$z .=" AND analisis_aguas.idSigno='{$_GET['idSigno']}'";
	$n .="&idSigno={$_GET['idSigno']}";
}
if (isset($_GET['idLaboratorio']) && $_GET['idLaboratorio'] != ''){      
	$z .=" AND analisis_aguas.idLaboratorio='{$_GET['idLaboratorio']}'";
	$n .="&idLaboratorio={$_GET['idLaboratorio']}";
}

if(isset($_GET['f_muestra_inicio']) && $_GET['f_muestra_inicio'] != ''&&isset($_GET['f_muestra_termino']) && $_GET['f_muestra_termino'] != ''){ 
	$z .= " AND analisis_aguas.f_muestra BETWEEN '{$_GET['f_muestra_inicio']}' AND '{$_GET['f_muestra_termino']}'" ;
	$n .="&f_muestra_inicio={$_GET['f_muestra_inicio']}&f_muestra_termino={$_GET['f_muestra_termino']}";
}
if(isset($_GET['f_recibida_inicio']) && $_GET['f_recibida_inicio'] != ''&&isset($_GET['f_recibida_termino']) && $_GET['f_recibida_termino'] != ''){ 
	$z .= " AND analisis_aguas.f_recibida BETWEEN '{$_GET['f_recibida_inicio']}' AND '{$_GET['f_recibida_termino']}'" ;
	$n .="&f_recibida_inicio={$_GET['f_recibida_inicio']}&f_recibida_termino={$_GET['f_recibida_termino']}";
}

         
            
// Se trae un listado con todos los usuarios
$arrProductos = array();
$query = "SELECT 
analisis_aguas.codigoProceso,
analisis_aguas.codigoArchivo,
core_sistemas.Rut AS rut,
analisis_aguas.f_recibida AS periodo,
analisis_aguas.codigoServicio AS codigo_servicio,
analisis_aguas.idSector AS codigo_sector,
analisis_aguas.codigoMuestra AS codigo_muestra,
analisis_aguas_tipo_punto_muestreo.Codigo AS tipo_punto_muestreo,
analisis_aguas.UTM_norte,
analisis_aguas.UTM_este,
analisis_aguas_tipo_muestra.Codigo AS tipo_muestra,
analisis_aguas.RemuestraFecha AS periodo_remuestreo,
analisis_aguas.f_muestra AS fecha_muestra,
analisis_parametros.Codigo AS codigo_parametro,
analisis_aguas_signo.Codigo AS signo,
analisis_aguas.valorAnalisis AS valor,
analisis_laboratorios.Rut AS rutLaboratorio,
analisis_laboratorios.Codigo AS idLaboratorio,
clientes_listado.Identificador

FROM `analisis_aguas`
LEFT JOIN `core_sistemas`                         ON core_sistemas.idSistema                                 = analisis_aguas.idSistema
LEFT JOIN `analisis_aguas_tipo_punto_muestreo`    ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo      = analisis_aguas.idPuntoMuestreo
LEFT JOIN `analisis_aguas_tipo_muestra`           ON analisis_aguas_tipo_muestra.idTipoMuestra               = analisis_aguas.idTipoMuestra
LEFT JOIN `analisis_parametros`                   ON analisis_parametros.idParametros                        = analisis_aguas.idParametros
LEFT JOIN `analisis_aguas_signo`                  ON analisis_aguas_signo.idSigno                            = analisis_aguas.idSigno
LEFT JOIN `analisis_laboratorios`                 ON analisis_laboratorios.idLaboratorio                     = analisis_aguas.idLaboratorio
LEFT JOIN `clientes_listado`                 ON clientes_listado.idCliente                     = analisis_aguas.idCliente

".$z."
ORDER BY analisis_aguas.f_recibida ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
} 

?>
 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Informe de analisis</h5>
			<div class="toolbar">
				<a target="new" href="informe_analisis_1_to_excel.php<?php echo $n ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
			</div>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>codigoProceso</th>
						<th>codigoArchivo</th>
						<th>rut</th>
						<th>periodo</th>
						<th>codigo_servicio</th>
						<th>codigo_sector</th>
						<th>codigo_muestra</th>
						<th>tipo_punto_muestreo</th>
						<th>UTM_norte</th>
						<th>UTM_este</th>
						<th>tipo_muestra</th>
						<th>periodo_remuestreo</th>
						<th>fecha_muestra</th>
						<th>codigo_parametro</th>
						<th>signo</th>
						<th>valor</th>
						<th>rutLaboratorio</th>
						<th>idLaboratorio</th>
					</tr>
				</thead>
					  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $productos) { ?>
					
					<tr class="odd">
						<td><?php echo $productos['Identificador']; ?></td>
						<td><?php echo $productos['codigoProceso']; ?></td>
						<td><?php echo $productos['codigoArchivo']; ?></td>
						<td><?php echo cortarRut($productos['rut']); ?></td>
						<td><?php echo Fecha_año($productos['periodo']).Fecha_mes_n($productos['periodo']); ?></td>
						<td><?php echo $productos['codigo_servicio']; ?></td>
						<td><?php echo $productos['codigo_sector']; ?></td>
						<td><?php echo $productos['codigo_muestra']; ?></td>
						<td><?php echo $productos['tipo_punto_muestreo']; ?></td>
						<td><?php echo $productos['UTM_norte']; ?></td>
						<td><?php echo $productos['UTM_este']; ?></td>
						<td><?php echo $productos['tipo_muestra']; ?></td>
						<td><?php if($productos['periodo_remuestreo']!='0000-00-00'){echo Fecha_año($productos['periodo_remuestreo']).Fecha_mes_n($productos['periodo_remuestreo']); } ?></td>
						<td><?php echo Fecha_estandar($productos['fecha_muestra']); ?></td>
						<td><?php echo $productos['codigo_parametro']; ?></td>
						<td><?php echo $productos['signo']; ?></td>
						<td><?php echo Cantidades_decimales_justos($productos['valor']); ?></td>
						<td><?php echo $productos['rutLaboratorio']; ?></td>
						<td><?php echo $productos['idLaboratorio']; ?></td>
			
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
}else{
	$z = "idSistema={$arrUsuario['idSistema']}";
}
 
 ?>
<div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
			
			<?php 
			//Se verifican si existen los datos
			if(isset($f_muestra_inicio)) {       $x1  = $f_muestra_inicio;     }else{$x1  = '';}
			if(isset($f_muestra_termino)) {      $x2  = $f_muestra_termino;    }else{$x2  = '';}
            if(isset($f_recibida_inicio)) {      $x3  = $f_recibida_inicio;    }else{$x3  = '';}
            if(isset($f_recibida_termino)) {     $x4  = $f_recibida_termino;   }else{$x4  = '';}
            if(isset($idSector)) {               $x5  = $idSector;             }else{$x5  = '';}
            if(isset($idPuntoMuestreo)) {        $x6  = $idPuntoMuestreo;      }else{$x6  = '';}
            if(isset($idTipoMuestra)) {          $x7  = $idTipoMuestra;        }else{$x7  = '';}
            if(isset($idParametros)) {           $x8  = $idParametros;         }else{$x8  = '';}
            if(isset($idSigno)) {                $x9  = $idSigno;              }else{$x9  = '';}
            if(isset($idLaboratorio)) {          $x10 = $idLaboratorio;        }else{$x10 = '';}
            
			//se dibujan los inputs
			echo form_date('Fecha de la muestra Inicio','f_muestra_inicio', $x1, 1);
			echo form_date('Fecha de la muestra Termino','f_muestra_termino', $x2, 1);
			echo form_date('Fecha Recibida Inicio','f_recibida_inicio', $x3, 1);
			echo form_date('Fecha Recibida Termino','f_recibida_termino', $x4, 1);
			echo form_select_filter('Sector','idSector', $x5, 1, 'idSector', 'Nombre', 'analisis_sectores', $z, $dbConn);
			echo form_select_filter('Punto de Muestra','idPuntoMuestreo', $x6, 1, 'idPuntoMuestreo', 'Nombre', 'analisis_aguas_tipo_punto_muestreo', 0, $dbConn);
			echo form_select_filter('Tipo de Muestra','idTipoMuestra', $x7, 1, 'idTipoMuestra', 'Nombre', 'analisis_aguas_tipo_muestra', 0, $dbConn);
			echo form_select_filter('Parametro','idParametros', $x8, 1, 'idParametros', 'Nombre', 'analisis_parametros', $z, $dbConn);
			echo form_select_filter('Signo','idSigno', $x9, 1, 'idSigno', 'Nombre', 'analisis_aguas_signo', 0, $dbConn);
			echo form_select_filter('Laboratorio','idLaboratorio', $x10, 1, 'idLaboratorio', 'Nombre', 'analisis_laboratorios', $z, $dbConn);
			
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
