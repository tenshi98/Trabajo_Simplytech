<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
//Verifico si es superusuario
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Type.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "core_info_sistema.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_email']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'send_mail';
	require_once 'A1XRXS_sys/xrxs_form/z_server_test.php';
}
//se borra un dato
if ( !empty($_GET['del_error']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del_error';
	require_once 'A1XRXS_sys/xrxs_form/z_server_test.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['error'])) {$error['usuario'] 	  = 'error/'.$_GET['error'];}
if (isset($_GET['send']))  {$error['usuario'] 	  = 'sucess/Email enviado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};

//verifica la capa de desarrollo
$whitelist = array( 'localhost', '127.0.0.1', '::1' );
//si estoy en ambiente de desarrollo
if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){

//si estoy en ambiente de produccion	
}else{	
	//establezco el tiempo limite de la consulta	
	set_time_limit(2400);              //Alrededor de 40 minutos antes del error
	ini_set('memory_limit', '4096M');  // Se utilizan 4 GB para las consultas
}

?>




<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Datos del Servidor</h5>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#data1" data-toggle="tab">Info Servidor</a></li>
				<li class=""><a href="#data2" data-toggle="tab">PHP</a></li>
				<li class=""><a href="#data3" data-toggle="tab">Servidor</a></li>
				<li class=""><a href="#data4" data-toggle="tab">Logs</a></li>
				<li class=""><a href="#data5" data-toggle="tab">Correo</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			
			<div class="tab-pane fade active in" id="data1">
				<div class="wmd-panel">
					
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
							<thead>
								<tr role="row">
									<th width="100">Dato</th>
									<th>Info</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="odd"><td>Fecha Actual</td>   <td><?php echo fecha_actual(); ?></td></tr>
								<tr class="odd"><td>Hora Actual</td>    <td><?php echo hora_actual(); ?></td></tr>
								<tr class="odd"><td>Dia Actual</td>     <td><?php echo dia_actual(); ?></td></tr>
								<tr class="odd"><td>Semana Actual</td>  <td><?php echo semana_actual(); ?></td></tr>
								<tr class="odd"><td>Mes Actual</td>     <td><?php echo mes_actual(); ?></td></tr>
								<tr class="odd"><td>Año Actual</td>     <td><?php echo ano_actual(); ?></td></tr>
								<?php
								//Datos
								$hora_ini = '15:36:58';
								$hora_fin = '16:10:00';
								?>
								<tr class="odd"><td>Prueba Resta Horas</td>     <td><?php echo $hora_ini.' - '.$hora_fin.' = '.restahoras($hora_ini, $hora_fin); ?></td></tr>
								<tr class="odd"><td>Prueba Suma Horas</td>      <td><?php echo $hora_ini.' + '.$hora_fin.' = '.sumahoras($hora_ini, $hora_fin); ?></td></tr>
								<?php
								//Fuera de linea
								$diaInicio   = '2017-09-13';
								$diaTermino  = '2017-09-14';
								$tiempo1     = '09:35:00';
								$tiempo2     = '08:45:00';
								//calculo diferencia de dias
								$n_dias = dias_transcurridos($diaInicio,$diaTermino);
								//calculo del tiempo transcurrido
								$Tiempo = restahoras($tiempo1, $tiempo2);
								//Calculo del tiempo transcurrido
								if($n_dias!=0){
									if($n_dias>=2){
										$n_dias = $n_dias-1;
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
									if($n_dias==1&&$tiempo1<$tiempo2){
										$horas_trans2 = multHoras('24:00:00',$n_dias);
										$Tiempo = sumahoras($Tiempo,$horas_trans2);
									}
								}?>
								<tr class="odd"><td>Testeo horas transcurridas</td>     <td><?php echo $Tiempo; ?></td></tr>
								<tr class="odd"><td>Testeo horas a segundos</td>        <td><?php echo '2 hora = '.horas2segundos('02:00:00'); ?></td></tr>
								<tr class="odd"><td>IP Cliente</td>                     <td><?php echo get_client_ip(); ?></td></tr>
								
								<tr class="odd"><td>Agente de Transporte</td>           <td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td></tr>
								<tr class="odd"><td>username = tenshi98</td>            <td><?php $username = 'tenshi98'; echo preg_replace("/[^a-zA-Z0-9_\-]+/","",$username); ?></td></tr>
								<tr class="odd"><td>time()</td>                         <td><?php echo time(); ?></td></tr>
								
								

									                   
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="data2">
				<div class="wmd-panel">
					<div class="table-responsive">
						<iframe class="col-sm-12 col-md-12 col-sm-12" frameborder="0" height="500" src="1phpinfo.php"></iframe>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="data3">
				<div class="wmd-panel">
					<div class="table-responsive">
						<iframe class="col-sm-12 col-md-12 col-sm-12" frameborder="0" height="1200" src="<?php echo DB_SITE ?>/EXTERNAL_LIBS/linfo/index.php"></iframe>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="data4">
				<div class="wmd-panel">
					<div class="table-responsive">
						<div class="col-sm-12" style="margin-top:10px;">
							<?php
							$arrError = array();
							$query = "SELECT 
							usuarios_listado.Nombre AS Usuario,
							error_log.idErrorLog,
							error_log.Fecha,
							error_log.ErrorCode,
							error_log.Mensaje
							
							FROM `error_log`
							LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario  = error_log.idUsuario
							ORDER BY error_log.Fecha DESC ";
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
							array_push( $arrError,$row );
							}
							?>
							
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
								<thead>
									<tr role="row">
										<th width="100">Fecha</th>
										<th width="100">Codigo</th>
										<th>Usuario</th>
										<th>Mensaje</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php foreach ($arrError as $error) { ?>
										<tr class="odd">		
											<td><?php echo $error['Fecha']; ?></td>		
											<td><?php echo $error['ErrorCode']; ?></td>		
											<td><?php echo $error['Usuario']; ?></td>	
											<td><?php echo $error['Mensaje']; ?></td>	
											<td>
												<div class="btn-group" style="width: 70px;" >
													<a href="<?php echo 'view_error.php?view='.$error['idErrorLog']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a>								
													<?php 
													$ubicacion = $location.'&del_error='.$error['idErrorLog'];
													$dialogo   = '¿Realmente deseas eliminar el error '.$error['Mensaje'].'?';?>
													<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
												</div>
											</td>	
										</tr>
									<?php } ?>                    
								</tbody>
							</table>
							<?php require_once '../LIBS_js/modal/modal.php';?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="data5">
				<div class="wmd-panel">
					<div class="table-responsive">
						<div class="col-sm-8 fcenter" style="padding-top:40px;">
							<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
								<?php 
								//Se verifican si existen los datos
								if(isset($email)) {      $x1  = $email;    }else{$x1  = '';}
								if(isset($texto)) {      $x2  = $texto;    }else{$x2  = '';}
								
								//se dibujan los inputs
								$Form_Imputs = new Form_Inputs();
								$Form_Imputs->form_input_icon( 'Email', 'email', $x1, 2,'fa fa-envelope-o');
								$Form_Imputs->form_textarea('Texto','texto', $x2, 2, 160);
								
								//Consulta de los datos del sistema del equipo
								$query = "SELECT email_principal
								FROM `core_sistemas`
								WHERE idSistema='".$_SESSION['usuario']['basic_data']['idSistema']."'";
								//Consulta
								$resultado = mysqli_query ($dbConn, $query);
								//Si ejecuto correctamente la consulta
								if(!$resultado){
									//Genero numero aleatorio
									$vardata = genera_password(8,'alfanumerico');
													
									//Guardo el error en una variable temporal
									$ErrorListing[$vardata]['code']         = mysqli_errno($dbConn);
									$ErrorListing[$vardata]['description']  = mysqli_error($dbConn);
									$ErrorListing[$vardata]['query']        = $query;
													
								}
								$rowEmpresa = mysqli_fetch_assoc ($resultado);

								$Form_Imputs->form_input_hidden('email_principal', $rowEmpresa['email_principal'], 2);
								
								?>        
					   
								<div class="form-group">
									<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf003; Enviar Prueba" name="submit_email"> 
								</div>
									  
							</form> 
							<?php require_once '../LIBS_js/validator/form_validator.php';?>
						</div>
					</div>
				</div>
			</div>
			
        </div>	
	</div>
</div>

		


           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
