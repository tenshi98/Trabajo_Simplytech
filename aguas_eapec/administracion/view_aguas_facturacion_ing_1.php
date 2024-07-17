
<div class="">
		<div class="invoice">
			<div class="row">
				<div class="col-xs-12 text-right">
					<h1><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DocFacturable'] ?> <small><?php echo N_Doc($_SESSION['Facturacion_clientes'][$_GET['view_details']]['SII_NDoc'], 7) ?></small></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><a href="#"><?php echo $_SESSION['Facturacion_basicos']['SistemaNombre']?></a></h4>
						</div>
						<div class="panel-body">
							<p>
								<?php echo 'R.U.T.: '.$_SESSION['Facturacion_basicos']['SistemaRut']?><br>
								<?php echo $_SESSION['Facturacion_basicos']['SistemaRubro']?><br>
								<?php echo $_SESSION['Facturacion_basicos']['SistemaDireccion'].' '.$_SESSION['Facturacion_basicos']['SistemaComuna'].' '.$_SESSION['Facturacion_basicos']['SistemaCiudad']; ?><br>
								<?php echo 'Telefono 1: '.$_SESSION['Facturacion_basicos']['SistemaFono1']?><br>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-6 ">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Cliente : <a href="#"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteIdentificador']?></a></h4>
						</div>
						<div class="panel-body">
							<p>
								<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteRut'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteRut']!=''){                     echo 'R.U.T.: '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteRut'].'<br/>';} ?> 
								<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteGiro'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteGiro']!=''){                   echo 'Rubro: '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteGiro'].'<br/>';} ?> 
								<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteDireccion'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteDireccion']!=''){ echo 'Direccion: '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteDireccion'].'<br/>';} ?> 
								<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteNombreComuna'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteNombreComuna']!=''){       echo 'Comuna: '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteNombreComuna'].'<br/>';} ?> 
								<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteFono1'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteFono1']!=''){                 echo 'Telefono Fijo: '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteFono1'].'<br/>';} ?> 
								<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteFono2'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteFono2']!=''){                 echo 'Telefono Movil: '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteFono2'].'<br/>';} ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><h4>Detalle Cuenta</h4></th>
						<th width="100px"><h4>Cantidad</h4></th>
						<th width="100px" class="text-right"><h4>Total Item</h4></th>
					</tr>
				</thead>
				<tbody>
					<?php
						//verificacion de remarcador 
						if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=''&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=0){
							$ndecim = 2;
						}else{
							$ndecim = 0;	
						}
					?>
								
					<tr>
						<td>Cargo Fijo Cliente</td>
						<td class="text-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['ClienteUnidadHabitacional'];?></td>
						<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCargoFijoValor'], 0);?></td>	
					</tr>
					<tr>
						<td>Consumo Agua Potable</td>
						<td class="text-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleConsumoCantidad'], $ndecim);?></td>
						<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleConsumoValor'], 0);?></td>	
					</tr>
					<tr>
						<td>Recoleccion de Aguas Servidas</td>
						<td class="text-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleRecoleccionCantidad'], $ndecim);?></td>
						<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleRecoleccionValor'], 0);?></td>	
					</tr>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleVisitaCorte'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleVisitaCorte']!=0){ ?>
						<tr>
							<td>Visita Corte</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleVisitaCorte'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte1Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte1Valor']!=0){ ?>
						<tr>
							<td>Corte 1° instancia <?php echo ' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte1Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte1Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte2Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte2Valor']!=0){ ?>
						<tr>
							<td>Corte 2° instancia <?php echo ' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte2Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleCorte2Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion1Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion1Valor']!=0){ ?>
						<tr>
							<td>Reposicion 1° instancia <?php echo ' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion1Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion1Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion2Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion2Valor']!=0){ ?>
						<tr>
							<td>Reposicion 2° instancia <?php echo ' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion2Fecha']).')'?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleReposicion2Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<tr>
						<td colspan="2"><strong>SUBTOTAL SERVICIO</strong></td>
						<td class="text-right"><strong><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSubtotalServicio'], 0); ?></strong></td>
					</tr>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleInteresDeuda'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleInteresDeuda']!=0){ ?>
						<tr>
							<td>Interes Deuda</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleInteresDeuda'], 0)?></td>	
						</tr>
					<?php } ?>
					
					<?php 
					//Otros Cargos 1
					if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos1Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos1Valor']!=0){ ?>
						<tr>
							<td><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos1Texto'].' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos1Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos1Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 2
					if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos2Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos2Valor']!=0){ ?>
						<tr>
							<td><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos2Texto'].' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos2Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos2Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 3
					if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos3Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos3Valor']!=0){ ?>
						<tr>
							<td><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos3Texto'].' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos3Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos3Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 4
					if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos4Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos4Valor']!=0){ ?>
						<tr>
							<td><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos4Texto'].' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos4Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos4Valor'], 0)?></td>	
						</tr>
					<?php } 
					//Otros Cargos 5
					if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos5Valor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos5Valor']!=0){ ?>
						<tr>
							<td><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos5Texto'].' ('.Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos5Fecha']).')'; ?></td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleOtrosCargos5Valor'], 0)?></td>	
						</tr>
					<?php } ?>
					<tr>
						<td colspan="2"><strong>TOTAL VENTA</strong></td>
						<td class="text-right"><strong><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleTotalVenta'], 0); ?></strong></td>
					</tr>
					<?php 
					//variable exento
					$Exento = 0;
					if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoFavor'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoFavor']!=0){ 
						$Exento = $Exento - $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoFavor']; ?>
						<tr>
							<td>Saldo a Favor</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo '(-) '.Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoFavor'], 0)?></td>	
						</tr>
					<?php } ?>
					<?php if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoAnterior'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoAnterior']!=0){ 
						$Exento = $Exento + $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoAnterior']; ?>
						<tr>
							<td>Saldo Anterior</td>
							<td class="text-right">1</td>
							<td class="text-right"><?php echo '(+) '.Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleSaldoAnterior'], 0)?></td>	
						</tr>
					<?php } ?>
					
					
					
				</tbody>
			</table>
			<div class="row text-right" style="margin-top:20px;">
				<div class="col-xs-2 col-xs-offset-8">
					<p>
						<strong>
							TOTAL VENTA : <br>
							EXENTOS : <br>
							TOTAL : <br>
						</strong>
					</p>
				</div>
				<div class="col-xs-2">
					<strong>
						<?php 
						if($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleTotalVenta']>0){
							echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleTotalVenta'], 0).'<br>';
							echo Valores($Exento, 0).'<br>'; 
							echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetalleTotalAPagar'], 0).'<br>'; 
						}else{
							echo Valores(0, 0).'<br>';
							echo Valores(0, 0).'<br>';
							echo Valores(0, 0).'<br>';
						}
						?>
					</strong>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-6">
					<div class="row">
						<div class="col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Consumo Ultimos Meses</h4>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-6">
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes1Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes1Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes2Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes2Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes3Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes3Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes4Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes4Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes5Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes5Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes6Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes6Valor'], 2); ?> m3</small> <br/> 
											<div class="clearfix"></div>
										</div>
										<div class="col-xs-6">
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes7Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes7Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes8Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes8Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes9Fecha']); ?></div>   <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes9Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes10Fecha']); ?></div>  <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes10Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes11Fecha']); ?></div>  <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes11Valor'], 2); ?> m3</small> <br/> 
											<div class="pull-left"><?php echo Devolver_mes($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes12Fecha']); ?></div>  <small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['GraficoMes12Valor'], 2); ?> m3</small> 
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Detalle de Consumo</h4>
								</div>
								<div class="panel-body">
									<p>
										<?php 
										if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesAnteriorFecha'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesAnteriorFecha']!='0000-00-00'&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesAnteriorFecha']!=''){
											$mes_anterior = Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesAnteriorFecha']);
										}else{
											$mes_anterior = 'Sin datos';
										}?>
										<div class="pull-left">Lectura Mes anterior <?php echo '('.$mes_anterior.')'; ?></div>
										<small class="pull-right"><?php echo valores_truncados($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesAnteriorCantidad']) ?> m3</small>
										
										<br/>
										<?php 
										if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesActualFecha'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesActualFecha']!='0000-00-00'&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesActualFecha']!=''){
											$mes_actual = Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesActualFecha']);
										}else{
											$mes_actual = 'Sin datos';
										}?>
										<div class="pull-left">Lectura Mes actual <?php echo '('.$mes_actual.')'; ?></div>
										<small class="pull-right"><?php echo valores_truncados($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesActualCantidad']) ?> m3</small>
										
										<br/>
										<div class="pull-left">Diferencia de lecturas</div>
										<small class="pull-right"><?php echo valores_truncados($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesDiferencia']) ?> m3</small>
									
										<?php
										//verificacion de remarcador
										if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=''&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=0){?>
										<br/>
											<div class="pull-left">Adicionales por prorrateo</div>
											<small class="pull-right">
												<?php 
												if($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsProrateo']>0){
													$bla = $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsProrateoSigno'].' '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsProrateo'];
												}elseif($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsProrateo']<0){
													$bla = $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsProrateoSigno'].' '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsProrateo']*-1;
												}else{
													$bla = '(+) 0';
												}
												echo $bla.' m3';?>
											</small>	
										<?php } ?>
										
										<br/>
										<div class="pull-left">Consumo Mes Total</div>
										<small class="pull-right"><?php echo Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsMesTotalCantidad'], $ndecim) ?> m3</small>
									</p>
									
									<div class="clearfix"></div>

									<p>
										<div class="pull-left">Proxima lectura estimada</div>
										<small class="pull-right"><?php echo Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsFechaProxLectura']);?></small>
										<?php
										//verificacion de remarcador
										if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=''&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=0){?>
										<br/>
										<div class="pull-left">Modalidad de prorrateo: <?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsModalidad'];?></div>
										<?php } ?>
									</p>
									
									<div class="clearfix"></div>
								
									<p>
										<div class="pull-left">Emergencias 24 horas </div>
										<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsFonoEmergencias'] ?></small>
										
										<br/>
										<div class="pull-left">Consultas Lunes a Viernes </div>
										<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['DetConsFonoConsultas'] ?></small>
									</p>
								</div>
							</div>
						</div>
						
					</div>	
					
				</div>
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Aguas Informa</h4>
						</div>
						<div class="panel-body">
							<p>
								Los Valores proporcionales con IVA para los consumos realizados a partir del 20-01-2016
								
								<br/>
								<div class="pull-left">Cargo fijo</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfCargoFijo'], 0)?></small>
								
								<br/>
								<div class="pull-left">Metro cubico agua potable</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfMetroAgua'], 2)?></small>
								
								<br/>
								<div class="pull-left">Metro cubico recoleccion</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfMetroRecolecion'], 2)?></small>
								
								<br/>
								<div class="pull-left">Visita corte</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfVisitaCorte'], 0)?></small>
								
								<br/>
								<div class="pull-left">Corte 1° instancia</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfCorte1'], 0)?></small>
								
								<br/>
								<div class="pull-left">Corte 2° instancia</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfCorte2'], 0)?></small>
								
								<br/>
								<div class="pull-left">Reposicion 1° instancia</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfReposicion1'], 0)?></small>
								
								<br/>
								<div class="pull-left">Reposicion 2° instancia</div>
								<small class="pull-right"><?php echo Valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfReposicion2'], 0)?></small>

							</p>

							<div class="clearfix"></div>
							
							<p>
								<div class="pull-left">Factor de cobro del periodo</div>
								<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfFactorCobro'] ?></small>
								
								<?php
								//verificacion de remarcador
								if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=''&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['idTipoMedicion']!=0){?>
								<br/>
									<div class="pull-left">Diferencia medidor general</div>
									<small class="pull-right">
										<?php 
										if($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfDifMedGeneral']>0){
											$bla = '(+)'.Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfDifMedGeneral'], 2);
										}elseif($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfDifMedGeneral']<0){
											$bla = '(-)'.Cantidades($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfDifMedGeneral']*-1, 2);
										}else{
											$bla = '(+)0';
										}
										echo $bla.' m3';?>
									</small>
									
									<br/>
									<div class="pull-left">Porcentaje Prorrateo</div>
									<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfProcProrrateo'] ?> %</small>	
								<?php } ?>
										
								<br/>
								<div class="pull-left">Punto servicio diametro</div>
								<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfTipoMedicion'].' '.$_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfPuntoDiametro'].'mm' ?></small>
								
								<br/>
								<div class="pull-left">Clave facturacion</div>
								<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfClaveFacturacion'] ?></small>
								
								<br/>
								<div class="pull-left">Clave Lectura</div>
								<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfClaveLectura'] ?></small>
								
								<br/>
								<div class="pull-left">Numero medidor</div>
								<small class="pull-right"><?php echo $_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfNumeroMedidor'] ?></small>
							</p>
							
							<div class="clearfix"></div>
							
				
							<p>
								<div class="pull-left">Tarifas publicadas la nacion</div>
								<small class="pull-right">26-05-2017</small>
								
								<br/>	
								<div class="pull-left">Fecha emision</div>
								<small class="pull-right"><?php echo Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfFechaEmision']);?></small>

								<br/>	
								<div class="pull-left">Ultimo pago</div>
								<small class="pull-right">
									<?php echo '('.valores($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfUltimoPagoMonto'], 0).') ';
									if(isset($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfUltimoPagoFecha'])&&$_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfUltimoPagoFecha']!='0000-00-00'){
										echo Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfUltimoPagoFecha']);
									}else{
										echo 'Sin datos';
									}?>
								</small>
								
								<br/>	
								<div class="pull-left">Considera movimientos hasta</div>
								<small class="pull-right"><?php echo Fecha_estandar($_SESSION['Facturacion_clientes'][$_GET['view_details']]['AguasInfMovimientosHasta']);?></small>
							</p>		
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



