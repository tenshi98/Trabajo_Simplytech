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
// Se traen todos los datos de mi usuario
$query = "SELECT 
telemetria_listado.Identificador,
telemetria_listado.Nombre,
telemetria_listado.IP_Client,
telemetria_listado.Sim_Num_Tel,
telemetria_listado.Sim_Num_Serie,
telemetria_listado.Sim_modelo,
telemetria_listado.Sim_marca,
telemetria_listado.Sim_Compania,
telemetria_listado.IdentificadorEmpresa,
telemetria_listado.TiempoFueraLinea,
telemetria_listado.TiempoDetencion,
telemetria_listado.Capacidad,
telemetria_listado.Marca, 
telemetria_listado.Modelo, 
telemetria_listado.Patente, 
telemetria_listado.Num_serie, 
telemetria_listado.AnoFab, 
telemetria_listado.CapacidadPersonas,
telemetria_listado.CapacidadKilos, 
telemetria_listado.MCubicos,
telemetria_listado.NErroresGeocercaMax,
telemetria_listado.idUsoGeocerca,
opc2.Nombre AS Geo,
opc3.Nombre AS Sensores,
opc4.Nombre AS Contratos,
opc5.Nombre AS Predio,
opc6.Nombre AS Geocerca,
telemetria_listado.cantSensores,
telemetria_listado.Direccion_img,
core_sistemas.Nombre AS sistema,
telemetria_listado.id_Geo,
telemetria_listado.id_Sensores,
telemetria_listado_dispositivos.Nombre AS Dispositivo,

telemetria_listado.Hor_idActivo_dia1, 
telemetria_listado.Hor_idActivo_dia2, 
telemetria_listado.Hor_idActivo_dia3, 
telemetria_listado.Hor_idActivo_dia4, 
telemetria_listado.Hor_idActivo_dia5, 
telemetria_listado.Hor_idActivo_dia6, 
telemetria_listado.Hor_idActivo_dia7,
telemetria_listado.Hor_Inicio_dia1, 
telemetria_listado.Hor_Inicio_dia2, 
telemetria_listado.Hor_Inicio_dia3, 
telemetria_listado.Hor_Inicio_dia4, 
telemetria_listado.Hor_Inicio_dia5, 
telemetria_listado.Hor_Inicio_dia6, 
telemetria_listado.Hor_Inicio_dia7,
telemetria_listado.Hor_Termino_dia1, 
telemetria_listado.Hor_Termino_dia2, 
telemetria_listado.Hor_Termino_dia3, 
telemetria_listado.Hor_Termino_dia4, 
telemetria_listado.Hor_Termino_dia5, 
telemetria_listado.Hor_Termino_dia6, 
telemetria_listado.Hor_Termino_dia7,

telemetria_listado.Jornada_inicio,
telemetria_listado.Jornada_termino,
telemetria_listado.Colacion_inicio,
telemetria_listado.Colacion_termino,
telemetria_listado.Microparada,

core_estados.Nombre AS Estado,
telemetria_listado_shield.Nombre AS Shield,
telemetria_listado_alarma_general.Nombre AS AlarmaGeneral,
telemetria_listado.LimiteVelocidad,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
telemetria_listado.Direccion,
telemetria_zonas.Nombre AS ZonaSinGPS, 
vehiculos_zonas.Nombre AS ZonaConGPS, 
telemetria_listado.idUsoContrato,
vehiculos_tipo.Nombre AS TipoVehiculo,
core_telemetria_tabs.Nombre AS Tab,
opc7.Nombre AS Backup,
telemetria_listado.NregBackup,
opc8.Nombre AS Generador,

telemetria_listado.CrossCrane_tiempo_revision AS TiempoRevision,
grupo_1.Nombre AS Grupo_amperaje,
grupo_2.Nombre AS Grupo_elevacion,
grupo_3.Nombre AS Grupo_giro,
grupo_4.Nombre AS Grupo_carro, 
grupo_5.Nombre AS Grupo_voltaje,
grupo_6.Nombre AS Grupo_motor_subida,
grupo_7.Nombre AS Grupo_motor_bajada

FROM `telemetria_listado`
LEFT JOIN `core_sistemas`                        ON core_sistemas.idSistema                            = telemetria_listado.idSistema
LEFT JOIN `core_sistemas_opciones`        opc2   ON opc2.idOpciones                                    = telemetria_listado.id_Geo
LEFT JOIN `core_sistemas_opciones`        opc3   ON opc3.idOpciones                                    = telemetria_listado.id_Sensores
LEFT JOIN `core_sistemas_opciones`        opc4   ON opc4.idOpciones                                    = telemetria_listado.idUsoContrato
LEFT JOIN `core_sistemas_opciones`        opc5   ON opc5.idOpciones                                    = telemetria_listado.idUsoPredio
LEFT JOIN `core_sistemas_opciones`        opc6   ON opc6.idOpciones                                    = telemetria_listado.idUsoGeocerca
LEFT JOIN `telemetria_listado_dispositivos`      ON telemetria_listado_dispositivos.idDispositivo      = telemetria_listado.idDispositivo
LEFT JOIN `core_estados`                         ON core_estados.idEstado                              = telemetria_listado.idEstado
LEFT JOIN `telemetria_listado_shield`            ON telemetria_listado_shield.idShield                 = telemetria_listado.idShield
LEFT JOIN `telemetria_listado_alarma_general`    ON telemetria_listado_alarma_general.idAlarmaGeneral  = telemetria_listado.idAlarmaGeneral
LEFT JOIN `core_ubicacion_ciudad`                ON core_ubicacion_ciudad.idCiudad                     = telemetria_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`               ON core_ubicacion_comunas.idComuna                    = telemetria_listado.idComuna
LEFT JOIN `telemetria_zonas`                     ON telemetria_zonas.idZona                            = telemetria_listado.idZona
LEFT JOIN `vehiculos_zonas`                      ON vehiculos_zonas.idZona                             = telemetria_listado.idZona
LEFT JOIN `vehiculos_tipo`                       ON vehiculos_tipo.idTipo                              = telemetria_listado.idTipo
LEFT JOIN `core_telemetria_tabs`                 ON core_telemetria_tabs.idTab                         = telemetria_listado.idTab
LEFT JOIN `core_sistemas_opciones`        opc7   ON opc7.idOpciones                                    = telemetria_listado.idBackup
LEFT JOIN `core_sistemas_opciones`        opc8   ON opc8.idOpciones                                    = telemetria_listado.idGenerador
LEFT JOIN `telemetria_listado_grupos`  grupo_1   ON grupo_1.idGrupo                                    = telemetria_listado.CrossCrane_grupo_amperaje
LEFT JOIN `telemetria_listado_grupos`  grupo_2   ON grupo_2.idGrupo                                    = telemetria_listado.CrossCrane_grupo_elevacion
LEFT JOIN `telemetria_listado_grupos`  grupo_3   ON grupo_3.idGrupo                                    = telemetria_listado.CrossCrane_grupo_giro
LEFT JOIN `telemetria_listado_grupos`  grupo_4   ON grupo_4.idGrupo                                    = telemetria_listado.CrossCrane_grupo_carro
LEFT JOIN `telemetria_listado_grupos`  grupo_5   ON grupo_5.idGrupo                                    = telemetria_listado.CrossCrane_grupo_voltaje
LEFT JOIN `telemetria_listado_grupos`  grupo_6   ON grupo_6.idGrupo                                    = telemetria_listado.CrossCrane_grupo_motor_subida
LEFT JOIN `telemetria_listado_grupos`  grupo_7   ON grupo_7.idGrupo                                    = telemetria_listado.CrossCrane_grupo_motor_bajada

WHERE idTelemetria = ".$X_Puntero;
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
$rowdata = mysqli_fetch_assoc ($resultado);


/********************************************/
$arrContratos = array();
$arrContratos = db_select_array (false, 'Codigo, F_Inicio, F_Termino', 'telemetria_listado_contratos', '', 'idTelemetria ='.$X_Puntero, 'idContrato DESC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrContratos');
											
$arrOpciones = array();
$arrOpciones = db_select_array (false, 'idOpciones,Nombre', 'core_sistemas_opciones', '', '', 'idOpciones ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrOpciones');
											
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"]), 'arrUnimed');


/********************************************/
//recorro
$arrEXOpciones = array();
$arrFinalUnimed = array();

foreach ($arrOpciones as $sen) { $arrEXOpciones[$sen['idOpciones']] = $sen['Nombre']; }
foreach ($arrUnimed as $sen) { $arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre']; }

$arrEXOpciones[0]  = 'No Asignado';
$arrFinalUnimed[0] = 'No Asignado';


?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos del Equipo</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab"><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				
				<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
				<li class=""><a href="#mediciones" data-toggle="tab"><i class="fa fa-wifi" aria-hidden="true"></i> Ultimas Mediciones</a></li>
				<?php } ?>
				
				<?php if(isset($rowdata['idTrabajador'])&&$rowdata['idTrabajador']!=0){ ?>
				<li class=""><a href="#trabajador" data-toggle="tab"><i class="fa fa-user-o" aria-hidden="true"></i> Datos del Trabajador</a></li>
				<?php } ?>
				
				<?php if(isset($rowdata['idBodega'])&&$rowdata['idBodega']!=0){ ?>
				<li class=""><a href="#bodega" data-toggle="tab"><i class="fa fa-cubes" aria-hidden="true"></i> Stock Bodega</a></li>
				<?php } ?>
				
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="#alertas" data-toggle="tab"><i class="fa fa-bullhorn"  aria-hidden="true"></i> Alertas</a></li>
						<li class=""><a href="#flinea" data-toggle="tab"><i class="fa fa-power-off" aria-hidden="true"></i> Fuera de Linea</a></li>
						
						<li class=""><a href="#carga" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i> Cargas</a></li>
						<li class=""><a href="#mantencion" data-toggle="tab"><i class="fa fa-wrench" aria-hidden="true"></i> Mantenciones</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/maquina.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Equipo</h2>
						<p class="text-muted">
							<?php if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){ ?>                              <strong>Nombre Equipo: </strong><?php echo $rowdata['Nombre']; ?><br/><?php } ?>
							<?php if(isset($rowdata['IdentificadorEmpresa'])&&$rowdata['IdentificadorEmpresa']!=''){ ?>  <strong>Identificador Empresa : </strong><?php echo $rowdata['IdentificadorEmpresa']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Num_Tel'])&&$rowdata['Sim_Num_Tel']!=''){ ?>                    <strong>SIM - Numero Telefonico : </strong><?php echo $rowdata['Sim_Num_Tel']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Num_Serie'])&&$rowdata['Sim_Num_Serie']!=''){ ?>                <strong>SIM - Numero Serie : </strong><?php echo $rowdata['Sim_Num_Serie']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Compania'])&&$rowdata['Sim_Compania']!=''){ ?>                  <strong>SIM - Compañia : </strong><?php echo $rowdata['Sim_Compania']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_marca'])&&$rowdata['Sim_marca']!=''){ ?>                        <strong>BAM - Marca : </strong><?php echo $rowdata['Sim_marca']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_modelo'])&&$rowdata['Sim_modelo']!=''){ ?>                      <strong>BAM - Modelo : </strong><?php echo $rowdata['Sim_modelo']; ?><br/><?php } ?>
							<?php if(isset($rowdata['IP_Client'])&&$rowdata['IP_Client']!=''){ ?>                        <strong>IP Cliente : </strong><?php echo $rowdata['IP_Client']; ?><br/><?php } ?>
							<?php if(isset($rowdata['idTelemetria'])&&$rowdata['idTelemetria']!=''){ ?>                  <strong>ID Equipo : </strong><?php echo $rowdata['idTelemetria']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Estado'])&&$rowdata['Estado']!=''){ ?>                              <strong>Estado : </strong><?php echo $rowdata['Estado']; ?><br/><?php } ?>
							
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Configuracion</h2>
						<p class="text-muted">
							<strong class="color-red-dark">Basicos</strong><br/>
							<strong>Identificador : </strong><?php echo $rowdata['Identificador']; ?><br/>
							<?php if(isset($rowdata['Dispositivo'])&&$rowdata['Dispositivo']!=''){ ?>            <strong>Hardware : </strong><?php echo $rowdata['Dispositivo']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Shield'])&&$rowdata['Shield']!=''){ ?>                      <strong>Shield : </strong><?php echo $rowdata['Shield']; ?><br/><?php } ?>
							<?php if(isset($rowdata['TiempoFueraLinea'])&&$rowdata['TiempoFueraLinea']!=''){ ?>  <strong>Tiempo Fuera Linea Maximo : </strong><?php echo $rowdata['TiempoFueraLinea']; ?> Horas<br/><?php } ?>
							<?php if(isset($rowdata['Tab'])&&$rowdata['Tab']!=''){ ?>                            <strong>Tab: </strong><?php echo $rowdata['Tab']; ?><br/><?php } ?>
							
							<br/>
							<strong class="color-red-dark">Funciones</strong><br/>
							<?php if(isset($rowdata['Geo'])&&$rowdata['Geo']!=''){ ?>                     <strong>Geolocalizacion : </strong><?php echo $rowdata['Geo']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sensores'])&&$rowdata['Sensores']!=''){ ?>           <strong>Sensores : </strong><?php echo $rowdata['Sensores'].' ';if($rowdata['id_Sensores']==1){echo '('.$rowdata['cantSensores'].' Sensores)';} ?><br/><?php } ?>
							<?php if(isset($rowdata['Predio'])&&$rowdata['Predio']!=''){ ?>               <strong>Utilizacion de Predios : </strong><?php echo $rowdata['Predio'];?><br/><?php } ?>
							<?php if(isset($rowdata['Geocerca'])&&$rowdata['Geocerca']!=''){ ?>           <strong>Utilizacion de Geocercas : </strong><?php echo $rowdata['Geocerca'].' ';if($rowdata['idUsoGeocerca']==1){echo '('.$rowdata['NErroresGeocercaMax'].' Errores Maximo)';} ?><br/><?php } ?>
							<?php if(isset($rowdata['Backup'])&&$rowdata['Backup']!=''){ ?>               <strong>Utilizacion de Backup : </strong><?php echo $rowdata['Backup'].' ';if(isset($rowdata['NregBackup'])&&$rowdata['NregBackup']!=''){echo '('.$rowdata['NregBackup'].' Registros)';} ?><br/><?php } ?>
							<?php if(isset($rowdata['Generador'])&&$rowdata['Generador']!=''){ ?>         <strong>Generador Electrico : </strong><?php echo $rowdata['Generador']; ?><br/><?php } ?>
							<?php if(isset($rowdata['AlarmaGeneral'])&&$rowdata['AlarmaGeneral']!=''){ ?> <strong>Alarma General : </strong><?php echo $rowdata['AlarmaGeneral']; ?><br/><?php } ?>
							
							
							<br/>
							<strong class="color-red-dark">Otros Datos</strong><br/>
							<?php if(isset($rowdata['Capacidad'])&&$rowdata['Capacidad']!=0){ ?>                   <strong>Capacidad Nebulizador: </strong><?php echo Cantidades_decimales_justos($rowdata['Capacidad']); ?><br/><?php } ?>
							<?php if(isset($rowdata['TiempoRevision'])&&$rowdata['TiempoRevision']!=0){ ?>         <strong>Hora Revision: </strong><?php echo $rowdata['TiempoRevision']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_amperaje'])&&$rowdata['Grupo_amperaje']!=0){ ?>         <strong>Gruas - Grupo Alimentacion: </strong><?php echo $rowdata['Grupo_amperaje']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_elevacion'])&&$rowdata['Grupo_elevacion']!=0){ ?>       <strong>Gruas - Grupo Elevacion: </strong><?php echo $rowdata['Grupo_elevacion']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_giro'])&&$rowdata['Grupo_giro']!=0){ ?>                 <strong>Gruas - Grupo Giro: </strong><?php echo $rowdata['Grupo_giro']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_carro'])&&$rowdata['Grupo_carro']!=0){ ?>               <strong>Gruas - Grupo Carro: </strong><?php echo $rowdata['Grupo_carro']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_voltaje'])&&$rowdata['Grupo_voltaje']!=0){ ?>           <strong>Gruas - Grupo Voltaje: </strong><?php echo $rowdata['Grupo_voltaje']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_motor_subida'])&&$rowdata['Grupo_motor_subida']!=0){ ?> <strong>Ascensores - Grupo Amperaje Motor Subida: </strong><?php echo $rowdata['Grupo_motor_subida']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Grupo_motor_bajada'])&&$rowdata['Grupo_motor_bajada']!=0){ ?> <strong>Ascensores - Grupo Amperaje Motor Bajada: </strong><?php echo $rowdata['Grupo_motor_bajada']; ?><br/><?php } ?>
							
							
							<?php if($rowdata['id_Geo']==2){ ?>
								<br/>
								<strong class="color-red-dark">Ubicacion</strong><br/>
								<strong>Zona de Trabajo : </strong><?php echo $rowdata['ZonaSinGPS']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['Comuna'].', '.$rowdata['Ciudad']; ?><br/>
							<?php } ?>
							
							<?php if(isset($rowdata['Contratos'])&&$rowdata['Contratos']!=''){ ?>         
								<br/>
								<strong class="color-red-dark">Contratos</strong><br/>
								<strong>Utilizacion de Contratos : </strong><?php echo $rowdata['Contratos']; ?><br/>
								<?php if($arrContratos){ ?>
									<table id="items" style="margin-bottom: 20px;">
										<tbody>
											<?php foreach ($arrContratos as $carga) { ?>
												<tr class="item-row">
													<td><?php echo $carga['Codigo']; ?></td>		
													<td><?php echo fecha_estandar($carga['F_Inicio']); ?></td>	
													<td><?php echo fecha_estandar($carga['F_Termino']); ?></td>						
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							<?php } ?>
							
						</p>
						
						<?php if($rowdata['id_Geo']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos GPS</h2>
							<p class="text-muted">
								<strong class="color-red-dark">Basicos</strong><br/>
								<strong>Tipo de Vehiculo : </strong><?php echo $rowdata['TipoVehiculo']; ?><br/>
								<strong>Marca : </strong><?php echo $rowdata['Marca']; ?><br/>
								<strong>Modelo : </strong><?php echo $rowdata['Modelo']; ?><br/>
								<strong>Patente : </strong><?php echo $rowdata['Patente']; ?><br/>
								<strong>Numero de serie : </strong><?php echo $rowdata['Num_serie']; ?><br/>
								<strong>Año de Fabricacion : </strong><?php echo $rowdata['AnoFab']; ?><br/>
							
								<br/>
								<strong class="color-red-dark">Caracteristicos</strong><br/>
								<strong>Zona de Trabajo : </strong><?php echo $rowdata['ZonaConGPS']; ?><br/>
								<strong>Capacidad Pasajeros : </strong><?php echo $rowdata['CapacidadPersonas']; ?><br/>
								<strong>Capacidad (Kilos) : </strong><?php echo Cantidades_decimales_justos($rowdata['CapacidadKilos']); ?><br/>
								<strong>Metros Cubicos (M3) : </strong><?php echo Cantidades_decimales_justos($rowdata['MCubicos']); ?><br/>
							
								<br/>
								<strong class="color-red-dark">Datos Movilizacion</strong><br/>
								<strong>Limite Velocidad : </strong><?php echo Cantidades_decimales_justos($rowdata['LimiteVelocidad']).' KM/h'; ?><br/>
								<strong>Tiempo Maximo Detencion : </strong><?php echo $rowdata['TiempoDetencion']; ?> Horas<br/>
							</p>
								
						<?php } ?>
							
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Horario Notificaciones</h2>
						<p class="text-muted">
							<?php for ($i = 1; $i <= 7; $i++) { ?>
								<strong><?php echo numero_nombreDia($i); ?> : </strong><?php echo $arrEXOpciones[$rowdata['Hor_idActivo_dia'.$i]].' / '.$rowdata['Hor_Inicio_dia'.$i].' - '.$rowdata['Hor_Termino_dia'.$i]; ?><br/>
							<?php } ?>
						</p>	
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Jornada Laboral</h2>
						<p class="text-muted">
							<strong>Jornada : </strong><?php echo 'De '.$rowdata['Jornada_inicio'].' a '.$rowdata['Jornada_termino']; ?><br/>
							<strong>Colacion : </strong><?php echo 'De '.$rowdata['Colacion_inicio'].' a '.$rowdata['Colacion_termino']; ?><br/>
							<strong>Tiempo Microparadas : </strong><?php echo $rowdata['Microparada'].' hrs'; ?><br/>
						</p>
						
						
					</div>	
					<div class="clearfix"></div>
					
					
				</div>
			</div>
			
			
			<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
				<div class="tab-pane fade" id="mediciones">
					<div class="wmd-panel">
						<?php
						
						//numero sensores equipo
						$N_Maximo_Sensores = 72;
						$subquery = '';
						for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
							$subquery .= ',SensoresNombre_'.$i;
							$subquery .= ',SensoresTipo_'.$i;
							$subquery .= ',SensoresMedMin_'.$i;
							$subquery .= ',SensoresMedMax_'.$i;
							$subquery .= ',SensoresMedErrores_'.$i;
							$subquery .= ',SensoresErrorActual_'.$i;
							$subquery .= ',SensoresGrupo_'.$i;
							$subquery .= ',SensoresUniMed_'.$i;
							$subquery .= ',SensoresMedActual_'.$i;
							$subquery .= ',SensoresActivo_'.$i;
						}
						// tomo los datos del usuario
						$query = "SELECT Nombre,id_Geo, id_Sensores,cantSensores,LastUpdateFecha,LastUpdateHora,
						GeoVelocidad
						".$subquery."

						FROM `telemetria_listado`
						WHERE idTelemetria = ".$X_Puntero;
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
						$rowMed = mysqli_fetch_assoc ($resultado);


						//Se traen todos los tipos de sensores existentes
						$arrSensores = array();
						$query = "SELECT idSensores,Nombre
						FROM `telemetria_listado_sensores`
						ORDER BY idSensores ASC";
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
						array_push( $arrSensores,$row );
						}
						
						//Se traen todos los grupos
						$arrGrupos = array();
						$query = "SELECT idGrupo,Nombre
						FROM `telemetria_listado_grupos`
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
						array_push( $arrGrupos,$row );
						}
						
						
						?>
						
						<div class="table-responsive">    
							
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<?php if(isset($rowMed['id_Geo'])&&$rowMed['id_Geo']!=''&&$rowMed['id_Geo']==1){ ?>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_flota_view_equipo_mediciones.php?view='.$X_Puntero.'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ultima Ubicacion</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_1.php?view='.$X_Puntero; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_velocidad.php?view='.$X_Puntero; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Velocidades</a>
								<?php }elseif(isset($rowMed['id_Geo'])&&$rowMed['id_Geo']!=''&&$rowMed['id_Geo']==2){ ?>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_sensores_view_equipo_mediciones.php?view='.$X_Puntero.'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ultima Ubicacion</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_2.php?view='.$X_Puntero; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
								<?php } ?>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
							
							<?php if(isset($rowdata['LimiteVelocidad'])&&$rowdata['LimiteVelocidad']!=0){ ?>
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>Parametro</th>
											<th>Fecha/hora</th>
											<th>Medicion Actual</th>
											<th>Maximo Medicion</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<tr class="odd <?php if($rowMed['GeoVelocidad'] > $rowdata['LimiteVelocidad']){echo 'danger';}?>">		
											<td>Velocidad</td>	
											<td><?php echo fecha_estandar($rowMed['LastUpdateFecha']).' - '.$rowMed['LastUpdateHora'].' hrs'; ?></td>
											<td><?php echo Cantidades($rowMed['GeoVelocidad'], 0).' KM/h'; ?></td>		
											<td><?php echo Cantidades($rowdata['LimiteVelocidad'], 0).' KM/h'; ?></td>
										</tr>
														   
									</tbody>
								</table>
							<?php } ?>
							
						
								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
									<thead>
										<tr role="row">
											<th>#</th>
											<th>Nombre</th>
											<th>Tipo Sensor</th>
											<th>Grupo</th>
											<th>Fecha/hora</th>
											<th>Medicion Actual</th>
											<th>Minimo Medicion</th>
											<th>Maximo Medicion</th>
											<th>Maximo Errores</th>
											<th>Errores Actuales</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
											//solo sensores activos
											if(isset($rowMed['SensoresActivo_'.$i])&&$rowMed['SensoresActivo_'.$i]==1){
												$unimed = ' '.$arrFinalUnimed[$rowMed['SensoresUniMed_'.$i]];
												$s_alert = '';
												//se verifica que la medicion minima y maxima sean distintas de 0
												if($rowMed['SensoresMedMin_'.$i]!=0&&$rowMed['SensoresMedMax_'.$i]!=0){
													if($rowMed['SensoresMedActual_'.$i] < $rowMed['SensoresMedMin_'.$i] OR $rowMed['SensoresMedActual_'.$i]>$rowMed['SensoresMedMax_'.$i]){
														$s_alert = 'danger';
													}
												}
												?>
												<tr class="odd <?php echo $s_alert; ?>">		
													<td><?php echo 's'.$i ?></td>
													<td><?php echo $rowMed['SensoresNombre_'.$i]; ?></td>	
													<td>
														<?php 
														foreach ($arrSensores as $sen) { 
															if($rowMed['SensoresTipo_'.$i]==$sen['idSensores']){
																echo $sen['Nombre'];
															}
														}
														?>
													</td>
													<td>
														<?php 
														foreach ($arrGrupos as $sen) { 
															if($rowMed['SensoresGrupo_'.$i]==$sen['idGrupo']){
																echo $sen['Nombre'];
															}
														}
														?>
													</td>
													<td><?php echo fecha_estandar($rowMed['LastUpdateFecha']).' - '.$rowMed['LastUpdateHora'].' hrs'; ?></td>
													<td><?php 
													if(isset($rowMed['SensoresMedActual_'.$i])&&$rowMed['SensoresMedActual_'.$i]<99900){
														echo Cantidades_decimales_justos($rowMed['SensoresMedActual_'.$i]).$unimed;
													}else{
														echo 'Sin Datos';
													} ?>
													</td>
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMin_'.$i]).$unimed;?></td>		
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMax_'.$i]).$unimed; ?></td>
													<td><?php echo $rowMed['SensoresMedErrores_'.$i]; ?></td>
													<td><?php echo $rowMed['SensoresErrorActual_'.$i]; ?></td>
												</tr>
											<?php } ?> 
										<?php } ?>                    
									</tbody>
								</table>
						
							
							
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php if(isset($rowdata['idTrabajador'])&&$rowdata['idTrabajador']!=0){ ?>
				<div class="tab-pane fade" id="trabajador">
					<div class="wmd-panel">
						<?php 
						// Se traen todos los datos del trabajador
						$query = "SELECT 
						trabajadores_listado.Nombre,
						trabajadores_listado.ApellidoPat,
						trabajadores_listado.ApellidoMat, 
						trabajadores_listado.Cargo, 
						trabajadores_listado.Fono, 
						trabajadores_listado.Rut,
						trabajadores_listado.Observaciones,
						trabajadores_listado_tipos.Nombre AS TipoTrabajador,
						core_sistemas.Nombre AS Sistema,
						core_ubicacion_ciudad.Nombre AS nombre_region,
						core_ubicacion_comunas.Nombre AS nombre_comuna,
						trabajadores_listado.Direccion,
						trabajadores_listado.F_Inicio_Contrato,
						trabajadores_listado.F_Termino_Contrato,
						sistema_afp.Nombre AS nombre_afp,
						sistema_salud.Nombre AS nombre_salud

						FROM `trabajadores_listado`
						LEFT JOIN `trabajadores_listado_tipos`  ON trabajadores_listado_tipos.idTipo   = trabajadores_listado.idTipo
						LEFT JOIN `core_sistemas`               ON core_sistemas.idSistema             = trabajadores_listado.idSistema
						LEFT JOIN `core_ubicacion_ciudad`       ON core_ubicacion_ciudad.idCiudad      = trabajadores_listado.idCiudad
						LEFT JOIN `core_ubicacion_comunas`      ON core_ubicacion_comunas.idComuna     = trabajadores_listado.idComuna
						LEFT JOIN `sistema_afp`                 ON sistema_afp.idAFP                   = trabajadores_listado.idAFP
						LEFT JOIN `sistema_salud`               ON sistema_salud.idSalud               = trabajadores_listado.idSalud

						WHERE trabajadores_listado.idTrabajador = {$rowdata['idTrabajador']}";
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
						$rowTrabajador = mysqli_fetch_assoc ($resultado);
						?>
						
						<div class="col-sm-4">
							<?php if ($rowdata['Direccion_img']=='') { ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE_REPO ?>/Legacy/gestion_modular/img/maquina.jpg">
							<?php }else{  ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
							<?php }?>
						</div>
						<div class="col-sm-8">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
							<p class="text-muted">
								<strong>Nombre : </strong><?php echo $rowTrabajador['Nombre'].' '.$rowTrabajador['ApellidoPat'].' '.$rowTrabajador['ApellidoMat']; ?><br/>
								<strong>Fono : </strong><?php echo $rowTrabajador['Fono']; ?><br/>
								<strong>Rut : </strong><?php echo $rowTrabajador['Rut']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowTrabajador['Direccion'].', '.$rowTrabajador['nombre_comuna'].', '.$rowTrabajador['nombre_region']; ?><br/>
								<strong>Observaciones : </strong><?php echo $rowTrabajador['Observaciones']; ?>
							</p>
											
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Laborales</h2>
							<p class="text-muted">
								<strong>Tipo Trabajador : </strong><?php echo $rowTrabajador['TipoTrabajador']; ?><br/>
								<strong>Cargo : </strong><?php echo $rowTrabajador['Cargo']; ?><br/>
								<strong>Sistema : </strong><?php echo $rowTrabajador['Sistema']; ?><br/>
								<strong>AFP : </strong><?php echo $rowTrabajador['nombre_afp']; ?><br/>
								<strong>Salud : </strong><?php echo $rowTrabajador['nombre_salud']; ?><br/>
								<strong>Fecha de Inicio Contrato : </strong><?php if(isset($rowTrabajador['F_Inicio_Contrato'])&&$rowTrabajador['F_Inicio_Contrato']!='0000-00-00'){echo Fecha_estandar($rowTrabajador['F_Inicio_Contrato']);}else{echo 'Sin fecha de inicio';} ?><br/>
								<strong>Fecha de Termino Contrato : </strong><?php if(isset($rowTrabajador['F_Termino_Contrato'])&&$rowTrabajador['F_Termino_Contrato']!='0000-00-00'){echo Fecha_estandar($rowTrabajador['F_Termino_Contrato']);}else{echo 'Sin fecha de termino';} ?>
							</p>
						</div>	
						<div class="clearfix"></div>
					</div>
				</div>
			<?php } ?>
			
			
			<?php if(isset($rowdata['idBodega'])&&$rowdata['idBodega']!=0){ ?>
				<div class="tab-pane fade" id="bodega">
					<div class="wmd-panel">
						<?php 
						//se consulta
						$arrProductos = array();
						$query = "SELECT
						productos_listado.StockLimite,
						productos_listado.Nombre AS NombreProd,
						core_tipo_producto.Nombre AS tipo_producto,
						sistema_productos_uml.Nombre AS UnidadMedida,
						SUM(bodegas_productos_facturacion_existencias.Cantidad_ing) AS stock_entrada,
						SUM(bodegas_productos_facturacion_existencias.Cantidad_eg) AS stock_salida,
						bodegas_productos_listado.Nombre AS NombreBodega

						FROM `bodegas_productos_facturacion_existencias`
						LEFT JOIN `productos_listado`           ON productos_listado.idProducto         = bodegas_productos_facturacion_existencias.idProducto
						LEFT JOIN `sistema_productos_uml`       ON sistema_productos_uml.idUml          = productos_listado.idUml
						LEFT JOIN `bodegas_productos_listado`   ON bodegas_productos_listado.idBodega   = bodegas_productos_facturacion_existencias.idBodega
						LEFT JOIN `core_tipo_producto`          ON core_tipo_producto.idTipoProducto    = productos_listado.idTipoProducto
						WHERE bodegas_productos_facturacion_existencias.idBodega={$rowdata['idBodega']}
						GROUP BY bodegas_productos_facturacion_existencias.idProducto
						ORDER BY core_tipo_producto.Nombre ASC, productos_listado.Nombre ASC";
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
						array_push( $arrProductos,$row );
						}
						?>
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Tipo</th>
										<th>Nombre</th>
										<th>Stock Min</th>
										<th>Stock Actual</th>
									</tr>
								</thead>
											  
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrProductos as $productos) {
									$stock_actual = $productos['stock_entrada'] - $productos['stock_salida'];
									if ($stock_actual!=0&&$productos['NombreProd']!=''){ ?>
									<tr class="odd <?php if ($productos['StockLimite']>$stock_actual){echo 'danger';} ?>">
										<td><?php echo $productos['tipo_producto']; ?></td>
										<td><?php echo $productos['NombreProd']; ?></td>
										<td><?php echo Cantidades_decimales_justos($productos['StockLimite']); ?> <?php echo $productos['UnidadMedida'];?></td>
										<td><?php echo Cantidades_decimales_justos($stock_actual) ?> <?php echo $productos['UnidadMedida'];?></td>
									</tr>
								<?php } } ?>                     
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>
			

			<div class="tab-pane fade" id="alertas">
					<div class="wmd-panel">
						<?php
						// Se trae un listado con todas las alertas
						$arrAlertas = array();
						$query = "SELECT  
						telemetria_listado_errores.idErrores, 
						telemetria_listado_errores.Descripcion, 
						telemetria_listado_errores.Fecha,  
						telemetria_listado_errores.Hora,  
						telemetria_listado_errores.Valor, 
						telemetria_listado_errores.Valor_min, 
						telemetria_listado_errores.Valor_max,
						telemetria_listado_errores.Sensor,
						SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
						SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
						SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
						SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
						SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
						SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
						SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
						SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
						SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
						SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50
						
						FROM `telemetria_listado_errores`
						LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_errores.idTelemetria
						WHERE telemetria_listado_errores.idTelemetria = ".$X_Puntero."
						AND telemetria_listado_errores.idTipo!='999'
						AND telemetria_listado_errores.Valor<'99900'
						ORDER BY telemetria_listado_errores.idErrores DESC
						LIMIT 20";
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
						array_push( $arrAlertas,$row );
						}
						
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'.php?idTelemetria='.$X_Puntero.'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
							
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Descripcion</th>
										<th>Fecha</th>
										<th>Hora</th>
										<th>Valor</th>
										<th>Min</th>
										<th>Max</th>
										<?php if($rowdata['id_Geo']==1){ ?>
											<th>Ubicacion</th> 
										<?php } ?> 
									</tr>
								</thead>
								
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrAlertas as $error) { 
										//Guardo la unidad de medida
										$unimed = ' '.$arrFinalUnimed[$error['SensoresUniMed_'.$error['Sensor']]]; ?>
										<tr>
											<td><?php echo $error['Descripcion']; ?></td>
											<td><?php echo fecha_estandar($error['Fecha']); ?></td>
											<td><?php echo $error['Hora']; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor']).$unimed; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor_min']).$unimed; ?></td>
											<td><?php echo Cantidades_decimales_justos($error['Valor_max']).$unimed; ?></td>
											<?php if($rowdata['id_Geo']==1){ ?>
												<td>
													<div class="btn-group" style="width: 35px;" >
														<a href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'_view.php?view='.$error['idErrores'].'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
													</div>
												</td>
											<?php } ?> 		
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="flinea">
					<div class="wmd-panel">
						<?php
						// Se trae un listado con todas las fuera de linea
						$arrFlinea = array();
						$query = "SELECT  idFueraLinea, Fecha_inicio, Hora_inicio, Fecha_termino, Hora_termino, Tiempo

						FROM `telemetria_listado_error_fuera_linea`
						WHERE idTelemetria = ".$X_Puntero."
						ORDER BY idFueraLinea DESC
						LIMIT 20";
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
						array_push( $arrFlinea,$row );
						}
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'.php?idTelemetria='.$X_Puntero.'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
								<div style="padding-bottom:10px;padding-top:10px;"></div>
							</div>
							
							
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Fecha Inicio</th>
										<th>Hora Inicio</th>
										<th>Fecha Termino</th>
										<th>Hora Termino</th>
										<th>Tiempo</th>
										<?php if($rowdata['id_Geo']==1){ ?>
											<th>Ubicacion</th> 
										<?php } ?> 
									</tr>
								</thead>
								
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrFlinea as $error) {  ?>
										<tr>
											<td><?php echo fecha_estandar($error['Fecha_inicio']); ?></td>
											<td><?php echo $error['Hora_inicio'].' hrs'; ?></td>
											<td><?php echo fecha_estandar($error['Fecha_termino']); ?></td>
											<td><?php echo $error['Hora_termino'].' hrs'; ?></td>
											<td><?php echo $error['Tiempo'].' hrs'; ?></td>
											<?php if($rowdata['id_Geo']==1){ ?>
												<td>
													<div class="btn-group" style="width: 35px;" >
														<a href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'_view.php?view='.$error['idFueraLinea'].'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
													</div>
												</td>
											<?php } ?> 		
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="carga">
					<div class="wmd-panel">
						<?php
						// Se trae un listado con todas las fuera de linea
						$arrCarga = array();
						$query = "SELECT
						telemetria_carga_bam.idCarga,
						usuarios_listado.Nombre AS Usuario,
						telemetria_carga_bam.FechaCarga,
						telemetria_carga_bam.FechaVencimiento,
						telemetria_carga_bam.Monto

						FROM `telemetria_carga_bam`
						LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario       = telemetria_carga_bam.idUsuario

						WHERE telemetria_carga_bam.idTelemetria = ".$X_Puntero."
						ORDER BY telemetria_carga_bam.FechaVencimiento DESC
						LIMIT 20";
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
						array_push( $arrCarga,$row );
						}
						?>
						
						<div class="table-responsive">
							
							
							
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Usuario Carga</th>
										<th>Fecha Carga</th>
										<th>Fecha Vencimiento</th>
										<th>Monto</th>
									</tr>
								</thead>				  
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrCarga as $carga) { ?>

									<tr class="odd">
										<td><?php echo $carga['Usuario']; ?></td>
										<td><?php echo fecha_estandar($carga['FechaCarga']); ?></td>
										<td><?php echo fecha_estandar($carga['FechaVencimiento']); ?></td>
										<td><?php echo valores($carga['Monto'], 0); ?></td>
									</tr>
								<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="mantencion">
					<div class="wmd-panel">
						<?php
						// Se trae un listado con todas las fuera de linea
						$arrMantenciones = array();
						$query = "SELECT
						telemetria_historial_mantencion.idMantencion,
						telemetria_historial_mantencion.Fecha,
						usuarios_listado.Nombre AS Usuario,
						telemetria_listado.Nombre AS Equipo

						FROM `telemetria_historial_mantencion_equipos`
						LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria                = telemetria_historial_mantencion_equipos.idTelemetria
						LEFT JOIN `telemetria_historial_mantencion`   ON telemetria_historial_mantencion.idMantencion   = telemetria_historial_mantencion_equipos.idMantencion
						LEFT JOIN `usuarios_listado`                  ON usuarios_listado.idUsuario                     = telemetria_historial_mantencion.idUsuario

						WHERE telemetria_historial_mantencion_equipos.idTelemetria = ".$X_Puntero."
						ORDER BY telemetria_historial_mantencion.Fecha DESC
						LIMIT 20";
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
						array_push( $arrMantenciones,$row );
						}
						?>
						
						<div class="table-responsive">

							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th>Fecha</th>
										<th>Tecnico</th>
										<th>Equipo</th>
										<th width="10">Acciones</th>
									</tr>
								</thead>				  
								<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php foreach ($arrMantenciones as $mant) { ?>
									<tr class="odd">
										<td><?php echo $mant['Fecha']; ?></td>
										<td><?php echo $mant['Usuario']; ?></td>
										<td><?php echo $mant['Equipo']; ?></td>
										<td>
											<div class="btn-group" style="width: 35px;" >
												<a href="<?php echo 'view_telemetria_mantencion.php?view='.simpleEncode($mant['idMantencion'], fecha_actual()).'&return='.basename($_SERVER["REQUEST_URI"], ".php"); ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
											</div>
										</td>
									</tr>
								<?php } ?>                    
								</tbody>
							</table>
	
						</div>
					</div>
				</div>
				
				
			
			
        </div>	
	</div>
</div>


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
