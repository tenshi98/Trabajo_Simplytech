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
//Se traen todos los datos
$query = "SELECT AguasInfFechaEmision, ClienteIdentificador, ClienteDireccion, DetalleTotalAPagar, DetalleSaldoAnterior
FROM `facturacion_listado_detalle`
WHERE idFacturacionDetalle = {$_GET['view']} ";
$resultado = mysqli_query ($dbConn, $query);
$rowDatos = mysqli_fetch_assoc ($resultado);

$dia = Fecha_dia($rowDatos['AguasInfFechaEmision']);
$dia = $dia + 17;
$output = 'Carta de Corte cliente '.$rowDatos['ClienteIdentificador'].' fecha '.Fecha_estandar($rowDatos['AguasInfFechaEmision']);

//se crea una fecha
$mes_ant = Fecha_mes_n($rowDatos['AguasInfFechaEmision']);
$mes_ant = $mes_ant - 1;
$ano = Fecha_año($rowDatos['AguasInfFechaEmision']);
//se realizan correcciones
if($mes_ant==0){
	$mes_ant = 12;
	$ano = $ano - 1;
}

$fecha_mesanterior = $ano.'-'.$mes_ant.'-10';



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>sin título</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 1.25" />
		
	</head>

	<body>
		
		<button onclick="closemyself()">Cerrar pestaña</button>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.17.9/docxtemplater.js"></script>
		<script src="https://unpkg.com/pizzip@3.0.6/dist/pizzip.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
		<script src="https://unpkg.com/pizzip@3.0.6/dist/pizzip-utils.js"></script>
		<!--
		Mandatory in IE 6, 7, 8 and 9.
		-->
		<!--[if IE]>
			<script type="text/javascript" src="https://unpkg.com/pizzip@3.0.6/dist/pizzip-utils-ie.js"></script>
		<![endif]-->
		<script>
			//se ejecuta al cargar la página (OBLIGATORIO)
			/*$(document).ready(function(){
				generate();
			}); */
			window.onload = (event) => {
				generate();
			};				
			function loadFile(url,callback){
				PizZipUtils.getBinaryContent(url,callback);
			}
			function closemyself() {
				window.opener=self;
				window.close();
				//self.close();
			}
			function generate() {
				
				loadFile("lib_PHP2Word/doc/notificacion.docx",function(error,content){
					if (error) { throw error };

					// The error object contains additional information when logged with JSON.stringify (it contains a properties object containing all suberrors).
					function replaceErrors(key, value) {
						if (value instanceof Error) {
							return Object.getOwnPropertyNames(value).reduce(function(error, key) {
								error[key] = value[key];
								return error;
							}, {});
						}
						return value;
					}

					function errorHandler(error) {
						console.log(JSON.stringify({error: error}, replaceErrors));

						if (error.properties && error.properties.errors instanceof Array) {
							const errorMessages = error.properties.errors.map(function (error) {
								return error.properties.explanation;
							}).join("\n");
							console.log('errorMessages', errorMessages);
							// errorMessages is a humanly readable message looking like this :
							// 'The tag beginning with "foobar" is unopened'
						}
						throw error;
					}

					var zip = new PizZip(content);
					var doc;
					try {
						doc=new window.docxtemplater(zip);
					} catch(error) {
						// Catch compilation errors (errors caused by the compilation of the template : misplaced tags)
						errorHandler(error);
					}

					doc.setData({
						fecha_aviso: '<?php echo Fecha_completa_alt($rowDatos['AguasInfFechaEmision']); ?>',
						mes_anterior: '<?php echo Fecha_completa_alt($fecha_mesanterior); ?>',
						id_cliente: '<?php echo $rowDatos['ClienteIdentificador']; ?>',
						direccion: '<?php echo $rowDatos['ClienteDireccion']; ?>',
						monto: '<?php echo Valores($rowDatos['DetalleSaldoAnterior'], 0); ?>',
						fecha_corte: '<?php echo $dia." de ".Fecha_mes($rowDatos['AguasInfFechaEmision']); ?>'
					});
		
					try {
						// render the document (replace all occurences of {first_name} by John, {last_name} by Doe, ...)
						doc.render();
					}catch (error) {
						// Catch rendering errors (errors relating to the rendering of the template : angularParser throws an error)
						errorHandler(error);
					}

					var out=doc.getZip().generate({
						type:"blob",
						mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
					}) //Output the document using Data-URI
					saveAs(out,"<?php echo $output; ?>.docx");
					setTimeout('closemyself()',2000);
				})
			}
		</script>
		
	</body>
</html>

















