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
$original = "prospectos_listado.php";
$location = $original;
$new_location = "prospectos_listado_datos.php";
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
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/prospectos_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Prospecto creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Prospecto editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Prospecto borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// consulto los datos
$query = "SELECT idTipo, Nombre, fNacimiento, idCiudad, idComuna, Direccion, idSistema,
idTab_1, idTab_2, idTab_3, idTab_4, idTab_5, idTab_6, idTab_7, idTab_8, idTab_8, idTab_9, 
idTab_10, idTab_11, idTab_12, idTab_13, idTab_14, idTab_15
FROM `prospectos_listado`
WHERE idProspecto = ".$_GET['id'];
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
$rowdata = mysqli_fetch_assoc ($resultado);?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Prospecto', $rowdata['Nombre'], 'Editar Datos Basicos');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'prospectos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'prospectos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'prospectos_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'prospectos_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Persona Contacto</a></li>
						<li class=""><a href="<?php echo 'prospectos_listado_datos_comerciales.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Comerciales</a></li>
						<li class=""><a href="<?php echo 'prospectos_listado_fidelizacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Estado Fidelizacion</a></li>
						<li class=""><a href="<?php echo 'prospectos_listado_etapas.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Etapa Fidelizacion</a></li>
						<li class=""><a href="<?php echo 'prospectos_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'prospectos_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'prospectos_listado_crear_cliente.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-user-plus" aria-hidden="true"></i> Crear Cliente</a></li>
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		
			
					<?php 
					//Se verifican si existen los datos
					if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = $rowdata['idTipo'];}
					if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = $rowdata['Nombre'];}
					if(isset($fNacimiento)) {      $x3  = $fNacimiento;       }else{$x3  = $rowdata['fNacimiento'];}
					if(isset($idCiudad)) {         $x4  = $idCiudad;          }else{$x4  = $rowdata['idCiudad'];}
					if(isset($idComuna)) {         $x5  = $idComuna;          }else{$x5  = $rowdata['idComuna'];}
					if(isset($Direccion)) {        $x6  = $Direccion;         }else{$x6  = $rowdata['Direccion'];}
					if(isset($idTab_1)) {          $x7  = $idTab_1;           }else{$x7  = $rowdata['idTab_1'];}
					if(isset($idTab_2)) {          $x7 .= ','.$idTab_2;       }else{$x7 .= ','.$rowdata['idTab_2'];}
					if(isset($idTab_3)) {          $x7 .= ','.$idTab_3;       }else{$x7 .= ','.$rowdata['idTab_3'];}
					if(isset($idTab_4)) {          $x7 .= ','.$idTab_4;       }else{$x7 .= ','.$rowdata['idTab_4'];}
					if(isset($idTab_5)) {          $x7 .= ','.$idTab_5;       }else{$x7 .= ','.$rowdata['idTab_5'];}
					if(isset($idTab_6)) {          $x7 .= ','.$idTab_6;       }else{$x7 .= ','.$rowdata['idTab_6'];}
					if(isset($idTab_7)) {          $x7 .= ','.$idTab_7;       }else{$x7 .= ','.$rowdata['idTab_7'];}
					if(isset($idTab_8)) {          $x7 .= ','.$idTab_8;       }else{$x7 .= ','.$rowdata['idTab_8'];}
					if(isset($idTab_9)) {          $x7 .= ','.$idTab_9;       }else{$x7 .= ','.$rowdata['idTab_9'];}
					if(isset($idTab_10)) {         $x7 .= ','.$idTab_10;      }else{$x7 .= ','.$rowdata['idTab_10'];}
					if(isset($idTab_11)) {         $x7 .= ','.$idTab_11;      }else{$x7 .= ','.$rowdata['idTab_11'];}
					if(isset($idTab_12)) {         $x7 .= ','.$idTab_12;      }else{$x7 .= ','.$rowdata['idTab_12'];}
					if(isset($idTab_13)) {         $x7 .= ','.$idTab_13;      }else{$x7 .= ','.$rowdata['idTab_13'];}
					if(isset($idTab_14)) {         $x7 .= ','.$idTab_14;      }else{$x7 .= ','.$rowdata['idTab_14'];}
					if(isset($idTab_15)) {         $x7 .= ','.$idTab_15;      }else{$x7 .= ','.$rowdata['idTab_15'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Basicos');
					$Form_Inputs->form_select('Tipo de Prospecto','idTipo', $x1, 2, 'idTipo', 'Nombre', 'prospectos_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombre Fantasia', 'Nombre', $x2, 2);
					$Form_Inputs->form_date('F Ingreso Sistema','fNacimiento', $x3, 1);
					$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x4, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x5, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
											 $dbConn, 'form1');
					$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x6, 1,'fa fa-map');	 
					//Solo para plataforma Intranet
					if(isset($_SESSION['usuario']['basic_data']['idInterfaz'])&&$_SESSION['usuario']['basic_data']['idInterfaz']==7){
						$Form_Inputs->form_tittle(3, 'Unidades de Negocio');
						$Form_Inputs->form_checkbox_active('Unidad de Negocio','idTab', $x7, 1, 'idTab', 'Nombre', 'core_telemetria_tabs', 0, $dbConn);
					}
					
					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
					$Form_Inputs->form_input_hidden('idProspecto', $_GET['id'], 2);		
					$Form_Inputs->form_input_hidden('FModificacion', fecha_actual(), 2);
					$Form_Inputs->form_input_hidden('HModificacion', hora_actual(), 2);
					$Form_Inputs->form_input_hidden('idUsuarioMod', $_SESSION['usuario']['basic_data']['idUsuario'], 2);
					?>

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
