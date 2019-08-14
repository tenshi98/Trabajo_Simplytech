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
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['viewMuestra']) ) { 
//Verifico el tipo de usuario que esta ingresando
$w = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND idEstado=1";

/***********************************************/
//Armo cadena
$cadena  = 'Nombre, idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3';
for ($i = 1; $i <= $_GET['cantPuntos']; $i++) {
	$cadena .= ',PuntoNombre_'.$i;
	$cadena .= ',PuntoidTipo_'.$i;
	$cadena .= ',PuntoidGrupo_'.$i;
	$cadena .= ',PuntoUniMed_'.$i;
}

// tomo los datos del usuario
$query = "SELECT ".$cadena."
FROM `cross_quality_calidad_matriz`
WHERE idMatriz = {$_GET['idCalidad']}";
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

/***********************************************/
//Armo cadena
$cadena  = '';
for ($i = 1; $i <= $_GET['cantPuntos']; $i++) {
	$cadena .= ',cross_quality_analisis_calidad_muestras.Medida_'.$i;
}

// tomo los datos del usuario
$query = "SELECT 
cross_quality_analisis_calidad_muestras.n_folio_pallet,
cross_quality_analisis_calidad_muestras.lote,
cross_quality_analisis_calidad_muestras.f_embalaje,
cross_quality_analisis_calidad_muestras.f_cosecha,
cross_quality_analisis_calidad_muestras.H_inspeccion,
cross_quality_analisis_calidad_muestras.cantidad,
cross_quality_analisis_calidad_muestras.peso, 
cross_quality_analisis_calidad_muestras.Resolucion_1,
cross_quality_analisis_calidad_muestras.Resolucion_2,
cross_quality_analisis_calidad_muestras.Resolucion_3,


productores_listado.Nombre AS Cliente,
sistema_cross_analisis_embalaje.Nombre AS Tipo

".$cadena."
FROM `cross_quality_analisis_calidad_muestras`
LEFT JOIN `productores_listado`               ON productores_listado.idProductor         = cross_quality_analisis_calidad_muestras.idProductor
LEFT JOIN `sistema_cross_analisis_embalaje`   ON sistema_cross_analisis_embalaje.idTipo  = cross_quality_analisis_calidad_muestras.idTipo

WHERE cross_quality_analisis_calidad_muestras.idMuestras = {$_GET['viewMuestra']}";
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
$rowMuestras = mysqli_fetch_assoc ($resultado); 

/***********************************************/
// Se trae un listado con todos los grupos
$arrGrupo = array();
$query = "SELECT idGrupo, Nombre, Totales
FROM `cross_quality_calidad_matriz_grupos` ";
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
array_push( $arrGrupo,$row );
}
/***********************************************/
// Se trae un listado con todas las unidades de medida
$arrUnidadMedida = array();
$query = "SELECT idUml, Nombre
FROM `sistema_cross_analisis_uml` ";
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
array_push( $arrUnidadMedida,$row );
}		
	
?>		
		
<section class="invoice">
	
	<div class="row">
		
		<div class="col-xs-4">
			<p class="lead">Datos Basicos:</p>
			<p class="text-muted well well-sm no-shadow" >
				<strong>Productor: </strong>                 <?php echo $rowMuestras['Cliente'].'<br/>'; ?>
				<strong>N° Folio / Pallet: </strong>         <?php echo $rowMuestras['n_folio_pallet'].'<br/>'; ?>
				<strong>Tipo Embalaje: </strong>             <?php echo $rowMuestras['Tipo'].'<br/>'; ?>
				<strong>Lote: </strong>                      <?php echo $rowMuestras['lote'].'<br/>'; ?>
				<strong>Fecha Embalaje: </strong>            <?php echo fecha_estandar($rowMuestras['f_embalaje']).'<br/>'; ?>
				<strong>Fecha Cosecha: </strong>             <?php echo fecha_estandar($rowMuestras['f_cosecha']).'<br/>'; ?>
				<strong>Hora Inspeccion: </strong>           <?php echo $rowMuestras['H_inspeccion'].' hrs.<br/>'; ?>
				<strong>N° Cajas/Bolsas/Racimos: </strong>   <?php echo $rowMuestras['cantidad'].'<br/>'; ?>
				<strong>Peso Caja: </strong>                 <?php echo $rowMuestras['peso'].'<br/>'; ?>
			</p>
		</div>
		
		<?php
		foreach ($arrGrupo as $grupo) {
			//Cuento si hay items dentro de la categoria
			$x_con = 0;
			for ($i = 1; $i <= $_GET['cantPuntos']; $i++) {
				if($grupo['idGrupo']==$rowdata['PuntoidGrupo_'.$i]){
					$x_con++;
				}
			}
					
			//si hay items se muestra todo
			if($x_con!=0){
				//Variable subtotal
				$subto = 0;
				//se arma la ventana
				echo '
				<div class="col-xs-4">
					<p class="lead">'.$grupo['Nombre'].'</p>
					<p class="text-muted well well-sm no-shadow" >';
				
						
				
					
				for ($i = 1; $i <= $_GET['cantPuntos']; $i++) {
					if($grupo['idGrupo']==$rowdata['PuntoidGrupo_'.$i]){
						//sumo subtotales
						$subto = $subto + $rowMuestras['Medida_'.$i];
						//verifico unidad de medida
						$xuni = '';
						foreach ($arrUnidadMedida as $uml) {
							if($rowdata['PuntoUniMed_'.$i]==$uml['idUml']){
								$xuni = ' '.$uml['Nombre'];
							}
						}
								
						//Verifico el tipo de dato
						switch ($rowdata['PuntoidTipo_'.$i]) {
							//Medicion (Decimal) con parametros limitantes
							case 1:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].$xuni.'<br/>';
								break;
							//Medicion (Decimal) sin parametros limitantes
							case 2:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].$xuni.'<br/>';
								break;
							//Medicion (Enteros) con parametros limitantes
							case 3:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].$xuni.'<br/>';
								break;
							//Medicion (Enteros) sin parametros limitantes
							case 4:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].$xuni.'<br/>';
								break;
							//Fecha
							case 5:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.fecha_estandar($rowMuestras['Medida_'.$i]).'<br/>';
								break;
							//Hora
							case 6:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].' hrs.<br/>';
								break;
							//Texto Libre
							case 7:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].'<br/>';
								break;
							//Seleccion 1 a 3
							case 8:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].'<br/>';
								break;
							//Seleccion 1 a 5
							case 9:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].'<br/>';
								break;
							//Seleccion 1 a 10
							case 10:
								echo '<strong>'.$rowdata['PuntoNombre_'.$i].': </strong>'.$rowMuestras['Medida_'.$i].'<br/>';
								break;
								
						}
					}
				}
				//Se muestran los subtotales
				if(isset($grupo['Totales'])&&$grupo['Totales']==1){
					echo '<br/><strong>Total: </strong>'.$subto.$xuni.'<br/>';
				}
				echo '</p>
				</div>';
			}	
		}
		
		//se arma la ventana
		echo '
		<div class="col-xs-4">
			<p class="lead">Decision</p>
			<p class="text-muted well well-sm no-shadow" >';
			//Nota Calidad
			if(isset($rowdata['idNota_1'])&&$rowdata['idNota_1']==1){
				echo '<strong>Nota Calidad: </strong>'.$rowMuestras['Resolucion_1'].'<br/>';
			}
			//Nota Condicion
			if(isset($rowdata['idNota_2'])&&$rowdata['idNota_2']==1){
				echo '<strong>Nota Condicion: </strong>'.$rowMuestras['Resolucion_2'].'<br/>';
			}
			//Calificacion
			if(isset($rowdata['idNota_3'])&&$rowdata['idNota_3']==1){
				echo '<strong>Calificacion: </strong>'.$rowMuestras['Resolucion_3'].'<br/>';
			}
								
		echo '</p>
		</div>';
		
		?>

	</div>
      
</section>		


<div class="clearfix"></div>
	<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="view_cross_quality_calidad_analisis.php?view=<?php echo $_GET['view'];?>"  class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>
		
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  {  
// Se traen todos los datos del analisis
$query = "SELECT 
cross_quality_analisis_calidad.fecha_auto,
cross_quality_analisis_calidad.Creacion_fecha,
cross_quality_analisis_calidad.Temporada,
cross_quality_analisis_calidad.Observaciones,

core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
core_cross_quality_analisis_calidad.Nombre AS TipoAnalisis,
sistema_productos_categorias.Nombre AS ProductoCategoria,
productos_listado.Nombre AS ProductoNombre,
cross_quality_calidad_matriz.cantPuntos AS Producto_cantPuntos,
productos_listado.idCalidad AS Producto_idCalidad,
ubicacion_listado.Nombre AS UbicacionNombre,
ubicacion_listado_level_1.Nombre AS UbicacionNombre_lvl_1,
ubicacion_listado_level_2.Nombre AS UbicacionNombre_lvl_2,
ubicacion_listado_level_3.Nombre AS UbicacionNombre_lvl_3,
ubicacion_listado_level_4.Nombre AS UbicacionNombre_lvl_4,
ubicacion_listado_level_5.Nombre AS UbicacionNombre_lvl_5

FROM `cross_quality_analisis_calidad`
LEFT JOIN `core_sistemas`                          ON core_sistemas.idSistema                      = cross_quality_analisis_calidad.idSistema
LEFT JOIN `usuarios_listado`                       ON usuarios_listado.idUsuario                   = cross_quality_analisis_calidad.idUsuario
LEFT JOIN `core_cross_quality_analisis_calidad`    ON core_cross_quality_analisis_calidad.idTipo   = cross_quality_analisis_calidad.idTipo
LEFT JOIN `sistema_productos_categorias`           ON sistema_productos_categorias.idCategoria     = cross_quality_analisis_calidad.idCategoria
LEFT JOIN `productos_listado`                      ON productos_listado.idProducto                 = cross_quality_analisis_calidad.idProducto
LEFT JOIN `ubicacion_listado`                      ON ubicacion_listado.idUbicacion                = cross_quality_analisis_calidad.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`              ON ubicacion_listado_level_1.idLevel_1          = cross_quality_analisis_calidad.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`              ON ubicacion_listado_level_2.idLevel_2          = cross_quality_analisis_calidad.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`              ON ubicacion_listado_level_3.idLevel_3          = cross_quality_analisis_calidad.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`              ON ubicacion_listado_level_4.idLevel_4          = cross_quality_analisis_calidad.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`              ON ubicacion_listado_level_5.idLevel_5          = cross_quality_analisis_calidad.idUbicacion_lvl_5
LEFT JOIN `cross_quality_calidad_matriz`           ON cross_quality_calidad_matriz.idMatriz        = productos_listado.idCalidad
WHERE cross_quality_analisis_calidad.idAnalisis = {$_GET['view']} ";
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

FROM `cross_quality_analisis_calidad_trabajador` 
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador   = cross_quality_analisis_calidad_trabajador.idTrabajador
WHERE cross_quality_analisis_calidad_trabajador.idAnalisis = {$_GET['view']} ";
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
maquinas_listado.Nombre

FROM `cross_quality_analisis_calidad_maquina` 
LEFT JOIN `maquinas_listado`  ON maquinas_listado.idMaquina   = cross_quality_analisis_calidad_maquina.idMaquina
WHERE cross_quality_analisis_calidad_maquina.idAnalisis = {$_GET['view']} ";
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
cross_quality_analisis_calidad_muestras.idMuestras, 
cross_quality_analisis_calidad_muestras.n_folio_pallet,
cross_quality_analisis_calidad_muestras.lote,
productores_listado.Nombre AS ClienteNombre

FROM `cross_quality_analisis_calidad_muestras` 
LEFT JOIN `productores_listado`  ON productores_listado.idProductor   = cross_quality_analisis_calidad_muestras.idProductor
WHERE cross_quality_analisis_calidad_muestras.idAnalisis = {$_GET['view']} ";
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
/***************************************************/				
// Se trae un listado con todos los archivos
$arrArchivos = array();
$query = "SELECT Nombre

FROM `cross_quality_analisis_calidad_archivo` 
WHERE idAnalisis = {$_GET['view']} ";
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
array_push( $arrArchivos,$row );
}


?>



<section class="invoice">
	
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> <?php echo $row_data['TipoAnalisis']?>.
				<small class="pull-right">Fecha Creacion: <?php echo Fecha_estandar($row_data['fecha_auto'])?></small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">
		
		<?php
		echo '
			<div class="col-sm-4 invoice-col">
				Datos Basicos
				<address>
					<strong>'.$x_column_producto_nombre_sing.'</strong><br>
					'.$row_data['ProductoCategoria'].', '.$row_data['ProductoNombre'].'<br>
					Ubicacion: '.$row_data['UbicacionNombre'];
					if(isset($row_data['UbicacionNombre_lvl_1'])&&$row_data['UbicacionNombre_lvl_1']!=''){echo ' - '.$row_data['UbicacionNombre_lvl_1'];}
					if(isset($row_data['UbicacionNombre_lvl_2'])&&$row_data['UbicacionNombre_lvl_2']!=''){echo ' - '.$row_data['UbicacionNombre_lvl_2'];}
					if(isset($row_data['UbicacionNombre_lvl_3'])&&$row_data['UbicacionNombre_lvl_3']!=''){echo ' - '.$row_data['UbicacionNombre_lvl_3'];}
					if(isset($row_data['UbicacionNombre_lvl_4'])&&$row_data['UbicacionNombre_lvl_4']!=''){echo ' - '.$row_data['UbicacionNombre_lvl_4'];}
					if(isset($row_data['UbicacionNombre_lvl_5'])&&$row_data['UbicacionNombre_lvl_5']!=''){echo ' - '.$row_data['UbicacionNombre_lvl_5'];}
						
					echo '<br>
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
					
			</div>'; ?>
    
	</div>
	
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table">
				<thead>
					<tr>
						<th colspan="6">Detalle</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($arrTrabajadores) { ?>
						<tr class="active"><td colspan="6"><strong>Trabajadores Encargados</strong></td></tr>
						<?php foreach ($arrTrabajadores as $trab) { ?>
							<tr>
								<td><?php echo $trab['Rut'];?></td>
								<td colspan="3"><?php echo $trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat'];?></td>
								<td colspan="2"><?php echo $trab['Cargo'];?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrMaquinas) { ?>
						<tr class="active"><td colspan="6"><strong>Maquinas a Utilizar</strong></td></tr>
						<?php foreach ($arrMaquinas as $maq) { ?>
							<tr>
								<td colspan="6"><?php echo $maq['Nombre'];?></td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php if ($arrMuestras) { ?>
						<tr class="active"><td colspan="6"><strong>Muestras</strong></td></tr>
						<tr class="active">
							<td colspan="2"><strong>Productor</strong></td>
							<td colspan="2"><strong>N° Folio / Pallet</strong></td>
							<td><strong>Lote</strong></td>
							<td></td>
						</tr>
						<?php foreach ($arrMuestras as $muestra) { ?>
							<tr>
								<td colspan="2"><?php echo $muestra['ClienteNombre'];?></td>
								<td colspan="2"><?php echo $muestra['n_folio_pallet'];?></td>
								<td><?php echo $muestra['lote'];?></td>
								<td>
									<div class="btn-group" style="width: 35px;" >
										<a href="<?php echo 'view_cross_quality_calidad_analisis.php?view='.$_GET['view'].'&viewMuestra='.$muestra['idMuestras'].'&cantPuntos='.$row_data['Producto_cantPuntos'].'&idCalidad='.$row_data['Producto_idCalidad']; ?>" title="Ver Informacion" class="btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
									</div>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-xs-12">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" ><?php echo $row_data['Observaciones'];?></p>
		</div>
	</div>
	
	


<?php
	$zz  = '?idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
	$zz .= '&view='.$_GET['view'];
	?>
	<div class="row no-print">
		<div class="col-xs-12">
			<a target="new" href="" class="btn btn-default">
				<i class="fa fa-print"></i> Imprimir
			</a>

			<a target="new" href="" class="btn btn-primary pull-right" style="margin-right: 5px;">
				<i class="fa fa-file-pdf-o"></i> Exportar a PDF
			</a>
		</div>
	</div>
      
</section>

<div class="col-xs-12" style="margin-bottom:15px;">

	<?php if ($arrArchivos){ ?>
		<table id="items" style="margin-bottom: 20px;">
			<tbody>
				<tr>
					<th colspan="6">Archivos Adjuntos</th>
				</tr>		  
				<?php foreach ($arrArchivos as $producto){?>
					<tr class="item-row">
						<td colspan="5"><?php echo $producto['Nombre']; ?></td>
						<td width="160">
							<div class="btn-group" style="width: 70px;" >
								<a href="<?php echo 'view_doc_preview.php?return=true&path=upload&file='.$producto['Nombre']; ?>" title="Ver Documento" class="btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
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

<?php } ?> 
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/lib/screenfull/screenfull.js"></script> 
<script src="<?php echo DB_SITE ?>/LIB_assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo DB_SITE ?>/LIB_assets/js/main.min.js"></script>
	</body>
</html>
