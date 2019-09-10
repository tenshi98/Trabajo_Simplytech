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
$original = "informe_telemetria_uso_02.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){  $location .= "&idTelemetria=".$_GET['idTelemetria'];  $search .= "&idTelemetria=".$_GET['idTelemetria'];}
if(isset($_GET['F_inicio']) && $_GET['F_inicio'] != ''){          $location .= "&F_inicio=".$_GET['F_inicio'];          $search .= "&F_inicio=".$_GET['F_inicio'];}
if(isset($_GET['H_inicio']) && $_GET['H_inicio'] != ''){          $location .= "&H_inicio=".$_GET['H_inicio'];          $search .= "&H_inicio=".$_GET['H_inicio'];}
if(isset($_GET['F_termino']) && $_GET['F_termino'] != ''){        $location .= "&F_termino=".$_GET['F_termino'];        $search .= "&F_termino=".$_GET['F_termino'];}
if(isset($_GET['H_termino']) && $_GET['H_termino'] != ''){        $location .= "&H_termino=".$_GET['H_termino'];        $search .= "&H_termino=".$_GET['H_termino'];}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
//Se traen todos los grupos
$arrGruposRev = array();
$query = "SELECT idGrupo, Nombre
FROM `telemetria_listado_grupos_uso`
WHERE idSupervisado=1
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
array_push( $arrGruposRev,$row );
}
/**********************************************************/
// tomo los datos del usuario
$query = "SELECT Nombre,

SensoresRevisionGrupo_1, SensoresRevisionGrupo_2, SensoresRevisionGrupo_3, SensoresRevisionGrupo_4, SensoresRevisionGrupo_5, 
SensoresRevisionGrupo_6, SensoresRevisionGrupo_7, SensoresRevisionGrupo_8, SensoresRevisionGrupo_9, SensoresRevisionGrupo_10, 
SensoresRevisionGrupo_11, SensoresRevisionGrupo_12, SensoresRevisionGrupo_13, SensoresRevisionGrupo_14, SensoresRevisionGrupo_15, 
SensoresRevisionGrupo_16, SensoresRevisionGrupo_17, SensoresRevisionGrupo_18, SensoresRevisionGrupo_19, SensoresRevisionGrupo_20, 
SensoresRevisionGrupo_21, SensoresRevisionGrupo_22, SensoresRevisionGrupo_23, SensoresRevisionGrupo_24, SensoresRevisionGrupo_25, 
SensoresRevisionGrupo_26, SensoresRevisionGrupo_27, SensoresRevisionGrupo_28, SensoresRevisionGrupo_29, SensoresRevisionGrupo_30, 
SensoresRevisionGrupo_31, SensoresRevisionGrupo_32, SensoresRevisionGrupo_33, SensoresRevisionGrupo_34, SensoresRevisionGrupo_35, 
SensoresRevisionGrupo_36, SensoresRevisionGrupo_37, SensoresRevisionGrupo_38, SensoresRevisionGrupo_39, SensoresRevisionGrupo_40, 
SensoresRevisionGrupo_41, SensoresRevisionGrupo_42, SensoresRevisionGrupo_43, SensoresRevisionGrupo_44, SensoresRevisionGrupo_45, 
SensoresRevisionGrupo_46, SensoresRevisionGrupo_47, SensoresRevisionGrupo_48, SensoresRevisionGrupo_49, SensoresRevisionGrupo_50

FROM `telemetria_listado`
WHERE idTelemetria = {$_GET['idTelemetria']}";
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
/**********************************************************/
//Se crean las columnas
$arrColumnas = array(); 
for ($i = 1; $i <= 50; $i++) {
	if(isset($rowdata['SensoresRevisionGrupo_'.$i])&&$rowdata['SensoresRevisionGrupo_'.$i]!=0){
		$arrColumnas[$rowdata['SensoresRevisionGrupo_'.$i]]['idGrupo'] = $rowdata['SensoresRevisionGrupo_'.$i];
	}
}
foreach ($arrGruposRev as $sen) { 
	if(isset($arrColumnas[$sen['idGrupo']]['idGrupo'])&&$arrColumnas[$sen['idGrupo']]['idGrupo']!=''){
		$arrColumnas[$sen['idGrupo']]['Nombre'] = $sen['Nombre'];
	}
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_listado_historial_uso.idUso!=0";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){       $z.=" AND telemetria_listado_historial_uso.idTelemetria =".$_GET['idTelemetria'];}
if(isset($_GET['F_inicio']) && $_GET['F_inicio'] != ''&&isset($_GET['F_termino']) && $_GET['F_termino'] != ''){ 
	$z.=" AND telemetria_listado_historial_uso.Fecha BETWEEN '{$_GET['F_inicio']}' AND '{$_GET['F_termino']}'";
}
/**********************************************************/
//se consulta
$arrConsulta = array(); 
$query = "SELECT Fecha,

Horas_1, Horas_2, Horas_3, Horas_4, Horas_5, 
Horas_6, Horas_7, Horas_8, Horas_9, Horas_10, 
Horas_11, Horas_12, Horas_13, Horas_14, Horas_15, 
Horas_16, Horas_17, Horas_18, Horas_19, Horas_20, 
Horas_21, Horas_22, Horas_23, Horas_24, Horas_25, 
Horas_26, Horas_27, Horas_28, Horas_29, Horas_30, 
Horas_31, Horas_32, Horas_33, Horas_34, Horas_35, 
Horas_36, Horas_37, Horas_38, Horas_39, Horas_40, 
Horas_41, Horas_42, Horas_43, Horas_44, Horas_45, 
Horas_46, Horas_47, Horas_48, Horas_49, Horas_50

FROM `telemetria_listado_historial_uso`
".$z."
ORDER BY telemetria_listado_historial_uso.Fecha ASC
";
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
array_push( $arrConsulta,$row );
}
?>



<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5><?php echo $rowdata['Nombre']; ?></h5>
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th width="120">Fecha</th>
						<?php foreach ($arrColumnas as $col) { 
							echo '<th>'.$col['Nombre'].'</th>';
						} ?>
						
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					//variables
					$arrSuma = array(); 
					//recorrio
					foreach ($arrConsulta as $con) { ?> 
						<tr class="odd">
							<td><?php echo fecha_estandar($con['Fecha']); ?></td>
							<?php foreach ($arrColumnas as $col) { 
								echo '<td>'.gmdate("H:i:s", $con['Horas_'.$col['idGrupo']]).'</td>';
								$arrSuma[$col['idGrupo']] = $arrSuma[$col['idGrupo']] + $con['Horas_'.$col['idGrupo']];
							} ?>
						</tr>
					<?php } ?> 
					<tr class="odd">
						<td><strong>Total</strong></td>
						<?php 
						foreach ($arrColumnas as $col) { 
								echo '<td><strong>'.segundos2horas($arrSuma[$col['idGrupo']]).'</strong></td>';
						} ?>
					</tr>
					                   
				</tbody>
			</table>
		</div>
	</div>
</div>

	
	


<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
	$w = "telemetria_listado.idSistema>=0";
}else{
	$w = "telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']} AND usuarios_equipos_telemetria.idUsuario = {$_SESSION['usuario']['basic_data']['idUsuario']} ";		
}
 
 ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idTelemetria)) {  $x1  = $idTelemetria;  }else{$x1  = '';}
				if(isset($F_inicio)) {      $x2  = $F_inicio;      }else{$x2  = '';}
				if(isset($F_termino)) {     $x3  = $F_termino;     }else{$x3  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				$Form_Imputs->form_date('Fecha Inicio','F_inicio', $x2, 2);
				$Form_Imputs->form_date('Fecha Termino','F_termino', $x3, 2);
				
				$Form_Imputs->form_input_hidden('pagina', 1, 2);
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
