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
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "telemetria_gestion_equipos.php";
$location = $original;  
//Se agregan ubicaciones
$location .='?filtro=true';	  
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) {
//Variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
$eq_alertas     = 0; 
$eq_fueralinea  = 0; 
$eq_fueraruta   = 0;
$eq_detenidos   = 0;

//Variable
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
$z .= " AND telemetria_listado.id_Geo = 2";//solo los equipos que tengan el seguimiento desactivado
$enlace = "?dd=true";
//verifico que sea un administrador
$z .= " AND telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
$enlace .= "&idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
if (isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z .= " AND telemetria_listado.idTelemetria={$_GET['idTelemetria']}";
	$enlace .= "&idTelemetria=".$_GET['idTelemetria'];	
}

						
//Listar los equipos
$query = "SELECT
telemetria_listado.GeoLatitud, 
telemetria_listado.GeoLongitud,
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.Direccion_img,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea,

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

SensoresActivo_1, SensoresActivo_2, SensoresActivo_3, SensoresActivo_4, SensoresActivo_5, 
SensoresActivo_6, SensoresActivo_7, SensoresActivo_8, SensoresActivo_9, SensoresActivo_10, 
SensoresActivo_11, SensoresActivo_12, SensoresActivo_13, SensoresActivo_14, SensoresActivo_15, 
SensoresActivo_16, SensoresActivo_17, SensoresActivo_18, SensoresActivo_19, SensoresActivo_20, 
SensoresActivo_21, SensoresActivo_22, SensoresActivo_23, SensoresActivo_24, SensoresActivo_25, 
SensoresActivo_26, SensoresActivo_27, SensoresActivo_28, SensoresActivo_29, SensoresActivo_30, 
SensoresActivo_31, SensoresActivo_32, SensoresActivo_33, SensoresActivo_34, SensoresActivo_35, 
SensoresActivo_36, SensoresActivo_37, SensoresActivo_38, SensoresActivo_39, SensoresActivo_40, 
SensoresActivo_41, SensoresActivo_42, SensoresActivo_43, SensoresActivo_44, SensoresActivo_45, 
SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50,

core_sistemas.idOpcionesGen_3

FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$z."
ORDER BY telemetria_listado.Nombre ASC  ";
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
$rowDatos = mysqli_fetch_assoc ($resultado);


//Se traen todas las unidades de medida
$arrUnimed = array();
$query = "SELECT idUniMed,Nombre
FROM `telemetria_listado_unidad_medida`
ORDER BY idUniMed ASC";
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
array_push( $arrUnimed,$row );
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
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGrupos,$row );
}


?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Gestion de Equipos en Tiempo Real</h5>	
		</header>
        <div class="table-responsive">
			
			<div class="col-sm-7">
				<div class="row">
					<div id="consulta">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th>Nombre</th>
									<th width="80">Estado</th>
									<th width="80">Acciones</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php 
									
									//alertas
									$xx = 0;
									$xy = 0;
									$xz = 0;
									$dataex = '';
									$eq_ok = '<a href="#" title="Sin Problemas" class="btn btn-success btn-sm tooltip"><i class="fa fa-check"></i></a>';
									for ($i = 1; $i <= $rowDatos['cantSensores']; $i++) {
										//solo sensores activos
										if(isset($rowDatos['SensoresActivo_'.$i])&&$rowDatos['SensoresActivo_'.$i]==1){
											$xx = $rowDatos['SensoresMedErrores_'.$i] - $rowDatos['SensoresErrorActual_'.$i];
											if($xx<0){$xy = 1;$eq_ok = '';}
										}
									}
									$eq_alertas = $eq_alertas + $xy;
									
									//Fuera de linea
									//Verifico la resta de la hora de la ulima actualizacion contra  la hora actual
									$diaInicio   = $rowDatos['LastUpdateFecha'];
									$diaTermino  = $FechaSistema;
									$tiempo1     = $rowDatos['LastUpdateHora'];
									$tiempo2     = $HoraSistema;
									//calculo diferencia de dias
									$n_dias = dias_transcurridos($diaInicio,$diaTermino);
									//calculo del tiempo transcurrido
									$Tiempo = restahoras($tiempo1, $tiempo2);
									//Calculo del tiempo transcurrido
									if($n_dias!=0){
										if($n_dias>=2){
											$n_dias = $n_dias-1;
											$horas_trans2 = multHoras('24:00:00',$n_dias);
											$Tiempo = sumahoras($Tiempo,$horas_trans2);
										}
										if($n_dias==1&&$tiempo1<$tiempo2){
											$horas_trans2 = multHoras('24:00:00',$n_dias);
											$Tiempo = sumahoras($Tiempo,$horas_trans2);
										}
									}
									if($Tiempo>$rowDatos['TiempoFueraLinea']&&$rowDatos['TiempoFueraLinea']!='00:00:00'){
										$eq_fueralinea = $eq_fueralinea + 1;	
										$eq_ok = '';
									}
									
									
									
									//equipos ok
									if($eq_alertas>0){$xz = 1;$dataex .= '<a href="#" title="Con Alertas" class="btn btn-danger btn-sm tooltip"><i class="fa fa-exclamation-triangle"></i></a>';}
									if($eq_fueralinea>0){$xz = 1;$dataex .= '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken"></i></a>';}
									
									$eq_ok .= $dataex;
									
									
									?>
								<tr class="odd <?php if($xz!=0){echo 'danger';}?>">		
									<td><?php echo $rowDatos['Nombre']; ?></td>		
									<td><div class="btn-group" ><?php echo $eq_ok; ?></div></td>			
									<td>
										<div class="btn-group" style="width: 35px;" >
											<a href="<?php echo 'telemetria_gestion_equipos_view_equipo.php?view='.$rowDatos['idTelemetria']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>						
										</div>
									</td>
								</tr>
								<tr class="odd" style="background-color: #CCCCCC;">		
									<td>Grupo</td>		
									<td colspan="2">Mediciones</td>			
								</tr>
								
								<?php
								$arrGruposTitulo = array();
								$n_sensores = 0;
								$sensor = 0;
								for ($i = 1; $i <= $rowDatos['cantSensores']; $i++) {
									//Unidad medida
									$unimed = '';
									foreach ($arrUnimed as $sen) { 
										if($rowDatos['SensoresUniMed_'.$i]==$sen['idUniMed']){
											$unimed = ' '.$sen['Nombre'];
										}	
									}
									//Titulo del cuadro
									$Titulo = '';
									foreach ($arrGrupos as $group) { 
										if($rowDatos['SensoresGrupo_'.$i]==$group['idGrupo']){
											$Titulo = $group['Nombre'];
										}
									}	
									//Verifico que no sea el mismo sensor
									if(isset($rowDatos['SensoresMedActual_'.$i])&&$rowDatos['SensoresMedActual_'.$i]!=999){$xdata=Cantidades_decimales_justos($rowDatos['SensoresMedActual_'.$i]).$unimed;}else{$xdata='Sin Datos';}
									if($rowDatos['SensoresErrorActual_'.$i]> 0){
										$arrGruposTitulo[$Titulo][$i]['Descripcion'] = '<span style="color:red;">'.$rowDatos['SensoresNombre_'.$i].' : '.$xdata.'</span>';
									}else{
										$arrGruposTitulo[$Titulo][$i]['Descripcion'] = $rowDatos['SensoresNombre_'.$i].' : '.$xdata;
									}
									//Guardo el valor correspondiente
									$arrGruposTitulo[$Titulo][$i]['valor'] = $rowDatos['SensoresMedActual_'.$i];
									$arrGruposTitulo[$Titulo][$i]['unimed'] = $unimed;
								}
								
								//Ordenamiento por titulo de grupo
								$names = array();
								foreach ($arrGruposTitulo as $titulo=>$items) {
									$names[] = $titulo;
								}
								array_multisort($names, SORT_ASC, $arrGruposTitulo);
									
								//se recorre el arreglo
								foreach($arrGruposTitulo as $titulo=>$items) { 
									
									$columna_a = '';
									$columna_b = '';
									$total_col1 = 0;
									$total_col2 = 0;
									$ntotal_col1 = 0;
									$ntotal_col2 = 0;
									$unimed_col1 = '';
									$unimed_col2 = '';
									$y = 1;
									?>
									<tr class="odd">		
										<td><?php echo $titulo ?></td>		
										<?php foreach($items as $datos) { 
											if($y==1){
												$columna_a .= $datos['Descripcion'].'<br/>';
												//Verifico que el dato no sea 999
												if(isset($datos['valor'])&&$datos['valor']!=999){
													$total_col1 = $total_col1 + $datos['valor'];
													$ntotal_col1++;
												}
												$unimed_col1 = $datos['unimed'];
												$y=2;
											}else{
												$columna_b .= $datos['Descripcion'].'<br/>';
												//Verifico que el dato no sea 999
												if(isset($datos['valor'])&&$datos['valor']!=999){
													$total_col2 = $total_col2 + $datos['valor'];
													$ntotal_col2++;
												}
												$unimed_col2 = $datos['unimed'];
												$y=1;
											}
										}?> 
										
										<td><?php echo $columna_a ?></td>
										<td><?php echo $columna_b ?></td>		
									</tr>
									
									<?php if($rowDatos['idOpcionesGen_3']==1){ ?>
										<tr class="odd">		
											<td>Promedio</td>
											<td><?php if($ntotal_col1!=0){echo Cantidades_decimales_justos($total_col1/$ntotal_col1).$unimed_col1;} ?></td>
											<td><?php if($ntotal_col2!=0){echo Cantidades_decimales_justos($total_col2/$ntotal_col2).$unimed_col2;} ?></td>			
										</tr>
									<?php } ?>
										
										
					            <?php } ?>        
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-sm-5">
				<div class="row">	
					<?php if ($rowDatos['Direccion_img']=='') { ?>
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/maquina.jpg">
					<?php }else{  ?>
						<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowDatos['Direccion_img']; ?>">
					<?php }?>
				</div>
			</div>
			
			
			
		</div>	
	</div>
</div>
<?php widget_modal(80, 95); ?>

<script type="text/javascript">
function initialize() {
	setInterval(function(){myTimer2()},10000)
}
function myTimer2() {
	$('#consulta').load('telemetria_gestion_equipos_update.php<?php echo $enlace; ?>');
} 
</script>
<script type="text/javascript">initialize();</script>


  
<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "idSistema>=0 AND id_Geo=2";	
}else{
	//filtro
	$z = "idTelemetria=0";
	//Se revisan los permisos a los contratos
	$arrPermisos = array();
	$query = "SELECT idTelemetria
	FROM `usuarios_equipos_telemetria`
	WHERE idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";
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
	array_push( $arrPermisos,$row );
	}
	foreach ($arrPermisos as $prod) {
		$z .= " OR (idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1 AND id_Geo=2 AND idTelemetria={$prod['idTelemetria']})";
	}
	//$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND id_Geo=2";	
}	

	 
?>

<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" action="<?php echo $original; ?>" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {     $x1  = $idTelemetria;      }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Ver" name="submit_filter">
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
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
