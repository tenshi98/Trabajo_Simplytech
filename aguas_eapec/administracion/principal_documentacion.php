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
$original = "principal_procedimientos.php";
$location = $original;
//variable con el nombre de la categoria de la transaccion
$rowlevel['nombre_categoria']='Principal';
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
            <h3><i class="fa fa-file-word-o"></i> Documentos</h3>
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
//tomo el numero de la pagina si es que este existe
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z =" WHERE documentacion_listado.idSistema>=0";			
}else{
	$z = "WHERE documentacion_listado.idSistema={$arrUsuario['idSistema']} OR documentacion_listado.idSistema=9999";	
}
if (isset($_GET['filtersender'])){
	$z .= " AND documentacion_listado.idCategoria = {$_GET['filtersender']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idDocumentacion FROM `documentacion_listado` 
".$z;
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);

// Se trae un listado con todos los usuarios
$arrArchivo = array();
$query = "SELECT 
documentacion_categorias.Nombre AS NombreCategoria,
documentacion_listado.Nombre AS NombreProcedimiento,
documentacion_listado.Version AS Version,
documentacion_listado.Direccion_img

FROM `documentacion_listado`
LEFT JOIN `documentacion_categorias`   ON documentacion_categorias.idCategoria   = documentacion_listado.idCategoria
".$z."
ORDER BY documentacion_categorias.Nombre ASC, documentacion_listado.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrArchivo,$row );
}
//se trae un listado con todas las categorias
$arrCategorias = array();
$query = "SELECT 
documentacion_categorias.idCategoria, 
documentacion_categorias.Nombre,
count(documentacion_listado.idDocumentacion)AS cuenta
FROM `documentacion_categorias`
LEFT JOIN `documentacion_listado`  ON documentacion_listado.idCategoria   = documentacion_categorias.idCategoria
GROUP BY documentacion_categorias.idCategoria
ORDER BY documentacion_categorias.Nombre ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrCategorias,$row );
}
?>


<div class="row inbox">
  						
	<div class="col-lg-8">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Archivos de documentos</h5>
				<div class="toolbar">
					<?php 
					if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
					echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
				</div>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>detalle</th>
							<th width="120">Version</th>
							<th width="120">Acciones</th>
						</tr>
					</thead>			  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrArchivo as $procedimiento) { ?>
						<tr class="odd">
							<td><?php echo $procedimiento['NombreCategoria'].' - '.$procedimiento['NombreProcedimiento']; ?></td>
							<td><?php echo $procedimiento['Version']; ?></td>
							<td>
								<div class="btn-group" >
									<a href="<?php echo 'upload/'.$procedimiento['Direccion_img']; ?>" data-placement="bottom" title="Descargar Archivo" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-download"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>                    
					</tbody>
				</table>
			</div>
			
			<div class="pagrow">	
				<?php 
				if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
				echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
			</div> 
			
		</div>
	</div>  
	
	
	<div class="col-md-4 mail-left-box">
  		<div class="list-group inbox-options">
				<?php 
				$todos = 0;
				foreach ($arrCategorias as $cat) {
					$todos = $todos + $cat['cuenta'];
				} ?>
					
				<div class="list-group-item">Filtro</div>	
				<a href="<?php echo $original.'?pagina=1'; ?>" class="list-group-item">
					<i class="fa fa-inbox"></i> 
					Mostrar Todos
					<span class="badge  bg-primary"><?php echo $todos; ?></span> 
				</a>
					
			<?php foreach ($arrCategorias as $cat) { ?>
				<a href="<?php echo $original.'?pagina=1&filtersender='.$cat['idCategoria']; ?>" class="list-group-item">
					<i class="fa fa-inbox"></i> 
					<?php echo $cat['Nombre']; ?>
					<span class="badge  bg-primary"><?php echo $cat['cuenta']; ?></span> 
				</a>
			<?php } ?>
					
					
  		</div>
	</div> 
							
</div>


<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px; margin-top:30px">
<a href="principal.php" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
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
