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
$original = "informe_aguas_sis_PR02701.php";
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
aguas_facturacion_listado_detalle.idCliente,
aguas_clientes_listado.idTipo AS tipoCliente,
aguas_facturacion_listado_detalle.DetConsMesTotalCantidad AS Medicion

FROM `aguas_facturacion_listado_detalle`
LEFT JOIN `aguas_clientes_listado`      ON aguas_clientes_listado.idCliente     = aguas_facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema              = aguas_facturacion_listado_detalle.idSistema
WHERE aguas_facturacion_listado_detalle.idMes = ".$_GET['idMes']."
AND aguas_facturacion_listado_detalle.Ano = ".$_GET['Ano']."
AND aguas_facturacion_listado_detalle.idSistema = ".$_SESSION['usuario']['basic_data']['idSistema']."
ORDER BY aguas_facturacion_listado_detalle.DetConsMesTotalCantidad ASC";
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
for ($i = 1; $i <= 5; $i++) {
	for ($x = 1; $x <= 18; $x++) {
		//se define la cantidad de clientes
		$informepr[$i][$x]['Cantidad'] = '';
		//se define el valor de as mediciones
		$informepr[$i][$x]['Medicion'] = 0;
	}
}

foreach ($arrFacturacion as $fact) {
	//separo por codigo de rango
	if($fact['Medicion']==0){
		$informepr[$fact['tipoCliente']][1]['Cantidad']++;
		$informepr[$fact['tipoCliente']][1]['Medicion'] = $informepr[$fact['tipoCliente']][1]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>0 && $fact['Medicion']<=10){
		$informepr[$fact['tipoCliente']][2]['Cantidad']++;
		$informepr[$fact['tipoCliente']][2]['Medicion'] = $informepr[$fact['tipoCliente']][2]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>10 && $fact['Medicion']<=15){
		$informepr[$fact['tipoCliente']][3]['Cantidad']++;
		$informepr[$fact['tipoCliente']][3]['Medicion'] = $informepr[$fact['tipoCliente']][3]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>15 && $fact['Medicion']<=20){
		$informepr[$fact['tipoCliente']][4]['Cantidad']++;
		$informepr[$fact['tipoCliente']][4]['Medicion'] = $informepr[$fact['tipoCliente']][4]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>20 && $fact['Medicion']<=30){
		$informepr[$fact['tipoCliente']][5]['Cantidad']++;
		$informepr[$fact['tipoCliente']][5]['Medicion'] = $informepr[$fact['tipoCliente']][5]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>30 && $fact['Medicion']<=40){
		$informepr[$fact['tipoCliente']][6]['Cantidad']++;
		$informepr[$fact['tipoCliente']][6]['Medicion'] = $informepr[$fact['tipoCliente']][6]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>40 && $fact['Medicion']<=50){
		$informepr[$fact['tipoCliente']][7]['Cantidad']++;
		$informepr[$fact['tipoCliente']][7]['Medicion'] = $informepr[$fact['tipoCliente']][7]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>50 && $fact['Medicion']<=60){
		$informepr[$fact['tipoCliente']][8]['Cantidad']++;
		$informepr[$fact['tipoCliente']][8]['Medicion'] = $informepr[$fact['tipoCliente']][8]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>60 && $fact['Medicion']<=70){
		$informepr[$fact['tipoCliente']][9]['Cantidad']++;
		$informepr[$fact['tipoCliente']][9]['Medicion'] = $informepr[$fact['tipoCliente']][9]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>70 && $fact['Medicion']<=80){
		$informepr[$fact['tipoCliente']][10]['Cantidad']++;
		$informepr[$fact['tipoCliente']][10]['Medicion'] = $informepr[$fact['tipoCliente']][10]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>80 && $fact['Medicion']<=120){
		$informepr[$fact['tipoCliente']][11]['Cantidad']++;
		$informepr[$fact['tipoCliente']][11]['Medicion'] = $informepr[$fact['tipoCliente']][11]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>120 && $fact['Medicion']<=160){
		$informepr[$fact['tipoCliente']][12]['Cantidad']++;
		$informepr[$fact['tipoCliente']][12]['Medicion'] = $informepr[$fact['tipoCliente']][12]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>160 && $fact['Medicion']<=200){
		$informepr[$fact['tipoCliente']][13]['Cantidad']++;
		$informepr[$fact['tipoCliente']][13]['Medicion'] = $informepr[$fact['tipoCliente']][13]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>200 && $fact['Medicion']<=240){
		$informepr[$fact['tipoCliente']][14]['Cantidad']++;
		$informepr[$fact['tipoCliente']][14]['Medicion'] = $informepr[$fact['tipoCliente']][14]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>240 && $fact['Medicion']<=280){
		$informepr[$fact['tipoCliente']][15]['Cantidad']++;
		$informepr[$fact['tipoCliente']][15]['Medicion'] = $informepr[$fact['tipoCliente']][15]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>280 && $fact['Medicion']<=300){
		$informepr[$fact['tipoCliente']][16]['Cantidad']++;
		$informepr[$fact['tipoCliente']][16]['Medicion'] = $informepr[$fact['tipoCliente']][16]['Medicion'] + $fact['Medicion'];
	}elseif($fact['Medicion']>300 ){
		$informepr[$fact['tipoCliente']][17]['Cantidad']++;
		$informepr[$fact['tipoCliente']][17]['Medicion'] = $informepr[$fact['tipoCliente']][17]['Medicion'] + $fact['Medicion'];
	}else{
		$informepr[$fact['tipoCliente']][18]['Cantidad']++;
		$informepr[$fact['tipoCliente']][18]['Medicion'] = $informepr[$fact['tipoCliente']][18]['Medicion'] + $fact['Medicion'];

	}

}?>


<div class="col-sm-12 clearfix">
	<?php
	$zz  = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&idMes='.$_GET['idMes'];
	$zz .= '&Ano='.$_GET['Ano'];
	?>
	<a target="new" href="<?php echo 'informe_aguas_sis_PR02701_to_excel.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	<a target="new" href="<?php echo 'informe_aguas_sis_PR02701_to_xml.php?bla=bla'.$zz ; ?>" class="btn btn-sm btn-warning pull-right margin_width"><i class="fa fa-file-code-o" aria-hidden="true"></i> Exportar a XML</a>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Informe SIS PR02701</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>codigoProceso</th>
						<th>codigoArchivo</th>
						<th>rut</th>
						<th>periodo</th>
						<th>codigoLimite</th>
						<th>codigoLocalidad</th>
						<th>codigoComuna</th>
						<th>tipoCliente</th>
						<th>tipoServicio</th>
						<th>codigoRango</th>
						<th>MetrosCubicosAP</th>
						<th>MetrosCubicosAS</th>
						<th>CantidadClientes</th>
					</tr>
				</thead>

				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php
					$total1 = 0;
					$total2 = 0;
					$clientes = 0;
					for ($i = 1; $i <= 5; $i++) {
						for ($x = 1; $x <= 18; $x++) {
							if(isset($informepr[$i][$x]['Cantidad'])&&$informepr[$i][$x]['Cantidad']!=''){
								//se suman los totales de las mediciones y los clientes
								$total1 = $total1 + $informepr[$i][$x]['Medicion'];
								$total2 = $total2 + $informepr[$i][$x]['Medicion'];
								$clientes = $clientes + $informepr[$i][$x]['Cantidad'];

								$rut = substr($arrFacturacion[0]['SistemaRut'], 0, -2);
								?>
								<tr class="odd">
									<td>3</td>
									<td>9</td>
									<td><?php echo $rut ?></td>
									<td><?php echo $_GET['Ano'].numero_mes($_GET['idMes']); ?></td>
									<td>7</td>
									<td>393</td>
									<td>13115</td>
									<td><?php echo $i ?></td>
									<td>3</td>
									<td><?php echo $x ?></td>
									<td><?php echo $informepr[$i][$x]['Medicion']; ?></td>
									<td><?php echo $informepr[$i][$x]['Medicion']; ?></td>
									<td><?php echo $informepr[$i][$x]['Cantidad']; ?></td>
								</tr>
							<?php
							}
						}
					}?>

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
						<td></td>
						<td></td>
						<td></td>
						<td><?php echo $total1; ?></td>
						<td><?php echo $total2; ?></td>
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
