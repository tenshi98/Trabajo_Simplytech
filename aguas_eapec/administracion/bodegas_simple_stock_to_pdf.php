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
$arrProductos = array();
$query = "SELECT
productos_listado.StockLimite,
productos_listado.Nombre AS NombreProd,
productos_tipo_producto.Nombre AS tipo_producto,
productos_uml.Nombre AS UnidadMedida,
SUM(bodegas_facturacion_existencias.Cantidad_ing) AS stock_entrada,
SUM(bodegas_facturacion_existencias.Cantidad_eg) AS stock_salida,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `productos_listado`          ON productos_listado.idProducto             = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`              ON productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `bodegas_listado`            ON bodegas_listado.idBodega                 = bodegas_facturacion_existencias.idBodega
LEFT JOIN `productos_tipo_producto`    ON productos_tipo_producto.idTipoProducto   = productos_listado.idTipoProducto
WHERE bodegas_facturacion_existencias.idBodega={$_GET['idBodega']}
GROUP BY bodegas_facturacion_existencias.idProducto
ORDER BY productos_tipo_producto.Nombre ASC, productos_listado.Nombre ASC";
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
$pdf->SetHeaderData($logo, 40, 'Stock Bodega: '.$arrProductos[0]['NombreBodega'], 'Stock al '.fecha_actual());

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
$pdf->AddPage();

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
			<th>Tipo</th>
			<th>Nombre</th>
			<th>Stock Min</th>
			<th>Stock Actual</th>
		</tr>
	</thead>
	<tbody>';
							
		foreach ($arrProductos as $productos) { 
			$stock_actual = $productos['stock_entrada'] - $productos['stock_salida']; 
			if ($productos['StockLimite']>$stock_actual){$delta = 'destaca';}else{$delta = '';}
			if ($stock_actual!=0&&$productos['NombreProd']!=''){					
				$html .='<tr class="'.$delta.'">
							<td>'.$productos['tipo_producto'].'</td>
							<td>'.$productos['NombreProd'].'</td>
							<td>'.Cantidades_decimales_justos($productos['StockLimite']).' '.$productos['UnidadMedida'].'</td>
							<td>'.Cantidades_decimales_justos($stock_actual).' '.$productos['UnidadMedida'].'</td>
						</tr>';
			}
		}
							
$html .='</tbody>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Stock Bodega '.$arrProductos[0]['NombreBodega'].' al '.fecha_actual().'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
