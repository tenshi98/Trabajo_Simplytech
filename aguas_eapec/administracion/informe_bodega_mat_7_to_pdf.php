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

// Se trae un listado con todos los datos
$arrProductos = array();
$query = "SELECT 
bodegas_facturacion_existencias.Creacion_fecha,
bodegas_facturacion_existencias.Cantidad_eg,
bodegas_facturacion_tipo.Nombre AS TipoMovimiento,
productos_listado.Nombre AS NombreProducto,
productos_uml.Nombre AS UnidadMedida,
bodegas_documentos_mercantiles.Nombre AS Documento,
bodegas_facturacion.N_Doc AS N_Doc,
clientes_listado.Nombre AS Cliente,
bodegas_listado.Nombre AS NombreBodega

FROM `bodegas_facturacion_existencias`
LEFT JOIN `bodegas_facturacion_tipo`          ON bodegas_facturacion_tipo.idTipo               = bodegas_facturacion_existencias.idTipo
LEFT JOIN `productos_listado`                 ON productos_listado.idProducto                  = bodegas_facturacion_existencias.idProducto
LEFT JOIN `productos_uml`                     ON productos_uml.idUml                           = productos_listado.idUml
LEFT JOIN `bodegas_facturacion`               ON bodegas_facturacion.idFacturacion             = bodegas_facturacion_existencias.idFacturacion
LEFT JOIN `bodegas_documentos_mercantiles`    ON bodegas_documentos_mercantiles.idDocumentos   = bodegas_facturacion.idDocumentos
LEFT JOIN `clientes_listado`                  ON clientes_listado.idCliente                    = bodegas_facturacion.idCliente
LEFT JOIN `bodegas_listado`                   ON bodegas_listado.idBodega                      = bodegas_facturacion_existencias.idBodega

WHERE bodegas_facturacion.idCliente={$_GET['idCliente']}  
AND bodegas_facturacion_existencias.Creacion_fecha BETWEEN '{$_GET['f_inicio']}' AND '{$_GET['f_termino']}'
ORDER BY bodegas_facturacion_existencias.Creacion_fecha DESC ";
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
$pdf->SetHeaderData($logo, 40, 'Movimientos Cliente: '.$arrProductos[0]['Cliente'], 'Registros entre fechas '.Fecha_estandar($_GET['f_inicio']).' al '.Fecha_estandar($_GET['f_termino']) );

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
			<th>Bodega</th>
			<th>Producto</th>
			<th>Movimiento</th>
			<th>Documento</th>
			<th>Fecha</th>
			<th>Cant eg</th>
		</tr>
	</thead>
	<tbody>';
							
		foreach ($arrProductos as $productos) { 
			
								
			$html .='<tr>
						<td>'.$productos['NombreBodega'].'</td>
						<td>'.$productos['NombreProducto'].'</td>
						<td>'.$productos['TipoMovimiento'].'</td>
						<td>'.$productos['Documento'].' N° '.$productos['N_Doc'].'</td>
						<td>'.Fecha_estandar($productos['Creacion_fecha']).'</td>
						<td>'.Cantidades_decimales_justos($productos['Cantidad_eg']).' '.$productos['UnidadMedida'].'</td>
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
$pdf->Output('Movimiento Cliente '.$arrProductos[0]['Cliente'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
