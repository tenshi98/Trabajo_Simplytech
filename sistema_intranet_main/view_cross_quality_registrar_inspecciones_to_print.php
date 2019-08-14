<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Print.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
// Se traen todos los datos del analisis
$query = "SELECT 
cross_quality_registrar_inspecciones.fecha_auto,
cross_quality_registrar_inspecciones.Creacion_fecha,
cross_quality_registrar_inspecciones.Temporada,
cross_quality_registrar_inspecciones.Observaciones,

core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
core_cross_quality_analisis_calidad.Nombre AS TipoAnalisis,
sistema_variedades_categorias.Nombre AS ProductoCategoria,
variedades_listado.Nombre AS ProductoNombre,

cross_quality_registrar_inspecciones.idCategoria,
cross_quality_registrar_inspecciones.idTipo,
cross_quality_registrar_inspecciones.idSistema,
(SELECT 
cross_quality_calidad_matriz.cantPuntos
FROM `sistema_variedades_categorias_matriz_calidad`
LEFT JOIN `cross_quality_calidad_matriz` ON cross_quality_calidad_matriz.idMatriz = sistema_variedades_categorias_matriz_calidad.idMatriz
WHERE sistema_variedades_categorias_matriz_calidad.idCategoria = cross_quality_registrar_inspecciones.idCategoria
AND sistema_variedades_categorias_matriz_calidad.idProceso = cross_quality_registrar_inspecciones.idTipo
AND sistema_variedades_categorias_matriz_calidad.idSistema = cross_quality_registrar_inspecciones.idSistema
) AS Producto_cantPuntos,

(SELECT 
sistema_variedades_categorias_matriz_calidad.idMatriz
FROM `sistema_variedades_categorias_matriz_calidad`
LEFT JOIN `cross_quality_calidad_matriz` ON cross_quality_calidad_matriz.idMatriz = sistema_variedades_categorias_matriz_calidad.idMatriz
WHERE sistema_variedades_categorias_matriz_calidad.idCategoria = cross_quality_registrar_inspecciones.idCategoria
AND sistema_variedades_categorias_matriz_calidad.idProceso = cross_quality_registrar_inspecciones.idTipo
AND sistema_variedades_categorias_matriz_calidad.idSistema = cross_quality_registrar_inspecciones.idSistema
) AS Producto_idCalidad,

ubicacion_listado.Nombre AS UbicacionNombre,
ubicacion_listado_level_1.Nombre AS UbicacionNombre_lvl_1,
ubicacion_listado_level_2.Nombre AS UbicacionNombre_lvl_2,
ubicacion_listado_level_3.Nombre AS UbicacionNombre_lvl_3,
ubicacion_listado_level_4.Nombre AS UbicacionNombre_lvl_4,
ubicacion_listado_level_5.Nombre AS UbicacionNombre_lvl_5

FROM `cross_quality_registrar_inspecciones`
LEFT JOIN `core_sistemas`                          ON core_sistemas.idSistema                      = cross_quality_registrar_inspecciones.idSistema
LEFT JOIN `usuarios_listado`                       ON usuarios_listado.idUsuario                   = cross_quality_registrar_inspecciones.idUsuario
LEFT JOIN `core_cross_quality_analisis_calidad`    ON core_cross_quality_analisis_calidad.idTipo   = cross_quality_registrar_inspecciones.idTipo
LEFT JOIN `sistema_variedades_categorias`          ON sistema_variedades_categorias.idCategoria    = cross_quality_registrar_inspecciones.idCategoria
LEFT JOIN `variedades_listado`                     ON variedades_listado.idProducto                = cross_quality_registrar_inspecciones.idProducto
LEFT JOIN `ubicacion_listado`                      ON ubicacion_listado.idUbicacion                = cross_quality_registrar_inspecciones.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`              ON ubicacion_listado_level_1.idLevel_1          = cross_quality_registrar_inspecciones.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`              ON ubicacion_listado_level_2.idLevel_2          = cross_quality_registrar_inspecciones.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`              ON ubicacion_listado_level_3.idLevel_3          = cross_quality_registrar_inspecciones.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`              ON ubicacion_listado_level_4.idLevel_4          = cross_quality_registrar_inspecciones.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`              ON ubicacion_listado_level_5.idLevel_5          = cross_quality_registrar_inspecciones.idUbicacion_lvl_5

WHERE cross_quality_registrar_inspecciones.idAnalisis = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$row_data = mysqli_fetch_assoc ($resultado);

/***************************************************/				
// Se trae un listado con todos los trabajadores
$arrTrabajadores = array();
$query = "SELECT 
trabajadores_listado.Nombre, 
trabajadores_listado.ApellidoPat, 
trabajadores_listado.ApellidoMat, 
trabajadores_listado.Cargo, 
trabajadores_listado.Rut

FROM `cross_quality_registrar_inspecciones_trabajador` 
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador   = cross_quality_registrar_inspecciones_trabajador.idTrabajador
WHERE cross_quality_registrar_inspecciones_trabajador.idAnalisis = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTrabajadores,$row );
}
/***************************************************/				
// Se trae un listado con todas las maquinas
$arrMaquinas = array();
$query = "SELECT 
maquinas_listado.Nombre,
maquinas_listado.Codigo

FROM `cross_quality_registrar_inspecciones_maquina` 
LEFT JOIN `maquinas_listado`  ON maquinas_listado.idMaquina   = cross_quality_registrar_inspecciones_maquina.idMaquina
WHERE cross_quality_registrar_inspecciones_maquina.idAnalisis = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrMaquinas,$row );
}
/***************************************************/				
// Se trae un listado con todas las muestras
$arrMuestras = array();
$query = "SELECT 
cross_quality_registrar_inspecciones_muestras.idMuestras, 
cross_quality_registrar_inspecciones_muestras.n_folio_pallet,
cross_quality_registrar_inspecciones_muestras.lote,
productores_listado.Nombre AS ClienteNombre

FROM `cross_quality_registrar_inspecciones_muestras` 
LEFT JOIN `productores_listado`  ON productores_listado.idProductor   = cross_quality_registrar_inspecciones_muestras.idProductor
WHERE cross_quality_registrar_inspecciones_muestras.idAnalisis = {$_GET['view']} ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrMuestras,$row );
}


$html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Imprimir</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<!-- Bootstrap -->
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="'.DB_SITE.'/LIB_assets/lib/font-awesome-animation/font-awesome-animation.min.css">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="'.DB_SITE.'/Legacy/gestion_modular/css/main.min.css">
    <!-- Metis Theme stylesheet -->
    <link rel="stylesheet" href="'.DB_SITE.'/Legacy/gestion_modular/lib/fullcalendar/fullcalendar.css">
    <!-- Estilo definido por mi -->
    <link href="'.DB_SITE.'/Legacy/gestion_modular/css/my_style.css" rel="stylesheet" type="text/css">
    <link href="'.DB_SITE.'/LIB_assets/css/my_colors.css" rel="stylesheet" type="text/css">
    <link href="'.DB_SITE.'/Legacy/gestion_modular/css/my_corrections.css" rel="stylesheet" type="text/css">
    <style>
    body{background-color:#fff;}
    </style>
</head>

<body onload="window.print();">
<section class="invoice">';
 
$html .= '
	<section class="invoice">
	
		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i>'.$row_data['TipoAnalisis'].'.
					<small class="pull-right">Fecha Creacion: '.Fecha_estandar($row_data['fecha_auto']).'</small>
				</h2>
			</div>   
		</div>
	
		<div class="row invoice-info">
			<div class="col-sm-4 invoice-col">
				Datos Basicos
				<address>
					<strong>'.$x_column_producto_nombre_sing.'</strong><br>
					'.$row_data['ProductoCategoria'].', '.$row_data['ProductoNombre'].'<br>
					Ubicacion: '.$row_data['UbicacionNombre'];
					if(isset($row_data['UbicacionNombre_lvl_1'])&&$row_data['UbicacionNombre_lvl_1']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_1'];}
					if(isset($row_data['UbicacionNombre_lvl_2'])&&$row_data['UbicacionNombre_lvl_2']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_2'];}
					if(isset($row_data['UbicacionNombre_lvl_3'])&&$row_data['UbicacionNombre_lvl_3']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_3'];}
					if(isset($row_data['UbicacionNombre_lvl_4'])&&$row_data['UbicacionNombre_lvl_4']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_4'];}
					if(isset($row_data['UbicacionNombre_lvl_5'])&&$row_data['UbicacionNombre_lvl_5']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_5'];}
						
					$html .= '<br>
				</address>
			</div>
				
			<div class="col-sm-4 invoice-col">
				Fecha Creacion
				<address>
					Fecha Ingreso: '.Fecha_estandar($row_data['Creacion_fecha']).'<br>
					Temporada: '.$row_data['Temporada'].'<br>
				</address>
			</div>
			   
			<div class="col-sm-4 invoice-col">
				Datos Creacion
				<address>
					Sistema: '.$row_data['Sistema'].'<br>
					Usuario: '.$row_data['Usuario'].'<br>
				</address>	
					
			</div>
		</div>
	
	
		<div class="">
			<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
				<table class="table">
					<thead>
						<tr>
							<th colspan="6">Detalle</th>
						</tr>
					</thead>
					<tbody>';
						if ($arrTrabajadores) {
							$html .= '<tr class="active"><td colspan="6"><strong>Trabajadores Encargados</strong></td></tr>';
							foreach ($arrTrabajadores as $trab) {
								$html .= '
								<tr>
									<td>'.$trab['Rut'].'</td>
									<td colspan="3">'.$trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat'].'</td>
									<td colspan="2">'.$trab['Cargo'].'</td>
								</tr>';
							} 
						}
						if ($arrMaquinas) {
							$html .= '<tr class="active"><td colspan="6"><strong><?php echo $x_column_maquina_plur; ?> a Utilizar</strong></td></tr>';
							foreach ($arrMaquinas as $maq) {
								$html .= '
								<tr>
									<td colspan="6">'.$maq['Codigo'].' - '.$maq['Nombre'].'</td>
								</tr>';
							}
						}
						if ($arrMuestras) {
							$html .= '
							<tr class="active"><td colspan="6"><strong>Muestras</strong></td></tr>
							<tr class="active">
								<td colspan="2"><strong>Productor</strong></td>
								<td colspan="2"><strong>N° Folio / Pallet</strong></td>
								<td colspan="2"><strong>Lote</strong></td>
							</tr>';
							foreach ($arrMuestras as $muestra) {
								$html .= '
								<tr>
									<td colspan="2">'.$muestra['ClienteNombre'].'</td>
									<td colspan="2">'.$muestra['n_folio_pallet'].'</td>
									<td colspan="2">'.$muestra['lote'].'</td>
								</tr>';
							}
						}
						$html .= '
					</tbody>
				</table>
				
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-xs-12">
				<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
				<p class="text-muted well well-sm no-shadow" >'.$row_data['Observaciones'].'</p>
			</div>
		</div> 
	</section>


</body>
</html>';

echo $html;

?>
