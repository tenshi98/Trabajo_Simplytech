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
$original = "informe_aguas_sis_PR031.php";
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
core_sistemas.Rut AS SistemaRut,
aguas_facturacion_listado_detalle.ClienteIdentificador,
aguas_facturacion_listado_detalle.AguasInfUltimoPagoFecha,
aguas_facturacion_listado_detalle.AguasInfUltimoPagoMonto AS Medicion

FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `aguas_clientes_listado`      ON aguas_clientes_listado.idCliente     = aguas_facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema              = aguas_facturacion_listado_detalle.idSistema
WHERE aguas_facturacion_listado_detalle.idMes = ".$_GET['idMes']."
AND aguas_facturacion_listado_detalle.Ano = ".$_GET['Ano']."
AND aguas_facturacion_listado_detalle.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema']."
AND aguas_facturacion_listado_detalle.idEstado = 1
ORDER BY aguas_facturacion_listado_detalle.DetConsMesTotalCantidad ASC
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrFacturacion,$row );
}
//Programacion Cretiva
$informepr = array();
//definicion de variables vacias
for ($x = 1; $x <= 18; $x++) {
	//se define la cantidad de clientes
	$informepr[$x]['Cantidad'] = '';
	//se define el valor de as mediciones
	$informepr[$x]['Medicion'] = 0;
}

function dif_dias($year, $month, $nn, $dia){
	//se construye una fecha
	$mes_ant  = $month - $nn;
	$ano      = $year;
	//verifico que el mes restado sea correcto
	if($mes_ant==0){
		$mes_ant  = 12;
		$ano      = $year - 1;
	}
	//le agrego un cero en caso de ser inferior a 10
	$mes_ant = numero_mes($mes_ant);
	//le agrego un cero en caso de ser inferior a 10
	$dia = numero_dia($dia);
	//construyo la fecha
	$fecha_completa = date("Y-m-d", strtotime($ano.'-'.$mes_ant.'-'.$dia));

	return $fecha_completa;
}
function devolver_tramo($dato){
	switch ($dato) {
		case 1: $data = "1 - 30 días"; break;
		case 2: $data = "31 -60 días"; break;
		case 3: $data = "61 - 90 días"; break;
		case 4: $data = "91 - 180 días"; break;
		case 5: $data = "181 y más días"; break;

	}
	return $data;
}
$errores = '';
foreach ($arrFacturacion as $fact) {
	//saco la diferencia de dias
	$fecha_vencimiento = dif_dias($_GET['Ano'], $_GET['idMes'], 0, 31);

	$ndiasdif = 0;
	//Se verifica si pago despues de la fecha limite
	if($fact['AguasInfUltimoPagoFecha'] < $fecha_vencimiento){
		$ndiasdif = dias_transcurridos($fact['AguasInfUltimoPagoFecha'],$fecha_vencimiento);

		//se da 1 dia de gracia
		$ndiasdif = $ndiasdif - 1;
		//si la resta queda inferior a 0
		if($ndiasdif < 0){
			$ndiasdif = 0;
		}
		//listo los errores
		$errores .= 'Cliente '.$fact['ClienteIdentificador'].' : '.$fact['AguasInfUltimoPagoFecha'].' - '.$fecha_vencimiento.' = '.$ndiasdif.'<br/>';
	}

	//separo por codigo de rango
	if($ndiasdif==0){
		$informepr[0]['Cantidad']++;
		$informepr[0]['Medicion'] = $informepr[0]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>0 && $ndiasdif<=30){
		$informepr[1]['Cantidad']++;
		$informepr[1]['Medicion'] = $informepr[1]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>30 && $ndiasdif<=60){
		$informepr[2]['Cantidad']++;
		$informepr[2]['Medicion'] = $informepr[2]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>60 && $ndiasdif<=90){
		$informepr[3]['Cantidad']++;
		$informepr[3]['Medicion'] = $informepr[3]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>90 && $ndiasdif<=180){
		$informepr[4]['Cantidad']++;
		$informepr[4]['Medicion'] = $informepr[4]['Medicion'] + $fact['Medicion'];
	}elseif($ndiasdif>180){
		$informepr[5]['Cantidad']++;
		$informepr[5]['Medicion'] = $informepr[5]['Medicion'] + $fact['Medicion'];
	}

}

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
	<?php
	$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&idMes='.$_GET['idMes'];
	$zz .= '&Ano='.$_GET['Ano'];
	?>
	<a target="new" href="<?php echo 'informe_aguas_sis_PR031_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'informe_aguas_sis_PR031_to_xml.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-warning pull-right margin_width"><i class="fa fa-file-code-o" aria-hidden="true"></i> Exportar a XML</a>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Informe SIS PR031</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>codigoProceso</th>
						<th>codigoArchivo</th>
						<th>rut</th>
						<th>periodo</th>
						<th>codigoLocalidad</th>
						<th>tramoMorosidad</th>
						<th>Detalle</th>
						<th>MontoDeuda</th>
						<th>NumClientes</th>
					</tr>
				</thead>

				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php
					$total1 = 0;
					$clientes = 0;
					for ($x = 1; $x <= 18; $x++) {
						if(isset($informepr[$x]['Cantidad'])&&$informepr[$x]['Cantidad']!=''){
							//se suman los totales de las mediciones y los clientes
							$total1 = $total1 + $informepr[$x]['Medicion'];
							$clientes = $clientes + $informepr[$x]['Cantidad'];
							$rut = substr($arrFacturacion[0]['SistemaRut'], 0, -2);
							?>
							<tr class="odd">
								<td>15</td>
								<td>1</td>
								<td><?php echo $rut ?></td>
								<td><?php echo $_GET['Ano'].numero_mes($_GET['idMes']); ?></td>
								<td>393</td>
								<td><?php echo $x ?></td>
								<td><?php echo devolver_tramo($x) ?></td>
								<td><?php echo $informepr[$x]['Medicion']; ?></td>
								<td><?php echo $informepr[$x]['Cantidad']; ?></td>
							</tr>
						<?php
						}
					}
					?>

					<tr class="odd">
						<td colspan="13"></td>
					</tr>
					<tr class="odd">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo $total1; ?></td>
						<td><?php echo $clientes; ?></td>
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
