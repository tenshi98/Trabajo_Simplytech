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
$new_location = "telemetria_listado_config.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//se agregan ubicaciones
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
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
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// tomo los datos del usuario
$query = "SELECT Nombre,Identificador,id_Geo,id_Sensores,cantSensores, idDispositivo, idShield,LimiteVelocidad, TiempoFueraLinea,
TiempoDetencion, idUsoContrato, idUsoPredio
FROM `telemetria_listado`
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

//Verifico el tipo de usuario que esta ingresando
$z = "idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

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
				<span class="progress-description">Editar Configuracion</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class="active"><a href="<?php echo 'telemetria_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
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
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($Identificador)) {      $x1  = $Identificador;       }else{$x1  = $rowdata['Identificador'];}
					if(isset($id_Geo)) {             $x2  = $id_Geo;              }else{$x2  = $rowdata['id_Geo'];}
					if(isset($LimiteVelocidad)) {    $x3  = $LimiteVelocidad;     }else{$x3  = Cantidades_decimales_justos($rowdata['LimiteVelocidad']);}
					if(isset($id_Sensores)) {        $x4  = $id_Sensores;         }else{$x4  = $rowdata['id_Sensores'];}
					if(isset($cantSensores)) {       $x5  = $cantSensores;        }else{$x5  = $rowdata['cantSensores'];}
					if(isset($idDispositivo)) {      $x6  = $idDispositivo;       }else{$x6  = $rowdata['idDispositivo'];}
					if(isset($idShield)) {           $x7  = $idShield;            }else{$x7  = $rowdata['idShield'];}
					if(isset($TiempoFueraLinea)) {   $x8  = $TiempoFueraLinea;    }else{$x8  = $rowdata['TiempoFueraLinea'];}
					if(isset($TiempoDetencion)) {    $x9  = $TiempoDetencion;     }else{$x9  = $rowdata['TiempoDetencion'];}
					if(isset($idUsoContrato)) {      $x10 = $idUsoContrato;       }else{$x10 = $rowdata['idUsoContrato'];}
					if(isset($idUsoPredio)) {        $x11 = $idUsoPredio;         }else{$x11 = $rowdata['idUsoPredio'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					$Form_Imputs->form_input_icon( 'Identificador', 'Identificador', $x1, 2,'fa fa-flag');
					$Form_Imputs->form_select('Geolocalizacion','id_Geo', $x2, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_input_number('Velocidad Maxima','LimiteVelocidad', $x3, 1);
					$Form_Imputs->form_select('Sensores','id_Sensores', $x4, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_select_n_auto('Cantidad de Sensores','cantSensores', $x5, 1, 1, 50);
					$Form_Imputs->form_select('Hardware','idDispositivo', $x6, 2, 'idDispositivo', 'Nombre', 'telemetria_listado_dispositivos', 0, '', $dbConn);	
					$Form_Imputs->form_select('SHIELD','idShield', $x7, 1, 'idShield', 'Nombre', 'telemetria_listado_shield', 0, '', $dbConn);	
					$Form_Imputs->form_time('Tiempo Fuera Linea Maximo','TiempoFueraLinea', $x8, 1, 1);
					$Form_Imputs->form_time('Tiempo Maximo Detencion','TiempoDetencion', $x9, 1, 1);
					$Form_Imputs->form_select('Uso de Contratos','idUsoContrato', $x10, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_select('Verificacion de Predio (Cross)','idUsoPredio', $x11, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					
					
					$Form_Imputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
					?>
					
					<script>
						document.getElementById('div_cantSensores').style.display = 'none';
						
						var Sensores_val;
						var Geo_val;
						var modelSelected1;
						var modelSelected2;
		 
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
							
							Sensores_val= $("#id_Sensores").val();
							Geo_val= $("#id_Geo").val();
							//si es SI
							if(Sensores_val == 1){ 
								document.getElementById('div_cantSensores').style.display = '';						
								
							//si es NO
							} else if(Sensores_val == 2){ 
								document.getElementById('div_cantSensores').style.display = 'none';	
								//Reseteo los valores a 0
								document.getElementById('cantSensores').value = "0";
							}
							
							//si es SI
							if(Geo_val == 1){ 
								document.getElementById('div_LimiteVelocidad').style.display = '';	
								document.getElementById('div_TiempoDetencion').style.display = '';					
								
							//si es NO
							} else if(Geo_val == 2){ 
								document.getElementById('div_LimiteVelocidad').style.display = 'none';	
								document.getElementById('div_TiempoDetencion').style.display = 'none';
							}
						}); 
						
						$("#id_Sensores").on("change", function(){ //se ejecuta al cambiar valor del select
							modelSelected1 = $(this).val(); //Asignamos el valor seleccionado
					
							//si es SI
							if(modelSelected1 == 1){ 
								document.getElementById('div_cantSensores').style.display = '';
															
							//si es NO
							} else if(modelSelected1 == 2){ 
								document.getElementById('div_cantSensores').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('cantSensores').value = "0";
							}
						});
						
						$("#id_Geo").on("change", function(){ //se ejecuta al cambiar valor del select
							modelSelected2 = $(this).val(); //Asignamos el valor seleccionado
					
							//si es SI
							if(modelSelected2 == 1){ 
								document.getElementById('div_LimiteVelocidad').style.display = '';
								document.getElementById('div_TiempoDetencion').style.display = '';	
															
							//si es NO
							} else if(modelSelected2 == 2){ 
								document.getElementById('div_LimiteVelocidad').style.display = 'none';
								document.getElementById('div_TiempoDetencion').style.display = 'none';
							}
						});
					</script>
			

					<div class="form-group">		
						<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit"> 		
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
