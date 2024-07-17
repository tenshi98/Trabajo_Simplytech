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
$original = "facturacion_agregar_archivos.php";
$location = $original;
//Se agregan ubicaciones
$location .='?submit_filter=Filtrar';
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){       $location .= "&Ano=".$_GET['Ano'] ; 	}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){   $location .= "&idMes=".$_GET['idMes'] ; }
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
//formulario para editar
if ( !empty($_POST['submit_archivo']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'submit_archivo';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = 'SII_NDoc';
	$form_trabajo= 'del_archivo';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';	
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
<?php 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Archivo subido correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Archivo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['addfile']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT NombreArchivo, ClienteIdentificador
FROM `facturacion_listado_detalle`
WHERE idFacturacionDetalle = {$_GET['addfile']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); ?>
 
 
    
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Subir archivo del cliente <?php echo $rowdata['ClienteIdentificador']; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" name="form1">
			
				<?php   
				//Se verifican si existen los datos
				if(isset($SII_NDoc)) {           $x1  = $SII_NDoc;            }else{$x1  = '';}
			        
				//se dibujan los inputs
				echo form_input_number('Numero Documento','SII_NDoc', $x1, 2);
				
				echo form_input_file('Seleccionar archivo','Archivo');
				?> 

				<div class="form-group">
					<input type="hidden" name="idFacturacionDetalle" value="<?php echo $_GET['addfile']; ?>">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Subir Archivo" name="submit_archivo"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
				</div>
                      
			</form> 
                        
		</div>
	</div>
</div> 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['submit_filter']) ) { 
// Se trae un listado con todos los clientes
$arrFacturacion = array();
$query = "SELECT  
facturacion_listado_detalle.idCliente, 
facturacion_listado_detalle.idFacturacionDetalle,
facturacion_listado_detalle.Fecha,
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

WHERE facturacion_listado_detalle.idMes = {$_GET['idMes']} 
AND facturacion_listado_detalle.Ano = {$_GET['Ano']}

ORDER BY facturacion_listado_detalle.ClienteIdentificador ASC";
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
						<th class="item-name"><strong>Identificador</strong></th>
						<th class="item-name"><strong>Cliente</strong></th>
						<th class="item-name"><strong>Estado Pago</strong></th>
						<th class="item-name"><strong>Estado Cliente</strong></th>
						<th class="item-name"><strong>Documento</strong></th>
						<th class="item-name"><strong>Acciones</strong></th>
					</tr>
				</thead>
					  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrFacturacion as $fact) { ?>
					<tr class="odd">
						<td class="item-name"><?php echo $fact['ClienteIdentificador']; ?></td>
						<td class="item-name"><?php echo $fact['ClienteNombre']; ?></td>
						<td class="item-name"><?php echo $fact['Estado']; ?></td>
						<td class="item-name"><?php echo $fact['ClienteEstado']; ?></td>
						<td class="item-name"><?php echo $fact['DocFacturable']; ?></td>
						<td class="item-name">
							<div class="btn-group widthtd120" >
								<?php 
									echo '<a target="_blank" href="view_facturacion.php?view='.$fact['idFacturacionDetalle'].'&idCliente='.$fact['idCliente'].'" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a>';
									if(isset($fact['NombreArchivo'])&&$fact['NombreArchivo']!=''){
										echo '<a href="upload/'.$fact['NombreArchivo'].'" data-placement="bottom" title="Descargar Archivo" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-download"></i></a>';
										if ($rowlevel['level']>=4){
											$ubicacion = $location.'&del='.$fact['idFacturacionDetalle'];
											$dialogo   = '¿Realmente deseas eliminar el archivo adjunto del cliente '.$fact['ClienteIdentificador'].'?';?>
											<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
										<?php }
									}else{
										if ($rowlevel['level']>=2){
											echo '<a href="'.$location.'&addfile='.$fact['idFacturacionDetalle'].'" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a>';
										}
									}
									
									
								?>
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
				

				//se dibujan los inputs
				echo form_select_n_auto('Año','Ano', $x1, 2, 2016, 2030);
				echo form_select('Mes','idMes', $x1, 2, 'idMes', 'Nombre', 'mnt_meses', 0, $dbConn);
				
						
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
