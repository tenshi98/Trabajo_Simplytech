<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//Se buscan la imagen i el tipo de PDF
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
	$rowEmpresa = db_select_data (false, 'Config_imgLogo, idOpcionesGen_5', 'core_sistemas','', 'idSistema='.$_GET['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');
}
/********************************************************************/
// Se trae un listado con todos los datos
$SIS_query = '
bodegas_insumos_facturacion_existencias.idFacturacion,
bodegas_insumos_facturacion_existencias.Creacion_fecha,
bodegas_insumos_facturacion_existencias.Cantidad_ing,
bodegas_insumos_facturacion_existencias.Cantidad_eg,
bodegas_insumos_facturacion_tipo.Nombre AS TipoMovimiento,
insumos_listado.Nombre AS NombreProducto,
sistema_productos_uml.Nombre AS UnidadMedida,
core_documentos_mercantiles.Nombre AS Documento,
bodegas_insumos_facturacion.N_Doc AS N_Doc,
trabajadores_listado.Nombre AS trab_nombre,
trabajadores_listado.ApellidoPat AS trab_appat,
trabajadores_listado.ApellidoMat AS trab_apmat,
proveedor_listado.Nombre AS Proveedor,
(SELECT Nombre FROM bodegas_insumos_listado WHERE idBodega='.$_GET['idBodega'].' LIMIT 1) AS NombreBodega';
$SIS_join  = '
LEFT JOIN `bodegas_insumos_facturacion_tipo`    ON bodegas_insumos_facturacion_tipo.idTipo       = bodegas_insumos_facturacion_existencias.idTipo
LEFT JOIN `insumos_listado`                     ON insumos_listado.idProducto                    = bodegas_insumos_facturacion_existencias.idProducto
LEFT JOIN `sistema_productos_uml`               ON sistema_productos_uml.idUml                   = insumos_listado.idUml
LEFT JOIN `bodegas_insumos_facturacion`         ON bodegas_insumos_facturacion.idFacturacion     = bodegas_insumos_facturacion_existencias.idFacturacion
LEFT JOIN `core_documentos_mercantiles`         ON core_documentos_mercantiles.idDocumentos      = bodegas_insumos_facturacion.idDocumentos
LEFT JOIN `proveedor_listado`                   ON proveedor_listado.idProveedor                 = bodegas_insumos_facturacion.idProveedor
LEFT JOIN `trabajadores_listado`                ON trabajadores_listado.idTrabajador             = bodegas_insumos_facturacion.idTrabajador';
$SIS_where = 'bodegas_insumos_facturacion_existencias.idProducto='.$_GET['view'];
$SIS_where.= ' AND bodegas_insumos_facturacion_existencias.idBodega='.$_GET['idBodega'];
$SIS_order = 'bodegas_insumos_facturacion_existencias.Creacion_fecha DESC';
$SIS_order.= ' LIMIT 100';
$arrProductos = array();
$arrProductos = db_select_array (false, $SIS_query, 'bodegas_insumos_facturacion_existencias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrProductos');

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
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Movimiento</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Proveedor/Cliente</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Documento</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Fecha</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Cant Ing</th>
			<th style="font-size: 10px;border-bottom: 1px solid black;text-align:center;background-color: #c3c3c3;">Cant eg</th>
		</tr>
	</thead>
	<tbody>';

		foreach ($arrProductos as $productos) { 
			
			if(isset($productos['Proveedor'])&&$productos['Proveedor']){
				$empresa = 'Proveedor : '.$productos['Proveedor'];
				$ndoc    = $productos['Documento'].' N° '.$productos['N_Doc'];
			}else{
				$empresa = 'Trabajador : '.$productos['trab_nombre'].' '.$productos['trab_appat'].' '.$productos['trab_apmat'];
				$ndoc    = 'Documento N° '.$productos['idFacturacion'];
			}
								
			$html .='<tr>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.DeSanitizar($productos['TipoMovimiento']).'</td>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.DeSanitizar($empresa).'</td>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.DeSanitizar($ndoc).'</td>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Fecha_estandar($productos['Creacion_fecha']).'</td>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($productos['Cantidad_ing']).' '.$productos['UnidadMedida'].'</td>
						<td style="font-size: 10px;border-bottom: 1px solid black;text-align:center">'.Cantidades_decimales_justos($productos['Cantidad_eg']).' '.$productos['UnidadMedida'].'</td>
					</tr>';
		}

$html .='</tbody>
</table>';
   


/**********************************************************************************************************************************/
/*                                                          Impresion PDF                                                         */
/**********************************************************************************************************************************/
//Config
$pdf_titulo     = 'Movimientos Bodega: '.DeSanitizar($arrProductos[0]['NombreBodega']).' (ultimos 100 registros)';
$pdf_subtitulo  = 'Insumo: '.DeSanitizar($arrProductos[0]['NombreProducto']);
$pdf_file       = 'Movimiento Insumo '.DeSanitizar($arrProductos[0]['NombreProducto']).' Bodega '.DeSanitizar($arrProductos[0]['NombreBodega']).' ultimos 100 registros.pdf';
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
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			//Se crea el archivo
			$pdf->SetFont('helvetica', '', 10);
			$pdf->AddPage($OpcTcpOrt, $OpcTcpPg);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->lastPage();
			$pdf->Output(DeSanitizar($pdf_file), 'I');

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
			$dompdf->stream(DeSanitizar($pdf_file));
			break;

	}
}

?>
