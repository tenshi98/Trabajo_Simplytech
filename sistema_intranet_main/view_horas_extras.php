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
trabajadores_horas_extras_facturacion.fecha_auto,
trabajadores_horas_extras_facturacion.Creacion_fecha,
trabajadores_horas_extras_facturacion.Fecha_desde,
trabajadores_horas_extras_facturacion.Fecha_hasta,
trabajadores_horas_extras_facturacion.Observaciones

FROM `trabajadores_horas_extras_facturacion`
LEFT JOIN `core_sistemas`           ON core_sistemas.idSistema         = trabajadores_horas_extras_facturacion.idSistema
LEFT JOIN `usuarios_listado`        ON usuarios_listado.idUsuario      = trabajadores_horas_extras_facturacion.idUsuario

WHERE trabajadores_horas_extras_facturacion.idFacturacion = {$_GET['view']} ";
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
trabajadores_horas_extras_facturacion_horas.idTrabajador,
trabajadores_listado.Nombre,
trabajadores_listado.ApellidoPat,
trabajadores_listado.ApellidoMat,
trabajadores_listado.Rut,

trabajadores_horas_extras_facturacion_horas.nSem, 
trabajadores_horas_extras_facturacion_horas.Fecha, 
trabajadores_horas_extras_facturacion_horas.N_Horas, 

core_horas_extras_porcentajes.Porcentaje

FROM `trabajadores_horas_extras_facturacion_horas` 
LEFT JOIN `trabajadores_listado`           ON trabajadores_listado.idTrabajador            = trabajadores_horas_extras_facturacion_horas.idTrabajador
LEFT JOIN `core_horas_extras_porcentajes`  ON core_horas_extras_porcentajes.idPorcentaje   = trabajadores_horas_extras_facturacion_horas.idPorcentaje

WHERE trabajadores_horas_extras_facturacion_horas.idFacturacion = {$_GET['view']} ";
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
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']]['nSem']                        = $prod['nSem'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']]['idTrabajador']                = $prod['idTrabajador'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']]['TrabajadorNombre']            = $prod['Nombre'].' '.$prod['ApellidoPat'].' '.$prod['ApellidoMat'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']]['TrabajadorRut']               = $prod['Rut'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']][$prod['Fecha']]['fecha_dia']   = $prod['Fecha'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']][$prod['Fecha']]['horas_dia']   = $prod['N_Horas'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']][$prod['Fecha']]['porcentaje']  = $prod['Porcentaje'];
}
/*****************************************/		
// Se trae un listado con todos los otros
$arrTurnos = array();
$query = "SELECT 
trabajadores_horas_extras_facturacion_turnos.idTurnos,
trabajadores_horas_extras_facturacion_turnos.idTrabajador,
trabajadores_horas_extras_facturacion_turnos.nSem, 
core_horas_extras_turnos.Nombre AS Turno

FROM `trabajadores_horas_extras_facturacion_turnos` 
LEFT JOIN `core_horas_extras_turnos`   ON core_horas_extras_turnos.idTurnos   = trabajadores_horas_extras_facturacion_turnos.idTurnos

WHERE trabajadores_horas_extras_facturacion_turnos.idFacturacion = {$_GET['view']} ";
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
array_push( $arrTurnos,$row );
}
foreach ($arrTurnos as $prod){
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']]['Turno']      = $prod['Turno'];
	$arrHorasExtras[$prod['idTrabajador']][$prod['nSem']]['idTurnos']   = $prod['idTurnos'];	
}

/*****************************************/		
// Se trae un listado con todos los archivos adjuntos
$arrArchivo = array();
$query = "SELECT Nombre
FROM `trabajadores_horas_extras_facturacion_archivos` 
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
trabajadores_horas_extras_facturacion_horas.idPorcentaje,
SUM(trabajadores_horas_extras_facturacion_horas.N_Horas) AS Total, 
core_horas_extras_porcentajes.Porcentaje

FROM `trabajadores_horas_extras_facturacion_horas` 
LEFT JOIN `core_horas_extras_porcentajes`  ON core_horas_extras_porcentajes.idPorcentaje   = trabajadores_horas_extras_facturacion_horas.idPorcentaje

WHERE trabajadores_horas_extras_facturacion_horas.idFacturacion = {$_GET['view']} 
GROUP BY trabajadores_horas_extras_facturacion_horas.idPorcentaje
ORDER BY trabajadores_horas_extras_facturacion_horas.idPorcentaje ASC ";
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
		<div id="header"> Horas Extras</div>

		
		<div id="customer">
			
			<table id="meta" class="fleft otdata">
				<tbody>
					<tr>
						<td class="meta-head"><strong>DATOS BASICOS</strong></td>
						<td class="meta-head"></td>
					</tr>
					<tr>
						<td class="meta-head">Periodo Desde</td>
						<td><?php echo Fecha_estandar($row_data['Fecha_desde'])?></td>
					</tr>
					<tr>
						<td class="meta-head">Periodo Hasta</td>
						<td><?php echo Fecha_estandar($row_data['Fecha_hasta'])?></td>
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
				
				<tr>
					<th colspan="10">Detalle</th>
				</tr>		  
				
				<tr class="item-row fact_tittle">
					<td>Trabajador</td>
					<td>N° Semana</td>
					<td>Lunes</td>
					<td>Martes</td>
					<td>Miercoles</td>
					<td>Jueves</td>
					<td>Viernes</td>
					<td>Sabado</td>
					<td>Domingo</td>
					<td>Turno</td>
				</tr>
				
				<?php

				//Obtengo el numero de semanas de la seleccion
				$nSemanas      = ceil ((dias_transcurridos($row_data['Fecha_desde'],$row_data['Fecha_hasta']))/7);
				$DiaActual     = $row_data['Fecha_desde'];
				$nDias         = dias_transcurridos($row_data['Fecha_desde'],$row_data['Fecha_hasta']);
				$Dia           = 1;
				$DiaActual_ex  = $row_data['Fecha_desde'];
				$Dia_ex        = 1;
				$TotalHoras    = array();
				
				//Recorro las semanas seleccionadas
				for($xsi1=1;$xsi1<=$nSemanas;$xsi1++){
					echo '<tr class="item-row fact_tittle">';
					//Cadena para los dias disponibles
					$cadena = '';
					//Recorro los dias de la semana
					for($i=1;$i<=7;$i++){
						//imprimo la primera celda y el numero de semana actual
						if($xsi1==1&&$i==1){
							$nSem = fecha2NSemana($row_data['Fecha_desde']);
							echo '<td></td>';
							echo '<td>'.$nSem.'</td>';
						}elseif($xsi1!=1&&$i==1){
							$nSem = fecha2NSemana($DiaActual);
							echo '<td></td>';
							echo '<td>'.$nSem.'</td>';
						}
						//Imprimo la fecha en caso de existir
						if($i==fecha2NDiaSemana($DiaActual)&&$Dia<=($nDias+1)){
							$cadena .= '&fecha_dia_'.$i.'='.$DiaActual;
							echo '<td>'.Fecha_estandar($DiaActual).'</td>';
							$DiaActual = sumarDias($DiaActual,1);
							$Dia++;
						}else{
							echo '<td></td>';
						}
				
					}
					echo '<td></td>';
					echo '</tr>';
					/***************************************************/
					if (isset($arrHorasExtras)){
						//imprimo la primera celda y el numero de semana actual
								
						
						foreach ($arrHorasExtras as $key => $producto){
							//Subcadena con el trabajador
							if(isset($producto[$nSem]['idTrabajador'])&&$producto[$nSem]['idTrabajador']){
								$subcadena = '&idTrabajador='.$producto[$nSem]['idTrabajador'];
							}else{
								$subcadena = '';
							}
							
							
							if(isset($producto[$nSem]['nSem'])){
								echo '<tr>';
								echo '<td colspan="2">'.$producto[$nSem]['TrabajadorRut'].' '.$producto[$nSem]['TrabajadorNombre'].'</td>';
										
								//Recorro los dias de la semana
								for($i=1;$i<=7;$i++){

									//Imprimo la fecha en caso de existir
									if($i==fecha2NDiaSemana($DiaActual_ex)&&$Dia_ex<=($nDias+1)){
										if(isset($producto[$nSem][Fecha_normalizada($DiaActual_ex)]['horas_dia'])){
											echo '<td>'.$producto[$nSem][Fecha_normalizada($DiaActual_ex)]['horas_dia'].' ('.$producto[$nSem][Fecha_normalizada($DiaActual_ex)]['porcentaje'].'%)</td>';
										}else{
											echo '<td></td>';
										}
										
										$DiaActual_ex = sumarDias($DiaActual_ex,1);
										$Dia_ex++;
									}else{
										echo '<td></td>';
									}
								}
								echo '<td>'.$producto[$nSem]['Turno'].'</td>';
								echo '</tr>';
								
							}
							
						}
					}
				
				
				}
				

				echo '<tr id="hiderow"><td colspan="10"><a name="Ancla_obs"></a></td></tr>';?>
				
				
		
					<tr class="invoice-total" bgcolor="#f1f1f1">
						<td colspan="9" align="right"><strong>Total Horas extras</strong></td> 
						<td align="right"></td>
					</tr>
					
					<?php
					foreach ($arrHorasTotal as $prod) {
						echo '
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td colspan="9" align="right">Horas extras al '.$prod['Porcentaje'].'%</td> 
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
