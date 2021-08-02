<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "informe_aguas_consumo_historico_01.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
// Se trae un listado con todos los productos
//Variable de busqueda
$z      = "WHERE aguas_facturacion_listado_detalle.idFacturacionDetalle!=0";
$search = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Ano']) && $_GET['Ano'] != ''){               
	$z .= " AND aguas_facturacion_listado_detalle.Ano=".$_GET['Ano'];
	$search .= '&Ano='.$_GET['Ano'];
}
if(isset($_GET['idMes']) && $_GET['idMes'] != ''){           
	$z .= " AND aguas_facturacion_listado_detalle.idMes=".$_GET['idMes'];
	$search .= '&idMes='.$_GET['idMes'];
}
if(isset($_GET['idCliente']) && $_GET['idCliente'] != ''){   
	$z .= " AND aguas_facturacion_listado_detalle.idCliente=".$_GET['idCliente'];
	$search .= '&idCliente='.$_GET['idCliente'];
}
		
//obtengo las facturaciones 
$arrConsumos = array();
$query = "SELECT 
aguas_facturacion_listado_detalle.Ano, 
aguas_facturacion_listado_detalle.DetalleConsumoCantidad, 
aguas_facturacion_listado_detalle.DetalleRecoleccionCantidad,
core_tiempo_meses.Nombre AS Mes,
aguas_clientes_listado.Identificador AS ClienteIdentificador,
aguas_clientes_listado.Nombre AS ClienteNombre

FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `core_tiempo_meses`        ON core_tiempo_meses.idMes            = aguas_facturacion_listado_detalle.idMes
LEFT JOIN `aguas_clientes_listado`   ON aguas_clientes_listado.idCliente   = aguas_facturacion_listado_detalle.idCliente
".$z."
ORDER BY aguas_clientes_listado.Identificador ASC, aguas_facturacion_listado_detalle.Ano ASC, aguas_facturacion_listado_detalle.idMes ASC
";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrConsumos,$row );
}
?>


<div class="col-sm-12 clearfix">
	<a target="new" href="<?php echo 'informe_aguas_consumo_historico_01_to_excel.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
</div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Consumo Historico</h5>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>Nombre</th>
						<th width="10">Año</th>
						<th width="10">Mes</th>
						<th width="10">Consumo</th>
						<th width="10">Recoleccion</th>
					</tr>
				</thead>	  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					foreach ($arrConsumos as $fact) {  ?>
						<tr class="odd">
							<td><?php echo $fact['ClienteIdentificador']; ?></td>
							<td><?php echo $fact['ClienteNombre']; ?></td>
							<td><?php echo $fact['Ano']; ?></td>
							<td><?php echo $fact['Mes']; ?></td>
							<td><?php echo cantidades($fact['DetalleConsumoCantidad'], 0); ?></td>
							<td><?php echo cantidades($fact['DetalleRecoleccionCantidad'], 0); ?></td>
						</tr>
					<?php } ?>              
				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Indico el sistema	 
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'].' AND aguas_clientes_listado.idEstado=1';	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Ano)) {        $x1  = $Ano;        }else{$x1  = '';}
				if(isset($idMes)) {      $x2  = $idMes;      }else{$x2  = '';}
				if(isset($idCliente)) {  $x3  = $idCliente;  }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Año','Ano', $x1, 1, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes','idMes', $x2, 1, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'ORDER BY idMes ASC', $dbConn);
				$Form_Inputs->form_select_filter('Cliente','idCliente', $x2, 1, 'idCliente', 'Identificador,Nombre', 'aguas_clientes_listado', $z, 'ORDER BY Identificador ASC', $dbConn);
				
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div> 
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
