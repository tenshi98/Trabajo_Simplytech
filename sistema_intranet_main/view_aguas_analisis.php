<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Views.php';
/**********************************************************************************************************************************/
/*                                                 Variables Globales                                                             */
/**********************************************************************************************************************************/
//Tiempo Maximo de la consulta, 40 minutos por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim); }else{set_time_limit(2400);}             
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M'); }else{ini_set('memory_limit', '4096M');}  
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Views.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
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
// Se traen todos los datos de mi usuario
$query = "SELECT  
aguas_analisis_aguas.f_muestra,
aguas_analisis_aguas.f_recibida,
aguas_analisis_aguas.codigoProceso,
aguas_analisis_aguas.codigoArchivo,
aguas_analisis_aguas.codigoServicio,
aguas_analisis_aguas.UTM_norte,
aguas_analisis_aguas.UTM_este,
aguas_analisis_aguas.codigoMuestra,
aguas_analisis_aguas.RemuestraFecha,
aguas_analisis_aguas.Remuestra_codigo_muestra,
aguas_analisis_aguas.valorAnalisis,
aguas_analisis_aguas.CodigoLaboratorio,

core_sistemas.Rut AS Rut,
aguas_analisis_sectores.idSector AS CodigoSector,

aguas_analisis_aguas_tipo_punto_muestreo.Nombre AS PuntoMuestreo,
aguas_analisis_aguas_tipo_muestra.Nombre AS TipoMuestra,
aguas_analisis_parametros.Nombre AS Parametro,
aguas_analisis_aguas_signo.Nombre AS Signo,
aguas_analisis_laboratorios.Nombre AS Laboratorio,

core_sistemas.Nombre AS Sistema,
aguas_analisis_sectores.Nombre AS Sector

FROM `aguas_analisis_aguas`
LEFT JOIN `core_sistemas`                              ON core_sistemas.idSistema                                    = aguas_analisis_aguas.idSistema
LEFT JOIN `aguas_analisis_sectores`                    ON aguas_analisis_sectores.idSector                           = aguas_analisis_aguas.idSector
LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo`   ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo   = aguas_analisis_aguas.idPuntoMuestreo
LEFT JOIN `aguas_analisis_aguas_tipo_muestra`          ON aguas_analisis_aguas_tipo_muestra.idTipoMuestra            = aguas_analisis_aguas.idTipoMuestra
LEFT JOIN `aguas_analisis_parametros`                  ON aguas_analisis_parametros.idParametros                     = aguas_analisis_aguas.idParametros
LEFT JOIN `aguas_analisis_aguas_signo`                 ON aguas_analisis_aguas_signo.idSigno                         = aguas_analisis_aguas.idSigno
LEFT JOIN `aguas_analisis_laboratorios`                ON aguas_analisis_laboratorios.idLaboratorio                  = aguas_analisis_aguas.idLaboratorio

WHERE aguas_analisis_aguas.idAnalisisAgua = ".$X_Puntero;
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
$rowdata = mysqli_fetch_assoc ($resultado);	


?>



	
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Informe Fecha <?php echo Fecha_estandar($rowdata['f_muestra']); ?></h5>	
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed dataTable">
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					
					<tr class="odd"><td colspan="2">Datos Basicos</td></tr>	
					<tr class="odd"><td>Fecha muestra:</td>             <td><?php echo fecha_estandar($rowdata['f_muestra']); ?></td></tr>
					<tr class="odd"><td>Periodo muestra:</td>           <td><?php if($rowdata['f_muestra']!='0000-00-00'){echo fecha2Ano($rowdata['f_muestra']).fecha2NMes($rowdata['f_muestra']);} ?></td></tr>
					<tr class="odd"><td>Fecha recibida:</td>            <td><?php echo fecha_estandar($rowdata['f_recibida']); ?></td></tr>
					<tr class="odd"><td>Laboratorio:</td>               <td><?php echo $rowdata['Laboratorio']; ?></td></tr>
					<tr class="odd"><td>Codigo Muestra:</td>            <td><?php echo $rowdata['codigoMuestra']; ?></td></tr>
					<tr class="odd"><td>Codigo Laboratorio:</td>        <td><?php echo $rowdata['CodigoLaboratorio']; ?></td></tr>
					<tr class="odd"><td>Tipo Muestra:</td>              <td><?php echo $rowdata['TipoMuestra']; ?></td></tr>
					<tr class="odd"><td>Fecha Remuestra:</td>           <td><?php echo $rowdata['RemuestraFecha']; ?></td></tr>
					<tr class="odd"><td>Periodo Remuestreo:</td>        <td><?php if($rowdata['RemuestraFecha']!='0000-00-00'){echo fecha2Ano($rowdata['RemuestraFecha']).fecha2NMes($rowdata['RemuestraFecha']);} ?></td></tr>
					<tr class="odd"><td>Codigo Remuestra:</td>          <td><?php echo $rowdata['Remuestra_codigo_muestra']; ?></td></tr>
					<tr class="odd"><td>Parametro analizado:</td>       <td><?php echo $rowdata['Parametro']; ?></td></tr>
					<tr class="odd"><td>Signo:</td>                     <td><?php echo $rowdata['Signo']; ?></td></tr>
					<tr class="odd"><td>Valor Analisis:</td>            <td><?php echo $rowdata['valorAnalisis']; ?></td></tr>
					
					<tr class="odd"><td colspan="2">Datos del Cliente</td></tr>	
					<tr class="odd"><td>Sector:</td>                    <td><?php echo $rowdata['Sector']; ?></td></tr>
					<tr class="odd"><td>Codigo Sector:</td>             <td><?php echo $rowdata['CodigoSector']; ?></td></tr>
					<tr class="odd"><td>UTM Norte:</td>                 <td><?php echo $rowdata['UTM_norte']; ?></td></tr>
					<tr class="odd"><td>UTM Este:</td>                  <td><?php echo $rowdata['UTM_este']; ?></td></tr>
					<tr class="odd"><td>Tipo de Medicion:</td>          <td><?php echo $rowdata['PuntoMuestreo']; ?></td></tr>
					
					<tr class="odd"><td colspan="2">Otros Datos</td></tr>
					<tr class="odd"><td>Codigo Proceso:</td>            <td><?php echo $rowdata['codigoProceso']; ?></td></tr>
					<tr class="odd"><td>Codigo Archivo:</td>            <td><?php echo $rowdata['codigoArchivo']; ?></td></tr>
					<tr class="odd"><td>Rut:</td>                       <td><?php echo $rowdata['Rut']; ?></td></tr>
					<tr class="odd"><td>Codigo Servicio:</td>           <td><?php echo $rowdata['codigoServicio']; ?></td></tr>
					
					                    
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){ 
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
	<?php 
	//para las versiones nuevas que indican donde volver
	}else{ 
		$string = basename($_SERVER["REQUEST_URI"], ".php");
		$array  = explode("&return=", $string, 3);
		$volver = $array[1];
		?>
		<div class="clearfix"></div>
		<div class="col-sm-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
			<div class="clearfix"></div>
		</div>
		
	<?php }		
} ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
