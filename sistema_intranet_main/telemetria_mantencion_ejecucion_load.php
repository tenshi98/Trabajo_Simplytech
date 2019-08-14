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
/*                                               Ejecucion del codigo                                                             */
/**********************************************************************************************************************************/
//Traigo todos los valores	
$subquery = '';
for ($i = 1; $i <= 50; $i++) {
	$subquery .= ',telemetria_listado.SensoresNombre_'.$i.' AS Tel_Sensor_Nombre_'.$i;
	$subquery .= ',telemetria_listado.SensoresMant_'.$i.' AS Tel_Sensor_Valor_'.$i;
	$subquery .= ',telemetria_listado.SensoresTipo_'.$i.' AS Tel_Sensor_Tipo_'.$i;
	
	$subquery .= ',telemetria_mantencion_matriz.PuntoNombre_'.$i.' AS Matriz_Punto_'.$i;
	$subquery .= ',telemetria_mantencion_matriz.SensoresTipo_'.$i.' AS Matriz_Sensor_Tipo_'.$i;
	$subquery .= ',telemetria_mantencion_matriz.SensoresValor_'.$i.' AS Matriz_Sensor_Valor_'.$i;
	$subquery .= ',telemetria_mantencion_matriz.SensoresNumero_'.$i.' AS Matriz_Sensor_Numero_'.$i;

}

// Se traen todos los datos de mi usuario
$query = "SELECT  
telemetria_listado.Nombre AS Tel_Equipo,
telemetria_listado.Identificador AS Tel_Identificador,
telemetria_listado.FechaMantencionIni AS Tel_Fecha,
telemetria_listado.HoraMantencionIni AS Tel_Hora,

telemetria_mantencion_matriz.Nombre AS Matriz_Nombre,
telemetria_mantencion_matriz.cantPuntos AS Matriz_Puntos

".$subquery."

FROM `telemetria_listado`
LEFT JOIN `telemetria_mantencion_matriz` ON telemetria_mantencion_matriz.idMatriz = telemetria_listado.idMatriz

WHERE idTelemetria = {$_GET['verify']}";
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

//Se traen todos los tipos
$arrTipos = array();
$query = "SELECT 
telemetria_listado_sensores.idSensores,
telemetria_listado_sensores.Nombre,
core_sensores_funciones.Nombre AS SensorFuncion

FROM `telemetria_listado_sensores`
LEFT JOIN `core_sensores_funciones` ON core_sensores_funciones.idSensorFuncion = telemetria_listado_sensores.idSensorFuncion
ORDER BY idSensores ASC";
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
array_push( $arrTipos,$row );
}
//Variable Ubicacion
//Cargamos la ubicacion 
$original = "telemetria_mantencion_ejecucion.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){  $location .= "&Identificador=".$_GET['Identificador'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                $location .= "&Nombre=".$_GET['Nombre'];}

?>




	<section class="invoice">

		<div class="row">
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i> <?php echo $rowdata['Tel_Equipo'].' ('.$rowdata['Tel_Identificador'].')'; ?>.
					<small class="pull-right"> <?php echo $rowdata['Matriz_Nombre'] ?></small>
				</h2>
			</div>   
		</div>
		
		<div class="row invoice-info">
			<div class="col-sm-6 invoice-col">
				<strong>Datos Mantencion</strong>
				<address>
					Fecha Inicio: <?php echo fecha_estandar($rowdata['Tel_Fecha']); ?><br/>
					Hora Inicio: <?php echo $rowdata['Tel_Hora'].' horas'; ?>
					<strong></strong>
				</address>
			</div>
					
			<div class="col-sm-6 invoice-col">
						
			</div>
		</div>
		
		
		<div class="">
			<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Sensor</th>
							<th>Dato a Revisar</th>
							<th>Tipo Sensor <br/>Instalado</th>
							<th>Tipo Sensor <br/>Revisado</th>
							<th>Funcion</th>
							<th style="text-align: center;" width="120">Valor Pruebas</th>
							<th style="text-align: center;" width="120">Valor Actual</th>
							<th style="text-align: center;" width="120">Estado</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$pass_points = 0;
						for ($i = 1; $i <= $rowdata['Matriz_Puntos']; $i++) { ?>
							<tr class="odd">		
								<td><?php echo $rowdata['Tel_Sensor_Nombre_'.$rowdata['Matriz_Sensor_Numero_'.$i]]; ?></td>
								<td><?php echo $rowdata['Matriz_Punto_'.$i]; ?></td>
								<td><?php foreach ($arrTipos as $tipo) { if($rowdata['Matriz_Sensor_Tipo_'.$rowdata['Tel_Sensor_Tipo_'.$i]]==$tipo['idSensores']){ echo $tipo['Nombre'];}} ?></td>	
								<td><?php foreach ($arrTipos as $tipo) { if($rowdata['Matriz_Sensor_Tipo_'.$i]==$tipo['idSensores']){ echo $tipo['Nombre'];}} ?></td>	
								<td><?php foreach ($arrTipos as $tipo) { if($rowdata['Matriz_Sensor_Tipo_'.$i]==$tipo['idSensores']){ echo $tipo['SensorFuncion'];}} ?></td>	
								<td align="center"><?php echo $rowdata['Matriz_Sensor_Valor_'.$i]; ?></td>	
								<td align="center"><?php echo Cantidades_decimales_justos($rowdata['Tel_Sensor_Valor_'.$i]); ?></td>
								<td align="center">
									<?php
									if($rowdata['Matriz_Sensor_Valor_'.$i]<$rowdata['Tel_Sensor_Valor_'.$i]){
										echo '<span style="color:#55BD55">Pasa</span>';
										$pass_points++;
									}else{		
										echo '<span style="color:#FF3A00">No Pasa</span>';
									}
									?>
								</td>
							</tr>
						<?php } ?>
						

					</tbody>
				</table>

			</div>
		</div>
		
		
		

		<div class="clearfix"></div>
		
		<div class="row" style="margin-top:15px;">
			<div class="col-xs-12">
				
				<?php if($pass_points>=$rowdata['Matriz_Puntos']){ ?>
					<a href="<?php echo $location.'&verify='.$_GET['verify'].'&end=true'; ?>" class="btn btn-primary pull-right"  style="margin-left: 5px;" >
						<i class="fa fa-check-circle" aria-hidden="true"></i> Finalizar Mantencion
					</a>
				<?php } ?>
				
				<a href="<?php echo $location.'&verify='.$_GET['verify'].'&reset=true'; ?>" class="btn btn-default pull-right">
					<i class="fa fa-window-close-o" aria-hidden="true"></i> Resetear Valores
				</a>


			</div>
		</div>
		  
	</section>



