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
/*                                                      Consulta                                                                  */
/**********************************************************************************************************************************/
//variables
$HoraSistema    = hora_actual(); 
$FechaSistema   = fecha_actual();

//Variable
$SIS_where  = "WHERE telemetria_listado.idEstado = 1 ";//solo equipos activos
$SIS_where .= " AND telemetria_listado.id_Geo = 2";//solo los equipos que tengan el seguimiento desactivado
//verifico que sea un administrador
$SIS_where .= " AND telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
if (isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$SIS_where .= " AND telemetria_listado.idTelemetria=".$_GET['idTelemetria'];
}

//numero sensores equipo
$N_Maximo_Sensores = 72;
$subquery = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
	$subquery .= ',SensoresNombre_'.$i;
	$subquery .= ',SensoresMedActual_'.$i;
	$subquery .= ',SensoresGrupo_'.$i;
	$subquery .= ',SensoresUniMed_'.$i;
	$subquery .= ',SensoresErrorActual_'.$i;
}	

//Se consultan datos
$SIS_query = '
telemetria_listado.GeoLatitud, 
telemetria_listado.GeoLongitud,
telemetria_listado.idTelemetria,
telemetria_listado.Nombre,
telemetria_listado.Direccion_img,
telemetria_listado.LastUpdateHora,
telemetria_listado.LastUpdateFecha, 
telemetria_listado.cantSensores,
telemetria_listado.TiempoFueraLinea,
telemetria_listado.NErrores,
core_sistemas.idOpcionesGen_3'.$subquery;
$SIS_join  = 'LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = telemetria_listado.idSistema';
$rowDatos = db_select_data (false, $SIS_query, 'core_sistemas', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowDatos');

//Se consultan datos
$arrUnimed = array();
$arrUnimed = db_select_array (false, 'idUniMed,Nombre', 'telemetria_listado_unidad_medida', '', '', 'idUniMed ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUnimed');

//Se consultan datos
$arrGrupos = array();
$arrGrupos = db_select_array (false, 'idGrupo,Nombre', 'telemetria_listado_grupos', '', '', 'idGrupo ASC', $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUnimed');

//Guardo los datos en un arreglo
$arrFinalUnimed = array();
foreach ($arrUnimed as $sen) {
	$arrFinalUnimed[$sen['idUniMed']] = $sen['Nombre'];
}

//Guardo los datos en un arreglo
$arrFinalGrupos = array();
foreach ($arrGrupos as $sen) {
	$arrFinalGrupos[$sen['idGrupo']] = $sen['Nombre'];
}
?>

<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
	<thead>
		<tr role="row">
			<th>Nombre</th>
			<th width="80">Estado</th>
			<th width="80">Acciones</th>
		</tr>
	</thead>
	<tbody role="alert" aria-live="polite" aria-relevant="all">
		<?php 
		/**********************************************/
		//Se resetean
		$in_eq_alertas     = 0;
		$in_eq_fueralinea  = 0;
																		
		/**********************************************/
		//Fuera de linea
		$diaInicio   = $rowDatos['LastUpdateFecha'];
		$diaTermino  = $FechaSistema;
		$tiempo1     = $rowDatos['LastUpdateHora'];
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
		if($Tiempo>$rowDatos['TiempoFueraLinea']&&$rowDatos['TiempoFueraLinea']!='00:00:00'){	
			$in_eq_fueralinea++;
		}
									
		/**********************************************/
		//NErrores
		if(isset($rowDatos['NErrores'])&&$rowDatos['NErrores']>0){ $in_eq_alertas++; }
											
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
		
		<tr class="odd <?php echo $danger; ?>">		
			<td><?php echo $rowDatos['Nombre']; ?></td>		
			<td><div class="btn-group" ><?php echo $eq_ok; ?></div></td>			
			<td>
				<div class="btn-group" style="width: 35px;" >
					<a href="<?php echo 'telemetria_gestion_equipos_view_equipo.php?view='.simpleEncode($rowDatos['idTelemetria'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a>						
				</div>
			</td>
		</tr>
		<tr class="odd" style="background-color: #CCCCCC;">		
			<td>Grupo</td>		
			<td colspan="2">Mediciones</td>			
		</tr>
		
		<?php
		$arrGruposTitulo = array();
		$n_sensores = 0;
		$sensor = 0;
		for ($i = 1; $i <= $rowDatos['cantSensores']; $i++) {
			//Unidad medida
			$unimed = ' '.$arrFinalUnimed[$rowDatos['SensoresUniMed_'.$i]];
			//Titulo del cuadro
			$Titulo = $arrFinalGrupos[$rowDatos['SensoresGrupo_'.$i]];
			//Verifico que no sea el mismo sensor
			if(isset($rowDatos['SensoresMedActual_'.$i])&&$rowDatos['SensoresMedActual_'.$i]<99900){$xdata=Cantidades_decimales_justos($rowDatos['SensoresMedActual_'.$i]).$unimed;}else{$xdata='Sin Datos';}
			if($rowDatos['SensoresErrorActual_'.$i]> 0){
				$arrGruposTitulo[$Titulo][$i]['Descripcion'] = '<span style="color:red;">'.$rowDatos['SensoresNombre_'.$i].' : '.$xdata.'</span>';
			}else{
				$arrGruposTitulo[$Titulo][$i]['Descripcion'] = $rowDatos['SensoresNombre_'.$i].' : '.$xdata;
			}
			//Guardo el valor correspondiente
			$arrGruposTitulo[$Titulo][$i]['valor'] = $rowDatos['SensoresMedActual_'.$i];
			$arrGruposTitulo[$Titulo][$i]['unimed'] = $unimed;
		}
		
		//Ordenamiento por titulo de grupo
		$names = array();
		foreach ($arrGruposTitulo as $titulo=>$items) {
			$names[] = $titulo;
		}
		array_multisort($names, SORT_ASC, $arrGruposTitulo);
									
		//se recorre el arreglo
		foreach($arrGruposTitulo as $titulo=>$items) { 

			$columna_a = '';
			$columna_b = '';
			$total_col1 = 0;
			$total_col2 = 0;
			$ntotal_col1 = 0;
			$ntotal_col2 = 0;
			$unimed_col1 = '';
			$unimed_col2 = '';
			$y = 1;
			?>
			<tr class="odd">		
				<td><?php echo $titulo ?></td>		
				<?php foreach($items as $datos) { 
					if($y==1){
						$columna_a .= $datos['Descripcion'].'<br/>';
						//Verifico que el dato no sea 99900
						if(isset($datos['valor'])&&$datos['valor']<99900){
							$total_col1 = $total_col1 + $datos['valor'];
							$ntotal_col1++;
						}
						$unimed_col1 = $datos['unimed'];
						$y=2;
					}else{
						$columna_b .= $datos['Descripcion'].'<br/>';
						//Verifico que el dato no sea 99900
						if(isset($datos['valor'])&&$datos['valor']<99900){
							$total_col2 = $total_col2 + $datos['valor'];
							$ntotal_col2++;
						}
						$unimed_col2 = $datos['unimed'];
						$y=1;
					}
				}?> 
				<td><?php echo $columna_a ?></td>
				<td><?php echo $columna_b ?></td>			
			</tr>
			
			<?php if($rowDatos['idOpcionesGen_3']==1){ ?>
				<tr class="odd">		
					<td>Promedio</td>
					<td><?php if($ntotal_col1!=0){echo Cantidades_decimales_justos($total_col1/$ntotal_col1).$unimed_col1;} ?></td>
					<td><?php if($ntotal_col2!=0){echo Cantidades_decimales_justos($total_col2/$ntotal_col2).$unimed_col2;} ?></td>			
				</tr>
			<?php } ?>
		<?php }?>        
	</tbody>
</table>
						
					

<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".iframe").colorbox({iframe:true, width:"80%", height:"95%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert('onOpen: colorbox is about to open'); },
			onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
			onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
			onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
			onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
		});

				
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
