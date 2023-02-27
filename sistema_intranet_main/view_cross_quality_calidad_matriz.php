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
if(isset($_SESSION['usuario']['basic_data']['ConfigTime'])&&$_SESSION['usuario']['basic_data']['ConfigTime']!=0){$n_lim = $_SESSION['usuario']['basic_data']['ConfigTime']*60;set_time_limit($n_lim);}else{set_time_limit(2400);}
//Memora RAM Maxima del servidor, 4GB por defecto
if(isset($_SESSION['usuario']['basic_data']['ConfigRam'])&&$_SESSION['usuario']['basic_data']['ConfigRam']!=0){$n_ram = $_SESSION['usuario']['basic_data']['ConfigRam']; ini_set('memory_limit', $n_ram.'M');}else{ini_set('memory_limit', '4096M');}
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
//Armo cadena
$SIS_query  = 'Nombre,idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3';
for ($i = 1; $i <= 100; $i++) {
	$SIS_query .= ',PuntoNombre_'.$i;
	$SIS_query .= ',PuntoidTipo_'.$i;
	$SIS_query .= ',PuntoidGrupo_'.$i;
	$SIS_query .= ',PuntoUniMed_'.$i;
}
// consulto los datos
$SIS_join  = '';
$SIS_where = 'idMatriz ='.$X_Puntero;
$rowdata = db_select_data (false, $SIS_query, 'cross_quality_calidad_matriz', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'rowdata');

/***********************************************/
// Se consulta
$SIS_query = 'idGrupo, Nombre,Totales';
$SIS_join  = '';
$SIS_where = 'Nombre!=""';
$SIS_order = 'Nombre ASC';
$arrGrupo = array();
$arrGrupo = db_select_array (false, $SIS_query, 'cross_quality_calidad_matriz_grupos', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrGrupo');

/***********************************************/
// Se consulta
$SIS_query = 'idUml, Nombre';
$SIS_join  = '';
$SIS_where = 'Nombre!=""';
$SIS_order = 'Nombre ASC';
$arrUnidadMedida = array();
$arrUnidadMedida = db_select_array (false, $SIS_query, 'sistema_cross_analisis_uml', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], basename($_SERVER["REQUEST_URI"], ".php"), 'arrUnidadMedida');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div>
			<h5>Datos de la Matriz</h5>
		</header>
        <div class="tab-content">

			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<div class="table-responsive">

						<table id="dataTable" class="table table-bordered table-condensed">				  
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd">
									<td class="word_break">
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Comunes</h2>
										<p class="text-muted">
											<strong>Productor </strong><br/>
											<strong>N° Folio / Pallet </strong><br/>
											<strong>Tipo Embalaje </strong><br/>
											<strong>Lote </strong><br/>       
											<strong>Fecha Embalaje </strong> <br/> 
											<strong>Fecha Cosecha </strong> <br/>   
											<strong>Hora Inspeccion </strong> <br/>  
											<strong>N° Cajas/Bolsas/Racimos </strong> <br/> 
											<strong>Peso Caja </strong>  <br/>              
										</p>
									</td>
								</tr>
								<tr class="odd">
									<td class="word_break">
										<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Configurados</h2>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<?php
											foreach ($arrGrupo as $grupo) {
												//Cuento si hay items dentro de la categoria
												$x_con = 0;
												for ($i = 1; $i <= 100; $i++) {
													if($grupo['idGrupo']==$rowdata['PuntoidGrupo_'.$i]){
														$x_con++;
													}
												}
														
												//si hay items se muestra todo
												if($x_con!=0){
													//Variable subtotal
													$subto = 0;
													//se arma la ventana
													echo '
													<div class="col-xs-4">
														<p class="lead">'.$grupo['Nombre'].'</p>
														<p class="text-muted well well-sm no-shadow" >';
													
															
													
														
													for ($i = 1; $i <= 100; $i++) {
														if($grupo['idGrupo']==$rowdata['PuntoidGrupo_'.$i]){
															//verifico unidad de medida
															$xuni = '';
															foreach ($arrUnidadMedida as $uml) {
																if($rowdata['PuntoUniMed_'.$i]==$uml['idUml']){
																	$xuni = ' '.$uml['Nombre'];
																}
															}
																	
															//Verifico el tipo de dato
															switch ($rowdata['PuntoidTipo_'.$i]) {
																//Medicion (Decimal) con parametros limitantes
																case 1:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong> ('.$xuni.')<br/>';
																	break;
																//Medicion (Decimal) sin parametros limitantes
																case 2:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong> ('.$xuni.')<br/>';
																	break;
																//Medicion (Enteros) con parametros limitantes
																case 3:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong> ('.$xuni.')<br/>';
																	break;
																//Medicion (Enteros) sin parametros limitantes
																case 4:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong> ('.$xuni.')<br/>';
																	break;
																//Fecha
																case 5:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																//Hora
																case 6:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																//Texto Libre
																case 7:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																//Seleccion 1 a 3
																case 8:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																//Seleccion 1 a 5
																case 9:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																//Seleccion 1 a 10
																case 10:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																//Texto Libre con Validacion
																case 11:
																	echo '<strong>'.$rowdata['PuntoNombre_'.$i].' </strong><br/>';
																	break;
																	
															}
														}
													}
													//Se muestran los subtotales
													if(isset($grupo['Totales'])&&$grupo['Totales']==1){
														echo '<br/><strong>Total </strong> ('.$xuni.')<br/>';
													}
													echo '</p>
													</div>';
												}
											}
											
											//se arma la ventana
											echo '
											<div class="col-xs-4">
												<p class="lead">Decision</p>
												<p class="text-muted well well-sm no-shadow" >';
												//Nota Calidad
												if(isset($rowdata['idNota_1'])&&$rowdata['idNota_1']==1){
													echo '<strong>Nota Calidad </strong><br/>';
												}
												//Nota Condicion
												if(isset($rowdata['idNota_2'])&&$rowdata['idNota_2']==1){
													echo '<strong>Nota Condicion </strong><br/>';
												}
												//Calificacion
												if(isset($rowdata['idNota_3'])&&$rowdata['idNota_3']==1){
													echo '<strong>Calificacion </strong><br/>';
												}
																	
											echo '</p>
											</div>';
											
											?>
										</div>
									</td>
								</tr>               
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
			
        </div>
	</div>
</div>

<?php 
//si se entrega la opcion de mostrar boton volver
if(isset($_GET['return'])&&$_GET['return']!=''){
	//para las versiones antiguas
	if($_GET['return']=='true'){ ?>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="#" onclick="history.back()" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px;margin-top:30px;">
			<a href="<?php echo $volver; ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
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
