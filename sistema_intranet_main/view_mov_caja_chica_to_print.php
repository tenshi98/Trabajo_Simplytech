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
/**************************************************************/
// consulto los datos
$SIS_query = '
caja_chica_facturacion.idTipo,
caja_chica_listado.Nombre AS CajaNombre,
core_sistemas.Nombre AS CajaSistema,
usuarios_listado.Nombre AS Usuario,
caja_chica_facturacion_tipo.Nombre AS CajaTipo,
core_estado_caja.Nombre AS CajaEstado,
caja_chica_facturacion.fecha_auto,
caja_chica_facturacion.Creacion_fecha,
caja_chica_facturacion.Observaciones,
caja_chica_facturacion.Valor,
trabajadores_listado.Nombre AS TrabajadorNombre,
trabajadores_listado.ApellidoPat AS TrabajadorApellidoPat,
trabajadores_listado.ApellidoMat AS TrabajadorApellidoMat,
trabajadores_listado.Cargo AS TrabajadorCargo,
trabajadores_listado.Fono AS TrabajadorFono,
trabajadores_listado.Rut AS TrabajadorRut,
caja_chica_facturacion.idFacturacionRelacionada,
trabajadores_listado.Nombre AS TrabRelNombre,
trabajadores_listado.ApellidoPat AS TrabRelApellidoPat,
trabajadores_listado.ApellidoMat AS TrabRelApellidoMat,
trabajadores_listado.Cargo AS TrabRelCargo,
trabajadores_listado.Fono AS TrabRelFono,
trabajadores_listado.Rut AS TrabRelRut,
fact_rel.Valor AS RelValor';
$SIS_join  = '
LEFT JOIN `caja_chica_listado`                  ON caja_chica_listado.idCajaChica       = caja_chica_facturacion.idCajaChica
LEFT JOIN `core_sistemas`                       ON core_sistemas.idSistema              = caja_chica_facturacion.idSistema
LEFT JOIN `usuarios_listado`                    ON usuarios_listado.idUsuario           = caja_chica_facturacion.idUsuario
LEFT JOIN `caja_chica_facturacion_tipo`         ON caja_chica_facturacion_tipo.idTipo   = caja_chica_facturacion.idTipo
LEFT JOIN `core_estado_caja`                    ON core_estado_caja.idEstado            = caja_chica_facturacion.idEstado
LEFT JOIN `trabajadores_listado`                ON trabajadores_listado.idTrabajador    = caja_chica_facturacion.idTrabajador
LEFT JOIN `caja_chica_facturacion`   fact_rel   ON fact_rel.idFacturacion               = caja_chica_facturacion.idFacturacionRelacionada
LEFT JOIN `trabajadores_listado`     trab_rel   ON trab_rel.idTrabajador                = fact_rel.idTrabajador';
$SIS_where = 'caja_chica_facturacion.idFacturacion ='.$X_Puntero;
$row_data = db_select_data (false, $SIS_query, 'caja_chica_facturacion', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'row_data');

/***********************************************/			
// Se trae un listado con todos los productos utilizados
$SIS_query = '
sistema_documentos_pago.Nombre,
caja_chica_facturacion_existencias.N_Doc,
caja_chica_facturacion_existencias.Valor';
$SIS_join  = 'LEFT JOIN `sistema_documentos_pago` ON sistema_documentos_pago.idDocPago = caja_chica_facturacion_existencias.idDocPago';
$SIS_where = 'idFacturacion ='.$X_Puntero;
$SIS_order = 'sistema_documentos_pago.Nombre ASC';
$arrDocumentos = array();
$arrDocumentos = db_select_array (false, $SIS_query, 'caja_chica_facturacion_existencias', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrDocumentos');

/***********************************************/	
// Se trae un listado con todos los productos utilizados
$SIS_query = 'Item, Valor';
$SIS_join  = '';
$SIS_where = 'idFacturacion ='.$X_Puntero;
$SIS_order = 'Item ASC';
$arrRendiciones = array();
$arrRendiciones = db_select_array (false, $SIS_query, 'caja_chica_facturacion_rendiciones', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrRendiciones');

/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Print.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
$html = '
<section class="invoice">
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe" aria-hidden="true"></i> '.$row_data['CajaTipo'].'
				<small class="pull-right">Numero Documento: '.n_doc($_GET['view'], 8).'</small>
			</h2>
		</div>   
	</div>
	
	<div class="row invoice-info">';
		
		//se verifica el tipo de movimiento
		switch ($row_data['idTipo']) {
			//Ingreso
			case 1:
				$html .= '
				<div class="col-sm-6 invoice-col">
					Datos del Movimiento
					<address>
						<strong>'.$row_data['CajaNombre'].'</strong><br/>
						Sistema: '.$row_data['CajaSistema'].'<br/>
						Usuario: '.$row_data['Usuario'].'<br/>
						Estado: '.$row_data['CajaEstado'].'<br/>
						Fecha Real: '.Fecha_estandar($row_data['fecha_auto']).'<br/>
						Fecha Ingresada: '.Fecha_estandar($row_data['Creacion_fecha']).'<br/>
					</address>
				</div>
				
				<div class="col-sm-6 invoice-col">

				</div>';

				break;
			//Egreso
			case 2:
				$html .= '
				<div class="col-sm-6 invoice-col">
					Datos del Movimiento
					<address>
						<strong>'.$row_data['CajaNombre'].'</strong><br/>
						Sistema: '.$row_data['CajaSistema'].'<br/>
						Usuario: '.$row_data['Usuario'].'<br/>
						Estado: '.$row_data['CajaEstado'].'<br/>
						Fecha Real: '.Fecha_estandar($row_data['fecha_auto']).'<br/>
						Fecha Ingresada: '.Fecha_estandar($row_data['Creacion_fecha']).'<br/>
					</address>
				</div>
				
				<div class="col-sm-6 invoice-col">
					Trabajador
					<address>
						<strong>'.$row_data['TrabajadorNombre'].' '.$row_data['TrabajadorApellidoPat'].' '.$row_data['TrabajadorApellidoMat'].'</strong><br/>
						Rut: '.$row_data['TrabajadorRut'].'<br/>
						Cargo: '.$row_data['TrabajadorCargo'].'<br/>
						Fono: '.$row_data['TrabajadorFono'].'<br/>
					</address>
				</div>';
				
				break;
			//Rendicion 
			case 3:
				
				break;
			
		}
		
	$html .= '</div>
	
	<div class="">
		<div class="col-xs-12 table-responsive" style="padding-left: 0px; padding-right: 0px;border: 1px solid #ddd;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Detalle</th>
						<th width="200">Valor Ingreso</th>
						<th width="200">Valor Egreso</th>
					</tr>
				</thead>
				<tbody>';
					//si existen productos
					if ($arrRendiciones!=false && !empty($arrRendiciones) && $arrRendiciones!='') {
						$html .= '<tr class="active"><td colspan="3"><strong>Rendiciones</strong></td></tr>';
						foreach ($arrRendiciones as $prod) { 
							$html .= '<tr>
								<td><strong>'.$prod['Item'].'</td>';
								
								if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
									$html .= '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
									$html .= '<td align="right"></td>';
								}else{
									$html .= '<td align="right"></td>';
									$html .= '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
								}
							$html .= '</tr>';
						}
					}
					
					//si existen productos
					if ($arrDocumentos!=false && !empty($arrDocumentos) && $arrDocumentos!='') {
						$html .= '<tr class="active"><td colspan="3"><strong>Montos</strong></td></tr>';
						foreach ($arrDocumentos as $prod) { 
							$html .= '<tr>
								<td><strong>';
									$html .= $prod['Nombre'];
									if(isset($prod['N_Doc'])&&$prod['N_Doc']!=''){
										$html .= ' N°'.$prod['N_Doc'];
									}	
								$html .= '</td>';
								
								if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
									$html .= '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
									$html .= '<td align="right"></td>';
								}else{
									$html .= '<td align="right"></td>';
									$html .= '<td align="right">'.Valores($prod['Valor'], 0).'</td>';
								}
							$html .= '</tr>';
						}
					}
					
					if(isset($row_data['Valor'])&&$row_data['Valor']!=0){
						$html .= '
						<tr class="invoice-total" bgcolor="#f1f1f1">
							<td align="right"><strong>Total</strong></td>';
							if(isset($row_data['idTipo'])&&$row_data['idTipo']==1){
								$html .= '<td align="right">'.Valores($row_data['Valor'], 0).'</td>';
								$html .= '<td align="right"></td>';
							}else{
								$html .= '<td align="right"></td>';
								$html .= '<td align="right">'.Valores($row_data['Valor'], 0).'</td>';
							} 
								
						$html .= '</tr>';
					}
					
			$html .= '</table>

		</div>
	</div>
	
	<div class="col-xs-12">
		<div class="row">
			<p class="lead"><a name="Ancla_obs"></a>Observaciones:</p>
			<p class="text-muted well well-sm no-shadow" >'.$row_data['Observaciones'].'</p>
		</div>
	</div>';
	
	if($row_data['idTipo']==2){
		$html .= '<div class="row firma">
			<div class="col-sm-6 fcont"><p>Firma Transportista</p></div>
			<div class="col-sm-6 fcont" style="left:50%;"><p>Firma Receptor</p></div> 
		</div>';
	}
    
$html .= '</section>';
echo $html;

/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Print.php';
?>
