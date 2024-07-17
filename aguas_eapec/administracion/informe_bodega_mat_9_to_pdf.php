<?php
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
// obtengo puntero de conexion con la db
$dbConn = conectar();
/**********************************************************************************************************************************/
/*                                                          Consultas                                                             */
/**********************************************************************************************************************************/
//obtengo los datos de la empresa
$query = "SELECT imgLogo	
FROM `core_sistemas` 
WHERE idSistema = '{$_GET['idSistema']}'  ";
$resultado = mysqli_query ($dbConn, $query);
$rowEmpresa = mysqli_fetch_array ($resultado);

//verifico que sea un administrador
if(isset($_GET['idSistema'])&&$_GET['idSistema']!=''&&$_GET['idSistema']!=0){
	$w = "bodegas_facturacion.idSistema={$_GET['idSistema']}";
}else{	
	$w = "bodegas_facturacion.idSistema>=0";	
}
// Se trae un listado con todos los productos
$arrProductos = array();
$query = "SELECT 
origen.Nombre AS BodegaOrigen,
destino.Nombre AS BodegaDestino,
core_sistemas.Nombre AS SistemaDestino,
bodegas_facturacion_existencias.idFacturacion,
bodegas_facturacion_existencias.Creacion_fecha,
productos_listado.Nombre AS Producto,
SUM(bodegas_facturacion_existencias.Cantidad_eg) AS Engreso,
productos_uml.Nombre AS Uml,
productos_listado.ValorIngreso

FROM bodegas_facturacion_existencias 
LEFT JOIN bodegas_facturacion        ON bodegas_facturacion.idFacturacion    = bodegas_facturacion_existencias.idFacturacion
LEFT JOIN bodegas_listado   origen   ON origen.idBodega                      = bodegas_facturacion.idBodegaOrigen
LEFT JOIN bodegas_listado   destino  ON destino.idBodega                     = bodegas_facturacion.idBodegaDestino
LEFT JOIN core_sistemas              ON core_sistemas.idSistema              = bodegas_facturacion.idSistemaDestino
LEFT JOIN productos_listado          ON productos_listado.idProducto         = bodegas_facturacion_existencias.idProducto
LEFT JOIN productos_uml              ON productos_uml.idUml                  = productos_listado.idUml

WHERE  bodegas_facturacion.idBodegaOrigen={$_GET['idBodegaOrigen']} 
AND  ".$w." 
AND  bodegas_facturacion.idBodegaDestino={$_GET['idBodegaDestino']} 
AND  bodegas_facturacion.idSistemaDestino={$_GET['idSistemaDestino']} 
AND  bodegas_facturacion_existencias.Creacion_fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'
GROUP BY bodegas_facturacion_existencias.idFacturacion ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrProductos,$row );
} 
/**********************************************************************************************************************************/
/*                                                          Libreria PDF                                                          */
/**********************************************************************************************************************************/

require_once('lib_tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Victor Reyes');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
if(isset($rowEmpresa['imgLogo'])&&$rowEmpresa['imgLogo']!=''){
	$logo = '../../../upload/'.$rowEmpresa['imgLogo'];
}else{
	$logo = '../../../img/logoempresa.jpg';
}
$pdf->SetHeaderData($logo, 40, 'Traspaso Productos Bodega '.$arrProductos[0]['BodegaOrigen'].' a Bodega '.$arrProductos[0]['BodegaDestino'].' de '.$arrProductos[0]['SistemaDestino'], 'Registros entre fechas '.Fecha_estandar($_GET['f_inicio']).' al '.Fecha_estandar($_GET['f_termino']));

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

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
// $pdf->AddPage();
$pdf->AddPage('L', 'A4');//vista horizontal

// define some HTML content with style
$html = '
<style>

.table-bordered {
    border: 1px solid #DDD;
}
.table {
    width: 100%;
}
table {
    max-width: 100%;
    background-color: transparent;
}
table {
    border-spacing: 0px;
    border-collapse: collapse;
}
.table > thead > tr > th {
    vertical-align: bottom;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 8px;
    vertical-align: top;
}
th {
    text-align: left;
}
td, th {
    padding: 0px;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 8px;
    line-height: 1.42857;
    vertical-align: top;
}
td, th {
    padding: 0px;
}
.clear{
   clear:both;
}
.destaca{
	background-color:#F2DEDE;
}
.titulo{
	background-color:#DDD;
}
table tr td{	
	border-bottom: 1px solid #DDD;	
}
</style>';


$html .= '
<table class="table table-bordered">
	<thead>
		<tr class="titulo">
			<th>Fecha</th>
			<th>Documento n°</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Unidad de Medida</th>
			<th>V/Unitario</th>
			<th>V/Total</th>		
		</tr>
	</thead>
	<tbody>';
	
				
		foreach ($arrProductos as $productos) { 
							
			$html .='<tr>
						<td>'.Fecha_estandar($productos['Creacion_fecha']).'</td>
						<td>Traspaso N° '.$productos['idFacturacion'].'</td>
						<td>'.$productos['Producto'].'</td>
						<td>'.cantidades_excel($productos['Engreso']).'</td>
						<td>'.$productos['Uml'].'</td>
						<td>'.Valores_sd($productos['ValorIngreso']).'</td>
						<td>'.Valores_sd($productos['Engreso']*$productos['ValorIngreso']).'</td>
					</tr>';
		}
							
$html .='</tbody>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Traspaso Productos Bodega '.$arrProductos[0]['BodegaOrigen'].' a Bodega '.$arrProductos[0]['BodegaDestino'].' de '.$arrProductos[0]['SistemaDestino'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
