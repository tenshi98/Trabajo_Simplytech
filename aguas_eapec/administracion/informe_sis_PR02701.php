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
$original = "informe_sis_PR02701.php";
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
facturacion_listado_detalle.idCliente, 
clientes_listado.idTipo AS tipoCliente,
facturacion_listado_detalle.DetConsMesTotalCantidad AS Medicion


FROM `facturacion_listado_detalle`
LEFT JOIN `clientes_listado`      ON clientes_listado.idCliente     = facturacion_listado_detalle.idCliente
LEFT JOIN `core_sistemas`         ON core_sistemas.idSistema        = facturacion_listado_detalle.idSistema
WHERE idMes = {$_GET['idMes']} 
AND Ano = {$_GET['Ano']}
ORDER BY facturacion_listado_detalle.DetConsMesTotalCantidad ASC


";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
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
				<a target="new" href="informe_sis_PR02701_to_excel.php<?php echo $zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
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
									<td><?php if($_GET['idMes']>9){echo $_GET['Ano'].$_GET['idMes'];}else{echo $_GET['Ano'].'0'.$_GET['idMes'];} ?></td>
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
