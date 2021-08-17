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
//Version antigua de view
//se verifica si es un numero lo que se recibe
if (validarNumero($_GET['view'])){ 
	//Verifica si el numero recibido es un entero
	if (validaEntero($_GET['view'])){ 
		$X_Puntero = $_GET['view'];
	} else { 
		$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
	}
} else { 
	$X_Puntero = simpleDecode($_GET['view'], fecha_actual());
}
/**************************************************************/
//Se buscan la imagen i el tipo de PDF
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&simpleDecode($_GET['idSistema'], fecha_actual())!=0){
	//Consulta
	$rowEmpresa = db_select_data (false, 'Config_imgLogo, idOpcionesGen_5', 'core_sistemas', '', 'idSistema ='.simpleDecode($_GET['idSistema'], fecha_actual()), $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');
}
/********************************************************************/
// Se traen todos los datos del analisis
$query = "SELECT 
cross_quality_registrar_inspecciones.fecha_auto,
cross_quality_registrar_inspecciones.Creacion_fecha,
cross_quality_registrar_inspecciones.Temporada,
cross_quality_registrar_inspecciones.Observaciones,

core_sistemas.Nombre AS Sistema,
usuarios_listado.Nombre AS Usuario,
core_cross_quality_analisis_calidad.Nombre AS TipoAnalisis,
sistema_variedades_categorias.Nombre AS ProductoCategoria,
variedades_listado.Nombre AS ProductoNombre,

cross_quality_registrar_inspecciones.idCategoria,
cross_quality_registrar_inspecciones.idTipo,
cross_quality_registrar_inspecciones.idSistema,
(SELECT 
cross_quality_calidad_matriz.cantPuntos
FROM `sistema_variedades_categorias_matriz_calidad`
LEFT JOIN `cross_quality_calidad_matriz` ON cross_quality_calidad_matriz.idMatriz = sistema_variedades_categorias_matriz_calidad.idMatriz
WHERE sistema_variedades_categorias_matriz_calidad.idCategoria = cross_quality_registrar_inspecciones.idCategoria
AND sistema_variedades_categorias_matriz_calidad.idProceso = cross_quality_registrar_inspecciones.idTipo
AND sistema_variedades_categorias_matriz_calidad.idSistema = cross_quality_registrar_inspecciones.idSistema
) AS Producto_cantPuntos,

(SELECT 
sistema_variedades_categorias_matriz_calidad.idMatriz
FROM `sistema_variedades_categorias_matriz_calidad`
LEFT JOIN `cross_quality_calidad_matriz` ON cross_quality_calidad_matriz.idMatriz = sistema_variedades_categorias_matriz_calidad.idMatriz
WHERE sistema_variedades_categorias_matriz_calidad.idCategoria = cross_quality_registrar_inspecciones.idCategoria
AND sistema_variedades_categorias_matriz_calidad.idProceso = cross_quality_registrar_inspecciones.idTipo
AND sistema_variedades_categorias_matriz_calidad.idSistema = cross_quality_registrar_inspecciones.idSistema
) AS Producto_idCalidad,

ubicacion_listado.Nombre AS UbicacionNombre,
ubicacion_listado_level_1.Nombre AS UbicacionNombre_lvl_1,
ubicacion_listado_level_2.Nombre AS UbicacionNombre_lvl_2,
ubicacion_listado_level_3.Nombre AS UbicacionNombre_lvl_3,
ubicacion_listado_level_4.Nombre AS UbicacionNombre_lvl_4,
ubicacion_listado_level_5.Nombre AS UbicacionNombre_lvl_5

FROM `cross_quality_registrar_inspecciones`
LEFT JOIN `core_sistemas`                          ON core_sistemas.idSistema                      = cross_quality_registrar_inspecciones.idSistema
LEFT JOIN `usuarios_listado`                       ON usuarios_listado.idUsuario                   = cross_quality_registrar_inspecciones.idUsuario
LEFT JOIN `core_cross_quality_analisis_calidad`    ON core_cross_quality_analisis_calidad.idTipo   = cross_quality_registrar_inspecciones.idTipo
LEFT JOIN `sistema_variedades_categorias`          ON sistema_variedades_categorias.idCategoria    = cross_quality_registrar_inspecciones.idCategoria
LEFT JOIN `variedades_listado`                     ON variedades_listado.idProducto                = cross_quality_registrar_inspecciones.idProducto
LEFT JOIN `ubicacion_listado`                      ON ubicacion_listado.idUbicacion                = cross_quality_registrar_inspecciones.idUbicacion
LEFT JOIN `ubicacion_listado_level_1`              ON ubicacion_listado_level_1.idLevel_1          = cross_quality_registrar_inspecciones.idUbicacion_lvl_1
LEFT JOIN `ubicacion_listado_level_2`              ON ubicacion_listado_level_2.idLevel_2          = cross_quality_registrar_inspecciones.idUbicacion_lvl_2
LEFT JOIN `ubicacion_listado_level_3`              ON ubicacion_listado_level_3.idLevel_3          = cross_quality_registrar_inspecciones.idUbicacion_lvl_3
LEFT JOIN `ubicacion_listado_level_4`              ON ubicacion_listado_level_4.idLevel_4          = cross_quality_registrar_inspecciones.idUbicacion_lvl_4
LEFT JOIN `ubicacion_listado_level_5`              ON ubicacion_listado_level_5.idLevel_5          = cross_quality_registrar_inspecciones.idUbicacion_lvl_5

WHERE cross_quality_registrar_inspecciones.idAnalisis = ".$X_Puntero;
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
$row_data = mysqli_fetch_assoc ($resultado);

/***************************************************/				
// Se trae un listado con todos los trabajadores
$arrTrabajadores = array();
$query = "SELECT 
trabajadores_listado.Nombre, 
trabajadores_listado.ApellidoPat, 
trabajadores_listado.ApellidoMat, 
trabajadores_listado.Cargo, 
trabajadores_listado.Rut

FROM `cross_quality_registrar_inspecciones_trabajador` 
LEFT JOIN `trabajadores_listado`  ON trabajadores_listado.idTrabajador   = cross_quality_registrar_inspecciones_trabajador.idTrabajador
WHERE cross_quality_registrar_inspecciones_trabajador.idAnalisis = ".$X_Puntero;
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
array_push( $arrTrabajadores,$row );
}
/***************************************************/				
// Se trae un listado con todas las maquinas
$arrMaquinas = array();
$query = "SELECT 
maquinas_listado.Nombre,
maquinas_listado.Codigo

FROM `cross_quality_registrar_inspecciones_maquina` 
LEFT JOIN `maquinas_listado`  ON maquinas_listado.idMaquina   = cross_quality_registrar_inspecciones_maquina.idMaquina
WHERE cross_quality_registrar_inspecciones_maquina.idAnalisis = ".$X_Puntero;
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
array_push( $arrMaquinas,$row );
}
/***************************************************/				
// Se trae un listado con todas las muestras
$arrMuestras = array();
$query = "SELECT 
cross_quality_registrar_inspecciones_muestras.idMuestras, 
cross_quality_registrar_inspecciones_muestras.n_folio_pallet,
cross_quality_registrar_inspecciones_muestras.lote,
productores_listado.Nombre AS ClienteNombre

FROM `cross_quality_registrar_inspecciones_muestras` 
LEFT JOIN `productores_listado`  ON productores_listado.idProductor   = cross_quality_registrar_inspecciones_muestras.idProductor
WHERE cross_quality_registrar_inspecciones_muestras.idAnalisis = ".$X_Puntero;
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
array_push( $arrMuestras,$row );
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
	
				<table style="text-align: left; width: 100%;"  cellpadding="0" cellspacing="0">
					<tbody>
						<tr class="oddrow">
							<td colspan="2" rowspan="1" style="vertical-align: top;">'.$row_data['TipoAnalisis'].'</td>
							<td style="vertical-align: top;">Fecha Creacion: '.Fecha_estandar($row_data['fecha_auto']).'</td>
						</tr>
						<tr>
							<td style="vertical-align: top; width:33%;">
								Datos Basicos<br/>
								<strong>Producto</strong><br/>
								'.$row_data['ProductoCategoria'].', '.$row_data['ProductoNombre'].'<br/>
								Ubicacion: '.$row_data['UbicacionNombre'].'<br/>';
								if(isset($row_data['UbicacionNombre_lvl_1'])&&$row_data['UbicacionNombre_lvl_1']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_1'];}
								if(isset($row_data['UbicacionNombre_lvl_2'])&&$row_data['UbicacionNombre_lvl_2']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_2'];}
								if(isset($row_data['UbicacionNombre_lvl_3'])&&$row_data['UbicacionNombre_lvl_3']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_3'];}
								if(isset($row_data['UbicacionNombre_lvl_4'])&&$row_data['UbicacionNombre_lvl_4']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_4'];}
								if(isset($row_data['UbicacionNombre_lvl_5'])&&$row_data['UbicacionNombre_lvl_5']!=''){$html .= ' - '.$row_data['UbicacionNombre_lvl_5'];}
							$html .= '</td>
									
							<td style="vertical-align: top;width:33%;">
								Fecha Creacion<br/>
								Fecha Ingreso: '.Fecha_estandar($row_data['Creacion_fecha']).'<br/>
								Temporada: '.$row_data['Temporada'].'<br/>
							</td>
								   
							<td style="vertical-align: top;width:33%;">
								Datos Creacion<br/>
								Sistema: '.$row_data['Sistema'].'<br/>
								Usuario: '.$row_data['Usuario'].'<br/>
							</td>
						</tr>
					</tbody>
				</table>
				
				<br/>
				<br/>

				<table class="zebra tableline" style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0" >
					<thead>
						<tr style="background-color: #f9f9f9;">
							<th colspan="2" style="vertical-align: top; width:88%;"><strong>Detalle</strong></th>
							<th style="vertical-align: top; width:12%;"><strong>Valor Total</strong></th>
						</tr>
					</thead>
					<tbody>';
					
					if ($arrTrabajadores) {
						$html .= '<tr class="active"><td colspan="6"><strong>Trabajadores Encargados</strong></td></tr>';
						foreach ($arrTrabajadores as $trab) {
							$html .= '
							<tr>
								<td style="vertical-align: top;">'.$trab['Rut'].'</td>
								<td style="vertical-align: top;">'.$trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat'].'</td>
								<td style="vertical-align: top;">'.$trab['Cargo'].'</td>
							</tr>';
						} 
					}
					if ($arrMaquinas) {
						$html .= '<tr class="active"><td colspan="6"><strong>Maquinas a Utilizar</strong></td></tr>';
						foreach ($arrMaquinas as $maq) {
							$html .= '
							<tr>
								<td colspan="3" style="vertical-align: top;">'.$maq['Codigo'].' - '.$maq['Nombre'].'</td>
							</tr>';
						}
					}
					if ($arrMuestras) {
						$html .= '
							<tr>
								<td colspan="3" style="vertical-align: top;"><strong>Muestras</strong></td>
							</tr>
							<tr>
								<td style="vertical-align: top;">Productor</td>
								<td style="vertical-align: top;">N° Folio / Pallet</td>
								<td style="vertical-align: top;">Lote</td>
							</tr>';
						foreach ($arrMuestras as $muestra) {
							$html .= '
							<tr>
								<td style="vertical-align: top;">'.$muestra['ClienteNombre'].'</td>
								<td style="vertical-align: top;">'.$muestra['n_folio_pallet'].'</td>
								<td style="vertical-align: top;">'.$muestra['lote'].'</td>
							</tr>';
						}
					}
						
				$html .= '
					</tbody>
				</table>
				
				<br/>
				<br/>
				
				<table style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0">
					<tbody><tr><td style="vertical-align: top;">Observaciones:</td></tr></tbody>
				</table>
				<table style="text-align: left; width: 100%;margin-top:20px;" cellpadding="5" cellspacing="0">
					<tbody>
						<tr>
							<td style="vertical-align: top;text-align: left;background-color: #f9f9f9;border: 1px solid #EEE;">'.$row_data['Observaciones'].'</td>
						</tr>
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
$pdf_titulo     = $row_data['TipoAnalisis'];
$pdf_subtitulo  = '';
$pdf_file       = $row_data['TipoAnalisis'].'.pdf';
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
			if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&simpleDecode($_GET['idSistema'], fecha_actual())!=0){
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
