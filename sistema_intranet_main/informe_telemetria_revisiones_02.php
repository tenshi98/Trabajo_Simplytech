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
$original = "informe_telemetria_revisiones_02.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
$location .= "?submit_filter=true";
if(isset($_GET['idSistema']) && $_GET['idSistema'] != ''){        $location .= "&idSistema=".$_GET['idSistema'];        $search .= "&idSistema=".$_GET['idSistema'];}
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){  $location .= "&idTelemetria=".$_GET['idTelemetria'];  $search .= "&idTelemetria=".$_GET['idTelemetria'];}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) { 
 
//variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){       $z.=" AND telemetria_listado.idTelemetria =".$_GET['idTelemetria'];}


//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresMedErrores_'.$i;
	$subquery .= ',SensoresErrorActual_'.$i;
	$subquery .= ',SensoresActivo_'.$i;
}
//Listar los equipos
$arrEquipos = array();
$query = "SELECT
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea,
core_sistemas.Nombre AS Sistema
".$subquery."
			
FROM `telemetria_listado`
LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema
".$z."
ORDER BY core_sistemas.Nombre ASC, telemetria_listado.Nombre ASC  ";
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

?>
	

	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Estado Equipo</h5>	
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Sistema</th>
								<th>Nombre</th>
								<th>Ultima Actualizacion</th>
								<th>Estado</th>
								<th width="10">Acciones</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php 
							foreach ($arrEquipos as $equip) {
								//Se resetean
								$eq_alertas     = 0; 
								$eq_fueralinea  = 0; 
								$eq_fueraruta   = 0;
								$eq_detenidos   = 0;
								$xx = 0;
								$xy = 0;
								$xz = 0;
								$xw = 0;
								$dataex = '';
											
								$eq_ok = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check" aria-hidden="true"></i></a>';
								for ($i = 1; $i <= $equip['cantSensores']; $i++) {
									//solo sensores activos
									if(isset($equip['SensoresActivo_'.$i])&&$equip['SensoresActivo_'.$i]==1){
										$xx = $equip['SensoresMedErrores_'.$i] - $equip['SensoresErrorActual_'.$i];
										if($xx<0){$xy = 1;$eq_ok = '';}
									}
								}
								$eq_alertas = $eq_alertas + $xy;
											
								//Fuera de linea
								$diaInicio   = $equip['LastUpdateFecha'];
								$diaTermino  = $FechaSistema;
								$tiempo1     = $equip['LastUpdateHora'];
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
								if($Tiempo>$equip['TiempoFueraLinea']&&$equip['TiempoFueraLinea']!='00:00:00'){
									$eq_fueralinea = $eq_fueralinea + 1;	
									$eq_ok = '';
								}		
								//equipos ok
								if($eq_alertas>0){$eq_ok = '';$xw = 1;$dataex .= '<a href="#" title="Con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>';}
								if($eq_fueralinea>0){$eq_ok = '';$xz = 1;$dataex .= '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken" aria-hidden="true"></i></a>';}
											
								$eq_ok .= $dataex;
								
								if($xz!=0){
									$danger = 'danger';
								}elseif($xw!=0){
									$danger = 'warning';
								}else{
									$danger = '';
								}	
								?>
								
										
								
								<tr class="odd <?php echo $danger ?>">		
									<td><?php echo $equip['Sistema'] ?></td>	
									<td><?php echo $equip['Nombre'] ?></td>	
									<td><?php echo fecha_estandar($equip['LastUpdateFecha']).' a las '.$equip['LastUpdateHora'].' hrs'; ?></td>	
									<td><div class="btn-group" ><?php echo $eq_ok ?></div></td>			
									<td>
										<div class="btn-group" style="width: 105px;" >
											<a href="<?php echo 'telemetria_gestion_equipos_view_equipo_admin.php?view='.simpleEncode($equip['idTelemetria'], fecha_actual()) ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>
											<a href="<?php echo 'telemetria_gestion_equipos_view_equipo_uso_admin.php?view='.simpleEncode($equip['idTelemetria'], fecha_actual()) ?>" title="Ver Uso" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-wrench" aria-hidden="true"></i></a>
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

<?php widget_modal(80, 95); ?>


<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Filtro de busqueda
$w  = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];   //Sistema
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$w .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
 
 ?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
			
				<?php 
				//Se verifican si existen los datos
				if(isset($idSistema)) {     $x1 = $idSistema;      }else{$x1 = '';}
				if(isset($idTelemetria)) {  $x2  = $idTelemetria;  }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select_filter('Sistema','idSistema', $x1, 1, 'idSistema', 'Nombre', 'core_sistemas', 0, '', $dbConn);
				$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x2, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				
				
				$Form_Inputs->form_input_hidden('pagina', 1, 2);
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
