<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
//Verifico si es superusuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Type.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "core_testing_code.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['test_fnx']) ) { 
	
	$rowData = db_select_data ('Nombre', 'core_sistemas', '', 'idSistema=1', $dbConn);
	echo 'Nombre Sistema 1:'.$rowData['Nombre'].'<br/>'; 
	$rowData = db_select_nrows ('idSistema', 'core_sistemas', '', 'Nombre="Empresa 1"', $dbConn);
	echo 'numero Sistema 1:'.$rowData.'<br/>'; 
	 
	?>
	 
	 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['fact_repair']) ) { 
// Se trae un listado con todos los pagos
$arrPagosClientes = array();
$query = "SELECT 
pagos_facturas_clientes.idPago,
pagos_facturas_clientes.idTipo,
pagos_facturas_clientes.idFacturacion,
pagos_facturas_clientes.MontoPagado AS MontoPagado,

Factura_Arr.ValorTotal AS Arriendos_MontoFactura,
NotaCredito_Arr.ValorTotal AS Arriendos_MontoNotaCredito,

Factura_Ins.ValorTotal AS Insumos_MontoFactura,
NotaCredito_Ins.ValorTotal AS Insumos_MontoNotaCredito,

Factura_Prod.ValorTotal AS Productos_MontoFactura,
NotaCredito_Prod.ValorTotal AS Productos_MontoNotaCredito,

Factura_Serv.ValorTotal AS Servicios_MontoFactura,
NotaCredito_Serv.ValorTotal AS Servicios_MontoNotaCredito


FROM `pagos_facturas_clientes`
LEFT JOIN `bodegas_arriendos_facturacion`  Factura_Arr  ON Factura_Arr.idFacturacion   = pagos_facturas_clientes.idFacturacion
LEFT JOIN `bodegas_arriendos_facturacion`  NotaCredito_Arr  ON NotaCredito_Arr.idFacturacionRelacionado   = pagos_facturas_clientes.idFacturacion

LEFT JOIN `bodegas_insumos_facturacion`  Factura_Ins  ON Factura_Ins.idFacturacion   = pagos_facturas_clientes.idFacturacion
LEFT JOIN `bodegas_insumos_facturacion`  NotaCredito_Ins  ON NotaCredito_Ins.idFacturacionRelacionado   = pagos_facturas_clientes.idFacturacion

LEFT JOIN `bodegas_productos_facturacion`  Factura_Prod  ON Factura_Prod.idFacturacion   = pagos_facturas_clientes.idFacturacion
LEFT JOIN `bodegas_productos_facturacion`  NotaCredito_Prod  ON NotaCredito_Prod.idFacturacionRelacionado   = pagos_facturas_clientes.idFacturacion

LEFT JOIN `bodegas_servicios_facturacion`  Factura_Serv  ON Factura_Serv.idFacturacion   = pagos_facturas_clientes.idFacturacion
LEFT JOIN `bodegas_servicios_facturacion`  NotaCredito_Serv  ON NotaCredito_Serv.idFacturacionRelacionado   = pagos_facturas_clientes.idFacturacion

";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagosClientes,$row );
}



foreach ($arrPagosClientes as $pagos) {
	//Tipo de pago
	switch ($pagos['idTipo']) {
		//Factura Insumos
		case 1:
			//Si factura es igual a nota de credito
			if($pagos['Insumos_MontoFactura']==$pagos['Insumos_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_clientes` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_insumos_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Insumos_MontoFactura']!=$pagos['Insumos_MontoNotaCredito']&&$pagos['Insumos_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Insumos_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_clientes SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
		//Factura Productos
		case 2:
			//Si factura es igual a nota de credito
			if($pagos['Productos_MontoFactura']==$pagos['Productos_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_clientes` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_productos_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Productos_MontoFactura']!=$pagos['Productos_MontoNotaCredito']&&$pagos['Productos_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Productos_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_clientes SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
		//Factura Servicios
		case 3:
			//Si factura es igual a nota de credito
			if($pagos['Servicios_MontoFactura']==$pagos['Servicios_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_clientes` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_servicios_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Servicios_MontoFactura']!=$pagos['Servicios_MontoNotaCredito']&&$pagos['Servicios_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Servicios_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_clientes SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
		//Factura Arriendos
		case 4:
			//Si factura es igual a nota de credito
			if($pagos['Arriendos_MontoFactura']==$pagos['Arriendos_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_clientes` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_arriendos_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Arriendos_MontoFactura']!=$pagos['Arriendos_MontoNotaCredito']&&$pagos['Arriendos_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Arriendos_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_clientes SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
	}
}


// Se trae un listado con todos los pagos
$arrPagosProveedores = array();
$query = "SELECT 
pagos_facturas_proveedores.idPago,
pagos_facturas_proveedores.idTipo,
pagos_facturas_proveedores.idFacturacion,
pagos_facturas_proveedores.MontoPagado AS MontoPagado,

Factura_Arr.ValorTotal AS Arriendos_MontoFactura,
NotaCredito_Arr.ValorTotal AS Arriendos_MontoNotaCredito,

Factura_Ins.ValorTotal AS Insumos_MontoFactura,
NotaCredito_Ins.ValorTotal AS Insumos_MontoNotaCredito,

Factura_Prod.ValorTotal AS Productos_MontoFactura,
NotaCredito_Prod.ValorTotal AS Productos_MontoNotaCredito,

Factura_Serv.ValorTotal AS Servicios_MontoFactura,
NotaCredito_Serv.ValorTotal AS Servicios_MontoNotaCredito


FROM `pagos_facturas_proveedores`
LEFT JOIN `bodegas_arriendos_facturacion`  Factura_Arr  ON Factura_Arr.idFacturacion   = pagos_facturas_proveedores.idFacturacion
LEFT JOIN `bodegas_arriendos_facturacion`  NotaCredito_Arr  ON NotaCredito_Arr.idFacturacionRelacionado   = pagos_facturas_proveedores.idFacturacion

LEFT JOIN `bodegas_insumos_facturacion`  Factura_Ins  ON Factura_Ins.idFacturacion   = pagos_facturas_proveedores.idFacturacion
LEFT JOIN `bodegas_insumos_facturacion`  NotaCredito_Ins  ON NotaCredito_Ins.idFacturacionRelacionado   = pagos_facturas_proveedores.idFacturacion

LEFT JOIN `bodegas_productos_facturacion`  Factura_Prod  ON Factura_Prod.idFacturacion   = pagos_facturas_proveedores.idFacturacion
LEFT JOIN `bodegas_productos_facturacion`  NotaCredito_Prod  ON NotaCredito_Prod.idFacturacionRelacionado   = pagos_facturas_proveedores.idFacturacion

LEFT JOIN `bodegas_servicios_facturacion`  Factura_Serv  ON Factura_Serv.idFacturacion   = pagos_facturas_proveedores.idFacturacion
LEFT JOIN `bodegas_servicios_facturacion`  NotaCredito_Serv  ON NotaCredito_Serv.idFacturacionRelacionado   = pagos_facturas_proveedores.idFacturacion

";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrPagosProveedores,$row );
}

echo '//////////////////////////////////////////////////////////////////////////<br/><br/>';

foreach ($arrPagosProveedores as $pagos) {
	//Tipo de pago
	switch ($pagos['idTipo']) {
		//Factura Insumos
		case 1:
			//Si factura es igual a nota de credito
			if($pagos['Insumos_MontoFactura']==$pagos['Insumos_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_proveedores` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_insumos_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Insumos_MontoFactura']!=$pagos['Insumos_MontoNotaCredito']&&$pagos['Insumos_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Insumos_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_proveedores SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
		//Factura Productos
		case 2:
			//Si factura es igual a nota de credito
			if($pagos['Productos_MontoFactura']==$pagos['Productos_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_proveedores` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_productos_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Productos_MontoFactura']!=$pagos['Productos_MontoNotaCredito']&&$pagos['Productos_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Productos_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_proveedores SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
		//Factura Servicios
		case 3:
			//Si factura es igual a nota de credito
			if($pagos['Servicios_MontoFactura']==$pagos['Servicios_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_proveedores` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_servicios_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Servicios_MontoFactura']!=$pagos['Servicios_MontoNotaCredito']&&$pagos['Servicios_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Servicios_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_proveedores SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
		//Factura Arriendos
		case 4:
			//Si factura es igual a nota de credito
			if($pagos['Arriendos_MontoFactura']==$pagos['Arriendos_MontoNotaCredito']){
				//elimino el pago
				$query  = "DELETE FROM `pagos_facturas_proveedores` WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/>';
				//cambio el estado de la factura a eliminado
				$query  = "UPDATE bodegas_arriendos_facturacion SET idEstado = '3' WHERE idFacturacion = ".$pagos['idFacturacion'];
				echo $query.';<br/><br/>';
			//si no lo es	
			}elseif($pagos['Arriendos_MontoFactura']!=$pagos['Arriendos_MontoNotaCredito']&&$pagos['Arriendos_MontoNotaCredito']!=0){
				//actualizo el valor del pago
				$nuevo_valor = $pagos['MontoPagado'] - $pagos['Arriendos_MontoNotaCredito'];
				$query  = "UPDATE pagos_facturas_proveedores SET MontoPagado = '".$nuevo_valor."' WHERE idPago = ".$pagos['idPago'];
				echo $query.';<br/><br/>';
			}
			break;
	}
} 

	 
?>


<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 }elseif ( ! empty($_GET['test_cross']) ) { 
$idPredio = 1;
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre
FROM `cross_predios_listado`
WHERE idPredio = {$idPredio}";
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
$rowdata = mysqli_fetch_assoc ($resultado);

//Se traen las rutas
$arrZonas = array();
$query = "SELECT 
cross_predios_listado_zonas.idZona,
cross_predios_listado_zonas.Nombre,
cross_predios_listado_zonas_ubicaciones.Latitud,
cross_predios_listado_zonas_ubicaciones.Longitud

FROM `cross_predios_listado_zonas`
LEFT JOIN `cross_predios_listado_zonas_ubicaciones` ON cross_predios_listado_zonas_ubicaciones.idZona = cross_predios_listado_zonas.idZona
WHERE cross_predios_listado_zonas.idPredio = {$idPredio}
ORDER BY cross_predios_listado_zonas.idZona ASC, 
cross_predios_listado_zonas_ubicaciones.idUbicaciones ASC";
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
array_push( $arrZonas,$row );
}

?>


<div class="col-sm-12">
	<div class="box">
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Puntos del Cuartel <?php echo $rowdata['Nombre']; ?></h5>
		</header>
        <div class="table-responsive">
			
			<div class="col-sm-8">
				<div class="row">
					<?php
					//Si no existe una ID se utiliza una por defecto
					if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
						echo '<p>No ha ingresado Una API de Google Maps</p>';
					}else{
						$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle'];
					
						if(isset($_GET['Latitud'])&&isset($_GET['Longitud'])&&$_GET['Latitud']!=''&&$_GET['Longitud']!=''){
							$Latitud = $_GET['Latitud'];
							$Longitud = $_GET['Longitud'];
						}else{
							$Latitud = -33.477271996598965;
							$Longitud = -70.65170304882815;
						}
						?>
						<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>
						<div id="map_canvas" style="width: 100%; height: 550px;"></div>
						<script>
							
							var map;
							var marker;
							/* ************************************************************************** */
							function initialize() {
								var myLatlng = new google.maps.LatLng(<?php echo $Latitud; ?>, <?php echo $Longitud; ?>);

								var myOptions = {
									zoom: 16,
									center: myLatlng,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								};
								map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
								
								marker = new google.maps.Marker({
									draggable	: true,
									position	: myLatlng,
									map			: map,
									title		: "Tu Ubicacion",
									animation 	:google.maps.Animation.DROP,
									icon      	:"<?php echo DB_SITE ?>/LIB_assets/img/map-icons/1_series_orange.png"
								});
								
								google.maps.event.addListener(marker, 'dragend', function (event) {

									document.getElementById("Latitud").value = event.latLng.lat();
									document.getElementById("Longitud").value = event.latLng.lng();
									
									document.getElementById("Latitud_fake").value = event.latLng.lat();
									document.getElementById("Longitud_fake").value = event.latLng.lng();
									

								});
							
								//RutasAlternativas();
								dibuja_zona();

							}
							/* ************************************************************************** */
							function dibuja_zona() {
								
								var polygons = [];
								<?php 
								//Se filtra por zona
								filtrar($arrZonas, 'idZona');
								//se recorre
								foreach ($arrZonas as $todaszonas=>$zonas) {
									
									echo 'var path'.$todaszonas.' = [';

									//Variables con la primera posicion
									$Latitud_x = '';
									$Longitud_x = '';
									
									foreach ($zonas as $puntos) {
										echo '{lat: '.$puntos['Latitud'].', lng: '.$puntos['Longitud'].'},
										';
										if(isset($puntos['Latitud'])&&$puntos['Latitud']!='0'){
											$Latitud_x = $puntos['Latitud'];
											$Longitud_x = $puntos['Longitud'];
										}
									}
									
									if(isset($Longitud_x)&&$Longitud_x!=''){
										echo '{lat: '.$Latitud_x.', lng: '.$Longitud_x.'}'; 
									}
									
									echo '];';
									
									echo '
									polygons.push(new google.maps.Polygon({
										paths: path'.$todaszonas.',
										strokeColor: \'#FF0000\',
										strokeOpacity: 0.8,
										strokeWeight: 2,
										fillColor: \'#FF0000\',
										fillOpacity: 0.35
									}));
									polygons[polygons.length-1].setMap(map);
									';
										
								}?>
							}
							/* ************************************************************************** */
							google.maps.event.addDomListener(window, "load", initialize());

						</script>
					<?php } ?>
				</div>
			</div>
		
			<div class="col-sm-4">
				<div style="margin-top:20px;">
					<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
				
						<?php 
						//Deteccion de Zona
						$pointLocation = new subpointLocation();
						$nx_zona = 0;
						foreach ($arrZonas as $todaszonas=>$zonas) {
							//arreglo para el pligono
							$polygon = array();
							//variables para cerrar el poligono
							$ini     = 0;
							$f_lat   = 0;
							$f_long  = 0;
							//recorro las zonas
							foreach ($zonas as $puntos) {
								array_push( $polygon,$puntos['Latitud'].' '.$puntos['Longitud'] );
								//echo 'geo='.$puntos['Latitud'].' '.$puntos['Longitud'].'<br/>';
								//si es el primer dato
								if($ini==0){
									$f_lat  = $puntos['Latitud'];
									$f_long = $puntos['Longitud'];
								}
								$ini++;
							}
							//inserto el primer dato como el ultimo para cerrar poligono
							array_push( $polygon,$f_lat.' '.$f_long );
							//verifico
							$c_chek =  $pointLocation->pointInPolygon($Latitud.' '.$Longitud, $polygon);
							if($c_chek=='inside'){
								if($nx_zona==0){
									$nx_zona = $todaszonas;
								}
							}
							//echo 'c_chek='.$c_chek.'<br/>';
						}
						
						
						/********************************************************/
						//Inputs
						if(isset($idTelemetria)) {   $x1  = $idTelemetria;  }elseif(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){    $x1  = $_GET['idTelemetria'];   }else{$x1  = '';}
						if(isset($GeoVelocidad)) {   $x3  = $GeoVelocidad;  }elseif(isset($_GET['GeoVelocidad'])&&$_GET['GeoVelocidad']!=''){    $x3  = $_GET['GeoVelocidad'];   }else{$x3  = '';}
						if(isset($GeoMovimiento)) {  $x4  = $GeoMovimiento; }elseif(isset($_GET['GeoMovimiento'])&&$_GET['GeoMovimiento']!=''){  $x4  = $_GET['GeoMovimiento'];  }else{$x4  = '';}
						if(isset($Sensor_1)) {       $x5  = $Sensor_1;      }elseif(isset($_GET['Sensor_1'])&&$_GET['Sensor_1']!=''){            $x5  = $_GET['Sensor_1'];       }else{$x5  = '';}
						if(isset($Sensor_2)) {       $x6  = $Sensor_2;      }elseif(isset($_GET['Sensor_2'])&&$_GET['Sensor_2']!=''){            $x6  = $_GET['Sensor_2'];       }else{$x6  = '';}
						if(isset($Sensor_3)) {       $x7  = $Sensor_3;      }elseif(isset($_GET['Sensor_3'])&&$_GET['Sensor_3']!=''){            $x7  = $_GET['Sensor_3'];       }else{$x7  = '';}
						if(isset($Sensor_4)) {       $x8  = $Sensor_4;      }elseif(isset($_GET['Sensor_4'])&&$_GET['Sensor_4']!=''){            $x8  = $_GET['Sensor_4'];       }else{$x8  = '';}
						
						//se dibujan los inputs
						$Form_Imputs = new Form_Inputs();
						$Form_Imputs->form_input_disabled( 'Latitud', 'Latitud_fake', $Latitud, 1);
						$Form_Imputs->form_input_disabled( 'Longitud', 'Longitud_fake', $Longitud, 1);
						
						$Form_Imputs->form_select_filter('Tractor','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 0, '', $dbConn);	
						$Form_Imputs->form_input_number('Velocidad','GeoVelocidad', $x3, 2);
						$Form_Imputs->form_input_number('Distancia','GeoMovimiento', $x4, 2);
						$Form_Imputs->form_input_number('Caudal Derecho','Sensor_1', $x5, 2);
						$Form_Imputs->form_input_number('Caudal Izquierdo','Sensor_2', $x6, 2);
						$Form_Imputs->form_input_number('nivel','Sensor_3', $x7, 2);
						$Form_Imputs->form_input_number('otro','Sensor_4', $x8, 2);
						
						$Form_Imputs->form_input_hidden('FechaSistema', fecha_actual(), 2);
						$Form_Imputs->form_input_hidden('HoraSistema', hora_actual(), 2);
						$Form_Imputs->form_input_hidden('TimeStamp', fecha_actual().' '.hora_actual(), 2);
						$Form_Imputs->form_input_hidden('GeoLatitud', $Latitud, 2);
						$Form_Imputs->form_input_hidden('GeoLongitud', $Longitud, 2);
						
						//no borrar
						$Form_Imputs->form_input_hidden('Latitud', 0, 2);
						$Form_Imputs->form_input_hidden('Longitud', 0, 2);
						$Form_Imputs->form_input_hidden('test_cross', 'true', 2);
						
								
						/********************************************************/
						//Guardo el dato en la tabla relacionada
						if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!='') {
							//filtros
							$idTelemetria   = $_GET['idTelemetria'];
							$FechaSistema   = $_GET['FechaSistema'];
							$HoraSistema    = $_GET['HoraSistema'];
							$TimeStamp      = $_GET['TimeStamp'];
							$GeoLatitud     = $_GET['GeoLatitud'];
							$GeoLongitud    = $_GET['GeoLongitud'];
							$GeoVelocidad   = $_GET['GeoVelocidad'];
							$GeoMovimiento  = $_GET['GeoMovimiento'];
							$idZona         = $nx_zona;
							$Sensor_1       = $_GET['Sensor_1'];
							$Sensor_2       = $_GET['Sensor_2'];
							$Sensor_3       = $_GET['Sensor_3'];
							$Sensor_4       = $_GET['Sensor_4'];
							
							
							if(isset($idTelemetria) && $idTelemetria != ''){      $a  = "'".$idTelemetria."'" ;    }else{$a  ="''";}
							if(isset($FechaSistema) && $FechaSistema != ''){      $a .= ",'".$FechaSistema."'" ;   }else{$a .=",''";}
							if(isset($HoraSistema) && $HoraSistema != ''){        $a .= ",'".$HoraSistema."'" ;    }else{$a .=",''";}
							if(isset($TimeStamp) && $TimeStamp != ''){            $a .= ",'".$TimeStamp."'" ;      }else{$a .=",''";}
							if(isset($GeoLatitud) && $GeoLatitud != ''){          $a .= ",'".$GeoLatitud."'" ;     }else{$a .=",''";}
							if(isset($GeoLongitud) && $GeoLongitud != ''){        $a .= ",'".$GeoLongitud."'" ;    }else{$a .=",''";}
							if(isset($GeoVelocidad) && $GeoVelocidad != ''){      $a .= ",'".$GeoVelocidad."'" ;   }else{$a .=",''";}
							if(isset($GeoMovimiento) && $GeoMovimiento != ''){    $a .= ",'".$GeoMovimiento."'" ;  }else{$a .=",''";}
							if(isset($idZona) && $idZona != ''){                  $a .= ",'".$idZona."'" ;         }else{$a .=",''";}
							if(isset($Sensor_1) && $Sensor_1 != ''){              $a .= ",'".$Sensor_1."'" ;       }else{$a .=",''";}
							if(isset($Sensor_2) && $Sensor_2 != ''){              $a .= ",'".$Sensor_2."'" ;       }else{$a .=",''";}
							if(isset($Sensor_3) && $Sensor_3 != ''){              $a .= ",'".$Sensor_3."'" ;       }else{$a .=",''";}
							if(isset($Sensor_4) && $Sensor_4 != ''){              $a .= ",'".$Sensor_4."'" ;       }else{$a .=",''";}
							
							
							//query
							$query  = "INSERT INTO `telemetria_listado_tablarelacionada_".$idTelemetria."` (
							idTelemetria, FechaSistema, HoraSistema, TimeStamp, 
							GeoLatitud, GeoLongitud, GeoVelocidad,GeoMovimiento, 
							idZona, Sensor_1, Sensor_2,Sensor_3, Sensor_4
							) VALUES ({$a} )";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							
						}
						
						?>

						<div class="form-group">
							<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Punto" name="submit_punto"> 
						</div>
							  
					</form>
					<?php require_once '../LIBS_js/validator/form_validator.php';?>
					
				</div>
				
				<div style="margin-top:20px;">
					
						<?php echo 'nx_zona='.$nx_zona; ?>
					
				</div>	
			</div>
			
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['user_correction']) ) { 
$arrUsuarios = array();
$query = "SELECT idUsuario, idSistema
FROM `usuarios_listado` ";
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
array_push( $arrUsuarios,$row );
}	


?>
	
<pre>
	<?php
	foreach ($arrUsuarios as $user) {
		
		if(isset($user['idUsuario']) && $user['idUsuario'] != 0 && isset($user['idSistema']) && $user['idSistema'] != 0){    
			$a  = "'".$user['idUsuario']."'" ;
			$a .= ",'".$user['idSistema']."'" ;   
		}
				
		// inserto los datos de registro en la db
		echo $query  = "INSERT INTO `usuarios_sistemas` (idUsuario, idSistema) VALUES ({$a} );<br/>";
	}
	?>
</pre>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['test_cctv']) ) { ?>

<img name="main" id="main" border="0" width="640" height="480" src="http://victor:victor2019@190.47.221.128/cgi-bin/mjpg/video.cgi?channel=1&subtype=1">

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>	
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {?>
	 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Funciones</h5>
		</header>
        <div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					
					<tr class="odd">
						<td>Cross Checking - Entregar ubicaciones falsas equipo telemetria</td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo $location.'?test_cross=true'; ?>" title="Ingresar Testeo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
							</div>
						</td>
					</tr>
					
					<tr class="odd">
						<td>Correccion sistemas usuarios</td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo $location.'?user_correction=true'; ?>" title="Ingresar Testeo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
							</div>
						</td>
					</tr>
					
					<tr class="odd">
						<td>Camaras CCTV</td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo $location.'?test_cctv=true'; ?>" title="Ingresar Testeo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
							</div>
						</td>
					</tr>
					
					<tr class="odd">
						<td>Arreglar Facturaciones</td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo $location.'?fact_repair=true'; ?>" title="Ingresar Testeo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
							</div>
						</td>
					</tr>
					
					<tr class="odd">
						<td>Testeo funciones db_select_data</td>
						<td>
							<div class="btn-group" style="width: 35px;" >
								<a href="<?php echo $location.'?test_fnx=true'; ?>" title="Ingresar Testeo" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a>
							</div>
						</td>
					</tr>
				                  
				</tbody>
			</table>
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
