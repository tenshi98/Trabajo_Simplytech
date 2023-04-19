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
//Cargamos la ubicacion original
$original = "aguas_clientes_listado.php";
$location = $original;
$new_location = "aguas_clientes_listado_datos_facturacion.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del Cliente sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$location.='&id='.$_GET['id'];
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Cliente Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Cliente Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Cliente Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'Identificador, Nombre,RazonSocial, idMarcadores, idRemarcadores,
UnidadHabitacional, Arranque, idFacturable, idCiudadFact, idComunaFact, DireccionFact,
Giro, idRubro, latitud, longitud';
$SIS_join  = '';
$SIS_where = 'idCliente = '.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Cliente '.$rowdata['Identificador'], $rowdata['Nombre'], 'Editar Datos Facturacion'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'aguas_clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'aguas_clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Persona Contacto</a></li>
						<li class="active"><a href="<?php echo 'aguas_clientes_listado_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Facturacion</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_mediciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-eyedropper" aria-hidden="true"></i> Datos Mediciones</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;padding-bottom:240px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($RazonSocial)){         $x1  = $RazonSocial;          }else{$x1  = $rowdata['RazonSocial'];}
					if(isset($idMarcadores)){        $x2  = $idMarcadores;         }else{$x2  = $rowdata['idMarcadores'];}
					if(isset($idRemarcadores)){      $x3  = $idRemarcadores;       }else{$x3  = $rowdata['idRemarcadores'];}
					if(isset($UnidadHabitacional)){  $x4  = $UnidadHabitacional;   }else{$x4  = $rowdata['UnidadHabitacional'];}
					if(isset($Arranque)){            $x5  = $Arranque;             }else{$x5  = $rowdata['Arranque'];}
					if(isset($idFacturable)){        $x6  = $idFacturable;         }else{$x6  = $rowdata['idFacturable'];}
					if(isset($idCiudadFact)){        $x7  = $idCiudadFact;         }else{$x7  = $rowdata['idCiudadFact'];}
					if(isset($idComunaFact)){        $x8  = $idComunaFact;         }else{$x8  = $rowdata['idComunaFact'];}
					if(isset($DireccionFact)){       $x9  = $DireccionFact;        }else{$x9  = $rowdata['DireccionFact'];}
					if(isset($Giro)){                $x10 = $Giro;                 }else{$x10 = $rowdata['Giro'];}
					if(isset($idRubro)){             $x11 = $idRubro;              }else{$x11 = $rowdata['idRubro'];}
					if(isset($latitud)){             $x12 = $latitud;              }else{$x12 = $rowdata['latitud'];}
					if(isset($longitud)){            $x13 = $longitud;             }else{$x13 = $rowdata['longitud'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_input_text('Razon Social', 'RazonSocial', $x1, 1);
					$Form_Inputs->form_select_depend1('Marcador','idMarcadores', $x2, 2, 'idMarcadores', 'Nombre', 'aguas_marcadores_listado', 0, 0,
													'Remarcador','idRemarcadores', $x3, 1, 'idRemarcadores', 'Nombre', 'aguas_marcadores_remarcadores', 0, 0, 
													$dbConn, 'form1');
					$Form_Inputs->form_input_number('Unidad Habitacional', 'UnidadHabitacional', $x4, 2);
					$Form_Inputs->form_input_number('Arranque (mm)', 'Arranque', $x5, 2);
					$Form_Inputs->form_select('Forma Facturacion','idFacturable', $x6, 2, 'idFacturable', 'Nombre', 'aguas_clientes_facturable', 0, '', $dbConn);
					$Form_Inputs->form_select_depend1('Ciudad de Facturacion','idCiudadFact', $x7, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
													'Comuna de Facturacion','idComunaFact', $x8, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
													$dbConn, 'form1');
					$Form_Inputs->form_input_icon('Direccion de Facturacion', 'DireccionFact', $x9, 2,'fa fa-map');
					$Form_Inputs->form_input_icon('Giro de la empresa', 'Giro', $x10, 1,'fa fa-industry');
					$Form_Inputs->form_select_filter('Rubro','idRubro', $x11, 1, 'idRubro', 'Codigo,Nombre', 'core_rubros', 0, '', $dbConn);
					$Form_Inputs->form_input_number('Latitud', 'latitud', $x12, 2);
					$Form_Inputs->form_input_number('Longitud', 'longitud', $x13, 2);

					$Form_Inputs->form_input_hidden('idCliente', $_GET['id'], 2);

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
					</div>
				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:30px">
	<a href="<?php echo $location ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
	<div class="clearfix"></div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
