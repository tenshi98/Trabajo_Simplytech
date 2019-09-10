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
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
?>

<style>
	hr {margin-bottom: 5px !important;margin-top: 5px !important;}
	address {margin-bottom: 5px !important;}
	.panel-body {padding: 0px !important;}
</style>
<?php
// Se traen todos los datos del proveedor
$query = "SELECT  fecha_auto, Creacion_fecha, Fecha_desde, Fecha_hasta, Observaciones, 
UF, UTM, IMM, TopeImpAFP, TopeImpIPS, TopeSegCesantia, TopeAPVMensual, TopeDepConv,

idTrabajador,idTipoContratoTrab,TipoContratoTrab,
horas_pactadas,Gratificacion,TrabajadorNombre,TrabajadorRut,TrabajadorEmail,TrabajadorContrato,
TrabajadorCargo,SistemaNombre,SistemaRut,SueldoPactado,DiasPactados,DiasTrabajados,diasInasistencia,
diasLicencias,SueldoPagado,TotalBonoFijoAfecto,TotalBonoFijoNoAfecto,TotalBonoTurno,
TotalBonoTemporalAfecto,TotalBonoTemporalNoAfecto,TotalHorasExtras,Cargas_n,Cargas_valor,
Cargas_idTramo,Cargas_tramo,TotalCargasFamiliares,SueldoImponible,SueldoNoImponible,
TotalHaberes,AFP_idAFP,AFP_Nombre,AFP_Porcentaje,AFP_Total,AFP_SIS,Salud_idAFP,
Salud_Nombre,Salud_Porcentaje,Salud_Total ,TotalDescuentos,SegCesantia_Empleador,
SegCesantia_Trabajador,ImpuestoRenta,RentaAfecta,TotalAPagar
FROM `rrhh_sueldos_facturacion_trabajadores`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);	
/**************************************************************/
//Anticipos
$arrAnticipos = array();
$query = "SELECT Creacion_fecha, Monto
FROM `rrhh_sueldos_facturacion_trabajadores_anticipos`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrAnticipos,$row );
}
/**************************************************************/
//Bonos Fijos
$arrBonoFijo = array();
$query = "SELECT BonoNombre, BonoMonto, BonoTipo
FROM `rrhh_sueldos_facturacion_trabajadores_bonofijo`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrBonoFijo,$row );
}
/**************************************************************/
//Bonos Temporales
$arrBonoTemporal = array();
$query = "SELECT BonoNombre, BonoMonto, BonoTipo
FROM `rrhh_sueldos_facturacion_trabajadores_bonotemporal`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrBonoTemporal,$row );
}
/**************************************************************/
//Bonos Turnos
$arrBonoTurno = array();
$query = "SELECT BonoNombre, BonoMonto
FROM `rrhh_sueldos_facturacion_trabajadores_bonoturno`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrBonoTurno,$row );
}
/**************************************************************/
//Descuentos Fijos
$arrDescuentoFijo = array();
$query = "SELECT idDescuentoFijo , DescuentoNombre, DescuentoMonto
FROM `rrhh_sueldos_facturacion_trabajadores_descuentofijo`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrDescuentoFijo,$row );
}
/**************************************************************/
//Descuentos 
$arrDescuento = array();
$query = "SELECT Fecha, nCuota, TotalCuotas, monto_cuotas, Tipo
FROM `rrhh_sueldos_facturacion_trabajadores_descuentos`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrDescuento,$row );
}
/**************************************************************/
//Horas Extras 
$arrHoraExtra = array();
$query = "SELECT Porcentaje, N_Horas, ValorHora, TotalHora
FROM `rrhh_sueldos_facturacion_trabajadores_horasextras`
WHERE idFactTrab = {$_GET['idFactTrab']}";
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
array_push( $arrHoraExtra,$row );
}
?>

<div class="invoice">
	<div class="row">
		<div class="col-sm-4 invoice-col">
			Indicadores
			<address>
				<strong>UF</strong>: <span class="pull-right"><?php echo valores($rowdata['UF'], 0); ?></span><br>
				<strong>UTM</strong>: <span class="pull-right"><?php echo valores($rowdata['UTM'], 0); ?></span><br>
				<strong>Renta Minima</strong>: <span class="pull-right"><?php echo valores($rowdata['IMM'], 0); ?></span><br>
				<strong>Tope Imponible AFP</strong>: <span class="pull-right"><?php echo valores($rowdata['TopeImpAFP'], 0); ?></span><br>
				<strong>Tope Imponible IPS</strong>: <span class="pull-right"><?php echo valores($rowdata['TopeImpIPS'], 0); ?></span><br>
				<strong>Tope Seguro Cesantia</strong>: <span class="pull-right"><?php echo valores($rowdata['TopeSegCesantia'], 0); ?></span><br>
				<strong>Tope APV Mensual</strong>: <span class="pull-right"><?php echo valores($rowdata['TopeAPVMensual'], 0); ?></span><br>
				<strong>Tope Deposito Convenido</strong>: <span class="pull-right"><?php echo valores($rowdata['TopeDepConv'], 0); ?></span><br>
			</address>
		</div>
		
		<div class="col-sm-4 invoice-col">
			Pago Empresa
			<address>
				<?php
				if(isset($rowdata['AFP_SIS'])){echo '<strong>AFP SIS</strong>: <span class="pull-right">'.Valores($rowdata['AFP_SIS'], 0).'</span> <br>';}
				if(isset($rowdata['SegCesantia_Empleador'])){echo '<strong>Seg Cesantia Empleador</strong>: <span class="pull-right">'.Valores($rowdata['SegCesantia_Empleador'], 0).'</span> <br>';}
				
				?>
			</address>
		</div>
	</div>

	<div class="clearfix"></div>
</div>

<div class="invoice">
    <div class="row">
        <div class="col-sm-12">
    		<div class="invoice-title">
    			<h2>
					Liquidacion de Remuneraciones
					<small class="pull-right">Mes <?php echo fecha2NombreMes($rowdata['Creacion_fecha']).' de '.fecha2Ano($rowdata['Creacion_fecha'])?></small>
    			</h2>
    			
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-sm-12">
    				<address>
						<strong>Empresa:</strong><?php echo $rowdata['SistemaNombre']; ?><br>
						<strong>Rut:</strong><?php echo $rowdata['SistemaRut']; ?>
    				</address>
    			</div>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-sm-6">
    				<address>
						<strong>Trabajador Sr(a):</strong><?php echo $rowdata['TrabajadorNombre']; ?><br>
						<strong>R.U.T.:</strong><?php echo $rowdata['TrabajadorRut']; ?><br>
    					<strong>Fecha Contrato:</strong><?php echo $rowdata['TrabajadorContrato']; ?><br>
    					<strong>Cargo:</strong><?php echo $rowdata['TrabajadorCargo']; ?><br>
    				</address>
    			</div>
    			<div class="col-sm-6">
    				<address>
						<?php
							if(isset($rowdata['DiasPactados'])){echo '<strong>Dias Pactados</strong>: '.$rowdata['DiasPactados'].' Dias<br>';}
							if(isset($rowdata['diasLicencias'])){echo '<strong>Licencias</strong>: '.$rowdata['diasLicencias'].' Dias<br>';}
							if(isset($rowdata['diasInasistencia'])){echo '<strong>Dias Inasistencias</strong>: '.$rowdata['diasInasistencia'].' Dias<br>';}
						?>
					</address>
    			</div>
    		</div>

    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h4 class="panel-title text-center"><strong>Haberes</strong></h4>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<tbody>
    							<tr>
									<td><?php echo $rowdata['TipoContratoTrab'].' '.valores($rowdata['SueldoPactado'], 0); ?></td>
    								<td class="text-center" colspan="2"><?php echo $rowdata['DiasTrabajados']?> Dias Remunerados</td>
    								<td align="right"><?php echo valores($rowdata['SueldoPagado'], 0); ?></td>
    							</tr>
    							
    							<?php if(isset($rowdata['Gratificacion'])&&$rowdata['Gratificacion']!=''){ ?>
									<tr>
										<td colspan="3">Gratificacion</td>
										<td align="right"><?php echo valores($rowdata['Gratificacion'], 0); ?></td>
									</tr>
    							<?php } ?>
    							<?php if(isset($rowdata['TotalHorasExtras'])&&$rowdata['TotalHorasExtras']!=''){ ?>
									<tr>	
										<td colspan="3">Horas Extras</td>
										<td align="right"><?php echo valores($rowdata['TotalHorasExtras'], 0); ?></td>	
									</tr>
									<?php
									foreach ($arrHoraExtra as $prod) { ?>
										<tr>
											<td></td>
											<td><?php echo $prod['N_Horas'].' HR '.$prod['Porcentaje'].'% ('.valores($prod['ValorHora'], 0).')'; ?></td>
											<td align="right"><?php echo valores($prod['TotalHora'], 0); ?></td>
											<td align="right"></td>
										</tr>
									<?php	
									}
								} ?>
								<?php if(isset($rowdata['TotalCargasFamiliares'])&&$rowdata['TotalCargasFamiliares']!=''){ ?>
									<tr>
										<td>Asignación Familiar</td>
										<td colspan="2"><?php echo $rowdata['Cargas_n'].' Cargas (Tramo '.$rowdata['Cargas_tramo'].')'  ?></td>
										<td align="right"><?php echo valores($rowdata['Cargas_valor'], 0); ?></td>
									</tr>
    							<?php } ?>
								<?php if(isset($rowdata['TotalBonoTurno'])&&$rowdata['TotalBonoTurno']!=''){ ?>
									<tr>	
										<td colspan="3">Bonos por Turnos Imponibles</td>
										<td align="right"><?php echo valores($rowdata['TotalBonoTurno'], 0); ?></td>	
									</tr>
									<?php
									foreach ($arrBonoTurno as $prod) { ?>
										<tr>
											<td></td>
											<td><?php echo $prod['BonoNombre']; ?></td>
											<td align="right"><?php echo valores($prod['BonoMonto'], 0); ?></td>
											<td align="right"></td>
										</tr>
									<?php	
									}
								} ?>
								<?php if(isset($rowdata['TotalBonoFijoAfecto'])&&$rowdata['TotalBonoFijoAfecto']!=''){ ?>
									<tr>
										<td colspan="3">Bonos Fijos Imponibles</td>
										<td align="right"><?php echo valores($rowdata['TotalBonoFijoAfecto'], 0); ?></td>
									</tr>
									<?php
									foreach ($arrBonoFijo as $prod) {
										//verifico si existe y si esta afecto a descuentos
										if(isset($prod['BonoTipo'])&&$prod['BonoTipo']==1){?>
											<tr>
												<td></td>
												<td><?php echo $prod['BonoNombre']; ?></td>
												<td align="right"><?php echo valores($prod['BonoMonto'], 0); ?></td>
												<td align="right"></td>
											</tr>
										<?php	
										}
									}
								} ?>
								<?php if(isset($rowdata['TotalBonoTemporalAfecto'])&&$rowdata['TotalBonoTemporalAfecto']!=''){ ?>
									<tr>	
										<td colspan="3">Bonos Temporales Imponibles</td>
										<td align="right"><?php echo valores($rowdata['TotalBonoTemporalAfecto'], 0); ?></td>	
									</tr>
									<?php
									foreach ($arrBonoTemporal as $prod) {
										//verifico si existe y si esta afecto a descuentos
										if(isset($prod['BonoTipo'])&&$prod['BonoTipo']==1){?>
											<tr>
												<td></td>
												<td><?php echo $prod['BonoNombre']; ?></td>
												<td align="right"><?php echo valores($prod['BonoMonto'], 0); ?></td>
												<td align="right"></td>
											</tr>
										<?php	
										}
									}
								} ?>
								
								
								<?php if(isset($rowdata['TotalBonoFijoNoAfecto'])&&$rowdata['TotalBonoFijoNoAfecto']!=''){ ?>
									<tr>	
										<td colspan="3">Bonos Fijos No Imponibles</td>
										<td align="right"><?php echo valores($rowdata['TotalBonoFijoNoAfecto'], 0); ?></td>	
									</tr>
									<?php
									foreach ($arrBonoFijo as $prod) {
										//verifico si existe y si esta afecto a descuentos
										if(isset($prod['BonoTipo'])&&$prod['BonoTipo']==2){?>
											<tr>
												<td></td>
												<td><?php echo $prod['BonoNombre']; ?></td>
												<td align="right"><?php echo valores($prod['BonoMonto'], 0); ?></td>
												<td align="right"></td>
											</tr>
										<?php	
										}
									}
								} ?>
								<?php if(isset($rowdata['TotalBonoTemporalNoAfecto'])&&$rowdata['TotalBonoTemporalNoAfecto']!=''){ ?>
									<tr>	
										<td colspan="3">Bonos Temporales No Imponibles</td>
										<td align="right"><?php echo valores($rowdata['TotalBonoTemporalNoAfecto'], 0); ?></td>	
									</tr>
									<?php
									foreach ($arrBonoTemporal as $prod) {
										//verifico si existe y si esta afecto a descuentos
										if(isset($prod['BonoTipo'])&&$prod['BonoTipo']==2){?>
											<tr>
												<td></td>
												<td><?php echo $prod['BonoNombre']; ?></td>
												<td align="right"><?php echo valores($prod['BonoMonto'], 0); ?></td>
												<td align="right"></td>
											</tr>
										<?php	
										}
									}
								} ?>
    							<tr>
									<td align="right" colspan="3"><strong>Total Imponible</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['SueldoImponible'], 0); ?></strong></td>
								</tr>
								<tr>
									<td align="right" colspan="3"><strong>Total No Imponible</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['SueldoNoImponible'], 0); ?></strong></td>
								</tr>
								<tr>
									<td align="right" colspan="3"><strong>Total Haberes</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['TotalHaberes'], 0); ?></strong></td>
								</tr>
    							
    							
    							
								<tr class="active"><td class="text-center" colspan="4"><strong>Deberes</strong></td></tr>
								<?php if(isset($rowdata['AFP_Total'])&&$rowdata['AFP_Total']!=''){ ?>
									<tr>
										<td colspan="3"><?php echo $rowdata['AFP_Nombre'].' ('.$rowdata['AFP_Porcentaje'].'%)'; ?></td>
										<td align="right"><?php echo valores($rowdata['AFP_Total'], 0); ?></td>
									</tr>
								<?php }
								if(isset($rowdata['Salud_Total'])&&$rowdata['Salud_Total']!=''){ ?>
									<tr>
										<td colspan="3"><?php echo $rowdata['Salud_Nombre'].' ('.$rowdata['Salud_Porcentaje'].'%)'; ?></td>
										<td align="right"><?php echo valores($rowdata['Salud_Total'], 0); ?></td>
									</tr>
								<?php }
								foreach ($arrDescuentoFijo as $prod) {
									//verifico si existe y si esta afecto a descuentos
									if(isset($prod['DescuentoMonto'])){ ?>
										<tr>
											<td colspan="3">
											<?php
											//Verifico si alguno de los descuentos es superior
											//APV
											if($prod['idDescuentoFijo']==1){
												//Si el monto establecido es superior al tope
												if($prod['DescuentoMonto']>$rowdata['TopeAPVMensual']){
													echo '<span style="color: #ce4844;">Pasa Tope</span>';
												}
											//Deposito Convenido	
											}elseif($prod['idDescuentoFijo']==2){
												//Si el monto establecido es superior al tope
												if($prod['DescuentoMonto']>$rowdata['TopeDepConv']){
													echo '<span style="color: #ce4844;">Pasa Tope</span>';
												}
											}
											echo $prod['DescuentoNombre']; ?>
											</td>
											<td align="right"><?php echo valores($prod['DescuentoMonto'], 0); ?></td>
										</tr>
									<?php }
								}
								if(isset($rowdata['SegCesantia_Trabajador'])&&$rowdata['SegCesantia_Trabajador']!=''){ ?>
									<tr>
										<td colspan="3">Seguro de Cesantia</td>
										<td align="right"><?php echo valores($rowdata['SegCesantia_Trabajador'], 0); ?></td>
									</tr>
								<?php }
								if(isset($rowdata['ImpuestoRenta'])&&$rowdata['ImpuestoRenta']!=''&&$rowdata['ImpuestoRenta']!=0){ ?>
									<tr>
										<td colspan="3">Impuesto a la Renta (<?php echo valores($rowdata['RentaAfecta'], 0); ?>)</td>
										<td align="right"><?php echo valores($rowdata['ImpuestoRenta'], 0); ?></td>
									</tr>
								<?php }
								foreach ($arrAnticipos as $prod) { ?>
										<tr>
											<td colspan="3">Anticipo Fecha <?php echo fecha_estandar($prod['Creacion_fecha']); ?></td>
											<td align="right"><?php echo valores($prod['Monto'], 0); ?></td>
										</tr>
								<?php }
								foreach ($arrDescuento as $prod) { ?>
										<tr>
											<td colspan="3"><?php echo $prod['Tipo'].' fecha '.fecha_estandar($prod['Fecha']).' ('.$prod['nCuota'].' de '.$prod['TotalCuotas'].')'; ?></td>
											<td align="right"><?php echo valores($prod['monto_cuotas'], 0); ?></td>
										</tr>
								<?php } ?>
								<tr>
									<td align="right" colspan="3"><strong>Total Deberes</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['TotalDescuentos'], 0); ?></strong></td>
								</tr>
								
								
								
								
								
								<tr class="active"><td class="text-center" colspan="4"><strong>Alcance Liquido</strong></td></tr>
								<tr>
									<td align="right" colspan="3"><strong>Alcance Liquido</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['TotalHaberes'], 0); ?></strong></td>
								</tr>
								<tr>
									<td align="right" colspan="3"><strong>Total Deberes</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['TotalDescuentos'], 0); ?></strong></td>
								</tr>
    							<tr>
									<td align="right" colspan="3"><strong>Total a Pagar</strong></td>
									<td align="right"><strong><?php echo valores($rowdata['TotalAPagar'], 0); ?></strong></td>
								</tr>
                                
                                
                     
					
					
					
					
					
					
				
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>







<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>