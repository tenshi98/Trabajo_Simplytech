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
//se traen los datos basicos de la licitacion
$query = "SELECT 
ubicacion_listado.Nombre, 
core_estados.Nombre AS Estado
FROM `ubicacion_listado`
LEFT JOIN `core_estados`    ON core_estados.idEstado    = ubicacion_listado.idEstado
WHERE ubicacion_listado.idUbicacion=".$X_Puntero;
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


//Se crean las variables
$nmax = 5;
$z = '';
$leftjoin = '';
$orderby = '';
for ($i = 1; $i <= $nmax; $i++) {
    //consulta
    $z .= ',ubicacion_listado_level_'.$i.'.idLevel_'.$i.' AS LVL_'.$i.'_id';
    $z .= ',ubicacion_listado_level_'.$i.'.Nombre AS LVL_'.$i.'_Nombre';
    //Joins
    $xx = $i + 1;
    if($xx<=$nmax){
		$leftjoin .= ' LEFT JOIN `ubicacion_listado_level_'.$xx.'`   ON ubicacion_listado_level_'.$xx.'.idLevel_'.$i.'    = ubicacion_listado_level_'.$i.'.idLevel_'.$i;
    }
    //ORDER BY
    $orderby .= ', ubicacion_listado_level_'.$i.'.Nombre ASC';
}

//se hace la consulta
$arrLicitacion = array();
$query = "SELECT
ubicacion_listado_level_1.idLevel_1 AS bla
".$z."
FROM `ubicacion_listado_level_1`
".$leftjoin."
WHERE ubicacion_listado_level_1.idUbicacion=".$X_Puntero."
ORDER BY ubicacion_listado_level_1.Nombre ASC ".$orderby."

";
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Ver Datos de la Ubicacion</h5>	
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
								<td colspan="2" style="background-color: #ccc;">Itemizado</td>
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
