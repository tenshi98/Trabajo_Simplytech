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
//Cargamos la ubicacion original
$original = "informe_aguas_facturacion_01.php";
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
if(!empty($_GET['submit_filter'])){
// Se trae un listado con todos los productos
$arrFacturacion = array();
$query = "SELECT 
ClienteIdentificador, ClienteNombre,Fecha, DetalleTotalVenta, DetalleTotalAPagar, montoPago
FROM `aguas_facturacion_listado_detalle`
WHERE idMes = ".$_GET['idMes']." 
AND Ano = ".$_GET['Ano']." 
AND idSistema = ".$_SESSION['usuario']['basic_data']['idSistema']."
ORDER BY ClienteIdentificador";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrFacturacion,$row );
} ?>


<div class="col-sm-12 clearfix">
	<?php
	$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&idMes='.$_GET['idMes'];
	$zz .= '&Ano='.$_GET['Ano'];
	?>		
	<a target="new" href="<?php echo 'informe_aguas_facturacion_01_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Facturacion fecha <?php echo Fecha_estandar($arrFacturacion[0]['Fecha']);?></h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>Nombre</th>
						<th width="10">Fecha</th>
						<th width="10">Total Facturado</th>
						<th width="10">Total a Pagar</th>
						<th width="10">Monto Pagado</th>
					</tr>
				</thead>
							  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					$TotalFacturado = 0;
					$TotalPagar     = 0;
					$TotalPagado    = 0;
					foreach ($arrFacturacion as $fact) { 
						//Se suma el total
						$TotalFacturado = $TotalFacturado + $fact['DetalleTotalVenta'];
						$TotalPagar     = $TotalPagar + $fact['DetalleTotalAPagar'];
						$TotalPagado    = $TotalPagado + $fact['montoPago'];
						?>
						<tr class="odd">
							<td><?php echo $fact['ClienteIdentificador']; ?></td>
							<td><?php echo $fact['ClienteNombre']; ?></td>
							<td><?php echo Fecha_estandar($fact['Fecha']); ?></td>
							<td align="right"><?php echo valores($fact['DetalleTotalVenta'], 0); ?></td>
							<td align="right"><?php echo valores($fact['DetalleTotalAPagar'], 0); ?></td>
							<td align="right"><?php if($fact['montoPago']!=0){echo valores($fact['montoPago'], 0);} ?></td>
						</tr>
					<?php } ?>
					<tr class="odd">
						<td colspan="6"></td>
					</tr>
					<tr class="odd">
						<td colspan="3"><strong>Totales</strong></td>
						<td align="right"><strong><?php echo valores($TotalFacturado, 0); ?></strong></td>
						<td align="right"><strong><?php echo valores($TotalPagar, 0); ?></strong></td>
						<td align="right"><strong><?php echo valores($TotalPagado, 0); ?></strong></td>
					</tr> 
				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {?>
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Ano)){    $x1  = $Ano;   }else{$x1  = '';}
				if(isset($idMes)){  $x2  = $idMes; }else{$x2  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_n_auto('Año','Ano', $x1, 2, 2016, ano_actual());
				$Form_Inputs->form_select_filter('Mes','idMes', $x2, 2, 'idMes', 'Nombre', 'core_tiempo_meses', 0, 'idMes ASC', $dbConn);
				
				?>
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="submit_filter">
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
