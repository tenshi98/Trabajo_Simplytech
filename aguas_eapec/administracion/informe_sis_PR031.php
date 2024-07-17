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
$original = "informe_sis_PR031.php";
$location = $original;
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
if ( ! empty($_GET['submit_filter']) ) { 
// Se trae un listado con todos los usuarios
$arrFacturacion = array();
$query = "SELECT
core_sistemas.Rut AS SistemaRut,
facturacion_listado_detalle.ClienteIdentificador, 
facturacion_listado_detalle.AguasInfUltimoPagoFecha,
facturacion_listado_detalle.AguasInfUltimoPagoMonto AS Medicion

FROM `facturacion_listado_detalle`
LEFT JOIN `clientes_listado`      ON clientes_listado.idCliente     = facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`         ON core_sistemas.idSistema        = facturacion_listado_detalle.idSistema
WHERE idMes = {$_GET['idMes']} 
AND Ano = {$_GET['Ano']}
AND facturacion_listado_detalle.idEstado = 1
ORDER BY facturacion_listado_detalle.DetConsMesTotalCantidad ASC


";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
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

/*function dif_dias($year, $month, $nn, $dia){
	//se construye una fecha
	$mes_ant  = $month - $nn;
	$ano      = $year;
	//verifico que el mes restado sea correcto
	if($mes_ant==0){
		$mes_ant  = 12;
		$ano      = $year - 1;
	}
	//le agrego un cero en caso de ser inferior a 10
	if($mes_ant < 10){
		$mes_ant = '0'.$mes_ant;
	}
	//le agrego un cero en caso de ser inferior a 10
	if($dia < 10){
		$dia = '0'.$dia;
	}
	//construyo la fecha
	return $fecha_completa = $ano.'-'.$mes_ant.'-'.$dia;				
}*/
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
	//$fecha_vencimiento = dif_dias($_GET['Ano'], $_GET['idMes'], 0, 31);
	
	//The 4th of February 2014.
	$dateString = $_GET['Ano'].'-'.$_GET['idMes'].'-04';

	//Last date of current month.
	$fecha_vencimiento = date("Y-m-t", strtotime($dateString));




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
 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Informe SIS PR02701</h5>
			<div class="toolbar">
				<?php
				$zz  = '?idSistema='.$arrUsuario['idSistema'];
				$zz .= '&idMes='.$_GET['idMes'];
				$zz .= '&Ano='.$_GET['Ano'];
				?>
				<a target="new" href="informe_sis_PR031_to_excel.php<?php echo $zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
			</div>
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
								<td><?php if($_GET['idMes']>9){echo $_GET['Ano'].$_GET['idMes'];}else{echo $_GET['Ano'].'0'.$_GET['idMes'];} ?></td>
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
