<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
//variable de ubicacion en el menu
$rowlevel['nombre_categoria'] = '';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "view_facturar.php";
$location = $original;
//Se agregan ubicaciones
$location .='?view='.$_GET['facturar'];
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'SII_idFacturable,Fecha,idCliente,ClienteNombre,ClienteDireccion,ClienteIdentificador,ClienteNombreComuna,ClienteFechaVencimiento,ClienteEstado,DetalleSubtotalServicio,DetalleTotalVenta,DetalleTotalAPagar,GraficoMes1Fecha,GraficoMes2Fecha,GraficoMes3Fecha,GraficoMes4Fecha,GraficoMes5Fecha,GraficoMes6Fecha,GraficoMes7Fecha,GraficoMes8Fecha,GraficoMes9Fecha,GraficoMes10Fecha,GraficoMes11Fecha,GraficoMes12Fecha,GraficoMes1Valor,GraficoMes2Valor,GraficoMes3Valor,GraficoMes4Valor,GraficoMes5Valor,GraficoMes6Valor,GraficoMes7Valor,GraficoMes8Valor,GraficoMes9Valor,GraficoMes10Valor,GraficoMes11Valor,GraficoMes12Valor,DetConsMesAnteriorCantidad,DetConsMesAnteriorFecha,DetConsMesActualCantidad,DetConsMesActualFecha,DetConsMesDiferencia,DetConsMesTotalCantidad,DetConsFechaProxLectura,AguasInfCargoFijo,AguasInfMetroAgua,AguasInfMetroAgua,AguasInfMetroRecolecion,AguasInfVisitaCorte,AguasInfCorte1,AguasInfCorte2,AguasInfReposicion1,AguasInfReposicion2,AguasInfFactorCobro,AguasInfPuntoDiametro,AguasInfClaveFacturacion,AguasInfClaveLectura,AguasInfNumeroMedidor,AguasInfFechaEmision,AguasInfUltimoPagoFecha,AguasInfUltimoPagoMonto,AguasInfMovimientosHasta,idEstado,intAnual,idFacturacionDetalle';
	$form_trabajo= 'updateFacturacion';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_facturacion_listado.php';
}
?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
               <?php require_once 'core/logo_empresa.php';?>
              </a>  
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><i class="fa fa-dashboard"></i> Editar Facturacion</h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
//Listado de errores no manejables
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Facturacion editada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//Se traen todos los datos
$query = "SELECT SII_idFacturable,SII_NDoc,Fecha, idCliente, ClienteNombre, ClienteDireccion, 
ClienteIdentificador,ClienteNombreComuna, ClienteFechaVencimiento, ClienteEstado, DetalleCargoFijoValor,
DetalleConsumoCantidad, DetalleConsumoValor, DetalleRecoleccionCantidad, DetalleRecoleccionValor,
DetalleCorte1Valor, DetalleCorte1Fecha, DetalleCorte2Valor, DetalleCorte2Fecha,
DetalleReposicion1Valor, DetalleReposicion1Fecha, DetalleReposicion2Valor, DetalleReposicion2Fecha,
DetalleSubtotalServicio, DetalleInteresDeuda, DetalleOtrosCargos1Texto, DetalleOtrosCargos1Valor,
DetalleOtrosCargos1Fecha, DetalleOtrosCargos2Texto, DetalleOtrosCargos2Valor, DetalleOtrosCargos2Fecha,
DetalleOtrosCargos3Texto, DetalleOtrosCargos3Valor, DetalleOtrosCargos3Fecha, DetalleOtrosCargos4Texto,
DetalleOtrosCargos4Valor, DetalleOtrosCargos4Fecha, DetalleOtrosCargos5Texto, DetalleOtrosCargos5Valor,
DetalleOtrosCargos5Fecha, DetalleTotalVenta, DetalleSaldoFavor, DetalleSaldoAnterior, DetalleTotalAPagar,
GraficoMes1Valor,GraficoMes2Valor,GraficoMes3Valor,GraficoMes4Valor,GraficoMes5Valor,GraficoMes6Valor,
GraficoMes7Valor,GraficoMes8Valor,GraficoMes9Valor,GraficoMes10Valor,GraficoMes11Valor,GraficoMes12Valor,
GraficoMes1Fecha,GraficoMes2Fecha,GraficoMes3Fecha,GraficoMes4Fecha,GraficoMes5Fecha,GraficoMes6Fecha,
GraficoMes7Fecha,GraficoMes8Fecha,GraficoMes9Fecha,GraficoMes10Fecha,GraficoMes11Fecha,GraficoMes12Fecha,
DetConsMesAnteriorCantidad,DetConsMesAnteriorFecha,DetConsMesActualCantidad,DetConsMesActualFecha,
DetConsMesDiferencia,DetConsProrateo,DetConsProrateoSigno,DetConsMesTotalCantidad,DetConsFechaProxLectura,
DetConsModalidad,DetConsFonoEmergencias,DetConsFonoConsultas,AguasInfCargoFijo,AguasInfMetroAgua,
AguasInfMetroRecolecion,AguasInfVisitaCorte,AguasInfCorte1,AguasInfCorte2,AguasInfReposicion1,
AguasInfReposicion2,AguasInfFactorCobro,AguasInfDifMedGeneral,AguasInfProcProrrateo,AguasInfTipoMedicion,
AguasInfPuntoDiametro,AguasInfClaveFacturacion,AguasInfClaveLectura,AguasInfNumeroMedidor,
AguasInfFechaEmision,AguasInfUltimoPagoFecha,AguasInfUltimoPagoMonto,AguasInfMovimientosHasta,
idEstado,intAnual,idTipoPago,nDocPago,fechaPago,DiaPago,idMesPago,AnoPago,montoPago,idUsuarioPago,
idPago,rem_cantidad,rem_procentaje,rem_negative,rem_modalidad,rem_diferencia,NombreArchivo	
		
FROM `facturacion_listado_detalle`
WHERE idFacturacionDetalle = ".$_GET['view'];
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
?>


<div class="col-lg-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Editar Boleta/Factura</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1">
	
				<?php 
				//Se verifican si existen los datos
				if(isset($SII_idFacturable)) {               $x1   = $SII_idFacturable;                 }else{$x1   = $rowdata['SII_idFacturable'];}
				if(isset($SII_NDoc)) {                       $x2   = $SII_NDoc;                         }else{$x2   = $rowdata['SII_NDoc'];}
				if(isset($Fecha)) {                          $x3   = $Fecha;                            }else{$x3   = $rowdata['Fecha'];}
				if(isset($idCliente)) {                      $x4   = $idCliente;                        }else{$x4   = $rowdata['idCliente'];}
				if(isset($ClienteNombre)) {                  $x5   = $ClienteNombre;                    }else{$x5   = $rowdata['ClienteNombre'];}
				if(isset($ClienteDireccion)) {               $x6   = $ClienteDireccion;                 }else{$x6   = $rowdata['ClienteDireccion'];}
				if(isset($ClienteIdentificador)) {           $x7   = $ClienteIdentificador;             }else{$x7   = $rowdata['ClienteIdentificador'];}
				if(isset($ClienteNombreComuna)) {            $x8   = $ClienteNombreComuna;              }else{$x8   = $rowdata['ClienteNombreComuna'];}
				if(isset($ClienteFechaVencimiento)) {        $x9   = $ClienteFechaVencimiento;          }else{$x9   = $rowdata['ClienteFechaVencimiento'];}
				if(isset($ClienteEstado)) {                  $x10  = $ClienteEstado;                    }else{$x10  = $rowdata['ClienteEstado'];}
				if(isset($DetalleCargoFijoValor)) {          $x11  = $DetalleCargoFijoValor;            }else{$x11  = $rowdata['DetalleCargoFijoValor'];}
				if(isset($DetalleConsumoCantidad)) {         $x12  = $DetalleConsumoCantidad;           }else{$x12  = $rowdata['DetalleConsumoCantidad'];}
				if(isset($DetalleConsumoValor)) {            $x13  = $DetalleConsumoValor;              }else{$x13  = $rowdata['DetalleConsumoValor'];}
				if(isset($DetalleRecoleccionCantidad)) {     $x14  = $DetalleRecoleccionCantidad;       }else{$x14  = $rowdata['DetalleRecoleccionCantidad'];}
				if(isset($DetalleRecoleccionValor)) {        $x15  = $DetalleRecoleccionValor;          }else{$x15  = $rowdata['DetalleRecoleccionValor'];}
				if(isset($DetalleCorte1Valor)) {             $x16  = $DetalleCorte1Valor;               }else{$x16  = $rowdata['DetalleCorte1Valor'];}
				if(isset($DetalleCorte1Fecha)) {             $x17  = $DetalleCorte1Fecha;               }else{$x17  = $rowdata['DetalleCorte1Fecha'];}
				if(isset($DetalleCorte2Valor)) {             $x18  = $DetalleCorte2Valor;               }else{$x18  = $rowdata['DetalleCorte2Valor'];}
				if(isset($DetalleCorte2Fecha)) {             $x19  = $DetalleCorte2Fecha;               }else{$x19  = $rowdata['DetalleCorte2Fecha'];}
				if(isset($DetalleReposicion1Valor)) {        $x20  = $DetalleReposicion1Valor;          }else{$x20  = $rowdata['DetalleReposicion1Valor'];}
				if(isset($DetalleReposicion1Fecha)) {        $x21  = $DetalleReposicion1Fecha;          }else{$x21  = $rowdata['DetalleReposicion1Fecha'];}
				if(isset($DetalleReposicion2Valor)) {        $x22  = $DetalleReposicion2Valor;          }else{$x22  = $rowdata['DetalleReposicion2Valor'];}
				if(isset($DetalleReposicion2Fecha)) {        $x23  = $DetalleReposicion2Fecha;          }else{$x23  = $rowdata['DetalleReposicion2Fecha'];}
				if(isset($DetalleSubtotalServicio)) {        $x24  = $DetalleSubtotalServicio;          }else{$x24  = $rowdata['DetalleSubtotalServicio'];}
				if(isset($DetalleInteresDeuda)) {            $x25  = $DetalleInteresDeuda;              }else{$x25  = $rowdata['DetalleInteresDeuda'];}
				if(isset($DetalleOtrosCargos1Texto)) {       $x26  = $DetalleOtrosCargos1Texto;         }else{$x26  = $rowdata['DetalleOtrosCargos1Texto'];}
				if(isset($DetalleOtrosCargos1Valor)) {       $x27  = $DetalleOtrosCargos1Valor;         }else{$x27  = $rowdata['DetalleOtrosCargos1Valor'];}
				if(isset($DetalleOtrosCargos1Fecha)) {       $x28  = $DetalleOtrosCargos1Fecha;         }else{$x28  = $rowdata['DetalleOtrosCargos1Fecha'];}
				if(isset($DetalleOtrosCargos2Texto)) {       $x29  = $DetalleOtrosCargos2Texto;         }else{$x29  = $rowdata['DetalleOtrosCargos2Texto'];}
				if(isset($DetalleOtrosCargos2Valor)) {       $x30  = $DetalleOtrosCargos2Valor;         }else{$x30  = $rowdata['DetalleOtrosCargos2Valor'];}
				if(isset($DetalleOtrosCargos2Fecha)) {       $x31  = $DetalleOtrosCargos2Fecha;         }else{$x31  = $rowdata['DetalleOtrosCargos2Fecha'];}
				if(isset($DetalleOtrosCargos3Texto)) {       $x32  = $DetalleOtrosCargos3Texto;         }else{$x32  = $rowdata['DetalleOtrosCargos3Texto'];}
				if(isset($DetalleOtrosCargos3Valor)) {       $x33  = $DetalleOtrosCargos3Valor;         }else{$x33  = $rowdata['DetalleOtrosCargos3Valor'];}
				if(isset($DetalleOtrosCargos3Fecha)) {       $x34  = $DetalleOtrosCargos3Fecha;         }else{$x34  = $rowdata['DetalleOtrosCargos3Fecha'];}
				if(isset($DetalleOtrosCargos4Texto)) {       $x35  = $DetalleOtrosCargos4Texto;         }else{$x35  = $rowdata['DetalleOtrosCargos4Texto'];}
				if(isset($DetalleOtrosCargos4Valor)) {       $x36  = $DetalleOtrosCargos4Valor;         }else{$x36  = $rowdata['DetalleOtrosCargos4Valor'];}
				if(isset($DetalleOtrosCargos4Fecha)) {       $x37  = $DetalleOtrosCargos4Fecha;         }else{$x37  = $rowdata['DetalleOtrosCargos4Fecha'];}
				if(isset($DetalleOtrosCargos5Texto)) {       $x38  = $DetalleOtrosCargos5Texto;         }else{$x38  = $rowdata['DetalleOtrosCargos5Texto'];}
				if(isset($DetalleOtrosCargos5Valor)) {       $x39  = $DetalleOtrosCargos5Valor;         }else{$x39  = $rowdata['DetalleOtrosCargos5Valor'];}
				if(isset($DetalleOtrosCargos5Fecha)) {       $x40  = $DetalleOtrosCargos5Fecha;         }else{$x40  = $rowdata['DetalleOtrosCargos5Fecha'];}
				if(isset($DetalleTotalVenta)) {              $x41  = $DetalleTotalVenta;                }else{$x41  = $rowdata['DetalleTotalVenta'];}
				if(isset($DetalleSaldoFavor)) {              $x42  = $DetalleSaldoFavor;                }else{$x42  = $rowdata['DetalleSaldoFavor'];}
				if(isset($DetalleSaldoAnterior)) {           $x43  = $DetalleSaldoAnterior;             }else{$x43  = $rowdata['DetalleSaldoAnterior'];}
				if(isset($DetalleTotalAPagar)) {             $x44  = $DetalleTotalAPagar;               }else{$x44  = $rowdata['DetalleTotalAPagar'];}
				if(isset($GraficoMes1Valor)) {               $x45  = $GraficoMes1Valor;                 }else{$x45  = $rowdata['GraficoMes1Valor'];}
				if(isset($GraficoMes1Fecha)) {               $x46  = $GraficoMes1Fecha;                 }else{$x46  = $rowdata['GraficoMes1Fecha'];}
				if(isset($GraficoMes2Valor)) {               $x47  = $GraficoMes2Valor;                 }else{$x47  = $rowdata['GraficoMes2Valor'];}
				if(isset($GraficoMes2Fecha)) {               $x48  = $GraficoMes2Fecha;                 }else{$x48  = $rowdata['GraficoMes2Fecha'];}
				if(isset($GraficoMes3Valor)) {               $x49  = $GraficoMes3Valor;                 }else{$x49  = $rowdata['GraficoMes3Valor'];}
				if(isset($GraficoMes3Fecha)) {               $x50  = $GraficoMes3Fecha;                 }else{$x50  = $rowdata['GraficoMes3Fecha'];}
				if(isset($GraficoMes4Valor)) {               $x51  = $GraficoMes4Valor;                 }else{$x51  = $rowdata['GraficoMes4Valor'];}
				if(isset($GraficoMes4Fecha)) {               $x52  = $GraficoMes4Fecha;                 }else{$x52  = $rowdata['GraficoMes4Fecha'];}
				if(isset($GraficoMes5Valor)) {               $x53  = $GraficoMes5Valor;                 }else{$x53  = $rowdata['GraficoMes5Valor'];}
				if(isset($GraficoMes5Fecha)) {               $x54  = $GraficoMes5Fecha;                 }else{$x54  = $rowdata['GraficoMes5Fecha'];}
				if(isset($GraficoMes6Valor)) {               $x55  = $GraficoMes6Valor;                 }else{$x55  = $rowdata['GraficoMes6Valor'];}
				if(isset($GraficoMes6Fecha)) {               $x56  = $GraficoMes6Fecha;                 }else{$x56  = $rowdata['GraficoMes6Fecha'];}
				if(isset($GraficoMes7Valor)) {               $x57  = $GraficoMes7Valor;                 }else{$x57  = $rowdata['GraficoMes7Valor'];}
				if(isset($GraficoMes7Fecha)) {               $x58  = $GraficoMes7Fecha;                 }else{$x58  = $rowdata['GraficoMes7Fecha'];}
				if(isset($GraficoMes8Valor)) {               $x59  = $GraficoMes8Valor;                 }else{$x59  = $rowdata['GraficoMes8Valor'];}
				if(isset($GraficoMes8Fecha)) {               $x60  = $GraficoMes8Fecha;                 }else{$x60  = $rowdata['GraficoMes8Fecha'];}
				if(isset($GraficoMes9Valor)) {               $x61  = $GraficoMes9Valor;                 }else{$x61  = $rowdata['GraficoMes9Valor'];}
				if(isset($GraficoMes9Fecha)) {               $x62  = $GraficoMes9Fecha;                 }else{$x62  = $rowdata['GraficoMes9Fecha'];}
				if(isset($GraficoMes10Valor)) {              $x63  = $GraficoMes10Valor;                }else{$x63  = $rowdata['GraficoMes10Valor'];}
				if(isset($GraficoMes10Fecha)) {              $x64  = $GraficoMes10Fecha;                }else{$x64  = $rowdata['GraficoMes10Fecha'];}
				if(isset($GraficoMes11Valor)) {              $x65  = $GraficoMes11Valor;                }else{$x65  = $rowdata['GraficoMes11Valor'];}
				if(isset($GraficoMes11Fecha)) {              $x66  = $GraficoMes11Fecha;                }else{$x66  = $rowdata['GraficoMes11Fecha'];}
				if(isset($GraficoMes12Valor)) {              $x67  = $GraficoMes12Valor;                }else{$x67  = $rowdata['GraficoMes12Valor'];}
				if(isset($GraficoMes12Fecha)) {              $x68  = $GraficoMes12Fecha;                }else{$x68  = $rowdata['GraficoMes12Fecha'];}
				if(isset($DetConsMesAnteriorCantidad)) {     $x69  = $DetConsMesAnteriorCantidad;       }else{$x69  = $rowdata['DetConsMesAnteriorCantidad'];}
				if(isset($DetConsMesAnteriorFecha)) {        $x70  = $DetConsMesAnteriorFecha;          }else{$x70  = $rowdata['DetConsMesAnteriorFecha'];}
				if(isset($DetConsMesActualCantidad)) {       $x71  = $DetConsMesActualCantidad;         }else{$x71  = $rowdata['DetConsMesActualCantidad'];}
				if(isset($DetConsMesActualFecha)) {          $x72  = $DetConsMesActualFecha;            }else{$x72  = $rowdata['DetConsMesActualFecha'];}
				if(isset($DetConsMesDiferencia)) {           $x73  = $DetConsMesDiferencia;             }else{$x73  = $rowdata['DetConsMesDiferencia'];}
				if(isset($DetConsProrateo)) {                $x74  = $DetConsProrateo;                  }else{$x74  = $rowdata['DetConsProrateo'];}
				if(isset($DetConsProrateoSigno)) {           $x75  = $DetConsProrateoSigno;             }else{$x75  = $rowdata['DetConsProrateoSigno'];}
				if(isset($DetConsMesTotalCantidad)) {        $x76  = $DetConsMesTotalCantidad;          }else{$x76  = $rowdata['DetConsMesTotalCantidad'];}
				if(isset($DetConsFechaProxLectura)) {        $x77  = $DetConsFechaProxLectura;          }else{$x77  = $rowdata['DetConsFechaProxLectura'];}
				if(isset($DetConsModalidad)) {               $x78  = $DetConsModalidad;                 }else{$x78  = $rowdata['DetConsModalidad'];}
				if(isset($DetConsFonoEmergencias)) {         $x79  = $DetConsFonoEmergencias;           }else{$x79  = $rowdata['DetConsFonoEmergencias'];}
				if(isset($DetConsFonoConsultas)) {           $x80  = $DetConsFonoConsultas;             }else{$x80  = $rowdata['DetConsFonoConsultas'];}
				if(isset($AguasInfCargoFijo)) {              $x81  = $AguasInfCargoFijo;                }else{$x81  = $rowdata['AguasInfCargoFijo'];}
				if(isset($AguasInfMetroAgua)) {              $x82  = $AguasInfMetroAgua;                }else{$x82  = $rowdata['AguasInfMetroAgua'];}
				if(isset($AguasInfMetroRecolecion)) {        $x83  = $AguasInfMetroRecolecion;          }else{$x83  = $rowdata['AguasInfMetroRecolecion'];}
				if(isset($AguasInfVisitaCorte)) {            $x84  = $AguasInfVisitaCorte;              }else{$x84  = $rowdata['AguasInfVisitaCorte'];}
				if(isset($AguasInfCorte1)) {                 $x85  = $AguasInfCorte1;                   }else{$x85  = $rowdata['AguasInfCorte1'];}
				if(isset($AguasInfCorte2)) {                 $x86  = $AguasInfCorte2;                   }else{$x86  = $rowdata['AguasInfCorte2'];}
				if(isset($AguasInfReposicion1)) {            $x87  = $AguasInfReposicion1;              }else{$x87  = $rowdata['AguasInfReposicion1'];}
				if(isset($AguasInfReposicion2)) {            $x88  = $AguasInfReposicion2;              }else{$x88  = $rowdata['AguasInfReposicion2'];}
				if(isset($AguasInfFactorCobro)) {            $x89  = $AguasInfFactorCobro;              }else{$x89  = $rowdata['AguasInfFactorCobro'];}
				if(isset($AguasInfDifMedGeneral)) {          $x90  = $AguasInfDifMedGeneral;            }else{$x90  = $rowdata['AguasInfDifMedGeneral'];}
				if(isset($AguasInfProcProrrateo)) {          $x91  = $AguasInfProcProrrateo;            }else{$x91  = $rowdata['AguasInfProcProrrateo'];}
				if(isset($AguasInfTipoMedicion)) {           $x92  = $AguasInfTipoMedicion;             }else{$x92  = $rowdata['AguasInfTipoMedicion'];}
				if(isset($AguasInfPuntoDiametro)) {          $x93  = $AguasInfPuntoDiametro;            }else{$x93  = $rowdata['AguasInfPuntoDiametro'];}
				if(isset($AguasInfClaveFacturacion)) {       $x94  = $AguasInfClaveFacturacion;         }else{$x94  = $rowdata['AguasInfClaveFacturacion'];}
				if(isset($AguasInfClaveLectura)) {           $x95  = $AguasInfClaveLectura;             }else{$x95  = $rowdata['AguasInfClaveLectura'];}
				if(isset($AguasInfNumeroMedidor)) {          $x96  = $AguasInfNumeroMedidor;            }else{$x96  = $rowdata['AguasInfNumeroMedidor'];}
				if(isset($AguasInfFechaEmision)) {           $x97  = $AguasInfFechaEmision;             }else{$x97  = $rowdata['AguasInfFechaEmision'];}
				if(isset($AguasInfUltimoPagoFecha)) {        $x98  = $AguasInfUltimoPagoFecha;          }else{$x98  = $rowdata['AguasInfUltimoPagoFecha'];}
				if(isset($AguasInfUltimoPagoMonto)) {        $x99  = $AguasInfUltimoPagoMonto;          }else{$x99  = $rowdata['AguasInfUltimoPagoMonto'];}
				if(isset($AguasInfMovimientosHasta)) {       $x100 = $AguasInfMovimientosHasta;         }else{$x100 = $rowdata['AguasInfMovimientosHasta'];}
				if(isset($idEstado)) {                       $x101 = $idEstado;                         }else{$x101 = $rowdata['idEstado'];}
				if(isset($intAnual)) {                       $x102 = $intAnual;                         }else{$x102 = Cantidades_decimales_justos($rowdata['intAnual']);}
				if(isset($idTipoPago)) {                     $x103 = $idTipoPago;                       }else{$x103 = $rowdata['idTipoPago'];}
				if(isset($nDocPago)) {                       $x104 = $nDocPago;                         }else{$x104 = $rowdata['nDocPago'];}
				if(isset($fechaPago)) {                      $x105 = $fechaPago;                        }else{$x105 = $rowdata['fechaPago'];}
				if(isset($montoPago)) {                      $x106 = $montoPago;                        }else{$x106 = $rowdata['montoPago'];}
				if(isset($idUsuarioPago)) {                  $x107 = $idUsuarioPago;                    }else{$x107 = $rowdata['idUsuarioPago'];}
				if(isset($idPago)) {                         $x108 = $idPago;                           }else{$x108 = $rowdata['idPago'];}
				if(isset($rem_cantidad)) {                   $x109 = $rem_cantidad;                     }else{$x109 = $rowdata['rem_cantidad'];}
				if(isset($rem_procentaje)) {                 $x110 = $rem_procentaje;                   }else{$x110 = $rowdata['rem_procentaje'];}
				if(isset($rem_negative)) {                   $x111 = $rem_negative;                     }else{$x111 = $rowdata['rem_negative'];}
				if(isset($rem_modalidad)) {                  $x112 = $rem_modalidad;                    }else{$x112 = $rowdata['rem_modalidad'];}
				if(isset($rem_diferencia)) {                 $x113 = $rem_diferencia;                   }else{$x113 = $rowdata['rem_diferencia'];}
				if(isset($NombreArchivo)) {                  $x114 = $NombreArchivo;                    }else{$x114 = $rowdata['NombreArchivo'];}
				
				
				/*******************************************************************/
				//se dibujan los inputs
				/*********************************************************/
				echo '<h3>Identificacion Boleta</h3>';
				echo form_select('Tipo de Documento','SII_idFacturable', $x1, 2, 'idFacturable', 'Nombre', 'clientes_facturable', 0, $dbConn);
				echo form_input_number('Numero de boleta','SII_NDoc', $x2, 2);
				echo form_date('Fecha Facturacion','Fecha', $x3, 2);
				
				/*********************************************************/
				echo '<h3>Identificacion Cliente</h3>';
				echo form_select('Cliente','idCliente', $x4, 2, 'idCliente', 'Nombre', 'clientes_listado', 0, $dbConn);
				echo form_input('text', 'Nombre Cliente', 'ClienteNombre', $x5, 2);
				echo form_input('text', 'Direccion Cliente', 'ClienteDireccion', $x6, 2);
				echo form_input('text', 'Identificador', 'ClienteIdentificador', $x7, 2);
				echo form_input('text', 'Comuna', 'ClienteNombreComuna', $x8, 2);
				echo form_date('Fecha de Vencimiento Doc','ClienteFechaVencimiento', $x9, 2);
				
				$opt1 = '';
				$opt2 = '';
				$opt3 = '';
				switch ($x10) {
					case 'Sin Problemas':      $opt1 = 'selected="selected"'; break;
					case 'Corte en Tramite':   $opt2 = 'selected="selected"'; break;
					case 'Suministro cortado': $opt3 = 'selected="selected"'; break;
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Estado</label>
					<div class="col-lg-8">
						<select name="ClienteEstado" id="ClienteEstado" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Sin Problemas"      '.$opt1.'>Sin Problemas</option>
							<option value="Corte en Tramite"   '.$opt2.'>Corte en Tramite</option>
							<option value="Suministro cortado" '.$opt3.'>Suministro cortado</option>
						</select>
					</div>
				</div>';
				
				
				/*********************************************************/
				echo '<h3>Valores Consumo</h3>';
				echo form_input_number('Cargo Fijo Valor','DetalleCargoFijoValor', $x11, 1);
				echo form_input_number('Consumo Metros Cubicos','DetalleConsumoCantidad', $x12, 1);
				echo form_input_number('Consumo Valor','DetalleConsumoValor', $x13, 1);
				echo form_input_number('Recoleccion Metros Cubicos','DetalleRecoleccionCantidad', $x14, 1);
				echo form_input_number('Recoleccion Valor','DetalleRecoleccionValor', $x15, 1);
				
				echo '<h3>Cortes</h3>';
				echo form_input_number('Corte 1° Instancia Valor','DetalleCorte1Valor', $x16, 1);
				echo form_date('Corte 1° Instancia Fecha','DetalleCorte1Fecha', $x17, 1);
				echo form_input_number('Corte 2° Instancia Valor','DetalleCorte2Valor', $x18, 1);
				echo form_date('Corte 2° Instancia Fecha','DetalleCorte2Fecha', $x19, 1);
				
				echo '<h3>Reposiciones</h3>';
				echo form_input_number('Reposicion 1° Instancia Valor','DetalleReposicion1Valor', $x20, 1);
				echo form_date('Reposicion 1° Instancia Fecha','DetalleReposicion1Fecha', $x21, 1);
				echo form_input_number('Reposicion 2° Instancia Valor','DetalleReposicion2Valor', $x22, 1);
				echo form_date('Reposicion 2° Instancia Fecha','DetalleReposicion2Fecha', $x23, 1);
				
				echo '<h3>Subtotales</h3>';
				echo form_input_number('Subtotal Servicio','DetalleSubtotalServicio', $x24, 2);
				echo form_input_number('Interes Deuda','DetalleInteresDeuda', $x25, 1);
				
				echo '<h3>Otros Cargos</h3>';
				echo form_input('text', 'Otros Cargos 1 Detalle', 'DetalleOtrosCargos1Texto', $x26, 1);
				echo form_input_number('Otros Cargos 1 Valor','DetalleOtrosCargos1Valor', $x27, 1);
				echo form_date('Otros Cargos 1 Fecha','DetalleOtrosCargos1Fecha', $x28, 1);
				echo form_input('text', 'Otros Cargos 2 Detalle', 'DetalleOtrosCargos2Texto', $x29, 1);
				echo form_input_number('Otros Cargos 2 Valor','DetalleOtrosCargos2Valor', $x30, 1);
				echo form_date('Otros Cargos 2 Fecha','DetalleOtrosCargos2Fecha', $x31, 1);
				echo form_input('text', 'Otros Cargos 3 Detalle', 'DetalleOtrosCargos3Texto', $x32, 1);
				echo form_input_number('Otros Cargos 3 Valor','DetalleOtrosCargos3Valor', $x33, 1);
				echo form_date('Otros Cargos 3 Fecha','DetalleOtrosCargos3Fecha', $x34, 1);
				echo form_input('text', 'Otros Cargos 4 Detalle', 'DetalleOtrosCargos4Texto', $x35, 1);
				echo form_input_number('Otros Cargos 4 Valor','DetalleOtrosCargos4Valor', $x36, 1);
				echo form_date('Otros Cargos 4 Fecha','DetalleOtrosCargos4Fecha', $x37, 1);
				echo form_input('text', 'Otros Cargos 5 Detalle', 'DetalleOtrosCargos5Texto', $x38, 1);
				echo form_input_number('Otros Cargos 5 Valor','DetalleOtrosCargos5Valor', $x39, 1);
				echo form_date('Otros Cargos 5 Fecha','DetalleOtrosCargos5Fecha', $x40, 1);
				
				echo '<h3>Totales</h3>';
				echo form_input_number('Total Venta','DetalleTotalVenta', $x41, 2);
				echo form_input_number('Saldo a Favor','DetalleSaldoFavor', $x42, 1);
				echo form_input_number('Saldo Anterior','DetalleSaldoAnterior', $x43, 1);
				echo form_input_number('Total a Pagar','DetalleTotalAPagar', $x44, 2);
				
				echo '<h3>Consumo Ultimos Meses</h3>';
				echo form_input_number('Mes 1 Valor','GraficoMes1Valor', $x45, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x46) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 1</label>
					<div class="col-lg-8">
						<select name="GraficoMes1Fecha" id="GraficoMes1Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 2 Valor','GraficoMes2Valor', $x47, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x48) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 2</label>
					<div class="col-lg-8">
						<select name="GraficoMes2Fecha" id="GraficoMes2Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 3 Valor','GraficoMes3Valor', $x49, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x50) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 3</label>
					<div class="col-lg-8">
						<select name="GraficoMes3Fecha" id="GraficoMes3Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 4 Valor','GraficoMes4Valor', $x51, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x52) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 4</label>
					<div class="col-lg-8">
						<select name="GraficoMes4Fecha" id="GraficoMes4Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 5 Valor','GraficoMes5Valor', $x53, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x54) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 5</label>
					<div class="col-lg-8">
						<select name="GraficoMes5Fecha" id="GraficoMes5Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 6 Valor','GraficoMes6Valor', $x55, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x56) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 6</label>
					<div class="col-lg-8">
						<select name="GraficoMes6Fecha" id="GraficoMes6Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 7 Valor','GraficoMes7Valor', $x57, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x58) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 7</label>
					<div class="col-lg-8">
						<select name="GraficoMes7Fecha" id="GraficoMes7Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 8 Valor','GraficoMes8Valor', $x59, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x60) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 8</label>
					<div class="col-lg-8">
						<select name="GraficoMes8Fecha" id="GraficoMes8Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 9 Valor','GraficoMes9Valor', $x61, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x62) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 9</label>
					<div class="col-lg-8">
						<select name="GraficoMes9Fecha" id="GraficoMes9Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 10 Valor','GraficoMes10Valor', $x63, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x64) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 10</label>
					<div class="col-lg-8">
						<select name="GraficoMes10Fecha" id="GraficoMes10Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 11 Valor','GraficoMes11Valor', $x65, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x66) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 11</label>
					<div class="col-lg-8">
						<select name="GraficoMes11Fecha" id="GraficoMes11Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				echo form_input_number('Mes 12 Valor','GraficoMes12Valor', $x67, 1);
				$opt1 = ''; $opt2 = ''; $opt3 = ''; $opt4 = ''; $opt5 = ''; $opt6 = ''; $opt7 = ''; $opt8 = ''; $opt9 = ''; $opt10 = ''; $opt11 = ''; $opt12 = '';
				switch ($x68) {
					case 'Ene': $opt1  = 'selected="selected"'; break;
					case 'Feb': $opt2  = 'selected="selected"'; break;
					case 'Mar': $opt3  = 'selected="selected"'; break;
					case 'Abr': $opt4  = 'selected="selected"'; break;
					case 'May': $opt5  = 'selected="selected"'; break;
					case 'Jun': $opt6  = 'selected="selected"'; break;
					case 'Jul': $opt7  = 'selected="selected"'; break;
					case 'Ago': $opt8  = 'selected="selected"'; break;
					case 'Sep': $opt9  = 'selected="selected"'; break;
					case 'Oct': $opt10 = 'selected="selected"'; break;
					case 'Nov': $opt11 = 'selected="selected"'; break;
					case 'Dic': $opt12 = 'selected="selected"'; break;	
				}
				echo '
				<div class="form-group" id="div_ClienteEstado">
					<label for="text2" class="control-label col-lg-4" id="label_ClienteEstado">Mes 12</label>
					<div class="col-lg-8">
						<select name="GraficoMes12Fecha" id="GraficoMes12Fecha" class="form-control" required="">
							<option value="" selected="">Seleccione una Opcion</option>
							<option value="Ene" '.$opt1.'>Ene</option>
							<option value="Feb" '.$opt2.'>Feb</option>
							<option value="Mar" '.$opt3.'>Mar</option>
							<option value="Abr" '.$opt4.'>Abr</option>
							<option value="May" '.$opt5.'>May</option>
							<option value="Jun" '.$opt6.'>Jun</option>
							<option value="Jul" '.$opt7.'>Jul</option>
							<option value="Ago" '.$opt8.'>Ago</option>
							<option value="Sep" '.$opt9.'>Sep</option>
							<option value="Oct" '.$opt10.'>Oct</option>
							<option value="Nov" '.$opt11.'>Nov</option>
							<option value="Dic" '.$opt12.'>Dic</option>
						</select>
					</div>
				</div>';
				/***********************************************/
				
				
				echo '<h3>Detalle de Consumo</h3>';
				echo form_input_number('Lectura Mes anterior Cantidad','DetConsMesAnteriorCantidad', $x69, 2);
				echo form_date('Lectura Mes anterior Fecha','DetConsMesAnteriorFecha', $x70, 2);
				echo form_input_number('Lectura Mes actual Cantidad','DetConsMesActualCantidad', $x71, 2);
				echo form_date('Lectura Mes actual Fecha','DetConsMesActualFecha', $x72, 2);
				echo form_input_number('Diferencia de lecturas','DetConsMesDiferencia', $x73, 2);
				echo form_input_number('Adicionales por prorrateo','DetConsProrateo', $x74, 1);
				echo form_input('text', 'Adicionales por prorrateo Signo', 'DetConsProrateoSigno', $x75, 1);
				echo form_input_number('Consumo Mes Total','DetConsMesTotalCantidad', $x76, 2);
				echo form_date('Proxima lectura estimada','DetConsFechaProxLectura', $x77, 2);
				echo form_input('text', 'Modalidad de prorrateo', 'DetConsModalidad', $x78, 1);
				echo form_input('text', 'Emergencias 24 horas', 'DetConsFonoEmergencias', $x79, 1);
				echo form_input('text', 'Consultas Lunes a Viernes', 'DetConsFonoConsultas', $x80, 1);
				
				echo '<h3>Aguas Informa</h3>';
				echo form_input_number('Cargo fijo','AguasInfCargoFijo', $x81, 2);
				echo form_input_number('Metro cubico agua potable','AguasInfMetroAgua', $x82, 2);
				echo form_input_number('Metro cubico recoleccion','AguasInfMetroRecolecion', $x83, 2);
				echo form_input_number('Visita corte','AguasInfVisitaCorte', $x84, 2);
				echo form_input_number('Corte 1° instancia','AguasInfCorte1', $x85, 2);
				echo form_input_number('Corte 2° instancia','AguasInfCorte2', $x86, 2);
				echo form_input_number('Reposicion 1° instancia','AguasInfReposicion1', $x87, 2);
				echo form_input_number('Reposicion 2° instancia','AguasInfReposicion2', $x88, 2);
				echo form_input_number('Factor de cobro del periodo','AguasInfFactorCobro', $x89, 2);
				echo form_input_number('Diferencia medidor general','AguasInfDifMedGeneral', $x90, 1);
				echo form_input_number('Porcentaje Prorrateo','AguasInfProcProrrateo', $x91, 1);
				echo form_input_number('Punto servicio diametro','AguasInfPuntoDiametro', $x93, 2);
				echo form_input('text', 'Clave facturacion', 'AguasInfClaveFacturacion', $x94, 2);
				echo form_input('text', 'Clave Lectura', 'AguasInfClaveLectura', $x95, 2);
				echo form_input('text', 'Numero medidor', 'AguasInfNumeroMedidor', $x96, 2);
				echo form_date('Fecha emision','AguasInfFechaEmision', $x97, 2);
				echo form_date('Ultimo pago Fecha','AguasInfUltimoPagoFecha', $x98, 2);
				echo form_input_number('Ultimo pago Monto','AguasInfUltimoPagoMonto', $x99, 2);
				echo form_date('Considera movimientos hasta','AguasInfMovimientosHasta', $x100, 2);
				
				echo '<h3>Gestion Interna</h3>';
				echo form_select('Estado','idEstado', $x101, 2, 'idEstado', 'Nombre', 'facturacion_listado_detalle_estado', 0, $dbConn);
				echo form_input_number('Interes Anual','intAnual', $x102, 2);
				echo form_select('Documento de Pago','idTipoPago', $x103, 1, 'idTipoPago', 'Nombre', 'facturacion_listado_detalle_tipo_pago', 0, $dbConn);
				echo form_input('text', 'Numero Documento de Pago', 'nDocPago', $x104, 1);
				echo form_date('Fecha de Pago','fechaPago', $x105, 1);
				echo form_input_number('Monto de Pago','montoPago', $x106, 1);
				echo form_select('Usuario Pago','idUsuarioPago', $x107, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'idSistema>=0  AND idEstado=1 AND tipo!="SuperAdmin"', $dbConn);
				
				
				
					
					
				echo '<input type="hidden" name="idFacturacionDetalle"   value="'.$_GET['view'].'" >';		 
				?>
								
				<div class="form-group">
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>






 
          


			<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
