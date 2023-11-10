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
require_once 'core/Load.Utils.Excel.php';
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
//obtengo los datos de la empresa
$rowEmpresa = db_select_data (false, 'Nombre', 'core_sistemas','', 'idSistema='.$_GET['idSistema'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowEmpresa');

//Verifico el tipo de usuario que esta ingresando
$z = "WHERE aguas_analisis_aguas.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];
//Filtros
if (isset($_GET['idSector']) && $_GET['idSector']!=''){         
	$z .=" AND aguas_analisis_aguas.idSector='".$_GET['idSector']."'";
}
if (isset($_GET['idPuntoMuestreo']) && $_GET['idPuntoMuestreo']!=''){  
	$z .=" AND aguas_analisis_aguas.idPuntoMuestreo='".$_GET['idPuntoMuestreo']."'";
}
if (isset($_GET['idTipoMuestra']) && $_GET['idTipoMuestra']!=''){      
	$z .=" AND aguas_analisis_aguas.idTipoMuestra='".$_GET['idTipoMuestra']."'";
}
if (isset($_GET['idParametros']) && $_GET['idParametros']!=''){
	$z .=" AND aguas_analisis_aguas.idParametros='".$_GET['idParametros']."'";
}
if (isset($_GET['idSigno']) && $_GET['idSigno']!=''){           
	$z .=" AND aguas_analisis_aguas.idSigno='".$_GET['idSigno']."'";
}
if (isset($_GET['idLaboratorio']) && $_GET['idLaboratorio']!=''){      
	$z .=" AND aguas_analisis_aguas.idLaboratorio='".$_GET['idLaboratorio']."'";
}
if(isset($_GET['f_muestra_inicio'], $_GET['f_muestra_termino']) && $_GET['f_muestra_inicio'] != '' && $_GET['f_muestra_termino']!=''){
	$z .= " AND aguas_analisis_aguas.f_muestra BETWEEN '".$_GET['f_muestra_inicio']."' AND '".$_GET['f_muestra_termino']."'";
}
if(isset($_GET['f_recibida_inicio'], $_GET['f_recibida_termino']) && $_GET['f_recibida_inicio'] != '' && $_GET['f_recibida_termino']!=''){
	$z .= " AND aguas_analisis_aguas.f_recibida BETWEEN '".$_GET['f_recibida_inicio']."' AND '".$_GET['f_recibida_termino']."'";
}

// Se trae un listado con todos los elementos
$arrProductos = array();
$query = "SELECT 
aguas_analisis_aguas.codigoProceso,
aguas_analisis_aguas.codigoArchivo,
core_sistemas.Rut AS rut,
aguas_analisis_aguas.f_recibida AS periodo,
aguas_analisis_aguas.codigoServicio AS codigo_servicio,
aguas_analisis_aguas.idSector AS codigo_sector,
aguas_analisis_aguas.codigoMuestra AS codigo_muestra,
aguas_analisis_aguas_tipo_punto_muestreo.Codigo AS tipo_punto_muestreo,
aguas_analisis_aguas.UTM_norte,
aguas_analisis_aguas.UTM_este,
aguas_analisis_aguas_tipo_muestra.Codigo AS tipo_muestra,
aguas_analisis_aguas.RemuestraFecha AS periodo_remuestreo,
aguas_analisis_aguas.f_muestra AS fecha_muestra,
aguas_analisis_parametros.Codigo AS codigo_parametro,
aguas_analisis_aguas_signo.Codigo AS signo,
aguas_analisis_aguas.valorAnalisis AS valor,
aguas_analisis_laboratorios.Rut AS rutLaboratorio,
aguas_analisis_laboratorios.Codigo AS idLaboratorio,
aguas_clientes_listado.Identificador

FROM `aguas_analisis_aguas`
LEFT JOIN `core_sistemas`                               ON core_sistemas.idSistema                                       = aguas_analisis_aguas.idSistema
LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo`    ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo      = aguas_analisis_aguas.idPuntoMuestreo
LEFT JOIN `aguas_analisis_aguas_tipo_muestra`           ON aguas_analisis_aguas_tipo_muestra.idTipoMuestra               = aguas_analisis_aguas.idTipoMuestra
LEFT JOIN `aguas_analisis_parametros`                   ON aguas_analisis_parametros.idParametros                        = aguas_analisis_aguas.idParametros
LEFT JOIN `aguas_analisis_aguas_signo`                  ON aguas_analisis_aguas_signo.idSigno                            = aguas_analisis_aguas.idSigno
LEFT JOIN `aguas_analisis_laboratorios`                 ON aguas_analisis_laboratorios.idLaboratorio                     = aguas_analisis_aguas.idLaboratorio
LEFT JOIN `aguas_clientes_listado`                      ON aguas_clientes_listado.idCliente                              = aguas_analisis_aguas.idCliente

".$z."
ORDER BY aguas_analisis_aguas.f_recibida ASC ";
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
while ( $row = mysqli_fetch_assoc ($resultado)){
array_push( $arrProductos,$row );
}


/***********************************************************************************/
//Exporto a XML
/************************************/
//Normalizo
$codigoArchivo = $arrProductos[0]['codigoArchivo'];
$codigoProceso = $arrProductos[0]['codigoProceso'];
$periodo = fecha2Ano($arrProductos[0]['periodo']).fecha2NdiaMesCon0($arrProductos[0]['periodo']);
$rut = cortarRut($arrProductos[0]['rut']);
$codigo_servicio = $arrProductos[0]['codigoProceso'];
$codigo_sector = $arrProductos[0]['codigo_sector'];
/************************************/


$xmlstr =
'<?xml version="1.0" encoding="iso-8859-1"?>
<Sinar codigoArchivo="'.$codigoArchivo.'" codigoProceso="'.$codigoProceso.'">
    <Empresa periodo="'.$periodo.'" rut="'.$rut.'">
        <Servicio codigo_servicio="'.$codigo_servicio.'">';
        
			filtrar($arrProductos, 'codigo_sector');  
			foreach($arrProductos as $codigo_sector=>$sec_list){
				$xmlstr .= '<Sector codigo_sector="'.$codigo_sector.'">';
				foreach ($sec_list as $productos) {
					$xmlstr .= '
					<Muestra UTM_este="'.$productos['UTM_este'].'" UTM_norte="'.$productos['UTM_norte'].'" codigo_muestra="'.$productos['codigo_muestra'].'" tipo_muestra="'.$productos['tipo_muestra'].'" tipo_punto_muestreo="'.$productos['tipo_punto_muestreo'].'">
						<fecha_muestra>'.$productos['fecha_muestra'].'</fecha_muestra>
						<Parametro codigo_parametro="'.$productos['codigo_parametro'].'" signo="'.$productos['signo'].'">
							<valor>'.Cantidades_decimales_justos($productos['valor']).'</valor>
							<Laboratorio idLaboratorio="'.$productos['idLaboratorio'].'" rutLaboratorio="'.$productos['rutLaboratorio'].'"/>
						</Parametro>
					</Muestra>';
				}
				$xmlstr .= '</Sector>';		
			}
			$xmlstr .= '
        </Servicio>
    </Empresa>
</Sinar>';	


$xml = new SimpleXMLElement($xmlstr);
header("Content-type: text/xml");
header('Content-Desposition: attachment; filename="foobar.xml"');
echo $xml->asXML();
//exit();


?>
