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
$original = "principal_notificaciones.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){               $location .= "&search=".$_GET['search'] ; 	}
if(isset($_GET['filtersender']) && $_GET['filtersender'] != ''){   $location .= "&filtersender=".$_GET['filtersender'] ; 	}
//variable con el nombre de la categoria de la transaccion
$rowlevel['nombre_categoria']='Principal';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//se borra un dato
if ( !empty($_GET['id']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'aprobar_uno';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_notificaciones.php';	
}
//se borra un dato
if ( !empty($_GET['all']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'aprobar_todos';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_notificaciones.php';	
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
            <h3><i class="fa fa-info"></i> Notificaciones</h3>
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
if (isset($_GET['aprobar_uno']))    {$error['aprobar_uno'] 	  = 'sucess/Se ha marcado como visto un elemento';}
if (isset($_GET['aprobar_todos']))  {$error['aprobar_todos']  = 'sucess/Se han marcado como visto todos los elementos';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//Se inicializa el paginador de resultados
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
//Variable con la ubicacion
$z="WHERE notificaciones_ver.idNoti>=0";
$w="WHERE notificaciones_ver.idNoti>=0";
if (isset($_GET['filtersender'])){
	if($_GET['filtersender']=='admin'){
		$z.=" AND notificaciones_ver.idNotificaciones = 0";
	}else{
		$z.=" AND notificaciones_listado.idUsuario = {$_GET['filtersender']}";
	}		
}

//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND notificaciones_ver.idSistema>=0";	
	$z.=" AND notificaciones_ver.idUsuario>=0";	
	$w.=" AND notificaciones_ver.idSistema>=0";	
	$w.=" AND notificaciones_ver.idUsuario>=0";
}else{
	$z.=" AND notificaciones_ver.idSistema={$arrUsuario['idSistema']}";
	$z.=" AND notificaciones_ver.idUsuario={$arrUsuario['idUsuario']}";
	$w.=" AND notificaciones_ver.idSistema={$arrUsuario['idSistema']}";
	$w.=" AND notificaciones_ver.idUsuario={$arrUsuario['idUsuario']}";		
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT notificaciones_ver.idNoti FROM `notificaciones_ver` 
LEFT JOIN `notificaciones_listado`  ON notificaciones_listado.idNotificaciones   = notificaciones_ver.idNotificaciones
".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrTipo = array();
$query = "SELECT 
notificaciones_ver.idNoti,
notificaciones_ver.Fecha,
notificaciones_ver.Notificacion,
notificaciones_ver.idEstado,
notificaciones_estado.Nombre AS Estado
FROM `notificaciones_ver`
LEFT JOIN `notificaciones_estado`   ON notificaciones_estado.idEstado            = notificaciones_ver.idEstado
LEFT JOIN `notificaciones_listado`  ON notificaciones_listado.idNotificaciones   = notificaciones_ver.idNotificaciones
".$z."
ORDER BY notificaciones_ver.idEstado ASC, notificaciones_ver.Fecha DESC, notificaciones_ver.idNoti ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipo,$row );
}

//obtengo los usuarios que enviaron la notificacion
$arrCategorias = array();
$query = "SELECT
notificaciones_listado.idUsuario AS idusuario,
usuarios_listado.Nombre AS usuario,
count(notificaciones_ver.idNotificaciones)AS cuenta
FROM `notificaciones_ver`
LEFT JOIN `notificaciones_listado`  ON notificaciones_listado.idNotificaciones   = notificaciones_ver.idNotificaciones
LEFT JOIN `usuarios_listado`        ON usuarios_listado.idUsuario                = notificaciones_listado.idUsuario
".$w."
GROUP BY usuarios_listado.Nombre";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrCategorias,$row );
}





?>
  

<div class="row inbox">
  						
	<div class="col-lg-8">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Notificaciones</h5>
				<div class="toolbar">
					<a href="<?php echo $location.'&all='.$arrUsuario['idUsuario']; ?>" class="btn btn-xs btn-primary">Marcar Todos Leidos</a>
				</div>
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
							<th>Fecha</th>
							<th>Notificacion</th>
							<th>Estado</th>
							<th width="120">Acciones</th>
						</tr>
					</thead>			  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
						<tr class="odd">
							<td><?php echo $tipo['Fecha']; ?></td>
							<td class="tdpaddinright"><?php echo $tipo['Notificacion']; ?></td>
							<td><?php echo $tipo['Estado']; ?></td>
							<td>
								<div class="btn-group" >
									<?php if ($tipo['idEstado']==1){?><a href="<?php echo $location.'&id='.$tipo['idNoti']; ?>" data-placement="bottom" title="Marcar como leido" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-check-square-o"></i></a><?php } ?>
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
				<?php if($cat['usuario']!=''){ ?>
					<a href="<?php echo $original.'?pagina=1&filtersender='.$cat['idusuario']; ?>" class="list-group-item">
						<i class="fa fa-inbox"></i> 
						<?php echo $cat['usuario']; ?>
						<span class="badge  bg-primary"><?php echo $cat['cuenta']; ?></span> 
					</a>
				<?php }else{ ?>
					<a href="<?php echo $original.'?pagina=1&filtersender=admin'; ?>" class="list-group-item">
						<i class="fa fa-inbox"></i> 
						Administrador
						<span class="badge  bg-primary"><?php echo $cat['cuenta']; ?></span> 
					</a>
				<?php } ?>	
			<?php } ?>
					
					
  		</div>
	</div> 
							
</div>
  							
  							
  							
  							




                     
                                 

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
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
