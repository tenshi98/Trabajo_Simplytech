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


//se traen los datos basicos de la licitacion
$query = "SELECT 
centrocosto_listado.Nombre, 
core_estados.Nombre AS Estado
FROM `centrocosto_listado`
LEFT JOIN `core_estados`    ON core_estados.idEstado    = centrocosto_listado.idEstado
WHERE centrocosto_listado.idCentroCosto={$_GET['view']} ";
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


//Se crean las variables
$nmax = 5;
$z = '';
$leftjoin = '';
$orderby = '';
for ($i = 1; $i <= $nmax; $i++) {
    //consulta
    $z .= ',centrocosto_listado_level_'.$i.'.idLevel_'.$i.' AS LVL_'.$i.'_id';
    $z .= ',centrocosto_listado_level_'.$i.'.Nombre AS LVL_'.$i.'_Nombre';
    //Joins
    $xx = $i + 1;
    if($xx<=$nmax){
		$leftjoin .= ' LEFT JOIN `centrocosto_listado_level_'.$xx.'`   ON centrocosto_listado_level_'.$xx.'.idLevel_'.$i.'    = centrocosto_listado_level_'.$i.'.idLevel_'.$i;
    }
    //ORDER BY
    $orderby .= ', centrocosto_listado_level_'.$i.'.Nombre ASC';
}

//se hace la consulta
$arrLicitacion = array();
$query = "SELECT
centrocosto_listado_level_1.idLevel_1 AS bla
".$z."
FROM `centrocosto_listado_level_1`
".$leftjoin."
WHERE centrocosto_listado_level_1.idCentroCosto={$_GET['view']}
ORDER BY centrocosto_listado_level_1.Nombre ASC ".$orderby."

";
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
array_push( $arrLicitacion,$row );
}


	


$array3d = array();
foreach($arrLicitacion as $key) {
	
	//Creo Variables para la rejilla
	for ($i = 1; $i <= $nmax; $i++) {
		$d[$i]  = $key['LVL_'.$i.'_id'];   
		$n[$i]  = $key['LVL_'.$i.'_Nombre'];   
	}

    if( $d['1']!=''){
		$array3d[$d['1']]['id']     = $d['1'];
		$array3d[$d['1']]['Nombre'] = $n['1'];
	}
	if( $d['2']!=''){
		$array3d[$d['1']][$d['2']]['id']     = $d['2'];
		$array3d[$d['1']][$d['2']]['Nombre'] = $n['2'];
	}
	if( $d['3']!=''){
		$array3d[$d['1']][$d['2']][$d['3']]['id']     = $d['3'];
		$array3d[$d['1']][$d['2']][$d['3']]['Nombre'] = $n['3'];
	}
	if( $d['4']!=''){
		$array3d[$d['1']][$d['2']][$d['3']][$d['4']]['id']     = $d['4'];
		$array3d[$d['1']][$d['2']][$d['3']][$d['4']]['Nombre'] = $n['4'];
	}
	if( $d['5']!=''){
		$array3d[$d['1']][$d['2']][$d['3']][$d['4']][$d['5']]['id']     = $d['5'];
		$array3d[$d['1']][$d['2']][$d['3']][$d['4']][$d['5']]['Nombre'] = $n['5'];
	}
	
	
}







function arrayToUL(array $array, $lv, $nmax)
{
	$lv++;
	if($lv==1){
		echo '<ul class="tree">';
	}else{
		echo '<ul style="padding-left: 20px;">';
	}
    
    foreach ($array as $key => $value){
		
		
        if (isset($value['Nombre'])) {
			echo '<li><div class="blum">';
			echo '<div class="pull-left">'.$value['Nombre'].'</div>';
			
			echo '<div class="clearfix"></div>';
			echo '</div>';
		}
        if (!empty($value) && is_array($value)){
			
            echo arrayToUL($value, $lv, $nmax);
        }
        echo '</li>';
    }
    echo '</ul>';
}


?>





<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Ver Datos de Centro de Costo</h5>	
		</header>
		<div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<table id="dataTable" class="table table-bordered table-condensed dataTable">
										  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
		
							<tr class="odd">
								<td>Nombre</td>
								<td><?php echo $rowdata['Nombre'];?></td>
							</tr>
							<tr class="odd">
								<td>Estado</td>
								<td><?php echo $rowdata['Estado'];?></td>
							</tr>
							<tr>
								<td colspan="2" style="background-color: #ccc;">Centro de Costo</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="clearfix"></div>  	

									<?php //Se imprime el arbol
									echo arrayToUL($array3d, 0, $nmax);
									?>
								</td>
							</tr>
						</tbody>
					</table>
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



		
	</body>
</html>
