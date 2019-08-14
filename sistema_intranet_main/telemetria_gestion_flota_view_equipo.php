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
/*                                                Carga del documento HTML                                                        */
/**********************************************************************************************************************************/
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
			body {
				background-color: #FFF;
			}
		</style>
	</head>

	<body>

<?php 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre, IdentificadorEmpresa, LimiteVelocidad, cantSensores, id_Geo, id_Sensores, Direccion_img, TiempoFueraLinea, TiempoDetencion
FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['view']}";
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


/*****************************************************************/
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
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
											
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
											
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
/*************************************************************************/
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
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
											
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
											
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFlinea,$row );
}
?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Equipo <?php echo $rowdata['Nombre']; ?></h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#basicos" data-toggle="tab">Datos Basicos</a></li>
				
				<?php if(isset($rowdata['id_Sensores'])&&$rowdata['id_Sensores']==1){ ?>
					<li class=""><a href="#mediciones" data-toggle="tab">Ultimas Mediciones</a></li>
				<?php } ?>
				<?php if(!empty($arrAlertas)){ ?>
					<li class=""><a href="#alertas" data-toggle="tab">Alertas</a></li>
				<?php } ?>
				<?php if(!empty($arrFlinea)){ ?>
					<li class=""><a href="#flinea" data-toggle="tab">Fuera de Linea</a></li>
				<?php } ?>
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
						<h2 class="text-primary">Datos del Equipo</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Identificador Empresa : </strong><?php echo $rowdata['IdentificadorEmpresa']; ?><br/>
						</p>

						<h2 class="text-primary">Datos de Configuracion</h2>
						<p class="text-muted">
							<?php if($rowdata['id_Geo']==1){ ?>
							<strong>Limite Velocidad : </strong><?php echo Cantidades_decimales_justos($rowdata['LimiteVelocidad']).' KM/h'; ?><br/>
							<?php } ?>
							<?php if($rowdata['id_Sensores']==1){ ?>
							<strong>Cantidad de Sensores : </strong><?php echo $rowdata['cantSensores']; ?><br/>
							<?php } ?>
							<strong>Tiempo Fuera Linea Maximo : </strong><?php echo $rowdata['TiempoFueraLinea']; ?> Horas<br/>
							<strong>Tiempo Maximo Detencion : </strong><?php echo $rowdata['TiempoDetencion']; ?> Horas<br/>
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
							//Genero numero aleatorio
							$vardata = genera_password(8,'alfanumerico');
											
							//Guardo el error en una variable temporal
							$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
							$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
							$_SESSION['ErrorListing'][$vardata]['query']        = $query;
											
						}
						$rowMed = mysqli_fetch_assoc ($resultado);
						
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
						}?>
						
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
											<th>Fecha/hora</th>
											<th>Medicion Actual</th>
											<th>Minimo</th>
											<th>Maximo</th>
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
												}?>
												<tr class="odd <?php if($rowMed['SensoresMedActual_'.$i] < $rowMed['SensoresMedMin_'.$i] or $rowMed['SensoresMedActual_'.$i]>$rowMed['SensoresMedMax_'.$i]){echo 'danger';}?>">		
													<td><?php echo 's'.$i ?></td>
													<td><?php echo $rowMed['SensoresNombre_'.$i]; ?></td>	
													<td><?php echo fecha_estandar($rowMed['LastUpdateFecha']).' - '.$rowMed['LastUpdateHora'].' hrs'; ?></td>
													<td><?php 
													if(isset($rowMed['SensoresMedActual_'.$i])&&$rowMed['SensoresMedActual_'.$i]!=999){
														echo Cantidades_decimales_justos($rowMed['SensoresMedActual_'.$i]).$unimed;
													}else{
														echo 'Sin Datos';
													} ?>
													</td>
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMin_'.$i]).$unimed; ?></td>		
													<td><?php echo Cantidades_decimales_justos($rowMed['SensoresMedMax_'.$i]).$unimed; ?></td>
												</tr>
											<?php } ?>
										<?php } ?>                    
									</tbody>
								</table>
						
						</div>
					</div>
				</div>
			<?php } ?>
			
			
			
			<?php if(!empty($arrAlertas)){ ?>
				<div class="tab-pane fade" id="alertas">
					<div class="wmd-panel">
						
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
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_errores_'.$rowdata['id_Geo'].'_view.php?view='.$error['idErrores']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
			<?php } ?>
			
			<?php if(!empty($arrFlinea)){ ?>	
				<div class="tab-pane fade" id="flinea">
					<div class="wmd-panel">
						
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
														<a target="_blank" rel="noopener noreferrer" href="<?php echo 'informe_telemetria_fuera_linea_'.$rowdata['id_Geo'].'_view.php?view='.$error['idFueraLinea']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
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
			<?php } ?>
			
			
        </div>	
	</div>
</div>


<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>

		
	</body>

</html>
