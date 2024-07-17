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
$original = "informe_gerencial_1.php";
$location = $original;    
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
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
// Se trae un listado con los valores de las existencias actuales
$año_pasado = ano_actual()-1;
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "WHERE idSistema>=0";
	$z.= " AND Creacion_ano >= ".$año_pasado;
}else{
	$z = "WHERE idSistema='{$arrUsuario['idSistema']}'";
	$z.= " AND Creacion_ano >= ".$año_pasado;
}
//se consulta
$arrExistencias = array();
$query = "SELECT Creacion_ano,Creacion_mes,Cantidad_ing,Cantidad_eg,idTipo,SUM(ValorTotal) AS Valor
FROM `bodegas_facturacion_existencias`
".$z."
GROUP BY Creacion_ano,Creacion_mes,idTipo
ORDER BY Creacion_ano ASC, Creacion_mes ASC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrExistencias,$row );
}

// Se trae un listado con todos los stock
if($arrUsuario['tipo']=='SuperAdmin'){
	$z = "WHERE bodegas_facturacion_existencias.idSistema>=0";
}else{
	$z = "WHERE bodegas_facturacion_existencias.idSistema={$arrUsuario['idSistema']}";
}
//se consulta
$arrProductos = array();
$query = "SELECT
productos_listado.StockLimite,
productos_listado.Nombre AS NombreProd,
productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `productos_listado`          ON productos_listado.idProducto             = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`              ON productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `bodegas_listado`            ON bodegas_listado.idBodega                 = bodegas_facturacion_existencias.idBodega

".$z."
GROUP BY bodegas_facturacion_existencias.idProducto";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
}
//se consulta
$arrProductosOt = array();
$query = "SELECT
productos_listado.Nombre AS NombreProd,
productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `productos_listado`          ON productos_listado.idProducto             = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`              ON productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `bodegas_listado`            ON bodegas_listado.idBodega                 = bodegas_facturacion_existencias.idBodega

".$z." AND idOT!=''
GROUP BY bodegas_facturacion_existencias.idProducto";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductosOt,$row );
}	
		
	

$mes = array();
foreach ($arrExistencias as $existencias) { 
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] = 0;}
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'] = 0;}
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'] = 0;}
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspaso'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspaso'] = 0;}
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspasooe'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspasooe'] = 0;}
	if(!isset($mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['otrabajo'])){ $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['otrabajo'] = 0;}
	switch ($existencias['idTipo']) {
		//Ingresos
		case 1:
			$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] + $existencias['Valor'];
			break;
		//Egreso
		case 2:
			$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['egreso'] + $existencias['Valor'];
			break;
		//gasto
		case 3:
			$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['gasto'] + $existencias['Valor'];
			break;
		//traspaso
		case 4:
			$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspaso'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspaso'] + $existencias['Valor'];
			break;
		//transformacion
		case 5:
			break;
		//traspaso otra empresa
		case 6:
			if($existencias['Cantidad_ing']!=0){
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['ingreso'] + $existencias['Valor'];
			}else{
				$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspasooe'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['traspasooe'] + $existencias['Valor'];
			}
			break;
		//gasto de materiales OT
		case 7:
			$mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['otrabajo'] = $mes[$existencias['Creacion_ano']][$existencias['Creacion_mes']]['otrabajo'] + $existencias['Valor'];
			break;
	}								
}
								
$xmes = mes_actual();
$xaño = ano_actual();
$grafico = array();
for ($xcontador = 12; $xcontador > 0; $xcontador--) {
									
	if($xmes>0){
		if(isset($mes[$xaño][$xmes]['ingreso'])){    $ndata1 = $mes[$xaño][$xmes]['ingreso'];     }else{$ndata1 = 0;};
		if(isset($mes[$xaño][$xmes]['egreso'])){     $ndata2 = $mes[$xaño][$xmes]['egreso'];      }else{$ndata2 = 0;};
		if(isset($mes[$xaño][$xmes]['gasto'])){      $ndata3 = $mes[$xaño][$xmes]['gasto'];       }else{$ndata3 = 0;};
		if(isset($mes[$xaño][$xmes]['traspaso'])){   $ndata4 = $mes[$xaño][$xmes]['traspaso'];    }else{$ndata4 = 0;};
		if(isset($mes[$xaño][$xmes]['traspasooe'])){ $ndata5 = $mes[$xaño][$xmes]['traspasooe'];  }else{$ndata5 = 0;};
		if(isset($mes[$xaño][$xmes]['otrabajo'])){   $ndata6 = $mes[$xaño][$xmes]['otrabajo'];    }else{$ndata6 = 0;};
		
		$grafico[$xcontador]['mes'] = $xmes;
		$grafico[$xcontador]['año'] = $xaño;
		$grafico[$xcontador]['ingreso'] = $ndata1;
		$grafico[$xcontador]['egreso'] = $ndata2;
		$grafico[$xcontador]['gasto'] = $ndata3;
		$grafico[$xcontador]['traspaso'] = $ndata4;
		$grafico[$xcontador]['traspasooe'] = $ndata5;
		$grafico[$xcontador]['otrabajo'] = $ndata6;
										
	}else{
		$xmes = 12;
		$xaño = $xaño-1;
		
		if(isset($mes[$xaño][$xmes]['ingreso'])){     $ndata1 = $mes[$xaño][$xmes]['ingreso'];     }else{$ndata1 = 0;};
		if(isset($mes[$xaño][$xmes]['egreso'])){      $ndata2 = $mes[$xaño][$xmes]['egreso'];      }else{$ndata2 = 0;};
		if(isset($mes[$xaño][$xmes]['gasto'])){       $ndata3 = $mes[$xaño][$xmes]['gasto'];       }else{$ndata3 = 0;};
		if(isset($mes[$xaño][$xmes]['traspaso'])){    $ndata4 = $mes[$xaño][$xmes]['traspaso'];    }else{$ndata4 = 0;};
		if(isset($mes[$xaño][$xmes]['traspasooe'])){  $ndata5 = $mes[$xaño][$xmes]['traspasooe'];  }else{$ndata5 = 0;};
		if(isset($mes[$xaño][$xmes]['otrabajo'])){    $ndata6 = $mes[$xaño][$xmes]['otrabajo'];    }else{$ndata6 = 0;};
		
		$grafico[$xcontador]['mes'] = $xmes;
		$grafico[$xcontador]['año'] = $xaño;
		$grafico[$xcontador]['ingreso'] = $ndata1;
		$grafico[$xcontador]['egreso'] = $ndata2;
		$grafico[$xcontador]['gasto'] = $ndata3;
		$grafico[$xcontador]['traspaso'] = $ndata4;
		$grafico[$xcontador]['traspasooe'] = $ndata5;
		$grafico[$xcontador]['otrabajo'] = $ndata6;
	}
	$xmes = $xmes-1;								
}

?>
 
<div class="row">    
    <div class="col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Bodega Materiales</h5>        		  
			</header>  

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				google.charts.load("current", {packages:['corechart']});
			</script>
								
			<div class="row">

				<?php 
				$total = 0;
				$total = $total + $grafico[1]['ingreso'];
				$total = $total + $grafico[2]['ingreso'];
				$total = $total + $grafico[3]['ingreso'];
				$total = $total + $grafico[4]['ingreso'];
				$total = $total + $grafico[5]['ingreso'];
				$total = $total + $grafico[6]['ingreso'];
				$total = $total + $grafico[7]['ingreso'];
				$total = $total + $grafico[8]['ingreso'];
				$total = $total + $grafico[9]['ingreso'];
				$total = $total + $grafico[10]['ingreso'];
				$total = $total + $grafico[11]['ingreso'];
				$total = $total + $grafico[12]['ingreso'];
				
				if($total!=0){?>
					<div class="col-md-12">
									<script type="text/javascript">
										google.charts.setOnLoadCallback(drawChart);
										function drawChart() {
										  var data = google.visualization.arrayToDataTable([
											["Mes", "Valor", { role: 'style' } ],
											["<?php echo numero_a_mes($grafico[1]['mes'])?>", <?php echo valores_enteros($grafico[1]['ingreso']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[2]['mes'])?>", <?php echo valores_enteros($grafico[2]['ingreso']) ?>, '#FF8000'],
											["<?php echo numero_a_mes($grafico[3]['mes'])?>", <?php echo valores_enteros($grafico[3]['ingreso']) ?>, '#FFFF00'],
											["<?php echo numero_a_mes($grafico[4]['mes'])?>", <?php echo valores_enteros($grafico[4]['ingreso']) ?>, '#00FF00'],
											["<?php echo numero_a_mes($grafico[5]['mes'])?>", <?php echo valores_enteros($grafico[5]['ingreso']) ?>, '#00FFBF'],
											["<?php echo numero_a_mes($grafico[6]['mes'])?>", <?php echo valores_enteros($grafico[6]['ingreso']) ?>, '#0080FF'],
											["<?php echo numero_a_mes($grafico[7]['mes'])?>", <?php echo valores_enteros($grafico[7]['ingreso']) ?>, '#0000FF'],
											["<?php echo numero_a_mes($grafico[8]['mes'])?>", <?php echo valores_enteros($grafico[8]['ingreso']) ?>, '#9A2EFE'],
											["<?php echo numero_a_mes($grafico[9]['mes'])?>", <?php echo valores_enteros($grafico[9]['ingreso']) ?>, '#FF00FF'],
											["<?php echo numero_a_mes($grafico[10]['mes'])?>", <?php echo valores_enteros($grafico[10]['ingreso']) ?>, '#FF0040'],
											["<?php echo numero_a_mes($grafico[11]['mes'])?>", <?php echo valores_enteros($grafico[11]['ingreso']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[12]['mes'])?>", <?php echo valores_enteros($grafico[12]['ingreso']) ?>, '#FF8000']
										  ]);

										  var view = new google.visualization.DataView(data);
										  view.setColumns([0, 1,
														   { calc: "stringify",
															 sourceColumn: 1,
															 type: "string",
															 role: "annotation" },
															2]);

										  var options = {
											title: "Ingresos",
											bar: {groupWidth: "95%"},
											legend: { position: "none" },
										  };
										  var chart = new google.visualization.ColumnChart(document.getElementById("grafIngresos"));
										  chart.draw(view, options);
									  }
									  
									</script>
									<div id="grafIngresos" style="width: 100%; height: 500px;"></div>
					</div>								
				<?php }
				
				$total = 0;
				$total = $total + $grafico[1]['egreso'];
				$total = $total + $grafico[2]['egreso'];
				$total = $total + $grafico[3]['egreso'];
				$total = $total + $grafico[4]['egreso'];
				$total = $total + $grafico[5]['egreso'];
				$total = $total + $grafico[6]['egreso'];
				$total = $total + $grafico[7]['egreso'];
				$total = $total + $grafico[8]['egreso'];
				$total = $total + $grafico[9]['egreso'];
				$total = $total + $grafico[10]['egreso'];
				$total = $total + $grafico[11]['egreso'];
				$total = $total + $grafico[12]['egreso'];
				
				if($total!=0){?>	
				
					<div class="col-md-12">								
									<script type="text/javascript">
										google.charts.setOnLoadCallback(drawChart);
										function drawChart() {
										  var data = google.visualization.arrayToDataTable([
											["Mes", "Valor", { role: 'style' } ],
											["<?php echo numero_a_mes($grafico[1]['mes'])?>", <?php echo valores_enteros($grafico[1]['egreso']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[2]['mes'])?>", <?php echo valores_enteros($grafico[2]['egreso']) ?>, '#FF8000'],
											["<?php echo numero_a_mes($grafico[3]['mes'])?>", <?php echo valores_enteros($grafico[3]['egreso']) ?>, '#FFFF00'],
											["<?php echo numero_a_mes($grafico[4]['mes'])?>", <?php echo valores_enteros($grafico[4]['egreso']) ?>, '#00FF00'],
											["<?php echo numero_a_mes($grafico[5]['mes'])?>", <?php echo valores_enteros($grafico[5]['egreso']) ?>, '#00FFBF'],
											["<?php echo numero_a_mes($grafico[6]['mes'])?>", <?php echo valores_enteros($grafico[6]['egreso']) ?>, '#0080FF'],
											["<?php echo numero_a_mes($grafico[7]['mes'])?>", <?php echo valores_enteros($grafico[7]['egreso']) ?>, '#0000FF'],
											["<?php echo numero_a_mes($grafico[8]['mes'])?>", <?php echo valores_enteros($grafico[8]['egreso']) ?>, '#9A2EFE'],
											["<?php echo numero_a_mes($grafico[9]['mes'])?>", <?php echo valores_enteros($grafico[9]['egreso']) ?>, '#FF00FF'],
											["<?php echo numero_a_mes($grafico[10]['mes'])?>", <?php echo valores_enteros($grafico[10]['egreso']) ?>, '#FF0040'],
											["<?php echo numero_a_mes($grafico[11]['mes'])?>", <?php echo valores_enteros($grafico[11]['egreso']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[12]['mes'])?>", <?php echo valores_enteros($grafico[12]['egreso']) ?>, '#FF8000']
										  ]);

										  var view = new google.visualization.DataView(data);
										  view.setColumns([0, 1,
														   { calc: "stringify",
															 sourceColumn: 1,
															 type: "string",
															 role: "annotation" },
															2]);

										  var options = {
											title: "Egresos",
											bar: {groupWidth: "95%"},
											legend: { position: "none" },
										  };
										  var chart = new google.visualization.ColumnChart(document.getElementById("grafEgresos"));
										  chart.draw(view, options);
									  }
									  
									</script>
									<div id="grafEgresos" style="width: 100%; height: 500px;"></div>
					</div>
					<?php }
				
				$total = 0;
				$total = $total + $grafico[1]['gasto'];
				$total = $total + $grafico[2]['gasto'];
				$total = $total + $grafico[3]['gasto'];
				$total = $total + $grafico[4]['gasto'];
				$total = $total + $grafico[5]['gasto'];
				$total = $total + $grafico[6]['gasto'];
				$total = $total + $grafico[7]['gasto'];
				$total = $total + $grafico[8]['gasto'];
				$total = $total + $grafico[9]['gasto'];
				$total = $total + $grafico[10]['gasto'];
				$total = $total + $grafico[11]['gasto'];
				$total = $total + $grafico[12]['gasto'];
				
				if($total!=0){?>
					<div class="col-md-12">								
									<script type="text/javascript">
										google.charts.setOnLoadCallback(drawChart);
										function drawChart() {
										  var data = google.visualization.arrayToDataTable([
											["Mes", "Valor", { role: 'style' } ],
											["<?php echo numero_a_mes($grafico[1]['mes'])?>", <?php echo valores_enteros($grafico[1]['gasto']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[2]['mes'])?>", <?php echo valores_enteros($grafico[2]['gasto']) ?>, '#FF8000'],
											["<?php echo numero_a_mes($grafico[3]['mes'])?>", <?php echo valores_enteros($grafico[3]['gasto']) ?>, '#FFFF00'],
											["<?php echo numero_a_mes($grafico[4]['mes'])?>", <?php echo valores_enteros($grafico[4]['gasto']) ?>, '#00FF00'],
											["<?php echo numero_a_mes($grafico[5]['mes'])?>", <?php echo valores_enteros($grafico[5]['gasto']) ?>, '#00FFBF'],
											["<?php echo numero_a_mes($grafico[6]['mes'])?>", <?php echo valores_enteros($grafico[6]['gasto']) ?>, '#0080FF'],
											["<?php echo numero_a_mes($grafico[7]['mes'])?>", <?php echo valores_enteros($grafico[7]['gasto']) ?>, '#0000FF'],
											["<?php echo numero_a_mes($grafico[8]['mes'])?>", <?php echo valores_enteros($grafico[8]['gasto']) ?>, '#9A2EFE'],
											["<?php echo numero_a_mes($grafico[9]['mes'])?>", <?php echo valores_enteros($grafico[9]['gasto']) ?>, '#FF00FF'],
											["<?php echo numero_a_mes($grafico[10]['mes'])?>", <?php echo valores_enteros($grafico[10]['gasto']) ?>, '#FF0040'],
											["<?php echo numero_a_mes($grafico[11]['mes'])?>", <?php echo valores_enteros($grafico[11]['gasto']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[12]['mes'])?>", <?php echo valores_enteros($grafico[12]['gasto']) ?>, '#FF8000']
										  ]);

										  var view = new google.visualization.DataView(data);
										  view.setColumns([0, 1,
														   { calc: "stringify",
															 sourceColumn: 1,
															 type: "string",
															 role: "annotation" },
															2]);

										  var options = {
											title: "Gastos",
											bar: {groupWidth: "95%"},
											legend: { position: "none" },
										  };
										  var chart = new google.visualization.ColumnChart(document.getElementById("grafgasto"));
										  chart.draw(view, options);
									  }
									  
									</script>
									<div id="grafgasto" style="width: 100%; height: 500px;"></div>
					</div>
					<?php }
				
				$total = 0;
				$total = $total + $grafico[1]['traspaso'];
				$total = $total + $grafico[2]['traspaso'];
				$total = $total + $grafico[3]['traspaso'];
				$total = $total + $grafico[4]['traspaso'];
				$total = $total + $grafico[5]['traspaso'];
				$total = $total + $grafico[6]['traspaso'];
				$total = $total + $grafico[7]['traspaso'];
				$total = $total + $grafico[8]['traspaso'];
				$total = $total + $grafico[9]['traspaso'];
				$total = $total + $grafico[10]['traspaso'];
				$total = $total + $grafico[11]['traspaso'];
				$total = $total + $grafico[12]['traspaso'];
				
				if($total!=0){?>
					<div class="col-md-12">								
									<script type="text/javascript">
										google.charts.setOnLoadCallback(drawChart);
										function drawChart() {
										  var data = google.visualization.arrayToDataTable([
											["Mes", "Valor", { role: 'style' } ],
											["<?php echo numero_a_mes($grafico[1]['mes'])?>", <?php echo valores_enteros($grafico[1]['traspaso']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[2]['mes'])?>", <?php echo valores_enteros($grafico[2]['traspaso']) ?>, '#FF8000'],
											["<?php echo numero_a_mes($grafico[3]['mes'])?>", <?php echo valores_enteros($grafico[3]['traspaso']) ?>, '#FFFF00'],
											["<?php echo numero_a_mes($grafico[4]['mes'])?>", <?php echo valores_enteros($grafico[4]['traspaso']) ?>, '#00FF00'],
											["<?php echo numero_a_mes($grafico[5]['mes'])?>", <?php echo valores_enteros($grafico[5]['traspaso']) ?>, '#00FFBF'],
											["<?php echo numero_a_mes($grafico[6]['mes'])?>", <?php echo valores_enteros($grafico[6]['traspaso']) ?>, '#0080FF'],
											["<?php echo numero_a_mes($grafico[7]['mes'])?>", <?php echo valores_enteros($grafico[7]['traspaso']) ?>, '#0000FF'],
											["<?php echo numero_a_mes($grafico[8]['mes'])?>", <?php echo valores_enteros($grafico[8]['traspaso']) ?>, '#9A2EFE'],
											["<?php echo numero_a_mes($grafico[9]['mes'])?>", <?php echo valores_enteros($grafico[9]['traspaso']) ?>, '#FF00FF'],
											["<?php echo numero_a_mes($grafico[10]['mes'])?>", <?php echo valores_enteros($grafico[10]['traspaso']) ?>, '#FF0040'],
											["<?php echo numero_a_mes($grafico[11]['mes'])?>", <?php echo valores_enteros($grafico[11]['traspaso']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[12]['mes'])?>", <?php echo valores_enteros($grafico[12]['traspaso']) ?>, '#FF8000']
										  ]);

										  var view = new google.visualization.DataView(data);
										  view.setColumns([0, 1,
														   { calc: "stringify",
															 sourceColumn: 1,
															 type: "string",
															 role: "annotation" },
															2]);

										  var options = {
											title: "Traspasos entre bodegas de la empresa",
											bar: {groupWidth: "95%"},
											legend: { position: "none" },
										  };
										  var chart = new google.visualization.ColumnChart(document.getElementById("graftraspaso"));
										  chart.draw(view, options);
									  }
									  
									</script>
									<div id="graftraspaso" style="width: 100%; height: 500px;"></div>
					</div>
					<?php }
				
				$total = 0;
				$total = $total + $grafico[1]['traspasooe'];
				$total = $total + $grafico[2]['traspasooe'];
				$total = $total + $grafico[3]['traspasooe'];
				$total = $total + $grafico[4]['traspasooe'];
				$total = $total + $grafico[5]['traspasooe'];
				$total = $total + $grafico[6]['traspasooe'];
				$total = $total + $grafico[7]['traspasooe'];
				$total = $total + $grafico[8]['traspasooe'];
				$total = $total + $grafico[9]['traspasooe'];
				$total = $total + $grafico[10]['traspasooe'];
				$total = $total + $grafico[11]['traspasooe'];
				$total = $total + $grafico[12]['traspasooe'];
				
				if($total!=0){?>
					<div class="col-md-12">								
									<script type="text/javascript">
										google.charts.setOnLoadCallback(drawChart);
										function drawChart() {
										  var data = google.visualization.arrayToDataTable([
											["Mes", "Valor", { role: 'style' } ],
											["<?php echo numero_a_mes($grafico[1]['mes'])?>", <?php echo valores_enteros($grafico[1]['traspasooe']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[2]['mes'])?>", <?php echo valores_enteros($grafico[2]['traspasooe']) ?>, '#FF8000'],
											["<?php echo numero_a_mes($grafico[3]['mes'])?>", <?php echo valores_enteros($grafico[3]['traspasooe']) ?>, '#FFFF00'],
											["<?php echo numero_a_mes($grafico[4]['mes'])?>", <?php echo valores_enteros($grafico[4]['traspasooe']) ?>, '#00FF00'],
											["<?php echo numero_a_mes($grafico[5]['mes'])?>", <?php echo valores_enteros($grafico[5]['traspasooe']) ?>, '#00FFBF'],
											["<?php echo numero_a_mes($grafico[6]['mes'])?>", <?php echo valores_enteros($grafico[6]['traspasooe']) ?>, '#0080FF'],
											["<?php echo numero_a_mes($grafico[7]['mes'])?>", <?php echo valores_enteros($grafico[7]['traspasooe']) ?>, '#0000FF'],
											["<?php echo numero_a_mes($grafico[8]['mes'])?>", <?php echo valores_enteros($grafico[8]['traspasooe']) ?>, '#9A2EFE'],
											["<?php echo numero_a_mes($grafico[9]['mes'])?>", <?php echo valores_enteros($grafico[9]['traspasooe']) ?>, '#FF00FF'],
											["<?php echo numero_a_mes($grafico[10]['mes'])?>", <?php echo valores_enteros($grafico[10]['traspasooe']) ?>, '#FF0040'],
											["<?php echo numero_a_mes($grafico[11]['mes'])?>", <?php echo valores_enteros($grafico[11]['traspasooe']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[12]['mes'])?>", <?php echo valores_enteros($grafico[12]['traspasooe']) ?>, '#FF8000']
										  ]);

										  var view = new google.visualization.DataView(data);
										  view.setColumns([0, 1,
														   { calc: "stringify",
															 sourceColumn: 1,
															 type: "string",
															 role: "annotation" },
															2]);

										  var options = {
											title: "Traspasos hacia otras empresas",
											bar: {groupWidth: "95%"},
											legend: { position: "none" },
										  };
										  var chart = new google.visualization.ColumnChart(document.getElementById("graftraspasooe"));
										  chart.draw(view, options);
									  }
									  
									</script>
									<div id="graftraspasooe" style="width: 100%; height: 500px;"></div>
					</div>	
					<?php }
				
				$total = 0;
				$total = $total + $grafico[1]['otrabajo'];
				$total = $total + $grafico[2]['otrabajo'];
				$total = $total + $grafico[3]['otrabajo'];
				$total = $total + $grafico[4]['otrabajo'];
				$total = $total + $grafico[5]['otrabajo'];
				$total = $total + $grafico[6]['otrabajo'];
				$total = $total + $grafico[7]['otrabajo'];
				$total = $total + $grafico[8]['otrabajo'];
				$total = $total + $grafico[9]['otrabajo'];
				$total = $total + $grafico[10]['otrabajo'];
				$total = $total + $grafico[11]['otrabajo'];
				$total = $total + $grafico[12]['otrabajo'];
				
				if($total!=0){?>							
					<div class="col-md-12">								
									<script type="text/javascript">
										google.charts.setOnLoadCallback(drawChart);
										function drawChart() {
										  var data = google.visualization.arrayToDataTable([
											["Mes", "Valor", { role: 'style' } ],
											["<?php echo numero_a_mes($grafico[1]['mes'])?>", <?php echo valores_enteros($grafico[1]['otrabajo']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[2]['mes'])?>", <?php echo valores_enteros($grafico[2]['otrabajo']) ?>, '#FF8000'],
											["<?php echo numero_a_mes($grafico[3]['mes'])?>", <?php echo valores_enteros($grafico[3]['otrabajo']) ?>, '#FFFF00'],
											["<?php echo numero_a_mes($grafico[4]['mes'])?>", <?php echo valores_enteros($grafico[4]['otrabajo']) ?>, '#00FF00'],
											["<?php echo numero_a_mes($grafico[5]['mes'])?>", <?php echo valores_enteros($grafico[5]['otrabajo']) ?>, '#00FFBF'],
											["<?php echo numero_a_mes($grafico[6]['mes'])?>", <?php echo valores_enteros($grafico[6]['otrabajo']) ?>, '#0080FF'],
											["<?php echo numero_a_mes($grafico[7]['mes'])?>", <?php echo valores_enteros($grafico[7]['otrabajo']) ?>, '#0000FF'],
											["<?php echo numero_a_mes($grafico[8]['mes'])?>", <?php echo valores_enteros($grafico[8]['otrabajo']) ?>, '#9A2EFE'],
											["<?php echo numero_a_mes($grafico[9]['mes'])?>", <?php echo valores_enteros($grafico[9]['otrabajo']) ?>, '#FF00FF'],
											["<?php echo numero_a_mes($grafico[10]['mes'])?>", <?php echo valores_enteros($grafico[10]['otrabajo']) ?>, '#FF0040'],
											["<?php echo numero_a_mes($grafico[11]['mes'])?>", <?php echo valores_enteros($grafico[11]['otrabajo']) ?>, '#FF0000'],
											["<?php echo numero_a_mes($grafico[12]['mes'])?>", <?php echo valores_enteros($grafico[12]['otrabajo']) ?>, '#FF8000']
										  ]);

										  var view = new google.visualization.DataView(data);
										  view.setColumns([0, 1,
														   { calc: "stringify",
															 sourceColumn: 1,
															 type: "string",
															 role: "annotation" },
															2]);

										  var options = {
											title: "Gastos de Ordenes de Trabajo",
											bar: {groupWidth: "95%"},
											legend: { position: "none" },
										  };
										  var chart = new google.visualization.ColumnChart(document.getElementById("grafotrabajo"));
										  chart.draw(view, options);
									  }
									  
									</script>
									<div id="grafotrabajo" style="width: 100%; height: 500px;"></div>		
						</div>
						<?php } ?>
						
			</div>
                
        </div>   
	</div>        
</div>             

<?php if ($arrUsuario['tipo']!='Gerencia'){?>            
<div class="row">   
	<div class="col-lg-6">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Stock Actual de las bodegas</h5>

			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Stock Min</th>
							<th>Stock Actual</th>
						</tr>
					</thead>
								  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php
					filtrar($arrProductos, 'NombreBodega'); 
					foreach($arrProductos as $bodega=>$prodstock){ 
						echo '<tr class="odd" ><td colspan="5"  style="background-color:#DDD">Bodega : '.$bodega.'</td></tr>';
						
						foreach ($prodstock as $productos) {
							$stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; 
							if ($stock_actual!=0&&$productos['NombreProd']!=''){ ?>
								<tr class="odd">
									<td><?php echo $productos['NombreProd']; ?></td>
									<td><?php echo Cantidades_decimales_justos($productos['StockLimite']); ?> <?php echo $productos['UnidadMedida'];?></td>
									<td><?php echo Cantidades_decimales_justos($stock_actual) ?> <?php echo $productos['UnidadMedida'];?></td>
								</tr>
							<?php } 
						}
					} ?>                     
					</tbody>
				</table>
			</div>
		</div>
	</div> 
 
	<div class="col-lg-6">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table"></i></div><h5>Productos consumidos por las OT a la fecha</h5>

			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>Nombre</th>
							<th>Total</th>
						</tr>
					</thead>
								  
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php
					filtrar($arrProductosOt, 'NombreBodega'); 
					foreach($arrProductosOt as $bodega=>$prodstock){ 
						echo '<tr class="odd" ><td colspan="5"  style="background-color:#DDD">Bodega : '.$bodega.'</td></tr>';
						
						foreach ($prodstock as $productos) {
							if($productos['stock_salida']!=0){?>
							<tr class="odd">
								<td><?php echo $productos['NombreProd']; ?></td>
								<td><?php echo Cantidades_decimales_justos($productos['stock_salida']) ?> <?php echo $productos['UnidadMedida'];?></td>
							</tr>
						<?php }
						}
					} ?>                     
					</tbody>
				</table>
			</div>
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
