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
$new_location = "telemetria_listado_configuracion.php";
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
// consulto los datos
$rowdata = db_select_data (false, 'Nombre,Identificador,id_Geo,id_Sensores,cantSensores, idDispositivo, idShield, TiempoFueraLinea, idUsoPredio,idTab, idBackup, NregBackup, idGenerador, idAlertaTemprana, idUsoFTP, FTP_Carpeta, idTelGenerador, FechaInsGen', 'telemetria_listado', '', 'idTelemetria ='.$_GET['id'], $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

//Verifico el tipo de usuario que esta ingresando
$z = "idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
$w = "telemetria_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema']." AND telemetria_listado.idEstado=1";
$w.= " AND telemetria_listado.idTab=9";//CrossEnergy			
?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Equipo', $rowdata['Nombre'], 'Editar Configuracion');?>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'telemetria_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'telemetria_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class="active"><a href="<?php echo 'telemetria_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'telemetria_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_alarmas_perso.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bullhorn" aria-hidden="true"></i> Alarmas Personalizadas</a></li>
						<?php } ?>
						<?php if($rowdata['id_Geo']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_gps.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-marker" aria-hidden="true"></i> Datos GPS</a></li>
						<?php } elseif($rowdata['id_Geo']==2){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_direccion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-map-signs" aria-hidden="true"></i> Direccion</a></li>
						<?php } ?>
						<?php if($rowdata['id_Sensores']==1){ ?>
							<li class=""><a href="<?php echo 'telemetria_listado_parametros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Sensores</a></li>
							<li class=""><a href="<?php echo 'telemetria_listado_sensor_operaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sliders" aria-hidden="true"></i> Definicion Operacional</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'telemetria_listado_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Imagen</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_trabajo.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-clock-o" aria-hidden="true"></i> Jornada Trabajo</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_otros_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-archive" aria-hidden="true"></i> Otros Datos</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'telemetria_listado_archivos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-files-o" aria-hidden="true"></i> Archivos</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($Identificador)) {        $x1  = $Identificador;        }else{$x1  = $rowdata['Identificador'];}
					if(isset($idDispositivo)) {        $x2  = $idDispositivo;        }else{$x2  = $rowdata['idDispositivo'];}
					if(isset($idShield)) {             $x3  = $idShield;             }else{$x3  = $rowdata['idShield'];}
					if(isset($TiempoFueraLinea)) {     $x4  = $TiempoFueraLinea;     }else{$x4  = $rowdata['TiempoFueraLinea'];}
					if(isset($idTab)) {                $x5  = $idTab;                }else{$x5  = $rowdata['idTab'];}
					if(isset($id_Geo)) {               $x6  = $id_Geo;               }else{$x6  = $rowdata['id_Geo'];}
					if(isset($id_Sensores)) {          $x7  = $id_Sensores;          }else{$x7  = $rowdata['id_Sensores'];}
					if(isset($cantSensores)) {         $x8  = $cantSensores;         }else{$x8  = $rowdata['cantSensores'];}
					if(isset($idUsoPredio)) {          $x10 = $idUsoPredio;          }else{$x10 = $rowdata['idUsoPredio'];}
					if(isset($idBackup)) {             $x13 = $idBackup;             }else{$x13 = $rowdata['idBackup'];}
					if(isset($NregBackup)) {           $x14 = $NregBackup;           }else{$x14 = $rowdata['NregBackup'];}
					if(isset($idGenerador)) {          $x15 = $idGenerador;          }else{$x15 = $rowdata['idGenerador'];}
					if(isset($idTelGenerador)) {       $x16 = $idTelGenerador;       }else{$x16 = $rowdata['idTelGenerador'];}
					if(isset($FechaInsGen)) {          $x17 = $FechaInsGen;          }else{$x17 = $rowdata['FechaInsGen'];}
					if(isset($idAlertaTemprana)) {     $x18 = $idAlertaTemprana;     }else{$x18 = $rowdata['idAlertaTemprana'];}
					if(isset($idUsoFTP)) {             $x19 = $idUsoFTP;             }else{$x19 = $rowdata['idUsoFTP'];}
					if(isset($FTP_Carpeta)) {          $x20 = $FTP_Carpeta;          }else{$x20 = $rowdata['FTP_Carpeta'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Basicos');
					$Form_Inputs->form_input_icon('Identificador', 'Identificador', $x1, 2,'fa fa-flag');
					$Form_Inputs->form_select('Hardware','idDispositivo', $x2, 2, 'idDispositivo', 'Nombre', 'telemetria_listado_dispositivos', 0, '', $dbConn);	
					$Form_Inputs->form_select('SHIELD','idShield', $x3, 1, 'idShield', 'Nombre', 'telemetria_listado_shield', 0, '', $dbConn);	
					$Form_Inputs->form_time('Tiempo Fuera Linea Maximo','TiempoFueraLinea', $x4, 1, 1);
					
					//Solo para plataforma CrossTech
					if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==6){
						$Form_Inputs->form_post_data(2, 'Esta opcion indica en que pestaña de la pantalla principal sera mostrado el equipo (Funcion solo disponible con la interfaz de  crosstech.)' );
						$Form_Inputs->form_select('Tab','idTab', $x5, 2, 'idTab', 'Nombre', 'core_telemetria_tabs', 0, '', $dbConn);	
					}
					
					$Form_Inputs->form_tittle(3, 'Funciones');
					$Form_Inputs->form_post_data(2, 'Uso de las funciones de gps y alertas relacionadas a este (geocercas, detenciones, ingreso a lugares prohibidos, etc.)' );
					$Form_Inputs->form_select('Geolocalizacion','id_Geo', $x6, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					
					$Form_Inputs->form_post_data(2, 'Uso de las funciones de Telemetria (registro de sensores, alertas, etc.)' );
					$Form_Inputs->form_select('Sensores','id_Sensores', $x7, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Inputs->form_select_n_auto('Cantidad de Sensores','cantSensores', $x8, 1, 1, 72);
					
					$Form_Inputs->form_post_data(2, 'Registra el ingreso y la salida de los predios configurados, para ser utilizado debe tener la opcion de Geolocalizacion activa.' );
					$Form_Inputs->form_select('Uso de Predios (Cross)','idUsoPredio', $x10, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					
					$Form_Inputs->form_post_data(2, 'Opcion de respaldo de la tabla donde se guardan los datos del equipo bajo una cierta cantidad de registros.' );
					$Form_Inputs->form_select('Backup Tabla relacionada','idBackup', $x13, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Inputs->form_input_number('N° Registros para Backup','NregBackup', $x14, 1);
				
					$Form_Inputs->form_post_data(2, 'Indica si la alimentacion electrica es directa o por generador, despliega una lista de equipos de telemetria configurados con el tab de <strong>CrossE</strong>, esto genera un boton en el widget principal.' );
					$Form_Inputs->form_select('Uso Generador','idGenerador', $x15, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Inputs->form_select_filter('Generador','idTelGenerador', $x16, 1, 'idTelemetria', 'Nombre', 'telemetria_listado', $w, '', $dbConn);	
					$Form_Inputs->form_date('Fecha Instalacion Generador','FechaInsGen', $x17, 1);
					
					$Form_Inputs->form_post_data(2, 'Indica si el equipo de telemetria notificara de inmediato a los usuarios respecto a un error.' );
					$Form_Inputs->form_select('Alerta Temprana','idAlertaTemprana', $x18, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					
					$Form_Inputs->form_post_data(2, 'Se utiliza para los raros casos que el equipo de telemetria requiera guardar los datos en una carpeta en especifico, se utiliza para varias opciones.' );
					$Form_Inputs->form_select('Uso de Carpeta FTP','idUsoFTP', $x19, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Inputs->form_input_icon('Nombre Carpeta FTP', 'FTP_Carpeta', $x20, 1,'fa fa-flag');
					
					$Form_Inputs->form_input_hidden('idTelemetria', $_GET['id'], 2);
					?>
					
					<script>
						document.getElementById('div_cantSensores').style.display = 'none';
						document.getElementById('div_NregBackup').style.display = 'none';
						document.getElementById('div_idTelGenerador').style.display = 'none';
						document.getElementById('div_FechaInsGen').style.display = 'none';
						document.getElementById('div_FTP_Carpeta').style.display = 'none';
						
						//se ejecuta al cargar la página (OBLIGATORIO)
						$(document).ready(function(){ 
							
							let id_Sensores   = $("#id_Sensores").val();
							let idBackup      = $("#idBackup").val();
							let idUsoFTP      = $("#idUsoFTP").val();
							let idTelGen      = $("#idGenerador").val();
							/*******************************/
							//si es SI
							if(id_Sensores == 1){ 
								document.getElementById('div_cantSensores').style.display = '';						
							//si es NO
							} else if(id_Sensores == 2){ 
								document.getElementById('div_cantSensores').style.display = 'none';	
								//Reseteo los valores a 0
								document.getElementById('cantSensores').value = "0";
							}
							/*******************************/
							//si es SI
							if(idBackup == 1){ 
								document.getElementById('div_NregBackup').style.display = '';						
							//si es NO
							} else if(idBackup == 2){ 
								document.getElementById('div_NregBackup').style.display = 'none';	
								//Reseteo los valores a 0
								document.getElementById('NregBackup').value = "0";
							}
							/*******************************/
							//si es SI
							if(idUsoFTP == 1){ 
								document.getElementById('div_FTP_Carpeta').style.display = '';						
							//si es NO
							} else if(idUsoFTP == 2){ 
								document.getElementById('div_FTP_Carpeta').style.display = 'none';	
								//Reseteo los valores a 0
								document.getElementById('FTP_Carpeta').value = "";
							}
							/*******************************/
							//si es SI
							if(idTelGen == 1){ 
								document.getElementById('div_idTelGenerador').style.display = '';	
								document.getElementById('div_FechaInsGen').style.display = '';					
							//si es NO
							} else if(idTelGen == 2){ 
								document.getElementById('div_idTelGenerador').style.display = 'none';
								document.getElementById('div_FechaInsGen').style.display = 'none';	
								//Reseteo los valores a 0
								document.getElementById('idTelGenerador').selectedIndex = 0;
							}
							
							
						}); 
						
						$("#id_Sensores").on("change", function(){ //se ejecuta al cambiar valor del select
							let id_SensoresSelected = $(this).val(); //Asignamos el valor seleccionado
					
							//si es SI
							if(id_SensoresSelected == 1){ 
								document.getElementById('div_cantSensores').style.display = '';
															
							//si es NO
							} else if(id_SensoresSelected == 2){ 
								document.getElementById('div_cantSensores').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('cantSensores').value = "0";
							}
						});
						
						$("#idBackup").on("change", function(){ //se ejecuta al cambiar valor del select
							let idBackupSelected = $(this).val(); //Asignamos el valor seleccionado
					
							//si es SI
							if(idBackupSelected == 1){ 
								document.getElementById('div_NregBackup').style.display = '';
															
							//si es NO
							} else if(idBackupSelected == 2){ 
								document.getElementById('div_NregBackup').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('NregBackup').value = "0";
							}
						});
						
						$("#idUsoFTP").on("change", function(){ //se ejecuta al cambiar valor del select
							let idUsoFTPSelected = $(this).val(); //Asignamos el valor seleccionado
					
							//si es SI
							if(idUsoFTPSelected == 1){ 
								document.getElementById('div_FTP_Carpeta').style.display = '';
															
							//si es NO
							} else if(idUsoFTPSelected == 2){ 
								document.getElementById('div_FTP_Carpeta').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('FTP_Carpeta').value = "";
							}
						});
						
						$("#idGenerador").on("change", function(){ //se ejecuta al cambiar valor del select
							let idGeneradorSelected = $(this).val(); //Asignamos el valor seleccionado
					
							//si es SI
							if(idGeneradorSelected == 1){ 
								document.getElementById('div_idTelGenerador').style.display = '';
								document.getElementById('div_FechaInsGen').style.display = '';							
							//si es NO
							} else if(idGeneradorSelected == 2){ 
								document.getElementById('div_idTelGenerador').style.display = 'none';
								document.getElementById('div_FechaInsGen').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('idTelGenerador').selectedIndex = 0;
								document.getElementById('FechaInsGen').value = "";
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
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
