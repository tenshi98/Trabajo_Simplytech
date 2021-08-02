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
//Se revisan los datos
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''){         $idSistema     = $_GET['idSistema'];     }elseif(isset($_POST['idSistema'])&&$_POST['idSistema']!=''){        $idSistema     = $_POST['idSistema'];}
if(isset($_GET['f_inicio'])&&$_GET['f_inicio']!=''){           $f_inicio      = $_GET['f_inicio'];      }elseif(isset($_POST['f_inicio'])&&$_POST['f_inicio']!=''){          $f_inicio      = $_POST['f_inicio'];}
if(isset($_GET['f_termino'])&&$_GET['f_termino']!=''){         $f_termino     = $_GET['f_termino'];     }elseif(isset($_POST['f_termino'])&&$_POST['f_termino']!=''){        $f_termino     = $_POST['f_termino'];}
if(isset($_GET['h_inicio'])&&$_GET['h_inicio']!=''){           $h_inicio      = $_GET['h_inicio'];      }elseif(isset($_POST['h_inicio'])&&$_POST['h_inicio']!=''){          $h_inicio      = $_POST['h_inicio'];}
if(isset($_GET['h_termino'])&&$_GET['h_termino']!=''){         $h_termino     = $_GET['h_termino'];     }elseif(isset($_POST['h_termino'])&&$_POST['h_termino']!=''){        $h_termino     = $_POST['h_termino'];}
if(isset($_GET['idTelemetria'])&&$_GET['idTelemetria']!=''){   $idTelemetria  = $_GET['idTelemetria'];  }elseif(isset($_POST['idTelemetria'])&&$_POST['idTelemetria']!=''){  $idTelemetria  = $_POST['idTelemetria'];}
if(isset($_GET['idGrupo'])&&$_GET['idGrupo']!=''){             $idGrupo       = $_GET['idGrupo'];       }elseif(isset($_POST['idGrupo'])&&$_POST['idGrupo']!=''){            $idGrupo       = $_POST['idGrupo'];}
if(isset($_GET['idUniMed'])&&$_GET['idUniMed']!=''){           $idUniMed      = $_GET['idUniMed'];      }elseif(isset($_POST['idUniMed'])&&$_POST['idUniMed']!=''){          $idUniMed      = $_POST['idUniMed'];}

//Se buscan la imagen i el tipo de PDF
if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
	$rowEmpresa = db_select_data (false, 'Config_imgLogo, idOpcionesGen_5', 'core_sistemas', '', 'idSistema='.$idSistema, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');
}

$z='';
if(isset($f_inicio)&&$f_inicio!=''&&isset($f_termino)&&$f_termino!=''&&isset($h_inicio)&&$h_inicio!=''&&isset($h_termino)&&$h_termino!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$idTelemetria.".TimeStamp BETWEEN '".$f_inicio." ".$h_inicio."' AND '".$f_termino." ".$h_termino."')";
}elseif(isset($f_inicio)&&$f_inicio!=''&&isset($f_termino)&&$f_termino!=''){
	$z.=" WHERE (telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema BETWEEN '".$f_inicio."' AND '".$f_termino."')";
}


//numero sensores equipo
$N_Maximo_Sensores = 72;
$consql = '';
for ($i = 1; $i <= $N_Maximo_Sensores; $i++) {
    $consql .= ',telemetria_listado.SensoresGrupo_'.$i.' AS SensoresGrupo_'.$i;
    $consql .= ',telemetria_listado.SensoresUniMed_'.$i.' AS SensoresUniMed_'.$i;
    $consql .= ',telemetria_listado_tablarelacionada_'.$idTelemetria.'.Sensor_'.$i.' AS SensorValue_'.$i;
   
}
//Se traen todos los registros
$arrRutas = array();
$query = "SELECT 
telemetria_listado.Nombre AS NombreEquipo,
telemetria_listado.cantSensores AS cantSensores,
telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema,
telemetria_listado_tablarelacionada_".$idTelemetria.".HoraSistema
".$consql."
FROM `telemetria_listado_tablarelacionada_".$idTelemetria."`
LEFT JOIN `telemetria_listado`    ON telemetria_listado.idTelemetria   = telemetria_listado_tablarelacionada_".$idTelemetria.".idTelemetria

".$z."
ORDER BY telemetria_listado_tablarelacionada_".$idTelemetria.".FechaSistema ASC,
telemetria_listado_tablarelacionada_".$idTelemetria.".HoraSistema ASC
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

/*************************************************************************/
//Se traen todas las unidades de medida
if(isset($idGrupo)&&$idGrupo!=''){
	$z = 'WHERE idGrupo='.$idGrupo;
}else{
	//busco los grupos disponibles
	$arrSubgrupos = array();
	$z            = 'WHERE idGrupo=0';		
	foreach ($arrRutas as $fac) {
		$N_Maximo_Sensores  = $fac['cantSensores'];
		for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
			$arrSubgrupos[$fac['SensoresGrupo_'.$x]]['idGrupo'] = $fac['SensoresGrupo_'.$x];
		}
	}
	foreach($arrSubgrupos as $categoria=>$sub){
		$z .= ' OR idGrupo='.$sub['idGrupo'];	
	}
	
}
$arrGrupos = array();
$query = "SELECT idGrupo, Nombre
FROM `telemetria_listado_grupos`
".$z."
ORDER BY idGrupo ASC";
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
array_push( $arrGrupos,$row );
}

//Se traen todas las unidades de medida
$query = "SELECT idUniMed, Nombre
FROM `telemetria_listado_unidad_medida`
WHERE idUniMed='".$idUniMed."'";
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
$rowUnimed = mysqli_fetch_assoc ($resultado);
/*************************************************************************/
//Variables
$m_table  = '';
//se arman datos
foreach ($arrRutas as $fac) {
								
	//numero sensores equipo
	$N_Maximo_Sensores  = $fac['cantSensores'];
	$arrDato            = array();
	$Dato               = 0;
	$Dato_N             = 0;
										
	for ($x = 1; $x <= $N_Maximo_Sensores; $x++) {
		//Que el valor medido sea distinto de 999
		if(isset($fac['SensorValue_'.$x])&&$fac['SensorValue_'.$x]<99900){
			//verifico si el grupo existe
			if(isset($idGrupo)&&$idGrupo!=''){
				if($fac['SensoresUniMed_'.$x]==$idUniMed&&$fac['SensoresGrupo_'.$x]==$idGrupo){
					$Dato = $Dato + $fac['SensorValue_'.$x];
					$Dato_N++;
				}
			}else{
				if($fac['SensoresUniMed_'.$x]==$idUniMed){
					$arrDato[$fac['SensoresGrupo_'.$x]]['Valor'] = $arrDato[$fac['SensoresGrupo_'.$x]]['Valor'] + $fac['SensorValue_'.$x];
					$arrDato[$fac['SensoresGrupo_'.$x]]['Cuenta']++;
				}
			}	
		}
	}
										
	//verifico si el grupo existe
	if(isset($idGrupo)&&$idGrupo!=''){
		if($Dato_N!=0){  $New_Dato = $Dato/$Dato_N; }else{$New_Dato = 0;}
		$m_table .= '
		<tr class="odd">
			<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.fecha_estandar($fac['FechaSistema']).'</td>
			<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$fac['HoraSistema'].'</td>
			<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.cantidades($New_Dato, 2).' '.$rowUnimed['Nombre'].'</td>
		</tr>';
	}else{
		$m_table .= '
		<tr class="odd">
			<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.fecha_estandar($fac['FechaSistema']).'</td>
			<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.$fac['HoraSistema'].'</td>';
		
		foreach ($arrGrupos as $gru) {
			if(isset($arrDato[$gru['idGrupo']]['Cuenta'])&&$arrDato[$gru['idGrupo']]['Cuenta']!=0){
				$New_Dato = $arrDato[$gru['idGrupo']]['Valor']/$arrDato[$gru['idGrupo']]['Cuenta'];
				$m_table .= '<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.cantidades($New_Dato, 2).' '.$rowUnimed['Nombre'].'</td>';
			}else{
				$m_table .= '<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">0 '.$rowUnimed['Nombre'].'</td>';
			}
		}
		$m_table .= '</tr>';
		
	}
	
}
/********************************************************************/
//Se define el contenido del PDF
$html = '
<style>
	tbody tr:nth-child(odd) {background-color: #dfdfdf;}
</style>';

//se imprime la imagen 
if(isset($_POST["img_adj"]) && $_POST["img_adj"] != ''){
	$html .= '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
}

$html .= '
<table width="100%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black;background-color: #ffffff;">  
	<thead>';
		$html .='	
		<tr>
			<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">Fecha</th>
			<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">Hora</th>';
			foreach ($arrGrupos as $gru) {
				$html .='<th style="font-size: 10px;text-align:center;background-color: #c3c3c3;">'.$gru['Nombre'].'</th>';
			}
		
		$html .='
		</tr>
	</thead>
	<tbody>';				
	$html .= $m_table;						
$html .='</tbody>
</table>';
 

/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Comparacion Grupos Sensores';
$pdf_subtitulo  = $_SESSION['usuario']['basic_data']['RazonSocial'];
$pdf_subtitulo .= '
Informe del equipo '.$arrRutas[0]['NombreEquipo'].'
';
if(isset($f_inicio)&&$f_inicio!=''&&isset($f_termino)&&$f_termino!=''&&isset($h_inicio)&&$h_inicio!=''&&isset($h_termino)&&$h_termino!=''){
	$pdf_subtitulo .= 'Del '.fecha_estandar($f_inicio).'-'.$h_inicio.' hasta '.fecha_estandar($f_termino).'-'.$h_termino;
}elseif(isset($f_inicio)&&$f_inicio!=''&&isset($f_termino)&&$f_termino!=''){
	$pdf_subtitulo .= 'Del '.fecha_estandar($f_inicio).' hasta '.fecha_estandar($f_termino);
}
$pdf_file       = 'Informe Comparacion Grupos Sensores del equipo '.$arrRutas[0]['NombreEquipo'].'.pdf';
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
			if(isset($idSistema)&&$idSistema!=''&&$idSistema!=0){
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
			
			//se imprime la imagen 
			if(isset($_POST["img_adj"]) && $_POST["img_adj"] != ''){
				$imgdata = base64_decode(str_replace('data:image/png;base64,', '',$_POST["img_adj"]));
				// The '@' character is used to indicate that follows an image data stream and not an image file name
				$pdf->Image('@'.$imgdata, 15, 30, 180, 120, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
			}
			
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
