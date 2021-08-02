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
	
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.SensoresNombre_".$_GET['sensorn']." AS SensorNombre,
telemetria_listado.SensoresGrupo_".$_GET['sensorn']." AS SensorGrupo,
telemetria_listado.SensoresMedMin_".$_GET['sensorn']." AS SensorMinMed,
telemetria_listado.SensoresMedMax_".$_GET['sensorn']." AS SensorMaxMed,

backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTabla,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".FechaSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".HoraSistema,
backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".Sensor_".$_GET['sensorn']." AS SensorValue,
telemetria_listado_unidad_medida.Nombre AS Unimed

FROM `backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria']."`
LEFT JOIN `telemetria_listado`                ON telemetria_listado.idTelemetria            = backup_telemetria_listado_tablarelacionada_".$_GET['idTelemetria'].".idTelemetria
LEFT JOIN `telemetria_listado_unidad_medida`  ON telemetria_listado_unidad_medida.idUniMed  = telemetria_listado.SensoresUniMed_".$_GET['sensorn']."


".$z."
ORDER BY FechaSistema ASC, HoraSistema ASC
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
/****************************************/
//Se trae grupo
$query = "SELECT Nombre
FROM `telemetria_listado_grupos`
WHERE idGrupo=".$arrRutas[0]['SensorGrupo'];
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
	<thead>
		<tr>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Fecha</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Hora</th>';
			//Si se ven detalles
			if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){ 
				$html .= '<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Medicion</th>';       
				$html .= '<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Minimo</th>';       
				$html .= '<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Maximo</th>';       
			//Si no se ven detalles	
			}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
				$html .= '<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Medicion</th>';       
			}
		$html .= '	
		</tr>
	</thead>
	<tbody>';
		
		foreach ($arrRutas as $rutas) { 
			if(isset($rutas['SensorValue'])&&$rutas['SensorValue']<99900){$xdata=Cantidades_decimales_justos($rutas['SensorValue']).' '.$rutas['Unimed'];}else{$xdata='Sin Datos';}
			
			$html .='<tr>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.fecha_estandar($rutas['FechaSistema']).'</td>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$rutas['HoraSistema'].'</td>';
			//Si se ven detalles
			if(isset($_GET['idDetalle'])&&$_GET['idDetalle']==1){ 
				$html .= '<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$xdata.'</td>';       
				$html .= '<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($rutas['SensorMinMed']).' '.$rutas['Unimed'].'</td>';       
				$html .= '<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($rutas['SensorMaxMed']).' '.$rutas['Unimed'].'</td>';       
			//Si no se ven detalles	
			}elseif(isset($_GET['idDetalle'])&&$_GET['idDetalle']==2){
				$html .= '<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$xdata.'</td>';       
			}			
			$html .='</tr>';
		}					

							
$html .='</tbody>
</table>';
 

/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Registro Sensores';
$pdf_subtitulo  = 'Informe Sensor '.$rowGrupo['Nombre'].' '.$arrRutas[0]['SensorNombre'];
$pdf_file       = 'Registro Sensores.pdf';
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
