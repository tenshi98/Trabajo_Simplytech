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
//Cargamos la ubicacion original
$original = "informe_cross_weather_telemetria_uso_01.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria']!=''){  $location .= "&idTelemetria=".$_GET['idTelemetria'];  $search .= "&idTelemetria=".$_GET['idTelemetria'];}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['submit_filter'])){
// consulto los datos
$rowdata = db_select_data (false, 'Nombre,cantSensores, Direccion_img', 'telemetria_listado', '', 'idTelemetria ='.$_GET['idTelemetria'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Se arma la consulta
$aa = '';
for ($i = 1; $i <= $rowdata['cantSensores']; $i++) { 
	$aa .= ',SensoresNombre_'.$i;
	$aa .= ',SensoresUso_'.$i;
	$aa .= ',SensoresFechaUso_'.$i;
	$aa .= ',SensoresAccionC_'.$i;
	$aa .= ',SensoresAccionT_'.$i;
	$aa .= ',SensoresAccionMedC_'.$i;
	$aa .= ',SensoresAccionMedT_'.$i;
	$aa .= ',SensoresAccionAlerta_'.$i;
}
// consulto los datos
$rowMed = db_select_data (false, 'Nombre'.$aa, 'telemetria_listado', '', 'idTelemetria ='.$_GET['idTelemetria'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowMed');

//Cuento si hay sensores activos
$rowcount = 0;
for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
	if(isset($rowMed['SensoresUso_'.$i])&&$rowMed['SensoresUso_'.$i]==1){
		$rowcount++;
	}
}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Uso del Equipo');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Sensores Supervisados</h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Nombre</th>
						<th>Fecha</th>
						<th>Ciclos Limite</th>
						<th>Ciclos Actuales</th>
						<th>% Cumplimiento</th>
						<th>Horas limite</th>
						<th>Horas Actuales</th>
						<th>% Cumplimiento</th>
						<th>% Alerta</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php 
					if(isset($rowcount)&&$rowcount!=0){
						for ($i = 1; $i <= $rowdata['cantSensores']; $i++) {
							//Se verifica si el sensor esta habilitado para la supervision
							if(isset($rowMed['SensoresUso_'.$i])&&$rowMed['SensoresUso_'.$i]==1){ ?>
								<tr class="odd">
									<td><?php echo $rowMed['SensoresNombre_'.$i]; ?></td>
									<td><?php echo fecha_estandar($rowMed['SensoresFechaUso_'.$i]); ?></td>
									<td><?php echo Cantidades($rowMed['SensoresAccionC_'.$i], 2);?></td>	
									<td><?php echo Cantidades($rowMed['SensoresAccionMedC_'.$i], 2);?></td>	
									<td><?php if(isset($rowMed['SensoresAccionC_'.$i])&&$rowMed['SensoresAccionC_'.$i]!=0){echo porcentaje($rowMed['SensoresAccionMedC_'.$i]/$rowMed['SensoresAccionC_'.$i]);} ?></td>
									<td><?php echo Cantidades($rowMed['SensoresAccionT_'.$i]/3600, 2);?></td>	
									<td><?php echo Cantidades($rowMed['SensoresAccionMedT_'.$i]/3600, 2);?></td>	
									<td><?php if(isset($rowMed['SensoresAccionT_'.$i])&&$rowMed['SensoresAccionT_'.$i]!=0){echo porcentaje($rowMed['SensoresAccionMedT_'.$i]/$rowMed['SensoresAccionT_'.$i]);} ?></td>
									<td><?php echo Cantidades($rowMed['SensoresAccionAlerta_'.$i], 2);?></td>	
								</tr>
							<?php 	
							}
						}
					} ?>        
				</tbody>
			</table>
		</div>
	</div>
</div>

	
	


<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
//Filtro de busqueda
$w  = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];   //Sistema
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$w .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];
}
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$w .= " AND telemetria_listado.idTab=4";//CrossWeather			
}
?>
<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>

				<?php
				//Se verifican si existen los datos
				if(isset($idTelemetria)){  $x1  = $idTelemetria;  }else{$x1  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				
				$Form_Inputs->form_input_hidden('pagina', 1, 2);
				?>
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="submit_filter">
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
