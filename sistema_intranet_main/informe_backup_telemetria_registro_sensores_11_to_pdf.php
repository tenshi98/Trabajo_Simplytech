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
$z='';
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''&&isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''&&isset($_GET['h_termino'])&&$_GET['h_termino']!=''){
	$z.=" WHERE (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".TimeStamp BETWEEN '".$_GET['f_inicio']." ".$_GET['h_inicio']."' AND '".$_GET['f_termino']." ".$_GET['h_termino']."')";
}elseif(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" WHERE (backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."')";
}

//numero sensores equipo
$N_Maximo_Sensores = 72;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
    $consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
    $consql .= ',telemetria_listado.SensoresNombre_'.$i.' AS SensorNombre_'.$i;
    $consql .= ',telemetria_listado.SensoresMedMin_'.$i.' AS SensoresMedMin_'.$i;
    $consql .= ',telemetria_listado.SensoresMedMax_'.$i.' AS SensoresMedMax_'.$i;
    $consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
    $consql .= ',backup_telemetria_listado_tablarelacionada_'.$_GET['idTelemetria'].'.Sensor_'.$i.' AS SensorValue_'.$i;
   
}
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.cantSensores AS cantSensores,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema
".$consql."
FROM `backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria

".$z."
ORDER BY backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema ASC,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema ASC
LIMIT 10000";
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

//Se traen todas las unidades de medida
$query = "SELECT Nombre
FROM `telemetria_listado_grupos`
WHERE idGrupo='".$_GET['idGrupo']."'";
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
$rowGrupo = mysqli_fetch_assoc ($resultado); 
/********************************************************************/
//Se define el contenido del PDF
$html = '
<style>
	tbody tr:nth-child(odd) {background-color: #dfdfdf;}
</style>';


$html .= '
<table width="100%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black;background-color: #ffffff;">  
	<thead>';
		$html .='	
		<tr>
			<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">Fecha</th>
			<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">Hora</th>
			<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">Temperatura</th>
			<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">Humedad</th>
		</tr>
	</thead>
	<tbody>';
		
		foreach ($arrRutas as $fac) {
			//numero sensores equipo
			$N_Maximo_Sensores = $fac['cantSensores'];
			$Temperatura       = 0;
			$Temperatura_N     = 0;
			$Humedad           = 0;
			$Humedad_N         = 0;
											
			for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
				if($fac['SensoresGrupo_'.$x]==$_GET['idGrupo']){
					//Que el valor medido sea distinto de 999
					if(isset($fac['SensorValue_'.$x])&&$fac['SensorValue_'.$x]<99900){
						//Si es humedad
						if($fac['SensoresUniMed_'.$x]==2){$Humedad = $Humedad + $fac['SensorValue_'.$x];$Humedad_N++;}
						//Si es temperatura
						if($fac['SensoresUniMed_'.$x]==3){$Temperatura = $Temperatura + $fac['SensorValue_'.$x];$Temperatura_N++;}
					}
				}
			}
											
			if($Temperatura_N!=0){  $New_Temperatura = $Temperatura/$Temperatura_N; }else{$New_Temperatura = 0;}
			if($Humedad_N!=0){      $New_Humedad     = $Humedad/$Humedad_N;         }else{$New_Humedad = 0;}
			
			//omite la linea mientras alguna de las variables contenga datos
			if($Temperatura_N!=0 OR $Humedad_N!=0){
				$html .='	
				<tr>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.fecha_estandar($fac['FechaSistema']).'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$fac['HoraSistema'].'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.cantidades($New_Temperatura, 2).'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.cantidades($New_Humedad, 2).'</td>
				</tr>';
			}
		}
		
							
$html .='</tbody>
</table>';
 


/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Informe Sensores';
$pdf_subtitulo  = 'Informe grupo '.$rowGrupo['Nombre'].' del equipo '.$arrRutas[0]['NombreEquipo'];
$pdf_file       = 'Informe Sensores.pdf';
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
