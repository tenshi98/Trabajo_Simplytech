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
$new_location = "aguas_clientes_listado_datos.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
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
if (isset($_GET['created'])){ $error['created'] = 'sucess/Cliente creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Cliente editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Cliente borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'Identificador, Nombre,idTipo, fNacimiento, idCiudad, idComuna, Direccion, idSistema, Rut';
$SIS_join  = '';
$SIS_where = 'idCliente = '.$_GET['id'];
$rowdata = db_select_data (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Cliente '.$rowdata['Identificador'], $rowdata['Nombre'], 'Editar Datos Basicos'); ?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'aguas_clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'aguas_clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Persona Contacto</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Facturacion</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_datos_mediciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-eyedropper" aria-hidden="true"></i> Datos Mediciones</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'aguas_clientes_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idTipo)){           $x1  = $idTipo;            }else{$x1  = $rowdata['idTipo'];}
					if(isset($Identificador)){    $x2  = $Identificador;     }else{$x2  = $rowdata['Identificador'];}
					if(isset($Nombre)){           $x3  = $Nombre;            }else{$x3  = $rowdata['Nombre'];}
					if(isset($Rut)){              $x4  = $Rut;               }else{$x4  = $rowdata['Rut'];}
					if(isset($fNacimiento)){      $x5  = $fNacimiento;       }else{$x5  = $rowdata['fNacimiento'];}
					if(isset($idCiudad)){         $x6  = $idCiudad;          }else{$x6  = $rowdata['idCiudad'];}
					if(isset($idComuna)){         $x7  = $idComuna;          }else{$x7  = $rowdata['idComuna'];}
					if(isset($Direccion)){        $x8  = $Direccion;         }else{$x8  = $rowdata['Direccion'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Basicos');
					$Form_Inputs->form_select('Tipo de Cliente','idTipo', $x1, 2, 'idTipo', 'Nombre', 'aguas_clientes_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Identificador', 'Identificador', $x2, 2);
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x3, 2);
					$Form_Inputs->form_input_rut('Rut', 'Rut', $x4, 2);

					$Form_Inputs->form_tittle(3, 'Datos Opcionales');
					$Form_Inputs->form_date('F Ingreso Sistema','fNacimiento', $x5, 1);
					$Form_Inputs->form_select_depend1('Region','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x7, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
											 $dbConn, 'form1');
					$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x8, 1,'fa fa-map');	 
					
					
					$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
					$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
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
