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
//Cargamos la ubicacion original
$original = "core_sistemas.php";
$location = $original;
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
//widget_title($bg_color, $icon, $porcentaje, $titulo, $subtitulo_1, $subtitulo_2)
echo widget_title('bg-green', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bg-yellow', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bg-red', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bg-purple', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bg-black', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bg-aqua', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bgx-blue', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo widget_title('bgx-orange', 'fa-cog', 100, 'Sistema', 'Nombre', 'Editar Datos de Contacto');
echo '<div class="clearfix"></div>';


//widget_Ficha_1($bg_color, $icon, $porcentaje, $titulo, $subtitulo, $enlace, $texto_enlace, $new_tab, $iframe)
echo widget_Ficha_1('bg-green', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo widget_Ficha_1('bg-yellow', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo widget_Ficha_1('bg-red', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo widget_Ficha_1('bg-purple', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo widget_Ficha_1('bg-black', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo widget_Ficha_1('bg-aqua', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo widget_Ficha_1('bgx-blue', 'fa-usd', 100, 'Cuentas por cobrar', '25 Pendientes', 'principal_facturas_alt.php?pagina=1&idTipo=2', 'Ver Pendientes', 1, 2);
echo '<div class="clearfix"></div>';

											
//widget_Ficha_2($bg_color, $icon, $number, $width, $titulo, $subtitulo, $enlace, $texto_enlace, $color_enlace, $new_tab, $iframe)	
echo widget_Ficha_2('box-green', '', 25, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);
echo widget_Ficha_2('box-yellow', '', 25, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);
echo widget_Ficha_2('box-red', '', 25, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);
echo widget_Ficha_2('box-purple', '', 25, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);
echo widget_Ficha_2('box-orange', '', 25, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);
echo widget_Ficha_2('box-blue', '', 25, 4, 'Cantidad Clientes', '', '', '', '', 1, 2);
echo '<div class="clearfix"></div>';

//widget_Ficha_3($bg_color, $icon, $number, $titulo, $enlace, $texto_enlace, $new_tab, $iframe)						
echo widget_Ficha_3('btn-primary', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bg-green', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bg-yellow', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bg-red', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bg-purple', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bg-black', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bg-aqua', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bgx-blue', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo widget_Ficha_3('bgx-orange', 'fa-user', 25, 'Clientes', 'www.google.cl?pagina=1', 'Administrar', 1, 1);
echo '<div class="clearfix"></div>';



//widget_Ficha_4($bg_color, $icon, $titulo, $subtitulo1, $subtitulo2);
echo widget_Ficha_4('bg-green', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bg-yellow', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bg-red', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bg-purple', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bg-black', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bg-aqua', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bgx-blue', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo widget_Ficha_4('bgx-orange', 'fa-cog', 'Sistema', 'Nombre', 'Editar Datos');
echo '<div class="clearfix"></div>';

//widget_Ficha_5($bg_color, $icon, $titulo, $subtitulo, $link, $linktext)
echo widget_Ficha_5('panel-default', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('panel-primary', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('panel-success', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('panel-info', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('panel-warning', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('panel-danger', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('bg-red', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo widget_Ficha_5('bg-black', 'fa-cog', 'Sistema', 'Nombre', 'www.google.cl', 'google');
echo '<div class="clearfix"></div>';

//widget_Ficha_6($link, $bg_color, $icon, $titulo, $subtitulo, $linktext)
echo widget_Ficha_6('www.google.cl', 'circle_dark-blue', 'fa-users', 'Usuarios', 265, 'Mas informacion');
echo widget_Ficha_6('www.google.cl', 'circle_green', 'fa-money', 'Usuarios', 265, 'Mas informacion');
echo widget_Ficha_6('www.google.cl', 'circle_orange', 'fa-bell', 'Usuarios', 265, 'Mas informacion');
echo widget_Ficha_6('www.google.cl', 'circle_blue', 'fa-tasks', 'Usuarios', 265, 'Mas informacion');
echo widget_Ficha_6('www.google.cl', 'circle_red', 'fa-shopping-cart', 'Usuarios', 265, 'Mas informacion');
echo widget_Ficha_6('www.google.cl', 'circle_purple', 'fa-comments', 'Usuarios', 265, 'Mas informacion');
echo '<div class="clearfix"></div>';

//widget_Ficha_7($icon, $bg_color, $titulo, $value)
echo widget_Ficha_7('fa-user', 'main-box_red-bg', 'Users', '2562');
echo widget_Ficha_7('fa-shopping-cart', 'main-box_emerald-bg', 'Users', '2562');
echo widget_Ficha_7('fa-money', 'main-box_green-bg', 'Users', '2562');
echo widget_Ficha_7('fa-eye', 'main-box_yellow-bg', 'Users', '2562');
echo '<div class="clearfix"></div>';

$arrDatos[1]['dato']   = '<i class="fa fa-arrow-circle-o-up"></i> 10% higher than last week';
$arrDatos[2]['dato']   = '<i class="fa fa-users"></i> 29 new users';
$arrDatos[3]['dato']   = '<i class="fa fa-users"></i> 29 new users';
//widget_Ficha_8($bg_color, $number, $titulo, $porcentaje, $subtitulos)
echo widget_Ficha_8('main-box_red-bg', '2.562', 'Users', '60', $arrDatos);
echo widget_Ficha_8('main-box_emerald-bg', '2.562', 'Users', '84', $arrDatos);
echo widget_Ficha_8('main-box_green-bg', '2.562', 'Users', '42', $arrDatos);
echo '<div class="clearfix"></div>';

/*widget_Ficha_9($hover_color, $bg_color, $titulo, 
						$porcentaje, $porcentaje_text, 
						$footer_1_number, $footer_1_text, 
						$footer_2_number, $footer_2_text, 
						$footer_3_number, $footer_3_text, 
						$footer_extra, $link);*/
$footer_extra = '
<img class="project-img-owner" alt="" src="https://centaurus.aircode.sk/v5/img/samples/scarlet-159.png" data-toggle="tooltip" title="" data-original-title="Scarlett Johansson">
<img class="project-img-owner" alt="" src="https://centaurus.aircode.sk/v5/img/samples/lima-300.jpg" data-toggle="tooltip" title="" data-original-title="Adriana Lima">
<img class="project-img-owner" alt="" src="https://centaurus.aircode.sk/v5/img/samples/emma-300.jpg" data-toggle="tooltip" title="" data-original-title="Emma Watson">
<img class="project-img-owner" alt="" src="https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg" data-toggle="tooltip" title="" data-original-title="Angelina Jolie">
';
echo widget_Ficha_9('emerald-box', 'main-box_emerald-bg', 'The Fighter', 39, 'completado', '#3498db', 12, 'Tareas', 1, 'Alertas', 123, 'Mensajes', $footer_extra, 'www.google.cl');
echo widget_Ficha_9('green-box', 'main-box_green-bg', 'Captain America', 45, 'completado', '#2ecc71', 12, 'Tareas', 1, 'Alertas', 123, 'Mensajes', $footer_extra, 'www.google.cl');
echo widget_Ficha_9('red-box', 'main-box_red-bg', 'Contraband', 39, 'completado', '#e74c3c', 12, 'Tareas', 1, 'Alertas', 123, 'Mensajes', $footer_extra, 'www.google.cl');
echo widget_Ficha_9('yellow-box', 'main-box_yellow-bg', 'The Fighter', 39, 'completado', '#f1c40f', 12, 'Tareas', 1, 'Alertas', 123, 'Mensajes', $footer_extra, 'www.google.cl');
echo widget_Ficha_9('purple-box', 'main-box_purple-bg', 'Captain America', 45, 'completado', '#9b59b6', 12, 'Tareas', 1, 'Alertas', 123, 'Mensajes', $footer_extra, 'www.google.cl');
echo widget_Ficha_9('gray-box', 'main-box_gray-bg', 'Contraband', 39, 'completado', '#95a5a6', 12, 'Tareas', 1, 'Alertas', 123, 'Mensajes', $footer_extra, 'www.google.cl');
echo '<div class="clearfix"></div>';


/**********************************************************/
//Variables
$arrDatos  = array();
$arrLinks  = array();
$arrLinks2 = array();

$arrDatos[1]['Icon']   = 'fa-map-marker';
$arrDatos[1]['Nombre'] = 'New York';
$arrDatos[2]['Icon']   = 'fa-envelope';
$arrDatos[2]['Nombre'] = 'angelina@jolie.com';
$arrDatos[3]['Icon']   = 'fa-phone';
$arrDatos[3]['Nombre'] = '(329) 239-3342';

$arrLinks[1]['link']  = 'www.google.cl';
$arrLinks[1]['valor'] = '783';
$arrLinks[1]['Texto'] = 'Messages';
$arrLinks[2]['link']  = 'www.google.cl';
$arrLinks[2]['valor'] = '912';
$arrLinks[2]['Texto'] = 'Sales';
$arrLinks[3]['link']  = 'www.google.cl';
$arrLinks[3]['valor'] = '83';
$arrLinks[3]['Texto'] = 'Projects';
//widget_Ficha_10($bg_color, $img_direction, $Nombre,$trabajo, $arrDatos, $arrLinks)
echo widget_Ficha_10('main-box_gray-bg', 'https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg', 'Angelina Jolie', 'Actress', $arrDatos, $arrLinks);
echo widget_Ficha_10('main-box_emerald-bg', 'https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg', 'Angelina Jolie', 'Actress', $arrDatos, $arrLinks);
echo widget_Ficha_10('main-box_red-bg', 'https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg', 'Angelina Jolie', 'Actress', $arrDatos, $arrLinks);
echo '<div class="clearfix"></div>';
echo widget_Ficha_10('main-box_gray-bg', 'https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg', 'Angelina Jolie', 'Actress', $arrDatos, $arrLinks2);
echo widget_Ficha_10('main-box_emerald-bg', 'https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg', 'Angelina Jolie', 'Actress', $arrDatos, $arrLinks2);
echo widget_Ficha_10('main-box_red-bg', 'https://centaurus.aircode.sk/v5/img/samples/angelina-300.jpg', 'Angelina Jolie', 'Actress', $arrDatos, $arrLinks2);
echo '<div class="clearfix"></div>';

//widget_Ficha_11($color, $bg_color, $porcentaje, $number, $text, $icon)
echo widget_Ficha_11('bgx-white', 'bgx-themeprimary',  'color2-themeprimary',  'color2-themeprimary', 1, 50, 28, 'NEW TASKS', 'fa-tasks stat-icon icon-lg');
echo widget_Ficha_11('bgx-white', 'bgx-themesecondary', 'color2-themesecondary', 'color2-themesecondary', 1, 50, 28, 'NEW TASKS', 'fa-tasks stat-icon icon-lg');
echo widget_Ficha_11('bgx-white', 'bgx-themethirdcolor', 'color2-themethirdcolor', 'color2-themethirdcolor', 1, 50, 28, 'NEW TASKS', 'fa-tasks stat-icon icon-lg');
echo widget_Ficha_11('bgx-white', 'bgx-themefourthcolor', 'color2-themefourthcolor', 'color2-themefourthcolor', 1, 50, 28, 'NEW TASKS', 'fa-tasks stat-icon icon-lg');

echo widget_Ficha_11('bgx-white', 'bgx-themeprimary',    'color2-themeprimary',    'bgx-themeprimary', 2, 50, 28, 'NEW TASKS', 'fa-check');
echo widget_Ficha_11('bgx-white', 'bgx-themesecondary',    'color2-themesecondary',    'bgx-themesecondary', 2, 50, 28, 'NEW TASKS', 'fa-check');
echo widget_Ficha_11('bgx-white', 'bgx-themethirdcolor',    'color2-themethirdcolor',    'bgx-themethirdcolor', 2, 50, 28, 'NEW TASKS', 'fa-check');
echo widget_Ficha_11('bgx-white', 'bgx-themefourthcolor',    'color2-themefourthcolor',    'bgx-themefourthcolor', 2, 50, 28, 'NEW TASKS', 'fa-check');

?>













<script src="https://centaurus.aircode.sk/v5/js/jquery.easypiechart.min.js"></script>
<script>
	$(function() {
		$('.chart').easyPieChart({
			easing: 'easeOutBounce',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			},
			barColor: '#3498db',
			trackColor: '#f2f2f2',
			scaleColor: false,
			lineWidth: 8,
			size: 130,
			animate: 1500
		});
	});

</script>



<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
