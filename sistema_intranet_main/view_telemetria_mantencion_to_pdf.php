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
	//Consulta
	$query = "SELECT Config_imgLogo, idOpcionesGen_5	
	FROM `core_sistemas` 
	WHERE idSistema = '{$_GET['idSistema']}'  ";
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		
		//variables
		$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
		$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

		//generar log
		error_log("========================================================================================================================================", 0);
		error_log("Usuario: ". $NombreUsr, 0);
		error_log("Transaccion: ". $Transaccion, 0);
		error_log("-------------------------------------------------------------------", 0);
		error_log("Error code: ". mysqli_errno($dbConn), 0);
		error_log("Error description: ". mysqli_error($dbConn), 0);
		error_log("Error query: ". $query, 0);
		error_log("-------------------------------------------------------------------", 0);
						
	}
	$rowEmpresa = mysqli_fetch_array ($resultado);
}
/********************************************************************/// Se traen todos los datos de mi usuario
$query = "SELECT 

sistema_origen.Nombre AS SistemaOrigen,
sis_or_ciudad.Nombre AS SistemaOrigenCiudad,
sis_or_comuna.Nombre AS SistemaOrigenComuna,
sistema_origen.Direccion AS SistemaOrigenDireccion,
sistema_origen.Contacto_Fono1 AS SistemaOrigenFono,
sistema_origen.email_principal AS SistemaOrigenEmail,
sistema_origen.Rut AS SistemaOrigenRut,
sistema_origen.Contacto_Nombre AS SistemaContacto,

usuarios_listado.Nombre AS NombreEncargado,

telemetria_historial_mantencion.Fecha, 
telemetria_historial_mantencion.Duracion, 
telemetria_historial_mantencion.Resumen, 
telemetria_historial_mantencion.Resolucion,

telemetria_listado.Nombre AS Equipo

FROM `telemetria_historial_mantencion`
LEFT JOIN `core_sistemas`   sistema_origen          ON sistema_origen.idSistema                     = telemetria_historial_mantencion.idSistema
LEFT JOIN `core_ubicacion_ciudad`   sis_or_ciudad   ON sis_or_ciudad.idCiudad                       = sistema_origen.idCiudad
LEFT JOIN `core_ubicacion_comunas`  sis_or_comuna   ON sis_or_comuna.idComuna                       = sistema_origen.idComuna
LEFT JOIN `usuarios_listado`                        ON usuarios_listado.idUsuario                   = telemetria_historial_mantencion.idUsuario
LEFT JOIN `telemetria_listado`                      ON telemetria_listado.idTelemetria              = telemetria_historial_mantencion.idTelemetria

WHERE telemetria_historial_mantencion.idMantencion = {$_GET['view']}";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$row_data = mysqli_fetch_assoc ($resultado); 

/************************************************************/
// Se traen los archivos
$arrArchivos = array();
$query = "SELECT Nombre
FROM `telemetria_historial_mantencion_archivos`
WHERE idMantencion = {$_GET['view']}";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrArchivos,$row );
}

/********************************************************************/
//Se define el contenido del PDF
$html = '
<style>
body {font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;}
table {border-collapse: collapse;border-spacing: 0;}
tr.oddrow td{display: line;border-bottom: 1px solid #EEE;}
.tableline td, .tableline th{border-bottom: 1px solid #EEE;line-height: 1.42857143;}
</style>';
 
$html .= '
<table style="border: 1px solid #f4f4f4;margin: 1%; width: 98%;"   cellpadding="10" cellspacing="0">
	<tbody>
		<tr>
			<td>
	
				<table style="text-align: left; width: 100%;border: 1px solid #f4f4f4;"  cellpadding="0" cellspacing="0">
					<tbody>
						<tr class="oddrow">
							<td colspan="4" rowspan="1" style="text-align: center;background-color:#DDD;padding:5px;"><br/><strong>Mantenciones.</strong></td>
						</tr>
						<tr class="oddrow">
							<td colspan="4" rowspan="1" style="vertical-align: top;background-color:#FFF"></td>
						</tr>
						
						
						
						
						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Empresa Visitada</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaOrigen'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Tecnico a Cargo</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['NombreEncargado'].'</td>
						</tr>
						

						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Ubicacion</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaOrigenCiudad'].', '.$row_data['SistemaOrigenComuna'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Fecha</td>
							<td style="vertical-align: top; width:30%;">'.Fecha_estandar($row_data['Fecha']).'</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Direccion</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaOrigenDireccion'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Horas</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['Duracion'].'</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Fono Fijo</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaOrigenFono'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Equipo</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['Equipo'].'</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Rut</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaOrigenRut'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;"></td>
							<td style="vertical-align: top; width:30%;"></td>
						</tr>
						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Email</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaOrigenEmail'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;"></td>
							<td style="vertical-align: top; width:30%;"></td>
						</tr>
						<tr>
							<td style="vertical-align: top; width:20%;background-color:#DDD;">Contacto</td>
							<td style="vertical-align: top; width:30%;">'.$row_data['SistemaContacto'].'</td>
							<td style="vertical-align: top; width:20%;background-color:#DDD;"></td>
							<td style="vertical-align: top; width:30%;"></td>
						</tr>
						
					</tbody>
				</table>
				
				<br/>
				<br/>
				<table style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0">
					<tbody><tr><td style="vertical-align: top;">Resumen:</td></tr></tbody>
				</table>
				<table style="text-align: left; width: 100%;margin-top:20px;" cellpadding="5" cellspacing="0">
					<tbody>
						<tr>
							<td style="vertical-align: top;text-align: left;background-color: #f9f9f9;border: 1px solid #EEE;">'.$row_data['Resumen'].'</td>
						</tr>
					</tbody>
				</table>
				
				<br/>
				<br/>
				<table style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0">
					<tbody><tr><td style="vertical-align: top;">Resolucion:</td></tr></tbody>
				</table>
				<table style="text-align: left; width: 100%;margin-top:20px;" cellpadding="5" cellspacing="0">
					<tbody>
						<tr>
							<td style="vertical-align: top;text-align: left;background-color: #f9f9f9;border: 1px solid #EEE;">'.$row_data['Resolucion'].'</td>
						</tr>
					</tbody>
				</table>
				
				
				
			
				<br/>
				<br/>
				<table style="text-align: left; width: 100%; margin-top:20px;" cellpadding="0" cellspacing="0">
					<tbody>
						
						<tr style="background-color: #f1f1f1;">
							<td colspan="8">Archivos Adjuntos</td>
						</tr>
						<tr>';
							
						$xn_col = 1;
						foreach ($arrArchivos as $arch) {
							$html .= '<td style="vertical-align: top; width:12%;"><img src="upload/'.$arch['Nombre'].'"></td>';
							$xn_col++;
							if($xn_col>8){
								$html .= '</tr><tr>';
								$xn_col=1;
							}
						}
						
						$html .= '</tr>';
					
					$html .= '
					</tbody>
				</table>';
				
				
				

			$html .= '</td>
		</tr>
	</tbody>
</table>';
/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Mantencion Equipo '.$row_data['Equipo'];
$pdf_subtitulo  = '';
$pdf_file       = 'Mantencion Equipo '.$row_data['Equipo'].'.pdf';
$OpcDom         = "'A4', 'landscape'";
$OpcTcp         = "'L', 'A4'";
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
					$logo = '../../../../'.DB_EMPRESA_PATH.'/upload/'.$rowEmpresa['Config_imgLogo'];
				}else{
					$logo = '../../../../LIB_assets/img/logo_empresa.jpg';
				}
			}else{
				$logo = '../../../../LIB_assets/img/logo_empresa.jpg';
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
			$pdf->AddPage($AddPageL, AddPageA);
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


