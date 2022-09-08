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
if ( !empty($_POST['submit_edit']) )  { 
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
$SIS_query = 'Nombre,Config_Menu,Config_MenuOtros,Config_Carousel,Config_Links_Rel,
Domain,Whatsapp_number_1,Whatsapp_number_2,Whatsapp_tittle,
Header_Titulo,Header_TituloStyle,Header_Texto,Header_TextoStyle,Header_LinkNombre,Header_LinkStyle,Header_LinkURL,Header_idNewTab,Header_idPopup,
Contact_Tittle,Contact_Tittle_body,Contact_Address_tittle,Contact_Address_body,Contact_Email_tittle,
Contact_Email_body,Contact_Phone_tittle,Contact_Phone_body,Contact_Recep_asunto,
Contact_Recep_mail,Contact_Recep_name,Social_Tittle,Social_Twitter,Social_Facebook,
Social_Instagram,Social_Googleplus,Social_Linkedin,Nosotros_Titulo,Nosotros_Subtitulo,
Nosotros_Texto,Nosotros_Link';
$SIS_join  = '';
$SIS_where = 'sitios_listado.idSitio = '.simpleDecode($_GET['id'], fecha_actual());
$rowdata = db_select_data (false, $SIS_query, 'sitios_listado', $SIS_join, $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'rowdata');

?>

<div class="col-sm-12">
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Sitio', $rowdata['Nombre'], 'Editar Datos Basicos');?>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'sitios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class="active"><a href="<?php echo 'sitios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'sitios_listado_configuracion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Configuracion</a></li>
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
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>		

					<?php 
					//Se verifican si existen los datos
					if(isset($Nombre)) {                  $x1  = $Nombre;                  }else{$x1  = $rowdata['Nombre'];}
					if(isset($Domain)) {                  $x2  = $Domain;                  }else{$x2  = $rowdata['Domain'];}
					if(isset($Whatsapp_tittle)) {         $x3  = $Whatsapp_tittle;         }else{$x3  = $rowdata['Whatsapp_tittle'];}
					if(isset($Whatsapp_number_1)) {       $x4  = $Whatsapp_number_1;       }else{$x4  = $rowdata['Whatsapp_number_1'];}
					if(isset($Whatsapp_number_2)) {       $x5  = $Whatsapp_number_2;       }else{$x5  = $rowdata['Whatsapp_number_2'];}
					if(isset($Header_Titulo)) {           $x6  = $Header_Titulo;           }else{$x6  = $rowdata['Header_Titulo'];}
					if(isset($Header_TituloStyle)) {      $x7  = $Header_TituloStyle;      }else{$x7  = $rowdata['Header_TituloStyle'];}
					if(isset($Header_Texto)) {            $x8  = $Header_Texto;            }else{$x8  = $rowdata['Header_Texto'];}
					if(isset($Header_TextoStyle)) {       $x9  = $Header_TextoStyle;       }else{$x9  = $rowdata['Header_TextoStyle'];}
					if(isset($Header_LinkNombre)) {       $x10 = $Header_LinkNombre;       }else{$x10 = $rowdata['Header_LinkNombre'];}
					if(isset($Header_LinkStyle)) {        $x11 = $Header_LinkStyle;        }else{$x11 = $rowdata['Header_LinkStyle'];}
					if(isset($Header_LinkURL)) {          $x12 = $Header_LinkURL;          }else{$x12 = $rowdata['Header_LinkURL'];}
					if(isset($Header_idNewTab)) {         $x13 = $Header_idNewTab;         }else{$x13 = $rowdata['Header_idNewTab'];}
					if(isset($Header_idPopup)) {          $x14 = $Header_idPopup;          }else{$x14 = $rowdata['Header_idPopup'];}
					if(isset($Contact_Tittle)) {          $x15 = $Contact_Tittle;          }else{$x15 = $rowdata['Contact_Tittle'];}
					if(isset($Contact_Tittle_body)) {     $x16 = $Contact_Tittle_body;     }else{$x16 = $rowdata['Contact_Tittle_body'];}
					if(isset($Contact_Address_tittle)) {  $x17 = $Contact_Address_tittle;  }else{$x17 = $rowdata['Contact_Address_tittle'];}
					if(isset($Contact_Address_body)) {    $x18 = $Contact_Address_body;    }else{$x18 = $rowdata['Contact_Address_body'];}
					if(isset($Contact_Email_tittle)) {    $x19 = $Contact_Email_tittle;    }else{$x19 = $rowdata['Contact_Email_tittle'];}
					if(isset($Contact_Email_body)) {      $x20 = $Contact_Email_body;      }else{$x20 = $rowdata['Contact_Email_body'];}
					if(isset($Contact_Phone_tittle)) {    $x21 = $Contact_Phone_tittle;    }else{$x21 = $rowdata['Contact_Phone_tittle'];}
					if(isset($Contact_Phone_body)) {      $x22 = $Contact_Phone_body;      }else{$x22 = $rowdata['Contact_Phone_body'];}
					if(isset($Contact_Recep_asunto)) {    $x23 = $Contact_Recep_asunto;    }else{$x23 = $rowdata['Contact_Recep_asunto'];}
					if(isset($Contact_Recep_mail)) {      $x24 = $Contact_Recep_mail;      }else{$x24 = $rowdata['Contact_Recep_mail'];}
					if(isset($Contact_Recep_name)) {      $x25 = $Contact_Recep_name;      }else{$x25 = $rowdata['Contact_Recep_name'];}
					if(isset($Social_Tittle)) {           $x26 = $Social_Tittle;           }else{$x26 = $rowdata['Social_Tittle'];}
					if(isset($Social_Twitter)) {          $x27 = $Social_Twitter;          }else{$x27 = $rowdata['Social_Twitter'];}
					if(isset($Social_Facebook)) {         $x28 = $Social_Facebook;         }else{$x28 = $rowdata['Social_Facebook'];}
					if(isset($Social_Instagram)) {        $x29 = $Social_Instagram;        }else{$x29 = $rowdata['Social_Instagram'];}
					if(isset($Social_Googleplus)) {       $x30 = $Social_Googleplus;       }else{$x30 = $rowdata['Social_Googleplus'];}
					if(isset($Social_Linkedin)) {         $x31 = $Social_Linkedin;         }else{$x31 = $rowdata['Social_Linkedin'];}
					if(isset($Nosotros_Titulo)) {         $x32 = $Nosotros_Titulo;         }else{$x32 = $rowdata['Nosotros_Titulo'];}
					if(isset($Nosotros_Subtitulo)) {      $x33 = $Nosotros_Subtitulo;      }else{$x33 = $rowdata['Nosotros_Subtitulo'];}
					if(isset($Nosotros_Texto)) {          $x34 = $Nosotros_Texto;          }else{$x34 = $rowdata['Nosotros_Texto'];}
					if(isset($Nosotros_Link)) {           $x35 = $Nosotros_Link;           }else{$x35 = $rowdata['Nosotros_Link'];}
					
					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Basicos');
					$Form_Inputs->form_input_text('Nombre', 'Nombre', $x1, 2);
					$Form_Inputs->form_input_text('Dominio', 'Domain', $x2, 1);
					
					$Form_Inputs->form_tittle(3, 'Whatsapp');
					$Form_Inputs->form_input_text('Titulo', 'Whatsapp_tittle', $x3, 1);
					$Form_Inputs->form_input_phone('Numero Whatsapp 1', 'Whatsapp_number_1', $x4, 1);
					$Form_Inputs->form_input_phone('Numero Whatsapp 2', 'Whatsapp_number_2', $x5, 1);
					
					//Si el carrousel esta desactivado
					if(isset($rowdata['Config_Carousel'])&&$rowdata['Config_Carousel']==2){
						$Form_Inputs->form_tittle(3, 'Header');
						$Form_Inputs->form_input_text('Titulo', 'Header_Titulo', $x6, 2);
						$Form_Inputs->form_input_icon('Estilo del Titulo', 'Header_TituloStyle', $x7, 1,'fa fa-file-image-o');
						$Form_Inputs->form_textarea('Texto', 'Header_Texto', $x8, 1);
						$Form_Inputs->form_input_icon('Estilo del Texto', 'Header_TextoStyle', $x9, 1,'fa fa-file-image-o');
						$Form_Inputs->form_input_text('Nombre del enlace', 'Header_LinkNombre', $x10, 1);
						$Form_Inputs->form_input_icon('Estilo del enlace', 'Header_LinkStyle', $x11, 1,'fa fa-file-image-o');
						$Form_Inputs->form_input_text('Enlace (Link o referencia)', 'Header_LinkURL', $x12, 1);
						$Form_Inputs->form_select('Abrir en una nueva pestaña','Header_idNewTab', $x13, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
						$Form_Inputs->form_select('Abrir en ventana emergente','Header_idPopup', $x14, 1, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);	
					}
					
					$Form_Inputs->form_tittle(3, 'Contacto');
					$Form_Inputs->form_input_text('Contacto - Titulo', 'Contact_Tittle', $x15, 1);
					$Form_Inputs->form_textarea('Contacto - Cuerpo', 'Contact_Tittle_body', $x16, 1);
					$Form_Inputs->form_input_icon('Direccion - Titulo', 'Contact_Address_tittle', $x17, 1,'fa fa-map');
					$Form_Inputs->form_textarea('Direccion - Cuerpo', 'Contact_Address_body', $x18, 1);
					$Form_Inputs->form_input_icon('Email - Titulo', 'Contact_Email_tittle', $x19, 1,'fa fa-envelope-o');
					$Form_Inputs->form_textarea('Email - Cuerpo', 'Contact_Email_body', $x20, 1);
					$Form_Inputs->form_input_icon('Fono - Titulo', 'Contact_Phone_tittle', $x21, 1,'fa fa-phone');
					$Form_Inputs->form_textarea('Fono - Cuerpo', 'Contact_Phone_body', $x22, 1);
					$Form_Inputs->form_input_icon('Receptor - Asunto', 'Contact_Recep_asunto', $x23, 1,'fa fa-users');
					$Form_Inputs->form_input_icon('Receptor - Email', 'Contact_Recep_mail', $x24, 1,'fa fa-users');
					$Form_Inputs->form_input_icon('Receptor - Nombre', 'Contact_Recep_name', $x25, 1,'fa fa-users');
					
					$Form_Inputs->form_tittle(3, 'Social');
					$Form_Inputs->form_input_text('Titulo', 'Social_Tittle', $x26, 1);
					$Form_Inputs->form_input_icon('Twitter', 'Social_Twitter', $x27, 1,'fa fa-twitter');
					$Form_Inputs->form_input_icon('Facebook', 'Social_Facebook', $x28, 1,'fa fa-facebook');
					$Form_Inputs->form_input_icon('Instagram', 'Social_Instagram', $x29, 1,'fa fa-instagram');
					$Form_Inputs->form_input_icon('Googleplus', 'Social_Googleplus', $x30, 1,'fa fa-google-plus');
					$Form_Inputs->form_input_icon('Linkedin', 'Social_Linkedin', $x31, 1,'fa fa-linkedin');
					
					$Form_Inputs->form_tittle(3, 'Nosotros');
					$Form_Inputs->form_input_text('Titulo', 'Nosotros_Titulo', $x32, 1);
					$Form_Inputs->form_input_text('Subtitulo', 'Nosotros_Subtitulo', $x33, 1);
					$Form_Inputs->form_textarea('Texto', 'Nosotros_Texto', $x34, 1);
					$Form_Inputs->form_input_icon('Link Video', 'Nosotros_Link', $x35, 1,'fa fa-link');
					
					
					$Form_Inputs->form_input_hidden('idSitio', simpleDecode($_GET['id'], fecha_actual()), 2);
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
