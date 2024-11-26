<?php
/**********************************************************************************************************************************/
/*                                                   Se define la Sesion                                                          */
/**********************************************************************************************************************************/
$timeout = 604800;                               //Se setea la expiracion a una semana
ini_set( "session.gc_maxlifetime", $timeout );   //Establecer la vida útil máxima de la sesión
ini_set( "session.cookie_lifetime", $timeout );  //Establecer la duración de las cookies de la sesión
session_start();                                 //Iniciar una nueva sesión
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
$original = "seg_vecinal_servicios_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){     $location .= "&idTipo=".$_GET['idTipo'];              $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){     $location .= "&Nombre=".$_GET['Nombre'];              $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Rut']) && $_GET['Rut']!=''){           $location .= "&Rut=".$_GET['Rut'];                    $search .= "&Rut=".$_GET['Rut'];}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento']!=''){  $location .= "&fNacimiento=".$_GET['fNacimiento'];    $search .= "&fNacimiento=".$_GET['fNacimiento'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){ $location .= "&idCiudad=".$_GET['idCiudad'];          $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){ $location .= "&idComuna=".$_GET['idComuna'];          $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){      $location .= "&Direccion=".$_GET['Direccion'];        $search .= "&Direccion=".$_GET['Direccion'];}
if(isset($_GET['Giro']) && $_GET['Giro']!=''){         $location .= "&Giro=".$_GET['Giro'];                  $search .= "&Giro=".$_GET['Giro'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if (!empty($_POST['submit'])){
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_servicios_listado.php';
}
//formulario para editar
if (!empty($_POST['submit_edit'])){
	//Llamamos al formulario
	$form_trabajo= 'update';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_servicios_listado.php';
}
//se borra un dato
if (!empty($_GET['del'])){
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_servicios_listado.php';
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])){ $error['created'] = 'sucess/Servicio Creado correctamente';}
if (isset($_GET['edited'])){  $error['edited']  = 'sucess/Servicio Modificado correctamente';}
if (isset($_GET['deleted'])){ $error['deleted'] = 'sucess/Servicio Borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['map'])){
	$query = "SELECT Nombre,GeoLatitud, GeoLongitud, Direccion
	FROM `seg_vecinal_servicios_listado`
	WHERE idServicio = ".$_GET['map'];
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');

		//Guardo el error en una variable temporal
		
		
		

	}
	$rowData = mysqli_fetch_assoc ($resultado);

	//información
	echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
	$Alert_Text  = 'Pone el cursor del mouse sobre el marcador  <img src="'.DB_SITE_REPO.'/LIB_assets/img/map-icons/1_series_blue.png" alt="marcador" width="33" height="44">  y arrastralo hasta la posicion correcta';
	alert_post_data(1,3,3,0, $Alert_Text);
	echo '</div>';

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Modificar Posicion de <?php echo $rowData['Nombre']; ?></h5>
			</header>
			<div class="table-responsive">

				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<div class="row">
						<?php
						//Si no existe una ID se utiliza una por defecto
						if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
							$Alert_Text  = 'No ha ingresado Una API de Google Maps.';
							alert_post_data(4,2,2,0, $Alert_Text);
						}else{
							$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle'];

							if(isset($rowData['GeoLatitud']) && $rowData['GeoLatitud']!='' && $rowData['GeoLatitud']!=0){
								$nlat = $rowData['GeoLatitud'];
							}else{
								$nlat = '-33.4372';
							}

							if(isset($rowData['GeoLongitud']) && $rowData['GeoLongitud']!='' && $rowData['GeoLongitud']!=0){
								$nlong = $rowData['GeoLongitud'];
							}else{
								$nlong = '-70.6506';
							}

							?>

							<script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&callback=initMap"></script>

							<input id="pac-input" class="pac-controls" type="text" placeholder="Buscar Dirección">
							<div id="map_canvas" style="width: 100%; height: 550px;"></div>
							<script>
								let map;
								var marker;

								async function initMap() {
									const { Map } = await google.maps.importLibrary("maps");

									var myLatlng = new google.maps.LatLng(<?php echo $nlat; ?>, <?php echo $nlong; ?>);

									var myOptions = {
										zoom: 18,
										center: myLatlng,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									};

									map = new Map(document.getElementById("map_canvas"), myOptions);
									marker = new google.maps.Marker({
										draggable	: true,
										position	: myLatlng,
										map			: map,
										title		: "Tu Ubicación",
										animation 	:google.maps.Animation.DROP,
										icon      	:"<?php echo DB_SITE_REPO ?>/LIB_assets/img/map-icons/1_series_blue.png"
									});

									google.maps.event.addListener(marker, 'dragend', function (event) {

										document.getElementById("GeoLatitud").value = event.latLng.lat();
										document.getElementById("GeoLongitud").value = event.latLng.lng();
										document.getElementById("Latitud_fake").value = event.latLng.lat();
										document.getElementById("Longitud_fake").value = event.latLng.lng();

									});

									//Se define el cuadro de busqueda
									var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
									map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
									google.maps.event.addListener(searchBox, 'places_changed', function() {
										searchBox.set('map', null);

										var places = searchBox.getPlaces();

										var bounds = new google.maps.LatLngBounds();
										var i, place;
										for (i = 0; place = places[i]; i++) {
											(function(place) {

												var myLatlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
												marker.setPosition(myLatlng);

												bounds.extend(place.geometry.location);

												document.getElementById("GeoLatitud").value = place.geometry.location.lat();
												document.getElementById("GeoLongitud").value = place.geometry.location.lng();
												document.getElementById("Latitud_fake").value = place.geometry.location.lat();
												document.getElementById("Longitud_fake").value = place.geometry.location.lng();

											}(place));

										}

										map.fitBounds(bounds);
										searchBox.set('map', map);
										map.setZoom(Math.min(map.getZoom(),12));

									});

								}

							</script>

						<?php } ?>
					</div>
				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div style="margin-top:20px;">
						<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

							<?php
							//Se dibujan los inputs
							$Form_Inputs = new Form_Inputs();
							$Form_Inputs->form_input_icon('Dirección', 'Direccion_fake', $rowData['Direccion'], 1,'fa fa-map');
							$Form_Inputs->form_input_disabled('Latitud', 'Latitud_fake', $rowData['GeoLatitud']);
							$Form_Inputs->form_input_disabled('Longitud', 'Longitud_fake', $rowData['GeoLongitud']);

							$Form_Inputs->form_input_hidden('GeoLatitud', $rowData['GeoLatitud'], 2);
							$Form_Inputs->form_input_hidden('GeoLongitud', $rowData['GeoLongitud'], 2);
							$Form_Inputs->form_input_hidden('idServicio', $_GET['map'], 2);
							?>

							<div class="form-group">
								<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar" name="submit_edit">
							</div>

						</form>
						<?php widget_validator(); ?>

					</div>
				</div>

			</div>

		</div>
	</div>

<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['id'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 2, $dbConn);
	//consulta
	$query = "SELECT idTipo, Nombre,idCiudad, idComuna, Direccion, Fono1, Fono2, Fax, email, Web,
	HoraInicio, HoraTermino
	FROM `seg_vecinal_servicios_listado`
	WHERE idServicio = ".$_GET['id'];
	//Consulta
	$resultado = mysqli_query ($dbConn, $query);
	//Si ejecuto correctamente la consulta
	if(!$resultado){
		//Genero numero aleatorio
		$vardata = genera_password(8,'alfanumerico');

		//Guardo el error en una variable temporal
		
		
		

	}
	$rowData = mysqli_fetch_assoc ($resultado);

	?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Editar Servicio</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idTipo)){      $x1  = $idTipo;      }else{$x1  = $rowData['idTipo'];}
					if(isset($Nombre)){      $x2  = $Nombre;      }else{$x2  = $rowData['Nombre'];}
					if(isset($idCiudad)){    $x3  = $idCiudad;    }else{$x3  = $rowData['idCiudad'];}
					if(isset($idComuna)){    $x4  = $idComuna;    }else{$x4  = $rowData['idComuna'];}
					if(isset($Direccion)){   $x5  = $Direccion;   }else{$x5  = $rowData['Direccion'];}
					if(isset($HoraInicio)){  $x6  = $HoraInicio;  }else{$x6  = $rowData['HoraInicio'];}
					if(isset($HoraTermino)){ $x7  = $HoraTermino; }else{$x7  = $rowData['HoraTermino'];}
					if(isset($Fono1)){       $x8  = $Fono1;       }else{$x8  = $rowData['Fono1'];}
					if(isset($Fono2)){       $x9  = $Fono2;       }else{$x9  = $rowData['Fono2'];}
					if(isset($Fax)){         $x10 = $Fax;         }else{$x10 = $rowData['Fax'];}
					if(isset($email)){       $x11 = $email;       }else{$x11 = $rowData['email'];}
					if(isset($Web)){         $x12 = $Web;         }else{$x12 = $rowData['Web'];}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Básicos');
					$Form_Inputs->form_select('Tipo de Servicio','idTipo', $x1, 2, 'idTipo', 'Nombre', 'seg_vecinal_servicios_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 2);
					$Form_Inputs->form_select_depend1('Región','idCiudad', $x3, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
													'Comuna','idComuna', $x4, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
													$dbConn, 'form1');
					$Form_Inputs->form_input_icon('Dirección', 'Direccion', $x5, 2,'fa fa-map');
					$Form_Inputs->form_time('Hora Inicio','HoraInicio', $x6, 2, 2);
					$Form_Inputs->form_time('Hora Termino','HoraTermino', $x7, 2, 2);

					$Form_Inputs->form_tittle(3, 'Datos de contacto');
					$Form_Inputs->form_post_data(4,1,1, 'Al ingresar el numero telefónico omitir el +56 e ingresar el resto del número' );
					$Form_Inputs->form_input_phone('Telefono Fijo', 'Fono1', $x8, 1);
					$Form_Inputs->form_input_phone('Telefono Movil', 'Fono2', $x9, 1);
					$Form_Inputs->form_input_fax('Fax', 'Fax', $x10, 1);
					$Form_Inputs->form_input_icon('Email', 'email', $x11, 1,'fa fa-envelope-o');
					$Form_Inputs->form_input_icon('Web', 'Web', $x12, 1,'fa fa-internet-explorer');

					$Form_Inputs->form_input_hidden('idServicio', $_GET['id'], 2);

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit_edit">
						<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>
				</form>
				<?php widget_validator(); ?>

			</div>
		</div>
	</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(!empty($_GET['new'])){
	//valido los permisos
	validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

	<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>
				<h5>Crear Servicio</h5>
			</header>
			<div class="body">
				<form class="form-horizontal" method="post" id="form1" name="form1" autocomplete="off" novalidate>

					<?php
					//Se verifican si existen los datos
					if(isset($idTipo)){      $x1  = $idTipo;      }else{$x1  = '';}
					if(isset($Nombre)){      $x2  = $Nombre;      }else{$x2  = '';}
					if(isset($idCiudad)){    $x3  = $idCiudad;    }else{$x3  = '';}
					if(isset($idComuna)){    $x4  = $idComuna;    }else{$x4  = '';}
					if(isset($Direccion)){   $x5  = $Direccion;   }else{$x5  = '';}
					if(isset($HoraInicio)){  $x6  = $HoraInicio;  }else{$x6  = '';}
					if(isset($HoraTermino)){ $x7  = $HoraTermino; }else{$x7  = '';}
					if(isset($Fono1)){       $x8  = $Fono1;       }else{$x8  = '';}
					if(isset($Fono2)){       $x9  = $Fono2;       }else{$x9  = '';}
					if(isset($Fax)){         $x10 = $Fax;         }else{$x10 = '';}
					if(isset($email)){       $x11 = $email;       }else{$x11 = '';}
					if(isset($Web)){         $x12 = $Web;         }else{$x12 = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_tittle(3, 'Datos Básicos');
					$Form_Inputs->form_select('Tipo de Servicio','idTipo', $x1, 2, 'idTipo', 'Nombre', 'seg_vecinal_servicios_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 2);
					$Form_Inputs->form_select_depend1('Región','idCiudad', $x3, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
													'Comuna','idComuna', $x4, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
													$dbConn, 'form1');
					$Form_Inputs->form_input_icon('Dirección', 'Direccion', $x5, 2,'fa fa-map');
					$Form_Inputs->form_time('Hora Inicio','HoraInicio', $x6, 2, 2);
					$Form_Inputs->form_time('Hora Termino','HoraTermino', $x7, 2, 2);

					$Form_Inputs->form_tittle(3, 'Datos de contacto');
					$Form_Inputs->form_post_data(4,1,1, 'Al ingresar el numero telefónico omitir el +56 e ingresar el resto del número' );
					$Form_Inputs->form_input_phone('Telefono Fijo', 'Fono1', $x8, 1);
					$Form_Inputs->form_input_phone('Telefono Movil', 'Fono2', $x9, 1);
					$Form_Inputs->form_input_fax('Fax', 'Fax', $x10, 1);
					$Form_Inputs->form_input_icon('Email', 'email', $x11, 1,'fa fa-envelope-o');
					$Form_Inputs->form_input_icon('Web', 'Web', $x12, 1,'fa fa-internet-explorer');

					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
						<a href="<?php echo $location; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
					</div>
				</form>
				<?php widget_validator(); ?>

			</div>
		</div>
	</div>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
	/**********************************************************/
	//paginador de resultados
	if(isset($_GET['pagina'])){$num_pag = $_GET['pagina'];} else {$num_pag = 1;}
	//Defino la cantidad total de elementos por pagina
	$cant_reg = 30;
	//resto de variables
	if (!$num_pag){$comienzo = 0;$num_pag = 1;} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;}
	/**********************************************************/
	//ordenamiento
	if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
		switch ($_GET['order_by']) {
			case 'tipo_asc':      $order_by = 'seg_vecinal_servicios_tipos.Nombre ASC ';      $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Ascendente';break;
			case 'tipo_desc':     $order_by = 'seg_vecinal_servicios_tipos.Nombre DESC ';     $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Descendente';break;
			case 'nombre_asc':    $order_by = 'seg_vecinal_servicios_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
			case 'nombre_desc':   $order_by = 'seg_vecinal_servicios_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;

			default: $order_by = 'seg_vecinal_servicios_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
		}
	}else{
		$order_by = 'seg_vecinal_servicios_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
	/**********************************************************/
	//Variable de busqueda
	$SIS_where = "seg_vecinal_servicios_listado.idServicio!=0";
	/**********************************************************/
	//Se aplican los filtros
	if(isset($_GET['idTipo']) && $_GET['idTipo']!=''){      $SIS_where .= " AND seg_vecinal_servicios_listado.idTipo=".$_GET['idTipo'];}
	if(isset($_GET['Nombre']) && $_GET['Nombre']!=''){      $SIS_where .= " AND seg_vecinal_servicios_listado.Nombre LIKE '%".EstandarizarInput($_GET['Nombre'])."%'";}
	if(isset($_GET['idCiudad']) && $_GET['idCiudad']!=''){  $SIS_where .= " AND seg_vecinal_servicios_listado.idCiudad=".$_GET['idCiudad'];}
	if(isset($_GET['idComuna']) && $_GET['idComuna']!=''){  $SIS_where .= " AND seg_vecinal_servicios_listado.idComuna=".$_GET['idComuna'];}
	if(isset($_GET['Direccion']) && $_GET['Direccion']!=''){$SIS_where .= " AND seg_vecinal_servicios_listado.Direccion LIKE '%".EstandarizarInput($_GET['Direccion'])."%'";}

	/**********************************************************/
	//Realizo una consulta para saber el total de elementos existentes
	$cuenta_registros = db_select_nrows (false, 'idServicio', 'seg_vecinal_servicios_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
	//Realizo la operacion para saber la cantidad de paginas que hay
	$total_paginas = ceil($cuenta_registros / $cant_reg);
	// Se trae un listado con todos los elementos
	$SIS_query = '
	seg_vecinal_servicios_listado.idServicio,
	seg_vecinal_servicios_listado.Nombre,
	seg_vecinal_servicios_tipos.Nombre AS Tipo';
	$SIS_join  = 'LEFT JOIN `seg_vecinal_servicios_tipos` ON seg_vecinal_servicios_tipos.idTipo = seg_vecinal_servicios_listado.idTipo';
	$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
	$arrUsers = array();
	$arrUsers = db_select_array (false, $SIS_query, 'seg_vecinal_servicios_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUsers');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar">

		<ul class="btn-group btn-breadcrumb pull-left">
			<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm" title="Presionar para desplegar Formulario de Búsqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
			<li class="btn btn-default"><?php echo $bread_order; ?></li>
			<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
				<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
			<?php } ?>
		</ul>

		<?php if ($rowlevel['level']>=3){ ?><a href="<?php echo $location; ?>&new=true" class="btn btn-default pull-right margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Servicio</a><?php } ?>

	</div>
	<div class="clearfix"></div>
	<div class="collapse col-xs-12 col-sm-12 col-md-12 col-lg-12" id="collapseForm">
		<div class="well">
			<div class="col-xs-12 col-sm-10 col-md-9 col-lg-8 fcenter">
				<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" autocomplete="off" novalidate>
					<?php
					//Se verifican si existen los datos
					if(isset($idTipo)){           $x1  = $idTipo;            }else{$x1  = '';}
					if(isset($Nombre)){           $x2  = $Nombre;            }else{$x2  = '';}
					if(isset($idCiudad)){         $x3  = $idCiudad;          }else{$x3  = '';}
					if(isset($idComuna)){         $x4  = $idComuna;          }else{$x4  = '';}
					if(isset($Direccion)){        $x5  = $Direccion;         }else{$x5  = '';}

					//se dibujan los inputs
					$Form_Inputs = new Form_Inputs();
					$Form_Inputs->form_select('Tipo de Servicio','idTipo', $x1, 1, 'idTipo', 'Nombre', 'seg_vecinal_servicios_tipos', 0, '', $dbConn);
					$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 1);
					$Form_Inputs->form_select_depend1('Región','idCiudad', $x3, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
											'Comuna','idComuna', $x4, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0,
											$dbConn, 'form1');
					$Form_Inputs->form_input_icon('Dirección', 'Direccion', $x5, 1,'fa fa-map');

					$Form_Inputs->form_input_hidden('pagina', 1, 1);
					?>

					<div class="form-group">
						<input type="submit" class="btn btn-primary pull-right margin_form_btn fa-input" value="&#xf002; Filtrar" name="filtro_form">
						<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger pull-right margin_form_btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
					</div>

				</form>
				<?php widget_validator(); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box">
			<header>
				<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Servicios</h5>
				<div class="toolbar">
					<?php
					//Se llama al paginador
					echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
				</div>
			</header>
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
					<thead>
						<tr role="row">
							<th>
								<div class="pull-left">Tipo</div>
								<div class="btn-group pull-right" style="width: 50px;" >
									<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
									<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
							<th>
								<div class="pull-left">Nombre</div>
								<div class="btn-group pull-right" style="width: 50px;" >
									<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
									<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
								</div>
							</th>
							<th width="10">Acciones</th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($arrUsers as $usuarios){ ?>
						<tr class="odd">
							<td><?php echo $usuarios['Tipo']; ?></td>
							<td><?php echo $usuarios['Nombre']; ?></td>
							<td>
								<div class="btn-group" style="width: 140px;" >
									<?php if ($rowlevel['level']>=1){ ?><a href="<?php echo 'view_seg_vecinal_servicios.php?view='.simpleEncode($usuarios['idServicio'], fecha_actual()); ?>" title="Ver Información" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&id='.$usuarios['idServicio']; ?>" title="Editar Información" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=2){ ?><a href="<?php echo $location.'&map='.$usuarios['idServicio']; ?>" title="Corregir Mapa" class="btn btn-success btn-sm tooltip"><i class="fa fa-map-marker" aria-hidden="true"></i></a><?php } ?>
									<?php if ($rowlevel['level']>=4){
										$ubicacion = $location.'&del='.simpleEncode($usuarios['idServicio'], fecha_actual());
										$dialogo   = '¿Realmente deseas eliminar al Servicio '.$usuarios['Nombre'].'?'; ?>
										<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Información" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									<?php } ?>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="pagrow">
				<?php
				//se llama al paginador
				echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</div>
	</div>

<?php } ?>
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
