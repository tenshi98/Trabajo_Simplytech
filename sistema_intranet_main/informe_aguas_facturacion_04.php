<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
$original = "informe_aguas_facturacion_04.php";
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
	/*******************************************************/
	// consulto los datos
	$SIS_query = '
	ClienteIdentificador,
	DetalleCargoFijoValor, DetalleConsumoValor, DetalleRecoleccionValor,
	DetalleVisitaCorte, DetalleCorte1Valor, DetalleCorte2Valor, DetalleReposicion1Valor, DetalleReposicion2Valor,
	DetalleInteresDeuda,
	DetalleOtrosCargos1Valor, DetalleOtrosCargos2Valor, DetalleOtrosCargos3Valor,DetalleOtrosCargos4Valor, DetalleOtrosCargos5Valor,
	DetalleTotalAPagar,
	Fecha';
	$SIS_join  = '';
	$SIS_where = 'idMes = '.$_GET['idMes'];
	$SIS_where.= ' AND Ano = '.$_GET['Ano'];
	$SIS_where.= ' AND idSistema = '.$_SESSION['usuario']['basic_data']['idSistema'];
	$SIS_order = 'ClienteIdentificador ASC';
	$arrFacturacion = array();
	$arrFacturacion = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrFacturacion');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
		<?php
		$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
		$zz .= '&idMes='.$_GET['idMes'];
		$zz .= '&Ano='.$_GET['Ano'];
		?>
		<a target="new" href="<?php echo 'informe_aguas_facturacion_04_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5>Facturacion Mes de <?php echo Fecha_mes_ano($arrFacturacion[0]['Fecha']); ?></h5>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Identificador</th>
							<th width="10">Consumo mes</th>
							<th width="10">Otros Cargos</th>
							<th width="10">Intereses</th>
							<th width="10">Total Con IVA</th>
							<th width="10">IVA</th>
							<th width="10">Total Sin IVA</th>
						</tr>
					</thead>

					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php
						//variables en 0
						$t_consumo_mes  = 0;
						$t_OtrosCargos  = 0;
						$t_Intereses    = 0;
						$t_TotalConIva  = 0;
						$t_iva          = 0;
						$t_TotalSinIva  = 0;
						//se recorre arreglo
						foreach ($arrFacturacion as $fact) {
							//Se hacen los calculos
							$consumo_mes  = $fact['DetalleCargoFijoValor'] + $fact['DetalleConsumoValor'] + $fact['DetalleRecoleccionValor'];
							$OtrosCargos  = $fact['DetalleVisitaCorte'] + $fact['DetalleCorte1Valor'] + $fact['DetalleCorte2Valor'] + $fact['DetalleReposicion1Valor'] + $fact['DetalleReposicion2Valor'] + $fact['DetalleOtrosCargos1Valor'] + $fact['DetalleOtrosCargos2Valor'] + $fact['DetalleOtrosCargos3Valor'] + $fact['DetalleOtrosCargos4Valor'] + $fact['DetalleOtrosCargos5Valor'];
							$Intereses    = $fact['DetalleInteresDeuda'];
							$TotalConIva  = $consumo_mes + $OtrosCargos + $Intereses;
							$iva          = $TotalConIva - ($TotalConIva / 1.19);
							$TotalSinIva  = $TotalConIva / 1.19;
							//se guardan totales
							$t_consumo_mes  = $t_consumo_mes + $consumo_mes;
							$t_OtrosCargos  = $t_OtrosCargos + $OtrosCargos;
							$t_Intereses    = $t_Intereses + $Intereses;
							$t_TotalConIva  = $t_TotalConIva + $TotalConIva;
							$t_iva          = $t_iva + $iva;
							$t_TotalSinIva  = $t_TotalSinIva + $TotalSinIva;
							?>
							<tr class="odd">
								<td><?php echo $fact['ClienteIdentificador']; ?></td>
								<td align="right"><?php echo valores($consumo_mes, 0); ?></td>
								<td align="right"><?php echo valores($OtrosCargos, 0); ?></td>
								<td align="right"><?php echo valores($Intereses, 0); ?></td>
								<td align="right"><?php echo valores($TotalConIva, 0); ?></td>
								<td align="right"><?php echo valores($iva, 0); ?></td>
								<td align="right"><?php echo valores($TotalSinIva, 0); ?></td>
							</tr>
						<?php } ?>
						<tr class="odd">
							<td colspan="7"></td>
						</tr>
						<tr class="odd">
							<td>Totales</td>
							<td align="right"><?php echo valores($t_consumo_mes, 0); ?></td>
							<td align="right"><?php echo valores($t_OtrosCargos, 0); ?></td>
							<td align="right"><?php echo valores($t_Intereses, 0); ?></td>
							<td align="right"><?php echo valores($t_TotalConIva, 0); ?></td>
							<td align="right"><?php echo valores($t_iva, 0); ?></td>
							<td align="right"><?php echo valores($t_TotalSinIva, 0); ?></td>
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
}else{ ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Filtro de Búsqueda</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>

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
