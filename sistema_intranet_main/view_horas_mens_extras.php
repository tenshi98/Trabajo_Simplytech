<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Maqueta</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/LIB_assets/css/my_colors.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/my_corrections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE ?>/Legacy/gestion_modular/css/theme_color_<?php if(isset($_SESSION['usuario']['basic_data']['Config_idTheme'])&&$_SESSION['usuario']['basic_data']['Config_idTheme']!=''){echo $_SESSION['usuario']['basic_data']['Config_idTheme'];}else{echo '1';} ?>.css">
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/lib/modernizr/modernizr.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-1.11.0.min.js"></script>
		<style>
			body {background-color: #FFF !important;}
		</style>
	</head>

	<body>
<?php 
// Se traen todos los datos de mi usuario
$query = "SELECT 
usuarios_listado.Nombre AS Usuario,
core_sistemas.Nombre AS SistemaOrigen,
trabajadores_horas_extras_mensuales_facturacion.fecha_auto,
trabajadores_horas_extras_mensuales_facturacion.Creacion_fecha,
trabajadores_horas_extras_mensuales_facturacion.Ano,
trabajadores_horas_extras_mensuales_facturacion.Observaciones,
core_tiempo_meses.Nombre AS Mes

FROM `trabajadores_horas_extras_mensuales_facturacion`
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema         = trabajadores_horas_extras_mensuales_facturacion.idSistema
LEFT JOIN `usuarios_listado`        ON usuarios_listado.idUsuario      = trabajadores_horas_extras_mensuales_facturacion.idUsuario
LEFT JOIN `core_tiempo_meses`       ON core_tiempo_meses.idMes         = trabajadores_horas_extras_mensuales_facturacion.idMes

WHERE trabajadores_horas_extras_mensuales_facturacion.idFacturacion = {$_GET['view']} ";
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


/*****************************************/		
// Se trae un listado con todos los otros
$arrHoras = array();
$query = "SELECT 
trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador,
trabajadores_listado.Nombre,
trabajadores_listado.ApellidoPat,
trabajadores_listado.ApellidoMat,
trabajadores_listado.Rut,
trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje,
trabajadores_horas_extras_mensuales_facturacion_horas.N_Horas, 
core_horas_extras_porcentajes.Porcentaje

FROM `trabajadores_horas_extras_mensuales_facturacion_horas` 
LEFT JOIN `trabajadores_listado`           ON trabajadores_listado.idTrabajador            = trabajadores_horas_extras_mensuales_facturacion_horas.idTrabajador
LEFT JOIN `core_horas_extras_porcentajes`  ON core_horas_extras_porcentajes.idPorcentaje   = trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje

WHERE trabajadores_horas_extras_mensuales_facturacion_horas.idFacturacion = {$_GET['view']} ";
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
array_push( $arrHoras,$row );
}

$arrHorasExtras = array();
foreach ($arrHoras as $prod){
	$arrHorasExtras[$prod['idTrabajador']]['TrabajadorNombre']                         = $prod['Nombre'].' '.$prod['ApellidoPat'].' '.$prod['ApellidoMat'];
	$arrHorasExtras[$prod['idTrabajador']]['TrabajadorRut']                            = $prod['Rut'];
	$arrHorasExtras[$prod['idTrabajador']]['idTrabajador']                             = $prod['idTrabajador'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['idPorcentaje']]['idTrabajador']      = $prod['idTrabajador'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['idPorcentaje']]['porcentaje_dia']    = $prod['idPorcentaje'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['idPorcentaje']]['horas_dia']         = $prod['N_Horas'];
}

//Porcentaje
$arrPorcentajes = array();
$query = "SELECT idPorcentaje, Porcentaje
FROM `core_horas_extras_porcentajes` 
ORDER BY idPorcentaje";
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
array_push( $arrPorcentajes,$row );
}

/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `trabajadores_horas_extras_mensuales_facturacion_archivos` 
WHERE idFacturacion = {$_GET['view']} ";
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
array_push( $arrArchivo,$row );
}
/*****************************************/		
// Se trae un listado con todos los otros
$arrHorasTotal = array();
$query = "SELECT 
trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje,
SUM(trabajadores_horas_extras_mensuales_facturacion_horas.N_Horas) AS Total, 
core_horas_extras_porcentajes.Porcentaje

FROM `trabajadores_horas_extras_mensuales_facturacion_horas` 
LEFT JOIN `core_horas_extras_porcentajes`  ON core_horas_extras_porcentajes.idPorcentaje   = trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje

WHERE trabajadores_horas_extras_mensuales_facturacion_horas.idFacturacion = {$_GET['view']} 
GROUP BY trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje
ORDER BY trabajadores_horas_extras_mensuales_facturacion_horas.idPorcentaje ASC ";
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
array_push( $arrHorasTotal,$row );
}


?>

<div class="col-sm-12 fcenter">

	<div id="page-wrap">
		<div id="header"> Horas Extras Mensuales</div>

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"></td>
					</tr>
					<tr>
						<td class="meta-head">Periodo</td>
						<td><?php echo $row_data['Ano'].' - '.$row_data['Mes']; ?></td>
					</tr>
					<tr>
						<td class="meta-head">Usuario Ingreso</td>
						<td><?php echo $row_data['Usuario']?></td>
					</tr>
					<tr>
						<td class="meta-head">Sistema</td>
						<td><?php echo $row_data['SistemaOrigen']?></td>
					</tr>
				</tbody>
			</table>
			<table id="meta" class="otdata2">
				<tbody>
					<tr>
						<td class="meta-head">Fecha Facturacion</td>
						<td colspan="2"><?php echo Fecha_estandar($row_data['Creacion_fecha'])?></td>
					</tr>
					<tr>
						<td class="meta-head">Fecha Ingreso</td>
						<td colspan="2"><?php echo Fecha_estandar($row_data['fecha_auto'])?></td>
					</tr>
				</tbody>
			</table>

				
		</div>
		<table id="items">
			<tbody>
				
				<?php
				//cuento la cantidad de columnas a utilizar
				$data_column = 2;
				$arrColumnas = array();
				//verifico si existen horas
				if (isset($arrHorasExtras)){
					//recorro las horas
					foreach ($arrHorasExtras as $key => $producto){
						foreach ($producto as $prod) {
							foreach ($arrPorcentajes as $porcentaje) {
								if(isset($prod['porcentaje_dia'])&&$prod['porcentaje_dia']==$porcentaje['idPorcentaje']){
									$data_column++;
									$arrColumnas[$porcentaje['idPorcentaje']]['idPorcentaje']  = $porcentaje['idPorcentaje'];
									$arrColumnas[$porcentaje['idPorcentaje']]['Nombre']        = $porcentaje['Porcentaje'];
								}
							}
						}
					}
				}
				//Ordenar las columnas de los porcentajes
				ksort($arrColumnas);
				
				echo '
				<tr>
					<th colspan="'.($data_column-1).'">Detalle</th>
				</tr>';

				/***************************************************/
				echo '<tr class="item-row fact_tittle">';
				echo '<td>Trabajador</td>';
				//Muestro las columnas con los porcentajes validos
				foreach ($arrColumnas as $porcentaje) {
					echo '<td style="text-align: center;">'.$porcentaje['Nombre'].'%</td>';
				}
				echo '<td style="text-align: center;" width="120">Total Horas</td>';
				echo '</tr>';
					
				/***************************************************/
				if (isset($arrHorasExtras)){
					//recorro las horas
					foreach ($arrHorasExtras as $key => $producto){
						//Variables
						$total_horas = 0;
						
						//Codigo
						echo '<tr class="item-row">';
						echo '<td>'.$producto['TrabajadorRut'].' - '.$producto['TrabajadorNombre'].'</td>';
							
						foreach ($arrColumnas as $porcentaje) {
							if(isset($producto[$porcentaje['idPorcentaje']]['porcentaje_dia'])&&$producto[$porcentaje['idPorcentaje']]['porcentaje_dia']){
								echo '<td style="text-align: center;">'.$producto[$porcentaje['idPorcentaje']]['horas_dia'].'</td>';
								$total_horas = $total_horas + $producto[$porcentaje['idPorcentaje']]['horas_dia'];
							}else{
								echo '<td></td>';
							}
						}
						echo '<td style="text-align: center;">'.$total_horas.'</td>';
						echo '</tr>';
					}	
				}
				
				echo '<tr id="hiderow"><td colspan="'.($data_column-1).'"><a name="Ancla_obs"></a></td></tr>';?>
				
				
		
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="<?php echo $data_column-2; ?>" align="right"><strong>Total Horas extras</strong></td> 
						<td align="right"></td>
					</tr>
					
					<?php
					foreach ($arrHorasTotal as $prod) {
						echo '
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="'.($data_column-2).'" align="right">Horas extras al '.$prod['Porcentaje'].'%</td> 
							<td align="right">'.$prod['Total'].' Horas</td>
						</tr>
						';
					}
					



					?>
				
				
				
				<tr>
					<td colspan="10" class="blank word_break"> 
						<?php echo $row_data['Observaciones'];?>
					</td>
				</tr>
				<tr>
					<td colspan="10" class="blank"><p>Observaciones</p></td> 
				</tr>
				
				
							
							
				
			</tbody>
		</table>
    </div>
    
    <?php if ($arrArchivo){ ?>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<tr>
					<th colspan="6">Archivos Adjuntos</th>
				</tr>		  
				<?php foreach ($arrArchivo as $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $producto['Nombre']; ?></td>
						<td width="160">
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?return=true&path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
								<a href="1download.php?dir=upload&file=<?php echo $producto['Nombre']; ?>" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip" ><i class="fa fa-download" aria-hidden="true"></i></a>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
    <?php } ?>


</div>




<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>
 
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>
	</body>
</html>
