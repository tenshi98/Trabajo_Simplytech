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
$original = "informe_facturacion_2.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idCliente';
	$form_trabajo= 'search';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_clientes_pagos.php';
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
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['idCliente']) ) { 
//obtengo los datos del cliente
$query = "SELECT Nombre, Identificador
FROM `clientes_listado`
WHERE idCliente = '{$_GET['idCliente']}' ";
$resultado = mysqli_query ($dbConn, $query);
$rowCliente = mysqli_fetch_assoc ($resultado);

//obtengo las facturaciones 
$arrFacturaciones = array();
$query = "SELECT 
facturacion_listado_detalle.idFacturacionDetalle,
facturacion_listado_detalle.DetalleTotalAPagar, 
facturacion_listado_detalle.AguasInfFechaEmision,
facturacion_listado_detalle.idMes,
facturacion_listado_detalle.Ano,
facturacion_listado_detalle.fechaPago,
facturacion_listado_detalle.montoPago,
facturacion_listado_detalle.SII_NDoc,
clientes_facturable.Nombre AS Facturable,
facturacion_listado_detalle_estado.Nombre AS Estado
FROM `facturacion_listado_detalle`
LEFT JOIN `facturacion_listado_detalle_estado`  ON facturacion_listado_detalle_estado.idEstado   = facturacion_listado_detalle.idEstado
LEFT JOIN `clientes_facturable`                 ON clientes_facturable.idFacturable              = facturacion_listado_detalle.SII_idFacturable
WHERE facturacion_listado_detalle.idCliente = '{$_GET['idCliente']}'
ORDER BY facturacion_listado_detalle.Ano ASC, facturacion_listado_detalle.idMes DESC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturaciones,$row );
}		 ?>
 
<div class="row inbox"> 
	<div class="col-lg-12">
		<h2><strong>Cliente : </strong><?php echo $rowCliente['Identificador']; ?></h2>
		<hr>	
	</div>
</div>
 


  						
	<div class="col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Facturaciones</h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Fecha</th>
							<th>Valor</th>
							<th>Estado</th>
							<th>SII</th>
						</tr>
					</thead>			  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrFacturaciones as $fac) { ?>
						<tr class="odd">
							<td>
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_facturacion.php?view='.$fac['idFacturacionDetalle']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php echo numero_a_mes($fac['idMes']).' '.$fac['Ano']; ?>
							</td>
							<td><?php echo  Valores($fac['DetalleTotalAPagar'], 0); ?></td>
							<td><?php echo $fac['Estado'].' ('.fecha_estandar($fac['fechaPago']).' -> '.Valores($fac['montoPago'], 0).')'; ?></td>
							<td><?php echo $fac['Facturable'].' '.$fac['SII_NDoc']; ?></td>
						</tr>
					<?php } ?>                    
					</tbody>
				</table>
			</div>
		</div>
	</div>  
	
						


 
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" >
	<a href="<?php echo $location; ?>"  class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
	<div class="clearfix"></div>
</div> 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  {
//filtro sistema
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = 'clientes_listado.idSistema>0';
}else{
	$z = 'clientes_listado.idSistema='.$arrUsuario['idSistema'];
}	
	
	
	 ?>
	
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Seleccionar cliente</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1" >
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idCliente)) {        $x1  = $idCliente;        }else{$x1  = '';}
				if(isset($nCliente)) {         $x2  = $nCliente;         }else{$x2  = '';}
				
				
				//se dibujan los inputs
				echo form_select_filter_custom('Cliente','idCliente', $x1, 2, 'idCliente', 'Identificador', 'clientes_listado', $z, 'Identificador', $dbConn);
				
				
				echo '<div class="form-group" id="div_">
					<label class="control-label col-lg-4" id="label_">Nombre Cliente</label>
					<div class="col-lg-8">
						<input type="text" placeholder="Nombre Cliente" class="form-control"  name="nCliente" id="nCliente" disabled value="'.$x2.'">
					</div>
				</div>';
				
				//Imprimo las variables
				$arrClientes = array();
				$query = "SELECT idCliente,Nombre AS NombreCliente
				FROM `clientes_listado`
				WHERE ".$z."
				ORDER BY idCliente";
				$resultado = mysqli_query ($dbConn, $query);
				while ( $row = mysqli_fetch_assoc ($resultado)) {
				array_push( $arrClientes,$row );
				}
				
				echo '<script>';
				foreach ($arrClientes as $tipo) {
					echo 'var nombre_cliente_'.$tipo['idCliente'].'= "'.$tipo['NombreCliente'].'";';	
				}
				
				
			
				?>
				document.getElementById("idCliente").onchange = function() {myFunction()};

				function myFunction() {
					var Componente = document.getElementById("idCliente").value;
					if (Componente != "") {
						nombre_cliente  = eval("nombre_cliente_" + Componente)
						var elem1       = document.getElementById("nCliente");
						elem1.value     = nombre_cliente;
					}
				}
				</script>
				
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Buscar" name="submit">
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
