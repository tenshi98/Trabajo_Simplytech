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
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "core_sistemas.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/core_sistemas.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['Cliente'] 	  = 'sucess/Sistema creado correctamente';}
if (isset($_GET['edited']))  {$error['Cliente'] 	  = 'sucess/Sistema editado correctamente';}
if (isset($_GET['deleted'])) {$error['Cliente'] 	  = 'sucess/Sistema borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos de mi usuario
$query = "SELECT Nombre,Config_idTheme, Config_CorreoRespaldo, email_principal, idOpcionesTel, 
idConfigRam, idConfigTime, idOpcionesGen_1, idOpcionesGen_2, idOpcionesGen_3, idOpcionesGen_4, 
idOpcionesGen_5, idOpcionesGen_6, idOpcionesGen_7, idOpcionesGen_8, idOpcionesGen_9
FROM `core_sistemas`
WHERE idSistema = {$_GET['id']}";
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
?>
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Sistema</span>
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
				<li class=""><a href="<?php echo 'core_sistemas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'core_sistemas_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'core_sistemas_datos_contrato.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contrato</a></li>
						<li class="active"><a href="<?php echo 'core_sistemas_datos_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Configuracion</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_opciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >APIS</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Facturacion</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_ot.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >OT</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Logo</a></li>
						<li class=""><a href="<?php echo 'core_sistemas_datos_oc.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Aprobador OC</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($Config_idTheme)) {          $x1  = $Config_idTheme;          }else{$x1  = $rowdata['Config_idTheme'];}
					if(isset($Config_CorreoRespaldo)) {   $x2  = $Config_CorreoRespaldo;   }else{$x2  = $rowdata['Config_CorreoRespaldo'];}
					if(isset($email_principal)) {         $x3  = $email_principal;         }else{$x3  = $rowdata['email_principal'];}
					if(isset($idOpcionesTel)) {           $x4  = $idOpcionesTel;           }else{$x4  = $rowdata['idOpcionesTel'];}
					if(isset($idConfigRam)) {             $x5  = $idConfigRam;             }else{$x5  = $rowdata['idConfigRam'];}
					if(isset($idConfigTime)) {            $x6  = $idConfigTime;            }else{$x6  = $rowdata['idConfigTime'];}
					if(isset($idOpcionesGen_1)) {         $x7  = $idOpcionesGen_1;         }else{$x7  = $rowdata['idOpcionesGen_1'];}
					if(isset($idOpcionesGen_2)) {         $x8  = $idOpcionesGen_2;         }else{$x8  = $rowdata['idOpcionesGen_2'];}
					if(isset($idOpcionesGen_3)) {         $x9  = $idOpcionesGen_3;         }else{$x9  = $rowdata['idOpcionesGen_3'];}
					if(isset($idOpcionesGen_4)) {         $x10 = $idOpcionesGen_4;         }else{$x10 = $rowdata['idOpcionesGen_4'];}
					if(isset($idOpcionesGen_5)) {         $x11 = $idOpcionesGen_5;         }else{$x11 = $rowdata['idOpcionesGen_5'];}
					if(isset($idOpcionesGen_6)) {         $x12 = $idOpcionesGen_6;         }else{$x12 = $rowdata['idOpcionesGen_6'];}
					if(isset($idOpcionesGen_7)) {         $x13 = $idOpcionesGen_7;         }else{$x13 = $rowdata['idOpcionesGen_7'];}
					if(isset($idOpcionesGen_8)) {         $x14 = $idOpcionesGen_8;         }else{$x14 = $rowdata['idOpcionesGen_8'];}
					if(isset($idOpcionesGen_9)) {         $x15 = $idOpcionesGen_9;         }else{$x15 = $rowdata['idOpcionesGen_9'];}
					
					//se dibujan los inputs
					$Form_Imputs = new Form_Inputs();
					echo '<h3>Configuracion</h3>';
					$Form_Imputs->form_select('Tema','Config_idTheme', $x1, 2, 'idTheme', 'Nombre', 'core_theme_colors', 0, '', $dbConn);	
					$Form_Imputs->form_input_icon( 'Correo de Respaldo', 'Config_CorreoRespaldo', $x2, 1,'fa fa-envelope-o');
					$Form_Imputs->form_input_icon( 'Correo de Sistema', 'email_principal', $x3, 1,'fa fa-envelope-o');
					$Form_Imputs->form_select('Tipo Resumen Telemetria','idOpcionesTel', $x4, 1, 'idOpcionesTel', 'Nombre', 'core_sistemas_opciones_telemetria', 0, '', $dbConn);	
					$Form_Imputs->form_select('Ram Maxima (Mega Bytes)','idConfigRam', $x5, 2, 'idConfigRam', 'Nombre', 'core_config_ram', 0, '', $dbConn);	
					$Form_Imputs->form_select('Tiempo Maximo (Minutos)','idConfigTime', $x6, 2, 'idConfigTime', 'Nombre', 'core_config_time', 0, '', $dbConn);	
					
					echo '<h3>Opciones</h3>';
					$Form_Imputs->form_select('Widget Comunes','idOpcionesGen_1', $x7, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_select('Widget de acceso directo','idOpcionesGen_2', $x8, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_select('Valores promedios de las mediciones','idOpcionesGen_3', $x9, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_select('Refresh Pagina Principal','idOpcionesGen_4', $x10, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_input_number('Segundos para Refrescar','idOpcionesGen_6', $x12, 1);
					$Form_Imputs->form_select('Motor PDF','idOpcionesGen_5', $x11, 2, 'idPDF', 'Nombre', 'core_pdf_motores', 0, '', $dbConn);	
					$Form_Imputs->form_select('Interfaz','idOpcionesGen_7', $x13, 2, 'idInterfaz', 'Nombre', 'core_interfaces', 0, '', $dbConn);	
					$Form_Imputs->form_select('Correo Interno','idOpcionesGen_8', $x14, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					$Form_Imputs->form_select('Mostrar Repositorio','idOpcionesGen_9', $x15, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
						
					$Form_Imputs->form_input_hidden('idSistema', $_GET['id'], 2);
					?>
					
					<script>
						document.getElementById('div_idOpcionesGen_6').style.display = 'none';
						
						var Sensores_val;
						var modelSelected1;
								
				 
						$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
									
							Sensores_val= $("#idOpcionesGen_4").val();
							
							//si es medicion
							if(Sensores_val == 1){ 
								document.getElementById('div_idOpcionesGen_6').style.display = '';					
							//para el resto
							} else if(Sensores_val == 2){ 
								document.getElementById('div_idOpcionesGen_6').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('idOpcionesGen_6').selectedIndex = 0;
							}		
						}); 
								
						$("#idOpcionesGen_4").on("change", function(){ //se ejecuta al cambiar valor del select
							modelSelected1 = $(this).val(); //Asignamos el valor seleccionado
							
							//si es medicion
							if(modelSelected1 == 1){ 
								document.getElementById('div_idOpcionesGen_6').style.display = '';					
							//para el resto
							} else  if(modelSelected1 == 2){ 
								document.getElementById('div_idOpcionesGen_6').style.display = 'none';
								//Reseteo los valores a 0
								document.getElementById('idOpcionesGen_6').selectedIndex = 0;
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
