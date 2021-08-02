<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.PDF.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//Se buscan la imagen i el tipo de PDF
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
	$rowEmpresa = db_select_data (false, 'Config_imgLogo, idOpcionesGen_5', 'core_sistemas', '', 'idSistema='.$_GET['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');
}
/********************************************************************/
//se verifica si se ingreso la hora, es un dato optativo
$subf='';
//Datos opcionales
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$subf.=" AND (TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$subf.=" AND (FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}

/**********************************************************************/
//Funcion para escribir datos
function crear_data($cantsens, $filtro, $idTelemetria, $f_inicio, $f_termino, $desde, $hasta, $dbConn ) {
	
	$consql = '';
	$subfiltro = '';
	for ($i = 1; $i <= $cantsens; $i++) {
		//$subfiltro .= ' AND backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.' != 999';
		$consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
		//$consql .= ',telemetria_listado.SensoresNombre_'.$i.' AS SensorNombre_'.$i;
		$consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
		
		
		//desde y hasta activo
		if(isset($desde)&&$desde!=''&&isset($hasta)&&$hasta!=''){
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0),0)) AS MedDesStan_'.$i;
		//solo desde	
		}elseif(isset($desde)&&$desde!=''&&(!isset($hasta) OR $hasta=='')){
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'>='.$desde.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedDesStan_'.$i;
		//solo hasta	
		}elseif(isset($hasta)&&$hasta!=''&&(!isset($desde) OR $desde=='')){
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<='.$hasta.',IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0),0)) AS MedDesStan_'.$i;
		//ninguno
		}else{
			//$consql .= ',MIN(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedMin_'.$i;
			//$consql .= ',MAX(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedMax_'.$i;
			$consql .= ',AVG(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedProm_'.$i;
			//$consql .= ',STDDEV(NULLIF(IF(telemetria_listado.SensoresActivo_'.$i.'=1,IF(backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.'<99900,backup_telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.',0),0),0)) AS MedDesStan_'.$i;
		}
	}

	//Se traen todos los registros
	$arrRutas = array();
	$query = "SELECT 
	telemetria_listado.Nombre AS NombreEquipo,
	telemetria_listado.cantSensores AS cantSensores,
	backup_telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema
	".$consql."
	FROM `backup_telemetria_listado_tablarelacionada_".$idTelemetria."`
	LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = backup_telemetria_listado_tablarelacionada_".$idTelemetria.".idTelemetria
	WHERE idTabla!=0
	".$filtro.$subfiltro." 
	GROUP BY backup_telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema
	ORDER BY backup_telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema ASC";
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
	array_push( $arrRutas,$row );
	}
	return $arrRutas;
	
}
/*********************************************************************************/
//Consulta por la cantidad de sensores
$query = "SELECT cantSensores, Nombre
FROM `telemetria_listado`
WHERE idTelemetria=".$_GET['idTelemetria'];
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
$rowEquipo = mysqli_fetch_assoc ($resultado);
//Variable temporal
$arrTemporal = array();	
//Llamo a la funcion
$arrTemporal = crear_data($rowEquipo['cantSensores'], $subf, $_GET['idTelemetria'], $_GET['f_inicio'], $_GET['f_termino'], $_GET['desde'], $_GET['hasta'] , $dbConn);
 
/********************************************************************/
//Se define el contenido del PDF
$html = '
<style>
	tbody tr:nth-child(odd) {background-color: #dfdfdf;}
</style>';


$html .= '
<table width="100%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black;background-color: #ffffff;">  
	<thead>
		<tr>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Equipo</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Fecha</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Temperatura</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Humedad</th>        
		</tr>
	</thead>
	<tbody>';
							
		foreach ($arrTemporal as $fac) {
			//numero sensores equipo
			$N_Maximo_Sensores = $fac['cantSensores'];
			$Temperatura       = 0;
			$Temperatura_N     = 0;
			$Humedad           = 0;
			$Humedad_N         = 0;
													
			for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
				if($fac['SensoresGrupo_'.$x]==$_GET['idGrupo']){
					//Que el valor medido sea distinto de 999
					if(isset($fac['MedProm_'.$x])&&$fac['MedProm_'.$x]<99900){
						//Si es humedad
						if($fac['SensoresUniMed_'.$x]==2){$Humedad = $Humedad + $fac['MedProm_'.$x];$Humedad_N++;}
						//Si es temperatura
						if($fac['SensoresUniMed_'.$x]==3){$Temperatura = $Temperatura + $fac['MedProm_'.$x];$Temperatura_N++;}
					}
				}
			}
													
			if($Temperatura_N!=0){  $New_Temperatura = $Temperatura/$Temperatura_N; }else{$New_Temperatura = 0;}
			if($Humedad_N!=0){      $New_Humedad     = $Humedad/$Humedad_N;         }else{$New_Humedad = 0;}
			
			//omite la linea mientras alguna de las variables contenga datos
			if($Temperatura_N!=0 OR $Humedad_N!=0){
				//Se escriben Datos
				$html .='<tr>';
					$html .='<td>'.$fac['NombreEquipo'].'</td>';
					$html .='<td>'.$fac['FechaSistema'].'</td>';
					$html .='<td>'.$New_Temperatura.'</td>';
					$html .='<td>'.$New_Humedad.'</td>';
				$html .= '</tr>';
			}					
		}
							
$html .='</tbody>
</table>';
 

/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Desviacion estandar';
$pdf_subtitulo  = 'Equipo: '.$rowEquipo['Nombre'];
$pdf_file       = 'Desviacion estandar.pdf';
$OpcDom         = "'A4', 'landscape'";
$OpcTcpOrt      = "P";  //P->PORTRAIT - L->LANDSCAPE
$OpcTcpPg       = "A4"; //Tipo de Hoja
/********************************************************************************/
//Se verifica que este configurado el motor de pdf
if(isset($rowEmpresa['idOpcionesGen_5'])&&$rowEmpresa['idOpcionesGen_5']!=0){
	switch ($rowEmpresa['idOpcionesGen_5']) {
		/************************************************************************/
		//TCPDF
		case 1:
			
			require_once('../LIBS_php/tcpdf/tcpdf.php');

			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Victor Reyes');
			$pdf->SetTitle('');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			// set default header data
			if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
				if(isset($rowEmpresa['Config_imgLogo'])&&$rowEmpresa['Config_imgLogo']!=''){
					$logo = '../../../../'.DB_SITE_MAIN_PATH.'/upload/'.$rowEmpresa['Config_imgLogo'];
				}else{
					$logo = '../../../../Legacy/gestion_modular/img/logo_empresa.jpg';
				}
			}else{
				$logo = '../../../../Legacy/gestion_modular/img/logo_empresa.jpg';
			}
			$pdf->SetHeaderData($logo, 40, $pdf_titulo, $pdf_subtitulo);

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			//Se crea el archivo
			$pdf->SetFont('helvetica', '', 10);
			$pdf->AddPage($OpcTcpOrt, $OpcTcpPg);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->lastPage();
			$pdf->Output($pdf_file, 'I');
	
			break;
		/************************************************************************/
		//DomPDF (Solo compatible con PHP 5.x)
		case 2:
			require_once '../LIBS_php/dompdf/autoload.inc.php';
			// reference the Dompdf namespace
			//use Dompdf\Dompdf;
			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper($OpcDom);
			$dompdf->render();
			$dompdf->stream($pdf_file);
			break;

	}
}

?>
