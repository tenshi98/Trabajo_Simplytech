<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Print.php';
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
// Se trae un listado con todos los usuarios
$query = "SELECT 
orden_trabajo_tareas_listado.idOT,
orden_trabajo_tareas_listado.f_creacion,
orden_trabajo_tareas_listado.f_programacion,
orden_trabajo_tareas_listado.f_termino,
orden_trabajo_tareas_listado.horaProg,
orden_trabajo_tareas_listado.horaInicio,
orden_trabajo_tareas_listado.horaTermino,
orden_trabajo_tareas_listado.Observaciones,
orden_trabajo_tareas_listado.idEstado,

core_estado_ot.Nombre AS NombreEstado,
core_ot_prioridad.Nombre AS NombrePrioridad,
core_ot_tipos.Nombre AS NombreTipo,
orden_trabajo_tareas_listado.idSupervisor,
trabajadores_listado.Nombre AS NombreTrab,
trabajadores_listado.ApellidoPat,


FROM `orden_trabajo_tareas_listado`
LEFT JOIN `core_estado_ot`             ON core_estado_ot.idEstado               = orden_trabajo_tareas_listado.idEstado
LEFT JOIN `core_ot_prioridad`          ON core_ot_prioridad.idPrioridad         = orden_trabajo_tareas_listado.idPrioridad
LEFT JOIN `core_ot_tipos`              ON core_ot_tipos.idTipo                  = orden_trabajo_tareas_listado.idTipo
LEFT JOIN `trabajadores_listado`       ON trabajadores_listado.idUbicacion     = orden_trabajo_tareas_listado.idUbicacion
LEFT JOIN `trabajadores_listado`       ON trabajadores_listado.idUbicacion_lvl_1     = orden_trabajo_tareas_listado.idUbicacion_lvl_1
LEFT JOIN `trabajadores_listado`       ON trabajadores_listado.idTrabajador     = orden_trabajo_tareas_listado.idSupervisor
LEFT JOIN `trabajadores_listado`       ON trabajadores_listado.idTrabajador     = orden_trabajo_tareas_listado.idSupervisor
LEFT JOIN `trabajadores_listado`       ON trabajadores_listado.idTrabajador     = orden_trabajo_tareas_listado.idSupervisor
LEFT JOIN `trabajadores_listado`       ON trabajadores_listado.idTrabajador     = orden_trabajo_tareas_listado.idSupervisor

WHERE orden_trabajo_tareas_listado.idOT = ".$X_Puntero;
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

//Se traen a todos los trabajadores relacionados a las ot
$arrTrabajadores = array();
$query = "SELECT 
trabajadores_listado.Nombre,
trabajadores_listado.ApellidoPat,
trabajadores_listado.ApellidoMat,
trabajadores_listado.Cargo, 
trabajadores_listado.Rut

FROM `orden_trabajo_tareas_listado_responsable`
LEFT JOIN `trabajadores_listado`   ON trabajadores_listado.idTrabajador     = orden_trabajo_tareas_listado_responsable.idTrabajador
WHERE orden_trabajo_tareas_listado_responsable.idOT = ".$X_Puntero."
ORDER BY trabajadores_listado.ApellidoPat ASC ";
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

//Si la OT solo esta programada
if(isset($rowdata['idEstado'])&&$rowdata['idEstado']!=''&&$rowdata['idEstado']==1){
	
	// Se trae un listado con todos los insumos utilizados
	$arrInsumos = array();
	$query = "SELECT 
	insumos_listado.Nombre AS NombreProducto,
	sistema_productos_uml.Nombre AS UnidadMedida,
	orden_trabajo_tareas_listado_insumos.Cantidad

	FROM `orden_trabajo_tareas_listado_insumos`
	LEFT JOIN `insumos_listado`         ON insumos_listado.idProducto    = orden_trabajo_tareas_listado_insumos.idProducto
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml   = insumos_listado.idUml
	WHERE orden_trabajo_tareas_listado_insumos.idOT = ".$X_Puntero."
	ORDER BY insumos_listado.Nombre ASC ";
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
	array_push( $arrInsumos,$row );
	}
	
	// Se trae un listado con todos los productos utilizados
	$arrProductos = array();
	$query = "SELECT 
	productos_listado.Nombre AS NombreProducto,
	sistema_productos_uml.Nombre AS UnidadMedida,
	orden_trabajo_tareas_listado_productos.Cantidad AS Cantidad

	FROM `orden_trabajo_tareas_listado_productos`
	LEFT JOIN `productos_listado`       ON productos_listado.idProducto    = orden_trabajo_tareas_listado_productos.idProducto
	LEFT JOIN `sistema_productos_uml`   ON sistema_productos_uml.idUml     = productos_listado.idUml
	WHERE orden_trabajo_tareas_listado_productos.idOT = ".$X_Puntero."
	ORDER BY productos_listado.Nombre ASC ";
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
	array_push( $arrProductos,$row );
	} 

//Si ya esta ejecutada	
}else{
	
	// Se trae un listado con todos los productos utilizados
	$arrInsumos = array();
	$query = "SELECT 
	insumos_listado.Nombre AS NombreProducto,
	sistema_productos_uml.Nombre AS UnidadMedida,
	bodegas_insumos_facturacion_existencias.Cantidad_eg AS Cantidad,
	bodegas_insumos_listado.Nombre AS NombreBodega
	
	FROM `bodegas_insumos_facturacion_existencias` 
	LEFT JOIN `insumos_listado`            ON insumos_listado.idProducto           = bodegas_insumos_facturacion_existencias.idProducto
	LEFT JOIN `sistema_productos_uml`      ON sistema_productos_uml.idUml          = insumos_listado.idUml
	LEFT JOIN `bodegas_insumos_listado`    ON bodegas_insumos_listado.idBodega     = bodegas_insumos_facturacion_existencias.idBodega
	WHERE bodegas_insumos_facturacion_existencias.idOT = ".$X_Puntero;
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
	array_push( $arrInsumos,$row );
	}
	
	// Se trae un listado con todos los productos utilizados
	$arrProductos = array();
	$query = "SELECT 
	productos_listado.Nombre AS NombreProducto,
	sistema_productos_uml.Nombre AS UnidadMedida,
	bodegas_productos_facturacion_existencias.Cantidad_eg AS Cantidad,
	bodegas_productos_listado.Nombre AS NombreBodega
	
	FROM `bodegas_productos_facturacion_existencias` 
	LEFT JOIN `productos_listado`            ON productos_listado.idProducto           = bodegas_productos_facturacion_existencias.idProducto
	LEFT JOIN `sistema_productos_uml`        ON sistema_productos_uml.idUml            = productos_listado.idUml
	LEFT JOIN `bodegas_productos_listado`    ON bodegas_productos_listado.idBodega     = bodegas_productos_facturacion_existencias.idBodega
	WHERE bodegas_productos_facturacion_existencias.idOT = ".$X_Puntero;
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
	array_push( $arrProductos,$row );
	}
}


// Se trae un listado con todos los trabajos relacionados a la orden
$arrTrabajo = array();
$query = "SELECT 
orden_trabajo_tareas_listado_trabajos.NombreComponente,
orden_trabajo_tareas_listado_trabajos.NombreTrabajo,
orden_trabajo_tareas_listado_trabajos.idSubTipo,
orden_trabajo_tareas_listado_trabajos.Grasa_inicial,
orden_trabajo_tareas_listado_trabajos.Grasa_relubricacion,
orden_trabajo_tareas_listado_trabajos.Aceite,
orden_trabajo_tareas_listado_trabajos.Cantidad,
orden_trabajo_tareas_listado_trabajos.idTrabajo,
orden_trabajo_tareas_listado_trabajos.Observacion, 
orden_trabajo_tareas_listado_trabajos.idAnalisis,
productos_listado.Nombre AS NombreProducto,
sistema_productos_uml.Nombre AS NombreUnidad

FROM `orden_trabajo_tareas_listado_trabajos`
LEFT JOIN `productos_listado`      ON productos_listado.idProducto      = orden_trabajo_tareas_listado_trabajos.idProducto
LEFT JOIN `sistema_productos_uml`  ON sistema_productos_uml.idUml  = orden_trabajo_tareas_listado_trabajos.idUml

WHERE idOT = ".$X_Puntero."
ORDER BY NombreComponente ASC, NombreTrabajo ASC ";
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
array_push( $arrTrabajo,$row );
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Print.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
$html = '<style>
#address {
    height: auto !important;
}
.otdata td {
    text-align: left !important;
}
.otdata{
	width: 65% !important;
}
.otdata2{
	width: 30% !important;
}

</style> 
<div class="col-sm-11 fcenter table-responsive">

<div id="page-wrap">
    <div id="header"> ORDEN DE TRABAJO N° '.n_doc($X_Puntero, 8).'</div>
   

    <div id="customer">
        
        <table id="meta" class="fleft otdata">
            <tbody>
				<tr>
                    <td class="meta-head"><strong>DATOS BASICOS</strong></td>
                    <td class="meta-head"></td>
                </tr>';
				if(isset($rowdata['ClienteNombre'])&&$rowdata['ClienteNombre']!=''){
					$html .='<tr>
						<td class="meta-head">'.$x_column_cliente_sing.'</td>
						<td>'.$rowdata['ClienteNombre'].'</td>
					</tr>';
				}
				$html .='
				<tr>
                    <td class="meta-head">'.$x_column_maquina_sing.'</td>
                    <td>'.$rowdata['NombreMaquina'].'</td>
                </tr>
				<tr>
                    <td class="meta-head">Prioridad</td>
                    <td>'.$rowdata['NombrePrioridad'].'</td>
                </tr>
				<tr>
                    <td class="meta-head">Tipo de Trabajo</td>
                    <td>'.$rowdata['NombreTipo'].'</td>
                </tr>
				<tr>
                    <td class="meta-head">Estado</td>
                    <td>'.$rowdata['NombreEstado'].'</td>
                </tr>';
				
				if(isset($rowdata['idSupervisor'])&&$rowdata['idSupervisor']!=''&&$rowdata['idSupervisor']!=0){
					$html .='<tr>
						<td class="meta-head">Supervisor</td>
						<td>'.$rowdata['NombreTrab'].' '.$rowdata['ApellidoPat'].'</td>
					</tr>';
				}
				
				
				
				
            $html .='</tbody>
        </table>
        <table id="meta" class="otdata2">
            <tbody>';
                
				if($rowdata['f_creacion']!='0000-00-00'){
					$html .='<tr>
						<td class="meta-head">Fecha creacion</td>
						<td>'.Fecha_estandar($rowdata['f_creacion']).'</td>
					</tr>';
				}
				
				if($rowdata['f_programacion']!='0000-00-00'){
					$html .='<tr>
						<td class="meta-head">Fecha programada</td>
						<td>'.Fecha_estandar($rowdata['f_programacion']).'</td>
					</tr>';
				}
				
				if($rowdata['f_termino']!='0000-00-00'){
					$html .='<tr>
						<td class="meta-head">Fecha termino</td>
						<td>'.Fecha_estandar($rowdata['f_termino']).'</td>
					</tr>';
				}
				
				if($rowdata['horaInicio']!='00:00:00'){
					$html .='<tr>
						<td class="meta-head">Hora inicio</td>
						<td>'.$rowdata['horaInicio'].'</td>
					</tr>';
				}
				
				if($rowdata['horaTermino']!='00:00:00'){
					$html .='<tr>
						<td class="meta-head">Hora termino</td>
						<td>'.$rowdata['horaTermino'].'</td>
					</tr>';
				}
				
				if($rowdata['horaProg']!='00:00:00'){
					$html .='<tr>
						<td class="meta-head">Tiempo Programado</td>
						<td>'.$rowdata['horaProg'].'</td>
					</tr>';
				}
				
            $html .='</tbody>
        </table>
    </div>
    <table id="items">
        <tbody>
            
			<tr><th colspan="6">Detalle</th></tr>';		  
            

			/**********************************************************************************/
            $html .='<tr class="item-row fact_tittle"><td colspan="6">Trabajadores</td></tr>';
			foreach ($arrTrabajadores as $trab) { 
				$html .='<tr class="item-row linea_punteada">
					<td class="item-name">'.$trab['Rut'].'</td>
					<td class="item-name" colspan="4">'.$trab['Nombre'].' '.$trab['ApellidoPat'].' '.$trab['ApellidoMat'].'</td>
					<td class="item-name">'.$trab['Cargo'].'</td> 
				</tr>';
			}
			$html .='<tr id="hiderow"><td colspan="6"></td></tr>';
            /**********************************************************************************/
            if(!empty($arrInsumos)) {
				$html .='<tr class="item-row fact_tittle"><td colspan="6">';
				if(isset($rowdata['idEstado'])&&$rowdata['idEstado']==1){$html .='Insumos Programados';}else{$html .='Insumos Utilizados';}
				$html .='</td></tr>';
				foreach ($arrInsumos as $insumos) {
					if(isset($insumos['Cantidad'])&&$insumos['Cantidad']!=0){
						$html .='<tr class="item-row linea_punteada">
							<td class="item-name" colspan="5">'.$insumos['NombreProducto'];
							if(isset($rowdata['NombreBodega'])&&$rowdata['NombreBodega']!=''){$html .=' - '.$insumos['NombreBodega'];}
							$html .='</td>
							<td class="item-name">'.Cantidades_decimales_justos($insumos['Cantidad']).' '.$insumos['UnidadMedida'].'</td>	
						</tr>';
					}
				}
				$html .='<tr id="hiderow"><td colspan="6"></td></tr>';
			}
            /**********************************************************************************/
            if(!empty($arrProductos)) {
				$html .='<tr class="item-row fact_tittle"><td colspan="6">';
				if(isset($rowdata['idEstado'])&&$rowdata['idEstado']==1){$html .='Productos Programados';}else{$html .='Productos Utilizados';}
				$html .='</td></tr>';
				foreach ($arrProductos as $prod) {
					if(isset($prod['Cantidad'])&&$prod['Cantidad']!=0){
						$html .='<tr class="item-row linea_punteada">
							<td class="item-name" colspan="5">'.$prod['NombreProducto'];
							if(isset($rowdata['NombreBodega'])&&$rowdata['NombreBodega']!=''){$html .=' - '.$prod['NombreBodega'];}
							$html .='</td>
							<td class="item-name">'.Cantidades_decimales_justos($prod['Cantidad']).' '.$prod['UnidadMedida'].'</td>	
						</tr>';
					}
				}
				$html .='<tr id="hiderow"><td colspan="6"></td></tr>';
			}
			/**********************************************************************************/ 
			if(!empty($arrTrabajo)) { 
				$html .='<tr class="item-row fact_tittle"><td colspan="6">';
				if(isset($rowdata['idEstado'])&&$rowdata['idEstado']==1){$html .='Trabajos Programados';}else{$html .='Trabajos Ejecutados';}
				$html .='</td></tr>';
				foreach ($arrTrabajo as $trab) {
					$html .='<tr class="item-row linea_punteada">
						<td class="item-name" colspan="2">'.$trab['NombreComponente'].'</td>
						<td class="item-name" colspan="2">'.$trab['NombreTrabajo'].'</td>
						<td class="item-name" colspan="2">';
						
						//Se verifica el tipo de trabajo a realizar
						switch ($trab['idTrabajo']) {
							case 1: //Analisis
								$html .='<strong>Analisis N°: </strong>'.n_doc($trab['idAnalisis'], 6);
								break;
							case 2: //Consumo de Productos
								//El tipo de maquina que es
								switch ($trab['idSubTipo']) {
									case 1: //Grasa
										if(isset($trab['Grasa_inicial'])&&$trab['Grasa_inicial']!=0){             $html .= Cantidades_decimales_justos($trab['Grasa_inicial']);}
										if(isset($trab['Grasa_relubricacion'])&&$trab['Grasa_relubricacion']!=0){ $html .= Cantidades_decimales_justos($trab['Grasa_relubricacion']);}
										break;
									case 2: //Aceite
										$html .= Cantidades_decimales_justos($trab['Aceite']);
										break;
									case 3: //Normal
										$html .= Cantidades_decimales_justos($trab['Cantidad']);
										break;
									case 4: //Otro
											
										break;
								}
								$html .=' '.$trab['NombreUnidad'].' de '.$trab['NombreProducto'];
								break;
							case 3: //Observacion
								$html .='<strong>Obs: </strong>'.$trab['Observacion'];
								break;
						}
						$html .='
						</td>	
					</tr>'; 
				}
				$html .='<tr id="hiderow"><td colspan="6"></td></tr>';
			} 
			/**********************************************************************************/
				
				
			
					
            		
            $html .='
            <tr><td colspan="6" class="blank"><p>'.$rowdata['Observaciones'].'</p></td></tr>
            <tr><td colspan="6" class="blank"><p>Observacion</p></td></tr>
        </tbody>
    </table>
    	<div class="clearfix"></div>
    	
    </div>


</div>';

echo $html;
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';
?>
