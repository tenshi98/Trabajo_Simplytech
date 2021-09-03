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
$SIS_where = "telemetria_listado.idEstado = 1 ";//solo equipos activos
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){ $SIS_where.=" AND telemetria_listado.idTelemetria =".$_GET['idTelemetria'];}

//Se consultan datos
$SIS_query = '
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NErrores,
core_sistemas.Nombre AS Sistema';
$SIS_join = 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema';
$SIS_order = 'core_sistemas.Nombre ASC, telemetria_listado.Nombre ASC';
$arrEquipos = array();
$arrEquipos = db_select_array (false, $SIS_query, 'telemetria_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrEquipos');

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
								
							/**********************************************/
							//Se resetean
							$in_eq_alertas     = 0;
							$in_eq_fueralinea  = 0;
																	
							/**********************************************/
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
								$in_eq_fueralinea++;
							}
								
							/**********************************************/
							//NErrores
							if(isset($equip['NErrores'])&&$equip['NErrores']>0){ $in_eq_alertas++; }
										
							/*******************************************************/
							//rearmo
							if($in_eq_alertas>0){    
								$danger = 'warning';
								$eq_ok  = '<a href="#" title="Con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>';
							}elseif($in_eq_fueralinea>0){ 
								$danger = 'danger';
								$eq_ok  = '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken" aria-hidden="true"></i></a>';
							}else{
								$danger = '';
								$eq_ok  = '<a href="#" title="Sin Problemas" class="btn btn-success btn-sm tooltip"><i class="fa fa-check" aria-hidden="true"></i></a>';
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
