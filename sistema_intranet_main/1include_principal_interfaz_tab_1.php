<?php
/**************************************************************************/
echo '
<div class="tab-pane fade active in" id="Menu_tab_1">

	<div>

		<div class="col-sm-12 admin-grid">';
						
			//Si existe alguna mantencion se muestra por pantalla
			if(strtotime($Mantenciones['Fecha'])>=strtotime(fecha_actual())){
				echo '
				<div class="col-xs-12" style="margin-top:5px;">
					<div class="alert alert-info alert-white rounded"> 
						<div class="icon"><i class="fa fa-info-circle faa-bounce animated"></i></div> 
						Mantencion programada para el '.fecha_estandar($Mantenciones['Fecha']).'
						desde '.$Mantenciones['Hora_ini'].' hasta las '.$Mantenciones['Hora_fin'].' hrs
					</div>
				</div>
				<div class="clearfix" ></div>';
			}
							
			echo '
			<div class="sort-disable">
				<div class="panel-heading">
					<span class="panel-title pull-left"  style="color: #666;font-weight: 700 !important;">Resumen</span>
				</div>
								
				<div class="panel-body mnw700 of-a">
					<div class="row">
						<div class="col-sm-4">
							<h5 style="color: #666;font-weight: 600 !important;">Notificaciones
								<small class="pull-right fw600 text-primary"></small>
							</h5>
											
							<table class="table mbn covertable">
								<tbody>';
								/****************************************************/
								//Notificaciones
								if($n_permisos['idOpcionesGen_1']=='1' or $idTipoUsuario==1) {
									$temp = '';
									if(isset($subconsulta['Notificacion'])&&$subconsulta['Notificacion']!=0){$temp = 'faa-horizontal animated';}
									echo '
									<tr>
										<td class="text-muted">
											<a href="principal_notificaciones_alt.php?pagina=1" class="iframe"><i class="fa fa-commenting-o '.$temp.' color-gray"></i> Notificaciones del sistema</a>
										</td>
										<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['Notificacion'].'</td>
									</tr>';
								}
								/****************************************************/
								//Eventos del calendario
								if($n_permisos['idOpcionesGen_1']=='1' or $idTipoUsuario==1) {
									echo '
									<tr>
										<td class="text-muted">
											<a href="principal_calendario_alt.php?pagina=1" class="iframe"><i class="fa fa-calendar color-blue"></i> Agenda General</a>
										</td>
										<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CuentaEventos'].'</td>
									</tr>';
								}
								
								//Reviso el tipo de usuario o si estan permitidas las transacciones
								if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) {
									/****************************************************/
									//Cargas por vencer
									if($prm_x[12]=='1') {
										echo '
										<tr>
											<td class="text-muted">
												<a href="principal_cargas_alt.php?pagina=1" class="iframe"><i class="fa fa-usd color-green"></i> Cargas por Vencer</a>
											</td>
											<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CuentaRecargas'].'</td>
										</tr>';
									}
												
									/****************************************************/
									//Solicitudes de materiales sin OC asignada
									if($prm_x[13]=='1') {
										//Solicitudes
										$totalSol = $subconsulta['CuentaSolProd'] + $subconsulta['CuentaSolIns'] + $subconsulta['CuentaSolArr'] + $subconsulta['CuentaSolServ'] + $subconsulta['CuentaSolOtro'];					
		
										echo '
										<tr>
											<td class="text-muted">
												<a target="_blank" rel="noopener noreferrer" href="ocompra_generacion.php?idSistema=&submit=Filtrar" ><i class="fa fa-cube color-yellow"></i> Solicitudes sin OC</a>
											</td>
											<td class="text-right color-red" style="font-weight: 700;">'.$totalSol.'</td>
										</tr>';
									}
												
									/****************************************************/
									//OC sin aprobar
									if($prm_x[14]=='1') {
										echo '
										<tr>
											<td class="text-muted">
												<a target="_blank" rel="noopener noreferrer" href="ocompra_listado_sin_aprobar.php?pagina=1" ><i class="fa fa-database color-red"></i> OC sin Aprobar</a>
											</td>
											<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CuentaOC'].'</td>
										</tr>';
									}
													
									/****************************************************/
									//Acceso a las OT de la semana
									$OT_Semana = $prm_x[10] + $prm_x[11];					
									if($OT_Semana!=0) {
										echo '
										<tr>
											<td class="text-muted">
												<a href="principal_ot_semana_alt.php?pagina=1&estado=1" class="iframe"><i class="fa fa-database color-blue"></i> OT para la Semana</a>
											</td>
											<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountOTSemana'].'</td>
										</tr>
										<tr>
											<td class="text-muted">
												<a href="principal_ot_semana_alt.php?pagina=1&estado=1" class="iframe"><i class="fa fa-database color-red"></i> OT no Cumplidas</a>
											</td>
											<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountOTRetrasada'].'</td>
										</tr>';
														
									}
								}
									
									echo '
								</tbody>
							</table>
						</div>';
										
						/**************************************************************/
						$PermFactCompra    = $prm_x[15] + $prm_x[16] + $prm_x[17] + $prm_x[18];
						$PermFactVenta     = $prm_x[19] + $prm_x[20] + $prm_x[21] + $prm_x[22];
						$PermChequesPagar  = $prm_x[23] + $prm_x[24];
						$PermChequesCobrar = $prm_x[25] + $prm_x[26];
						//Verifico si tiene acceso a compras o ventas
						if(($PermFactCompra+$PermFactVenta+$PermChequesPagar+$PermChequesCobrar)!=0) {
							echo '<div class="col-sm-4">';
								/****************************************/
								//Se verifica si tiene acceso en las compras
								if(($PermFactCompra+$PermChequesPagar)!=0) {
									echo '
									<h5 style="color: #666;font-weight: 600 !important;">Compras
										<small class="pull-right fw600 text-primary"></small>
									</h5>
									<table class="table mbn covertable">
										<tbody>';
										if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) {
											//Facturas por pagar
											if($PermFactCompra!=0 or $idTipoUsuario==1){
												$totalFactCompra       = $subconsulta['CountFactArriendo'] + $subconsulta['CountFactInsumo'] + $subconsulta['CountFactProducto'] + $subconsulta['CountFactServicio'];					
												$totalFactCompra_retr  = $subconsulta['CountFactArriendo_retr'] + $subconsulta['CountFactInsumo_retr'] + $subconsulta['CountFactProducto_retr'] + $subconsulta['CountFactServicio_retr'];					
											}else{
												$totalFactCompra       = 0;
												$totalFactCompra_retr  = 0;
											}
											//Verifico permisos
											if($PermFactCompra!=0) {
												//verifico si tiene atrasadas de antes de la semana actual
												if($totalFactCompra_retr!=0) {
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_facturas_alt.php?pagina=1&idTipo=1" class="iframe color-red"><i class="fa fa-cc-paypal faa-horizontal animated color-red" aria-hidden="true"></i> Facturas atrasadas</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$totalFactCompra_retr.'</td>
													</tr>';
												}else{
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_facturas_alt.php?pagina=1&idTipo=1" class="iframe"><i class="fa fa-cc-paypal color-green-dark" aria-hidden="true"></i> Facturas x pagar</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$totalFactCompra.'</td>
													</tr>';
												}
											}
										
											//Devolucion Arriendos
											if($prm_x[15]=='1') {
												echo '
												<tr>
													<td class="text-muted">
														<a href="principal_arriendos_alt.php?pagina=1&idTipo=1" class="iframe" ><i class="fa fa-calendar-o color-blue-dark"></i> Devolucion Arriendos</a>
													</td>
													<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountArriendoIn'].'</td>
												</tr>';
											}
														
											//Documentos x Pagar			
											if($PermChequesPagar!=0) {
												echo '
												<tr>
													<td class="text-muted">
														<a href="principal_cheques_pagar_alt.php?pagina=1" class="iframe" ><i class="fa fa-credit-card color-blue"></i> Documentos x Pagar</a>
													</td>
													<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountChequePago'].'</td>
												</tr>';
											}
										}
										echo '
										</tbody>
									</table>';
								}
								
								/****************************************/
								//Se verifica si tiene acceso en las ventas
								if(($PermFactVenta+$PermChequesCobrar)!=0) {
									echo '
									<h5 style="color: #666;font-weight: 600 !important;">Ventas
										<small class="pull-right fw600 text-primary"></small>
									</h5>
									<table class="table mbn covertable">
										<tbody>';
											if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) {
												if($PermFactVenta!=0) {
													$totalFactVenta       = $subconsulta['CountFactArriendoVent'] + $subconsulta['CountFactInsumoVent'] + $subconsulta['CountFactProductoVent'] + $subconsulta['CountFactServicioVent'];					
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_facturas_alt.php?pagina=1&idTipo=2" class="iframe"><i class="fa fa-cc-paypal color-green-dark" aria-hidden="true"></i> Facturas x Cobrar</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$totalFactVenta.'</td>
													</tr>';
												}
											
												if($prm_x[19]=='1') {
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_arriendos_alt.php?pagina=1&idTipo=2" class="iframe" ><i class="fa fa-calendar-o color-blue-dark"></i> Devolucion Arriendos</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountArriendoOut'].'</td>
													</tr>';
												}
															
												if($PermChequesCobrar!=0) {
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_cheques_cobrar_alt.php?pagina=1" class="iframe" ><i class="fa fa-credit-card color-blue"></i> Documentos x Cobrar</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountChequeCobro'].'</td>
													</tr>';
												}
											}
											echo '
										</tbody>
									</table>';
								}
							echo '</div>';
						}
										
						/**************************************************************/
						$PermAlertas    = $prm_x[6];
						//Verifico si tiene acceso a las alertas
						if($PermAlertas!=0) {
							//verifico si existen alertas
							$n_alert = $subconsulta['CountAlertaNivel_1']+$subconsulta['CountAlertaNivel_2']+$subconsulta['CountAlertaNivel_3'];
							if($n_alert!=0){
								echo '<div class="col-sm-4">';

										echo '
										<h5 style="color: #666;font-weight: 600 !important;">Analisis Maquinas
											<small class="pull-right fw600 text-primary"></small>
										</h5>
										<table class="table mbn covertable">
											<tbody>';
																
																
											if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) {
												//Alertas Amarillas
												/*if($subconsulta['CountAlertaNivel_1']!=0) {
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_alertas_alt.php?nivel=1" class="iframe" ><i class="fa fa-exclamation-triangle color-yellow"></i> Alertas Amarillas</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountAlertaNivel_1'].'</td>
													</tr>';
												}*/
												//Alertas naranjas
												if($subconsulta['CountAlertaNivel_2']!=0) {
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_alertas_alt.php?nivel=2" class="iframe" ><i class="fa fa-exclamation-triangle color-yellow"></i> Alertas Amarillas</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountAlertaNivel_2'].'</td>
													</tr>';
												}
												//Alertas rojas
												if($subconsulta['CountAlertaNivel_3']!=0) {
													echo '
													<tr>
														<td class="text-muted">
															<a href="principal_alertas_alt.php?nivel=3" class="iframe" ><i class="fa fa-exclamation-triangle color-red"></i> Alertas Rojas</a>
														</td>
														<td class="text-right color-red" style="font-weight: 700;">'.$subconsulta['CountAlertaNivel_3'].'</td>
													</tr>';
												}
																	
																	
											}
											echo '
											</tbody>
										</table>';			
								echo '</div>';
							}
							
						}
										
						
						/**************************************************************/
						$Cajas    = $prm_x[27] + $prm_x[28] + $prm_x[29] + $prm_x[30] + $prm_x[31];
						//Verifico si tiene acceso a las alertas
						if($Cajas!=0) {
							
							//Verifico sistemas
							$z = "WHERE caja_chica_listado.idCajaChica!=0";
							$join = "";
							//Verifico el tipo de usuario que esta ingresando
							if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){
								$z.=" AND caja_chica_listado.idSistema>=0";
							}else{
								$z.=" AND caja_chica_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}  AND usuarios_cajas_chicas.idUsuario={$_SESSION['usuario']['basic_data']['idUsuario']}";	
								$join.= " INNER JOIN `usuarios_cajas_chicas` ON usuarios_cajas_chicas.idCajaChica = caja_chica_listado.idCajaChica";	
							}

							//Se traen los totales de la caja chica
							$arrCajas = array();
							$query = "SELECT 
							caja_chica_listado.idCajaChica AS ID,
							caja_chica_listado.Nombre,
							caja_chica_listado.MontoActual,
							(SELECT SUM(Valor) FROM `caja_chica_facturacion` WHERE idCajaChica=ID AND idEstado=1 LIMIT 1 )AS Egreso,
							(SELECT SUM(ValorDevolucion) FROM `caja_chica_facturacion` WHERE idCajaChica=ID AND idEstado=1 LIMIT 1 )AS Devolucion
							FROM `caja_chica_listado`
							LEFT JOIN `core_sistemas` ON core_sistemas.idSistema = caja_chica_listado.idSistema
							".$join."
							".$z."";
							//Consulta
							$resultado = mysqli_query ($dbConn, $query);
							//Si ejecuto correctamente la consulta
							if(!$resultado){
								//Genero numero aleatorio
								$vardata = genera_password(8,'alfanumerico');
												
								//Guardo el error en una variable temporal
								$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
								$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
								$_SESSION['ErrorListing'][$vardata]['query']        = $query;
												
							}
							while ( $row = mysqli_fetch_assoc ($resultado)) {
							array_push( $arrCajas,$row );
							}

							echo '<div class="col-sm-4">';
												
								echo '
								<h5 style="color: #666;font-weight: 600 !important;">Caja Chica
									<small class="pull-right fw600 text-primary"></small>
								</h5>
								<table class="table mbn covertable">
									<tbody>';
														
														
									if($n_permisos['idOpcionesGen_2']=='1' or $idTipoUsuario==1) {
										
										foreach ($arrCajas as $caja) {
											//Compruebo si esta cuadrada
											$cuadra = $caja['Egreso'] - $caja['Devolucion'];
											if($cuadra!=0){
												$f_color = 'color-red';
												$d_extra = ' (-'.$cuadra.')';
											}else{
												$f_color = 'color-blue';
												$d_extra = '';
											}
											echo '
											<tr>
												<td class="text-muted">
													<a href="principal_cajas_alt.php?idCajaChica='.$caja['ID'].'" class="iframe" ><i class="fa fa-usd '.$f_color.'"></i> '.$caja['Nombre'].'</a>
												</td>
												<td class="text-right '.$f_color.'" style="font-weight: 700;">'.$caja['MontoActual'].$d_extra.'</td>
											</tr>';
										}					
															
									}
									echo '
									</tbody>
								</table>';			
							echo '</div>';
						}				
	
					echo '
					</div>
				</div>
			</div>
		</div>
	</div>
					
					
	<div class="col-sm-12 info-buttons block">';
		$CContactos = 0;
		$CProgramas = 0;
		if(isset($subconsulta['CuentaContactos'])&&$subconsulta['CuentaContactos']!=''){$CContactos = $subconsulta['CuentaContactos'];}
		if(isset($subconsulta['CuentaProgramas'])&&$subconsulta['CuentaProgramas']!=''){$CProgramas = $subconsulta['CuentaProgramas'];}
		echo '<a href="principal_ayuda.php?pagina=1" class="col-sm-2 color-blue tooltip" title="Ver Archivos de ayuda">          <i class="fa fa-question"></i>     <span>Archivos de ayuda</span>        </a>';
		echo '<a href="principal_procedimientos.php?pagina=1" class="col-sm-2 color-green tooltip" title="Ver Procedimientos">   <i class="fa fa-file-word-o"></i>  <span>Procedimientos</span>           </a>';
		echo '<a href="principal_agenda_telefonica.php?pagina=1" class="col-sm-2 color-yellow tooltip" title="Ver Contactos">    <i class="fa fa-phone"></i>        <span>Contactos</span>                <strong class="label label-warning">'.$CContactos.'</strong></a>';
		echo '<a href="principal_software.php?pagina=1" class="col-sm-2 color-red tooltip" title="Ver Programas Recomendados">   <i class="fa fa-desktop"></i>      <span>Programas Recomendados</span>   <strong class="label label-info">'.$CProgramas.'</strong></a>';
	echo '</div>
</div>';


?>
