<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "telemetria_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){  $location .= "&Identificador=".$_GET['Identificador'];  $search .= "&Identificador=".$_GET['Identificador'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                $location .= "&Nombre=".$_GET['Nombre'];                $search .= "&Nombre=".$_GET['Nombre'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';	
}
//se clona la maquina
if ( !empty($_POST['clone_Equipo']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'clone_Equipo';
	require_once 'A1XRXS_sys/xrxs_form/z_telemetria_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Equipo creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Equipo editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Equipo borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['clone_idTelemetria']) ) { 
	
?>
<div class="col-sm-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Clonar Equipo <?php echo $_GET['nombre_equipo']; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Identificador)) {   $x1  = $Identificador;    }else{$x1  = '';}
				if(isset($Nombre)) {          $x2  = $Nombre;           }else{$x2  = '';}
			
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Datos Basicos</h3>';
				$Form_Imputs->form_input_icon( 'Identificador', 'Identificador', $x1, 2,'fa fa-flag');
				$Form_Imputs->form_input_text( 'Nombre del Equipo', 'Nombre', $x2, 2);	
				
	
				$Form_Imputs->form_input_hidden('idEstado', 2, 2);
				$Form_Imputs->form_input_hidden('idTelemetria', $_GET['clone_idTelemetria'], 2);
				?>  
	   
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c5; Clonar" name="clone_Equipo">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>        
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
telemetria_listado.Identificador,
telemetria_listado.Nombre,
telemetria_listado.IP_Client,
telemetria_listado.Sim_Num_Tel,
telemetria_listado.Sim_Num_Serie,
telemetria_listado.Sim_modelo,
telemetria_listado.Sim_marca,
telemetria_listado.Sim_Compania,
telemetria_listado.IdentificadorEmpresa,
telemetria_listado.TiempoFueraLinea,
telemetria_listado.TiempoDetencion,
telemetria_listado.Capacidad,
opc2.Nombre AS Geo,
opc3.Nombre AS Sensores,
opc4.Nombre AS Contratos,
telemetria_listado.Codigo AS ContratoCodigo,
telemetria_listado.F_Inicio AS ContratoF_Inicio,
telemetria_listado.F_Termino AS ContratoF_Termino,
telemetria_listado.cantSensores,
telemetria_listado.Direccion_img,
core_sistemas.Nombre AS sistema,
telemetria_listado.id_Geo,
telemetria_listado.id_Sensores,
telemetria_listado_dispositivos.Nombre AS Dispositivo,

telemetria_listado.Hor_idActivo_dia1, 
telemetria_listado.Hor_idActivo_dia2, 
telemetria_listado.Hor_idActivo_dia3, 
telemetria_listado.Hor_idActivo_dia4, 
telemetria_listado.Hor_idActivo_dia5, 
telemetria_listado.Hor_idActivo_dia6, 
telemetria_listado.Hor_idActivo_dia7,
telemetria_listado.Hor_Inicio_dia1, 
telemetria_listado.Hor_Inicio_dia2, 
telemetria_listado.Hor_Inicio_dia3, 
telemetria_listado.Hor_Inicio_dia4, 
telemetria_listado.Hor_Inicio_dia5, 
telemetria_listado.Hor_Inicio_dia6, 
telemetria_listado.Hor_Inicio_dia7,
telemetria_listado.Hor_Termino_dia1, 
telemetria_listado.Hor_Termino_dia2, 
telemetria_listado.Hor_Termino_dia3, 
telemetria_listado.Hor_Termino_dia4, 
telemetria_listado.Hor_Termino_dia5, 
telemetria_listado.Hor_Termino_dia6, 
telemetria_listado.Hor_Termino_dia7,

telemetria_listado.Jornada_inicio,
telemetria_listado.Jornada_termino,
telemetria_listado.Colacion_inicio,
telemetria_listado.Colacion_termino,
telemetria_listado.Microparada,

core_estados.Nombre AS Estado,
telemetria_listado_shield.Nombre AS Shield,
telemetria_listado_alarma_general.Nombre AS AlarmaGeneral,
telemetria_listado.LimiteVelocidad,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna,
telemetria_listado.Direccion,
telemetria_zonas.Nombre AS Zona, 
telemetria_listado.idUsoContrato

FROM `telemetria_listado`
LEFT JOIN `core_sistemas`                        ON core_sistemas.idSistema                            = telemetria_listado.idSistema
LEFT JOIN `core_sistemas_opciones`        opc2   ON opc2.idOpciones                                    = telemetria_listado.id_Geo
LEFT JOIN `core_sistemas_opciones`        opc3   ON opc3.idOpciones                                    = telemetria_listado.id_Sensores
LEFT JOIN `core_sistemas_opciones`        opc4   ON opc4.idOpciones                                    = telemetria_listado.idUsoContrato
LEFT JOIN `telemetria_listado_dispositivos`      ON telemetria_listado_dispositivos.idDispositivo      = telemetria_listado.idDispositivo
LEFT JOIN `core_estados`                         ON core_estados.idEstado                              = telemetria_listado.idEstado
LEFT JOIN `telemetria_listado_shield`            ON telemetria_listado_shield.idShield                 = telemetria_listado.idShield
LEFT JOIN `telemetria_listado_alarma_general`    ON telemetria_listado_alarma_general.idAlarmaGeneral  = telemetria_listado.idAlarmaGeneral
LEFT JOIN `core_ubicacion_ciudad`                ON core_ubicacion_ciudad.idCiudad                     = telemetria_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`               ON core_ubicacion_comunas.idComuna                    = telemetria_listado.idComuna
LEFT JOIN `telemetria_zonas`                     ON telemetria_zonas.idZona                            = telemetria_listado.idZona

WHERE idTelemetria = {$_GET['id']}";
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
$rowdata = mysqli_fetch_assoc ($resultado);

//Se traen todas las activaciones
$arrOpciones = array();
$query = "SELECT idOpciones,Nombre
FROM `core_sistemas_opciones`
ORDER BY idOpciones ASC";
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
array_push( $arrOpciones,$row );
}

?>
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Equipo</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if($rowdata['idUsoContrato']==1){ ?>
						<li class=""><a href="<?php echo 'telemetria_listado_contratos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Contratos</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_alerta_general.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Alarma General</a></li>
						<?php if($rowdata['id_Geo']==2){ ?>
						<li class=""><a href="<?php echo 'telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
						<li class=""><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Sensores</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Alarmas Personalizadas</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_horario.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Horario</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Otros Datos</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Observaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Archivos</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					
					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/maquina.jpg">
						<?php }else{  ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="upload/<?php echo $rowdata['Direccion_img']; ?>">
						<?php }?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos del Equipo</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Identificador Empresa : </strong><?php echo $rowdata['IdentificadorEmpresa']; ?><br/>
							<strong>SIM - Numero Telefonico : </strong><?php echo $rowdata['Sim_Num_Tel']; ?><br/>
							<strong>SIM - Numero Serie : </strong><?php echo $rowdata['Sim_Num_Serie']; ?><br/>
							<strong>SIM - Compañia : </strong><?php echo $rowdata['Sim_Compania']; ?><br/>
							<strong>BAM - Marca : </strong><?php echo $rowdata['Sim_marca']; ?><br/>
							<strong>BAM - Modelo : </strong><?php echo $rowdata['Sim_modelo']; ?><br/>
							<strong>IP Cliente : </strong><?php echo $rowdata['IP_Client']; ?><br/>
						</p>
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Configuracion</h2>
						<p class="text-muted">
							<strong>Identificador : </strong><?php echo $rowdata['Identificador']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?><br/>
							<strong>Alarma General : </strong><?php echo $rowdata['AlarmaGeneral']; ?><br/>
							
							<strong>Geolocalizacion : </strong><?php echo $rowdata['Geo']; ?><br/>
							<?php if($rowdata['id_Geo']==1){ ?>
								<strong>Limite Velocidad : </strong><?php echo Cantidades_decimales_justos($rowdata['LimiteVelocidad']).' KM/h'; ?><br/>
							<?php }
							if($rowdata['id_Geo']==2){ ?>
								<strong>Zona : </strong><?php echo $rowdata['Zona']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion'].', '.$rowdata['Comuna'].', '.$rowdata['Ciudad']; ?><br/>
							<?php } ?>
							
							<strong>Sensores : </strong><?php echo $rowdata['Sensores'].' ';if($rowdata['id_Sensores']==1){echo '('.$rowdata['cantSensores'].' Sensores)';} ?><br/>
							
							<strong>Hardware : </strong><?php echo $rowdata['Dispositivo']; ?><br/>
							<?php if(isset($rowdata['Shield'])&&$rowdata['Shield']!=''){ ?>
								<strong>Shield : </strong><?php echo $rowdata['Shield']; ?><br/>
							<?php } ?>
							
							<strong>Tiempo Fuera Linea Maximo : </strong><?php echo $rowdata['TiempoFueraLinea']; ?> Horas<br/>
							
							<?php if($rowdata['id_Geo']==1){ ?>
								<strong>Tiempo Maximo Detencion : </strong><?php echo $rowdata['TiempoDetencion']; ?> Horas<br/>
							<?php } ?>
							
							<strong>Utilizacion de Contratos : </strong><?php echo $rowdata['Contratos'].' ';if($rowdata['idUsoContrato']==1){ echo '(Contrato Cod <strong>'.$rowdata['ContratoCodigo'].'</strong>, valido del <strong>'.fecha_estandar($rowdata['ContratoF_Inicio']).'</strong> al <strong>'.fecha_estandar($rowdata['ContratoF_Termino']).'</strong>)';} ?><br/>
							
							<?php if(isset($rowdata['Capacidad'])&&$rowdata['Capacidad']!=0){ ?>
								<strong>Capacidad : </strong><?php echo Cantidades_decimales_justos($rowdata['Capacidad']); ?><br/>
							<?php } ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Horario Notificaciones</h2>
						<p class="text-muted">
							<?php
							for ($i = 1; $i <= 7; $i++) {
								//Unidad medida
								$bla = 'No Asignado';
								foreach ($arrOpciones as $sen) { 
									if($rowdata['Hor_idActivo_dia'.$i]==$sen['idOpciones']){
										$bla = $sen['Nombre'];
									}
								}
								?>
								<strong><?php echo numero_nombreDia($i); ?> : </strong><?php echo $bla.' / '.$rowdata['Hor_Inicio_dia'.$i].' - '.$rowdata['Hor_Termino_dia'.$i]; ?><br/>
							<?php } ?>
						</p>	
						
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Jornada Laboral</h2>
						<p class="text-muted">
							<strong>Hora Inicio Jornada : </strong><?php echo $rowdata['Jornada_inicio'].' hrs'; ?><br/>
							<strong>Hora Termino Jornada : </strong><?php echo $rowdata['Jornada_termino'].' hrs'; ?><br/>
							<strong>Hora Inicio Colacion : </strong><?php echo $rowdata['Colacion_inicio'].' hrs'; ?><br/>
							<strong>Hora Termino Colacion : </strong><?php echo $rowdata['Colacion_termino'].' hrs'; ?><br/>
							<strong>Tiempo Microparadas : </strong><?php echo $rowdata['Microparada'].' hrs'; ?><br/>
						</p>
						

					</div>	
					<div class="clearfix"></div>
			
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Equipo</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Identificador)) {   $x1  = $Identificador;    }else{$x1  = '';}
				if(isset($Nombre)) {          $x2  = $Nombre;           }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				echo '<h3>Datos Basicos</h3>';
				$Form_Imputs->form_input_icon( 'Identificador', 'Identificador', $x1, 2,'fa fa-flag');
				$Form_Imputs->form_input_text( 'Nombre del Equipo', 'Nombre', $x2, 2);	
				
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('id_Geo', 2, 2);
				$Form_Imputs->form_input_hidden('id_Sensores', 2, 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('idAlarmaGeneral', 2, 2);
				$Form_Imputs->form_input_hidden('idUsoContrato', 2, 2);
				$Form_Imputs->form_input_hidden('idMantencion', 2, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia1', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia2', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia3', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia4', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia5', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia6', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_idActivo_dia7', 1, 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia1', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia2', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia3', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia4', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia5', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia6', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Inicio_dia7', '00:01:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia1', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia2', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia3', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia4', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia5', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia6', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('Hor_Termino_dia7', '23:59:00', 2);
				$Form_Imputs->form_input_hidden('idEstadoEncendido', 1, 2);
				?>

							
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form> 
			<?php widget_validator(); ?>
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':           $order_by = 'ORDER BY telemetria_listado.Nombre ASC ';         $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':          $order_by = 'ORDER BY telemetria_listado.Nombre DESC ';        $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'identificador_asc':    $order_by = 'ORDER BY telemetria_listado.Identificador ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente';break;
		case 'identificador_desc':   $order_by = 'ORDER BY telemetria_listado.Identificador DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Identificador Descendente';break;
		case 'estado_asc':           $order_by = 'ORDER BY telemetria_listado.idEstado ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':          $order_by = 'ORDER BY telemetria_listado.idEstado DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'ORDER BY telemetria_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY telemetria_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE telemetria_listado.idTelemetria>=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND telemetria_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){  $z .= " AND telemetria_listado.Identificador LIKE '%".$_GET['Identificador']."%'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                $z .= " AND telemetria_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idTelemetria FROM `telemetria_listado` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
telemetria_listado.idTelemetria,
telemetria_listado.Identificador,
telemetria_listado.Nombre,
core_sistemas.Nombre AS sistema,
core_estados.Nombre AS Estado,
telemetria_listado.idEstado

FROM `telemetria_listado`
LEFT JOIN `core_sistemas`   ON core_sistemas.idSistema    = telemetria_listado.idSistema
LEFT JOIN `core_estados`    ON core_estados.idEstado      = telemetria_listado.idEstado
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
array_push( $arrUsers,$row );
}
?>
<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Equipo</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Identificador)) {   $x1  = $Identificador;    }else{$x1  = '';}
				if(isset($Nombre)) {          $x2  = $Nombre;           }else{$x2  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_icon( 'Identificador', 'Identificador', $x1, 1,'fa fa-flag');
				$Form_Imputs->form_input_text( 'Nombre del Equipo', 'Nombre', $x2, 1);	
				
				
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                     



                                
<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Equipos</h5>
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>	
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Identificador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=identificador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=identificador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Nombre']; ?></td>	
						<td><?php echo $usuarios['Identificador']; ?></td>	
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['Estado']; ?></label></td>	
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 140px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_telemetria.php?view='.$usuarios['idTelemetria']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&nombre_equipo='.$usuarios['Nombre'].'&clone_idTelemetria='.$usuarios['idTelemetria']; ?>" title="Clonar Equipo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-files-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idTelemetria']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									//se verifica que el usuario no sea uno mismo
									$ubicacion = $location.'&del='.$usuarios['idTelemetria'];
									$dialogo   = '¿Realmente deseas eliminar el equipo '.$usuarios['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
								<?php } ?>								
							</div>
						</td>
					</tr>
					<?php } ?>                    
				</tbody>
			</table>
		</div>
		<div class="pagrow">	
			<?php 
			//se llama al paginador
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>
	</div>
</div>

<?php widget_modal(80, 95); ?>
	
	
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
