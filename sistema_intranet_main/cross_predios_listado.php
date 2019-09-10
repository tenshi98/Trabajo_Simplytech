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
$original = "cross_predios_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){        $location .= "&Nombre=".$_GET['Nombre'];        $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){    $location .= "&idEstado=".$_GET['idEstado'];    $search .= "&idEstado=".$_GET['idEstado'];}
if(isset($_GET['idPais']) && $_GET['idPais'] != ''){        $location .= "&idPais=".$_GET['idPais'];        $search .= "&idPais=".$_GET['idPais'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){    $location .= "&idCiudad=".$_GET['idCiudad'];    $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){    $location .= "&idComuna=".$_GET['idComuna'];    $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){  $location .= "&Direccion=".$_GET['Direccion'];  $search .= "&Direccion=".$_GET['Direccion'];}
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_trabajo= 'insert';
	require_once 'A1XRXS_sys/xrxs_form/cross_predios_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/cross_predios_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Predio creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Predio editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Predio borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
cross_predios_listado.Nombre,
cross_predios_listado.Direccion,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna

FROM `cross_predios_listado`
LEFT JOIN `core_ubicacion_ciudad`                    ON core_ubicacion_ciudad.idCiudad                  = cross_predios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`                   ON core_ubicacion_comunas.idComuna                 = cross_predios_listado.idComuna
WHERE cross_predios_listado.idPredio = {$_GET['id']}";
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

//Se traen las rutas
$arrZonas = array();
$query = "SELECT 
cross_predios_listado_zonas.idZona,
cross_predios_listado_zonas.Nombre,
cross_predios_listado_zonas_ubicaciones.Latitud,
cross_predios_listado_zonas_ubicaciones.Longitud,
cross_predios_listado.Direccion,
core_ubicacion_ciudad.Nombre AS Ciudad,
core_ubicacion_comunas.Nombre AS Comuna

FROM `cross_predios_listado_zonas`
LEFT JOIN `cross_predios_listado_zonas_ubicaciones`  ON cross_predios_listado_zonas_ubicaciones.idZona  = cross_predios_listado_zonas.idZona
LEFT JOIN `cross_predios_listado`                    ON cross_predios_listado.idPredio                  = cross_predios_listado_zonas.idPredio
LEFT JOIN `core_ubicacion_ciudad`                    ON core_ubicacion_ciudad.idCiudad                  = cross_predios_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`                   ON core_ubicacion_comunas.idComuna                 = cross_predios_listado.idComuna

WHERE cross_predios_listado_zonas.idPredio = {$_GET['id']}
ORDER BY cross_predios_listado_zonas.idZona ASC, 
cross_predios_listado_zonas_ubicaciones.idUbicaciones ASC";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrZonas,$row );
}

//Se obtiene la ubicacion
$Ubicacion = "";
if(isset($arrZonas[0]['Direccion'])&&$arrZonas[0]['Direccion']!=''){ $Ubicacion.=' '.$arrZonas[0]['Direccion'];}
if(isset($arrZonas[0]['Comuna'])&&$arrZonas[0]['Comuna']!=''){       $Ubicacion.=', '.$arrZonas[0]['Comuna'];}
if(isset($arrZonas[0]['Ciudad'])&&$arrZonas[0]['Ciudad']!=''){       $Ubicacion.=', '.$arrZonas[0]['Ciudad'];}
//Si los puntos no existen
if(isset($Ubicacion)&&$Ubicacion==''){
	if(isset($rowdata['Direccion'])&&$rowdata['Direccion']!=''){ $Ubicacion.=' '.$rowdata['Direccion'];}
	if(isset($rowdata['Comuna'])&&$rowdata['Comuna']!=''){       $Ubicacion.=', '.$rowdata['Comuna'];}
	if(isset($rowdata['Ciudad'])&&$rowdata['Ciudad']!=''){       $Ubicacion.=', '.$rowdata['Ciudad'];}

}

//Se limpian los nombres
$Ubicacion = str_replace('Nº', '', $Ubicacion);
$Ubicacion = str_replace('nº', '', $Ubicacion);
$Ubicacion = str_replace(' n ', '', $Ubicacion);
	
$Ubicacion = str_replace("'", '', $Ubicacion);
	
$Ubicacion = str_replace("Av.", 'Avenida', $Ubicacion);
$Ubicacion = str_replace("av.", 'Avenida', $Ubicacion);

?>
<div class="col-sm-12">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-map-o" aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Predio</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'cross_predios_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'cross_predios_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'cross_predios_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'cross_predios_listado_config.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Editar Cuarteles</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<?php
					//Si no existe una ID se utiliza una por defecto
					if(!isset($_SESSION['usuario']['basic_data']['Config_IDGoogle']) OR $_SESSION['usuario']['basic_data']['Config_IDGoogle']==''){
						echo '<p>No ha ingresado Una API de Google Maps</p>';
					}else{
						$google = $_SESSION['usuario']['basic_data']['Config_IDGoogle']; ?>
						<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $google; ?>&sensor=false"></script>
						<div id="map_canvas" style="width: 100%; height: 550px;"></div>
						<script>
							
							var map;
							var marker;
							var geocoder = new google.maps.Geocoder();
							/* ************************************************************************** */
							function initialize() {
								
								var myLatlng = new google.maps.LatLng(-33.4372, -70.6506);
								
								var myOptions = {
									zoom: 15,
									center: myLatlng,
									mapTypeId: google.maps.MapTypeId.SATELLITE

								};
								map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
								map.setTilt(0); 
								
								dibuja_zona();

							}
							/* ************************************************************************** */
							function dibuja_zona() {
								
								var polygons = [];
								<?php
								//variables
								$Latitud_z       = 0;
								$Longitud_z      = 0;
								$Latitud_z_prom  = 0;
								$Longitud_z_prom = 0;
								$zcounter        = 0; 
								//Se filtra por zona
								filtrar($arrZonas, 'idZona');
								//se recorre
								foreach ($arrZonas as $todaszonas=>$zonas) {
									
									echo 'var path'.$todaszonas.' = [';

									//Variables con la primera posicion
									$Latitud_x = '';
									$Longitud_x = '';
									
									foreach ($zonas as $puntos) {
										if(isset($puntos['Latitud'])&&$puntos['Latitud']!=''&&isset($puntos['Longitud'])&&$puntos['Longitud']!=''){
											echo '{lat: '.$puntos['Latitud'].', lng: '.$puntos['Longitud'].'},
											';
											if(isset($puntos['Latitud'])&&$puntos['Latitud']!='0'&&isset($puntos['Longitud'])&&$puntos['Longitud']!='0'){	
												$Latitud_x = $puntos['Latitud'];
												$Longitud_x = $puntos['Longitud'];
												//Calculos para centrar mapa
												$Latitud_z  = $Latitud_z+$puntos['Latitud'];
												$Longitud_z = $Longitud_z+$puntos['Longitud'];
												$zcounter++;
											}
										}
									}
									//se cierra la figura
									if(isset($Longitud_x)&&$Longitud_x!=''){
										echo '{lat: '.$Latitud_x.', lng: '.$Longitud_x.'}'; 
									}
									echo '];';
									
									echo '
									polygons.push(new google.maps.Polygon({
										paths: path'.$todaszonas.',
										strokeColor: \'#FF0000\',
										strokeOpacity: 0.8,
										strokeWeight: 2,
										fillColor: \'#FF0000\',
										fillOpacity: 0.35
									}));
									polygons[polygons.length-1].setMap(map);
									';
									
									/*if(isset($Latitud_x)&&$Latitud_x!=''&&isset($Longitud_x)&&$Longitud_x!=''){
										echo 'myLatlng = new google.maps.LatLng('.$Latitud_x.', '.$Longitud_x.');
												map.setCenter(myLatlng);'; 
									}else{ 
										echo 'codeAddress();';
									}*/
									
										
								}
								//Centralizado del mapa
								if($zcounter!=0){
									$Latitud_z_prom  = $Latitud_z/$zcounter;
									$Longitud_z_prom = $Longitud_z/$zcounter;
										
									if(isset($Latitud_z_prom)&&$Latitud_z_prom!=0&&isset($Longitud_z_prom)&&$Longitud_z_prom!=0){
											echo 'myLatlng = new google.maps.LatLng('.$Latitud_z_prom.', '.$Longitud_z_prom.');
													map.setCenter(myLatlng);'; 
									}else{ 
										echo 'codeAddress();';
									}
								}
								
								
								 ?>
							}
							/* ************************************************************************** */
							function codeAddress() {
						  
								geocoder.geocode( { address: '<?php echo $Ubicacion ?>'}, function(results, status) {
									if (status == google.maps.GeocoderStatus.OK) {
										
										// marker position
										myLatlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
								
										map.setCenter(myLatlng);
										//marker.setPosition(myLatlng);  
														  
									} else {
										alert('Geocode was not successful for the following reason: ' + status);
									}
								});
							}
							/* ************************************************************************** */
							google.maps.event.addDomListener(window, "load", initialize());

						</script>
					<?php } ?>
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Predio</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {          $x1  = $Nombre;           }else{$x1  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre del Predio', 'Nombre', $x1, 2);
				
				
				$Form_Imputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial'], 1);
				$Form_Imputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
					
				?>
			
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
				</div>
			</form>
			<?php widget_validator(); ?> 
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } else  { 
/**********************************************************/
//paginador de resultados
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':    $order_by = 'ORDER BY cross_predios_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente'; break;
		case 'nombre_desc':   $order_by = 'ORDER BY cross_predios_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':    $order_by = 'ORDER BY core_estados.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':   $order_by = 'ORDER BY core_estados.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'ORDER BY cross_predios_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY cross_predios_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z="WHERE cross_predios_listado.idPredio!=0";
//Verifico el tipo de usuario que esta ingresando
$z.=" AND cross_predios_listado.idSistema={$_SESSION['usuario']['basic_data']['idSistema']}";	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){           $z .= " AND cross_predios_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){       $z .= " AND cross_predios_listado.idEstado=".$_GET['idPais'];}
if(isset($_GET['idPais']) && $_GET['idPais'] != ''){           $z .= " AND cross_predios_listado.idPais=".$_GET['idPais'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){       $z .= " AND cross_predios_listado.idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){       $z .= " AND cross_predios_listado.idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){     $z .= " AND cross_predios_listado.Direccion LIKE '%".$_GET['Direccion']."%'";}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idPredio FROM `cross_predios_listado` ".$z;
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
$cuenta_registros = mysqli_num_rows($resultado);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
cross_predios_listado.idPredio,
cross_predios_listado.Nombre,
core_sistemas.Nombre AS sistema,
core_estados.Nombre AS estado,
cross_predios_listado.idEstado

FROM `cross_predios_listado`
LEFT JOIN `core_sistemas`    ON core_sistemas.idSistema   = cross_predios_listado.idSistema
LEFT JOIN `core_estados`     ON core_estados.idEstado     = cross_predios_listado.idEstado
".$z."
".$order_by."
LIMIT $comienzo, $cant_reg ";
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
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUsers,$row );
}
?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Predio</a><?php } ?>
	
</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {          $x1  = $Nombre;       }else{$x1  = '';}
				if(isset($idEstado)) {        $x2  = $idEstado;     }else{$x2  = '';}
				if(isset($idPais)) {          $x3  = $idPais;       }else{$x3  = '';}
				if(isset($idCiudad)) {        $x4  = $idCiudad;     }else{$x4  = '';}
				if(isset($idComuna)) {        $x5  = $idComuna;     }else{$x5  = '';}
				if(isset($Direccion)) {       $x6  = $Direccion;    }else{$x6  = '';}
				
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre del Predio', 'Nombre', $x1, 1);
				$Form_Imputs->form_select('Estado','idEstado', $x2, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
				$Form_Imputs->form_select_country('Pais','idPais', $x3, 1, $dbConn);
				$Form_Imputs->form_select_depend1('Ciudad','idCiudad', $x4, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x5, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');
				$Form_Imputs->form_input_icon( 'Direccion', 'Direccion', $x6, 1,'fa fa-map'); 
				
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php widget_validator(); ?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                      



                                
<div class="col-sm-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Predios</h5>
			<div class="toolbar">
				<?php 
				//se llama al paginador
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>	
		</header>
		<div class="table-responsive">    
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Nombre']; ?></td>	
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['estado']; ?></label></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>			
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_predio.php?view='.$usuarios['idPredio']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idPredio']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									//se verifica que el usuario no sea uno mismo
									$ubicacion = $location.'&del='.$usuarios['idPredio'];
									$dialogo   = '¿Realmente deseas eliminar el Predio '.$usuarios['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o"></i></a>
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


<?php widget_modal(80, 95); ?>
	
<?php } ?>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
