<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
/**********************************************************************************************************************************/
/*                                                     Se llama la libreria                                                       */
/**********************************************************************************************************************************/
require '../LIBS_php/PhpOffice/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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

/*******************************************************/
// consulto los datos
$SIS_query = '
aguas_facturacion_listado_detalle.idFacturacionDetalle,

aguas_facturacion_listado_detalle.ClienteNombre,
aguas_facturacion_listado_detalle.ClienteDireccion,
aguas_facturacion_listado_detalle.ClienteIdentificador,
aguas_facturacion_listado_detalle.ClienteNombreComuna,
aguas_facturacion_listado_detalle.ClienteFechaVencimiento,
aguas_facturacion_listado_detalle.ClienteEstado,

aguas_facturacion_listado_detalle.Fecha,
aguas_facturacion_listado_detalle.Dia,
aguas_facturacion_listado_detalle.idMes,
aguas_facturacion_listado_detalle.Ano,
													
aguas_facturacion_listado_detalle.DetalleCargoFijoValor,
aguas_facturacion_listado_detalle.DetalleConsumoCantidad,aguas_facturacion_listado_detalle.DetalleConsumoValor,
aguas_facturacion_listado_detalle.DetalleRecoleccionCantidad,aguas_facturacion_listado_detalle.DetalleRecoleccionValor,
aguas_facturacion_listado_detalle.DetalleVisitaCorte,
aguas_facturacion_listado_detalle.DetalleCorte1Fecha,aguas_facturacion_listado_detalle.DetalleCorte1Valor,
aguas_facturacion_listado_detalle.DetalleCorte2Fecha,aguas_facturacion_listado_detalle.DetalleCorte2Valor,
aguas_facturacion_listado_detalle.DetalleReposicion1Fecha,aguas_facturacion_listado_detalle.DetalleReposicion1Valor,
aguas_facturacion_listado_detalle.DetalleReposicion2Fecha,aguas_facturacion_listado_detalle.DetalleReposicion2Valor,
aguas_facturacion_listado_detalle.DetalleSubtotalServicio,
aguas_facturacion_listado_detalle.DetalleInteresDeuda,
aguas_facturacion_listado_detalle.DetalleSaldoFavor,
aguas_facturacion_listado_detalle.DetalleTotalVenta,
aguas_facturacion_listado_detalle.DetalleSaldoAnterior,
							
aguas_facturacion_listado_detalle.DetalleOtrosCargos1Texto,
aguas_facturacion_listado_detalle.DetalleOtrosCargos2Texto,
aguas_facturacion_listado_detalle.DetalleOtrosCargos3Texto,
aguas_facturacion_listado_detalle.DetalleOtrosCargos4Texto,
aguas_facturacion_listado_detalle.DetalleOtrosCargos5Texto,
aguas_facturacion_listado_detalle.DetalleOtrosCargos1Valor,
aguas_facturacion_listado_detalle.DetalleOtrosCargos2Valor,
aguas_facturacion_listado_detalle.DetalleOtrosCargos3Valor,
aguas_facturacion_listado_detalle.DetalleOtrosCargos4Valor,
aguas_facturacion_listado_detalle.DetalleOtrosCargos5Valor,
aguas_facturacion_listado_detalle.DetalleOtrosCargos1Fecha,
aguas_facturacion_listado_detalle.DetalleOtrosCargos2Fecha,
aguas_facturacion_listado_detalle.DetalleOtrosCargos3Fecha,
aguas_facturacion_listado_detalle.DetalleOtrosCargos4Fecha,
aguas_facturacion_listado_detalle.DetalleOtrosCargos5Fecha,
							
aguas_facturacion_listado_detalle.DetalleTotalAPagar,
							
aguas_facturacion_listado_detalle_estado.Nombre AS Estado,
aguas_facturacion_listado_detalle.intAnual,
aguas_facturacion_listado_detalle_tipo_pago.Nombre AS TipoPago,
aguas_facturacion_listado_detalle.nDocPago,
aguas_facturacion_listado_detalle.fechaPago,
aguas_facturacion_listado_detalle.montoPago,
usuarios_listado.Nombre AS UsuarioPago,
							
aguas_clientes_facturable.Nombre AS Facturable,
aguas_facturacion_listado_detalle.SII_NDoc';
$SIS_join  = '
LEFT JOIN `aguas_facturacion_listado_detalle_estado`     ON aguas_facturacion_listado_detalle_estado.idEstado        = aguas_facturacion_listado_detalle.idEstado
LEFT JOIN `aguas_facturacion_listado_detalle_tipo_pago`  ON aguas_facturacion_listado_detalle_tipo_pago.idTipoPago   = aguas_facturacion_listado_detalle.idTipoPago
LEFT JOIN `usuarios_listado`                             ON usuarios_listado.idUsuario                               = aguas_facturacion_listado_detalle.idUsuarioPago
LEFT JOIN `aguas_clientes_facturable`                    ON aguas_clientes_facturable.idFacturable                   = aguas_facturacion_listado_detalle.SII_idFacturable';
$SIS_where = 'aguas_facturacion_listado_detalle.idMes = '.$_GET['idMes'].' AND aguas_facturacion_listado_detalle.Ano = '.$_GET['Ano'].' AND aguas_facturacion_listado_detalle.idSistema = '.$_GET['idSistema'];
$SIS_order = 'aguas_facturacion_listado_detalle.ClienteIdentificador ASC';
$arrFacturacion = array();
$arrFacturacion = db_select_array (false, $SIS_query, 'aguas_facturacion_listado_detalle', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrFacturacion');

/**********************************************************************************************************************************/
/*                                                          Ejecucion                                                             */
/**********************************************************************************************************************************/
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator($rowEmpresa['Nombre'])
							 ->setLastModifiedBy($rowEmpresa['Nombre'])
							 ->setTitle("Office 2007")
							 ->setSubject("Office 2007")
							 ->setDescription("Document for Office 2007")
							 ->setKeywords("office 2007")
							 ->setCategory("office 2007 result file");
        
            
//Titulo columnas
$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Nombre Cliente')
            ->setCellValue('B1', 'Dirección')
            ->setCellValue('C1', 'Identificador')
            ->setCellValue('D1', 'Comuna')
            ->setCellValue('E1', 'Fecha Vencimiento')
            ->setCellValue('F1', 'Estado del cliente')
            
            ->setCellValue('G1', 'Fecha Facturacion')
            
            ->setCellValue('H1', 'Cargo Fijo')
            ->setCellValue('I1', 'Cantidad')
            ->setCellValue('J1', 'Consumo Valor')
            ->setCellValue('K1', 'Cantidad')
            ->setCellValue('L1', 'Recoleccion Valor')
            ->setCellValue('M1', 'DetalleVisitaCorte')
            ->setCellValue('N1', 'DetalleCorte1Fecha')
            ->setCellValue('O1', 'DetalleCorte1Valor')
            ->setCellValue('P1', 'DetalleCorte2Fecha')
            ->setCellValue('Q1', 'DetalleCorte2Valor')
            ->setCellValue('R1', 'DetalleReposicion1Fecha')
            ->setCellValue('S1', 'DetalleReposicion1Valor')
            ->setCellValue('T1', 'DetalleReposicion2Fecha')
            ->setCellValue('U1', 'DetalleReposicion2Valor')
            ->setCellValue('V1', 'DetalleSubtotalServicio')
            ->setCellValue('W1', 'DetalleInteresDeuda')
            ->setCellValue('X1', 'DetalleSaldoFavor')
            ->setCellValue('Y1', 'DetalleTotalVenta')
            ->setCellValue('Z1', 'DetalleSaldoAnterior')
            
            ->setCellValue('AA1', 'DetalleOtrosCargos1Texto')
            ->setCellValue('AB1', 'DetalleOtrosCargos1Valor')
            ->setCellValue('AC1', 'DetalleOtrosCargos2Texto')
            ->setCellValue('AD1', 'DetalleOtrosCargos2Valor')
            ->setCellValue('AE1', 'DetalleOtrosCargos3Texto')
            ->setCellValue('AF1', 'DetalleOtrosCargos3Valor')
            ->setCellValue('AG1', 'DetalleOtrosCargos4Texto')
            ->setCellValue('AH1', 'DetalleOtrosCargos4Valor')
            ->setCellValue('AI1', 'DetalleOtrosCargos5Texto')
            ->setCellValue('AJ1', 'DetalleOtrosCargos5Valor')
           
            ->setCellValue('AK1', 'DetalleTotalAPagar')
            ->setCellValue('AL1', 'Estado')
            ->setCellValue('AM1', 'intAnual')
            ->setCellValue('AN1', 'TipoPago')
            ->setCellValue('AO1', 'nDocPago')
            ->setCellValue('AP1', 'fechaPago')
            ->setCellValue('AQ1', 'montoPago')
            ->setCellValue('AR1', 'UsuarioPago')
            ->setCellValue('AS1', 'Facturable')
            ->setCellValue('AT1', 'SII_NDoc')
            ->setCellValue('AU1', 'ID');

//variables
$nn             = 2;
$TotalFacturado = 0;
$TotalPagar     = 0;
$TotalPagado    = 0;
//arreglo
foreach ($arrFacturacion as $fact) { 
	
	if($fact['DetalleVisitaCorte']!=0){              $DetalleVisitaCorte       = $fact['DetalleVisitaCorte'];                                                  }else{$DetalleVisitaCorte       = "";}
	if($fact['DetalleCorte1Fecha']!='0000-00-00'){      $DetalleCorte1Fecha       = $fact['DetalleCorte1Fecha'];                                                  }else{$DetalleCorte1Fecha       = "";}
	if($fact['DetalleCorte1Valor']!=0){              $DetalleCorte1Valor       = $fact['DetalleCorte1Valor'];                                                  }else{$DetalleCorte1Valor       = "";}
	if($fact['DetalleCorte2Fecha']!='0000-00-00'){      $DetalleCorte2Fecha       = $fact['DetalleCorte2Fecha'];                                                  }else{$DetalleCorte2Fecha       = "";}
	if($fact['DetalleCorte2Valor']!=0){              $DetalleCorte2Valor       = $fact['DetalleCorte2Valor'];                                                  }else{$DetalleCorte2Valor       = "";}
	if($fact['DetalleReposicion1Fecha']!='0000-00-00'){ $DetalleReposicion1Fecha  = $fact['DetalleReposicion1Fecha'];                                             }else{$DetalleReposicion1Fecha  = "";}
	if($fact['DetalleReposicion1Valor']!=0){         $DetalleReposicion1Valor  = $fact['DetalleReposicion1Valor'];                                             }else{$DetalleReposicion1Valor  = "";}
	if($fact['DetalleReposicion2Fecha']!='0000-00-00'){ $DetalleReposicion2Fecha  = $fact['DetalleReposicion2Fecha'];                                             }else{$DetalleReposicion2Fecha  = "";}
	if($fact['DetalleReposicion2Valor']!=0){         $DetalleReposicion2Valor  = $fact['DetalleReposicion2Valor'];                                             }else{$DetalleReposicion2Valor  = "";}
	if($fact['DetalleInteresDeuda']!=0){             $DetalleInteresDeuda      = $fact['DetalleInteresDeuda'];                                                 }else{$DetalleInteresDeuda      = "";}
	if($fact['DetalleSaldoFavor']!=0){               $DetalleSaldoFavor        = $fact['DetalleSaldoFavor'];                                                   }else{$DetalleSaldoFavor        = "";}
	if($fact['DetalleSaldoAnterior']!=0){            $DetalleSaldoAnterior     = $fact['DetalleSaldoAnterior'];                                                }else{$DetalleSaldoAnterior     = "";}
	if($fact['DetalleOtrosCargos1Fecha']!='0000-00-00'){$DetalleOtrosCargos1      = $fact['DetalleOtrosCargos1Texto'].' ('.$fact['DetalleOtrosCargos1Fecha'].')';}else{$DetalleOtrosCargos1      = "";}
	if($fact['DetalleOtrosCargos2Fecha']!='0000-00-00'){$DetalleOtrosCargos2      = $fact['DetalleOtrosCargos2Texto'].' ('.$fact['DetalleOtrosCargos2Fecha'].')';}else{$DetalleOtrosCargos2      = "";}
	if($fact['DetalleOtrosCargos3Fecha']!='0000-00-00'){$DetalleOtrosCargos3      = $fact['DetalleOtrosCargos3Texto'].' ('.$fact['DetalleOtrosCargos3Fecha'].')';}else{$DetalleOtrosCargos3      = "";}
	if($fact['DetalleOtrosCargos4Fecha']!='0000-00-00'){$DetalleOtrosCargos4      = $fact['DetalleOtrosCargos4Texto'].' ('.$fact['DetalleOtrosCargos4Fecha'].')';}else{$DetalleOtrosCargos4      = "";}
	if($fact['DetalleOtrosCargos5Fecha']!='0000-00-00'){$DetalleOtrosCargos5      = $fact['DetalleOtrosCargos5Texto'].' ('.$fact['DetalleOtrosCargos5Fecha'].')';}else{$DetalleOtrosCargos5      = "";}
	if($fact['DetalleOtrosCargos1Valor']!=0){        $DetalleOtrosCargos1Valor = $fact['DetalleOtrosCargos1Valor'];                                            }else{$DetalleOtrosCargos1Valor = "";}
	if($fact['DetalleOtrosCargos2Valor']!=0){        $DetalleOtrosCargos2Valor = $fact['DetalleOtrosCargos2Valor'];                                            }else{$DetalleOtrosCargos2Valor = "";}
	if($fact['DetalleOtrosCargos3Valor']!=0){        $DetalleOtrosCargos3Valor = $fact['DetalleOtrosCargos3Valor'];                                            }else{$DetalleOtrosCargos3Valor = "";}
	if($fact['DetalleOtrosCargos4Valor']!=0){        $DetalleOtrosCargos4Valor = $fact['DetalleOtrosCargos4Valor'];                                            }else{$DetalleOtrosCargos4Valor = "";}
	if($fact['DetalleOtrosCargos5Valor']!=0){        $DetalleOtrosCargos5Valor = $fact['DetalleOtrosCargos5Valor'];                                            }else{$DetalleOtrosCargos5Valor = "";}
	if($fact['fechaPago']!='0000-00-00'){               $fechaPago                = $fact['fechaPago'];                                                           }else{$fechaPago                = "";}
	if($fact['montoPago']!=0){                       $montoPago                = $fact['montoPago'];                                                           }else{$montoPago                = "";}
	if($fact['SII_NDoc']!=0){                        $SII_NDoc                 = $fact['SII_NDoc'];                                                            }else{$SII_NDoc                 = "";}
	
	$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$nn, DeSanitizar($fact['ClienteNombre']))
				->setCellValue('B'.$nn, DeSanitizar($fact['ClienteDireccion']))
				->setCellValue('C'.$nn, DeSanitizar($fact['ClienteIdentificador']))
				->setCellValue('D'.$nn, DeSanitizar($fact['ClienteNombreComuna']))
				->setCellValue('E'.$nn, DeSanitizar($fact['ClienteFechaVencimiento']))
				->setCellValue('F'.$nn, DeSanitizar($fact['ClienteEstado']))
				
				->setCellValue('G'.$nn, $fact['Fecha'])
				
				->setCellValue('H'.$nn, $fact['DetalleCargoFijoValor'])
				->setCellValue('I'.$nn, $fact['DetalleConsumoCantidad'])
				->setCellValue('J'.$nn, $fact['DetalleConsumoValor'])
				->setCellValue('K'.$nn, $fact['DetalleRecoleccionCantidad'])
				->setCellValue('L'.$nn, $fact['DetalleRecoleccionValor'])
				->setCellValue('M'.$nn, $DetalleVisitaCorte)
				->setCellValue('N'.$nn, $DetalleCorte1Fecha)
				->setCellValue('O'.$nn, $DetalleCorte1Valor)
				->setCellValue('P'.$nn, $DetalleCorte2Fecha)
				->setCellValue('Q'.$nn, $DetalleCorte2Valor)
				->setCellValue('R'.$nn, $DetalleReposicion1Fecha)
				->setCellValue('S'.$nn, $DetalleReposicion1Valor)
				->setCellValue('T'.$nn, $DetalleReposicion2Fecha)
				->setCellValue('U'.$nn, $DetalleReposicion2Valor)
				->setCellValue('V'.$nn, $fact['DetalleSubtotalServicio'])
				->setCellValue('W'.$nn, $DetalleInteresDeuda)
				->setCellValue('X'.$nn, $DetalleSaldoFavor)
				->setCellValue('Y'.$nn, $fact['DetalleTotalVenta'])
				->setCellValue('Z'.$nn, $DetalleSaldoAnterior)
				
				->setCellValue('AA'.$nn, $DetalleOtrosCargos1)
				->setCellValue('AB'.$nn, $DetalleOtrosCargos1Valor)
				->setCellValue('AC'.$nn, $DetalleOtrosCargos2)
				->setCellValue('AD'.$nn, $DetalleOtrosCargos2Valor)
				->setCellValue('AE'.$nn, $DetalleOtrosCargos3)
				->setCellValue('AF'.$nn, $DetalleOtrosCargos3Valor)
				->setCellValue('AG'.$nn, $DetalleOtrosCargos4)
				->setCellValue('AH'.$nn, $DetalleOtrosCargos4Valor)
				->setCellValue('AI'.$nn, $DetalleOtrosCargos5)
				->setCellValue('AJ'.$nn, $DetalleOtrosCargos5Valor)
				
				->setCellValue('AK'.$nn, $fact['DetalleTotalAPagar'])
				->setCellValue('AL'.$nn, $fact['Estado'])
				->setCellValue('AM'.$nn, $fact['intAnual'])
				->setCellValue('AN'.$nn, $fact['TipoPago'])
				->setCellValue('AO'.$nn, $fact['nDocPago'])
				->setCellValue('AP'.$nn, $fechaPago)
				->setCellValue('AQ'.$nn, $montoPago)
				->setCellValue('AR'.$nn, $fact['UsuarioPago'])
				->setCellValue('AS'.$nn, $fact['Facturable'])
				->setCellValue('AT'.$nn, $SII_NDoc)
				->setCellValue('AU'.$nn, $fact['idFacturacionDetalle']);
								
	$nn++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Facturacion');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

/**************************************************************************/
//Nombre del archivo
$filename = 'Facturacion fecha '.Fecha_estandar($arrFacturacion[0]['Fecha']);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.DeSanitizar($filename).'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

