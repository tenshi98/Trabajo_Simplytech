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
?>

<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
			<h5>Inputs Test</h5>
		</header>
		<div class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				$x1  = '';
				$x2  = '';
				$x3  = '';
				$x4  = '';
				$x5  = '';
				$x6  = '';
				$x7  = '';
				$x8  = '';
				$x9  = '';
				$x10  = '';
				$x11  = '';
				$x12  = '';
				$x13  = '';
				$x14  = '';
				$x15  = '';
				$x16  = '';
				$x17  = '';
				$x18  = '';
				$x19  = '';
				$x20  = '';
				$x21  = '';
				$x22  = '';
				$x23  = '';
				$x24  = '';
				$x25  = '';
				$x26  = '';
				$x27  = '';
				$x28  = '';
				$x29  = '';
				$x30  = '';
				$x31  = '';
				$x32  = '';
				$x33  = '';
				$x34  = '';
				$x35  = '';
				$x36  = '';
				$x37  = '';
				$x38  = '';
				$x39  = ',,2,,2,,,,,,,,,,';
				$x40  = ',,2,,2,,,,,,,,,,';
				$x41  = '';
				$x42  = '';
				$x43  = '';
				$x44  = '';
				$x45  = '';
				$x46  = '';
				$x47  = '';
				$x48  = '';
				$x49  = 2;
				$x50  = 2;
				$x51  = '';
				$x52  = '';
				$x53  = '';
				$x54  = '';
				$x55  = '';
				$x56  = '';
				$x57  = '';
				$x58  = '';
				$x59  = '';
				$x60  = '';
				$x61  = '';
				$x62  = '';
				$x63  = '';
				$x64  = '';
				$x65  = '';
				$x66  = '';
				$x67  = '';
				$x68  = '';
				$x69  = '';
				$x70  = '';
				$x71  = '';
				$x72  = '';
				$x73  = '';
				$x74  = '';
				$x75  = '';
				$x76  = '';
				$x77  = '';
				$x78  = '';
				$x79  = '';
				$x80  = '';
				$x81  = '';
				$x82  = '';
				$x83  = '';
				$x84  = '';
				$x85  = '';
				$x86  = '';
				$x87  = '';
				$x88  = '';
				$x89  = '';
				$x90  = '';
				$x91  = '';
				$x92  = '';
				$x93  = '';
				$x94  = '';
				$x95  = '';
				$x96  = '';
				$x97  = '';
				$x98  = '';
				$x99  = '';
				$x100  = '';

				
				
				
				
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Informacion');
				$Form_Inputs->form_post_data(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt' );
				$Form_Inputs->form_post_data(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt' );
				$Form_Inputs->form_post_data(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt' );
				$Form_Inputs->form_post_data(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt' );
						
				$Form_Inputs->form_tittle(3, 'Inputs');
				$Form_Inputs->form_input_text('Texto normal', 'form_input_text1', $x1, 1);
				$Form_Inputs->form_input_text('Texto normal', 'form_input_text2', $x2, 2);
				$Form_Inputs->form_input_password('Contraseñas', 'form_input_password1', $x3, 1);
				$Form_Inputs->form_input_password('Contraseñas', 'form_input_password2', $x4, 2);
				$Form_Inputs->form_input_disabled('Input desactivado','form_input_disabled1', $x5);
				$Form_Inputs->form_input_disabled('Input desactivado','form_input_disabled2', $x6);
				$Form_Inputs->form_input_icon('Texto con Icono', 'form_input_icon1', $x7, 1,'fa fa-map');
				$Form_Inputs->form_input_icon('Texto con Icono', 'form_input_icon2', $x8, 2,'fa fa-map');
				$Form_Inputs->form_input_rut('Rut', 'form_input_rut1', $x9, 1);
				$Form_Inputs->form_input_rut('Rut', 'form_input_rut2', $x10, 2);
				$Form_Inputs->form_values('Valores enteros','form_values1', $x11, 1);
				$Form_Inputs->form_values('Valores enteros','form_values2', $x12, 2);
				$Form_Inputs->form_input_number('Valores con decimales','form_input_number1', $x13, 1);
				$Form_Inputs->form_input_number('Valores con decimales','form_input_number2', $x14, 2);
				$Form_Inputs->form_input_number_integer('Valores enteros', 'form_input_number_integer1', $x15, 1);
				$Form_Inputs->form_input_number_integer('Valores enteros', 'form_input_number_integer2', $x16, 2);
				$Form_Inputs->form_input_number_alt('Valores con decimales alternativo','form_input_number_alt1', $x17, 1);
				$Form_Inputs->form_input_number_alt('Valores con decimales alternativo','form_input_number_alt2', $x18, 2);
				$Form_Inputs->form_input_number_spinner('input spinner','form_input_number_spinner1', $x19, 0, 10, '0.1', 1, 1);
				$Form_Inputs->form_input_number_spinner('input spinner','form_input_number_spinner2', $x20, 0, 10, '0.1', 1, 2);
				$Form_Inputs->form_input_phone('telefono', 'form_input_phone1', $x21, 1);
				$Form_Inputs->form_input_phone('telefono', 'form_input_phone2', $x22, 2);
				$Form_Inputs->form_input_fax('fax', 'form_input_fax1', $x23, 1);
				$Form_Inputs->form_input_fax('fax', 'form_input_fax2', $x24, 2);
				
				$Form_Inputs->form_tittle(3, 'Fecha - Hora');
				$Form_Inputs->form_date('fecha','form_date1', $x25, 1);
				$Form_Inputs->form_date('fecha','form_date2', $x26, 2);
				$Form_Inputs->form_time('hora','form_time1', $x27, 1, 1);
				$Form_Inputs->form_time('hora','form_time2', $x28, 2, 2);
				$Form_Inputs->form_time_popover('hora','form_time_popover1', $x29, 1, 1, 24);
				$Form_Inputs->form_time_popover('hora','form_time_popover2', $x30, 2, 2, 24);
				
				$Form_Inputs->form_tittle(3, 'Otros');
				$Form_Inputs->form_color_picker( 'color picker', 'form_input_color1', $x31, 1);
				$Form_Inputs->form_color_picker( 'color picker', 'form_input_color2', $x32, 2);
				
				$Form_Inputs->form_tittle(3, 'Grandes Textos');
				$Form_Inputs->form_textarea('texto', 'form_textarea1', $x33, 1);
				$Form_Inputs->form_textarea('texto', 'form_textarea2', $x34, 2);
				$Form_Inputs->form_ckeditor('ckeditor','form_ckeditor1', $x35, 1, 2);
				$Form_Inputs->form_ckeditor('ckeditor','form_ckeditor2', $x36, 2, 2);
				
				$Form_Inputs->form_tittle(3, 'Subida Archivos');
				$Form_Inputs->form_multiple_upload('Subir archivos','form_multiple_upload1', 1, '"jpg", "png", "gif", "jpeg"');
				$Form_Inputs->form_multiple_upload('Subir archivos','form_multiple_upload2', 1, '"jpg", "png", "gif", "jpeg"');
				
				$Form_Inputs->form_tittle(3, 'Opciones');
				$Form_Inputs->form_checkbox_active('opciones seleccionadas','form_checkbox_active1', $x39, 1, 'idTab', 'Nombre', 'core_telemetria_tabs', 0, $dbConn);
				$Form_Inputs->form_checkbox_active('opciones seleccionadas','form_checkbox_active2', $x40, 2, 'idTab', 'Nombre', 'core_telemetria_tabs', 0, $dbConn);
				
				$Form_Inputs->form_tittle(3, 'Selects');
				$Form_Inputs->form_select('form_select','form_select1', $x41, 1, 'idBodega', 'Nombre', 'bodegas_productos_listado', 0, '', $dbConn);
				$Form_Inputs->form_select('form_select','form_select2', $x42, 2, 'idBodega', 'Nombre', 'bodegas_productos_listado', 0, '', $dbConn);
				$usrfil = 'usuarios_listado.idEstado=1 AND usuarios_listado.idTipoUsuario!=1';
				$Form_Inputs->form_select_filter('form_select_filter','ifilter1', $x43, 1, 'idUsuario', 'Nombre', 'usuarios_listado', $usrfil, '', $dbConn);
				$Form_Inputs->form_select_filter('form_select_filter','ifilter2', $x44, 2, 'idUsuario', 'Nombre', 'usuarios_listado', $usrfil, '', $dbConn);
				$Form_Inputs->form_select_join('form_select_join','form_select_join1', $x45, 1, 'idBodega', 'Nombre', 'bodegas_insumos_listado', 'usuarios_bodegas_insumos', 'bodegas_insumos_listado.idSistema>=0', $dbConn);
				$Form_Inputs->form_select_join('form_select_join','form_select_join2', $x46, 2, 'idBodega', 'Nombre', 'bodegas_insumos_listado', 'usuarios_bodegas_insumos', 'bodegas_insumos_listado.idSistema>=0', $dbConn);
				$Form_Inputs->form_select_join_filter('form_select_join_filter 1','form_select_join_filter1', $x47, 1, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas',$usrfil, $dbConn);
				$Form_Inputs->form_select_join_filter('form_select_join_filter 2','form_select_join_filter2', $x48, 2, 'idUsuario', 'Nombre', 'usuarios_listado', 'usuarios_sistemas',$usrfil, $dbConn);
				$Form_Inputs->form_select_disabled('form_select_disabled 1','form_select_disabled1', $x49, 1, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', $dbConn);
				$Form_Inputs->form_select_disabled('form_select_disabled 2','form_select_disabled2', $x50, 2, 'idEquipo', 'Nombre', 'equipos_arriendo_listado', 'idEstado=1', $dbConn);
				$Form_Inputs->form_select_n_auto('form_select_n_auto','form_select_n_auto1', $x51, 1, 1, 72);
				$Form_Inputs->form_select_n_auto('form_select_n_auto','form_select_n_auto2', $x52, 2, 1, 72);	
				$Form_Inputs->form_select_country('form_select_country','form_select_country1', $x53, 1, $dbConn);
				$Form_Inputs->form_select_country('form_select_country','form_select_country2', $x54, 2, $dbConn);
				$Form_Inputs->form_select_depend1('Select dependientes 1 a','idCiudad', $x55, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
												 'Nivel 1','idComuna', $x56, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
												 $dbConn, 'form1');
				$Form_Inputs->form_select_depend1('Select dependientes 1 b','idCiudad2', $x57, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
												'Nivel 1','idComuna2', $x58, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
												$dbConn, 'form1');
				$Form_Inputs->form_select_depend2('Select dependientes 2', 'idCentroCosto',  $x59,  1,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  0,   0,
												  'Nivel 1', 'idLevel_1',  $x60,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0, 
												  'Nivel 2', 'idLevel_2',  $x61,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
												  $dbConn, 'form1');
				/*$Form_Inputs->form_select_depend2('Select dependientes 2', 'idCentroCosto',  $x3,  1,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  0,   0,
												  'Nivel 1', 'idLevel_1',  $x4,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0, 
												  'Nivel 2', 'idLevel_2',  $x5,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
												  $dbConn, 'form1');*/
				/*$Form_Inputs->form_select_depend5('Select dependientes 5', 'idCentroCosto',  $x16,  2,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  0,   0,
													  'Nivel 1', 'idLevel_1',  $x17,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0, 
													  'Nivel 2', 'idLevel_2',  $x18,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
													  'Nivel 3', 'idLevel_3',  $x19,  1,  'idLevel_3',  'Nombre',  'centrocosto_listado_level_3',  0,   0,
													  'Nivel 4', 'idLevel_4',  $x20,  1,  'idLevel_4',  'Nombre',  'centrocosto_listado_level_4',  0,   0,
													  'Nivel 5', 'idLevel_5',  $x21,  1,  'idLevel_5',  'Nombre',  'centrocosto_listado_level_5',  0,   0,
													  $dbConn, 'form1');*/
				/*$Form_Inputs->form_select_depend5('Select dependientes 5', 'idCentroCosto',  $x16,  2,  'idCentroCosto',  'Nombre',  'centrocosto_listado',  0,   0,
													  'Nivel 1', 'idLevel_1',  $x17,  1,  'idLevel_1',  'Nombre',  'centrocosto_listado_level_1',  0,   0, 
													  'Nivel 2', 'idLevel_2',  $x18,  1,  'idLevel_2',  'Nombre',  'centrocosto_listado_level_2',  0,   0,
													  'Nivel 3', 'idLevel_3',  $x19,  1,  'idLevel_3',  'Nombre',  'centrocosto_listado_level_3',  0,   0,
													  'Nivel 4', 'idLevel_4',  $x20,  1,  'idLevel_4',  'Nombre',  'centrocosto_listado_level_4',  0,   0,
													  'Nivel 5', 'idLevel_5',  $x21,  1,  'idLevel_5',  'Nombre',  'centrocosto_listado_level_5',  0,   0,
													  $dbConn, 'form1');*/
				
				
				
				
				
				
				
				
				
			
				?>
			  
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_tarea"> 
				</div>

			</form>
            <?php widget_validator(); ?>
		</div>
	</div>
</div>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
