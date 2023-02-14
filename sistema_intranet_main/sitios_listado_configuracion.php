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
$original = "sitios_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//se agregan ubicaciones
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/sitios_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Sitio creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Sitio editado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Sitio borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// consulto los datos
$SIS_query = 'Nombre,Config_Logo_Nombre,Config_Logo_Archivo,Config_Root_Folder,Config_Menu,
Config_MenuOtros,Config_Carousel,Config_Links_Rel,Config_Top_Bar,Config_Footer_Links,
Config_Footer_Services,Config_Footer_Letters,idEstado,Config_SMTP_mailUsername,
Config_SMTP_mailPassword,Config_SMTP_Host,Config_SMTP_Port,Config_SMTP_Secure';
$SIS_join  = '';
$SIS_where = 'idSitio = '.simpleDecode($_GET['id'], fecha_actual());
$rowdata = db_select_data (false, $SIS_query, 'sitios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Sitio', $rowdata['Nombre'], 'Editar Configuracion');?>
</div>
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'sitios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'sitios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class="active"><a href="<?php echo 'sitios_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<?php if(isset($rowdata['Config_Menu'])&&$rowdata['Config_Menu']==1){ ?>            <li class=""><a href="<?php echo 'sitios_listado_menu.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list" aria-hidden="true"></i> Menu</a></li><?php } ?>
						<?php if(isset($rowdata['Config_MenuOtros'])&&$rowdata['Config_MenuOtros']==1){ ?>  <li class=""><a href="<?php echo 'sitios_listado_menu_otros.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list" aria-hidden="true"></i> Menu Otros</a></li><?php } ?>
						<?php if(isset($rowdata['Config_Carousel'])&&$rowdata['Config_Carousel']==1){ ?>    <li class=""><a href="<?php echo 'sitios_listado_carousel.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-file-image-o" aria-hidden="true"></i> Carousel</a></li><?php } ?>
						<?php if(isset($rowdata['Config_Links_Rel'])&&$rowdata['Config_Links_Rel']==1){ ?>  <li class=""><a href="<?php echo 'sitios_listado_links.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-link" aria-hidden="true"></i> Links Relacionados</a></li><?php } ?>
						
						<li class=""><a href="<?php echo 'sitios_listado_body.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Body</a></li>
					</ul>
                </li>
			</ul>
		</header>
        <div class="table-responsive">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>

					<?php 
					//Se verifican si existen los datos
					if(isset($Config_Logo_Nombre)){       $x1  = $Config_Logo_Nombre;       }else{$x1  = $rowdata['Config_Logo_Nombre'];}
					if(isset($Config_Logo_Archivo)){      $x2  = $Config_Logo_Archivo;      }else{$x2  = $rowdata['Config_Logo_Archivo'];}
					if(isset($Config_Root_Folder)){       $x3  = $Config_Root_Folder;       }else{$x3  = $rowdata['Config_Root_Folder'];}
					if(isset($idEstado)){                 $x4  = $idEstado;                 }else{$x4  = $rowdata['idEstado'];}
					if(isset($Config_Menu)){              $x5  = $Config_Menu;              }else{$x5  = $rowdata['Config_Menu'];}
					if(isset($Config_MenuOtros)){         $x6  = $Config_MenuOtros;         }else{$x6  = $rowdata['Config_MenuOtros'];}
					if(isset($Config_Carousel)){          $x7  = $Config_Carousel;          }else{$x7  = $rowdata['Config_Carousel'];}
					if(isset($Config_Links_Rel)){         $x8  = $Config_Links_Rel;         }else{$x8  = $rowdata['Config_Links_Rel'];}
					if(isset($Config_Top_Bar)){           $x9  = $Config_Top_Bar;           }else{$x9  = $rowdata['Config_Top_Bar'];}
					if(isset($Config_Footer_Links)){      $x10 = $Config_Footer_Links;      }else{$x10 = $rowdata['Config_Footer_Links'];}
					if(isset($Config_Footer_Services)){   $x11 = $Config_Footer_Services;   }else{$x11 = $rowdata['Config_Footer_Services'];}
					if(isset($Config_Footer_Letters)){    $x12 = $Config_Footer_Letters;    }else{$x12 = $rowdata['Config_Footer_Letters'];}
					if(isset($Config_SMTP_mailUsername)){ $x13 = $Config_SMTP_mailUsername; }else{$x13 = $rowdata['Config_SMTP_mailUsername'];}
					if(isset($Config_SMTP_mailPassword)){ $x14 = $Config_SMTP_mailPassword; }else{$x14 = $rowdata['Config_SMTP_mailPassword'];}
					if(isset($Config_SMTP_Host)){         $x15 = $Config_SMTP_Host;         }else{$x15 = $rowdata['Config_SMTP_Host'];}
					if(isset($Config_SMTP_Port)){         $x16 = $Config_SMTP_Port;         }else{$x16 = $rowdata['Config_SMTP_Port'];}
					if(isset($Config_SMTP_Secure)){       $x17 = $Config_SMTP_Secure;       }else{$x17 = $rowdata['Config_SMTP_Secure'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					
					$Form_Inputs->form_post_data(2, '<strong>Configuracion: </strong>Ajustes generales.' );
					$Form_Inputs->form_input_text('Nombre Logo', 'Config_Logo_Nombre', $x1, 1);
					$Form_Inputs->form_input_text('Nombre Archivo Logo', 'Config_Logo_Archivo', $x2, 1);
					$Form_Inputs->form_input_text('Carpeta Raiz', 'Config_Root_Folder', $x3, 2);
					$Form_Inputs->form_select('Estado','idEstado', $x4, 2, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
					
					$Form_Inputs->form_post_data(2, '<strong>Elementos: </strong>Elementos existentes y necesarios.' );
					$Form_Inputs->form_select('Uso Menu','Config_Menu', $x5, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					$Form_Inputs->form_select('Uso Menu Otros','Config_MenuOtros', $x6, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					$Form_Inputs->form_select('Uso Carousel','Config_Carousel', $x7, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					$Form_Inputs->form_select('Uso Links Relacionados','Config_Links_Rel', $x8, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					
					$Form_Inputs->form_post_data(2, '<strong>Mostrar elementos extras: </strong>' );
					$Form_Inputs->form_select('Mostrar Top Bar','Config_Top_Bar', $x9, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					$Form_Inputs->form_select('Mostrar enlaces en el Footer','Config_Footer_Links', $x10, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					$Form_Inputs->form_select('Mostrar servicios en el Footer','Config_Footer_Services', $x11, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					$Form_Inputs->form_select('Mostrar suscripcion en el Footer','Config_Footer_Letters', $x12, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
					
					$Form_Inputs->form_post_data(2, '<strong>Contacto: </strong>Usuario y contraseña del gestor de correos del servidor.' );
					$Form_Inputs->form_input_icon('Usuario SMTP', 'Config_SMTP_mailUsername', $x13, 1,'fa fa-users');
					$Form_Inputs->form_input_icon('Contraseña del usuario SMTP', 'Config_SMTP_mailPassword', $x14, 1,'fa fa-users');
					$Form_Inputs->form_input_icon('Host del correo SMTP', 'Config_SMTP_Host', $x15, 1,'fa fa-users');
					$Form_Inputs->form_input_number('Puerto del correo SMTP', 'Config_SMTP_Port', $x16, 1);
					$Form_Inputs->form_input_icon('Protocolo de seguridad del correo SMTP', 'Config_SMTP_Secure', $x17, 1,'fa fa-users');
					
					$Form_Inputs->form_input_hidden('idSitio', simpleDecode($_GET['id'], fecha_actual()), 2);
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
