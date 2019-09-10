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
//Armo cadena
$cadena  = 'Nombre, idNota_1, idNota_2, idNota_3, idNotaTipo_1, idNotaTipo_2, idNotaTipo_3';
for ($i = 1; $i <= 100; $i++) {
	$cadena .= ',PuntoNombre_'.$i;
	$cadena .= ',PuntoidTipo_'.$i;
	$cadena .= ',PuntoidGrupo_'.$i;
	$cadena .= ',PuntoUniMed_'.$i;
}

// tomo los datos del usuario
$query = "SELECT ".$cadena."
FROM `cross_quality_calidad_matriz`
WHERE idMatriz = {$_GET['view']}";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
$rowdata = mysqli_fetch_assoc ($resultado); 

/***********************************************/
// Se trae un listado con todos los grupos
$arrGrupo = array();
$query = "SELECT idGrupo, Nombre, Totales
FROM `cross_quality_calidad_matriz_grupos` ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrGrupo,$row );
}
/***********************************************/
// Se trae un listado con todas las unidades de medida
$arrUnidadMedida = array();
$query = "SELECT idUml, Nombre
FROM `sistema_cross_analisis_uml` ";
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//variables
	$NombreUsr   = $_SESSION['usuario']['basic_data']['Nombre'];
	$Transaccion = basename($_SERVER["REQUEST_URI"], ".php");

	//generar log
	error_log("========================================================================================================================================", 0);
	error_log("Usuario: ". $NombreUsr, 0);
	error_log("Transaccion: ". $Transaccion, 0);
	error_log("-------------------------------------------------------------------", 0);
	error_log("Error code: ". mysqli_errno($dbConn), 0);
	error_log("Error description: ". mysqli_error($dbConn), 0);
	error_log("Error query: ". $query, 0);
	error_log("-------------------------------------------------------------------", 0);
					
}
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUnidadMedida,$row );
}

?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos de la Matriz</h5>	
		</header>
        <div id="div-3" class="tab-content">
			
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
										<div class="col-sm-12">
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


<?php if(isset($_GET['return'])&&$_GET['return']!=''){ ?>
	<div class="clearfix"></div>
		<div class="col-sm-12 fcenter" style="margin-bottom:30px">
		<a href="#" onclick="history.back()" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
		<div class="clearfix"></div>
	</div>
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Views.php';
?>
