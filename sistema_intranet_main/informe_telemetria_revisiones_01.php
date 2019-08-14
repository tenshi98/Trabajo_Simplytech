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
$original = "informe_telemetria_revisiones_01.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
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

             
  

$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();

/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTelemetria']) && $_GET['idTelemetria'] != ''){       $z.=" AND telemetria_listado.idTelemetria =".$_GET['idTelemetria'];}

//Listar los equipos
$query = "SELECT
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
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
SensoresActivo_46, SensoresActivo_47, SensoresActivo_48, SensoresActivo_49, SensoresActivo_50

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
$rowEquipo = mysqli_fetch_assoc ($resultado);

?>
	

	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<header>
					<div class="icons"><i class="fa fa-table"></i></div><h5>Estado Equipo</h5>	
				</header>
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th>Nombre</th>
								<th>Fecha - Hora</th>
								<th>Estado</th>
								<th width="10">Acciones</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php 
						
							
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
											
								$eq_ok = '<a href="#" title="Sin Problemas" class="iframe btn btn-success btn-sm tooltip"><i class="fa fa-check"></i></a>';
								for ($i = 1; $i <= $rowEquipo['cantSensores']; $i++) {
									//solo sensores activos
									if(isset($rowEquipo['SensoresActivo_'.$i])&&$rowEquipo['SensoresActivo_'.$i]==1){
										$xx = $rowEquipo['SensoresMedErrores_'.$i] - $rowEquipo['SensoresErrorActual_'.$i];
										if($xx<0){$xy = 1;$eq_ok = '';}
									}
								}
								$eq_alertas = $eq_alertas + $xy;
											
								//Fuera de linea
								$diaInicio   = fecha_estandar($rowEquipo['LastUpdateFecha']);
								$diaTermino  = $FechaSistema;
								$tiempo1     = $rowEquipo['LastUpdateHora'];
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
								if($Tiempo>$rowEquipo['TiempoFueraLinea']&&$rowEquipo['TiempoFueraLinea']!='00:00:00'){
									$eq_fueralinea = $eq_fueralinea + 1;	
									$eq_ok = '';
								}
											
											
											
								//equipos ok
								if($eq_alertas>0){$eq_ok = '';$xw = 1;$dataex .= '<a href="#" title="Con Alertas" class="btn btn-warning btn-sm tooltip"><i class="fa fa-exclamation-triangle"></i></a>';}
								if($eq_fueralinea>0){$eq_ok = '';$xz = 1;$dataex .= '<a href="#" title="Fuera de Linea" class="btn btn-danger btn-sm tooltip"><i class="fa fa-chain-broken"></i></a>';}
											
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
								<td><?php echo $rowEquipo['Nombre'] ?></td>	
								<td><?php echo fecha_estandar($rowEquipo['LastUpdateFecha']).' a las '.$rowEquipo['LastUpdateHora'].' hrs'; ?></td>	
								<td><div class="btn-group" ><?php echo $eq_ok ?></div></td>			
								<td>
									<div class="btn-group" style="width: 70px;" >
										<a href="telemetria_gestion_equipos_view_equipo.php?view=<?php echo $rowEquipo['idTelemetria'] ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>
										<a href="telemetria_gestion_equipos_view_equipo_uso.php?view=<?php echo $rowEquipo['idTelemetria'] ?>" title="Ver Uso" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-wrench"></i></a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>	
			</div>	
		</div>
	</div>

<?php require_once '../LIBS_js/modal/modal.php';?>


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
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Imputs->form_select_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
				}else{
					$Form_Imputs->form_select_join_filter('Equipo','idTelemetria', $x1, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $w, $dbConn);
				}
				
				$Form_Imputs->form_input_hidden('pagina', 1, 2);
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
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
