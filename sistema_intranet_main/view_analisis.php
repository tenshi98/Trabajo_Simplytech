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
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
//Preconsulta
$query = "SELECT maquinas_listado_matriz.cantPuntos
FROM `analisis_listado`
LEFT JOIN `maquinas_listado_matriz`   ON maquinas_listado_matriz.idMatriz   = analisis_listado.idMatriz
WHERE analisis_listado.idAnalisis = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
$rowpre = mysqli_fetch_assoc ($resultado);
/**********************************************************************/	
//Costruyo cadena con los datos a filtrar
$consql = '';
for ($i = 1; $i <= $rowpre['cantPuntos']; $i++) {
	$consql .= ',maquinas_listado_matriz.PuntoNombre_'.$i.' AS PuntoNombre_'.$i;
	$consql .= ',maquinas_listado_matriz.PuntoMedAceptable_'.$i.' AS PuntoMedAceptable_'.$i;
	$consql .= ',maquinas_listado_matriz.PuntoMedAlerta_'.$i.' AS PuntoMedAlerta_'.$i;
	$consql .= ',maquinas_listado_matriz.PuntoMedCondenatorio_'.$i.' AS PuntoMedCondenatorio_'.$i;
	$consql .= ',maquinas_listado_matriz.PuntoUniMed_'.$i.' AS PuntoUniMed_'.$i;
	$consql .= ',maquinas_listado_matriz.PuntoidTipo_'.$i.' AS PuntoidTipo_'.$i;
	$consql .= ',maquinas_listado_matriz.PuntoidGrupo_'.$i.' AS PuntoidGrupo_'.$i;
	$consql .= ',analisis_listado.Medida_'.$i.' AS Analisis_Medida_'.$i;
}
/**********************************************************************/
// consulto los datos
$query = "SELECT  

maquinas_listado.Codigo AS MaquinaCodigo,
maquinas_listado.Nombre AS MaquinaNombre,
maquinas_listado.Modelo AS MaquinaModelo,
maquinas_listado.Serie AS MaquinaSerie,
maquinas_listado.Fabricante AS MaquinaFabricante,
ubicacion_listado.Nombre  AS MaquinaUbicacion,
ubicacion_listado_level_1.Nombre  AS MaquinaUbicacion_lvl_1,
ubicacion_listado_level_2.Nombre  AS MaquinaUbicacion_lvl_2,
ubicacion_listado_level_3.Nombre  AS MaquinaUbicacion_lvl_3,
ubicacion_listado_level_4.Nombre  AS MaquinaUbicacion_lvl_4,
ubicacion_listado_level_5.Nombre  AS MaquinaUbicacion_lvl_5,

core_analisis_estado.Nombre  AS Analisis_Estado,
core_sistemas.Nombre  AS Analisis_Sistema,
analisis_listado.idOT  AS Analisis_OT,
analisis_listado.f_muestreo  AS Analisis_f_muestreo,
analisis_listado.f_recibida  AS Analisis_f_recibida,
analisis_listado.f_reporte  AS Analisis_f_reporte,
analisis_listado.n_muestra  AS Analisis_n_muestra,
analisis_listado.obs_Diagnostico  AS Analisis_obs_Diagnostico,
analisis_listado.obs_Accion  AS Analisis_obs_Accion,

core_sistemas.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
core_sistemas.Direccion AS SistemaOrigenDireccion,
core_sistemas.Contacto_Fono1 AS SistemaOrigenFono,
core_sistemas.email_principal AS SistemaOrigenEmail,
core_sistemas.Rut AS SistemaOrigenRut,

analisis_listado.idTipo,
laboratorio_listado.Nombre AS LaboratorioNombre,
lab_ciudad.Nombre AS LaboratorioCiudad,
lab_comuna.Nombre AS LaboratorioComuna,
laboratorio_listado.Direccion AS LaboratorioDireccion,
laboratorio_listado.Fono1 AS LaboratorioFono1,
laboratorio_listado.Fono2 AS LaboratorioFono2,
laboratorio_listado.email AS LaboratorioEmail,
laboratorio_listado.PersonaContacto AS LaboratorioContacto,
laboratorio_listado.Rut AS LaboratorioRut,

maquinas_listado_matriz.Nombre  AS Analisis_Nombre
".$consql."

FROM `analisis_listado`
LEFT JOIN `maquinas_listado`                        ON maquinas_listado.idMaquina              = analisis_listado.idMaquina
LEFT JOIN `ubicacion_listado`                       ON ubicacion_listado.idUbicacion           = maquinas_listado.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`               ON ubicacion_listado_level_1.idLevel_1     = maquinas_listado.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`               ON ubicacion_listado_level_2.idLevel_2     = maquinas_listado.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`               ON ubicacion_listado_level_3.idLevel_3     = maquinas_listado.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`               ON ubicacion_listado_level_4.idLevel_4     = maquinas_listado.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`               ON ubicacion_listado_level_5.idLevel_5     = maquinas_listado.idUbicacion_lvl_5
LEFT JOIN `maquinas_listado_matriz`                 ON maquinas_listado_matriz.idMatriz        = analisis_listado.idMatriz
LEFT JOIN `core_analisis_estado`                    ON core_analisis_estado.idEstado           = analisis_listado.idEstado
LEFT JOIN `core_sistemas`                           ON core_sistemas.idSistema                 = analisis_listado.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                  = core_sistemas.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                  = core_sistemas.idComuna

LEFT JOIN `laboratorio_listado`                     ON laboratorio_listado.idLaboratorio       = analisis_listado.idLaboratorio
LEFT JOIN `core_ubicacion_ciudad`   lab_ciudad      ON lab_ciudad.idCiudad                     = laboratorio_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`  lab_comuna      ON lab_comuna.idComuna                     = laboratorio_listado.idComuna

WHERE analisis_listado.idAnalisis = ".$X_Puntero;
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
$row_data = mysqli_fetch_assoc ($resultado);	

/**********************************************************************/
//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUml,Nombre,Abreviatura
FROM `sistema_analisis_uml`
ORDER BY idUml ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnimed,$row );
}
/**********************************************************************/
//Se consultan datos
$arrGrupo = array();
$query = "SELECT idGrupo, Nombre
FROM `maquinas_listado_matriz_grupos`
ORDER BY idGrupo ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGrupo,$row );
}
/**********************************************************************/
//Se traen todos los productos
$arrProducto = array();
$query = "SELECT idProducto, Nombre
FROM `productos_listado`
ORDER BY Nombre ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProducto,$row );
}
/**********************************************************************/
//Se traen todos los productos
$arrDispersancia = array();
$query = "SELECT idDispersancia, Nombre
FROM `core_analisis_dispersancia`
ORDER BY Nombre ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrDispersancia,$row );
}
/**********************************************************************/
//Se traen todos los productos
$arrFlashpoint = array();
$query = "SELECT idFlashPoint, Nombre
FROM `core_analisis_flashpoint`
ORDER BY Nombre ASC";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	php_error_log($NombreUsr, $Transaccion, '', mysqli_errno($dbConn), mysqli_error($dbConn), $query );
		
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFlashpoint,$row );
}
?>


	
<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> <?php echo $row_data['Analisis_Nombre']?>.
				<small class="pull-right">Fecha Reporte: <?php echo Fecha_estandar($row_data['Analisis_f_reporte'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php

				//Si es interno muestro los datos de la empresa
				if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
					echo '
					<div class="col-sm-4 invoice-col">
						Laboratorio
						<address>
							<strong>'.$row_data['SistemaOrigen'].'</strong><br/>
							'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'<br/>
							'.$row_data['SistemaOrigenDireccion'].'<br/>
							Fono : '.$row_data['SistemaOrigenFono'].'<br/>
							Rut: '.$row_data['SistemaOrigenRut'].'<br/>
							Email: '.$row_data['SistemaOrigenEmail'].'<br/>
						</address>
					</div>';
				//si es externo muestro los datos del laboratorio	
				}else{
					echo '
					<div class="col-sm-4 invoice-col">
						Laboratorio
						<address>
							<strong>'.$row_data['LaboratorioNombre'].'</strong><br/>
							'.$row_data['LaboratorioCiudad'].', '.$row_data['LaboratorioComuna'].'<br/>
							'.$row_data['LaboratorioDireccion'].'<br/>
							Fono 1 : '.$row_data['LaboratorioFono1'].'<br/>
							Fono 2 : '.$row_data['LaboratorioFono2'].'<br/>
							Rut: '.$row_data['LaboratorioRut'].'<br/>
							Email: '.$row_data['LaboratorioEmail'].'<br/>
							Persona Contacto: '.$row_data['LaboratorioContacto'].'<br/>
						</address>
					</div>';
				}

				echo '
				<div class="col-sm-4 invoice-col">
					Maquina
					<address>
						<strong>'.$row_data['MaquinaNombre'].'</strong><br/>
						Codigo: '.$row_data['MaquinaCodigo'].'<br/>
						Modelo: '.$row_data['MaquinaModelo'].'<br/>
						Serie: '.$row_data['MaquinaSerie'].'<br/>
						Fabricante: '.$row_data['MaquinaFabricante'].'<br/>
						Ubicacion: '.$row_data['MaquinaUbicacion'];
						if(isset($row_data['MaquinaUbicacion_lvl_1'])&&$row_data['MaquinaUbicacion_lvl_1']!=''){ 
							echo ' - '.$row_data['MaquinaUbicacion_lvl_1'];
						}
						if(isset($row_data['MaquinaUbicacion_lvl_2'])&&$row_data['MaquinaUbicacion_lvl_2']!=''){ 
							echo ' - '.$row_data['MaquinaUbicacion_lvl_2'];
						}
						if(isset($row_data['MaquinaUbicacion_lvl_3'])&&$row_data['MaquinaUbicacion_lvl_3']!=''){ 
							echo ' - '.$row_data['MaquinaUbicacion_lvl_3'];
						}
						if(isset($row_data['MaquinaUbicacion_lvl_4'])&&$row_data['MaquinaUbicacion_lvl_4']!=''){ 
							echo ' - '.$row_data['MaquinaUbicacion_lvl_4'];
						}
						if(isset($row_data['MaquinaUbicacion_lvl_5'])&&$row_data['MaquinaUbicacion_lvl_5']!=''){ 
							echo ' - '.$row_data['MaquinaUbicacion_lvl_5'];
						}
					echo '
					</address>
				</div>
			   
				<div class="col-sm-4 invoice-col">
					<strong>Datos</strong><br/>
					<strong>Estado: </strong>'.$row_data['Analisis_Estado'].'<br/>
					<strong>Sistema: </strong>'.$row_data['Analisis_Sistema'].'<br/>';
					
					if(isset($row_data['Analisis_OT'])&&$row_data['Analisis_OT']!=''&&$row_data['Analisis_OT']!=0){ 
						echo '<strong>Orden Trabajo Relacionada: </strong>'.$row_data['Analisis_OT'].'<br/>';
					}
					if(isset($row_data['Analisis_f_muestreo'])&&$row_data['Analisis_f_muestreo']!=''&&$row_data['Analisis_f_muestreo']!='0000-00-00'){ 
						echo '<strong>Fecha Muestreo : </strong>'.Fecha_estandar($row_data['Analisis_f_muestreo']).'<br/>';
					}
					if(isset($row_data['Analisis_f_recibida'])&&$row_data['Analisis_f_recibida']!=''&&$row_data['Analisis_f_recibida']!='0000-00-00'){ 
						echo '<strong>Fecha Recepcion : </strong>'.Fecha_estandar($row_data['Analisis_f_recibida']).'<br/>';
					}
					if(isset($row_data['Analisis_f_reporte'])&&$row_data['Analisis_f_reporte']!=''&&$row_data['Analisis_f_reporte']!='0000-00-00'){ 
						echo '<strong>Fecha Reporte : </strong>'.Fecha_estandar($row_data['Analisis_f_reporte']).'<br/>';
					}
					if(isset($row_data['Analisis_n_muestra'])&&$row_data['Analisis_n_muestra']!=''){ 
						echo '<strong>Muestra N° : </strong>'.$row_data['Analisis_n_muestra'].'<br/>';
					}
				echo '</div>';
			?>

	</div>
	
	
	<div class="row">
		<div class="col-xs-12 table-responsive"  style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<?php foreach ($arrGrupo as $grupo) {
				//Cuento si hay items dentro de la categoria
				$x_con = 0;
				for ($i = 1; $i <= $rowpre['cantPuntos']; $i++) {
					if($grupo['idGrupo']==$row_data['PuntoidGrupo_'.$i]){
						$x_con++;
					}
				}
					
				//si hay items se muestra todo
				if($x_con!=0){
					
					echo '<table class="table table-striped">';
					echo '<tbody><tr class="active"><td colspan="5"><strong>'.$grupo['Nombre'].'</strong></td></tr>';
					if($grupo['idGrupo']==4 OR $grupo['idGrupo']==5){
						echo '
						<tr class="active">
							<td><strong>Dato Medido</strong></td>
							<td><strong>Medicion Actual</strong></td>
							<td><strong>Aceptable</strong></td>
							<td><strong>Alerta</strong></td>
							<td><strong>Condenatorio</strong></td>
						</tr>';
					}
					
					for ($i = 1; $i <= $rowpre['cantPuntos']; $i++) {
						if($grupo['idGrupo']==$row_data['PuntoidGrupo_'.$i]){
							//obtengo la unidad de medida
							$uniMed = '';
							foreach ($arrUnimed as $med) { 
								if($row_data['PuntoUniMed_'.$i]==$med['idUml']){
									//Verifico la existencia de la abreviatura
									if(isset($med['Abreviatura'])&&$med['Abreviatura']!=''){
										$uniMed = $med['Abreviatura'];
									}else{
										$uniMed = $med['Nombre'];
									}
								}
							}
							//obtengo el producto utilizado
							$Producto = '';
							foreach ($arrProducto as $prod) { 
								if($row_data['Analisis_Medida_'.$i]==$prod['idProducto']){
									$Producto = $prod['Nombre'];
								}
							}
							//obtengo el producto utilizado
							$Dispersancia = '';
							foreach ($arrDispersancia as $prod) { 
								if($row_data['Analisis_Medida_'.$i]==$prod['idDispersancia']){
									$Dispersancia = $prod['Nombre'];
								}
							}
							//obtengo el producto utilizado
							$Flashpoint = '';
							foreach ($arrFlashpoint as $prod) { 
								if($row_data['Analisis_Medida_'.$i]==$prod['idFlashPoint']){
									$Flashpoint = $prod['Nombre'];
								}
							}
							//comparo el tipo de dato a mostrar
							switch ($row_data['PuntoidTipo_'.$i]) {
								//Medidas
								case 1:
									/***************************************************************/
									//variable vacia
									$alert_lvl = '';
									//verifico cual es mayor para proceder a la verificacion
									if($row_data['PuntoMedAceptable_'.$i]>$row_data['PuntoMedCondenatorio_'.$i]){
										//alerta amarilla
										if(isset($row_data['Analisis_Medida_'.$i])&&$row_data['Analisis_Medida_'.$i]!=''&&$row_data['Analisis_Medida_'.$i]>$row_data['PuntoMedAlerta_'.$i]&&$row_data['Analisis_Medida_'.$i]<=$row_data['PuntoMedAceptable_'.$i]){
											//variables alerta amarilla
											$alert_lvl = 'color-green-dark'; //amarilla
										}
										//alerta naranja
										if(isset($row_data['Analisis_Medida_'.$i])&&$row_data['Analisis_Medida_'.$i]!=''&&$row_data['Analisis_Medida_'.$i]>$row_data['PuntoMedCondenatorio_'.$i]&&$row_data['Analisis_Medida_'.$i]<=$row_data['PuntoMedAlerta_'.$i]){
											//variables alerta naranja
											$alert_lvl = 'color-yellow'; //naranja	
										}
										//alerta roja
										if(isset($row_data['Analisis_Medida_'.$i])&&$row_data['Analisis_Medida_'.$i]!=''&&$row_data['Analisis_Medida_'.$i]<=$row_data['PuntoMedCondenatorio_'.$i]){
											//variables alerta roja
											$alert_lvl = 'color-red-dark'; //roja
										}
									
									/***************************************************************/
									}elseif($row_data['PuntoMedAceptable_'.$i]<$row_data['PuntoMedCondenatorio_'.$i]){
										//alerta amarilla
										if(isset($row_data['Analisis_Medida_'.$i])&&$row_data['Analisis_Medida_'.$i]!=''&&$row_data['Analisis_Medida_'.$i]<$row_data['PuntoMedAlerta_'.$i]&&$row_data['Analisis_Medida_'.$i]>=$row_data['PuntoMedAceptable_'.$i]){
											//variables alerta amarilla
											$alert_lvl = 'color-green-dark'; //amarilla
										}
										//alerta naranja
										if(isset($row_data['Analisis_Medida_'.$i])&&$row_data['Analisis_Medida_'.$i]!=''&&$row_data['Analisis_Medida_'.$i]<$row_data['PuntoMedCondenatorio_'.$i]&&$row_data['Analisis_Medida_'.$i]>=$row_data['PuntoMedAlerta_'.$i]){
											//variables alerta naranja
											$alert_lvl = 'color-yellow'; //naranja
										}
										//alerta roja
										if(isset($row_data['Analisis_Medida_'.$i])&&$row_data['Analisis_Medida_'.$i]!=''&&$row_data['Analisis_Medida_'.$i]>=$row_data['PuntoMedCondenatorio_'.$i]){
											//variables alerta roja
											$alert_lvl = 'color-red-dark'; //roja
										}
										
									}							
								
									/*******************************/
									echo '<tr>';
										echo '<td>'.$row_data['PuntoNombre_'.$i].'</td>';
										echo '<td><span class="'.$alert_lvl.'">'.Cantidades_decimales_justos($row_data['Analisis_Medida_'.$i]).' '.$uniMed.'</span></td>';
										echo '<td><span class="color-green-dark">'.Cantidades_decimales_justos($row_data['PuntoMedAceptable_'.$i]).' '.$uniMed.'</span></td>';
										echo '<td><span class="color-yellow">'.Cantidades_decimales_justos($row_data['PuntoMedAlerta_'.$i]).' '.$uniMed.'</span></td>';
										echo '<td><span class="color-red-dark">'.Cantidades_decimales_justos($row_data['PuntoMedCondenatorio_'.$i]).' '.$uniMed.'</span></td>';
									echo '</tr>';
									break;
								//Producto
								case 2:
									echo '<tr>';
										echo '<td width="200">Producto Utilizado</td>';
										echo '<td colspan="4">'.$Producto.'</td>';
									echo '</tr>';
									break;
								//Dispersancia
								case 3:
									echo '<tr>';
										echo '<td width="200">Dispersancia</td>';
										echo '<td colspan="4">'.$Dispersancia.'</td>';
									echo '</tr>';
									break;
								//Flashpoint
								case 4:
									echo '<tr>';
										echo '<td width="200">Flashpoint</td>';
										echo '<td colspan="4">'.$Flashpoint.'</td>';
									echo '</tr>';
									break;
							}
						}
					}
					echo '</tbody>';
					echo '</table>';	
						
				} 	
			} ?>	
			


			
			
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Diagnostico:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Analisis_obs_Diagnostico'];?></p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Recomendaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Analisis_obs_Accion'];?></p>
		</div>
	</div>
	


	
      
</section>


<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
