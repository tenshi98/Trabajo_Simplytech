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
$original = "informe_facturacion_4.php";
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
// Se trae un listado con todos los usuarios
$arrFacturacion = array();
$query = "SELECT  
ClienteIdentificador, 
DetalleCargoFijoValor, DetalleConsumoValor, DetalleRecoleccionValor,
DetalleVisitaCorte, DetalleCorte1Valor, DetalleCorte2Valor, DetalleReposicion1Valor, DetalleReposicion2Valor,
DetalleInteresDeuda,
DetalleOtrosCargos1Valor, DetalleOtrosCargos2Valor, DetalleOtrosCargos3Valor,DetalleOtrosCargos4Valor, DetalleOtrosCargos5Valor,
DetalleTotalAPagar,
Fecha

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
			<h5>Facturacion Mes de <?php echo Fecha_mes_año($arrFacturacion[0]['Fecha']);?> </h5>
			<div class="toolbar">
				<?php
				$zz  = '?idSistema='.$arrUsuario['idSistema'];
				$zz .= '&idMes='.$_GET['idMes'];
				$zz .= '&Ano='.$_GET['Ano'];
				?>
				<a target="new" href="informe_facturacion_4_to_excel.php<?php echo $zz ?>" class="btn btn-sm btn-metis-2"><i class="fa fa-file-excel-o"></i> Exportar a Excel</a>
			</div>
		</header>
		<div class="table-responsive"> 
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th>Consumo mes</th>
						<th>Otros Cargos</th>
						<th>Intereses</th>
						<th>Total Con IVA</th>
						<th>IVA</th>
						<th>Total Sin IVA</th>
					</tr>
				</thead>
					  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php 
					//variables en 0
					$t_consumo_mes  = 0;
					$t_OtrosCargos  = 0;
					$t_Intereses    = 0;
					$t_TotalConIva  = 0;
					$t_iva          = 0;
					$t_TotalSinIva  = 0;
					//se recorre arreglo
					foreach ($arrFacturacion as $fact) { 
						//Se hacen los calculos
						$consumo_mes  = $fact['DetalleCargoFijoValor'] + $fact['DetalleConsumoValor'] + $fact['DetalleRecoleccionValor'];
						$OtrosCargos  = $fact['DetalleVisitaCorte'] + $fact['DetalleCorte1Valor'] + $fact['DetalleCorte2Valor'] + $fact['DetalleReposicion1Valor'] + $fact['DetalleReposicion2Valor'] + $fact['DetalleOtrosCargos1Valor'] + $fact['DetalleOtrosCargos2Valor'] + $fact['DetalleOtrosCargos3Valor'] + $fact['DetalleOtrosCargos4Valor'] + $fact['DetalleOtrosCargos5Valor'];
						$Intereses    = $fact['DetalleInteresDeuda'];
						$TotalConIva  = $consumo_mes + $OtrosCargos + $Intereses;
						$iva          = $TotalConIva - ($TotalConIva / 1.19);
						$TotalSinIva  = $TotalConIva / 1.19;
						//se guardan totales
						$t_consumo_mes  = $t_consumo_mes + $consumo_mes;
						$t_OtrosCargos  = $t_OtrosCargos + $OtrosCargos;
						$t_Intereses    = $t_Intereses + $Intereses;
						$t_TotalConIva  = $t_TotalConIva + $TotalConIva;
						$t_iva          = $t_iva + $iva;
						$t_TotalSinIva  = $t_TotalSinIva + $TotalSinIva;
					?>
					<tr class="odd">
						<td><?php echo $fact['ClienteIdentificador']; ?></td>
						<td><?php echo valores($consumo_mes, 0); ?></td>
						<td><?php echo valores($OtrosCargos, 0); ?></td>
						<td><?php echo valores($Intereses, 0); ?></td>
						<td><?php echo valores($TotalConIva, 0); ?></td>
						<td><?php echo valores($iva, 0); ?></td>
						<td><?php echo valores($TotalSinIva, 0); ?></td>
					</tr>
				<?php } ?> 
					<tr class="odd">
						<td colspan="7"></td>
					</tr>
					<tr class="odd">
						<td>Totales</td>
						<td><?php echo valores($t_consumo_mes, 0); ?></td>
						<td><?php echo valores($t_OtrosCargos, 0); ?></td>
						<td><?php echo valores($t_Intereses, 0); ?></td>
						<td><?php echo valores($t_TotalConIva, 0); ?></td>
						<td><?php echo valores($t_iva, 0); ?></td>
						<td><?php echo valores($t_TotalSinIva, 0); ?></td>
					</tr>	                    
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
