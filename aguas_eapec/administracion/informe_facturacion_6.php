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
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "informe_facturacion_6.php";
$location = $original;
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit_filter']) )  { 
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'filtro_por_fechas';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_filtros.php';
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
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
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
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['submit_filter']) ) {
//Calculos de los meses
$mesAnterior  = $_GET['idMes']-1;
$anoActual    = $_GET['Ano'];
if($mesAnterior==0){
	$mesAnterior = 12;
	$anoActual = $anoActual-1;	
}
			
			
// Se trae un listado con todos los usuarios
$arrFacturacion = array();
$query = "SELECT
idFacturacionDetalle,
idCliente, 
Fecha,
ClienteIdentificador,
DetalleCargoFijoValor,
DetalleConsumoCantidad,
DetalleConsumoValor,
AguasInfMetroAgua,
AguasInfMetroRecolecion,
DetalleRecoleccionCantidad,
DetalleRecoleccionValor,
DetalleVisitaCorte,
DetalleCorte1Valor,
DetalleCorte2Valor,
DetalleReposicion1Valor,
DetalleReposicion2Valor,
DetalleSubtotalServicio,
DetalleInteresDeuda,
DetalleSaldoFavor,
DetalleTotalVenta,
DetalleSaldoAnterior,
DetalleOtrosCargos1Valor,
DetalleOtrosCargos2Valor,
DetalleOtrosCargos3Valor,
DetalleOtrosCargos4Valor,
DetalleOtrosCargos5Valor,
DetalleTotalAPagar,
AguasInfUltimoPagoFecha,
AguasInfUltimoPagoMonto,
intAnual,
(SELECT DetalleTotalAPagar
FROM `facturacion_listado_detalle` AS txt
WHERE txt.idCliente = facturacion_listado_detalle.idCliente AND txt.idMes = {$mesAnterior} AND txt.Ano = {$anoActual}
ORDER BY txt.Fecha DESC
LIMIT 1) AS TotalPagarAnterior
				

FROM `facturacion_listado_detalle`
WHERE idMes = {$_GET['idMes']} 
AND Ano = {$_GET['Ano']} 
ORDER BY ClienteIdentificador ASC";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrFacturacion,$row );
} 


?>
 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Facturacion fecha <?php echo Fecha_estandar($arrFacturacion[0]['Fecha']);?> </h5>
			<div class="toolbar">
				<?php
				$zz  = '?idSistema='.$arrUsuario['idSistema'];
				$zz .= '&idMes='.$_GET['idMes'];
				$zz .= '&Ano='.$_GET['Ano'];
				?>
				<a target="new" href="informe_facturacion_6_to_excel.php<?php echo $zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
			</div>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>Cargo Fijo</th>
						
						<th>Consumo Cantidad</th>
						<th>Consumo Valor</th>
						<th>Revision Consumo Valor</th>
						
						<th>Recoleccion Cantidad</th>
						<th>Recoleccion Valor</th>
						<th>Revision Recoleccion Valor</th>
						
						<th>Visita Corte</th>
						<th>Corte 1 instancia</th>
						<th>Corte 2 instancia</th>
						<th>Reposicion 1 instancia</th>
						<th>Reposicion 2 instancia</th>
						<th>Subtotal Servicio</th>
						<th>Revision Subtotal Servicio</th>
						
						<th>Interes Deuda</th>
						<th>Revision interes saldo anterior</th>
						<th>Revision interes pago fuera frecha</th>
						<th>Suma Revision</th>
						<th>Otros Cargos 1</th>
						<th>Otros Cargos 2</th>
						<th>Otros Cargos 3</th>
						<th>Otros Cargos 4</th>
						<th>Otros Cargos 5</th>
						<th>Total Venta</th>
						<th>Revision Total Venta</th>
						
						
						<th>Saldo Favor</th>
						
						
						<th>Saldo Anterior</th>
						
						<th>Total Pagar</th>
						<th>Revision Total Pagar</th>
						
					</tr>
				</thead>


					  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php 
				
				//funcion fecha anterior
				function dif_dias($year, $month, $nn, $dia){
					//se construye una fecha
					$mes_ant  = $month - $nn;
					$ano      = $year;
					//verifico que el mes restado sea correcto
					if($mes_ant==0){
						$mes_ant  = 12;
						$ano      = $year - 1;
					}
					//le agrego un cero en caso de ser inferior a 10
					if($mes_ant < 10){
						$mes_ant = '0'.$mes_ant;
					}
					//construyo la fecha
					return $fecha_completa = $ano.'-'.$mes_ant.'-'.$dia;
					
					
				}
			
				foreach ($arrFacturacion as $fact) { 
					$RevIntereses         = 0;
					$fecha_vencimiento = dif_dias($_GET['Ano'], $_GET['idMes'], 1, 25);
					$fecha_facturacion = $fact['Fecha'];
		
					
					/* ************************************************** */
					//variables
					$SaldoAnterior  = 0;
					$PagoFueraFecha  = 0;
					
					//intereses por saldo anterior impago
					if(isset($fact['DetalleSaldoAnterior'])&&$fact['DetalleSaldoAnterior']!=0){
						$ndiasdif       = (dias_transcurridos($fecha_facturacion,$fecha_vencimiento))-1;
						$SaldoAnterior  = valores_truncados((($ndiasdif * $fact['DetalleSaldoAnterior'] * $fact['intAnual'])/36000)*1.19);
					}
					//Se verifica si pago despues de la fecha limite
					if($fact['AguasInfUltimoPagoFecha'] > $fecha_vencimiento){
						$ndiasdif = dias_transcurridos($fact['AguasInfUltimoPagoFecha'],$fecha_vencimiento);
						//se da 1 dia de gracia
						$ndiasdif = $ndiasdif - 1;
						//si la resta queda inferior a 0
						if($ndiasdif < 0){
							$ndiasdif = 0;
						}
						$PagoFueraFecha  = valores_truncados((($ndiasdif * $fact['TotalPagarAnterior'] * $fact['intAnual'])/36000)*1.19);
					}
							
					$RevIntereses = $SaldoAnterior + $PagoFueraFecha;		

					//variables 
					$RevConsumo           = valores_truncados($fact['DetalleConsumoCantidad']*$fact['AguasInfMetroAgua']);
					$RevRecoleccion       = valores_truncados($fact['DetalleRecoleccionCantidad']*$fact['AguasInfMetroRecolecion']);
					$RevSubtotalServicio  = $fact['DetalleCargoFijoValor'] + $RevConsumo + $RevRecoleccion + $fact['DetalleVisitaCorte'] + $fact['DetalleCorte1Valor'] + $fact['DetalleCorte2Valor'] + $fact['DetalleReposicion1Valor'] + $fact['DetalleReposicion2Valor'];
					$RevTotalVenta        = $RevSubtotalServicio + $RevIntereses + $fact['DetalleOtrosCargos1Valor'] + $fact['DetalleOtrosCargos2Valor'] + $fact['DetalleOtrosCargos3Valor'] + $fact['DetalleOtrosCargos4Valor'] + $fact['DetalleOtrosCargos5Valor'];
					$RevTotalAPagar       = $RevTotalVenta + $fact['DetalleSaldoAnterior'] - $fact['DetalleSaldoFavor']; 
						
					//revisiones
					if($fact['DetalleConsumoValor']!=$RevConsumo){               $ErrorConsumo = 'Error';          }else{$ErrorConsumo = '';}
					if($fact['DetalleRecoleccionValor']!=$RevRecoleccion){       $ErrorRecoleccion = 'Error';      }else{$ErrorRecoleccion = '';}
					if($fact['DetalleSubtotalServicio']!=$RevSubtotalServicio){  $ErrorSubtotalServicio = 'Error'; }else{$ErrorSubtotalServicio = '';}
					if($fact['DetalleInteresDeuda']!=$RevIntereses){             $ErrorIntereses = 'Error';        }else{$ErrorIntereses = '';}
					if($fact['DetalleTotalVenta']!=$RevTotalVenta){              $ErrorTotalVenta = 'Error';       }else{$ErrorTotalVenta = '';}
					if($fact['DetalleTotalAPagar']!=$RevTotalAPagar){            $ErrorTotalAPagar = 'Error';      }else{$ErrorTotalAPagar = '';}
					if($fact['DetalleTotalAPagar'] <= 0){$td = 'info';}else{$td = '';}
					
					/*
					//Se actualizan los datos
					$a = "idFacturacionDetalle='".$fact['idFacturacionDetalle']."'" ;
					if(isset($RevIntereses) && $RevIntereses != ''){         $a .= ",DetalleInteresDeuda='".$RevIntereses."'" ;}
					if(isset($RevTotalVenta) && $RevTotalVenta != ''){       $a .= ",DetalleTotalVenta='".$RevTotalVenta."'" ;}
					if(isset($RevTotalAPagar) && $RevTotalAPagar != ''){     $a .= ",DetalleTotalAPagar='".$RevTotalAPagar."'" ;}
					
					// inserto los datos de registro en la db
					$query  = "UPDATE `facturacion_listado_detalle` SET ".$a." WHERE idFacturacionDetalle = '{$fact['idFacturacionDetalle']}'";
					$result = mysqli_query($dbConn, $query);
					*/
					
					?>
					
						
					<tr class="odd <?php echo $td ?>">
						<td><?php echo $fact['ClienteIdentificador']; ?></td>
						<td><?php echo $fact['DetalleCargoFijoValor']; ?></td>
						
						<td><?php echo $fact['DetalleConsumoCantidad']; ?></td>
						<td><?php echo $fact['DetalleConsumoValor']; ?></td>
						<td <?php if($ErrorConsumo!=''){echo 'class="danger"';}else{echo 'class="success"';}?>>
							<?php echo $fact['DetalleConsumoCantidad'].' * '.$fact['AguasInfMetroAgua'].' = <strong>'.$RevConsumo.'</strong>'; ?>
						</td>
						
						<td><?php echo $fact['DetalleRecoleccionCantidad']; ?></td>
						<td><?php echo $fact['DetalleRecoleccionValor']; ?></td>
						<td <?php if($ErrorRecoleccion!=''){echo 'class="danger"';}else{echo 'class="success"';}?>>
							<?php echo $fact['DetalleRecoleccionCantidad'].' * '.$fact['AguasInfMetroRecolecion'].' = <strong>'.$RevRecoleccion.'</strong>'; ?>
						</td>
						
						<td><?php echo $fact['DetalleVisitaCorte']; ?></td>
						<td><?php echo $fact['DetalleCorte1Valor']; ?></td>
						<td><?php echo $fact['DetalleCorte2Valor']; ?></td>
						<td><?php echo $fact['DetalleReposicion1Valor']; ?></td>
						<td><?php echo $fact['DetalleReposicion2Valor']; ?></td>
						<td><?php echo $fact['DetalleSubtotalServicio']; ?></td>
						<td <?php if($ErrorSubtotalServicio!=''){echo 'class="danger"';}else{echo 'class="success"';}?>>
							<?php echo $fact['DetalleCargoFijoValor'].' + '.$RevConsumo.' + '.$RevRecoleccion.' + '.$fact['DetalleVisitaCorte'].' + '.$fact['DetalleCorte1Valor'].' + '.$fact['DetalleCorte2Valor'].' + '.$fact['DetalleReposicion1Valor'].' + '.$fact['DetalleReposicion2Valor'].' = <strong>'.$RevSubtotalServicio.'</strong>'; ?>
						</td>
						
						<td><?php echo $fact['DetalleInteresDeuda']; ?></td>
						<td class="success" ><?php 
							if(isset($fact['DetalleSaldoAnterior'])&&$fact['DetalleSaldoAnterior']!=0){
								echo '((((('.$fecha_facturacion.'-'.$fecha_vencimiento.')-1) * '.$fact['DetalleSaldoAnterior'].' * '.cantidades($fact['intAnual'], 2).')/36000)*1.19) = <strong>'.$SaldoAnterior.'</strong>'; 
							}?>
						</td>
						<td class="success" ><?php 
							if($fact['AguasInfUltimoPagoFecha'] > $fecha_vencimiento){
								echo '((((('.$fact['AguasInfUltimoPagoFecha'].'-'.$fecha_vencimiento.')-1) * '.$fact['TotalPagarAnterior'].' * '.cantidades($fact['intAnual'], 2).')/36000)*1.19) = <strong>'.$PagoFueraFecha.'</strong>'; 
							}?>
						</td>
						<td <?php if($ErrorIntereses!=''){echo 'class="danger"';}else{echo 'class="success"';}?>>
						<?php echo $SaldoAnterior.' + '.$PagoFueraFecha.' = <strong>'.$RevIntereses.'</strong>'; ?>
						</td>
						<td><?php echo $fact['DetalleOtrosCargos1Valor']; ?></td>
						<td><?php echo $fact['DetalleOtrosCargos2Valor']; ?></td>
						<td><?php echo $fact['DetalleOtrosCargos3Valor']; ?></td>
						<td><?php echo $fact['DetalleOtrosCargos4Valor']; ?></td>
						<td><?php echo $fact['DetalleOtrosCargos5Valor']; ?></td>
						
						<td><?php echo $fact['DetalleTotalVenta']; ?></td>
						<td <?php if($ErrorTotalVenta!=''){echo 'class="danger"';}else{echo 'class="success"';}?>>
							<?php echo $RevSubtotalServicio.' + '.$RevIntereses.' + '.$fact['DetalleOtrosCargos1Valor'].' + '.$fact['DetalleOtrosCargos2Valor'].' + '.$fact['DetalleOtrosCargos3Valor'].' + '.$fact['DetalleOtrosCargos4Valor'].' + '.$fact['DetalleOtrosCargos5Valor'].' = <strong>'.$RevTotalVenta.'</strong>'; ?>
						</td>
						<td><?php echo $fact['DetalleSaldoFavor']; ?></td>
						<td><?php echo $fact['DetalleSaldoAnterior']; ?></td>
						<td><?php echo $fact['DetalleTotalAPagar']; ?></td>
						<td <?php if($ErrorTotalAPagar!=''){echo 'class="danger"';}else{echo 'class="success"';}?>>
							<?php echo $RevTotalVenta.' + '.$fact['DetalleSaldoAnterior'].' - '.$fact['DetalleSaldoFavor'].' = <strong>'.$RevTotalAPagar.'</strong>'; ?>
						</td>
						
						
					</tr>
				<?php } ?> 
						
				</tbody>
			</table>
		</div>
	</div>
</div>
  
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $original; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro de Busqueda</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal"  name="form1" action="<?php echo $location; ?>">
			
				<?php 
				//Se verifican si existen los datos
				if(isset($Ano)) {      $x1  = $Ano;    }else{$x1  = '';}
				if(isset($idMes)) {    $x2  = $idMes;  }else{$x2  = '';}
				

				//se dibujan los inputs
				echo form_select_n_auto('Año','Ano', $x1, 2, 2016, 2030);
				echo form_select('Mes','idMes', $x1, 2, 'idMes', 'Nombre', 'mnt_meses', 0, $dbConn);
				
						
				?>        
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width" value="Filtrar" name="submit_filter"> 
				</div>
                      
			</form> 
                    
		</div>
	</div>
</div> 
<?php } ?>
<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
