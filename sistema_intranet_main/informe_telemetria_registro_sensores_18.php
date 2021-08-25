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
$original = "informe_telemetria_registro_sensores_18.php";
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

//se verifica si se ingreso la hora, es un dato optativo
$SIS_where = '';
$search    = '&idSistema='.$_SESSION['usuario']['basic_data']['idSistema'];
$search   .= '&sensorn='.$_GET['sensorn'].'&idTelemetria='.$_GET['idTelemetria'].'&f_inicio='.$_GET['f_inicio'].'&f_termino='.$_GET['f_termino'];
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$SIS_where .="(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
	$search.="&h_inicio=".$_GET['h_inicio']."&h_termino=".$_GET['h_termino'];
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$SIS_where .="(telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}

/****************************************************************/
//se traen lo datos del equipo
$SIS_query = '
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado_grupos.Nombre AS Grupo,
telemetria_listado_unidad_medida.Nombre AS SensoresUniMed,
telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.FechaSistema,
telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.HoraSistema,
telemetria_listado.SensoresNombre_'.$_GET['sensorn'].' AS SensorNombre,
telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.Sensor_'.$_GET['sensorn'].' AS SensorValue';
$SIS_join  = '
LEFT JOIN `telemetria_listado`                 ON telemetria_listado.idTelemetria             = telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.idTelemetria
LEFT JOIN `telemetria_listado_grupos`          ON telemetria_listado_grupos.idGrupo           = telemetria_listado.SensoresGrupo_'.$_GET['sensorn'].'
LEFT JOIN `telemetria_listado_unidad_medida`   ON telemetria_listado_unidad_medida.idUniMed   = telemetria_listado.SensoresUniMed_'.$_GET['sensorn'];
$SIS_order = 'telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.FechaSistema ASC, telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.HoraSistema ASC LIMIT 10000';
$arrEquipos = array();
$arrEquipos = db_select_array (false, $SIS_query, 'telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'], $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'test_logo');

/****************************************************************/
//Variables
$m_table  = '';
$Temp_1   = '';
$Temp_2   = '';

//se arman datos
foreach ($arrEquipos as $fac) {
	
	//variables							
	$Temp_1 .= "'".Fecha_estandar($fac['FechaSistema'])." - ".$fac['HoraSistema']."',";
	$xcount  = 0;
							
	//Que el valor medido sea distinto de 999
	if(isset($fac['SensorValue'])&&$fac['SensorValue']<99900){
		
		//verifico si existe
		if(isset($Temp_2)&&$Temp_2!=''){
			$Temp_2 .= ", ".$fac['SensorValue'];
		//si no lo crea
		}else{
			$Temp_2 = $fac['SensorValue'];
		}
		
		//Tabla
		$m_table .= '
		<tr class="odd">
			<td>'.fecha_estandar($fac['FechaSistema']).'</td>
			<td>'.$fac['HoraSistema'].'</td>
			<td>'.cantidades($fac['SensorValue'], 2).' '.$fac['SensoresUniMed'].'</td>
		</tr>';	
	}
}    
//variables
$Graphics_xData       = 'var xData = [['.$Temp_1.']];';
$Graphics_yData       = 'var yData = [['.$Temp_2.']];';
$Graphics_names       = "var names = ['".$arrEquipos[0]['Grupo'].'-'.$arrEquipos[0]['SensorNombre']."'];";
$Graphics_types       = "var types = [''];";
$Graphics_texts       = 'var texts = [[]];';
$Graphics_lineColors  = "var lineColors = [''];";
$Graphics_lineDash    = "var lineDash = [''];";
$Graphics_lineWidth   = "var lineWidth = [''];";
  
?>	

<style>
#loading {display: block;position: absolute;top: 0;left: 0;z-index: 100;width: 100%;height: 100%;background-color: rgba(192, 192, 192, 0.5);background-image: url("<?php echo DB_SITE_REPO.'/LIB_assets/img/loader.gif';?>");background-repeat: no-repeat;background-position: center;}
</style>
<div id="loading"></div>
<script>
//oculto el loader
document.getElementById("loading").style.display = "none";
</script>
						
<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Trazabilidad Sensor', $_SESSION['usuario']['basic_data']['RazonSocial'], 'Informe Sensor '.$arrEquipos[0]['Grupo'].'-'.$arrEquipos[0]['SensorNombre'].' del equipo '.$arrEquipos[0]['NombreEquipo']);?>
	<div class="col-md-6 col-sm-6 col-xs-12 clearfix">
		<a target="new" href="<?php echo 'informe_telemetria_registro_sensores_18_to_excel.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-2 pull-right margin_width"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar a Excel</a>
	
		<?php if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>	
			<input class="btn btn-sm btn-metis-3 pull-right margin_width fa-input" type="button" onclick="Export()" value="&#xf1c1; Exportar a PDF"/>
		<?php }else{ ?>
			<a target="new" href="<?php echo 'informe_telemetria_registro_sensores_18_to_pdf.php?bla=bla'.$search ; ?>" class="btn btn-sm btn-metis-3 pull-right margin_width"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Exportar a PDF</a>
		<?php } ?>
		
	</div>	
</div>
<div class="clearfix"></div> 



 


<?php 
//Se verifica si se pidieron los graficos
if(isset($_GET['idGrafico'])&&$_GET['idGrafico']==1){ ?>
	
	<div class="col-sm-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
				<h5> Graficos</h5>
			</header>
			<div class="table-responsive" id="grf">	
				
				<?php GraphLinear_1('graphLinear_1', 'Grafico Consumo', 'Fecha', 'Consumo', $Graphics_xData, $Graphics_yData, $Graphics_names, $Graphics_types, $Graphics_texts, $Graphics_lineColors, $Graphics_lineDash, $Graphics_lineWidth); ?>
								
			</div>
		</div>
	</div>
			
			
	<div class="col-sm-12" style="display: none;">

		<form method="post" id="make_pdf" action="informe_telemetria_registro_sensores_18_to_pdf.php">
			<input type="hidden" name="img_adj" id="img_adj" />
			
			<input type="hidden" name="idSistema"     id="idSistema"    value="<?php echo $_SESSION['usuario']['basic_data']['idSistema']; ?>" />
			<input type="hidden" name="f_inicio"      id="f_inicio"     value="<?php echo $_GET['f_inicio']; ?>" />
			<input type="hidden" name="f_termino"     id="f_termino"    value="<?php echo $_GET['f_termino']; ?>" />
			<input type="hidden" name="idTelemetria"  id="idTelemetria" value="<?php echo $_GET['idTelemetria']; ?>" />
			<input type="hidden" name="sensorn"       id="sensorn"      value="<?php echo $_GET['sensorn']; ?>" />
			
			<?php if(isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''){ ?>   <input type="hidden" name="h_inicio"   id="h_inicio"  value="<?php echo $_GET['h_inicio']; ?>" /><?php } ?>
			<?php if(isset($_GET['h_termino'])&&$_GET['h_termino']!=''){ ?> <input type="hidden" name="h_termino"  id="h_termino" value="<?php echo $_GET['h_termino']; ?>" /><?php } ?>
			
			<button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs">Hacer PDF</button>
		
		</form>

		<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIB_assets/js/dom-to-image.min.js"></script>		
		<script>
			var node = document.getElementById('graphLinear_1');
			
			function sendDatatoSRV(img) {
				$('#img_adj').val(img);
				//$('#img_adj').val($('#img-out').html());
				$('#make_pdf').submit();
				//oculto el loader
				document.getElementById("loading").style.display = "none";
			}
			function Export() {
				//muestro el loader
				document.getElementById("loading").style.display = "block";
				//Exporto
				setTimeout(
					function(){
						domtoimage.toPng(node)
						.then(function (dataUrl) {
							var img = new Image();
							img.src = dataUrl;
							//document.getElementById('img-out').appendChild(img);
							//alert(img.src);
							sendDatatoSRV(img.src);
						})
						.catch(function (error) {
							console.error('oops, something went wrong!', error);
						});		
					}
				, 3000);
			}

		</script>	
	</div>	
	<?php
	$xsi++;
} ?>

<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Tabla de Datos</h5>
			
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<tr class="odd">
						<th>Fecha</th>
						<th>Hora</th>
						<th><?php echo $arrEquipos[0]['Grupo'].'-'.$arrEquipos[0]['SensorNombre']; ?></th>
					</tr>
					
					<?php echo $m_table; ?>				
				                    
				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>
			
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
//Filtro de busqueda
$z  = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];   //Sistema
$z .= " AND telemetria_listado.id_Geo=2";                                                //Geolocalizacion inactiva
//Verifico el tipo de usuario que esta ingresando
if($_SESSION['usuario']['basic_data']['idTipoUsuario']!=1){
	$z .= " AND usuarios_equipos_telemetria.idUsuario = ".$_SESSION['usuario']['basic_data']['idUsuario'];		
}
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=9";//CrossEnergy			
}
//Se escribe el dato
$Alert_Text  = 'La busqueda esta limitada a 10.000 registros, en caso de necesitar mas registros favor comunicarse con el administrador';
alert_post_data(2,1,1, $Alert_Text);
?>	
		
<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Filtro de busqueda</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" action="<?php echo $location ?>" id="form1" name="form1" novalidate>
               
               <?php 
				//Se verifican si existen los datos
				if(isset($f_inicio)) {      $x1  = $f_inicio;     }else{$x1  = '';}
				if(isset($f_termino)) {     $x2  = $f_termino;    }else{$x2  = '';}
				if(isset($h_inicio)) {      $x3  = $h_inicio;     }else{$x3  = '';}
				if(isset($h_termino)) {     $x4  = $h_termino;    }else{$x4  = '';}
				if(isset($idTelemetria)) {  $x5  = $idTelemetria; }else{$x5  = '';}
				if(isset($idGrafico)) {     $x8  = $idGrafico;    }else{$x8  = '';}
				//Si es redireccionado desde otra pagina con datos precargados
				if(isset($_GET['view'])&&$_GET['view']!='') { $x5  = $_GET['view']; }
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_date('Fecha Inicio','f_inicio', $x1, 2);
				$Form_Inputs->form_date('Fecha Termino','f_termino', $x2, 2);
				$Form_Inputs->form_time('Hora Inicio','h_inicio', $x3, 1, 1);
				$Form_Inputs->form_time('Hora Termino','h_termino', $x4, 1, 1);
				//Verifico el tipo de usuario que esta ingresando
				if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
					$Form_Inputs->form_select_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', $z, '', $dbConn);	
				}else{
					$Form_Inputs->form_select_join_filter('Equipo','idTelemetria', $x5, 2, 'idTelemetria', 'Nombre', 'telemetria_listado', 'usuarios_equipos_telemetria', $z, $dbConn);
				}
				
				
				//numero sensores equipo
				$N_Maximo_Sensores = 72;
				$subquery = '';
				for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
					$subquery .= ',SensoresGrupo_'.$i;
					$subquery .= ',SensoresNombre_'.$i;
					$subquery .= ',SensoresActivo_'.$i;
				}
				// Se trae un listado de todas las comunas
				$arrSelect = array();
				$query = "SELECT
				idTelemetria, cantSensores
				".$subquery."
				
				FROM `telemetria_listado`
				ORDER BY idTelemetria ASC";
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
				array_push( $arrSelect,$row );
				}

				//Se traen todos los grupos
				$arrGrupos = array();
				$query = "SELECT idGrupo,Nombre
				FROM `telemetria_listado_grupos`
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
				array_push( $arrGrupos,$row );
				}
				
				$input = '<div class="form-group" id="div_sensorn" >
								<label for="text2" class="control-label col-sm-4">Sensor</label>
								<div class="col-sm-8 field">
									<select name="sensorn" id="sensorn" class="form-control" required="">
										<option value="" selected>Seleccione una Opcion</option>
									</select>
								</div>
							</div>';
					
					//script		
				$input .= '<script>';
				

				$input .= 'document.getElementById("idTelemetria").onchange = function() {cambia_idTelemetria()};';
					
				foreach ($arrSelect as $select) {
					$input .= 'let id_data_'.$select['idTelemetria'].'=new Array(""';
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							$input .= ',"'.$i.'"';
						}
					}	
					$input .= ')
					';
				}
				foreach ($arrSelect as $select) {
					$input .= 'let data_'.$select['idTelemetria'].'=new Array("Seleccione una Opcion"';
					for ($i = 1; $i <= $select['cantSensores']; $i++) {
						//solo sensores activos
						if(isset($select['SensoresActivo_'.$i])&&$select['SensoresActivo_'.$i]==1){
							//se verifica
							$grupo = '';
							foreach ($arrGrupos as $sen) { 
								if($select['SensoresGrupo_'.$i]==$sen['idGrupo']){
									$grupo = $sen['Nombre'].' - ';
								}
							}
							$input .= ',"'.$grupo.str_replace('"', '',$select['SensoresNombre_'.$i]).'"';
						}
					}	
					$input .= ')
					';
				}
	
				$input .= '
				function cambia_idTelemetria(){
					
					let Componente = document.form1.idTelemetria[document.form1.idTelemetria.selectedIndex].value
					try {
					if (Componente != "") {
						id_data = eval("id_data_" + Componente);
						data    = eval("data_" + Componente);
						num_int = id_data.length;
						document.form1.sensorn.length = num_int;
						for(i=0;i<num_int;i++){
						   document.form1.sensorn.options[i].value=id_data[i];
						   document.form1.sensorn.options[i].text=data[i];
						}
						document.getElementById("div_sensorn").style.display = "block";	
					}else{
						document.form1.sensorn.length = 1;
						document.form1.sensorn.options[0].value = "";
						document.form1.sensorn.options[0].text = "Seleccione una Opcion";
						document.getElementById("div_sensorn").style.display = "none";
					}
					} catch (e) {
						document.form1.sensorn.length = 1;
						document.form1.sensorn.options[0].value = "";
						document.form1.sensorn.options[0].text = "Seleccione una Opcion";
						document.getElementById("div_sensorn").style.display = "none";
					
					}
					document.form1.sensorn.options[0].selected = true;
				}
				</script>';					
				
				
				echo $input;	
				
				$Form_Inputs->form_select('Mostrar Graficos','idGrafico', $x8, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);		
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
