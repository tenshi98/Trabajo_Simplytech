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
//Inicia variable
$z="WHERE telemetria_listado_error_geocerca.idErrores>0"; 
$z.=" AND telemetria_listado.id_Geo='1'";
$z.=" AND telemetria_listado_error_geocerca.idSistema=".$_GET['idSistema'];
//Solo para plataforma CrossTech
if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
	$z .= " AND telemetria_listado.idTab=3";//CrossTrack			
}
//verifico si existen los parametros de fecha
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''&&isset($_GET['f_termino'])&&$_GET['f_termino']!=''){
	$z.=" AND telemetria_listado_error_geocerca.Fecha BETWEEN '".$_GET['f_inicio']."' AND '".$_GET['f_termino']."'";
}
//verifico si se selecciono un equipo
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){
	$z.=" AND telemetria_listado_error_geocerca.idTelemetria='".$_GET['idTelemetria']."'";
}
//Verifico el tipo de usuario que esta ingresando
if($_GET['idTipoUsuario']==1){
	$join = "";
}else{
	$join = " INNER JOIN usuarios_equipos_telemetria ON usuarios_equipos_telemetria.idTelemetria = telemetria_listado_error_geocerca.idTelemetria ";
	$z.=" AND usuarios_equipos_telemetria.idUsuario=".$_SESSION['usuario']['basic_data']['idUsuario'];	
}


// Se trae un listado con todos los usuarios
$arrErrores = array();
$query = "SELECT 
telemetria_listado_error_geocerca.idErrores,
telemetria_listado_error_geocerca.Descripcion, 
telemetria_listado_error_geocerca.Fecha, 
telemetria_listado_error_geocerca.Hora,
telemetria_listado.Nombre AS NombreEquipo

FROM `telemetria_listado_error_geocerca`
LEFT JOIN `telemetria_listado` ON telemetria_listado.idTelemetria = telemetria_listado_error_geocerca.idTelemetria
".$join."
".$z."
ORDER BY idErrores DESC  ";
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
array_push( $arrErrores,$row );
} 


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
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Nombre Equipo</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Descripcion</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Fecha</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Hora</th>
            <th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Medicion Actual</th>
            <th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Min</th>
            <th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Max</th>          
		</tr>
	</thead>
	<tbody>';
							
		foreach ($arrErrores as $error) {
			//Guardo la unidad de medida
			$unimed = '';
			foreach ($arrUnimed as $sen) {
				if($error['SensoresUniMed_'.$error['Sensor']]==$sen['idUniMed']){
					$unimed = ' '.$sen['Nombre'];	
				}
			}
							
				$html .='
				<tr>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$error['NombreEquipo'].'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$error['Descripcion'].'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.fecha_estandar($error['Fecha']).'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$error['Hora'].'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($error['Valor']).$unimed.'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($error['Valor_min']).$unimed.'</td>
					<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($error['Valor_max']).$unimed.'</td>
				</tr>
				';						
		}
							
$html .='</tbody>
</table>';
  


/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Informe de Alertas';
$pdf_subtitulo  = '';
$pdf_file       = 'Informe de Alertas.pdf';
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
