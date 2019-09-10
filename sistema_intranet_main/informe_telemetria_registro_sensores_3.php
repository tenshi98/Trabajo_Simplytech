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
$original = "informe_telemetria_registro_sensores_3.php";
$location = $original;
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

             
  
/*********************************************************************************/
//Verifico si se selecciono el equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	//Se traen todos los registros
	$query = "SELECT 
	telemetria_listado.Nombre,
	COUNT(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla) AS Total
	FROM `telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
	LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
	WHERE (telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."') ";
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
	$row_data = mysqli_fetch_assoc ($resultado);
	/*****************************************/
	//Se escribe el dato
	echo '
	<div class="alert alert-success" role="alert">
		Total de registros encontrados de '.$row_data['Nombre'].': '.Cantidades($row_data['Total'], 0).'			
	</div>';

	$total_files = ceil($row_data['Total']/5000);
	for ($i = 1; $i <= $total_files; $i++) { 
		$reg_ini = (5000*$i)-4999;
		$reg_fin = 5000*$i;
		$datosx  = '?idTelemetria='.$_GET['idTelemetria'];
		$datosx .= '&f_inicio='.$_GET['f_inicio'];
		$datosx .= '&f_termino='.$_GET['f_termino'];
		$datosx .= '&num='.$i;
		echo '
		<div class="alert alert-info" role="alert">
			<span class="fleft">Exportar archivo '.$i.' registros del '.Cantidades($reg_ini, 0).' al '.Cantidades($reg_fin, 0).'</span>
			<a target="new" href="informe_telemetria_registro_sensores_3_to_excel.php'.$datosx.'" class="btn btn-sm btn-metis-2 fright "><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
			<div class="clearfix"></div>			
		</div>';  
	}
//Si no se slecciono se traen todos los equipos a los cuales tiene permiso	
}else{
	//Inicia variable
	$z="WHERE telemetria_listado.idTelemetria>0"; 
	$z.=" AND telemetria_listado.id_Geo='1'";
	$datosx  = '?f_inicio='.$_GET['f_inicio'];
	$datosx .= '&f_termino='.$_GET['f_termino'];
	$datosx .= '&idTipoUsuario='.$_SESSION['usuario']['basic_data']['idTipoUsuario'];

	//Verifico el tipo de usuario que esta ingresando
	if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
		$z.=" AND telemetria_listado.idSistema>=0";
		$join = "";	
	}else{
		$z.=" AND telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";
		$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado.idTelemetria ";
		$z.=" AND usuarios_equipos_telemetria.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";
		$datosx .= '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
		$datosx .= '&idUsuario='.$_SESSION['usuario']['basic_data']['idUsuario'];	
	}
	
	/*********************************************/
	// Se trae un listado con todos los usuarios
	$arrEquipos = array();
	$query = "SELECT 
	telemetria_listado.idTelemetria, 
	telemetria_listado.Nombre
	FROM `telemetria_listado`
	".$join."  ".$z."
	ORDER BY idTelemetria ASC ";
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
	array_push( $arrEquipos,$row );
	}
	

	
	/*********************************************/
	$s_max = 0;
	echo '<div class="alert alert-success" role="alert">';
	foreach ($arrEquipos as $equipo) {
		//Se traen todos los registros
		$query = "SELECT 
		COUNT(idTabla) AS Total
		FROM `telemetria_listado_tablarelacionada_".$equipo['idTelemetria']."`
		WHERE (FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."') ";
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
		$row_data = mysqli_fetch_assoc ($resultado);

		echo 'Total de registros encontrados de '.$equipo['Nombre'].': '.Cantidades($row_data['Total'], 0).'<br/>';
		//verifico el valor maximo
		if($s_max<$row_data['Total']){
			$s_max=$row_data['Total'];
		}
	}
	echo '</div>';
	
	
	/*****************************************/
	//Se escribe el dato
	$total_files = ceil($s_max/5000);
	for ($i = 1; $i <= $total_files; $i++) { 
		$reg_ini = (5000*$i)-4999;
		$reg_fin = 5000*$i;
		
		$datosx .= '&num='.$i;
		echo '
		<div class="alert alert-info" role="alert">
			<span class="fleft">Exportar archivo '.$i.' registros del '.Cantidades($reg_ini, 0).' al '.Cantidades($reg_fin, 0).'</span>
			<a target="new" href="informe_telemetria_registro_sensores_3_to_excel.php'.$datosx.'" class="btn btn-sm btn-metis-2 fright "><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
			<div class="clearfix"></div>			
		</div>';  
	}

}
?>	






<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$z = "telemetria_listado.idSistema>=0 AND telemetria_listado.id_Geo='1'";
}else{
	$z = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} AND telemetria_listado.id_Geo='1'";		
}
 ?>			
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Filtro de busqueda</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
               
				<?php 
				//Se verifican si existen los datos
				if(isset($f_inicio)) {      $x1  = $f_inicio;     }else{$x1  = '';}
				if(isset($f_termino)) {     $x2  = $f_termino;    }else{$x2  = '';}
				if(isset($idTelemetria)) {  $x3  = $idTelemetria; }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_date('Fecha Inicio','f_inicio', $x1, 2);
				$Form_Imputs->form_date('Fecha Termino','f_termino', $x2, 2);
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x3, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x3, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				?>        
	   
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter">	
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
