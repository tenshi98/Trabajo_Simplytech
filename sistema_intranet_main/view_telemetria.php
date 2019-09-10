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
opc2.Nombre AS Geo,
opc3.Nombre AS Sensores,
opc4.Nombre AS Contratos,
telemetria_listado.Codigo AS ContratoCodigo,
telemetria_listado.F_Inicio AS ContratoF_Inicio,
telemetria_listado.F_Termino AS ContratoF_Termino,
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
telemetria_zonas.Nombre AS Zona, 
telemetria_listado.idUsoContrato

FROM `telemetria_listado`
LEFT JOIN `core_sistemas`                        ON core_sistemas.idSistema                            = telemetria_listado.idSistema
LEFT JOIN `core_sistemas_opciones`        opc2   ON opc2.idOpciones                                    = telemetria_listado.id_Geo
LEFT JOIN `core_sistemas_opciones`        opc3   ON opc3.idOpciones                                    = telemetria_listado.id_Sensores
LEFT JOIN `core_sistemas_opciones`        opc4   ON opc4.idOpciones                                    = telemetria_listado.idUsoContrato
LEFT JOIN `telemetria_listado_dispositivos`      ON telemetria_listado_dispositivos.idDispositivo      = telemetria_listado.idDispositivo
LEFT JOIN `core_estados`                         ON core_estados.idEstado                              = telemetria_listado.idEstado
LEFT JOIN `telemetria_listado_shield`            ON telemetria_listado_shield.idShield                 = telemetria_listado.idShield
LEFT JOIN `telemetria_listado_alarma_general`    ON telemetria_listado_alarma_general.idAlarmaGeneral  = telemetria_listado.idAlarmaGeneral
LEFT JOIN `core_ubicacion_ciudad`                ON core_ubicacion_ciudad.idCiudad                     = telemetria_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`               ON core_ubicacion_comunas.idComuna                    = telemetria_listado.idComuna
LEFT JOIN `telemetria_zonas`                     ON telemetria_zonas.idZona                            = telemetria_listado.idZona

WHERE idTelemetria = {$_GET['view']}";
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


//Se traen todas las activaciones
$arrOpciones = array();
$query = "SELECT idOpciones,Nombre
FROM `core_sistemas_opciones`
ORDER BY idOpciones ASC";
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
array_push( $arrOpciones,$row );
}

?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Equipo</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos Basicos</a></li>
				
				<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
				<li class=""><a href="#mediciones" data-toggle="tab">Ultimas Mediciones</a></li>
				<?php } ?>
				
				<?php if(isset($rowdata['idTrabajador'])&&$rowdata['idTrabajador']!=0){ ?>
				<li class=""><a href="#trabajador" data-toggle="tab">Datos del Trabajador</a></li>
				<?php } ?>
				
				<?php if(isset($rowdata['idBodega'])&&$rowdata['idBodega']!=0){ ?>
				<li class=""><a href="#bodega" data-toggle="tab">Stock Bodega</a></li>
				<?php } ?>
				
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="#alertas" data-toggle="tab">Alertas</a></li>
						<li class=""><a href="#flinea" data-toggle="tab">Fuera de Linea</a></li>
						
						<li class=""><a href="#carga" data-toggle="tab">Cargas</a></li>
						<li class=""><a href="#mantencion" data-toggle="tab">Mantenciones</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/maquina.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Equipo</h2>
						<p class="text-muted">
							<?php if(isset($rowdata['Nombre'])&&$rowdata['Nombre']!=''){ ?><strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/><?php } ?>
							<?php if(isset($rowdata['IdentificadorEmpresa'])&&$rowdata['IdentificadorEmpresa']!=''){ ?><strong>Identificador Empresa : </strong><?php echo $rowdata['IdentificadorEmpresa']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Num_Tel'])&&$rowdata['Sim_Num_Tel']!=''){ ?><strong>SIM - Numero Telefonico : </strong><?php echo $rowdata['Sim_Num_Tel']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Num_Serie'])&&$rowdata['Sim_Num_Serie']!=''){ ?><strong>SIM - Numero Serie : </strong><?php echo $rowdata['Sim_Num_Serie']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_Compania'])&&$rowdata['Sim_Compania']!=''){ ?><strong>SIM - Compañia : </strong><?php echo $rowdata['Sim_Compania']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_marca'])&&$rowdata['Sim_marca']!=''){ ?><strong>BAM - Marca : </strong><?php echo $rowdata['Sim_marca']; ?><br/><?php } ?>
							<?php if(isset($rowdata['Sim_modelo'])&&$rowdata['Sim_modelo']!=''){ ?><strong>BAM - Modelo : </strong><?php echo $rowdata['Sim_modelo']; ?><br/><?php } ?>
							<?php if(isset($rowdata['IP_Client'])&&$rowdata['IP_Client']!=''){ ?><strong>IP Cliente : </strong><?php echo $rowdata['IP_Client']; ?><br/><?php } ?>
							<?php if(isset($rowdata['idTelemetria'])&&$rowdata['idTelemetria']!=''){ ?><strong>ID Equipo : </strong><?php echo $rowdata['idTelemetria']; ?><br/><?php } ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Configuracion</h2>
						<p class="text-muted">
							<strong>Identificador : </strong><?php echo $rowdata['Identificador']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?><br/>
							<strong>Alarma General : </strong><?php echo $rowdata['AlarmaGeneral']; ?><br/>
							<strong>Geolocalizacion : </strong><?php echo $rowdata['Geo']; ?><br/>
							<?php if($rowdata['id_Geo']==1){ ?>
							<strong>Limite Velocidad : </strong><?php echo Cantidades_decimales_justos($rowdata['LimiteVelocidad']).' KM/h'; ?><br/>
							<?php }
							if($rowdata['id_Geo']==2){ ?>
								<strong>Zona : </strong><?php echo $rowdata['Zona']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['Comuna'].', '.$rowdata['Ciudad']; ?><br/>
							<?php } ?>
							<strong>Sensores : </strong><?php echo $rowdata['Sensores'].' ';if($rowdata['id_Sensores']==1){echo '('.$rowdata['cantSensores'].' Sensores)';} ?><br/>
							<strong>Hardware : </strong><?php echo $rowdata['Dispositivo']; ?><br/>
							<?php if(isset($rowdata['Shield'])&&$rowdata['Shield']!=''){ ?>
							<strong>Shield : </strong><?php echo $rowdata['Shield']; ?><br/>
							<?php } ?>
							<strong>Tiempo Fuera Linea Maximo : </strong><?php echo $rowdata['TiempoFueraLinea']; ?> Horas<br/>
							<?php if($rowdata['id_Geo']==1){ ?>
							<strong>Tiempo Maximo Detencion : </strong><?php echo $rowdata['TiempoDetencion']; ?> Horas<br/>
							<?php } ?>
							<strong>Utilizacion de Contratos : </strong><?php echo $rowdata['Contratos'].' ';if($rowdata['idUsoContrato']==1){ echo '(Contrato Cod <strong>'.$rowdata['ContratoCodigo'].'</strong>, valido del <strong>'.fecha_estandar($rowdata['ContratoF_Inicio']).'</strong> al <strong>'.fecha_estandar($rowdata['ContratoF_Termino']).'</strong>)';} ?><br/>
							<?php if(isset($rowdata['Capacidad'])&&$rowdata['Capacidad']!=0){ ?>
								<strong>Capacidad : </strong><?php echo Cantidades_decimales_justos($rowdata['Capacidad']); ?><br/>
							<?php } ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Horario Notificaciones</h2>
						<p class="text-muted">
							<?php
							for ($i = 1; $i <= 7; $i++) {
								//Unidad medida
								$bla = 'No Asignado';
								foreach ($arrOpciones as $sen) { 
									if($rowdata['Hor_idActivo_dia'.$i]==$sen['idOpciones']){
										$bla = $sen['Nombre'];
									}
								}
								?>
								<strong><?php echo numero_nombreDia($i); ?> : </strong><?php echo $bla.' / '.$rowdata['Hor_Inicio_dia'.$i].' - '.$rowdata['Hor_Termino_dia'.$i]; ?><br/>
							<?php } ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Jornada Laboral</h2>
						<p class="text-muted">
							<strong>Hora Inicio Jornada : </strong><?php echo $rowdata['Jornada_inicio'].' hrs'; ?><br/>
							<strong>Hora Termino Jornada : </strong><?php echo $rowdata['Jornada_termino'].' hrs'; ?><br/>
							<strong>Hora Inicio Colacion : </strong><?php echo $rowdata['Colacion_inicio'].' hrs'; ?><br/>
							<strong>Hora Termino Colacion : </strong><?php echo $rowdata['Colacion_termino'].' hrs'; ?><br/>
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
						// tomo los datos del usuario
						$query = "SELECT Nombre,id_Geo, id_Sensores,cantSensores,LastUpdateFecha,LastUpdateHora,
						GeoVelocidad,

						SensoresNombre_1, SensoresNombre_2, SensoresNombre_3, SensoresNombre_4, SensoresNombre_5, 
						SensoresNombre_6, SensoresNombre_7, SensoresNombre_8, SensoresNombre_9, SensoresNombre_10, 
						SensoresNombre_11, SensoresNombre_12, SensoresNombre_13, SensoresNombre_14, SensoresNombre_15, 
						SensoresNombre_16, SensoresNombre_17, SensoresNombre_18, SensoresNombre_19, SensoresNombre_20, 
						SensoresNombre_21, SensoresNombre_22, SensoresNombre_23, SensoresNombre_24, SensoresNombre_25, 
						SensoresNombre_26, SensoresNombre_27, SensoresNombre_28, SensoresNombre_29, SensoresNombre_30, 
						SensoresNombre_31, SensoresNombre_32, SensoresNombre_33, SensoresNombre_34, SensoresNombre_35, 
						SensoresNombre_36, SensoresNombre_37, SensoresNombre_38, SensoresNombre_39, SensoresNombre_40, 
						SensoresNombre_41, SensoresNombre_42, SensoresNombre_43, SensoresNombre_44, SensoresNombre_45, 
						SensoresNombre_46, SensoresNombre_47, SensoresNombre_48, SensoresNombre_49, SensoresNombre_50,

						SensoresTipo_1, SensoresTipo_2, SensoresTipo_3, SensoresTipo_4, SensoresTipo_5, 
						SensoresTipo_6, SensoresTipo_7, SensoresTipo_8, SensoresTipo_9, SensoresTipo_10, 
						SensoresTipo_11, SensoresTipo_12, SensoresTipo_13, SensoresTipo_14, SensoresTipo_15, 
						SensoresTipo_16, SensoresTipo_17, SensoresTipo_18, SensoresTipo_19, SensoresTipo_20, 
						SensoresTipo_21, SensoresTipo_22, SensoresTipo_23, SensoresTipo_24, SensoresTipo_25, 
						SensoresTipo_26, SensoresTipo_27, SensoresTipo_28, SensoresTipo_29, SensoresTipo_30, 
						SensoresTipo_31, SensoresTipo_32, SensoresTipo_33, SensoresTipo_34, SensoresTipo_35, 
						SensoresTipo_36, SensoresTipo_37, SensoresTipo_38, SensoresTipo_39, SensoresTipo_40, 
						SensoresTipo_41, SensoresTipo_42, SensoresTipo_43, SensoresTipo_44, SensoresTipo_45, 
						SensoresTipo_46, SensoresTipo_47, SensoresTipo_48, SensoresTipo_49, SensoresTipo_50,
						 
						SensoresMedMin_1, SensoresMedMin_2, SensoresMedMin_3, SensoresMedMin_4, SensoresMedMin_5, 
						SensoresMedMin_6, SensoresMedMin_7, SensoresMedMin_8, SensoresMedMin_9, SensoresMedMin_10, 
						SensoresMedMin_11, SensoresMedMin_12, SensoresMedMin_13, SensoresMedMin_14, SensoresMedMin_15, 
						SensoresMedMin_16, SensoresMedMin_17, SensoresMedMin_18, SensoresMedMin_19, SensoresMedMin_20, 
						SensoresMedMin_21, SensoresMedMin_22, SensoresMedMin_23, SensoresMedMin_24, SensoresMedMin_25, 
						SensoresMedMin_26, SensoresMedMin_27, SensoresMedMin_28, SensoresMedMin_29, SensoresMedMin_30, 
						SensoresMedMin_31, SensoresMedMin_32, SensoresMedMin_33, SensoresMedMin_34, SensoresMedMin_35, 
						SensoresMedMin_36, SensoresMedMin_37, SensoresMedMin_38, SensoresMedMin_39, SensoresMedMin_40, 
						SensoresMedMin_41, SensoresMedMin_42, SensoresMedMin_43, SensoresMedMin_44, SensoresMedMin_45, 
						SensoresMedMin_46, SensoresMedMin_47, SensoresMedMin_48, SensoresMedMin_49, SensoresMedMin_50,
						 
						SensoresMedMax_1, SensoresMedMax_2, SensoresMedMax_3, SensoresMedMax_4, SensoresMedMax_5, 
						SensoresMedMax_6, SensoresMedMax_7, SensoresMedMax_8, SensoresMedMax_9, SensoresMedMax_10, 
						SensoresMedMax_11, SensoresMedMax_12, SensoresMedMax_13, SensoresMedMax_14, SensoresMedMax_15, 
						SensoresMedMax_16, SensoresMedMax_17, SensoresMedMax_18, SensoresMedMax_19, SensoresMedMax_20, 
						SensoresMedMax_21, SensoresMedMax_22, SensoresMedMax_23, SensoresMedMax_24, SensoresMedMax_25, 
						SensoresMedMax_26, SensoresMedMax_27, SensoresMedMax_28, SensoresMedMax_29, SensoresMedMax_30, 
						SensoresMedMax_31, SensoresMedMax_32, SensoresMedMax_33, SensoresMedMax_34, SensoresMedMax_35, 
						SensoresMedMax_36, SensoresMedMax_37, SensoresMedMax_38, SensoresMedMax_39, SensoresMedMax_40, 
						SensoresMedMax_41, SensoresMedMax_42, SensoresMedMax_43, SensoresMedMax_44, SensoresMedMax_45, 
						SensoresMedMax_46, SensoresMedMax_47, SensoresMedMax_48, SensoresMedMax_49, SensoresMedMax_50, 

						SensoresMedErrores_1, SensoresMedErrores_2, SensoresMedErrores_3, SensoresMedErrores_4, SensoresMedErrores_5, 
						SensoresMedErrores_6, SensoresMedErrores_7, SensoresMedErrores_8, SensoresMedErrores_9, SensoresMedErrores_10, 
						SensoresMedErrores_11, SensoresMedErrores_12, SensoresMedErrores_13, SensoresMedErrores_14, SensoresMedErrores_15, 
						SensoresMedErrores_16, SensoresMedErrores_17, SensoresMedErrores_18, SensoresMedErrores_19, SensoresMedErrores_20, 
						SensoresMedErrores_21, SensoresMedErrores_22, SensoresMedErrores_23, SensoresMedErrores_24, SensoresMedErrores_25, 
						SensoresMedErrores_26, SensoresMedErrores_27, SensoresMedErrores_28, SensoresMedErrores_29, SensoresMedErrores_30, 
						SensoresMedErrores_31, SensoresMedErrores_32, SensoresMedErrores_33, SensoresMedErrores_34, SensoresMedErrores_35, 
						SensoresMedErrores_36, SensoresMedErrores_37, SensoresMedErrores_38, SensoresMedErrores_39, SensoresMedErrores_40, 
						SensoresMedErrores_41, SensoresMedErrores_42, SensoresMedErrores_43, SensoresMedErrores_44, SensoresMedErrores_45, 
						SensoresMedErrores_46, SensoresMedErrores_47, SensoresMedErrores_48, SensoresMedErrores_49, SensoresMedErrores_50, 

						SensoresErrorActual_1, SensoresErrorActual_2, SensoresErrorActual_3, SensoresErrorActual_4, SensoresErrorActual_5, 
						SensoresErrorActual_6, SensoresErrorActual_7, SensoresErrorActual_8, SensoresErrorActual_9, SensoresErrorActual_10, 
						SensoresErrorActual_11, SensoresErrorActual_12, SensoresErrorActual_13, SensoresErrorActual_14, SensoresErrorActual_15, 
						SensoresErrorActual_16, SensoresErrorActual_17, SensoresErrorActual_18, SensoresErrorActual_19, SensoresErrorActual_20, 
						SensoresErrorActual_21, SensoresErrorActual_22, SensoresErrorActual_23, SensoresErrorActual_24, SensoresErrorActual_25, 
						SensoresErrorActual_26, SensoresErrorActual_27, SensoresErrorActual_28, SensoresErrorActual_29, SensoresErrorActual_30, 
						SensoresErrorActual_31, SensoresErrorActual_32, SensoresErrorActual_33, SensoresErrorActual_34, SensoresErrorActual_35, 
						SensoresErrorActual_36, SensoresErrorActual_37, SensoresErrorActual_38, SensoresErrorActual_39, SensoresErrorActual_40, 
						SensoresErrorActual_41, SensoresErrorActual_42, SensoresErrorActual_43, SensoresErrorActual_44, SensoresErrorActual_45, 
						SensoresErrorActual_46, SensoresErrorActual_47, SensoresErrorActual_48, SensoresErrorActual_49, SensoresErrorActual_50,

						SensoresGrupo_1, SensoresGrupo_2, SensoresGrupo_3, SensoresGrupo_4, SensoresGrupo_5, 
						SensoresGrupo_6, SensoresGrupo_7, SensoresGrupo_8, SensoresGrupo_9, SensoresGrupo_10, 
						SensoresGrupo_11, SensoresGrupo_12, SensoresGrupo_13, SensoresGrupo_14, SensoresGrupo_15, 
						SensoresGrupo_16, SensoresGrupo_17, SensoresGrupo_18, SensoresGrupo_19, SensoresGrupo_20, 
						SensoresGrupo_21, SensoresGrupo_22, SensoresGrupo_23, SensoresGrupo_24, SensoresGrupo_25, 
						SensoresGrupo_26, SensoresGrupo_27, SensoresGrupo_28, SensoresGrupo_29, SensoresGrupo_30, 
						SensoresGrupo_31, SensoresGrupo_32, SensoresGrupo_33, SensoresGrupo_34, SensoresGrupo_35, 
						SensoresGrupo_36, SensoresGrupo_37, SensoresGrupo_38, SensoresGrupo_39, SensoresGrupo_40, 
						SensoresGrupo_41, SensoresGrupo_42, SensoresGrupo_43, SensoresGrupo_44, SensoresGrupo_45, 
						SensoresGrupo_46, SensoresGrupo_47, SensoresGrupo_48, SensoresGrupo_49, SensoresGrupo_50,
						
						SensoresUniMed_1, SensoresUniMed_2, SensoresUniMed_3, SensoresUniMed_4, SensoresUniMed_5, 
						SensoresUniMed_6, SensoresUniMed_7, SensoresUniMed_8, SensoresUniMed_9, SensoresUniMed_10, 
						SensoresUniMed_11, SensoresUniMed_12, SensoresUniMed_13, SensoresUniMed_14, SensoresUniMed_15, 
						SensoresUniMed_16, SensoresUniMed_17, SensoresUniMed_18, SensoresUniMed_19, SensoresUniMed_20, 
						SensoresUniMed_21, SensoresUniMed_22, SensoresUniMed_23, SensoresUniMed_24, SensoresUniMed_25, 
						SensoresUniMed_26, SensoresUniMed_27, SensoresUniMed_28, SensoresUniMed_29, SensoresUniMed_30, 
						SensoresUniMed_31, SensoresUniMed_32, SensoresUniMed_33, SensoresUniMed_34, SensoresUniMed_35, 
						SensoresUniMed_36, SensoresUniMed_37, SensoresUniMed_38, SensoresUniMed_39, SensoresUniMed_40, 
						SensoresUniMed_41, SensoresUniMed_42, SensoresUniMed_43, SensoresUniMed_44, SensoresUniMed_45, 
						SensoresUniMed_46, SensoresUniMed_47, SensoresUniMed_48, SensoresUniMed_49, SensoresUniMed_50,
						
						SensoresMedActual_1, SensoresMedActual_2, SensoresMedActual_3, SensoresMedActual_4, SensoresMedActual_5, 
						SensoresMedActual_6, SensoresMedActual_7, SensoresMedActual_8, SensoresMedActual_9, SensoresMedActual_10, 
						SensoresMedActual_11, SensoresMedActual_12, SensoresMedActual_13, SensoresMedActual_14, SensoresMedActual_15, 
						SensoresMedActual_16, SensoresMedActual_17, SensoresMedActual_18, SensoresMedActual_19, SensoresMedActual_20, 
						SensoresMedActual_21, SensoresMedActual_22, SensoresMedActual_23, SensoresMedActual_24, SensoresMedActual_25, 
						SensoresMedActual_26, SensoresMedActual_27, SensoresMedActual_28, SensoresMedActual_29, SensoresMedActual_30, 
						SensoresMedActual_31, SensoresMedActual_32, SensoresMedActual_33, SensoresMedActual_34, SensoresMedActual_35, 
						SensoresMedActual_36, SensoresMedActual_37, SensoresMedActual_38, SensoresMedActual_39, SensoresMedActual_40, 
						SensoresMedActual_41, SensoresMedActual_42, SensoresMedActual_43, SensoresMedActual_44, SensoresMedActual_45, 
						SensoresMedActual_46, SensoresMedActual_47, SensoresMedActual_48, SensoresMedActual_49, SensoresMedActual_50,
						
						SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
						SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
						SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
						SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
						SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
						SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
						SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
						SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
						SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
						SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50

						FROM `telemetria_listado`
						WHERE idTelemetria = {$_GET['view']}";
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
						array_push( $arrGrupos,$row );
						}
						
						//Se traen todas las unidades de medida
						$arrUnimed = array();
						$query = "SELECT idUniMed,Nombre
						FROM `telemetria_listado_unidad_medida`
						ORDER BY idUniMed ASC";
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
						array_push( $arrUnimed,$row );
						}
						?>
						
						<div class="table-responsive">    
							
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<?php if(isset($rowMed['id_Geo'])&&$rowMed['id_Geo']!=''&&$rowMed['id_Geo']==1){ ?>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_flota_view_equipo_mediciones.php?view='.$_GET['view'].'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ultima Ubicacion</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_1.php?view='.$_GET['view']; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_velocidad.php?view='.$_GET['view']; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Velocidades</a>
								<?php }elseif(isset($rowMed['id_Geo'])&&$rowMed['id_Geo']!=''&&$rowMed['id_Geo']==2){ ?>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'telemetria_gestion_sensores_view_equipo_mediciones.php?view='.$_GET['view'].'&cantSensores='.$rowMed['cantSensores']; ?>" class="btn btn-default fright margin_width fmrbtn" >Ver Ultima Ubicacion</a>
									<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_registro_sensores_2.php?view='.$_GET['view']; ?>" class="btn btn-default fright margin_width fmrbtn" >Informe Medicion Sensores</a>
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
												$unimed = '';
												//unidad de medida
												foreach ($arrUnimed as $sen) {
													if($rowMed['SensoresUniMed_'.$i]==$sen['idUniMed']){
														$unimed = ' '.$sen['Nombre'];	
													}
												}
												$s_alert = '';
												//se verifica que la medicion minima y maxima sean distintas de 0
												if($rowMed['SensoresMedMin_'.$i]!=0&&$rowMed['SensoresMedMax_'.$i]!=0){
													if($rowMed['SensoresMedActual_'.$i] < $rowMed['SensoresMedMin_'.$i] or $rowMed['SensoresMedActual_'.$i]>$rowMed['SensoresMedMax_'.$i]){
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
													if(isset($rowMed['SensoresMedActual_'.$i])&&$rowMed['SensoresMedActual_'.$i]!=999){
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
							error_log("========================================================================================================================================", 0);
							error_log("Usuario: ". $NombreUsr, 0);
							error_log("Transaccion: ". $Transaccion, 0);
							error_log("-------------------------------------------------------------------", 0);
							error_log("Error code: ". mysqli_errno($dbConn), 0);
							error_log("Error description: ". mysqli_error($dbConn), 0);
							error_log("Error query: ". $query, 0);
							error_log("-------------------------------------------------------------------", 0);
											
						}
						$rowTrabajador = mysqli_fetch_assoc ($resultado);
						?>
						
						<div class="col-sm-4">
							<?php if ($rowdata['Direccion_img']=='') { ?>
								<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/maquina.jpg">
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
						WHERE telemetria_listado_errores.idTelemetria = {$_GET['view']}
						AND telemetria_listado_errores.idTipo!='999'
						AND telemetria_listado_errores.Valor!='999'
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
						array_push( $arrAlertas,$row );
						}
						
						//Se traen todas las unidades de medida
						$arrUnimed = array();
						$query = "SELECT idUniMed,Nombre
						FROM `telemetria_listado_unidad_medida`
						ORDER BY idUniMed ASC";
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
						array_push( $arrUnimed,$row );
						}
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'.php?idTelemetria='.$_GET['view'].'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
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
											$unimed = '';
											foreach ($arrUnimed as $sen) {
												if($error['SensoresUniMed_'.$error['Sensor']]==$sen['idUniMed']){
													$unimed = ' '.$sen['Nombre'];	
												}
											} ?>
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
														<a href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'_view.php?view='.$error['idErrores'].'&return=true'; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
						WHERE idTelemetria = {$_GET['view']}
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
						array_push( $arrFlinea,$row );
						}
						?>
						
						<div class="table-responsive">
							
							<div class="form-group" style="padding-top:10px;padding-bottom:10px;">
								<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'.php?idTelemetria='.$_GET['view'].'&submit_filter=Filtrar'; ?>" class="btn btn-default fright margin_width fmrbtn" >Abrir Reporte</a>
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
														<a href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'_view.php?view='.$error['idFueraLinea'].'&return=true'; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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

						WHERE telemetria_carga_bam.idTelemetria = {$_GET['view']}
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

						FROM `telemetria_historial_mantencion`
						LEFT JOIN `telemetria_listado`   ON telemetria_listado.idTelemetria   = telemetria_historial_mantencion.idTelemetria
						LEFT JOIN `usuarios_listado`     ON usuarios_listado.idUsuario        = telemetria_historial_mantencion.idUsuario

						WHERE telemetria_historial_mantencion.idTelemetria = {$_GET['view']}
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
												<a href="<?php echo 'view_telemetria_mantencion.php?view='.$mant['idMantencion'].'&return=true'; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
